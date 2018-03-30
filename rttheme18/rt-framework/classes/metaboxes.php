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
		
		var $prefix = RT_COMMON_THEMESLUG;
		var $customFields;
		var $settings;
		
 
		/**
		* Constructor
		*/
		function __construct($settings,$customFields) {

			$this->settings = $settings;
			$this->customFields = $customFields;
			
			add_action( 'admin_menu', array( &$this, 'createCustomFields' ));
			add_action( 'save_post', array( &$this, 'saveCustomFields' ));			
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
			global $post,$rt_google_fonts;			
			
			$fontSystem = $extraClass = "";
			?>
			 <div class="right-col metaboxes">
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


					$id             = $this->prefix . $customField[ 'name' ];
					$title          = isset( $customField[ 'title' ] ) ? $customField[ 'title' ] : "";
					$description    = isset( $customField[ 'description' ] ) ? $customField[ 'description' ]: "";
					$check_desc     = isset( $customField[ 'check_desc' ] ) ? $customField[ 'check_desc' ]: "";
					$class          = isset( $customField[ 'class' ] ) ? $customField[ 'class' ]: "";
					$richEditor     = isset( $customField[ 'richeditor' ] ) ? $customField[ 'richeditor' ]: "";
					$label_position = isset( $customField[ 'label_position' ] ) ? $customField[ 'label_position' ]: "";
 
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
					

					//labels 
					$description = ! empty( $showDefault ) ? $description . "<br /> Default Value = ".$showDefault." " : $description ;
					$label_stlye = ! empty( $label_position ) ? "labels_block" : "";
					$desc_row = ! empty( $description ) ? '<tr><td colspan="2"><div class="info icon-info-circled desc"><p>'.$description.'</p></div></td></tr>' : "";
					$help_icon = ! empty( $description ) ? '<span title="'.__('click to show tips','rt_theme_admin').'" class="tooltip_icon icon-help-circled"></span>' : "";
					$title_col = ! empty( $title) ? '<th><div>'.$help_icon.'<label for="'.$id.'">'.$title.'</label></div></th>' : "" ;
					$label = '<table class="table-row '.$label_stlye.'"> '.$desc_row.'<tr>'.$title_col;

					// Output if allowed
					if ( $output ) { ?>

							<?php
							switch ( $customField[ 'type' ] ) {



								case 'tab_titles';
								#	tab titles

								$titles_output = '<ul>';

								foreach ($customField['tab_names'] as $tab_id => $tab_name) {									
									$add_class = ! empty( $tab_name[1] ) ? "with_icon" : "";
									$icon_output = ! empty( $tab_name[1] ) ? '<span class="'.$tab_name[1].'"></span>' : "";
									$titles_output .= sprintf( '<li class="%s"><a href="#%s">%s %s</a></li>',$add_class, $tab_id,$icon_output,$tab_name[0]);
								}

								$titles_output .= "</ul>";

								echo $titles_output;
								 								
								break;


								case 'table_start';
								#	table Start

								echo '<table class="table_master"><tr><td class="td_master">';		
								
								break;
 
								case 'table_end';
								#	table End			

								echo '</td></tr></table>';	
								
								break;				

								case 'td_col';			
								#	td split

								echo '</td><td class="td_master">';	
								
								break;		


								case "group_start": {
									// group start
									echo '<div id="'.$id.'" class="'.$class.'">';
									break;
								}
								case "group_end": {
									// group end
									echo '</div>';
									break;
								}								  


								#
								#	Checkbox
								#
								case 'checkbox2'; 

								echo '<table class="table-row"><tr><td><div class="form_element check rt_checkbox "><input autocomplete="off" class="checkbox '.$class.'" type="checkbox" name="'.$id.'"';
									
									if($field_value=="checked" || $field_value=="on"){
										echo ' checked="checked" '; 
										$label_class="icon-check";
									}else{
										$label_class="icon-check-empty";
									}
									
									echo 'id="'.$id.'"/><div class="'.$label_class.'">'.$title.'';

									echo ! empty( $description ) ? '<div class="desc">'.$description.'</div>' : "";

								echo '</label></div></td></tr></table>'; 

								break;

								#
								#	Checkbox 2
								#
								case 'checkbox';  

								echo $label.'<td><div class="form_element check rt_checkbox"><input autocomplete="off" class="checkbox '.$class.'" type="checkbox" name="'.$id.'"';
									
									if($field_value=="checked" || $field_value=="on"){
										echo ' checked="checked" '; 
										$label_class="icon-check";
									}else{
										$label_class="icon-check-empty";
									}
									
									echo 'id="'.$id.'"/><div class="'.$label_class.'">'.$check_desc.''; 

								echo '</div></div></td></tr></table>'; 

								break;


								#
								#	Radio Buttons
								#
								
 								case 'radio';
 
								echo $label .'<td class="col2"><div class="check"> ';				    				 
							
				
									if($class == "pattern_list") {
										echo '<table class="image_radio '.$class.' " id="'.$id.'"><tr>';
									}else{
										echo '<div id="'.$id.'">';
									}
								 

									//post formats
									$post_format_value = get_post_format( $post->ID );



									$field_counter = 1;
									foreach($customField['options'] as $option_value => $option_name){					
										//if array
										if(is_array($option_name)){
											$option_name = $option_name[1];
										}
										
										//new post format value
										if( isset( $post_format_value ) &&  $option_value == $post_format_value ){
											$option_value =  $field_value; 
										} 				

										if( ( isset( $customField['clean_name'] ) && $customField['clean_name'] == "post_format" ) && (  $post_format_value ) ){						
											$field_value = $post_format_value ;
										}

										//clean name
										if( isset( $customField['clean_name'] ) ){										
											$name = $customField['clean_name'];
										}else{
											$name = $id;
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
										 
									
								echo '</div></td></tr></table>';	 
								break; 

						 
								#
								#	Select
								#
								case 'select';														
  
								echo $label .'<td class="col2"><div class="form_element">';
								echo '<select name="'.$id.'" id="'.$id.'" class="'.$class.' '.$fontSystem.' '. $extraClass .' ">';
									
									if($customField['select']) echo '<option value="">'.$customField['select'].'</option>';
									    
									foreach($customField['options'] as $option_value => $option_name){					
										//if array
										if(is_array($option_name)){
											$option_name = $option_name[1];
											$font_family_name = $rt_google_fonts[$option_value][0]; 
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
									    
								echo '</select></div></td></tr></table>';		
								
								break;

								#
								#	Select Multiple
								#
								case 'selectmultiple':{
									//Multiple Select
									echo $label .'<td class="col2"><div class="form_element">';

									$saved_array=$field_value; 
						
									echo '<select multiple name="'.$id.'" id="'.$id.'" class="multiple '.$class.' "  title="'.__('Select','rt_theme_admin').'">';
								
										foreach($customField['options'] as $option_value => $option_name){
											$selected = "";
											
											//if value selected
											if(is_array($saved_array)){
												
												foreach($saved_array as $a_key => $a_value){
													if ( $a_value ==  $option_value ){
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
										
						
									echo '</select>';
									echo '</div></td>'; 
									echo '</tr>';
									echo '</table>';		
								
									break;
								}
			 
								case 'textarea':{
									// Textarea
								
									echo $label;

										if($richEditor && function_exists('wp_editor') ){
											echo '<td class="col2"><div class="form_element">';
											wp_editor( htmlspecialchars_decode( $field_value ), ''.$id.'', array('quicktags' => array( 'buttons' => 'em,strong,link' ),'textarea_name'	=> ''.$id.'','quicktags'=> true,'tinymce'=> true) );
											echo '</div>';
										}else{
											echo '<td class="col2"><div class="form_element"><textarea name="'.$id.'" id="'.$id.'" >'.htmlspecialchars($field_value).'</textarea></div>';
										}										

									echo '</td></tr></table>';
					
									break;
								}
				 


								#
								#	Upload
								#
								case 'upload';
								
								echo $label.'
								<td class="col2">
								<div class="form_element upload"><input autocomplete="off" type="text" name="'.$id.'" value="'.$field_value.'" id="'.$id.'" class="upload_field">  
								<button data-inputid="'.$id.'" class="icon-upload template_button light rttheme_upload_button" type="button">'.__('Upload','rt_theme_admin').'</button>

								';	
								echo '</div>';

								//the file extention
								$ext = pathinfo($field_value, PATHINFO_EXTENSION);

								//is the file an image?
								if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
									$ext_image = true;
								}else{
									$ext_image = false;
								}												

								echo ($field_value && $ext_image) ? '<div data-holderid="'.$id.'" class="uploaded_file visible">' : '<div data-holderid="'.$id.'" class="uploaded_file ">'; 

									if($field_value){
										echo '<img class="loadit" src="'.$field_value.'"  data-image="'.$id.'" >';
									}else{ 
										echo '<img class="loadit" src="'.RT_THEMEADMINURI.'/images/blank.png"  data-image="'.$id.'">';	 			
									}  

								echo '<span class="icon-cancel delete_single" title="'.__("remove image","rt_theme_admin").'" data-inputid="'.$id.'"></span>';
								echo '</div>';
								echo '</td></tr></table>';		
								
								break;



								#
								#	Headings
								#
								case 'heading';			
								echo '<table class="seperator"><tr><td class="col1" colspan="2"><h4 class="sub_title icon-angle-down">'.$title.'</h4>';
								if($description) echo '<div class="desc">'.$description.'</div>';
								echo '</td></tr></table>'; 		
								
								break;


								#
								#	Hidden
								#								
								case 'hidden':	{												
									echo '	<input type="hidden" name="'. $id .'" value="'.$field_value.'" id="' . $id .'">'; 									
									break;
								}								

								#
								#	Range input
								#
								case 'rangeinput':	{		

									echo $label.'<td class="col2"><div class="form_element"><input type="text" class="range" name="'.$id.'" id="'.$id.'" min="'.@$customField[ 'min' ].'" max="'.@$customField[ 'max' ].'" step="1" value="'.$field_value.'" /></div></td>';
									echo '</tr></table>';		
									
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
								
								echo $label.'<td class="col2"><div class="color-picker-holder"><div class="form_element color"><input type="text" name="'.$id.'" value="'.$field_value.'" id="'.$id.'"></div>';
								echo '<div class="'.$id.' colorSelector"><div style="background-color: '.$field_value.'"></div></div></div></td>';
								echo '</tr></table>';
	
								$RTadmin = new RTThemeAdmin();
								$RTadmin->color_picker($id,$field_value);
								
								break;


								default: {
									// Plain text field 
								
									echo $label.'<td class="col2"><div class="form_element"><input type="text" class="'.$class.'" name="'. $id .'" value="'.$field_value.'" id="' . $id .'"></div></td>';
									echo '</tr></table>';
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
		   	$string = wp_remote_get( $url, array( 'timeout' => 120, 'httpversion' => '1.1' ) ); 

		    return $string["body"];    
		}

		function save_video_images($url){
			
			$saved_image_url ="";
			
			//find the video id
			$video_id = rt_find_tube_video_id($url);
			
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

			if ( ! wp_verify_nonce( $theFields, $this->settings['slug'] ) ){
				return $post_id;
			}
	
			
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
 
				}
			}
		}
		 
	} // End Class
 
?>