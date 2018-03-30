<?php
global $theme_options;
?>
	<?php
	//	Homepage Slideshow
	if ( '' <> $theme_options['slider'] && isset($theme_options['slider_enabled']) ) {

		// Get Slides
		$slides = array();
		foreach ($theme_options['slider']['title'] as $k => $v) {
			$slides[] = array(
				'title' => $v,
				'link' => $theme_options['slider']['link'][$k],
				'caption' => $theme_options['slider']['caption'][$k],
				'image' => $theme_options['slider']['image'][$k],
				'button' => $theme_options['slider']['button'][$k]
			);
		} ?>
		<div id="featured" class="container">
		<div id="featured-inside" class="laptop-slider">
			<img src="<?php echo get_template_directory_uri() . '/images/laptop.png'; ?>" id="laptop-image" alt="laptop-image" />
			<div id="laptop-slider-inside">
			<div class="flexslider home-slider flexlaptop">
		        <ul class="slides">

		<?php		foreach ( $slides as $slide ) { ?>
						<li>
						<?php if ( ! empty ($slide['link'] ) ) { ?>
							<a href="<?php echo $slide['link']; ?>">
						<?php } ?>
							<div class="slide <?php if ( ! $slide['title']) echo "slide-no-title" ?>">
								<img src="<?php echo $slide['image'] ?>" title="<?php echo $slide['title']; ?>" alt="slider image"/>
								
								<?php if ( $slide['title'] || $slide['caption'] || $slide['button'] ) { ?>
										<div class="flex-caption">
											<div class="caption-wrap container">
										<?php if ( $slide['title'] ) { ?>
											<h2 class="home-slide-title">
												<?php echo $slide['title']; ?>
											</h2>
										<?php } ?>

										<?php if ( $slide['caption'] ) {
											echo '<p class="slider-caption">'.$slide['caption'].'</p>'; 
										} ?>
											
											</div>
										</div>
								<?php } ?>
							</div>
							<?php if ( ! empty ($slide['link'] ) ) { ?>
								</a>
							<?php } ?>
						</li>
		<?php		} ?>
				</ul> <!-- .slides -->	
			</div> <!-- .flexslider -->
			</div> <!-- #laptop-slider-inside -->
		</div>
		</div>
	<?php } 
	//	End Homepage Slider ?>