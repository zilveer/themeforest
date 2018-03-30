<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Description_Field' ) )
{
	class RWMB_Description_Field extends RWMB_Field
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
			return sprintf(
				'<p>%s</p>',
				$field['name']
			);
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
