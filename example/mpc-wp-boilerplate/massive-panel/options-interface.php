<?php

/**
 * Generates the tabs that are used in the options menu
 */

function mpcth_optionsframework_tabs() {

	$mpcth_optionsframework_settings = get_option('mpcth_optionsframework');
	$mpcth_options = mpcth_optionsframework_options();
	$mpcth_menu = '';

	foreach ($mpcth_options as $value) {
		// Heading for Navigation
		if ($value['type'] == "heading") {
			$jquery_click_hook = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['name']) );
			$jquery_click_hook = "mpcth-of-option-" . $jquery_click_hook;
			$mpcth_menu .= '<a id="'.  esc_attr( $jquery_click_hook ) . '-tab" class="nav-tab" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#'.  $jquery_click_hook ) . '"><span class="'.esc_attr( $value['icon'] ).'"></span>' . esc_html( $value['name'] ) . '</a>';
		}
	}

	return $mpcth_menu;
}

function mpcth_optionsframework_fonts($mpcth_settings) {
	if( isset($mpcth_settings['mpcth_font_upload']) &&
		isset($mpcth_settings['mpcth_font_upload']['name']) && $mpcth_settings['mpcth_font_upload']['name'] != '' &&
		isset($mpcth_settings['mpcth_font_upload']['source']) && $mpcth_settings['mpcth_font_upload']['source'] != '') {
		$mpcth_custom_fonts = get_option('mpcth_custom_fonts', array());

		$name = $mpcth_settings['mpcth_font_upload']['name'];
		$source = $mpcth_settings['mpcth_font_upload']['source'];
		$valid_source = true;
		$added = false;

		$file_headers = @get_headers($source);
		if($file_headers == false || strpos($file_headers[0], '404 Not Found') !== false)
			$valid_source = false;

		foreach($mpcth_custom_fonts as &$font) {
			$file = $font['source'];
			$file_headers = @get_headers($file);
			
			if($file_headers == false || strpos($file_headers[0], '404 Not Found') !== false)
				unset($mpcth_custom_fonts[array_search($font, $mpcth_custom_fonts)]);
			else
				if($font['name'] == $name && $valid_source) {
					$font['source'] = $source;
					$added = true;
				}
		}

		if(!$added && $valid_source)
			$mpcth_custom_fonts[] = array('name' => $name, 'source' => $source );

		update_option('mpcth_custom_fonts', $mpcth_custom_fonts);
	}
}

/**
 * Generates the options fields that are used in the form.
 */

