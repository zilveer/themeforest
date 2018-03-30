<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Posts_Module
 * @since G1_Posts_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

class G1_Posts_Base_Module extends G1_CPT_Module {
    public function __construct() {
        parent::__construct();

        $this->set_version('1.0.0');

        $this->set_prefix( 'post' );
        $this->set_post_type( 'post' );

        $this->set_category_taxonomy( 'category' );
        $this->set_category_slug( 'category' );

        $this->set_tag_taxonomy( 'post_tag' );
        $this->set_tag_slug( 'post_tag' );

    }

    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'init',                             array( $this, 'add_post_type_support' ) );
        add_action( 'init',                             array( $this, 'add_category_support' ) );
        add_action( 'init',                             array( $this, 'add_tag_support' ) );

        add_action( 'g1_archive_templates_register',    array( $this, 'register_archive_templates' ) );
        add_action( 'g1_single_templates_register',     array( $this, 'register_single_templates' ) );
        add_action( 'g1_collections_register',          array( $this, 'register_collections' ) );

        add_filter( 'g1_filterable_grid_filters', array( $this, 'g1_filterable_grid_filters' ) );


        add_filter( 'manage_post_posts_columns', array( $this, 'edit_columns' ) );
        add_action( 'manage_posts_custom_column', array( $this, 'columns_display') );
    }

    public function g1_filterable_grid_filters( $filters ) {
        if( is_home() ) {
            unset( $filters['post_tag'] );
        }

        return $filters;
    }



    public function add_post_type_support() {
        $features = array(
            'post-formats',
            'g1-archive-page',
            'g1-archive-settings',

            'g1-global-archive-template',
            'g1-global-archive-posts-per-page',
            'g1-individual-archive-posts-per-page',

            'g1-archive-collection',
            'g1-single-settings',
            'g1-single-template',
            //
            'g1-collection-global-elements',
            'g1-collection-element-title',
            'g1-collection-element-featured-media',
            'g1-collection-element-date',
            'g1-collection-element-author',
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
            'g1-single-element-slider',
            'g1-single-element-breadcrumbs',
            'g1-single-element-title',
            'g1-single-element-media-box',
            'g1-single-element-date',
            'g1-single-element-author',
            'g1-single-element-comments-link',
            'g1-single-element-categories',
            'g1-single-element-tags',
            'g1-single-element-sidebar-1',
            'g1-single-element-related-entries',
            //
            'g1-relations',
        );

        add_post_type_support( $this->get_post_type(), $features );
    }



    public function add_category_support() {
        $features = array(
            'g1-archive-settings',
            'g1-archive-template',

            'g1-global-archive-template',
            'g1-individual-archive-template',

            // sidebar
            'g1-global-archive-sidebar-1',
            'g1-individual-archive-sidebar-1',


            'g1-global-archive-posts-per-page',
            'g1-individual-archive-posts-per-page',

            'g1-collection-global-elements',
            'g1-collection-individual-elements',
        );

        foreach ( $features as $feature ) {
            add_taxonomy_support( $this->get_category_taxonomy(), $feature );
        }
    }

    public function add_tag_support() {
        $features = array(
            'g1-archive-settings',
            'g1-archive-template',

            'g1-global-archive-template',
            'g1-individual-archive-template',

            // sidebar
            'g1-global-archive-sidebar-1',
            'g1-individual-archive-sidebar-1',

            'g1-global-archive-posts-per-page',
            'g1-individual-archive-posts-per-page',

            'g1-collection-global-elements',
            'g1-collection-individual-elements',
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
            'overview_right',
            'overview_left',
            'sidebar_right',
            'sidebar_left',
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
            '3col_gallery_filterable',
            '3col_masonry',
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


    /**
     * Customize appearance of work listing page (admin panel).
     *
     * Add/remove some columns
     */
    public function edit_columns( $columns ){
        $columns[ 'featured_image' ]     = __('Featured Image', 'g1_theme');

        return $columns;
    }


    /* Customize appearance of work listing page (admin panel).
    * Render columns */
    public function columns_display($column_name){
        global $post;

        if ( 'feature_image' === $column_name )
            the_post_thumbnail( 'thumbnail' );

    }
}


if ( !class_exists( 'G1_Posts_Module' ) ) :
    /**
     * Final class for our module
     *
     * This class is intentionally left empty!
     * To extend (modify) the base class, define the G1_Posts_Module class in your child theme.
     */
    final class G1_Posts_Module extends G1_Posts_Base_Module {
    }
endif;