<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	Template Name: Frontpage

	1 - RETRIEVE DATA

	2 - PROJECTS

		2.1 - Projects
			- Loop
		2.2 - Sidebar B
		2.3 - Sidebar A

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required post data

===============================================*/

	global
		$st_Settings,
		$st_Options;

		$st_ = array();

		// Projects check
		$st_['st_projects'] = ( function_exists( 'st_kit' ) && !empty( $st_Settings['projects_status'] ) == 'yes' ) ? true : false;

		// Post type names
		$st_['st_post'] = !empty( $st_Settings['ctp_post'] ) ? $st_Settings['ctp_post'] : $st_Options['ctp']['post'];
		$st_['st_category'] = !empty( $st_Settings['ctp_category'] ) ? $st_Settings['ctp_category'] : $st_Options['ctp']['category'];
		$st_['st_tag'] = !empty( $st_Settings['ctp_tag'] ) ? $st_Settings['ctp_tag'] : $st_Options['ctp']['tag'];

		// Projects per page
		$st_['projects_per_page'] = !empty( $st_Settings['projects_qty'] ) ? $st_Settings['projects_qty'] : 6;

		// Paged
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged'); }
		
		elseif ( get_query_var('page') ) {
			$paged = get_query_var('page'); }
		
		else {
			$paged = 1; }
		
		$st_['paged'] = $paged;


/*===============================================

	P R O J E C T S
	Display recent projects

===============================================*/

	get_header();

		?>

			<div id="content">
			
				<div id="content-layout">

					<div id="content-holder" class="projects projects-t1 sidebar-position-left">

						<div class="clear"><!-- --></div>
			
						<div id="content-box">
				
							<div>
				
								<div>
						<?php

							/*-------------------------------------------
								2.2 - Sidebar B
							-------------------------------------------*/
	
							get_template_part( '/includes/sidebars/sidebar_homepage_b' );
	
						?>
									<?php


										/*-------------------------------------------
											2.1 - Projects
										-------------------------------------------*/

										if ( $st_['st_projects'] ) {

											$st_['args'] = array(
												'post_type'			=> $st_['st_post'],
												'posts_per_page'	=> $st_['projects_per_page'],
												'order'				=> 'DESC',
												'paged'				=> $st_['paged'],
												'post_status'		=> 'publish'
											);
	
	
											/*--- Loop -----------------------------*/
	
											$st_['temp'] = $wp_query;
											$wp_query = null;
											$wp_query = new WP_Query( $st_['args'] ); ?>
	
	
												<div class="projects-t1-wrapper">
	
													<?php
	
														$st_['postcount'] = 0;
														$st_['featcount'] = 0;
		
		
														while ( $wp_query->have_posts() ) : $wp_query->the_post();  
				
															include( locate_template( '/includes/projects/t1.php' ) );
				
														endwhile;
		
		
														// Dummy projects
														include( locate_template( '/includes/projects/t1-dummy.php' ) );
	
													?>
	
													<div class="clear"><!-- --></div>
		
												</div><!-- .projects-$t-wrapper --><?php


												// Pagination
												if ( function_exists('wp_pagenavi') ) {
													?><div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div><?php } 
	
												else {
													?><div id="but-prev-next"><?php next_posts_link( __( 'Older projects', 'strictthemes' ) ); previous_posts_link( __( 'Newer projects', 'strictthemes' ) ); ?></div><?php }

		
											$wp_query = null;
											$wp_query = $st_['temp'];
											wp_reset_query();

										}

										else {

											echo '<p>' . __( 'Portfolio inactive. Turn On <strong>Projects</strong> at <em>Theme Panel > Projects</em> page.', 'strictthemes' ) . '</p>';

										}

									?>

									<div class="clear"><!-- --></div>

								</div>
				
							</div>
				
						</div><!-- #content-box -->


						<?php

							/*-------------------------------------------
								2.3 - Sidebar A
							-------------------------------------------*/

							get_template_part( '/includes/sidebars/sidebar_homepage_a' );


						?>

	
						<div class="clear"><!-- --></div>

					</div><!-- #content-holder -->
		
				</div><!-- #content-layout -->
		
			</div><!-- #content -->
	
		<?php

	get_footer();

?>