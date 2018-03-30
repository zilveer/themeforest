<?php if( $stack['stack_title'] == 'revslider' && class_exists('RevSlider') ) putRevSlider( $stack['revolution_slider_id'] ); ?>

<?php 
	if( $stack['stack_title'] == 'layer-slider' ) {
		global $shortcode_tags;
		if ( array_key_exists( 'layerslider', $shortcode_tags ) ) {
			echo do_shortcode('[layerslider id="'.$stack["layer_slider_id"].'"]');
		}	 
	}
?>

<?php if( $stack['stack_title'] == 'stack' && isset($stack['stack_slider_id']) ): 
	$full_width = get_post_meta($stack['stack_slider_id'], '_info_full_width', true);
	$full_width = ( $full_width == 'on' ) ? 'stack-slider-full-width' : '';

	$slide_list = get_post_meta($stack['stack_slider_id'], '_info_slide_list', true);
	$transition = get_post_meta($stack['stack_slider_id'], '_info_transition', true);
	$transition_duration = get_post_meta($stack['stack_slider_id'], '_info_transition_duration', true);
	$slide_height = get_post_meta($stack['stack_slider_id'], '_info_height', true);
	$slide_parallax_distance = 150; // padding for parallax effect

	$autoplay = get_post_meta($stack['stack_slider_id'], '_info_autoplay', true);
	$autoplay = ( $autoplay == 'on' ) ? 'true' : 'false';
	$interval = get_post_meta($stack['stack_slider_id'], '_info_interval', true);
?>
	
<div class="stack stack-slider <?php echo $full_width; ?>" id="<?php echo $stack['id']; ?>">
<div class="container">
	<div class="slides" data-effect="<?php echo $transition; ?>" data-height="<?php echo $slide_height; ?>" data-width="<?php echo $full_width?1200:940; ?>" data-speed="<?php echo $transition_duration; ?>" data-autoplay="<?php echo $autoplay; ?>" data-interval="<?php echo $interval; ?>" style="max-height: <?php echo $slide_height; ?>px;">
		
		<?php foreach( $slide_list as $slide ): ?>

			<div class="slide" style="max-height: <?php echo $slide_height; ?>px;">
				
				<?php if( $full_width ): ?>
					<div class="container">
				<?php endif; ?>
					
					<?php if( $slide['stack_title'] || $slide['short_desc_text'] ): ?>
					<div class="slide-content slide-content-<?php echo $slide['desc_box_position']; ?>">
						<div class="slide-desc">
							
							<?php if( $slide['stack_title'] ): ?>
								<div class="slide-title"><?php echo $slide['stack_title']; ?></div>
							<?php endif; ?>

							<?php if( $slide['short_desc_text'] ): ?>
								<p><?php echo $slide['short_desc_text']; ?></p>
							<?php endif; ?>
							
							<?php if( $slide['button_text'] ): ?>
								<p><a href="<?php echo do_shortcode($slide['button_url']); ?>" class="button-primary"><?php echo do_shortcode($slide['button_text']); ?></a></p>
							<?php endif; ?>
							
						</div>
					</div>
					<?php endif; ?>
				
				<?php if( $full_width ): ?>
					</div>
				<?php endif; ?>

				<?php if( !$full_width ): ?>
					<?php echo gen_responsive_image_block( $slide['image'], array(
							array( 'width' => 450, 'height' => $slide_height*450/940, 'crop' => true, 'media' => '(max-width: 767px)' ),
							array( 'width' => 450*2, 'height' => $slide_height*2*450/940, 'crop' => true, 'media' => '(max-width: 767px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
							array( 'width' => 724, 'height' => $slide_height*724/940+$slide_parallax_distance, 'crop' => true, 'media' => '(min-width: 768px)' ),
							array( 'width' => 724*2, 'height' => ($slide_height*724/940+$slide_parallax_distance)*2, 'crop' => true, 'media' => '(min-width: 768px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
							array( 'width' => 940, 'height' => $slide_height+$slide_parallax_distance, 'crop' => true, 'media' => '(min-width: 980px)' ),
							array( 'width' => 940*2, 'height' => ($slide_height+$slide_parallax_distance)*2, 'crop' => true, 'media' => '(min-width: 980px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
						) 
					); ?>
				<?php else: ?>
					<?php echo gen_responsive_image_block( $slide['image'], array(
							array( 'width' => 450, 'height' => $slide_height*450/1200, 'crop' => true, 'media' => '(max-width: 767px)' ),
							array( 'width' => 450*2, 'height' => $slide_height*2*450/1200, 'crop' => true, 'media' => '(max-width: 767px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
							array( 'width' => 980, 'height' => $slide_height*980/1200+$slide_parallax_distance, 'crop' => true, 'media' => '(min-width: 768px)' ),
							array( 'width' => 980*2, 'height' => ($slide_height*980/1200+$slide_parallax_distance)*2, 'crop' => true, 'media' => '(min-width: 768px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
							array( 'width' => 1200, 'height' => $slide_height+$slide_parallax_distance, 'crop' => true, 'media' => '(min-width: 980px)' ),
							array( 'width' => 1200*2, 'height' => ($slide_height+$slide_parallax_distance)*2, 'crop' => true, 'media' => '(min-width: 980px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
						) 
					); ?>
				<?php endif; ?>


			</div>

		<?php endforeach; ?>

	</div>
</div>
</div><!-- .stack-slider -->

<?php endif; ?>