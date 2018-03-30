<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/24/14
 * Time: 3:39 PM
 */

if (!function_exists('g5plus_theme_setup')) {
    function g5plus_theme_setup() {

        if ( ! isset( $content_width ) ) $content_width = 1170;

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Declare WooCommerce support
        add_theme_support( 'woocommerce' );

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary'       => esc_html__( 'Primary Menu', 'g5plus-academia' ),
	        'mobile'        => esc_html__( 'Mobile Menu', 'g5plus-academia' ),
        ) );

        // Enable support for Post Formats.
        add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'quote', 'link', 'aside' ) );


        global $wp_version;

        if (version_compare($wp_version,'4.1','>=')){
            add_theme_support( "title-tag" );
        }

        if ( version_compare( $wp_version, '3.4', '>=' ) ) {
            add_theme_support( "custom-header");
            add_theme_support( "custom-background");
        }

        // Enable support for HTML5 markup.
        add_theme_support( 'html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
        ) );

        $language_path = get_template_directory() . '/languages';
        load_theme_textdomain( 'g5plus-academia', $language_path );

        // Apply filter do_shortcode
        add_filter('widget_text', 'do_shortcode');
		add_filter('widget_content', 'do_shortcode');

	    add_editor_style( array( '/assets/css/editor-style.css' ) );
    }
    add_action( 'after_setup_theme', 'g5plus_theme_setup');
}

// SET SESSION START
if (!function_exists('g5plus_start_session')) {
    function g5plus_start_session() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }
    add_action('init', 'g5plus_start_session', 1);
}

if (!function_exists('g5plus_theme_activation')) {
    function g5plus_theme_activation () {
        // set frontpage to display_posts
        update_option('show_on_front', 'posts');

        // flush rewrite rules
        flush_rewrite_rules();

        do_action('g5plus_theme_activation');

        if(class_exists('TGM_Plugin_Activation')){
            $tgmpa = TGM_Plugin_Activation::$instance;
            $is_redirect_require_install = false;
            foreach($tgmpa->plugins as $p){
                $path =  ABSPATH . 'wp-content/plugins/'.$p['slug'];
                if(!is_dir($path)){
                    $is_redirect_require_install = true;
                    break;
                }
            }
            if($is_redirect_require_install)
                header( 'Location: '.admin_url().'themes.php?page=install-required-plugins' ) ;
        }
    }
    add_action('after_switch_theme', 'g5plus_theme_activation');
}

