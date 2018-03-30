<?php
	/**
	 * Starting the loop
	 */
	$i=0;
	if( have_posts() ) : while( have_posts() ) : the_post();

	/**
	 * Retrieving post data
	 */
	$post_id     = get_the_ID();
	$post_format = get_post_format();
	$image       = thb_get_post_thumbnail_src($post_id, "thumbnail");
	$image_full  = thb_get_post_thumbnail_src($post_id, "full");
	$post_classes = thb_get_post_classes( $i, array('item list'), 2 );
?>
<?php // Post template ================================================================== ?>

<?php thb_post_before(); ?>

<article id="post-<?php echo $post_id; ?>" <?php post_class($post_classes); ?>>

	<?php thb_post_start(); ?>

	<?php get_template_part( 'loop/formats/classic-' . thb_get_post_format() ); ?>

	<?php thb_post_end(); ?>

</article>

<?php thb_post_after(); ?>

<?php $i++; endwhile; ?>

	<?php // Navigation between posts ======================================================= ?>


<?php else : ?>

	<?php // No posts found ============================================================= ?>

	<div class="notice warning">
		<p><?php _e("Sorry, there aren't posts to be shown!", 'thb_text_domain'); ?></p>
	</div>

<?php endif; ?>

<?php thb_pagination( array( 'type' => 'numbers' ) ); ?>