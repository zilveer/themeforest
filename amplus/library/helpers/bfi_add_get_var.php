<?php
/**
 */

/**
 * Adds a GET variable into a URL, also removes an existing one if a duplicate is found
 *
 * @package API\Utility
 * @link http://stackoverflow.com/a/7195731/174172
 * @param string $link The URL to modify
 * @param string $var The GET variable name
 * @param string $value The GET value
 * @return string The modified URL
 */
function bfi_add_get_var($link, $var, $value) {
    // get path of url and get variables
    $parts = parse_url($link);
    $queryParams = array();
    if (array_key_exists('query', $parts)) parse_str($parts['query'], $queryParams);

    // put in new variable value
    $queryParams[$var] = $value;
    
    // rebuild the url
    $queryString = http_build_query($queryParams);
    return $parts['path'] . '?' . $queryString;
}
