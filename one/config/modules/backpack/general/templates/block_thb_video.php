<?php
	$caption_visible = $title != '' || $content != '';

	$video_atts = array(
		'autoplay'    => $autoplay,
		'loop'        => $loop
	);

	$ratio = isset( $ratio ) ? $ratio : '';

	if ( empty( $ratio ) ) {
		$ratio = '16:9';
	}

	$ratio = str_replace( '/', ':', $ratio );
	$ratio_dims = explode( ':', $ratio );

	$ratio_x = isset( $ratio_dims[0] ) && ! empty( $ratio_dims[0] ) ? $ratio_dims[0] : '16';
	$ratio_y = isset( $ratio_dims[1] ) && ! empty( $ratio_dims[1] ) ? $ratio_dims[1] : '9';

	$video_atts['ratio_x'] = $ratio_x;
	$video_atts['ratio_y'] = $ratio_y;

?>

<?php if ( $caption_visible ) : ?>
	<div class="thb-section-block-header">
		<?php if ( $title != '' ) : ?>
			<h1 class="thb-section-block-title"><?php echo thb_text_format( $title ); ?></h1>
		<?php endif; ?>
	</div>

	<?php if ( $content != '' ) : ?>
		<div class="thb-text">
			<?php echo thb_text_format( $content, true ); ?>
		</div>
	<?php endif; ?>
<?php endif; ?>

<div class="thb-section-block-thb_video-video-holder <?php if ( $caption_visible ) : ?>w-text<?php endif; ?>">
	<?php thb_video( $id, $video_atts ); ?>
</div>