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
}
