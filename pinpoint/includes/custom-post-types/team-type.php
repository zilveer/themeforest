<?php

/* ==================================================

Team Post Type Functions

================================================== */
    
    
$args = array(
    "label" 						=> "Team Categories", 
    "singular_label" 				=> "Team Category", 
    'public'                        => true,
    'hierarchical'                  => true,
    'show_ui'                       => true,
    'show_in_nav_menus'             => false,
    'args'                          => array( 'orderby' => 'term_order' ),
    'rewrite'                       => false,
    'query_var'                     => true
);

register_taxonomy( 'team-category', 'team', $args );


add_action('init', 'team_register');  
  
function team_register() {  

    $labels = array(
        'name' => _x('Team', 'post type general name', "swiftframework"),
        'singular_name' => _x('Team Member', 'post type singular name', "swiftframework"),
        'add_new' => _x('Add New', 'team member', "swiftframework"),
        'add_new_item' => __('Add New Team Member', "swiftframework"),
        'edit_item' => __('Edit Team Member', "swiftframework"),
        'new_item' => __('New Team Member', "swiftframework"),
        'view_item' => __('View Team Member', "swiftframework"),
        'search_items' => __('Search Team Members', "swiftframework"),
        'not_found' =>  __('No team members have been added yet', "swiftframework"),
        'not_found_in_trash' => __('Nothing found in Trash', "swiftframework"),
        'parent_item_colon' => ''
    );

    $args = array(  
        'labels' => $labels,  
        'public' => true,  
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_icon'=> 'dashicons-groups',
        'rewrite' => false,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'taxonomies' => array('team-category', 'post_tag')
       );  
  
    register_post_type( 'team' , $args );  
}  

add_filter("manage_edit-team_columns", "team_edit_columns");   
  
function team_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Team Member",
            "description" => "Description",
            "team-category" => "Categories"  
        );  
  
        return $columns;  
}  

add_action("manage_posts_custom_column",  "team_custom_columns"); 
  
function team_custom_columns($column){  
        global $post;  
        switch ($column)  
        {  
            case "description":  
                break;
            case "team-category":
                echo get_the_term_list($post->ID, 'team-category', '', ', ','');
                break;
        }  
}  

?>