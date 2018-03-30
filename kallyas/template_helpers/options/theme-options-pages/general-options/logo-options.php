<?php
/**
 * Theme options > General Options  > Logo options
 */
$desc = sprintf(
    '%s ( <a href="%s" target="_blank" title="%s">%s</a>).',
    __( 'These options below are related to site\'s logo.', 'zn_framework' ),
    esc_url( 'http://hogash.d.pr/108qR' ),
    __( 'Click to open screenshot', 'zn_framework' ),
    __( 'Open screenshot', 'zn_framework' )
);
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( 'LOGO OPTIONS', 'zn_framework' ),
    "description" => $desc,
    "id"          => "info_title3",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

// Show LOGO In header
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Show LOGO in header", 'zn_framework' ),
    "description" => __( "Please choose if you want to display the logo or not.", 'zn_framework' ),
    "id"          => "head_show_logo",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    ),
    "class"        => "zn_radio--yesno",
);

// Logo Upload
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo Upload", 'zn_framework' ),
    "description" => __( "Upload your logo.", 'zn_framework' ),
    "id"          => "logo_upload",
    "std"         => '',
    "type"        => "media"
);

// Logo auto size ?

$logo_size    = array (
    "yes"     => __( "Auto resize logo", 'zn_framework' ),
    "no"      => __( "Custom size", 'zn_framework' ),
    "contain" => __( "Contain in header", 'zn_framework' ),
);
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo Size :", 'zn_framework' ),
    "description" => __( "Auto resize logo will use the image dimensions, Custom size let's you set the desired logo size and Contain in header will select the proper logo size so that it will be displayed in the header.", 'zn_framework' ),
    "id"          => "logo_size",
    "std"         => "contain",
    "type"        => "zn_radio",
    "options"     => $logo_size,
);

// Logo Dimensions
$default_size = array (
    'height' => '55',
    'width'  => '125'
);
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo manual sizes", 'zn_framework' ),
    "description" => __( 'Please insert your desired logo size in pixels ( for example "35" )', 'zn_framework' ),
    "id"          => "logo_manual_size",
    "std"         => $default_size,
    "type"        => "image_size",
    'dependency'  => array ( 'element' => 'logo_size', 'value' => array ( 'no' ) ),
);


// Logo Sticky
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Sticky Logo", 'zn_framework' ),
    "description" => __( "Will display a secondary logo when header is sticky and scrolling the page. <strong>ONLY</strong> available if you have Sticky Header enabled in General Options. ", 'zn_framework' ),
    "id"          => "logo_sticky",
    "std"         => '',
    "type"        => "media"
);

// Logo Upload
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo on Mobile", 'zn_framework' ),
    "description" => __( "Upload your logo for displaying on viewports smaller than 767px (smartphones, phablets).", 'zn_framework' ),
    "id"          => "logo_upload_mobile",
    "std"         => '',
    "type"        => "media"
);


// Logo typography for link

$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo TEXT Link Options", 'zn_framework' ),
    "description" => __( "Specify the logo typography properties. Will only work if you don't upload a logo image.", 'zn_framework' ),
    "id"          => "logo_font",
    "std"         => array (
        'font-size'   => '36px',
        'font-family'   => 'Open Sans',
        'font-style'  => 'normal',
        'color'  => '#000',
        'line-height' => '40px'
    ),
    'supports'   => array( 'size', 'font', 'style', 'color', 'line', 'weight' ),
    "type"        => "font"
);

// Logo Hover Typography

$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo TEXT Link Hover Color", 'zn_framework' ),
    "description" => __( "Specify the logo hover color. Will only work if you don't upload a logo image. ", 'zn_framework' ),
    "id"          => "logo_hover",
    "std"         => array (
        'color' => '#CD2122',
        'font-family'  => 'Open Sans'
    ),
    'supports'   => array( 'font', 'color' ),
    "type"        => "font"
);



