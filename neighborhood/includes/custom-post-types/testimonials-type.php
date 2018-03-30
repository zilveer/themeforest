<?php

    /* ==================================================

    Testimonials Post Type Functions

    ================================================== */


    /* TESTIMONIAL CATEGORY
    ================================================== */
    if ( !function_exists('sf_testimonial_category_register') ) {
        function sf_testimonial_category_register() {
            $args = array(
                "label"             => __( 'Testimonial Categories', 'swiftframework' ),
                "singular_label"    => __( 'Testimonial Category', 'swiftframework' ),
                'public'            => true,
                'hierarchical'      => true,
                'show_ui'           => true,
                'show_in_nav_menus' => false,
                'args'              => array( 'orderby' => 'term_order' ),
                'rewrite'           => false,
                'query_var'         => true
            );

            register_taxonomy( 'testimonials-category', 'testimonials', $args );
        }
        add_action( 'init', 'sf_testimonial_category_register' );
    }


    /* TESTIMONIAL POST TYPE
    ================================================== */
    if ( !function_exists('sf_testimonials_register') ) {
        function sf_testimonials_register() {

            $labels = array(
                'name'               => __( 'Testimonials', 'swiftframework' ),
                'singular_name'      => __( 'Testimonial', 'swiftframework' ),
                'add_new'            => __( 'Add New', 'swiftframework' ),
                'add_new_item'       => __( 'Add New Testimonial', 'swiftframework' ),
                'edit_item'          => __( 'Edit Testimonial', 'swiftframework' ),
                'new_item'           => __( 'New Testimonial', 'swiftframework' ),
                'view_item'          => __( 'View Testimonial', 'swiftframework' ),
                'search_items'       => __( 'Search Testimonials', 'swiftframework' ),
                'not_found'          => __( 'No testimonials have been added yet', 'swiftframework' ),
                'not_found_in_trash' => __( 'Nothing found in Trash', 'swiftframework' ),
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'            => $labels,
                'public'            => true,
                'show_ui'           => true,
                'show_in_menu'      => true,
                'show_in_nav_menus' => false,
                'menu_icon'         => 'dashicons-format-quote',
                'rewrite'           => false,
                'supports'          => array( 'title', 'editor', 'custom-fields', 'excerpt' ),
                'has_archive'       => true,
                'taxonomies'        => array( 'testimonials-category' )
            );

            register_post_type( 'testimonials', $args );
        }
        add_action( 'init', 'sf_testimonials_register' );
    }


    /* TESTIMONIAL POST TYPE COLUMNS
    ================================================== */
    if ( !function_exists('sf_testimonials_edit_columns') ) {
        function sf_testimonials_edit_columns( $columns ) {
            $columns = array(
                "cb"                    => "<input type=\"checkbox\" />",
                "title"                 => __( "Testimonial", 'swiftframework' ),
                "testimonials-category" => __( "Categories", 'swiftframework' )
            );

            return $columns;
        }
        add_filter( "manage_edit-testimonials_columns", "sf_testimonials_edit_columns" );
    }
?>