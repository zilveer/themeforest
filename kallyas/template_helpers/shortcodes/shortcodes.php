<?php if(! defined('ABSPATH')){ return; }
/*--------------------------------------------------------------------------------------------------
	File: shortcodes.php
	Description: This is the file that contains all the shortcodes logic
	Please be careful when editing this file
--------------------------------------------------------------------------------------------------*/
add_filter( 'widget_text', 'do_shortcode' );
/*--------------------------------------------------------------------------------------------------
Subtitle
--------------------------------------------------------------------------------------------------*/
add_shortcode( 'subtitle', 'zn_shortcode_subtitle' );
function zn_shortcode_subtitle( $atts, $content = null )
{
	// [subtitle] Content [/subtitle]
	return '<h2 class="subtitle page-subtitle">' . do_shortcode( $content ) . '</h2>';
}

/*--------------------------------------------------------------------------------------------------
	SITEMAP
--------------------------------------------------------------------------------------------------*/
add_shortcode( 'sitemap', 'zn_shortcode_sitemap' );
function zn_shortcode_sitemap( $atts )
{
	// [sitemap menu="Main Menu"]

	wp_enqueue_style( 'sitemap-css', THEME_BASE_URI . '/css/shortcodes/sitemap.css', array('kallyas-styles'), ZN_FW_VERSION );

	$menu = null;
	extract( shortcode_atts( array( 'menu' => null, ), $atts ) );
	$return = '<div class="sitemap">';
	$return .= wp_nav_menu( array( 'menu' => $menu, 'echo' => false ) );
	$return .= '</div>';
	return $return;
}

