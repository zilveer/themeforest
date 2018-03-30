<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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