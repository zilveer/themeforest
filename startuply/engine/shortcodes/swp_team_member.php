<?php

/*-----------------------------------------------------------------------------------*/
/*	Team member VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map( array(
				"name" => __( "Team member", "vivaco" ),
				"weight" => 20,
				"base" => "vsc-team-member-new",
				"icon" => "icon-team-member",
				"category" => __( "Content", "vivaco" ),
				"description" => __( "Team member shortcode", "vivaco" ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Full name", "vivaco" ),
						"param_name" => "name",
						"description" => __( "Enter name.", "vivaco" ),
						"admin_label" => true
					),
					array(
						"type" => "textfield",
						"heading" => __( "Company position", "vivaco" ),
						"param_name" => "position",
						"description" => __( "Enter company position.", "vivaco" ),
						"admin_label" => true
					),
					array(
						"type" => "textfield",
						"heading" => __( "Member description", "vivaco" ),
						"param_name" => "description",
						"description" => __( "Enter member description.", "vivaco" )
					),
					array(
						"type" => "attach_image",
						"heading" => __( "Photo", "vivaco" ),
						"param_name" => "photo",
						"description" => __( "Upload photo.", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Email address", "vivaco" ),
						"param_name" => "email",
						"description" => __( "Enter email.", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Twitter handle", "vivaco" ),
						"param_name" => "twitter",
						"description" => __( "Enter Twitter handle.", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Facebook URL", "vivaco" ),
						"param_name" => "facebook",
						"description" => __( "Enter Facebook URL.", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __("Skype handle", "vivaco"),
						"param_name" => "skype",
						"description" => __("Enter Skype handle.", "vivaco")
					),
					array(
						"type" => "textfield",
						"heading" => __("LinkedIn URL", "vivaco"),
						"param_name" => "linked_in",
						"description" => __("Enter LinkedIn URL.", "vivaco")
					),
					array(
						"type" => "textfield",
						"heading" => __("Google+ URL", "vivaco"),
						"param_name" => "google_plus",
						"description" => __("Enter Google+ URL.", "vivaco")
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Options", "vivaco" ),
						"param_name" => "options",
						"value" => array(
							__( "Magazine cover", "vivaco" ) => "magazine"
						)
					)
				)
			) );





/*-----------------------------------------------------------------------------------*/
/*	Team member VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_team_member_new($atts, $content = null) {
	$name = $position = $description = $photo = $email = $twitter = $facebook = $skype = $linked_in = $google_plus = $options = '';
	$output = $name_str = $position_str = $img_val = $img = $description_str = $social = $twitter_url = $facebook_url = '';
	$magazine = false;

	extract(shortcode_atts(array(
		"name" => '',
		"position" => '',
		"description" => '',
		"photo" => '',
		"email" => '',
		"twitter" => '',
		"facebook" => '',
		"skype" => '',
		"linked_in" => '',
		"google_plus" => '',
		"options" => ''
	), $atts));

	$options = explode( ',', $options );
	if ( in_array( 'magazine', $options ) ) $magazine = true;

	if ($photo != '') {
		if (function_exists('wpb_getImageBySize')) {
			$img_val = wpb_getImageBySize(array(
				'attach_id' => (int) $photo,
				'thumb_size' => 'full'
			));
		}

		$img = $img_val['p_img_large'][0];
	} else {
		$img = '<img src="" class="no-image" alt="">';
	}

	if ($name != '') {
		$name_str = '<h3 class="member-name base_clr_txt">' . $name . '</h3>';
	}

	if ($position != '') {
		$position_str = '<span class="heading-font">' . $position . '</span>';
	}

	if ($description != '') {
		$description_str = '<p>';
		if ($magazine) $description_str .= $position_str;
		$description_str .= $description . '</p>';
	}

	$socials = array();

	if (!empty($email)) $socials[] = $email;
	if (!empty($twitter)) $socials[] = $twitter;
	if (!empty($facebook)) $socials[] = $facebook;
	if (!empty($skype)) $socials[] = $skype;
	if (!empty($linked_in)) $socials[] = $linked_in;
	if (!empty($google_plus)) $socials[] = $google_plus;

	if (count($socials) != 0) {
		$social = '<ul class="socials-block' . ((count($socials) < 3) ? ' center' : '') . '">';

		if ($email != '') {
			$social .= "\n\t\t" . '<li><a href="mailto:' . $email . '" class="base_clr_brd base_clr_bg email" title="' . $email . '">';
			if ($magazine) $social .= '<i class="icon icon-chat-messages-13"></i>';
			else $social .= '<i class="fa fa-envelope-o"></i>';
			$social .= '</a></li>';

			// if ($magazine)
		}

		if ($twitter != '') {
			$twitter_url = str_replace(array(
					'https://twitter.com/',
					'http://twitter.com/'
				), array(
					'',
					''
				), $twitter);

			$social .= "\n\t\t" . '<li><a href="https://twitter.com/' . $twitter_url . '" class="base_clr_brd base_clr_bg twitter" title="' . $twitter_url . '" target="_blank">';
			if ($magazine) $social .= '<i class="icon icon-socialmedia-07"></i>';
			else $social .= '<i class="fa fa-twitter"></i>';
			$social .= '</a></li>';
		}

		if ($facebook != '') {
			$facebook_url = str_replace(array(
					'https://www.facebook.com/',
					'http://www.facebook.com/'
				), array(
					'',
					''
				), $facebook);

			$social .= "\n\t\t" . '<li><a href="https://facebook.com/' . $facebook_url . '" class="base_clr_brd base_clr_bg facebook" title="' . $facebook_url . '" target="_blank">';
			if ($magazine) $social .= '<i class="icon icon-socialmedia-08"></i>';
			else $social .= '<i class="fa fa-facebook"></i>';
			$social .= '</a></li>';
		}

		if ($skype != '') {
			$social .= "\n\t\t" . '<li><a href="skype:' . $skype . '?chat" class="base_clr_brd base_clr_bg skype" title="' . $skype . '">';
			if ($magazine) $social .= '<i class="icon icon-socialmedia-09"></i>';
			else $social .= '<i class="fa fa-skype"></i>';
			$social .= '</a></li>';
		}

		if ($linked_in != '') {
			$linked_in_url = $linked_in;

			$social .= "\n\t\t" . '<li><a href="' . $linked_in_url . '" class="base_clr_brd base_clr_bg linked_in" title="' . $linked_in_url . '" target="_blank">';
			if ($magazine) $social .= '<i class="icon icon-socialmedia-05"></i>';
			else $social .= '<i class="fa fa-linkedin"></i>';
			$social .= '</a></li>';
		}

		if ($google_plus != '') {
			$google_plus_url = str_replace(array(
					'https://plus.google.com/',
					'http://plus.google.com/',
					'u/0/',
					'/posts'
				), array(
					'',
					'',
					'',
					''
				), $google_plus);

			$social .= "\n\t\t" . '<li><a href="https://plus.google.com/' . $google_plus_url . '" class="base_clr_brd base_clr_bg google_plus" title="' . $google_plus_url . '" target="_blank">';
			if ($magazine) $social .= '<i class="icon icon-socialmedia-16"></i>';
			else $social .= '<i class="fa fa-google-plus"></i>';
			$social .= '</a></li>';
		}

		$social .= '</ul>';

	}

	$output .= "\n\t" . '<div class="vsc_team_member wpb_content_element' . (($magazine) ? ' magazine' : '') . '">';
	$output .= "\n\t\t" . '<div class="photo-wrapper base_clr_bg" style="background-image: url(' . $img . ');">';
	$output .= "\n\t\t\t" . '<div class="meta-overlay">';
	$output .= "\n\t\t\t\t" . '<div class="text-wrapper">';
	$output .= "\n\t\t\t\t\t" . '<div class="text-container">';
	$output .= "\n\t\t\t\t\t" . $description_str;
	$output .= "\n\t\t\t\t\t" . '</div>';
	$output .= "\n\t\t\t\t" . '</div>';
	$output .= "\n\t\t\t\t" . $social;
	$output .= "\n\t\t\t" . '</div>';
	if ($magazine) $output .= "\n\t\t\t" . $name_str;
	$output .= "\n\t\t" . '</div>';
	if (!$magazine) $output .= "\n\t\t" . $name_str;
	if (!$magazine) $output .= "\n\t\t" . $position_str;
	$output .= "\n\t\t" . $social;
	$output .= "\n\t" . '</div>';

	return $output;
}

add_shortcode('vsc-team-member-new', 'vsc_team_member_new');
