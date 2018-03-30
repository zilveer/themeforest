<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Upload_Field' ) )
{
	class RWMB_Upload_Field extends RWMB_Field
	{
		/**
		 * Show begin HTML markup for fields
		 *
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function begin_html( $meta, $field )
		{
			return sprintf('
			<div class="rwmb-field rwmb-select-wrapper">
				<div class="rwmb-label">
					<label for="%s">%s</label>
				</div>
				<div class="rwmb-input">
					<input id="%s" name="%s" value="%s" type="text" class="upload upload_meta">
					<input class="upload_image_button button upload-button-2" type="button" value="Upload">
				</div>
			</div>',
			$field['id'],
			$field['name'],
			$field['id'],
			$field['field_name'],
			$meta);
		}

		/**
		 * Show end HTML markup for fields
		 *
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function end_html( $meta, $field )
		{
			return '';
		}
	}
}
