<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Hi there!  I\'m just a plugin, not much I can do when called directly.' );
}

class Youxi_External_API_Settings_Page {

	private static $instance;

	private $external_apis = array();
	
	private function __construct() {

		require 'class-external-apis.php';

		if( apply_filters( 'youxi_external_api_register_twitter', true ) ) {
			$this->register_api( 'twitter', new Youxi_External_API_Twitter() );
		}

		if( apply_filters( 'youxi_external_api_register_instagram', true ) ) {
			$this->register_api( 'instagram', new Youxi_External_API_Instagram() );
		}

		add_action( 'admin_menu', array( $this, 'external_api_menu' ) );
	}

	public static function get() {

		if( empty( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function register_api( $id, $api ) {
		$this->external_apis[ $id ] = $api;
	}

	public function external_api_menu() {

		$page_title = esc_html__( 'External API', 'youxi' );
		$menu_title = esc_html__( 'External API', 'youxi' );
		$capability = 'manage_options';
		$menu_slug  = 'youxi_external_api';
		$callback   = array( $this, 'external_api_display' );

		add_options_page( $page_title, $menu_title, $capability, $menu_slug, $callback );
	}

	public function external_api_display() {

		$external_api_keys = array_keys( $this->external_apis );

		if( ! empty( $_GET['tab'] ) ) {
			$current_api = sanitize_key( $_GET['tab'] );
		} else {
			$current_api = isset( $external_api_keys[0] ) ? sanitize_key( $external_api_keys[0] ) : '';
		}

		?>
		<div class="wrap external-api">

			<h1><?php _e( 'External API Settings', 'youxi' ); ?></h1>

			<h2 class="nav-tab-wrapper">
				<?php foreach( $this->external_apis as $api_id => $api_object ) : ?>
				<a href="<?php echo esc_url( '?page=youxi_external_api&tab=' . $api_id ) ?>" class="nav-tab<?php echo $current_api == $api_id ? ' nav-tab-active' : '' ?>">
					<?php echo esc_html( $api_object->title ); ?>
				</a>
				<?php endforeach; ?>
			</h2>

			<form method="post" action="options.php">

				<?php if( isset( $this->external_apis[ $current_api ] ) ) : 
					$this->external_apis[ $current_api ]->display_settings();
				endif; ?>

			</form>

		</div>
		<?php
	}
}

Youxi_External_API_Settings_Page::get();
