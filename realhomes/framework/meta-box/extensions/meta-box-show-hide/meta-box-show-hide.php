<?php
/*
Plugin Name: Meta Box Show Hide
Plugin URI: http://metabox.io/plugins/meta-box-show-hide-javascript/
Description: Easily show/hide meta boxes by page template, taxonomy (including category, post format) using Javascript.
Version: 0.2.1
Author: Rilwis
Author URI: http://www.deluxeblogtips.com
License: GPL2+
*/

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Show_Hide' ) )
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
		static public function js_data( $obj )
		{
			global $post;
			$meta_box = $obj->meta_box;
			$keys = array( 'show', 'hide' );
			$data = '';

			$is_child = $post->post_parent ? true : false;

			foreach ( $keys as $e )
			{
				if ( ! empty( $meta_box[$e] ) )
				{
					if ( isset( $meta_box[$e]['is_child'] ) )
						$meta_box[$e]['is_child'] = array( $meta_box[$e]['is_child'], $is_child );

					$data .= ' data-' . $e . '="' . esc_attr( json_encode( $meta_box[$e] ) ) . '"';
				}
			}

			if ( '' != $data )
				echo '<div class="rwmb-show-hide"' . $data . '></div>';
		}

		/**
		 * Enqueue plugin scripts
		 *
		 * @return void
		 */
		static public function enqueue_scripts(){
			// wp_enqueue_script( 'rwmb-show-hide', plugins_url( 'show-hide.js', __FILE__ ), array( 'jquery' ), '0.1.0', true );
			wp_enqueue_script( 'rwmb-show-hide', get_template_directory_uri() . '/framework/meta-box/extensions/meta-box-show-hide/show-hide.js', array( 'jquery' ), '0.1.0', true );
		}
	}

	RWMB_Show_Hide::load();
}
