<?php

namespace Model;

use ValueObject\Account;
use ValueObject\Name;

interface UserInterface
{
    // --- --- --- --- SETTER --- --- --- --- \\
    public function setId(int $id): void;

    public function setName(Name $name): void;

    public function setAccount(Account $account): void;

    public function setStatus($status): void;


    // --- --- --- --- GETTER --- --- -_- --- \\
    public function getId(): int;

    public function getName(): Name;

    public function getAccount(): Account;

    public function getStatus(): int;
}
