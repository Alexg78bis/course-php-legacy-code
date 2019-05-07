<?php

declare(strict_types=1);

namespace Repository;

use Model\UserInterface;
use PDO;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function __construct(PDO $PDO, UserInterface $user);
}
