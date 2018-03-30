/**
 * This is the JS file for the page add/edit section
 * 
 */

var designarePageOptions={
		
	init:function(){

		/* new - sidebars on pages */
		jQuery('#sidebar_for_default_value').parent().css('display','none');
		jQuery('#sidebars_available_value').parent().css('display','none');
		if (jQuery('#post_type').length > 0 && jQuery('#post_type').val() == "page"){
			jQuery('#pageparentdiv.postbox .inside').append('<h4 class="page-option-title">Page Layout</h4><div class="des_layouts" title="none" /><div class="des_layouts" title="left" /><div class="des_layouts" title="right" /></div>');
			jQuery('#sidebars_available_value').add(jQuery('#sidebars_available_value').siblings()).wrapAll('<div class="des_sidebars_available" style="display:none;"/>');
			jQuery('#pageparentdiv.postbox .inside').append(jQuery('.des_sidebars_available'));
			jQuery('#pageparentdiv.postbox .inside .des_layouts').each(function(){
				if (jQuery(this).attr('title') === jQuery('#sidebar_for_default_value').val()){
					jQuery(this).addClass('selected');
				} else {
					jQuery(this).removeClass('selected');
				}
				if (jQuery('#pageparentdiv.postbox .inside .des_layouts.selected').attr('title') === "none"){
					jQuery('#pageparentdiv.postbox .inside .des_sidebars_available').fadeOut(500);
				} else {
					jQuery('#pageparentdiv.postbox .inside .des_sidebars_available').fadeIn(500);
				}
			
				jQuery(this).click(function(){
					jQuery(this).siblings().removeClass('selected');
					jQuery(this).addClass('selected');
					jQuery('#sidebar_for_default_value').val(jQuery(this).attr('title'));
					if (jQuery('#pageparentdiv.postbox .inside .des_layouts.selected').attr('title') === "none"){
						jQuery('#pageparentdiv.postbox .inside .des_sidebars_available').fadeOut(500);
					} else {
						jQuery('#pageparentdiv.postbox .inside .des_sidebars_available').fadeIn(500);
					}
				});
			});	
		}

		/* des_templater */
		jQuery('#new-meta-box-des-templater .inside .option-container:even').each(function(){
			jQuery(this).append(jQuery(this).next());
		});
		jQuery('#new-meta-box-des-templater .inside > .option-container .option-container').each(function(){
			jQuery(this).css({ 'margin-right': '40px', 'margin-top': '-100px', 'border': 'none', 'float':'right'});
			if (!jQuery(this).find('select option').length){
				jQuery(this).find('select').css('display','none').after('<h4>No templates found for this section.</h4>');
				jQuery(this).css({'margin-top':'0px', 'float':'left','display':'block'}).siblings().css('display','none');
			}
			if (jQuery(this).children('select').val() == null){
				jQuery(this).parent().siblings('select').val('no');
				jQuery(this).css('display','block');
			}
		});
		jQuery('#new-meta-box-des-templater .inside > .option-container > select').each(function(e){
			
			if (jQuery(this).val() === "no"){
				jQuery(this).siblings('.option-container').fadeOut(1, function(){
					jQuery('#new-meta-box-des-templater .option-container h4:not(.page-option-title').parent().css('display','block');
				});
			}
			jQuery(this).change(function(){
				if (jQuery(this).val() === "yes"){
					jQuery(this).siblings('.option-container').fadeIn(500);
				} else {
					jQuery(this).siblings('.option-container').fadeOut(500);
				}
			});
		});
		
		jQuery('#enable_header_template_value').parent().append('<div class="header_style_container"></div>');
		jQuery('.header_style_container').append(jQuery('#des_custom_header_style_value').siblings().addBack().add(jQuery('#headerStyleType_value').siblings().addBack()));
		jQuery('#headerStyleType_value').prev().add(jQuery('#headerStyleType_value')).add(jQuery('#headerStyleType_value').next()).wrapAll(jQuery('<div class="header_style_chooser" />').css({ 'margin-right': '40px', 'margin-top': '-100px', 'border': 'none', 'float':'right', 'max-width':'395px'}));

		jQuery('.option-container').each(function(){
			if (!jQuery(this).html().length) jQuery(this).remove();
		});
		if (jQuery('#des_custom_header_style_value').val() == "off"){
			jQuery('#headerStyleType_value').prev().prev().fadeOut(500);
			jQuery('#headerStyleType_value').prev().fadeOut(500);
			jQuery('#headerStyleType_value').fadeOut(500);
			jQuery('#headerStyleType_value').next().fadeOut(500);
		} else {
			jQuery('#headerStyleType_value').prev().prev().fadeIn(500);
			jQuery('#headerStyleType_value').prev().fadeIn(500);
			jQuery('#headerStyleType_value').fadeIn(500);
			jQuery('#headerStyleType_value').next().fadeIn(500);
		}
		jQuery('#des_custom_header_style_value').change(function(){
			if (jQuery(this).val() == "off"){
				jQuery('#headerStyleType_value').prev().prev().fadeOut(500);
				jQuery('#headerStyleType_value').prev().fadeOut(500);
				jQuery('#headerStyleType_value').fadeOut(500);
				jQuery('#headerStyleType_value').next().fadeOut(500);
			} else {
				jQuery('#headerStyleType_value').prev().prev().fadeIn(500);
				jQuery('#headerStyleType_value').prev().fadeIn(500);
				jQuery('#headerStyleType_value').fadeIn(500);
				jQuery('#headerStyleType_value').next().fadeIn(500);
			}
		});
		/* endof des_templater */
	
		this.setColorPickerFunc();
		/* check template type */
		if (jQuery('#page_template').length){
			designarePageOptions.updateCustomPageOpts();
			jQuery('#page_template').change(function(e){ designarePageOptions.updateCustomPageOpts(); });
		}
		
		/* flex custom options on projects */
		if (jQuery('#custom_slider_opts_value').length){
			this.updateCustomFlex();
			jQuery('#custom_slider_opts_value').change(function(e){ designarePageOptions.updateCustomFlex(); });
		}
		
		/* breadcrumbs */
		if (jQuery('#des_custom_breadcrumbs_value').length){
			this.updateBreadcrumbs();
			jQuery('#des_custom_breadcrumbs_value').change(function(e){ designarePageOptions.updateBreadcrumbs(); });
		}
		
		/* newsletter */
		if (jQuery('#des_custom_newsletter_value').length){
			this.updateNewsletter();
			jQuery('#des_custom_newsletter_value').change(function(e){ designarePageOptions.updateNewsletter(); });
		}
		
		if (jQuery('#homepageslider_value').val() === "no_slider"){
			jQuery('#homepageslider_value option[value=no_slider]').eq(0).attr('selected', true);
		}
		
		/* if post type option is available */
		if (jQuery('#posttype_value').length){
			jQuery('.thumb_slides_container').siblings('.description').remove();
			jQuery('#videoCode_noncename').parent().appendTo( jQuery('#videoCode_noncename').parent().prev() );
			jQuery('#videoCode_noncename').parent().removeClass('option-container');	
			designarePageOptions.updatePostTypeOpts();
			jQuery('#posttype_value').change(function(e){ designarePageOptions.updatePostTypeOpts(); });
		}
		
		/* if portfolio type option is available */
		if (jQuery('#portfolioType_value').length){
			jQuery('#videoCode_noncename').parent().appendTo( jQuery('#videoCode_noncename').parent().prev() );
			jQuery('#videoCode_noncename').parent().removeClass('option-container');
			designarePageOptions.updatePortfolioTypeOpts();
			jQuery('#portfolioType_value').change(function(e){ designarePageOptions.updatePortfolioTypeOpts(); });
		}
		
	},
	
	updateBreadcrumbs: function(){
		if (jQuery('#des_custom_breadcrumbs_value').val() == "off"){
			hideElements(jQuery('#des_custom_breadcrumbs_value').parent().next(), 0);
		} else showElements(jQuery('#des_custom_breadcrumbs_value').parent().next(), 0); 
	},
	
	updateNewsletter: function(){
		if (jQuery('#des_custom_newsletter_value').val() == "off"){
			hideElements(jQuery('#des_custom_newsletter_value').parent().next(), 0);
		} else showElements(jQuery('#des_custom_newsletter_value').parent().next(), 0); 
	},
	
	setColorPickerFunc:function(){
		//set the colorpciker to be opened when the input has been clicked
		
		jQuery('input.color').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				jQuery(el).val('#'+hex);
				jQuery(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor(this.value);
			}
		});
		
	},
	updateCustomFlex:function(){
		var elements = [
			jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next().next(),
			jQuery('#custom_slider_opts_value').parent().next().next(),
			jQuery('#custom_slider_opts_value').parent().next(),
			jQuery('#projs_flex_height_noncename').parent()
		];
		if (jQuery('#custom_slider_opts_value').val() == "off"){
			jQuery(elements).map(function(){this.toArray();});
			jQuery(elements).each(function(){jQuery(this).addClass('optoff');});
			hideElements(elements,0);
		} else {
			jQuery(elements).map(function(){this.toArray();});
			jQuery(elements).each(function(){jQuery(this).removeClass('optoff');});
			showElements(elements.reverse(),0);
		}
	},
	updateCustomPageOpts: function(){
		/* make custom page options available according to the page template type */
		switch (jQuery('#page_template').val()){
			case "default":
				toggleHomepageOptions("hide");
				togglePortfolioOptions("hide");
				toggleContactsOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > div.des_layouts').fadeIn(500);
				if (jQuery('#sidebar_for_default_value').val() != "none"){
					jQuery('#pageparentdiv.postbox .inside > .des_sidebars_available').fadeIn(500);
				}
				break;
			case "blog-template-fullwidth.php":
				toggleHomepageOptions("hide");
				togglePortfolioOptions("hide");
				toggleContactsOptions("hide");	
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .des_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').fadeOut(500);		
				break;
			case "blog-template-leftsidebar.php":
				toggleHomepageOptions("hide");
				togglePortfolioOptions("hide");
				toggleContactsOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .des_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').fadeOut(500);
				break;
			case "blog-template.php":
				toggleHomepageOptions("hide");
				togglePortfolioOptions("hide");
				toggleContactsOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .des_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').fadeOut(500);
				break;
			case "template-contacts.php":
				toggleHomepageOptions("hide");
				togglePortfolioOptions("hide");
				toggleContactsOptions("show");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .des_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').fadeOut(500);
				break;
			case "template-home.php":
				toggleHomepageOptions("show");
				togglePortfolioOptions("hide");
				toggleContactsOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .des_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').fadeOut(500);
				break;
			case "template-projects1.php":
				toggleHomepageOptions("hide");
				togglePortfolioOptions("show");
				toggleContactsOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .des_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').fadeOut(500);
				break;
			case "template-projects2.php":
				toggleHomepageOptions("hide");
				togglePortfolioOptions("show");
				toggleContactsOptions("hide");
				jQuery('#pageparentdiv.postbox .inside > h4, #pageparentdiv.postbox .inside > .des_sidebars_available, #pageparentdiv.postbox .inside > div.des_layouts').fadeOut(500);
				break;
		}	
	},
	updatePostTypeOpts: function(){
		switch(jQuery('#posttype_value').val()){
			case "image": case "text": case "none":
				var elements = [
					jQuery('#posttype_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next(),
					jQuery('#posttype_value').parent().next().next(),
					jQuery('#posttype_value').parent().next()
				];
				jQuery(elements).map(function(){this.toArray();});
				jQuery(elements).each(function(){jQuery(this).addClass('optoff');});
				hideElements(elements,0);
				break;
			case "slider":
				var showElms = [
					jQuery('#posttype_value').parent().next().next(),
					jQuery('#posttype_value').parent().next()
				];
				jQuery(showElms).map(function(){this.toArray();});
				jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
				showElements(showElms,0);
				var hideElms = [
					jQuery('#posttype_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next()
				];
				jQuery(hideElms).map(function(){this.toArray();});
				jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
				hideElements(hideElms,0);
				break;
			case "video":
				var showElms = [
					jQuery('#posttype_value').parent().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next()
				];
				jQuery(showElms).map(function(){this.toArray();});
				jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
				showElements(showElms,0);
				var hideElms = [
					jQuery('#posttype_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next(),
					jQuery('#posttype_value').parent().next()
				];
				jQuery(hideElms).map(function(){this.toArray();});
				jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
				hideElements(hideElms,0);
				break;
			case "audio":
				var showElms = [
					jQuery('#posttype_value').parent().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next()
				];
				jQuery(showElms).map(function(){this.toArray();});
				jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
				showElements(showElms,0);
				var hideElms = [
					jQuery('#posttype_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next().next(),
					jQuery('#posttype_value').parent().next().next().next(),
					jQuery('#posttype_value').parent().next().next(),
					jQuery('#posttype_value').parent().next()
				];
				jQuery(hideElms).map(function(){this.toArray();});
				jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
				hideElements(hideElms,0);
				break;
		}
	},
	updatePortfolioTypeOpts: function(){
		switch(jQuery('#portfolioType_value').val()){
			case "image":
				var showElms = [
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next(),
					jQuery('#portfolioType_value').parent().next()
				];
				showElms.push(jQuery('#singleLayout_value').parent());
				jQuery(showElms).map(function(){this.toArray();});
				jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
				showElements(showElms,0);
				var hideElms = [
jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next(),
				jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next(),
				];
				jQuery(hideElms).map(function(){this.toArray();});
				jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
				hideElements(hideElms,0);
				
				var elements = [
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next(),
					jQuery('#custom_slider_opts_value').parent().next(),
					jQuery('#projs_flex_height_noncename').parent(),
					jQuery('#projs_flex_autoplay_noncename').parent(),
					jQuery('#projs_flex_pause_hover_value').parent()
				];
				if (jQuery('#custom_slider_opts_value').val() == "off"){
					jQuery(elements).map(function(){this.toArray();});
					jQuery(elements).each(function(){jQuery(this).addClass('optoff');});
					hideElements(elements,0);
				} else {
					jQuery(elements).map(function(){this.toArray();});
					jQuery(elements).each(function(){jQuery(this).removeClass('optoff');});
					showElements(elements.reverse(),0);
				}
				
				break;
			case "video":
				var showElms = [
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next()
				];
				showElms.push(jQuery('#singleLayout_value').parent());
				jQuery(showElms).map(function(){this.toArray();});
				jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
				showElements(showElms,0);
				var hideElms = [
jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next(),
					jQuery('#portfolioType_value').parent().next(),
				];
				jQuery(hideElms).map(function(){this.toArray();});
				jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
				hideElements(hideElms,0);
				
				var elements = [
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next(),
					jQuery('#custom_slider_opts_value').parent().next(),
					jQuery('#projs_flex_height_noncename').parent(),
					jQuery('#projs_flex_autoplay_noncename').parent(),
					jQuery('#projs_flex_pause_hover_value').parent(),
					jQuery('#projs_flex_transition_value').parent(),
					jQuery('#projs_flex_transition_duration_value').parent(),
					jQuery('#projs_flex_slide_duration_value').parent(),
					jQuery('#projs_flex_height_value').parent(),
					jQuery('#projs_flex_navigation_value').parent(),
					jQuery('#projs_flex_controls_value').parent(),
					jQuery('#projs_flex_transition_value').parent(),
					jQuery('#projs_flex_transition_duration_noncename').parent(),
					jQuery('#projs_flex_slide_duration_noncename').parent(),
					jQuery('#projs_flex_autoplay_value').parent()
				];

				jQuery(elements).map(function(){this.toArray();});
				jQuery(elements).each(function(){jQuery(this).removeClass('optoff');});
				hideElements(elements,0);
				
				break;
			case "other":
				var hideElms = [
jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next().next(),
					jQuery('#portfolioType_value').parent().next().next(),
					jQuery('#portfolioType_value').parent().next(),
					//jQuery('#singleLayout_value').parent().prev(),
					jQuery('#singleLayout_value').parent()
				];
				jQuery(hideElms).map(function(){this.toArray();});
				jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
				hideElements(hideElms,0);
				
				var elements = [
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next().next(),
					jQuery('#custom_slider_opts_value').parent().next().next(),
					jQuery('#custom_slider_opts_value').parent().next(),
					jQuery('#projs_flex_height_noncename').parent(),
					jQuery('#projs_flex_autoplay_noncename').parent(),
					jQuery('#projs_flex_pause_hover_value').parent(),
					jQuery('#projs_flex_transition_value').parent(),
					jQuery('#projs_flex_transition_duration_value').parent(),
					jQuery('#projs_flex_slide_duration_value').parent(),
					jQuery('#projs_flex_height_value').parent()
				];

				jQuery(elements).map(function(){this.toArray();});
				jQuery(elements).each(function(){jQuery(this).addClass('optoff');});
				hideElements(elements,0);
				
				break;
		}
	}
};

function toggleBodyLayoutTypeOpts(action){
	var showElms = [
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next()

	];
	jQuery(showElms).map(function(){this.toArray();});
	jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
	var hideElms = [
		jQuery('#bodyLayoutType_value').parent().next().next().next().next().next().next().next(),
		jQuery('#bodyLayoutType_value').parent().next().next().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next().next(),
	    jQuery('#bodyLayoutType_value').parent().next()
	];
	jQuery(hideElms).map(function(){this.toArray();});
	jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
	switch(action){
		case "show":
			jQuery(showElms).each(function(){jQuery(this).removeClass('optoff');});
			showElements(showElms.reverse(),0);
			break;
		case "hide":
			jQuery(hideElms).each(function(){jQuery(this).addClass('optoff');});
			hideElements(hideElms,0);
			break;
	}
}

function toggleHomepageOptions(action){
	var elements = [
						jQuery('#homepageslider_value').parent(),
						jQuery('#homepageslider_value').parent().prev()
					];
	jQuery(elements).map(function(){this.toArray();});
	switch (action){
		case "show":
			jQuery(elements).each(function(){jQuery(this).removeClass('optoff');});
			showElements(elements.reverse(),0);
			break;
		case "hide":
			jQuery(elements).each(function(){jQuery(this).addClass('optoff');});
			hideElements(elements,0);
			break;
	}
}

function togglePortfolioOptions(action){
	var elements =  [
						jQuery('#postCategory_value').parent().next().next().next(),
						jQuery('#postCategory_value').parent().next().next(),
						jQuery('#postCategory_value').parent().next(),
						jQuery('#postCategory_value').parent(),
						jQuery('#postCategory_value').parent().prev()
					];
	jQuery(elements).map(function(){this.toArray();});
	switch (action){
		case "show":
			jQuery(elements).each(function(){jQuery(this).removeClass('optoff');});
			showElements(elements.reverse(),0);
			break;
		case "hide":
			jQuery(elements).each(function(){jQuery(this).addClass('optoff');});
			hideElements(elements,0);
			break;
	}
}

function toggleContactsOptions(action){
	var elements =  [
						jQuery('#googleLat_noncename').parent().next().next(),
						jQuery('#googleLat_noncename').parent().next(),
						jQuery('#googleLat_noncename').parent(),
						jQuery('#googleLat_noncename').parent().prev()
					];
	jQuery(elements).map(function(){this.toArray();});
	switch (action){
		case "show":
			jQuery(elements).each(function(){jQuery(this).removeClass('optoff');});
			showElements(elements.reverse(),0);
			break;
		case "hide":
			jQuery(elements).each(function(){jQuery(this).addClass('optoff');});
			hideElements(elements,0);
			break;
	}
}




function showElements(elements,idx){
	if (elements[idx]){
		if (!jQuery(elements[idx]).hasClass('optoff')){
			jQuery(elements[idx]).slideDown(50,function(){ showElements(elements, idx + 1 )});	
		} else {
			showElements(elements, idx + 1 );	
		}
	}
}

function hideElements(elements,idx){
	if(elements[idx]){
	    jQuery(elements[idx]).slideUp(50,function(){ hideElements(elements, idx + 1 )});
	}
}


jQuery(function(){
	designarePageOptions.init();
});

