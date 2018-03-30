<?php
/**
 * @package berg-wp
 */
?>
<?php 
	if (has_post_thumbnail()) {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large_bg');
	}

	$post_meta = get_post_meta(get_the_id());

	$backgroundStyle = $color = '';
	$color = $post_meta['section_restaurant_color'][0];
	if (isset($post_meta['section_restaurant_color'][0])) {
		$backgroundStyle = 'style="background:'.$color.'; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; "';
	} else {
		$backgroundStyle = '';
	}
	
?>
<div class="item section" >
	<div <?php echo $backgroundStyle; ?> class="hidden-xs"></div>
	<div class="visible-xs mobile-img"><?php the_post_thumbnail('menu_thumb'); ?></div>
	<div class="container restaurant-content pre-content">
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 item__description">
				<?php the_title( sprintf( '<h1 class="entry-title">', esc_url( get_permalink() ) ), '</h1>' ); ?>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	
	<div class="restaurant-fullscreen bg-section hidden-xs" style="background-image: url(<?php echo $large_image_url[0] ?>); left: 0;"></div>
</div>