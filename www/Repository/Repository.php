<?php
declare(strict_types=1);


namespace Repository;


use Core\BaseSQL;

class Repository implements RepositoryInterface
{
    private $baseSQL;

    public function __construct(BaseSQL $baseSQL)
    {
        $this->baseSQL = $baseSQL;
    }

    public function getOne()
    {
        // TODO: Implement getOne() method.
    }

    public function getAll(): array
    {
        return [];
    }

    public function getOneBy(string $needle, string $where)
    {
        // TODO: Implement getOneBy() method.
    }

    public function getAllBy(string $needle, string $where): array
    {
        // TODO: Implement getAllBy() method.
        return [];
    }

    public function add($object): bool
    {
        return $this->baseSQL->save($object);
    }
}