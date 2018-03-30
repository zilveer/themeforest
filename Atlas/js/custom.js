/*
	Easy plugin to get element index position
	Author: Peerapong Pulpipatnan
	http://themeforest.net/user/peerapong
*/

(function($) {

	$.fn.krioImageLoader = function(options) {
    	var opts = $.extend({}, $.fn.krioImageLoader.defaults, options);
		var imagesToLoad = $(this).find("img")
									.css({opacity: 0, visibility: "hidden"})
									.addClass("krioImageLoader");
		var imagesToLoadCount = imagesToLoad.size();

		var checkIfLoadedTimer = setInterval(function() {
			if(!imagesToLoadCount) {
				clearInterval(checkIfLoadedTimer);
				return;
			} else {
				imagesToLoad.filter(".krioImageLoader").each(function() {
					if(this.complete) {
						fadeImageIn(this);
						imagesToLoadCount--;
					}
				});
			}
		}, opts.loadedCheckEvery);

		var fadeImageIn = function(imageToLoad) {
			$(imageToLoad).css({visibility: "visible"})
							.animate({opacity: 1}, 
								opts.imageEnterDelay, 
								removeKrioImageClass(imageToLoad));
		};

		var removeKrioImageClass = function(imageToRemoveClass) {
			$(imageToRemoveClass).removeClass("krioImageLoader");
		};
	};

	$.fn.krioImageLoader.defaults = {
		loadedCheckEvery: 350,
		imageEnterDelay: 900
	};

})(jQuery);

var $j = jQuery.noConflict();

/* jquery.imagefit 
 *
 * Version 0.2 by Oliver Boermans <http://www.ollicle.com/eg/jquery/imagefit/>
 *
 * Extends jQuery <http://jquery.com>
 *
 */
(function($) {
	$.fn.imagefit = function(options) {
		var fit = {
			all : function(imgs){
				imgs.each(function(){
					fit.one(this);
					})
				},
			one : function(img){
				$(img)
					.width('100%').each(function()
					{
						$(this).height(Math.round(
							$(this).attr('startheight')*($(this).width()/$(this).attr('startwidth')))
						);
					})
				}
		};
		
		this.each(function(){
				var container = this;
				
				// store list of contained images (excluding those in tables)
				var imgs = $('img', container).not($("table img"));
				
				// store initial dimensions on each image 
				imgs.each(function(){
					$(this).attr('startwidth', $(this).width())
						.attr('startheight', $(this).height())
						.css('max-width', $(this).attr('startwidth')+"px");
				
					fit.one(this);
				});
				// Re-adjust when window width is changed
				$(window).bind('resize', function(){
					fit.all(imgs);
				});
			});
		return this;
	};
})(jQuery);


$j.fn.getIndex = function(){
	var $jp=$j(this).parent().children();
    return $jp.index(this);
}
 
jQuery.fn.extend({
  slideRight: function() {
    return this.each(function() {
    	jQuery(this).show();
    });
  },
  slideLeft: function() {
    return this.each(function() {
    	jQuery(this).hide();
    });
  },
  slideToggleWidth: function() {
    return this.each(function() {
      var el = jQuery(this);
      if (el.css('display') == 'none') {
        el.slideRight();
      } else {
        el.slideLeft();
      }
    });
  }
});

$j.fn.setNav = function(){
	$j('#main_menu li ul').css({display: 'none'});

	$j('#main_menu li').each(function()
	{	
		var $jsublist = $j(this).find('ul:first');
		
		$j(this).hover(function()
		{	
			$jsublist.css({opacity: 1});
			
			$jsublist.stop().css({overflow:'hidden', height:'auto', display:'none'}).fadeIn(200, function()
			{
				$j(this).css({overflow:'visible', height:'auto', display: 'block'});
			});	
		},
		function()
		{	
			$jsublist.stop().css({overflow:'hidden', height:'auto', display:'none'}).fadeOut(200, function()
			{
				$j(this).css({overflow:'hidden', display:'none'});
			});	
		});	
		
	});
	
	$j('#main_menu li').each(function()
	{
		
		$j(this).hover(function()
		{	
			$j(this).find('a:first').addClass('hover');
		},
		function()
		{	
			$j(this).find('a:first').removeClass('hover');
		});	
		
	});
	
	$j('#menu_wrapper .nav ul li ul').css({display: 'none'});

	$j('#menu_wrapper .nav ul li').each(function()
	{	
		
		var $jsublist = $j(this).find('ul:first');
		
		$j(this).hover(function()
		{	
			$jsublist.css({opacity: 1});
			
			$jsublist.stop().css({overflow:'hidden', height:'auto', display:'none'}).fadeIn(200, function()
			{
				$j(this).css({overflow:'visible', height:'auto', display: 'block'});
			});	
		},
		function()
		{	
			$jsublist.stop().css({overflow:'hidden', height:'auto', display:'none'}).fadeOut(200, function()
			{
				$j(this).css({overflow:'hidden', display:'none'});
			});	
		});	
		
	});
	
	$j('#menu_wrapper .nav ul li').each(function()
	{
		
		$j(this).hover(function()
		{	
			$j(this).find('a:first').addClass('hover');
		},
		function()
		{	
			$j(this).find('a:first').removeClass('hover');
		});	
		
	});
}

