<?php
/**
 */
 
/**
 * Limit a string to a specified number of words and add '...' to end
 *
 * @deprecated
 * @ignore
 * @see http://psoug.org/snippet/Neatly-trim-a-string-to-a-set-number-of-words_933.htm
 * @param string $str the string to trim
 * @param int $n the number of characters to retain after trimming
 * @param string $ellipses the string to append on the trimmed string
 * @return string the trimmer string with appended ellipses
 */
function bfi_seo_meta_trim($str, $n = 160, $ellipses = '...') {
    // trim and add ellipses
    $len = strlen($str);
    if ($len > $n) {
        preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
        $str = rtrim($matches[1]) . $ellipses;
    }
    unset($len);
    
    $str = str_ireplace('"', "'", $str);
    return $str;
}