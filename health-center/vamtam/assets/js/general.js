/* jshint multistr:true */
(function() {
	"use strict";

	jQuery.WPV = jQuery.WPV || {}; // Namespace

	(function ($, undefined) {
		var J_WIN = $(window);
		var body  = $('body');

		$(function () {
			if(top !== window && /vamtam\.com/.test(document.location.href)) {
				var width = 0;

				setInterval(function() {
					if($(window).width() !== width) {
						$(window).resize();
						setTimeout(function() { $(window).resize(); }, 100);
						setTimeout(function() { $(window).resize(); }, 200);
						setTimeout(function() { $(window).resize(); }, 300);
						setTimeout(function() { $(window).resize(); }, 500);
						width = $(window).width();
					}
				}, 200);
			}

			if ($("body").is(".responsive-layout")) {
				J_WIN.triggerHandler('resize.sizeClass');
			}

			body.bind('wpv-content-resized', function() {
				setTimeout(function() {
					body.trigger('wpv-hide-splash-screen');
				}, 1000);

				body.imagesLoaded(function() {
					body.trigger('wpv-hide-splash-screen');
				});
			}).one('wpv-hide-splash-screen', function() {
				$('.wpv-splash-screen').fadeOut(500, function() {
					$(this).remove();
				});
			});

			if ( $.fn.chosen ) {
				$(".wpv-chosen-select").chosen({ width: '100%' });
			}

			if ( $.webshims ) {
				$.webshims.polyfill('forms forms-ext');
			}

			(function() {
				var box = $('.boxed-layout'),
					timer;

				$(window).scroll(function(e) {
					clearTimeout(timer);
					if (!box.hasClass('disable-hover') && e.target === document) {
						box.addClass('disable-hover');
					}

					timer = setTimeout(function() {
						box.removeClass('disable-hover');
					}, 500);
				});
			})();

			if($('html').is('.placeholder')) {
				$.rawContentHandler(function() {
					$('.label-to-placeholder label[for]').each(function() {
						$('#' + $(this).prop('for')).attr('placeholder', $(this).text());
						$(this).hide();
					});
				});
			}

			/** tribe **/
			if ( 'tribe_ev' in window ) {
				$( window.tribe_ev.events ).bind( 'tribe_ev_monthView_ajaxSuccess', function() {
					$( '.meta-header-inside .title' ).html( $( '.tribe-events-page-title' ).html() );
				} );
			}
			////////////

			setTimeout(function() {
				$('.tt_tabs').unbind('tabsbeforeactivate');
			}, 100);

			if ( navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) && navigator.userAgent.match( /AppleWebKit/ ) ) {
				var version = /Version\/(\d+)/.exec( navigator.userAgent );

				if ( version && parseInt( version[1], 10 ) <= 7 ) {
					$( 'html' ).addClass( 'bad-ios' );
				}
			}

			// Video resizing
			// =====================================================================
			J_WIN.bind('resize.video load.video', function() {
				$('.portfolio-image-wrapper,\
					.boxed-layout .media-inner,\
					.boxed-layout .loop-wrapper.news .thumbnail,\
					.boxed-layout .portfolio-image .thumbnail,\
					.boxed-layout .wpv-video-frame').find('iframe, object, embed, video').each(function() {
					var v = $(this);

					if(v.prop('width') === '0' && v.prop('height') === '0') {
						v.css({width: '100%'}).css({height: v.width()*9/16});
					} else {
						v.css({height: v.prop('height')*v.width()/v.prop('width')});
					}

					v.trigger('vamtam-video-resized');
				});

				setTimeout(function() {
					$('.mejs-time-rail').css('width', '-=1px');
				}, 100);
			}).triggerHandler("resize.video");

			if('mediaelementplayer' in $.fn) {
				$('.wpv-background-video').mediaelementplayer({
					videoWidth: '100%',
					videoHeight: '100%',
					loop: true,
					enableAutosize: true,
					features: []
				});
			}

			$('.wpv-grid.has-video-bg').addClass('video-bg-loaded');

			(function() {
				var body = $('body');
				var admin_bar_fix = body.hasClass('admin-bar') ? 32 : 0;

				J_WIN.smartresize(function() {
					$('body').trigger('wpv-content-resized');

					if( !(body.hasClass('boxed')) ) {
						var pos = ($('.wpv-grid.extended:first').outerWidth() - $(window).width())/2;
						$('.extended-column-inner > .wpv-video-bg,\
							.wpv-grid.extended.grid-1-1.parallax-bg > .wpv-parallax-bg-img,\
							.wpv-grid.extended.grid-1-1.parallax-bg-suspended > .wpv-parallax-bg-img').css({
							left: pos,
							right: pos
						});

						$('.extended-column-inner > .wpv-video-bg').each(function() {
							var mep = $('.mejs-mediaelement > *', this),
								meph = mep.height(),
								thish = $(this).height(),
								thisw = $(this).width();

							var newvw = (thish/meph)*thisw,
								adj = (newvw - thisw)/2;

							if(adj > 0) {
								$(this).css({
									left: "-="+adj,
									right: "-="+adj
								});
							}
						});
					}

					var wheight = J_WIN.height() - admin_bar_fix;

					$('.wpv-grid[data-padding-top]').each(function() {
						var col = $(this);

						col.css('padding-top', 0);
						col.css('padding-top', wheight - col.outerHeight() + parseInt(col.data('padding-top'), 10));
					});

					$('.wpv-grid[data-padding-bottom]:not([data-padding-top])').each(function() {
						var col = $(this);

						col.css('padding-bottom', 0);
						col.css('padding-bottom', wheight - col.outerHeight() + parseInt(col.data('padding-bottom'), 10));
					});

					$('.wpv-grid[data-padding-top][data-padding-bottom]').each(function() {
						var col = $(this);

						col.css('padding-top', 0);
						col.css('padding-bottom', 0);

						var new_padding = (wheight - col.outerHeight() + parseInt(col.data('padding-top'), 10))/2;

						col.css({
							'padding-top': new_padding,
							'padding-bottom': new_padding
						});
					});
				});
			})();

			// Animated buttons
			// =====================================================================
			$(document).on('mouseover focus click', '.animated.flash, .animated.wiggle', function() {
				$(this).removeClass('animated');
			});

			// Tooltip
			// =====================================================================
			var tooltip_animation = 250;
			$('.shortcode-tooltip').hover(function () {
				var tt = $(this).find('.tooltip').fadeIn(tooltip_animation).animate({
					bottom: 25
				}, tooltip_animation);
				tt.css({ marginLeft: -tt.width() / 2 });
			}, function () {
				$(this).find('.tooltip').animate({
					bottom: 35
				}, tooltip_animation).fadeOut(tooltip_animation);
			});

			$('.sitemap li:not(:has(.children))').addClass('single');

			// Scroll to top button
			// =====================================================================
			$(window).bind('resize scroll', function () {
				$('#scroll-to-top').toggleClass("visible", window.pageYOffset > 0);
			});
			$('#scroll-to-top, .wpv-scroll-to-top').click(function (e) {
				$('html,body').animate({
					scrollTop: 0
				}, 300);

				e.preventDefault();
			});

		});

		$('#feedback.slideout').click(function(e) {
			$(this).parent().toggleClass("expanded");
			e.preventDefault();
		});

		(function() {
			var elements = [];

			$( ".row:has(> div.has-background)" ).each( function( i, row_el ) {
				var row = $( row_el ),
					columns = row.find( '> div' );

				if ( columns.length > 1 ) {
					row.addClass( 'has-nomargin-column' );
					elements.push( columns );
				}
			});

			$( ".row:has(> div > .linkarea)" ).each( function( i, row_el ) {
				var row = $( row_el ),
					columns = row.find( '> div > .linkarea' );

				if ( columns.length > 1 ) {
					elements.push( columns );
				}
			});

			$( ".row:has(> div > .services.has-more)" ).each( function( i, row_el ) {
				var row = $( row_el ),
					columns = row.find( '> div > .services.has-more > .closed' );

				if ( columns.length > 1 ) {
					elements.push( columns );
				}
			});

			$( '#footer-sidebars .row' ).each( function() {
				elements.push( $(this).find('aside') );
			});

			J_WIN.resize( _.throttle( function() {
				var i;
				if ( $.WPV.MEDIA.layout['layout-below-max'] ) {
					for ( i = 0; i < elements.length; ++i ) {
						elements[i].matchHeight( 'remove' );
					}
				} else {
					for ( i = 0; i < elements.length; ++i ) {
						elements[i].matchHeight( false );
					}
				}
			}, 600 ) );
		})();

		// LINKAREA
		// =========================================================================
		$( document )
		.on("mouseenter", ".linkarea[data-hoverclass]", function() {
			$(this).addClass(this.getAttribute("data-hoverclass"));
		})
		.on("mouseleave", ".linkarea[data-hoverclass]", function() {
			$(this).removeClass(this.getAttribute("data-hoverclass"));
		})
		.on("mousedown", ".linkarea[data-activeclass]", function() {
			$(this).addClass(this.getAttribute("data-activeclass"));
		})
		.on("mouseup", ".linkarea[data-activeclass]", function() {
			$(this).removeClass(this.getAttribute("data-activeclass"));
		})
		.on("click", ".linkarea[data-href]", function(e) {
			if (e.isDefaultPrevented()) {
				return false;
			}

			var href = this.getAttribute("data-href");
			if (href) {
				e.preventDefault();
				e.stopImmediatePropagation();
				try {
					var target = String(this.getAttribute("data-target") || "self").replace(/^_/, "");
					if (target === "blank" || target === "new") {
						window.open(href);
					} else {
						window[target].location = href;
					}
				} catch (ex) {}
			}
		});

		J_WIN.triggerHandler('resize.sizeClass');

		$(window).bind("load", function() {
			setTimeout(function() {
				$(window).trigger("resize");
			}, 1);
		});

	})(jQuery);

})();