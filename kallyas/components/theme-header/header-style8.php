<?php if(! defined('ABSPATH')){ return; }

/**
* Display the Style 8 header
* Hooks mostly, markup loaded through own template
*/

/**
 * ==========================================================
 * CSS custom classes customisations
 * ==========================================================
 */

/**
 * Add custom CSS classes to the <header> tag
 */
// $header_class[] = '';


/**
 * Flexbox scheme override
 *
 * You can override the default markup's vertical and horizontal alignment, as well as "cell" stretch.
 * Also you can add custom CSS Classes.
 *
 */
$flexbox_scheme = array();


/**
 * Extra Rows CSS Classes
 *
 * These classes are added to their particular area's rows.
 */
// $top_extra_class = '';
// $main_extra_class = '';
// $bottom_extra_class = '';


/**
 * Extra CSS Class for "siteheader-container".
 *
 * This class will be added to the siteheader-container block.
 */
// $siteheader_container_class = '';


/**
 * Sticky classes.
 *
 * The area's that will hide on scroll.
 *
 * @Types: sticky-top-area AND/OR sticky-main-area AND/OR sticky-bottom-area
 */
$sticky_class = 'sticky-main-area';

/**
 * Default Text Color Scheme.
 *
 * This will define de default text color scheme of this header style.
 *
 * @Types: sh--light OR sh--gray OR sh--dark
 */
$headerTextScheme = 'sh--light';


/**
 * ==========================================================
 * Hook header's components
 * ==========================================================
 *
 * Components are loaded through hooks into their predefined area.
 * You can move or reorder components through simple remove_action / add_action through Kallyas child theme.
 */

/**** MAIN LEFT */

add_action( 'zn_head__main_left', 'zn_header_display_logo' ); // LOGO MARKUP


/**** MAIN CENTER */

add_action( 'zn_head__main_center', 'zn_header_searchbox_inp' ); // SEARCH


/**** MAIN RIGHT */

add_action( 'zn_head__main_right', 'zn_header_head_text', 10 ); // CUSTOM TEXT
add_action( 'zn_head__main_right', 'zn_wpml_language_switcher', 20 ); // WPML LANGUAGE SWITCHER
add_action( 'zn_head__main_right', 'zn_header_social_icons', 30 ); // SOCIAL ICONS

/**** MAIN RIGHT - 2ND ROW */

add_action( 'zn_head__main_right_ext', 'zn_add_navigation', 10 ); // HEADER NAVIGATION
add_action( 'zn_head__main_right_ext', 'zn_hidden_pannel_link', 20 ); // HIDDEN PANEL LINK
add_action( 'zn_head__main_right_ext', 'zn_login_text', 30 ); // LOGIN/LOGOUT TEXT
add_action( 'zn_head__main_right_ext', 'zn_register_text', 40 ); // REGISTER TEXT


/**** BOTTOM LEFT */

if(zn_check_components('mainmenu')) add_action( 'zn_head__bottom_left', 'zn_header_main_menu' ); // MAIN NAVIGATION


/**** BOTTOM RIGHT */

if(zn_check_components('cart')) add_action( 'zn_head__bottom_right', 'zn_woocomerce_cart_init', 1 ); // CART PANEL
if(zn_check_components('cta')) add_action( 'zn_head__bottom_right', 'zn_header_calltoaction', 2 ); // CALL TO ACTION BUTTON


/**
 * ==========================================================
 * Load general HTML markup
 * ==========================================================
 *
 * The header's markup is loaded for all headers. If you plan on overriding the HTML markup,
 * first make sure you can do it through hooks. If you're sure, simply copy the markup, paste it inside this file and
 * copy this file to ../kallyas-child/components/theme-header/ folder.
 */
include(locate_template('components/theme-header/header-markup.php'));
