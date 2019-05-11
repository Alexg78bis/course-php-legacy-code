<?php
declare(strict_types=1);

namespace Controller;

use Core\Validator;
use Core\View;
use Model\UserForm;
use Model\UserInterface;
use Repository\UserRepository;
use ValueObject\Name;

class SecurityController
{

    /**
     * @var UserInterface
     */
    private $user;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserInterface $user, UserRepository $userRepository)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    /**
     * Login Page
     */
    public function loginAction(): void
    {
        $userForm = new UserForm();
        $form = $userForm->getLoginForm();

        $method = strtoupper($form['config']['method']);
        $data = $GLOBALS['_' . $method];
        if ($_SERVER['REQUEST_METHOD'] == $method && !empty($data)) {
            $validator = new Validator($form, $data);
            $form['errors'] = $validator->errors;

            if (empty($errors)) {
                $user = $this->userRepository->getOneBy(['email' => 'alexandregiannetto@gmail.com']);
                if (password_verify($data['pwd'], $user->getPwd())) {
                    $_SESSION['user'] = $user;
                    header('Location: /');
                    echo 'sqd';
                } else {
                    $form['errors'] = ['Compte introuvable'];
                }
            }
        }

        $view = new View('loginUser', 'front');
        $view->assign('form', $form);
    }

    /**
     * Disconnect Page
     */
    public function disconnectAction(): void
    {
        session_destroy();
        header('Location: /connexion');
    }

    /**
     * Add a new user page
     */
    public function addAction(): void
    {
        $userForm = new UserForm();
        $form = $userForm->getRegisterForm();

        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }

    /**
     * function called by the add user form
     */
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
                $name = new Name($data['firstname'], $data['lastname']);
                $hashedPassword = $this->userRepository->hashPassword($data['pwd']);

                $this->user->setName($name);
                $this->user->setEmail($data['email']);
                $this->user->setPwd($hashedPassword);
                $this->userRepository->add($this->user);
            }
        }

        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }

    /**
     * Forget password page
     */
    public function forgetPasswordAction(): void
    {
        $view = new View('forgetPasswordUser', 'front');
    }
}