// Add to the allowed tags array and hook into WP comments
if (!function_exists('g5plus_allowed_tags')) {
	function g5plus_allowed_tags() {
		global $allowedposttags;

		$allowedposttags['a']['data-hash'] = true;
		$allowedposttags['a']['data-product_id'] = true;
		$allowedposttags['a']['data-original-title'] = true;
		$allowedposttags['a']['aria-describedby'] = true;
		$allowedposttags['a']['title'] = true;
		$allowedposttags['a']['data-quantity'] = true;
		$allowedposttags['a']['data-product_sku'] = true;
		$allowedposttags['a']['rel'] = true;
        $allowedposttags['a']['data-rel'] = true;
		$allowedposttags['a']['data-product-type'] = true;
		$allowedposttags['a']['data-product-id'] = true;
		$allowedposttags['a']['data-toggle'] = true;
		$allowedposttags['div']['data-plugin-options'] = true;
		$allowedposttags['div']['data-player'] = true;
		$allowedposttags['div']['data-audio'] = true;
		$allowedposttags['div']['data-title'] = true;
		$allowedposttags['div']['data-animsition-in-class'] = true;
		$allowedposttags['div']['data-animsition-out-class'] = true;
		$allowedposttags['div']['data-animsition-overlay'] = true;
		$allowedposttags['textarea']['placeholder'] = true;

		$allowedposttags['iframe']['align'] = true;
		$allowedposttags['iframe']['frameborder'] = true;
		$allowedposttags['iframe']['height'] = true;
		$allowedposttags['iframe']['longdesc'] = true;
		$allowedposttags['iframe']['marginheight'] = true;
		$allowedposttags['iframe']['marginwidth'] = true;
		$allowedposttags['iframe']['name'] = true;
		$allowedposttags['iframe']['sandbox'] = true;
		$allowedposttags['iframe']['scrolling'] = true;
		$allowedposttags['iframe']['seamless'] = true;
		$allowedposttags['iframe']['src'] = true;
		$allowedposttags['iframe']['srcdoc'] = true;
		$allowedposttags['iframe']['width'] = true;
		$allowedposttags['iframe']['defer'] = true;

		$allowedposttags['input']['accept'] = true;
		$allowedposttags['input']['align'] = true;
		$allowedposttags['input']['alt'] = true;
		$allowedposttags['input']['autocomplete'] = true;
		$allowedposttags['input']['autofocus'] = true;
		$allowedposttags['input']['checked'] = true;
		$allowedposttags['input']['class'] = true;
		$allowedposttags['input']['disabled'] = true;
		$allowedposttags['input']['form'] = true;
		$allowedposttags['input']['formaction'] = true;
		$allowedposttags['input']['formenctype'] = true;
		$allowedposttags['input']['formmethod'] = true;
		$allowedposttags['input']['formnovalidate'] = true;
		$allowedposttags['input']['formtarget'] = true;
		$allowedposttags['input']['height'] = true;
		$allowedposttags['input']['list'] = true;
		$allowedposttags['input']['max'] = true;
		$allowedposttags['input']['maxlength'] = true;
		$allowedposttags['input']['min'] = true;
		$allowedposttags['input']['multiple'] = true;
		$allowedposttags['input']['name'] = true;
		$allowedposttags['input']['pattern'] = true;
		$allowedposttags['input']['placeholder'] = true;
		$allowedposttags['input']['readonly'] = true;
		$allowedposttags['input']['required'] = true;
		$allowedposttags['input']['size'] = true;
		$allowedposttags['input']['src'] = true;
		$allowedposttags['input']['step'] = true;
		$allowedposttags['input']['type'] = true;
		$allowedposttags['input']['value'] = true;
		$allowedposttags['input']['width'] = true;
		$allowedposttags['input']['accesskey'] = true;
		$allowedposttags['input']['class'] = true;
		$allowedposttags['input']['contenteditable'] = true;
		$allowedposttags['input']['contextmenu'] = true;
		$allowedposttags['input']['dir'] = true;
		$allowedposttags['input']['draggable'] = true;
		$allowedposttags['input']['dropzone'] = true;
		$allowedposttags['input']['hidden'] = true;
		$allowedposttags['input']['id'] = true;
		$allowedposttags['input']['lang'] = true;
		$allowedposttags['input']['spellcheck'] = true;
		$allowedposttags['input']['style'] = true;
		$allowedposttags['input']['tabindex'] = true;
		$allowedposttags['input']['title'] = true;
		$allowedposttags['input']['translate'] = true;

		$allowedposttags['span']['data-id'] = true;

	}
	add_action('init', 'g5plus_allowed_tags', 10);
}

if (!function_exists('g5plus_safe_style_css')) {
	function g5plus_safe_style_css($args) {
		$args [] = 'max-width';
		return $args;
	}
	add_filter( 'safe_style_css', 'g5plus_safe_style_css');
}

if(!function_exists('g5plus_tag_filter')){
    function g5plus_tag_filter($query) {
        if(is_array($_GET) && array_key_exists('type',$_GET)){
            $post_type = $_GET['type'];
            if (is_tag()){
                if (!$post_type) {
                    $post_type = array('post','portfolio');
                }
                $query->set('post_type', $post_type);
            }
        }
        return $query;
    };
    add_filter('pre_get_posts','g5plus_tag_filter');
}

if ( is_admin() ) {
    function remove_revolution_slider_meta_boxes() {
        remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
        remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
        remove_meta_box( 'mymetabox_revslider_0', 'product', 'normal' );
    }
    add_action( 'do_meta_boxes', 'remove_revolution_slider_meta_boxes' );
}


