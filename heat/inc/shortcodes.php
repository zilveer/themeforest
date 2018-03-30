<?php
/**
 * Heat shortcodes
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

// Actual processing of the shortcode happens here
function pre_process_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
 
    add_shortcode( 'one_half', 'mega_one_half' );
	add_shortcode( 'one_half_last', 'mega_one_half_last' );
	add_shortcode( 'one_third', 'mega_one_third' );
	add_shortcode( 'one_third_last', 'mega_one_third_last' );
	add_shortcode( 'two_third', 'mega_two_third' );
	add_shortcode( 'two_third_last', 'mega_two_third_last' );
	add_shortcode( 'one_fourth', 'mega_one_fourth' );
	add_shortcode( 'one_fourth_last', 'mega_one_fourth_last' );
	add_shortcode( 'three_fourth', 'mega_three_fourth' );
	add_shortcode( 'three_fourth_last', 'mega_three_fourth_last' );
	add_shortcode( 'button', 'mega_button' );
	add_shortcode( 'accordion', 'mega_accordion' );
	add_shortcode( 'tabgroup', 'mega_tabgroup' );
	add_shortcode( 'dropcap', 'mega_dropcap' );
	add_shortcode( 'highlight', 'mega_highlight' );
	add_shortcode( 'hr', 'mega_hr' );;
	add_shortcode( 'map', 'mega_map' );
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
add_filter( 'the_content', 'pre_process_shortcode', 7 );

/*
 * Column Shortcodes
 */
