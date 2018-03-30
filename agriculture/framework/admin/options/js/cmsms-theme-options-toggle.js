/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Post, Page, Project & Testimonial Options Toggles Scripts
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function () { 
	/* Post Format Fields Load */
	if (jQuery('#post-formats-select input.post-format:checked').val() === 'aside') {
		jQuery('#cmsms_post_aside').show();
	} else if (jQuery('#post-formats-select input.post-format:checked').val() === 'quote') {
		jQuery('#cmsms_post_quote').show();
	} else if (jQuery('#post-formats-select input.post-format:checked').val() === 'link') {
		jQuery('#cmsms_post_link').show();
	} else if (jQuery('#post-formats-select input.post-format:checked').val() === 'image') {
		jQuery('#cmsms_post_image').show();
		jQuery('#cmsms_post_featured_image_show').closest('tr').show();
	} else if (jQuery('#post-formats-select input.post-format:checked').val() === 'gallery') {
		jQuery('#cmsms_post_gallery').show();
		jQuery('#cmsms_post_featured_image_show').closest('tr').show();
	} else if (jQuery('#post-formats-select input.post-format:checked').val() === 'video') {
		jQuery('#cmsms_post_video').show();
		jQuery('#cmsms_post_featured_image_show').closest('tr').show();
		
		if (jQuery('input[name="cmsms_post_video_type"]:checked').val() === 'embeded') {
			jQuery('#cmsms_post_video_link').closest('tr').show();
		} else {
			jQuery('#cmsms_post_video_links-select').closest('tr').show();
		}
	} else if (jQuery('#post-formats-select input.post-format:checked').val() === 'audio') {
		jQuery('#cmsms_post_audio').show();
		jQuery('#cmsms_post_featured_image_show').closest('tr').show();
	} else {
		jQuery('#cmsms_post_featured_image_show').closest('tr').show();
	}
	
	/* Post Format Change */
	jQuery('#post-formats-select input.post-format').bind('change', function () { 
		if (jQuery(this).val() === 'aside') {
			jQuery('#cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio').hide();
			
			jQuery('#cmsms_post_featured_image_show').closest('tr').hide();
			
			jQuery('#cmsms_post_aside').show();
		} else if (jQuery(this).val() === 'quote') {
			jQuery('#cmsms_post_aside, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio').hide();
			
			jQuery('#cmsms_post_featured_image_show').closest('tr').hide();
			
			jQuery('#cmsms_post_quote').show();
		} else if (jQuery(this).val() === 'link') {
			jQuery('#cmsms_post_aside, #cmsms_post_quote, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio').hide();
			
			jQuery('#cmsms_post_featured_image_show').closest('tr').hide();
			
			jQuery('#cmsms_post_link').show();
		} else if (jQuery(this).val() === 'image') {
			jQuery('#cmsms_post_aside, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio').hide();
			
			jQuery('#cmsms_post_image').show();
			jQuery('#cmsms_post_featured_image_show').closest('tr').show();
		} else if (jQuery(this).val() === 'gallery') {
			jQuery('#cmsms_post_aside, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_video, #cmsms_post_audio').hide();
			
			jQuery('#cmsms_post_gallery').show();
			jQuery('#cmsms_post_featured_image_show').closest('tr').show();
		} else if (jQuery(this).val() === 'video') {
			jQuery('#cmsms_post_aside, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_audio').hide();
			
			jQuery('#cmsms_post_featured_image_show').closest('tr').show();
			jQuery('#cmsms_post_video').show();
			
			if (jQuery('input[name="cmsms_post_video_type"]:checked').val() === 'embeded') {
				jQuery('#cmsms_post_video_link').closest('tr').show();
			} else {
				jQuery('#cmsms_post_video_links-select').closest('tr').show();
			}
		} else if (jQuery(this).val() === 'audio') {
			jQuery('#cmsms_post_aside, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video').hide();
			
			jQuery('#cmsms_post_audio').show();
			jQuery('#cmsms_post_featured_image_show').closest('tr').show();
		} else {
			jQuery('#cmsms_post_aside, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio').hide();
			
			jQuery('#cmsms_post_featured_image_show').closest('tr').show();
		}
	} );
	
	/* Project Video Type Change */
	jQuery('input[name="cmsms_post_video_type"]').bind('change', function () { 
		if (jQuery('input[name="cmsms_post_video_type"]:checked').val() === 'embeded') {
			jQuery('#cmsms_post_video_links-select').closest('tr').hide();
			
			jQuery('#cmsms_post_video_link').closest('tr').show();
		} else {
			jQuery('#cmsms_post_video_link').closest('tr').hide();
			
			jQuery('#cmsms_post_video_links-select').closest('tr').show();
		}
	} );
	
	
	
	/* Layout Sidebar Field Load */
	if (jQuery('input[name="cmsms_layout"]:checked').val() !== 'fullwidth') {
		jQuery('#cmsms_sidebar_id').closest('tr').show();
	}
	
	/* Page Layout Change */
	jQuery('input[name="cmsms_layout"]').bind('change', function () { 
		if (jQuery(this).val() === 'fullwidth') {
			jQuery('#cmsms_sidebar_id').closest('tr').hide();
			
			if (jQuery('#page_template').val() === 'portfolio.php') {
				jQuery('#cmsms_page_full_columns').closest('tr').show();
			}
		} else {
			jQuery('#cmsms_sidebar_id').closest('tr').show();
			
			if (jQuery('#page_template').val() === 'portfolio.php') {
				jQuery('#cmsms_page_full_columns').closest('tr').hide();
			}
		}
	} );
	
	
	
	/* Top Sidebar Field Load */
	if (jQuery('#cmsms_top_sidebar').is(':checked')) {
		jQuery('#cmsms_top_sidebar_id').closest('tr').show();
	}
	
	/* Top Sidebar Visibility Change */
	jQuery('#cmsms_top_sidebar').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#cmsms_top_sidebar_id').closest('tr').show();
		} else {
			jQuery('#cmsms_top_sidebar_id').closest('tr').hide();
		}
	} );
	
	
	
	/* Middle Sidebar Field Load */
	if (jQuery('#cmsms_middle_sidebar').is(':checked')) {
		jQuery('#cmsms_middle_sidebar_id').closest('tr').show();
	}
	
	/* Middle Sidebar Visibility Change */
	jQuery('#cmsms_middle_sidebar').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#cmsms_middle_sidebar_id').closest('tr').show();
		} else {
			jQuery('#cmsms_middle_sidebar_id').closest('tr').hide();
		}
	} );
	
	
	
	/* Background Fields Load */
	if (jQuery('#cmsms_bg_default').is(':not(:checked)')) {
		jQuery('#cmsms_bg_col').closest('tr').show();
		jQuery('#cmsms_bg_img_enable').closest('tr').show();
		
		if (jQuery('#cmsms_bg_img_enable').is(':checked')) {
			jQuery('#cmsms_bg_img').closest('tr').show();
			jQuery('#cmsms_bg_rep_no-repeat').closest('tr').show();
			jQuery('#cmsms_bg_pos').closest('tr').show();
			jQuery('#cmsms_bg_att_scroll').closest('tr').show();
		}
	}
	
	/* Default Background Checkbox Change */
	jQuery('#cmsms_bg_default').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#cmsms_bg_col').closest('tr').hide();
			jQuery('#cmsms_bg_img_enable').closest('tr').hide();
			jQuery('#cmsms_bg_img').closest('tr').hide();
			jQuery('#cmsms_bg_rep_no-repeat').closest('tr').hide();
			jQuery('#cmsms_bg_pos').closest('tr').hide();
			jQuery('#cmsms_bg_att_scroll').closest('tr').hide();
		} else {
			jQuery('#cmsms_bg_col').closest('tr').show();
			jQuery('#cmsms_bg_img_enable').closest('tr').show();
			
			if (jQuery('#cmsms_bg_img_enable').is(':checked')) {
				jQuery('#cmsms_bg_img').closest('tr').show();
				jQuery('#cmsms_bg_rep_no-repeat').closest('tr').show();
				jQuery('#cmsms_bg_pos').closest('tr').show();
				jQuery('#cmsms_bg_att_scroll').closest('tr').show();
			}
		}
	} );
	
	/* Background Visibility Change */
	jQuery('#cmsms_bg_img_enable').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#cmsms_bg_img').closest('tr').show();
			jQuery('#cmsms_bg_rep_no-repeat').closest('tr').show();
			jQuery('#cmsms_bg_pos').closest('tr').show();
			jQuery('#cmsms_bg_att_scroll').closest('tr').show();
		} else {
			jQuery('#cmsms_bg_img').closest('tr').hide();
			jQuery('#cmsms_bg_rep_no-repeat').closest('tr').hide();
			jQuery('#cmsms_bg_pos').closest('tr').hide();
			jQuery('#cmsms_bg_att_scroll').closest('tr').hide();
		}
	} );
	
	
	
	/* Bottom Sidebar Field Load */
	if (jQuery('#cmsms_bottom_sidebar').is(':checked')) {
		jQuery('#cmsms_bottom_sidebar_id').closest('tr').show();
	}
	
	/* Bottom Sidebar Visibility Change */
	jQuery('#cmsms_bottom_sidebar').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#cmsms_bottom_sidebar_id').closest('tr').show();
		} else {
			jQuery('#cmsms_bottom_sidebar_id').closest('tr').hide();
		}
	} );
	
	
	
	/* Heading Fields Load */
	if (jQuery('input[name="cmsms_heading"]:checked').val() === 'parallax') {
		jQuery('#cmsms_heading_title').closest('tr').show();
		jQuery('#cmsms_heading_subtitle').closest('tr').show();
		jQuery('#cmsms_heading_bg_col').closest('tr').show();
		jQuery('#cmsms_heading_bg_col_opac').closest('tr').show();
	} else if (jQuery('input[name="cmsms_heading"]:checked').val() === 'custom') {
		jQuery('#cmsms_heading_title').closest('tr').show();
		jQuery('#cmsms_heading_subtitle').closest('tr').show();
		jQuery('#cmsms_heading_bg_col').closest('tr').show();
		jQuery('#cmsms_heading_bg_img').closest('tr').show();
	} else if (jQuery('input[name="cmsms_heading"]:checked').val() === 'default') {
		jQuery('#cmsms_heading_bg_col').closest('tr').show();
		jQuery('#cmsms_heading_bg_img').closest('tr').show();
	}
	
	/* Heading Type Change */
	jQuery('input[name="cmsms_heading"]').bind('change', function () { 
		if (jQuery(this).val() === 'default') {
			jQuery('#cmsms_heading_title').closest('tr').hide();
			jQuery('#cmsms_heading_subtitle').closest('tr').hide();
			jQuery('#cmsms_heading_bg_col').closest('tr').show();
			jQuery('#cmsms_heading_bg_col_opac').closest('tr').hide();
			jQuery('#cmsms_heading_bg_img').closest('tr').show();
		} else if (jQuery(this).val() === 'custom') {
			jQuery('#cmsms_heading_title').closest('tr').show();
			jQuery('#cmsms_heading_subtitle').closest('tr').show();
			jQuery('#cmsms_heading_bg_col').closest('tr').show();
			jQuery('#cmsms_heading_bg_col_opac').closest('tr').hide();
			jQuery('#cmsms_heading_bg_img').closest('tr').show();
		} else if (jQuery(this).val() === 'parallax') {
			jQuery('#cmsms_heading_title').closest('tr').show();
			jQuery('#cmsms_heading_subtitle').closest('tr').show();
			jQuery('#cmsms_heading_bg_col').closest('tr').show();
			jQuery('#cmsms_heading_bg_col_opac').closest('tr').show();
			jQuery('#cmsms_heading_bg_img').closest('tr').hide();
		} else {
			jQuery('#cmsms_heading_title').closest('tr').hide();
			jQuery('#cmsms_heading_subtitle').closest('tr').hide();
			jQuery('#cmsms_heading_bg_col').closest('tr').hide();
			jQuery('#cmsms_heading_bg_col_opac').closest('tr').hide();
			jQuery('#cmsms_heading_bg_img').closest('tr').hide();
		}
	} );
	
	
	
	/* Slider Fields Load */
	if (jQuery('input[name="cmsms_slider"]:checked').val() === 'rev_slider') {
		jQuery('#cmsms_slider_rev_shortcode').closest('tr').show();
	}
	if (jQuery('input[name="cmsms_slider"]:checked').val() === 'lay_slider') {
		jQuery('#cmsms_slider_lay_shortcode').closest('tr').show();
	}
	
	/* Slider Type Change */
	jQuery('input[name="cmsms_slider"]').bind('change', function () { 
		if (jQuery(this).val() === 'rev_slider') {
			jQuery('#cmsms_slider_rev_shortcode').closest('tr').show();
			jQuery('#cmsms_slider_lay_shortcode').closest('tr').hide();
		} else if (jQuery(this).val() === 'lay_slider') {
			jQuery('#cmsms_slider_lay_shortcode').closest('tr').show();
			jQuery('#cmsms_slider_rev_shortcode').closest('tr').hide();
		} else {
			jQuery('#cmsms_slider_rev_shortcode').closest('tr').hide();
			jQuery('#cmsms_slider_lay_shortcode').closest('tr').hide();
		}
	} );
	
	
	
	/* Breadcrumbs Fields Load */
	if (jQuery('input[name="cmsms_breadcrumbs"]:checked').val() === 'custom') {
		jQuery('#cmsms_custom_breadcrumbs-select').closest('tr').show();
	}
	
	/* Breadcrumbs Type Change */
	jQuery('input[name="cmsms_breadcrumbs"]').bind('change', function () { 
		if (jQuery(this).val() === 'custom') {
			jQuery('#cmsms_custom_breadcrumbs-select').closest('tr').show();
		} else {
			jQuery('#cmsms_custom_breadcrumbs-select').closest('tr').hide();
		}
	} );
	
	
	
	/* Page Template Fields Load */
	if (jQuery('#page_template').val() === 'blog.php') {
		jQuery('#cmsms_page_post_categ').closest('tr').show();
		jQuery('input[name="cmsms_page_order_type"]').closest('tr').show();
		jQuery('input[name="cmsms_page_order"]').closest('tr').show();
		jQuery('#cmsms_page_items_number').closest('tr').show();
	} else if (jQuery('#page_template').val() === 'portfolio.php') {
		jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').hide();
		jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().hide();
		jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().next().css('border', 0);
		
		jQuery('#cmsms_page_full_columns').closest('tr').show();
		jQuery('#cmsms_page_sort').closest('tr').show();
		jQuery('#cmsms_page_project_type').closest('tr').show();
		jQuery('input[name="cmsms_page_order_type"]').closest('tr').show();
		jQuery('input[name="cmsms_page_order"]').closest('tr').show();
		jQuery('#cmsms_page_items_number').closest('tr').show();
	} else if (jQuery('#page_template').val() === 'testimonials.php') {
		jQuery('input[name="cmsms_page_order"]').closest('tr').show();
		jQuery('#cmsms_page_tl_categ').closest('tr').show();
		jQuery('#cmsms_page_items_number').closest('tr').show();
	}
	
	/* Page Template Change */
	jQuery('#page_template').bind('change', function () { 
		if (jQuery(this).val() === 'blog.php') {
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').show();
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().show();
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().next().css('border', '1px dotted #cccccc');
			
			jQuery('#cmsms_page_full_columns').closest('tr').hide();
			jQuery('#cmsms_page_sort').closest('tr').hide();
			jQuery('#cmsms_page_project_type').closest('tr').hide();
			
			jQuery('#cmsms_page_tl_categ').closest('tr').hide();
			
			jQuery('#cmsms_page_post_categ').closest('tr').show();
			jQuery('input[name="cmsms_page_order_type"]').closest('tr').show();
			jQuery('input[name="cmsms_page_order"]').closest('tr').show();
			jQuery('#cmsms_page_items_number').closest('tr').show();
		} else if (jQuery(this).val() === 'portfolio.php') {
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').hide();
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().hide();
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().next().css('border', 0);
			
			jQuery('#cmsms_page_post_categ').closest('tr').hide();
			
			jQuery('#cmsms_page_tl_categ').closest('tr').hide();
			
			jQuery('#cmsms_page_full_columns').closest('tr').show();
			jQuery('#cmsms_page_sort').closest('tr').show();
			jQuery('#cmsms_page_project_type').closest('tr').show();
			jQuery('input[name="cmsms_page_order_type"]').closest('tr').show();
			jQuery('input[name="cmsms_page_order"]').closest('tr').show();
			jQuery('#cmsms_page_items_number').closest('tr').show();
		} else if (jQuery(this).val() === 'testimonials.php') {
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').show();
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().show();
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().next().css('border', '1px dotted #cccccc');
			
			jQuery('#cmsms_page_post_categ').closest('tr').hide();
			jQuery('input[name="cmsms_page_order_type"]').closest('tr').hide();
			
			jQuery('#cmsms_page_full_columns').closest('tr').hide();
			jQuery('#cmsms_page_sort').closest('tr').hide();
			jQuery('#cmsms_page_project_type').closest('tr').hide();
			
			jQuery('input[name="cmsms_page_order"]').closest('tr').show();
			jQuery('#cmsms_page_tl_categ').closest('tr').show();
			jQuery('#cmsms_page_items_number').closest('tr').show();
		} else {
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').show();
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().show();
			jQuery('input[name="cmsms_layout"]').closest('tr.cmsms_tr_radio_img').next().next().css('border', '1px dotted #cccccc');
			
			jQuery('#cmsms_page_full_columns').closest('tr').hide();
			jQuery('#cmsms_page_sort').closest('tr').hide();
			jQuery('#cmsms_page_project_type').closest('tr').hide();
			
			jQuery('#cmsms_page_post_categ').closest('tr').hide();
			
			jQuery('#cmsms_page_tl_categ').closest('tr').hide();
			
			jQuery('input[name="cmsms_page_order_type"]').closest('tr').hide();
			jQuery('input[name="cmsms_page_order"]').closest('tr').hide();
			jQuery('#cmsms_page_items_number').closest('tr').hide();
		}
	} );
	
	
	
	/* Project Format Fields Load */
	if (jQuery('input[name="cmsms_project_format"]:checked').val() === 'video') {
		jQuery('#cmsms_project_video').show();
		
		if (jQuery('input[name="cmsms_project_video_type"]:checked').val() === 'embeded') {
			jQuery('#cmsms_project_video_link').closest('tr').show();
		} else {
			jQuery('#cmsms_project_video_links-select').closest('tr').show();
		}
	} else if (jQuery('input[name="cmsms_project_format"]:checked').val() === 'album') {
		jQuery('#cmsms_project_images').show();
		
		jQuery('input[name="cmsms_project_columns"]').closest('tr').show();
	} else if (jQuery('input[name="cmsms_project_format"]:checked').val() === 'slider') {
		jQuery('#cmsms_project_images').show();
	}
	
	/* Project Format Change */
	jQuery('input[name="cmsms_project_format"]').bind('change', function () { 
		if (jQuery(this).val() === 'video') {
			jQuery('#cmsms_project_images').hide();
			
			jQuery('input[name="cmsms_project_columns"]').closest('tr').hide();
			
			jQuery('#cmsms_project_video').show();
			
			if (jQuery('input[name="cmsms_project_video_type"]:checked').val() === 'embeded') {
				jQuery('#cmsms_project_video_link').closest('tr').show();
			} else {
				jQuery('#cmsms_project_video_links-select').closest('tr').show();
			}
		} else if (jQuery(this).val() === 'album') {
			jQuery('#cmsms_project_video').hide();
			
			jQuery('#cmsms_project_images').show();
			
			jQuery('input[name="cmsms_project_columns"]').closest('tr').show();
		} else if (jQuery(this).val() === 'slider') {
			jQuery('#cmsms_project_video').hide();
			
			jQuery('input[name="cmsms_project_columns"]').closest('tr').hide();
			
			jQuery('#cmsms_project_images').show();
		}
	} );
	
	/* Project Video Type Change */
	jQuery('input[name="cmsms_project_video_type"]').bind('change', function () { 
		if (jQuery('input[name="cmsms_project_video_type"]:checked').val() === 'embeded') {
			jQuery('#cmsms_project_video_links-select').closest('tr').hide();
			
			jQuery('#cmsms_project_video_link').closest('tr').show();
		} else {
			jQuery('#cmsms_project_video_link').closest('tr').hide();
			
			jQuery('#cmsms_project_video_links-select').closest('tr').show();
		}
	} );
} );

