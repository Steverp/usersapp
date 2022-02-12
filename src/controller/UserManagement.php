<?php

namespace src\classes;

use JetBrains\PhpStorm\Pure;
use src\entity\User;

require_once '../config/DbConnection.php';
require_once '../src/Entity/User.php';

class UserManagement
{
    #[Pure]
    public function __construct(public $dbConnection = new \DbConnection())
    {
    }

    public function getUsers(): array|string
    {
        try{
            $entityManager = $this->dbConnection->getDbConnection();
            $users = $entityManager->getRepository(User::class);
            return $users->findAll();
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }

    public function createUser(): string
    {
        try{
            $entityManager = $this->dbConnection->getDbConnection();
            $userEntity = new User();
            $userEntity->setUserDocument(1233423434);
            $userEntity->setUserEmail('steverpa95@outlook.es');
            $userEntity->setUserCountry('CO');
            $userEntity->setUserPassword('abc1234');

            $entityManager->persist($userEntity);
            $entityManager->flush();
            return "The user was saved correctly {$userEntity->getUserId()}";
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }

    public function updateUser()
    {
        try {
            $entityManager = $this->dbConnection->getDbConnection();
            $userRepo = $entityManager->getRepository(User::class)->find(3);
            $userRepo->setUserPassword('slayer123');
            $entityManager->persist($userRepo);
            $entityManager->flush();
            return "User with ID {$userRepo->getUserId()} was updated";
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }

    public function deleteUser()
    {
        try{
            $entityManager = $this->dbConnection->getDbConnection();
            $userRepo = $entityManager->getRepository(User::class)->find(1);
            $userId = $userRepo->getUserId();
            $entityManager->remove($userRepo);
            $entityManager->flush();
            return "The user with ID {$userId} was removed";
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }
}