<?php

/* ==================================================

Testimonials Post Type Functions

================================================== */
    
    
$args = array(
    "label" 						=> "Testimonial Categories", 
    "singular_label" 				=> "Testimonial Category", 
    'public'                        => true,
    'hierarchical'                  => true,
    'show_ui'                       => true,
    'show_in_nav_menus'             => false,
    'args'                          => array( 'orderby' => 'term_order' ),
    'rewrite'                       => false,
    'query_var'                     => true
);

register_taxonomy( 'testimonials-category', 'testimonials', $args );


add_action('init', 'testimonials_register');  
  
function testimonials_register() {  

    $labels = array(
        'name' => _x('Testimonials', 'post type general name', "swiftframework"),
        'singular_name' => _x('Testimonial', 'post type singular name', "swiftframework"),
        'add_new' => _x('Add New', 'Testimonial', "swiftframework"),
        'add_new_item' => __('Add New Testimonial', "swiftframework"),
        'edit_item' => __('Edit Testimonial', "swiftframework"),
        'new_item' => __('New Testimonial', "swiftframework"),
        'view_item' => __('View Testimonial', "swiftframework"),
        'search_items' => __('Search Testimonials', "swiftframework"),
        'not_found' =>  __('No testimonials have been added yet', "swiftframework"),
        'not_found_in_trash' => __('Nothing found in Trash', "swiftframework"),
        'parent_item_colon' => ''
    );

    $args = array(  
        'labels' => $labels,  
        'public' => true,  
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_icon'=> 'dashicons-format-quote',
        'rewrite' => false,
        'supports' => array('title', 'editor'),
        'has_archive' => true,
        'taxonomies' => array('testimonials-category', 'post_tag')
       );  
  
    register_post_type( 'testimonials' , $args );  
}  

add_filter("manage_edit-clients_columns", "testimonials_edit_columns");   
  
function testimonials_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Testimonial",
            "testimonials-category" => "Categories"  
        );  
  
        return $columns;  
}  

add_action("manage_posts_custom_column",  "testimonials_custom_columns"); 
  
function testimonials_custom_columns($column){  
        global $post;  
        switch ($column)  
        {  
            case "testimonials-category":
                echo get_the_term_list($post->ID, 'testimonials-category', '', ', ','');
                break;
        }  
}  

?>