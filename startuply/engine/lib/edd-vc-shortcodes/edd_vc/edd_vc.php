<?php
/*
Plugin Name: Easy Digital Downlods for Visual Composer
Plugin URI: http://www.creativeg.gr
Description: A VC Plugin for easy Digital Downloads
Version: 1.0
Author: Creative.gr
Author URI: http://www.creativeg.gr
License: GPL2
*/



if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

include_once(ABSPATH . 'wp-admin/includes/plugin.php');

if (!is_plugin_active('js_composer/js_composer.php')) {
    return false;
}

if (!defined('EEDVC_PATH')) {
    define('EEDVC_PATH', dirname(__FILE__) . '/');
}

// define('EEDVC_URL', plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__))); // uses for admin css. not working
define('EEDVC_VERSION_NUMBER', vc_eddvc_plugin_version());

if (!defined("IS_ADMIN")) {
    define("IS_ADMIN", is_admin());
}

load_plugin_textdomain('eddVC', false, '/' . basename(dirname(__FILE__)) . '/languages/'); // load plugin
add_shortcode('VC_edd', 'vc_edd_parseshortcode');

/**
 * Get the plugin version
 *
 * @since 1.0.0
 *
 * @return current plugin version.
 */


function vc_eddvc_plugin_version() {
        if (!function_exists('get_plugin_data')) {
            require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        $plugin_data = get_plugin_data(EEDVC_PATH . '/edd_vc.php');
        return $plugin_data['Version'];
}

add_action( 'vc_before_init', 'eddvc_integrateWithVC' );


function vc_edd_parseshortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'edd_shortcode_type' => 'downloads',
        'edd_receipt_errormessage' => '',
        'edd_receipt_discountcode' => 1,
        'edd_receipt_products' => 1,
        'edd_receipt_date' => 1,
        'edd_receipt_paymentkey' => 1,
        'edd_receipt_paymentmethod' => 1,
        'edd_receipt_payementid' => 1,
        'edd_login_redirect' => '',
        /* set default values from downloads shortcode in VC */
        'downloads_category' => '',
        'downloads_exclude_category' => '',
        'downloads_tags' => '',
        'downloads_exclude_tags' => '',
        'downloads_relation' => 'AND',
        'downloads_number' => 9,
        'downloads_price' => 'yes',
        'downloads_excerpt' => 'yes',
        'downloads_full_content' => 'yes',
        'downloads_buy_button' => 'yes',
        'downloads_columns' => 1,
        'downloads_paging_on' => 'NO',
        'downloads_thumbnails' => 'true',
        'downloads_orderby' => 'price',
        'downloads_order' => 'DESC',
        'downloads_ids' => '',
        'downloads_startuply_edd_view' => 'list',
        /* end set default values */
        'purchase_link_id' => '',
        'purchase_link_sku' => '',
        'purchase_link_price' => '',
        'purchase_link_text' => '',
        'purchase_link_style' => 'button',
        'purchase_link_color' => 'blue',
        'purchase_link_class' => '',
        'purchase_link_price_id' => '',
        'purchase_link_direct' => 'false',
    ), $atts);

    return do_shortcode(prepareShortcode($atts));
}


