<?php

namespace Model;

use ValueObject\Credentials;
use ValueObject\Name;

interface UserInterface
{
    // --- --- --- --- SETTER --- --- --- --- \\
    public function setId(int $id): void;

    public function setName(Name $name): void;

    public function setCredentials(Credentials $credentials): void;

    public function setRole($role): void;

    public function setStatus($status): void;


    // --- --- --- --- GETTER --- --- -_- --- \\
    public function getId(): int;

    public function getName(): Name;

    public function getCredentials(): Credentials;

    public function getRole(): int;

    public function getStatus(): int;
}
