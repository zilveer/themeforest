<?php
/**
*  Single Page
 */
?>
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="contents-wrap float-left two-column">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


				<div class="entry-wrapper post-<?php echo $postformat; ?>-wrapper">
					
					<div class="entry-contents-wrapper">
					<?php get_template_part( 'includes/postformats/check-postformat' );	?>
					</div>
					
				</div>
				<?php //edit_post_link( __('edit this entry','mthemelocal') ,'<p class="edit-entry">','</p>'); ?>
				<?php comments_template(); ?>

			</div>
<?php endwhile; // end of the loop. ?>
</div>
<?php
get_sidebar();
get_footer();
?>