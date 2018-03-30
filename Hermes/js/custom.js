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

$j.fn.getIndex = function(){
	var $jp=$j(this).parent().children();
    return $jp.index(this);
}

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

$j(function () {

    	$j('.slideshow').anythingSlider({
    	        easing: "easeInOutExpo",
    	        autoPlay: false,
    	        startStopped: false,
    	        animationTime: 600,
    	        hashTags: false,
    	        buildNavigation: true,
    	        buildArrows: false,
    			pauseOnHover: true,
    			startText: "Go",
    	        stopText: "Stop"
    	    });
    	    
    });

$j(document).ready(function(){ 

	$j(document).setNav();
	
	$j('.img_frame').fancybox({ 
		padding: 0,
		overlayColor: '#000',
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .7
	});
	
	$j('.pp_gallery a').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .7
	});
	
	$j('.flickr li a').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .7
	});
	
	$j('.lightbox').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .7
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
	
	$j('.lightbox_dailymotion').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .7
	});
	
	$j('.lightbox_iframe').fancybox({ 
		padding: 0,
		type: 'iframe',
		overlayColor: '#000', 
		transitionIn: 'fade',
		transitionOut: 'fade',
		overlayOpacity: .7,
		width: 900,
		height: 650
	});
	
	$j('a[rel=gallery]').fancybox({ 
		padding: 0,
		overlayColor: '#000', 
		overlayOpacity: .7
	});
	
	if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
	{
		var zIndexNumber = 1000;
		$j('div').each(function() {
			$j(this).css('zIndex', zIndexNumber);
			zIndexNumber -= 10;
		});

		$j('#thumbNav').css('zIndex', 1000);
		$j('#thumbLeftNav').css('zIndex', 1000);
		$j('#thumbRightNav').css('zIndex', 1000);
		$j('#fancybox-wrap').css('zIndex', 1001);
		$j('#fancybox-overlay').css('zIndex', 1000);
	}
	
	$j(".pp_accordion_close").accordion({ active: 1, collapsible: true, clearStyle: true });
	
	$j(".pp_accordion").accordion({ active: 0, collapsible: true, clearStyle: true });
	
	$j(".tabs").tabs();
	
	$j('.pp_accordion').hover(function(){  
			$j(this).animate({boxShadow: '4px 4px 0px 0px rgba(150, 150, 150, 0.1)'});
 		}  
  		, function(){  
  			$j(this).animate({boxShadow: '0 0 0 #f9f9f9'});
  		}  
	);
	
	$j('.pp_accordion_close').hover(function(){  
			$j(this).animate({boxShadow: '4px 4px 0px 0px rgba(150, 150, 150, 0.1)'});
 		}  
  		, function(){  
  			$j(this).animate({boxShadow: '0 0 0 #f9f9f9'});
  		}  
	);
	
	$j('.frame_left').hover(function(){  
			$j(this).animate({boxShadow: '4px 4px 0px 0px rgba(150, 150, 150, 0.1)'});
 		}  
  		, function(){  
  			$j(this).animate({boxShadow: '0 0 0 #f9f9f9'});
  		}  	
	);
	
	$j('.frame_right').hover(function(){  
			$j(this).animate({boxShadow: '4px 4px 0px 0px rgba(150, 150, 150, 0.1)'});
 		}  
  		, function(){  
  			$j(this).animate({boxShadow: '0 0 0 #f9f9f9'});
  		}  	
	);
	
	$j('.frame_center').hover(function(){  
			$j(this).animate({boxShadow: '4px 4px 0px 0px rgba(150, 150, 150, 0.1)'});
 		}  
  		, function(){  
  			$j(this).animate({boxShadow: '0 0 0 #f9f9f9'});
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
	
	$j('.tipsy').tipsy({fade: false, gravity: 's'});
	
	/*$j('.one_sixth_img').tipsy({fade: false, gravity: 'n'});
	
	$j('.one_third_img').tipsy({fade: false, gravity: 'n'});
	
	$j('.one_fourth_img').tipsy({fade: false, gravity: 'n'});*/
	
	Cufon.replace('h1.cufon');
	Cufon.replace('h2.cufon');
	Cufon.replace('h3.cufon');
	Cufon.replace('h4.cufon');
	Cufon.replace('h5.cufon');
	Cufon.replace('h6.cufon');
	Cufon.replace('.tagline_header');
	Cufon.replace('.pricing_box h2');
	Cufon.replace('.dropcap1');
	Cufon.replace('.circle_date a');
	Cufon.replace('.caption_header h1');
	Cufon.replace('.caption_desc');
	Cufon.replace('.post_header h3 a');
	Cufon.replace('.post_img_date');
	Cufon.replace('.widgettitle');
	Cufon.replace('.tagline_inner');
	
	var footerLi = 0;
	$j('#footer .sidebar_widget li.widget').each(function()
	{
		footerLi++;
		
		if(footerLi%$j('#pp_footer_style').val() == 0)
		{ 
			$j(this).addClass('last');
		}
	});
	
	VideoJS.setupAllWhenReady({
      controlsBelow: false, // Display control bar below video instead of in front of
      controlsHiding: true, // Hide controls when mouse is not over the video
      defaultVolume: 0.75, // Will be overridden by user's last volume if available
      flashVersion: 9, // Required flash version for fallback
      linksHiding: true // Hide download links when video is supported
    });
	
	$j('.home_portfolio img.frame').each(function()
	{
		$j(this).hover(function()
		{	
			$j(this).animate({top: '-10px'}, 300);
		},
		function()
		{	
			$j(this).animate({top: 0}, 300);
		});	
	});
	
	$j('#searchform input[type=text]').attr('title', 'Type keywords and hit enter...');
	
	$j('.html5_wrapper').hide();
	
	$j('input[title!=""]').hint();
	
	$j('textarea[title!=""]').hint();
	
	$j('.portfolio_title').tipsy({fade: true, gravity: 's'});
	
	$j('a.portfolio_image.gallery').tipsy({fade: true, gravity: 's'});
	
	$j('.tagline').css('visibility', 'visible');
	
	// Clone applications to get a second collection
	var $jdata = $j(".portfolio-content").clone();
	var pp_portfolio_sorting = $j('#pp_portfolio_sorting').val();

	$j('.portfolio-main li').click(function(e) {
	
		$j(".filter li").removeClass("active");	
		// Use the last category class as the category to filter by. This means that multiple categories are not supported (yet)
		var filterClass=$j(this).attr('class').split(' ').slice(-1)[0];
		
		if (filterClass == 'all-projects') {
			var $jfilteredData = $jdata.find('.project');
		} else {
			var $jfilteredData = $jdata.find('.project[data-type~=' + filterClass + ']');
		}
		$j(".portfolio-content").quicksand($jfilteredData, {
			duration: 800,
			easing: pp_portfolio_sorting,
			useScaling: false,
    		enhancement: function() {
    			$j('.img_frame').fancybox({ 
					padding: 0,
					overlayColor: '#000',
					transitionIn: 'fade',
					transitionOut: 'fade',
					overlayOpacity: .7
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
    		
      			$j('.portfolio-content div.project').each(function()
				{
					$j(this).hover(function()
					{	
						$j(this).find('a .overlay_detail').animate({'opacity': 0.7}, 600);
						$j(this).find('a .overlay_detail *').css('visibility', 'visible');
					},
					function()
					{	
						$j(this).find('a .overlay_detail').animate({'opacity': 0}, 600);
						$j(this).find('a .overlay_detail *').css('visibility', 'hidden');
					});		
				});
    		}
		});	
		$j(this).addClass("active"); 
					
		return false;
	});
	
	$j('#option_btn').click(
    	function() {
    		if($j('#option_wrapper').css('left') != '0px')
    		{
 				$j('#option_wrapper').animate({"left": "0px"}, { duration: 300 });
	 			$j(this).animate({"left": "140px"}, { duration: 300 });
	 		}
	 		else
	 		{
	 			$j('#option_wrapper').animate({"left": "-145px"}, { duration: 300 });
    			$j('#option_btn').animate({"left": "0px"}, { duration: 300 });
	 		}
    	}
    );
    
    $j('#bg_header_preview').ColorPicker({
		color: $j('#pp_header_bg').val(),
		onShow: function (colpkr) {
			$j(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) { 
			$j.ajax({
  				type: 'GET',
  				url: $j('#form_option').attr('action'),
  				data: 'pp_header_bg='+$j('#bg_header_preview').css('backgroundColor')
			});
			
			$j(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$j('#bg_header_preview').css('backgroundColor', '#' + hex);
			$j('#header_wrapper').css('backgroundColor', '#' + hex);
			$j('#footer').css('backgroundColor', '#' + hex);
			$j('#copyright').css('backgroundColor', '#' + hex);
		}
	});
    
    $j('#bg_preview').ColorPicker({
		color: $j('#pp_bg_color').val(),
		onShow: function (colpkr) {
			$j(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) { 
			$j.ajax({
  				type: 'GET',
  				url: $j('#form_option').attr('action'),
  				data: 'pp_bg_color='+$j('#bg_preview').css('backgroundColor')
			});
			
			$j(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$j('#bg_preview').css('backgroundColor', '#' + hex);
			$j('body').css('backgroundColor', '#' + hex);
		}
	});
	
	$j('#pp_theme_style_select').change(function(){
		$j.ajax({
  			type: 'GET',
  			url: $j('#form_option').attr('action'),
  			data: 'pp_theme_style='+$j(this).val(),
  			success: function(msg){
  		    	location.href = $j('#pp_blogurl').val();
  		    }
		});
	});
	
	$j('#pp_slider_effect').change(function(){
		$j.ajax({
  			type: 'GET',
  			url: $j('#form_option').attr('action'),
  			data: 'pp_slider_effect='+$j(this).val(),
  			success: function(msg){
  		    	location.href = $j('#pp_blogurl').val();
  		    }
		});
	});
	
	$j('#pp_font').change(function(){
		$j.ajax({
  			type: 'GET',
  			url: $j('#form_option').attr('action'),
  			data: 'pp_font='+$j(this).val()
		});
		
		var ppCufonFont = $j("#pp_stylesheet_directory").val()+'/fonts/'+$j(this).val()+'.js';
		var script = document.createElement( 'script' );
		script.type = 'text/javascript';
		script.src = ppCufonFont;
		jQuery("body").append( script );
		
		Cufon.replace('h1.cufon');
		Cufon.replace('h2.cufon');
		Cufon.replace('h2.widgettitle');
		Cufon.replace('h3.cufon');
		Cufon.replace('h4.cufon');
		Cufon.replace('h5.cufon');
		Cufon.replace('h6.cufon');
		Cufon.replace('.tagline');
		Cufon.replace('.pricing_box h2');
		Cufon.replace('.dropcap1');
		Cufon.replace('.circle_date a');
		Cufon.replace('.page_caption h1.cufon');
		Cufon.replace('.tagline h2.cufon');
		Cufon.replace('.tagline p');
	});
	
	$j('#pp_body_font').change(function(){
		$j.ajax({
  			type: 'GET',
  			url: $j('#form_option').attr('action'),
  			data: 'pp_body_font='+$j(this).val()
		});
	
		$j('body').css('fontFamily', $j(this).val());
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
		    agree: "Please enter some message"
		}
	});	
	
	$j('#galleria').galleria({
        width:960,
        height:500,
        transition: 'fade'
    });
    
    $j('pre').each(function()
	{
		preContent = $j(this).html();
	});
	
	$j('#pp_bg_pattern').change(function(){ 
 		pp_pattern = $j(this).val();
 	
 		$j.ajax({
  			type: 'GET',
  			url: $j('#form_option').attr('action'),
  			data: 'pp_bg_pattern='+$j(this).val(),
  			success: function(){
   				if(pp_pattern == '')
				{
					location.href = location.href;
				}
  			}
		});
		
		$j('#header_pattern').attr('class', '');
		$j('#header_pattern').addClass($j(this).val());
		$j('#footer_pattern').attr('class', '');
		$j('#footer_pattern').addClass($j(this).val());
		
 	});
 	
 	if(BrowserDetect.browser != 'Explorer')
 	{
 		$j('#content_wrapper').krioImageLoader();
 	}
 	
 	$j('.portfolio-content div.project').each(function()
	{
		$j(this).hover(function()
		{	
			$j(this).find('a .overlay_detail').animate({'opacity': 0.7}, 600);
			$j(this).find('a .overlay_detail *').css('visibility', 'visible');
		},
		function()
		{	
			$j(this).find('a .overlay_detail').animate({'opacity': 0}, 600);
			$j(this).find('a .overlay_detail *').css('visibility', 'hidden');
		});		
	});
	
	$j('.one_fourth div.portfolio4_shadow').each(function()
	{
		$j(this).hover(function()
		{	
			$j(this).find('a .overlay_detail').animate({'opacity': 0.7}, 600);
			$j(this).find('a .overlay_detail *').css('visibility', 'visible');
		},
		function()
		{	
			$j(this).find('a .overlay_detail').animate({'opacity': 0}, 600);
			$j(this).find('a .overlay_detail *').css('visibility', 'hidden');
		});		
	});
	
	$j('.custom_gallery div.one_fourth div.portfolio4_shadow').each(function()
	{
		$j(this).hover(function()
		{	
			$j(this).find('a .overlay_detail').animate({'opacity': 0.7}, 600);
			$j(this).find('a .overlay_detail *').css('visibility', 'visible');
		},
		function()
		{	
			$j(this).find('a .overlay_detail').animate({'opacity': 0}, 600);
			$j(this).find('a .overlay_detail *').css('visibility', 'hidden');
		});		
	});
	
});