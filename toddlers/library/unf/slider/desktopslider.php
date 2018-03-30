<?php if( have_rows('slides') ): ?>
		<div id="homeslider">

		<?php // Slider Shortcode
		$unf_slider_shortcode = get_field('unf_slider_shortcode');
		if (!empty($unf_slider_shortcode)) {
		echo do_shortcode($unf_slider_shortcode);
		} else { // if shortcode is empty do defauly slider ?>

		<!--start desktop slider-->
			<div class="sliderloading sliderloading-desktop">
				<img src="<?php echo get_template_directory_uri(); ?>/library/img/loading.svg" alt="loading" height="32" width="32" data-no-retina="">
			</div>

			<div class="sliderloaded sliderloaded-desktop">
				<a href="#" class="left carousel-control hidden-xs swiper-button-prev"><?php _e("Previous", "toddlers");?></a>
				<a href="#" class="right carousel-control hidden-xs swiper-button-next"><?php _e("Next", "toddlers");?></a>
				<div class="swiper-container swiper-desktop">
				  <div class="swiper-wrapper">
					  <?php while( have_rows('slides') ): the_row();
							// vars
							$slide_image = get_sub_field('slide_image');
							$link = get_sub_field('link');
							$banner_text = get_sub_field('banner_text');
							$alt_text = get_sub_field('alt_text');


							$slidesize = 'homeslide';
							$slideresized = $slide_image['sizes'][ $slidesize ];

							?>
				      <!--First Slide-->
				      <div class="swiper-slide">
				        <?php if( $slide_image ): ?>

				        	<!-- Slide Image -->
							<?php if( $link ): ?>
							<a href="<?php echo esc_url($link); ?>">
							<?php endif; ?>
								<img src="<?php echo esc_url($slideresized) ?>" class="slideimage" alt="<?php
									if( $alt_text ): ?><?php echo esc_attr($alt_text); ?><?php endif; ?>">
							<?php if( $link ): ?>
							</a>
							<?php endif; ?>
							<!-- End Slide Image -->

							<!-- Slide Text -->

							<?php if( $banner_text ): ?>
								<div class="slide_banner_text">
								<?php if( $link ): ?>
									<a href="<?php echo esc_url($link); ?>">
								<?php endif; ?>
									<?php echo wp_kses( $banner_text, array(
										    'strong' => array(),
											'br' => array(),
										    'em' => array(),
										    'i' => array(),
										    'b' => array(),
										    'a' => array('href')
										) );
									?>
								<?php if( $link ): ?>
									</a>
								<?php endif; ?>
								</div>
							<?php endif; ?>

							<!-- End Slide Text -->

						<?php endif; ?>
				      </div>
					  <?php endwhile; ?>
				  </div>
				</div>
				<?php if( get_field('dots') ) { echo "<div class='pagination pagination-desktop hidden-xs'></div>"; } ?>

			</div>

			<script>
			jQuery('.sliderloaded-desktop').hide();
			jQuery(window).load(function() {
				"use strict";
				jQuery('.sliderloading-desktop').hide();
				jQuery('.sliderloaded-desktop').fadeIn();
				jQuery(function(){
			  var mySwiper = new Swiper ('.swiper-container.swiper-desktop', {
				     //Your options here:
				    <?php if( get_field('dots') ) { echo "pagination: '.pagination-desktop',"; } ?>
				    keyboardControl: <?php if( get_field('keys') ) { echo "true"; } else { echo "false";} ?>,
				    paginationClickable: true,
				    autoplay:<?php the_field('delay'); ?>,
				    speed:<?php the_field('speed'); ?>,
				    mode:'horizontal',
				    loop: true,
				    calculateHeight: true,
				    nextButton: '.swiper-button-next',
					prevButton: '.swiper-button-prev',
				  });

				})
			});
			</script>
			<!--end desktop slider-->
			<?php } //end if slidershortcode is empty ?>
		</div>
<?php else: ?>
	<!-- NO SLIDES ADDED TO PAGE -->
	<div id="homeslider">
		<img src="<?php echo get_template_directory_uri(); ?>/library/img/noslides.jpg" class="noslides">
	</div>
<?php endif; ?>