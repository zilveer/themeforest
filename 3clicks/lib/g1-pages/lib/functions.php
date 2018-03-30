<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Pages_Module
 * @since G1_Pages_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_Pages_Base_Module extends G1_Module {

    private $prefix;

    private $post_type;

    public function __construct() {
        parent::__construct();

        $this->set_version('1.0.0');
        $this->set_prefix( 'g1_page' );
        $this->set_post_type( 'page' );
    }

    public function set_prefix( $val ) { $this->prefix = $val; }
    public function get_prefix() { return $this->prefix; }

    public function set_post_type( $val ) { $this->post_type = $val; }
    public function get_post_type() { return $this->post_type; }


    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'init',                             array( $this, 'add_post_type_support' ) );

        add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options' ) );

        add_filter( 'pre_option_page_for_posts',    array($this, 'pre_option_page_for_posts' ) );
        add_filter( 'pre_option_page_on_front',     array($this, 'pre_option_page_on_front' ) );
        add_filter( 'pre_option_show_on_front',     array($this, 'pre_option_show_on_front' ) );
        add_filter( 'nav_menu_css_class',           array($this, 'fix_nav_menu_css_class' ), 10, 2);

        add_action( 'g1_collections_register',          array( $this, 'register_collections' ) );
    }

    public function add_post_type_support() {
        $features = array(
            'g1-collection-element-title',
            'g1-collection-element-featured-media',
            'g1-collection-element-summary',
            'g1-collection-element-button-1',
            //
            'g1-single-entry-settings',
            'g1-single-entry-subtitle',
            //
            'g1-single-element-slider',
            'g1-single-element-gmap',
            'g1-single-element-breadcrumbs',
            'g1-single-element-title',
            'g1-single-element-media-box',
            'g1-single-element-sidebar-1',
            //
            'g1-relations',
        );

        foreach ( $features as $feature ) {
            add_post_type_support( $this->get_post_type(), $feature );
        }
    }


    /**
     * Registers collections
     */
    public function register_collections( $manager ) {
        $collections = array(
            'one_fourth',
            'one_third',
        );

        foreach ( $collections as $collection ) {
            if ( $manager->has_collection( $collection ) ) {
                $manager->get_collection( $collection )->add_post_type( $this->get_post_type() );
            }
        }
    }


    public function add_theme_options( $sections ) {
        if ( G1_WPML_LOADED && apply_filters('g1_disable_home_page_choices_translation', true) ) {
            global $sitepress;

            $default_lang = $sitepress->get_default_language();
            $current_lang = $sitepress->get_current_language();

            $sitepress->switch_lang($default_lang);

            $home_page_choices = G1_Pages_Module()->get_choices();

            $sitepress->switch_lang($current_lang);
        } else {
            $home_page_choices = G1_Pages_Module()->get_choices();
        }

        $sections['pages'] = array(
            'priority'   => 200,
            'icon'       => 'edit',
            'icon_class' => 'icon-large',
            'title'      => __( 'Pages', Redux_TEXT_DOMAIN ),
            'fields'     => array(
                // Pages
                array(
                    'id'        => 'post_type_page_home_page',
                    'priority'  => 1,
                    'type'      => 'select',
                    'title'     => __( 'Home Page', Redux_TEXT_DOMAIN ),
                    'desc'	    => '<p>' . __( 'If you want to set the Blog Page as the Home Page, leave this option blank or select the Blog Page.', Redux_TEXT_DOMAIN ) . '</p>',
                    'sub_desc'	=> __( 'Which page should be the home page?', Redux_TEXT_DOMAIN ),
                    'options'	=> (array('' => '') + $home_page_choices),
                ),
                array(
                    'id'        => 'post_type_page_comment_status',
                    'priority'  => 10,
                    'type'      => 'select',
                    'title'     => __( 'Allow Comments', Redux_TEXT_DOMAIN ),
                    'sub_desc'	=> __( 'These setting may be overridden for individual page.', Redux_TEXT_DOMAIN ),
                    'options'	=> array(
                        'open'      => __( 'on', Redux_TEXT_DOMAIN ),
                        'closed'    => __( 'off', Redux_TEXT_DOMAIN ),
                    ),
                    'switch'    => true,
                    'std'       => 'closed'
                ),
                array(
                    'id'        => 'post_type_page_ping_status',
                    'priority'  => 20,
                    'type'      => 'select',
                    'title'     => __( 'Allow Trackbacks And Pingbacks', Redux_TEXT_DOMAIN ),
                    'sub_desc'	=> __( 'These setting may be overridden for individual page.', Redux_TEXT_DOMAIN ),
                    'options'	=> array(
                        'open'      => __( 'on', Redux_TEXT_DOMAIN ),
                        'closed'    => __( 'off', Redux_TEXT_DOMAIN ),
                    ),
                    'switch'    => true,
                    'std'       => 'closed'
                ),
            )
        );

        return $sections;
    }

    /**
     * Replace the "page_for_posts" option with the "post_index_page" theme option
     *
     * @param mixed $value
     * @return mixed
     */
    public function pre_option_page_for_posts( $value ) {
        $index = absint( g1_get_theme_option( 'post_type_post', 'page_for_posts' ) );

        // WPML fallback
        if ( G1_WPML_LOADED ) {
            $index = absint( icl_object_id( $index, 'page', true ) );
        }

        return $index;
    }

    /**
     * Replace the "page_on_front" option with the "page_home_page" theme option
     *
     * @param mixed $value
     * @return mixed
     */
    public function pre_option_page_on_front( $value ) {
        $page_id = absint( g1_get_theme_option( 'post_type_page', 'home_page' ) );

        // WPML fallback
        if ( G1_WPML_LOADED ) {
            $page_id = absint( icl_object_id( $page_id, 'page', true ) );
        }

        return $page_id;
    }


    /**
     * Replace the "show_on_front" option with the custom solution.
     *
     * Determines the "show_on_front" option based on the "post_index_page" and
     * the "page_home_page" theme options.
     *
     * @param mixed $value
     * @return mixed
     */
    public function pre_option_show_on_front( $value ) {
        $page_on_front 	= absint( g1_get_theme_option( 'post_type_page', 'home_page' ) );
        $page_for_posts = absint( g1_get_theme_option( 'post_type_post', 'page_for_posts' ) );

        if ( !$page_on_front ) {
            return 'posts';
        }

        if ( $page_on_front === $page_for_posts ) {
            return 'posts';
        }

        return 'page';
    }


    /**
     * Gets pages as an associative array (id => name)
     *
     * @return array
     */
    public function get_choices() {
        static $result = null;

        if( $result !== null ) {
            return $result;
        }

        $result = array();
        $pages = wp_dropdown_pages( array(
            'depth'            => 0,
            'child_of'         => 0,
            'selected'         => 0,
            'echo'             => 0,
            'name'             => 'page_id',
        ));

        $key = null;
        $value = null;
        $pattern = '/value=(\")?[0-9]{1,}(\")?/';


        $pages = strip_tags( $pages, '<option>' );
        $pages = explode('<option', $pages);

        foreach( $pages as $page ) {
            if ( preg_match($pattern, $page, $key) ) {
                $key = $key[0];
                $key = intval( preg_replace('/[^0-9]/', '', $key ) );
            }

            $value = strip_tags( '<option'. $page );

            if ( $key ) {
                $result[ $key ] = $value;
            }
        }

        return $result;
    }


    /**
     * Fixes CSS classes in custom navigation menus.
     *
     * @param array $classes
     * @param object $item
     */
    public function fix_nav_menu_css_class( $classes, $item ) {
        if ( is_404() || is_search() ) {
            // Remove current_page_parent class from the blog index page
            if ( get_option( 'page_for_posts' ) == $item->object_id && $this->get_post_type() == $item->object ) {
                $classes = array_diff( $classes, array( 'current_page_parent') );
            }
        }

        return $classes;
    }
}



if ( !class_exists( 'G1_Pages_Module' ) ) :
    /**
     * Final class for our module
     *
     * This class is intentionally left empty!
     * To extend (modify) the base class, define the G1_Pages_Module class in your child theme.
     */
    final class G1_Pages_Module extends G1_Pages_Base_Module {
    }
endif;