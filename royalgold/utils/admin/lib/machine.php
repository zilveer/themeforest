<?php

class Options_Machine {

	function __construct($options) {
		$return = $this->optionsframework_machine($options);
		$this->Inputs = $return[0];
		$this->Menu = $return[1];
		$this->Defaults = $return[2];
	}

	/**
	 * Sanitize & returns default option values if don't exist
	 */
	static function sanitize_option( $value ) {
		$defaults = array(
			"name" => "",
			"desc" => "",
			"id" => "",
			"std" => "",
			"mod" => "",
			"type" => ""
		);
		$value = wp_parse_args( $value, $defaults );
		return $value;
	}

	/**
	 * Process options data and build option fields
	 */
	public static function optionsframework_machine($options) {
		global $smof_output, $smof_details, $smof_data;
		if (empty($options)) return;
		if (empty($smof_data)) $smof_data = of_get_options();
		$data = $smof_data;

		$defaults = array();   
		$counter = 0;
		$menu = '';
		$output = '';
		$update_data = false;

		do_action('optionsframework_machine_before', array(
				'options'	=> $options,
				'smof_data'	=> $smof_data,
			));
		if ($smof_output != "") {
			$output .= $smof_output;
			$smof_output = "";
		}

		foreach ($options as $value) {
			if ($value['type'] != "heading") $value = self::sanitize_option($value);
			$counter++;
			$val = '';

			/* create array of defaults */
			if ($value['type'] == 'multicheck') {
				if (is_array($value['std'])) {
					foreach($value['std'] as $i=>$key) {
						$defaults[$value['id']][$key] = true;
					}
				} else {
						$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
			}

			/* condition start */
			if(!empty($smof_data) || !empty($data)) {
				if (array_key_exists('id', $value) && !isset($smof_data[$value['id']])) {
					$smof_data[$value['id']] = $value['std'];
					if ($value['type'] == "checkbox" && $value['std'] == 0) {
						$smof_data[$value['id']] = 0;
					} else {
						$update_data = true;
					}
				}
				if (array_key_exists('id', $value) && !isset($smof_details[$value['id']])) {
					$smof_details[$value['id']] = $smof_data[$value['id']];
				}

			/* start heading */
			if ( $value['type'] != "heading" ) {
				$class = '';
				if(isset( $value['class'] )) { $class = $value['class']; }

				// hide items in checkbox group
				$fold='';
				if (array_key_exists("fold",$value)) {
					if (isset($smof_data[$value['fold']]) && $smof_data[$value['fold']]) {
						$fold="f_".$value['fold']." ";
					} else {
						$fold="f_".$value['fold']." temphide ";
					}
				}
				$output .= '<div id="section-'.$value['id'].'" class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";
				if($value['name']) $output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
			}

			switch ( $value['type'] ) {

				case 'text': // text input
					$t_value = '';
					$t_value = stripslashes($smof_data[$value['id']]);
					$output .= '<input type="'. $value['type'] .'" class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="'. $t_value .'" />';
					break;

				case 'select': // select option
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
					foreach ($value['options'] as $select_ID => $option) {
						$theValue = $option;
						if (!is_numeric($select_ID)) $theValue = $select_ID;
						$output .= '<option id="' . $select_ID . '" value="'.$theValue.'" ' . selected($smof_data[$value['id']], $theValue, false) . ' />'.$option.'</option>';
					}
					$output .= '</select>';
					break;

				case 'textarea': // textarea option
					$cols = '8';
					$rows = '8';
					$ta_value = '';
					if ( isset($value['options']) ) {
						$ta_options = $value['options'];
						if (isset($ta_options['cols'])) $cols = $ta_options['cols'];
						if (isset($ta_options['rows'])) $rows = $ta_options['rows'];
					}
					$ta_value = stripslashes($smof_data[$value['id']]);
					$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="'. $rows .'">'.$ta_value.'</textarea>';
					break;

				case "radio": // radiobox option
					$checked = (isset($smof_data[$value['id']])) ? checked($smof_data[$value['id']], $option, false) : '';
					foreach($value['options'] as $option=>$name) {
						$output .= '<input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($smof_data[$value['id']], $option, false) . ' /><label class="radio">'.$name.'</label><br/>';
					}
					break;

				case 'checkbox': // checkbox option
					if (!isset($smof_data[$value['id']])) $smof_data[$value['id']] = 0;
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
					$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
					break;

				case 'multicheck': // multiple checkbox option
					if (isset($smof_data[$value['id']])) {
						$multi_stored = $smof_data[$value['id']];
					} else {
						$multi_stored="";
					}
					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';
					}
					break;

				case "color": // color picker
					$default_color = '';
					if ( isset($value['std']) ) $default_color = ' data-default-color="' .$value['std'] . '" ';
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" class="of-color"  type="text" value="' . $smof_data[$value['id']] . '"' . $default_color .' />';
					break;

				case "image": // display a single image
					$src = $value['std'];
					$output .= '<img src="' . $src . '">';
					break;

				case 'images': // images checkbox - use image as checkboxes
					$i = 0;
					$select_value = (isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : '';
					foreach ($value['options'] as $key => $option) {
						$i++;
						$checked = '';
						$selected = '';
						if ( NULL!=checked($select_value, $key, false) ) {
							$checked = checked($select_value, $key, false);
							$selected = 'of-radio-img-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'.$value['id'].'" '.$checked.' />';
						$output .= '<div class="of-radio-img-label">'. $key .'</div>';
						$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
						$output .= '</span>';
					}
					break;

				case "info": // info box
					$info_text = $value['std'];
					$output .= '<div class="of-info">' . $info_text . '</div>';
					break;

				case 'heading': // tab heading
					if($counter >= 2) $output .= '</div>'."\n";
					$class = (isset($value['class'])) ? $value['class'] : $value['name'];
					$header_class = str_replace(' ','',strtolower($class));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($jquery_click_hook))))));
					
					$menu .= '<li class="'. $header_class .'"><a href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
					break;

				case 'slider': // drag & drop slide manager
					$output .= '<div class="slider"><ul id="'.$value['id'].'">';
					$slides = $smof_data[$value['id']];
					$count = count($slides);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order);
					} else {
						$i = 0;
						foreach ($slides as $slide) {
							$oldorder = $slide['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order);
						}
					}
					$output .= '</ul>';
					$output .= '<a href="#" class="button slide_add_button">' . __('Add New Slide','royalgold') . '</a></div>';
					break;

				case 'sorter': // drag & drop block manager
					// make sure to get list of all the default blocks first
					$all_blocks = $value['std'];
					$temp = array(); // holds default blocks
					$temp2 = array(); // holds saved blocks
					foreach($all_blocks as $blocks) {
						$temp = array_merge($temp, $blocks);
					}
					$sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];
					foreach( $sortlists as $sortlist ) {
						$temp2 = array_merge($temp2, $sortlist);
					}
					// now let's compare if we have anything missing
					foreach($temp as $k => $v) {
						if(!array_key_exists($k, $temp2)) $sortlists['disabled'][$k] = $v;
					}
					// now check if saved blocks has blocks not registered under default blocks
					foreach( $sortlists as $key => $sortlist ) {
						foreach($sortlist as $k => $v) {
							if(!array_key_exists($k, $temp)) unset($sortlist[$k]);
						}
						$sortlists[$key] = $sortlist;
					}
					// assuming all sync'ed, now get the correct naming for each block
					foreach( $sortlists as $key => $sortlist ) {
						foreach($sortlist as $k => $v) {
							$sortlist[$k] = $temp[$k];
						}
						$sortlists[$key] = $sortlist;
					}

					$output .= '<div id="'.$value['id'].'" class="sorter">';
					if ($sortlists) {
						foreach ($sortlists as $group=>$sortlist) {
							$output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
							$output .= '<h3>'.$group.'</h3>';
							foreach ($sortlist as $key => $list) {
								$output .= '<input class="sorter-placebo" type="hidden" name="'.$value['id'].'['.$group.'][placebo]" value="placebo">';
								if ($key != "placebo") {
									$output .= '<li id="'.$key.'" class="sortee">';
									$output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
									$output .= $list;
									$output .= '</li>';
								}
							}
							$output .= '</ul>';
						}
					}
					$output .= '</div>';
					break;

				case 'tiles': // background images option
					$i = 0;
					$select_value = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';
					if (is_array($value['options'])) {
						foreach ($value['options'] as $key => $option) { 
							$i++;
							$checked = '';
							$selected = '';
							if(NULL!=checked($select_value, $option, false)) {
								$checked = checked($select_value, $option, false);
								$selected = 'of-radio-tile-selected';  
							}
							$output .= '<span>';
							$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="'.$option.'" name="'.$value['id'].'" '.$checked.' />';
							$output .= '<div class="of-radio-tile-img '. $selected .'" style="background: url('.$option.')" onClick="document.getElementById(\'of-radio-tile-'. $value['id'] . $i.'\').checked = true;"></div>';
							$output .= '</span>';
						}
					}
					break;

				case 'backup': // backup and restore options data
					$instructions = $value['desc'];
					$backup = of_get_options(BACKUPS);
					$init = of_get_options('smof_init');
					if(!isset($backup['backup_log'])) {
						$log = __('No backups yet', 'royalgold');
					} else {
						$log = $backup['backup_log'];
					}
					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>' . __('Last Backup','royalgold') . ' : <span class="backup-log">' . $log . '</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="of_backup_button" class="button">' . __('Backup Options','royalgold') . '</a>';
					$output .= '<a href="#" id="of_restore_button" class="button">' . __('Restore Options','royalgold') . '</a>';
					$output .= '</div>';
					break;

				case 'transfer': // export or import data between different installs
					$instructions = $value['desc'];
					$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($smof_data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
					$output .= '<a href="#" id="of_import_button" class="button">' . __('Import Options','royalgold') . '</a>';
					break;

				case 'select_google_font': // google font field
					$output .= '<select class="select of-input google_font_select" name="'.$value['id'].'" id="'. $value['id'] .'">';
					foreach ($value['options'] as $select_key => $option) {
						$output .= '<option value="'.$select_key.'" ' . selected((isset($smof_data[$value['id']]))? $smof_data[$value['id']] : "", $option, false) . ' />'.$option.'</option>';
					} 
					$output .= '</select>';
					if(isset($value['preview']['text'])){
						$g_text = $value['preview']['text'];
					} else {
						$g_text = '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz';
					}
					if(isset($value['preview']['size'])) {
						$g_size = 'style="font-size: '. $value['preview']['size'] .';"';
					} else { 
						$g_size = '';
					}
					$hide = " hide";
					if ($smof_data[$value['id']] != "none" && $smof_data[$value['id']] != "")
						$hide = "";
					$output .= '<p class="'.$value['id'].'_ggf_previewer google_font_preview'.$hide.'" '. $g_size .'>'. $g_text .'</p>';
					break;

				case 'sliderui': // JQuery UI Slider
					$s_val = $s_min = $s_max = $s_step = $s_edit = '';
					$s_val = stripslashes($smof_data[$value['id']]);
					if(!isset($value['min'])) {
						$s_min  = '0';
					} else {
						$s_min = $value['min'];
					}
					if(!isset($value['max'])) {
						$s_max  = $s_min + 1;
					} else {
						$s_max = $value['max'];
					}
					if(!isset($value['step'])) {
						$s_step  = '1';
					} else {
						$s_step = $value['step'];
					}
					if(!isset($value['edit'])) { 
						$s_edit  = ' readonly="readonly"'; 
					} else {
						$s_edit  = '';
					}
					if ($s_val == '') {
						$s_val = $s_min;
					}
					$s_data = 'data-id="'.$value['id'].'" data-val="'.$s_val.'" data-min="'.$s_min.'" data-max="'.$s_max.'" data-step="'.$s_step.'"';
					$output .= '<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'. $s_val .'" class="mini" '. $s_edit .' />';
					$output .= '<div id="'.$value['id'].'-slider" class="smof_sliderui" style="margin-left: 7px;" '. $s_data .'></div>';
					break;

				case 'switch': // switch option
					if (!isset($smof_data[$value['id']])) $smof_data[$value['id']] = 0;
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="s_fld ";
					$cb_enabled = $cb_disabled = '';
					if ($smof_data[$value['id']] == 1) {
						$cb_enabled = ' selected';
						$cb_disabled = '';
					} else {
						$cb_enabled = '';
						$cb_disabled = ' selected';
					}
					if(!isset($value['on'])) {
						$on = __('On','royalgold');
					} else {
						$on = $value['on'];
					}
					if (!isset($value['off'])) {
						$off = __('Off','royalgold');
					} else {
						$off = $value['off'];
					}
					$output .= '<p class="switch-options">';
					$output .= '<label class="'.$fold.'cb-enable'. $cb_enabled .'" data-id="'.$value['id'].'"><span>'. $on .'</span></label>';
					$output .= '<label class="'.$fold.'cb-disable'. $cb_disabled .'" data-id="'.$value['id'].'"><span>'. $off .'</span></label>';
					$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" id="'.$value['id'].'" class="'.$fold.'checkbox of-input main_checkbox" name="'.$value['id'].'"  value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
					$output .= '</p>';
					break;

				case "upload": // Uploader 3.5
				case "media":
					if(!isset($value['mod'])) $value['mod'] = '';
					$u_val = '';
					if($smof_data[$value['id']]) {
						$u_val = stripslashes($smof_data[$value['id']]);
					}
					$output .= Options_Machine::optionsframework_media_uploader_function($value['id'],$u_val, $value['mod']);
					break;
			}

			do_action('optionsframework_machine_loop', array(
				'options'	=> $options,
				'smof_data'	=> $smof_data,
				'defaults'	=> $defaults,
				'counter'	=> $counter,
				'menu'		=> $menu,
				'output'	=> $output,
				'value'		=> $value
			));
			if ($smof_output != "") {
				$output .= $smof_output;
				$smof_output = "";
			}

			// description of each option
			if ( $value['type'] != 'heading') { 
				if(!isset($value['desc'])) {
					$explain_value = '';
				} else { 
					$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n"; 
				} 
				$output .= '</div>'.$explain_value."\n";
				$output .= '<div class="clear"> </div></div></div>'."\n";
			}
			} /* condition empty end */
		}

		if ($update_data == true) {
			of_save_options($smof_data);
		}
		$output .= '</div>';

		do_action('optionsframework_machine_after', array(
					'options'		=> $options,
					'smof_data'		=> $smof_data,
					'defaults'		=> $defaults,
					'counter'		=> $counter,
					'menu'			=> $menu,
					'output'		=> $output,
					'value'			=> $value
				));
		if ($smof_output != "") {
			$output .= $smof_output;
			$smof_output = "";
		}
		return array($output,$menu,$defaults);
	}

	/**
	 * Native media library uploader
	 */
	public static function optionsframework_media_uploader_function ($id, $std, $mod) {
		$data = of_get_options();
		$smof_data = of_get_options();
		$uploader = '';
		$upload = "";
		if (isset($smof_data[$id])) $upload = $smof_data[$id];
		$hide = '';
		if ($mod == "min") {
			$hide ='hide';
		}
		if ( $upload != "") { $val = $upload; } else {$val = $std;}
		$uploader .= '<input type="text" class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';
		$uploader .= '<div class="upload_button_div">';
		if ( function_exists( 'wp_enqueue_media' ) ) {
			$uploader .= '<span class="button media_upload_button" id="'.$id.'">' . __('Upload','royalgold') . '</span>';
			
			if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
			$uploader .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'" title="' . $id . '">' . __('Remove','royalgold') . '</span>';
		}
		$uploader .='</div>' . "\n";
		$uploader .= '<div class="screenshot">';
		if ( !empty($upload) ) {
			$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
			$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
			$uploader .= '</a>';
		}
		$uploader .= '</div>';
		$uploader .= '<div class="clear"></div>' . "\n"; 
		return $uploader;
	}

	/**
	 * Drag and drop slides manager
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order){
		$data = of_get_options();
		$smof_data = of_get_options();
		$slider = '';
		$slide = array();
		if (isset($smof_data[$id])) $slide = $smof_data[$id];
		if (isset($slide[$oldorder])) {
			$val = $slide[$oldorder];
		} else {
			$val = $std;
		}
		$slidevars = array('title','url','link','description');
		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}
		if (!empty($val['title'])) {
			$slider .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li><div class="slide_header"><strong>' . __('Slide','royalgold') . ' '.$order.'</strong>';
		}
		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
		$slider .= '<a class="slide_edit_button" href="#">' . __('Edit','royalgold') . '</a></div>';
		$slider .= '<div class="slide_body">';
		$slider .= '<label>' . __('Title','royalgold') . '</label>';
		$slider .= '<input type="text" class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		$slider .= '<label>' . __('Image URL','royalgold') . '</label>';
		$slider .= '<input type="text" class="upload slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';
		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'">' . __('Upload','royalgold') . '</span>';
		if(!empty($val['url'])) {
			$hide = '';
		} else {
			$hide = 'hide';
		}
		$slider .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">' . __('Remove','royalgold') . '</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url'])){
			$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
			$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
			$slider .= '</a>';
			}
		$slider .= '</div>';
		$slider .= '<label>' . __('Link URL (optional)','royalgold') . '</label>';
		$slider .= '<input type="text" class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		$slider .= '<label>' . __('Description (optional)','royalgold') . '</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';
		$slider .= '<a class="slide_delete_button button-primary" href="#">' . __('Delete','royalgold') . '</a>';
		$slider .= '<div class="clear"></div>' . "\n";
		$slider .= '</div>';
		$slider .= '</li>';
		return $slider;
	}
}
