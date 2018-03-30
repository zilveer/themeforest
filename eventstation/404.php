<?php
/*
	* The template for displaying 404 page
*/
get_header(); ?>
	
	<?php
		$heading_navigation = ot_get_option( '404_page_heading_navigation' );
		if( $heading_navigation == "on" or !$heading_navigation == "off" ) {
			eventstation_heading_navigation();
		} else {
	?>
		<?php eventstation_no_header_code(); ?>
	<?php } ?>

	<?php eventstation_site_sub_content_start(); ?>
		<?php eventstation_container_fluid_before(); ?>
			<?php eventstation_alternative_row_before(); ?>
				<?php eventstation_post_content_area_start(); ?>
					<div class="page-content">
						<article class="page page404">
							<div class="content404">
								<h2><?php echo esc_html__( 'sorry! the page you are looking for cannot be found', 'eventstation' ); ?></h2>
								<p><?php echo esc_html__( 'This file may have been moved or deleted.', 'eventstation' ); ?></p>
								<?php
									$page_search_form = ot_get_option( '404_page_search_form' );
									if( $page_search_form == "on" or !$page_search_form == "off" ) {
								?>
									<div class="content404-bottom">
										<div class="icon404"><?php echo esc_html__( '404', 'eventstation' ); ?></div>
											<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
												<input type="text" value="" placeholder="<?php echo esc_html__( 'Where would you like to go? ', 'eventstation' ); ?>" name="s" id="s" class="searchform-text">
												<button id="searchsubmit"><?php echo esc_html__( 'Search ', 'eventstation' ); ?></button>
											</form>
									</div>
								<?php } ?>
							</div>
						</article>
					</div>
				<?php eventstation_content_area_end(); ?>
			<?php eventstation_alternative_row_after(); ?>
		<?php eventstation_container_fluid_after(); ?>
	<?php eventstation_site_sub_content_end(); ?>

<?php get_footer();