<?php

namespace Helpers;

use src\classes\CustomerData;
use src\classes\UserAuthProcess;
use src\classes\UserManagement;

require_once '../src/Controller/UserAuthProcess.php';
require_once '../src/Controller/CustomerData.php';
require_once '../src/Controller/UserManagement.php';

class InternalService
{

    public function chooseController($chosenController): CustomerData|UserManagement|UserAuthProcess
    {
        return match($chosenController){
            'userManagement' => new UserManagement(),
            'customerRequest' => new CustomerData(),
            'UserAuthProcess' => new UserAuthProcess(),
        };
    }

    public function validateForm($userInformation)
    {
        try{
            $formErrors = [];

            if(strlen($userInformation['userName']) < 3){
                $formErrors[] = 'The username must be at least 3 letters';
            }

            if (!filter_var($userInformation['userEmail'], FILTER_VALIDATE_EMAIL)) {
                $formErrors[] = 'The email address is invalid';
            }

            if (!preg_match('~[0-9]+~', $userInformation['userPassword'])) {
                $formErrors[] = 'THe password must include at least a number';
            }

            if (empty($userInformation['userCountry'])) {
                $formErrors[] = 'THe country is required';
            }

            return $formErrors;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

}