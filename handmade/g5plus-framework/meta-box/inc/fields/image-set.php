<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Image_Set_Field' ) )
{
	class RWMB_Image_Set_Field extends RWMB_Field
	{
		static function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'rwmb-image-set', RWMB_CSS_URL . 'image-set.css', array(), RWMB_VER );
			wp_enqueue_script( 'rwmb-image-set', RWMB_JS_URL . 'image-set.js', array(), RWMB_VER, true );
		}
		/**
		 * Get field HTML
		 *
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */
		static function html( $meta, $field )
		{
			$html = sprintf('<div class="rwmb-image-set">');
			$html .= sprintf(
				'<input type="hidden" class="rwmb-hidden" name="%s" id="%s" value="%s" />',
				$field['field_name'],
				$field['id'],
				$meta
			);

			$style = '';
			if (isset($field['width'])) {
				$style .= 'width:' . $field['width'] . ';';
			}
			if (isset($field['height'])) {
				$style .= 'height:' . $field['height'] . ';';
			}

			$html .= sprintf('<div class="rwmb-image-set-inner%s"%s>',
				isset($field['allowClear']) && $field['allowClear'] == true ? ' allow-clear' : '',
				(isset($field['allowClear']) && $field['allowClear'] == true) && isset($field['clearValue']) ? ' data-clear-value="' . $field['clearValue'] . '"' : '');
			foreach ( $field['options'] as $value => $src )
			{
				$html .= sprintf(
					'<label%s data-value="%s"><img%s src="%s"/></label>',
					$meta == $value ? ' class="selected"' : '',
					$value,
					$style == '' ? '' : ' style="' . $style . '"',
					$src
				);
			}

			$html .= '</div>';

			$html .= '</div>';
			return $html;
		}

	}
}
