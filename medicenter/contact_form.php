<?php
global $themename;
//contact form
function theme_contact_form_shortcode($atts)
{
	extract(shortcode_atts(array(
		"id" => "contact_form",
		"header" => __("Online Appointment Form ", 'medicenter'),
		"animation" => 0,
		"department_select_box" => 1,
		"department_select_box_title" => __("Select department", 'medicenter'),
		"height" => "300px",
		"map_type" => "ROADMAP",
		"lat" => "-37.732304",
		"lng" => "144.868641",
		"marker_lat" => "-37.732304",
		"marker_lng" => "144.868641",
		"zoom" => "12",
		"streetviewcontrol" => "false",
		"maptypecontrol" => "false",
		"icon_url" => get_template_directory_uri() . "/images/map_pointer.png",
		"icon_width" => 38,
		"icon_height" => 45,
		"icon_anchor_x" => 18,
		"icon_anchor_y" => 44,
		"top_margin" => "page_margin_top"
	), $atts));
	
	$output = "";
	if($header!="")
		$output .= '<h3 class="box_header' . ((int)$animation ? ' animation-slide' : '') . ($top_margin!="none" ? ' ' . $top_margin : '') . '">' . $header . '</h3>';
	$output .= '<form class="contact_form ' . ($top_margin!="none" && $header!="" ? $top_margin : 'page_margin_top') . '" id="' . $id . '" method="post" action="">';
	if((int)$department_select_box)
	{
		//get departments list
		$departments_list = get_posts(array(
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'post_type' => 'departments'
		));
		if(count($departments_list))
		{
			$output .= '<ul class="clearfix tabs_box_navigation sf-menu">
				<li class="tabs_box_navigation_selected wide" aria-haspopup="true">
					<input type="hidden" name="department" value="" />
					<span>' . $department_select_box_title . '</span>
					<ul class="sub-menu">';
			foreach($departments_list as $department)
				$output .= '<li><a href="#' . urldecode($department->post_name) . '" title="' . esc_attr($department->post_title) . '">' . $department->post_title . '</a></li>';
			$output .= '</ul>
				</ul>';
			$output .= '<input type="hidden" id="department_select_box_title" value="' . esc_attr($department_select_box_title) . '">';
		}
	}
	$output .= '<fieldset class="left">
		<label>' . __("First Name", 'medicenter') . '</label>
			<div class="block">
				<input class="text_input" name="first_name" type="text" value="" />
			</div>
			<label>' . __("Date of Birth (mm/dd/yyyy)", 'medicenter') . '</label>
			<div class="block">
				<input class="text_input" type="text" name="date_of_birth" value="" />
			</div>
			<label>' . __("Phone Number", 'medicenter') . '</label>
			<div class="block">
				<input class="text_input" name="phone_number" type="text" value="" />
			</div>
		</fieldset>
		<fieldset class="right">
			<label>' . __("Last Name", 'medicenter') . '</label>
			<div class="block">
				<input class="text_input" type="text" name="last_name" value="" />
			</div>
			<label>' . __("Social Security Number", 'medicenter') . '</label>
			<div class="block">
				<input class="text_input" type="text" name="social_security_number" value="" />
			</div>
			<label>' . __("E-mail", 'medicenter') . '</label>
			<div class="block">
				<input class="text_input" type="text" name="email" value="" />
			</div>
		</fieldset>
		<fieldset style="clear:both;">
			<label>' . __("Reason of Appointment", 'medicenter') . '</label>
			<div class="block">
				<textarea name="message"></textarea>
			</div>
			<input type="hidden" name="action" value="theme_contact_form" />
			<input type="hidden" name="id" value="' . $id . '" />
			<input type="submit" name="submit" value="' . __("Send", 'medicenter') . '" class="more mc_button" />
		</fieldset>
	</form>';
	return $output;
}
add_shortcode($themename . "_contact_form", "theme_contact_form_shortcode");

//visual composer
function theme_contact_form_vc_init()
{
	vc_map( array(
		"name" => __("Contact form", 'medicenter'),
		"base" => "medicenter_contact_form",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-contact-form",
		"category" => __('MediCenter', 'medicenter'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'medicenter'),
				"param_name" => "id",
				"value" => "contact_form",
				"description" => __("Please provide unique id for each contact form on the same page/post", 'medicenter')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Header", 'medicenter'),
				"param_name" => "header",
				"value" => __("Online Appointment Form ", 'medicenter')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Header border animation", 'medicenter'),
				"param_name" => "animation",
				"value" => array(__("no", 'medicenter') => 0,  __("yes", 'medicenter') => 1)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Display department select box", 'medicenter'),
				"param_name" => "department_select_box",
				"value" => array(__("yes", 'medicenter') => 1, __("no", 'medicenter') => 0)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Department select box title", 'medicenter'),
				"param_name" => "department_select_box_title",
				"value" => __("Select department", 'medicenter')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'medicenter'),
				"param_name" => "top_margin",
				"value" => array(__("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section",  __("None", 'medicenter') => "none")
			)
		)
	));
}
add_action("init", "theme_contact_form_vc_init");

