<?php
/**
 * Theme options > Font Options  > Alternative font
 */
$admin_options[] = array (
    'slug'        => 'alternative_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( "Custom Selectors Options", 'zn_framework' ),
    "description" => __( "This font is used by various elements in the theme. To add other selectors using this font, use the Custom CSS feature in the page builder or CAREFULLY edit /css/dynamic_css.php file, by searching for 'alternative_font' string.", 'zn_framework' ),
    "id"          => "alternative_font",
    "std"         => array (
        'font-family'   => 'Lato'
    ),
    'supports'   => array( 'font'),
    "type"        => "font"
);


$admin_options[] = array (
    'slug'        => 'alternative_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "afo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#p-YITyC1ROU', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'alternative_fonts_options',
    'parent'      => 'font_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'alternative_fonts_options',
    'parent'      => 'font_options',
));
