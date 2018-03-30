<?php
/**
 * Theme options > General Options  > Header options
 */
$desc = sprintf(
	'%s ( <a href="%s" target="_blank" title="%s">%s</a>).',
	__( 'These options below are related to site\'s header', 'zn_framework' ),
	esc_url( 'http://hogash.d.pr/1cv3m' ),
	__( 'Click to open screenshot', 'zn_framework' ),
	__( 'Open screenshot', 'zn_framework' )
);
$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( 'HEADER OPTIONS', 'zn_framework' ),
	"description" => $desc,
	"id"          => "info_title2",
	"type"        => "zn_title",
	"class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);


$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Header Layout", 'zn_framework' ),
	"description" => __( "Please choose the desired header layout.", 'zn_framework' ),
	"id"          => "zn_header_layout",
	"std"         => "style2",
	"type"        => "radio_image",
	"class"       => "zn_full ri-hover-line ri-5 ri-maxover",
	"options"     => array(
		array(
			'value' => 'style1',
			'name'  => __( 'Style 1.1 (#1)', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style1.svg'
		),
		array(
			'value' => 'style2',
			'name'  => __( 'Style 1.2 (#2)', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style2.svg'
		),
		array(
			'value' => 'style3',
			'name'  => __( 'Style 1.3 (#3)', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style3.svg'
		),
		array(
			'value' => 'style4',
			'name'  => __( 'Style 1.4 (#4)', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style4.svg'
		),
		array(
			'value' => 'style5',
			'name'  => __( 'Style 1.5 (#5)', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style5.svg'
		),
		array(
			'value' => 'style6',
			'name'  => __( 'Style 1.6 (#6)', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style6.svg'
		),
		array(
			'value' => 'style7',
			'name'  => __( 'Style 7', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style7.svg'
		),
		array(
			'value' => 'style8',
			'name'  => __( 'Style 8', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style8.svg'
		),
		array(
			'value' => 'style9',
			'name'  => __( 'Style 9', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style9.svg'
		),
		array(
			'value' => 'style10',
			'name'  => __( 'Style 10', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style10.svg'
		),
		array(
			'value' => 'style11',
			'name'  => __( 'Style 11', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style11.png'
		),
		array(
			'value' => 'style12',
			'name'  => __( 'Style 12', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style12.png'
		),
		array(
			'value' => 'style13',
			'name'  => __( 'Style 13 (11.1)', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-styles/style13.png'
		),
	)
);


$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Header state on page scroll", 'zn_framework' ),
	"description" => __( "The scrolling menu will only display a simple cloned main navigation, upon scrolling.<br> The Sticky header, upon scrolling, will fix the entire menu to top even when scrolling to the bottom.", 'zn_framework' ),
	"id"          => "menu_follow",
	"std"         => 'no',
	"options"     => array(
		array(
			'value' => 'yes',
			'name'  => __( 'Scrolling Menu (a.k.a. Chaser / Follow menu)', 'zn_framework' ),
			'desc'  => __( 'Upon scrolling, will display a bar aligned at the top of the website displaying the main menu.', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/scrolling-menu-1.gif',
		),
		array(
			'value' => 'sticky',
			'name'  => __( 'Sticky Header', 'zn_framework' ),
			'desc'  => __( 'The entire site-header will be fixed to the top of the website when scrolling, and in some cases, resized.', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/scrolling-menu-2.gif',
		),
		array(
			'value' => 'fixed',
			'name'  => __( 'Fixed Header', 'zn_framework' ),
			'desc'  => __( 'The entire site-header will be fixed to the top of the website when scrolling without resizing itself.', 'zn_framework' ),
			// 'image' => THEME_BASE_URI .'/images/admin/various-theme-options/scrolling-menu-2.gif',
		),
		array(
			'value' => 'no',
			'name'  => __( 'No.', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/scrolling-menu-3.gif',
		),
	),
	"type"        => "smart_select"
);




// ==================================================================
//        LANGUAGE SELECTOR
// ==================================================================

$admin_options[] = array (
				'slug'        => 'header_options',
				'parent'      => 'general_options',
				"name"        => __( 'Language selector options', 'zn_framework' ),
				"description" => __( 'These options are dedicated to the language selector in header.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Show WPML languages ?", 'zn_framework' ),
	"description" => __( "Choose yes if you want to show WPML languages in header. Please note that you will
		need WPML installed.", 'zn_framework' ),
	"id"          => "head_show_flags",
	"std"         => "1",
	"type"        => "zn_radio",
	"options"     => array (
		"1" => __( "Show", 'zn_framework' ),
		"0" => __( "Hide", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Language selector style", 'zn_framework' ),
	"description" => __( "Choose the style of the multi-language selector box.", 'zn_framework' ),
	"id"          => "head_flags_style",
	"std"         => "",
	"options"     => array(
		array(
			'value' => '',
			'name'  => __( 'Inherit', 'zn_framework' ),
			'desc'  => __( 'Will inherit from header\'s layout.', 'zn_framework' ),
		),
		array(
			'value' => 'def',
			'name'  => __( 'Default', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/smart_select/languages/languages_default.png'
		),
		array(
			'value' => 'alt',
			'name'  => __( 'Alternative', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/smart_select/languages/languages_alternative.png'
		),
		array(
			'value' => 'flags',
			'name'  => __( 'Just flags', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/smart_select/languages/languages_flags.png'
		),
	),
	"type"        => "smart_select",
	// "class"        => "zn-smartselect--md",
	"dependency"  => array( 'element' => 'head_show_flags' , 'value'=> array('1') ),
);

// ==================================================================
//        LOGIN / REGISTER
// ==================================================================

$admin_options[] = array (
				'slug'        => 'header_options',
				'parent'      => 'general_options',
				"name"        => __( 'Login button & panel options', 'zn_framework' ),
				"description" => __( 'These options are dedicated to the login button link in the header, but also Login/Register/Forgot password popup forms.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// Show LINK to LOGIN
$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( 'Show "Login" link in Header', 'zn_framework' ),
	"description" => __( "Choose yes if you want to show a link that will let users login/register or retrieve their lost password. Please note that in order to show the registration page, you need to allow user registration from General settings. <br> You can select the 3rd option, to hide the button, but enable the modal window to load. For example in case you want to link the hidden login panel from elsewhere (Main menu or Call to action).", 'zn_framework' ),
	"id"          => "head_show_login",
	"std"         => "1",
	"type"        => "zn_radio",
	"options"     => array (
		"1" => __( "Show", 'zn_framework' ),
		"0" => __( "Hide", 'zn_framework' ),
		"2" => __( "Hide Button, but load Login Modal (Hidden)", 'zn_framework' ),
	),
	"class"        => "zn_radio--yesno",
);

// Show LINK to LOGIN
$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( 'Show "Register / Sign up" link in Header', 'zn_framework' ),
	"description" => __( "Choose yes if you want to show a link that will let users login/register or retrieve their lost password. Please note that in order to show the registration page, you need to allow user registration from General settings. <br> You can select the 3rd option, to hide the button, but enable the modal window to load. For example in case you want to link the hidden register panel from elsewhere (Main menu or Call to action).", 'zn_framework' ),
	"id"          => "head_show_register",
	"std"         => "2",
	"type"        => "zn_radio",
	"options"     => array (
		"1" => __( "Show", 'zn_framework' ),
		"0" => __( "Hide", 'zn_framework' ),
		"2" => __( "Hide Button, but load Register Modal (Hidden)", 'zn_framework' ),
	),
	"class"        => "zn_radio--yesno",
);

// ==================================================================
//        SEARCH BOX
// ==================================================================

$admin_options[] = array (
				'slug'        => 'header_options',
				'parent'      => 'general_options',
				"name"        => __( 'Search Box in Header', 'zn_framework' ),
				"description" => __( 'These options are dedicated to the search box in header.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// Show SEARCH In header
$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Show SEARCH in header", 'zn_framework' ),
	"description" => __( "Please choose if you want to display the search button or not.", 'zn_framework' ),
	"id"          => "head_show_search",
	"std"         => "yes",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Show", 'zn_framework' ),
		"no"  => __( "Hide", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);
$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Search Box style", 'zn_framework' ),
	"description" => __( "Choose the style of the search box component in header.", 'zn_framework' ),
	"id"          => "head_search_style",
	"std"         => "",
	"options"     => array(
		array(
			'value' => '',
			'name'  => __( 'Inherit', 'zn_framework' ),
			'desc'  => __( 'Will inherit from header\'s layout.', 'zn_framework' ),
		),
		array(
			'value' => 'def',
			'name'  => __( 'Compact', 'zn_framework' ),
			'desc'  => __( 'Click-to-open button', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/searchbox-compact.gif'
		),
		array(
			'value' => 'inp',
			'name'  => __( 'Input Layout', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/searchbox-input.gif'
		),
		array(
			'value' => 'bord',
			'name'  => __( 'Bottom Bordered Minimal', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/searchbox-bottom-bordered-minimal.gif'
		),
		array(
			'value' => 'min',
			'name'  => __( 'Minimal', 'zn_framework' ),
			'desc'  => __( 'Loupe Icon that will expand the search field.', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/searchbox-minimal-loupe-icon.gif'
		),
	),
	"type"        => "smart_select",
	"dependency"  => array( 'element' => 'head_show_search' , 'value'=> array('yes') ),
);

// ==================================================================
//        CUSTOM TEXT IN HEADER
// ==================================================================

$admin_options[] = array (
				'slug'        => 'header_options',
				'parent'      => 'general_options',
				"name"        => __( 'Custom Text in Header', 'zn_framework' ),
				"description" => __( 'These options are dedicated to the header text in header. Please know that this text is only available for certain types of Header layouts', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator",

);

// Header custom text
$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Top header text", 'zn_framework' ),
	"description" => __( "Will display any text (ex: phone number).", 'zn_framework' ),
	"id"          => "zn_head_s7_toptext",
	"std"         => "",
	"type"        => "text",
	"class"        => 'zn_input_xl'
);


// ==================================================================
//        HIDDEN PANEL
// ==================================================================
$description_string = sprintf(
	'<span class="dashicons dashicons-warning"></span> <strong>%s</strong><br> %s <a href="%s">%s</a> %s ( <a href="%s" target="_blank">%s</a> ).',
	__( 'To add content in the "Support" - Hidden panel, follow these steps:', 'zn_framework' ),
	__( 'Go to', 'zn_framework' ),
	admin_url( 'widgets.php' ),
	__( 'Appearance > Widgets', 'zn_framework' ),
	__( 'and inside the widgets position called "Hidden panel sidebar", make sure it has the Text widget inside, or add a new Text Widget', 'zn_framework' ),
	esc_url( 'http://hogash.d.pr/ypNB' ),
	__( 'screenshot', 'zn_framework' )
);
$admin_options[] = array (
				'slug'        => 'header_options',
				'parent'      => 'general_options',
				"name"        => __( 'Hidden Panel options ( "SUPPORT" button )', 'zn_framework' ),
				"description" => $description_string,
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator",
);

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Show SUPPORT panel in header", 'zn_framework' ),
	"description" => __( "Please choose if you want to display the call to action button or not.<br> If you want to open the panel through the main menu, choose <strong>'Load panel (closed), but Hide Button'</strong> and add the class <code>show-top-hidden-panel</code> to the menu item you want.", 'zn_framework' ),
	"id"          => "head_show_support_pnl",
	"std"         => "yes",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Show", 'zn_framework' ),
		"no"  => __( "Hide", 'zn_framework' ),
		"load"   => __( "Load panel (closed), but Hide Button", 'zn_framework' ),
	),
	"class"        => "zn_radio--yesno",
);

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Support content type", 'zn_framework' ),
	"description" => __( "Select what type of content you want to show in the hidden panel.", 'zn_framework' ),
	"id"          => "hidden_panel_content_type",
	"std"         => '',
	"type"        => "select",
	"options"     => array(
		'widget' => __( "Widget area ( Hidden Panel Sidebar )", 'zn_framework' ),
		'pb_template' => __( "Pagebuilder Smart Area", 'zn_framework' ),
	),
	'dependency'  => array ( 'element' => 'head_show_support_pnl', 'value' => array ( 'yes', 'load' ) ),
);


$pb_templates_options = array('' => '-- Select a smart area --');
$all_pb_templates = get_posts( array (
	'post_type'      => 'znpb_template_mngr',
	'posts_per_page' => - 1,
	'post_status'    => 'publish',
) );

foreach ($all_pb_templates as $key => $value) {
	$pb_templates_options[$value->ID] = $value->post_title;
}

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	'id'          => 'hidden_panel_pb_template',
	'name'        => __( 'Select Pagebuilder Smart Area','zn_framework'),
	'description' => __( 'Using this option you can select a pre-built template made at Admin > Pagebuilder Smart Areas page.','zn_framework'),
	'type'        => 'select',
	'options'   => $pb_templates_options,
	'dependency'  => array (
		array(
			'element' => 'head_show_support_pnl',
			'value' => array ( 'yes', 'load' )
		),
		array(
			'element' => 'hidden_panel_content_type',
			'value' => array ( 'pb_template' )
		),
	),
);

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Support button text", 'zn_framework' ),
	"description" => __( "Enter the desired button text that will appear for the support button in header. If left blank, the Support word will be displayed.", 'zn_framework' ),
	"id"          => "hidden_panel_title",
	"std"         => '',
	"type"        => "text",
	'dependency'  => array ( 'element' => 'head_show_support_pnl', 'value' => array ( 'yes' ) ),
);

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Select background color", 'zn_framework' ),
	"description" => __( "Select background color for the hidden panel.", 'zn_framework' ),
	"id"          => "hidden_panel_bg",
	"std"         => '#F0F0F0',
	"type"        => "colorpicker",
	'dependency'  => array ( 'element' => 'head_show_support_pnl', 'value' => array ( 'yes', 'load' ) ),
);

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Select font color", 'zn_framework' ),
	"description" => __( "Select font color for the hidden panel.", 'zn_framework' ),
	"id"          => "hidden_panel_fg",
	"std"         => '#000000',
	"type"        => "colorpicker",
	'dependency'  => array ( 'element' => 'head_show_support_pnl', 'value' => array ( 'yes', 'load' ) ),
);

// ==================================================================
//        SOCIAL ICONS
// ==================================================================

$admin_options[] = array (
				'slug'        => 'header_options',
				'parent'      => 'general_options',
				"name"        => __( 'Social Icons in Header', 'zn_framework' ),
				"description" => __( 'These options are dedicated to the social icons group in header.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);


// Show/Hide Social Icons in header
$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Show or hide the Social icons in the header.", 'zn_framework' ),
	"description" => __( "Please select the visibility status of the Social Icons(this setting will not affect
		the visibility of Social Icons from the info Card)", 'zn_framework' ),
	"id"          => "social_icons_visibility_status",
	"std"         => "yes",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Show", 'zn_framework' ),
		"no"  => __( "Hide", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);

$admin_options[]         = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Use normal or colored social icons?", 'zn_framework' ),
	"description" => __( "Here you can choose to use the normal social icons or the colored version of each
		icon.", 'zn_framework' ),
	"id"          => "header_which_icons_set",
	"std"         => "",
	"options"     => array(
		array(
			'value' => 'normal',
			'name'  => __( 'Normal Icons', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-social-icons/normal.png',
		),
		array(
			'value' => 'colored',
			'name'  => __( 'Colored icons', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-social-icons/colored.png',
		),
		array(
			'value' => 'colored_hov',
			'name'  => __( 'Colored on Hover icons', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-social-icons/colored_hov.png',
		),
		array(
			'value' => 'clean',
			'name'  => __( 'Clean icons', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/header-social-icons/clean.png',
		),
	),
	"type"        => "smart_select",
	'dependency'  => array ( 'element' => 'social_icons_visibility_status', 'value' => array ( 'yes' ) ),
);

$admin_options[]         = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Social Icons", 'zn_framework' ),
	"description" => __( "Here you can configure what social icons to appear on the right side of the header.", 'zn_framework' ),
	"id"          => "header_social_icons",
	"std"         => "",
	"type"        => "group",
	"element_title"    => "header_social_title",
	"add_text"    => __( "Social Icon", 'zn_framework' ),
	"remove_text" => __( "Social Icon", 'zn_framework' ),
	'dependency'  => array ( 'element' => 'social_icons_visibility_status', 'value' => array ( 'yes' ) ),
	"subelements" => array (
		array (
			"name"        => __( "Icon title", 'zn_framework' ),
			"description" => __( "Here you can enter a title for this social icon.Please note that this is just
				for your information as this text will not be visible on the site.", 'zn_framework' ),
			"id"          => "header_social_title",
			"std"         => "",
			"type"        => "text"
		),
		array (
			"name"        => __( "Social icon link", 'zn_framework' ),
			"description" => __( "Please enter your desired link for the social icon. If this field is left
				blank, the icon will not be linked.", 'zn_framework' ),
			"id"          => "header_social_link",
			"std"         => "",
			"type"        => "link",
			"options"     => array (
				'_blank' => __( "New window", 'zn_framework' ),
				'_self'  => __( "Same window", 'zn_framework' )
			)
		),
		array (
			"name"        => __( "Social icon Background color", 'zn_framework' ),
			"description" => __( "Select a background color for the icon (if you selected <strong>Colored</strong> or <strong>Colored on hover</strong> options)", 'zn_framework' ),
			"id"          => "header_social_color",
			"std"         => "#000",
			"type"        => "colorpicker"
		),
		array (
			"name"        => __( "Social icon", 'zn_framework' ),
			"description" => __( "Select your desired social icon.", 'zn_framework' ),
			"id"          => "header_social_icon",
			"std"         => "",
			"type"        => "icon_list",
			'class'       => 'zn_full'
		)
	),
	"class"       => ""
);

$admin_options[] = array (
				'slug'        => 'header_options',
				'parent'      => 'general_options',
				"name"        => __( 'Settings for mobiles (small viewport)', 'zn_framework' ),
				"description" => __( 'These options are applied to the header on mobiles.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( "Header Background Color on Mobiles", 'zn_framework' ),
	"description" => __( "This will change the existing <strong>background color</strong> on Mobile devices, more exactly for device width less than 480px.", 'zn_framework' ),
	"id"          => "zn_header_resp_color",
	"std"         => zget_option( 'zn_header_resp_color', 'color_options',  false, '' ),
	"type"        => "colorpicker"
);

$admin_options[] = array(
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	'id'          => 'header_components_mobile',
	'name'        => 'HIDE Header Components on Mobile',
	'description' => 'Select which components from the header you want to hide on mobiles or better said, viewports of maximum 767px (smartphones).',
	'type'        => 'checkbox',
	'options'     => array(
			'header-search' => 'Search Box',
			'topnav--lang' => 'Language selector',
			'topnav--log' => 'Login button',
			'topnav--reg' => 'Register button',
			'kl-header-toptext' => 'Custom Text',
			'topnav--sliding-panel' => 'Hidden Panel (Support Button)',
			'social-icons' => 'Social Icons',
			'zn_header_top_nav-wrapper' => 'Header Menu Navigation',
			'ctabutton' => 'Call To Action Button',
			'topnav--cart' => 'Shopping Cart Button/Panel'
		),
	'std'         => '',
	'class'       => 'zn_full'
);

/**
 *************** HELP FIELDS FROM HERE
 */

$admin_options[] = array (
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	"name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
	"description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
	"id"          => "ho_title",
	"type"        => "zn_title",
	"class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#TuXcJu9jl7c', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
	'slug'        => 'header_options',
	'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
	'slug'        => 'header_options',
	'parent'      => 'general_options',
));
