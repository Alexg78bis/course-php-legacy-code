<?php

declare(strict_types=1);

namespace Repository;

use Model\UserInterface;
use PDO;

final class UserRepository extends Repository implements UserRepositoryInterface
{
    public function __construct(PDO $PDO, LoggerRepositoryInferface $loggerRepository, UserInterface $user)
    {
        parent::__construct($PDO, $loggerRepository);
        $this->table = 'Users';
        $this->class = $user;
    }

    public function getOneBy(array $where): ?UserInterface // overide function to type the returned value
    {
        return parent::getOneBy($where);
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

}


