/*
	File Name: script.js
	by Tolga Can
	RT-Theme 17
*/

  
//remove no-js - javascript is enabled
jQuery(document).ready(function() {
	jQuery("html").removeClass("no-js"); 
});

//100% background
jQuery(window).load(function() {
	jQuery("#background").fullBg();
}); 

//rt drop down menu
jQuery(document).ready(function() { 
	   
	 jQuery("#navigation ul").css({display: ""}); 
	
	jQuery("#navigation li").each(function()
	{
		jQuery(this).hover(function()
		{
			var position = jQuery(this).position();
			var width = jQuery(this).find("a:first-child").width();
			
			jQuery(this).find('ul:first').stop().css({
			
				 height:"auto",
				 overflow:"hidden",
				 zIndex:"1000",
				 position:"absolute",
				 display:"none"
				 }).slideDown(200, function()
			{
			jQuery(this).css({
				 height:"auto",
				 overflow:"visible"
			}); 
		});
			  
		},
			
		function()
		{	
			jQuery(this).find('ul:first').stop().slideUp(200, function()
			{	
				  jQuery(this).css({
				  display:"none",
				  overflow:"hidden"
				  });
			});
		});	
	});  

}); 
  
// Mobile Navigation for RT-Theme
jQuery(document).ready(function() {
	jQuery('#MobileMainNavigation').change(function() {	
		window.location.href = $(this +'option:selected').val();
	});
}); 
 

jQuery(window).resize(function() { // description fix on window resize
	descFix();
});

//Photo Slider
jQuery(document).ready(function(){ 
	if (jQuery('.photo_gallery_cycle ul').length>0){
		jQuery(".photo_gallery_cycle ul").cycle({ 
			fx:     'fade', 
			timeout:  rttheme_slider_timeout,
			pager:  '.slider_buttons', 
			cleartype:  1,
			pause:           true,     // true to enable "pause on hover"
			pauseOnPagerHover: true,   // true to pause when hovering over pager link						
				pagerAnchorBuilder: function(idx) { 
					return '<a href="#" title=""><img src="images/pixel.gif" width="8" heigth="8"></a>'; 
				}
		});
	}
});

// before
function onBefore(slider) {
	var thisID = "#"+slider.attr("id");
	if(slider.width()>920){
		jQuery(thisID+' .flex-caption').animate({'bottom':'0px','opacity':'0'},0,'easeOutBack'); 
	}
	
}

// after  
function onAfter(slider) {
	var thisID = "#"+slider.attr("id");
	if(slider.width()>920){
		jQuery(thisID+' .flex-caption').animate({'bottom':'40px','opacity':'1'},800,'easeOutBack'); 
	}
} 

// description fix
function descFix() {
	jQuery('.flex-caption').css({'bottom':'0','opacity':'1'});
}


