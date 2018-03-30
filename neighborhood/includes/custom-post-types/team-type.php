<?php

    /* ==================================================

    Team Post Type Functions

    ================================================== */


    /* TEAM CATEGORY
    ================================================== */
    if ( !function_exists('sf_team_category_register') ) {
        function sf_team_category_register() {

            $team_permalinks = get_option( 'sf_team_permalinks' );

            $args = array(
                "label"             => __( 'Team Categories', 'swiftframework' ),
                "singular_label"    => __( 'Team Category', 'swiftframework' ),
                'public'            => true,
                'hierarchical'      => true,
                'show_ui'           => true,
                'show_in_nav_menus' => false,
                'args'              => array( 'orderby' => 'term_order' ),
                'rewrite'           => array(
                    'slug'       => empty( $team_permalinks['category_base'] ) ? __( 'team-category', 'swiftframework' ) : __( $team_permalinks['category_base']  , 'swiftframework' ),
                    'with_front' => false
                ),
                'query_var'         => true
            );

            register_taxonomy( 'team-category', 'team', $args );
        }
        add_action( 'init', 'sf_team_category_register' );
    }


    /* TEAM POST TYPE
    ================================================== */
    if ( !function_exists('sf_team_register') ) {
        function sf_team_register() {

            $team_permalinks = get_option( 'sf_team_permalinks' );
            $team_permalink  = empty( $team_permalinks['team_base'] ) ? __( 'team', 'swiftframework' ) : __( $team_permalinks['team_base']  , 'swiftframework' );

            $labels = array(
                'name'               => __( 'Team', 'swiftframework' ),
                'singular_name'      => __( 'Team Member', 'swiftframework' ),
                'add_new'            => __( 'Add New', 'team member', 'swiftframework' ),
                'add_new_item'       => __( 'Add New Team Member', 'swiftframework' ),
                'edit_item'          => __( 'Edit Team Member', 'swiftframework' ),
                'new_item'           => __( 'New Team Member', 'swiftframework' ),
                'view_item'          => __( 'View Team Member', 'swiftframework' ),
                'search_items'       => __( 'Search Team Members', 'swiftframework' ),
                'not_found'          => __( 'No team members have been added yet', 'swiftframework' ),
                'not_found_in_trash' => __( 'Nothing found in Trash', 'swiftframework' ),
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'            => $labels,
                'public'            => true,
                'show_ui'           => true,
                'show_in_menu'      => true,
                'show_in_nav_menus' => true,
                'menu_icon'         => 'dashicons-groups',
                'rewrite'           => $team_permalink != "team" ? array(
                    'slug'       => untrailingslashit( $team_permalink ),
                    'with_front' => false,
                    'feeds'      => true
                )
                    : false,
                'supports'          => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
                'has_archive'       => true,
                'taxonomies'        => array( 'team-category', 'post_tag' )
            );

            register_post_type( 'team', $args );
        }
        add_action( 'init', 'sf_team_register' );
    }


    /* TEAM POST TYPE COLUMNS
    ================================================== */
    if ( !function_exists('sf_team_edit_columns') ) {
        function sf_team_edit_columns( $columns ) {
            $columns = array(
                "cb"            => "<input type=\"checkbox\" />",
                "thumbnail"     => "",
                "title"         => __( "Team Member", 'swiftframework' ),
                "description"   => __( "Description", 'swiftframework' ),
                "team-category" => __( "Categories", 'swiftframework' )
            );

            return $columns;
        }
        add_filter( "manage_edit-team_columns", "sf_team_edit_columns" );
    }

?>