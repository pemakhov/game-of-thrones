<?php


class ContentManager
{

    public static function getContent()
    {
        if (isset($_SESSION['isInfoFilled'])) {
            return include_once 'content/post-login.php';
        }

        if (isset($_SESSION['isAuth'])) {
            return include_once 'content/info-form.php';
        }

        return include_once 'content/login-form.php';
    }

    public static function getScriptPath()
    {
        if (isset($_SESSION['isInfoFilled'])) {
            return 'js/slider-setter.js';
        }

        if (isset($_SESSION['isAuth'])) {
            return 'js/info-form.js';
        }

        return 'js/login-form.js';
    }

}