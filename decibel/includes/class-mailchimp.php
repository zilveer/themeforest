<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Mailchimp' ) ) {
	/**
	 * Wolf_Mailchimp Class
	 *
	 * Contains user and moderator actions, register, login, post ticket and comment, and handles session messages
	 *
	 * @class Wolf_Mailchimp
	 * @since 1.0
	 * @author WolfThemes
	 */
	class Wolf_Mailchimp {

		/**
		 * Wolf_Mailchimp Constructor.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

			if ( $this->api_key() ) {
				require_once( 'mailchimp/MailChimp.class.php' );
				$this->MailChimp = new MailChimp( $this->api_key() );
			}
		}

		/**
		 * Get API key for user theme option
		 *
		 * @access private
		 * @return string
		 */
		private function api_key() {

			if ( wolf_get_theme_option( 'mailchimp_api_key' ) )
				return wolf_get_theme_option( 'mailchimp_api_key' );
		}

		/**
		 * Subscribe from a given email
		 *
		 * @access public
		 * @param string $list_id
		 * @param string $email
		 * @return void
		 */
		public function subscribe( $list_id, $email ) {

			$result = $this->MailChimp->call(
				'lists/subscribe',
				array(
					'id'                		=> $list_id,
					'email'             	=> array( 'email' => sanitize_email( $email ) ),
					'merge_vars'        	=> array( 'FNAME' => '', 'LNAME' => '' ),
					'double_optin'      	=> false,
					'update_existing'   	=> true,
					'replace_interests' 	=> false,
					'send_welcome'      	=> true,
				)
			);
		}

		/**
		 * Unsubscribe from a given email (not used)
		 *
		 * @access public
		 * @param string $list_id
		 * @param string $email
		 * @return void
		 */
		public function unsubscribe( $list_id, $email ) {

			$result = $this->MailChimp->call(
				'lists/unsubscribe', array(
					'id'	=> $list_id,
					'email'	=> array( 'email' => $email ),
				)
			);
		}
} // end class

/**
 * Init Wolf_Mailchimp class
 */
$GLOBALS['wolf_mailchimp'] = new Wolf_Mailchimp();

} // class_exists check