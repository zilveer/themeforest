<?php

/**
 * Fixes the pagination bug in WP where the page # is being treated as a post name
 * The error occurs when the query variable for portfolio gets mixed up with a portfolio page with the same title
 */
class BFIModuleFixPortfolioPagination {
    public static function run() {
        add_filter('request', array(__CLASS__, 'removePageFromQueryString'));
    }
    
    public static function removePageFromQueryString($query_string) {
        $portfolioQueryVar = bfi_get_option(BFI_SHORTNAME.'_portfolio_query_var');
     
        if (!$portfolioQueryVar) return $query_string;
        
        if (array_key_exists($portfolioQueryVar, $query_string) && 
            $query_string[$portfolioQueryVar] == 'page' &&
            array_key_exists('page', $query_string) && 
            isset($query_string['page'])) {
                
            unset($query_string[$portfolioQueryVar]);
            
            if (array_key_exists('name', $query_string))
                unset($query_string['name']);
            
            if (array_key_exists('post_type', $query_string))
                unset($query_string['post_type']);
                
            $query_string['pagename'] = $portfolioQueryVar;
            $query_string['paged'] = str_replace('/', '', $query_string['page']);
        }
            
        return $query_string;
    }
}

BFIModuleFixPortfolioPagination::run();
