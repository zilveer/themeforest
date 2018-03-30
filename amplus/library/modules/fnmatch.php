<?php

// For someversion of Windows, fnmatch doesn't exist, add it to prevent errors
if (!function_exists('fnmatch')) {
    function fnmatch($pattern, $string) {
        return @preg_match('/^' . strtr(addcslashes($pattern, '\.+^$(){}=!<>|'), array('*' => '.*', '?' => '.?')) . '$/i', $string);
    }
}