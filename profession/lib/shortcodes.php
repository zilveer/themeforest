<?php

/*-----------------------------------------------------------------------------------

	Theme Shortcodes

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Row, Column and Offset Shortcodes
/*-----------------------------------------------------------------------------------*/

/* Row */

function px_row( $atts, $content = null ) {
   return "<div class=\"row\">" . do_shortcode($content) . "</div>";
}

add_shortcode('rows', 'px_row');

/* One Twelve Column */

function px_span1( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span1 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span1', 'px_span1');

/* Two Twelve Column */

function px_span2( $atts, $content = null ) {
   	extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span2 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span2', 'px_span2');

/* Three Twelve Column */

function px_span3( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span3 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span3', 'px_span3');

/* Four Twelve Column */

function px_span4( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span4 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span4', 'px_span4');

/* Five Twelve Column */

function px_span5( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span5 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span5', 'px_span5');

/* Six Twelve Column */

function px_span6( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span6 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span6', 'px_span6');

/* Seven Twelve Column */

function px_span7( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span7 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span7', 'px_span7');

/* Eight Twelve Column */

function px_span8( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span8 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span8', 'px_span8');

/* Nine Twelve Column */

function px_span9( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span9 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span9', 'px_span9');

/* Ten Twelve Column */

function px_span10( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span10 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span10', 'px_span10');

/* Eleven Twelve Column */

function px_span11( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span11 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span11', 'px_span11');

/* Twelve Twelve Column */

function px_span12( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'offset'   => ''
    ), $atts));
	
   return "<div class=\"span12 $offset\">" . do_shortcode($content) . "</div>";
}

add_shortcode('span12', 'px_span12');

/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/
											
function px_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'style'   => 'medium_btn',
		'url'     => '#',
    ), $atts));
	//Available styles: btn_default , button_tailed
	
   return '<a class="btn ' . $style . '" href="'.$url.'"><span class="text">' . do_shortcode($content) .'</span></a>';
}

add_shortcode('button', 'px_button');

/*-----------------------------------------------------------------------------------*/
/*	Pie Chart
/*-----------------------------------------------------------------------------------*/
											
function px_piechart( $atts, $content ) {
	extract(shortcode_atts(array(
		'skilltitle'   => '',
		'style'   => 'shortcode_chart',
		'percent'     => '',
    ), $atts));
	 
   return '<ul class="shortcode_chartbox"><li><div class="'.$style.'" data-percent="'.$percent.'"><span>'.$percent.'%</span></div><p>'.$skilltitle.'</p></li></ul>';
}

add_shortcode('piechart', 'px_piechart');

/*-----------------------------------------------------------------------------------*/
/*	Pull Quotes
/*-----------------------------------------------------------------------------------*/

/* Pullquote */

function px_pullquote( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'style'   => '',
    ), $atts));
	
   return '<blockquote class="'.$style.'">' . do_shortcode($content) . '</blockquote>';
}

add_shortcode('pullquote', 'px_pullquote');

/*-----------------------------------------------------------------------------------*/
/*	Highlights
/*-----------------------------------------------------------------------------------*/

function px_highlight( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'style'   => 'highlight',
    ), $atts));
	//Available styles: highlight , gray_highlight , black_highlight
	
   return '<span class="'.$style.'">' . do_shortcode($content) . '</span>';
}

add_shortcode('highlight', 'px_highlight');

/*-----------------------------------------------------------------------------------*/
/*	testimonial
/*-----------------------------------------------------------------------------------*/
					
function px_testimonial( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'testimonial_name'   => '',
		'testimonial_meta'   => '',
    ), $atts));
	
   return '<div class="testimonial"> <div class="content">'. do_shortcode($content) .'</div><div class="bottom"></div><div class="cite"> <span class="name">' . do_shortcode($testimonial_name) . '</span><br/><span class="meta">' . do_shortcode($testimonial_meta) . '</span> </div>	</div>';
}

add_shortcode('testimonial', 'px_testimonial');


/*-----------------------------------------------------------------------------------*/
/*	Accordions
/*-----------------------------------------------------------------------------------*/

function px_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'status'   => 'toggle_closed',
		'title'    => '',
    ), $atts));
		
	$toggle = '';
										
	//Div accordion_header
	$toggle_header = '<div class="toggle_header"><h3 class="toggle_title"><span></span><a href="#"> '.$title.' </a></h3><div class="clearfix"></div></div>';
					
	//Div accordion_content
	$toggle_content = '<div class="toggle_content content_pad">' . do_shortcode($content) . '</div>';
	
	//Wrap the whole thing together
	$toggle .= '<div class="toggle ' . $status . ' ">' . $toggle_header . $toggle_content .'</div>'; 

   return $toggle;
}

