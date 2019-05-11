<?php
declare(strict_types=1);

namespace Model;

use ValueObject\Name;

class User implements UserInterface
{
    private $id = null;
    private $name;
    private $email;
    private $pwd;
    private $role = 1;
    private $status = 0;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param Name $name
     */
    public function setName(Name $name)
    {
        $this->name = $name;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @param $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }

    /**
     * @param $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    public function getName(): Name
    {
        return $this->name;
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
