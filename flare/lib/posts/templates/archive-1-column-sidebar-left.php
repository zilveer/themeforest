<?php
/**
 * The Template with the sidebar on the left side for displaying post archive|index.
 * 
 * The sidebar block is after the main content for SEO purposes.
 * This will be fixed via CSS rules.  
 *
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>
	<?php get_template_part( 'precontent' ); ?>	

	<div id="content" class="<?php echo btp_content_get_class(); ?>">
		<div id="content-inner">
            <?php if ( btp_elements_get( 'breadcrumbs' ) ): ?>
                <?php btp_breadcrumbs_render( btp_breadcrumbs_get() ); ?>
            <?php endif; ?>
			<div class="grid">				
				<div class="c-two-third push-one-third">					
					<?php 
						if ( have_posts() ) {
							global $wp_query;							
							btp_part_set_vars( array( 
 								'query' 			=> $wp_query,
								'lightbox_group'	=> 'posts',
								'elems'				=> btp_elements_get( 'collection' ),
 							));
							get_template_part( '/lib/posts/templates/collection', 'two_thirds' );
							btp_pagination_render();
						} else {
							get_template_part( 'no_results', 'posts' );	
						}
					?>
				</div>		
				<aside class="c-one-third pull-two-third sidebar before">
					<div class="helper"></div>
					<div class="inner">
						<?php btp_sidebar_render( btp_elements_get( 'sidebar_1' ) ); ?>
					</div>	
					<div class="helper"></div>
				</aside><!-- .sidebar -->
        	</div>
	        	
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->
	
<?php get_footer(); ?>