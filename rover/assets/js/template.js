/*-----------------------------------------------------------------------------------*/
/*	Template JS By Theme Record
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Functions
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){
	theme_fixed_ie();
	theme_go_to_top();
	theme_main_menu();
	theme_external_link();
	theme_announcement();
	theme_min_height();
	theme_link_rollovers();
	theme_placeholder();
	theme_video_player();
	theme_audio_player()
	theme_fancybox();
	theme_jcarousel();
	theme_widget_jcarousel();
	theme_home_slideshow();
	theme_portfolio_gallery();
	theme_product_gallery();
	theme_gallery();
	theme_blog_gallery();
	theme_image_hover('body');
	theme_image_preload();
	theme_portfolio_quicksand();
	theme_tabs();
	theme_toggles();
	theme_accordions();
	theme_google_maps();
	theme_responsive_media();
	theme_checkout();
	if ( jQuery().mobileMenu ) { jQuery('.drop-menu').mobileMenu(); }
});



 /*-----------------------------------------------------------------------------------*/
/*	Fix IE quirks
/*-----------------------------------------------------------------------------------*/
function theme_fixed_ie() {
	if (jQuery.browser.msie && jQuery.browser.version == '7.0' ) {
		jQuery('body').addClass('ie7');
	}
}



 /*-----------------------------------------------------------------------------------*/
/*	Checkout
/*-----------------------------------------------------------------------------------*/
function theme_checkout() {
	jQuery('.shopping-cart-list').live('submit',function(){
		var order_total         = jQuery('#order_total').val();
		var cart_products       = jQuery('#cart_products').val();
		var cart_products_qty   = jQuery('#cart_products_qty').val();
		var shopping_fee_total  = jQuery('#shopping_fee_total').val();

		jQuery.ajax({
			type:'POST', 
			url:js_params.ajaxurl, 
			data: {
				action:'shop_checkout',
				order_total: order_total,
				cart_products: cart_products,
				cart_products_qty: cart_products_qty,
				shopping_fee_total: shopping_fee_total
			},
			dataType: 'json',
			beforeSend: function() {
			},
			success:function(data) {
				// do something
			}
		});
	});
}




