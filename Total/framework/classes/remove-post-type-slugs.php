<?php
/**
 * Removes slugs from custom post types
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
if ( ! class_exists( 'WPEX_Remove_Post_Type_Slugs' ) ) {
	class WPEX_Remove_Post_Type_Slugs {

		/**
		 * Theme's post types to remove the slugs from
		 *
		 * @since 2.0.0
		 */
		private $post_types;

		/**
		 * Main constructor
		 *
		 * @since 2.0.0
		 */
		public function __construct() {
			add_filter( 'post_type_link', array( 'WPEX_Remove_Post_Type_Slugs', 'remove_slugs' ), 10, 3 );
			add_action( 'pre_get_posts', array( 'WPEX_Remove_Post_Type_Slugs', 'post_type_trick' ) );
		}

		/**
		 * Returns array of types to alter
		 *
		 * @since 3.5.0
		 */
		private static function get_types() {
			return array( 'portfolio', 'staff', 'testimonials' );
		}

		/**
		 * Remove slugs from the post types
		 *
		 * @since 2.0.0
		 */
		public static function remove_slugs( $post_link, $post, $leavename ) {

			// Get types
			$types = self::get_types();

			// If not part of the theme post types return default post link
			if ( ! in_array( $post->post_type, $types ) || 'publish' != $post->post_status ) {
				return $post_link;
			}

			// Get the post type slug
			if ( 'portfolio' == $post->post_type ) {
				$slug = wpex_get_mod( 'portfolio_slug', 'portfolio-item' );
				$slug = $slug ? $slug : 'portfolio-item';
			} elseif ( 'staff' == $post->post_type ) {
				$slug = wpex_get_mod( 'staff_slug' );
				$slug = $slug ? $slug : 'staff-member';
			} elseif ( 'testimonials' == $post->post_type ) {
				$slug = wpex_get_mod( 'testimonials_slug', 'testimonial' );
				$slug = $slug ? $slug : 'testimonial';
			} else {
				$slug = '';
			}

			// Remove current slug
			if ( $slug ) {
				$post_link = str_replace( '/'. $slug .'/', '/', $post_link );
			}

			// Return new post link without slug
			return $post_link;

		}

		/**
		 * WordPress will no longer recognize the custom post type as a custom post type
		 * this function tricks WordPress into thinking it actually is still a custom post type.
		 *
		 * @since 2.0.0
		 */
		public static function post_type_trick( $query ) {

			// Only noop the main query
			if ( ! $query->is_main_query() ) {
				return;
			}

			// Only noop our very specific rewrite rule match
			if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
				return;
			}

			// Get types
			$types = self::get_types();

			// 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
			if ( ! empty( $query->query['name'] ) ) {
				$array = array( 'post', 'page' );
				$array = array_merge( $array, $types );
				$query->set( 'post_type', $array );
			}
		}

	}
}
new WPEX_Remove_Post_Type_Slugs();