<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - RETRIEVE DATA

	2 - PAGE

		2.1 - Breadcrumbs
		2.2 - Article
			- Title
			- Content
		2.3 - Pagination
		2.4 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required data

===============================================*/

	global
		$wp_query;

		$st_ = array();


/*===============================================

	P A G E
	Display a required page

===============================================*/

	get_header();

		?>

			<div id="content">
			
				<div id="content-layout">

					<div id="content-holder" class="sidebar-position-right">
				
						<div id="content-box">
				
							<div>

								<div>

									<div class="term-title">

										<?php echo '<div id="term"><div class="term-title"><h1>' . get_search_query() . ' <span class="title-sub">' . $wp_query->found_posts . '</span></h1></div></div>'; ?>

									</div>

									<?php

										if ( have_posts() ) :
			


											// No. of current page
											$st_['p'] = $paged > 1 ? $paged : 1;
			
											// Qty of posts per page 
											$st_['per_page'] = get_option( 'posts_per_page' );
			
											// No. of first post on current page
											$st_['start'] = ( $st_['p'] - 1 ) * $st_['per_page'] + 1;



											/*-------------------------------------------
												2.1 - Breadcrumbs
											-------------------------------------------*/

											echo '<ol start="' . $st_['start'] . '">';
			
												while ( have_posts() ) : the_post();
			
													echo '<li>';
			
														get_template_part( '/includes/posts/t8' );
			
													echo '</li>';
			
												endwhile;
			
											echo '</ol>';



											/*-------------------------------------------
												2.3 - Pagination
											-------------------------------------------*/

											if ( function_exists('wp_pagenavi') ) {
												?><div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div><?php } 

											else {
												?><div id="but-prev-next"><?php next_posts_link( __( 'Older posts', 'strictthemes' ) ); previous_posts_link( __( 'Newer posts', 'strictthemes' ) ); ?></div><?php }



										else :



											echo do_shortcode ( '[alert type=error]' . __( 'Sorry, nothing matched your search criteria. Please try again with some different keywords.', 'strictthemes' ) . '[/alert]' );
											


										endif;
				
									?>
					
									<div class="clear"><!-- --></div>

								</div>

							</div>
				
						</div><!-- #content-box -->
		
						<?php

							/*-------------------------------------------
								2.4 - Sidebar
							-------------------------------------------*/

							st_get_sidebar( 'Default Sidebar' );

						?>
			
						<div class="clear"><!-- --></div>

					</div><!-- #content-holder -->
		
				</div><!-- #content-layout -->
		
			</div><!-- #content -->
	
		<?php

	get_footer();

?>