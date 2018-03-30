<?php

/* ==================================================

Portfolio Post Type Functions

================================================== */

$args = array(
    "label" 						=> "Portfolio Categories", 
    "singular_label" 				=> "Portfolio Category", 
    'public'                        => true,
    'hierarchical'                  => true,
    'show_ui'                       => true,
    'show_in_nav_menus'             => false,
    'args'                          => array( 'orderby' => 'term_order' ),
    'rewrite'                       => false,
    'query_var'                     => true
);

register_taxonomy( 'portfolio-category', 'portfolio', $args );

    
add_action('init', 'portfolio_register');  
  
function portfolio_register() {  

    $labels = array(
        'name' => _x('Portfolio', 'post type general name', "swiftframework"),
        'singular_name' => _x('Portfolio Item', 'post type singular name', "swiftframework"),
        'add_new' => _x('Add New', 'portfolio item', "swiftframework"),
        'add_new_item' => __('Add New Portfolio Item', "swiftframework"),
        'edit_item' => __('Edit Portfolio Item', "swiftframework"),
        'new_item' => __('New Portfolio Item', "swiftframework"),
        'view_item' => __('View Portfolio Item', "swiftframework"),
        'search_items' => __('Search Portfolio', "swiftframework"),
        'not_found' =>  __('No portfolio items have been added yet', "swiftframework"),
        'not_found_in_trash' => __('Nothing found in Trash', "swiftframework"),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,  
        'public' => true,  
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_icon' => 'dashicons-format-image',
        'rewrite' => false,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'taxonomies' => array('portfolio-category', 'post_tag')
       );  
  
    register_post_type( 'portfolio' , $args );  
}  

add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");   
  
function portfolio_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Portfolio Item",
            "description" => "Description",
            "portfolio-category" => "Categories"  
        );  
  
        return $columns;  
}  

add_action("manage_posts_custom_column",  "portfolio_custom_columns"); 
  
function portfolio_custom_columns($column){  
        global $post;  
        switch ($column)  
        {  
            case "description":  
                the_excerpt();  
                break;
            case "portfolio-category":
                echo get_the_term_list($post->ID, 'portfolio-category', '', ', ','');
                break;
        }  
}  

?>