/**
 * Update Customizer settings live.
 *
 * @version 3.3.2
 */

( function( $ ) {

	// Declare vars
	var api               = wp.customize,
		body              = $( 'body' ),
		siteheader        = $( '#site-header' ),
		topBarWrap        = $( '#top-bar-wrap' ),
		navWrap           = $( '#site-navigation-wrap' ),
		visibilityClasses = [
			'hidden-phone',
			'hidden-tablet',
			'hidden-tablet-landscape',
			'hidden-tablet-portrait',
			'hidden-desktop',
			'visible-desktop',
			'visible-phone',
			'visible-tablet',
			'visible-tablet-landscape',
			'visible-tablet-portrait'
		];

	/******** WordPress Core *********/

		// Site title
		api('blogname', function( value ) {
			value.bind( function( newval ) {
				$( '.site-logo-text' ).text( newval );
			});
		});

	/******** General *********/

		api('social_share_heading', function( value ) {
			var heading = $( '.social-share-title span.text' );
			if ( heading.length ) {
				var ogheading = heading.html();
				value.bind( function( newval ) {
					if ( newval ) {
						heading.html( newval );
					} else {
						heading.html( ogheading );
					}
				});
			}
		});

		var $shareWrap = $( '.wpex-social-share-wrap, .wpex-social-share' );
		if ( $shareWrap.length ) {
			api('social_share_position', function( value ) {
				value.bind( function( newval ) {
					newval = newval ? newval : 'horizontal';
					$shareWrap.removeClass( 'position-horizontal position-vertical' );
					$shareWrap.addClass( 'position-'+ newval );
				});
			});
		}

		var $share = $( '.wpex-social-share' );
		if ( $share.length ) {
			api('social_share_style', function( value ) {
				value.bind( function( newval ) {
					$share.removeClass( 'style-rounded style-minimal style-flat style-three-d' );
					$share.addClass( 'style-'+ newval );
				});
			});
		}

		var $arrow = $( '#site-scroll-top > span' );
		if ( $arrow.length ) {
			api('scroll_top_arrow', function( value ) {
				value.bind( function( newval ) {
					$arrow.removeClass();
					$arrow.addClass( 'fa' );
					$arrow.addClass( 'fa-'+ newval );
				});
			});
		}

		var $pagination = $( '.wpex-pagination' );
		if ( $pagination.length ) {
			api('pagination_align', function( value ) {
				value.bind( function( newval ) {
					$pagination.removeClass( 'wpex-center wpex-left wpex-right' );
					$pagination.addClass( 'wpex-'+ newval );
				});
			});
		}

	/******** Layouts *********/	

	api('boxed_dropdshadow', function( value ) {
		value.bind( function( newval ) {
			if ( newval ) {
				body.addClass( 'wrap-boxshadow' );
			} else {
				body.removeClass( 'wrap-boxshadow' );
			}
		});
	});
	
	/******** ToggleBar *********/

		api('toggle_bar_visibility', function( value ) {
			value.bind( function( newval ) {
				var bar = $( '.toggle-bar-btn' );
				if ( bar.length ) {
					$.each( visibilityClasses, function( i, v ) {
						bar.removeClass( v );
					});
					bar.addClass( newval );
				}
			});
		});


	/******** TOPBAR *********/

		if ( topBarWrap.length ) {
			api('top_bar_visibility', function( value ) {
				value.bind( function( newval ) {
					if ( topBarWrap.length ) {
						$.each( visibilityClasses, function( i, v ) {
							topBarWrap.removeClass( v );
						});
						topBarWrap.addClass( newval );
					}
				});
			});

			api('top_bar_fullwidth', function( value ) {
				value.bind( function( newval ) {
					if ( newval ) {
						topBarWrap.addClass( 'wpex-full-width' );
					} else {
						topBarWrap.removeClass( 'wpex-full-width' );
					}
				});
			});
		}

	/******** HEADER *********/

		// Full-width header
		api('full_width_header', function( value ) {
			value.bind( function( newval ) {
				if ( newval && siteheader.length ) {
					siteheader.addClass( 'wpex-full-width' );
				} else {
					siteheader.removeClass( 'wpex-full-width' );
				}
			});
		});

		// Text Logo Icon
		api('logo_icon', function( value ) {
			value.bind( function( newval ) {
				var icon = $( '#site-logo-fa-icon' );
				if ( newval && 'none' !== newval && icon.length ) {
					icon.show();
					icon.removeClass();
					icon.addClass( 'fa' );
					icon.addClass( 'fa-'+ newval );
				} else {
					icon.hide();
				}
			});
		});

		// Header Vertical Style - Fixed or not fixed
		api('vertical_header_style', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					body.addClass( 'wpex-fixed-vertical-header' );
				} else {
					body.removeClass( 'wpex-fixed-vertical-header' );
				}
			});
		});

	/******** NAVBAR *********/

		api('menu_dropdown_style', function( value ) {
			value.bind( function( newval ) {
				var headerClasses = siteheader.attr( 'class' ).split( ' ' );
				for(var i = 0; i < headerClasses.length; i++) {
					if(headerClasses[i].indexOf('wpex-dropdown-style-') != -1) {
						siteheader.removeClass(headerClasses[i]);
					}
				}
				siteheader.addClass( 'wpex-dropdown-style-'+ newval );
			});
		});

		api('menu_dropdown_dropshadow', function( value ) {
			value.bind( function( newval ) {
				var headerClasses = siteheader.attr( 'class' ).split( ' ' );
				for(var i = 0; i < headerClasses.length; i++) {
					if(headerClasses[i].indexOf('wpex-dropdowns-shadow-') != -1) {
						siteheader.removeClass(headerClasses[i]);
					}
				}
				siteheader.addClass( 'wpex-dropdowns-shadow-'+ newval );
			});
		});

	/******** Mobile Menu *********/

		api('mobile_menu_toggle_text', function( value ) {
			value.bind( function( newval ) {
				$( '.mobile-menu-toggle .wpex-text, #wpex-mobile-menu-navbar .wpex-text' ).text( newval );
			});
		});

		api('full_screen_mobile_menu_style', function( value ) {
			value.bind( function( newval ) {
				$( '.full-screen-overlay-nav' ).removeClass( 'white' ).removeClass( 'black' );
				$( '.full-screen-overlay-nav' ).addClass( newval );
			});
		});

	/******** Sidebar *********/
		
		api('has_widget_icons', function( value ) {
			value.bind( function( newval ) {
				if ( newval ) {
					body.addClass( 'sidebar-widget-icons' );
				} else {
					body.removeClass( 'sidebar-widget-icons' );
				}
			});
		});

	/******** Sidebar *********/

		api('sidebar_headings', function( value ) {
			value.bind( function( newval ) {
				var headings = $('.sidebar-box .widget-title');
				headings.each( function() {
					$(this).replaceWith( '<' + newval +' class="widget-title">' + this.innerHTML + '</' + newval +'>' );
				});
			});
		});

	/******** Blog *********/

		api('blog_single_header_custom_text', function( value ) {
			var title = $( 'body.single-post .page-header-title' );
			if ( title.length ) {
				var ogTitle = title.html();
				value.bind( function( newval ) {
					if ( newval ) {
						title.html( newval );
					} else {
						title.html( ogTitle );
					}
				});
			}
		});

		api('blog_related_title', function( value ) {
			var heading = $( '.related-posts-title span.text' );
			if ( heading.length ) {
				var ogheading = heading.html();
				value.bind( function( newval ) {
					if ( newval ) {
						heading.html( newval );
					} else {
						heading.html( ogheading );
					}
				});
			}
		});

	/******** Portfolio *********/

		api('portfolio_related_title', function( value ) {
			var heading = $( '.related-portfolio-posts-heading span.text' );
			if ( heading.length ) {
				var ogheading = heading.html();
				value.bind( function( newval ) {
					if ( newval ) {
						heading.html( newval );
					} else {
						heading.html( ogheading );
					}
				});
			}
		});

	/******** Staff *********/

		api('staff_related_title', function( value ) {
			var heading = $( '.related-staff-posts-heading span.text' );
			if ( heading.length ) {
				var ogheading = heading.html();
				value.bind( function( newval ) {
					if ( newval ) {
						heading.html( newval );
					} else {
						heading.html( ogheading );
					}
				});
			}
		});

	/******** Footer *********/

		api('footer_headings', function( value ) {
			value.bind( function( newval ) {
				var headings = $('.footer-widget .widget-title');
				headings.each( function() {
					$(this).replaceWith( '<' + newval +' class="widget-title">' + this.innerHTML + '</' + newval +'>' );
				});
			});
		});

	/******** Callout *********/

		api('callout_text', function( value ) {
			value.bind( function( newval ) {
				$( '.footer-callout-content' ).html( newval );
			});
		});

		api('callout_link_txt', function( value ) {
			value.bind( function( newval ) {
				$( '.footer-callout-button a' ).text( newval );
			});
		});

		api('callout_visibility', function( value ) {
			value.bind( function( newval ) {
				var callout = $( '#footer-callout-wrap' );
				if ( callout.length ) {
					$.each( visibilityClasses, function( i, v ) {
						callout.removeClass( v );
					});
					callout.addClass( newval );
				}
			});
		});


	/******** Footer *********/

		api('footer_copyright_text', function( value ) {
			value.bind( function( newval ) {
				$( '#copyright' ).html( newval );
			});
		});

		api('footer_widgets_gap', function( value ) {
			var widgets = $( '#footer-widgets' );
			value.bind( function( newval ) {
				var classes = widgets.attr("class").split(' ');
				if ( classes ) {
					$.each(classes, function(i, c) {
						if (c.indexOf("gap-") == 0) {
							widgets.removeClass(c);
						}
					});
				}
				if ( newval ) {
					widgets.addClass( 'gap-'+ newval );
				}
			});
		});
		
	/******** STYLING OPTIONS LOOP <=> Generated by a Ninja *********/
	api("breadcrumbs_text_color",function(e){e.bind(function(e){var o=$(".customizer-breadcrumbs_text_color");if(e){var t='<style class="customizer-breadcrumbs_text_color">.site-breadcrumbs { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("breadcrumbs_seperator_color",function(e){e.bind(function(e){var o=$(".customizer-breadcrumbs_seperator_color");if(e){var t='<style class="customizer-breadcrumbs_seperator_color">.site-breadcrumbs .sep { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("breadcrumbs_link_color",function(e){e.bind(function(e){var o=$(".customizer-breadcrumbs_link_color");if(e){var t='<style class="customizer-breadcrumbs_link_color">.site-breadcrumbs a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("breadcrumbs_link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-breadcrumbs_link_color_hover");if(e){var t='<style class="customizer-breadcrumbs_link_color_hover">.site-breadcrumbs a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("page_header_top_padding",function(e){e.bind(function(e){var o=$(".customizer-page_header_top_padding");if(e){var t='<style class="customizer-page_header_top_padding">.page-header.wpex-supports-mods { padding-top: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("page_header_bottom_padding",function(e){e.bind(function(e){var o=$(".customizer-page_header_bottom_padding");if(e){var t='<style class="customizer-page_header_bottom_padding">.page-header.wpex-supports-mods { padding-bottom: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("page_header_bottom_margin",function(e){e.bind(function(e){var o=$(".customizer-page_header_bottom_margin");if(e){var t='<style class="customizer-page_header_bottom_margin">.page-header { margin-bottom: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("page_header_background",function(e){e.bind(function(e){var o=$(".customizer-page_header_background");if(e){var t='<style class="customizer-page_header_background">.page-header.wpex-supports-mods { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("page_header_title_color",function(e){e.bind(function(e){var o=$(".customizer-page_header_title_color");if(e){var t='<style class="customizer-page_header_title_color">.page-header.wpex-supports-mods .page-header-title { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("page_header_top_border",function(e){e.bind(function(e){var o=$(".customizer-page_header_top_border");if(e){var t='<style class="customizer-page_header_top_border">.page-header.wpex-supports-mods { border-top-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("page_header_bottom_border",function(e){e.bind(function(e){var o=$(".customizer-page_header_bottom_border");if(e){var t='<style class="customizer-page_header_bottom_border">.page-header.wpex-supports-mods { border-bottom-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_size",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_size");if(e){var t='<style class="customizer-scroll_top_size">#site-scroll-top { width: '+e+";height: "+e+";line-height: "+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_icon_size",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_icon_size");if(e){var t='<style class="customizer-scroll_top_icon_size">#site-scroll-top { font-size: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_border_radius",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_border_radius");if(e){var t='<style class="customizer-scroll_top_border_radius">#site-scroll-top { border-radius: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_color",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_color");if(e){var t='<style class="customizer-scroll_top_color">#site-scroll-top { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_color_hover",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_color_hover");if(e){var t='<style class="customizer-scroll_top_color_hover">#site-scroll-top:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_bg",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_bg");if(e){var t='<style class="customizer-scroll_top_bg">#site-scroll-top { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_bg_hover",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_bg_hover");if(e){var t='<style class="customizer-scroll_top_bg_hover">#site-scroll-top:hover { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_border",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_border");if(e){var t='<style class="customizer-scroll_top_border">#site-scroll-top { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("scroll_top_border_hover",function(e){e.bind(function(e){var o=$(".customizer-scroll_top_border_hover");if(e){var t='<style class="customizer-scroll_top_border_hover">#site-scroll-top:hover { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("pagination_font_size",function(e){e.bind(function(e){var o=$(".customizer-pagination_font_size");if(e){var t='<style class="customizer-pagination_font_size">ul.page-numbers, .page-links { font-size: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("pagination_border_width",function(e){e.bind(function(e){var o=$(".customizer-pagination_border_width");if(e){var t='<style class="customizer-pagination_border_width">ul .page-numbers a, a.page-numbers, span.page-numbers, .page-links span, .page-links a > span { border-width: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("pagination_border_color",function(e){e.bind(function(e){var o=$(".customizer-pagination_border_color");if(e){var t='<style class="customizer-pagination_border_color">ul .page-numbers a, a.page-numbers, span.page-numbers, .page-links span, .page-links a > span { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("pagination_border_hover_color",function(e){e.bind(function(e){var o=$(".customizer-pagination_border_hover_color");if(e){var t='<style class="customizer-pagination_border_hover_color">.page-numbers a:hover, .page-numbers.current, .page-numbers.current:hover, .page-links span, .page-links a > span:hover { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("pagination_color",function(e){e.bind(function(e){var o=$(".customizer-pagination_color");if(e){var t='<style class="customizer-pagination_color">ul .page-numbers a, a.page-numbers, span.page-numbers, .page-links span, .page-links a > span { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("pagination_hover_color",function(e){e.bind(function(e){var o=$(".customizer-pagination_hover_color");if(e){var t='<style class="customizer-pagination_hover_color">.page-numbers a:hover, .page-numbers.current, .page-numbers.current:hover, .page-links span, .page-links a > span:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("pagination_bg",function(e){e.bind(function(e){var o=$(".customizer-pagination_bg");if(e){var t='<style class="customizer-pagination_bg">ul .page-numbers a, a.page-numbers, span.page-numbers, .page-links span, .page-links a > span { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("pagination_hover_bg",function(e){e.bind(function(e){var o=$(".customizer-pagination_hover_bg");if(e){var t='<style class="customizer-pagination_hover_bg">.page-numbers a:hover, .page-numbers.current, .page-numbers.current:hover, .page-links span, .page-links a > span:hover { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("label_color",function(e){e.bind(function(e){var o=$(".customizer-label_color");if(e){var t='<style class="customizer-label_color">label { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("input_padding",function(e){e.bind(function(e){var o=$(".customizer-input_padding");if(e){var t='<style class="customizer-input_padding">.site-content input[type="text"],.site-content input[type="password"],.site-content input[type="email"],.site-content input[type="tel"],.site-content input[type="url"],.site-content input[type="search"],.site-content textarea { padding: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("input_border_radius",function(e){e.bind(function(e){var o=$(".customizer-input_border_radius");if(e){var t='<style class="customizer-input_border_radius">.site-content input[type="text"],.site-content input[type="password"],.site-content input[type="email"],.site-content input[type="tel"],.site-content input[type="url"],.site-content input[type="search"],.site-content textarea { border-radius: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("input_font_size",function(e){e.bind(function(e){var o=$(".customizer-input_font_size");if(e){var t='<style class="customizer-input_font_size">.site-content input[type="text"],.site-content input[type="password"],.site-content input[type="email"],.site-content input[type="tel"],.site-content input[type="url"],.site-content input[type="search"],.site-content textarea { font-size: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("input_background",function(e){e.bind(function(e){var o=$(".customizer-input_background");if(e){var t='<style class="customizer-input_background">.site-content input[type="text"],.site-content input[type="password"],.site-content input[type="email"],.site-content input[type="tel"],.site-content input[type="url"],.site-content input[type="search"],.site-content textarea { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("input_border",function(e){e.bind(function(e){var o=$(".customizer-input_border");if(e){var t='<style class="customizer-input_border">.site-content input[type="text"],.site-content input[type="password"],.site-content input[type="email"],.site-content input[type="tel"],.site-content input[type="url"],.site-content input[type="search"],.site-content textarea { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("input_border_width",function(e){e.bind(function(e){var o=$(".customizer-input_border_width");if(e){var t='<style class="customizer-input_border_width">.site-content input[type="text"],.site-content input[type="password"],.site-content input[type="email"],.site-content input[type="tel"],.site-content input[type="url"],.site-content input[type="search"],.site-content textarea { border-width: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("input_color",function(e){e.bind(function(e){var o=$(".customizer-input_color");if(e){var t='<style class="customizer-input_color">.site-content input[type="text"],.site-content input[type="password"],.site-content input[type="email"],.site-content input[type="tel"],.site-content input[type="url"],.site-content input[type="search"],.site-content textarea { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("link_color",function(e){e.bind(function(e){var o=$(".customizer-link_color");if(e){var t='<style class="customizer-link_color">a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .entry-title a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-link_color_hover");if(e){var t='<style class="customizer-link_color_hover">a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("theme_button_padding",function(e){e.bind(function(e){var o=$(".customizer-theme_button_padding");if(e){var t='<style class="customizer-theme_button_padding">.theme-button,input[type="submit"],button { padding: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("theme_button_border_radius",function(e){e.bind(function(e){var o=$(".customizer-theme_button_border_radius");if(e){var t='<style class="customizer-theme_button_border_radius">.theme-button,input[type="submit"],button { border-radius: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("theme_button_color",function(e){e.bind(function(e){var o=$(".customizer-theme_button_color");if(e){var t='<style class="customizer-theme_button_color">.theme-button,input[type="submit"],button,.navbar-style-one .menu-button > a > span.link-inner:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("theme_button_hover_color",function(e){e.bind(function(e){var o=$(".customizer-theme_button_hover_color");if(e){var t='<style class="customizer-theme_button_hover_color">.theme-button:hover,input[type="submit"]:hover,button:hover,.navbar-style-one .menu-button > a > span.link-inner:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("theme_button_bg",function(e){e.bind(function(e){var o=$(".customizer-theme_button_bg");if(e){var t='<style class="customizer-theme_button_bg">.theme-button,input[type="submit"],button,.navbar-style-one .menu-button > a > span.link-inner:hover { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("theme_button_hover_bg",function(e){e.bind(function(e){var o=$(".customizer-theme_button_hover_bg");if(e){var t='<style class="customizer-theme_button_hover_bg">.theme-button:hover,input[type="submit"]:hover,button:hover,.navbar-style-one .menu-button > a > span.link-inner:hover { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("container_max_width",function(e){e.bind(function(e){var o=$(".customizer-container_max_width");if(e){var t='<style class="customizer-container_max_width">body.wpex-responsive .container, body.wpex-responsive .vc_row-fluid.container { max-width: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("boxed_padding",function(e){e.bind(function(e){var o=$(".customizer-boxed_padding");if(e){var t='<style class="customizer-boxed_padding">.boxed-main-layout #outer-wrap { padding: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("boxed_wrap_bg",function(e){e.bind(function(e){var o=$(".customizer-boxed_wrap_bg");if(e){var t='<style class="customizer-boxed_wrap_bg">.boxed-main-layout #wrap,.is-sticky #site-header { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("main_container_width",function(e){e.bind(function(e){var o=$(".customizer-main_container_width");if(e){var t='<style class="customizer-main_container_width">.full-width-main-layout .container, .full-width-main-layout .vc_row-fluid.container, .boxed-main-layout #wrap { width: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("left_container_width",function(e){e.bind(function(e){var o=$(".customizer-left_container_width");if(e){var t='<style class="customizer-left_container_width">@media only screen and (min-width: 960px){ .content-area { width: '+e+";max-width: "+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("sidebar_width",function(e){e.bind(function(e){var o=$(".customizer-sidebar_width");if(e){var t='<style class="customizer-sidebar_width">@media only screen and (min-width: 960px){ #sidebar { width: '+e+";max-width: "+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("tablet_landscape_main_container_width",function(e){e.bind(function(e){var o=$(".customizer-tablet_landscape_main_container_width");if(e){var t='<style class="customizer-tablet_landscape_main_container_width">@media only screen and (min-width: 960px) and (max-width: 1280px){ .full-width-main-layout .container, .full-width-main-layout .vc_row-fluid.container, .boxed-main-layout #wrap { width: '+e+";max-width: "+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("tablet_landscape_left_container_width",function(e){e.bind(function(e){var o=$(".customizer-tablet_landscape_left_container_width");if(e){var t='<style class="customizer-tablet_landscape_left_container_width">@media only screen and (min-width: 960px) and (max-width: 1280px){ .content-area { width: '+e+";max-width: "+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("tablet_landscape_sidebar_width",function(e){e.bind(function(e){var o=$(".customizer-tablet_landscape_sidebar_width");if(e){var t='<style class="customizer-tablet_landscape_sidebar_width">@media only screen and (min-width: 960px) and (max-width: 1280px){ #sidebar { width: '+e+";max-width: "+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("tablet_main_container_width",function(e){e.bind(function(e){var o=$(".customizer-tablet_main_container_width");if(e){var t='<style class="customizer-tablet_main_container_width">@media only screen and (min-width: 768px) and (max-width: 959px){ .full-width-main-layout .container, .full-width-main-layout .vc_row-fluid.container, .boxed-main-layout #wrap { width: '+e+"!important;max-width: "+e+"!important; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("tablet_left_container_width",function(e){e.bind(function(e){var o=$(".customizer-tablet_left_container_width");if(e){var t='<style class="customizer-tablet_left_container_width">@media only screen and (min-width: 768px) and (max-width: 959px){ .content-area { width: '+e+";max-width: "+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("tablet_sidebar_width",function(e){e.bind(function(e){var o=$(".customizer-tablet_sidebar_width");if(e){var t='<style class="customizer-tablet_sidebar_width">@media only screen and (min-width: 768px) and (max-width: 959px){ #sidebar { width: '+e+";max-width: "+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_portrait_main_container_width",function(e){e.bind(function(e){var o=$(".customizer-mobile_portrait_main_container_width");if(e){var t='<style class="customizer-mobile_portrait_main_container_width">@media only screen and (max-width: 767px){ .container { width: '+e+"!important;max-width: "+e+"!important; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_landscape_main_container_width",function(e){e.bind(function(e){var o=$(".customizer-mobile_landscape_main_container_width");if(e){var t='<style class="customizer-mobile_landscape_main_container_width">@media only screen and (min-width: 480px) and (max-width: 767px){ .container { width: '+e+"!important;max-width: "+e+"!important; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_bar_bg",function(e){e.bind(function(e){var o=$(".customizer-toggle_bar_bg");if(e){var t='<style class="customizer-toggle_bar_bg">#toggle-bar-wrap { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_bar_border",function(e){e.bind(function(e){var o=$(".customizer-toggle_bar_border");if(e){var t='<style class="customizer-toggle_bar_border">#toggle-bar-wrap { border-color: '+e+"!important; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_bar_color",function(e){e.bind(function(e){var o=$(".customizer-toggle_bar_color");if(e){var t='<style class="customizer-toggle_bar_color">#toggle-bar-wrap,#toggle-bar-wrap strong { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_bar_btn_bg",function(e){e.bind(function(e){var o=$(".customizer-toggle_bar_btn_bg");if(e){var t='<style class="customizer-toggle_bar_btn_bg">.toggle-bar-btn { border-top-color: '+e+";border-right-color: "+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_bar_btn_color",function(e){e.bind(function(e){var o=$(".customizer-toggle_bar_btn_color");if(e){var t='<style class="customizer-toggle_bar_btn_color">.toggle-bar-btn span.fa { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_bar_btn_hover_bg",function(e){e.bind(function(e){var o=$(".customizer-toggle_bar_btn_hover_bg");if(e){var t='<style class="customizer-toggle_bar_btn_hover_bg">.toggle-bar-btn:hover { border-top-color: '+e+";border-right-color: "+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_bar_btn_hover_color",function(e){e.bind(function(e){var o=$(".customizer-toggle_bar_btn_hover_color");if(e){var t='<style class="customizer-toggle_bar_btn_hover_color">.toggle-bar-btn:hover span.fa { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_bg",function(e){e.bind(function(e){var o=$(".customizer-top_bar_bg");if(e){var t='<style class="customizer-top_bar_bg">#top-bar-wrap,.wpex-top-bar-sticky { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_border",function(e){e.bind(function(e){var o=$(".customizer-top_bar_border");if(e){var t='<style class="customizer-top_bar_border">#top-bar-wrap { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_text",function(e){e.bind(function(e){var o=$(".customizer-top_bar_text");if(e){var t='<style class="customizer-top_bar_text">#top-bar-wrap,#top-bar-content strong { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_link_color",function(e){e.bind(function(e){var o=$(".customizer-top_bar_link_color");if(e){var t='<style class="customizer-top_bar_link_color">#top-bar-content a,#top-bar-social-alt a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-top_bar_link_color_hover");if(e){var t='<style class="customizer-top_bar_link_color_hover">#top-bar-content a:hover,#top-bar-social-alt a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_top_padding",function(e){e.bind(function(e){var o=$(".customizer-top_bar_top_padding");if(e){var t='<style class="customizer-top_bar_top_padding">#top-bar { padding-top: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_bottom_padding",function(e){e.bind(function(e){var o=$(".customizer-top_bar_bottom_padding");if(e){var t='<style class="customizer-top_bar_bottom_padding">#top-bar { padding-bottom: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_social_color",function(e){e.bind(function(e){var o=$(".customizer-top_bar_social_color");if(e){var t='<style class="customizer-top_bar_social_color">#top-bar-social a.wpex-social-btn-no-style { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("top_bar_social_hover_color",function(e){e.bind(function(e){var o=$(".customizer-top_bar_social_hover_color");if(e){var t='<style class="customizer-top_bar_social_hover_color">#top-bar-social a.wpex-social-btn-no-style:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("header_background",function(e){e.bind(function(e){var o=$(".customizer-header_background");if(e){var t='<style class="customizer-header_background">#site-header,#site-header-sticky-wrapper.is-sticky #site-header,.footer-has-reveal #site-header,#searchform-header-replace,body.wpex-has-vertical-header #site-header { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("header_top_padding",function(e){e.bind(function(e){var o=$(".customizer-header_top_padding");if(e){var t='<style class="customizer-header_top_padding">#site-header-inner,#site-header.overlay-header #site-header-inner { padding-top: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("header_bottom_padding",function(e){e.bind(function(e){var o=$(".customizer-header_bottom_padding");if(e){var t='<style class="customizer-header_bottom_padding">#site-header-inner,#site-header.overlay-header #site-header-inner { padding-bottom: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_top_margin",function(e){e.bind(function(e){var o=$(".customizer-logo_top_margin");if(e){var t='<style class="customizer-logo_top_margin">#site-logo { padding-top: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_bottom_margin",function(e){e.bind(function(e){var o=$(".customizer-logo_bottom_margin");if(e){var t='<style class="customizer-logo_bottom_margin">#site-logo { padding-bottom: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_color",function(e){e.bind(function(e){var o=$(".customizer-logo_color");if(e){var t='<style class="customizer-logo_color">#site-logo a.site-logo-text { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_hover_color",function(e){e.bind(function(e){var o=$(".customizer-logo_hover_color");if(e){var t='<style class="customizer-logo_hover_color">#site-logo a.site-logo-text:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_max_width",function(e){e.bind(function(e){var o=$(".customizer-logo_max_width");if(e){var t='<style class="customizer-logo_max_width">@media only screen and (min-width: 960px){ #site-logo img { max-width: '+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_max_width_tablet_portrait",function(e){e.bind(function(e){var o=$(".customizer-logo_max_width_tablet_portrait");if(e){var t='<style class="customizer-logo_max_width_tablet_portrait">@media only screen and (min-width: 768px) and (max-width: 959px){ #site-logo img { max-width: '+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_max_width_phone",function(e){e.bind(function(e){var o=$(".customizer-logo_max_width_phone");if(e){var t='<style class="customizer-logo_max_width_phone">@media only screen and (max-width: 767px){ #site-logo img { max-width: '+e+"; } }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_icon_color",function(e){e.bind(function(e){var o=$(".customizer-logo_icon_color");if(e){var t='<style class="customizer-logo_icon_color">#site-logo-fa-icon { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("logo_icon_right_margin",function(e){e.bind(function(e){var o=$(".customizer-logo_icon_right_margin");if(e){var t='<style class="customizer-logo_icon_right_margin">#site-logo-fa-icon { margin-right: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("fixed_header_opacity",function(e){e.bind(function(e){var o=$(".customizer-fixed_header_opacity");if(e){var t='<style class="customizer-fixed_header_opacity">.wpex-sticky-header-holder.is-sticky #site-header { opacity: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("search_dropdown_top_border",function(e){e.bind(function(e){var o=$(".customizer-search_dropdown_top_border");if(e){var t='<style class="customizer-search_dropdown_top_border">#searchform-dropdown { border-top-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_background",function(e){e.bind(function(e){var o=$(".customizer-menu_background");if(e){var t='<style class="customizer-menu_background">#site-navigation-wrap,#site-navigation-sticky-wrapper.is-sticky #site-navigation-wrap { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_borders",function(e){e.bind(function(e){var o=$(".customizer-menu_borders");if(e){var t='<style class="customizer-menu_borders">#site-navigation li,#site-navigation a,#site-navigation ul,#site-navigation-wrap,#site-navigation,.navbar-style-six #site-navigation,#site-navigation-sticky-wrapper.is-sticky #site-navigation-wrap { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_link_color",function(e){e.bind(function(e){var o=$(".customizer-menu_link_color");if(e){var t='<style class="customizer-menu_link_color">#site-navigation .dropdown-menu > li > a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-menu_link_color_hover");if(e){var t='<style class="customizer-menu_link_color_hover">#site-navigation .dropdown-menu > li > a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_link_color_active",function(e){e.bind(function(e){var o=$(".customizer-menu_link_color_active");if(e){var t='<style class="customizer-menu_link_color_active">#site-navigation .dropdown-menu > .current-menu-item > a,\n							#site-navigation .dropdown-menu > .current-menu-parent > a,\n							#site-navigation .dropdown-menu > .current-menu-item > a:hover,\n							#site-navigation .dropdown-menu > .current-menu-parent > a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_link_background",function(e){e.bind(function(e){var o=$(".customizer-menu_link_background");if(e){var t='<style class="customizer-menu_link_background">#site-navigation .dropdown-menu > li > a { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_link_hover_background",function(e){e.bind(function(e){var o=$(".customizer-menu_link_hover_background");if(e){var t='<style class="customizer-menu_link_hover_background">#site-navigation .dropdown-menu > li > a:hover { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_link_active_background",function(e){e.bind(function(e){var o=$(".customizer-menu_link_active_background");if(e){var t='<style class="customizer-menu_link_active_background">#site-navigation .dropdown-menu > .current-menu-item > a,\n							#site-navigation .dropdown-menu > .current-menu-parent > a,\n							#site-navigation .dropdown-menu > .current-menu-item > a:hover,\n							#site-navigation .dropdown-menu > .current-menu-parent > a:hover { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t);
}else o.remove()})}),api("menu_link_span_background",function(e){e.bind(function(e){var o=$(".customizer-menu_link_span_background");if(e){var t='<style class="customizer-menu_link_span_background">#site-navigation .dropdown-menu > li > a > span.link-inner { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_link_span_hover_background",function(e){e.bind(function(e){var o=$(".customizer-menu_link_span_hover_background");if(e){var t='<style class="customizer-menu_link_span_hover_background">#site-navigation .dropdown-menu > li > a:hover > span.link-inner { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_link_span_active_background",function(e){e.bind(function(e){var o=$(".customizer-menu_link_span_active_background");if(e){var t='<style class="customizer-menu_link_span_active_background">#site-navigation .dropdown-menu > .current-menu-item > a > span.link-inner,\n							#site-navigation .dropdown-menu > .current-menu-parent > a > span.link-inner,\n							#site-navigation .dropdown-menu > .current-menu-item > a:hover > span.link-inner,\n							#site-navigation .dropdown-menu > .current-menu-parent > a:hover > span.link-inner { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_background",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_background");if(e){var t='<style class="customizer-dropdown_menu_background">#site-header #site-navigation .dropdown-menu ul { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_pointer_bg",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_pointer_bg");if(e){var t='<style class="customizer-dropdown_menu_pointer_bg">.wpex-dropdowns-caret .dropdown-menu ul:after { border-bottom-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_pointer_border",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_pointer_border");if(e){var t='<style class="customizer-dropdown_menu_pointer_border">.wpex-dropdowns-caret .dropdown-menu ul:before { border-bottom-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_borders",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_borders");if(e){var t='<style class="customizer-dropdown_menu_borders">#site-header #site-navigation .dropdown-menu ul,#site-header #site-navigation .dropdown-menu ul li,#site-header #site-navigation .dropdown-menu ul li a { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("menu_dropdown_top_border_color",function(e){e.bind(function(e){var o=$(".customizer-menu_dropdown_top_border_color");if(e){var t='<style class="customizer-menu_dropdown_top_border_color">.wpex-dropdown-top-border #site-navigation .dropdown-menu li ul,#searchform-dropdown,#current-shop-items-dropdown { border-top-color: '+e+"!important; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_link_color",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_link_color");if(e){var t='<style class="customizer-dropdown_menu_link_color">#site-header #site-navigation .dropdown-menu ul > li > a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_link_color_hover");if(e){var t='<style class="customizer-dropdown_menu_link_color_hover">#site-header #site-navigation .dropdown-menu ul > li > a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_link_hover_bg",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_link_hover_bg");if(e){var t='<style class="customizer-dropdown_menu_link_hover_bg">#site-header #site-navigation .dropdown-menu ul > li > a:hover { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_link_color_active",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_link_color_active");if(e){var t='<style class="customizer-dropdown_menu_link_color_active">#site-header #site-navigation .dropdown-menu ul > .current-menu-item > a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("dropdown_menu_link_bg_active",function(e){e.bind(function(e){var o=$(".customizer-dropdown_menu_link_bg_active");if(e){var t='<style class="customizer-dropdown_menu_link_bg_active">#site-header #site-navigation .dropdown-menu ul > .current-menu-item > a { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mega_menu_title",function(e){e.bind(function(e){var o=$(".customizer-mega_menu_title");if(e){var t='<style class="customizer-mega_menu_title">#site-header #site-navigation .sf-menu > li.megamenu > ul.sub-menu > .menu-item-has-children > a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_toggle_fixed_top_bg",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_toggle_fixed_top_bg");if(e){var t='<style class="customizer-mobile_menu_toggle_fixed_top_bg">#wpex-mobile-menu-fixed-top, #wpex-mobile-menu-navbar { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_icon_size",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_icon_size");if(e){var t='<style class="customizer-mobile_menu_icon_size">#mobile-menu a { font-size: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_icon_color",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_icon_color");if(e){var t='<style class="customizer-mobile_menu_icon_color">#mobile-menu a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_icon_color_hover",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_icon_color_hover");if(e){var t='<style class="customizer-mobile_menu_icon_color_hover">#mobile-menu a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_icon_background",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_icon_background");if(e){var t='<style class="customizer-mobile_menu_icon_background">#mobile-menu a { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_icon_background_hover",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_icon_background_hover");if(e){var t='<style class="customizer-mobile_menu_icon_background_hover">#mobile-menu a:hover { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_icon_border",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_icon_border");if(e){var t='<style class="customizer-mobile_menu_icon_border">#mobile-menu a { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_icon_border_hover",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_icon_border_hover");if(e){var t='<style class="customizer-mobile_menu_icon_border_hover">#mobile-menu a:hover { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_sidr_background",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_sidr_background");if(e){var t='<style class="customizer-mobile_menu_sidr_background">#sidr-main { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_sidr_borders",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_sidr_borders");if(e){var t='<style class="customizer-mobile_menu_sidr_borders">#sidr-main li, #sidr-main ul { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_links",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_links");if(e){var t='<style class="customizer-mobile_menu_links">.sidr a, .sidr-class-dropdown-toggle { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_links_hover",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_links_hover");if(e){var t='<style class="customizer-mobile_menu_links_hover">.sidr a:hover, .sidr-class-dropdown-toggle:hover, .sidr-class-dropdown-toggle .fa, .sidr-class-menu-item-has-children.active > a, .sidr-class-menu-item-has-children.active > a > .sidr-class-dropdown-toggle { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_sidr_search_color",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_sidr_search_color");if(e){var t='<style class="customizer-mobile_menu_sidr_search_color">.sidr-class-mobile-menu-searchform input,.sidr-class-mobile-menu-searchform input:focus,.sidr-class-mobile-menu-searchform button { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("mobile_menu_sidr_search_bg",function(e){e.bind(function(e){var o=$(".customizer-mobile_menu_sidr_search_bg");if(e){var t='<style class="customizer-mobile_menu_sidr_search_bg">.sidr-class-mobile-menu-searchform input { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_mobile_menu_background",function(e){e.bind(function(e){var o=$(".customizer-toggle_mobile_menu_background");if(e){var t='<style class="customizer-toggle_mobile_menu_background">.mobile-toggle-nav,.wpex-mobile-toggle-menu-fixed_top .mobile-toggle-nav { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_mobile_menu_borders",function(e){e.bind(function(e){var o=$(".customizer-toggle_mobile_menu_borders");if(e){var t='<style class="customizer-toggle_mobile_menu_borders">.mobile-toggle-nav a,.wpex-mobile-toggle-menu-fixed_top .mobile-toggle-nav a { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_mobile_menu_links",function(e){e.bind(function(e){var o=$(".customizer-toggle_mobile_menu_links");if(e){var t='<style class="customizer-toggle_mobile_menu_links">.mobile-toggle-nav a,.wpex-mobile-toggle-menu-fixed_top .mobile-toggle-nav a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("toggle_mobile_menu_links_hover",function(e){e.bind(function(e){var o=$(".customizer-toggle_mobile_menu_links_hover");if(e){var t='<style class="customizer-toggle_mobile_menu_links_hover">.mobile-toggle-nav a:hover,.wpex-mobile-toggle-menu-fixed_top .mobile-toggle-nav a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("sidebar_background",function(e){e.bind(function(e){var o=$(".customizer-sidebar_background");if(e){var t='<style class="customizer-sidebar_background">#sidebar { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("sidebar_padding",function(e){e.bind(function(e){var o=$(".customizer-sidebar_padding");if(e){var t='<style class="customizer-sidebar_padding">#sidebar { padding: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("sidebar_text_color",function(e){e.bind(function(e){var o=$(".customizer-sidebar_text_color");if(e){var t='<style class="customizer-sidebar_text_color">#sidebar,#sidebar p,.widget-recent-posts-icons li .fa { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("sidebar_borders_color",function(e){e.bind(function(e){var o=$(".customizer-sidebar_borders_color");if(e){var t='<style class="customizer-sidebar_borders_color">#sidebar li,#sidebar #wp-calendar thead th,#sidebar #wp-calendar tbody td { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("sidebar_link_color",function(e){e.bind(function(e){var o=$(".customizer-sidebar_link_color");if(e){var t='<style class="customizer-sidebar_link_color">#sidebar a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("sidebar_link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-sidebar_link_color_hover");if(e){var t='<style class="customizer-sidebar_link_color_hover">#sidebar a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("testimonial_entry_bg",function(e){e.bind(function(e){var o=$(".customizer-testimonial_entry_bg");if(e){var t='<style class="customizer-testimonial_entry_bg">.testimonial-entry-content { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("testimonial_entry_pointer_bg",function(e){e.bind(function(e){var o=$(".customizer-testimonial_entry_pointer_bg");if(e){var t='<style class="customizer-testimonial_entry_pointer_bg">.testimonial-caret { border-top-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("testimonial_entry_color",function(e){e.bind(function(e){var o=$(".customizer-testimonial_entry_color");if(e){var t='<style class="customizer-testimonial_entry_color">.testimonial-entry-content,.testimonial-entry-content a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("callout_top_padding",function(e){e.bind(function(e){var o=$(".customizer-callout_top_padding");if(e){var t='<style class="customizer-callout_top_padding">#footer-callout-wrap { padding-top: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("callout_bottom_padding",function(e){e.bind(function(e){var o=$(".customizer-callout_bottom_padding");if(e){var t='<style class="customizer-callout_bottom_padding">#footer-callout-wrap { padding-bottom: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_bg",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_bg");if(e){var t='<style class="customizer-footer_callout_bg">#footer-callout-wrap { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_border",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_border");if(e){var t='<style class="customizer-footer_callout_border">#footer-callout-wrap { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_color",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_color");if(e){var t='<style class="customizer-footer_callout_color">#footer-callout-wrap { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_link_color",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_link_color");if(e){var t='<style class="customizer-footer_callout_link_color">.footer-callout-content a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_link_color_hover");if(e){var t='<style class="customizer-footer_callout_link_color_hover">.footer-callout-content a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("callout_button_border_radius",function(e){e.bind(function(e){var o=$(".customizer-callout_button_border_radius");if(e){var t='<style class="customizer-callout_button_border_radius">#footer-callout .theme-button { border-radius: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_button_bg",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_button_bg");if(e){var t='<style class="customizer-footer_callout_button_bg">#footer-callout .theme-button { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_button_color",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_button_color");if(e){var t='<style class="customizer-footer_callout_button_color">#footer-callout .theme-button { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_button_hover_bg",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_button_hover_bg");if(e){var t='<style class="customizer-footer_callout_button_hover_bg">#footer-callout .theme-button:hover { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_callout_button_hover_color",function(e){e.bind(function(e){var o=$(".customizer-footer_callout_button_hover_color");if(e){var t='<style class="customizer-footer_callout_button_hover_color">#footer-callout .theme-button:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_padding",function(e){e.bind(function(e){var o=$(".customizer-footer_padding");if(e){var t='<style class="customizer-footer_padding">#footer-inner { padding: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_background",function(e){e.bind(function(e){var o=$(".customizer-footer_background");if(e){var t='<style class="customizer-footer_background">#footer { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_color",function(e){e.bind(function(e){var o=$(".customizer-footer_color");if(e){var t='<style class="customizer-footer_color">#footer,#footer p,#footer li a:before,.site-footer .widget-recent-posts-icons li .fa { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_borders",function(e){e.bind(function(e){var o=$(".customizer-footer_borders");if(e){var t='<style class="customizer-footer_borders">#footer li,#footer #wp-calendar thead th,#footer #wp-calendar tbody td { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_link_color",function(e){e.bind(function(e){var o=$(".customizer-footer_link_color");if(e){var t='<style class="customizer-footer_link_color">#footer a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("footer_link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-footer_link_color_hover");if(e){var t='<style class="customizer-footer_link_color_hover">#footer a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("bottom_footer_text_align",function(e){e.bind(function(e){var o=$(".customizer-bottom_footer_text_align");if(e){var t='<style class="customizer-bottom_footer_text_align">#footer-bottom { text-align: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("bottom_footer_padding",function(e){e.bind(function(e){var o=$(".customizer-bottom_footer_padding");if(e){var t='<style class="customizer-bottom_footer_padding">#footer-bottom-inner { padding: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("bottom_footer_background",function(e){e.bind(function(e){var o=$(".customizer-bottom_footer_background");if(e){var t='<style class="customizer-bottom_footer_background">#footer-bottom { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("bottom_footer_color",function(e){e.bind(function(e){var o=$(".customizer-bottom_footer_color");if(e){var t='<style class="customizer-bottom_footer_color">#footer-bottom,#footer-bottom p { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("bottom_footer_link_color",function(e){e.bind(function(e){var o=$(".customizer-bottom_footer_link_color");if(e){var t='<style class="customizer-bottom_footer_link_color">#footer-bottom a { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("bottom_footer_link_color_hover",function(e){e.bind(function(e){var o=$(".customizer-bottom_footer_link_color_hover");if(e){var t='<style class="customizer-bottom_footer_link_color_hover">#footer-bottom a:hover { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("vc_row_bottom_margin",function(e){e.bind(function(e){var o=$(".customizer-vc_row_bottom_margin");if(e){var t='<style class="customizer-vc_row_bottom_margin">.wpex-vc-column-wrapper { margin-bottom: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("vcex_text_tab_two_bottom_border",function(e){e.bind(function(e){var o=$(".customizer-vcex_text_tab_two_bottom_border");if(e){var t='<style class="customizer-vcex_text_tab_two_bottom_border">body .wpb_tabs.tab-style-alternative-two .wpb_tabs_nav li.ui-tabs-active a { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("vcex_carousel_arrows",function(e){e.bind(function(e){var o=$(".customizer-vcex_carousel_arrows");if(e){var t='<style class="customizer-vcex_carousel_arrows">.wpex-carousel .owl-prev,.wpex-carousel .owl-next,.wpex-carousel .owl-prev:hover,.wpex-carousel .owl-next:hover { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("vcex_grid_filter_active_color",function(e){e.bind(function(e){var o=$(".customizer-vcex_grid_filter_active_color");if(e){var t='<style class="customizer-vcex_grid_filter_active_color">.vcex-filter-links a.theme-button.minimal-border:hover,.vcex-filter-links li.active a.theme-button.minimal-border { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("vcex_grid_filter_active_bg",function(e){e.bind(function(e){var o=$(".customizer-vcex_grid_filter_active_bg");if(e){var t='<style class="customizer-vcex_grid_filter_active_bg">.vcex-filter-links a.theme-button.minimal-border:hover,.vcex-filter-links li.active a.theme-button.minimal-border { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("vcex_grid_filter_active_border",function(e){e.bind(function(e){var o=$(".customizer-vcex_grid_filter_active_border");if(e){var t='<style class="customizer-vcex_grid_filter_active_border">.vcex-filter-links a.theme-button.minimal-border:hover,.vcex-filter-links li.active a.theme-button.minimal-border { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("vcex_recent_news_date_bg",function(e){e.bind(function(e){var o=$(".customizer-vcex_recent_news_date_bg");if(e){var t='<style class="customizer-vcex_recent_news_date_bg">.vcex-recent-news-date span.month { background-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("vcex_recent_news_date_color",function(e){e.bind(function(e){var o=$(".customizer-vcex_recent_news_date_color");if(e){var t='<style class="customizer-vcex_recent_news_date_color">.vcex-recent-news-date span.month { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("post_series_bg",function(e){e.bind(function(e){var o=$(".customizer-post_series_bg");if(e){var t='<style class="customizer-post_series_bg">#post-series,#post-series-title { background: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("post_series_borders",function(e){e.bind(function(e){var o=$(".customizer-post_series_borders");if(e){var t='<style class="customizer-post_series_borders">#post-series,#post-series-title,#post-series li { border-color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})}),api("post_series_color",function(e){e.bind(function(e){var o=$(".customizer-post_series_color");if(e){var t='<style class="customizer-post_series_color">#post-series,#post-series a,#post-series .post-series-count,#post-series-title { color: '+e+"; }</style>";o.length?o.replaceWith(t):$("head").append(t)}else o.remove()})});

} )( jQuery );