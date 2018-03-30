<?php
	$post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'thumbnail');
?>

<?php if( !empty($post_featured_image) ) : ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="item-thumb">
		<span class="thb-overlay"></span>
		<img src="<?php echo $post_featured_image; ?>" alt="">
	</a>
<?php endif; ?>

<?php if( get_the_excerpt() != '' ) : ?>
	<div class="thb-text">
		<?php the_content(); ?>
	</div>
<?php endif; ?>