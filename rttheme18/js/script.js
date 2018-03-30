/*
	File Name: script.js
	by Tolga Can
	RT-Theme 18
*/


/* ******************************************************************************* 

	STICKY NAV

********************************************************************************** */  

(function($){
	"use strict";

		$(window).load(function() {	
			if( $(window).width() > 1024 ){ //window width bigger than 1024

				var header_height = "-100";
				var navigation_bar = $(".nav_shadow.sticky");
				var sticky_wrapper = $('<div class="sticky_nav_wrap"></div>').height( navigation_bar.outerHeight()  );

				if( navigation_bar.length > 0 ){					
					sticky_wrapper.insertBefore(navigation_bar);
					navigation_bar.appendTo(sticky_wrapper);
				

					sticky_wrapper.waypoint( {  
						offset: header_height,

							handler : function( direction ) {
								if ( direction === 'down' ) { 
									$(this).find(".nav_shadow").addClass( "stuck fadeInDown animated" ).removeClass("default_position");
								} else {
									$(this).find(".nav_shadow").removeClass( "stuck fadeInDown animated" ).addClass("default_position"); 
								}
							}

					});  
				}
			}
		});


})(jQuery); 


/* ******************************************************************************* 

	CHECK MOBILE

********************************************************************************** */
(function($){
	"use strict";
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		$("body").addClass("mobile_device");
	}
})(jQuery);  


/* ******************************************************************************* 

	PARALLAX BACKGROUNDS

********************************************************************************** */  

(function($){
	"use strict"; 

	if( ! $.fn.rt_parallax_backgrounds ){

		$.fn.rt_parallax_backgrounds = function(options)
		{ 
			$(this).each(function(){
				
				var row = $(this).parents("div:eq(0)"),
					row_height = row.outerHeight(),
					row_width = row.outerWidth(),
					row_inheight = row.height(), 
					row_paddings = row_height - row_inheight,
					holder_height = row_height*1.4,
					holder_width = row_width*1.4,
					effect = $(this).attr("data-rt-parallax-effect"), // vertical, horizontal
					direction = $(this).attr("data-rt-parallax-direction"), // -1 down/right , 1 up/left
					speed = 0.15;

				if( Modernizr.backgroundsize && !$("body").hasClass("mobile_device") ){

					if( effect == "horizontal" ){
						$(this).css({ "background-image":"url("+$(this).attr("data-rt-background-image")+")", "height":row_height+"px", "width":holder_width+"px" });	
					}else{
						$(this).css({ "background-image":"url("+$(this).attr("data-rt-background-image")+")", "height":holder_height+"px" });	
					}

					$(this).waypoint( { 
						triggerOnce: true,   
						offset: function() { 
							return $(window).height() + row_paddings;  
						},  
						handler: function() {    
							var visible_position = $(window).scrollTop();

							if( effect == "horizontal" ){
								$(this).rt_horizontal_parallax_effect({ row_width: row_width, holder_width: holder_width, visible_position: visible_position, speed: speed, direction: direction });
							}else{
								$(this).rt_vertical_parallax_effect({ row_height: row_height, holder_height: holder_height, visible_position: visible_position, speed: speed, direction: direction });	
							}
						}
					});

				}else{//fallback
				
					if( $("body").hasClass("mobile_device") ){ // mobile
						row.css({ 
								"background-image":"url("+$(this).attr("data-rt-background-image")+")",
								"background-size":"cover",
								"background-attachment":"scroll",
								"background-repeat":"no-repeat",
								"background-position":"center center"
							});	
						$(this).remove();

					}else{//ie8
						$(this).css({ "height":row_height+"px"});
						$(this).css({//ie8 fallback
							"filter" : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+$(this).attr("data-rt-background-image")+"', sizingMethod='scale')",
							"-ms-filter" : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+$(this).attr("data-rt-background-image")+"', sizingMethod='scale')"
						});
					}

				}	
 
			});
		} 
 
		$.fn.rt_horizontal_parallax_effect = function( options )
		{ 
			var $this = $(this),
				$window = $(window),
				invisible_part = options["holder_width"] - options["row_width"],
				start_position = options["direction"] == -1 ? -1 * invisible_part : 0;
				 

			if( start_position != 0 ) $this.rt_parallax_apply_css(start_position, 0 );//start position of the parallax layer

			$(window).scroll(function(event) { 
 
 				var move_rate = ( options["visible_position"] - $window.scrollTop() ) * options["speed"],
 					xPos =  options["direction"] == -1 ?  start_position - move_rate : move_rate; 
			
				if( xPos < -1 * invisible_part ) xPos = -1 * invisible_part; //max left position					
				if( xPos > 0 ) xPos = 0;  //max right position

				//apply the position
				$this.rt_parallax_apply_css(xPos, 0);
			});
		}	


		$.fn.rt_vertical_parallax_effect = function( options )
		{ 
			var $this = $(this),
				$window = $(window),
				invisible_part = options["holder_height"] - options["row_height"],
				start_position = options["direction"] == -1 ? -1 * invisible_part : 0 ;
 
			if( start_position != 0 ) $this.rt_parallax_apply_css(0, start_position );//start position of the parallax layer

			$(window).scroll(function(event) { 
 
 				var move_rate = ( options["visible_position"] - $window.scrollTop() ) * options["speed"],
 					yPos =  options["direction"] == -1 ?  start_position - move_rate : move_rate; 
			
				if( yPos < -1 * invisible_part ) yPos = -1 * invisible_part; //max bottom position					
				if( yPos > 0 ) yPos = 0;  //max top position

				$this.rt_parallax_apply_css(0, yPos);
			});
		}		


		$.fn.rt_parallax_apply_css = function( x, y )
		{ 

			var is_rtl = $("body").hasClass("rtl");

			//if it is rtl language make it reverse
			x = is_rtl ? -1 * x : x; 

			$(this).css({ 
				"-webkit-transform": "translate("+x+"px, "+y+"px)",
				"-moz-transform": "translate("+x+"px, "+y+"px)",
				"-ms-transform": "translate("+x+"px, "+y+"px)",
				"-o-transform": "translate("+x+"px, "+y+"px)",
				"transform": "translate("+x+"px, "+y+"px)"
			});
 
		}		
	}

	$(window).on('load resize', function() {  
		if ( $.fn.rt_parallax_backgrounds ) {  
			$('.rt-parallax-background').rt_parallax_backgrounds();   
		}
	}); 

})(jQuery); 


