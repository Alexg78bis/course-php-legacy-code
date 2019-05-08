<?php
declare(strict_types=1);

namespace Repository;

use http\Exception;
use PDO;

abstract class Repository implements RepositoryInterface
{
    private $pdo;
    protected $table;
    protected $class;

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

    public function getAll(): ?array
    {
        $sql = ' SELECT * FROM ' . $this->table . ';';
        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this->class));
        $query->execute();

        $this->log($sql, []);


        return $query->fetchAll();
    }

    public function getOneBy(array $where)
    {

        $sqlWhere = [];
        foreach ($where as $key => $value) {
            $sqlWhere[] = $key . '=:' . $key;
        }
        $sql = ' SELECT * FROM ' . $this->table . ' WHERE  ' . implode(' AND ', $sqlWhere) . ';';
        $query = $this->pdo->prepare($sql);

        $query->setFetchMode(PDO::FETCH_INTO, $this->class);


        $query->execute($where);


        return $query->fetch();

    }

    public function getAllBy(array $where): array
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
        } else {
            $sqlUpdate = [];
            foreach ($dataObject as $key => $value) {
                if ('id' != $key) {
                    $sqlUpdate[] = $key . '=:' . $key;
                }
            }

            $sql = 'UPDATE ' . $this->table . ' SET ' . implode(',', $sqlUpdate) . ' WHERE id=:id';

            $query = $this->pdo->prepare($sql);

        }

        $this->log($query->queryString, $dataObject);
        return $query->execute($dataObject);
    }


    private function log(string $sql, array $params): void
    {
        $_SESSION['sqlHistory'][] = [
            'page' => explode('\\', get_called_class())[1],
            'sql' => $sql,
            'params' => $params,
        ];
    }
}