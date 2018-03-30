jQuery(document).ready(function($) {
	"use strict";
	/**
	*	PLACEHOLDER
	************************************************/

	$('input[type=text]').placeholder();

	/**
	*	SUB MENU
	************************************************/

	$('#main-navigation ul li:has("ul")').find('a:first').append("<span class='has-submenu icon-angle-down'></span>");
	$('#main-navigation ul ul li:has("ul")').find('.has-submenu').removeClass("icon-angle-down").addClass("icon-angle-right");

	/**
	*	LightBox
	************************************************/
	// wp gallery
	$(".entry-content .gallery .gallery-item a").attr("data-gal","prettyPhoto[gal]");

	$("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
	
	//ajax
	$('#posts-outer').ajaxComplete(function() {
		$("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
	});

	/**
	*	ToolTip
	************************************************/

	$('.tooltip-nw').tipsy({gravity: 'nw',fade: true});
	$('.tooltip-n, #header-social a').tipsy({gravity: 'n',fade: true});
	$('.tooltip-ne').tipsy({gravity: 'ne',fade: true});
	$('.tooltip-w').tipsy({gravity: 'w',fade: true});
	$('.tooltip-e').tipsy({gravity: 'e',fade: true});
	$('.tooltip-sw').tipsy({gravity: 'sw',fade: true});
	$('.tooltip-s, .article-share a ,.widget-social a, .tooltip,.flickr_badge_image img,.tagcloud a').tipsy({gravity: 's',fade: true});
	$('.tooltip-se').tipsy({gravity: 'se',fade: true});
	//ajax
	$('#posts-outer').ajaxComplete(function() {
		$('.tooltip-nw').tipsy({gravity: 'nw',fade: true});
		$('.tooltip-n').tipsy({gravity: 'n',fade: true});
		$('.tooltip-ne').tipsy({gravity: 'ne',fade: true});
		$('.tooltip-w').tipsy({gravity: 'w',fade: true});
		$('.tooltip-e').tipsy({gravity: 'e',fade: true});
		$('.tooltip-sw').tipsy({gravity: 'sw',fade: true});
		$('.tooltip-s, .tooltip').tipsy({gravity: 's',fade: true});
		$('.tooltip-se').tipsy({gravity: 'se',fade: true});	
	});
	
	/**
	*	HEADER SEARCH
	************************************************/

	$('#header-search .search-icn').click(function(){

		var input = $('#header-search input');

		if( input.is(':hidden') ){
			input.fadeIn(300);
			$(this).removeClass('icon-search');
			$(this).addClass('icon-cancel');
			$("#main-navigation").hide();
		}else{
			input.fadeOut(300);
			$(this).removeClass('icon-cancel');
			$(this).addClass('icon-search');
			$("#main-navigation").show();	
		}
		return false;

	});

	$(document).bind( 'click', function(event) {

		if ( $(event.target).parents('#header-search').length === 0) {
			$('#header-search input').fadeOut(300);
			$('#header-search .search-icn').removeClass('icon-cancel');
			$('#header-search .search-icn').addClass('icon-search');
			$("#main-navigation").show();	
		}
	});
	/**
	*	Mobile menu
	******************************************************/
	$( "#main-nav-wrap select" ).change(function() { 
		window.location = $(this).find("option:selected").val();
	});

	/**
	*	Sticky Navigation
	************************************************/
	var aboveHeight      = $('#main-nav-wrap').outerHeight();
	var wrapSpace        = $('#main-nav-wrap').height() + 20;
	var navMargin	   = $('#main-nav-wrap').width() / 2; 
	var adminbarHeight = $('#wpadminbar').outerHeight();
	var disabledSticky  = $('#main-nav-wrap').hasClass('disabled-sticky');
	if( !disabledSticky ){
		if ( !adminbarHeight ) {
			adminbarHeight = 0;
		}
		$(window).scroll(function(){
			if($(window).scrollTop() > aboveHeight ){

				$('#main-wrap').css('margin-top',wrapSpace);

				if( $("body").has("#wpadminbar") ){
					$('#main-nav-wrap').addClass('fixed-nav').css({'top':adminbarHeight, 'margin-left':'-' + navMargin + 'px' });
				}else{
					$('#main-nav-wrap').addClass('fixed-nav');
				}

			}else{
				$('#main-nav-wrap').css({'top':'auto','margin-left':'auto'}).removeClass('fixed-nav');
				$('#main-wrap').css('margin-top','20px');
			}
		});
	}else {
		$('#main-nav-wrap').removeClass('fixed-nav');
	}

	/**
	* Equal height carousel items 
	*****************************************/
	equalHeight($("#carousel-items .slides li.item article, .related-articles .slides li.item article"));
	/**
	*	MediaElements
	**************************************/
	var MediaElementsSts = {
			audioWidth: '100%',
			audioHeight: '60',
			videoVolume: 'vertical',
			videoWidth: '100%',
			videoHeight: '100%',
			alwaysShowControls: true
	}
	if ( $.fn.mediaelementplayer ) {

		$('audio, video').mediaelementplayer(MediaElementsSts );		
	
		$('.mejs-video .mejs-controls').css({"opacity":"0", "visibility":"hidden"});
		$( ".mejs-video" ).on( "mouseenter", function() {
			clearTimeout($(this).data('timeout'));
	    		$(this).find('.mejs-controls').css({"opacity":'1', "visibility":'visible'});
	 	}).on( "mouseleave", function() {
	 		var $controls = $(this).find('.mejs-controls');
			var t = setTimeout(function() {
				$controls.css({"opacity":'0', "visibility":'hidden'});
			}, 3000);
			$(this).data('timeout', t);
		});
	 }
 	// ajax
	$('#posts-outer').ajaxComplete(function() {
		if ( $.fn.mediaelementplayer ) {
			$('audio, video').mediaelementplayer(MediaElementsSts);
		}
	});
 	/**
 	* Isotope
 	*****************************************************/
	function defaultIsotope( itemSelector ){
		var $defaultIsotope = {
			itemSelector: itemSelector,
			animationEngine: 'jquery',
			animationOptions: { duration: 800, easing: 'swing', queue: false },
			containerStyle: { overflow: 'visible', position: 'relative' },
			resizable: false,
			transformsEnabled: true
		}
		return $defaultIsotope;
	}

	$('.columns #posts-outer').imagesLoaded(function(){
		$('.columns #posts-outer').isotope( defaultIsotope('.columns article.post-inner') );
	});

	/**
	* Responsive Elements
	**************************************************/
	responsiveElements();
	$(window).smartresize(function() {
		// Call MatchMedia Conditions
	  	responsiveElements();
	  	//Relayout columns
	  	$('.columns #posts-outer').isotope('reLayout');
	});
	
	function responsiveElements() {
		
		if( matchMedia('only screen and (min-width: 768px) and (max-width: 979px)').matches ) {
			// Tablet
			$("#sidebar").isotope( defaultIsotope(".widget") );
			$(".two_col_full .mejs-video .mejs-time-rail, .two_col_full .mejs-video .mejs-time-rail .mejs-time-total").css('width', '86px');
		
		} else if ( matchMedia('only screen and (min-width: 480px) and (max-width: 767px)').matches ) {
			// Wide Phone
			$("#sidebar.isotope").isotope('destroy');
			$(".mejs-video .mejs-time-rail, .mejs-video .mejs-time-rail .mejs-time-total").css('width', '168px');
		}else if (  matchMedia('only screen and (max-width: 479px)').matches  ){
			//
			$("#sidebar.isotope").isotope('destroy');
			$(".mejs-video .mejs-time-rail, .mejs-video .mejs-time-rail .mejs-time-total").css('width', '86px');
		}else{
			// Desktop
			$("#sidebar.isotope").isotope('destroy');
			$(".two_col_full .mejs-video .mejs-time-rail, .two_col_full .mejs-video .mejs-time-rail .mejs-time-total").css('width', '168px');
			$(".two_col_sid .mejs-video .mejs-time-rail, .two_col_sid  .mejs-video .mejs-time-rail .mejs-time-total").css('width', '86px');
			$(".one_col_sid .mejs-video .mejs-time-rail, .one_col_sid  .mejs-video .mejs-time-rail .mejs-time-total").css('width', '318px');
		}

	}
	/**
	*   Login form
	*******************************************************************/

	$("#loginform-container #loginform").bind('submit', function(e){
		e.preventDefault();
		var loginform  = $(this);
		var username  = $("#user_login",this).val();
		var password  = $("#user_pass",this).val();
		var remember = $("#rememberme",this).is(':checked') ? true : "";
		
		$.post(van.AjaxUrl, { 
			action:'van_login_verification' , 
			username:username,
			password:password,
			remember:remember
		}, function(data) {
			if(data !== "success"){
				if ( data == "" ) {
					loginform.parent().find("p.error-message").fadeIn().html('<strong>ERROR</strong>: Invalid username or password.');
				}else{
					loginform.parent().find("p.error-message").fadeIn().html(data);
				}
				
			}else{
				loginform.parent().find("p.error-message").fadeOut();
				window.location.reload(true);
			}
		});
	});
	/**
	*	Retina
	************************************************************************/
	if(window.devicePixelRatio > 1.5){
		$('img.retina').each(function(){
			var $img = $(this);
			var retinaImg = $img.attr('data-retina'); 
			if( retinaImg && retinaImg !== "" ){
				$img.attr('src', retinaImg); 
				$img.removeAttr('data-retina');
			}
		});
	}
	/**
	* Scroll to top
	************************************************************************/
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.scrolltop').fadeIn(300).css({bottom: '15px'});
		} else {
			$('.scrolltop').css({bottom: '-60px'}).fadeOut(300);
		}
	});
	$('.scrolltop').click(function () {
		$('html, body').animate({scrollTop: 0}, "slow");
		return false;
	});
	/**
	*  Ajax Load more posts
	************************************************************************/

	$(".load-more").click(function(){

		if( van.PageNum < van.MaxPages ){

			van.PageNum++;
			$(".load-more").text(van.LoadingText).addClass('btn-loading');

			$.post(van.AjaxUrl, { 
					action:"van_ajax_load_more", 
					postsnonce:van.Nonce ,
					Pagenum:van.PageNum, 
					postsCat:van.postsCat
				},function(data){

				var items = $(data);
				var appendedData = $("#posts-outer").append(items);

				if( $("#main-content").hasClass("columns") ){
					appendedData.isotope( 'appended', items, function(){
						jQuery("#posts-outer").isotope('reLayout');
					});
				}
				$("#sidebar.isotope").isotope('reLayout');

			}).done(function() {

				$(".load-more").removeClass('btn-loading');

				if(van.PageNum < van.MaxPages){
					$(".load-more").text(van.LoadText);
				}else{
					$(".load-more").text(van.NoPtsText);
				}
			});
		}else{
			$(".load-more").text(van.NoPtsText).removeClass('btn-loading');
		}
		return false;
	});
	/**
	*	Tabs
	*********************************************************************/
	vanTabs( $('.tabs-widget .tabs-nav a'), $('.tabs-widget .tabs-nav'),$('.tabs-widget .tab-inner') );
	vanTabs( $('.tabs-controls a'), $('.tabs-controls'),$('.tab-content') );
	// ajax
	$('#posts-outer').ajaxComplete(function() {
		vanTabs( $('.tabs-controls a'), $('.tabs-controls'),$('.tab-content') );
	});
	/**
	* Accordion
	*********************************************************************/
	vanAccordion( $('.accordion-control a'), $('.accordion-content') );
	// ajax
	$('#posts-outer').ajaxComplete(function() {
		vanAccordion( $('.accordion-control a'), $('.accordion-content') );
	});
	/**
	* Toggle
	*********************************************************************/
	$(".toggle h3 a").removeAttr("href");
	$(".toggle-content.toggle-close").hide();
	$(".toggle h3 a").on("click", function (event) {

		var toggleContainer = $(this).parent().parent();
		var toggleContent    = toggleContainer.find(".toggle-content");

		if ( $(this).hasClass("toggle-open") ) {

			$(this).removeClass("toggle-open").addClass("toggle-close");
			toggleContent.removeClass("toggle-open").slideUp().addClass("toggle-close");

		}else if( $(this).hasClass("toggle-close") ){

			$(this).removeClass("toggle-close").addClass("toggle-open");
			toggleContent.removeClass("toggle-close").slideDown().addClass("toggle-open");

		}
		event.preventDefault();
	});
	// ajax
	$('#posts-outer').ajaxComplete(function() {
		$(".toggle h3 a").removeAttr("href");
		$(".toggle-content.toggle-close").hide();
	});
	/**
	*	contact form
	*********************************************************************/
	$("#contactform #msg-name, #contactform #msg-email, #contactform #msg-text, #contactform #msg-human").keyup(function(){
		$(this).removeClass("input-error");
	});
	$("#contact #contactform").submit(function(){

		var msg_name = $("#msg-name",this);
		var msg_email = $("#msg-email",this);
		var msg_text = $("#msg-text",this);
		var msg_human  = $("#msg-human",this);
		var human1 = parseInt($("#human1",this).val(), null);
		var human2 = parseInt($("#human2",this).val(), null);
		var human = human1 + human2;
		var error = false;	
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
		
		if ( msg_name.val() === "" || msg_name.val().length < 2 ) {
			msg_name.addClass("input-error");
			error          = true;	
		}
		if ( msg_email.val() === "" || !emailReg.test(msg_email.val()) ) {
			msg_email.addClass("input-error");
			error          = true;
		}
		if ( msg_text.val() === "" || msg_text.val().length < 4 ) {
			msg_text.addClass("input-error");
			error          = true;
		}
		if ( msg_human.val() === "" || parseInt(msg_human.val()) !==  human ) {
			msg_human.addClass("input-error");
			error          = true;
		}
		if ( !error ) {
			$(this).find('.btn-loading').fadeIn();
			$.post(van.AjaxUrl, { 
				action:'van_contact_us', 
				msg_name:msg_name.val(),
				msg_email:msg_email.val(),
				msg_text:msg_text.val(),
				msg_human:msg_human.val(),
				human1:human1,
				human2:human2
			}, function(data) {
				$("#contact").find("p.message").fadeIn().html(data);
				$("#contact").find('.btn-loading').fadeOut();
			});	
			
		}
		return false;
	});
});
/**
* Likes
**/
function vanAddVote(post_id){

	var $item = jQuery("#post-like-" + post_id);

	jQuery.post( van.AjaxUrl, { 
		action:'van_post_vote', 
		post_id:post_id,
		nonce:van.Nonce
	}, function(data) {
		if( data !== "voted" && data !== "" ){
			$item.addClass("voted").attr('title',van.VotedTitle).tipsy({gravity: 's',fade: true}).find(".likes-val").text(data);
		}
	});

	return false;
}
/**
* Tabs
**/
function vanTabs( a, ctrParent,content ){
	a.filter(":first").addClass("active");
	content.filter(":first").addClass("active");
	a.removeAttr("href");

	a.on('click', function () {

		var index  = a.index(this);
		var active = ctrParent.find('a.active');

		if ( a.index(active) !== index) {

			active.removeClass('active');
			jQuery(this).addClass('active');
			content.filter(".active").hide().removeClass('active');
			content.filter(':eq(' + index + ')').fadeIn(700).addClass('active');

		}
	});

}
/**
*  Accordion
*/
function vanAccordion(a, content){

	a.filter(":first").addClass("active");
	content.filter(":first").addClass("active");
	a.removeAttr("href");
	
	a.click(function(event) {

		if ( !jQuery(this).hasClass("active") ) {
			a.filter(".active").removeClass("active");
			content.filter('.active').slideUp().removeClass("active");
			jQuery(this).addClass("active");
			jQuery(this).parent().next().slideDown().addClass("active");
		}
		event.preventDefault();

	});
}
/**
* Social shares pop-up
*/
function vanOpenUrl(url) {
	var newwindow = window.open(url,'name','height=420,width=750,resizable=0,toolbar=0,menubar=0,scrollbars=0');
	if ( window.focus ) {
		newwindow.focus();
	}
}
/**
* Equal height 
*****************************************/
function equalHeight(group) {
	tallest = 0;
	group.each(function() {
		thisHeight = jQuery(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}