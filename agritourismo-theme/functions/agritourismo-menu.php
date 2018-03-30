<?php

$prefix = THEME_NAME.'_';
$image = '<img src="'.THEME_IMAGE_CPANEL_URL.'logo-orangethemes-1.png" width="11" height="15" /> ';
$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
$aboutAuthor = get_option ( THEME_NAME."_about_author" ); 
$imageSize = get_option ( THEME_NAME."_image_size" );
$showSingleThumb = get_option ( THEME_NAME."_show_single_thumb" ); 
$similarPosts = get_option ( THEME_NAME."_similar_posts" ); 
$similarPostsGallery = get_option ( THEME_NAME."_similar_posts_gallery" ); 
$breakingSlider = get_option ( THEME_NAME."_breacking_news" ); 
$homeID = get_home_page();
$shopID = get_shop_page();
$contactID = get_contact_page();
$contactID2 = get_contact_page2();
$galleryID = get_gallery_page();
$fullID = get_fullwidth_page();
$archiveID = get_archive_page();
$eventsID = get_events_page();
$menuID = get_menu_page();
$mapID = get_map_page();
$shareAll = get_option ( THEME_NAME."_share_all" ); 


if(isset($_GET['post'])) {
	$currentID = $_GET['post'];
} else {
	$currentID = 0;
}

global $box_array;

$box_array = array();

if(!in_array($currentID, $homeID)) {
	//page settings
	$box_array[] = array( 'id' => 'subtitle', 'title' => ''.$image.' Subtitle', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Subtitle', 'std' => '', 'id' => $prefix. 'subtitle', 'type'=> 'text' ) ), 'size' => 10,'first' => 'yes'  );
}

//Events page
$box_array[] = array( 'id' => 'datepicker', 'title' => ''.$image.' '.__("Events Date", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Date:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'datepicker', 'type'=> 'datepicker' ) ), 'size' => 10,'first' => 'yes'  );
$box_array[] = array( 'id' => 'show-countdown', 'title' => ''.$image.' '.__("Show Countdown", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Countdown:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'countdown', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no' );
$box_array[] = array( 'id' => 'events-ticker', 'title' => ''.$image.' '.__("Buy Tickets Url", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Url:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'ticket', 'type'=> 'text' ) ), 'size' => 10, 'first' => 'no' );
$box_array[] = array( 'id' => 'events-button-text', 'title' => ''.$image.' '.__("Custom Button Text (The button bellow \"Buy Ticket\" button)", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Text:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'button_text', 'type'=> 'text' ) ), 'size' => 10, 'first' => 'no' );
$box_array[] = array( 'id' => 'events-button-url', 'title' => ''.$image.' '.__("Custom Button Url (The button bellow \"Buy Ticket\" button)", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Url:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'button_url', 'type'=> 'text' ) ), 'size' => 10, 'first' => 'no' );
$box_array[] = array( 'id' => 'events-venue', 'title' => ''.$image.' '.__("Events Venue", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Venue:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'venue', 'type'=> 'textarea' ) ), 'size' => 10, 'first' => 'no' );
$box_array[] = array( 'id' => 'events-map', 'title' => ''.$image.' '.__("Events Map", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Position:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'map', 'type'=> 'google_map' ) ), 'size' => 10, 'first' => 'no' );
$box_array[] = array( 'id' => 'events-more-details', 'title' => ''.$image.' '.__("More Details", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Details:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'details', 'type'=> 'textarea' ) ), 'size' => 10, 'first' => 'no' );
if($shareAll=="custom") {
	$box_array[] = array( 'id' => 'show-share', 'title' => ''.$image.' '.__("Show Share Buttons", THEME_NAME).'', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => ''.__("Show Share Buttons:", THEME_NAME).'', 'std' => '', 'id' => $prefix. 'share_single', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no' );
}

if($sidebarPosition=="custom") {
	$box_array[] = array( 'id' => 'sidebar-position-page', 'title' => ''.$image.' Sidebar Position', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Sidebar position:', 'std' => '', 'id' => $prefix. 'sidebar_position', 'type'=> 'sidebar_position_box' ) ), 'size' => 10, 'first' => 'no' );
}
$box_array[] = array( 'id' => 'sidebar-select-post', 'title' => ''.$image.' Main Sidebar', 'page' => 'events-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Sidebar name:', 'std' => '', 'id' => $prefix. 'sidebar_select', 'type'=> 'sidebar_select_box' ) ), 'size' => 10, 'first' => 'no' );

