<?php

/*************************************************************************************
 *	Options Admin Interface
 *************************************************************************************/
 
function om_options_add_admin() {

  add_theme_page(__('Theme Options', 'om_theme'), __('Theme Options', 'om_theme'), 'edit_theme_options', 'om_options','om_options_page');

} 

add_action('admin_menu', 'om_options_add_admin');

/*************************************************************************************
 *	Reset/Import/Export Options
 *************************************************************************************/
 
function om_options_rie() {
	
  // Reset Options
  if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'om_options' && isset($_REQUEST['om_options_action']) && $_REQUEST['om_options_action'] == 'reset') {
		$options_template =  get_option(OM_THEME_PREFIX.'options_template');
		om_reset_options($options_template,'om_options');
		header("Location: admin.php?page=om_options&reset=true");
		die;
  }

	// Export Options
  if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'om_options' && isset($_REQUEST['om_options_action']) && $_REQUEST['om_options_action'] == 'export') {
  	$dump=om_options_export_dump();
  	header("Content-Type: text/plain");
  	header("Content-Length: ".strlen($dump)."\n\n");
  	header("Content-Disposition: attachment; filename=".OM_THEME_NAME.".options.dat");
		echo $dump;
		die;
  }
  
  // Import Options
  if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'om_options' && isset($_REQUEST['om_options_action']) && $_REQUEST['om_options_action'] == 'import' ) {
  	if(@$_FILES['import_file']['tmp_name']) {
  		if ( om_options_do_import($_FILES['import_file']['tmp_name']) ) {
				header("Location: admin.php?page=om_options&import_ok=true");
				die;
  		}
  	}
  	header("Location: admin.php?page=om_options&import_error=true");
		die;
  }
  
}

add_action('admin_init', 'om_options_rie');

function om_options_do_import($file) {
	$s=trim(file_get_contents($file));
	$options=@unserialize($s);
	
	return om_options_do_import_data($options);
}

function om_options_do_import_data($options) {
	if(is_array($options)) {
		if($options['theme_prefix'] == OM_THEME_PREFIX) {
			foreach($options['options'] as $k=>$v) {
				update_option($k, $v);
			}
			do_action('om_options_updated');
			return true;
		}
	}
	
	return false;
}

/*************************************************************************************
 *	Options Reset Function
 *************************************************************************************/

function om_reset_options($options,$page = '') {

	$options_template = get_option(OM_THEME_PREFIX.'options_template');
	
	foreach($options_template as $option) {
		if(isset($option['id'])) {
			update_option($option['id'], $option['std']);
		}
	}
	
	do_action('om_options_updated');
}

/*************************************************************************************
 *	Build the Options Page
 *************************************************************************************/

function om_options_page(){
    $options =  get_option(OM_THEME_PREFIX.'options_template');
	?>

	<div class="wrap" id="om-container">
		<div id="om-popup-save" class="om-popup"><div><?php _e('Options Updated', 'om_theme'); ?></div></div>
		<div id="om-popup-reset" class="om-popup"><div><?php _e('Options Reset', 'om_theme'); ?></div></div>
		<div id="om-popup-import-ok" class="om-popup"><div><?php _e('Options Imported', 'om_theme'); ?></div></div>
		<div id="om-popup-import-error" class="om-popup"><div><?php _e('Sorry, there has been an error while import', 'om_theme'); ?></div></div>
		<form action="" enctype="multipart/form-data" id="om-options-form">
			<div id="om-container-header">
				<div class="icon-options"></div>
				<div class="logo">
					<h2><?php _e('Theme Options', 'om_theme'); ?></h2>
				</div>
				<div class="clear"></div>
		   </div>
			<?php $options_html = om_options_generator($options);	?>
			<div class="save_bar top">
				<img style="display:none;margin-right:7px;vertical-align:middle" src="<?php echo TEMPLATE_DIR_URI ?>/admin/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
				<input type="submit" value="<?php _e('Save All Changes','om_theme');?>" class="button-primary" />
			</div>
			<div id="om-container-pane">
				<div id="om-options-sections">
					<ul>
						<?php echo $options_html['menu']; ?>
					</ul>
				</div>
				<div id="om-options-content">
					<?php echo $options_html['options']; ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="save_bar bottom">
				<input type="button" value="<?php _e('Reset Options','om_theme');?>" class="button submit-button reset-button" onclick="if(confirm('Click OK to reset. Any settings will be lost!')){document.getElementById('om-options-form-reset').submit()}">
				<img style="display:none;margin-right:7px;vertical-align:middle" src="<?php echo TEMPLATE_DIR_URI ?>/admin/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
				<input type="submit" value="<?php _e('Save All Changes','om_theme');?>" class="button-primary" />
			</div>
		</form>
		<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" id="om-options-form-reset">
			<input type="hidden" name="om_options_action" value="reset" />
		</form>
	</div>
	
	<div class="clear"></div>
	<p><a href="#" onclick="jQuery('#om_options_import_export').slideToggle(200);return false;"><?php _e('(+) Export / Import Options','om_theme'); ?></a></p>
	
	<div id="om_options_import_export" style="display:none;border-left:1px solid #eee;padding-left:20px">
		<b><?php _e('Export:','om_theme'); ?></b>
		<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" target="_blank">
			<input type="submit" value="<?php _e('Download Export File','om_theme');?>" class="button" />
			<input type="hidden" name="om_options_action" value="export" />
		</form>
	
		<br />
		<b><?php _e('Import:','om_theme'); ?></b>
		<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" enctype="multipart/form-data">
			<?php _e('Choose a file from your computer:','om_theme'); ?>
			<input type="file" name="import_file" size="25" />
			<input type="submit" value="<?php _e('Upload and Import','om_theme');?>" class="button" />
			<input type="hidden" name="om_options_action" value="import" />
		</form>
	</div>

	<div class="clear"></div>
<?php
}

