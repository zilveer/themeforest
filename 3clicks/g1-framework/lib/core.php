<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Global
 * @subpackage G1_Global 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1 {
    /**
     * Singleton
     *
     * @var G1
     */
    private static $instance;

    /**
     * Version (major.minor.revision)
     *
     * @var string
     */
    protected $version;

    protected $current_template_path;

    protected function __construct() {
        $this->set_version( '1.0.0' );

        add_action( 'after_setup_theme', array( $this, 'setup_hooks' ) );
    }

    public static function get_instance() {
        if ( ! isset( self::$instance ) )
            self::$instance = new G1();

        return self::$instance;
    }


    public function set_version( $val ) { $this->version = $val; }
    public function get_version() { return $this->version; }

    /**
     * Set up all hooks
     */
    public function setup_hooks() {
        add_action( 'admin_enqueue_scripts',    array( $this, 'enqueue_resources' ) );

        add_filter( 'template_include',         array( $this, 'intercept_current_template_path' ), 1000 );
    }

    /**
     * Enqueues javascripts and stylesheets
     */
    public function enqueue_resources() {


        wp_enqueue_style(
            'g1_admin',
            trailingslashit( G1_FRAMEWORK_URI ) . '/admin/css/g1-admin.css',
            false,
            '1.0'
        );

        wp_enqueue_style(
            'rangeinput',
            trailingslashit( G1_FRAMEWORK_URI ) . 'admin/js/jquery.tools.rangeinput/jquery.tools.rangeinput.css'
        );

        wp_enqueue_style( 'thickbox' );



        // Include custom JS for proper behaviour of admin options
        wp_enqueue_script(
            'rangeinput',
            trailingslashit( G1_FRAMEWORK_URI ) . 'admin/js/jquery.tools.rangeinput/jquery.tools.rangeinput.min.js',
            array( 'jquery' )
        );

        wp_enqueue_script('thickbox');

        wp_enqueue_script(
            'metadata',
            get_template_directory_uri().'/js/jquery-metadata/jquery.metadata.js',
            array('jquery')
        );


        // Include custom JS for proper behaviour of admin options
        wp_enqueue_script(
            'main',
            trailingslashit( G1_FRAMEWORK_URI ) . 'admin/js/main.js',
            array( 'jquery' )
        );

        $parent_uri = trailingslashit( get_template_directory_uri() );
        $child_uri = trailingslashit( get_stylesheet_directory_uri() );

        // Register child theme related scripts
        if ( $parent_uri !== $child_uri ) {
            wp_enqueue_script(
                'g1_child_admin_main',
                $child_uri . 'modifications-admin.js',
                array('jquery', 'main')
            );
        }
    }


    /**
     * Captures custom styles
     *
     * @return string
     */
    public function capture_custom_css(){
        $css = '';
        $css = apply_filters( 'g1_custom_css', $css );
        $css = trim($css);

        return $css;
    }
    public function render_custom_css(){
        $css = $this->capture_custom_css();

        if ( !empty( $css ) ) {
            $css = 	"\n" .
                '<style type="text/css">'. "\n" .
                    '/* AUTO-GENERATED -------------------------------------------------- */' . "\n" .
                    //str_replace(array("\n", "\r"), '', $css) .
                    $css .
                '</style>' . "\n" ;
        }

        echo $css;
    }

    public function set_current_template_path( $val ) { $this->current_template_path = $val; }
    public function get_current_template_path() { return $this->current_template_path; }

    /**
     * Intercepts the path to the current template
     *
     * @param string $t
     * @return string
     */
    public function intercept_current_template_path( $t ){
        $this->set_current_template_path( $t );

        return $t;
    }
}

function G1() {
    return G1::get_instance();
}
// Fire in the hole :)
G1();




class G1_Module {
    protected $version;
    public function __construct() {
        $this->set_version( '1.0.0' );

        $this->setup_hooks();
    }

    public function set_version( $val ) { $this->version = $val; }
    public function get_version() { return $this->version; }

    protected function setup_hooks() {
        /* Nothing here yet */
    }
}




class G1_CPT_Module extends G1_Module {
    private $prefix;

    protected $post_type;

    private $category_taxonomy;
    private $category_slug;

    private $tag_taxonomy;
    private $tag_slug;

    public function set_category_taxonomy( $val ) { $this->category_taxonomy = $val; }
    public function get_category_taxonomy() { return $this->category_taxonomy; }

    public function set_category_slug( $val ) { $this->category_slug = $val; }
    public function get_category_slug() { return $this->category_slug; }

    public function set_tag_taxonomy( $val ) { $this->tag_taxonomy = $val; }
    public function get_tag_taxonomy() { return $this->tag_taxonomy; }

    public function set_tag_slug( $val ) { $this->tag_slug = $val; }
    public function get_tag_slug() { return $this->tag_slug; }

    public function set_prefix( $val ) { $this->prefix = $val; }
    public function get_prefix() { return $this->prefix; }


    protected function setup_hooks() {
        parent::setup_hooks();

        add_filter( 'nav_menu_css_class',               array( $this, 'fix_nav_menu_css_class'), 10, 2);

        add_filter( 'icl_ls_languages',                 array( $this, 'fix_wpml_language_switcher') );
    }

    public function set_post_type( $val ) { $this->post_type = $val; }
    public function get_post_type() { return $this->post_type; }



    /**
     * Fix post type archive links in the WPML language switcher
     *
     * param			array $langs
     * return			$langs
     */
    public function fix_wpml_language_switcher( $langs ) {
        if ( !G1_WPML_LOADED || !is_post_type_archive( $this->get_post_type() ) ) {
            return $langs;
        }

        $index = absint( g1_get_theme_option( 'post_type_' . $this->get_post_type(), 'page_for_posts' ) );

        foreach( $langs as $code => $def ) {
            // Translate Work Index Page ID
            $translated_index = absint( icl_object_id( $index, 'page', true, $def[ 'language_code' ] ) );
            // Replace link URL
            $langs[ $code ][ 'url' ] = apply_filters( 'the_permalink', get_permalink( $translated_index ) );
        }

        return $langs;
    }



    /**
     * Fixes CSS classes in custom navigation menus.
     *
     * @param array $classes
     * @param object $item
     */
    public function fix_nav_menu_css_class( $classes, $item ) {
        if ( $this->get_post_type() == get_post_type() ) {
            // Remove current_page_parent class from the blog index page
            if ( get_option( 'page_for_posts' ) == $item->object_id && 'page' == $item->object ) {
                $classes = array_diff( $classes, array( 'current_page_parent') );
            }

            $index = absint( g1_get_theme_option( 'post_type_' . $this->get_post_type(), 'page_for_posts' ) );

            // WPML fallback
            if ( G1_WPML_LOADED ) {
                $index = absint( icl_object_id( $index, 'page', true ) );
            }

            // Add current_page_parent class to the index page
            if ( $index == $item->object_id && 'page' == $item->object ) {
                $classes[] = 'current_page_parent';
            }
        }

        return $classes;
    }
}


function g1_get_term_meta( $tt_id, $meta_key ) {
    $temp = get_option( 'g1_tt_' . $tt_id, array() );

    $val = isset( $temp[ $meta_key] ) ? $temp[ $meta_key ] : null;

    return $val;
}
