<?php
session_start();

/* The directory containing php files */
const APP_DIR = '../app/';

/* The path to content */
const CONTENT_DIR = '../public/content/';

include_once APP_DIR . 'Validator.php';
include_once APP_DIR . 'StatusSetter.php';
include_once APP_DIR . 'ContentManager.php';
include_once APP_DIR . 'DataCollector.php';

/* Validates all input passed in $_POST variable and sets invalid validation messages */
$validator = new Validator();
/* Writes user data into a json file */
$dataCollector = new DataCollector();
/* Sets status according to the validation results */
$statusSetter = new StatusSetter();

function main()
{
    /* Data from the first form is provided and it is valid */
    if (isset($_POST['email']) && isset($_SESSION['isAuth'])) {
        return include_once CONTENT_DIR . 'info-form.php';
    }

    /* Data from the first form is provided but not valid */
    if (isset($_POST['email']) && !isset($_SESSION['isAuth'])) {
        return include_once CONTENT_DIR . 'login-form.php';
    }

    /* Data from the second form is provided and it is valid */
    if (isset($_POST['name']) && isset($_SESSION['isInfoFilled'])) {
        return include_once CONTENT_DIR . 'post-login.php';
    }

    /* Data from the second form is provided but not valid */
    if (isset($_POST['name']) && !isset($_SESSION['isInfoFilled'])) {
        return include_once CONTENT_DIR . 'info-form.php';
    }

    return include_once 'content/main.php';
}

main();
