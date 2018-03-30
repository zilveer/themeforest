<?php
/**
 * @KingSize 2013
 * The PHP code for setup Theme portfolio custom fields.
 * OurWebMedia http://www.ourwebmedia.com
 **/

#-----------------------------------------------------------------#
#####################  Define Metabox Fields  #####################
#-----------------------------------------------------------------#
include_once(get_template_directory() . "/lib/meta-fields.php");



$portfolio_portfoliometas = 
	array (
		/*
			Begin Page custom fields
		*/
		array('type' => 'start'),
		array('name' => 'Custom Button Text','title' => 'Custom Button Text','desc' => 'Insert a custom read more text to be used.',
			'id' => 'portfolios_read_more_text','type' => 'text','std' => 'Read More'),
		array('name' => 'Thumbnail Link','title' => 'Thumbnail Link','desc' => 'Insert a custom URL for the thumbnail.','id' => 'portfolios_thumbnail_link','type' => 'text','std' => ''),	
		array('type' => 'close'),

		array('type' => 'start'),
		array('name' => 'Custom Button Link','title' => 'Custom Button Link','desc' => 'Insert a custom URL for the button to use.','id' => 'portfolios_read_more_link','type' => 'text','std' => ''),	
		array('name' => 'Disable Button','title' => 'Disable Button','desc' => 'Disable the portfolio read more button.',
			'id' => 'portfolios_read_more_disable','type' => 'checkbox','std' => ''),	
		array('type' => 'close'),
		
		array('type' => 'start'),
		array( "title" => "Thumbnail Lightbox","name" => "Thumbnail Lightbox","id" => "portfolios_lightbox_disable","type" => "select", "items" => array("enable"=>"Enable Lightbox", "disable"=>"Disable Lightbox"), "std" => "enable", "desc" => "Choose to enable or disable lightbox on portfolio thumbnails.",'show_default_title'=>"false"),
		
		array("section" => "Exclude Featured Thumbnail", "name" => "Exclude Featured Thumbnail", "id" => "kingsize_exclude_portfolio_thumb",  "title" => "Exclude Featured Thumbnail", 'type' => 'checkbox', 'desc'=>'Check this to exclude the featured thumbnail image assigned to this post from showing in the lightbox window.','std' => ''),
		
		array('type' => 'close'),
		
		array('type' => 'start'),	
		/* Added in V4.1.3 */
		array("section" => "Hide the Menu", "name" => "Hide the Menu", "id" => "kingsize_portfolio_hide_menu",  "title" => "Hide the Menu", 'type' => 'checkbox', 'desc'=>'If checked will hide the menu on page load.'),
		
		/*Turn off the sidebar v4*/
		array("section" => "Disable the Sidebar", "title" => "Disable the Sidebar","name" => "Disable the Sidebar", "id" => "portfolio_sidebar_hide",  "title" => "Hide the Sidebar", 'type' => 'checkbox', 'desc'=>'If checked will hide the sidebar on this.'),
				
		array('type' => 'close'),
		
		array('type' => 'start'),
		array("section" => "Grid Overlay", "name" => "Grid Overlay", "id" => "kingsize_portfolio_grid_overlay", "type" => "select", "title" => "Grid Overlay", "items" => array(""=>"Default" , "grid_disabled"=>"Disable Grid Overlay" , "grid_enabled"=>"Enable Grid Overlay" ),'desc'=>'Control the grid overlay on this post.','show_default_title'=>"false"),
		array('type' => 'close'),
		/*
			End Page custom fields
		*/
	);


$background_portfoliometas = 
	array (
		/*
			Begin Post custom fields
		*/
		array('type' => 'start'),

		array("section" => "Custom Background", "id" => "kingsize_portfolio_background",  "title" => "Custom Background" , "desc" => "Upload a custom background that overrides the default global image.", 'type' => 'text',"size" =>"20"),

		array("section" => "Browse", "id" => "upload_image_button_background",  "title" => "Browse" , "desc" => "",'type' => 'button'),

		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Slider / Video Background", "name" => "Slider / Video Background", "id" => "kingsize_portfolio_slider_video_background", "type" => "select", "title" => "Slider / Video Background", "items" => array(""=>"Default", "image"=>"Slider Background", "video"=>"Video Background"),'desc'=>'Enable the Background Slider / Video.','show_default_title'=>"false"),
		/* Hide the content and Menu option v4*/
		array("section" => "Hide the Body Content", "name" => "Hide the Body Content", "id" => "kingsize_portfolio_hide_content",  "title" => "Hide the Body Content", 'type' => 'select', 'desc'=>'Hide the body content when its first loaded.',"items" => array(""=>"Default / Disabled", "1"=>"Temporarily Hide the Body", "2"=>"Permanently Hide the Body"),'show_default_title'=>"false"),

		array('type' => 'close'),
		
		/*
			End Post custom fields
		*/
		
	);

