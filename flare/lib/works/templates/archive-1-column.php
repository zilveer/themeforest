<?php
/**
 * The Template for displaying work archive|index.
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
			
			<?php 
				if ( have_posts() ) {
					global $wp_query;							
					btp_part_set_vars( array( 
 						'query' 			=> $wp_query,
						'lightbox_group'	=> 'works',
						'elems'				=> btp_elements_get( 'collection' ),
 					));
					get_template_part( '/lib/works/templates/collection', 'max' );
					btp_pagination_render();
				} else {
					get_template_part( 'no_results', 'works' );	
				}
			?>
			
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->
<?php get_footer(); ?>