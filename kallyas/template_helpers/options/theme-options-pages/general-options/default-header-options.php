<?php
/**
 * Theme options > General Options  > Default Header Options
 */
$desc = sprintf(
    '%s ( <a href="%s" target="_blank" title="%s">%s</a>).',
    __( 'These options below are related to site\'s default sub-header block.', 'zn_framework' ),
    esc_url( 'http://hogash.d.pr/14aJa' ),
    __( 'Click to open screenshot', 'zn_framework' ),
    __( 'Open screenshot', 'zn_framework' )
);
$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( 'DEFAULT SUB-HEADER OPTIONS', 'zn_framework' ),
    "description" => $desc,
    "id"          => "info_title9",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);


$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Hide page subheader?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to hide the page subheader ( including sliders ). Please note that this option can be overridden from each page/post", 'zn_framework' ),
    "id"          => "zn_disable_subheader",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "zn_radio",
    "class"        => "zn_radio--yesno",
);

$admin_options[] = array (
                'slug'        => 'default_header_options',
                'parent'      => 'general_options',
                "name"        => __( 'Background options', 'zn_framework' ),
                "description" => __( 'These options are applied to the background of the subheader.', 'zn_framework' ),
                "id"          => "hd_title1",
                "type"        => "zn_title",
                "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// Header background image
$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Sub-Header Background image", 'zn_framework' ),
    "description" => __( "Upload your desired background image for the header.", 'zn_framework' ),
    "id"          => "def_header_background",
    "std"         => '',
    "type"        => "media"
);

// Header background color
$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Sub-Header Background Color", 'zn_framework' ),
    "description" => __( "Here you can choose a default color for your header.If you do not select a background image, this color will be used as background.", 'zn_framework' ),
    "id"          => "def_header_color",
    "std"         => '#AAAAAA',
    'alpha'       => true,
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Add gradient over color?", 'zn_framework' ),
    "description" => __( "Select yes if you want add a gradient over the selected color", 'zn_framework' ),
    "id"          => "def_grad_bg",
    "std"         => "1",
    "type"        => "zn_radio",
    "options"     => array (
        "1" => __( "Yes", 'zn_framework' ),
        "0" => __( "No", 'zn_framework' ),
    ),
    "class"        => "zn_radio--yesno",
);

// HEADER - Animate

$admin_options[]    = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Use animated header", 'zn_framework' ),
    "description" => __( "Select if you want to add an animation on top of your image/color.", 'zn_framework' ),
    "id"          => "def_header_animate",
    "std"         => "0",
    "type"        => "zn_radio",
    "options"     => array (
        '1' => __('Yes', 'zn_framework'),
        '0' => __('No', 'zn_framework'),
    ),
    "class"        => "zn_radio--yesno",
);

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Add Glare effect?", 'zn_framework' ),
    "description" => __( "Select yes if you want to add a glare effect over the background", 'zn_framework' ),
    "id"          => "def_glare",
    "std"         => "0",
    "type"        => "zn_radio",
    "options"     => array (
        "1" => __( "Yes", 'zn_framework' ),
        "0" => __( "No", 'zn_framework' )
    ),
    "class"        => "zn_radio--yesno",
);

// $admin_options[] = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     "name"        => __( "Bottom style?", 'zn_framework' ),
//     "description" => __( "Select the sub-header bottom style you want to use", 'zn_framework' ),
//     "id"          => "def_bottom_style",
//     "std"         => "none",
//     "type"        => "select",
//     "options"     => array (
//         "none"      => __( "None", 'zn_framework' ),
//         "shadow"    => __( "Shadow Up", 'zn_framework' ),
//         "shadow_ud" => __( "Shadow Up and down", 'zn_framework' ),
//         "mask1"     => __( "Bottom mask 1", 'zn_framework' ),
//         "mask2"     => __( "Bottom mask 2", 'zn_framework' )
//     )
// );

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Bottom mask", 'zn_framework' ),
    "description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
    "id"          => "def_bottom_style",
    "std"         => "none",
    "type"        => "select",
    "options"     => array (
        'none' => __( 'None', 'zn_framework' ),
        'shadow' => __( 'Shadow Up', 'zn_framework' ),
        'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
        'mask1' => __( 'Raster Mask 1 (Old, not recommended)', 'zn_framework' ),
        'mask2' => __( 'Raster Mask 2 (Old, not recommended)', 'zn_framework' ),
        'mask3' => __( 'Vector Mask 3 CENTER (New! From v4.0)', 'zn_framework' ),
        'mask3 mask3l' => __( 'Vector Mask 3 LEFT (New! From v4.0)', 'zn_framework' ),
        'mask3 mask3r' => __( 'Vector Mask 3 RIGHT (New! From v4.0)', 'zn_framework' ),
        'mask4' => __( 'Vector Mask 4 CENTER (New! From v4.0)', 'zn_framework' ),
        'mask4 mask4l' => __( 'Vector Mask 4 LEFT (New! From v4.0)', 'zn_framework' ),
        'mask4 mask4r' => __( 'Vector Mask 4 RIGHT (New! From v4.0)', 'zn_framework' ),
        'mask5' => __( 'Vector Mask 5 (New! From v4.0)', 'zn_framework' ),
        'mask6' => __( 'Vector Mask 6 (New! From v4.0)', 'zn_framework' ),
    ),
);

