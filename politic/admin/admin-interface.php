<?php

// Loading static framework options pages 
$functions_path = ICY_FILEPATH . '/admin/';

/*-----------------------------------------------------------------------------------*/
/* The Options Admin Interface - icy_add_admin 
/*-----------------------------------------------------------------------------------*/


function icy_add_admin() {
    global $query_string;
    $themename =  get_option('icy_themename');      
    $shortname =  get_option('icy_shortname'); 
    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'icy' ) {
		if (isset($_REQUEST['icy_save']) && 'reset' == $_REQUEST['icy_save']) {	
			$options =  get_option('icy_template'); 
			icy_reset_options($options,'icy');
			header("Location: admin.php?page=icy&reset=true");
			die;
		
		}
    }
    $icy_page = add_submenu_page('themes.php', $themename, 'Theme Options', 'edit_theme_options', 'icy','icys_options_page');
	add_action("admin_print_scripts-$icy_page", 'icy_load_only');
	add_action("admin_print_styles-$icy_page",'icy_style_only');
} 

add_action('admin_menu', 'icy_add_admin');

/*-----------------------------------------------------------------------------------*/
/* The Options Reset Function - icy_reset_options 
/*-----------------------------------------------------------------------------------*/

function icy_reset_options($options,$page = ''){

	global $wpdb;
	$query_inner = '';
	$count = 0;
	
	$excludes = array( 'blogname' , 'blogdescription' );
	
	foreach($options as $option){
			
		if(isset($option['id'])){ 
		
			$count++;
			$option_id = $option['id'];
			$option_type = $option['type'];
			
			// Trying to skip the assigned ids
			if(in_array($option_id,$excludes)) { continue; }
			
			if($count > 1){ $query_inner .= ' OR '; }
			if($option_type == 'multicheck'){
				
				$multicount = 0;
				
				foreach($option['options'] as $option_key => $option_option){
				
					$multicount++;
					if($multicount > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '" . $option_id . "_" . $option_key . "'";
					
				}
				
			} else if(is_array($option_type)) {
				$type_array_count = 0;
				foreach($option_type as $inner_option){
				
					$type_array_count++;
					$option_id = $inner_option['id'];
				
					if($type_array_count > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '$option_id'";
				}
				
			} else {
				
				$query_inner .= "option_name = '$option_id'";
				
			}
		}
			
	}
	
	if($page == 'icy'){
		$query_inner .= " OR option_name = 'icy_options'";
	}
	
	$query = "DELETE FROM $wpdb->options WHERE $query_inner";
	$wpdb->query($query);
		
}

/*-----------------------------------------------------------------------------------*/
/* Loading the required styles - icy_style_only */
/*-----------------------------------------------------------------------------------*/
function icy_style_only() {
	wp_enqueue_style('admin-style', ICY_DIRECTORY.'/admin/admin-style.css');
	wp_enqueue_style('color-picker', ICY_DIRECTORY.'/admin/css/colorpicker.css');
}	


/*-----------------------------------------------------------------------------------*/
/* Building the Options Page - icys_options_page */
/*-----------------------------------------------------------------------------------*/

function icys_options_page(){
    $options =  get_option('icy_template');      
    $themename =  get_option('icy_themename');
?>
<div class="wrap" id="icy_container">

	<div id="icy-popup-save" class="icy-save-popup">

    	<div class="icy-save-save">Options Updated</div>

    </div>
    
    <div id="icy-popup-reset" class="icy-save-popup">

    	<div class="icy-save-reset">Options Reset</div>

  	</div>
    
    <form action="" enctype="multipart/form-data" id="icyform">
    
    	<div id="header">

      		<div class="logo">
        	<h2><?php echo $themename; ?></h2>
	        </div>
    
        <div class="icon-option"></div>
    
        <div class="clear"></div>
    
    </div>
	
	<?php 
	    $return = icy_machine($options);
	?>
	
        <div id="main">
	
        	<div id="icy-nav">
	
            	<ul>
	
              		<?php echo $return[1] ?>
	
            	</ul>
	
            </div>
	
            <div id="content"> <?php echo $return[0]; /* Here are the Settings */ ?> </div>
	
            <div class="clear"></div>
	
        </div>
	
        <div class="save_bar_top">
	
        <img style="display:none" src="<?php echo get_stylesheet_directory_uri(); ?>/admin/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working." />
	
        <input type="submit" value="Save All Changes" class="button-primary" />
	
    </form>
	
    <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" id="icyform-reset" method="post" style="display:inline">
    
    	<span class="submit-footer-reset">
    
    	<input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('Click OK to reset. Any settings will be lost!');" />
    
    	<input type="hidden" name="icy_save" value="reset" />
    
    	</span>
	
    </form>

</div>

<?php  if(!empty($update_message)) echo $update_message; ?>

<div style="clear:both;"></div>

</div>
<?php
}




/*-----------------------------------------------------------------------------------*/
/* Loading the required javascripts for the Options Page - icy_load_only */
/*-----------------------------------------------------------------------------------*/

function icy_load_only() {

	add_action('admin_head', 'icy_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_register_script('jquery-input-mask', ICY_DIRECTORY.'/admin/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('jquery-input-mask');
	wp_enqueue_script('color-picker', ICY_DIRECTORY.'/admin/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload', ICY_DIRECTORY.'/admin/js/ajaxupload.js', array('jquery'));

}

function icy_admin_head() {
?>
  
<script type="text/javascript" language="javascript">
		
		jQuery(document).ready(function(){
			
		// Making sure that the js is loaded
		if (typeof AjaxUpload != 'function') { 
		 return ++counter < 6 && window.setTimeout(init, counter * 500);
		}
		
			//Color Picker
			<?php $options = get_option('icy_template');
			
			foreach($options as $option){ 
			if($option['type'] == 'color' OR $option['type'] == 'typography' OR $option['type'] == 'border'){
	
				if($option['type'] == 'typography' OR $option['type'] == 'border'){
					$option_id = $option['id'];
					$temp_color = get_option($option_id);
					$option_id = $option['id'] . '_color';
					$color = $temp_color['color'];
				}
	
				else {
					$option_id = $option['id'];
					$color = get_option($option_id);
				}
	
				?>
	
				 jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '<?php echo $color; ?>');    
				 jQuery('#<?php echo $option_id; ?>_picker').ColorPicker({
					color: '<?php echo $color; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);					
					}
				  });
			  <?php } } ?>
		 
		});
		
</script>
<script type="text/javascript">
	jQuery(document).ready(function(){
			
	var f = 0;
				
	jQuery('#expand_options').click(function(){
		if(f == 0){
			f = 1;
			jQuery('#icy_container #icy-nav').hide();
			jQuery('#icy_container #content').width(755);
			jQuery('#icy_container .group').add('#icy_container .group h2').show();
					jQuery(this).text('[-]');
				
		} else {
			f = 0;
			jQuery('#icy_container #icy-nav').show();
			jQuery('#icy_container #content').width(595);
			jQuery('#icy_container .group').add('#icy_container .group h2').hide();
			jQuery('#icy_container .group:first').show();
			jQuery('#icy_container #icy-nav li').removeClass('current');
			jQuery('#icy_container #icy-nav li:first').addClass('current');
			
			jQuery(this).text('[+]');
				
		}
			
	});
			
		jQuery('.group').hide();
		jQuery('.group:first').fadeIn();
		
		jQuery('.group .collapsed').each(function(){
			jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
				function(){
    				if (jQuery(this).hasClass('last')) {
    					jQuery(this).removeClass('hidden');
    						return false;
    				}
       					jQuery(this).filter('.hidden').removeClass('hidden');
       				});
           		});       					
				jQuery('.group .collapsed input:checkbox').click(unhideHidden);
				
				function unhideHidden(){
					if (jQuery(this).attr('checked')) {
						jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
					}
					else {
						jQuery(this).parent().parent().parent().nextAll().each( 
							function(){
           						if (jQuery(this).filter('.last').length) {
           							jQuery(this).addClass('hidden');
									return false;
           						}
           						jQuery(this).addClass('hidden');
           					});
           					
					}
				}
				
				jQuery('.icy-radio-img-img').click(function(){
					jQuery(this).parent().parent().find('.icy-radio-img-img').removeClass('icy-radio-img-selected');
					jQuery(this).addClass('icy-radio-img-selected');
					
				});
				jQuery('.icy-radio-img-label').hide();
				jQuery('.icy-radio-img-img').show();
				jQuery('.icy-radio-img-radio').hide();
				jQuery('#icy-nav li:first').addClass('current');
				jQuery('#icy-nav li a').click(function(evt){
				
						jQuery('#icy-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');
						
						var clicked_group = jQuery(this).attr('href');
		 
						jQuery('.group').hide();
						
							jQuery(clicked_group).fadeIn();
		
						evt.preventDefault();
						
					});
				
				if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){
					
					var reset_popup = jQuery('#icy-popup-reset');
					reset_popup.fadeIn();
					window.setTimeout(function(){
						   reset_popup.fadeOut();                        
						}, 2000);					
				}
				jQuery.fn.center = function () {
				this.animate({"top":( jQuery(window).height() - this.height() - 100 ) / 2+jQuery(window).scrollTop() + "px"},100);
				this.css("left", 250 );
				return this;
			}
		
			
			jQuery('#icy-popup-save').center();
			jQuery('#icy-popup-reset').center();
			jQuery(window).scroll(function() { 
			
				jQuery('#icy-popup-save').center();
				jQuery('#icy-popup-reset').center();
			
			});
			
			jQuery('.image_upload_button').each(function(){
			
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				  action: '<?php echo admin_url("admin-ajax.php"); ?>',
				  name: clickedID, 
				  data: { 
						action: 'icy_ajax_post_action',
						type: 'upload',
						data: clickedID },
				  autoSubmit: true, 
				  responseType: false,
				  onChange: function(file, extension){},
				  onSubmit: function(file, extension){
						clickedObject.text('Uploading');   
						this.disable();  
						interval = window.setInterval(function(){
							var text = clickedObject.text();
							if (text.length < 13){	clickedObject.text(text + '.'); }
							else { clickedObject.text('Uploading'); } 
						}, 200);
				  },
				  onComplete: function(file, response) {
				   
					window.clearInterval(interval);
					clickedObject.text('Upload Image');	
					this.enable();
					
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' + response + '</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);
					}
					else{
						var buildReturn = '<img class="hide icy-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';
						jQuery(".upload-error").remove();
						jQuery("#image_" + clickedID).remove();	
						clickedObject.parent().after(buildReturn);
						jQuery('img#image_'+clickedID).fadeIn();
						clickedObject.next('span').fadeIn();
						clickedObject.parent().prev('input').val(response);
					}
				  }
				});
			
			});
			
			jQuery('.image_reset_button').click(function(){
			
					var clickedObject = jQuery(this);
					var clickedID = jQuery(this).attr('id');
					var theID = jQuery(this).attr('title');		
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';				
					var data = {
						action: 'icy_ajax_post_action',
						type: 'image_reset',
						data: theID
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var image_to_remove = jQuery('#image_' + theID);
						var button_to_hide = jQuery('#reset_' + theID);
						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
						button_to_hide.fadeOut();
						clickedObject.parent().prev('input').val('');
					});					
					return false; 					
				});   	 	
			
			jQuery('#icyform').submit(function(){		
					function newValues() {
					  var serializedValues = jQuery("#icyform").serialize();
					  return serializedValues;
					}
					jQuery(":checkbox, :radio").click(newValues);
					jQuery("select").change(newValues);
					jQuery('.ajax-loading-img').fadeIn();
					var serializedReturn = newValues();	 
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
					var data = {
						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'icy'){ ?>
						type: 'options',
						<?php } ?>

						action: 'icy_ajax_post_action',
						data: serializedReturn
					};				
					jQuery.post(ajax_url, data, function(response) {
						var success = jQuery('#icy-popup-save');
						var loading = jQuery('.ajax-loading-img');
						loading.fadeOut();  
						success.fadeIn();
						window.setTimeout(function(){
						   success.fadeOut(); 												
						}, 2000);
					});					
					return false; 					
				});   	 					
			});
