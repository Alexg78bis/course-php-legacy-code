<?php
declare(strict_types=1);

namespace Model;

use ValueObject\Account;
use ValueObject\Name;

/**
 * Class User
 * An User have
 * - a name,
 * - status
 * - account
 *   - role
 *   - credentials
 *     - email
 *     - password
 *
 * @package Model
 */
class User implements UserInterface
{
    private $id = null;
    private $name;
    private $account;
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
     * @param mixed $account
     */
    public function setAccount(Account $account): void
    {
        $this->account = $account;
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
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

}