$admin_options[] = array (
                'slug'        => 'default_header_options',
                'parent'      => 'general_options',
                "name"        => __( 'Components options', 'zn_framework' ),
                "description" => __( 'These options are applied to the contents of the subheader.', 'zn_framework' ),
                "id"          => "hd_title1",
                "type"        => "zn_title",
                "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// HEADER show breadcrumbs
$admin_options[]     = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Breadcrumbs", 'zn_framework' ),
    "description" => __( "Select if you want to show the breadcrumbs or not.", 'zn_framework' ),
    "id"          => "def_header_bread",
    "std"         => "",
    "type"        => "zn_radio",
    "options"     => array (
        '1' => __( 'Show', 'zn_framework' ),
        '0' => __( 'Hide', 'zn_framework' ),
    ),
    "class"        => "zn_radio--yesno",
);
$admin_options[]     = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Breadcrumbs style", 'zn_framework' ),
    "description" => __( "Select Breadcrumbs style.", 'zn_framework' ),
    "id"          => "def_subh_bread_stl",
    "std"         => "black",
    "type"        => "select",
    "options"     => array (
        'black' => __( 'Black Bar', 'zn_framework' ),
        'minimal' => __( 'Minimal', 'zn_framework' ),
    ),
    "dependency"  => array(
        'element' => 'def_header_bread' ,
        'value'=> array('1')
    ),
);

// HEADER show date

$admin_options[]    = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Date", 'zn_framework' ),
    "description" => __( "Select if you want to show the current date under breadcrumbs or not.", 'zn_framework' ),
    "id"          => "def_header_date",
    "std"         => "",
    "type"        => "zn_radio",
    "options"     => array (
        '1' => 'Show',
        '0' => 'Hide'
    ),
    "class"        => "zn_radio--yesno",
);

// HEADER show title

$admin_options[]     = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Page Title", 'zn_framework' ),
    "description" => __( "Select if you want to show the page title or not.", 'zn_framework' ),
    "id"          => "def_header_title",
    "std"         => "",
    "type"        => "zn_radio",
    "options"     => array (
        '1' => __( 'Show', 'zn_framework' ),
        '0' => __( 'Hide', 'zn_framework' ),
    ),
    "class"        => "zn_radio--yesno",
);

// HEADER show subtitle

$admin_options[]        = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Page Subtitle", 'zn_framework' ),
    "description" => __( "Select if you want to show the page subtitle or not.", 'zn_framework' ),
    "id"          => "def_header_subtitle",
    "std"         => "",
    "type"        => "zn_radio",
    "options"     => array (
        '1' => __( 'Show', 'zn_framework' ),
        '0' => __( 'Hide', 'zn_framework' ),
    ),
    "class"        => "zn_radio--yesno",
);

$admin_options[]        = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Title & Subtitle text alignment", 'zn_framework' ),
    "description" => __( "If you have disabled both Breadcrumbs & Date, you can choose to custom align the title and subtitle in subheader. You can override this setting in the Custom Subheader Element.", 'zn_framework' ),
    "id"          => "def_subheader_alignment",
    "std"         => "right",
    "type"        => "select",
    "options"     => array (
        'left' => __( 'Left', 'zn_framework' ),
        'center' => __( 'Center', 'zn_framework' ),
        'right' => __( 'Right', 'zn_framework' ),
    ),
    "dependency"  => array(
        array(
            'element' => 'def_header_bread' ,
            'value'=> array('0')
        ),
        array(
            'element' => 'def_header_date' ,
            'value'=> array('0')
        ),
    ),
);

$admin_options[]     = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Text Color Scheme", 'zn_framework' ),
    "description" => __( "Select the text color scheme.", 'zn_framework' ),
    "id"          => "def_subh_textcolor",
    "std"         => "light",
    "type"        => "select",
    "options"     => array (
        'light' => __( 'Light', 'zn_framework' ),
        'dark' => __( 'Dark', 'zn_framework' ),
    )
);

$admin_options[] = array (
                'slug'        => 'default_header_options',
                'parent'      => 'general_options',
                "name"        => __( 'Height / Padding options', 'zn_framework' ),
                "description" => __( 'These options are applied to the height and top padding of the subheader.', 'zn_framework' ),
                "id"          => "hd_title1",
                "type"        => "zn_title",
                "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// HEADER Custom height
//@since 3.6.9
//@k
// @4.0.7 Upgraded to slider field
$admin_options[]        = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Default Sub-Header Height", 'zn_framework' ),
    "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
    "id"          => "def_header_custom_height",
    "std"         => "300",
    "type" => "slider",
    'class'       => 'zn_full',
    'helpers'     => array(
        'min' => '1',
        'max' => '1280',
        'step' => '1'
    )
);
$admin_options[]        = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    'id'          => 'def_header_top_padding',
    'name'        => 'Top padding',
    'description' => 'Select the top padding ( in pixels ) for this Subheader.',
    'type'        => 'slider',
    'std'         => '170',
    'class'       => 'zn_full',
    'helpers'     => array(
        'min' => '30',
        'max' => '500',
        'step' => '1'
    )
);


$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "dfho_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#1olr-Oy_RD0', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'default_header_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
));