/*************************************************************************************
 *	Load required styles and scripts for Options Page
 *************************************************************************************/
 
function om_enqueue_scripts_options_scripts($hook) {
	if('appearance_page_om_options' != $hook) {
		return;
	}
	
	wp_enqueue_style('admin-style', TEMPLATE_DIR_URI.'/admin/admin-style.css', array(), OM_THEME_VERSION);
	wp_enqueue_style('wp-color-picker');

	add_action('admin_head', 'om_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('wp-color-picker');
	om_enqueue_admin_browse_button();
	wp_enqueue_script('theme-options', TEMPLATE_DIR_URI.'/admin/js/theme-options.js', array(), OM_THEME_VERSION);

}
add_action('admin_enqueue_scripts', 'om_enqueue_scripts_options_scripts');


function om_admin_head() {
	?>
 	<script type="text/javascript" language="javascript">
		jQuery(function($){
	
			<?php if(isset($_REQUEST['reset'])) { ?>
				var reset_popup = jQuery('#om-popup-reset');
				reset_popup.fadeIn();
				window.setTimeout(function(){
					reset_popup.fadeOut();                        
				}, 2000);
			<?php } ?>
			
			<?php if(isset($_REQUEST['import_ok'])) { ?>
				var import_ok_popup = jQuery('#om-popup-import-ok');
				import_ok_popup.fadeIn();
				window.setTimeout(function(){
					import_ok_popup.fadeOut();                        
				}, 3000);
			<?php } ?>

			<?php if(isset($_REQUEST['import_error'])) { ?>
				var import_ok_error = jQuery('#om-popup-import-error');
				import_ok_error.fadeIn();
				window.setTimeout(function(){
					import_ok_error.fadeOut();                        
				}, 4000);
			<?php } ?>

		});
		</script>
<?php
}

/*************************************************************************************
 *	Ajax Save Action
 *************************************************************************************/

add_action('wp_ajax_om_theme_options_ajax', 'om_ajax_callback');

function om_ajax_callback() {
	global $wpdb; // this is how you get access to the database

	$save_type = $_POST['type'];
	
	if ( get_magic_quotes_gpc() ) {
		$_POST = stripslashes_deep( $_POST );
	}
	
	if ($save_type == 'options') {
		
		$data = $_POST['data'];
		
		parse_str($data,$output);
		$output=array_map( 'stripslashes_deep', $output );
		
   	$options = get_option(OM_THEME_PREFIX.'options_template');
		
		foreach($options as $option_array) {

			if(isset($option_array['id'])) { // Non - Headings...

				$id = $option_array['id'];
				$old_value = get_option($id);
				$new_value = '';
				
				if(isset($output[$id])){
					$new_value = $output[$option_array['id']];
				}
		
				$type = $option_array['type'];
				
				if($new_value == '' && $type == 'checkbox'){ // Checkbox Save

					update_option($id,'false');
				}
				elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save
					
					update_option($id,'true');
				}
				elseif($type == 'multicheck'){ // Multi Check Save
					
					$option_options = $option_array['options'];

					$tmp=array();					
					foreach ($option_options as $options_id => $options_value){
						
					  $tmp[$options_id]=isset($output[$id][$options_id]);
					}
					update_option($id,$tmp);
				} 
				elseif($type == 'typography'){
						
					$typography_array = array();	
					
					$typography_array['size'] = $output[$option_array['id'] . '_size'];
						
					$typography_array['face'] = $output[$option_array['id'] . '_face'];
						
					$typography_array['style'] = $output[$option_array['id'] . '_style'];
						
					$typography_array['color'] = $output[$option_array['id'] . '_color'];
						
					update_option($id,$typography_array);
						
				}
				elseif($type == 'border'){
						
					$border_array = array();	
					
					$border_array['width'] = $output[$option_array['id'] . '_width'];
						
					$border_array['style'] = $output[$option_array['id'] . '_style'];
						
					$border_array['color'] = $output[$option_array['id'] . '_color'];
						
					update_option($id,$border_array);
						
				}
				elseif($type == 'slider'){
						
					if(is_array(@$output[$id]))
					{
						unset($output[$id]['SLIDE_INDEX']); // it's an extra record, that is actually the template
						// sort sections
						$section_sort=array();
						foreach($output[$id] as $section_index=>$section)
						{
							$section_sort[$section_index]=intval($section['ord']);
							if(!$section_sort[$section_index])
								$section_sort[$section_index]=100;
						}
						$section_sort=array_reverse($section_sort,true); // save positions on same ord
						asort($section_sort);
						$new_output=array();
						foreach($section_sort as $section_index=>$v)
						{
							$new_output[]=$output[$id][$section_index];
						}
						$output[$id]=$new_output;
						
					}
					else
						$output[$id]=array();
					
					update_option($id,$output[$id]);
						
				}
				elseif($type == 'form_fields'){
						
					if(!is_array(@$output[$id]))
						$output[$id]=array();
					
					update_option($id,$output[$id]);
				}
				elseif($type == 'styling_presets'){
					$tmp=array();
					
					if(is_array($option_array['options'])) {
						foreach($option_array['options'] as $k) {
							$tmp[$k]=@$output[$k];
						}
					}
					$name=$output[$id.'_new'];
					if($name) {
						$output[$id] = get_option($id);
						$output[$id][$name] = $tmp;
						update_option($id,$output[$id]);
					}
				}
				elseif($type != 'upload_min'){
				
					update_option($id,$new_value);
				}
			}	
		}
		
		do_action('om_options_updated');
		
	}
	// Applt Styling
	elseif ($save_type == 'style_preset_apply') {
		
		$data = $_POST['data'];
		if(@$data['id'] && @$data['name']) {
			$presets = get_option($data['id']);
			$data['name']=urldecode($data['name']);
			
			if(is_array(@$presets[$data['name']])) {
				foreach($presets[$data['name']] as $k=>$v) {
					update_option($k,$v);
				}
			}
			
			do_action('om_options_updated');
			
		}
	}
	// Remove Styling
	elseif ($save_type == 'style_preset_remove') {
		
		$data = $_POST['data'];
		if(@$data['id'] && @$data['name']) {
			
			$presets = get_option($data['id']);
			unset($presets[urldecode($data['name'])]);
			
			update_option($data['id'],$presets);
			
		}
	}
	
  die();

}


