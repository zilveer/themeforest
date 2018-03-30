<?php
/**
 */
 
/**
 * Returns an array of all portfolio categories, 
 * this has similar behavior to WP's get_the_terms
 *
 * @return array of all portfolio categories
 */
function bfi_get_portfolio_categories() {
    return get_the_terms(get_the_ID(), 
                         BFIPortfolioModel::TAXONOMY_ID);
}