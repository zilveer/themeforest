<?php
add_shortcode( 'themeum_person', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'person_img' => '',
		'person_name' => '',
		'person_deg'	=> '',
		'person_desc'	=> '',
		'facebook_url' => '',
		'twitter_url' => '',
		'gplus_url' => '',
		'linkedin_url' => '',
		'pinterest_url' => '',
		'delicious_url' => '',
		'tumblr_url' => '',
		'stumbleupon_url' => '',
		'dribble_url' => ''
		), $atts));



	$output  	 = '<div class="person-box">';
	$output  	.= '<div class="person-img">';
	$src_image   = wp_get_attachment_image_src($person_img, 'full');

	$output  	.= '<img src="' . $src_image[0]. '" class="img-responsive" alt="photo">';
	$output  	.= '<div class="person-details">';
	$output 	.= $person_desc;
	$output 	.= '<div class="person-social">';
	$output 	.= '<ul class="social-profile">';

	if(isset($facebook_url) && !empty($facebook_url)) {
		$output 	.= '<li><a class="facebook" href="' . $facebook_url . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
	}

	if(isset($twitter_url) && !empty($twitter_url)) {
		$output 	.= '<li><a class="twitter" href="' . $twitter_url . '" target="_blank" ><i class="fa fa-twitter"></i></a></li>';
	}	

	if(isset($gplus_url) && !empty($gplus_url)) {
		$output 	.= '<li><a class="g-plus" href="' . $gplus_url . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
	}	

	if(isset($linkedin_url) && !empty($linkedin_url)) {
		$output 	.= '<li><a class="linkedin" href="' . $linkedin_url . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
	}

	if(isset($pinterest_url) && !empty($pinterest_url)) {
		$output 	.= '<li><a class="pinterest" href="' . $pinterest_url . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
	}	

	if(isset($delicious_url) && !empty($delicious_url)) {
		$output 	.= '<li><a class="delicious" href="' . $delicious_url . '" target="_blank"><i class="fa fa-delicious"></i></a></li>';
	}	

	if(isset($tumblr_url) && !empty($tumblr_url)) {
		$output 	.= '<li><a class="tumblr" href="' . $tumblr_url . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>';
	}	

	if(isset($stumbleupon_url) && !empty($stumbleupon_url)) {
		$output 	.= '<li><a class="stumbleupon" href="' . $stumbleupon_url . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>';
	}	

	if(isset($dribble_url) && !empty($dribble_url)) {
		$output 	.= '<li><a class="dribble" href="' . $dribble_url . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
	}
	$output 	.= '</ul>';
	$output 	.= '</div>';
	$output 	.= '</div>';
	$output 	.= '</div>';

	$output .= '<h3 class="person-title">' . $person_name . '</h3>';
	$output .= '<span class="person-deg">' . $person_deg . '</span>';
	

	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Person", "themeum"),
		"base" => "themeum_person",
		'icon' => 'icon-thm-person',
		"class" => "",
		"description" => __("Widget Title Heading", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "attach_image",
				"heading" => __("Upload Person Image", "themeum"),
				"param_name" => "person_img",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textfield",
				"heading" => __("Person Name", "themeum"),
				"param_name" => "person_name",
				"value" => "",
				"admin_label"=>true,
				),

			array(
				"type" => "textfield",
				"heading" => __("Team Designation", "themeum"),
				"param_name" => "person_deg",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textarea",
				"heading" => __("Person description", "themeum"),
				"param_name" => "person_desc",
				"value" => "",
				"admin_label"=>true,
				),

			array(
				"type" => "textfield",
				"heading" => __("Facebook URL", "themeum"),
				"param_name" => "facebook_url",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textfield",
				"heading" => __("Twitter URL", "themeum"),
				"param_name" => "twitter_url",
				"value" => "",
				"admin_label"=>true,
				),

			array(
				"type" => "textfield",
				"heading" => __("Google Plus URL", "themeum"),
				"param_name" => "gplus_url",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textfield",
				"heading" => __("Linkedin URL", "themeum"),
				"param_name" => "linkedin_url",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textfield",
				"heading" => __("Pinterest URL", "themeum"),
				"param_name" => "pinterest_url",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textfield",
				"heading" => __("Delicious URL", "themeum"),
				"param_name" => "delicious_url",
				"value" => "",
				"admin_label"=>true,
				),

			array(
				"type" => "textfield",
				"heading" => __("Tumblr URL", "themeum"),
				"param_name" => "tumblr_url",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textfield",
				"heading" => __("Stumbleupon URL", "themeum"),
				"param_name" => "stumbleupon_url",
				"value" => "",
				"admin_label"=>true,
				),

			array(
				"type" => "textfield",
				"heading" => __("Dribble URL", "themeum"),
				"param_name" => "dribble_url",
				"value" => "",
				"admin_label"=>true,
				),

			)
		));
}