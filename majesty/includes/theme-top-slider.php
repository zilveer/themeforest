<?php
function sama_before_top_menu_add_slider() {
	global $majesty_allowed_tags;
	
	if( ! is_page_template('page-templates/page-builder.php') && ! is_page_template('page-templates/page-blank.php') ) {
		return;
	}
	
	$page_id = sama_get_current_page_id();
	$slider_type = get_post_meta( $page_id, '_sama_slider_type', true );
	if( empty( $slider_type ) ) {
		return;
	} elseif( $slider_type == 'skipper' ) {
		
		$default = array(
			'type' 			=> 'fullheight',
			'transition' 	=> 'fade',
			'speed' 		=> 500,
			'arrows' 		=> 'true',
			'autoplay' 		=> 'true',
			'duration' 		=> 5000,
			'hideprev'		=> 'false',
			'navtype'		=> 'block',
		);
		
		$skp_setting = get_post_meta( $page_id, '_sama_skipper_settings', true );
		$skp_setting = wp_parse_args( $skp_setting[0], $default );			
		$skipper_slides = get_post_meta( $page_id, '_sama_skipper_slides', true );
		if( ! empty( $skipper_slides ) ) {
			$attr = ' data-transition='. $skp_setting['transition'] .' data-speed='. $skp_setting['speed'] .' data-arrows='. $skp_setting['arrows'] .' data-navtype='. $skp_setting['navtype'] .' data-autoplay='. $skp_setting['autoplay'] .' data-duration='. $skp_setting['duration'] .' data-hideprev='. $skp_setting['hideprev'] .'';
			$css_slider = 'fullheight';
			$transparent_css = ' fullheight ';
			if( $skp_setting['type'] == 'fullwidth' ) {
				$css_slider = 'slider-fullwidth';
				$transparent_css = '';
			}
			if( $skp_setting['arrows'] == 'false' ) {
				$css_slider .= ' hide-navigation';
			} ?>
				<section id="top-skipper-slider" class="skipper-slider top-slider clearfix"<?php echo esc_attr($attr); ?>>
					<div id="skipper-slider" class="<?php echo esc_attr( $css_slider); ?> dark skippr theme-skipper-slider">
						
						<?php foreach ( $skipper_slides as $slide ) { ?>
							<?php if( ! empty( $slide['image'] ) ) { ?>
								<div  style="background-image: url(<?php echo esc_url($slide['image']); ?>);">
							<?php } else { ?>
								<div>
							<?php } ?>
								<?php if( ! empty( $slide['overlay'] ) ) { ?>
									<div class="bg-transparent <?php echo esc_attr( $transparent_css ) . esc_attr( $slide['overlay'] ); ?>">
								<?php } ?>
									<?php
										if( isset( $slide['content'] ) ) {
											$content = do_shortcode( force_balance_tags( $slide['content'] ) );
											echo wp_kses( $content, $majesty_allowed_tags  );
										}
									?>
								<?php if( ! empty( $slide['overlay'] ) ) { ?>
									</div>
								<?php } ?>
								</div>
						<?php } ?>
					</div>
				</section>
				
<?php
		}
	} elseif ( $slider_type == 'bgndgallery' ) {
		// Background Slider see jquery.mb.bgndGallery
		$bg_args = get_post_meta( $page_id, '_sama_bgslider_settings', true );
		$bg_args = $bg_args[0];
		if( ! isset( $bg_args['images'] ) || ! is_array( $bg_args['images'] ) ) {
			return;
		}
		$transition = isset( $bg_args['transition'] ) ? $bg_args['transition'] : 'zoom' ;
		$timer 		= isset( $bg_args['timer'] ) ? $bg_args['timer'] : 1000;
		$efftimer 	= isset( $bg_args['efftimer'] ) ? $bg_args['efftimer'] : 15000;
		$overlay 	= isset( $bg_args['overlay'] ) ? $bg_args['overlay'] : '';
		$content 	= isset( $bg_args['content'] ) ? $bg_args['content'] : '';
		$images 	= $bg_args['images'];
		$attr 		= ' data-transition='. esc_attr( $transition ) .' data-timer='. absint( $timer ) .' data-efftimer='. absint( $efftimer ) .'';
		foreach ( $images as $key => $value ) {
		}
?>		
			<section id="top-page-slider" class="zooming-slider dark fullheight top-slider bgndgalleryslider text-center">
					<?php if( ! empty( $overlay ) ) { ?>
						<div class="bg-transparent fullheight <?php echo esc_attr( $overlay ); ?>">
					<?php } ?>
							<ul class="bbgndgallery-images"<?php echo esc_attr( $attr ); ?>>
								<?php foreach ( $images as $key => $value ) { ?>
									<li><img src="<?php echo esc_url( $value ); ?>" alt=""></li>
								<?php } ?>
							</ul>
							<?php
								if( isset( $content ) ) {
									$content = do_shortcode( force_balance_tags( $content ) );
									echo wp_kses( $content, $majesty_allowed_tags  );
								}
							?>
					<?php if( ! empty( $overlay ) ) { ?>
						</div>
					<?php } ?>
			</section>
<?php		
	} elseif( $slider_type == 'youtubebg' ) {
		// Youtube Background Slider
		$youtube_args = get_post_meta( $page_id, '_sama_youtube_settings', true );
		$youtube_args = $youtube_args[0];
		if( empty ( $youtube_args['url'] ) ) {
			return;
		}
		$attr 			= '';
		$autoplay 		= isset( $youtube_args['autoplay'] ) 		? $youtube_args['autoplay'] : 'true' ;
		$loop 			= isset( $youtube_args['loop'] ) 			? $youtube_args['loop'] : 'true';
		$mute 			= isset( $youtube_args['mute'] ) 			? $youtube_args['mute'] : 'true';
		$ratio 			= isset( $youtube_args['ratio'] ) 			? $youtube_args['ratio'] : 'auto';
		$quality 		= isset( $youtube_args['quality'] ) 		? $youtube_args['quality'] : 'default';
		$startat 		= isset( $youtube_args['startat'] ) 		? $youtube_args['startat'] : '';
		$stopat 		= isset( $youtube_args['stopat'] ) 			? $youtube_args['stopat'] : 'false';
		$showcontrols 	= isset( $youtube_args['showcontrols'] )	? $youtube_args['showcontrols'] : 'false';
		$overlay 		= isset( $youtube_args['overlay'] ) 		? $youtube_args['overlay'] : '';
		$content 		= isset( $youtube_args['content'] ) 		? $youtube_args['content'] : '';
		$poster 		= isset( $youtube_args['poster'] )  		?  $youtube_args['poster']: '';		
		$attr 			= ' data-video='. esc_url( $youtube_args['url'] ) .' data-mute='. esc_attr( $mute ) .' data-ratio='. esc_attr( $ratio ) .' data-quality='. esc_attr( $quality ) .' data-loop='. esc_attr( $loop ) .' data-autoplay='. esc_attr( $autoplay ) .' data-showcontrols='. esc_attr( $showcontrols ) .' data-start='. absint( $startat ) .' data-stop='. absint( $stopat ) .'';
		if( ! empty( $poster ) ) {
			$attr 		.= ' data-poster='. esc_url( $poster ) .'';
		}
?>
			<section id="top-yt-bg-player" class="fullheight yt-bg-player top-slider"<?php echo esc_attr( $attr ); ?>>
				<?php if( ! empty( $overlay ) ) { ?>
					<div class="bg-transparent fullheight <?php echo esc_attr( $overlay ); ?>">
				<?php } ?>
						<?php
							if( isset( $content ) ) {
								$content = do_shortcode( force_balance_tags( $content ) );
								echo wp_kses( $content, $majesty_allowed_tags  );
							}
						?>
				<?php if( ! empty( $overlay ) ) { ?>
					</div>
				<?php } ?>
			</section>
<?php		
		
	} elseif( $slider_type == 'vimeobg' ) {
		// Vimeo Background
		$vimeo_args = get_post_meta( $page_id, '_sama_vimeo_settings', true );
		$vimeo_args = $vimeo_args[0];
		if( empty ( $vimeo_args['url'] ) ) {
			return;
		}
		$autoplay 	= isset( $vimeo_args['autoplay'] ) 		? $vimeo_args['autoplay'] : 'true' ;
		$loop 		= isset( $vimeo_args['loop'] ) 			? $vimeo_args['loop'] : 'true';
		$volume 	= isset( $vimeo_args['volume'] ) 		? $vimeo_args['volume'] : 0;
		$overlay 	= isset( $vimeo_args['overlay'] ) 		? $vimeo_args['overlay'] : '';
		$content 	= isset( $vimeo_args['content'] ) 		? $vimeo_args['content'] : '';
		$poster 	= isset( $vimeo_args['poster'] )  		? $vimeo_args['poster']: '';
		
		$attr 		= ' data-video='. esc_url( $vimeo_args['url'] ) .' data-volume='. absint( $volume ) .' data-loop='. esc_attr( $loop ) .' data-autoplay='. esc_attr( $autoplay ) .'';
		if( ! empty( $poster ) ) {
			$attr 		.= ' data-poster='. esc_url( $poster ) .'';
		}
?>
			<section id="vimeo" class="vimeo fullheight dark clearfix top-slider"<?php echo esc_attr( $attr ); ?>>
				<?php if( ! empty( $overlay ) ) { ?>
					<div class="bg-transparent fullheight video-overlay <?php echo esc_attr( $overlay ); ?>">
				<?php } ?>
						<?php
							if( isset( $content ) ) {
								$content = do_shortcode( force_balance_tags( $content ) );
								echo wp_kses( $content, $majesty_allowed_tags  );
							}
						?>
				<?php if( ! empty( $overlay ) ) { ?>
					</div>
				<?php } ?>
			</section>

<?php
	} elseif( $slider_type == 'h5video' ) {
		$h5video = get_post_meta( $page_id, '_sama_h5video_settings', true );
		$h5video = $h5video[0];
		if( empty ( $h5video['mp4'] ) ) {
			return;
		}
		$autoplay 	= ( isset( $h5video['autoplay'] )	&& $h5video['autoplay'] == 'false' ) ? false : true;
		$loop 		= ( isset( $h5video['loop'] ) 		&& $h5video['loop'] 	== 'false' ) ? false : true;
		$muted 		= ( isset( $h5video['muted'] )		&& $h5video['muted'] 	== 'false' ) ? false : true;
		$controls 	= ( isset( $h5video['controls'] ) 	&& $h5video['controls'] == 'false' ) ? false : false;
		$overlay 	= isset( $h5video['overlay'] ) 		? $h5video['overlay'] : '';
		$content 	= isset( $h5video['content'] ) 		? $h5video['content'] : '';
		$poster 	= isset( $h5video['poster'] )  		? $h5video['poster']: '';
		$mb4  		= $h5video['mp4'];
		$webm 		= $h5video['webm'];
		$attr = '';
		if( $autoplay ) $attr  = 'autoplay';
		if( $loop ) 	$attr .= ' loop';
		if( $muted ) 	$attr .= ' muted';
		if( $controls ) $attr .= ' controls';
?>	
			<section id="top-h5video" class="top-slider video-full dark fullheight">
				<?php if( ! empty( $overlay ) ) { ?>
					
				<?php } ?>
						<?php
							if( isset( $content ) ) {
								$content = do_shortcode( force_balance_tags( $content ) );
								echo wp_kses( $content, $majesty_allowed_tags  );
							}
						?>
						<div class="video-wrap">
							<video poster="<?php echo esc_url($poster);?>" preload="auto" <?php echo esc_attr( $attr ) ;?>>
								<source src="<?php echo esc_url($mb4); ?>" type='video/mp4' />
								<source src="<?php echo esc_url($webm); ?>" type='video/webm' />
							</video>
						</div>
			<?php if( ! empty( $overlay ) ) { ?>
					<div class="bg-transparent fullheight video-overlay <?php echo esc_attr( $overlay ); ?>"></div>
				<?php } ?>
		  </section>
<?php
	} elseif( $slider_type == 'fullscreenbg' ) {
		// Full Screen Background
		$fullbg		= get_post_meta( $page_id, '_sama_fullscreenbg_settings', true );
		$fullbg 	= $fullbg[0];
		if( empty ( $fullbg['image'] ) ) {
			return;
		}
		$overlay 	= isset( $fullbg['overlay'] ) 		? $fullbg['overlay'] : '';
		$content 	= isset( $fullbg['content'] ) 		? $fullbg['content'] : '';
?>
			<section id="top-fullscreenbg" class="dark top-slider clearfix">
				<div class="fullheight full-bg full-screen-bg">
					<?php if( ! empty( $overlay ) ) { ?>
						<div class="bg-transparent fullheight <?php echo esc_attr( $overlay ); ?>">
					<?php } ?>
						<?php
							if( isset( $content ) ) {
								$content = do_shortcode( force_balance_tags( $content ) );
								echo wp_kses( $content, $majesty_allowed_tags  );
							}
						?>
					<?php if( ! empty( $overlay ) ) { ?>
						</div>
					<?php } ?>
				</div>
			</section>

<?php
	} elseif( $slider_type == 'movementbg' ) {
		// Background Movement
		$movebg		= get_post_meta( $page_id, '_sama_movementbg_settings', true );
		$movebg 	= $movebg[0];
		if( empty ( $movebg['image'] ) ) {
			return;
		}
		$overlay 	= isset( $movebg['overlay'] ) 		? $movebg['overlay'] : '';
		$content 	= isset( $movebg['content'] ) 		? $movebg['content'] : '';
?>
			<section id="top-movementbg" class="move-bg fullheight dark clearfix top-slider">
				<?php if( ! empty( $overlay ) ) { ?>
					<div class="bg-transparent fullheight <?php echo esc_attr( $overlay ); ?>">
				<?php } ?>
					<?php
						if( isset( $content ) ) {
							$content = do_shortcode( force_balance_tags( $content ) );
							echo wp_kses( $content, $majesty_allowed_tags  );
						}
					?>
				<?php if( ! empty( $overlay ) ) { ?>
					</div>
				<?php } ?>
			</section>

<?php
	} elseif( $slider_type == 'interactivebg' ) {
		// Interactive Movement
		$activebg		= get_post_meta( $page_id, '_sama_interactivebg_settings', true );
		$activebg 	= $activebg[0];
		if( empty ( $activebg['image'] ) ) {
			return;
		}
		$overlay 		= isset( $activebg['overlay'] ) 		? $activebg['overlay'] : '';
		$content 		= isset( $activebg['content'] ) 		? $activebg['content'] : '';
		$strength 		= isset( $activebg['strength'] ) 		? $activebg['strength'] : 25;
		$scale 			= isset( $activebg['scale'] ) 			? $activebg['scale'] : 1.05;
		$animationspeed = isset( $activebg['animationspeed'] ) 	? $activebg['animationspeed'] : "100ms";
		$attr 			= ' data-strength='. absint( $strength ) .' data-scale='. is_numeric( $scale ) .' data-animationspeed='. esc_attr( $animationspeed ) .'';
?>
			<section id="top-interactivebg" class="interactive-bg dark fullheight clearfix top-slider" <?php echo $attr;?>>
				<div class="wrapper-bg bg" data-ibg-bg="<?php echo esc_url($activebg['image']); ?>">
					<?php if( ! empty( $overlay ) ) { ?>
						<div class="bg-transparent fullheight <?php echo esc_attr( $overlay ); ?>">
					<?php } ?>
						<?php
							if( isset( $content ) ) {
								$content = do_shortcode( force_balance_tags( $content ) );
								echo wp_kses( $content, $majesty_allowed_tags  );
							}
						?>
					<?php if( ! empty( $overlay ) ) { ?>
						</div>
					<?php } ?>
				</div>
			</section>

<?php
	} elseif( $slider_type == 'parallaxbg' ) {
		// parallax Background
		$parallaxbg		= get_post_meta( $page_id, '_sama_parallaxbg_settings', true );
		$parallaxbg 	= $parallaxbg[0];
		if( empty ( $parallaxbg['image'] ) ) {
			return;
		}
		$overlay 		= isset( $parallaxbg['overlay'] ) 		? $parallaxbg['overlay'] 	: '';
		$content 		= isset( $parallaxbg['content'] ) 		? $parallaxbg['content'] 	: '';
		//$keyframes 		= isset( $parallaxbg['keyframes'] ) 	? $parallaxbg['keyframes'] 	: '';
?>
			<section id="top-parallaxbg" class="dark clearfix top-slider">
				<div id="bg-parallax-top" class="fullheight">
					<div class="bcg parallax-bg" data-anchor-target="#bg-parallax-top">
					<?php if( ! empty( $overlay ) ) { ?>
						<div class="bg-transparent fullheight <?php echo esc_attr( $overlay ); ?>">
					<?php } ?>
						<?php
							if( isset( $content ) ) {
								$content = do_shortcode( force_balance_tags( $content ) );
								echo wp_kses( $content, $majesty_allowed_tags );
							}
						?>
					<?php if( ! empty( $overlay ) ) { ?>
						</div>
					<?php } ?>
					</div>
				</div>
			</section>
		
<?php
	} elseif( $slider_type == 'swiper' ) {
		
		$default = array(
			'direction' 	=> 'horizontal',
			'effect' 		=> 'slide',
			'loop' 			=> 'true',
			'speed' 		=> 300,
			'arrows' 		=> 'true',
			'bullet' 		=> 'false',
		);
		$swiper_setting = get_post_meta( $page_id, '_sama_swiper_settings', true );
		$swiper_setting = wp_parse_args( $swiper_setting[0], $default );		
		$swiper_slides = get_post_meta( $page_id, '_sama_swiper_slides', true );
		if( ! empty( $swiper_slides ) ) {
			$attr = ' data-direction='. $swiper_setting['direction'] .' data-effect='. $swiper_setting['effect'] .' data-loop='. $swiper_setting['loop'] .' data-speed='. $swiper_setting['speed'] .' data-arrows='. $swiper_setting['arrows'] .' data-bullet='. $swiper_setting['bullet'] .'';
			?>
				<section id="slider-swiper" class="slider-parallax dark swiper_wrapper clearfix top-slider" <?php echo esc_attr($attr); ?>> <!---->
					<div class="swiper-container swiper-slider fullheight">
						<div class="swiper-wrapper">
							<?php foreach ( $swiper_slides as $slide ) { ?>
								<?php if( $slide['type'] != 'video' ) { ?>
									<?php ?>
									<div class="swiper-slide" style="background-image: url('<?php echo esc_url( $slide['image'] ); ?>');">
										<?php if( ! empty( $slide['overlay'] ) ) { ?>
										<div class="bg-transparent fullheight <?php echo esc_attr( $slide['overlay'] ); ?>">
										<?php } ?>
											<?php
											if( isset( $slide['content'] ) ) {
												$content = do_shortcode( force_balance_tags( $slide['content'] ) );
												echo wp_kses( $content, $majesty_allowed_tags );
											}	
											?>
										<?php if( ! empty( $slide['overlay'] ) ) { ?>
										</div>
										<?php } ?>
									</div>
								<?php } else { ?>
									<div class="swiper-slide">
										<?php
											if( isset( $slide['content'] ) ) {
												$content = do_shortcode( force_balance_tags( $slide['content'] ) ) ;
												echo wp_kses( $content, $majesty_allowed_tags  );
											}
										?>
										<div class="video-wrap">
											<video poster="<?php echo esc_url( $slide['image'] ); ?>" preload="auto" loop autoplay>
												<source src='<?php echo esc_url( $slide['mp4'] ); ?>' type='video/mp4' />
												<source src='<?php echo esc_url( $slide['webm'] ); ?>' type='video/webm' />
											</video>
											<?php if( ! empty( $slide['overlay'] ) ) { ?>
												<div class="video-overlay bg-transparent fullheight <?php echo esc_attr( $slide['overlay'] ); ?>"></div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
						<?php if( $swiper_setting['arrows'] == 'true' ) { ?>
							<?php if( ! is_rtl() ) { ?>
								<div id="slider-arrow-left" class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
								<div id="slider-arrow-right" class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
							<?php } else { ?>
								<div id="slider-arrow-left" class="swiper-button-prev"><i class="fa fa-angle-right"></i></div>
								<div id="slider-arrow-right" class="swiper-button-next"><i class="fa fa-angle-left"></i></div>
							<?php } ?>
						<?php } ?>
						<?php if( $swiper_setting['bullet'] == 'true' ) { ?>
							<div class="swiper-pagination"></div>
						<?php } ?>
					</div>
				</section>
<?php
		}
	}
}
add_action('sama_before_top_menu', 'sama_before_top_menu_add_slider');