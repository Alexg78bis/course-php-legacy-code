<?php

namespace Models;


interface UserForm
{
    public function getRegisterForm();

    public function getLoginForm();
}