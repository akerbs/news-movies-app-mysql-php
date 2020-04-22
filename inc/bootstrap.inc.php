<?php
// Use Composer autoloading
require_once __DIR__ . '/../vendor/autoload.php';

// Get Doctrine entity Manager von Webmaster Europe
use Webmasters\Doctrine\Bootstrap;

$bootstrap = Bootstrap::getInstance();
$em = $bootstrap->getEm();