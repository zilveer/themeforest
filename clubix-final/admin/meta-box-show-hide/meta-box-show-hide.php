<?php
/*
Plugin Name: Meta Box Show Hide
Plugin URI: http://www.deluxeblogtips.com/meta-box
Description: Easily show/hide meta boxes by page template, taxonomy (including category, post format) using Javascript.
Version: 0.1.0
Author: Rilwis
Author URI: http://www.deluxeblogtips.com
License: GPL2+
*/

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( __CLASS__ ) )
{
	/**
	 * This class controls toggling meta boxes via JS
	 * All meta boxes are included, but the job of showing/hiding them are handled via JS
	 */
	class RWMB_Show_Hide
	{
		/**
		 * Add hooks when class is loaded
		 *
		 * @return void
		 */
		static public function load()
		{
			add_action( 'rwmb_before', array( __CLASS__, 'js_data' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
		}

		/**
		 * Output data for Javascript in data-show, data-hide attributes
		 * Data is output as a div.rwmb-show-hide inside the meta box
		 * JS will read this data and process
		 *
		 * @param RW_Meta_Box $obj The meta box object
		 *
		 * @return void
		 */
		static function js_data( $obj )
		{
			$meta_box = $obj->meta_box;
			$show  = $hide = '';

			if ( ! empty( $meta_box['show'] ) )
				$show = ' data-show="' . esc_attr( json_encode( $meta_box['show'] ) ) . '"';

			if ( ! empty( $meta_box['hide'] ) )
				$hide = ' data-exclude="' . esc_attr( json_encode( $meta_box['hide'] ) ) . '"';

			if ( $show || $hide )
				echo '<div class="rwmb-show-hide"' . $show . $hide . '></div>';
		}

		/**
		 * Enqueue plugin scripts
		 *
		 * @return void
		 */
		static function enqueue_scripts()
		{
			wp_enqueue_script( 'rwmb-show-hide', THEMEROOT . '/admin/meta-box-show-hide/show-hide.js', array( 'jquery' ), '0.1.0', true );
		}
	}

	RWMB_Show_Hide::load();
}
