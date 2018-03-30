<?php
/**
 * Theme options > Font Options  > Headings
 */

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H1 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h1_typo",
    "std"         => array (
        'font-size'   => '36px',
        'font-family'   => 'Open Sans',
        'line-height' => '40px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "Force Page-Title", 'zn_framework' ),
    "description" => __( "Force page-title (eg: blog posts) to use <strong style='color:#000;'>H1's font-family</strong> (options above), otherwise it'll use <strong>Alternative font</strong>.", 'zn_framework' ),
    "id"          => "h1_pgtitle",
    "std"         => '',
    "value"         => '1',
    "type"        => "toggle2"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H2 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h2_typo",
    "std"         => array (
        'font-size'   => '30px',
        'font-family'   => 'Open Sans',
        'line-height' => '40px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H3 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h3_typo",
    "std"         => array (
        'font-size'   => '24px',
        'font-family'   => 'Open Sans',
        'line-height' => '40px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H4 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h4_typo",
    "std"         => array (
        'font-size'   => '14px',
        'font-family'   => 'Open Sans',
        'line-height' => '20px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H5 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h5_typo",
    "std"         => array (
        'font-size'   => '12px',
        'font-family'   => 'Open Sans',
        'line-height' => '20px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H6 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h6_typo",
    "std"         => array (
        'font-size'   => '12px',
        'font-family'   => 'Open Sans',
        'line-height' => '20px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "hdfo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#p-YITyC1ROU', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
));
