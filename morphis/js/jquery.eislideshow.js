(function( window, $, undefined ) {
	"use strict";
	/*
	* smartresize: debounced resize event for jQuery
	*
	* latest version and complete README available on Github:
	* https://github.com/louisremi/jquery.smartresize.js
	*
	* Copyright 2011 @louis_remi
	* Licensed under the MIT license.
	*/

	var $event = $.event, resizeTimeout;

	$event.special.smartresize 	= {
		setup: function() {
			$(this).bind( "resize", $event.special.smartresize.handler );
		},
		teardown: function() {
			$(this).unbind( "resize", $event.special.smartresize.handler );
		},
		handler: function( event, execAsap ) {
			// Save the context
			var context = this,
				args 	= arguments;

			// set correct event type
			event.type = "smartresize";

			if ( resizeTimeout ) { clearTimeout( resizeTimeout ); }
			resizeTimeout = setTimeout(function() {
				jQuery.event.handle.apply( context, args );
			}, execAsap === "execAsap"? 0 : 100 );
		}
	};

	$.fn.smartresize 			= function( fn ) {
		return fn ? this.bind( "smartresize", fn ) : this.trigger( "smartresize", ["execAsap"] );
	};
	
	$.Slideshow 				= function( options, element ) {
	
		this.$el			= $( element );
		
		/***** images ****/
		
		// list of image items
		this.$list			= this.$el.find('ul.ei-slider-large');
		// image items
		this.$imgItems		= this.$list.children('li');
		// total number of items
		this.itemsCount		= this.$imgItems.length;
		// images and videos
		this.$images		=  this.$imgItems.find('.slider-item'); //this.$imgItems.find('img:first');
		
		/***** thumbs ****/
		
		// thumbs wrapper
		this.$sliderthumbs	= this.$el.find('ul.ei-slider-thumbs').hide();
		// slider elements
		this.$sliderElems	= this.$sliderthumbs.children('li');
		// sliding div
		this.$sliderElem	= this.$sliderthumbs.children('li.ei-slider-element');
		// thumbs
		this.$thumbs		= this.$sliderElems.not('.ei-slider-element');
		
		// initialize slideshow
		this._init( options );
		
	};
	
	$.Slideshow.defaults 		= {
		// animation types:
		// "sides" : new slides will slide in from left / right
		// "center": new slides will appear in the center
		animation			: 'sides', // sides || center
		// if true the slider will automatically slide, and it will only stop if the user clicks on a thumb
		autoplay			: false,
		// interval for the slideshow
		slideshow_interval	: 3000,
		// speed for the sliding animation
		speed			: 800,
		// easing for the sliding animation
		easing			: '',
		// percentage of speed for the titles animation. Speed will be speed * titlesFactor
		titlesFactor		: 0.60,
		// titles animation speed
		titlespeed			: 800,
		// titles animation easing
		titleeasing			: '',
		// maximum width for the thumbs in pixels
		thumbMaxWidth		: 150
    };
	
	$.Slideshow.prototype 		= {
		_init 				: function( options ) {
			
			this.options 		= $.extend( true, {}, $.Slideshow.defaults, options );
			
			// set the opacity of the title elements and the image items
			this.$imgItems.css( 'opacity', 0 );
			this.$imgItems.find('div.ei-title > *').css( 'opacity', 0 );
			
			// index of current visible slider
			this.current		= 0;
			
			// if video is playing
			this.videoIsPlaying = false;
			
			var _self			= this;
			
			// preload images
			// add loading status
			this.$loading		= $('<div class="ei-slider-loading">Loading</div>').prependTo( _self.$el );
			
			$.when( this._preloadImages() ).done( function() {
				
				// hide loading status
				_self.$loading.hide();
				
				// calculate size and position for each image
				//_self._setImagesSize();
				
				_self._initResponsive();
				
				// responsive images
				_self._responsive();
								
				// the Vimeo API for listening on events
				_self._initVimeoApi();
				
				// the YouTube API
				_self._initYouTubeApi();		

				// listeners for youtube
				//_self._listenYouTube();
				
				// configure thumbs container
				_self._initThumbs();
				
				// show first
				_self.$imgItems.eq( _self.current ).css({
					'opacity' 	: 1,
					'z-index'	: 10
				}).show().find('div.ei-title > *').css( 'opacity', 1 );
				
				// if autoplay is true
				if( _self.options.autoplay ) {
				
					_self._startSlideshow();
				
				}						
				
				// initialize the events
				_self._initEvents();
			
			
			});
			
		},
		_preloadImages		: function() {
			
			// preloads all the large images
			
			var _self	= this,
				loaded	= 0;
			
			return $.Deferred(
			
				function(dfd) {
			
					_self.$images.each( function( i ) {
						
						if($(this).hasClass('vimeo-video-slide') || $(this).hasClass('youtube-video-slide')){
						
							$('iframe').load( function() {
							
								if( ++loaded === _self.itemsCount ) {
									
										dfd.resolve();
										
								}
								
							}).attr( 'src', $(this).attr('src') );
							
						} else {							
						
							$('<img/>').load( function() {
							
								if( ++loaded === _self.itemsCount ) {
								
									dfd.resolve();
									
								}
							
							}).attr( 'src', $(this).attr('src') );
							
						}
					});
					
				}
				
			).promise();
			
		},
		_setImagesSize		: function() {
			
			// save ei-slider's width
			this.elWidth	= this.$el.width();
			
			var _self	= this;
			
			this.$images.each( function( i ) {
				
				var $img	= $(this);
					imgDim	= _self._getImageDim( $img.attr('src') );
					
				$img.css({
					width		: imgDim.width,
					height		: imgDim.height,
					marginLeft	: imgDim.left,
					marginTop	: imgDim.top
				});
				
			});
		
		},
		_getImageDim		: function( src ) {
			
			var $img    = new Image();
							
			$img.src    = src;
					
			var c_w		= this.elWidth,
				c_h		= this.$el.height(),
				r_w		= c_h / c_w,
				
				i_w		= $img.width,
				i_h		= $img.height,
				r_i		= i_h / i_w,
				new_w, new_h, new_left, new_top;
					
			if( r_w > r_i ) {
				
				new_h	= c_h;
				new_w	= c_h / r_i;
			
			}
			else {
			
				new_h	= c_w * r_i;
				new_w	= c_w;
			
			}
					
			return {
				width	: new_w,
				height	: new_h,
				left	: ( c_w - new_w ) / 2,
				top		: ( c_h - new_h ) / 2
			};
		
		},
		_initResponsive			: function() {
			
			var smallest_img_size = $(this.$images[0]).height();
				
				this.$images.each( function( i ) {
				
					var $img	= $(this);
					var temp_current_image_height = $img.height();
					
					if(smallest_img_size > temp_current_image_height) {
						smallest_img_size = temp_current_image_height;						
					} 
					
				});
				
				this.$el.css({
					'height' : smallest_img_size
				});
			
		},		
		_responsive			: function() {
			var _self  = this;
			$(window).on( 'smartresize.linky', function( event ) {
				
				var smallest_img_size = $(_self.$images[0]).height();
				
				_self.$images.each( function( i ) {
				
					var $img	= $(this);
					var temp_current_image_height = $img.height();
					
					if(smallest_img_size > temp_current_image_height) {
						smallest_img_size = temp_current_image_height;						
					} 
					
				});
				
				_self.$el.css({
					'height' : smallest_img_size
				});
				
			});
			
		}, 
		_initThumbs			: function() {
		
			// set the max-width of the slider elements to the one set in the plugin's options
			// also, the width of each slider element will be 100% / total number of elements
			this.$sliderElems.css({
				'max-width' : this.options.thumbMaxWidth + 'px',
				'width'		: 100 / this.itemsCount + '%'
			});
			
			// set the max-width of the slider and show it
			this.$sliderthumbs.css( 'max-width', this.options.thumbMaxWidth * this.itemsCount + 'px' ).show();
			
		},
		_startSlideshow		: function() {
		
			var _self	= this;
			
			this.slideshow	= setTimeout( function() {
				
				var pos;
				
				( _self.current === _self.itemsCount - 1 ) ? pos = 0 : pos = _self.current + 1;
				
				_self._slideTo( pos );
				
				if( _self.options.autoplay && !(_self.videoIsPlaying) ) {
					
					_self._startSlideshow();
				
				}
			
			}, this.options.slideshow_interval);
		
		},
		// shows the clicked thumb's slide
		_slideTo			: function( pos ) {
			
			// return if clicking the same element or if currently animating
			if( pos === this.current || this.isAnimating )
				return false;
			
			this.isAnimating	= true;
			
			var $currentSlide	= this.$imgItems.eq( this.current ),
				$nextSlide		= this.$imgItems.eq( pos ),
				_self			= this,
				
				preCSS			= {zIndex	: 10},
				animCSS			= {opacity	: 1};
			
			// new slide will slide in from left or right side
			if( this.options.animation === 'sides' ) {
				
				preCSS.left		= ( pos > this.current ) ? -1 * this.elWidth : this.elWidth;
				animCSS.left	= 0;
			
			}	
			
			// titles animation
			$nextSlide.find('div.ei-title > h2')
					  .css( 'margin-right', 50 + 'px' )
					  .stop()
					  .delay( this.options.speed * this.options.titlesFactor )
					  .animate({ marginRight : 0 + 'px', opacity : 1 }, this.options.titlespeed, this.options.titleeasing )
					  .end()
					  .find('div.ei-title > h3')
					  .css( 'margin-right', -50 + 'px' )
					  .stop()
					  .delay( this.options.speed * this.options.titlesFactor )
					  .animate({ marginRight : 0 + 'px', opacity : 1 }, this.options.titlespeed, this.options.titleeasing )
			
			$.when(
				
				// fade out current titles
				$currentSlide.css( 'z-index' , 1 ).find('div.ei-title > *').stop().fadeOut( this.options.speed / 2, function() {
					// reset style
					$(this).show().css( 'opacity', 0 );	
				}),
				
				// animate next slide in
				$nextSlide.css( preCSS ).stop().animate( animCSS, this.options.speed, this.options.easing ),
				
				// "sliding div" moves to new position
				this.$sliderElem.stop().animate({
					left	: this.$thumbs.eq( pos ).position().left
				}, this.options.speed )
				
			).done( function() {
				
				// reset values
				$currentSlide.css( 'opacity' , 0 ).find('div.ei-title > *').css( 'opacity', 0 );
					_self.current	= pos;
					_self.isAnimating		= false;
				
				});
				
		},
		_initVimeoApi		: function() {
		
			var _self	= this;
		
			var f = $('iframe.vimeo-api-item'),
				url = ($(f).length == 0) ? '' : f.attr('src').split('?')[0],
				status = $('.status');
								
			// Listen for messages from the player
			if (window.addEventListener){
				window.addEventListener('message', onMessageReceived, false);
			}
			else {
				window.attachEvent('onmessage', onMessageReceived, false);
			}

			// Handle messages received from the player
			function onMessageReceived(e) {
				var data = JSON.parse(e.data);
				
				switch (data.event) {
					case 'ready':
						onReady();
						break;
					   
					case 'pause':
						onPause();
						break;
					   
					case 'finish':
						onFinish();
						break;
					
					case 'play':
						onPlay();
						break;
					   
				}
			}

			// Call the API when a button is pressed
			this.$thumbs.on('click', function() {
				post("pause");
			});

			// Helper function for sending a message to the player
			function post(action, value) {
				var data = { method: action };
				
				if (value) {
					data.value = value;
				}
				
				$(f).each(function(index) {				
					f[index].contentWindow.postMessage(JSON.stringify(data), url);
				});
			}

			function onReady() {
				post('addEventListener', 'play');
				post('addEventListener', 'pause');
				post('addEventListener', 'finish');				
			}
			
			function onPlay() {
				
				// hide captions
				$(_self.$imgItems[_self.current]).find('div.ei-title > *').hide();
				
				if( _self.options.autoplay ) {
					_self.videoIsPlaying = true;
					clearTimeout( _self.slideshow );
					_self.options.autoplay	= false;
				
				}
			}

			function onPause() {
				
			}

			function onFinish() {
				
			}

		
		},		
		_initYouTubeApi		: function() {
			
			var _self	= this,
				ytf 		= $('iframe.youtube-api-item');
				
			$('.fluid-width-video-wrapper').attr('id','fitvid-id');
	
		 	/**
			 * @author       Rob W <gwnRob@gmail.com>
			 * @website      http://stackoverflow.com/a/7513356/938089
			 * @version      20120724
			 * @description  Executes function on a framed YouTube video (see website link)
			 *               For a full list of possible functions, see:
			 *               https://developers.google.com/youtube/js_api_reference
			 * @param String frame_id The id of (the div containing) the frame
			 * @param String func     Desired function to call, eg. "playVideo"
			 *        (Function)      Function to call when the player is ready.
			 * @param Array  args     (optional) List of arguments to pass to function func*/
			function callPlayer(frame_id, func, args) {
				if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
				
				var iframe = document.getElementById(frame_id);
				if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
					iframe = iframe.getElementsByTagName('iframe')[0];
				}
				   
				// When the player is not ready yet, add the event to a queue
				// Each frame_id is associated with an own queue.
				// Each queue has three possible states:
				//  undefined = uninitialised / array = queue / 0 = ready
				if (!callPlayer.queue) callPlayer.queue = {};
				var queue = callPlayer.queue[frame_id],
					domReady = document.readyState == 'complete';

				if (domReady && !iframe) {
					// DOM is ready and iframe does not exist. Log a message
					if (queue) clearInterval(queue.poller);
				} else if (func === 'listening') {
					// Sending the "listener" message to the frame, to request status updates
					if (iframe && iframe.contentWindow) {
						func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';
						iframe.contentWindow.postMessage(func, '*');
						
					}
				} else if (!domReady || iframe && (!iframe.contentWindow || queue && !queue.ready)) {
					if (!queue) queue = callPlayer.queue[frame_id] = [];
					queue.push([func, args]);
					if (!('poller' in queue)) {
						// keep polling until the document and frame is ready
						queue.poller = setInterval(function() {
							callPlayer(frame_id, 'listening');
						}, 250);
						// Add a global "message" event listener, to catch status updates:
						messageEvent(1, function runOnceReady(e) {
							var tmp = JSON.parse(e.data);
							if (tmp && tmp.id == frame_id && tmp.event == 'onReady') {
								// YT Player says that they're ready, so mark the player as ready
								clearInterval(queue.poller);
								queue.ready = true;
								messageEvent(0, runOnceReady);
								// .. and release the queue:
								while (tmp === queue.shift()) {
									callPlayer(frame_id, tmp[0], tmp[1]);
								}
							}
						}, false);
					}
				} else if (iframe && iframe.contentWindow) {
					// When a function is supplied, just call it (like "onYouTubePlayerReady")
					
					if (func.call) {					
						return func();						
					}
					
					// Frame exists, send message
					iframe.contentWindow.postMessage(JSON.stringify({
						"event": "command",
						"func": func,
						"args": args || [],
						"id": frame_id
					}), "*");
					
				}
				/* IE8 does not support addEventListener... */
				function messageEvent(add, listener) {
					var w3 = add ? window.addEventListener : window.removeEventListener;
					w3 ?
						w3('message', listener, !1)
					:
						(add ? window.attachEvent : window.detachEvent)('onmessage', listener);
						
				}
				
			}
			
			this.$thumbs.on('click', function() {
				
				// pause all youtube players.
				$(ytf).each(function(index) {
					//current iframe
					var curIframe = document.getElementById($(ytf[index]).attr('id'));
					//check if ready
					if(curIframe && curIframe.contentWindow) {
						callPlayer($(ytf[index]).attr('id') + '-wrap', 'pauseVideo');
						
					}
					
				});				
				
				//callPlayer($(this).data('eithumb') + '-yt-wrap', 'playVideo');
						
			
			});
					
			// youtube onclick of screenshot
			$('.youtube-play-icon, .youtube-play-screen').click( function( event ) {
			
				event.preventDefault();
				
				var ytCaptions = $(this).closest('.youtube-video-slide').next('.ei-title'),
					ytScreen = $(this).closest('.youtube-screen-overlay').find('.youtube-play-screen'),
					ytPlayerID = $(this).closest('.youtube-video-slide').attr("id");
					
				// hide captions
				$(ytCaptions).hide();
			
				// hide screenshot
				$(ytScreen).hide( "slow" );
				
				// stop slideshow
				if( _self.options.autoplay ) {
					_self.videoIsPlaying = true;
					clearTimeout( _self.slideshow );
					_self.options.autoplay	= false;
				}				
				// start video
				callPlayer(ytPlayerID, 'playVideo');						
				
			});
				
		},
		_initEvents			: function() {
			
			var _self	= this;
			
			// window resize
			$(window).on( 'smartresize.eislideshow', function( event ) {
				
				// resize the images
				//_self._setImagesSize();
			
				// reset position of thumbs sliding div
				_self.$sliderElem.css( 'left', _self.$thumbs.eq( _self.current ).position().left );
			
				
			});
			
			// click the thumbs
			this.$thumbs.on( 'click.eislideshow', function( event ) {
				
				if( _self.options.autoplay ) {
				
					clearTimeout( _self.slideshow );
					_self.options.autoplay	= false;
				
				}
				
				var $thumb	= $(this),
					idx		= $thumb.index() - 1; // exclude sliding div
					
				_self._slideTo( idx );
				
				return false;
			
			});
			
		}
	};
	
	var logError 				= function( message ) {
		
		if ( this.console ) {
			
			console.error( message );
			
		}
		
	};
	
	$.fn.eislideshow			= function( options ) {
	
		if ( typeof options === 'string' ) {
		
			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {
			
				var instance = $.data( this, 'eislideshow' );
				
				if ( !instance ) {
					logError( "cannot call methods on eislideshow prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for eislideshow instance" );
					return;
				}
				
				instance[ options ].apply( instance, args );
			
			});
		
		} 
		else {
		
			this.each(function() {
			
				var instance = $.data( this, 'eislideshow' );
				if ( !instance ) {
					$.data( this, 'eislideshow', new $.Slideshow( options, this ) );
				}
			
			});
		
		}
		
		return this;
		
	};
	
})( window, jQuery );