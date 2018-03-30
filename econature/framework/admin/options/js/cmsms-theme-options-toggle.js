/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.0.0
 * 
 * Post, Page, Project & Profile Options Toggles Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	$(document).ready(function () { 
		/* Post Format Fields Load */
		if ($('#post-formats-select input.post-format:checked').val() === 'aside') {
			$('#cmsms_post_aside').show();
		} else if ($('#post-formats-select input.post-format:checked').val() === 'status') {
			$('#cmsms_post_status').show();
		} else if ($('#post-formats-select input.post-format:checked').val() === 'chat') {
			$('#cmsms_post_chat').show();
		} else if ($('#post-formats-select input.post-format:checked').val() === 'quote') {
			$('#cmsms_post_quote').show();
		} else if ($('#post-formats-select input.post-format:checked').val() === 'link') {
			$('#cmsms_post_link').show();
		} else if ($('#post-formats-select input.post-format:checked').val() === 'image') {
			$('#cmsms_post_image').show();
		} else if ($('#post-formats-select input.post-format:checked').val() === 'gallery') {
			$('#cmsms_post_gallery').show();
			
			$('#cmsms_project_images').show();
			
			$('#cmsms_project_images .cmsms_tr_radio').show();
		} else if ($('#post-formats-select input.post-format:checked').val() === 'video') {
			$('#cmsms_post_video').show();
			
			$('#cmsms_project_video').show();
			
			
			if ($('input[name="cmsms_post_video_type"]:checked').val() === 'embedded') {
				$('#cmsms_post_video_link').closest('tr').show();
			} else {
				$('#cmsms_post_video_links-repeatable').closest('tr').show();
			}
			
			if ($('input[name="cmsms_project_video_type"]:checked').val() === 'embedded') {
				$('#cmsms_project_video_link').closest('tr').show();
			} else {
				$('#cmsms_project_video_links-repeatable').closest('tr').show();
			}
		} else if ($('#post-formats-select input.post-format:checked').val() === 'audio') {
			$('#cmsms_post_audio').show();
		} else {
			$('#cmsms_project_images').show();
		}
		
		/* Post Format Change */
		$('#post-formats-select input.post-format').bind('change', function () { 
			if ($(this).val() === 'aside') {
				$('#cmsms_post_quote, #cmsms_post_status, #cmsms_post_chat, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio, #cmsms_project_images, #cmsms_project_video').hide();
				
				$('#cmsms_post_aside').show();
			} else if ($(this).val() === 'status') {
				$('#cmsms_post_quote, #cmsms_post_aside, #cmsms_post_chat, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio, #cmsms_project_images, #cmsms_project_video').hide();
				
				$('#cmsms_post_status').show();
			} else if ($(this).val() === 'chat') {
				$('#cmsms_post_quote, #cmsms_post_aside, #cmsms_post_status, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio, #cmsms_project_images, #cmsms_project_video').hide();
				
				$('#cmsms_post_chat').show();
			} else if ($(this).val() === 'quote') {
				$('#cmsms_post_aside, #cmsms_post_status, #cmsms_post_chat, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio, #cmsms_project_images, #cmsms_project_video').hide();
				
				$('#cmsms_post_quote').show();
			} else if ($(this).val() === 'link') {
				$('#cmsms_post_aside, #cmsms_post_status, #cmsms_post_chat, #cmsms_post_quote, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio, #cmsms_project_images, #cmsms_project_video').hide();
				
				$('#cmsms_post_link').show();
			} else if ($(this).val() === 'image') {
				$('#cmsms_post_aside, #cmsms_post_status, #cmsms_post_chat, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio, #cmsms_project_images, #cmsms_project_video').hide();
				
				$('#cmsms_post_image').show();
			} else if ($(this).val() === 'gallery') {
				$('#cmsms_post_aside, #cmsms_post_status, #cmsms_post_chat, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_video, #cmsms_post_audio, #cmsms_project_video').hide();
				
				$('#cmsms_post_gallery').show();
				
				$('#cmsms_project_images').show();
			
				$('#cmsms_project_images .cmsms_tr_radio').show();
			} else if ($(this).val() === 'video') {
				$('#cmsms_post_aside, #cmsms_post_status, #cmsms_post_chat, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_audio, #cmsms_project_images').hide();
				
				$('#cmsms_post_video').show();
				
				$('#cmsms_project_video').show();
				
				
				if ($('input[name="cmsms_post_video_type"]:checked').val() === 'embedded') {
					$('#cmsms_post_video_link').closest('tr').show();
				} else {
					$('#cmsms_post_video_links-repeatable').closest('tr').show();
				}
				
				if ($('input[name="cmsms_project_video_type"]:checked').val() === 'embedded') {
					$('#cmsms_project_video_link').closest('tr').show();
				} else {
					$('#cmsms_project_video_links-repeatable').closest('tr').show();
				}
			} else if ($(this).val() === 'audio') {
				$('#cmsms_post_aside, #cmsms_post_status, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_project_images, #cmsms_project_video').hide();
				
				$('#cmsms_post_audio').show();
			} else {
				$('#cmsms_post_aside, #cmsms_post_status, #cmsms_post_chat, #cmsms_post_quote, #cmsms_post_link, #cmsms_post_image, #cmsms_post_gallery, #cmsms_post_video, #cmsms_post_audio, #cmsms_project_video').hide();
				
				$('#cmsms_project_images').show();
			
				$('#cmsms_project_images .cmsms_tr_radio').hide();
			}
		} );
		
		/* Post Video Type Change */
		$('input[name="cmsms_post_video_type"]').bind('change', function () { 
			if ($('input[name="cmsms_post_video_type"]:checked').val() === 'embedded') {
				$('#cmsms_post_video_links-repeatable').closest('tr').hide();
				
				$('#cmsms_post_video_link').closest('tr').show();
			} else {
				$('#cmsms_post_video_link').closest('tr').hide();
				
				$('#cmsms_post_video_links-repeatable').closest('tr').show();
			}
		} );
		
		/* Project Video Type Change */
		$('input[name="cmsms_project_video_type"]').bind('change', function () { 
			if ($('input[name="cmsms_project_video_type"]:checked').val() === 'embedded') {
				$('#cmsms_project_video_links-repeatable').closest('tr').hide();
				
				$('#cmsms_project_video_link').closest('tr').show();
			} else {
				$('#cmsms_project_video_link').closest('tr').hide();
				
				$('#cmsms_project_video_links-repeatable').closest('tr').show();
			}
		} );
		
		
		
		/* Layout Sidebar Field Load */
		if ($('input[name="cmsms_layout"]:checked').val() !== 'fullwidth') {
			$('#cmsms_sidebar_id').closest('tr').show();
		}
		
		/* Page Layout Change */
		$('input[name="cmsms_layout"]').bind('change', function () { 
			if ($(this).val() === 'fullwidth') {
				$('#cmsms_sidebar_id').closest('tr').hide();
				
				if ($('#page_template').val() === 'portfolio.php') {
					$('#cmsms_page_full_columns').closest('tr').show();
				}
			} else {
				$('#cmsms_sidebar_id').closest('tr').show();
				
				if ($('#page_template').val() === 'portfolio.php') {
					$('#cmsms_page_full_columns').closest('tr').hide();
				}
			}
		} );
		
		
		
		/* Bottom Sidebar Field Load */
		if ($('#cmsms_bottom_sidebar').is(':checked')) {
			$('#cmsms_bottom_sidebar_id').closest('tr').show();
			$('#cmsms_bottom_sidebar_layout').closest('tr').show();
		}
		
		/* Bottom Sidebar Visibility Change */
		$('#cmsms_bottom_sidebar').bind('change', function () { 
			if ($(this).is(':checked')) {
				$('#cmsms_bottom_sidebar_id').closest('tr').show();
				$('#cmsms_bottom_sidebar_layout').closest('tr').show();
			} else {
				$('#cmsms_bottom_sidebar_id').closest('tr').hide();
				$('#cmsms_bottom_sidebar_layout').closest('tr').hide();
			}
		} );
		
		
		
		/* Background Fields Load */
		if ($('#cmsms_bg_default').is(':not(:checked)')) {
			$('#cmsms_bg_col').closest('tr').show();
			$('#cmsms_bg_img_enable').closest('tr').show();
			
			if ($('#cmsms_bg_img_enable').is(':checked')) {
				$('#cmsms_bg_img').closest('tr').show();
				$('#cmsms_bg_rep_no-repeat').closest('tr').show();
				$('#cmsms_bg_pos').closest('tr').show();
				$('#cmsms_bg_att_scroll').closest('tr').show();
				$('#cmsms_bg_size_auto').closest('tr').show();
			}
		}
		
		/* Default Background Checkbox Change */
		$('#cmsms_bg_default').bind('change', function () { 
			if ($(this).is(':checked')) {
				$('#cmsms_bg_col').closest('tr').hide();
				$('#cmsms_bg_img_enable').closest('tr').hide();
				$('#cmsms_bg_img').closest('tr').hide();
				$('#cmsms_bg_rep_no-repeat').closest('tr').hide();
				$('#cmsms_bg_pos').closest('tr').hide();
				$('#cmsms_bg_att_scroll').closest('tr').hide();
				$('#cmsms_bg_size_auto').closest('tr').hide();
			} else {
				$('#cmsms_bg_col').closest('tr').show();
				$('#cmsms_bg_img_enable').closest('tr').show();
				
				if ($('#cmsms_bg_img_enable').is(':checked')) {
					$('#cmsms_bg_img').closest('tr').show();
					$('#cmsms_bg_rep_no-repeat').closest('tr').show();
					$('#cmsms_bg_pos').closest('tr').show();
					$('#cmsms_bg_att_scroll').closest('tr').show();
					$('#cmsms_bg_size_auto').closest('tr').show();
				}
			}
		} );
		
		/* Background Visibility Change */
		$('#cmsms_bg_img_enable').bind('change', function () { 
			if ($(this).is(':checked')) {
				$('#cmsms_bg_img').closest('tr').show();
				$('#cmsms_bg_rep_no-repeat').closest('tr').show();
				$('#cmsms_bg_pos').closest('tr').show();
				$('#cmsms_bg_att_scroll').closest('tr').show();
				$('#cmsms_bg_size_auto').closest('tr').show();
			} else {
				$('#cmsms_bg_img').closest('tr').hide();
				$('#cmsms_bg_rep_no-repeat').closest('tr').hide();
				$('#cmsms_bg_pos').closest('tr').hide();
				$('#cmsms_bg_att_scroll').closest('tr').hide();
				$('#cmsms_bg_size_auto').closest('tr').hide();
			}
		} );
		
		
		
		/* Heading Fields Load */
		if ($('input[name="cmsms_heading"]:checked').val() === 'custom') {
			$('#cmsms_heading_title').closest('tr').show();
			$('#cmsms_heading_subtitle').closest('tr').show();
			$('#cmsms_heading_icon').closest('tr').show();
			
			$('input[name="cmsms_heading_alignment"]').closest('tr').show();
			$('#cmsms_heading_scheme').closest('tr').show();
			$('#cmsms_heading_bg_img_enable').closest('tr').show();
			
			if ($('#cmsms_heading_bg_img_enable').is(':checked')) {
				$('#cmsms_heading_bg_img').closest('tr').show();
				$('input[name="cmsms_heading_bg_rep"]').closest('tr').show();
				$('input[name="cmsms_heading_bg_att"]').closest('tr').show();
				$('input[name="cmsms_heading_bg_size"]').closest('tr').show();
			}
			
			$('#cmsms_heading_bg_color').closest('tr').show();
			$('#cmsms_heading_bg_color_opacity').closest('tr').show();
			$('#cmsms_heading_height').closest('tr').show();
		} else if ($('input[name="cmsms_heading"]:checked').val() === 'default') {
			$('input[name="cmsms_heading_alignment"]').closest('tr').show();
			$('#cmsms_heading_scheme').closest('tr').show();
			$('#cmsms_heading_bg_img_enable').closest('tr').show();
			
			if ($('#cmsms_heading_bg_img_enable').is(':checked')) {
				$('#cmsms_heading_bg_img').closest('tr').show();
				$('input[name="cmsms_heading_bg_rep"]').closest('tr').show();
				$('input[name="cmsms_heading_bg_att"]').closest('tr').show();
				$('input[name="cmsms_heading_bg_size"]').closest('tr').show();
			}
			
			$('#cmsms_heading_bg_color').closest('tr').show();
			$('#cmsms_heading_bg_color_opacity').closest('tr').show();
			$('#cmsms_heading_height').closest('tr').show();
		}
		
		/* Heading Type Change */
		$('input[name="cmsms_heading"]').bind('change', function () { 
			if ($(this).val() === 'default') {
				$('#cmsms_heading_title').closest('tr').hide();
				$('#cmsms_heading_subtitle').closest('tr').hide();
				$('#cmsms_heading_icon').closest('tr').hide();
				
				$('input[name="cmsms_heading_alignment"]').closest('tr').show();
				$('#cmsms_heading_scheme').closest('tr').show();
				$('#cmsms_heading_bg_img_enable').closest('tr').show();
				
				if ($('#cmsms_heading_bg_img_enable').is(':checked')) {
					$('#cmsms_heading_bg_img').closest('tr').show();
					$('input[name="cmsms_heading_bg_rep"]').closest('tr').show();
					$('input[name="cmsms_heading_bg_att"]').closest('tr').show();
					$('input[name="cmsms_heading_bg_size"]').closest('tr').show();
				}
				
				$('#cmsms_heading_bg_color').closest('tr').show();
				$('#cmsms_heading_bg_color_opacity').closest('tr').show();
				$('#cmsms_heading_height').closest('tr').show();
			} else if ($(this).val() === 'custom') {
				$('#cmsms_heading_title').closest('tr').show();
				$('#cmsms_heading_subtitle').closest('tr').show();
				$('#cmsms_heading_icon').closest('tr').show();
				
				$('input[name="cmsms_heading_alignment"]').closest('tr').show();
				$('#cmsms_heading_scheme').closest('tr').show();
				$('#cmsms_heading_bg_img_enable').closest('tr').show();
				
				if ($('#cmsms_heading_bg_img_enable').is(':checked')) {
					$('#cmsms_heading_bg_img').closest('tr').show();
					$('input[name="cmsms_heading_bg_rep"]').closest('tr').show();
					$('input[name="cmsms_heading_bg_att"]').closest('tr').show();
					$('input[name="cmsms_heading_bg_size"]').closest('tr').show();
				}
				
				$('#cmsms_heading_bg_color').closest('tr').show();
				$('#cmsms_heading_bg_color_opacity').closest('tr').show();
				$('#cmsms_heading_height').closest('tr').show();
			} else {
				$('#cmsms_heading_title').closest('tr').hide();
				$('#cmsms_heading_subtitle').closest('tr').hide();
				$('#cmsms_heading_icon').closest('tr').hide();
				
				$('input[name="cmsms_heading_alignment"]').closest('tr').hide();
				$('#cmsms_heading_scheme').closest('tr').hide();
				$('#cmsms_heading_bg_img_enable').closest('tr').hide();
				$('#cmsms_heading_bg_img').closest('tr').hide();
				$('input[name="cmsms_heading_bg_rep"]').closest('tr').hide();
				$('input[name="cmsms_heading_bg_att"]').closest('tr').hide();
				$('input[name="cmsms_heading_bg_size"]').closest('tr').hide();
				$('#cmsms_heading_bg_color').closest('tr').hide();
				$('#cmsms_heading_bg_color_opacity').closest('tr').hide();
				$('#cmsms_heading_height').closest('tr').hide();
			}
		} );
		
		/* Heading Background Visibility Change */
		$('#cmsms_heading_bg_img_enable').bind('change', function () { 
			if ($(this).is(':checked')) {
				$('#cmsms_heading_bg_img').closest('tr').show();
				$('input[name="cmsms_heading_bg_rep"]').closest('tr').show();
				$('input[name="cmsms_heading_bg_att"]').closest('tr').show();
				$('input[name="cmsms_heading_bg_size"]').closest('tr').show();
			} else {
				$('#cmsms_heading_bg_img').closest('tr').hide();
				$('input[name="cmsms_heading_bg_rep"]').closest('tr').hide();
				$('input[name="cmsms_heading_bg_att"]').closest('tr').hide();
				$('input[name="cmsms_heading_bg_size"]').closest('tr').hide();
			}
		} );
		
		
		
		/* Breadcrumbs Field Load */
		if ($('#cmsms_breadcrumbs').is(':checked')) {
			$('input[name="cmsms_breadcrumbs_alignment"]').closest('tr').show();
		}
		
		/* Breadcrumbs Field Change */
		$('#cmsms_breadcrumbs').bind('change', function () { 
			if ($(this).is(':checked')) {
				$('input[name="cmsms_breadcrumbs_alignment"]').closest('tr').show();
			} else {
				$('input[name="cmsms_breadcrumbs_alignment"]').closest('tr').hide();
			}
		} );
	} );
} )(jQuery);

