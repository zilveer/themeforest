<?php
/* Options Panel V_2.2 */

function royal_load_scripts($hook) {
 
	if( $hook != 'appearance_page_functions' ) 
		return;
 
	$options_jsfolder = get_template_directory_uri() . '/options/js';
	wp_enqueue_script('options_select',$options_jsfolder . '/jquery.sb.js');
	wp_enqueue_script('options_checkbox',$options_jsfolder . '/checkbox.js');
	wp_enqueue_script('options_ui',$options_jsfolder . '/jquery-ui-1.9.2.custom.min.js');
    wp_enqueue_script('options_tipTip',$options_jsfolder . '/jquery.tipTip.js');	
	wp_enqueue_script('options_functions_init',$options_jsfolder . '/functions-init.js');
	wp_localize_script( 'options_functions_init', 'optionsSettings', array(
			'clearpath' => get_template_directory_uri() . '/options/images/empty.png',
			'options_nonce' => wp_create_nonce('options_nonce')
	));
	wp_enqueue_script('options_colorpicker',$options_jsfolder . '/colorpicker.js');
	wp_enqueue_script('options_eye',$options_jsfolder . '/eye.js');
	wp_enqueue_script('options_layout',$options_jsfolder . '/layout.js');
	
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/options/js/custom.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}
add_action('admin_enqueue_scripts', 'royal_load_scripts');

function royal_admin_css() {

        wp_register_style( 'panel', get_template_directory_uri() . '/options/css/panel.css', false, true );
        wp_enqueue_style( 'panel' );

		wp_enqueue_style('thickbox');
		
	    wp_register_style( 'jquery_sb', get_template_directory_uri() . '/options/css/jquery.sb.css', false, true );
        wp_enqueue_style( 'jquery_sb' );	
		
        wp_register_style( 'jquery_custom_list', get_template_directory_uri() . '/options/css/jquery-ui.css', false, true );
        wp_enqueue_style( 'jquery_custom_list' );		

	    wp_register_style( 'tipTip', get_template_directory_uri() . '/options/css/tipTip.css', false, true );
        wp_enqueue_style( 'tipTip' );	
}
add_action( 'admin_enqueue_scripts', 'royal_admin_css' );


add_action('admin_menu', 'mytheme_add_admin');
function mytheme_add_admin() {

    global $themename, $shortname, $royal_options;
	$opt = basename(__FILE__);
	if ( isset($_GET['page']) && $_GET['page'] == $opt ) {
		options_save();}
		
    $core_page = add_theme_page($themename." Options", $themename." ", 'switch_themes', basename(__FILE__), 'mytheme_admin');
}


function mytheme_admin() {

    global $themename, $shortname, $royal_options;
	
	if (isset($_REQUEST['saved'])) {
	if ( $_REQUEST['saved'] ) echo '<div id="message_fade" class="updated_fade"><p><strong>'.$themename.' - Options Successfully Saved!</strong></p></div>';
	};
	if (isset($_REQUEST['reset'])) {
		if ( $_REQUEST['reset'] ) echo '<div id="message_fade" class="updated_fade"><p><strong>'.$themename.' - Options Reset</strong></p></div>';
	};
    
?>


  <div id="alloptions">
	<form method="post" id="main_options_form" enctype="multipart/form-data">

	<div id="options">
	
	<div id="options-content">

<?php foreach ($royal_options as $value) {
if (($value['type'] == "text") || ($value['type'] == "textarea") || ($value['type'] == "select") || ($value['type'] == "checkboxes") || ($value['type'] == "colorpicker") || ($value['type'] == "textcolorpopup") || ($value['type'] == "upload")) { ?>
			<div class="options-box">
			
			  <div class="box-title">
				<h3><?php echo $value['name']; ?></h3>
				    <img src="<?php echo get_template_directory_uri() ?>/options/images/comment43.png" class="tip" title="<?php echo $value['desc']; ?>"/>
		      </div> 
			  
				<div class="box-content">
		
		<?php if ($value['type'] == "text") { ?><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
			
		<?php } elseif ($value['type'] == "colorpicker") { ?><div id="colorpickerHolder"></div><?php } elseif ($value['type'] == "textcolorpopup") { ?>
		
			<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="colorpopup" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
			
		<?php } elseif ($value['type'] == "textarea") { ?><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?></textarea>
		
        <?php } elseif ($value['type'] == "upload") { ?>
				
			<input id="<?php echo $value['id']; ?>" class="uploadfield" type="text" style="width: 352px;" name="<?php echo $value['id']; ?>" value="<?php echo(get_option($value['id'])); ?>" />
				
				<div class="upload_buttons">
					<input class="upload_image_button" type="button" value="Upload Image" />
				</div>
				
				<div class="clear"></div>
		
		<?php } elseif ($value['type'] == "select") { ?>
		    <select class="jq_select" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $option) { ?>
                <option<?php if ( htmlspecialchars(get_option( $value['id'] )) == htmlspecialchars($option)) { echo ' selected="selected"'; } elseif (isset($value['std']) && $option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
            <?php } ?>
			</select>

		<?php } ?> 
     		
				</div> 
				
			</div> 	
		
<?php } elseif (($value['type'] == "checkbox")) { ?><div class="options-box <?php if ($value['type'] == "checkbox") {echo('options-tabs');} ?>">
			  <div class="box-title"><h3><?php echo $value['name']; ?></h3><img src="<?php echo get_template_directory_uri() ?>/options/images/comment43.png" class="tip" title="<?php echo $value['desc']; ?>"/></div> 
				<div class="box-content">
	<?php $checked = '';
	if((get_option($value['id'])) <> '') { if((get_option($value['id'])) == 'on') { $checked = 'checked="checked"'; }
		else { $checked = ''; }} elseif ($value['std'] == 'on') { $checked = 'checked="checked"'; } ?>
    <input type="checkbox" class="checkbox" name="<?php echo($value['id']);?>" id="<?php echo($value['id']);?>" <?php echo($checked); ?> />
		</div></div>
			
	
	<?php } elseif (($value['type'] == "content-open")) { ?>
	
	   <div id="<?php echo $value['name']; ?>" class="<?php echo('content-div'); ?>">	
	   
	<?php } elseif (($value['type'] == "content-close")) { ?>
	
        </div> <!-- end <?php echo $value['name']; ?> div --><?php } elseif ($value['type'] == "tabs-open") { ?>
    
 	        <ul class="tabs">
			<div id="tab_logo"></div>
	        <?php } elseif ($value['type'] == "tabs-close") { ?>
            </ul>
				
	<?php } elseif ($value['type'] == "tab") { ?><li><a href="#<?php echo $value['name']; ?>"><span class="pngfix"><?php echo $value['desc']; ?></span></a></li>		
	<?php } elseif ($value['type'] == "clearfix") { ?>
	<div class="clearfix"></div>
	<?php } ?><?php } ?>
	</div></div> 

	
	<div id="save_reset">
	<div>
       <input name="save" type="submit" value="Save changes" id="options-save" />
	   <input type="hidden" name="action" value="save_options" />
    </div>
    </form>

	<form method="post">
		<input name="reset" type="submit" value="Reset" id="options-reset" />
		<input type="hidden" name="action" value="reset" />
	</form>
	</div>
	<div class="clearfix"></div>
	</div>


	
<?php }


