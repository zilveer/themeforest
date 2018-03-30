<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://thecodemafia.org
 * @since      1.0.0
 *
 * @package    Tcm_Theme_Lock
 * @subpackage Tcm_Theme_Lock/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Tcm_Theme_Lock
 * @subpackage Tcm_Theme_Lock/admin
 * @author     The Code Mafia <contact@thecodemafia.org>
 */
class Tcm_Theme_Lock_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $tcm_theme_lock    The ID of this plugin.
	 */
	private $tcm_theme_lock;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The envato API key.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var 	string		$envato_apikey		The envato API key.
	 */
	private $envato_apikey;

	/**
	 * The Envato username.
	 *
	 * @since	1.0.0
	 * @var		string
	 */
	private $envato_username;

	/**
	 * The Envato product ID.
	 *
	 * @since	1.0.0
	 * @var		string
	 */
	private $envato_product_id;

	/**
	 * The Mailchimp API key.
	 *
	 * @since	1.0.0
	 * @var		string
	 */
	private $mailchimp_apikey;

	/**
	 * The Mailchimp list ID.
	 *
	 * @since	1.0.0
	 * @var		string
	 */
	private $mailchimp_list_id;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $tcm_theme_lock       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $tcm_theme_lock, $version ) {

		$this->tcm_theme_lock = $tcm_theme_lock;
		$this->version = $version;

		$this->envato_apikey = 'dxjtwlhecsiuea2vrnf2a1vmz3y3jv1h';
		$this->envato_username = 'stylishthemes';
		$this->envato_product_id = 6098535;

		$this->mailchimp_apikey = '3fecd052857969fe6fab15637bab4cb3-us5';
		$this->mailchimp_list_id = '892da5194a';

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tcm_Theme_Lock_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tcm_Theme_Lock_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->tcm_theme_lock, THEMEDIR . '/admin/tcm-theme-lock/admin/css/tcm-theme-lock-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tcm_Theme_Lock_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tcm_Theme_Lock_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->tcm_theme_lock, THEMEDIR . '/admin/tcm-theme-lock/admin/js/tcm-theme-lock-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Lock the admin dashboard.
	 *
	 * If the theme is not unlocked already, redirect all pages to the registration page.
	 * If we are on registration page, check if the details were submitted, validate the purchase code
	 * and then, if everything is OK, subscribe the email address to our Mailchimp list.
	 *
	 * @since 1.0.0
	 */
	public function lock_admin() {

		global $pagenow;

		if( !($pagenow == 'admin.php' && isset($_GET['page']) && $_GET['page'] == 'register_theme') && !($pagenow == 'themes.php') && $this->is_on_server() && !$this->is_unlocked() ) {
			wp_redirect( admin_url( '/admin.php?page=register_theme', 'http' ), 301 );
			exit;
		} else {
			if(isset($_POST['tcm_verify_submit'])) {

				/**
				 * Get the details from the user.
				 */
				$email = is_email($_POST['tcm_email_address']);
				$purchase_code = sanitize_text_field($_POST['tcm_purchase_code']);

				if(!$email && !$purchase_code) {
					global $registration_error;

					$registration_error = true;
					return;
				}

				/**
				 * Verify the purchase code first.
				 *
				 * We need to work with te Envato API here to send the Purchase Code and receive back if is OK.
				 */
				$purchase_code = $this->validate_purchase_code($purchase_code);

				/**
				 * If the data entered is OK, unlock the theme and redirect to the dashboard.
				 * If not, set a global error which will show a notice to the user in the registration page.
				 */
				if($email && $purchase_code) {
					update_option( 'tcm_unlock_theme', true );

					/**
					 * Subscribe the customer to our Mailchimp List.
					 */
					$this->subscribe_to_mailchimp($email);

					wp_redirect( admin_url( '/', 'http' ), 301 );
					exit;
				} else {
					global $registration_error;

					$registration_error = true;
				}

			}
		}

	}

	/**
	 * Register the admin menu & page.
	 *
	 * @since 1.0.0
	 */
	public function register_menu() {

		if($this->is_on_server() && !$this->is_unlocked()) {
			add_menu_page(__('Register Theme', LANGUAGE_ZONE), __('Register Theme', LANGUAGE_ZONE), 'administrator', 'register_theme', array($this, 'display_registration_page'));
		}

	}

	/**
	 * Includes the registration page partial interface.
	 *
	 * @since 1.0.0
	 */
	public function display_registration_page() {

		require_once THEMEDIR . '/admin/tcm-theme-lock/admin/partials/tcm-theme-lock-admin-display.php';

	}

	/**
	 * Check if the WP installation is hosted on a public server or localhost.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function is_on_server() {

		$whitelist = array(
			'127.0.0.1',
			'::1'
		);

		if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
			return true;
		}

		return false;

	}

	/**
	 * Check if the theme is unlocked or not.
	 *
	 * @since 1.0.0
	 * @return mixed|void
	 */
	public function is_unlocked() {

		add_option( 'tcm_unlock_theme', false, '', 'no' );

		//update_option( 'tcm_unlock_theme', false );

		return get_option('tcm_unlock_theme');

	}

	/**
	 * Validate a given purchase code with Envato API.
	 *
	 * @since 1.0.0
	 * @param $purchase_code
	 * @return string
	 */
	private function validate_purchase_code($purchase_code) {

		$result = false; // have we got a valid purchase code?

		/**
		 * Get the data from the class.
		 */
		$our_item_id = $this->envato_product_id;
		$username = $this->envato_username;
		$api_key = $this->envato_apikey;

		/**
		 * Construct the api URL.
		 */
		$url = "http://marketplace.envato.com/api/edge/$username/$api_key/verify-purchase:$purchase_code.json";

		/**
		 * Create a new cURL resource
		 */
		$ch = curl_init($url);

		/**
		 * Set agent and other appropriate options
		 */
		$agent = 'TCM-AGENT';
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);

		/**
		 * Grab URL and pass it to the browser
		 */
		$json_res = curl_exec($ch);

		/**
		 * Close cURL resource, and free up system resources
		 */
		curl_close($ch);

		$data = json_decode($json_res,true);

		$purchases = $data['verify-purchase'];
		if(isset($purchases['buyer'])){

			/**
			 * Format single purchases same as multi purchases
			 */
			$purchases = array($purchases);

		}

		if(is_array($purchases)) {
			foreach($purchases as $purchase) {

				$purchase=(array)$purchase; // json issues

				if((int)$purchase['item_id']==(int)$our_item_id){

					/**
					 * We have a winner!
					 */
					$result = true;

				}

			}
		}

		/**
		 * If we have a result, the purchase code is OK.
		 */
		if($result){
			return $purchase_code;
		} else {
			return '';
		}

	}

	/**
	 * Subscribe the given email address to our Mailchimp List.
	 *
	 * @since 1.0.0
	 * @param $email_address
	 * @return array
	 */
	private function subscribe_to_mailchimp($email_address) {

		$MailChimp = new \Drewm\MailChimp($this->mailchimp_apikey);

		$result = $MailChimp->call('lists/subscribe', array(
			'id'                => $this->mailchimp_list_id,
			'email'             => array('email' => $email_address),
			'merge_vars'        => array(),
			'double_optin'      => false,
			'update_existing'   => true,
			'replace_interests' => false,
			'send_welcome'      => false,
		));

		return $result;

	}

}
