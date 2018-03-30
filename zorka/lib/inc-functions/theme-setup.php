<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/24/14
 * Time: 3:39 PM
 */

if (!function_exists('zorka_theme_setup')) {
    function zorka_theme_setup() {

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
            'primary'     => esc_html__('Primary Menu', 'zorka' ),
	        'left'     => esc_html__('Left Menu', 'zorka' )
        ) );

        // Enable support for Post Formats.
        add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'quote', 'link', 'aside' ) );


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

        $language_path = get_stylesheet_directory() .'/languages';
        if(!is_dir($language_path)){
            $language_path = get_template_directory() . '/languages';
        }

        load_theme_textdomain( 'zorka', $language_path );
        load_theme_textdomain( 'xmenu', $language_path );

        add_filter('widget_text', 'do_shortcode');
		add_filter('widget_content', 'do_shortcode');
        add_filter('copyright_text_filter','do_shortcode');



    }
}

add_action( 'after_setup_theme', 'zorka_theme_setup');


/**
 * Admin Bar
 */
function zorka_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu( array(
        'parent' => 'site-name', // use 'false' for a root menu, or pass the ID of the parent menu
        'id'     => 'smof_options', // link ID, defaults to a sanitized title value
        'title'  => esc_html__('Theme Options', 'zorka' ), // link title
        'href'   => admin_url( 'themes.php?page=optionsframework' ), // name of file
        'meta'   => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
    ) );
}
add_action( 'wp_before_admin_bar_render', 'zorka_admin_bar_render' );

function zorka_start_session() {
    if(!isset($_SESSION)) {
        session_start();
    }
}
add_action('init', 'zorka_start_session', 1);

add_action('after_switch_theme', 'zorka_setup_options',100);

function zorka_setup_options () {
    // reset Theme options
    global $of_options, $options_machine;
    $smof_data = of_get_options();
    if(!isset($smof_data) || !array_key_exists('smof_init',$smof_data) || empty($smof_data['smof_init'])){
        $options_machine = new Options_Machine($of_options);
        of_save_options($options_machine->Defaults);
    }
    // generate less to css
    require get_template_directory() . '/lib/inc-generate-less/generate-less.php';
    zorka_generate_less();
}

// Add to the allowed tags array and hook into WP comments
function zorka_allowed_tags() {
    global $allowedposttags;

    $allowedposttags['a']['data-hash'] = true;
    $allowedposttags['a']['data-product_id'] = true;
    $allowedposttags['a']['data-original-title'] = true;
    $allowedposttags['a']['aria-describedby'] = true;
    $allowedposttags['a']['title'] = true;
    $allowedposttags['a']['data-quantity'] = true;
    $allowedposttags['a']['data-product_sku'] = true;
    $allowedposttags['a']['rel'] = true;
    $allowedposttags['a']['data-product-type'] = true;
    $allowedposttags['a']['data-product-id'] = true;
    $allowedposttags['a']['data-toggle'] = true;
    $allowedposttags['div']['data-plugin-options'] = true;
    $allowedposttags['div']['data-player'] = true;
    $allowedposttags['div']['data-audio'] = true;
    $allowedposttags['div']['data-title'] = true;
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
add_action('init', 'zorka_allowed_tags', 10);