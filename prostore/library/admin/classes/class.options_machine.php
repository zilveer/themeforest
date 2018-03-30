<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/admin/classes/class.options-machine.php
 * @file	 	1.0
 */
?>
<?php
/**
 * SMOF Options Machine Class
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.0.0
 * @author      Syamil MJ
 */

class Options_Machine {

	/**
	 * PHP5 contructor
	 *
	 * @since 1.0.0
	 */
	function __construct($options) {

		$return = $this->optionsframework_machine($options);

		$this->Inputs = $return[0];
		$this->Menu = $return[1];
		$this->Defaults = $return[2];

	}


	/**
	 * Process options data and build option fields
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function optionsframework_machine($options) {

	    $data = get_option(OPTIONS);

		$defaults = array();
	    $counter = 0;
		$menu = '';
		$output = '';

		foreach ($options as $value) {

			$counter++;
			$val = '';

			//create array of defaults
			if ($value['type'] == 'multicheck'){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
						$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) {
					if (isset($value['std'])) {
						$defaults[$value['id']] = $value['std'];
					}
				}
			}
			if ($value['type'] == 'multitext'){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
						$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) {
					if (isset($value['std'])) {
						$defaults[$value['id']] = $value['std'];
					}
				}
			}

			//Start Heading
			 if ( $value['type'] != "heading")
			 {
			 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }

				//hide items in checkbox group
				$fold='';
				if (array_key_exists("fold",$value)) {
					if ($data[$value['fold']]) {
						$fold="f_".$value['fold']." ";
					} else {
						$fold="f_".$value['fold']." temphide ";
					}
				}

				$output .= '<div id="section-'.$value['id'].'" class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";

				//only show header if 'name' value exists
				if (isset($value['name'])) {
					if($value['name']) {
						$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
					}
				}
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

			 }
			 //End Heading

			//switch statement to handle various options type
			switch ( $value['type'] ) {

				//text input
				case 'text':
					
					if(!isset($data[$value['id']])) $data[$value['id']] = '';
					$t_value = stripslashes($data[$value['id']]);

					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}

					$output .= '<input class="of-input '.$mini.'" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
				break;

				//text input

				//multiple text input
				case 'multitext':
					$multi_stored = $data[$value['id']];

					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="text" class="of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="'. $multi_stored[$key] .'" /><br />';
					}
				break;

				case 'text_responsive':

					$responsive_t_stored = isset($data[$value['id']]) ? $data[$value['id']] : $value['std'];

					/* Screen size one */
					if(isset($responsive_t_stored['one'])) {
						$output .= '<div class="select_wrapper screensize-one" original-title="Below 480px">';
						$output .= '<select class="of-screensize of-screensize-one select" name="'.$value['id'].'[one]" id="'. $value['id'].'_one">';
							for ($i = 1; $i < 10; $i++){
								$test = $i;
								$output .= '<option value="'. $i .'" ' . selected($responsive_t_stored['one'], $test, false) . '>'. $i .'</option>';
								}
						$output .= '</select></div>';
					}

					/* Screen size two */
					if(isset($responsive_t_stored['two'])) {
						$output .= '<div class="select_wrapper screensize-two" original-title="480 - 767px">';
						$output .= '<select class="of-screensize of-screensize-two select" name="'.$value['id'].'[two]" id="'. $value['id'].'_two">';
							for ($i = 1; $i < 10; $i++){
								$test = $i;
								$output .= '<option value="'. $i .'" ' . selected($responsive_t_stored['two'], $test, false) . '>'. $i .'</option>';
								}
						$output .= '</select></div>';
					}

					/* Screen size three */
					if(isset($responsive_t_stored['three'])) {
						$output .= '<div class="select_wrapper screensize-three" original-title="768 - 1023px">';
						$output .= '<select class="of-screensize of-screensize-three select" name="'.$value['id'].'[three]" id="'. $value['id'].'_three">';
							for ($i = 1; $i < 10; $i++){
								$test = $i;
								$output .= '<option value="'. $i .'" ' . selected($responsive_t_stored['three'], $test, false) . '>'. $i .'</option>';
								}
						$output .= '</select></div>';
					}

