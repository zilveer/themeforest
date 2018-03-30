<?php

$showSlider = get_option('tb_gallery_featured_slider', DEFAULT_SHOW_GALLERY_SLIDER);

if ($showSlider < 2) {
	
	$numberOfPhotosInSlider = get_option('tb_gallery_featured_slider_number', DEFAULT_GALLERY_SLIDER_NUMBER);
	
	$args = array();
	
	$args['post_type'] = 'photo';
	$args['post_status'] = 'publish';
	$args['posts_per_page'] = $numberOfPhotosInSlider;
	$args['orderby'] = 'rand';
	$args['meta_query'] = array(
		array(
			'key'		=> '_featured',
			'value'		=> '1',
			'compare'	=> '='
		)
	);
	
	$tbQuery = new WP_Query($args);
	
	?>

    <?php if ($tbQuery->have_posts()) { ?>
	
	
	<div id="slider">
		<div class="slides_container">
	
			<?php while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>
				
				<?php $postID = get_the_ID(); $postTitle = get_the_title(); ?>
	        	<div class="slide">
					<?php $imageFull = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'full'); ?>
	                <a href="<?php echo $imageFull[0]; ?>" title="<?php echo $postTitle; ?>">
						<?php echo get_the_post_thumbnail($page->ID, 'gallerySlider', array('alt' => $postTitle)); ?>
	                </a>
	            </div>
			<?php endwhile; ?>
		</div>
	</div>
	
	<div class="horShadow"></div>
    
    <?php } ?>
	
	<?php
		$effect = get_option('tb_gallery_slider_effect', DEFAULT_GALLERY_SLIDER_EFFECT);
		$useEasingEffect = get_option('tb_gallery_slider_use_easing', DEFAULT_GALLERY_USE_EASING);
		$easingEffect = get_option('tb_gallery_slider_easing', DEFAULT_GALLERY_SLIDER_EASING);
	?>
	<script type="text/javascript">	
		jQuery(document).ready(function($) {
			$("#gallery #slider").slides({
				effect: "<?php echo $effect; ?>",
				generateNextPrev: false,
				generatePagination: true,
				paginationClass: 'slider_pagination',
				<?php echo $effect; ?>Speed: <?php echo get_option('tb_gallery_slider_speed', DEFAULT_GALLERY_SLIDER_SPEED); ?>,
				play: <?php echo get_option('tb_gallery_slider_autoplay', DEFAULT_GALLERY_SLIDER_AUTOPLAY); ?>,
				<?php if ($useEasingEffect =='yes') { echo $effect; ?>Easing: "<?php echo $easingEffect; ?>" <?php } ?>
			});
		});
	</script>
    
    <?php wp_reset_postdata();

}

?>