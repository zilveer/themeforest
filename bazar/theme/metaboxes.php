<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files the framework register theme metaboxes.
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

function yit_remove_options_metabox( $array ) {
    
    return $array;
}
add_filter( 'yit_remove_options_metabox', 'yit_remove_options_metabox' );

//yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );

/**
 * TESTIMONIALS
 */ 
yit_metaboxes_sep( 'yit-testimonial-site', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Small quote', 'yit' ),
    'desc' =>  __( 'Insert the text to show with blockquote', 'yit' ),
);

yit_add_option_metabox( 'yit-testimonial-site', __( 'Settings', 'yit' ), '_small-quote', 'text', $options );

/**
 * LOGOS
 */ 
yit_register_metabox ( 'yit-logo-site', __( 'Other Logo info', 'yit' ), 'logo' );
$options = array(
    'title' => __( 'Link', 'yit' ),
    'desc' =>  __( 'Insert the link for Logo.', 'yit' ),
);
yit_add_option_metabox( 'yit-logo-site', __( 'Settings', 'yit' ), '_site-link', 'text', $options );

/**
 * SITEMAP
 */
$options = array(
    'title' => __( 'Hide in Sitemap', 'yit' ),
    'desc' =>  __( 'Do not show in Sitemap.', 'yit' ),
);
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_exclude-sitemap', 'checkbox', $options );             
yit_metaboxes_sep( 'yit-post-settings', __( 'Settings', 'yit' ) );
yit_add_option_metabox( 'yit-post-settings', __( 'Settings', 'yit' ), '_exclude-sitemap', 'checkbox', $options );             


/**
* PRODUCT SIDEBAR LAYOUT
*/

yit_register_metabox ( 'yit-custom-product-settings', __( 'Product Page Settings', 'yit' ), 'product' );
 
                                                            

/**
* PRODUCT CUSTOM TABS
*/

$options = array(
    'title' => __( 'Show ask info form?', 'yit' ),
    'desc'  =>  __( 'Set YES if you want a tab with the "Ask Info" form.', 'yit' ),
    'std'   => (yit_get_option('shop-products-details-contact-form') != -1) ? 1 : 0 , // -1 No from selected
);
yit_add_option_metabox( 'yit-custom-product-settings', __( 'Tabs', 'yit' ), '_use_ask_info', 'onoff', $options );

$options = array(
	'title' => __( 'Tabs', 'yit' ),
	'desc' => __( 'Insert a custom tab.', 'yit' ),
);
yit_add_option_metabox ( 'yit-custom-product-settings', __( 'Tabs', 'yit' ), '_custom_tabs', 'customtabs', $options );