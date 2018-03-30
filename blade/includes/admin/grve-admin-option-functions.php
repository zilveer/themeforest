<?php
/*
*	Collection of functions for admin options
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

$blade_grve_media_boolean_selection = array(
	'yes' => esc_html__( 'Yes', 'blade' ),
	'no' => esc_html__( 'No', 'blade' ),
);

$blade_grve_media_align_selection = array(
	'left' => esc_html__( 'Left', 'blade' ),
	'right' => esc_html__( 'Right', 'blade' ),
	'center' => esc_html__( 'Center', 'blade' ),
);

$blade_grve_media_color_selection = array(
	'dark' => esc_html__( 'Dark', 'blade' ),
	'light' => esc_html__( 'Light', 'blade' ),
	'primary-1' => esc_html__( 'Primary 1', 'blade' ),
	'primary-2' => esc_html__( 'Primary 2', 'blade' ),
	'primary-3' => esc_html__( 'Primary 3', 'blade' ),
	'primary-4' => esc_html__( 'Primary 4', 'blade' ),
	'primary-5' => esc_html__( 'Primary 5', 'blade' ),
);

$blade_grve_media_color_extra_selection = array(
	'dark' => esc_html__( 'Dark', 'blade' ),
	'light' => esc_html__( 'Light', 'blade' ),
	'primary-1' => esc_html__( 'Primary 1', 'blade' ),
	'primary-2' => esc_html__( 'Primary 2', 'blade' ),
	'primary-3' => esc_html__( 'Primary 3', 'blade' ),
	'primary-4' => esc_html__( 'Primary 4', 'blade' ),
	'primary-5' => esc_html__( 'Primary 5', 'blade' ),
	'custom' => esc_html__( 'Custom', 'blade' ),
);

$blade_grve_media_opacity_selection = array(
	'0'    => '0%',
	'0.05' => '5%',
	'0.10' => '10%',
	'0.15' => '15%',
	'0.20' => '20%',
	'0.25' => '25%',
	'0.30' => '30%',
	'0.35' => '35%',
	'0.40' => '40%',
	'0.45' => '45%',
	'0.50' => '50%',
	'0.55' => '55%',
	'0.60' => '60%',
	'0.65' => '65%',
	'0.70' => '70%',
	'0.75' => '75%',
	'0.80' => '80%',
	'0.85' => '85%',
	'0.90' => '90%',
	'0.95' => '95%',
	'1'    => '100%',
);

$blade_grve_media_header_style_selection = array(
	'default' => esc_html__( 'Default', 'blade' ),
	'dark' => esc_html__( 'Dark', 'blade' ),
	'light' => esc_html__( 'Light', 'blade' ),
);

$blade_grve_media_color_overlay_selection = array(
	'' => esc_html__( 'None', 'blade' ),
	'dark' => esc_html__( 'Dark', 'blade' ),
	'light' => esc_html__( 'Light', 'blade' ),
	'primary-1' => esc_html__( 'Primary 1', 'blade' ),
	'primary-2' => esc_html__( 'Primary 2', 'blade' ),
	'primary-3' => esc_html__( 'Primary 3', 'blade' ),
	'primary-4' => esc_html__( 'Primary 4', 'blade' ),
	'primary-5' => esc_html__( 'Primary 5', 'blade' ),
);


$blade_grve_media_style_selection = array(
	'default' => esc_html__( 'Default', 'blade' ),
	'1' => esc_html__( 'Style 1', 'blade' ),
	'2' => esc_html__( 'Style 2', 'blade' ),
	'3' => esc_html__( 'Style 3', 'blade' ),
	'4' => esc_html__( 'Style 4', 'blade' ),
);

$blade_grve_media_pattern_overlay_selection = array(
	'' => esc_html__( 'No', 'blade' ),
	'default' => esc_html__( 'Yes', 'blade' ),
);

$blade_grve_media_text_animation_selection = array(
	'fade-in' => esc_html__( 'Default', 'blade' ),
	'fade-in-up' => esc_html__( 'Fade In Up', 'blade' ),
	'fade-in-down' => esc_html__( 'Fade In Down', 'blade' ),
	'fade-in-left' => esc_html__( 'Fade In Left', 'blade' ),
	'fade-in-right' => esc_html__( 'Fade In Right', 'blade' ),
	'zoom-in' => esc_html__( 'Zoom In', 'blade' ),
	'zoom-out' => esc_html__( 'Zoom Out', 'blade' ),
);

$blade_grve_button_target_selection = array(
	'_self' => esc_html__( 'Same Page', 'blade' ),
	'_blank' => esc_html__( 'New page', 'blade' ),
);

$blade_grve_media_bg_position_selection = array(
	'left-top' => esc_html__( 'Left Top', 'blade' ),
	'left-center' => esc_html__( 'Left Center', 'blade' ),
	'left-bottom' => esc_html__( 'Left Bottom', 'blade' ),
	'center-top' => esc_html__( 'Center Top', 'blade' ),
	'center-center' => esc_html__( 'Center Center', 'blade' ),
	'center-bottom' => esc_html__( 'Center Bottom', 'blade' ),
	'right-top' => esc_html__( 'Right Top', 'blade' ),
	'right-center' => esc_html__( 'Right Center', 'blade' ),
	'right-bottom' => esc_html__( 'Right Bottom', 'blade' ),
);

$blade_grve_media_bg_effect_selection = array(
	'none' => esc_html__( 'None', 'blade' ),
	'zoom' => esc_html__( 'Zoom', 'blade' ),
);

$blade_grve_media_tag_selection = array(
	'div' => esc_html__( 'div', 'blade' ),
	'h1' => esc_html__( 'h1', 'blade' ),
	'h2' => esc_html__( 'h2', 'blade' ),
	'h3' => esc_html__( 'h3', 'blade' ),
	'h4' => esc_html__( 'h4', 'blade' ),
	'h5' => esc_html__( 'h5', 'blade' ),
	'h6' => esc_html__( 'h6', 'blade' ),
);




/**
 * Print Media Selector Functions
 */
