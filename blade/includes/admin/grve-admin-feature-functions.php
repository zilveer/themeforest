<?php
/*
*	Collection of functions for admin feature section
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Get Feature Single Image with ajax
 */
function blade_grve_get_image_media() {


	if( isset( $_POST['attachment_id'] ) ) {

		$media_id  = $_POST['attachment_id'];

		if( !empty( $media_id  ) ) {

			$image_item = array (
				'bg_image_id' => $media_id,
			);

			blade_grve_print_admin_feature_image_item( $image_item, "new" );

		}
	}

	if( isset( $_POST['attachment_id'] ) ) { die(); }
}
add_action( 'wp_ajax_blade_grve_get_image_media', 'blade_grve_get_image_media' );

/**
 * Get Replaced Image with ajax
 */
function blade_grve_get_replaced_image() {


	if( isset( $_POST['attachment_id'] ) ) {

		if ( isset( $_POST['attachment_mode'] ) && !empty( $_POST['attachment_mode'] ) ) {
			$mode = $_POST['attachment_mode'];
			switch( $mode ) {
				case 'image':
					$input_name = 'grve_single_item_bg_image_id';
				break;
				case 'custom-image':
					if ( isset( $_POST['field_name'] ) && !empty( $_POST['field_name'] ) ) {
						$input_name = $_POST['field_name'];
					}
				break;
				case 'full-slider':
				default:
					$input_name = 'grve_slider_item_bg_image_id[]';
				break;
			}
		} else {
			$input_name = 'grve_slider_item_bg_image_id[]';
		}

		$media_id  = $_POST['attachment_id'];
		$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
		$thumbnail_url = $thumb_src[0];
		$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
?>
		<input type="hidden" class="grve-upload-media-id" value="<?php echo esc_attr( $media_id ); ?>" name="<?php echo esc_attr( $input_name ); ?>">
		<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" attid="' . esc_attr( $media_id ) . '" alt="' . esc_attr( $alt ) . '" width="120" height="120"/>'; ?>
		<a class="grve-upload-remove-image grve-item-new" href="#"></a>
<?php

	}

	if( isset( $_POST['attachment_id'] ) ) { die(); }
}
add_action( 'wp_ajax_blade_grve_get_replaced_image', 'blade_grve_get_replaced_image' );

/**
 * Get Single Feature Slider Media with ajax
 */
function blade_grve_get_admin_feature_slider_media() {


	if( isset( $_POST['attachment_ids'] ) ) {

		$attachment_ids = $_POST['attachment_ids'];

		if( !empty( $attachment_ids ) ) {

			$media_ids = explode(",", $attachment_ids);

			foreach ( $media_ids as $media_id ) {
				$slider_item = array (
					'bg_image_id' => $media_id,
				);

				blade_grve_print_admin_feature_slider_item( $slider_item, "new" );
			}
		}
	}

	if( isset( $_POST['attachment_ids'] ) ) { die(); }
}
add_action( 'wp_ajax_blade_grve_get_admin_feature_slider_media', 'blade_grve_get_admin_feature_slider_media' );

/**
 * Get Single Feature Map Point with ajax
 */
function blade_grve_get_map_point() {
	if( isset( $_POST['map_mode'] ) ) {
		$mode = $_POST['map_mode'];
		blade_grve_print_admin_feature_map_point( array(), $mode );
	}
	if( isset( $_POST['map_mode'] ) ) { die(); }
}
add_action( 'wp_ajax_blade_grve_get_map_point', 'blade_grve_get_map_point' );

/**
 * Prints Feature Map Points
 */
function blade_grve_print_admin_feature_map_items( $map_items ) {

	if( !empty($map_items) ) {
		foreach ( $map_items as $map_item ) {
			blade_grve_print_admin_feature_map_point( $map_item );
		}
	}

}

/**
 * Prints Feature Single Map Point
 */
function blade_grve_print_admin_feature_map_point( $map_item, $mode = '' ) {


	$map_item_id = uniqid('grve_map_point_');
	$map_uniqid = uniqid('-');
	$map_id = blade_grve_array_value( $map_item, 'id', $map_item_id );

	$map_lat = blade_grve_array_value( $map_item, 'lat', '51.516221' );
	$map_lng = blade_grve_array_value( $map_item, 'lng', '-0.136986' );
	$map_marker = blade_grve_array_value( $map_item, 'marker' );

	$map_title = blade_grve_array_value( $map_item, 'title' );
	$map_infotext = blade_grve_array_value( $map_item, 'info_text','' );
	$map_infotext_open = blade_grve_array_value( $map_item, 'info_text_open','no' );

	$button_text = blade_grve_array_value( $map_item, 'button_text' );
	$button_url = blade_grve_array_value( $map_item, 'button_url' );
	$button_target = blade_grve_array_value( $map_item, 'button_target', '_self' );
	$button_class = blade_grve_array_value( $map_item, 'button_class' );
	$grve_closed_class = 'closed';
	$grve_item_new = '';
	if( "new" == $mode ) {
		$grve_item_new = " grve-item-new";
		$grve_closed_class = "grve-item-new";
	}
?>
	<div class="grve-map-item postbox <?php echo esc_attr( $grve_closed_class ); ?>">
		<button class="handlediv button-link" type="button">
			<span class="screen-reader-text"><?php esc_attr_e( 'Toggle panel: Feature Section Map Point', 'blade' ); ?></span>
			<span class="toggle-indicator"></span>
		</button>
		<input class="grve-map-item-delete-button button<?php echo esc_attr( $grve_item_new ); ?>" type="button" value="<?php esc_attr_e( 'Delete', 'blade' ); ?>" />
		<span class="grve-button-spacer">&nbsp;</span>
		<span class="grve-modal-spinner"></span>
		<h3 class="grve-title">
			<span><?php esc_html_e( 'Map Point', 'blade' ); ?>: </span><span id="<?php echo esc_attr( $map_id ); ?>_title_admin_label"><?php if ( !empty ($map_title) ) { echo esc_html( $map_title ); } ?></span>
		</h3>
		<div class="inside">

			<!-- GRVE METABOXES -->
			<div class="grve-metabox-content">

				<!-- TABS -->
				<div class="grve-tabs<?php echo esc_attr( $grve_item_new ); ?>">

					<ul class="grve-tab-links">
						<li class="active"><a href="#grve-feature-single-map-tab-marker<?php echo esc_attr( $map_uniqid ); ?>"><?php esc_html_e( 'Marker', 'blade' ); ?></a></li>
						<li><a href="#grve-feature-single-map-tab-infobox<?php echo esc_attr( $map_uniqid ); ?>"><?php esc_html_e( 'Info Box', 'blade' ); ?></a></li>
						<li><a href="#grve-feature-single-map-tab-button<?php echo esc_attr( $map_uniqid ); ?>"><?php esc_html_e( 'Link', 'blade' ); ?></a></li>
					</ul>

					<div class="grve-tab-content">

						<div id="grve-feature-single-map-tab-marker<?php echo esc_attr( $map_uniqid ); ?>" class="grve-tab-item active">
							<input type="hidden" name="grve_map_item_point_id[]" value="<?php echo esc_attr( $map_id ); ?>"/>
							<div class="grve-fields-wrapper">
								<div class="grve-label">
									<label for="grve-page-feature-element">
										<span class="grve-title"><?php esc_html_e( 'Marker', 'blade' ); ?></span>
									</label>
								</div>
								<div class="grve-field-items-wrapper">
									<div class="grve-field-item grve-field-item-fullwidth">
										<input type="text" name="grve_map_item_point_marker[]" class="grve-upload-simple-media-field" value="<?php echo esc_attr( $map_marker ); ?>"/>
										<label></label>
										<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary<?php echo esc_attr( $grve_item_new ); ?>" value="<?php esc_attr_e( 'Insert Marker', 'blade' ); ?>"/>
										<input type="button" class="grve-remove-simple-media-button button<?php echo esc_attr( $grve_item_new ); ?>" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
									</div>
								</div>
							</div>
							<?php
								blade_grve_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => 'grve_map_item_point_lat[]',
										'value' => $map_lat,
										'label' => array(
											"title" => esc_html__( 'Latitude', 'blade' ),
										),
									)
								);
								blade_grve_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => 'grve_map_item_point_lng[]',
										'value' => $map_lng,
										'label' => array(
											"title" => esc_html__( 'Longitude', 'blade' ),
										),
									)
								);
							?>

						</div>
						<div id="grve-feature-single-map-tab-infobox<?php echo esc_attr( $map_uniqid ); ?>" class="grve-tab-item">
							<?php
								blade_grve_print_admin_option(
									array(
										'type' => 'label',
										'label' => array(
											"title" => esc_html__( 'Title / Info Text', 'blade' ),
										),
									)
								);
								blade_grve_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => 'grve_map_item_point_title[]',
										'value' => $map_title,
										'label' => array(
											"title" => esc_html__( 'Title', 'blade' ),
										),
										'id' => $map_id . '_title',
										'extra_class' => 'grve-admin-label-update',
									)
								);
								blade_grve_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => 'grve_map_item_point_infotext[]',
										'value' => $map_infotext,
										'label' => array(
											"title" => esc_html__( 'Info Text', 'blade' ),
										),
									)
								);
								blade_grve_print_admin_option(
									array(
										'type' => 'select-boolean',
										'name' => 'grve_map_item_point_infotext_open[]',
										'value' => $map_infotext_open,
										'label' => esc_html__( 'Open Info Text Onload', 'blade' ),
									)
								);
							?>
						</div>
						<div id="grve-feature-single-map-tab-button<?php echo esc_attr( $map_uniqid ); ?>" class="grve-tab-item">
							<?php
								blade_grve_print_admin_option(
									array(
										'type' => 'label',
										'label' => array(
											"title" => esc_html__( 'Link', 'blade' ),
										),
									)
								);
								blade_grve_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => 'grve_map_item_point_button_text[]',
										'value' => $button_text,
										'label' => array(
											"title" => esc_html__( 'Link Text', 'blade' ),
										),
									)
								);
								blade_grve_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => 'grve_map_item_point_button_url[]',
										'value' => $button_url,
										'label' => array(
											"title" => esc_html__( 'Link URL', 'blade' ),
										),
										'width' => 'fullwidth',
									)
								);

								blade_grve_print_admin_option(
									array(
										'type' => 'select-button-target',
										'name' => 'grve_map_item_point_button_target[]',
										'value' => $button_target,
										'label' => array(
											"title" => esc_html__( 'Link Target', 'blade' ),
										),
									)
								);

								blade_grve_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => 'grve_map_item_point_button_class[]',
										'value' => $button_class,
										'label' => array(
											"title" => esc_html__( 'Link Class', 'blade' ),
										),
									)
								);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}

