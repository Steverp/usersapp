<?php

namespace src\classes;

use src\entity\User;
use config\DbConnection;

require_once '../config/DbConnection.php';
require_once '../src/Entity/User.php';

class UserAuthProcess extends DbConnection
{
    public function __construct(
        public String $responseMessage = '',
        public int $statusCode = 0,
        public array $arrayResponse = [])
    {
    }

    public function loginUser(array $userData): array|string
    {
        try{
            $this->responseMessage = 'The login information was incorrect';
            $this->statusCode = 412;

            $userRepo = $this->getDbConnection()->getRepository(User::class)->findOneBy([
                'user_email' => $userData['userEmail']
            ]);

            if(!empty($userRepo)){
                if(password_verify($userData['userPassword'], $userRepo->getUserPassword())){
                    $_SESSION['userLogged'] = true;
                    $_SESSION['userEmail'] = $userRepo->getUserEmail();

                    $this->responseMessage = "Welcome {$userRepo->getUserEmail()}";
                    $this->statusCode = 200;
                }
            }

            $this->arrayResponse['statusCode'] = $this->statusCode;
            $this->arrayResponse['responseMessage'] = $this->responseMessage;

            return $this->arrayResponse;

        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }

    public function logout(){
        session_start();
        session_destroy();
    }
}