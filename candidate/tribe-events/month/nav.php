<?php 
/**
 * Month View Nav Template
 * This file loads the month view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/nav.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php do_action( 'tribe_events_before_nav' ) ?>

<h3 class="tribe-events-visuallyhidden"><?php _e( 'Calendar Month Navigation', 'tribe-events-calendar' ) ?></h3>

<div class="row">

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 align-left animate-onscroll">
		<?php candidat_tribe_events_the_previous_month_link1(); ?>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 align-right animate-onscroll">
		<?php candidat_tribe_events_the_next_month_link1(); ?>
	</div>

</div>


<?php do_action( 'tribe_events_after_nav' ) ?>
