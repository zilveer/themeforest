<?php

/* Button */

function flash_sale_shortcodes_button($atts, $content = null) {

	/* Set up variables */
	extract(shortcode_atts(array(
		'url' => '', 
		'icon' => '',
		'label' => '', 
		'colour' => '', 
		'colour_custom' => '', 
		'size' => 'medium', 
		'edge' => 'straight', 
		'target' => '_self'
	), $atts));
	
	/* Return Button */
	$button_style = "";
	if($colour_custom) {
		$button_style = ' style="background-color: '.$colour_custom.'"';
	}
	if($icon) {
		$icon = '<i class="fa-icon-'.$icon.'"></i>&nbsp;&nbsp;';
	}
	return '<a href="'.$url.'" class="flash_sale-shortcode flash_sale-shortcode-button flash_sale-shortcode-button-colour-'.$colour.' flash_sale-shortcode-button-size-'.$size.' flash_sale-shortcode-button-edge-'.$edge.'" target="'.$target.'"'.$button_style.'>'.$icon.$label.'</a>';
	
}
add_shortcode('flash_sale_button', 'flash_sale_shortcodes_button');


/* Columns */

function flash_sale_shortcodes_columns($atts, $content = null) {

	/* Set up variables */
	extract(shortcode_atts(array(
		'structure' => '50|50'
	), $atts));
	
	$structure_class = str_replace('|', '-', $structure);
	$structure_class = str_replace('50', 'half', $structure_class);
	$structure_class = str_replace('33', 'third', $structure_class);
	$structure_class = str_replace('67', 'twothirds', $structure_class);
	$structure_class = str_replace('25', 'quarter', $structure_class);
	
	$structure_class = ' flash_sale-shortcode-cols-'.$structure_class.' ';

	/* Return Columns */
	return '<div class="flash_sale-shortcode flash_sale-shortcode-cols '.$structure_class.'">'.do_shortcode($content).'</div>';
	 
}
add_shortcode('flash_sale_columns', 'flash_sale_shortcodes_columns');



/* Column */

function flash_sale_shortcodes_column($atts, $content = null) {

	/* Set up variables */
	extract(shortcode_atts(array(
		'position' => 'a'
	), $atts));
	
	return '<div class="flash_sale-shortcode flash_sale-shortcode-col flash_sale-shortcode-col-'.$position.'"><div class="flash_sale-shortcode-col-inner">'.wpautop(do_shortcode($content)).'</div></div>';

}
add_shortcode('flash_sale_col', 'flash_sale_shortcodes_column');



/* Social */

function flash_sale_social($atts, $content = null) {
	
	/* Return Social */
	return '<p class="flash_sale-shortcode flash_sale-shortcode-social-links">'.do_shortcode($content).'</p>';
	 
}
add_shortcode('flash_sale_social', 'flash_sale_social');



/* Social Link */

function flash_sale_social_link($atts, $content = null) {
	global $sn_flash_sale_shortcodes_directory;
	
	/* Set up variables */
	extract(shortcode_atts(array(
		'service' => '',
		'link' => ''
	), $atts));
	
	if(strpos($service, 'sn-social-icon-') !== false) {
		
		$social_link_code = '<a href="'.$link.'" target="_blank" class="sn-social-icon '.$service.'"></a>';
		
	} else {
		
		$social_link_code = '<a href="'.$link.'" target="_blank" class="sn-social-icon-image"><img src="'.$sn_flash_sale_shortcodes_directory.'images/social-icons/'.$service.'.png" alt="'.$service.'" /></a>';
		
	}

	/* Return Social */
	return $social_link_code;
	 
}
add_shortcode('flash_sale_social_link', 'flash_sale_social_link');



/* YouTube */

function flash_sale_shortcodes_media($atts, $content = null) {

	/* Set up variables */
	extract(shortcode_atts(array(
		'type' => 'youtube',
		'url' => '',
		'width' => '100%',
		'height' => '400'
	), $atts));
	
	$media_code = '';
	
	if($type == "youtube") {
	
	/* YouTube */
		if(strpos($url, 'youtube')) {
			$embed_src = $url;
			parse_str( parse_url( $embed_src, PHP_URL_QUERY ), $my_array_of_vars );
			$youtube_id = $my_array_of_vars['v']; 
		} else {
			$youtube_id = $url;
		}
		$media_code = '<div class="flash_sale-shortcode flash_sale-shortcode-video-embed"><iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$youtube_id.'" frameborder="0" allowfullscreen></iframe></div>'; 
		
	} else if($type == "vimeo") {
	
	/* Vimeo */
		$result = preg_match('/(\d+)/', $url, $matches);
		if($result) {
		    $vimeo_id = $matches[0];
		} else {
			$vimeo_id = $url;
		}
		$media_code = '<div class="flash_sale-shortcode flash_sale-shortcode-video-embed"><iframe src="http://player.vimeo.com/video/'.$vimeo_id.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'; 
	
	}
	
	return $media_code;

}
add_shortcode('flash_sale_media', 'flash_sale_shortcodes_media');



