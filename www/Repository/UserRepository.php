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

    public function getAll(): ?array
    {
        $usersData = parent::getAll();
        $users = [];
        foreach ($usersData as $userData) {
            $users[] = $this->castUser($userData);
        }
        return $users;
    }

    public function getOneBy(array $where): UserInterface
    {
        $userData = parent::getOneBy($where);
        return $this->castUser($userData);
    }


    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    private function castUser($userData): UserInterface
    {
        $className = get_class($this->class);
        $user = new $className;
        $user->setId((int)$userData['id'] ?? 0);
        $name = new Name($userData['firstname'] ?? '', $userData['lastname'] ?? '');
        $user->setName($name);
        $user->setEmail($userData['email'] ?? '');
        $user->setPwd($userData['pwd'] ?? '');
        $user->setRole((int)$userData['role'] ?? 0);
        $user->setStatus((int)$userData['status'] ?? 0);

        return $user;
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