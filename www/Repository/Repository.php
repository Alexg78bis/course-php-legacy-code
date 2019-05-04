<?php
declare(strict_types=1);


namespace Repository;


use http\Exception;
use PDO;

abstract class Repository implements RepositoryInterface
{

    private $pdo;
    protected $table;


    public function __construct(PDO $PDO)
    {

        try {
            $this->pdo = $PDO;
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur SQL : ' . $e->getMessage());
        }

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
        $dataObject = get_object_vars($object);

        if (is_null($dataObject['id'])) {

            $sql = 'INSERT INTO ' . $this->table . ' ( ' .
                implode(',', array_keys($dataObject)) . ') VALUES ( :' .
                implode(',:', array_keys($dataObject)) . ')';

            $query = $this->pdo->prepare($sql);

            $query->execute($dataObject);
        } else {
            $sqlUpdate = [];
            foreach ($dataObject as $key => $value) {
                if ('id' != $key) {
                    $sqlUpdate[] = $key . '=:' . $key;
                }
            }

            $sql = 'UPDATE ' . $this->table . ' SET ' . implode(',', $sqlUpdate) . ' WHERE id=:id';

            $query = $this->pdo->prepare($sql);
            return $query->execute($dataObject);
        }

        return false;

    }


}