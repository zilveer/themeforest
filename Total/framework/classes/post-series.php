<?php
/**
 * Post Series Class
 *
 * @package Total WordPress Theme
 * @subpackage Framework/Classes
 * @version 3.5.0
 */

if ( ! class_exists( 'WPEX_Post_Series_Config' ) ) {

	class WPEX_Post_Series_Config {

		/**
		 * Get things started
		 *
		 * @since 2.0.0
		 */
		public function __construct() {

			// Filters
			add_filter( 'manage_edit-post_columns', array( 'WPEX_Post_Series_Config', 'edit_columns' ) );
			add_filter( 'wpex_is_blog_query', array( 'WPEX_Post_Series_Config', 'wpex_is_blog_query' ) );
			add_filter( 'wpex_customizer_sections', array( 'WPEX_Post_Series_Config', 'customizer_settings' ) );

			// Actions
			add_action( 'init', array( 'WPEX_Post_Series_Config', 'register' ), 0 );
			add_action( 'manage_post_posts_custom_column', array( 'WPEX_Post_Series_Config', 'column_display' ), 10, 2 );
			add_action( 'restrict_manage_posts', array( 'WPEX_Post_Series_Config', 'tax_filters' ) );
			add_action( 'wpex_next_prev_same_cat_taxonomy', array( 'WPEX_Post_Series_Config', 'next_prev_same_cat_taxonomy' ) );

		}

		/**
		 * Registers the custom taxonomy
		 *
		 * @since 2.0.0
		 */
		public static function register() {

			$name = wpex_get_mod( 'post_series_labels' );
			$name = $name ? $name : esc_html__( 'Post Series', 'total' );
			$slug = wpex_get_mod( 'post_series_slug' );
			$slug = $slug ? $slug : 'post-series';

			// Apply filters
			$args = apply_filters( 'wpex_taxonomy_post_series_args', array(
				'labels'             => array(
					'name'                       => $name,
					'singular_name'              => $name,
					'menu_name'                  => $name,
					'search_items'               => esc_html__( 'Search','total' ),
					'popular_items'              => esc_html__( 'Popular', 'total' ),
					'all_items'                  => esc_html__( 'All', 'total' ),
					'parent_item'                => esc_html__( 'Parent', 'total' ),
					'parent_item_colon'          => esc_html__( 'Parent', 'total' ),
					'edit_item'                  => esc_html__( 'Edit', 'total' ),
					'update_item'                => esc_html__( 'Update', 'total' ),
					'add_new_item'               => esc_html__( 'Add New', 'total' ),
					'new_item_name'              => esc_html__( 'New', 'total' ),
					'separate_items_with_commas' => esc_html__( 'Separate with commas', 'total' ),
					'add_or_remove_items'        => esc_html__( 'Add or remove', 'total' ),
					'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'total' ),
				),
				'public'            => true,
				'show_in_nav_menus' => true,
				'show_ui'           => true,
				'show_tagcloud'     => true,
				'hierarchical'      => true,
				'rewrite'           => array(
					'slug'  => $slug,
				),
				'query_var'         => true
			) );

			// Register the taxonomy
			register_taxonomy( 'post_series', array( 'post' ), $args );

		}

		/**
		 * Adds columns to the WP dashboard edit screen
		 *
		 * @since 2.0.0
		 */
		public static function edit_columns( $columns ) {
			$columns['wpex_post_series'] = esc_html__( 'Post Series', 'total' );
			return $columns;
		}

		/**
		 * Adds columns to the WP dashboard edit screen
		 *
		 * @since 2.0.0
		 */
		public static function column_display( $column, $post_id ) {
			switch ( $column ) {
				case "wpex_post_series":
				if ( $category_list = get_the_term_list( $post_id, 'post_series', '', ', ', '' ) ) {
					echo $category_list;
				} else {
					echo '&mdash;';
				}
				break;
			}
		}

		/**
		 * Adds taxonomy filters to the posts admin page
		 *
		 * @since 2.0.0
		 */
		public static function tax_filters() {
			global $typenow;
			if ( 'post' == $typenow ) {
				$tax_slug         = 'post_series';
				$current_tax_slug = isset( $_GET[$tax_slug] ) ? esc_html( $_GET[$tax_slug] ) : false;
				$tax_obj          = get_taxonomy( $tax_slug );
				$tax_name         = $tax_obj->labels->name;
				$terms            = get_terms( $tax_slug );
				if ( count( $terms ) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>$tax_name</option>";
					foreach ( $terms as $term ) {
						echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
					}
					echo "</select>";
				}
			}
		}

		/**
		 * Alter next/previous post links same_cat taxonomy
		 *
		 * @since 2.0.0
		 */
		public static function next_prev_same_cat_taxonomy( $taxonomy ) {
			if ( wpex_is_post_in_series() ) {
				$taxonomy = 'post_series';
			}
			return $taxonomy;
		}

		/**
		 * Return true for the wpex_is_blog_query when visiting a post_series tax page
		 *
		 * @since 2.0.0
		 */
		public static function wpex_is_blog_query( $bool ) {
			if ( is_tax( 'post_series' ) ) {
				$bool = true;
			}
			return $bool;
		}

		/**
		 * Adds customizer settings for the animations
		 *
		 * @return array
		 *
		 * @since 2.1.0
		 */
		public static function customizer_settings( $sections ) {
			$sections['wpex_post_series'] = array(
				'title' => esc_html__( 'Post Series', 'total' ),
				'panel' => 'wpex_general',
				'settings' => array(
					array(
						'id' => 'post_series_labels',
						'transport' => 'postMessage',
						'control' => array (
							'label' => esc_html__( 'Admin Label', 'total' ),
							'type' => 'text',
						),
					),
					array(
						'id' => 'post_series_slug',
						'transport' => 'postMessage',
						'control' => array (
							'label' => esc_html__( 'Slug', 'total' ),
							'type' => 'text',
						),
					),
					array(
						'id' => 'post_series_heading',
						'control' => array (
							'label' => esc_html__( 'Front-End Heading', 'total' ),
							'type' => 'text',
						),
					),
					array(
						'id' => 'post_series_bg',
						'transport' => 'postMessage',
						'control' => array (
							'label' => esc_html__( 'Background', 'total' ),
							'type' => 'color',
						),
						'inline_css' => array(
							'target' => array(
								'#post-series',
								'#post-series-title',
							),
							'alter' => 'background',
						),
					),
					array(
						'id' => 'post_series_borders',
						'transport' => 'postMessage',
						'control' => array (
							'label' => esc_html__( 'Borders', 'total' ),
							'type' => 'color',
						),
						'inline_css' => array(
							'target' => array(
								'#post-series',
								'#post-series-title',
								'#post-series li',
							),
							'alter' => 'border-color',
						),
					),
					array(
						'id' => 'post_series_color',
						'transport' => 'postMessage',
						'control' => array (
							'label' => esc_html__( 'Color', 'total' ),
							'type' => 'color',
						),
						'inline_css' => array(
							'target' => array(
								'#post-series',
								'#post-series a',
								'#post-series .post-series-count',
								'#post-series-title',
							),
							'alter' => 'color',
						),
					),
				)
			);
			return $sections;
		}

	}
}
new WPEX_Post_Series_Config;