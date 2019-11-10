<?php

/*
 * The class validating user input and writing error messages
 * into the appropriate variables stored in $_SESSION.
 */

class Validator
{
    function __construct()
    {
        if (!isset($_SESSION['isAuth']) && isset($_POST['email'], $_POST['password'])) {
            $email = $this->prepareMessage($_POST['email']);
            $password = $this->prepareMessage($_POST['password']);
            $_SESSION['invEmailMessage'] = $this->getEmailInvalidMessage($email);
            $_SESSION['invPassMessage'] = $this->getPassInvalidMessage($password);
            return;
        }
        if (!isset($_SESSION['isInfoFilled']) && isset($_POST['name'], $_POST['house'], $_POST['hobbies'])) {
            $name = $this->prepareMessage($_POST['name']);
            $house = $this->prepareMessage($_POST['house']);
            $hobbies = $this->prepareMessage($_POST['hobbies']);
            $_SESSION['invNameMessage'] = $this->getNameInvalidMessage($name);
            $_SESSION['invHouseMessage'] = $this->getHouseInvalidMessage($house);
            $_SESSION['invHobbiesMessage'] = $this->getHobbiesInvalidMessage($hobbies);
        }
    }

    /* Validates email. Returns true if email is valid */
    function getEmailInvalidMessage($email)
    {
        if (strlen($email) === 0) {
            return 'Empty email';
        }
        $pattern = '/^[A-Za-z\d][\w.-]+[A-Za-z\d]@[A-Za-z\d][\w-]+[A-Za-z\d]\.[A-Za-z]{2,3}$/';
        $message = 'Email doesn\'t comply with the email pattern';

        return preg_match($pattern, $email) ? '' : $message;
    }

    /* Validates password. Returns true if password is valid */
    function getPassInvalidMessage($pass)
    {
        $minPassLength = 8;
        if (strlen($pass) < $minPassLength) {
            return 'Password is shorter than ' . $minPassLength . ' characters';
        }

        return '';
    }

    /* Validates name. Returns true if name is valid */
    function getNameInvalidMessage($name)
    {
        if (strlen($name) === 0) {
            return 'There is no name';
        }
        $pattern = '/^[A-Za-z0-9]+$/';
        $message = 'Not alpha-numeric name';

        return preg_match($pattern, $name) ? '' : $message;
    }

    /* Validates house. Returns true if house name is in the list of houses */
    function getHouseInvalidMessage($house) {
        $houseList = array(
            'arryn',
            'baratheon',
            'greyjoy',
            'martell',
            'lannister',
            'stark',
            'targaryen',
            'tully',
            'tyrell',
            );
        if (!in_array($house, $houseList)) {
           return 'A house must be chosen';
        }
        return '';
    }

    /* Validates hobbies. Returns true if hobbies are valid */
    function getHobbiesInvalidMessage($hobbies)
    {
        if (strlen($hobbies) === 0) {
            return 'Empty input';
        }
        $pattern = '/^(?:\b\w+\b[\s\r\n]*){3,250}$/';
        $message = 'Input must contain more than 3 but less than 250 words';

        return preg_match($pattern, $hobbies) ? '' : $message;
    }

    /* Prepares user input message for safe use */
    function prepareMessage($message) {
        $message = trim($message);
        $message = stripslashes($message);
        $message = htmlspecialchars($message);
        return $message;
    }
}
