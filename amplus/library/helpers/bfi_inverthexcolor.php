<?php
/**
 */
 
/**
 * Inverts a hex color (negative)
 *
 * @package API\Utility
 * @see http://www.jonasjohn.de/snippets/php/color-inverse.htm
 * @param string $color a hex color. e.g. #ff0000
 * @return string the inverted hex color
 */
function bfi_inverthexcolor($color) {
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return '000000'; }
    $rgb = '';
    for ($x=0;$x<3;$x++){
        $c = 255 - hexdec(substr($color,(2*$x),2));
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
    }
    return '#'.$rgb;
}