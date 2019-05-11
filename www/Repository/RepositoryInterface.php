<?php

declare(strict_types=1);

namespace Repository;

interface RepositoryInterface
{
    public function getAll(): ?array;

    public function getOneBy(array $where);
}
