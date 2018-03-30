<?php
/**
 * Template Name: Page: Full Width
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-full-width clearfix' ); ?>> 
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<!-- entry-content --> 
	</article>
	<!-- sd-full-width -->
<?php endwhile; else: ?>
	<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
<?php endif; ?>

<?php get_footer(); ?>