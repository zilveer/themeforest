<?php
/**
 * Theme options > Font Options  > Body Fonts
 */

// Body font options
$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( "Body Font Options", 'zn_framework' ),
    "description" => __( "Specify the typography properties for the body section ( this will apply to all the content on the page ). <br><br><strong>* Note:</strong> Don't use the colorpicker!! There is another color option in Kallyas options > Color Options > Text color. Make sure that one is used. We'll keep this one just for backwards compatibility only, but it will be removed in future versions.", 'zn_framework' ),
    "id"          => "body_font",
    "std"         => array (
        'font-size'   => '13px',
        'font-family'   => 'Open Sans',
        'color'  => ''
    ),
    'supports'   => array( 'size', 'font', 'line', 'color' ),
    "type"        => "font"
);

// Footer font options
$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( "Footer Font Options", 'zn_framework' ),
    "description" => __( "Specify the typography properties for the Footer.", 'zn_framework' ),
    "id"          => "footer_font",
    "std"         => array (
        'font-size'   => '13px',
        'font-family'   => 'Open Sans',
        'color'  => ''
    ),
    'supports'   => array( 'size', 'font', 'line', 'color' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "bfto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#p-YITyC1ROU', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'body_font_options',
    'parent'      => 'font_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
));
