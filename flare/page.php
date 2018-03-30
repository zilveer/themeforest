<?php
/**
 * The full width (default) template for displaying a single page.  
 * 
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>
<?php the_post(); ?>

	<?php get_template_part( 'precontent' ); ?>
	
	<div id="content" class="<?php echo btp_content_get_class(); ?>">
		<div id="content-inner">
			<?php if ( btp_elements_get( 'breadcrumbs' ) ): ?>
				<?php btp_breadcrumbs_render( btp_breadcrumbs_get() ); ?>
			<?php endif; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php btp_wp_link_pages(); ?>
				</div><!-- .entry-content -->
					
				<div class="entry-utility">		
					<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-utility -->				
				
				<?php comments_template( '', true ); ?>
			</article>
			
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->
	
<?php get_footer(); ?>