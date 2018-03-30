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
			position = $j(this).position();
			
			if($j(this).parents().attr('class') == 'sub-menu')
			{	
				$jsublist.css({top: position.top-2+'px'});
				$jsublist.stop().css({height:'auto', display:'none'}).slideDown(200);
			}
			else
			{
				$jsublist.stop().css({overflow: 'visible', height:'auto', display:'none'}).slideDown(400);
				
				if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
 				{
 					hackMargin = -$j(this).width()-2;
					$jsublist.css({marginLeft: hackMargin+'px'});
				}
			}
		},
		function()
		{	
			$jsublist.stop().css({height:'auto', display:'none'}).slideUp(200);	
		});

	});
	
	$j('#menu_wrapper .nav ul li ul').css({display: 'none'});

	$j('#menu_wrapper .nav ul li').each(function()
	{
		
		var $jsublist = $j(this).find('ul:first');
		
		$j(this).hover(function()
		{	
			if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
 			{
 				$jsublist.css({top: position.top-2+'px'});		
 			}
 			else
 			{
 				$jsublist.css({top: position.top-2+'px'});
 			}
		
			$jsublist.stop().css({height:'auto', display:'none'}).slideDown(200);	
		},
		function()
		{	
			$jsublist.stop().css({height:'auto', display:'none'}).slideUp(200);	
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
		overlayOpacity: 0.9
	});
	
	$j('.flickr li a').fancybox({ 
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				opacity : 0.9,
				css : {
					'background-color' : '#000'
				}
			},
			thumbs	: {
				width	: 60,
				height	: 60
			}
		}
	});
	
	$j('a.fancy-gallery').fancybox({
		padding : 0, 
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				opacity : 0.9,
				css : {
					'background-color' : '#000'
				}
			},
			thumbs	: {
				width	: 60,
				height	: 60
			}
		}
	});
	
	$j('.img_frame').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		overlayOpacity: 0.9
	});
	
	$j('.lightbox_youtube').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: 0.9,
		scrolling: 'no'
	});
	
	$j('.lightbox_vimeo').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: 0.9,
		scrolling: 'no'
	});
	
	$j('.project_single').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: 0.9,
		scrolling: 'no'
	});
	
	$j('input[title!=""]').hint();
	
	$j('textarea[title!=""]').hint();
	
	$j('.one_fourth.gallery4').hover(
		function(){
			$j(this).stop().animate({
					'opacity': .8
				}, 400);
		},
		function(){
			$j(this).stop().animate({
					'opacity': 1
				}, 400);
		}
	);
	
	$j('.one_third.gallery3').hover(
		function(){
			$j(this).stop().animate({
					'opacity': .8
				}, 400);
		},
		function(){
			$j(this).stop().animate({
					'opacity': 1
				}, 400);
		}
	);
	
	$j('.one_half.gallery2').hover(
		function(){
			$j(this).stop().animate({
					'opacity': .8
				}, 400);
		},
		function(){
			$j(this).stop().animate({
					'opacity': 1
				}, 400);
		}
	);
	
	$j('.post_img').hover(
		function(){
			$j(this).stop().animate({
					'opacity': .8
				}, 400);
		},
		function(){
			$j(this).stop().animate({
					'opacity': 1
				}, 400);
		}
	);
	
	$j('.portfolio_img').hover(
		function(){
			$j(this).stop().animate({
					'opacity': .8
				}, 400);
		},
		function(){
			$j(this).stop().animate({
					'opacity': 1
				}, 400);
		}
	);
	
	$j('.post_img').click(
		function(event){
			$j(this).children('a').trigger('click');
		}
	);
	
	var calScreenHeight = $j(window).height()-108;
	var miniRightPos = 800;
	
	$j('#page_minimize').click(function(){
		$j(this).css('visibility', 'hidden');
		$j('#page_maximize').css('visibility', 'visible');
		$j('#page_content_wrapper').fadeOut('slow');
		$j('.gallery_social').fadeOut('slow');
		$j('#kenburns_title').fadeIn('slow');
		$j('#kenburns_desc').fadeIn('slow');
	});
	
	$j('#page_maximize').click(function(){
		$j(this).css('visibility', 'hidden');
		$j('#page_minimize').css('visibility', 'visible');
		$j('#page_content_wrapper').fadeIn('slow');
		$j('.gallery_social').fadeIn('slow');
		$j('#kenburns_title').fadeOut('slow');
		$j('#kenburns_desc').fadeOut('slow');
	});
	
	// Create the dropdown base
	$j("<select />").appendTo("#menu_border_wrapper");
	
	// Create default option "Go to..."
	$j("<option />", {
	   "selected": "selected",
	   "value"   : "",
	   "text"    : "- Main Menu -"
	}).appendTo("#menu_border_wrapper select");
	
	// Populate dropdown with menu items
	$j(".nav li").each(function() {
	 var current_item = $j(this).hasClass('current-menu-item'); 
	 var el = $j(this).children('a');
	 var menu_text = el.text();

	 if($j(this).parent('ul.sub-menu').length > 0)
	 {
	 	menu_text = "- "+menu_text;
	 }
	 
	 if($j(this).parent('ul.sub-menu').parent('li').parent('ul.sub-menu').length > 0)
	 {
	 	menu_text = el.text();
	 	menu_text = "- - "+menu_text;
	 }
	 
	 if(current_item)
	 {
	 	$j("<option />", {
	 		 "selected": "selected",
	    	 "value"   : el.attr("href"),
	    	 "text"    : menu_text
		 }).appendTo("#menu_border_wrapper select");
	 }
	 else
	 {
	 	$j("<option />", {
	     	"value"   : el.attr("href"),
	     	"text"    : menu_text
	 	}).appendTo("#menu_border_wrapper select");
	 }
	});
	
	$j("#menu_border_wrapper select").change(function() {
  		window.location = $j(this).find("option:selected").val();
	});
	
});