/*-----------------------------------------------------------------------------------*/
//	Go Top
/*-----------------------------------------------------------------------------------*/
function theme_go_to_top(){
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#toTop').fadeIn();	
		} else {
			jQuery('#toTop').fadeOut();
		}
	});
	jQuery('#toTop').click(function() {
		jQuery('body,html').animate({scrollTop:0},300);
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Main menu
/*-----------------------------------------------------------------------------------*/
function theme_main_menu() {

	//DDsmoothmenu
	ddsmoothmenu.init({
		mainmenuid: "top-menu", 
		orientation: "h", 
		classname: "ddsmoothmenu", 
		contentsource: "markup" 
	});

	jQuery( '.tax-portfolio-category, .tax-product-category, .tax-gallery-category, .single-portfolio , .single-product, .single-gallery, .error404, .search' ).addClass( 'nocurrent' );

	//Add LavaLamp for menu
	if ( jQuery().lavaLamp ) {
		 jQuery( '.sub-menu li, .children li' ).attr( 'class', 'noLava' ); 
	     jQuery( '.current-menu-item, .current_page_item, .current-page-ancestor, .current-menu-parent, .current_page_parent' ).addClass( 'selectedLava' );
	     jQuery( 'ul.drop-menu' ).lavaLamp({ fx: 'swing', speed: 500 });
	}

	// Subtle slide animation for sub-menus
	jQuery('ul.drop-menu li ul li').find('a').hover (
		function(){
			jQuery(this).animate({ paddingLeft: '20'}, 200)
		},
		function()
		{
			jQuery(this).animate({ paddingLeft: '15'}, 200)				
		}
	);
}



/*-----------------------------------------------------------------------------------*/
/*	External links
/*-----------------------------------------------------------------------------------*/
function theme_external_link() {
	jQuery('a[rel*=external]').click( function() {
		window.open(this.href);
		return false;
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Top announcement
/*-----------------------------------------------------------------------------------*/
function theme_announcement() {
	if(jQuery.cookie('ts-hide-banner')=='1'){
		jQuery('#announcement').hide();
	}else{
		jQuery('#announcement').show();
	}

	jQuery('#announcement .close-announcement').click(function(){
		jQuery('#announcement').slideUp(500,'easeInOutQuad');
		jQuery.cookie('ts-hide-banner','1',{path:'/'});
		return false;
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Min Height
/*-----------------------------------------------------------------------------------*/
function theme_min_height() {
	function set_min_height() {
		jQuery('#main').css('min-height',
			jQuery(window).outerHeight(true)
			- ( jQuery('body').outerHeight(true)
			- jQuery('body').height() )
			- jQuery('#site-head').outerHeight(true)
			- jQuery('.homepage-slideshow-warp').outerHeight(true)
			- jQuery('.site-page-header').outerHeight(true)
			- ( jQuery('#main').outerHeight(true) - jQuery('#main').height() )
			- jQuery('.footer-widgets-area').outerHeight(true)
			- jQuery('.footer-contact-info').outerHeight(true)
			- jQuery('.footer-message').outerHeight(true)
		);
	}
	set_min_height();
	// Window resize
	jQuery(window).on('resize', function() {
		var timer = window.setTimeout( function() {
			window.clearTimeout( timer );
			set_min_height();
		}, 30 );
	});
}




/*-----------------------------------------------------------------------------------*/
/*	Rollovers
/*-----------------------------------------------------------------------------------*/
function theme_link_rollovers() {

	//Post Formart
	jQuery('.post-blog .post .post-meta .link a').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.post_format_hover_bgcolor},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.post_format_bgcolor},300);
		e.preventDefault();
	});
	

	//Read More
	jQuery('.blog-list .post-entry .more-link, .search-lists li .post-more a').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.read_more_hover_bgcolor},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.read_more_bgcolor},300);
		e.preventDefault();
	});


	//Single Post Pagination
	jQuery('.single-post-pagenation li a').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.single_post_pagenation_hover_bgcolor},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.single_post_pagenation_bgcolor},300);
		e.preventDefault();
	});


	//Comment Submit
	jQuery('#commentform input[type="submit"]').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.comment_submit_hover_bgcolor},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.comment_submit_bgcolor},300);
		e.preventDefault();
	});


	//Send Message Submit
	jQuery('.contact-page input[type="submit"]').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.send_message_hover_bgcolor},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.send_message_bgcolor},300);
		e.preventDefault();
	});


	//Footer Socials
	jQuery('#social-networking li a#twitter').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#1DCAFF'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});

	jQuery('#social-networking li a#facebook').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#3B5998'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});

	jQuery('#social-networking li a#dribbble').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#EC6197'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});

	jQuery('#social-networking li a#flickr').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#FF0084'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});

	jQuery('#social-networking li a#linkedin').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#3BB0EB'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});

	jQuery('#social-networking li a#google').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#E83A37'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});

	jQuery('#social-networking li a#vimeo').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#9FC541'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});

	jQuery('#social-networking li a#picasa').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#FFD500'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});

	jQuery('#social-networking li a#feed').hover(function(e) {
		jQuery(this).stop().animate({backgroundColor:'#FF6600'},500);
	},
	function(e) {
		jQuery(this).stop().animate({backgroundColor:'#'+globalVars.footer_media_bgcolor},300);
		e.preventDefault();
	});
}


/*-----------------------------------------------------------------------------------*/
/*	Placeholder
/*-----------------------------------------------------------------------------------*/
function theme_placeholder() {
	jQuery('input, textarea').placeholder();
}


/*-----------------------------------------------------------------------------------*/
/*	Video Player
/*-----------------------------------------------------------------------------------*/
function theme_video_player() {

	//Video Player
	var $player = jQuery('.video-js');

	if( $player.length ) {

		function adjustPlayer() {
		
			$player.each(function( i ) {

				var $this        = jQuery(this)
					playerWidth  = $this.parent().width(),
					playerHeight = playerWidth / ( $this.children('.vjs-tech').data('aspect-ratio') || 1.78 );

				if( playerWidth <= 300 ) {
					$this.addClass('vjs-player-width-300');
				} else {
					$this.removeClass('vjs-player-width-300');
				}

				if( playerWidth <= 250 ) {
					$this.addClass('vjs-player-width-250');
				} else {
					$this.removeClass('vjs-player-width-250');
				}

				$this.css({
					'height' : playerHeight,
					'width'  : playerWidth
				})
				.attr('height', playerHeight )
				.attr('width', playerWidth );

			});

		}

		adjustPlayer();

		jQuery(window).on('resize', function() {

			var timer = window.setTimeout( function() {
				window.clearTimeout( timer );
				adjustPlayer();
			}, 30 );

		});

	}

	//End Video Player

}




