<?php
function onioneye_contact_info( $atts ) {
	
	extract( shortcode_atts(array(
	  'name' => '',
	  'address' => '',
	  'city' => '',
	  'state' => '',
	  'zip' => '',
	  'phone' => '',
	  'email' => '',
	), $atts));
	
	return '<!-- START .contact-info-shortcode -->' .
		   '<ul class="contact-info-shortcode">' . 
				'<li class="contact-info location">' . $name . 
					'<span class="street-address">' . $address . '</span>' .
					'<span class="city-zip">' . $city . ' ' . $zip . '</span>' . 
					'<span class="state">' . $state . '</span>' . 
				'</li>' .
				'<li class="contact-info telephone">' . $phone . '</li>' .
				'<li class="contact-info my-mail">' . $email . '</li>' .
		   '</ul>' .
		   '<!-- END .contact-info-shortcode -->';	   
}

add_shortcode( 'contact_info', 'onioneye_contact_info' );
?>