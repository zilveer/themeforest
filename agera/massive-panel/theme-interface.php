<?php

function mp_display_content() {
	global $allowedtags;
	global $shortname;
	$shortname = "agera";
	// get the settings section array
	$settings_output	= mp_get_settings();
	$mp_option_name		= $settings_output[$shortname.'_option_name'];
	$mp_settings		= get_option($mp_option_name);

	if(isset($mp_settings['id'])) {
		$option_name = $mp_settings['id'];
	} else {
		$option_name = $mp_option_name;
	}

	$settings = get_option($option_name);
	$options = mp_options();

	$counter = 0;
	$menu = '<ul>';
	$tabs = '';
	$output = '';
	$header = '';
	$section_name = '';
	$begin_tabs = true;
	$desc = '';
	$hide = 'false';

	foreach($options as $value) {
		$counter++;
		$val = ''; // used to store save value of a field;
		$select_value = '';
		$checked = '';
		$desc = 'right';
		$hide = 'false';


		if (isset( $value['desc-pos'])) {
			$desc = $value['desc-pos'];
		}

		// Wrap all options
		if (($value['type'] != "heading") && ($value['type'] != "section")  && ($value['type'] != "top-header") && ($value['type'] != "top-socials")) {

			// convert ids to lowercase with no spaces
			$value['id'] = preg_replace('/\W/', '', strtolower($value['id']) );
			$id = 'field-' . $value['id'];
			$class = 'field ';

			if ( isset( $value['type'] ) ) {
				$class .= ' field-' . $value['type'];
			}

			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div id="' . esc_attr( $id ) .'" class="' . esc_attr( $class ) . '">'."\n";

			if($value['type'] != 'info')
				$output .= '<h4 class="heading">' . esc_html( $value['name'] ) . '</h4>' . "\n";
			else
				$output .= '<h4 class="heading"></h4>' . "\n";

			if($value['type'] == "choose-sidebar") {
				$output .= '<div class="option">' . "\n" . '<div class="controls controls-sidebar">' . "\n";
			} elseif ($value['type'] == "choose-portfolio") {
				$output .= '<div class="option">' . "\n" . '<div class="controls controls-portfolio">' . "\n";
			} else {
				$output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
			}

		 }

		 // Set default value to $val
		if (isset($value['std'])) {
			$val = $value['std'];
		}

		// If the option is already saved, ovveride $val
		if (($value['type'] != 'heading') && ($value['type'] != "section") && ($value['type'] != 'info') && ($value['type'] != "top-header") && ($value['type'] != "top-socials") ) {
			if ( isset($settings[($value['id'])]) ) {
					$val = $settings[($value['id'])];
					// Striping slashes of non-array options
					if (!is_array($val) ) {
						$val = stripslashes($val);
					}
			}
		}

		if(isset($value['hide']) && $value['hide']['state'] == 'true') {
			$hide = 'true';

			if(isset($value['hide']['related'])) {
				$output .= '<div class="mp-related-object" style="display: none;">'.$value['hide']['related'].'</div>';
			}

			if(isset($settings[($value['id'].'_checkbox')])) {
				$output .= '<input id="' . esc_attr( $value['id'] ) . '_checkbox" class="checkbox-ios-style of-input hide-checkbox" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . '_checkbox]' ) . '" '. checked(stripslashes($settings[($value['id'].'_checkbox')]), 1, false) .' />';
			} elseif(isset($value['hide']['std']) && $value['hide']['std'] == 'checked') {
				$output .= '<input id="' . esc_attr( $value['id'] ) . '_checkbox" class="checkbox-ios-style of-input hide-checkbox" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . '_checkbox]' ) . '" checked />';
			} else {
				$output .= '<input id="' . esc_attr( $value['id'] ) . '_checkbox" class="checkbox-ios-style of-input hide-checkbox" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . '_checkbox]' ) . '"/>';
			}

			$output .= '<div class="description desc-hide">' . wp_kses( $value['hide']['desc'], $allowedtags) . '</div>'."\n";
			$output .= '<div class="'.$value['id'].'_wrap hide-wrap">';
		} else {
			$hide = 'false';
		}


		$description = '';
		if ( isset( $value['desc'] ) ) {
			$description = $value['desc'];
		}

		if($desc == 'top') {
			$output .= '<div class="description-top">' . wp_kses( $description, $allowedtags) . '</div>'."\n";
		}

		switch ($value['type']) {
			// Basic text input
			case 'text-small':
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="mp-input-small mp-input-border" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
			break;

			case 'text-big':
				/*$desc = 'bottom';*/
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="mp-input-big mp-input-border" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
			break;

			// Textarea
			case 'textarea':
				$cols = '35';
				$ta_value = '';
				$val = stripslashes($val);

				$output .= '<textarea id="' . $value['id'] . '" class="mp-textarea mp-input-border displayall" name="' . $option_name . '[' . $value['id'] . ']' . '" cols="'. $cols. '" rows="8">' . $val . '</textarea>';
			break;

			// Textarea Big
			case 'textarea-big':
				$cols = '86';
				$ta_value = '';
				$val = stripslashes($val);

				$output .= '<textarea id="' . $value['id'] . '" class="mp-textarea mp-input-border displayall" name="' . $option_name . '[' . $value['id'] . ']' . '" cols="'. $cols. '" rows="8">' . $val . '</textarea>';
			break;

			// Select Box
			case "select":
				$output .= '<select class="mp-dropdown" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '">';

				foreach ($value['options'] as $key => $option ) {
					$selected = '';
					 if( $val != '' ) {
						 if ( $val == $key) {
						 	$selected = ' selected="selected"';
						 }
			     }
				 $output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			 }
				 $output .= '</select>';
			break;

			// Radio Box
			case "radio":
				$name = $option_name .'['. $value['id'] .']';
				foreach ($value['options'] as $key => $option) {
					$id = $option_name . '-' . $value['id'] .'-'. $key;
					$output .= '<input class="mp-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .' /><label class="mp-radio-label" for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label>';
			}
			break;

			// Checkbox
			case "checkbox":
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" '. checked($val, 1, false) .' />';
			break;

			// Checkbox iOS
			case "checkbox-ios":
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="checkbox-ios-style of-input" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" '. checked($val, 1, false) .' />';
			break;

			// Multicheck
			case "multicheck":
				foreach ($value['options'] as $key => $option) {
					$checked = '';
					$label = $option;
					$option = preg_replace('/\W/', '', strtolower($key));

					$id = $option_name . '-' . $value['id'] . '-'. $option;
					$name = $option_name . '[' . $value['id'] . '][' . $option .']';

				    if ( isset($val[$option]) ) {
						$checked = checked($val[$option], 1, false);
					} else {
						$checked = 'false';
					}

					$output .= '<input id="' . esc_attr( $id ) . '" class="checkbox mp-input-multicheck" type="checkbox" name="' . esc_attr( $name ) . '"checked=" ' . $checked . '" /><label class="mp-input-multicheck-label" for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
				}
			break;

			// module to setup sidebar position for each page
			case "choose-sidebar":

				$output .= '<select class="mp-dropdown mp-dropdown-sidebar" name="' . esc_attr( $option_name . '[' . $value['id'] . '][sb_choose_' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '_choose_sb">';
				//print_r($val);
				foreach ($value['options-pages'] as $key => $option) {
					$selected = '';
					if( $val != '' ) {
						if ( $val['sb_choose_' . $value['id']] == $key) {
							$selected = ' selected="selected"';
						}
			     	}
					$output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			    }
				$output .= '</select>';

				// end select

				$template_url = get_template_directory_uri();
				foreach ($value['options-pages'] as $key => $option) {
					$radio_set_index = $key;
					$output .= '<div class="radio_set" id="radio_set_' . $radio_set_index . '" style="display:none;">';
					$checked = false;

					foreach ($value['options-radio'] as $key => $option) {
						$name = $option_name.'['. $value['id'] .'][radio_sb_' . $radio_set_index.']';
						$id = $option_name . '_' . $value['id'] .'_'. $key. '_' .$radio_set_index ;
						$output .= '<div class="mp-section-sidebar"><img class="mp-image-sidebar" src="' . $template_url . '/massive-panel/images/sidebar-' . $key . '.png"/>';
						if(isset($val['radio_sb_' . $radio_set_index]) && $val['radio_sb_' . $radio_set_index] == $key && !$checked){
							$output .= '<input class="mp-radio mp-radio-sidebar" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" checked/>';
							$checked = true;
						} elseif($key == "right" && !$checked) { // default checked
							$output .= '<input class="mp-radio mp-radio-sidebar" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" checked/>';
						} else {
							$output .= '<input class="mp-radio mp-radio-sidebar" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '"/>';
						}

						$output .= '<label class="mp-radio-label mp-label-sidebar" for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label></div>';
					}
					$output .= '</div>';
				}

				// sidebar checkbox
				foreach ($value['options-pages'] as $key => $option) {
					$radio_set_index = $key;
					$output .= '<div class="layout_sidebar_radio" id="layout_sidebar_radio_' . $radio_set_index . '" style="display:none;">';
					$checked = false;

					$name = $option_name.'['. $value['id'] .'][sidebar_' . $radio_set_index.']';
					$id = $option_name . '_' . $value['id'] .'_' .$radio_set_index. '_sidebar';

					if(isset($val['sidebar_' . $radio_set_index]) && $val['sidebar_' . $radio_set_index] == "on" && !$checked){
						$output .= '<input class="mp-checkbox mp-radio-sidebar-unique" type="checkbox" name="' .$name. '" id="' . esc_attr( $id ) . '"   checked/>';
						$checked = true;
					} else {
						$output .= '<input class="mp-checkbox mp-radio-sidebar-unique" type="checkbox" name="' .$name. '" id="' . esc_attr( $id ) . '" />';
					}

					$output .= '<label class="mp-layout-label mp-label-sidebar-unique" for="' . esc_attr( $id ) . '">' . esc_html($value['sidebar-unique-description'] ) . '</label></div>';
				}

				// footer checkbox
				foreach ($value['options-pages'] as $key => $option) {
					$radio_set_index = $key;
					$output .= '<div class="layout_footer_radio" id="layout_footer_radio_' . $radio_set_index . '" style="display:none;">';
					$checked = false;

					$name = $option_name.'['. $value['id'] .'][footer_' . $radio_set_index.']';
					$id = $option_name . '_' . $value['id'] .'_' .$radio_set_index. '_footer';

					if(isset($val['footer_' . $radio_set_index]) && $val['footer_' . $radio_set_index] == "on" && !$checked){
						$output .= '<input class="mp-checkbox mp-radio-footer-unique" type="checkbox" name="' .$name. '" id="' . esc_attr( $id ) . '"  checked/>';
						$checked = true;
					} else {
						$output .= '<input class="mp-checkbox mp-radio-footer-unique" type="checkbox" name="' .$name. '" id="' . esc_attr( $id ) . '" />';
					}

					$output .= '<label class="mp-layout-label mp-label-footer-unique" for="' . esc_attr( $id ) . '">' . esc_html($value['footer-unique-description'] ) . '</label></div>';
				}

				// footer columns select
				foreach ($value['options-pages'] as $key => $option) {
					$columns_set_index = $key;
					$output .= '<div id="unique_footer_columns_' .$columns_set_index. '" class="unique_footer_columns" style="display:none;">';
					$output .= '<select class="mp-dropdown mp-dropdown-footer-columns" name="' . esc_attr( $option_name . '[' . $value['id'] . '][footer_columns_' . $columns_set_index . ']' ) . '" id="' . esc_attr( $columns_set_index ) . '_choose_columns_number">';
					//print_r($val);
					foreach ($value['options-columns'] as $key => $option) {
						$selected = '';
						if( $val != '' ) {
							if ( isset($val['footer_columns_' . $columns_set_index]) && $val['footer_columns_' . $columns_set_index] == $key) {
								$selected = ' selected="selected"';
							}
			     		}
						$output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			    	}
					$output .= '</select>';

					$output .= '<label class="mp-layout-label mp-label-footer-columns" for="' . esc_attr( $id ) . '">' . esc_html($value['footer-columns-decription'] ) . '</label></div>';
				}

			break;

			case "choose-sidebar-small":

				$output .= '<select class="mp-dropdown mp-dropdown-sidebar-small" name="' . esc_attr( $option_name . '[' . $value['id'] . '][sb_choose_' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '_choose_sb">';
				foreach ($value['options-pages'] as $key => $option) {
					$selected = '';
					if( $val != '' ) {
						if ( $val['sb_choose_' . $value['id']] == $key) {
							$selected = ' selected="selected"';
						}
			     	}
					$output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			    }
				$output .= '</select>';

				// end select

				$template_url = get_template_directory_uri();
				foreach ($value['options-pages'] as $key => $option) {
					$radio_set_index = $key;
					$output .= '<div class="radio_set_small" id="radio_set_small_' . $radio_set_index . '" style="display:none;">';
					$checked = false;

					foreach ($value['options-radio'] as $key => $option) {
						$name = $option_name.'['. $value['id'] .'][radio_sb_' . $radio_set_index.']';
						$id = $option_name . '_' . $value['id'] .'_'. $key. '_' .$radio_set_index ;
						$output .= '<div class="mp-section-sidebar"><img class="mp-image-sidebar" src="' . $template_url . '/massive-panel/images/sidebar-' . $key . '.png"/>';
						if(isset($val['radio_sb_' . $radio_set_index]) && $val['radio_sb_' . $radio_set_index] == $key && !$checked){
							$output .= '<input class="mp-radio mp-radio-sidebar" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" checked/>';
							$checked = true;
						} elseif($key == "right" && !$checked) { // default checked
							$output .= '<input class="mp-radio mp-radio-sidebar" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" checked/>';
						} else {
							$output .= '<input class="mp-radio mp-radio-sidebar" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '"/>';
						}

						$output .= '<label class="mp-radio-label mp-label-sidebar" for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label></div>';
					}
					$output .= '</div>';
				}

			break;


			// module to setup portfolio settings like number of columns, number of posts ect.
			case "choose-portfolio":
				//$desc = 'top';
				$columns_4 = array("4" => "4", "8" => "8", "12" => "12", "16" => "16" , "20" => "20");
				$columns_3 = array("3" => "3", "6" => "6", "9" => "9", "12" => "12");
				$columns_2 = array("2" => "2", "4" => "4", "6" => "6", "8" => "8", "10" => "10");
				$columns_1 = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10" );
				$output .= '<div class="portfolio-section"><label class="mp-portfolio-label">' . esc_attr( $value['desc-portfolio-page'] ) . '</label><select class="mp-dropdown mp-dropdown-portfolio" name="' . esc_attr( $option_name . '[' . $value['id'] . '][portfolio_choose_' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '_choose_portfolio">';
				//print_r($val);
				foreach ($value['portfolio-pages'] as $key => $option) {

					$selected = '';
					if( $val != '' ) {
						if ( isset($val['portfolio_choose_' . $value['id']]) && $val['portfolio_choose_' . $value['id']] == $key) {
							$selected = ' selected="selected"';
						}
			     	}
					$output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			    }
				$output .= '</select></div>';
				// end select

				foreach ($value['portfolio-pages'] as $key => $option) {
					$radio_set_index = $key;
					$output .= '<div class="portfolio_option_set" id="portfolio_set_' . $radio_set_index . '" style="display:none;">';
					$output .= '<div class="portfolio-section"><select class="mp-dropdown mp-dropdown-portfolio-columns" name="' . esc_attr( $option_name . '[' . $value['id'] . '][portfolio_columns_' . $radio_set_index . ']' ) . '" id="' . esc_attr( $value['id'] ) . '_portfolio_columns">';
					foreach ($value['options-columns'] as $key => $option) {

						$selected = '';
						if( $val != '' ) {
							if ( isset($val['portfolio_columns_' . $radio_set_index]) && $val['portfolio_columns_' . $radio_set_index] == $key) {
								$selected = ' selected="selected"';
							}
				     	}
						$output .= '<option'. $selected .' value="' . esc_attr( $option ) . '">' . esc_html( $option ) . '</option>';
			  	 	 }
					 $output .= '</select><label class="mp-portfolio-label">' . esc_attr( $value['desc-columns'] ) . '</label></div>';
					 $array = array();
					 $output .= '<div class="portfolio-section"><label class="mp-portfolio-label">' . esc_attr( $value['desc-posts'] ) . '</label>';
					 for($i = 1; $i < 5; $i++){
						$output .= '<select class="mp-dropdown mp-dropdown-portfolio-posts mp_portfolio_posts_' . esc_attr( $i ) . '" name="' . esc_attr( $option_name . '[' . $value['id'] . '][portfolio_posts_' . $radio_set_index . '_' . $i . ']' ) . '" id="mp_portfolio_posts_' . esc_attr( $i ) . '" style="display:none;">';
						if($i == 1)
							$array = $columns_1;
						elseif($i == 2)
							$array = $columns_2;
						elseif($i == 3)
							$array = $columns_3;
						elseif($i == 4)
							$array = $columns_4;
					   	foreach ($array as $key => $option) {

							$selected = '';
							if( $val != '' ) {
								if ( isset($val['portfolio_posts_' . $radio_set_index . '_' . $i ]) && $val['portfolio_posts_' . $radio_set_index . '_' . $i] == $key) {
									$selected = ' selected="selected"';
								}
				     		}
							$output .= '<option'. $selected .' value="' . esc_attr( $option ) . '">' . esc_html( $option ) . '</option>';
			  	 		 }
						 $output .= '</select>';
					}
					$output .= '</div>';
					$output .= '<div class="portfolio-section"><label class="mp-portfolio-label">' . esc_attr( $value['desc-categories'] ) . '</label>';
					$index = 0;
					foreach ($value['options-categories'] as $key => $option) {

						$name = $option_name.'['. $value['id'] .'][category_portfolio_' . $radio_set_index.'][' . $key . ']';
						$id = $option_name . '_' . $value['id'] .'_'. $key. '_' .$radio_set_index ;

						$output .= '<div class="mp-checkboxes-portfolio">';

						if(isset($val['category_portfolio_' . $radio_set_index]) && isset($val['category_portfolio_' . $radio_set_index][$key]) && $val['category_portfolio_' . $radio_set_index][$key] == $option){
							if($index == 0) {
								$output .= '<input class="checkbox mp-checkbox checkbox-first" type="checkbox" name="' . esc_attr( $name ) . esc_attr( $key ) .   '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $option ) . '" checked/>';
							} else {
								$output .= '<input class="checkbox mp-checkbox" type="checkbox" name="' . esc_attr( $name ) . esc_attr( $key ) .   '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $option ) . '" checked/>';
							}
						} else {
							if($index == 0)	{
								$output .= '<input class="checkbox mp-checkbox checkbox-first" type="checkbox" name="' . esc_attr( $name ) . esc_attr( $key ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $option ) . '"/>';
							} else {
								$output .= '<input class="checkbox mp-checkbox" type="checkbox" name="' . esc_attr( $name ) . esc_attr( $key ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $option ) . '"/>';
							}
						}

						if($index == 0){
							$output .= '<label class="mp-checkbox-label label-first" for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label></div>';
						} else {
							$output .= '<label class="mp-checkbox-label" for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label></div>';
						}

						$index++;
					}

					 $output .= '</div>';
					 $output .= '</div>';
				}

			break;

			// multi checkbox
			case "multi-checkbox":

				foreach ($value['options'] as $key => $option) {

						$name = $option_name.'['. $value['id'] .'][' . $key . ']';
						$id = $option_name . '_' . $value['id'] .'_'. $key ;

						if( isset($val[$key]) && $val[$key] == $option){
							$output .= '<input class="multi-checkbox mp-checkbox" type="checkbox" name="' . esc_attr( $name ) . esc_attr( $key ) .   '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $option ) . '" checked/>';
						} else {
							$output .= '<input class="multi-checkbox mp-checkbox" type="checkbox" name="' . esc_attr( $name ) . esc_attr( $key ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $option ) . '"/>';
						}

						$output .= '<label class="mp-checkbox-label" for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label>';
					}

			break;

			// Uploader
			case "upload":
				$output .= mp_medialibrary_uploader($value['id'], $val, null); // New AJAX Uploader using Media Library
			break;

			// Multi-Uploader
			case "multi-upload":
				$output .= mp_medialibrary_multi_uploader($value['id'], $val, null); // New AJAX Uploader using Media Library
			break;

			// image chooser
			case "choose-image":
				$name = $option_name .'['. $value['id'] .']';

				foreach($value['options'] as $key => $option){
					$output .= '<div class="option-image-element"><div class="option-image-frame"></div><img src="'.get_template_directory_uri().'/massive-panel/images/'.$option. '"/>';
					$id = $option_name . '-' . $value['id'] .'-'. $key;
					$output .= '<input class="mp-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $option ) . '" '. checked( $val, $option, false) .' />';

					if($value['image-desc'] == "true")
						$output .= '<label class="mp-radio-label" for="' . esc_attr( $id ) . '">' . esc_html( $key ) . '</label>';

					$output .= '</div>';
				}
			break;

			// Color picker
			case "color":
				$output .= '<div id="' . esc_attr( $value['id'] . '_picker' ) . '" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $val ) . '"></div></div>';
				$output .= '<input class="mp-color mp-input-border" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '" type="text" value="' . esc_attr( $val ) . '" />';
			break;

			// Info
			case "info":
				$output .= '<span id="' .esc_attr( $value['id']). '" class="info box-' .$value['color']. '">' .$value['desc']. '</span>';
			break;

			// Heading for Tabs
			case "heading":
				if($counter >= 2){
			  		$output .= '</div>'."\n";
				}

				$jquery_click_hook = preg_replace('/\W/', '', strtolower($value['name']) );
				$jquery_click_hook = "mp-option-" . $jquery_click_hook;
				if($begin_tabs){
					$tabs .= '<ul class="tab-group" id="' .$section_name. '-tab">';
					$begin_tabs = false;
				}
				$tabs .= '<li class="button-tab"><a id="'.  esc_attr( $jquery_click_hook ) . '-tab" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#'.  $jquery_click_hook ) . '"><span class="tab-bg-left"></span><span class="tab-bg-center"><span class="tab-text">' . esc_html( $value['name'] ) . '</span></span><span class="tab-bg-right"></span></a></li>';
				$output .= '<div class="group" id="' . esc_attr( $jquery_click_hook ) . '">';
				break;

			// Sidebar navigation
			case "section":
				if($counter >= 2){
			  		$output .= '</div>'."\n";
			  		$tabs .= '</ul>'; // end tabs;
			  		$begin_tabs = true;
				}

				$jquery_click_hook = preg_replace('/\W/', '', strtolower($value['name']) );
				$jquery_click_hook = "mp-section-" . $jquery_click_hook;
				$section_name = $jquery_click_hook;
				$menu .= '<li class="button-sidebar"><img class="button-icon" src="'.get_template_directory_uri().'/massive-panel/images/icons/'. $value['icon'] .'"/><a id="'.  esc_attr( $jquery_click_hook ) . '-button" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#'.  $jquery_click_hook ) . '"><label>' . esc_html( $value['name'] ) . '</label><span class="button-sidebar-bg"></span><span class="empty"></span></a></li>';
				$output .= '<div class="section-group" id="' . esc_attr( $jquery_click_hook ) . '">';
			break;

			case "top-socials":
				$header .= '<ul class="socials">';
				foreach($value['options'] as $key) {
					$header .= '<li class="social"><a href="' .$key[2]. '"><img src="' .get_template_directory_uri().'/massive-panel/images/icons/social/' . $key[0] . '"/></a><span>' . $key[1] . '</span></li>';
				}

				$header .= '</ul>';
			break;


			case "top-header":
				$header .= '<h2 class="main-header">' . esc_attr( $value['name'] ) . '</h2>';
				$header .= '<h3 class="main-desc">' . esc_attr( $value['desc'] ) . '</h3>';
			break;

		}

		if (($value['type'] != "heading") && ($value['type'] != "section")  && ($value['type'] != "top-header") && ($value['type'] != "top-socials")) {

			if ($value['type'] != "checkbox") {
				$output .= '<br/>';
			}
			// this code is for the descript & help
			if (isset($value['help']) && $value['help'] == "true") {
				$output .= '</div><div class="help-icon"></div>';
			} else {
				$output .= '</div>';
			}

			$description = '';
			if ( isset( $value['desc'] ) ) {
				$description = $value['desc'];
			}

			if($desc == 'bottom' && ($value['type'] != "info")) {
				$output .= '<div class="description-bottom">' . wp_kses( $description, $allowedtags) . '</div>'."\n";
			} elseif($desc == 'right' && ($value['type'] != "info")) {
				$output .= '<div class="description">' . wp_kses( $description, $allowedtags) . '</div>'."\n";
			}
			// the end of description code
			if($hide == 'true') {
				$output .= '</div>';
			}
			$output .= '<div class="clear"></div></div></div>'."\n";

		}
	}
	$tabs .= '</ul>';
	$menu .= '</ul>';
    $output .= '</div>';
    return array($output, $menu, $tabs, $header);
}

?>