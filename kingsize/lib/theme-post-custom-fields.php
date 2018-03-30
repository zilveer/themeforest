<?php
/**
 * @KingSize 2011-2016
 * The PHP code for setup Theme post custom fields.
 * OurWebMedia https://www.ourwebmedia.com
 **/
include_once("meta-fields.php");

/*
	Begin creating custom post fields 
*/

$general_postmetas = 
	array (
		/*
			Begin Post custom fields
		*/
		array('type' => 'start'),

		array("section" => "Featured Images", "name" => "Featured Images Lightbox Options", "id" => "kingsize_featured_img_lightbox", "type" => "select", "title" => "Featured Image", "items" => array("disable"=>"Disable Lightbox", "enable"=>"Enable Lightbox"),'desc'=>'Enable / Disable Lightbox on the Featured Image.'),

		/* Define the Featured Image Height override v4 */
		array("section" => "Featured Image Height", "name" => "Featured Image Height", "id" => "kingsize_post_featured_img_height",  "title" => "Featured Image Height",'type' => 'text','desc'=>'Insert a custom height for your featured image used.',"size" =>"5"),

		array('type' => 'close'),

		array('type' => 'start'),
		/* Hide the content and Menu option v4*/
		array("section" => "Show Featured Image", "name" => "Show Featured Image", "id" => "kingsize_post_featured_img_inside",  "title" => "Show Featured Image", 'type' => 'checkbox', 'desc'=>'Check to display this image inside your post.'),

		array("section" => "Disable the Sidebar", "name" => "Disable the Sidebar", "id" => "post_sidebar_hide",  "title" => "Hide the Sidebar", 'type' => 'checkbox', 'desc'=>'If checked will hide the sidebar on this post.'),

		array('type' => 'close'),
		
		array('type' => 'start'),
		
		array("section" => "Hide the Menu", "name" => "Hide the Menu", "id" => "post_hide_menu",  "title" => "Hide the Menu", 'type' => 'checkbox', 'desc'=>'If checked will hide the menu on page load.'),
		array("section" => "Grid Overlay", "name" => "Grid Overlay", "id" => "kingsize_post_grid_overlay", "type" => "select", "title" => "Grid Overlay", "items" => array( ""=>"Default" , "grid_disabled"=>"Disable Grid Overlay" , "grid_enabled"=>"Enable Grid Overlay"),'desc'=>'Control the grid overlay on this post.' ,'show_default_title'=>"false"),
		
		array('type' => 'close'),
		
		
		
		/*
			End Post custom fields
		*/
		
	);

$background_postmetas = 
	array (
		/*
			Begin Background Post custom fields
		*/
		//'extras' => 'getimage',
		array('type' => 'start', 'id' => 'post-backgrounds'),

		array("section" => "Custom Background", "id" => "kingsize_post_background",  "title" => "Custom Background" , "desc" => "Upload a unique [single image] background here.",'type' => 'text',"size" =>"20"),
		
		array("section" => "Browse", "id" => "upload_image_button_background",  "title" => "Browse" , "desc" => "",'type' => 'button'),
		
		array('type' => 'close'),

		array('type' => 'start'),
		
		array("section" => "Slider/Video Background", "name" => "Slider/Video Background", "id" => "kingsize_post_slider_video_background", "type" => "select", "title" => "Slider / Video Background", "items" => array(""=>"Default", "image"=>"Slider Background", "video"=>"Video Background"),'desc'=>'Enable the Background Slider / Video.','show_default_title'=>"false"),

		/* Hide the content and Menu option v4*/
		array("section" => "Hide the Body Content", "name" => "Hide the Body Content", "id" => "post_hide_content",  "title" => "Hide the Body Content", 'type' => 'select', 'desc'=>'Hide the body content when its first loaded.',"items" => array(""=>"Default / Show", "1"=>"Temporarily Hide the Body", "2"=>"Permanently Hide the Body"),'show_default_title'=>"false"),

		array('type' => 'close'),
		/*
			End Post custom fields
		*/
		
	);


