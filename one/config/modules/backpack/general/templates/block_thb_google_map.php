<?php

	$latlong = str_replace( ' ', '', $latlong );
	$zoom = empty( $zoom ) ? 12 : (int) $zoom;
	$height = empty( $height ) ? 300 : $height;

?>

<?php if ( ! empty( $latlong ) ) : ?>
	<?php
		$data = array(
			'latlong'     => $latlong,
			'zoom'        => $zoom,
			'scrollwheel' => (int) ( ! (bool) $disable_map_scroll ),
			'marker_icon' => ! empty( $marker ) ? thb_image_get_size( $marker, 'full' ) : '',
			'height'	  => is_numeric( $height ) ? $height .= 'px' : $height,
			'styles'	  => isset( $style ) ? $style : ''
		);

		$attrs = array(
			'style' => sprintf( "width: 100%%; height: %s", $height )
		);
	?>

	<div class="thb-section-block-header">
		<?php if ( $title != '' ) : ?>
			<h1 class="thb-section-block-title">
				<?php echo thb_text_format( $title ); ?>
			</h1>
		<?php endif; ?>
	</div>

	<div class="thb-google-map" <?php thb_data_attributes( $data ); ?> <?php thb_attributes( $attrs ); ?>></div>
<?php endif; ?>