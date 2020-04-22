<?php

namespace Controllers;

use Entities\Movie;
use Gedmo\ReferenceIntegrity\Mapping\Validator;

class MovieController extends AbstractSecurity
{
  public function indexAction()
  {

    $em = $this->getEntityManager();

    // $movies enthält Array mit Movie-Objekten
    $movies = $em->getRepository('Entities\Movie')->findAll();

    // \Doctrine\Common\Util\Debug::dump($movies);
    // dump($movies);

    $genres = [];
    foreach ($movies as $movie) {
      foreach ($movie->getGenres() as $genre) {
        $genres[$movie->getId()][] = $genre->getName();
      }
    }
    // \Doctrine\Common\Util\Debug::dump($genres);
    // $genres = ["Action","Adventures"…]

    $this->addContext('pageTitle', 'Movieliste');
    $this->addContext('movies', $movies);

    $this->addContext('genres', $genres);
  }

  public function addAction()
  {
    $em = $this->getEntityManager();
    $movie = new Movie();
    $genres = $em->getRepository('Entities\Genre')
      ->findAll();
    if (isset($_POST['title'])) {

      $movie->mapFromArray($_POST);

      $genresIds = $_POST['genres_ids'] ?? [];
      foreach ($genresIds as $id) {
        $genre = $em->getRepository('Entities\Genre')->find($id);
        $movie->addGenre($genre);
      }

      // $validator = $em->getValidator($movie);
      $validator = new \Validators\MovieValidator($em, $movie);
      $validator->validateCsrfToken($this->getTemplate(), $_POST);

      if ($validator->isValid()) {
        $em->persist($movie);
        $em->flush();

        $this->setMessage('Added Movie.');

        // Weiterleitung zur Movie "Index-Seite"
        // header('Location: index.php?controller=movie&action=index');
        // exit;
        // $this->redirect([action], [controller]);
        $this->redirect('index', 'movie');
      }
      $this->addContext('errors', $validator->getErrors());
    }


    $this->addContext('token', getCsrfToken($this->getTemplate()));
    $this->addContext('movie', $movie);
    $this->addContext('genres', $genres);
  }

  public function editAction()
  {

    $em = $this->getEntityManager();
    $movie = $em->getRepository('Entities\Movie')
      ->find((int) $_REQUEST['id']);

    $movie || $this->render404();

    $genres = $em->getRepository('Entities\Genre')
      ->findAll();

    if (isset($_POST['id'])) {
      $movie->mapFromArray($_POST);

      $movie->clearGenres();
      $genresIds = $_POST['genres_ids'] ?? [];
      foreach ($genresIds as $id) {
        $genre = $em->getRepository('Entities\Genre')->find($id);
        $movie->addGenre($genre);
      }
      // Validierung ob neue Daten im Entity in Ordnung sind. tbd.
      // $validator = $em->getValidator($movie);
      $validator = new \Validators\MovieValidator($em, $movie);
      $validator->validateCsrfToken($this->getTemplate(), $_POST);

      if ($validator->isValid()) {
        $em->persist($movie);
        $em->flush();

        $this->setMessage('Updated Movie.');
        $this->redirect('index', 'movie');
      }
      $this->addContext('errors', $validator->getErrors());
    }

    $this->addContext('token', getCsrfToken($this->getTemplate()));
    $this->addContext('movie', $movie);
    $this->addContext('genres', $genres);
  }

  public function deleteAction()
  {
    $em = $this->getEntityManager();
    $movie = $em->getRepository('Entities\Movie')
      ->find((int) $_GET['id']);

    $covers = $movie->getCovers(); // ArrayCollection mit allen zugehörigen Cover-Entity-Objekten

    // var_dump($movie);
    if (isset($_GET['id'])) {

      foreach ($covers as $cover) {
        $em->remove($cover);
      }
      $em->remove($movie);
      $em->flush();
    }

    $this->setMessage('Deleted Movie.');
    $this->redirect('index', 'movie');
  }
}
