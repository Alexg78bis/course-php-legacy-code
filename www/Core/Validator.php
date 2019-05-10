<?php

declare(strict_types=1);

namespace Core;

class Validator
{
    public $errors = [];

    public function __construct($config, $data)
    {
        if (count($data) != count($config['data'])) {
            die('Tentative : faille XSS');
        }

        foreach ($config['data'] as $name => $info) {
            if (!isset($data[$name])) {
                die('Tentative : faille XSS');
            } else {
                if (($info['required'] ?? false) && !self::notEmpty($data[$name])) {
                    $this->errors[] = $info['error'];
                }

                if (isset($info['minlength']) && !self::minLength($data[$name], $info['minlength'])) {
                    $this->errors[] = $info['error'];
                }

                if (isset($info['maxlength']) && !self::maxLength($data[$name], $info['maxlength'])) {
                    $this->errors[] = $info['error'];
                }

                if ('email' == $info['type'] && !self::checkEmail($data[$name])) {
                    $this->errors[] = $info['error'];
                }

                if (isset($info['confirm']) && $data[$name] != $data[$info['confirm']]) {
                    $this->errors[] = $info['error'];
                } else {
                    if ('password' == $info['type'] && !self::checkPassword($data[$name])) {
                        $this->errors[] = $info['error'];
                    }
                }
            }
        }
    }

    /**
     * @param $string
     * @return bool
     */
    public static function notEmpty($string): bool
    {
        return !empty(trim($string));
    }

    /**
     * @param $string
     * @param $length
     * @return bool
     */
    public static function minLength($string, $length): bool
    {
        return strlen(trim($string)) >= $length;
    }

    /**
     * @param $string
     * @param $length
     * @return bool
     */
    public static function maxLength($string, $length): bool
    {
        return strlen(trim($string)) <= $length;
    }

    /**
     * @param $string
     * @return bool
     */
    public static function checkEmail($string): bool
    {
        return filter_var(trim($string), FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $string
     * @return bool
     */
    public static function checkPassword($string): bool
    {
        return
            preg_match('#[a-z]#', $string) &&
            preg_match('#[A-Z]#', $string) &&
            preg_match('#[0-9]#', $string);
    }
}