/* Toggles */

function flash_sale_shortcodes_toggle($atts, $content = null) {

	/* Set up variables */
	extract(shortcode_atts(array(
		'heading' => '',
		'icon' => '',
		'text' => '',
		'accordion' => '',
		'onload' => 'closed'
	), $atts));
	
	if($onload == "open") { $active_class = "flash_sale-shortcode-toggle-active"; } else { $active_class = ""; }
	if($icon) { $icon_code = '<i class="fa-icon-'.$icon.'"></i>'; } else { $icon_code = ''; }
	if($accordion == 1) {
		$toggle_icons = '<i class="toggle-down fa-icon-plus"></i><i class="toggle-up fa-icon-minus"></i>';
	} else {
		$toggle_icons = '<i class="toggle-down fa-icon-caret-down"></i><i class="toggle-up fa-icon-caret-up"></i>';
	}
	
	return '<div class="flash_sale-shortcode flash_sale-shortcode-toggle '.$active_class.'"><h3 class="flash_sale-shortcode flash_sale-shortcode-toggle-heading">'.$icon_code.$heading.$toggle_icons.'</h3><div class="flash_sale-shortcode flash_sale-shortcode-toggle-content">'.wpautop($text).'</div></div>';

}
add_shortcode('flash_sale_toggle', 'flash_sale_shortcodes_toggle');



/* Accordion */

function flash_sale_shortcodes_accordion($atts, $content = null) {

	/* Return Toggles */
	return '<div class="flash_sale-shortcode flash_sale-shortcode-accordion">'.do_shortcode($content).'</div>';
	
}
add_shortcode('flash_sale_accordion', 'flash_sale_shortcodes_accordion');



/* Tabs */

function flash_sale_shortcodes_tabs($atts, $content = null) {
	/* Return Tabs */
	return '<div class="flash_sale-shortcode flash_sale-shortcode-tabs">'.do_shortcode($content).'</div>';
}
add_shortcode('flash_sale_tabs', 'flash_sale_shortcodes_tabs');


/* Tab */

function flash_sale_shortcodes_tab($atts, $content = null) {

	/* Set up variables */
	extract(shortcode_atts(array(
		'label' => ''
	), $atts));
		
	return '<div class="flash_sale-shortcode flash_sale-shortcode-tabpane"><div class="flash_sale-shortcode flash_sale-shortcode-tab-label">'.$label.'</div>'.wpautop(do_shortcode($content)).'</div>';

}
add_shortcode('flash_sale_tab', 'flash_sale_shortcodes_tab');


/* Map */
global $google_map_script_code;
function flash_sale_shortcodes_map($atts, $content = null) {
	global $google_map_script_code;
	
	/* Set up variables */
	extract(shortcode_atts(array(
		'latitude' => '', 
		'longitude' => '', 
		'width' => '100%', 
		'height' => '400px', 
		'zoom' => '16',
		'infowindow_text' => ''
	), $atts));
		
	$google_map_code = "";
	
	if( strpos($height, 'px') || strpos($height, '%') ) { } else {
		$height = $height.'px';
	}
	if( strpos($width, 'px') || strpos($width, '%') ) { } else {
		$width = $width.'px';
	}
	
	$infowindow_text = '<p>'.$infowindow_text.'</p>';
	
	$content_map_id = "content_map_".rand();
				
		$google_map_script_code .= "<script src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
		<script type='text/javascript'>
	      jQuery(function() {
	        var myLatlng = new google.maps.LatLng(".$latitude.",".$longitude.");
	        var mapOptions = {
	          zoom: ".$zoom.",
	          center: myLatlng,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        }
	
	        var map = new google.maps.Map(document.getElementById('".$content_map_id."'), mapOptions);
	        
	        var marker = new google.maps.Marker({
	            position: myLatlng,
	            map: map,
	            title: ''
	        });";
	        
	if($infowindow_text) {
	
	        $google_map_script_code .= "
	        var contentString = '".$infowindow_text."';
	
	        var infowindow = new google.maps.InfoWindow({
	            content: contentString
	        });
	        
	        google.maps.event.addListener(marker, 'click', function() {
	          infowindow.open(map,marker);
	        });";
	        
	}
	        
	      $google_map_script_code .= " 
	      });
	    </script>";
	    
	    $google_map_code .= '<div id="'.$content_map_id.'" class="flash_sale-shortcode-map" style="width:'.$width.';height:'.$height.';"></div>';
		
	return $google_map_code;

}
add_shortcode('flash_sale_map', 'flash_sale_shortcodes_map');



/* Add Google Map Code to Footer */
function add_google_map_code() { 
	global $google_map_script_code;
	if(isset($google_map_script_code)) {
		if($google_map_script_code) { 
			echo $google_map_script_code;
		}		
	}
	
}
add_action('wp_footer', 'add_google_map_code');