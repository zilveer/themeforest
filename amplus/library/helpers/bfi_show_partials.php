<?php
/**
 */

/**
 * Shows the partial templates for pages, portfolios and blog posts, this 
 * is intended to be used inside the archive and search loops
 *
 * @return null
 */
function bfi_show_partials() {
    if (bfi_is_page()) {
        get_template_part('partial', 'page');
    } elseif (bfi_is_portfolio()) {
        get_template_part('partial', 'portfolio');
    } else {
        get_template_part('partial', 'post');
    }
}