<?php

/*-----------------------------------------------------------------------------------*/
/* Vergo Admin Interface - themnificthemes_add_admin */
/*-----------------------------------------------------------------------------------*/

// Load static framework options pages 
$functions_path = get_template_directory() . '/functions/';


function themnificthemes_add_admin() {

    global $query_string;
    global $current_user;
    $current_user_id = $current_user->ID;
    $super_user = get_option('framework_themnific_super_user');
    
    $themename =  get_option('themnific_themename');      
    $shortname =  get_option('themnific_shortname'); 
   
    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'themnificthemes' ) {
		if (isset($_REQUEST['themnific_save']) && 'reset' == $_REQUEST['themnific_save']) {

			$options =  get_option('themnific_template'); 
			themnific_reset_options($options,'themnificthemes');
			header("Location: admin.php?page=themnificthemes&reset=true");
			die;
		}
    }
    elseif ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'themnificthemes_framework_settings' ) {
		if (isset($_REQUEST['themnific_save']) && 'reset' == $_REQUEST['themnific_save']) {
		
			$options = get_option('themnific_framework_template'); 
			themnific_reset_options($options);
			header("Location: admin.php?page=themnificthemes_framework_settings&reset=true");
			die;
		}
    }
   
    
    // Check all the Options, then if the no options are created for a relative sub-page... it's not created.
	if(get_option('framework_themnific_backend_icon')) { $icon = get_option('framework_themnific_backend_icon'); }
	else { $icon = get_template_directory_uri(). '/functions/images/themnific-icon.png'; }
	
    if(function_exists('add_object_page'))
    {
     $themnificpage = add_object_page ('Page Title', $themename, 'edit_pages','themnificthemes', 'themnificthemes_options_page', $icon);
    }
    else
    {
    }
	

	
	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$themnificpage", 'themnific_load_only');

     
} 

add_action('admin_menu', 'themnificthemes_add_admin');

/*-----------------------------------------------------------------------------------*/
/* Vergo Reset Function - themnific_reset_options */
/*-----------------------------------------------------------------------------------*/

