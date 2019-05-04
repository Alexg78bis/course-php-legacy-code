<?php

declare(strict_types=1);

namespace Core;

use http\Exception;
use PDO;

class BaseSQL
{
    private $pdo;
    private $table;

    public function __construct(string $host, string $driver, string $name, string $user, string $password, $class)
    {
        try {
            $this->pdo = new PDO($driver . ':host=' . $host . ';dbname=' . $name, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur SQL : ' . $e->getMessage());
        }

        $this->table = substr(get_class($class), strrpos(get_class($class), '\\') + 1);
    }

    public function setId($id): self
    {
        $this->id = $id;
        $this->getOneBy(['id' => $id], true);

        return $this;
    }

    /**
     * @param array $where the where clause
     * @param bool $object if it will return an array of results ou an object
     *
     * @return mixed
     */
    public function getOneBy(array $where, $object = false)
    {
        $sqlWhere = [];
        foreach ($where as $key => $value) {
            $sqlWhere[] = $key . '=:' . $key;
        }
        $sql = ' SELECT * FROM ' . $this->table . ' WHERE  ' . implode(' AND ', $sqlWhere) . ';';
        $query = $this->pdo->prepare($sql);

        if ($object) {
            $query->setFetchMode(PDO::FETCH_INTO, $this);
        } else {
            $query->setFetchMode(PDO::FETCH_ASSOC);
        }

        $query->execute($where);

        return $query->fetch();
    }

    public function save($object): bool
    {


        $dataObject = get_object_vars($object);
        $dataChild = array_diff_key($dataObject, get_class_vars(get_class()));

        if (is_null($dataChild['id'])) {

            $sql = 'INSERT INTO ' . $this->table . ' ( ' .
                implode(',', array_keys($dataChild)) . ') VALUES ( :' .
                implode(',:', array_keys($dataChild)) . ')';

            $query = $this->pdo->prepare($sql);
            $query->execute($dataChild);
        } else {
            $sqlUpdate = [];
            foreach ($dataChild as $key => $value) {
                if ('id' != $key) {
                    $sqlUpdate[] = $key . '=:' . $key;
                }
            }

            $sql = 'UPDATE ' . $this->table . ' SET ' . implode(',', $sqlUpdate) . ' WHERE id=:id';

            $query = $this->pdo->prepare($sql);
            return $query->execute($dataChild);
        }

        return false;
    }
}