/*************************************************************************************
 *	Generates The Options
 *************************************************************************************/
 
function om_options_generator($options) {

  $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {
	   
		$counter++;
		$val = '';
		//Start Heading
		if ( $value['type'] != "heading" )
		{
			$output .= '<div class="om-options-section section-'.$value['type'].'">';
			if(@$value['mode'] == 'toggle') {
				$output .= '<h3 class="heading"><a href="#" onclick="jQuery(\'#'.$value['id'].'-container\').slideToggle(300);return false">'. $value['name'] .' [+]</a></h3>';
				$output .= '<div class="option" id="'.$value['id'].'-container" style="display:none"><div class="om-options-controls">';
			} else {
				$output .= '<h3 class="heading">'. $value['name'] .'</h3>';
				$output .= '<div class="option"><div class="om-options-controls">';
			}
		}
		//End Heading
		$select_value = '';                                   
		switch ( $value['type'] ) {
		
			case 'text':
				$val = $value['std'];
				$std = get_option($value['id']);
				if ( $std != "")
					$val = $std;
				$output .= '<input name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. esc_attr($val) .'" class="om-options-input" />';
			break;
			
			case 'select':
	
				$output .= '<select name="'. $value['id'] .'" id="'. $value['id'] .'" class="om-options-input">';
				$select_value = get_option($value['id']);
				foreach ($value['options'] as $option) {
					$selected = '';
					 if($select_value != '') {
						 if ( $select_value == $option )
						 	$selected = ' selected="selected"';
				   } else {
						 if ( isset($value['std']) )
							 if ($value['std'] == $option)
							 	$selected = ' selected="selected"';
					 }
					 $output .= '<option'. $selected .'>'.$option.'</option>';
				 } 
				 $output .= '</select>';
			break;
			
			case 'select-cat':
				
				$val = $value['std'];
				$std = get_option($value['id']);
				if ( $std != "") { $val = $std; }
				
				$args = array(
					'show_option_all'    => __('All Categories', 'om_theme'),
					'show_option_none'   => __('No Categories', 'om_theme'),
					'hide_empty'         => 0, 
					'echo'               => 0,
					'selected'           => $val,
					'hierarchical'       => 0, 
					'name'               => $value['id'],
					'class'              => 'postform',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => 'category',
					'hide_if_empty'      => false 	
				);
		
				 $output .= '<div class="om-options-input">'.wp_dropdown_categories( $args ).'</div>';
			break;
			
			case 'select-page':
				
				$val = $value['std'];
				$std = get_option($value['id']);
				if ( $std != "") { $val = $std; }
				
				$args = array(
					'selected'         => $val,
					'echo'             => 0,
					'name'             => $value['id']
				);
		
				$output .= '<div class="om-options-input">'.wp_dropdown_pages( $args ).'</div>';
			break;

			case 'select-tax':
				
				$val = $value['std'];
				$std = get_option($value['id']);
				if ( $std != "") { $val = $std; }
				
				$args = array(
					'show_option_all'    => __('All', 'om_theme').' '.$value['taxonomy'],
					'show_option_none'   => __('No', 'om_theme').' '.$value['taxonomy'],
					'hide_empty'         => 0, 
					'echo'               => 0,
					'selected'           => $val,
					'hierarchical'       => 0, 
					'name'               => $value['id'],
					'class'              => 'postform',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => $value['taxonomy'],
					'hide_if_empty'      => false 	
				);
		
				$output .= '<div class="om-options-input">'.@wp_dropdown_categories( $args ).'</div>';
			break;
			
			case 'select2':
	
				$output .= '<select name="'. $value['id'] .'" id="'. $value['id'] .'" class="om-options-input">';
			
				$select_value = get_option($value['id']);
				 
				foreach ($value['options'] as $option => $name) {
					
					$selected = '';
					
					 if($select_value != '') {
						 if ( $select_value == $option) { $selected = ' selected="selected"';} 
				     } else {
						 if ( isset($value['std']) )
							 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
					 }
					  
					 $output .= '<option'. $selected .' value="'.$option.'">'.$name.'</option>';
				 
				 } 
				 $output .= '</select>';
			break;

			case 'textarea':
				
				$cols = '8';
				$ta_value = '';
				if(isset($value['std'])) {
					
					$ta_value = $value['std']; 
					
					if(isset($value['options'])){
						$ta_options = $value['options'];
						if(isset($ta_options['cols'])){
						$cols = $ta_options['cols'];
						} else { $cols = '8'; }
					}
					
				}
				$std = get_option($value['id']);
				if( $std != "") { $ta_value = stripslashes( $std ); }
				$output .= '<textarea name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8" class="om-options-input">'.esc_textarea($ta_value).'</textarea>';
			break;

			case "radio":
				
				 $select_value = get_option( $value['id']);
					   
				 foreach ($value['options'] as $key => $option) 
				 { 
	
					 $checked = '';
					   if($select_value != '') {
							if ( $select_value == $key) { $checked = ' checked'; } 
					   } else {
						if ($value['std'] == $key) { $checked = ' checked'; }
					   }
					$output .= '<input type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
				
				}
			break;

			case "checkbox": 
			
				$std = $value['std'];  
				$saved_std = get_option($value['id']);
				$checked = '';
				
				if(!empty($saved_std)) {
					if($saved_std == 'true') {
					$checked = 'checked="checked"';
					}
					else{
					   $checked = '';
					}
				}
				elseif( $std == 'true') {
				   $checked = 'checked="checked"';
				}
				else {
					$checked = '';
				}
				$output .= '<input type="checkbox" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';
			break;
			
			case "multicheck":
			
				$std =  $value['std'];         
				$saved_std = get_option($value['id']);
				
				foreach ($value['options'] as $key => $option) {
												 
					if(!empty($saved_std)) { 
					  if($saved_std[$key] == 'true'){
						 $checked = 'checked="checked"';  
					  } 
					  else{
						  $checked = '';   
					  }    
					} 
					elseif( $std[$key] == 'true') {
					  $checked = 'checked="checked"';
					}
					else {
						$checked = '';                                                                                    }
					
					$output .= '<input type="checkbox" name="'. $value['id'] .'['.$key.']" id="'. $value['id'] .'_'.$key .'" value="true" '. $checked .' /><label for="'. $value['id'] .'_'.$key .'">'. $option .'</label><br />';

				}
			break;
			
			case "upload":
				
				$output .= om_options_uploader_generator($value['id'],$value['std'],null);
			break;

			case "upload_min":
				
				$output .= om_options_uploader_generator($value['id'],$value['std'],'min');
			break;
			
			case "note":
			
				$output .= '<div class="notes"><p>'. $value['message'] .'</p></div>';
			break;
			
			case "intro":
			
				$output .= '<div class="intro"><p>'. $value['message'] .'</p></div>';
			break;

			case "subheader":
			
				$output .= '<div class="subheader"><p>'. $value['message'] .'</p></div>';
			break;
						
			case "color":
			
				$val = $value['std'];
				$stored  = get_option( $value['id'] );
				if ( $stored != "") { $val = $stored; }
				$output .= '<input class="wp-color-picker-field" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. esc_attr($val) .'" data-default-color="'. esc_attr($val) .'" />';
				
			break;   
			
			case "typography":
			
				$default = $value['std'];
				$typography_stored = get_option($value['id']);
				
				/* Font Size */
				$val = $default['size'];
				if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
				$output .= '<select class="om-option-typography om-option-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
					for ($i = 9; $i < 71; $i++){ 
						if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
						$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }
				$output .= '</select>';
			
				/* Font Face */
				$val = $default['face'];
				if ( $typography_stored['face'] != "") 
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
	
				if (strpos($val, 'Arial, sans-serif') !== false){ $font01 = 'selected="selected"'; }
				if (strpos($val, 'Verdana, Geneva') !== false){ $font02 = 'selected="selected"'; }
				if (strpos($val, 'Trebuchet') !== false){ $font03 = 'selected="selected"'; }
				if (strpos($val, 'Georgia') !== false){ $font04 = 'selected="selected"'; }
				if (strpos($val, 'Times New Roman') !== false){ $font05 = 'selected="selected"'; }
				if (strpos($val, 'Tahoma, Geneva') !== false){ $font06 = 'selected="selected"'; }
				if (strpos($val, 'Palatino') !== false){ $font07 = 'selected="selected"'; }
				if (strpos($val, 'Helvetica') !== false){ $font08 = 'selected="selected"'; }
				
				$output .= '<select class="om-option-typography om-option-typography-face" name="'. $value['id'].'_face" id="'. $value['id'].'_face">';
				$output .= '<option value="Arial, sans-serif" '. $font01 .'>Arial</option>';
				$output .= '<option value="Verdana, Geneva, sans-serif" '. $font02 .'>Verdana</option>';
				$output .= '<option value="&quot;Trebuchet MS&quot;, Tahoma, sans-serif"'. $font03 .'>Trebuchet</option>';
				$output .= '<option value="Georgia, serif" '. $font04 .'>Georgia</option>';
				$output .= '<option value="&quot;Times New Roman&quot;, serif"'. $font05 .'>Times New Roman</option>';
				$output .= '<option value="Tahoma, Geneva, Verdana, sans-serif"'. $font06 .'>Tahoma</option>';
				$output .= '<option value="Palatino, &quot;Palatino Linotype&quot;, serif"'. $font07 .'>Palatino</option>';
				$output .= '<option value="&quot;Helvetica Neue&quot;, Helvetica, sans-serif" '. $font08 .'>Helvetica</option>';
				$output .= '</select>';
			
				/* Font Weight */
				$val = $default['style'];
				if ( $typography_stored['style'] != "") { $val = $typography_stored['style']; }
					$normal = ''; $italic = ''; $bold = ''; $bolditalic = '';
				if($val == 'normal'){ $normal = 'selected="selected"'; }
				if($val == 'italic'){ $italic = 'selected="selected"'; }
				if($val == 'bold'){ $bold = 'selected="selected"'; }
				if($val == 'bold italic'){ $bolditalic = 'selected="selected"'; }
				
				$output .= '<select class="om-option-typography om-option-typography-style" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';
				$output .= '<option value="normal" '. $normal .'>Normal</option>';
				$output .= '<option value="italic" '. $italic .'>Italic</option>';
				$output .= '<option value="bold" '. $bold .'>Bold</option>';
				$output .= '<option value="bold italic" '. $bolditalic .'>Bold/Italic</option>';
				$output .= '</select>';
				
				/* Font Color */
				$val = $default['color'];
				if ( $typography_stored['color'] != "") { $val = $typography_stored['color']; }			
				$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
				$output .= '<input class="om-option-color om-option-typography om-option-typography-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';
	
			break;  
			
			case "border":
			
				$default = $value['std'];
				$border_stored = get_option( $value['id'] );
				
				/* Border Width */
				$val = $default['width'];
				if ( $border_stored['width'] != "") { $val = $border_stored['width']; }
				$output .= '<select class="om-option-border om-option-border-width" name="'. $value['id'].'_width" id="'. $value['id'].'_width">';
					for ($i = 0; $i < 21; $i++){ 
						if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
						$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }
				$output .= '</select>';
				
				/* Border Style */
				$val = $default['style'];
				if ( $border_stored['style'] != "") { $val = $border_stored['style']; }
					$solid = ''; $dashed = ''; $dotted = '';
				if($val == 'solid'){ $solid = 'selected="selected"'; }
				if($val == 'dashed'){ $dashed = 'selected="selected"'; }
				if($val == 'dotted'){ $dotted = 'selected="selected"'; }
				
				$output .= '<select class="om-option-border om-option-border-style" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';
				$output .= '<option value="solid" '. $solid .'>Solid</option>';
				$output .= '<option value="dashed" '. $dashed .'>Dashed</option>';
				$output .= '<option value="dotted" '. $dotted .'>Dotted</option>';
				$output .= '</select>';
				
				/* Border Color */
				$val = $default['color'];
				if ( $border_stored['color'] != "") { $val = $border_stored['color']; }			
				$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
				$output .= '<input class="om-option-color om-option-border om-option-border-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';
	
			break;   
			
			case "images":
				$i = 0;
				$select_value = get_option( $value['id']);
					   
				foreach ($value['options'] as $key => $option) { 
					$i++;
	
					$checked = '';
					$selected = '';
				  if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'om-radio-img-selected'; } 
				  } else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'om-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'om-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'om-radio-img-selected'; }
						else { $checked = ''; }
					}	
					
					$output .= '<span>';
					$output .= '<input type="radio" id="om-radio-img-' . $value['id'] . $i . '" class="checkbox om-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
					$output .= '<div class="om-radio-img-label">'. $key .'</div>';
					$output .= '<img src="'.$option.'" alt="" class="om-radio-img-img '. $selected .'" onClick="document.getElementById(\'om-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
					$output .= '</span>';
					
				}
			break; 
			
			case "info":
				$default = $value['std'];
				$output .= $default;
			break;                                   
			
			case 'slider':
				$val = $value['std'];
				$std = get_option($value['id']);
				if ( $std != "")
					$val = $std;

				//templates			
				$output .='
					<div class="hide" id="om-slider-'.$value['id'].'-slide-template">
						<div style="float:right;margin-top:8px"><small>'.__('Slide order priority:','om_theme').'</small> <input type="text" name="'.$value['id'].'[SLIDE_INDEX][ord]" style="width:40px" value="100"></div>
						<p><b>Slide</b>&nbsp;&nbsp;&nbsp;<span class="om_remove_simple_slider_section button">'.__('Remove','om_theme').'</span></p>
						<div class="clear"></div>
						<div><small>'.__('Slide title:','om_theme').'</small></div>
						<input type="text" name="'.$value['id'].'[SLIDE_INDEX][title]" class="om-options-input" />
						<div><small>'.__('Slide Image (minimal size 480x328, will be resized automatically if bigger):','om_theme').'</small></div>
						'.om_options_uploader_generator($value['id'].'[SLIDE_INDEX][bgimage]','',null,true,array('width'=>480, 'height'=>328, 'crop'=>'true')).'
						<div class="clear" style="height:20px"></div>
						<div><small>'.__('Slide Video Embed Code (fill this field instead of uploading image if you want video,<br />size: any, it will be fitted):','om_theme').'</small></div>
						<textarea name="'.$value['id'].'[SLIDE_INDEX][video_embed]" rows="8" class="om-options-input"></textarea>
						<div><small>'.__('Slide description:','om_theme').'</small></div>
						<textarea name="'.$value['id'].'[SLIDE_INDEX][description]" rows="8" class="om-options-input"></textarea>
						<div><small>'.__('Slide Details Link:','om_theme').'</small></div>
						<input type="text" name="'.$value['id'].'[SLIDE_INDEX][link]" class="om-options-input"><br/>
						<div class="clear" style="height:10px"></div>
					</div>
				';
