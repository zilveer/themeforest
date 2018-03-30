/* **************Init JS*********************
	
    TABLE OF CONTENTS
	---------------------------
	1. Preloader
	2. Ready Function
	   a) Auto height for the home page
	   b) Smooth Scroll
	   c) 3d gallery
	   d) Vimeo Video
	   e) Schedule Accordian
	   f) Speaker Slider
	   g) Animation
	   h) Registration Form
	   i) Subscribe
	   j) Nice Scroll
	   h) Placeholder for ie9

*/

"use strict";

//Theme Options
var themeElements = {
	submitButton: '.submit-button',
	ajaxForm: '.ajax-form',
};
/* ************************************/
/* Preloader */
/* *************************************/
jQuery(window).load(function() {
    // will first fade out the loading animation
	jQuery(".status").fadeOut();
    // will fade out the whole DIV that covers the website.
	jQuery(".preloader").delay(100).fadeOut("slow");
	jQuery("body").css('overflow-y','visible');
	if(jQuery("body#top").length>0)
	{
		var height=jQuery(".navbar.navbar-default").height() + 1;
		jQuery('body').scrollspy({
			spy:'scroll',
			target:'.navbar',
			offset: height
		});
	}
});

/* ************************************/
/* Ready Function */
/* *************************************/
	
