<?php

/*-----------------------------------------------------------------------------------
	Theme Shortcodes
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/

function icy_one_third( $atts, $content = null ) {
   return '<div class="one-third column">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'icy_one_third');

function icy_one_third_last( $atts, $content = null ) {
   return '<div class="one-third column last-column">' . do_shortcode($content) . '</div><div class="clear" style="margin-bottom: 20px"></div>';
}
add_shortcode('one_third_last', 'icy_one_third_last');

function icy_two_third( $atts, $content = null ) {
   return '<div class="two-thirds column">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'icy_two_third');

function icy_two_third_last( $atts, $content = null ) {
   return '<div class="two-thirds column">' . do_shortcode($content) . '</div><div class="clear" style="margin-bottom: 20px"></div>';
}
add_shortcode('two_third_last', 'icy_two_third_last');

function icy_one_half( $atts, $content = null ) {
   return '<div class="eight columns">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'icy_one_half');

function icy_one_half_last( $atts, $content = null ) {
   return '<div class="eight columns omega last-column">' . do_shortcode($content) . '</div><div class="clear" style="margin-bottom: 20px"></div>';
}
add_shortcode('one_half_last', 'icy_one_half_last');

function icy_one_fourth( $atts, $content = null ) {
   return '<div class="four columns">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'icy_one_fourth');

function icy_one_fourth_last( $atts, $content = null ) {
   return '<div class="four columns omega last-column">' . do_shortcode($content) . '</div><div class="clear" style="margin-bottom: 20px"></div>';
}
add_shortcode('one_fourth_last', 'icy_one_fourth_last');

function icy_three_fourth( $atts, $content = null ) {
   return '<div class="twelve columns">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'icy_three_fourth');

function icy_three_fourth_last( $atts, $content = null ) {
   return '<div class="twelve columns omega last-column">' . do_shortcode($content) . '</div><div class="clear" style="margin-bottom: 20px"></div>';
}
add_shortcode('three_fourth_last', 'icy_three_fourth_last');

function icy_full_width( $atts, $content = null ) {
   return '<div class="sixteen columns">' . do_shortcode($content) . '</div><div class="clear" style="margin-bottom: 20px"></div>';
}
add_shortcode('full_width', 'icy_full_width');

/*-----------------------------------------------------------------------------------*/
/*	Button
/*-----------------------------------------------------------------------------------*/


function icy_button( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'target'     => '_self',
		'style'   => 'red',
		'size'	=> 'small'
    ), $atts));
	
   return '<a class="button '.$size.' '.$style.'" href="'.$url.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'icy_button');


/*-----------------------------------------------------------------------------------*/
/*	Alert
/*-----------------------------------------------------------------------------------*/


function icy_alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'style'   => 'white'
    ), $atts));
	
   return '<div class="alert '.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('alert', 'icy_alert');

/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcodes
/*-----------------------------------------------------------------------------------*/

function icy_toggle( $atts, $content = null ) {

	$out = '';
	
    extract(shortcode_atts(array(
		'title'    	 => 'Title goes here',
		'state'		 => 'open'
    ), $atts));

	
	$out .= "<div data-icy-toggle='".$state."' class=\"toggle\"><h4>".$title."</h4><div class=\"toggle-content\">".do_shortcode($content)."</div></div>";
	
    return $out;
	
}
add_shortcode('toggle', 'icy_toggle');

/*------------------------------------------------------------------------------------------------*/
/*	Tabs Shortcodes
/*------------------------------------------------------------------------------------------------*/

if (!function_exists('icy_tabs')) {
	function icy_tabs( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
		    $output .= '<div id="tabs-'. rand(1, 100) .'" class="tabs"><div class="tab-content">';
			$output .= '<ul class="navigation">';
			
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div></div>';
		} else {
			$output .= do_shortcode( $content );
		}
		
		return $output;
	}
	add_shortcode( 'tabs', 'icy_tabs' );
}

if (!function_exists('icy_tab')) {
	function icy_tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<div id="tab-'. sanitize_title( $title ) .'" class="tab">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'tab', 'icy_tab' );
}

?>