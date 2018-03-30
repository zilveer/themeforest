<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - RETRIEVE DATA

	2 - POSTS

		2.1 - Posts
		2.3 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$st_Settings;

		$st_ = array();

		// Template name
		$st_['t'] = !empty( $st_Settings['blog_template'] ) ? $st_Settings['blog_template'] : 'default';


/*===============================================

	P O S T S
	Display posts archive

===============================================*/

	get_header();

		?>

			<div id="content">
			
				<div id="content-layout">
		
					<div id="content-holder" class="sidebar-position-right">
				
						<div id="content-box">
				
							<div>

								<div>

									<?php

										/*-------------------------------------------
											1.1 - Loop
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
								1.2 - Sidebar
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