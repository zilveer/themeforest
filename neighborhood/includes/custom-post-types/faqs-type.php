<?php

	/* ==================================================

	FAQs Post Type Functions

	================================================== */

	/* FAQS CATEGORY
	================================================== */
    if ( !function_exists('sf_faqs_category_register') ) {
    	function sf_faqs_category_register() {

    		$faqs_permalinks = get_option( 'sf_faqs_permalinks' );

    	    $args = array(
    	        "label" 						=> __('Topics', 'swiftframework'),
    	        "singular_label" 				=> __('Topic', 'swiftframework'),
    	        'public'                        => true,
    	        'hierarchical'                  => true,
    	        'show_ui'                       => true,
    	        'show_in_nav_menus'             => false,
    	        'args'                          => array( 'orderby' => 'term_order' ),
    	        'rewrite'           => array(
                    'slug'       => empty( $faqs_permalinks['category_base'] ) ? __( 'faqs-category', 'swiftframework' ) : __( $faqs_permalinks['category_base']  , 'swiftframework' ),
                    'with_front' => false
                ),
                'query_var'         => true
    	    );

    	    register_taxonomy( 'faqs-category', 'faqs', $args );
    	}
    	add_action( 'init', 'sf_faqs_category_register' );
    }


	/* FAQS POST TYPE
    ================================================== */
    if ( !function_exists('sf_faqs_register') ) {
        function sf_faqs_register() {

    		$faqs_permalinks = get_option( 'sf_faqs_permalinks' );
            $faqs_permalink  = empty( $faqs_permalinks['faqs_base'] ) ? __( 'faqs', 'swiftframework' ) : __( $faqs_permalinks['faqs_base'] , 'swiftframework' );

            $labels = array(
                'name' => __('FAQs', 'swiftframework'),
                'singular_name' => __('Question', 'swiftframework'),
                'add_new' => __('Add New', 'swiftframework'),
                'add_new_item' => __('Add New Question', 'swiftframework'),
                'edit_item' => __('Edit Question', 'swiftframework'),
                'new_item' => __('New Question', 'swiftframework'),
                'view_item' => __('View Question', 'swiftframework'),
                'search_items' => __('Search Questions', 'swiftframework'),
                'not_found' =>  __('No questions have been added yet', 'swiftframework'),
                'not_found_in_trash' => __('Nothing found in Trash', 'swiftframework'),
                'parent_item_colon' => ''
            );

            $args = array(
                'labels'            => $labels,
                'public'            => true,
                'show_ui'           => true,
                'show_in_menu'      => true,
                'show_in_nav_menus' => true,
                'menu_icon'=> 'dashicons-editor-help',
                'rewrite'           => $faqs_permalink != "faqs" ? array(
                    'slug'       => untrailingslashit( $faqs_permalink ),
                    'with_front' => false,
                    'feeds'      => true
                )
                    : false,
                'supports' => array('title', 'editor'),
                'has_archive' => true,
                'taxonomies' => array('faqs-category', 'post_tag')
            );

            register_post_type( 'faqs', $args );
        }
        add_action( 'init', 'sf_faqs_register' );
    }


	/* FAQS POST TYPE COLUMNS
	================================================== */
    if ( !function_exists('faqs_edit_columns') ) {
    	function faqs_edit_columns($columns){
            $columns = array(
                "cb" => "<input type=\"checkbox\" />",
                "title" => __("Question", 'swiftframework'),
                "description" => __("Answer", 'swiftframework'),
                "faqs-category" => __("Topics", 'swiftframework')
            );

            return $columns;
    	}

    	add_filter("manage_edit-faqs_columns", "faqs_edit_columns");
    }
?>