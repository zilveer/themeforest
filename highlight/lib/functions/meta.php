<?php
/**
 * This file contains all the functionality for the additional meta boxes for the pages and posts.
 * It contains functions for loading the meta data into arrays, displaying the meta boxes and
 * saving the meta data.
 *
 * @author Pexeto
 */

/**
 * ADD THE ACTIONS
 */
add_action('admin_menu', 'pexeto_load_meta_boxes');
add_action('admin_menu', 'create_meta_box');  
add_action('admin_menu', 'create_meta_post_box');  
add_action('admin_menu', 'create_meta_portfolio_box');  
add_action('save_post', 'save_postdata');  
add_action('save_post', 'save_post_postdata');  
add_action('save_post', 'save_portfolio_postdata'); 


function pexeto_load_meta_boxes(){
	//load the porftfolio categeories
	$portf_taxonomies=pexeto_get_taxonomies('portfolio_category');
	$portf_categories=array();

	foreach($portf_taxonomies as $taxonomy){
		$portf_categories[]=array("name"=>$taxonomy->name, "id"=>$taxonomy->term_id);
	}


	global $pexeto_manager, $new_meta_boxes, $new_meta_portfolio_boxes, $new_meta_post_boxes;

	/* ------------------------------------------------------------------------*
	 * META BOXES FOR THE PAGES
	 * ------------------------------------------------------------------------*/

	//the meta data for pages
	$new_meta_boxes =
	array(

	array(
		"title" => '<div class="ui-icon ui-icon-wrench"></div>Main Page Settings - available for all page templates',
		"type" => "heading"),

	array(
		"title" => "Slider",
		"name" => "slider",
		"type" => "select",
		"options" => array(array("name"=>"Thumbnail Slider", "id"=>"slider-thumbnail", "class"=>"thumbnailslider"),
	array("name"=>"Nivo Slider/Fader", "id"=>"slider-nivo", "class"=>"nivoslider"),
	array("name"=>"Content Slider", "id"=>"slider-content", "class"=>"contentslider"),
	array("name"=>"Accordion Slider", "id"=>"slider-accordion", "class"=>"accordionslider"),
	array("name"=>"Static Header Image", "id"=>"static-header", "class"=>"static"),
	array("name"=>"None", "id"=>"none", "class"=>"none")),
		"std" => 'none',
		"description" => 'If one of the 3 sliders has been selected, you can add the images in the "Highlight Options" page in
		the section of the selected slider. If 
		"Static Header Image" has been selected, you can upload the image in the Featured Image section on this page in the 
		right sidebar. If "None" has been selected, you can set a subtitle to the main header line in the "Subtitle" field below.'
		),

		array(
		"title" => "Slider Name",
		"name" => "slider_name",
		"type" => "select",
		"options" => $pexeto_manager->pexeto_slider_data,
		"std" => 'default',
		"description" => 'If you have created additional sliders you can select the name of the slider to be displayed
		on this page. By default the Default slider for each slider type is displayed.'
		),

		array(
		"title" => "Page Layout",
		"name" => "layout",
		"type" => "select",
		"options" => array(array("name"=>"Right Sidebar", "id"=>"right"),
		array("name"=>"Left Sidebar", "id"=>"left"),
		array("name"=>"Full width", "id"=>"full")),
		"std" => 'right',
		"description" => 'Available for Default, Featured Posts and Contact page templates'
		),

		array(
		"name" => "subtitle",
		"std" => "",
		"type" => "text",
		"title" => "Subtitle",
		"description" => "This is the subtitle that will be shown on the page if no slider is enabled"),
		
		array(
		"name" => "intro",
		"std" => "",
		"type" => "text",
		"title" => "Intro text",
		"description" => "This is the intro text that will be displayed below the header."),
		
		array(
		"name" => "sidebar",
		"title" => "Sidebar",
		"type" => "select",
		"options" => $pexeto_manager->pexeto_sidebars,
		"description" => 'You can select a sidebar for this page between the default one and another one that
		you have created. If you would like to use another sidebar, rather than the default one, you can
		create a new sidebar in "Highlight Options->Sidebars" section and after that you will be able to select the
		sidebar here.'),

		array(
		"title" => '<div class="ui-icon ui-icon-image"></div>Portfolio Settings - available only for Portfolio page templates',
		"type" => "heading"),

		array(
		"name" => "postCategory",
		"title" => "Display items from categories",
		"type" => "select",
		"none" => true,
		"options" => $portf_categories,
		"std" => '-1',
		"description" => 'If "All Categories" selected, all the Portfolio items will be displayed. If another category is selected, only the Portfolio items that belong
		to this category or this category\'s subcategories will be displayed.'),

		array(
		"name" => "column_number",
		"title" => "Number of columns",
		"type" => "select",
		"options" => array(array("name"=>"Two Columns", "id"=>"2"),
		array("name"=>"Three Columns", "id"=>"3"),
		array("name"=>"Four Columns", "id"=>"4")),
		"std" => '3',
		"description" => 'Available for the Gallery template'),

		array(
		"name" => "order",
		"title" => "Portfolio item order",
		"type" => "select",
		"options" => array(array("name"=>"By Date", "id"=>"date"),
		array("name"=>"By Custom Order", "id"=>"custom")),
		"std" => 'date',
		"description" => 'If you select "By Date" the last created item will be displayed first. If you select by "By Custom Order"
		you will have to set the order field of each of the items.'),


		array(
		"name" => "categories",
		"title" => "Show portfolio categories",
		"type" => "select",
		"options" => array(array("name"=>"Show", "id"=>"show"),
		array("name"=>"Hide", "id"=>"hide")),
		"std" => 'show',
		"description" => 'If "Show" selected, a category filter will be displayed above the portfolio items (only for the Gallery template)'),


		array(
		"name" => "showdesc",
		"title" => "Show item descriptions",
		"type" => "select",
		"options" => array( array("name"=>"Hide", "id"=>"false"),
		array("name"=>"Show", "id"=>"true")),
		"std" => 'hide',
		"description" => 'If "Show" selected, portfolio item title and description will be displayed below the image (only for the Gallery template)'
		),


		array(
		"title" => "Number of posts per page",
		"name" => "postNumber",
		"std" => "6",
		"type" => "text",
		"description" => "The number of smaller thumbnails to be displayed per page"
		),

		array(
		"title" => "Turn on/off title link",
		"name" => "_title_link",
		"type" => "select",
		"options" => array(array("name"=>"ON", "id"=>"on"),
		array("name"=>"OFF", "id"=>"off")),
		"description" => "If this functionality is turned on, the titles of your portfolio items will be links and
		will link to the section which contains the content of the portfolio item post. (only for the Gallery template)"
		),
		);



		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE PORTFOLIO POSTS
		 * ------------------------------------------------------------------------*/

		$new_meta_portfolio_boxes =
		array(

		array(
		"title" => "When clicked on the image open:",
		"name" => "action",
		"type" => "select",
		"options" => array(array("name"=>"Preview image in lightbox", "id"=>"lightbox"),
		array("name"=>"The content of the item", "id"=>"permalink"),
		array("name"=>"Play Video", "id"=>"video"),
		array("name"=>"Custom link", "id"=>"custom"),
		array("name"=>"Do Nothing", "id"=>"nothing")),
		"std" => "lightbox",
		"description" => "Select the action to be performed after clicking on a portfolio item. (only for the Gallery template)"
		),

		array(
		"title" => "Thumbnail URL",
		"name" => "thumbnail",
		"std" => "",
		"type" => "upload",
		"description" => 'By default the theme will generate automatically the thumbnail image for the item from
		the bigger perview image, set in the "Preview Image URL" field below. However, if you prefer to manually set
		this thumbnail image, you have to set its URL in this field.'
		),

		array(
		"title" => "Preview Image URL",
		"name" => "preview",
		"std" => "",
		"type" => "upload",
		"description" => 'Main preview image. If the "Thumbnail URL" field above is empty, the thumbnail image
		will be automatically generated by the image set in this field.'
		),

		array(
		"title" => "Custom Link/Video URL",
		"name" => "custom",
		"std" => "",
		"type" => "text",
		"description" => 'If "Play Video" selected above, you can insert a video URL here. If "Custom link" selected above, 
		you can insert the custom URL (only for the Gallery template)'
		),

		array(
		"title" => "Item Description",
		"name" => "description",
		"std" => "",
		"type" => "textarea",
		"description" => 'If the "Show item descriptions" field in enabled in the portfolio page, the description text will be
		displayed below the item image. If it is disabled, the description will be displayed in the lightbox. (only for the Gallery template)'
		),
		
		"image" => array(
		"name" => "subtitle",
		"std" => "",
		"type" => "text",
		"title" => "Subtitle",
		"description" => "This is the subtitle that will be shown on the single post page"),
		
			array(
		"name" => "show_title",
		"title" => "Show portfolio title on preview page",
		"type" => "select",
		"options" => array(array("name"=>"Show", "id"=>"show"),
		array("name"=>"Hide", "id"=>"hide")),
		"std" => 'show',
		"description" => 'If "Show" selected, the portfolio title will be displayed on the single portfolio page and on the
		Portfolio Showcase template.'),
		
		array(
		"name" => "show_preview",
		"title" => "Show preview image on preview page",
		"type" => "select",
		"options" => array(array("name"=>"Show", "id"=>"show"),
		array("name"=>"Hide", "id"=>"hide")),
		"std" => 'show',
		"description" => 'If "Show" selected, the preview image will be displayed on the single portfolio page and on the
		Portfolio Showcase template.')
		
		
		);
		
		$new_meta_post_boxes =
		array(
		"image" => array(
		"name" => "subtitle",
		"std" => "",
		"type" => "text",
		"title" => "Subtitle",
		"description" => "This is the subtitle that will be shown on the single post page"));
}

/**
 * Creates a page meta box.
 */
function create_meta_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-boxes', '<div class="icon-small"></div> '.PEXETO_THEMENAME.' PAGE SETTINGS', 'new_meta_boxes', 'page', 'normal', 'high' );
	}
}

/**
 * Creates a post meta box.
 */
function create_meta_post_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-post-boxes', '<div class="icon-small"></div> '.PEXETO_THEMENAME.' POST SETTINGS', 'new_meta_post_boxes', 'post', 'normal', 'high' );
	}
}


