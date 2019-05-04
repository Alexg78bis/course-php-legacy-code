<?php

declare(strict_types=1);

namespace Repository;

use Core\BaseSQL;

interface UserRepositoryInterface
{
    /**
     * UserRepositoryInterface constructor.
     * @param BaseSQL $baseSQL
     */
    public function __construct(BaseSQL $baseSQL);

}
