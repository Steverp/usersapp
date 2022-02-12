<?php
// Autoload files using composer
require_once '../vendor/autoload.php';
require_once '../src/controller/UserManagement.php';

use \src\classes\UserManagement;

$userManagement = new UserManagement();

var_dump($userManagement->updateUser());

