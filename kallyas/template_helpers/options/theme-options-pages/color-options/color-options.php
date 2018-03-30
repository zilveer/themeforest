<?php
/**
 * Theme options > COLOR OPTIONS
 */

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "MAIN COLOR", 'zn_framework' ),
    "description" => __( "Please choose a main color for your site. This color will be used for various elements within the site, as text color (and hover) and background color (and hover).", 'zn_framework' ),
    "id"          => "zn_main_color",
    "std"         => "#cd2122",
    "type"        => "colorpicker"
);
$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "MAIN COLOR (Contrast)", 'zn_framework' ),
    "description" => __( "This color is used exclusively where it's over or depends on the MAIN COLOR. For example default color is Red, this White color will be over it, for example active menu item in main menu, Full-Colored button, etc. This comes in need when you're using a main color that's too bright and it becomes unreadable.", 'zn_framework' ),
    "id"          => "zn_main_color_contrast",
    "std"         => "#fff",
    "type"        => "colorpicker"
);

// ********************

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( 'Global Site Colors', 'zn_framework' ),
    "description" => __( 'These are the global site color options.', 'zn_framework' ),
    "id"          => "clo_title_main",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator "
);

/*
    ref: #386 & #731
 */
$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "THEME SKIN", 'zn_framework' ),
    "description" => __( "Please select the skin of the theme, wether light or dark. <br>* Please know that customisations are still needed and most elements have their own customisation options (eg: colorprickers or even text color scheme light/dark preset).", 'zn_framework' ),
    "id"          => "zn_main_style",
    "std"         => "light",
    "options"     => array (
        'light' => __( 'Light Style ( Default )', 'zn_framework' ),
        'dark'  => __( 'Dark Style', 'zn_framework' )
    ),
    "type"        => "select"
);

/**
 * LIGHT VERSION COLORS
 */
$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "TEXT COLOR (Light - Theme Skin)", 'zn_framework' ),
    "description" => __( "Please choose a default color for the site's general text color. <br>* Note: There is another color option in Kallyas options > Font options > Body Options. Make sure that option is empty. We'll keep that one just for backwards compatibility only, but it will be removed.", 'zn_framework' ),
    "id"          => "zn_body_def_textcolor",
    "std"         => "",
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'zn_main_style', 'value' => array ( 'light' ) ),
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "LINKS COLORS (Light - Theme Skin)", 'zn_framework' ),
    "description" => __( "Please choose a default color for the site's general links color (mostly in post content)", 'zn_framework' ),
    "id"          => "zn_body_def_linkscolor",
    "std"         => "",
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'zn_main_style', 'value' => array ( 'light' ) ),
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "HOVER LINKS COLOR (Light - Theme Skin)", 'zn_framework' ),
    "description" => __( "Please choose a default color for the site's general hover links color (mostly in post content).", 'zn_framework' ),
    "id"          => "zn_body_def_linkscolor_hov",
    "std"         => "",
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'zn_main_style', 'value' => array ( 'light' ) ),
);

/**
 * DARK VERSION COLORS
 */
$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "TEXT COLOR (Dark - Theme Skin)", 'zn_framework' ),
    "description" => __( "Please choose a default color for the site's general text color. <br>* Note: There is another color option in Kallyas options > Font options > Body Options. Make sure that option is empty. We'll keep that one just for backwards compatibility only, but it will be removed.", 'zn_framework' ),
    "id"          => "zn_body_def_textcolor_dark",
    "std"         => "#dcdcdc",
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'zn_main_style', 'value' => array ( 'dark' ) ),
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "LINKS COLORS (Dark - Theme Skin)", 'zn_framework' ),
    "description" => __( "Please choose a default color for the site's general links color (mostly in post content).", 'zn_framework' ),
    "id"          => "zn_body_def_linkscolor_dark",
    "std"         => "#ffffff",
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'zn_main_style', 'value' => array ( 'dark' ) ),
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "HOVER LINKS COLOR (Dark - Theme Skin)", 'zn_framework' ),
    "description" => __( "Please choose a default color for the site's general hover links color (mostly in post content).", 'zn_framework' ),
    "id"          => "zn_body_def_linkscolor_hov_dark",
    "std"         => "#eee",
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'zn_main_style', 'value' => array ( 'dark' ) ),
);

// BACKGROUND BODY COLOR
$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "BACKGROUND COLOR", 'zn_framework' ),
    "description" => __( "Please choose a default color for the site's body.", 'zn_framework' ),
    "id"          => "zn_body_def_color",
    "std"         => "",
    "type"        => "colorpicker",
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "BACKGROUND IMAGE", 'zn_framework' ),
    "description" => __( "Please choose your desired image to be used as as body background.", 'zn_framework' ),
    "id"          => "body_back_image",
    "std"         => '',
    "options"     => array ( "repeat" => true, "position" => true, "attachment" => true, "size" => true ),
    "type"        => "background"
);

// ********************

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( 'Various Color Options', 'zn_framework' ),
    "description" => __( 'These are various colors for different parts from the site.', 'zn_framework' ),
    "id"          => "clo_title_various",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator "
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Top Nav default Color", 'zn_framework' ),
    "description" => __( "Please choose a color for the top nav links in header.", 'zn_framework' ),
    "id"          => "zn_top_nav_color",
    "std"         => "",
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Top Nav Hover Color", 'zn_framework' ),
    "description" => __( "Please choose a color for the top nav links in header when hovering over them.", 'zn_framework' ),
    "id"          => "zn_top_nav_h_color",
    "std"         => "",
    "type"        => "colorpicker"
);


$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "clmo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#MkYR_3PYbXU', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'color_options',
    'parent'      => 'color_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'color_options',
    'parent'      => 'color_options',
));
