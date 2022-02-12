<?php

namespace src\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $user_id;
    /**
     * @ORM\Column(type="string")
     */
    protected int $user_document;
    /**
     * @ORM\Column(type="string")
     */
    protected string $user_email;

    /**
     * @ORM\Column(type="string")
     */
    protected string $user_country;

    /**
     * @ORM\Column(type="string")
     */
    protected string $user_password;

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->user_password;
    }

    /**
     * @param string $user_password
     */
    public function setUserPassword(string $user_password): void
    {
        $this->user_password = $user_password;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUserDocument()
    {
        return $this->user_document;
    }

    /**
     * @param mixed $user_document
     */
    public function setUserDocument($user_document): void
    {
        $this->user_document = $user_document;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email): void
    {
        $this->user_email = $user_email;
    }

    /**
     * @return mixed
     */
    public function getUserCountry()
    {
        return $this->user_country;
    }

    /**
     * @param mixed $user_country
     */
    public function setUserCountry($user_country): void
    {
        $this->user_country = $user_country;
    }




}