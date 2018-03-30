<?php
/**
 */

/**
 * Returns a comma separated list of anchor links containing
 * all post categories, this has similar behavior to
 * WP's get_the_category_list
 *
 * @return string comma separated anchor links of all post categories
 */
function bfi_get_post_category_list() {
    return get_the_category_list(', ');
}