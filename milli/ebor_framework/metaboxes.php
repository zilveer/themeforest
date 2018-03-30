<?php

function ebor_custom_metaboxes( $meta_boxes ) {
	$prefix = '_ebor_'; // Prefix for all fields
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR GALLERY POST FORMAT /////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'gallery_metabox',
		'title' => __('The Gallery Images', 'ebor_starter'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Attach files for the gallery & image post formats',
				'desc' => 'UPLOAD (only) images here, they will be attached to this post and used in the gallery & image post formats',
				'id' => $prefix . 'gallery_list',
				'type' => 'file_list',
			),
		)
	);
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR COMING SOON PAGE /////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'coming_soon_metabox',
		'title' => __('Coming Soon Details', 'ebor_starter'),
		'pages' => array('page'), // post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'page_coming_soon.php' ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Countdown Date',
				'desc' => 'The date the counter should count down to',
				'id' => $prefix . 'soon_date',
				'type' => 'text_date'
			),
			array(
				'name' => 'Attach files for the gallery',
				'desc' => 'Add your images here, they will be added to the gallery for this page<br /><strong>Images will be cropped to 279px X 600px</strong><br />Only the first 4 images will be used for this coming soon page.',
				'id' => $prefix . 'image_list',
				'type' => 'file_list',
			),
		)
	);
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR VIDEO GALLERIES /////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'video_gallery_metabox',
		'title' => __('Gallery Set Up', 'ebor_starter'),
		'pages' => array('page'), // post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'page_video_gallery.php' ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Gallery Display Type',
				'desc' => 'Choose Gallery Display Type for This Gallery Page',
				'id' => $prefix . 'video_gallery_type',
				'type' => 'select',
				'options' => array(
					array('name' => '1 Column Video Feed With Descriptions', 'value' => 'videofeed'),
					array('name' => '2 Column Video Feed With Descriptions', 'value' => 'videofeedtwocol'),
					array('name' => 'Video Horizontal Slider', 'value' => 'videohorizontal'),
				)
			),
			array(
				'name' => 'Gallery Video URL',
				'desc' => 'Enter the URL of the page which contains your desired video on youtube or vimeo.',
				'id' => $prefix . 'video_gallery_url',
				'type' => 'text',
				'repeatable' => true
			),
			array(
				'name' => 'Gallery Video Title',
				'desc' => 'Enter the title of your video (make sure the order of this matches the URL order above) add a space to leave blank.',
				'id' => $prefix . 'video_gallery_title',
				'type' => 'text',
				'repeatable' => true
			),
			array(
				'name' => 'Gallery Video Description',
				'desc' => 'Enter the description of your video (make sure the order of this matches the URL order above) add a space to leave blank.',
				'id' => $prefix . 'video_gallery_description',
				'type' => 'text',
				'repeatable' => true
			),
		)
	);
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR GALLERIES /////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'portfolio_metabox',
		'title' => __('Gallery Set Up', 'ebor_starter'),
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Gallery Display Type',
				'desc' => 'Choose Gallery Display Type for This Gallery Page',
				'id' => $prefix . 'gallery_type',
				'type' => 'select',
				'options' => array(
					array('name' => 'Thumbnails', 'value' => 'basic'),
					array('name' => '1 Column Image Feed With Descriptions', 'value' => 'feed'),
					array('name' => '2 Column Image Feed With Descriptions', 'value' => 'feedtwocol'),
					array('name' => 'Horizontal Sliding', 'value' => 'horizontal')
				)
			),
			array(
				'name' => 'Gallery Image Crop Width',
				'desc' => 'Displayed in Percentage, <strong>enter values between 0 & 100</strong>, 100 for full width',
				'id' => $prefix . 'crop_width',
				'type' => 'text'
			),
			array(
				'name' => 'Gallery Image Crop Height',
				'desc' => 'Displayed in Pixels.<br />To display natural height images (mixed aspect ratios), enter 9999 and make sure crop is set to off.',
				'id' => $prefix . 'crop_height',
				'type' => 'text'
			),
			array(
				'name' => 'Gallery Item Margin',
				'desc' => 'Remember, a little margin goes a long way! Enter 0 for no margin.',
				'id' => $prefix . 'item_margin',
				'type' => 'text'
			),
			array(
				'name' => __('Crop or Resize?','ebor_starter'),
				'desc' => __("When ticked images will crop to fit sizes, when unticked images will resize to fit requirements.<br /><strong>To display natural height images (mixed aspect ratios), leave this unticked and enter 9999 in height.</strong>", 'ebor_starter'),
				'id'   => $prefix . 'crop_resize',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Attach files for the gallery',
				'desc' => 'Upload your images here, they will be added to the gallery for this page<br /><strong>Min Width 1000px per image, Max width 2000px</strong>.<br />Smaller images are allowed, though, depending on your settings, they may fail to crop/display.</br /><strong>To attach images it is a requirement of WordPress to upload new images, rather than picking from the media gallery.</strong>',
				'id' => $prefix . 'image_list',
				'type' => 'file_list',
			),
			array(
				'name' => __('Show Comments on This Gallery?','ebor_starter'),
				'desc' => __("When ticked comments will be shown for this gallery page.", 'ebor_starter'),
				'id'   => $prefix . 'gallery_comments',
				'type' => 'checkbox',
			),
			array(
				'name' => __('Link images to attachment pages?','ebor_starter'),
				'desc' => __("When ticked the images in this gallery will link to single 'attachment' posts, where comments can be left.", 'ebor_starter'),
				'id'   => $prefix . 'attachment_link',
				'type' => 'checkbox',
			),
			array(
				'name' => __('Open links in new window?','ebor_starter'),
				'desc' => __("When ticked all image links (not lightbox version) will open in a new browser tab.", 'ebor_starter'),
				'id'   => $prefix . 'target_blank',
				'type' => 'checkbox',
			),
			array(
				'name' => __('Disable all links?','ebor_starter'),
				'desc' => __("When ticked all image links will be disabled, and the gallery will serve just plain images", 'ebor_starter'),
				'id'   => $prefix . 'no_links',
				'type' => 'checkbox',
			),
		)
	);
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR VIDEO POST FORMAT ///////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'video_metabox',
		'title' => __('The Video Link', 'ebor_starter'),
		'pages' => array('post', 'portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_1',
				'type' => 'oembed',
			),
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_2',
				'type' => 'oembed',
			),
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_3',
				'type' => 'oembed',
			),
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_4',
				'type' => 'oembed',
			),
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_5',
				'type' => 'oembed',
			),
		)
	);
	
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR POSTS             ///////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'post_metabox',
		'title' => __('The Post Sidebar', 'ebor_starter'),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Disable Post Sidebar','ebor_starter'),
				'desc' => __("Check to disable the sidebar on this post.", 'ebor_starter'),
				'id'   => $prefix . 'disable_sidebar',
				'type' => 'checkbox',
			),
		)
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'ebor_custom_metaboxes' );

// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metabox/init.php' );
	}
}