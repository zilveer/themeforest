<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Post, Page & Project General Options
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_global_bg_col = (isset($cmsms_option[CMSMS_SHORTNAME . '_bg_col']) && $cmsms_option[CMSMS_SHORTNAME . '_bg_col'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_bg_col'] : '#0b7104';
$cmsms_global_bg_img_enable = (isset($cmsms_option[CMSMS_SHORTNAME . '_bg_img_enable']) && $cmsms_option[CMSMS_SHORTNAME . '_bg_img_enable'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_bg_img_enable'] == 1) ? 'true' : 'false') : 'true';
$cmsms_global_bg_img = (isset($cmsms_option[CMSMS_SHORTNAME . '_bg_img']) && $cmsms_option[CMSMS_SHORTNAME . '_bg_img'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_bg_img'] : '';
$cmsms_global_bg_rep = (isset($cmsms_option[CMSMS_SHORTNAME . '_bg_rep']) && $cmsms_option[CMSMS_SHORTNAME . '_bg_rep'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_bg_rep'] : 'repeat';
$cmsms_global_bg_pos = (isset($cmsms_option[CMSMS_SHORTNAME . '_bg_pos']) && $cmsms_option[CMSMS_SHORTNAME . '_bg_pos'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_bg_pos'] : 'top center';
$cmsms_global_bg_att = (isset($cmsms_option[CMSMS_SHORTNAME . '_bg_att']) && $cmsms_option[CMSMS_SHORTNAME . '_bg_att'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_bg_att'] : 'scroll';
$cmsms_global_heading_bg_color = (isset($cmsms_option[CMSMS_SHORTNAME . '_heading_bg_color']) && $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_color'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_color'] : '#72bb2a';
$cmsms_global_heading_bg_image = (isset($cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image']) && $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'] : '';
$cmsms_global_breadcrumb = (isset($cmsms_option[CMSMS_SHORTNAME . '_breadcrumb']) && $cmsms_option[CMSMS_SHORTNAME . '_breadcrumb'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_breadcrumb'] == 1) ? 'default' : 'disabled') : 'default';
$cmsms_global_seo = (isset($cmsms_option[CMSMS_SHORTNAME . '_seo']) && $cmsms_option[CMSMS_SHORTNAME . '_seo'] !== '') ? (($cmsms_option[CMSMS_SHORTNAME . '_seo'] == 1) ? true : false) : false;


$custom_general_meta_fields = array( 
	array( 
		'id'	=> 'cmsms_bg', 
		'type'	=> 'tab_start', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Background', 'cmsmasters'), 
		'desc'	=> __('Use Default', 'cmsmasters'), 
		'id'	=> 'cmsms_bg_default', 
		'type'	=> 'checkbox', 
		'hide'	=> '', 
		'std'	=> 'true' 
	), 
	array( 
		'label'	=> __('Background Color', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_bg_col', 
		'type'	=> 'color', 
		'hide'	=> 'true', 
		'std'	=> $cmsms_global_bg_col 
	), 
	array( 
		'label'	=> __('Background Image Visibility', 'cmsmasters'), 
		'desc'	=> __('Show', 'cmsmasters'), 
		'id'	=> 'cmsms_bg_img_enable', 
		'type'	=> 'checkbox', 
		'hide'	=> 'true', 
		'std'	=> $cmsms_global_bg_img_enable 
	), 
	array( 
		'label'	=> __('Background Image', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_bg_img', 
		'type'	=> 'image', 
		'hide'	=> 'true', 
		'cancel' => '', 
		'std'	=> $cmsms_global_bg_img 
	), 
	array( 
		'label'	=> __('Background Repeat', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_bg_rep', 
		'type'	=> 'radio', 
		'hide'	=> 'true', 
		'std'	=> $cmsms_global_bg_rep, 
		'options' => array( 
			'no-repeat' => array( 
				'label' => __('No Repeat', 'cmsmasters'), 
				'value'	=> 'no-repeat' 
			), 
			'repeat-x' => array( 
				'label' => __('Repeat Horizontally', 'cmsmasters'), 
				'value'	=> 'repeat-x' 
			), 
			'repeat-y' => array( 
				'label' => __('Repeat Vertically', 'cmsmasters'), 
				'value'	=> 'repeat-y' 
			), 
			'repeat' => array( 
				'label' => __('Repeat', 'cmsmasters'), 
				'value'	=> 'repeat' 
			) 
		) 
	), 
	array( 
		'label'	=> __('Background Position', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_bg_pos', 
		'type'	=> 'select', 
		'hide'	=> 'true', 
		'std'	=> $cmsms_global_bg_pos, 
		'options' => array( 
			'top left' => array( 
				'label' => __('Top Left', 'cmsmasters'), 
				'value'	=> 'top left' 
			), 
			'top center' => array( 
				'label' => __('Top Center', 'cmsmasters'), 
				'value'	=> 'top center' 
			), 
			'top right' => array( 
				'label' => __('Top Right', 'cmsmasters'), 
				'value'	=> 'top right' 
			), 
			'center left' => array( 
				'label' => __('Center Left', 'cmsmasters'), 
				'value'	=> 'center left' 
			), 
			'center center' => array( 
				'label' => __('Center Center', 'cmsmasters'), 
				'value'	=> 'center center' 
			), 
			'center right' => array( 
				'label' => __('Center Right', 'cmsmasters'), 
				'value'	=> 'center right' 
			), 
			'bottom left' => array( 
				'label' => __('Bottom Left', 'cmsmasters'), 
				'value'	=> 'bottom left' 
			), 
			'bottom center' => array( 
				'label' => __('Bottom Center', 'cmsmasters'), 
				'value'	=> 'bottom center' 
			), 
			'bottom right' => array( 
				'label' => __('Bottom Right', 'cmsmasters'), 
				'value'	=> 'bottom right' 
			) 
		) 
	), 
	array( 
		'label'	=> __('Background Attachment', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_bg_att', 
		'type'	=> 'radio', 
		'hide'	=> 'true', 
		'std'	=> $cmsms_global_bg_att, 
		'options' => array( 
			'scroll' => array( 
				'label' => __('Scroll', 'cmsmasters'), 
				'value'	=> 'scroll' 
			), 
			'fixed' => array( 
				'label' => __('Fixed', 'cmsmasters'), 
				'value'	=> 'fixed' 
			) 
		) 
	), 
	array( 
		'id'	=> 'cmsms_bg', 
		'type'	=> 'tab_finish' 
	), 
	array( 
		'id'	=> 'cmsms_heading', 
		'type'	=> 'tab_start', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Heading', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_heading', 
		'type'	=> 'radio', 
		'hide'	=> '', 
		'std'	=> 'default', 
		'options' => array( 
			'default' => array( 
				'label' => __('Default', 'cmsmasters'), 
				'value'	=> 'default' 
			), 
			'custom' => array( 
				'label' => __('Custom', 'cmsmasters'), 
				'value'	=> 'custom' 
			), 
			'parallax' => array( 
				'label' => __('Parallax Heading', 'cmsmasters'), 
				'value'	=> 'parallax' 
			), 
			'disabled' => array( 
				'label' => __('Disabled', 'cmsmasters'), 
				'value'	=> 'disabled' 
			) 
		) 
	), 
	array( 
		'label'	=> __('Heading Title', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_heading_title', 
		'type'	=> 'text', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Heading Subtitle', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_heading_subtitle', 
		'type'	=> 'textarea', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Heading Background Color', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_heading_bg_col', 
		'type'	=> 'color', 
		'hide'	=> 'true', 
		'std'	=> $cmsms_global_heading_bg_color 
	), 
	array( 
		'label'	=> __('Heading Background Color Opacity', 'cmsmasters'), 
		'desc'	=> __('percentage value', 'cmsmasters'), 
		'id'	=> 'cmsms_heading_bg_col_opac', 
		'type'	=> 'number', 
		'hide'	=> 'true', 
		'std'	=> '50' 
	), 
	array( 
		'label'	=> __('Heading Background Image', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_heading_bg_img', 
		'type'	=> 'image', 
		'hide'	=> 'true', 
		'cancel' => '', 
		'std'	=> $cmsms_global_heading_bg_image 
	), 
	array( 
		'id'	=> 'cmsms_heading', 
		'type'	=> 'tab_finish' 
	), 
	array( 
		'id'	=> 'cmsms_breadcrumbs', 
		'type'	=> 'tab_start', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Breadcrumbs', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_breadcrumbs', 
		'type'	=> 'radio', 
		'hide'	=> '', 
		'std'	=> $cmsms_global_breadcrumb, 
		'options' => array( 
			'default' => array( 
				'label' => __('Default', 'cmsmasters'), 
				'value'	=> 'default' 
			), 
			'custom' => array( 
				'label' => __('Custom', 'cmsmasters'), 
				'value'	=> 'custom' 
			), 
			'disabled' => array( 
				'label' => __('Disabled', 'cmsmasters'), 
				'value'	=> 'disabled' 
			) 
		) 
	), 
	array( 
		'label'	=> __('Custom Breadcrumbs', 'cmsmasters'),
		'desc'	=> '', 
		'id'	=> 'cmsms_custom_breadcrumbs', 
		'type'	=> 'repeatable_link', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_breadcrumbs', 
		'type'	=> 'tab_finish' 
	), 
	array( 
		'id'	=> 'cmsms_slider', 
		'type'	=> 'tab_start', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Slider', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_slider', 
		'type'	=> 'radio', 
		'hide'	=> '', 
		'std'	=> 'disabled', 
		'options' => array( 
			'disabled' => array( 
				'label' => __('Disabled', 'cmsmasters'), 
				'value'	=> 'disabled' 
			), 
			'rev_slider' => array( 
				'label' => __('Revolution Slider', 'cmsmasters'), 
				'value'	=> 'rev_slider' 
			), 
			'lay_slider' => array( 
				'label' => __('Layer Slider', 'cmsmasters'), 
				'value'	=> 'lay_slider' 
			) 
		) 
	), 
	array( 
		'label'	=> __('Revolution Slider Shortcode', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_slider_rev_shortcode', 
		'type'	=> 'textcode', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Layer Slider Shortcode', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_slider_lay_shortcode', 
		'type'	=> 'textcode', 
		'hide'	=> 'true', 
		'std'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_slider', 
		'type'	=> 'tab_finish' 
	), 
	array( 
		'id'	=> 'cmsms_seo', 
		'type'	=> 'tab_start', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Title', 'cmsmasters'), 
		'desc'	=> __('We recommend you enter no more than 60 characters.', 'cmsmasters'), 
		'id'	=> 'cmsms_seo_title', 
		'type'	=> 'text', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Description', 'cmsmasters'), 
		'desc'	=> __('We recommend you enter no more than 160 characters.', 'cmsmasters'), 
		'id'	=> 'cmsms_seo_description', 
		'type'	=> 'textarea', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'label'	=> __('Keywords', 'cmsmasters'), 
		'desc'	=> '', 
		'id'	=> 'cmsms_seo_keywords', 
		'type'	=> 'textarea', 
		'hide'	=> '', 
		'std'	=> '' 
	), 
	array( 
		'id'	=> 'cmsms_seo', 
		'type'	=> 'tab_finish' 
	) 
);


$custom_meta_fields = $custom_general_meta_fields;

