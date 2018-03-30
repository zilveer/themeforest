<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.2.1
 * 
 * Profile Options Functions
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_global_bottom_sidebar = (isset($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar']) && $cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar'] == 1) ? 'true' : 'false') : 'true';

$cmsms_global_bottom_sidebar_layout = (isset($cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar_layout'])) ? $cmsms_option[CMSMS_SHORTNAME . '_bottom_sidebar_layout'] : '14141414';

$cmsms_global_profile_post_title = (isset($cmsms_option[CMSMS_SHORTNAME . '_profile_post_title']) && $cmsms_option[CMSMS_SHORTNAME . '_profile_post_title'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_profile_post_title'] == 1) ? 'true' : 'false') : 'true';

$cmsms_global_profile_post_details_title = (isset($cmsms_option[CMSMS_SHORTNAME . '_profile_post_details_title']) && $cmsms_option[CMSMS_SHORTNAME . '_profile_post_details_title'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_profile_post_details_title'] : __('Profile details', 'cmsmasters');

$cmsms_global_profile_post_share_box = (isset($cmsms_option[CMSMS_SHORTNAME . '_profile_post_share_box']) && $cmsms_option[CMSMS_SHORTNAME . '_profile_post_share_box'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_profile_post_share_box'] == 1) ? 'true' : 'false') : 'true';

$cmsms_global_bg = (isset($cmsms_option[CMSMS_SHORTNAME . '_theme_layout']) && $cmsms_option[CMSMS_SHORTNAME . '_theme_layout'] === 'boxed') ? true : false;


$cmsms_option_name = 'cmsms_profile_';


$tabs_array = array();


$tabs_array['cmsms_profile'] = array( 
	'label' => __('Profile', 'cmsmasters'), 
	'value'	=> 'cmsms_profile' 
);


$tabs_array['cmsms_layout'] = array( 
	'label' => __('Layout', 'cmsmasters'), 
	'value'	=> 'cmsms_layout' 
);


if ($cmsms_global_bg) {
	$tabs_array['cmsms_bg'] = array( 
		'label' => __('Background', 'cmsmasters'), 
		'value'	=> 'cmsms_bg' 
	);
}


$tabs_array['cmsms_heading'] = array( 
	'label' => __('Heading', 'cmsmasters'), 
	'value'	=> 'cmsms_heading' 
);


$custom_profile_meta_fields = array( 
	array( 
		'id'	=> $cmsms_option_name . 'tabs', 
		'type'	=> 'tabs', 
		'std'	=> 'cmsms_profile', 
		'options' => $tabs_array 
	), 
	array( 
		'id'	=> 'cmsms_profile', 
		'type'	=> 'tab_start', 
		'std'	=> 'true' 
	), 
	array( 
		'label'	=> __('Profile Title', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'title', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_profile_post_title 
	), 
	array( 
		'label'	=> __('Subtitle', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'subtitle', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Profile Details Title', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'details_title', 
		'type'	=> 'text_long', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_profile_post_details_title 
	), 
	array( 
		'label'	=> __('Social Icons', 'cmsmasters'), 
		'desc'	=> __('Add social icons for this profile', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'social', 
		'type'	=> 'social', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Profile Info', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'features', 
		'type'	=> 'repeatable_multiple', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Profile Features 1 Title', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'features_one_title', 
		'type'	=> 'text_long', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Profile Features 1', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'features_one', 
		'type'	=> 'repeatable_multiple', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Profile Features 2 Title', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'features_two_title', 
		'type'	=> 'text_long', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Profile Features 2', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'features_two', 
		'type'	=> 'repeatable_multiple', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Profile Features 3 Title', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'features_three_title', 
		'type'	=> 'text_long', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Profile Features 3', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> $cmsms_option_name . 'features_three', 
		'type'	=> 'repeatable_multiple', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Sharing Box', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> $cmsms_option_name . 'sharing_box', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_profile_post_share_box 
	), 
	array( 
		'id'	=> 'cmsms_profile', 
		'type'	=> 'tab_finish' 
	), 
	array( 
		'id'	=> 'cmsms_layout', 
		'type'	=> 'tab_start', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Page Color Scheme', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_page_scheme', 
		'type'	=> 'select_scheme', 
		'hide'	=> 'false', 
		'std'	=> 'default' 
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
		'label'	=> __('Choose Bottom Sidebar Layout', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_bottom_sidebar_layout', 
		'type'	=> 'select', 
		'hide'	=> 'true', 
		'std'	=> $cmsms_global_bottom_sidebar_layout, 
		'options' => array( 
			'11' => array( 
				'label' => '1/1',
				'value'	=> '11' 
			), 
			'1212' => array( 
				'label' => '1/2 + 1/2',
				'value'	=> '1212' 
			), 
			'1323' => array( 
				'label' => '1/3 + 2/3',
				'value'	=> '1323' 
			), 
			'2313' => array( 
				'label' => '2/3 + 1/3',
				'value'	=> '2313' 
			), 
			'1434' => array( 
				'label' => '1/4 + 3/4',
				'value'	=> '1434' 
			), 
			'3414' => array( 
				'label' => '3/4 + 1/4',
				'value'	=> '3414' 
			), 
			'131313' => array( 
				'label' => '1/3 + 1/3 + 1/3',
				'value'	=> '131313' 
			), 
			'121414' => array( 
				'label' => '1/2 + 1/4 + 1/4',
				'value'	=> '121414' 
			), 
			'141214' => array( 
				'label' => '1/4 + 1/2 + 1/4',
				'value'	=> '141214' 
			), 
			'141412' => array( 
				'label' => '1/4 + 1/4 + 1/2',
				'value'	=> '141412' 
			), 
			'14141414' => array( 
				'label' => '1/4 + 1/4 + 1/4 + 1/4',
				'value'	=> '14141414' 
			) 
		) 
	), 
	array( 
		'id'	=> 'cmsms_layout', 
		'type'	=> 'tab_finish' 
	) 
);