					/* Screen size four */
					if(isset($responsive_t_stored['four'])) {
						$output .= '<div class="select_wrapper screensize-four" original-title="1024 - 1223px">';
						$output .= '<select class="of-screensize of-screensize-four select" name="'.$value['id'].'[four]" id="'. $value['id'].'_four">';
							for ($i = 1; $i < 10; $i++){
								$test = $i;
								$output .= '<option value="'. $i .'" ' . selected($responsive_t_stored['four'], $test, false) . '>'. $i .'</option>';
								}
						$output .= '</select></div>';
					}

					/* Screen size five */
					if(isset($responsive_t_stored['five'])) {
						$output .= '<div class="select_wrapper screensize-five" original-title="1224 - 1823px">';
						$output .= '<select class="of-screensize of-screensize-five select" name="'.$value['id'].'[five]" id="'. $value['id'].'_five">';
							for ($i = 1; $i < 10; $i++){
								$test = $i;
								$output .= '<option value="'. $i .'" ' . selected($responsive_t_stored['five'], $test, false) . '>'. $i .'</option>';
								}
						$output .= '</select></div>';
					}

					/* Screen size six */
					if(isset($responsive_t_stored['six'])) {
						$output .= '<div class="select_wrapper screensize-six" original-title="Above 1823px">';
						$output .= '<select class="of-screensize of-screensize-six select" name="'.$value['id'].'[six]" id="'. $value['id'].'_six">';
							for ($i = 1; $i < 10; $i++){
								$test = $i;
								$output .= '<option value="'. $i .'" ' . selected($responsive_t_stored['six'], $test, false) . '>'. $i .'</option>';
								}
						$output .= '</select></div>';
					}

				break;



				// Range
				case 'range':					
					if(!isset($data[$value['id']])) $data[$value['id']] = '';
					$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="" name="'.$value['id'].'" type="range" value="';
							if ( esc_attr( $data[$value['id']] ) != "") {
								$output .= $data[$value['id']];
							} else {
								$output .= esc_attr($value['std']);
							} if (isset($value['min'])) {
								$output .= '" min="' . esc_attr($value['min']);
							} if (isset($value['max'])) {
								$output .= '" max="' . esc_attr($value['max']);
							} if (isset($value['step'])) {
								$output .= '" step="' . esc_attr($value['step']); }
					$output .= '" onchange="printValue(\'' . esc_attr( $value['id'] ) . '\',\'' . esc_attr( $value['id'] ) . '_value\')" /> <input id="' . esc_attr( $value['id'] ) . '_value" type="text" class="range_value" disabled />&nbsp; '. $value['unit'];
				break;

				//select option
				case 'select':
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if(!isset($value['optgroup'])) $value['optgroup'] = '';
					if(!isset($value['specific'])) $value['specific'] = '';
					if(!isset($data[$value['id']])) $data[$value['id']] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					$output .= '<div class="select_wrapper ' . $mini . '">';
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
					if($value['optgroup']!='') {
						$output .= '<optgroup label="'.$value['optgroup'].'">';
					}
					foreach ($value['options'] as $select_ID => $option) {
						if($value['specific']=="tax" || $value['specific']=="sidebars") {
							$output .= '<option id="' . $select_ID . '" value="' . $select_ID . '" ' . selected($data[$value['id']], $select_ID, false) . ' />'.$option.'</option>';
						} else {
							$output .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($data[$value['id']], $option, false) . ' />'.$option.'</option>';
						}
					 }
					if($value['optgroup']!='') {
						$output .= '</optgroup>';
					}
					$output .= '</select></div>';
				break;

				//textarea option
				case 'textarea':
					$cols = '8';
					$ta_value = '';

					if(isset($value['options'])){
							$ta_options = $value['options'];
							if(isset($ta_options['cols'])){
							$cols = $ta_options['cols'];
							}
						}
						if (!isset($data[$value['id']])) {
    						$data[$value['id']] = '';
						}
						$ta_value = stripslashes($data[$value['id']]);
						$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
				break;

				//radiobox option
				case "radio":

					 foreach($value['options'] as $option=>$name) {
						$output .= '<input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($data[$value['id']], $option, false) . ' /><label class="radio">'.$name.'</label><br/>';
					}
				break;

				//checkbox option
				case 'checkbox':
					if (!isset($data[$value['id']])) {
						$data[$value['id']] = 0;
					}

					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";

					$output .= '<input type="hidden" class="'.$fold.'checkbox aq-input" name="'.$value['id'].'" id="'. $value['id'] .'" value=""/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($data[$value['id']], 1, false) .' />';
				break;

