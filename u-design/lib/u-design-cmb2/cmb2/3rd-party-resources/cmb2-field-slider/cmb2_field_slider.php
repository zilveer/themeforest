<?php
/**
 * Plugin Name: CMB2 Field Slider
 * Plugin URI:  https://github.com/qmatt/cmb2-field-slider
 * Description: Slider field type for Custom Metaboxes and Fields for WordPress
 * Version:     0.1.0
 * Author:      Mateusz Krupnik
 * License:     GPLv2+
 */


class OWN_Field_Slider {

	const VERSION = '0.1.0';

	public function hooks() {
		add_filter( 'cmb2_render_own_slider',  array( $this, 'own_slider_field' ), 10, 5 );
	}

	public function own_slider_field( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {

		// Only enqueue scripts if field is used.
		$this->setup_admin_scripts();

		echo '<div class="own-slider-field"></div>';

		echo $field_type_object->input( array(
			'type'       => 'hidden',
			'class'      => 'own-slider-field-value',
			'readonly'   => 'readonly',
			'data-start' => absint( $field_escaped_value ),
			'data-min'   => $field->min(),
			'data-max'   => $field->max(),
			'desc'       => '',
		) );

		echo '<span class="own-slider-field-value-display">'. $field->value_label() .' <span class="own-slider-field-value-text"></span></span>';

		$field_type_object->_desc( true, true );
	}

	public function setup_admin_scripts( ) {

		wp_enqueue_script( 'cmb2_field_slider_js',  get_template_directory_uri() . '/lib/u-design-cmb2/cmb2/3rd-party-resources/cmb2-field-slider/js/cmb2_field_slider.js', array( 'jquery', 'jquery-ui-slider' ), self::VERSION );

                /* BEGIN: U-Design Edit: Load Google jQuery UI Theme from Google's CDN */
                global $wp_scripts;
                wp_enqueue_script('jquery-ui-core');
                // get the jquery ui object
                $queryui = $wp_scripts->query('jquery-ui-core');
                // load the jquery ui theme
                $scheme = is_ssl() ? 'https://' : 'http://';
                $url = $scheme . "code.jquery.com/ui/".$queryui->ver."/themes/smoothness/jquery-ui.min.css";
                wp_enqueue_style('udesign-optns-slider-ui', $url, false, null);
                /* END: U-Design Edit: Load Google jQuery UI Theme from Google's CDN */
                
		wp_enqueue_style( 'cmb2_field_slider_css', get_template_directory_uri() . '/lib/u-design-cmb2/cmb2/3rd-party-resources/cmb2-field-slider/css/cmb2_field_slider.css', array( 'udesign-optns-slider-ui' ), self::VERSION );

	}
}
$own_field_slider = new OWN_Field_Slider();
$own_field_slider->hooks();

