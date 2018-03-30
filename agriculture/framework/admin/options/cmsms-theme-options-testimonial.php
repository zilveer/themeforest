<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Testimonial Options Functions
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_global_testimonial_post_layout = (isset($cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_layout']) && $cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_layout'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_layout'] : 'r_sidebar';
$cmsms_global_top_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_top_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_top_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_top_sidebar'] == 1) ? 'true' : 'false') : 'false';
$cmsms_global_middle_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_middle_sidebar'] == 1) ? 'true' : 'false') : 'false';
$cmsms_global_bottom_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_testimonial_post_share_box = (isset($cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_share_box']) && $cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_share_box'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_share_box'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_seo = (isset($cmsms_option[CMSMS_SHORTNAME . '_seo']) && $cmsms_option[CMSMS_SHORTNAME . '_seo'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_seo'] == 1) ? true : false) : false;


if (isset($cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_more_testimonials_box']) && $cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_more_testimonials_box'] !== '') {
	$cmsms_global_testimonial_post_more_testimonials_box = array();
	
	foreach($cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_more_testimonials_box'] as $key => $val) {
		if ($val == 'true') {
			$cmsms_global_testimonial_post_more_testimonials_box[] = $key;
		}
	}
} else {
	$cmsms_global_testimonial_post_more_testimonials_box = array( 
		'popular', 
		'recent' 
	);
}


$cmsms_option_name = 'cmsms_testimonial_';


$tabs_array = array();


$tabs_array['cmsms_testimonial'] = array( 
	'label' => __('Testimonial', 'cmsmasters'), 
	'value'	=> 'cmsms_testimonial' 
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


$custom_testimonial_meta_fields = array( 
	array( 
		'id'	=> $cmsms_option_name . 'tabs', 
		'type'	=> 'tabs', 
		'std'	=> 'cmsms_testimonial', 
		'options' => $tabs_array 
	), 
	array( 
		'id'	=> 'cmsms_testimonial', 
		'type'	=> 'tab_start', 
		'std'	=> 'true' 
	), 
	array( 
		'label'	=> __('Author', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'author', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'value'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Author link', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'author_link', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'value'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Company', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'company', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'value'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __("'Read More' Button Text", 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'more', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> __('Read More', 'cmsmasters') 
	), 
	array( 
		'label'	=> __('Sharing Box', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'sharing_box', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_testimonial_post_share_box 
	), 
	array( 
		'label'	=> __('More Posts Box', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'more_posts', 
		'type'	=> 'checkbox_group', 
		'hide'	=> '', 
		'std'	=> ((isset($_GET['post']) && get_post_meta($_GET['post'], 'cmsms_heading', true)) ? '' : $cmsms_global_testimonial_post_more_testimonials_box), 
		'options' => array( 
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
		'label'	=> __('Page Layout', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_layout', 
		'type'	=> 'radio_img', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_testimonial_post_layout, 
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


function add_custom_testimonial_meta_box() {
    add_meta_box( 
		'cmsms_testimonial_meta_box', 
		'Cmsmasters' . ' ' . __('Testimonial Options', 'cmsmasters'), 
		'show_cmsms_meta_box', 
		'testimonial', 
		'normal', 
		'high' 
	);
}

add_action('add_meta_boxes', 'add_custom_testimonial_meta_box');

