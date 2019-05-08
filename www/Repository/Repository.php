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

    /**
     * @var LoggerRepositoryInferface
     */
    private $loggerRepository;

    public function __construct(PDO $PDO, LoggerRepositoryInferface $loggerRepository)
    {
        try {
            $this->pdo = $PDO;
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur SQL : ' . $e->getMessage());
        }
        $this->loggerRepository = $loggerRepository;
    }


    public function getAll(): ?array
    {
        $sql = ' SELECT * FROM ' . $this->table . ';';
        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this->class));
        $query->execute();

        $this->loggerRepository->log($query->queryString, []);


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

        $this->loggerRepository->log($query->queryString, $where);
        return $query->fetch();

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

        $this->loggerRepository->log($query->queryString, $dataObject);
        return $query->execute($dataObject);
    }

}