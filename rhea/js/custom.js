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
	
	$j( 'ul#main_menu > li:has( ul li.current-menu-item )' ).each(function()
	{	
     	$j(this).find('ul.sub-menu').css({overflow:'visible', height:'auto', display: 'block'});
	});
	
	$j('ul#main_menu > li:has( ul.sub-menu )').click(function()
	{
		var $jsublist = jQuery(this).find('ul:first');
		$jsublist.slideToggle('fast');
		
		return false;
	});
	
	$j('ul#main_menu > li > ul.sub-menu li ').click(function()
	{
		var subURL = $j(this).find('a:first').attr('href');
		location.href=subURL;
		return true;
	});
	
	$j('#menu_wrapper .nav ul li ul').css({display: 'none'});

	$j('#menu_wrapper .nav ul > li:has( ul li.current-menu-item )' ).each(function()
	{	
     	$j(this).find('ul.sub-menu').css({overflow:'visible', height:'auto', display: 'block'});
	});
	
	$j('#menu_wrapper .nav ul li:has( ul.sub-menu )').click(function()
	{
		var $jsublist = jQuery(this).find('ul:first');
		$jsublist.slideToggle('fast');
		
		return false;
	});
	
	$j('#menu_wrapper .nav ul > li > ul.sub-menu li ').click(function()
	{
		var subURL = $j(this).find('a:first').attr('href');
		location.href=subURL;
		return true;
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
			$j(this).children('.shadow').fadeIn(800);
			$j(this).find('.one_fourth_img').animate({
				'opacity':'0.5'
			}, 400);
				
		},
		function(){
			$j(this).children('.shadow').hide();
			$j(this).find('.one_fourth_img').animate({
				'opacity':'1'
			}, 100);
		}
	);
	
	$j('.one_fourth.gallery4').click(
		function(){
			$j(this).children('a').trigger('click');
		}
	);
	
	$j('.one_third.gallery3').hover(
		function(){
			$j(this).children('.shadow').fadeIn(800);
			$j(this).find('.one_third_img').animate({
				'opacity':'0.5'
			}, 400);
				
		},
		function(){
			$j(this).children('.shadow').hide();
			$j(this).find('.one_third_img').animate({
				'opacity':'1'
			}, 100);
		}
	);
	
	$j('.one_third.gallery3').click(
		function(){
			$j(this).children('a').trigger('click');
		}
	);
	
	$j('.one_half.gallery2').hover(
		function(){
			$j(this).children('.shadow').fadeIn(800);
			$j(this).find('.one_half_img').animate({
				'opacity':'0.5'
			}, 400);
				
		},
		function(){
			$j(this).children('.shadow').hide();
			$j(this).find('.one_half_img').animate({
				'opacity':'1'
			}, 100);
		}
	);
	
	$j('.one_half.gallery2').click(
		function(){
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
	
	//var calScreenHeight = $j(window).height()-108;
	$j('#page_content_wrapper').css('top', '0px');
	
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
		/*$j('#page_content_wrapper').css('position', 'fixed');
		$j('#page_content_wrapper').animate({ top: calScreenHeight+'px' }, 600);*/
		$j('#page_content_wrapper').fadeOut();
		$j('#page_maximize').css('display', 'block');
		$j('#page_maximize').css('visibility', 'visible');
	});
	
	$j('#page_maximize').click(function(){
		var calScreenHeight = $j(window).height()-120;
		
		$j(this).css('display', 'none');
		$j('#page_minimize').css('display', 'block');
		$j('#page_content_wrapper').fadeIn();
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
	    	$j('h1, h2, h3, h4, h5, h6, .nav li a, #gallery_title, #gallery_desc').css('font-family', 'Titillium');
	    }
	});
	
	$j("#pp_skin_opt").change(function(){ 
		$j('#form_option').submit();
	});
	
	$j("#pp_menu").change(function(){ 
		$j('#form_option').submit();
	});
});