/*--------------------------------------------------------------------------------------------------
	Skills
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_skills( $atts, $content = null )
{
	// [skills main_text="skills" main_color="#193340" text_color="#ffffff"] Content [/skills]

	wp_enqueue_style( 'skills_diagram-css', THEME_BASE_URI . '/css/shortcodes/skills_diagram.css', array('kallyas-styles'), ZN_FW_VERSION );

	$main_color = $main_text = $text_color = '';
	extract( shortcode_atts( array( "main_text" => 'skills',
									"main_color" => '#193340',
									"text_color" => '#ffffff' ), $atts ) );
	$return = '<div id="skills_diagram" class="hidden-xs">';
	$return .= '<div class="legend">';
	$return .= '<h4>' . __( "Legend:", 'zn_framework' ) . '</h4>';
	$return .= '<ul class="skills">';
	$return .= do_shortcode( strip_tags( $content ) );
	$return .= '</ul><!-- end the skills -->';
	$return .= '</div>';
	$return .= '<div id="thediagram" data-width="600" data-height="600" data-maincolor="' . $main_color .
			   '" data-maintext="' . $main_text . '" data-fontsize="20px Arial" data-textcolor="' . $text_color .
			   '"></div>';
	$return .= '<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>';
	$return .= '<script type="text/javascript" src="' . THEME_BASE_URI . '/addons/raphael_diagram/init.js"></script>';
	$return .= '</div><!-- end skills diagram -->';
	return $return;
}

function zn_shortcode_skill( $atts, $content = null )
{
	$percentage = $main_color = '';
	// [skill main_color="#97BE0D" percentage="95"] Content [/skill]
	extract( shortcode_atts( array( "main_color" => '#97BE0D',
									"percentage" => '95' ), $atts ) );
	$return =
		'<li data-percent="' . $percentage . '" style="background-color:' . $main_color . ';">' . $content . '</li>';
	return $return;
}

add_shortcode( 'skills', 'zn_shortcode_skills' );
add_shortcode( 'skill', 'zn_shortcode_skill' );


/*--------------------------------------------------------------------------------------------------
	Heading shortcode
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_heading( $atts, $content = null )
{
	$atts = shortcode_atts(
		array(
			'heading_type' => 'h1'
		), $atts, 'bartag' );

	$shortcode_function = 'zn_shortcode_'.$atts['heading_type'] .'a';
	if( function_exists( $shortcode_function ) ){
		return call_user_func($shortcode_function, $atts, $content );
	}
	return false;

}

add_shortcode( 'znhg_alternative_header', 'zn_shortcode_heading' );

/*--------------------------------------------------------------------------------------------------
	H1 Alternative
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_h1a( $atts, $content = null )
{
	// [h1a] Content [/h1a]
	return '<h1 class="m_title text-custom" '.WpkPageHelper::zn_schema_markup('title').'>' . do_shortcode( $content ) . '</h1>';
}

add_shortcode( 'h1a', 'zn_shortcode_h1a' );
/*--------------------------------------------------------------------------------------------------
	H2 Alternative
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_h2a( $atts, $content = null )
{
	// [h2a] Content [/h2a]
	return '<h2 class="m_title text-custom" '.WpkPageHelper::zn_schema_markup('subtitle').'>' . do_shortcode( $content ) . '</h2>';
}

add_shortcode( 'h2a', 'zn_shortcode_h2a' );
/*--------------------------------------------------------------------------------------------------
	H3 Alternative
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_h3a( $atts, $content = null )
{
	// [h3a] Content [/h3a]
	return '<h3 class="m_title m_title_ext text-custom" '.WpkPageHelper::zn_schema_markup('subtitle').'>' . do_shortcode( $content ) . '</h3>';
}

add_shortcode( 'h3a', 'zn_shortcode_h3a' );
/*--------------------------------------------------------------------------------------------------
	H4 Alternative
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_h4a( $atts, $content = null )
{
	// [h4a] Content [/h4a]
	return '<h4 class="m_title text-custom">' . do_shortcode( $content ) . '</h4>';
}

add_shortcode( 'h4a', 'zn_shortcode_h4a' );
/*--------------------------------------------------------------------------------------------------
	H5 Alternative
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_h5a( $atts, $content = null )
{
	// [h5a] Content [/h5a]
	return '<h5 class="m_title text-custom">' . do_shortcode( $content ) . '</h5>';
}

add_shortcode( 'h5a', 'zn_shortcode_h5a' );
/*--------------------------------------------------------------------------------------------------
	H6 Alternative
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_h6a( $atts, $content = null )
{
	// [h6a] Content [/h6a]
	return '<h6 class="m_title text-custom">' . do_shortcode( $content ) . '</h6>';
}

add_shortcode( 'h6a', 'zn_shortcode_h6a' );
/*--------------------------------------------------------------------------------------------------
	List styles
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_list( $atts, $content = null )
{
	// TYPE : list-style1 , list-style2
	// [list type="list-style1"] Content [/list]
	$type = '';
	extract( shortcode_atts( array( "type" => 'list-style1' ), $atts ) );
	return str_replace( '<ul', '<ul class="' . $type . '"', do_shortcode( $content ) );
}

add_shortcode( 'list', 'zn_shortcode_list' );
/*--------------------------------------------------------------------------------------------------
	Blockquote
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_blockquote( $atts, $content = null )
{
	// [blockquote author="" align="left"] Content [/blockquote]
	$align = $author = '';
	extract( shortcode_atts( array( "author" => '',
									"align" => '' ), $atts ) );
	if ( $align == 'right' ) {
		$align = 'pull-right';
	}
	$quote = '<blockquote class="' . $align . '"><p>' . strip_tags( $content ) . '</p>';
	if ( !empty ( $author ) ) {
		$quote .= '<small>' . strip_tags( $author ) . '</small>';
	}
	$quote .= '</blockquote>';
	return str_replace( "\r\n", '', $quote );
}

add_shortcode( 'blockquote', 'zn_shortcode_blockquote' );
/*--------------------------------------------------------------------------------------------------
	QR CODE
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_qr( $atts, $content = null )
{
	// [qr align="right" size="140"] data [/qr]
	$align = $size = '';
	extract( shortcode_atts( array( "align" => 'right',
									"size" => '140', ), $atts ) );
	$data = urlencode( trim( $content ) );
	$return = '<div class="qrCode align' . $align . '" >';
	$return .= '<h6>' . __( 'Scan me!', 'zn_framework' ) . '</h6>';
	$return .= '<img src="http://api.qrserver.com/v1/create-qr-code/?data=' . $data . '&amp;size=' . $size . 'x' .
			   $size . '" alt="' . __( "Scan this QR Code!", 'zn_framework' ) . '" class="img-polaroid" />';
	$return .= '</div><!-- end QR Code -->';
	return $return;
}
add_shortcode( 'qr', 'zn_shortcode_qr' );

/*--------------------------------------------------------------------------------------------------
	QR CODE
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_qr_new( $atts, $content = null )
{
	// [znhg_qr align="right" url="YOUR QR CODE URL"]
	extract( shortcode_atts( array(
		"align" => 'right',
		"url" => '',
	), $atts ) );
	$data = urlencode( trim( $content ) );
	$return = '<div class="qrCode align' . $align . '" >';
	$return .= '<h6>' . __( 'Scan me!', 'zn_framework' ) . '</h6>';
	$return .= '<img src="'.$url.'" alt="' . __( "Scan this QR Code!", 'zn_framework' ) . '" class="img-polaroid" />';
	$return .= '</div>';
	return $return;
}
add_shortcode( 'znhg_qr', 'zn_shortcode_qr_new' );

/*--------------------------------------------------------------------------------------------------
	Two Columns
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_two_columns( $atts, $content = null )
{
	// [one_half_column] Content [/one_half_column]
	return '<div class="col-sm-6">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'one_half_column', 'zn_shortcode_two_columns' );
/*--------------------------------------------------------------------------------------------------
	1/3 Columns
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_three_columns( $atts, $content = null )
{
	// [one_third_column] Content [/one_third_column]
	return '<div class="col-sm-4">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'one_third_column', 'zn_shortcode_three_columns' );
/*--------------------------------------------------------------------------------------------------
	1/4 Columns
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_one_fourth_columns( $atts, $content = null )
{
	// [one_fourth_column] Content [/one_fourth_column]
	return '<div class="col-sm-3">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'one_fourth_column', 'zn_shortcode_one_fourth_columns' );
/*--------------------------------------------------------------------------------------------------
	2/3 Columns
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_two_third_columns( $atts, $content = null )
{
	// [two_third_column] Content [/two_third_column]
	return '<div class="col-sm-8">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'two_third_column', 'zn_shortcode_two_third_columns' );
/*--------------------------------------------------------------------------------------------------
	3/4 Columns
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_three_fourth_columns( $atts, $content = null )
{
	// [three_fourth_column] Content [/three_fourth_column]
	return '<div class="col-sm-9">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'three_fourth_column', 'zn_shortcode_three_fourth_columns' );

/*--------------------------------------------------------------------------------------------------
	Colum
	@since 4.1.6
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_column( $atts, $content = null )
{

	$atts = shortcode_atts( array(
		"size" => 'col-sm-6',
		"css_class" => '',
	), $atts );
	return '<div class="'.$atts['size'].' '.$atts['css_class'].'">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'znhg_column', 'zn_shortcode_column' );

/*--------------------------------------------------------------------------------------------------
	ROW
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_row( $atts, $content = "" )
{
	// [row no_margin] Content [/row]
	$class = '';
	if ( isset( $atts[0] ) && trim( $atts[0] ) ) {
		$class = trim( $atts[0] );
	}
	elseif( !empty( $atts['css_class'] ) ){
		$class = $atts['css_class'];
	}
	return '<div class="row ' . $class . '">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'row', 'zn_shortcode_row' );
/*--------------------------------------------------------------------------------------------------
Toggle [ Old Accordion ]
--------------------------------------------------------------------------------------------------*/
function zn_accordion( $atts, $content = null )
{
	// [accordion title="" style="" collapsed="true"] Content [/accordion]

	// Load Stylesheet from PB element
	wp_enqueue_style( 'accordion-css', THEME_BASE_URI . '/pagebuilder/elements/TH_Accordion/style.css', array('kallyas-styles'), ZN_FW_VERSION );

	$style = $collapsed = $title = '';
	extract( shortcode_atts( array( "title" => '',
									"style" => 'default-style',
									"size" => '140',
									"collapsed" => '' ), $atts ) );
	$link = '';
	if ( $style == 'style2' ) {
		$link = 'btn-link';
	}
	$iscollapsed = $collapsed == 'true' ? 'in' : '';
	$uid = uniqid();
	$return = '';
	$return .= '<div class="zn_accordion--shortcode acc--' . $style . ' panel-group ">';
	$return .= '<div class="acc-group ">';
	$return .= '<button data-toggle="collapse" data-target="#acc' . $uid . '" class="acc-tgg-button text-custom collapsed ' .
			   $link . '">' . $title . '<span class="acc-icon"></span></button>';
	$return .= '<div id="acc' . $uid . '" class="acc-panel-collapse collapse ' . $iscollapsed . '">';
	$return .= '<div class="acc-content">';
	$return .= do_shortcode( $content );
	$return .= '</div><!-- /.acc-content -->';
	$return .= '</div>'; // .acc-panel-collapse
	$return .= ' </div><!-- end /.acc-group -->';
	$return .= ' </div><!-- end /.acc--style -->';
	return $return;
}

