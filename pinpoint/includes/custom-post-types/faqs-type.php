<?php

/* ==================================================

FAQs Post Type Functions

================================================== */
    
    
$args = array(
    "label" 						=> "Topics", 
    "singular_label" 				=> "Topic", 
    'public'                        => true,
    'hierarchical'                  => true,
    'show_ui'                       => true,
    'show_in_nav_menus'             => false,
    'args'                          => array( 'orderby' => 'term_order' ),
    'rewrite'                       => false,
    'query_var'                     => true
);

register_taxonomy( 'faqs-category', 'faqs', $args );


add_action('init', 'faqs_register');  
  
function faqs_register() {  

    $labels = array(
        'name' => _x('FAQs', 'post type general name', "swiftframework"),
        'singular_name' => _x('Question', 'post type singular name', "swiftframework"),
        'add_new' => _x('Add New', 'question', "swiftframework"),
        'add_new_item' => __('Add New Question', "swiftframework"),
        'edit_item' => __('Edit Question', "swiftframework"),
        'new_item' => __('New Question', "swiftframework"),
        'view_item' => __('View Question', "swiftframework"),
        'search_items' => __('Search Questions', "swiftframework"),
        'not_found' =>  __('No questions have been added yet', "swiftframework"),
        'not_found_in_trash' => __('Nothing found in Trash', "swiftframework"),
        'parent_item_colon' => ''
    );

    $args = array(  
        'labels' => $labels,  
        'public' => true,  
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_icon'=> 'dashicons-editor-help',
        'rewrite' => false,
        'supports' => array('title', 'editor'),
        'has_archive' => true,
        'taxonomies' => array('faqs-category', 'post_tag')
       );  
  
    register_post_type( 'faqs' , $args );  
}  

add_filter("manage_edit-faqs_columns", "faqs_edit_columns");   
  
function faqs_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Question",
            "description" => "Answer",
            "faqs-category" => "Topics"  
        );  
  
        return $columns;  
}  

add_action("manage_posts_custom_column",  "faqs_custom_columns"); 
  
function faqs_custom_columns($column){  
        global $post;  
        switch ($column)  
        {  
            case "description":  
                break;
            case "faqs-category":
                echo get_the_term_list($post->ID, 'faqs-category', '', ', ','');
                break;
        }  
}  

?>