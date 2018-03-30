<?php
/**
 * Theme options > General Options  > Favicon options
 */

$activelist = WpkZn::getPortfolioCategories();
if(!empty($activelist)){
	$allarr = array("*" => "All");
	$activelist = $allarr + $activelist;
}

$admin_options[] = array (
				'slug'        => 'portfolio_options',
				'parent'      => 'portfolio_options',
				"name"        => __( 'Portfolio page (Archive)', 'zn_framework' ),
				"description" => __( 'These options are dedicated to the portfolio archive page.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name"        => __( "Portfolio Archive style", 'zn_framework' ),
	"description" => __( "Select the desired style for the portfolio archive pages.", 'zn_framework' ),
	"id"          => "portfolio_style",
	"std"         => "portfolio_sortable",
	"options"     => array(
		array(
			'value' => 'portfolio_category',
			'name'  => __( 'Portfolio Category', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/portfolio_layouts/category.gif'
		),
		array(
			'value' => 'portfolio_sortable',
			'name'  => __( 'Portfolio Sortable', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/portfolio_layouts/sortable.gif'
		),
		array(
			'value' => 'portfolio_carousel',
			'name'  => __( 'Portfolio Carousels', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/portfolio_layouts/carousels.gif'
		),
	),
	"type"        => "radio_image",
	"class"        => "ri-hover-line ri-3",
);

$admin_options[] = array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name" => __("Active Button in Portfolio Menu", 'zn_framework'),
	"description" => __("Choose the active category or wether all should be displayed on page load.", 'zn_framework'),
	"id" => "ptf_sort_activebutton",
	"std" => '*',
	"type" => "select",
	"options" => $activelist,
	'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') )
);

$admin_options[] = array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name" => __("Show load more button", 'zn_framework'),
	"description" => __("Choose if you want to show the load more button or not.", 'zn_framework'),
	"id" => "ptf_sort_loadmore",
	"std" => 'no',
	"type" => "toggle2",
	"value" => "yes",
	'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') ),
);

// Columns number for Category and Sortable Portfolio
$admin_options[] = array (
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name"        => __( "Number of columns", 'zn_framework' ),
	"description" => __( "Please select on how many columns the portfolio should be displayed.", 'zn_framework' ),
	"id"          => "ports_num_columns",
	"std"         => "4",
	"options"     => array (
		'1' => __( '1', 'zn_framework' ),
		'2' => __( '2', 'zn_framework' ),
		'3' => __( '3', 'zn_framework' ),
		'4' => __( '4', 'zn_framework' ),
		'5' => __( '5', 'zn_framework' ),
		'6' => __( '6', 'zn_framework' ),
	),
	"type"        => "select",
	"dependency"  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_category', 'portfolio_sortable' ) ),
);

$admin_options[] = array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name" => __("Images Width", 'zn_framework'),
	"description" => __("This option will resize and cache the images in your portfolio listing page's items. Not specifying a width will result in full-width images that would slow down the loading of your page. ", 'zn_framework'),
	"id" => "ptf_sort_img_width",
	"std" => '',
	"type" => "text",
	"placeholder" => "eg: 600px",
	'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_sortable') ),
);

$admin_options[] = array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name" => __("Frame Style", 'zn_framework'),
	"description" => __("Please choose which frame style to apply.", 'zn_framework'),
	"id" => "frame_style",
	"std" => 'classic',
	"type" => "select",
	"options" => array(
		"classic" => 'Classic',
		"modern" => 'Modern',
		"minimal" => 'Minimal',
	),
	"dependency"  => array( 'element' => 'portfolio_style' , 'value'=> array('portfolio_carousel') ),
);

// Columns number for Carousels Portfolio
$admin_options[] = array (
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name"        => __( "Number of columns (Portfolio Carousels)", 'zn_framework' ),
	"description" => __( "Please select on how many columns the portfolio should be displayed.", 'zn_framework' ),
	"id"          => "ports_carousel_columns",
	"std"         => "1",
	"options"     => array (
		'1' => __( '1', 'zn_framework' ),
		'2' => __( '2', 'zn_framework' ),
		'3' => __( '3', 'zn_framework' ),
	),
	"type"        => "select",
	"dependency"  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_carousel' ) ),
);

