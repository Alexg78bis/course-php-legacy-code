<?php

declare(strict_types=1);

namespace Repository;

interface RepositoryInterface
{
    public function getOne();

    public function getAll(): array;

    public function getOneBy(string $needle, string $where);

    public function getAllBy(string $needle, string $where): array;

    public function add($object): bool;
}