$slider_portfoliometas = 
	array (
		
		/*
			Begin Slider Post custom fields
		*/
		array('type' => 'start'),
		/* Background Slider Categories V4 */
		array("section" => "Background Slider Category ID", "name" => "Slider Category ID", "id" => "kingsize_portfolio_background_slider_id",  "title" => " Slider Category ID",'type' => 'text','desc'=>'Assign the Category ID of the Slider you want displayed as background for use.'),

		array("section" => "Transition Effect", "name" => "Transition Effect", "id" => "kingsize_portfolio_slider_transition_type", "type" => "select", "title" => "Transition Effect", "items" => array("Fade"=>"Fade", "Slide Top"=>"Slide Top", "Slide Right"=>"Slide Right", "Slide Bottom"=>"Slide Bottom", "Slide Left"=>"Slide Left", "Carousel Right"=>"Carousel Right", "Carousel Left"=>"Carousel Left"),'desc'=>'Select a transition effect to use between slide images.','show_default_title'=>"false"),
		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Number of Slides", "name" => "Number of Slides", "id" => "kingsize_portfolio_slider_show_number",  "title" => "Number of Slides",'type' => 'text','desc'=>'Define how many slides to display from this specific Category.'),

		array("section" => "Slider Order", "name" => "Slider Order", "id" => "kingsize_portfolio_slider_display", "type" => "select", "title" => "Slider Order", "items" => array(""=>"Default DESC (by Date)", "Random Order"=>"Random Order", "Custom ID Order"=>"Custom ID Order", "ASC (by Date)"=>"ASC (by Date)"),'desc'=>'Choose an order to used for your background slider.','show_default_title'=>"false"),
		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Intrevals", "name" => "Intrevals", "id" => "kingsize_portfolio_slider_seconds",  "title" => "Intrevals",'type' => 'text','desc'=>'<strong style="color: red;">Required</strong>: Must be defined in milliseconds (ie., 5000 = 5 seconds). Used to define time between the images.'),

		array("section" => "Titles & Descriptions", "name" => "Titles & Descriptions", "id" => "kingsize_portfolio_slider_contents", "type" => "select", "title" => "Titles & Descriptions", "items" => array("Display only Slider Images"=>"Display only Slider Images", "Display Title & Description"=>"Display Title & Description", "Display Title"=>"Display Title", "Display Description"=>"Display Description"),'desc'=>'Choose to display Titles and Descriptions, one or the other, or just slider images from the assigned slider used.','show_default_title'=>"false"),

		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Transitions Time", "name" => "Transitions Time", "id" => "kingsize_portfolio_slider_transition_seconds",  "title" => "Transitions Time",'type' => 'text','desc'=>'<strong style="color: red;">Required</strong>: Must be defined in milliseconds (ie., 5000 = 5 seconds). Used to define time between the images.'),
		array("section" => "Description Width", "name" => "Description Width", "id" => "kingsize_portfolio_slide_caption",  "title" => "Description Width",'type' => 'text','desc'=>'Here you can define the "width" of the slider caption / description area. The default width is 550 (px). Just enter the numbers only.', "size" =>"5", "std" =>"550"),
		array('type' => 'close'),


		array('type' => 'start'),
		array("section" => "Slide Controllers", "name" => "Slide Controllers", "id" => "kingsize_portfolio_slider_controllers", "type" => "select", "title" => "Slide Controllers", "items" => array("Disable Slider Controls"=>"Disable Slider Controls", "Enable Slider Controls"=>"Enable Slider Controls"),'desc'=>'Choose to show or hide the slider Controls / Navigation.','show_default_title'=>"false"),

		array("section" => "Controller Position", "name" => "Controller Position", "id" => "kingsize_portfolio_slider_controller_position", "type" => "select", "title" => "Controller Position", "items" => array("display_controls_top"=>"Display Controls on Top of Slider Content", "display_controls_bottom"=>"Display Controls on Bottom of Slider Content"),'desc'=>'Choose to show controls above or below the details.','show_default_title'=>"false"),
		array('type' => 'close'),
		
	);

	$video_portfoliometas = 
	array (
		/*
			Begin Video Post custom fields
		*/
		array('type' => 'start'),
		/* Video background options */
		array("section" => "Video Background URL", "name" => "Video Background URL", "id" => "kingsize_portfolio_video_background",  "title" => "Video Background URL", 'type' => 'text', 'desc'=>'Insert your Video Background URL here.',"size" =>"20"),

		array("section" => "Autoplay Video", "name" => "Autoplay Video", "id" => "kingsize_portfolio_autoplay_video",  "title" => "Autoplay Video", 'type' => 'checkbox', 'desc'=>'If checked video will autoplay on load.'),

		array('type' => 'close'),

		array('type' => 'start'),

		array("section" => "Controlbar Video", "name" => "Controlbar Video", "id" => "kingsize_portfolio_controlbar_video",  "title" => "Controlbar Video", 'type' => 'checkbox', 'desc'=>'Check to hide the video controlbar.'),

		array("section" => "Repeat video", "name" => "Repeat Video", "id" => "kingsize_portfolio_repeat_video",  "title" => "Repeat video", 'type' => 'checkbox', 'desc'=>'If checked video will repeat when finished.'),

		array('type' => 'close'),
		
		
		/* Mobile Background Upload */
		array('type' => 'start'),
		array("section" => "Mobile Image Background", "name" => "Mobile Image Background", "id" => "portfolio_enable_mobile_background",  "title" => "Mobile Image Background", 'type' => 'select', 'desc'=>'Here you can enable/disable a Single Background Image to override Video Backgrounds on Mobile devices.',"items" => array(""=>"Default / Disabled", "1"=>"Enable Mobile Image Background", "2"=>"Disable Mobile Image Background"),'show_default_title'=>"false"),
		
		array("section" => "Custom Mobile Background Image", "id" => "portfolio_mobile_video_background",  "title" => "Custom Mobile Background Image" , "desc" => "Upload a custom background image that overrides the desktop video background.", 'type' => 'text',"size" =>"10"),
		
		array("section" => "Browse", "id" => "upload_video_image_button_background",  "title" => "Browse" , "desc" => "",'type' => 'button'),
		
		array('type' => 'close'),
		/* END Mobile Background Upload */
		
		/*
			End Post custom fields
		*/
		
	);

	$photo_portfoliometas = array(
			array('type' => 'start'),
			array(
					'name' => 'Portfolio Thumbnail',
					'title' => 'Portfolio Thumbnail',
					'desc' => 'Upload or insert the URL for your image thumbnail.',
					'id' => 'upload_image',
					'type' => 'text',
					'std' => ''
				),
			array(
					'name' => '',
					'desc' => '',
					'id' => 'upload_image_button',
					'type' => 'button',
					'std' => 'Browse'
				),
			array('type' => 'close'),
	);

	$video_portfolio_portfoliometas = array(
		array('type' => 'start'),
		array(
			'title' => 'Video Thumbnail',
			'name' => 'Video Thumbnail',
			'desc' => 'Upload or link the thumbnail you want for your video portfolio item.',
			'id' => 'upload_image_thumb',
			'type' => 'text',
			'std' => ''
		),
		array(
				'title' => '',
				'name' => '',
				'desc' => '',
				'id' => 'upload_image_button_thumb',
				'type' => 'button',
				'std' => 'Browse'
			),
		array('type' => 'close'),

		array('type' => 'start'),
		array(
				'title' => 'Youtube or Vimeo URL',
				'name' => 'Youtube or Vimeo URL',
				'desc' => 'If you are using YouTube or Vimeo, enter in the URL. To adjust Width and Height of your videos, ie., add "<b>&width=700&height=800</b>" to the end of the Youtube / Vimeo URL.',
				'id' => 'kingsize_video_url',
				'type' => 'text',
				'std' => ''
			),
		array(
				'title' => 'Embedded Code',
				'name' => 'Embedded Code',
				'desc' => 'If you are using something other than YouTube or Vimeo, paste the embed code here. To remove, you would simply erase the entire contents of this box and now save.',
				'id' => 'kingsize_embed_code',
				'type' => 'textarea',
				'std' => ''
			),
		array('type' => 'close'),
	);


