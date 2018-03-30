<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template' 
 * is selected in Events -> Settings -> Template -> Events Template.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

?>

<?php 

	$canon_options = get_option('canon_options');
	$canon_options_post = get_option('canon_options_post'); 

	// DEFAULTS
	if (!isset($canon_options_post['use_events_sidebar'])) { $canon_options_post['use_events_sidebar'] = "unchecked"; }

	// SET MAIN CONTENT CLASS
	$main_content_class = "main-content";
	if ($canon_options_post['use_events_sidebar'] == "checked") { 
		$main_content_class .= " three-fourths"; 
		if ($canon_options['sidebars_alignment'] == 'left') { $main_content_class .= " left-main-content"; }
	}

?>

<?php get_header(); ?>
	
		
		<!-- Start Outter Wrapper -->   
		<div class="outter-wrapper feature">
			<hr>
		</div>
		<!-- End Outter Wrapper --> 

		
		<!-- start outter-wrapper -->   
		<div class="outter-wrapper">
			<!-- start main-container -->
			<div class="main-container">
				<!-- start main wrapper -->
				<div class="main wrapper clearfix">
					<!-- start main-content -->
					<div class="<?php echo $main_content_class; ?>">

						<!-- Start Post --> 
						<div class="clearfix">

							<div id="tribe-events-pg-template" class="canon-events">

								<?php tribe_events_before_html(); ?>
								<?php tribe_get_view(); ?>
								<?php tribe_events_after_html(); ?>
													 
							</div> 
							<!-- #tribe-events-pg-template -->

						</div>


					</div>
					<!-- end main-content -->

					<!-- SIDEBAR -->
					<?php if ($canon_options_post['use_events_sidebar'] == "checked") { get_sidebar('events'); } ?> 

				</div>
				<!-- end main wrapper -->
			</div>
			 <!-- end main-container -->
		</div>
		<!-- end outter-wrapper -->
	  

		

<?php get_footer(); ?>