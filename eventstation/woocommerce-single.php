<?php
/**
	* The template for displaying woocommerce single
*/
get_header(); ?>

	<?php eventstation_heading_navigation(); ?>

		<?php eventstation_site_sub_content_start(); ?>
			<?php eventstation_container_fluid_before(); ?>
				<?php eventstation_alternative_row_before(); ?>
					<?php eventstation_post_content_area_start(); ?>
						<div class="page-content">
							<?php woocommerce_content(); ?>
						</div>
					<?php eventstation_content_area_end(); ?>
					
					<?php get_sidebar(); ?>
						
				<?php eventstation_alternative_row_after(); ?>
			<?php eventstation_container_fluid_after(); ?>
		<?php eventstation_site_sub_content_end(); ?>

<?php get_footer();