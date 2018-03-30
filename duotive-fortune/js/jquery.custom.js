/*!
 *
 * jQuery Duotive Custom
 * http://duotive.org
 *
 * Copyright 2011, Duotive
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * 
 * Date: Mon December 19th 13:39 GMT+2 2011
 *
 */
$(document).ready(function($) {	
	if ($.browser.webkit) {
		$('body').addClass('webkit');
	}	
	/* SCROLL TO TOP LINKS */
	$(".scroll").click(function(event){
		event.preventDefault();
		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
		$('html, body').animate({scrollTop:target_top}, 500);
	});	
	
	/* BACK TO TOP BUTTON */
    $("#backtotop").hide().removeAttr("href");
    if ($(window).scrollTop() != "0") {
        $("#backtotop").fadeIn("slow")
    }
    var scrollDiv = $("#backtotop");
    $(window).scroll(function() {
        if ($(window).scrollTop() == "0") {
            $(scrollDiv).fadeOut("fast")
        } else {
            $(scrollDiv).fadeIn("fast")
        }
    });
    $("#backtotop").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow")
    })
    
	/* DT-LOADER */
	var dt_loader_interval = 0,
		dt_loader_direction = 'right';
	function anim_dt_loader() {
		var loader = $('#dt-loader'),
			offset = 2,
			position = 0;
		if (dt_loader_direction === undefined) { dt_loader_direction = 'right'; }
		switch (dt_loader_direction) {
		case 'right':
			position = loader.find('#dt-loader-bar').width() - loader.find('.inner').width() - offset;
			dt_loader_direction = 'left';
			break;
		case 'left':
			position = offset;
			dt_loader_direction = 'right';
			break
		}
		loader.find('.inner').stop().animate({'left': position}, 1000, 'linear');
	}
	function start_dt_loader() {
		dt_loader_interval = setInterval(function () {
			anim_dt_loader();
		}, 1000);
	}
	function rm_dt_loader() {
		clearInterval(dt_loader_interval);
		$('#dt-loader').remove();
	}
	start_dt_loader();
	
	/* GENERAL */
	
	//form replacement
	$("form").jqTransform();
	
	//add images rels for modal window calls
	$("img.alignnone, img.aligncenter, img.alignleft, img.alignright").parent().attr('rel','modal-window');	
	$("div.alignnone a, div.aligncenter a, div.alignleft a, div.alignright a").attr('rel','modal-window');
	$(".gallery-wrapper a").attr('rel','modal-window[gallery]');	
	$("#slideshow-wrapper .gallery-wrapper a").attr('rel','');
	//juqery ui calls
	$(".dt-accordion").accordion({ collapsible: true, active: -1, autoHeight: false });
	$(".front-page-latest-news .accordion").accordion({ collapsible: true, active: 0, autoHeight: false });	
	$('.tabs').tabs({ fx: { opacity: 'toggle' } });
	
	//content alteration
	$('.dt-button-icon').append('<span></span>');
	$('table tr:odd').addClass("alternative");
	$(".widget-container ul li:first-child").addClass("first-child");
	$(".dt-accordion h3.ui-accordion-header:first-child").addClass("ui-accordion-header-first-child");
	$(".dt-tabs-shortcode .ui-tabs-nav li:first-child").addClass("ui-tabs-nav-first-child");	
	$(".widget-container ul li:last-child").addClass("last-child");	
	$(".widget-container ul li ul li:last-child").addClass("last-child");
	$("#content .post-type-3:first-child").addClass("post-type-3-first");
	$("#content .post-type-3:last").addClass("post-type-3-last");
	$("#content .post-type-5-sep:last").addClass("post-type-5-sep-last");	
	$(".dt-pricing div:first-child").addClass('dt-pricing-table-first');
	$(".dt-pricing div:last-child").addClass('dt-pricing-table-last');
	$(".dt-pricing div:odd").addClass('dt-pricing-table-alternate');
	$(".dt-pricing div.dt-pricing-column-featured").next().addClass('dt-pricing-column-after-featured');	
	$(".dt-pricing div.dt-pricing-column-featured, .dt-pricing-box-featured").append('<div class="ribbon"></div>');
	$(".dt-pricing").each(function(index) {
		var dtPricingWidth = $(this).parent().css('width').replace("px", "");
		if ( dtPricingWidth > 900 ) dtPricingWidth = 900;
		var dtPricingElements = $(this).children().length;
		var dtPricingElementsWidth = dtPricingWidth / dtPricingElements - 32;
		$(this).children().css('width',dtPricingElementsWidth);
	});
	$('.dt-tour .ui-tabs-nav li').css('width',parseInt($('.dt-tour .ui-tabs-nav').css('width'))/$('.dt-tour .ui-tabs-nav li').length - 30);

	/*SINGLE POST METABOX TOGGLER*/
	
	$(".post-metabox-close").click(function() {
		var extraNoFeaturedImage = 0;
		if ( $("#single").hasClass('no-featured-image') ) extraNoFeaturedImage = 3;
		if ( $("#single-full-width").hasClass('no-featured-image') ) extraNoFeaturedImage = 3;
		var margintop = $(this).parent().height() + 49;
		var actualmargin = $(this).parent().css('margin-top').replace("px", "");
		if ( actualmargin == 0 ) 
		{
			$(this).parent().stop().animate({'margin-top': -margintop + extraNoFeaturedImage}, 300);
			$(this).children().text('INFO');
		}
		if ( actualmargin == ( -margintop + extraNoFeaturedImage ) ) 
		{
			$(this).parent().stop().animate({'margin-top': 0}, 300);
			$(this).children().text('CLOSE');
		}
	});
	var extraNoFeaturedImage = 0;
	if ( $("#single").hasClass('no-featured-image') ) extraNoFeaturedImage = 3;
	if ( $("#single-full-width").hasClass('no-featured-image') ) extraNoFeaturedImage = 3;
	var margintop = $(".post-metabox-close").parent().height() + 49;    	
	$(".post-metabox").css('margin-top',-margintop + extraNoFeaturedImage);
	
	/*PORTFOLIO AND GALLERIES ICON ANIMATION*/
	
	$('.portfolio-columns .project-image span,.portfolio-grid .project-image span,.portfolio-category-view .project-image span').css('opacity',0);
	$('.portfolio-columns .project-image,.portfolio-grid .project-image,.portfolio-category-view .project-image').hover(
	  function () {
		$(this).find('.portfolio-icon').stop().animate({opacity: '1'}, 150, function() {});
	  }, 
	  function () {
		$(this).find('.portfolio-icon').stop().animate({opacity: '0'},150, function() {});
	  }
	);
	$('.duotive-gallery-item .gallery-icon .icon-zoom').css('opacity',0);
	$('.duotive-gallery-item .gallery-icon').hover(
	  function () {
		$(this).find('.icon-zoom').stop().animate({opacity: '1'}, 150, function() {});
	  }, 
	  function () {
		$(this).find('.icon-zoom').stop().animate({opacity: '0'},150, function() {});
	  }
	);

	/* CONTACT PAGE AND WIDGET*/
	
	$("#page-contact").validate();
	function showLoader2 () {
		$('#page-contact-confirmation-message').fadeOut();
		$('#page-contact-loader').fadeIn();
		if ( $('#page-contact #recaptcha_widget').length > 0 ) Recaptcha.reload();
	}
	function showResponse2(responseText, statusText, xhr, $form)  {
		$('#page-contact-loader').fadeOut();
		$('#page-contact-confirmation-message').html();
		$('#page-contact-confirmation-message').html(responseText);
		$('#page-contact-confirmation-message').fadeIn();
	}	
    var contactformoptions2 = { 
        beforeSubmit:  showLoader2,  // pre-submit callback 
        success:       showResponse2  // post-submit callback 
    };
	$('#page-contact').ajaxForm(contactformoptions2);
	
	$("#widget-contact").validate();
	function showLoader3 () {
		$('#widget-contact-confirmation-message').fadeOut();
		$('#widget-contact-loader').fadeIn();
		if ( $('#widget-contact #recaptcha_widget').length > 0 ) Recaptcha.reload();
	}
	function showResponse3(responseText, statusText, xhr, $form)  {
		$('#widget-contact-loader').fadeOut();
		$('#widget-contact-confirmation-message').html();
		$('#widget-contact-confirmation-message').html(responseText);
		$('#widget-contact-confirmation-message').fadeIn();
	}	
    var contactformoptions3 = { 
        beforeSubmit:  showLoader3,  // pre-submit callback 
        success:       showResponse3  // post-submit callback 
    };
	$('#widget-contact').ajaxForm(contactformoptions3);	
	
	/* HEADER */
	
	// menu calls
    $('#mainmenu ul').superfish({ 
        delay:       500,
        animation:   {opacity:'show',height:'show'},
        speed:       'fast',
        autoArrows:  true,
        dropShadows: false
    });
	$("#header-sharing a:last-child").addClass("social-item-last");
	$("#mainmenu ul li:last-child").addClass("last-child");
	$("#mainmenu ul > li").hover(
	  function () {
		$(this).prev().toggleClass("prev-to-hover");
	  }
	);	

	// search widget animations	
	function search_inactive() {
		$('#header-search-wrapper').stop().animate({width: '189px'}, 340);
		$('#header-search-wrapper').find('form').stop().animate({width:152, 'padding-left': 24}, 400);
		$('#header-search-wrapper').find('form input:text').stop().animate({'text-indent':0}, 200);		
		$('#header-search-button').removeClass('inactive');
	  	$('#header-search-button').addClass('active');
	}	
	function search_active() {
		$('#header-search-wrapper').find('form input:text').stop().animate({'text-indent':'-200px'}, 100);
		$('#header-search-wrapper').stop().animate({width: '29px'}, 340);
		$('#header-search-wrapper').find('form').stop().animate({width:0, 'padding-left': 0}, 400);
		$('#header-search-button').removeClass('active');
	  	$('#header-search-button').addClass('inactive');
	}	
	$('#header-search-button').click(function() {
		if($(this).attr('class') == 'inactive') {
			search_inactive();
		} else {
			search_active();
		}		
	});
	search_active();
	
	
	/* FRONTPAGE */
	
	// frontpage general alteration
	$("#frontpage .accordion .ui-state-default").click(function(){
		$("#frontpage .accordion .ui-state-default").removeClass('before-active')													   	
		$(this).prev().prev().addClass('before-active');
	});
	$("#frontpage .front-page-row-sep:last-child").addClass("front-page-row-sep-last-child");
	$("#frontpage .front-page-row:first").addClass("front-page-row-first");
	$("#frontpage .front-page-tabs ul.ui-tabs-nav li:first").addClass('first-child');
	$("#frontpage .front-page-tabs ul.ui-tabs-nav li:last-child").addClass('last-child');

	// frontpage contact form calls
	$("#front-page-contact").validate();
	function showLoader () {
		$('#front-page-contact-confirmation-message').fadeOut();
		$('#front-page-contact-loader').fadeIn();
		if ( $('#recaptcha_widget').length > 0 ) Recaptcha.reload();
	}
	function showResponse(responseText, statusText, xhr, $form)  {
		$('#front-page-contact-loader').fadeOut();
		$('#front-page-contact-confirmation-message').html();
		$('#front-page-contact-confirmation-message').html(responseText);
		$('#front-page-contact-confirmation-message').fadeIn();
	}	
    var contactformoptions = { 
        beforeSubmit:  showLoader,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
    };
	$('#front-page-contact').ajaxForm(contactformoptions);
	
	$('.clear-content input,.clear-content textarea').keydown(function() {
		var value = $(this).attr('value');
		if ( value != '' )
		{
			$(this).prev().addClass("button-display");
		}
		if ( value == '' )
		{
			$(this).prev().removeClass("button-display");
		}
		$(this).prev().click(function() {
			$(this).next().attr('value','');
			$(this).removeClass("button-display");
		});
	});
	$('.front-page-partners .front-page-partners-wrapper').carousel({pagination:false,continuous:true,itemsPerTransition:1,autoScroll:true});

	/* FOOTER */
	
	$('#footer-sharing a').hover(
	  function () {
		$(this).stop().animate({width: '120px'}, 500, function() {});
	  }, 
	  function () {
		$(this).stop().animate({width: '29px'},550, function() {});
	  }
	);	
	$("#footer-sharing a:last-child").addClass('social-item-last');
	
});
jQuery(window).load(function (dt_loader_interval) {
	
	/* DT-LOADER CLEAR */
	
	clearInterval(dt_loader_interval); jQuery('#dt-loader').remove();
	jQuery('body.loader-active #background-container,body.loader-active section,body.loader-active header,body.loader-active footer,body.loader-active #backtotop').css({opacity: 1});

	/* BACKGROUND ANIMATION AND RESIZE FOR MOBILE */
	
	jQuery("#background-container ul li.static-image").animate({opacity: 1}, 700);
	jQuery("#background-container").css('background-image','none');
	if( navigator.userAgent.match(/Android/i) ||
	 navigator.userAgent.match(/webOS/i) ||
	 navigator.userAgent.match(/iPhone/i) ||
	 navigator.userAgent.match(/iPod/i)
	 ){
		var backgroundImage = jQuery("#background-container ul li.static-image").css('background-image');
		jQuery("#background-container").remove();				
		jQuery('body').css({
			'width':jQuery(document).width(),
			'height':jQuery(document).height(),
			'background':backgroundImage + 'no-repeat fixed left top'
		});
		jQuery('#content-wrapper').css({
			'margin-left':'30px',
			'margin-right':'30px'		
		});
		jQuery(window).resize(function(){
			jQuery('body').css({
				'width':jQuery(document).width(),
				'height':jQuery(document).height()
			});
		});
	}	
		
	/*INTERNET EXPLORER 8 MENU FIX*/
	
	if(jQuery.browser.msie && jQuery.browser.version.substring(0, 2) == "8.")
	{
		var mainmenuWidth = 0;
		jQuery("#mainmenu ul li").not("#mainmenu ul li ul li").each(function(index) {
			mainmenuWidth = mainmenuWidth + parseInt(jQuery(this).css('width')) + 2;
		});
		jQuery("#mainmenu ul").not("#mainmenu ul ul").css('width',mainmenuWidth);
	}
	
	/*GENERAL*/
	
	header_sharing_delay = 50;
	header_sharing_count = jQuery("#header-sharing a").length;
	jQuery("#header-sharing a").each(function(index) {
		jQuery(this).delay(header_sharing_delay).animate({top: '0px'});
		header_sharing_delay = header_sharing_delay + 50;
	  });	
	jQuery("#header-search-sep").delay(header_sharing_delay + 70 * header_sharing_count ).animate({'opacity': 1});	  	
	jQuery("a[rel^='modal-window']").prettyPhoto({deeplinking: true,overlay_gallery: false,show_title:false,default_width: 800,default_height: 600});

});