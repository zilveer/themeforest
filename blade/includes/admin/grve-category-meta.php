<?php
/*
*	Greatives Category Meta
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	//Categories
	add_action('category_edit_form_fields','blade_grve_category_edit_form_fields', 10);
	add_action('post_tag_edit_form_fields','blade_grve_category_edit_form_fields', 10);
	add_action('product_cat_edit_form_fields','blade_grve_category_edit_form_fields', 10);
	add_action('product_tag_edit_form_fields','blade_grve_category_edit_form_fields', 10);
	add_action('edit_term','blade_grve_save_category_fields', 10, 3);

	function blade_grve_category_edit_form_fields( $term ) {
		$grve_term_meta = blade_grve_get_term_meta( $term->term_id, 'grve_custom_title_options' );
		blade_grve_print_category_fields( $grve_term_meta );
	}

	function blade_grve_print_category_fields( $grve_custom_title_options = array() ) {
?>
		<tr class="form-field">
			<td colspan="2">
				<div id="grve-category-title" class="postbox">
<?php

			//Custom Title Option
			blade_grve_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'grve_term_meta[custom]',
					'id' => 'grve-category-title-custom',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'custom' ),
					'options' => array(
						'' => esc_html__( '-- Inherit --', 'blade' ),
						'custom' => esc_html__( 'Custom', 'blade' ),

					),
					'label' => array(
						"title" => esc_html__( 'Title Options', 'blade' ),
					),
					'group_id' => 'grve-category-title',
					'highlight' => 'highlight',
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'textfield',
					'name' => 'grve_term_meta[height]',
					'id' => 'grve-category-title-height',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'height', '350' ),
					'label' => array(
						"title" => esc_html__( 'Title Area Height', 'blade' ),
					),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] }
					]',
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'textfield',
					'name' => 'grve_term_meta[min_height]',
					'id' => 'grve-category-title-min-height',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'min_height', '320' ),
					'label' => array(
						"title" => esc_html__( 'Title Area Minimum Height', 'blade' ),
					),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] }
					]',
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'grve_term_meta[bg_color]',
					'id' => 'grve-category-title-bg-color',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_color', 'light' ),
					'value2' => blade_grve_array_value( $grve_custom_title_options, 'bg_color_custom', '#ffffff' ),
					'label' => array(
						"title" => esc_html__( 'Background Color', 'blade' ),
					),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] }
					]',
					'multiple' => 'multi',
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'grve_term_meta[title_color]',
					'id' => 'grve-category-title-title-color',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'title_color', 'dark' ),
					'value2' => blade_grve_array_value( $grve_custom_title_options, 'title_color_custom', '#000000' ),
					'label' => array(
						"title" => esc_html__( 'Title Color', 'blade' ),
					),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] }
					]',
					'multiple' => 'multi',
				)
			);

			blade_grve_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'grve_term_meta[caption_color]',
					'id' => 'grve-category-title-caption_color',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'caption_color', 'dark' ),
					'value2' => blade_grve_array_value( $grve_custom_title_options, 'caption_color_custom', '#000000' ),
					'label' => array(
						"title" => esc_html__( 'Description Color', 'blade' ),
					),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] }
					]',
					'multiple' => 'multi',
				)
			);

			global $blade_grve_media_bg_position_selection;
			blade_grve_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'grve_term_meta[content_position]',
					'id' => 'grve-category-title-content_position',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'content_position', 'center-center' ),
					'options' => $blade_grve_media_bg_position_selection,
					'label' => array(
						"title" => esc_html__( 'Content Position', 'blade' ),
					),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] }
					]',
				)
			);

			blade_grve_print_admin_option(
				array(
					'type' => 'select-text-animation',
					'name' => 'grve_term_meta[content_animation]',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'content_animation', 'fade-in' ),
					'label' => esc_html__( 'Content Animation', 'blade' ),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] }
					]',
				)
			);


			blade_grve_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'grve_term_meta[bg_mode]',
					'id' => 'grve-category-title-bg-mode',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_mode'),
					'options' => array(
						'' => esc_html__( 'Color Only', 'blade' ),
						'custom' => esc_html__( 'Custom Image', 'blade' ),

					),
					'label' => array(
						"title" => esc_html__( 'Background', 'blade' ),
					),
					'group_id' => 'grve-category-title',
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] }

					]',
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'select-image',
					'name' => 'grve_term_meta[bg_image_id]',
					'id' => 'grve-category-title-bg-image-id',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_image_id'),
					'label' => array(
						"title" => esc_html__( 'Background Image', 'blade' ),
					),
					'width' => 'fullwidth',
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] },
						{ "id" : "grve-category-title-bg-mode", "values" : ["custom"] }

					]',
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'select-bg-position',
					'name' => 'grve_term_meta[bg_position]',
					'id' => 'grve-category-title-bg-position',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_position', 'center-center'),
					'label' => array(
						"title" => esc_html__( 'Background Position', 'blade' ),
					),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] },
						{ "id" : "grve-category-title-bg-mode", "values" : ["custom"] }
					]',
				)
			);

			blade_grve_print_admin_option(
				array(
					'type' => 'select-pattern-overlay',
					'name' => 'grve_term_meta[pattern_overlay]',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'pattern_overlay'),
					'label' => esc_html__( 'Pattern Overlay', 'blade' ),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] },
						{ "id" : "grve-category-title-bg-mode", "values" : ["custom"] }
					]',
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'grve_term_meta[color_overlay]',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'color_overlay', 'dark' ),
					'value2' => blade_grve_array_value( $grve_custom_title_options, 'color_overlay_custom', '#000000' ),
					'label' => esc_html__( 'Color Overlay', 'blade' ),
					'multiple' => 'multi',
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] },
						{ "id" : "grve-category-title-bg-mode", "values" : ["custom"] }
					]',
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'select-opacity',
					'name' => 'grve_term_meta[opacity_overlay]',
					'value' => blade_grve_array_value( $grve_custom_title_options, 'opacity_overlay', '0' ),
					'label' => esc_html__( 'Opacity Overlay', 'blade' ),
					'dependency' =>
					'[
						{ "id" : "grve-category-title-custom", "values" : ["custom"] },
						{ "id" : "grve-category-title-bg-mode", "values" : ["custom"] }
					]',
				)
			);
?>
			</div>
		</td>
	</tr>
<?php
	}

	//Save Category Meta
	function blade_grve_save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		$custom_meta_tax = array ( 'category', 'post_tag', 'product_cat', 'product_tag' );

		if ( isset( $_POST['grve_term_meta'] ) && in_array( $taxonomy, $custom_meta_tax ) ) {
			$grve_term_meta = blade_grve_get_term_meta( $term_id, 'grve_custom_title_options' );
			$cat_keys = array_keys( $_POST['grve_term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset( $_POST['grve_term_meta'][$key] ) ) {
					$grve_term_meta[$key] = $_POST['grve_term_meta'][$key];
				}
			}
			blade_grve_update_term_meta( $term_id , 'grve_custom_title_options', $grve_term_meta );
		}
	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