$slider_postmetas = 
	array (
		/*
			Begin Slider Post custom fields
		*/
		array('type' => 'start'),
		/* Background Slider Categories V4 */
		array("section" => "Background Slider Category ID", "name" => "Slider Category ID", "id" => "kingsize_post_background_slider_id",  "title" => " Slider Category ID",'type' => 'text','desc'=>'Assign the Category ID of the Slider you want displayed as background for use.'),

		array("section" => "Transition Effect", "name" => "Transition Effect", "id" => "kingsize_post_slider_transition_type", "type" => "select", "title" => "Transition Effect", "items" => array("Fade"=>"Fade", "Slide Top"=>"Slide Top", "Slide Right"=>"Slide Right", "Slide Bottom"=>"Slide Bottom", "Slide Left"=>"Slide Left", "Carousel Right"=>"Carousel Right", "Carousel Left"=>"Carousel Left"),'desc'=>'Select a transition effect to use between slide images.','show_default_title'=>"false"),
		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Number of Slides", "name" => "Number of Slides", "id" => "kingsize_post_slider_show_number",  "title" => "Number of Slides",'type' => 'text','desc'=>'Define how many slides to display from this specific Category.'),

		array("section" => "Slider Order", "name" => "Slider Order", "id" => "kingsize_post_slider_display", "type" => "select", "title" => "Slider Order", "items" => array(""=>"Default DESC (by Date)", "Random Order"=>"Random Order", "Custom ID Order"=>"Custom ID Order", "ASC (by Date)"=>"ASC (by Date)"),'desc'=>'Choose an order to used for your background slider.','show_default_title'=>"false"),
		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Intrevals", "name" => "Intrevals", "id" => "kingsize_post_slider_seconds",  "title" => "Intrevals",'type' => 'text','desc'=>'<strong style="color: red;">Required</strong>: Must be defined in milliseconds (ie., 5000 = 5 seconds). Used to define time between the images.'),

		array("section" => "Titles & Descriptions", "name" => "Titles & Descriptions", "id" => "kingsize_post_slider_contents", "type" => "select", "title" => "Titles & Descriptions", "items" => array("Display only Slider Images"=>"Display only Slider Images", "Display Title & Description"=>"Display Title & Description", "Display Title"=>"Display Title", "Display Description"=>"Display Description"),'desc'=>'Choose to display Titles and Descriptions, one or the other, or just slider images from the assigned slider used.','show_default_title'=>"false"),

		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Transitions Time", "name" => "Transitions Time", "id" => "kingsize_post_slider_transition_seconds",  "title" => "Transitions Time",'type' => 'text','desc'=>'<strong style="color: red;">Required</strong>: Must be defined in milliseconds (ie., 5000 = 5 seconds). Used to define time between the images.'),
		/*array("section" => "Description Width", "name" => "Description Width", "id" => "kingsize_post_slide_caption",  "title" => "Description Width",'type' => 'text','desc'=>'Here you can define the "width" of the slider caption / description area. The default width is 550 (px). Just enter the numbers only.', "size" =>"5", "std" =>"550"),*/
		array("section" => "Slide Controllers", "name" => "Slide Controllers", "id" => "kingsize_post_slider_controllers", "type" => "select", "title" => "Slide Controllers", "items" => array("Disable Slider Controls"=>"Disable Slider Controls", "Enable Slider Controls"=>"Enable Slider Controls"),'desc'=>'Choose to show or hide the slider Controls / Navigation.','show_default_title'=>"false"),
		array('type' => 'close'),


		array('type' => 'start'),
		array("section" => "Controller Position", "name" => "Controller Position", "id" => "kingsize_post_slider_controller_position", "type" => "select", "title" => "Controller Position", "items" => array("display_controls_top"=>"Display Controls on Top of Slider Content", "display_controls_bottom"=>"Display Controls on Bottom of Slider Content"),'desc'=>'Choose to show controls above or below the details.','show_default_title'=>"false"),
		array('type' => 'close'),
		
	);

$video_postmetas = 
	array (
		/*
			Begin Video Post custom fields
		*/
		array('type' => 'start'),
		/* Video background options */
		array("section" => "Video Background URL", "name" => "Video Background URL", "id" => "kingsize_post_video_background",  "title" => "Video Background URL", 'type' => 'text', 'desc'=>'Insert your Video Background URL here.',"size" =>"20"),

		array("section" => "Autoplay Video", "name" => "Autoplay Video", "id" => "kingsize_post_autoplay_video",  "title" => "Autoplay Video", 'type' => 'checkbox', 'desc'=>'If checked video will autoplay on load.'),

		array('type' => 'close'),

		array('type' => 'start'),

		array("section" => "Controlbar Video", "name" => "Controlbar Video", "id" => "kingsize_post_controlbar_video",  "title" => "Controlbar Video", 'type' => 'checkbox', 'desc'=>'Check to hide the video controlbar.'),

		array("section" => "Repeat video", "name" => "Repeat Video", "id" => "kingsize_post_repeat_video",  "title" => "Repeat video", 'type' => 'checkbox', 'desc'=>'If checked video will repeat when finished.'),

		array('type' => 'close'),
		
		/* Mobile Background Upload */
		array('type' => 'start'),
		array("section" => "Mobile Image Background", "name" => "Mobile Image Background", "id" => "post_enable_mobile_background",  "title" => "Mobile Image Background", 'type' => 'select', 'desc'=>'Here you can enable/disable a Single Background Image to override Video Backgrounds on Mobile devices.',"items" => array(""=>"Default / Disabled", "1"=>"Enable Mobile Image Background", "2"=>"Disable Mobile Image Background"),'show_default_title'=>"false"),
		
		array("section" => "Custom Mobile Background Image", "id" => "post_mobile_video_background",  "title" => "Custom Mobile Background Image" , "desc" => "Upload a custom background image that overrides the desktop video background.", 'type' => 'text',"size" =>"10"),
		
		array("section" => "Browse", "id" => "upload_video_image_button_background",  "title" => "Browse" , "desc" => "",'type' => 'button'),
		
		array('type' => 'close'),
		/* END Mobile Background Upload */
		
		
		/*
			End Post custom fields
		*/
		
	);


