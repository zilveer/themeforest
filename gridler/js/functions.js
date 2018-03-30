/*-----------------------------------------------------------------------------------

 	Functions JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Load Formlize JS
/*-----------------------------------------------------------------------------------*/

var FORMALIZE=function(a,b,c){var d="placeholder"in c.createElement("input"),e="autofocus"in c.createElement("input"),f=!!a.browser.msie&&parseInt(a.browser.version,10)===6,g=!!a.browser.msie&&parseInt(a.browser.version,10)===7;return{go:function(){for(var a in FORMALIZE.init)FORMALIZE.init[a]()},init:{full_input_size:function(){g&&a("textarea, input.input_full").length&&a("textarea, input.input_full").wrap('<span class="input_full_wrap"></span>')},ie6_skin_inputs:function(){if(f&&a("input, select, textarea").length){var b=/button|submit|reset/,c=/date|datetime|datetime-local|email|month|number|password|range|search|tel|text|time|url|week/;a("input").each(function(){var d=a(this);this.getAttribute("type").match(b)?(d.addClass("ie6_button"),this.disabled&&d.addClass("ie6_button_disabled")):this.getAttribute("type").match(c)&&(d.addClass("ie6_input"),this.disabled&&d.addClass("ie6_input_disabled"))}),a("textarea, select").each(function(){this.disabled&&a(this).addClass("ie6_input_disabled")})}},autofocus:function(){e||!a(":input[autofocus]").length||a(":input[autofocus]:visible:first").focus()},placeholder:function(){!d&&!!a(":input[placeholder]").length&&(FORMALIZE.misc.add_placeholder(),a(":input[placeholder]").each(function(){if(this.type!=="password"){var b=a(this),c=b.attr("placeholder");b.focus(function(){b.val()===c&&b.val("").removeClass("placeholder_text")}).blur(function(){FORMALIZE.misc.add_placeholder()}),b.closest("form").submit(function(){b.val()===c&&b.val("").removeClass("placeholder_text")}).bind("reset",function(){setTimeout(FORMALIZE.misc.add_placeholder,50)})}}))}},misc:{add_placeholder:function(){d||!a(":input[placeholder]").length||a(":input[placeholder]").each(function(){if(this.type!=="password"){var b=a(this),c=b.attr("placeholder");(!b.val()||b.val()===c)&&b.val(c).addClass("placeholder_text")}})}}}}(jQuery,this,this.document);jQuery(document).ready(function(){FORMALIZE.go()})

jQuery(document).ready(function() {
/*START*/
/*-----------------------------------------------------------------------------------*/
/*	Superfish Settings 
/*-----------------------------------------------------------------------------------*/

	if(jQuery().superfish) {
		jQuery( 'ul.nav').superfish({
		delay: 200,
		animation: {opacity:'show', height:'show'},
		speed: 'fast',
		autoArrows: false,
		dropShadows: false
	});
}

/*-----------------------------------------------------------------------------------*/
/*	Add first/last classes  
/*-----------------------------------------------------------------------------------*/
jQuery('ul.nav > li:first-child').addClass('first-item');
jQuery('ul.nav > li:last-child').addClass('last-item');
jQuery('ul.nav ul > li:first-child').addClass('first-item');
jQuery('ul.nav ul > li:last-child').addClass('last-item');

jQuery('.categories > li:last-child').addClass('last');	

/*-----------------------------------------------------------------------------------*/
/*	Button Shortcode Hover Animations
/*-----------------------------------------------------------------------------------*/
function element_hover(){
	jQuery('.button').hover(
		function() {
				jQuery(this).stop().animate({opacity:0.9},200);
			},
			function() {
				jQuery(this).stop().animate({opacity:1},200);
		});
}
jQuery(document).ready(function() {
	if(!jQuery.browser.msie){element_hover();}
	});


/*-----------------------------------------------------------------------------------*/
/*	Pretty Photo
/*-----------------------------------------------------------------------------------*/

function theme_lightbox() {
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
	animationSpeed:'fast',
	slideshow:5000,
	theme:'dark_rounded',
	show_title:false,
	overlay_gallery: false,
	social_tools: ''
});

}

if(jQuery().prettyPhoto) {
theme_lightbox(); 			
}
jQuery("a[rel^='prettyPhoto']").click(function(){
jQuery('.youtube-player').css('visibility','hidden');
});


/*-----------------------------------------------------------------------------------*/
/*	Image Overlay Effect
/*-----------------------------------------------------------------------------------*/
	
function theme_overlay() {
jQuery('.post-thumb a').hover( function () {
jQuery(this).find('.overlay').stop().animate({ opacity: 1 }, 200);
}, function () {
jQuery(this).find('.overlay').stop().animate({ opacity: 0 }, 200);
});
}
theme_overlay();

	 
/*-----------------------------------------------------------------------------------*/
/*	Scroll Window Up
/*-----------------------------------------------------------------------------------*/	

jQuery('.top').click(
	function (e) {
		jQuery('html, body').animate({scrollTop: '0px'}, 500);
	}
);

/*-----------------------------------------------------------------------------------*/
/*	jQuery Toggles
/*-----------------------------------------------------------------------------------*/	
//Hide (Collapse) the toggle containers on load
	jQuery(".toggle_content").hide(); 
	//Switch the "Open" and "Close" state per click
	jQuery("h3.toggle").toggle(function(){
		jQuery(this).addClass("active");
		}, function () {
		jQuery(this).removeClass("active");
	});
	//Slide up and down on click
	jQuery("h3.toggle").click(function(){
		jQuery(this).next(".toggle_content").slideToggle();
	});

/*-----------------------------------------------------------------------------------*/
/*	Masonry Setup
/*-----------------------------------------------------------------------------------*/	 

 jQuery('#masonry-wrap').masonry({
  itemSelector: '.masonry_item',
  gutterWidth: 0
});

/*END*/
});	