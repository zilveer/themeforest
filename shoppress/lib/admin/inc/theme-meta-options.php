<?php // Meta Options (WPShout.com)

require(gp_inc . 'options.php');

add_action('admin_menu', 'gp_create_meta_box');
add_action('save_post', 'gp_save_meta_data');

function gp_create_meta_box() {
	add_meta_box('gp-theme-options', __('Post Settings', 'gp_lang'), 'gp_meta_boxes', 'post', 'normal', 'core');
	add_meta_box('gp-theme-options', __('Page Settings', 'gp_lang'), 'gp_meta_boxes', 'page', 'normal', 'core');
	add_meta_box('gp-theme-options', __('Slide Settings', 'gp_lang'), 'gp_meta_boxes', 'slide', 'normal', 'core');
	add_meta_box('gp-theme-options', __('Product Settings', 'gp_lang'), 'gp_meta_boxes', 'product', 'normal', 'core');	
}


/////////////////////////////////////// Post Settings ///////////////////////////////////////

function gp_post_meta_boxes() {
	
	global $dirname;
	
	$meta_boxes = array(

	'thumbnail_settings' => array('name' => 'thumbnail_settings', 'type' => 'open', 'desc' => __('Controls the thumbnails used on category, archive, tag and search result pages.', 'gp_lang'), 'title' => __('Thumbnail Settings', 'gp_lang')),
	
		$dirname.'_thumbnail_width' => array('name' => $dirname.'_thumbnail_width', 'title' => __('Thumbnail Width', 'gp_lang'), 'desc' => __('The width to crop the thumbnail to (set to 0 to have a proportionate width).', 'gp_lang'), 'std' => '', 'type' => 'text', 'size' => 'small', 'details' => 'px'),	
				
		$dirname.'_thumbnail_height' => array('name' => $dirname.'_thumbnail_height', 'title' => __('Thumbnail Height', 'gp_lang'), 'desc' => __('The height to crop the thumbnail to (set to 0 to have a proportionate height).', 'gp_lang'), 'std' => '', 'type' => 'text', 'size' => 'small', 'details' => 'px'),	

	array('type' => 'separator', 'name' => ''),		
	array('type' => 'close', 'name' => ''),

	'image_settings' => array('name' => 'image_settings', 'type' => 'open', 'desc' => __('Controls the featured image displayed within this page.', 'gp_lang'), 'title' => __('Image Settings', 'gp_lang')),

		$dirname.'_show_image' => array('name' => $dirname.'_show_image', 'title' => __('Featured Image', 'gp_lang'), 'desc' => __('Choose whether to display the featured image within your page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),	
		
		$dirname.'_image_width' => array('name' => $dirname.'_image_width', 'title' => __('Image Width', 'gp_lang'), 'desc' => __('The width to crop the image to (set to 0 to have a proportionate width).', 'gp_lang'), 'std' => '', 'type' => 'text', 'size' => 'small', 'details' => 'px'),
				
		$dirname.'_image_height' => array('name' => $dirname.'_image_height', 'title' => __('Image Height', 'gp_lang'), 'desc' => __('The height to crop the image to (set to 0 to have a proportionate height).', 'gp_lang'), 'std' => '', 'type' => 'text', 'size' => 'small', 'details' => 'px'),
		
		$dirname.'_image_wrap' => array('name' => $dirname.'_image_wrap', 'title' => __('Image Wrap', 'gp_lang'), 'desc' => __('Choose whether the page content wraps around the featured image.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),	
		
		array('type' => 'divider', 'name' => ''),	
		
		$dirname.'_hard_crop' => array('name' => $dirname.'_hard_crop', 'title' => __('Hard Crop', 'gp_lang'), 'desc' => __('Choose whether the image is hard cropped.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),	
				
	array('type' => 'separator', 'name' => ''),		
	array('type' => 'close', 'name' => ''),
	
	'portfolio_settings' => array('name' => 'portfolio_settings', 'type' => 'open', 'desc' => __('Can be used when your posts are displayed in <code>[posts]</code> shortcodes.', 'gp_lang'), 'title' => __('Portfolio Settings', 'gp_lang')),
		
		$dirname.'_link_type' => array('name' => $dirname.'_link_type', 'title' => __('Link Type', 'gp_lang'), 'desc' => __('Choose how your portfolio link opens.', 'gp_lang'), 'options' => array('Page' => __('Page', 'gp_lang'), 'Lightbox Image' => __('Lightbox Image', 'gp_lang'), 'Lightbox Video' => __('Lightbox Video', 'gp_lang'), 'None' => __('None', 'gp_lang')), 'std' => 'Page', 'type' => 'select'),
	
		$dirname.'_custom_url' => array('name' => $dirname.'_custom_url', 'title' => __('Custom URL', 'gp_lang'), 'desc' => __('A custom URL which your image links to (overrides the default post URL).', 'gp_lang'), 'type' => 'text'),
		
		$dirname.'_lightbox_content' => array('name' => $dirname.'_lightbox_content', 'title' => __('Lightbox Content', 'gp_lang'), 'desc' => __('Upload images/audio/videos that will be opened in the lightbox.', 'gp_lang'), 'type' => 'gallery'),
		
		array('type' => 'separator', 'name' => ''),		
		array('type' => 'close', 'name' => ''),
		
	'format_settings' => array('name' => 'format_settings', 'type' => 'open', 'desc' => __('General formatting settings.', 'gp_lang'), 'title' => __('Format Settings', 'gp_lang')),
		
		$dirname.'_sidebar' => array('name' => $dirname.'_sidebar', 'title' => __('Sidebar', 'gp_lang'), 'desc' => __('Choose which sidebar area to display on this page.', 'gp_lang'), 'std' => 'Default', 'type' => 'select_sidebar'),
		
		$dirname.'_layout' => array('name' => $dirname.'_layout', 'title' => __('Layout', 'gp_lang'), 'desc' => __('Choose the layout for this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'sb-left' => __('Sidebar Left', 'gp_lang'), 'sb-right' => __('Sidebar Right', 'gp_lang'), 'fullwidth' => __('Fullwidth', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),

		$dirname.'_title' => array('name' => $dirname.'_title', 'title' => __('Title', 'gp_lang'), 'desc' => __('Choose whether to display the title on this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		$dirname.'_breadcrumbs' => array('name' => $dirname.'_breadcrumbs', 'title' => __('Breadcrumbs', 'gp_lang'), 'desc' => __('Choose whether to display breadcrumbs on this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),

		array('type' => 'divider'),
		
		$dirname.'_search' => array('name' => $dirname.'_search', 'title' => __('Search Bar', 'gp_lang'), 'desc' => __('Choose whether to display the search bar.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),

		$dirname.'_bottom_widgets' => array('name' => $dirname.'_bottom_widgets', 'title' => __('Bottom Content Widgets', 'gp_lang'), 'desc' => __('Choose whether to display the bottom content widget area.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
				
		$dirname.'_skin' => array('name' => $dirname.'_skin', 'title' => __('Skin', 'gp_lang'), 'desc' => __('Choose the skin of this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'dark' => __('Dark', 'gp_lang'), 'dark-wide' => __('Dark Wide', 'gp_lang'), 'light' => __('Light', 'gp_lang'), 'light-wide' => __('Light Wide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		$dirname.'_custom_stylesheet' => array('name' => $dirname.'_custom_stylesheet', 'title' => __('Custom Stylesheet URL', 'gp_lang'), 'desc' => __('Enter the relative URL to your custom stylesheet e.g. <code>lib/css/custom-style.css</code>.', 'gp_lang'), 'std' => '', 'type' => 'text'),
		
	array('type' => 'close', 'name' => ''),	
	array('type' => 'clear', 'name' => ''),
	
	);

	return apply_filters($dirname.'_post_meta_boxes', $meta_boxes);
}


/////////////////////////////////////// Page Settings ///////////////////////////////////////

function gp_page_meta_boxes() {
	
	global $dirname;

	$meta_boxes = array(
	
	'thumbnail_settings' => array('name' => 'thumbnail_settings', 'type' => 'open', 'desc' => __('Controls the thumbnails used on category, archive, tag and search result pages.', 'gp_lang'), 'title' => __('Thumbnail Settings', 'gp_lang')),
		
		$dirname.'_thumbnail_width' => array('name' => $dirname.'_thumbnail_width', 'title' => __('Thumbnail Width', 'gp_lang'), 'desc' => __('The width to crop the thumbnail to (set to 0 to have a proportionate width).', 'gp_lang'), 'std' => '', 'type' => 'text', 'size' => 'small', 'details' => 'px'),	
				
		$dirname.'_thumbnail_height' => array('name' => $dirname.'_thumbnail_height', 'title' => __('Thumbnail Height', 'gp_lang'), 'desc' => __('The height to crop the thumbnail to (set to 0 to have a proportionate height).', 'gp_lang'), 'std' => '', 'type' => 'text', 'size' => 'small', 'details' => 'px'),	

	array('type' => 'separator', 'name' => ''),		
	array('type' => 'close', 'name' => ''),

	'image_settings' => array('name' => 'image_settings', 'type' => 'open', 'desc' => __('Controls the featured image displayed within this page.', 'gp_lang'), 'title' => __('Image Settings', 'gp_lang')),

		$dirname.'_show_image' => array('name' => $dirname.'_show_image', 'title' => __('Featured Image', 'gp_lang'), 'desc' => __('Choose whether to display the featured image within your page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),	
		
		$dirname.'_image_width' => array('name' => $dirname.'_image_width', 'title' => __('Image Width', 'gp_lang'), 'desc' => __('The width to crop the image to (set to 0 to have a proportionate width).', 'gp_lang'), 'std' => '', 'type' => 'text', 'size' => 'small', 'details' => 'px'),
				
		$dirname.'_image_height' => array('name' => $dirname.'_image_height', 'title' => __('Image Height', 'gp_lang'), 'desc' => __('The height to crop the image to (set to 0 to have a proportionate height).', 'gp_lang'), 'std' => '', 'type' => 'text', 'size' => 'small', 'details' => 'px'),
		
		$dirname.'_image_wrap' => array('name' => $dirname.'_image_wrap', 'title' => __('Image Wrap', 'gp_lang'), 'desc' => __('Choose whether the page content wraps around the featured image.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),	
		
		array('type' => 'divider', 'name' => ''),	
		
		$dirname.'_hard_crop' => array('name' => $dirname.'_hard_crop', 'title' => __('Hard Crop', 'gp_lang'), 'desc' => __('Choose whether the image is hard cropped.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Enable' => __('Enable', 'gp_lang'), 'Disable' => __('Disable', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),	
				
	array('type' => 'separator', 'name' => ''),		
	array('type' => 'close', 'name' => ''),
	
	'format_settings' => array('name' => 'format_settings', 'type' => 'open', 'desc' => __('General formatting settings.', 'gp_lang'), 'title' => __('Format Settings', 'gp_lang')),
		
		$dirname.'_sidebar' => array('name' => $dirname.'_sidebar', 'title' => __('Sidebar', 'gp_lang'), 'desc' => __('Choose which sidebar area to display on this page.', 'gp_lang'), 'std' => 'Default', 'type' => 'select_sidebar'),
		
		$dirname.'_layout' => array('name' => $dirname.'_layout', 'title' => __('Layout', 'gp_lang'), 'desc' => __('Choose the layout for this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'sb-left' => __('Sidebar Left', 'gp_lang'), 'sb-right' => __('Sidebar Right', 'gp_lang'), 'fullwidth' => __('Fullwidth', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		$dirname.'_title' => array('name' => $dirname.'_title', 'title' => __('Title', 'gp_lang'), 'desc' => __('Choose whether to display the title on this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		$dirname.'_breadcrumbs' => array('name' => $dirname.'_breadcrumbs', 'title' => __('Breadcrumbs', 'gp_lang'), 'desc' => __('Choose whether to display breadcrumbs on this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		array('type' => 'divider'),
		
		$dirname.'_search' => array('name' => $dirname.'_search', 'title' => __('Search Bar', 'gp_lang'), 'desc' => __('Choose whether to display the search bar.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		$dirname.'_bottom_widgets' => array('name' => $dirname.'_bottom_widgets', 'title' => __('Bottom Content Widgets', 'gp_lang'), 'desc' => __('Choose whether to display the bottom content widget area.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
						
		$dirname.'_skin' => array('name' => $dirname.'_skin', 'title' => __('Skin', 'gp_lang'), 'desc' => __('Choose the skin of this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'dark' => __('Dark', 'gp_lang'), 'dark-wide' => __('Dark Wide', 'gp_lang'), 'light' => __('Light', 'gp_lang'), 'light-wide' => __('Light Wide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		$dirname.'_custom_stylesheet' => array('name' => $dirname.'_custom_stylesheet', 'title' => __('Custom Stylesheet URL', 'gp_lang'), 'desc' => __('Enter the relative URL to your custom stylesheet e.g. <code>lib/css/custom-style.css</code>.', 'gp_lang'),  'std' => '', 'type' => 'text'),
	
	array('type' => 'close', 'name' => ''),	
	array('type' => 'clear', 'name' => ''),
	
	);

	return apply_filters($dirname.'_page_meta_boxes', $meta_boxes);
}


/////////////////////////////////////// Slide Settings ///////////////////////////////////////
	 
function gp_slide_meta_boxes() {
	
	global $dirname;
	
	$meta_boxes = array(

	'general_settings' => array('name' => 'general_settings', 'type' => 'open', 'desc' => __('General product slide settings.', 'gp_lang'), 'title' => __('Format Settings', 'gp_lang')),
		
		$dirname.'_custom_url' => array('name' => $dirname.'_custom_url', 'title' => __('Slide URL', 'gp_lang'), 'desc' => __('Enter the URL you want your slide to link to.', 'gp_lang'),  'type' => 'text'),

		$dirname.'_link_type' => array('name' => $dirname.'_link_type', 'title' => __('Link Type', 'gp_lang'), 'desc' => __('Choose how your slide links to the URL you provided to the left.', 'gp_lang'), 'options' => array('Page' => __('Page', 'gp_lang'), 'Lightbox Image' => __('Lightbox Image', 'gp_lang'), 'Lightbox Video' => __('Lightbox Video', 'gp_lang'), 'None' => __('None', 'gp_lang')), 'std' => 'Page', 'type' => 'select'),
		
	array('type' => 'separator', 'name' => ''),		
	array('type' => 'close', 'name' => ''),
	
	'video_settings' => array('name' => 'video_settings', 'type' => 'open', 'desc' => __('The settings for a video used in this slide.', 'gp_lang'), 'title' => __('Video Settings', 'gp_lang')),
	
		$dirname.'_slide_video' => array('name' => $dirname.'_slide_video', 'title' => __('Video URL', 'gp_lang'), 'desc' => __('The URL of your video or audio file (YouTube/Vimeo/FLV/MP4/M4V/MP3).', 'gp_lang'), 'type' => 'upload'),

		$dirname.'_webm_mp4_slide_video' => array('name' => $dirname.'_webm_mp4_slide_video', 'title' => __('HTML5 Video URL (Safari/Chrome)', 'gp_lang'), 'desc' => __('Enter your HTML5 video URL for Safari/Chrome (WEBM/MP4).', 'gp_lang'), 'type' => 'upload'),

		$dirname.'_ogg_slide_video' => array('name' => $dirname.'_ogg_slide_video', 'title' => __('HTML5 Video URL (FireFox/Opera)', 'gp_lang'), 'desc' => __('Enter your HTML5 video URL for FireFox/Opera (OGG/OGV).', 'gp_lang'), 'type' => 'upload'),
				
		$dirname.'_slide_autostart_video' => array('name' => $dirname.'_slide_autostart_video', 'title' => __('Autostart Video', 'gp_lang'), 'desc' => __('Plays the video automatically when the slide comes into view (works in the first slide only).', 'gp_lang'), 'std' => '', 'type' => 'checkbox'),

		array('type' => 'divider'),
		
		$dirname.'_slide_video_priority' => array('name' => $dirname.'_slide_video_priority', 'title' => __('Video Priority', 'gp_lang'), 'desc' => __('If you have provided both flash and HTML5 videos, select which one will take priority if the browser can play both.', 'gp_lang'), 'options' => array('Flash' => __('Flash', 'gp_lang'), 'HTML5' => __('HTML5', 'gp_lang')), 'std' => 'Flash', 'type' => 'select'),
		
		$dirname.'_slide_video_controls' => array('name' => $dirname.'_slide_video_controls', 'title' => __('Video Controls', 'gp_lang'), 'desc' => __('Choose how to display the video controls (does not apply to Vimeo videos).', 'gp_lang'), 'options' => array('None' => __('None', 'gp_lang'), 'Bottom' => __('Bottom', 'gp_lang'), 'Over' => __('Over', 'gp_lang')), 'std' => 'None', 'type' => 'select'),
		
	array('type' => 'separator', 'name' => ''),		
	array('type' => 'close', 'name' => ''),
	
	'caption_settings' => array('name' => 'caption_settings', 'type' => 'open', 'desc' => __('The settings for a caption in this slide.', 'gp_lang'),  'title' => __('Caption Settings', 'gp_lang')),
		
		$dirname.'_slide_title' => array('name' => $dirname.'_slide_title', 'title' => __('Hide Slide Caption Title', 'gp_lang'), 'desc' => __('Hide the slide caption title.', 'gp_lang'), 'std' => '', 'type' => 'checkbox'),
		
		$dirname.'_slide_caption_link_text' => array('name' => $dirname.'_slide_caption_link_text', 'title' => __('Caption Link Text', 'gp_lang'), 'desc' => __('Enter the your caption link text.', 'gp_lang'), 'type' => 'text'),
						
		$dirname.'_slide_caption_link' => array('name' => $dirname.'_slide_caption_link', 'title' => __('Caption Link', 'gp_lang'), 'desc' => __('Enter the URL you want your caption link text to link to.', 'gp_lang'), 'type' => 'text'),

		$dirname.'_slide_caption_type' => array('name' => $dirname.'_slide_caption_position', 'title' => __('Caption Position', 'gp_lang'), 'desc' => __('Choose the caption position.', 'gp_lang'), 'options' => array('Top Left Overlay' => __('Top Left Overlay', 'gp_lang'), 'Top Right Overlay' => __('Top Right Overlay', 'gp_lang'), 'Bottom Left Overlay' => __('Bottom Left Overlay', 'gp_lang'), 'Bottom Right Overlay' => __('Bottom Right Overlay', 'gp_lang')), 'type' => 'select', 'std' => 'Bottom Left Overlay'),
							
	array('type' => 'close', 'name' => ''),
	array('type' => 'clear', 'name' => ''),	
	
	);

	return apply_filters($dirname.'_slide_meta_boxes', $meta_boxes);
}


/////////////////////////////////////// Product Settings ///////////////////////////////////////
	 
function gp_product_meta_boxes() {
	
	global $dirname;
	
	$meta_boxes = array(

	'image_settings' => array('name' => 'image_settings', 'type' => 'open', 'desc' => __('Controls the featured image displayed within this page.', 'gp_lang'), 'title' => __('Image Settings', 'gp_lang')),
			
		$dirname.'_image_effect' => array('name' => $dirname.'_image_effect', 'title' => __('Image Effect', 'gp_lang'), 'desc' => __('Choose what image effect is used on your product page images.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Zoom' => __('Zoom', 'gp_lang'), 'Lightbox' => __('Lightbox', 'gp_lang'), 'None' => __('None', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
	array('type' => 'separator', 'name' => ''),		
	array('type' => 'close', 'name' => ''),
		
	'format_settings' => array('name' => 'format_settings', 'type' => 'open', 'desc' => __('General formatting settings.', 'gp_lang'), 'title' => __('Format Settings', 'gp_lang')),
		
		$dirname.'_sidebar' => array('name' => $dirname.'_sidebar', 'title' => __('Sidebar', 'gp_lang'), 'desc' => __('Choose which sidebar area to display on this page.', 'gp_lang'), 'std' => 'Default', 'type' => 'select_sidebar'),
		
		$dirname.'_layout' => array('name' => $dirname.'_layout', 'title' => __('Layout', 'gp_lang'), 'desc' => __('Choose the layout for this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'sb-left' => __('Sidebar Left', 'gp_lang'), 'sb-right' => __('Sidebar Right', 'gp_lang'), 'fullwidth' => __('Fullwidth', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		$dirname.'_breadcrumbs' => array('name' => $dirname.'_breadcrumbs', 'title' => __('Breadcrumbs', 'gp_lang'), 'desc' => __('Choose whether to display breadcrumbs on this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
				
		$dirname.'_search' => array('name' => $dirname.'_search', 'title' => __('Search Bar', 'gp_lang'), 'desc' => __('Choose whether to display the search bar.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),

		array('type' => 'divider'),
		
		$dirname.'_bottom_widgets' => array('name' => $dirname.'_bottom_widgets', 'title' => __('Bottom Content Widgets', 'gp_lang'), 'desc' => __('Choose whether to display the bottom content widget area.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'Show' => __('Show', 'gp_lang'), 'Hide' => __('Hide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
						
		$dirname.'_skin' => array('name' => $dirname.'_skin', 'title' => __('Skin', 'gp_lang'), 'desc' => __('Choose the skin of this page.', 'gp_lang'), 'options' => array('Default' => __('Default', 'gp_lang'), 'dark' => __('Dark', 'gp_lang'), 'dark-wide' => __('Dark Wide', 'gp_lang'), 'light' => __('Light', 'gp_lang'), 'light-wide' => __('Light Wide', 'gp_lang')), 'std' => 'Default', 'type' => 'select'),
		
		$dirname.'_custom_stylesheet' => array('name' => $dirname.'_custom_stylesheet', 'title' => __('Custom Stylesheet URL', 'gp_lang'), 'desc' => __('Enter the relative URL to your custom stylesheet e.g. <code>lib/css/custom-style.css</code>.', 'gp_lang'), 'std' => '', 'type' => 'text'),
		
	array('type' => 'close', 'name' => ''),	
	array('type' => 'clear', 'name' => ''),
	
	);

	return apply_filters($dirname.'_product_meta_boxes', $meta_boxes);
}


/////////////////////////////////////// Meta Fields ///////////////////////////////////////


function gp_meta_boxes() {
	global $post;

	if(get_post_type() == 'post') {
		$meta_boxes = gp_post_meta_boxes();	
	} elseif(get_post_type() == 'slide') {	
		$meta_boxes = gp_slide_meta_boxes();	
	} elseif(get_post_type() == 'product') {
		$meta_boxes = gp_product_meta_boxes();		
	} else {
		$meta_boxes = gp_page_meta_boxes();
	}
	
	foreach($meta_boxes as $meta) :
	if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }
	if($meta['type'] == 'text')
		get_meta_text($meta, $value);	
	elseif($meta['type'] == 'upload')
		get_meta_upload($meta, $value);			
	elseif($meta['type'] == 'textarea')
		get_meta_textarea($meta, $value);
	elseif($meta['type'] == 'select')
		get_meta_select($meta, $value);
	elseif($meta['type'] == 'select_sidebar')
		get_meta_select_sidebar($meta, $value);			
	elseif($meta['type'] == 'checkbox')
		get_meta_checkbox($meta, $value);			
	elseif($meta['type'] == 'open')
		get_meta_open($meta, $value);		
	elseif($meta['type'] == 'close')
		get_meta_close($meta, $value);
	elseif($meta['type'] == 'divider')
		get_meta_divider($meta, $value);	
	elseif ($meta['type'] == 'separator')
		get_meta_separator($meta, $value);					
	elseif($meta['type'] == 'clear')
		get_meta_clear($meta, $value);
	elseif($meta['type'] == 'gallery')
		get_meta_gallery($meta, $value);	
	elseif($meta['type'] == 'colorpicker')
		get_meta_colorpicker($meta, $value);			
	endforeach;
		
} function get_meta_open($args = array(), $value = false, $title = false ) {
extract($args); ?>
	
	<div class="meta-settings" id="<?php echo $name; ?>">
	
		<h2><?php echo $title; ?></h2>
		<div class="clear"></div>
	
		<?php if ( $desc ) { ?><div class="meta-settings-desc"><?php echo $desc; ?></div><div class="clear"></div><?php } ?>
	
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />		
	
	
<?php } function get_meta_close($args = array(), $value = false) {
extract($args); ?>
	
	</div><div class="clear"></div>
	
	<input type="hidden" name="_noncename" id="_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />		
	
	
<?php } function get_meta_divider($args = array(), $value = false) {
extract($args); ?>

	<div class="clear"></div>
	<div class="divider"></div>
	<input type="hidden" name="_noncename" id="_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />		


<?php } function get_meta_separator($args = array(), $value = false) {
extract($args); ?>
	
	<div class="clear"></div>
	<div class="separator"></div>
	<input type="hidden" name="_noncename" id="_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />		
	
	
<?php } function get_meta_clear($args = array(), $value = false) {
extract($args); ?>
	
	<div class="clear"></div>
	<input type="hidden" name="_noncename" id="_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />		
	
	
<?php } function get_meta_text($args = array(), $value = false, $desc = false, $details = false, $size = '', $std = '', $title = false ) {
extract($args); global $post; ?>

	<div id="meta-box-<?php echo $name; ?>" class="meta-box<?php if($size == "small") { ?> text-small<?php } ?>">
		<?php if($title) { ?><strong><?php echo $title; ?></strong><br/><?php } ?>
		<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php if($value != "") { echo esc_html($value, 1); } else { echo $std; } ?>" size="<?php if($size == "small") { ?>3<?php } else { ?>30<?php } ?>" /><?php if($details) { ?> <span><?php echo $details; ?></span><?php } ?>
		<?php if ( $desc ) { ?><div class="meta-box-desc"><?php echo $desc; ?></div><?php } ?>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
	</div>


<?php } function get_meta_upload($args = array(), $value = false, $desc = false, $std = '', $title = false ) {
extract($args); global $post; ?>

	<div id="meta-box-<?php echo $name; ?>" class="meta-box uploader">
		<?php if($title) { ?><strong><?php echo $title; ?></strong><br/><?php } ?>
		<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="upload" value="<?php if($value != "") { echo esc_html($value, 1); } else { echo $std; } ?>" size="30" />
		<input type="button" id="<?php echo $name; ?>_button" class="upload-image-button button" value="<?php _e('Upload', 'gp_lang'); ?>" />
		<?php if ( $desc ) { ?><div class="meta-box-desc"><?php echo $desc; ?></div><?php } ?>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
	</div>
	
	
<?php } function get_meta_select($args = array(), $value = false, $desc = false, $std = '', $title = false  ) {
extract($args); ?>
	
	<div id="meta-box-<?php echo $name; ?>" class="meta-box">
		<?php if($title) { ?><strong><?php echo $title; ?></strong><br/><?php } ?>
		<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
		<?php foreach($options as $key=>$option) : ?>
			<?php if($value != "") { ?>
				<option value="<?php echo $key; ?>" <?php if(htmlentities($value, ENT_QUOTES) == $key) echo ' selected="selected"'; ?>><?php echo $option; ?></option>
			<?php } else { ?>
				<option value="<?php echo $key; ?>" <?php if($std == $key) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
			<?php } ?>	
		<?php endforeach; ?>
		</select>
		<?php if ( $desc ) { ?><div class="meta-box-desc"><?php echo $desc; ?></div><?php } ?>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
	</div>


<?php } function get_meta_select_sidebar($args = array(), $value = false, $desc = false, $std = '', $title = false ) {
extract($args); global $post, $wp_registered_sidebars; ?>

	<div id="meta-box-<?php echo $name; ?>" class="meta-box">
		<?php if($title) { ?><strong><?php echo $title; ?></strong><br/><?php } ?>
		<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<option value="Default" <?php if(htmlentities($value, ENT_QUOTES) == 'Default') echo ' selected="selected"'; ?>><?php _e('Default', 'gp_lang'); ?></option>
			<?php $sidebars = $wp_registered_sidebars;
			if(is_array($sidebars) && !empty($sidebars)) { foreach($sidebars as $sidebar) { if($value != '') { ?>
				<option value="<?php echo $sidebar['id']; ?>"<?php if($value == $sidebar['id']) { echo ' selected="selected"'; } ?>><?php echo $sidebar['name']; ?></option>
			<?php } else { ?>
				<option value="<?php echo $sidebar['id']; ?>"<?php if($std == $sidebar['id']) { echo ' selected="selected"'; } ?>><?php echo $sidebar['name']; ?></option>
			<?php }}} ?>
		</select>
		<?php if ( $desc ) { ?><div class="meta-box-desc"><?php echo $desc; ?></div><?php } ?>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
	</div>
	
		
<?php } function get_meta_textarea($args = array(), $value = false, $desc = false, $size = '', $std = '', $title = false ) {
extract($args); ?>

	<div id="meta-box-<?php echo $name; ?>" class="meta-box<?php if($size == "large") { ?> text-large<?php } ?>">	
		<?php if($title) { ?><strong><?php echo $title; ?></strong><br/><?php } ?>
		<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30"><?php if ( $value != '' ) { echo esc_html( $value, 1 ); } else { echo $std; } ?></textarea>
		<?php if ( $desc ) { ?><div class="meta-box-desc"><?php echo $desc; ?></div><?php } ?>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
	</div>


<?php } function get_meta_checkbox($args = array(), $value = false, $desc = false, $std = '', $title = false ) {
extract($args); ?>

	<div id="meta-box-<?php echo $name; ?>" class="meta-box">
		<?php if($title) { ?><strong><?php echo $title; ?></strong><?php } ?>
		<?php if(esc_html($value, 1)) { $checked = "checked=\"checked\""; } else { if($std === "true") { $checked = "checked=\"checked\""; } else { $checked = ""; } } ?>
		<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="false" <?php echo $checked; ?> />
		<?php if ( $desc ) { ?><div class="meta-box-desc"><?php echo $desc; ?></div><?php } ?>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />		
	</div>
	

<?php } function get_meta_gallery( $args = array(), $value = false, $desc = false, $title = false ) {
extract($args); global $post; ?>

	<div id="meta-box-<?php echo $name; ?>" class="meta-box">
	
		<?php if($title) { ?><strong><?php echo $title; ?></strong><?php } ?>
		<div class="clear"></div>
			
		<div id="wp-content-media-buttons" class="wp-media-buttons" style="margin-top: 5px;">
			<a href="#" class="button insert-media add_media" data-editor="content" title="<?php _e('Add Media', 'gp_lang'); ?>"><span class="wp-media-buttons-icon"></span> <?php _e('Add Media', 'gp_lang'); ?></a>
		</div>
		
		<div class="clear"></div>
		
		<?php if ( $desc ) { ?><div class="meta-box-desc"><?php echo $desc; ?></div><?php } ?>
		
		<?php $image_url = site_url().'/wp-includes/images/crystal/video.png';
		$args = array('post_type' => 'attachment', 'post_parent' => $post->ID, 'numberposts' => -1, 'orderby' => 'date', 'order' => 'desc', 'post__not_in' => array(get_post_thumbnail_id())); $attachments = get_children($args); ?>		
		<?php if($attachments) { foreach ($attachments as $attachment) { ?>
			<?php if($attachment->post_mime_type == 'image/jpeg' OR $attachment->post_mime_type == 'image/jpg' OR $attachment->post_mime_type == 'image/png' OR $attachment->post_mime_type == 'image/gif') { $image = aq_resize(wp_get_attachment_url($attachment->ID), 100, 100, true, true, true); } else { $image = site_url().'/wp-includes/images/crystal/video.png'; } ?>
			<img src="<?php echo $image; ?>" width="50" height="50" alt="" style="margin-top: 5px;" />
		<?php }} ?>		
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>
	

<?php } function get_meta_colorpicker( $args = array(), $value = false, $desc = false, $std = '', $title = false ) {
extract($args); ?>

	<div id="meta-box-<?php echo $name; ?>" class="meta-box">
		<script type="text/javascript">
			jQuery(document).ready(function($){  
				$("#<?php echo $name; ?>").wpColorPicker();
			});
		</script>
		<?php if($title) { ?><strong><?php echo $title; ?></strong><br/><?php } ?>
		<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php if($value != "") { echo $value; } else { echo $std; } ?>" />
		<?php if ( $desc ) { ?><div class="meta-box-desc"><?php echo $desc; ?></div><?php } ?>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
	</div>


<?php }

if(is_admin() && ($pagenow == "post.php" OR $pagenow == "post-new.php")) {	
	function gp_admin_scripts() {	
		wp_enqueue_style('gp-admin', get_template_directory_uri().'/lib/admin/css/admin.css');
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		if(!has_action('admin_footer', 'wp_print_media_templates')) wp_enqueue_media();
		wp_enqueue_script('gp-uploader', get_template_directory_uri().'/lib/admin/scripts/uploader.js');
	}	
	add_action('admin_print_scripts', 'gp_admin_scripts');		
}

function gp_save_meta_data($post_id) {
	global $post;

	if(isset($_POST['post_type']) && 'post' == $_POST['post_type'])
		$meta_boxes = array_merge(gp_post_meta_boxes());
	elseif(isset($_POST['post_type']) && 'slide' == $_POST['post_type'])
		$meta_boxes = array_merge(gp_slide_meta_boxes());	
	elseif(isset($_POST['post_type']) && 'product' == $_POST['post_type'])
		$meta_boxes = array_merge(gp_product_meta_boxes());
	else
		$meta_boxes = array_merge(gp_page_meta_boxes());
		
	foreach ($meta_boxes as $meta_box) :
		
		if ( !isset( $_POST[$meta_box['name'] . '_noncename'] ) OR !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) ) {
			return $post_id;
		}

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
			return $post_id;
      
		if(!current_user_can('edit_post', $post_id))
			return $post_id;
					
		$data = sanitize_text_field($_POST[$meta_box['name']]);

		if(get_post_meta($post_id, $meta_box['name']) == '')
			add_post_meta($post_id, $meta_box['name'], $data, true);

		elseif($data != get_post_meta($post_id, $meta_box['name'], true))
			update_post_meta($post_id, $meta_box['name'], $data);

		elseif($data == '')
			delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));

	endforeach;
}

?>