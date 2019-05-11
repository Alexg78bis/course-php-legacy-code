<?php
declare(strict_types=1);

namespace Model;

use ValueObject\Credentials;
use ValueObject\Name;

class User implements UserInterface
{
    private $id = null;
    private $name;
    private $credentials;
    private $role = 1;
    private $status = 0;

    // --- --- --- --- SETTER --- --- --- --- \\

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
    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $credentials
     */
    public function setCredentials(Credentials $credentials): void
    {
        $this->credentials = $credentials;
    }

    /**
     * @param $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @param $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }



    // --- --- --- --- GETTER --- --- --- --- \\

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCredentials(): Credentials
    {
        return $this->credentials;
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
