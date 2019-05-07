<?php

namespace Model;

interface UserInterface
{
    public function setFirstname($firstname);

    public function setLastname($lastname);

    public function setEmail($email);

    public function setPwd($pwd);

    public function setRole($role);

    public function setStatus($status);

    public function getId(): int;

    public function getFirstname(): string;

    public function getLastname(): string;

    public function getEmail(): string;

    public function getPwd(): string;

    public function getRole(): int;

    public function getStatus(): int;
}
