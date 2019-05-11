<?php

declare(strict_types=1);

namespace Repository;

interface LoggerRepositoryInferface
{
    public function log(string $sql, array $params): void;
}
