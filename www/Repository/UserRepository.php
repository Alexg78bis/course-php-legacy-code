<?php

declare(strict_types=1);

namespace Repository;

use PDO;

final class UserRepository extends Repository implements UserRepositoryInterface
{
    public function __construct(PDO $PDO)
    {
        parent::__construct($PDO);
        $this->table = 'Users';
    }
}