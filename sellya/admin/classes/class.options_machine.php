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
		
		global $of_menus;
		
		$return = $this->optionsframework_machine($options);
		
		 
		$this->Inputs = $return[0];
		$this->Menu = $of_menus;
		$this->Defaults = $return[2];
	
	
		
	}

	/** 
	 * Sanitize option
	 *
	 * Sanitize & returns default values if don't exist
	 * 
	 * Notes:
	 	- For further uses, you can check for the $value['type'] and performs
	 	  more speficic sanitization on the option
	 	- The ultimate objective of this function is to prevent the "undefined index"
	 	  errors some authors are having due to malformed options array
	 */
	static function sanitize_option( $value ) {
		$defaults = array(
			"name" 		=> "",
			"desc" 		=> "",
			"id" 		=> "",
			"std" 		=> "",
			"mod"		=> "",
			"type" 		=> ""
		);

		$value = wp_parse_args( $value, $defaults );

		return $value;

	}


	/**
	 * Process options data and build option fields
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function optionsframework_machine($options) {
		global $smof_output, $smof_details, $smof_data;
		
		if (empty($options))
			return;
		if (empty($smof_data)):
		
			$smof_data = of_get_options();
			
		endif;
		
	 

		$defaults = array();   
	    $counter = 0;
		$menu = '';
		$output = '';
		$update_data = false;
		
		
		if(!get_theme_mods()):
		
			foreach($options as $k=>$popts):
			
				foreach($popts['elements'] as $value):
			
					if(isset($value['std']) and $value['id'])
						$smof_data[$value['id']] = $value['std'];
					
			
				endforeach;
		
			endforeach;	

			$update_data = true;

		endif;
		
		
		do_action('optionsframework_machine_before', array(
				'options'	=> $options,
				'smof_data'	=> $smof_data,
			));
		if ($smof_output != "") {
			$output .= $smof_output;
			$smof_output = "";
		}
		
		foreach ($options as $popts) {
			
			$output .= "<div id='".$popts['related']."' class=\"option_group\"><div class='htabs_group'>";
			
			foreach($popts['elements'] as $value):
			
			
			// sanitize option
			if ($value['type'] != "heading")
				$value = self::sanitize_option($value);

			$counter++;
			$val = '';
			
			
			
			//create array of defaults		
                        
                        
			if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
			
			
			/* condition start */
			if(!empty($smof_data)){
			
				if (array_key_exists('id', $value) && !isset($smof_data[$value['id']])) {
					$smof_data[$value['id']] = $value['std'];
					if ($value['type'] == "checkbox" && $value['std'] == 0) {
						$smof_data[$value['id']] = 0;
					}					
					else {
						$update_data = true;
					}
				}
				if (array_key_exists('id', $value) && !isset($smof_details[$value['id']])) {
					$smof_details[$value['id']] = $smof_data[$value['id']];
				}

			//Start Heading
			 if ( $value['type'] != "heading"  )
			 {
				 	 
					
			 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
				
				//hide items in checkbox group
				$fold='';
				if (array_key_exists("fold",$value)) {
					if (isset($smof_data[$value['fold']]) && $smof_data[$value['fold']]) {
						$fold="f_".$value['fold']." ";
					} else {
						$fold="f_".$value['fold']." temphide ";
					}
				}
	
				$output .= '<div class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";
				
				//only show header if 'name' value exists
				//only show header if 'name' value exists
				if(!isset($value['help_tip']) && isset($value['name'])){
					
					$output .= '<h3 class="heading">'. $value['name'] .'</h3>';
				}
				elseif(isset($value['help_tip']) && isset($value['name'])){
					$output .= '<div style="float:left"><h3 class="heading">'. $value['name'] .'</h3></div><div style="float:left"><span class="sellya_help_tip"><a id="'.$value['help_tip'].'" title="" href="#">?</a>
					</span></div>';
				}
				
				
				if ($value['type'] != "sub_heading_tab") :
					
					$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
				else:
				$output .= '<div class="option">'."\n" . '<div>'."\n";
				endif;
				
				 
	
			 } 
			 //End Heading

			//if (!isset($smof_data[$value['id']]) && $value['type'] != "heading")
			//	continue;
			
			//switch statement to handle various options type                              
			switch ( $value['type'] ) {
				 
				//select option
                case 'googlefonts':
                    
                    $mini = '';
                    if (!isset($value['mod']))
                        $value['mod'] = '';
                    if ($value['mod'] == 'mini') {
                        $mini = 'mini';
                    }
                    $output .= '<div class="select_wrapper ' . $mini . '">';
                    
                    
                    

               
                        
                   
                    $googlefonts = Options_Machine::googleFonts();
                   

                    $output .= '<select class="of-typography of-typography-face select" name="' . $value['id'] . '" id="' . $value['id'] . '">';
                    //selected($data[$value['id']], $option, false) .
                   
                    $selected_value = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';
                    
                  // echo $value['id'];
                    //echo "<br/>" .  $selected_value;
                    $selected = '';
                          
                   //echo  $selected_value    ;   
                    foreach ($googlefonts as $fkey=>$fonts) {

                 
/*
echo "<pre>";
                      print_r(  $fonts);
echo "</pre>";
 */
if ($selected_value != '') {
                            if ($selected_value == $fkey) {
                                $selected = ' selected="selected"';
                            }else{
                            $selected = '';   
                            }
                        } 
                        
                        $output .= '<option id="' . $fkey . '" value="' . $fkey . '" ' . $selected . ' />' . $fonts . '</option>';
     
                          //  $output .= '<option value="' .$fkey .'">' . $fonts . '</option>';
                    }

                    $output .= '</select></div>';

                   // die();
                    break; 
				 
				 
				 
				case 'pattern_tiles':

                                    
                                    
                    $output .= ' <div>Transparent patterns:</div><br />';
                        
                    $output .= ' <div style="float:left;margin-bottom:20px" class="bg_transparent">';
                    $i = 0;
                    $checked = '';
                    
                    $saved_std = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';
                      
                      
                    $std = $value['std'];
					
					
                    foreach ($value['transparent_options'] as $key => $option) {
                        $i++;

                        //sellya_body_bg
                        
                       //  print_r($option."<br/><br/>");
                        //die();
                        if (!empty($saved_std)) {
                            if ($saved_std == $option) {
                                $selected = 'of-radio-tile-selected';
                                $chk='checked';
                               
                            } else {
                                $selected = '';
                                 $chk='';
                            }
                        } elseif ($std == $option) {
                            $selected = 'of-radio-tile-selected';
                             $chk='checked';
                        } else {
                            $selected = '';
                             $chk='';
                        }

                        //$saved_std=$saved_std
                        
                      
                   
                        $output .= '<span>';
                        $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $option . '" name="' . $value['id'] . '"  '.$chk.'  />';
                        $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
                        $output .= '</span>';
                    }
                    $output .= '</div>';
                    
                                         
                    $output .= ' <div style="float:left;margin-bottom:20px" class="bg_non_transparent">';
                    
                    $checked = '';
                     
                      
                    $output .= '<div style="float:left;margin-bottom:20px">Non-transparent patterns</div>  ';
                   	$output .= '<div style="float:left"> ';  
                    foreach ($value['non_transparent_options'] as $key => $option) {
                        $i++;

                        //sellya_body_bg
                        
                         // print_r($key."<br/><br/>");
                        //die();
                        if (!empty($saved_std)) {
                            if ($saved_std == $option) {
                                $selected = 'of-radio-tile-selected';
                                $chk='checked';
                               
                            } else {
                                $selected = '';
                                 $chk='';
                            }
                        } elseif ($std == $option) {
                            $selected = 'of-radio-tile-selected';
                             $chk='checked';
                        } else {
                            $selected = '';
                             $chk='';
                        }

                        //$saved_std=$saved_std
                        
                      
                   
                        $output .= '<span>';
                        $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $option . '" name="' . $value['id'] . '"  '.$chk.'  />';
                        $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
                        $output .= '</span>';
                    }
                     $output .= '</div>';
                    $output .= '</div>';
                    break;
				//text input
				case 'text':
                                    	$t_value = '';
					$t_value = stripslashes($smof_data[$value['id']]);
					
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					
					$output .= '<input class="of-input '.$mini.'" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
				break;
				
				//select option
				case 'select':
                                    
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					$output .= '<div class="select_wrapper ' . $mini . '">';					
					
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
                                        
                                        if(isset($value['options']) && !empty($value['options']))
					foreach ($value['options'] as $select_ID => $option) {
						$theValue = $option;
						if (!is_numeric($select_ID))
							$theValue = $select_ID;
						$output .= '<option id="' . $select_ID . '" value="'.$select_ID.'" ' . selected($smof_data[$value['id']], $select_ID, false) . ' />'.$option.'</option>';	 
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
						
						$ta_value = stripslashes($smof_data[$value['id']]);			
						$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';		
				break;
				
				//radiobox option
				case "radio":
                                    
					$checked = (isset($smof_data[$value['id']])) ? checked($smof_data[$value['id']], $option, false) : '';
					 foreach($value['options'] as $option=>$name) {
						$output .= '<input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($smof_data[$value['id']], $option, false) . ' /><label class="radio">'.$name.'</label><br/>';				
					}
				break;
				
				//checkbox option
				case 'checkbox':
                                    
					if (!isset($smof_data[$value['id']])) {
						$smof_data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
		
					$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
				break;
				
				//multiple checkbox option
				case 'multicheck':

					(isset($smof_data[$value['id']]))? $multi_stored = $smof_data[$value['id']] : $multi_stored="";
								
					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';								
					}			 
				break;
				
				// Color picker
				case "color":
				
					$default_color = '';
					if ( isset($value['std']) ) {
						$default_color = ' data-default-color="' .$value['std'] . '" ';
					}
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" class="of-color"  type="text" value="' . $smof_data[$value['id']] . '"' . $default_color .' />';
		 	
				break;

				//typography option	
				case 'typography':
				
					$typography_stored = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];
					
					/* Font Size */
					
					if(isset($typography_stored['size'])) {
						$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
						$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i < 20; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
					
					/* Line Height */
					if(isset($typography_stored['height'])) {
					
						$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
						$output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
							for ($i = 20; $i < 38; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
						
					/* Font Face */
					if(isset($typography_stored['face'])) {
					
						$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
						$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
						
						$faces = array('arial'=>'Arial',
										'verdana'=>'Verdana, Geneva',
										'trebuchet'=>'Trebuchet',
										'georgia' =>'Georgia',
										'times'=>'Times New Roman',
										'tahoma'=>'Tahoma, Geneva',
										'palatino'=>'Palatino',
										'helvetica'=>'Helvetica' );			
						foreach ($faces as $i=>$face) {
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
						}			
										
						$output .= '</select></div>';
					
					}
					
					/* Font Weight */
					if(isset($typography_stored['style'])) {
					
						$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
						$output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
						$styles = array('normal'=>'Normal',
										'italic'=>'Italic',
										'bold'=>'Bold',
										'bold italic'=>'Bold Italic');
										
						foreach ($styles as $i=>$style){
						
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';		
						}
						$output .= '</select></div>';
					
					}
					
					/* Font Color */
					if(isset($typography_stored['color'])) {
					
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
						$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
					
					}
					
				break;
				
				//border option
				case 'border':
						
					/* Border Width */
					$border_stored = $smof_data[$value['id']];
					
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
					
					$select_value = (isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : '';
					
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
					//custom icon
					$icon = '';
					if(isset($value['icon'])){
						$icon = ' style="background-image: url('. $value['icon'] .');"';
					}
					$header_class = str_replace(' ','',strtolower($value['name']));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($jquery_click_hook))))));
					
					$menu .= '<li class="'. $header_class .'"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'"'. $icon .'>'.  $value['name'] .'</a></li>';
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
				break;
				
				//drag & drop slide manager
				case 'slider':
                                    
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
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';
					
				break;
				
				//drag & drop block manager
				case 'sorter':

				    // Make sure to get list of all the default blocks first
				    $all_blocks = $value['std'];

				    $temp = array(); // holds default blocks
				    $temp2 = array(); // holds saved blocks

					foreach($all_blocks as $blocks) {
					    $temp = array_merge($temp, $blocks);
					}

				    $sortlists = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];

				    foreach( $sortlists as $sortlist ) {
					$temp2 = array_merge($temp2, $sortlist);
				    }

				    // now let's compare if we have anything missing
				    foreach($temp as $k => $v) {
					if(!array_key_exists($k, $temp2)) {
					    $sortlists['disabled'][$k] = $v;
					}
				    }

				    // now check if saved blocks has blocks not registered under default blocks
				    foreach( $sortlists as $key => $sortlist ) {
					foreach($sortlist as $k => $v) {
					    if(!array_key_exists($k, $temp)) {
						unset($sortlist[$k]);
					    }
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
				
				//background images option
				case 'tiles':
					
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
				
				//backup and restore options data
				case 'backup':
                                    
					$instructions = $value['desc'];
					$backup = of_get_options(BACKUPS);
					$init = of_get_options('smof_init');


					if(!isset($backup['backup_log'])) {
						$log = 'No backups yet';
					} else {
						$log = $backup['backup_log'];
					}
					
					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>'. __('Last Backup : ','sellya').'<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
					$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
					$output .= '</div>';
				
				break;
				
				//export or import data between different installs
				case 'transfer':
				
					$instructions = $value['desc'];
					$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($smof_data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
					$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';
				
				break;
				
				// google font field
				case 'select_google_font':
                                    
					$output .= '<div class="select_wrapper">';
					$output .= '<select class="select of-input google_font_select" name="'.$value['id'].'" id="'. $value['id'] .'">';
					foreach ($value['options'] as $select_key => $option) {
						$output .= '<option value="'.$select_key.'" ' . selected((isset($smof_data[$value['id']]))? $smof_data[$value['id']] : "", $option, false) . ' />'.$option.'</option>';
					} 
					$output .= '</select></div>';
					
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
				
				//JQuery UI Slider
				case 'sliderui':
                                    
					$s_val = $s_min = $s_max = $s_step = $s_edit = '';//no errors, please
					
					$s_val  = stripslashes($smof_data[$value['id']]);
					
					if(!isset($value['min'])){ $s_min  = '0'; }else{ $s_min = $value['min']; }
					if(!isset($value['max'])){ $s_max  = $s_min + 1; }else{ $s_max = $value['max']; }
					if(!isset($value['step'])){ $s_step  = '1'; }else{ $s_step = $value['step']; }
					
					if(!isset($value['edit'])){ 
						$s_edit  = ' readonly="readonly"'; 
					}
					else
					{
						$s_edit  = '';
					}
					
					if ($s_val == '') $s_val = $s_min;
					
					//values
					$s_data = 'data-id="'.$value['id'].'" data-val="'.$s_val.'" data-min="'.$s_min.'" data-max="'.$s_max.'" data-step="'.$s_step.'"';
					
					//html output
					$output .= '<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'. $s_val .'" class="mini" '. $s_edit .' />';
					$output .= '<div id="'.$value['id'].'-slider" class="smof_sliderui" style="margin-left: 7px;" '. $s_data .'></div>';
					
				break;
				
				
				//Switch option
				case 'switch':
					if (!isset($smof_data[$value['id']])) {
						$smof_data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="s_fld ";
					
					$cb_enabled = $cb_disabled = '';//no errors, please
					
					//Get selected
					if ($smof_data[$value['id']] == 1){
						$cb_enabled = ' selected';
						$cb_disabled = '';
					}else{
						$cb_enabled = '';
						$cb_disabled = ' selected';
					}
					
					//Label ON
					if(!isset($value['on'])){
						$on = "On";
					}else{
						$on = $value['on'];
					}
					
					//Label OFF
					if(!isset($value['off'])){
						$off = "Off";
					}else{
						$off = $value['off'];
					}
					
					$output .= '<p class="switch-options">';
						$output .= '<label class="'.$fold.'cb-enable'. $cb_enabled .'" data-id="'.$value['id'].'"><span>'. $on .'</span></label>';
						$output .= '<label class="'.$fold.'cb-disable'. $cb_disabled .'" data-id="'.$value['id'].'"><span>'. $off .'</span></label>';
						
						$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
						$output .= '<input type="checkbox" id="'.$value['id'].'" class="'.$fold.'checkbox of-input main_checkbox" name="'.$value['id'].'"  value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
						
					$output .= '</p>';
					
				break;

				// Uploader 3.5
				case "upload":
				case "media":

					if(!isset($value['mod'])) $value['mod'] = '';
					
					$u_val = '';
					if($smof_data[$value['id']]){
						$u_val = stripslashes($smof_data[$value['id']]);
					}

					$output .= Options_Machine::optionsframework_media_uploader_function($value['id'],$u_val, $value['mod']);
					
				break;
				case "iphone_checkboxes":
				
                    if (!isset($smof_data[$value['id']])) {

                        $smof_data[$value['id']] = $value['std'];
                    }

					
                    $saved_std =  $smof_data[$value['id']] == '' ? $value['std'] : $smof_data[$value['id']];

                    $std = $value['std'];

                    $checked = '';

                    if (isset($saved_std)) {
                    
                        $saved_std = intval($saved_std);
                        
                        if ($saved_std == 1) {

                            $checked = 'checked="checked"';
                           
                        } else {

                            $checked = '';
                            
                        }
                         
                    } elseif ($std == 'true') {

                        $checked = 'checked="checked"';
                        
                    } else {

                        $checked = '';
                        
                    }

                    $fold = '';

                    if (array_key_exists("folds", $value))
                        $fold = "fld ";
		
                    
                    $output .= '<input type="hidden" class="' . $fold . 'checkbox aq-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="0"/>';

                    $output .= '<input type="checkbox" class="iphone_checkboxes"   name="' . $value['id'] . '" id="' . $value['id'] . '" value="1" ' . $checked . ' />';

                	 
					
				
					break;
				
			}

	 
			
			//description of each option
			if ( $value['type'] != 'heading') { 
				if(!isset($value['desc'])){ $explain_value = ''; } else{ 
					$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n"; 
				} 
				$output .= '</div>'.$explain_value."\n";
				$output .= '<div class="clear"> </div></div></div>'."\n";
				}
			
			} /* condition empty end */
		 
		 
			endforeach;
		   
			$output .= "</div></div>";
		   
		}

		if ($update_data == true) {
			of_save_options($smof_data);
		}
		
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


	public static function googleFonts(){
        	
		return $googlefonts = array(
			''                         => '--- Default ---',
			'Arial'                    => 'Arial',
			'Georgia'                  => 'Georgia',
			'Helvetica'                => 'Helvetica',
			'Lucida Grande'            => 'Lucida Grande',    
			'Lucida Sans Unicode'      => 'Lucida Sans Unicode',
			'Segoe UI'                 => 'Segoe UI',   
			'Tahoma'                   => 'Tahoma',
			'Times New Roman'          => 'Times New Roman',
			'Trebuchet MS'             => 'Trebuchet MS',    
			'Verdana'                  => 'Verdana',   
			'Abel'                     => 'Abel',
			'Abril+Fatface'            => 'Abril Fatface',
			'Aclonica'                 => 'Aclonica',
			'Acme'                     => 'Acme',
			'Actor'                    => 'Actor',
			'Adamina'                  => 'Adamina',
			'Advent+Pro'               => 'Advent Pro',
			'Aguafina+Script'          => 'Aguafina Script',    
			'Aladin'                   => 'Aladin',
			'Aldrich'                  => 'Aldrich',
			'Alegreya'                 => 'Alegreya',
			'Alegreya+SC'              => 'Alegreya SC',
			'Alex+Brush'               => 'Alex Brush',
			'Alfa+Slab+One'            => 'Alfa Slab One',
			'Alice'                    => 'Alice',
			'Alike'                    => 'Alike',
			'Alike+Angular'            => 'Alike Angular',
			'Allan'                    => 'Allan',
			'Allerta'                  => 'Allerta',
			'Allerta+Stencil'          => 'Allerta Stencil',
			'Allura'                   => 'Allura',
			'Almendra'                 => 'Almendra',
			'Almendra+SC'              => 'Almendra SC',
			'Amaranth'                 => 'Amaranth',
			'Amatic+SC'                => 'Amatic SC',
			'Amethysta'                => 'Amethysta',
			'Andada'                   => 'Andada',
			'Andika'                   => 'Andika',
			'Angkor'                   => 'Angkor',    
			'Annie+Use+Your+Telescope' => 'Annie Use Your Telescope',
			'Anonymous+Pro'            => 'Anonymous Pro',
			'Antic'                    => 'Antic',
			'Antic+Didone'             => 'Antic Didone',
			'Antic+Slab'               => 'Antic Slab',        
			'Anton'                    => 'Anton',
			'Arapey'                   => 'Arapey',
			'Arbutus'                  => 'Arbutus',    
			'Architects+Daughter'      => 'Architects Daughter',
			'Arimo'                    => 'Arimo',
			'Arizonia'                 => 'Arizonia',    
			'Armata'                   => 'Armata',
			'Artifika'                 => 'Artifika',
			'Arvo'                     => 'Arvo',
			'Asap'                     => 'Asap',
			'Asset'                    => 'Asset',
			'Astloch'                  => 'Astloch',
			'Asul'                     => 'Asul',
			'Atomic+Age'               => 'Atomic Age',
			'Aubrey'                   => 'Aubrey',
			'Audiowide'                => 'Audiowide', 
			'Average'                  => 'Average',
			'Averia+Gruesa+Libre'      => 'Averia Gruesa Libre',
			'Averia+Libre'             => 'Averia Libre',
			'Averia+Sans+Libre'        => 'Averia Sans Libre',
			'Averia+Serif+Libre'       => 'Averia Serif Libre',                       
			'Bad+Script'               => 'Bad Script',
			'Balthazar'                => 'Balthazar',
			'Bangers'                  => 'Bangers',
			'Basic'                    => 'Basic',
			'Battambang'               => 'Battambang',
			'Baumans'                  => 'Baumans',
			'Bayon'                    => 'Bayon',
			'Belgrano'                 => 'Belgrano',
			'Belleza'                  => 'Belleza',    
			'Bentham'                  => 'Bentham',
			'Berkshire+Swash'          => 'Berkshire Swash',    
			'Bevan'                    => 'Bevan',
			'Bigshot+One'              => 'Bigshot One',
			'Bilbo'                    => 'Bilbo',
			'Bilbo+Swash+Caps'         => 'Bilbo Swash Caps',
			'Bitter'                   => 'Bitter',
			'Black+Ops+One'            => 'Black Ops One',
			'Bokor'                    => 'Bokor',
			'Bonbon'                   => 'Bonbon',
			'Boogaloo'                 => 'Boogaloo',
			'Bowlby+One'               => 'Bowlby One',
			'Bowlby+One+SC'            => 'Bowlby One SC',
			'Brawler'                  => 'Brawler',
			'Bree+Serif'               => 'Bree Serif',
			'Bubblegum+Sans'           => 'Bubblegum Sans',
			'Buda'                     => 'Buda',
			'Buenard'                  => 'Buenard',
			'Butcherman'               => 'Butcherman',
			'Butterfly+Kids'           => 'Butterfly Kids',
			'Cabin'                    => 'Cabin',
			'Cabin+Condensed'          => 'Cabin Condensed',
			'Cabin+Sketch'             => 'Cabin Sketch',
			'Caesar+Dressing'          => 'Caesar Dressing',
			'Cagliostro'               => 'Cagliostro',
			'Calligraffitti'           => 'Calligraffitti',
			'Cambo'                    => 'Cambo',
			'Candal'                   => 'Candal',
			'Cantarell'                => 'Cantarell',
			'Cantata+One'              => 'Cantata One',
			'Cardo'                    => 'Cardo',
			'Carme'                    => 'Carme',
			'Carter+One'               => 'Carter One',
			'Caudex'                   => 'Caudex',    
			'Cedarville Cursive'       => 'Cedarville Cursive',
			'Ceviche+One'              => 'Ceviche One',    
			'Changa+One'               => 'Changa One',
			'Chango'                   => 'Chango',
			'Chau+Philomene+One'       => 'Chau Philomene One',    
			'Chelsea+Market'           => 'Chelsea Market',
			'Chenla'                   => 'Chenla',    
			'Cherry+Cream+Soda'        => 'Cherry Cream Soda',
			'Chewy'                    => 'Chewy',
			'Chicle'                   => 'Chicle',
			'Chivo'                    => 'Chivo',    
		
			'Coda'                     => 'Coda',
			'Coda+Caption'             => 'Coda Caption',
			'Codystar'                 => 'Codystar',
			'Comfortaa'                => 'Comfortaa',
			'Coming+Soon'              => 'Coming Soon',
			'Concert+One'              => 'Concert One',    
			'Condiment'                => 'Condiment',
			'Content'                  => 'Content',    
			'Contrail+One'             => 'Contrail One',
			'Convergence'              => 'Convergence',
			'Cookie'                   => 'Cookie',
			'Copse'                    => 'Copse',
			'Corben'                   => 'Corben',
			'Cousine'                  => 'Cousine',
			'Coustard'                 => 'Coustard',
			'Covered+By+Your+Grace'    => 'Covered By Your Grace',
			'Crafty+Girls'             => 'Crafty Girls',
			'Creepster'                => 'Creepster',        
			'Crete+Round'              => 'Crete Round',
			'Crimson+Text'             => 'Crimson Text',
			'Crushed'                  => 'Crushed',
			'Cuprum'                   => 'Cuprum',
			'Cutive'                   => 'Cutive', 
			'Damion'                   => 'Damion',
			'Dancing+Script'           => 'Dancing Script',
			'Dangrek'                  => 'Dangrek',
			'Dawning+Of+A+New+Day'     => 'Dawning of a New Day',
			'Days+One'                 => 'Days One',        
			'Delius'                   => 'Delius',
			'Delius+Swash+Caps'        => 'Delius Swash Caps',
			'Delius+Unicase'           => 'Delius Unicase',
			'Della+Respira'            => 'Della Respira',
			'Devonshire'               => 'Devonshire',
			'Didact+Gothic'            => 'Didact Gothic',
			'Diplomata'                => 'Diplomata',
			'Diplomata+SC'             => 'Diplomata SC',
			'Doppio+One'               => 'Doppio One',
			'Dorsa'                    => 'Dorsa',
			'Dosis'                    => 'Dosis',    
			'Dr+Sugiyama'              => 'Dr Sugiyama',
			'Droid+Sans'               => 'Droid Sans',
			'Droid+Sans+Mono'          => 'Droid Sans Mono',
			'Droid+Serif'              => 'Droid Serif',
			'Duru+Sans'                => 'Duru Sans',
			'Dynalight'                => 'Dynalight',
			'Eater'                    => 'Eater',
			'EB+Garamond'              => 'EB Garamond',
			'Economica'                => 'Economica',
			'Electrolize'              => 'Electrolize',
			'Emblema+One'              => 'Emblema One',
			'Emilys+Candy'             => 'Emilys Candy',    
			'Engagement'               => 'Engagement',
			'Enriqueta'                => 'Enriqueta',
			'Erica+One'                => 'Erica One',
			'Esteban'                  => 'Esteban',
			'Euphoria+Script'          => 'Euphoria Script',
			'Ewert'                    => 'Ewert',    
			'Exo'                      => 'Exo',
			'Expletus+Sans'            => 'Expletus Sans',
			'Fanwood+Text'             => 'Fanwood Text',
			'Fascinate'                => 'Fascinate',
			'Fascinate+Inline'         => 'Fascinate Inline',
			'Federant'                 => 'Federant',
			'Federo'                   => 'Federo',
			'Felipa'                   => 'Felipa',
			'Fjord+One'                => 'Fjord One',
			'Flamenco'                 => 'Flamenco',
			'Flavors'                  => 'Flavors',
			'Fondamento'               => 'Fondamento',
			'Fontdiner+Swanky'         => 'Fontdiner Swanky',
			'Forum'                    => 'Forum',
			'Francois+One'             => 'Francois One',
			'Fredericka+The+Great'     => 'Fredericka the Great',   
			'Fredoka+One'              => 'Fredoka One',
			'Freehand'                 => 'Freehand', 
			'Fresca'                   => 'Fresca',
			'Frijole'                  => 'Frijole',
			'Fugaz+One'                => 'Fugaz One',
			'Galdeano'                 => 'Galdeano',
			'Gentium+Basic'            => 'Gentium Basic',
			'Gentium+Book+Basic'       => 'Gentium Book Basic',
			'Geo'                      => 'Geo',
			'Geostar'                  => 'Geostar',
			'Geostar+Fill'             => 'Geostar Fill',
			'Germania+One'             => 'Germania One',
			'GFS+Didot'                => 'GFS Didot',
			'GFS+Neohellenic'          => 'GFS Neohellenic',
			'Give+You+Glory'           => 'Give You Glory',
			'Glass+Antiqua'            => 'Glass Antiqua',
			'Glegoo'                   => 'Glegoo',
			'Gloria+Hallelujah'        => 'Gloria Hallelujah',
			'Goblin+One'               => 'Goblin One',
			'Gochi+Hand'               => 'Gochi Hand',
			'Gorditas'                 => 'Gorditas',
			'Goudy+Bookletter+1911'    => 'Goudy Bookletter 1911',
			'Graduate'                 => 'Graduate',
			'Gravitas+One'             => 'Gravitas One',
			'Great Vibes'              => 'Great Vibes',
			'Gruppo'                   => 'Gruppo',
			'Gudea'                    => 'Gudea',
			'Habibi'                   => 'Habibi',
			'Hammersmith+One'          => 'Hammersmith One',
			'Handlee'                  => 'Handlee',
			'Hanuman'                  => 'Hanuman',
			'Happy+Monkey'             => 'Happy Monkey',
			'Henny+Penny'              => 'Henny Penny',
			'Herr+Von+Muellerhoff'     => 'Herr Von Muellerhoff',
			'Holtwood+One+SC'          => 'Holtwood One SC',
			'Homemade+Apple'           => 'Homemade Apple',    
			'Homenaje'                 => 'Homenaje',
			'Iceberg'                  => 'Iceberg',
			'Iceland'                  => 'Iceland',
			'IM+Fell+Double+Pica'      => 'IM Fell Double Pica',
			'IM+Fell+Double+Pica+SC'   => 'IM Fell Double Pica SC',
			'IM+Fell+DW+Pica'          => 'IM Fell DW Pica',    
			'IM+Fell+DW+Pica+SC'       => 'IM Fell DW Pica SC',
			'IM+Fell+English'          => 'IM Fell English',
			'IM+Fell+English+SC'       => 'IM Fell English SC',
			'IM+Fell+French+Canon'     => 'IM Fell French Canon',
			'IM+Fell+French+Canon+SC'  => 'IM Fell French Canon SC',
			'IM+Fell+Great+Primer'     => 'IM Fell Great Primer',
			'IM+Fell+Great+Primer+SC'  => 'IM Fell Great Primer SC',
			'Imprima'                  => 'Imprima',
			'Inconsolata'              => 'Inconsolata',
			'Inder'                    => 'Inder',
			'Indie+Flower'             => 'Indie Flower',
			'Inika'                    => 'Inika',
			'Irish+Grover'             => 'Irish Grover',
			'Istok+Web'                => 'Istok Web',
			'Italiana'                 => 'Italiana',
			'Italianno'                => 'Italianno',
			'Jim+Nightshade'           => 'Jim Nightshade',
			'Jockey+One'               => 'Jockey One',
			'Jolly Lodger'             => 'Jolly Lodger',
			'Josefin+Sans'             => 'Josefin Sans',
			'Josefin+Slab'             => 'Josefin Slab',
			'Judson'                   => 'Judson',
			'Julee'                    => 'Julee',
			'Junge'                    => 'Junge',
			'Jura'                     => 'Jura',
			'Just+Another+Hand'        => 'Just Another Hand',
			'Just+Me+Again+Down+Here'  => 'Just Me Again Down Here',
			'Kameron'                  => 'Kameron',
			'Karla'                    => 'Karla',
			'Kaushan+Script'           => 'Kaushan Script',
			'Kelly+Slab'               => 'Kelly Slab',
			'Kenia'                    => 'Kenia',
			'Khmer'                    => 'Khmer',
			'Knewave'                  => 'Knewave',
			'Kotta+One'                => 'Kotta One',
			'Koulen'                   => 'Koulen',
			'Kranky'                   => 'Kranky',
			'Kreon'                    => 'Kreon',
			'Kristi'                   => 'Kristi',
			'Krona+One'                => 'Krona One',
			'La+Belle+Aurore'          => 'La Belle Aurore',
			'Lancelot'                 => 'Lancelot',
			'Lato'                     => 'Lato',
			'League+Script'            => 'League Script',
			'Leckerli+One'             => 'Leckerli One',
			'Ledger'                   => 'Ledger',
			'Lekton'                   => 'Lekton',
			'Lemon'                    => 'Lemon',
			'Lilita+One'               => 'Lilita One',
			'Limelight'                => 'Limelight',
			'Linden+Hill'              => 'Linden Hill',
			'Lobster'                  => 'Lobster',
			'Lobster+Two'              => 'Lobster Two',
			'Londrina+Outline'         => 'Londrina Outline',
			'Londrina+Shadow'          => 'Londrina Shadow',
			'Londrina+Sketch'          => 'Londrina Sketch',
			'Londrina+Solid'           => 'Londrina Solid',
			'Lora'                     => 'Lora',
			'Love+Ya+Like+A+Sister'    => 'Love Ya Like A Sister',
			'Loved+By+The+King'        => 'Loved by the King',
			'Lovers+Quarrel'           => 'Lovers Quarrel',
			'Luckiest+Guy'             => 'Luckiest Guy',
			'Lusitana'                 => 'Lusitana',
			'Lustria'                  => 'Lustria',
			'Macondo'                  => 'Macondo',
			'Macondo+Swash+Caps'       => 'Macondo Swash Caps',
			'Magra'                    => 'Magra',
			'Maiden+Orange'            => 'Maiden Orange',
			'Mako'                     => 'Mako',
			'Marck+Script'             => 'Marck Script',
			'Marko+One'                => 'Marko One',
			'Marmelad'                 => 'Marmelad',
			'Marvel'                   => 'Marvel',
			'Mate'                     => 'Mate',
			'Mate+SC'                  => 'Mate SC',
			'Maven+Pro'                => 'Maven Pro',    
			'Meddon'                   => 'Meddon',
			'MedievalSharp'            => 'MedievalSharp',
			'Medula+One'               => 'Medula One',
			'Megrim'                   => 'Megrim',
			'Merienda+One'             => 'Merienda One',
			'Merriweather'             => 'Merriweather',
			'Metal'                    => 'Metal',
			'Metamorphous'             => 'Metamorphous',
			'Metrophobic'              => 'Metrophobic',
			'Michroma'                 => 'Michroma',
			'Miltonian'                => 'Miltonian',
			'Miltonian+Tattoo'         => 'Miltonian Tattoo',
			'Miniver'                  => 'Miniver',
			'Miss+Fajardose'           => 'Miss Fajardose',
			'Modern+Antiqua'           => 'Modern Antiqua',
			'Molengo'                  => 'Molengo',
			'Monofett'                 => 'Monofett',
			'Monoton'                  => 'Monoton',
			'Monsieur+La+Doulaise'     => 'Monsieur La Doulaise',
			'Montaga'                  => 'Montaga',
			'Montez'                   => 'Montez',
			'Montserrat'               => 'Montserrat',
			'Moul'                     => 'Moul',
			'Moulpali'                 => 'Moulpali',
			'Mountains+of+Christmas'   => 'Mountains of Christmas',
			'Mr+Bedfort'               => 'Mr Bedfort',
			'Mr+Dafoe'                 => 'Mr Dafoe',
			'Mr+De+Haviland'           => 'Mr De Haviland',
			'Mrs+Saint+Delafield'      => 'Mrs Saint Delafield',
			'Mrs+Sheppards'            => 'Mrs Sheppards',
			'Muli'                     => 'Muli',
			'Mystery+Quest'            => 'Mystery Quest',
			'Neucha'                   => 'Neucha',
			'Neuton'                   => 'Neuton',
			'News+Cycle'               => 'News Cycle',
			'Niconne'                  => 'Niconne',
			'Nixie+One'                => 'Nixie One',
			'Nobile'                   => 'Nobile',
			'Nokora'                   => 'Nokora',
			'Norican'                  => 'Norican',
			'Nosifer'                  => 'Nosifer',
			'Nothing+You+Could+Do'     => 'Nothing You Could Do',
			'Noticia+Text'             => 'Noticia Text',
			'Nova+Cut'                 => 'Nova Cut',
			'Nova+Flat'                => 'Nova Flat',
			'Nova+Mono'                => 'Nova Mono',
			'Nova+Oval'                => 'Nova Oval',
			'Nova+Round'               => 'Nova Round',
			'Nova+Script'              => 'Nova Script',
			'Nova+Slim'                => 'Nova Slim',
			'Nova+Square'              => 'Nova Square',
			'Numans'                   => 'Numans',
			'Nunito'                   => 'Nunito',
			'Odor+Mean+Chey'           => 'Odor Mean Chey',
			'Old+Standard+TT'          => 'Old Standard TT',
			'Oldenburg'                => 'Oldenburg',
			'Oleo+Script'              => 'Oleo Script',
			'Open+Sans'                => 'Open Sans',
			'Open+Sans+Condensed'      => 'Open Sans Condensed',
			'Orbitron'                 => 'Orbitron',
			'Original+Surfer'          => 'Original Surfer',
			'Oswald'                   => 'Oswald',
			'Over+the+Rainbow'         => 'Over the Rainbow',
			'Overlock'                 => 'Overlock',
			'Overlock+SC'              => 'Overlock SC',
			'Ovo'                      => 'Ovo',
			'Oxygen'                   => 'Oxygen',
			'Pacifico'                 => 'Pacifico',
			'Parisienne'               => 'Parisienne',
			'Passero+One'              => 'Passero One',
			'Passion+One'              => 'Passion One',
			'Patrick+Hand'             => 'Patrick Hand',
			'Patua+One'                => 'Patua One',
			'Paytone+One'              => 'Paytone One',
			'Permanent+Marker'         => 'Permanent Marker',
			'Petrona'                  => 'Petrona',
			'Philosopher'              => 'Philosopher',
			'Piedra'                   => 'Piedra',
			'Pinyon+Script'            => 'Pinyon Script',
			'Plaster'                  => 'Plaster',
			'Play'                     => 'Play',
			'Playball'                 => 'Playball',
			'Playfair+Display'         => 'Playfair Display',
			'Podkova'                  => 'Podkova',
			'Poiret+One'               => 'Poiret One',
			'Poller+One'               => 'Poller One',
			'Poly'                     => 'Poly',
			'Pompiere'                 => 'Pompiere',
			'Pontano+Sans'             => 'Pontano Sans',
			'Port+Lligat+Sans'         => 'Port Lligat Sans',
			'Port+Lligat+Slab'         => 'Port Lligat Slab',
			'Prata'                    => 'Prata',
			'Preahvihear'              => 'Preahvihear',
			'Press+Start+2P'           => 'Press Start 2P',
			'Princess+Sofia'           => 'Princess Sofia',
			'Prociono'                 => 'Prociono',
			'Prosto+One'               => 'Prosto One',
			'PT+Mono'                  => 'PT Mono',
			'PT+Sans'                  => 'PT Sans',
			'PT+Sans+Caption'          => 'PT Sans Caption',
			'PT+Sans+Narrow'           => 'PT Sans Narrow',
			'PT+Serif'                 => 'PT Serif',
			'PT+Serif+Caption'         => 'PT Serif Caption',
			'Puritan'                  => 'Puritan',
			'Quantico'                 => 'Quantico',
			'Quattrocento'             => 'Quattrocento',
			'Quattrocento+Sans'        => 'Quattrocento Sans',
			'Questrial'                => 'Questrial',
			'Quicksand'                => 'Quicksand',
			'Qwigley'                  => 'Qwigley',
			'Radley'                   => 'Radley',
			'Raleway'                  => 'Raleway',
			'Rammetto+One'             => 'Rammetto One',
			'Rancho'                   => 'Rancho',
			'Rationale'                => 'Rationale',
			'Redressed'                => 'Redressed',
			'Reenie+Beanie'            => 'Reenie Beanie',
			'Revalia'                  => 'Revalia',
			'Ribeye'                   => 'Ribeye',
			'Ribeye+Marrow'            => 'Ribeye Marrow',
			'Righteous'                => 'Righteous',
			'Rochester'                => 'Rochester',
			'Rock+Salt'                => 'Rock Salt',
			'Rokkitt'                  => 'Rokkitt',
			'Ropa+Sans'                => 'Ropa Sans',
			'Rosario'                  => 'Rosario',
			'Rosarivo'                 => 'Rosarivo',
			'Rouge+Script'             => 'Rouge Script',
			'Ruda'                     => 'Ruda',
			'Ruge+Boogie'              => 'Ruge Boogie',
			'Ruluko'                   => 'Ruluko',
			'Ruslan+Display'           => 'Ruslan Display',
			'Russo+One'                => 'Russo One',
			'Ruthie'                   => 'Ruthie',
			'Sail'                     => 'Sail',
			'Salsa'                    => 'Salsa',
			'Sancreek'                 => 'Sancreek',
			'Sansita+One'              => 'Sansita One',
			'Sarina'                   => 'Sarina',
			'Satisfy'                  => 'Satisfy',
			'Schoolbell'               => 'Schoolbell',
			'Seaweed+Script'           => 'Seaweed Script',
			'Sevillana'                => 'Sevillana',
			'Shadows+Into+Light'       => 'Shadows Into Light',
			'Shadows+Into+Light+Two'   => 'Shadows Into Light Two',
			'Shanti'                   => 'Shanti',
			'Share'                    => 'Share',
			'Shojumaru'                => 'Shojumaru',
			'Short+Stack'              => 'Short Stack',
			'Siemreap'                 => 'Siemreap',
			'Sigmar+One'               => 'Sigmar One',
			'Signika'                  => 'Signika',
			'Signika+Negative'         => 'Signika Negative',
			'Simonetta'                => 'Simonetta',
			'Sirin+Stencil'            => 'Sirin Stencil',
			'Six+Caps'                 => 'Six Caps',
			'Slackey'                  => 'Slackey',
			'Smokum'                   => 'Smokum',
			'Smythe'                   => 'Smythe',
			'Sniglet'                  => 'Sniglet',
			'Snippet'                  => 'Snippet',
			'Sofia'                    => 'Sofia',
			'Sonsie+One'               => 'Sonsie One',
			'Sorts+Mill+Goudy'         => 'Sorts Mill Goudy',
			'Special+Elite'            => 'Special Elite',
			'Spicy+Rice'               => 'Spicy Rice',
			'Spinnaker'                => 'Spinnaker',
			'Spirax'                   => 'Spirax',
			'Squada+One'               => 'Squada One',
			'Stardos+Stencil'          => 'Stardos Stencil',
			'Stint+Ultra+Condensed'    => 'Stint Ultra Condensed',
			'Stint+Ultra+Expanded'     => 'Stint Ultra Expanded',
			'Stoke'                    => 'Stoke',
			'Sue+Ellen+Francisco'      => 'Sue Ellen Francisco',
			'Sunshiney'                => 'Sunshiney',
			'Supermercado+One'         => 'Supermercado One',
			'Suwannaphum'              => 'Suwannaphum',
			'Swanky+And+Moo+Moo'       => 'Swanky and Moo Moo',
			'Syncopate'                => 'Syncopate',
			'Tangerine'                => 'Tangerine',
			'Taprom'                   => 'Taprom',
			'Telex'                    => 'Telex',
			'Tenor+Sans'               => 'Tenor Sans',
			'Terminal+Dosis'           => 'Terminal Dosis',
			'The+Girl+Next+Door'       => 'The Girl Next Door',
			'Tienne'                   => 'Tienne',
			'Tinos'                    => 'Tinos',
			'Titan+One'                => 'Titan One',
			'Trade+Winds'              => 'Trade Winds',
			'Trocchi'                  => 'Trocchi',
			'Trochut'                  => 'Trochut',
			'Trykker'                  => 'Trykker',
			'Tulpen+One'               => 'Tulpen One',
			'Ubuntu'                   => 'Ubuntu',
			'Ubuntu+Condensed'         => 'Ubuntu Condensed',
			'Ubuntu+Mono'              => 'Ubuntu Mono',
			'Ultra'                    => 'Ultra',
			'Uncial+Antiqua'           => 'Uncial Antiqua',
			'UnifrakturCook'           => 'UnifrakturCook',
			'UnifrakturMaguntia'       => 'UnifrakturMaguntia',
			'Unkempt'                  => 'Unkempt',
			'Unlock'                   => 'Unlock',
			'Unna'                     => 'Unna',
			'Varela'                   => 'Varela',
			'Varela+Round'             => 'Varela Round',
			'Vast+Shadow'              => 'Vast Shadow',
			'Vibur'                    => 'Vibur',
			'Vidaloka'                 => 'Vidaloka',
			'Viga'                     => 'Viga',
			'Voces'                    => 'Voces',
			'Volkhov'                  => 'Volkhov',
			'Vollkorn'                 => 'Vollkorn',
			'Voltaire'                 => 'Voltaire',
			'VT323'                    => 'VT323',
			'Waiting+for+the+Sunrise'  => 'Waiting for the Sunrise',
			'Wallpoet'                 => 'Wallpoet',
			'Walter+Turncoat'          => 'Walter Turncoat',
			'Wellfleet'                => 'Wellfleet',
			'Wire+One'                 => 'Wire One',
			'Yanone+Kaffeesatz'        => 'Yanone Kaffeesatz',
			'Yellowtail'               => 'Yellowtail',
			'Yeseva+One'               => 'Yeseva One',
			'Yesteryear'               => 'Yesteryear',
			'Zeyada'                   => 'Zeyada',
		); 
    }

	/**
	 * Native media library uploader
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_media_uploader_function($id,$std,$mod){

		global $smof_data;
	     
 
		$uploader = '';
		$upload = "";
		if (isset($smof_data[$id]))
	    	$upload = $smof_data[$id];
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		//Upload controls DIV
		$uploader .= '<div class="upload_button_div">';
		//If the user has WP3.5+ show upload/remove button
		if ( function_exists( 'wp_enqueue_media' ) ) {
			$uploader .= '<span class="button media_upload_button" id="'.$id.'">Upload</span>';
			
			if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
			$uploader .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		}
		else 
		{
			$output .= '<p class="upload-notice"><i>Upgrade your version of WordPress for full media support.</i></p>';
		}

		$uploader .='</div>' . "\n";

		//Preview
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

public static function Options_Machine_Marup_Generate($options) {
	
		global $smof_output, $smof_details, $smof_data;
			
		
		
		//$smof_data = of_get_options();
		
		$smof_data_current = of_get_options();
		
		if(count($smof_data)<count($smof_data_current)){
			$smof_data = $smof_data_current;
		
		}
		
 
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
				if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
			}
			//echo "<pre";
			//print_r($defaults);
			
			//Start Heading
			 if ( $value['type'] != "heading" )
			 {	
			 	
			 			  
			 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
				
				//hide items in checkbox group
				$fold='';
				if (array_key_exists("fold",$value)) {
					if (isset($smof_data[$value['fold']]) && $smof_data[$value['fold']]) {
						$fold="f_".$value['fold']." ";
					} else {
						$fold="f_".$value['fold']." temphide ";
					}
				}
				if(!isset($value['id']))
				$value['id'] = rand ( 1 , 100 );
		//var_dump($value);
				$output .= '<div id="section-'.$value['id'].'" class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";
				
				//only show header if 'name' value exists
				if($value['name']) $output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
				
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
	
 
			 } 
			 
			   
			//switch statement to handle various options type                              
			switch ( $value['type'] ) {
			
				//pattern tiles
				
				case 'pattern_tiles':

					
					$output .= print_r($value['transparent_options'],true);
					


                    $output .= ' <div>Transparent patterns:</div><br />';
                        
                    $output .= ' <div style="float:left;margin-bottom:20px" class="bg_transparent">';
                    $i = 0;
                    $checked = '';
                    
                    $saved_std = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';
                      
                      
                    $std = $value['std'];
					
					
                    foreach ($value['transparent_options'] as $key => $option) {
                        $i++;

                        //sellya_body_bg
                        
                       //  print_r($option."<br/><br/>");
                        //die();
                        if (!empty($saved_std)) {
                            if ($saved_std == $option) {
                                $selected = 'of-radio-tile-selected';
                                $chk='checked';
                               
                            } else {
                                $selected = '';
                                 $chk='';
                            }
                        } elseif ($std == $option) {
                            $selected = 'of-radio-tile-selected';
                             $chk='checked';
                        } else {
                            $selected = '';
                             $chk='';
                        }

                        //$saved_std=$saved_std
                        
                      
                   
                        $output .= '<span>';
                        $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $option . '" name="' . $value['id'] . '"  '.$chk.'  />';
                        $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
                        $output .= '</span>';
                    }
                    $output .= '</div>';
                    
                                         
                    $output .= ' <div style="float:left;margin-bottom:20px" class="bg_non_transparent">';
                    
                    $checked = '';
                     
                      
                    $output .= '<div style="float:left;margin-bottom:20px">Non-transparent patterns</div>  ';
                   	$output .= '<div style="float:left"> ';  
                    foreach ($value['non_transparent_options'] as $key => $option) {
                        $i++;

                        //sellya_body_bg
                        
                         // print_r($key."<br/><br/>");
                        //die();
                        if (!empty($saved_std)) {
                            if ($saved_std == $option) {
                                $selected = 'of-radio-tile-selected';
                                $chk='checked';
                               
                            } else {
                                $selected = '';
                                 $chk='';
                            }
                        } elseif ($std == $option) {
                            $selected = 'of-radio-tile-selected';
                             $chk='checked';
                        } else {
                            $selected = '';
                             $chk='';
                        }

                        //$saved_std=$saved_std
                        
                      
                   
                        $output .= '<span>';
                        $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $option . '" name="' . $value['id'] . '"  '.$chk.'  />';
                        $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
                        $output .= '</span>';
                    }
                     $output .= '</div>';
                    $output .= '</div>';
                    break;
			
					//text input
				case 'text':
					
					$t_value = '';
					$t_value = stripslashes($smof_data[$value['id']]);
					
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					
					$output .= '<input class="of-input '.$mini.'" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
				break;
				
				
				
				//select option
				case 'select':
					$mini ='';
					
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					$output .= '<div class="select_wrapper ' . $mini . '">';
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
					

					foreach ($value['options'] as $select_ID => $option) {
						$theValue = $option;
						if (!is_numeric($select_ID))
							$theValue = $select_ID;
						$output .= '<option id="' . $select_ID . '" value="'.$select_ID.'" ' . selected($smof_data[$value['id']], $select_ID, false) . ' />'.$option.'</option>';	 
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
						
						$ta_value = stripslashes($smof_data[$value['id']]);			
						$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';		
				break;
				
				//radiobox option
				case "radio":
					$checked = (isset($smof_data[$value['id']])) ? checked($smof_data[$value['id']], $option, false) : '';
					 foreach($value['options'] as $option=>$name) {
						$output .= '<input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($smof_data[$value['id']], $option, false) . ' /><label class="radio">'.$name.'</label><br/>';				
					}
				break;
				
				//checkbox option
				case 'checkbox':
					if (!isset($smof_data[$value['id']])) {
						$smof_data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
		
					$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
				break;
				
				//multiple checkbox option
				case 'multicheck': 			
					(isset($smof_data[$value['id']]))? $multi_stored = $smof_data[$value['id']] : $multi_stored="";
								
					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';								
					}			 
				break;
				
                //select option
// Color picker
				case "color":
					$default_color = '';
										
					if ( isset($value['std']) ) {
						$default_color = ' data-default-color="' .$value['std'] . '" ';
					}
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" class="of-color"  type="text" value="' . $smof_data[$value['id']] . '"' . $default_color .' />';
		 	
				break;

				//typography option	
				case 'typography':
				
					$typography_stored = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];
					
					/* Font Size */
					
					if(isset($typography_stored['size'])) {
						$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
						$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i < 20; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
					
					/* Line Height */
					if(isset($typography_stored['height'])) {
					
						$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
						$output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
							for ($i = 20; $i < 38; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
						
					/* Font Face */
					if(isset($typography_stored['face'])) {
					
						$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
						$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
						
						$faces = array('arial'=>'Arial',
										'verdana'=>'Verdana, Geneva',
										'trebuchet'=>'Trebuchet',
										'georgia' =>'Georgia',
										'times'=>'Times New Roman',
										'tahoma'=>'Tahoma, Geneva',
										'palatino'=>'Palatino',
										'helvetica'=>'Helvetica' );			
						foreach ($faces as $i=>$face) {
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
						}			
										
						$output .= '</select></div>';
					
					}
					
					/* Font Weight */
					if(isset($typography_stored['style'])) {
					
						$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
						$output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
						$styles = array('normal'=>'Normal',
										'italic'=>'Italic',
										'bold'=>'Bold',
										'bold italic'=>'Bold Italic');
										
						foreach ($styles as $i=>$style){
						
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';		
						}
						$output .= '</select></div>';
					
					}
					
					/* Font Color */
					if(isset($typography_stored['color'])) {
					
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
						$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
					
					}
					
				break;
				
				//border option
				case 'border':
						
					/* Border Width */
					$border_stored = $smof_data[$value['id']];
					
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
					
					$select_value = (isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : '';
					
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
				//drag & drop slide manager
				case 'slider':
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
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';
					
				break;
				
				//drag & drop block manager
				case 'sorter':

				    // Make sure to get list of all the default blocks first
				    $all_blocks = $value['std'];

				    $temp = array(); // holds default blocks
				    $temp2 = array(); // holds saved blocks

					foreach($all_blocks as $blocks) {
					    $temp = array_merge($temp, $blocks);
					}

				    $sortlists = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];

				    foreach( $sortlists as $sortlist ) {
					$temp2 = array_merge($temp2, $sortlist);
				    }

				    // now let's compare if we have anything missing
				    foreach($temp as $k => $v) {
					if(!array_key_exists($k, $temp2)) {
					    $sortlists['disabled'][$k] = $v;
					}
				    }

				    // now check if saved blocks has blocks not registered under default blocks
				    foreach( $sortlists as $key => $sortlist ) {
					foreach($sortlist as $k => $v) {
					    if(!array_key_exists($k, $temp)) {
						unset($sortlist[$k]);
					    }
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
				
				//background images option
				case 'tiles':
					
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
				//JQuery UI Slider
				case 'sliderui':
					$s_val = $s_min = $s_max = $s_step = $s_edit = '';//no errors, please
					
					$s_val  = stripslashes($smof_data[$value['id']]);
					
					if(!isset($value['min'])){ $s_min  = '0'; }else{ $s_min = $value['min']; }
					if(!isset($value['max'])){ $s_max  = $s_min + 1; }else{ $s_max = $value['max']; }
					if(!isset($value['step'])){ $s_step  = '1'; }else{ $s_step = $value['step']; }
					
					if(!isset($value['edit'])){ 
						$s_edit  = ' readonly="readonly"'; 
					}
					else
					{
						$s_edit  = '';
					}
					
					if ($s_val == '') $s_val = $s_min;
					
					//values
					$s_data = 'data-id="'.$value['id'].'" data-val="'.$s_val.'" data-min="'.$s_min.'" data-max="'.$s_max.'" data-step="'.$s_step.'"';
					
					//html output
					$output .= '<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'. $s_val .'" class="mini" '. $s_edit .' />';
					$output .= '<div id="'.$value['id'].'-slider" class="smof_sliderui" style="margin-left: 7px;" '. $s_data .'></div>';
					
				break;
				
				
				//Switch option
				case 'switch':
					if (!isset($smof_data[$value['id']])) {
						$smof_data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="s_fld ";
					
					$cb_enabled = $cb_disabled = '';//no errors, please
					
					//Get selected
					if ($smof_data[$value['id']] == 1){
						$cb_enabled = ' selected';
						$cb_disabled = '';
					}else{
						$cb_enabled = '';
						$cb_disabled = ' selected';
					}
					
					//Label ON
					if(!isset($value['on'])){
						$on = "On";
					}else{
						$on = $value['on'];
					}
					
					//Label OFF
					if(!isset($value['off'])){
						$off = "Off";
					}else{
						$off = $value['off'];
					}
					
					$output .= '<p class="switch-options">';
						$output .= '<label class="'.$fold.'cb-enable'. $cb_enabled .'" data-id="'.$value['id'].'"><span>'. $on .'</span></label>';
						$output .= '<label class="'.$fold.'cb-disable'. $cb_disabled .'" data-id="'.$value['id'].'"><span>'. $off .'</span></label>';
						
						$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
						$output .= '<input type="checkbox" id="'.$value['id'].'" class="'.$fold.'checkbox of-input main_checkbox" name="'.$value['id'].'"  value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
						
					$output .= '</p>';
					
				break;

				// Uploader 3.5
				case "upload":
				case "media":

					if(!isset($value['mod'])) $value['mod'] = '';
					
					$u_val = '';
					if($smof_data[$value['id']]){
						$u_val = stripslashes($smof_data[$value['id']]);
					}

					$output .= Options_Machine::optionsframework_media_uploader_function($value['id'],$u_val, $value['mod']);
					
				break;
			
				case "iphone_checkboxes":
				
                    if (!isset($smof_data[$value['id']])) {

                        $smof_data[$value['id']] = $value['std'];
                    }

					
                    $saved_std =  $smof_data[$value['id']] == '' ? '' : $smof_data[$value['id']];

                    $std = $value['std'];

                    $checked = '';

                    if (isset($saved_std)) {
                    
                        $saved_std = intval($saved_std);
                        
                        if ($saved_std == 1) {

                            $checked = 'checked="checked"';
                           
                        } else {

                            $checked = '';
                            
                        }
                         
                    } elseif ($std == 'true') {

                        $checked = 'checked="checked"';
                        
                    } else {

                        $checked = '';
                        
                    }

                    $fold = '';

                    if (array_key_exists("folds", $value))
                        $fold = "fld ";
		
                    
                    $output .= '<input type="hidden" class="' . $fold . 'checkbox aq-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="0"/>';

                    $output .= '<input type="checkbox" class="iphone_checkboxes"   name="' . $value['id'] . '" id="' . $value['id'] . '" value="1" ' . $checked . ' />';

                	 
					
				
					break;
					case 'jslider':
					
					 if (  isset($smof_data[$value['id']])) { 
					  $t_value =  stripslashes($smof_data[$value['id']]);
					   }
					   else {$t_value =   $value['std']; 
					   } 
					   
					 
					
					$output .= '<div class="rm_input rm_text">';
				
					$output .= '<div style="float:left;width:270px;padding-left:10px">';
					
					$output .= '<input  class="jslider"  class="jslider" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
					$output .= '<script>jQuery(document).ready(function(){jQuery("#'. $value['id'].'").slider({ from: '. $value['from'].' , to: '. $value['to'].', step: '.  $value['step'] .' , smooth: true });  });</script>';
						$output .= '</div></div>';
				
				break;
				
				case 'category_color_title' :
					
				$output .= "";
				
				$categories = get_categories();
				foreach ($categories as $cat) {
				 
				 $value = "";
				 
				 if(isset($smof_data[$value['id'].$cat->cat_ID ]))
					
					$value = $smof_data[$value['id'].$cat->cat_ID ];
				 
				//$output .= $cat->name;
				$output .= '<div class="category_color_element">';
				$output .= '<div id="' . $value['id'] . $cat->id . '_picker" class="colorSelector">
				<span class="category_name">'.$cat->name.'</span>
				<div style="background-color: '.$smof_data[$value['id'].$cat->cat_ID ].'"></div></div>';
				$output .= '<input class="of-color" name="cat_color_'.$cat->cat_ID .'" id="cat_color_'.$cat->cat_ID .'" type="text" value="'. $value .'" />';
				$output .= '</div>';
				}
				
				
				break;
				
									
				//select option
				case 'google_webfonts':
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					$output .= '<div class="select_wrapper ' . $mini . '">';
					$faces =Options_Machine::google_fonts();
						
						$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
						//selected($smof_data[$value['id']], $option, false) . 
					foreach($faces->items as $cut){

			

								foreach($cut->variants as $variant){
					
									
					
								$output .= '<option value="'.$cut->family.':'.$variant.'" '.selected($value['id'], $cut->family.':'.$variant, false).'>'.$cut->family.' - '.$variant.'</option>';
					
					 
								}
					
							}
											
									
								
						$output .= '</select></div>';
						
				break;
				
					 
				 //color_schema
				
				case 'color_schema':
					
					$i = 0;
					
					$output .= '<div id="div_'.$value['id'].'" class="color_scheme">';
					//		if(!isset($value['id'])) $value['mod'] = '';
					if(isset($value['id']))
						$select_value =  $smof_data[$value['id']];  
					else
					    $select_value = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']]  : $value['std'];
					
				 
					foreach ($value['sbubtype'] as $key => $option) 
					{ 
					$i++;
			
			 $active  = $style= $class = $data_attribute ="";
 		if(isset($option['style']))
			$style = " style ='" . $option['style'] . "'";
			 
			 
			
			 if( $select_value==$option['color_scheme'])
			 	$active = " active_color_scheme";
				 #active
				
				//color_scheme
				 foreach( $option as $datakey => $datavalue) 
				 {
					 $data_attribute .="data-".$datakey."='".$datavalue."'";
					 
				 }
				 $output .="<a id='color_scheme_".$i."' href='#'" . $data_attribute . " " . $style ." class ='color_schema_link_list color_scheme_".$i.$active.$class."'>" . $key ."</a>";
				
					 
							
					}
					  $output .= '<input type="hidden" value="'.$select_value . '" id="'.$value['std'] . '" name ="'.$value['id'].'"/>';
				  
			$output .= '</div>';		
				break;
				
				case 'jslider':
					
					 if (  isset($smof_data[$value['id']])) { 
					  $t_value =  stripslashes($smof_data[$value['id']]);
					   }
					   else {$t_value =   $value['std']; 
					   } 
					   
					 
					
					$output .= '<div class="rm_input rm_text">';
				
					$output .= '<div style="float:left;width:270px;padding-left:10px">';
					
					$output .= '<input  class="jslider"  class="jslider" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
					$output .= '<script>$(document).ready(function(){$("#'. $value['id'].'").slider({ from: '. $value['from'].' , to: '. $value['to'].', step: '.  $value['step'] .' , smooth: true });  });</script>';
						$output .= '</div></div>';
				
				break;
				//checkbox option
				case 'checkbox':
					if (!isset($smof_data[$value['id']])) {
						$smof_data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
		
					$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
				break;
				
				//multiple checkbox option
				case 'multicheck': 			
					(isset($smof_data[$value['id']]))? $multi_stored = $smof_data[$value['id']] : $multi_stored="";
								
					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';								
					}			 
				break;
				
 
				// Uploader 3.5
				case "upload":
				case "media":

					if(!isset($value['mod'])) $value['mod'] = '';
					
					$u_val = '';
					if($smof_data[$value['id']]){
						$u_val = stripslashes($smof_data[$value['id']]);
					}

					$output .= Options_Machine::optionsframework_media_uploader_function($value['id'],$u_val, $value['mod']);
					
				break;
				
				//colorpicker option
				case 'color':		
				
					//$output .= !empty($smof_data[$value['id']])?$smof_data[$value['id']]:$value['std'];
					
					
					$colorcode = !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];
					
					$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$colorcode.'"></div></div>';
					$output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'.$colorcode.'" />';
				break;
				
				//typography option	
				case 'typography':
				
					$typography_stored = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];
					
					/* Font Size */
					
					if(isset($typography_stored['size'])) {
						$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
						$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i < 20; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
					
					/* Line Height */
					if(isset($typography_stored['height'])) {
					
						$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
						$output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
							for ($i = 20; $i < 38; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
						
					/* Font Face */
					if(isset($typography_stored['face'])) {
					
						$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
						$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
						
						$faces = array('arial'=>'Arial',
										'verdana'=>'Verdana, Geneva',
										'trebuchet'=>'Trebuchet',
										'georgia' =>'Georgia',
										'times'=>'Times New Roman',
										'tahoma'=>'Tahoma, Geneva',
										'palatino'=>'Palatino',
										'helvetica'=>'Helvetica' );			
						foreach ($faces as $i=>$face) {
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
						}			
										
						$output .= '</select></div>';
					
					}
					
					/* Font Weight */
					if(isset($typography_stored['style'])) {
					
						$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
						$output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
						$styles = array('normal'=>'Normal',
										'italic'=>'Italic',
										'bold'=>'Bold',
										'bold italic'=>'Bold Italic');
										
						foreach ($styles as $i=>$style){
						
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';		
						}
						$output .= '</select></div>';
					
					}
					
					/* Font Color */
					if(isset($typography_stored['color'])) {
					
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
						$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
					
					}
					
				break;
				
				//border option
				case 'border':
						
					/* Border Width */
					$border_stored = $smof_data[$value['id']];
					
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
					
					$select_value = $smof_data[$value['id']] == ''? $value['std'] : $smof_data[$value['id']];
					
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
					$header_class = str_replace(' ','',strtolower($value['name']));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . $jquery_click_hook;
					$menu .= '<li class="'. $header_class .'"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
				break;
				
				
				//drag & drop slide manager
				case 'slider':
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
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';
					
				break;
				//drag & drop block manager
				case 'sorter':
				
					$sortlists = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];
					
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
					
					$i = 0;
					$select_value = $smof_data[$value['id']] != '' ? $smof_data[$value['id']] : $value['std'];
					
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
					$output .= '<p><strong>'. __('Last Backup : ','sellya').'<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
					$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
					$output .= '</div>';
				
				break;
				
				//export or import data between different installs
				case 'transfer':
				
					$instructions = $value['desc'];
					$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($smof_data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
					$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';
				
				break;
				
				// google font field
				case 'select_google_font':
					$output .= '<div class="select_wrapper">';
					$output .= '<select class="select of-input google_font_select" name="'.$value['id'].'" id="'. $value['id'] .'">';
					foreach ($value['options'] as $select_key => $option) {      
						$output .= '<option value="'.$select_key.'" ' . selected((isset($smof_data[$value['id']]))? $smof_data[$value['id']] : "", $option, false) . ' />'.$option.'</option>';   
					} 
					$output .= '</select></div>';
					$output .= '<p class="google_font_preview">0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz</p>';
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

	  
	  return array($output,$defaults); 
	    //return array($output,$menu,$defaults);
	    
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
	
	   $smof_data =get_option(OPTIONS);
		
		$uploader = '';
	    $upload = $smof_data[$id];
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
	 * Drag and drop slides manager
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order){
		
	 
	    $smof_data = of_get_options();
		
		$slider = '';
		$slide = array();
		if (isset($smof_data[$id]))
	    	$slide = $smof_data[$id];
		
	    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
		
		//initialize all vars
		$slidevars = array('title','url','link','description');
		
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
		
		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		
		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="upload slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';
		
		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'">Upload</span>';
		
		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$slider .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url'])){
			
	    	$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
	    	$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
	    	$slider .= '</a>';
			
			}
		$slider .= '</div>';	
		$slider .= '<label>Link URL (optional)</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		
		$slider .= '<label>Description (optional)</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';
	
		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
	    $slider .= '<div class="clear"></div>' . "\n";
	
		$slider .= '</div>';
		$slider .= '</li>';
	
		return $slider;
		
	}

	
}//end Options Machine class