/* ******************************************************************************* 

	RT CONTENT ANIMATIONS

********************************************************************************** */  
 
(function($){
	"use strict"; 

	/* set waypoint elements */
	$.fn.rt_waypoint = function( group )
	{ 
		var i = 1, animate_item = ""; 

		if( group == "single" ){
			animate_item = $(this);
		}else{
			animate_item = $(this).find('[data-rt-animate="animate"]');
		}

		animate_item.each(function(i){
			$(this).waypoint( { 
				triggerOnce: true,   
				offset: function() { 
					return $(window).height()-50;  
				},  
				handler: function() {
					$(this).rt_start_animation(i);
				}
			});
		});
	}  

	/* start animations */
	$.fn.rt_start_animation = function(i)
	{ 
		var 
		delay = i*0.1,
		item = $(this), 
		easing = item.attr("data-rt-animation-type"),			
		group = item.attr("data-rt-animation-group"); 					
		item.addClass( easing + " animated ").css({'-webkit-animation-delay': (delay)+"s",'-moz-animation-delay': (delay)+"s",'-ms-animation-delay': (delay)+"s",'-o-animation-delay': (delay)+"s",'animation-delay': (delay)+"s"});	  
	} 

	/* check if content animations are activated */	
	if( rt_theme_params["content_animations"] && ! $("body").hasClass("mobile_device") ){		

		/* start scroll to load items */
		$(window).load(function() {	
			if ( $.fn.waypoint ) {  
				$('[data-rt-animation-group="group"]').each(function(i){			
					$(this).rt_waypoint("group");
				});		

				$('[data-rt-animation-group="single"]').each(function(i){			
					$(this).rt_waypoint("single");
				});						
			}
		});

		/* 
			set min-height for layer and flex slider  
			to prevent early loading for sub sections
		*/
		if( $('.top_content .ls-wp-container').length > 0 && $(window).width() > 1280 ){//layer slider
			$(".top_content").css({"min-height":$('.top_content .ls-wp-container').css("height")}); 
		}

		$(window).on('resize', function() {  
			if($('.top_content .ls-wp-container').length > 0 ){//layer slider
				$(".top_content").css({"min-height":"auto"}); 
			}
		});

		$('[data-flexfirstslide="true"]').each(function(){//flex slider
			$(this).parents(".flex-container:eq(0)").css({"min-height":$(this).attr("data-sliderminheight")}); 
		});

	}
})(jQuery); 


/* ******************************************************************************* 

	IMAGE PRELOAD v1.5  - https://github.com/farinspace/jquery.imgpreload  

********************************************************************************** */  
if("undefined"!=typeof jQuery){(function(a){a.imgpreload=function(b,c){c=a.extend({},a.fn.imgpreload.defaults,c instanceof Function?{all:c}:c);if("string"==typeof b){b=new Array(b)}var d=new Array;a.each(b,function(e,f){var g=new Image;var h=f;var i=g;if("string"!=typeof f){h=a(f).attr("src")||a(f).css('background-image').replace(/^url\((?:"|')?(.*)(?:'|")?\)$/mg, "$1");i=f}a(g).bind("load error",function(e){d.push(i);a.data(i,"loaded","error"==e.type?false:true);if(c.each instanceof Function){c.each.call(i)}if(d.length>=b.length&&c.all instanceof Function){c.all.call(d)}a(this).unbind("load error")});g.src=h})};a.fn.imgpreload=function(b){a.imgpreload(this,b);return this};a.fn.imgpreload.defaults={each:null,all:null}})(jQuery)}

