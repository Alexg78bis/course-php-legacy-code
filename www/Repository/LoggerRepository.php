<?php
declare(strict_types=1);


namespace Repository;


class LoggerRepository implements LoggerRepositoryInferface
{
    public function log(string $sql, array $params): void
    {
        $_SESSION['sqlHistory'][] = [
            'page' => explode('\\', get_called_class())[1],
            'sql' => $sql,
            'params' => $params,
        ];
    }
}