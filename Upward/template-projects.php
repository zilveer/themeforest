<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	Template Name: Projects

	1 - RETRIEVE DATA

	2 - PROJECTS

		2.1 - Default content
			- Breadcrumbs
			- Title
			- Content
		2.2 - Projects
			- Loop
		2.3 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$st_Settings,
		$st_Options;

		$st_ = array();

		// Template name
		$st_['t'] = !empty( $st_Settings['projects_template'] ) ? $st_Settings['projects_template'] : $st_Options['panel']['projects']['portfolio']['template-default'];
	
			// Get sidebar position
			$st_['sidebar_position'] = $st_['t'] != 't2' && $st_['t'] != 't3' && $st_['t'] != 't5' ? st_get_post_meta( $post->ID, 'sidebar_position_value', true, 'right' ) : 'none';
	
			// If sidebar disabled
			$st_['t'] = $st_['t'] == 'default' && $st_['sidebar_position'] == 'none' ? 't5' : $st_['t'];
			$st_['t'] = $st_['t'] == 't1' && $st_['sidebar_position'] == 'none' ? 't2' : $st_['t'];
	
			// Get custom sidebar
			$st_['sidebar'] = st_get_post_meta( $post->ID, 'sidebar_value', true, 'Projects Sidebar' );

		// Post type names
		$st_['st_post'] = !empty( $st_Settings['ctp_post'] ) ? $st_Settings['ctp_post'] : $st_Options['ctp']['post'];
		$st_['st_category'] = !empty( $st_Settings['ctp_category'] ) ? $st_Settings['ctp_category'] : $st_Options['ctp']['category'];
		$st_['st_tag'] = !empty( $st_Settings['ctp_tag'] ) ? $st_Settings['ctp_tag'] : $st_Options['ctp']['tag'];

		// Projects check
		$st_['st_projects'] = ( function_exists( 'st_kit' ) && !empty( $st_Settings['projects_status'] ) == 'yes' ) ? true : false;

		// Projects per page
		$st_['projects_per_page'] = !empty( $st_Settings['projects_qty'] ) ? $st_Settings['projects_qty'] : 9;

		// Paged
		$st_['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	
		// Is title disabled?
		$st_['title_disabled'] = st_get_post_meta( $post->ID, 'disable_title_value', true, 0 );
	
		// Is breadcrumbs disabled?
		$st_['breadcrumbs_disabled'] = st_get_post_meta( $post->ID, 'disable_breadcrumbs_value', true, 0 );

		// Subtitle
		$st_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );



/*===============================================

	P R O J E C T S
	Display projects archive

===============================================*/

	get_header();

		?>

			<div id="content">
			
				<div id="content-layout">
			
					<div id="content-holder" class="projects projects-<?php echo $st_['t']; ?> sidebar-position-<?php echo $st_['sidebar_position']; ?>">
				
						<div id="content-box">
				
							<div>

								<div>

									<?php


										/*-------------------------------------------
											2.1 - Default content
										-------------------------------------------*/

										if ( have_posts() ) {
					
											while ( have_posts() ) : the_post();

												if ( !$st_['title_disabled'] || get_the_content() ) {

													echo '<div id="projects-term">';
	
														// Title
														if ( !$st_['title_disabled'] && !is_front_page() ) {
															echo '<div class="projects-term-title"><h1>' . get_the_title() . ( $st_['subtitle'] ? '<span class="title-end">.</span> <span class="title-sub">' . $st_['subtitle'] . '<span class="title-end">.</span></span>' : '' ) . '</h1></div>'; }
	
														// Content
														if ( get_the_content() ) {
															echo '<div class="projects-term-description">'; the_content(); echo '</div>'; }
				
													echo '</div><div class="clear"><!-- --></div>';

												}

											endwhile;
					
										}


										/*-------------------------------------------
											2.2 - Projects
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
		
	
												<div class="projects-<?php echo $st_['t'] ?>-wrapper">
	
													<?php
			
														$st_['postcount'] = 0;
														$st_['featcount'] = 0;
			
	
														while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
															include( locate_template( '/includes/projects/' . $st_['t'] . '.php' ) );
				
														endwhile;
	
	
														// Dummy projects
														if ( $st_Options['panel']['projects']['portfolio']['templates'][$st_['t']]['dummy'] ) {
															include( locate_template( '/includes/projects/' . $st_['t'] . '-dummy.php' ) ); }
	
													?>
	
													<div class="clear"><!-- --></div>
	
												</div><!-- .projects-$st_['t']-wrapper --><?php
	
	
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
								2.3 - Sidebar
							-------------------------------------------*/

							if ( !isset( $st_['sidebar_position'] ) || !empty( $st_['sidebar_position'] ) && $st_['sidebar_position'] != 'none' ) {
								st_get_sidebar( $st_['sidebar'] ); }

						?>

						<div class="clear"><!-- --></div>

					</div><!-- #content-holder -->
		
				</div><!-- #content-layout -->
		
			</div><!-- #content -->

		<?php

	// FOOTER
	get_footer();

?>