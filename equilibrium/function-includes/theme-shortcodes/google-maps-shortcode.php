<?php
function onioneye_gmap( $atts ) {
	
	// Set the $add_the_gmap_scripts flag to true, to call the javascript for the shortcode if it hasn't been already included.
	global $add_the_gmap_scripts;
	$add_the_gmap_scripts = true;
	
	extract( shortcode_atts( array(
	  'width' => '',
	  'height' => '',
	  'zoom' => '',
	  'address' => '',
	  'latitude' => '',
	  'longitude' => '',
	  'marker_address' => '',
	  'marker_latitude' => '',
	  'marker_longitude' => '',
	  'marker_title' => '',
	  'marker_popup' => '',
	  'marker_html' => ''
	), $atts ) );
	
	$map_id = uniqid( 'map' ); //generate a unique id for the map to avoid conflicts with other maps, if included
	
	$js_output = '';
	$comma = ', ';
	
	if ( !empty( $zoom ) ) {
		$js_output .= "\n\t". 'zoom: ' . $zoom;
	}
	else {
		$comma = ' ';
	}
	
	if( !empty( $address ) ) {
		$js_output .= $comma . 'address: "' . $address . '"';
		$comma = ', ';
	}
	elseif ( !empty( $latitude ) && !empty( $longitude ) ) {
		$js_output .= $comma . 'latitude: ' . $latitude . ', ' . 'longitude: ' . $longitude;
		$comma = ', ';
	}
	
	$comma_before_marker_options = $comma;
	
	if ( !empty( $marker_address) || !empty( $marker_latitude ) || !empty( $marker_longitude ) || !empty( $marker_title ) || !empty( $marker_popup ) || !empty( $marker_html ) ) {
	   	$marker_output = '';
			
	   	if ( !empty( $marker_address ) ) {
			$marker_output .= 'address: "' . $marker_address . '"';
			$comma = ', ';
		}
		elseif ( !empty($marker_latitude) && !empty( $marker_longitude ) ) {
			$marker_output .= 'latitude: ' . $marker_latitude . ', ' . 'longitude: ' . $marker_longitude;
			$comma = ', ';
		}	
		else {
			$comma = ' ';
		}
		
		if( !empty( $marker_title ) ) {
			$marker_output .= $comma . 'title: "' . $marker_title . '"';
			$comma = ', ';
		}
	
		if( !empty( $marker_popup ) ) {
			$marker_output .= $comma . 'popup: ' . $marker_popup;
			$comma = ', ';
		}
		
		if( !empty( $marker_html ) ) {
			$marker_output .= $comma . 'html: "' . $marker_html . '"';
			$comma = ', ';
		}
			 
	   	$js_output .= $comma_before_marker_options . 
	   				  'markers: [' .
			          '{' .
			          	  $marker_output .
			          '}' . 
				      ']';
	}
	
	$output = '<!-- START .map-container -->' .
		   	   '<div class="map-container">' .
			       	  '<div id="' . $map_id  . '" class="gmap" style="width: ' . $width . 'px; height: ' . $height . 'px">' . 
		           			$placeholder .
		       		  '</div>' .
		   	   '</div>' .
		   	   '<!-- END .map-container -->';	
			   
	$output .= '<script>' .
			       'jQuery(window).ready(function() { ' . 
		    	       'jQuery(' . '"#' . $map_id . '"' . ').gMap({ ' .
		    	           $js_output .
    		  	       '});' .
			   	   '}); ' .
			   '</script>';  
			   
	return $output;
}

add_shortcode( 'gmap', 'onioneye_gmap' );
?>