<?php

declare(strict_types=1);

namespace Repository;

use Model\UserInterface;

interface RepositoryInterface
{
    public function getAll(): ?array;

    public function getOneBy(array $where);

    public function add(UserInterface $user): bool;
}
