<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 *
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>
	<?php get_template_part( 'precontent' ); ?>	

	<div id="content" class="<?php echo btp_content_get_class(); ?>">
		<div id="content-inner">
			<div class="grid">				
				<div class="c-two-third">
					<?php 
						if ( have_posts() ) {
							global $wp_query;							
							btp_part_set_vars( array( 
 								'query' 			=> $wp_query,
								'lightbox_group'	=> 'entries',
								'elems'				=> btp_elements_get( 'collection' ),
 							));
							get_template_part( 'entries', 'two_thirds' );
							btp_pagination_render();
						} else {
							get_template_part( 'no_results', 'entries' );	
						}
					?>
				</div>		
				<aside class="c-one-third sidebar after">
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