/* ******************************************************************************* 

	PRELOADED IMAGES

********************************************************************************** */  
(function($){
	"use strict";

	if( ! $.fn.rt_imgpreload ){

		$.fn.rt_imgpreload = function(options)
		{ 
				var holder = $(this);
				var image = $(this).find("img"); 

				$( holder ).addClass("img_loading");

				image.imgpreload
				({
					each: function()
					{ 
						if( $(this).data('loaded') ){ 
							holder.removeClass("img_loading").addClass("img_loaded"); 
						}				
					}
				});
		}
		$(".imgeffect, .featured_image_holder, .product_boxes .featured_image").rt_imgpreload();  
	}

})(jQuery);  
/* ******************************************************************************* 

	RETINA LOGO

********************************************************************************** */  
(function($){
	"use strict"; 

	$.fn.rt_retina_logo = function(options) {
		if(window.devicePixelRatio > 1){ 
				var normal_size_logo = $(this); 
				var retina_logo = $(this).attr("data-retina");

				//get orginal w&h
				if( ! $(this).attr("data-width") ){
					var orginal_w = normal_size_logo.width(); 

					//store orginal dimensions
					$(this).attr("data-width",orginal_w);

				}else{
					var orginal_w = $(this).attr("data-width");
				}

				//apply the orginal dimensions to use for window resize
				$(this).css({"width":orginal_w});
	 
	 			//apply the retina logo on page load
				if( retina_logo != "" ){
					$(normal_size_logo).imgpreload({
						all: function(){ 
							$(this).css({"width":orginal_w}).attr("src", retina_logo);
						}
					});				
				}
		} 

	}; 

	//run the script
	$(window).on('load resize', function() {  
		$('#logo img:first-child').rt_retina_logo();
	});


})(jQuery); 


/* ******************************************************************************* 

	MULTI COLUMN MENUS

********************************************************************************** */  

(function($){
	"use strict";
 
	var top_level_items = $("#navigation > li.multicolumn");   
	var column_count = 5;

	top_level_items.each(function(){

		column_count = $(this).attr("data-column-size");				
		var $sub_menu = $(this).find("ul:eq(0)");
		$sub_menu.find("ul").removeClass("sub-menu"); 

		if( $sub_menu.length >0 ){
			$("<div class='multicolumn-holder'></div>").appendTo($(this));

			var $lists = $sub_menu, group;
			while( ( group = $lists.find('> li:lt('+column_count+')').remove() ).length){
				$('<ul/>').append(group).appendTo($(this).find(".multicolumn-holder"));
			}
			$lists.remove();				
		} 
	});

})(jQuery); 

