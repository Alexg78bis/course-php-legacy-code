<?php

declare(strict_types=1);

namespace Repository;

use Core\BaseSQL;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     * @param BaseSQL $baseSQL
     */
    public function __construct(BaseSQL $baseSQL)
    {
        parent::__construct($baseSQL);
    }

}