###### Generating Meta boxes #######
function portfolio_portfolio_meta_box() {

	global $portfolio_portfoliometas,$post;
	
	echo '<style>
	#portfolio_hide_content { width: 130px !important; }
	#kingsize_portfolio_video_background { width: 80% !important; }
	#kingsize_portfolio_background { width: 80% !important; }
	#upload_image, #upload_image_thumb {width: 80% !important; }
	#kingsize_portfolio_porfolio_orderby, #kingsize_portfolio_porfolio_category, #kingsize_portfolio_slider_contents, #kingsize_portfolio_columns, #kingsize_portfolio_slider_transition_type, #kingsize_portfolio_slider_display,  #kingsize_portfolio_slider_video_background, #kingsize_portfolio_slider_controller_position, #portfolio_hide_content, #kingsize_portfolio_hide_content, #kingsize_portfolio_grid_overlay { width: 130px !important; }
	.form-table th label span { font-size: 13px; font-weight: 300; }
	</style>';

	echo '<p style="padding:10px 0 0 0;">'.__('Manage your portfolio setting here.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($portfolio_portfoliometas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);

	endforeach;

	echo '</table>';
}


function background_portfolio_meta_box() {

	global $background_portfoliometas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Here you can manage your general Background Options. Assign a single image background or enable either Slider or Video backgrounds. To upload a single image for the background click "Browse" or insert the image URL.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($background_portfoliometas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);

	endforeach;

	echo '</table>';

}


function slider_portfolio_meta_box() {

	global $slider_portfoliometas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Manage and customize your background slider image options here specific to this post. Make sure you\'ve enabled the Image Slider Background found inside the "KingSize Portfolio Background Options" above.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($slider_portfoliometas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);

	endforeach;
	echo '</table>';
}


function video_portfolio_meta_box() {

	global $video_portfoliometas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Manage and customize your background video options here specific to this post. Make sure you\'ve enabled the Video Background found inside the "KingSize Portfolio Background Options" above.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($video_portfoliometas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);
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

function photo_portfolio_meta_box() {

	global $photo_portfoliometas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('You can assign your Portfolio Thumbnail (image) here. This is <strong>not for videos</strong>. To add additional images to open in lightbox you need to "<strong>Add Media</strong>" to this Portfolio post and when the thumbnail is clicked to open it will then load those images attached to this post. Otherwise without attached media, only the single image below will be used.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($photo_portfoliometas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);
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

function video_portfolio_portfolio_meta_box() {

	global $video_portfolio_portfoliometas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('This area is for the use of <strong>Video Portfolios</strong>. Add your Video URL or Embed Code, along with Portfolio Thumbnail below. Videos will not automatically generate a thumbnail so it is required that you upload a thumbnail as well.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($video_portfolio_portfoliometas as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);
		elseif($meta['type'] == 'textarea')
			meta_textarea($meta, $value);

	endforeach;

	echo '</table>';

}
###### End Generating Meta boxes #######


function portfolio_save_postdata( $post_id,$portfolio_postmetas=array()  ) {

	//global $page_postmetas;

	// verify this came from the our screen and with proper authorization, because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	if ( 'portfolio' != $_POST['post_type'] || !isset($_POST['post_type'])) return $post_id; //Fix for quick edit mode.

	// Check permissions
	if ( isset($_POST['post_type']) && 'portfolio' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
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

	foreach ( $portfolio_postmetas as $postmeta ) {
	
		if ($_POST[$postmeta['id']]) {
			portfolio_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if ($_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}
}

function portfolio_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}



//Add all meta fields to write up panel
function portfolio_create_meta_box() {
	if ( function_exists('add_meta_box') ) {  
		add_meta_box( 'portfolio_metabox', 'Kingsize General Portfolio Options', 'portfolio_portfolio_meta_box', 'portfolio', 'normal', 'high' );
		add_meta_box( 'photo_metabox', 'Image / Photo Portfolio Thumbnail Settings', 'photo_portfolio_meta_box', 'portfolio', 'normal', 'high' );
		add_meta_box( 'portfolio-meta-box-video', 'Video Portfolio - Thumbnail &amp; Video Settings', 'video_portfolio_portfolio_meta_box', 'portfolio', 'normal', 'high' );
		add_meta_box( 'background_metabox', 'Kingsize Portfolio Background Options', 'background_portfolio_meta_box', 'portfolio', 'normal', 'high' );
		add_meta_box( 'slider_metabox', 'Kingsize Image Slider Options', 'slider_portfolio_meta_box', 'portfolio', 'normal', 'high' );
		add_meta_box( 'video_metabox', 'Kingsize Video Background Options', 'video_portfolio_meta_box', 'portfolio', 'normal', 'high' );
	}
}  

//Saving all data
function portfolio_save($post_id)
{
	global $portfolio_portfoliometas,$background_portfoliometas,$video_portfoliometas,$slider_portfoliometas,$photo_portfoliometas,$video_portfolio_portfoliometas;
	
	// don't run this for quickedit
	if ( defined('DOING_AJAX') )
		return;

	portfolio_save_postdata( $post_id,$portfolio_portfoliometas);
	portfolio_save_postdata( $post_id,$photo_portfoliometas);
	portfolio_save_postdata( $post_id,$video_portfolio_portfoliometas);
	portfolio_save_postdata( $post_id,$background_portfoliometas);
	portfolio_save_postdata( $post_id,$video_portfoliometas);
	portfolio_save_postdata( $post_id,$slider_portfoliometas);
}

//init
add_action('admin_menu', 'portfolio_create_meta_box'); 
add_action('save_post', 'portfolio_save'); 
/*
	End creating custom fields
*/


/*-------------------------------------------------------*/
#####################  Queue Scripts  #####################
/*-------------------------------------------------------*/
 
function kingsize_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('kingsize-upload', get_template_directory_uri() . '/lib/portfolio/js/kingsize-portfolio-upload-button.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('kingsize-upload');
}
function kingsize_admin_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'kingsize_admin_scripts');
add_action('admin_print_styles', 'kingsize_admin_styles');
