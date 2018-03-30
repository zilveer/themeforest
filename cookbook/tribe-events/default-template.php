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

	$canon_options_post = get_option('canon_options_post'); 

	// DEFAULTS
	if (!isset($canon_options_post['use_events_sidebar'])) { $canon_options_post['use_events_sidebar'] = "unchecked"; }

	// SET MAIN CONTENT CLASS
	$main_content_class = ($canon_options_post['use_events_sidebar'] == "checked") ? "col-3-4" : "col-1-1";

?>

<?php get_header(); ?>
	
		
    	<!-- Start Outter Wrapper -->
    	<div class="outter-wrapper body-wrapper">		
    		<div class="wrapper clearfix">

				<!-- Main Column -->
				<div class="<?php echo esc_attr($main_content_class); ?>">
				
		            <div class="clearfix">

						<div id="tribe-events-pg-template" class="canon-events">

							<?php tribe_events_before_html(); ?>
							<?php tribe_get_view(); ?>
							<?php tribe_events_after_html(); ?>
												 
						</div> 

		            </div>
				
				</div>
				<!-- End Main Column -->    
				
				<!-- SIDEBAR -->
				<?php if ($canon_options_post['use_events_sidebar'] == "checked") { get_sidebar('events'); } ?> 
                

    		</div>
    	</div>


<?php get_footer(); ?>