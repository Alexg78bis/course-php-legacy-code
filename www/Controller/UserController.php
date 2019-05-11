<?php

declare(strict_types=1);

namespace Controller;

use Core\View;
use Model\UserInterface;
use Repository\UserRepository;

class UserController
{
    private $user;
    private $userRepository;

    public function __construct(UserInterface $user, UserRepository $userRepository)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    public function defaultAction(): void
    {
        echo 'users default';
    }

    public function listAction(): void
    {
        $users = $this->userRepository->getAll();

        $view = new View('listUsers', 'back');
        $view->assign('users', $users);
    }
}
