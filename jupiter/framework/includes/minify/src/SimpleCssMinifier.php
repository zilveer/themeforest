<?php
/**
 * Created by PhpStorm.
 * User: mirzaartbees
 * Date: 3.12.2015
 * Time: 16:37
 * Source:: http://manas.tungare.name/software/css-compression-in-php/
 */

class SimpleCssMinifier
{

    static function minify($buffer) {

        // Remove comments
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        // Remove space after colons
        $buffer = str_replace(': ', ':', $buffer);
        // Remove excess whitespace
        $buffer = trim(preg_replace('/\s+/',' ', $buffer));
        // Remove new lines, tabs and etc.
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t"), '', $buffer);

        return $buffer;
    }

}