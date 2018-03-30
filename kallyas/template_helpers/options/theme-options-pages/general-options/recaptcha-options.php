<?php
/**
 * Theme options > General Options  > ReCaptcha options
 */

$recaptcha_url = esc_url( 'http://www.google.com/recaptcha' );

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( 'RECAPTCHA OPTIONS', 'zn_framework' ),
    "description" => sprintf( __( 'The options below are related to <a href="%s" target="_blank">Google ReCaptcha</a> security integration in Kallyas forms. ', 'zn_framework' ), $recaptcha_url ),
    "id"          => "info_title13",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);


$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( "Recaptcha style", 'zn_framework' ),
    "description" => __( "Choose the desired recapthca style.", 'zn_framework' ),
    "id"          => "rec_theme",
    "std"         => "red",
    "type"        => "select",
    "options"     => array (
        "red"        => __( "Red", 'zn_framework' ),
        "white"      => __( "White", 'zn_framework' ),
        "blackglass" => __( "Blackglass", 'zn_framework' ),
        "clean"      => __( "Clean", 'zn_framework' ),
    )
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( "reCaptcha Site Key", 'zn_framework' ),
    "description" => __( "Please enter the Site Key you've got from ", 'zn_framework' ) . $recaptcha_url,
    "id"          => "rec_pub_key",
    "std"         => "",
    "type"        => "textarea"
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( "reCaptcha Secret Key", 'zn_framework' ),
    "description" => __( "Please enter the Secret Key you've got from ", 'zn_framework' ) . $recaptcha_url,
    "id"          => "rec_priv_key",
    "std"         => "",
    "type"        => "textarea"
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "rco_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#MXRAmRVaOaY', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options'
));
$admin_options[] = zn_options_doc_link_option( 'http://support.hogash.com/documentation/configure-recaptcha/', array(
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
));
