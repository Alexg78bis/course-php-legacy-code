<?php

declare(strict_types=1);

namespace Core;

class View
{
    private $view;
    private $template;
    private $data = [];

    public function __construct($view, $template)
    {
        try {
            $this->setView($view);
            $this->setTemplate($template);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function View($view): void
    {
        try {
            $this->setView($view);
            $this->setTemplate('back');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param $view
     * @throws \Exception
     */
    public function setView($view): void
    {
        $viewPath = 'View/' . $view . '.view.php';
        if (file_exists($viewPath)) {
            $this->view = $viewPath;
        } else {
            throw new \Exception("Attention le fichier view n'existe pas " . $viewPath);
        }
    }

    /**
     * @param $template
     * @throws \Exception
     */
    public function setTemplate($template): void
    {
        $templatePath = 'View/templates/' . $template . '.tpl.php';
        if (file_exists($templatePath)) {
            $this->template = $templatePath;
        } else {
            throw new \Exception("Attention le fichier template n'existe pas " . $templatePath);
        }
    }

    /**
     * @param $modal
     * @param $config
     * @throws \Exception
     */
    public function addModal($modal, $config): void
    {
        $modalPath = 'View/modals/' . $modal . '.mod.php';
        if (file_exists($modalPath)) {
            include $modalPath;
        } else {
            throw new \Exception("Attention le fichier modal n'existe pas " . $modalPath);
        }
    }

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __destruct()
    {
        extract($this->data);
        try {
            require $this->template;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
