jQuery(document).ready( function($) {
    
    jQuery("input.vpanel_save").click(function(){
    	jQuery("#ajax-saving").fadeIn("slow");
    	jQuery("#loading").show();
    	if (jQuery(".vpanel_editor").length > 0) {
    		tinyMCE.triggerSave();
    	}
    	var options_fromform = jQuery('#main_options_form').serialize();
    	var options_fromform2 = options_fromform+"&action=vpanel_update_options";
    	jQuery.post(ajax_a,options_fromform2,function (data) {
    		jQuery(".vpanel_save").blur();
    		//jQuery("#optionsframework-wrap").prepend(data);
    		setTimeout(function(){
    			jQuery("#ajax-saving").fadeOut("slow");
    			jQuery("#loading").hide();
    		},200);
    		if (data == 2) {
    			jQuery("#import_setting").val("");
    			location.reload();
    		}else if (data == 3) {
    			location.reload();
    		}
    	});
    	return false;
    });
	
    jQuery("#reset_c").click(function() {
    	var answer = confirm(confirm_reset);
    	if (answer) {
    		jQuery("#ajax-reset").fadeIn("slow");
    		var defaults = "&action=reset_options";
    		jQuery.post(ajax_a,defaults,function (data) {
    			jQuery("#reset_c").blur();
    			setTimeout(function(){
    				jQuery("#ajax-reset").fadeOut("slow");
    				//jQuery("body").prepend(data);
    				location.reload();
    			},200);
    		});
    	}
    	return false;
    });
    
    if (jQuery('#sort-sections').length > 0) {
    	jQuery('#sort-sections').sortable();
    }
    
    if (jQuery('.sort-sections').length) {
        jQuery('.sort-sections').each(function () {
        	if (!jQuery(this).hasClass("not-sort") && !jQuery(this).hasClass("sort-sections-with")) {
        		jQuery(this).sortable({placeholder: "ui-state-highlight",handle: ".widget-head",cancel: ".builder-toggle-open,.builder-toggle-close,.builder_clone,.del-builder-item"});
        	}
        });
    }
    
    /* Delete reports */
    jQuery(".reports-delete").click(function () {
    	var answer = confirm(confirm_reports);
    	if (answer) {
    		var reports_delete = jQuery(this);
    		var reports_delete_id = reports_delete.attr("attr");
    		if (reports_delete.hasClass("reports-answers")) {
	    		jQuery.post(ajax_a,"action=reports_answers_delete&reports_delete_id="+reports_delete_id,function (result) {
	    			reports_delete.parent().parent().addClass('removered').fadeOut(function() {
	    				jQuery(this).remove();
	    				if (jQuery(".reports-table-items .reports-table-item").length == 0) {
	    					jQuery(".reports-table-items").html("<p>There are no reports yet</p>");
	    				}
	    				if (jQuery(".ask-reports-items .ask-reports").length == 0) {
	    					jQuery(".ask-reports-items").html("<p>There are no reports yet</p>");
	    				}
	    			});
	    		});
	    	}else {
	    		jQuery.post(ajax_a,"action=reports_delete&reports_delete_id="+reports_delete_id,function (result) {
	    			reports_delete.parent().parent().addClass('removered').fadeOut(function() {
	    				jQuery(this).remove();
	    				if (jQuery(".reports-table-items .reports-table-item").length == 0) {
	    					jQuery(".reports-table-items").html("<p>There are no reports yet</p>");
	    				}
	    				if (jQuery(".ask-reports-items .ask-reports").length == 0) {
	    					jQuery(".ask-reports-items").html("<p>There are no reports yet</p>");
	    				}
	    			});
	    		});
	    	}
    	}
    	return false;
    });
    
    /* View reports */
    jQuery(".reports-view").click(function () {
    	var reports_view = jQuery(this);
    	var reports_view_attr = "#reports-"+reports_view.attr("attr");
    	jQuery(reports_view_attr).slideDown();
    	
    	jQuery("body").prepend("<div class='reports-hidden'></div>");
    	wrap_pop();
    	var count_report_new = jQuery(".wp-submenu-head .count_lasts").text();
    	var count_report_new_last = count_report_new-1;
    	if (reports_view.hasClass("reports-answers")) {
	    	jQuery.post(ajax_a,"action=reports_answers_view&reports_view_id="+reports_view.attr("attr"),function (result) {
	    		reports_view.parent().find(".reports-new").hide();
	    		
	    		var count_report_answer_new = jQuery(".count_report_answer_new").text();
	    		var count_report_answer_new_last = count_report_answer_new-1;
	    		if (count_report_new > 0 && reports_view.parent().find(".reports-new").length > 0) {
	    			jQuery(".count_lasts").text(count_report_new_last);
	    			jQuery(".count_lasts").removeClass("count-"+count_report_new).addClass("count-"+count_report_new_last);
	    			
	    			jQuery(".count_report_answer_new").text(count_report_answer_new_last);
	    			jQuery(".count_report_answer_new").removeClass("count-"+count_report_answer_new).addClass("count-"+count_report_answer_new_last);
	    		}
	    	});
    	}else {
    		jQuery.post(ajax_a,"action=reports_view&reports_view_id="+reports_view.attr("attr"),function (result) {
    			reports_view.parent().find(".reports-new").hide();
    			
    			var count_report_question_new = jQuery(".count_report_question_new").text();
    			var count_report_question_new_last = count_report_question_new-1;
    			if (count_report_new > 0 && reports_view.parent().find(".reports-new").length > 0) {
    				jQuery(".count_lasts").text(count_report_new_last);
    				jQuery(".count_lasts").removeClass("count-"+count_report_new).addClass("count-"+count_report_new_last);
    				
    				jQuery(".count_report_question_new").text(count_report_question_new_last);
    				jQuery(".count_report_question_new").removeClass("count-"+count_report_question_new).addClass("count-"+count_report_question_new_last);
    			}
    		});
    	}
    	return false;
    });
    
    /* Close reports */
    jQuery(".reports-close").click(function () {
    	jQuery(".reports-pop").animate({"top":"-50%"},500).hide(function () {
    		jQuery(this).animate({"top":"-50%"},500);
    	});
    	jQuery(".reports-hidden").remove();
    	return false;
    });
    
    /* Function pop */
    function wrap_pop() {
    	jQuery(".reports-hidden").click(function () {
    		jQuery(".reports-pop").slideUp();
    		jQuery(this).remove();
    	});
    }
    
    /* Publishing action post */
    jQuery("#publishing-action #publish").click(function () {
    	/*
    	var return_f = false;
    	var post_ID = jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().find("#post_ID").val();
    	jQuery.post(ajax_a,"action=publishing_action_post&post_ID="+post_ID,function (result) {
    		alert(result);
    		return_f = true;
    		setTimeout(function(){
    			var return_f = true;
    			alert(return_f);
    		},200);
    	});
    	alert(return_f);
    	return return_f;
    	*/
    });
    
    jQuery(".delete-this-attachment").click(function () {
    	var answer = confirm(confirm_delete_attachment);
    	if (answer) {
	    	var delete_attachment = jQuery(this);
	    	var attachment_id = delete_attachment.attr("href");
	    	var post_id = jQuery("#post_ID").val();
	    	var single_attachment = "No";
	    	if (delete_attachment.hasClass("single-attachment")) {
	    		single_attachment = "Yes";
	    	}
	    	jQuery.post(ajax_a,"action=confirm_delete_attachment&attachment_id="+attachment_id+"&post_id="+post_id+"&single_attachment="+single_attachment,function (result) {
	    		delete_attachment.parent().fadeOut(function() {
	    			jQuery(this).remove();
	    		});
	    	});
    	}
    	return false;
    });
    
	jQuery(".vpanel_checkbox:checkbox,#vbegy_page_builder:checkbox,#vbegy_review_display,#vbegy_background_full,#vbegy_top_menu,#vbegy_header_adv,#vbegy_main_menu,#vbegy_social_icon_h,#vbegy_rss_icon_h,#vbegy_news_ticker,#vbegy_carousel_h,#header_fixed,#vpanel_question_poll,#vpanel_remember_answer,#vbegy_index_top_box,#vbegy_about_widget,#vbegy_social,#vbegy_rss,#vpanel_video_description,#vbegy_background_full_home,#vbegy_custom_page_setting,#vbegy_post_meta_s,#vbegy_post_share_s,#vbegy_post_navigation_s,#vbegy_post_author_box_s,#vbegy_related_post_s,#vbegy_post_comments_s,#vbegy_custom_sections,#vbegy_remove_index_content,#vbegy_pagination_tabs,#vbegy_sticky_sidebar_s").checkbox({cls:'vpanel_checkbox'});
	
    jQuery(".vpanel_multicheck:checkbox,.rwmb-checkbox_list:checkbox").checkbox({cls:'vpanel_multicheck'});
    
    jQuery('input[name="vbegy_sidebar"][value="right"],input[name="categories[cat_sidebar_layout]"][value="right"]').checkbox({cls:'jquery-sidebar-right'});
    jQuery('input[name="vbegy_sidebar"][value="full"],input[name="categories[cat_sidebar_layout]"][value="full"]').checkbox({cls:'jquery-sidebar-full'});
    jQuery('input[name="vbegy_sidebar"][value="left"],input[name="categories[cat_sidebar_layout]"][value="left"]').checkbox({cls:'jquery-sidebar-left'});
    jQuery('input[name="vbegy_sidebar"][value="default"],input[name="vbegy_layout"][value="default"],input[name="vbegy_site_skin_l"][value="default"],input[name="vbegy_home_template"][value="default"],input[name="categories[cat_layout]"][value="default"],input[name="categories[cat_template]"][value="default"],input[name="categories[cat_sidebar_layout]"][value="default"],input[name="categories[cat_skin_l]"][value="default"]').checkbox({cls:'jquery-sidebar-default'});
    
    jQuery('input[name="vbegy_layout"][value="full"],input[name="categories[cat_layout]"][value="full"]').checkbox({cls:'jquery-layout-full'});
    jQuery('input[name="vbegy_layout"][value="fixed"],input[name="categories[cat_layout]"][value="fixed"]').checkbox({cls:'jquery-layout-fixed'});
    jQuery('input[name="vbegy_layout"][value="fixed_2"],input[name="categories[cat_layout]"][value="fixed_2"]').checkbox({cls:'jquery-layout-fixed_2'});
    
    jQuery('input[name="vbegy_home_template"][value="grid_1200"],input[name="categories[cat_template]"][value="grid_1200"]').checkbox({cls:'jquery-grid_1200'});
    jQuery('input[name="vbegy_home_template"][value="grid_970"],input[name="categories[cat_template]"][value="grid_970"]').checkbox({cls:'jquery-grid_970'});
    jQuery('input[name="vbegy_site_skin_l"][value="site_light"],input[name="categories[cat_skin_l]"][value="site_light"]').checkbox({cls:'jquery-site_light'});
    jQuery('input[name="vbegy_site_skin_l"][value="site_dark"],input[name="categories[cat_skin_l]"][value="site_dark"]').checkbox({cls:'jquery-site_dark'});
    
    jQuery('input[name="vbegy_skin"][value="skin"],input[name="categories[cat_skin]"][value="skin"]').checkbox({cls:'jquery-skin-skin'});
    jQuery('input[name="vbegy_skin"][value="default"],input[name="categories[cat_skin]"][value="default"]').checkbox({cls:'jquery-skin-default'});
    jQuery('input[name="vbegy_skin"][value="green"],input[name="categories[cat_skin]"][value="green"]').checkbox({cls:'jquery-skin-green'});
    jQuery('input[name="vbegy_skin"][value="gray"],input[name="categories[cat_skin]"][value="gray"]').checkbox({cls:'jquery-skin-gray'});
    jQuery('input[name="vbegy_skin"][value="moderate_cyan"],input[name="categories[cat_skin]"][value="moderate_cyan"]').checkbox({cls:'jquery-skin-moderate_cyan'});
    jQuery('input[name="vbegy_skin"][value="orange"],input[name="categories[cat_skin]"][value="orange"]').checkbox({cls:'jquery-skin-orange'});
    jQuery('input[name="vbegy_skin"][value="purple"],input[name="categories[cat_skin]"][value="purple"]').checkbox({cls:'jquery-skin-purple'});
    jQuery('input[name="vbegy_skin"][value="blue"],input[name="categories[cat_skin]"][value="blue"]').checkbox({cls:'jquery-skin-blue'});
    jQuery('input[name="vbegy_skin"][value="yellow"],input[name="categories[cat_skin]"][value="yellow"]').checkbox({cls:'jquery-skin-yellow'});
    jQuery('input[name="vbegy_skin"][value="strong_cyan"],input[name="categories[cat_skin]"][value="strong_cyan"]').checkbox({cls:'jquery-skin-strong_cyan'});
    jQuery('input[name="vbegy_skin"][value="red"],input[name="categories[cat_skin]"][value="red"]').checkbox({cls:'jquery-skin-red'});
    
    
    jQuery('input[name="vbegy_footer_layout"][value="footer_1c"]').checkbox({cls:'jquery-footer_1c'});
    jQuery('input[name="vbegy_footer_layout"][value="footer_2c"]').checkbox({cls:'jquery-footer_2c'});
    jQuery('input[name="vbegy_footer_layout"][value="footer_3c"]').checkbox({cls:'jquery-footer_3c'});
    jQuery('input[name="vbegy_footer_layout"][value="footer_4c"]').checkbox({cls:'jquery-footer_4c'});
    jQuery('input[name="vbegy_footer_layout"][value="footer_no"]').checkbox({cls:'jquery-footer_no'});
    
    jQuery('.tooltip_n').tipsy({gravity: 'n'});
    jQuery('.tooltip_s').tipsy({gravity: 's'});
    
    jQuery('.wp-color-picker').wpColorPicker();
    
});