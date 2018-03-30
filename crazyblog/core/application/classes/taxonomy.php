<?php

class crazyblogTaxonomy {

	public function __construct() {
		add_action( 'recipe_category_add_form_fields', array( $this, 'crazyblog_edit_category' ) );
		add_action( 'recipe_category_edit_form_fields', array( $this, 'crazyblog_edit_category_form' ) );
		add_action( 'created_recipe_category', array( $this, 'crazyblog_save_category' ), 10, 2 );
		add_action( 'edited_recipe_category', array( $this, 'crazyblog_save_category' ), 10, 2 );
	}

	public function crazyblog_edit_category( $term ) {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_media();
		?>
		

		<div class="form-field term-cat-icon-wrap">
			<label for="category_icon"><?php esc_html_e( 'Upload icon', 'crazyblog' ) ?></label>
			<input type="hidden" name="category_icon_val" />
			<button class="category_icon button button-hero" name="category_icon" id="category_icon"><?php esc_html_e( 'Upload', 'crazyblog' ) ?></button>
			<div class="preview none"></div>
		</div>

		<div class="form-field term-cat-image-wrap">
			<label for="category_image"><?php esc_html_e( 'Upload Image', 'crazyblog' ) ?></label>
			<input type="hidden" name="category_image_val" />
			<button class="category_image button button-hero" name="category_image" id="category_image"><?php esc_html_e( 'Upload', 'crazyblog' ) ?></button>
			<div class="preview none"></div>
		</div>
                
		<?php 
		wp_enqueue_script( 'df-new-recipes-cat', crazyblog_URI . 'core/duffers_panel/panel/public/js/vendor/new-recipes-cat.js' ); 
                wp_enqueue_style( 'df-new-recipes-cat-style', crazyblog_URI . 'core/duffers_panel/panel/public/css/vendor/custom-admin-style.css' ); 
		
	}

	public function crazyblog_edit_category_form( $term ) {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_media();
		$key = $term->taxonomy . '_' . $term->term_id;
		$term_meta = get_option( $key );

		$icon_val = (!empty( $term_meta ) && count( $term_meta ) > 0 && isset( $term_meta['category_icon_val'] ) && !empty( $term_meta['category_icon_val'] )) ? $term_meta['category_icon_val'] : '';
		$image_val = (!empty( $term_meta ) && count( $term_meta ) > 0 && isset( $term_meta['category_image_val'] ) && !empty( $term_meta['category_image_val'] )) ? $term_meta['category_image_val'] : '';


		$icon_has_show = (empty( $icon_val )) ? 'style=display:none' : '';
		$image_has_show = (empty( $image_val )) ? 'style=display:none' : '';

		$icon_src = (!empty( $icon_val )) ? wp_get_attachment_image_src( $icon_val, 'full' ) : '';
		$image_src = (!empty( $image_val )) ? wp_get_attachment_image_src( $image_val, 'thumbnail' ) : '';
		?>
		
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="category_icon"><?php esc_html_e( 'Upload icon', 'crazyblog' ) ?></label>
			</th>
			<td>
				<input type="hidden" value="<?php echo esc_attr( $icon_val ) ?>" name="category_icon_val" />
				<button class="category_icon button button-hero" name="category_icon_val" id="category_icon"><?php esc_html_e( 'Upload', 'crazyblog' ) ?></button>
				<div class="preview" <?php echo esc_attr( $icon_has_show ) ?>>
					<?php
					if ( !empty( $icon_src ) ) {
						?>
						<div class="image">
							<div class="cross">x</div>
							<img src="<?php echo esc_url( $icon_src['0'] ) ?>" alt="" />
						</div>
						<?php
					}
					?>
				</div>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="category_image"><?php esc_html_e( 'Upload Image', 'crazyblog' ) ?></label>
			</th>
			<td>
				<input type="hidden" value="<?php echo esc_attr( $image_val ) ?>" name="category_image_val" />
				<button class="category_image button button-hero" name="category_image_val" id="category_image"><?php esc_html_e( 'Upload', 'crazyblog' ) ?></button>
				<div class="preview" <?php echo esc_attr( $image_has_show ) ?>>
					<?php
					if ( !empty( $image_src ) ) {
						?>
						<div class="image">
							<div class="cross">x</div>
							<img src="<?php echo esc_url( $image_src['0'] ) ?>" alt="" />
						</div>
						<?php
					}
					?>
				</div>
			</td>
		</tr>
		
		<?php
                wp_enqueue_script( 'df-edit-recipes-cat', crazyblog_URI . 'core/duffers_panel/panel/public/js/vendor/edit-recipes-cat.js' );
                wp_enqueue_style( 'df-new-recipes-cat-style', crazyblog_URI . 'core/duffers_panel/panel/public/css/vendor/custom-admin-style.css' ); 
	}

	public function crazyblog_save_category( $term_id ) {
		if ( isset( $_POST ) ) {
			$key = $_POST['taxonomy'] . '_' . $term_id;
			$data = array(
				'category_icon_val' => $_POST['category_icon_val'],
				'category_image_val' => $_POST['category_image_val']
			);
			if ( get_option( $key ) ) {
				update_option( $key, $data );
			} else {
				add_option( $key, $data );
			}
		}
	}

}
