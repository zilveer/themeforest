<?php
/**
 * Adds new fields for the media items
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class WPEX_Media_Fields {

	/**
	 * Main constructor
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		add_filter( 'attachment_fields_to_edit', array( 'WPEX_Media_Fields', 'edit_fields' ), null, 2 );
		add_filter( 'attachment_fields_to_save', array( 'WPEX_Media_Fields', 'save_fields' ), null , 2 );
	}

	/**
	 * Adds new edit attachment fields
	 *
	 * @since 2.0.0
	 */
	public static function edit_fields( $form_fields, $post ) {
		$form_fields['wpex_video_url'] = array(
			'label'	=> esc_html__( 'Video URL', 'total' ),
			'input'	=> 'text',
			'value'	=> get_post_meta( $post->ID, '_video_url', true ),
		);
	   return $form_fields;
	}

	/**
	 * Save new attachment fields
	 *
	 * @since 2.0.0
	 */
	public static function save_fields( $post, $attachment ) {
		if ( isset( $attachment['wpex_video_url'] ) ) {
			update_post_meta( $post['ID'], '_video_url', $attachment['wpex_video_url'] );
		}
		return $post;
	}

}
new WPEX_Media_Fields();