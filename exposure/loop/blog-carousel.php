<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post(); ?>
	<?php thb_post_before(); ?>
	<?php
		$post_id = get_the_ID();
		$post_classes[] = 'blog_d';
	?>

	<article id="post-<?php echo $post_id; ?>" <?php post_class($post_classes); ?> data-pager="<?php echo add_query_arg("paged", get_query_var("paged") + 1); ?>">
		<?php thb_post_start(); ?>

		<?php get_template_part( 'loop/formats/carousel-' . thb_get_post_format() ); ?>

		<?php thb_post_end(); ?>
	</article>

	<?php thb_post_after(); ?>
<?php $i++; endwhile; ?>

<?php else : ?>

	<div class="notice warning">
		<p><?php _e('Sorry, there aren\'t posts to be shown!', 'thb_text_domain'); ?></p>
	</div>

<?php endif; ?>