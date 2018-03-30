<!-- Audio Start -->
		<div class="col-lg-12">
				<!-- This line has to be one line, or else my :empty selector wont work, stupid css3 -->
				<div class="wish-audio animated" data-animation="fadeInUp" data-animation-delay="100"><?php echo do_shortcode('[audio src="'.get_post_meta($post->ID, 'wish_audio', true).'"]'); ?></div>
		</div>
								<!-- Audio Ends -->