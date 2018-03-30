<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Post Options Functions
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_global_blog_post_layout = (isset($cmsms_option[CMSMS_SHORTNAME . '_blog_post_layout']) && $cmsms_option[CMSMS_SHORTNAME . '_blog_post_layout'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_blog_post_layout'] : 'r_sidebar';
$cmsms_global_top_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_top_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_top_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_top_sidebar'] == 1) ? 'true' : 'false') : 'false';
$cmsms_global_middle_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar'] == 1) ? 'true' : 'false') : 'false';
$cmsms_global_bottom_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_blog_post_share_box = (isset($cmsms_option[CMSMS_SHORTNAME . '_blog_post_share_box']) && $cmsms_option[CMSMS_SHORTNAME . '_blog_post_share_box'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_blog_post_share_box'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_blog_post_author_box = (isset($cmsms_option[CMSMS_SHORTNAME . '_blog_post_author_box']) && $cmsms_option[CMSMS_SHORTNAME . '_blog_post_author_box'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_blog_post_author_box'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_seo = (isset($cmsms_option[CMSMS_SHORTNAME . '_seo']) && $cmsms_option[CMSMS_SHORTNAME . '_seo'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_seo'] == 1) ? true : false) : false;


if (isset($cmsms_option[CMSMS_SHORTNAME . '_blog_more_posts_box']) && $cmsms_option[CMSMS_SHORTNAME . '_blog_more_posts_box'] !== '') {
	$cmsms_global_blog_more_posts_box = array();
	
	foreach($cmsms_option[CMSMS_SHORTNAME . '_blog_more_posts_box'] as $key => $val) {
		if ($val == 'true') {
			$cmsms_global_blog_more_posts_box[] = $key;
		}
	}
} else {
	$cmsms_global_blog_more_posts_box = array( 
		'related', 
		'popular', 
		'recent' 
	);
}


$cmsms_option_name = 'cmsms_post_';


$tabs_array = array();


$tabs_array['cmsms_post'] = array( 
	'label' => __('Post', 'cmsmasters'), 
	'value'	=> 'cmsms_post' 
);


$tabs_array['cmsms_layout'] = array( 
	'label' => __('Layout', 'cmsmasters'), 
	'value'	=> 'cmsms_layout' 
);


$tabs_array['cmsms_bg'] = array( 
	'label' => __('Background', 'cmsmasters'), 
	'value'	=> 'cmsms_bg' 
);


$tabs_array['cmsms_heading'] = array( 
	'label' => __('Heading', 'cmsmasters'), 
	'value'	=> 'cmsms_heading' 
);


$tabs_array['cmsms_breadcrumbs'] = array( 
	'label' => __('Breadcrumbs', 'cmsmasters'), 
	'value'	=> 'cmsms_breadcrumbs' 
);


$tabs_array['cmsms_slider'] = array( 
	'label' => __('Slider', 'cmsmasters'), 
	'value'	=> 'cmsms_slider' 
);


if ($cmsms_global_seo) {
	$tabs_array['cmsms_seo'] = array( 
		'label' => __('SEO', 'cmsmasters'), 
		'value'	=> 'cmsms_seo' 
	);
}


$custom_post_meta_fields = array( 
	array( 
		'id'	=> 'cmsms_post_aside', 
		'type'	=> 'content_start', 
		'box'	=> 'true', 
		'hide'	=> 'true' 
	), 
	array( 
		'label'	=> __('Aside Text', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'aside_text', 
		'type'	=> 'textarea', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_post_aside', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> 'cmsms_post_quote', 
		'type'	=> 'content_start', 
		'box'	=> 'true', 
		'hide'	=> 'true' 
	), 
	array( 
		'label'	=> __('Quote Text', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'quote_text', 
		'type'	=> 'textarea', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Quote Author', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'quote_author', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_post_quote', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> 'cmsms_post_link', 
		'type'	=> 'content_start', 
		'box'	=> 'true', 
		'hide'	=> 'true' 
	), 
	array( 
		'label'	=> __('Link Text', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'link_text', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Link Address', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'link_address', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_post_link', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> 'cmsms_post_image', 
		'type'	=> 'content_start', 
		'box'	=> 'true', 
		'hide'	=> 'true' 
	), 
	array( 
		'label'	=> __('Post Image', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'image_link', 
		'type'	=> 'image', 
		'hide'	=> '', 
		'cancel' => 'true', 
		'std'	=> get_template_directory_uri() . '/framework/admin/inc/img/image.png' 
	), 
	array( 
		'id'	=> 'cmsms_post_image', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> 'cmsms_post_gallery', 
		'type'	=> 'content_start', 
		'box'	=> 'true', 
		'hide'	=> 'true' 
	), 
	array( 
		'label'	=> __('Post Images', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'images', 
		'type'	=> 'images_list', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_post_gallery', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> 'cmsms_post_video', 
		'type'	=> 'content_start', 
		'box'	=> 'true', 
		'hide'	=> 'true' 
	), 
	array( 
		'label'	=> __('Video Type', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'video_type', 
		'type'	=> 'radio', 
		'hide'	=> '', 
		'std'	=> 'embeded', 
		'options' => array( 
			'embeded' => array( 
				'label' => __('Embedded (YouTube, Vimeo)', 'cmsmasters'), 
				'value'	=> 'embeded' 
			), 
			'selfhosted' => array( 
				'label' => __('Self-Hosted', 'cmsmasters'), 
				'value'	=> 'selfhosted' 
			) 
		) 
	), 
	array( 
		'label'	=> __('Embedded Video Link', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'video_link', 
		'type'	=> 'text', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Self-Hosted Video Links', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'video_links', 
		'type'	=> 'repeatable_media', 
		'hide'	=> 'true', 
		'std'	=> '', 
		'media'	=> array( 
			'mp4' => 'mp4 / m4v &nbsp;', 
			'ogg' => 'ogg / ogv &nbsp;', 
			'webm' => 'webm / webmv &nbsp;' 
		) 
	), 
	array( 
		'id'	=> 'cmsms_post_video', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> 'cmsms_post_audio', 
		'type'	=> 'content_start', 
		'box'	=> 'true', 
		'hide'	=> 'true' 
	), 
	array( 
		'label'	=> __('Audio Links', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'audio_links', 
		'type'	=> 'repeatable_media', 
		'hide'	=> '', 
		'std'	=> '', 
		'media'	=> array( 
			'mp3' => 'mp3 / mp4 / m4v &nbsp;', 
			'ogg' => 'ogg / oga &nbsp;', 
			'webm' => 'webm / webma &nbsp;', 
			'wav' => 'wav &nbsp;' 
		) 
	), 
	array( 
		'id'	=> 'cmsms_post_audio', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> 'cmsms_post_format', 
		'type'	=> 'content_start', 
		'box'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_post_format', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> $cmsms_option_name . 'tabs', 
		'type'	=> 'tabs', 
		'std'	=> 'cmsms_post', 
		'options' => $tabs_array 
	), 
	array( 
		'id'	=> 'cmsms_post', 
		'type'	=> 'tab_start', 
		'std'	=> 'true' 
	), 
	array( 
		'label'	=> __("'Read More' Button Text", 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'read_more', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> __('Read More', 'cmsmasters') 
	), 
	array( 
		'label'	=> __('Featured Image as Cover', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'featured_image_show', 
		'type'	=> 'checkbox', 
		'hide'	=> 'true', 
		'std'	=> 'true' 
	),
	array( 
		'label'	=> __('Sharing Box', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'sharing_box', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_blog_post_share_box 
	), 
	array( 
		'label'	=> __('About Author Box', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'author_box', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_blog_post_author_box 
	), 
	array( 
		'label'	=> __('More Posts Box', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'more_posts', 
		'type'	=> 'checkbox_group', 
		'hide'	=> '', 
		'std'	=> ((isset($_GET['post']) && get_post_meta($_GET['post'], 'cmsms_heading', true)) ? '' : $cmsms_global_blog_more_posts_box), 
		'options' => array( 
			'related' => array( 
				'label' => 'Show Related Tab', 
				'value'	=> 'related' 
			), 
			'popular' => array( 
				'label' => 'Show Popular Tab', 
				'value'	=> 'popular' 
			), 
			'recent' => array( 
				'label' => 'Show Recent Tab', 
				'value'	=> 'recent' 
			) 
		) 
	), 
	array( 
		'id'	=> 'cmsms_post', 
		'type'	=> 'tab_finish' 
	), 
	array( 
		'id'	=> 'cmsms_layout', 
		'type'	=> 'tab_start', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Page Layout', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_layout', 
		'type'	=> 'radio_img', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_blog_post_layout, 
		'options' => array( 
			'r_sidebar' => array( 
				'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg', 
				'label' => __('Right Sidebar', 'cmsmasters'), 
				'value'	=> 'r_sidebar' 
			), 
			'l_sidebar' => array( 
				'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg', 
				'label' => __('Left Sidebar', 'cmsmasters'), 
				'value'	=> 'l_sidebar' 
			), 
			'fullwidth' => array( 
				'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg', 
				'label' => __('Full Width', 'cmsmasters'), 
				'value'	=> 'fullwidth' 
			) 
		) 
	), 
	array( 
		'label'	=> __('Choose Right\Left Sidebar', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_sidebar_id', 
		'type'	=> 'select_sidebar', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Top Sidebar', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> 'cmsms_top_sidebar', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_top_sidebar 
	), 
	array( 
		'label'	=> __('Choose Top Sidebar', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_top_sidebar_id', 
		'type'	=> 'select_sidebar', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Middle Sidebar', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> 'cmsms_middle_sidebar', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_middle_sidebar 
	), 
	array( 
		'label'	=> __('Choose Middle Sidebar', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_middle_sidebar_id', 
		'type'	=> 'select_sidebar', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Bottom Sidebar', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> 'cmsms_bottom_sidebar', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_bottom_sidebar 
	), 
	array( 
		'label'	=> __('Choose Bottom Sidebar', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_bottom_sidebar_id', 
		'type'	=> 'select_sidebar', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_layout', 
		'type'	=> 'tab_finish' 
	) 
);


function add_custom_post_meta_box() {
    add_meta_box( 
		'cmsms_post_meta_box', 
		'Cmsmasters' . ' ' . __('Post Options', 'cmsmasters'), 
		'show_cmsms_meta_box', 
		'post', 
		'normal', 
		'high' 
	);
}

add_action('add_meta_boxes', 'add_custom_post_meta_box');

