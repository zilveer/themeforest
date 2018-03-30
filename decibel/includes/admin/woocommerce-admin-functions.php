<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_category_metabox_add' ) ) {
	/**
	 * Add image size term meta for woocommerce category mosaic shortcode
	 *
	 * @access public
	 * @return void
	 */
	function wolf_category_metabox_add( $cat ) {
		$sizes = array(
			'1x1' => __( 'Square', 'wolf' ),
			'2x1' => __( 'Landscape', 'wolf' ),
			'1x2' => __( 'Portrait', 'wolf' ),
			'2x2' => __( 'Big square', 'wolf' ),
		);
		?>
		<div class="form-field">
			<label for="thumbnail_size"><?php _e( 'Image Size', 'wolf' ); ?></label>
			<select name="thumbnail_size" id="thumbnail_size">
				<?php foreach ( $sizes as $size => $size_name ) : ?>
					<option value="<?php echo esc_attr( $size ); ?>"><?php echo esc_attr( $size_name ); ?></option>
				<?php endforeach; ?>
			</select>
			<p class="description"><?php _e( 'Will be used for the mosaic categories shortcode only.', 'wolf'); ?></p>
		</div>
	<?php }
	add_action( 'product_cat_add_form_fields', 'wolf_category_metabox_add', 10, 1 );
}

if ( ! function_exists( 'wolf_category_metabox_edit' ) ) {
	/**
	 * Edit image size term meta for woocommerce category mosaic shortcode
	 *
	 * @access public
	 * @return void
	 */
	function wolf_category_metabox_edit( $cat ) {
		$sizes = array(
			'1x1' => __( 'Square', 'wolf' ),
			'2x1' => __( 'Landscape', 'wolf' ),
			'1x2' => __( 'Portrait', 'wolf' ),
			'2x2' => __( 'Big square', 'wolf' ),
		);
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="thumbnail_size"><?php _e( 'Image Size', 'wolf' ); ?></label>
			</th>
			<td>
				<select name="thumbnail_size" id="thumbnail_size">
					<?php foreach ( $sizes as $size => $size_name ) : ?>
						<option value="<?php echo esc_attr( $size ); ?>" <?php echo selected( get_woocommerce_term_meta( $cat->term_id, 'thumbnail_size', true ), $size ); ?>><?php echo esc_attr( $size_name ); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="description"><?php _e( 'Will be used for the mosaic categories shortcode only.', 'wolf'); ?></p>
			</td>
		</tr>
	<?php }
	add_action( 'product_cat_edit_form_fields', 'wolf_category_metabox_edit', 10, 1 );
}

if ( ! function_exists( 'wolf_save_category_metadata' ) ) {
	/**
	 * Save image size term meta for woocommerce category mosaic shortcode
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_save_category_metadata( $term_id ) {
		if ( isset( $_POST['thumbnail_size'] ) )
			update_woocommerce_term_meta( $term_id, 'thumbnail_size', $_POST['thumbnail_size'] );
	}
	add_action( 'created_product_cat', 'wolf_save_category_metadata', 10, 1);
	add_action( 'edited_product_cat', 'wolf_save_category_metadata', 10, 1);
}