function mega_one_half( $atts, $content = null ) {
   return '<div class="column one-half">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'one_half', 'mega_one_half' );

function mega_one_half_last( $atts, $content = null ) {
   return '<div class="column one-half column-last">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'one_half_last', 'mega_one_half_last' );

function mega_one_third( $atts, $content = null ) {
   return '<div class="column one-third">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'one_third', 'mega_one_third' );

function mega_one_third_last( $atts, $content = null ) {
   return '<div class="column one-third column-last">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'one_third_last', 'mega_one_third_last' );

function mega_two_third( $atts, $content = null ) {
   return '<div class="column two-third">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'two_third', 'mega_two_third' );

function mega_two_third_last( $atts, $content = null ) {
   return '<div class="column two-third column-last">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'two_third_last', 'mega_two_third_last' );

function mega_one_fourth( $atts, $content = null ) {
   return '<div class="column one-fourth">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'one_fourth', 'mega_one_fourth' );

function mega_one_fourth_last( $atts, $content = null ) {
   return '<div class="column one-fourth column-last">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'one_fourth_last', 'mega_one_fourth_last' );

function mega_three_fourth( $atts, $content = null ) {
   return '<div class="column three-fourth">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'three_fourth', 'mega_three_fourth' );

function mega_three_fourth_last( $atts, $content = null ) {
   return '<div class="column three-fourth column-last">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'three_fourth_last', 'mega_three_fourth_last' );

/*
 * Buttons
 */
function mega_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url' => '#',
		'target' => '_self',
		'style' => 'white',
		'size' => 'small',
		'window' => ''
    ), $atts ) );
	
	if ( $window == 'true' ) {
		$target = 'target="_blank"';
	} else {
		$target = 'target="_self"';
	}
	
   return '<a class="button '. $size .' '. $style .'"'. $target .' href="'. $url .'">' . do_shortcode( $content ) . '</a>';
}
add_shortcode( 'button', 'mega_button' );

/*
 * jQuery UI Accordion
 */
function mega_accordion( $atts, $content = null ) {
		
        extract( shortcode_atts( array(
		'collapsible' => true,
		'framed' => false
		), $atts ) );
        
		if ( !preg_match_all( "/(.?)\[(section)\b(.*?)(?:(\/))?\](?:(.+?)\[\/section\])?(.?)/s", $content, $matches ) ) {
			return do_shortcode( $content );
		} else {
		
			$output = '';
		
			for ( $i = 0; $i < count( $matches[0]); $i++ ) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			
			for ( $i = 0; $i < count( $matches[0] ); $i++ ) {
				$output .= '<h3><a href="#">' . $matches[3][$i]['title'] . '</a></h3>
							<div>' . do_shortcode( $matches[5][$i] ) . '</div>';
			}
			
			$addClassCollapsible = '';
			if ( $collapsible == 'true' ) $addClassCollapsible = '_collapsible';
			
			$addClassFramed = '';
			if ( $framed == 'true' ) $addClassFramed = 'framed';
			
			return '<div class="accordion'. $addClassCollapsible .' '. $addClassFramed .'">' . $output . '</div>';
		}
		
}
add_shortcode( 'accordion', 'mega_accordion' );

/*
 * jQuery UI Tabs
 */
function mega_tabgroup( $atts, $content = null ) {

	extract( shortcode_atts( array(), $atts));

	if ( !preg_match_all( "/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches ) ) {
			return do_shortcode( $content );
	} else {
	
		$output = '';
		
			for ( $i = 0; $i < count( $matches[0]); $i++ ) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			
			$output .= '<ul class="tabs">';
			
			for ( $i = 0; $i < count( $matches[0] ); $i++ ) {
				$output .= '<li><a href="#tabs-'. $i .'">' . $matches[3][$i]['title'] . '</a></li>';
			}
			
			$output .= '</ul>';
			
			$output .= '<div class="ui-tabs-panel-wrapper clearfix">';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$output .= '<div id="tabs-'. $i .'">' . do_shortcode( $matches[5][$i] ) . '</div>';
			}
			
			$output .= '</div>';
			
			return '<div class="tabs clearfix">' . $output . '</div>';
		}
	
}
add_shortcode( 'tabgroup', 'mega_tabgroup' );

/*
 * Dropcaps
 */

if ( ! function_exists( 'mega_dropcap' ) )
{
	function mega_dropcap( $atts, $content, $shortcodename ) {
		
		$output  = '<span class="' . $shortcodename . '">';
		$output .= $content;
		$output .= '</span>';	
		
		return $output;
	}
	add_shortcode( 'dropcap', 'mega_dropcap' );
}

/*
 * Highlights
 */
function mega_highlight( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'background' => '#FFF203',
			'color' => '#444444'
		), $atts ) );
		
		return '<span class="highlight" style="background: '. $background .'; color: '. $color .'">'. do_shortcode( $content ) .'</span>';

}
add_shortcode( 'highlight', 'mega_highlight' );

/*
 * hr
 */
if ( ! function_exists( 'mega_hr' ) ) {
	function mega_hr( $atts, $content, $shortcodename ) {
	
		$output = '<hr class="'. $shortcodename .'" />';
	
		return $output;
	}
	add_shortcode( 'hr', 'mega_hr' );
}

/*
 * Google Maps
 */
if ( ! function_exists( 'mega_map' ) ) {
	function mega_map( $atts = null, $content = null ) {
		extract( shortcode_atts( array(
			'width' => '100%',
			'height' => '300',
			'zoom' => '8',
			'type' => 'ROADMAP'
		), $atts ) );
		
		STATIC $map_id = 0;
		$map_id++;
		
		$output = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>';
		$output .= '<script>';
		$output .= 'jQuery(document).ready(function(){';
		
		// Map Options
		$output .= 'var mapOptions'. $map_id .' = {';
		$output .= 'scrollwheel: false,';
		$output .= 'zoom: '. $zoom .',';
		$output .= 'controls: [],';
		$output .= 'mapTypeId: google.maps.MapTypeId.'. $type;
		$output .= '};';
		
		// The Map Object
		$output .= 'var map'. $map_id .' = new google.maps.Map(document.getElementById("map-'. $map_id .'"), mapOptions'. $map_id .');';
		
		if ( !preg_match_all( '/(.?)\[(marker)\b(.*?)(?:(\/))?\](?:(.+?)\[\/marker\])?(.?)/s', $content, $matches ) ) {
	
			// Don't do anything if there are no markers.

		} else {
				
			for ( $i = 0; $i < count( $matches[0] ); $i++ ) {
			
				$options = explode( '"', $matches[0][$i] );
				$address = $options[1];
			
				$search_string = $matches[0][$i];
				$url_search = str_replace( '[/marker]', '', $search_string );
				$info_content = substr( $url_search, strpos( $url_search, ']' ) + 1, strlen( $url_search ) );
				$info_content = trim( $info_content );
		
				$output .= 'var address'. $map_id .' = "";';
				$output .= 'var geocoder'. $map_id .' = new google.maps.Geocoder();';
				$output .= 'geocoder'. $map_id .'.geocode({ "address" : "'. $address .'" }, function (results, status) {';
					$output .= 'if (status == google.maps.GeocoderStatus.OK) {';
						$output .= 'address'. $map_id .' = results[0].geometry.location;';
						
						$output .= 'map'. $map_id .'.setCenter(results[0].geometry.location);';
						
						$output .= 'var marker'. $map_id .' = new google.maps.Marker({';
						$output .= 'position: address'. $map_id .','; 
						$output .= 'map: map'. $map_id .',';
						$output .= 'clickable: true,';
						$output .= 'animation: google.maps.Animation.DROP';
						$output .= '});'; 
						
						$output .= 'var infowindow'. $map_id .' = new google.maps.InfoWindow({ content: "'. $info_content .'" });';
						$output .= 'google.maps.event.addListener(marker'. $map_id .', "click", function() {';
						$output .= 'infowindow'. $map_id .'.open(map'. $map_id .', marker'. $map_id .');';
						$output .= '});';
						
					$output .= '}';
				$output .= '});';
			}
		}
		
		$output .= '});';
		$output .= '</script>';
		
		$output .= '<div id="map-'. $map_id .'" class = "map" style = "width: '. $width .'px; height: '. $height .'px;"></div>';
		
		return $output;
	}
	add_shortcode( 'map', 'mega_map' );
}

/*
 * Enable shortcodes in widget areas
 */
add_filter( 'widget_text', 'do_shortcode' );
 