<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );


if ( $images == '' ) return null;

$id = uniqid();

$direction = $direction == 'horizontal' ? 'slide' : 'vertical_slide';

?>

<div class="mk-swipe-slideshow mk-slider">
	<div id="mk-swiper-<?php echo $id; ?>" class="mk-swiper-container <?php echo $el_class; ?> js-el"
			data-mk-component='SwipeSlideshow'
			data-swipeSlideshow-config='{
				"effect" : "<?php echo $direction ?>",
				"displayTime" : "<?php echo $slideshow_speed ?>",
				"transitionTime" : "<?php echo $animation_speed ?>",
				"nav" : ".mk-swipe-slideshow-nav-<?php echo $id ?>",
				"hasNav" : "<?php echo $direction_nav; ?>" }'>

		<div class="mk-swiper-wrapper mk-slider-holder">
			<?php
			$images = explode( ',', $images );
			foreach ( $images as $attach_id ) {
				

				$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive($attach_id, $image_size, $image_width, $image_height, $crop = true, $dummy = true);

				if(!empty($attach_id)) {
					?>

					<div class="swiper-slide mk-slider-slide">
						<img alt="<?php echo trim(strip_tags( get_post_meta($attach_id, '_wp_attachment_image_alt', true) )); ?>" 
							 src="<?php echo $featured_image_src['dummy']; ?>" 
							 <?php echo $featured_image_src['data-set']; ?> 
							 width="<?php echo $image_width; ?>" 
							 height="<?php echo $image_height; ?>" />
					</div>

					<?php 
				} ?>
			<?php } ?>

		</div>

		<?php if( $direction_nav == 'true' ) { ?>
		<div class="mk-swipe-slideshow-nav-<?php echo $id ?>">
			<a class="mk-swiper-prev swiper-arrows" data-direction="prev"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-left'); ?></a>
			<a class="mk-swiper-next swiper-arrows" data-direction="next"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-right'); ?></a>
		</div>
		<?php } ?>

		<!-- empty PNG to stretch slider and make it responsive outside of js as the slider adjusts height and width to container sizes  -->
		<img src="<?php echo Mk_Image_Resize::generate_dummy_image($image_width, $image_height, true); ?>" class="mk-slider-holder-img" />

	</div>
</div>