<?php

class StatusSetter
{
    function __construct()
    {
        $this->setStatus();
    }

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

    function hasInvalidMessage($invalidParamMessage)
    {
        return strlen($invalidParamMessage) > 0;
    }

}