add_shortcode( 'accordion', 'zn_accordion' );
/*--------------------------------------------------------------------------------------------------
	Accordion
	--------------------------------------------------------------------------------------------------*/
/**
 * This function generates the html needed to output the wrapper for an Accordion or a Toggle element.
 * Usage:
 *
 * <code>[accordion_container style="default-style" title="Toggle" type="toggle"] Accordion Pane shortcode
 * [/accordion_container]</code>
 * <code>[accordion_container style="style1" title="Accordion" type="accordion" id="a1234"] Accordion Pane shortcode
 * [/accordion_container]</code>
 *
 * @param array       $atts    The list of arguments the shortcode accepts
 * @param string|null $content The content to display inside the accordion pane
 *
 * @since 4.0.2
 * @return string
 */
function zn_accordion_container( $atts, $content = null )
{
	// [accordion_container style="default-style" title="Toggle" type="toggle"] Content [/accordion_container]
	// [accordion_container style="style1" title="Accordion" type="accordion" id="a1234"] Content [/accordion_container]

	// Load Stylesheet from PB element
	wp_enqueue_style( 'accordion-css', THEME_BASE_URI . '/pagebuilder/elements/TH_Accordion/style.css', array('kallyas-styles'), ZN_FW_VERSION );

	$style = $title = $type = $id = '';
	extract( shortcode_atts( array( "style" => 'default-style',
									"title" => 'Accordion',
									// The title
									"type" => 'accordion',
									// possible values: accordion, toggle. value accordion requires ID
									// The ID for the accordion. Only required for type = accordion. If omitted a toggle accordion will be generated
									"id" => '', ), $atts ) );
	if ( 'toggle' == strtolower( $type ) ) {
		$id = ''; // the id is not needed for this type
	}
	else {
		$id = ( !empty( $id ) ? 'id="' . $id . '"' : '' );
	}
	$out = '';
	$out .= '<div class="zn_accordion_element zn_accordion--container zn-acc--' . $style . '">';
	$out .= '<h3 class="acc-title">' . $title . '</h3>';
	$out .= '<div ' . $id . ' class="acc--' . $style . ' panel-group">' . do_shortcode( $content ) . '</div>';
	$out .= '</div>';
	return $out;
}

