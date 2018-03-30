<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Works_Module
 * @since G1_Works_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

class G1_Works_Base_Module extends G1_CPT_Module {
    public function __construct() {
        parent::__construct();

        $this->set_version('1.0.0');

        $this->set_prefix( 'g1_work' );
        $this->set_post_type( 'g1_work' );

        $this->set_category_taxonomy( 'g1_work_category' );
        $this->set_category_slug( 'g1_work_category' );

        $this->set_tag_taxonomy( 'g1_work_tag' );
        $this->set_tag_slug( 'g1_work_tag' );

    }

    public function setup_hooks() {
        parent::setup_hooks();

        // Register custom post type and custom taxonomies
        add_action( 'init',                             array( $this, 'register_post_type' ) );
        add_action( 'init',                             array( $this, 'register_category' ) );
        add_action( 'init',                             array( $this, 'register_tag' ) );


        add_action( 'g1_archive_templates_register',    array( $this, 'register_archive_templates' ) );
        add_action( 'g1_single_templates_register',     array( $this, 'register_single_templates' ) );
        add_action( 'g1_collections_register',          array( $this, 'register_collections' ) );

        add_filter( 'manage_g1_work_posts_columns',     array( $this, 'edit_columns' ) );
        add_action( 'manage_posts_custom_column',       array( $this, 'columns_display') );


        add_filter( 'g1_filterable_grid_filters',       array( $this, 'g1_filterable_grid_filters' ) );

        add_filter( 'wp_title',                         array( $this, 'archive_title' ), 16, 3 );
    }

    public function archive_title( $title, $separator = '', $separator_location = '' ) {
        if ( is_post_type_archive( 'g1_work' ) ) {
            $works_page_id = absint( g1_get_theme_option( 'post_type_' . $this->get_post_type(), 'page_for_posts' ) );

            // WPML fallback
            if ( function_exists( 'wpml_object_id_filter' ) ) {
                $works_page_id = absint( wpml_object_id_filter( $works_page_id, 'page', true ) );
            }

            if ( $works_page_id ) {
                $title = get_the_title( $works_page_id );

                // Use SEO by Yoast titles.
                if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
                    $page_title =  get_post_meta( $works_page_id, '_yoast_wpseo_title', true);

                    // Get title from Yoast SEO metabox.
                    if ( ! empty( $page_title ) ) {
                        $title = $page_title;
                    }
                }
            }
        }