global $royal_options, $value, $shortname;
foreach ($royal_options as $value) {
	if (isset($value['id'])) {
		if ( get_option( $value['id'] ) === FALSE) {
			if (array_key_exists('std', $value)) { 
				update_option( $value['id'], $value['std'] );
				$$value['id'] = $value['std'];
			}
		} else {
			$$value['id'] = get_option( $value['id'] ); }
	}
}

function options_save(){
	global $royal_options;
	
	$opt = basename(__FILE__);
	
	if ( isset($_REQUEST['action']) ) {
		
		$values_opt = array();
		
		if ( 'save_options' == $_REQUEST['action'] ) {
			foreach ($royal_options as $value) {
				if( isset( $value['id'] ) ) { 
					if( isset( $_REQUEST[ $value['id'] ] ) ) {
						if ($value['type'] == 'textarea' || $value['type'] == 'text' || $value['type'] == 'upload') update_option( $value['id'], stripslashes($_REQUEST[$value['id']]) );
						elseif ($value['type'] == 'select') update_option( $value['id'], htmlspecialchars($_POST[$value['id']]) );
						else update_option( $value['id'], $_POST[$value['id']] );
					}
					else {
						if ($value['type'] == 'checkbox') update_option( $value['id'] , 'false' );
						
						else delete_option( $value['id'] );
					}
				}
				
				$values_opt[$value['id']] = $_POST[$value['id']];
			}
		
			header("Location: themes.php?page=$opt&saved=true");
			die;
			
		} else if( 'reset' == $_REQUEST['action'] ) {

			foreach ($royal_options as $value) {
				if (isset($value['id'])) {
					delete_option( $value['id'] );
					if (isset($value['std'])) $$value['id'] = $value['std'];
				};
			}
			
			header("Location: themes.php?page=$opt&reset=true");
			die;
		}
	}
	
}


function head_addons(){
global $shortname, $default_colorscheme;
	
$theme_info = wp_get_theme(TEMPLATEPATH . '/style.css');	

if (get_option($shortname.'_custom_colors') == 'on') custom_colors_css();

};

add_action('wp_head','head_addons',7);
add_action('wp_head','add_favicon');
add_action('wp_ajax_site_preview', 'mystique_get_site_preview');
function add_favicon(){
global $shortname;
$faviconUrl = get_option($shortname.'_favicon');
if ($faviconUrl <> '') echo('<link rel="shortcut icon" type="image/x-icon" href="'.$faviconUrl.'" />');
}


function get_pageId($page_name)
{
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".stripslashes($page_name)."' AND post_type = 'page'");
	if ( $page_name_id == '' ) $page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%".trim($page_name)."%' AND post_type = 'page'");
	return $page_name_id;
}

?>