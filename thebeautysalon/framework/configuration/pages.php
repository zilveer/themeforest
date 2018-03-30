<?php

add_action('admin_menu', 'tvr_add_page_booking_calendar');

function tvr_add_page_booking_calendar() {
	add_submenu_page( 'edit.php?post_type=tvr_booking', 'Booking Calendar', 'Booking Calendar', 'manage_options', 'tvr_booking_calendar', 'tvr_show_page_booking_calendar' );
}

function tvr_show_page_booking_calendar() {
	global $apartments;

	?>

	<script type='text/javascript'>
		jQuery( document ).ready( function() {
			jQuery('#booking-calendar').fullCalendar({
				header: {
					left: 'prev,next',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				editable: true,
				events: '<?php echo get_template_directory_uri() ?>/bookings-feed.php'
			});

			jQuery( '#apartment-selector' ).change( function() {
				apartment = jQuery( this ).val()
				jQuery('#booking-calendar').fullCalendar( 'removeEvents' )
				jQuery('#booking-calendar').fullCalendar( 'addEventSource',  {
					url: '<?php echo get_template_directory_uri() ?>/bookings-feed.php',
					type: 'POST',
					data: {
						apartment : apartment
					}
				})
			})
		})
		</script>
		<div class="wrap">

		    <div id="booking-calendar-head">
		    	<div class='title'>
		    		<div class="icon16 tvr_booking_calendar"></div>
		    		<h4>Booking Calendar</h4>
		    		<select id="apartment-selector">
		    			<option value=''>All Apartments</option>
		    			<?php
		    				$apartments = $apartments->get_apartment_dropwdown_list();
		    				foreach( $apartments as $name => $value ) {
		    					echo '<option value="' . $value . '" >' . $name . '</option>';
		    				}
		    			?>
		    		</select>
		    	</div>
		    </div>
		    <div id="booking-calendar"></div>
		</div>
    <?php
}

?>