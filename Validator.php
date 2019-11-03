<?php

class Validator
{
    function __construct()
    {
        if (!isset($_SESSION['isAuth']) && isset($_POST['email'], $_POST['password'])) {
            $_SESSION['invEmailMessage'] = $this->getEmailInvalidMessage($_POST['email']);
            $_SESSION['invPassMessage'] = $this->getPassInvalidMessage($_POST['password']);
            return;
        }
        if (!isset($_SESSION['isInfoFilled']) && isset($_POST['name'], $_POST['house'], $_POST['hobbies'])) {
            $_SESSION['invNameMessage'] = $this->getNameInvalidMessage($_POST['name']);
            $_SESSION['invHouseMessage'] = $this->getHouseInvalidMessage($_POST['house']);
            $_SESSION['invHobbiesMessage'] = $this->getHobbiesInvalidMessage($_POST['hobbies']);
        }
    }

    function getEmailInvalidMessage($email)
    {
        if (strlen($email) === 0) {
            return 'Empty email';
        }
        $pattern = '/^[A-Za-z\d][\w.-]+[A-Za-z\d]@[A-Za-z\d][\w-]+[A-Za-z\d]\.[A-Za-z]{2,3}$/';
        $message = 'Email doesn\'t comply with the email pattern';

        return preg_match($pattern, $email) ? '' : $message;
    }

    function getPassInvalidMessage($pass)
    {
        $minPassLength = 8;
        if (strlen($pass) < $minPassLength) {
            return 'Password is shorter than ' . $minPassLength . ' characters';
        }

        return '';
    }

    function getNameInvalidMessage($name)
    {
        if (strlen($name) === 0) {
            return 'There is no name';
        }
        $pattern = '/^[A-Za-z0-9]+$/';
        $message = 'Not alpha-numeric name';

        return preg_match($pattern, $name) ? '' : $message;
    }

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

    function getHobbiesInvalidMessage($hobbies)
    {
        if (strlen($hobbies) === 0) {
            return 'Empty input';
        }
        $pattern = '/^(?:\b\w+\b[\s\r\n]*){3,250}$/';
        $message = 'Input must contain more than 3 but less than 250 words';

        return preg_match($pattern, $hobbies) ? '' : $message;
    }
}