</script>
<?php
}
/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action - icy_ajax_callback */
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_icy_ajax_post_action', 'icy_ajax_callback');

function icy_ajax_callback() {
	global $wpdb;
	
	$save_type = $_POST['type'];
	if($save_type == 'upload'){
		
		$clickedID = $_POST['data'];
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
				$upload_tracking[] = $clickedID;
				update_option( $clickedID , $uploaded_file['url'] );
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; }
	}
	elseif($save_type == 'image_reset'){
			
			$id = $_POST['data'];
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	}	
	elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];
		
		parse_str($data,$output);
        	$options = get_option('icy_template');
		
		foreach($options as $option_array){

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';			
			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}	
			if(isset($option_array['id'])) { 			
					$type = $option_array['type'];
					if ( is_array($type)){
						foreach($type as $array){
							if($array['type'] == 'text'){
								$id = $array['id'];
								$std = $array['std'];
								$new_value = $output[$id];
								if($new_value == ''){ $new_value = $std; }
								update_option( $id, stripslashes($new_value));
							}
						}                 
					}
					elseif($new_value == '' && $type == 'checkbox'){ 
						update_option($id,'false');
					}
					elseif ($new_value == 'true' && $type == 'checkbox'){
						update_option($id,'true');
					}
					elseif($type == 'multicheck'){
						$option_options = $option_array['options'];						
						foreach ($option_options as $options_id => $options_value){						
							$multicheck_id = $id . "_" . $options_id;							
							if(!isset($output[$multicheck_id])){
							  update_option($multicheck_id,'false');
							}
							else{
							   update_option($multicheck_id,'true'); 
							}
						}
					} 
					elseif($type == 'border'){
							
						$border_array = array();						
						$border_array['style'] = $output[$option_array['id'] . '_style'];
						$border_array['color'] = $output[$option_array['id'] . '_color'];
						$border_array['width'] = $output[$option_array['id'] . '_width'];
						update_option($id,$border_array);
							
					}
					elseif($type == 'typography'){
							
						$typography_array = array();							
						$typography_array['size'] = $output[$option_array['id'] . '_size'];
						$typography_array['color'] = $output[$option_array['id'] . '_color'];
						$typography_array['face'] = stripslashes($output[$option_array['id'] . '_face']);
						$typography_array['style'] = $output[$option_array['id'] . '_style'];
						update_option($id,$typography_array);		
					}
					elseif($type != 'upload_min'){
						update_option($id,stripslashes($new_value));
					}
				}
			}	
	
	}

  die();

}


