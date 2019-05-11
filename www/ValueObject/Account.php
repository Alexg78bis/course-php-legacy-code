<?php
declare(strict_types=1);

namespace ValueObject;

class Account
{

    /**
     * @var Credentials
     */
    private $credentials;
    /**
     * @var int
     */
    private $role;

    public function __construct(Credentials $credentials, int $role = 1)
    {
        $this->credentials = $credentials;
        $this->role = $role;
    }

    /**
     * @return Credentials
     */
    public function getCredentials(): Credentials
    {
        return $this->credentials;
    }

    /**
     * @param Credentials $credentials
     */
    public function setCredentials(Credentials $credentials): void
    {
        $this->credentials = $credentials;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return (int)$this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }


}