add_shortcode('toggle', 'px_toggle');

/*-----------------------------------------------------------------------------------*/
/*	Separators
/*-----------------------------------------------------------------------------------*/

function px_separator() {
   return '<div class="separator"></div>';
}

add_shortcode('separator', 'px_separator');


/*-----------------------------------------------------------------------------------*/
/*	Alerts
/*-----------------------------------------------------------------------------------*/

function px_alert( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'style'   => 'alert_info',
    ), $atts));
	//Available styles: alert_info , alert_danger , alert_success , alert_warning
	
   return '<div class="alert '.$style.'">'. do_shortcode($content) .'<div Class="hover"></div> </div>';
}

add_shortcode('alert', 'px_alert');

/*-----------------------------------------------------------------------------------*/
/*	Tabs
/*-----------------------------------------------------------------------------------*/

function px_tab_group( $atts, $content ){

	extract(shortcode_atts(array(
	'title' => 'Tab %d'
	), $atts));
	
	//Init
	$GLOBALS['tabs'] = array();
	
	do_shortcode( $content );
	
	$tabs = array();
	$panes = array();
	
	foreach( $GLOBALS['tabs'] as $tab ){
		$selected = $tab['selected'] == 'yes' ? 'selected' : '';
		$id = $tab['id'];
		$title = $tab['title'];
		$cnt = $tab['content'];
		
		$tabs[] = "<li><a class=\"clearfix $selected\" href=\"#tab$id\"><span>$title</span></a></li>";

		$panes[] = "<div class=\"tab_content\" id=\"tab$id\">$cnt</div> ";
	}
	
	$return = "<div class=\"tab tab1\">\n<ul class=\"tab_head\">\n" . 
			  implode( "\n", $tabs ) . 
			  "</ul>\n<div class=\"clearfix\"></div>\n" .
			  implode( "\n", $panes ) .
			  "</div>";
	
	return $return;
}

add_shortcode( 'tabgroup', 'px_tab_group' );

function px_tab( $atts, $content ){

	extract(shortcode_atts(array(
	'title' => 'Tab %d',
	'selected' => ''
	), $atts));

	if(!array_key_exists('all_tabs_count',$GLOBALS))
		$GLOBALS['all_tabs_count'] = 0;
	
	$id = $GLOBALS['all_tabs_count'];
	$GLOBALS['tabs'][] = array( 'title' => sprintf( $title, count($GLOBALS['tabs']) + 1 ), 'content' => $content, 'id' => $id, 'selected' => $selected );

	$GLOBALS['all_tabs_count']++;
}

add_shortcode( 'tab', 'px_tab' );

/*-----------------------------------------------------------------------------------*/
/*	Social Icons
/*-----------------------------------------------------------------------------------*/

function px_social_links( $atts, $content ){

	extract(shortcode_atts(array(
	'url' => '#',
	'type' => '',
	), $atts));

	$GLOBALS['social_links'][] = "<li class=\"$type\"><a href=\"$url\"></a></li>";
}

//Social Link
add_shortcode( 'sl', 'px_social_links' );

function px_social_link_group( $atts, $content ){

	//Init
	$GLOBALS['social_links'] = array();
	
	do_shortcode( $content );

	return '<ul class="socials clearfix">' . implode("\n", $GLOBALS['social_links'] ) . '</ul>';
}

add_shortcode( 'socialgroup', 'px_social_link_group' );

/*-----------------------------------------------------------------------------------*/
/*	Vido
/*-----------------------------------------------------------------------------------*/
function px_vimeo( $atts, $content=null ){

	extract(shortcode_atts(array(
		'vimeo_id' => '',
		'vimeo_width' => '600',
		'vimeo_height' => '360'
	), $atts));
	
	return '<div class="video_shortcode"><iframe src="http://player.vimeo.com/video/' .$vimeo_id. '" width="' . $vimeo_width. '" height="' . $vimeo_height. '" frameborder="0"></iframe></div>';
}

add_shortcode( 'vimeo', 'px_vimeo' );

function px_youtube( $atts, $content=null ){

	extract(shortcode_atts(array(
		'youtube_id' => '',
		'youtube_width' => 600,
		'youtube_height' => 360
	), $atts));
	
	return '<div class="video_shortcode"><iframe title="YouTube video player" width="' . $youtube_width. '" height="' . $youtube_height. '" src="http://www.youtube.com/embed/' .$youtube_id. '" frameborder="0" allowfullscreen></iframe></div>';
	
}

add_shortcode( 'youtube', 'px_youtube' );

?>