jQuery( document ).ready(function( $ ) {
	$.noConflict();
	/*variable declaration*/
	var width;
	var height;
	var scroll;
	/*variable declaration*/
    /*Carousel Slider*/
    $('.carousel').carousel({
        interval: 450000 //changes the speed
    });
	/* Event features height */
	
	/*Toggle*/
	$(".togglec").hide();
	$(".togglet").click(function(){
		$(this).toggleClass("toggleta").next(".togglec").slideToggle(300);
		return true;
	});
	/*Sound Option*/
	if($("#home_video").length > 0){
		$(".sound-option .fa-volume-up").click(function(){
			$('.sound-option .fa-volume-up').css('opacity', '0');
			$('.sound-option .fa-volume-off').css('opacity', '1');
			$('#home_video').prop("muted",true);	
		});
		$(".sound-option .fa-volume-off").click(function(){
			$('.sound-option .fa-volume-up').css('opacity', '1');
			$('.sound-option .fa-volume-off').css('opacity', '0');	
			$('#home_video').prop("muted",false);		
		});
	}	
	if($(".audio-frame.post").length > 0){
		$(".sound-option .fa-volume-up").click(function(){
			$('.sound-option .fa-volume-up').css('opacity', '0');
			$('.sound-option .fa-volume-off').css('opacity', '1');
			var  audio_widget= SC.Widget("audio-frame");
			audio_widget.pause();			
		});
		$(".sound-option .fa-volume-off").click(function(){
			$('.sound-option .fa-volume-up').css('opacity', '1');
			$('.sound-option .fa-volume-off').css('opacity', '0');	
			var  audio_widget= SC.Widget("audio-frame");
			audio_widget.play();			
		});
	}
	if($("#vimeo_c").length > 0){ 
		$(".sound-option .fa-volume-up").click(function(){
			$('.sound-option .fa-volume-up').css('opacity', '0');
			$('.sound-option .fa-volume-off').css('opacity', '1');
			player.api('setVolume', 0);
		});
		$(".sound-option .fa-volume-off").click(function(){
			$('.sound-option .fa-volume-up').css('opacity', '1');
			$('.sound-option .fa-volume-off').css('opacity', '0');	
			player.api('setVolume', 1);
		});
	}
	/* Event features height */
	if($(".event-features").length>0)
	{
		height=$(".event-features").height();
		width = $(window).width();
		if(width>=1200)
		$(".slide_gallery").height(height);
	}
	/* Event features height */
	/*Accordion*/
	 var $accordionEl = $('.accordion');
		if( $accordionEl.length > 0 ){
			$accordionEl.each( function(){
				var $accElement = $(this);
				var accElementState = $accElement.attr('data-state');

				$accElement.find('.acc_content').hide();

				if( accElementState != 'closed' ) {
					$accElement.find('.acctitle:first').addClass('acctitlec').next().show();
				}

				$accElement.find('.acctitle').click(function(){
					if( $(this).next().is(':hidden') ) {
						$accElement.find('.acctitle').removeClass('acctitlec').next().slideUp("normal");
						$(this).toggleClass('acctitlec').next().slideDown("normal");
					}
					return false;
				});
			});
		}
	/*AJAX Form*/
	$(themeElements.ajaxForm).each(function() {
		var form=$(this);
		
		form.submit(function() {
			var message=form.find('.message'),
				loader=form.find('.form-loader'),
				button=form.find(themeElements.submitButton);
				
			var data={
					action: form.find('.action').val(),
					nonce: form.find('.nonce').val(),
					data: form.serialize(),
				}
			
			button.addClass('disabled');
			loader.show();
			message.slideUp(300);
			
			$.post(form.attr('action'), data, function(response) {
				if($('.redirect', response).length) {
					if($('.redirect', response).attr('href')) {
						window.location.href=$('.redirect',response).attr('href');
					} else {
						window.location.reload();
					}
				} else {
					loader.hide();
					button.removeClass('disabled');
					message.html(response).slideDown(300);
				}
			});
			$(form)[0].reset();
			return false;
		});
	});
	
	/* ** Auto height function ***/
	var setElementHeight = function () {
		height = $(window).height();
		if($('.autoheight').length>0)
		{
			width = $(window).width();
			if(width>=1200)
			$('.autoheight').css('height', height);
			else{
			/*height = $("#home_slider").height();
			alert("height:"+height);*/
			$('.autoheight').css('height', height);
			}
		}
		if($(".header").length>0)
		{
			height = $(".header").height();
			$('.content-wrapper').css('padding-top', height+"px");
			$('.content-wrapper').css('padding-bottom', height+"px");
		}
	};

	$(window).on("resize", function () {
		setElementHeight();
	}).resize();
	
	$(".subscribe button").each(function() {
		width=$(this).find("span").width();
		$(this).css("width",width+"px");
		$(this).find("i").css("left",((width/2)-20)+"px");
	});
	/* ******tabs***********/
	$( ".side-tabs" ).tabs({ show: { effect: "fade", duration: 400 } });
	/* *******Vimeo Video**************** */
	if($(".venobox").length>0)
	{
		$('.venobox').venobox({
			numeratio: true,
			infinigall: true,
			border: '20px'
		});		
	}
	if($(".venoboxvid").length>0)
	{
		$('.venoboxvid').venobox({
			bgcolor: '#000'
		});
	}
	if($(".venoboxframe").length>0)
	{
		$('.venoboxframe').venobox({
			border: '6px'
		});
	}
	if($(".venoboxinline").length>0)
	{
		$('.venoboxinline').venobox({
			framewidth: '300px',
			frameheight: '250px',
			border: '6px',
			bgcolor: '#f46f00'
		});
	}
	if($(".venoboxajax").length>0)
	{
		$('.venoboxajax').venobox({
			border: '30px;',
			frameheight: '220px'
		});	
	}
		
	/* ******Schedule Accordion ************ */
	$('.accordion .item .heading').click(function() {		
	var a = $(this).closest('.item');
	var b = $(a).hasClass('open');
	var c = $(a).closest('.accordion').find('.open');
		
	if(b != true) {
		$(c).find('.content').slideUp(500);
		$(c).removeClass('open');
	}

	$(a).toggleClass('open');
		$(a).find('.content').slideToggle(500);
	});

	$('.nav_slide_button').click(function() {
		$('.pull').slideToggle();
	});	
	/* Overlay */
	if (Modernizr.touch) {
	// show the close overlay button
		$(".close-overlay").removeClass("hidden");
		// handle the adding of hover class when clicked
		$(".img").click(function(e){
			if (!$(this).hasClass("hover")) {
				$(this).addClass("hover");
			}
		});
		// handle the closing of the overlay
		$(".close-overlay").click(function(e){
			e.preventDefault();
			e.stopPropagation();
			if ($(this).closest(".img").hasClass("hover")) {
				$(this).closest(".img").removeClass("hover");
			}
		});
	} else {
		// handle the mouseenter functionality
		$(".img").mouseenter(function(){
			$(this).addClass("hover");
		})
		// handle the mouseleave functionality
		.mouseleave(function(){
			$(this).removeClass("hover");
		});
	}
	
	/* **************** Animation ***************** */
		
	/* *Subscribe JS **/

	/* *********Menu Close Logic***************/
	$('.navbar-collapse.in').niceScroll({cursorcolor:"#c8bd9f"});
		$('.nav li a').click(function(){
			$('.navbar-collapse.collapse').toggleClass('in');
	});		
	/* ****** Nice Scroll ****** */
	if (window.globalNiceScroolVar==="true") {
		$("html").niceScroll();		
	}	 
	var wow = new WOW( {
		boxClass: 'wow', // animated element css class (default is wow)
		animateClass: 'animated', // animation css class (default is animated)
		offset: 0, // distance to the element when triggering the animation (default is 0)
		mobile: false, // trigger animations on mobile devices (default is true)
		live: true // act on asynchronously loaded content (default is true)
	});	
	wow.init();
	/* *Placeholder JS call **/
	$('input[type=text], textarea').placeholder();	
		
	/* **************** Multilevel Menu ***************** */
	$(".navbar-nav > li").mouseover(function(e){
		if ( $(this).has('ul.dropdown-menu').length > 0 ) 
		{
			$(this).addClass('dropdown active open');
			$(this).children('ul.dropdown-menu').addClass('show');
		}		
		/*alert('mouseover');*/
	});
	$(".navbar-nav > li").mouseout(function(e){
		if ( $(this).has('ul.dropdown-menu').length > 0 ) 
		{
			$(this).removeClass('dropdown active open');
			$(this).children('ul.dropdown-menu').removeClass('show');
		}		
		/*alert('mouseout');*/
	});
	$(".dropdown-menu > li").mouseover(function(e){
		
		if ( $(this).has('ul.dropdown-menu').length > 0 ) 
		{
			$(this).addClass('dropdown active open');
			$(this).children('ul.dropdown-menu').addClass('show');
		}
		/*alert('mouseover');*/
	});
	$(".dropdown-menu > li").mouseout(function(e){
		if ( $(this).has('ul.dropdown-menu').length > 0 ) 
		{
			$(this).removeClass('dropdown active open');
			$(this).children('ul.dropdown-menu').removeClass('show');
		}
	});
	/* **************** Multilevel Menu ***************** */
		
	/***********************************/
	/*Counter JS*/
	/**********************************/	
	$(function () {	  
		if (window.globalDateVar) {
			var austDay = new Date();
			austDay =  new Date(window.globalDateVar);
			$('#defaultCountdown').countdown({
			until: austDay, padZeroes: true,format: 'DHMS'});
			$('#year').text(austDay.getFullYear());
		}
	});
	/***********************************/
	/*Dynamic CSS*/
	/**********************************/
	var i;	
	if (window.globalHeaderTransparentActive && window.globalHeaderTransparentActive=='yes') {
		$('.header').css("background-color","transparent");
	}
	if (window.globalThreeDImageHoverActive && window.globalThreeDImageHoverActive=='yes') {
		
		for(i=0; i<window.globalThreeDImageId.length;i++)
		{				
			width=$("#"+window.globalThreeDImageId[i]+" a.gal-span span").width();
			$("#"+window.globalThreeDImageId[i]+" a.gal-span").css("left","calc(50% - "+(width/2)+"px)");
			$("#"+window.globalThreeDImageId[i]+" a.gal-span").css("width",width);
			
			$("#"+window.globalThreeDImageId[i]).hover(function() {
				$(this).css("background",$(this).data('hoverin')+" repeat scroll 0 0");
			},function() {
				if($(this).data('backtype')=='color')
				{
					$(this).css("background",$(this).data('hoverout')+" repeat scroll 0 0");
				}
				else{					
					$(this).css("background","url("+$(this).data('hoverout')+") no-repeat scroll 0 / cover");
				}
			});
		}
	}
	if (window.globalEventVideoHoverActive && window.globalEventVideoHoverActive=='yes') {
		
		for(i=0; i<window.globalEventVideoHoverId.length;i++)
		{
			width=$("#"+window.globalEventVideoHoverId[i]+" a.gal-span span").width();
			$("#"+window.globalEventVideoHoverId[i]+" a.gal-span").css("left","calc(50% - "+(width/2)+"px)");
			$("#"+window.globalEventVideoHoverId[i]+" a.gal-span").css("width",width);
			
			$("#"+window.globalEventVideoHoverId[i]).hover(function() {
				$(this).css("background",$(this).data('hoverin')+" repeat scroll 0 0");
			},function() {				
				if($(this).data('backtype')=='color')
				{
					$(this).css("background",$(this).data('hoverout')+" repeat scroll 0 0");
				}
				else{					
					$(this).css("background","url("+$(this).data('hoverout')+") no-repeat scroll 0 / cover");
				}
			});
		}
	}
	if (window.globalTabsActive && window.globalTabsActive=='yes') {
		for(i=0; i<window.globalTotalTabs.length;i++)
		{
			width = $(window).width();
			if(width>=600)
				$('#'+window.globalcbpFWTabsId[i]+' nav ul li').css("width","calc(100% /"+(window.globalTotalTabs[i])+")");
		}
	}
	if (window.globalSlidesActive && window.globalSlidesActive=='yes') {
		var homeSlides = jQuery(window.globalSlides);
		if(window.globalSliderSpeed=="off")
		homeSlides.superslides({hashchange: false});
		else
		homeSlides.superslides({hashchange: false,play:window.globalSliderSpeed});
	}
	if (window.globalNLFormActive && window.globalNLFormActive=='yes') {
		for(i=0; i<window.globalNLForm.length;i++)
		{
			new NLForm( document.getElementById( window.globalNLForm[i] ) );
		}
	}
	if (window.globalGridGalleryActive && window.globalGridGalleryActive=='yes') {
		for(i=0; i<window.globalGridGallery.length;i++)
		{
			new CBPGridGallery( document.getElementById( window.globalGridGallery[i] ) );
		}
	}
	if (window.globalcbpFWTabsActive && window.globalcbpFWTabsActive=='yes') {
		for(i=0; i<window.globalcbpFWTabs.length;i++)
		{
			new CBPFWTabs( document.getElementById( window.globalcbpFWTabs[i] ) );
		}
	}
	if (window.globalSpeakersSliderActive && window.globalSpeakersSliderActive=='yes') {
		for(i=0; i<window.globalSpeakersSlider.length;i++)
		{
			if(window.globalSpeakersSliderAutoplay[i]=='true')
			$(window.globalSpeakersSlider[i]).flexslider({ animation: "slide", directionNav: false, controlNav: true, touch: true, pauseOnHover: true });
			else
			$(window.globalSpeakersSlider[i]).flexslider({ animation: "slide", directionNav: false, controlNav: true, touch: true, pauseOnHover: true,slideshow: false });
		}
	}
	if (window.globalTriangleActive && window.globalTriangleActive=='yes') {
		$("body").append('<div class="animate-canvas"><canvas id="demo-canvas"></canvas></div>');
	}
	if (window.globalTriangleActive && window.globalTriangleActive=='yes') {
		$("body").append('<div class="animate-canvas"><canvas id="demo-canvas"></canvas></div>');
	}	
	if (window.globalYoutubeActive && window.globalYoutubeActive=='yes') {
		if(window.globalVideoAudio=='muted')
		{
			var options = { videoId:window.globalYoutubeMedia,repeat: true,mute:true };
		}
		else
		{
			var options = { videoId:window.globalYoutubeMedia,repeat: true,mute:false };
		}
		$(window.globalYoutubeId).tubular(options);
	}
	
	if (window.globalVimeoActive && window.globalVimeoActive=='yes') {		
		$(function(){
			$.okvideo({ source: window.globalVimeoMedia,
				volume: 0,
				loop: true,
				hd:true,
				adproof: true,
				annotations: false,
				onFinished: function() { console.log('finished') },
				unstarted: function() { console.log('unstarted') },
				onReady: function() { console.log('onready') },
				onPlay: function() { console.log('onplay') },
				onPause: function() { console.log('pause') },
				buffering: function() { console.log('buffering') },
				cued: function() { console.log('cued') },
			});
		});
	}
	/***********************************/
	/*Dynamic CSS*/
	/**********************************/
	/*******Smooth scroll***********/
	height=$(".navbar.navbar-default").height() - 1;
	smoothScroll.init({
		speed: 1000,
		easing: 'easeInOutCubic',
		offset: height,
		updateURL: false,
		callbackBefore: function ( toggle, anchor ) {},
		callbackAfter: function ( toggle, anchor ) {},
	});	
	$(window).scroll(function() {
		scroll = $(window).scrollTop();
		if (scroll) {
			$(".header-hide").addClass("scroll-header");
		} else {
			 $(".header-hide").removeClass("scroll-header");
		}
		$('.nav li a').blur();
	});	
	/*******Smooth scroll***********/
});

