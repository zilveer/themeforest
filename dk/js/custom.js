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
	
	if($j('#pp_enable_hide_menu').attr('value') != '')
	{
		$j('#custom_logo').click(
			function(event){
				$j('#logo_arrow_right').toggle();
				$j('#logo_arrow_left').toggle();
				$j('.nav, .subnav').fadeToggle(600);
				return false;
			}
		);
	}
	
	var calScreenHeight = $j(window).height()-108;
	$j('#page_content_wrapper').css('top', calScreenHeight+'px');
	
	setTimeout(function() {
		$j('#menu_wrapper').fadeIn();
		$j('.social_wrapper').fadeIn();
		$j('#tray-button').fadeIn();
		$j('#jp_interface_1').fadeIn();
		$j('#controls').fadeIn();
		$j('#page_content_wrapper').fadeIn();
		$j('#page_maximize').trigger('click');
	}, 1000);
	
	$j('#page_minimize').click(function(){
		var calScreenHeight = $j(window).height()-120;
		
		$j(this).css('display', 'none');
		$j('#page_maximize').css('display', 'block');
		$j('#page_content_wrapper').css('position', 'fixed');
		$j('#page_content_wrapper').animate({ top: calScreenHeight+'px' }, 600);
	});
	
	$j('#page_maximize').click(function(){
		var calScreenHeight = $j(window).height()-120;
		
		$j(this).css('display', 'none');
		$j('#page_minimize').css('display', 'block');
		$j('#page_content_wrapper').animate({ 'top': '80px' }, 400, function(){
			$j('#page_content_wrapper').css('position', 'static');
		});
	});
	
	$j('#option_btn').click(
    	function() {
    		if($j('#option_wrapper').css('right') != '0px')
    		{
 				$j('#option_wrapper').animate({"right": "0px"}, { duration: 300 });
	 			$j(this).animate({"right": "240px"}, { duration: 300 });
	 		}
	 		else
	 		{
	 			$j('#option_wrapper').animate({"right": "-245px"}, { duration: 300 });
    			$j('#option_btn').animate({"right": "0px"}, { duration: 300 });
	 		}
    	}
    );
    
    $j('#pp_active_skin_color_preview').ColorPicker({
		color: $j('#pp_active_skin_color').val(),
		onShow: function (colpkr) {
			$j(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) { 
			$j(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$j('#pp_active_skin_color_preview').css('backgroundColor', '#' + hex);
			$j('.nav li.current-menu-item > a, .nav li > a:hover, .nav li > a.hover, .nav li > a:active, .nav li.current-menu-parent > a, .nav li.current-menu-item > a, .nav li > a:hover, .nav li > a.hover, .nav li > a:active, .nav li.current-menu-parent > a').css('border-bottom-color', '#' + hex);
			$j('#progress-bar').css('backgroundColor', '#' + hex);
		}
	});
	
	$j('#pp_logo_bg_color_preview').ColorPicker({
		color: $j('#pp_logo_bg_color').val(),
		onShow: function (colpkr) {
			$j(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) { 
			$j(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$j('#pp_logo_bg_color_preview').css('backgroundColor', '#' + hex);
			$j('.logo_wrapper, .nav, .subnav, .nav li ul, .nav li ul li ul').css('backgroundColor', '#' + hex);
		}
	});
	
	$j('#pp_control_bg_color_preview').ColorPicker({
		color: $j('#pp_control_bg_color').val(),
		onShow: function (colpkr) {
			$j(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) { 
			$j(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$j('#pp_control_bg_color_preview').css('backgroundColor', '#' + hex);
			$j('#controls, #thumb-tray').css('backgroundColor', '#' + hex);
		}
	});
	
	$j("#pp_font").change(function(){
	    $j("#pp_font_family").attr('value', $j("#pp_font option:selected").attr('data-family'));
	
	    var ppCufonFont = 'http://fonts.googleapis.com/css?family='+$j(this).attr('value');
	    $j('#google_fonts-css').attr('href', ppCufonFont);
	    
	    if($j("#pp_font option:selected").attr('data-family') != '')
	    {
	    	$j('h1, h2, h3, h4, h5, h6, .nav li a, #gallery_title, #gallery_desc').css('font-family', '"'+$j("#pp_font option:selected").attr('data-family')+'"');
	    }
	    else
	    {
	    	$j('h1, h2, h3, h4, h5, h6, .nav li a, #gallery_title, #gallery_desc').css('font-family', 'Gnuolane');
	    }
	});	
	
});
