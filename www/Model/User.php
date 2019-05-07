<?php

declare(strict_types=1);

namespace Model;

class User implements UserInterface
{
    public $id = null;
    public $firstname;
    public $lastname;
    public $email;
    public $pwd;
    public $role = 1;
    public $status = 0;

    public function setFirstname($firstname)
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    public function setLastname($lastname)
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    public function setEmail($email)
    {
        $this->email = strtolower(trim($email));
    }

    public function setPwd($pwd)
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return null
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }


}
