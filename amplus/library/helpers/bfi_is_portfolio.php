<?php
/**
 */

/**
 * Returns true if the current page is a portfolio item
 *
 * @return boolean true if the current page is a portfolio item, false if not
 */
function bfi_is_portfolio() {
    global $post;
    return $post != null && $post->post_type == BFIPortfolioModel::POST_TYPE;
}