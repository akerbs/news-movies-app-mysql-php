<?php

require_once 'inc/functions.inc.php';
require_once 'inc/helper.inc.php';
require_once 'inc/bootstrap.inc.php';

use Controllers\IndexController;

// require_once 'vendor/autoload.php'; // Autoload wird in der bootstrap-Datei aufgerufen
// require_once 'src/Controllers/AbstractBase.php';
// require_once 'src/Controllers/IndexController.php';
// require_once 'src/Controllers/MovieController.php';
// require_once 'src/Entities/Movie.php';

// Session needed
session_start();

// Pfad von unserem Projekthauptverzeichnis
$basePath = dirname(__FILE__);


$controller = $_GET['controller'] ?? 'index';
$controller = preg_replace('/[^a-z]/', '', $controller);

$action = $_GET['action'] ?? 'index';
$action = preg_replace('/[^a-z]/', '', $action);


// Pfad mit Namespace von der passenden Controller-Klasse zusammenstellen.
$controllerNamespace = 'Controllers\\';
$controllerName = $controllerNamespace . ucfirst($controller) . 'Controller';
// z.B. Controllers\IndexController

// echo $controllerName;
// echo "<hr>";
// echo $basePath;
// echo "<hr>";

if (class_exists($controllerName)) {
  $requestController = new $controllerName($basePath, $em);
  $requestController->run($action);
} else {
  $requestController = new IndexController($basePath, $em);
  $requestController->render404();
}
