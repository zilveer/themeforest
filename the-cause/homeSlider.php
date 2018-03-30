<?php

$tb_slider_order_of_slides = get_option('tb_slider_order_of_slides', DEFAULT_HOME_CUSTOM_SLIDES_ORDER);
	
	$searchArgs = array();
	$searchArgs['post_type'] = 'slide';
	
	if ($tb_slider_order_of_slides == 'menu') {
		$searchArgs['orderby'] = 'menu_order';
		$searchArgs['order'] = 'ASC';
	} else {
		$searchArgs['orderby'] = 'rand';
	}

?>

<?php $customSearch = new WP_Query($searchArgs); ?>

<?php if ($customSearch->have_posts()) { ?>
            <!-- Slider -->
            <div id="slider">
                <div class="slides_container">

<?php while ($customSearch->have_posts()) : $customSearch->the_post(); ?>

                    <div class="slide">
					
					<?php
					$postID = get_the_ID();
					$postTitle = get_the_title($postID);
					$url = get_post_meta($postID, '_url', true);
					if (!$url) $url = get_permalink(get_post_meta($postID, '_page_url', true));
					?>

					<?php $postThumbnail = tb_get_thumbnail($postID, 'homeSlider'); ?>

                        <?php echo $postThumbnail; ?>
                        
                        <a href="<?php echo $url; ?>"><?php echo $postTitle; ?></a>
                        
                        <div class="content">
						<h2><?php echo $postTitle; ?></h2>
                        <?php $slideContent = get_the_content(); echo apply_filters('the_content', $slideContent)?>
                        </div>
						
                    </div>

<?php endwhile; ?>

                </div>
            </div>
            <!-- .Slider -->
            
            <div class="clear"></div>
<?php } ?>
	
<?php
	$effect = get_option('tb_home_slider_effect', DEFAULT_HOME_SLIDER_EFFECT);
	$useEasingEffect = get_option('tb_home_slider_use_easing', DEFAULT_HOME_SLIDER_USE_EASING);
	$easingEffect = get_option('tb_home_slider_easing', DEFAULT_HOME_SLIDER_EASING);
?>

<script type="text/javascript">	
	jQuery(document).ready(function($) {
		$("#home #slider").slides({
			effect: "<?php echo $effect; ?>",
			generateNextPrev: false,
			generatePagination: true,
			paginationClass: 'slider_pagination',
			<?php echo $effect; ?>Speed: <?php echo get_option('tb_home_slider_speed', DEFAULT_HOME_SLIDER_SPEED); ?>,
			play: <?php echo get_option('tb_home_slider_autoplay', DEFAULT_HOME_SLIDER_AUTOPLAY); ?>,
			<?php if ($useEasingEffect =='yes') { echo $effect; ?>Easing: "<?php echo $easingEffect; ?>" <?php } ?>
		});
	});
</script>
    
<?php wp_reset_postdata(); ?>

