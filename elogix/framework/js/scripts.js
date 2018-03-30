/* ----------------------------------------------------- */
/* Flex Slider */
/* ----------------------------------------------------- */


/* ----------------------------------------------------- */
/* jCarousel Lite */
/* ----------------------------------------------------- */

var sliderShowItems = $(".work-carousel ul li").length;
if(sliderShowItems > 3){
	sliderShowItems = 3;
}

if($(".work-carousel ul li").length > 0){

	$(".work-carousel").touchwipe({
     	wipeLeft: function() { $('.work-carousel-next').trigger("click"); },
     	wipeRight: function() { $('.work-carousel-prev').trigger("click"); },
	});

	$(function() {
		$(".work-carousel").jCarouselLite({
	        btnNext: ".work-carousel-next",
	        btnPrev: ".work-carousel-prev",
	        auto : 0,
	        speed: 400,
	        easing : 'easeOutSine',
	        circular: true,
	        visible : sliderShowItems,
	        scroll: 1
    	});
	});

}

/* ----------------------------------------------------- */
/* Document.ready */
/* ----------------------------------------------------- */

$(document).ready(function(){

	var footerHeight = $('#footerwrap').outerHeight();
	$('#footerwrap').css({height: footerHeight});
	
	$('#nav ul.nav').mobileMenu({
    	defaultText: 'Navigate to...',
    	className: 'select-menu',
    	subMenuDash: '&nbsp;&nbsp;&nbsp;&ndash;'
	});
	
	$("#nav ul.nav").superfish({
		delay:         140,
		animation:   {opacity:'show',height:'show'},
		speed:       200,
        autoArrows:  true,  
        dropShadows: false  
	}); 

	/* ----------------------------------------------------- */
	/* Accordion */

	var allPanels = $('.accordion > .inner').hide();
    
  	$('.accordion > .title > a').click(function() {
      $this = $(this);
      $target =  $this.parent().next();

      if(!$target.hasClass('active')){
         allPanels.slideUp(400, 'easeOutCirc');
         $target.slideDown(400, 'easeOutCirc');
         $this.parent().parent().find('.title').removeClass('active');
         $this.parent().addClass('active');
      }
      
    	return false;
  	});
  	
  	/* ----------------------------------------------------- */
  	/* Toggle */
	$(".toggle .title").toggle(function(){
		$(this).addClass("active").closest('.toggle').find('.inner').slideDown(400, 'easeOutCirc');
		}, function () {
		$(this).removeClass("active").closest('.toggle').find('.inner').slideUp(400, 'easeOutCirc');
	});
	
	/* ----------------------------------------------------- */
	/* Tabs */
	var tabContainers = $('div.tabs > div');
	tabContainers.hide().filter(':first').show();
			
	$('div.tabs ul.tabNavigation a').click(function () {
		tabContainers.hide();
		tabContainers.filter(this.hash).show();
		$('div.tabs ul.tabNavigation a').removeClass('active');
		$(this).addClass('active');
		return false;
	}).filter(':first').click();
	
	/* ----------------------------------------------------- */
  	/* Alert */
	$(".alert-message a").click(function(){
		$(this).parent().slideUp();
		return false;
	});
	
	/* ----------------------------------------------------- */
	/* Other Scripts */
	/* ----------------------------------------------------- */

	/* ----------------------------------------------------- */
	/* PrettyPhoto */
	
	$('a[href$=jpg], a[href$=JPG], a[href$=jpeg], a[href$=JPEG], a[href$=png], a[href$=gif], a[href$=bmp]:has(img), a[class^="prettyPhoto"]').prettyPhoto({
		opacity: 0.50,
		theme: 'light_square',
		show_title: false,
		horizontal_padding: 20,
		social_tools: false
	});

	/* ----------------------------------------------------- */
	/* Infobar */
	
	//alert( $.cookie('infobar_cooki') );
	
	if( $.cookie('infobar_cooki') == null && $("#infobar").hasClass('showit') ) {
		//alert('1');
		$("#infobar").css({'top' : '0px'});
		$("#header").css({paddingTop : '35px'});
		$("#infobar .openbtn").addClass('cursor');
	} else {
		//alert('2');
		$("#infobar").css({'top' : '-31px'});
		$("#header").css({paddingTop : '0px'});
		$("#infobar .openbtn").addClass('cursor');
	}
	
	
	if($.cookie('infobar_cooki') == 'closed') {
		//alert('closed');
		$("#infobar").css({'top' : '-31px'});
		$("#header").css({paddingTop : '0px'});
		$("#infobar .openbtn").addClass('cursor');
	};
	
	if($.cookie('infobar_cooki') == 'open') {
		//alert('open');
		$("#infobar").css({'top' : '0px'});
		$("#header").css({paddingTop : '35px'});
		$("#infobar .openbtn").addClass('cursor');
	};
	
	$("#infobar .openbtn").click(function(){
		//alert('hi');
		$("#infobar .openbtn").removeClass('cursor');
		$("#infobar").animate({'top' : '0px'}, 300);
		$("#header").animate({paddingTop : '35px'}, 300);
		$("#infobar").addClass('showit');
		$.cookie('infobar_cooki', 'open', { expires: 1, path: '/' });
	});
	
	$("#infobar .closebtn").click(function(){
			$("#infobar").animate({'top' : '-31px'}, 200);
			$("#header").animate({paddingTop : '0px'}, 200);
			$("#infobar .openbtn").addClass('cursor');
			$.cookie('infobar_cooki', 'closed', { expires: 1, path: '/' });
	});	
	
	/* ----------------------------------------------------- */
	/* General Animations */
	
	
	
	$(".post-thumb a").hover(function(){
		//$(this).animate({borderColor : '#ec7100'}, 300);
		$(this).find('img').stop().animate({opacity : '0.7'}, 300);
		$(this).append('<div class="zoom"></div>');
		$(this).find('.zoom').animate({opacity : '1', left : '0'}, 300);
	}, function(){
		//$(this).animate({borderColor : '#f5f5f5'}, 300);
		$(this).find('img').stop().animate({opacity : '1'}, 300);
		$(this).find('.zoom').animate({opacity : '0', left : '200px'}, 300 ,function(){ 
			$(this).remove(); 
		});
		$(this).find('.zoom').css({left: '-200px;'});
	});
	
	$(".work-item a, #latestwork .entry a").hover(function(){
		//$(this).animate({borderColor : '#ec7100'}, 300);
		$(this).find('img').stop().animate({opacity : '0.8'}, 300);
		$(this).append('<div class="zoom"></div>');
		$(this).find('.zoom').animate({opacity : '1', left : '0'}, 300);
	}, function(){
		//$(this).animate({borderColor : '#f5f5f5'}, 300);
		$(this).find('img').stop().animate({opacity : '1'}, 300);
		$(this).find('.zoom').animate({opacity : '0', left : '215px'}, 300 ,function(){ 
			$(this).remove(); 
		});
		$(this).find('.zoom').css({left: '-215px;'});
	});
	
	
	/* ----------------------------------------------------- */
	/* Sticky Footer */
	
	$(window).load(function () {
		$("#footerwrap").stickyFooter();
	});
	
});

