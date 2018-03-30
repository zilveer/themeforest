<?php

/* ------------------------------------------------------------------------*
 * CALL THE FUNCTIONS FOR CREATING CUSTOM FIELDS
 * ------------------------------------------------------------------------*/

add_action('admin_menu', 'create_meta_box');
add_action('admin_menu', 'create_meta_post_box');
add_action('save_post', 'save_postdata');
add_action('save_post', 'save_post_postdata');

$post_sidebar_ids[0]='default';
$post_sidebar_names[0]='Default';
foreach($pexeto_generated_sidebars as $sidebar){
	$post_sidebar_ids[]=$sidebar['id'];
	$post_sidebar_names[]=$sidebar['name'];
}

$portfolio_cats=pexeto_get_taxonomies('portfolio_category');

for($i=0; $i<count($portfolio_cats); $i++){
	$portfolio_cat_ids[$i]=$portfolio_cats[$i]->term_id;
	$portfolio_cat_names[$i]=$portfolio_cats[$i]->name;
}

/* ------------------------------------------------------------------------*
 * ADD NEW META BOXES TO THE PAGES
 * ------------------------------------------------------------------------*/


$new_meta_boxes =
array(

array(
"title" => '<div class="ui-icon ui-icon-wrench"></div>Main Page Settings - available for all page templates',
"type" => "heading"),

array(
"title" => "Slider",
"name" => "slider",
"type" => "select",
"options" => array('Tumbnail Slider', 'Nivo Slider/Fader','Big Thumbnail Slider', 'None'),
"values" => array('thum-slider', 'nivo-slider','big-thum-slider','none'),
"std" => 'none'
),

array(
"title" => "Page Layout",
"name" => "layout",
"type" => "select",
"options" => array('Right Sidebar', 'Left Sidebar','Full Width'),
"values" => array('right', 'left','full'),
"std" => 'right',
"description" => 'Available for Default, Featured Posts and Contact page templates'
),

"image" => array(
"name" => "subtitle",
"std" => "",
"type" => "text",
"title" => "Subtitle",
"description" => "This is the subtitle that will be shown on the page if no slider is enabled"),

array(
"name" => "sidebar",
"title" => "Sidebar",
"type" => "select",
"options" => $post_sidebar_names,
"values" => $post_sidebar_ids,
"std" => 'default',
"description" => 'You can select a sidebar for this page between the default one and another one that
you have created. If you select "Default" for the Default Page Template it will display the "Page Sidebar",
for the Contact Page Template it will display "Contact Sidebar" and for the Featured Page Template it will
display the "Home Sidebar". If you would like to use another sidebar, rather than the default one, you can
create a new sidebar in "Anthology Options->Sidebars" section and after that you will be able to select the
sidebar here.'),

array(
"title" => '<div class="ui-icon ui-icon-image"></div>Poprtfolio Settings - available only for Portfolio page templates',
"type" => "heading"),

array(
"name" => "postCategory",
"title" => "Display items from categories",
"type" => "select",
"none" => true,
"options" => $portfolio_cat_names,
"values" => $portfolio_cat_ids,
"std" => '-1',
"description" => 'If "All Categories" selected, all the Portfolio items will be displayed. If another category is selected, only the Portfolio items that belong
to this category or this category\'s subcategories will be displayed.'),

array(
"name" => "column_number",
"title" => "Number of columns",
"type" => "select",
"options" => array('Two Columns ','Three Columns','Four Columns'),
"values" => array('2', '3', '4'),
"std" => '3',
"description" => 'Available for the Gallery template'),

array(
"name" => "order",
"title" => "Portfolio item order",
"type" => "select",
"options" => array('By Date','By Custom Order'),
"values" => array('date','custom'),
"std" => 'date',
"description" => 'If you select "By Date" the last created item will be displayed first. If you select by "By Custom Order"
you will have to set the order field of each of the items.'),


array(
"name" => "categories",
"title" => "Show portfolio categories",
"type" => "select",
"options" => array('Show ','Hide '),
"values" => array('show', 'hide'),
"std" => 'show',
"description" => 'If "Show" selected, a category filter will be displayed above the portfolio items (only for the Gallery template)'),


array(
"name" => "showdesc",
"title" => "Show item descriptions",
"type" => "select",
"options" => array('Hide ','Show '),
"values" => array('false','true'),
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
"title" => "Turn on/off automatic thumbnail generation",
"name" => "_auto_portfolio_thumbnail",
"type" => "select",
"options" => array("ON ", "OFF "),
"values" => array("on", "off"),
"description" => "If you turn off this functionality you will be able to add your own thumbnail images
to your portfolio items- you can do this by inserting the thumbnail URL in the Thumbnail field of the Portfolio item post."
),

array(
"title" => "Turn on/off title link",
"name" => "_title_link",
"type" => "select",
"options" => array("ON ", "OFF "),
"values" => array("on", "off"),
"description" => "If this functionality is turned on, the titles of your portfolio items will be links and
will link to the section which contains the content of the portfolio item post. (only for the Gallery template)"
),
);


/* ------------------------------------------------------------------------*
 * ADD NEW META BOXES TO THE PORTFOLIO POSTS
 * ------------------------------------------------------------------------*/



	$new_meta_post_boxes =
	array(
	
	array(
"title" => "When clicked on the image open:",
"name" => "action",
"type" => "select",
"options" => array("Preview image in lightbox", "The content of the item", "Play Video", "Custom link", "Do Nothing"),
"values" => array("lightbox", "permalink", "video", "custom", "nothing"),
"std" => "lightbox",
"description" => "Select the action to be performed after clicking on a portfolio item. (only for the Gallery template)"
),

	array(
	"title" => "Thumbnail URL",
	"name" => "thumbnail",
	"std" => "",
	"type" => "upload",
	"description" => "The URL for the smaller thumbnail image- <b>only if automatic thumbnail generation is set to OFF</b> in the containing
	portfolio page."
	),

	array(
"title" => "Preview Image URL",
"name" => "preview",
"std" => "",
"type" => "upload",
"description" => 'If "Preview image in lightbox" you can insert the URL of the preview image'
),

array(
"title" => "Custom Link/Video URL",
"name" => "custom",
"std" => "",
"type" => "text",
"description" => 'If "Preview image in lightbox" selected above, you can insert a video URL here. If "Custom link" selected above, 
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

);


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
		case 'textarea':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<textarea name="'.$meta_box['name'].'_value" class="option-textarea" />'.$meta_box_value.'</textarea><br />';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
		case 'upload':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" id="pexeto-'.$meta_box['name'].'" class="option-input image-input"/>';

			echo '<div id="pexeto-'.$meta_box['name'].'_button" class="button" >Upload Image</div><br/>';
		
			//call the script for this upload button particularly
			echo '<script type="text/javascript">jQuery(document).ready(function($){
				pexetoOptions.loadUploader(jQuery("div#pexeto-'.$meta_box['name'].'_button"), "'.PEXETO_FUNCTIONS_URL.'upload-handler.php", "'.PEXETO_UPLOADS_URL.'");
			});</script>'; 
			
			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
		break;
		case 'select':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';
			echo '<select name="'.$meta_box['name'].'_value">';

			if($meta_box['none']){
				?>
<option value="-1">All Categories</option>
				<?php
			}
			$counter=0;
			foreach ($meta_box['options'] as $option) { ?>
<option
<?php if ( $meta_box_value == $meta_box['values'][$counter]) {
	echo ' selected="selected"';
}
?>
	value="<?php echo($meta_box['values'][$counter]);?>"><?php echo $option; ?></option>
<?php
$counter++;
			}
			echo '</select>';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
	}
}


/**
 * Creates page a meta box.
 */
function create_meta_box() {
	global $theme_name;
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-boxes', '<div class="icon-small"></div> ANTHOLOGY PAGE SETTINGS', 'new_meta_boxes', 'page', 'normal', 'high' );
	}
}

/**
 * Creates a post meta box.
 */
function create_meta_post_box() {
	global $theme_name;
	$portf=post_type_exists('Portfolio')?'Portfolio':'portfolio';
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-post-boxes', '<div class="icon-small"></div> ANTHOLOGY PORTFOLIO ITEM SETTINGS', 'new_meta_post_boxes', 'portfolio', 'normal', 'high' );
	}
}

/**
 * Saves the meta box content of a page
 * @param $post_id the ID of the page that contains the meta box
 */
function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;

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

/**
 * Saves the meta box content of a post
 * @param $post_id the ID of the post that contains the meta box
 */
function save_post_postdata( $post_id ) {
	global $post, $new_meta_post_boxes;

	foreach($new_meta_post_boxes as $meta_box) {
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