//contact form submit
function theme_contact_form()
{
	ob_start();
	global $theme_options;

    mc_get_theme_file("/phpMailer/class.phpmailer.php");

    $result = array();
	$result["isOk"] = true;
	if($_POST["first_name"]!="" && $_POST["last_name"]!="" && $_POST["email"]!="" && preg_match("#^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$#", $_POST["email"]) && $_POST["message"]!="")
	{
		$values = array(
			"department" => $_POST["department"],
			"first_name" => $_POST["first_name"],
			"last_name" => $_POST["last_name"],
			"date_of_birth" => $_POST["date_of_birth"],
			"phone_number" => $_POST["phone_number"],
			"social_security_number" => $_POST["social_security_number"],
			"email" => $_POST["email"],
			"message" => $_POST["message"]
		);
		if((bool)ini_get("magic_quotes_gpc")) 
			$values = array_map("stripslashes", $values);
		$values = array_map("htmlspecialchars", $values);

		$mail=new PHPMailer();

		$mail->CharSet='UTF-8';

		$mail->AddReplyTo($values["email"], $values["first_name"] . " " . $values["last_name"]);
		$mail->SetFrom($theme_options["cf_admin_email"], $theme_options["cf_admin_name"]);
		$mail->AddAddress($theme_options["cf_admin_email"], $theme_options["cf_admin_name"]);

		$smtp = $theme_options["cf_smtp_host"];
		if(!empty($smtp))
		{
			$mail->IsSMTP();
			$mail->SMTPAuth = true; 
			$mail->Host = $theme_options["cf_smtp_host"];
			$mail->Username = $theme_options["cf_smtp_username"];
			$mail->Password = $theme_options["cf_smtp_password"];
			if((int)$theme_options["cf_smtp_port"]>0)
				$mail->Port = (int)$theme_options["cf_smtp_port"];
			$mail->SMTPSecure = $theme_options["cf_smtp_secure"];
		}
		
		$subject = $theme_options["cf_email_subject"];
		$subject = str_replace("[department]", $values["department"], $subject);
		$subject = str_replace("[first_name]", $values["first_name"], $subject);
		$subject = str_replace("[last_name]", $values["last_name"], $subject);
		$subject = str_replace("[date]", $values["date_of_birth"], $subject); 
		$subject = str_replace("[social_security_number]", $values["social_security_number"], $subject);
		$subject = str_replace("[phone_number]", $values["phone_number"], $subject);
		$subject = str_replace("[email]", $values["email"], $subject);
		$subject = str_replace("[message]", $values["message"], $subject);
		$mail->Subject = $subject;
		$body = $theme_options["cf_template"];
		$body = str_replace("[department]", $values["department"], $body);
		$body = str_replace("[first_name]", $values["first_name"], $body);
		$body = str_replace("[last_name]", $values["last_name"], $body);
		$body = str_replace("[date]", $values["date_of_birth"], $body); 
		$body = str_replace("[social_security_number]", $values["social_security_number"], $body);
		$body = str_replace("[phone_number]", $values["phone_number"], $body);
		$body = str_replace("[email]", $values["email"], $body);
		$body = str_replace("[message]", $values["message"], $body);
		$mail->MsgHTML($body);

		if($mail->Send())
			$result["submit_message"] = __("Thank you for contacting us", 'medicenter');
		else
		{
			$result["isOk"] = false;
			$result["submit_message"] = __("Sorry, we can't send this message", 'medicenter');
		}
	}
	else
	{
		$result["isOk"] = false;
		if($_POST["first_name"]=="")
			$result["error_first_name"] = __("Please enter your first name.", 'medicenter');
		if($_POST["last_name"]=="")
			$result["error_last_name"] = __("Please enter your last name.", 'medicenter');
		if($_POST["email"]=="" || !preg_match("#^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$#", $_POST["email"]))
			$result["error_email"] = __("Please enter valid e-mail.", 'medicenter');
		if($_POST["message"]=="")
			$result["error_message"] = __("Please enter your message.", 'medicenter');
	}
	$system_message = ob_get_clean();
	$result["system_message"] = $system_message;
	echo @json_encode($result);
	exit();
}
add_action("wp_ajax_theme_contact_form", "theme_contact_form");
add_action("wp_ajax_nopriv_theme_contact_form", "theme_contact_form");
?>