<?php
declare(strict_types=1);


namespace ValueObject;


use Error;

class Email
{
    /**
     * @var string
     */
    private $email;
    private $regex = '/^[a-z.0-9]+@[a-z]+.[a-z.]+$/m';

    public function __construct(string $email)
    {
        if (!preg_match($this->regex, $email)) {
            throw new Error('Bad email address format');
        }

        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }

}