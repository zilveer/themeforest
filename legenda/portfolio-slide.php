<?php 
$postId = get_the_ID();

$categories = wp_get_post_terms($postId, 'categories');
$catsClass = '';
foreach($categories as $category) {
	$catsClass .= ' sort-'.$category->slug;
}

$columns = etheme_get_option('portfolio_columns');
$lightbox = etheme_get_option('portfolio_lightbox');


?>
<div class="portfolio-item slide-item <?php echo $catsClass; ?>">        
	<div class="portfolio-image">
		<?php if (has_post_thumbnail( $postId ) ): ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(540,540) ); ?>
			<img src="<?php echo $image[0]; ?>" />	
		<?php endif; ?>

		<div class="portfolio-mask">
			<div class="mask-content">
				<?php if($lightbox): ?><a href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>" rel="lightbox"><i class="icon-resize-full"></i></a><?php endif; ?>
				<a href="<?php the_permalink(); ?>"><i class="icon-link"></i></a>
			</div>
		</div>
    </div>
    
	<?php if(etheme_get_option('project_name')): ?>
		<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    <?php endif; ?>
    
	<?php if(etheme_get_option('project_excerpt')): ?>
		<?php the_excerpt(); ?>
    <?php endif; ?>
</div>