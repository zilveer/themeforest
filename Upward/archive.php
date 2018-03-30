<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - POSTS

		1.1 - Breadcrumbs
		1.2 - If
			- Date
			- Tag
			- Category
		1.3 - Loop
			- Pagination
		1.4 - Sidebar

	2 - PPOJECTS

		2.1 - Breadcrumbs
		2.2 - Term title
		2.3 - Loop
		2.4 - Sidebar

	3 - 404

		3.1 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$st_Options,
		$st_Settings;

		$st_ = array();
		$st_['args'] = array();

		// Post type names
		$st_['st_post'] = !empty( $st_Settings['ctp_post'] ) ? $st_Settings['ctp_post'] : $st_Options['ctp']['post'];
		$st_['st_category'] = !empty( $st_Settings['ctp_category'] ) ? $st_Settings['ctp_category'] : $st_Options['ctp']['category'];
		$st_['st_tag'] = !empty( $st_Settings['ctp_tag'] ) ? $st_Settings['ctp_tag'] : $st_Options['ctp']['tag'];



/*--- ARCHIVE ---------------------------------*/

	get_header();

		if ( have_posts() ) :



			/*===============================================

				P O S T S
				Display posts archive

			===============================================*/

				if ( get_post_type() == 'post' ) :


					/*===============================================

						R E T R I E V E   D A T A
						Get a required page data

					===============================================*/

						// Template name
						$st_['t'] = !empty( $st_Settings['blog_template'] ) ? $st_Settings['blog_template'] : 'default';
		
						// Get sidebar position
						$st_['sidebar_position'] = st_get_post_meta( st_get_page_by_template('template-blog'), 'sidebar_position_value', true, 'right' );

						?>
	
							<div id="content">
							
								<div id="content-layout">
	
									<div id="content-holder" class="sidebar-position-<?php echo $st_['sidebar_position']; ?>">
				
										<div id="content-box">
					
											<div>
						
												<div>
	
													<?php



														/*-------------------------------------------
															1.1 - Breadcrumbs
														-------------------------------------------*/

														/* no needed */



														/*-------------------------------------------
															1.2 - Title
														-------------------------------------------*/

															/*--- Date -----------------------------*/
	
															if ( is_day() || is_month() || is_year() ) {
								
																// Get the date
																if ( is_day() ) :
										
																	$st_['date'] = get_the_date();
																	$st_['y'] = get_the_date('Y');
																	$st_['n'] = get_the_date('n');
																	$st_['j'] = get_the_date('j');
								
																	$st_['qty'] = get_posts( 'year=' . $st_['y'] . '&monthnum=' . $st_['n'] . '&day=' . $st_['j'] . '&posts_per_page=-1' );
																	$st_['qty'] = count( $st_['qty'] );
								
																elseif ( is_month() ) :

																	$st_['date'] = get_the_date( 'F Y' );
																	$st_['y'] = get_the_date('Y');
																	$st_['n'] = get_the_date('n');
								
																	$st_['qty'] = get_posts( 'year=' . $st_['y'] . '&monthnum=' . $st_['n'] . '&posts_per_page=-1' );
																	$st_['qty'] = count( $st_['qty'] );

																elseif ( is_year() ) :
										
																	$st_['date'] = get_the_date( 'Y' );
																	$st_['y'] = get_the_date('Y');

																	$st_['qty'] = 0;
								
																		$arr = array(1,2,3,4,5,6,7,8,9,10,11,12);
								
																		foreach ( $arr as $value ) {
								
																			$st_['a'] = count( get_posts( 'year=' . $st_['y'] . '&monthnum=' . $value . '&posts_per_page=-1' ) );
																			$st_['qty'] = $st_['qty'] + $st_['a'];
								
																		}
								
																endif;
								
																$st_['out_title'] = $st_['date'] . ' <span class="title-sub">' . $st_['qty'] . '</span>';

															}


															/*--- Tag -----------------------------*/
								
															elseif ( is_tag() ) {
								
																// Get number of posts by tag
																$st_['term'] = get_term_by( 'name', single_tag_title( '', false ), 'post_tag' );
								
																$st_['out_title'] = single_tag_title( '', false ) . ' <span class="title-sub">' . $st_['term']->count . '</span>';

																if ( tag_description() ) {
																	$st_['out_description'] = tag_description(); }

															}


															/*--- Category -----------------------------*/
								
															elseif ( is_category() ) {
							
																$st_['category'] = get_queried_object();

																$st_['out_title'] = $st_['category']->name . ' <span class="title-sub">' . $st_['category']->count . '</span>';

																if ( $st_['category']->category_description ) {
																	$st_['out_description'] = $st_['category']->category_description; }
								
															}


															/*--- Format -----------------------------*/

															elseif ( get_queried_object()->taxonomy == 'post_format' ) {

																foreach ( $st_Options['global']['post-formats'] as $format => $label ) {
																	if ( get_queried_object()->slug == 'post-format-' . $format ) {
																		$st_['out_title'] = $label['label'] . ' <span class="title-sub">' . get_queried_object()->count . '</span>'; }
																}

															}


														if ( !empty($st_['out_title']) ) {

															echo
																'<div id="term">' .
																	'<div class="term-title"><h1>' . ucwords($st_['out_title']) . '</h1></div>' .
																	( !empty($st_['out_description']) ? '<div class="term-description">' . $st_['out_description'] . '</div>' : '' ) .
																'</div>';

														}
							


														/*-------------------------------------------
															1.3 - Loop
														-------------------------------------------*/

														while ( have_posts() ) : the_post();

															include( locate_template( '/includes/posts/' . $st_['t'] . '.php' ) );

														endwhile;

	
														// Pagination
														if ( function_exists('wp_pagenavi') ) {
															?><div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div><?php } 
														else {
															?><div id="but-prev-next"><?php next_posts_link( __( 'Older posts', 'strictthemes' ) ); previous_posts_link( __( 'Newer posts', 'strictthemes' ) ); ?></div><?php } 
	
	
						
													?>
							
													<div class="clear"><!-- --></div>
							
												</div>
					
											</div>
					
										</div><!-- #content-box -->
					
										<?php
					
											/*-------------------------------------------
												1.4 - Sidebar
											-------------------------------------------*/

											if ( !isset( $st_['sidebar_position'] ) || !empty( $st_['sidebar_position'] ) && $st_['sidebar_position'] != 'none' ) {
												st_get_sidebar( 'Default Sidebar' ); }
	
										?>
					
										<div class="clear"><!-- --></div>
		
									</div><!-- #content-holder -->
						
								</div><!-- #content-layout -->
						
							</div><!-- #content -->
		
						<?php



			/*===============================================
			
				P R O J E C T S
				Display projects archive
			
			===============================================*/

				elseif ( get_post_type() == $st_['st_post'] ) :


					/*===============================================
					
						R E T R I E V E   D A T A
						Get a required page data
					
					===============================================*/	

						// Template name
						$st_['t'] = !empty( $st_Settings['projects_template'] ) ? $st_Settings['projects_template'] : $st_Options['panel']['projects']['portfolio']['template-default'];
		
						// Get sidebar position
						$st_['sidebar_position'] = $st_['t'] != 't2' && $st_['t'] != 't3' && $st_['t'] != 't5' ? st_get_post_meta( st_get_page_by_template('template-projects'), 'sidebar_position_value', true, 'right' ) : 'none';

						// Portfolio title
						$st_['portfolio_title'] = st_get_page_by_template('template-projects') ? get_the_title( st_get_page_by_template('template-projects') ) : false;

						// Posts per page
						$st_['projects_per_page'] = !empty( $st_Settings['projects_qty'] ) ? $st_Settings['projects_qty'] : 9;

						// Paged
						$st_['paged'] = get_query_var('paged') ? get_query_var('paged') : 0; ?>

							<div id="content">
							
								<div id="content-layout">
							
									<div id="content-holder" class="projects projects-<?php echo $st_['t']; ?> sidebar-position-<?php echo $st_['sidebar_position']; ?>">
			
										<div id="content-box">
				
											<div>
		
												<div>
		
													<?php



														/*-------------------------------------------
															2.1 - Breadcrumbs
														-------------------------------------------*/

														/* no needed */



														/*-------------------------------------------
															2.2 - Term title
														-------------------------------------------*/
			
														// Title
														$st_['out_title'] = '<div class="projects-term-title"><h1>' . ucwords( get_queried_object()->name );
			
															if ( $st_['portfolio_title'] ) {
																$st_['out_title'] .= '<span class="title-end">.</span> <span class="title-sub">' . $st_['portfolio_title'] .'<span class="title-end">.</span></span></h1></div>'; }
															else {
																$st_['out_title'] .= '</h1></div>'; }
			
														// Description
														if ( get_queried_object()->description ) {
															$st_['out_description'] = '<div class="projects-term-description">' . wpautop( do_shortcode( get_queried_object()->description ) ) . '</div>'; }
														else {
															$st_['out_description'] = ''; }
			
														if ( $st_['out_title'] ) {
															echo '<div id="projects-term">' . $st_['out_title'] . $st_['out_description'] . '</div>'; }



														/*-------------------------------------------
															2.3 - Loop
														-------------------------------------------*/

														if ( get_queried_object()->taxonomy == $st_['st_tag'] ) {

															$st_['args'] = array(
																	'post_type'			=> $st_['st_post'],
																	'posts_per_page'	=> $st_['projects_per_page'],
																	'order'				=> 'DESC',
																	'paged'				=> $st_['paged'],
																	'post_status'		=> 'publish',
																	$st_['st_tag']			=> get_queried_object()->slug
																);
														}

														elseif ( get_queried_object()->taxonomy == $st_['st_category'] ) {

															$st_['args'] = array(
																	'post_type'			=> $st_['st_post'],
																	'posts_per_page'	=> $st_['projects_per_page'],
																	'order'				=> 'DESC',
																	'paged'				=> $st_['paged'],
																	'post_status'		=> 'publish',
																	$st_['st_category']	=> get_queried_object()->slug
																);

														}

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


													?>
		
													<div class="clear"><!-- --></div>
		
												</div>
		
											</div>
				
										</div><!-- #content-box -->
		
										<?php
		
											/*-------------------------------------------
												2.4 - Sidebar
											-------------------------------------------*/

											if ( !isset( $st_['sidebar_position'] ) || !empty( $st_['sidebar_position'] ) && $st_['sidebar_position'] != 'none' ) {
												st_get_sidebar( 'Projects Sidebar' ); }
		
										?>
		
										<div class="clear"><!-- --></div>
		
									</div><!-- #content-holder -->
						
								</div><!-- #content-layout -->
						
							</div><!-- #content -->
		
						<?php
	
				endif;



		else : ?>



				<div id="content">
				
					<div id="content-layout">

						<div id="content-holder" class="sidebar-position-right">

							<div id="content-box">

								<div>

									<div>

										<?php _e( 'Sorry, no posts matched your criteria.', 'strictthemes' ) ?>

										<div class="clear"><!-- --></div>

									</div>

								</div>

							</div><!-- #content-box -->

							<?php
		
								/*-------------------------------------------
									3.1 - Sidebar
								-------------------------------------------*/

								st_get_sidebar( 'Default Sidebar' );

							?>

							<div class="clear"><!-- --></div>

						</div><!-- #content-holder -->
			
					</div><!-- #content-layout -->
			
				</div><!-- #content --><?php



		endif;


	get_footer();

?>