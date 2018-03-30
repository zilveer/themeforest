/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

// -----------------------------------------------------------------------------

(function($) {

	'use strict';

	// -------------------------------------------------------------------------

	/**
	 * jQuery Cookie plugin
	 *
	 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
	 * Dual licensed under the MIT and GPL licenses:
	 * http://www.opensource.org/licenses/mit-license.php
	 * http://www.gnu.org/licenses/gpl.html
	 */
	$.cookie = function(key, value, options) {

		// key and at least value given, set cookie...
		if (arguments.length > 1 && String(value) !== "[object Object]") {
			options = jQuery.extend({}, options);

			if (value === null || value === undefined) {
				options.expires = -1;
			}

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}

			value = String(value);

			return (document.cookie = [
				encodeURIComponent(key), '=',
				options.raw ? value : encodeURIComponent(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path ? '; path=' + options.path : '',
				options.domain ? '; domain=' + options.domain : '',
				options.secure ? '; secure' : ''
			].join(''));
		}

		// key and possibly options given, get cookie...
		options = value || {};
		var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
		return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;

	};

	// -------------------------------------------------------------------------

	$.fn.getData = function(key, defaultValue) {
		return typeof this.data(key) !== 'undefined' ? this.data(key) : defaultValue;
	};

	// -------------------------------------------------------------------------

	$.fn.closestWidth = function() {
		var width = this.width();
		return typeof width != 'undefined' && width > 0 ? width : this.parent().closestWidth();
	};

	// -------------------------------------------------------------------------

	$.fn.responsiveVideo = function(ratio, padding) {
		if (typeof padding == 'undefined') {
			padding = 0;
		}
		this.filter('iframe, object, embed').filter('[width][height]').each(function() {
			var _this = $(this);
			$(window).resize(function() {
				var width  = _this.width() === 0 ? _this.parent().width() : _this.width();
				var _ratio = typeof ratio != 'undefined' ? ratio : _this.attr('width') / _this.attr('height');
				_this.css('height', Math.round((width / _ratio) + padding)+'px');
			});
		});
		$(window).trigger('resize');
		return this;
	};

	// -------------------------------------------------------------------------

	$.fn.responsiveFancybox = function(options, mobile) {
		return this.each(function() {
			var _this = $(this);
			_this.fancybox($.extend({}, options, {
				onStart: function() {
					var _mobile;
					switch (typeof mobile) {
						case 'undefined': _mobile = true; break;
						case 'function':  _mobile = mobile.call(this); break;
						case 'number':    _mobile = $(window).width() < mobile; break;
						default:		  _mobile = mobile;
					}
					if (_mobile) {
						window.location = _this.attr('href');
						return false;
					} else {
						return 'onStart' in options ? options.onStart.call() : true;
					}
				}
			}));
		});
	};

	// -----------------------------------------------------------------------------

	// jQuery
	$(document).ready(function($) {

		// No JavaScript
		$('html').removeClass('no-js');

		// Default configuration
		var conf = $.extend({}, {
			templatePath:         '.',
			flexsliderOptions:    {
				animation:    'slide',
				slideshow:    false,
				pauseOnHover: true
			},
			fancyboxOptions:      {
				titlePosition: 'inside'
			},
			fancyboxHideOnMobile: true,
			cookiePrefix:         'websiteVk3q-',
			captions:             {
				bricksAllButton: 'all',
				timeDaysAgo:     'about %d days ago',
				timeDayAgo:      'about a day ago',
				timeHoursAgo:    'about %d hours ago',
				timeHourAgo:     'about an hour ago',
				timeMinutesAgo:  'about %d minutes ago',
				timeSecondsAgo:  'about %d seconds ago',
				timeNow:         'just now'
			}
		}, typeof websiteConfig != 'undefined' ? websiteConfig : {});

		// Human time difference
		var humanTimeDiff = function(from, to)
		{
			if (typeof to == 'undefined') {
				to = new Date();
			}
			var delta = Math.abs((to.getTime() - from.getTime()) / 1000);
			if (delta < 1) {
				delta = 0;
			}
			var time_ago = {
				days:    parseInt(delta / 86400, 10),
				hours:   parseInt(delta / 3600, 10),
				minutes: parseInt(delta / 60, 10),
				seconds: parseInt(delta, 10)
			};
			if (time_ago.days > 2)     return conf.captions.timeDaysAgo.replace('%d', time_ago.days);
			if (time_ago.hours > 24)   return conf.captions.timeDayAgo;
			if (time_ago.hours > 2)    return conf.captions.timeHoursAgo.replace('%d', time_ago.hours);
			if (time_ago.minutes > 45) return conf.captions.timeHourAgo;
			if (time_ago.minutes > 2)  return conf.captions.timeMinutesAgo.replace('%d', time_ago.minutes);
			if (time_ago.seconds > 1)  return conf.captions.timeSecondsAgo.replace('%d', time_ago.seconds);
			return conf.captions.timeNow;
		};

		// Deep link anchor
		var hash = unescape(self.document.location.hash);

		// Browsers support
		var ie = $.browser.msie    ? parseInt($.browser.version) : 256;
		var ff = $.browser.mozilla ? parseInt($.browser.version) : 256;

		// On resize end
		(function() {
			var last_width = null;
			var timer      = null;
			var resizeend = function() {
				var width = $(window).width();
				if (width === last_width) {
					$(window).trigger('resizeend');
					timer = null;
				} else {
					last_width = $(window).width();
					timer = setTimeout(resizeend, 150);
				}
			};
			$(window).resize(function() {
				if (timer == null) {
					resizeend();
				}
			});
		})();

		// Media types
		var windowWidth, lteTablet, lteMobile, lteMini, gteDektop, gteTablet, gteMobile, tablet, mobile, device;
		(function() {
			var on_resize = function() {
				windowWidth = $(window).width();
				lteTablet = windowWidth < 980;
				lteMobile = windowWidth < 740;
				lteMini   = windowWidth < 320;
				gteDektop = windowWidth >= 980;
				gteTablet = windowWidth >= 740;
				gteMobile = windowWidth >= 320;
				tablet    = lteTablet && gteTablet;
				mobile    = lteMobile && gteMobile;
				if (lteMini)     device = 'mini';
				else if (mobile) device = 'mobile';
				else if (tablet) device = 'tablet';
				else             device = 'desktop';
			};
			$(window).on('resizeend', on_resize); on_resize();
		})();

		// Images
		$('figure:has(img[width])').each(function() {
			var width   = $('img', this).attr('width');
			var padding = (parseInt($(this).css('padding-left'))+1)*2;
			if (width == parseInt(width)) {
				width = parseInt(width) + padding;
			} else {
				width = 'calc('+width+' + '+padding+'px)';
				$('img', this).removeAttr('width').addClass('full-width');
			}
			$(this).css('width', width);
		});

		// En-dash fix
		$('a, h1, h2, h3, h4, h5, h6')
			.filter(function() {
				return (
					$(this).text() == $(this).html() &&
					$(this).text().indexOf('\u2013') != -1 &&
					$(this).css('font-family').indexOf('Rokkitt') == 0
				);
			})
			.html(function() {
				return $(this).html().replace('\u2013', '<span class="en-dash-fix">\u2013</span>');
			});

		// Fixed bottom section
		$('#bottom.fixed').each(function() {
			var _this = this;
			var on_resize = function() {
				$('body').css('margin-bottom', $(_this).is(':visible') ? $(_this).innerHeight() : 0);
			};
			$(window).on('resizeend', on_resize); on_resize();
		});

		// Top frame
		$('#top h1').click(function() {
			$(this).next('#top .frame:not(:animated)').slideToggle(300);
		});

		// Navigations
		$('nav a[href="#"]').click(function() { return lteMobile; });
		$('nav li:has(ul)').addClass('sub');
		$('nav li ul li:has(ul)').mouseenter(function() {
			var ul = $('> ul', this);
			var cont = $(this).parents('.container');
			if (ul.offset().left + ul.outerWidth() - cont.offset().left > cont.width()) {
				ul.addClass('left');
			}
		});

		// Navigation main
		$('#nav-main li:has(ul) > a').click(function(e) {
			if (lteMobile && (e.pageX >= $(this).offset().left + $(this).width() - (13+16) || $(this).is('[href="#"]'))) {
				$(this).next('ul').slideToggle(300);
				return false;
			}
		});

		// Box
		$('.box[id][data-expires]').each(function() {
			var cookieName = conf.cookiePrefix + $(this).attr('id');
			if ($.cookie(cookieName) === null) {
				$('<a />').addClass('close').click(function() {
					$(this).unbind('click').parent().fadeTo(300, 0).slideUp(300);
					$.cookie(cookieName, '1', {expires: $(this).parent().data('expires'), path: '/'});
				}).prependTo($(this));
			} else {
				$(this).hide();
			}
		});

		// Columns
		(function() {
			var on_resize = function() {
				$('.columns > ul').each(function() {
					var height = 0;
					$(this).css('height', 'auto');
					if (gteTablet) {
						$('.column', this).each(function() {
							height = Math.max(height, $(this).height());
						});
						$(this).height(height);
					}
				});
			};
			$(window).on('resizeend', on_resize); on_resize();
		})();

		// Video
		$('.post iframe, .post object, .post embed').responsiveVideo();

		// Content
		$('.post .content:empty').remove();
		$('.post:not(:has(.title)):not(:has(.featured)):not(:has(.content))').remove();
		$('.post .content *').responsiveVideo();

		// Tabs
		$('.post .content .tabs').each(function() {
			var _this = this;
			if ($('> ul', this).length == 0) {
				$('<ul />').prependTo($(this));
				$('> div[data-label]', this).each(function() {
					var tab = $('<li />').text($(this).data('label')).appendTo($('> ul', _this));
					if (typeof $(this).data('active') != 'undefined' && $(this).data('active')) {
						tab.addClass('active');
					}
				});
			}
			var tabs = $('> ul > li', this);
			tabs.click(function() {
				$(this).parent().nextAll('div').hide().eq($(this).index()).show();
				$(this).parent().find('li.active').removeClass('active');
				$(this).addClass('active');
			});
			if (tabs.filter('.active').length > 0) {
				tabs.filter('.active').click();
			} else {
				tabs.eq(0).click();
			}
		});

		// Tooltip
		if ($('.tooltip').length > 0) {
			$.getScript(conf.templatePath+'/data/js/jquery.tipsy.min.js', function() {
				$('.tooltip').each(function() {
					$(this).tipsy({
						gravity: $(this).getData('gravity', 's'),
						fade:    $(this).getData('fade', false)
					});
				});

			});
		}

		// Buttons
		$('button').each(function() {
			if ($(this).is('[data-href]')) {
				$(this).click(function() {
					var target = typeof $(this).data('target') != 'undefined' ? $(this).data('target') : 'self';
					switch (target) {
						case 'blank':  window.open($(this).data('href')); break;
						case 'top':    window.top.location = $(this).data('href'); break;
						case 'parent': window.parent.location = $(this).data('href'); break;
						default:       window.location = $(this).data('href');
					}
				});
			}
		});

		// Items
		var items = $('.items:has(.item)');
		items.imagesLoaded(function() {

			items.masonry({
				itemSelector:     '.item:not(.hidden)',
				isAnimated:       true,
				animationOptions: {duration: 600},
				columnWidth:      function(containerWidth) {
					return $('.item').outerWidth(true);
				}
			});

			$('.item .image a', items).each(function() {
				if ($(this).hasClass('fancybox')) {
					$(this).hover(function() {
						$('.hover', this).stop(true).fadeTo(150, 0.4);
					}, function() {
						$('.hover', this).stop(true).fadeTo(150, 0);
					});
				} else {
					$(this).hover(function() {
						$('.hover', this).stop(true).animate({borderWidth: '12px'}, 150);
					}, function() {
						$('.hover', this).stop(true).animate({
							borderLeftWidth:   '0px',
							borderRightWidth:  '0px',
							borderTopWidth:    '0px',
							borderBottomWidth: '0px'
						}, 150);
					});
					if (ie <= 8) {
						$('.hover', this).fadeTo(0, 0.4);
					}
				}
			});

			$('.filter').each(function() {
				var links = $('> a', this);
				var items = $(this).next('.items');
				links.click(function() {
					var category = $(this).attr('href').substr(1);
					if (category == '') {
						$('.item', items).removeClass('hidden').fadeIn(250);
					} else {
						$('.item', items).each(function() {
							var regexp = new RegExp('\\b'+category+'\\b', 'i');
							if (
								(typeof $(this).data('category') == 'undefined') ||
								(!regexp.test($(this).data('category')))
							) {
								$(this).addClass('hidden').fadeOut(250);
							} else {
								$(this).removeClass('hidden').fadeIn(250);
							}
						});
					}
					$(this).parent().find('.active').removeClass('active');
					$(this).addClass('active');
					if (typeof items.data('masonry') == 'object') {
						items.masonry('reload');
					}
				});
				if (hash) {
					links.filter('[href="'+hash+'"]:first').click();
				} else if (links.filter('.active').length > 0) {
					links.filter('.active').click();
				} else {
					links.eq(0).click();
				}
			}).show();

		});

		// Fancybox
		$('a.fancybox').each(function() {
			var options = conf.fancyboxOptions;
			var matches = $(this).attr('href').match(/^http:\/\/(www\.youtube\.com\/watch\?v=|youtu\.be\/)([-_a-z0-9]+)/i);
			if (matches != null) {
				$(this).attr('href', 'http://www.youtube.com/v/'+matches[2]).addClass('swf');
			}
			if ($(this).hasClass('swf')) {
				$.extend(options, {type: 'swf', swf: {allowfullscreen: 'true', wmode: 'transparent'}});
			}
			if ($(this).hasClass('iframe')) {
				$.extend(options, {type: 'iframe', width: '90%', height: '90%'});
			}
			$(this).responsiveFancybox(options, function() { return lteMobile && conf.fancyboxHideOnMobile; });
		});

		// Flexslider
		$('.flexslider').filter(function() {
			return $('.slides > li', this).length >= 2;
		}).each(function() {
			var _this = this;
			$('.slides > li', this).hide();
			$(this).flexslider($.extend({}, conf.flexsliderOptions, {
				start:  function(slider) {
					if (slider.slides.eq(slider.currentSlide).is(':has(iframe, embed, object)')) {
						$('.flex-control-nav', _this).hide();
					}
				},
				before: function(slider) {
					var descs = $(_this).next('.descriptions').find('article');
					if (slider.animatingTo != slider.currentSlide && descs.length >= slider.slides.length) {
						descs.filter(':visible').fadeOut(conf.flexsliderOptions.animationDuration / 2, function() {
							descs.eq(slider.animatingTo).fadeIn(conf.flexsliderOptions.animationDuration / 2);
						});
					}
					if ($(_this).is(':not(.fixed)')) {
						$(_this).animate({
							height: slider.slides.eq(slider.animatingTo).height()
						}, conf.flexsliderOptions.animationDuration);
					}
					if (slider.slides.eq(slider.animatingTo).is(':has(iframe, embed, object)')) {
						$('.flex-control-nav', _this).fadeOut(100);
					} else {
						$('.flex-control-nav', _this).fadeIn(100);
					}
				}
			})).hover(function() {
				$('.flex-direction-nav a', this).stop(true).fadeTo(100, 0.4);
			}, function() {
				$('.flex-direction-nav a', this).stop(true).fadeTo(100, 0);
			});
			$('.flexslider .flex-direction-nav a').hover(function() {
				$(this).stop(true).fadeTo(100, 0.9);
			}, function() {
				$(this).stop(true).fadeTo(100, 0.4);
			});
		});

		// Video
		$('.wp-video:has(video)').each(function() {
			var video = $('video', this).first();
			var ratio = (parseInt(video.attr('height'), 10) / parseInt(video.attr('width'), 10))*100;
			$(this).css('padding-bottom', ratio+'%');
		});

		// Contact form
		$('.contact-form').submit(function() {
			if ($('input[type="submit"]', this).prop('disabled')) {
				return false;
			}
			var _this = this;
			$('input[type="submit"]', this).prop('disabled', true);
			$('.message', this).slideUp(300);
			$('.load', this).fadeIn(300);
			$.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				complete: function() {
					$('input[type="submit"]', _this).prop('disabled', false);
					$('.load', _this).fadeOut(300);
				},
				success: function(data) {
					$('.message', _this).removeClass('green orange');
					if (data === null) {
						$('.message', _this)
							.text('Unknown error.')
							.addClass('orange')
							.slideDown(300);
					} else {
						$('.message', _this)
							.text(data.message)
							.addClass(data.result ? 'green' : 'orange')
							.slideDown(300);
						if (data.result) {
							$('input[type="text"], textarea', _this).val('');
						}
					}
				}
			});
			return false;
		});

	});

})(jQuery);