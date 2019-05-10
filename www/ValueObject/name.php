<?php
declare(strict_types=1);

namespace ValueObject;

class Name
{
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;

    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return `{$this->lastname} {$this->firstname}`;
    }


}