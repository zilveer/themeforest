<?php 
/**
 * @package WordPress
 * @subpackage U-Design
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Assign theme's version number to a constant
define( 'UDESIGN_VERSION', '2.10.7' );

if ( !function_exists('who_can_edit_udesign_theme_options') ) {
    function who_can_edit_udesign_theme_options() {
        // By default only admins can edit and see the theme's options (capability: 'manage_options')
        // You could change that by changing the capability, more on roles and capabilities: http://codex.wordpress.org/Roles_and_Capabilities
        return 'manage_options';
    }
}

// Redirect user to the "U-Design" theme settings page after activation
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
    wp_redirect( admin_url( 'admin.php?page=udesign_options_page' ) );
    exit;
}

// Create Text Domain For the Themes' Translations
if (function_exists('load_theme_textdomain')) {
    load_theme_textdomain('udesign', get_template_directory().'/locale');
}

// U-Design action hook functions
include( trailingslashit( get_template_directory() ) . 'lib/u-design-hooks/u-design-theme-hooks.php' );

/**
 * Checks if WordPress is at least at specific version
 * @param $version The version to check
 * @return bool
 */
function udesign_wordpress_is_at_least_version( $version ) {
    if ( version_compare( get_bloginfo('version'), $version, '>=' ) ) {
        return true;
    } else {
        return false;
    }
}

// Add support for title tag (document title) - since WordPress 4.1
function udesign_title_tag_setup() {
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'udesign_title_tag_setup' );

// Title tag (document title) backwards compatibility
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function udesign_title_tag_fallback() {
        ob_start(); ?>
<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
        <?php
        echo ob_get_clean();
    }
    add_action( 'wp_head', 'udesign_title_tag_fallback', 5 );
endif;

// Add pingback link to document's head
function udesign_add_pingback_link() {
    echo '<link rel="pingback" href="' . get_bloginfo('pingback_url') . '" />' . "\r\n";
}
add_action( 'wp_head', 'udesign_add_pingback_link', 20 );


// Google fonts for uDesign theme
if ( ! function_exists( 'udesign_google_fonts_url' ) ) {
    /**
     * Register Google fonts for uDesign theme.
     *
     * @return string Google fonts URL for the theme.
     */
    function udesign_google_fonts_url() {
        global $udesign_options;
        $fonts_url = '';
        $google_web_fonts_assoc = $udesign_options['google_web_fonts_assoc'];
        if( $google_web_fonts_assoc && !empty($google_web_fonts_assoc['font_name_and_variant']) && !empty($google_web_fonts_assoc['font_subsets']) ){
            $query_args = array(
                'family' => urlencode( implode("|", $google_web_fonts_assoc['font_name_and_variant']) ),
                'subset' => urlencode( implode(",", $google_web_fonts_assoc['font_subsets'] ) ),
            );
            $fonts_url = esc_url( add_query_arg( $query_args, '//fonts.googleapis.com/css' ) );
        }
        return $fonts_url;
    }
}

// load styles
function udesign_init_styles() { 
    if( !is_admin() ){
	// get the desired color scheme
	global $udesign_options, $udesign_responsive, $udesign_font_awesome_options;
        
        wp_enqueue_style('u-design-google-fonts', udesign_google_fonts_url(), array(), null);
	wp_enqueue_style('u-design-reset', get_template_directory_uri() . '/styles/common-css/reset.css', false, '1.0', 'screen');
	wp_enqueue_style('u-design-text', get_template_directory_uri() . "/styles/style1/css/text.css", false, '1.0', 'screen');
	wp_enqueue_style('u-design-grid-960', get_template_directory_uri() . '/styles/common-css/960.css', false, '1.0', 'screen');
	wp_enqueue_style('u-design-superfish_menu', get_template_directory_uri() . '/scripts/superfish-menu/css/superfish.css', false, '1.7.2', 'screen');
        if ( $udesign_options['enable_prettyPhoto_script'] ) {
            wp_enqueue_style('u-design-pretty_photo', get_template_directory_uri() . '/scripts/prettyPhoto/css/prettyPhoto.css', false, '3.1.6', 'screen');
        }
        
        // load font awesome styles if enabled
        if ( ! $udesign_font_awesome_options['udesign_disable_font_awesome'] ) {
            wp_enqueue_style('u-design-font-awesome', get_template_directory_uri(). '/styles/common-css/font-awesome/css/font-awesome.min.css', false, UDESIGN_VERSION, 'screen');
        }
            
        // load fontello icon fonts styles
        if ( udesign_is_fontello_installed() ) {
            wp_enqueue_style('u-design-fontello', udesign_get_installed_fontello_folder_uri() . '/css/fontello.css', false, UDESIGN_VERSION, 'screen');
            wp_enqueue_style('u-design-fontello-animation', udesign_get_installed_fontello_folder_uri() . '/css/animation.css', false, UDESIGN_VERSION, 'screen');
        }
        
	wp_enqueue_style('u-design-style', get_template_directory_uri() . "/styles/style1/css/style.css", false, UDESIGN_VERSION, 'screen');
        
        // load the appropriate custom styles file optimized for performance
        if ( get_theme_mod( 'udesign_custom_styles_use_css_file' ) ) { // load "custom_style.css" file
            // update 'udesign_custom_style_last_modified' theme_mod only if the file had to be recovered from DB
            if ( get_theme_mod( 'udesign_custom_style_css_updated_from_db' ) ) {
                $custom_style_css = get_template_directory(). '/styles/custom/custom_style.css';
                set_theme_mod( 'udesign_custom_style_last_modified', @filemtime( $custom_style_css ) );
                // reset the theme mod
                remove_theme_mod( 'udesign_custom_style_css_updated_from_db' );
            }
            $rand_ver = '.'.get_theme_mod( 'udesign_custom_style_last_modified' );
            wp_enqueue_style('u-design-custom-style', get_template_directory_uri() . '/styles/custom/custom_style.css', false, UDESIGN_VERSION.$rand_ver, 'screen');
        } else { // otherwise use "custom_style.php" file
            wp_enqueue_style('u-design-custom-style', get_template_directory_uri() . '/styles/custom/custom_style.php', false, UDESIGN_VERSION, 'screen');
        }
        
        if ( $udesign_responsive ) {
            wp_enqueue_style('u-design-responsive', get_template_directory_uri() . '/styles/common-css/responsive.css', false, UDESIGN_VERSION, 'screen');
        }
        if ( $udesign_options['max_theme_width'] || $udesign_options['global_theme_width'] > 960 || 
                                get_theme_mod( 'udesign_custom_width_page') == 'yes' || get_theme_mod( 'udesign_max_width_page') == 'yes' ) { 
            wp_enqueue_style('u-design-fluid', get_template_directory_uri() . '/styles/common-css/fluid.css', false, UDESIGN_VERSION, 'screen');
        }
        
        if ( $udesign_options['enable_default_style_css'] ) {
            wp_enqueue_style('u-design-style-orig', get_stylesheet_directory_uri() . "/style.css", false, UDESIGN_VERSION, 'screen');
        }
        
        // Load the Internet Explorer 9 or less specific stylesheet
	wp_enqueue_style( 'u-design-ie9', get_template_directory_uri() . '/styles/common-css/ie-all.css', array( 'u-design-style' ), UDESIGN_VERSION, 'screen' );
	wp_style_add_data( 'u-design-ie9', 'conditional', 'lte IE 9' );

	// Load the Internet Explorer 7 specific stylesheet
	wp_enqueue_style( 'u-design-ie7', get_template_directory_uri() . '/styles/common-css/ie6-7.css', array( 'u-design-style' ), UDESIGN_VERSION, 'screen' );
	wp_style_add_data( 'u-design-ie7', 'conditional', 'lte IE 7' );
        
        // Load the Fontello fonts Internet Explorer 7 specific stylesheet
        if ( udesign_is_fontello_installed() ) {
            wp_enqueue_style( 'u-design-fontello-ie7', esc_url( udesign_get_installed_fontello_folder_uri() ) . '/css/fontello-ie7.css', array( 'u-design-style' ), UDESIGN_VERSION, 'screen' );
            wp_style_add_data( 'u-design-fontello-ie7', 'conditional', 'lte IE 7' );
        }
        
    }
}
add_action('wp_enqueue_scripts', 'udesign_init_styles');

// load scripts
function udesign_init_scripts() {
    if( !is_admin() ){
	global $udesign_options, $current_slider, $udesign_responsive;
        
        // Load jQuery
	wp_enqueue_script('jquery');

	// swfobject scripts
	if( is_front_page() && $current_slider == '1' ) {
	    wp_enqueue_script('flashmo-swfobject', get_template_directory_uri()."/sliders/flashmo/grid_slider/swfobject.js", '', '2.2', false);
	}
	if( is_front_page() && ( $current_slider == '2' || $current_slider == '3' ) ) {
	    wp_enqueue_script('piecemaker-swfobject', get_template_directory_uri()."/sliders/piecemaker/js/swfobject.js", '', '1.5', false);
	}
	
	// Cycle 1 Slider Plugin
	if( is_front_page() && $current_slider == '4' ) {
	    wp_enqueue_script('cycle', get_template_directory_uri()."/sliders/cycle/jquery.cycle.all.min.js", array('jquery'), '3.0.3', true);
	    wp_enqueue_script('cycle1', get_template_directory_uri()."/sliders/cycle/cycle1/cycle1_script.js", array('jquery'), '1.0.1', true);
            // Generate an array of Cycle 1 parameters and pass them to "cycle1_script.js":
            $c1_slides_array = explode( ',', $udesign_options['c1_slides_order_str'] );
            $c1_transition_types_array = array();
            foreach( $c1_slides_array as $slide_row_number ) {
                $c1_transition_types_array[] = $udesign_options['c1_transition_type_'.$slide_row_number];
            }
            $c1_transition_types_csv = implode(',', $c1_transition_types_array);
            $cycle1_params = array(
                    fx		=> $c1_transition_types_csv,
                    speed	=> $udesign_options['c1_speed'],
                    timeout	=> $udesign_options['c1_timeout'],
                    sync	=> ( $udesign_options['c1_sync'] ) ? 1 : 0
            );
            wp_localize_script( 'cycle1', 'cycle1_params', $cycle1_params );
	}

	// Cycle 2 Slider Plugin
	if( is_front_page() && $current_slider == '5' ) {
	    wp_enqueue_script('cycle', get_template_directory_uri()."/sliders/cycle/jquery.cycle.all.min.js", array('jquery'), '3.0.3', true);
	    wp_enqueue_script('cycle2', get_template_directory_uri()."/sliders/cycle/cycle2/cycle2_script.js", array('jquery'), '1.0.1', true);
            // Generate an array of Cycle 2 parameters and pass them to "cycle2_script.js":
            $c2_slides_array = explode( ',', $udesign_options['c2_slides_order_str'] );
            $c2_transition_types_array = array();
            foreach( $c2_slides_array as $slide_row_number ) {
                $c2_transition_types_array[] = $udesign_options['c2_transition_type_'.$slide_row_number];
            }
            $c2_transition_types_csv = implode(',', $c2_transition_types_array);
            $cycle2_params = array(
                    fx		=> $c2_transition_types_csv,
                    speed	=> $udesign_options['c2_speed'],
                    timeout	=> $udesign_options['c2_timeout'],
                    sync	=> ( $udesign_options['c2_sync'] ) ? 1 : 0,
                    texttrans	=> ( $udesign_options['c2_text_transition_on'] ) ? 1 : 0
            );
            wp_localize_script( 'cycle2', 'cycle2_params', $cycle2_params );
	}

	// Cycle 3 Slider Plugin
	if( is_front_page() && $current_slider == '6' ) {
	    wp_enqueue_script('cycle', get_template_directory_uri()."/sliders/cycle/jquery.cycle.all.min.js", array('jquery'), '3.0.3', true);
	    wp_enqueue_script('jquery-easing', get_template_directory_uri()."/sliders/cycle/jquery.easing.1.3.js", array('jquery'), '1.3', true);
	    wp_enqueue_script('cycle3', get_template_directory_uri()."/sliders/cycle/cycle3/cycle3_script.js", array('jquery'), '1.0.1', true);
            // Generate an array of Cycle 1 parameters and pass them to "cycle3_script.js":
            $cycle3_params = array(
                    timeout	=> $udesign_options['c3_timeout'],
                    autostop	=> ( $udesign_options['c3_autostop'] ) ? 1 : 0
            );
            wp_localize_script( 'cycle3', 'cycle3_params', $cycle3_params );
	}

	// PrettyPhoto script
	if( $udesign_options['enable_prettyPhoto_script'] ) {
            wp_enqueue_script('pretty-photo-lib', get_template_directory_uri()."/scripts/prettyPhoto/js/jquery.prettyPhoto.js", array('jquery'), '3.1.6', true);
            wp_enqueue_script('pretty-photo-custom-params', get_template_directory_uri()."/scripts/prettyPhoto/custom_params.js", array('pretty-photo-lib'), '3.1.6', true);
            wp_localize_script('pretty-photo-custom-params', 'pretty_photo_custom_params', array(
                        'window_width_to_disable_pp' => $udesign_options['responsive_disable_pretty_photo_at_width'],
                        'pretty_photo_style_theme' => $udesign_options['udesign_pretty_photo_style_theme'],
                        'disable_pretty_photo_gallery_overlay' => $udesign_options['udesign_disable_pretty_photo_gallery_overlay']
                    )
            );
        }
        
	// jQuery validation script
        if ( is_page_template('page-Contact.php') ) {
            wp_enqueue_script('jquery_validate_lib', get_template_directory_uri()."/scripts/jquery-validate/jquery.validate.min.js", array('jquery'), '1.11.1', true);
            wp_enqueue_script('masked_input_plugin', get_template_directory_uri()."/scripts/masked-input-plugin/jquery.maskedinput.min.js", array('jquery'), '1.3.1', true);
        }
        
	// Isotope related Sortable Portfolio scripts
        if ( is_page_template('page-Portfolio1ColSortable.php') || is_page_template('page-Portfolio2ColSortable.php') || is_page_template('page-Portfolio3ColSortable.php') || is_page_template('page-Portfolio4ColSortable.php') ) {
            wp_enqueue_script('jquery-isotope-lib', get_template_directory_uri()."/scripts/isotope/jquery.isotope.min.js", array('jquery'), '1.5.25', true);
            wp_enqueue_script('isotope-custom-scripts', get_template_directory_uri()."/scripts/isotope/isotope-custom-scripts.js", array('jquery-isotope-lib'), '1.0.0', true);
        }
        
	// Superfish Dropdown menu scripts (combined)
	wp_enqueue_script('superfish-menu', get_template_directory_uri()."/scripts/superfish-menu/js/superfish.combined.js", array('jquery'), '1.7.2', true);
            
	// Enqueue the reCAPTCHA script. Also check the 'udesign_add_async_defer_to_recaptcha_script()' function
        if ( $udesign_options['recaptcha_enabled'] == 'yes' && is_page_template( 'page-Contact.php' ) ) {
            wp_enqueue_script('udesign-recaptcha', "https://www.google.com/recaptcha/api.js", array(), UDESIGN_VERSION, false);
        }
        
	// Miscellaneous JS scripts
	wp_enqueue_script('udesign-scripts', get_template_directory_uri()."/scripts/script.js", array('jquery'), '1.0', true);
        wp_localize_script('udesign-scripts', 'udesign_script_vars', array(
                    'search_widget_placeholder' => __('Type here to search', 'udesign'),
                    'disable_smooth_scrolling_on_pages' => $udesign_options['disable_smooth_scrolling_on_pages'],
                    'remove_fixed_menu_on_mobile' => $udesign_options['remove_fixed_menu_on_mobile_devices']
		)
	);
	
        // Responsive Menu
        if ( $udesign_responsive ) {
            if ( $udesign_options['responsive_menu'] == 'responsive_menu_2') {
                $menu_2_screen_width = ( isset( $udesign_options['menu_2_screen_width'] ) && $udesign_options['menu_2_screen_width'] == 'yes') ? "959" : "719";
                wp_enqueue_script('udesign-responsive-menu-2', get_template_directory_uri() . '/scripts/responsive/meanmenu/jquery.meanmenu.min.js', '', '2.0.8', true);
                wp_enqueue_script('udesign-responsive-menu-2-options', get_template_directory_uri() . '/scripts/responsive/meanmenu/jquery.meanmenu.options.js', '', '2.0.8', true);
                wp_localize_script('udesign-responsive-menu-2-options', 'udesign_responsive_menu_2_vars', array(
                            'menu_2_screen_width' => $menu_2_screen_width
                        )
                );
            } else {
                wp_enqueue_script('udesign-responsive-menu-1', get_template_directory_uri() . '/scripts/responsive/selectnav/selectnav.min.js', '', '0.1', true);
                wp_enqueue_script('udesign-responsive-menu-1-options', get_template_directory_uri() . '/scripts/responsive/selectnav/selectnav-options.js', '', '0.1', true);
                wp_localize_script('udesign-responsive-menu-1-options', 'udesign_selectnav_vars', array(
                            'selectnav_menu_label' => __('Navigation', 'udesign')
                        )
                );
            }
        }
        
        /**
         * Load only if WordPress 4.2 or later as the 'wp_script_add_data' was added in WP 4.2, otherwise the 'Respond' script is loaded directly in "header.php"
         */
        global $wp_version;
        if ( version_compare( $wp_version, '4.2.0', '>=' ) ) {
            // Load 'Respond.js' - a fast & lightweight polyfill for min/max-width CSS3 Media Queries (for IE 6-8)
            wp_register_script( 'u-design-respond', get_template_directory_uri() . '/scripts/respond.min.js', array(), '1.4.2' );
            wp_script_add_data( 'u-design-respond', 'conditional', 'lt IE 9' );
            wp_enqueue_script( 'u-design-respond' );
        }

    }
}
add_action('wp_enqueue_scripts', 'udesign_init_scripts');