/* ******************************************************************************* 
* 	Bowser - a browser detector
* 	https://github.com/ded/bowser
* 	MIT License | (c) Dustin Diaz 2013
********************************************************************************** */
!function(e,t){typeof define=="function"?define(t):typeof module!="undefined"&&module.exports?module.exports.browser=t():this[e]=t()}("bowser",function(){function g(){return n?{name:"Internet Explorer",msie:t,version:e.match(/(msie |rv:)(\d+(\.\d+)?)/i)[2]}:l?{name:"Opera",opera:t,version:e.match(d)?e.match(d)[1]:e.match(/opr\/(\d+(\.\d+)?)/i)[1]}:r?{name:"Chrome",webkit:t,chrome:t,version:e.match(/(?:chrome|crios)\/(\d+(\.\d+)?)/i)[1]}:i?{name:"PhantomJS",webkit:t,phantom:t,version:e.match(/phantomjs\/(\d+(\.\d+)+)/i)[1]}:a?{name:"TouchPad",webkit:t,touchpad:t,version:e.match(/touchpad\/(\d+(\.\d+)?)/i)[1]}:o||u?(m={name:o?"iPhone":"iPad",webkit:t,mobile:t,ios:t,iphone:o,ipad:u},d.test(e)&&(m.version=e.match(d)[1]),m):f?{name:"Android",webkit:t,android:t,mobile:t,version:(e.match(d)||e.match(v))[1]}:s?{name:"Safari",webkit:t,safari:t,version:e.match(d)[1]}:h?(m={name:"Gecko",gecko:t,mozilla:t,version:e.match(v)[1]},c&&(m.name="Firefox",m.firefox=t),m):p?{name:"SeaMonkey",seamonkey:t,version:e.match(/seamonkey\/(\d+(\.\d+)?)/i)[1]}:{}}var e=navigator.userAgent,t=!0,n=/(msie|trident)/i.test(e),r=/chrome|crios/i.test(e),i=/phantom/i.test(e),s=/safari/i.test(e)&&!r&&!i,o=/iphone/i.test(e),u=/ipad/i.test(e),a=/touchpad/i.test(e),f=/android/i.test(e),l=/opera/i.test(e)||/opr/i.test(e),c=/firefox/i.test(e),h=/gecko\//i.test(e),p=/seamonkey\//i.test(e),d=/version\/(\d+(\.\d+)?)/i,v=/firefox\/(\d+(\.\d+)?)/i,m,y=g();return y.msie&&y.version>=8||y.chrome&&y.version>=10||y.firefox&&y.version>=4||y.safari&&y.version>=5||y.opera&&y.version>=10?y.a=t:y.msie&&y.version<8||y.chrome&&y.version<10||y.firefox&&y.version<4||y.safari&&y.version<5||y.opera&&y.version<10?y.c=t:y.x=t,y});   

/* ******************************************************************************* 

	RT greyscale support for IE10+  

********************************************************************************** */
(function($){
	"use strict";

	$.fn.rt_greyscale = function(options) {
 		// If the browser is IE > 9
 		
		if ( ( bowser.msie && bowser.version > 9 ) ) {

	 		$(this).each(function(){
	 			$(this).removeClass("bw_filter").addClass("bw_filter_ie");
				var img_url = $(this).find("img").attr("src");
				var svg_image = '<svg style="position:absolute;top:0;left:0;z-index:1;" width="100%" height="100%" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><filter id="grayscale"><feColorMatrix type="saturate" values="0"/></filter><image class="bw" filter="url(#grayscale)" width="100%" height="100%" xlink:href="'+img_url+'" /></svg>';
				$(svg_image).appendTo($(this));	
			});
		}
	}; 

	//run the script
	$(window).on('load', function() {  
		$('.bw_filter').rt_greyscale();
	});

})(jQuery);


/* ******************************************************************************* 

	RT Fixed Rows  

********************************************************************************** */

//RT Fixed Rows  
(function($){
	"use strict";

	$.fn.rt_fixed_rows = function(options) {

	$(this).find('> .box').removeAttr('style');
	
	if( $(window).width() < 768 ){
		return false;
	}

	var settings = $.extend({}, $.fn.rt_fixed_rows.defaults, options);
	var fixed_rows = $(this);
		fixed_rows.each(function(){
			
			if( Modernizr.csstransforms3d ){
				$(this).find('> .box').css({'min-height':$(this).height() });
			}else{//ie9 or before
				$(this).find('> .box').attr('style', 'height: '+$(this).height()+'px');
			}


		});  
	}; 

	//run the script
	$(window).on('load resize', function() {  
		$('.extra_paddings > .row').rt_fixed_rows();
		$('.row.with_borders').rt_fixed_rows();	
	});

})(jQuery);


/* ******************************************************************************* 

	HOVER EFFECT FOR PRODUCT SHOWCASE

********************************************************************************** */ 
(function($){
	"use strict"; 

	$.fn.rt_product_hover_effect = function(options) {

		var settings = $.extend({}, $.fn.rt_product_hover_effect.defaults, options);
 
		$(this).on("mouseover mouseleave",function(event) { 

			var item_width = $(this).width(),
				item_height =  $(this).height(),
				product_info = $(this).find(".product_info"), 
				product_info_layer = $(this).find(".product_info > div"),
				featured_image = $(this).find(".featured_image");

			
			$(this).css({"overflow":"hidden"});

			if( $(window).width() > 550 ){
				product_info.css({
					"width":item_width+"px",
					"height":item_height+"px",
					"position":"absolute",
					"top":"0",
					"left":"0",
					"overflow":"auto",
					"display":"block",
					"opacity":"0",
				}).addClass("box_sizing animated"); 

				featured_image.addClass("animated");

				if(event.type == "mouseover"){ 
					product_info.css({"opacity":"1"}).addClass("fadeIn");
					
					if( product_info.length > 0 ){
						featured_image.css({"opacity":"0.07"}); 	
					} else{
						featured_image.css({"opacity":"0.5"}); 
					}
				}

				if(event.type == "mouseleave"){				 
					product_info.css({"opacity":"0"}).removeClass("fadeIn");
					featured_image.css({"opacity":"1"});
				}

			}
 

		}); 

	}; 

	//run the script
	$(window).on('load resize', function() {  
		$('.product-showcase .with_effect > .box').rt_product_hover_effect(); 
	});

})(jQuery);  


/* ******************************************************************************* 

	HOVER EFFECT FOR WOOCOMMERCE PRODUCTS  

********************************************************************************** */ 
(function($){
	"use strict"; 

	$.fn.rt_wc_product_hover_effect = function(options) {

		var settings = $.extend({}, $.fn.rt_wc_product_hover_effect.defaults, options);
 
		$(this).on("mouseover mouseleave",function(event) { 

			var item_width = $(this).width(),
				item_height =  $(this).height(),
				product_info = $(this).find(".product_info"),
				product_info_layer = $(this).find(".product_info > div"),
				onsale = $(this).find(".onsale"),
				featured_image = $(this).find(".featured_image");

			
			$(this).css({"overflow":"hidden"});

			if( $(window).width() > 550 ){
				product_info.css({
					"width":item_width+"px",
					"height":item_height+"px",
					"position":"absolute",
					"top":"0",
					"left":"0",
					"overflow":"auto",
					"display":"table",
					"opacity":"0",
				}).addClass("box_sizing").addClass("animated");

				product_info_layer.css({
					"display":"table-cell",
					"vertical-align":"middle",
				}).addClass("box_sizing").addClass("animated");

				featured_image.addClass("animated");

				if(event.type == "mouseover"){ 
					product_info.css({"opacity":"1"}).addClass("fadeIn");
					featured_image.css({"opacity":"0.03"});  
					onsale.css({"display":"none"});  
				}

				if(event.type == "mouseleave"){				 
					product_info.css({"opacity":"0"}).removeClass("fadeIn");
					featured_image.css({"opacity":"1"});
					onsale.css({"display":"block"});  
				}

			}
 

		}); 

	}; 

	//run the script
	$(window).on('load resize', function() {  
		$('.woocommerce.product_boxes .with_effect > .box').rt_wc_product_hover_effect(); 
	});

})(jQuery);  

/* ******************************************************************************* 

	MOBILE MENU

********************************************************************************** */  
(function($){
	"use strict";
	
		$("#mobile_bar .mobile_menu_control").on("click",function() {

			$("#header .sticky-wrapper, .nav_shadow").toggleClass("active"); 

			if( $("#header .sticky-wrapper").hasClass("active") || $(".nav_shadow").hasClass("active") ){
				$(this).removeClass("icon-menu").addClass("icon-menu-outline");

				//close the mobile tools bar if active
				if( $("#top_bar").hasClass("active") ){
					$("#mobile_bar .top_bar_control").trigger("click");
				}				
			}else{
				$(this).removeClass("icon-menu-outlineu").addClass("icon-menu"); 
			}

		});
		
		   
})(jQuery);  


/* ******************************************************************************* 

	MOBILE TOOLS ICON

********************************************************************************** */  
(function($){
	"use strict";
	
		$("#mobile_bar .top_bar_control").on("click",function() {

			$("#top_bar").toggleClass("active");  

			if( $("#top_bar").hasClass("active") ){
				$(this).removeClass("icon-cog").addClass("icon-up-open");

				//close the mobile menu if active
				if( $("#header .sticky-wrapper").hasClass("active") || $(".nav_shadow").hasClass("active") ){
					$("#mobile_bar .mobile_menu_control").trigger("click");
				}				
			}else{
				$(this).removeClass("icon-up-open").addClass("icon-cog");
			}

		});
		
		   
})(jQuery);  


/* ******************************************************************************* 

	START CAROUSELS

********************************************************************************** */    
 
(function($){
	"use strict";
	$.fn.rt_start_carousels = function(items,style) {

		var change_width;
		var new_width;
		var autoHeight_;
		var add;
		var parent_holder;   
		var sidebar_element;
		var carousel_holder = $(this);					

		if( style != "rounded_carousel" ){
			//change holder width
			change_width = carousel_holder.width( carousel_holder.width() + 20 );
			new_width = carousel_holder.width();

			//change margin
			if( $("body").hasClass("rtl") ){//rtl language	
				carousel_holder.css({ "marginRight" : "-10px" });					
			}else{
				carousel_holder.css({ "marginLeft" : "-10px" });						
			}
		} 

		//auto height
		if( items == 1 ){
			autoHeight_ = true;
		}else{
			autoHeight_ = false;
		}

		//check if this element in a floating sidebar
		if( carousel_holder.parents(".sidebar.sticky").length > 0 ){
			autoHeight_ = false;
		} 

		//start carousel
		var carousel = carousel_holder.find(".owl-carousel"); 

		carousel.owlCarousel({   
			autoHeight: autoHeight_,
			items: items,
			itemsDesktop: false,
			itemsDesktopSmall : [768,items],
			itemsTablet: [767,1], 
			itemsMobile: [479,1],
			navigation : true,
			pagination: false,
			navigationText : ["<span class=\"icon-left-open\"></span>","<span class=\"icon-right-open\"></span>"],
			rewindNav : true,
			lazyLoad : true,
			scrollPerPage : false,				 
			slideSpeed : 400,
			paginationSpeed : 600,
			responsive: true,
			responsiveRefreshRate: 0,
			responsiveBaseWidth:window,
			autoPlay: 12000, // 12 seconds

			beforeUpdate:function(){
				if( style != "rounded_carousel" ){
					//change holder width
					change_width = 0;
					carousel_holder.removeAttr("style");

					change_width = carousel_holder.width( carousel_holder.width() + 20 );
					new_width = carousel_holder.width();

					//change margin
					if( $("body").hasClass("rtl") ){//rtl language	
						carousel_holder.css({ "marginRight" : "-10px" });					
					}else{
						carousel_holder.css({ "marginLeft" : "-10px" });						
					}
				}
			},


			afterInit:function(){ //fix controller positions
				add = 42; 				
				parent_holder = carousel.parents(".carousel-holder:eq(0)");

				if( parent_holder.hasClass("with_heading") ){
					if( parent_holder.hasClass("rounded_carousel_holder") ){
						add = add + 10;
					} 
					carousel.find(".owl-controls").css({"top": -1 * (  add + ( ( parent_holder.prev(".title_line").height() - 25 ) / 2 ) ) +"px"});
				}	

			}
		});
	}; 	

})(jQuery); 


/* ******************************************************************************* 

	FIX TOP BAR SEARCH FORM WIDTH

********************************************************************************** */    
 
(function($){
	"use strict";
	if( $("#top_search_field").length > 0 ){
		var value_length = $("#top_search_field").val().length;
		var isiPad = navigator.userAgent.match(/iPad/i) != null;
		var add_value; 

		if( isiPad ){
			add_value = value_length;

		}else{
			add_value = value_length - 2;
		}

		if( value_length > 4 ){
			$("#top_search_field").attr("size", add_value );	
		}
	}
})(jQuery); 


/* ******************************************************************************* 

	CUSTOM SELECT BOXES

********************************************************************************** */    
 
(function($){
	"use strict";

	$(window).load(function(){
	if ( $.isFunction($.fn.customSelect) ) {
		$('.orderby, .variations select, .widget .menu.dropdown-menu').customSelect( { customClass: "wooselect" } );
	}
});
 
})(jQuery); 


/* ******************************************************************************* 

	MOBILE NAVIGATION

********************************************************************************** */    
(function($){
	"use strict";
	$('#MobileMainNavigation').change(function() {	
		window.location.href = $(this +'option:selected').val();
	});
})(jQuery); 


/* ******************************************************************************* 

	TABLET NAVIGATION FIX FOR DEACTIVE STATE

********************************************************************************** */    
(function($){
	"use strict";
	$("#container").on("click",function() { 
		return true;
	});
})(jQuery); 


/* ******************************************************************************* 

	SLIDE TO TOP

********************************************************************************** */  
(function($){
	"use strict";
	$(".line span.top").click(function() {
		$('html, body').animate( { scrollTop: 0 }, 'slow' );
	});
})(jQuery); 


/* ******************************************************************************* 

	LIGHTBOX PLUGIN

********************************************************************************** */    
(function($){
	"use strict";
	if ($.jackBox){
		$(".lightbox_[data-group]").jackBox("init", { preloadGraphics: false, baseName: rt_theme_params["rttheme_template_dir"] +"/js/lightbox", className: ".lightbox_", deepLinking : false, socialMedia : false, showInfoByDefault: true});  
	}
})(jQuery); 


/* ******************************************************************************* 

	PLAYER PLUGIN

********************************************************************************** */    
(function($){
	"use strict";
	if(typeof mejs != 'undefined') {
		$('.progression-single').css({width:"100%",height:"100%"});
		$('.progression-single').mediaelementplayer({ 
			startVolume: 0.5, // initial volume when the player starts
			features: ['playpause','current','progress','duration','tracks','volume','fullscreen']
		});
	}
})(jQuery); 


/* ******************************************************************************* 

	RT form field - text back function

********************************************************************************** */  

(function($){
	"use strict";
	var val;
	var form_inputs=$(".showtextback");

	form_inputs.each(function(){
	
		$(this).focus( function()
		{
			val = $(this).val();
			if ($(this).attr("alt") != "0"){
				$(this).attr("alt",$(this).attr("value")); 
				$(this).attr("value","");
			}
		});
	
		$(this).blur( function(){
			if ($(this).attr("alt") != "0"){
				val = $(this).val(); 
				if (val == '' || val == $(this).attr("alt")){
					$(this).attr("value",$(this).attr("alt"));
				}
			}
		});
	
		$(this).keypress( function(){  
			$(this).attr("alt","0");	    
		});                 
	});  

})(jQuery); 

/* ******************************************************************************* 

	JQUERY TABS

********************************************************************************** */  
(function($){
	"use strict";
	$("ul.tabs").tabs("> .panes > .pane", {effect: 'fade'});

	//height fix for vertical tabs
	$(".vertical_tabs").each(function() {
		
		var tab_nav = $(this).find(".tabs"),
			tab_nav_height = tab_nav.height(),
			pane = $(this).find(".pane");
 
			pane.each(function() {
				$(this).css({"min-height":tab_nav_height-41+"px"});
			}); 

	}); 

})(jQuery);


/* ******************************************************************************* 

	SEARCH FIELD ALIGNMENT

**********************************************************************************  
(function($){
	"use strict";
	$(window).load(function() { 
		var new_search_location = ( $('#navigation_bar').width() - $('#navigation').width() - 118 ) / 2; 
		if(new_search_location<60) $("#navigation_bar .search-bar").css("right",""+new_search_location+"px");   
	}); 
})(jQuery); 
*/ 


/* ******************************************************************************* 

	SUBMIT SEARCH FORMS

********************************************************************************** */  
(function($){
	"use strict";
	$("#menu_search .icon-search-1, #top_search_form .icon-search").on("click",function() {  
		$(this).parents("form:eq(0)").submit(); 
	}); 
})(jQuery); 


/* ******************************************************************************* 

	CLOSE INFO BOX

********************************************************************************** */  
(function($){
	"use strict";
	$(document.body).on("click",".info_box .icon-cancel",function() { 
		$(this).parent(".info_box").fadeOut();
	}); 
})(jQuery); 


/* ******************************************************************************* 

	FIX FEATURES COLUMN POSITION

********************************************************************************** */  
 
(function($){
	"use strict"; 
	var features;
	var table = $(".pricing_table.compare");

	$(table).each(function(i){

		var start_position_element = $(this).find(".start_position");

		var features_list = $(this).find(".table_wrap.features ul"); 

		var new_offset =  start_position_element.offset().top - $(this).offset().top; 

		features_list.css("top",new_offset-1);
	});


	//copy features to each column for mobile
	$(table).each(function(){

		features=[];
		//createa features array from the first row
		$(this).find(".table_wrap.features li").each(function(){
			features.push( $(this).html() );
		});

	});


	$(table).find(".table_wrap").each(function(i){

		if( $(this).hasClass("features") == "" ){
			var i = 0;
			$(this).find("li").each(function(){
				$(this).prepend('<div class="visible_small_screen">'+features[i]+'</div>'); 
			i++;
			});
		} 
	});
})(jQuery); 
 

/* ******************************************************************************* 

	FORM VALIDATION

********************************************************************************** */  
jQuery(function($){ 
	"use strict";
	// show a simple loading indicator
	var loader = $('<img src="'+rt_theme_params["rttheme_template_dir"]+'/images/loading.gif" alt="..." />').appendTo(".loading");
		loader.hide(); 	

	$(".validate_form").each(function(){ 	
		var result = $(this).parents(".contact_form").find(".result");
		
		if( $.isFunction($.fn.validate) ) {
			$.validator.messages.required = "";
			var v = $(this).validate({
				  submitHandler: function(form) {
						  $(form).ajaxSubmit({
							target: result,
							beforeSubmit:  function() {loader.show()},
							url: rt_theme_params["ajax_url"],
							data: { action: 'rt_ajax_contact_form' },
							success:   function() {loader.hide()}
							});
				  }
			});

		} 
	});
});



/* ******************************************************************************* 

	TOGGLE - ACCORDION

********************************************************************************** */  
(function($){
	"use strict";

		$(".rt-toggle .toggle-content").hide(); 
		$(".rt-toggle .open .toggle-content").show();  
		
		$(".rt-toggle ol li .toggle-head").click(function(){ 
 
			if($(this).parent("li").hasClass("open")){ 
				$(this).parent("li").removeClass("open").find(".toggle-content").stop().slideUp(300);  
			}else{
				$(this).parents("ol").find("li.open").removeClass("open").find(".toggle-content").stop().slideUp(300);  
				$(this).parent("li").addClass("open").find(".toggle-content").stop().slideDown(300, "easeInQuad");	
			} 
		});

})(jQuery); 



/* ******************************************************************************* 

	TOOLTIPS

********************************************************************************** */  
(function($){
	"use strict";
 
	if( $.isFunction($.fn.colorTip) ) {
		$('.j_ttip').colorTip({color:''});
	}

})(jQuery); 


/* ******************************************************************************* 

	MAKE CONTENT HEIGHT EQUAL TO SIDEBAR

********************************************************************************** */  
 
(function($){
	"use strict";

	var $sidebar = jQuery(".sidebar");    

	$sidebar.each(function(){
		var sidebarH = $(this).height();
		var parentContent = $(this).prev(".content");  
		var parentContentHeight = parentContent.height();  
		var the_heigtest_part = Math.max(0,parentContentHeight,sidebarH);
		parentContent.css("min-height",the_heigtest_part);

	});

})(jQuery); 


/*
 * getStyleObject Plugin for jQuery JavaScript Library
 * From: http://upshots.org/?p=112
 */

(function($){
	"use strict";
	$.fn.getStyleObject = function(){
		var dom = this.get(0);
		var style;
		var returns = {};
		if(window.getComputedStyle){
			var camelize = function(a,b){
				return b.toUpperCase();
			};
			style = window.getComputedStyle(dom, null);
			for(var i = 0, l = style.length; i < l; i++){
				var prop = style[i];
				var camel = prop.replace(/\-([a-z])/g, camelize);
				var val = style.getPropertyValue(prop);
				returns[camel] = val;
			};
			return returns;
		};
		if(style = dom.currentStyle){
			for(var prop in style){
				returns[prop] = style[prop];
			};
			return returns;
		};
		return this.css();
	}
})(jQuery);
/* ******************************************************************************* 

	CHROME  FIXED BACKGROUND FIX

	Fixes Chrome bug when css animations used inside .top_content background-attachment:fixed redrawing
	This will be reemoved once Chrome fixes its bug.

********************************************************************************** */  
(function($){ 
	"use strict";

	if (/chrome/.test(navigator.userAgent.toLowerCase())) {
		$(".content_block_background").each(function() {		
			$(this).css("background-attachment", "scroll");			
		});  
	}
  
})(jQuery); 

/* ******************************************************************************* 

	RT GOOGLE MAPS

********************************************************************************** */  
  
(function($){
	"use strict";

	$.rt_maps = function(el, locations, zoom){

		var base = this; 
		base.init = function(){ 
			// initialize google map
			if(locations.length>0) google.maps.event.addDomListener(window, 'load', $.fn.rt_maps());  

		};
 
		if(locations.length>0) base.init();
	}; 

	$.fn.rt_maps = function(locations, zoom){		 

		var map_id = $(this).attr("id");  
 
		//holder height
		var height = $('[data-scope="#'+map_id+'"]').attr("data-height");   

		if ( height > 0 ){
			$(this).css({'height':height+"px"});
		}

		//api options
		var myOptions = {
			zoom: zoom,
			panControl: true,
			zoomControl: true,
			scaleControl: true,			
			streetViewControl: false,
			overviewMapControl: false,
			scrollwheel : false,
			navigationControl: true,
			center: new google.maps.LatLng(0, 0),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}			 
 
		var map = new google.maps.Map( document.getElementById(map_id), myOptions);		

		//B&W Map
		var bwmap = $('[data-scope="#'+map_id+'"]').attr("data-bw");   

		if ( typeof bwmap !== "undefined" && bwmap != "" ){
			// Create an array of styles.
			var styles = [
				{
					stylers: [
						{ hue: "#fff" },
						{ saturation: -100 },
						{ lightness: 0 },
						{ gamma: 1 }
					]
				} 
			];
			// Create a new StyledMapType object, passing it the array of styles,
			// as well as the name to be displayed on the map type control.
			var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});	

			//Associate the styled map with the MapTypeId and set it to display.
			map.mapTypes.set('map_style', styledMap);
			map.setMapTypeId('map_style');
		}
				
		$.fn.setMarkers(map, locations);

		$.fn.fixTabs(map,map_id,zoom);
	};

	$.fn.setMarkers = function (map, locations) {
		 

		if(locations.length>1){
			var bounds = new google.maps.LatLngBounds();	 
		}else{
			var center = new google.maps.LatLng(locations[0][1], locations[0][2]);
			map.panTo(center);			
		}


		for (var i = 0; i < locations.length; i++) {
			if (locations[i] instanceof Array) {
				var location = locations[i];
				var myLatLng = new google.maps.LatLng(location[1], location[2]);
				var marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					animation: google.maps.Animation.DROP,
					draggable: false,
					title: location[0]
				});

				$.fn.add_new_event(map,marker,location[4]);
				if(locations.length>1) bounds.extend(myLatLng);
			}
		}

		if(locations.length>1)  map.fitBounds(bounds);
	};
	 
	$.fn.add_new_event = function (map,marker,content) {

	  if(content){
			var infowindow = new google.maps.InfoWindow({
				content: content,
				maxWidth: 300
			});
			google.maps.event.addListener(marker, 'click', function() {;
			infowindow.open(map,marker);
		});
	  }
	}; 

	$.fn.fixTabs = function (map,map_id,zoom) {
		var tabs_wrap = $("#"+map_id).parents(".tabs_wrap:eq(0)");  
		$(".tabs_wrap > ul > li").on("click",  { map: map } , function() { 
			var c = map.getCenter();  
			google.maps.event.trigger(map, 'resize'); 
			map.setZoom(zoom); 
			map.setCenter(c);  
		});
 
	};	
})(jQuery);