/**
 * Prints Section Slider items
 */
function blade_grve_print_admin_feature_slider_items( $slider_items ) {

	foreach ( $slider_items as $slider_item ) {
		blade_grve_print_admin_feature_slider_item( $slider_item, '' );
	}

}

/**
* Prints Single Feature Slider Item
*/
function blade_grve_print_admin_feature_slider_item( $slider_item, $new = "" ) {

	$slide_id = blade_grve_array_value( $slider_item, 'id', uniqid() );
	$slider_item['id'] = $slide_id;

	$bg_image_id = blade_grve_array_value( $slider_item, 'bg_image_id' );
	$bg_position = blade_grve_array_value( $slider_item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = blade_grve_array_value( $slider_item, 'bg_tablet_sm_position' );


	$header_style = blade_grve_array_value( $slider_item, 'header_style', 'default' );
	$title = blade_grve_array_value( $slider_item, 'title' );

	$slider_item_button = blade_grve_array_value( $slider_item, 'button' );
	$slider_item_button2 = blade_grve_array_value( $slider_item, 'button2' );

	$grve_button_class = "grve-feature-slider-item-delete-button";
	$grve_replace_image_class = "grve-upload-replace-image";
	$grve_open_modal_class = "grve-open-slider-modal";
	$grve_closed_class = 'closed';
	$grve_new_class = '';

	if( "new" == $new ) {
		$grve_button_class = "grve-feature-slider-item-delete-button grve-item-new";
		$grve_replace_image_class = "grve-upload-replace-image grve-item-new";
		$grve_open_modal_class = "grve-open-slider-modal grve-item-new";
		$grve_closed_class = 'grve-item-new';
		$grve_new_class = ' grve-item-new';
	}

	$slide_uniqid = '-' . $slide_id;

?>

	<div class="grve-slider-item postbox <?php echo esc_attr( $grve_closed_class ); ?>">
		<button class="handlediv button-link" type="button">
			<span class="screen-reader-text"><?php esc_attr_e( 'Toggle panel: Feature Section Slide', 'blade' ); ?></span>
			<span class="toggle-indicator"></span>
		</button>
		<input class="<?php echo esc_attr( $grve_button_class ); ?> button" type="button" value="<?php esc_attr_e( 'Delete', 'blade' ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<span class="grve-modal-spinner"></span>
		<h3 class="hndle grve-title">
			<span><?php esc_html_e( 'Slide', 'blade' ); ?>: </span><span id="grve_slider_item_title<?php echo esc_attr( $slide_id ); ?>_admin_label"><?php if ( !empty ($title) ) { echo esc_html( $title ); } ?></span>
		</h3>
		<div class="inside">
			<!-- GRVE METABOXES -->
			<div class="grve-metabox-content">

				<!-- TABS -->
				<div class="grve-tabs<?php echo esc_attr( $grve_new_class ); ?>">

					<ul class="grve-tab-links">
						<li class="active"><a href="#grve-feature-single-tab-bg<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'Background / Header', 'blade' ); ?></a></li>
						<li><a href="#grve-feature-single-tab-content<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'Content', 'blade' ); ?></a></li>
						<li><a href="#grve-feature-single-tab-button<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'First Button', 'blade' ); ?></a></li>
						<li><a href="#grve-feature-single-tab-button2<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'Second Button', 'blade' ); ?></a></li>
						<li><a href="#grve-feature-single-tab-extra<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'Extra', 'blade' ); ?></a></li>
					</ul>

					<div class="grve-tab-content">

						<div id="grve-feature-single-tab-bg<?php echo esc_attr( $slide_uniqid ); ?>" class="grve-tab-item active">
							<?php

								blade_grve_print_admin_option(
									array(
										'type' => 'hidden',
										'name' => 'grve_slider_item_id[]',
										'value' => $slide_id,
									)
								);

								blade_grve_print_admin_option(
									array(
										'type' => 'select-image',
										'name' => 'grve_slider_item_bg_image_id[]',
										'value' => $bg_image_id,
										'label' => array(
											"title" => esc_html__( 'Background Image', 'blade' ),
										),
										'width' => 'fullwidth',
									)
								);

								blade_grve_print_admin_option(
									array(
										'type' => 'label',
										'label' => array(
											"title" => esc_html__( 'Header / Background Position', 'blade' ),
										),
									)
								);

								blade_grve_print_admin_option(
									array(
										'type' => 'select-bg-position',
										'name' => 'grve_slider_item_bg_position[]',
										'value' => $bg_position,
										'label' => array(
											"title" => esc_html__( 'Background Position', 'blade' ),
										),
									)
								);
								blade_grve_print_admin_option(
									array(
										'type' => 'select-bg-position-inherit',
										'name' => 'grve_slider_item_bg_tablet_sm_position[]',
										'value' => $bg_tablet_sm_position,
										'label' => array(
											"title" => esc_html__( 'Background Position ( Tablet Portrait )', 'blade' ),
											"desc" => esc_html__( 'Tablet devices with portrait orientation and below.', 'blade' ),
										),
									)
								);
								blade_grve_print_admin_option(
									array(
										'type' => 'select-header-style',
										'name' => 'grve_slider_item_header_style[]',
										'value' => $header_style,
										'label' => array(
											"title" => esc_html__( 'Header Style', 'blade' ),
										),
									)
								);

								blade_grve_print_admin_feature_item_overlay_options( $slider_item, 'grve_slider_item_', 'multi' );
							?>
						</div>
						<div id="grve-feature-single-tab-content<?php echo esc_attr( $slide_uniqid ); ?>" class="grve-tab-item">
							<?php blade_grve_print_admin_feature_item_content_options( $slider_item, 'grve_slider_item_', 'multi' ); ?>
						</div>
						<div id="grve-feature-single-tab-button<?php echo esc_attr( $slide_uniqid ); ?>" class="grve-tab-item">
							<?php blade_grve_print_admin_feature_item_button_options( $slider_item_button, 'grve_slider_item_button_', 'multi' ); ?>
						</div>
						<div id="grve-feature-single-tab-button2<?php echo esc_attr( $slide_uniqid ); ?>" class="grve-tab-item">
							<?php blade_grve_print_admin_feature_item_button_options( $slider_item_button2, 'grve_slider_item_button2_', 'multi' ); ?>
						</div>
						<div id="grve-feature-single-tab-extra<?php echo esc_attr( $slide_uniqid ); ?>" class="grve-tab-item">
							<?php blade_grve_print_admin_feature_item_extra_options( $slider_item, 'grve_slider_item_', 'multi' ); ?>
						</div>
					</div>

				</div>
				<!-- END TABS -->

			</div>
			<!-- END GRVE METABOXES -->
		</div>

	</div>
<?php

}

/**
* Get Revolution Sliders
*/
function blade_grve_get_revolution_selection() {

	$revsliders = array(
		"" => esc_html__( "None", 'blade' ),
	);

	if ( class_exists( 'RevSlider' ) ) {
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();

		if ( $arrSliders ) {
			foreach ( $arrSliders as $slider ) {
				$revsliders[ $slider->getAlias() ] = $slider->getTitle();
			}
		}
	}

	return $revsliders;
}

/**
* Prints Item Button Options
*/
function blade_grve_print_admin_feature_item_button_options( $item, $prefix = 'grve_single_item_button_', $mode = '' ) {


	$button_id = blade_grve_array_value( $item, 'id', uniqid() );
	$group_id = $prefix . $button_id;

	$button_text = blade_grve_array_value( $item, 'text' );
	$button_url = blade_grve_array_value( $item, 'url' );
	$button_type = blade_grve_array_value( $item, 'type', '' );
	$button_size = blade_grve_array_value( $item, 'size', 'medium' );
	$button_color = blade_grve_array_value( $item, 'color', 'primary-1' );
	$button_hover_color = blade_grve_array_value( $item, 'hover_color', 'black' );
	$button_shape = blade_grve_array_value( $item, 'shape', 'square' );
	$button_target = blade_grve_array_value( $item, 'target', '_self' );
	$button_class = blade_grve_array_value( $item, 'class' );

	$sufix  = '';
	if ( 'multi' == $mode ) {
		$sufix = '[]';
	};
	echo '<div id="' . esc_attr( $group_id ) . '">';


	blade_grve_print_admin_option(
		array(
			'type' => 'hidden',
			'name' => $prefix . 'id' . $sufix,
			'value' => $button_id,
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'text' . $sufix,
			'id' => $prefix . 'text' . '_' . $button_id,
			'value' => $button_text,
			'label' => esc_html__( 'Button Text', 'blade' ),
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'url' . $sufix,
			'id' => $prefix . 'url' . '_' . $button_id,
			'value' => $button_url,
			'label' => esc_html__( 'Button URL', 'blade' ),
			'width' => 'fullwidth',
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select-button-target',
			'name' => $prefix . 'target' . $sufix,
			'id' => $prefix . 'target' . '_' . $button_id,
			'value' => $button_target,
			'label' => esc_html__( 'Button Target', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-button-type',
			'name' => $prefix . 'type' . $sufix,
			'id' => $prefix . 'type' . '_' . $button_id,
			'value' => $button_type,
			'group_id' => $group_id,
			'label' => esc_html__( 'Button Type', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-button-color',
			'name' => $prefix . 'color' . $sufix,
			'id' => $prefix . 'color' . '_' . $button_id,
			'value' => $button_color,
			'group_id' => $group_id,
			'label' => esc_html__( 'Button Color', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-button-color',
			'name' => $prefix . 'hover_color' . $sufix,
			'id' => $prefix . 'hover_color' . '_' . $button_id,
			'value' => $button_hover_color,
			'group_id' => $group_id,
			'label' => esc_html__( 'Button Hover Color', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-button-size',
			'name' => $prefix . 'size' . $sufix,
			'value' => $button_size,
			'label' => esc_html__( 'Button Size', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-button-shape',
			'name' => $prefix . 'shape' . $sufix,
			'value' => $button_shape,
			'label' => esc_html__( 'Button Shape', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'class' . $sufix,
			'id' => $prefix . 'class' . '_' . $button_id,
			'value' => $button_class,
			'label' => esc_html__( 'Button Class', 'blade' ),
		)
	);

	echo '</div>';

}


/**
* Prints Item Overlay Options
*/
function blade_grve_print_admin_feature_item_overlay_options( $item, $prefix = 'grve_single_item_', $mode = '' ) {

	$pattern_overlay = blade_grve_array_value( $item, 'pattern_overlay' );
	$color_overlay = blade_grve_array_value( $item, 'color_overlay', 'dark' );
	$color_overlay_custom  = blade_grve_array_value( $item, 'color_overlay_custom', '#000000' );
	$opacity_overlay = blade_grve_array_value( $item, 'opacity_overlay', '0' );

	$sufix  = '';
	if ( 'multi' == $mode ) {
		$sufix = '[]';
	};

	blade_grve_print_admin_option(
		array(
			'type' => 'select-pattern-overlay',
			'name' => $prefix . 'pattern_overlay' . $sufix,
			'value' => $pattern_overlay,
			'label' => esc_html__( 'Pattern Overlay', 'blade' ),
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select-colorpicker',
			'name' => $prefix . 'color_overlay' . $sufix,
			'value' => $color_overlay,
			'value2' => $color_overlay_custom,
			'label' => esc_html__( 'Color Overlay', 'blade' ),
			'multiple' => 'multi',
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select-opacity',
			'name' => $prefix . 'opacity_overlay' . $sufix,
			'value' => $opacity_overlay,
			'label' => esc_html__( 'Opacity Overlay', 'blade' ),
		)
	);

}

/**
* Prints Item Content Options
*/
function blade_grve_print_admin_feature_item_content_options( $item, $prefix = 'grve_single_item_', $mode = '' ) {

	$item_id = blade_grve_array_value( $item, 'id' );
	$title = blade_grve_array_value( $item, 'title' );
	$title_color = blade_grve_array_value( $item, 'title_color', 'light' );
	$title_color_custom = blade_grve_array_value( $item, 'title_color_custom', '#ffffff' );
	$title_tag = blade_grve_array_value( $item, 'title_tag', 'div' );
	$caption = blade_grve_array_value( $item, 'caption' );
	$caption_color = blade_grve_array_value( $item, 'caption_color', 'light' );
	$caption_color_custom = blade_grve_array_value( $item, 'caption_color_custom', '#ffffff' );
	$caption_tag = blade_grve_array_value( $item, 'caption_tag', 'div' );
	$subheading = blade_grve_array_value( $item, 'subheading' );
	$subheading_color = blade_grve_array_value( $item, 'subheading_color', 'light' );
	$subheading_color_custom = blade_grve_array_value( $item, 'subheading_color_custom', '#ffffff' );
	$subheading_tag = blade_grve_array_value( $item, 'subheading_tag', 'div' );

	$content_position = blade_grve_array_value( $item, 'content_position', 'center-center' );
	$content_animation = blade_grve_array_value( $item, 'content_animation', 'fade-in' );
	$content_image_id = blade_grve_array_value( $item, 'content_image_id', '0' );
	$content_image_size = blade_grve_array_value( $item, 'content_image_size' );
	$content_image_max_height = blade_grve_array_value( $item, 'content_image_max_height', '150' );

	$sufix  = '';
	if ( 'multi' == $mode ) {
		$sufix = '[]';
	};

	blade_grve_print_admin_option(
		array(
			'type' => 'select-image',
			'name' => $prefix . 'content_image_id' . $sufix,
			'value' => $content_image_id,
			'label' => array(
				"title" => esc_html__( 'Graphic Image', 'blade' ),
			),
			'width' => 'fullwidth',
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select',
			'name' => $prefix . 'content_image_size' . $sufix,
			'options' => array(
				'' => esc_html__( 'Resize ( Medium )', 'blade' ),
				'full' => esc_html__( 'Full size', 'blade' ),
			),
			'value' => $content_image_size,
			'label' => esc_html__( 'Graphic Image Size', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'content_image_max_height' . $sufix,
			'value' => $content_image_max_height,
			'label' => esc_html__( 'Graphic Image Max Height', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'subheading' . $sufix,
			'value' => $subheading,
			'label' => esc_html__( 'Sub Heading', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'title' . $sufix,
			'value' => $title,
			'label' => esc_html__( 'Title', 'blade' ),
			'extra_class' =>  'grve-admin-label-update',
			'id' => $prefix . 'title' . $item_id,
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'caption' . $sufix,
			'value' => $caption,
			'label' => esc_html__( 'Description', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-colorpicker',
			'name' => $prefix . 'subheading_color' . $sufix,
			'value' => $subheading_color,
			'value2' => $subheading_color_custom,
			'label' => esc_html__( 'Sub Heading Color', 'blade' ),
			'multiple' => 'multi',
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select-colorpicker',
			'name' => $prefix . 'title_color' . $sufix,
			'value' => $title_color,
			'value2' => $title_color_custom,
			'label' => esc_html__( 'Title Color', 'blade' ),
			'multiple' => 'multi',
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select-colorpicker',
			'name' => $prefix . 'caption_color' . $sufix,
			'value' => $caption_color,
			'value2' => $caption_color_custom,
			'label' => esc_html__( 'Description Color', 'blade' ),
			'multiple' => 'multi',
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-tag',
			'name' => $prefix . 'subheading_tag' . $sufix,
			'value' => $subheading_tag,
			'label' => esc_html__( 'Sub Heading Tag', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-tag',
			'name' => $prefix . 'title_tag' . $sufix,
			'value' => $title_tag,
			'label' => esc_html__( 'Title Tag', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-tag',
			'name' => $prefix . 'caption_tag' . $sufix,
			'value' => $caption_tag,
			'label' => esc_html__( 'Description Tag', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-bg-position',
			'name' => $prefix . 'content_position' . $sufix,
			'value' => $content_position,
			'label' => esc_html__( 'Content Position', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-text-animation',
			'name' => $prefix . 'content_animation' . $sufix,
			'value' => $content_animation,
			'label' => esc_html__( 'Content Animation', 'blade' ),
		)
	);

}

/**
* Prints Item Extra Options
*/
function blade_grve_print_admin_feature_item_extra_options( $item, $prefix = 'grve_single_item_', $mode = '' ) {

	$sufix  = '';
	if ( 'multi' == $mode ) {
		$sufix = '[]';
	};

	$el_class = blade_grve_array_value( $item, 'el_class' );
	$arrow_enabled = blade_grve_array_value( $item, 'arrow_enabled', 'no' );
	$arrow_align = blade_grve_array_value( $item, 'arrow_align', 'left' );
	$arrow_color = blade_grve_array_value( $item, 'arrow_color', 'light' );
	$arrow_color_custom = blade_grve_array_value( $item, 'arrow_color_custom', '#ffffff' );

	blade_grve_print_admin_option(
		array(
			'type' => 'select-boolean',
			'name' => $prefix . 'arrow_enabled' . $sufix,
			'value' => $arrow_enabled,
			'label' => esc_html__( 'Enable Bottom Arrow', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-align',
			'name' => $prefix . 'arrow_align' . $sufix,
			'value' => $arrow_align,
			'label' => esc_html__( 'Arrow Alignment', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-colorpicker',
			'name' => $prefix . 'arrow_color' . $sufix,
			'value' => $arrow_color,
			'value2' => $arrow_color_custom,
			'label' => esc_html__( 'Arrow Color', 'blade' ),
			'multiple' => 'multi',
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'el_class' . $sufix,
			'value' => $el_class,
			'label' => esc_html__( 'Extra Class', 'blade' ),
		)
	);

}

/**
 * Prints Item Background Image Options
 */
function blade_grve_print_admin_feature_item_background_options( $item ) {

	$bg_image_id = blade_grve_array_value( $item, 'bg_image_id', '0' );
	$bg_position = blade_grve_array_value( $item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = blade_grve_array_value( $item, 'bg_tablet_sm_position' );
	$image_effect = blade_grve_array_value( $item, 'image_effect' );


	blade_grve_print_admin_option(
		array(
			'type' => 'select-image',
			'name' => 'grve_single_item_bg_image_id',
			'value' => $bg_image_id,
			'label' => array(
				"title" => esc_html__( 'Background Image', 'blade' ),
			),
			'width' => 'fullwidth',
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-bg-position',
			'name' => 'grve_single_item_bg_position',
			'value' => $bg_position,
			'label' => esc_html__( 'Background Position', 'blade' ),
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select-bg-position-inherit',
			'name' => 'grve_single_item_bg_tablet_sm_position',
			'value' => $bg_tablet_sm_position,
			'label' => array(
				"title" => esc_html__( 'Background Position ( Tablet Portrait )', 'blade' ),
				"desc" => esc_html__( 'Tablet devices with portrait orientation and below.', 'blade' ),
			),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select',
			'name' => 'grve_single_item_image_effect',
			'options' => array(
				'' => esc_html__( 'None', 'blade' ),
				'animated' => esc_html__( 'Animated', 'blade' ),
				'parallax' => esc_html__( 'Parallax', 'blade' ),
			),
			'value' => $image_effect,
			'label' => esc_html__( 'Background Effect', 'blade' ),
			'wrap_class' => 'grve-feature-required grve-item-feature-image-settings',
		)
	);

}

/**
 * Prints Item Background Video Options
 */
function blade_grve_print_admin_feature_item_video_options( $item ) {

	$video_webm = blade_grve_array_value( $item, 'video_webm' );
	$video_mp4 = blade_grve_array_value( $item, 'video_mp4' );
	$video_ogv = blade_grve_array_value( $item, 'video_ogv' );
	$video_poster = blade_grve_array_value( $item, 'video_poster', 'no' );
	$video_loop = blade_grve_array_value( $item, 'video_loop', 'yes' );
	$video_muted = blade_grve_array_value( $item, 'video_muted', 'yes' );
	$video_effect = blade_grve_array_value( $item, 'video_effect' );

	blade_grve_print_admin_option(
		array(
			'type' => 'label',
			'label' => esc_html__( 'HTML5 Video', 'blade' ),
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select-bg-video',
			'name' => 'grve_single_item_video_webm',
			'value' => $video_webm,
			'label' => esc_html__( 'WebM File URL', 'blade' ),
			'width' => 'fullwidth',
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select-bg-video',
			'name' => 'grve_single_item_video_mp4',
			'value' => $video_mp4,
			'label' => esc_html__( 'MP4 File URL', 'blade' ),
			'width' => 'fullwidth',
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-bg-video',
			'name' => 'grve_single_item_video_ogv',
			'value' => $video_ogv,
			'label' => esc_html__( 'OGV File URL', 'blade' ),
			'width' => 'fullwidth',
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-boolean',
			'name' => 'grve_single_item_video_poster',
			'value' => $video_poster,
			'label' => esc_html__( 'Use Fallback Image as Poster', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-boolean',
			'name' => 'grve_single_item_video_loop',
			'value' => $video_loop,
			'label' => esc_html__( 'Loop', 'blade' ),
		)
	);

	blade_grve_print_admin_option(
		array(
			'type' => 'select-boolean',
			'name' => 'grve_single_item_video_muted',
			'value' => $video_muted,
			'label' => esc_html__( 'Muted', 'blade' ),
		)
	);
	blade_grve_print_admin_option(
		array(
			'type' => 'select',
			'name' => 'grve_single_item_video_effect',
			'options' => array(
				'' => esc_html__( 'None', 'blade' ),
				'animated' => esc_html__( 'Animated', 'blade' ),
			),
			'value' => $video_effect,
			'label' => esc_html__( 'Video Effect', 'blade' ),
		)
	);


}


function blade_grve_admin_get_feature_section( $post_id ) {

	//Feature Section
	$feature_section = get_post_meta( $post_id, 'grve_feature_section', true );

	//Feature Settings
	$feature_settings = blade_grve_array_value( $feature_section, 'feature_settings' );

	$feature_element = blade_grve_array_value( $feature_settings, 'element' );
	$feature_size = blade_grve_array_value( $feature_settings, 'size' );
	$feature_height = blade_grve_array_value( $feature_settings, 'height', '550' );
	$feature_min_height = blade_grve_array_value( $feature_settings, 'min_height', '320' );
	$feature_bg_color  = blade_grve_array_value( $feature_settings, 'bg_color', 'dark' );
	$feature_bg_color_custom  = blade_grve_array_value( $feature_settings, 'bg_color_custom', '#000000' );
	$feature_header_position = blade_grve_array_value( $feature_settings, 'header_position', 'above' );

	//Feature Single Item
	$feature_single_item = blade_grve_array_value( $feature_section, 'single_item' );
	$feature_single_item_button = blade_grve_array_value( $feature_single_item, 'button' );
	$feature_single_item_button2 = blade_grve_array_value( $feature_single_item, 'button2' );


	//Slider Item
	$slider_items = blade_grve_array_value( $feature_section, 'slider_items' );
	$slider_settings = blade_grve_array_value( $feature_section, 'slider_settings' );

	$slider_speed = blade_grve_array_value( $slider_settings, 'slideshow_speed', '3500' );
	$slider_pause = blade_grve_array_value( $slider_settings, 'slider_pause', 'no' );
	$slider_dir_nav = blade_grve_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_dir_nav_color = blade_grve_array_value( $slider_settings, 'direction_nav_color', 'light' );
	$slider_transition = blade_grve_array_value( $slider_settings, 'transition', 'slide' );
	$slider_effect = blade_grve_array_value( $slider_settings, 'slider_effect' );

	//Map Item
	$map_items = blade_grve_array_value( $feature_section, 'map_items' );
	$map_settings = blade_grve_array_value( $feature_section, 'map_settings' );

	$map_zoom = blade_grve_array_value( $map_settings, 'zoom', 14 );
	$map_marker = blade_grve_array_value( $map_settings, 'marker' );
	$map_disable_style = blade_grve_array_value( $map_settings, 'disable_style', 'no' );

	//Revolution slider
	$revslider_alias = blade_grve_array_value( $feature_section, 'revslider_alias' );

?>

		<div class="grve-fields-wrapper grve-highlight">
			<div class="grve-label">
				<label for="grve-page-feature-element">
					<span class="grve-title"><?php esc_html_e( 'Feature Element', 'blade' ); ?></span>
					<span class="grve-description"><?php esc_html_e( 'Select feature section element', 'blade' ); ?></span>
				</label>
			</div>
			<div class="grve-field-items-wrapper">
				<div class="grve-field-item">
					<select id="grve-page-feature-element" name="grve_page_feature_element">
						<option value="" <?php selected( "", $feature_element ); ?>><?php esc_html_e( 'None', 'blade' ); ?></option>
						<option value="title" <?php selected( "title", $feature_element ); ?>><?php esc_html_e( 'Title', 'blade' ); ?></option>
						<option value="image" <?php selected( "image", $feature_element ); ?>><?php esc_html_e( 'Image', 'blade' ); ?></option>
						<option value="video" <?php selected( "video", $feature_element ); ?>><?php esc_html_e( 'Video', 'blade' ); ?></option>
						<option value="slider" <?php selected( "slider", $feature_element ); ?>><?php esc_html_e( 'Slider', 'blade' ); ?></option>
						<option value="revslider" <?php selected( "revslider", $feature_element ); ?>><?php esc_html_e( 'Revolution Slider', 'blade' ); ?></option>
						<option value="map" <?php selected( "map", $feature_element ); ?>><?php esc_html_e( 'Map', 'blade' ); ?></option>
					</select>
				</div>
			</div>
		</div>

		<div id="grve-feature-section-options" class="grve-feature-section-item postbox" <?php if ( "" != $feature_element ) { ?> style="display:none;" <?php } ?>>

			<div class="grve-fields-wrapper grve-feature-options-wrapper">
				<div class="grve-label">
					<label for="grve-page-feature-element">
						<span class="grve-title"><?php esc_html_e( 'Feature Size', 'blade' ); ?></span>
						<span class="grve-description"><?php esc_html_e( 'With Custom Size option you can select the feature height in px.', 'blade' ); ?></span>
					</label>
				</div>
				<div class="grve-field-items-wrapper">
					<div class="grve-field-item">
						<select name="grve_page_feature_size" id="grve-page-feature-size">
							<option value="" <?php selected( "", $feature_size ); ?>><?php esc_html_e( 'Full Screen', 'blade' ); ?></option>
							<option value="custom" <?php selected( "custom", $feature_size ); ?>><?php esc_html_e( 'Custom Size', 'blade' ); ?></option>
						</select>
					</div>
					<div class="grve-field-item">
						<span id="grve-feature-section-height" <?php if ( "" == $feature_size ) { ?> style="display:none;" <?php } ?>>
							<input type="text" name="grve_page_feature_height" value="<?php echo esc_attr( $feature_height ); ?>" />
							<span class="grve-sub-title"><?php esc_html_e( 'Height in px', 'blade' ); ?></span>
							<input type="text" name="grve_page_feature_min_height" value="<?php echo esc_attr( $feature_min_height ); ?>"/>
							<span class="grve-sub-title"><?php esc_html_e( 'Minimum Height in px', 'blade' ); ?></span>
						</span>
					</div>
				</div>
			</div>
			<?php
				blade_grve_print_admin_option(
					array(
						'type' => 'select',
						'options' => array(
							'above' => esc_html__( 'Header above Feature', 'blade' ),
							'below' => esc_html__( 'Header below Feature', 'blade' ),
						),
						'name' => 'grve_page_feature_header_position',
						'value' => $feature_header_position,
						'label' => array(
							'title' => esc_html__( 'Feature/Header Position', 'blade' ),
							'desc' => esc_html__( 'With this option header will be shown above or below feature section.', 'blade' ),
						),
					)
				);
			?>
			<div class="grve-feature-options-wrapper">
			<?php

				blade_grve_print_admin_option(
					array(
						'type' => 'select-colorpicker',
						'name' => 'grve_page_feature_bg_color',
						'value' => $feature_bg_color,
						'value2' => $feature_bg_color_custom,
						'label' => esc_html__( 'Background Color', 'blade' ),
						'multiple' => 'multi',
					)
				);
			?>
			</div>

		</div>



		<div id="grve-feature-section-slider" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>

			<div class="postbox">
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Slider Settings', 'blade' ); ?></span>
				</h3>
				<div class="inside">

					<?php
						blade_grve_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => 'grve_page_slider_settings_speed',
								'value' => $slider_speed,
								'label' => esc_html__( 'Slideshow Speed', 'blade' ),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_page_slider_settings_pause',
								'options' => array(
									'no' => esc_html__( 'No', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
								),
								'value' => $slider_pause,
								'label' => esc_html__( 'Pause on Hover', 'blade' ),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'1' => esc_html__( 'Style 1', 'blade' ),
									'2' => esc_html__( 'Style 2', 'blade' ),
									'3' => esc_html__( 'Style 3', 'blade' ),
									'4' => esc_html__( 'Style 4', 'blade' ),
									'0' => esc_html__( 'No Navigation', 'blade' ),
								),
								'name' => 'grve_page_slider_settings_direction_nav',
								'value' => $slider_dir_nav,
								'label' => array(
									'title' => esc_html__( 'Navigation Buttons', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'slide' => esc_html__( 'Slide', 'blade' ),
									'fade' => esc_html__( 'Fade', 'blade' ),
									'backSlide' => esc_html__( 'Back Slide', 'blade' ),
									'goDown' => esc_html__( 'Go Down', 'blade' ),
								),
								'name' => 'grve_page_slider_settings_transition',
								'value' => $slider_transition,
								'label' => array(
									'title' => esc_html__( 'Transition', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'' => esc_html__( 'None', 'blade' ),
									'animated' => esc_html__( 'Animated', 'blade' ),
									'parallax' => esc_html__( 'Parallax', 'blade' ),
								),
								'name' => 'grve_page_slider_settings_effect',
								'value' => $slider_effect,
								'label' => array(
									'title' => esc_html__( 'Slider Effect', 'blade' ),
								),
							)
						);
					?>

					<div class="grve-fields-wrapper">
						<div class="grve-label">
							<label for="grve-page-feature-element">
								<span class="grve-title"><?php esc_html_e( 'Add Slides', 'blade' ); ?></span>
							</label>
						</div>
						<div class="grve-field-items-wrapper">
							<div class="grve-field-item">
								<input type="button" class="grve-upload-feature-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images to Slider', 'blade' ); ?>"/>
								<span id="grve-upload-feature-slider-button-spinner" class="grve-action-spinner"></span>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div id="grve-feature-slider-container" data-mode="slider-full" class="grve-feature-section-item" <?php if ( 'slider' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<?php
				if( !empty( $slider_items ) ) {
					blade_grve_print_admin_feature_slider_items( $slider_items );
				}
			?>
		</div>

		<div id="grve-feature-map-container" class="grve-feature-section-item" <?php if ( 'map' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-map-item postbox">
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Map', 'blade' ); ?></span>
				</h3>
				<div class="inside">
					<div class="grve-fields-wrapper">
						<div class="grve-label">
							<label for="grve-page-feature-element">
								<span class="grve-title"><?php esc_html_e( 'Single Point Zoom', 'blade' ); ?></span>
							</label>
						</div>
						<div class="grve-field-items-wrapper">
							<div class="grve-field-item">
								<select id="grve-page-feature-map-zoom" name="grve_page_feature_map_zoom">
									<?php for ( $i=1; $i < 20; $i++ ) { ?>
										<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, $map_zoom ); ?>><?php echo esc_html( $i ); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="grve-fields-wrapper">
						<div class="grve-label">
							<label for="grve-page-feature-element">
								<span class="grve-title"><?php esc_html_e( 'Global Marker', 'blade' ); ?></span>
							</label>
						</div>
						<div class="grve-field-items-wrapper">
							<div class="grve-field-item grve-field-item-fullwidth">
								<input type="text" class="grve-upload-simple-media-field" id="grve-page-feature-map-marker" name="grve_page_feature_map_marker" value="<?php echo esc_attr( $map_marker ); ?>"/>
								<label></label>
								<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary" value="<?php esc_attr_e( 'Insert Marker', 'blade' ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
							</div>
						</div>
					</div>
					<div class="grve-fields-wrapper">
						<div class="grve-label">
							<label for="grve-page-feature-element">
								<span class="grve-title"><?php esc_html_e( 'Disable Custom Style', 'blade' ); ?></span>
							</label>
						</div>
						<div class="grve-field-items-wrapper">
							<div class="grve-field-item">
								<select id="grve-page-feature-map-disable-style" name="grve_page_feature_map_disable_style">
									<option value="no" <?php selected( "no", $map_disable_style ); ?>><?php esc_html_e( 'No', 'blade' ); ?></option>
									<option value="yes" <?php selected( "yes", $map_disable_style ); ?>><?php esc_html_e( 'Yes', 'blade' ); ?></option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="grve-fields-wrapper">
					<div class="grve-label">
						<label for="grve-page-feature-element">
							<span class="grve-title"><?php esc_html_e( 'Add Map Points', 'blade' ); ?></span>
						</label>
					</div>
					<div class="grve-field-items-wrapper">
						<div class="grve-field-item">
							<input type="button" id="grve-upload-multi-map-point" class="grve-upload-multi-map-point button-primary" value="<?php esc_attr_e( 'Insert Point to Map', 'blade' ); ?>"/>
							<span id="grve-upload-multi-map-button-spinner" class="grve-action-spinner"></span>
						</div>
					</div>
				</div>
			</div>
			<?php blade_grve_print_admin_feature_map_items( $map_items ); ?>
		</div>

		<div id="grve-feature-single-container" class="grve-feature-section-item" <?php if ( 'title' != $feature_element && 'image' != $feature_element && 'video' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-video-item postbox">
				<span class="grve-modal-spinner"></span>
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Options', 'blade' ); ?></span>
				</h3>
				<div class="inside">

					<!-- GRVE METABOXES -->
					<div class="grve-metabox-content">

						<!-- TABS -->
						<div class="grve-tabs">

							<ul class="grve-tab-links">
								<li class="grve-feature-required grve-item-feature-video-settings active"><a id="grve-feature-single-tab-video-link" href="#grve-feature-single-tab-video"><?php esc_html_e( 'Video', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-bg-settings"><a id="grve-feature-single-tab-bg-link" href="#grve-feature-single-tab-bg"><?php esc_html_e( 'Background', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-content-settings"><a id="grve-feature-single-tab-content-link" href="#grve-feature-single-tab-content"><?php esc_html_e( 'Content', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-revslider-settings"><a id="grve-feature-single-tab-revslider-link" href="#grve-feature-single-tab-revslider"><?php esc_html_e( 'Revolution Slider', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-button-settings"><a href="#grve-feature-single-tab-button"><?php esc_html_e( 'First Button', 'blade' ); ?></a></li>
								<li class="grve-feature-required grve-item-feature-button-settings"><a href="#grve-feature-single-tab-button2"><?php esc_html_e( 'Second Button', 'blade' ); ?></a></li>
								<li><a href="#grve-feature-single-tab-extra"><?php esc_html_e( 'Extra', 'blade' ); ?></a></li>
							</ul>

							<div class="grve-tab-content">
								<div id="grve-feature-single-tab-video" class="grve-tab-item active">
									<?php blade_grve_print_admin_feature_item_video_options( $feature_single_item ); ?>
								</div>
								<div id="grve-feature-single-tab-revslider" class="grve-tab-item">
									<?php
										blade_grve_print_admin_option(
												array(
													'type' => 'select',
													'options' => blade_grve_get_revolution_selection(),
													'name' => 'grve_page_revslider',
													'value' => $revslider_alias,
													'label' => array(
														'title' => esc_html__( 'Revolution Slider', 'blade' ),
													),
												)
											);
									?>
								</div>
								<div id="grve-feature-single-tab-bg" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_background_options( $feature_single_item ); ?>
									<?php blade_grve_print_admin_feature_item_overlay_options( $feature_single_item ); ?>
								</div>
								<div id="grve-feature-single-tab-content" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_content_options( $feature_single_item ); ?>
								</div>
								<div id="grve-feature-single-tab-button" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_button_options( $feature_single_item_button, 'grve_single_item_button_' ); ?>
								</div>
								<div id="grve-feature-single-tab-button2" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_button_options( $feature_single_item_button2, 'grve_single_item_button2_' ); ?>
								</div>
								<div id="grve-feature-single-tab-extra" class="grve-tab-item">
									<?php blade_grve_print_admin_feature_item_extra_options( $feature_single_item ); ?>
								</div>
							</div>

						</div>
						<!-- END TABS -->

					</div>
					<!-- END GRVE METABOXES -->
				</div>
			</div>
		</div>
<?php
}

function blade_grve_admin_save_feature_section( $post_id ) {

	//Feature Section variable
	$feature_section = array();


	if ( isset( $_POST['grve_page_feature_element'] ) ) {

		//Feature Settings

		$feature_section['feature_settings'] = array (
			'element' => $_POST['grve_page_feature_element'],
			'size' => $_POST['grve_page_feature_size'],
			'height' => $_POST['grve_page_feature_height'],
			'min_height' => $_POST['grve_page_feature_min_height'],
			'header_position' => $_POST['grve_page_feature_header_position'],
			'bg_color' => $_POST['grve_page_feature_bg_color'],
			'bg_color_custom' => $_POST['grve_page_feature_bg_color_custom'],
		);


		//Feature Revolution Slider
		if ( isset( $_POST['grve_page_revslider'] ) ) {
			$feature_section['revslider_alias'] = $_POST['grve_page_revslider'];
		}

		//Feature Single Item
		if ( isset( $_POST['grve_single_item_title'] ) ) {


			$feature_section['single_item'] = array (

				'title' => $_POST['grve_single_item_title'],
				'title_color' => $_POST['grve_single_item_title_color'],
				'title_color_custom' => $_POST['grve_single_item_title_color_custom'],
				'title_tag' => $_POST['grve_single_item_title_tag'],
				'caption' => $_POST['grve_single_item_caption'],
				'caption_color' => $_POST['grve_single_item_caption_color'],
				'caption_color_custom' => $_POST['grve_single_item_caption_color_custom'],
				'caption_tag' => $_POST['grve_single_item_caption_tag'],
				'subheading' => $_POST['grve_single_item_subheading'],
				'subheading_color' => $_POST['grve_single_item_subheading_color'],
				'subheading_color_custom' => $_POST['grve_single_item_subheading_color_custom'],
				'subheading_tag' => $_POST['grve_single_item_subheading_tag'],
				'content_position' => $_POST['grve_single_item_content_position'],
				'content_animation' => $_POST['grve_single_item_content_animation'],
				'content_image_id' => $_POST['grve_single_item_content_image_id'],
				'content_image_size' => $_POST['grve_single_item_content_image_size'],
				'content_image_max_height' => $_POST['grve_single_item_content_image_max_height'],
				'pattern_overlay' => $_POST['grve_single_item_pattern_overlay'],
				'color_overlay' => $_POST['grve_single_item_color_overlay'],
				'color_overlay_custom' => $_POST['grve_single_item_color_overlay_custom'],
				'opacity_overlay' => $_POST['grve_single_item_opacity_overlay'],
				'bg_image_id' => $_POST['grve_single_item_bg_image_id'],
				'bg_position' => $_POST['grve_single_item_bg_position'],
				'bg_tablet_sm_position' => $_POST['grve_single_item_bg_tablet_sm_position'],
				'image_effect' => $_POST['grve_single_item_image_effect'],
				'video_webm' => $_POST['grve_single_item_video_webm'],
				'video_mp4' => $_POST['grve_single_item_video_mp4'],
				'video_ogv' => $_POST['grve_single_item_video_ogv'],
				'video_poster' => $_POST['grve_single_item_video_poster'],
				'video_loop' => $_POST['grve_single_item_video_loop'],
				'video_muted' => $_POST['grve_single_item_video_muted'],
				'video_effect' => $_POST['grve_single_item_video_effect'],

				'button' => array(
					'id' => $_POST['grve_single_item_button_id'],
					'text' => $_POST['grve_single_item_button_text'],
					'url' => $_POST['grve_single_item_button_url'],
					'target' => $_POST['grve_single_item_button_target'],
					'color' => $_POST['grve_single_item_button_color'],
					'hover_color' => $_POST['grve_single_item_button_hover_color'],
					'size' => $_POST['grve_single_item_button_size'],
					'shape' => $_POST['grve_single_item_button_shape'],
					'type' => $_POST['grve_single_item_button_type'],
					'class' => $_POST['grve_single_item_button_class'],
				),
				'button2' => array(
					'id' => $_POST['grve_single_item_button2_id'],
					'text' => $_POST['grve_single_item_button2_text'],
					'url' => $_POST['grve_single_item_button2_url'],
					'target' => $_POST['grve_single_item_button2_target'],
					'color' => $_POST['grve_single_item_button2_color'],
					'hover_color' => $_POST['grve_single_item_button2_hover_color'],
					'size' => $_POST['grve_single_item_button2_size'],
					'shape' => $_POST['grve_single_item_button2_shape'],
					'type' => $_POST['grve_single_item_button2_type'],
					'class' => $_POST['grve_single_item_button2_class'],
				),
				'arrow_enabled' => $_POST['grve_single_item_arrow_enabled'],
				'arrow_align' => $_POST['grve_single_item_arrow_align'],
				'arrow_color' => $_POST['grve_single_item_arrow_color'],
				'arrow_color_custom' => $_POST['grve_single_item_arrow_color_custom'],
				'el_class' => $_POST['grve_single_item_el_class'],

			);
		}

		//Feature Slider Items
		$slider_items = array();
		if ( isset( $_POST['grve_slider_item_id'] ) ) {

			$num_of_images = sizeof( $_POST['grve_slider_item_id'] );
			for ( $i=0; $i < $num_of_images; $i++ ) {

				$slide = array (
					'id' => $_POST['grve_slider_item_id'][ $i ],
					'bg_image_id' => $_POST['grve_slider_item_bg_image_id'][ $i ],
					'bg_position' => $_POST['grve_slider_item_bg_position'][ $i ],
					'bg_tablet_sm_position' => $_POST['grve_slider_item_bg_tablet_sm_position'][ $i ],
					'header_style' => $_POST['grve_slider_item_header_style'][ $i ],
					'title' => $_POST['grve_slider_item_title'][ $i ],
					'title_color' => $_POST['grve_slider_item_title_color'][ $i ],
					'title_color_custom' => $_POST['grve_slider_item_title_color_custom'][ $i ],
					'title_tag' => $_POST['grve_slider_item_title_tag'][ $i ],
					'caption' => $_POST['grve_slider_item_caption'][ $i ],
					'caption_color' => $_POST['grve_slider_item_caption_color'][ $i ],
					'caption_color_custom' => $_POST['grve_slider_item_caption_color_custom'][ $i ],
					'caption_tag' => $_POST['grve_slider_item_caption_tag'][ $i ],
					'subheading' => $_POST['grve_slider_item_subheading'][ $i ],
					'subheading_color' => $_POST['grve_slider_item_subheading_color'][ $i ],
					'subheading_color_custom' => $_POST['grve_slider_item_subheading_color_custom'][ $i ],
					'subheading_tag' => $_POST['grve_slider_item_subheading_tag'][ $i ],
					'content_position' => $_POST['grve_slider_item_content_position'][ $i ],
					'content_animation' => $_POST['grve_slider_item_content_animation'][ $i ],
					'content_image_id' => $_POST['grve_slider_item_content_image_id'][ $i ],
					'content_image_size' => $_POST['grve_slider_item_content_image_size'][ $i ],
					'content_image_max_height' => $_POST['grve_slider_item_content_image_max_height'][ $i ],
					'pattern_overlay' => $_POST['grve_slider_item_pattern_overlay'][ $i ],
					'color_overlay' => $_POST['grve_slider_item_color_overlay'][ $i ],
					'color_overlay_custom' => $_POST['grve_slider_item_color_overlay_custom'][ $i ],
					'opacity_overlay' => $_POST['grve_slider_item_opacity_overlay'][ $i ],
					'button' => array(
						'id' => $_POST['grve_slider_item_button_id'][ $i ],
						'text' => $_POST['grve_slider_item_button_text'][ $i ],
						'url' => $_POST['grve_slider_item_button_url'][ $i ],
						'target' => $_POST['grve_slider_item_button_target'][ $i ],
						'color' => $_POST['grve_slider_item_button_color'][ $i ],
						'hover_color' => $_POST['grve_slider_item_button_hover_color'][ $i ],
						'size' => $_POST['grve_slider_item_button_size'][ $i ],
						'shape' => $_POST['grve_slider_item_button_shape'][ $i ],
						'type' => $_POST['grve_slider_item_button_type'][ $i ],
						'class' => $_POST['grve_slider_item_button_class'][ $i ],
					),
					'button2' => array(
						'id' => $_POST['grve_slider_item_button2_id'][ $i ],
						'text' => $_POST['grve_slider_item_button2_text'][ $i ],
						'url' => $_POST['grve_slider_item_button2_url'][ $i ],
						'target' => $_POST['grve_slider_item_button2_target'][ $i ],
						'color' => $_POST['grve_slider_item_button2_color'][ $i ],
						'hover_color' => $_POST['grve_slider_item_button2_hover_color'][ $i ],
						'size' => $_POST['grve_slider_item_button2_size'][ $i ],
						'shape' => $_POST['grve_slider_item_button2_shape'][ $i ],
						'type' => $_POST['grve_slider_item_button2_type'][ $i ],
						'class' => $_POST['grve_slider_item_button2_class'][ $i ],
					),
					'arrow_enabled' => $_POST['grve_slider_item_arrow_enabled'][ $i ],
					'arrow_align' => $_POST['grve_slider_item_arrow_align'][ $i ],
					'arrow_color' => $_POST['grve_slider_item_arrow_color'][ $i ],
					'arrow_color_custom' => $_POST['grve_slider_item_arrow_color_custom'][ $i ],
					'el_class' => $_POST['grve_slider_item_el_class'][ $i ],
				);

				$slider_items[] = $slide;
			}

		}



		if( !empty( $slider_items ) ) {
			$feature_section['slider_items'] = $slider_items;

			$feature_section['slider_settings'] = array (
				'slideshow_speed' => $_POST['grve_page_slider_settings_speed'],
				'direction_nav' => $_POST['grve_page_slider_settings_direction_nav'],
				'slider_pause' => $_POST['grve_page_slider_settings_pause'],
				'transition' => $_POST['grve_page_slider_settings_transition'],
				'slider_effect' => $_POST['grve_page_slider_settings_effect'],
			);
		}

		//Feature Map Items
		$map_items = array();
		if ( isset( $_POST['grve_map_item_point_id'] ) ) {

			$num_of_map_points = sizeof( $_POST['grve_map_item_point_id'] );
			for ( $i=0; $i < $num_of_map_points; $i++ ) {

				$this_point = array (
					'id' => $_POST['grve_map_item_point_id'][ $i ],
					'lat' => $_POST['grve_map_item_point_lat'][ $i ],
					'lng' => $_POST['grve_map_item_point_lng'][ $i ],
					'marker' => $_POST['grve_map_item_point_marker'][ $i ],
					'title' => $_POST['grve_map_item_point_title'][ $i ],
					'info_text' => $_POST['grve_map_item_point_infotext'][ $i ],
					'info_text_open' => $_POST['grve_map_item_point_infotext_open'][ $i ],
					'button_text' => $_POST['grve_map_item_point_button_text'][ $i ],
					'button_url' => $_POST['grve_map_item_point_button_url'][ $i ],
					'button_target' => $_POST['grve_map_item_point_button_target'][ $i ],
					'button_class' => $_POST['grve_map_item_point_button_class'][ $i ],
				);
				$map_items[] =  $this_point;
			}

		}

		if( !empty( $map_items ) ) {

			$feature_section['map_items'] = $map_items;
			$feature_section['map_settings'] = array (
				'zoom' => $_POST['grve_page_feature_map_zoom'],
				'marker' => $_POST['grve_page_feature_map_marker'],
				'disable_style' => $_POST['grve_page_feature_map_disable_style'],
			);

		}

	}

	//Save Feature Section

	$new_meta_value = $feature_section;
	$meta_key = 'grve_feature_section';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value ) {
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	} elseif ( '' == $new_meta_value && $meta_value ) {
		delete_post_meta( $post_id, $meta_key, $meta_value );
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
