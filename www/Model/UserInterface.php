<?php

namespace Model;

use ValueObject\Name;

interface UserInterface
{
    public function setId(int $id): void;

    public function setName(Name $name);

    public function setEmail($email);

    public function setPwd($pwd);

    public function setRole($role);

    public function setStatus($status);

    public function getId(): int;

    public function getName(): Name;

    public function getEmail(): string;

    public function getPwd(): string;

    public function getRole(): int;

    public function getStatus(): int;
}
