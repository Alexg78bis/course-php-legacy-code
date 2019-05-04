<?php

use Controller\PagesController;
use Controller\UsersController;
use Core\BaseSQL;
use Model\UserInterface;
use Model\Users;
use Repository\UserRepository;
use Repository\UserRepositoryInterface;

return [
    BaseSQL::class => function (array $container, $class) {
        $host = $container['config']['database']['host'];
        $driver = $container['config']['database']['driver'];
        $name = $container['config']['database']['name'];
        $user = $container['config']['database']['user'];
        $password = $container['config']['database']['password'];

        return new BaseSQL($host, $driver, $name, $user, $password, $class);
    },

    UserRepositoryInterface::class => function (array $container) {
        $class = $container[UserInterface::class]($container);
        $baseSQL = $container[BaseSQL::class]($container, $class);
        return new UserRepository($baseSQL);
    },
    UserInterface::class => function (array $container) {
        return new Users();
    },
    UsersController::class => function (array $container) {
        $userModel = $container[UserInterface::class]($container);
        $userRepository = $container[UserRepositoryInterface::class]($container);

        return new UsersController($userModel, $userRepository);
    },
    PagesController::class => function () {
        return new PagesController();
    },
];
