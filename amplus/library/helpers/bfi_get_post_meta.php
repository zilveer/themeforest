<?php
/**
 */

/**
 * Gets a post's meta option, use this instead of WP's get_post_meta()
 *
 * Since there is no filter for bfi_get_post_meta, create our own hook for multilanguage.php
 *
 * @package API\WordPress Replacements
 * @param int $post_id the post's id
 * @param string $key the name of the meta option
 * @param boolean $single if true, the data is returned as a string. If false, as an array.
 * @param string $default if the meta option is null, then this is the value returned
 * @return mixed the meta value
 */
function bfi_get_post_meta($post_id, $key, $single = true, $default = '') {    
    $val = bfi_get_post_meta_old($post_id, $key, $single, $default);
    
    if (!$val && strpos($key, BFI_SHORTNAME.'_') === false) {
        $val = bfi_get_post_meta_old($post_id, BFI_SHORTNAME.'_'.$key, $single, $default);
    }
    
    // unserialize the data if applicable before returning it
    // regex came from http://stackoverflow.com/questions/1369936/check-to-see-if-a-string-is-serialized
    $val = preg_match('/^([adObis]:|N;)/', $val) ? unserialize($val) : $val;
    return $val;
}

/**
 * Gets a post's meta option
 *
 * @internal used by bfi_get_post_meta
 * @param string $optionName the option name
 * @param string $prepend html to prepend to the resulting content
 * @param string $append html to append to the resulting content
 * @return string the post's content
 */
function bfi_get_post_meta_old($post_id, $key, $single = true, $default = '') {
    if (function_exists('bfi_multilang_get_post_meta')) {
        $result = bfi_multilang_get_post_meta($post_id, $key, $single);
        $result = apply_filters('bfi_multilang_get_post_meta', $result, $post_id, $key);
        $value = apply_filters('bfi_get_post_meta', 
                               $result['result'], 
                               $result['post_id'], 
                               $result['key']);
        if ($value == '' && $default) {
            return $default;
        }
        return $value;
    }
    $value = get_post_meta($post_id, $key, $single);
    $value = apply_filters('bfi_get_post_meta', $value, $post_id, $key);
    if ($value == '' && $default) {
        return $default;
    }
    return $value;
}