function blade_grve_print_select_options( $selector_array, $current_value = "" ) {

	foreach ( $selector_array as $value=>$display_value ) {
	?>
		<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_value, $value ); ?>><?php echo esc_html( $display_value ); ?></option>
	<?php
	}

}

function blade_grve_print_media_tag_selection( $current_value = "" ) {
	global $blade_grve_media_tag_selection;
	blade_grve_print_select_options( $blade_grve_media_tag_selection, $current_value );
}

function blade_grve_print_media_boolean_selection( $current_value = "" ) {
	global $blade_grve_media_boolean_selection;
	blade_grve_print_select_options( $blade_grve_media_boolean_selection, $current_value );
}
function blade_grve_print_media_button_color_selection( $current_value = "" ) {
	global $blade_grve_button_color_selection;
	blade_grve_print_select_options( $blade_grve_button_color_selection, $current_value );
}
function blade_grve_print_media_button_size_selection( $current_value = "" ) {
	global $blade_grve_button_size_selection;
	blade_grve_print_select_options( $blade_grve_button_size_selection, $current_value );
}
function blade_grve_print_media_button_shape_selection( $current_value = "" ) {
	global $blade_grve_button_shape_selection;
	blade_grve_print_select_options( $blade_grve_button_shape_selection, $current_value );
}
function blade_grve_print_media_button_type_selection( $current_value = "" ) {
	global $blade_grve_button_type_selection;
	blade_grve_print_select_options( $blade_grve_button_type_selection, $current_value );
}
function blade_grve_print_media_button_target_selection( $current_value = "" ) {
	global $blade_grve_button_target_selection;
	blade_grve_print_select_options( $blade_grve_button_target_selection, $current_value );
}

function blade_grve_print_media_style_selection( $current_value = "" ) {
	global $blade_grve_media_style_selection;
	blade_grve_print_select_options( $blade_grve_media_style_selection, $current_value );
}
function blade_grve_print_media_color_selection( $current_value = "" ) {
	global $blade_grve_media_color_selection;
	blade_grve_print_select_options( $blade_grve_media_color_selection, $current_value );
}

function blade_grve_print_media_color_extra_selection( $current_value = "" ) {
	global $blade_grve_media_color_extra_selection;
	blade_grve_print_select_options( $blade_grve_media_color_extra_selection, $current_value );
}

function blade_grve_print_media_opacity_selection( $current_value = "" ) {
	global $blade_grve_media_opacity_selection;
	blade_grve_print_select_options( $blade_grve_media_opacity_selection, $current_value );
}

function blade_grve_print_media_align_selection( $current_value = "" ) {
	global $blade_grve_media_align_selection;
	blade_grve_print_select_options( $blade_grve_media_align_selection, $current_value );
}
function blade_grve_print_media_header_style_selection( $current_value = "" ) {
	global $blade_grve_media_header_style_selection;
	blade_grve_print_select_options( $blade_grve_media_header_style_selection, $current_value );
}

