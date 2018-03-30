(function($) {
	'use strict';

    $('.mk-edge-slider').find('video').each(function() {
        this.pause();
        this.currentTime = 0;
    });

	MK.component.EdgeSlider = function( el ) {
		var self = this,
			$this = $( el ), 
            $window = $(window),
            $wrapper = $this.parent(),
			config = $this.data( 'edgeslider-config' ),
            $nav = $( config.nav ),
            $prev = $nav.find( '.mk-edge-prev' ),
            $prevTitle = $prev.find( '.nav-item-caption' ),
            $prevBg = $prev.find('.edge-nav-bg'),
            $next = $nav.find( '.mk-edge-next' ),
            $nextTitle = $next.find( '.nav-item-caption' ),
            $nextBg = $next.find('.edge-nav-bg'),
            $navBtns = $nav.find( 'a' ),  
            $pagination = $( '.swiper-pagination' ),
            $skipBtn = $( '.edge-skip-slider' ),
            $opacityLayer = $this.find('.edge-slide-content'),
            $videos = $this.find('video'),
            currentSkin = null,
            currentPoint = null,
            winH = null,
            opacity = null,
            offset = null;

        var callbacks = { 
    		onInitialize : function( slides ) {
    			self.$slides = $( slides );
				
				self.slideContents = $.map( self.$slides, function( slide ) {
					var $slide = $( slide ),
						title = $slide.find('.edge-slide-content .edge-title').first().text(),
						skin = $slide.attr("data-header-skin"),
						image = $slide.find('.mk-section-image').css('background-image') || 
								$slide.find('.mk-video-section-touch').css('background-image'),
						bgColor = $slide.find('.mk-section-image').css('background-color');


					return {
						skin: skin,
						title: title,
						image: image,
						bgColor: bgColor
					};
				});

                // Set position fixed here rather than css to avoid flash of strangely styled slides befor plugin init
                if(MK.utils.isSmoothScroll) $this.css('position', 'fixed');

				setNavigationContent( 1, self.$slides.length - 1 );
				setSkin( 0 );
                // stopVideos();
                playVideo(0);

                setTimeout( function() {
                    $( '.edge-slider-loading' ).fadeOut( '100' );
                }, 1000 );
    		},

            onBeforeSlide : function( id ) {
                
            },

    		onAfterSlide : function( id ) {
    			setNavigationContent( nextFrom(id), prevFrom(id) );
    			setSkin( id );   
                stopVideos(); // stop all others if needed
                playVideo( id );
    		}
    	};


        var nextFrom = function nextFrom(id) {
            return ( id + 1 === self.$slides.length ) ? 0 : id + 1;
        };


        var prevFrom = function prevFrom(id) {
            return ( id - 1 === -1 ) ? self.$slides.length - 1 : id - 1;
        };


        var setNavigationContent = function( nextId, prevId ) {
            if(self.slideContents[ prevId ]) {
        		$prevTitle.text( self.slideContents[ prevId ].title );
        		$prevBg.css( 'background', 
        			self.slideContents[ prevId ].image !== 'none' ? 
        				self.slideContents[ prevId ].image :
        				self.slideContents[ prevId ].bgColor );
            }

            if(self.slideContents[ nextId ]) {
        		$nextTitle.text( self.slideContents[ nextId ].title ); 
        		$nextBg.css( 'background', 
        			self.slideContents[ nextId ].image !== 'none' ? 
        				self.slideContents[ nextId ].image :
        				self.slideContents[ nextId ].bgColor );
            }
        };


        var setSkin = function setSkin( id ) {  
        	currentSkin = self.slideContents[ id ].skin;

          	$navBtns.attr('data-skin', currentSkin);
          	$pagination.attr('data-skin', currentSkin);
         	$skipBtn.attr('data-skin', currentSkin); 

         	if( self.config.firstEl ) {
         		MK.utils.eventManager.publish( 'firstElSkinChange', currentSkin );
         	}
        };


        var stopVideos = function stopVideos() {
            $videos.each(function() {
                this.pause();
                this.currentTime = 0;
            });
        };


        var playVideo = function playVideo(id) {
            var video = self.$slides.eq(id).find('video').get(0);
            if(video) {
                video.play();
                console.log('play video in slide nr ' + id);
            }

        };


        var onResize = function onResize() {
            var height = $wrapper.height();
            $this.height( height );

            var width = $wrapper.width();
            $this.width( width );

            winH = $window.height();
            offset = $this.offset().top;

            if(!MK.utils.isSmoothScroll) return; 
            if(MK.utils.isResponsiveMenuState()) {
                // Reset our parallax layers position and styles when we're in responsive mode
                $this.css({
                    '-webkit-transform': 'translateZ(0)',
                    '-moz-transform': 'translateZ(0)',
                    '-ms-transform': 'translateZ(0)',
                    '-o-transform': 'translateZ(0)',
                    'transform': 'translateZ(0)',
                    'position': 'absolute'
                });
                $opacityLayer.css({
                    'opacity': 1
                });
            } else {
                // or proceed with scroll logic when we assume desktop screen
                onScroll();
            }
        };

        var onScroll = function onScroll() {
            currentPoint = - MK.val.scroll();

            if( offset + currentPoint <= 0 ) {
                opacity = 1 + ((offset + currentPoint) / winH) * 2;
                opacity = Math.min(opacity, 1);
                opacity = Math.max(opacity, 0);

                $opacityLayer.css({
                    opacity: opacity
                });
            }

            $this.css({
                '-webkit-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                '-moz-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                '-ms-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                '-o-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                'transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                'position': 'fixed'
            });  
        };

        onResize();
        $window.on('load', onResize);
        $window.on('resize', onResize);
        window.addResizeListener( $wrapper.get(0), onResize );

        if(MK.utils.isSmoothScroll) {
            onScroll();
            $window.on('scroll', function() {
                if(MK.utils.isResponsiveMenuState()) return;
                window.requestAnimationFrame(onScroll);
            });
        }

		this.el = el;
		this.config = $.extend( config, callbacks );
		this.slideContents = null; // cache slide contents
	};

	MK.component.EdgeSlider.prototype = {
		init : function() {
			// Inherit from Slider. add prototypes if needed
			var slider = new MK.ui.Slider( this.el, this.config );
			slider.init();
		}
	};

})(jQuery);