###### Generating Meta boxes #######
function general_new_meta_box() {

	global $general_postmetas,$post;
	
	echo '<style>
	#post_hide_content { width: 130px !important; }
	#kingsize_post_video_background { width: 80% !important; }
	#kingsize_post_background { width: 80% !important; }
	#kingsize_post_porfolio_orderby, #kingsize_post_porfolio_category, #kingsize_post_slider_contents, #kingsize_post_columns, #kingsize_post_slider_transition_type, #kingsize_post_slider_display,  #kingsize_post_slider_video_background, #kingsize_post_slider_controller_position, #kingsize_post_grid_overlay { width: 130px !important; }
	.form-table th label span { font-size: 13px; font-weight: 300; }
	</style>';

	echo '<p style="padding:10px 0 0 0;">'.__('Here you can manage / customize your general post options specific to this unique post.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($general_postmetas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);

	endforeach;

	
	echo '</table>';

}

function background_new_meta_box() {

	global $background_postmetas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Here you can manage your general Background Options. Assign a single image background or enable either Slider or Video backgrounds. To upload a single image for the background click "Browse" or insert the image URL.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table background-options">';

	foreach ($background_postmetas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);

	endforeach;

	echo '</table>';

}

function video_new_meta_box() {

	global $video_postmetas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Manage and customize your background video options here specific to this post. Make sure you\'ve enabled the Video Background found inside the "KingSize Post Background Options" above.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($video_postmetas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);	

	endforeach;

	echo '</table>';

}

function slider_new_meta_box() {

	global $slider_postmetas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Manage and customize your background slider image options here specific to this post. Make sure you\'ve enabled the Image Slider Background found inside the "KingSize Post Background Options" above.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($slider_postmetas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);

	endforeach;
	echo '</table>';
}
###### End Generating Meta boxes #######



##### Saving the post values ############
function post_save_postdata( $post_id,$post_postmetas=array() ) {

	//global $post_postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	if ( 'post' != $_POST['post_type'] || !isset($_POST['post_type'])) return $post_id; //Fix for quick edit mode.


	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'post' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	foreach ( $post_postmetas as $postmeta ) {
	
		if ($_POST[$postmeta['id']]) {
			post_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if ($_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}

	 // file upload //		
	 /*	
		if ($_FILES["upload_kingsize_post_background"]["type"]){

			$special_chars = array (' ','`','"','\'','\\','/'," ","#","$","%","^","&","*","!","~","`","\"","'","'","=","?","/","[","]","(",")","|","<",">",";","\\",",");
			$filename = str_replace($special_chars,'',$_FILES['upload_kingsize_post_background']['name']);
			
			$directory = dirname(__FILE__) . "/images/upload/";
			$directory = str_replace("lib/","",$directory);		
			@move_uploaded_file($_FILES["upload_kingsize_post_background"]["tmp_name"],
			$directory . $filename);
			@chmod($directory . $filename, 0644);
			$uploaded_image_path = get_option('siteurl'). "/wp-content/themes/". get_option('template')."/images/upload/". $filename;

			//updating the meta value of background 
			post_update_custom_meta($post_id, $uploaded_image_path, "kingsize_post_background");
		}
	*/
	/// ennd file upload //

}

function post_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}


//Add all meta fields to write up panel
function post_create_meta_box() {
	if ( function_exists('add_meta_box')) {  
		add_meta_box( 'general_metabox', 'KingSize General Post Options', 'general_new_meta_box', 'post', 'normal', 'high' );
		add_meta_box( 'background_metabox', 'KingSize Post Background Options', 'background_new_meta_box', 'post', 'normal', 'high' );
		add_meta_box( 'slider_metabox', 'KingSize Image Slider Options', 'slider_new_meta_box', 'post', 'normal', 'high' );
		add_meta_box( 'video_metabox', 'KingSize Video Background Options', 'video_new_meta_box', 'post', 'normal', 'high' );
	}
} 

//Saving all data
function post_save($post_id)
{
	// don't run this for quickedit
	if ( defined('DOING_AJAX') )
		return;

	global $post_postmetas,$general_postmetas,$background_postmetas,$video_postmetas,$slider_postmetas;


	post_save_postdata( $post_id,$general_postmetas);
	post_save_postdata( $post_id,$background_postmetas);
	post_save_postdata( $post_id,$slider_postmetas);
	post_save_postdata( $post_id,$video_postmetas);
	
}

//init
add_action('admin_menu', 'post_create_meta_box'); 
add_action('save_post', 'post_save'); 
/*
	End creating custom fields
*/

?>
