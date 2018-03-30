<?php
/**
 * Theme options > General Options  > Google Analytics
 */

$admin_options[] = array (
    'slug'        => 'google_analytics',
    'parent'      => 'general_options',
    "name"        => __( 'GOOGLE ANALYTICS OPTIONS', 'zn_framework' ),
    "description" => __( 'The options below are related to Google Analytics / Google Tag Manager integration in Kallyas. ', 'zn_framework' ),
    "id"          => "info_title11",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
    'slug'        => 'google_analytics',
    'parent'      => 'general_options',
    "name"        => __( "Google Analytics / Google Tag Manager Code", 'zn_framework' ),
    "description" => __( "Paste your Google Analytics generated Tracking code (or Google Tag Manager code) below. Don't forget to paste the to include the wrapping &lt;script&gt; tags.", 'zn_framework' ),
    "id"          => "google_analytics",
    "std"         => '',
    "type"        => "textarea",
    "class"       => "zn_full"
);

$admin_options[] = array (
    'slug'        => 'google_analytics',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "gao_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#zxQaeY_bFxY', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'google_analytics',
    'parent'      => 'general_options'
));
$admin_options[] = zn_options_doc_link_option( 'http://support.hogash.com/documentation/google-analytics/', array(
    'slug'        => 'google_analytics',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'google_analytics',
    'parent'      => 'general_options',
));
