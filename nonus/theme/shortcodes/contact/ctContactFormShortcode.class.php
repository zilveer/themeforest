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
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		$id = rand(100, 1000);
		$placeholders = $placeholders == 'yes' ? true : false;

		$this->addInlineJS($this->getInlineJS($attributes, $id));
		$headerHtml = $header ? '<h4>' . $header . '</h>' : '';

		return do_shortcode('' . $headerHtml . '
							<div'.$this->buildContainerAttributes(array('class'=>array('row-fluid','contact-form')),$atts).'>
			                    <div style="display:none;" class="contactFormInfo contactFormMessage alert alert-info" id="contactFormInfo_' . $id . '"></div>
			                    <div style="display:none;" class="contactFormError contactFormMessage alert alert-error" id="contactFormError_' . $id . '"></div>
			                    <div class="contactForm">

                                    <form id="form-horizontal' . $id . '" class="contactForm">
                                        <input type="text" id="contactFormName_' . $id . '"' . $this->getPlaceHolder($placeholders, $name) . '>
						                <input type="text" id="contactFormEmail_' . $id . '"' . $this->getPlaceHolder($placeholders, $email) . '>
						                <textarea name="message" id="contactFormText_' . $id . '"' . $this->getPlaceHolder($placeholders, $message) . '></textarea>
						                <label class="info"></label>
						                <input type="submit" id="contactFormSubmit_' . $id . '" value="' . $buttontext . '">
			                        </form>
			                    </div>
			                    <!-- / contactForm -->

			                </div>');
	}

	/**
	 * returns inline js
	 * @param $attributes
	 * @param $id
	 * @return string
	 */
	protected function getInlineJS($attributes, $id){
		extract($attributes);
		return 'jQuery(document).ready(function () {
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
									    jQuery("#contactFormError_' . $id . '").hide();
										jQuery("#contactFormInfo_' . $id . '").hide();
										jQuery("#contactFormEmail_' . $id . '").removeClass("error");
										jQuery("#contactFormText_' . $id . '").removeClass("error");

										result = jQuery.parseJSON(data);
										jQuery.each(result, function(index, value) {
											if(index=="global" && value==true){
												jQuery("#contactFormInfo_' . $id . '").text("' . $success . '").fadeIn();
												jQuery("#form-horizontal' . $id . '").find("input:not(.btn), textarea").attr("value", "");
											}
											if(index=="global" && value==false){
												jQuery("#contactFormError_' . $id . '").text("' . $fail . '").fadeIn();
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
										jQuery("#contactFormInfo_' . $id . '").html("");
										jQuery("#contactFormError_' . $id . '").html("");
										jQuery("#contactFormError_' . $id . '").text("' . $fail . '").fadeIn();
									}
								})
								return false;
							});
						});';
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
			'header' => array('label' => __("header text", 'ct_theme'), 'default' =>'', 'type' => 'input'),
			'mailto' => array('label' => __('mail to', 'ct_theme'), 'default' => get_bloginfo('admin_email'), 'type' => 'input', 'help' => __("Email address", 'ct_theme')),
			'subject' => array('label' => __('subject', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Subject of the admin mail", 'ct_theme')),
			'name' => array('label' => __('name', 'ct_theme'), 'default' => __('Your name', 'ct_theme'), 'type' => 'input', 'help' => __("Name field placeholder", 'ct_theme')),
			'email' => array('label' => __('email', 'ct_theme'), 'default' => __('Your email', 'ct_theme'), 'type' => 'input', 'help' => __("Email field placeholder", 'ct_theme')),
			'message' => array('label' => __('message', 'ct_theme'), 'default' => __('Your message', 'ct_theme'), 'type' => 'input', 'help' => __("Message field placeholder", 'ct_theme')),
			'buttontext' => array('label' => __("Button text", 'ct_theme'), 'default' => __('Send Message', 'ct_theme'), 'type' => 'input'),
			'placeholders' => array('default' => 'yes', 'type' => 'select', 'options' => array('yes' => 'yes', 'no' => 'no'), 'label' => __('Show placeholders', 'ct_theme'), 'help' => __("Placeholders are labels inside inputs which disappear when content is entered", 'ct_theme')),
			'success' => array('default' => __('Thank You! We will contact you shortly.', 'ct_theme'), 'type' => 'input', 'help' => __("Success message", 'ct_theme')),
			'fail' => array('label' => __('error', 'ct_theme'), 'default' => __('An error occured. Please try again.', 'ct_theme'), 'type' => 'input', 'help' => "Error message"),
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
	} else {
		$errs['global'] = false;
	}
	die(json_encode($errs));
}

add_action('wp_ajax_nopriv_ContactFormAjax', 'ContactFormAjax');
add_action('wp_ajax_ContactFormAjax', 'ContactFormAjax');