/* ******************************************************************************* 

	FLOATING SIDEBARS

********************************************************************************** */  
(function($){ 
	"use strict";

	//check woo chart widget
	if( $(".sidebar.sticky").find(".widget_shopping_cart").length > 0 ){
		return false;
	}

	//work if windown wider than 960
	if( $(window).width() > 1024 ){
		$(window).load(function(){
			var $window = $(window);
			var $sidebar = $(".sidebar.sticky"); 
			var $stickyHeaderFields = "#wpadminbar, .nav_shadow.stuck"; 
			

			setTimeout(function() { 
				$sidebar.each(function(){

					var $content_block = $(this).parents(".content_block:eq(0)");  	
					var $content = $(this).prev(".content");  
					var $sidebar = $(this);

					if($sidebar.length>0){
		 
						var sidebarHeight = $sidebar.height();   
						var contentHeight = $content.height();  
						var sidebar_position = $sidebar.position().top; 

						if(contentHeight>sidebarHeight){
							$window.scroll(function(event) {

								if( ! $sidebar.hasClass('fixed') ){
									$sidebar.addClass('fixed');
								}									
								
								var $content_block_top = $content_block.offset().top;
								var $addHeigth = 20; //20px padding from top

								//sticky fields on top 
								$($stickyHeaderFields).each(function(){ 
									$addHeigth = $addHeigth + $(this).height(); 
								}); 

								//sidebar new position
								var scrollTop = $window.scrollTop() + $addHeigth;    
								var topPosition = -1 * Math.min( 0 , $content_block_top - scrollTop );  						 
								var topPosition =  Math.min(  contentHeight - ( sidebar_position + ( sidebarHeight ) ) , topPosition );

								$sidebar.css('top', topPosition ); 	
								
							});
						}
					}
				});
			},1000);
		});
	}  
})(jQuery);