        return $title;
    }


    public function g1_filterable_grid_filters( $filters ) {
        if ( is_post_type_archive( $this->get_post_type() ) ) {
            unset( $filters[ $this->get_tag_taxonomy() ] );
        }

        return $filters;
    }


    /**
     * Customize appearance of work listing page (admin panel).
     *
     * Add/remove some columns
     */
    public function edit_columns( $columns ){
        $tax_obj = get_taxonomy( $this->get_category_taxonomy() );
        if ( $tax_obj )
            $columns[ $this->get_category_taxonomy() ] = $tax_obj->labels->name;

        $tax_obj = get_taxonomy( $this->get_tag_taxonomy() );
        if ( $tax_obj )
            $columns[ $this->get_tag_taxonomy() ] = $tax_obj->labels->name;


        $columns[ 'featured_image' ]     = __('Featured Image', 'g1_theme');


        return $columns;
    }


    /* Customize appearance of work listing page (admin panel).
    * Render columns */
    public function columns_display($column_name){
        global $post;

        switch ( $column_name ) {
            case $this->get_category_taxonomy():
                echo get_the_term_list( $post->ID, $this->get_category_taxonomy(), '<p>', ',', '</p>' );
                break;

            case $this->get_tag_taxonomy():
                echo get_the_term_list( $post->ID, $this->get_tag_taxonomy(), '<p>', ',', '</p>' );
                break;

            case 'featured_image':
                the_post_thumbnail( 'thumbnail' );
                break;

            default:
                return;
                break;
        }
    }


    /**
     * Registers custom post type "g1_work"
     *
     * If you want to modify some paremeters, hook into the g1_pre_register_post_type custom filter.
     */
    public function register_post_type() {
        $slug = sanitize_title( g1_get_theme_option( 'post_type_' . $this->get_post_type(), 'rewrite_slug' ) );
        $slug =  strlen( $slug ) ? $slug : 'work';

        $args = array(
            'label'		=> __('Works', 'g1_theme'),
            'labels'	=> array(
                'name'					=> __( 'Works', 'g1_theme' ),
                'singular_name' 		=> __( 'Work', 'g1_theme' ),
                'add_new' 				=> __( 'Add new', 'g1_theme' ),
                'all_items' 			=> __( 'All Works', 'g1_theme' ),
                'add_new_item' 			=> __( 'Add new Work', 'g1_theme' ),
                'edit_item' 			=> __( 'Edit Work', 'g1_theme' ),
                'new_item' 				=> __( 'New Work', 'g1_theme' ),
                'view_item' 			=> __( 'View Work', 'g1_theme' ),
                'search_items' 			=> __( 'Search Works', 'g1_theme' ),
                'not_found' 			=> __( 'No Works found', 'g1_theme' ),
                'not_found_in_trash'	=> __( 'No Works found in Trash', 'g1_theme' ),
                'parent_item_colon' 	=> __( 'Parent Work', 'g1_theme' ),
                'menu_name'				=> __( 'Works', 'g1_theme' ),
            ),
            'public'				=> true,
            'publicly_queryable'	=> true,
            'exclude_from_search'	=> false,
            'show_ui'				=> true,
            'show_in_menu'			=> true,
            'hierarchical'			=> false,
            'has_archive'			=> true,
            'rewrite'				=> array(
                'slug' => _x( $slug, 'URL slug', 'g1_theme' ),
                'with_front' => true
            ),
            'query_var'				=> $this->get_post_type(),
            'can_export'			=> true,
            'show_in_nav_menus'		=> true,
            //'capability_type'       => $this->get_post_type(),
            //'map_meta_cap'          => true,
            'supports'				=> array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'comments',
                'revisions',
                'post-formats',
                //
                'g1-archive-page',
                'g1-archive-settings',

                'g1-global-archive-template',

                'g1-global-rewrite-slug',

                'g1-global-archive-posts-per-page',
                'g1-archive-collection',
                'g1-single-settings',
                'g1-single-template',
                //
                'g1-collection-global-elements',
                'g1-collection-element-title',
                'g1-collection-element-featured-media',
                'g1-collection-element-date',
                'g1-collection-element-comments-link',
                'g1-collection-element-summary',
                'g1-collection-element-categories',
                'g1-collection-element-tags',
                'g1-collection-element-button-1',
                //
                'g1-single-entry-settings',
                'g1-single-entry-template',
                'g1-single-entry-subtitle',
                //

                'g1-single-global-elements',
                'g1-single-individual-elements',

                'g1-single-element-slider',
                'g1-single-element-breadcrumbs',
                'g1-single-element-title',
                'g1-single-element-media-box',
                'g1-single-element-date',
                'g1-single-element-comments-link',
                'g1-single-element-categories',
                'g1-single-element-tags',
                'g1-single-element-sidebar-1',
                'g1-single-element-related-entries',
                //
                'g1-relations',

            ),
        );

        // Apply custom filters (this way Child Themes can change some arguments)
        $args = apply_filters( 'g1_pre_register_post_type', $args, $this->get_post_type() );

        register_post_type( $this->get_post_type(), $args );
    }


    /**
     * Registers custom category (hierarchical taxonomy to be exact)
     *
     * If you want to modify some paremeters, hook into the g1_pre_register_custonomy custom filter.
     */
    public function register_category() {
        $slug = sanitize_title( g1_get_theme_option( 'taxonomy_' . $this->get_category_taxonomy(), 'rewrite_slug' ) );
        $slug = strlen( $slug ) ? $slug : 'work-category';

        // Compose arguments for g1_work_category
        $args = array(
            'label' 				=> __('Work Category', 'g1_theme'),
            'labels'				=> array(
                'name' 					=> __( 'Work Categories', 'g1_theme' ),
                'singular_name' 		=> __( 'Work Category', 'g1_theme' ),
                'search_items' 			=> __( 'Search Work Categories', 'g1_theme' ),
                'popular_items' 		=> __( 'Popular Work Categories', 'g1_theme' ),
                'all_items' 			=> __( 'All Work Categories', 'g1_theme' ),
                'parent_item' 			=> __( 'Parent Work Category', 'g1_theme' ),
                'parent_item_colon' 	=> __( 'Parent Work Category:', 'g1_theme' ),
                'edit_item' 			=> __( 'Edit Work Category', 'g1_theme' ),
                'update_item' 			=> __( 'Update Work Category', 'g1_theme' ),
                'add_new_item' 			=> __( 'Add New Work Category', 'g1_theme' ),
                'new_item_name' 		=> __( 'New Work Category', 'g1_theme' ),
                'menu_name' 			=> __( 'Work Categories', 'g1_theme' ),
            ),
            'query_var' 			=> $this->get_category_taxonomy(),
            'rewrite' 				=> array(
                'slug' => _x( $slug, 'URL slug', 'g1_theme' ),
                'with_front' => true
            ),
            'public'				=> true,
            'hierarchical' 			=> true,
            'show_in_nav_menus'		=> true,
            'show_ui'				=> true,
            'show_tagcloud'			=> true,
        );

        // Apply custom filters (this way Child Themes can change some arguments)
        $args = apply_filters( 'g1_pre_register_custonomy', $args, $this->get_category_taxonomy() );

        register_taxonomy( $this->get_category_taxonomy(), array( $this->get_post_type()), $args );

        $features = array(
            'g1-archive-settings',

            'g1-global-rewrite-slug',

            'g1-global-archive-template',
            'g1-individual-archive-template',

            'g1-global-archive-posts-per-page',
            'g1-individual-archive-posts-per-page',

            // sidebar
            'g1-global-archive-sidebar-1',
            'g1-individual-archive-sidebar-1',

            'g1-collection-global-elements',
            'g1-collection-individual-elements',
            //
            'g1-single-entry-settings',
            'g1-single-entry-template',
        );

        foreach ( $features as $feature ) {
            add_taxonomy_support( $this->get_category_taxonomy(), $feature );
        }
    }



    /**
     * Registers custom tag (taxonomy to be exact)
     *
     * If you want to modify some paremeters, hook into the g1_pre_register_custonomy custom filter.
     */
    public function register_tag() {
        $slug = sanitize_title( g1_get_theme_option( 'taxonomy_' . $this->get_tag_taxonomy(), 'rewrite_slug' ) );
        $slug = strlen( $slug ) ? $slug : 'work-tag';

        // Compose arguments for g1_work_tag
        $args = array(
            'label' 				=> __('Work Tag', 'g1_theme'),
            'labels'				=> array(
                'name' 					=> __( 'Work Tags', 'g1_theme' ),
                'singular_name' 		=> __( 'Work Tag', 'g1_theme' ),
                'search_items' 			=> __( 'Search Work Tags', 'g1_theme' ),
                'popular_items' 		=> __( 'Popular Work Tags', 'g1_theme' ),
                'all_items' 			=> __( 'All Work Tags', 'g1_theme' ),
                'parent_item' 			=> __( 'Parent Work Tag', 'g1_theme' ),
                'parent_item_colon' 	=> __( 'Parent Work Tag:', 'g1_theme' ),
                'edit_item' 			=> __( 'Edit Work Tag', 'g1_theme' ),
                'update_item' 			=> __( 'Update Work Tag', 'g1_theme' ),
                'add_new_item' 			=> __( 'Add New Work Tag', 'g1_theme' ),
                'new_item_name' 		=> __( 'New Work Tag', 'g1_theme' ),
                'menu_name' 			=> __( 'Work Tags', 'g1_theme' ),
            ),
            'query_var' 			=> $this->get_tag_taxonomy(),
            'rewrite' 				=> array(
                'slug' => _x( $slug, 'URL slug', 'g1_theme' ),
                'with_front' => true
            ),
            'public'				=> true,
            'hierarchical' 			=> false,
            'show_in_nav_menus'		=> true,
            'show_ui'				=> true,
            'show_tagcloud'			=> true,
        );

        // Apply custom filters (this way Child Themes can change some arguments)
        $args = apply_filters( 'g1_pre_register_taxonomy', $args, $this->get_category_taxonomy() );

        register_taxonomy( $this->get_tag_taxonomy(), array( $this->get_post_type() ), $args );

        $features = array(
            'g1-archive-settings',

            'g1-global-rewrite-slug',

            'g1-global-archive-template',
            'g1-individual-archive-template',

            'g1-global-archive-posts-per-page',
            'g1-individual-archive-posts-per-page',

            // sidebar
            'g1-global-archive-sidebar-1',
            'g1-individual-archive-sidebar-1',

            'g1-collection-global-elements',
            'g1-collection-individual-elements',
            //
            'g1-single-entry-settings',
            'g1-single-entry-template',
        );

        foreach ( $features as $feature ) {
            add_taxonomy_support( $this->get_tag_taxonomy(), $feature );
        }
    }


    /**
     * Registers single templates
     */
    public function register_single_templates( $manager ) {
        $templates = array(
            'full',
            'overview_left',
            'overview_right',
            'sidebar_left',
            'sidebar_right',
        );

        foreach ( $templates as $template ) {
            if ( $manager->has_template( $template ) ) {
                $manager->get_template( $template )->add_post_type( $this->get_post_type() );
            }
        }
    }

    /**
     * Registers archive templates
     */
    public function register_archive_templates( $manager ) {
        $templates = array(
            '1col_sidebar_right',
            '1col_sidebar_left',
            '1col',
            '2col',
            '2col_filterable',
            '2col_gallery',
            '2col_gallery_filterable',
            '2col_sidebar_left',
            '2col_sidebar_right',
            '2col_filterable_sidebar_left',
            '2col_filterable_sidebar_right',
            '2col_gallery_sidebar_left',
            '2col_gallery_sidebar_right',
            '2col_gallery_filterable_sidebar_left',
            '2col_gallery_filterable_sidebar_right',
            '3col',
            '3col_filterable',
            '3col_gallery',
            '3col_masonry',
            '3col_gallery_filterable',
            '4col',
            '4col_gallery',
            '4col_masonry',
            '4col_filterable',
        );

        foreach ( $templates as $template ) {
            if ( $manager->has_template( $template ) ) {
                $manager->get_template( $template )->add_post_type( $this->get_post_type() );
            }
        }
    }

    /**
     * Registers collections
     */
    public function register_collections( $manager ) {
        $collections = array(
            'one_fourth',
            'one_fourth_gallery',
            'one_fourth_masonry',
            'one_third',
            'one_third_gallery',
            'one_third_masonry',
            'one_half',
            'one_half_gallery',
            'two_third',
            'full',
        );

        foreach ( $collections as $collection ) {
            if ( $manager->has_collection( $collection ) ) {
                $manager->get_collection( $collection )->add_post_type( $this->get_post_type() );
            }
        }
    }





    public function add_entry_options(){
        $post_type = $this->get_post_type();

        $arr = array(
            'g1-backgrounds',
            'g1-sliders',
            'g1-relations',
            'g1-individual-element-title',
            'g1-individual-element-breadcrumbs',
            'g1-individual-element-media-box',
            'g1-individual-element-date',
            'g1-individual-element-comments-link',
            'g1-individual-element-categories',
            'g1-individual-element-tags',
            'g1-individual-element-sidebar-1',
        );


        foreach( $arr as $x ) {
            add_post_type_support( $this->get_post_type(), $x );
        }
    }
}


if ( !class_exists( 'G1_Works_Module' ) ) :
/**
 * Final class for our module
 *
 * This class is intentionally left empty!
 * To extend (modify) the base class, define the G1_Works_Module class in your child theme.
 */
final class G1_Works_Module extends G1_Works_Base_Module {
}
endif;