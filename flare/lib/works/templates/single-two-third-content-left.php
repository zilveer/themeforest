<?php
/**
 * The Template with the content on the left side for displaying single work.
 *
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>
	<?php the_post(); ?>
	<?php get_template_part( 'precontent' ); ?>
	<?php $elems = btp_elements_get(); ?>
	
	<div id="content" class="<?php echo btp_content_get_class(); ?>">
		<div id="content-inner">
			<?php if ( btp_elements_get( 'breadcrumbs' ) ): ?>
				<?php btp_breadcrumbs_render( btp_breadcrumbs_get() ); ?>
			<?php endif; ?>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
				<div class="grid">
					<div class="c-one-third">
						<?php if ( $elems['date'] || $elems['comments_link'] ): ?>
						<p class="meta entry-meta">					
							<?php 
								if ( $elems['date'] ) { btp_entry_render_date(); }
								if ( $elems['comments_link'] ) { btp_entry_render_comments_link(); }
							?>
						</p>
						<?php endif; ?>
					
						<div class="entry-content">
							<?php the_content(); ?>	
							<?php btp_wp_link_pages(); ?>			
						</div><!-- .entry-content -->
								
						<?php if ( $elems['categories'] || $elems['tags'] ): ?>
						<div class="meta entry-terms">					
							<?php 
								if ( $elems['categories'] ) { btp_entry_render_categories(); }
								if ( $elems['tags'] ) { btp_entry_render_tags(); }
							?>
						</div>
						<?php endif; ?>									
					
						<?php get_template_part( 'entry_nav' ); ?>
						
						
						<div class="entry-utility">		
							<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-utility -->
					</div>
					
					<div class="c-two-third">					
						<?php if ( $elems[ 'mediabox' ] ) { btp_entry_render_mediabox( 'two_third', $elems[ 'mediabox' ] ); } ?>
						
						<?php get_template_part( 'entry_sharebox' ); ?>
						
						<?php if ( $elems[ 'related_works' ] ): ?>
							<?php $out = do_shortcode( '[related_works max="4" template="one_fourth" hide="date, comments_link, summary, categories, tags, button_1"]' ); ?>
							<?php if ( strlen( $out ) ): ?>
								<div class="related-entries related-works">
									<h3><?php _e( 'Related Works', 'btp_theme' ); ?></h3>
									<?php echo $out; ?>
								</div>
							<?php endif; ?>	
						<?php endif; ?>
						
						<?php comments_template( '', true ); ?>						
					</div>
				</div><!-- .grid -->				
			</article>
			
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->

<?php get_footer(); ?>