<?php 
/**
 * Metaboxes for Page
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'mm_';


/////////////////////////post//////////////////////////////////////////////////////////////////
$config_img = array(
	'title' => __('Gallery Options', 'candidate'),
	'id' => $prefix . 'blog_image_meta_box',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_img = array(
	array(
			'desc' => '<strong>'. __('NOTE: Click the Add Images button to upload the images to this post. You can drag-and-drop images to re-order them.', 'candidate').'</strong><br />',
			'id' => $prefix . 'slider_image_gallery',
			'button' => __('Add Images', 'candidate'),
			'class' => 'noborder',
			'type' => 'upload_images'
	),

);
new meta_boxes_generator($config_img,$options_img);

///////////////////////////post///////////////////////////////////////////////////////////////////////////////////////
$config_link = array(
	'title' => __('Custom Link', 'candidate'),
	'id' => $prefix . 'blog_link_meta_box',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_link = array(
	array(
		'name' => '',
		'id' => $prefix . 'custom_link_meta_box',
		'desc' => __('URL Link',  'candidate'),
		'std' => '',
		'size' => '30',
		'class' => 'noborder',
		'type' => 'text'
	)

);
new meta_boxes_generator($config_link,$options_link);

//////////////////////////post////////////////////////////////////////////////////////////////////////////////////////
$config_audio = array(
	'title' => __('Post Audio Options', 'candidate'),
	'id' => $prefix . 'blog_audio_meta_box',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_audio = array(
	array(
		'name' => '',
		'id' => $prefix . 'custom_audio_meta_box',
		'desc' => __('URL Audio',  'candidate'),
		'std' => '',
		'size' => '30',
		'class' => 'noborder',
		'type' => 'text'
	)

);
new meta_boxes_generator($config_audio,$options_audio);









//////////////////////////slideshow//////////////////////////////////////////////////////////////////////////////////////////////////////
$config_slideshow = array(
	'title' => __('Slide Options', 'candidate'),
	'id' => $prefix . 'slideshow_meta_box',
	'pages' => array('slideshow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options_slideshow = array(

	array(
		'name' => '',
		'id' => $prefix . 'slideshow_btn_url_meta_box',
		'desc' => __('Button URL',  'candidate'),
		'std' => '',
		'size' => '50',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'slideshow_btn_meta_box',
		'desc' => __('Button Text',  'candidate'),
		'std' => '',
		'size' => '50',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'slideshow_btn_pos_meta_box',
		'desc' => __('Position',  'candidate'),
		'std' => '',
		'options' => array('align-left' => 'Left','align-right' => 'Right','align-center' => 'Center' ),
		'class' => '',
		'type' => 'select'
	)
	
);

new meta_boxes_generator($config_slideshow,$options_slideshow);






///////////////////////team//////////////////////////////////////////////////////////////////////////////////////////
$config_team = array(
	'title' => __('Team Options', 'candidate'),
	'id' => $prefix . 'team_meta_box',
	'pages' => array('team_members'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options_team = array(

	array(
		'name' => '',
		'id' => $prefix . 'team_social_show_meta_box',
		'desc' => __('Show Social Block',  'candidate'),
		'std' => '',
		'options' => array('show' => 'show','hide' => 'hide' ),
		'class' => '',
		'type' => 'select'
	),
	array(
		'name' => '',
		'id' => $prefix . 'team_share_show_meta_box',
		'desc' => __('Show Share Block',  'candidate'),
		'std' => '',
		'options' => array('show' => 'show','hide' => 'hide' ),
		'class' => '',
		'type' => 'select'
	),
	array(
		'name' => '',
		'id' => $prefix . 'team_job_meta_box',
		'desc' => __('Job',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'team_facebook_meta_box',
		'desc' => __('Facebook Link',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'team_twitter_meta_box',
		'desc' => __('Twitter Link',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'team_google_meta_box',
		'desc' => __('Google+ Link',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'team_youtube_meta_box',
		'desc' => __('Youtube Link',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'team_flickr_meta_box',
		'desc' => __('Flickr Link',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	),
	
	array(
		'name' => '',
		'id' => $prefix . 'team_instagram_meta_box',
		'desc' => __('Instagram Link',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	),
	
	array(
		'name' => '',
		'id' => $prefix . 'team_linkedin_meta_box',
		'desc' => __('LinkedIn Link',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	),
	
	array(
		'name' => '',
		'id' => $prefix . 'team_mail_meta_box',
		'desc' => __('Mail Link',  'candidate'),
		'std' => '',
		'class' => 'new_position',
		'size' => '50',
		'type' => 'text'
	)
);

new meta_boxes_generator($config_team,$options_team);




//////////////////////////testimonial//////////////////////////////////////////////////////////
$config_testimonial = array(
	'title' => __('testimonial Options', 'candidate'),
	'id' => $prefix . 'testimonial_meta_box',
	'pages' => array('testimonial'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_testimonial = array(
	array(
		'name' => '',
		'id' => $prefix . 'address_testimonial_meta_box',
		'desc' => __('Address',  'candidate'),
		'std' => '',
		'size' => '30',
		'class' => 'noborder',
		'type' => 'text'
	)

);
new meta_boxes_generator($config_testimonial,$options_testimonial);


$icon_arr_meta = candidat_custom_fontello_classes();

//////////////////////////issues////////////////////////////////////////////////////////////////////////////////////////
$config_issues = array(
	'title' => __('issues Options', 'candidate'),
	'id' => $prefix . 'issues_meta_box',
	'pages' => array('issues'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_issues = array(
	array(
		'name' => '',
		'id' => $prefix . 'issues_icon_meta_box',
		'desc' => __('Type Icon',  'candidate'),
		'options' => $icon_arr_meta,
		'class' => 'noborder',
		'type' => 'select'
	)

);
new meta_boxes_generator($config_issues,$options_issues);


////////////////////portfolio//////////////////////////////////////////////////////////////////

$config_portfolio = array(
	'title' => __('Options Portfolio', 'candidate'),
	'id' => $prefix . 'blog_portfolio_meta_box',
	'pages' => array('portfolio_post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_portfolio = array(
	array(
		'name' => __('URL Project', 'candidate'),
		'id' => $prefix . 'portfolio_link_meta_box',
		'desc' => '',
		'std' => '',
		'size' => '30',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'target_portfolio_post_meta_box',
		'desc' => __('New Tab/Window',  'candidate'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'checkbox'
	),
	array(
		'name' => '',
		'id' => $prefix . 'extended_meta_box',
		'desc' => __('Extended',  'candidate'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'checkbox'
	),
	array(
		'name' => '',
		'id' => $prefix . 'portfolio_post_type',
		'desc' => __('Type Portfolio ',  'candidate'),
		'std' => 'image',
		'options' => array('image' => 'featured image','gallery' => 'gallery','video' => 'video' ),
		'class' => 'portfolio_type_title',
		'type' => 'select'
	),
	array(
		'name' => '',
		'id' => $prefix . 'portfolio_video_type',
		'desc' => __('Type Video ',  'candidate'),
		'std' => 'image',
		'options' => array('vimeo' => 'vimeo','youtube' => 'youtube','html5' => 'html5' ),
		'class' => 'portfolio_video_select',
		'type' => 'select'
	),
	array(
		'name' => '',
		'id' => $prefix . 'portfolio_post_video',
		'desc' => __('URL Video',  'candidate'),
		'std' => '',
		'size' => '30',
		'class' => 'portfolio_video_url',
		'type' => 'text'
	),
	
	array(
			'desc' => '<strong>'. __('NOTE: Click the Add Images button to upload the images to this post. You can drag-and-drop images to re-order them.', 'candidate') .'</strong><br />',
			'id' => $prefix . 'portfolio_post_gallery',
			'button' => __('Add Images', 'candidate'),
			'class' => 'portfolio_gallery_block',
			'type' => 'upload_images'
	)

	
);

new meta_boxes_generator($config_portfolio,$options_portfolio);




















//////////////////////////events///////////////////////////////////////////////////////////////
$config_events = array(
	'title' => __('Events Options', 'candidate'),
	'id' => $prefix . 'events_meta_box',
	'pages' => array('tribe_events'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_events = array(
	array(
		'name' => '',
		'id' => $prefix . 'events_type_meta_box',
		'desc' => __('Style Event  ',  'candidate'),
		'std' => 'style1',
		'options' => array('style1' => 'style1 with full map','style12' => 'style1 with boxed map','style2' => 'style2' ),
		'class' => 'noborder',
		'type' => 'select'
	)

);
new meta_boxes_generator($config_events,$options_events);



//////////////////////////campaign////////////////////////////////////////////////////////////////////////////////////////
$config_events = array(
	'title' => __('Campaign Options', 'candidate'),
	'id' => $prefix . 'campaign_meta_box',
	'pages' => array('campaign'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_events = array(
	array(
		'name' => '',
		'id' => $prefix . 'campaign_text_meta_box',
		'desc' => __('Main Title',  'candidate'),
		'std' => '',
		'size' => '50',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'campaign_btn_url_meta_box',
		'desc' => __('Button URL',  'candidate'),
		'std' => '',
		'size' => '50',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'campaign_btn_meta_box',
		'desc' => __('Button Text',  'candidate'),
		'std' => '',
		'size' => '50',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'campaign_date_meta_box',
		'desc' => __('Campaign Date',  'candidate'),
		'std' => '',
		'class' => 'noborder',
		'size' => '50',
		'type' => 'text'
	)

);
new meta_boxes_generator($config_events,$options_events);









//////////////////////////page_portfolio////////////////////////////////////////////////////////////////////////////////////////
$config_page_portfolio = array(
	'title' => __('Page Portfolio Options', 'candidate'),
	'id' => $prefix . 'page_portfolio_meta_box',
	'pages' => array('page'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_page_portfolio = array(
	array(
		'name' => '',
		'id' => $prefix . 'cat_page_portfolio_meta_box',
		'desc' => __('Choose the category for portfolio page',  'candidate'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'select',
		'target' => 'catportfolio'
	)

);
new meta_boxes_generator($config_page_portfolio,$options_page_portfolio);








?>