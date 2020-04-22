<?php

namespace Controllers;

use Entities\User;

class UserController extends AbstractBase
{
  public function logoutAction()
  {
    logOut(); // unset($_SESSION['user_id']);
    $this->setMessage('User is logged out.');
    $this->redirect('login', 'user');
  }

  public function loginAction()
  {
    $em = $this->getEntityManager();
    if ($_POST) {
      $user = $em->getRepository('Entities\User')
        ->findOneByEmail($_POST['email']);

      if ($user && $user->verifyPasswordHash($_POST['password'])) {


        logIn($user->getId());
        $message = sprintf('User:% s has been logged in.', $user->getUsername());
        $this->setMessage($message);
        $this->redirect('index', 'movie');
      } else {
        $this->addContext('errors', ['Incorrect login data.']);
      }
    }
  }

  public function registerAction()
  {
    $em = $this->getEntityManager();
    $user = new User();

    if ($_POST) {
      // pre_r($_POST);
      // $_POST = [
      //   'id' => 0, 
      //   'firstname' => 'vorname vom Formular',
      //   'lastname' => 'nachname vom Formular',
      //   …
      // ];
      $user->mapFromArray($_POST);

      // $validator = $em->getValidator($user);
      $validator = new \Validators\UserValidator($em, $user);

      if ($validator->isValid()) {
        $em->persist($user);
        $em->flush();

        $this->setMessage('User was created successfully');
        $this->redirect();
      }

      $this->addContext('errors', $validator->getErrors());
    }

    $this->addContext('user', $user);
  }
}
