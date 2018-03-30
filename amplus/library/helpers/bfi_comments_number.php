<?php
/**
 */

/**
 * Returns the number of comments for the current post
 *
 * @package API\Post
 * @param mixed $zero Used when there are no comments. If false, returns "No comments"; else returns the value of this variable. Defaults to false
 * @param mixed $one Used when there is one comment. If false, returns "1 comment"; else returns the value of this variable. Defaults to false
 * @param mixed $more Used when there are two or more comments. If false, returns "% comments"; else returns the value of this variable. This value should contain a '%' character. The '%' will be replaced with a number by the function. Defaults to false
 * @return string The string containing the number of comments
 */
function bfi_comments_number( $zero = false, $one = false, $more = false) {
    $number = get_comments_number();

    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% comments', BFI_I18NDOMAIN) : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __('No comments', BFI_I18NDOMAIN) : $zero;
    else // must be one
        $output = ( false === $one ) ? __('1 comment', BFI_I18NDOMAIN) : $one;

    return apply_filters('comments_number', $output, $number);
}
