<?php
if(!function_exists('theme_section_logo')){
/**
 * The default template for displaying title in the pages
 */
function theme_section_logo(){
	$post_id = theme_get_queried_object_id();

	$custom_logo = theme_get_logo();
	$mobile_logo = theme_get_mobile_logo();
	
	if(theme_get_option('general','display_logo') && $custom_logo){

		$the_custom_logo = theme_get_image_src($custom_logo);

		$the_mobile_logo = theme_get_image_src($mobile_logo);

		$width = '';$height = '';$mobile_width = '';$mobile_height = '';

		if(isset($custom_logo['type']) && $custom_logo['type'] == 'attachment_id') {
			$metadata = wp_get_attachment_metadata($custom_logo['value']);
			
			if(isset($metadata['width'])) {
				$width = $metadata['width'];
			}
			if(isset($metadata['height'])) {
				$height = $metadata['height'];
			}
		}
		if($mobile_logo && isset($mobile_logo['type']) && $mobile_logo['type'] == 'attachment_id') {
			$mobile_metadata = wp_get_attachment_metadata($mobile_logo['value']);
			
			if(isset($metadata['width'])) {
				$mobile_height = $mobile_metadata['width'];
			}
			if(isset($metadata['height'])) {
				$mobile_height = $mobile_metadata['height'];
			}
		}

		$output = '<div id="logo"'.($mobile_logo?' class="logo-has-mobile"':'').'>';
		$output .= '<a href="'.home_url( '/' ).'">';
		$output .= '<img class="site-logo ie_png" width="'.$width.'" height="'.$height.'" src="'.$the_custom_logo.'" alt="'.get_bloginfo('name').'"/>';
		if($mobile_logo){
			$output .= '<img class="mobile-logo ie_png" width="'.$mobile_width.'" height="'.$mobile_height.'" src="'.$the_mobile_logo.'" alt="'.get_bloginfo('name').'"/>';
		}
		$output .= '</a>';
		
		if(theme_get_option('general','display_site_desc')){
			$site_desc = get_bloginfo( 'description' );
			if(!empty($site_desc)){
				$output .= '<div id="site_description">'.get_bloginfo( 'description' ).'</div>';
			}
		}
		$output .= '</div>';
	} else {
		$output = '<div id="logo_text">';
		$output .= '<a id="site_name" href="'.home_url( '/' ).'">'.get_bloginfo('name').'</a>';
		if(theme_get_option('general','display_site_desc')){
			$site_desc = get_bloginfo( 'description' );
			if(!empty($site_desc)){
				$output .= '<div id="site_description">'.get_bloginfo( 'description' ).'</div>';
			}
		}
		$output .= '</div>';
	}

	return $output;
}
}