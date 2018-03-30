<?php
/**
 * Theme options > General Options  > Footer options
 */
$desc = sprintf(
    '%s ( <a href="%s" target="_blank" title="%s">%s</a>).',
    __( 'These options below are related to site\'s footer.', 'zn_framework' ),
    esc_url( 'http://hogash.d.pr/10mXd' ),
    __( 'Click to open screenshot', 'zn_framework' ),
    __( 'Open screenshot', 'zn_framework' )
);
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( 'SITE FOOTER OPTIONS', 'zn_framework' ),
    "description" => $desc,
    "id"          => "info_title8",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);


/**
 * Check if Footer is replaced by Smart area and show a warning notice
 */
$footer_smart_area = zget_option( 'pbtmpl_general', 'pb_layouts', false, array(
    'footer_template' => 'no_template',
    'footer_location' => '',
    'subheader_template' => 'no_template',
    'subheader_location' => ''
));

if(!empty($footer_smart_area)) {
    if(isset($footer_smart_area['footer_location']) && $footer_smart_area['footer_location'] == 'replace'){
        $footer_warning_desc = sprintf(
            '%s <a href="%s" target="_blank">%s</a> %s <a href="%s" target="_blank">%s</a>.',
            __( 'The options below are not relevant as the Site footer is currently replaced with a Page Builder Smart-Area. To edit the Footer, go to', 'zn_framework' ),
            admin_url( 'admin.php?page=zn_tp_pb_layouts' ),
            __( 'Kallyas options > Smart Areas', 'zn_framework' ),
            __( 'to identify the area enabled, and then, to edit and customize it, go to', 'zn_framework' ),
            admin_url( 'edit.php?post_type=znpb_template_mngr' ),
            __( 'Page Builder Smart Areas', 'zn_framework' )
        );
        $admin_options[] = array (
            'slug'        => 'footer_options',
            'parent'      => 'general_options',
            "name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
            "description" => $footer_warning_desc,
            'type'  => 'zn_message',
            'id'    => 'zn_error_notice',
            'show_blank'  => 'true',
            'supports'  => 'warning'
        );
    }
}


// Show Footer
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Footer", 'zn_framework' ),
    "description" => __( "Using this option you can choose to display the footer or not.", 'zn_framework' ),
    "id"          => "footer_show",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    ),
    "class"        => "zn_radio--yesno",
);

$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( 'Footer Rows Setup', 'zn_framework' ),
    "description" => __( 'These settings below will configure the 2 rows included in the footer.', 'zn_framework' ),
    "id"          => "footer_title3",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// Show Footer ROW 1
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Row 1 widgets ?", 'zn_framework' ),
    "description" => __( "Select yes if you want to show the first row of widgets.", 'zn_framework' ),
    "id"          => "footer_row1_show",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    ),
    "class"        => "zn_radio--yesno",
);

$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"              => __( "Footer Row 1 Widget positions", 'zn_framework' ),
    "description"       => __( "Here you can select how your footer row 1 widgets will be displayed. You can select to
		                            use up to 4 widgets positions in various sizes.", 'zn_framework' ),
    "id"                => "footer_row1_widget_positions",
    "std"               => '{"3":[["4","4","4"]]}',
    "type"              => "widget_positions",
    "number_of_columns" => "4",
    'dependency'  => array ( 'element' => 'footer_row1_show', 'value' => array ( 'yes' ) ),
    "columns_positions" => array (
        "1" => array (
            array ("12")
        ),
        "2" => array (
            array ("6","6")
        ),
        "3" => array (
            array ("4","4","4"),
            array ("5","4","3"),
            array ("5","3","4"),
            array ("4","5","3"),
            array ("4","3","5"),
            array ("3","4","5"),
            array ("3","5","4")
        ),
        "4" => array (
            array ("3","3","3","3"),
            array ("5","4","2","1")
        )
    )
);

// Show Footer ROW 2
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Row 2 widgets ?", 'zn_framework' ),
    "description" => __( "Select yes if you want to show the second row of widgets.", 'zn_framework' ),
    "id"          => "footer_row2_show",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    ),
    "class"        => "zn_radio--yesno",
);

$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"              => __( "Footer Row 2 Widget positions", 'zn_framework' ),
    "description"       => __( "Here you can select how your footer row 2 widgets will be displayed. You can select to
		 use up to 4 widgets positions in various sizes.", 'zn_framework' ),
    "id"                => "footer_row2_widget_positions",
    "std"               => '{"2":[["6","6"]]}',
    "type"              => "widget_positions",
    "number_of_columns" => "4",
    'dependency'  => array ( 'element' => 'footer_row2_show', 'value' => array ( 'yes' ) ),
    "columns_positions" => array (
        "1" => array (
            array ("12")
        ),
        "2" => array (
            array ("6","6")
        ),
        "3" => array (
            array ("4","4","4"),
            array ("5","4","3"),
            array ("5","3","4"),
            array ("4","5","3"),
            array ("4","3","5"),
            array ("3","4","5"),
            array ("3","5","4")
        ),
        "4" => array (
            array ("3","3","3","3"),
            array ("5","4","2","1")
        )
    )
);

$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( 'Footer Styles Options', 'zn_framework' ),
    "description" => __( 'These settings below are for the footer\'s styles.', 'zn_framework' ),
    "id"          => "footer_title2",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// FOOTER STYLE
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Style", 'zn_framework' ),
    "description" => __( "Select the desired style for the footer", 'zn_framework' ),
    "id"          => "footer_style",
    "std"         => "default",
    "type"        => "zn_radio",
    "options"     => array (
        'default'     => __( "Default", 'zn_framework' ),
        'image_color' => __( 'Background Image & color', 'zn_framework' ),
    ),
);

