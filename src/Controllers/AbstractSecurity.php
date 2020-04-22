<?php

namespace Controllers;

abstract class AbstractSecurity extends AbstractBase
{
  public function run($action)
  {

    if (!isLoggedIn() && in_array($action, ['index', 'edit', 'add', 'delete'])) {
      $this->setMessage('Please sign in.');
      $this->redirect('login', 'user');
    }

    parent::run($action);
  }
}
