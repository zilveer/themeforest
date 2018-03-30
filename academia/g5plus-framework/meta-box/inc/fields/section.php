<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Section_Field' ) )
{
	class RWMB_Section_Field extends RWMB_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'rwmb-section', RWMB_CSS_URL . 'section.css', array(), RWMB_VER );
		}

		/**
		 * Show begin HTML markup for fields
		 *
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */
		static function begin_html( $meta, $field )
		{
			return '<div class="rwmb-section"><span>' . $field['name'] . '</span>';
		}

		/**
		 * Show end HTML markup for fields
		 *
		 * @param mixed $meta
		 * @param array $field
		 *
		 * @return string
		 */
		static function end_html( $meta, $field )
		{
			return '</div>';
		}
	}
}
