<?php
/*
 * Netstudio Admin Framework
 */


function netstudio_theme_options(){
	global $pagehook, $theme_name, $sidehook;

	$icon = get_template_directory_uri() .'/images/1616.png';	
	$pagehook =  add_menu_page($theme_name . ' Options', $theme_name, 'manage_options','functions.php', 'netstudio_show_page', $icon, 3);
	$sidehook = add_submenu_page('functions.php', $theme_name, 'Theme Options', 'manage_options', 'functions.php','netstudio_show_page');
	add_action('load-'.$pagehook, 'netstudio_load_page');			
}


/*
 * Main Options
 */

function netstudio_load_page(){
	global $pagehook, $netstudio_options;

	if(isset($_POST['Submit'])){

		foreach ($netstudio_options as $value) {

			foreach( $value as $array) {

				if($array['type'] == 'checkbox'){
					if(isset( $_REQUEST[ $array['id'] ]))
					{ update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					} else { update_option( $array['id'] , 'false' ); }
				} elseif($array['type'] == 'ccheckbox'){
					if(isset( $_REQUEST[ $array['id'] ]))
					{ update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					} else { update_option( $array['id'] , 'false' ); }
				} elseif($array['type'] == 'radio'){
					if(isset( $_REQUEST[ $array['id'] ]))
					{update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					} else  {delete_option( $array['id'] );}
				} elseif($array['type'] == 'select'){
					if(isset( $_REQUEST[ $array['id'] ])){
					update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					}else {
					delete_option( $array['id']);
					}
				} else {
					$id = $array['id'];
					update_option( $id, $_REQUEST[ $id ]);
				}// end text if
			}
		}

		header("Location: themes.php?page=functions.php&saved=true");
		die;
	}
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	netstudio_register_metaboxes($netstudio_options);
}




function netstudio_show_page() {
	global $pagehook, $theme_name, $ns_ver;
?>
<div class="wrap nets_wrap">

	<?php if(isset($_REQUEST['saved']) && $_REQUEST['saved']=='true'){ ?>
		<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);">
			<p><strong>Settings saved.</strong></p>
		</div>
	<?php }?>
	<div class="formouter">
	<form method="post" action="" class="netsform">
		<input type="hidden" name="action" value="ns_save_options" />
		<div class="tabholder">
			<ul>
				<li rel="#ns_general_settings" class="current whitebut">General Settings</li>
				<li rel="#ns_slide_settings" class="whitebut">Slideshow Settings</li>
				<li rel="#ns_accounts_settings" class="whitebut">Social Settings</li>
				<li rel="#ns_map_settings" class="whitebut">Map & Contacts</li>
				<li rel="#ns_spect_settings" class="whitebut">Special terms</li>
				<li rel="#save" class="saver greenbut"><input type="submit" value="Save Changes" class="button-primary" name="Submit" /></li>
			</ul>
			<div class="tabbot"></div>
		</div>			
		<div id="poststuff" class="metabox-holder nets_poststuff">
			<?php do_meta_boxes($pagehook, 'normal', NULL); ?>
		</div>
		<br class="clear" />
	</form>
	</div>
</div>

<?php
}


// registering metaboxes to admin page
function netstudio_register_metaboxes($array)
{
	global $pagehook;

	foreach($array as $field){
		add_meta_box($field[0]['id'], $field[0]['name'], $field[0]['id'], $pagehook, $field[0]['context'], 'core');
	}

}

function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_template_directory_uri() .'/js/admin.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
wp_enqueue_script('post');
}

function my_admin_styles() {
wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');


// add something to the admin head
function netstudio_admin_head() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
?>	
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/options/admin-style.css" media="screen" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ajaxupload.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/custom_admin.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.image_upload_button').each(function(){
			
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				  action: '<?php echo admin_url("admin-ajax.php"); ?>',
				  name: clickedID, // File upload name
				  data: { // Additional data to send
						action: 'netstudio_post_action',
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
						var buildReturn = '<div class="clear"></div><img style="padding-top: 10px;" "'+response+'" />';
						jQuery(".upload-error").remove();
						jQuery("#image_" + clickedID).remove();	
						clickedObject.parent().after(buildReturn);
						jQuery('img#image_'+clickedID).fadeIn();
						var strmess = jQuery('img#image_'+clickedID).attr('src'); 
						clickedObject.next('span').fadeIn();
						clickedObject.closest('td').find('input').val(strmess);
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
						action: 'netstudio_post_action',
						type: 'image_reset',
						data: theID
					};					
					jQuery.post(ajax_url, data, function(response) {
						var image_to_remove = jQuery('#image_' + theID);
						var button_to_hide = jQuery('#reset_' + theID);
						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
						button_to_hide.fadeOut();
						jQuery('input.the_textbox').val('');					
					});					
					return false; 					
			}); 
			
		});			
	</script>
