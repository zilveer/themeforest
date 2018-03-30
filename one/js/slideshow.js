( function( $ ) {

	var THB_RoyalSliderSlideshow = function( $el, options ) {

		var slideshow = this,
			royalSliderInstance = null,
			is_mobile = $( "body" ).hasClass( "thb-mobile" );

		options = $.extend( {}, options );

		options.video = {
			youTubeCode: '<iframe src="//www.youtube.com/embed/%id%?rel=1&showinfo=0&autoplay=1&wmode=transparent" frameborder="no"></iframe>',
			vimeoCode: '<iframe src="//player.vimeo.com/video/%id%?byline=0&amp;portrait=0&amp;autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
		};

		this.init = function() {
			$el.royalSlider( options );
			royalSliderInstance = $el.data( "royalSlider" );

			slideshow.bind();
		};

		this.bind = function() {
			royalSliderInstance.ev.on( "rsAfterContentSet rsAfterSlideChange", function() {
				var slide = slideshow.getCurrentSlide();
				slide.removeClass( "thb-muted" );

				slideshow.setupSlide( slide );

				if ( slide.data( "autoplay" ) == "1" ) {
					slideshow.playVideo();
				}
			} );

			royalSliderInstance.ev.on( "rsVideoPlay", function() {
				slideshow.setupSlide( slideshow.getCurrentSlide() );
			} );

			royalSliderInstance.ev.on( "rsBeforeMove", function() {
				slideshow.stopVideo();
			} );

			var slide = slideshow.getCurrentSlide();

			slideshow.setupSlide( slide );

			if ( slide.data( "autoplay" ) == "1" ) {
				slideshow.playVideo();
			}
		};

		this.getCurrentSlide = function() {
			var slide = $( ".rsActiveSlide .slide", $el );

			if ( ! slide.length ) {
				slide = $( ".slide", $el ).first();
			}

			return slide;
		};

		this.videoCallback = function( state ) {
			if ( state == "playing" ) {
				$el.addClass( "rsVideoPlaying" );
				slideshow.bindVolumeEvents( slideshow.getCurrentSlide() );
			}
			else {
				var slide = slideshow.getCurrentSlide(),
					rsSlide = slide.parent();

				$el.removeClass( "rsVideoPlaying" );

				if ( slide.data( "loop" ) ) {
					royalSliderInstance.playVideo();
				}
				else {
					royalSliderInstance.stopVideo();
				}

				if ( options.autoPlay && options.autoPlay.enabled ) {
					royalSliderInstance.startAutoPlay();
				}
			}
		};

		this.bindVolumeEvents = function( slide ) {
			var video = slideshow.getVideo( slide, true );

			$( ".thb-video-mute", slide ).off( ".thb" );
			$( ".thb-video-unmute", slide ).off( ".thb" );

			$( ".thb-video-mute", slide ).on( "click.thb", function() {
				video.data( "player" ).mute();
				slide.addClass( "thb-muted" );

				return false;
			} );

			$( ".thb-video-unmute", slide ).on( "click.thb", function() {
				video.data( "player" ).unMute();
				slide.removeClass( "thb-muted" );

				return false;
			} );
		};

		this.setupSlide = function( slide ) {
			if ( slide.attr( "data-fill" ) == "1" ) {
				if ( slide.data( "embed-iframe" ) ) {
					thb_video_holders( slide, ".rsVideoFrameHolder" );
				}
				else {
					thb_video_holders( slide );
				}
			}
			else {
				thb_video_holders_off( slide );
			}

			if ( slide.hasClass( "slide-type-embed" ) ) {
				if ( ! $( ".thb-video-play", slide ).data( "thbClickBound" ) ) {
					$( ".thb-video-play", slide ).data( "thbClickBound", true );

					$( ".thb-video-play", slide ).on( "click", function() {
						slideshow.playVideo();
						return false;
					} );
				}

				if ( ! $( ".thb-video-stop", slide ).data( "thbClickBound" ) ) {
					$( ".thb-video-stop", slide ).data( "thbClickBound", true );

					$( ".thb-video-stop", slide ).on( "click", function() {
						slideshow.stopVideo();
						return false;
					} );
				}
			}

			var video = slideshow.getVideo( slide, true );

			if ( video ) {

				if ( slide.data( "embed-iframe" ) ) {
					video.get(0).src += '&enablejsapi=1&api=1';

					if ( slide.data( "loop" ) == "1" ) {
						video.get(0).src += '&loop=1&playlist=' + slide.data( "code" );
					}

					video.get(0).src = video.get(0).src.replace( 'rel=1', 'rel=0' );
				}
				else {
					if ( slide.data( "muted" ) == "1" ) {
						video.attr( "muted", "1" );
					}
				}

				thb_boot_iframe_video( video );

				if ( video.hasClass( "thb-video-loaded" ) ) {
					video.off( ".thb" );
					video.on( "change.thb", function( e, state ) {
						slideshow.videoCallback( state );

						if ( slide.data( "muted" ) == "1" ) {
							video.data( "player" ).mute();
						}
					} );

					slideshow.bindVolumeEvents( slide );
				}
				else {
					video.off( ".thb" );
					video.on( "thb-video-loaded.thb", function() {
						video.on( "change.thb", function( e, state ) {
							slideshow.videoCallback( state );
						} );

						if ( slide.data( "muted" ) == "1" ) {
							video.data( "player" ).mute();
						}

						slideshow.bindVolumeEvents( slide );
					} );
				}
			}

			$el.trigger( "thbSetupSlide", [ $el, slide ] );
		};

		this.getVideos = function() {
			return $( "video", $el );
		};

		this.getVideo = function( slide, all ) {
			var selector = "video";

			if ( all ) {
				selector += ",iframe";
			}

			var video = $( selector, slide ).first();

			if ( ! video.length ) {
				video = false;
			}

			return video;
		};

		this.playVideo = function() {
			if ( options.autoPlay && options.autoPlay.enabled ) {
				royalSliderInstance.stopAutoPlay();
			}

			var slide = slideshow.getCurrentSlide();

			if ( slide.data( "embed-iframe" ) ) {
				$el.addClass( "rsVideoPlaying" );
				royalSliderInstance.playVideo();
			}
			else {
				var video = slideshow.getVideo( slide, true );

				if ( video && video.get( 0 ).play !== undefined ) {
					$el.addClass( "rsVideoPlaying" );

					setTimeout( function() {
						video.get( 0 ).play();
					}, 10 );
				}
			}
		};

		this.stopVideo = function() {
			var slide = slideshow.getCurrentSlide(),
				video = slideshow.getVideo( slide, true );

			if ( video ) {
				if ( slide.data( "embed-iframe" ) ) {
					royalSliderInstance.stopVideo();
					slideshow.videoCallback( "finished" );
				}
				else {
					if ( video.get( 0 ).pause !== undefined ) {
						video.get( 0 ).pause();
					}
				}
			}
		};

		this.init();

	};

	$.fn.thbRoyalSliderSlideshow = function( options ) {
		return this.each( function() {
			if ( ! $( this ).data( "thbRoyalSliderSlideshow" ) ) {
				$( this ).data( "thbRoyalSliderSlideshow", new THB_RoyalSliderSlideshow( $( this ), options ) );
			}
		} );
	};

} )( jQuery );