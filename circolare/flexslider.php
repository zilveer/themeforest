		
		<?php global $slides; if(!empty($slides)) { ?>
		<div id="flexslider-wrapper" class="content-wrapper">
			<div class="flexslider">
				<ul class="slides">
					<?php foreach($slides as $num => $slide) { 
					?><!-- slide item -->
					<li data-thumb="<?php echo aq_resize($slide['src'], 90, 90, true) ?>">
						<div class="slider1-promo-left">								
							<h2 class="flex-slidertitle"><?php echo do_shortcode($slide['title']) ?></h2>
							<h2><?php echo do_shortcode($slide['subtitle']) ?></h2>
							
							<h4><?php echo do_shortcode($slide['caption']) ?></h4>
							<p><a href="<?php echo $slide['link'] ?>" class="button red-submit-button"><?php echo $slide['linktext'] ?></a></p>							
						</div>
						<div class="slider-big-image">
							<img src="<?php echo $slide['src'] ?>"/>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>		
		<script type="text/javascript">
		/*global jQuery:false */
		jQuery(document).ready(function($) {	
			"use strict";
			// Flexslider
			$('.flexslider').flexslider({
				animation: "slide",
				<?php if(of_get_option('autoplay', true)) { ?>slideshow: true, slideshowSpeed: <?php echo of_get_option('autoplay_timer', '7000'); ?>,<?php } else { ?>slideshow: false, <?php } ?>
				controlNav: "thumbnails",
				controlsContainer: '.flexslider-container'
			});
		});
		</script>
		<?php } ?>