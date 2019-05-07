<?php
declare(strict_types=1);

namespace Controller;

use Core\Validator;
use Core\View;
use Model\UserForm;
use Model\UserInterface;
use Repository\UserRepository;

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

        $v = new View('loginUser', 'front');
        $v->assign('form', $form);
    }

    public function disconnectAction()
    {
        session_destroy();
        header('Location: /connexion');
    }

}