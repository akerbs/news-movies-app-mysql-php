<?php

namespace Controllers;

use Doctrine\ORM\EntityManager;

abstract class AbstractBase
{
  protected $basePath;
  protected $context = [];
  protected $template = '';
  protected $em;

  public function __construct($basePath = '', EntityManager $em)
  {
    $this->basePath = $basePath;
    $this->em = $em;
  }

  public function run($action)
  {

    $this->addContext('action', $action);
    // echo 'run:'. $this->basePath;
    $methodName = $action . 'Action'; // z.B. deleteAction

    $this->setTemplate($methodName);

    if (method_exists($this, $methodName)) {
      $this->$methodName();
    } else {
      $this->render404();
    }
    $this->render();
  }

  protected function getEntityManager()
  {
    return $this->em;
  }

  protected function getTemplate()
  {
    return $this->template;
  }

  protected function setTemplate($template, $templateFolder = null)
  {

    if (empty($templateFolder)) {
      //z.B. IndexTemplate | MovieTemplate
      $templateShortName = $this->getTemplateShortName();
    } else {
      $templateShortName = $templateFolder; // z.B. MovieTemplate
    }

    $this->template = $templateShortName . '/' . $template . '.tpl.php';
    // z.B. MovieTemplate/indexAction.tpl.php; 
  }

  protected function getTemplateShortName()
  {
    // Klassenname mit Namespace
    // z.B. Controllers\MovieController
    $className = get_class($this);
    $className = preg_replace('/^([A-Za-z]+\\\)+/', '', $className); // i.e. MovieController

    // Alternative 
    // $className =  (new \ReflectionClass($this))->getShortName();

    return str_replace('Controller', 'Template', $className);
  }

  protected function getMessage()
  {
    $message = false;
    if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
      // Message--Sessioneintrag wird gelöscht
      unset($_SESSION['message']);
    }

    return $message;
  }

  protected function setMessage($message)
  {
    $_SESSION['message'] = $message;
  }

  protected function addContext($key, $value)
  {
    $this->context[$key] = $value;
  }

  public function render404()
  {
    header('HTTP/1.0 404 Not Found');
    die('Error 404');
  }

  protected function redirect($action = null, $controller = null)
  {
    $params = [];
    $to = '';

    if (!empty($controller)) {
      $params[] = 'controller=' . $controller;
    } // z.B. => ["controller=movie"];

    if (!empty($action)) {
      $params[] = 'action=' . $action;
    } // z.B. => ["controller=movie", "action=index"]

    if (!empty($params)) {
      $to = '?' . implode('&', $params);
    } // z.B. => ?controller=movie&action=index

    header('Location: index.php' . $to);
    exit;
  }

  protected function render()
  {
    $context = $this->context;

    // aus:
    // $context = [
    //  'action' => 'index',
    //   'pageTitle' => 'Startseite',
    //   'welcomeText' => 'Hello People.',
    //   'text' => 'lorem ipsum',
    //   'movies' => [ ['id'=>1, 'title'='Filmname'], […]]
    // ];

    extract($context);

    // wird: 
    // $action = 'index';
    // $pageTitle = 'Startseite'
    // $welcomeText = 'Hello People.'
    // $text = 'lorem ipsum';
    // $movies =  [ ['id'=>1, 'title'='Filmname'], […]]
    // $movie = Entities\Movie

    $message = $this->getMessage();
    $template = $this->getTemplate();

    require_once $this->basePath . '/templates/layout.tpl.php';
  }
}