/*!
* Bowser - a browser detector
* https://github.com/ded/bowser
* MIT License | (c) Dustin Diaz 2013
*/
!function(e,t){typeof define=="function"?define(t):typeof module!="undefined"&&module.exports?module.exports.browser=t():this[e]=t()}("bowser",function(){function g(){return n?{name:"Internet Explorer",msie:t,version:e.match(/(msie |rv:)(\d+(\.\d+)?)/i)[2]}:l?{name:"Opera",opera:t,version:e.match(d)?e.match(d)[1]:e.match(/opr\/(\d+(\.\d+)?)/i)[1]}:r?{name:"Chrome",webkit:t,chrome:t,version:e.match(/(?:chrome|crios)\/(\d+(\.\d+)?)/i)[1]}:i?{name:"PhantomJS",webkit:t,phantom:t,version:e.match(/phantomjs\/(\d+(\.\d+)+)/i)[1]}:a?{name:"TouchPad",webkit:t,touchpad:t,version:e.match(/touchpad\/(\d+(\.\d+)?)/i)[1]}:o||u?(m={name:o?"iPhone":"iPad",webkit:t,mobile:t,ios:t,iphone:o,ipad:u},d.test(e)&&(m.version=e.match(d)[1]),m):f?{name:"Android",webkit:t,android:t,mobile:t,version:(e.match(d)||e.match(v))[1]}:s?{name:"Safari",webkit:t,safari:t,version:e.match(d)[1]}:h?(m={name:"Gecko",gecko:t,mozilla:t,version:e.match(v)[1]},c&&(m.name="Firefox",m.firefox=t),m):p?{name:"SeaMonkey",seamonkey:t,version:e.match(/seamonkey\/(\d+(\.\d+)?)/i)[1]}:{}}var e=navigator.userAgent,t=!0,n=/(msie|trident)/i.test(e),r=/chrome|crios/i.test(e),i=/phantom/i.test(e),s=/safari/i.test(e)&&!r&&!i,o=/iphone/i.test(e),u=/ipad/i.test(e),a=/touchpad/i.test(e),f=/android/i.test(e),l=/opera/i.test(e)||/opr/i.test(e),c=/firefox/i.test(e),h=/gecko\//i.test(e),p=/seamonkey\//i.test(e),d=/version\/(\d+(\.\d+)?)/i,v=/firefox\/(\d+(\.\d+)?)/i,m,y=g();return y.msie&&y.version>=8||y.chrome&&y.version>=10||y.firefox&&y.version>=4||y.safari&&y.version>=5||y.opera&&y.version>=10?y.a=t:y.msie&&y.version<8||y.chrome&&y.version<10||y.firefox&&y.version<4||y.safari&&y.version<5||y.opera&&y.version<10?y.c=t:y.x=t,y});   

//RT Social Media Effect
(function($){
	$.fn.rt_social_media_effect = function(options) {
	var settings = $.extend({}, $.fn.rt_social_media_effect.defaults, options);
 
		// If the browser is IE 7-6    
		if ( bowser.msie && bowser.version < 8 ) { // hide if before ie 8
			return false;
		}else{	
		
			var social_media_icon=$(this); 
		
			social_media_icon.each(function(){
				var the_name = jQuery(this).attr("title"); // get the name 		
				jQuery(this).append('<div class="social_tip">'+the_name+'</div> '); //create new div name		
			}); 
				
			//the effect   
			 if (bowser.msie){
				jQuery("ul.social_media_icons li img").mouseover(function(){
					if(parseInt(jQuery(window).width())>920){ 
						jQuery(this).stop().animate({ 'opacity':'0.7'}, 100, "easeIn");
						jQuery(this).next('div.social_tip').stop().show();
					}
				}).mouseout(function(){
					if(parseInt(jQuery(window).width())>920){ 
						jQuery(this).stop().animate({ 'opacity':'1'}, 100, "easeIn");
						jQuery(this).next('div.social_tip').stop().hide();
					}
				});
			}else{
				jQuery("ul.social_media_icons li img").mouseover(function(){
					if(parseInt(jQuery(window).width())>920){ 
						jQuery(this).stop().animate({ 'opacity':'0.7'}, 100, "easeIn");
						jQuery(this).next('div.social_tip').stop().animate({ 'opacity':'1','width':'show'}, 100, "easeIn");
					}
				}).mouseout(function(){
					if(parseInt(jQuery(window).width())>920){ 
						jQuery(this).stop().animate({ 'opacity':'1'}, 100, "easeIn");
						jQuery(this).next('div.social_tip').stop().animate({ 'opacity':'0','width':'hide'}, 0);
					}
				});
			}
		}  
	}; 
})(jQuery);
jQuery(document).ready(function() {
	jQuery('#footer ul.social_media_icons li a, .social_media_top ul.social_media_icons li a').rt_social_media_effect();
});



//RT form field - text back function
jQuery(document).ready(function() {

var form_inputs=jQuery(".showtextback");

	form_inputs.each(function(){
	
		jQuery(this).focus( function()
		{
			val = jQuery(this).val();
			if (jQuery(this).attr("alt") != "0"){
				jQuery(this).attr("alt",jQuery(this).attr("value")); 
				jQuery(this).attr("value","");
			}
		});
	
		jQuery(this).blur( function(){
			if (jQuery(this).attr("alt") != "0"){
				val = jQuery(this).val(); 
				if (val == '' || val == jQuery(this).attr("alt")){
					jQuery(this).attr("value",jQuery(this).attr("alt"));
				}
			}
		});
	
		jQuery(this).keypress( function(){  
			jQuery(this).attr("alt","0");	    
		});                 
	});  
		 
}); 


//Slide to top
jQuery(document).ready(function(){
	jQuery(".line span.top").click(function() {
		jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );
	});
});

// Tabs
jQuery(function($){ 
	jQuery("ul.tabs").tabs("> .pane", {effect: 'fade'});

	jQuery(".accordion").tabs(".pane", {tabs: '.title', effect: 'slide'});
	jQuery(".scrollable").scrollable();


	jQuery(".items.big_image img").click(function() {

		// see if same thumb is being clicked
		if (jQuery(this).hasClass("active")) { return; }

		// calclulate large image's URL based on the thumbnail URL (flickr specific)
		var url = jQuery(this).attr("alt");


		// get handle to element that wraps the image and make it semi-transparent
		var wrap = jQuery("#image_wrap").fadeTo("medium", 0.5);

		// the large image from www.flickr.com
		var img = new Image();


		// call this function after it's loaded
		img.onload = function() {

			// make wrapper fully visible
			wrap.fadeTo("fast", 1);

			// change the image
			wrap.find("img").attr("src", url);

		};

		// begin loading the image from www.flickr.com
		img.src = url;

		// activate item
		jQuery(".items img").removeClass("active");
		jQuery(this).addClass("active");

	// when page loads simulate a "click" on the first image
	}).filter(":first").click(); 
}); 
 
//rt accordions 
jQuery(function($){
	$(document).ready(function(){ 
		$(".rt-toggle .toggle-content").hide(); 
		$(".rt-toggle .open .toggle-content").show();  
		
		$(".rt-toggle ol li .toggle-head").click(function(){ 
 
			if($(this).parent("li").hasClass("open")){ 
				$(this).parent("li").removeClass("open").find(".toggle-content").stop().slideUp(300);  
			}else{
				$(this).parents("ol").find("li.open").removeClass("open").find(".toggle-content").stop().slideUp(300);  
				$(this).parent("li").addClass("open").find(".toggle-content").stop().slideDown(300, "easeIn");	
			} 
		});
});  
}); 

//tool tips  
jQuery(document).ready(function(){
	jQuery('.j_ttip,.j_ttip2,.widget ul.social_media_icons li a').colorTip({color:'black'});
});

//validate contact form
jQuery(document).ready(function(){

	// show a simple loading indicator
	var loader = jQuery('<img src="'+rttheme_template_dir+'/images/loading.gif" alt="..." />')
			.appendTo(".loading");
			loader.hide();

	jQuery.validator.messages.required = "";

	jQuery(".validate_form").each(function(){ 	
			var result = jQuery(this).parents(".contact_form").find(".result");
		var v = jQuery(this).validate({
			  submitHandler: function(form) {
					  jQuery(form).ajaxSubmit({
							  target: result,
						beforeSubmit:  function() {loader.show()},
						url: ajaxurl,
						data: { action: 'rt_ajax_contact_form' },
						success:   function() {loader.hide()}
					  });
			  }
		});
		});
 }); 


//pretty photo
jQuery(document).ready(function(){
	jQuery('a[data-gal]').each(function() {
		jQuery(this).attr('rel', jQuery(this).data('gal'));
	});  	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({animationSpeed:'slow',slideshow:false,overlay_gallery: false,social_tools:false,deeplinking:false});
}); 

  
//Fade effect for flickr
jQuery(window).load(function() {
	 
	var flickrItems=jQuery(".flickr_thumbs img");
	
	flickrItems.mouseover(function(){
		
		flickrItems.each(function(){
			jQuery(this).stop().animate({ opacity:"0.4"}, 300, "easeIn");
		});
		
		jQuery(this).stop().animate({ opacity:"1"}, 100, "easeIn");
		
	}).mouseout(function(){
		flickrItems.each(function(){
			jQuery(this).stop().animate({ opacity:"1"}, 200, "easeIn");
		});
	});   
});  

//floating sidebars
jQuery(window).load(function(){

	setTimeout(function() { 
		var $window = jQuery(window);
		var $sidebar = jQuery(".sidebar.float");
		var $footer = jQuery(".footer");
		var $content = jQuery(".content");
		var $WPbar = jQuery("#wpadminbar").length;
		var $addHeigth = 0;
		if ($WPbar>0) $addHeigth = 28;

		if($sidebar.length>0){
			var sidebarTop = $sidebar.position().top;
			var sidebarHeight = $sidebar.height()+10;
			var contentHeight = $content.height(); 
			var footerTop = $footer.position().top;

			
			if(contentHeight>sidebarHeight){
				$window.scroll(function(event) {
					$sidebar.addClass('fixed');
					scrollTop = $window.scrollTop(),
					topPosition = Math.max(0, (sidebarTop) - scrollTop),
					topPosition = Math.min(topPosition, (footerTop - scrollTop) - sidebarHeight);
					$sidebar.css('top', topPosition+$addHeigth);
				});
			}
		}
	},2000);
}); 

//RT Fixed Rows  
(function($){
	$.fn.rt_fixed_rows = function(options) {
	var settings = $.extend({}, $.fn.rt_fixed_rows.defaults, options);
	var fixed_rows = $(this);
	var rowID =	Math.ceil(Math.random()*2000);
 
		fixed_rows.each(function(){ 
			var current_row = jQuery(this);
			var max_box_height = 0;

			current_row.addClass('dynamic-fixedRow-'+rowID+''); 
			jQuery(this).find('.box').each(function(){	  

				if(jQuery(this).hasClass("one") == false && jQuery(this).hasClass("fullwidth") == false ){
					if(jQuery(this).height()	> max_box_height){
						max_box_height = jQuery(this).height();
					} 
				}
			});
			jQuery('div.dynamic-fixedRow-'+rowID+' > .box').css({'min-height':max_box_height});

			rowID++;

		});  
	}; 
})(jQuery);

jQuery(window).load(function() { 
	jQuery('#container .fixed-row').rt_fixed_rows();
}); 

//RT Fixed Rows  - ul version
(function($){
	$.fn.rt_fixed_rows_ul = function(options) {
		var settings = $.extend({}, $.fn.rt_fixed_rows_ul.defaults, options);
		 
		//default settings
		settings = jQuery.extend({
			classname: "", //specific class name for li - .classname 
			 row_size: 3, //default value items displayed in each row
			padding: 0 //padding size
		}, options);				
		 
		var fixed_rows = $(this); 
		var item_counter = 1;
		var max_box_height = 0;
		var row_counter = Math.round(jQuery(this).find("li"+settings.classname).length / settings.row_size);
		var current_item = "";
	

		for(i=0; i< row_counter; i++){// do foreach rows 
	
			for(z=0; z < settings.row_size; z++){// get max item height value in the current row			
				current_item = fixed_rows.find("li"+settings.classname).eq( i*settings.row_size + z);
				if(jQuery(current_item).height() > max_box_height){
					max_box_height = jQuery(current_item).height();
				} 
			} 
	
			for(z=0; z < settings.row_size; z++){// set new value foreach item in the current row 
				current_item = fixed_rows.find("li"+settings.classname).eq( i*settings.row_size + z);
				current_item.css({'height':max_box_height-settings.padding});  
			}
		 
			max_box_height  = 0;
		} 
	}; 
})(jQuery);

jQuery(window).load(function() {
	if(typeof woo_product_layout != 'undefined') {
		jQuery('ul.products').rt_fixed_rows_ul({row_size:woo_product_layout, padding:0, classname:".height_fix"});
	}
}); 

/* REMOVED WITH VERSION 1.4
//RT footer position fix
jQuery(window).load(function() { 
  
	var bodyHeight = jQuery('#container').height();
	var footerDistance = ( jQuery(window).height() - bodyHeight ); 
	var footerHolder = jQuery('.footer_pos_fix');	
	var footerHeight = footerHolder.height();
	var newHeight = bodyHeight + footerDistance -40;

	if(footerDistance>1 && parseInt(jQuery(window).width())>920){ 
		jQuery('#container').css({"height":""+newHeight+"px"});
		footerHolder.css({"position":"absolute","bottom":"0","width":"100%"});
	} 
 });
*/

// chosen for woocommerce
(function($){
	if(jQuery().chosen && typeof woo_product_layout != 'undefined'){
		$(".orderby").chosen();
	}
})(jQuery);

// cart bar for woocommerce
jQuery(window).load(function() { 
	if(typeof woo_product_layout != 'undefined'){
		if (jQuery('#wpml_flags').length>0 && parseInt(jQuery(window).width())>920){
			var flag_cont_width = parseInt(jQuery("#wpml_flags ul").width());
			jQuery("#rt_woo_links").animate({"top":"0","opacity":"1","right":flag_cont_width+30+"px"},1000);
		}else{
			jQuery("#rt_woo_links").animate({"top":"0","opacity":"1","right":"0"},1000);
		}
	}
});


//RT Sort Columns
(function($){
	$.fn.rt_sort_columns = function(options) {
		var settings = $.extend({}, $.fn.rt_sort_columns.defaults, options);
		 
		//default settings
		settings = $.extend({
			navigation: "" // sort navigation class name classname
		}, options);				
		 
		var $container = $(this);   
		var $navigation = $("body ."+settings.navigation+"");

		$navigation.find('li a').click(function(){
		  var selector = $(this).attr('data-filter'); 

			//remove active class
			$navigation.find('li').each(function(){
				if($(this).hasClass("active")){
					$(this).removeClass('active');
				} 
			});

			//add active class
			$(this).parent('li').addClass('active'); 

			//filter
			$container.find("div.box").each(function(){
				jQuery(this).animate({'opacity':'0.2'},300,'easeOutBack'); 
				jQuery(this).removeClass("filtered"); 
			});

			$container.find("div.box."+selector).each(function(){ 
				jQuery(this).animate({'opacity':'1'},300,'easeOutBack');
				jQuery(this).addClass("filtered"); 
			});

			//filter icon
			$navigation.find('li.sort_icon').addClass("filtered").animate({'opacity':'0.4'},300,'easeOutBack'); 

			//scroll
			$('html, body').animate({ scrollTop: $navigation.offset().top-20}, 300); 
		}); 

		$navigation.find('li.sort_icon').click(function(){
			$(this).removeClass("filtered").animate({'opacity':'1'},300,'easeOutBack'); 
			$navigation.find('li.active').removeClass('active');
			
			//remove filter
			$container.find("div.box").each(function(){ 
				jQuery(this).animate({'opacity':'1'},300,'easeOutBack');
				jQuery(this).addClass("filtered"); 
			});

		});		

		return false;
	}; 
})(jQuery);
 
//jplayer addon
jQuery(document).ready(function($){
	//hide page scroll		
	$('.jp-full-screen').click(function() {
		jQuery("html").css({"overflow":"hidden"});
		jQuery(".social_media_icons").css({"display":"none"});
	});

	$('.jp-restore-screen').click(function() {
		jQuery("html").css({"overflow":"scroll"});
		jQuery(".social_media_icons").css({"display":"block"});
	});

	//hide gui
	$("div.jp-container").hover(function(){
		if($(this).find(".jp-audio-container").hasClass("noposter")===false && $(this).find(".jp-gui").hasClass("noposter")===false) {
			$(this).find('.jp-gui, .jp-audio-container').stop().css({display:"block"}).animate({opacity:"1"},500);
		}
	},function(){	
		if($(this).find(".jp-audio-container").hasClass("noposter")===false && $(this).find(".jp-gui").hasClass("noposter")===false) {
			$(this).find('.jp-gui, .jp-audio-container').stop().delay(600).css({display:"block"}).animate({opacity:"0"},500);
		}
	});   
}); 


jQuery(function($){	
	$(".noposter").each(function(){
		$(this).parents(".jp-holder:eq(0)").css("display","block"); 
	});
}); 

//Carousel for product images
jQuery(window).load(function() {
	if (jQuery('#product_thumbnails').length>0){
	   jQuery('#product_thumbnails').jcarousel({scroll: 1});
	}
}); 

//RT Portfolio Effect
(function($){
	$.fn.rt_portfolio_effect = function(options) {
	var settings = $.extend({}, $.fn.rt_portfolio_effect.defaults, options);
 
			var portfolio_item=$(this);  
					
			portfolio_item.each(function(){
				var imageClass = jQuery(this).attr("class"); // get the class 
				var theImage = jQuery(this).html(); 		// save the image
				jQuery(this).find("img").addClass("active"); // mark image as active
				jQuery(this).append('<span class="imagemask">'+theImage+'<span class="icon-overlay"><span class="icon '+imageClass+'"></span></span></span>'); //create new image within span
			}); 
			jQuery('a.imgeffect .active').remove(); // remove duplicated images	
			
			//the effect
			portfolio_item.mouseover(function(){ 
				jQuery(this).find('span.icon-overlay').stop().animate({ opacity:"1"}, 300).find('.icon').stop().animate({ top:"50%"}, 300, "easeOutBack");  
		 
			}).mouseout(function(){
				jQuery(this).find('span.icon-overlay').stop().animate({ opacity:"0"}, 300);  
				jQuery(this).find('span.icon-overlay .icon').stop().animate({ top:"-60px"}, 300, "easeInBack");  
			});    			 
	}; 
})(jQuery);

jQuery(window).load(function() {
	jQuery('a.imgeffect').rt_portfolio_effect();
});




 /*
 * jQuery Easing Compatibility v1 - http://gsgd.co.uk/sandbox/jquery.easing.php
 *
 * Adds compatibility for applications that use the pre 1.2 easing names
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */

// check easing names
(function($){
	if(typeof easeIn != 'function'){

		jQuery.extend( jQuery.easing,
		{
			easeIn: function (x, t, b, c, d) {
				return jQuery.easing.easeInQuad(x, t, b, c, d);
			},
			easeOut: function (x, t, b, c, d) {
				return jQuery.easing.easeOutQuad(x, t, b, c, d);
			},
			easeInOut: function (x, t, b, c, d) {
				return jQuery.easing.easeInOutQuad(x, t, b, c, d);
			},
			expoin: function(x, t, b, c, d) {
				return jQuery.easing.easeInExpo(x, t, b, c, d);
			},
			expoout: function(x, t, b, c, d) {
				return jQuery.easing.easeOutExpo(x, t, b, c, d);
			},
			expoinout: function(x, t, b, c, d) {
				return jQuery.easing.easeInOutExpo(x, t, b, c, d);
			},
			bouncein: function(x, t, b, c, d) {
				return jQuery.easing.easeInBounce(x, t, b, c, d);
			},
			bounceout: function(x, t, b, c, d) {
				return jQuery.easing.easeOutBounce(x, t, b, c, d);
			},
			bounceinout: function(x, t, b, c, d) {
				return jQuery.easing.easeInOutBounce(x, t, b, c, d);
			},
			elasin: function(x, t, b, c, d) {
				return jQuery.easing.easeInElastic(x, t, b, c, d);
			},
			elasout: function(x, t, b, c, d) {
				return jQuery.easing.easeOutElastic(x, t, b, c, d);
			},
			elasinout: function(x, t, b, c, d) {
				return jQuery.easing.easeInOutElastic(x, t, b, c, d);
			},
			backin: function(x, t, b, c, d) {
				return jQuery.easing.easeInBack(x, t, b, c, d);
			},
			backout: function(x, t, b, c, d) {
				return jQuery.easing.easeOutBack(x, t, b, c, d);
			},
			backinout: function(x, t, b, c, d) {
				return jQuery.easing.easeInOutBack(x, t, b, c, d);
			}
		});
 
	}
})(jQuery);