$desc = sprintf(
    '%s ( <a href="%s" target="_blank" title="%s">%s</a>).',
    __( 'These options below are related to logo\'s info card panel.', 'zn_framework' ),
    esc_url( 'http://hogash.d.pr/TiFZ' ),
    __( 'Click to open screenshot', 'zn_framework' ),
    __( 'Open screenshot', 'zn_framework' )
);
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( 'LOGO INFOCARD OPTIONS', 'zn_framework' ),
    "description" => $desc,
    "id"          => "info_title5",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// Show Info Card on Logo Hover
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Info Card when you hover over the logo", 'zn_framework' ),
    "description" => __( "Please choose if you want to display the info card or not.", 'zn_framework' ),
    "id"          => "infocard_display_status",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    ),
    "class"        => "zn_radio--yesno",
);

$saved_main_color = zget_option( 'zn_main_color', 'color_options', false, '#cd2122' );
// Background for the Info Card
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Set a background for the Info Card", 'zn_framework' ),
    "description" => __( "Choose the background color for the Info Card", 'zn_framework' ),
    "id"          => "infocard_bg_color",
    "std"         => $saved_main_color,
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);
// Text color for the Info Card
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Set a text color for the Info Card", 'zn_framework' ),
    "description" => __( "Choose the text color for the Info Card", 'zn_framework' ),
    "id"          => "infocard_text_color",
    "std"         => '#ffffff',
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);

// Info Card company logo
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Choose company logo", 'zn_framework' ),
    "description" => __( "Choose your company logo which will appear in info card", 'zn_framework' ),
    "id"          => "infocard_logo_url",
    "std"         => "",
    "type"        => "media",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);

// Info Card company description
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Company Description", 'zn_framework' ),
    "description" => __( "Please type a small description of your company", 'zn_framework' ),
    "id"          => "infocard_company_description",
    "std"         => "Kallyas is an ultra-premium, responsive theme built for today websites.",
    "type"        => "textarea",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);

// Info Card company description
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Company phone", 'zn_framework' ),
    "description" => __( "Please type your company phone number", 'zn_framework' ),
    "id"          => "infocard_company_phone",
    "std"         => __( "T (212) 555 55 00", 'zn_framework' ),
    "type"        => "text",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);

// Info Card company description
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Company email", 'zn_framework' ),
    "description" => __( "Please type your company email", 'zn_framework' ),
    "id"          => "infocard_company_email",
    "std"         => __( "sales@yourwebsite.com", 'zn_framework' ),
    "type"        => "text",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);

// Info Card company name
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Company name", 'zn_framework' ),
    "description" => __( "Type your company name here", 'zn_framework' ),
    "id"          => "infocard_company_name",
    "std"         => __( "Your Company LTD", 'zn_framework' ),
    "type"        => "text",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);

// Info Card company address
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Company address", 'zn_framework' ),
    "description" => __( "Type your company address here", 'zn_framework' ),
    "id"          => "infocard_company_address",
    "std"         => __( "Street nr 100, 4536534, Chicago, US", 'zn_framework' ),
    "type"        => "text",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);

// Info Card company name
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Company map link", 'zn_framework' ),
    "description" => __( "Please enter you company map link", 'zn_framework' ),
    "id"          => "infocard_gmap_link",
    "std"         => "http://goo.gl/maps/1OhOu",
    "type"        => "text",
    'dependency'  => array ( 'element' => 'infocard_display_status', 'value' => array ( 'yes' ) ),
);


$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "lgo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#m2dbZdeciZs', __( 'Click here to access video tutorial for LOGO OPTIONS.', 'zn_framework' ), array(
    'slug'        => 'logo_options',
    'parent'      => 'general_options'
));

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#TuXcJu9jl7c', __( 'Click here to access video tutorial for LOGO INFOCARD OPTIONS.', 'zn_framework' ), array(
    'slug'        => 'logo_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
));