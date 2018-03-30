<?php
/**
 * Theme options > General Options  > Favicon options
 */
global $header_option;

if(!isset($header_option) || empty($header_option)){
    $header_option = WpkZn::getThemeHeaders(true);
}

$admin_options[] = array (
    'slug'        => 'documentation_options',
    'parent'      => 'documentation_options',
    "name"        => __( "Header Style", 'zn_framework' ),
    "description" => __( "Select the header style you want to use for this page. Please note that
					header styles can be created from the theme's admin page.", 'zn_framework' ),
    "id"          => "zn_doc_header_style",
    "std"         => "",
    "type"        => "select",
    "options"     => $header_option,
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'documentation_options',
    'parent'      => 'documentation_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "dcmo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'documentation_options',
    'parent'      => 'documentation_options',
));