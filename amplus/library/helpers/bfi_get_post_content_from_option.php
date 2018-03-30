<?php
/**
 */
 
/**
 * Gets the post content from a given option. The option's value should
 * be a post ID.
 *
 * @package API\Utility
 * @param string $optionName the option name
 * @param string $prepend html to prepend to the resulting content
 * @param string $append html to append to the resulting content
 * @return string the post's content
 */
function bfi_get_post_content_from_option($optionName, $prepend = '', $append = '') {
    $content = "";
    if (bfi_get_option($optionName)) {
        query_posts('page_id='.bfi_get_option($optionName));
        while(have_posts()) : the_post();
            $content = bfi_get_contents_stripped($prepend, $append);
        endwhile; wp_reset_query(); 
    }
    return $content;
}