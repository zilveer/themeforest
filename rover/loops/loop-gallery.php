<?php
/**
 * Gallery loop
 * @package by Theme Record
 * @auther: MattMao
 */
 ?>

<div class="gallery-list">
<ul class="clearfix">
<?php 
	while (have_posts()) : the_post();
	$title = get_the_title();
?>
	<li class="col-4-1">
	<?php if(has_post_thumbnail()) : ?>
	<div class="post-thumb post-thumb-hover post-thumb-preload">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="loader-icon">
	<?php echo get_featured_image($post_id=NULL, 'gallery-column', 'wp-preload-image', $title); ?>
	</a>
	</div>
	<?php endif; ?>
	</li>
<?php endwhile; ?>
</ul>
</div>