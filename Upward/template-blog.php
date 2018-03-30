<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	Template Name: Blog

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
		$st_Options,
		$st_Settings;

		$st_ = array();

		// Template name
		$st_['t'] = !empty( $st_Settings['blog_template'] ) ? $st_Settings['blog_template'] : 'default';

		// Get custom sidebar
		$st_['sidebar'] = st_get_post_meta( $post->ID, 'sidebar_value', true, 'Default Sidebar' );
	
		// Get sidebar position
		$st_['sidebar_position'] = st_get_post_meta( $post->ID, 'sidebar_position_value', true, 'right' );

			// Re-define global $content_width if sidebar not exists
			if ( $st_['sidebar_position'] == 'none' ) {
				$content_width = $st_Options['global']['images']['large']['width']; }

		// Subtitle
		$st_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );

		// Is blog?
		$st_['is_blog'] = true;


/*===============================================

	P O S T S
	Display posts archive

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

										/*--- Page title -----------------------------*/

										if ( !is_front_page() ) {

											if ( have_posts() ) :
												while ( have_posts() ) : the_post(); 

													echo '<div id="term">';

														// Title
														echo '<div class="term-title"><h1>' . get_the_title() . ( $st_['subtitle'] ? ' <span class="title-sub">' . $st_['subtitle'] . '</span>' : '' ) . '</h1></div>';

														// Content
														if ( get_the_content() ) {
															echo '<div class="term-description">'; the_content(); echo '</div>'; }

													echo '</div><div class="clear"><!-- --></div>';

												endwhile;
											endif;

										}



										/*-------------------------------------------
											2.1 - Posts
										-------------------------------------------*/
	
										$st_['qty'] = get_option( 'posts_per_page' );
										$st_['temp'] = $wp_query;
										$wp_query = null;
										$wp_query = new WP_Query();
										$wp_query->query( 'showposts=' . $st_['qty'] . '&paged=' . $paged );


										/*--- Loop -----------------------------*/
	
										while ( $wp_query->have_posts() ) : $wp_query->the_post();
							
											include( locate_template( '/includes/posts/' . $st_['t'] . '.php' ) );
							
										endwhile;
								


										// Pagination
										if ( function_exists('wp_pagenavi') ) {
											?><div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div><?php } 
										else {
											?><div id="but-prev-next"><?php next_posts_link( __( 'Older posts', 'strictthemes' ) ); previous_posts_link( __( 'Newer posts', 'strictthemes' ) ); ?></div><?php }



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
								2.2 - Sidebar
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