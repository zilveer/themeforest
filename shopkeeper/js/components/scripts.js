/*global jQuery:false, shopkeeper_ajaxurl:false, document:false */

jQuery(document).ready(function ($) {
	
	"use strict";

	/* Ajax Calls */
	
	function shopkeeper_refresh_dynamic_contents() {
		$.ajax({
			url: shopkeeper_ajaxurl,
			type: "POST",
			data: {
				'action' : 'refresh_dynamic_contents'
			},
			success:function(data) {
				$(".shopping_bag_items_number").html(data['cart_count_products']);
				$(".wishlist_items_number").html(data['wishlist_count_products']);
			}
		});
	}
	
	shopkeeper_refresh_dynamic_contents();
	
	$("#yith-wcwl-form").on("click", ".product-remove a, .product-add-to-cart a", function() {
		setTimeout(function() {	
			shopkeeper_refresh_dynamic_contents();
		}, 2000);
	});
	
	//responsive videos
	$(".content-area").fitVids();
	
	// Off Canvas Navigation
	var offcanvas_open = false;
	var offcanvas_from_left = false;
	var offcanvas_from_right = false;
	var window_width = $(window).innerWidth();
	
	
	//submenu adjustments
	function submenu_adjustments() {
		$(".main-navigation > ul > .menu-item").mouseenter(function() {
			if ( $(this).children(".sub-menu").length > 0 ) {
				var submenu = $(this).children(".sub-menu");
				var window_width = parseInt($(window).outerWidth());
				var submenu_width = parseInt(submenu.outerWidth());
				var submenu_offset_left = parseInt(submenu.offset().left);
				var submenu_adjust = window_width - submenu_width - submenu_offset_left;
				
				//console.log("window_width: " + window_width);
				//console.log("submenu_width: " + submenu_width);
				//console.log("submenu_offset_left: " + submenu_offset_left);
				//console.log("submenu_adjust: " + submenu_adjust);
				
				if (submenu_adjust < 0) {
					submenu.css("left", submenu_adjust-30 + "px");
				}
			}
		});
	}
	
	submenu_adjustments();
	
	
	//columns height adjustment
	/*function columns_height_adjustment() {
		
		$('.adjust_cols_height').each(function(){
			
			var column_min_height = 0;
			
			var that = $(this);
			
			that.imagesLoaded('always',function(){
				
				that.find('.vc_column_container').first().siblings().addBack().css('min-height',0).each(function(){
					if ( $(this).outerHeight(true) > column_min_height ) {
						column_min_height = $(this).outerHeight(true);
					}
				})
				
				that.addClass('height_adjusted')
				.find('.vc_column_container').first().siblings().addBack().css('min-height',column_min_height)
				.find('.vc_column-inner').siblings().addBack().css('min-height',column_min_height);
				
			});
			
			
		});
	};
	
	
	if ( $('.vc_row').hasClass('adjust_cols_height') )  {
		if ( window_width > 640 ) {
			setTimeout(function(){
				columns_height_adjustment();
			},1)
		} else {
			$('.adjust_cols_height').addClass('height_adjusted');
		}
	}*/
	
	//woocommerce tabs
	$('.woocommerce-tabs .panel:first-child').addClass('current');
	$('.woocommerce-tabs ul.tabs li a').off('click').on('click', function(){
		var that = $(this);
		var currentPanel = that.attr('href');
		
		that.parent().siblings().removeClass('active')
					.end()
					.addClass('active');
		
		$('.woocommerce-tabs').find(currentPanel).siblings('.panel').filter(':visible').fadeOut(500,function(){
			$('.woocommerce-tabs').find(currentPanel).siblings('.panel').removeClass('current');
			$('.woocommerce-tabs').find(currentPanel).addClass('current').fadeIn(500);
		})
		
		return false;
	})
	
	
	//add to cart button
	
	$('.add_to_cart_button').one('click',function(){
		
		var	add_to_cart_classes,
			add_to_cart_styles,
			that = $(this);
		
		add_to_cart_classes = that.attr('class');
		add_to_cart_classes=add_to_cart_classes.replace('add_to_cart_button','');
		
		add_to_cart_styles = that.attr('style');
		
		that.parent().on('DOMNodeInserted', function(e) {
			e.stopPropagation();
			
			if ($(e.target).is('.added_to_cart')) {
				$(e.target).addClass(add_to_cart_classes).removeClass('added_to_cart').addClass('added_to_cart_button');
			    $(e.target).attr('style',add_to_cart_styles);
			}
		});
	})
	
	
	//search
	$('.woocommerce-product-search .search-field, .search-form .search-field').val('');

	var searchField = $('body').find('.site-search').find('input[type="search"]');
	
	$(".search-button").on('click',function() {
		
		var documentHeight = $(document).height(),
			searchWrapper = $('.site-search .search-form'),
			searchProductsWrapper = $('.site-search .woocommerce-product-search');

		//woocommerce search
		if ( $('.site-search .woocommerce-product-search').length > 0 ) {

			$('.site-search .woocommerce-product-search .search-field').val('');
			
			if ( !searchProductsWrapper.find('.submit_icon').size() )
			{
				searchProductsWrapper.append('<div class="submit_icon"><i class="fa fa-search"></i></div>')
			}
			
			searchProductsWrapper.css('margin-left',-$(window).width()/4);
			
			$('.site-search').addClass('open');
							 
			//$('.site-search .woocommerce-product-search .search-field').focus();
		
			$(".site-search").on('click',function(e) {
				if ( $(e.target).attr('id') == 'searchsubmit' || $(e.target).attr('class') == 'search-field') {
					return;
				} else {
					$('.site-search').removeClass('open');
					
				}
			});
			
		//wp widget search
		} else {
			
			$('.site-search .widget_search .search-field').val('');
			
			if ( !searchWrapper.find('.submit_icon').size() )
			{
				searchWrapper.append('<div class="submit_icon"><i class="fa fa-search"></i></div>')
			}
			
			searchWrapper.css('margin-left',-$(window).width()/4);
			
			$('.site-search').addClass('open');
							 
			// $('.site-search .widget_search .search-field').focus();
		
			$(".site-search").on('click',function(e) {
				if ( $(e.target).attr('class') == 'search-submit' || $(e.target).attr('class') == 'search-field') {
					return;
				} else {
					$('.site-search').removeClass('open');
					
				}
			});	

		}

		if ($(window).width() > 1024 )
		{
			console.log('x');
			searchField.focus();
		}
	});
	
	
    //product animation (thanks Sam Sehnert)
    $.fn.visible = function(partial) {

      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;

    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

    };

    
    //if is visible on screen add a class
    $(".single_product_summary_related").each(function(i, el) {
        if ($(el).visible(true)) {
            $(el).addClass("on_screen");
        } 
    });
	
	
	function offcanvas_left() {
			
		$(".st-container").removeClass("slide-from-right");
		$(".st-container").addClass("slide-from-left");
		$(".st-container").addClass("st-menu-open");
		
		offcanvas_open = true;
		offcanvas_from_left = true;
		
		$(".st-menu.slide-from-left").addClass("open");
		$("body").addClass("offcanvas_open offcanvas_from_left");
		
		$(".nano").nanoScroller();
		
	}
	
	function offcanvas_right() {
			
		$(".st-container").removeClass("slide-from-left");
		$(".st-container").addClass("slide-from-right");
		$(".st-container").addClass("st-menu-open");		
		
		offcanvas_open = true;
		offcanvas_from_right = true;
		
		$(".st-menu.slide-from-right").addClass("open");
		$("body").addClass("offcanvas_open offcanvas_from_right");

		$(".nano").nanoScroller();
		
	}	
	
	function offcanvas_close() {
		if (offcanvas_open === true) {
				
			$(".st-container").removeClass("slide-from-left");
			$(".st-container").removeClass("slide-from-right");
			$(".st-container").removeClass("st-menu-open");
			
			offcanvas_open = false;
			offcanvas_from_left = false;
			offcanvas_from_right = false;
			
			//$('#st-container').css('max-height', 'inherit');
			$(".st-menu").removeClass("open");
			$("body").removeClass("offcanvas_open offcanvas_from_left offcanvas_from_right");

		}
	}
	
	$(".offcanvas-menu-button, .open-offcanvas").click(function() {
		
		offcanvas_right();
		
	});
	
	
	$("#button_offcanvas_sidebar_left").click(function() {
		
		offcanvas_left();
			
	});
	
	$("#st-container").on("click", ".st-pusher-after", function(e) {
		
		offcanvas_close();
		
	});
	
	$(".st-pusher-after").swipe({
		swipeLeft:function(event, direction, distance, duration, fingerCount) {
			offcanvas_close();
		},
		swipeRight:function(event, direction, distance, duration, fingerCount) {
			offcanvas_close();
		},
		tap:function(event, direction, distance, duration, fingerCount) {
			offcanvas_close();
		},
		threshold:0
	});
	
	//mobile menu	
	$(".mobile-navigation .menu-item-has-children").append('<div class="more"><i class="fa fa-plus-circle"></i></div>');
	
	$(".mobile-navigation").on("click", ".more", function(e) {
		e.stopPropagation();
		
		$(this).parent().toggleClass("current")
						.children(".sub-menu").toggleClass("open");
						
		$(this).html($(this).html() == '<i class="fa fa-plus-circle"></i>' ? '<i class="fa fa-minus-circle"></i>' : '<i class="fa fa-plus-circle"></i>');
		$(".nano").nanoScroller();
	});
	
	$(".mobile-navigation").on("click", "a", function(e) {
		if( ($(this).attr('href') === "#") || ($(this).attr('href') === "") ) {
			$(this).parent().children(".more").trigger("click");
		} else {
			offcanvas_close();
		}
	});
	
	$("#related-products-carousel").owlCarousel({
		items:4,
		itemsDesktop : [1200,4],
		itemsDesktopSmall : [1000,3],
		itemsTablet: false,
		itemsMobile : [600,2],
		lazyLoad : true,
		pagination :true,
		/*autoHeight : true,*/
	});
	
	$("#cross-sell-products-carousel").owlCarousel({
		items:4,
		itemsDesktop : [1200,4],
		itemsDesktopSmall : [1000,3],
		itemsTablet: false,
		itemsMobile : [600,2],
		lazyLoad : true,
		/*autoHeight : true,*/
	});
	
	$("#upsells-products-carousel").owlCarousel({
		items:4,
		itemsDesktop : [1200,4],
		itemsDesktopSmall : [1000,3],
		itemsTablet: false,
		itemsMobile : [600,2],
		lazyLoad : true,
		pagination :true,
		/*autoHeight : true,*/
	});

	function replace_img_source(selector) {
		var data_src = $(selector).attr('data-src');
		$(selector).one('load', function() {
		}).each(function() {
			//if(this.complete) {
				//$(this).load();
				$(selector).attr('src', data_src);
				$(selector).css("opacity", "1");
			//}
		});
	}
	
	$('#products-grid li img').each(function(){
		replace_img_source(this);
	});
	
	$('.related.products:not(.owl-carousel) li img').each(function(){
		replace_img_source(this);
	});
	
	$('.upsells.products:not(.owl-carousel) li img').each(function(){
		replace_img_source(this);
	});

	$('.add_to_cart_button').on('click',function(){
		$(this).parents('li.animate').addClass('product_added_to_cart')	
	})
	
	
	//scroll on reviews tab
	$('.woocommerce-review-link').off('click').on('click',function(){
		
		$('.tabs li a').each(function(){
			if ($(this).attr('href')=='#tab-reviews') {
				$(this).trigger('click');
			}
		});
		
		var elem_on_screen_height = 0;
		
		/*if ( $('.site-header-sticky').length > 0 ) {
			elem_on_screen_height += $('.site-header-sticky').outerHeight();
		}*/
		
		if ( $('#wpadminbar').length > 0 ) {
			elem_on_screen_height += $('#wpadminbar').outerHeight();
		}
		
		if ( $('.getbowtied_theme_explorer_wrapper').length > 0 && $('.getbowtied_theme_explorer_wrapper').is('visible') ) {
			elem_on_screen_height += $('.getbowtied_theme_explorer_wrapper').outerHeight();
		}
		
		var tab_reviews_topPos = $('.woocommerce-tabs').offset().top - elem_on_screen_height;
		
		$('html, body').animate({
            scrollTop: tab_reviews_topPos
        }, 1000);
		
		return false;
	})

	
	//wishlist 	
	$("body").on('added_to_wishlist',function(e){ //trigger defined in jquery.yith-wcwl.js
		shopkeeper_refresh_dynamic_contents();
	});
	
	$('.add_to_wishlist').on('click',function(){
		$(this).parents('.yith-wcwl-add-button').addClass('show_overlay');
	})

	// Login/register
	var account_tab_list = $('.account-tab-list');
	
	account_tab_list.on('click','.account-tab-link',function(){
		
		if ( $('.account-tab-link').hasClass('registration_disabled') ) {
			return false;
		} else {
		
			var that = $(this),
				target = that.attr('href');
			
			that.parent().siblings().find('.account-tab-link').removeClass('current');
			that.addClass('current');
			
			$('.account-forms').find($(target)).siblings().stop().fadeOut(function(){
				$('.account-forms').find($(target)).fadeIn();
			});
			
			//$(target).siblings().stop().fadeOut(function(){
			//	$(target).fadeIn();	
			//});
			
			return false;
		}
	});
	
	// Login/register mobile
	$('.account-tab-link-register').on('click',function(){
		$('.login-form').stop().fadeOut(function(){
			$('.register-form').fadeIn();
		})
		return false;
	})
	
	$('.account-tab-link-login').on('click',function(){
		$('.register-form').stop().fadeOut(function(){
			$('.login-form').fadeIn();
		})
		return false;
	})
	
    
    // Disable fresco
    function disable_fresco() {
		if ($(window).innerWidth() < 640 ) {
			$(".product_content_wrapper .fresco").on('click',function() {
					return false;
			});
		}
	}
    
    disable_fresco();
	
	
	//add fresco groups to images galleries
	$(".gallery").each(function() {
		
		var that = $(this);
		
		that.find('.gallery-item').each(function(){
			
			var this_gallery_item = $(this);
			
			this_gallery_item.find('.fresco').attr('data-fresco-group', that.attr('id'));
			
			if ( this_gallery_item.find('.gallery-caption').length > 0 ) {
				this_gallery_item.find('.fresco').attr('data-fresco-caption', this_gallery_item.find('.gallery-caption').text());
			}
			
		});
		
	});

	
	// share product text desktop animation
	$('.product_socials_wrapper').on('mouseenter',function(){
		$(this).addClass('hovered');
	})

	$('.product_socials_wrapper').on('mouseleave',function(){
		$(this).removeClass('hovered');
	})

	
	function handleSelect() {	
		if ($(window).innerWidth() > 1023 ) {
			
			var select2 = $(".orderby, .big-select, select.topbar-language-switcher, select.wcml_currency_switcher ").select2({
				//placeholder: "Select a State",
				allowClear: true,
				minimumResultsForSearch: Infinity
			});

		}
	}
	
	handleSelect();


	//gallery caption

	$('.gallery-item').each(function(){
		
		var that = $(this);
		
		if ( that.find('.gallery-caption').length > 0 ) {
			that.append('<span class="gallery-caption-trigger">i</span>')
		}
		
	})
	
	$('.gallery-caption-trigger').on('mouseenter',function(){
		$(this).siblings('.gallery-caption').addClass('show'); 
	});
	
	$('.gallery-caption-trigger').on('mouseleave',function(){
		$(this).siblings('.gallery-caption').removeClass('show');
	});
	
		

	
	/*function refreshBackgrounds(selector) {
		// Chrome shim to fix http://groups.google.com/a/chromium.org/group/chromium-bugs/browse_thread/thread/1b6a86d6d4cb8b04/739e937fa945a921
		// Remove this once Chrome fixes its bug.
		$.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase());
		if ($.browser.chrome) {
			if ($(selector).css("background-image") != "none") {
				var oldBackgroundImage = $(selector).css("background-image");
				$(selector).css("background-image", oldBackgroundImage);
			}
		}
	}*/

	//refreshBackgrounds(".st-content");
	
	$('.trigger-footer-widget-icon').on('click', function(){
		
		var trigger = $(this).parent();
		
		trigger.fadeOut('1000',function(){
			trigger.remove();
			$('.site-footer-widget-area').fadeIn();
		});
	});
		
	
	//blog isotope - adjust wrapper width, return blog_grid
    function blogIsotopeWrapper () {
           
		if ( $(window).innerWidth() > 1024 ) {
			$blog_grid = 3;
			$('.blog-isotop-container').css({'margin':'0 -1.5%'})
		} else if ( $(window).innerWidth() <= 640 ) {
			$blog_grid = 1;
			$('.blog-isotop-container').css({'margin':'0 -30px'})
		} else {
			$blog_grid = 2;
			$('.blog-isotop-container').css({'margin':'0 -1.5%'})
		}
       
        $blog_wrapper_width = $('.blog-isotop-container').width();
   
        if ( $blog_wrapper_width % $blog_grid > 0 ) {
            $blog_wrapper_width = $blog_wrapper_width + ( $blog_grid - $blog_wrapper_width%$blog_grid);
        };
   
        $('.blog-isotope').css('width',$blog_wrapper_width);

        return $blog_grid;
    } // end blogIsotopeWrapper
   
    
	
	//blog isotope
    if ( $('.blog-isotop-container').size() ) {
           
		var $blog_wrapper_inner,   
            $blog_wrapper_width,
            $blog_grid,
            $filterValue;
       
        $filterValue = $('.filters-group .is-checked').attr('data-filter');
                      
        $blog_grid =  blogIsotopeWrapper();
        blogIsotopeWrapper();
       
        var afterBlogIsotope = function(){
            setTimeout(function(){
                //$('.preloader_isotope').remove();
                $(".blog-post").removeClass('hidden');
            },200);
        }
       
        var blogIsotope=function(){
            var imgLoad = imagesLoaded($('.blog-isotope'));
		   
            imgLoad.on('done',function(){

                $blog_wrapper_inner = $('.blog-isotope').isotope({
                    "itemSelector": ".blog-post",
					 //layoutMode: 'fitRows',
                    "masonry": { "columnWidth": ".grid-sizer" }
                });
               
			   afterBlogIsotope()
               
            })
           
           imgLoad.on('fail',function(){

                $blog_wrapper_inner = $('.blog-isotope').isotope({
                    "itemSelector": ".blog-post",
                    "masonry": { "columnWidth": ".grid-sizer" }
                });
               
                afterBlogIsotope()
           })  
           
        }
                   
        blogIsotope();
   
        // filter items on button click
        $('.filters-group').on( 'click', 'filter-item', function() {
           
            $filterValue = $(this).attr('data-filter');
            $blog_wrapper_inner.isotope({ filter: $filterValue });
        
		});
    }//endif blog isotope
	
	
	//portfolio isotope - hover effect
	$('.hover-effect-text').each(function(){
		
		var that = $(this);
		
		that.css('bottom',-that.outerHeight())
			.attr('data-height',that.outerHeight());
	})
	
	$('.hover-effect-link').mouseenter(function(){
		
		var that = $(this);
		
		if ( !that.find('.hover-effect-text').is(':empty') ) {
			
			var portfolio_cat_height = that.find('.hover-effect-text').outerHeight();
			
			that.find('.hover-effect-title').css('bottom',portfolio_cat_height);
			that.find('.hover-effect-text').css('bottom',0);
			
		}
		
	});
	
	
	$('.hover-effect-link').mouseleave(function(){
	
		var that = $(this);
		
		if ( !that.find('.hover-effect-text').is(':empty') ) {
		
			var portfolio_cat_height = that.find('.hover-effect-text').attr('data-height');
	
			that.find('.hover-effect-title').css('bottom',28);
			that.find('.hover-effect-text').css('bottom',-portfolio_cat_height);
		}
		
	});
	
	
	//portfolio isotope - adjust wrapper width, return portfolio_grid
    function portfolioIsotopeWrapper () {
           
		if ( $(window).innerWidth() > 1584 ) {
			$portfolio_grid = 5;
		} else if ( $(window).innerWidth() <= 480 ) {
			$portfolio_grid = 1;
		} else if ( $(window).innerWidth() <= 901 ) {
			$portfolio_grid = 2;
		} else if ( $(window).innerWidth() <= 1248 ) {
			$portfolio_grid = 3;
		} else {
			$portfolio_grid = 4;
		}
		
		if ( $('.items_per_row_3').length > 0 && $(window).innerWidth() > 1248 )
		{
			$portfolio_grid = 3;
		}
		
		if ( $('.items_per_row_4').length > 0 && $(window).innerWidth() > 1584 )
		{
			$portfolio_grid = 4;
		}
       
        $portfolio_wrapper_width = $('.portfolio-isotope-container').width();
   
        if ( $portfolio_wrapper_width % $portfolio_grid > 0 ) {
            $portfolio_wrapper_width = $portfolio_wrapper_width + ( $portfolio_grid - $portfolio_wrapper_width%$portfolio_grid);
        };
   
        $('.portfolio-isotope').css('width',$portfolio_wrapper_width);

        return $portfolio_grid;
    } // end portfolioIsotopeWrapper
   
    //portfolio isotope
    if ( $('.portfolio-isotope-container').size() ) {
           
		var $portfolio_wrapper_inner,   
            $portfolio_wrapper_width,
            $portfolio_grid,
            $filterValue;
       
        $filterValue = $('.filters-group .is-checked').attr('data-filter');
                      
        $portfolio_grid =  portfolioIsotopeWrapper();
        portfolioIsotopeWrapper();
       
        var afterIsotope = function(){
            setTimeout(function(){
                //$('.preloader_isotope').remove();
                $(".portfolio-box").removeClass('hidden');
            },200); 
        }
       
        var portfolioIsotope=function(){
            var imgLoad = imagesLoaded($('.portfolio-isotope'));
           
            imgLoad.on('done',function(){

                $portfolio_wrapper_inner = $('.portfolio-isotope').isotope({
                    "itemSelector": ".portfolio-box",
					 //layoutMode: 'fitRows',
                    "masonry": { "columnWidth": ".portfolio-grid-sizer" }
                });
               
                afterIsotope()
            })
           
            imgLoad.on('fail',function(){

                portfolio_wrapper_inner = $('.portfolio-isotope').isotope({
                    "itemSelector": ".portfolio-box",
					 //layoutMode: 'fitRows',
                    "masonry": { "columnWidth": ".portfolio-grid-sizer" }
                });
               
                afterIsotope()
            })
           
        }
                   
        portfolioIsotope();
   
        // filter items on button click
        $('.filters-group').on( 'click', '.filter-item', function() {
		   
            $filterValue = $(this).attr('data-filter'); 
            $(this).parents('.portfolio-filters').siblings('.portfolio-isotope').isotope({ filter: $filterValue });
        
		});
    }//endif portfolio isotope

	
	
	//Language Switcher
	$('.topbar-language-switcher').change(function(){
		window.location = $(this).val();
	});
	
	
	
	
	
	$(window).load(function(){
		
		//$('body').hide().show(); //fix invisible fonts on refresh.
		
		//product thumbnails swiper	

		if ($('.product_thumbnails_swiper_container').length > 0 ) {
			var product_thumbnails_swiper = new Swiper('.product_thumbnails_swiper_container', {			
				direction: 'vertical',
				slidesPerView: "auto",
				mousewheelControl: true,
				preventClicks: false,
				preventClicksPropagation: false
			});	
		} else {
			var product_thumbnails_swiper = false;
		}
		
		//owl
		
		var curent_dragging_item;
		
		$(".featured_img_temp").hide();
		
		$("#product-images-carousel").owlCarousel({
			singleItem : true,
			autoHeight : true,
			transitionStyle:"fade",
			lazyLoad : true,
			slideSpeed : 300,
			dragBeforeAnimFinish: false,
			afterAction : afterAction,
			beforeUpdate : function() {},
			startDragging: function() {},
			afterMove: function() {}
		});
		
		var owl = $("#product-images-carousel").data('owlCarousel');

		function activate_slide(index) {

			if (product_thumbnails_swiper != false ) {
				product_thumbnails_swiper.slideTo(index-1, 300, false);
			}
			
			$(".product_thumbnails_swiper_container .swiper-slide").removeClass("active").eq(index).addClass("active");
			$(".product_thumbnails_swiper_container .swiper-slide").removeClass("active").eq(index).addClass("active");

		}

		$('.product_content_wrapper').each(function() {

			$(".product_thumbnails_swiper_container .swiper-slide").eq(0).addClass("active");

			if (product_thumbnails_swiper != false ) {
				product_thumbnails_swiper.on('onTap', function() {
					activate_slide(product_thumbnails_swiper.clickedIndex);
					owl.goTo(product_thumbnails_swiper.clickedIndex);
				});
			}
		});		
		
		function afterAction() {
			activate_slide(this.owl.currentItem);
		}
		
		




		//Product Gallery zoom	
		if ($(".easyzoom").length ) {
			if ( $(window).width() > 1024 ) {
				var $easyzoom = $(".easyzoom").easyZoom({
					loadingNotice: '',
					errorNotice: '',
					preventClicks: true,
				});
				
				var easyzoom_api = $easyzoom.data('easyZoom');
				
				$(".variations").on('change', 'select', function() {
					owl.goTo(0);
					easyzoom_api.teardown();
					easyzoom_api._init();
				});
			} else {
				$(".easyzoom a").click(function(event) {
				  event.preventDefault();
				});

				$(".variations").on('change', 'select', function() {
					owl.goTo(0);
					// easyzoom_api.teardown();
					// easyzoom_api._init();
				});
			}
		}

        setTimeout(function() {	
            $(".product_thumbnail.with_second_image").css("background-size", "cover");
			$(".product_thumbnail.with_second_image").addClass("second_image_loaded");
        }, 300);
		
        if ($(window).outerWidth() > 1024) {
			$.stellar({
				horizontalScrolling: false,
                responsive: true
			});
		}
		
		setTimeout(function(){
			$('.parallax, .single-post-header-bkg').addClass('loaded');
		},150)
	
	});
	
	$(window).resize(function(){
        
        $('.site-search-form-wrapper-inner, .site-search .widget_search .search-form').css('margin-left',-$(window).width()/4);
		
		$(".main-navigation > ul > .menu-item > .sub-menu").css("left", "-15px");
		       
        disable_fresco();		
		
		//blog isotope
        if ( $('.blog-isotop-container').size() ) {
           
            var $blog_grid_on_resize;
           
            blogIsotopeWrapper()
            $blog_grid_on_resize =  blogIsotopeWrapper(); 
           
            if ( $blog_grid != $blog_grid_on_resize ) {

                $('.filters-group .filter-item').each(function(){
                    if ( $(this).attr('data-filter') == $filterValue ){ 
                            $(this).trigger('click');
                    }
                })
               
                $blog_grid = $blog_grid_on_resize;
           
				resizeIsotopeEnd();
           
            } 
		}
		
		//portfolio isotope
        if ( $('.portfolio-isotope-container').size() ) {
           
            var $portfolio_grid_on_resize;
           
            portfolioIsotopeWrapper()
            $portfolio_grid_on_resize =  portfolioIsotopeWrapper(); 
           
            if ( $portfolio_grid != $portfolio_grid_on_resize ) {

                $('.filters-group .filter-item').each(function(){
                    if ( $(this).attr('data-filter') == $filterValue ){
                            $(this).trigger('click');
                    }
                })
               
                $portfolio_grid = $portfolio_grid_on_resize;
        
				resizeIsotopeEnd();
           
            }
			
        }
		
		
		//do something on end resize
        var window_resizeTo = this.resizeTO;
        function resizeIsotopeEnd() {
            if(window_resizeTo) clearTimeout(window_resizeTo);
                 window_resizeTo = setTimeout(function() {
                    $(this).trigger('onEndResizingIsotope');
            }, 100);
        }

	
	});
	
	//do something, window hasn't changed size in 100ms
    $(window).bind('onEndResizingIsotope', function() { console.log('resizeend')
        $('.filters-group .filter-item').each(function(){
            if ( $(this).attr('data-filter') == $filterValue ){ 
                $(this).trigger('click'); console.log('trigger resize')
            }
        })
    });
	
	
    $(window).scroll(function() {
			
		if ( $(this).scrollTop() > 0 ) {
			$('#page_wrapper.sticky_header .top-headers-wrapper').addClass('on_page_scroll');
		} else {
			$('#page_wrapper.sticky_header .top-headers-wrapper').removeClass('on_page_scroll');
		}	
			
    	//$('#page_wrapper.sticky_header .top-headers-wrapper').css('top', $(window).scrollTop());
		
		//animate products
        if ($(window).innerWidth() > 640 ) {
			$(".products li").each(function(i, el) {
				if ($(el).visible(true)) {
					$(el).addClass("animate"); 
				} 
			});
		}
        
        //mark this selector as visible
        $(".single_product_summary_related, #site-footer").each(function(i, el) {
            if ($(el).visible(true)) {
                $(el).addClass("on_screen");
				
            } else {
                $(el).removeClass("on_screen");
				
            }
        });
        
		//single post overlay -  only for large-up
		if ( $(window).width() > 1024 ) {
			$('.single-post-header-overlay').css('opacity', 0.3 + ($(window).scrollTop()) / (($(window).height())*1.4) );
		}
		
		//chrome bg fix
		//refreshBackgrounds(".st-content");
        
    });

	// WISHLIST

	if ($('body').hasClass('woocommerce-wishlist'))
	{
		if ($('td.wishlist-empty').length)
		{
			$('h1.page-title').hide();
		}
	}

	$('.widget_layered_nav span.count, .widget_product_categories span.count').each(function(){
		var count = $(this).html();
		count = count.substring(1, count.length-1);
		$(this).html(count);
	})

	/******************** average rating widget ****************************/
	$('.widget_rating_filter ul li a').each(function(){
		var count = $(this).contents().filter(function(){ 
		  return this.nodeType == 3; 
		})[0].nodeValue;

		$(this).contents().filter(function(){ 
		  return this.nodeType == 3; 
		})[0].nodeValue = '';

		count = count.slice(2,-1);
		
		$(this).append('<span class="count">' + count + '</span>');
	})

	/********************** my account tabs by url **************************/
	if ( ('form#register').length > 0 )
	{
		var hash = window.location.hash;
		if (hash)
		{
			$('.account-tab-link').removeClass('current');
			$('a[href="'+hash+'"]').addClass('current');

			hash = hash.substring(1);
			$('.account-forms > form').hide();
			$('form#'+hash).show();
		}
	}


	/************************************************************************/
	/****************************** QUICK VIEW ******************************/
	/************************************************************************/

	function product_quick_view_ajax(id) {
		
		$.ajax({
			url: shopkeeper_ajaxurl,
			data: {
				"action" : "getbowtied_product_quick_view",
				'product_id' : id
			},
			success: function(results) {
				
				$("#placeholder_product_quick_view").html(results);

				var curent_dragging_item;
		
				$("#placeholder_product_quick_view .featured_img_temp").hide();
				
				$("#placeholder_product_quick_view #product-images-carousel").owlCarousel({
					singleItem : true,
					autoHeight : true,
					transitionStyle:"fade",
					lazyLoad : true,
					slideSpeed : 300,
					dragBeforeAnimFinish: false,
					// afterAction : afterAction,
					beforeUpdate : function() {},
					startDragging:function() {},
					afterMove:function() {},
					navigation: true,
					navigationText: ['', ''],
					dots:true
				});


				$("#quick_view_container").show();
				
				var form_variation = $("#placeholder_product_quick_view").find('.variations_form');
				var form_variation_select = $("#placeholder_product_quick_view").find('.variations_form .variations select');
            	
            	form_variation.wc_variation_form();
            	form_variation_select.change();
            	
            	// window.product_gallery();
            	// window.product_variations_label();

			},
			error: function(errorThrown) { console.log(errorThrown); }
		});
	}

    $('.st-content').on('click', '.getbowtied_product_quick_view_button', function(e) {
        e.preventDefault();
        var product_id  = $(this).data('product_id');
        product_quick_view_ajax(product_id);
    });

    $(window).mouseup(function (e) {	    
	    var container = $("#placeholder_product_quick_view");
	    if ( ! container.is(e.target) && container.has(e.target).length === 0 ) {	    
	        $('#quick_view_container').hide();
	    }
	});

	$(document).on("click", "#close_quickview", function(){
		$('#quick_view_container').hide();
	});

	$("#quick_view_container").on('click', '.zoom', function(e){
		e.preventDefault();
	})


	/************************************************************************/
	/****************************** BACK TO TOP *****************************/
	/************************************************************************/

	var offset = 300,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	offset_opacity = 1200,
	//duration of the top scrolling animation (in ms)
	scroll_top_duration = 700,
	//grab the "back to top" link
	$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
	 

});

jQuery(function($) {
	
	"use strict";
	
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

});

jQuery(document).ready(function ($) {
	// blog sidebar fix

	if ($('.blog-sidebar').length > 0)
	{
		if ($('.blog-sidebar').height() > $('.blog-isotop-container').height())
		{
			$('.blog-isotop-container').height($('.blog-sidebar').height() + 100);
		}
	}

	$(window).resize(function(){
		if ($('.blog-sidebar').length > 0)
		{
			if ($('.blog-sidebar').height() > $('.blog-isotop-container').height())
			{
				$('.blog-isotop-container').height($('.blog-sidebar').height() + 100);
			}
		}
	})
});
