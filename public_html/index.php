<?php
// Autoload files using composer
require_once '../vendor/autoload.php';
require_once '../src/Controller/UserManagement.php';

use \src\classes\UserManagement;

var_dump($_SERVER['REQUEST_URI']);
die;

//$userManagement = new UserManagement();
//
//var_dump($userManagement->updateUser());

