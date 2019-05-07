<?php

declare(strict_types=1);

namespace Controller;

use Core\Validator;
use Core\View;
use Model\UserForm;
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

    public function addAction(): void
    {
        $userForm = new UserForm();
        $form = $userForm->getRegisterForm();

        $v = new View('addUser', 'front');
        $v->assign('form', $form);
    }

    public function saveAction(): void
    {
        $userForm = new UserForm();
        $form = $userForm->getRegisterForm();
        $method = strtoupper($form['config']['method']);
        $data = $GLOBALS['_' . $method];

        if ($_SERVER['REQUEST_METHOD'] == $method && !empty($data)) {
            $validator = new Validator($form, $data);
            $form['errors'] = $validator->errors;

            if (empty($errors)) {
                $this->user->setFirstname($data['firstname']);
                $this->user->setLastname($data['lastname']);
                $this->user->setEmail($data['email']);
                $this->user->setPwd($data['pwd']);
                $this->userRepository->add($this->user);
            }
        }

        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }



    public function forgetPasswordAction(): void
    {
        $v = new View('forgetPasswordUser', 'front');
    }
}