function blade_grve_print_media_color_overlay_selection( $current_value = "" ) {
	global $blade_grve_media_color_overlay_selection;
	blade_grve_print_select_options( $blade_grve_media_color_overlay_selection, $current_value );
}
function blade_grve_print_media_pattern_overlay_selection( $current_value = "" ) {
	global $blade_grve_media_pattern_overlay_selection;
	blade_grve_print_select_options( $blade_grve_media_pattern_overlay_selection, $current_value );
}

function blade_grve_print_media_text_animation_selection( $current_value = "" ) {
	global $blade_grve_media_text_animation_selection;
	blade_grve_print_select_options( $blade_grve_media_text_animation_selection, $current_value );
}

function blade_grve_print_media_bg_position_selection( $current_value = "center-center" ) {
	global $blade_grve_media_bg_position_selection;
	blade_grve_print_select_options( $blade_grve_media_bg_position_selection, $current_value );
}

function blade_grve_print_media_bg_effect_selection( $current_value = "" ) {
	global $blade_grve_media_bg_effect_selection;
	blade_grve_print_select_options( $blade_grve_media_bg_effect_selection, $current_value );
}



/**
 * Prints Media Slider items
 */
function blade_grve_print_admin_media_slider_items( $slider_items ) {

	foreach ( $slider_items as $slider_item ) {
		blade_grve_print_admin_media_slider_item( $slider_item, '' );
	}

}

/**
 * Get Single Slider Media with ajax
 */
function blade_grve_get_slider_media() {

	if( isset( $_POST['attachment_ids'] ) ) {

		$attachment_ids = $_POST['attachment_ids'];

		if( !empty( $attachment_ids ) ) {

			$media_ids = explode(",", $attachment_ids);

			foreach ( $media_ids as $media_id ) {
				$slider_item = array (
					'id' => $media_id,
				);
				blade_grve_print_admin_media_slider_item( $slider_item, "new" );
			}
		}
	}
	if( isset( $_POST['attachment_ids'] ) ) { die(); }
}
add_action( 'wp_ajax_blade_grve_get_slider_media', 'blade_grve_get_slider_media' );


/**
 * Prints Single Slider Media  Item
 */
function blade_grve_print_admin_media_slider_item( $slider_item, $new = "" ) {
	$media_id = $slider_item['id'];

	$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
	$thumbnail_url = $thumb_src[0];
	$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );

	$grve_button_class = "grve-slider-item-delete-button";

	if( $new = "new" ) {
		$grve_button_class = "grve-slider-item-delete-button grve-item-new";
	}

?>
	<div class="grve-slider-item-minimal">
		<input class="<?php echo esc_attr( $grve_button_class ); ?> button" type="button" value="<?php esc_attr_e( 'Delete', 'blade' ); ?>">
		<h3 class="hndle grve-title">
			<span><?php esc_html_e( 'Image', 'blade' ); ?></span>
		</h3>
		<div class="inside">
			<input type="hidden" value="<?php echo esc_attr( $media_id ); ?>" name="grve_media_slider_item_id[]">
			<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" attid="' . esc_attr( $media_id ) . '" alt="' . esc_attr( $alt ) . '" width="120" height="120"/>'; ?>
		</div>
	</div>
<?php

}

/**
 * Prints Admin Option Selector
 */
