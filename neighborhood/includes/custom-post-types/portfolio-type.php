<?php

    /* ==================================================

    Portfolio Post Type Functions

    ================================================== */


    /* PORTFOLIO CATEGORY
    ================================================== */
    if ( !function_exists('sf_portfolio_category_register') ) {
        function sf_portfolio_category_register() {

            $portfolio_permalinks = get_option( 'sf_portfolio_permalinks' );

            $args = array(
                "label"             => __( 'Portfolio Categories', 'swiftframework' ),
                "singular_label"    => __( 'Portfolio Category', 'swiftframework' ),
                'public'            => true,
                'hierarchical'      => true,
                'show_ui'           => true,
                'show_in_nav_menus' => false,
                'args'              => array( 'orderby' => 'term_order' ),
                'rewrite'           => array(
                    'slug'       => empty( $portfolio_permalinks['category_base'] ) ? __( 'portfolio-category', 'swiftframework' ) : __( $portfolio_permalinks['category_base']  , 'swiftframework' ),
                    'with_front' => false
                ),
                'query_var'         => true
            );
            register_taxonomy( 'portfolio-category', 'portfolio', $args );
        }

        add_action( 'init', 'sf_portfolio_category_register' );
    }


    /* PORTFOLIO POST TYPE
    ================================================== */
    if ( !function_exists('sf_portfolio_register') ) {
        function sf_portfolio_register() {

            $portfolio_permalinks = get_option( 'sf_portfolio_permalinks' );
            $portfolio_permalink  = empty( $portfolio_permalinks['portfolio_base'] ) ? __( 'portfolio', 'swiftframework' ) : __( $portfolio_permalinks['portfolio_base'] , 'swiftframework' );

            $labels = array(
                'name'               => __( 'Portfolio', 'swiftframework' ),
                'singular_name'      => __( 'Portfolio Item', 'swiftframework' ),
                'add_new'            => __( 'Add New', 'portfolio item', 'swiftframework' ),
                'add_new_item'       => __( 'Add New Portfolio Item', 'swiftframework' ),
                'edit_item'          => __( 'Edit Portfolio Item', 'swiftframework' ),
                'new_item'           => __( 'New Portfolio Item', 'swiftframework' ),
                'view_item'          => __( 'View Portfolio Item', 'swiftframework' ),
                'search_items'       => __( 'Search Portfolio', 'swiftframework' ),
                'not_found'          => __( 'No portfolio items have been added yet', 'swiftframework' ),
                'not_found_in_trash' => __( 'Nothing found in Trash', 'swiftframework' ),
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'            => $labels,
                'public'            => true,
                'show_ui'           => true,
                'show_in_menu'      => true,
                'show_in_nav_menus' => true,
                'menu_icon'         => 'dashicons-format-image',
                'hierarchical'      => false,
                'rewrite'           => $portfolio_permalink != "portfolio" ? array(
                    'slug'       => untrailingslashit( $portfolio_permalink ),
                    'with_front' => false,
                    'feeds'      => true
                )
                    : false,
                'supports'          => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'revisions' ),
                'has_archive'       => true,
                'taxonomies'        => array( 'portfolio-category' )
            );

            register_post_type( 'portfolio', $args );
        }

        add_action( 'init', 'sf_portfolio_register' );
    }


    /* PORTFOLIO POST TYPE COLUMNS
    ================================================== */
    if ( !function_exists('sf_portfolio_edit_columns') ) {
        function sf_portfolio_edit_columns( $columns ) {
            $columns = array(
                "cb"                 => "<input type=\"checkbox\" />",
                "thumbnail"          => "",
                "title"              => __( "Portfolio Item", 'swiftframework' ),
                "description"        => __( "Description", 'swiftframework' ),
                "portfolio-category" => __( "Categories", 'swiftframework' )
            );

            return $columns;
        }
        add_filter( "manage_edit-portfolio_columns", "sf_portfolio_edit_columns" );
    }

?>