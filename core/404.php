<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/


get_header(); 

?>
	<div class="page_caption">
		<h1 class="cufon"><?php _e( '404 Not Found', THEMEDOMAIN ); ?></h1>
	</div>

	<div id="content_wrapper">

		<!-- Begin content -->
		<div id="page_content_wrapper">
		
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">

					<div class="sidebar_content">
						
						<p><?php _e( 'Apologies, but the page you requested could not be found.', THEMEDOMAIN ); ?></p>

					</div>
					
				</div>
				
			</div>
			<br class="clear"/>
		</div>
		<!-- End content -->
	</div>

<?php get_footer(); ?>