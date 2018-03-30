<?php get_header(); ?>
<?php 
	wp_reset_query();
	$price = get_post_meta ($post->ID, THEME_NAME."_price", true );
	$marketplace = get_post_meta ($post->ID, THEME_NAME."_marketplace", true );
	$demo = get_post_meta ($post->ID, THEME_NAME."_demo", true );
	$link = get_post_meta ($post->ID, THEME_NAME."_link", true );
	
	$singleImage = get_post_meta( $post->ID, THEME_NAME."_single_image", true );
	if(get_option(THEME_NAME."_show_single_thumb") == "on"  && $singleImage=="show" || !$singleImage) {
		$image = get_post_thumb($post->ID,940,500);
		$imageL = get_post_thumb($post->ID,940,0);
	} else {
		$image = false;
	}
	
	
?>

	<?php if (have_posts()) : ?>

			<div class="row">
				<?php if($image['show']==true) { ?>
					<div id="primary" class="eleven columns hover-image">
						<a class="fancybox" href="<?php echo $imageL['src'];?>"><img src="<?php echo $image['src'];?>" alt="<?php the_title(); ?>"></a>
					</div>
				<?php } ?>
				<div id="sidebar" class="five columns">
					<?php the_content();?>
				</div>
			</div>

	
		<?php else: ?>
			<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
		<?php endif; ?>
</div>
<?php get_footer(); ?>