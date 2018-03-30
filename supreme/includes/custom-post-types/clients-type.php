<?php

/* ==================================================

Clients Post Type Functions

================================================== */
    
    
$args = array(
    "label" 						=> "Client Categories", 
    "singular_label" 				=> "Client Category", 
    'public'                        => true,
    'hierarchical'                  => true,
    'show_ui'                       => true,
    'show_in_nav_menus'             => false,
    'args'                          => array( 'orderby' => 'term_order' ),
    'rewrite'                       => false,
    'query_var'                     => true
);

register_taxonomy( 'clients-category', 'clients', $args );


add_action('init', 'clients_register');  
  
function clients_register() {  

    $labels = array(
        'name' => _x('Clients', 'post type general name', "swiftframework"),
        'singular_name' => _x('Client', 'post type singular name', "swiftframework"),
        'add_new' => _x('Add New', 'Client', "swiftframework"),
        'add_new_item' => __('Add New Client', "swiftframework"),
        'edit_item' => __('Edit Client', "swiftframework"),
        'new_item' => __('New Client', "swiftframework"),
        'view_item' => __('View Client', "swiftframework"),
        'search_items' => __('Search Clients', "swiftframework"),
        'not_found' =>  __('No clients have been added yet', "swiftframework"),
        'not_found_in_trash' => __('Nothing found in Trash', "swiftframework"),
        'parent_item_colon' => ''
    );

    $args = array(  
        'labels' => $labels,  
        'public' => true,  
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_icon'=> 'dashicons-businessman',
        'rewrite' => false,
        'supports' => array('title', 'thumbnail'),
        'has_archive' => true,
        'taxonomies' => array('clients-category', 'post_tag')
       );  
  
    register_post_type( 'clients' , $args );  
}  

add_filter("manage_edit-clients_columns", "clients_edit_columns");   
  
function clients_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Client",
            "clients-category" => "Categories"  
        );  
  
        return $columns;  
}  

add_action("manage_posts_custom_column",  "clients_custom_columns"); 
  
function clients_custom_columns($column){  
        global $post;  
        switch ($column)  
        {  
            case "clients-category":
                echo get_the_term_list($post->ID, 'clients-category', '', ', ','');
                break;
        }  
}  

?>