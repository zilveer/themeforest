<?php
/**
 * Adds global term meta options
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Term meta required, introduced in WP 4.4.0
if ( ! function_exists( 'get_term_meta' ) ) {
	return;
}

// Global var for class
global $wpex_term_meta;

// Start Class
if ( ! class_exists( 'WPEX_Term_Meta' ) ) {
	class WPEX_Term_Meta {

		/**
		 * Main constructor
		 *
		 * @since 3.3.3
		 */
		public function __construct() {

			// Register meta options
			// Not needed since it only is used for sanitization which we do last
			//add_action( 'init', array( $this, 'register_meta' ) );

			// Admin init
			add_action( 'admin_init', array( $this, 'meta_form_fields' ), 40 );
			
		}

		/**
		 * Array of meta options
		 *
		 * @since 3.3.3
		 */
		private function meta_options() {

			// Get array of widget areas
			$widget_areas = array( esc_html__( 'Default', 'total' ) );
			$widget_areas = $widget_areas + wpex_get_widget_areas();

			// Return meta array
			return apply_filters( 'wpex_term_meta_options', array(

				// Sidebar select
				'wpex_sidebar' => array(
					'label'    => esc_html__( 'Sidebar', 'total' ),
					'type'     => 'select',
					'choices'  => $widget_areas,
					'sanitize' => 'esc_html',
				),

			) );

		}

		/**
		 * Add meta form fields
		 *
		 * @since 3.3.3
		 */
		public function meta_form_fields() {

			// Get taxonomies
			$taxonomies = get_taxonomies( array(
				'public' => true,
			) );

			// Loop through taxonomies
			foreach ( $taxonomies as $taxonomy ) {

				// Add forms
				add_action( $taxonomy . '_edit_form_fields', array( $this, 'add_form_fields' ) );

				// Save forms
				add_action( 'edited_'. $taxonomy, array( $this, 'save_forms' ), 10, 3 );

			}

		}

		/**
		 * Register meta options
		 *
		 * @since 3.3.3
		 */
		public function register_meta() {

			// Define meta options array on init
			$meta_options = $this->meta_options();

			// Loop through meta options
			foreach( $meta_options as $key => $val ) {
				$sanitize = isset( $val['sanitize'] ) ? $val['sanitize'] : null;
				register_meta( 'term', $key, 'esc_html', $sanitize );
			}

		}	

		/**
		 * Adds new category fields
		 *
		 * @since 3.3.3
		 */
		public function add_form_fields( $tag ) {

			// Nonce
			wp_nonce_field( 'wpex_term_meta_nonce', 'wpex_term_meta_nonce' );

			// Get options
			$meta_options = $this->meta_options();

			// Loop through options
			foreach ( $meta_options as $key => $val ) {
				$this->meta_form_field( $key, $val, $tag );
			}

		}

		/**
		 * Saves meta fields
		 *
		 * @since 3.3.3
		 */
		public function save_forms( $term_id ) {

			// Make sure everything is secure
			if ( empty( $_POST['wpex_term_meta_nonce'] )
				|| ! wp_verify_nonce( $_POST['wpex_term_meta_nonce'], 'wpex_term_meta_nonce' )
			) {
				return;
			}

			// Get options
			$meta_options = $this->meta_options();

			// Loop through options
			foreach ( $meta_options as $key => $val ) {

				// Check option value
				$value = isset( $_POST[$key] ) ? $_POST[$key] : '';

				// Save color
				if ( $value ) {
					update_term_meta( $term_id, $key, $value );
				}

				// Delete color
				else {
					delete_term_meta( $term_id, $key );
				}

			}
			
		}

		/**
		 * Outputs the form field
		 *
		 * @since 3.3.3
		 */
		private function meta_form_field( $key, $val, $tag ) {

			// Get data
			$label    = $val['label'];
			$type     = isset( $val['type'] ) ? $val['type'] : 'text';
			$sanitize = isset( $val['sanitize'] ) ? $val['sanitize'] : null;
			$term_id  = $tag->term_id;
			$value    = get_term_meta( $term_id, $key, true );

			// Select options
			if ( 'select' == $type && isset( $val['choices'] ) ) {
				$choices = $val['choices']; ?>

				<tr class="form-field">
					<th scope="row" valign="top"><label for="wpex_color"><?php echo esc_html( $label ); ?></label></th>
					<td>
						<select name="<?php echo esc_html( $key ); ?>">
							<?php foreach ( $choices as $key => $val ) : ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $value, $key ) ?>><?php echo esc_html( $val ); ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>

			<?php }

		}

	}
}
$wpex_term_meta = new WPEX_Term_Meta();