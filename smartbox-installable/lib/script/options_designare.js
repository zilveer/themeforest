jQuery(document).ready(function($){

	jQuery('#smartbox_disable_responsive').parent().css('display','none');
	jQuery('#smartbox_social_icons_style_four').parent().next().find('p').appendTo(jQuery('#smartbox_social_icons_style_four').parent());
	jQuery('#smartbox_social_icons_style_four').parent().next().remove();
	jQuery('#smartbox_social_icons_style_four').siblings('p').css({'clear':'both','float':'left'});

	/*limit portfolio custom permalink*/
	jQuery('#smartbox_portfolio_permalink').attr('maxlength',20);
	jQuery('#smartbox_portfolio_permalink').parent().next().css({
		'margin-top': '-15px',
		'z-index': 81,
		'background': 'white',
		'border-bottom': '1px solid #EDEDED',
		'color':'#999'
	});

	/* header style type */
	jQuery('#smartbox_header_style_type').parent().css('display','none');
	jQuery('#smartbox_header_style_type option').each(function(e){
		if (jQuery(this).is(':selected')){
			jQuery(this).parents('.sub-navigation-container').append('<div class="screenshot_container selected"><img class="style-'+e+'" src="'+jQuery('#templatepath').html()+'/images/header-style'+parseInt(e+1,10)+'.png" alt="'+jQuery('#templatepath').html()+'/images/header-style'+parseInt(e+1,10)+'.png" /></div>');
		} else {
			jQuery(this).parents('.sub-navigation-container').append('<div class="screenshot_container"><img class="style-'+e+'" src="'+jQuery('#templatepath').html()+'/images/header-style'+parseInt(e+1,10)+'.png" alt="'+jQuery('#templatepath').html()+'/images/header-style'+parseInt(e+1,10)+'.png" /></div>');	
		}
	});
	jQuery('#smartbox_header_style_type').parents('.sub-navigation-container').on("click", "img", function(){
		var idx = jQuery(this).attr('class').split('le-');
		jQuery('#smartbox_header_style_type').val( jQuery('#smartbox_header_style_type option').eq(idx[1]).val() );
		jQuery(this).parent().addClass('selected').siblings().removeClass('selected');
	});
	/* endof header style type */

	var def_sidebars = jQuery('#sidebar_name_list').html();

	jQuery('#tab_navigation-9-customcss textarea').keydown(function(e) {
	    if(e.keyCode === 9) { // tab was pressed
	        // get caret position/selection
	        var start = this.selectionStart;
	        var end = this.selectionEnd;
	
	        var $this = $(this);
	        var value = $this.val();
	
	        $this.val(value.substring(0, start)
	                    + "\t"
	                    + value.substring(end));
	
	        this.selectionStart = this.selectionEnd = start + 1;
	        e.preventDefault();
	    }
	});

	jQuery('#smartbox_export_options_button').css('top',0).parent().find('br').remove();

	jQuery('#smartbox_import_options_button').parent().append('<a class="des-button custom-option-button" style="position: relative; float: left; clear: both; margin-top: 20px;" id="smartbox_apply_imported_settings_button" ><span>Apply Settings</span></a>');
	jQuery('#smartbox_import_options_button').siblings('.des-button').click(function(){
		var confirm = window.confirm("This will replace all your panel options.\n\rAre you sure?");
		if (confirm==true){
		 	var xmlPath = jQuery('#smartbox_import_options').val();
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            data: {
	                xmlPath: xmlPath
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
		}
	});
	jQuery('#smartbox_reset_options_button').unbind().css({
		'position':'relative',
		'float':'left',
		'display':'inline-block',
		'clear':'both'
	});
	jQuery('#smartbox_reset_options_button').siblings('ul').css('display','none');
	jQuery('#smartbox_reset_options_button').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		var confirm = window.confirm("Are you sure?");
		if (confirm == true){
		 	var xmlPath = jQuery('#templatepath').html()+"/smartbox_original_panel_options.xml";
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            data: {
	                xmlPath: xmlPath
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
	        jQuery(this).siblings('ul').remove();
		} else {
			return false;
		}
	});
	
	var _default_header_style_type = jQuery('#smartbox_header_style_type').val();
	if (_default_header_style_type === "style4"){
		//jQuery('#smartbox_menu_uppercase').parent().fadeIn(500).removeClass('optoff');
		jQuery('#smartbox_menu_background_color').parent().fadeIn(500).removeClass('optoff');
	} else {
		//jQuery('#smartbox_menu_uppercase').parent().fadeOut(500).addClass('optoff');
		jQuery('#smartbox_menu_background_color').parent().fadeOut(500).addClass('optoff');
	}
	jQuery('#smartbox_header_style_type').change(function(){
		var _default_header_style_type = jQuery('#smartbox_header_style_type').val();
		if (_default_header_style_type === "style4"){
			//jQuery('#smartbox_menu_uppercase').parent().fadeIn(500).removeClass('optoff');
			jQuery('#smartbox_menu_background_color').parent().fadeIn(500).removeClass('optoff');
		} else {
			//jQuery('#smartbox_menu_uppercase').parent().fadeOut(500).addClass('optoff');
			jQuery('#smartbox_menu_background_color').parent().fadeOut(500).addClass('optoff');
		}
	});
	
	var _default_animate_thumbnails = jQuery('#smartbox_animate_thumbnails').val();
	if (_default_animate_thumbnails === "on"){
		jQuery('#smartbox_thumbnails_effect').parent().fadeIn(500);
	} else {
		jQuery('#smartbox_thumbnails_effect').parent().fadeOut(500);
	}
	jQuery('#smartbox_animate_thumbnails').change(function(){
		if (_default_animate_thumbnails === "on"){
			jQuery('#smartbox_thumbnails_effect').parent().fadeIn(500);
		} else {
			jQuery('#smartbox_thumbnails_effect').parent().fadeOut(500);
		}
	});
	
	var _default_body_shadow = jQuery('#smartbox_body_shadow').val();
	if (_default_body_shadow === "on"){
		jQuery('#smartbox_body_shadow').parent().next().fadeIn(500).removeClass('optoff');
	} else {
		jQuery('#smartbox_body_shadow').parent().next().fadeOut(500).addClass('optoff');
	}
	jQuery('#smartbox_body_shadow').change(function(){
		if (_default_body_shadow === "on"){
			jQuery('#smartbox_body_shadow').parent().next().fadeIn(500).removeClass('optoff');
		} else {
			jQuery('#smartbox_body_shadow').parent().next().fadeOut(500).addClass('optoff');
		}
	});
	
	//body background type
	var _default_body_background = jQuery('#smartbox_body_type').val();
	switch(_default_body_background){
		case "image":
			jQuery('#smartbox_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#smartbox_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#smartbox_body_type').parent().next().next().fadeOut(500).addClass('optoff');
			jQuery('#smartbox_body_type').parent().next().fadeIn(500).removeClass('optoff');
			jQuery('#smartbox_body_image').siblings('.previewimg').remove();
			if (jQuery('#smartbox_body_image').val() != ''){
				jQuery('#smartbox_body_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_body_image").val()+'">');
			}
			break;
		case "color":
			jQuery('#smartbox_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#smartbox_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#smartbox_body_type').parent().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#smartbox_body_type').parent().next().fadeOut(500).addClass('optoff');
			break;
		case "pattern": case "custom_pattern":
			jQuery('#smartbox_body_type').parent().next().next().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#smartbox_body_type').parent().next().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#smartbox_body_type').parent().next().next().fadeOut(500).addClass('optoff');
			jQuery('#smartbox_body_type').parent().next().fadeOut(500).addClass('optoff');
			break;
	}
	jQuery('#smartbox_body_type').change(function(){
		var _default_body_background = jQuery('#smartbox_body_type').val();
		switch(_default_body_background){
			case "image":
				jQuery('#smartbox_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#smartbox_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#smartbox_body_type').parent().next().next().fadeOut(500).addClass('optoff');
				jQuery('#smartbox_body_type').parent().next().fadeIn(500).removeClass('optoff');
				jQuery('#smartbox_body_image').siblings('.previewimg').remove();
				if (jQuery('#smartbox_body_image').val() != ''){
					jQuery('#smartbox_body_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_body_image").val()+'">');
				}
				break;
			case "color":
				jQuery('#smartbox_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#smartbox_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#smartbox_body_type').parent().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#smartbox_body_type').parent().next().fadeOut(500).addClass('optoff');
				break;
			case "pattern": case "custom_pattern":
				jQuery('#smartbox_body_type').parent().next().next().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#smartbox_body_type').parent().next().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#smartbox_body_type').parent().next().next().fadeOut(500).addClass('optoff');
				jQuery('#smartbox_body_type').parent().next().fadeOut(500).addClass('optoff');
				break;
		}
	});
	
	//show twitter newsletter footer options
	var _default_show_twitter_newsletter_footer = jQuery('#smartbox_show_twitter_newsletter_footer').val();
	if (_default_show_twitter_newsletter_footer === "on"){
		for (var i= jQuery('#smartbox_show_twitter_newsletter_footer').parent().index(); i<jQuery('#smartbox_twitter_newsletter_borderscolor').parent().index(); i++){
			if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
		}
	} else {
		for (var i= jQuery('#smartbox_show_twitter_newsletter_footer').parent().index(); i<jQuery('#smartbox_twitter_newsletter_borderscolor').parent().index(); i++){
			jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
		}
	}
	jQuery('#smartbox_show_twitter_newsletter_footer').change(function(){
		if (_default_show_twitter_newsletter_footer === "on"){
			for (var i= jQuery('#smartbox_show_twitter_newsletter_footer').parent().index(); i<jQuery('#smartbox_twitter_newsletter_borderscolor').parent().index(); i++){
				if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
			}
		} else {
			for (var i= jQuery('#smartbox_show_twitter_newsletter_footer').parent().index(); i<jQuery('#smartbox_twitter_newsletter_borderscolor').parent().index(); i++){
				jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
			}
		}
	});
	
	//show primary footer options
	var _default_show_primary_footer = jQuery('#smartbox_show_primary_footer').val();
	if (_default_show_primary_footer === "on"){
		for (var i= jQuery('#smartbox_show_primary_footer').parent().index(); i<jQuery('#smartbox_footerbg_headingscolor').parent().index(); i++){
			if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
		}
	} else {
		for (var i= jQuery('#smartbox_show_primary_footer').parent().index(); i<jQuery('#smartbox_footerbg_headingscolor').parent().index(); i++){
			jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
		}
	}
	jQuery('#smartbox_show_primary_footer').change(function(){
		if (_default_show_primary_footer === "on"){
			for (var i= jQuery('#smartbox_show_primary_footer').parent().index(); i<jQuery('#smartbox_footerbg_headingscolor').parent().index(); i++){
				if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
			}
		} else {
			for (var i= jQuery('#smartbox_show_primary_footer').parent().index(); i<jQuery('#smartbox_footerbg_headingscolor').parent().index(); i++){
				jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
			}
		}
	});
	
	//show secondary footer options
	var _default_show_secondary_footer = jQuery('#smartbox_show_sec_footer').val();
	if (_default_show_secondary_footer === "on"){
		for (var i= jQuery('#smartbox_show_sec_footer').parent().index(); i<jQuery('#smartbox_sec_footerbg_paragraphscolor').parent().index(); i++){
			if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
		}
	} else {
		for (var i= jQuery('#smartbox_show_sec_footer').parent().index(); i<jQuery('#smartbox_sec_footerbg_paragraphscolor').parent().index(); i++){
			jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
		}
	}
	jQuery('#smartbox_show_sec_footer').change(function(){
		if (_default_show_secondary_footer === "on"){
			for (var i= jQuery('#smartbox_show_sec_footer').parent().index(); i<jQuery('#smartbox_sec_footerbg_paragraphscolor').parent().index(); i++){
				if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
			}
		} else {
			for (var i= jQuery('#smartbox_show_sec_footer').parent().index(); i<jQuery('#smartbox_sec_footerbg_paragraphscolor').parent().index(); i++){
				jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
			}
		}
	});
	
	var _default_contentbg_type = jQuery('#smartbox_contentbg_type').val();
	switch (_default_contentbg_type){
		case "color":
			jQuery('#smartbox_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_contentbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#smartbox_contentbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_contentbg_image').siblings('.previewimg').remove();
			if (jQuery('#smartbox_contentbg_image').val() != ''){
				jQuery('#smartbox_contentbg_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_contentbg_image").val()+'">');
			}
		break;
		case "pattern":
			jQuery('#smartbox_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_contentbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_contentbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#smartbox_contentbg_type').change(function(){
		switch (_default_contentbg_type){
			case "color":
				jQuery('#smartbox_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_contentbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#smartbox_contentbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_contentbg_image').siblings('.previewimg').remove();
				if (jQuery('#smartbox_contentbg_image').val() != ''){
					jQuery('#smartbox_contentbg_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_contentbg_image").val()+'">');
				}
			break;
			case "pattern":
				jQuery('#smartbox_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_contentbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_contentbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}	
	});
	
	
	var _default_headerbg_type = jQuery('#smartbox_headerbg_type').val();
	switch (_default_headerbg_type){
		case "color":
			jQuery('#smartbox_headerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_headerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_headerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_headerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#smartbox_headerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_headerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_headerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_headerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#smartbox_headerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_headerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_headerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_headerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#smartbox_headerbg_type').change(function(){
		switch (_default_headerbg_type){
			case "color":
				jQuery('#smartbox_headerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_headerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_headerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_headerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#smartbox_headerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_headerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_headerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_headerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#smartbox_headerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_headerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_headerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_headerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_toppanelbg_type = jQuery('#smartbox_toppanelbg_type').val();
	switch (_default_toppanelbg_type){
		case "color":
			jQuery('#smartbox_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_toppanelbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#smartbox_toppanelbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#smartbox_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_toppanelbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_toppanelbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#smartbox_toppanelbg_type').change(function(){
		switch (_default_toppanelbg_type){
			case "color":
				jQuery('#smartbox_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_toppanelbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#smartbox_toppanelbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#smartbox_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_toppanelbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_toppanelbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_sec_footerbg_type = jQuery('#smartbox_sec_footerbg_type').val();
	switch (_default_sec_footerbg_type){
		case "color":
			jQuery('#smartbox_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_sec_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#smartbox_sec_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#smartbox_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#smartbox_sec_footerbg_type').change(function(){
		switch (_default_sec_footerbg_type){
			case "color":
				jQuery('#smartbox_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_sec_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#smartbox_sec_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#smartbox_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	
	var _default_footerbg_type = jQuery('#smartbox_footerbg_type').val();
	switch (_default_footerbg_type){
		case "color":
			jQuery('#smartbox_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#smartbox_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#smartbox_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#smartbox_footerbg_type').change(function(){
		switch (_default_footerbg_type){
			case "color":
				jQuery('#smartbox_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#smartbox_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#smartbox_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_twitter_newsletter_type = jQuery('#smartbox_twitter_newsletter_type').val();
	switch (_default_twitter_newsletter_type){
		case "color":
			jQuery('#smartbox_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_twitter_newsletter_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#smartbox_twitter_newsletter_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#smartbox_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);	
			jQuery('#smartbox_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#smartbox_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#smartbox_twitter_newsletter_pattern').closest('.option').removeClass('optoff').fadeIn(500);		
			jQuery('#smartbox_twitter_newsletter_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#smartbox_twitter_newsletter_type').change(function(){
		switch (_default_twitter_newsletter_type){
			case "color":
				jQuery('#smartbox_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_twitter_newsletter_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#smartbox_twitter_newsletter_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#smartbox_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);	
				jQuery('#smartbox_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#smartbox_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#smartbox_twitter_newsletter_pattern').closest('.option').removeClass('optoff').fadeIn(500);		
				jQuery('#smartbox_twitter_newsletter_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	//style > body - body layout type
	var _default_body_layout_type = jQuery('#smartbox_body_layout_type').val();
	if (_default_body_layout_type === "full"){
		jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().next().fadeOut(500);
		jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().fadeOut(500);
		jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().fadeOut(500);
		jQuery('#smartbox_body_layout_type').parent().next().next().next().next().fadeOut(500);
		jQuery('#smartbox_body_layout_type').parent().next().next().next().fadeOut(500);
		jQuery('#smartbox_body_layout_type').parent().next().next().fadeOut(500);
		jQuery('#smartbox_body_layout_type').parent().next().fadeOut(500);
	} else {
		if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().next().hasClass('optoff'))
			jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().hasClass('optoff'))
			jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().hasClass('optoff'))
			jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().next().hasClass('optoff'))
			jQuery('#smartbox_body_layout_type').parent().next().next().next().next().fadeIn(500);
		if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().hasClass('optoff'))
			jQuery('#smartbox_body_layout_type').parent().next().next().next().fadeIn(500);
		if (!jQuery('#smartbox_body_layout_type').parent().next().next().hasClass('optoff'))
			jQuery('#smartbox_body_layout_type').parent().next().next().fadeIn(500);
		if (!jQuery('#smartbox_body_layout_type').parent().next().hasClass('optoff'))
			jQuery('#smartbox_body_layout_type').parent().next().fadeIn(500);
	}
	jQuery('#smartbox_body_layout_type').change(function(){
		if (_default_body_layout_type === "full"){
			jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_body_layout_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_body_layout_type').parent().next().next().next().fadeOut(500);
			jQuery('#smartbox_body_layout_type').parent().next().next().fadeOut(500);
			jQuery('#smartbox_body_layout_type').parent().next().fadeOut(500);
		} else {
			if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().next().hasClass('optoff'))
				jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().hasClass('optoff'))
				jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().hasClass('optoff'))
				jQuery('#smartbox_body_layout_type').parent().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().next().hasClass('optoff'))
				jQuery('#smartbox_body_layout_type').parent().next().next().next().next().fadeIn(500);
			if (!jQuery('#smartbox_body_layout_type').parent().next().next().next().hasClass('optoff'))
				jQuery('#smartbox_body_layout_type').parent().next().next().next().fadeIn(500);
			if (!jQuery('#smartbox_body_layout_type').parent().next().next().hasClass('optoff'))
				jQuery('#smartbox_body_layout_type').parent().next().next().fadeIn(500);
			if (!jQuery('#smartbox_body_layout_type').parent().next().hasClass('optoff'))
				jQuery('#smartbox_body_layout_type').parent().next().fadeIn(500);
		}
	});
	
	//style > header - background type
	var _default_header_bkg = jQuery('#smartbox_header_type').val();
	switch (_default_header_bkg){
		case "without": 
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().fadeOut(500);
			break;
		case "none": case "border":
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().fadeOut(500);
			break;
		case "image":
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().fadeIn(500);
			jQuery('#smartbox_header_image').parent().find('.previewimg').remove();
			if (jQuery('#smartbox_header_image').val() != ""){
				jQuery('#smartbox_header_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_header_image").val()+'">');
			}
			break;
		case "color":
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().fadeIn(500);
			jQuery('#smartbox_header_type').parent().next().fadeOut(500);
			break;
		case "pattern":
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().fadeIn(500);
			jQuery('#smartbox_header_type').parent().next().next().next().fadeIn(500);
			jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().fadeOut(500);
			break;
		case "banner":
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeIn(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
			jQuery('#smartbox_header_type').parent().next().fadeOut(500);
			break;
	}
	if (_default_header_bkg == "border" || _default_header_bkg == "image" || _default_header_bkg == "pattern" || _default_header_bkg == "banner" || _default_header_bkg == "color"){
		jQuery('#smartbox_header_type').parent().next().next().next().next().next().next().next().fadeIn(500);
		jQuery('#smartbox_header_type').parent().next().next().next().next().next().next().fadeIn(500);
	}
	jQuery('#smartbox_header_type').change(function(){
		var _default_header_bkg = jQuery('#smartbox_header_type').val();
		switch (_default_header_bkg){
			case "without": 
				jQuery('#smartbox_header_type').parent().next().next().next().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().fadeOut(500);
				break;
			case "none": case "border":
				jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().fadeOut(500);
				break;
			case "image":
				jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().fadeIn(500);
				jQuery('#smartbox_header_image').parent().find('.previewimg').remove();
				if (jQuery('#smartbox_header_image').val() != ""){
					jQuery('#smartbox_header_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_header_image").val()+'">');
				}
				break;
			case "color":
				jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().fadeIn(500);
				jQuery('#smartbox_header_type').parent().next().fadeOut(500);
				break;
			case "pattern":
				jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().next().fadeIn(500);
				jQuery('#smartbox_header_type').parent().next().next().next().fadeIn(500);
				jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().fadeOut(500);
				break;
			case "banner":
				jQuery('#smartbox_header_type').parent().next().next().next().next().next().fadeIn(500);
				jQuery('#smartbox_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().next().fadeOut(500);
				jQuery('#smartbox_header_type').parent().next().fadeOut(500);
				break;
		}
		if (_default_header_bkg == "border" || _default_header_bkg == "image" || _default_header_bkg == "pattern" || _default_header_bkg == "banner" || _default_header_bkg == "color"){
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().next().next().fadeIn(500);
			jQuery('#smartbox_header_type').parent().next().next().next().next().next().next().fadeIn(500);
		}
	});	
	
	//google fonts
	var _default_google_fonts = jQuery('#smartbox_enable_google_fonts').val();
	if (_default_google_fonts === "on"){
		jQuery('#smartbox_enable_google_fonts').parent().next().fadeIn(500);
	} else {
		jQuery('#smartbox_enable_google_fonts').parent().next().fadeOut(500);
	}
	jQuery('#smartbox_enable_google_fonts').change(function(){
		if (_default_google_fonts === "on"){
			jQuery('#smartbox_enable_google_fonts').parent().next().fadeIn(500);
		} else {
			jQuery('#smartbox_enable_google_fonts').parent().next().fadeOut(500);
		}		
	});
	
	//General > Projects > Enlarge pics
	var _default_proj_layout = jQuery('#smartbox_single_layout').val(); 
	if (_default_proj_layout === "fullwidth_slider"){
		jQuery('#smartbox_projects_enlarge_images').parent('.option').fadeOut(500);
	} else {
		jQuery('#smartbox_projects_enlarge_images').parent('.option').fadeIn(500);
	}
	jQuery('#smartbox_single_layout').change(function(e){
		if (_default_proj_layout === "fullwidth_slider"){
			jQuery('#smartbox_projects_enlarge_images').parent('.option').fadeOut(500);
		} else {
			jQuery('#smartbox_projects_enlarge_images').parent('.option').fadeIn(500);
		}
	});
	
	//General > Projects > Open|Close Cats
	var _default_enable_open_close_categories = jQuery('#smartbox_enable_open_close_categories').val();
	if (_default_enable_open_close_categories === "on"){
		jQuery('#smartbox_categories_initial_state').parent().fadeIn(500).removeClass('optoff');
	} else {
		jQuery('#smartbox_categories_initial_state').parent().fadeOut(500).addClass('optoff');
	}
	jQuery('#smartbox_enable_open_close_categories').change(function(e){
		var _default_enable_open_close_categories = jQuery('#smartbox_enable_open_close_categories').val();
		if (_default_enable_open_close_categories === "on"){
			jQuery('#smartbox_categories_initial_state').parent().fadeIn(500).removeClass('optoff');
		} else {
			jQuery('#smartbox_categories_initial_state').parent().fadeOut(500).addClass('optoff');
		}	
	});
	
	//FOOTER RIGHT CONTENT OPTIONS
	var _default_footer_right = jQuery('#smartbox_footer_right_content').val();
	if (_default_footer_right === "text"){
		jQuery('#smartbox_footer_right_text').parent('.option').fadeIn(500);
		jQuery('#smartbox_footer_social_icons_style').parent('.option').fadeOut(500);
	} else {
		if (_default_footer_right === "social"){
			jQuery('#smartbox_footer_social_icons_style').parent('.option').fadeIn(500);
			jQuery('#smartbox_footer_right_text').parent('.option').fadeOut(500);
		} else {
			jQuery('#smartbox_footer_right_text').parent('.option').fadeOut(500);	
			jQuery('#smartbox_footer_social_icons_style').parent('.option').fadeOut(500);
		}
	}
	jQuery('#smartbox_footer_right_content').change(function(e){
		if (_default_footer_right === "text"){
			jQuery('#smartbox_footer_right_text').parent('.option').fadeIn(500);
			jQuery('#smartbox_footer_social_icons_style').parent('.option').fadeOut(500);
		} else {
			if (_default_footer_right === "social"){
				jQuery('#smartbox_footer_social_icons_style').parent('.option').fadeIn(500);
				jQuery('#smartbox_footer_right_text').parent('.option').fadeOut(500);
			} else {
				jQuery('#smartbox_footer_right_text').parent('.option').fadeOut(500);	
				jQuery('#smartbox_footer_social_icons_style').parent('.option').fadeOut(500);
			}
		}	
	});
	
	var tp_cols_default = jQuery('#smartbox_toppanel_number_cols').val();	  
 	if(tp_cols_default == "three"){
 		jQuery("#smartbox_toppanel_columns_order").parent().fadeIn(500);
 		jQuery("#smartbox_toppanel_columns_order_four").parent().fadeOut(500);
 	} else if (tp_cols_default == "four"){
 		jQuery("#smartbox_toppanel_columns_order_four").parent().fadeIn(500);
 		jQuery("#smartbox_toppanel_columns_order").parent().fadeOut(500);
 	} else {
 		jQuery("#smartbox_toppanel_columns_order").parent().fadeOut(500);
 		jQuery("#smartbox_toppanel_columns_order_four").parent().fadeOut(500);
 	}
 	
	jQuery('#smartbox_toppanel_number_cols').change(function(e){
		if(tp_cols_default == "three"){
	 		jQuery("#smartbox_toppanel_columns_order").parent().fadeIn(500);
	 		jQuery("#smartbox_toppanel_columns_order_four").parent().fadeOut(500);
	 	} else if (tp_cols_default == "four"){
	 		jQuery("#smartbox_toppanel_columns_order_four").parent().fadeIn(500);
	 		jQuery("#smartbox_toppanel_columns_order").parent().fadeOut(500);
	 	} else {
	 		jQuery("#smartbox_toppanel_columns_order").parent().fadeOut(500);
	 		jQuery("#smartbox_toppanel_columns_order_four").parent().fadeOut(500);
	 	}
 	});
 	
 	//WIDGETS AREA
	var _default_widgets_area = jQuery('#smartbox_enable_widgets_area').val();
	var indexWidget = parseInt(jQuery('#smartbox_enable_widgets_area').parents('.option').index(),10);
	if (_default_widgets_area === "on"){
		for (var i=1; i<4; i++){
			jQuery('#smartbox_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeIn(500);	
		}
		jQuery('#smartbox_toppanel_number_cols').change();
	} else {
		for (var i=1; i<4; i++){
			jQuery('#smartbox_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeOut(500);	
		}
	}
	jQuery('#smartbox_enable_widgets_area').change(function(e){
		if (_default_widgets_area === "on"){
			for (var i=1; i<4; i++){
				jQuery('#smartbox_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeIn(500);	
			}
			jQuery('#smartbox_toppanel_number_cols').change();
		} else {
			for (var i=1; i<4; i++){
				jQuery('#smartbox_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeOut(500);	
			}
		}
	});
	
	//INFO ABOVE MENU (now known as Enable Info/Social bar)
	var _default_info_above_menu = jQuery('#smartbox_info_above_menu').val();
	if (_default_info_above_menu === "on"){
		for (var i=jQuery('#smartbox_info_above_menu').parent().index()+1; i< jQuery('#smartbox_social_icons_style').parent().index()+1; i++){
			jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
		}
  	} else {
		for (var i=jQuery('#smartbox_info_above_menu').parent().index()+1; i< jQuery('#smartbox_social_icons_style').parent().index()+1; i++){
			jQuery('#tab_navigation-2-header').children().eq(i).fadeOut(500);
		}
  	}
  	jQuery('#smartbox_info_above_menu').change(function(e){
	  	if (_default_info_above_menu === "on"){
			for (var i=jQuery('#smartbox_info_above_menu').parent().index()+1; i< jQuery('#smartbox_social_icons_style').parent().index()+1; i++){
				jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
			}
	  	} else {
			for (var i=jQuery('#smartbox_info_above_menu').parent().index()+1; i< jQuery('#smartbox_social_icons_style').parent().index()+1; i++){
				jQuery('#tab_navigation-2-header').children().eq(i).fadeOut(500);
			}
	  	}
  	});
  	
  	//SOCIAL ICONS 
  	var _default_enable_socials = jQuery('#smartbox_enable_socials').val();
  	if (_default_enable_socials === "on"){
		jQuery('#smartbox_enable_socials').parents('.option').find('~ .option').each(function(){
			jQuery(this).fadeIn(500);
		});
  	} else {
	  	jQuery('#smartbox_enable_socials').parents('.option').find('~ .option').each(function(){
			jQuery(this).fadeOut(500);
		});
  	}
	jQuery('#smartbox_enable_socials').change(function(e){
		var _default_enable_socials = jQuery('#smartbox_enable_socials').val();
	  	if (_default_enable_socials === "on"){
			jQuery('#smartbox_enable_socials').parents('.option').find('~ .option').each(function(){
				jQuery(this).fadeIn(500);
			});
	  	} else {
		  	jQuery('#smartbox_enable_socials').parents('.option').find('~ .option').each(function(){
				jQuery(this).fadeOut(500);
			});
	  	}
	});

	// TOP PANEL & SOCIAL BAR MAMBO JAMBO
	var _default_top_panel = jQuery('#smartbox_enable_top_panel').val();
	if (_default_top_panel === "on"){
		for (var i=jQuery('#smartbox_enable_top_panel').parent().index()+1; i< jQuery('#smartbox_toppanel_headingscolor').parent().index()+1; i++){
			if (!jQuery('#tab_navigation-2-header').children().eq(i).hasClass('optoff')) jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
		}
	} else {
		for (var i=jQuery('#smartbox_enable_top_panel').parent().index()+1; i< jQuery('#smartbox_toppanel_headingscolor').parent().index()+1; i++){
			jQuery('#tab_navigation-2-header').children().eq(i).fadeOut(500);
		}
  	}
	jQuery('#smartbox_enable_top_panel').change(function(e){
	  	if (_default_top_panel === "on"){
			for (var i=jQuery('#smartbox_enable_top_panel').parent().index()+1; i< jQuery('#smartbox_toppanel_headingscolor').parent().index()+1; i++){
				if (!jQuery('#tab_navigation-2-header').children().eq(i).hasClass('optoff')) jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
			}
		} else {
			for (var i=jQuery('#smartbox_enable_top_panel').parent().index()+1; i< jQuery('#smartbox_toppanel_headingscolor').parent().index()+1; i++){
				jQuery('#tab_navigation-2-header').children().eq(i).fadeOut(500);
			}
	  	}
	});
	
	
	//suggested colors
	jQuery('#tab_navigation-2-general a.style-box').each(function(){
		jQuery(this).click(function(){
			jQuery('#smartbox_style_color')
				.attr('value',jQuery(this).attr('title'))
				.siblings('.color-preview').css('background-color', '#'+jQuery(this).attr('title'));
		});
	});
	
	if (jQuery("#smartbox_favicon").val() != ""){
		jQuery("#smartbox_logo_retina_image_url").parent().find('.previewimg').remove();
		jQuery("#smartbox_favicon").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_favicon").val()+'">');
 	}

	//LOGOTYPE
	var _default  = jQuery('#smartbox_logo_type').val();
  
 	if(_default == "text"){
 		jQuery("#smartbox_logo_image_url, #smartbox_logo_retina_image_url, #smartbox_logo_width").parent().fadeOut(500);		
 		jQuery("#smartbox_logo_text, #smartbox_logo_bgsmartbox_style, #smartbox_logo_font, #smartbox_logo_size, #smartbox_logo_color, #smartbox_logo_font_style").parent().fadeIn(500);
 	} else {
 		jQuery("#smartbox_logo_text, #smartbox_logo_bgsmartbox_style, #smartbox_logo_font, #smartbox_logo_size, #smartbox_logo_color, #smartbox_logo_font_style").parent().fadeOut(500);
 		jQuery("#smartbox_logo_image_url, #smartbox_logo_retina_image_url, #smartbox_logo_width").parent().fadeIn(500);
 		if (jQuery("#smartbox_logo_image_url").val() != ""){
 			jQuery("#smartbox_logo_image_url").siblings('.previewimg').remove();
	 		jQuery("#smartbox_logo_image_url").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_logo_image_url").val()+'">');
 		}
 		if (jQuery("#smartbox_logo_retina_image_url").val() != ""){
 			jQuery("#smartbox_logo_retina_image_url").siblings('.previewimg').remove();
	 		jQuery("#smartbox_logo_retina_image_url").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_logo_retina_image_url").val()+'">');
 		}
 	}
  
 	// observe changes
  	jQuery('#smartbox_logo_type').change(function(e){
    	if(_default == "text"){
	 		jQuery("#smartbox_logo_image_url, #smartbox_logo_retina_image_url, #smartbox_logo_width").parent().fadeOut(500);		
	 		jQuery("#smartbox_logo_text, #smartbox_logo_bgsmartbox_style, #smartbox_logo_font, #smartbox_logo_size, #smartbox_logo_color, #smartbox_logo_font_style").parent().fadeIn(500);
	 	} else {
	 		jQuery("#smartbox_logo_text, #smartbox_logo_bgsmartbox_style, #smartbox_logo_font, #smartbox_logo_size, #smartbox_logo_color, #smartbox_logo_font_style").parent().fadeOut(500);
	 		jQuery("#smartbox_logo_image_url, #smartbox_logo_retina_image_url, #smartbox_logo_width").parent().fadeIn(500);
	 		if (jQuery("#smartbox_logo_image_url").val() != ""){
	 			jQuery("#smartbox_logo_image_url").siblings('.previewimg').remove();
		 		jQuery("#smartbox_logo_image_url").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_logo_image_url").val()+'">');
	 		}
	 		if (jQuery("#smartbox_logo_retina_image_url").val() != ""){
	 			jQuery("#smartbox_logo_retina_image_url").siblings('.previewimg').remove();
		 		jQuery("#smartbox_logo_retina_image_url").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#smartbox_logo_retina_image_url").val()+'">');
	 		}
	 	}
	});
  
  	// SLOGAN
	var def_slogan = jQuery('#smartbox_slogan').val();
	if (def_slogan == "off")	
		jQuery('#smartbox_slogan_font, #smartbox_slogan_font_style, #smartbox_slogan_size, #smartbox_slogan_color').parent().fadeOut(500);
	else
		jQuery('#smartbox_slogan_font, #smartbox_slogan_font_style, #smartbox_slogan_size, #smartbox_slogan_color').parent().fadeIn(500);

	jQuery('#smartbox_slogan').change(function(e){
		if (def_slogan == "off")	
			jQuery('#smartbox_slogan_font, #smartbox_slogan_font_style, #smartbox_slogan_size, #smartbox_slogan_color').parent().fadeOut(500);
		else
			jQuery('#smartbox_slogan_font, #smartbox_slogan_font_style, #smartbox_slogan_size, #smartbox_slogan_color').parent().fadeIn(500);
 	});
  
	// 404
	var def_notfound = jQuery('#smartbox_404_error_image').val();
	if (def_notfound == "off")	
		jQuery('#smartbox_404_error_image_url').parent().fadeOut(500);
	else
		jQuery('#smartbox_404_error_image_url').parent().fadeIn(500);

	jQuery('#smartbox_404_error_image').change(function(e){
		if (def_notfound == "off")	
			jQuery('#smartbox_404_error_image_url').parent().fadeOut(500);
		else
			jQuery('#smartbox_404_error_image_url').parent().fadeIn(500);
 	});
 	
 	//HOMEPAGE LAYOUT
 	jQuery("#smartbox_homepage_static_image_url").parent().fadeOut(500);
 	
 	jQuery('#smartbox_homepage_slider').change(function(e){
 		if(jQuery(this).val() == 'static')
 			jQuery("#smartbox_homepage_static_image_url").parent().fadeIn(500);
 		else
 			jQuery("#smartbox_homepage_static_image_url").parent().fadeOut(500);
 			
 	});
 	 	
 	//CONTACT FORM TEXTAREA
 	jQuery("textarea[name=walker_contacts_email_default_content]").css("width", "440px").css("height", "270px");
 	
 	
 	//FOOTER
 	var cols_default  = jQuery('#smartbox_footer_number_cols').val();
	  
	 	if(cols_default == "three"){
	 		jQuery("#smartbox_footer_columns_order").parent().fadeIn(500);
	 		jQuery("#smartbox_footer_columns_order_four").parent().fadeOut(500);
	 	} else if (cols_default == "four"){
	 		jQuery("#smartbox_footer_columns_order_four").fadeIn(500);
	 		jQuery("#smartbox_footer_columns_order").parent().fadeOut(500);
	 	} else {
	 		jQuery("#smartbox_footer_columns_order").parent().fadeOut(500);
	 		jQuery("#smartbox_footer_columns_order_four").parent().fadeIn(500);
	 	}
	 	
	jQuery('#smartbox_footer_number_cols').change(function(e){
		if(cols_default == "three"){
	 		jQuery("#smartbox_footer_columns_order").parent().fadeIn(500);
	 		jQuery("#smartbox_footer_columns_order_four").parent().fadeOut(500);
	 	} else if (cols_default == "four"){
	 		jQuery("#smartbox_footer_columns_order_four").parent().fadeIn(500);
	 		jQuery("#smartbox_footer_columns_order").parent().fadOut(500);
	 	} else {
	 		jQuery("#smartbox_footer_columns_order").parent().fadeOut(500);
	 		jQuery("#smartbox_footer_columns_order_four").parent().fadeOut(500);
	 	}
 	});
  
  
  // continuous check for changed value
  setInterval(function () {
  
  	if (jQuery('#smartbox_header_style_type').val() != _default_header_style_type){
	  	_default_header_style_type = jQuery('#smartbox_header_style_type').val();
	  	jQuery('#smartbox_header_style_type').change();
  	}

	//fixed menu
	/*
if (jQuery('#smartbox_fixed_menu').val() != _default_fixed_menu){
	  	_default_fixed_menu = jQuery('#smartbox_fixed_menu').val();
	  	jQuery('#smartbox_fixed_menu').change();
  	}
*/

	//show secondary footer options
  	if (jQuery('#smartbox_show_sec_footer').val() != _default_show_secondary_footer){
	  	_default_show_secondary_footer = jQuery('#smartbox_show_sec_footer').val();
	  	jQuery('#smartbox_show_sec_footer').change();
  	}
	
	//show primary footer options
  	if (jQuery('#smartbox_show_primary_footer').val() != _default_show_primary_footer){
	  	_default_show_primary_footer = jQuery('#smartbox_show_primary_footer').val();
	  	jQuery('#smartbox_show_primary_footer').change();
  	}

  	//body type options
  	if (jQuery('#smartbox_contentbg_type').val() != _default_contentbg_type){
	  	_default_contentbg_type = jQuery('#smartbox_contentbg_type').val();
	  	jQuery('#smartbox_contentbg_type').change();
  	}
  
  	//show twitter newsletter footer options
  	if (jQuery('#smartbox_show_twitter_newsletter_footer').val() != _default_show_twitter_newsletter_footer){
	  	_default_show_twitter_newsletter_footer = jQuery('#smartbox_show_twitter_newsletter_footer').val();
	  	jQuery('#smartbox_show_twitter_newsletter_footer').change();
  	}
  	
  	// header type
  	if (jQuery('#smartbox_headerbg_type').val() != _default_headerbg_type){
	  	_default_headerbg_type = jQuery('#smartbox_headerbg_type').val();
	  	jQuery('#smartbox_headerbg_type').change();
  	}
  	
  	// show header & top contents type
  	if (jQuery('#smartbox_toppanelbg_type').val() != _default_toppanelbg_type){
	  	_default_toppanelbg_type = jQuery('#smartbox_toppanelbg_type').val();
	  	jQuery('#smartbox_toppanelbg_type').change();
  	}
  	
  	// secondary footer type opts
  	if (jQuery('#smartbox_sec_footerbg_type').val() != _default_sec_footerbg_type){
	  	_default_sec_footerbg_type = jQuery('#smartbox_sec_footerbg_type').val();
	  	jQuery('#smartbox_sec_footerbg_type').change();
  	}
  	
  	// primary footer type opts
  	if (jQuery('#smartbox_footerbg_type').val() != _default_footerbg_type){
	  	_default_footerbg_type = jQuery('#smartbox_footerbg_type').val();
	  	jQuery('#smartbox_footerbg_type').change();
  	}
  	
  	// twitter newsletter type opts 
  	if (jQuery('#smartbox_twitter_newsletter_type').val() != _default_twitter_newsletter_type){
	  	_default_twitter_newsletter_type = jQuery('#smartbox_twitter_newsletter_type').val();
	  	jQuery('#smartbox_twitter_newsletter_type').change();
  	}
  	
  	// thumbails animate
  	if (jQuery('#smartbox_animate_thumbnails').val() != _default_animate_thumbnails){
	  	_default_animate_thumbnails = jQuery('#smartbox_animate_thumbnails').val();
	  	jQuery('#smartbox_animate_thumbnails').change();
  	}
  	
  	//body shadow
  	if (jQuery('#smartbox_body_shadow').val() != _default_body_shadow){
	  	_default_body_shadow = jQuery('#smartbox_body_shadow').val();
	  	jQuery('#smartbox_body_shadow').change();
  	}
  
  	//body background type
  	if (jQuery('#smartbox_body_type').val() != _default_body_background){
	  	_default_body_background = jQuery('#smartbox_body_type').val();
	  	jQuery('#smartbox_body_type').change();
  	}
  
  	//body layout page
  	if (jQuery('#smartbox_body_layout_type').val() != _default_body_layout_type){
	  	_default_body_layout_type = jQuery('#smartbox_body_layout_type').val();
	  	jQuery('#smartbox_body_layout_type').change();
  	}
  
  	//header background type
  	if (jQuery('#smartbox_header_type').val() != _default_header_bkg){
	  	_default_header_bkg = jQuery('#smartbox_header_type').val();
	  	jQuery('#smartbox_header_type').change();
  	}
  
  	//google fonts
  	if (jQuery('#smartbox_enable_google_fonts').val() != _default_google_fonts){
	  	_default_google_fonts = jQuery('#smartbox_enable_google_fonts').val();
	  	jQuery('#smartbox_enable_google_fonts').change();
  	}
  
  	//projects enlarge pics
  	if (jQuery('#smartbox_single_layout').val() != _default_proj_layout){
	 	_default_proj_layout = jQuery('#smartbox_single_layout').val();
	 	jQuery('#smartbox_single_layout').change();
  	}
  	
  	//projects open|close
  	if (jQuery('#smartbox_enable_open_close_categories').val() != _default_enable_open_close_categories){
	 	_default_enable_open_close_categories = jQuery('#smartbox_enable_open_close_categories').val();
	 	jQuery('#smartbox_enable_open_close_categories').change();
  	}
  
  	//FOOTER RIGHT CONTENT
    if (jQuery('#smartbox_footer_right_content').val() != _default_footer_right){
	    _default_footer_right = jQuery('#smartbox_footer_right_content').val();
	    jQuery('#smartbox_footer_right_content').change();
    }
    
    //TOPPANEL
    if ( jQuery('#smartbox_enable_top_panel').val() != _default_top_panel ) {
    	_default_top_panel = jQuery('#smartbox_enable_top_panel').val();
		jQuery('#smartbox_enable_top_panel').change();    
    }
    
    //WIDGETS AREA
    if (jQuery('#smartbox_enable_widgets_area').val() != _default_widgets_area){
	    _default_widgets_area = jQuery('#smartbox_enable_widgets_area').val();
	    jQuery('#smartbox_enable_widgets_area').change();
    }
    
    //INFO ABOVE MENU
    if (jQuery('#smartbox_info_above_menu').val() != _default_info_above_menu){
	    _default_info_above_menu = jQuery('#smartbox_info_above_menu').val();
	    jQuery('#smartbox_info_above_menu').change();
    }
    
    //SOCIAL ICONS
    if (jQuery('#smartbox_enable_socials').val() != _default_enable_socials){
	    _default_enable_socials = jQuery('#smartbox_enable_socials').val();
	    jQuery('#smartbox_enable_socials').change();
    }
    
    //LOGOTYPE
    if ( jQuery('#smartbox_logo_type').val() != _default ) {
    	_default  = jQuery('#smartbox_logo_type').val();
		jQuery('#smartbox_logo_type').change();    
    }  
    
    //SLOGAN
    if ( jQuery('#smartbox_slogan').val() != def_slogan ) {
    	def_slogan  = jQuery('#smartbox_slogan').val();
		jQuery('#smartbox_slogan').change();    
    }
    
    //404
    if (jQuery('#smartbox_404_error_image').val() != def_notfound){
		def_notfound = jQuery('#smartbox_404_error_image').val();
		jQuery('#smartbox_404_error_image').change();
    }
    
    //SIDEBAR
    if (jQuery('#sidebar_name_list').html() != def_sidebars){
	    var sidebars = "";
	    jQuery('#sidebar_name_list li').each(function(){
		    sidebars += jQuery(this).children('span').html()+"|*|";
	    });
	    jQuery('input#des_sidebar_name_names').val(sidebars);
	    def_sidebars = jQuery('#sidebar_name_list').html();
    }
    
    //FOOTER
    if ( jQuery('#smartbox_footer_number_cols').val() != cols_default ) {
    	cols_default  = jQuery('#smartbox_footer_number_cols').val();
		jQuery('#smartbox_footer_number_cols').change();    
    }
    
    //TOP PANEL
    if ( jQuery('#smartbox_toppanel_number_cols').val() != tp_cols_default ) {
    	tp_cols_default  = jQuery('#smartbox_toppanel_number_cols').val();
		jQuery('#smartbox_toppanel_number_cols').change();  
    }
    
    
  }, 1000);

});
