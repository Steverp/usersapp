<?php

require_once '../bootstrap.php';
require_once '../src/Controller/UserAuthProcess.php';
require_once '../src/Controller/CustomerData.php';
require_once '../src/Controller/UserManagement.php';
require_once '../src/Helpers/InternalService.php';

session_start();

$request = $_SERVER['REQUEST_URI'];

$internalService = new \Helpers\InternalService();

switch ($request) {
    case '/' :
        try{
            if(isset($_SESSION['userLogged'])){
                echo $twig->render('userslist.html.twig');
            }else{
                header('location:/login-form');
            }
        }catch(Throwable $th){
            echo $th->getMessage();
        }

        break;
    case '/login-form' :
        try{
            if(!isset($_SESSION['userLogged'])){
                echo $twig->render('login.html.twig');
            }else{
                header('location:/users-home');
            }
        }catch(Throwable $th){
            echo $th->getMessage();
        }
        break;
    case '/login-user' :
        try {
            $userData = [];
            $userData['userEmail'] = $_POST['userEmail'];
            $userData['userPassword'] = $_POST['userPassword'];

            $internalService->chooseController('UserAuthProcess')->loginUser($userData);
            header('location:/users-home');
        } catch (Throwable $th) {
            echo $th->getMessage();
        }

        break;
    case '/users-home':
        $userData = [];
        $userData['userEmail'] = $_SESSION['userEmail'];
        $userData['userLogged'] = $_SESSION['userLogged'];
        if($userData['userLogged']){
            if ($_SESSION['userLogged']) {
                $userData['customersList'] = (!isset($_SESSION['customersList']) ? $internalService->chooseController('customerRequest')->getCustomers()['objects'] : $_SESSION['customersList']['objects']);
            }

            echo $twig->render('userslist.html.twig', ['userData' => $userData]);
        }else{
            header('location:/');
        }


        break;
    case '/register' :
        $countries = $internalService->chooseController('customerRequest')->getAllCountries();

        echo $twig->render('register.html.twig', ['countries' => $countries]);
        break;
    case '/register-user' :
        $registerUser = $internalService->chooseController('userManagement')->createUser($_POST);

        if(count($registerUser['errors']) > 0){
            echo $twig->render('register.html.twig', ['countries' => $_SESSION['countries'], 'errors' => $registerUser['errors']]);
        }
        break;
    case '/logout' :
        $internalService->chooseController('UserAuthProcess')->logout();
        header('location:/');
        break;
    case '/search-customer' :
        $individualUser = $internalService->chooseController('customerRequest')->getOneCustomer($_POST);
        echo $twig->render('customerInfo.html.twig', ['individualUser' => $individualUser, 'userData' => $_SESSION['userLogged']]);
        break;
    default:
        http_response_code(404);
        require './404.php';
        break;
}