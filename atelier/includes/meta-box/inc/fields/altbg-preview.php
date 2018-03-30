<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Altbgpreview_Field' ) )
{
	class RWMB_Altbgpreview_Field extends RWMB_Field
	{
		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $meta, $field )
		{	
			return sprintf(
				'<div id="%s" class="meta-altbg-preview"><p>Alt Background Preview</p></div>',
				$field['id']
			);
		}

	}
}