/* ******************************************************************************* 

	PAGE lOADING

********************************************************************************** */  
(function($){
	"use strict";
	
	if( rt_theme_params["page_loading"] ){

		$(window).load(function() {	
			$(".rt_loading").css({"display":"none"});
		});
	}
})(jQuery); 


/* ******************************************************************************* 

	DOUBLE TAP FOR TOUCH DEVICES

	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License

	- modified for RT-Theme 18
********************************************************************************** */  

(function( $, window, document, undefined ){
	"use strict";

	$.fn.doubleTapToGo = function( params )
	{
		if( ! Modernizr.touch ){
			return false;
		}

		this.each( function()
		{
			var curItem = false;

			$( this ).on( 'click', function( e )
			{
				var item = $( this );
				if( item[ 0 ] != curItem[ 0 ] )
				{
					e.preventDefault();
					curItem = item;
				}
			});

			$( document ).on( 'click touchstart MSPointerDown', function( e )
			{
				var resetItem = true,
					parents	  = $( e.target ).parents();

				for( var i = 0; i < parents.length; i++ )
					if( parents[ i ] == curItem[ 0 ] )
						resetItem = false;

				if( resetItem )
					curItem = false;
			});
		});
		return this;
	};
	
	
	if( $(window).width() > 960 ){//check window width	
		if( $( '.rev_slider_wrapper' ).length > 0 ){ //check rev slider
			$( '#navigation li:has(ul)' ).doubleTapToGo();	
		}
	}

})( jQuery, window, document );




/* ******************************************************************************* 
	
	DOUBLE TAP FIX FOR IOS MOBILE MENU
	Addresses the double tapping bug on IOS devices which started after IOS 8.4.1 
	
********************************************************************************** */  

(function( $, window, document, undefined ){
	"use strict";

	$.fn.singleTapFix = function( params )
	{
		if( ! Modernizr.touch ){
			return false;
		}

		this.each( function()
		{
			var curItem = false;

			$( this ).on( 'touchstart', function( e )
			{	
				return this;
			});

		});

		return this;
	};
	
	
	if( $(window).width() < 960 ){//check window width	 
		$( '#navigation a' ).singleTapFix();	 
	}

})( jQuery, window, document );