$box_array[] = array( 'id' => 'show-image-post', 'title' => ''.$image.' Show Image In Single Post / News Page', 'page' => 'reviews-item', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Image:', 'std' => '', 'id' => $prefix. 'single_image', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no' );


//share buttons
if($shareAll=="custom") {
	$box_array[] = array( 'id' => 'share-post', 'title' => ''.$image.' Show Share Buttons', 'page' => 'post', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Show Share Buttons:', 'std' => 'hide', 'id' => $prefix. 'share_single', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no' );
	if(!in_array($currentID, $contactID) && $currentID!=get_option('page_for_posts') && !in_array($currentID, $eventsID) && $currentID!=$galleryID && !in_array($currentID, $homeID) && !in_array($currentID, $menuID) && $currentID!=$fullID || isset($_POST['post_type']) || $currentID==0) {
		$box_array[] = array( 'id' => 'share-post', 'title' => ''.$image.' Show Share Buttons', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Show Share Buttons:', 'std' => 'hide', 'id' => $prefix. 'share_single', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no' );
	}
}

if(in_array($currentID, $eventsID) || isset($_POST['post_type'])) {
	$box_array[] = array( 'id' => 'events-age', 'title' => ''.$image.__("How long show held events?", THEME_NAME), 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Days:', 'std' => '+1 day', 'id' => $prefix. 'post_age', 'type'=> 'days' ) ), 'size' => 10, 'first' => 'no' );
}
//page title
if(!in_array($currentID, $homeID)) {
	$box_array[] = array( 
		'id' => 'page-title', 
		'title' => ''.$image.' Show Page Title', 
		'page' => 'page', 
		'context' => 'normal', 
		'priority' => 'high', 
		'fields' => array(
			array(
				'name' => 'Show:', 
				'std' => '', 
				'id' => $prefix. 'title_show', 
				'type'=> 'yes_no' 
				) 
			), 
		'size' => 10, 
		'first' => 'no' 
	);

}


// contact settings
if(in_array($currentID, $contactID) || isset($_POST['post_type'])) {
	$box_array[] = array( 'id' => 'contact-email', 'title' => ''.$image.' Contactform E-mail', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("E-mail", THEME_NAME), 'std' => '', 'id' => $prefix. 'contact_mail', 'type'=> 'text' ) ), 'size' => 10,'first' => 'yes'  );
	$box_array[] = array( 'id' => 'contact-address-title-1', 'title' => ''.$image.__("Contact Box Title 1", THEME_NAME), 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("Title", THEME_NAME), 'std' => '', 'id' => $prefix. 'title_1', 'type'=> 'text' ) ), 'size' => 10,'first' => 'no'  );
	$box_array[] = array( 'id' => 'contact-address-details-1', 'title' => ''.$image.__("Contact Box Details 1", THEME_NAME), 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("Details", THEME_NAME), 'std' => '', 'id' => $prefix. 'details_1', 'type'=> 'textarea' ) ), 'size' => 10,'first' => 'no'  );
	$box_array[] = array( 'id' => 'contact-address-title-2', 'title' => ''.$image.__("Contact Box Title 2", THEME_NAME), 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("Title", THEME_NAME), 'std' => '', 'id' => $prefix. 'title_2', 'type'=> 'text' ) ), 'size' => 10,'first' => 'no'  );
	$box_array[] = array( 'id' => 'contact-address-details-2', 'title' => ''.$image.__("Contact Box Details 2", THEME_NAME), 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("Details", THEME_NAME), 'std' => '', 'id' => $prefix. 'details_2', 'type'=> 'textarea' ) ), 'size' => 10,'first' => 'no'  );
	$box_array[] = array( 'id' => 'contact-address-title-3', 'title' => ''.$image.__("Contact Box Title 3", THEME_NAME), 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("Title", THEME_NAME), 'std' => '', 'id' => $prefix. 'title_3', 'type'=> 'text' ) ), 'size' => 10,'first' => 'no'  );
	$box_array[] = array( 'id' => 'contact-address-details-3', 'title' => ''.$image.__("Contact Box Details 3", THEME_NAME), 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("Details", THEME_NAME), 'std' => '', 'id' => $prefix. 'details_3', 'type'=> 'textarea' ) ), 'size' => 10,'first' => 'no'  );
	$box_array[] = array( 'id' => 'contact-map', 'title' => ''.$image.' Map', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => '', 'std' => '', 'id' => $prefix. 'map', 'type'=> 'contacts_map' ) ), 'size' => 10,'first' => 'yes'  );


}

