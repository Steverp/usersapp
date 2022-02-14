<?php

// Load our autoloader
require_once __DIR__.'/vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Specify our Twig templates location
$loader = new FilesystemLoader(__DIR__.'/public_html/templates');

// Instantiate our Twig
$twig = new Environment($loader);