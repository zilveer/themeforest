<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Admin Panel Portfolio Options
 * Created by CMSMasters
 * 
 */


function cmsms_options_testimonial_tabs() {
	$tabs = array();
	
	$tabs['t_page'] = __('Page', 'cmsmasters');
	$tabs['t_post'] = __('Post', 'cmsmasters');
	
	return $tabs;
}


function cmsms_options_testimonial_sections() {
	$tab = cmsms_get_the_tab();
	
	switch ($tab) {
	case 't_page':
		$sections = array();
		
		$sections['t_page_section'] = __('Testimonials Page Options', 'cmsmasters');
		
		break;
	case 't_post':
		$sections = array();
		
		$sections['t_post_section'] = __('Testimonial Post Options', 'cmsmasters');
		
		break;
	}
	
	return $sections;
} 


function cmsms_options_testimonial_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = cmsms_get_the_tab();
	}
	
	$options = array();
	
	switch ($tab) {
	case 't_page':
		$options[] = array( 
			'section' => 't_page_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_page_author_avatar', 
			'title' => __('Testimonial Author Avatar', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_page_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_page_author_descr', 
			'title' => __('Testimonial Author Description', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_page_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_page_date', 
			'title' => __('Testimonial Date', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_page_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_page_cat', 
			'title' => __('Testimonial Categories', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_page_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_page_comment', 
			'title' => __('Testimonial Comments', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_page_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_page_more', 
			'title' => __('Read More', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		break;
	case 't_post':
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_layout', 
			'title' => __('Layout Type', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio_img', 
			'std' => 'r_sidebar', 
			'choices' => array( 
				__('Right Sidebar', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				__('Left Sidebar', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				__('Full Width', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_author_avatar', 
			'title' => __('Testimonial Author Avatar', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_author_descr', 
			'title' => __('Testimonial Author Description', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_date', 
			'title' => __('Testimonial Date', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_cat', 
			'title' => __('Testimonial Categories', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_comment', 
			'title' => __('Testimonial Comments', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_like', 
			'title' => __('Testimonial Like', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_nav_box', 
			'title' => __('Testimonials Navigation Box', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_share_box', 
			'title' => __('Sharing Box', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_more_testimonials_box', 
			'title' => __('More Testimonials Box', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'multi-checkbox', 
			'std' => array( 
				'popular' => 'true', 
				'recent' => 'true' 
			), 
			'choices' => array( 
				__('Show Popular Tab', 'cmsmasters') . '|popular', 
				__('Show Recent Tab', 'cmsmasters') . '|recent' 
			) 
		);
		
		$options[] = array( 
			'section' => 't_post_section', 
			'id' => CMSMS_SHORTNAME . '_testimonial_post_p_l_number', 
			'title' => __('Popular & Latest Testimonials Boxes Items Number', 'cmsmasters'), 
			'desc' => __('testimonials', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '4' 
		);
		
		break;
	}
	
	return $options;	
}

