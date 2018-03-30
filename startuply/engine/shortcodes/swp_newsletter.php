<?php

/*-----------------------------------------------------------------------------------*/
/*	Newsletter VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			$form_tpl = '{form}{name}{email}{submit}{response}{/form}';

			vc_map(array(
				"name" => __("Newsletter", "vivaco"),
				"description" => "Mailchimp subscribe",
				"weight" => 15,
				"base" => "vsc-newsletter",
				"class" => "newsletter_extended",
				"icon" => "icon-newsletter",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __("MailChimp API key", "vivaco"),
						"param_name" => "api_key",
						"admin_label" => true,
						"description" => __("Enter MailChimp API key here. <a href=\"mailchinp.help.html\">Where can i find my api key?</a>", "vivaco")
					),
					array(
						"type" => "textfield",
						"heading" => __("MailChimp List ID", "vivaco"),
						"param_name" => "list_id",
						"admin_label" => true,
						"description" => __("Enter MailChimp List ID here. <a href=\"mailchinp.help.html\">Where can i find my List ID?</a>", "vivaco")
					),
					array(
						"type" => "checkbox",
						"heading" => __("Double opt", "vivaco"),
						"param_name" => "double_opt",
						"value" => array(
							__("Check this box to control whether a double opt-in confirmation messege is sent", "vivaco") => "yes"
						),
						"description" => __("Flag to control whether a double opt-in confirmation message is sent.", "vivaco")
					),
					array(
						"type" => "textarea_html",
						/*"holder" => "hidden",*/
						"heading" => __("Form HTML", "vivaco"),
						//"param_name" => "form_html",
						"param_name" => "content",
						//"value" => base64_encode($form_tpl),
						"value" => $form_tpl,
						"description" => "Define a title for the section"
					)
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Newsletter VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_newsletter($atts, $content = null) {
	extract(shortcode_atts(array(
		"api_key" => '',
		"list_id" => '',
		"double_opt" => '',
		/*"form_html" => ''*/
	), $atts));

	$rnd_id = vsc_random_id(3);

	//$output = do_shortcode(rawurldecode(base64_decode(strip_tags($form_html))));
	$output = do_shortcode($content);

	$dopt = isset($double_opt) && $double_opt == 'yes' ? 'true' : 'false';

	$output = str_replace(array(
		'{form}',
		'{name}',
		'{email}',
		'{submit}',
		'{response}',
		'{/form}'
	), array(
		'<form id="subscribe_' . $rnd_id . '" class="form subscribe-form" method="post"><input type="hidden" class="apiKey" name="apiKey" value="' . $api_key . '" /><input type="hidden" class="listId" name="listId" value="' . $list_id . '" /><input type="hidden" class="dopt" name="dopt" value="' . $dopt . '" />',
		'<div class="col-sm-4"><input type="text" class="NewsletterName form-control" name="NewsletterName" placeholder="Your name" /></div>',
		'<div class="col-sm-4"><input type="email" class="NewsletterEmail form-control" name="NewsletterEmail" placeholder="your@email.com" /></div>',
		'<div class="col-sm-4"><input class="btn base_clr_txt btn-outline" type="submit" value="SUBSCRIBE" /></div>',
		'<span class="wrapper-response-block"><span class="response_wrap" id="response_' . $rnd_id . '"></span></span>',
		'</form>'
	), $output);

	return $output;
}
add_shortcode("vsc-newsletter", "vsc_newsletter");

