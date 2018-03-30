<?php
function webnus_gmap ($atts, $content = null) {
	extract( shortcode_atts( array(
		'map_type_display'		=> 'true',
		'map_type'				=> '\'roadmap\'',
		'draggable'				=> 'true',
		'animation'				=> 'true',
		'zoom_control_display'	=> 'true',
		'scrollwheel'			=> 'true',
		'street_view'			=> 'true',
		'scale_control'			=> 'true',
		'bg_color'				=> '',
		'hue'					=> '',
		'zoom_map'				=> '9',
		'zoom_click'			=> '',
		'width'					=> '0',
		'height'				=> '400',
		'lat_center'			=> '39.596165',
		'lon_center'			=> '-102.810059',
		'custom_marker'			=> '',
		'info_box_title'		=> '',
		'info_box_desc'			=> '',
		'map_points'			=> '',
		'latitude'				=> '',
		'longitude'				=> '',
		'address'				=> '',
		'location_title'		=> '',
		'location_website'		=> '',
		'custom_marker_s'		=> '',
	), $atts));

	wp_enqueue_script( 'googlemap-api' );

	$width					= ($width && is_numeric($width))? 'width:'.$width.'px;' : '';
	$height					= ($height && is_numeric($height))? 'height:'.$height.'px;' : '';
	$zoom_click 			= ($zoom_click) ? $zoom_click : $zoom_map;

	$draggable				= $draggable ? 'true' : 'false'; 
	$animation				= $animation ? 'animation: google.maps.Animation.DROP,' : ''; 
	$map_type_display 		= $map_type_display ? 'true' : 'false';
	$zoom_control_display	= $zoom_control_display ? 'true' : 'false';
	$scrollwheel			= $scrollwheel ? 'true' : 'false';
	$street_view			= $street_view ? 'true' : 'false';
	$scale_control			= $scale_control ? 'true' : 'false';


	// Fetch Carousle Item Loop Variables
	$map_item		= (array) vc_param_group_parse_atts( $map_points );
	$map_item_data	= array();

	foreach ( $map_item as $data ) {
		$new_line 							= $data;
		$new_line['latitude'] 				= isset( $new_line['latitude'] )? $new_line['latitude']: '';
		$new_line['longitude'] 				= isset( $new_line['longitude'] ) ? $new_line['longitude']: '';
		$new_line['address'] 				= isset( $new_line['address'] )? $new_line['address']: '';
		$new_line['location_title'] 		= isset( $new_line['location_title'] )? $new_line['location_title']: '';
		$new_line['location_website'] 		= isset( $new_line['location_website'] )? $new_line['location_website']: '';
		$new_line['custom_marker_s']		= isset( $new_line['custom_marker_s'] )? $new_line['custom_marker_s']: '';
		$map_item_data[]					= $new_line;
	}

	ob_start();
	
	$uniqid = uniqid(); ?>

	<div class="w-map">
		<div id="map_<?php echo $uniqid; ?>" style="<?php echo esc_attr( $width ) ?><?php echo esc_attr( $height ) ?>"></div>
	</div>
	
	<?php if ( $info_box_title || $info_box_desc ) { ?>
		<div id="save-widget">
			<strong><?php echo $info_box_title; ?></strong>
			<p><?php echo $info_box_desc; ?></p>
		</div>
	<?php } ?>
	
	<script type="text/javascript">
	jQuery(document).ready(function() {

		// init google map
		function initMap() {

			if ( Math.max(document.documentElement.clientWidth, window.innerWidth || 0) > 767 ) {
				var isDraggable = true;
			} else {
				var isDraggable = false;
			}

			var map = new google.maps.Map(document.getElementById('map_<?php echo $uniqid; ?>'), {
				mapTypeControl: <?php echo $map_type_display; ?>,
				zoomControl: <?php echo $zoom_control_display; ?>,
				scrollwheel: <?php echo $scrollwheel; ?>,
				streetViewControl: <?php echo $scrollwheel; ?>,
				scaleControl: <?php echo $scale_control; ?>,
				zoom: <?php echo $zoom_map; ?>,
				backgroundColor: '<?php echo $bg_color; ?>',
				center: {lat: <?php echo $lat_center; ?>, lng: <?php echo $lon_center; ?>},
				draggable: <?php echo $draggable; ?>,
				mapTypeControlOptions: {
					mapTypeIds: [<?php echo $map_type; ?>]
				},
				styles: [{
					stylers: [
						{ hue: '<?php echo $hue; ?>' }
					]
				}]
			});
			setMarkers(map);
		}

		// call init map function
		initMap();

		function setMarkers(map) {
			var items = [
				<?php foreach( $map_item_data as $map_single_item ) :
					if ( $map_single_item['location_title'] || $map_single_item['latitude'] || $map_single_item['longitude'] || $map_single_item['custom_marker_s'] || $map_single_item['address'] ) :
						$marker_icon = $map_single_item['custom_marker_s'] ? wp_get_attachment_url( $map_single_item['custom_marker_s'] ) : wp_get_attachment_url( $custom_marker );
						echo '[\'' . $map_single_item['location_title'] . '\',' . $map_single_item['latitude'] . ',' . $map_single_item['longitude'] . ',\'' . $marker_icon . '\',\'' . $map_single_item['address'] . '\'],'; 
					endif;
				endforeach; ?>
			];

			<?php if ( $info_box_title || $info_box_desc ) { ?>
				var widgetDiv = document.getElementById('save-widget');
				map.controls[google.maps.ControlPosition.TOP_LEFT].push(widgetDiv);
			<?php } ?>

			if ( typeof items != 'undefined' ) {
				for ( var i = 0; i < items.length; i++ ) {
					var item = items[i];
					var marker = new google.maps.Marker({
						map: map,
						<?php echo $animation; ?>
						position: {lat: item[1], lng: item[2]},
						icon: item[3],
						title: item[0],
						content: item[4],
					});
					
				   // Allow each marker to have an info window    
					google.maps.event.addListener(marker, 'click', (function (marker, index) {
						return function () {
							if( this.content ) {
								infoWindow.setContent(this.content);
								infoWindow.open(map, this);
							}
						}
					})(marker, index));
					
					var infoWindow = new google.maps.InfoWindow({ 
						content: item[4],
						maxWidth: 250
					}), marker, index;
					
					marker.addListener('click', function() {
						map.setZoom(<?php echo $zoom_click; ?>);
						map.setCenter(marker.position);
					});
				}
			}
		}
	});
	</script>

	<?php
	$out = ob_get_contents();
	ob_end_clean();
	$out = str_replace('<p></p>','',$out);
	return $out;
}
add_shortcode('gmap','webnus_gmap');