<?php

/* ==================================================

Showcase Post Type Functions

================================================== */

    
add_action('init', 'showcase_register');  
  
function showcase_register() {  

    $labels = array(
        'name' => _x('Showcase', 'post type general name',"swiftframework"),
        'singular_name' => _x('Showcase Slide', 'post type singular name', "swiftframework"),
        'add_new' => _x('Add New Slide', 'showcase slide', "swiftframework"),
        'add_new_item' => __('Add New Slide', "swiftframework"),
        'edit_item' => __('Edit Slide', "swiftframework"),
        'new_item' => __('New Slide', "swiftframework"),
        'view_item' => __('View Slide', "swiftframework"),
        'search_items' => __('Search Showcase', "swiftframework"),
        'not_found' =>  __('No showcase slides have been added yet', "swiftframework"),
        'not_found_in_trash' => __('Nothing found in Trash', "swiftframework"),
        'parent_item_colon' => ''
    );
    
    $args = array(  
        'labels' => $labels, 
        'public' => true,  
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_icon'=> 'dashicons-format-gallery',
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => false,  
        'supports' => array('title', 'thumbnail')  
    );
  
    register_post_type( 'showcase' , $args );  
}  
    
add_filter("manage_edit-showcase_columns", "slide_edit_columns");   
  
function slide_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Slide",
        );  
  
        return $columns;  
}  

add_action("manage_posts_custom_column",  "slide_custom_columns"); 
  
function slide_custom_columns($column){  
        global $post;  
        switch ($column)  
        {  
        }  
}  

?>