<?php

declare(strict_types=1);

namespace ValueObject;

use Error;

class Password
{
    /**
     * @var string
     */
    private $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public static function hash(string $password): self
    {
        if (!Password::validate($password)) {
            throw new Error('Le mot de passe doit faire au minimum 6 caractères avec des minuscules, majuscules et chiffres');
        }
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        return new Password($passwordHashed);
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public static function validate(string $password): bool
    {
        return preg_match('#[a-z]#', $password)
            && preg_match('#[A-Z]#', $password)
            && preg_match('#[0-9]#', $password);
    }

    public function __toString(): string
    {
        return $this->password;
    }
}