				//multiple checkbox option
				case 'multicheck':
					$multi_stored = $data[$value['id']];

					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<label class="multicheck" for="'. $of_key_string .'">'. $option .'</label> <input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><br />';
					}
				break;

				//ajax image upload option
				case 'upload':
					if(!isset($value['mod'])) $value['mod'] = '';
					$output .= Options_Machine::optionsframework_uploader_function($value['id'],$value['std'],$value['mod']);
				break;

				// native media library uploader - @uses optionsframework_media_uploader_function()
				case 'media':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = optionsframework_mlu_get_silentpost( $_id );
					if(!isset($value['mod'])) {
						$value['mod'] = '';
					}
					if (isset($value['std'])) {
						$output .= Options_Machine::optionsframework_media_uploader_function( $value['id'], $value['std'], $int, $value['mod'] ); // New AJAX Uploader using Media Library
					}
				break;

				//colorpicker option
				case 'color':
					if (!isset($data[$value['id']])) {
    					$data[$value['id']] = '';
					}				
					$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$data[$value['id']].'"></div></div>';
					$output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'. $data[$value['id']] .'" />';
				break;

				case 'typography' :

					$typography_stored = isset($data[$value['id']]) ? $data[$value['id']] : $value['std'];

					/* Font Size */
					if(isset($typography_stored['size'])) {
						$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
						$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i < 81; $i++){
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>';
								}
						$output .= '</select></div>';
					}

					/* Font Face */
					$val = $typography_stored['face'];
					if ( $typography_stored['face'] != "" )
						$val = $typography_stored['face'];

					$font01 = '';
					$font02 = '';
					$font03 = '';
					$font04 = '';
					$font05 = '';
					$font06 = '';
					$font07 = '';
					$font08 = '';
					$font09 = '';
					$font10 = '';
					$font11 = '';
					$font12 = '';
					$font13 = '';
					$font14 = '';
					$font15 = '';
					$font16 = '';
					$font17 = '';

					if ( strpos( $val, 'Arial, sans-serif' ) !== false ) { $font01 = 'selected="selected"'; }
					if ( strpos( $val, 'Verdana, Geneva' ) !== false ) { $font02 = 'selected="selected"'; }
					if ( strpos( $val, 'Trebuchet' ) !== false ) { $font03 = 'selected="selected"'; }
					if ( strpos( $val, 'Georgia' ) !== false ) { $font04 = 'selected="selected"'; }
					if ( strpos( $val, 'Times New Roman' ) !== false ) { $font05 = 'selected="selected"'; }
					if ( strpos( $val, 'Tahoma, Geneva' ) !== false ) { $font06 = 'selected="selected"'; }
					if ( strpos( $val, 'Palatino' ) !== false ) { $font07 = 'selected="selected"'; }
					if ( strpos( $val, 'Helvetica' ) !== false ) { $font08 = 'selected="selected"'; }
					if ( strpos( $val, 'Calibri' ) !== false ) { $font09 = 'selected="selected"'; }
					if ( strpos( $val, 'Myriad' ) !== false ) { $font10 = 'selected="selected"'; }
					if ( strpos( $val, 'Lucida' ) !== false ) { $font11 = 'selected="selected"'; }
					if ( strpos( $val, 'Arial Black' ) !== false ) { $font12 = 'selected="selected"'; }
					if ( strpos( $val, 'Gill' ) !== false ) { $font13 = 'selected="selected"'; }
					if ( strpos( $val, 'Geneva, Tahoma' ) !== false ) { $font14 = 'selected="selected"'; }
					if ( strpos( $val, 'Impact' ) !== false ) { $font15 = 'selected="selected"'; }
					if ( strpos( $val, 'Courier' ) !== false ) { $font16 = 'selected="selected"'; }
					if ( strpos( $val, 'Century Gothic' ) !== false ) { $font17 = 'selected="selected"'; }

					$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
					$output .= '<select class="of-typography of-typography-face select" name="'. $value['id'].'[face]" id="'. $value['id'].'_face">';
					$output .= '<option value="Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif" '. $font01 .'>Arial</option>';
					$output .= '<option value="Verdana, Geneva, sans-serif" '. $font02 .'>Verdana</option>';
					$output .= '<option value="&quot;Trebuchet MS&quot;, &quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, &quot;Lucida Sans&quot;, Tahoma, sans-serif"'. $font03 .'>Trebuchet</option>';
					$output .= '<option value="Georgia, Times, &quot;Times New Roman&quot;, serif" '. $font04 .'>Georgia</option>';
					$output .= '<option value="Times NewRoman, &quot;Times New Roman&quot;, Times, Baskerville, Georgia, serif"'. $font05 .'>Times New Roman</option>';
					$output .= '<option value="Tahoma, Verdana, Segoe, sans-serif"'. $font06 .'>Tahoma</option>';
					$output .= '<option value="Palatino, &quot;Palatino Linotype&quot;, &quot;Palatino LT STD&quot;, &quot;Book Antiqua&quot;, Georgia, serif"'. $font07 .'>Palatino</option>';
					$output .= '<option value="&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif" '. $font08 .'>Helvetica*</option>';
					$output .= '<option value="Calibri, Candara, Segoe, Optima, sans-serif"'. $font09 .'>Calibri*</option>';
					$output .= '<option value="Calibri, Candara, Segoe, &quot;Segoe UI&quot;, Optima, Arial, sans-serif"'. $font10 .'>Myriad Pro*</option>';
					$output .= '<option value="&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, &quot;Lucida Sans&quot;, Geneva, Verdana, sans-serif"'. $font11 .'>Lucida</option>';
					$output .= '<option value="&quot;Arial Black&quot;, &quot;Arial Bold&quot;, Gadget, sans-serif" '. $font12 .'>Arial Black</option>';
					$output .= '<option value="&quot;Gill Sans&quot;, &quot;Gill Sans MT&quot;, Calibri, sans-serif" '. $font13 .'>Gill Sans*</option>';
					$output .= '<option value="Geneva, Tahoma, Verdana, sans-serif" '. $font14 .'>Geneva*</option>';
					$output .= '<option value="Impact, Haettenschweiler, &quot;Franklin Gothic Bold&quot;, Charcoal, &quot;Helvetica Inserat&quot;, &quot;Bitstream Vera Sans Bold&quot;, &quot;Arial Black&quot;, sans serif" '. $font15 .'>Impact</option>';
					$output .= '<option value="&quot;Courier New&quot;, Courier, &quot;Lucida Sans Typewriter&quot;, &quot;Lucida Typewriter&quot;, monospace" '. $font16 .'>Courier</option>';
					$output .= '<option value="&quot;Century Gothic&quot;, CenturyGothic, AppleGothic, sans-serif" '. $font17 .'>Century Gothic</option>';

					// Google webfonts
					global $google_fonts;
					sort( $google_fonts );

					$output .= '<option value="">-- Google Fonts --</option>';
					foreach ( $google_fonts as $key => $gfont ) :
						$font[$key] = '';
					if ( $val == $gfont['name'] ) { $font[$key] = 'selected="selected"'; }
					$name = $gfont['name'];
					$output .= '<option value="'.$name.'" '. $font[$key] .'>'.$name.'</option>';
					endforeach;

					// Custom Font stack
					$new_stacks = get_option( 'framework_woo_font_stack' );
					if( !empty( $new_stacks ) ) {
						$output .= '<option value="">-- Custom Font Stacks --</option>';
						foreach( $new_stacks as $name => $stack ) {
							if ( strpos( $val, $stack ) !== false ) { $fontstack = 'selected="selected"'; } else { $fontstack = ''; }
							$output .= '<option value="'. stripslashes( htmlentities( $stack ) ) .'" '.$fontstack.'>'. str_replace( '_', ' ', $name ).'</option>';
						}
					}

					$output .= '</select></div>';

					/* Font Weight */
					$val = $typography_stored['style'];
					if ( $typography_stored['style'] != "" ) { $val = $typography_stored['style']; }
					$normal = ''; $italic = ''; $bold = ''; $bolditalic = '';
					if( $val == 'normal' ) { $normal = 'selected="selected"'; }
					if( $val == 'italic' ) { $italic = 'selected="selected"'; }
					if( $val == 'bold' ) { $bold = 'selected="selected"'; }
					if( $val == 'bold italic' ) { $bolditalic = 'selected="selected"'; }

					$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
					$output .= '<select class="of-typography of-typography-style select" name="'. $value['id'].'[style]" id="'. $value['id'].'_style">';
					$output .= '<option value="normal" '. $normal .'>Normal</option>';
					$output .= '<option value="italic" '. $italic .'>Italic</option>';
					$output .= '<option value="bold" '. $bold .'>Bold</option>';
					$output .= '<option value="bold italic" '. $bolditalic .'>Bold/Italic</option>';
					$output .= '</select></div>';

					/* Font Color */
					$val = $typography_stored['color'];
					if ( $typography_stored['color'] != "" ) { $val = $typography_stored['color']; }
					$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
					$output .= '<input class="of-color of-typography of-typography-color" name="'. $value['id'] .'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';

					break;


				//border option
				case 'border':

					/* Border Width */
					$border_stored = $data[$value['id']];

					$output .= '<div class="select_wrapper border-width">';
					$output .= '<select class="of-border of-border-width select" name="'.$value['id'].'[width]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 21; $i++){
						$output .= '<option value="'. $i .'" ' . selected($border_stored['width'], $i, false) . '>'. $i .'</option>';				 }
					$output .= '</select></div>';

					/* Border Style */
					$output .= '<div class="select_wrapper border-style">';
					$output .= '<select class="of-border of-border-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';

					$styles = array('none'=>'None',
									'solid'=>'Solid',
									'dashed'=>'Dashed',
									'dotted'=>'Dotted');

					foreach ($styles as $i=>$style){
						$output .= '<option value="'. $i .'" ' . selected($border_stored['style'], $i, false) . '>'. $style .'</option>';
					}

					$output .= '</select></div>';

					/* Border Color */
					$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$border_stored['color'].'"></div></div>';
					$output .= '<input class="of-color of-border of-border-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $border_stored['color'] .'" />';

				break;

				//images checkbox - use image as checkboxes
				case 'images':

					$i = 0;

					if(!isset($data[$value['id']])) $data[$value['id']] = '';
					$select_value = $data[$value['id']];

					foreach ($value['options'] as $key => $option)
					{
					$i++;

						$checked = '';
						$selected = '';
						if(NULL!=checked($select_value, $key, false)) {
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

				//info (for small intro box etc)
				case "info":
					$info_text = $value['std'];
					$output .= '<div class="of-info">'.$info_text.'</div>';
				break;

				//display a single image
				case "image":
					$src = $value['std'];
					$output .= '<img src="'.$src.'">';
				break;

				//tab heading
				case 'heading':
					if($counter >= 2){
					   $output .= '</div>'."\n";
					}
					$class='';
					if(isset($value['class'])) { $class=' indent'; }
					$header_class = str_replace(' ','',strtolower($value['name']));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . $jquery_click_hook;
					$menu .= '<li class="'. $header_class . $class .'"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
				break;

				//drag & drop slide manager
				case 'slider':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = optionsframework_mlu_get_silentpost( $_id );
					$output .= '<div class="slider"><ul id="'.$value['id'].'" rel="'.$int.'">';
					if(!isset($data[$value['id']])) $data[$value['id']] = '';
					$slides = $data[$value['id']];
					$count = count($slides);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
					} else {
						$i = 0;
						foreach ($slides as $slide) {
							$oldorder = $slide['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
						}
					}
					$output .= '</ul>';
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';

				break;

				//drag & drop slide manager
				case 'sidebar':					
					if(!isset($data[$value['id']])) $data[$value['id']] = '';
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = optionsframework_mlu_get_silentpost( $_id );
					$output .= '<div class="sidebar"><ul id="'.$value['id'].'" rel="'.$int.'">';
					$sidebars = $data[$value['id']];
					$count = count($sidebars);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_sidebar_function($value['id'],$value['std'],$oldorder,$order,$int);
					} else {
						$i = 0;
						foreach ($sidebars as $sidebar) {
							$oldorder = $sidebar['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_sidebar_function($value['id'],$value['std'],$oldorder,$order,$int);
						}
					}
					$output .= '</ul>';
					$output .= '<a href="#" class="button sidebar_add_button">Add New Sidebar</a></div>';

				break;

				//drag & drop block manager
				case 'sorter':					
					if(!isset($data[$value['id']])) $data[$value['id']] = '';
					$sortlists = $data[$value['id']];
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

				//background images option
				case 'tiles':
					
					if(!isset($data[$value['id']])) $data[$value['id']] = '';
					$i = 0;
					$select_value = '';
					$select_value = $data[$value['id']];

					foreach ($value['options'] as $key => $option)
					{
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

				break;

				//backup and restore options data
				case 'backup':

					$instructions = $value['desc'];
					$backup = get_option(BACKUPS);

					if(!isset($backup['backup_log'])) {
						$log = 'No backups yet';
					} else {
						$log = $backup['backup_log'];
					}

					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>'. __('Last Backup : ','prostore-theme').'<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">'.__('Backup Options','prostore-theme').'</a>';
					$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">'.__('Restore Options','prostore-theme').'</a>';
					$output .= '</div>';

				break;

				//export or import data between different installs
				case 'transfer':

					$instructions = $value['desc'];
					$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
					$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">'.__('Import Options','prostore-theme').'</a>';

				break;

			}

			//description of each option
			if ( $value['type'] != 'heading' ) {
				if(!isset($value['desc'])){ $explain_value = ''; } else{
					$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n";
				}
				$output .= '</div>'.$explain_value."\n";
				$output .= '<div class="clear"> </div></div></div>'."\n";
				}

		}

	    $output .= '</div>';

	    return array($output,$menu,$defaults);

	}


	/**
	 * Ajax image uploader - supports various types of image types
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_uploader_function($id,$std,$mod){

	    $data =get_option(OPTIONS);

		$uploader = '';
	    $upload = $data[$id];
		$hide = '';

		if ($mod == "min") {$hide ='hide';}

	    if ( $upload != "") { $val = $upload; } else {$val = $std;}

		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';

		$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">'._('Upload').'</span>';

		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
	    $uploader .= '<div class="clear"></div>' . "\n";
		if(!empty($upload)){
			$uploader .= '<div class="screenshot">';
	    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';
			$uploader .= '</div>';
			}
		$uploader .= '<div class="clear"></div>' . "\n";

		return $uploader;

	}

	/**
	 * Native media library uploader
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_media_uploader_function($id,$std,$int,$mod){

	    $data =get_option(OPTIONS);

		$uploader = '';
	    $upload = $data[$id];
		$hide = '';

		if ($mod == "min") {$hide ='hide';}

	    if ( $upload != "") { $val = $upload; } else {$val = $std;}

		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';

		$uploader .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'" rel="' . $int . '">Upload</span>';

		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
		$uploader .= '<div class="screenshot">';
		if(!empty($upload)){
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
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order,$int){

	    $data = get_option(OPTIONS);

		$slider = '';
		$slide = array();
	    $slide = $data[$id];

	    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}

		//initialize all vars
		$slidevars = array('slidelayout','showtext','contentstyle','contentbackground','title','caption','positiontext','showbutton','buttontext','buttonlink','buttonstyle','mediatype','imageurl','imagebg','videoprovider','videourl');

		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}

		//begin slider interface
		if (!empty($val['title'])) {
			$slider .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li><div class="slide_header"><strong>Slide '.$order.'</strong>';
		}

		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';

		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';

		$slider .= '<div class="slide_body">';
		$slider .= '<div class="sub_section">';

			// Slide layout
			$slider .= '<label>Slide layout</label>';
			$slider .= '<div class="select_wrapper">';
			$slidel_options = array('onecol'=>'Content above media','twocolsr'=>'Media Left/Content right','twocolsl'=>'Media Right/Content Left');
			$slider .= '<select class="slide slide-layout select of-input" name="'. $id .'['.$order.'][slidelayout]" id="'. $id .'_'.$order .'_slide_slidelayout">';
			foreach ($slidel_options as $select_ID => $option) {
				$slider .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($val['slidelayout'], $option, false) . ' />'.$option.'</option>';
			 }
			$slider .= '</select><div class="clear"></div></div><div class="clear"></div>';

			// Show text ?
			if (!isset($val['showtext'])) {
				$val['showtext'] = 0;
			}
			$slider .= '<label>Show content</label>';
			$slider .= '<input type="hidden" class="slide fold1master checkbox aq-input" name="'. $id .'['.$order.'][showtext]" id="'. $id .'_'.$order .'_slide_showtext" value=""/>';
			$slider .= '<input type="checkbox" class="slide fold1master checkbox of-input" name="'. $id .'['.$order.'][showtext]" id="'. $id .'_'.$order .'_slide_showtext"" value="1" '. checked($val['showtext'], 1, false) .' />';
			$slider .= '<div class="clear"></div>';

			$slider .='<div class="fold1 hidden">';
						// Content style
				$slider .= '<label>Content style</label>';
				$slider .= '<div class="select_wrapper">';
				$contentS_options = array('light','dark');
				$slider .= '<select class="slide select of-input" name="'. $id .'['.$order.'][contentstyle]" id="'. $id .'_'.$order .'_slide_contentstyle">';
				foreach ($contentS_options as $select_ID => $option) {
					$slider .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($val['contentstyle'], $option, false) . ' />'.$option.'</option>';
				 }
				$slider .= '</select><div class="clear"></div></div><div class="clear"></div>';

				// Add text background
				if (!isset($val['contentbackground'])) {
					$val['contentbackground'] = 0;
				}
				$slider .= '<label>Content background (useful to differentiate when on top of media)</label>';
				$slider .= '<input type="hidden" class="slide checkbox aq-input" name="'. $id .'['.$order.'][contentbackground]" id="'. $id .'_'.$order .'_slide_contentbackground" value=""/>';
				$slider .= '<input type="checkbox" class="slide checkbox of-input" name="'. $id .'['.$order.'][contentbackground]" id="'. $id .'_'.$order .'_slide_contentbackground"" value="1" '. checked($val['contentbackground'], 1, false) .' />';
				$slider .= '<div class="clear"></div>';


				$slider .= '<hr>';

				// Slide title
				$slider .= '<label>Title</label>';
				$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
				$slider .= '<div class="clear"></div>';

				// Slide caption
				$slider .= '<label>Caption<br/><em>You can also add shortcodes</em></label>';
				$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][caption]" id="'. $id .'_'.$order .'_slide_caption" cols="8" rows="8">'.stripslashes($val['caption']).'</textarea>';
				$slider .= '<div class="clear"></div>';

				// Text position
				$slider .= '<label>Position of content</label>';
				$slider .= '<div class="select_wrapper">';
				$position_options = array('left','center','right');
				$slider .= '<select class="slide select of-input" name="'. $id .'['.$order.'][positiontext]" id="'. $id .'_'.$order .'_slide_positiontext">';
				foreach ($position_options as $select_ID => $option) {
					$slider .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($val['positiontext'], $option, false) . ' />'.$option.'</option>';
				 }
				$slider .= '</select><div class="clear"></div></div><div class="clear"></div>';

				$slider .= '<hr>';

				// Show button
				$slider .= '<label>Show button below Title/Caption</label>';
				$slider .= '<input type="hidden" class="slide checkbox aq-input" name="'. $id .'['.$order.'][showbutton]" id="'. $id .'_'.$order .'_slide_showbutton" value=""/>';
				$slider .= '<input type="checkbox" class="slide checkbox of-input" name="'. $id .'['.$order.'][showbutton]" id="'. $id .'_'.$order .'_slide_showbutton"" value="1" '. checked($val['showbutton'], 1, false) .' />';
				$slider .= '<div class="clear"></div>';

				// Button text
				$slider .= '<label>Button text</label>';
				$slider .= '<input class="slide of-input of-slider-buttontext" name="'. $id .'['.$order.'][buttontext]" id="'. $id .'_'.$order .'_slide_buttontext" value="'. stripslashes($val['buttontext']) .'" />';
				$slider .= '<div class="clear"></div>';

				// Button link
				$slider .= '<label>Button link</label>';
				$slider .= '<input class="slide of-input of-slider-buttonlink" name="'. $id .'['.$order.'][buttonlink]" id="'. $id .'_'.$order .'_slide_buttonlink" value="'. stripslashes($val['buttonlink']) .'" />';
				$slider .= '<div class="clear"></div>';

				// Button style
				$slider .= '<label>Button style</label>';
				$slider .= '<div class="select_wrapper">';
				$button_options = array('primary'=>'Primary','secondary'=>'Secondary','tertiary'=>'Tertiary',
										  'alert'=>'Alert','success'=>'Success','warning'=>'Warning',
										  'info'=>'Info','inverse'=>'Inverse');
				$slider .= '<select class="slide select of-input" name="'. $id .'['.$order.'][buttonstyle]" id="'. $id .'_'.$order .'_slide_buttonstyle">';
				foreach ($button_options as $select_ID => $option) {
					$slider .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($val['buttonstyle'], $option, false) . ' />'.$option.'</option>';
				 }
				$slider .= '</select><div class="clear"></div></div><div class="clear"></div>';

				$slider .= '<hr>';

			$slider .= '</div>';

		$slider .= '</div>';

		$slider .= '<div class="sub_section">';
			// Media Type
			$slider .= '<label>Media type</label>';
			$slider .= '<div class="select_wrapper">';
			$position_options = array('image'=>'Image','video'=>'Video');
			$slider .= '<select class="slide fold2master select of-input" name="'. $id .'['.$order.'][mediatype]" id="'. $id .'_'.$order .'_slide_mediatype">';
			foreach ($position_options as $select_ID => $option) {
				$slider .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($val['mediatype'], $option, false) . ' />'.$option.'</option>';
			 }
			$slider .= '</select><div class="clear"></div></div>';
			$slider .= '<div class="clear"></div>';

			// Image url
			$slider .='<div class="fold2 hidden">';

				// Show image as background
				$slider .= '<div class="image-bg-container"><label>Image style</label>';
				$slider .= '<div class="select_wrapper">';
				$imagebg_options = array('cover'=>'Cover','contain'=>'contain');
				$slider .= '<select class="slide select of-input" name="'. $id .'['.$order.'][imagebg]" id="'. $id .'_'.$order .'_slide_imagebg">';
				foreach ($imagebg_options as $select_ID => $option) {
					$slider .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($val['imagebg'], $option, false) . ' />'.$option.'</option>';
				 }
				$slider .= '</select><div class="clear"></div></div></div>';
				$slider .= '<div class="clear"></div>';

				$slider .= '<label>Image URL</label>';
				$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][imageurl]" id="'. $id .'_'.$order .'_slide_imageurl" value="'. $val['imageurl'] .'" />';
				$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';
				if(!empty($val['imageurl'])) {$hide = '';} else { $hide = 'hide';}
				$slider .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
				$slider .='</div>' . "\n";
				$slider .= '<div class="screenshot">';
				if(!empty($val['imageurl'])){
			    	$slider .= '<a class="of-uploaded-image" href="'. $val['imageurl'] . '">';
			    	$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['imageurl'].'" alt="" />';
			    	$slider .= '</a>';
					}
				$slider .= '</div>';
			$slider .= '</div>';
			$slider .= '<div class="clear"></div>';

			// Video url
			$slider .='<div class="fold3 hidden">';
				$slider .= '<label>Video provider</label>';
				$slider .= '<div class="select_wrapper">';
				$video_options = array('vimeo'=>'Vimeo','youtube'=>'YouTube');
				$slider .= '<select class="slide select of-input" name="'. $id .'['.$order.'][videoprovider]" id="'. $id .'_'.$order .'_slide_videoprovider">';
				foreach ($video_options as $select_ID => $option) {
					$slider .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($val['videoprovider'], $option, false) . ' />'.$option.'</option>';
				 }
				$slider .= '</select><div class="clear"></div></div>';
				$slider .= '<div class="clear"></div>';

				$slider .= '<label>Video ID</label>';
				$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][videourl]" id="'. $id .'_'.$order .'_slide_videourl" value="'. $val['videourl'] .'" />';
				$slider .= '<div class="clear"></div>';
			$slider .= '</div>';
		$slider .= '</div>';

		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
	    $slider .= '<div class="clear"></div>' . "\n";

		$slider .= '</div>';
		$slider .= '</li>';

		return $slider;

	}

	/**
	 * Drag and drop sidebar manager
	 */
	public static function optionsframework_sidebar_function($id,$std,$oldorder,$order,$int){

	    $data = get_option(OPTIONS);

		$slider = '';
		$slide = array();
	    $slide = $data[$id];

	    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}

		//initialize all vars
		$slidevars = array('title');

		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}

		$slider .= '<li><input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_sidebar_order" value="'.$order.'" />';

		$slider .= '<div class="sidebar_body">';

				// Slide title
				$slider .= '<label>Title</label>';
				$slider .= '<input class="sidebar of-input of-sidebar-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_title" value="'. stripslashes($val['title']) .'" />';

		$slider .= '<a class="sidebar_delete_button" href="#">Delete</a>';
	    $slider .= '<div class="clear"></div>' . "\n";

		$slider .= '</div>';
		$slider .= '</li>';

		return $slider;

	}


}//end Options Machine class

?>