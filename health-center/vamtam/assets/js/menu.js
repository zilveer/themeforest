(function($, undefined) {
	"use strict";

	$(function() {
		if ( Modernizr.touch || true ) {
			var currently_active;

			$( '.fixed-header-box .menu-item-has-children > a' ).bind( 'touchend', function( e ) {
				this.had_touchend = e.timeStamp;
			} ).bind( 'click', function( e ) {
				if ( e.timeStamp - ( this.had_touchend || 0 ) > 1000 ) {
					return true;
				}

				if ( currently_active !== this ) {
					e.preventDefault();
					currently_active = this;
				}

				e.stopPropagation();
			} );

			$( window ).bind( 'click.sub-menu-double-tap', function() {
				currently_active = undefined;
			} );
		}

		$('#main-menu .menu-item > .sub-menu').each(function() {
			$(this).wrap('<div class="sub-menu-wrapper"></div>');
		});

		var mainHeader = $('header.main-header'),
			win = $(window),
			doc = $(document);

		var explorer = /MSIE (\d+)/.exec(navigator.userAgent);
		var hasStickyHeader = function() {
			return $('body').hasClass('sticky-header') &&
				!(explorer && parseInt(explorer[1], 10) === 8) &&
				!$.WPV.MEDIA.is_mobile() &&
				!$.WPV.MEDIA.layout["layout-below-max"];
		};

		var currentAnimation;

		var scrollToEl = function(el) {
			if(el.length > 0 && !currentAnimation) {
				currentAnimation = el;

				var firstAnimation = true,
					animationStart = +new Date();

				var getScrollPosition = function() {
					var header = mainHeader.offset().top + mainHeader.height() - $(window).scrollTop();
					var adminbar = ($('#wpadminbar') ? $('#wpadminbar').height() : 0);

					return ~~(el.offset().top - (hasStickyHeader() ? header : adminbar));
				};

				var advance = function(q) {
					return ~~((getScrollPosition() - win.scrollTop())*q);
				};

				var goToEl = function(done) {
					var move = advance(0.9),
						now = +new Date();

					if( done || Math.abs(move) <= 100 ) {
						if(now - animationStart > 300) {
							currentAnimation = void 0;
							$('html,body').stop().animate({
								scrollTop: getScrollPosition()
							}, 50, 'linear', function() {
								$.WPV.blockStickyHeaderAnimation = false;
							});
						} else {
							waitForFinish();
						}

						return;
					} else {
						$('html,body').stop().animate({
							scrollTop: "+="+move
						}, Math.abs(move)/4, 'linear', function() {
							if(!firstAnimation) {
								$.WPV.blockStickyHeaderAnimation = true;
							}

							firstAnimation = false;
							if(getScrollPosition() - win.scrollTop() > 50 && win.scrollTop() + win.height() < doc.height()) {
								goToEl();
							} else if(!done) {
								goToEl(true);
							}
						});
					}
				};

				var waitForFinish = function() {
					var now = +new Date();
					var timeLeft = now - animationStart;

					$('html,body').stop().animate({
						scrollTop: getScrollPosition()
					}, timeLeft/2, 'linear', function() {
						$('html,body').stop().animate({
							scrollTop: getScrollPosition()
						}, timeLeft/2, 'linear', function() {
							$('html,body').stop().animate({
								scrollTop: getScrollPosition()
							}, 50, 'linear', function() {
								currentAnimation = void 0;
								$.WPV.blockStickyHeaderAnimation = false;
							});
						});
					});
				};

				goToEl();
			}
		};

		$(document.body).on('click', '.wpv-animated-page-scroll[href], .wpv-animated-page-scroll [href], .wpv-animated-page-scroll [data-href]', function(e) {
			var href = $( this ).prop( 'href' ) || $( this ).data( 'href' );
			var el   = $( '#' + ( href ).split( "#" )[1] );

			var l  = document.createElement('a');
			l.href = href;

			if(el.length && l.pathname === window.location.pathname) {
				scrollToEl(el);
				e.preventDefault();
			}
		});

		if ( window.location.hash !== "" &&
			(
				$( '.wpv-animated-page-scroll[href*="' + window.location.hash + '"]' ).length ||
				$( '.wpv-animated-page-scroll [href*="' + window.location.hash + '"]' ).length ||
				$( '.wpv-animated-page-scroll [data-href*="'+window.location.hash+'"]' ).length ||
				$( '.wpv-tabs [href*="' + window.location.hash + '"]').length
			)
		) {
			var el = $( window.location.hash );

			if ( $( '.wpv-tabs [href*="' + window.location.hash + '"]').length ) {
				el = el.closest( '.wpv-tabs' );
			}

			if ( el.length > 0 ) {
				$( 'html,body' ).animate( {
					scrollTop: $( 'html' ).scrollTop() + 1
				}, 0 );
			}

			setTimeout( function() {
				scrollToEl( el );
			}, 400 );
		}

		// adds .current-menu-item classes

		var hashes = [
			// ['top', $('<div></div>'), $('#top')]
		];

		$('#main-menu').find('.menu').find('.maybe-current-menu-item, .current-menu-item').each(function() {
			var link = $('> a', this);

			if(link.prop('href').indexOf('#') > -1) {
				var link_hash = link.prop('href').split('#')[1];

				if('#'+link_hash !== window.location.hash) {
					$(this).removeClass('current-menu-item');
				}

				hashes.push([link_hash, $(this), $('#'+link_hash)]);
			}
		});

		if(hashes.length > 1) {
			var winHeight = 0;
			var documentHeight = 0;

			var prev_upmost_data = null;

			win.scroll(function() {
				winHeight = win.height();
				documentHeight = $(document).height();

				var cpos = win.scrollTop();
				var upmost = Infinity;
				var upmost_data = null;

				for(var i=0; i<hashes.length; i++) {
					var el = hashes[i][2];

					if(el.length) {
						var top = el.offset().top + 10;

						if( top > cpos && top < upmost && ( top < cpos + winHeight/2 || ( top < cpos + winHeight && cpos + winHeight === documentHeight) ) ) {
							upmost_data = hashes[i];
							upmost = top;
						}

						hashes[i][1].removeClass('current-menu-item');
					}
				}

				if(upmost_data && (upmost_data[0] !== 'top' || prev_upmost_data)) {
					upmost_data[1].addClass('current-menu-item');

					if('history' in window && (prev_upmost_data !== null ? prev_upmost_data[0] : '') !== upmost_data[0]) {
						window.history.pushState(upmost_data[0], $('> a', upmost_data[1]).text(), (cpos !== 0 ? '#'+upmost_data[0] : location.href.replace(location.hash, '')));
						prev_upmost_data = $.extend({}, upmost_data);
					}
				} else if( upmost_data === null && prev_upmost_data !== null) {
					prev_upmost_data[1].addClass('current-menu-item');
				}
			});
		}
	});
})(jQuery);