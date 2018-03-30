<?php
/**
 * Template Name: Squeeze Page
 *
 * @package Mysitemyway
 * @subpackage Template
 */
global $mysite;
get_header(); ?>

<?php if( isset( $mysite->is_blog ) ) : ?>
	
	<?php get_template_part( 'loop', 'index' ); ?>
	
<?php else : ?>
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
			<?php mysite_before_entry(); ?>
			
			<div class="entry">
				<?php the_content(); ?>
				
				<div class="clearboth"></div>
				
				<?php wp_link_pages( array( 'before' => '<div class="page_link">' . __( 'Pages:', MYSITE_TEXTDOMAIN ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', MYSITE_TEXTDOMAIN ), '<div class="edit_link">', '</div>' ); ?>
				
				</div><!-- .entry -->
							
			<?php mysite_after_entry(); ?>

		</div><!-- #post-## -->
		
	<?php endwhile; ?>
	
<?php endif; ?>

	<?php mysite_after_page_content(); ?>
	
		<div class="clearboth"></div>
	</div><!-- #main_inner -->
</div><!-- #main -->

<?php get_footer(); ?>