<?php

namespace Interface;

interface UserManagementInterface
{

    public function getUsers(): array|string;

    public function createUser($userToRegister): string|array;

    public function updateUser(): string;

    public function deleteUser(): string;

}