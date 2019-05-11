<?php
declare(strict_types=1);

namespace Controller;

use Core\Validator;
use Core\View;
use Model\UserForm;
use Model\UserInterface;
use Repository\UserRepository;
use ValueObject\Account;
use ValueObject\Credentials;
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
    public function loginAction()
    {
        $userForm = new UserForm();
        $form = $userForm->getLoginForm();

        $method = strtoupper($form['config']['method']);
        $data = $GLOBALS['_' . $method];
        if ($_SERVER['REQUEST_METHOD'] === $method && !empty($data)) {
            $validator = new Validator($form, $data);
            $form['errors'] = $validator->errors;

            if (empty($errors)) {
                $user = $this->userRepository->getOneBy(['email' => $data['email']]);

                if (password_verify($data['pwd'], $user->getAccount()->getCredentials()->getPassword())) {
                    $_SESSION['user'] = $user;
                    header('Location: /');
                    exit;
                }

                $form['errors'] = ['Compte introuvable'];

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
    public function saveAction()
    {
        $userForm = new UserForm();
        $form = $userForm->getRegisterForm();
        $method = strtoupper($form['config']['method']);
        $data = $GLOBALS['_' . $method];
        if ($_SERVER['REQUEST_METHOD'] !== $method || empty($data)) {
            return null;
        }

        $validator = new Validator($form, $data);
        $form['errors'] = $validator->errors;
        if (empty($errors)) {
            $name = new Name($data['firstname'], $data['lastname']);
            $hashedPassword = $this->userRepository->hashPassword($data['pwd']);
            $credentials = new Credentials($data['email'], $hashedPassword);
            $account = new Account($credentials);

            $this->user->setName($name);
            $this->user->setAccount($account);
            $this->userRepository->add($this->user);

        }

        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }

    /**
     * Forget password page
     */
    public function forgetPasswordAction(): void
    {
        new View('forgetPasswordUser', 'front');
    }
}