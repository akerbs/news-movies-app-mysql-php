<?php

// MySQL database configuration
$connectionOptions = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'root', // in XAMPP ''
    'dbname' => 'news_movies'
];



// Application/Doctrine configuration
$applicationOptions = [
    'debug_mode' => true, // in production environment false
];