$admin_options[] = array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name" => __("Show item details bellow post content", 'zn_framework'),
	"description" => __("Here, you can choose to show the portfolio item details like CLIENt, YEAR, etc. <b> Important : Will only work when you select 1 column layout </b> ).", 'zn_framework'),
	"id" => "ports_extra_content",
	"std" => "no",
	"options" => array(
		'yes' => __('Show', 'zn_framework'),
		'no' => __('Hide', 'zn_framework'),
	),
	"class"        => "zn_radio--yesno",
	"type" => "zn_radio",
	'dependency'  => array( 'element' => 'portfolio_style' , 'value'=> array( 'portfolio_category' ) ),
);

$admin_options[] = array (
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name"        => __( "Link Portfolio Media", 'zn_framework' ),
	"description" => __( "Select Yes if you want your portfolio images to be linked to the portfolio item as
		opposed to open the image in lightbox.", 'zn_framework' ),
	"id"          => "zn_link_portfolio",
	"std"         => "no",
	"options"     => array (
		'yes'       => __( 'Link all to portfolio item', 'zn_framework' ),
		'no'        => __( 'Open the image in lightbox, title links to portfolio item', 'zn_framework' ),
		'no_all'    => __( 'Open the image in lightbox, title is unlinked', 'zn_framework' )
	),
	"type"        => "select"
);


$admin_options[] = array (
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name"        => __( "Portfolio items per page", 'zn_framework' ),
	"description" => __( "Please enter the desired number of portfolio items that will be displayed on a page.", 'zn_framework' ),
	"id"          => "portfolio_per_page_show",
	"std"         => "4",
	"type"        => "text",
);

$admin_options[] = array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	'id'          => 'portfolio_scheme',
	'name'        => 'Portfolio color scheme',
	'description' => 'Select the color scheme of the Portfolio',
	'type'        => 'select',
	'std'         => '',
	'options'        => array(
		'' => 'Inherit from Global (Color options)',
		'light' => 'Light',
		'dark' => 'Dark'
	),
);

$admin_options[] = array (
				'slug'        => 'portfolio_options',
				'parent'      => 'portfolio_options',
				"name"        => __( 'Portfolio item page (Single)', 'zn_framework' ),
				"description" => __( 'These options are dedicated to the portfolio item page.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name"        => __( "Text content (description) style", 'zn_framework' ),
	"description" => __( "Display the text content either collapsed or expanded.", 'zn_framework' ),
	"id"          => "portfolio_single_style",
	"std"         => "",
	"type"        => "select",
	"options"     => array (
		'' => __( 'Show compacted description', 'zn_framework' ),
		'full_desc' => __( 'Show full description', 'zn_framework' ),
	),
	"class"       => ""
);

$admin_options[] = array (
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name"        => __( "Portfolio Images Width (px)", 'zn_framework' ),
	"description" => __( "The width of the portfolio item images to resize, in pixels. Adding '0' means no resize.", 'zn_framework' ),
	"id"          => "portfolio_item_img_width",
	"std"         => "700",
	"type"        => "text",
	"dragup"     => array(
		'min' => '100'
	),
	"class"       => "zn_input_xs"
);

$admin_options[] = array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name" => __("Show related portfolio items?", 'zn_framework'),
	"description" => __("Here, you can choose to show the portfolio related items or not. The related items are based on the portfolio tags. ).", 'zn_framework'),
	"id" => "ports_show_related",
	"std" => "no",
	"options" => array(
		'yes' => __('Show', 'zn_framework'),
		'no' => __('Hide', 'zn_framework'),
	),
	"class"        => "zn_radio--yesno",
	"type" => "zn_radio",
);

$admin_options[] = array (
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	"name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
	"description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
	"id"          => "ptfo_title",
	"type"        => "zn_title",
	"class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#rVA576HZaYA', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options'
));
$admin_options[] = zn_options_doc_link_option( 'http://support.hogash.com/documentation/setting-up-portfolio/', array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
));