/**
 * Creates a post meta box.
 */
function create_meta_portfolio_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-portfolio-boxes', '<div class="icon-small"></div> '.PEXETO_THEMENAME.' PORTFOLIO ITEM SETTINGS', 'new_meta_portfolio_boxes', PEXETO_PORTFOLIO_POST_TYPE, 'normal', 'high' );
	}
}


/**
 * Calls the print method for page meta boxes.
 */
function new_meta_boxes() {
	global $post, $new_meta_boxes;

	foreach($new_meta_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Calls the print method for post meta boxes.
 */
function new_meta_post_boxes() {
	global $post, $new_meta_post_boxes;

	foreach($new_meta_post_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Calls the print method for portfolio meta boxes.
 */
function new_meta_portfolio_boxes() {
	global $post, $new_meta_portfolio_boxes;

	foreach($new_meta_portfolio_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Prints the meta box
 * @param $meta_box the meta box to be printed
 * @param $post the post to contain the meta box
 */
function print_meta_box($meta_box, $post){
	$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

	if($meta_box_value == "")
	$meta_box_value = $meta_box['std'];

	switch($meta_box['type']){
		case 'heading':
			echo'<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
<h4>'.$meta_box['title'].'</h4></div>';
			break;
		case 'text':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" class="option-input"/><br />';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
		case 'upload':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" id="pexeto-'.$meta_box['name'].'" class="option-input upload"/>';

			echo '<div id="pexeto-'.$meta_box['name'].'_button" class="upload-button upload-logo" ><a class="button button-upload"><span>Upload</span></a></div><br/>';

			//call the script for this upload button particularly
			$uploader_url = pexeto_generate_uploads_url($meta_box['name']);
			echo '<script type="text/javascript">jQuery(document).ready(function($){
				pexetoOptions.loadUploader(jQuery("div#pexeto-'.$meta_box['name'].'_button"), "'.$uploader_url.'", "'.PEXETO_UPLOADS_URL.'");
			});</script>'; 
				
			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
		case 'textarea':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<textarea name="'.$meta_box['name'].'_value" class="option-textarea" />'.$meta_box_value.'</textarea><br />';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
		case 'select':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';
			echo '<select name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">';

			if($meta_box['none']){
				?>
<option value="-1">All Categories</option>
				<?php
			}
				
			if(sizeof($meta_box['options'])>0){
				foreach ($meta_box['options'] as $option) { ?>
<option
<?php if ( $meta_box_value == $option['id']) {
	echo ' selected="selected"';
}
if ($option['id']=='disabled') {
	echo ' disabled="disabled"';
}

if ($option['class']!=null) {
	echo ' class="'.$option['class'].'"';
}
?>
	value="<?php echo($option['id']);?>"><?php echo $option['name']; ?></option>
<?php

				}
			}
			echo '</select>';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
	}
}


/**
 * Saves the meta box content of a page
 * @param $post_id the ID of the page that contains the meta box
 */
function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;

	if($post->post_type=='page'){
		$new_meta_boxes=$GLOBALS['new_meta_boxes'];
		pexeto_save_meta_data($new_meta_boxes, $post_id);
	}
}

/**
 * Saves the meta box content of a post
 * @param $post_id the ID of the post that contains the meta box
 */
function save_portfolio_postdata( $post_id ) {
	global $post, $new_meta_portfolio_boxes;

	if($post->post_type==PEXETO_PORTFOLIO_POST_TYPE){
		pexeto_save_meta_data($new_meta_portfolio_boxes, $post_id);
	}
}

/**
 * Saves the meta box content of a post
 * @param $post_id the ID of the post that contains the meta box
 */
function save_post_postdata( $post_id ) {
	global $post, $new_meta_post_boxes;

	if($post->post_type=='post'){
		pexeto_save_meta_data($new_meta_post_boxes, $post_id);
	}
}

/**
 * Saves the post meta for all types of posts.
 * @param $new_meta_boxes the meta data array
 * @param $post_id the ID of the post
 */
function pexeto_save_meta_data($new_meta_boxes, $post_id){
	foreach($new_meta_boxes as $meta_box) {

		if($meta_box['type']!='heading'){
			// Verify
			if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
				return $post_id;
			}

			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ))
				return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
				return $post_id;
			}

			$data = $_POST[$meta_box['name'].'_value'];



			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
			elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));

		}
	}
}
