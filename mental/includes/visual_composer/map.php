<?php
add_shortcode( 'vcm_mental_map', 'vcm_mental_map_shortcode' );
function vcm_mental_map_shortcode( $atts, $content = null ) {
	if ( isset( $atts['marker'] ) && ( $atts['marker'] ) ) {
		$atts['marker'] = esc_url( wp_get_attachment_image_url( $atts['marker'], false ) );
	}
	$atts = shortcode_atts( array(
		'coord'  => '34.040842, -118.233977',
		'zoom'   => '12',
		'height' => '400',
		'marker' => get_site_url() . '/wp-content/themes/mental/assets/img/map_marker.png',
		'id'     => 'map-' . rand( 1, 999 ),
	), $atts, 'vcm_mental_map' );

	ob_start();
	?>

	<div id="<?php echo esc_attr( $atts['id'] ); ?>" style="height: <?php echo (int) $atts['height'] ?>px;"></div>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
	<script type="text/javascript">
		function initialize_google_map() {
			var myLatlng = new google.maps.LatLng(<?php echo esc_js( $atts['coord'] ); ?>);
			var mapOptions = {
				zoom: <?php echo (int) $atts['zoom']; ?>,
				center: myLatlng,
				scrollwheel: false
			}
			var map = new google.maps.Map(document.getElementById('<?php echo esc_attr( $atts['id'] ); ?>'), mapOptions);

			var styles = <?php echo json_encode( json_decode( stripslashes( get_mental_option( 'google_maps_styles' ) ) ) ); ?>;

			map.setOptions({styles: styles});

			var marker_icon = {
				url: '<?php echo esc_url( $atts['marker'] ); ?>',
				size: new google.maps.Size(44, 49),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(22, 49)
			};

			var marker = new google.maps.Marker({
				position: myLatlng,
				map: map,
				title: 'M',
				<?php if ( $atts['marker'] ) {
				echo 'icon: marker_icon';
			} ?>
			});
		}
		google.maps.event.addDomListener(window, 'load', initialize_google_map);
	</script>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-map',
	'name'            => __( 'Mentas Map', 'mental' ),
	"base"            => "vcm_mental_map", // bind with our shortcode
	"content_element" => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"        => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			'type'       => 'textfield',
			'param_name' => 'coord',
			'heading'    => __( 'Coordinates', 'mental' ),
			'value'      => '34.040842, -118.233977'
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'zoom',
			'heading'    => __( 'Zoom', 'mental' ),
			'value'      => 12
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'height',
			'heading'    => __( 'Height', 'mental' ),
		),
		array(
			'type'       => 'attach_image',
			'param_name' => 'marker',
			'heading'    => __( 'Map marker', 'mental' )
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'id',
			'heading'    => __( 'ID', 'mental' )
		),
	)
) );