<?php

/*
 * BuildPress Contact Us Template for Visual Composer
 */

add_action( 'vc_load_default_templates_action','buildpress_contact_us_template_for_vc' );

function buildpress_contact_us_template_for_vc() {
	$data               = array();
	$data['name']       = _x( 'BuildPress: Contact Us', 'backend' , 'buildpress_wp' );
	$data['weight']     = 0;
	$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/pt.svg' );
	$data['custom_class'] = 'buildpress_contact_us_template_for_vc_custom_template';
	$data['content']    = <<<CONTENT
		[vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1459341225928{margin-top: -60px !important;margin-bottom: 30px !important;}"][vc_column][pt_vc_container_google_map zoom="7" height="380"][pt_vc_location custompinimage="http://xml-io.proteusthemes.com/buildpress/wp-content/themes/buildpress/assets/images/map_pin.png"][/pt_vc_container_google_map][/vc_column][/vc_row][vc_row css=".vc_custom_1459341293025{margin-bottom: 30px !important;}"][vc_column][vc_column_text]
		<h3 class="widget-title">Contact Us</h3>
		[/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1459341326007{margin-bottom: 0px !important;}"][vc_column width="1/4"][vc_column_text css=".vc_custom_1459341083743{margin-bottom: 0px !important;}"][fa icon="fa-home"] <b>BuildPress, llc.</b>
		227 Marion Street
		Columbia, SC 29201

		[fa icon="fa-phone"] <b>1-888-123-4567</b>
		[fa icon="fa-fax"] <b>1-888-123-4568</b>
		[fa icon="fa-envelope"] <a href="mailto:example@info.com">info@buildpress.com</a>

		[fa icon="fa-clock-o""] <b>Mon - Fir 8.00 - 18.00</b>
		Saturday - Sunday CLOSED[/vc_column_text][pt_vc_social_icons btn_link_0="https://www.facebook.com/ProteusThemes#" btn_link_1="https://twitter.com/ProteusNetCom" btn_link_2="https://www.youtube.com/user/ProteusNetCompany" new_tab="true"][/vc_column][vc_column width="3/4"][vc_column_text][contact-form-7 id="5" title="Contact Us"][/vc_column_text][/vc_column][/vc_row]
CONTENT;

	vc_add_default_templates( $data );
}