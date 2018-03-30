<?php
/**
 * The Template with the sidebar on the right side for displaying single entry.
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
			
			<div class="grid">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-two-third' ); ?>>
					
					<?php if ( $elems[ 'mediabox' ] ) { btp_entry_render_mediabox( 'two_third', $elems[ 'mediabox' ] ); } ?>
					
					<?php if( $elems['date'] || $elems['author'] || $elems['comments_link'] ): ?>
					<p class="meta entry-meta">
						<?php if ( $elems['date'] ) { btp_entry_render_date(); } ?>
						<?php if ( $elems['author'] ) { btp_entry_render_author(); } ?>
						<?php if ( $elems['comments_link'] ) { btp_entry_render_comments_link(); } ?>
					</p>
					<?php endif; ?>	
		
					<div class="entry-content clearfix">
						<?php the_content(); ?>
						<?php btp_wp_link_pages(); ?>								
					</div><!-- .entry-content -->
							
					<?php if ( $elems['categories'] || $elems['tags'] ): ?>
						<div class="meta entry-terms clearfix">					
						<?php 
							if ( $elems['categories'] ) { btp_entry_render_categories(); }
							if ( $elems['tags'] ) { btp_entry_render_tags(); }
						?>
						</div>
					<?php endif; ?>
					
					<?php 
						get_template_part( 'entry_sharebox' );										
						get_template_part( 'entry_nav' ); 
					?>
						
					<div class="entry-utility">
						<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
					
					<?php comments_template( '', true ); ?>
				</article><!-- #post-## -->
				
				<aside class="c-one-third sidebar after">
					<div class="helper"></div>
					<div class="inner">
						<?php btp_sidebar_render( btp_elements_get( 'sidebar_1' ) ); ?>
					</div>	
					<div class="helper"></div>
				</aside><!-- .sidebar -->
			</div><!-- .grid -->
				
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->
		
<?php get_footer(); ?>