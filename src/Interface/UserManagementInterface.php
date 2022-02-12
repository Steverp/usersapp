<?php

namespace Interface;

interface UserManagementInterface
{

    public function getUsers(): array|string;

    public function createUser(): string;

    public function updateUser(): string;

    public function deleteUser(): string;

}