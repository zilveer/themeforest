
!function( $, window, document ) {

	"use strict";

	var _doc  = $( document ), 
		_win  = $( window );

	var ShiroiHana = window.ShiroiHana = window.ShiroiHana || {};

	$.extend( ShiroiHana, {

		resizeCallbacks: [], 

		cssAnimations: (function(a,b){a=(new Image).style;b='nimationName';return'a'+b in a||'webkitA'+b in a||'MozA'+b in a})(), 

		isMobile: (function(a){return/(android|bb\d+|meego).+mobile|android|ipad|playbook|silk|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera), 

		windowHeight: _win.height(), 

		init: function() {

			/* ==========================================================================
				Setup Listeners
			============================================================================= */

			ShiroiHana.setupListeners();

			/* ==========================================================================
				Wait for Document.Ready
			============================================================================= */

			$( ShiroiHana.ready );

		}, 

		ready: function() {

			/* ==========================================================================
				Apply any patches/fixes
			============================================================================= */

			ShiroiHana.applyPatches();

			/* ==========================================================================
				Back to Top Button
			============================================================================= */

			_doc.on( 'click', '.back-to-top', function(e) {
				$( 'html,body' ).finish().animate({ scrollTop: 0 });
				e.preventDefault();
			});

			/* ==========================================================================
				Header Affix
			============================================================================= */

			if( $.fn.affix ) {

				var backToTop = $( '.back-to-top' );
				var affixes = $( '.affix-wrap .affix-container[data-affix]' ).each(function() {

					var element = $( this ), 
						wrapper = element.closest( '.affix-wrap' );

					enquire && enquire.register( element.data( 'affix' ), {

						match: function() {

							_win.off( '.affix' );

							element.affix({
								offset: {
									top: function() {
										return wrapper.offset().top;
									}
								}
							}).on( 'affixed.bs.affix', function() {
								backToTop.addClass( 'affix' );
								wrapper.css( 'height', element.outerHeight() );
							}).on( 'affixed-top.bs.affix', function() {
								backToTop.removeClass( 'affix' );
								wrapper.css( 'height', '' );
							});

						}, 

						unmatch: function() {
							if( 1 === affixes.length ) _win.off( '.affix' );
							backToTop.removeClass( 'affix' );
							wrapper.css( 'height', '' );
							element
								.off( '.bs.affix' )
								.removeData( 'bs.affix' )
								.removeClass( 'affix affix-top affix-bottom' );
						}

					});

				});

			}

			/* ==========================================================================
				Mobile Nav
			============================================================================= */

			!function() {

				var closeSubmenus = function() {
					$( this ).find( '.sub-menu' ).css( 'display', '' );
					$( this ).find( '.subnav-toggle' ).removeClass( 'open' );
				};

				_doc.on( 'click.mobile-nav', '.mobile-nav-toggle a', function( e ) {

					var primaryNavMenu = $( '.primary-nav .menu' );

					if( primaryNavMenu.is( ':visible' ) ) {

						primaryNavMenu.slideUp( 300, function() {
							closeSubmenus.apply( this );
							$( '.primary-nav-wrap' ).css( 'maxHeight', '' );
						});

					} else {

						$( '.primary-nav-wrap' ).css( 'maxHeight', ShiroiHana.windowHeight - $( '.primary-nav' ).position().top );
						primaryNavMenu.slideDown( 300 );

					}

					e.preventDefault();

				}).on( 'click.mobile-nav', '.primary-nav .subnav-toggle', function(e) {

					$( this ).toggleClass( 'open' )
						.next( '.sub-menu' ).slideToggle( 300, closeSubmenus );

					e.preventDefault();
				});

			}();

			/* ==========================================================================
				Search Toggle
			============================================================================= */

			_doc.on( 'click.shiroi.search', function( e ) {
				var target = $( e.target );
				if( ! target.closest( '.site-header-search' ).length ) {
					$( '.site-header-search' ).removeClass( 'open' );
				} else if( target.closest( '.search-toggle' ).length ) {
					$( '.site-header-search' ).toggleClass( 'open' );
					e.preventDefault();
				}
			});

			/* ==========================================================================
				Featured Posts Slider Fotorama
			============================================================================= */
			
			if( $.fn.fotorama ) {

				!function() {

					var TimelineManager = function( element ) {
						this.element = $( element );
						this.init();
					}

					TimelineManager.prototype = {

						init: function() {

							var title, meta, link, delay = 0;

							title = this.element.find( '.featured-entry-title' );
							meta  = this.element.find( '.featured-entry-meta' );
							link  = this.element.find( '.featured-entry-read-more' );

							if( ! title.length && ! meta.length && ! link.length ) {
								return;
							}

							if( title.length ) {

								this.splitText = new SplitText( title, { type: 'words,chars', charsClass: 'fpt-char' });
								$.each( this.splitText.chars, function( index ) {
									$( this ).css({
										'animation-name': 'fpt-anim', 
										'animation-delay': delay + 's'
									});
									delay += 0.03;
								});

								// Add delay to account the last character
								delay += 0.3;
							}

							if( meta.length ) {
								meta.css( 'transition-delay', delay + 's' );
							}

							if( link.length ) {

								if( meta.length ) {
									delay += 0.2;
								}

								link.css( 'transition-delay', delay + 's' );
							}

							this.active = true;

						}, 

						restart: function( pause ) {
							if( this.active ) {
								if( this.splitText ) {
									$( this.splitText.chars ).css( 'animation-name', pause ? '' : 'fpt-anim' );
								}
								this.element.toggleClass( 'animation-playing', ! pause );
							}
						}
					};

					var initOrResize = function( ratio ) {
						$( '.featured-entries-slider .fotorama' ).each(function() {
							var api = $( this ).data( 'fotorama' );
							if( api instanceof jQuery.Fotorama ) {
								api.resize({ ratio: ratio });
							} else {
								$( this ).fotorama({ ratio: ratio })
							}
						});
					}

					if( ! ShiroiHana.isMobile && ShiroiHana.cssAnimations ) {

						$( '.featured-entries-slider.animation-enabled' ).addClass( 'animation-on' ).find( '.fotorama' ).each(function() {

							var slider = $( this ).on( 'fotorama:ready fotorama:show', function( event, fotorama ) {

								var timelines = $.map( fotorama.data, function( frame ) {
									if( ! frame.timelineManager ) {
										if( $.contains( document, frame.html ) ) {
											frame.timelineManager = new TimelineManager( frame.html );
										} else {
											return;
										}
									}
									return frame.timelineManager;
								});

								// Stop listening when timelines are initialized
								if( timelines.length === fotorama.data.length ) {
									slider.off( 'fotorama:ready fotorama:show' );
								}

							})
							.on( 'fotorama:showend', function( event, fotorama ) {

								if( fotorama.activeIndex != fotorama.lastIndex ) {

									fotorama.lastIndex = fotorama.activeIndex;

									$.each( fotorama.data, function( index ) {
										if( this.timelineManager ) {
											this.timelineManager.restart( index != fotorama.activeIndex );
										}
									});
									
								}

							});

						});
					}

					enquire && enquire
						.register( '(max-width: 479px)', function() {
							initOrResize( 8 / 7 );
						})
						.register( '(min-width: 480px) and (max-width: 767px)', function() {
							initOrResize( 4 / 3 );
						})
						.register( '(min-width: 768px) and (max-width: 991px)', function() {
							initOrResize( 16 / 9 );
						})
						.register( '(min-width: 992px) and (max-width: 1199px)', function() {
							initOrResize( 8 / 3 );
						})
						.register( '(min-width: 1200px) and (max-width: 1367px)', function() {
							initOrResize( 20 / 7 );
						})
						.register( '(min-width: 1368px) and (max-width: 1599px)', function() {
							initOrResize( 171 / 50 );
						})
						.register( '(min-width: 1600px)', function() {
							initOrResize( 48 / 13 );
						});
				}();
			}

			/* ==========================================================================
				FitVids
			============================================================================= */

			if( $.fn.fitVids ) {
				$( '.entry-media, .entry-content' ).fitVids();
			}

			/* ==========================================================================
				Justified Grids
			============================================================================= */
			
			if( $.fn.justifiedGrids ) {

				$( '.justified-grids' ).each(function() {
					
					$( this ).justifiedGrids( $.extend({
						assignBottomMargin: true, 
						ratio: 'img'
					}, $( this ).data() ));

				});

			}

			/* ==========================================================================
				Masonry Layout
			============================================================================= */

			if( $.fn.masonry && $.fn.imagesLoaded ) {

				$.each({
					'.gallery': {
						itemSelector: '.gallery-item', 
						gutter: 10
					}, 
					'.entries-wrap-grid.masonry': {
						itemSelector: '.hentry', 
						columnWidth: '.hentry-sizer', 
						percentPosition: true
					}
				}, function( selector, options ) {

					$( selector ).each(function() {
						var $this = $( this );
						$this.imagesLoaded().done(function() {
							$this.masonry( options );
						});
					});

				});

			}

			/* ==========================================================================
				Image Galleries
			============================================================================= */

			if( $.fn.magnificPopup ) {

				$.each({
					'.entry-media-image .image-link': {}, 
					'.gallery': {
						delegate: '.gallery-item a', 
						image: {
							titleSrc: function( item ) {
								var caption;
								if( item.el && item.el.length ) {
									caption = item.el.closest( '.gallery-item' ).find( 'figcaption' );
									if( caption.length ) {
										return caption[0].innerHTML;
									}
								}
								return '';
							}
						}
					}, 
					'.justified-grids': {
						delegate: '.media-grid-link', 
						image: {
							titleSrc: function( item ) {
								var caption;
								if( item.el && item.el.length ) {
									caption = item.el.siblings( 'figcaption' );
									if( caption.length ) {
										return caption[0].innerHTML;
									}
								}
								return '';
							}
						}
					}
				}, function( selector, options ) {
					$( selector ).each(function() {
						$( this ).magnificPopup( $.extend( true, {}, {
							type: 'image', 
							image: {
								verticalFit: true
							}, 
							gallery: {
								enabled: true, 
								navigateByImgClick: true
							}
						}, options ));
					});
				});

				$( '.entry-content .mfp-image' ).closest( 'a' ).magnificPopup({
					type: 'image', 
					closeOnContentClick: true, 
					image: {
						verticalFit: true
					}
				});

			}

			/* ==========================================================================
				Fire initial window resize callback
			============================================================================= */

			ShiroiHana.onResize();
		}, 

		onResize: function() {

			ShiroiHana.windowHeight = _win.height();

			/* ==========================================================================
				Reset Menu styles
			============================================================================= */

			$( '.primary-nav ul' ).css( 'display', '' );

			/* ==========================================================================
				Sticky Footer
			============================================================================= */

			$( '.site-footer.sticky' ).each(function() {
				$( this ).closest( '.site-wrapper' )
					.css( 'paddingBottom', $( this ).outerHeight() );
			});
		}, 

		setupListeners: function() {

			/* ==========================================================================
				Window resize debouncer
			============================================================================= */

			var resizeTimeout;
			_win.on( 'resize.shiroi orientationchange.shiroi', function() {
				if( resizeTimeout ) clearTimeout( resizeTimeout );
				resizeTimeout = setTimeout( ShiroiHana.onResize, 16 );
			});

			/* ==========================================================================
				Call all resize callbacks after window.load
			============================================================================= */

			_win.on( 'load', ShiroiHana.onResize );
		}, 

		applyPatches: function() {

			/* ==========================================================================
				Media Element JS Patch for Fluid Video Players
			============================================================================= */

			!function( oldFn ) {

				$.fn.mediaelementplayer = function( options ) {
					if( false !== options ) {

						this.filter( '.wp-video-shortcode' )
							.css({ width: '100%', height: '100%' });

						options = $.extend( options, {
							audioHeight: 36
						});
					}

					return oldFn.apply( this, [ options ] );
				};
			}( $.fn.mediaelementplayer );
		}
	});

	ShiroiHana.init();

	/* EOF */

}( jQuery, window, document );