add_shortcode( 'accordion_container', 'zn_accordion_container' );
/**
 * This function generates the html needed to output an Accordion Pane.
 * Usage:
 *
 * <code>[accordion_pane title="Accordion" collapsed="true"] Content [/accordion_pane]</code>
 * <code>[accordion_pane title="Accordion" collapsed="true" parent_id="a1234"] Content [/accordion_pane]</code>
 *
 * @param array       $atts    The list of arguments the shortcode accepts
 * @param string|null $content The content to display inside the accordion pane
 *
 * @since 4.0.2
 * @return string
 */
function zn_accordion_panel( $atts, $content = null )
{
	// [accordion_pane title="Accordion" collapsed="true"] Content [/accordion_pane]
	// [accordion_pane title="Accordion" collapsed="true" parent_id="a1234"] Content [/accordion_pane]

	// Load Stylesheet from PB element
	wp_enqueue_style( 'accordion-css', THEME_BASE_URI . '/pagebuilder/elements/TH_Accordion/style.css', array('kallyas-styles'), ZN_FW_VERSION );

	$collapsed = $title = $type = $parent_id = '';
	extract( shortcode_atts( array( "title" => __( 'Accordion', 'zn_framework' ),
									"parent_id" => '',
									// the ID for the accordion. if omitted, it will be auto-generated
									"collapsed" => 'true', ), $atts ) );
	$isCollapsed = ( $collapsed == 'false' ? 'in' : '' );
	// if accordion, add data-parent data attr
	$dataParent = '';
	if ( !empty( $parent_id ) ) {
		$dataParent = 'data-parent="#' . $parent_id . '"';
	}
	$pid = uniqid( 'acc_' );
	$out = '
<div class="panel acc-group">
	<div class="acc-panel-title">
		<a ' . $dataParent . ' data-toggle="collapse" href="#' . $pid . '" class="acc-tgg-button text-custom collapsed">' . $title . '<span class="acc-icon"></span></a>
	</div>
	<div id="' . $pid . '" class="acc-panel-collapse collapse ' . $isCollapsed . '">
		<div class="acc-content">' . do_shortcode( $content ) . '</div>
	</div>
</div>';
	return $out;
}

