<?php
/**
 * Easily add colors to your categories
 *
 * @package Total WordPress Theme
 * @subpackage Classes
 * @version 3.5.0
 *
 * @todo Finish adding this functionality...
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Term_Colors' ) ) {
	class WPEX_Term_Colors {

		/**
		 * Main constructor
		 *
		 * @since 3.0.0
		 */
		public function __construct() {
			if ( is_admin() ) {
				add_action( 'admin_init', array( 'WPEX_Term_Colors', 'admin_init' ) );
				add_action( 'admin_enqueue_scripts', array( 'WPEX_Term_Colors', 'admin_enqueue_scripts' ) );
				add_action( 'admin_footer', array( 'WPEX_Term_Colors', 'color_picker_js' ) );
			}
		}

		/**
		 * Initialize things in the backend
		 *
		 * @since 3.0.0
		 */
		public function admin_init() {

			// Get taxonomies
			$taxonomies = apply_filters( 'wpex_tax_colors_taxonomies', array(
				'category',
				'portfolio_category',
				'staff_category',
			) );

			// Loop through taxonomies
			foreach ( $taxonomies as $taxonomy ) {

				// Edit form fields
				add_action( $taxonomy . '_edit_form_fields', array( 'WPEX_Term_Colors', 'edit_form_fields' ) );
				
				// Add columns
				add_filter( 'manage_edit-'. $taxonomy .'_columns', array( 'WPEX_Term_Colors', 'admin_columns' ) );
				add_filter( 'manage_'. $taxonomy .'_custom_column', array( 'WPEX_Term_Colors', 'admin_column' ), 10, 3 );

				// Save forms
				add_action( 'edit_'. $taxonomy, array( 'WPEX_Term_Colors', 'edited_category' ), 10, 3 );

			}

		}

		/**
		 * Loads color picker scripts
		 *
		 * @since 3.0.0
		 */
		public static function admin_enqueue_scripts() {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
		}

		/**
		 * Color picker js
		 *
		 * @since 3.0.0
		 */
		public static function color_picker_js() {
  			echo '<script>jQuery(function($){$(".wpex-colorpicker").wpColorPicker();});</script>';
		}

		/**
		 * Adds new category fields
		 *
		 * @since 3.0.0
		 */
		public static function edit_form_fields( $tag ) {

			// Get term id
			$term_id = $tag->term_id;

			// Category Color
			$cat_colors = get_option( "wpex_category_colors" );
			$cat_color  = isset( $cat_colors[$term_id] ) ? $cat_colors[$term_id] : ''; ?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="wpex_term_style"><?php esc_html_e( 'Color', 'total' ); ?></label></th>
				<td><input type="text" name="wpex_category_color" id="wpex_category_color" value="<?php echo esc_attr( $cat_color ); ?>" class="wpex-colorpicker"></td>
			</tr>

		<?php  }

		/**
		 * Saves new category fields
		 *
		 * @since 3.0.0
		 */
		public static function edited_category( $term_id ) {
			if ( isset( $_POST['wpex_category_color'] ) ) {
				$cat_colors = get_option( 'wpex_category_colors' );
				$cat_colors[$term_id] = $_POST['wpex_category_color'];
				if ( $cat_colors ) {
					update_option( 'wpex_category_colors', $cat_colors );
				}
			}
		}

		/**
		 * Outputs custom CSS for the category colors
		 *
		 * @since 3.0.0
		 */
		public static function output_css() {

			// Get colors
			$colors = get_option( 'wpex_category_colors' );

			// Validate
			if ( empty( $colors ) || ! is_array( $colors ) ) {
				return;
			}

			// Declare vars
			$css            = '';
			$target_element = apply_filters( 'wpex_category_colors_target_element', '.wpex-accent-bg' );
			$target_style   = apply_filters( 'wpex_category_colors_target_style', 'background' );

			// Loop through colors
			foreach( $colors as $term_id => $color ) {
				$css .= '.wpex-term-'. $term_id . $target_element .'{';
					$css .= $target_style .':'. $color .';';
				$css .= '}';
			}
			
			// Do nothing yet....should hook into css head output filter

		}

		/**
		 * Thumbnail column added to category admin.
		 *
		 * @since 2.1.0
		 */
		public static function admin_columns( $columns ) {
			$columns['wpex-category-color-col'] = esc_html__( 'Color', 'total' );
			return $columns;
		}

		/**
		 * Thumbnail column value added to category admin.
		 *
		 * @since 2.1.0
		 */
		public static function admin_column( $columns, $column, $id ) {

			if ( 'wpex-category-color-col' == $column ) {

				// Get colors
				$colors = get_option( 'wpex_category_colors' );
				$color = isset( $colors[$id] ) ? $colors[$id] : '';

				// Display color
				if ( $color ) {
					echo '<div style="background:'. $color .';height:20px;width:20px;"></div>';
				} else {
					echo '&ndash;';
				}

			}

			// Return columns
			return $columns;

		}

	}

}
new WPEX_Term_Colors();

/**
 * Helper function returns all category tags
 *
 * @since 2.0.0
 */
function wpex_get_term_tags( $taxonomy = '' ) {
	$tags = '';
	$taxonomy = $taxonomy ? $taxonomy : wpex_get_post_type_cat_tax( get_post_type() );
	$terms = wp_get_post_terms( get_the_ID(), $taxonomy );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		foreach( $terms as $term ) {
			$tags .= wpex_generate_term_tag( $term );
		}
	return $tags;
	}
}

/**
 * Helper function returns first category tags
 *
 * @since 2.0.0
 */
function wpex_get_first_term_tag( $taxonomy = '') {
	$taxonomy = $taxonomy ? $taxonomy : wpex_get_post_type_cat_tax( get_post_type() );
	$terms = wp_get_post_terms( get_the_ID(), $taxonomy );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		return wpex_generate_term_tag( $terms[0] );
	}
}

/**
 * Helper function returns first category tags
 *
 * @since 2.0.0
 */
function wpex_generate_term_tag( $term ) {
	$term_link = get_term_link( $term, $term->taxonomy );
	$style = wpex_get_term_color_inline_css( $term->term_id );
	return '<a href="'. esc_url( $term_link ) .'" title="'. esc_attr( $term->name ) .'" class="wpex-term-tag wpex-term-tag-'. $term->term_id .'"'. $style .'>'. $term->name .'</a>';
}

/**
 * Helper function returns a category color
 *
 * @since 2.0.0
 */
function wpex_get_term_color( $term_id ) {
	$colors = get_option( 'wpex_category_colors' );
	return isset( $colors[$term_id] ) ? $colors[$term_id] : '';
}

/**
 * Helper function returns a category color inline css
 *
 * @since 2.0.0
 */
function wpex_get_term_color_inline_css( $term_id = '' ) {
	if ( $color = wpex_get_term_color( $term_id ) ) {
		return ' style="background-color:'. $color .'"';
	}
}