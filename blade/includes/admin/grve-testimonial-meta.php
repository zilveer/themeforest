<?php
/*
*	Greatives Testimonial Items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	add_action( 'add_meta_boxes', 'blade_grve_testimonial_options_add_custom_boxes' );
	add_action( 'save_post', 'blade_grve_testimonial_options_save_postdata', 10, 2 );

	$blade_grve_testimonial_options = array (
		array(
			'name' => 'Name',
			'id' => 'grve_testimonial_name',
		),
		array(
			'name' => 'Identity',
			'id' => 'grve_testimonial_identity',
		),
	);

	function blade_grve_testimonial_options_add_custom_boxes() {

		add_meta_box(
			'testimonial_oprions',
			esc_html__( 'Testimonial Options', 'blade' ),
			'blade_grve_testimonial_options_box',
			'testimonial'
		);

	}

	function blade_grve_testimonial_options_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_testimonial_save_nonce' );

		$grve_testimonial_name = get_post_meta( $post->ID, 'grve_testimonial_name', true );
		$grve_testimonial_identity = get_post_meta( $post->ID, 'grve_testimonial_identity', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-testimonial-name">
							<strong><?php esc_html_e( 'Name', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Type the name.', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-testimonial-name" class="grve-meta-text" name="grve_testimonial_name" value="<?php echo esc_attr( $grve_testimonial_name ); ?>"/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-testimonial-identity">
							<strong><?php esc_html_e( 'Identity', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Type the identity', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-testimonial-identity" class="grve-meta-text" name="grve_testimonial_identity" value="<?php echo esc_attr( $grve_testimonial_identity ); ?>"/>
					</td>
				</tr>
			</tbody>
		</table>


	<?php
	}


	function blade_grve_testimonial_options_save_postdata( $post_id , $post ) {
		global $blade_grve_testimonial_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['grve_testimonial_save_nonce'] ) || !wp_verify_nonce( $_POST['grve_testimonial_save_nonce'], 'grve_nonce_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'testimonial' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		foreach ( $blade_grve_testimonial_options as $value ) {
			$new_meta_value = ( isset( $_POST[$value['id']] ) ? $_POST[$value['id']] : '' );
			$meta_key = $value['id'];


			$meta_value = get_post_meta( $post_id, $meta_key, true );

			if ( $new_meta_value && '' == $meta_value ) {
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			} elseif ( '' == $new_meta_value && $meta_value ) {
				delete_post_meta( $post_id, $meta_key, $meta_value );
			}
		}

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
