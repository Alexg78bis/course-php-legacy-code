<?php

declare(strict_types=1);

namespace ValueObject;

class Credentials
{
    private $email;
    private $password;

    /**
     * credentials constructor.
     *
     * @param $email
     * @param $password
     */
    public function __construct(Email $email, Password $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }
}
