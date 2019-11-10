<?php

/*
 * The class setting status "isAuth" and "isInfoFilled" according to the
 * validation messages stored in the appropriate $_SESSION variables.
 */

class StatusSetter
{
    function __construct()
    {
        $this->setStatus();
    }

    /* Sets status $_SESSION['isAuth'] and $_SESSION['isInfoFilled'] */
    function setStatus()
    {
        if (!isset($_SESSION['isAuth']) &&
            isset($_SESSION['invEmailMessage'], $_SESSION['invPassMessage'])) {
            if ($this->hasInvalidMessage($_SESSION['invEmailMessage'])) {
                return;
            }
            if ($this->hasInvalidMessage($_SESSION['invPassMessage'])) {
                return;
            }
            $_SESSION['isAuth'] = true;
            return;
        }
        if (!isset($_SESSION['isInfoFilled']) &&
            isset($_SESSION['invNameMessage'], $_SESSION['invHouseMessage'], $_SESSION['invHobbiesMessage'])) {
            if ($this->hasInvalidMessage($_SESSION['invNameMessage'])) {
                return;
            }
            if ($this->hasInvalidMessage($_SESSION['invHouseMessage'])) {
                return;
            }
            if ($this->hasInvalidMessage($_SESSION['invHobbiesMessage'])) {
                return;
            }
            $_SESSION['isInfoFilled'] = true;
        }
    }

    /* Returns true when passed variable contains a message */
    function hasInvalidMessage($invalidParamMessage)
    {
        return strlen($invalidParamMessage) > 0;
    }

}