$j(document).ready(function(){ 

	$j(document).setNav();

	$j('.pp_gallery a').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	$j('.flickr li a').fancybox({ 
		padding: 0,
		overlayColor: '#'+$j('#skin_color').val(), 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	$j('a[rel=gallery]').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .8
	});
	
	$j('.img_frame').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		overlayOpacity: .8
	});
	
	$j('.lightbox_youtube').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .7
	});
	
	$j('.lightbox_vimeo').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .7
	});
	
	var photoItems = $j('#content_wrapper .inner .card').length;
	var scrollArea = parseInt($j('#gallery_width').val())+330;
	var scrollWidth = $j('#wrapper').width();
	
	$j('#content_wrapper').css({width: scrollWidth+'px'});

	
	$j("#content_wrapper .inner").css('width', scrollArea);
	$j("#content_wrapper").attr({scrollLeft: 0});					   
	
	$j("#content_wrapper").css({"overflow":"hidden"});
	
	$j("#move_next").click( 
    	function() {
    	    var speed = parseInt($j('#slider_speed').val());
		    var slider = $j('#content_slider');
		    var sliderCurrent = slider.slider("option", "value");
		    sliderCurrent += speed; // += and -= directions of scroling with MouseWheel
		    
		    if (sliderCurrent > slider.slider("option", "max")) sliderCurrent = slider.slider("option", "max");
		    else if (sliderCurrent < slider.slider("option", "min")) sliderCurrent = slider.slider("option", "min");
		    
		    slider.slider("value", sliderCurrent);
    	}
    );
    $j("#move_prev").click(
    	function() {
    	    var speed = parseInt($j('#slider_speed').val());
		    var slider = $j('#content_slider');
		    var sliderCurrent = slider.slider("option", "value");
		    sliderCurrent -= speed; // += and -= directions of scroling with MouseWheel
		    
		    if (sliderCurrent > slider.slider("option", "max")) sliderCurrent = slider.slider("option", "max");
		    else if (sliderCurrent < slider.slider("option", "min")) sliderCurrent = slider.slider("option", "min");
		    
		    slider.slider("value", sliderCurrent);
    	}
    );
	
	var auto_scroll = $j('#pp_gallery_auto_scroll').val();
	
	if(auto_scroll != 0)
	{
		$j("#move_next").mouseenter( 
    		function() {
    	    	timerId = setInterval(function() { 
    	    	
    	    		var speed = parseInt($j('#slider_speed').val());
					var slider = $j('#content_slider');
					var sliderCurrent = slider.slider("option", "value");
					sliderCurrent += speed; // += and -= directions of scroling with MouseWheel
					
					if (sliderCurrent > slider.slider("option", "max")) sliderCurrent = slider.slider("option", "max");
					else if (sliderCurrent < slider.slider("option", "min")) sliderCurrent = slider.slider("option", "min");
					
					slider.slider("value", sliderCurrent);
    	    	
    	    	}, 100);
    	    	
    	    	//$j(this).find('img').animate({ opacity: 1 }, 300);
    		}
    	);
    	$j("#move_next").mouseleave( 
    		function() { 
    			clearInterval(timerId); 
    		}
		);
		
		$j("#move_prev").mouseenter(
    		function() {
    	    	timerId = setInterval(function() { 
    	    	
    	    		var speed = parseInt($j('#slider_speed').val());
					var slider = $j('#content_slider');
					var sliderCurrent = slider.slider("option", "value");
					sliderCurrent -= speed; // += and -= directions of scroling with MouseWheel
					
					if (sliderCurrent > slider.slider("option", "max")) sliderCurrent = slider.slider("option", "max");
					else if (sliderCurrent < slider.slider("option", "min")) sliderCurrent = slider.slider("option", "min");
					
					slider.slider("value", sliderCurrent);
    	    	
    	    	}, 100);
    	    	
    	    	//$j(this).find('img').animate({ opacity: 1 }, 300);
    		}
    	);
    	$j("#move_prev").mouseleave(
    		function() { 
    			clearInterval(timerId); 
    		}
		);
	}
	
	Cufon.replace('h1');
	Cufon.replace('h2');
	Cufon.replace('h2.quote');
	Cufon.replace('h2.widgettitle');
	Cufon.replace('h3');
	Cufon.replace('h4');
	Cufon.replace('h5');
	Cufon.replace('h6');
	Cufon.replace('#searchform label');
	Cufon.replace('.dropcap1');
	Cufon.replace('.ui-accordion-header');
	Cufon.replace('.page_caption h1');
	Cufon.replace('.continue');
	
	$j('#content_slider_wrapper').fadeOut();
	$j('#move_next').fadeOut();
	$j('#move_prev').fadeOut();
 	
	var viewportHeight = $j(document).height();
	var viewportWidth = $j(document).width();
 	
 	$j(window).resize(function() {
 		var viewportHeight = $j(document).height();
		var viewportWidth = $j(document).width();
	});
	
	VideoJS.setupAllWhenReady({
      controlsBelow: false, // Display control bar below video instead of in front of
      controlsHiding: true, // Hide controls when mouse is not over the video
      defaultVolume: 0.85, // Will be overridden by user's last volume if available
      flashVersion: 9, // Required flash version for fallback
      linksHiding: true // Hide download links when video is supported
    });
    
    $j('.img_nofade').hover(function(){  
			$j(this).animate({opacity: .5}, 300);
 		}  
  		, function(){  
  			$j(this).animate({opacity: 1}, 300);
  		}  
  		
	);
	
	$j('input[title!=""]').hint();
	
	$j('textarea[title!=""]').hint();
	
	$j('.one_fourth.gallery4').hover(
		function(){
			var $jthis = $j(this);
			$jthis.children('a').children('img').stop().animate({
					'height':'185px',
					'top':'0px',
					'left':'0px'
				}, 400);
				
			$jthis.children('.shadow').fadeIn(800);
				
		},
		function(){
			var $jthis = $j(this);
			$jthis.children('a').children('img').stop().animate({
				'height':'200px',
				'top':'0px',
				'left':'0px'
				}, 400);
			$jthis.children('.shadow').fadeOut(200);
		}
	);
	
	$j('.one_fourth.gallery4').click(
		function(){
			$j(this).children('a').trigger('click');
		}
	);
	
	$j('.one_third.gallery3').hover(
		function(){
			var $jthis = $j(this);
			$jthis.children('a').children('img').stop().animate({
					'height':'250px',
					'top':'0px',
					'left':'0px'
				}, 400);
				
			$jthis.children('.shadow').fadeIn(800);
				
		},
		function(){
			var $jthis = $j(this);
			$jthis.children('a').children('img').stop().animate({
				'height':'260px',
				'top':'0px',
					'left':'0px'
				}, 400);
			$jthis.children('.shadow').fadeOut(200);
		}
	);
	
	$j('.one_third.gallery3').click(
		function(){
			$j(this).children('a').trigger('click');
		}
	);
	
	$j('.one_half.gallery2').hover(
		function(){
			var $jthis = $j(this);
			$jthis.children('a').children('img').stop().animate({
					'height':'330px',
					'top':'0px',
					'left':'0px'
				}, 400);
				
			$jthis.children('.shadow').fadeIn(800);
				
		},
		function(){
			var $jthis = $j(this);
			$jthis.children('a').children('img').stop().animate({
				'height':'340px',
				'top':'0px',
				'left':'0px'
				}, 400);
			$jthis.children('.shadow').fadeOut(200);
		}
	);
	
	$j('.one_half.gallery2').click(
		function(){
			$j(this).children('a').trigger('click');
		}
	);
	
	$j('.post_img').hover(
		function(){
			var $jthis = $j(this);
			$jthis.children('a').children('img').stop().animate({
					'height':'250px',
					'top':'0px',
					'left':'0px'
				}, 400);
				
			$jthis.children('.shadow').fadeIn(800);
				
		},
		function(){
			var $jthis = $j(this);
			$jthis.children('a').children('img').stop().animate({
				'height':'260px',
				'top':'0px',
				'left':'0px'
				}, 400);
			$jthis.children('.shadow').fadeOut(200);
		}
	);
	
	$j('.post_img').click(
		function(event){
			$j(this).children('a').trigger('click');
		}
	);
	
	if(BrowserDetect.browser != 'Explorer')
 	{
 		$j('#content_wrapper').krioImageLoader();
 	}

});
