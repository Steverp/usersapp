<?php

namespace src\classes;

use JetBrains\PhpStorm\Pure;
use src\entity\User;
use Interface\UserManagementInterface;
use config\DbConnection;
use Helpers\InternalService;

require_once '../config/DbConnection.php';
require_once '../src/Entity/User.php';
require_once '../src/Interface/UserManagementInterface.php';
require_once '../src/Helpers/InternalService.php';

class UserManagement implements UserManagementInterface
{
    #[Pure]
    public function __construct(
        public $dbConnection = new DbConnection(),
        public $internalService = new InternalService()
    )
    {
    }

    public function getUsers(): array|string
    {
        try {
            $entityManager = $this->dbConnection->getDbConnection();
            $users = $entityManager->getRepository(User::class);
            return $users->findAll();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function createUser($userToRegister): string|array
    {
        try {
            $entityManager = $this->dbConnection->getDbConnection();

            $userName = $userToRegister['userName'];
            $documentNumber = $userToRegister['documentNumber'];
            $userEmail = $userToRegister['userEmail'];
            $userCountry = $userToRegister['userCountry'];
            $userPassword = $userToRegister['userPassword'];

            $userExists = $entityManager->createQueryBuilder()
                ->select('u')->from(User::class, 'u')
                ->where('u.user_document = :userDocument')->orWhere('u.user_email = :userEmail')
                ->setParameter('userDocument', $documentNumber)->setParameter('userEmail', $userEmail)
                ->getQuery()->getResult();

            $responseArray = [];

            if (!empty($userExists)) {
                $validatedFieldsArray[] = "The user already exists";
                return [
                    'message' => 'There were some issues with the data(Email or document)',
                    'errors' => $validatedFieldsArray
                ];
            }

            $validatedFieldsArray = $this->internalService->validateForm($userToRegister);

            if (count($validatedFieldsArray) == 0) {
                $userEntity = new User();
                $userEntity->setUserName($userName);
                $userEntity->setUserDocument($documentNumber);
                $userEntity->setUserEmail($userEmail);
                $userEntity->setUserCountry($userCountry);
                $userEntity->setUserPassword(password_hash($userPassword, PASSWORD_DEFAULT));

                $entityManager->persist($userEntity);
                $entityManager->flush();

                $responseArray = [
                    'message' => "The user was saved correctly {$userEntity->getUserId()}",
                    'errors' => []
                ];
            } else {
                $responseArray = [
                    'message' => 'There were some issues with the data',
                    'errors' => $validatedFieldsArray
                ];
            }

            return $responseArray;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updateUser(): string
    {
        try {
            $entityManager = $this->dbConnection->getDbConnection();
            $userRepo = $entityManager->getRepository(User::class)->find(3);
            $userRepo->setUserPassword('slayer123');
            $entityManager->persist($userRepo);
            $entityManager->flush();
            return "User with ID {$userRepo->getUserId()} was updated";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteUser(): string
    {
        try {
            $entityManager = $this->dbConnection->getDbConnection();
            $userRepo = $entityManager->getRepository(User::class)->find(1);
            $userId = $userRepo->getUserId();
            $entityManager->remove($userRepo);
            $entityManager->flush();
            return "The user with ID {$userId} was removed";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}