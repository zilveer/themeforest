<?php
/**
 * Import manager
 *
 * @since 1.0.0
 */
class Astoundify_ImportManager {

	public static function init() {
		add_action( 'wp_ajax_astoundify_importer_iterate_item', array( __CLASS__, 'ajax_iterate_item' ) );
	}

	/**
	 * AJAX iterate a single item.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public static function ajax_iterate_item() {
		$strings = Astoundify_ContentImporter::get_strings();

		if ( ! current_user_can( 'import' ) ) {
			wp_send_json_error( $strings[ 'errors' ][ 'cap_check_fail' ] );
		}

		$iterate_action = esc_attr( $_POST[ 'iterate_action' ] );

		if ( ! in_array( $iterate_action, array( 'import', 'reset' ) ) ) {
			wp_send_json_error( $strings[ 'errors' ][ 'process_action' ] );
		}

		// clean up http request
		$item = wp_unslash( $_POST[ 'item' ] );

		if ( is_array( $item[ 'data' ] ) ) {
			$item[ 'data' ] = array_map( array( 'Astoundify_Utils', 'numeric_to_int' ), $item[ 'data' ] );
		} else {
			$item[ 'data' ] = Astoundify_Utils::numeric_to_int( $item[ 'data' ] );
		}

		$item = Astoundify_ItemImportFactory::create( $item );

		if ( is_wp_error( $item ) ) {
			wp_send_json_error( $strings[ 'errors' ][ 'process_type' ] );
		}

		$item = $item->iterate( $iterate_action );

		if ( ! $item ) {
			wp_send_json_error( $strings[ 'errors' ][ 'iterate' ] );
		}

		if ( ! is_wp_error( $item->get_processed_item() ) ) {
			wp_send_json_success( array( 'item' => $item ) );
		} else {
			wp_send_json_error( $item->get_processed_item()->get_error_message() );
		}
	}

}

Astoundify_ImportManager::init();
