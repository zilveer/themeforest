<?php
#-----------------------------------------
#	RT-Theme metaboxes.php
#	version: 1.0
#-----------------------------------------

#
# 	Custom Fields
#
 

	class rt_meta_boxes{
		#
		# @var $prefix
		# @var $customFields
		# @var $settings
		#
		
		var $prefix = THEMESLUG;
		var $customFields;
		var $settings;
		
 
		/**
		* Constructor
		*/
		function __construct($settings,$customFields) {

			$this->settings = $settings;
			$this->customFields = $customFields;
			
			add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
			add_action( 'save_post', array( &$this, 'saveCustomFields' ) );
		}
		 
		/**
		* Create the new Custom Fields meta box
		*/
		function createCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				if(is_array($this->settings['scope'])){
					
					foreach($this->settings['scope'] as $scope){
						add_meta_box( $this->settings['slug'], $this->settings['name'], array( &$this, 'displayCustomFields' ), $scope, $this->settings['context'], $this->settings['priority'] );
					}
					
				}else{
					add_meta_box( $this->settings['slug'], $this->settings['name'], array( &$this, 'displayCustomFields' ), $this->settings['scope'], $this->settings['context'], $this->settings['priority'] );
				}
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function displayCustomFields() {
			global $post,$google_fonts;			
			?>
			 <div class="box right-col metaboxes">
				<?php
				wp_nonce_field($this->settings['slug'], $this->settings['slug'].'_wpnonce', false, true );
				foreach ( $this->customFields as $customField ) {
					
					if(isset($customField[ 'name' ])){
						$field_value = get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true );
					}else{
						$field_value = "";
					}

					$customField['default'] = isset( $customField['default'] ) ? $customField['default'] : "" ;
					$customField['name'] = isset( $customField['name'] ) ? $customField['name'] : "" ;
					$customField['help'] = isset( $customField['help'] ) ? $customField['help'] : "" ;
					$customField['select'] = isset( $customField['select'] ) ? $customField['select'] : "" ;
					$customField['class'] = isset( $customField['class'] ) ? $customField['class'] : "" ;
					$customField['font-system'] = isset( $customField['font-system'] ) ? $customField['font-system'] : "" ;	


					$id			= $this->prefix . $customField[ 'name' ];
					$title		= isset( $customField[ 'title' ] ) ? $customField[ 'title' ] : "";
					$description   = isset( $customField[ 'description' ] ) ? $customField[ 'description' ]: "";
					$class 		= isset( $customField[ 'class' ] ) ? $customField[ 'class' ]: "";
					$richEditor 	= isset( $customField[ 'richeditor' ] ) ? $customField[ 'richeditor' ]: "";

 
					// Hidden Field value - check the content saved with rt-theme
					$hidden_value 	= get_post_meta( $post->ID, $this->prefix . '_rt_hidden', true ); 
						
					// default value
					if($field_value == "" && $customField['default']){
						
						if(@$customField[ 'type' ] !="checkbox"){
							$field_value = $customField[ 'default' ];
						}
					}

					if(!isset($_GET['action'])){
						$field_value = $customField[ 'default' ];
					}

					// default value
					/*
					*	exeption for the background options
					*/
					if($this->settings['slug'] == "rt_background_custom_fields_template" && !$hidden_value){
						$field_value = @$customField[ 'default' ];
					}

					if(@isset($customField[ 'statical_value' ])){
						$field_value = @$customField[ 'statical_value' ];
					} 

	
					//show default
					if(isset($customField['show_default']) && $customField['show_default']=="true"){
						$showDefault = $customField['default'];
					}else{
						$showDefault = "";
					}
			 
					// Check capability
					if ( !current_user_can( $this->settings['capability'], $post->ID ) ){
						$output = false;
					}else{
						$output = true;
					}
					
					//help						
					if(!empty($customField[ 'help' ])){
						$help = '<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID=' . $id.'&tipName='.$title.'&adminURI='.THEMEADMINURI.'" title="'.$title.'"></a></td>';
					}else{
						$help = ""; 
					}

					// Output if allowed
					if ( $output ) { ?>

							<?php
							switch ( $customField[ 'type' ] ) {
								case "group_start": {
									// group start
									echo '<div id="'.$id.'">';
									break;
								}
								case "group_end": {
									// group end
									echo '</div>';
									break;
								}

								case "checkbox": {
									// Checkbox
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">' . ($description) . '</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element check"><input type="checkbox" name="'.$id.'"';
									    
									    if($field_value=="checked" || $field_value=="on"){
										echo ' checked="checked" '; 
									    }
									    
									echo 'id="'.$id.'"/></div></td>';
									if(!empty($customField[ 'help' ])){	echo '<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID=' . $id.'&tipName='.$title.'&adminURI='.THEMEADMINURI.'" title="'.$title.'"></a></td>';}
									echo '    </tr>';
									echo '</table>';
									break;
								}


								#
								#	Radio Buttons
								#
								
 								case 'radio';
								
								echo '<table>';
								echo '    <tr>';
								echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
								if($description) echo '<div class="desc">'.$description.'</div>';
								echo '	</td>';
								echo '    </tr>';
								echo '    <tr>';
								echo '	<td class="col2"><div class="check"> ';				    				 
							
				
									if($class == "pattern_list") {
										echo '<table class="image_radio '.$class.' " id="'.$id.'"><tr>';
									}else{
										echo '<div id="'.$id.'">';
									}
								 

									//hiding old post formats for wp 3.6
									$new_post_format_value = get_post_meta( $post->ID, "post_format", true );
									$old_post_format_value = get_post_format( $post->ID );

									$field_counter = 1;
									foreach($customField['options'] as $option_value => $option_name){					
										//if array
										if(is_array($option_name)){
											$option_name = $option_name[1];
										}
			 
										//if this is an old post saved with wp 3.5 and version rt 2.3
										if( $old_post_format_value && $option_value == $old_post_format_value && ! trim( $new_post_format_value ) ) {
											$option_value =  $field_value; 
										} 
										
										//new post format value
										if( isset( $new_post_format_value ) &&  $option_value == $new_post_format_value ){
											$option_value =  $field_value; 
										} 				

										if( ( isset( $customField['clean_name'] ) && $customField['clean_name'] == "post_format" ) ){	 
											
											if ( $new_post_format_value ){
												$field_value = $new_post_format_value; 
											}else{
												$field_value = $old_post_format_value; 
											} 
										}

										//clean name
										if( isset( $customField['clean_name'] ) ){										
											$name=$customField['clean_name'];
										}else{
											$name=$id;
										} 

										//specific id defined?
										if(isset($customField['ids']) && is_array($customField['options'])){
											$option_id=$customField['ids'][$field_counter-1];  
										}else{
											$option_id=$id.'-'.$field_counter;
										}

										if($class == "pattern_list"){
											if ($field_value==$option_value){
												 echo '<td><div class="first_div '.$class.'"><div class="radio_cover checked radio_'.$option_value.' '.$class.'">';
												 echo '<input type="radio" name="'.$name.'" value="'.$option_value.'"  id="'.$option_id.'" checked></div></div>';
												 echo '<label for="'.$option_id.'">'.$option_name.'</label>';
												 echo '</td>';
											}else{
												 echo '<td><div class="first_div '.$class.'"><div class="radio_cover radio_'.$option_value.' '.$class.'">';
												 echo '<input type="radio" name="'.$name.'" value="'.$option_value.'"  id="'.$option_id.'"></div></div>';
												 echo '<label for="'.$option_id.'">'.$option_name.'</label>';
												 echo '</td>';
											}
										}else{
											if ($field_value==$option_value){
												echo '<span class="radio_button_holder">';
												echo '<input type="radio" name="'.$name.'" value="'.$option_value.'" checked id="'.$option_id.'">';
												echo '<label for="'.$option_id.'">'.$option_name.'</label>'; 								
												echo '</span>';
											}else{
												echo '<span class="radio_button_holder">';
												echo '<input type="radio" name="'.$name.'" value="'.$option_value.'" id="'.$option_id.'">';
												echo '<label for="'.$option_id.'">'.$option_name.'</label>'; 									
												echo '</span>';
											}
										} 

										$field_counter++;
									}
 
									if($class == "pattern_list"){
										echo '</tr></table>';
									}else{
										echo '</div>';
									}
									
									
								echo '</div></td>';
								echo @$help;
								echo '    </tr>';
								echo '</table>';	 
								break;


						 
								#
								#	Select
								#
								case 'select';														

								echo '<table>';
								echo '    <tr>';
								echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
								if($description) echo '<div class="desc">'.$description.' '.( ($showDefault) ?  "Default Value = ".$showDefault : "" ) .'</div>';
								if($showDefault) echo '<div class="desc">Default Value = '.$showDefault.'</div>';								
								echo '	</td>';
								echo '    </tr>';
								
								//font demo
								$fontDemo 	=  (!empty($customField['font-demo'])) ? $customField['font-demo'] : "";
								
								//font system
								$fontSystem 	=  (!empty($customField['font-system'])) ? $customField['font-system'] : "";

								//class
								$class 		=  (!empty($customField['class'])) ? $customField['class'] : "";

								//side button
								if(!empty($customField['sidebuttonName'])){
									$side_button='<input type="button" value="'.$customField['sidebuttonName'].'" id="'.$customField['id'].'" class="'.$customField['sidebuttonClass'].'"/>';
								}else{
									$side_button= "";
								}

								if(!empty($fontDemo)){
	
								$selectedFont = isset($google_fonts[$field_value][0]) ? $google_fonts[$field_value][0] : "";


								echo '    <tr>';
								echo '	<td class="col1" colspan="2">';
								echo '	<iframe scrolling="no" id="'.$id.'_iframe" class="fontdemo" src="'.THEMEADMINURI.'/pages/rt-fonts.php?font='.$field_value.'&system='.$customField['font-system'].'&font_face='.$selectedFont.'&family_name='.$selectedFont.'">Your browser does not support iframes.</iframe>';								
								echo '	</td>';
								echo '    </tr>';
								} 
								 
								$extraClass  =  (!empty($customField['sidebuttonName'])) ? "withbutton": '';
								
								echo '    <tr>';
								echo '	<td class="col2"><div class="form_element">';
								echo '	<select name="'.$id.'" id="'.$id.'" class="'.$class.' '.$fontSystem.' '. $extraClass .' ">';
									
									if($customField['select']) echo '<option value="">'.$customField['select'].'</option>';
									    
									foreach($customField['options'] as $option_value => $option_name){					
										//if array
										if(is_array($option_name)){
											$option_name = $option_name[1];
											$font_family_name = $google_fonts[$option_value][0]; 
										}else{ 
											$font_family_name = ""; 
										}
										
										if (strpos($option_value,"-optgroup-start",0)){
											 echo '<optgroup label="'.$option_name.'">';
										}elseif (strpos($option_value,"-optgroup-end",0)){
											 echo '</optgroup>'; 
										}else{
											if ($field_value==$option_value){
												 echo '<option value="'.$option_value.'"  class="'.@$font_family_name.'__" selected>'.$option_name.'</option>';
											}else{
												 echo '<option value="'.$option_value.'"  class="'.@$font_family_name.'__" >'.$option_name.'</option>';
											}
										}
										
										
									} 
									    
								echo '	</select>';
								echo $side_button;
								echo '</div></td>';
								echo @$customField[ 'help' ];
								echo '    </tr>';
								echo '</table>';		
								
								break;


								case 'selectmultiple':{
									//Multiple Select
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">'.($description).'</div>';
									echo '	</td>';
									echo '    </tr>';
									 
						
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element">';
						
									
									$saved_array=$field_value; 
						 
						
									echo '<select multiple name="'.$id.'" id="'.$id.'" class="multiple '.@$customField['class'].' '.@$customField['font-system'].'"  title="'.__('Select','rt_theme_admin').'">';
								
										foreach($customField['options'] as $option_value => $option_name){
											$selected = "";
											
											//if value selected
											if(is_array($saved_array)){
												
												foreach($saved_array as $a_key => $a_value){
													if (	$a_value ==  $option_value ){
														$selected="selected";  
													}
													
												}
											}
								
											//if array
											if(is_array($option_name)){
												$option_name = $option_name[1];
											}
											
											if(!$option_value) $option_value=" ";
								
											echo '<option value="'.$option_value.'" '.$selected.'>'.$option_name.'</option>'; 
										}
										
						
									echo '	</select>';
									echo '</div></td>';
									echo @$help;
									echo '    </tr>';
									echo '</table>';		
								
									break;
								}
			 
								case 'textarea':{
									// Textarea
								
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">' . ($description) . '</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>'; 

										if($richEditor && function_exists('wp_editor') ){
											echo '<td class="col2"><div class="form_element">';
											wp_editor( htmlspecialchars_decode( $field_value ), ''.$id.'', array('quicktags' => array( 'buttons' => 'em,strong,link' ),'textarea_name'	=> ''.$id.'','quicktags'=> true,'tinymce'=> true) );
											echo '</div>';
										}else{
											echo '<td class="col2"><div class="form_element"><textarea name="'.$id.'" id="'.$id.'" >'.htmlspecialchars($field_value).'</textarea></div>';
										}										

									echo '	</td>';
									echo @$help;
									echo '    </tr>';
									echo '</table>';
					
									break;
								}


								#
								#	Upload
								#
								case 'upload';
								
								echo '<table><tr><td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
								if($description) echo '<div class="desc">' . ($description) . '</div>';
								echo '</td></tr><tr>
								<td class="col2">
								<div class="form_element upload"><input autocomplete="off" type="text" name="'.$id.'" value="'.$field_value.'" id="'.$id.'" class="upload_field">  
								<button data-inputid="'.$id.'" class="template_button light rttheme_upload_button" type="button">'.__('Upload','rt_theme_admin').'</button>

								';	
								echo '</div>'; 				

								echo ($field_value) ? '<div data-holderid="'.$id.'" class="uploaded_file visible">' : '<div data-holderid="'.$id.'" class="uploaded_file ">'; 

									if($field_value){
										echo '<img class="loadit" src="'.$field_value.'"  data-image="'.$id.'" >';
									}else{ 
										echo '<img class="loadit" src="'.THEMEADMINURI.'/images/blank.png"  data-image="'.$id.'">';	 			
									}  

								echo '<span class="icon-cancel delete_single" title="'.__("remove image","rt_theme_admin").'" data-inputid="'.$id.'"><img src="'.THEMEADMINURI.'/images/delete.png" class="delete_image '.$id.'" id="delete_'.$id.'"></span>';
								echo '</div>';
								echo '</td></tr></table>';		
								
								break;


								
								case 'heading':	{		
											
									echo '<table class="seperator">';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><h4 class="sub_title">'.$title.'</h4>';
									echo '	    <div class="desc">'.($description).'</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '</table>';
									
									break;
								}

								
								case 'hidden':	{												
									echo '	<input type="hidden" name="'. $id .'" value="'.$field_value.'" id="' . $id .'">'; 									
									break;
								}								

								#
								#	Range input
								#
								case 'rangeinput':	{		
								
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">'.($description).'</div>';
									if($showDefault) echo '<div class="desc">Default Value = '.$showDefault.'</div>';								
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element"><input type="text" class="range" name="'.$id.'" id="'.$id.'" min="'.@$customField[ 'min' ].'" max="'.@$customField[ 'max' ].'" step="1" value="'.$field_value.'" /></div></td>';
									echo @$help;
									echo '    </tr>';
									echo '</table>';		
									
									break;
								}

								#
								#	Info Text  
								#
								case 'info_text_only';			
									
								echo '<table>';
								echo '    <tr>';
								echo '	<td class="col1" colspan="2"><div class="info_text">'.$description.'</div>';
								echo '	</td>';
								echo '    </tr>';
								echo '</table>'; 	
								
								break;

								#
								#	Info Text - with value
								#
								case 'info_text';			
								
								echo '<table>';
								echo '    <tr>';
								echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
								if($description) echo '<div class="desc">'.$description.'</div>';
								echo '	</td>';
								echo '    </tr>';
								echo '    <tr>';
								echo '	<td class="col2"><div class="form_element">'.$description.'</div></td>';
								echo @$help;
								echo '    </tr>';
								echo '</table>';		
								
								break;
								#
								#	Color Picker
								#
								case 'colorpicker';
								
								echo '<table>';
								echo '    <tr>';
								echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
								if($description) echo '<div class="desc">'.$description.'</div>';
								echo '	</td>';
								echo '    </tr>';
								echo '    <tr>';
								echo '	<td class="col2"><div class="color-picker-holder"><div class="form_element color"><input type="text" name="'.$id.'" value="'.$field_value.'" id="'.$id.'"></div>';
								echo '	<div class="'.$id.' colorSelector"><div style="background-color: '.$field_value.'"></div></div></div></td>';
								echo @$help;
								echo '    </tr>';
								echo '</table>';
	
								$RTadmin = new RTThemeAdmin();
								$RTadmin->color_picker($id,$field_value);
								
								break;

								default: {
									// Plain text field 
								
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="' . $id .'">' . $title . '</label>';
									if($description) echo '<div class="desc">' . ($description) . '</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element"><input type="text" name="'. $id .'" value="'.$field_value.'" id="' . $id .'"></div></td>';
									echo @$help;
									echo '    </tr>';
									echo '</table>';
								}
							}

							//	HR
							if(isset($customField[ 'hr' ])=="true") echo "<hr />";

							?>						

					<?php
					}
				} ?>
			</div>
			<?php
		}
		
		#
		# Save Images into the uploads dir
		#
		function get_content($url)
		{
		    $ch = curl_init();
		
		    curl_setopt ($ch, CURLOPT_URL, $url);
		    curl_setopt ($ch, CURLOPT_HEADER, 0);
		
		    ob_start();
		
		    curl_exec ($ch);
		    curl_close ($ch);
		    $string = ob_get_contents();
		
		    ob_end_clean();
		   
		    return $string;    
		}

		function save_video_images($url){
			
			$saved_image_url ="";
			
			//find the video id
			$video_id = find_tube_video_id($url);
			
			//get uploads dir of WP
			$uploads = wp_upload_dir();
			
			//wich service
			if( strpos($url, 'youtube')  ) $type = 'youtube';			
			if( strpos($url, 'vimeo')  ) $type = 'vimeo';


			if( function_exists('file_get_contents') ) {
				if(isset($type) && isset($video_id)){
				
					//Youtube image					
					if($type=='youtube') $image = 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
				
					//Vimeo image					
					if($type=='vimeo'){
						$hash = @unserialize($this->get_content("http://vimeo.com/api/v2/video/$video_id.php"));
						if($hash) $image = $hash[0]['thumbnail_large'];
					}
				
					if($image){
						$save_as = $uploads['path'].'/'.$video_id.'-'.$type.'.jpg';
						$get_image = @$this->get_content($image);
						if($get_image){
							@file_put_contents($save_as, $get_image);
							$saved_image_url = $uploads['url'].'/'.$video_id.'-'.$type.'.jpg';
						}
					}
				}	
			}
			
			return $saved_image_url;
		}


		#
		# Save the new Custom Fields values
		# 
		function saveCustomFields( $post_id ) {
			global $post;
			$theFields = isset ( $_POST[ $this->settings['slug'].'_wpnonce' ] )  ? $_POST[ $this->settings['slug'].'_wpnonce' ] : "" ;

			if (!wp_verify_nonce( $theFields, $this->settings['slug'] ) )
				return $post_id;
			
			foreach ( $this->customFields as $customField ) {
				
				$customField_Name = isset( $customField['name'] ) ? $customField['name'] : "";
				$customField[ 'default' ] = isset( $customField['default'] ) ? $customField['default'] : "";

				if ( current_user_can( $this->settings['capability'], $post_id ) ) {
					
					$value = isset( $_POST[ $this->prefix . str_replace("[]","", $customField_Name) ] ) ? $_POST[ $this->prefix . str_replace("[]","", $customField_Name) ] : "";				
								
								//save tube image
								if($this->prefix . $customField_Name == $this->prefix .'_portfolio_video'){							
									
									$save_tube_thumbnail = $this->save_video_images($value);							
		
									//update thumbnail
									if($save_tube_thumbnail) {
										update_post_meta( $post_id, $this->prefix . '_portfolio_video_thumbnail', $save_tube_thumbnail );
									}else{
										delete_post_meta( $post_id, $this->prefix . '_portfolio_video_thumbnail' );
									}
								}

					
						if ( isset( $_POST[ $this->prefix . $customField_Name ] ) || isset( $_POST[ $this->prefix . str_replace("[]","", $customField_Name) ] )  ) {								
							update_post_meta( $post_id, $this->prefix . $customField_Name, $value );				
						} else {
							delete_post_meta( $post_id, $this->prefix . $customField_Name );
						}

						//post_format fix
						if ( isset( $_POST[ "post_format" ] ) && isset( $customField['clean_name'] ) && $customField['clean_name'] == "post_format"  ) {
							update_post_meta( $post_id, "post_format", $_POST[ "post_format" ] );
						} 						
						
						//custom styling								
						if($this->prefix . $customField_Name  == $this->prefix."_custom_styling" ){
							if( 
								( isset( $_POST[ $this->prefix."_google_fonts_body" ] ) && 	$_POST[ $this->prefix."_google_fonts_body" ] != "" )
									||
								( isset( $_POST[ $this->prefix."_google_fonts_heading" ] ) && $_POST[ $this->prefix."_google_fonts_heading" ] != "")
							){
								$custom_styling = TRUE;
							}
						}
	
	
						//text font sizes
						if($this->prefix . $customField_Name  == $this->prefix."_text_font_size" ){
							if($value == @$customField[ 'default' ] ){
								delete_post_meta( $post_id, $this->prefix . '_text_font_size');		
							}else{
								$custom_styling = TRUE;
							}
						}
	
						//heading font sizes
						if($this->prefix . $customField_Name  == $this->prefix."_heading_font_size" ){
							if($value == @$customField[ 'default' ] ){
								delete_post_meta( $post_id, $this->prefix . '_heading_font_size');		
							}else{
								$custom_styling = TRUE;
							}
						}
	
						//text font color
						if($this->prefix . $customField_Name  == $this->prefix."_text_font_color" ){
							if($value == @$customField[ 'default' ] ){
								delete_post_meta( $post_id, $this->prefix . '_text_font_color');		
							}else{
								$custom_styling = TRUE;
							}
						}	
	
						//heading font color
						if($this->prefix . $customField_Name  == $this->prefix."_heading_font_color" ){
							if($value == @$customField[ 'default' ] ){
								delete_post_meta( $post_id, $this->prefix . '_heading_font_color');		
							}else{
								$custom_styling = TRUE;
							}
						}

						//link font color
						if($this->prefix . $customField_Name  == $this->prefix."_link_font_color" ){
							if($value == @$customField[ 'default' ] ){
								delete_post_meta( $post_id, $this->prefix . '_link_font_color');		
							}else{
								$custom_styling = TRUE;
							}
						}

						//box background color
						if($this->prefix . $customField_Name  == $this->prefix."_box_bg_color" ){
							if($value == @$customField[ 'default' ] ){
								delete_post_meta( $post_id, $this->prefix . '_box_bg_color');		
							}else{
								$custom_styling = TRUE;
							}
						}

						if(isset($custom_styling) && $custom_styling === TRUE ){
							update_post_meta( $post_id, $this->prefix . '_custom_styling', "custom_styled" ); 
						}else{
							delete_post_meta( $post_id, $this->prefix . '_custom_styling');						
						}

				}
			}
		}
		 
	} // End Class
 
?>