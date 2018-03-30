<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Class Crum_Font_Container
 *
 * @since         4.3
 *                vc_map examples:
 *    array(
 *      'type' => 'crumina_font_container',
 *      'param_name' => 'crumina_font_container',
 *      'value'=>'',
 *      'settings'=>array(
 *         'fields'=>array(
 *                'field_size' => 'xs-4',
 *                'tag'=>'div',
 *                'letter_spacing',
 *                'font_size',
 *                'line_height',
 *                'color',
 *
 *                'tag_description' => __('Select element tag.','dfd'),
 *                'text_align_description' => __('Select text alignment.','dfd'),
 *                'font_size_description' => __('Enter font size.','dfd'),
 *                'line_height_description' => __('Enter line height.','dfd'),
 *                'color_description' => __('Select color for your element.','dfd'),
 *            ),
 *        ),
 *    ),
 *  Ordering of fields, font_family, tag, text_align and etc. will be Same as ordering in array!
 *  To provide default value to field use 'key' => 'value'
 */
class Crum_Font_Container {


	function __construct() {
		if ( function_exists( 'vc_add_shortcode_param' ) ) {
			vc_add_shortcode_param( 'crumina_font_container', array( $this, 'vc_font_container_form_field' ), get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/js/crum_additional_param.js' );
		}
	}


	/**
	 * @param $settings
	 * @param $value
	 *
	 * @return mixed|void
	 */
	function vc_font_container_form_field( $settings, $value ) {
		$font_container = new Crum_Font_Container();

		return apply_filters( 'vc_font_container_render_filter', $font_container->render( $settings, $value ) );
	}

	/**
	 * @param $settings
	 * @param $value
	 *
	 * @return string
	 */
	public function render( $settings, $value ) {
		$fields = array();
		$values = array();
		extract( $this->_crum_font_container_parse_attributes( $settings['settings']['fields'], $value ) );

		$data   = array();
		$output = '<div class="vc_row crum_vc">';
		if ( ! empty( $fields ) ) {
			if ( isset( $fields['field_size'] ) ) {
				$columns = $fields['field_size'];
			} else {
				$columns = 'xs-6 vc_column-with-padding';
			}
			if ( isset( $fields['tag'] ) ) {
				$data['tag'] = '
                <div class="vc_col-' . $columns . ' ">
                    <div class="wpb_element_label">' . __( 'Element tag', 'dfd' ) . '</div>
                    <div class="crum-select-styled vc_font_container_form_field-tag-container">
                        <select class=" vc_font_container_form_field-tag-select wpb_vc_param_value">';
				$tags        = $this->_crum_font_container_get_allowed_tags();
				foreach ( $tags as $tag ) {
					$data['tag'] .= '<option value="' . $tag . '" class="' . $tag . '" ' . ( $tag === $values['tag'] ? 'selected' : '' ) . '>' . $tag . '</option>';
				}
				$data['tag'] .= '
                        </select>';
				$data['tag'] .= '</div>';
				if ( isset( $fields['tag_description'] ) && strlen( $fields['tag_description'] ) > 0 ) {
					$data['tag'] .= '
                    <span class="vc_description clear">' . $fields['tag_description'] . '</span>
                    ';
				}
				$data['tag'] .= '</div>';
			}
			if ( isset( $fields['font_size'] ) ) {
				$data['font_size'] = '
                <div class="vc_col-' . $columns . '">
                    <div class="wpb_element_label">' . __( 'Font size', 'dfd' ) . '</div>
                    <div class="crum-number-field-wrap vc_font_container_form_field-font_size-container">
                    <input type="number" min="0" step="1" class="crum_number_field wpb_vc_param_value vc_font_container_form_field-font_size-input" value="' . $values['font_size'] . '" />
                    </div>';

				if ( isset( $fields['font_size_description'] ) && strlen( $fields['font_size_description'] ) > 0 ) {
					$data['font_size'] .= '
                    <span class="vc_description clear">' . $fields['font_size_description'] . '</span>
                    ';
				}
				$data['font_size'] .= '</div>';
			}
			if ( isset( $fields['line_height'] ) ) {
				$data['line_height'] = '
                <div class="vc_col-' . $columns . '">
                    <div class="wpb_element_label">' . __( 'Line height', 'dfd' ) . '</div>
                    <div class="crum-number-field-wrap vc_font_container_form_field-line_height-container">
                        <input type="number" step="1" min="0" class="crum_number_field vc_font_container_form_field-line_height-input wpb_vc_param_value"  value="' . $values['line_height'] . '" />
                    </div>';
				if ( isset( $fields['line_height_description'] ) && strlen( $fields['line_height_description'] ) > 0 ) {
					$data['line_height'] .= '
                    <span class="vc_description clear">' . $fields['line_height_description'] . '</span>
                    ';
				}
				$data['line_height'] .= '</div>';
			}
			if ( isset( $fields['color'] ) ) {
				$data['color'] = '
                <div class="vc_col-' . $columns . '">
                    <div class="wpb_element_label">' . __( 'Text color', 'dfd' ) . '</div>
                    <div class="vc_font_container_form_field-color-container wp-picker-container">
                        <div class="color-group">
				            <input class="vc_font_container_form_field-color-input" type="text" value="' . $values['color'] . '"/>
				            <input name="color" class="wpb_vc_param_value field-color-result" type="hidden" value="' . $values['color'] . '"/>
				        </div>
                    </div>';
				if ( isset( $fields['color_description'] ) && strlen( $fields['color_description'] ) > 0 ) {
					$data['color'] .= '
                    <span class="vc_description clear">' . $fields['color_description'] . '</span>
                    ';
				}
				$data['color'] .= '</div>';
			}
			if ( isset( $fields['letter_spacing'] ) ) {
				$data['letter_spacing'] = '
                <div class="vc_col-' . $columns . '">
                    <div class="wpb_element_label">' . __( 'Letter spacing', 'dfd' ) . '</div>
                    <div class="crum-number-field-wrap vc_font_container_form_field-letter_spacing-container">
                        <input type="number" min="0" step="1" class="crum_number_field vc_font_container_form_field-letter_spacing-input wpb_vc_param_value" value="' . $values['letter_spacing'] . '" />
                    </div>';
				if ( isset( $fields['letter_spacing_description'] ) && strlen( $fields['letter_spacing_description'] ) > 0 ) {
					$data['line_height'] .= '
                    <span class="vc_description clear">' . $fields['letter_spacing_description'] . '</span>
                    ';
				}
				$data['letter_spacing'] .= '</div>';
			}

			if ( isset( $fields['font_style'] ) ) {

				$data['font_style'] = ' <div class="vc_col-' . $columns . '">';

				$data['font_style'] .= '<div class="wpb_element_label">' . __( 'Font style', 'dfd' ) . '</div>';

				$data['font_style'] .= '<div class="vc_font_container_form_field-font_style-container">';

				if(isset($values['font_style_italic'])){
					$data['font_style'] .= '<label>';
					$data['font_style'] .= '<input type="checkbox" class="vc_font_container_form_field-font_style-checkbox italic" value="italic" ' . ( '1' === $values['font_style_italic'] ? 'checked' : '' ) . '>';
					$data['font_style'] .= '<span class="vc_font_container_form_field-font_style-label italic"> ' . esc_html__( 'Italic', 'dfd' ) . '</span>';
					$data['font_style'] .= '</label>';
				}

				if(isset($values['font_style_underline'])){
					$data['font_style'] .= '<label>';
					$data['font_style'] .= '<input type="checkbox" class="vc_font_container_form_field-font_style-checkbox underline" value="underline" ' . ( '1' === $values['font_style_underline'] ? 'checked' : '' ) . '>';
					$data['font_style'] .= '<span class="vc_font_container_form_field-font_style-label underline"> ' . esc_html__( 'Underline', 'dfd' ) . '</span>';
					$data['font_style'] .= '</label>';
				}

				if(isset($values['font_style_bold'])){
					$data['font_style'] .= '<label>';
					$data['font_style'] .= '<input type="checkbox" class="vc_font_container_form_field-font_style-checkbox bold" value="bold" ' . ( '1' === $values['font_style_bold'] ? 'checked' : '' ) . '>';
					$data['font_style'] .= '<span class="vc_font_container_form_field-font_style-label bold"> ' . esc_html__( 'Bold', 'dfd' ) . '</span>';
					$data['font_style'] .= '</label>';
				}

				if ( isset( $fields['font_style_description'] ) && strlen( $fields['font_style_description'] ) > 0 ) {
					$data['font_style'] .= '
                    <span class="vc_description clear">' . $fields['font_style_description'] . '</span>
                    ';
				}

				$data['font_style'] .= '</div>';/*vc_font_container_form_field-font_style-container*/

				$data['font_style'] .= '</div>';/*columns*/

			}
			$data = apply_filters( 'vc_font_container_output_data', $data, $fields, $values, $settings );

			// Combine all in output, make sure you follow ordering.
			foreach ( $fields as $key => $field ) {
				if ( isset( $data[ $key ] ) ) {
					$output .= $data[ $key ];
				}
			}
		}
		$output .= '</div>';

		$output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';

		return $output;
	}


	/**
	 * If 'tag' field used this is list of allowed tags
	 * To modify this list, you should use add_filter('vc_font_container_get_allowed_tags','your_custom_function');
	 * vc_filter: vc_font_container_get_allowed_tags - to modify list of allowed tags by default
	 *
	 * @return array list of allowed tags
	 */
	public function _crum_font_container_get_allowed_tags() {
		$allowed_tags = array(
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'p',
			'div',
		);

		return apply_filters( 'crum_font_container_get_allowed_tags', $allowed_tags );

	}

	/**
	 * @param $attr
	 * @param $value
	 *
	 * @return array
	 */
	public function _crum_font_container_parse_attributes( $attr, $value ) {
		$fields = array();
		if ( isset( $attr ) ) {
			foreach ( $attr as $key => $val ) {
				if ( is_numeric( $key ) ) {
					$fields[ $val ] = '';
				} else {
					$fields[ $key ] = $val;
				}
			}
		}

		$values = vc_parse_multi_attribute( $value, array(
				'tag'                        => isset( $fields['tag'] ) ? $fields['tag'] : 'div',
				'font_size'                  => isset( $fields['font_size'] ) ? $fields['font_size'] : '',
				'font_style_italic'          => isset( $fields['font_style_italic'] ) ? $fields['font_style_italic'] : '',
				'font_style_bold'            => isset( $fields['font_style_bold'] ) ? $fields['font_style_bold'] : '',
				'font_style_underline'            => isset( $fields['font_style_bold'] ) ? $fields['font_style_underline'] : '',
				'color'                      => isset( $fields['color'] ) ? $fields['color'] : '',
				'line_height'                => isset( $fields['line_height'] ) ? $fields['line_height'] : '',
				'letter_spacing'             => isset( $fields['letter_spacing'] ) ? $fields['letter_spacing'] : '',
				'tag_description'            => isset( $fields['tag_description'] ) ? $fields['tag_description'] : '',
				'font_size_description'      => isset( $fields['font_size_description'] ) ? $fields['font_size_description'] : '',
				'font_style_description'     => isset( $fields['font_style_description'] ) ? $fields['font_style_description'] : '',
				'font_family_description'    => isset( $fields['font_family_description'] ) ? $fields['font_family_description'] : '',
				'color_description'          => isset( $fields['color_description'] ) ? $fields['color_description'] : 'left',
				'line_height_description'    => isset( $fields['line_height_description'] ) ? $fields['line_height_description'] : '',
				'letter_spacing_description' => isset( $fields['letter_spacing_description'] ) ? $fields['letter_spacing_description'] : '',
			)
		);

		return array( 'fields' => $fields, 'values' => $values );
	}
}


if ( class_exists( 'Crum_Font_Container' ) ) {
	$Crum_Font_Container = new Crum_Font_Container();
}