// Set the content width based. Used to set the width of images and content.
if ( !isset( $content_width ) ) $content_width = 600;

// Define a global variable '$portfolio_pages_array' as an array containing all pages assigned to be Portfolio pages
global $portfolio_pages_array;
$portfolio_1_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio1Col.php&hierarchical=0');
$portfolio_2_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio2Col.php&hierarchical=0');
$portfolio_3_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio3Col.php&hierarchical=0');
$portfolio_4_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio4Col.php&hierarchical=0');
$portfolio_1_pages_sortable_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio1ColSortable.php&hierarchical=0');
$portfolio_2_pages_sortable_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio2ColSortable.php&hierarchical=0');
$portfolio_3_pages_sortable_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio3ColSortable.php&hierarchical=0');
$portfolio_4_pages_sortable_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio4ColSortable.php&hierarchical=0');
$portfolio_pages_array = array_merge($portfolio_1_pages_array, $portfolio_2_pages_array, $portfolio_3_pages_array, $portfolio_4_pages_array, $portfolio_1_pages_sortable_array, $portfolio_2_pages_sortable_array, $portfolio_3_pages_sortable_array, $portfolio_4_pages_sortable_array);


// Menu functions with support for WordPress 3.0 menus
if ( function_exists('wp_nav_menu') ) {
    add_theme_support( 'nav-menus' );
    register_nav_menus( array(
	'primary' => esc_html__( 'Primary Navigation', 'udesign' ),
    ) );
}

function udesign_nav() {
    if ( function_exists( 'wp_nav_menu' ) ) {
        $defaults = array(
                'container_class' => 'navigation-menu',
                'container_id' => 'navigation-menu',
                'menu_id'    => 'main-top-menu',
                'menu_class' => 'sf-menu',
                'link_before'=> '<span>',
                'link_after' => '</span>',
                'theme_location' => 'primary',
                'fallback_cb' => 'udesign_nav_fallback' 
        );
        wp_nav_menu( $defaults );
    } else {
        udesign_nav_fallback();
    }
}

function udesign_nav_fallback() {
    $menu_html = '<div id="navigation-menu" class="navigation-menu">';
    $menu_html .= '<ul id="main-top-menu" class="sf-menu">';
    $menu_html .= is_front_page() ? "<li class='current_page_item'>" : "<li>";
    $menu_html .= '<a href="'.home_url().'"><span>'.esc_html__('Home', 'udesign').'</span></a></li>';
    $menu_html .= wp_list_pages('depth=5&title_li=0&sort_column=menu_order&link_before=<span>&link_after=</span>&echo=0');
    $menu_html .= '</ul>';
    $menu_html .= '</div>';
    echo $menu_html;
}

//Automatic Feed Links is a theme feature introduced with Version 3.0. This feature addes to HTML <head> RSS feed links. 
if ( function_exists('add_theme_support') ) {
    add_theme_support( 'automatic-feed-links' );
}


// replace the original get_search_form() with the internationalized version here:
function translatable_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="'.home_url().'" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:', 'udesign') . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search', 'udesign') .'" />
    </div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'translatable_search_form' );


/* Check for image */
function findImage() {
	$content = get_the_content();
	$count = substr_count($content, '<img');
	if ($count > 0) return true;
	else return false;
}

/* Get the first image from the post and return it */
function get_image_url() {
    global $post;
    $first_img = '';
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    if( empty( $first_img ) ){ //Defines a default image
	$first_img = "/images/thumbnail-default.jpg";
    }
    return $first_img;
}


/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7+
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
function test_post_is_in_descendant_category( $cats, $_post = null )
{
    foreach ( (array) $cats as $cat ) {
	// get_term_children() accepts integer ID only
	$descendants = get_term_children( (int) $cat, 'category');
	if ( $descendants && in_category( $descendants, $_post ) )
	return true;
    }
    return false;
}

/**
 * Tests if any of a post's assigned categories are in the target categories or in any of the descendants
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7+
 */
function post_is_in_category_or_descendants( $cats, $_post = null )
{
    if( in_category( $cats, $_post = null ) || test_post_is_in_descendant_category( $cats, $_post = null ) ) {
	return true;
    }
    return false;
}

/**
 * This function is used to generate custom breadcrumbs for single posts view. Portfolio section or regular Blog is considered
 * when generating the link structure.
 */
function get_category_parents_for_breadcrumbs( $id, $link = false, $separator = '/' ) {
	global $udesign_options, $portfolio_pages_array;
	if ( post_is_in_category_or_descendants( $udesign_options['portfolio_categories'] ) ) { // if the current post belongs to any Porfolio category
	    foreach ( $portfolio_pages_array as $portfolio_page_obj ) {
		$port_page_ID = $portfolio_page_obj->ID;
		if ( post_is_in_category_or_descendants( $udesign_options['portfolio_cat_for_page_'.$port_page_ID] ) ) {
		    echo get_category_parents_for_portfolio_page( $id, $link, $separator, FALSE , $port_page_ID );
		    break;
		}
	    }
	} else { // if the current category is a regular blog category
            echo is_wp_error( $cat_parents = get_category_parents( $id, $link, $separator, FALSE ) ) ? '' : $cat_parents;
	}
}
/**
 * This is the modified version of the "get_category_parents()" WP function
 * Retrieve category parents with separator for use in the Portfolio section to generate proper breadcrumb links.
 * The new parameter added is $portfolio_page_id which is the id of the page assigned with the Porfolio page template.
 * @since 1.2.0
 * @param int $id Category ID.
 * @param bool $link Optional, default is false. Whether to format with link.
 * @param string $separator Optional, default is '/'. How to separate categories.
 * @param bool $nicename Optional, default is false. Whether to use nice name for display.
 * @param string $portfolio_page_id Optional. Already linked to categories to prevent duplicates.
 * @param array $visited Optional. Already linked to categories to prevent duplicates.
 * @return string
 */
function get_category_parents_for_portfolio_page( $id, $link = false, $separator = '/', $nicename = false, $portfolio_page_id='', $visited = array() ) {
	global $udesign_options;
	$chain = '';
	$parent = get_term( $id, 'category' );
	if ( is_wp_error( $parent ) ) return $parent;
	$name = ( $nicename ) ? $parent->slug : $parent->name;
	if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
		$visited[] = $parent->parent;
		$chain .= '<a href="'.get_permalink( $portfolio_page_id ).'" title="'.esc_attr( sprintf( __( "Go back to %s", 'udesign' ), get_the_title($portfolio_page_id) ) ).'">'.get_the_title($portfolio_page_id).'</a>' . $separator . ' ';
	}
	if ( $link ) { // generate comma separated list of categories' links that the current single post has been assigned to
		$query_string_prefix = ( get_option('permalink_structure') != '' ) ? '?' : '&amp;';
		$categories_names_array = array();
		foreach((get_the_category()) as $category) {
		    if ( ( cat_is_ancestor_of( $udesign_options['portfolio_cat_for_page_'.$portfolio_page_id], $category->term_id ) ||
					       $udesign_options['portfolio_cat_for_page_'.$portfolio_page_id] == $category->term_id ) ) { // belongs to a category associated with the current portfolio page
			if ( preg_match( '/\?/', get_permalink($portfolio_page_id) ) ) $query_string_prefix = '&amp;';
                        $curr_cat_link = '<a href="'.get_permalink($portfolio_page_id).$query_string_prefix.'cat=' . ( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "Go back to %s", 'udesign' ), $category->cat_name ) ) . '">'.$category->cat_name.'</a>';
			array_push( $categories_names_array, $curr_cat_link );
		    }
		}
		$chain .= implode( ", ", $categories_names_array ) . $separator;
	} else { // generate comma separated list of categories' names that the current single post has been assigned to
		$categories_names_array = array();
		foreach((get_the_category()) as $category) {
		    if ( ( cat_is_ancestor_of( $udesign_options['portfolio_cat_for_page_'.$portfolio_page_id], $category->term_id ) ||
					       $udesign_options['portfolio_cat_for_page_'.$portfolio_page_id] == $category->term_id ) ) { // belongs to a category associated with the current portfolio page
			array_push( $categories_names_array, $category->cat_name );
		    }
		}
		$chain .= implode( ", ", $categories_names_array ) . $separator;
	}
	return $chain;
}

/**
 * Check the validity of the given Phone Numbers (North American)
 * This regex will validate a 10-digit North American telephone number.
 * Separators are not required, but can include spaces, hyphens, or periods.
 * Parentheses around the area code are also optional.
 *
 * @param string $phone The phone number
 * @return bool true if the phone number is valid or false otherwise
 */
function isPhoneNumberValid( $phone ) {
    // validate a phone number
    $pattern = '/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/';
    return preg_match( $pattern, $phone );
}


// Custom Comment template
if ( !function_exists( 'udesign_theme_comment' ) ) {
    function udesign_theme_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        ob_start(); ?>

        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>"> <?php // WordPress will supply the closing </li> tag automatically ?>
            <div id="comment-<?php comment_ID(); ?>">
                <div class="comment-meta">
                    <div class="avatar-wrapper">
<?php                   echo get_avatar( $comment, $size='52' ); ?>
                    </div>
                    <div class="commentmetadata">
                        <div class="author"><?php comment_author_link() ?></div>
<?php                   printf(__('<span class="the-comment-time-and-date"><span class="time">%1$s</span> on <a class="comment-date" href="#comment-%2$s" title="%3$s">%3$s</a></span>', 'udesign'), get_comment_time(__('g:i a', 'udesign')), get_comment_ID(), get_comment_date(__('F j, Y', 'udesign')) );
                        edit_comment_link(esc_html__('edit', 'udesign'),'&nbsp;&nbsp;',''); ?>
                    </div>
                </div>

                <div class="commenttext">
<?php               if ($comment->comment_approved == '0') : ?>
                        <em><?php esc_html_e('Your comment is awaiting moderation.', 'udesign') ?></em>
                        <br />
<?php               endif; ?>
<?php               comment_text() ?>
                    <div class="reply">
<?php                   comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </div>
                </div>
            </div>

<?php   $udesign_comment_template_html = ob_get_clean();
        echo apply_filters( 'udesign_get_comment_template', $udesign_comment_template_html );

    }
}

// Include the posts' count under a category into the a-tag when listing the categories
function posts_count_inside_the_link( $html ) {
    $html = preg_replace( '/\<\/a\> \((.*)\)/', ' <span class="posts-counter">(&nbsp;$1&nbsp;)</span></a>', $html );
    return $html;
}
add_filter('wp_list_categories', 'posts_count_inside_the_link');

// Include the posts' count under an archive into the a-tag when listing the categories
function posts_count_inside_archive_link( $html ) {
    $html = preg_replace( '/\<\/a\>&nbsp;\((.*)\)/', ' <span class="posts-counter">(&nbsp;$1&nbsp;)</span></a>', $html );
    return $html;
}
add_filter('get_archives_link', 'posts_count_inside_archive_link');
 
/***************** BEGIN EXCERPTS ******************/
// change the length of excerpts
function new_excerpt_length( $length ) {
    global $udesign_options;
    return $udesign_options['excerpt_length_in_words'];
}
add_filter('excerpt_length', 'new_excerpt_length');

// remove the '[...]'
function moreLink( $content ){
    return str_replace( '[...]', '', do_shortcode($content) );
}
add_filter('the_excerpt', 'moreLink');

// Custom length of the excerpt in words
function custom_string_length_by_words( $string, $limit ) {
    $array_of_words = explode(' ', $string, ($limit + 1));
    if( count($array_of_words) > $limit ){
	array_pop($array_of_words);
    }
    return implode(' ', $array_of_words);
}
/***************** END EXCERPTS ******************/


/**
 * Include U-Design post thumbnail generating function
 */
include ( trailingslashit( get_template_directory() ) . 'scripts/post-thumbnail.php' );

/**
 * Include U-Design Shortcodes
 */
include ( trailingslashit( get_template_directory() ) . 'lib/shortcodes/u-design-shortcodes.php' );


/**
 * Checks whether a dynamic sidebar exists
 *
 * @param string $sidebar_name, sidebar name
 * @return bool True, if sidebar exists. False otherwise.
 */
function sidebar_exist( $sidebar_name ) {
    global $wp_registered_sidebars;
    foreach ( (array) $wp_registered_sidebars as $index => $sidebar ) {
	if ( in_array($sidebar_name, $sidebar) )
	    return true;
    }
    return false;
}

/**
 * Checks whether a dynamic sidebar exists and if is active (has any widgets)
 *
 * @param string $sidebar_name, sidebar name
 * @return bool True, if exists and active (using widgets). False otherwise.
 */
function sidebar_exist_and_active( $sidebar_name ) {
    global $wp_registered_sidebars;
    foreach ( (array) $wp_registered_sidebars as $index => $sidebar ) {
	if ( in_array($sidebar_name, $sidebar) ) {
	    return is_active_sidebar( $sidebar['id'] );
	}
    }
    return false;
}

/* Widget Settings */

if ( ! udesign_wordpress_is_at_least_version( '4.0' ) ) {
    // Wrap the "Recent Comments" widget's comment author link with a 'span' tag for additional styling
    function recent_comment_author_link( $return ) {
            return str_replace( $return, '<span class="comment-author-link">'.$return.'</span>', $return );
    }
    add_filter('get_comment_author_link', 'recent_comment_author_link');
}

