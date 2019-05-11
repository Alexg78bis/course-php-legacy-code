<?php

declare(strict_types=1);

namespace Repository;

use Model\UserInterface;
use PDO;
use ValueObject\Account;
use ValueObject\Credentials;
use ValueObject\Email;
use ValueObject\Name;
use ValueObject\Password;

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

    public function castUser($userData): UserInterface
    {
        $user = clone $this->class;

        $name = new Name($userData['firstname'] ?? '', $userData['lastname'] ?? '');
        $email = new Email($userData['email']);
        $password = new Password($userData['pwd']);
        $credentials = new Credentials($email, $password);
        $account = new Account($credentials, (int)($userData['role'] ?? '1'));

        $user->setId((int)($userData['id'] ?? '0'));
        $user->setName($name);
        $user->setAccount($account);
        $user->setStatus((int)($userData['status'] ?? '0'));

        return $user;
    }

    private function getDataObject(UserInterface $user): array
    {
        return [
            'id' => $user->getId(),
            'firstname' => $user->getName()->getFirstname(),
            'lastname' => $user->getName()->getLastname(),
            'email' => $user->getAccount()->getCredentials()->getEmail(),
            'pwd' => $user->getAccount()->getCredentials()->getPassword(),
            'role' => $user->getAccount()->getRole(),
            'status' => $user->getStatus(),
        ];
    }
}
