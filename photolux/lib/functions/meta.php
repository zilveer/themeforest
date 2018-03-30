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
add_action('init', 'pexeto_load_meta_boxes');
add_action('admin_menu', 'create_meta_box');  
add_action('admin_menu', 'create_meta_portfolio_box');  
add_action('save_post', 'save_postdata');  
add_action('save_post', 'save_portfolio_postdata'); 


function pexeto_load_meta_boxes(){
	//load the porftfolio categeories
	$portf_taxonomies=get_terms('portfolio_category', array('hierarchical'=>true, 'hide_empty'=>0));
	$portf_categories=array(array('id'=>'-1', 'name'=>'All Portfolio Categories'));

	foreach($portf_taxonomies as $taxonomy){
		$portf_categories[]=array("name"=>$taxonomy->name, "id"=>$taxonomy->term_id);
	}
	$loader_portf_categories=array_merge(array(array('id'=>'hide','name'=>'Hide'), (array('id'=>'disabled','name'=>'Show:'))), $portf_categories);

	//load the post categeories
	$categories=get_categories('hide_empty=0');
	$pexeto_categories=array(array('id'=>'-1', 'name'=>'All Categories'));
	for($i=0; $i<sizeof($categories); $i++){
		$pexeto_categories[]=array('id'=>$categories[$i]->cat_ID, 'name'=>$categories[$i]->cat_name);
	}
	
	global $pexeto_data, $new_meta_boxes, $new_meta_portfolio_boxes, $new_meta_post_boxes;
	
	$sliders=pexeto_get_created_sliders();

	/* ------------------------------------------------------------------------*
	 * META BOXES FOR THE PAGES
	 * ------------------------------------------------------------------------*/

	//the meta data for pages
	$new_meta_boxes =
	array(

	array(
		"title" => '<div class="ui-icon ui-icon-wrench"></div>General Page Settings',
		"type" => "heading"),

	array(
		"title" => "Header",
		"name" => "slider",
		"type" => "select",
		"options" => $sliders,
		"std" => 'none'
		),

		array(
		"title" => "Page Layout",
		"name" => "layout",
		"type" => "imageradio",
		"options" => array(array("img"=>PEXETO_IMAGES_URL.'layout-right-sidebar.png', "id"=>"right", "title"=>"Right Sidebar Layout"),
		array("img"=>PEXETO_IMAGES_URL.'layout-left-sidebar.png', "id"=>"left", "title"=>"Left Sidebar Layout"),
		array("img"=>PEXETO_IMAGES_URL.'layout-full-width.png', "id"=>"full", "title"=>"Full Width Layout")),
		"std" => 'right',
		"description" => 'Available for Default, Featured Posts and Contact page templates'
		),

		array(
		"name" => "sidebar",
		"title" => "Sidebar",
		"type" => "select",
		"options" => $pexeto_data->pexeto_sidebars,
		"description" => 'You can select a sidebar for this page between the default one and another one that
		you have created. If you would like to use another sidebar, rather than the default one, you can
		create a new sidebar in "'.PEXETO_THEMENAME.' Options->Sidebars" section and after that you will be able to select the
		sidebar here.'),
		
		array(
		"name" => "show_title",
		"title" => "Display Page Title",
		"type" => "select",
		"options" => array(array("name"=>"Use Global Settings", "id"=>"global"),
		array("name"=>"Display", "id"=>"on"),
		array("name"=>"Hide", "id"=>"off")),
		"std" => 'global',
		"description" => 'Whether to display the page title or not - if "Use Global Settings" selected, the global setting selected in the
		'.PEXETO_THEMENAME.' Options &raquo; General &raquo; "Display page title on pages" field will be used.'),
		
		array(
		"title" => "Custom full width background image",
		"name" => "full_bg",
		"std" => "",
		"type" => "upload",
		"description" => 'You can globally set a full width background image in the '.PEXETO_THEMENAME.' Options &raquo; Style Settings  &raquo; 
		General section. In this field you can set a custom background image that will be displayed for this page only.'
		),
		
		array(
		"title" => '<div class="ui-icon ui-icon-wrench"></div>Featured Page Template Settings',
		"type" => "heading"),
		
			array(
		"name" => "featured_category",
		"title" => "Display blog posts from category",
		"type" => "select",
		"none" => true,
		"options" => $pexeto_categories,
		"std" => '-1'
			),
			
			array(
		"title" => "Number of posts to display",
		"name" => "featured_post_number",
		"std" => "5",
		"type" => "text"
		),
		
		array(
		"title" => '<div class="ui-icon ui-icon-image"></div>Portfolio Settings - available only for Portfolio/Gallery page templates',
		"type" => "heading"),

		array(
		"name" => "post_category",
		"title" => "Display portfolio items from categories",
		"type" => "select",
		"none" => true,
		"options" => $portf_categories,
		"std" => '-1',
		"description" => 'If "All Categories" selected, all the Portfolio items will be displayed. If another category is selected, only the Portfolio items that belong
		to this category or this category\'s subcategories will be displayed. By selecting different categories, you can create multiple portfolio/gallery
		pages with different items displayed.'),

		array(
		"name" => "order",
		"title" => "Portfolio item order",
		"type" => "select",
		"options" => array(array("name"=>"By Date", "id"=>"date"),
		array("name"=>"By Custom Order", "id"=>"custom")),
		"std" => 'date',
		"description" => 'If you select "By Date" the last created item will be displayed first. If you select by "By Custom Order"
		you will have to set the order field of each of the items - the items with the smaller order number will be displayed first.'),


		array(
		"name" => "show_filter",
		"title" => "Show portfolio category filter",
		"type" => "select",
		"options" => array(array("name"=>"Show", "id"=>"true"),
		array("name"=>"Hide", "id"=>"false")),
		"std" => 'true',
		"description" => 'If "Show" selected, a category filter will be displayed above the portfolio items'),

		array(
		"name" => "show_info",
		"title" => "Show item info",
		"type" => "select",
		"options" => array( array("name"=>"Hide", "id"=>"false"),
		array("name"=>"Show", "id"=>"true")),
		"std" => 'true',
		"description" => 'If "Show" selected, the portfolio item title and category will be displayed below the image (only for the Grid Gallery template)'
		),


		array(
		"title" => "Number of portfolio items to show per load/page",
		"name" => "post_number",
		"std" => "10",
		"type" => "text"
		),
		
		array(
		"name" => "image_width",
		"title" => "Image width",
		"type" => "text",
		"std" => '290',
		"description" => 'The image width in the grid gallery. The image width is always static and the height is determined by the image ratio (only for the Grid Gallery template)'
		),
		
		array(
		"name" => "desaturate",
		"title" => "Black/white image effect",
		"type" => "select",
		"options" => array( array("name"=>"OFF", "id"=>"false"),array("name"=>"ON", "id"=>"true")),
		"std" => 'false',
		"description" => 'If this option is enabled, the images will be automatically converted to black/white (desaturated) and they will be colored on hover (only for the Grid Gallery template).'
		),
		
		array(
		"name" => "show_back_btn_end",
		"title" => 'Show a "Back to gallery" button in the end of the image slider',
		"type" => "select",
		"options" => array( array("name"=>"Hide", "id"=>"false"),
		array("name"=>"Show", "id"=>"true")),
		"std" => 'false',
		"description" => 'If "Show" selected, a "Back to gallery" button will be appended to the last image of the image slider (only for the Grid Gallery template)'
		),

		array(
		"name" => "partial_loading",
		"title" => 'Partial image loading in horizontal slider',
		"type" => "select",
		"options" => array( array("name"=>"Disabled", "id"=>"false"),
		array("name"=>"Enabled", "id"=>"true")),
		"std" => 'false',
		"description" => 'If "Enabled" selected, the slider will not wait for all the images to be loaded in order to get displayed. Before the slider is displayed it will load the amount of images you set in the "Number of images to load before displaying the slider" field below and after that the rest of the images will be displayed dynamically - as soon as the image gets loaded it will be displayed on the slider  (only for the Grid Gallery template)'
		),

		array(
		"name" => "img_num_before_load",
		"title" => "Number of images to load before displaying the slider",
		"type" => "text",
		"std" => '3',
		"description" => 'If partial image loaing is enabled above, this would be the number of images to load before displaying the horizontal slider. (only for the Grid Gallery template)'
		)
		
		);



		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE PORTFOLIO POSTS
		 * ------------------------------------------------------------------------*/

		$new_meta_portfolio_boxes =
		array(

		array(
		"title" => "Preview Image URL",
		"name" => "preview",
		"std" => "",
		"type" => "upload",
		"description" => 'Main preview image. If the "Custom Thumbnail URL" field below is empty, the thumbnail image
		will be automatically generated by the image set in this field.'
		),

		array(
		"title" => "Custom Thumbnail URL (optional)",
		"name" => "thumbnail",
		"std" => "",
		"type" => "upload",
		"description" => 'By default the theme will generate automatically the thumbnail image for the item from
		the bigger perview image, set in the "Preview Image URL" field below. However, if you prefer to manually set
		this thumbnail image, you have to set its URL in this field.'
		),
		
		array(
		"title" => '<div class="ui-icon ui-icon-image"></div>Grid Gallery items settings only',
		"type" => "heading"),
		
		array(
		"title" => "When clicked on the image open:",
		"name" => "action",
		"type" => "select",
		"options" => array(array("name"=>"Preview image in lightbox", "id"=>"lightbox"),
		array("name"=>"The content of the item as slider", "id"=>"permalink"),
		array("name"=>"The content of the item on new page", "id"=>"permalink_new"),
		array("name"=>"Play Video", "id"=>"video"),
		array("name"=>"Custom link", "id"=>"custom"),
		array("name"=>"Do Nothing", "id"=>"nothing")),
		"std" => "lightbox",
		"description" => "Select the action to be performed after clicking on the portfolio item."
		),
		
		array(
		"title" => "Custom Link/Video URL",
		"name" => "custom",
		"std" => "",
		"type" => "text",
		"description" => 'If "Play Video" selected above, you can insert a video URL here. If "Custom link" selected above, 
		you can insert the custom URL'
		),
		
		array(
		"title" => "Item Description",
		"name" => "description",
		"std" => "",
		"type" => "textarea",
		"description" => 'If "Preview image in lightbox" or "Play Video" has been selected in the clicking
		action field above, you can insert a description in this field that will be displayed below the image/video in lightbox.'
		),
		
		array(
		"name" => "show_content",
		"title" => "Show portfolio content on slider preview section",
		"type" => "select",
		"options" => array(array("name"=>"Show", "id"=>"show"),
		array("name"=>"Hide", "id"=>"hide")),
		"std" => 'show',
		"description" => 'If "Show" selected, a section containing the portfolio title, category, content and a "Back to gallery" button will be
		prepended to the image slider when the preview is opened in the Grid Gallery template.'),
		
			array(
		"title" => '<div class="ui-icon ui-icon-image"></div>Showcase and single page items settings',
		"type" => "heading"),
		
		array(
		"title" => "Crop image from",
		"name" => "crop",
		"type" => "imageradio",
		"options" => array(array("img"=>PEXETO_IMAGES_URL.'crop-c.png', "id"=>"c", "title"=>"Center"),
		array("img"=>PEXETO_IMAGES_URL.'crop-t.png', "id"=>"t", "title"=>"Top"),
		array("img"=>PEXETO_IMAGES_URL.'crop-b.png', "id"=>"b", "title"=>"Bottom"),
		array("img"=>PEXETO_IMAGES_URL.'crop-l.png', "id"=>"l", "title"=>"Left"),
		array("img"=>PEXETO_IMAGES_URL.'crop-r.png', "id"=>"r", "title"=>"Right")
		),
		"std" => "c",
		"description" => 'This option is available when the thumbnail will be automatically generated from the preview image (when the "Thumbnail URL" field above is empty)- you can see above how the cropping settings will affect both portrait and landscape oriented images.
		(available for Showcase page template only)'
		),

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
	$meta_box_value = "";
	if(isset($meta_box['name'])){
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
	}
	if($meta_box_value == "" && isset($meta_box['std'])){
		$meta_box_value = $meta_box['std'];
	}

	if($meta_box['type']!='heading'){
		$box_class = isset($meta_box['class'])?' '.$meta_box['class']:'';
		echo '<div class="option-container'.$box_class.'">';
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';
	}


	switch($meta_box['type']){
		case 'heading':
			echo'<div class="option-heading">
<h4>'.$meta_box['title'].'</h4></div>';
			break;
		case 'text':
			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" class="option-input"/><br />';
			break;
		case 'upload':
			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" id="pexeto-'.$meta_box['name'].'" class="option-input upload pexeto-upload"/>';

			echo '<input type="button" id="pexeto-'.$meta_box['name'].'_button" class="button-primary pexeto-upload-btn" value="Select Image" />';
			break;
		case 'textarea':
			echo'<textarea name="'.$meta_box['name'].'_value" class="option-textarea" />'.$meta_box_value.'</textarea><br />';
			break;
		case 'imageradio':
			if(sizeof($meta_box['options'])>0){
				foreach ($meta_box['options'] as $option) { 
					$checked= $meta_box_value == $option['id']?'checked="checked"':'';
					echo '<div class="imageradio"><input type="radio" name="'.$meta_box['name'].'_value" value="'.$option['id'].'" '.$checked.'/><img src="'.$option['img'].'" title="'.$option['title'].'"/></div>';
				}
			}
			break;
		case 'select':
			echo '<select name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">';

				
			if(sizeof($meta_box['options'])>0){
				foreach ($meta_box['options'] as $option) { ?>
				<option
				<?php if ( $meta_box_value == $option['id']) {
					echo ' selected="selected"';
				}
				if ($option['id']=='disabled') {
					echo ' disabled="disabled"';
				}

				if (isset($option['class'])) {
					echo ' class="'.$option['class'].'"';
				}
				?>
					value="<?php echo($option['id']);?>"><?php echo $option['name']; ?></option>
				<?php

				}
			}
			echo '</select>';
			break;
	}

	if($meta_box['type']!='heading'){
		echo'<span class="option-description">';
		if(isset($meta_box['description'])){
			echo $meta_box['description'];
		}
		echo '</span></div>';
		if(strstr($box_class,'last')){
			echo '<div class="clear"></div>';
		}
	}
}


/**
 * Saves the meta box content of a page
 * @param $post_id the ID of the page that contains the meta box
 */
function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;

	if(isset($post) && $post->post_type=='page'){
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

	if(isset($post) && $post->post_type==PEXETO_PORTFOLIO_POST_TYPE){
		pexeto_save_meta_data($new_meta_portfolio_boxes, $post_id);
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


/* ------------------------------------------------------------------------*
 * HELPER META FUNCTIONS
 * ------------------------------------------------------------------------*/

/**
 * Returns the default value of a meta box.
 * @param $meta_array the array of meta boxes to search within
 * @param $name the name (ID) of the meta box
 */
function pexeto_get_meta_std_value($meta_array, $name){
	foreach($meta_array as $meta_item){
		if(isset($meta_item["name"]) && $meta_item["name"]==$name){
			return $meta_item["std"];
		}
	}
	return '';
}

/**
 * Returns the saved meta data for a page of each of the given keys.
 * @param int $page_id the ID of the page to retrieve the meta data
 * @param array $keys an array containing all the keys whose values will be retrieved
 */
function pexeto_get_post_meta($page_id, $keys){
	global $new_meta_boxes;
	
	$res=array();
	foreach($keys as $key){
		$meta=get_post_meta($page_id, $key.'_value', true);
		if($meta!=''){
			$res[$key]=$meta;
		}else{
			//if the value is not saved, get the default value from the array
			$res[$key]=pexeto_get_meta_std_value($new_meta_boxes, $key);
		}
	}
	return $res;
}

