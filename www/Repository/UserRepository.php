<?php

declare(strict_types=1);

namespace Repository;

use Model\UserInterface;
use PDO;

final class UserRepository extends Repository implements UserRepositoryInterface
{
    public function __construct(PDO $PDO, UserInterface $user)
    {
        parent::__construct($PDO);
        $this->table = 'Users';
        $this->class = $user;
    }

    public function getOneBy(array $where): ?UserInterface // overide function to type the returned value
    {
        return parent::getOneBy($where);
    }


}