function themnific_reset_options($options,$page = ''){

	global $wpdb;
	$query_inner = '';
	$count = 0;
	
	$excludes = array( 'blogname' , 'blogdescription' );
	
	
	foreach($options as $option){
			
		if(isset($option['id'])){ 
			$count++;
			$option_id = $option['id'];
			$option_type = $option['type'];
			
			//Skip assigned id's
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
	
	//When Theme Options page is reset - Add the themnific_options option
	if($page == 'themnificthemes'){
		$query_inner .= " OR option_name = 'themnific_options'";
	}
	
	//echo $query_inner;
	
	$query = "DELETE FROM $wpdb->options WHERE $query_inner";
	$wpdb->query($query);
		
}




/*-----------------------------------------------------------------------------------*/
/* Framework options panel - themnificthemes_options_page */
/*-----------------------------------------------------------------------------------*/

function themnificthemes_options_page(){

    $options =  get_option('themnific_template');      
    $themename =  get_option('themnific_themename');      
    $shortname =  get_option('themnific_shortname');
    
    
    //Version in Backend Header
    $theme_data = wp_get_theme();
    $local_version = $theme_data['Version'];
    
    
   
	//add filter to make the rss read cache clear every 4 hours
	//add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 14400;' ) );
	
    //Check for latest version of the theme
	$update_message = '';
    if(get_option('framework_themnific_theme_version_checker') == 'true') {
        $update_message = themnificthemes_version_checker($local_version);
    }

?>
<div class="wrap" id="themnific_container">
<div id="themnific-popup-save" class="themnific-save-popup"><div class="themnific-save-save">Options Updated</div></div>
<div id="themnific-popup-reset" class="themnific-save-popup"><div class="themnific-save-reset">Options Reset</div></div>
    <form action="" enctype="multipart/form-data" id="themnificform">
        <div id="header">
             <div class="theme-info">
				<span class="theme"><?php echo $themename; ?> <?php echo $local_version; ?> - Theme Admin Panel</span>
			</div>
			<div class="clear"></div>
		</div>
        <?php 
		// Rev up the Options Machine
        $return = themnificthemes_machine($options);
        ?>
		<div id="support-links">
			<ul>
                <li class="right"><img style="display:none" src="<?php echo get_template_directory_uri(); ?>/functions/images/loading-top.gif" class="ajax-loading-img ajax-loading-img-top" alt="Working..." /><a href="#" id="expand_options">[+]</a> <input type="submit" value="Save All Changes" class="button submit-button" /></li>
			</ul>
		</div>
        <div id="main">
	        <div id="themnific-nav">
				<ul>
					<?php echo $return[1] ?>
				</ul>		
			</div>
			<div id="content">
	         <?php echo $return[0]; /* Settings */ ?>
	        </div>
	        <div class="clear"></div>
	        
        </div>
        <div class="save_bar_top">
        <img style="display:none" src="<?php echo get_template_directory_uri(); ?>/functions/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
        <input type="submit" value="Save All Changes" class="button submit-button" />        
        </form>
     
        <form action="<?php echo esc_html( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="themnificform-reset">
            <span class="submit-footer-reset">
            <input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('Click OK to reset. Any settings will be lost!');" />
            <input type="hidden" name="themnific_save" value="reset" /> 
            </span>
        </form>
       
        </div>
        <?php  if (!empty($update_message)) echo $update_message; ?>    

<div style="clear:both;"></div>    
</div><!--wrap-->

 <?php
}


/*-----------------------------------------------------------------------------------*/
/* themnific_load_only */
/*-----------------------------------------------------------------------------------*/

function themnific_load_only() {

	add_action('admin_head', 'themnific_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_register_script('jquery-ui-datepicker', get_template_directory_uri().'/functions/js/ui.datepicker.js', array( 'jquery-ui-core' ));
	wp_enqueue_script('jquery-ui-datepicker');
	wp_register_script('jquery-input-mask', get_template_directory_uri().'/functions/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('jquery-input-mask');
	
	function themnific_admin_head() { 
			
		echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/functions/admin-style.css" media="screen" />';
		echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/functions/css/jquery-ui-datepicker.css" />'
		
		 // COLOR Picker ?>
		<link rel="stylesheet" media="screen" type="text/css" href="<?php echo get_template_directory_uri(); ?>/functions/css/colorpicker.css" />
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/functions/js/colorpicker.js"></script>
		
		<script type="text/javascript" language="javascript">
		jQuery(document).ready(function(){
			
			//JQUERY DATEPICKER
			jQuery('.themnific-input-calendar').each(function (){
				jQuery('#' + jQuery(this).attr('id')).datepicker({showOn: 'button', buttonImage: '<?php echo get_template_directory_uri();?>/functions/images/calendar.gif', buttonImageOnly: true});
			});
			
			//JQUERY TIME INPUT MASK
			jQuery('.themnific-input-time').each(function (){
				jQuery('#' + jQuery(this).attr('id')).mask("99-9999999");
			});
			
			//Color Picker
			<?php $options = get_option('themnific_template');
			
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
						//jQuery(this).css('border','1px solid red');
						jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);
						
					}
				  });
			  <?php } } ?>
		 
		});
		
		</script> 
		<?php
		//AJAX Upload
		?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/functions/js/ajaxupload.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function(){
			
			var flip = 0;
				
			jQuery('#expand_options').click(function(){
				if(flip == 0){
					flip = 1;
					jQuery('#themnific_container #themnific-nav').hide();
					jQuery('#themnific_container #content').width(755);
					jQuery('#themnific_container .group').add('#themnific_container .group h2').show();
	
					jQuery(this).text('[-]');
					
				} else {
					flip = 0;
					jQuery('#themnific_container #themnific-nav').show();
					jQuery('#themnific_container #content').width(595);
					jQuery('#themnific_container .group').add('#themnific_container .group h2').hide();
					jQuery('#themnific_container .group:first').show();
					jQuery('#themnific_container #themnific-nav li').removeClass('current');
					jQuery('#themnific_container #themnific-nav li:first').addClass('current');
					
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
				
				jQuery('.themnific-radio-img-img').click(function(){
					jQuery(this).parent().parent().find('.themnific-radio-img-img').removeClass('themnific-radio-img-selected');
					jQuery(this).addClass('themnific-radio-img-selected');
					
				});
				jQuery('.themnific-radio-img-label').hide();
				jQuery('.themnific-radio-img-img').show();
				jQuery('.themnific-radio-img-radio').hide();
				jQuery('#themnific-nav li:first').addClass('current');
				jQuery('#themnific-nav li a').click(function(evt){
				
						jQuery('#themnific-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');
						
						var clicked_group = jQuery(this).attr('href');
		 
						jQuery('.group').hide();
						
							jQuery(clicked_group).fadeIn();
		
						evt.preventDefault();
						
					});
				
				if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){
					
					var reset_popup = jQuery('#themnific-popup-reset');
					reset_popup.fadeIn();
					window.setTimeout(function(){
						   reset_popup.fadeOut();                        
						}, 2000);
						//alert(response);
					
				}
					
			//Update Message popup
			jQuery.fn.center = function () {
				this.animate({"top":( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px"},100);
				this.css("left", 250 );
				return this;
			}
		
			
			jQuery('#themnific-popup-save').center();
			jQuery('#themnific-popup-reset').center();
			jQuery(window).scroll(function() { 
			
				jQuery('#themnific-popup-save').center();
				jQuery('#themnific-popup-reset').center();
			
			});
			
			
		
			//AJAX Upload
			jQuery('.image_upload_button').each(function(){
			
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				  action: '<?php echo admin_url("admin-ajax.php"); ?>',
				  name: clickedID, // File upload name
				  data: { // Additional data to send
						action: 'themnific_ajax_post_action',
						type: 'upload',
						data: clickedID },
				  autoSubmit: true, // Submit file after selection
				  responseType: false,
				  onChange: function(file, extension){},
				  onSubmit: function(file, extension){
						clickedObject.text('Uploading'); // change button text, when user selects file	
						this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
						interval = window.setInterval(function(){
							var text = clickedObject.text();
							if (text.length < 13){	clickedObject.text(text + '.'); }
							else { clickedObject.text('Uploading'); } 
						}, 200);
				  },
				  onComplete: function(file, response) {
				   
					window.clearInterval(interval);
					clickedObject.text('Upload Image');	
					this.enable(); // enable upload button
					
					// If there was an error
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' + response + '</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);
					
					}
					else{
						var buildReturn = '<img class="hide themnific-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

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
			
			//AJAX Remove (clear option value)
			jQuery('.image_reset_button').click(function(){
			
					var clickedObject = jQuery(this);
					var clickedID = jQuery(this).attr('id');
					var theID = jQuery(this).attr('title');	
	
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				
					var data = {
						action: 'themnific_ajax_post_action',
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
	
	
		
			//Save everything else
			jQuery('#themnificform').submit(function(){
				
					function newValues() {
					  var serializedValues = jQuery("#themnificform").serialize();
					  return serializedValues;
					}
					jQuery(":checkbox, :radio").click(newValues);
					jQuery("select").change(newValues);
					jQuery('.ajax-loading-img').fadeIn();
					var serializedReturn = newValues();
					 
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				
					 //var data = {data : serializedReturn};
					var data = {
						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'themnificthemes'){ ?>
						type: 'options',
						<?php } ?>

						action: 'themnific_ajax_post_action',
						data: serializedReturn
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var success = jQuery('#themnific-popup-save');
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
		
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action - themnific_ajax_callback */
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_themnific_ajax_post_action', 'themnific_ajax_callback');

function themnific_ajax_callback() {
	global $wpdb; // this is how you get access to the database
	
		
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
				$upload_tracking[] = $clickedID;
				update_option( $clickedID , $uploaded_file['url'] );
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
	}
	elseif($save_type == 'image_reset'){
			
			$id = $_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	
	}	
	elseif ($save_type == 'options' OR $save_type == 'seo' OR $save_type == 'framework') {
		$data = $_POST['data'];
		
		parse_str($data,$output);
		//print_r($output);
		
		//Pull options
        	$options = get_option('themnific_template');

				
		foreach($options as $option_array){

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';
			
			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}
	
			if(isset($option_array['id'])) { // Non - Headings...
				
				//Import of prior saved options
				if($id == 'framework_themnific_import_options'){
					
					//Decode and over write options.
			
					
					//echo '<pre>';
					//print_r($new_import);
					//echo '</pre>';
					if(!empty($new_import)) {
						foreach($new_import as $id2 => $value2){
							if(is_serialized($value2)) {
								update_option($id2,unserialize($value2));
							} else {
								update_option($id2,$value2);
							}
						}
					}
					
				} else {
			
					$type = $option_array['type'];
					
					if ( is_array($type)){
						foreach($type as $array){
							if($array['type'] == 'text'){
								$id = $array['id'];
								$new_value = $output[$id];
								update_option( $id, stripslashes($new_value));
							}
						}                 
					}
					elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'false');
					}
					elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'true');
					}
					elseif($type == 'multicheck'){ // Multi Check Save
						
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
					elseif($type == 'typography'){
							
						$typography_array = array();	
						
						$typography_array['size'] = $output[$option_array['id'] . '_size'];
							
						$typography_array['face'] = stripslashes($output[$option_array['id'] . '_face']);
							
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
					elseif($type != 'upload_min'){
					
						update_option($id,stripslashes($new_value));
					}
				}
			}	
		}
	}
	
	
	if( $save_type == 'options' OR $save_type == 'framework' ){
		/* Create, Encrypt and Update the Saved Settings */
		global $wpdb;
		//$options = get_option('themnific_template');
		$themnific_options = array();
		$query_inner = '';
		$count = 0;
		if($save_type == 'framework' ){
			$options = get_option('themnific_template');
		}
		print_r($options);
		foreach($options as $option){
			
			if(isset($option['id'])){ 
				$count++;
				$option_id = $option['id'];
				$option_type = $option['type'];
				
				if($count > 1){ $query_inner .= ' OR '; }
				
				if(is_array($option_type)) {
				$type_array_count = 0;
				foreach($option_type as $inner_option){
					$type_array_count++;
					$option_id = $inner_option['id'];
					if($type_array_count > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '$option_id'";
					}
				}
				else {
				
					$query_inner .= "option_name = '$option_id'";
					
				}
			}
			
		}
		
		$query = "SELECT * FROM $wpdb->options WHERE $query_inner";
				
		$results = $wpdb->get_results($query);
		
		$output = "<ul>";
		
		foreach ($results as $result){
				$name = $result->option_name;
				$value = $result->option_value;
				
				if(is_serialized($value)) {
					
					$value = unserialize($value);
					$themnific_array_option = $value;
					$temp_options = '';
					foreach($value as $v){
						if(isset($v))
							$temp_options .= $v . ',';
						
					}	
					$value = $temp_options;
					$themnific_array[$name] = $themnific_array_option;
				} else {
					$themnific_array[$name] = $value;
				}
				
				$output .= '<li><strong>' . $name . '</strong> - ' . $value . '</li>';
		}
		$output .= "</ul>";
		
		update_option('themnific_options',$themnific_array);
		update_option('themnific_settings_encode',$output);
	
	}



  die();

}



/*-----------------------------------------------------------------------------------*/
/* Generates The Options - themnificthemes_machine */
/*-----------------------------------------------------------------------------------*/

function themnificthemes_machine($options) {
        
    $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {
	   
		$counter++;
		$val = '';
		//Start Heading
		 if ( $value['type'] != "heading" )
		 {
		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
			$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
			$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

		 } 
		 //End Heading
		$select_value = '';                                   
		switch ( $value['type'] ) {
		
		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="themnific-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
		break;
		
		case 'select':

			$output .= '<select class="themnific-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
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

			$output .= '<select class="themnific-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
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
		case 'calendar':
		
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
            $output .= '<input class="themnific-input-calendar" type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'.$val.'">';
		
		break;
		case 'time':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="themnific-input-time" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
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
				$output .= '<textarea class="themnific-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
			
			
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
				$output .= '<input class="themnific-input themnific-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
			
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
			$output .= '<input type="checkbox" class="checkbox themnific-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;
		case "multicheck":
		
			$std =  $value['std'];         
			
			foreach ($value['options'] as $key => $option) {
											 
			$themnific_key = $value['id'] . '_' . $key;
			$saved_std = get_option($themnific_key);
					
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
			$output .= '<input type="checkbox" class="checkbox themnific-input" name="'. $themnific_key .'" id="'. $themnific_key .'" value="true" '. $checked .' /><label for="'. $themnific_key .'">'. $option .'</label><br />';
										
			}
		break;
		case "upload":
			
			$output .= themnificthemes_uploader_function($value['id'],$value['std'],null);
			
		break;
		case "upload_min":
			
			$output .= themnificthemes_uploader_function($value['id'],$value['std'],'min');
			
		break;
		case "color":
			$val = $value['std'];
			$stored  = get_option( $value['id'] );
			if ( $stored != "") { $val = $stored; }
			$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="themnific-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
		break;   
		
		case "typography":
		
			$default = $value['std'];
			$typography_stored = get_option($value['id']);
			
			/* Font Size */
			$val = $default['size'];
			if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
			$output .= '<select class="themnific-typography themnific-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
				for ($i = 9; $i < 101; $i++){ 
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
			$font10 = '';
			$font11 = '';
			$font12 = '';
			$font13 = '';
			$font14 = '';
			$font15 = '';
			$font16 = '';
			$font17 = '';
			$font18 = '';
			$font19 = '';
			$font20 = '';
			$font21 = '';
			$font22 = '';
			$font23 = ''; 
			$font24 = ''; 
			$font25 = ''; 
			$font26 = ''; 
			$font27 = ''; 
			$font28 = ''; 
			$font29 = ''; 
			$font30 = '';
			$font31 = ''; 
			$font32 = '';
			$font33 = '';
			$font34 = '';
			$font35 = '';
			$font36 = '';
			$font37 = '';
			$font38 = '';
			$font39 = '';
			$font40 = '';
			$font41 = '';
			$font42 = '';
			$font43 = '';
			$font44 = '';
			$font45 = '';
			$font46 = '';
			$font47 = '';
			$font48 = '';
			$font49 = '';
			$font50 = '';
			$font51 = '';
			$font52 = '';
			$font53 = '';
			$font54 = '';
			$font55 = '';
			$font56 = '';
			
			


			if (strpos($val, 'Arial, sans-serif') !== false){ $font01 = 'selected="selected"'; }
			if (strpos($val, 'Verdana, Geneva') !== false){ $font02 = 'selected="selected"'; }
			if (strpos($val, 'Trebuchet') !== false){ $font03 = 'selected="selected"'; }
			if (strpos($val, 'Georgia') !== false){ $font04 = 'selected="selected"'; }
			if (strpos($val, 'Times New Roman') !== false){ $font05 = 'selected="selected"'; }
			if (strpos($val, 'Tahoma, Geneva') !== false){ $font06 = 'selected="selected"'; }
			if (strpos($val, 'Palatino') !== false){ $font07 = 'selected="selected"'; }
			if (strpos($val, 'Helvetica') !== false){ $font08 = 'selected="selected"'; }
			if (strpos($val, 'Calibri') !== false){ $font09 = 'selected="selected"'; }
			if (strpos($val, 'Myriad') !== false){ $font10 = 'selected="selected"'; }
			if (strpos($val, 'Lucida') !== false){ $font11 = 'selected="selected"'; }
			if (strpos($val, 'Arial Black') !== false){ $font12 = 'selected="selected"'; }
			if (strpos($val, 'Gill') !== false){ $font13 = 'selected="selected"'; }
			if (strpos($val, 'Geneva, Tahoma') !== false){ $font14 = 'selected="selected"'; }
			if (strpos($val, 'Impact') !== false){ $font15 = 'selected="selected"'; }
			if (strpos($val, 'Droid Serif') !== false){ $font16 = 'selected="selected"'; }
			if (strpos($val, 'Jockey') !== false){ $font17 = 'selected="selected"'; }
			if (strpos($val, 'Quicksand') !== false){ $font18 = 'selected="selected"'; }
			if (strpos($val, 'Terminal') !== false){ $font19 = 'selected="selected"'; }
			if (strpos($val, 'Sansita') !== false){ $font20 = 'selected="selected"'; }
			if (strpos($val, 'Changa') !== false){ $font21 = 'selected="selected"'; }
			if (strpos($val, 'Paytone') !== false){ $font22 = 'selected="selected"'; }
			if (strpos($val, 'Dorsa') !== false){ $font23 = 'selected="selected"'; }
			if (strpos($val, 'Rochester') !== false){ $font24 = 'selected="selected"'; }
			if (strpos($val, 'Bigshot') !== false){ $font25 = 'selected="selected"'; }
			if (strpos($val, 'Open Sans') !== false){ $font26 = 'selected="selected"'; }
			if (strpos($val, 'Merienda One') !== false){ $font27 = 'selected="selected"'; }
			if (strpos($val, 'Six Caps') !== false){ $font28 = 'selected="selected"'; }
			if (strpos($val, 'Bevan') !== false){ $font29 = 'selected="selected"'; }
			if (strpos($val, 'Oswald') !== false){ $font30 = 'selected="selected"'; }
			if (strpos($val, 'Vidaloka') !== false){ $font31 = 'selected="selected"'; }
			if (strpos($val, 'Droid Sans') !== false){ $font32 = 'selected="selected"'; }
			if (strpos($val, 'Josefin Sans') !== false){ $font33 = 'selected="selected"'; }
			if (strpos($val, 'Dancing Script') !== false){ $font34 = 'selected="selected"'; }
			if (strpos($val, 'Abel') !== false){ $font35 = 'selected="selected"'; }
			if (strpos($val, 'Rokkitt') !== false){ $font36 = 'selected="selected"'; }
			if (strpos($val, 'Passion One') !== false){ $font37 = 'selected="selected"'; }
			if (strpos($val, 'Bitter') !== false){ $font38 = 'selected="selected"'; }
			if (strpos($val, 'Gudea') !== false){ $font39 = 'selected="selected"'; }
			if (strpos($val, 'Marvel') !== false){ $font40 = 'selected="selected"'; }
			if (strpos($val, 'Questrial') !== false){ $font41 = 'selected="selected"'; }
			if (strpos($val, 'Patua One') !== false){ $font42 = 'selected="selected"'; }
			if (strpos($val, 'Carrois Gothic') !== false){ $font43 = 'selected="selected"'; }
			if (strpos($val, 'Archivo Black') !== false){ $font44 = 'selected="selected"'; }
			if (strpos($val, 'Open Sans Condensed') !== false){ $font45 = 'selected="selected"'; }
			if (strpos($val, 'Arbutus Slab') !== false){ $font46 = 'selected="selected"'; }
			if (strpos($val, 'Merriweather') !== false){ $font47 = 'selected="selected"'; }
			if (strpos($val, 'Stint Ultra Condensed') !== false){ $font48 = 'selected="selected"'; }
			if (strpos($val, 'Raleway') !== false){ $font49 = 'selected="selected"'; }
			if (strpos($val, 'Armata') !== false){ $font50 = 'selected="selected"'; }
			if (strpos($val, 'Karla') !== false){ $font51 = 'selected="selected"'; }
			if (strpos($val, 'BenchNine') !== false){ $font52 = 'selected="selected"'; }
			if (strpos($val, 'Sans Serif') !== false){ $font53 = 'selected="selected"'; }
			if (strpos($val, 'Fjalla One') !== false){ $font54 = 'selected="selected"'; }
			if (strpos($val, 'Magra') !== false){ $font55 = 'selected="selected"'; }
			if (strpos($val, 'Titillium Web') !== false){ $font56 = 'selected="selected"'; }

			
			
									
			
			
			$output .= '<select class="themnific-typography themnific-typography-face" name="'. $value['id'].'_face" id="'. $value['id'].'_face">';
			$output .= '<option value="Arial, sans-serif" '. $font01 .'>Arial</option>';
			$output .= '<option value="Verdana, Geneva, sans-serif" '. $font02 .'>Verdana</option>';
			$output .= '<option value="&quot;Trebuchet MS&quot;, Tahoma, sans-serif"'. $font03 .'>Trebuchet</option>';
			$output .= '<option value="Georgia, serif" '. $font04 .'>Georgia</option>';
			$output .= '<option value="&quot;Times New Roman&quot;, serif"'. $font05 .'>Times New Roman</option>';
			$output .= '<option value="Tahoma, Geneva, Verdana, sans-serif"'. $font06 .'>Tahoma</option>';
			$output .= '<option value="Palatino, &quot;Palatino Linotype&quot;, serif"'. $font07 .'>Palatino</option>';
			$output .= '<option value="&quot;Helvetica Neue&quot;, Helvetica, sans-serif" '. $font08 .'>Helvetica*</option>';
			$output .= '<option value="Calibri, Candara, Segoe, Optima, sans-serif"'. $font09 .'>Calibri*</option>';
			$output .= '<option value="&quot;Myriad Pro&quot;, Myriad, sans-serif"'. $font10 .'>Myriad Pro*</option>';
			$output .= '<option value="&quot;Lucida Sans Unicode&quot;, &quot;Lucida Grande&quot;, &quot;Lucida Sans&quot;, sans-serif"'. $font11 .'>Lucida</option>';
			$output .= '<option value="&quot;Arial Black&quot;, sans-serif" '. $font12 .'>Arial Black</option>';
			$output .= '<option value="&quot;Gill Sans&quot;, &quot;Gill Sans MT&quot;, Calibri, sans-serif" '. $font13 .'>Gill Sans*</option>';
			$output .= '<option value="Geneva, Tahoma, Verdana, sans-serif" '. $font14 .'>Geneva*</option>';
			$output .= '<option value="Impact, Charcoal, sans-serif" '. $font15 .'>Impact</option>';
			
			$output .= '<option value="&quot;Droid Serif&quot;, serif" '. $font16 .'>Droid Serif***</option>';
			$output .= '<option value="&quot;Droid Sans&quot;, sans-serif"'. $font32 .'>Droid Sans***</option>';
			$output .= '<option value="&quot;Jockey One&quot;, sans-serif" '. $font17 .'>Jockey One***</option>';
			$output .= '<option value="&quot;Quicksand&quot;, sans-serif" '. $font18 .'>Quicksand***</option>';
			$output .= '<option value="&quot;Terminal Dosis&quot;, sans-serif" '. $font19 .'>Terminal Dosis***</option>';
			$output .= '<option value="&quot;Sansita One&quot;, sans-serif" '. $font20 .'>Sansita One***</option>';
			$output .= '<option value="&quot;Changa One&quot;, sans-serif" '. $font21 .'>Changa One***</option>';
			$output .= '<option value="&quot;Paytone One&quot;, sans-serif" '. $font22 .'>Paytone One***</option>';
			$output .= '<option value="&quot;Dorsa&quot;, sans-serif" '. $font23 .'>Dorsa***</option>';
			$output .= '<option value="&quot;Rochester&quot;, cursive" '. $font24 .'>Rochester***</option>';
			$output .= '<option value="&quot;Bigshot One&quot;, cursive"'. $font25 .'>Bigshot One***</option>';
			$output .= '<option value="&quot;Open Sans&quot;, sans-serif" '. $font26 .'>Open Sans***</option>';
			$output .= '<option value="&quot;Open Sans Condensed&quot;, sans-serif" '. $font45 .'>Open Sans Condensed***</option>';	
			$output .= '<option value="&quot;Merienda One&quot;, cursive"'. $font27 .'>Merienda One***</option>';
			$output .= '<option value="&quot;Six Caps&quot;, sans-serif"'. $font28 .'>Six Caps***</option>';
			$output .= '<option value="&quot;Bevan&quot;, serif"'. $font29 .'>Bevan***</option>';
			$output .= '<option value="&quot;Oswald&quot;, sans-serif" '. $font30 .'>Oswald***</option>';
			$output .= '<option value="&quot;Vidaloka&quot;, serif"'. $font31 .'>Vidaloka***</option>';
			$output .= '<option value="&quot;Josefin Sans&quot;, sans-serif"'. $font33 .'>Josefin Sans***</option>';
			$output .= '<option value="&quot;Dancing Script&quot;, cursive" '. $font34 .'>Dancing Script***</option>';
			$output .= '<option value="&quot;Abel&quot;, sans-serif" '. $font35 .'>Abel***</option>';
			$output .= '<option value="&quot;Rokkitt&quot;, serif" '. $font36 .'>Rokkitt***</option>';	
			$output .= '<option value="&quot;Passion One&quot;, serif" '. $font37 .'>Passion One***</option>';	
			$output .= '<option value="&quot;Bitter&quot;, serif" '. $font38 .'>Bitter***</option>';	
			$output .= '<option value="&quot;Gudea&quot;, serif" '. $font39 .'>Gudea***</option>';	
			$output .= '<option value="&quot;Marvel&quot;, serif" '. $font40 .'>Marvel***</option>';	
			$output .= '<option value="&quot;Questrial&quot;, serif" '. $font41 .'>Questrial***</option>';	
			$output .= '<option value="&quot;Patua One&quot;, cursive" '. $font42 .'>Patua One***</option>';	
			$output .= '<option value="&quot;Carrois Gothic&quot;, sans-serif" '. $font43 .'>Carrois Gothic***</option>';	
			$output .= '<option value="&quot;Archivo Black&quot;, sans-serif" '. $font44 .'>Archivo Black***</option>';	
			$output .= '<option value="&quot;Arbutus Slab&quot;, serif" '. $font46 .'>Arbutus Slab***</option>';	
			$output .= '<option value="&quot;Merriweather&quot;, serif" '. $font47 .'>Merriweather***</option>';		
			$output .= '<option value="&quot;Stint Ultra Condensed&quot;, serif" '. $font48 .'>Stint Ultra Condensed***</option>';
			$output .= '<option value="&quot;Raleway&quot;, sans-serif" '. $font49 .'>Raleway***</option>';
			$output .= '<option value="&quot;Armata&quot;, sans-serif" '. $font50 .'>Armata***</option>';
			$output .= '<option value="&quot;Karla&quot;, sans-serif" '. $font51 .'>Karla***</option>';
			$output .= '<option value="&quot;BenchNine&quot;, sans-serif" '. $font52 .'>BenchNine***</option>';
			$output .= '<option value="&quot;Sans Serif&quot;, sans-serif" '. $font53 .'>Sans Serif*</option>';
			$output .= '<option value="&quot;Fjalla One&quot;, sans-serif" '. $font54 .'>Fjalla One***</option>';
			$output .= '<option value="&quot;Magra&quot;, sans-serif" '. $font55 .'>Magra***</option>';
			$output .= '<option value="&quot;Titillium Web&quot;, sans-serif" '. $font56 .'>Titillium Web***</option>';
			$output .= '</select>';
		
		
			/* Font Weight */
			$val = $default['style'];
			if ( $typography_stored['style'] != "") { $val = $typography_stored['style']; }
				$light = ''; $book = ''; $normal = ''; $italic = ''; $bold = '';$semibold = '';$heavy = ''; $ultra = ''; $bolditalic = '';
			if($val == '200'){ $light = 'selected="selected"'; }
			if($val == '300'){ $book = 'selected="selected"'; }
			if($val == '400'){ $normal = 'selected="selected"'; }
			if($val == 'italic'){ $italic = 'selected="selected"'; }
			if($val == '600'){ $semibold = 'selected="selected"'; }
			if($val == '700'){ $bold = 'selected="selected"'; }
			if($val == '800'){ $heavy = 'selected="selected"'; }
			if($val == '900'){ $ultra = 'selected="selected"'; }
			if($val == 'bold italic'){ $bolditalic = 'selected="selected"'; }
			
			$output .= '<select class="themnific-typography themnific-typography-style" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';
			$output .= '<option value="200" '. $light .'>Light (200)</option>';
			$output .= '<option value="300" '. $book .'>Book (300)</option>';
			$output .= '<option value="400" '. $normal .'>Normal (400)</option>';
			$output .= '<option value="600" '. $semibold .'>Semi-Bold (600)</option>';
			$output .= '<option value="700" '. $bold .'>Bold (700)</option>';
			$output .= '<option value="800" '. $heavy .'>Heavy (800)</option>';
			$output .= '<option value="900" '. $ultra .'>Ultra (900)</option>';
			$output .= '<option value="400 italic" '. $italic .'>Normal/Italic</option>';
			$output .= '<option value="700 italic" '. $bolditalic .'>Bold/Italic</option>';
			$output .= '</select>';
			
			/* Font Color */
			$val = $default['color'];
			if ( $typography_stored['color'] != "") { $val = $typography_stored['color']; }			
			$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="themnific-color themnific-typography themnific-typography-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';

		break;  
		
		case "border":
		
			$default = $value['std'];
			$border_stored = get_option( $value['id'] );
			
			/* Border Width */
			$val = $default['width'];
			if ( $border_stored['width'] != "") { $val = $border_stored['width']; }
			$output .= '<select class="themnific-border themnific-border-width" name="'. $value['id'].'_width" id="'. $value['id'].'_width">';
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
			
			$output .= '<select class="themnific-border themnific-border-style" name="'. $value['id'].'_style" id="'. $value['id'].'_style">';
			$output .= '<option value="solid" '. $solid .'>Solid</option>';
			$output .= '<option value="dashed" '. $dashed .'>Dashed</option>';
			$output .= '<option value="dotted" '. $dotted .'>Dotted</option>';
			$output .= '</select>';
			
			/* Border Color */
			$val = $default['color'];
			if ( $border_stored['color'] != "") { $val = $border_stored['color']; }			
			$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="themnific-color themnific-border themnific-border-color" name="'. $value['id'] .'_color" id="'. $value['id'] .'_color" type="text" value="'. $val .'" />';

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
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'themnific-radio-img-selected'; } 
				    } else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'themnific-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'themnific-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'themnific-radio-img-selected'; }
						else { $checked = ''; }
					}	
				
				$output .= '<span>';
				$output .= '<input type="radio" id="themnific-radio-img-' . $value['id'] . $i . '" class="checkbox themnific-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
				$output .= '<div class="themnific-radio-img-label">'. $key .'</div>';
				$output .= '<img src="'.$option.'" alt="" class="themnific-radio-img-img '. $selected .'" onClick="document.getElementById(\'themnific-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
				$output .= '</span>';
				
			}
		
		break; 
		
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;                                   
		
			case "heading":
				if( $counter >= 2 ) {
					$output .= '</div>'."\n";
				}
				$jquery_click_hook = preg_replace( '/[^a-zA-Z0-9\s]/', '', strtolower( $value['name'] ) );
				// $jquery_click_hook = preg_replace( '/[^\p{L}\p{N}]/u', '', strtolower( $value['name'] ) ); // Regex for UTF-8 languages.
				$jquery_click_hook = str_replace( ' ', '', $jquery_click_hook );

				$jquery_click_hook = "themnific-option-" . $jquery_click_hook;
				$menu .= '<li><a title="'. esc_attr( $value['name'] ) .'" href="#'.  $jquery_click_hook  .'">'.  esc_html( $value['name'] ) .'</a></li>';
				$output .= '<div class="group" id="'. esc_attr( $jquery_click_hook ) .'">'."\n";
				break;                                
		} 
		
		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){
			
					$id =   $array['id']; 
					$std =   $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std && !empty($saved_std) ){$std = $saved_std;} 
					$meta =   $array['meta'];
					
					if($array['type'] == 'text') { // Only text at this point
						 
						 $output .= '<input class="input-text-small themnific-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
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
/* Vergo Uploader - themnificthemes_uploader_function */
/*-----------------------------------------------------------------------------------*/

function themnificthemes_uploader_function($id,$std,$mod){

    //$uploader .= '<input type="file" id="attachement_'.$id.'" name="attachement_'.$id.'" class="upload_input"></input>';
    //$uploader .= '<span class="submit"><input name="save" type="submit" value="Upload" class="button upload_save" /></span>';
    
	$uploader = '';
    $upload = get_option($id);
	
	if($mod != 'min') { 
			$val = $std;
            if ( get_option( $id ) != "") { $val = get_option($id); }
            $uploader .= '<input class="themnific-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
	}
	
	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';
	
	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
	
	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	$uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
	if(!empty($upload)){
		//$upload = cleanSource($upload); // Removed since V.2.3.7 it's not showing up
    	$uploader .= '<a class="themnific-uploaded-image" href="'. $upload . '">';
    	$uploader .= '<img class="themnific-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
    	$uploader .= '</a>';
		}
	$uploader .= '<div class="clear"></div>' . "\n"; 


return $uploader;
}





?>