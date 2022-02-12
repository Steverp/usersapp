<?php
// Autoload files using composer
require_once '../vendor/autoload.php';
require_once '../src/Controller/UserManagement.php';
require_once '../src/Controller/CustomerData.php';

use \src\classes\UserManagement;
use \src\classes\CustomerData;

$valueToFilter= $_POST['valueToFilter'];

$customer = new CustomerData();

$userId = $customer->getOneCustomer($valueToFilter);
var_dump($userId); die;

//$userManagement = new UserManagement();
//
//var_dump($userManagement->updateUser());

