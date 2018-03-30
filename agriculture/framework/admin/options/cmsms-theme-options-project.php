<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Project Options Functions
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_global_top_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_top_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_top_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_top_sidebar'] == 1) ? 'true' : 'false') : 'false';
$cmsms_global_middle_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar'] == 1) ? 'true' : 'false') : 'false';
$cmsms_global_bottom_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_portfolio_project_share_box = (isset($cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_share_box']) && $cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_share_box'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_share_box'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_portfolio_project_author_box = (isset($cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_author_box']) && $cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_author_box'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_author_box'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_seo = (isset($cmsms_option[CMSMS_SHORTNAME . '_seo']) && $cmsms_option[CMSMS_SHORTNAME . '_seo'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_seo'] == 1) ? true : false) : false;


if (isset($cmsms_option[CMSMS_SHORTNAME . '_portfolio_more_projects_box']) && $cmsms_option[CMSMS_SHORTNAME . '_portfolio_more_projects_box'] !== '') {
	$cmsms_global_portfolio_more_projects_box = array();
	
	foreach($cmsms_option[CMSMS_SHORTNAME . '_portfolio_more_projects_box'] as $key => $val) {
		if ($val == 'true') {
			$cmsms_global_portfolio_more_projects_box[] = $key;
		}
	}
} else {
	$cmsms_global_portfolio_more_projects_box = array( 
		'related', 
		'popular', 
		'recent' 
	);
}


$cmsms_option_name = 'cmsms_project_';


$tabs_array = array();


$tabs_array['cmsms_project'] = array( 
	'label' => __('Project', 'cmsmasters'), 
	'value'	=> 'cmsms_project' 
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


$custom_project_meta_fields = array( 
	array( 
		'id'	=> 'cmsms_project_images', 
		'type'	=> 'content_start', 
		'box'	=> 'true', 
		'hide'	=> 'true' 
	), 
	array( 
		'label'	=> __('Project Images', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'images', 
		'type'	=> 'images_list', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Number of Columns', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'columns', 
		'type'	=> 'radio', 
		'hide'	=> 'true', 
		'std'	=> 'three', 
		'options' => array( 
			'four' => array( 
				'label' => __('Four', 'cmsmasters'), 
				'value'	=> 'four' 
			), 
			'three' => array( 
				'label' => __('Three', 'cmsmasters'), 
				'value'	=> 'three' 
			), 
			'two' => array( 
				'label' => __('Two', 'cmsmasters'), 
				'value'	=> 'two' 
			), 
			'one' => array( 
				'label' => __('One', 'cmsmasters'), 
				'value'	=> 'one' 
			) 
		) 
	),
	array( 
		'id'	=> 'cmsms_project_images', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> 'cmsms_project_video', 
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
		'type'	=> 'text_long', 
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
		'id'	=> 'cmsms_project_video', 
		'type'	=> 'content_finish' 
	), 
	array( 
		'id'	=> $cmsms_option_name . 'tabs', 
		'type'	=> 'tabs', 
		'std'	=> 'cmsms_project', 
		'options' => $tabs_array 
	), 
	array( 
		'id'	=> 'cmsms_project', 
		'type'	=> 'tab_start', 
		'std'	=> 'true' 
	), 
	array( 
		'label'	=> __("'Read More' Button Text", 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'more', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Project Format', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'format', 
		'type'	=> 'radio', 
		'hide'	=> '', 
		'std'	=> 'slider', 
		'options' => array( 
			'slider' => array( 
				'label' => __('Slider', 'cmsmasters'), 
				'value'	=> 'slider' 
			), 
			'album' => array( 
				'label' => __('Album', 'cmsmasters'), 
				'value'	=> 'album' 
			), 
			'video' => array( 
				'label' => __('Video', 'cmsmasters'), 
				'value'	=> 'video' 
			) 
		) 
	), 
	array( 
		'label'	=> __('Featured Image as Cover', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'featured_image_show', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Project Features', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'features', 
		'type'	=> 'repeatable_multiple', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __("Project Link Button Text", 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'pj_link_text', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> __('Click Here', 'cmsmasters') 
	), 
	array( 
		'label'	=> __("Project Link Button URL", 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'pj_link_url', 
		'type'	=> 'text_long', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __("Project Link Target", 'cmsmasters'), 
		'desc'	=> __('Open link in a new tab', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'pj_link_target', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> 'true' 
	), 
	array( 
		'label'	=> __('Sharing Box', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'sharing_box', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_portfolio_project_share_box 
	), 
	array( 
		'label'	=> __('About Author Box', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'author_box', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_portfolio_project_author_box 
	), 
	array( 
		'label'	=> __('More Posts Box', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'more_posts', 
		'type'	=> 'checkbox_group', 
		'hide'	=> '', 
		'std'	=> ((isset($_GET['post']) && get_post_meta($_GET['post'], 'cmsms_heading', true)) ? '' : $cmsms_global_portfolio_more_projects_box), 
		'options' => array( 
			'related' => array( 
				'label' => __('Show Related Tab', 'cmsmasters'),
				'value'	=> 'related' 
			), 
			'popular' => array( 
				'label' => __('Show Popular Tab', 'cmsmasters'),
				'value'	=> 'popular' 
			), 
			'recent' => array( 
				'label' => __('Show Recent Tab', 'cmsmasters'),
				'value'	=> 'recent' 
			) 
		) 
	), 
	array( 
		'id'	=> 'cmsms_project', 
		'type'	=> 'tab_finish' 
	), 
	array( 
		'id'	=> 'cmsms_layout', 
		'type'	=> 'tab_start', 
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


function add_custom_project_meta_box() {
    add_meta_box( 
		'cmsms_project_meta_box', 
		'Cmsmasters' . ' ' . __('Project Options', 'cmsmasters'), 
		'show_cmsms_meta_box', 
		'project', 
		'normal', 
		'high' 
	);
}

add_action('add_meta_boxes', 'add_custom_project_meta_box');

