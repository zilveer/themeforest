/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.2.3
 * 
 * Theme Custom Scripts
 * Created by CMSMasters
 * 
 */
 
"use strict";


jQuery(document).ready(function() { 
	/* Add Class To Row */
	(function ($) { 
		$('.cmsms_row_margin').each(function () { 
			var cmsms_column = $(this).find('.cmsms_column').eq(0);
			
			
			if ( 
				cmsms_column.hasClass('one_half') && 
				cmsms_column.next().hasClass('one_half') 
			) {
				$(this).addClass('cmsms_1212');
			} else if ( 
				cmsms_column.hasClass('one_third') && 
				cmsms_column.next().hasClass('two_third') 
			) {
				$(this).addClass('cmsms_1323');
			} else if ( 
				cmsms_column.hasClass('two_third') && 
				cmsms_column.next().hasClass('one_third') 
			) {
				$(this).addClass('cmsms_2313');
			} else if ( 
				cmsms_column.hasClass('one_fourth') && 
				cmsms_column.next().hasClass('three_fourth') 
			) {
				$(this).addClass('cmsms_1434');
			} else if ( 
				cmsms_column.hasClass('three_fourth') && 
				cmsms_column.next().hasClass('one_fourth') 
			) {
				$(this).addClass('cmsms_3414');
			} else if ( 
				cmsms_column.hasClass('one_third') && 
				cmsms_column.next().hasClass('one_third') && 
				cmsms_column.next().next().hasClass('one_third') 
			) {
				$(this).addClass('cmsms_131313');
			} else if (
				cmsms_column.hasClass('one_half') && 
				cmsms_column.next().hasClass('one_fourth') && 
				cmsms_column.next().next().hasClass('one_fourth')
			) {
				$(this).addClass('cmsms_121414');
			} else if ( 
				cmsms_column.hasClass('one_fourth') && 
				cmsms_column.next().hasClass('one_half') && 
				cmsms_column.next().next().hasClass('one_fourth')
			) {
				$(this).addClass('cmsms_141214');
			} else if ( 
				cmsms_column.hasClass('one_fourth') && 
				cmsms_column.next().hasClass('one_fourth') && 
				cmsms_column.next().next().hasClass('one_half') 
			) {
				$(this).addClass('cmsms_141412');
			} else if ( 
				cmsms_column.hasClass('one_fourth') && 
				cmsms_column.next().hasClass('one_fourth') && 
				cmsms_column.next().next().hasClass('one_fourth') && 
				cmsms_column.next().next().next().hasClass('one_fourth') 
			) {
				$(this).addClass('cmsms_14141414');
			} else {
				$(this).addClass('cmsms_11');
			}
		} );
	} )(jQuery);



	/* Scroll Top */
	(function ($) { 
		$(window).scroll(function () { 
			if ($(this).scrollTop() > 200) {
				$('#slide_top').filter(':hidden').fadeIn('fast');
			} else {
				$('#slide_top').filter(':visible').fadeOut('fast');
			}
		} );
		
		
		$('.divider a, #slide_top').click(function () { 
			$('html, body').animate( { 
				scrollTop : 0 
			}, 'slow');
			
			
			return false;
		} );
	} )(jQuery);



	/* Lightbox Classes Adding */
	(function ($) { 
		$('.widget_custom_flickr_entries').each(function () { 
			var flickrUniqID = uniqID();
			
			
			$(this).find('.flickr_badge_image a').each(function () { 
				var src = $(this).find('img').attr('src'), 
					title = $(this).find('img').attr('title'), 
					src_full = src.replace(/_s.jpg/g, '.jpg');
				
				
				$(this).removeAttr('href').attr( { 
					href : 		src_full, 
					title : 	title, 
					rel : 		'ilightbox[flickr_' + flickrUniqID + ']' 
				} );
			} );
		} ); // Flickr Widget Lightbox
		
		
		$('.gallery').each(function () { 
			var galUniqID = uniqID();
			
			
			$(this).find('a').each(function () { 
				var linkHref = $(this).attr('href'), 
					lastDotPos = linkHref.lastIndexOf('.'), 
					imgFormat = linkHref.slice(lastDotPos + 1);
				
				
				if (imgFormat.length <= 5) {
					$(this).attr('rel', 'ilightbox[wp_gal_' + galUniqID + ']');
				}
			} );
		} ); // Wordpress Default Gallery Shortcode Lightbox
	} )(jQuery);
	
	
	
	/* iLightBox Init */
	(function ($) { 
		var ilightbox_settings = { 
			skin : 					cmsms_script.ilightbox_skin, 
			path : 					cmsms_script.ilightbox_path, 
			infinite : 				(cmsms_script.ilightbox_infinite == '1') ? true : false, 
			keepAspectRatio : 		(cmsms_script.ilightbox_aspect_ratio == '1') ? true : false, 
			mobileOptimizer : 		(cmsms_script.ilightbox_mobile_optimizer == '1') ? true : false, 
			maxScale : 				Number(cmsms_script.ilightbox_max_scale), 
			minScale : 				Number(cmsms_script.ilightbox_min_scale), 
			innerToolbar : 			(cmsms_script.ilightbox_inner_toolbar == '1') ? true : false, 
			smartRecognition : 		(cmsms_script.ilightbox_mobile_optimizer == '1') ? true : false, 
			fullAlone : 			(cmsms_script.ilightbox_fullscreen_one_slide == '1') ? true : false, 
			fullViewPort : 			cmsms_script.ilightbox_fullscreen_viewport, 
			controls : { 
				toolbar : 			(cmsms_script.ilightbox_controls_toolbar == '1') ? true : false, 
				arrows : 			(cmsms_script.ilightbox_controls_arrows == '1') ? true : false, 
				fullscreen : 		(cmsms_script.ilightbox_controls_fullscreen == '1') ? true : false, 
				thumbnail : 		(cmsms_script.ilightbox_controls_thumbnail == '1') ? true : false, 
				keyboard : 			(cmsms_script.ilightbox_controls_keyboard == '1') ? true : false, 
				mousewheel : 		(cmsms_script.ilightbox_controls_mousewheel == '1') ? true : false, 
				swipe : 			(cmsms_script.ilightbox_controls_swipe == '1') ? true : false, 
				slideshow : 		(cmsms_script.ilightbox_controls_slideshow == '1') ? true : false 
			}, 
			text : { 
				close : 			cmsms_script.ilightbox_close_text, 
				enterFullscreen : 	cmsms_script.ilightbox_enter_fullscreen_text, 
				exitFullscreen : 	cmsms_script.ilightbox_exit_fullscreen_text, 
				slideShow : 		cmsms_script.ilightbox_slideshow_text, 
				next : 				cmsms_script.ilightbox_next_text, 
				previous : 			cmsms_script.ilightbox_previous_text 
			}, 
			errors : { 
				loadImage : 		cmsms_script.ilightbox_load_image_error, 
				loadContents : 		cmsms_script.ilightbox_load_contents_error, 
				missingPlugin : 	cmsms_script.ilightbox_missing_plugin_error 
			} 
		}, 
		gallery_array = [], 
		gallery_id = '';
		
		
		$('[rel="ilightbox"]').each(function () { 
			$(this).iLightBox(ilightbox_settings);
		} );
		
		
		$('[rel^="ilightbox["]').each(function () { 
			var item_rel = $(this).attr('rel');
			
			
			if ($.inArray(item_rel, gallery_array) === -1) {
				gallery_array.push(item_rel);
			}
		} );
		
		
		$.each(gallery_array, function (gallery_array, gallery_id) { 
			$('[rel="' + gallery_id + '"]').iLightBox(ilightbox_settings)
		} );
	} )(jQuery);
	
	
	
	/* Shortcodes Animation Run */
	(function ($) { 
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('[data-animation]').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 			$(this), 
						animation = 	el.data('animation'), 
						delay = 		(el.data('delay')) ? el.data('delay') : 0;
					
					
					setTimeout(function () { 
						el.addClass(animation + ' animated');
					}, delay);
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 			$(this), 
						animation = 	el.data('animation'), 
						delay = 		(el.data('delay')) ? el.data('delay') : 0;
					
					
					setTimeout(function () { 
						el.addClass(animation + ' animated');
					}, delay);
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('[data-animation]').addClass('animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsms_icon_box').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 	$(this);
					
					
					el.addClass('shortcode_animated');
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 	$(this);
					
					
					el.addClass('shortcode_animated');
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsms_icon_box').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsms_icon_list_items.cmsms_icon_list_type_block').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 		$(this), 
						items = 	el.find('li'), 
						delay = 	500, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 		$(this), 
						items = 	el.find('li'), 
						delay = 	500, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsms_icon_list_items .cmsms_icon_list_item').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsms_gallery, .cmsms_hover_slider').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 		$(this), 
						items = 	el.find('li'), 
						delay = 	300, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 		$(this), 
						items = 	el.find('li'), 
						delay = 	300, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsms_gallery ul li, .cmsms_hover_slider ul li').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsms_profile.vertical').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 		$(this), 
						items = 	el.find('article'), 
						delay = 	500, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 		$(this), 
						items = 	el.find('article'), 
						delay = 	500, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsms_profile.vertical .format-profile').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsms_clients_grid').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 		$(this), 
						items = 	el.find('.cmsms_clients_item'), 
						delay = 	300, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 		$(this), 
						items = 	el.find('.cmsms_clients_item'), 
						delay = 	300, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsms_clients_grid').find('.cmsms_clients_item').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.blog.columns, .blog.timeline').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 			$(this), 
						items = 		el.find('article.post'), 
						itemsCount = 	items.length, 
						delay = 		300, 
						i = 			1;
					
					
					var newTime = setInterval(function () { 
						if (el.hasClass('isotope')) {
							clearInterval(newTime);
						} else {
							return false;
						}
						
						
						items.each(function () { 
							var item = 	$(this);
							
							
							setTimeout(function () { 
								item.addClass('shortcode_animated');
							}, delay * i);
							
							
							i += 1;
							
							
							if (i === itemsCount) {
								setTimeout(function () { 
									$(window).trigger('resize');
								}, delay * i);
							}
						} );
					}, 300);
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 			$(this), 
						items = 		el.find('article.post'), 
						itemsCount = 	items.length, 
						delay = 		300, 
						i = 			1;
					
					
					var newTime = setInterval(function () { 
						if (el.hasClass('isotope')) {
							clearInterval(newTime);
						} else {
							return false;
						}
						
						
						items.each(function () { 
							var item = 	$(this);
							
							
							setTimeout(function () { 
								item.addClass('shortcode_animated');
							}, delay * i);
							
							
							i += 1;
							
							
							if (i === itemsCount) {
								setTimeout(function () { 
									$(window).trigger('resize');
								}, delay * i);
							}
						} );
					}, 300);
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.blog.columns, .blog.timeline').find('article.post').addClass('shortcode_animated');
		}
	} )(jQuery);
	
	
	
	/* Stats Run */
	(function ($) { 
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android && 
			!checker.ua.ie9 
		) {
			$('.cmsms_stats.stats_mode_counters.stats_type_circles').waypoint(function () { 
				var i = 1;
				
				
				$(this).find('.cmsms_stat').each(function () { 
					var el = $(this);
					
					
					setTimeout(function () { 
						el.easyPieChart( { 
							size : 			180, 
							lineWidth : 	16, 
							lineCap : 		'square', 
							animate : 		1000, 
							scaleColor : 	false, 
							trackColor : 	false, 
							barColor : function () { 
								return ($(this.el).data('bar-color')) ? $(this.el).data('bar-color') : '#ebebeb';
							}, 
							onStep : function (from, to, val) { 
								$(this.el).find('.cmsms_stat_counter').text(~~val);
							} 
						} );
					}, 500 * i);
					
					
					i += 1;
				} );
			}, { 
				offset : 		'100%' 
			} );
		} else {
			$('.cmsms_stats.stats_mode_counters.stats_type_circles').find('.cmsms_stat').easyPieChart( { 
				size : 			180, 
				lineWidth : 	16, 
				lineCap : 		'square', 
				animate : 		1000, 
				scaleColor : 	false, 
				trackColor : 	false, 
				barColor : function () { 
					return ($(this.el).data('bar-color')) ? $(this.el).data('bar-color') : '#ebebeb';
				}, 
				onStep : function (from, to, val) { 
					$(this.el).find('.cmsms_stat_counter').text(~~val);
				} 
			} );
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android && 
			!checker.ua.ie9 
		) {
			$('.cmsms_stats.stats_mode_counters.stats_type_numbers').waypoint(function () { 
				var i = 1;
				
				
				$(this).find('.cmsms_stat').each(function () { 
					var el = $(this);
					
					
					setTimeout(function () { 
						el.easyPieChart( { 
							size : 			180, 
							lineWidth : 	0, 
							lineCap : 		'square', 
							animate : 		1500, 
							scaleColor : 	false, 
							trackColor : 	false, 
							barColor : 		'#ffffff', 
							onStep : function (from, to, val) { 
								$(this.el).find('.cmsms_stat_counter').text(~~val);
							} 
						} );
					}, 500 * i);
					
					
					i += 1;
				} );
			}, { 
				offset : 		'100%' 
			} );
		} else {
			$('.cmsms_stats.stats_mode_counters.stats_type_numbers').find('.cmsms_stat').easyPieChart( { 
				size : 			180, 
				lineWidth : 	0, 
				lineCap : 		'square', 
				animate : 		1500, 
				scaleColor : 	false, 
				trackColor : 	false, 
				barColor : 		'#ffffff', 
				onStep : function (from, to, val) { 
					$(this.el).find('.cmsms_stat_counter').text(~~val);
				} 
			} );
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android && 
			!checker.ua.ie9 
		) {
			$('.cmsms_stats.stats_mode_bars').waypoint(function () { 
				$(this).addClass('shortcode_animated').find('.cmsms_stat').each(function () { 
					var el = $(this);
					
					
					el.easyPieChart( { 
						size : 			180, 
						lineWidth : 	0, 
						lineCap : 		'square', 
						animate : 		1500, 
						scaleColor : 	false, 
						trackColor : 	false, 
						barColor : 		'#ffffff', 
						onStep : function (from, to, val) { 
							$(this.el).find('.cmsms_stat_counter').text(~~val);
						} 
					} );
				} );
			}, { 
				offset : 		'100%' 
			} );
		} else {
			$('.cmsms_stats.stats_mode_bars').addClass('shortcode_animated').find('.cmsms_stat').easyPieChart( { 
				size : 			180, 
				lineWidth : 	0, 
				lineCap : 		'square', 
				animate : 		1500, 
				scaleColor : 	false, 
				trackColor : 	false, 
				barColor : 		'#ffffff', 
				onStep : function (from, to, val) { 
					$(this.el).find('.cmsms_stat_counter').text(~~val);
				} 
			} );
		}
	} )(jQuery);
	
	
	
	/* Header Search Toggle */
	(function ($) { 
		$('#header .header_mid .search_but').bind('click', function () { 
			var searchWrap = $(this).parents('.header_mid .search_wrap'), 
				headerNav = $(this).parents('.header_mid').find('nav'), 
				respNav = $(this).parents('.header_mid').find('.resp_nav_wrap'), 
				headerSlogan = $(this).parents('.header_mid').find('.slogan_wrap'), 
				headerSocial = $(this).parents('.header_mid').find('.social_wrap');
			
			
			if (searchWrap.hasClass('search_opened')) {
				searchWrap.removeClass('search_opened');
				
				headerNav.removeClass('nav_closed');
				
				respNav.removeClass('resp_nav_closed')
				
				headerSlogan.removeClass('slogan_closed');
				
				headerSocial.removeClass('social_closed');
			} else {
				searchWrap.addClass('search_opened');
				
				headerNav.addClass('nav_closed');
				
				respNav.addClass('resp_nav_closed')
				
				headerSlogan.addClass('slogan_closed');
				
				headerSocial.addClass('social_closed');
			}
		} );
	} )(jQuery);
	
	
	
	/* Header Top Hide Toggle */
	(function ($) { 
		$('.header_top_but').bind('click', function () { 
			var headerTopBut = $(this), 
				headerTopButArrow = headerTopBut.find('> span'), 
				headerTopOuter = headerTopBut.parents('.header_top').find('.header_top_outer');
			
			if (headerTopBut.hasClass('opened')) {
				headerTopOuter.slideUp();
				
				headerTopButArrow.removeClass('cmsms_top_arrow').addClass('cmsms_bot_arrow');
				
				headerTopBut.removeClass('opened').addClass('closed');
			} else if (headerTopBut.hasClass('closed')) {
				headerTopOuter.slideDown();
				
				headerTopButArrow.removeClass('cmsms_bot_arrow').addClass('cmsms_top_arrow');
				
				headerTopBut.removeClass('closed').addClass('opened');
			}
		} );
	} )(jQuery);
	
	
	
	/* Fixed Header Function Start */
	(function ($) { 
		$('#header').cmsmsFixedHeaderScroll();
	} )(jQuery);
	
	
	
	/* Row Parallax Function Start */
	(function ($) { 
		$(window).load(function () { 
			if ( 
				!checker.os.iphone && 
				!checker.os.ipad && 
				!checker.os.ipod && 
				!checker.os.android && 
				!checker.os.blackberry 
			) {
				if (checker.ua.safari) {
					if (checker.ua.chrome) {
						setTimeout(function () { 
							$.stellar( { 
								horizontalScrolling : 	false, 
								verticalOffset : 		30, 
								parallaxElements : 		false 
							} );
						}, 1500);
						
						
						$(window).on('debouncedresize', function () { 
							if ($(window).width() < 1024) {
								$.stellar('destroy');
							} else {
								$.stellar( { 
									horizontalScrolling : 	false, 
									verticalOffset : 		30, 
									parallaxElements : 		false 
								} );
							}
						} );
					}
				} else {
					setTimeout(function () { 
						$.stellar( { 
							horizontalScrolling : 	false, 
							verticalOffset : 		30, 
							parallaxElements : 		false 
						} );
					}, 1500);
					
					
					$(window).on('debouncedresize', function () { 
						if ($(window).width() < 1024) {
							$.stellar('destroy');
						} else {
							$.stellar( { 
								horizontalScrolling : 	false, 
								verticalOffset : 		30, 
								parallaxElements : 		false 
							} );
						}
					} );
				}
			} else {
				$('div.cmsms_row').css('background-attachment', 'scroll');
			}
		} );
	} )(jQuery);
	
	
	
	/* One Page Navigation */
	(function ($) { 
		$(window).load(function () { 
			var inViewNav = 			$('#navigation'), 
				inViewSelector = 		inViewNav.find('a[href*="#"]'), 
				inViewBlocks = 			[], 
				siteURL = 				cmsms_script.site_url;
			
			// Recalculate Header Offset
			function rebuildHeaderOffset(hashRow) { 
				var cmsmsFHeader = 			$('#page').hasClass('fixed_header'), 
					cmsmsTHeader = 			$('#page').hasClass('enable_header_top'), 
					cmsmsBHeader = 			$('#page').hasClass('enable_header_bottom'), 
					wpAdminBar = 			$('#wpadminbar').outerHeight(), 
					cmsmsMHeaderHeight = 	$('#header .header_mid').data('height'), 
					cmsmsTHeaderHeight = 	$('#header .header_top').data('height'), 
					cmsmsBHeaderHeight = 	$('#header .header_bot').data('height'), 
					cmsmsHeaderOffset = 	0, 
					scrollTop = 			$(window).scrollTop(), 
					winWidth = 				$(window).width();
				
				
				if (cmsmsFHeader) {
					if (cmsmsTHeader) {
						if (hashRow >= (cmsmsMHeaderHeight / 3) + cmsmsTHeaderHeight) {
							cmsmsHeaderOffset = (cmsmsMHeaderHeight / 3) * 2 + (cmsmsBHeader ? cmsmsBHeaderHeight : 0);
						} else if (hashRow >= cmsmsTHeaderHeight) {
							cmsmsHeaderOffset = (cmsmsMHeaderHeight - (scrollTop - cmsmsTHeaderHeight)) + (cmsmsBHeader ? cmsmsBHeaderHeight : 0);
						} else {
							cmsmsHeaderOffset = (cmsmsMHeaderHeight + cmsmsTHeaderHeight - scrollTop) + (cmsmsBHeader ? cmsmsBHeaderHeight : 0);
						}
					} else {
						if (hashRow >= cmsmsMHeaderHeight / 3) {
							cmsmsHeaderOffset = (cmsmsMHeaderHeight / 3) * 2 + (cmsmsBHeader ? cmsmsBHeaderHeight : 0);
						} else {
							cmsmsHeaderOffset = (cmsmsMHeaderHeight - scrollTop) + (cmsmsBHeader ? cmsmsBHeaderHeight : 0);
						}
					}
					
					
					cmsmsHeaderOffset = -cmsmsHeaderOffset - Number((wpAdminBar !== undefined) ? wpAdminBar - 1 : 0);
				}
				
				
				if (checkN(-cmsmsHeaderOffset, hashRow, 150)) {
					cmsmsHeaderOffset = 'false';
				}
				
				
				if (winWidth < 1008) {
					cmsmsHeaderOffset = 0 - Number((wpAdminBar !== undefined) ? wpAdminBar - 1 : 0);
				}
				
				
				return cmsmsHeaderOffset;
			}
			
			// Find InView Blocks
			inViewSelector.each(function () { 
				if (this.hash !== '' && $('body').find('div' + this.hash + '.cmsms_row_outer_parent').length > 0) {
					inViewBlocks.push($('body').find('div' + this.hash + '.cmsms_row_outer_parent'));
				}
			} );
			
			// Highlight InView Section Navigation Link
			$(inViewBlocks).each(function () { 
				var winHeight = 			$(window).height(), 
					inViewTop = 			$(this).offset().top, 
					inViewHeight = 			$(this).outerHeight(), 
					headerOffsetRebuild = 	(rebuildHeaderOffset(inViewTop) !== 'false') ? rebuildHeaderOffset(inViewTop) : 0;
				
				
				$(this).scrollspy( { 
					min : 		(inViewHeight / 2) - (winHeight - inViewTop + headerOffsetRebuild), 
					max : 		inViewTop + (inViewHeight / 3) + headerOffsetRebuild, 
					onEnter : function (el, pos) { 
						inViewNav.find('li.menu-item.current-menu-item').removeClass('current-menu-item');
						
						inViewNav.find('li.menu-item.current-menu-ancestor').removeClass('current-menu-ancestor');
						
						
						inViewSelector.each(function () { 
							if ($(this).attr('href').slice($(this).attr('href').indexOf('#')) === '#' + $(el).attr('id')) {
								$(this).parents('li').addClass('current-menu-item');
							}
						} );
					} 
				} );
			} );
			
			// Scroll to Section on Page Load if Hash Exists or Else add Current Menu Item Class to First Navigation Item
			if (window.location.hash && $('body').find('div' + window.location.hash + '.cmsms_row_outer_parent').length > 0) {
				var headerOffsetRebuild = 	rebuildHeaderOffset($('body').find('div' + window.location.hash + '.cmsms_row_outer_parent').offset().top), 
					currentNavItem = 		inViewNav.find('> li.menu-item > a[href="' + window.location.hash + '"]');
				
				
				if (currentNavItem.length > 0 && currentNavItem.parents('li').is(':not(.current-menu-item)')) {
					currentNavItem.parents('li').addClass('current-menu-item');
				}
				
				
				if (headerOffsetRebuild !== 'false') {
					$.scrollTo(window.location.hash, 800, { 
						easing : 	'easeInOutExpo', 
						axis : 		'y', 
						margin : 	true, 
						offset : { 
							top : 	headerOffsetRebuild 
						} 
					} );
				} else {
					$('html, body').animate( { 
						scrollTop : 0 
					}, 800);
				}
			} else if (window.location.href === siteURL) {
				inViewNav.find('> li.menu-item').each(function () { 
					var thisHref = $(this).find('> a').attr('href');
					
					
					if ( 
						thisHref === siteURL || 
						thisHref === window.location.pathname || 
						thisHref === '/' 
					) {
						$(this).addClass('current-menu-item');
					}
				} );
			}
			
			// Scroll to Sections on Link Click
			$('nav a[href*="#"], a.ls-l, .hash-link a, a.hash-link').click(function () { 
				var linkHash = 				this.hash, 
					linkHref = 				$(this).attr('href'), 
					rowExists = 			$('body').find('div' + linkHash + '.cmsms_row_outer_parent'), 
					headerOffsetRebuild = 	(rowExists.length > 0) ? rebuildHeaderOffset(rowExists.offset().top) : false;
				
				
				if (linkHash !== '') {
					if (rowExists.length > 0) {
						if (headerOffsetRebuild !== 'false') {
							$.scrollTo(linkHash, 800, { 
								easing : 	'easeInOutExpo', 
								axis : 		'y', 
								margin : 	true, 
								offset : { 
									top : 	headerOffsetRebuild 
								}, 
								onAfter : function () { 
									if (history.pushState) {
										history.pushState(null, null, linkHash);
									}
								} 
							} );
						} else {
							$('html, body').animate( { 
								scrollTop : 0 
							}, 800, function () { 
								if (history.pushState) {
									history.pushState(null, null, linkHash);
								}
							} );
						}
					} else {
						if ( 
							linkHref.indexOf(linkHash) !== -1 && 
							linkHref.slice(0, linkHref.indexOf(linkHash)) !== siteURL && 
							linkHref !== linkHash 
						) {
							window.location.href = linkHref;
						} else {
							window.location.href = siteURL + linkHash;
						}
					}
					
					
					return false;
				}
			} );
		} );
	} )(jQuery);
	
	
	
	/* Notise Close Button */
	(function ($) { 
		$('.cmsms_notice a.notice_close').bind('click', function () { 
			$(this).parents('.cmsms_notice').fadeOut(500, function () { 
				$(this).remove();
			} );
			
			
			return false;
		} );
	} )(jQuery);
	
	
	
	/* Popular, Latest and Related Posts */
	(function ($) { 
		$('.related_posts > ul li a').bind('click', function (g) { 
			var rposts = $(this).parents('.related_posts'), 
				index = $(this).parents('li').index();
			
			
			rposts.find('ul > li > a').removeClass('current');
			
			$(this).addClass('current');
			
			
			rposts.find('.related_posts_content').find('div.related_posts_content_tab').not('div.related_posts_content_tab:eq(' + index + ')').slideUp();
			
			rposts.find('.related_posts_content').find('div.related_posts_content_tab:eq(' + index + ')').slideDown();
			
			
			g.preventDefault();
		} );
	} )(jQuery);
	
	
	
	/* Toggles */
	(function ($) { 
		$('.cmsms_toggles .cmsms_toggle_title a').bind('click', function (i) { 
			var active_toggle = $(this).parents('.cmsms_toggles').find('.cmsms_toggle_wrap.current_toggle .cmsms_toggle'), 
				toggle = $(this).parents('.cmsms_toggle_wrap'), 
				acc = ($(this).parents('.cmsms_toggles').hasClass('toggles_mode_accordion')) ? true : false, 
				dropDown = toggle.find('.cmsms_toggle');
			
			
			if (toggle.hasClass('current_toggle')) {
				dropDown.slideUp('fast', function () { 
					toggle.removeClass('current_toggle');
				} );
			} else {
				if (acc) {
					active_toggle.slideUp('fast', function () { 
						active_toggle.parents('.cmsms_toggle_wrap').removeClass('current_toggle');
					} );
				}
				
				dropDown.slideDown('fast', function () { 
					toggle.addClass('current_toggle');
				} );
			}
			
			
			i.preventDefault();
		} );
		
		
		$('.cmsms_toggles .cmsms_toggles_filter a').bind('click', function (i) { 
			var filter_wrap = $(this).parents('.cmsms_toggles_filter'), 
				filter = $(this).data('key'), 
				toggle = $(this).parents('.cmsms_toggles').find('.cmsms_toggle_wrap');
			
			
			if ($(this).is(':not(.current_filter)')) { 
				filter_wrap.find('a').removeClass('current_filter');
				
				
				$(this).addClass('current_filter');
				
				
				toggle.filter('[data-tags~="' + filter + '"]').slideDown('fast');
				
				
				toggle.filter(':not([data-tags~="' + filter + '"])').slideUp('fast');
				
				
				toggle.filter(':not([data-tags~="' + filter + '"])').removeClass('current_toggle').find('.cmsms_toggle').removeAttr('style');
			}
			
			
			i.preventDefault();
		} );
	} )(jQuery);
	
	
	
	/* Tabs */
	(function ($) { 
		$('.cmsms_tabs ul.cmsms_tabs_list li a').bind('click', function (t) { 
			var tabs_parent = $(this).parents('.cmsms_tabs'), 
				tabs = tabs_parent.find('.cmsms_tabs_wrap'), 
				index = $(this).parents('li').index();
			
			
			tabs_parent.find('.cmsms_tabs_list > .current_tab').removeClass('current_tab');
			
			
			$(this).parents('li').addClass('current_tab');
			
			
			tabs.find('.cmsms_tab').not(':eq(' + index + ')').slideUp('fast', function () { 
				$(this).removeClass('active_tab');
			} );
			
			
			tabs.find('.cmsms_tab:eq(' + index + ')').slideDown('fast', function () { 
				$(this).addClass('active_tab');
			} );
			
			
			t.preventDefault();
		} );
	} )(jQuery);
	
	
	
	/* YouTube Iframe Fix */
	(function ($) { 
		var iframe = $('iframe[src*="youtube.com"]');
		
		
		iframe.each(function () { 
			var current = 	$(this), 
				src = 		current.attr('src'); 
			
			
			if (src) {
				if (src.indexOf('?') !== -1) {
					src += "&wmode=opaque";
				} else {
					src += "?wmode=opaque";
				}
				
				
				current.attr('src', src);
			}
		} );
	} )(jQuery);
} );