function filter_widget( $params ) {
    switch( _get_widget_id_base($params[0]['widget_id']) ) {
	case 'recent-posts':
	case 'categories':
	case 'archives':
	case 'pages':
	case 'links':
	case 'meta':
	case 'custom-category-widget': // U-Design: Custom Category
	case 'loginform-widget': // U-Design: Login Form
	case 'subpages-widget': // U-Design: Subpages
	case 'nav_menu': // WP 3 widget menu support
	      $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-formatting', $params[0]['before_widget'] ); // add the 'custom-formatting' class
	      return $params;
	      break;
	case 'rss':
	      $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-rss-formatting', $params[0]['before_widget'] ); // add the 'custom-formatting' class
	      return $params;
	      break;
	default:
	      //var_dump( _get_widget_id_base($params[0]['widget_id']) );
	      //var_dump( $params );
	      return $params;
    }
}
add_filter('dynamic_sidebar_params','filter_widget');

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Pages Sidebar',
                'id'          => 'sidebar-1',
		'description' => esc_html__('A widget area, used as a sidebar for regular pages.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
    
	register_sidebar(array(
		'name' => 'PortfolioSidebar',
                'id'          => 'sidebar-2',
		'description' => esc_html__('A widget area, used as a sidebar for the Portfolio section.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'BlogSidebar',
                'id'          => 'sidebar-3',
		'description' => esc_html__('A widget area, used as a sidebar for the Blog/News section.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'ContactSidebar',
                'id'          => 'sidebar-4',
		'description' => esc_html__('A widget area, used as a sidebar for the Contact page.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'SitemapSidebar',
                'id'          => 'sidebar-5',
		'description' => esc_html__('A widget area, used as a sidebar for the Sitemap page.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	// Front Page Before Content Widget Area
	register_sidebar(array(
		'name' => esc_html__('Home Page Before Content', 'udesign'),
		'id' => 'home-page-before-content',
		'description' => esc_html__('A widget area positioned just above the Home Page Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_1 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="before_cont_title">',
		'after_title' => '</h3>',
	));

	// Front Page Content Widget Areas
	register_sidebar(array(
		'name' => esc_html__('Home Page Column 1', 'udesign'),
		'id' => 'home-page-column-1',
		'description' => esc_html__('A widget area, used as the 1st column in the Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_1 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_1_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Home Page Column 2', 'udesign'),
		'id' => 'home-page-column-2',
		'description' => esc_html__('A widget area, used as the 2nd column in the Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_2 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_2_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Home Page Column 3', 'udesign'),
		'id' => 'home-page-column-3',
		'description' => esc_html__('A widget area, used as the 3rd column in the Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_3 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_3_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Home Page Column 4', 'udesign'),
		'id' => 'home-page-column-4',
		'description' => esc_html__('A widget area, used as the 4th column in the Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_4 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_4_title">',
		'after_title' => '</h3>',
	));

	// Front Page After Content Row 1 Widget Area
	register_sidebar(array(
		'name' => esc_html__('Home Page After Content Row 1', 'udesign'),
		'id' => 'home-page-after-content-row-1',
		'description' => esc_html__('A widget area positioned just below the Home Page Main Content area.', 'udesign'),
		'before_widget' => '<div class="after_cont_row_1 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="after_cont_row_1_title">',
		'after_title' => '</h3>',
	));

	// Front Page After Content Row 2 Widget Area
	register_sidebar(array(
		'name' => esc_html__('Home Page After Content Row 2', 'udesign'),
		'id' => 'home-page-after-content-row-2',
		'description' => esc_html__('A widget area positioned just above the Bottom Widget area.', 'udesign'),
		'before_widget' => '<div class="after_cont_row_2 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="after_cont_row_2_title">',
		'after_title' => '</h3>',
	));
        
	// Bottom Widget Areas
	register_sidebar(array(
		'name' => esc_html__('Bottom 1', 'udesign'),
		'id' => 'bottom-widget-area-1',
		'description' => esc_html__('A widget area, used as the 1st column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Bottom 2', 'udesign'),
		'id' => 'bottom-widget-area-2',
		'description' => esc_html__('A widget area, used as the 2nd column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Bottom 3', 'udesign'),
		'id' => 'bottom-widget-area-3',
		'description' => esc_html__('A widget area, used as the 3rd column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
                'name' => esc_html__('Bottom 4', 'udesign'),
                'id' => 'bottom-widget-area-4',
                'description' => esc_html__('A widget area, used as the 4th column in the Bottom area (just above the footer).', 'udesign'),
                'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
                'before_title' => '<h3 class="bottom-col-title">',
                'after_title' => '</h3>',
                'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar2',
                'id'          => 'sidebar-17',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 2.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar3',
                'id'          => 'sidebar-18',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 3.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar4',
                'id'          => 'sidebar-19',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 4.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar5',
                'id'          => 'sidebar-20',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 5.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar6',
                'id'          => 'sidebar-21',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 6.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar7',
                'id'          => 'sidebar-22',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 7.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar8',
                'id'          => 'sidebar-23',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 8.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
  
	// Top Area Social Media Widget Area
	register_sidebar(array(
		'name' => esc_html__('Top Area Social Media', 'udesign'),
		'id' => 'top-area-social-media',
		'description' => esc_html__('A widget area positioned in the top right corner of the site designated for social media links and icons.', 'udesign'),
		'before_widget' => '<div class="social_media_top %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="social_media_title">',
		'after_title' => '</h3>',
	));

}


/* Custom widgets... */
include ( trailingslashit( get_template_directory() ) . 'widgets/loginForm-widget.php' );
include ( trailingslashit( get_template_directory() ) . 'widgets/customCategory-widget.php' );
include ( trailingslashit( get_template_directory() ) . 'widgets/googleMap-widget.php' );
include ( trailingslashit( get_template_directory() ) . 'widgets/latestPost-widget.php' );
include ( trailingslashit( get_template_directory() ) . 'widgets/subpages-widget.php' );

// Return the column (widget area) HTML
function get_dynamic_column( $id = '', $class = '', $widget_area = '' ) {
    $html = "<div id='{$id}' class='{$class}'><div class='column-content-wrapper'>".udesign_get_dynamic_sidebar( $widget_area )."</div></div><!-- end {$id} -->";
    $html = apply_filters( 'udesign_get_dynamic_column', $html, $id, $class, $widget_area );
    return $html;
}
// Currently there is no available function to return the contents of a dynamic sidebar. Therefore use this one:
function udesign_get_dynamic_sidebar($index = '') {
	$sidebar_contents = "";
	ob_start();
        if ( function_exists('dynamic_sidebar') && dynamic_sidebar( $index ) )
	$sidebar_contents = ob_get_clean();
	return $sidebar_contents;
}


/* Load the U-Design Options Page */
require_once( trailingslashit( get_template_directory() ) . 'udesign_options_page.php' );
/* Load the U-Design Fontello Options Subpage */
require_once( trailingslashit( get_template_directory() ) . 'udesign-icon-fonts-options.php' );
/* Load the U-Design Updates Options Subpage */
require_once( trailingslashit( get_template_directory() ) . 'udesign-updates-options.php' );
/* Load the U-Design Backup/Restore Options Subpage */
require_once( trailingslashit( get_template_directory() ) . 'udesign-backup-options.php' );

// U-Design Schema.org Stuff
if ( $udesign_options['enable_udesign_schema_tags'] == 'yes' ) {
    include( trailingslashit( get_template_directory() ) . 'lib/structured-data/schema/u-design-schema.php' );
}

// Remove meta name="generator" content="WordPress" from the <head>
remove_action('wp_head', 'wp_generator');

// Add support for "Featured image"
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}

// Filter the "Featured Image" with this theme's custom image frame with alignment. Can be enabled from the theme's "Blog Section".
if ( $udesign_options['enable_custom_featured_image'] == 'yes' ) {
    function udesign_post_image_html( $html, $post_id, $post_image_id ) {
        global $udesign_options;
        $image_frame_wrappers_before = ( $udesign_options['remove_featured_image_frame'] ) ? '' : '<div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">';
        $image_frame_wrappers_after = ( $udesign_options['remove_featured_image_frame'] ) ? '' : '</div></div>';
        $html = preg_replace('/title=\"(.*?)\"/', '', $html);
        preg_match( '/aligncenter|alignleft|alignright/', $html, $matches );
        $image_alignment = ( isset($matches[0]) ) ? $matches[0] : '';
        $html = preg_replace('/aligncenter|alignleft|alignright/', 'alignnone', $html);
        $html = '<div class="custom-frame-wrapper '.$image_alignment.'">'.$image_frame_wrappers_before.'<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>'.$image_frame_wrappers_after.'</div>';
        if( $image_alignment == 'aligncenter' ) $html = '<div style="text-align:center;">'.$html.'</div>';
        return $html;
    }
    add_filter( 'post_thumbnail_html', 'udesign_post_image_html', 10, 3 );
}
// This function is used in processing images (cutting, cropping, zoom)
if ( !function_exists('udesign_process_image') ) {
    function udesign_process_image( $img_source, $img_width, $img_height, $crop = true, $align = '', $retina = false ) {
	global $udesign_options;
        require_once( trailingslashit( get_template_directory() ) . 'scripts/image-resizer.php' );
        if ( $udesign_options['udesign_disable_img_cropping'] != 'yes' ) {
            switch ( $retina ) {
                case 'yes': // consider 'portfolio_item_thumb_retina' custom field option
                    $udesign_enable_retina_images = true;
                    break;
                case 'no': // consider 'portfolio_item_thumb_retina' custom field option
                    $udesign_enable_retina_images = false;
                    break;
                default: // if no match with above cases fall back on the gloabal setting for retina images
                    $udesign_enable_retina_images = ( $udesign_options['udesign_enable_retina_images'] == 'yes' ) ? true: false;
            }
            $img_source = mr_image_resize( $img_source, $img_width, $img_height, $crop, $align, $udesign_enable_retina_images );
        }
        return $img_source;
    }
}
/**
 * Customize image dimension and apply custom image frame with alignment
 * @param int $post_id Post ID.
 * @param string $img_src Image URL.
 * @param string $width Image width.
 * @param string $height Image height.
 * @param string $image_alignment Image alignment in the form of 'alignleft', 'aligncenter', 'alignright'
 * @param bool $linked Set to 'true' if the image should link to the post or 'false' otherwise
 * @return string HTML formatted image linking (optional) to the Post with $post_id
 */
function customized_featured_image( $post_id, $img_src, $width, $height, $image_alignment = 'alignleft', $linked = true ) {
    global $udesign_options;
    $image_frame_wrappers_before = ( $udesign_options['remove_featured_image_frame'] ) ? '' : '<div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">';
    $image_frame_wrappers_after = ( $udesign_options['remove_featured_image_frame'] ) ? '' : '</div></div>';
    $the_image_html = '<img src="'.udesign_process_image( $img_src, $width, $height, true, '', false ).'" width="'.$width.'" height="'.$height.'" alt="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" />';
    if ( $linked ) $the_image_html = '<a href="'.get_permalink( $post_id ).'" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">'.$the_image_html.'</a>';
    $html = '<div class="custom-frame-wrapper '.$image_alignment.'">'.$image_frame_wrappers_before . $the_image_html . $image_frame_wrappers_after.'</div>';
    if( $image_alignment == 'aligncenter' ) $html = '<div style="text-align:center;">'.$html.'</div>';
    return $html;
}
/**
 * Display the post image linked (optional) to the post
 * @param int $post_id Post ID.
 * @param bool $linked Set to 'true' if the image should link to the post or 'false' otherwise
 * @return string HTML formatted post image linking (optional) to the Post with $post_id
 */
function display_post_image_fn( $post_id, $linked = true) {
    global $udesign_options;
    $post_image_url = get_post_meta($post_id, 'post_image', true); // Grab the preview image from the custom field 'post_image', if set.
    if ( !$post_image_url && has_post_thumbnail( $post_id ) ) {
        $tmp_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
        $post_image_url = $tmp_image[0];
    }
    if ( $post_image_url ) : 
        if ( $udesign_options['enable_custom_featured_image'] == 'yes' ) : 
            // Customize the dimension and alignment of the 'Featured Image' ...
            if( ( $udesign_options['force_image_dimention'] == 'yes' ) && ( $udesign_options['udesign_disable_img_cropping'] != 'yes' )  ) : 
                echo customized_featured_image( $post_id, $post_image_url, $udesign_options['featured_image_width'], $udesign_options['featured_image_height'], $udesign_options['featured_image_alignment'], $linked );
            else : 
                //... by the default WP 'the_post_thumbnail()' function which doesn't stretch images if they are smaller
                echo the_post_thumbnail( array($udesign_options['featured_image_width'], $udesign_options['featured_image_height']), array('class' => $udesign_options['featured_image_alignment']) );
            endif;
        else : ?>
            <div class="post-image-holder">
                <div class="post-image">
                    <span class="post-hover-image"> </span>
<?php               if ( $linked ) : ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img class="hover-opacity" src="<?php echo udesign_process_image( $post_image_url, 570, 172, true, '', false ); ?>" alt="<?php the_title_attribute(); ?>" /></a>
<?php               else : ?>
                        <img class="hover-opacity" src="<?php echo udesign_process_image( $post_image_url, 570, 172, true, '', false ); ?>" alt="<?php the_title_attribute(); ?>" />
<?php               endif; ?>
                </div>
            </div>
<?php   endif;
    endif;
}

/* Load breadcrumbs script */
if ( isset( $udesign_options['show_breadcrumbs'] ) && $udesign_options['show_breadcrumbs'] == 'yes') {
    include( trailingslashit( get_template_directory() ) . 'scripts/breadcrumbs.php' );
}

/* Load Portfolio Related Function */
require_once( trailingslashit( get_template_directory() ) . 'scripts/portfolio-item-thumbnail.php' );

/* Admin area only*/
if ( is_admin() && current_user_can( 'install_themes' ) ) {
    // Load Theme Notifier
    if ( !$udesign_options['disable_the_theme_update_notifier'] == 'yes' ) {
        require_once( trailingslashit( get_template_directory() ) . 'scripts/notifier/update-notifier.php' );
    }
    // Load the script to register required plugins for U-Design
    require_once( trailingslashit( get_template_directory() ) . 'lib/plugin-activation/register-required-plugins.php' );
}

/* Detect Colour Brightness */
function udesign_get_color_brightness($hexStr) {
    // Gets a proper hex string
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); 
    $rgbArray = array();
    //If a proper hex code, convert using bitwise operation. No overhead... faster
    if (strlen($hexStr) == 6) { 
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else { //Invalid hex color code
            return false; 
    }
    return (($rgbArray['red']*299) + ($rgbArray['green']*587) + ($rgbArray['blue']*114))/1000;
}
 
if ( $udesign_options['custom_colors_switch'] == 'enable' ) {
    
    // Add specific CSS class by filter
    function determine_class_names($classes) {
            global $udesign_options;
            // add 'top-bg-color-dark' or 'main-content-bg-dark' to the $classes array
            $classes[] = ( udesign_get_color_brightness("#{$udesign_options['top_bg_color']}") > 200 ) ? '' : 'top-bg-color-dark';
            $classes[] = ( udesign_get_color_brightness("#{$udesign_options['main_content_bg']}") > 220 ) ? '' : 'main-content-bg-dark';
            // return the $classes array
            return $classes;
    }
    add_filter('body_class','determine_class_names');
    
}

// handle rel="wp-prettyPhoto" in links for the prettyPhoto integrated script (if enabled)
if ( $udesign_options['enable_prettyPhoto_script'] == 'yes') {
    /**
     * Insert rel="wp-prettyPhoto" to all links for images, movie, YouTube and iFrame. 
     * This function will ignore links where you have manually entered your own rel reference.
     * @param string $content Post/page contents
     * @return string Prettified post/page contents
     * @link http://0xtc.com/2008/05/27/auto-lightbox-function.xhtml
     * @access public
      */
    function autoinsert_rel_prettyPhoto ($content) {
        global $post;
        $rel = 'wp-prettyPhoto';
        $image_match = '\.bmp|\.gif|\.jpg|\.jpeg|\.png';
        $movie_match = '\.mov.*?';
        $swf_match = '\.swf.*?';
        $youtube_match = 'http:\/\/www\.youtube\.com\/watch\?v=[A-Za-z0-9]*';
        $iframe_match = '.*iframe=true.*';
        $pattern[0] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(".$image_match."|".$movie_match."|".$swf_match."|".$youtube_match."|".$iframe_match.")('|\")([^\>]*?)>/i";
        $pattern[1] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(".$image_match."|".$movie_match."|".$swf_match."|".$youtube_match."|".$iframe_match.")('|\")(.*?)(rel=('|\")".$rel."(.*?)('|\"))([ \t\r\n\v\f]*?)((rel=('|\")".$rel."(.*?)('|\"))?)([ \t\r\n\v\f]?)([^\>]*?)>/i";
        $replacement[0] = '<a$1href=$2$3$4$5$6 rel="'.$rel.'['.$post->ID.']">';
        $replacement[1] = '<a$1href=$2$3$4$5$6$7>';
        $content = preg_replace($pattern, $replacement, $content);
        return $content;
    }
    add_filter('the_content', 'autoinsert_rel_prettyPhoto');
    add_filter('the_excerpt', 'autoinsert_rel_prettyPhoto');


    // Add the 'wp-prettyPhoto' rel attribute to the default WP gallery links
    function gallery_prettyPhoto ($content, $id, $size, $permalink, $icon, $text) {
        // is_attachment() : don't modify images on "Attachment" pages so that the next_image_link() and previous_image_link() work properly
        // $permalink : do not add prettyPhoto rel attribute to the gallery thumbs when they link to the attachment page
        if( is_attachment() || $permalink ) {
            return $content;
        } else { // add prettyPhoto rel attribute to gallery thumbs that link to the image as in [gallery link="file"]
            return str_replace("<a", "<a rel='wp-prettyPhoto[gallery]'", $content);
        }
    }
    add_filter( 'wp_get_attachment_link', 'gallery_prettyPhoto', 10, 6);
}

/*
 * Plugin Name: Shortcode Empty Paragraph Fix
 * Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
 * Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
 * Author URI: http://www.johannheyne.de
 * Version: 0.1
 * Put this in /wp-content/plugins/ of your Wordpress installation
 */
function shortcode_paragraph_insertion_fix($content) {   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'shortcode_paragraph_insertion_fix');

// format "<!--more-->" tag for u-design
function udesign_more_link( $more_link, $more_link_text ) {
        global $post;
        $more_arrow = ( is_rtl() ) ? '&larr;' : '&rarr;';
        $html = ' <a title="'.$more_link_text.'" href="'.get_permalink().'#more-'.$post->ID.'" class="read-more-align-left"><span>'.$more_link_text.'</span> '.$more_arrow.'</a>';
        $html .= '<div class="clear"></div>';
        return $html;
}
add_filter('the_content_more_link', 'udesign_more_link', 10, 2);

// Capture the output of "the_author_posts_link()" function into a local variable and return it.
// This function must be used within 'The Loop'
if ( !function_exists('udesign_get_the_author_page_link') ) {
    function udesign_get_the_author_page_link() {
        ob_start();
        the_author_posts_link();
        return ob_get_clean();
    }
}

if ( function_exists('icl_get_default_language') && !function_exists('udesign_wpml_replace_category_id') ) {
    /**
     * Replaces the the id given with corresponding one for the current language
     * @global WPML $sitepress
     * @param &int $id
     * @return void 
     */
    function udesign_wpml_replace_category_id(&$id) {
	global $sitepress;
	$deflang = $sitepress->get_default_language();
	if(ICL_LANGUAGE_CODE == $deflang) return;
        $cat = get_category($id);
	$id = $cat->term_id;
    }
}


/***** BEGIN: Page Title Business *****/
if ( !function_exists('udesign_page_title') ) {
    function udesign_page_title() {
        global $post, $udesign_options;
        $post_id = ( get_the_ID() ) ? get_the_ID() : $post->ID;
        $page_title_position = udesign_get_current_page_title_position_option( $post_id );
        udesign_page_title_before(); // call to 'udesign_page_title_before' hook
        
        ob_start();

            if ( $page_title_position == 'position1' || $page_title_position == 'remove1' ) : ?>
                <div id="page-content-title">
                    <div id="page-content-header" class="container_24">
<?php       endif; ?>              
                        <div id="page-title">
<?php                       udesign_page_title_top(); ?>
<?php                       if (is_page()) : ?>
                                <h1 class="pagetitle"><?php the_title(); ?></h1>
<?php                       elseif ( is_single() ) : ?>
                                <h1 class="single-pagetitle"><?php the_title(); ?></h1>
<?php                       elseif ( is_post_type_archive() ) : ?>
                                <h1 class="post-type-archive-pagetitle"><?php post_type_archive_title(); ?></h1>
<?php                       elseif (is_tax()) : /* If this is a taxonomy archive */
                                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  ?>
                                <h1 class="taxonomy-pagetitle"><?php echo ucwords( $term->name); ?></h1>
<?php                       elseif (is_category()) : /* If this is a category archive */ ?>
<?php                           if ($udesign_options['show_archive_for_string'] == 'yes') : ?>
                                    <h1 class="category-pagetitle"><?php single_cat_title("", true); ?></h1>
<?php                           else : ?>
                                    <h1 class="category-pagetitle"><?php printf( __('Archive for the <em>%s</em> Category', 'udesign' ), single_cat_title("", false) ); ?></h1>
<?php                           endif; ?>
<?php                       elseif (is_search()) : /* If this is a search results page */ ?>
                                <h1 class="search-pagetitle"><?php printf( __('Search Results for <em>%s</em>', 'udesign' ), get_search_query() ); ?></h1>
<?php                       elseif (is_404()) : /* If this is a 404 page */ ?>
                                <h1 class="404-pagetitle"><?php esc_html_e('Page Not Found (Error 404)', 'udesign'); ?></h1>
<?php                       elseif( is_tag() ) : /* If this is a tag archive */ ?>
                                <h1 class="tag-pagetitle"><?php printf( __('Posts Tagged <em>%s</em>', 'udesign' ), single_tag_title("", false) ); ?></h1>
<?php                       elseif (is_day()) : /* If this is a daily archive */ ?>
                                <h1 class="daily-archive-pagetitle"><?php printf( __('Daily archive for %s', 'udesign' ), get_the_date() ); ?></h1>
<?php                       elseif (is_month()) : /* If this is a monthly archive */ ?>
                                <h1 class="monthly-archive-pagetitle"><?php printf( __('Monthly archive for %s', 'udesign' ), get_the_time('F Y') ); ?></h1>
<?php                       elseif (is_year()) : /* If this is a yearly archive */ ?>
                                <h1 class="yearly-archive-pagetitle"><?php printf( __('Yearly archive for %s', 'udesign' ), get_the_time('Y') ); ?></h1>
<?php                       elseif (is_author()) : /* If this is an author archive */ ?>
                                <h1 class="author-pagetitle"><?php esc_html_e('Author Archive', 'udesign'); ?></h1>
<?php                       elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : /* If this is a paged archive */ ?>
                                <h1 class="paged-archive-pagetitle"><?php esc_html_e('Blog Archives', 'udesign'); ?></h1>
<?php                       elseif (  function_exists('bp_current_component') && ( bp_current_component() ) ) : ?>
                                <h1 class="buddy-press-pagetitle"><?php the_title(); ?></h1>
<?php                       else : // the case when a Title is NOT present the height should be maintained ?>
                                <div class="no-title-present"></div>
<?php                       endif; ?>
<?php                       udesign_page_title_bottom(); ?>
                        </div>
                        <!-- end page-title --> 
<?php       if ( $page_title_position == 'position1' || $page_title_position == 'remove1' ) : ?>
                    </div>
                    <!-- end page-content-header -->
                </div>
                <!-- end page-content-title -->
                <div class="clear"></div>
<?php       endif;
    
        // get the Output Buffer
        $udesign_page_title_html = ob_get_clean();
        echo apply_filters( 'udesign_get_page_title', $udesign_page_title_html );
        
        udesign_page_title_after(); // call to 'udesign_page_title_after' hook
    }
}

/**
 * Get the current page title position option
 * 
 * @param int $post_id Optional. The post ID.
 * @return string The Page Title Position string
 */
function udesign_get_current_page_title_position_option( $post_id = null ) {
    global $post, $udesign_options;
    $post_id = ( null === $post_id ) ? $post->ID : $post_id;
    // get page title position for the current page
    $curr_page_title_position = get_post_meta( $post_id, '_udesign_page_title', true );
    if( is_archive() ) { // special case for archive/categories pages, since they are dynamically generated pages cannot have per-page based title position defined and hence they should take global title positioning
        $page_title_position = $udesign_options['page_title_position'];
    } else {
        $page_title_position = ( empty( $curr_page_title_position ) || $curr_page_title_position == 'default_position' ) ? $udesign_options['page_title_position'] : $curr_page_title_position;
    }
    return $page_title_position;
}

/**
 * Add 'no_title_section' body class when necessary
 * 
 */
function udesign_add_no_title_body_class() {
    global $post;
    if ( udesign_get_current_page_title_position_option( $post->ID ) != 'position1' ) {
        add_filter('body_class','udesign_add_no_title_section_class');
    }
    function udesign_add_no_title_section_class($classes) {
        $classes[] = 'no_title_section';
        return $classes;
    }
}
add_action('udesign_inside_body_tag', 'udesign_add_no_title_body_class');

/**
 * Process the page title positioning globally and on per page basis.
 * Uses necessary action hooks to add/move or remove the page title in a page
 * 
 */
function udesign_set_page_title_globally() {
    global $post;
    // Assign page title position or removal method
    switch ( udesign_get_current_page_title_position_option( $post->ID ) ) {
        case 'position1': // Position Title immediately under the Main Menu
            add_action('udesign_page_content_before', 'udesign_page_title');
            // take care of breadcrumbs position relative to the title
            $move_breadcrumbs_to_title = udesign_check_page_breadcrumbs_option( 'move_to_title' );
            if( $move_breadcrumbs_to_title ){
                remove_action('udesign_page_content_top', 'udesign_display_breadcrumbs');
                add_action('udesign_page_title_bottom', 'udesign_display_breadcrumbs');
                function udesign_breadcrumbs_next_to_title($html, $wrap_before, $the_breadcrumbs, $wrap_after){
                    return $the_breadcrumbs;
                }
                add_filter( 'udesign_get_breadcrumbs', 'udesign_breadcrumbs_next_to_title', 10, 4 );
            }
            break;
        case 'position2': // Position Title Inside Main Content
            function udesign_test_home_page ( $is_front_page ) {
                // If title "Position 2" is selected, remove the title from pages that are set as home pages
                if ( !$is_front_page ) {
                    return udesign_page_title();
                }
            }
            add_action('udesign_main_content_top', 'udesign_test_home_page');
            break;
        case 'remove1': // Remove Title (SEO-Friendly)
            add_action('udesign_page_content_before', 'udesign_page_title');
            break;
    }
}
add_action('udesign_page_content_before', 'udesign_set_page_title_globally', 7);

// Add Page/Post title description
function udesign_add_title_description( $udesign_page_title_html ) {
    global $post;
    $udesign_title_description = get_post_meta($post->ID, 'udesign_title_description', true);
    if ( $udesign_title_description ) {
        $pattern = '/' . preg_quote('</h1>', '/') . '/';
        $replacement = '<span class="title-description">'.$udesign_title_description.'</span></h1>';
        $udesign_page_title_html = preg_replace( $pattern, $replacement, $udesign_page_title_html );
    }
    return $udesign_page_title_html;
}
add_filter('udesign_get_page_title', 'udesign_add_title_description');
/***** END: Page Title Business *****/





// Exclude Portfolio Categories from all Archive pages if enabled
if ( !is_admin() && $udesign_options['exclude_portfolio_from_blog'] == 'yes' ) {
    
    /**
     * Generate an array of IDs of all Portfolio categories (including all descendant categories)
     * 
     * @return array An array of category IDs
     */
    function udesign_portfolio_cats_including_all_descendants() {
        global $udesign_options;
        $portfolio_categories_with_descendants = array();
        
        // Update the $udesign_options['portfolio_categories'] option from string to an array type 
        // This is only for users updating from versions of the theme older than 2.7.5 which otherwise will get a warning
        if ( is_string( $udesign_options['portfolio_categories'] ) ) {
            $portfolio_categories_as_array = explode( ",", $udesign_options['portfolio_categories'] );
            $udesign_options['portfolio_categories'] = $portfolio_categories_as_array;
            update_option( 'udesign_options', $udesign_options );
        }
        
        foreach( $udesign_options['portfolio_categories'] as $category_ID ) {
            $all_desc_cats = get_categories( 'child_of='.$category_ID );
            foreach ( $all_desc_cats as $cat_obj ) {
                $portfolio_categories_with_descendants[] = $cat_obj->term_id;
            }
        }
        $all_portfolio_categories = array_unique( array_merge( $udesign_options['portfolio_categories'], $portfolio_categories_with_descendants ) );
        /*
        // The following two lines will update the $udesign_options['portfolio_categories'] directly
        $udesign_options['portfolio_categories'] = $all_portfolio_categories;
        update_option( 'udesign_options', $udesign_options );
         */
        return $all_portfolio_categories;
    }
    $udesign_portfolio_cats_incl_descendants = udesign_portfolio_cats_including_all_descendants();
    
    /**
     * The following will convert the array of portfolio categories' IDs into a string with negatively signed IDs
     * 
     */
    function add_minus_prefix_fn( $var ) { 
        return( '-' . $var);
    }
    $portfolio_cats_as_a_negative_ids_string = implode(',', array_map( "add_minus_prefix_fn", $udesign_portfolio_cats_incl_descendants ));
    
    
    
    /**
     * Exclude portfolio categories from queries. Does apply to the Recent Posts widget as well.
     *
     */
    function udesign_exclude_portfolio_categories_from_main_query( $query ) {
        global $udesign_options, $udesign_portfolio_cats_incl_descendants;
        if ( ! is_admin() && ! is_search() && ! is_page( $udesign_options['portfolio_pages_ids_array'] ) ) {
            $query->set('category__not_in', $udesign_portfolio_cats_incl_descendants);
        }
    }
    /**
     * Exclude portfolio categories from Blog Archive pages. Does NOT apply to the Recent Posts widget.
     *
     */
    function udesign_exclude_portfolio_cats_from_archive_pages( $query ) {
        global $portfolio_cats_as_a_negative_ids_string;
        // Check if on frontend and main query is beign modified
        if ( ! is_admin() && ! is_search() && $query->is_main_query() && ! $query->get( 'cat' ) ) {
            $query->set( 'cat', $portfolio_cats_as_a_negative_ids_string );
        }
    }
    if ( $udesign_options['exclude_portfolio_from_main_query'] == 'yes' ) {
        add_filter( 'pre_get_posts', 'udesign_exclude_portfolio_categories_from_main_query' );
    } else {
        add_action( 'pre_get_posts', 'udesign_exclude_portfolio_cats_from_archive_pages' );
    }
    
    
    /**
     * Exclude portfolio categories from the "Categories" widget
     *
     */
    function udesign_exclude_portfolio_cats_from_category_widget( $args ) {
        global $udesign_portfolio_cats_incl_descendants;
        $args['exclude'] = $udesign_portfolio_cats_incl_descendants ? $udesign_portfolio_cats_incl_descendants : '';
        return $args;
    }
    // Exclude portfolio categories from "Categories" Widget
    add_filter( 'widget_categories_args', 'udesign_exclude_portfolio_cats_from_category_widget' );
    // Exclude portfolio categories from Dropdown Categories Widget
    add_filter( 'widget_categories_dropdown_args', 'udesign_exclude_portfolio_cats_from_category_widget' );

    
    /**
     * Exclude portfolio entries from the "Recent Posts" widget
     *
     */
    function udesign_exclude_portfolio_from_recent_posts_widget( $args ) {
        global $udesign_portfolio_cats_incl_descendants;
        $args['category__not_in'] = $udesign_portfolio_cats_incl_descendants;

        return $args;
    }
    if ( $udesign_options['exclude_portfolio_from_recent_posts_widget'] == 'yes' ) {
        add_filter( 'widget_posts_args', 'udesign_exclude_portfolio_from_recent_posts_widget' );
    }
    
    /**
     * Exclude portfolio entries from the "Archives" widget.
     *
     */
    function udesign_customa_archives_where( $x ) {
        global $wpdb, $udesign_portfolio_cats_incl_descendants;
        $cats_to_exclude = array_map( 'absint', $udesign_portfolio_cats_incl_descendants ); // make sure the array of IDs ($udesign_portfolio_cats_incl_descendants) is secure
        $cats_to_exclude = implode( ',', $cats_to_exclude ); // category ID or list of IDs to exclude
        
        $x = $x . " AND $wpdb->posts.ID IN "
                . "("
                    . "SELECT $wpdb->posts.ID FROM $wpdb->posts "
                    . "INNER JOIN $wpdb->term_relationships ON "
                        . "($wpdb->posts.ID = $wpdb->term_relationships.object_id) "
                    . "INNER JOIN $wpdb->term_taxonomy ON "
                        . "($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) "
                    . "WHERE $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->term_taxonomy.term_id NOT IN ($cats_to_exclude)"
                . ")";

        return $x;
    }
    if ( $udesign_options['exclude_portfolio_from_archives_widget'] == 'yes' ) {
        add_filter( 'getarchives_where', 'udesign_customa_archives_where' );
    }

}

function udesign_search_form( $form ) {
        ob_start(); ?>
	<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>" >
            <div>
                <label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'udesign' ); ?></label>
                <input type="text" id="s" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php _e( 'Type here to search', 'udesign' ); ?>">
                <input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'udesign' ); ?>" />
            </div>
	</form>
        <?php
        $form = ob_get_clean();
	return $form;
}
add_filter( 'get_search_form', 'udesign_search_form' );

        
// Define theme's DOCTYPE and use the 'udesign_html_before' hook to insert it before <html> tag
function udesign_doctype_declaration() { 
   echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\r\n";
}
add_action('udesign_html_before', 'udesign_doctype_declaration');


// Setup the Feedback button, if enabled...
if ( $udesign_options['enable_feedback'] ) {
    function udesign_feedback_button() {
        global $udesign_options;
        ob_start(); ?>
            <div id="feedback"><a href="<?php echo $udesign_options['feedback_url']; ?>" title="<?php esc_attr_e('Feedback', 'udesign'); ?>" class="feedback"></a></div>
<?php
        $feedback_button_html = ob_get_clean();
        echo apply_filters( 'udesign_get_feedback_button', $feedback_button_html );
    }
    add_action('udesign_body_top', 'udesign_feedback_button', 9);
}
    

// Setup the Page Peel, if enabled...
if ( $udesign_options['enable_page_peel'] ) {
    function udesign_enable_page_peel() {
        global $udesign_options;
        ob_start(); ?>
            <div id="page-peel">
                    <a href="<?php echo $udesign_options['page_peel_url']; ?>" title="<?php esc_attr_e('Subscribe', 'udesign'); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/styles/style1/images/page_peel.png" alt="<?php esc_attr_e('Subscribe', 'udesign'); ?>" /></a>
                    <div class="msg_block"></div>
            </div>
<?php
        $page_peel_html = ob_get_clean();
        echo apply_filters( 'udesign_get_page_peel', $page_peel_html );
    }
    add_action('udesign_body_top', 'udesign_enable_page_peel', 9);
}


// Setup the logo
function udesign_top_elements_logo( $is_front_page ) {
    ob_start(); ?>
                    <div id="logo" class="grid_14">
<?php                   if( $is_front_page ) : ?>
                            <h1><a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
<?php                   else : ?>
                            <div class="site-name"><a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></div>
<?php                   endif; ?>
                    </div>
<?php
    $logo_html = ob_get_clean();
    echo apply_filters( 'udesign_get_logo', $logo_html, $is_front_page );
}
add_action('udesign_top_elements_inside', 'udesign_top_elements_logo', 9);


// Setup the slogan/tagline
if( get_bloginfo('description') ) { // display only if not empty
    function udesign_top_elements_slogan() {
        ob_start(); ?>
                        <div id="slogan" class="grid_17"><?php bloginfo('description'); ?></div>
                        <!-- end logo slogan -->
<?php   
        $slogan_html = ob_get_clean();
        echo apply_filters( 'udesign_get_slogan', $slogan_html );
    }
    add_action('udesign_top_elements_inside', 'udesign_top_elements_slogan', 9);
}


// Setup the phone number in the top section of the theme, if enabled
if ( $udesign_options['top_page_phone_number'] ) {
    function udesign_top_elements_phone_number() {
        global $udesign_options;
        ob_start(); ?>
                    <div class="phone-number grid_7 prefix_17">
                        <div class="phone-number-padding">
<?php                       echo do_shortcode( $udesign_options["top_page_phone_number"] ); ?>
                        </div><!-- end phone-number-padding -->
                    </div><!-- end phone-number -->
<?php   $phone_number_html = ob_get_clean();
        echo apply_filters( 'udesign_get_phone_number', $phone_number_html );
    }
    add_action('udesign_top_elements_inside', 'udesign_top_elements_phone_number', 9);
}


// Setup the searchbox in the top section of the theme, if enabled
if ( $udesign_options['enable_search'] == 'yes' ) {
    function udesign_top_elements_searchbox() {
        ob_start(); ?>
                    <div id="search" class="grid_6 prefix_18">
                        <form action="<?php echo esc_url( home_url() ); ?>/" method="get">
                            <div class="search_box">
                                <label for="s" class="screen-reader-text">Search for:</label>
                                <input id="search_field" name="s" type="text" class="inputbox_focus blur" value="<?php esc_attr_e('Search...', 'udesign'); ?>" />
                                <input type="submit"  value="search" class="search-btn" />
                            </div>
                        </form>
                    </div><!-- end search -->
<?php   $searchbox_html = ob_get_clean();
        echo apply_filters( 'udesign_get_top_area_searchbox', $searchbox_html );
    }
    add_action('udesign_top_elements_inside', 'udesign_top_elements_searchbox', 9);
}


// Setup the "Top Area Social Media" widget area
if ( sidebar_exist_and_active('top-area-social-media') ) { // hide this area if no widgets are active...
    function udesign_top_area_social_media() {
        ob_start(); ?>
                    <div class="social-media-area grid_9 prefix_15">
<?php                   echo udesign_get_dynamic_sidebar( 'top-area-social-media' ); ?>
                    </div><!-- end social-media-area -->
<?php   $top_area_social_media_html = ob_get_clean();
        echo apply_filters( 'udesign_get_top_area_social_media', $top_area_social_media_html );
    }
    add_action('udesign_top_elements_inside', 'udesign_top_area_social_media', 9);
}


// Setup the main menu
function udesign_top_main_menu() {
    ob_start(); ?>
            <div class="clear"></div>
            <div id="main-menu">
                <div id="dropdown-holder" class="container_24">
<?php               udesign_nav(); // this function calls the main menu ?>
                </div>
                <!-- end dropdown-holder -->
            </div>
            <!-- end top-main-menu -->
<?php
    $main_menu_html = ob_get_clean();
    echo apply_filters( 'udesign_get_top_main_menu', $main_menu_html );
}
add_action('udesign_top_wrapper_bottom', 'udesign_top_main_menu', 10);


// Setup the "Stay-On-Top" alias to offset page height during scrolling
function udesign_sticky_menu_alias() {
    global $udesign_options;
    if ( $udesign_options['fixed_main_menu'] ) : ?>
        <div id="sticky-menu-alias"></div>
	<div class="clear"></div> <?php
    endif;
}
add_action('udesign_top_wrapper_after', 'udesign_sticky_menu_alias', 5);

// Setup the "Stay-On-Top" menu smaller logo
if ( ! $udesign_options['fixed_menu_logo_disabled'] ) {
    function udesign_sticky_menu_logo() {
        global $udesign_options;
        if ( $udesign_options['fixed_menu_logo'] ) {
            $logo_img_url = esc_url( $udesign_options['fixed_menu_logo'] );
        } elseif ( $udesign_options['custom_logo_img'] ) {
            $logo_img_url = esc_url( $udesign_options['custom_logo_img'] );
        } else {
            $logo_img_url = get_template_directory_uri().'/styles/style1/images/logo.png';
        } ?>
        <a id="sticky-menu-logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img height="40" src="<?php echo $logo_img_url; ?>" alt="logo" /></a>
        <?php
    }
    add_action('udesign_top_wrapper_after', 'udesign_sticky_menu_logo', 9);
}


// Insert the Breadcrumbs
function udesign_display_breadcrumbs() {
    global $udesign_options;
    
    // individual page option to toggle breadcrumbs
    $disable_breadcrumbs_new = udesign_check_page_breadcrumbs_option( 'disable_breadcrumbs' );
    // backward compatibility: this is the old deprecated option name
    $disable_breadcrumbs = get_post_meta( get_the_ID(), '_udesign_disable_breadcrumbs', true );
    // decide which option to use
    $disable_breadcrumbs = ( $disable_breadcrumbs ) ? ( $disable_breadcrumbs ) : $disable_breadcrumbs_new;

    $html = $wrap_before = $the_breadcrumbs = $wrap_after = '';
    if ( isset($udesign_options['show_breadcrumbs']) && $udesign_options['show_breadcrumbs'] == 'yes' && ! $disable_breadcrumbs ) {
        $wrap_before = '<div id="breadcrumbs-container" class="container_24">';
        // get Yoast breadcrumbs if requested
        $wpseo_option_internallinks = get_option('wpseo_internallinks');
        if ( function_exists('yoast_breadcrumb') && $wpseo_option_internallinks['breadcrumbs-enable'] ) {
            $the_breadcrumbs = yoast_breadcrumb('<p class="yoast breadcrumbs">','</p>', false);
            $the_breadcrumbs = preg_replace( '/→|&rarr;/', '<span class="breadarrow"> &rarr; </span>', $the_breadcrumbs );
            $the_breadcrumbs = preg_replace( '/←|&larr;/', '<span class="breadarrow"> &larr; </span>', $the_breadcrumbs );
        } else { // get theme's default breadcrumbs
            ob_start();
            $breadcrumbs_go = new simple_breadcrumb;
            $the_breadcrumbs = ob_get_contents();
            ob_end_clean();
        }
        $wrap_after = '</div>';
        $html = $wrap_before . $the_breadcrumbs . $wrap_after;
    } else {
        if( get_theme_mod( 'udesign_include_container' ) ) { // page specific layout options - if "No Container" option then don't include '<div class="no-breadcrumbs-padding"></div>'
            $html = '<div class="no-breadcrumbs-padding"></div>';
        } 
    }
    $html = apply_filters( 'udesign_get_breadcrumbs', $html, $wrap_before, $the_breadcrumbs, $wrap_after );
    echo $html;
}
add_action('udesign_page_content_top', 'udesign_display_breadcrumbs');

/**
 * Get the page specific breadcrumbs options based on "U-Design Options" metabox selection
 * 
 * @param string $option_to_check This is the breadcrumbs option to check, the exact string name is based on option (post_meta) key. Available options: 'disable_breadcrumbs', 'move_to_title'
 * @return boolean True if the breadcrumb option is selected and false otherwise
 */
function udesign_check_page_breadcrumbs_option( $option_to_check = 'disable_breadcrumbs' ) {
    global $post;
    // move breadcrumbs to title
    $udesign_page_breadcrumbs_options = get_post_meta( $post->ID, '_udesign_page_breadcrumbs_options', true );
    return ( is_array( $udesign_page_breadcrumbs_options ) && in_array( $option_to_check, $udesign_page_breadcrumbs_options ) ) ? true : false;
}

// Insert edit link into pages
function udesign_page_edit_link() {
    if ( is_page() ) {
        echo edit_post_link( esc_html__('Edit this page', 'udesign'), '<p class="edit-link">', '</p>' );
    }
}
add_action('udesign_main_content_bottom', 'udesign_page_edit_link');

// Insert page-links for paginated posts (i.e. when the <!--nextpage--> Quicktag is used)
function udesign_nextpage_links() {
    if( function_exists('wp_pagenavi') ) {
        wp_pagenavi( array( 'type' => 'multipart' ) );
    } else {
        wp_link_pages( array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number') );
    }
}
add_action('udesign_entry_bottom', 'udesign_nextpage_links');


// Insert post title into blog and archive pages' posts
function udesign_blog_section_post_title() {
    echo '<h2><a href="'.get_permalink().'" rel="bookmark" title="'.the_title_attribute('echo=0').'">'.get_the_title().'</a></h2>';
}
add_action('udesign_blog_post_top_area_inside', 'udesign_blog_section_post_title', 9);


// Insert post image into Blog and Archive pages' posts
function udesign_blog_section_post_image() {
    ob_start();
        // Post Image
        display_post_image_fn( get_the_ID(), true );
    $post_image_html = ob_get_clean();
    $html = apply_filters( 'udesign_get_blog_section_post_image', $post_image_html );
    echo $html;
}
add_action('udesign_blog_post_content_before', 'udesign_blog_section_post_image', 11);


// Insert post image into single post
function udesign_single_post_image() {
    global $udesign_options;
    ob_start();
        // Post Image
        if( $udesign_options['display_post_image_in_single_post'] == 'yes' ) display_post_image_fn( get_the_ID(), false );
    $post_image_html = ob_get_clean();
    $html = apply_filters( 'udesign_get_single_post_image', $post_image_html );
    echo $html;
}
add_action('udesign_single_post_entry_top', 'udesign_single_post_image', 11);


// Insert postmetadata block into Blog and Archive pages' posts
function udesign_blog_section_postmetadata() {
    global $udesign_options;
    ob_start(); ?>
                                <div class="postmetadata">
                                    <span>
<?php                                   if( $udesign_options['show_postmetadata_author'] == 'yes' ) :
                                            printf( __('By %1$s on %2$s ', 'udesign'), '</span>'.udesign_get_the_author_page_link().'<span>', get_the_date() );
                                        else :
                                            printf( __('On %1$s ', 'udesign'), get_the_date() );
                                        endif; ?>
                                    </span> &nbsp; <span class="categories-link-divider">/ &nbsp;</span> <span class="postmetadata-categories-link"><?php the_category(', '); ?></span> &nbsp; <?php echo udesign_get_comments_link(); ?> <?php edit_post_link(__('Edit', 'udesign'), '<div class="postmetadata-edit-link">', '</div>'); ?> 
<?php                               echo ( $udesign_options['show_postmetadata_tags'] == 'yes' ) ? the_tags('<div class="post-tags-wrapper">'.__('Tags: ', 'udesign'), ', ', '</div>') : ''; ?>
                                </div><!-- end postmetadata -->
<?php
    $postmetadata_html = ob_get_clean();
    $html = apply_filters( 'udesign_get_blog_section_postmetadata', $postmetadata_html );
    echo $html;
}
add_action('udesign_blog_post_top_area_inside', 'udesign_blog_section_postmetadata', 11);


// Insert postmetadata block into Single Post
function udesign_single_postmetadata() {
    global $udesign_options;
    ob_start(); ?>
                                <div class="single-postmetadata-divider-top"><?php echo do_shortcode('[divider]'); ?></div>
                                <div class="postmetadata">
                                    <span>
<?php                                   if( $udesign_options['show_postmetadata_author'] == 'yes' ) :
                                            printf( __('By %1$s on %2$s ', 'udesign'), '</span>'.udesign_get_the_author_page_link().'<span>', get_the_date() );
                                        else :
                                            printf( __('On %1$s ', 'udesign'), get_the_date() );
                                        endif; ?>
                                    </span> &nbsp; <span class="categories-link-divider">/ &nbsp;</span> <span class="postmetadata-categories-link"><?php the_category(', '); ?></span> &nbsp; <?php echo udesign_get_comments_link(); ?> <?php edit_post_link(__('Edit', 'udesign'), '<div class="postmetadata-edit-link">', '</div>'); ?>  
<?php                               echo ( $udesign_options['show_postmetadata_tags'] == 'yes' ) ? the_tags('<div class="post-tags-wrapper">'.__('Tags: ', 'udesign'), ', ', '</div>') : ''; ?>
                                </div>
                                <div class="single-postmetadata-divider-bottom"><?php echo do_shortcode('[divider]'); ?></div>
<?php
    $postmetadata_html = ob_get_clean();
    $html = apply_filters( 'udesign_get_udesign_single_postmetadata', $postmetadata_html );
    echo $html;
}
if( $udesign_options['udesign_single_view_postmetadata_location'] == 'alignbottom' ) {
    add_action('udesign_single_post_entry_bottom', 'udesign_single_postmetadata');
} elseif( $udesign_options['udesign_single_view_postmetadata_location'] == 'aligntop' ) {
    add_action('udesign_single_post_entry_top', 'udesign_single_postmetadata');
}


// Insert postmetadata block into Single Portfolio Post
function udesign_single_portfolio_postmetadata() {
    global $udesign_options;
    ob_start(); ?>
<?php                           if( $udesign_options['show_portfolio_postmetadata'] == 'yes' ) : ?>
                                    <div class="single-portfolio-postmetadata-divider-top"><?php echo do_shortcode('[divider]'); ?></div>
                                    <div class="postmetadata">
                                        <span>
<?php                                       if( $udesign_options['show_portfolio_postmetadata_author'] == 'yes' ) :
                                                printf( __('By %1$s on %2$s ', 'udesign'), '</span>'.udesign_get_the_author_page_link().'<span>', get_the_date() );
                                            else :
                                                printf( __('On %1$s ', 'udesign'), get_the_date() );
                                            endif; ?>
                                        </span> &nbsp; <span class="categories-link-divider">/ &nbsp;</span> <span class="postmetadata-categories-link"><?php the_category(', '); ?></span> &nbsp;  <?php echo udesign_get_comments_link(); ?> <?php edit_post_link(__('Edit', 'udesign'), '<div class="postmetadata-edit-link">', '</div>'); ?> 
<?php                                   echo ( $udesign_options['show_portfolio_postmetadata_tags'] == 'yes' ) ? the_tags('<div class="portfolio-post-tags-wrapper">'.__('Tags: ', 'udesign'), ', ', '</div>') : ''; ?> 
                                    </div>
                                    <div class="single-portfolio-postmetadata-divider-bottom"><?php echo do_shortcode('[divider]'); ?></div>
<?php                           endif; ?>
<?php
    $postmetadata_html = ob_get_clean();
    $html = apply_filters( 'udesign_get_udesign_single_portfolio_postmetadata', $postmetadata_html );
    echo $html;
}
if( $udesign_options['udesign_single_portfolio_postmetadata_location'] == 'aligntop' ) {
    add_action('udesign_single_portfolio_entry_top', 'udesign_single_portfolio_postmetadata');
} else {
    add_action('udesign_single_portfolio_entry_bottom', 'udesign_single_portfolio_postmetadata');
}


// Insert "Previous" and "Next" navigation links into Single Posts
function udesign_single_post_entry_navigation() {
    global $udesign_options;
    ob_start(); ?>
                                <div class="single-post-nav-links">
                                    <?php if( $udesign_options['udesign_single_view_postmetadata_location'] != 'alignbottom' ) : ?>
                                        <div class="single-post-nav-links-divider-before"><?php echo do_shortcode('[divider]'); ?></div>
                                    <?php endif; ?>
                                    <?php previous_post_link( '&larr; %link', '%title', true ); ?>
                                    <?php next_post_link( '%link &rarr;', '%title', true ); ?>
                                    <div class="single-post-nav-links-divider-after"><?php echo do_shortcode('[divider]'); ?></div>
                                </div>
    <?php 
    echo ob_get_clean();
}
if ( $udesign_options['show_single_post_navigation'] == 'yes' ) {
    add_action('udesign_single_post_entry_bottom', 'udesign_single_post_entry_navigation', 11);
}

// Insert "Previous" and "Next" navigation links into Single Portfolio Posts
function udesign_single_portfolio_entry_navigation() {
    global $udesign_options;
    ob_start(); ?>
                                <div class="single-post-nav-links">
                                    <?php if( $udesign_options['show_portfolio_postmetadata'] != 'yes' || 
                                                    $udesign_options['udesign_single_portfolio_postmetadata_location'] == 'aligntop' ) : ?>
                                        <div class="single-post-nav-links-divider-before"><?php echo do_shortcode('[divider]'); ?></div>
                                    <?php endif; ?>
                                    <?php previous_post_link( '&larr; %link', '%title', true ); ?>
                                    <?php next_post_link( '%link &rarr;', '%title', true ); ?>
                                    <div class="single-post-nav-links-divider-after"><?php echo do_shortcode('[divider]'); ?></div>
                                </div>
    <?php 
    echo ob_get_clean();
}
if ( $udesign_options['show_single_portfolio_navigation'] == 'yes' ) {
    add_action('udesign_single_portfolio_entry_bottom', 'udesign_single_portfolio_entry_navigation', 11);
}


/**
 * Style and add title attribute to the Single Post's "Next" navigation link
 * 
 */
function udesign_style_next_post_link( $link ) {
    $next_post = get_next_post( true );
    $title = $next_post->post_title;
    $next_post_permalink = get_permalink( $next_post->ID );
    
    // Set the global $post variable based on post ID temporarily
    global $post;
    $post = get_post( $next_post->ID, OBJECT );
    setup_postdata( $post );
    $next_post_thumb = udesign_get_post_thumb( $next_post->ID, true, false, '90', '60', 'alignright' );
    $has_post_thumb_class = '';
    wp_reset_postdata(); // restore the global $post variable of the main query loop
    
    ob_start();
            if ( is_a( $next_post , 'WP_Post' ) ) : ?>
                <div class="next-link-column one_half last_column">
                    <?php if ( $next_post_thumb ) : 
                        $has_post_thumb_class = ' has-post-thumb'; ?>
                        <div class="next-post-thumb"><?php echo $next_post_thumb; ?></div>
                    <?php  endif; ?>
                    <div class="next-post-links<?php echo $has_post_thumb_class ?>">
                        <a rel="next" title="<?php _e( 'Go to next post', 'udesign' ); ?>" href="<?php echo $next_post_permalink; ?>"><?php _e( 'Next Post', 'udesign' ); ?> &nbsp;<i class="fa fa-angle-right" style="font-size: 14px;"></i></a>
                        <div class="next-title"><a rel="next" title="<?php echo $title; ?>" href="<?php echo $next_post_permalink; ?>"><?php echo $title; ?></a></div>
                    </div>
                </div>
    <?php   endif;
    $link = ob_get_clean();
    return $link;
}
add_filter('next_post_link', 'udesign_style_next_post_link');

/**
 * Style and add title attribute to the Single Post's "Previous" navigation link
 * 
 */
function udesign_style_previous_post_link( $link ) {
    $previous_post = get_previous_post( true );
    $title = $previous_post->post_title;
    $previous_post_permalink = get_permalink( $previous_post->ID );
    
    // Set the global $post variable based on post ID temporarily
    global $post;
    $post = get_post( $previous_post->ID, OBJECT );
    setup_postdata( $post );
    $previous_post_thumb = udesign_get_post_thumb( $previous_post->ID, true, false, '90', '60', 'alignleft', false );
    $has_post_thumb_class = '';
    wp_reset_postdata(); // restore the global $post variable of the main query loop
    
    ob_start();
            if ( is_a( $previous_post , 'WP_Post' ) ) : ?>
                <div class="previous-link-column one_half">
                    <?php if ( $previous_post_thumb ) : 
                        $has_post_thumb_class = ' has-post-thumb'; ?>
                        <div class="previous-post-thumb"><?php echo $previous_post_thumb; ?></div>
                    <?php  endif; ?>
                    <div class="previous-post-links<?php echo $has_post_thumb_class ?>">
                        <a rel="previous" title="<?php _e( 'Go to previous post', 'udesign' ); ?>" href="<?php echo $previous_post_permalink; ?>"><i class="fa fa-angle-left" style="font-size: 14px;"></i> &nbsp;<?php _e( 'Previous Post', 'udesign' ); ?></a>
                        <div class="prev-title"><a rel="previous" title="<?php echo $title; ?>" href="<?php echo $previous_post_permalink; ?>"><?php echo $title; ?></a></div>
                    </div>
                </div>
    <?php   endif;
    $link = ob_get_clean();
    return $link;
}
add_filter('previous_post_link', 'udesign_style_previous_post_link');


// helper function to get the comment popup links used in the theme's postmetadata block
function  udesign_get_comments_link() {
    $comment_link_html = '';
    if ( !post_password_required() && ( comments_open() ) ) {
        ob_start(); ?>
            <span class="postmetadata-comments-link"> / &nbsp; <?php comments_popup_link(
                __( 'Leave a comment', 'udesign' ),
                __( '1 Comment', 'udesign' ),
                __( '% Comments', 'udesign' )
            ); ?></span>
<?php
        $comment_link_html = ob_get_clean();
        $comment_link_html = apply_filters( 'udesign_get_comments_popup_link', $comment_link_html );
    }
    return $comment_link_html;
}



// Setup footer's content part
function udesign_footer_content_part() {
    global $udesign_options;
    ob_start(); ?>
		    <div id="footer_text" class="grid_20">
			<div>
<?php			    echo do_shortcode( $udesign_options['copyright_message'] );
			    if( $udesign_options['show_wp_link_in_footer'] ) :
				_e(' is proudly powered by <a href="http://wordpress.org/"><strong>WordPress</strong></a>', 'udesign');
			    endif;
			    if( $udesign_options['show_udesign_affiliate_link'] ) :
				printf( esc_html__(' | Designed with %1$sU-Design Theme%2$s', 'udesign'), '<a target="_blank" title="U-Design WordPress Premium Theme" href="http://themeforest.net/item/udesign-responsive-wordpress-theme/253220?ref='.$udesign_options['affiliate_username'].'">', '</a>' );
			    endif;
			    if( $udesign_options['show_entries_rss_in_footer'] ) : ?>
				| <a href="<?php bloginfo('rss2_url'); ?>"><?php esc_html_e('Entries (RSS)', 'udesign'); ?></a>
<?php			    endif;
			    if( $udesign_options['show_comments_rss_in_footer'] ) : ?>
				| <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php esc_html_e('Comments (RSS)', 'udesign'); ?></a>
<?php			    endif; ?>
			</div>
		    </div>
<?php
    $footer_html = ob_get_clean();
    $html = apply_filters( 'udesign_get_footer_content_part', $footer_html );
    echo $html;
}
add_action('udesign_footer_inside', 'udesign_footer_content_part', 10);


// Setup footer's "Back to Top" link
function udesign_footer_back_to_top_link() {
    ob_start(); ?>
		    <div class="back-to-top">
			<a href="#top"><?php esc_html_e('Back to Top', 'udesign'); ?></a>
		    </div>
<?php
    $footer_back_to_top_html = ob_get_clean();
    $html = apply_filters( 'udesign_get_footer_back_to_top_link', $footer_back_to_top_html );
    echo $html;
}
add_action('udesign_footer_inside', 'udesign_footer_back_to_top_link', 10);



// "Sticky" footer stuff
if ( $udesign_options['udesign_sticky_footer'] ) {
    function udesign_sticky_footer_func() {
        ob_start(); ?>
            <div class="push"></div>
            <div class="clear"></div>

        </div><!-- end wrapper-1 -->
    <?php
        $sticky_footer_html = ob_get_clean();
        echo $sticky_footer_html;
    }
    add_action('udesign_footer_before', 'udesign_sticky_footer_func', 10);
} else {
    function udesign_insert_wrapper1_closing_div() {
        ob_start(); ?>
    </div><!-- end wrapper-1 -->
    <?php
        $wrapper1_closing_div = ob_get_clean();
        echo $wrapper1_closing_div;
    }
    add_action('wp_footer', 'udesign_insert_wrapper1_closing_div', 9);
}


// Process the "Show Action Hook Locations" option from the theme's "Advaned Options"
if( current_user_can('manage_options') && $udesign_options['show_udesign_action_hooks'] == 'yes' ) {
    
    // Add U-Design Action Hooks specific CSS class to body tag classes array
    function add_udesign_action_hooks_class($classes) {
            // add 'show-udesign-action-hooks' to the $classes array
            $classes[] = 'show-udesign-action-hooks';
            return $classes;
    }
    add_filter('body_class','add_udesign_action_hooks_class');
    include( trailingslashit( get_template_directory() ) . 'lib/u-design-hooks/u-design-show-action-hook-locations.php' );
}


/**
 * This function will update deprecated custom field options with corresponding new names 
 * and then will set a flag that this has been done so it's run only once 
 * 
 * The following list shows which custom field options have been been deprecated and what names have been updated to:
 * 
 *      Deprecated Name:                 |   New Name:
 *      --------------------------------------------------------
 *      "udesign_add_slider_revolution"  |  "_udesign_add_slider_revolution"
 *      "udesign_max_page_width"         |  "_udesign_max_page_width"
 *      "udesign_custom_page_width"      |  "_udesign_custom_page_width"
 *      "udesign_custom_sidebar_width"   |  "_udesign_custom_sidebar_width"
 * 
 * Since U-Design v2.10.2
 */
if ( !get_option("udesign_deprecated_page_specific_postmetakeys_flag") && version_compare(UDESIGN_VERSION, '2.10.1', '>') ) {
    function udesign_update_deprecated_postmetakeys() {
        global $wpdb;
        
        /**
         * The following block is for page layout related custom fields ONLY
         * First grab the IDs of all posts/pages that have the above mentioned deprecated custom fields assigned to them. 
         * Then assign the postmetakey '_udesign_overwrite_page_width' to them.
         * 
         */
        $posts_to_update = $wpdb->get_col(
                            "SELECT post_id "
                            . "FROM {$wpdb->postmeta} "
                            . "WHERE meta_key = 'udesign_max_page_width' " 
                               . "OR meta_key = 'udesign_custom_page_width' "
                               . "OR meta_key = 'udesign_custom_sidebar_width'" );
        if( is_array($posts_to_update) ) {
            $posts_to_update  = array_unique( $posts_to_update );
            foreach ($posts_to_update as $post_id) {
                update_post_meta( $post_id, '_udesign_overwrite_page_width', 'on' );
            }
        }
        
        /**
         * The following code will update any of the theme's old style revslider shortcodes to the new format containing an alias
         * First grab the IDs of all posts/pages that have the deprecated 'udesign_add_slider_revolution' custom field assigned to them. 
         * Then update any old style revslider shortcodes to the new format with alias 
         * 
         */
        $posts_to_update = $wpdb->get_col( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = 'udesign_add_slider_revolution'" );
        if( is_array($posts_to_update) ) {
            $posts_to_update  = array_unique( $posts_to_update );
            foreach ($posts_to_update as $post_id) {
                // Update any old style revslider shortcodes to the new format with alias 
                $udesign_add_slider_revolution = get_post_meta( $post_id, 'udesign_add_slider_revolution', true );
                if( has_shortcode( $udesign_add_slider_revolution, 'rev_slider' ) ) {
                    preg_match( '/' . get_shortcode_regex() . '/s', $udesign_add_slider_revolution, $matches );
                    $atts_array = shortcode_parse_atts( $matches[3] );
                    if ( !array_key_exists('alias', $atts_array) ) {
                        // update the shortcode to include alias
                        $shortcode = '[rev_slider alias="'.$atts_array[0].'"]';
                        update_post_meta( $post_id, 'udesign_add_slider_revolution', $shortcode );
                    }
                }
            }
        }
        
        
        /**
         * Proceed with updating the postmetakeys
         * 
         */
        // update deprecated 'udesign_add_slider_revolution' meta_key to '_udesign_add_slider_revolution'
        $wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_udesign_add_slider_revolution' WHERE meta_key = 'udesign_add_slider_revolution'");
        // update deprecated 'udesign_max_page_width' meta_key to '_udesign_max_page_width'
        $wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_udesign_max_page_width' WHERE meta_key = 'udesign_max_page_width'");
        // update deprecated 'udesign_custom_page_width' meta_key to '_udesign_custom_page_width'
        $wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_udesign_custom_page_width' WHERE meta_key = 'udesign_custom_page_width'");
        // update deprecated 'udesign_custom_sidebar_width' meta_key to '_udesign_custom_sidebar_width'
        $wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_udesign_custom_sidebar_width' WHERE meta_key = 'udesign_custom_sidebar_width'");
        
        // set a flag that the deprectated uptions have been dealt with.
        update_option( 'udesign_deprecated_page_specific_postmetakeys_flag', 'updated' );
    }
    add_action('init', 'udesign_update_deprecated_postmetakeys');
}

// Add revolution slider to pages
function udesign_add_slider_revolution_to_pages() {
    // Do not display the slider if the page is set as Front page
    if ( !is_front_page() && !is_search() ) {
        global $post;
        if ( function_exists('is_shop') && is_shop() ) {
            $post_id = get_option( 'woocommerce_shop_page_id' );
        } else {
            $post_id = $post->ID;
        }
        $udesign_add_slider_revolution = get_post_meta( $post_id, '_udesign_add_slider_revolution', true );
        if ( $udesign_add_slider_revolution ) { ?>
            <div id="rev-slider-header">
                <?php //Load Revolution slider
                if ( class_exists('RevSliderFront') ) {
                    $rvslider = new RevSlider();
                    $arrSliders = $rvslider->getArrSliders();
                    if( !empty( $arrSliders ) ) {
                        echo do_shortcode( $udesign_add_slider_revolution );
                    }
                } ?>
            </div>
            <div class="clear"></div>
        <?php 
        }
    }
}
// Add function to 'udesign_top_wrapper_after' hook
add_action('udesign_top_wrapper_after', 'udesign_add_slider_revolution_to_pages');



// Set the flags for Max or Custom Width particular page overwriting global width with shortcodes (used to load "fluid.css" when required)
function is_custom_width_page_func() { 
    global $post;
    set_theme_mod( 'udesign_max_width_page', 'no' );
    set_theme_mod( 'udesign_custom_width_page', 'no' );
    
    $udesign_overwrite_page_width = get_post_meta( $post->ID, '_udesign_overwrite_page_width', true );
    if ( $udesign_overwrite_page_width ) { // Make sure the override the global page/sidebar width option is actually enabled for this page
        // Max Width Page: Process custom field and set 'udesign_max_width_page' flag accordingly for a particular page
        $udesign_max_page_width = get_post_meta( $post->ID, '_udesign_max_page_width', true );
        if ( $udesign_max_page_width ) { 
            set_theme_mod( 'udesign_max_width_page', 'yes' );
        }
        // Custom Width Page: Process custom fields and set 'udesign_custom_width_page' flag accordingly for a particular page
        $udesign_custom_page_width = get_post_meta( $post->ID, '_udesign_custom_page_width', true ); 
        $udesign_custom_sidebar_width = get_post_meta( $post->ID, '_udesign_custom_sidebar_width', true );
        if ( is_numeric($udesign_custom_page_width) || is_numeric($udesign_custom_sidebar_width) ) { 
            set_theme_mod( 'udesign_custom_width_page', 'yes' );
        }
    }
    
}
add_action('udesign_head_top', 'is_custom_width_page_func');

function custom_width_page_func() { 
    if ( get_theme_mod( 'udesign_max_width_page' ) == 'yes' || get_theme_mod( 'udesign_custom_width_page' ) == 'yes' ) { 
        global $post;
        $udesign_custom_page_width = get_post_meta( $post->ID, '_udesign_custom_page_width', true ); 
        // Make sure the received page width values are sane and if not grab the theme's global page width option
        if( !is_numeric($udesign_custom_page_width) ||  $udesign_custom_page_width < 960  ) {
            $udesign_custom_page_width = 960; 
        }
        $udesign_custom_sidebar_width = get_post_meta( $post->ID, '_udesign_custom_sidebar_width', true );
        // Make sure the received sidebar width values are sane and if not grab the theme's global sidebar width option
        if( !is_numeric($udesign_custom_sidebar_width) || $udesign_custom_sidebar_width < 1  ) {
            $udesign_custom_sidebar_width = 33; 
        }
        // calculate content width from sidebar width (in percentages)
        $udesign_custom_content_width = 100 - $udesign_custom_sidebar_width; ?>
        <style type="text/css">
            @media screen and (min-width: 960px) {
                /* Set the Container widths first */
<?php         if ( get_theme_mod( 'udesign_max_width_page' ) == 'yes' ) : ?>
                .container_24 {
                    width: 94%;
                    max-width: 94%;
                    margin-left: 3%;
                    margin-right: 3%;
                }
<?php         else : ?>
                .container_24 {
                    max-width: <?php echo $udesign_custom_page_width; ?>px;
                    width: auto;
                    margin-left: auto;
                    margin-right: auto;
                }
                @media screen and (min-width: 1000px){ #feedback { display: block; } }
                @media screen and (max-width: <?php echo ($udesign_custom_page_width + 40); ?>px) { #feedback { display: none; } }
                @media screen and (min-width: 1040px){ #page-peel { display: block; } }
                @media screen and (max-width: <?php echo ($udesign_custom_page_width + 100); ?>px) { #page-peel { display: none; } }
<?php         endif; ?>
                /* Sidebar */
                #main-content.grid_16 { width: <?php echo $udesign_custom_content_width;?>%; }
                #sidebar.grid_8 { width: <?php echo $udesign_custom_sidebar_width; ?>%; }
                #sidebar.push_8, #main-content.push_8 { left: <?php echo $udesign_custom_sidebar_width; ?>%; }
                #main-content.pull_16, #sidebar.pull_16 { right: <?php echo $udesign_custom_content_width;?>%; }
            }
        </style>
        <?php 
    }
}
add_action('udesign_head_bottom', 'custom_width_page_func');



// Generate and pass the Sitemap page content
function udesign_sitemap_page_content() {
    if ( is_page_template( 'sitemap.php' ) ) {
        ob_start(); ?>
                    <div class="one_half">
                            <h3><?php esc_html_e('Site Feeds', 'udesign'); ?></h3>
                            <ul class="list-10">
                                    <li><a href="<?php bloginfo('rss2_url'); ?>"><?php esc_html_e('Main RSS Feed', 'udesign'); ?></a></li>
                                    <li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php esc_html_e('Comments RSS Feed', 'udesign'); ?></a></li>
                            </ul>

                            <h3><?php esc_html_e('Pages', 'udesign'); ?></h3>
                            <ul class="list-10">
                                    <?php wp_list_pages('title_li='); ?>
                            </ul>

                            <h3><?php esc_html_e('Categories', 'udesign'); ?></h3>
                            <ul class="list-10">
                                    <?php wp_list_categories('title_li='); ?>
                            </ul>

                            <h3><?php esc_html_e('Monthly Archives', 'udesign'); ?></h3>
                            <ul class="list-10">
                                    <?php wp_get_archives('type=monthly'); ?>
                            </ul>
    <?php			if ( function_exists('wp_tag_cloud') ) : ?>
                                <h3><?php esc_html_e('Tags', 'udesign'); ?></h3>
    <?php			    echo preg_replace('/class=\"(.*?)\"|class=\'(.*?)\'/', 'class="list-10"', wp_tag_cloud('smallest=9&largest=9&format=list&echo=0'));
                            endif; ?>
                    </div>

                    <div class="one_half last_column">
                            <h3><?php esc_html_e('All Articles', 'udesign'); ?></h3>
                            <ol class="list-2">
    <?php			    $all_articles = new WP_Query('showposts=-1');
                                if ($all_articles->have_posts()) : 
                                    while ($all_articles->have_posts()) : $all_articles->the_post(); ?>
                                        <li style="margin-bottom:10px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a><br /><?php the_time(__('j-M-y', 'udesign')); ?> &bull; <?php the_author_posts_link(); ?> &bull; <?php comments_popup_link( __( '0 Comment', 'udesign' ), __( '1 Comment', 'udesign' ), __( '% Comments', 'udesign' ) ); ?></li>
    <?php                           endwhile;
                                    wp_reset_postdata(); // Restore original Post Data
                                endif; ?>
                            </ol>
                    </div>
                    <div class="clear"></div>
    <?php
        $sitemap_content_html = ob_get_clean();
        $html = apply_filters( 'udesign_get_sitemap_page_content', $sitemap_content_html );
        echo $html;
    }
}
add_action('udesign_main_content_bottom', 'udesign_sitemap_page_content', 7);



/**
 * U-Design Theme specific tweaks for Revolution Slider
 * 
 */
if( is_admin() && class_exists('RevSliderFront') ) {
    //check whether the plugin has been registered (activated for updates and support) or not 
    $validated = get_option('revslider-valid', 'false');
    if( $validated == 'false' ) {
        // Set the RevSlider Plugin as a Theme. This hides the activation notice and the activation area in the Slider Overview
        set_revslider_as_theme();
        // remove the plugins page nag
        global $pagenow;
        if( $pagenow == 'plugins.php' ){
            remove_action('admin_notices', array('RevSliderAdmin', 'add_plugins_page_notices'));
        }
    }
}


/**
 * Initialize Visual Composer as "built into the theme".
 * If the user activated VC with their own license then they can update it directly and VC will NOT be run as part of the theme
 */
if( is_admin() && function_exists('vc_set_as_theme') && (  function_exists( 'vc_license' ) && method_exists( vc_license(), 'isActivated') && !vc_license()->isActivated() ) ) {
    add_action( 'vc_before_init', 'udesign_vc_set_as_theme' );
    function udesign_vc_set_as_theme() {
        vc_set_as_theme( true );
    }
    
    // VC's:  vc_set_as_theme( $disable_updater = true ) is currently not playing nice with TGM Plugin Activation class, hence this:
    if( function_exists('vc_manager') ) {
        if ( isset($_GET['page']) && ( substr($_GET['page'], 0, 3) === 'vc-' ) ) {
            vc_manager()->disableUpdater( false );
        } else {
            vc_manager()->disableUpdater( true );
            // remove vc activation notice from non-vc pages
            function udesign_vc_admin_notices(){
                remove_action('admin_notices', array(vc_license(), 'adminNoticeLicenseActivation'));
            }
            add_action('vc_after_init', 'udesign_vc_admin_notices');
        }
    }
}

/**
 * Hide email from Spam Bots using a shortcode. Example: [safe_email]john.doe@example.com[/safe_email]
 *
 * @param array  $atts    Shortcode attributes. Not used.
 * @param string $content The shortcode content. Should be an email address.
 *
 * @return string The obfuscated email address. 
 */
function udesign_hide_email_shortcode( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}
	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}
add_shortcode( 'safe_email', 'udesign_hide_email_shortcode' );



// Apply custom styles to TinyMCE visual editor
function udesign_add_custom_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/scripts/admin/custom-editor-style.css' );
    global $udesign_font_awesome_options;
    if ( ! $udesign_font_awesome_options['udesign_disable_font_awesome'] ) {
        add_editor_style( get_template_directory_uri() . '/styles/common-css/font-awesome/css/font-awesome.min.css' );
    }
}
add_action( 'after_setup_theme', 'udesign_add_custom_editor_styles' );

// quick function to convert hex colors to rgb
function udesign_hex2rgb( $colour ) {
    if ($colour[0] == '#') {
        $colour = substr($colour, 1);
    }
    if (strlen($colour) == 6) {
        list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
    } elseif (strlen($colour) == 3) {
        list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
    } else {
        return false;
    }
    return array('red' => hexdec($r), 'green' => hexdec($g), 'blue' => hexdec($b));
}

// Secondary navigation bar
if ( $udesign_options['enable_secondary_menu_bar'] ) {
    
    // Insert Secondary Navigation bar at the very top
    function udesign_add_secondary_navigation_bar() {
        global $udesign_options; 
        $secondary_menu_id = $udesign_options['secondary_menu_term_id'];
        
        // display only if at least one item is active and has content
        if ( $udesign_options['secondary_menu_text_area_1_width'] && $udesign_options['secondary_menu_text_area_1'] || 
             $udesign_options['secondary_menu_text_area_2_width'] && $udesign_options['secondary_menu_text_area_2'] || 
             $udesign_options['secondary_menu_width'] && $udesign_options['secondary_menu_term_id'] != 'select_menu' ) {
            
            $text_1_html = $secondary_menu_html = $text_2_html = '';
            ob_start(); ?>
                <div id="secondary-navigation-bar-wrapper">
                    <div id="secondary-navigation-bar" class="container_24">
                        <div id="secondary-navigation-bar-content">
<?php                       if ( $udesign_options['secondary_menu_text_area_1_width'] != 0 ) : ?>
<?php                           ob_start(); ?>
                                    <div id="secondary-nav-bar-location-1" class="grid_<?php echo $udesign_options['secondary_menu_text_area_1_width']; ?>">
                                        <div id="sec-nav-text-area-1">
                                            <?php echo do_shortcode( __( $udesign_options['secondary_menu_text_area_1'], 'udesign' ) ); ?>
                                        </div>
                                    </div>
<?php                           $text_1_html = ob_get_clean(); ?>
<?php                       endif; ?>
<?php                       if ( $udesign_options['secondary_menu_text_area_2_width'] != 0 ) : ?>
<?php                           ob_start(); ?>
                                    <div id="secondary-nav-bar-location-2" class="grid_<?php echo $udesign_options['secondary_menu_text_area_2_width']; ?>">
                                        <div id="sec-nav-text-area-2">
                                            <?php echo do_shortcode( __( $udesign_options['secondary_menu_text_area_2'], 'udesign' ) ); ?>
                                        </div>
                                    </div>
<?php                           $text_2_html = ob_get_clean(); ?>
<?php                       endif; ?>
<?php                       if ( $udesign_options['secondary_menu_width'] != 0 ) : ?>
<?php                           ob_start(); ?>
                                    <div id="secondary-nav-bar-location-3" class="grid_<?php echo $udesign_options['secondary_menu_width']; ?>">
                                        <div id="sec-nav-menu-area">
                                            <?php if ( is_numeric($secondary_menu_id) ) {
                                                wp_nav_menu( array( 'menu' => $udesign_options['secondary_menu_term_id'], 'container_class' => 'secondary-menu-header', 'depth' => 1 ) );
                                            } ?>
                                        </div>
                                    </div>
<?php                           $secondary_menu_html = ob_get_clean(); ?>
<?php                       endif; ?>

<?php                       switch ( $udesign_options['secondary_menu_items_order'] ) {
                                case "txt1|menu|txt2":
                                    echo $text_1_html . $secondary_menu_html . $text_2_html;
                                    break;
                                case "txt1|txt2|menu":
                                    echo $text_1_html . $text_2_html . $secondary_menu_html;
                                    break;
                                case "menu|txt1|txt2":
                                    echo $secondary_menu_html . $text_1_html . $text_2_html;
                                    break;
                                case "menu|txt2|txt1":
                                    echo $secondary_menu_html . $text_2_html . $text_1_html;
                                    break;
                                case "txt2|menu|txt1":
                                    echo $text_2_html . $secondary_menu_html . $text_1_html;
                                    break;
                                case "txt2|txt1|menu": 
                                    echo $text_2_html . $text_1_html . $secondary_menu_html;
                                    break;
                                case "txt1|menu":
                                    echo $text_1_html . $secondary_menu_html;
                                    break;
                                case "menu|txt1":
                                    echo $secondary_menu_html . $text_1_html;
                                    break;
                                case "txt2|menu":
                                    echo $text_2_html . $secondary_menu_html;
                                    break;
                                case "menu|txt2":
                                    echo $secondary_menu_html . $text_2_html;
                                    break;
                                case "txt1|txt2":
                                    echo $text_1_html . $text_2_html;
                                    break;
                                case "txt2|txt1":
                                    echo $text_2_html . $text_1_html;
                                    break;
                                case "txt1":
                                    echo $text_1_html;
                                    break;
                                case "txt2":
                                    echo $text_2_html;
                                    break;
                                case "menu":
                                    echo $secondary_menu_html;
                                    break;
                                default : // when no items active echo nothing
                                    echo "";
                            }
                            
                            ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
<?php
            $secondary_navigation_bar_html = ob_get_clean();
            $html = apply_filters( 'udesign_get_secondary_navigation_bar', $secondary_navigation_bar_html );
            echo $html;

        }
    }
    add_action( 'udesign_top_wrapper_top', 'udesign_add_secondary_navigation_bar', 8 );
    
}




// Add U-Design to the WordPress Toolbar Menus
function udesign_add_admin_bar() {
	global $wp_admin_bar;
        
        if (!current_user_can( who_can_edit_udesign_theme_options() )
                || !is_admin_bar_showing()
                || !is_object($wp_admin_bar)
                || !function_exists('is_admin_bar_showing')) {
            return;
        }
    
	$args = array(
		'id'     => 'u-design-settings-page',
		'title'  => __( 'U-Design Options', 'udesign' ),
		'href'   => admin_url('admin.php?page=udesign_options_page'),
                'parent' => false
	);
	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'     => 'u-design-settings-page-child',
		'parent' => 'u-design-settings-page',
		'title'  => __( 'Settings', 'udesign' ),
		'href'   => admin_url('admin.php?page=udesign_options_page'),
	);
	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'     => 'u-design-icon-fonts-child',
		'parent' => 'u-design-settings-page',
		'title'  => __( 'Icon Fonts', 'udesign' ),
		'href'   => admin_url('admin.php?page=udesign_icon_fonts_options_page'),
	);
	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'     => 'u-design-updates-child',
		'parent' => 'u-design-settings-page',
		'title'  => __( 'Theme Update', 'udesign' ),
		'href'   => admin_url('admin.php?page=udesign_updates_options_page'),
	);
	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'     => 'u-design-backup-child',
		'parent' => 'u-design-settings-page',
		'title'  => __( 'Backup / Import', 'udesign' ),
		'href'   => admin_url('admin.php?page=udesign_backup_options'),
	);
	$wp_admin_bar->add_node( $args );

}
// Hook into the 'wp_before_admin_bar_render' action
add_action( 'wp_before_admin_bar_render', 'udesign_add_admin_bar', 999 );


/**
 * The following block deals with cases when the user's custom styles were wiped out during theme update. 
 * The scripts compares for versions of the file and if necessary restores it from database
 */
function custom_style_css_update_from_db() {
    global $udesign_options;
    $custom_style_css_file = get_template_directory(). '/styles/custom/custom_style.css';
    $custom_style_css_last_modified = @filemtime( $custom_style_css_file );
    if ( $udesign_options['custom_styles'] && ( get_theme_mod( 'udesign_custom_style_last_modified' ) != $custom_style_css_last_modified ) ) {
        if ( get_theme_mod( 'udesign_custom_styles_use_css_file' ) ) { // write the styles to "custom_style.css" file if file is writable
            require_once( ABSPATH . 'wp-admin/includes/file.php' ); // Make sure that this file is included to be able to access the WP_Filesystem from the front end
            $access_type = get_filesystem_method();
            if ( $access_type === 'direct' ) {
                $creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, false, array() );
                /* initialize the API */
                if ( ! WP_Filesystem( $creds ) ) {
                    /* any problems and we exit */
                    return false;
                }
                global $wp_filesystem;
                // restore the contents of "custom_style.css" from database
                $wp_filesystem->put_contents( $custom_style_css_file, $udesign_options['custom_styles'], FS_CHMOD_FILE);
            }
            // set the 'udesign_custom_style_css_updated_from_db' flag
            set_theme_mod( 'udesign_custom_style_css_updated_from_db', 'yes' );
        }
    }
}
add_action( 'udesign_head_bottom', 'custom_style_css_update_from_db', 99 );



/**
 * Load CMB2 metabox, custom fields, and forms library
 */
include( trailingslashit( get_template_directory() ) . 'lib/u-design-cmb2/u-design-cmb2-functions.php' );


/**
 * Get the page specific layout options based on "U-Design Options" metabox selection
 * 
 * @param string $option_to_check This is the layout option to check, the exact string name is based on option key. Available options: 'no_header', 'no_container', 'no_bottom', 'no_footer'
 * @return boolean True if the layout option is selected and false otherwise
 */
function udesign_check_page_layout_option( $option_to_check = 'no_header' ) {
    global $post;
    $udesign_page_layout_options = get_post_meta( $post->ID, '_udesign_page_layout_options', true );
    return ( is_array( $udesign_page_layout_options ) && in_array( $option_to_check, $udesign_page_layout_options ) ) ? true : false;
}


/**
 * Modify the default comment form fields
 * 
 */
function udesign_style_comment_fields($fields) {
    unset($fields['author']);
    unset($fields['email']);
    unset($fields['url']);
    
    $commenter = wp_get_current_commenter();

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
    $fields   =  array(
            'author' => '<p class="comment-form-author">'.
                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /> ' . 
                        '<label for="author">' . esc_html__('Name', 'udesign') . ( $req ? ' <span class="required">' . esc_html__('(required)', 'udesign') . '</span>' : '' ) . '</label>' . 
                        '</p>',
            'email'  => '<p class="comment-form-email">' .
                        '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /> ' . 
                        '<label for="email">' . esc_html__('Email (will not be published)', 'udesign') . ( $req ? ' <span class="required">' . esc_html__('(required)', 'udesign') . '</span>' : '' ) . '</label> ' . 
                        '</p>',
            'url'    => '<p class="comment-form-url">'.
                        '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' . 
                        '<label for="url">' . esc_html__('Website', 'udesign') . '</label>' . 
                        '</p>',
    );
    return $fields;
}
add_filter( 'comment_form_default_fields', 'udesign_style_comment_fields' );



/**
 * In WordPress 4.4 the comment textarea was moved to the top above the Name, Email, and Website fields which is supposed to be better from usability and accessibility point of view.
 * The following will move back the comment textfield to the bottom if the users so wishes...
 * 
 */
if ( isset( $udesign_options['udesign_comment_field_to_bottom'] ) && $udesign_options['udesign_comment_field_to_bottom'] ) {
    function udesign_move_comment_field_to_bottom( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;
        return $fields;
    }
    add_filter( 'comment_form_fields', 'udesign_move_comment_field_to_bottom' );
}



/*
 * The Following will output a notice to users using any of the flash-based sliders to let them know that I'll be removing those.
 * 
 */
if (  current_user_can( who_can_edit_udesign_theme_options() ) && ( $udesign_options['current_slider'] == '1' || $udesign_options['current_slider'] == '2' || $udesign_options['current_slider'] == '3') ) {
    
    //delete_user_meta( get_current_user_id(), 'dismiss_sliders_notice' ); // TESTING: clear 'dismiss_sliders_notice'
    function flash_based_sliders_removal_admin_notice() { 
        $user_id = get_current_user_id();
        if ( ! get_user_meta( $user_id, 'dismiss_sliders_notice' ) ) { 
            $dismiss_notice_url = add_query_arg(
                array(
                    'page' => 'udesign_options_page',
                    'dismiss_sliders_notice' => urlencode( '1' ),
                ),
                admin_url( 'admin.php' )
            );
            ?>
            <div class="notice notice-warning sliders-removal-notice">
                <p><strong>IMPORTANT MESSAGE (U-DESIGN THEME):</strong> This message concerns you because you are using either 
                    <em>Flashmo Grid slider</em>, <em>Piecemaker</em> or <em>Piecemaker 2</em> slider. Please be advised that these three sliders will be <strong>removed</strong> from the theme 
                within the next few updates, this is necessary because of their age and lack of compatibility with mobile browsers. You are advised to 
                switch to any of the remaining sliders that the theme offers, eg. Revolution slider or any other third party slider solution you see fit.</p>
                <p style="margin-top:5px; font-weight:bold;"><a class="dismiss-notice" href="<?php echo esc_url($dismiss_notice_url); ?>" target="_parent">Dismiss this notice</a></p>
            </div>
        <?php 
        }
    }
    add_action( 'admin_notices', 'flash_based_sliders_removal_admin_notice' );
    
    function dismiss_sliders_notice_init(){
        if ( isset($_GET['dismiss_sliders_notice']) && $_GET['dismiss_sliders_notice'] === '1') {
            add_user_meta(get_current_user_id(), 'dismiss_sliders_notice', 'true', true);
            if ( wp_get_referer() ) {
                /* Redirects user to where they were before */
                wp_safe_redirect(wp_get_referer());
            } else {
                /* if there is no referrer redirect to dashboard */
                wp_safe_redirect( admin_url() );
            }
        }
    }
    add_action('admin_init', 'dismiss_sliders_notice_init');
    
}

/*
 * The Following will output a notice to users to let them know that they need to update/save the theme's "Font Settings" after updating the theme post version 2.9.0
 * 
 */
if (  current_user_can( who_can_edit_udesign_theme_options() ) && ( isset($udesign_options['font_family'] ) && version_compare(UDESIGN_VERSION, '2.9.0', '>') ) ) {
    
    /*
     *  The following list shows which theme options names have been been deprecated and replaced within the $udesign_options array:
     * 
     *      Deprecated Name:                 |   New Name:
     *      --------------------------------------------------------
     *      "font_family"                    |  "general_font_family"
     *      "font_size"                      |  "general_font_size"
     *      "body_font_line_height"          |  "general_font_line_height"
     *      "title_headings_font_family"     |  "headings_font_family"
     *      "heading_font_size_coefficient"  |  "headings_font_size_coefficient"
     *      "heading_font_line_height"       |  "headings_font_line_height"
     * 
     */
    $udesign_options['general_font_family'] = $udesign_options['font_family'];
    $udesign_options['general_font_size'] = $udesign_options['font_size'];
    $udesign_options['general_font_line_height'] = $udesign_options['body_font_line_height'];
    $udesign_options['headings_font_family'] = $udesign_options['title_headings_font_family'];
    $udesign_options['headings_font_size_coefficient'] = $udesign_options['heading_font_size_coefficient'];
    $udesign_options['headings_font_line_height'] = $udesign_options['heading_font_line_height'];
    update_option( 'udesign_options', $udesign_options ); // Update the $udesign_options with the new values
    
    function udesign_update_font_settings_admin_notice() { ?>
            <div class="notice notice-warning is-dismissible">
                <p><strong>IMPORTANT MESSAGE (U-DESIGN THEME):</strong> Looks like you just updated the U-Design theme. There were some changes and new features added to the theme's 
                    "Font Settings" section. You are required to <strong>refresh</strong> the <a href="<?php echo esc_url(admin_url( 'admin.php' ).'?page=udesign_options_page'); ?>">U-Design Settings page</a> first and then <strong>save it</strong> 
                    in order for the new changes to take effect. Not doing so might impact your site's typography. Sorry for the inconvenience.</p>
            </div>
        <?php 
    }
    add_action( 'admin_notices', 'udesign_update_font_settings_admin_notice' );
    
    
}


/**
 * Add Custom Header Image to a Page
 * 
 */
function udesign_add_custom_header_image_to_page() {
    global $post, $udesign_options;
    if ( function_exists('is_shop') && is_shop() ) {
        $post_id = get_option( 'woocommerce_shop_page_id' );
    } else {
        $post_id = $post->ID;
    }

    // get the attachment ID for the uploaded image
    $attachment_id = get_post_meta( $post_id, '_udesign_page_header_image_id', true ); // this meta is provided along with the "_udesign_page_header_image" CMB2 custom meta
    if ( $attachment_id ) : 
        $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ); // get the image alt tag
        $img_meta = wp_get_attachment_metadata( $attachment_id ); // will use it to get the image width and height
        $img_src = wp_get_attachment_image_url( $attachment_id, 'full' ); 
        $img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'full' ); ?>
        <div id="page-custom-header">
            <img id="custom-header-img" src="<?php echo esc_url( $img_src ); ?>" srcset="<?php echo esc_attr($img_srcset); ?>" sizes="(max-width: 720px) 100vw, (max-width: 960px) 100vw, <?php echo esc_attr($img_meta['width']); ?>px" width="<?php echo esc_attr($img_meta['width']); ?>" height="<?php echo esc_attr($img_meta['height']); ?>" alt="<?php echo esc_attr($alt); ?>" class="alignnone size-full" />          

<?php       // calculate top area height offset and custom styles
            $top_area_over_header_image = get_post_meta( $post_id, '_udesign_page_top_area_over_header_image', true );
            $page_top_area_bg = get_post_meta( $post_id, '_udesign_page_top_area_bg', true );

            if ( $top_area_over_header_image ) : 
                $resp_menu_2_at_br_point_1 = false;
                if ( isset( $udesign_options['menu_2_screen_width'] ) && $udesign_options['menu_2_screen_width'] == 'yes') {
                    $resp_menu_2_at_br_point_1 = true;
                }
?>
                <script type="text/javascript">
                    // <![CDATA[
                    var headerOffsetHeight = document.getElementById('top-wrapper').clientHeight;
                    document.getElementById("custom-header-img").style.marginTop = "-"+headerOffsetHeight+"px";
                    jQuery(window).load(function () {
                        var respMenu2AtBrPoint1 = '<?php echo $resp_menu_2_at_br_point_1; ?>';
                        // on initial page load
                        var headerOffsetHeight = document.getElementById('top-wrapper').clientHeight;
                        document.getElementById("custom-header-img").style.marginTop = "-"+headerOffsetHeight+"px";
                        // on page resize
                        if (respMenu2AtBrPoint1) {
                            jQuery(window).resize(function () {
                                // get browser width
                                var currentWidth = window.innerWidth || document.documentElement.clientWidth;
                                if ( 720 <= currentWidth <= 959) {
                                    headerOffsetHeight = document.getElementById('top-wrapper').clientHeight; 
                                    document.getElementById("custom-header-img").style.marginTop = "-"+headerOffsetHeight+"px";
                                }
                            });
                        }
                    });
                    // ]]>
                </script>
                <style>@media screen and (min-width: 720px){#top-wrapper{background-color:<?php echo $page_top_area_bg; ?>;background-image: none;position:relative;}}@media screen and (max-width: 719px){#page-custom-header img{margin-top:0 !important;}}</style>
<?php       endif; ?>
            <script type="text/javascript">jQuery('#custom-header-img').fadeIn( 1200 );</script>

        </div>
        <div class="clear"></div>
<?php 
    endif;
}
// Add function to 'udesign_top_wrapper_after' hook
add_action('udesign_top_wrapper_after', 'udesign_add_custom_header_image_to_page', 8);


/**
 * The following will disable the "Posts page" option located under "Settings -> Reading -> Front page displays"
 * This option is not required for the U-Design theme which is using an alternative way to setup the Blog section.
 * 
 * @global type $pagenow
 */
function udesign_disable_posts_page_option() {
   // First set the 'page_for_posts' option to '0'
    if ( get_option( 'show_on_front' ) === 'page' && get_option( 'page_for_posts' ) !== '0' ) {
        update_option( 'page_for_posts', '0' );
    }
    // Now disable the dropdown option with some jQuery
    global $pagenow;
    if ( 'options-reading.php' === $pagenow ) {
        ob_start(); ?>
            <script type="text/javascript">
                // <![CDATA[
                jQuery(document).ready(function($){
                    $('label[for="page_for_posts"]').css( "cursor","default").after(' - <span class="description">This option is not required for the U-Design theme which is using an alternative way to setup the Blog section. For instructions on how to setup Blogs with U-Design please refer to the theme\'s Documentation, under "U-Design -> Settings -> Help".</span>');
                    var section = $('#front-static-pages'),
                        pageForPostsSelect = section.find('select#page_for_posts'),
                        check_disabled = function(){
                            pageForPostsSelect.prop( 'disabled', true );
                        };

                    check_disabled(); // on page load
                    section.find('input:radio').change(function() { // on radio option change
                        check_disabled();
                    });
                });
                // ]]>
            </script>
        <?php 
        echo ob_get_clean();
    }
}
add_action( 'admin_print_footer_scripts', 'udesign_disable_posts_page_option', 20 );


/**
 * A function used to programmatically create a page in WordPress, only if the page doesn't already exist.
 *
 * @param string $slug 
 * @param string $title 
 * @param string $post_status  Choose post status from: 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'
 * @param int $author_id 
 * @param string $post_content 
 * @param string $page_template  This is the page template to be assigned
 * @param int $featured_image_id  Ths is the $attachment_id for the image media file to be used to be assigned as "Featured Image"
 * 
 * @return int The ID (positive integer) of the post if successful, otherwise -1 if the post was never created, -2 if a post with the same title exists.
 */
function udesign_programmatically_create_page( $slug = '', $title = '', $post_status = 'publish', $author_id = 0, $post_content = '', $page_template = '', $featured_image_id = 0 ) {
        
    // Initialize the page ID to -1. This indicates no action has been taken.
    $post_id = -1;

    // Setup the slug, title and author for the post
    $slug = ( $slug ) ? $slug : 'example-page';
    $title = ( $title ) ? $title : 'My Example Page';
    $author_id = ( $author_id ) ? $author_id : get_current_user_id(); 

    // If the page doesn't already exist, then create it
    if( null == get_page_by_title( $title ) ) {

            // Set the post ID so that we know the post was created successfully
            $post_id = wp_insert_post(
                    array(
                            'comment_status'	=>	'closed',
                            'ping_status'		=>	'closed',
                            'post_author'		=>	$author_id,
                            'post_name'		=>	$slug,
                            'post_title'		=>	$title,
                            'post_content'          =>      $post_content,
                            'post_status'		=>	$post_status,
                            'post_type'		=>	'page'
                    )
            );
    } else {
            // Arbitrarily use -2 to indicate that the page with the title already exists
            $post_id = -2;
    }
        
    if( -1 == $post_id || -2 == $post_id ) {
        // if page not created log errors go here
    } else { // page created successfully
        // Set a "Featured Image" for the newly created page. Check whether the $attachment_id specified exists. 
        if( wp_get_attachment_image( $featured_image_id ) ) { // proceed only if $featured_image_id found
            set_post_thumbnail( $post_id, $featured_image_id );
        }
        
        // Assign a page template to the newly created page
        if ( $post_id && ! is_wp_error( $post_id ) && $page_template ){
            update_post_meta( $post_id, '_wp_page_template', $page_template );
        }
    }
	
    return $post_id;
}


function udesign_set_welcome_page() {
    // only generate the page if this is the first time the theme is activated
    if ( !get_option("udesign_options") && !get_option("udesign_set_welcome_page_flag") ) {

        ob_start(); ?>
<h2>Welcome to U-Design</h2>
<p>Thank you for choosing the "uDesign" theme!</p>

<p>To begin please make sure to first review the theme's <a target="_blank" href="<?php echo trailingslashit( get_template_directory_uri() ) . 'scripts/documentation/index.html'; ?>">documentation</a>.</p>

<p>Should you have any questions please post them to the theme's support forum where our support specialists can help you out. 
For your convenience, here's the <a target="_blank" title="Support Forum" href="http://dreamthemedesign.com/u-design-support/">direct link</a> to the forums. If possible, please start a new support thread so all of the team can help you out.</p>

<p>Happy site building!<br />
<em>The U-Design team</em></p>
        <?php 
        $the_page_content = ob_get_clean();
        
        /***************( Generate "U-Design Welcome" page )*******************/
        $welcome_page_id = udesign_programmatically_create_page( 
                                    'udesign-welcome', // slug
                                    'U-Design Welcome', // title
                                    'publish', // This is the post_status
                                    get_current_user_id(), // 'post_author' ID, if not specified the current logged in user ID will be used
                                    $the_page_content, // the content
                                    'page-FullWidth.php' // the page template to be assigned
                                    //12345 // featured image $attachment_id 
                            );
        /**
         * ************************( HOME PAGE )***************************
         * Set the Home page selection that is specific to this demo
         * 
         */
        $homepage = get_page_by_title( 'U-Design Welcome' );
        if ( $homepage ) {
            update_option( 'page_on_front', $homepage->ID );
            update_option( 'show_on_front', 'page' );
        }
        // set a flag that the welcome page has already been created once
        update_option( 'udesign_set_welcome_page_flag', 'page_created' );
    }
}

// Generate the Welcome page only upon the theme's activation
function udesign_theme_activated () {
    udesign_set_welcome_page();
}
add_action('after_switch_theme', 'udesign_theme_activated');







