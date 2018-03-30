<?php
/**
 *
 */
class mysiteMaps {
	
	private static $map_id = 1;
	
	/**
	 *
	 */
	function _map_id() {
	    return self::$map_id++;
	}

	/**
	 *
	 */
	function map( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Maps', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'map',
				'options' => array(
					array(
						'name' => __( 'Width', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the width of your map.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Height', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the height of your map.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Zoom', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select an initial zoom value for your map.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'zoom',
						'options' => array(
							'1' => __('1', MYSITE_ADMIN_TEXTDOMAIN ),
							'2' => __('2', MYSITE_ADMIN_TEXTDOMAIN ),
							'3' => __('3', MYSITE_ADMIN_TEXTDOMAIN ),
							'4' => __('4', MYSITE_ADMIN_TEXTDOMAIN ),
							'5' => __('5', MYSITE_ADMIN_TEXTDOMAIN ),
							'6' => __('6', MYSITE_ADMIN_TEXTDOMAIN ),
							'7' => __('7', MYSITE_ADMIN_TEXTDOMAIN ),
							'8' => __('8', MYSITE_ADMIN_TEXTDOMAIN ),
							'9' => __('9', MYSITE_ADMIN_TEXTDOMAIN ),
							'10' => __('10', MYSITE_ADMIN_TEXTDOMAIN ),
							'11' => __('11', MYSITE_ADMIN_TEXTDOMAIN ),
							'12' => __('12', MYSITE_ADMIN_TEXTDOMAIN ),
							'13' => __('13', MYSITE_ADMIN_TEXTDOMAIN ),
							'14' => __('14', MYSITE_ADMIN_TEXTDOMAIN ),
							'15' => __('15', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Map Type', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select which type of map you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'type',
						'default' => '',
						'options' => array(
							'ROADMAP' => __('Roadmap', MYSITE_ADMIN_TEXTDOMAIN ),
							'SATELLITE' => __('Satellite', MYSITE_ADMIN_TEXTDOMAIN ),
							'HYBRID' => __('Hybrid', MYSITE_ADMIN_TEXTDOMAIN ),
							'TERRAIN' => __('Terrain', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of Markers', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many markers you wish to display on your map.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'options' => range(1,20),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Address', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the address for your marker.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'address',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Description', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the information you would like to display when your marker is clicked on.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Icon', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can upload an icon that you wish to use here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'icon',
						'default' => '',
						'type' => 'upload',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'marker',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		global $wp_query, $mysite;
		
		extract(shortcode_atts(array(
			'width'			=> '400',
			'height'		=> '300',
			'zoom'			=> '4',
			'type'			=> 'ROADMAP',
		), $atts));
		
		$map_id = 'gmap_id_' . self::_map_id();
		
		// Load google maps api 
		$out = '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>';
		
		$out .= '<script type = "text/javascript">';
		$out .= 'jQuery(document).ready(function(){';
		
		// Setup options
		$out .= 'var options'.$map_id.' = {';
		$out .= 'zoom: '.$zoom.',';
		$out .= 'controls: [],';
		$out .= 'mapTypeId: google.maps.MapTypeId.'.$type;
		$out .= '};';
		
		// Initialize map
		$out .= 'var map'.$map_id.' = new google.maps.Map(document.getElementById("'.$map_id.'"), options'.$map_id.');';
		
		if ( !preg_match_all( '/(.?)\[(marker)\b(.*?)(?:(\/))?\](?:(.+?)\[\/marker\])?(.?)/s', $content, $matches ) ) {
	
			// No markers, do nothing

		} else {
		
			for ($i = 0; $i < count( $matches[0] ); $i++ ) {
			
				$options = explode('"', $matches[0][$i]);
				$address = $options[1];
				$icon = $options[3];
			
				$search_string = $matches[0][$i];
				$url_search = str_replace('[/marker]', '', $search_string);
				$info_content = substr($url_search, strpos($url_search, ']') + 1, strlen($url_search));
				$info_content = trim($info_content);
		
				// Setup a new Geocode for the current marker address
				$out .= 'var address'.$i.' = "";';
				$out .= 'var g'.$i.' = new google.maps.Geocoder();';
				$out .= 'g'.$i.'.geocode({ "address" : "'.$address.'" }, function (results, status) {';
					$out .= 'if (status == google.maps.GeocoderStatus.OK) {';
						$out .= 'address'.$i.' = results[0].geometry.location;';
						
						// Center map on last marker added
						$out .= 'map'.$map_id.'.setCenter(results[0].geometry.location);';
						
						// Setup Marker
						$out .= 'var marker'.$i.' = new google.maps.Marker({';
						$out .= 'position: address'.$i.','; 
						$out .= 'map: map'.$map_id.',';
						$out .= 'clickable: true,';
						$out .= 'icon: "'.$icon.'",';
						$out .= '});'; 
						
						// Setup info window for marker
						$out .= 'var infowindow'.$i.' = new google.maps.InfoWindow({ content: "'.$info_content.'" });';
						$out .= 'google.maps.event.addListener(marker'.$i.', "click", function() {';
						$out .= 'infowindow'.$i.'.open(map'.$map_id.', marker'.$i.');';
						$out .= '});';
						
					$out .= '}';
				$out .= '});';
				
			}
		}
		
		$out .= '});';
		$out .= '</script>';
		
		// Output our map container
		$out .= '<div id="'.$map_id.'" class = "msmw_map" style = "width: '.$width.'px; height: '.$height.'px;"></div>';
		
		return $out;
	}


	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Maps', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'map',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>