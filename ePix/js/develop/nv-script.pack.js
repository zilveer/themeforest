
/* Themeva Javascript Combination File
---------------------------------------------*/

(function($) {
	
	"use strict";

	/*
	* hoverFlow - A Solution to Animation Queue Buildup in jQuery
	* Version 1.00
	*
	* Copyright (c) 2009 Ralf Stoltze, http://www.2meter3.de/code/hoverFlow/
	* Dual-licensed under the MIT and GPL licenses.
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
	*/

	
	$.fn.hoverFlow = function(type, prop, speed, easing, callback) {
		// only allow hover events
		if ($.inArray(type, ['mouseover', 'mouseenter', 'mouseout', 'mouseleave']) == -1) {
			return this;
		}
	
		// build animation options object from arguments
		// based on internal speed function from jQuery core
		var opt = typeof speed === 'object' ? speed : {
			complete: callback || !callback && easing || $.isFunction(speed) && speed,
			duration: speed,
			easing: callback && easing || easing && !$.isFunction(easing) && easing
		};
		
		// run immediately
		opt.queue = false;
			
		// wrap original callback and add dequeue
		var origCallback = opt.complete;
		opt.complete = function() {
			// execute next function in queue
			$(this).dequeue();
			// execute original callback
			if ($.isFunction(origCallback)) {
				origCallback.call(this);
			}
		};
		
		// keep the chain intact
		return this.each(function() {
			var $this = $(this);
		
			// set flag when mouse is over element
			if (type == 'mouseover' || type == 'mouseenter') {
				$this.data('jQuery.hoverFlow', true);
			} else {
				$this.removeData('jQuery.hoverFlow');
			}
			
			// enqueue function
			$this.queue(function() {				
				// check mouse position at runtime
				var condition = (type == 'mouseover' || type == 'mouseenter') ?
					// read: true if mouse is over element
					$this.data('jQuery.hoverFlow') !== undefined :
					// read: true if mouse is _not_ over element
					$this.data('jQuery.hoverFlow') === undefined;
					
				// only execute animation if condition is met, which is:
				// - only run mouseover animation if mouse _is_ currently over the element
				// - only run mouseout animation if the mouse is currently _not_ over the element
				if(condition) {
					$this.animate(prop, opt);
				// else, clear queue, since there's nothing more to do
				} else {
					$this.queue([]);
				}
			});

		});
	};


/* :: 	Detect CSS3 Transition Support								      
---------------------------------------------*/

	$.support.transition = (function(){
		var thisBody = document.body || document.documentElement,
			thisStyle = thisBody.style,
			support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined;
		return support;
	})();
		
	if( $.support.transition === false )
	{
		$(window).load(function() {
			$( 'body' ).addClass('non_CSS3');
		});
	}


/* :: 	Preload Images											      
---------------------------------------------*/

	
	$.fn.preloadImages = function(options,f) {
	
		if(!$.browser.msie) {
			
			var defaults = {
			showSpeed: 800,
			easing: 'easeOutQuad'
			};
		
			var options = $.extend(defaults, options);
		
			return this.each(function(){
			var container = $(this);
			var image = container.find('img').not('.hovervid img,.hoverimg img');
		
			$(image).css({ "visibility": "hidden", "opacity": "0" });
			$(image).bind('load error', function(){
				$(this).css({ "visibility": "visible" }).animate({ opacity:"1" }, {duration:options.showSpeed, easing:options.easing}).closest(container).removeClass('preload');
			}).each(function(){
					if(this.complete || ($.browser.msie && parseInt($.browser.version) == 6)) { $(this).trigger('load'); }
			});
			});
		
		}
		
	};
	
	function rowFullHeight()
	{
		var	window_height =  $(window).innerHeight(),
			window_width =  $(window).innerWidth();
		
		$('.full-row-height').each(function(i)
		{	
			if( $(this).height() >= window_height )
			{
				$(this).css({'min-height':window_height});			
			}
			else
			{
				$(this).css({'min-height':window_height,'height':window_height});
			}
		});
		
		if( $('#header-wrap').length && ! $('#header-wrap').hasClass('collapse-menu') && ! $('#primary-wrapper').hasClass('left-layout') && window_width > 768 )
		{
			$('#content .entry .row.full-row-height:first-child').css({'min-height':window_height - $('#header-wrap').height(),'height':window_height - $('#header-wrap').height() });
		}
	};		

	function floatingHeader()
	{
		if( $('#primary-wrapper').hasClass('header_float') && $('#primary-wrapper').hasClass('horizontal-layout') ) 
		{
			var headerFloatHeight = 0,
				introTextheight = 0,
				subHeaderHeight = 0,
				curRowPadding = 0,
				header_width = $('#header').outerWidth(),
				browser_width = $(window).width(),
				offset = ( browser_width - header_width ) / 2;
			
			if( $('#header-wrap').length )
			{
				headerFloatHeight	= $('#header-wrap').outerHeight(true);
			}

			if( $('.sub-header').length )
			{
				$('.sub-header').css( 'top', headerFloatHeight );
				headerFloatHeight	= headerFloatHeight + $('.sub-header').outerHeight(true);
			}		

			if( $('.intro-wrap').length )
			{
				$('.intro-wrap').css( 'top', headerFloatHeight );
				headerFloatHeight	= headerFloatHeight + $('.intro-wrap').outerHeight(true);
				if( browser_width > 768 )
				{					
					$('.intro-wrap').offset({ left: offset });	
				}
				else
				{
					$('.intro-wrap').offset({ left: 20 });	
				}
			}			
			
			$('#content .entry > .wpb_row.row:first-child .vc_column_container:first-child').css('padding-top', headerFloatHeight + 20 );
		}
	};				

	function dockIconsPosition()
	{
		var browser_width = $(window).width(),
			dock_panel = $('.dock-panel-wrap');
			
		if( $('#primary-wrapper').hasClass('top-lr') || $('#primary-wrapper').hasClass('top-rl') && $('.dock-panel-wrap').length )
		{
			if( browser_width >= 1025 )
			{	
				if( $('#primary-wrapper').hasClass('top-rl') )
				{
					$( dock_panel ).prependTo("#header .header-inner");
				}
				else
				{
					$( dock_panel ).insertAfter("#header #nv-tabs");
				}
			}	
			else if(  browser_width < 1025  )
			{
				$( dock_panel ).prependTo("#header");
			}			
		}		
	}

	function themevaAnchorScroll( target, anchor_name )
	{
		var	target = $( target ),
			header_height = $('#header').height(),
			window_width = $(window).width();
					
		// If starting position is the top, remove pixels
		if( $(document).scrollTop() == 0 )
		{
			header_height = header_height - 22;
		}
		
		if( $('.sticky-wrapper').length )
		{
			header_height = 59;
		}
		
		if( window_width <= 768 || $('#primary-wrapper').hasClass('left-layout') )
		{
			header_height = 0;
		}
				
		target = target.length ? target : $('[name=' + anchor_name +']');

		if (target.length)
		{
			$('html,body').animate({
			scrollTop: target.offset().top - header_height
			}, 1000);
			return false;
		}
		else
		{
			$('.row.link_anchor').each(function(index, element) {
				if( $(this).attr('data-anchor-link') == anchor_name )
				{
					$('html,body').animate({
					scrollTop: $(this).offset().top - header_height
					}, 1000);
					return false;							
				}
			});
		}
	}		

/* :: Themeva functions
---------------------------------------------*/

jQuery(document).ready( function($) {
	
	"use strict"

	dockIconsPosition();
	floatingHeader();		
		
	$('a[href^="#"]:not([href="#"])').not('.ui-tabs-nav a, a.vc_carousel-control,.vc_tta-panel-heading a,.vc_tta-tab a').on( "click", function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname)
		{
			var target = $(this.hash),
				anchor_name = this.hash.slice(1);		
					
			themevaAnchorScroll( target, anchor_name );
		}
	});	
					
	
	if(!$.browser.msie)
	{
		$('.container .gridimg-wrap, .custom-layer .fullimage,.custom-layer.fullslider .panel').not('.container.videotype .gridimg-wrap, .reflection .gridimg-wrap, .shadowreflection .gridimg-wrap').addClass('preload');	
	}
	
	$('.preload').preloadImages();
	
	
	/* :: Accordion Icon
	---------------------------------------------*/
	
	$('.ui-accordion-header').prepend('<i class="fa fa-plus"></i>');

	/* :: Retina Logo
	---------------------------------------------*/


	if( NV_SCRIPT.branding_2x !='' || NV_SCRIPT.branding_sec_2x !='' )
	{
		var retina = window.devicePixelRatio > 1 ? true : false;

		if( retina )
		{
			// Change Primary SRC
			$('#header-logo img.primary').attr('src', NV_SCRIPT.branding_2x );
			
			// Set Primary Width / Height
			if( NV_SCRIPT.branding_2x_dimensions !='' )
			{
				var dim = NV_SCRIPT.branding_2x_dimensions.split('x');
				$('#header-logo img.primary').attr('width', dim[0] ).css('width',dim[0] +'px');
				$('#header-logo img.primary').attr('height', dim[1] ).css('height', dim[1] +'px');
			}
			
			// Change Secondary SRC
			$('#header-logo img.secondary').attr('src', NV_SCRIPT.branding_sec_2x );

			// Set Secondary Width / Height
			if( NV_SCRIPT.branding_sec_2x_dimensions !='' )
			{
				var dim = NV_SCRIPT.branding_sec_2x_dimensions.split('x');
				$('#header-logo img.secondary').attr('width', dim[0] ).css('width',dim[0] +'px');
				$('#header-logo img.secondary').attr('height', dim[1] ).css('height', dim[1] +'px');
			}			
		}
	}
	

	/* :: Header Search											      
	---------------------------------------------*/
	
	$('#panelsearchsubmit').click(function()
	{
		if( $("#panelsearchform").hasClass("disabled") )
		{
			$( "#panelsearchform" ).switchClass( "disabled","active");
		} 
		else if( $("#panelsearchform").hasClass("active") )
		{
			if($("#panelsearchform #drops").val()!='')
			{
				$("#panelsearchform").submit();
			}
			else
			{
				$( "#panelsearchform" ).switchClass( "active", "disabled");		
			}
		}
	});

	
	/* :: Navigation												      
	---------------------------------------------*/
	
	$('#nv-tabs ul li a').attr('aria-haspopup','true');

	$('#nv-tabs ul.sub-menu,#nv-tabs ul.children').parent().prepend('<span class="dropmenu-icon"><i class="fa fa-angle-down fa-lg"></i></span>');
	$('#nv-tabs ul li.hasdropmenu').not('#nv-tabs ul li ul li.hasdropmenu, #nv-tabs #megaMenu ul li.hasdropmenu').find('.dropmenu-icon').delay(500).animate({ opacity:1 });

	
	$('#nv-tabs ul li').not('#nv-tabs #megaMenu ul li, #nv-tabs ul li.extended-menu ul li,#nv-tabs ul li .dropmenu-icon').hover(
		function(e)
		{			
			var browser_width = $(window).width();
			
			
			
			if( $.browser.msie && $.browser.version < 8 )
			{
				$(this).find('ul:first').css('display','none').delay(400).hoverFlow(e.type,
				{ 
					height: "show"
				}, 400, "easeOutCubic");
			}
			else
			{
				if( $('#primary-wrapper').hasClass('horizontal-layout')  && browser_width > 1024 )
				{			
					$(this).find('ul:first').css('visibility','visible').hoverFlow(e.type,
					{ 
						opacity:1
					}, 400, "easeOutCubic");		
				}
				else
				{
					$(this).find('ul:first').delay(400).hoverFlow(e.type,
					{ 
						height: "show",
						opacity:1
					}, 400, "easeOutCubic");							
				}
			}
		}, 
		function(e)
		{
			var browser_width = $(window).width();
			
			if( $.browser.msie && $.browser.version < 8 )
			{
				$(this).find('ul:first').css('display','block').delay(600).hoverFlow(e.type,
				{ 
					height: "hide"
				}, 250, "easeInCubic");				
			}
			else
			{
				if( $('#primary-wrapper').hasClass('horizontal-layout') && browser_width > 1024 )
				{					
					$(this).find('ul:first').delay(100).hoverFlow(e.type,
					{ 
						opacity:0 
					}, 150, "easeOutCubic", function() 
					{
						$(this).css('visibility','hidden');
					});	
				}
				else
				{
					$(this).find('ul:first').delay(600).hoverFlow(e.type,
					{ 
						height: "hide",
						opacity:0 
					}, 900, "easeInOutCubic");						
				}
			}
		}
	);

	
	
/* :: Add target blank										      
---------------------------------------------*/

	$('.target_blank a').each(function()
		{
			$(this).click(
				function(event)
				{
					event.preventDefault();
			   		event.stopPropagation();
			   		window.open(this.href, '_blank');
				}
		   );
		}
	);


/* :: Pricing Table Content Even List Items 							      
---------------------------------------------*/

$('.nv-pricing-table .nv-pricing-content').each(function(){

	$(this).find("li:even").addClass("even");

});

/* :: Back to top Animation									      
---------------------------------------------*/

	$('.hozbreak-top a,.autototop i').click(
		function()
		{
			 $('html, body').animate({ scrollTop: '0px' }, 400,"easeInOutCubic");
			 return false;
		}
	);
	
	$(function () { // run this code on page load (AKA DOM load)
	 
		/* set variables locally for increased performance*/
		var scroll_timer;
		var displayed = false;
		var $message = $('div.autototop a');
		var $window = $(window);
		var top = $(document.body).children(0).position().top;
	 
		/* react to scroll event on window*/
		$window.scroll(
			function ()
			{
				window.clearTimeout(scroll_timer);
				scroll_timer = window.setTimeout(function () { // use a timer for performance
					if($window.scrollTop() <= top) // hide if at the top of the page
					{
						displayed = false;
						$message.removeClass('show');
					}
					else if(displayed == false) // show if scrolling down
					{
						displayed = true;
						$message.stop(true, true).addClass('show').click(function () { $message.removeClass('show'); });
					}
				}, 100,"easeInOutCubic");
			}
		);
	});

/* :: 	Collapse Menu Trigger											      
---------------------------------------------*/

	$(".collapse-menu-trigger-wrap").click(function () 
	{
		var browser_width = $(window).width();
		
		if( ( browser_width <= 768 || $('#primary-wrapper').hasClass('horizontal-layout') ) && !$( ".collapse-menu-trigger-wrap" ).hasClass( 'active' ) )
		{
			$('html, body').animate({ scrollTop: '0px' }, 400,"easeInOutCubic");
		}
		
		$(this).toggleClass('active');
		
		if( $('#primary-wrapper').hasClass('collapse-menu-mobile') )
		{
			$('#primary-wrapper #header-wrap').toggleClass('collapse-menu-mobile');
		}
		else if ( $('#primary-wrapper').hasClass('collapse-menu') )
		{
			$('#primary-wrapper #header-wrap').toggleClass('collapse-menu');
		}
	
	});

/* :: 	Header Infobar											      
---------------------------------------------*/

	$("span.infobar-close a").click(function () {
		$("div.header-infobar").animate({height:0,opacity:0});
	});		


/* :: 	Social Icons Animate									      
---------------------------------------------*/
	
	// Show Social Icons
	$("a.socialinit").on("click", function(event)
	{		
		if( $(this).hasClass('socialhide') )
		{
			$("div.socialicons").not('div.socialicons.display,div.socialicons.init').fadeOut('slow');
		}
		else
		{
			$("div.socialicons").not('div.socialicons.display,div.socialicons.init').fadeIn('slow');
		}
		
		$(this).toggleClass('socialhide');
		
		return false;
		e.preventDefault(); // same thing as above
	});	
	
	
	// Global Hide Dock Elements
	$('#primary-wrapper').bind('click', function(event)
	{

		if ( !$(event.target).parents().is("#header-wrap") && !$(event.target).parents().is(".collapse-menu-trigger-wrap") )
		{		
			if( $( ".collapse-menu-trigger-wrap" ).hasClass( 'active' ) && !$( "#header-wrap" ).hasClass( 'collapse-menu' ) )
			{
				$('.collapse-menu-trigger-wrap').toggleClass('active');
				$('#primary-wrapper #header-wrap').toggleClass('collapse-menu');			
			}
		}
		
		if ( !$(event.target).parents().is(".dock-tab") && !$(event.target).parents().is("#nv-tabs") )
		{
			$( ".dock-tab-wrapper,#nv-tabs" ).removeClass( 'show', 200, function()
			{
				if( !$( ".dock-tab-wrapper" ).hasClass( 'show' ) && !$( "#nv-tabs" ).hasClass( 'show' ) )
				{
					$('#header-wrap').removeClass( 'active', 200 );	
				}
			});	
		}
	});	

	// Show / Hide Dock Elements
	$('.dock-tab-trigger').bind('click', function(event)
	{		
		event.preventDefault(); // same thing as above
		
		var element = $(this).attr('data-show-dock'),
			position = $(this).position().left,
			window_width = $(window).width();			
		
		$( ".dock-tab-wrapper,#nv-tabs" ).not( ".dock-tab-wrapper."+ element ).removeClass( 'show' ,200 );
		
		if( window_width > 768 )
		{	
			if( $('#primary-wrapper').hasClass('top-lr') )
			{
				$( ".dock-tab-wrapper."+ element ).css({'left' : position , 'margin-left' : - $( ".dock-tab-wrapper."+ element ).width() });
			}
			else
			{
				$( ".dock-tab-wrapper."+ element ).css('left', position + 20 );			
			}
		}
		else
		{
			$( ".dock-tab-wrapper."+ element ).css({'left' : '50%' , 'margin-left' : '-125px' });
		}

		
		$( ".dock-tab-wrapper."+ element ).toggleClass( 'show', 200, function() 
		{
			// Prevent Auto-hide
			if( !$( ".dock-tab-wrapper."+ element ).hasClass('show') && !$( "#nv-tabs" ).hasClass('show') )
			{
				$('#header-wrap').removeClass( 'active', 200 );
			}
			else
			{
				$('#header-wrap').addClass( 'active', 500 );
			}	
			
		});
	});

	$(".dock-menu-trigger").click(function()
	{
		$( ".dock-tab-wrapper" ).removeClass( 'show', 200 );
		
		// Hide / Show Menu
		$( "#nv-tabs" ).toggleClass( 'show', 500, function()
		{
			// Prevent Auto-hide
			if( !$( ".dock-tab-wrapper" ).hasClass('show') && !$( "#nv-tabs" ).hasClass('show') )
			{
				$('#header-wrap').removeClass( 'active', 200 );
			}
			else
			{
				$('#header-wrap').addClass( 'active', 500 );
			}
		});
	});

	$('#searchsubmit,#panelsearchsubmit').hover(function () {
		if( $.browser.msie && $.browser.version < 9 ) {
			//
		} else {
			$(this).animate({opacity:0.6},100,'easeOutQuad');
		}
	});

	$('#searchsubmit,#panelsearchsubmit').mouseout(function () {
		
		if( $.browser.msie && $.browser.version < 9 ) {
			//
		} else {		
			$(this).animate({opacity:1},170,'easeOutQuad');
		}
	});		

     
    $('#searchform').submit(function(e) { // run the submit function, pin an event to it
        var s = $( this ).find("#s"); // find the #s, which is the search input id
        if (!s.val()) { // if s has no value, proceed
            e.preventDefault(); // prevent the default submission
 			
            $('#s').focus(); // focus on the search input
        }
    });

    $('#panelsearchform').submit(function(e) { // run the submit function, pin an event to it
        var s = $( this ).find("#drops"); // find the #s, which is the search input id
        if (!s.val()) { // if s has no value, proceed
            e.preventDefault(); // prevent the default submission
 			
            $('#drops').focus(); // focus on the search input
        }
    });	



/* :: 	Gallery Image Hover 									      
---------------------------------------------*/
		
	$(document).on({
		mouseenter: function ()
		{
			if( $.support.transition === false )
			{
				$(this).find('a.action-icons i').animate({opacity:1}, 500, 'easeOutSine' );
			}
			else
			{
				$(this).find('a.action-icons i').addClass('display');
			}
		},
		mouseleave: function ()
		{
			if( $.support.transition === false )
			{
				$(this).find('a.action-icons i').animate({opacity:0}, 500, 'easeOutSine' );
			}
			else
			{			
				$(this).find('a.action-icons i').removeClass('display');
			}
		}
	},'.gridimg-wrap,.panel .container,.carousel .item');


/* :: 	Gallery Captions NON CSS3 									      
---------------------------------------------*/

	if( $.support.transition === false )
	{
		$(document).on({
			mouseenter: function ()
			{		
				$(this).find('.caption-wrap').animate({right:0}, 700, 'easeOutSine' );
			}, 
			mouseleave: function ()
			{
				$(this).find('.caption-wrap').animate({right:'-100%'}, 700, 'easeOutSine' );
			}
		},'.gridimg-wrap,.item');
	}


/* :: 	Gallery Navigation Hover										  
---------------------------------------------*/
	
	$('.gallery-wrap').hover(
		function()
		{
			$(this).find('.slidernav-left,.slidernav-right,.slidernav-pause').fadeTo(500,1);	
		},
		function()
		{
			$(this).find('.slidernav-left,.slidernav-right,.slidernav-pause').fadeTo(200,0);	
		}
	);


/* :: 	Contact Form										      	  
---------------------------------------------*/

	$('form#contactForm').submit(function() {
		$('form#contactForm .error').remove();
		var hasError = false;
		$('.requiredField').each(function() {
			if($.trim($(this).val()) == '') {
				var labelText = $(this).prev('label').text();
				$(this).parent().append('<span class="error">You forgot to enter your '+labelText+'.</span>');
				hasError = true;
			} else if($(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test($.trim($(this).val()))) {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">You entered an invalid '+labelText+'.</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			var formInput = $(this).serialize();
			$.post($(this).attr('action'),formInput, function(data){
				$('form#contactForm').slideUp("fast", function() {				   
					$(this).before('<p class="thanks"><strong>Thanks!</strong> Your email was successfully sent. I check my email all the time, so I should be in touch soon.</p>');
				});
			});
		}
		
		return false;
		
	});


/* :: 	Tabs												      	  
---------------------------------------------*/

	$('.nv-tabs').each(
		function(index)
		{
			$(this).tabs({ fx: { opacity:'toggle', duration:200 }  });
		}
	);

/* :: 	Reveal Content 										      	  
---------------------------------------------*/

	$("h4.reveal").click(function(e)
	{
		if ( $(this).hasClass('ui-state-active') )
		{
			$(this).removeClass('ui-state-active').next().slideUp(500);
		}
		else
		{
			$(this).addClass('ui-state-active').next().slideDown(500);
		}
	});
	
});

	$(window).load(function()
	{
		dockIconsPosition();
		rowFullHeight();		
		
		var	dock_height = $('.dock-panel-wrap').height() + 70;
		$('.menu-sidebar-panel').css('padding-bottom',dock_height);

		$("body").addClass("loaded");

		$('.columns.tva-animate-in').not('.columns.tva-animate-in.loaded').each(function(i)
		{
			var column = $(this);
			setTimeout(function() {
				column.addClass('loaded');
			}, 200*i);
		});		

		if( window.location.hash )
		{
			var anchor_name	= window.location.hash.substring(1),
				target 			= window.location.hash;
					
			themevaAnchorScroll( target, anchor_name );
		}		
		
	});	

	/* Temp IE Fix */

	jQuery(window).load(function() {
		$('.vc_video-bg').find('iframe').each(function() {
			var url = $(this).attr("src");
			if ($(this).attr("src").indexOf("?") > 0) {
				$(this).attr({
					"src" : url + "&wmode=transparent",
					"wmode" : "opaque"
				});
			}
			else {
				$(this).attr({
					"src" : url + "?wmode=transparent",
					"wmode" : "opaque"
				});
			}
		});
	});		
	
	$(window).resize(function()
	{
		dockIconsPosition();
		rowFullHeight();
		floatingHeader();
	});	

	$(window).bind('beforeunload', function(){
		$("body").removeClass("loaded");
	});		

})(jQuery);