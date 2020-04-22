<?php

namespace Controllers;

use Entities\Article;

class IndexController extends AbstractBase
{

  public function indexAction()
  {

    $em = $this->getEntityManager();

    // $articles = $em->getRepository('Entities\Article')
    //   ->findAll();

    $query = $em->createQueryBuilder()
      ->select('A, t, u')
      ->from('Entities\Article', 'A')
      ->leftJoin('A.tags', 't')
      ->leftJoin('A.user', 'u')
      ->orderBy('A.createdAt', 'DESC')
      ->getQuery(); // beendet den DQL String  und bereitet die Daten vor

    // var_dump($query->getDql());
    $articles = $query->getResult(); // Durchführung des Querys. Daten werden in einem Array gesammelt.

    // \Doctrine\Common\Util\Debug::dump($articles);

    $this->addContext('pageTitle', 'News');
    $this->addContext('headline', 'News');
    $this->addContext('articles', $articles);
  }

  public function readAction()
  {
    $em = $this->getEntityManager();
    $id = (int) $_GET['id'];

    $article = $em->getRepository('Entities\Article')
      ->find($id);

    $article || $this->render404();

    $this->addContext('article', $article);
  }

  public function addAction()
  {

    $em = $this->getEntityManager();
    $article = new Article();

    // GET ALL TAGS
    $tags = $em->getRepository('Entities\Tag')
      ->findAll();


    if ($_POST) {
      // pre_r($_POST);  
      $article->mapFromArray($_POST);
      $userId = (int) $_SESSION['user_id'] ?? 1;
      $user = $em->getRepository('Entities\User')->find($userId);

      $article->setUser($user);
      $user->addArticle($article);

      $tagIds = $_POST['tag_ids'] ?? [];
      foreach ($tagIds as $id) {
        $tag = $em->getRepository('Entities\Tag')->find($id);
        $article->addTag($tag);
      }

      // $validator = $em->getValidator($article);
      $validator = new \Validators\ArticleValidator($em, $article);

      if ($validator->isValid()) {
        $em->persist($article);
        $em->flush();

        $this->setMessage('New Article added.');
        $this->redirect();
      }

      $this->addContext('errors', $validator->getErrors());
    }

    $this->addContext('article', $article);
    $this->addContext('tags', $tags);
  }

  public function editAction()
  {
    $em = $this->getEntityManager();
    $id = (int) $_REQUEST['id'];

    $article = $em->getRepository('Entities\Article')
      ->find($id);

    $article || $this->render404(); //Sicherheitsmaßnahme - Nur Skript fortsetzen, wenn Datensatz bzwq. Objekt exisitert.

    $tags = $em->getRepository('Entities\Tag')
      ->findAll();

    // \Doctrine\Common\Util\Debug::dump($article);

    if ($_POST) {
      $article->mapFromArray($_POST); // befüllt die Attribute über die Setter-Methoden, wenn diese existieren

      $article->clearTags();

      $tag_ids = $_POST['tag_ids'] ?? [];
      foreach ($tag_ids as $id) {
        $tag = $em->getRepository('Entities\Tag')
          ->find($id);

        $tag || $this->render404();

        $article->addTag($tag);
      }

      $validator = $em->getValidator($article);

      // \Doctrine\Common\Util\Debug::dump($article);

      // Validierung der Daten bevor die Daten abgespeichert werden. tbd
      if ($validator->isValid()) {
        $em->persist($article);
        $em->flush(); // Datensatz wird aktualisiert (UPDATE)

        $this->setMessage('Updated News');
        $this->redirect();
      }

      $this->addContext('errors', $validator->getErrors());
    }

    $this->addContext('tags', $tags);
    $this->addContext('article', $article);
  }

  public function deleteAction()
  {
    $em = $this->getEntityManager();
    $id = (int) $_REQUEST['id'];

    $article = $em->getRepository('Entities\Article')
      ->find($id);

    $article || $this->render404();

    if ($_POST) {

      $em->remove($article);
      $em->flush();

      $this->setMessage('Deleted Article.');
      $this->redirect();
    }

    $this->addContext('article', $article);
  }

  public function searchAction()
  {
    $like = $_REQUEST['like'];

    $em = $this->getEntityManager();

    $articles = $em->getRepository('Entities\Article')
      ->searchBy($like);

    // searchBy beinhaltet folgende DQL-Anfrage
    // $query = $em->createQueryBuilder()
    //   ->select('A')
    //   ->from('Entities\Article', 'A')
    //   ->where('A.title LIKE :search')
    //   ->orWhere('A.teaser LIKE :search')
    //   ->setParameter('search', '%'.$like.'%' )
    //   ->orderBy('A.createdAt', 'DESC')
    //   ->getQuery();

    // $articles = $query->getResult();

    // var_dump($like);

    $this->setTemplate('indexAction');

    $this->addContext('headline', 'Search Result');
    $this->addContext('articles', $articles);
    $this->addContext('searchValue', $like);
  }
}
