<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_WooCommerce_Module
 * @since G1_WooCommerce_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_WooCommerce_Module extends G1_Module {
    private $settings;

    public function __construct() {
        parent::__construct();

        $this->set_version( '1.0.0' );
        $this->init();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        parent::setup_hooks();

        add_theme_support( 'woocommerce' );

        // Don't load default styles
		global $woocommerce;
		if ( ! is_object( $woocommerce ) || version_compare( $woocommerce->version, '2.1', '<' ) ) {
			define( 'WOOCOMMERCE_USE_CSS', false );
		} else {
			// version 2.1.x
			add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		}

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

        // Wrappers
        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

        add_action('woocommerce_before_main_content', array($this, 'render_wrapper_start'), 10);
        add_action('woocommerce_after_main_content', array($this, 'render_wrapper_end'), 10);

        add_action( 'woocommerce_product_meta_start', array( $this,  'woocommerce_product_meta_start' ) );
        add_action( 'woocommerce_product_meta_end', array( $this,  'woocommerce_product_meta_end' ) );

        add_action( 'woocommerce_before_my_account', array( $this, 'before_my_account' ) );
        add_action( 'woocommerce_after_my_account', array( $this, 'after_my_account' ) );

        // Replace the pagination nav
        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
        add_action('woocommerce_after_shop_loop', array($this, 'render_shop_loop_pagination'), 10);

        // Manage sidebars
        add_filter( 'g1_setup_sidebars', array( $this, 'setup_sidebars' ) );

        // Custom CSS classes for WC widgets
        add_filter('dynamic_sidebar_params', array( $this, 'add_custom_widget_classes' ) );

        // Better thumbnails
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
        add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'thumbnail_wrapper'), 10 );

        remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
        add_action( 'woocommerce_before_subcategory_title', array( $this, 'subcategory_thumbnail_wrapper'), 10 );

        // Modify the breadcrumb
        add_action( 'woocommerce_breadcrumb_defaults', array( $this, 'breadcrumb_defaults') );

        // We need to do it later, because conditional tags don't work here
        add_action( 'wp', array( $this, 'switch_breadcrumbs' ) );

        // Entries per page
        add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 );

        // Hide minicart when necessary
        add_action( 'g1_header_woocommerce_minicart', array( $this, 'hide_minicart' ) );

        // Misc
        add_action( 'woocommerce_checkout_after_customer_details', array( $this, 'checkout_after_customer_details' ), 999 );
        add_action( 'woocommerce_before_single_product_summary', array( $this, 'before_single_product_summary' ), 5 );
    }

    public function hide_minicart( $bool ) {
        if ( is_cart() || is_checkout() ) {
            return false;
        }

        return $bool;
    }


    public function loop_shop_per_page( $per_page ) {
        return 12;
    }


    public function before_single_product_summary() {
        echo '<header class="entry-header">';
            woocommerce_template_single_title();
        echo '</header>';
    }



    public function checkout_after_customer_details() {
        echo '<hr />';
        //echo do_shortcode('[divider]');
    }

    public function before_my_account() {
        echo '<div class="g1-myaccount">';
    }

    public function after_my_account() {
        echo '</div>';
    }


    public function switch_breadcrumbs() {
        if ( is_woocommerce() ) {
            remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
            remove_action( 'g1_content_begin', 'g1_add_breadcrumbs' );
            add_action( 'g1_content_begin', 'woocommerce_breadcrumb', 20, 0 );
        }
    }


    public function thumbnail_wrapper() {
        echo '<figure class="entry-featured-media">';
            echo '<a href="' . apply_filters( 'the_permalink', get_permalink() ) . '" class="g1-frame g1-frame--none g1-frame--inherit g1-frame--center">';
                echo '<span class="g1-decorator">';
                    woocommerce_template_loop_product_thumbnail();
                    echo '<span class="g1-indicator g1-indicator-document"></span>';
                echo '</span>';
            echo '</a>';
        echo '</figure>';
    }

    public function subcategory_thumbnail_wrapper( $category ) {
        echo '<figure class="entry-featured-media">';
           echo '<a href="' . get_term_link( $category->slug, 'product_cat' ) . '" class="g1-frame g1-frame--none g1-frame--inherit g1-frame--center">';
                echo '<span class="g1-decorator">';
                    woocommerce_subcategory_thumbnail( $category );
                echo '<span class="g1-indicator g1-indicator-document"></span>';
                echo '</span>';
            echo '</a>';
        echo '</figure>';
    }



    function add_custom_widget_classes( $params ) {
        switch( _get_widget_id_base($params[0]['widget_id']) ) {
            case 'product_categories':
                $params[0]['before_widget'] = str_replace(
                    'widget_product_categories',
                    'widget_product_categories g1-links',
                    $params[0]['before_widget']
                );
                break;
        }

        return $params;
    }



    protected function init() {
        $settings = array(
            'sidebar_name' => 'woocommerce'
        );

        $this->settings = apply_filters( 'g1_woocommerce_module_settings', $settings );
    }

    public function enqueue_styles(){
        $parent_uri = trailingslashit( get_template_directory_uri() );

        wp_register_style( 'g1_woocommerce', $parent_uri . 'css/g1-woocommerce.css', array(), false, 'screen' );
        wp_enqueue_style( 'g1_woocommerce' );
    }


    public function render_shop_loop_pagination() {
        G1_Pagination()->render();
    }





    public function breadcrumb_defaults( $args ) {
        $new_args = array(
            'delimiter'     => '',
            'wrap_before'   => '<nav class="g1-nav-breadcrumbs g1-meta" itemprop="breadcrumb"><ol>',
            'before'        => '<li class="g1-nav-breadcrumbs__item">',
            'after'         => '</li>',
            'wrap_after'    => '</ol></nav>',
        );

        $args = array_merge( $args, $new_args );

        return $args;
    }


    public function woocommerce_product_meta_start() {
        echo '<div class="g1-meta">';
    }

    public function woocommerce_product_meta_end() {
        echo '</div>';
    }


    public function get_setting ( $setting_name ) {
        return !empty($this->settings[$setting_name]) ? $this->settings[$setting_name] : null;
    }

    public function get_settings () {
        return $this->settings;
    }

    public function render_wrapper_start () {
        echo '<div id="primary">';
        echo '<div id="content" role="main">';
    }

    public function render_wrapper_end () {
        echo '</div>';
        echo '</div>';
    }

    public function setup_sidebars ( $sidebars ) {
        $sidebars[] = $this->get_setting( 'sidebar_name' );

        return $sidebars;
    }
}

function G1_WooCommerce_Module() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_WooCommerce_Module();

    return $instance;
}
// Fire in the hole :)
G1_WooCommerce_Module();
