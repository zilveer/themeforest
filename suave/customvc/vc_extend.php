<?php

/*
  Plugin Name: CommerceGurus Visual Composer Extensions
  Plugin URI: http://commercegurus.com
  Description: Extensions to Visual Composer for the CommerceGurus themes.
  Version: 1.0
  Author: CommerceGurus
  Author URI: http://commercegurus.com
  License: GPLv2 or later
 */

// don't load directly
if ( !defined( 'ABSPATH' ) )
    die( '-1' );

/*
  Display notice if Visual Composer is not installed or activated.
 */
if ( !defined( 'WPB_VC_VERSION' ) ) {
    add_action( 'admin_notices', 'cg_vc_extend_notice' );
    return;
}

function cg_vc_extend_notice() {
    $plugin_data = get_plugin_data( __FILE__ );
    echo '
  <div class="updated">
    <p>' . sprintf( __( '<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'commercegurus' ), $plugin_data['Name'] ) . '</p>
  </div>';
}

//Removing shortcodes
vc_remove_element( "vc_widget_sidebar" );
vc_remove_element( "vc_wp_search" );
vc_remove_element( "vc_wp_meta" );
vc_remove_element( "vc_wp_recentcomments" );
vc_remove_element( "vc_wp_calendar" );
vc_remove_element( "vc_wp_pages" );
vc_remove_element( "vc_wp_tagcloud" );
vc_remove_element( "vc_wp_custommenu" );
vc_remove_element( "vc_wp_text" );
vc_remove_element( "vc_wp_posts" );
vc_remove_element( "vc_wp_links" );
vc_remove_element( "vc_wp_categories" );
vc_remove_element( "vc_wp_archives" );
vc_remove_element( "vc_wp_rss" );
vc_remove_param( 'vc_separator', 'accent_color' );
vc_remove_param( 'vc_separator', 'style' );
vc_remove_param( 'vc_separator', 'el_width' );

/*
  Load plugin css and javascript files
 */
add_action( 'wp_enqueue_scripts', 'cg_vc_extend_js_css' );

function cg_vc_extend_js_css() {
    //wp_register_style( 'cg_vc_extend_style', plugins_url('cg_vc_extend.css', __FILE__) );
    //wp_enqueue_style( 'cg_vc_extend_style' );
    // If you need any javascript files on front end, here is how you can load them.
    //wp_enqueue_script( 'cg_vc_extend_js', plugins_url('cg_vc_extend.js', __FILE__), array('jquery') );
}

/*
  Lets register our shortcode with bartag base and few params (attributes):
 * foo
 * color
 * content

  [bartag foo="something" color="#FFF"] Content here [/bartag]

  More information can be found here:
  http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
 */
add_shortcode( 'bartag', 'bartag_func' );

function bartag_func( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'foo' => 'something',
        'color' => '#FFF'
                    ), $atts ) );

    $content = wpb_js_remove_wpautop( $content ); // fix unclosed/unwanted paragraph tags in $content

    return "<div style='color:{$color};' data-foo='${foo}'>{$content}</div>";
}

vc_add_param( "vc_row", array(
    "type"          => "dropdown",
    "class"         => "",
    "heading"       => "Type",
    "param_name"    => "type",
    "save_always"   => true,
    "value"         => array(
        "Fixed Page Width" => "container",
        "Full Page Width - No Container" => "full_page_width",
        "Full Page Width - Inner Container" => "full_page_width_inner_container",
    ),
) );

vc_add_param( "vc_row", array(
    "type"          => "textfield",
    "class"         => "",
    "heading"       => "Padding Top",
    "value"         => "",
    "param_name"    => "padding_top",
    "save_always"   => true,
    "description"   => "",
) );

vc_add_param( "vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Padding Bottom",
    "value" => "",
    "param_name" => "padding_bottom",
    "save_always"    => true,
    "description" => "",
) );

// Separator

$separator_setting = array(
    'show_settings_on_create' => true,
    "controls" => '',
);
vc_map_update( 'vc_separator', $separator_setting );

