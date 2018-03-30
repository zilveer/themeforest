<?php

class WpvSidebarInterface {
	public function __construct() {
		add_action( 'admin_print_scripts', array( &$this, 'add_new_ui' ) );

		$this->add_new_callback();
	}

	public function add_new_ui() {
		?>
		<script type='text/html' id='wpv-add-sidebar-ui'>
			<form class='wpv-add-sidebar-ui' method='POST'>
				<h3><?php _e( 'Vamtam Widget Areas', 'health-center' ) ?></h3>
				<input type='text' value='' placeholder='<?php esc_attr_e( 'New Widget Area Name', 'health-center' ) ?>' name='new-sidebar-id' />
				<input type='submit' value='<?php esc_attr_e( 'Add Widget Area', 'health-center' ) ?>' class="button-primary" />
				<?php wp_nonce_field( 'wpv-sidebars-nonce', 'wpv-sidebars-nonce' ) ?>
			</form>
		</script>
		<?php
	}

	public function add_new_callback() {
		if ( isset( $_REQUEST['wpv-sidebars-nonce'] ) && wp_verify_nonce( $_REQUEST['wpv-sidebars-nonce'], 'wpv-sidebars-nonce' ) && ! empty( $_POST['new-sidebar-id'] ) ) {
			$sidebars = self::get_sidebars_list();
			$name     = 'wpv_sidebar-'.$_POST['new-sidebar-id'];

			if ( empty( $sidebars ) ) {
				$sidebars = array( $name );
			} else {
				$sidebars = array_merge( $sidebars, array( $name ) );
			}

			self::set_sidebars_list( $sidebars );
			wp_redirect( admin_url( 'widgets.php' ) );
			exit;
		}
	}

	public static function delete_widget_area() {
		check_ajax_referer( 'wpv-sidebars-nonce' );

		$name = 'wpv_sidebar-'.$_POST['name'];

		$sidebars = self::get_sidebars_list();

		if ( ( $key = array_search( $name, $sidebars ) ) !== false )
			unset( $sidebars[$key] );

		self::set_sidebars_list( $sidebars );

		echo 'true';

		exit;
	}

	private static function get_sidebars_list() {
		return explode( ',', wpv_get_option( 'custom-sidebars' ) );
	}

	private static function set_sidebars_list( $sidebars ) {
		wpv_update_option( 'custom-sidebars', implode( ',', $sidebars ) );
	}
}