// FOOTER IMAGE
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Background Image", 'zn_framework' ),
    "description" => __( "Please choose your desired image to be used as a background", 'zn_framework' ),
    "id"          => "footer_style_image",
    "std"         => '',
    "options"     => array ( "repeat" => true, "position" => true, "attachment" => true ),
    "type"        => "background",
    'dependency'  => array ( 'element' => 'footer_style', 'value' => array ( 'image_color' ) ),
);

// FOOTER BG Color
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Background Color", 'zn_framework' ),
    "description" => __( "Please choose your desired background color for the footer", 'zn_framework' ),
    "id"          => "footer_style_color",
    "std"         => '#000',
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'footer_style', 'value' => array ( 'image_color' ) ),
);

// FOOTER Top Border Color
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Footer's Top Border Color", 'zn_framework' ),
    "description" => __( "Please choose your desired color for the footer top border-color. To hide it, try matching the background color of the footer or just add some custom css into advanced settings.", 'zn_framework' ),
    "id"          => "footer_border_color_top",
    "std"         => '#FFFFFF',
    "alpha"         => true,
    "type"        => "colorpicker"
);

// FOOTER Bottom Border Color
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Bottom Footer's Border Color", 'zn_framework' ),
    "description" => __( "Please choose your desired color for the bottom-footer area's border. To hide it, try matching the background color of the footer or just add some custom css into advanced settings.", 'zn_framework' ),
    "id"          => "footer_border_color",
    "std"         => '#484848',
    "type"        => "colorpicker"
);

// FOOTER Top Padding
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Footer's Top Padding (px)", 'zn_framework' ),
    "description" => __( "Please add the top padding (px) for the footer. ", 'zn_framework' ),
    "id"          => "footer_top_padding",
    "std"         => '60',
    "type"        => "text",
    "class"         => "zn_input_xs"
);

$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( 'Bottom Footer Options', 'zn_framework' ),
    "description" => __( 'These settings below are for the bottom non-widget part of the site\'s footer.', 'zn_framework' ),
    "id"          => "footer_title1",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Copyright Logo image", 'zn_framework' ),
    "description" => __( "Upload your desired logo image that will appear on the left side of the copyright
        text.", 'zn_framework' ),
    "id"          => "footer_logo",
    "std"         => '',
    "type"        => "media"
);

$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Copyright text", 'zn_framework' ),
    "description" => __( "Enter your desired copyright text. Please note that you can copy ' &copy; ' and place it in the text.", 'zn_framework' ),
    "id"          => "copyright_text",
    "std"         => __( "&copy; 2015. All rights reserved. Buy <a href=\"http://themeforest.net/item/kallyas-responsive-multipurpose-wordpress-theme/4091658/\">Kallyas Theme</a>.", 'zn_framework' ),
    "type"        => "textarea"
);


// Show/Hide Social Icons in footer
$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Show or hide the Social icons in the footer.", 'zn_framework' ),
    "description" => __( "Display the social icons list in footer?.", 'zn_framework' ),
    "id"          => "footer_social_icons_enable",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    ),
    "class"        => "zn_radio--yesno",
);

$admin_options[]         = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Use normal or colored social icons?", 'zn_framework' ),
    "description" => __( "Here you can choose to use the normal social icons or the colored version of each icon.", 'zn_framework' ),
    "id"          => "footer_which_icons_set",
    "std"         => "",
    "type"        => "select",
    "options"     => array (
        'normal'  => __( 'Normal Icons', 'zn_framework' ),
        'colored' => __( 'Colored icons', 'zn_framework' ),
        'colored_hov' => __( 'Colored on Hover icons', 'zn_framework' ),
        'clean' => __( 'Clean icons', 'zn_framework' )
    ),
    "class"       => ""
);


$admin_options[]         = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( "Social Icons", 'zn_framework' ),
    "description" => __( "Here you can configure what social icons to appear on the right side of the copyright
		text.", 'zn_framework' ),
    "id"          => "footer_social_icons",
    "std"         => "",
    "type"        => "group",
    "element_title"    => "footer_social_title",
    "add_text"    => __( "Social Icon", 'zn_framework' ),
    "remove_text" => __( "Social Icon", 'zn_framework' ),
    "subelements" => array (
        array (
            "name"        => __( "Icon title", 'zn_framework' ),
            "description" => __( "Here you can enter a title for this social icon.Please note that this is just
				for your information as this text will not be visible on the site.", 'zn_framework' ),
            "id"          => "footer_social_title",
            "std"         => "",
            "type"        => "text"
        ),
        array (
            "name"        => __( "Social icon link", 'zn_framework' ),
            "description" => __( "Please enter your desired link for the social icon. If this field is left
				blank, the icon will not be linked.", 'zn_framework' ),
            "id"          => "footer_social_link",
            "std"         => "",
            "type"        => "link",
            "options"     => array (
                '_blank' => __( "New window", 'zn_framework' ),
                '_self'  => __( "Same window", 'zn_framework' ),
            )
        ),
        array (
            "name"        => __( "Social icon Background color", 'zn_framework' ),
            "description" => __( "Select a background color for the icon (if you selected <strong>Colored</strong> or <strong>Colored on hover</strong> options)", 'zn_framework' ),
            "id"          => "footer_social_color",
            "std"         => "#000",
            "type"        => "colorpicker"
        ),
        array (
            "name"        => __( "Social icon", 'zn_framework' ),
            "description" => __( "Select your desired social icon.", 'zn_framework' ),
            "id"          => "footer_social_icon",
            "std"         => "",
            "type"        => "icon_list",
            'class'       => 'zn_full'
        )
    ),
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "fto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#-jvG4qzNbBY', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'footer_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
));