add_shortcode( 'accordion_pane', 'zn_accordion_panel' );
/*--------------------------------------------------------------------------------------------------
	ToolTip
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_tooltip( $atts, $content = null )
{
	$title = $placement = $border = '';
	// [tooltip placement="" border="yes" title=""] Content [/tooltip]
	extract( shortcode_atts( array( "placement" => 'top',
									"title" => '',
									"border" => 'yes' ), $atts ) );
	if ( empty ( $placement ) ) {
		$placement = 'top';
	}
	if ( $border == 'yes' ) {
		$border = 'class="stronger"';
	}
	else {
		$border = '';
	}

	$tooltipt = '<span ' . $border . ' data-rel="tooltip" data-placement="' . $placement . '" title="' . $title . '" data-animation="true">' . $content . '</span>';
	return $tooltipt;
}

add_shortcode( 'tooltip', 'zn_shortcode_tooltip' );
/*--------------------------------------------------------------------------------------------------
	Icons
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_icons( $atts, $content = null )
{
	$white = $css_white = '';
	// [icon white="false" ] ICON_NAME [/icon]
	extract( shortcode_atts( array( "white" => false ), $atts ) );
	if ( $white != 'false' ) {
		$css_white = 'kl-icon-white';
	}
	$icon = '<i class="glyphicon glyph' . preg_replace( '/\s+/', '', $content ) . ' ' . $css_white . '"></i>';
	return $icon;
}

add_shortcode( 'icon', 'zn_shortcode_icons' );
/*--------------------------------------------------------------------------------------------------
	TABLES styles
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_table( $atts, $content = null )
{
	// TYPE : table , table-striped , table-bordered , table-hover , table-condensed
	// [table type="table-striped"] Content [/table]
	$type = '';
	extract( shortcode_atts( array( "type" => 'table-striped' ), $atts ) );
	return do_shortcode( str_replace( '<table', '<table class="table ' . $type . '"', $content ) );
}

add_shortcode( 'table', 'zn_shortcode_table' );
/*--------------------------------------------------------------------------------------------------
	Buttons
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_buttons( $atts, $content = null )
{
	$url = $size = $style = $block = $target = '';
	// [button style="btn-primary" url="" size="" block="false" target="_self"] BUTTON TEXT [/button]
	extract( shortcode_atts( array( "style" => '',
									"size" => '',
									"block" => '',
									"url" => '',
									"target" => '' ), $atts ) );
	return ' <a href="' . $url . '" class="btn ' . $size . ' ' . $style . ' ' . $block . '" target="' . $target . '">' . $content . '</a>';

}

add_shortcode( 'button', 'zn_shortcode_buttons' );
/*--------------------------------------------------------------------------------------------------
	Pricing table
--------------------------------------------------------------------------------------------------*/
$columns = '';
$color = '';
function zn_shortcode_pricing_table( $atts, $content = null )
{
	wp_enqueue_style( 'pricing_table-css', THEME_BASE_URI . '/css/shortcodes/pricing_table.css', array('kallyas-styles'), ZN_FW_VERSION );

	$space = $rounded = '';
	// Colors : red , blue , green , turquoise , orange , purple , yellow , green_lemon , dark , light
	// Space : no-space
	// [pricing_table color="red" columns="4" space="no" rounded="no"] PRICING COLUMNS [/pricing_table]
	global $columns, $color;
	extract( shortcode_atts( array( "columns" => '4',
									"color" => 'red',
									"rounded" => 'no',
									"space" => false ), $atts ) );
	if ( $space == 'no' ) {
		$space = 'no-space';
	}
	if ( $rounded == 'yes' ) {
		$rounded = 'rounded-corners';
	}
	$pricing = '<div class="row pricing_table ' . $space . ' ' . $rounded . '">';
	$pricing .= do_shortcode( $content );
	$pricing .= '</div>';
	return $pricing;
}

