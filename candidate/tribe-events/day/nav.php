<?php 
/**
 * Day View Nav
 * This file contains the day view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/nav.php 
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<h3 class="tribe-events-visuallyhidden"><?php _e( 'Day Navigation', 'tribe-events-calendar-pro' ) ?></h3>
<div class="row">

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 align-left animate-onscroll">
		<?php candidat_tribe_the_day_link1('previous day', 'previous day') ?>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 align-right animate-onscroll">
		<?php candidat_tribe_the_day_link1('next day', 'next day') ?>
	</div>

</div>


