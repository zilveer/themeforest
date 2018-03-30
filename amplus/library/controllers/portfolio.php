<?php

class BFIPortfolioController {
    
    const CATEGORY_COLUMN = 'portfolio_category';
    const DISPLAY_ORDER_COLUMN = 'portfolio_display_order';
    
    function __construct() {
        add_action('init', array($this, 'registerPortfolio'));
        if (is_admin()) {
            add_filter('manage_edit-'.BFIPortfolioModel::POST_TYPE.'_columns', array($this, 'addColumns'));
            add_action('manage_posts_custom_column', array($this, 'populateColumns'));
        }
    }
    
    public function registerPortfolio() {
        $labels = array(
            'name' => __('Portfolio Items', BFI_I18NDOMAIN),
            'singular_name' => __('Portfolio Item', BFI_I18NDOMAIN),
            'all_items' => __('View all Portfolio', BFI_I18NDOMAIN),
            'add_new' => __('Add New', BFI_I18NDOMAIN),
            'add_new_item' => __('Add New Portfolio Item', BFI_I18NDOMAIN),
            'edit_item' => __('Edit Item', BFI_I18NDOMAIN),
            'new_item' => __('New Portfolio Item', BFI_I18NDOMAIN),
            'view_item' => __('View Item', BFI_I18NDOMAIN),
            'search_items' => __('Search Portfolio Items', BFI_I18NDOMAIN),
            'not_found' =>  __('No portfolio items found', BFI_I18NDOMAIN),
            'not_found_in_trash' => __('No portfolio items found in Trash', BFI_I18NDOMAIN), 
            'parent_item_colon' => ''
            );
            
        $supports = array( 'title', 'editor', 'page-attributes', 'custom-fields', 'comments' );
        if ( defined( 'BFI_ENABLE_PORTFOLIO_FEATURED_IMAGE' ) && BFI_ENABLE_PORTFOLIO_FEATURED_IMAGE ) {
            $supports[] = 'thumbnail';
        }
            
        register_post_type(
            BFIPortfolioModel::POST_TYPE,
            array('labels' => $labels,
                'public' => true,  
                'show_ui' => true,
                'hierarchical' => false,
                'public_queryable' => true,
                'rewrite' => array('slug' => bfi_get_option(BFI_SHORTNAME.'_portfolio_query_var'), 'with_front' => true),
                'query_var' => bfi_get_option(BFI_SHORTNAME.'_portfolio_query_var'),  
                'capability_type' => 'post',
                'supports' => $supports,
                'menu_position' => 5,
                )
            );
            
        register_taxonomy(BFIPortfolioModel::TAXONOMY_ID, 
            array(BFIPortfolioModel::POST_TYPE), 
            array("hierarchical" => true, 
                "label" => __("Portfolio Categories", BFI_I18NDOMAIN), 
                "singular_label" => __("Portfolio Categories", BFI_I18NDOMAIN), 
                'rewrite' => array('slug' => bfi_get_option(BFI_SHORTNAME.'_portfolio_cat_query_var'), 'with_front' => true),
                "query_var" => bfi_get_option(BFI_SHORTNAME.'_portfolio_cat_query_var'),
                )
            );  
            
        // flush_rewrite_rules(false);
    }

    public function addColumns($columns) {
        $columns[self::CATEGORY_COLUMN] = __('Portfolio Category', BFI_I18NDOMAIN);
        $columns[self::DISPLAY_ORDER_COLUMN] = __('Display Order', BFI_I18NDOMAIN);
        return $columns;
    }
    
    public function populateColumns($name) {
        global $post;
        if ($name == self::CATEGORY_COLUMN) {
            echo get_the_term_list($post->ID, BFIPortfolioModel::TAXONOMY_ID, '', ', ', '');
            return;
        }
        if ($name == self::DISPLAY_ORDER_COLUMN) {
            echo $post->menu_order;
            return;
        }
    }
}