/*
*/
				$output.= '<div class="om-slider" rel="'.$value['id'].'">';

				$last_slide_index=0;
				if(!empty($val))
				{
					foreach($val as $slide)
					{
						$output.='
						<div class="om-slider-section">
							<div style="float:right;margin-top:8px"><small>'.__('Slide order priority:','om_theme').'</small> <input type="text" name="'.$value['id'].'['.$last_slide_index.'][ord]" style="width:40px" value="'.($slide['ord']?$slide['ord']:'100').'"></div>
							<p><b>Slide</b>&nbsp;&nbsp;&nbsp;<span class="om_remove_simple_slider_section button">'.__('Remove','om_theme').'</span></p>
							<div class="clear"></div>
							<div><small>'.__('Slide title:','om_theme').'</small></div>
							<input type="text" name="'.$value['id'].'['.$last_slide_index.'][title]" value="'. esc_attr($slide['title']) .'" class="om-options-input"/>
							<div><small>'.__('Slide Image (minimal size 480x328, will be resized automatically if bigger):','om_theme').'</small></div>
							'.om_options_uploader_generator($value['id'].'['.$last_slide_index.'][bgimage]',$slide['bgimage'],null,true,array('width'=>480, 'height'=>328, 'crop'=>'true')).'
							<div class="clear" style="height:20px"></div>
							<div><small>'.__('Slide Video Embed Code (fill this field instead of uploading image if you want video,<br />size: any, it will be fitted):','om_theme').'</small></div>
							<textarea name="'.$value['id'].'['.$last_slide_index.'][video_embed]" rows="8" class="om-options-input">'.esc_textarea($slide['video_embed']).'</textarea>
							<div><small>'.__('Slide description:','om_theme').'</small></div>
							<textarea name="'.$value['id'].'['.$last_slide_index.'][description]" rows="8" class="om-options-input">'.esc_textarea($slide['description']).'</textarea>
							<div><small>'.__('Slide Details Link:','om_theme').'</small></div>
							<input type="text" name="'.$value['id'].'['.$last_slide_index.'][link]" value="'. esc_attr($slide['link']) .'" class="om-options-input"><br/>
								
							<div class="clear" style="height:10px"></div>
						</div>
						';
/*
*/
						$last_slide_index++;
					}
				}
				
				$output.='
					
					<span class="button om_add_simple_slider_section_button" rel="'.$value['id'].'">+ Add Slide</span>

					<script>
						if(typeof(om_simple_slider_max_slide_index) == "undefined")
							var om_simple_slider_max_slide_index={};
						om_simple_slider_max_slide_index["'.$value['id'].'"]='.$last_slide_index.';
					</script>
					
					</div>
				';
				
			break;		


			case "form_fields": 
			
				$std = $value['std'];  
				$saved_std = get_option($value['id']);
				if(!is_array($saved_std))
					$saved_std=array();

				for($i=0;$i<10;$i++) {
					$output .= __('<b>Field','om_theme').' '.($i+1).'</b><br/>';
					$output .= __('Name:','om_theme').' <input type="text" name="'.  $value['id'] .'['.$i.'][name]" value="'.esc_attr(@$saved_std[$i]['name']).'" /><br/>';
					$output .= __('Type:','om_theme').' <select style="width:120px" name="'.  $value['id'] .'['.$i.'][type]"><option value="text">String</option><option value="textarea"'.(@$saved_std[$i]['type']=='textarea'?' selected="selected"':'').'>Textarea</option><option value="checkbox"'.(@$saved_std[$i]['type']=='checkbox'?' selected="selected"':'').'>Checkbox</option></select> &nbsp;&nbsp;&nbsp;';
					$output .= __('Required:','om_theme').' <input type="checkbox" name="'.  $value['id'] .'['.$i.'][required]" '.(@$saved_std[$i]['required']?' checked="checked"':'').' />';
					$output .= '<br/><div style="border-bottom:1px dotted #aaa"></div><br/>';
				}
			break;
			
			case "styling_presets": 
			
				$saved_std = get_option($value['id']);
				if(!is_array($saved_std))
					$saved_std=array();

				if(empty($saved_std))
					$output .= '<i>'.__('No presets created yet.','om_theme').'</i><br />';
				else {
					$output .= '<table border="0" cellpadding="10" cellspacing="0">';
					foreach($saved_std as $k=>$v) {
						$output .= '<tr>
							<td style="border-bottom:1px dotted #aaa"><b>'.esc_html($k).'</b></td>
							<td style="border-bottom:1px dotted #aaa"><span class="button om-style-apply-button" id="'.$value['id'].'_apply" data-optionid="'.$value['id'].'" data-optionname="'.urlencode($k).'">'.__('Apply','om_theme').'</span></td>
							<td style="border-bottom:1px dotted #aaa"><span class="button om-style-remove-button" id="'.$value['id'].'_apply" data-optionid="'.$value['id'].'" data-optionname="'.urlencode($k).'">'.__('Remove','om_theme').'</span></td>
						</tr>';
					}
					$output .= '</table><br />';
				}
				$output .= '<br /><b>'.__('Save current styling options as new preset:','om_theme').'</b><br/>Name: <input type="text" name="'.$value['id'].'_new" style="width:60%" /> <span class="button " id="om-styling-button-save">'.__('Save','om_theme').'</span> <br />';
			break;
						
			case "heading":
				
				if($counter >= 2){
				   $output .= '</div>'."\n";
				}
				$jquery_click_hook = preg_replace("/[^A-Za-z0-9]/", "", strtolower($value['name']) );
				$jquery_click_hook = "om-option-section-" . $jquery_click_hook;
				$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
				$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
			break;
			
		} 
		
		if ( $value['type'] != "heading" ) { 
			if ( $value['type'] != "checkbox" ) 
				$output .= '<br/>';
			if(!isset($value['desc']))
				$explain_value = '';
			else
				$explain_value = $value['desc']; 
				
			$output .= '</div><div class="om-options-explain">'. $explain_value .'</div>';
			$output .= '<div class="clear"> </div></div></div>';
		}
	   
	}

	$output .= '</div>';
	return array('options'=>$output,'menu'=>$menu);

}

