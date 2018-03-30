jQuery(document).ready( function($) {
	
	/* Logo */
	if (jQuery("#"+vpanel_name+"-logo_display-custom_image:checked").length > 0) {
		jQuery("#logo_img").parent().parent().parent().show(10);
		jQuery("#retina_logo").parent().parent().parent().show(10);
	}else {
		jQuery("#logo_img").parent().parent().parent().hide(10);
		jQuery("#retina_logo").parent().parent().parent().hide(10);
	}
	jQuery("#"+vpanel_name+"-logo_display-custom_image").click(function () {
		jQuery("#logo_img").parent().parent().parent().slideDown(500);
		jQuery("#retina_logo").parent().parent().parent().slideDown(500);
	});
	jQuery("#"+vpanel_name+"-logo_display-display_title").click(function () {
		jQuery("#logo_img").parent().parent().parent().slideUp(500);
		jQuery("#retina_logo").parent().parent().parent().slideUp(500);
	});
	
	if (jQuery("#"+vpanel_name+"-questions_logo_display-custom_image:checked").length > 0) {
		jQuery("#questions_logo_img").parent().parent().parent().show(10);
		jQuery("#questions_retina_logo").parent().parent().parent().show(10);
	}else {
		jQuery("#questions_logo_img").parent().parent().parent().hide(10);
		jQuery("#questions_retina_logo").parent().parent().parent().hide(10);
	}
	jQuery("#"+vpanel_name+"-questions_logo_display-custom_image").click(function () {
		jQuery("#questions_logo_img").parent().parent().parent().slideDown(500);
		jQuery("#questions_retina_logo").parent().parent().parent().slideDown(500);
	});
	jQuery("#"+vpanel_name+"-questions_logo_display-display_title").click(function () {
		jQuery("#questions_logo_img").parent().parent().parent().slideUp(500);
		jQuery("#questions_retina_logo").parent().parent().parent().slideUp(500);
	});
	
	if (jQuery("#"+vpanel_name+"-products_logo_display-custom_image:checked").length > 0) {
		jQuery("#products_logo_img").parent().parent().parent().show(10);
		jQuery("#products_retina_logo").parent().parent().parent().show(10);
	}else {
		jQuery("#products_logo_img").parent().parent().parent().hide(10);
		jQuery("#products_retina_logo").parent().parent().parent().hide(10);
	}
	jQuery("#"+vpanel_name+"-products_logo_display-custom_image").click(function () {
		jQuery("#products_logo_img").parent().parent().parent().slideDown(500);
		jQuery("#products_retina_logo").parent().parent().parent().slideDown(500);
	});
	jQuery("#"+vpanel_name+"-products_logo_display-display_title").click(function () {
		jQuery("#products_logo_img").parent().parent().parent().slideUp(500);
		jQuery("#products_retina_logo").parent().parent().parent().slideUp(500);
	});
	
	/* After register */
	var after_register = jQuery("#after_register").val();
	if (after_register == "home") {
		jQuery("#section-after_register_page").slideUp(500);
	}else {
		jQuery("#section-after_register_page").slideDown(500);
	}
	
	jQuery("#after_register").change(function () {
		var after_register = jQuery(this).val();
		if (after_register == "home") {
			jQuery("#section-after_register_page").slideUp(500);
		}else {
			jQuery("#section-after_register_page").slideDown(500);
		}
	});
	
	/* Home background */
	if (jQuery("#"+vpanel_name+"-background_type-custom_background:checked").length > 0 && jQuery("#"+vpanel_name+"-background_type-patterns:checked").length == 0) {
		jQuery("#section-custom_background").slideDown(500);
		jQuery("#section-full_screen_background").slideDown(500);
		jQuery("#section-background_color").hide(10);
		jQuery("#section-background_pattern").hide(10);
	}else if (jQuery("#"+vpanel_name+"-background_type-patterns:checked").length > 0 && jQuery("#"+vpanel_name+"-background_type-custom_background:checked").length == 0) {
		jQuery("#section-background_color").slideDown(500);
		jQuery("#section-background_pattern").slideDown(500);
		jQuery("#section-custom_background").hide(10);
		jQuery("#section-full_screen_background").hide(10);
	}
	jQuery("#"+vpanel_name+"-background_type-custom_background").click(function () {
		jQuery("#section-custom_background").slideDown(500);
		jQuery("#section-full_screen_background").slideDown(500);
		jQuery("#section-background_pattern").slideUp(500);
		jQuery("#section-background_color").slideUp(500);
	});
	jQuery("#"+vpanel_name+"-background_type-patterns").click(function () {
		jQuery("#section-custom_background").slideUp(500);
		jQuery("#section-full_screen_background").slideUp(500);
		jQuery("#section-background_pattern").slideDown(500);
		jQuery("#section-background_color").slideDown(500);
	});
	
	/* user background */
	if (jQuery("#"+vpanel_name+"-author_background_type-custom_background:checked").length > 0 && jQuery("#"+vpanel_name+"-author_background_type-patterns:checked").length == 0) {
		jQuery("#section-author_custom_background").slideDown(500);
		jQuery("#section-author_full_screen_background").slideDown(500);
		jQuery("#section-author_background_color").hide(10);
		jQuery("#section-author_background_pattern").hide(10);
	}else if (jQuery("#"+vpanel_name+"-author_background_type-patterns:checked").length > 0 && jQuery("#"+vpanel_name+"-author_background_type-custom_background:checked").length == 0) {
		jQuery("#section-author_background_color").slideDown(500);
		jQuery("#section-author_background_pattern").slideDown(500);
		jQuery("#section-author_custom_background").hide(10);
		jQuery("#section-author_full_screen_background").hide(10);
	}
	jQuery("#"+vpanel_name+"-author_background_type-custom_background").click(function () {
		jQuery("#section-author_custom_background").slideDown(500);
		jQuery("#section-author_full_screen_background").slideDown(500);
		jQuery("#section-author_background_pattern").slideUp(500);
		jQuery("#section-author_background_color").slideUp(500);
	});
	jQuery("#"+vpanel_name+"-author_background_type-patterns").click(function () {
		jQuery("#section-author_custom_background").slideUp(500);
		jQuery("#section-author_full_screen_background").slideUp(500);
		jQuery("#section-author_background_pattern").slideDown(500);
		jQuery("#section-author_background_color").slideDown(500);
	});
	
	/* questions background */
	if (jQuery("#"+vpanel_name+"-questions_background_type-custom_background:checked").length > 0 && jQuery("#"+vpanel_name+"-questions_background_type-patterns:checked").length == 0) {
		jQuery("#section-questions_custom_background").slideDown(500);
		jQuery("#section-questions_full_screen_background").slideDown(500);
		jQuery("#section-questions_background_color").hide(10);
		jQuery("#section-questions_background_pattern").hide(10);
	}else if (jQuery("#"+vpanel_name+"-questions_background_type-patterns:checked").length > 0 && jQuery("#"+vpanel_name+"-questions_background_type-custom_background:checked").length == 0) {
		jQuery("#section-questions_background_color").slideDown(500);
		jQuery("#section-questions_background_pattern").slideDown(500);
		jQuery("#section-questions_custom_background").hide(10);
		jQuery("#section-questions_full_screen_background").hide(10);
	}
	jQuery("#"+vpanel_name+"-questions_background_type-custom_background").click(function () {
		jQuery("#section-questions_custom_background").slideDown(500);
		jQuery("#section-questions_full_screen_background").slideDown(500);
		jQuery("#section-questions_background_pattern").slideUp(500);
		jQuery("#section-questions_background_color").slideUp(500);
	});
	jQuery("#"+vpanel_name+"-questions_background_type-patterns").click(function () {
		jQuery("#section-questions_custom_background").slideUp(500);
		jQuery("#section-questions_full_screen_background").slideUp(500);
		jQuery("#section-questions_background_pattern").slideDown(500);
		jQuery("#section-questions_background_color").slideDown(500);
	});
	
	/* products background */
	if (jQuery("#"+vpanel_name+"-products_background_type-custom_background:checked").length > 0 && jQuery("#"+vpanel_name+"-products_background_type-patterns:checked").length == 0) {
		jQuery("#section-products_custom_background").slideDown(500);
		jQuery("#section-products_full_screen_background").slideDown(500);
		jQuery("#section-products_background_color").hide(10);
		jQuery("#section-products_background_pattern").hide(10);
	}else if (jQuery("#"+vpanel_name+"-products_background_type-patterns:checked").length > 0 && jQuery("#"+vpanel_name+"-products_background_type-custom_background:checked").length == 0) {
		jQuery("#section-products_background_color").slideDown(500);
		jQuery("#section-products_background_pattern").slideDown(500);
		jQuery("#section-products_custom_background").hide(10);
		jQuery("#section-products_full_screen_background").hide(10);
	}
	jQuery("#"+vpanel_name+"-products_background_type-custom_background").click(function () {
		jQuery("#section-products_custom_background").slideDown(500);
		jQuery("#section-products_full_screen_background").slideDown(500);
		jQuery("#section-products_background_pattern").slideUp(500);
		jQuery("#section-products_background_color").slideUp(500);
	});
	jQuery("#"+vpanel_name+"-products_background_type-patterns").click(function () {
		jQuery("#section-products_custom_background").slideUp(500);
		jQuery("#section-products_full_screen_background").slideUp(500);
		jQuery("#section-products_background_pattern").slideDown(500);
		jQuery("#section-products_background_color").slideDown(500);
	});
	
	/* Categories Design */
	if (jQuery(".cat_background_type:checked").length > 0 && jQuery("#"+vpanel_name+"-background_type-patterns:checked").length == 0) {
		jQuery("#section-custom_background").slideDown(500);
		jQuery("#section-full_screen_background").slideDown(500);
		jQuery("#section-background_color").hide(10);
		jQuery("#section-background_pattern").hide(10);
	}else if (jQuery("#"+vpanel_name+"-background_type-patterns:checked").length > 0 && jQuery("#"+vpanel_name+"-background_type-custom_background:checked").length == 0) {
		jQuery("#section-background_color").slideDown(500);
		jQuery("#section-background_pattern").slideDown(500);
		jQuery("#section-custom_background").hide(10);
		jQuery("#section-full_screen_background").hide(10);
	}
	jQuery("#"+vpanel_name+"-background_type-custom_background").click(function () {
		jQuery("#section-custom_background").slideDown(500);
		jQuery("#section-full_screen_background").slideDown(500);
		jQuery("#section-background_pattern").slideUp(500);
		jQuery("#section-background_color").slideUp(500);
	});
	jQuery("#"+vpanel_name+"-background_type-patterns").click(function () {
		jQuery("#section-custom_background").slideUp(500);
		jQuery("#section-full_screen_background").slideUp(500);
		jQuery("#section-background_pattern").slideDown(500);
		jQuery("#section-background_color").slideDown(500);
	});
	
	/* Social header */
	if (jQuery("#social_icon_h:checked").val() == "on") {
		jQuery("#section-facebook_icon_h").show(10);
		jQuery("#section-twitter_icon_h").show(10);
		jQuery("#section-gplus_icon_h").show(10);
		jQuery("#section-dribbble_icon_h").show(10);
		jQuery("#section-rss_icon_h").show(10);
	}else {
		jQuery("#section-facebook_icon_h").hide(10);
		jQuery("#section-twitter_icon_h").hide(10);
		jQuery("#section-gplus_icon_h").hide(10);
		jQuery("#section-dribbble_icon_h").hide(10);
		jQuery("#section-rss_icon_h").hide(10);
	}
	jQuery("#social_icon_h").click(function () {
		if (jQuery("#social_icon_h:checked").val() == "on") {
			jQuery("#section-facebook_icon_h").slideDown(500);
			jQuery("#section-twitter_icon_h").slideDown(500);
			jQuery("#section-gplus_icon_h").slideDown(500);
			jQuery("#section-dribbble_icon_h").slideDown(500);
			jQuery("#section-rss_icon_h").slideDown(500);
		}else {
			jQuery("#section-facebook_icon_h").slideUp(500);
			jQuery("#section-twitter_icon_h").slideUp(500);
			jQuery("#section-gplus_icon_h").slideUp(500);
			jQuery("#section-dribbble_icon_h").slideUp(500);
			jQuery("#section-rss_icon_h").slideUp(500);
		}
	});
	
	/* Home page */
	var home_display = jQuery("#section-home_display input[type='radio']:checked").val();
	if (home_display != "page_builder") {
		jQuery("#home_page_display").hide(10);
	}
	
	jQuery("#section-home_display input[type='radio']").change(function () {
		var home_display = jQuery(this).val();
		if (home_display == "page_builder") {
			jQuery("#home_page_display").slideDown(500);
		}else {
			jQuery("#home_page_display").slideUp(500);
		}
	});
	
	/* Sidebar */
	var sidebar_layout = jQuery("#section-sidebar_layout input[type='radio']:checked").val();
	if (sidebar_layout == "full") {
		jQuery("#section-sidebar_home").hide(10);
		jQuery("#section-else_sidebar").hide(10);
	}else {
		jQuery("#section-sidebar_home").show(10);
		jQuery("#section-else_sidebar").show(10);
	}
	
	jQuery("#section-sidebar_layout img").click(function () {
		var img_this = jQuery(this);
		var sidebar_layout_c = img_this.prev().text();
		if (sidebar_layout_c == "full") {
			jQuery("#section-sidebar_home").slideUp(500);
			jQuery("#section-else_sidebar").slideUp(500);
		}else {
			jQuery("#section-sidebar_home").slideDown(500);
			jQuery("#section-else_sidebar").slideDown(500);
		}
	});
	
	/* Author Sidebar */
	var author_sidebar_layout = jQuery("#section-author_sidebar_layout input[type='radio']:checked").val();
	if (author_sidebar_layout == "full") {
		jQuery("#section-author_sidebar").hide(10);
	}else {
		jQuery("#section-author_sidebar").show(10);
	}
	
	jQuery("#section-author_sidebar_layout img").click(function () {
		var img_this = jQuery(this);
		var author_sidebar_layout_c = img_this.prev().text();
		if (author_sidebar_layout_c == "full") {
			jQuery("#section-author_sidebar").slideUp(500);
		}else {
			jQuery("#section-author_sidebar").slideDown(500);
		}
	});
	
	/* Meta box (Sidebar) */
	var sidebar_layout_m = jQuery("input[name='vbegy_sidebar']:checked").val();
	if (sidebar_layout_m == "full") {
		jQuery("#vbegy_what_sidebar").parent().parent().parent().hide(10);
	}else {
		jQuery("#vbegy_what_sidebar").parent().parent().parent().show(10);
	}
	
	jQuery("input[name='vbegy_sidebar']").change(function () {
		var sidebar_layout_c_m = jQuery(this).val();
		if (sidebar_layout_c_m == "full") {
			jQuery("#vbegy_what_sidebar").parent().parent().parent().slideUp(500);
		}else {
			jQuery("#vbegy_what_sidebar").parent().parent().parent().slideDown(500);
		}
	});
	
	var custom_page_setting = jQuery("#vbegy_custom_page_setting:checked").length;
	if (custom_page_setting == 1) {
		jQuery("#vbegy_sticky_sidebar_s").parent().parent().show(10);
		jQuery("#vbegy_post_meta_s").parent().parent().show(10);
		jQuery("#vbegy_post_share_s").parent().parent().show(10);
		jQuery("#vbegy_post_author_box_s").parent().parent().show(10);
		jQuery("#vbegy_related_post_s").parent().parent().show(10);
		jQuery("#vbegy_post_comments_s").parent().parent().show(10);
		jQuery("#vbegy_post_navigation_s").parent().parent().show(10);
	}else {
		jQuery("#vbegy_sticky_sidebar_s").parent().parent().hide(10);
		jQuery("#vbegy_post_meta_s").parent().parent().hide(10);
		jQuery("#vbegy_post_share_s").parent().parent().hide(10);
		jQuery("#vbegy_post_author_box_s").parent().parent().hide(10);
		jQuery("#vbegy_related_post_s").parent().parent().hide(10);
		jQuery("#vbegy_post_comments_s").parent().parent().hide(10);
		jQuery("#vbegy_post_navigation_s").parent().parent().hide(10);
	}
	jQuery("#vbegy_custom_page_setting").click(function () {
		var custom_page_setting = jQuery("#vbegy_custom_page_setting:checked").length;
		if (custom_page_setting == 1) {
			jQuery("#vbegy_sticky_sidebar_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_meta_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_share_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_author_box_s").parent().parent().slideDown(500);
			jQuery("#vbegy_related_post_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_comments_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_navigation_s").parent().parent().slideDown(500);
		}else {
			jQuery("#vbegy_sticky_sidebar_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_meta_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_share_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_author_box_s").parent().parent().slideUp(500);
			jQuery("#vbegy_related_post_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_comments_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_navigation_s").parent().parent().slideUp(500);
		}
	});
	
	/* Meta box */
	var post_type = jQuery("#post_type").val();
	if (post_type == "post") {
		jQuery("#vbegy_page_builder").parent().parent().remove();
	}else if (post_type == "question") {
		jQuery("#vbegy_page_builder").parent().parent().remove();
		jQuery("#vbegy_post_meta_s").parent().parent().remove();
		jQuery("label[for='vbegy_what_post']").parent().parent().remove();
	}else if (post_type == "page") {
		jQuery("#vbegy_post_share_s").parent().parent().remove();
		jQuery("#vbegy_post_navigation_s").parent().parent().remove();
		jQuery("#vbegy_post_author_box_s").parent().parent().remove();
		jQuery("#vbegy_related_post_s").parent().parent().remove();
	}else if (post_type == "product") {
		jQuery("#vbegy_post_meta_s").parent().parent().remove();
		jQuery("#vbegy_post_author_box_s").parent().parent().remove();
		jQuery("#vbegy_post_comments_s").parent().parent().remove();
	}
	
	jQuery(".vpanel_checkbox").each(function () {
		var vpanel_checkbox = jQuery(this);
		if (vpanel_checkbox.length > 0) {
			vpanel_checkbox.parent().addClass("vpanel_checkbox_input");
		}
	});
	
	jQuery("#vbegy_google").parent().parent().hide(10);
	jQuery("#vbegy_video_post_type").parent().parent().parent().hide(10);
	jQuery("#vbegy_video_post_id").parent().parent().hide(10);
	jQuery("#vbegy_video_mp4").parent().parent().hide(10);
	jQuery("#vbegy_video_m4v").parent().parent().hide(10);
	jQuery("#vbegy_video_webm").parent().parent().hide(10);
	jQuery("#vbegy_video_ogv").parent().parent().hide(10);
	jQuery("#vbegy_video_wmv").parent().parent().hide(10);
	jQuery("#vbegy_video_flv").parent().parent().hide(10);
	jQuery("#vbegy_video_image").parent().parent().parent().hide(10);
	jQuery("#vbegy_slideshow_type").parent().parent().parent().hide(10);
	jQuery("[for='vbegy_upload_images']").parent().parent().hide();
	
	var builder_slide_warp = jQuery("#builder_slide_warp").html();
	jQuery("#builder_slide_warp").remove();
	jQuery("#vbegy_slideshow_post").html(builder_slide_warp).hide(10);
	if (jQuery("#vbegy_slideshow_post").length > 0) {
		jQuery("#vbegy_slideshow_post ul").sortable({placeholder: "ui-state-highlight"});
	}
	
	var builder_rating_warp = jQuery("#builder_rating_warp").html();
	jQuery("#builder_rating_warp").remove();
	jQuery("#vbegy_ratings_post").html(builder_rating_warp);
	if (jQuery("#vbegy_ratings_post").length > 0) {
		jQuery("#vbegy_ratings_post ul").sortable({placeholder: "ui-state-highlight"});
	}
	
	jQuery("#vbegy_slideshow_type").change(function () {
		var slideshow_type = jQuery(this).val();
		if (slideshow_type == "custom_slide") {
			jQuery("#vbegy_slideshow_post").slideDown(500);
			jQuery("[for='vbegy_upload_images']").parent().parent().slideUp(500);
		}else {
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[for='vbegy_upload_images']").parent().parent().slideDown(500);
		}
	});
	jQuery("#vbegy_what_post").change(function () {
		var what_post = jQuery(this).val();
		if (what_post == "google") {
			jQuery("#vbegy_google").parent().parent().slideDown(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_video_mp4").parent().parent().slideUp(500);
			jQuery("#vbegy_video_m4v").parent().parent().slideUp(500);
			jQuery("#vbegy_video_webm").parent().parent().slideUp(500);
			jQuery("#vbegy_video_ogv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_wmv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_flv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_image").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[for='vbegy_upload_images']").parent().parent().slideUp(500);
		}else if (what_post == "slideshow") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_video_mp4").parent().parent().slideUp(500);
			jQuery("#vbegy_video_m4v").parent().parent().slideUp(500);
			jQuery("#vbegy_video_webm").parent().parent().slideUp(500);
			jQuery("#vbegy_video_ogv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_wmv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_flv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_image").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideDown(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[for='vbegy_upload_images']").parent().parent().slideUp(500);
			
			var vbegy_slideshow_type = jQuery("#vbegy_slideshow_type").val();
			if (vbegy_slideshow_type == "custom_slide") {
				jQuery("#vbegy_slideshow_post").slideDown(500);
				jQuery("[for='vbegy_upload_images']").parent().parent().slideUp(500);
			}else {
				jQuery("#vbegy_slideshow_post").slideUp(500);
				jQuery("[for='vbegy_upload_images']").parent().parent().slideDown(500);
			}
		}else if (what_post == "video") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideDown(500);
			
			var vbegy_slideshow_type = jQuery("#vbegy_video_post_type").val();
			if (vbegy_slideshow_type == "html5") {
				jQuery("#vbegy_video_mp4").parent().parent().slideDown(500);
				jQuery("#vbegy_video_m4v").parent().parent().slideDown(500);
				jQuery("#vbegy_video_webm").parent().parent().slideDown(500);
				jQuery("#vbegy_video_ogv").parent().parent().slideDown(500);
				jQuery("#vbegy_video_wmv").parent().parent().slideDown(500);
				jQuery("#vbegy_video_flv").parent().parent().slideDown(500);
				jQuery("#vbegy_video_image").parent().parent().parent().slideDown(500);
			}else {
				jQuery("#vbegy_video_post_id").parent().parent().slideDown(500);
			}
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[for='vbegy_upload_images']").parent().parent().slideUp(500);
		}else {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_video_mp4").parent().parent().slideUp(500);
			jQuery("#vbegy_video_m4v").parent().parent().slideUp(500);
			jQuery("#vbegy_video_webm").parent().parent().slideUp(500);
			jQuery("#vbegy_video_ogv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_wmv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_flv").parent().parent().slideUp(500);
			jQuery("#vbegy_video_image").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[for='vbegy_upload_images']").parent().parent().slideUp(500);
		}
	});
	
	var vbegy_what_post = jQuery("#vbegy_what_post").val();
	var vbegy_slideshow_type = jQuery("#vbegy_slideshow_type").val();

	if (vbegy_what_post == "google") {
		jQuery("#vbegy_google").parent().parent().show(10);
	}else if (vbegy_what_post == "slideshow") {
		jQuery("#vbegy_slideshow_type").parent().parent().parent().show(10);
		if (vbegy_slideshow_type == "custom_slide") {
			jQuery("#vbegy_slideshow_post").show(10);
			jQuery("[for='vbegy_upload_images']").parent().parent().hide();
		}else {
			jQuery("#vbegy_slideshow_post").hide(10);
			jQuery("[for='vbegy_upload_images']").parent().parent().show(10);
		}
	}else if (vbegy_what_post == "video") {
		jQuery("#vbegy_video_post_type").parent().parent().parent().show(10);
		if (jQuery("#vbegy_video_post_type").val() == "html5") {
			jQuery("#vbegy_video_mp4").parent().parent().show(10);
			jQuery("#vbegy_video_m4v").parent().parent().show(10);
			jQuery("#vbegy_video_webm").parent().parent().show(10);
			jQuery("#vbegy_video_ogv").parent().parent().show(10);
			jQuery("#vbegy_video_wmv").parent().parent().show(10);
			jQuery("#vbegy_video_flv").parent().parent().show(10);
			jQuery("#vbegy_video_image").parent().parent().parent().show(10);
			jQuery("#vbegy_video_post_id").parent().parent().hide(10);
		}else {
			jQuery("#vbegy_video_post_id").parent().parent().show(10);
			jQuery("#vbegy_video_mp4").parent().parent().hide(10);
			jQuery("#vbegy_video_m4v").parent().parent().hide(10);
			jQuery("#vbegy_video_webm").parent().parent().hide(10);
			jQuery("#vbegy_video_ogv").parent().parent().hide(10);
			jQuery("#vbegy_video_wmv").parent().parent().hide(10);
			jQuery("#vbegy_video_flv").parent().parent().hide(10);
			jQuery("#vbegy_video_image").parent().parent().parent().hide(10);
		}
		jQuery("#vbegy_video_post_type").change(function () {
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideDown(500);
			if (jQuery("#vbegy_video_post_type").val() == "html5") {
				jQuery("#vbegy_video_mp4").parent().parent().slideDown(500);
				jQuery("#vbegy_video_m4v").parent().parent().slideDown(500);
				jQuery("#vbegy_video_webm").parent().parent().slideDown(500);
				jQuery("#vbegy_video_ogv").parent().parent().slideDown(500);
				jQuery("#vbegy_video_wmv").parent().parent().slideDown(500);
				jQuery("#vbegy_video_flv").parent().parent().slideDown(500);
				jQuery("#vbegy_video_image").parent().parent().parent().slideDown(500);
				jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			}else {
				jQuery("#vbegy_video_post_id").parent().parent().slideDown(500);
				jQuery("#vbegy_video_mp4").parent().parent().slideUp(500);
				jQuery("#vbegy_video_m4v").parent().parent().slideUp(500);
				jQuery("#vbegy_video_webm").parent().parent().slideUp(500);
				jQuery("#vbegy_video_ogv").parent().parent().slideUp(500);
				jQuery("#vbegy_video_wmv").parent().parent().slideUp(500);
				jQuery("#vbegy_video_flv").parent().parent().slideUp(500);
				jQuery("#vbegy_video_image").parent().parent().parent().slideUp(500);
			}
		});
	}
	
	if (jQuery("#vbegy_post_display_b").val() == "multiple_categories") {
		jQuery("label[for='vbegy_post_categories_b']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_single_category_b'],label[for='vbegy_post_posts_b']").parent().parent().hide(10);
	}else if (jQuery("#vbegy_post_display_b").val() == "single_category") {
		jQuery("label[for='vbegy_post_single_category_b']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_categories_b'],label[for='vbegy_post_posts_b']").parent().parent().hide(10);
	}else if (jQuery("#vbegy_post_display_b").val() == "posts") {
		jQuery("label[for='vbegy_post_posts_b']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_categories_b'],label[for='vbegy_post_single_category_b']").parent().parent().hide(10);
	}else {
		jQuery("label[for='vbegy_post_single_category_b'],label[for='vbegy_post_categories_b'],label[for='vbegy_post_posts_b']").parent().parent().hide(10);
	}
	
	jQuery("#vbegy_post_display_b").change(function () {
		if (jQuery(this).val() == "multiple_categories") {
			jQuery("label[for='vbegy_post_categories_b']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_single_category_b'],label[for='vbegy_post_posts_b']").parent().parent().slideUp(500);
		}else if (jQuery(this).val() == "single_category") {
			jQuery("label[for='vbegy_post_single_category_b']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_categories_b'],label[for='vbegy_post_posts_b']").parent().parent().slideUp(500);
		}else if (jQuery(this).val() == "posts") {
			jQuery("label[for='vbegy_post_posts_b']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_categories_b'],label[for='vbegy_post_single_category_b']").parent().parent().slideUp(500);
		}else {
			jQuery("label[for='vbegy_post_single_category_b'],label[for='vbegy_post_categories_b'],label[for='vbegy_post_posts_b']").parent().parent().slideUp(500);
		}
	});
	
	var video_description = jQuery("#vpanel_video_description:checked").length;
	if (video_description == 1) {
		jQuery(".video_description").slideDown(300);
	}else {
		jQuery(".video_description").slideUp(300);
	}
	
	jQuery("#vpanel_video_description").click(function () {
		var video_description_c = jQuery("#vpanel_video_description:checked").length;
		if (video_description_c == 1) {
			jQuery(".video_description").slideDown(300);
		}else {
			jQuery(".video_description").slideUp(300);
		}
	});
	
	var custom_sections = jQuery("#vbegy_custom_sections:checked").length;
	if (custom_sections == 1) {
		jQuery("#sort-sections").show(10);
	}else {
		jQuery("#sort-sections").hide(10);
	}
	jQuery("#vbegy_custom_sections").click(function () {
		var custom_sections = jQuery("#vbegy_custom_sections:checked").length;
		if (custom_sections == 1) {
			jQuery("#sort-sections").slideDown(500);
		}else {
			jQuery("#sort-sections").slideUp(500);
		}
	});
	
	/* Page template home */
	
	var page_template = jQuery("#page_template").val();
	if (page_template == "template-home.php") {
		jQuery("#ask_me").show(10);
	}else {
		jQuery("#ask_me").hide(10);
	}
	
	if (page_template == "template-users.php") {
		jQuery("#users_groups").show(10);
	}else {
		jQuery("#users_groups").hide(10);
	}
	
	if (page_template == "template-contact_us.php") {
		jQuery("#contact_us").show(10);
	}else {
		jQuery("#contact_us").hide(10);
	}
	
	if (page_template == "template-blog_1.php" || page_template == "template-blog_2.php") {
		jQuery("#blog").show(10);
	}else {
		jQuery("#blog").hide(10);
	}
	
	jQuery("#page_template").change(function () {
		var page_template = jQuery(this).val();
		if (page_template == "template-home.php") {
			jQuery("#ask_me").slideDown(500);
		}else {
			jQuery("#ask_me").slideUp(500);
		}
		
		if (page_template == "template-contact_us.php") {
			jQuery("#contact_us").slideDown(500);
		}else {
			jQuery("#contact_us").slideUp(500);
		}
		
		if (page_template == "template-users.php") {
			jQuery("#users_groups").slideDown(500);
		}else {
			jQuery("#users_groups").slideUp(500);
		}
		
		if (page_template == "template-blog_1.php" || page_template == "template-blog_2.php") {
			jQuery("#blog").slideDown(500);
		}else {
			jQuery("#blog").slideUp(500);
		}
	});
	
	if (jQuery("#vbegy_index_tabs").val() == 1) {
		jQuery("label[for='vbegy_what_tab'],label[for='vbegy_sort_home_elements'],label[for='vbegy_pagination_tabs'],label[for='vbegy_posts_per_page']").parent().parent().slideDown(500);
	}else if (jQuery("#vbegy_index_tabs").val() == 2) {
		jQuery("label[for='vbegy_posts_per_page']").parent().parent().slideDown(500);
		jQuery("label[for='vbegy_what_tab'],label[for='vbegy_sort_home_elements'],label[for='vbegy_pagination_tabs']").parent().parent().slideUp(500);
	}else {
		jQuery("label[for='vbegy_what_tab'],label[for='vbegy_sort_home_elements'],label[for='vbegy_pagination_tabs'],label[for='vbegy_posts_per_page']").parent().parent().slideUp(500);
	}
	
	jQuery("#vbegy_index_tabs").change(function () {
		if (jQuery("#vbegy_index_tabs").val() == 1) {
			jQuery("label[for='vbegy_what_tab'],label[for='vbegy_sort_home_elements'],label[for='vbegy_pagination_tabs'],label[for='vbegy_posts_per_page']").parent().parent().slideDown(500);
		}else if (jQuery("#vbegy_index_tabs").val() == 2) {
			jQuery("label[for='vbegy_posts_per_page']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_what_tab'],label[for='vbegy_sort_home_elements'],label[for='vbegy_pagination_tabs']").parent().parent().slideUp(500);
		}else {
			jQuery("label[for='vbegy_what_tab'],label[for='vbegy_sort_home_elements'],label[for='vbegy_pagination_tabs'],label[for='vbegy_posts_per_page']").parent().parent().slideUp(500);
		}
	});
	
	/* Categories Design */
	
	jQuery(".cat_name h4").after('<a class="cats-toggle-open">+</a><a class="cats-toggle-close">-</a>');
	
	jQuery(".cats-toggle-open").live("click" ,function () {
		jQuery(this).parent().next(".warp_cat_name").slideToggle(300);
		jQuery(this).css("display","none");
		jQuery(this).parent().find(".cats-toggle-close").css("display","block");
    });

	jQuery(".cats-toggle-close").live("click" ,function () {
		jQuery(this).parent().next(".warp_cat_name").slideToggle("fast");
		jQuery(this).css("display","none");
		jQuery(this).parent().find(".cats-toggle-open").css("display","block");
    });
    
    /* Header advertising */
    
    if (jQuery("#"+vpanel_name+"-header_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-header_adv_type-display_code:checked").length == 0) {
    	jQuery("#header_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-header_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-header_adv_type-custom_image:checked").length == 0) {
    	jQuery("#header_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_img").parent().parent().parent().hide(10);
    	jQuery("#header_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-header_adv_type-custom_image").click(function () {
    	jQuery("#header_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-header_adv_type-display_code").click(function () {
    	jQuery("#header_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#header_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#header_adv_code").parent().parent().parent().slideDown(500);
    });
    
    
	if (jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type']:checked").length == 0) {
		jQuery("#vbegy_header_adv_img").parent().parent().slideDown(500);
		jQuery("#vbegy_header_adv_href").parent().parent().slideDown(500);
		jQuery("#vbegy_header_adv_code").parent().parent().hide(10);
	}else if (jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type']:checked").length == 0) {
		jQuery("#vbegy_header_adv_code").parent().parent().slideDown(500);
		jQuery("#vbegy_header_adv_img").parent().parent().hide(10);
		jQuery("#vbegy_header_adv_href").parent().parent().hide(10);
	}
    jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type']").click(function () {
    	jQuery("#vbegy_header_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_code").parent().parent().slideUp(500);
    });
    jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type']").click(function () {
    	jQuery("#vbegy_header_adv_img").parent().parent().slideUp(500);
    	jQuery("#vbegy_header_adv_href").parent().parent().slideUp(500);
    	jQuery("#vbegy_header_adv_code").parent().parent().slideDown(500);
    });
    
    /* Share advertising */
    
    if (jQuery("#"+vpanel_name+"-share_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-share_adv_type-display_code:checked").length == 0) {
    	jQuery("#share_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-share_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-share_adv_type-custom_image:checked").length == 0) {
    	jQuery("#share_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_img").parent().parent().parent().hide(10);
    	jQuery("#share_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-share_adv_type-custom_image").click(function () {
    	jQuery("#share_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-share_adv_type-display_code").click(function () {
    	jQuery("#share_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#share_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#share_adv_code").parent().parent().parent().slideDown(500);
    });
    
    
    if (jQuery(".rwmb-input input[value='custom_image'][name='vbegy_share_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='display_code'][name='vbegy_share_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_share_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_code").parent().parent().hide(10);
    }else if (jQuery(".rwmb-input input[value='display_code'][name='vbegy_share_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='custom_image'][name='vbegy_share_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_share_adv_code").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_img").parent().parent().hide(10);
    	jQuery("#vbegy_share_adv_href").parent().parent().hide(10);
    }
    jQuery(".rwmb-input input[value='custom_image'][name='vbegy_share_adv_type']").click(function () {
    	jQuery("#vbegy_share_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_code").parent().parent().slideUp(500);
    });
    jQuery(".rwmb-input input[value='display_code'][name='vbegy_share_adv_type']").click(function () {
    	jQuery("#vbegy_share_adv_img").parent().parent().slideUp(500);
    	jQuery("#vbegy_share_adv_href").parent().parent().slideUp(500);
    	jQuery("#vbegy_share_adv_code").parent().parent().slideDown(500);
    });
    
    /* Related advertising */
    
    if (jQuery("#"+vpanel_name+"-related_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-related_adv_type-display_code:checked").length == 0) {
    	jQuery("#related_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#related_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#related_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-related_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-related_adv_type-custom_image:checked").length == 0) {
    	jQuery("#related_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#related_adv_img").parent().parent().parent().hide(10);
    	jQuery("#related_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-related_adv_type-custom_image").click(function () {
    	jQuery("#related_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#related_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#related_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-related_adv_type-display_code").click(function () {
    	jQuery("#related_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#related_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#related_adv_code").parent().parent().parent().slideDown(500);
    });
    
    
    if (jQuery(".rwmb-input input[value='custom_image'][name='vbegy_related_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='display_code'][name='vbegy_related_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_related_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_related_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_related_adv_code").parent().parent().hide(10);
    }else if (jQuery(".rwmb-input input[value='display_code'][name='vbegy_related_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='custom_image'][name='vbegy_related_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_related_adv_code").parent().parent().slideDown(500);
    	jQuery("#vbegy_related_adv_img").parent().parent().hide(10);
    	jQuery("#vbegy_related_adv_href").parent().parent().hide(10);
    }
    jQuery(".rwmb-input input[value='custom_image'][name='vbegy_related_adv_type']").click(function () {
    	jQuery("#vbegy_related_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_related_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_related_adv_code").parent().parent().slideUp(500);
    });
    jQuery(".rwmb-input input[value='display_code'][name='vbegy_related_adv_type']").click(function () {
    	jQuery("#vbegy_related_adv_img").parent().parent().slideUp(500);
    	jQuery("#vbegy_related_adv_href").parent().parent().slideUp(500);
    	jQuery("#vbegy_related_adv_code").parent().parent().slideDown(500);
    });
    
    /* Content advertising */
    
    if (jQuery("#"+vpanel_name+"-content_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-content_adv_type-display_code:checked").length == 0) {
    	jQuery("#content_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-content_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-content_adv_type-custom_image:checked").length == 0) {
    	jQuery("#content_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_img").parent().parent().parent().hide(10);
    	jQuery("#content_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-content_adv_type-custom_image").click(function () {
    	jQuery("#content_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-content_adv_type-display_code").click(function () {
    	jQuery("#content_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#content_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#content_adv_code").parent().parent().parent().slideDown(500);
    });
    
    
    if (jQuery(".rwmb-input input[value='custom_image'][name='vbegy_content_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='display_code'][name='vbegy_content_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_content_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_code").parent().parent().hide(10);
    }else if (jQuery(".rwmb-input input[value='display_code'][name='vbegy_content_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='custom_image'][name='vbegy_content_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_content_adv_code").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_img").parent().parent().hide(10);
    	jQuery("#vbegy_content_adv_href").parent().parent().hide(10);
    }
    jQuery(".rwmb-input input[value='custom_image'][name='vbegy_content_adv_type']").click(function () {
    	jQuery("#vbegy_content_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_code").parent().parent().slideUp(500);
    });
    jQuery(".rwmb-input input[value='display_code'][name='vbegy_content_adv_type']").click(function () {
    	jQuery("#vbegy_content_adv_img").parent().parent().slideUp(500);
    	jQuery("#vbegy_content_adv_href").parent().parent().slideUp(500);
    	jQuery("#vbegy_content_adv_code").parent().parent().slideDown(500);
    });
    
    /* Between questions advertising */
    
    if (jQuery("#"+vpanel_name+"-between_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-between_adv_type-display_code:checked").length == 0) {
    	jQuery("#between_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#between_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#between_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-between_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-between_adv_type-custom_image:checked").length == 0) {
    	jQuery("#between_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#between_adv_img").parent().parent().parent().hide(10);
    	jQuery("#between_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-between_adv_type-custom_image").click(function () {
    	jQuery("#between_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#between_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#between_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-between_adv_type-display_code").click(function () {
    	jQuery("#between_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#between_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#between_adv_code").parent().parent().parent().slideDown(500);
    });
    
    /* Between comments advertising */
    
    if (jQuery("#"+vpanel_name+"-between_comments_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-between_comments_adv_type-display_code:checked").length == 0) {
    	jQuery("#between_comments_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#between_comments_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#between_comments_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-between_comments_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-between_comments_adv_type-custom_image:checked").length == 0) {
    	jQuery("#between_comments_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#between_comments_adv_img").parent().parent().parent().hide(10);
    	jQuery("#between_comments_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-between_comments_adv_type-custom_image").click(function () {
    	jQuery("#between_comments_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#between_comments_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#between_comments_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-between_comments_adv_type-display_code").click(function () {
    	jQuery("#between_comments_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#between_comments_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#between_comments_adv_code").parent().parent().parent().slideDown(500);
    });
});