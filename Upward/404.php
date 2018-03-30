<?php if ( !defined( 'ABSPATH' ) ) exit;

	get_header();

		?>

			<div id="content">
			
				<div id="content-layout">

					<div id="content-holder" class="sidebar-position-right">
			
						<div id="content-box">
			
							<div>

								<div id="page-404">

									<div id="content-404" class="notice">

										<h1>404</h1>
	
										<p>
											<?php _e( "Sorry, the page you asked for couldn't be found.", 'strictthemes' ) ?><br/>
											<?php _e( 'Please, try to use the search form below.', 'strictthemes' ) ?>
										</p>
	
										<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">

											<input
												type="text"
												name="s"
												value=""
												placeholder="<?php _e( 'Search...', 'strictthemes' ) ?>"
											/>

										</form>

									</div>

									<p><?php _e( "Here's a little map that might help you get back on track:", 'strictthemes' ) ?></p>

									<div class="column" style="width: 33%;">
										<div>
											<h3><?php _e( 'Categories', 'strictthemes' ) ?></h3>
											<ul><?php wp_list_categories('title_li=&depth=1&show_count=1') ?></ul>
										</div>
									</div>

									<div class="column" style="width: 33%;">
										<div>
											<h3><?php _e( 'Archives', 'strictthemes' ) ?></h3>
											<ul><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>
										</div>
									</div>

									<div class="column" style="width: 34%;">
										<div>
											<h3><?php _e( 'Pages', 'strictthemes' ) ?></h3>
											<ul><?php wp_list_pages('title_li=&depth=1&show_count=1') ?></ul>
										</div>
									</div>
				
									<div class="clear"><!-- --></div>

								</div>			

							</div>
		
						</div><!-- #content-box -->
			
						<?php

							/*-------------------------------------------
								2.8 - Sidebar
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