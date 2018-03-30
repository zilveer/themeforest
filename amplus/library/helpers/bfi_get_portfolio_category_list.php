<?php
/**
 */
 
/**
 * Returns a comma separated list of anchor links containing
 * all portfolio categories, this has similar behavior to
 * WP's get_the_term_list
 *
 * @return string comma separated anchor links of all portfolio categories
 */
function bfi_get_portfolio_category_list($delimiter = ', ') {
    return get_the_term_list(get_the_ID(), 
                             BFIPortfolioModel::TAXONOMY_ID, 
                             '', 
                             $delimiter, 
                             '');
}
