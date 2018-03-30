<?php
/**
 * Theme options > Font Options  > Main Menu
 */

/**
 * Moved to General options > Navigation options
 */
// Menu TYPOGRAPHY
$admin_options[] = array (
    'slug'        => 'main_menu_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( "Menu Font Options", 'zn_framework' ),
    "description" => __( "Specify the typography properties for the Main Menu.", 'zn_framework' ),
    "id"          => "menu_font",
    "std"         => array (
        'font-size'   => '14px',
        'font-family'   => 'Lato',
        'line-height' => '14px',
        'color'  => '#fff',
        'font-style'  => 'normal',
        'font-weight'  => '700',
    ),
    'supports'   => array( 'size', 'font', 'line', 'color', 'style', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'main_menu_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "mfto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#p-YITyC1ROU', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'main_menu_fonts_options',
    'parent'      => 'font_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'main_menu_fonts_options',
    'parent'      => 'font_options',
));
