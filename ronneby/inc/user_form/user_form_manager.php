<?php

class Dfd_User_Form_Manager {

	private $param_name = "check_layout";
	private $fake_param_name = "fake_check_layout";
	private $param_type = "dfd_check_layout";

	/**
	 *
	 * @var Dfd_User_Form_Manager $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		$this->init();
	}

	public function init() {
		require_once locate_template("/inc/user_form/template_manager.php");
		require_once locate_template("/inc/user_form/user_input.php");
		require_once locate_template("/inc/user_form/contact_form_input.php");
		require_once locate_template("/inc/user_form/components/decoder.php");
		require_once locate_template("/inc/user_form/components/submission.php");
		require_once locate_template("/inc/user_form/components/field_manager.php");
		require_once locate_template("/inc/user_form/components/reCaptcha.php");
		require_once locate_template("/inc/user_form/components/mail.php");
		require_once locate_template("/inc/user_form/components/settings.php");
		require_once locate_template("/inc/user_form/decoration/Form.php");
		require_once locate_template("/inc/user_form/vendor/Akismet.class.php");
		require_once locate_template("/inc/user_form/vendor/AkismetManager.php");
		require_once locate_template("/inc/user_form/inputs/recaptcha.php");
//        require_once locate_template("/inc/recaptcha/recaptchalib.php");
		$this->setActions();
	}

	public function setActions() {
		add_action('init', array ($this, "dfd_contact_from_init"));
	}

	public function dfd_contact_from_init() {
		if (!isset($_SERVER['REQUEST_METHOD'])) {
			return;
		}
		wp_enqueue_script('jquery-form');

		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			if (isset($_POST['_dfd_is_ajax_call'])) {

				$submission = Dfd_Submission::instance();

				$echo = $submission->ajaxValidate();

				$echo = wp_json_encode($echo);

				@header('Content-Type: application/json; charset=' . get_option('blog_charset'));
				echo $echo;
				exit();
			}
		}
	}

	public function getParamName() {
		return $this->param_name;
	}

	public function getFakeParamName() {
		return $this->fake_param_name;
	}

	public function getParamType() {
		return $this->param_type;
	}

	public function getoptions() {

		$files = Dfd_User_Form_template_manager::instance()->getAllTempletes();
		$res_arr = array ();
		//revers key and  value
		foreach ($files as $key => $value) {
			$res_arr[$value] = $key;
		}
		return $res_arr;
	}

	public function generateDependencys() {
		$files = Dfd_User_Form_template_manager::instance()->getAllTempletes();

		$result = array ();
		foreach ($files as $f_key => $f_value) {
			$merge_arr = array (
					'type' => 'dfd_form_template',
					'param_name' => $this->getParamName() . '_' . $f_key,
					'dependency' => Array ('element' => $this->fake_param_name, 'value' => array ($f_key)),
					'group' => __('Field Editor {' . $f_key . '}', 'js_composer'),
					'weight' => "400",
			);
			$result[] = ($merge_arr);
		}
//        print_r($r);
//        print_r($reuslt);
		return $result;
	}

	public function getParams() {
		$message = "From: {{your-name}}
Subject: {{your-subject}}

Message Body:
{{your-message}}

--
This e-mail was sent from a contact form";
//        $message = htmlspecialchars($message);
		$arr = array_merge(array (
				array (
						'type' => 'dfd_form_preset_select',
						'class' => '',
						'heading' => __('Style', 'dfd'),
						'param_name' => 'preset',
						'value' => array (
								__('Standart', 'dfd') => 'preset1',
								__('General border', 'dfd') => 'preset2',
								__('Simple', 'dfd') => 'preset3'
						),
						'weight' => "600",
				),
				array (
						'type' => 'dfd_check_layout',
						'heading' => __('Form Layouts', 'dfd'),
						'param_name' => $this->param_name,
						'description' => __('Please select layout', 'dfd'),
						'options' => $this->getoptions(),
						'weight' => "500",
				),
				array (
						'type' => 'checkbox',
						'heading' => __('Enable sort panel', 'dfd'),
						'edit_field_class' => 'fakecheckbox',
						'param_name' => $this->fake_param_name,
						'value' => $this->getoptions()
				),
				array (
						'type' => 'textfield',
						'class' => '',
						'heading' => esc_html__('Custom CSS Class', 'dfd'),
						'param_name' => 'el_class',
						'value' => '',
				),
				array (
						'type' => 'dropdown',
						'class' => '',
						'heading' => esc_html__('Animation', 'dfd'),
						'param_name' => 'module_animation',
						'value' => dfd_module_animation_styles(),
				),
				/* -------------------Input Style----------------------------------------- */
				array (
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Inputs inner background color", 'dfd'),
						"param_name" => "input_background",
						"value" => "",
						"description" => "",
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'ult_switch',
						'class' => '',
						'heading' => __('Show placeholder', 'dfd'),
						'param_name' => 'placeholder',
						'value' => 'on',
						'options' => array (
								'on' => array (
										'on' => 'Yes',
										'off' => 'No',
								),
						),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'ult_switch',
						'class' => '',
						'heading' => __('Show label for text field', 'dfd'),
						'param_name' => 'show_label_text',
//                        'value' => 'on',
						'options' => array (
								'on' => array (
										'on' => 'Yes',
										'off' => 'No',
								),
						),
						'dependency' => Array ('element' => 'preset', 'value' => array ('preset1')),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'ult_param_heading',
						'param_name' => 'content_spacing',
						'text' => __('Border settings', 'dfd'),
						'value' => '',
						'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'dropdown',
						'class' => '',
						'heading' => __('Border Style', 'dfd'),
						'param_name' => 'border_style',
						'value' => array (
								__('solid', 'dfd') => 'solid',
								__('dotted', 'dfd') => 'dotted',
								__('dashed', 'dfd') => 'dashed',
								__('hidden', 'dfd') => 'hidden',
								__('double', 'dfd') => 'double',
								__('initial', 'dfd') => 'initial',
								__('inherit', 'dfd') => 'inherit',
						),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'number',
						'class' => '',
						'heading' => __('Border width', 'dfd'),
						'param_name' => 'borderwidth',
						'value' => 1,
						'min' => 1,
						'max' => 10,
						'suffix' => 'px',
//						"dependency" => array('element' => 'border_style',
//									'value_not_equal_to' => array( 'hidden' )),
						'dependency' =>
						Array (
								'element' => 'preset',
								'value' => array ("preset1")
						),
//									array('element' => 'border_style',
//										'value_not_equal_to' => array( 'hidden' )
//									),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Border Color", 'dfd'),
						"param_name" => "border_color",
						"value" => "",
						"description" => "",
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'number',
						'class' => '',
						'heading' => __('Border radius', 'dfd'),
						'param_name' => 'border_radius',
						'value' => 0,
						'min' => 1,
						'max' => 10,
						'suffix' => 'px',
						'dependency' => Array ('element' => 'preset', 'value' => array ("preset1")),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Outer Border Color", 'dfd'),
						"param_name" => "outer_border_color",
						"value" => "#000000",
						"description" => "",
						'dependency' => Array ('element' => 'preset', 'value' => array ("preset2")),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'ult_param_heading',
						'param_name' => 'content_spacing',
						'text' => __('Text settings', 'dfd'),
						'value' => '',
						'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Text Color", 'dfd'),
						"param_name" => "text_color",
						"value" => "",
						"description" => "",
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'checkbox',
						'heading' => esc_html__('Use custom font family for input text?', 'dfd'),
						'param_name' => 'use_google_fonts_input',
						'value' => array (esc_html__('Yes', 'dfd') => 'yes'),
						'description' => esc_html__('Use font family from google.', 'dfd'),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'google_fonts',
						'param_name' => 'custom_fonts_input',
						'value' => '',
						'heading' => __('Input Text Font Family', 'dfd'),
						'settings' => array (
								'fields' => array (
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font styling.', 'dfd'),
								),
						),
						'dependency' => array (
								'element' => 'use_google_fonts_input',
								'value' => 'yes',
						),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'ult_param_heading',
						'param_name' => 'content_spacing',
						'text' => __('Placeholder settings', 'dfd'),
						'value' => '',
						'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'checkbox',
						'heading' => esc_html__('Use custom font family for placeholder text?', 'dfd'),
						'param_name' => 'use_google_fonts_placeholder',
						'value' => array (esc_html__('Yes', 'dfd') => 'yes'),
						'description' => esc_html__('Use font family from google.', 'dfd'),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'google_fonts',
						'heading' => __('Placeholder Font Family', 'dfd'),
						'param_name' => 'custom_fonts_label',
						'value' => '',
						'settings' => array (
								'fields' => array (
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font styling.', 'dfd'),
								),
						),
						'group' => esc_attr__('Input Style', 'dfd'),
						'dependency' => array (
								'element' => 'use_google_fonts_placeholder',
								'value' => 'yes',
						),
				),
				array (
						'type' => 'ult_param_heading',
						'param_name' => 'content_spacing',
						'text' => __('Other settings', 'dfd'),
						'value' => '',
						'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'number',
						'class' => '',
						'heading' => __('Textarea field height', 'dfd'),
						'param_name' => 'text_area_height',
						'value' => 5,
						'min' => 1,
						'max' => 200,
						'suffix' => 'row',
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'number',
						'class' => '',
						'heading' => __('Vertical margin between inputs', 'dfd'),
						'param_name' => 'vert_margin_btw_inputs',
						'value' => 5,
						'min' => 1,
						'max' => 200,
						'suffix' => 'px',
						'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				array (
						'type' => 'number',
						'class' => '',
						'heading' => __('Horizontal margin between inputs', 'dfd'),
						'param_name' => 'horiz_margin_btw_inputs',
						'value' => 5,
						'min' => 1,
						'max' => 200,
						'suffix' => 'px',
						'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
						'group' => esc_attr__('Input Style', 'dfd'),
				),
				/* ------------------------Button Style------------------------------------ */
				array (
					'type' => 'dropdown',
					'class' => '',
					'heading' => __('Text Transform', 'dfd'),
					'param_name' => 'btn_text_transform',
					'value' => array (
						__('Inherit', 'dfd') => 'inherit',
						__('Capitalize', 'dfd') => 'capitalize',
						__('Uppercase', 'dfd') => 'uppercase',
						__('Lowercase', 'dfd') => 'lowercase',
						__('Initial', 'dfd') => 'initial',
					),
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					'type' => 'number',
					'class' => '',
					'heading' => __('Font size', 'dfd'),
					'param_name' => 'font_size',
					'value' => 12,
					'min' => 1,
					'max' => 200,
					//'suffix' => 'px',
					'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					'type' => 'number',
					'class' => '',
					'heading' => __('Letter Spacing', 'dfd'),
					'param_name' => 'letter_spacing',
					'value' => '0',
					'min' => 1,
					'max' => 200,
					//'suffix' => 'px',
					'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					'type' => 'number',
					'class' => '',
					'heading' => __('Button border width', 'dfd'),
					'param_name' => 'button_border_width',
					'value' => '0',
					'min' => 1,
					'max' => 200,
					//'suffix' => 'px',
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
					'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button border color", 'dfd'),
					"param_name" => "button_border_color",
					"value" => "",
					"description" => "",
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button border color on hover", 'dfd'),
					"param_name" => "button_border_color_on_hover",
					"value" => "",
					"description" => "",
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					'type' => 'dropdown',
					'class' => '',
					'heading' => __('Button border style', 'dfd'),
					'param_name' => 'button_border_style',
					'value' => array (
						__('solid', 'dfd') => 'solid',
						__('dotted', 'dfd') => 'dotted',
						__('dashed', 'dfd') => 'dashed',
						__('hidden', 'dfd') => 'hidden',
						__('double', 'dfd') => 'double',
						__('initial', 'dfd') => 'initial',
						__('inherit', 'dfd') => 'inherit',
					),
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					'type' => 'number',
					'class' => '',
					'heading' => __('Button border radius', 'dfd'),
					'param_name' => 'button_border_radius',
					'value' => '0',
					'min' => 1,
					'max' => 200,
					//'suffix' => 'px',
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc crum-number-wrap',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button backgrond", 'dfd'),
					"param_name" => "button_backgrond",
					"value" => "",
					"description" => "",
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Hover button backgrond", 'dfd'),
					"param_name" => "hover_button_backgrond",
					"value" => "",
					"description" => "",
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button color text", 'dfd'),
					"param_name" => "button_color_text",
					"value" => "",
					"description" => "",
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button hover color text", 'dfd'),
					"param_name" => "button_hover_color_text",
					"value" => "",
					"description" => "",
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Text alignment", 'dfd'),
					"param_name" => "text_align",
					"value" => array (
							__('Center Align', 'dfd') => "center",
							__('Left Align', 'dfd') => "left",
							__('Right Align', 'dfd') => "right",
					),
					"description" => "",
					'group' => esc_attr__('Button Style', 'dfd'),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
				),
				array (
					'type' => 'textfield',
					'heading' => __('Button Message', 'dfd'),
					'param_name' => 'btn_message',
					"value" => "Send message",
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Button width", 'dfd'),
					"param_name" => "btn_width",
					"value" => array (
						__('Full size (1/1 size)', 'dfd') => "",
						__('Half size (1/2 size)', 'dfd') => "dfd-half-size",
						__('Third size (1/3 size)', 'dfd') => "dfd-third-size",
						__('Inherit from theme options', 'dfd') => "dfd-option-size",
					),
					"description" => "",
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
				),
				array (
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Button alignment", 'dfd'),
					"param_name" => "btn_align",
					"value" => array (
						__('Left Align', 'dfd') => "left",
						__('Center Align', 'dfd') => "center",
						__('Right Align', 'dfd') => "right",
					),
					"description" => "",
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1", "preset3")),
				),
				array (
					'type' => 'checkbox',
					'heading' => esc_html__('Use custom font family for button?', 'dfd'),
					'param_name' => 'use_google_fonts_button',
					'value' => array (esc_html__('Yes', 'dfd') => 'yes'),
					'description' => esc_html__('Use font family from google.', 'dfd'),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				array (
					'type' => 'google_fonts',
					'param_name' => 'custom_fonts_button',
					'value' => '',
					'settings' => array (
						'fields' => array (
								'font_family_description' => esc_html__('Select font family.', 'dfd'),
								'font_style_description' => esc_html__('Select font styling.', 'dfd'),
						),
					),
					'dependency' => array (
						'element' => 'use_google_fonts_button',
						'value' => 'yes',
					),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd'),
				),
				/* -----------------------reCaptcha setting------------------------------------- */
				array (
						'type' => 'checkbox',
						'heading' => __('Use reCaptcha', 'dfd'),
						"description" => __("Get recaptcha in <a target='blank' href='https://www.google.com/recaptcha/intro/index.html'>google.com/recaptcha</a>", 'dfd'),
						'param_name' => 'use_recaptcha',
						'value' => array ("yes" => "yes"),
						'group' => "reCaptcha setting",
				),
				array (
						'type' => 'textfield',
						'heading' => __('Public key', 'dfd'),
						'param_name' => 'recaptcha_publickey',
						"value" => "",
						'dependency' => Array ('element' => 'use_recaptcha', 'value' => array ("yes")),
						'group' => "reCaptcha setting",
				),
				array (
						'type' => 'textfield',
						'heading' => __('Private key', 'dfd'),
						'param_name' => 'recaptcha_privatekey',
						"value" => "",
						'dependency' => Array ('element' => 'use_recaptcha', 'value' => array ("yes")),
						'group' => "reCaptcha setting",
				),
				   ), $this->generateDependencys(), array (
				/* -----------------------Recived email form------------------------------------- */
				array (
						'type' => 'textfield',
						'heading' => __('To', 'dfd'),
						'param_name' => 'email_to',
						"value" => get_option("admin_email"),
						'weight' => "300",
						'description' => esc_html__('Insert the needed mail-tag without figure braces.', 'dfd'),
						'group' => "Recived email form",
				),
//				array (
//						'type' => 'textfield',
//						'heading' => __('From', 'dfd'),
//						'param_name' => 'email_from',
//						"value" => "your-name <wordpress@themes.dfd.name>",
//						'weight' => "300",
//						'description' => esc_html__('Insert the needed mail-tag without figure braces.', 'dfd'),
//						'group' => "Recived email form",
//				),
				array (
						'type' => 'textfield',
						'heading' => __('Subject', 'dfd'),
						'param_name' => 'email_subject',
						"value" => "your-subject",
						'weight' => "300",
						'description' => esc_html__('Insert the needed mail-tag without figure braces.', 'dfd'),
						'group' => "Recived email form",
				),
				array (
						'type' => 'textfield',
						'heading' => __('Reply to', 'dfd'),
						'param_name' => 'email_replay_to',
						"value" => "reply email",
						'weight' => "300",
						'description' => esc_html__('Insert the needed mail-tag without figure braces.', 'dfd'),
						'group' => "Recived email form",
				),
				array (
						'type' => 'dfd_form_available_fields',
						'param_name' => 'form_available_fields',
						'weight' => "300",
						'group' => "Message Text",
				),
				array (
						"type" => "textarea_html",
						"class" => "",
						"heading" => __("Message", 'dfd'),
						"param_name" => "content",
						"value" => $message,
						'group' => "Message Text",
				),
				   )
		);
//        print_r($arr);
		return $arr;
	}

}

function dfdcf_ajax_loader() {
//    $url = get_template_directory_uri() . '/inc/user_form/assets/images/ajax-loader.gif';
//    $url = get_template_directory_uri() . '/inc/user_form/assets/images/ajax-loader.gif';
	$url = "";
	return $url;
}

if (!function_exists("dfd_normalize_css")) {

	function dfd_normalize_css($b1) {
		$b1 = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $b1);
		$b1 = str_replace(array ("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $b1);
		return $b1;
	}

}
