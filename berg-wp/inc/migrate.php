<?php

function berg_migrate() {
	$migrate = get_option('redux-migrate');
	$redux = get_option('redux');
	if($migrate == false){
		$yopress = get_option('YoPress-Berg');
		if(is_array($yopress)) {
			foreach($yopress as $key => $value) {
				if(isset($redux[$key])) {
					if(gettype($value) === gettype($redux[$key])) {
						$redux[$key] = $value;
					}
				}
			}
			$redux['navigation_type'] = 1;
			update_option('redux', $redux);
			$redux = berg_migrateLogo($redux);
			$redux = berg_migrateContact($redux);

			add_option('redux-migrate', 'yes');
		}
	}
}



function berg_migrateLogo($redux) {

	$yopress = get_option('YoPress-Berg');
	if(is_array($yopress)) {
			
		if(isset($yopress['logo_image_dark'])) {
			$logoDark = $yopress['logo_image_dark'];
		} else {
			$logoDark = '';
		}
		if($logoDark != '') {
			$logoDarkId = get_attachment_id_from_url($logoDark);

			if($logoDarkId != false) {
				$redux['logo_image_dark']['url'] = $logoDark;
				$redux['logo_image_dark']['id'] = $logoDarkId;
				update_option('redux', $redux);
			}
		}

		if(isset($yopress['logo_image_light'])) {
			$logoLight = $yopress['logo_image_light'];
		} else {
			$logoLight = '';
		}

		if($logoLight != '') {
			$logoLightId = get_attachment_id_from_url($logoLight);

			if($logoLightId != false) {
				$redux['logo_image_light']['url'] = $logoLight;
				$redux['logo_image_light']['id'] = $logoLightId;
				update_option('redux', $redux);
			}
		}

		if(isset($yopress['loading_image'])) {
			$loading = $yopress['loading_image'];
		} else {
			$loading = '';
		}

		if($loading != '') {
			$loadingId = get_attachment_id_from_url($loading);

			if($loadingId != false) {
				$redux['loading_image']['url'] = $loading;
				$redux['loading_image']['id'] = $loadingId;
				update_option('redux', $redux);
			}
		}
	}
	return $redux;

}

function berg_migrateContact($redux) {
	$contact = YSettings::g('multiple_contact_locations', '', true);
	$redux['multiple_contact_map_div']['multiple_contact_locations'] = $contact;
	$locations = explode("|", $contact);
	$mapLocations = array();

	foreach ($locations as $key => $value) {
		$redux['multiple_contact_map_div']["multiple_contact_map_marker_image_" . $value] = YSettings::g("multiple_contact_map_marker_image_" . $value);
		$redux['multiple_contact_map_div']["multiple_contact_map_lat_" . $value] = YSettings::g("multiple_contact_map_lat_" . $value, '', true);
		$redux['multiple_contact_map_div']["multiple_contact_map_lng_" . $value] = YSettings::g("multiple_contact_map_lng_" . $value, '', true);
		$redux['multiple_contact_map_div']["multiple_contact_marker_height_" . $value] = YSettings::g("multiple_contact_marker_height_" . $value, '', true);
		$redux['multiple_contact_map_div']["multiple_contact_marker_width_" . $value] = YSettings::g("multiple_contact_marker_width_" . $value, '', true);
		$redux['multiple_contact_map_div']["multiple_contact_address_header_" . $value] = '';
		$redux['multiple_contact_map_div']["multiple_contact_address_desc_" . $value] = '';
		$redux['multiple_contact_map_div']["multiple_contact_map_address_" . $value] = YSettings::g("multiple_contact_address_" . $value, '', true);
	}
	update_option('redux', $redux);
	return $redux;
}