function blade_grve_print_admin_option_wrapper_start( $item ) {

	$data_dependency = $item_highlight = $item_width = '';

	$item_type = blade_grve_array_value( $item, 'type' );
	$item_label = blade_grve_array_value( $item, 'label' );
	$item_required = blade_grve_array_value( $item, 'required' );
	$item_dependency = blade_grve_array_value( $item, 'dependency' );
	$item_multiple = blade_grve_array_value( $item, 'multiple' );
	$item_highlight = blade_grve_array_value( $item, 'highlight', 'standard' );
	$item_width = blade_grve_array_value( $item, 'width', 'normal' );
	$item_wrap_class = blade_grve_array_value( $item, 'wrap_class' );

	$wrapper_attributes = array();
	if( !empty( $item_dependency ) ) {
		$wrapper_attributes[] = "data-dependency='" . esc_attr( $item_dependency ) . "'";
	}

	$label_class = 'grve-label';
	if ( 'label' == $item_type ) {
		$label_class = 'grve-label grve-header-label';
	}

	$item_title = $item_desc = $item_info = '';

	if ( is_array ( $item_label ) ) {
		$item_title = blade_grve_array_value( $item_label, 'title' );
		$item_desc = blade_grve_array_value( $item_label, 'desc' );
		$item_info = blade_grve_array_value( $item_label, 'info' );
	} else {
		$item_title = $item_label;
	}

	//Classes
	$option_wrapper_classes = array( 'grve-fields-wrapper' );
	$option_wrapper_classes[] = 'grve-' . $item_highlight;
	if ( !empty ( $item_wrap_class ) ) {
		$option_wrapper_classes[] = $item_wrap_class;
	}
	$option_wrapper_class_string = implode( ' ', $option_wrapper_classes );

	$wrapper_attributes[] = 'class="' . esc_attr( $option_wrapper_class_string ) . '"';

?>
	<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
		<div class="<?php echo esc_attr( $label_class ); ?>">
			<label>
				<span class="grve-title"><?php echo esc_html( $item_title ); ?></span>
				<span class="grve-description"><?php echo esc_html( $item_desc ); ?></span>
				<span class="grve-info"><?php echo esc_html( $item_info ); ?></span>
			</label>
		</div>
		<div class="grve-field-items-wrapper">
			<?php if ( '' == $item_multiple ) { ?>
			<div class="grve-field-item grve-field-item-<?php echo esc_attr( $item_width ); ?>">
			<?php } ?>

<?php
}

function blade_grve_print_admin_option_wrapper_end( $multiple = '' ) {
?>
			<?php if ( '' == $multiple ) { ?>
			</div>
			<?php } ?>
		</div>
	</div>

<?php
}

/**
 * Prints Admin Feature Setting
 */
