<?php


class DataCollector
{
const DIR_NAME = 'users';

    /* Opens file for reading, reads and returns its content */
    function getFileContent($fName)
    {
        $file = fopen($fName, 'r+') or die('Unable to open file.');
        $txt = fread($file, filesize($fName));
        fclose($file);
        return $txt;
    }

    /* Opens file for writing, replaces its content */
    function writeToFile($txt, $fName) {
        $file = fopen($fName, 'w+') or die('Unable to open file.');
        fwrite($file, $txt);
        fclose($file);
    }
}