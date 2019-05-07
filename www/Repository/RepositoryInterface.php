<?php

declare(strict_types=1);

namespace Repository;

interface RepositoryInterface
{

    public function getOne();

    public function getAll(): array;

    public function getOneBy(array $where);

    public function getAllBy(array $where): array;

    public function add($object): bool;
}
