jQuery(function ($) {


	// Slider Options
	if ($('select[name=_slider_choice]').length){
		
		var slider_choice = $("select[name='_slider_choice']").val();
		slider_choice = slider_choice.split('---');
		slider_choice = slider_choice[0];
		if (slider_choice == 'ESPRESSOSLIDE'){
			$("input[name='_es_blur_auto_cycle[]']").parents('.ecf-field-container').show();
			$("select[name='_es_blur_speed']").parents('.ecf-field-container').show();
		} else {
			$("input[name='_es_blur_auto_cycle[]']").parents('.ecf-field-container').hide();
			$("select[name='_es_blur_speed']").parents('.ecf-field-container').hide();
		}
		
		$("select[name='_slider_choice']").change(function(){
			
			var slider_choice = $(this).val();
			slider_choice = slider_choice.split('---');
			slider_choice = slider_choice[0];
			
			if (slider_choice == 'ESPRESSOSLIDE'){
				$("input[name='_es_blur_auto_cycle[]']").parents('.ecf-field-container').slideDown('fast');
				$("select[name='_es_blur_speed']").parents('.ecf-field-container').slideDown('fast');
			} else {
				$("input[name='_es_blur_auto_cycle[]']").parents('.ecf-field-container').slideUp('fast');
				$("select[name='_es_blur_speed']").parents('.ecf-field-container').slideUp('fast');
			}
		
		});
		
	}


	// Feature Blocks - SETUP
	if ($('select[name=_feature_blocks_order]').length){

		var feature_block_choice = $("input:radio[name='_feature_block_layout[]']:checked").val();
		if (typeof feature_block_choice === 'undefined' || feature_block_choice == 'no-blocks'){
			$('select[name=_feature_blocks_order]').parents('.ecf-field-container').hide();
			$('select[name=_feature_block_1]').parents('.ecf-field-container').hide();
			$('select[name=_feature_block_2]').parents('.ecf-field-container').hide();
			$('select[name=_feature_block_3]').parents('.ecf-field-container').hide();
		} else if (feature_block_choice == 'one'){
			$('select[name=_feature_blocks_order]').parents('.ecf-field-container').show();
			$('select[name=_feature_block_1]').parents('.ecf-field-container').show();
			$('select[name=_feature_block_2]').parents('.ecf-field-container').hide();
			$('select[name=_feature_block_3]').parents('.ecf-field-container').hide();
		} else if (feature_block_choice == 'two'){
			$('select[name=_feature_blocks_order]').parents('.ecf-field-container').show();
			$('select[name=_feature_block_1]').parents('.ecf-field-container').show();
			$('select[name=_feature_block_2]').parents('.ecf-field-container').show();
			$('select[name=_feature_block_3]').parents('.ecf-field-container').hide();
		} else if (feature_block_choice == 'three'){
			$('select[name=_feature_blocks_order]').parents('.ecf-field-container').show();
			$('select[name=_feature_block_1]').parents('.ecf-field-container').show();
			$('select[name=_feature_block_2]').parents('.ecf-field-container').show();
			$('select[name=_feature_block_3]').parents('.ecf-field-container').show();
		}
		
		// Feature Blocks - On Click
		var feature_block_choice = $('#page_settings_panel').find('img.radio_image');
		feature_block_choice.click(function(){
			var thisID = $(this).attr('rel');
			if (thisID == 'no-blocks'){
				$('select[name=_feature_blocks_order]').parents('.ecf-field-container').slideUp('fast');
				$('select[name=_feature_block_1]').parents('.ecf-field-container').slideUp('fast');
				$('select[name=_feature_block_2]').parents('.ecf-field-container').slideUp('fast');
				$('select[name=_feature_block_3]').parents('.ecf-field-container').slideUp('fast');
			} else if (thisID == 'one-block'){
				$('select[name=_feature_blocks_order]').parents('.ecf-field-container').slideDown('fast');
				$('select[name=_feature_block_1]').parents('.ecf-field-container').slideDown('fast');
				$('select[name=_feature_block_2]').parents('.ecf-field-container').slideUp('fast');
				$('select[name=_feature_block_3]').parents('.ecf-field-container').slideUp('fast');
			} else if (thisID == 'two-blocks'){
				$('select[name=_feature_blocks_order]').parents('.ecf-field-container').slideDown('fast');
				$('select[name=_feature_block_1]').parents('.ecf-field-container').slideDown('fast');
				$('select[name=_feature_block_2]').parents('.ecf-field-container').slideDown('fast');
				$('select[name=_feature_block_3]').parents('.ecf-field-container').slideUp('fast');
			} else if (thisID == 'three-blocks'){
				$('select[name=_feature_blocks_order]').parents('.ecf-field-container').slideDown('fast');
				$('select[name=_feature_block_1]').parents('.ecf-field-container').slideDown('fast');
				$('select[name=_feature_block_2]').parents('.ecf-field-container').slideDown('fast');
				$('select[name=_feature_block_3]').parents('.ecf-field-container').slideDown('fast');
			}
		});
		
	}
	


	// Posts - SETUP
	$('#page_settings_panel').find('select[name=_recent_posts_order]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('input[name=_recent_posts_title]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('select[name=_post_category]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('select[name=_post_count]').parents('.ecf-field-container').hide();
	var recentpost_setting = $("input[name='_display_recent_posts[]']:checked").length;
	if (recentpost_setting){
		$('#page_settings_panel').find('select[name=_recent_posts_order]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('input[name=_recent_posts_title]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('select[name=_post_category]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('select[name=_post_count]').parents('.ecf-field-container').show();
	}
	
	$("input[name='_display_recent_posts[]']").click(function(){
		if($(this).is(":checked")){
			$('#page_settings_panel').find('select[name=_recent_posts_order]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('input[name=_recent_posts_title]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('select[name=_post_category]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('select[name=_post_count]').parents('.ecf-field-container').slideDown('fast');
		} else {
			$('#page_settings_panel').find('select[name=_recent_posts_order]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('input[name=_recent_posts_title]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('select[name=_post_category]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('select[name=_post_count]').parents('.ecf-field-container').slideUp('fast');
		}
	});
	
	
	
	// Upcoming Events
	$('#page_settings_panel').find('select[name=_event_items_order]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('input[name=_event_items_title]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('select[name=_event_count]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('select[name=_event_category]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('select[name=_event_style]').parents('.ecf-field-container').hide();
	var events_setting = $("input[name='_display_upcoming_events[]']:checked").length;
	if (events_setting){
		$('#page_settings_panel').find('select[name=_event_items_order]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('input[name=_event_items_title]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('select[name=_event_category]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('select[name=_event_count]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('select[name=_event_style]').parents('.ecf-field-container').show();
		var events_style = $("select[name='_event_style']").val();
		if (events_style == 'schedule'){
			$('#page_settings_panel').find('select[name=_event_count]').parents('.ecf-field-container').hide();
		} else {
			$('#page_settings_panel').find('select[name=_event_count]').parents('.ecf-field-container').show();
		}
	}
	
	$("select[name='_event_style']").change(function(){
		var events_style = $(this).val();
		if (events_style == 'schedule'){
			$('#page_settings_panel').find('select[name=_event_count]').parents('.ecf-field-container').hide();
		} else {
			$('#page_settings_panel').find('select[name=_event_count]').parents('.ecf-field-container').show();
		}
	});
		
	
	$("input[name='_display_upcoming_events[]']").click(function(){
		if($(this).is(":checked")){
			$('#page_settings_panel').find('select[name=_event_items_order]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('input[name=_event_items_title]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('select[name=_event_count]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('select[name=_event_style]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('select[name=_event_category]').parents('.ecf-field-container').slideDown('fast');
		} else {
			$('#page_settings_panel').find('select[name=_event_items_order]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('input[name=_event_items_title]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('select[name=_event_count]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('select[name=_event_style]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('select[name=_event_category]').parents('.ecf-field-container').slideUp('fast');
		}
	});
	
	
	
	// Parallax Zone
	$('#page_settings_panel').find('select[name=_parallax_order]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('textarea[name=_parallax_text]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('select[name=_parallax_font_size]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('input[name=_parallax_image]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('input[name=_parallax_height]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('input[name=_parallax_padding]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('input[name=_parallax_color]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('select[name=_parallax_color_opacity]').parents('.ecf-field-container').hide();
	
	var parallax_settings = $("input[name='_display_parallax[]']:checked").length;
	if (parallax_settings){
		$('#page_settings_panel').find('select[name=_parallax_order]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('textarea[name=_parallax_text]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('select[name=_parallax_font_size]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('input[name=_parallax_image]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('input[name=_parallax_height]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('input[name=_parallax_padding]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('input[name=_parallax_color]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('select[name=_parallax_color_opacity]').parents('.ecf-field-container').show();
	}
	
	$("input[name='_display_parallax[]']").click(function(){
		if($(this).is(":checked")){
			$('#page_settings_panel').find('select[name=_parallax_order]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('textarea[name=_parallax_text]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('select[name=_parallax_font_size]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('input[name=_parallax_image]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('input[name=_parallax_height]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('input[name=_parallax_padding]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('input[name=_parallax_color]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('select[name=_parallax_color_opacity]').parents('.ecf-field-container').slideDown('fast');
		} else {
			$('#page_settings_panel').find('select[name=_parallax_order]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('textarea[name=_parallax_text]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('select[name=_parallax_font_size]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('input[name=_parallax_image]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('input[name=_parallax_height]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('input[name=_parallax_padding]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('input[name=_parallax_color]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('select[name=_parallax_color_opacity]').parents('.ecf-field-container').slideUp('fast');
		}
	});
	
	
	
	// Tweets - SETUP
	$('#page_settings_panel').find('select[name=_recent_tweets_order]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('input[name=_recent_tweets_title]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('input[name=_recent_tweets_user]').parents('.ecf-field-container').hide();
	$('#page_settings_panel').find('select[name=_tweet_count]').parents('.ecf-field-container').hide();
	var recenttweets_setting = $("input[name='_display_recent_tweets[]']:checked").length;
	if (recenttweets_setting){
		$('#page_settings_panel').find('select[name=_recent_tweets_order]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('input[name=_recent_tweets_title]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('input[name=_recent_tweets_user]').parents('.ecf-field-container').show();
		$('#page_settings_panel').find('select[name=_tweet_count]').parents('.ecf-field-container').show();
	}
	
	$("input[name='_display_recent_tweets[]']").click(function(){
		if($(this).is(":checked")){
			$('#page_settings_panel').find('select[name=_recent_tweets_order]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('input[name=_recent_tweets_title]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('input[name=_recent_tweets_user]').parents('.ecf-field-container').slideDown('fast');
			$('#page_settings_panel').find('select[name=_tweet_count]').parents('.ecf-field-container').slideDown('fast');
		} else {
			$('#page_settings_panel').find('select[name=_recent_tweets_order]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('input[name=_recent_tweets_title]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('input[name=_recent_tweets_user]').parents('.ecf-field-container').slideUp('fast');
			$('#page_settings_panel').find('select[name=_tweet_count]').parents('.ecf-field-container').slideUp('fast');
		}
	});
	
	
	
	// Page Widgets - SETUP
	$('select[name=_widget_items_order]').parents('.ecf-field-container').hide();
	var widget_choice = $("input:radio[name='_widget_layout[]']:checked").val();
	if (typeof widget_choice === 'undefined' || widget_choice == 'no-widgets'){
		$('select[name=_widget_items_order]').parents('.ecf-field-container').hide();
		$('select[name=_widget_block_1]').parents('.ecf-field-container').hide();
		$('select[name=_widget_block_2]').parents('.ecf-field-container').hide();
		$('select[name=_widget_block_3]').parents('.ecf-field-container').hide();
	} else if (widget_choice == 'one'){
		$('select[name=_widget_items_order]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_1]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_2]').parents('.ecf-field-container').hide();
		$('select[name=_widget_block_3]').parents('.ecf-field-container').hide();
	} else if (widget_choice == 'two'){
		$('select[name=_widget_items_order]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_1]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_2]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_3]').parents('.ecf-field-container').hide();
	} else if (widget_choice == 'three'){
		$('select[name=_widget_items_order]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_1]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_2]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_3]').parents('.ecf-field-container').show();
	} else if (widget_choice == 'onethird_twothird'){
		$('select[name=_widget_items_order]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_1]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_2]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_3]').parents('.ecf-field-container').hide();
	} else if (widget_choice == 'onethird_twothird' || widget_choice == 'twothird_onethird'){
		$('select[name=_widget_items_order]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_1]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_2]').parents('.ecf-field-container').show();
		$('select[name=_widget_block_3]').parents('.ecf-field-container').hide();
	}
	
	// Page Widgets - On Click
	var widget_choice = $('#page_settings_panel').find('img.radio_image');
	widget_choice.click(function(){
		var thisID = $(this).attr('rel');
		if (thisID == 'no-widgets'){
			$('select[name=_widget_items_order]').parents('.ecf-field-container').slideUp('fast');
			$('select[name=_widget_block_1]').parents('.ecf-field-container').slideUp('fast');
			$('select[name=_widget_block_2]').parents('.ecf-field-container').slideUp('fast');
			$('select[name=_widget_block_3]').parents('.ecf-field-container').slideUp('fast');
		} else if (thisID == 'one'){
			$('select[name=_widget_items_order]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_1]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_2]').parents('.ecf-field-container').slideUp('fast');
			$('select[name=_widget_block_3]').parents('.ecf-field-container').slideUp('fast');
		} else if (thisID == 'two'){
			$('select[name=_widget_items_order]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_1]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_2]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_3]').parents('.ecf-field-container').slideUp('fast');
		} else if (thisID == 'three'){
			$('select[name=_widget_items_order]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_1]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_2]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_3]').parents('.ecf-field-container').slideDown('fast');
		} else if (thisID == 'onethird_twothird'){
			$('select[name=_widget_items_order]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_1]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_2]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_3]').parents('.ecf-field-container').slideUp('fast');
		} else if (thisID == 'onethird_twothird' || thisID == 'twothird_onethird'){
			$('select[name=_widget_items_order]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_1]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_2]').parents('.ecf-field-container').slideDown('fast');
			$('select[name=_widget_block_3]').parents('.ecf-field-container').slideUp('fast');
		}
	});
	

});