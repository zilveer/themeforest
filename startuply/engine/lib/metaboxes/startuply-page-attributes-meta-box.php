<?php
add_action( 'add_meta_boxes', 'startuply_add_page_attributes_meta_box' );

/**
 * Adds the meta box to the page screen
 */
function startuply_add_page_attributes_meta_box( $post_type )
{
	$screens = array( 'page' );

	foreach ($screens as $screen) {
		// remove the default
		remove_meta_box(
			'pageparentdiv',
			$screen,
			'side'
		);

		// add our own
		add_meta_box(
			'startuply-pageparentdiv',
			'page' == $post_type ? __('Page Attributes', 'vivaco') : __('Attributes', 'vivaco'),
			'startuply_page_attributes_meta_box',
			$screen,
			'side',
			'core'
		);
	}
}

/**
 * Callback function for our meta box.  Echos out the content
 */
function startuply_page_attributes_meta_box( $post ) {
	$values = get_post_custom( $post->ID );
	//$selected = isset( $values['_startuply_menu_style_key'] ) ? esc_attr( $values['_startuply_menu_style_key'][0] ) : 'inner-menu';
	$selected = '';
	wp_nonce_field( 'startuply_page_attributes_meta_box', 'startuply_page_attributes_meta_boxnonce' );

	if ( 'page' == $post->post_type && 0 != count( get_page_templates( $post ) ) ) {
	$template = !empty($post->page_template) ? $post->page_template : false;
		?>
		<p><strong><?php _e('Template', 'vivaco') ?></strong></p>
		<label class="screen-reader-text" for="page_template"><?php _e('Page Template', 'vivaco') ?></label><select name="page_template" id="page_template">
		<option value='default'><?php _e('Default Template', 'vivaco'); ?></option>
		<?php page_template_dropdown($template); ?>
		</select>
	<?php } ?>

	<?php // add your drop down ?>
	<p><strong><?php _e( 'Choose menu to use on this page', 'Vivaco' ) ?></strong></p>
	<p><label class="screen-reader-text" for="startuply_page_menu_style"><?php _e( 'Choose menu to use on this page', 'Vivaco' ) ?></label>
		<select name="startuply_page_menu_style" id="startuply_page_menu_style">
		   <option value="main-menu" <?php selected( $selected, 'main-menu' ) ?> ><?php _e( 'Main menu', 'Vivaco' ) ?></option>
		   <!--<option value="inner-menu" <?php selected( $selected, 'inner-menu' )?> ><?php _e( 'Default menu', 'Vivaco' ) ?></option>-->
		</select>
	</p>


	<?php
	// Copy the the `page_attributes_meta_box` function content here
	$post_type_object = get_post_type_object($post->post_type);
	if ( $post_type_object->hierarchical ) {
		$dropdown_args = array(
			'post_type'        => $post->post_type,
			'exclude_tree'     => $post->ID,
			'selected'         => $post->post_parent,
			'name'             => 'parent_id',
			'show_option_none' => __('(no parent)', 'vivaco'),
			'sort_column'      => 'menu_order, post_title',
			'echo'             => 0,
		);

		/**
		 * Filter the arguments used to generate a Pages drop-down element.
		 *
		 * @since 3.3.0
		 *
		 * @see wp_dropdown_pages()
		 *
		 * @param array   $dropdown_args Array of arguments used to generate the pages drop-down.
		 * @param WP_Post $post          The current WP_Post object.
		 */
		$dropdown_args = apply_filters( 'page_attributes_dropdown_pages_args', $dropdown_args, $post );
		$pages = wp_dropdown_pages( $dropdown_args );
		if ( ! empty($pages) ) {
?>
<p><strong><?php _e('Parent', 'vivaco') ?></strong></p>
<label class="screen-reader-text" for="parent_id"><?php _e('Parent', 'vivaco') ?></label>
<?php echo $pages; ?>
<?php
		} // end empty pages check
	} // end hierarchical check.
?>
<p><strong><?php _e('Order', 'vivaco') ?></strong></p>
<p><label class="screen-reader-text" for="menu_order"><?php _e('Order', 'vivaco') ?></label><input name="menu_order" type="text" size="4" id="menu_order" value="<?php echo esc_attr($post->menu_order) ?>" /></p>
<p><?php if ( 'page' == $post->post_type ) _e( 'Need help? Use the Help tab in the upper right of your screen.', 'vivaco' ); ?></p>
<?php
}

function startuply_save_page_attributes_meta_box( $post_id ) {

		// Check if our nonce is set.
		if ( ! isset( $_POST['startuply_page_attributes_meta_boxnonce'] ) ) {return;}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['startuply_page_attributes_meta_boxnonce'], 'startuply_page_attributes_meta_box' ) ) { return; }

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
		} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
		}

		// Make sure that it is set.
		if ( ! isset( $_POST['startuply_page_menu_style'] ) ) { return ;}
		$value = sanitize_text_field( $_POST['startuply_page_menu_style'] );

		// Update the meta field in the database.
		update_post_meta( $post_id, '_startuply_menu_style_key', $value );
}
add_action( 'save_post', 'startuply_save_page_attributes_meta_box' );
