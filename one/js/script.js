(function($) {
	"use strict";

	$(document).ready(function() {

		/**
		 * Header fixed
		 */

		if( $( 'body' ).hasClass( 'thb-desktop' ) && $( 'body' ).hasClass( 'thb-sticky-header' ) ) {
			var header_container = $( '#header' ),
				header_inner_wrapper = header_container.find('.thb-header-inner-wrapper');

			window.skin_light_class = header_container.hasClass( 'thb-skin-light' );
			window.skin_dark_class = header_container.hasClass( 'thb-skin-dark' );

			$(window).on( 'scroll.thb-header', function() {

				if ( $(this).scrollTop() > ( header_container.outerHeight() ) ) {
					header_container.addClass( 'scrolled' );

					header_container.removeClass( 'thb-skin-light thb-skin-dark' );

				} else {
					header_container.removeClass( 'scrolled' );

					if ( window.skin_light_class ) {
						header_container.addClass( 'thb-skin-light' );
					} else {
						header_container.addClass( 'thb-skin-dark' );
					}
				}

			} );
		}

		/**
		 * Search functionality
		 */
		if( $( ".thb-search-icon-container" ).length ) {

			var thb_search_form_container = $( "#thb-search-box-container" );

			var thb_search_form = new THB_Toggle({
				target: thb_search_form_container,

				on: function() {
					$("body").addClass( 'thb-search-enable' );
					$("#thb-search-box-container").css("visibility", "visible");
					$("#thb-search-box-container #searchform #s").focus();
				},
				off: function() {
					$("body").removeClass( 'thb-search-enable' );
				},
				offTransitionEnd: function() {
					$("#thb-search-box-container").css("visibility", "hidden");
				}
			});

			$.thb.key("esc", thb_search_form.off);
			$('#thb-search-exit').on('click', thb_search_form.off);
			$('.thb-search-icon-container a').on('click', thb_search_form.on);

		}

		/**
		 * Fittext
		 */
		if( ! $('body').hasClass('thb-fittext-disabled') ) {
			var selectors = $('.thb-page-header-inner-wrapper .page-title, .layout-style-b.thb-section-column-block-thb_text_box .thb-section-block-header .thb-section-block-title, .layout-style-c.thb-section-column-block-thb_text_box .thb-section-block-header .thb-section-block-title, .layout-style-d.thb-section-column-block-thb_text_box .thb-section-block-header .thb-section-block-title');

			selectors.each( function() {
				$( this ).fitText( 0.8, { maxFontSize: $( this ).css('font-size') } );
			} );
		}

		/**
		 * Fit builder section height to the window height
		 */
		if ( $( ".thb-section" ).length ) {
			$( ".thb-section-extra[data-fit-height='1']" ).each( function() {
				var section = $( this ),
					offset = $( "body" ).offset().top,
					window_height = $( window ).height();

					// if ( $( "body" ).hasClass( 'thb-sticky-header') && $( "#header" ).hasClass( "scrolled" ) ) {
					// 	offset = offset + $( "#header.scrolled .thb-header-inner-wrapper" ).outerHeight();
					// }

					var w_height = window_height - offset;

				section.css('min-height', w_height );
			} );
		}

		/**
		 * Add a page preload
		 */

		if( ! $('body').hasClass('thb-mobile') ) {
			NProgress.configure().start();

			$( "#header" ).imagesLoaded( function() {
				if ( $( "body" ).hasClass( "thb-sticky-header" ) ) {
					$( "#header" ).css( "height", $( "#header .thb-header-inner-wrapper" ).outerHeight() );
				}

				if ( $( "body" ).hasClass( "pageheader-layout-e" ) || $( "body" ).hasClass( "pageheader-layout-f" ) ) {
					var offset = $( "body" ).offset().top,
						window_height = $( window ).height();

					var w_height = window_height - offset;

					$( "#page-header .thb-page-header-image-holder, #page-header .full_slideshow" ).css( "height", w_height );

					if ( $( "body" ).hasClass( "pageheader-layout-f" ) ) {
						$( "#page-header" ).css( "height", w_height );
					}
				}

				if ( $( "body" ).hasClass( "thb-pageheader-parallax" ) && $( "body" ).hasClass( "thb-desktop") ) {
					$("#page-header .full_slideshow .slide").parallax("50%", -0.6);
				}

				/**
				 * Scroll in page
				 */

				if( ! $('body').hasClass('thb-mobile') ) {
					var smoothScrollSelectors = ".thb-btn.action-primary, .thb-btn.action-secondary, li.menu-item a, .thb-slide-caption .thb-call-to .thb-btn";

					var header = $( "#header" ),
						offset = 0;

					if ( $( "body" ).hasClass( "thb-sticky-header" ) ) {
						if ( ! header.hasClass( "scrolled" ) ) {
							offset = header.outerHeight() - 32;
						}
						else {
							offset = header.outerHeight();
						}
					}

					window.thb_scroll_in_page( smoothScrollSelectors, {}, offset, function() {
						window.thb_slide_menu.off();
					} );
				}

				setTimeout( function() {
					$( window ).trigger( "resize" );
					$( window ).trigger( 'scroll.thb-header' );

					NProgress.done();
					setTimeout( function() {
						$("body").addClass("thb-page-loaded");
					}, 250 );
				}, 250 );
			} );
		} else {
			$("body").addClass("thb-page-loaded");
		}

		/**
		 * Fix the content height if there isn't enough content
		 */

		if( !$('body').hasClass('thb-mobile') ) {

			if ( $('#page-content').length > 0 ) {
				var body_height = $('body').height(),
					window_height = $(window).height() - $('body').offset().top,
					page_content_height = $('#page-content').outerHeight(),
					body_window_diff = window_height - body_height;

				if ( body_height < window_height ) {
					$('#page-content').css('min-height', page_content_height + body_window_diff);
				} else {
					$('#page-content').css('min-height', $(window).height() - $('#page-content').offset().top - $('#footer').outerHeight() - $('#footer-sidebar').outerHeight() );
				}

			}

		}

		/**
		 * Go top
		 */

		if( ! $('body').hasClass('thb-mobile') ) {
			$(window).scroll(function(){
				if ($(this).scrollTop() > 300) {
					$('.thb-scrollup').fadeIn('fast');
				} else {
					$('.thb-scrollup').fadeOut('fast');
				}
			});
		}

		if ( $('.thb-go-top').length ) {
			$('.thb-go-top').click(function(){
				$("html, body").stop().animate({ scrollTop: 0 }, 350, 'easeInOutCubic' );
				return false;
			});
		}

		/**
		 * Menu
		 */

		if ( ! $( "body" ).hasClass( "header-layout-b" ) ) {
			$(".main-navigation > div").menu({
				megaMenu: {
					fixed: false
				}
			});

			if ( $( "#top-nav" ).length ) {
				$(".secondary-navigation > div").menu();
			}
		}

		/**
		 * Mobile menu toggle
		 */

		window.thb_slide_menu = new THB_Toggle({
			target: $("#slide-menu-container"),
			on: function() {
				$("body").addClass( 'menu-open' );
				$("#slide-menu-container").css("visibility", "visible");
			},
			off: function() {
				$("body").removeClass( 'menu-open' );
			},
			offTransitionEnd: function() {
				$("#slide-menu-container").css("visibility", "hidden");
			}
		});

		$.thb.key("esc", window.thb_slide_menu.off);
		$('.thb-trigger-close').on('click', window.thb_slide_menu.off);
		$('.slide-menu-trigger').on('click', window.thb_slide_menu.on);

		/**
		 * FitVids
		 */

		$(".thb-text, .textwidget, .work-slides-container, .format-embed-wrapper, .thb-section-block-thb_video-video-holder").fitVids();

		/**
		 * Blog Masonry
		 */

		if( $( ".thb-masonry-container" ).length ) {
			var blog_masonry = new THB_Isotope( $(".thb-masonry-container") );
		}

		/**
		 * Photogallery.
		 */
		window.thb_isotope_styleAdjust = function() {};

		/**
		 * Portfolio.
		 */
		if ( $( ".thb-portfolio" ).length ) {
			$( ".thb-portfolio" ).each( function() {
				var portfolio = $( this ),
					useAjax = portfolio.attr( "data-ajax" ) == "1",
					isotopeContainer = $( ".thb-grid-layout", portfolio ),
					filter_controls = $( ".filterlist", portfolio ),
					portfolio_pagination = $( ".thb-navigation", portfolio ),
					thb_portfolio_filtering = false;

				if( ! useAjax ) {
					$( "li", filter_controls ).each(function() {
						var data = $(this).data("filter");

						if( data !== "" ) {
							if( ! isotopeContainer.find("[data-filter-" + data + "]").length ) {
								$(this).remove();
							}
						}
					});
				}

				var portfolio_isotope = new THB_Isotope( isotopeContainer, {
					filter: new THB_Filter(isotopeContainer, {
						controls: filter_controls,
						controlsOnClass: "active",
						filter: function( selector ) {

							if ( ! useAjax ) {
								portfolio_isotope.filter( selector );
							}
						}
					})
				});

				isotopeContainer.data( "thb_isotope", portfolio_isotope );

				window.thb_portfolio_reload = function( url, portfolio, callback ) {
					var portfolio_pagination = $( ".thb-navigation", portfolio ),
						isotopeContainer = $( ".thb-grid-layout", portfolio ),
						index = portfolio.index( $( ".thb-portfolio" ) );

					isotopeContainer.data( "thb_isotope" ).remove(function() {
						$.thb.loadUrl(url, {
							method: "POST",
							filter: false,
							complete: function( data ) {
								var target_portfolio = $(data).find( ".thb-portfolio" ).eq( index );

								NProgress.done();
								var items = target_portfolio.find(".thb-grid-layout .item");

								if( portfolio_pagination.length ) {
									if ( target_portfolio.find(".thb-navigation").length ) {
										portfolio_pagination.replaceWith( target_portfolio.find(".thb-navigation") );
									} else {
										portfolio_pagination.html('');
									}
								}
								else {
									isotopeContainer.after( target_portfolio.find(".thb-navigation") );
								}

								isotopeContainer.data( "thb_isotope" ).insert(items, function() {
									thb_portfolio_bind_pagination( portfolio );

									if( callback !== undefined ) {
										callback();
									}
								});
							}
						});
					});
				};

				window.thb_portfolio_bind_pagination = function( portfolio ) {
					$( ".thb-navigation a", portfolio ).on("click", function() {
						NProgress.configure().start();
						thb_portfolio_reload( $(this).attr("href"), portfolio, function() {
							$( window ).trigger( "resize" );
						} );
						return false;
					});
				};

				window.thb_portfolio_bind_filter = function( portfolio ) {
					var filter_controls = $( ".filterlist", portfolio );

					$( "li", filter_controls ).on("click", function() {
						if( thb_portfolio_filtering ) {
							return false;
						}

						thb_portfolio_filtering = true;

						thb_portfolio_reload( $(this).data("href"), portfolio, function() {
							thb_portfolio_filtering = false;
							$( window ).trigger( "resize" );
						} );

						NProgress.configure().start();

						$( "li", filter_controls ).removeClass("active");
						$(this).addClass("active");
						return false;
					});
				};

				if( useAjax ) {
					thb_portfolio_bind_filter( portfolio );
					thb_portfolio_bind_pagination( portfolio );
				}
			} );
		}

		/**
		 * Slideshow
		 */
		if ( $( '.thb-slideshow, .thb-section, .thb-work-slideshow' ).length ) {
			var rsOptions = {
				loop: true,
				slidesSpacing: 0,
				navigateByClick: false,
				addActiveClass: true,
				imageScaleMode: "fill",
				numImagesToPreload: 1,
				keyboardNavEnabled: true
			};

			window.thb_slide_skin_class = function( slide ) {
				if ( $( '#header' ).hasClass( "scrolled" ) || $( 'body' ).hasClass( 'pageheader-layout-a' ) || $( 'body' ).hasClass( 'pageheader-layout-b' ) ) {
					return;
				}

				$( "#header" ).removeClass( "thb-skin-light thb-skin-dark thb-skin-" );

				if ( slide.hasClass( "thb-skin-light" ) ) {
					$("#header").addClass( "thb-skin-light" );
					window.skin_light_class = true;
					window.skin_dark_class = false;
				}
				else {
					$("#header").addClass( "thb-skin-dark" );
					window.skin_light_class = false;
					window.skin_dark_class = true;
				}
			};

			$( '.thb-slideshow' ).each( function() {

				var thb_slideshow_container = $( this ),
					isMainSlideshow = thb_slideshow_container.hasClass( 'thb-main-slideshow' ),
					hasMultipleSlides = thb_slideshow_container.find( ".slide" ).length > 1,
					hasImages = thb_slideshow_container.find( "img" ).length > 0;

				// Defaults

				if ( isMainSlideshow && window.thb_slideshow ) {
					rsOptions.transitionType = window.thb_slideshow.effect;
				}

				if ( ! hasMultipleSlides ) {
					rsOptions.transitionType = "fade";
					rsOptions.controlNavigation = 'none';
				}

				// Autoplay

				if ( isMainSlideshow && window.thb_slideshow ) {
					window.thb_slide_skin_class( thb_slideshow_container.find( ".slide" ).first() );

					if ( window.thb_slideshow.autoplay && window.thb_slideshow.autoplay == "1" ) {
						rsOptions.autoPlay = {
							enabled: true,
							delay: window.thb_slideshow.speed
						};
					}
				}
				else {
					if ( thb_slideshow_container.hasClass( 'thb-section-slideshow' ) ) {
						rsOptions.keyboardNavEnabled = false;
						rsOptions.transitionType = "fade";
					}
				}

				if ( thb_slideshow_container.hasClass( 'page-content-slideshow' ) ) {
					rsOptions.autoScaleSlider = true;
					rsOptions.autoScaleSliderWidth = 930;
					rsOptions.autoScaleSliderHeight = 523;
				}

				thb_slideshow_container.on( "thbSetupSlide", function( event, thb_slideshow_container, slide ) {
					if ( ! thb_slideshow_container.hasClass( 'page-content-slideshow') ) {
						/**
						 * Skin
						 */
						thb_slide_skin_class( slide );

						if ( $( "body" ).hasClass( "thb-pageheader-parallax" ) && $( "body" ).hasClass( "thb-desktop") ) {
							slide.parallax("50%",-0.6);
						}
					}

					if ( thb_slideshow_container.hasClass('rsFade') ) {
						$(window).trigger('resize');
					}
				} );

				thb_slideshow_container.thbRoyalSliderSlideshow( rsOptions );
				// thb_slideshow_start(thb_slideshow_container, rsOptions);
			} );

			/**
			 * Sections
			 */

			if ( $( "body" ).hasClass( "thb-desktop") ) {
				if ( $( ".thb-section" ).length ) {
					$( ".thb-section-extra[data-parallax='1']" ).each( function() {
						var section = $( this ),
							background_image = section.css( "background-image" ).replace( "url(", "" ).replace( ")", "" );

						if ( background_image == 'none' ) {
							return;
						}

						section.parallax('50%', 0.6);
					} );
				}
			}
		}

		/**
		 * Galleries
		 */
		$(".thb-gallery").each( function() {
			$( this ).royalSlider({
				loopRewind: true,
				slidesSpacing: 0,
				navigateByClick: false,
				imageScaleMode: "fill",
				autoScaleSlider: true,
				autoScaleSliderWidth: 930,
				autoScaleSliderHeight: 523,
				numImagesToPreload: parseInt( $( this ).data( "count" ), 10 )
			});
		} );

		/**
		 * Work slideshow
		 */
		if ( $( '.thb-work-slideshow' ).length ) {
			$( ".thb-work-slideshow" ).each( function() {
				$( this ).thbRoyalSliderSlideshow( {
					autoHeight: true,
					autoScaleSlider: false,
					arrowsNav: true,
					fadeinLoadedSlide: false,
					controlNavigationSpacing: 0,
					imageScaleMode: 'none',
					imageAlignCenter: false,
					controlNavigation: 'none',
					// loop: false,
					loopRewind: true,
					numImagesToPreload: parseInt( $( this ).data( "count" ), 10 ),
					keyboardNavEnabled: true,
					// usePreloader: false,
					loop: false,
					slidesSpacing: 0,
					navigateByClick: false,
					addActiveClass: true,
				} );
			} );
		}

	});


})(jQuery);
