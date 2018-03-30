<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/


get_header(); 

?>
		<?php
			$pp_homepage_bg = get_option('pp_homepage_bg'); 
			
			if(empty($pp_homepage_bg))
			{
				$pp_homepage_bg = '/example/bg.jpg';
			}
			else
			{
				$pp_homepage_bg = '/data/'.$pp_homepage_bg;
			}
		?>
		<script type="text/javascript"> 
			jQuery.backstretch( "<?php echo get_stylesheet_directory_uri().$pp_homepage_bg; ?>", {speed: 'slow'} );
		</script>

		<!-- Begin content -->
		<div id="page_content_wrapper">
		
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">

					<div class="sidebar_content full_width">
			
						<h1 class="cufon">404 Not Found</h1><br/><hr/>
						
						<p><?php _e( 'Apologies, but the page you requested could not be found.', '' ); ?></p>

					</div>
					
				</div>
				
			</div>
			<br class="clear"/>
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>