/*-----------------------------------------------------------------------------------*/
/*	Audio Player
/*-----------------------------------------------------------------------------------*/
function theme_audio_player() {

	var $player = jQuery('.APV1_wrapper');

		if( $player.length ) {

			$player.each(function( i ) {

				var $this = jQuery(this);

				$this.prev('audio').hide().end()
					 .wrap('<div class="audio-inner" />');

			});

			function adjustPlayer( resize ){
			
				$player.each(function( i ) {

					var $this            = jQuery(this),
						$lis             = $this.children('li'),
						$progressBar     = $this.children('li.APV1_container'),
						playerWidth      = $this.parent().width(),
						lisWidth         = 0;

					if( !resize )
						$this.prev('audio').hide()

					if( playerWidth <= 300 ) {
						$this.addClass('APV1_player_width_300');
					} else {
						$this.removeClass('APV1_player_width_300');
					}

					if( playerWidth <= 250 ) {
						$this.addClass('APV1_player_width_250');
					} else {
						$this.removeClass('APV1_player_width_250');
					}

					if( playerWidth <= 200 ) {
						$this.addClass('APV1_player_width_200');
					} else {
						$this.removeClass('APV1_player_width_200');
					}

					$lis.each(function() {

						var $li = jQuery(this);
						lisWidth += $li.width()

					});

					$this.width( $this.parent().width() );
					$progressBar.width( playerWidth - ( lisWidth - $progressBar.width() ) );
					
				});

			}

			adjustPlayer();

			jQuery(window).on('resize', function() {

				var timer = window.setTimeout( function() {
					window.clearTimeout( timer );
					adjustPlayer( resize = true );
				}, 30 );

			});

	}
}





