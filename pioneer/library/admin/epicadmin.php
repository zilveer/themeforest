<?php

$adminname = "PIONEER Drag & Drop Wordpress theme ";
$themename = "epic_framework";
$shortname = "epic";


function epic_create_stylesheet(){

$filename = TEMPLATEPATH.'/library/css/custom.css';


$somecontent = epic_insert_custom_css();

if (is_writable($filename)) {

    if (!$handle = fopen($filename, 'w')) {
         exit;
    }
    
    if (fwrite($handle, $somecontent) === FALSE) {
         exit;
    }

    fclose($handle);
	}
}


function epic_add_admin() {
global $themename, $adminname, $shortname, $options;

if (isset($_REQUEST["page"]) && $_REQUEST["page"] == basename(__FILE__) ) {
if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "saved"){

		header("Location:admin.php?page=epicadmin.php&saved=true");
	
		foreach ($options as $value) {
			
			if( isset( $_REQUEST[ $value['id'] ] ) ) { 
				update_option( $value['id'], $_REQUEST[ $value['id'] ]); 
				} 
				
			else {
			
				delete_option( $value['id'] ); 
				
				} 
		}
  
				
		die;
} 
else if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "reset"){
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
 	epic_update_options();
	header("Location: admin.php?page=epicadmin.php&reset=true");
die;
}
}
add_theme_page( $adminname, 'Theme settings', 'manage_options', 'epicadmin.php', 'epic_theme_admin');
//add_menu_page( $adminname, 'Pioneer', 'manage_options', 'epicadmin.php', 'epic_theme_admin', get_template_directory_uri().'/library/admin/epic_icon.png');
//add_submenu_page( 'epicadmin.php', 'Theme options', 'Theme options', 'manage_options', 'epicadmin.php', 'epic_theme_admin' );
//add_submenu_page( 'epicadmin.php', 'Sample content', 'Sample content', 'manage_options', 'wizard.php', 'epic_theme_wizard' );
}

function epic_add_init() {

$file_dir=  get_template_directory_uri('template_directory');
$css_dir=  	get_template_directory_uri ('template_directory').'/library/admin/css';
$js_dir=	get_template_directory_uri('template_directory').'/library/admin/js';

//enqueue css
wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');

wp_enqueue_style("admin", $css_dir."/admin.css", false, "1.0", "all");

// Enqueue js
wp_enqueue_script('jquery');
wp_enqueue_script("ui", 		$js_dir."/jquery.ui.js", false, '');
wp_enqueue_script("mediaupload", null,array('jquery')); 
wp_enqueue_script('thickbox',null,array('jquery'));
}

function epic_add_js(){

$file_dir= get_template_directory_uri('template_directory');
$css_dir= get_template_directory_uri('template_directory').'/library/admin/css';
$js_dir=get_template_directory_uri('template_directory').'/library/admin/js';




$currpage = $_SERVER['REQUEST_URI'];
$pagename = 'page=epicadmin.php';

if (strpos($currpage,$pagename)) {
	echo '<script type="text/javascript" src="'.$js_dir.'/script.js"></script>';
}


}



