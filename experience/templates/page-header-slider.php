<?php
/**
 * Slider Page Header
 *
 * Slider page header template files.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

$slides = get_post_meta( $post->ID, 'experience_header_slides', true );

if (
	!empty( $slides[0]['background_image'] )
	|| !empty( $slides[0]['background_video'] )
	|| !empty( $slides[0]['label'] )
	|| !empty( $slides[0]['title'] )
) { ?>

	<?php // Set colour scheme
	if ( get_post_meta( $post->ID, 'experience_header_color_scheme', true ) != "" ) {	
		$header_color_scheme = 'color-scheme-'. get_post_meta( $post->ID, 'experience_header_color_scheme', true );
	} else {
		$header_color_scheme = 'color-scheme-3';
	} ?>

	<div class="section-header <?php echo esc_attr( $header_color_scheme ); ?>">
		
		<?php $start_at = get_post_meta( $post->ID, 'experience_header_slider_startat', true );
		$slideshow_speed = get_post_meta( $post->ID, 'experience_header_slider_slideshowspeed', true );
		$animation_speed = get_post_meta( $post->ID, 'experience_header_slider_animationspeed', true );
		
		if ( $start_at != '' ) {
			$start_at = 'data-flexslider-startat="'. esc_attr( $start_at ) .'" ';
		}
		
		if ( $slideshow_speed != '' ) {
			$slideshow_speed = 'data-flexslider-slideshowspeed="'. esc_attr( $slideshow_speed ) .'" ';
		}
		
		if ( $animation_speed != '' ) {
			$animation_speed = 'data-flexslider-animationspeed="'. esc_attr( $animation_speed ) .'" ';
		} ?>
	
		<!-- BEGIN .flexslider -->
		<div id="flexslider-<?php the_ID(); ?>" class="flexslider flexslider-big" <?php echo $start_at . $slideshow_speed . $animation_speed; ?>>	
			
			<ul class="slides">
				
				<?php foreach ( $slides as $slide ) {
					
					$parallax = $parallax_speed = $parallax_image = $video_bg_url = '';
					$attributes = array();
					$css_classes = array();
					
					$parallax = 'content-moving';
					
					if ( get_post_meta( $post->ID, 'experience_header_parallax_speed', true ) != '' ) {
						$parallax_speed = get_post_meta( $post->ID, 'experience_header_parallax_speed', true );
					} else {
						$parallax_speed = '1.5';
					}
					
					if ( get_post_meta( $post->ID, 'experience_header_parallax', true ) == 'on' ) {
					
						if ( !empty ( $slide['background_image'] ) ) {
							$parallax_image = esc_url( $slide['background_image'] );
						}
						
						if ( !empty ( $slide['background_video'] ) ) {
							$video_bg_url = esc_url( $slide['background_video'] );
						}
				
						$has_video_bg = ( ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

						if ( $has_video_bg ) {
							$parallax_image = $video_bg_url;
							$css_classes[] = ' vc_video-bg-container';
						}

						if ( ! empty( $parallax ) ) {						
							$attributes[] = 'data-vc-parallax="'. esc_attr( $parallax_speed ) .'"';
							$css_classes[] = 'vc_general vc_parallax vc_parallax-'. $parallax;
							$css_classes[] = 'js-vc_parallax-o-fixed';
						}

						if ( ! empty( $parallax_image ) ) {
							$attributes[] = 'data-vc-parallax-image="'. esc_url( $parallax_image ) .'"';
						}
						
						if ( ! $parallax && $has_video_bg ) {
							$attributes[] = 'data-vc-video-bg="'. esc_url( $video_bg_url ) .'"';
						}
					
					}

					// Set Slide colour scheme
					if ( !empty( $slide['color-scheme'] ) ) {
						$attributes[] = 'color-scheme-'. $slide['color-scheme'];
					} ?>
			
					<li class="<?php echo esc_attr( implode( ' ', $css_classes ) ); ?>" <?php echo implode( ' ', $attributes ); ?>>						
						
						<?php if (
							!empty ( $slide['background_image'] )
							&& ( 
								(
									!function_exists( 'vc_asset_url' )
									|| get_post_meta( $post->ID, 'experience_header_parallax', true ) != 'on'
								)
								|| (
									function_exists( 'vc_asset_url' )
									&& get_post_meta( $post->ID, 'experience_header_parallax', true ) == 'on'
									&& !empty ( $slide['background_video'] )
								)
							)
						) {
							experience_get_background( $slide['background_image'] );
						} ?>
						
						<div class="exp_ie-flexbox-fixer">
						
							<div class="exp-full-height exp-flexbox exp-content-middle">
								
								<div class="exp-flexbox-inner">
			
									<?php // Adjust padding to "centre" content in slider
									if ( empty( $slide['label'] ) && empty( $slide['subtitle'] ) ) {							
										$padding = '';							
									} else if ( !empty( $slide['label'] ) && empty( $slide['subtitle'] ) ) {
										$padding = 'no-padding-top';
									} else {
										$padding = '';							
									} ?>
									
									<!-- BEGIN .section-header-content -->
									<div class="section-header-content narrow-width padding-h <?php echo esc_attr( $padding ); ?>">
									
										<?php if ( !empty( $slide['label'] ) ) { ?>
											<span class="heading-label"><?php echo esc_html( $slide['label'] ); ?></span>
										<?php } ?>
			
										<?php if ( !empty( $slide['title'] ) ) { ?>
											<h1 class="heading-title"><?php echo experience_resize_text( $slide['title'] ); ?></h1>
										<?php } ?>									
									
									</div>											
									<!-- END .section-header-content -->
								
								</div>
								
							</div>
						
						</div>
						
						<?php if ( !empty( $slide['button_url'] ) && !empty( $slide['button_text'] ) ) {
							
							$fancybox_class = '';								
							
							// Detect lightbox content type
							$path_info = pathinfo( $slide['button_url'] );
							$url_info = parse_url( $slide['button_url'] );

							// MP4 / WEBM
							if (
								( isset( $path_info['extension'] ) && in_array( $path_info['extension'], array( 'mp4', 'webm' ) ) )
								|| (
									isset( $url_info['host'] )
									&& ( 
										$url_info['host'] == 'www.youtube.com' || $url_info['host'] == 'youtube.com' || $url_info['host'] == 'youtu.be'
										|| $url_info['host'] == 'www.vimeo.com' || $url_info['host'] == 'vimeo.com'
										|| $url_info['host'] == 'www.dailymotion.com' || $url_info['host'] == 'dailymotion.com'
									)
								)
							) {
								$fancybox_class = 'fancybox';
							} ?>
							
							<div class="slider-button-center">
								<a class="vc_btn3 <?php echo esc_attr( $fancybox_class ); ?>" href="<?php echo esc_url( $slide['button_url'] ); ?>"><?php echo esc_html( $slide['button_text'] ); ?></a>
							</div>
							
						<?php } ?>					
					
					</li>
					
				<?php } ?>				

			</ul>
	
		</div>
		<!-- END .flexslider -->
		
	</div>
	
<?php } ?>