/* Like Button */
function cmsmsLike(postID) { 
	if (postID !== '') { 
		var likeButton = jQuery('#cmsmsLike-' + postID);
		
		
		likeButton.find('> span').text('...');
		
		
		jQuery.post(cmsms_script.theme_url + '/framework/function/like.php', { 
			id : postID 
		}, function (data) { 
			likeButton.find('> span').text(data);
			
			
			likeButton.addClass('active');
			
			
			likeButton.attr( { 
				onclick : 'return false;' 
			} );
		} );
	}
	
	
	return false;
}



/* Correct OS & Browser Check */
var ua = navigator.userAgent, 
	checker = { 
		os : { 
			iphone : 		ua.match(/iPhone/), 
			ipod : 			ua.match(/iPod/), 
			ipad : 			ua.match(/iPad/), 
			blackberry : 	ua.match(/BlackBerry/), 
			android : 		ua.match(/(Android|Linux armv6l|Linux armv7l)/), 
			linux : 		ua.match(/Linux/), 
			win : 			ua.match(/Windows/), 
			mac : 			ua.match(/Macintosh/) 
		}, 
		ua : { 
			ie : 		ua.match(/MSIE/), 
			ie6 : 		ua.match(/MSIE 6.0/), 
			ie7 : 		ua.match(/MSIE 7.0/), 
			ie8 : 		ua.match(/MSIE 8.0/), 
			ie9 : 		ua.match(/MSIE 9.0/), 
			ie10 : 		ua.match(/MSIE 10.0/), 
			ie11 : 		ua.match(/MSIE 11.0/), 
			opera : 	ua.match(/Opera/), 
			firefox : 	ua.match(/Firefox/), 
			chrome : 	ua.match(/Chrome/), 
			safari : 	ua.match(/(Safari|BlackBerry)/) 
		} 
	};



/* Correct Image Load Check */
function isImageOk(img) { 
	if (!img.complete) { 
		return false;
	}
	
	
	if (typeof img.naturalWidth !== undefined && img.naturalWidth === 0) { 
		return 'stop';
	}
	
	
	return true;
}



/* Check Whether the Numbers are Approximately Equal */
function checkN(a, b, x) { 
    if ((a > b && a - x <= b) || (b > a && b - x <= a)){
        return true;
    } else {
        return false;
    }
}



/* Uniq ID */
function uniqID() { 
  return Math.round(new Date().getTime() + (Math.random() * 1000000));
}

