<?php
/**
 * Template Name: Page: Right Nav
 *
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>
	<?php the_post(); ?>
	<?php get_template_part( 'precontent' ); ?>
	
	<div id="content">
		<div id="content-inner" class="<?php echo btp_content_get_class(); ?>">
			<?php if ( btp_elements_get( 'breadcrumbs' ) ): ?>
				<?php btp_breadcrumbs_render( btp_breadcrumbs_get() ); ?>
			<?php endif; ?>
		
			<div class="grid">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-three-fourth' ); ?>>													
					<div class="entry-content">						
						<?php the_content(); ?>
						<?php btp_wp_link_pages(); ?>
					</div><!-- .entry-content -->
					
					<div class="entry-utility">		
						<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
					
					<?php comments_template( '', true ); ?>
				</article>
				
				<aside class="c-one-fourth sidebar after">
					<div class="helper"></div>
					<div class="inner">
						<?php get_template_part( 'page_nav' ); ?>
					</div>
					<div class="helper"></div>
				</aside>
			</div>
				
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->
		
<?php get_footer(); ?>