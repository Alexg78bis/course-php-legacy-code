<?php

use Controller\PagesController;
use Controller\SecurityController;
use Controller\UserController;
use Core\BaseSQL;
use Model\User;
use Model\UserInterface;
use Repository\LoggerRepository;
use Repository\LoggerRepositoryInferface;
use Repository\UserRepository;
use Repository\UserRepositoryInterface;

return [
    PDO::class => function (array $container) {
        $host = $container['config']['database']['host'];
        $driver = $container['config']['database']['driver'];
        $name = $container['config']['database']['name'];
        $user = $container['config']['database']['user'];
        $password = $container['config']['database']['password'];

        return new PDO($driver . ':host=' . $host . ';dbname=' . $name, $user, $password);
    },

    UserRepositoryInterface::class => function (array $container) {
        $pdo = $container[PDO::class]($container);
        $logger = $container[LoggerRepositoryInferface::class]($container);
        $user = $container[UserInterface::class]($container);

        return new UserRepository($pdo, $logger, $user);
    },
    LoggerRepositoryInferface::class => function (array $container) {
        return new LoggerRepository();
    },

    UserInterface::class => function (array $container) {
        return new User();
    },

    SecurityController::class => function (array $container) {
        $userModel = $container[UserInterface::class]($container);
        $userRepository = $container[UserRepositoryInterface::class]($container);

        return new SecurityController($userModel, $userRepository);
    },
    UserController::class => function (array $container) {
        $userModel = $container[UserInterface::class]($container);
        $userRepository = $container[UserRepositoryInterface::class]($container);

        return new UserController($userModel, $userRepository);
    },
    PagesController::class => function () {
        return new PagesController();
    },
];
