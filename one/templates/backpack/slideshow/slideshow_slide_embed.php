<?php
	$video_atts = array(
		'autoplay'    => $slide['autoplay'],
		'loop'        => $slide['loop'],
		'fill'        => ! $slide['fit'],
		'code'		  => thb_get_video_code( $slide['id'] )
	);

	$is_youtube = strpos($slide['id'], 'youtu') !== false;
	$is_vimeo = strpos($slide['id'], 'vimeo') !== false;
	$muted = thb_isset( $slide, 'mute_video', false );
	$is_selfhosted = ! $is_youtube && ! $is_vimeo;

	if ( $is_youtube ) {
		$slide['id'] = '//www.youtube.com/watch?v=' . thb_get_video_code($slide['id']);
	}

	if ( $is_youtube || $is_vimeo ) {
		$slide_data['embed-iframe'] = '1';
	}

	$image_size = 'thumbnail_large';
	$poster_image_id = thb_isset( $slide, 'poster_image', 0 );
	$thb_video_thumbnail = '';

	if ( $muted ) {
		$video_atts['muted'] = '1';
	}

	if ( ! empty( $poster_image_id ) ) {
		$thb_video_thumbnail = thb_image_get_size( $poster_image_id, $image_size );
	}
	else {
		if ( $is_youtube || $is_vimeo ) {
			$thb_video_thumbnail = thb_get_video_thumbnail( $slide['id'], $image_size );
		}
	}

	if ( ! empty( $thb_video_thumbnail ) && ( $is_selfhosted || wp_is_mobile() ) ) {
		if ( ! isset( $slide_attrs['style'] ) ) {
			$slide_attrs['style'] = '';
		}

		$slide_attrs['style'] .= ' background-image: url(' . $thb_video_thumbnail . ')';

		if ( $is_selfhosted ) {
			$slide_data['poster-image'] = '1';
		}
	}
?>

<div <?php thb_attributes( $slide_attrs ); ?> <?php thb_data_attributes( $slide_data ); ?> <?php thb_data_attributes( $video_atts ); ?>>
	<?php if ( $is_youtube || $is_vimeo ) : ?>
		<?php if ( ! wp_is_mobile() ) : ?>
			<a class="rsImg" data-rsVideo="<?php echo $slide['id']; ?>" href="<?php echo $thb_video_thumbnail; ?>"></a>
		<?php endif; ?>
	<?php else : ?>
		<?php
			if ( ! wp_is_mobile() ) {
				thb_video( $slide['id'], $video_atts );
			}
		?>
	<?php endif; ?>

	<?php
		if ( $slide['overlay_display'] ) {
			thb_overlay( $slide['overlay_color'], $slide['overlay_opacity'] );
		}
	?>

	<?php thb_slide_caption( $slide ); ?>

</div>