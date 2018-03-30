/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {
	
	// Fade out the save message
	$('.fade').delay(10000).fadeOut(1000);
	
	$('.of-color').wpColorPicker();
	
	// Switches option sections
	$('.group').hide();
	var active_tab = '';
	if (typeof(localStorage) != 'undefined' ) {
		active_tab = localStorage.getItem("active_tab");
	}
	if (active_tab != '' && $(active_tab).length ) {
		$(active_tab).show();
	} else {
		$('.group:first').show();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
					return false;
				}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
	if (active_tab != '' && $(active_tab + '-tab').length ) {
		$(active_tab + '-tab').addClass('nav-tab-active');
	}
	else {
		$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}
	
	$('.nav-tab-wrapper a').click(function(evt) {
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("active_tab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
		
		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $(this).find('iframe');
			if ( editor_iframe.height() < 30 ) {
				editor_iframe.css({'height':'auto'});
			}
		});
	});

	$('.group .collapsed input:checkbox').click(unhideHidden);

	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;
					}
				$(this).addClass('hidden');
			});
		}
	}
	
	// Image Options
	$('.of-radio-img-label').click(function(){
		$(this).parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).find('.of-radio-img-img').addClass('of-radio-img-selected');
	});
		
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	
	// Show/Hide Logo Options
	if ($('#section-logo_type input[type="radio"]:checked').val() == 'img_logo') {
		$('#section-logo_font').hide();
		$('#section-logo_url').show();
	} else{
		$('#section-logo_font').show();
		$('#section-logo_url').hide();
	};

	$('#section-logo_type input[type="radio"]').click(function() {
		if ($(this).filter(":checked").val() == 'txt_logo'){
			$('#section-logo_font').show();
			$('#section-logo_url').hide();
		} else {
			$('#section-logo_font').hide();
			$('#section-logo_url').show();
		};
	});
	
	// Show/Hide Social Options
	if ($('#section-social_nets input[type="radio"]:checked').val() == 'true') {
		$('#section-social_gplus, #section-social_facebook, #section-social_twitter, #section-social_rss, #section-social_dribbble, #section-social_flickr, #section-social_linkedin, #section-social_vimeo, #section-social_youtube, #section-social_pinterest').show();
	} else{
		$('#section-social_gplus, #section-social_facebook, #section-social_twitter, #section-social_rss, #section-social_dribbble, #section-social_flickr, #section-social_linkedin, #section-social_vimeo, #section-social_youtube, #section-social_pinterest').hide();
	};

	$('#section-social_nets input[type="radio"]').click(function() {
		if ($(this).filter(":checked").val() == 'true'){
			$('#section-social_gplus, #section-social_facebook, #section-social_twitter, #section-social_rss, #section-social_dribbble, #section-social_flickr, #section-social_linkedin, #section-social_vimeo, #section-social_youtube, #section-social_pinterest').show();
		} else {
			$('#section-social_gplus, #section-social_facebook, #section-social_twitter, #section-social_rss, #section-social_dribbble, #section-social_flickr, #section-social_linkedin, #section-social_vimeo, #section-social_youtube, #section-social_pinterest').hide();
		};
	});
	
	// Show/Hide Tabs Options
	if ($('#section-main_tabs input[type="radio"]:checked').val() == 'true') {
		$('#section-main_tabs_title1, #section-main_tabs_cat1, #section-main_tabs_title2, #section-main_tabs_cat2, #section-main_tabs_title3, #section-main_tabs_cat3, #section-main_tabs_posts_num').show();
	} else{
		$('#section-main_tabs_title1, #section-main_tabs_cat1, #section-main_tabs_title2, #section-main_tabs_cat2, #section-main_tabs_title3, #section-main_tabs_cat3, #section-main_tabs_posts_num').hide();
	};

	$('#section-main_tabs input[type="radio"]').click(function() {
		if ($(this).filter(":checked").val() == 'true'){
			$('#section-main_tabs_title1, #section-main_tabs_cat1, #section-main_tabs_title2, #section-main_tabs_cat2, #section-main_tabs_title3, #section-main_tabs_cat3, #section-main_tabs_posts_num').show();
		} else {
			$('#section-main_tabs_title1, #section-main_tabs_cat1, #section-main_tabs_title2, #section-main_tabs_cat2, #section-main_tabs_title3, #section-main_tabs_cat3, #section-main_tabs_posts_num').hide();
		};
	});
	
	// Show/Hide Box Office Options
	if ($('#section-box_office input[type="radio"]:checked').val() == 'true') {
		$('#section-box_office_title, #section-box_office_url').show();
	} else{
		$('#section-box_office_title, #section-box_office_url').hide();
	};

	$('#section-box_office input[type="radio"]').click(function() {
		if ($(this).filter(":checked").val() == 'true'){
			$('#section-box_office_title, #section-box_office_url').show();
		} else {
			$('#section-box_office_title, #section-box_office_url').hide();
		};
	});
	
	// Show/Hide Movie Reviews Options
	if ($('#section-reviews input[type="radio"]:checked').val() == 'true') {
		$('#section-reviews_title, #section-reviews_url').show();
	} else{
		$('#section-reviews_title, #section-reviews_url').hide();
	};

	$('#section-reviews input[type="radio"]').click(function() {
		if ($(this).filter(":checked").val() == 'true'){
			$('#section-reviews_title, #section-reviews_url').show();
		} else {
			$('#section-reviews_title, #section-reviews_url').hide();
		};
	});
	
	// Show/Hide Movie News Options
	if ($('#section-news input[type="radio"]:checked').val() == 'true') {
		$('#section-news_title, #section-news_num, #section-news_url').show();
	} else{
		$('#section-news_title, #section-news_num').hide();
	};

	$('#section-news input[type="radio"]').click(function() {
		if ($(this).filter(":checked").val() == 'true'){
			$('#section-news_title, #section-news_num, #section-news_url').show();
		} else {
			$('#section-news_title, #section-news_num, #section-news_url').hide();
		};
	});
	
	// Show/Hide Social Options
	if ($('#section-foot_social_nets input[type="radio"]:checked').val() == 'true') {
		$('#section-foot_social_gplus, #section-foot_social_facebook, #section-foot_social_twitter, #section-foot_social_rss, #section-foot_social_dribbble, #section-foot_social_flickr, #section-foot_social_linkedin, #section-foot_social_vimeo, #section-foot_social_youtube, #section-foot_social_pinterest').show();
	} else{
		$('#section-foot_social_gplus, #section-foot_social_facebook, #section-foot_social_twitter, #section-foot_social_rss, #section-foot_social_dribbble, #section-foot_social_flickr, #section-foot_social_linkedin, #section-foot_social_vimeo, #section-foot_social_youtube, #section-foot_social_pinterest').hide();
	};

	$('#section-foot_social_nets input[type="radio"]').click(function() {
		if ($(this).filter(":checked").val() == 'true'){
			$('#section-foot_social_gplus, #section-foot_social_facebook, #section-foot_social_twitter, #section-foot_social_rss, #section-foot_social_dribbble, #section-foot_social_flickr, #section-foot_social_linkedin, #section-foot_social_vimeo, #section-foot_social_youtube, #section-foot_social_pinterest').show();
		} else {
			$('#section-foot_social_gplus, #section-foot_social_facebook, #section-foot_social_twitter, #section-foot_social_rss, #section-foot_social_dribbble, #section-foot_social_flickr, #section-foot_social_linkedin, #section-foot_social_vimeo, #section-foot_social_youtube, #section-foot_social_pinterest').hide();
		};
	});
	
	// Show/Hide Gallery Options
	if ($('#gal_col_num :selected').val() == '4') {
		$('#section-gal_sidebar').show();
	} else{
		$('#section-gal_sidebar').hide();
	};

	$('#gal_col_num').change(function() {
		if ($('#gal_col_num :selected').val() == '4') {
			$('#section-gal_sidebar').show();
		} else {
			$('#section-gal_sidebar').hide();
		};
	});
});