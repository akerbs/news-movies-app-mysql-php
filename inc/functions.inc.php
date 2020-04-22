<?php

function logIn($id)
{
  $_SESSION['user_id'] = $id;
}

function isLoggedIn()
{
  return (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']));
}

function logOut()
{
  unset($_SESSION['user_id']);
}

function getCsrfToken($template)
{
  $nonce = bin2hex(random_bytes(64));

  if (empty($_SESSION['csrf_tokens'])) {
    $_SESSION['csrf_tokens'] = [];
  }

  $_SESSION['csrf_tokens'][$nonce] = $template;

  // z.B.
  // $_SESSION[
  //   'csrf_tokens' => 
  //   [
  //     '234wd3452354…' => 'MovieTemplate/editAction.tpl.php',
  //     '234wd3452354…' => 'MovieTemplate/addAction.tpl.php',
  //   ] 
  // ]
  return $nonce;
}

function isValidateCsrfToken($token, $template)
{
  $valid = false;
  if (isset($_SESSION['csrf_tokens'][$token])) {
    if ($_SESSION['csrf_tokens'][$token] === $template) {
      $valid = true;
    }
    unset($_SESSION['csrf_tokens'][$token]);
  }

  return $valid;
}