/*-----------------------------------------------------------------------------------*/
/*	Quicksand
/*-----------------------------------------------------------------------------------*/
function theme_portfolio_quicksand() {
	var $data = jQuery('.portfolio-sortable-grid').clone();
	
	jQuery('.portfolio-sortable-menu li').click(function(e) {
		jQuery(".filter li").removeClass("active");	
		var filterClass=jQuery(this).attr('class').split(' ').slice(-1)[0];
		
		if (filterClass == 'all-items') {
			var $filteredData = $data.find('.item');
		} else {
			var $filteredData = $data.find('.item.' + filterClass );
		}
		jQuery('.portfolio-sortable-grid').quicksand($filteredData, {
			duration: 500,
			useScaling: false,
			easing: 'swing',
			adjustHeight: 'dynamic',
			enhancement: function() {
				theme_image_hover('body');
				theme_remove_image_preload();
			}		
		});
		jQuery(this).addClass('active');			
		return false;
		e.preventDefault();
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Fancybox
/*-----------------------------------------------------------------------------------*/
function theme_fancybox() {
	jQuery('.fancybox').fancybox({
		'overlayShow'	: true,
		'overlayColor'		: '#000',
		'autoScale'		:	true,
		'titleShow'		: 	false
	});

	jQuery('.wp-caption a').fancybox({
		'overlayShow'	: true,
		'overlayColor'		: '#000',
		'autoScale'		:	true,
		'titleShow'		: 	false
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Jcarousel
/*-----------------------------------------------------------------------------------*/
function theme_jcarousel() {

	var $carousel = jQuery('.post-carousel ul');
	var $easingType= 'easeOutCubic';

	if( $carousel.length ) {

		var scrollCount;

		if( jQuery(window).width() < 480 ) {
			scrollCount = 1;
		} else if( jQuery(window).width() < 768 ) {
			scrollCount = 2;
		} else if( jQuery(window).width() < 960 ) {
			scrollCount = 3;
		} else {
			scrollCount = 4;
		}

		$carousel.jcarousel({
			animation : 1000,
			easing    : $easingType,
			scroll    : scrollCount
		});
	}
}




/*-----------------------------------------------------------------------------------*/
/*Widget Jcarousel
/*-----------------------------------------------------------------------------------*/
function theme_widget_jcarousel() {

	var $carousel = jQuery('.widget-carousel ul');
	var $easingType= 'easeOutCubic';

	if( $carousel.length ) {

		$carousel.jcarousel({
			animation : 1000,
			easing    : $easingType,
			scroll    : 1
		});
	}
}




/*-----------------------------------------------------------------------------------*/
/*	Portfolio Gallery
/*-----------------------------------------------------------------------------------*/
function theme_home_slideshow() {
	var hoverSpeed = 500;	

	jQuery('.homepage-slideshow').fadeIn(1000);
	jQuery('.homepage-slideshow-warp .loader').css({display: 'none'});
	jQuery('.flexslider-homepage').flexslider({
		animation: globalVars.slideshow_animation,
		slideshow: globalVars.slideshow_auto_show,                
		slideshowSpeed: globalVars.slideshow_speed,           
		animationDuration: globalVars.slideshow_duration,         
		directionNav: globalVars.slideshow_direction_nav,             
		controlNav: globalVars.slideshow_control_nav,              
		pausePlay: globalVars.slideshow_pause_play,                                       
		pauseOnHover: false,
		controlsContainer: '.flex-container-home'
	});

	jQuery('.homepage-slideshow-warp .flex-direction-nav li a, .homepage-slideshow-warp .flex-pauseplay').css('opacity','0');

	jQuery('.homepage-slideshow-warp').hover(function(e){
		jQuery(this).find('.flex-direction-nav li a, .flex-pauseplay').animate({ opacity: 1 }, hoverSpeed);
	}, function(e){
		jQuery(this).find('.flex-direction-nav li a, .flex-pauseplay').animate({ opacity: 0 }, hoverSpeed);
		e.preventDefault();
	});
}





/*-----------------------------------------------------------------------------------*/
/*	Portfolio Gallery
/*-----------------------------------------------------------------------------------*/
function theme_portfolio_gallery() {
	var hoverSpeed = 500;	

	jQuery('.flexslider-portfolio').flexslider({
		animation: 'fade',
		slideshow: true,                
		slideshowSpeed: 5000,           
		animationDuration: 1000,         
		directionNav: true,             
		controlNav: true,              
		pausePlay: true,                                       
		pauseOnHover: false,    
		controlsContainer: '.flex-container-gallery'    
	});

	jQuery('.post-portfolio-single .flex-direction-nav li a, .post-portfolio-single .flex-pauseplay').css('opacity','0');

	jQuery('.post-portfolio-single .flex-container-gallery').hover(function(e){
		jQuery(this).find('.flex-direction-nav li a, .flex-pauseplay').animate({ opacity: 1 }, hoverSpeed);
	}, function(e){
		jQuery(this).find('.flex-direction-nav li a, .flex-pauseplay').animate({ opacity: 0 }, hoverSpeed);
		e.preventDefault();
	});
}




/*-----------------------------------------------------------------------------------*/
/*	Product Gallery
/*-----------------------------------------------------------------------------------*/
function theme_product_gallery() {
	var hoverSpeed = 500;	

	jQuery('.flexslider-product').flexslider({
		animation: 'fade',
		slideshow: true,                
		slideshowSpeed: 5000,           
		animationDuration: 1000,         
		directionNav: true,             
		controlNav: true,              
		pausePlay: true,                                       
		pauseOnHover: false,    
		controlsContainer: '.flex-container-gallery'    
	});

	jQuery('.post-product-single .flex-direction-nav li a, .post-product-single .flex-pauseplay').css('opacity','0');

	jQuery('.post-product-single .flex-container-gallery').hover(function(e){
		jQuery(this).find('.flex-direction-nav li a, .flex-pauseplay').animate({ opacity: 1 }, hoverSpeed);
	}, function(e){
		jQuery(this).find('.flex-direction-nav li a, .flex-pauseplay').animate({ opacity: 0 }, hoverSpeed);
		e.preventDefault();
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Product Gallery
/*-----------------------------------------------------------------------------------*/
function theme_gallery() {
	var hoverSpeed = 500;	

	jQuery('.flexslider-gallery').flexslider({
		animation: 'fade',
		slideshow: true,                
		slideshowSpeed: 5000,           
		animationDuration: 1000,         
		directionNav: true,             
		controlNav: true,              
		pausePlay: true,                                       
		pauseOnHover: false,
		controlsContainer: '.flex-container-gallery' 
	});
}




/*-----------------------------------------------------------------------------------*/
/*	Blog Gallery
/*-----------------------------------------------------------------------------------*/
function theme_blog_gallery() {
	var hoverSpeed = 500;	

	jQuery('.flexslider-blog').flexslider({
		animation: 'fade',
		slideshow: false,                
		slideshowSpeed: 5000,           
		animationDuration: 1000,         
		directionNav: true,             
		controlNav: true,              
		pausePlay: false,                                        
		pauseOnHover: false,    
		controlsContainer: '.flex-container-gallery'
	});

	jQuery('.post-blog .flex-direction-nav li a, .post-blog .flex-pauseplay').css('opacity','0');

	jQuery('.post-blog .flex-container-gallery').hover(function(e){
		jQuery(this).find('.flex-direction-nav li a, .flex-pauseplay').animate({ opacity: 1 }, hoverSpeed);
	}, function(e){
		jQuery(this).find('.flex-direction-nav li a, .flex-pauseplay').animate({ opacity: 0 }, hoverSpeed);
		e.preventDefault();
	});
}




/*-----------------------------------------------------------------------------------*/
/*	Image Hover
/*-----------------------------------------------------------------------------------*/
function theme_image_hover(content) {

	var hoverSpeed_Before = 500;
	var hoverSpeed_After = 500;

	//Fade
	jQuery('.post-thumb-hover a').each(function(index){
		if(jQuery(this).find('.overlay').length == 0) { 
			jQuery(this).append('<div class="overlay"></div>');
			jQuery(this).find('.overlay').css({ opacity: 0 });
		} 										
	});

	jQuery(content+' .post-thumb-hover').hover(function(e){
		jQuery(this).find('.overlay').animate({ opacity: 0.5 }, hoverSpeed_Before);
	}, function(e){
		jQuery(this).find('.overlay').animate({ opacity: 0 }, hoverSpeed_After);
		e.preventDefault();
	});

	//Icon
	jQuery('.post-thumb-hover a').each(function(index){
		if(jQuery(this).find('.overlay-icon').length == 0) { 
			jQuery(this).append('<div class="overlay-icon"></div>');
			jQuery(this).find('.overlay-icon').css({ opacity: 0 });
		} 										
	});

	jQuery(content+' .post-thumb-hover').hover(function(e){
		jQuery(this).find('.overlay-icon').animate({ opacity: 1 }, hoverSpeed_Before);
	}, function(e){
		jQuery(this).find('.overlay-icon').animate({ opacity: 0 }, hoverSpeed_After);
		e.preventDefault();
	});
}


/*-----------------------------------------------------------------------------------*/
/*	Image Preload
/*-----------------------------------------------------------------------------------*/
function theme_image_preload() {

	jQuery(window).bind('load', function(e) {
		 var i = 1;
		 var imgs = jQuery('.post-thumb-preload .wp-preload-image').length;
		 var int = setInterval(function(e) {

		 if(i >= imgs) clearInterval(int);
		 jQuery('.post-thumb-preload .wp-preload-image:not(.image-loaded)').eq(0).animate({ top: "0", opacity: "1"}, 300,"easeInQuart").addClass('image-loaded');
		 i++;
		 
		 }, 300);
		 e.preventDefault();
	});

}


/*-----------------------------------------------------------------------------------*/
/*	Remove Image Preload
/*-----------------------------------------------------------------------------------*/
function theme_remove_image_preload() {
	  	jQuery('.post-thumb-preload a').removeClass('image-loaded');
	  	jQuery('.wp-preload-image').css('opacity','1');
};




/*-----------------------------------------------------------------------------------*/
/*	Accordion
/*-----------------------------------------------------------------------------------*/
function theme_accordions(){
	jQuery("ul.accordions li").each(function(){
		jQuery(this).children(".accordion-content").css('height', function(){ 
			return jQuery(this).height(); 
		});
		
		if(jQuery(this).index() > 0){
			jQuery(this).children(".accordion-content").css('display','none');
		}else{
			jQuery(this).find(".accordion-head-icon").addClass('active');
		}
		
		jQuery(this).children(".accordion-head").bind("click", function(){
			jQuery(this).children().addClass(function(){
				if(jQuery(this).hasClass("active")) return "";
				return "active";
			});
			jQuery(this).siblings(".accordion-content").slideDown();
			jQuery(this).parent().siblings("li").children(".accordion-content").slideUp();
			jQuery(this).parent().siblings("li").find(".active").removeClass("active");
		});
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Toggle
/*-----------------------------------------------------------------------------------*/
function theme_toggles(){
	jQuery("ul.toggles li").each(function(){
		jQuery(this).children(".toggle-content").css('height', function(){ 
			return jQuery(this).height(); 
		});
		jQuery(this).children(".toggle-content").not(".active").css('display','none');
		
		jQuery(this).children(".toggle-head").bind("click", function(){
			jQuery(this).children().addClass(function(){
				if(jQuery(this).hasClass("active")){
					jQuery(this).removeClass("active");
					return "";
				}
				return "active";
			});
			jQuery(this).siblings(".toggle-content").slideToggle();
		});
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Tabbed
/*-----------------------------------------------------------------------------------*/
function theme_tabs(){
	var tabs = jQuery('ul.tabs');

	tabs.each(function(i) {

		var tab = jQuery(this).find('> li > a');
		tab.click(function(e) {

			var contentLocation = jQuery(this).attr('href');

			if(contentLocation.charAt(0)=="#") {

				e.preventDefault();

				tab.removeClass('active');
				jQuery(this).addClass('active');

				jQuery(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
			}
		});
	});
}



/*-----------------------------------------------------------------------------------*/
/*	Google Maps
/*-----------------------------------------------------------------------------------*/
function theme_google_maps(){
	//Google Maps
	if( typeof google != 'undefined' && 
		typeof google.maps != 'undefined' &&
		typeof google.maps.LatLng !== 'undefined' ){
		jQuery('.map-canvas').each(function(){
			
			var $canvas = jQuery(this);
			var dataZoom = $canvas.attr('data-zoom') ? parseInt($canvas.attr('data-zoom')) : 8;
			
			var latlng = $canvas.attr('data-lat') ? 
							new google.maps.LatLng($canvas.attr('data-lat'), $canvas.attr('data-lng')) :
							new google.maps.LatLng(40.7143528, -74.0059731);
					
			var myOptions = {
				zoom: dataZoom,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				center: latlng
			};
					
			var map = new google.maps.Map(this, myOptions);
			
			if($canvas.attr('data-address')){
				var geocoder = new google.maps.Geocoder();
				geocoder.geocode({ 
						'address' : $canvas.attr('data-address') 
					},
					function(results, status) {					
						if (status == google.maps.GeocoderStatus.OK) {
							map.setCenter(results[0].geometry.location);
							var marker = new google.maps.Marker({
								map: map,
								position: results[0].geometry.location,
								title: $canvas.attr('data-mapTitle')
							});
						}
				});
			}
		});
	}
}




/*-----------------------------------------------------------------------------------*/
/*	Responsive 
/*-----------------------------------------------------------------------------------*/
function theme_responsive_media(){

	jQuery(".wp-caption img").each(function() { jQuery(this)
	    .removeAttr('height').removeAttr('width');	
	});

	if( jQuery(window).width() < 960 ) {

		var $allVideos = jQuery("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com'], object, embed"),
		$fluidEl = jQuery(".video");

		$allVideos.each(function() {
		  jQuery(this)
			.attr('data-aspectRatio', this.height / this.width)
			.removeAttr('height')
			.removeAttr('width');
		});

		jQuery(window).resize(function() {
		  var newWidth = $fluidEl.width();
		  $allVideos.each(function() {
		  
			var $el = jQuery(this);
			$el
				.width(newWidth)
				.height(newWidth * $el.attr('data-aspectRatio'));
		  
		  });
		}).resize();

	}
}