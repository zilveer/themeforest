/**
 * General Initialization and scripts
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
function fixScroll(hash){
    setTimeout(function(){
        jQuery('.top-main-menu li.active').removeClass('active');
        jQuery('.top-main-menu a[href="#' + hash + '"]').parent().addClass('active');
    },1000);
}
(function ($) {
	"use strict";

	// ============================================================================
	// Document Ready
	// ============================================================================

	$(document).ready(function () {

		if (urlParams['960px'] != undefined) $('body').addClass('cont-960');

		$('#menu-bar').mental_menu_bar();

		$('#mb-main-menu').mental_menu();

		$('.widget_nav_menu ul.menu').mental_menu(); // Widget Menu

		//  Start pie charts
		$(".knob").knob({
			draw: function () {
				// Add percents to value
				if (this.$.data('percents') == true) {
					$(this.i).val(this.cv + '%')
				}
			}
		});
		$(".knob").css({'font-size': '26px', 'color': '#444649'});

		// Init page animation if not on touch device
		animate_init();

		// Init Parallax - stellar.js
		$.stellar({
			responsive: true,
			horizontalScrolling: false,
			positionProperty: 'transform'
		});

		// Menu bar scrollbar
		$('.mb-body').css({position: 'relative', overflow: 'hidden'}).perfectScrollbar({
			wheelSpeed: 20,
			wheelPropagation: false,
			suppressScrollX: true
		});


		$('ul.gallery').mental_gallery();
		init_gallery_filters_underline();

		$('.isotope-blog').mental_blog();

		// Layerslider
		if ($.fn.layerSlider) {
			init_layer_slider();
		}

		// Menu
		if ($.fn.mtmenu) {
			wpml_lang_switcher_mtmenu_fix();
			$().mtmenu();
			init_smooth_scrolling();
			init_onepage_top_section();
			init_fixed_topbar();
		}

		// Set Full Height Sections
		$('.st-full-height').each(function(){
			if( ! $(this).closest('.onepage-top-section').length) $(this).height(window.innerHeight - $('#wpadminbar').height());
		});

		// Full height fix
		function resizeFullHeight() {
			$('.container-fullheight').height(window.innerHeight - $('#wpadminbar').height());
		}

		$(window).resize(function () {
			resizeFullHeight();
		});
		$(window).load(function () {
			resizeFullHeight();
		});
		setTimeout(function () {
			resizeFullHeight();
            init_gallery_filters_underline();
		}, 1);

		init_video_background();

		init_creative_mind();

		// Init Validation Engine
		if ($.fn.validationEngine) {
			$(".validation-engine").validationEngine();
		}

		init_ajax_forms();

		if( ! Modernizr.placeholder && $.fn.placeholder) $('input, textarea').placeholder();

		// Bootstrap tooltips
		if($.fn.tooltip) $('a[data-toggle="tooltip"]').tooltip();

		init_scroll_to_top();

		set_parallax_footer_height();
		$(window).on('load resize', set_parallax_footer_height);

    }); // Document ready


	// ============================================================================
	// Startup animations
	// ============================================================================

	function animate_init() {

		// Add animate class where data-animate attribute is set
		var
			startTopOfWindow = $(window).scrollTop();

		$('[data-animate]').each(function () {
			if ( ($(this).offset().top + $(this).height() > startTopOfWindow )
			   && Modernizr.csstransitions
				&& $(window).width() >= 768
				&& ! Modernizr.touch )
			{
				$(this).addClass('animated');
			}else $(this).removeAttr('data-animate');
		});

		// Skip animation for mobile devices
		if($(window).width() < 768 && Modernizr.touch) return;

		// Remove style for progress bars on start
		$('.progress-bar.animate').each(function () {
			var $this = $(this);
			// Remove progress-bar class and return it on timeout to cancel transition animation
			$this.removeClass('progress-bar').css('width', '');
			setTimeout(function () {
				$this.addClass('progress-bar')
			}, 10);
		});

		// Animate on page start
		setTimeout(function () {
			animate_on_scroll()
		}, 50);

		// Anitame elements on scroll
		$(window).bind('scroll.vmanimate', function () {
			animate_on_scroll();
		});

		// Remove classes after animate is complete
		$('.animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
			$(this).removeClass('animated').removeClass($(this).data('animate')).removeAttr('data-animate');
		});

		function animate_on_scroll() {
			var topOfWindow = $(window).scrollTop();
			var bottomOfWindow = topOfWindow + $(window).height();
			var $elms = $('.animated, .animate').each(function () {
				var $this = $(this);
				if ($this.offset().top + 100 < bottomOfWindow) {
					if ($this.hasClass('knob'))
						animate_knob($this);
					else if ($this.hasClass('progress-bar'))
						animate_progress($this);
					else if ($this.hasClass('animate-number'))
						animate_number($this);
					else
						$this.addClass($this.data('animate')).removeAttr('data-animate');
				}
			});
			if ($elms.length == 0) $(window).unbind('scroll.vmanimate');
		}

		function animate_knob($knob) {
			// Animate once
			$knob.removeClass('animate');
			var myVal = parseInt($knob.val());

			$({value: 0}).animate({value: myVal}, {
				duration: 1500,
				easing: 'swing',
				step: function () {
					$knob.val(Math.ceil(this.value)).trigger('change');
				}
			});
		}

		function animate_progress($progress) {
			// Animate once
			$progress.removeClass('animate');

			var valStart = parseInt($progress.attr('aria-valuemin'));
			var myVal = parseInt($progress.attr('aria-valuenow'));
			var $value = $progress.parent().siblings('.value');

			// Transitions animation
			$progress.css({width: myVal + '%'});

			$({value: valStart}).animate({value: myVal}, {
				duration: 1500,
				easing: 'swing',
				step: function () {
					$value.text(this.value.toFixed() + '%');
				}
			})
		}

		function animate_number($block) {
			// Animate once
			$block.removeClass('animate');

			var valStart = 0;
			var myVal = parseInt($block.text().replace(' ', ''));

			$({value: valStart}).animate({value: myVal}, {
				duration: 1500,
				easing: 'swing',
				step: function () {
					$block.text(this.value.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, " "));
				}
			})
		}

	} // animate_init


	// ============================================================================
	// Layer Slider
	// ============================================================================

	function init_layer_slider() {

		// Onepage 100% height
		var $ls_fullheiht = $('.ls-fullheight');
		var $ls_fullheiht_menu = $('.ls-fullheight-menu');
		var wpadminbar_height = $('#wpadminbar').height();
		var topmenu_height = $('.top-menu').height();
		if($ls_fullheiht.length || $ls_fullheiht.length){
			$ls_fullheiht.height(window.innerHeight - wpadminbar_height);
			$ls_fullheiht_menu.height(window.innerHeight - topmenu_height - wpadminbar_height);
		}

		// Layer (slide) to start from
		var firstLayer = 1;

		// Detect first layer if "gallery_single_full_show_around" option is used
		var $slider = $('#layerslider-singlework2, #layerslider-singlework1, #layerslider-singlework-thumbs');
		if( $slider.length ) {
			var $current_post_slide = $slider.find('.current-post-slide');
			if( $current_post_slide.length) firstLayer = $current_post_slide.index() + 1;
		}

		// Usual slider
		$('#layerslider').layerSlider({
			sublayerContainer: 1170,
			skin: 'mental',
			skinsPath: mental_vars.siteurl+'/wp-content/themes/mental/assets/plugins/layerslider/skins/',
			showBarTimer: true,
			showCircleTimer: false,
			pauseOnHover: false,
			firstLayer: firstLayer
		});

		// Single Work style 1
		$('#layerslider-singlework1').layerSlider({
			skin: 'mental',
			skinsPath: mental_vars.siteurl+'/wp-content/themes/mental/assets/plugins/layerslider/skins/',
			showBarTimer: true,
			showCircleTimer: false,
			pauseOnHover: false,
			autoStart: false,
			firstLayer: firstLayer,
			cbAnimStart: function (data) {
				$('#lsmb-title').text(data.nextLayer.data('title'));
			}
		});

		// Single Work style 2
		$('#layerslider-singlework2').layerSlider({
			// sublayerContainer: 1170,
			skin: 'mental',
			skinsPath: mental_vars.siteurl+'/wp-content/themes/mental/assets/plugins/layerslider/skins/',
			showBarTimer: true,
			showCircleTimer: false,
			pauseOnHover: false,
			autoStart: false,
			firstLayer: firstLayer,
			cbAnimStart: function (data) {
				$('.ls-mn-counter').html('<em>' + pad(data.nextLayerIndex, 2) + '</em>/' + pad(data.layersNum, 2));
			}
		});
		$('.ls-mn-prev').click(function (e) {
			e.preventDefault();
			$('#layerslider-singlework2').layerSlider('prev');
		});
		$('.ls-mn-next').click(function (e) {
			e.preventDefault();
			$('#layerslider-singlework2').layerSlider('next');
		});

		function pad(str, max) {
			str = str.toString();
			return str.length < max ? pad("0" + str, max) : str;
		}

		// Single Work with thumbnails
		$('#layerslider-singlework-thumbs').layerSlider({
			skin: 'mental',
			skinsPath: mental_vars.siteurl+'/wp-content/themes/mental/assets/plugins/layerslider/skins/',
			responsive: true,
			showBarTimer: true,
			showCircleTimer: false,
			pauseOnHover: false,
			autoStart: false,
			thumbnailNavigation: 'always',
			tnWidth: 170,
			tnHeight: 110,
			tnActiveOpacity: 100,
			tnInactiveOpacity: 40,
			tnContainerWidth: '80%',
			firstLayer: firstLayer,
			cbAnimStart: function (data) {
				$('#lsmb-title').text(data.nextLayer.data('title'));
			}
		});


		// Onepage - Scroll under slider on click on round white arrow
		$('.ls-mental-scrollunder').click(function (e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: $('#layerslider').outerHeight(true) + 40
			}, 1000);
		});

	}


	// ============================================================================
	// Smooth scrolling to element ID
	// ============================================================================

	function init_smooth_scrolling() {
		var fixed_topbar_height = $('body').data('offset') - 5;
		$(".smoothscroll a[href^='#']").on('click', function (e) {
                        var hashTag = $.attr(this, 'href').substr(1);
			if ($(this).closest(".nav-tabs").length) return true;
			// prevent default anchor click behavior
			e.preventDefault();
			// add hash to url

			if ($(this.hash).offset()) var top = $(this.hash).offset().top;
			else var top = 0;
                        
                        $('html, body').stop();
			$('html, body').animate({
				scrollTop: top - fixed_topbar_height
			}, 1000, function(){
                                window.location.hash = hashTag;
                                $('html, body').scrollTop(top - fixed_topbar_height);
				if(typeof(window.history.pushState) == 'function') {
					//window.history.pushState(null, null, this.hash);
				} else {
					//window.location.hash = this.hash;
					$('html, body').scrollTop(top - fixed_topbar_height);
				}
			});

		});
	}
        
        window.addEventListener("popstate", function(e) {
            if (location.hash && jQuery(".smoothscroll a[href='" + location.hash + "']").length){
                //jQuery(".smoothscroll a[href='" + location.hash + "']").trigger('click');
            }
        });


	// ============================================================================
	// Fixed top Menu Bar
	// ============================================================================

	function init_fixed_topbar() {
		var offset = 0;
		var $top_menu = $('.top-menu.tm-fixonscroll');
                var prevTop = 0;
		if (!$top_menu.length) return;
                if ($top_menu.data('fixed-on-scroll-top') == '1'){
                    $(window).scroll(function () {
                            if (($(window).scrollTop() > $('.top-menu.tm-fixonscroll').offset().top + offset)) {
                                if ($(window).scrollTop() < prevTop){
                                    $top_menu.addClass('tm-fixed').removeClass('tm-fixed-hidden');
                                }else if ($(window).scrollTop() > prevTop){
                                    $top_menu.removeClass('tm-fixed').addClass('tm-fixed-hidden');
                                }
                            } else {
                                    $top_menu.removeClass('tm-fixed');
                            }
                            prevTop = $(window).scrollTop();
                    });
                }else{
                    $(window).scroll(function () {
                            if (($(window).scrollTop() > $('.top-menu.tm-fixonscroll').offset().top + offset)) {
                                $top_menu.addClass('tm-fixed');
                            } else {
                                    $top_menu.removeClass('tm-fixed');
                            }
                    });
                }
	}


	// ============================================================================
	// Gallery filters moving on hover underline
	// ============================================================================

	function init_gallery_filters_underline() {

        $('.gallery-filters >li.active').each(function(){
            go_to_item($(this));
        });

		$('.gallery-filters >li:not(.gf-underline)').hover(function () {
			go_to_item($(this));
		}, function () {
			go_to_item($(this).siblings('.active'));
		});

		function go_to_item($item) {
			if ($item.length == 0) return;
			var parent_left = $item.parent().length ? $item.parent().offset().left : 0;
			var offset = $item.offset().left - parent_left;
			$item.siblings('.gf-underline').css({left: offset, width: $item.width()});
		}
	}


	// ============================================================================
	// Video background
	// ============================================================================

	function init_video_background() {

		var $video_container = $('.st-video-background');
		var $video = $video_container.find('video');

		var vid_w_orig = parseInt($video.attr('width'));
		var vid_h_orig = parseInt($video.attr('height'));

		$(window).resize(function () {
			resizeToCover();
		});
		resizeToCover();

		function resizeToCover() {
			// use largest scale factor of horizontal/vertical
			var scale_h = $video_container.width() / vid_w_orig;
			var scale_v = $video_container.height() / vid_h_orig;
			var scale = scale_h > scale_v ? scale_h : scale_v;
			// scale the video
			$video.width(scale * vid_w_orig);
			$video.height(scale * vid_h_orig);
			// center it by scrolling the video viewport
			$video_container.scrollLeft(($video.width() - $(window).width()) / 2);
			$video_container.scrollTop(($video.height() - $(window).height()) / 2);
		}

		// Firefox fix: play in loop
		$video.bind('ended', function () {
			this.play();
		});
	}


	// ============================================================================
	// Creative Mind Block
	// ============================================================================

	function init_creative_mind() {
		$('.cm-item').hover(function () {
			var $this = $(this);
			var $creative_minds = $this.closest('.creative-minds');
			$creative_minds.find('.col-cm').removeClass('active');
			$this.closest('.col-cm').addClass('active');
		});
	}


	// ============================================================================
	// Send form using Ajax
	// ============================================================================

	function init_ajax_forms() {
		$('.ajax-send').submit(function (e) {
			e.preventDefault();
			var $this = $(this);
			var action = $this.attr('action');

			if (!$this.validationEngine('validate')) return false;

			var $spinner = $this.find('.loading-spinner').show();

			$.ajax({
				type: "POST",
				url: 'formmail.php',
				data: $this.serialize(), // serializes the form's elements.
				success: function (data) {
					$this.find('input[type=text], input[type=email], textarea').val(''); // Clear form
					$this.prepend('<div class="alert alert-success">Your message was sent!</div>'); // Show success message
				},
				complete: function (jqXHR, textStatus) {
					$spinner.hide();
				},
				error: function (jqXHR, textStatus, errorMessage) {
					console.log(errorMessage);
				}
			});

		});
	}

	// ============================================================================
	// Onepage Top Section
	// ============================================================================

	function init_onepage_top_section() {
		$('.onepage-top-section.ots-full').height(window.innerHeight - $('#wpadminbar').height());
		$('.onepage-top-section.ots-full-menu').height(window.innerHeight - $('#wpadminbar').height() - $('.top-menu').height());
	}


	// ============================================================================
	// WPML language switcher in mtmenu fix
	// ============================================================================

	function wpml_lang_switcher_mtmenu_fix()
	{
		$(".mtmenu .submenu-languages").addClass('dropdown');
	}


	// ============================================================================
	// Scroll to top
	// ============================================================================

	function init_scroll_to_top()
	{
		if($('#azl_scroll_up').length == 0) return;

		function pos(){
			if($(window).scrollTop() != 0) {
				$('#azl_scroll_up').css('transform', 'translateX(-20px) translateZ(0)');
			} else {
				$('#azl_scroll_up').css('transform', 'translateX(100%) translateZ(0)');
			}
		}

		$(window).scroll(pos);

		$('#azl_scroll_up').on('click touchstart', function(e) {
			e.preventDefault();
			$('body,html').animate({scrollTop:0},800);
		});
	}

	function set_parallax_footer_height()
	{
		if($( ".parallax-footer" ).length > 0 && $('.footer').length > 0) {
			var margin_bottom = ($(window).width() > 1199) ? $('.footer').outerHeight(true) : 0;
			//var margin_bottom = $('.footer').outerHeight(true);
			if($('#main').length > 0)
				$('#main').css('margin-bottom', margin_bottom);
		}
	}


    // ============================================================================
    // Open cart
    // ============================================================================
    var stop_ajax = 1, is_add = '';
    $(document).on('click', '.ajax_add_to_cart', function() {
        stop_ajax = 2;
        is_add = 'added';
    });

    $(document).on('click', '.product-remove .remove', function() {
        stop_ajax = 3;
        is_add = 'remove';
    });



    $( document ).ajaxComplete(function() {
        if(stop_ajax == 2 && is_add == 'added'){
            changeCart();
            stop_ajax = 1, is_add = '';
        }


        if(stop_ajax == 3 && is_add == 'remove'){
            RemoveCartProduct();
            stop_ajax = 1, is_add = '';
        }

    });

     function changeCart(){

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'ms_poput_cart_product'
            },
            dataType: 'json',

            complete: function(response) {
                var json = response.responseJSON;
                $('.nm-menu-cart-count.count').text(json.cart_count);

            }
        });
    }

    function RemoveCartProduct() {

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'ms_mini_cart_remove_product',
            },
            dataType: 'json',
            
            complete: function(response) {
                var json = response.responseJSON;
                $('.nm-menu-cart-count.count').text(json.cart_count);
            }
        });
    }


    // ============================================================================
    // Modification gallery
    // ============================================================================
    var finish = 0;
    var startHeight = 0;
    var galleryGlobal = 0;
    function customIsotopeFilter() {
        
         var container = $('.gallery-home  '),
             element = $('.gallery-item_s'),
             wrappHeight = container.height(),
             wrappWidth = parseInt(container.width()),
             elementHeight = parseInt(element.outerHeight()),
             elementWidth = parseInt(element.width()),
             amount = container.data('amount'),
             rowItem = Math.round(wrappWidth / elementWidth),
             rows = (amount * elementWidth) / wrappWidth,
             rowsFixed = rows.toFixed(1),
             rowsCeil = Math.ceil(rowsFixed),
             count = 0;

            $('.gallery-item_s').each(function () {
                count++;
                $(this).addClass('visible-item-gl item-resize');
                 if(count == amount) {
                    return false;
                 }
            });
        
              startHeight = (elementHeight * rowsCeil) - 1;


              setTimeout(function () {
                  container.height(startHeight);
                  $('.gallery-home ').css({
                      'max-height' : 10000
                  });
                  localStorage.setItem('allHeight', startHeight);
              }, 200);

    }

    customIsotopeFilter();
    resizeData();
    $(window).on('load', function () {
        customIsotopeFilter();
        localStorage.removeItem('filter0');
        localStorage.removeItem('filter1');
        localStorage.removeItem('filter2');
        localStorage.removeItem('filter3');
        localStorage.removeItem('filter4');
        localStorage.removeItem('filter5');
        localStorage.removeItem('filter6');
        localStorage.removeItem('filter7');
        localStorage.removeItem('filter8');
        localStorage.removeItem('filter9');
		localStorage.removeItem('filter10');
    });

    function resizeData() {
        var container = $('.gallery-home '),
            element = $('.gallery-item_s'),
            wrappHeight = container.height(),
            wrappWidth = parseInt(container.width()),
            elementHeight = parseInt(element.outerHeight()),
            elementWidth = parseInt(element.width()),
            amount = $('.item-resize').length,
            rowItem = Math.round(wrappWidth / elementWidth),
            rows = (amount * elementWidth) / wrappWidth,
            rowsFixed = rows.toFixed(1),
            rowsCeil = Math.ceil(rowsFixed);

       startHeight = (elementHeight * rowsCeil) - 1;

        setTimeout(function () {
            container.height(startHeight);
            $('.gallery-home ').css({
                'max-height' : 10000
            });
            localStorage.setItem('allHeight', startHeight);
        }, 200);
    }


    galleryGlobal = startHeight;

    var rtime;
    var timeout = false;
    var delta = 1000;
    $(window).resize(function() {
    	$('.gallery-item_s').removeClass('gallery-item-anime');
        rtime = new Date();
        finish = 1;
        resizeData();
        if (timeout === false) {
            timeout = true;
            setTimeout(resizeend, delta);
        }
    });

    function resizeend() {
        if (new Date() - rtime < delta) {
            setTimeout(resizeend, delta);
            resizeData();
            galleryGlobal = startHeight;
            finish = 0;
        } else {
            timeout = false;
        }
    }


    $(window).on('scroll', function () {

        if( $('#scload').length) {

            var container = $('.gallery-home '),
                containerInner = $('.gallery-home-inner').height(),
                wrappHeight = container.height(),
                element = $('.gallery-item_s'),
                elementHeight = parseInt(element.outerHeight()),
                elmentPosition = $('#scload').offset().top,
                topOfWindow = $(window).scrollTop(),
                elementWidth = parseInt(element.width()),
                wrappWidth = parseInt(container.width()),
                countItemsInRow = Math.round(wrappWidth / elementWidth),
                rows = Math.round(wrappHeight  / elementHeight) + 1,
                activeItems = countItemsInRow * rows,
                count = 0;


            if (topOfWindow + $(window).height() > (elmentPosition + 10 ) && finish == 0) {
            	$('.gallery-item_s').addClass('gallery-item-anime');
                finish = 1;
                $('.no-more-items-sign').hide();
                $('.load-more-block .loading-spinner').css({'display' : 'inline-block'});
                $('.no-more-items-sign').css({'display' : 'none'});
                var loadMore = setTimeout(function () {
                    $('.gallery-item_s').removeClass('hidden-item-gl');
                    $('.gallery-item_s').each(function () {
                        count++;
                        $(this).addClass('visible-item-gl item-resize');
                        if(count == activeItems) {
                            return false;
                        }
                    });

                    $('.load-more-block .loading-spinner').css({'display' : 'none'});
                    $('.gallery-item_s').addClass('visible-item-vs');

                    var localHeight = +localStorage.getItem('allHeight');
                	galleryGlobal = localHeight;
                    galleryGlobal += elementHeight;
                    container.height(galleryGlobal - 2);
                    if($('.gallery-home ').hasClass('active')) {
                        $('.gallery-home ').addClass('active2');
                        localStorage.setItem('allHeight', galleryGlobal - 2);
                    }
                    finish = 0;

                }, 1500);
            }

            if((containerInner - wrappHeight) < 10 ){

                container.height(containerInner);
                clearTimeout(loadMore);
                $('.load-more-block .loading-spinner').css({'display' : 'none'});
                $('.no-more-items-sign').css({'display' : 'inline-block'});
            }

            if (wrappHeight > containerInner) {
                container.height(containerInner);
            }
        }

        if($('.item-filter').hasClass('active')) {

        	setTimeout(function() {
        		var currentPoint = 	$('.item-filter.active').data('fl'),
        		hg = $('.gallery-home').outerHeight();

        		localStorage.setItem(currentPoint, hg);

        }, 2000)
        	
        }
    });


    $('.load-more-button2').on('click', function () {
        $('.gallery-item_s').addClass('gallery-item-anime');
            
        $('#load-more-block.no-more-items .loading-spinner').addClass('active');
        $('#load-more-block.load-more-block .load-more-button.load-more-button2').addClass('active');
        var container = $('.gallery-home '),
            containerInner = $('.gallery-home-inner').height(),
            wrappHeight = parseInt(container.height()),
            element = $('.gallery-item_s'),
            elementHeight = parseInt(element.outerHeight()),
            elementWidth = parseInt(element.width()),
            wrappWidth = parseInt(container.width()),
            countItemsInRow = Math.round(wrappWidth / elementWidth),
            rows = Math.round(wrappHeight  / elementHeight) + 1,
            activeItems = countItemsInRow * rows,
            count = 0; 
        if (finish == 0) {
            finish = 1;
            var loadMore = setTimeout(function () {
                $('#load-more-block.no-more-items .loading-spinner').removeClass('active');
                $('#load-more-block.load-more-block .load-more-button.load-more-button2').removeClass('active');
                $('.gallery-item_s').removeClass('hidden-item-gl');

                $('.gallery-item_s').each(function () {
                    count++;   

                    $(this).addClass('visible-item-gl item-resize');
                    
                    if(count == activeItems) {
                        return false;
                    } 
                });

         
                $('.gallery-item_s').addClass('visible-item-vs');

           
                var localHeight = +localStorage.getItem('allHeight');

                if((containerInner - wrappHeight) > 20 ){
                		if( $('.gallery-home ').hasClass('active')) {
                			galleryGlobal = localHeight;
                			galleryGlobal += elementHeight;
                		} else {
                			galleryGlobal += elementHeight;
                		}	
                }


                container.height(galleryGlobal - rows);
 				if($('.gallery-home ').hasClass('active')) {
                    $('.gallery-home ').addClass('active2');
                    localStorage.setItem('allHeight', galleryGlobal - rows);
                }
       
                $('.gallery-home-inner').isotope();


               
                finish = 0;

            }, 1500);
        }

        if((containerInner - wrappHeight) < 20 ){

            container.height(containerInner);
            $('#load-more-block.no-more-items .loading-spinner').removeClass('active');
            $('#load-more-block.load-more-block .load-more-button.load-more-button2').addClass('active');
            $('#load-more-block.loadmore #item-more').addClass('active');
            clearTimeout(loadMore);
            $('.load-more-block .loading-spinner').css({'display' : 'none'});
            $('.no-more-items-sign').css({'display' : 'inline-block'});

        }

        if (wrappHeight > containerInner) {
            container.height(containerInner);
        }

        if($('.item-filter').hasClass('active')) {

        	setTimeout(function() {
        		var currentPoint = 	$('.item-filter.active').data('fl'),
        		hg = $('.gallery-home').outerHeight();

        		localStorage.setItem(currentPoint, hg);

        }, 2000)
        	
        }

    });


    $('.gallery-item_s').on('click', function () {

    	$('.gallery-item_s').removeClass('gallery-item-anime');
        $('#load-more-block').addClass('active');

        finish = 1;

        $('.gallery-home ').css({
            'max-height' : 10000
        });
        var wrapp = $('.gallery-home ').height();
        if (!$(this).hasClass('gallery-item-clicked')) {
            localStorage.setItem('height', $('.gallery-home ').height());
        }  else {
            wrapp = localStorage.getItem('height');
        }
        $('.gallery-item_s').addClass('gallery-item-clicked');

        setTimeout(function () {
            var popup = $('.gallerys .gl-item.gl-preview > div').outerHeight();
            var sum = +wrapp + popup;
            
            $('.gallery-home ').height(sum);

        }, 200)

    });


    $(document).on('click', '.gallery-home  .glp-close', function (e) {
        $('#load-more-block').removeClass('active');
        e.preventDefault();
        var wrapp = $('.gallery-home ').height();
        var popup = $('.gallerys .gl-item.gl-preview > div').outerHeight();
        $('.gallery-item_s').removeClass('gallery-item-clicked');
        localStorage.setItem('height', 0);

        $('.gallery-home ').height(wrapp - popup);
        setTimeout(function () {
            finish = 0;
        }, 200)
    });


    $('.all-filter_s').on('click', function () {
		$('.visible-item-gl').removeClass('visible-item-gl2');
    	$('.gallery-item_s').removeClass('gallery-item-anime');
    	$('.gallery-item_s').removeClass('filter0 filter1 filter2 filter3 filter4 filter5 filter6 filter7 filter8 filter9 filter10');
		$('.gallery-home-inner').isotope();
        $('.gallery-home ').addClass('active').removeClass('gallery-home-filter');

        if(!$('.gallery-home ').hasClass('active2')) {
            $('.gallery-item_s').removeClass('visible-item-gl visible-item-vs');

            var amount = $('.gallery-home ').data('amount'),
            count = 0;

            $('.gallery-item_s').each(function () {
                count++;
                $(this).addClass('visible-item-gl');
                if(count == amount) {
                    return false;
                }
            });

        }

        $('.gallery-item_s').removeClass('visible-item-filter');
        $('.gallery-item_s').removeClass('hidden-item-gl');
        if($('.load-more-button2').length) {
            var  active  = localStorage.getItem('active');
            $('#load-more-block.loadmore #item-more').removeClass('active');
            $('#load-more-block.load-more-block .load-more-button.load-more-button2').removeClass('active');
        }


        var container = $('.gallery-home '),
            containerInner = $('.gallery-home-inner').height(),
            wrappHeight = container.height();

        var currentHeight =  localStorage.getItem('allHeight');
        $('.gallery-home ').height(currentHeight);


        $('.gallery-home ').css({
            'max-height' : 10000
        });


        setTimeout(function () {
            finish = 0;
        }, 200);
    });


    $('.item-filter').on('click', function () {
 		var currentPoint = 	$(this).data('fl');
    	$('.visible-item-gl').addClass('visible-item-gl2');
    	$('.gallery-item_s').removeClass('gallery-item-anime visible-item-vs');

        $('.gallery-home ').removeClass('active').addClass('gallery-home-filter');
        $('.gallery-item_s').addClass('hidden-item-gl');

        $('.no-more-items-sign').hide();

        finish = 1;

        var container = $('.gallery-home '),
            thisAttr = $(this).find('a').data('filter'),
            elementsLenght = $('.gallery-item_s[data-category *='+ thisAttr + ']').length,
            element = $('.gallery-item_s'),
            containerInner = $('.gallery-home-inner').height(),
            wrappHeight = container.height(),
            wrappWidth = parseInt(container.width()),
            elementHeight = parseInt(element.outerHeight()),
            filterHeight = elementHeight * elementsLenght,
            elementWidth = parseInt(element.width()),
            amount = container.data('amount'),
            rowItem = Math.round(wrappWidth / elementWidth),
            amountFilter = elementsLenght,
            count = 0;

        $('.gallery-item_s[data-category *='+ thisAttr + ']').each(function () {
            count++;
            $(this).addClass('visible-item-filter');
            if(count == amount) {
                return false;
            }
        });

        if(elementsLenght >= amount ) {
            amountFilter = amount;

        } else  {

            $('.no-more-items-sign').css({'display' : 'none'});
        }


        if(elementsLenght > amount ) {
            $('#load-more-block.loadmore #item-more').removeClass('active');
            $('#load-more-block.load-more-block .load-more-button.load-more-button2').removeClass('active');

        } else  {
            $('#load-more-block.loadmore #item-more').addClass('active');
            $('#load-more-block.load-more-block .load-more-button.load-more-button2').addClass('active');
        }

         var rows = (amountFilter * elementWidth) / wrappWidth,
            rowsFixed = rows.toFixed(1),
            rowsCeil = Math.ceil(rowsFixed),
             rows2 = (elementsLenght * elementWidth) / wrappWidth,
             rowsFixed2 = rows2.toFixed(1),
             rowsCeil2 = Math.ceil(rowsFixed2),
            newHeight = 0;

        startHeight = (elementHeight * rowsCeil) - 1;
        var maxHeight = (elementHeight * rowsCeil2);

        container.css({
            'max-height' : maxHeight
        });

          

        if(localStorage.getItem(currentPoint)) {
    		container.height(+localStorage.getItem(currentPoint));
    		$('.gallery-item_s').removeClass('filter0 filter1 filter2 filter3 filter4 filter5 filter6 filter7 filter8 filter9 filter10').addClass(currentPoint);
    		finish = 0;
    	} else {
    		setTimeout(function () {
           		 container.height(startHeight);
            	finish = 0;
           
        	}, 200);
    	}


    });


    // ============================================================================
    // Modification product gallery
    // ============================================================================
    var finishp = 0;
    var startHeightp = 0;
    var galleryGlobalp = 0;
    function customIsotopeFilterp() {
        
         var container = $('.gallery-home_p '),
             element = $('.gallery-item_p'),
             wrappHeight = container.height(),
             wrappWidth = parseInt(container.width()),
             elementHeight = parseInt(element.outerHeight()),
             elementWidth = parseInt(element.width()),
             amount = container.data('amount'),
             rowItem = Math.round(wrappWidth / elementWidth),
             rows = (amount * elementWidth) / wrappWidth,
             rowsFixed = rows.toFixed(1),
             rowsCeil = Math.ceil(rowsFixed),
             count = 0;

            $('.gallery-item_p').each(function () {
                count++;
                $(this).addClass('visible-item-glp item-resizep');
                 if(count == amount) {
                    return false;
                 }
            });
        
              startHeightp = (elementHeight * rowsCeil) - 1;


              setTimeout(function () {
                  container.height(startHeightp);
                  $('.gallery-home_p ').css({
                      'max-height' : 10000
                  });
                  localStorage.setItem('allHeightp', startHeightp);
              }, 200);

    }

    customIsotopeFilterp();
    resizeDatap();
    $(window).on('load', function () {
        customIsotopeFilterp();
        localStorage.removeItem('filter0p');
        localStorage.removeItem('filter1p');
        localStorage.removeItem('filter2p');
        localStorage.removeItem('filter3p');
        localStorage.removeItem('filter4p');
        localStorage.removeItem('filter5p');
        localStorage.removeItem('filter6p');
        localStorage.removeItem('filter7p');
        localStorage.removeItem('filter8p');
        localStorage.removeItem('filter9p');
		localStorage.removeItem('filter10p');
    });

    function resizeDatap() {
        var container = $('.gallery-home_p '),
            element = $('.gallery-item_p'),
            wrappHeight = container.height(),
            wrappWidth = parseInt(container.width()),
            elementHeight = parseInt(element.outerHeight()),
            elementWidth = parseInt(element.width()),
            amount = $('.item-resizep').length,
            rowItem = Math.round(wrappWidth / elementWidth),
            rows = (amount * elementWidth) / wrappWidth,
            rowsFixed = rows.toFixed(1),
            rowsCeil = Math.ceil(rowsFixed);

       startHeightp = (elementHeight * rowsCeil) - 1;

        setTimeout(function () {
            container.height(startHeightp);
            $('.gallery-home_p ').css({
                'max-height' : 10000
            });
            localStorage.setItem('allHeightp', startHeightp);
        }, 200);
    }


    galleryGlobalp = startHeightp;

    var rtimep;
    var timeoutp = false;
    var deltap = 1000;
    $(window).resize(function() {
    	$('.gallery-item_p').removeClass('gallery-item-animep');
        rtimep = new Date();
        finish = 1;
        resizeDatap();
        if (timeoutp === false) {
            timeoutp = true;
            setTimeout(resizeendp, deltap);
        }
    });

    function resizeendp() {
        if (new Date() - rtimep < deltap) {
            setTimeout(resizeendp, deltap);
            resizeData();
            galleryGlobalp = startHeightp;
            finish = 0;
        } else {
            timeoutp = false;
        }
    }


    $(window).on('scroll', function () {

        if( $('#scloadp').length) {

            var container = $('.gallery-home_p '),
                containerInner = $('.gallery-home-innerp').height(),
                wrappHeight = container.height(),
                element = $('.gallery-item_p'),
                elementHeight = parseInt(element.outerHeight()),
                elmentPosition = $('#scloadp').offset().top,
                topOfWindow = $(window).scrollTop(),
                elementWidth = parseInt(element.width()),
                wrappWidth = parseInt(container.width()),
                countItemsInRow = Math.round(wrappWidth / elementWidth),
                rows = Math.round(wrappHeight  / elementHeight) + 1,
                activeItems = countItemsInRow * rows,
                count = 0;


            if (topOfWindow + $(window).height() > (elmentPosition + 10 ) && finishp == 0) {
            	$('.gallery-item_p').addClass('gallery-item-animep');
                finishp = 1;
                $('.no-more-items-signp').hide();
                $('.load-more-blockp .loading-spinner').css({'display' : 'inline-block'});
                $('.no-more-items-signp').css({'display' : 'none'});
                var loadMore = setTimeout(function () {
                    $('.gallery-item_p').removeClass('hidden-item-glp');
                    $('.gallery-item_p').each(function () {
                        count++;
                        $(this).addClass('visible-item-glp item-resizep');
                        if(count == activeItems) {
                            return false;
                        }
                    });

                    $('.load-more-blockp .loading-spinner').css({'display' : 'none'});
                    $('.gallery-item_p').addClass('visible-item-vsp');

                    var localHeight = +localStorage.getItem('allHeightp');
                	galleryGlobalp = localHeight;
                    galleryGlobalp += elementHeight;
                    container.height(galleryGlobalp - 2);
                    if($('.gallery-home_p ').hasClass('active')) {
                        $('.gallery-home_p ').addClass('active2');
                        localStorage.setItem('allHeightp', galleryGlobalp - 2);
                    }
                    finishp = 0;

                }, 1500);
            }

            if((containerInner - wrappHeight) < 10 ){

                container.height(containerInner);
                clearTimeout(loadMore);
                $('.load-more-blockp .loading-spinner').css({'display' : 'none'});
                $('.no-more-items-signp').css({'display' : 'inline-block'});
            }

            if (wrappHeight > containerInner) {
                container.height(containerInner);
            }
        }

        if($('.item-filterp').hasClass('active')) {

        	setTimeout(function() {
        		var currentPointp = $('.item-filterp.active').data('fl'),
        		hg = $('.gallery-home_p').outerHeight();

        		localStorage.setItem(currentPointp, hg);

        }, 2000)
        	
        }
    });


    $('.load-more-buttonp').on('click', function () {
        $('.gallery-item_p').addClass('gallery-item-animep');
            
        $('#load-more-blockp.no-more-items .loading-spinner').addClass('active');
        $('#load-more-blockp.load-more-block .load-more-button.load-more-buttonp').addClass('active');
        var container = $('.gallery-home_p '),
            containerInner = $('.gallery-home-innerp').height(),
            wrappHeight = parseInt(container.height()),
            element = $('.gallery-item_p'),
            elementHeight = parseInt(element.outerHeight()),
            elementWidth = parseInt(element.width()),
            wrappWidth = parseInt(container.width()),
            countItemsInRow = Math.round(wrappWidth / elementWidth),
            rows = Math.round(wrappHeight  / elementHeight) + 1,
            activeItems = countItemsInRow * rows,
            count = 0; 
        if (finishp == 0) {
            finishp = 1;
            var loadMore = setTimeout(function () {
                $('#load-more-blockp.no-more-items .loading-spinner').removeClass('active');
                $('#load-more-blockp.load-more-block .load-more-button.load-more-buttonp').removeClass('active');
                $('.gallery-item_p').removeClass('hidden-item-glp');

                $('.gallery-item_p').each(function () {
                    count++;   

                    $(this).addClass('visible-item-glp item-resizep');
                    
                    if(count == activeItems) {
                        return false;
                    } 
                });

         
                $('.gallery-item_p').addClass('visible-item-vsp');

           
                var localHeight = +localStorage.getItem('allHeightp');

                if((containerInner - wrappHeight) > 20 ){
                		if( $('.gallery-home_p ').hasClass('active')) {
                			galleryGlobalp = localHeight;
                			galleryGlobalp += elementHeight;
                		} else {
                			galleryGlobalp += elementHeight;
                		}	
                }


                container.height(galleryGlobalp );
 				if($('.gallery-home_p ').hasClass('active')) {
                    $('.gallery-home_p ').addClass('active2');
                    localStorage.setItem('allHeightp', galleryGlobalp);
                }
       
                $('.gallery-home-innerp').isotope();


               
                finishp = 0;

            }, 1500);
        }

        if((containerInner - wrappHeight) < 20 ){

            container.height(containerInner);
            $('#load-more-blockp.no-more-items .loading-spinner').removeClass('active');
            $('#load-more-blockp.load-more-block .load-more-button.load-more-buttonp').addClass('active');
            $('#load-more-blockp.loadmore #item-more').addClass('active');
            clearTimeout(loadMore);
            $('.load-more-blockp .loading-spinner').css({'display' : 'none'});
            $('.no-more-items-signp').css({'display' : 'inline-block'});

        }

        if (wrappHeight > containerInner) {
            container.height(containerInner);
        }

        if($('.item-filterp').hasClass('active')) {

        	setTimeout(function() {
        		var currentPointp = 	$('.item-filterp.active').data('fl'),
        		hg = $('.gallery-home_p').outerHeight();

        		localStorage.setItem(currentPointp, hg);

        }, 2000)
        	
        }

    });


    $('.gallery-item_p').on('click', function () {

    	$('.gallery-item_p').removeClass('gallery-item-animep');
        $('#load-more-blockp').addClass('active');

        finish = 1;

        $('.gallery-home_p ').css({
            'max-height' : 10000
        });
        var wrapp = $('.gallery-home_p ').height();
        if (!$(this).hasClass('gallery-item-clickedp')) {
            localStorage.setItem('heightp', $('.gallery-home_p ').height());
        }  else {
            wrapp = localStorage.getItem('heightp');
        }
        $('.gallery-item_p').addClass('gallery-item-clickedp');

        setTimeout(function () {
            var popup = $('.galleryp .gl-item.gl-preview > div').outerHeight();
            var sum = +wrapp + popup;
            
            $('.gallery-home_p ').height(sum);

        }, 200)

    });


    $(document).on('click', '.gallery-home_p .glp-close', function (e) {
        $('#load-more-blockp').removeClass('active');
        e.preventDefault();
        var wrapp = $('.gallery-home_p ').height();
        var popup = $('.galleryp .gl-item.gl-preview > div').outerHeight();
        $('.gallery-item_p').removeClass('gallery-item-clickedp');
        localStorage.setItem('heightp', 0);

        $('.gallery-home_p ').height(wrapp - popup);
        setTimeout(function () {
            finish = 0;
        }, 200)
    });


    $('.all-filterp').on('click', function () {
		$('.visible-item-glp').removeClass('visible-item-gl2p');
    	$('.gallery-item_p').removeClass('gallery-item-animep');
    	$('.gallery-item_p').removeClass('filter0p filter1p filter2p filter3p filter4p filter5p filter6p filter7p filter8p filter9p filter10p');
		$('.gallery-home-innerp').isotope();
        $('.gallery-home_p ').addClass('active').removeClass('gallery-home-filterp');

        if(!$('.gallery-home_p ').hasClass('active2')) {
            $('.gallery-item_p').removeClass('visible-item-glp visible-item-vsp');

            var amount = $('.gallery-home_p ').data('amount'),
            count = 0;

            $('.gallery-item_p').each(function () {
                count++;
                $(this).addClass('visible-item-glp');
                if(count == amount) {
                    return false;
                }
            });

        }

        $('.gallery-item_p').removeClass('visible-item-filterp');
        $('.gallery-item_p').removeClass('hidden-item-glp');
        if($('.load-more-buttonp').length) {
            var  active  = localStorage.getItem('active');
            $('#load-more-blockp.loadmore #item-more').removeClass('active');
            $('#load-more-blockp.load-more-block .load-more-button.load-more-buttonp').removeClass('active');
        }


        var container = $('.gallery-home_p '),
            containerInner = $('.gallery-home-innerp').height(),
            wrappHeight = container.height();

        var currentHeight =  localStorage.getItem('allHeightp');
        $('.gallery-home_p ').height(currentHeight);


        $('.gallery-home_p ').css({
            'max-height' : 10000
        });


        setTimeout(function () {
            finishp = 0;
        }, 200);
    });


    $('.item-filterp').on('click', function () {
 		var currentPointp = 	$(this).data('fl');
    	$('.visible-item-glp').addClass('visible-item-gl2p');
    	$('.gallery-item_p').removeClass('gallery-item-animep visible-item-vsp');

        $('.gallery-home_p ').removeClass('active').addClass('gallery-home-filterp');
        $('.gallery-item_p').addClass('hidden-item-glp');

        $('.no-more-items-signp').hide();

        finishp = 1;

        var container = $('.gallery-home_p '),
            thisAttr = $(this).find('a').data('filter'),
            elementsLenght = $('.gallery-item_p[data-category *='+ thisAttr + ']').length,
            element = $('.gallery-item_p'),
            containerInner = $('.gallery-home-innerp').height(),
            wrappHeight = container.height(),
            wrappWidth = parseInt(container.width()),
            elementHeight = parseInt(element.outerHeight()),
            filterHeight = elementHeight * elementsLenght,
            elementWidth = parseInt(element.width()),
            amount = container.data('amount'),
            rowItem = Math.round(wrappWidth / elementWidth),
            amountFilter = elementsLenght,
            count = 0;

        $('.gallery-item_p[data-category *='+ thisAttr + ']').each(function () {
            count++;
            $(this).addClass('visible-item-filterp');
            if(count == amount) {
                return false;
            }
        });

        if(elementsLenght >= amount ) {
            amountFilter = amount;

        } else  {

            $('.no-more-items-signp').css({'display' : 'none'});
        }


        if(elementsLenght > amount ) {
            $('#load-more-blockp.loadmore #item-more').removeClass('active');
            $('#load-more-blockp.load-more-block .load-more-button.load-more-buttonp').removeClass('active');

        } else  {
            $('#load-more-blockp.loadmore #item-more').addClass('active');
            $('#load-more-blockp.load-more-block .load-more-button.load-more-buttonp').addClass('active');
        }

         var rows = (amountFilter * elementWidth) / wrappWidth,
            rowsFixed = rows.toFixed(1),
            rowsCeil = Math.ceil(rowsFixed),
             rows2 = (elementsLenght * elementWidth) / wrappWidth,
             rowsFixed2 = rows2.toFixed(1),
             rowsCeil2 = Math.ceil(rowsFixed2),
            newHeight = 0;

        startHeightp = (elementHeight * rowsCeil) - 1;
        var maxHeight = (elementHeight * rowsCeil2);

        container.css({
            'max-height' : maxHeight
        });

          

        if(localStorage.getItem(currentPointp)) {
    		container.height(+localStorage.getItem(currentPointp));
    		$('.gallery-item_p').removeClass('filter0p filter1p filter2p filter3p filter4p filter5p filter6p filter7p filter8p filter9p filter10p').addClass(currentPointp);
    		finishp = 0;
    	} else {
    		setTimeout(function () {
           		 container.height(startHeightp);
            	finishp = 0;
           
        	}, 200);
    	}


    });

})(jQuery);
