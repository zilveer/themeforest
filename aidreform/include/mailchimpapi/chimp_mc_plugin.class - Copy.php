<?php

//echo "ksha";

/**

 *

 */



class CHIMP_MC_Plugin {

	private $options;

	private static $instance;

	private static $mcapi;

	private static $name = 'CHIMP_MC_Plugin';

	private static $prefix = 'ns_mc';

	private static $public_option = 'no';

	private static $textdomain = 'AidReform';

	private function __construct () {

		self::load_text_domain();

		 // Set up the settings.

		add_action('admin_init', array(&$this, 'register_settings'));

		 // Set up the administration page.

		 // Fetch the options, and, if they haven't been set up yet, display a notice to the user.

		$this->get_options();

		 // Add our widget when widgets get intialized.

		//add_action('widgets_init', create_function('', 'return register_widget("NS_Widget_MailChimp");'));

	}



	 static public function get_instance () {

		if (empty(self::$instance)) {

			self::$instance = new self::$name;

		}

		return self::$instance;

	}

	

	public function get_admin_notices () {

		global $blog_id;

		$notice = '<p>';

		$notice .= __('You\'ll need to set up the MailChimp signup widget plugin options before using it', 'AidReform') . __('You can make your changes', 'AidReform') . ' <a href="' . get_admin_url() . 'themes.php?page=cs_theme_option#tab-mailchimp-key-show">' . __('here', 'AidReform') . '.</a>';

		$notice .= '</p>';

		return $notice;

	}

	

	public function get_mcapi () {

		$api_key = $this->get_api_key();

		if (false == $api_key) {

			return false;

		} else {

			if (empty(self::$mcapi)) {

				self::$mcapi = new MCAPI($api_key);

			}

			return self::$mcapi;

		}

	}

	

	public function get_options () {

		$this->options = get_option(self::$prefix . '_options');

		return $this->options;

	}

	

	public function load_text_domain () {

		load_plugin_textdomain(self::$textdomain, null, str_replace('lib', 'languages', dirname(plugin_basename(__FILE__))));

	}

	

	public function register_settings () {

		register_setting( self::$prefix . '_options', self::$prefix . '_options', array($this, 'validate_api_key'));

	}

	

	public function remove_options () {

		delete_option(self::$prefix . '_options');

	}





	public function set_up_options () {

		add_option(self::$prefix . '_options', '', '', self::$public_option);

	}

	

	public function validate_api_key ($api_key) {

		//#TODO: Add API validation logic.

		return $api_key;

	}

	

	private function get_api_key () {

		global $cs_theme_option;

		if (! empty($cs_theme_option['mailchimp_key'])) {

			return $cs_theme_option['mailchimp_key'];

		} else {

			return false;

		}

	}

	

	private function update_options ($options_values) {

		$old_options_values = get_option(self::$prefix . '_options');

		$new_options_values = wp_parse_args($options_values, $old_options_values);

		update_option(self::$prefix .'_options', $new_options_values);

		$this->get_options();

	}

}
?>