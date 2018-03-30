<?php
/*=====================*/

// Service Post Type

/*=====================*/

add_action( "init", "register_cpt_service" );

function register_cpt_service() {

    $labels = array( 
        "name" => __( "Services", "shorti" ),
        "singular_name" => __( "Service", "shorti" ),
        "add_new" => __( "Add New", "shorti" ),
        "add_new_item" => __( "Add New Service", "shorti" ),
        "edit_item" => __( "Edit Service", "shorti" ),
        "new_item" => __( "New Service", "shorti" ),
        "view_item" => __( "View Service", "shorti" ),
        "search_items" => __( "Search services", "shorti" ),
        "not_found" => __( "No services found", "shorti" ),
        "not_found_in_trash" => __( "No services found in Trash", "shorti" ),
        "parent_item_colon" => __( "Parent Service:", "shorti" ),
        "menu_icon" => get_template_directory_uri("template_directory") . "/images/social.png",
        "menu_name" => __( "Services", "shorti" ),
    );

    $args = array( 
        "labels" => $labels,
        "hierarchical" => false,
        "description" => "",
        "supports" => array( "title", "editor", "excerpt", "thumbnail", "post-formats", "comments" ),
        "taxonomies" => array( "page-category", "caption", "url" ),
        "public" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        
        "menu_position" => 27,
        "show_in_nav_menus" => true,
        "publicly_queryable" => true,
        "exclude_from_search" => false,
        "has_archive" => true,
        "query_var" => true,
        "can_export" => true,
        "rewrite" => true,
        "capability_type" => "post"
    );

    register_post_type( "service", $args );
}

register_taxonomy("services", array("service"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category: ", "rewrite" => true));

/*=====================*/

// Project Post Type

/*=====================*/

add_action( "init", "register_cpt_project" );

function register_cpt_project() {

    $labels = array( 
        "name" => __( "Projects", "shorti" ),
        "singular_name" => __( "Project", "shorti" ),
        "add_new" => __( "Add New", "shorti" ),
        "add_new_item" => __( "Add New Project", "shorti" ),
        "edit_item" => __( "Edit Project", "shorti" ),
        "new_item" => __( "New Project", "shorti" ),
        "view_item" => __( "View Project", "shorti" ),
        "search_items" => __( "Search Work", "shorti" ),
        "not_found" => __( "No projects found", "shorti" ),
        "not_found_in_trash" => __( "No projects found in Trash", "shorti" ),
        "parent_item_colon" => __( "Parent Project:", "shorti" ),
        "menu_icon" => get_template_directory_uri("template_directory") . "/images/social.png",
        "menu_name" => __( "Projects", "shorti" ),
    );

    $args = array( 
        "labels" => $labels,
        "hierarchical" => false,
        "description" => "",
        "supports" => array( "title", "editor", "excerpt", "thumbnail", "post-formats", "comments" ),
        "taxonomies" => array( "post_tag", "page-category", "caption", "url" ),
        "public" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        
        "menu_position" => 28,
        "show_in_nav_menus" => true,
        "publicly_queryable" => true,
        "exclude_from_search" => false,
        "has_archive" => true,
        "query_var" => true,
        "can_export" => true,
        'rewrite' => array('slug' => 'project'),
        "capability_type" => "post"
    );

    register_post_type( "project", $args );
}

register_taxonomy("projects", array("project"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category: ", "rewrite" => true));