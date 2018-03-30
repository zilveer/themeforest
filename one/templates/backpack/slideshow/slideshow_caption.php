<?php
	$hide_controls = thb_isset( $slide, 'hide_controls', false );
	$hide_text_when_playing = thb_isset( $slide, 'hide_text_when_playing', false );

	$show_caption =
		! empty( $slide['caption'] ) ||
		! empty( $slide['heading'] ) ||
		! empty( $slide['call_to_label'] ) ||
		! $hide_controls;

	$thb_caption_classes = array(
		'thb-slide-caption',
		$slide['caption_alignment']
	);

	if ( $hide_controls ) {
		$thb_caption_classes[] = 'thb-slide-caption-hide-controls';
	}

	if ( $hide_text_when_playing ) {
		$thb_caption_classes[] = 'thb-slide-caption-hide-texts-when-playing';
	}
?>

<?php if ( $show_caption ) : ?>
	<div class="<?php thb_classes( $thb_caption_classes ); ?>">
		<div class="thb-slide-caption-wrapper">
			<div class="thb-caption-inner-wrapper">

				<div class="thb-caption-texts-wrapper">
					<?php if ( $slide['caption_position'] == 'caption-top' ) : ?>

						<?php if ( ! empty( $slide['caption'] ) ) : ?>
							<div class="thb-caption">
								<?php echo apply_filters( 'the_content', $slide['caption'] ); ?>
							</div>
						<?php endif; ?>

					<?php endif; ?>

					<?php if ( ! empty( $slide['heading'] ) ) : ?>
						<div class="thb-heading">
							<p><?php echo nl2br( wptexturize( $slide['heading'] ) ); ?></p>
						</div>
					<?php endif; ?>

					<?php if ( $slide['caption_position'] == 'caption-bottom' ) : ?>

						<?php if ( ! empty( $slide['caption'] ) ) : ?>
							<div class="thb-caption">
								<?php echo apply_filters( 'the_content', $slide['caption'] ); ?>
							</div>
						<?php endif; ?>

					<?php endif; ?>

					<?php if ( !empty( $slide['call_to_label'] ) ) : ?>
						<?php
							$call_to_url = '';
							$target = '';
							$rel = '';

							if ( isset( $slide['call_to_url_target_blank'] ) && $slide['call_to_url_target_blank'] == '1' ) {
								$target = 'target="_blank"';
							}

							if ( !empty( $slide['call_to_url'] ) && is_numeric( $slide['call_to_url'] ) ) {
								$call_to_url = get_permalink( $slide['call_to_url'] );
							} else {
								$call_to_url = untrailingslashit( $slide['call_to_url'] );
								$home_url = untrailingslashit( home_url() );

								if ( ! thb_text_startsWith( $call_to_url, $home_url ) ) {
									$rel = 'rel="nofollow"';
								}
							}
						?>
						<div class="thb-call-to">
							<a class="thb-btn" href="<?php echo $call_to_url; ?>" <?php echo $target; ?> <?php echo $rel; ?>><?php echo $slide['call_to_label']; ?></a>
						</div>
					<?php endif; ?>

					<?php if ( ! wp_is_mobile() && $slide['type'] != 'image' && ! $hide_controls ) : ?>
						<div class="thb-video-controls">
							<a class="thb-video-play" href="#">Play video</a>
							<a class="thb-video-stop" href="#">Stop video</a>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>

		<?php if ( ! wp_is_mobile() && $hide_text_when_playing && $slide['type'] != 'image' && ! $hide_controls ) : ?>
			<div class="thb-external-video-controls">
				<a class="thb-video-stop" href="#">Stop video</a>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>