add_shortcode( 'pricing_table', 'zn_shortcode_pricing_table' );
function zn_shortcode_pricing_column( $atts, $content = null )
{
	$highlight = $name = $price = $price_value = $target = $button_link = $button_text = '';
	// [pricing_column name="" target="_self" highlight="no" price="" price_value="" button_link="" button_text=""] PRICING COLUMNS [/pricing_column]
	extract( shortcode_atts( array( "name" => '',
									"highlight" => false,
									"price" => '',
									"price_value" => '',
									"button_link" => '',
									"button_text" => '',
									"target" => '_self', ), $atts ) );
	global $columns, $color;
	$span = 12 / $columns;
	if ( $highlight == 'no' ) {
		$is_highlight = '';
	}
	else {
		$is_highlight = 'highlight';
	}
	$pricing = '';
	$pricing .= '<div class="col-sm-' . $span . '">';
	$pricing .= '<div class="pr_table_col ' . $is_highlight . '" data-color="' . $color . '">';
	$pricing .= '<div class="tb_header">';
	$pricing .= '<h4 class="ttitle kl-font-alt">' . $name . '</h4>';
	$pricing .= '<div class="price kl-font-alt"><p>' . $price . '<span>' . $price_value . '</span></p></div>';
	$pricing .= '</div>';
	$pricing .= do_shortcode( str_replace( '<ul', '<ul class="tb_content"', $content ) );
	$pricing .= '<div class="signin"><a class="btn" target="' . $target . '" href="' . $button_link . '">' .
				$button_text . '</a></div>';
	$pricing .= '</div><!-- end pricing table column -->';
	$pricing .= '</div>';
	return $pricing;
}

