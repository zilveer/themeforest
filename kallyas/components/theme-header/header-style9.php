<?php if(! defined('ABSPATH')){ return; }

/**
* Display the Style 9 header
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
$flexbox_scheme = array(
    'main' => array(
        'left' => array(
            'stretch' => 'fxb-basis-20',
        ),
        'right' => array(
            'stretch' => 'fxb-basis-20',
        ),
    ),
);


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
$sticky_class = 'sticky-top-area sticky-main-area';

/**
 * Default Text Color Scheme.
 *
 * This will define de default text color scheme of this header style.
 *
 * @Types: sh--light OR sh--gray OR sh--dark
 */
$headerTextScheme = 'sh--dark';


/**
 * ==========================================================
 * Hook header's components
 * ==========================================================
 *
 * Components are loaded through hooks into their predefined area.
 * You can move or reorder components through simple remove_action / add_action through Kallyas child theme.
 */

/**** TOP LEFT */

if(zn_check_components('header_nav')) add_action( 'zn_head__top_left', 'zn_add_navigation', 10 ); // HEADER NAVIGATION
if(zn_check_components('login')) add_action( 'zn_head__top_left', 'zn_login_text', 20 ); // LOGIN/LOGOUT TEXT
if(zn_check_components('register')) add_action( 'zn_head__top_left', 'zn_register_text', 30 ); // REGISTER TEXT
if(zn_check_components('hidden_panel')) add_action( 'zn_head__top_left', 'zn_hidden_pannel_link', 40 ); // HIDDEN PANEL LINK
if(zn_check_components('custom_text')) add_action( 'zn_head__top_left', 'zn_header_head_text', 50 ); // CUSTOM TEXT

/**** TOP RIGHT */

if(zn_check_components('flags')) add_action( 'zn_head__top_right', 'zn_wpml_language_switcher', 10 ); // WPML LANGUAGE SWITCHER
if(zn_check_components('social_icons')) add_action( 'zn_head__top_right', 'zn_header_social_icons', 20 ); // SOCIAL ICONS


/**** MAIN LEFT */

add_action( 'zn_head__main_left', 'zn_header_searchbox_inp' ); // SEARCH BOX


/**** MAIN CENTER */

add_action( 'zn_head__main_center', 'zn_header_display_logo' ); // LOGO MARKUP


/**** MAIN RIGHT */

add_action( 'zn_head__main_right', 'zn_woocomerce_cart_init', 2 ); // ADD CART PANEL


/**** BOTTOM CENTER */

if(zn_check_components('mainmenu')) add_action( 'zn_head__bottom_center', 'zn_header_main_menu', 10 ); // MAIN NAVIGATION


/**** BOTTOM RIGHT */

if(zn_check_components('cta')) add_action( 'zn_head__bottom_right', 'zn_header_calltoaction', 10 ); // CALL TO ACTION BUTTON


/**** OTHERS */

add_action( 'zn_head__after__top', 'zn_header_separator' ); // Add separator after top

add_action( 'zn_head__before__bottom', 'zn_header_separator' ); // Add separator before bottom



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