?>
<?php
function epic_theme_admin() {
 
global $themename, $adminname, $shortname, $options;
$i=0;
 $count =0;
if ( isset($_REQUEST['saved'] )) echo '<div id="message" class="updated fade"><p><strong>'.$adminname.' settings saved.</strong></p></div>';
 
?>

<div class="wrap">

<div id="icon-tools" class="icon32"></div>
<h2><?php echo $adminname; ?> Theme settings</h2>

<form method="post" id="epic_options_form">
	
		
	<table class="form-table">
		<tbody>
	
	
		<tr valign="top">
			<td>
				<input name="save" type="submit" value="Save changes" class="button-primary menu-save" />
			</td>
		</tr>
	




<?php foreach ($options as $value) {
switch ( $value['type'] ) {


case 'text':
?>
<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td>
		

 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" size="45" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 	<span class="description"><?php echo $value['desc']; ?></span>
	</td>
</tr>
<?php break;


case 'text_small':
?>
<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td>
		

 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" size="1" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 	<span class="description"><?php echo $value['desc']; ?></span>
	</td>
</tr>
<?php break;


case 'text_large':
?>
<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td>
		

 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" size="60" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 	<span class="description"><?php echo $value['desc']; ?></span>
	</td>
</tr>
<?php break;





case 'textarea':
?>

<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td>
	<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="large-text code" cols="50" rows="10"/><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?></textarea>
	<span class="description"><?php echo $value['desc']; ?></span>
	</td>
</tr>

<?php break;

case 'select':
?>

<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td>

						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
									<option <?php if ( get_option( $value['id'] ) == 0) { echo ' selected="selected"'; } ?> value="0">Please Select</option>
									<?php foreach ($value['options'] as $op_val=>$option) { ?>
									<option<?php if ( get_option( $value['id'] ) == $op_val) { echo ' selected="selected"'; } elseif ($op_val == $value['std']) { echo ' selected="selected"'; } ?> value="<?php echo $op_val; ?>"><?php echo $option; ?></option>
									<?php } ?>
						</select>
						<span class="description"><?php echo $value['desc']; ?></span>
	</td>
</tr> 
<?php
break;




case 'selectvalue':
?>

  
<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td>
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="select">
									<option <?php if ( get_option( $value['id'] ) == 0) { echo ' selected="selected"'; } ?> value="0">Please Select</option>
									<?php foreach ($value['options'] as $op_val=>$option) { ?>
									<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
									<?php } ?>
						</select>
						
	<span class="description"><?php echo $value['desc']; ?></span>
	</td>
</tr> 
			
			<?php
break;




case 'upload':
?>

<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td>

			
						<?php $int = $count;?>
					
						<input type="text" size="60" class="upload-input" name="<?php echo $value['id']; ?>"  id="<?php echo $value['id']; ?>" value="<?php echo get_option($value['id']) ?>"/>
						<span class="description"><?php echo $value['desc']; ?></span>
						
						<p><input id="upload_button_<?php echo $count; ?>"  name="<?php echo $value['id'];?>" type="button" value="Upload" rel="<?php echo $int; ?>" />
						<input id="remove_<?php echo $value['id']; ?>"  name="<?php echo $value['id'];?>" type="button" value="Remove" rel="<?php echo $int; ?>" /></p>
						
			
			<?php if(get_option($value['id'])) :?>
			<div class="optimg" id="img_<?php echo $int; ?>"><img src="<?php echo get_option($value['id']);?>"/></div>
			<?php endif;?>
			
			
		
<script type="text/javascript"> 
jQuery(document).ready(function($) {  
										 
	jQuery('#upload_button_<?php echo $count; ?>').click(function() {
  				 formfield = jQuery(this).attr('name');
				 formID = jQuery(this).attr('del');
				 tb_show('', 'media-upload.php?post_id=' + formID +'&type=image&amp;TB_iframe=1');
				 return false;
				});
						
			 	
	window.send_to_editor = function(html) {
	 	imgurl = jQuery(html).attr('href');
	 	jQuery('#' + formfield).val(imgurl);
		tb_remove();
		}
				
				
	});
</script>
<?php $count ++;?>  
			

	</td>
</tr> 


<?php
break;






 
case 'radiogroup':
?>

<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td><p>	<?php $i = 0;?>

		<?php foreach ($value['options'] as $op_val=>$option) { ?>
						
						<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'].'_'.$i; ?>"			
						<?php if ( get_option( $value['id'] ) == $op_val || $value['std'] == $op_val) { echo ' checked="checked"'; } ?>
						value="<?php echo $op_val; ?>"
						> <?php echo $option; ?></input><br/>
						
						<?php 
						$i++;
						} ?>
		
	</p>
		
	<span class="description"><?php echo $value['desc']; ?></span>
	</td>
</tr> 

<?php
break;





 
case "checkbox":
?>

<tr valign="top">
	<th scope="row">
		<label><?php echo $value['name']; ?></label>
	</th>
	<td>
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<p><input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
<label for="<?php echo $value['id']; ?>" class="checkboxlabel"><?php echo $value['desc']; ?></label></p>

	</td>
</tr> 
<?php break;
case "subheading":
?>

<tr valign="top">
	
	<td colspan="2">
	<h3><?php echo $value['name']; ?></h3>
	<p><?php echo $value['desc'];?></p>
</td>
</tr> 


<?php break;

 
}
}
?>
 
			<tr valign="top">
				<td>
					<input name="save" type="submit" value="Save changes" class="button-primary menu-save" />
					<input type="hidden" name="action" value="saved" />

				</td>
			</tr>



		</tbody>
	</table>
</form>

</div><!-- / wrap  --> 

<?php
}
?>
<?php
add_action('admin_head', 'epic_add_js');
add_action('admin_init', 'epic_add_init');
add_action('admin_menu', 'epic_add_admin');
add_action('admin_init', 'epic_create_stylesheet');
?>