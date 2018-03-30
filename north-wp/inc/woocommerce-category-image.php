<?php
/**
 * Edit category header field.
 */

function thb_edit_category_header_img( $term, $taxonomy ) {



	$display_type	= get_woocommerce_term_meta( $term->term_id, 'display_type', true );
	$image 			= '';
	$header_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'header_id', true ) );
	$shop_menu_color_cat 	= get_woocommerce_term_meta( $term->term_id, 'shop_menu_color_cat', true );
	if ($header_id) :
		$image = wp_get_attachment_url( $header_id );
	else :
		$image = woocommerce_placeholder_img_src();
	endif;

	?>
	<tr class="form-field">
		<th scope="row"><h2><?php _e( 'North Settings', 'north' ); ?></h2></th>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Header', 'north' ); ?></label></th>
		<td>
			<div id="product_cat_header" style="float:left;margin-right:10px;"><img src="<?php echo esc_url($image); ?>" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="product_cat_header_id" name="product_cat_header_id" value="<?php echo esc_attr($header_id); ?>" />
				<button type="submit" class="thb_upload_header button"><?php _e( 'Upload/Add image', 'north' ); ?></button>
				<button type="submit" class="thb_remove_header button"><?php _e( 'Remove image', 'north' ); ?></button>
			</div>

			<script type="text/javascript">			 

			if (jQuery('#product_cat_thumbnail_id').val() == 0)
				 jQuery('.remove_image_button').hide();

			if (jQuery('#product_cat_header_id').val() == 0)
				 jQuery('.thb_remove_header').hide();

				// Uploading files
				var header_file_frame;

				jQuery(document).on( 'click', '.thb_upload_header', function( event ){

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( header_file_frame ) {
						header_file_frame.open();
						return;
					}

					// Create the media frame.
					header_file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( 'Choose an image', 'north' ); ?>',
						button: {
							text: '<?php _e( 'Use image', 'north' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					header_file_frame.on( 'select', function() {
						attachment = header_file_frame.state().get('selection').first().toJSON();
						jQuery('#product_cat_header_id').val( attachment.id );
						jQuery('#product_cat_header img').attr('src', attachment.url );
						jQuery('.thb_remove_header').show();
					});

					// Finally, open the modal.
					header_file_frame.open();
				});

				jQuery(document).on( 'click', '.thb_remove_header', function( event ){
					jQuery('#product_cat_header img').attr('src', '<?php echo woocommerce_placeholder_img_src(); ?>');
					jQuery('#product_cat_header_id').val('');
					jQuery('.thb_remove_header').hide();
					return false;
				});

			</script>

			<div class="clear"></div>

		</td>

	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Category Header Color', 'north' ); ?></label></th>
		<td>
			<p><input type="radio" name="shop_menu_color_cat" id="shop_menu_color_cat-1" value="background--dark"  class="radio" <?php if($shop_menu_color_cat === 'background--dark'){ echo 'checked="checked"'; } ?>><label for="shop_menu_color_cat-1">Light Menu</label></p>
			<p><input type="radio" name="shop_menu_color_cat" id="shop_menu_color_cat-2" value="background--light"
				class="radio" <?php if($shop_menu_color_cat === 'background--light'){ echo 'checked="checked"'; } ?>><label for="shop_menu_color_cat-2">Dark Menu</label></p>
			<p class="description"><?php _e( 'Category header color', 'north'); ?></p>
		</td>
	</tr>
	<?php

}

add_action( 'product_cat_edit_form_fields', 'thb_edit_category_header_img', 20, 2 );




/**
 * woocommerce_category_header_img_save function.
 */

function thb_category_header_img_save( $term_id, $tt_id, $taxonomy ) {	

	if ( isset( $_POST['product_cat_header_id'] ) )
		update_woocommerce_term_meta( $term_id, 'header_id', absint( $_POST['product_cat_header_id'] ) );
	
	if ( isset( $_POST['shop_menu_color_cat'] ) )
		update_woocommerce_term_meta( $term_id, 'shop_menu_color_cat', $_POST['shop_menu_color_cat'] );
	delete_transient( 'wc_term_counts' );

}

add_action( 'created_term', 'thb_category_header_img_save', 10,3 );
add_action( 'edit_term', 'thb_category_header_img_save', 10,3 );



/**
 * Header column added to category admin.
 */

function thb_woocommerce_product_cat_header_columns( $columns ) {

	$new_columns = array();
	$new_columns['cb'] = $columns['cb'];
	$new_columns['thumb'] = __( 'Image', 'north' );
	$new_columns['header'] = __( 'Header', 'north' );
	unset( $columns['cb'] );
	unset( $columns['thumb'] );

	return array_merge( $new_columns, $columns );

}

add_filter( 'manage_edit-product_cat_columns', 'thb_woocommerce_product_cat_header_columns' );


/**
 * Thumbnail column value added to category admin.
 */

function thb_woocommerce_product_cat_header_column( $columns, $column, $id ) {



	if ( $column == 'header' ) {
		
		$image 			= '';
		$thumbnail_id 	= get_woocommerce_term_meta( $id, 'header_id', true );

		if ($thumbnail_id)
			$image = wp_get_attachment_url( $thumbnail_id );
		else
			$image = woocommerce_placeholder_img_src();

		$columns .= '<img src="' . $image . '" alt="Thumbnail" class="wp-post-image" height="40" width="40" />';

	}

	return $columns;
	
}

add_filter( 'manage_product_cat_custom_column', 'thb_woocommerce_product_cat_header_column', 10, 3 );