function prepareShortcode($atts) {

    if(!in_array(trim(strtolower($atts['edd_shortcode_type'])), array('edd_login', 'downloads', 'purchase_link', 'edd_receipt'))) {
        return '['.trim(strtolower($atts['edd_shortcode_type'])).']';
    }
    elseif($atts['edd_shortcode_type'] === 'edd_login') {
        $shortcode = '[edd_login ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'edd_login_') !== false) && $key != 'edd_shortcode_type' && $param != ''){
                $shortcode .= str_replace('edd_login_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }
    elseif($atts['edd_shortcode_type'] === 'downloads') {
        $shortcode = '[downloads ';
        foreach ($atts as $key => $param ) {
            if((strpos($key, 'downloads_') !== false) && $key != 'edd_shortcode_type' && $param != ''){
                $shortcode .= str_replace('downloads_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }
    elseif($atts['edd_shortcode_type'] === 'purchase_link') {
        $shortcode = '[purchase_link ';
        foreach ($atts as $key => $param) {
            if((strpos($key, 'purchase_link_') !== false) && $key != 'edd_shortcode_type' && $param != ''){
                $shortcode .= str_replace('purchase_link_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }
    elseif($atts['edd_shortcode_type'] === 'edd_receipt') {
        $shortcode = '[edd_receipt ';
        foreach ($atts as $key => $param) {
            if((strpos($key, 'edd_receipt_') !== false) && $key != 'edd_shortcode_type' && $param != ''){
                $shortcode .= str_replace('edd_receipt_', '', $key).'="'.$param.'" ';
            }
        }
        $shortcode .= ']';
        return $shortcode;
    }
}

function eddvc_integrateWithVC() {
  vc_map(array(
            "name" => __("Easy Digital Downloads", 'vivaco'),
            // "admin_enqueue_css" => array(
            //     EEDVC_URL . '/css/custom_vc.css'
            // ),
            "base" => "VC_edd",
            "category" => __('Content', 'vivaco'),
            "icon" => "icon-vc-edd",
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Select the shortcode", 'vivaco'),
                    "param_name" => "edd_shortcode_type",
                    "value" => array(
                        __('Show User’s Download History – [download_history]', 'vivaco') => 'download_history',
                        __('Purchase Summary – [edd_receipt]', 'vivaco') => 'edd_receipt',
                        __('Profile Editor – [edd_profile_editor]', 'vivaco') => 'edd_profile_editor',
                        __('Login Form – [edd_login]', 'vivaco') => 'edd_login',
                        __('Show Available Discount Codes – [download_discounts]', 'vivaco') => 'download_discounts',
                        __('Show Downloads List / Grid – [downloads]', 'vivaco') => 'downloads',
                        __('Show the Shopping Cart – [download_cart]', 'vivaco') => 'download_cart',
                        __('Show the Checkout Form – [download_checkout]', 'vivaco') => 'download_checkout',
                        __('Show User’s Purchase History – [purchase_history]', 'vivaco') => 'purchase_history',
                        __('Display Purchase Buttons – [purchase_link]', 'vivaco') => 'purchase_link',
                    ),
                    "description" => __("Select the shortcode you want to use.", 'vivaco')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Error message", 'vivaco'),
                    "param_name" => "edd_receipt_errormessage",
                    "value" => '',
                    "description" => __("Change the default error message displayed when the receipt is not viewable, Leave it blank to use default one", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'edd_receipt',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Discount", 'vivaco'),
                    "param_name" => "edd_receipt_discountcode",
                    "value" => array(
                                1 => 'YES',
                                0 => 'NO',
                                ),
                    "description" => __("Display discount code ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'edd_receipt',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Display Products ?", 'vivaco'),
                    "param_name" => "edd_receipt_products",
                    "value" => array(
                                1 => 'YES',
                                0 => 'NO',
                                ),
                    "description" => __("Displays the products purchased.", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'edd_receipt',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Display date ?", 'vivaco'),
                    "param_name" => "edd_receipt_date",
                    "value" => array(
                                1 => 'YES',
                                0 => 'NO',
                                ),
                    "description" => __("Display the date of purchase ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'edd_receipt',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Payment key ?", 'vivaco'),
                    "param_name" => "edd_receipt_paymentkey",
                    "value" => array(
                                1 => 'YES',
                                0 => 'NO',
                                ),
                    "description" => __("Displays the payment key ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'edd_receipt',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Payment Method", 'vivaco'),
                    "param_name" => "edd_receipt_paymentmethod",
                    "value" => array(
                                1 => 'YES',
                                0 => 'NO',
                                ),
                    "description" => __("Display the payment method ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'edd_receipt',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Payment ID ?", 'vivaco'),
                    "param_name" => "edd_shortcode_payementid",
                    "value" => array(
                                1 => 'YES',
                                0 => 'NO',
                                ),
                    "description" => __("Display the Order Number ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'edd_receipt',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Custom Login Redirect", 'vivaco'),
                    "param_name" => "edd_login_redirect",
                    "value" => '',
                    "description" => __("By default, users are sent back to the same page as the login form is displayed on, but if you want to send them elsewhere, such as your homepage", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'edd_login',
                        )
                    )
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("View type", 'vivaco'),
                    "param_name" => "downloads_startuply_edd_view",
                    "value" => array(
                              'List' => 'list',
                              'Grid' => 'grid',
                              'Material grid' => 'material-grid',
                              ),
                    "description" => __("The type view", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Display # products at once", 'vivaco'),
                    "param_name" => "downloads_number",
                    "value" => '',
                    "description" => __("Specify the maximum number of downloads you want to outputted by the shortcode on a single page.", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),

				array(
                    "type" => "dropdown",
                    "heading" => __("Columns", 'vivaco'),
                    "param_name" => "downloads_columns",
                    "value" => array(
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '6' => '6',
                                    ),
                    "description" => __("Specify the maximum number of columns you want to outputted by the shortcode.", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Display pagination links?", 'vivaco'),
                    "param_name" => "downloads_paging_on",
                    "value" => array(
                                1 => 'YES',
                                0 => 'NO',
                                ),
                    "description" => __("Choose whether paging links are displayed", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Category", 'vivaco'),
                    "param_name" => "downloads_category",
                    "value" => '',
                    "description" => __("Enter a comma separated list of category IDs / names", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Exclude Category", 'vivaco'),
                    "param_name" => "downloads_exclude_category",
                    "value" => '',
                    "description" => __("Enter a comma separated list of category IDs / names to be excluded", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Tags", 'vivaco'),
                    "param_name" => "downloads_tags",
                    "value" => '',
                    "description" => __("Enter a comma separated list of tag Ids / names", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Exclude tags", 'vivaco'),
                    "param_name" => "downloads_exclude_tags",
                    "value" => '',
                    "description" => __("Enter a comma separated list of tag ids / names to be excluded", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Downloads Ids", 'vivaco'),
                    "param_name" => "downloads_ids",
                    "value" => '',
                    "description" => __("The ids parameter accepts specific download IDs. You can specify multiple download IDs using comma separated values, for example - 3,4,17", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Relation", 'vivaco'),
                    "param_name" => "downloads_relation",
                    "value" => array(
                              'AND' => 'AND',
                              'OR' => 'OR',
                              ),
                    "description" => __("The relation option is for specifying whether the downloads displayed have to be in ALL the categories/tags provided, or just in at least one. Use 'AND' for showing downloads that are filed in every category/tag (very specific), and use 'OR' for showing downloads filed in any of the given categories / tags. Leave both of these blank to show all downloads.", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Price", 'vivaco'),
                    "param_name" => "downloads_price",
                    "value" => array(
                                    'YES' => 'yes',
                                    'NO' => 'no',
                                    ),
                    "description" => __("Display downloads price", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Excerpt", 'vivaco'),
                    "param_name" => "downloads_excerpt",
                    "value" => array(
                                    'YES' => 'yes',
                                    'NO' => 'no',
                                    ),
                    "description" => __("Display excerpt ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Full Content", 'vivaco'),
                    "param_name" => "downloads_full_content",
                    "value" => array(
                                    'YES' => 'yes',
                                    'NO' => 'no',
                                    ),
                    "description" => __("Display full content", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Buy button", 'vivaco'),
                    "param_name" => "downloads_buy_button",
                    "value" => array(
                                    'YES' => 'yes',
                                    'NO' => 'no',
                                    ),
                    "description" => __("Display buy button", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Thumbnails", 'vivaco'),
                    "param_name" => "downloads_thumbnails",
                    "value" => array(
                                    'YES' => 'true',
                                    'NO' => 'false',
                                    ),
                    "description" => __("Display thumbnails ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Order By ?", 'vivaco'),
                    "param_name" => "downloads_order_by",
                    "value" => array(
                                    'Price' => 'price',
                                    'ID' => 'id',
                                    'Random' => 'random',
                                    'Post Date' => 'post_date',
                                    'Title' => 'title',
                                    ),
                    "description" => __("Order By ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Order ?", 'vivaco'),
                    "param_name" => "downloads_order",
                    "value" => array(
                                    'DESC' => 'DESC',
                                    'ASC' => 'ASC',
                                    ),
                    "description" => __("Order ?", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'downloads',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Purchase link ID", 'vivaco'),
                    "param_name" => "purchase_link_id",
                    "value" => '',
                    "description" => __("purchase link ID", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("SKU", 'vivaco'),
                    "param_name" => "purchase_link_sku",
                    "value" => '',
                    "description" => __("The assigned SKU value for the download (if enabled)", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Display Price", 'vivaco'),
                    "param_name" => "purchase_link_price",
                    "value" => array(
                                    'YES' => 1,
                                    'NO' => 0,
                                    ),
                    "description" => __("Whether to show the product price or not.", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Text on button", 'vivaco'),
                    "param_name" => "purchase_link_text",
                    "value" => '',
                    "description" => __("The text displayed on the button", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Style", 'vivaco'),
                    "param_name" => "purchase_link_style",
                    "value" => array(
                                  'Button' => 'button',
                                  'Text' => 'text',
                                    ),
                    "description" => __('the style of the purchase link, either “button” or “text”', 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Color", 'vivaco'),
                    "param_name" => "purchase_link_color",
                    "value" => array(
                                  'Gray' => 'gray',
                                  'Blue' => 'blue',
                                  'Green' => 'green',
                                  'Dark Gray' => 'dark gray',
                                  'Yellow' => 'yellow'
                                    ),
                    "description" => __('the color of the button (when using the “button” style”:', 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Custom Class", 'vivaco'),
                    "param_name" => "purchase_link_class",
                    "value" => '',
                    "description" => __("one or more custom CSS classes you want applied to the button", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Price ID", 'vivaco'),
                    "param_name" => "purchase_link_price_id",
                    "value" => '',
                    "description" => __("The variable price ID to create a purchase button for", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Direct checkout ?", 'vivaco'),
                    "param_name" => "purchase_link_direct",
                    "value" => array(
                                  'true' => 'YES',
                                  'false' => 'NO',
                                    ),
                    "description" => __("whether the purchase button should send the customer straight to PayPal or to the checkout screen.", 'vivaco'),
                    "dependency" => array(
                        'element' => "edd_shortcode_type",
                        'value' => array(
                            'purchase_link',
                        )
                    )
                ),
            )
        ));
}
