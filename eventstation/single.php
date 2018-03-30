<?php
/**
	* The template for displaying single
*/
get_header(); ?>

		<?php
			$single_heading_navigation = ot_get_option( 'single_heading_navigation' );
			if( $single_heading_navigation == "on" or !$single_heading_navigation == "off" ) {
				eventstation_heading_navigation();
			} else {
		?>
			<?php eventstation_no_header_code(); ?>
		<?php } ?>

		<?php eventstation_site_sub_content_start(); ?>
			<?php eventstation_container_fluid_before(); ?>
				<?php eventstation_alternative_row_before(); ?>
					<?php eventstation_post_content_area_start(); ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'include/formats/content', get_post_format() ); ?>
						<?php endwhile; ?>
						<?php while ( have_posts() ) : the_post(); 
							$single_post_comment_area = ot_get_option( 'single_post_comment_area' );
							if( $single_post_comment_area == "on" or !$single_post_comment_area == "off" ) {
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							}
						endwhile; ?>
					<?php eventstation_content_area_end(); ?>
					
					<?php get_sidebar(); ?> 
					
				<?php eventstation_alternative_row_after(); ?>
			<?php eventstation_container_fluid_after(); ?>
		<?php eventstation_site_sub_content_end(); ?>

<?php get_footer();