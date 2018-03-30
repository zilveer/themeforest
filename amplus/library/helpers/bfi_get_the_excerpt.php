<?php
/**
 */
 
 
function bfi_custom_excerpt_length( $length ) {
    global $_bfi_custom_excerpt_length;
 	return isset($_bfi_custom_excerpt_length) ? $_bfi_custom_excerpt_length : 55;
}
add_filter( 'excerpt_length', 'bfi_custom_excerpt_length', 999 );
 
/**
 * Gets the excerpt of the current loop, use this instead of get_the_excerpt()
 *
 * @package API\WordPress Replacements
 * @param int $charlength the length of characters for the excerpt
 * @return string the excerpt of the post
 */
function bfi_get_the_excerpt($charlength) {
    global $_bfi_custom_excerpt_length;
    
    if (!isset($_bfi_custom_excerpt_length)) $_bfi_custom_excerpt_length = 55;
    $origExcerptLength = $_bfi_custom_excerpt_length;
    $_bfi_custom_excerpt_length = $charlength;
    
    bfi_set_excerpt_readmore('');
    $excerpt = get_the_excerpt();
    
    $_bfi_custom_excerpt_length = $origExcerptLength;
    
    // remove forms
    $excerpt = preg_replace('#<form(.*?)>(.*?)</form>#is', '', $excerpt);
    // remove buttons and other input forms
    $excerpt = preg_replace('#<textarea(.*?)>(.*?)</textarea>#is', '', $excerpt);
    $excerpt = preg_replace('#<button(.*?)>(.*?)</button>#is', '', $excerpt);
    $excerpt = preg_replace('#<input(.*?)>(.*?)</input>#is', '', $excerpt);
    // remove script tags
    $excerpt = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $excerpt);
    // remove some html tags and shortcodes which were left
    $excerpt = html_entity_decode($excerpt, ENT_COMPAT, "UTF-8");
    $excerpt = preg_replace('#\[[^\]]+\]#', '', $excerpt);
    $excerpt = preg_replace('#<[^>]+>#', '', $excerpt);
    while (preg_match('#  #', $excerpt)) {
        $excerpt = preg_replace('#  #', ' ', $excerpt);
    }
    
    $charlength++;

    $newExcerpt = '';
    if (mb_strlen($excerpt) > $charlength) {
        // $subex = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $excerpt);
        
        // the words are already split, use them to form the excerpt
        foreach ($exwords as $word) {
            if (mb_strlen($newExcerpt) > $charlength) break;
            $newExcerpt .= $newExcerpt ? ' ' : '';
            $newExcerpt .= $word;
        }
        
        return $newExcerpt . ' [...]';
    } else {
        return $excerpt;
    }
}