/*************************************************************************************
 *	Options Uploader
 *************************************************************************************/

function om_options_uploader_generator($id,$std,$mod,$skip_db=false,$thumb=false) {
    
	$val = $std;
	$std = get_option($id);
	if ( $std != "")
		$val = $std;
	$strip_id=str_replace(']','',str_replace('[','_',$id));

	$output = '
		<input name="'. $id .'" id="'. $strip_id .'_input" type="text" value="'. esc_attr($val) .'" class="om-options-input" />
		<div class="upload_button_div">
			<span class="button input-browse-button" id="'.$strip_id.'" rel="'. $strip_id .'_input" data-mode="preview" data-base-id="'.$strip_id.'" data-library="image" data-choose="'.__('Choose a file','om_theme').'" data-select="'.__('Select','om_theme').'">Browse Image</span>
			<span class="button input-browse-button-remove" id="'. $strip_id .'_remove" data-base-id="'.$strip_id.'" title="">'.__('Clear', 'om_theme').'</span>
		</div>
		<div class="clear"></div>
		<div class="om-option-image-preview" id="'.$strip_id.'_image">'.($val? '<a href="'.esc_url($val).'" target="_blank"><img src="'.esc_url($val).'" /></a>':'').'</div>
		<div class="clear"></div>
	';

	return $output;
	
}

/*************************************************************************************
 *	Export Options
 *************************************************************************************/
 
function om_options_export_dump() {

	$options =  get_option(OM_THEME_PREFIX.'options_template');

	$output = array('theme_prefix' => OM_THEME_PREFIX, 'options' => array());
	
	foreach ($options as $value) {
	   
	  if(isset($value['id']) && $value['id'])
	  {
	  	$output['options'][$value['id']] = get_option($value['id']);
	  }
  
	}

	return serialize($output);
}

?>