vc_add_param( "vc_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Type",
    "param_name" => "type",
    "value" => array(
        "Normal" => "normal",
        "Transparent" => "transparent",
        "Full width" => "full_width",
        "Small" => "small"
    ),
    "save_always"    => true,
    "description" => ""
) );

vc_add_param( "vc_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Position",
    "param_name" => "position",
    "value" => array(
        "Center" => "center",
        "Left" => "left",
        "Right" => "right"
    ),
    "dependency" => array( "element" => "type", "value" => array( "small" ) ),
    "save_always" => true,
    "description" => ""
) );

vc_add_param( "vc_separator", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => "Color",
    "param_name" => "color",
    "value" => "",
    "save_always" => true,
    "description" => ""
) );

vc_add_param( "vc_separator", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Thickness",
    "param_name" => "thickness",
    "value" => "",
    "save_always" => true,
    "description" => ""
) );
vc_add_param( "vc_separator", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Top Margin",
    "param_name" => "up",
    "value" => "",
    "save_always" => true,
    "description" => ""
) );
vc_add_param( "vc_separator", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Bottom Margin",
    "param_name" => "down",
    "value" => "",
    "save_always" => true,
    "description" => ""
) );


/*
  Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.
 */
vc_map( array(
    "name" => __( "CommerceGurus latest blog posts", 'commercegurus' ),
    "base" => "cg_latest_posts",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Introduction Text", 'commercegurus' ),
            "param_name" => "introtext",
            "value" => __( "From the blog", 'commercegurus' ),
            "save_always" => true,
            "description" => __( "Enter the title you wish to display over your latest posts.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Number of Posts",
            "param_name" => "posts",
            "value" => "8",
            "save_always" => true,
            "description" => __( "Enter the total number of posts you wish to display in the carousel.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "CommerceGurus top reviews", 'commercegurus' ),
    "base" => "cg_topreviews",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Number of Posts",
            "param_name" => "posts",
            "value" => "8",
            "save_always" => true,
            "description" => __( "Enter the total number of posts you wish to display in the carousel.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "CommerceGurus Logos", 'commercegurus' ),
    "base" => "cg_logos",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Number of Logos",
            "param_name" => "posts",
            "value" => "10",
            "save_always" => true,
            "description" => __( "Enter the total number of logos you wish to display in the carousel.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "WooCommerce Latest Products Carousel", 'commercegurus' ),
    "base" => "cg_woo_latest_products",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Introduction Text", 'commercegurus' ),
            "param_name" => "introtext",
            "value" => __( "Latest products", 'commercegurus' ),
            "save_always" => true,
            "description" => __( "Enter the title you wish to display over the carousel.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Number of Products",
            "param_name" => "products",
            "value" => "12",
            "save_always" => true,
            "description" => __( "Enter the total number of products you wish to display in the carousel.", 'commercegurus' )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Order by",
            "param_name" => "orderby",
            "value" => array(
                "Date Created" => "date",
                "Date Last Modified" => "modified",
                "Page Order" => "menu_order"
            ),
            "save_always" => true,
            "description" => __( "Select the ordering for display of carousel items.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "WooCommerce Featured Products Carousel", 'commercegurus' ),
    "base" => "cg_woo_featured_products",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Introduction Text", 'commercegurus' ),
            "param_name" => "introtext",
            "value" => __( "Recommended for you", 'commercegurus' ),
            "save_always" => true,
            "description" => __( "Enter the title you wish to display over the carousel.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Number of Products",
            "value" => "12",
            "param_name" => "products",
            "save_always" => true,
            "description" => __( "Enter the total number of products you wish to display in the carousel.", 'commercegurus' )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Order by",
            "param_name" => "orderby",
            "value" => array(
                "Date Created" => "date",
                "Date Last Modified" => "modified",
                "Page Order" => "menu_order"
            ),
            "save_always" => true,
            "description" => __( "Select the ordering for display of carousel items.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "CommerceGurus Latest Showcase", 'commercegurus' ),
    "base" => "cg_latest_portfolio",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Introduction Text", 'commercegurus' ),
            "param_name" => "introtext",
            "value" => __( "Our Latest Work", 'commercegurus' ),
            "save_always" => true,
            "description" => __( "Enter the title you wish to display over the carousel.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Number of Items", 'commercegurus' ),
            "value" => "12",
            "param_name" => "items",
            "save_always" => true,
            "description" => __( "Enter the total number of items you wish to display in the carousel.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "CommerceGurus Testimonials", 'commercegurus' ),
    "base" => "cg_testimonials",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Number of Testimonials", 'commercegurus' ),
            "value" => "12",
            "param_name" => "posts",
            "save_always" => true,
            "description" => __( "Enter the total number of items you wish to display in the carousel.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "CommerceGurus Google Map", 'commercegurus' ),
    "base" => "cg_map",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Map height", 'commercegurus' ),
            "param_name" => "height",
            "value" => "300px",
            "save_always" => true,
            "description" => __( "Enter the height of your map", 'commercegurus' )
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Map content", 'commercegurus' ),
            "param_name" => "content",
            "value" => __( "This is a test map address!", 'commercegurus' ),
            "save_always" => true,
            "description" => __( "Please enter your map content here (e.g. your address).", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Latitude", 'commercegurus' ),
            "param_name" => "lat",
            "value" => "40.72513",
            "save_always" => true,
            "description" => __( "Enter the latitude for your map location. Find Lat/long coordinates - http://goo.gl/yvyYdf", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Longitude", 'commercegurus' ),
            "param_name" => "long",
            "value" => "-73.99908",
            "save_always" => true,
            "description" => __( "Enter the longitude for your map location.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Zoom level", 'commercegurus' ),
            "param_name" => "zoom",
            "value" => "17",
            "save_always" => true,
            "description" => __( "Enter a zoom level for your map.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "CommerceGurus Message Box", 'commercegurus' ),
    "base" => "cg_promo",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Height", 'commercegurus' ),
            "param_name" => "height",
            "value" => "120px",
            "save_always" => true,
            "description" => __( "Enter the height of your message box.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Message box title", 'commercegurus' ),
            "param_name" => "title",
            "value" => __( "A message box title", 'commercegurus' ),
            "save_always" => true,
            "description" => __( "Enter the title you wish to display in the message box.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Message box button text", 'commercegurus' ),
            "value" => __( "Button text", 'commercegurus' ),
            "param_name" => "button_text",
            "save_always" => true,
            "description" => __( "Enter the text you wish to display on the button in your message box.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Button link", 'commercegurus' ),
            "value" => "http://",
            "param_name" => "button_url",
            "save_always" => true,
            "description" => __( "Enter the full hyperlink you wish to add to the message box button. Don't forget the http://!", 'commercegurus' )
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Message box background color", 'commercegurus' ),
            "value" => "#333",
            "param_name" => "bg",
            "save_always" => true,
            "description" => __( "Select a background color for your message box.", 'commercegurus' )
        ),
    )
) );

vc_map( array(
    "name" => __( "CommerceGurus Content Strip", 'commercegurus' ),
    "base" => "cg_content_strip",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Content Strip Height", 'commercegurus' ),
            "param_name" => "height",
            "value" => "250px",
            "save_always" => true,
            "description" => __( "Enter the height of your content strip.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Link to wrap around content strip", 'commercegurus' ),
            "param_name" => "outer_link",
            "value" => "",
            "save_always" => true,
            "description" => __( "Enter a hyperlink if you want the entire content strip to be clickable. Don't forget the http.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Content Area Width", 'commercegurus' ),
            "param_name" => "width",
            "value" => "50%",
            "save_always" => true,
            "description" => __( "Enter the width of your content area. Note this is not the width of the column itself - that is controlled by the column and properties.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => "Bottom Margin",
            "param_name" => "margin_bottom",
            "value" => "",
            "save_always" => true,
            "description" => __( "Enter the bottom margin of your content strip.", 'commercegurus' )
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Message box background color", 'commercegurus' ),
            "value" => "#333",
            "param_name" => "bg",
            "save_always" => true,
            "description" => __( "Select a background color for your message box.", 'commercegurus' )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Vertical Position", 'commercegurus' ),
            "param_name" => "valign",
            "value" => array(
                "Center" => "center",
                "Top" => "top",
                "Bottom" => "bottom",
            ),
            "description" => __( "Select the vertical position of your content.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Horizontal Position", 'commercegurus' ),
            "param_name" => "halign",
            "value" => array(
                "Center" => "center",
                "Left" => "left",
                "Right" => "right",
            ),
            "save_always" => true,
            "description" => __( "Select the horizontal position of your content.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text alignment", 'commercegurus' ),
            "param_name" => "text_align",
            "value" => array(
                "Center" => "center",
                "Left" => "left",
                "Right" => "right",
            ),
            "save_always" => true,
            "description" => __( "Select the alignment for your content.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text color", 'commercegurus' ),
            "param_name" => "color",
            "value" => array(
                "Light" => "light",
                "Dark" => "dark",
            ),
            "save_always" => true,
            "description" => __( "Select your text color preference.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text animation effect", 'commercegurus' ),
            "param_name" => "animation",
            "value" => array(
                "none" => "none",
                "bounce" => "bounce",
                "flash" => "flash",
                "pulse" => "pulse",
                "rubberBand" => "rubberBand",
                "shake" => "shake",
                "swing" => "swing",
                "tada" => "tada",
                "wobble" => "wobble",
                "bounceIn" => "bounceIn",
                "bounceInDown" => "bounceInDown",
                "bounceInLeft" => "bounceInLeft",
                "bounceInRight" => "bounceInRight",
                "bounceInUp" => "bounceInUp",
                "bounceOut" => "bounceOut",
                "bounceOutDown" => "bounceOutDown",
                "bounceOutLeft" => "bounceOutLeft",
                "bounceOutRight" => "bounceOutRight",
                "bounceOutUp" => "bounceOutUp",
                "fadeIn" => "fadeIn",
                "fadeInDown" => "fadeInDown",
                "fadeInDownBig" => "fadeInDownBig",
                "fadeInLeft" => "fadeInLeft",
                "fadeInLeftBig" => "fadeInLeftBig",
                "fadeInRight" => "fadeInRight",
                "fadeInRightBig" => "fadeInRightBig",
                "fadeInUp" => "fadeInUp",
                "fadeInUpBig" => "fadeInUpBig",
                "fadeOut" => "fadeOut",
                "fadeOutDown" => "fadeOutDown",
                "fadeOutDownBig" => "fadeOutDownBig",
                "fadeOutLeft" => "fadeOutLeft",
                "fadeOutLeftBig" => "fadeOutLeftBig",
                "fadeOutRight" => "fadeOutRight",
                "fadeOutRightBig" => "fadeOutRightBig",
                "fadeOutUp" => "fadeOutUp",
                "fadeOutUpBig" => "fadeOutUpBig",
                "flip" => "flip",
                "flipInX" => "flipInX",
                "flipInY" => "flipInY",
                "flipOutX" => "flipOutX",
                "flipOutY" => "flipOutY",
                "lightSpeedIn" => "lightSpeedIn",
                "lightSpeedOut" => "lightSpeedOut",
                "rotateIn" => "rotateIn",
                "rotateInDownLeft" => "rotateInDownLeft",
                "rotateInDownRight" => "rotateInDownRight",
                "rotateInUpLeft" => "rotateInUpLeft",
                "rotateInUpRight" => "rotateInUpRight",
                "rotateOut" => "rotateOut",
                "rotateOutDownLeft" => "rotateOutDownLeft",
                "rotateOutDownRight" => "rotateOutDownRight",
                "rotateOutUpLeft" => "rotateOutUpLeft",
                "rotateOutUpRight" => "rotateOutUpRight",
                "slideInDown" => "slideInDown",
                "slideInLeft" => "slideInLeft",
                "slideInRight" => "slideInRight",
                "slideOutLeft" => "slideOutLeft",
                "slideOutRight" => "slideOutRight",
                "slideOutUp" => "slideOutUp",
                "hinge" => "hinge",
                "rollIn" => "rollIn",
                "rollOut" => "rollOut",
            ),
            "save_always" => true,
            "description" => __( "Select your text animation preference.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text fade out on scroll?", 'commercegurus' ),
            "param_name" => "text_fade_out",
            "value" => array(
                "No" => "no",
                "Yes" => "yes",
            ),
            "save_always" => true,
            "description" => __( "Would you like text to fade out upon scroll?", 'commercegurus' ),
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => "Custom content css class (normally .cg-content-strip)",
            "param_name" => "custom_content_css",
            "value" => "",
            "save_always" => true,
            "description" => __( "This is useful when you would like custom css to change how markup renders in content strips.", 'commercegurus' )
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Content", 'commercegurus' ),
            "param_name" => "content",
            "value" => __( "
<h4>Title text</h4>
[vc_button title='View more' target='_self' color='wpb_button' icon='none' size='btn-small' href='#' el_class='see-through']", 'commercegurus' ),
            "save_always" => true,
            "description" => __( "This can be as simple as a page title or a full page if you want!.", 'commercegurus' )
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Content strip background image", 'commercegurus' ),
            "value" => "",
            "param_name" => "bg_img",
            "save_always" => true,
            "description" => __( "Upload an image to be used the for the content strip background.", 'commercegurus' )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Type of background", 'commercegurus' ),
            "param_name" => "bg_img_type",
            "value" => array(
                "Simple solid background color" => "simple",
                "Parallax image" => "parallax",
            ),
            "save_always" => true,
            "description" => __( "Set a style/effect for your background image.", 'commercegurus' ),
        ),
    )
) );


vc_map( array(
    "name" => __( "CommerceGurus Video Banner", 'commercegurus' ),
    "base" => "cg_video_banner",
    "class" => "",
    "controls" => "full",
    "icon" => "icon-wpb-cg_vc_extend",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Video Banner Height", 'commercegurus' ),
            "param_name" => "height",
            "value" => "250px",
            "save_always" => true,
            "description" => __( "Enter the height of your video banner.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Link to wrap around video banner", 'commercegurus' ),
            "param_name" => "outer_link",
            "value" => "",
            "save_always" => true,
            "description" => __( "Enter a hyperlink if you want the entire video banner to be clickable. Don't forget the http.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Content Area Width", 'commercegurus' ),
            "param_name" => "width",
            "value" => "70%",
            "save_always" => true,
            "description" => __( "Enter the width of your content area.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => "Bottom Margin",
            "param_name" => "margin_bottom",
            "value" => "",
            "save_always" => true,
            "description" => __( "Enter the bottom margin of your content strip.", 'commercegurus' )
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Message box background color", 'commercegurus' ),
            "value" => "#333",
            "param_name" => "bg",
            "save_always" => true,
            "description" => __( "Select a background color for your message box.", 'commercegurus' )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Vertical Position", 'commercegurus' ),
            "param_name" => "valign",
            "value" => array(
                "Center" => "center",
                "Top" => "top",
                "Bottom" => "bottom",
            ),
            "save_always" => true,
            "description" => __( "Select the vertical position of your content.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Horizontal Position", 'commercegurus' ),
            "param_name" => "halign",
            "value" => array(
                "Center" => "center",
                "Left" => "left",
                "Right" => "right",
            ),
            "save_always" => true,
            "description" => __( "Select the horizontal position of your content.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text alignment", 'commercegurus' ),
            "param_name" => "text_align",
            "value" => array(
                "Center" => "center",
                "Left" => "left",
                "Right" => "right",
            ),
            "save_always" => true,
            "description" => __( "Select the alignment for your content.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text color", 'commercegurus' ),
            "param_name" => "color",
            "value" => array(
                "Light" => "light",
                "Dark" => "dark",
            ),
            "save_always" => true,
            "description" => __( "Select your text color preference.", 'commercegurus' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text animation effect", 'commercegurus' ),
            "param_name" => "animation",
            "value" => array(
                "none" => "none",
                "bounce" => "bounce",
                "flash" => "flash",
                "pulse" => "pulse",
                "rubberBand" => "rubberBand",
                "shake" => "shake",
                "swing" => "swing",
                "tada" => "tada",
                "wobble" => "wobble",
                "bounceIn" => "bounceIn",
                "bounceInDown" => "bounceInDown",
                "bounceInLeft" => "bounceInLeft",
                "bounceInRight" => "bounceInRight",
                "bounceInUp" => "bounceInUp",
                "bounceOut" => "bounceOut",
                "bounceOutDown" => "bounceOutDown",
                "bounceOutLeft" => "bounceOutLeft",
                "bounceOutRight" => "bounceOutRight",
                "bounceOutUp" => "bounceOutUp",
                "fadeIn" => "fadeIn",
                "fadeInDown" => "fadeInDown",
                "fadeInDownBig" => "fadeInDownBig",
                "fadeInLeft" => "fadeInLeft",
                "fadeInLeftBig" => "fadeInLeftBig",
                "fadeInRight" => "fadeInRight",
                "fadeInRightBig" => "fadeInRightBig",
                "fadeInUp" => "fadeInUp",
                "fadeInUpBig" => "fadeInUpBig",
                "fadeOut" => "fadeOut",
                "fadeOutDown" => "fadeOutDown",
                "fadeOutDownBig" => "fadeOutDownBig",
                "fadeOutLeft" => "fadeOutLeft",
                "fadeOutLeftBig" => "fadeOutLeftBig",
                "fadeOutRight" => "fadeOutRight",
                "fadeOutRightBig" => "fadeOutRightBig",
                "fadeOutUp" => "fadeOutUp",
                "fadeOutUpBig" => "fadeOutUpBig",
                "flip" => "flip",
                "flipInX" => "flipInX",
                "flipInY" => "flipInY",
                "flipOutX" => "flipOutX",
                "flipOutY" => "flipOutY",
                "lightSpeedIn" => "lightSpeedIn",
                "lightSpeedOut" => "lightSpeedOut",
                "rotateIn" => "rotateIn",
                "rotateInDownLeft" => "rotateInDownLeft",
                "rotateInDownRight" => "rotateInDownRight",
                "rotateInUpLeft" => "rotateInUpLeft",
                "rotateInUpRight" => "rotateInUpRight",
                "rotateOut" => "rotateOut",
                "rotateOutDownLeft" => "rotateOutDownLeft",
                "rotateOutDownRight" => "rotateOutDownRight",
                "rotateOutUpLeft" => "rotateOutUpLeft",
                "rotateOutUpRight" => "rotateOutUpRight",
                "slideInDown" => "slideInDown",
                "slideInLeft" => "slideInLeft",
                "slideInRight" => "slideInRight",
                "slideOutLeft" => "slideOutLeft",
                "slideOutRight" => "slideOutRight",
                "slideOutUp" => "slideOutUp",
                "hinge" => "hinge",
                "rollIn" => "rollIn",
                "rollOut" => "rollOut",
            ),
            "save_always" => true,
            "description" => __( "Select your text animation preference.", 'commercegurus' ),
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => "Video image alternative for smartphones and tablets",
            "param_name" => "video_img",
            "save_always" => true,
            "description" => __( "Please enter the url to the image alternative for your video.", 'commercegurus' )
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => "Upload a video overlay image.",
            "param_name" => "video_overlay_img",
            "save_always" => true,
            "description" => __( "A video overlay image is used to improve the text contrast on your video background. Upload a 10px * 10px overlay image to change the overlay effect.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "WEBM File",
            "param_name" => "video_webm",
            "save_always" => true,
            "description" => __( "Please enter the url to the WEBM version of your video.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "MP4 File",
            "param_name" => "video_mp4",
            "save_always" => true,
            "description" => __( "Please enter the url to the MP4 version of your video.", 'commercegurus' )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "OGV File",
            "param_name" => "video_ogv",
            "save_always" => true,
            "description" => __( "Please enter the url to the OGV version of your video.", 'commercegurus' )
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Content", 'commercegurus' ),
            "param_name" => "content",
            "value" => __( "<h2>Main title text</h2>
<h4>Subtitle text</h4>
[vc_button title='View more' target='_self' color='wpb_button' icon='none' size='btn-small' href='#' el_class='see-through']", 'commercegurus' ),
            "save_always" => true,
            "description" => __( "This can be as simple as a page title or a full page if you want!.", 'commercegurus' )
        ),
    )
) );

/* * * Person Profile Shortcode ** */

$person_icons = array(
    "" => "",
    "ADN" => "fa-adn",
    "Dribbble" => "fa-dribbble",
    "Facebook" => "fa-facebook",
    "Facebook-Sign" => "fa-facebook-sign",
    "GitHub" => "fa-github",
    "GitHub-Alt" => "fa-github-alt",
    "GitHub-Sign" => "fa-github-sign",
    "Google Plus" => "fa-google-plus",
    "Google Plus-Sign" => "fa-google-plus-sign",
    "Instagram" => "fa-instagram",
    "LinkedIn" => "fa-linkedin",
    "LinkedIn-Sign" => "fa-linkedin-sign",
    "Skype" => "fa-skype",
    "StackExchange" => "fa-stackexchange",
    "Twitter" => "fa-twitter",
    "Twitter-Sign" => "fa-twitter-sign",
    "YouTube" => "fa-youtube",
    "YouTube Play" => "fa-youtube-play",
    "YouTube-Sign" => "fa-youtube-sign"
);

vc_map( array(
    "name" => "Person",
    "base" => "cg_person",
    "category" => __( 'CommerceGurus Shortcodes', 'commercegurus' ),
    "icon" => "icon-wpb-cg_vc_extend",
    "allowed_container_element" => 'vc_row',
    "params" => array(
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => "Person Profile Picture",
            "save_always" => true,
            "param_name" => "person_img"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Full Name",
            "save_always" => true,
            "param_name" => "person_name"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Job Title - Position",
            "save_always" => true,
            "param_name" => "person_title"
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => "Job Description",
            "save_always" => true,
            "param_name" => "person_desc"
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Social Media Icon 1",
            "param_name" => "person_social_icon_1",
            "save_always" => true,
            "value" => $person_icons,
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Social Media Icon 1 - URL",
            "save_always" => true,
            "param_name" => "person_social_icon_1_url"
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Social Media Icon 2",
            "save_always" => true,
            "param_name" => "person_social_icon_2",
            "value" => $person_icons,
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Social Media Icon 2 - URL",
            "save_always" => true,
            "param_name" => "person_social_icon_2_url"
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Social Media Icon 3",
            "param_name" => "person_social_icon_3",
            "save_always" => true,
            "value" => $person_icons,
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Social Media Icon 3 - URL",
            "save_always" => true,
            "param_name" => "person_social_icon_3_url"
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Social Media Icon 4",
            "param_name" => "team_social_icon_4",
            "save_always" => true,
            "value" => $person_icons,
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Social Media Icon 4 - URL",
            "save_always" => true,
            "param_name" => "team_social_icon_4_url"
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Socia Icon 5",
            "param_name" => "team_social_icon_5",
            "save_always" => true,
            "value" => $person_icons,
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Socia Icon 5 Link",
            "save_always" => true,
            "param_name" => "team_social_icon_5_url"
        ),
    )
) );
