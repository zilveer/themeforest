<?php 
/**
 * @KingSize 2013
 * The PHP code for setup Theme page custom fields.
 * OurWebMedia http://www.ourwebmedia.com
 **/

/*
	Begin creating custom fields
*/
include_once("meta-fields.php");

#### DropDown for the porfolio PAGE  CATEGORY ####
define('TERM_TAXONOMY', $wpdb->prefix . 'term_taxonomy');
define('TERMS', $wpdb->prefix . 'terms');
define('POSTS', $wpdb->prefix . 'posts');
define('TERM_RELATIONSHIPS', $wpdb->prefix . 'term_relationships');


$arr_cat_portfolio = array();
$arr_cat_portfolio = $wpdb->get_results("SELECT terms.name,term_taxonomy_id,terms.term_id FROM ".TERM_TAXONOMY." taxonomy,".TERMS." terms 
WHERE terms.term_id = taxonomy.term_id AND taxonomy = 'portfolio-category' ORDER BY terms.name");
$arr_dropdown_portfolio_cat = array();
if(count($arr_cat_portfolio)) :
	foreach($arr_cat_portfolio as $portfolio_cat){
		$arr_dropdown_portfolio_cat[$portfolio_cat->term_id] = $portfolio_cat->name;
		//$arr_dropdown_portfolio_cat[$portfolio_cat->term_taxonomy_id] = $portfolio_cat->name;
	}
endif;
######## End DropDown for the porfolio PAGE  CATEGORY ############

#### DropDown for the porfolio PAGE  ORDERBY V4 ####
$arr_dropdown_portfolio_orderby =  array(""=>"Default DESC (by Date)", "rand"=>"Random Order", "custom_id"=>"Custom ID Order", "asc_order"=>"ASC (by Date)");
#### End DropDown for the porfolio PAGE  ORDERBY V4 ####




$portfolio_pagemetas = 
	array (
		/*
			Begin Page custom fields
		*/
		array('type' => 'start'),
		
		array("section" => "Portfolio Categories", "name" => "Portfolio Categories", "id" => "kingsize_page_porfolio_category", "type" => "select", "title" => "Select a Portfolio", "items" => $arr_dropdown_portfolio_cat, 'desc'=>'To create different / unlimited Portfolios, create "<a href="edit-tags.php?taxonomy=portfolio-category&post_type=portfolio">Portfolio Categories</a>" and assign them here when creating the Portfolio page.'),

		/* PORTFOLIO ORDERBY V4 */
		array("section" => "Portfolio ORDERBY", "name" => "Portfolio OrderBy", "id" => "kingsize_page_porfolio_orderby", "type" => "select", "title" => "Portfolio Order", "items" => $arr_dropdown_portfolio_orderby, 'desc'=>'To create order in which they want these portfolio items displayed on this specific Portfolio Page.'),
		/* End PORTFOLIO ORDERBY V4 */
		array('type' => 'close'),

		array('type' => 'start'),
		
		array("section" => "Gallery Layouts", "name" => "Gallery Page Layouts", "id" => "kingsize_page_columns", "type" => "select", "title" => "Select a Layout", "items" => array("2columns"=>"2 Column Layout", "3columns"=>"3 Column Layout", "4columns"=>"4 Column Layout", "grid"=>"The Grid Layout"),'desc'=>'If using a Portfolio or Gallery Page Templates, you can use this option to define the layouts.'),
		
		array("section" => "Hide the Menu", "name" => "Hide the Menu", "id" => "page_hide_menu",  "title" => "Hide the Menu", 'type' => 'checkbox', 'desc'=>'If checked will hide the menu on page load.'),

		array('type' => 'close'),
		
		array('type' => 'start'),
		
		array("section" => "Grid Overlay", "name" => "Grid Overlay", "id" => "kingsize_page_grid_overlay", "type" => "select", "title" => "Grid Overlay", "items" => array( ""=>"Default" , "grid_disabled"=>"Disable Grid Overlay" , "grid_enabled"=>"Enable Grid Overlay"),'desc'=>'Control the grid overlay on this page.','show_default_title'=>"false"),
		
		array("section" => "Disable the Sidebar", "name" => "Disable the Sidebar", "id" => "page_sidebar_hide",  "title" => "Hide the Sidebar", 'type' => 'checkbox', 'desc'=>'If checked will hide the sidebar on this page.'),
		array('type' => 'close'),
		
		/*
			End Page custom fields
		*/
		
	);


$background_pagemetas = 
	array (
		/*
			Begin Post custom fields
		*/
		array('type' => 'start'),

		array("section" => "Custom Background", "id" => "kingsize_page_background",  "title" => "Custom Background" , "desc" => "Upload a custom background that overrides the default global image.", 'type' => 'text',"size" =>"20"),

		array("section" => "Browse", "id" => "upload_image_button_background",  "title" => "Browse" , "desc" => "",'type' => 'button'),

		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Slider / Video Background", "name" => "Slider / Video Background", "id" => "kingsize_page_slider_video_background", "type" => "select", "title" => "Slider / Video Background", "items" => array(""=>"Default", "image"=>"Slider Background", "video"=>"Video Background"),'desc'=>'Enable the Background Slider / Video.','show_default_title'=>"false"),
		/* Hide the content and Menu option v4*/
		array("section" => "Hide the Body Content", "name" => "Hide the Body Content", "id" => "page_hide_content",  "title" => "Hide the Body Content", 'type' => 'select', 'desc'=>'Hide the body content when its first loaded.',"items" => array(""=>"Default / Show", "1"=>"Temporarily Hide the Body", "2"=>"Permanently Hide the Body"),'show_default_title'=>"false"),
		array('type' => 'close'),
		
		/*
			End page custom fields
		*/
		
	);

$slider_pagemetas = 
	array (
		
		/*
			Begin Slider Page custom fields
		*/
		array('type' => 'start'),
		/* Background Slider Categories V4 */
		array("section" => "Background Slider Category ID", "name" => "Slider Category ID", "id" => "kingsize_page_background_slider_id",  "title" => " Slider Category ID",'type' => 'text','desc'=>'Assign the Category ID of the Slider you want displayed as background for use.'),

		array("section" => "Transition Effect", "name" => "Transition Effect", "id" => "kingsize_page_slider_transition_type", "type" => "select", "title" => "Transition Effect", "items" => array("Fade"=>"Fade", "Slide Top"=>"Slide Top", "Slide Right"=>"Slide Right", "Slide Bottom"=>"Slide Bottom", "Slide Left"=>"Slide Left", "Carousel Right"=>"Carousel Right", "Carousel Left"=>"Carousel Left"),'desc'=>'Select a transition effect to use between slide images.','show_default_title'=>"false"),
		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Number of Slides", "name" => "Number of Slides", "id" => "kingsize_page_slider_show_number",  "title" => "Number of Slides",'type' => 'text','desc'=>'Define how many slides to display from this specific Category.'),

		array("section" => "Slider Order", "name" => "Slider Order", "id" => "kingsize_page_slider_display", "type" => "select", "title" => "Slider Order", "items" => array(""=>"Default DESC (by Date)", "Random Order"=>"Random Order", "Custom ID Order"=>"Custom ID Order", "ASC (by Date)"=>"ASC (by Date)"),'desc'=>'Choose an order to used for your background slider.','show_default_title'=>"false"),
		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Intrevals", "name" => "Intrevals", "id" => "kingsize_page_slider_seconds",  "title" => "Intrevals",'type' => 'text','desc'=>'<strong style="color: red;">Required</strong>: Must be defined in milliseconds (ie., 5000 = 5 seconds). Used to define time between the images.'),

		array("section" => "Titles & Descriptions", "name" => "Titles & Descriptions", "id" => "kingsize_page_slider_contents", "type" => "select", "title" => "Titles & Descriptions", "items" => array("Display only Slider Images"=>"Display only Slider Images", "Display Title & Description"=>"Display Title & Description", "Display Title"=>"Display Title", "Display Description"=>"Display Description"),'desc'=>'Choose to display Titles and Descriptions, one or the other, or just slider images from the assigned slider used.','show_default_title'=>"false"),

		array('type' => 'close'),

		array('type' => 'start'),
		array("section" => "Transitions Time", "name" => "Transitions Time", "id" => "kingsize_page_slider_transition_seconds",  "title" => "Transitions Time",'type' => 'text','desc'=>'<strong style="color: red;">Required</strong>: Must be defined in milliseconds (ie., 5000 = 5 seconds). Used to define time between the images.'),
		/*array("section" => "Description Width", "name" => "Description Width", "id" => "kingsize_page_slide_caption",  "title" => "Description Width",'type' => 'text','desc'=>'Here you can define the "width" of the slider caption / description area. The default width is 550 (px). Just enter the numbers only.', "size" =>"5", "std" =>"550"),*/
		array("section" => "Slide Controllers", "name" => "Slide Controllers", "id" => "kingsize_page_slider_controllers", "type" => "select", "title" => "Slide Controllers", "items" => array("Disable Slider Controls"=>"Disable Slider Controls", "Enable Slider Controls"=>"Enable Slider Controls"),'desc'=>'Choose to show or hide the slider Controls / Navigation.','show_default_title'=>"false"),

		array('type' => 'close'),


		array('type' => 'start'),
		array("section" => "Controller Position", "name" => "Controller Position", "id" => "kingsize_page_slider_controller_position", "type" => "select", "title" => "Controller Position", "items" => array("display_controls_top"=>"Display Controls on Top of Slider Content", "display_controls_bottom"=>"Display Controls on Bottom of Slider Content"),'desc'=>'Choose to show controls above or below the details.','show_default_title'=>"false"),
		array('type' => 'close'),
		
	);


$video_pagemetas = 
	array (
		/*
			Begin Video Post custom fields
		*/
		array('type' => 'start'),
		/* Video background options */
		array("section" => "Video Background URL", "name" => "Video Background URL", "id" => "kingsize_page_video_background",  "title" => "Video Background URL", 'type' => 'text', 'desc'=>'Insert your Video Background URL here.',"size" =>"20"),

		array("section" => "Autoplay Video", "name" => "Autoplay Video", "id" => "kingsize_page_autoplay_video",  "title" => "Autoplay Video", 'type' => 'checkbox', 'desc'=>'If checked video will autoplay on load.'),

		array('type' => 'close'),

		array('type' => 'start'),

		array("section" => "Controlbar Video", "name" => "Controlbar Video", "id" => "kingsize_page_controlbar_video",  "title" => "Controlbar Video", 'type' => 'checkbox', 'desc'=>'Check to hide the video controlbar.'),

		array("section" => "Repeat video", "name" => "Repeat Video", "id" => "kingsize_page_repeat_video",  "title" => "Repeat video", 'type' => 'checkbox', 'desc'=>'If checked video will repeat when finished.'),

		array('type' => 'close'),
		
		/* Mobile Background Upload */
		array('type' => 'start'),
		array("section" => "Mobile Image Background", "name" => "Mobile Image Background", "id" => "page_enable_mobile_background",  "title" => "Mobile Image Background", 'type' => 'select', 'desc'=>'Here you can enable/disable a Single Background Image to override Video Backgrounds on Mobile devices.',"items" => array(""=>"Default / Disabled", "1"=>"Enable Mobile Image Background", "2"=>"Disable Mobile Image Background"),'show_default_title'=>"false"),
		
		array("section" => "Custom Mobile Background Image", "id" => "page_mobile_video_background",  "title" => "Custom Mobile Background Image" , "desc" => "Upload a custom background image that overrides the desktop video background.", 'type' => 'text',"size" =>"10"),
		
		array("section" => "Browse", "id" => "upload_video_image_button_background",  "title" => "Browse" , "desc" => "",'type' => 'button'),
		
		array('type' => 'close'),
		/* END Mobile Background Upload */
		
		/*
			End page custom fields
		*/
		
	);


###### Generating Meta boxes #######
function portfolio_page_meta_box() {

	global $portfolio_pagemetas,$post;
	
	echo '<style>
	#kingsize_page_video_background { width: 80% !important; }
	#kingsize_page_background { width: 80% !important; }
	#kingsize_page_porfolio_orderby, #kingsize_page_porfolio_category, #kingsize_page_slider_contents, #kingsize_page_columns, #kingsize_page_slider_transition_type, #kingsize_page_slider_display,  #kingsize_page_slider_video_background, #kingsize_page_slider_controller_position, #page_hide_content, #kingsize_page_hide_content, #kingsize_page_grid_overlay { width: 130px !important; }
	.form-table th label span { font-size: 13px; font-weight: 300; }
	</style>';

	echo '<p style="padding:10px 0 0 0;">'.__('Are you creating a <strong>Portfolio</strong> page? Here you can manage your Portfolio page settings.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($portfolio_pagemetas as $meta) :

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


function background_page_meta_box() {

	global $background_pagemetas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Here you can manage your general Background Options. Assign a single image background or enable either Slider or Video backgrounds. To upload a single image for the background click "Browse" or insert the image URL.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($background_pagemetas as $meta) :

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


function slider_page_meta_box() {

	global $slider_pagemetas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Manage and customize your background slider image options here specific to this page. Make sure you\'ve enabled the Image Slider Background found inside the "KingSize Page Background Options" above.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table slider-options">';

	foreach ($slider_pagemetas as $meta) :

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


function video_page_meta_box() {

	global $video_pagemetas,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Manage and customize your background video options here specific to this page. Make sure you\'ve enabled the Video Background found inside the "KingSize Page Background Options" above.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($video_pagemetas as $meta) :

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
###### End Generating Meta boxes #######


################################################################
 function kingsize_add_edit_form_multipart_encoding() {

    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'kingsize_add_edit_form_multipart_encoding');
################################################################


function page_save_postdata( $post_id,$page_postmetas ) {

	//global $page_postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	if ( 'page' != $_POST['post_type'] || !isset($_POST['post_type'])) return $post_id; //Fix for quick edit mode.
	
	//print "<pre>";
	//print_r($page_postmetas);
	

	// Check permissions
	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
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

	foreach ( $page_postmetas as $postmeta ) {
	
		if ($_POST[$postmeta['id']]) {
			page_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if ($_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}
	/// ennd file upload //

}

function page_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}


//Add all meta fields to write up panel
function page_create_meta_box() {
	
	if ( function_exists('add_meta_box') ) {  

		add_meta_box( 'portfolio_metabox', 'Kingsize General Page and Portfolio Options', 'portfolio_page_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'background_metabox', 'Kingsize Page Background Options', 'background_page_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'slider_metabox', 'Kingsize Image Slider Options', 'slider_page_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'video_metabox', 'Kingsize Video Background Options', 'video_page_meta_box', 'page', 'normal', 'high' );

	}
}  

//Saving all data
function page_save($post_id)
{
	// don't run this for quickedit
	if ( defined('DOING_AJAX') )
		return;

	global $portfolio_pagemetas,$background_pagemetas,$video_pagemetas,$slider_pagemetas;

	page_save_postdata( $post_id,$portfolio_pagemetas);
	page_save_postdata( $post_id,$background_pagemetas);
	page_save_postdata( $post_id,$slider_pagemetas);
	page_save_postdata( $post_id,$video_pagemetas);
	
}

//init
add_action('admin_menu', 'page_create_meta_box'); 
add_action('save_post', 'page_save'); 
/*
	End creating custom fields
*/
?>
