/*!
Plugin: Wolf Slider
Version 1.0.0
Author: Constantin Saguin
Twitter: @wolf_themes
Author URL: http://csag.co

An enhanced version of flexslider that support video background and caption transition effects
*/
/*global MediaElementPlayer:false*/
;( function ( window, document, $, undefined ) {

	$.wolfslider = function( elem, options ) {
		/* jshint unused:false */
		var isTouch = $( 'html' ).hasClass( 'touch' ),
			ui,
			doVideo = ( navigator.userAgent.match( /(iPad)|(iPhone)|(iPod)|(Android)|(PlayBook)|(BB10)|(BlackBerry)|(Opera Mini)|(IEMobile)|(webOS)|(MeeGo)/i ) ) ? false : true,
			defaults = {
				//animation : ( isTouch ) ? 'slide' : 'fade',
				animation : 'fade',
				slideshow : false,
				pauseOnHover: true,
				slideshowSpeed : 4000,
				controlNav : true,
				directionNav : true
			},

			plugin = this,
			selector = elem.selector,
			$selector = $( selector ),
			player = [];

		plugin.settings = {};

		plugin.init = function() {

			plugin.settings = $.extend( {}, defaults, options );

			$selector.flexslider( {
				animation : plugin.settings.animation,
				slideshow : plugin.settings.slideshow,
				pauseOnHover : plugin.settings.pauseOnHover,
				slideshowSpeed : plugin.settings.slideshowSpeed,
				controlNav : plugin.settings.controlNav,
				directionNav : plugin.settings.directionNav,

				start : function () {
					ui.init();
					ui.playVideo();
				},
				before : function () {
					ui.pauseAllVideos();

				},
				after : function () {
					ui.playVideo();
				}
			} );
		};

		ui = {

			/**
			 * Initiate slider
			 */
			init : function () {
				var _this = this;

				this.initPlayer();
				this.loadAllVideos();
				this.videoBackground();
				this.playVideo();
				this.playButton();
				this.muteButton();

				/**
				 * Resize event
				 */
				$( window ).resize( function() {
					_this.videoBackground();
				} ).resize();
			},

			initPlayer : function () {

				var options = {
					loop: true,
					features: [],
					enableKeyboard: false,
					pauseOtherPlayers: false
				};

				$( '.wolf-slide' ).find( '.wolf-slide-video' ).each( function () {
					var id = $( this ).data( 'video-id' );
					player[id] = new MediaElementPlayer( '#wolf-slide-video-' + id, options );
				} );

				this.cleanPlayersTags();
			},

			cleanPlayersTags : function () {
				$( '.wolf-slide' ).find( '.mejs-controls, .mejs-clear, .mejs-layers' ).remove();
				$( '.wolf-slide' ).find( '.mejs-container' ).replaceWith( function() {
					return $( '<span class="mejs-container" />' ).append( $( this ).contents() );
				} );
				$( '.wolf-slide' ).find( '.mejs-inner' ).replaceWith( function() {
					return $( '<span class="mejs-inner" />' ).append( $( this ).contents() );
				} );
				$( '.wolf-slide' ).find( '.mejs-mediaelement' ).replaceWith( function() {
					return $( '<span class="mejs-mediaelement" />' ).append( $( this ).contents() );
				} );
			},

			loadAllVideos : function () {

				$( '.wolf-slide' ).find( '.wolf-slide-video' ).each( function () {
					var id = $( this ).data( 'video-id' );
					//player[id].load();
					player[id].play();
					player[id].pause();
					$( this ).parents( '.wolf-slide' ).addClass( 'pause' );
				} );
			},

			playVideo : function () {

				if ( $( '.flex-active-slide' ).find( '.wolf-slide-video' ).length ) {
					var id, mute, play, $video, video,
						$videoContainer = $( '.flex-active-slide' );

					$video = $videoContainer.find( '.wolf-slide-video' );
					id = $video.data( 'video-id' );
					mute = $video.data( 'video-mute' );
					play = $video.data( 'video-play' );

					if ( true === play && doVideo ) {
						player[id].play();
						$videoContainer.removeClass( 'pause' );
					}
					player[id].setMuted( mute );

					video = document.getElementById( 'wolf-slide-video-' + id );

					// console.log( doVideo );

					if ( doVideo ) {
						if ( video.readyState >= video.HAVE_FUTURE_DATA ) {
						// if ( 1 === 1 ) {
							// console.log('video can play!');
							$videoContainer.find( '.wolf-slide-video-fallback' ).css( { 'opacity' : 0 } );
						} else {
							video.addEventListener( 'canplay', function () {
								// console.log('video can play!');
								$videoContainer.find( '.wolf-slide-video-fallback' ).css( { 'opacity' : 0 } );
							}, false );
						}
					}
				}
			},

			pauseAllVideos : function () {

				$( '.wolf-slide' ).find( '.wolf-slide-video' ).each( function () {
					var id = $( this ).data( 'video-id' );
					player[id].pause();
					//$( this ).parents( '.wolf-slide-video-container' ).addClass( 'pause' );
				} );
			},

			muteButton : function () {

				$( '.wolf-slide-mute-button' ).each( function () {
					$( this ).on( 'click' , function () {
						var parentPlayer, $slide, $video, state,
							id = $( this ).data( 'video-mute-id' );

						$video = $( '#wolf-slide-video-' + id );
						$slide = $video.parents( '.wolf-slide' );
						state = $video.data( 'video-mute' );
						parentPlayer = player[id];

						if ( true === state ) {
							player[id].setMuted( false );
							$video.data( 'video-mute', false );
							$slide.toggleClass( 'unmute' );
						} else {
							player[id].setMuted( true );
							$video.data( 'video-mute', true );
							$slide.toggleClass( 'unmute' );
						}
					} );
				} );
			},

			playButton : function () {

				$( '.wolf-slide-play-button' ).each( function () {
					$( this ).on( 'click' , function () {
						var parentPlayer, $slide, $video, state,
							id = $( this ).data( 'video-play-id' );

						$video = $( '#wolf-slide-video-' + id );
						$slide = $video.parents( '.wolf-slide' );
						state = $video.data( 'video-play' );
						parentPlayer = player[id];

						if ( true === state ) {
							player[id].pause();
							$video.data( 'video-play', false );
							$slide.addClass( 'pause' );
						} else {
							player[id].play();
							$video.data( 'video-play', true );
							$slide.removeClass( 'pause' );
						}
					} );
				} );
			},

			videoBackground : function () {

				var containerWidth = $( '.wolf-slide-video-container' ).width(),
					containerHeight = $( '.wolf-slide-video-container' ).height(),
					video = $( '.wolf-slide-video, .wolf-slide-video-fallback' ),
					ratioWidth = 640,
					ratioHeight = 360,
					ratio = ratioWidth/ratioHeight,
					newHeight,
					newWidth,
					newMarginLeft,
					newmarginTop,
					newCss;


				if ( ( containerWidth / containerHeight ) >= ratio ) {

					newWidth = containerWidth;
					newHeight = Math.floor( ( containerWidth/ratioWidth ) * ratioHeight ) + 2;
					newmarginTop =  Math.floor( ( containerHeight - newHeight ) / 4 );

					newCss = {
						width : newWidth,
						height : newHeight,
						marginTop :  newmarginTop,
						marginLeft : 0
					};

					video.css( newCss );

				} else if ( ( containerWidth / containerHeight ) < ratio ) {
					// console.log( ratio );
					newHeight = containerHeight;
					newWidth = Math.floor( ( containerHeight/ratioHeight ) * ratioWidth );
					newMarginLeft =  Math.floor( ( containerWidth - newWidth ) / 4 );

					newCss = {
						width : newWidth,
						height : newHeight,
						marginLeft :  newMarginLeft,
						marginTop : 0
					};

					video.css( newCss );
				}
			}
		};

		plugin.init();
	};

	$.fn.wolfslider = function( options ) {

		if ( ! $.data( this, '_wolfslider' ) ) {
			var wolfslider = new $.wolfslider( this, options );
			this.data( '_wolfslider', wolfslider );
		}
		return this.data( '_wolfslider' );
	};

}( window, document, jQuery ) );
