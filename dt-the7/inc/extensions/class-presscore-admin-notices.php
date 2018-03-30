<?php
/**
 * Presscore admin messages class.
 */

class Presscore_Admin_Notices {

	private $registered_notices = array();
	private $dismissed_notices = array();
	private $option_name;
	private $id;

	public function __construct( $id ) {
		$this->id = sanitize_key( $id );
		$this->option_name = "presscore_dismiss_{$this->id}";

		$this->setup_dismissed_notices();
	}

	public function add_notice( $code, $message, $type ) {
		$this->registered_notices[ $code ] = array(
			'message' => $message,
			'type' => $type
		);
	}

	public function print_admin_notices() {
		$dismissed_notices = $this->dismissed_notices ? array_combine( $this->dismissed_notices, $this->dismissed_notices ) : array();
		$notices_to_show = array_diff_key( $this->registered_notices, $dismissed_notices );
		$exclude_from_screen = apply_filters( 'presscore_admin_exclude_notices_from_screen', array( 'options-general' ) );

		if ( $notices_to_show && ! in_array( get_current_screen()->parent_base, $exclude_from_screen ) ) {
			foreach( $notices_to_show as $code=>$notice ) {
				$type = explode( ' ', $notice['type'] );
				$message = $notice['message'];

				if ( ! in_array( 'presscore-without-wrap', $type ) ) {
					$message = "<p>{$message}</p>";
				}

				$id = 'presscore-notice-' . $code;
				$class = $notice['type'] . ' presscore-notice notice is-dismissible';
				printf( '<div id="%s" class="%s">%s</div>', esc_attr( $id ), esc_attr( $class ), $message );
			}
		}
	}

	public function dismiss_notices() {
		check_ajax_referer( "presscore_dismiss_{$this->id}" );

		$code = $_POST['code'];

		if ( ! $this->notice_is_dismissed( $code ) ) {
			$this->dismiss_notice( $code );
			$this->update_db_entrie();
		}
		wp_die();
	}

	public function get_nonce() {
		return wp_create_nonce( "presscore_dismiss_{$this->id}" );
	}

	public function setup_dismissed_notices() {
		$dismissed_notices = get_site_option( $this->option_name );
		$this->dismissed_notices = ( $dismissed_notices ? (array) $dismissed_notices : array() );
	}

	public function reset_notices() {
		$this->dismissed_notices = array();
		delete_site_option( $this->option_name );
	}

	public function reset_notice( $code ) {
		$this->dismissed_notices = array_diff( $this->dismissed_notices, array( $code ) );
		$this->update_db_entrie();
	}

	public function dismiss_notice( $code ) {
		$this->dismissed_notices[] = (string) $code;
	}

	public function notice_is_dismissed( $code ) {
		return in_array( $code, $this->dismissed_notices );
	}

	protected function update_db_entrie() {
		update_site_option( $this->option_name, $this->dismissed_notices );
	}
}