if(in_array($currentID, $contactID2) || isset($_POST['post_type'])) { 
	$box_array[] = array( 'id' => 'contact-email', 'title' => ''.$image.' Contactform E-mail', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'E-mail', 'std' => '', 'id' => $prefix. 'contact_mail', 'type'=> 'text' ) ), 'size' => 10,'first' => 'yes'  );
	$box_array[] = array( 'id' => 'contact-map-box', 'title' => ''.$image.' Google Map Url', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Map Url', 'std' => '', 'id' => $prefix. 'map', 'type'=> 'text' ) ), 'size' => 10,'first' => 'yes'  );
}

//gallery

$box_array[] = array( 'id' => 'gallery-type-box', 'title' => ''.$image.' Gallery Style', 'page' => 'gallery', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Gallery Style:', 'std' => '', 'id' => $prefix. 'gallery_style', 'type'=> 'gallery_style' ) ), 'size' => 10, 'first' => 'yes'  );
if($similarPostsGallery=="custom") {
	$box_array[] = array( 'id' => 'gallery-smilar-posts', 'title' => ''.$image.' Similar Posts', 'page' => 'gallery', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Show:', 'std' => '', 'id' => $prefix. 'similar_posts', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no'  );	
}

//sidebar settings
$box_array[] = array( 'id' => 'sidebar-select-post', 'title' => ''.$image.' Main Sidebar', 'page' => 'post', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Sidebar name:', 'std' => '', 'id' => $prefix. 'sidebar_select', 'type'=> 'sidebar_select_box' ) ), 'size' => 10, 'first' => 'no' );
if($sidebarPosition=="custom") {
	$box_array[] = array( 'id' => 'sidebar-position-page', 'title' => ''.$image.' Sidebar Position', 'page' => 'post', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Sidebar position:', 'std' => '', 'id' => $prefix. 'sidebar_position', 'type'=> 'sidebar_position_box' ) ), 'size' => 10, 'first' => 'no' );	
}
$box_array[] = array( 'id' => 'sidebar-select-post', 'title' => ''.$image.' Main Sidebar', 'page' => 'product', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Sidebar name:', 'std' => '', 'id' => $prefix. 'sidebar_select', 'type'=> 'sidebar_select_box' ) ), 'size' => 10, 'first' => 'no' );
if($sidebarPosition=="custom") {
	$box_array[] = array( 'id' => 'sidebar-position-page', 'title' => ''.$image.' Sidebar Position', 'page' => 'product', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Sidebar position:', 'std' => '', 'id' => $prefix. 'sidebar_position', 'type'=> 'sidebar_position_box' ) ), 'size' => 10, 'first' => 'no' );	
}

//sidebar settings
if(!in_array($currentID, $contactID) && $currentID!=$galleryID && !in_array($currentID, $menuID) && !in_array($currentID, $fullID) && !in_array($currentID, $archiveID) && !in_array($currentID, $mapID) && !in_array($currentID, $homeID) ) {
	$box_array[] = array( 'id' => 'sidebar-select-box', 'title' => ''.$image.' Main Sidebar', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Sidebar name:', 'std' => '', 'id' => $prefix. 'sidebar_select', 'type'=> 'sidebar_select_box' ) ), 'size' => 10, 'first' => 'yes'  );

	if(!in_array($currentID, $homeID) && $sidebarPosition=="custom") {
		$box_array[] = array( 'id' => 'sidebar-position-page', 'title' => ''.$image.' Sidebar Position', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Sidebar position:', 'std' => '', 'id' => $prefix. 'sidebar_position', 'type'=> 'sidebar_position_box' ) ), 'size' => 10, 'first' => 'no' );
	}
}

//about author
if($aboutAuthor=="custom" && !in_array($currentID, $homeID) && !in_array($currentID, $contactID) && !in_array($currentID, $mapID) && $currentID!=$galleryID && !in_array($currentID, $fullID) && !in_array($currentID, $contactID2) && !in_array($currentID, $archiveID) || $currentID==0) {
	$box_array[] = array( 'id' => 'about-author-post', 'title' => ''.$image.' About Author', 'page' => 'post', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'About Author:', 'std' => '', 'id' => $prefix. 'about_author', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no' );
}

if($showSingleThumb=="on" && $currentID!=get_option('page_for_posts') && !in_array($currentID, $homeID) && !in_array($currentID, $mapID) && !in_array($currentID, $contactID) && !in_array($currentID, $eventsID) && !in_array($currentID, $menuID) && $currentID!=$galleryID && !in_array($currentID, $fullID) || isset($_POST['post_type']) || $currentID==0) {
	$box_array[] = array( 'id' => 'show-image-post', 'title' => ''.$image.' Show Image In Single Post / News Page', 'page' => 'post', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Image:', 'std' => '', 'id' => $prefix. 'single_image', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no' );
	$box_array[] = array( 'id' => 'show-image-page', 'title' => ''.$image.' Show Image In Single Page / News Page', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Image:', 'std' => '', 'id' => $prefix. 'single_image', 'type'=> 'show_hide' ) ), 'size' => 10, 'first' => 'no' );
}


//events template
if(in_array($currentID, $eventsID) || isset($_POST['post_type'])) {
	$box_array[] = array( 'id' => 'post-count', 'title' => ''.$image.__("Post Count", THEME_NAME), 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("Count", THEME_NAME), 'std' => '8', 'id' => $prefix. 'events_items', 'type'=> 'text' ) ), 'size' => 10, 'first' => 'no' );
}

//products page
$box_array[] = array( 'id' => 'menu-card', 'title' => ''.$image.__("Show In Menu Card", THEME_NAME), 'page' => 'product', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => __("Show", THEME_NAME), 'std' => '', 'id' => $prefix. 'menu', 'type'=> 'no_yes' ) ), 'size' => 10, 'first' => 'yes' );

//homepage 
if(in_array($currentID, $homeID) || isset($_POST['post_type'])) {
	$box_array[] = array( 'id' => 'layer-slider-settings', 'title' => ''.$image.' Show Layer Slider', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Show', 'std' => '', 'id' => $prefix. 'layer_slider_settings', 'type'=> 'no_yes' ) ), 'size' => 10,'first' => 'no'  );
	$box_array[] = array( 'id' => 'layer-slider', 'title' => ''.$image.' Layer Slider', 'page' => 'page', 'context' => 'normal', 'priority' => 'high', 'fields' => array(array('name' => 'Slider', 'std' => '', 'id' => $prefix. 'layer_slider', 'type'=> 'layer_slider_select' ) ), 'size' => 10,'first' => 'no'  );

	$box_array[] = array( 
		'id' => 'home-drag-drop', 
		'title' => ''.$image.' Homepage Builder', 
		'page' => 'page', 
		'context' => 'normal', 
		'priority' => 'high', 
		'fields' => array(
			array(
				'name' => '', 
				'std' => '', 'id' => $prefix. 'home_drag_drop', 
				'type'=> 'home_drag_drop' 
				) 
			), 
		'size' => 0,
		'first' => 'no'  
	);
}

// Add meta box
function add_sticky_box() {
	global $box_array;
	
	foreach ($box_array as $box) {
		add_meta_box($box['id'], $box['title'], 'sticky_show_box', $box['page'], $box['context'], $box['priority'], array('content'=>$box, 'first'=>$box['first'], 'size'=>$box['size']));
	}

}

function sticky_show_box( $post, $metabox) {
	show_box_funtion($metabox['args']['content'], $metabox['args']['first'], $metabox['args']['size']);
}

// Callback function to show fields in meta box
function show_box_funtion($fields, $first='no', $width='60') {
	global $post;

	if($first=="yes") {
		echo '<input type="hidden" name="sticky_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	}
	echo '<table class="form-table">';

	foreach ($fields['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		//$post_num = htmlentities($_GET['post']);
		echo '<tr>','<th style="width:',$width,'%"><label for="', $field['id'], '">', $field['name'], '</label></th>','<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" ', $meta ? ' ' : '', ' value="', $meta ? remove_html_slashes($meta) : remove_html_slashes($field['std']), '"/> ';
				break;
			case 'datepicker':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" ', $meta ? ' ' : '', ' value="', $meta ? date("m/d/y, H:i",remove_html_slashes($meta)) : remove_html_slashes($field['std']), '"/> ';
				break;
			case 'slider_image_box':
				echo '<input class="upload input-text-1 ot-upload-field" type="text" name="', $field['id'], '" id="', $field['id'], '" value="',  $meta ? remove_html_slashes($meta) :  remove_html_slashes($field['std']), '" style="width: 140px;"/><a href="#" class="ot-upload-button">Button</a>';
				break;
			case 'checkbox':
				echo '<input type="checkbox" value="1" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
			case 'sidebar_select_box':
				$sidebar_names = get_option( THEME_NAME."_sidebar_names" );
				$sidebar_names = explode( "|*|", $sidebar_names );

				echo '	<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
				echo "<option value=\"\">Default</option>";
					foreach ($sidebar_names as $sidebar_name) {
	
						if ( $meta == $sidebar_name ) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $sidebar_name != "" ) {
							echo "<option value=\"".$sidebar_name."\" ".$selected.">".$sidebar_name."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'category_select':
				global $wpdb;
				$data = get_terms( "category", 'parent=0&hide_empty=0' );	
				
				echo '	<select name="', $field['id'], '[]" id="', $field['id'], '" style="min-width:200px; min-height:200px;" multiple>';
					foreach($data as $key => $d) {
						if(is_array($meta) && in_array($d->term_id,$meta)) { $selected=' selected'; } else { $selected=''; }
						echo "<option value=\"".$d->term_id."\" ".$selected.">".$d->name."</option>";
					}

				echo '	</select>';
				break;
			case 'category_select_2':
				global $wpdb;
				$data = get_terms( "category", 'parent=0&hide_empty=0' );	
				
				echo '	<select class="home-cat-select" name="', $field['id'], '[]" id="', $field['id'], '" style="min-width:200px; min-height:200px;" multiple disabled>';
					foreach($data as $key => $d) {
						if(is_array($meta) && in_array($d->term_id,$meta)) { $selected=' selected'; } else { $selected=''; }
						echo "<option value=\"".$d->term_id."\" ".$selected.">".$d->name."</option>";
					}

				echo '	</select>';
				break;
			case 'layer_slider_select':
				// Get WPDB Object
				global $wpdb;

				// Table name
				$table_name = $wpdb->prefix . "layerslider";
				
				// Get sliders
				$sliders = $wpdb->get_results( "SELECT * FROM $table_name
													WHERE flag_hidden = '0' AND flag_deleted = '0'
													ORDER BY id ASC LIMIT 200" );
					
				echo '	<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					if(!empty($sliders)) {
						foreach($sliders as $key => $item) {
							$name = empty($item->name) ? 'Unnamed' : $item->name;
							if($meta == $item->id) { $selected='selected="selected"'; } else { $selected=''; }
							echo '<option value="'.$item->id.'" '.$selected.'>'.$name.'</option>';
						}
					}
					if(empty($sliders)) {
						echo '<option value="">'._e("You didn\'t create a slider yet.", THEME_NAME).'</option>';
					}
				echo '	</select>';
				echo '	<br/><br/>Sliders You can create with LayerSlider WP (included with the theme). By creating homepage slider, choose <strong>fullwidth</strong> skin. And set The slider size <strong>100%x600px.</strong>';
				break;
			case 'sidebar_position_box':
				$positions = array('Right', 'Left');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $position) {
	
						if ( $meta == strtolower($position)) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($position)."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'yes_no':
				$positions = array('Yes', 'No');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $position) {
	
						if ( $meta == strtolower($position)) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($position)."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'no_yes':
				$positions = array('No', 'Yes');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $position) {
	
						if ( $meta == strtolower($position)) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($position)."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'reviews_style':
				$positions = array('1', '2');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $position) {
	
						if ( $meta == strtolower($position)) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($position)."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'color':
				echo '<input class="color" type="text" name="', $field['id'], '" id="', $field['id'], '" ', $meta ? ' ' : '', ' value="', $meta ? remove_html_slashes($meta) : remove_html_slashes($field['std']), '"/> ';
				break;
			case 'comment_select':
				$positions = array('Under The Post', 'New Tab');
				$val = array('under', 'new');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $k => $position) {
	
						if ( $meta == strtolower($val[$k])) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($val[$k])."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'days':
				$positions = array('1 day', '2 days', '3 days', '7 days', '14 days', '21 days');
				$val = array('1', '2', '3', '7', '14', '21');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $k => $position) {
	
						if ( $meta == strtolower($val[$k])) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($val[$k])."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'gallery_style':
				$positions = array('Default', 'LightBox');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $position) {
	
						if ( $meta == strtolower($position)) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($position)."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'show_hide':
				$positions = array('Show', 'Hide');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $position) {
	
						if ( $meta == strtolower($position)) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($position)."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'image_size_box':
				$positions = array('Large', 'Small');

				echo '<select name="', $field['id'], '" id="', $field['id'], '" style="min-width:200px;">';
					foreach ($positions as $position) {
	
						if ( $meta == strtolower($position)) {
							$selected="selected=\"selected\"";
						} else { 
							$selected="";
						}
						
						if ( $position != "" ) {
							echo "<option value=\"".strtolower($position)."\" ".$selected.">".$position."</option>";
						}
					}
				echo '	</select>';
				break;
			case 'contacts_map':
				echo '
				    <div id="map-canvas" class="ot-contact-map"></div>

				    <p>'.__("Left click on the map to add markers. Right click on the marker to remove it!", THEME_NAME).'</p>
				    <input type="hidden" class="ot-coordinates" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? remove_html_slashes($meta) : remove_html_slashes($field['std']), '"/>
					<script type="text/javascript">
						jQuery(document).ready(function() {

						var id;
						var markers = {};
						var markerArray = [];


						    function initialize() {

						        google.maps.event.addListener(map, \'click\', function(event) {
						            if(markerArray.length<3) {
						                addMarker(event.latLng);
						            } else {
						                alert("You already have marked 3 positions!");
						            }
						            
						        });

						    }

						    var delMarker = function (id) {
						        marker = markers[id]; 
						        marker.setMap(null);
						    }

						    // Add a marker to the map and push to the array.

						    function addMarker(location) {
						        
						        marker = new google.maps.Marker({ 
						            position: location,
						            map: map,
						            draggable: true,
						            animation: google.maps.Animation.DROP,
						            icon: scripts.imageUrl+\'default-icon.png\'
						        });
						        id = marker.__gm_id
						        markers[id] = marker; 
						        markerArray.push({"lb": markers[id].getPosition().lat(), "mb":markers[id].getPosition().lng()}); 


						        google.maps.event.addListener(marker, "rightclick", function (event) {
						            var newMarkerArray = [];
						            id = this.__gm_id; 
						            delMarker(id);
						            delete markers[id];
						            arr = jQuery.makeArray(markers);
						            arr = arr[0];
						            i = 0;

						            jQuery.each(arr, function( index, value ) {
						                lat = value.position.lat();
						                lng = value.position.lng();
						                newMarkerArray[i] = {"lb": lat, "mb":lng};
						                i++;
						            });


						            jQuery(".ot-coordinates").val(JSON.stringify(newMarkerArray));
						            markerArray = newMarkerArray;
						        });

						        google.maps.event.addListener(marker, \'dragend\', function() { 
						            var newMarkerArray = [];
						            arr = jQuery.makeArray(markers);
						            arr = arr[0];
						            i = 0;

						            jQuery.each(arr, function( index, value ) {

						                lat = value.position.lat();
						                lng = value.position.lng();
						                newMarkerArray[i] = {"lb": lat, "mb":lng};
						                i++;

						            });


						            jQuery(".ot-coordinates").val(JSON.stringify(newMarkerArray));
						            markerArray = newMarkerArray;
						        } );

						        jQuery(".ot-coordinates").val(JSON.stringify(markerArray));
						    }




						    function handleNoGeolocation(errorFlag) {
						      if (errorFlag) {
						        var content = "Error: The Geolocation service failed.";
						      } else {
						        var content = "Error: Your browser doesn\'t support geolocation.";
						      }

						      var options = {
						        map: map,
						        position: new google.maps.LatLng(60, 105),
						        content: content
						      };

						      var infowindow = new google.maps.InfoWindow(options);
						      map.setCenter(options.position);
						    }
					';

				$markers = json_decode($meta);

				echo 	'
						var mapOptions = { zoom: 6, mapTypeId: google.maps.MapTypeId.ROADMAP };
						var markerBounds = new google.maps.LatLngBounds();
						var map = new google.maps.Map(document.getElementById(\'map-canvas\'),mapOptions);';
				
				if(is_array($markers)) {
					$i=0;
					foreach($markers as $marker) {
						if($marker->lb && $marker->mb) {
							echo 	'
										cord = new google.maps.LatLng('.$marker->lb.','.$marker->mb.');
										addMarker(cord);
										markerBounds.extend(cord);';
							$i++;
						}
					} 
				}	

				if(!isset($i) || $i==0) {
					echo 	'if(navigator.geolocation) {
						 		navigator.geolocation.getCurrentPosition(function(position) {
						      	var pos = new google.maps.LatLng(position.coords.latitude,
						                                       position.coords.longitude);

						      	var infowindow = new google.maps.InfoWindow({
						        	map: map,
						        	position: pos,
						        	content: "Whereabouts"
						      	});

						      	map.setCenter(pos);
						    }, function() {
						      	handleNoGeolocation(true);
						    	});
						  	} else {
						    	handleNoGeolocation(false);
						  	}
					';
				} else if($i==1) {
					echo 'map.setZoom(15);
						map.setCenter(cord);';
				} else {
					echo 	'map.fitBounds(markerBounds);';
				}

				echo 	'
					 google.maps.event.addDomListener(window, \'load\', initialize);
					});
					</script>
				';


				break;
			case 'google_map':

				
				echo '
				    <div id="map-canvas"></div>

				    <p>'.__("Left click on the map to add markers. Right click on the marker to remove it!", THEME_NAME).'</p>
				    <input type="hidden" class="ot-coordinates" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? remove_html_slashes($meta) : remove_html_slashes($field['std']), '"/>
					<script type="text/javascript">
						jQuery(document).ready(function() {

						var id;
						var markers = {};
						var markerArray = [];
							// Add a marker to the map and push to the array.

						    function initialize() {

						        google.maps.event.addListener(map, \'click\', function(event) {
						            if(markerArray.length<3) {
						                addMarker(event.latLng);
						            } else {
						                alert("You already have marked 3 positions!");
						            }
						            
						        });

						    }

						    var delMarker = function (id) {
						        marker = markers[id]; 
						        marker.setMap(null);
						    }
						    
						    function addMarker(location) {
						        
						        marker = new google.maps.Marker({ 
						            position: location,
						            map: map,
						            draggable: true,
						            animation: google.maps.Animation.DROP,
						            icon: scripts.imageUrl+\'default-icon.png\'
						        });
						        id = marker.__gm_id
						        markers[id] = marker; 
						        markerArray.push({"lb": markers[id].getPosition().lat(), "mb":markers[id].getPosition().lng()}); 


						        google.maps.event.addListener(marker, "rightclick", function (event) {
						            var newMarkerArray = [];
						            id = this.__gm_id; 
						            delMarker(id);
						            delete markers[id];
						            arr = jQuery.makeArray(markers);
						            arr = arr[0];
						            i = 0;

						            jQuery.each(arr, function( index, value ) {
						                lat = value.position.lat();
						                lng = value.position.lng();
						                newMarkerArray[i] = {"lb": lat, "mb":lng};
						                i++;
						            });


						            jQuery(".ot-coordinates").val(JSON.stringify(newMarkerArray));
						            markerArray = newMarkerArray;
						        });

						        google.maps.event.addListener(marker, \'dragend\', function() { 
						            var newMarkerArray = [];
						            arr = jQuery.makeArray(markers);
						            arr = arr[0];
						            i = 0;

						            jQuery.each(arr, function( index, value ) {

						                lat = value.position.lat();
						                lng = value.position.lng();
						                newMarkerArray[i] = {"lb": lat, "mb":lng};
						                i++;

						            });


						            jQuery(".ot-coordinates").val(JSON.stringify(newMarkerArray));
						            markerArray = newMarkerArray;
						        } );

						        jQuery(".ot-coordinates").val(JSON.stringify(markerArray));
						    }




					';


				$markers = json_decode($meta);

				echo 	'
						var mapOptions = { zoom: 6, mapTypeId: google.maps.MapTypeId.ROADMAP };
						var markerBounds = new google.maps.LatLngBounds();
						var map = new google.maps.Map(document.getElementById(\'map-canvas\'),mapOptions);';
				
				if(is_array($markers)) {
					$i=0;
					foreach($markers as $marker) {
						if($marker->lb && $marker->mb) {
							echo 	'
										cord = new google.maps.LatLng('.$marker->lb.','.$marker->mb.');
										addMarker(cord);
										markerBounds.extend(cord);';
							$i++;
						} 
					} 
				}	

				if(!isset($i)) {
					echo 	'if(navigator.geolocation) {
						 		navigator.geolocation.getCurrentPosition(function(position) {
						      	var pos = new google.maps.LatLng(position.coords.latitude,
						                                       position.coords.longitude);

						      	var infowindow = new google.maps.InfoWindow({
						        	map: map,
						        	position: pos,
						        	content: "Whereabouts"
						      	});

						      	map.setCenter(pos);
						    }, function() {
						      	handleNoGeolocation(true);
						    	});
						  	} else {
						    	handleNoGeolocation(false);
						  	}
					';
				} else if($i==1) {
					echo 'map.setZoom(15);
						map.setCenter(cord);';
				} else {
					echo 	'map.fitBounds(markerBounds);';
				}

				echo 	'
					 google.maps.event.addDomListener(window, \'load\', initialize);
					 });
					</script>
				';

				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" ', $meta ? ' ' : '', ' style="width:400px; height:100px;">', $meta ? remove_html_slashes($meta) : remove_html_slashes($field['std']), '</textarea>';
				break;
			case 'sidebar_type':
				echo '
					<td style="vertical-align:top;">
						<div style="display:block;margin-bottom:20px;margin-right:30px;">
							<input type="radio" name="', $field['id'], '" value="1"', $meta=="1" || !$meta ? ' CHECKED ' : '', 'id="', $field['id'], '_1"/> <label style="display:inline-block;vertical-align:top;" for="legatus_sidebar_sort_1">Default sidebar<br/><img src="'.THEME_IMAGE_URL.'sidebar-blocks-2.png" alt="" title="" style="padding-top:8px;" /></label>
						</div>
					</td>
					<td style="vertical-align:top;">
						<div style="display:block;margin-bottom:20px;margin-right:30px;">
							<input type="radio" name="', $field['id'], '" value="2"', $meta=="2" ? ' CHECKED ' : '', 'id="', $field['id'], '_2"/> <label style="display:inline-block;vertical-align:top;" for="legatus_sidebar_sort_1">Splitted sidebar<br/><img src="'.THEME_IMAGE_URL.'sidebar-blocks-1.png" alt="" title="" style="padding-top:8px;" /></label>
						</div>
					</td>
					<td style="vertical-align:top;">
						<div style="display:block;margin-bottom:20px;margin-right:30px;">
							<input type="radio" name="', $field['id'], '" value="3"', $meta=="3" ? ' CHECKED ' : '', 'id="', $field['id'], '_3"/> <label style="display:inline-block;vertical-align:top;" for="legatus_sidebar_sort_1">Splitted &amp; Default sidebar<br/><img src="'.THEME_IMAGE_URL.'sidebar-blocks-3.png" alt="" title="" style="padding-top:8px;" /></label>
						</div>
					</td>
					<td style="vertical-align:top;">
						<div style="display:block;margin-bottom:20px;margin-right:30px;">
							<input type="radio" name="', $field['id'], '" value="4"', $meta=="4" ? ' CHECKED ' : '', 'id="', $field['id'], '_4"/> <label style="display:inline-block;vertical-align:top;" for="legatus_sidebar_sort_1">Default &amp; Splitted sidebar<br/><img src="'.THEME_IMAGE_URL.'sidebar-blocks-4.png" alt="" title="" style="padding-top:8px;" /></label>
						</div>
					</td>
				<script>
					jQuery(document).ready(function($){
						if($("#', $field['id'], '_1").attr("checked")=="checked") {
							$("#sidebar-select-post-left").slideUp();
							$("#sidebar-select-post-right").slideUp();
						}

						if($("#', $field['id'], '_2").attr("checked")=="checked") {
							$("#sidebar-select-box").slideUp();
						}

						$("#', $field['id'], '_2").click(function() {
						 	$("#sidebar-select-box").slideUp();
							$("#sidebar-select-post-left").slideDown();
							$("#sidebar-select-post-right").slideDown();
						});

						$("#', $field['id'], '_1").click(function() {
							$("#sidebar-select-post-left").slideUp();
							$("#sidebar-select-post-right").slideUp();
							$("#sidebar-select-box").slideDown();
						});

						$("#', $field['id'], '_3, #', $field['id'], '_4").click(function() {
						 	$("#sidebar-select-box").slideDown();
							$("#sidebar-select-post-left").slideDown();
							$("#sidebar-select-post-right").slideDown();
						});

						

						
					});

					
				</script>
';
				break;
			case 'home_drag_drop':
				global $OTfields;
				$OTfields = new OrangeThemesManagment(THEME_FULL_NAME,THEME_NAME);
				
				
				get_template_part(THEME_FUNCTIONS."drag-drop");
				$options = $OTfields->get_options();

				echo '
					<td style="vertical-align:top;">
						'.$OTfields->print_options().'
					</td>
				
';
				break;
		}
		echo '<td>', '</tr>';
	}
	echo '</table>';
}

function save_data($fields) {
	global $post_id;

	foreach ($fields['fields'] as $field) {	
		$old = get_post_meta($post_id, $field['id'], true);
		if(isset($_POST[$field['id']])) {
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}//else if closer
		}
	}//foreach closer
	
}

function save_datepicker($fields) {
	global $post_id;

	foreach ($fields['fields'] as $field) {	
		$old = get_post_meta($post_id, $field['id'], true);
		if(isset($_POST[$field['id']])) {
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], strtotime($new));
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], strtotime($old));
			}//else if closer
		}
	}//foreach closer
	
}

function save_numbers($fields) { 
	global $post_id;
	foreach ($fields['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if(!is_numeric($new)) { 
			$new = preg_replace("/[^0-9]/","",$new);
		}
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}//else if closer
	}//foreach closer

}

// Save data from meta box
function save_sticky_data($post_id) {
	global $box_array;
	
	// verify nonce
	if (isset($_POST['sticky_meta_box_nonce']) && !wp_verify_nonce($_POST['sticky_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($box_array as $box) {
		if($box["fields"][0]["type"]=="datepicker") {
			save_datepicker($box);
		} else {
			save_data($box);
		}

	}

} //function closer

	add_action('admin_menu', 'add_sticky_box');	
	add_action('save_post', 'save_sticky_data');

	
?>
