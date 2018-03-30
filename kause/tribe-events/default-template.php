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

<?php $canon_options_post = get_option('canon_options_post'); ?>

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
                    <div class="main-content<?php if ($canon_options_post['use_events_sidebar'] == "checked") { echo ' three-fourths'; }  ?>">

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