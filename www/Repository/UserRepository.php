<?php

declare(strict_types=1);

namespace Repository;

use Model\UserInterface;
use PDO;
use ValueObject\Name;

final class UserRepository extends Repository implements UserRepositoryInterface
{
    public function __construct(PDO $PDO, LoggerRepositoryInferface $loggerRepository, UserInterface $user)
    {
        parent::__construct($PDO, $loggerRepository);
        $this->table = 'Users';
        $this->class = $user;
    }

    public function add(UserInterface $user): bool
    {
        $dataObject = $this->getDataObject($user);
        return $this->addToDatabase($dataObject);
    }

    // overide function to type the returned value
    public function getOneBy(array $where): UserInterface
    {
        $userData = parent::getOneBy($where);
        return $this->castUser($userData);
    }

    private function castUser($userData): UserInterface
    {
        $user = $this->class;
        $name = new Name($userData['firstname'] ?? '', $userData['lastname'] ?? '');
        $user->setName($name);
        $user->setEmail($userData['email'] ?? '');
        $user->setPwd($userData['pwd'] ?? '');
        $user->setRole($userData['role'] ?? 0);
        $user->setStatus($userData['status'] ?? 0);

        return $user;
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function getDataObject(UserInterface $user): array
    {
        return [
            'id' => $user->getId(),
            'firstname' => $user->getName()->getFirstname(),
            'lastname' => $user->getName()->getLastname(),
            'email' => $user->getEmail(),
            'pwd' => $user->getPwd(),
            'role' => $user->getRole(),
            'status' => $user->getStatus(),
        ];
    }
}


