<?php
/**
	* The template for displaying single
*/
get_header(); ?>
	
	<?php
		$attachment_heading_navigation = ot_get_option( 'attachment_heading_navigation' );
		if( $attachment_heading_navigation == "on" or !$attachment_heading_navigation == "off" ) {
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
							<?php get_template_part( 'include/formats/content-attachment' ); ?>
						<?php endwhile; ?>
						<?php
							$attachment_comment_area = ot_get_option( 'attachment_comment_area' );
							if( $attachment_comment_area == "on" or !$attachment_comment_area == "off" ) {
								while ( have_posts() ) : the_post(); 
									if ( comments_open() || get_comments_number() ) {
										comments_template();
									}
								endwhile;
							}
						?>
					<?php eventstation_content_area_end(); ?>
					<?php get_sidebar(); ?> 
				<?php eventstation_alternative_row_after(); ?>
			<?php eventstation_container_fluid_after(); ?>
		<?php eventstation_site_sub_content_end(); ?>

<?php get_footer();