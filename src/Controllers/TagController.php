<?php 

namespace Controllers;

use Entities\Tag;

class TagController extends AbstractBase {
  public function indexAction() {
    $em = $this->getEntityManager();
    
    $tags = $em->getRepository("Entities\Tag")
      ->findAll(); 

    $this->addContext('tags', $tags);
    $this->addContext('pageTitle', 'Tags');
  }

  public function readAction() {
    $em = $this->getEntityManager();
    $id = (int) $_GET['id'];

    $tag = $em->getRepository('Entities\Tag')
      ->find($id);
    
    $tag || $this->render404();

    $articles = $tag->getArticles();

    $this->addContext('headline', 'Articles by Tag');
    $this->addContext('articles', $articles);

    $this->setTemplate('indexAction', 'indexTemplate');
  }

  public function addAction() {
    $em = $this->getEntityManager();
    $tag = new Tag();
    
    if ($_POST) {
      
      $tag->mapFromArray($_POST); // ['title' => 'wert'] 
      // Attribtute $title wird befüllt

      // \Doctrine\Common\Util\Debug::dump($tag);

      // $tags = $em->getRepository('Entities\Tag')
      //   ->findDuplicates($tag);

      //  echo '<hr>';
      // \Doctrine\Common\Util\Debug::dump($tags);

      // TBD: Validierung bevor Daten abgespeichert werden.
      // getValidator() ist keine EntityManagerMethode von Doctrine, sondern wurde von WE erweitert 
      $validator = $em->getValidator($tag); 
      // $validator = new \Validators\TagValidator($em, $tag);

      if ($validator->isValid()) {
        $em->persist($tag);
        $em->flush();
        
        $this->setMessage('Added Tag.');
        $this->redirect('index','tag');
      }

      $this->addContext('errors', $validator->getErrors());
     
    }

    $this->addContext('tag', $tag);
  }

  public function editAction() {
    $em = $this->getEntityManager();
    $id = (int) $_REQUEST['id'];

    $tag = $em->getRepository('Entities\Tag')
      ->find($id);

    if($_POST) {
      $tag->mapFromArray($_POST);

      // Validierung
      //$validator = new \Validators\TagValidator($em, $tag);
      $validator = $em->getValidator($tag);

      if ($validator->isValid()) {
        $em->persist($tag);
        $em->flush();

        $this->setMessage('Updated Tag.');
        $this->redirect('index','tag');
      }

      $this->addContext('errors', $validator->getErrors());
    }

    $this->setTemplate('addAction'); 
    $this->addContext('tag', $tag);   
  }

}