<?php
}


add_action('wp_ajax_netstudio_post_action', 'netstudio_ajax_callback');

function netstudio_ajax_callback() {
	global $wpdb; // this is how you get access to the database	
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);		 
		$upload_tracking[] = $clickedID;
		update_option( $clickedID , $uploaded_file['url'] );
		$subber = $uploaded_file['new_file'];
		$subber2 = $uploaded_file['url'];
		$subber2 = str_replace($subber , "" , $subber2);				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; exit; }
		 else { echo 'class="hide woo-option-image" id="image_' . $clickedID .'" src="' . $subber2 . '" alt="'; exit; } // Is the Response
	}
	elseif($save_type == 'image_reset'){
		$id = $_POST['data']; // Acts as the name
		$option_name = 'nets_themelogo' ; 
		$newvalue = '' ;			
		update_option($option_name, $newvalue);
		exit;
	} 			
}


function netstudio_generate_fields($arr_data){

	array_shift($arr_data);
	$output .= '<table class="form-table"><tbody>';

	foreach($arr_data as $index=>$field){
		
		switch ( $field['type'] ) {

			case 'text':
				$val = stripslashes($field['std']);
				if ( get_option( $field['id'] ) != "") { $val = stripslashes(get_option($field['id'])); }

					$output .= '
					<tr valign="top">
					<td colspan=2>
					<span class="pitop">&nbsp;</span>
					<span class="postover">
					<label for="'.$field['id'].'"><span class="plabel">'.$field['name'].'</span></label>
					<span class="description">'.$field['desc'].'</span>
					<input  name="'. $field['id'] .'" id="'. $field['id'] .
					'" type="'. $field['type'] .'" value="'. $val .'"  /><br/>
			
					</span>
					<span class="pibot">&nbsp;</span>
					</td>
					</tr>
							';
				break;
								
			case 'uploader':

				$val = stripslashes($field['std']);
				if ( get_option( $field['id'] ) != "") { $val = get_option($field['id']); } else { $val = 'no image uploaded';}
				if ( get_option( $field['id'] ) != "") { $imgval = '<img style="padding-top: 10px;" id="image_'.$field['id'].'" title="'.$field['id'].'" src="' . get_option($field['id']) . '">'; }
				if ( get_option( $field['id'] ) != "") { $imgdisplay = ""; } else { $imgdisplay = 'style="display: none"'; }
				
				$output .= '
				
				<tr valign="top">
					<td colspan=2>
					<span class="pitop">&nbsp;</span>
					<span class="postover">
					<label for="'.$field['id'].'"><span class="plabel">'.$field['name'].'</span></label>
					<div class="upload_button_div" style="margin-left: 15px"><span id="'. $field['id'] .'" class="button image_upload_button">Upload Image</span><span title="'. $field['id'] .'" id="'. $field['id'] .'" class="button image_reset_button hide" ' . $imgdisplay . '>Remove</span></div><div class="clear"></div>' . $imgval . '<br/><br/>					
					<input class="regular-text the_textbox" name="'. $field['id'] .'" id="this_'. $field['id'] .
					'" type="text" value="' . $val .'" />					
					</span>
					<span class="pibot">&nbsp;</span>
					</td>
					</tr>								
				';

				break;


			case 'sub_heading':
				$val = stripslashes($field['std']);
				$output .= '
					<tr valign="top" style="background:#eee;border-bottom:1px solid #999">
					<th scope="row"><strong>
					'.$field['name'].'</strong></th>
					<td><span class="description">'.$field['desc'].'</span></td></tr>';
			break;


			case 'delimiter':
				$val = stripslashes($field['std']);
				$output .= '
					<tr valign="top" style="">
					<th scope="row">
					&nbsp;</th>			
					<td>
					<span >&nbsp;</span>
					</td>
					</tr>
				';
			break;


			case 'select':

				$output .= '
					<tr valign="top">
					<td colspan=2>
					<span class="pitop">&nbsp;</span>
					<span class="postover">
					<label for="'.$field['id'].'"><span class="plabel">'.$field['name'].'</span></label>
					<span class="description">'.$field['desc'].'</span>
					<select name="'. $field['id'] .'" id="'. $field['id'] .'" >
				';

				$select_value = get_option( $field['id']);

				foreach ($field['options'] as $option) {
					$selected = '';
					if($select_value != '') {
						if ( $select_value == $option) { $selected = ' selected="selected"';}
					} else {
						if ($field['std'] == $option) { $selected = ' selected="selected"'; }
					}
					$output .= '<option'. $selected .'>';
					$output .= $option;
					$output .= '</option>';
				}
				$output .= '</select><br /></span><span class="pibot">&nbsp;</span></td></tr>';
			break;


			case 'select_page':

				$output .= '
					<tr valign="top"><th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>			
					<td>
					<select name="'. $field['id'] .'" id="'. $field['id'] .'">
				';

				$select_value = get_option( $field['id']);

				foreach ($field['options'] as $value=>$option) {

					$selected = '';

					if($select_value != '') {
						if ( $select_value == $value) { $selected = ' selected="selected"';}
					} else {
						if ($field['std'] == $option) { $selected = ' selected="selected"'; }
					}

					$output .= '<option'. $selected .' value="'.$value.'">';
					$output .= $option;
					$output .= '</option>';
				}
				$output .= '</select><br /><span class="description">'.$field['desc'].'</span></td></tr>';

			break;

			case 'textarea':
				$ta_options = $field['options'];
				$ta_value = $field['std'];
				if( get_option($field['id']) != "") { $ta_value = stripslashes(get_option($field['id'])); }
				$output .= '
					<tr valign="top">
					<td colspan=2>
					<span class="pitop">&nbsp;</span>
					<span class="postover">
					<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>
					<span class="description">'.$field['desc'].'</span>
					<textarea name="'. $field['id'] .'" id="'. $field['id'] .'" cols="'. $ta_options['cols'] .'" rows="'.$ta_options['rows'].'">'.$ta_value.'</textarea>
					</span>
					<span class="pibot">&nbsp;</span>
					</td>
					</tr>
				';

			break;
								
			case "radio":

				$select_value = get_option( $field['id']);
				$output .= '
					<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>			
					<td>
				'; 
				
				foreach ($field['options'] as $key => $option) {
					$checked = '';
					if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked="checked"'; }
					} else {
						if ($field['std'] == $key) { $checked = ' checked="checked"'; }
					}
					$output .= '<input type="radio" name="'. $field['id'] .'"  value="'. $key .'" '. $checked .' />' . $option .'<br />';
				}

				$output .= '<br /><span class="description">'.$field['desc'].'</span></td></tr>'; 
			break;

			case "checkbox":

				$std = $field['std'];
				$saved_std = get_option($field['id']);
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

				$output .= '
					<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>
					<td>
					<input type="checkbox" class="checkbox" name="'.  $field['id'] .'" id="'. $field['id'] .'" value="true" '. $checked .' /> 
					<span class="description">'.$field['desc'].'</span></td></tr>';

			break;
			
			case "ccheckbox":

				$std = $field['std'];
				$saved_std = get_option($field['id']);
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

				$output .= '
					<tr valign="top">
					<td colspan=2>
					<span class="postover">
					<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>
					<span class="description">'.$field['desc'].'</span>
					<input type="checkbox" class="checkbox" name="'.  $field['id'] .'" id="'. $field['id'] .'" value="true" '. $checked .' /> 
					<span class="desription">'.$field['desc'].'</span></span>

					<span class="pibot">&nbsp;</span>
					</td>
					</tr>';

			break;
  
		}
	}

	$output .= '</tbody></table>';
	return $output;
}

?>
