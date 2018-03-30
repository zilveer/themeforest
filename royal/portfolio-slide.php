<?php 
$postId = get_the_ID();

$categories = wp_get_post_terms($postId, 'categories');
$catsClass = '';
if(!is_wp_error( $categories )) {
	foreach($categories as $category) {
		$catsClass .= ' sort-'.$category->slug;
	}
}

$columns = etheme_get_option('portfolio_columns');
$lightbox = etheme_get_option('portfolio_lightbox');


?>

<div class="slide-item post-slide thumbnails-x <?php echo $catsClass; ?>">
	<div class="post-news">
		<?php if (has_post_thumbnail( $postId ) ): ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(540,540) ); ?>
			<img src="<?php echo $image[0]; ?>" />	
			<div class="zoom">
				<div class="btn_group">
				<?php if($lightbox): ?><a href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>" class="btn btn-black xmedium-btn" rel="lightbox"><span><?php _e('View large', ETHEME_DOMAIN); ?></span></a><?php endif; ?>
					<a href="<?php the_permalink(); ?>" class="btn btn-black xmedium-btn"><span><?php _e('More details', ETHEME_DOMAIN); ?></span></a>
				</div>
				<i class="bg"></i>
			</div>
		<?php endif; ?>
	</div>
	<div class="caption">
		<h5 class="active"><?php print_item_cats($postId); ?></h5>
		<?php if(etheme_get_option('project_name')): ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	    <?php endif; ?>
		<?php if(etheme_get_option('project_excerpt')): ?>
			<?php the_excerpt(); ?>
	    <?php endif; ?>
	</div>
</div><!-- slide-item -->