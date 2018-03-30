<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - RETRIEVE DATA

	2 - PAGE

		2.1 - Breadcrumbs
		2.2 - Article
			- Title
			- Content
		2.3 - Pagination
		2.4 - Comments
		2.5 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$st_Settings;

		$st_ = array();

		// Is title disabled?
		$st_['title_disabled'] = st_get_post_meta( $post->ID, 'disable_title_value', true, 0 );

		// Is breadcrumbs disabled?
		$st_['breadcrumbs_disabled'] = st_get_post_meta( $post->ID, 'disable_breadcrumbs_value', true, 0 );
	
		// Get custom sidebar
		$st_['sidebar'] = st_get_post_meta( $post->ID, 'sidebar_value', true, 'Default Sidebar' );
	
		// Get sidebar position
		$st_['sidebar_position'] = st_get_post_meta( $post->ID, 'sidebar_position_value', true, 'right' );

			// Re-define global $content_width if sidebar not exists
			if ( $st_['sidebar_position'] == 'none' ) {
				$content_width = $st_Options['global']['images']['large']['width']; }
			else {
				$content_width = $st_Options['global']['images']['archive-image']['width']; }


/*===============================================

	P A G E
	Display a required page

===============================================*/

	get_header();

		?>

			<div id="content">
			
				<div id="content-layout">

					<div id="content-holder" class="sidebar-position-<?php echo $st_['sidebar_position']; ?>">
		
						<div id="content-box">
				
							<div>

								<div>

									<?php
							
										if ( have_posts() ) :
				
											while ( have_posts() ) : the_post(); 



												/*-------------------------------------------
													2.1 - Breadcrumbs
												-------------------------------------------*/
	
												if ( $st_['breadcrumbs_disabled'] != 1 && !is_front_page() && function_exists( 'st_breadcrumbs' ) ) {
													st_breadcrumbs(); }


	
												/*-------------------------------------------
													2.2 - Article
												-------------------------------------------*/ ?>

												<article><?php



													/*--- Title -----------------------------*/

													if ( $st_['title_disabled'] != 1 && !is_front_page() ) { ?>
										
														<h1 class="page-title"><?php
		
															// Title
															the_title();
		
															// Subtitle
															$st_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );
		
																if ( $st_['subtitle'] ) {
																	echo '<span id="title-end">.</span> <span class="title-sub">' . $st_['subtitle'] . '</span>'; }
		
															edit_post_link( __( 'Edit', 'strictthemes' ), '<span class="f13 normal"> - ', '</span>' ); ?>
		
														</h1><?php
				
													}
										


													/*--- Content -----------------------------*/

													echo '<div id="content-data">'; the_content(); echo '</div>'; ?>



												</article>

												<div class="clear"><!-- --></div><?php

									

												/*-------------------------------------------
													2.3 - Pagination
												-------------------------------------------*/

												wp_link_pages( array( 'before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );
									


												/*-------------------------------------------
													2.4 - Comments
												-------------------------------------------*/

												if ( !empty( $st_Settings['page_comments'] ) && $st_Settings['page_comments'] == 'yes' ) {
													comments_template(); }

									
														
											endwhile;
				
										else :
				
											echo '<h1>404</h1><p>' . __( 'Sorry, no posts matched your criteria.', 'strictthemes' ) . '</p>';

										endif;
							
									?>

									<div class="clear"><!-- --></div>

								</div>

							</div>
					
						</div><!-- #content-box -->
			
						<?php

							/*-------------------------------------------
								2.5 - Sidebar
							-------------------------------------------*/

							if ( !isset( $st_['sidebar_position'] ) || !empty( $st_['sidebar_position'] ) && $st_['sidebar_position'] != 'none' ) {
								st_get_sidebar( $st_['sidebar'] ); }

						?>
	
						<div class="clear"><!-- --></div>

					</div><!-- #content-holder -->
		
				</div><!-- #content-layout -->
		
			</div><!-- #content -->
	
		<?php

	get_footer();

?>