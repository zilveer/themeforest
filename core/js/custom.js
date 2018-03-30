var $j = jQuery.noConflict();

function isiPad(){
    return (navigator.platform.indexOf("iPad") != -1);
}

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
		padding : 0, 
		prevEffect	: 'fade',
		nextEffect	: 'fade',
		helpers	: {
			title	: {
				type: 'float'
			},
			overlay	: {
				opacity : 1,
				css : {
					'background-color' : '#'+$j('#skin_color').val()
				}
			},
			thumbs	: {
				width	: 80,
				height	: 80
			}
		}
	});
	
	$j('.flickr li a').fancybox({
		padding : 0, 
		prevEffect	: 'fade',
		nextEffect	: 'fade',
		helpers	: {
			title	: {
				type: 'float'
			},
			overlay	: {
				opacity : 1,
				css : {
					'background-color' : '#'+$j('#skin_color').val()
				}
			},
			thumbs	: {
				width	: 80,
				height	: 80
			}
		}
	});
	
	$j('a[rel=gallery]').fancybox({
		padding : 0, 
		prevEffect	: 'fade',
		nextEffect	: 'fade',
		helpers	: {
			title	: {
				type: 'float'
			},
			overlay	: {
				opacity : 1,
				css : {
					'background-color' : '#'+$j('#skin_color').val()
				}
			},
			thumbs	: {
				width	: 80,
				height	: 80
			}
		}
	});
	
	$j('.img_frame').fancybox({
		padding : 0, 
		prevEffect	: 'fade',
		nextEffect	: 'fade',
		helpers	: {
			title	: {
				type: 'float'
			},
			overlay	: {
				opacity : 1,
				css : {
					'background-color' : '#'+$j('#skin_color').val()
				}
			},
			thumbs	: {
				width	: 80,
				height	: 80
			}
		}
	});
	
	$j('.lightbox').fancybox({
		padding : 0, 
		prevEffect	: 'fade',
		nextEffect	: 'fade',
		helpers	: {
			title	: {
				type: 'float'
			},
			overlay	: {
				opacity : 1,
				css : {
					'background-color' : '#'+$j('#skin_color').val()
				}
			},
			thumbs	: {
				width	: 80,
				height	: 80
			}
		}
	});
	
	$j('.lightbox_youtube').fancybox({
		padding : 0, 
		prevEffect	: 'fade',
		nextEffect	: 'fade',
		helpers	: {
			title	: {
				type: 'float'
			},
			overlay	: {
				opacity : 1,
				css : {
					'background-color' : '#'+$j('#skin_color').val()
				}
			},
			thumbs	: {
				width	: 80,
				height	: 80
			}
		}
	});
	
	$j('.lightbox_vimeo').fancybox({
		padding : 0, 
		prevEffect	: 'fade',
		nextEffect	: 'fade',
		helpers	: {
			title	: {
				type: 'float'
			},
			overlay	: {
				opacity : 1,
				css : {
					'background-color' : '#'+$j('#skin_color').val()
				}
			},
			thumbs	: {
				width	: 80,
				height	: 80
			}
		}
	});
	
	$j('.lightbox_iframe').fancybox({
		padding : 0, 
		prevEffect	: 'fade',
		nextEffect	: 'fade',
		helpers	: {
			title	: {
				type: 'float'
			},
			overlay	: {
				opacity : 1,
				css : {
					'background-color' : '#'+$j('#skin_color').val()
				}
			},
			thumbs	: {
				width	: 80,
				height	: 80
			}
		}
	});
	
	$j('#content_slider_wrapper').fadeOut();
	$j('#move_next').fadeOut();
	$j('#move_prev').fadeOut();
	
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
	
	if(BrowserDetect.browser != 'Explorer')
 	{
		$j('#slider_wrapper').hover(function(){  
				$j('.nivo-controlNav').fadeIn();
 			}  
  			, function(){  
  				$j('.nivo-controlNav').fadeOut();
  			}  
  			
		);
		
		$j('.nivo_border').hover(function(){  
				$j('.nivo-controlNav').fadeIn();
 			}  
  			, function(){  
  				$j('.nivo-controlNav').fadeOut();
  			}  
  			
		);
	}
	else
	{
		$j('#slider_wrapper').hover(function(){  
				$j('.nivo-controlNav').show();
 			}  
  			, function(){  
  				$j('.nivo-controlNav').hide();
  			}  
  			
		);
		
		$j('.nivo_border').hover(function(){  
				$j('.nivo-controlNav').show();
 			}  
  			, function(){  
  				$j('.nivo-controlNav').hide();
  			}  
  			
		);
	}
	
	$j(".pp_accordion_close").accordion({ active: 1, collapsible: true, clearStyle: true });
	
	$j(".pp_accordion").accordion({ active: 0, collapsible: true, clearStyle: true });
	
	$j('input[title!=""]').hint();
	
	$j('textarea[title!=""]').hint();
	
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
	
	$j.validator.setDefaults({
		submitHandler: function() { 
		    var actionUrl = $j('#contact_form_widget').attr('action');
		    
		    $j.ajax({
  		    	type: 'GET',
  		    	url: actionUrl,
  		    	data: $j('#contact_form_widget').serialize(),
  		    	success: function(msg){
  		    		$j('#contact_form_widget').hide();
  		    		$j('#reponse_msg').html(msg);
  		    	}
		    });
		    
		    return false;
		}
	});
		    
		
	$j('#contact_form_widget').validate({
		rules: {
		    your_name: "required",
		    email: {
		    	required: true,
		    	email: true
		    },
		    message: "required"
		},
		messages: {
		    your_name: "Please enter your name",
		    email: "Please enter a valid email address",
		    message: "Please enter some message"
		}
	});
	
});