function mpcth_optionsframework_fields() {

	global $allowedtags;
	$mpcth_optionsframework_settings = get_option('mpcth_optionsframework');

	// Gets the unique option id
	if ( isset( $mpcth_optionsframework_settings['id'] ) ) {
		$mpcth_option_name = $mpcth_optionsframework_settings['id'];
	} else {
		$mpcth_option_name = 'mpcth_optionsframework';
	}
	// print_r($mpcth_option_name);
	$mpcth_settings = get_option($mpcth_option_name);
	$mpcth_options = mpcth_optionsframework_options();

	$counter = 0;
	$menu = '';
	$first_tab = true;
	$tabs = false;

	mpcth_optionsframework_fonts($mpcth_settings);

	foreach ($mpcth_options as $value) {

		$counter++;
		$val = '';
		$select_value = '';
		$checked = '';
		$output = '';

		// Wrap all options
		if (($value['type'] != "heading") && ($value['type'] != "accordion") && ( $value['type'] != "info" )) {

			// Keep all ids lowercase with no spaces
			$value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']) );

			$id = 'section-' . $value['id'];

			$class = 'mpcth-of-section ';

			if ( isset( $value['type'] ) ) {
				$class .= ' mpcth-of-section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div id="' . esc_attr( $id ) .'" class="' . esc_attr( $class ) . '">'."\n";
			if ( isset( $value['name'] ) ) {
				$output .= '<h4>' . esc_html( $value['name'] ) . '</h4>' . "\n";
			}
			if ( $value['type'] != 'editor' ) {
				$output .= '<div class="mpcth-of-option">' . "\n" . '<div class="mpcth-of-controls">' . "\n";
			} else {
				$output .= '<div class="mpcth-of-option">' . "\n" . '<div>' . "\n";
			}
		}

		// Set default value to $val
		if ( isset( $value['std'] ) ) {
			$val = $value['std'];
		}

		// If the option is already saved, ovveride $val
		if ( ( $value['type'] != 'heading' ) && ( $value['type'] != 'accordion' ) && ( $value['type'] != 'info') ) {
			if ( isset( $mpcth_settings[($value['id'])]) ) {
				$val = $mpcth_settings[($value['id'])];
				// Striping slashes of non-array options
				if ( !is_array($val) ) {
					$val = stripslashes( $val );
				}
			}
		}

		// If there is a description save it for labels
		$explain_value = '';
		if ( isset( $value['desc'] ) ) {
			$explain_value = $value['desc'];
		}

		switch ( $value['type'] ) {

		// Basic text input
		case 'text-big':
		case 'text':
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
			break;

		// Textarea
		case 'textarea-big':
		case 'textarea':
			$rows = '8';

			if ( isset( $value['settings']['rows'] ) ) {
				$custom_rows = $value['settings']['rows'];
				if ( is_numeric( $custom_rows ) ) {
					$rows = $custom_rows;
				}
			}

			$val = stripslashes( $val );
			$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '">' . esc_textarea( $val ) . '</textarea>';
			break;

		// Font Select Box
		case 'font_select':
			if(isset($mpcth_settings[($value['id'])]['family'])) {
				$family = $mpcth_settings[($value['id'])]['family'];

				if(!is_array($family) ) $family = stripslashes( $family );
			}
			else {
				$family = 'default';
			}

			if(isset($mpcth_settings[($value['id'])]['style'])) {
				$style = $mpcth_settings[($value['id'])]['style'];

				if(!is_array($style) ) $style = stripslashes( $style );
			}
			else {
				$style = 'default';
			}

			$opt = 0;
			if(isset($value['additional_fun']) && $value['additional_fun'] == 'hide')
				$hide = "hide";
			else
				$hide = '';

			$output .= '<select class="of-input of-input-font" data-hide="'.$hide.'" name="' . $mpcth_option_name . '[' . esc_attr( $value['id'] ) . '][family]' . '" id="' . esc_attr( $value['id'] ) . '">';

			if(isset($value['options_class']))
				$opt_class = $value['options_class'][$opt];
			else
				$opt_class = '';

			$output .= '<option class="mpcth-option-default ' . $opt_class . '" data-style="default" value="default">' . __('default', 'mpcth') . '</option>';

			$mpcth_custom_fonts = get_option('mpcth_custom_fonts');
			if($mpcth_custom_fonts) {
				$output .= '<optgroup label="Cufon">';
				foreach($mpcth_custom_fonts as $font) {
					$output .= '<option class="mpcth-option-cufon ' . $opt_class . '" data-source="' . $font['source'] . '" value="' . $font['name'] . '">' . $font['name'] . '</option>';
				}
				$output .= '</optgroup>';
			}

			$output .= '</select>';
			$output .= '<span class="mpcth-of-select-mockup">';
			$output .= '<span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span>';
			$output .= '</span>';

			$output .= '<input id="' . esc_attr( $value['id'] ) . '_type" class="of-input of-input-font-type of-input-font-hidden" name="' . $mpcth_option_name . '[' . esc_attr( $value['id'] ) . ']' . '[type]" type="text" value="default" />';
			$output .= '<input id="' . esc_attr( $value['id'] ) . '_font-style" class="of-input of-input-font-weight of-input-font-hidden" name="' . $mpcth_option_name . '[' . esc_attr( $value['id'] ) . ']' . '[font-weight]" type="text" value="" />';
			$output .= '<input id="' . esc_attr( $value['id'] ) . '_font-weight" class="of-input of-input-font-style of-input-font-hidden" name="' . $mpcth_option_name . '[' . esc_attr( $value['id'] ) . ']' . '[font-style]" type="text" value="" />';
			$output .= '<input id="' . esc_attr( $value['id'] ) . '_font-source" class="of-input of-input-font-source of-input-font-hidden" name="' . $mpcth_option_name . '[' . esc_attr( $value['id'] ) . ']' . '[font-source]" type="text" value="" />';
			$output .= '<div id="' . esc_attr( $value['id'] ) . '_data" class="mpcth-of-selected-font" data-family="' . $family . '" data-style="' . $style . '" data-type="' . (isset($mpcth_settings[($value['id'])]['type']) ? $mpcth_settings[($value['id'])]['type'] : 'default') . '"></div>';

			$output .= '<div id="' . esc_attr( $value['id'] ) . '_variants" class="of-variants">';

			$name = $mpcth_option_name .'['. $value['id'] .'][style]';
			$id = $mpcth_option_name . '-' . $value['id'] .'-default';
			$output .= '<div >';
			$output .= '<label class="mpcth-of-variant-label" for="' . esc_attr( $id ) . '">default</label>';
			$output .= '<input class="of-input of-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="default" checked="checked" />';
			$output .= '<label for="' . esc_attr( $id ) . '"></label>';
			$output .= '<label class="mpcth-of-variants-preview" for="' . esc_attr( $id ) . '">Short sample text.</label>';
			$output .= '</div>';

			$output .= '</div>';
			break;
			
		// Font Uploader
		case "font_upload":
			if( isset($mpcth_settings['mpcth_font_upload']) &&
				isset($mpcth_settings['mpcth_font_upload']['name']) && $mpcth_settings['mpcth_font_upload']['name'] != '' &&
				isset($mpcth_settings['mpcth_font_upload']['source']) && $mpcth_settings['mpcth_font_upload']['source'] != '') {
				$mpcth_custom_fonts = get_option('mpcth_custom_fonts', array());

				$name = $mpcth_settings['mpcth_font_upload']['name'];
				$source = $mpcth_settings['mpcth_font_upload']['source'];
				$valid_source = true;
				$added = false;

				$file_headers = @get_headers($source);
				if($file_headers == false || strpos($file_headers[0], '404 Not Found') !== false)
					$valid_source = false;

				foreach($mpcth_custom_fonts as &$font) {
					$file = $font['source'];
					$file_headers = @get_headers($file);
					
					if($file_headers == false || strpos($file_headers[0], '404 Not Found') !== false)
						unset($mpcth_custom_fonts[array_search($font, $mpcth_custom_fonts)]);
					else
						if($font['name'] == $name && $valid_source) {
							$font['source'] = $source;
							$added = true;
						}
				}

				if(!$added && $valid_source)
					$mpcth_custom_fonts[] = array('name' => $name, 'source' => $source );

				update_option('mpcth_custom_fonts', $mpcth_custom_fonts);
			}

			$output .= '<input id="' . esc_attr( $value['id'] ) . '[name]" class="of-input of-font-name" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . '][name]' ) . '" type="text" value="' . __('Unique font name', 'mpcth') . '" onfocus="if(this.value==\'' . __('Unique font name', 'mpcth') . '\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\'' . __('Unique font name', 'mpcth') . '\';"/>';
			$output .= mpcth_optionsframework_medialibrary_uploader( $value['id'], '', '', '', 0, 'source' );
			break;

		// Select Box
		case 'select':
			$opt = 0;
			if(isset($value['additional_fun']) && $value['additional_fun'] == 'hide')
				$hide = "hide";
			else
				$hide = '';

			$output .= '<select class="of-input' . ($value['type'] == 'font-select' ? ' of-input-font' : '') . '" data-hide="'.$hide.'" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '">';

			foreach ($value['options'] as $key => $option ) {
				$selected = '';
				if ( $val != '' ) {
					if ( $val == $key) { $selected = ' selected="selected"';}
				}
				if(isset($value['options_class'])) 
					$opt_class = $value['options_class'][$opt];
				else
					$opt_class = '';

				$output .= '<option'. $selected .' class="'.$opt_class.'" value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';

				$opt++;
			}
			$output .= '</select>';
			$output .= '<span class="mpcth-of-select-mockup">';
			$output .= '<span class="mpcth-of-select-border-right"><span></span></span><span class="mpcth-of-select-border-left"></span>';
			$output .= '</span>';
			break;

		// Radio Box
		case "radio":
			$name = $mpcth_option_name .'['. $value['id'] .']';
			foreach ($value['options'] as $key => $option) {
				$id = $mpcth_option_name . '-' . $value['id'] .'-'. $key;
				$output .= '<label for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label><input class="of-input of-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .' /><label for="' . esc_attr( $id ) . '"></label>';
			}
			break;

		// Radio Box - Sidebar
		case "sidebar":
			$inputs = '';
			$name = $mpcth_option_name .'['. $value['id'] .']';
			foreach ($value['options'] as $key => $option) {
				$id = $mpcth_option_name . '-' . $value['id'] .'-'. $key;
				$output .= '<input class="of-input of-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .' />';
				$output .= '<div class="mpcth-of-sb-'.$key.'">';
				$output .= '<span class="mpcth-of-sb-section-right"></span>';
				$output .= '<span class="mpcth-of-sb-section-left"></span></div>';	
			}
			break;

		// Image Selectors
		case "images":
			$name = $mpcth_option_name .'['. $value['id'] .']';

			foreach ( $value['options'] as $key => $option ) {
				$path = MPC_THEME_ROOT . '/mpc-wp-boilerplate/massive-panel/images/';
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<img src="' .MPC_THEME_ROOT . '/mpc-wp-boilerplate/images/'. esc_attr($option) . '" alt="' .MPC_THEME_ROOT . '/mpc-wp-boilerplate/images/'. $option .'" class="of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;" />';
			}
			break;

		// Checkbox
		case "checkbox":

			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="checkbox of-input" type="checkbox" data-hide="'.(isset($value['additional_fun']) ? $value['additional_fun'] : '' ).'" data-class="'.(isset($value['hide_class']) ? $value['hide_class'] : '' ).'" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . ']' ) . '" '. checked( $val, 1, false) .' />';
			
			$output .= '<span class="mpcth-of-switcher"><span class="mpcth-of-switcher-slide"><span class="mpcth-of-switcher-thumb">| | |</span><span class="mpcth-of-switcher-on">ON</span><span class="mpcth-of-switcher-off">OFF</span></span></span>';
			break;

		// slider
		case "slider":
			$output .= '<div class="mpcth-of-slider" data-min="'.$value['min'].'" data-max="'.$value['max'].'"></div><input id="' . esc_attr( $value['id'] ) . '"  name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . ']' ) . '" value="'.$val.'" style="visibility:hidden;" /><label>'.$val.'</label>';
			break;

		// Multicheck
		case "multicheck":
			foreach ($value['options'] as $key => $option) {
				$checked = '';
				$label = $option;
				$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));

				$id = $mpcth_option_name . '-' . $value['id'] . '-'. $option;
				$name = $mpcth_option_name . '[' . $value['id'] . '][' . $option .']';

				if ( isset($val[$option]) ) {
					$checked = checked($val[$option], 1, false);
				}

				$output .= '<input id="' . esc_attr( $id ) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr( $name ) . '" ' . $checked . ' /><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
			}
			break;

		// Color picker
		case "color":
			$output .= '<div id="' . esc_attr( $value['id'] . '_picker' ) . '" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $val ) . '"></div></div>';
			$output .= '<input class="of-color" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '" type="text" value="' . esc_attr( $val ) . '" />';
			break;

		// Uploader
		case "upload":
			$output .= mpcth_optionsframework_medialibrary_uploader( $value['id'], $val, null );
			break;

		// Typography
		case 'typography':
		
			unset( $font_size, $font_style, $font_face, $font_color );
		
			$typography_defaults = array(
				'size' => '',
				'face' => '',
				'style' => '',
				'color' => ''
			);
			
			$typography_stored = wp_parse_args( $val, $typography_defaults );
			
			$typography_options = array(
				'sizes' => mpcth_of_recognized_font_sizes(),
				'faces' => mpcth_of_recognized_font_faces(),
				'styles' => mpcth_of_recognized_font_styles(),
				'color' => true
			);
			
			if ( isset( $value['options'] ) ) {
				$typography_options = wp_parse_args( $value['options'], $typography_options );
			}

			// Font Size
			if ( $typography_options['sizes'] ) {
				$font_size = '<select class="of-typography of-typography-size" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . '][size]' ) . '" id="' . esc_attr( $value['id'] . '_size' ) . '">';
				$sizes = $typography_options['sizes'];
				foreach ( $sizes as $i ) {
					$size = $i . 'px';
					$font_size .= '<option value="' . esc_attr( $size ) . '" ' . selected( $typography_stored['size'], $size, false ) . '>' . esc_html( $size ) . '</option>';
				}
				$font_size .= '</select>';
			}

			// Font Face
			if ( $typography_options['faces'] ) {
				$font_face = '<select class="of-typography of-typography-face" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . '][face]' ) . '" id="' . esc_attr( $value['id'] . '_face' ) . '">';
				$faces = $typography_options['faces'];
				foreach ( $faces as $key => $face ) {
					$font_face .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['face'], $key, false ) . '>' . esc_html( $face ) . '</option>';
				}
				$font_face .= '</select>';
			}

			// Font Styles
			if ( $typography_options['styles'] ) {
				$font_style = '<select class="of-typography of-typography-style" name="'.$mpcth_option_name.'['.$value['id'].'][style]" id="'. $value['id'].'_style">';
				$styles = $typography_options['styles'];
				foreach ( $styles as $key => $style ) {
					$font_style .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['style'], $key, false ) . '>'. $style .'</option>';
				}
				$font_style .= '</select>';
			}

			// Font Color
			if ( $typography_options['color'] ) {
				$font_color = '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $typography_stored['color'] ) . '"></div></div>';
				$font_color .= '<input class="of-color of-typography of-typography-color" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $typography_stored['color'] ) . '" />';
			}
	
			// Allow modification/injection of typography fields
			$typography_fields = compact( 'font_size', 'font_face', 'font_style', 'font_color' );
			$typography_fields = apply_filters( 'of_typography_fields', $typography_fields, $typography_stored, $mpcth_option_name, $value );
			$output .= implode( '', $typography_fields );
			
			break;

		// Background
		case 'background':

			$background = $val;

			// Background Color
			$output .= '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $background['color'] ) . '"></div></div>';
			$output .= '<input class="of-color of-background of-background-color" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $background['color'] ) . '" />';

			// Background Image - New AJAX Uploader using Media Library
			if (!isset($background['image'])) {
				$background['image'] = '';
			}

			$output .= mpcth_optionsframework_medialibrary_uploader( $value['id'], $background['image'], null, '',0,'image');
			$class = 'of-background-properties';
			if ( '' == $background['image'] ) {
				$class .= ' hide';
			}
			$output .= '<div class="' . esc_attr( $class ) . '">';

			// Background Repeat
			$output .= '<select class="of-background of-background-repeat" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . '][repeat]'  ) . '" id="' . esc_attr( $value['id'] . '_repeat' ) . '">';
			$repeats = mpcth_of_recognized_background_repeat();

			foreach ($repeats as $key => $repeat) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['repeat'], $key, false ) . '>'. esc_html( $repeat ) . '</option>';
			}
			$output .= '</select>';

			// Background Position
			$output .= '<select class="of-background of-background-position" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . '][position]' ) . '" id="' . esc_attr( $value['id'] . '_position' ) . '">';
			$positions = mpcth_of_recognized_background_position();

			foreach ($positions as $key=>$position) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['position'], $key, false ) . '>'. esc_html( $position ) . '</option>';
			}
			$output .= '</select>';

			// Background Attachment
			$output .= '<select class="of-background of-background-attachment" name="' . esc_attr( $mpcth_option_name . '[' . $value['id'] . '][attachment]' ) . '" id="' . esc_attr( $value['id'] . '_attachment' ) . '">';
			$attachments = mpcth_of_recognized_background_attachment();

			foreach ($attachments as $key => $attachment) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['attachment'], $key, false ) . '>' . esc_html( $attachment ) . '</option>';
			}
			$output .= '</select>';
			$output .= '</div>';

			break;

		// Editor
		case 'editor':
			$output .= '<div class="mpcth-of-explain">' . wp_kses( $explain_value, $allowedtags) . '</div>'."\n";
			echo $output;
			$textarea_name = esc_attr( $mpcth_option_name . '[' . $value['id'] . ']' );
			$default_editor_settings = array(
				'textarea_name' => $textarea_name,
				'media_buttons' => false,
				'tinymce' => array( 'plugins' => 'wordpress' )
			);
			$editor_settings = array();
			if ( isset( $value['settings'] ) ) {
				$editor_settings = $value['settings'];
			}
			$editor_settings = array_merge($editor_settings, $default_editor_settings);
			wp_editor( $val, $value['id'], $editor_settings );
			$output = '';
			break;

		// Info
		case "info":
			$id = '';
			$class = 'mpcth-of-section';
			if ( isset( $value['id'] ) ) {
				$id = 'id="' . esc_attr( $value['id'] ) . '" ';
			}
			if ( isset( $value['type'] ) ) {
				$class .= ' mpcth-of-section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div ' . $id . 'class="' . esc_attr( $class ) . '">' . "\n";
			if ( isset($value['name']) ) {
				$output .= '<h4>' . esc_html( $value['name'] ) . '</h4>' . "\n";
			}
			if ( $value['desc'] ) {
				$output .= apply_filters('mpth_of_sanitize_info', $value['desc'] ) . "\n";
			}
			$output .= '</div>' . "\n";
			break;

		// accordion
		case "accordion":
			$tabs = true;

			if($first_tab){
				$first_tab = false;
				$output .= '<div class="mpcth-of-accordion-heading mpcth-of-ac-open"><h3>'.$value['name'].'</h3><span class="mpcth-of-circle"><span></span></span></div><div class="mpcth-of-accordion-content">';
			} else {
				$output .= '</div><div class="mpcth-of-accordion-heading"><h3>'.$value['name'].'</h3><span class="mpcth-of-circle"><span></span></span></div><div class="mpcth-of-accordion-content">';
			}
			
			break;

		// Heading for Navigation
		case "heading":

			$first_tab = true;
			if($tabs){
				$tabs = false;
				$output .= '</div>'; // close the last tab
			}

			if ($counter >= 2) {
				$output .= '</div>'."\n";
			}
			$jquery_click_hook = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['name']) );
			$jquery_click_hook = "mpcth-of-option-" . $jquery_click_hook;
			$menu .= '<a id="'.  esc_attr( $jquery_click_hook ) . '-tab" class="nav-tab" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#'.  $jquery_click_hook ) . '">' . esc_html( $value['name'] ) . '</a>';
			$output .= '<div class="group" id="' . esc_attr( $jquery_click_hook ) . '">';
			break;
		}

		if (($value['type'] != "heading") && ($value['type'] != "accordion") && ( $value['type'] != "info")) {
			$output .= '</div>';
			if ( ( $value['type'] != "editor" ) ) {
				$output .= '<div class="mpcth-of-explain">' . wp_kses( $explain_value, $allowedtags) . '</div>'."\n";
			}
			$output .= '</div></div>'."\n";
		}

		echo $output;
	}
	echo '</div></div>';
}