add_shortcode( 'pricing_column', 'zn_shortcode_pricing_column' );
function zn_shortcode_pricing_caption( $atts, $content = null )
{
	$name = '';
	// [pricing_caption name=""] PRICING COLUMNS [/pricing_caption]
	extract( shortcode_atts( array( "name" => '' ), $atts ) );
	global $columns, $color;
	$span = 12 / $columns;
	$pricing = '';
	$pricing .= '<div class="col-sm-' . $span . '">';
	$pricing .= '<div class="pr_table_col caption_column" data-color="' . $color . '">';
	$pricing .= '<div class="tb_header">';
	$pricing .= $name;
	$pricing .= '</div>';
	$pricing .= do_shortcode( str_replace( '<ul', '<ul class="tb_content"', $content ) );
	$pricing .= '</div><!-- end pricing table column -->';
	$pricing .= '</div>';
	return $pricing;
}

add_shortcode( 'pricing_caption', 'zn_shortcode_pricing_caption' );
/*--------------------------------------------------------------------------------------------------
	TABS
--------------------------------------------------------------------------------------------------*/
$tabs_divs = '';
$tabs_num = 0;
function zn_shortcode_tabs( $atts, $content = null )
{
	// [tabs style=""]  [tab title="TAB_NAME"] CONTENT [/tab]  [tab title="TAB_NAME"] CONTENT [/tab]  [tab title="TAB_NAME"] CONTENT [/tab][/tabs]

	// Load Stylesheet from PB element
	wp_enqueue_style( 'tabs-css', THEME_BASE_URI . '/pagebuilder/elements/TH_HorizontalTabs/style.css', array('kallyas-styles'), ZN_FW_VERSION );

	$style = $tabdirection = $tabtype = '';
	global $tabs_divs, $tabs_num;
	extract( shortcode_atts( array( 'tabtype' => '',
									'style' => 'style1',
									'tabdirection' => 'vertical', ), $atts ) );
	$tabs_divs = '';
	$output = '<div class="tabbable tabs_' . $style . ' tabs-' . $tabdirection . '"><ul class="nav ' . $tabtype .
			  '" id="custom-tabs-' . rand( 1, 100 ) . '">';
	$output .= do_shortcode( $content ) . '</ul>';
	$output .= '<div class="tab-content">' . $tabs_divs . '</div></div>';
	$tabs_num = 0;
	return $output;
}

function zn_shortcode_tab( $atts, $content = null )
{
	$title = '';
	global $tabs_divs, $tabs_num;
	$defaults = array( 'title' => 'Tab' );
	extract( shortcode_atts( $defaults, $atts ) );
	$id = 'side-tab' . rand( 100, 999 );
	$active = $tabs_num == 0 ? 'active' : '';
	$output = '
	<li class="' . $active . '">
		<a href="#' . $id . '" data-toggle="tab">' . $title . '</a>
	</li>
';
	$tabs_divs .= '<div id="' . $id . '" class="tab-pane ' . $active . '">' . do_shortcode( $content ) . '</div>';
	$tabs_num++;
	return $output;
}

add_shortcode( 'tabs', 'zn_shortcode_tabs' );
add_shortcode( 'tab', 'zn_shortcode_tab' );
/*--------------------------------------------------------------------------------------------------
	SHOW CODE
--------------------------------------------------------------------------------------------------*/
function zn_shortcode_code( $atts, $content = null )
{
	// [code] BUTTON TEXT [/code]
	$content = str_replace( '<br />', '', $content );
	$content = str_replace( '<p>', '', $content );
	$content = str_replace( '</p>', '', $content );
	$code = '<pre class="prettyprint linenums">' . htmlentities( $content ) . '</pre>';
	return $code;
}

add_shortcode( 'code', 'zn_shortcode_code' );


/*
 * Display the current year
 * @since v4.0.9
 * @wpk
 */
add_shortcode( 'ht_year', 'zn_shortcode_copyright_year' );
function zn_shortcode_copyright_year(){
	// Return the proper year based on the local time
	return date_i18n('Y', current_time('timestamp'));
}