/* ----------------------------------------------------- */
/* Plugins */
/* ----------------------------------------------------- */

/* Smooth Scroll to Top */
$('#back-to-top a[href*=#]').click(function() {
 
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
	&& location.hostname == this.hostname) {
 
		var $target = $(this.hash);
	 
		$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
	 
		if ($target.length) {
			var targetOffset = $target.offset().top;
			$('html,body').animate({scrollTop: targetOffset}, 600);
			return false;
		}
	}
});

/*!
 * jQuery Cookie Plugin
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function($) {
    $.cookie = function(key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function(s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);


/* ----------------------------------------------------- */
/* Sticky Footer Plugin */
/* ----------------------------------------------------- */

  (function($){
    var footer;
  
    $.fn.extend({
      stickyFooter: function(options) {
        footer = this;
        
        positionFooter();
  
        $(window)
          .scroll(positionFooter)
          .resize(positionFooter);
  
        function positionFooter() {
          var docHeight = $(document.body).height() - $("#sticky-footer-push").height();
          if(docHeight < $(window).height()){
            var diff = $(window).height() - docHeight;
            if (!$("#sticky-footer-push").length > 0) {
              $(footer).before('<div id="sticky-footer-push"></div>');
            }
            $("#sticky-footer-push").height(diff);
          }
        }
      }
    });
  })(jQuery);


/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */