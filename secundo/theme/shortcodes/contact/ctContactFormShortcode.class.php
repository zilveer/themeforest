<?php
/**
 * Contact form shortcode
 */
class ctContactFormShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Contact form';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'contact_form';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$id = rand(100, 1000);
		$js = 'jQuery(document).ready(function () {
					jQuery("#contactFormSubmit_' . $id . '").click(function(){
						var $name = jQuery("#contactFormName_' . $id . '").val();
						var $email = jQuery("#contactFormEmail_' . $id . '").val();
						var $text = jQuery("#contactFormText_' . $id . '").val();
						jQuery.ajax({
							type: "POST",
							  url: "' . get_site_url() . '/wp-admin/admin-ajax.php",
							  data: {
									action: "ContactFormAjax",
									name: $name,
									email: $email,
									text: $text,
									mailto: "' . $mailto . '",
									subject: "' . $subject . '"
							  },
							success: function (data, textStatus, XMLHttpRequest){
							    jQuery("#contactFormError_' . $id . '") . html("");
								jQuery("#contactFormInfo_' . $id . '") . html("");
								jQuery("#contactFormEmail_' . $id . '").removeClass("error");
								jQuery("#contactFormText_' . $id . '").removeClass("error");

								result = jQuery.parseJSON(data);
								jQuery.each(result, function(index, value) {
									if(index=="global" && value==true){
										jQuery("#contactFormInfo_' . $id . '") . text("' . $success . '");
										jQuery("#form-horizontal' . $id . '").find("input:not(.btn), textarea").attr("value", "");
									}
									if(index=="global" && value==false){
										jQuery("#contactFormError_' . $id . '") . text("' . $fail . '");
									}
									if(index=="email" && value==false){
										jQuery("#contactFormEmail_' . $id . '").addClass("error");
									}
									if(index=="text" && value==false){
										jQuery("#contactFormText_' . $id . '").addClass("error");
									}
								});
							},
							error: function (MLHttpRequest, textStatus, errorThrown){
								jQuery("#contactFormEmail_' . $id . '").removeClass("error");
								jQuery("#contactFormText_' . $id . '").removeClass("error");
								jQuery("#contactFormInfo_' . $id . '") . html("");
								jQuery("#contactFormError_' . $id . '") . html("");
								jQuery("#contactFormError_' . $id . '") . text("' . $fail . '");
							}
						})
						return false;
					});
				});';

		$this->addInlineJS($js);

		$placeholders = $placeholders == 'yes' ? true : false;

		return do_shortcode('<div class="rightPadd20">
										<div class="contactFormInfo" id="contactFormInfo_' . $id . '"></div>
										<div class="contactFormError" id="contactFormError_' . $id . '"></div>
										<form class="form-horizontal" id="form-horizontal' . $id . '">
											<fieldset>
												<div class="control-group">
													<label class="control-label" for="contactFormName_' . $id . '">' . __('NAME', 'ct_theme') . '</label>

													<div class="controls">
														<input type="text" id="contactFormName_' . $id . '" class="span12"' . $this->getPlaceHolder($placeholders, $name) . '>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="contactFormEmail_' . $id . '">' . __('EMAIL', 'ct_theme') . '</label>

													<div class="controls">
														<input type="text" id="contactFormEmail_' . $id . '" class="span12"' . $this->getPlaceHolder($placeholders, $email) . '>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="contactFormText_' . $id . '">' . __('MESSAGE', 'ct_theme') . '</label>

													<div class="controls">
														<textarea rows="10" id="contactFormText_' . $id . '" class="span12"' . $this->getPlaceHolder($placeholders, $message) . '></textarea>
													</div>
												</div>
												<div class="control-group">

													<div class="controls doRight">
														<input type="submit" id="contactFormSubmit_' . $id . '" value="' . $buttontext . '" class="btn vorange vlarge">
													</div>
												</div>

											</fieldset>

										</form>

									</div>');
	}

	/**
	 * Returns optionally placeholder
	 * @param bool $show
	 * @param string $name
	 * @return string
	 */
	protected function getPlaceHolder($show, $name) {
		if ($show) {
			return ' placeholder="' . $name . '"';
		}
		return '';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'mailto' => array('label' => __('mail to', 'ct_theme'), 'default' => get_bloginfo('admin_email'), 'type' => 'input', 'help' => __("Email address", 'ct_theme')),
			'subject' => array('label' => __('subject', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Subject of the admin mail", 'ct_theme')),
			'name' => array('label' => __('name', 'ct_theme'), 'default' => __('Name', 'ct_theme'), 'type' => 'input', 'help' => __("Name field placeholder", 'ct_theme')),
			'email' => array('label' => __('email', 'ct_theme'), 'default' => __('Email', 'ct_theme'), 'type' => 'input', 'help' => __("Email field placeholder", 'ct_theme')),
			'message' => array('label' => __('message', 'ct_theme'), 'default' => __('Message', 'ct_theme'), 'type' => 'input', 'help' => __("Message field placeholder", 'ct_theme')),
			'buttontext' => array('label' => __("Button text", 'ct_theme'), 'default' => __('Submit', 'ct_theme'), 'type' => 'input'),
			'placeholders' => array('default' => 'no', 'type' => 'select', 'options' => array('yes' => 'yes', 'no' => 'no'), 'label' => __('Show placeholders', 'ct_theme'), 'help' => __("Placeholders are labels inside inputs which disappear when content is entered", 'ct_theme')),
			'success' => array('default' => __('Success!', 'ct_theme'), 'type' => 'input', 'help' => __("Success message", 'ct_theme')),
			'fail' => array('label' => __('error', 'ct_theme'), 'default' => __('Failed!', 'ct_theme'), 'type' => 'input', 'help' => "Error message"),
		);
	}
}

new ctContactFormShortcode();


function ContactFormAjax() {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$text = $_POST['text'];
	$mailto = $_POST['mailto'];
	$subject = $_POST['subject'];

	//validation
	$errs = array();
	if (!is_email($email)) {
		$errs['global'] = false;
		$errs['email'] = false;
	}
	if (!$text) {
		$errs['global'] = false;
		$errs['text'] = false;
	}
	if ($errs) {
		die(json_encode($errs));
	}

	//message
	$message = __("Email", 'ct_theme') . ": " . $email . "<br/>";
	$message .= $name ? (__("Name", 'ct_theme') . ": " . $name . "<br/>") : '';
	$message .= (__("Content", 'ct_theme') . ": " . $text . "<br/>");

	$headers_mail = "From: Contact form <".esc_attr($email)."> \r\n";

	if (is_email($mailto)) {
		add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
		if (wp_mail($mailto, $subject, $message, $headers_mail)) {
			$errs['global'] = true;
		}
        //fix for servers which doesnt support dynamic "from" field
        if(!$errs['global']){
            if (wp_mail($mailto, $subject, $message, '')) {
                $headers_mail = '';
                $errs['global'] = true;

            }
        }


        if($msgturn=="yes"){
            if (wp_mail($email, $subject, $msgback. "</br>" .$message, $headers_mail)) {
                $errs['global'] = true;
            }
        }
	} else {
		$errs['global'] = false;
	}
	die(json_encode($errs));
}

add_action('wp_ajax_nopriv_ContactFormAjax', 'ContactFormAjax');
add_action('wp_ajax_ContactFormAjax', 'ContactFormAjax');