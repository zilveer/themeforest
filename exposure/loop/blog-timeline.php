<?php
	thb_post_query(array(
		'ignore_sticky_posts' => 1,
		'posts_per_page' => 1
	));
?>


<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post(); ?>
	<?php thb_post_before(); ?>
	<?php
		$post_id = get_the_ID();
		$post_classes[] = 'blog_a';
	?>

<div class="thb-hentry-wrapper">
	<article id="post-<?php echo $post_id; ?>" <?php post_class($post_classes); ?> data-fullbackground="<?php echo thb_get_featured_image(); ?>">
		<?php thb_post_start(); ?>

		<?php get_template_part( 'loop/formats/timeline-' . thb_get_post_format() ); ?>

		<?php thb_post_end(); ?>
	</article>
</div>

	<?php thb_post_after(); ?>
<?php $i++; endwhile; ?>

<?php else : ?>

	<div class="notice warning">
		<p><?php _e('Sorry, there aren\'t posts to be shown!', 'thb_text_domain'); ?></p>
	</div>

<?php endif; ?>

<?php thb_pagination( array( 'type' => 'links' ) ); ?>