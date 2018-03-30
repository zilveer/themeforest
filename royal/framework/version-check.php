<?php  if ( ! defined('ETHEME_DOMAIN')) exit('No direct script access allowed');
class ET_Version_Check {

	private $current_version = '';
	private $new_version = '';
	private $theme_name = '';
	private $api_url = '';
	private $ignore_key = 'update_ignore_notice';


	function __construct() {
		$theme_data = wp_get_theme(get_option('template'));
		$this->current_version = $theme_data->Version;    
		$this->theme_name = ETHEME_DOMAIN;    
		$this->api_url = ET_API . 'version/';

		add_action( 'switch_theme', array( $this, 'update_dismiss' ) );


		$this->api_get_version();
		if( version_compare($this->new_version, $this->current_version, '>') ) {
			add_action('admin_init', array($this, 'nag_ignore'));
			add_action('admin_notices', array($this, 'add_notice'), 50 );
		}

	}

	private function api_get_version() {

		$raw_response = wp_remote_get($this->api_url . '?theme=' . ETHEME_DOMAIN); 

		if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
			$response = json_decode($raw_response['body'], true);
			if(!empty($response['version'])) $this->new_version = $response['version'];
		}
	}

	public function add_notice() {
		global $current_user ;
		$user_id = $current_user->ID;
		if ( ! get_user_meta($user_id, $this->ignore_key) ) {
	        echo '<div class="updated"><p>'; 
	        printf(__('There is a new version %1$s of %2$s Theme available on <a href="%3$s" target="_blank">ThemeForest</a> | <a href="%4$s" target="_blank">View changelog.</a> | <a href="%5$s">Dismiss Notice</a>'), $this->new_version, THEME_LOGO, ET_TF_LINK, ET_CHANGELOG_LINK, '?' . $this->ignore_key . '=0');
	        echo "</p></div>";
		}
	}

	public function nag_ignore() {
		global $current_user;
        $user_id = $current_user->ID;
        //delete_user_meta($user_id, $this->ignore_key);
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET[$this->ignore_key]) && '0' == $_GET[$this->ignore_key] ) {
			add_user_meta($user_id, $this->ignore_key, 'true', true);
		}
	}

	public function update_dismiss() {
		global $current_user;
        $user_id = $current_user->ID;
        delete_user_meta($user_id, $this->ignore_key);
	}
}

if(!function_exists('et_check_theme_update')) {
	add_action('init', 'et_check_theme_update');
	function et_check_theme_update() {
		new ET_Version_Check();
	}
}