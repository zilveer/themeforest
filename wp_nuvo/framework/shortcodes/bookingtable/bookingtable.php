<?php
add_action('wp_print_scripts', 'cs_booking_dequeue_script');

function cs_booking_dequeue_script()
{
    if (! is_admin()) {
        wp_deregister_style('pickadate-default');
        wp_register_style('pickadate-default', get_template_directory_uri() . '/framework/shortcodes/bookingtable/css/classic.css');
        wp_deregister_style('pickadate-date');
        wp_register_style('pickadate-date', get_template_directory_uri() . '/framework/shortcodes/bookingtable/css/classic.date.css');
        wp_deregister_style('pickadate-time');
        wp_register_style('pickadate-time', get_template_directory_uri() . '/framework/shortcodes/bookingtable/css/classic.time.css');
        
        wp_deregister_style('rtb-booking-form');
        wp_dequeue_style('rtb-booking-form');
        
        wp_deregister_script('rtb-booking-form');
        wp_register_script('rtb-booking-form',get_template_directory_uri() . '/framework/shortcodes/bookingtable/js/booking-form.js', array('jquery'));
    }
}

function cs_booking_request_input($input = ''){
    global $rtb_controller;
    $request = $rtb_controller->request;
    //var_dump($request);
    return !empty($request) ? !empty($request->$input) ? $request->$input : null : null;
}

add_shortcode('cs-booking-form', 'cs_booking_form');

