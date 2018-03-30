<?php
/**
	* Category Custom Fields
 */
function eventstation_category_edit_settings( $term, $taxonomy ) {
	$eventstation_category_sidebar_style  = get_term_meta( $term->term_id, 'eventstation_category_sidebar_style', true );
	$eventstation_category_header_style  = get_term_meta( $term->term_id, 'eventstation_category_header_style', true );
	$eventstation_category_footer_style  = get_term_meta( $term->term_id, 'eventstation_category_footer_style', true );
?>

	<tr class="form-field gloria-custom-admin-row gloria-custom-admin-row-column">
		<th scope="row" valign="top">
			<label><?php esc_html_e( 'Sidebar Style', 'eventstation' ); ?></label>
		</th>
			
		<td>
			<div>
				<p>
					<input type="radio" name="eventstation_category_sidebar_style" id="eventstation-category-sidebar-1" value="nosidebar" class="radio" <?php if( $eventstation_category_sidebar_style == 'nosidebar' ){ echo 'checked="checked"'; } ?>>
					<label for="eventstation-category-sidebar-1"><img for="eventstation-category-header-1" src="<?php echo get_template_directory_uri() . '/admin/assets/images/admin/none-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'None Sidebar', 'eventstation' ); ?>"></label>
				</p>
			</div>

			<div>
				<p>
					<input type="radio" name="eventstation_category_sidebar_style" id="eventstation-category-sidebar-2" value="left" class="radio" <?php if( $eventstation_category_sidebar_style == 'left' ){ echo 'checked="checked"'; } ?>>
					<label for="eventstation-category-sidebar-2"><img for="eventstation-category-header-2" src="<?php echo get_template_directory_uri() . '/admin/assets/images/admin/left-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'Left Sidebar', 'eventstation' ); ?>"></label>
				</p>
			</div>

			<div>
				<p>
					<input type="radio" name="eventstation_category_sidebar_style" id="eventstation-category-sidebar-3" value="right" class="radio" <?php if( $eventstation_category_sidebar_style == 'right' ){ echo 'checked="checked"'; } ?>>
					<label for="eventstation-category-sidebar-3"><img for="eventstation-category-header-3" src="<?php echo get_template_directory_uri() . '/admin/assets/images/admin/right-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'Right Sidebar', 'eventstation' ); ?>"></label>
				</p>
			</div>
		</td>
	</tr>

	<tr class="form-field gloria-custom-admin-row">
		<th scope="row" valign="top">
			<label><?php esc_html_e( 'Header Style', 'eventstation' ); ?></label>
		</th>
			
		<td>
			<div>
				<p>
					<input type="radio" name="eventstation_category_header_style" id="eventstation-category-header-1" value="default" class="radio" <?php if( $eventstation_category_header_style == 'default' ){ echo 'checked="checked"'; } ?>>
					<label for="eventstation-category-header-1"><img for="eventstation-category-header-1" src="<?php echo get_template_directory_uri() . '/admin/assets/images/admin/header-1.jpg'; ?>" alt="<?php echo esc_html__( 'Default Style', 'eventstation' ); ?>"></label>
				</p>
			</div>

			<div>
				<p>
					<input type="radio" name="eventstation_category_header_style" id="eventstation-category-header-2" value="alternativestylev1" class="radio" <?php if( $eventstation_category_header_style == 'alternativestylev1' ){ echo 'checked="checked"'; } ?>>
					<label for="eventstation-category-header-2"><img for="eventstation-category-header-2" src="<?php echo get_template_directory_uri() . '/admin/assets/images/admin/header-2.jpg'; ?>" alt="<?php echo esc_html__( 'Alternative Style v1', 'eventstation' ); ?>"></label>
				</p>
			</div>

			<div>
				<p>
					<input type="radio" name="eventstation_category_header_style" id="eventstation-category-header-3" value="alternativestylev2" class="radio" <?php if( $eventstation_category_header_style == 'alternativestylev2' ){ echo 'checked="checked"'; } ?>>
					<label for="eventstation-category-header-3"><img for="eventstation-category-header-3" src="<?php echo get_template_directory_uri() . '/admin/assets/images/admin/header-3.jpg'; ?>" alt="<?php echo esc_html__( 'Alternative Style v2', 'eventstation' ); ?>"></label>
				</p>
			</div>
		</td>
	</tr>

	<tr class="form-field gloria-custom-admin-row">
		<th scope="row" valign="top">
			<label><?php esc_html_e( 'Footer Style', 'eventstation' ); ?></label>
		</th>
			
		<td>
			<div>
				<p>
					<input type="radio" name="eventstation_category_footer_style" id="eventstation-footer-style-1" value="default" class="radio" <?php if( $eventstation_category_footer_style == 'default' ){ echo 'checked="checked"'; } ?>>
					<label for="eventstation-footer-style-1"><img src="<?php echo get_template_directory_uri() . '/admin/assets/images/admin/footer-1.jpg'; ?>" alt="<?php echo esc_html__( 'Default Style', 'eventstation' ); ?>"></label>
				</p>
			</div>

			<div>
				<p>
					<input type="radio" name="eventstation_category_footer_style" id="eventstation-footer-style-2" value="alternativestyle" class="radio" <?php if( $eventstation_category_footer_style == 'alternativestyle' ){ echo 'checked="checked"'; } ?>>
					<label for="eventstation-footer-style-2"><img src="<?php echo get_template_directory_uri() . '/admin/assets/images/admin/footer-2.jpg'; ?>" alt="<?php echo esc_html__( 'Alternative Style v1', 'eventstation' ); ?>"></label>
				</p>
			</div>
		</td>
	</tr>
  
  <?php
}
add_action( 'category_edit_form_fields', 'eventstation_category_edit_settings', 10,2 );

function eventstation_category_settings_save( $term_id, $tt_id, $taxonomy ) { 
	if ( isset( $_POST['eventstation_category_sidebar_style'] ) ) {
		update_term_meta( $term_id, 'eventstation_category_sidebar_style', $_POST['eventstation_category_sidebar_style'] );
	}

	if ( isset( $_POST['eventstation_category_header_style'] ) ) {
		update_term_meta( $term_id, 'eventstation_category_header_style', $_POST['eventstation_category_header_style'] );
	}

	if ( isset( $_POST['eventstation_category_footer_style'] ) ) {
		update_term_meta( $term_id, 'eventstation_category_footer_style', $_POST['eventstation_category_footer_style'] );
	}
}
add_action( 'edit_term', 'eventstation_category_settings_save', 10,3 );