/*-----------------------------------------------------------------------------------*/
/* Generates The Options Within the Panel - icy_machine */
/*-----------------------------------------------------------------------------------*/

function icy_machine($options) {
        
    $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {
	   
		$counter++;
		$val = '';
		// Start the Heading
		 if ( $value['type'] != "heading" )
		 {
		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
			$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

		 } 
		// End Heading
		$select_value = '';                                   
		switch ( $value['type'] ) {
		
		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="icy-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
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
				$output .= '<textarea class="icy-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
			
			
		break;
		case 'select':

			$output .= '<select class="icy-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $option) {
				
				$selected = '';
				
				 	if($select_value != '') {
						 if ( $select_value == $option) { $selected = ' selected="selected"';} 
			     	} else {
						 if ( isset($value['std']) )
							 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
				 	}
				  
				 $output .= '<option'. $selected .'>';
				 $output .= $option;
				 $output .= '</option>';
			 
			} 
			$output .= '</select>';

			
		break;
		case 'select2':

			$output .= '<select class="icy-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $option => $name) {
				
				$selected = '';
				
					if($select_value != '') {
						if ( $select_value == $option) { $selected = ' selected="selected"';} 
			    	} else {
						if ( isset($value['std']) )
							if ($value['std'] == $option) { $selected = ' selected="selected"'; }
					}
				  
				 $output .= '<option'. $selected .' value="'.$option.'">';
				 $output .= $name;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
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
				$output .= '<input class="icy-input icy-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
			
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
			$output .= '<input type="checkbox" class="checkbox icy-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;
		case "multicheck":
			$std =  $value['std'];         
			foreach ($value['options'] as $key => $option) {							 
			$icy_key = $value['id'] . '_' . $key;
			$saved_std = get_option($icy_key);	
			if(!empty($saved_std)) 
			{ 
				  if($saved_std == 'true'){
					 $checked = 'checked="checked"';  
				  } 
				  else{
					  $checked = '';     
				  }    
			} 
			elseif( $std == $key) {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';                                                                                    }
			$output .= '<input type="checkbox" class="checkbox icy-input" name="'. $icy_key .'" id="'. $icy_key .'" value="true" '. $checked .' /><label for="'. $icy_key .'">'. $option .'</label><br />';
										
			}
		break;		
		case "note":
		
			$output .= '<div class="notes"><p>'. $value['message'] .'</p></div>';
			
		break;
		case "upload":
			
			$output .= icy_uploader_function($value['id'],$value['std'],null);
			
		break;
		case "upload_min":
			
			$output .= icy_uploader_function($value['id'],$value['std'],'min');
			
		break;
		case "color":
			$val = $value['std'];
			$stored  = get_option( $value['id'] );
			if ( $stored != "") { $val = $stored; }
			$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="icy-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
		break;   
		
		case "typography":
		
			$default = $value['std'];
			$typography_stored = get_option($value['id']);

			$val = $default['size'];
			if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
			$output .= '<select class="icy-typography icy-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
				for ($i = 9; $i < 71; $i++){ 
					if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
					$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }
			$output .= '</select>';
		
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
			if (strpos($val, 'Georgia') !== false){ $font03 = 'selected="selected"'; }
			if (strpos($val, 'Trebuchet') !== false){ $font04 = 'selected="selected"'; }			
			if (strpos($val, 'Times New Roman') !== false){ $font05 = 'selected="selected"'; }
			if (strpos($val, 'Tahoma, Geneva') !== false){ $font06 = 'selected="selected"'; }
			if (strpos($val, 'Helvetica') !== false){ $font07 = 'selected="selected"'; }
			if (strpos($val, 'Palatino') !== false){ $font08 = 'selected="selected"'; }

			
			$output .= '<select class="icy-typography icy-typography-face" name="'. $value['id'].'_face" id="'. $value['id'].'_face">';
			$output .= '<option value="Arial, sans-serif" '. $font01 .'>Arial</option>';
			$output .= '<option value="Verdana, Geneva, sans-serif" '. $font02 .'>Verdana</option>';
			$output .= '<option value="&quot;Trebuchet MS&quot;, Tahoma, sans-serif"'. $font03 .'>Trebuchet</option>';
			$output .= '<option value="Georgia, serif" '. $font04 .'>Georgia</option>';
			$output .= '<option value="&quot;Times New Roman&quot;, serif"'. $font05 .'>Times New Roman</option>';
			$output .= '<option value="Tahoma, Geneva, Verdana, sans-serif"'. $font06 .'>Tahoma</option>';
			$output .= '<option value="Palatino, &quot;Palatino Linotype&quot;, serif"'. $font07 .'>Palatino</option>';
			$output .= '<option value="&quot;Helvetica Neue&quot;, Helvetica, sans-serif" '. $font08 .'>Helvetica*</option>';
			$output .= '</select>';
			
			/* Font Weight */
			$val = $default['style'];
			if ( $typography_stored['style'] != "") { $val = $typography_stored['style']; }
				$normal = ''; $italic = ''; $bold = ''; $bolditalic = '';
			if($val == 'normal'){ $normal = 'selected="selected"'; }
			if($val == 'italic'){ $italic = 'selected="selected"'; }
			if($val == 'bold'){ $bold = 'selected="selected"'; }
			if($val == 'bold italic'){ $bolditalic = 'selected="selected"'; }
			
			$output .= '<select class="icy-typography icy-typography-style" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';
			$output .= '<option value="normal" '. $normal .'>Normal</option>';
			$output .= '<option value="italic" '. $italic .'>Italic</option>';
			$output .= '<option value="bold" '. $bold .'>Bold</option>';
			$output .= '<option value="bold italic" '. $bolditalic .'>Bold/Italic</option>';
			$output .= '</select>';
			
			/* Font Color */
			$val = $default['color'];
			if ( $typography_stored['color'] != "") { $val = $typography_stored['color']; }			
			$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="icy-color icy-typography icy-typography-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';

		break;  
		
		case "border":
		
			$default = $value['std'];
			$border_stored = get_option( $value['id'] );
			
			/* Border Width */
			$val = $default['width'];
			if ( $border_stored['width'] != "") { $val = $border_stored['width']; }
			$output .= '<select class="icy-border icy-border-width" name="'. $value['id'].'_width" id="'. $value['id'].'_width">';
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
			
			$output .= '<select class="icy-border icy-border-style" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';
			$output .= '<option value="solid" '. $solid .'>Solid</option>';
			$output .= '<option value="dashed" '. $dashed .'>Dashed</option>';
			$output .= '<option value="dotted" '. $dotted .'>Dotted</option>';
			$output .= '</select>';
			
			/* Border Color */
			$val = $default['color'];
			if ( $border_stored['color'] != "") { $val = $border_stored['color']; }			
			$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="icy-color icy-border icy-border-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';

		break;   
		
		case "images":
			$i = 0;
			$select_value = get_option( $value['id']);
				   
			foreach ($value['options'] as $key => $option) 
			 { 
			 $i++;

				 $checked = '';
				 $selected = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'icy-radio-img-selected'; } 
				    } else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'icy-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'icy-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'icy-radio-img-selected'; }
						else { $checked = ''; }
					}	
				
				$output .= '<span>';
				$output .= '<input type="radio" id="icy-radio-img-' . $value['id'] . $i . '" class="checkbox icy-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
				$output .= '<div class="icy-radio-img-label">'. $key .'</div>';
				$output .= '<img src="'.$option.'" alt="" class="icy-radio-img-img '. $selected .'" onClick="document.getElementById(\'icy-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
				$output .= '</span>';
				
			}
		
		break; 
		
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;                                   
		
		case "heading":
			
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = "icy-option-" . $jquery_click_hook;
			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
		break;                                  
		} 
		
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){
			
					$id = $array['id']; 
					$std = $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std){$std = $saved_std;} 
					$meta = $array['meta'];
					
					if($array['type'] == 'text') {
						 
						 $output .= '<input class="input-text-small icy-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
						 $output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
		}
		if ( $value['type'] != "heading" ) { 
			if ( $value['type'] != "checkbox" ) 
				{ 
				$output .= '<br/>';
				}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; } 
			$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";
			$output .= '<div class="clear"> </div></div></div>'."\n";
			}
	   
	}
    $output .= '</div>';
    return array($output,$menu);

}


/*-----------------------------------------------------------------------------------*/
/* Options Uploader - icy_uploader_function */
/*-----------------------------------------------------------------------------------*/

function icy_uploader_function($id,$std,$mod){
	$uploader = '';
    $upload = get_option($id);	
	if($mod != 'min') { 
			$val = $std;
            if ( get_option( $id ) != "") { $val = get_option($id); }
            $uploader .= '<input class="icy-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
	}
	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';
	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	$uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
	if(!empty($upload)){
    	$uploader .= '<a class="icy-uploaded-image" href="'. $upload . '">';
    	$uploader .= '<img class="icy-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
    	$uploader .= '</a>';
		}
	$uploader .= '<div class="clear"></div>' . "\n"; 
return $uploader;
}
?>
