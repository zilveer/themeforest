/**
 * Frontend controller.
 *
 * This file is entitled to manage all the interactions in the frontend.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Assets\Frontend\JS
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Video shortcodes
 * -----------------------------------------------------------------------------
 */
 window.thb_loaded_videos = 0;

(function($) {
	"use strict";

	window.thb_video_holder = function( holder ) {
		var context = holder.parent(),
			context_height = context.outerHeight(),
			context_width = context.outerWidth(),
			ratio_x = holder.data( "ratio-x" ) !== undefined ? holder.data( "ratio-x" ) : 16,
			ratio_y = holder.data( "ratio-y" ) !== undefined ? holder.data( "ratio-y" ) : 9,
			y_alignment = holder.data( "y-alignment" ) !== undefined ? holder.data( "y-alignment" ) : "middle",
			projected_width = 0,
			projected_height = 0;

		if ( context_height < ( context_width * ratio_y / ratio_x ) ) {
			projected_height = context_width * ratio_y / ratio_x;

			holder.css( "width", context_width );
			holder.css( "height", projected_height );
			holder.css( "margin-left", 0 );
			holder.css( "margin-top", 0 );

			if ( y_alignment == "middle" ) {
				holder.css( "margin-top", ( context_height - projected_height ) / 2 );
			}
		}
		else {
			projected_width = context_height * ratio_x / ratio_y;

			holder.css( "width", projected_width );
			holder.css( "height", context_height );
			holder.css( "margin-top", 0 );
			holder.css( "margin-left", ( context_width - projected_width ) / 2 );
		}
	};

	window.thb_video_holders = function( context, holder_selector ) {
		if ( holder_selector === undefined ) {
			holder_selector = '.thb-video-holder[data-fill="1"]';
		}

		$( holder_selector, context ).each(function(){
			thb_video_holder( $( this ) );
		});

		$(window).on( "resize.thb_video_holders", function() {
			$( holder_selector, context ).each(function(){
				thb_video_holder( $( this ) );
			});
		}.debounce(200) );
	};

	window.thb_video_holders_off = function( context, holder_selector ) {
		if ( holder_selector === undefined ) {
			holder_selector = '.thb-video-holder[data-fill="1"]';
		}

		$( window ).off( ".thb_video_holders" );

		$( holder_selector, context ).each(function(){
			$( this ).removeAttr( "style" );
		});
	};

	window.THB_Video = function( id, obj, type ) {
		var self = this;

		this.id = id;
		this.obj = obj;
		this.type = type;

		/**
		 * State
		 */
		this.state = function( code ) {
			var state = "";

			switch( code ) {
				case 0:
					state = "finished";
					break;
				case 1:
					state = "playing";
					break;
				default:
					state = "paused";
					break;
			}

			return state;
		};

		/**
		 * Videos loaded callback
		 */
		this.callbackCheck = function() {
			window.thb_loaded_videos++;

			this.obj.addClass("thb-video-loaded");
			self.obj.trigger( "thb-video-loaded" );

			if ( window.thb_loaded_videos === window.thb_total_videos ) {
				$(window).trigger("thb-loaded-videos");
			}
		};

		/**
		 * Init
		 */
		this.init = function() {
			var self = this;

			switch( this.type ) {
				case "youtube":
					this.api = new YT.Player("youtube-" + this.id, {
						events: {
							onStateChange: function(state) {
								self.obj.trigger( "change", [ self.state(state.data) ] );
							},
							onReady: function() {
								self.callbackCheck();
							}
						}
					});

					this.play = function() { this.api.playVideo(); };
					this.pause = function() { this.api.pauseVideo(); };
					this.stop = function() { this.api.stopVideo(); };
					this.isMuted = function() { return this.api.isMuted(); };
					this.mute = function() { this.api.mute(); };
					this.unMute = function() { this.api.unMute(); };
					this.toggleVolume = function() {
						if ( this.isMuted() ) {
							this.unMute();
						}
						else {
							this.mute();
						}
					};

					break;
				case "vimeo":
					this.api = new Froogaloop(this.obj.get(0));

					this.api.addEvent("ready", function(player_id) {
						self.api.addEvent("play", function() {
							self.obj.trigger("change", [self.state(1)]);
						});
						self.api.addEvent("pause", function() {
							self.obj.trigger("change", [self.state(2)]);
						});
						self.api.addEvent("finish", function() {
							self.obj.trigger("change", [self.state(0)]);
						});

						self.callbackCheck();
					});

					this.play = function() { this.api.api("play"); };
					this.pause = function() { this.api.api("pause"); };
					this.stop = function() { this.api.api("pause"); };
					this.isMuted = function() {
						var muted = false;

						this.api.api( "getVolume", function( vol ) {
							if ( vol == 0 ) {
								muted = true;
							}
						} );

						return muted;
					};
					this.mute = function() { self.api.api( "setVolume", 0 ); };
					this.unMute = function() { self.api.api( "setVolume", 1 ); };
					this.toggleVolume = function() {
						var self = this;

						this.api.api( "getVolume", function( vol ) {
							if ( vol == 0 ) {
								self.unMute();
							}
							else {
								self.mute();
							}
						} );
					};

					break;
				default:
					this.api = this.obj.get(0);

					this.api.addEventListener("loadedmetadata", function() {
						self.obj.data('width', self.obj.get(0).videoWidth);
						self.obj.data('height', self.obj.get(0).videoHeight);

						if( self.obj.attr("autoplay") ) {
							self.play();
						}

						self.callbackCheck();
					}, false);
					this.api.addEventListener("play", function() {
						self.obj.trigger("change", [self.state(1)]);
					}, false);
					this.api.addEventListener("pause", function() {
						self.obj.trigger("change", [self.state(2)]);
					}, false);
					this.api.addEventListener("ended", function() {
						self.obj.trigger("change", [self.state(0)]);
					}, false);

					this.play = function() { this.api.play(); };
					this.pause = function() { this.api.pause(); };
					this.stop = function() { this.api.pause(); };
					this.isMuted = function() { return self.obj.get( 0 ).muted; };
					this.mute = function() { self.obj.get( 0 ).muted = true; };
					this.unMute = function() { self.obj.get( 0 ).muted = false; };
					this.toggleVolume = function() {
						self.obj.get( 0 ).muted = ! self.obj.get( 0 ).muted;
					};

					break;
			}
		};

		/**
		 * Change
		 */
		this.change = function(state) {};

		this.init();
	};

	window.thb_total_videos = 0;
	window.thb_video_ids = 0;
	window.thb_youtube_ready = false;

	$(document).ready(function() {
		window.thb_total_videos = $("iframe.thb-video-api, video.wp-video-shortcode").length;

		if ( window.thb_total_videos == 0 ) {
			$( window ).trigger( "thb-loaded-videos" );
		}

		$("iframe[src^='//player.vimeo'].thb-video-api").each(function() {
			// window.thb_boot_iframe_video( $( this ) );
			$(this).data( "player", new THB_Video( window.thb_video_ids++, $(this), 'vimeo' ) );
		});

		if( $("iframe[src*='youtu'].thb-video-api").length ) {
			window.thb_load_youtube();
		}

		// $("iframe[src*='youtu'].thb-video-api").each(function() {
		// 	window.thb_boot_iframe_video( $( this ) );
		// 	// $(this).data( "player", new THB_Video( window.thb_video_ids++, $(this), 'youtube' ) );
		// });

		$("video.wp-video-shortcode").each(function() {
			$(this).data( "player", new THB_Video( window.thb_video_ids++, $(this), 'selfhosted' ) );
		});
	});

	window.thb_load_youtube = function() {
		var tag = document.createElement("script");
		tag.src = "//www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	};

	window.thb_boot_iframe_video = function( iframe ) {
		var src = iframe.attr( "src" );

		if ( ! src ) {
			return;
		}

		if ( src.indexOf( "youtu" ) > -1 ) {
			if ( window.thb_youtube_ready ) {
				var id = window.thb_video_ids++;
				iframe.attr( "id", "youtube-" + id );
				iframe.data( "player", new THB_Video( id, iframe, 'youtube' ) );
			}
			else {
				$( window ).on( "thb-youtube-ready", function() {
					var id = window.thb_video_ids++;
					iframe.attr( "id", "youtube-" + id );
					iframe.data( "player", new THB_Video( id, iframe, 'youtube' ) );
				} );

				window.thb_load_youtube();
			}
		}
		else if ( src.indexOf( "//player.vimeo" ) > -1 ) {
			iframe.data( "player", new THB_Video( window.thb_video_ids++, iframe, 'vimeo' ) );
		}
	};

	window.onYouTubeIframeAPIReady = function() {
		window.thb_youtube_ready = true;
		$( window ).trigger( "thb-youtube-ready" );

		$("iframe[src*='youtu'].thb-video-api").each(function() {
			// window.thb_boot_iframe_video( $( this ) );
			var id = window.thb_video_ids++;

			$(this).attr( "id", "youtube-" + id );
			$(this).data( "player", new THB_Video( id, $(this), 'youtube' ) );
		});
	};
})(jQuery);

/**
 * Translations
 * -----------------------------------------------------------------------------
 */
(function($) {
	"use strict";

	$.thb.translate = function( key ) {
		if( $.thb.translations[key] ) {
			return $.thb.translations[key];
		}

		return key;
	};
})(jQuery);

/**
 * Remove empty paragraphs
 * -----------------------------------------------------------------------------
 */
(function($) {
	"use strict";

	$( document ).ready( function() {
		$('p')
			.filter(function() {
				return $.trim($(this).html()) === '';
			})
			.remove();
	} );
})(jQuery);

/**
 * ****************************************************************************
 * THB menu
 *
 * $("#menu-container").menu();
 * ****************************************************************************
 */
(function($) {
	"use strict";

	$.fn.menu = function(params) {

		// Parameters
		// --------------------------------------------------------------------
		var settings = {
			animate: true,
			speed: 350,
			display: 'block',
			easing: 'linear',
			openClass: 'current-menu-item',
			megaMenu: {
				fixed: true,
				sentinel: null
			},
			availableRightSpaceClass: 'available-space-right',
			availableLeftSpaceClass: 'available-space-left',
			'showCallback': function() {},
			'hideCallback': function() {}
		};

		// Parameters
		$.extend(settings, params);

		// Menu instance
		// --------------------------------------------------------------------
		var instance = {
			el: null,

			destroy: function() {
				$( instance.el ).find( "*" ).off( ".thb_menu" );
				$( instance.el ).find( "ul.sub-menu" ).removeAttr( "style" );
				$( window ).off( ".thb_menu" );
			},

			init: function( subMenu, item, root ) {
				instance.el = root;

				item.removeClass( settings.availableRightSpaceClass );
				item.removeClass( settings.availableLeftSpaceClass );

				// if ( item.is( ".thb-is-mega" ) ) {
				// 	return;
				// }

				var itemOffset = item.offset().left;

				if ( item.parent().hasClass( "sub-menu" ) ) {
					itemOffset += item.outerWidth();
				}

				var subMenuWidth = subMenu.outerWidth(),
					availableRightSpace = $( window ).width() - itemOffset,
					availableLeftSpace = itemOffset;

				if ( availableRightSpace > subMenuWidth ) {
					item.addClass( settings.availableRightSpaceClass );
				}

				if ( availableLeftSpace > subMenuWidth ) {
					item.addClass( settings.availableLeftSpaceClass );
				}
			},

			showMegaSubMenu: function( subMenu, item ) {
				if ( settings.megaMenu && settings.megaMenu.fixed ) {
					subMenu
						.css({
							'top': item.offset().top + item.outerHeight()
						});
				}

				this.showSubMenu( subMenu, item );
			},

			showSubMenu: function( subMenu, item ) {
				item.addClass( settings.openClass );

				instance.init( subMenu, item, instance.el );

				var css_start = {
						opacity: 0,
						display: settings.display
					},
					css_end = {
						opacity: 1
					};

				if ( settings.animate ) {
					subMenu
						.stop(true, true)
						.css( css_start )
						.animate( css_end, settings.speed, settings.easing, function() {
							settings.showCallback();
						});
				}
				else {
					subMenu.css( "display", settings.display );
					settings.showCallback();
				}
			},

			hideSubMenu: function( subMenu, item ) {
				item.removeClass( settings.openClass );

				var css_end = {
						opacity: 0
					};

				if ( settings.animate ) {
					subMenu
						.stop(true, true)
						.animate( css_end, settings.speed / 2, settings.easing, function() {
							$(this).hide();
							settings.hideCallback();
						} );
				}
				else {
					subMenu.hide();
					settings.hideCallback();
				}
			}
		};

		return this.each(function() {
			var self = this,
				menuContainer = $(this),
				menu = menuContainer.find("> ul"),
				menuItems = menu.find("> li"),
				subMenuItems = menuItems.find('li').andSelf();

			$( this ).data( "thb-menu", instance );

			menuItems.each(function() {
				if ( $( this ).parents( '.thb-is-mega' ).length ) {
				// if ( $( this ).is( '.thb-is-mega' ) || $( this ).parents( '.thb-is-mega' ).length ) {
					return;
				}

				if ( settings.megaMenu && settings.megaMenu.fixed && $( this ).hasClass( "thb-is-mega" ) ) {
					$( this ).addClass( 'thb-megamenu-fixed' );
				}

				$(this).find('> a').addClass('needsclick');

				var subMenu = $(this).find('> ul');

				if( subMenu.length ) {
					subMenu.css({
						display: 'none'
					});
				}
			});

			// Binding events
			subMenuItems.each(function() {
				var item = $(this),
					subMenu = item.find("> ul");

				if ( item.parents( '.thb-is-mega' ).length ) {
					return;
				}

				if( subMenu.length ) {
					item
						.find('> a')
						.addClass('w-sub needsclick');

					instance.init( subMenu, item, self );

					item
						.on( "mouseenter.thb_menu", function() {
							if ( item.hasClass( "thb-is-mega" ) ) {
								instance.showMegaSubMenu( subMenu, $(this) );
							}
							else {
								instance.showSubMenu( subMenu, $(this) );
							}
						})
						.on( "mouseleave.thb_menu", function() {
							instance.hideSubMenu( subMenu, $(this) );
						});

					$( window ).on( "resize.thb_menu", function() {
						instance.init( subMenu, item, self );
					} );
				}
			});
		});

	};

})(jQuery);

/**
 * Scroll in page.
 */
;( function( $ ) {
	window.thb_scroll_in_page = function( smoothScrollSelectors, scrollOptions, offset, preScrollCallback ) {
		if ( offset === undefined ) {
			offset = 0;
		}

		scrollOptions = $.extend( {
			speed: 350,
			easing: "easeInOutCubic"
		}, scrollOptions );

		$( document ).on( "click", smoothScrollSelectors, function() {
			var href = $( this ).attr( "href" ),
				target = $( this ).attr( "target" );

			if ( href.indexOf( "#" ) > -1 ) {
				var url = href.split("#"),
					current_url = window.location.href.split("#"),
					is_same_page = url[0] == "" || ( url[0] != "" && url[0] == current_url[0] ),
					href = "#" + url[1];

				if ( is_same_page ) {
					if ( ! $( href ).length ) {
						return false;
					}

					if ( preScrollCallback !== undefined ) {
						preScrollCallback();
					}

					$.scrollTo( $( href ), scrollOptions.speed, {
						easing: scrollOptions.easing,
						offset: ( offset ) * -1
					} );

					return false;
				}
				else {
					return true;
				}
			}
		} );
	}
} )( jQuery );

/**
 * Fullscreen.
 */
;( function( $ ) {
	window.thb_fullscreen_check = function() {
		return document.documentElement.requestFullscreen || document.documentElement.mozRequestFullScreen || document.documentElement.webkitRequestFullScreen || document.documentElement.msRequestFullscreen;
	};

	window.thb_is_fullscreen = function() {
		return document.fullscreen || document.mozFullScreen || document.webkitIsFullScreen || document.msFullscreenElement;
	};

	window.thb_exit_fullscreen = function() {
		if ( document.exitFullscreen ) {
			document.exitFullscreen();
		}
		else if ( document.msExitFullscreen ) {
			document.msExitFullscreen();
		}
		else if ( document.mozCancelFullScreen ) {
			document.mozCancelFullScreen();
		}
		else if ( document.webkitExitFullscreen ) {
			document.webkitExitFullscreen();
		}
	};

	window.thb_go_fullscreen = function( elem ) {
		elem = $( elem ).get( 0 );

		if ( elem.requestFullscreen ) {
			elem.requestFullscreen();
		}
		else if ( elem.msRequestFullscreen ) {
			elem.msRequestFullscreen();
		}
		else if ( elem.mozRequestFullScreen ) {
			elem.mozRequestFullScreen();
		}
		else if ( elem.webkitRequestFullscreen ) {
			elem.webkitRequestFullscreen();
		}
	};

	window.thb_fullscreen_transition = function( on ) {
		if ( on ) {
			$( "html" ).addClass( "thb-full-screen" );
		}
		else {
			$( "html" ).removeClass( "thb-full-screen" );
		}
	};

	if ( document.addEventListener ) {
		document.addEventListener( "fullscreenchange", function () {
			thb_fullscreen_transition( document.fullscreen );
		}, false );

		document.addEventListener( "mozfullscreenchange", function () {
			thb_fullscreen_transition( document.mozFullScreen );
		}, false );

		document.addEventListener( "webkitfullscreenchange", function () {
			thb_fullscreen_transition( document.webkitIsFullScreen );
		}, false );

		document.addEventListener( "msfullscreenchange", function () {
			thb_fullscreen_transition( document.msFullscreenElement );
		}, false );
	}
	else {
		document.attachEvent( "fullscreenchange", function () {
			thb_fullscreen_transition( document.fullscreen );
		} );

		document.attachEvent( "mozfullscreenchange", function () {
			thb_fullscreen_transition( document.mozFullScreen );
		} );

		document.attachEvent( "webkitfullscreenchange", function () {
			thb_fullscreen_transition( document.webkitIsFullScreen );
		} );

		document.attachEvent( "msfullscreenchange", function () {
			thb_fullscreen_transition( document.msFullscreenElement );
		} );
	}
} )( jQuery );

/**
 * Parallax.
 */
;( function( $ ) {
	var $window = $( window ),
		windowHeight = $window.height();

	var THB_Parallax = function( $el, options ) {
		var parallax = this;

		options = $.extend( {}, {
			speed: 0.6,
			xpos: "50%"
		}, options );

		this.update = function() {
			var offset = $el.offset().top,
				pos = $window.scrollTop(),
				height = $el.outerHeight();

			if ( offset + height < pos || offset > pos + windowHeight ) {
				return;
			}

			$el.css( "backgroundPosition", options.xpos + " " + Math.round( ( offset - pos ) * options.speed ) + "px" );
		};

		$window.on( "scroll", this.update );
		$window.on( "resize", function() {
			windowHeight = $window.height();
			parallax.update();
		} );

		this.update();
	};

	$.fn.thbParallax = function( options ) {
		return this.each( function() {
			if ( ! $( this ).data( "thbParallax" ) ) {
				$( this ).data( "thbParallax", new THB_Parallax( $( this ), options ) );
			}
		} );
	};
} )( jQuery );

/**
 * Scroll to include.
 */
;( function( $ ) {
	$.scrollToInclude = function( element, options ) {
		element = $( element );

		options = $.extend( {
			speed: 350,
			easing: "easeInOutCubic",
			offset: 0
		}, options );

		var element_height = element.outerHeight(),
			element_offset = element.position().top,
			endOfScroll = parseInt( element_offset + element_height + options.offset, 10 );

		endOfScroll -= $( window ).height();

		$.scrollTo( endOfScroll, options.speed, {
			easing: options.easing,
			offset: ( options.offset ) * -1
		} );
	};
} )( jQuery );

/**
 * Frontend conditional controller.
 */
;( function( $ ) {
	if( ! $.thb ) {
		$.thb = {};
	}

	$.thb.wp = {
		is_body_class: function( classname ) {
			return $( "body" ).hasClass( classname );
		},
		is_post_type: function( post_type ) {
			return $( "body" ).hasClass( "single-" + post_type );
		},
		is_single_post: function() {
			return $.thb.wp.is_post_type( "post" );
		},
		is_page: function( arg ) {
			if ( $( "body" ).hasClass( "page" ) ) {
				if ( typeof arg === 'string' ) {
					// Template
					arg = arg.replace( /./g, '-' );
					return $( "body" ).hasClass( "page-template-" + arg );
				}
				else if ( typeof arg === 'number' ) {
					// Page ID
					return $( "body" ).hasClass( "page-id-" + arg );
				}
			}

			return false;
		},
		is_mobile: function() {
			return $( "body" ).hasClass( "thb-mobile" );
		},
		is_desktop: function() {
			return $( "body" ).hasClass( "thb-desktop" );
		},
		is_larger_than: function( width ) {
			return Math.max(document.documentElement.clientWidth, window.innerWidth || 0) >= width;
		},
		is_smaller_than: function( width ) {
			return Math.max(document.documentElement.clientWidth, window.innerWidth || 0) <= width;
		},
		is_between: function( min, max ) {
			var viewport = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)

			return viewport >= min && viewport <= max;
		}
	}
} )( jQuery );