<?php

/* The class containing static methods for getting proper content and script */

class ContentManager
{
    /* The path to content */
    const CONTENT_DIR = '../public/content/';

    /* Returns proper content for the page, according to the $_SESSION['isAuth']
     * and $_SESSION['isInfoFilled'] variables.
     */
    public static function getContent()
    {
        if (isset($_SESSION['isInfoFilled'])) {
            return include_once self::CONTENT_DIR . 'post-login.php';
        }

        if (isset($_SESSION['isAuth'])) {
            return include_once self::CONTENT_DIR . 'info-form.php';
        }

        return include_once self::CONTENT_DIR . 'login-form.php';
    }

    /* Returns proper script path, according to the $_SESSION['isAuth']
     * and $_SESSION['isInfoFilled'] variables.
     */
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