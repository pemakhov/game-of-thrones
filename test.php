<?php

function getNameInvalidMessage($name)
{
    if (strlen($name) === 0) {
        return 'There is no name.';
    }
    $pattern = '/^[A-Za-z0-9]$/';
    $message = 'Not alpha-numeric name.';

    return preg_match($pattern, $name) ? '' : $message;
}

function getHouseInvalidMessage($house)
{
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
        return 'House ' . $house . ' is not in the list.';
    }
    return '';
}

function getHobbiesInvalidMessage($hobbies)
{
    if (strlen($hobbies) === 0) {
        return 'Empty input.';
    }
    $pattern = '/^(?:\b\w+\b[\s\r\n]*){3,250}$/';
    $message = 'Input must contain more than 3 but less than 250 words.';

    return preg_match($pattern, $hobbies) ? '' : $message;
}

echo 'test';
$name = 'arya';
$house = 'lannister';
$hobbies = 'This are three words';
echo 'Test name ' . $name . '<br>';
echo getNameInvalidMessage($name) . '<br>';
echo 'Test house ' . $house . '<br>';
echo getHouseInvalidMessage($house) . '<br>';
echo 'Test hobbies ' . $hobbies . '<br>';
echo getHobbiesInvalidMessage($hobbies) . '<br>';