function blade_grve_print_admin_option( $item ) {

	$item_type = blade_grve_array_value( $item, 'type' );
	$item_options = blade_grve_array_value( $item, 'options' );
	$item_label = blade_grve_array_value( $item, 'label' );
	$item_id = blade_grve_array_value( $item, 'id' );
	$item_group_id = blade_grve_array_value( $item, 'group_id' );
	$item_name = blade_grve_array_value( $item, 'name' );
	$item_default_value = blade_grve_array_value( $item, 'default_value' );
	$item_value = blade_grve_array_value( $item, 'value', $item_default_value );
	$item2_default_value = blade_grve_array_value( $item, 'default_value2' );
	$item2_value = blade_grve_array_value( $item, 'value2', $item2_default_value );	
	$item_required = blade_grve_array_value( $item, 'required' );
	$item_dependency = blade_grve_array_value( $item, 'dependency' );
	$item_multiple = blade_grve_array_value( $item, 'multiple' );
	$item_type_usage = blade_grve_array_value( $item, 'type_usage' );
	$item_class = blade_grve_array_value( $item, 'extra_class' );

	$item_attributes = array();

	$dependency_field = $item_id_attr = '';
	if( !empty( $item_group_id ) ) {
		$item_attributes[] = 'class="grve-dependency-field ' . esc_attr( $item_class ) . '"';
		$item_attributes[] = 'data-group="' . esc_attr( $item_group_id ) . '"';
	} else {
		$item_attributes[] = 'class="' . esc_attr( $item_class ) . '"';
	}

	if( !empty( $item_id ) ) {
		$item_attributes[] = 'id="' . esc_attr( $item_id ) . '"';
	}

	if ( 'hidden' == $item_type ) {
?>
	<input type="hidden" name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>" <?php echo implode( ' ', $item_attributes ); ?>/>
<?php
		return;
	}

	blade_grve_print_admin_option_wrapper_start( $item );
?>

	<?php if ( 'textfield' == $item_type ) { ?>

		<input type="text" name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>" <?php echo implode( ' ', $item_attributes ); ?>/>

	<?php } elseif ( 'textarea' == $item_type ) { ?>

		<textarea name="<?php echo esc_attr( $item_name ); ?>" cols="40" rows="5" <?php echo implode( ' ', $item_attributes ); ?>><?php echo wp_kses_post( $item_value ); ?></textarea>

	<?php } elseif ( 'select' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_select_options( $item_options, $item_value ); ?>
		</select>

	<?php } elseif ( 'checkbox' == $item_type ) { ?>

		<input type="checkbox" name="<?php echo esc_attr( $item_name ); ?>" value="yes" <?php checked( $item_value, 'yes' ); ?> <?php echo implode( ' ', $item_attributes ); ?>/>

	<?php } elseif ( 'select-boolean' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_boolean_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-tag' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_tag_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-colorpicker' == $item_type ) { ?>

		<div class="grve-field-item">
			<select class="grve-select-color-extra" name="<?php echo esc_attr( $item_name ); ?>">
			<?php
				if ( 'sidebar-inpage' == $item_type_usage ) {
					blade_grve_print_select_options(
						array(
							'' => esc_html__( '-- Inherit --', 'blade' ),
							'none' => esc_html__( 'None', 'blade' ),
						),
						$item_value
					);
				}
				blade_grve_print_media_color_extra_selection( $item_value );
			?>
			</select>
		</div>
		<div class="grve-field-item">
			<div class="grve-wp-colorpicker">
				<?php
					if ( strpos( $item_name,'color_overlay') !== false) {
						$custom_name = str_replace ( 'color_overlay' , 'color_overlay_custom', $item_name );
					} else {
						$custom_name = str_replace ( 'color' , 'color_custom', $item_name );
					}
				?>
				<input type="text" name="<?php echo esc_attr( $custom_name ); ?>" class="wp-color-picker-field" value="<?php echo esc_attr( $item2_value ); ?>" data-default-color="#000000"/>
			</div>
		</div>

	<?php } elseif ( 'select-image' == $item_type ) { ?>

		<?php

			$thumb_src = wp_get_attachment_image_src( $item_value, 'thumbnail' );
			$thumbnail_url = $thumb_src[0];
			$visibility_class = '';
			if ( empty( $thumbnail_url ) ) {
				$thumbnail_url = get_template_directory_uri() . '/includes/images/no-image.jpg';
				$alt = '';
			} else {
				$alt = get_post_meta( $item_value, '_wp_attachment_image_alt', true );
				$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';
				$visibility_class = 'grve-visible';
			}
		?>

			<div class="grve-thumb-container <?php echo esc_attr( $visibility_class ); ?>" data-mode="custom-image" data-field-name="<?php echo esc_attr( $item_name ); ?>" >
				<input class="grve-upload-media-id" type="hidden" value="<?php echo esc_attr( $item_value ); ?>" name="<?php echo esc_attr( $item_name ); ?>">
				<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" attid="' . $item_value . '" alt="' . $alt . '" width="120" height="120"/>'; ?>
				<a class="grve-upload-remove-image" href="#"></a>
			</div>
			<div class="grve-upload-replace-image"></div>


	<?php } elseif ( 'colorpicker' == $item_type ) { ?>

		<input type="text" name="<?php echo esc_attr( $item_name ); ?>" class="wp-color-picker-field" value="<?php echo esc_attr( $item_value ); ?>" data-default-color="#ffffff" <?php echo implode( ' ', $item_attributes ); ?>/>

		<?php } elseif ( 'select-color' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_color_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-color-extra' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_color_extra_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-opacity' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_opacity_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-style' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_style_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-header-style' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_header_style_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-align' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_align_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-text-animation' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_text_animation_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-target' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_target_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-type' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_type_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-color' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_color_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-size' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_size_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-button-shape' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_button_shape_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-pattern-overlay' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_pattern_overlay_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-color-overlay' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_color_overlay_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-bg-image' == $item_type ) { ?>

		<input type="text" class="grve-upload-simple-media-field"  name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>"/>
		<label></label>
		<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary" value="<?php esc_attr_e( 'Upload Image', 'blade' ); ?>"/>
		<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>

	<?php } elseif ( 'select-bg-position' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_bg_position_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-bg-position-inherit' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<option value="" <?php selected( "", $item_value ); ?>><?php esc_html_e( 'Inherit from above', 'blade' ); ?></option>
			<?php blade_grve_print_media_bg_position_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-bg-effect' == $item_type ) { ?>

		<select name="<?php echo esc_attr( $item_name ); ?>" <?php echo implode( ' ', $item_attributes ); ?>>
			<?php blade_grve_print_media_bg_effect_selection( $item_value ); ?>
		</select>

	<?php } elseif ( 'select-bg-video' == $item_type ) { ?>

		<input type="text" class="grve-upload-simple-media-field grve-meta-text" name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>"/>
		<label></label>
		<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
		<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>

	<?php } ?>

<?php
	blade_grve_print_admin_option_wrapper_end( $item_multiple );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
