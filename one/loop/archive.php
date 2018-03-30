<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post(); ?>
	<?php global $more; $more = 0; ?>
	
	<?php thb_loop_post_before(); ?>
	<?php
		$thb_post_id = get_the_ID();

		$thb_post_classes = thb_get_post_classes( $i, array('item list'), 2 );
		$thb_post_classes[] = 'classic';
	?>

	<div id="post-<?php echo $thb_post_id; ?>" <?php post_class($thb_post_classes); ?>>
		<?php thb_loop_post_start(); ?>
		<?php thb_get_template_part( 'loop/formats/classic', array( 'thb_thumb_size' => 'medium' ) ); ?>
		<?php thb_loop_post_end(); ?>
	</div>

	<?php thb_loop_post_after(); ?>
<?php $i++; endwhile; ?>

<?php else : ?>

	<div class="notice warning">
		<p><?php _e('Sorry, there aren\'t posts to be shown! Perhaps searching will help.', 'thb_text_domain'); ?></p>
		
		<?php get_search_form(); ?>
		<script type="text/javascript">
			// focus on search field after it has loaded
			document.getElementById('s') && document.getElementById('s').focus();
		</script>
	</div>

<?php endif; ?>

<?php thb_numeric_pagination(); ?>