function cs_booking_form($params, $content = null)
{
    global $rtb_controller;
    
    //wp_enqueue_style('intlTelInput', get_template_directory_uri() . '/framework/shortcodes/bookingtable/css/intlTelInput.css');
    //wp_enqueue_script('intlTelInput',get_template_directory_uri() . '/framework/shortcodes/bookingtable/js/intlTelInput.min.js', array('jquery'));
    //wp_enqueue_script('bookingtable',get_template_directory_uri() . '/framework/shortcodes/bookingtable/js/bookingtable.js', array('intlTelInput'));
    
    // Only allow the form to be displayed once on a page
    if ( $rtb_controller->form_rendered === true ) {
        return;
    } else {
        $rtb_controller->form_rendered = true;
    }
    
    // Enqueue assets for the form
    rtb_enqueue_assets();
    
    // Allow themes and plugins to override the booking form's HTML output.
    $output = apply_filters( 'rtb_booking_form_html_pre', '' );
    if ( !empty( $output ) ) {
        return $output;
    }
    
    // Process a booking request
    if ( !empty( $_POST['action'] ) && $_POST['action'] == 'booking_request' ) {
    
        if ( get_class( $rtb_controller->request ) === 'stdClass' ) {
            require_once( RTB_PLUGIN_DIR . '/includes/Booking.class.php' );
            $rtb_controller->request = new rtbBooking();
        }
    
        $rtb_controller->request->insert_booking();
    }
    
    // Define the form's action parameter
    $booking_page = $rtb_controller->settings->get_setting( 'booking-page' );
    if ( !empty( $booking_page ) ) {
        $booking_page = get_permalink( $booking_page );
    }
    
    $settings = get_option('rtb-settings');
    
    ob_start();
    
    ?>
    <div class="cs-booking-form">
	<?php if ( $rtb_controller->request->request_inserted === true ) : ?>
	<div class="rtb-message">
		<p><?php echo $rtb_controller->settings->get_setting( 'success-message' ); ?></p>
	</div>
	<?php else : ?>
	<form id="cs-booking-form" method="POST" action="<?php echo esc_attr( $booking_page ); ?>">
		<input type="hidden" name="action" value="booking_request">
		<?php do_action( 'rtb_booking_form_before_fields' ); ?>

		<div class="row">
		    <div class="cs-bookTable-date col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<label for="rtb-date"><?php esc_html_e( 'When would you like to book?', 'wp_nuvo' ); ?></label>
				<span class="Selectoptions"><input type="text" name="rtb-date" id="rtb-date" value="<?php echo cs_booking_request_input('request_date'); ?>" placeholder="<?php esc_html_e('Select Date', 'wp_nuvo'); ?>"></span>
				<?php echo rtb_print_form_error( 'date' ); ?>
				<div id="cs-booking-date"></div>
			</div>
			<div class="cs-bookTable-party col-xs-12 col-sm-2 col-md-2 col-lg-2">
				<label for="rtb-party"><?php esc_html_e( 'Party Size :', 'wp_nuvo' ); ?></label>
				<span class="Selectoptions"><select name="rtb-party" id="rtb-party">
				    <?php
				    if(empty($settings['party-size'])){ $settings['party-size'] = 20; }
				    for($i = 1 ; $i <= $settings['party-size'] ; $i++):
				    ?>
				    <option value="<?php echo $i; ?>" <?php if(cs_booking_request_input('party') == $i) { echo 'selected'; }?>><?php echo $i; ?></option>
				    <?php endfor; ?>
				</select>
				</span>
			</div>
			<div class="cs-bookTable-time col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<label for="rtb-time"><?php esc_html_e( 'Preferred dining time:', 'wp_nuvo' ); ?></label>
				<span class="Selectoptions"><input type="text" name="rtb-time" id="rtb-time" value="<?php echo cs_booking_request_input('request_time'); ?>" placeholder="<?php esc_html_e('Select Time', 'wp_nuvo'); ?>"></span>
				<?php echo rtb_print_form_error( 'time' ); ?>
				<div id="cs-booking-time"></div>
			</div>
		</div>
		<div class="row">
		    <div class="name col-xs-12 col-sm-6 col-md-6 col-lg-6">
			     <input type="text" name="rtb-name" id="rtb-name" placeholder="<?php esc_html_e('Name', 'wp_nuvo'); ?>" value="<?php echo cs_booking_request_input('name'); ?>">
			     <?php echo rtb_print_form_error( 'name' ); ?>
			</div>
			<div class="email col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<input type="text" name="rtb-email" id="rtb-email" placeholder="<?php esc_html_e('Email', 'wp_nuvo'); ?>" value="<?php echo cs_booking_request_input('email'); ?>">
				<?php echo rtb_print_form_error( 'email' ); ?>
			</div>
		</div>
		<div class="row">
		    <div class="phone col-xs-12 col-sm-6 col-md-6 col-lg-6">
    		    <input type="text" name="rtb-phone" id="rtb-phone" placeholder="<?php esc_html_e('Phone', 'wp_nuvo'); ?>" value="<?php echo cs_booking_request_input('phone'); ?>">
			    <?php echo rtb_print_form_error( 'phone' ); ?>
			</div>
			<div class="message col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<?php echo rtb_print_form_error( 'message' ); ?>
				<input type="text" name="rtb-message" id="rtb-message" placeholder="<?php esc_html_e('Message', 'wp_nuvo'); ?>" value="<?php echo cs_booking_request_input('message'); ?>">
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php
			$fields = $rtb_controller->settings->get_booking_form_fields( $rtb_controller->request, array() );
			$_remove = array('date','time','party','name','email','phone','add-message','message');
			foreach( $fields as $fieldset => $contents ) {
				foreach( $contents['fields'] as $slug => $field ) {

					if(in_array($slug, $_remove)) continue;

					$args = empty( $field['callback_args'] ) ? null : $field['callback_args'];

					call_user_func( $field['callback'], $slug, $field['title'], $field['request_input'], $args );
				}
			}
			?>
			</div>
		</div>

		<?php do_action( 'rtb_booking_form_after_fields' ); ?>

		<div class="cs-bookTable-submit">
			<button class="btn btn-default" type="submit"><?php esc_html_e( 'BOOK MY TABLE', 'wp_nuvo' ); ?></button>
			<span class="des-text"><?php echo esc_html_e('Please submit your reservation details and we will contact you to confirm your booking ','wp_nuvo');?></span>
		</div>

	</form>
	<?php endif; ?>
    </div>
    
    <?php

	$output = ob_get_clean();

	$output = apply_filters( 'rtb_booking_form_html_post', $output );

	return $output;
}