/**
 * jQuery slicebox plugin
 * http://www.codrops.com/
 *
 * Copyright 2011, Pedro Botelho
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Date: Thu Sep 5 2011
 */
(function( window, $, undefined ) {
	
	// ======================= imagesLoaded Plugin ===============================
	// https://github.com/desandro/imagesloaded

	// $('#my-container').imagesLoaded(myFunction)
	// execute a callback when all images have loaded.
	// needed because .load() doesn't work on cached images

	// callback function gets image collection as argument
	//  this is the container

	// original: mit license. paul irish. 2010.
	// contributors: Oren Solomianik, David DeSandro, Yiannis Chatzikonstantinou

	$.fn.imagesLoaded 			= function( callback ) {
		var $images = this.find('img'),
			len 	= $images.length,
			_this 	= this,
			blank 	= 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';

		function triggerCallback() {
			callback.call( _this, $images );
		}

		function imgLoaded() {
			if ( --len <= 0 && this.src !== blank ){
				setTimeout( triggerCallback );
				$images.unbind( 'load error', imgLoaded );
			}
		}

		if ( !len ) {
		    triggerCallback();
		}

		$images.bind( 'load error',  imgLoaded ).each( function() {
		    // cached images don't fire load sometimes, so we reset src.
		    if (this.complete || this.complete === undefined){
				var src = this.src;
				// webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
				// data uri bypasses webkit log warning (thx doug jones)
				this.src = blank;
				this.src = src;
		    }
		});

		return this;
	};
	
	$.slicebox 					= function( options, element ) {
		this.$element 	= $( element );
		this._create( options );
	};
	
	$.slicebox.defaults 		= {
		orientation			: 'v',		// (v)ertical or (h)orizontal.
		perspective			: 1200,		// -webkit-perspective value.
		slicesCount			: 1,		// needs to be an odd number  15 => number > 0 (if you want the limit higher, change the _validate function).
		disperseFactor		: 0,		// each slice will move x pixels left / top (depending on orientation). The middle slice doesn't move. the middle slice's neighbors will move disperseFactor pixels.
		colorHiddenSides	: '#222',	// color of the hidden sides.
		sequentialRotation	: false,	// the animation will start from left to right. The left most slice will be the first one to rotate.
		sequentialFactor	: 0,		// if sequentialRotation is true this will be the interval between each rotation in ms.
		speed3d				: 800,		// animation speed3d.
		speed				: 600,		// fallback speed. You might want to set a different speed for the fallback animation...
		fallbackEasing		: 'easeOutExpo', // fallback easing.
		slideshow			: false,	// if true the box will be rotating automatically.
		slideshowTime		: 2000		// interval for the slideshow in ms.
    };
	
	$.slicebox.prototype 		= {
		_create 			: function( options ) {
			var instance 			= this;
			
			instance.options 		= $.extend( true, {}, $.slicebox.defaults, options );
			
			instance._validate( instance.options );
			
			var $images				= instance.$element.children('img');
			
			// preload the images
			instance.$element.imagesLoaded( function() {
				if( Modernizr.csstransforms3d ) {
					instance.box = new $.Box3d( instance.options, $images, instance.$element );
					$images.remove();
				}	
				else
					instance.box = new $.Box( instance.options, $images, instance.$element );
			});
		},
		add					: function( $images, callback ) {
			this.box.addImages( $images );
			$images.remove();
			if ( callback ) callback.call( $images );
		},
		_validate			: function( options ) {
			if( Modernizr.csstransforms3d ) {
			/*
			remove these three lines if you don't want to limit the number of slices (not sure if it works fine..)
			*/
			if( options.slicesCount < 0 ) options.slicesCount = 1;
			else if( options.slicesCount > 15 ) options.slicesCount = 15;	
			else if( options.slicesCount %2 === 0 ) options.slicesCount++;
			
			if( options.disperseFactor < 0 ) options.disperseFactor = 0;
			}
			if( options.orientation !== 'v' && options.orientation !== 'h' ) options.orientation = 'v';
		},
		destroy				: function( callback ) {
			this._destroy( callback );
		},
		_destroy 			: function( callback ) {
			this.element.unbind('.slicebox').removeData('slicebox');

			$(window).unbind('.slicebox');
			
			if ( callback ) callback.call();
		},
		option				: function( key, value ) {
			if ( $.isPlainObject( key ) ){
				this.options = $.extend( true, this.options, key );
			} 
		}
	};
	
	/*********************************** 3d Box ********************************************************/
	
	$.Box3d 						= function( options, $images, $wrapper ) {
		this.size			= {					// assuming all images with same size
			width	: $images.width(),
			height	: $images.height()
		};
		this.slices			= new Array();
		this.animating		= false;
		this.$images		= $images;
		this.imagesCount	= this.$images.length;
		this.imageCurrent	= 0;
		this.orientation	= options.orientation;
		this.wrapper		= $wrapper;
		this.info			= false;
		
		this._createBox( options );
		this._configureSlices( options );
		
		if( options.slideshow ) {
			this.isSlideshowActive	= true;
			this._slideshow( options );
			
			this.OptionPlay.addClass('rb-nav-pause').removeClass('sb-nav-play');
		}
	};
	
	$.Box3d.prototype 				= {
		_createBox 			: function( options ) {
			var boxStyle			= {
					'width'							: this.size.width + 'px',
					'height'						: this.size.height + 'px',
					'z-index'						: 10,
					'position'						: 'relative',
					'-webkit-perspective'			: options.perspective
				};
			
			this.$box				= $('<div>').css( boxStyle ).appendTo( this.wrapper.css({
				width 	: boxStyle.width, 
				height 	: boxStyle.height 
			})); 
			
			// add navigation and options buttons
			this._addNavigation();
			this._addOptions();
			$('<div class="sb-shadow"/>').appendTo( this.wrapper );
			this._initEvents( options );
			
			for( var i = 0; i < options.slicesCount; ++i ) {
				
				var Slice3d	= new $.Slice3d( options, this.size, this.orientation ),
					$slice	= Slice3d.createSlice( options, i, this.$images );
				
				this.slices.push( Slice3d );
					
				$slice.appendTo( this.$box );
			}
			
			// again set sizes
			this._setSize( options );
		},
		_addNavigation		: function() {
			this.NavPrev 	= $('<span class="sb-nav-prev">Previous Slide</span>');
			this.NavNext 	= $('<span class="sb-nav-next">Next Slide</span>');
			
			var $sbNav		= $('<div class="sb-nav">').append( this.NavPrev ).append( this.NavNext );
			
			this.wrapper.append( $sbNav );
		},
		_addOptions			: function() {
			this.OptionPlay	= $('<span class="sb-nav-play">Autoplay</span>');
			this.OptionInfo	= $('<span class="sb-nav-info">Info</span>');
			
			var $sbNav		= $('<div class="sb-options">').append( this.OptionPlay ).append( this.OptionInfo );
			
			this.wrapper.append( $sbNav );
		},
		_initEvents			: function( options ) {
			var instance 			= this;
			instance.NavNext.bind('click.slicebox', function( event ) {
				instance.navigate( 'next', options );
			});
			instance.NavPrev.bind('click.slicebox', function( event ) {
				instance.navigate( 'prev', options );
			});
			instance.OptionPlay.bind('click.slicebox', function( event ) {
				if( !instance.isSlideshowActive ) {
					if( instance.animating ) return false;
				
					instance.isSlideshowActive	= true;
					
					instance._slideshow( options, true );
					
					instance.OptionPlay.addClass('rb-nav-pause').removeClass('sb-nav-play');
				}
				else {
					instance._stopSlideshow();
				}
			});
			instance.OptionInfo.bind('click.slicebox', function( event ) {
				if( !instance.info ) {
					instance._showInfo();
				}
				else {
					instance._hideInfo();
				}
			});
		},
		_showInfo			: function() {
			if( this.animating ) return false;
			
			this._stopSlideshow();
			
			var title	= this.$images.eq(this.imageCurrent).attr('title');
			$('<div class="sb-title"><span>' + title + '</span></div>').appendTo( this.wrapper ).stop().animate({
				height : '38px',
				bottom:'0px'
			}, 300);
			this.OptionInfo.addClass('sb-nav-noinfo').removeClass('sb-nav-info');
			this.info	= true;
		},
		_hideInfo			: function() {
			if( this.animating ) return false;
			this.wrapper.find('div.sb-title').remove();
			this.OptionInfo.addClass('sb-nav-info').removeClass('sb-nav-noinfo');
			this.info	= false;
		},
		_setSize			: function( options ) {
			if( this.orientation === 'v' ) {
				var newWidth	= Math.floor( this.size.width / options.slicesCount ) * options.slicesCount + 'px';
				this.$box.css( 'width' , newWidth );
				this.wrapper.css( 'width' , newWidth );
			}	
			else {
				var newHeight	= Math.floor( this.size.height / options.slicesCount ) * options.slicesCount + 'px' 
				this.$box.css( 'height' , newHeight );
				this.wrapper.css( 'height' , newHeight );
			}	
		},
		_configureSlices	: function( options ) {
			var middlepos	= Math.ceil( options.slicesCount / 2 ),
				instance	= this;
			
			for( var i = 0, len = instance.slices.length; i < len; ++i ) {
				var sliceObj	= instance.slices[i],
					$slice		= sliceObj.getEl();
				
				if( i < middlepos ) {
					if( this.orientation === 'v' )
						$slice.css({
							zIndex 	: ( i + 1 ) * 100,
							left	: sliceObj.size.width * i + 'px',
							top		: '0px'
						});
					else if( this.orientation === 'h' )
						$slice.css({
							zIndex 	: ( i + 1 ) * 100,
							top		: sliceObj.size.height * i + 'px',
							left	: '0px'
						});
				}	
				else {
					if( this.orientation === 'v' )
						$slice.css({
							zIndex 	: (options.slicesCount - i) * 100,
							left	: sliceObj.size.width * i + 'px',
							top		: '0px'
						});
					else
						$slice.css({
							zIndex 	: (options.slicesCount - i)*100,
							top		: sliceObj.size.height * i + 'px',
							left	: '0px'
						});
				}
				
				sliceObj.disperseFactor	= options.disperseFactor * ( ( i + 1 ) - middlepos );
				
			}
		},
		navigate			: function( dir, options ) {
			var instance	= this;
			if( instance.animating ) return false;
			
			instance._stopSlideshow();
			
			if( instance.info )
				instance._hideInfo();
			
			instance.animating			= true;
			
			this._rotateBox( dir, options );
		},
		_rotateBox			: function( dir, options, callback ) {
			var instance	= this;
			
			if( dir === 'next') {
				if( instance.imageCurrent < instance.imagesCount - 1 )
					++instance.imageCurrent;
				else
					instance.imageCurrent = 0;
			} 
			else if( dir === 'prev') {
				if( instance.imageCurrent < 1 )
					instance.imageCurrent	= instance.imagesCount - 1;
				else
					--instance.imageCurrent;
			}
			
			for( var i = 0, len = instance.slices.length; i < len; ++i ) {
				var sliceObj	= instance.slices[i];
				
				sliceObj.rotate( dir, i, options, instance.$images, instance.imageCurrent, function( i ) {
					if( i === options.slicesCount - 1 ) {
						instance.animating	= false;
						if( callback ) callback.call();
					}	
				});
			}
		},
		addImages			: function( $images, callback ) {
			this.$images 		= this.$images.add( $images );
			this.imagesCount	= this.$images.length;
			if ( callback ) callback.call( $images );
		},
		_slideshow			: function( options, startNow ) {
			if( !this.isSlideshowActive ) return false;
			
			clearTimeout( this.slideshowT );
			var instance = this;
			if( startNow ) instance._slideshowFunc( options );
			instance.slideshowT	= setTimeout( function() {
				instance._slideshowFunc( options );
			}, options.slideshowTime );
		},
		_slideshowFunc		: function( options ) {
			var instance = this;
			if( instance.info )
				instance._hideInfo();
			instance.animating			= true;	
			instance._rotateBox( 'next', options, function() {
				instance._slideshow( options );
			});
		},
		_stopSlideshow		: function() {
			this.isSlideshowActive	= false;
			clearTimeout( this.slideshowT );
			this.OptionPlay.addClass('sb-nav-play').removeClass('rb-nav-pause');
		}
	};
	
	/*********************************** Slice ********************************************************/
	
	$.Slice3d 						= function( options, boxsize, orientation ) {
		this.orientation		= orientation;
		this._setSize( options, boxsize, orientation );
		
		this.side				= 1;
		this._configureStyles( options );		
	};
	
	$.Slice3d.prototype 			= {
		_configureStyles	: function( options ) {
			// style for the slice
			this.style				= {
				'width'							: this.size.width + 'px',
				'height'						: this.size.height + 'px',
				'position'						: 'absolute',
				'-webkit-transform-style'		: 'preserve-3d',
				'-webkit-transition'			: '-webkit-transform ' + options.speed3d + 'ms',
				'-webkit-backface-visibility'	: 'hidden'
			};
			
			if( this.orientation === 'v' ) {
				this.animationStyles	= {
					side1	: { '-webkit-transform'	: 'translate3d( 0, 0, -' + ( this.size.height / 2 ) + 'px )' },
					side2	: { '-webkit-transform'	: 'translate3d( 0, 0,  -' + ( this.size.height / 2 ) + 'px ) rotate3d( 1, 0, 0, -90deg )' },
					side3	: { '-webkit-transform'	: 'translate3d( 0, 0,  -' + ( this.size.height / 2 ) + 'px ) rotate3d( 1, 0, 0, -180deg )' },
					side4	: { '-webkit-transform'	: 'translate3d( 0, 0,  -' + ( this.size.height / 2 ) + 'px ) rotate3d( 1, 0, 0, -270deg )' }
				};
				this.sidesStyles		= {
					frontSideStyle		: {
						'width'				: this.size.width + 'px', 
						'height'			: this.size.height + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 0, 1, 0, 0deg ) translate3d( 0, 0, ' + ( this.size.height / 2 ) + 'px )'
					},
					backSideStyle		: {
						'width'				: this.size.width + 'px', 
						'height'			: this.size.height + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 0, 1, 0, 180deg ) translate3d( 0, 0, ' + ( this.size.height / 2 ) + 'px ) rotateZ( 180deg )'
					},
					rightSideStyle		: {
						'width'				: this.size.height + 'px',
						'height'			: this.size.height + 'px',
						'left'				: this.size.width / 2 - this.size.height / 2 + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 0, 1, 0, 90deg ) translate3d( 0, 0, ' + ( this.size.width / 2 ) + 'px )'
					},
					leftSideStyle		: {
						'width'				: this.size.height + 'px',
						'height'			: this.size.height + 'px',
						'left'				: this.size.width / 2 - this.size.height / 2 + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 0, 1, 0, -90deg ) translate3d( 0, 0, ' + ( this.size.width / 2 ) + 'px )'
					},
					topSideStyle		: {
						'width'				: this.size.width + 'px',
						'height'			: this.size.height + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 1, 0, 0, 90deg ) translate3d( 0, 0, ' + ( this.size.height / 2 ) + 'px )'
					},
					bottomSideStyle		: {
						'width'				: this.size.width + 'px',
						'height'			: this.size.height + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 1, 0, 0, -90deg ) translate3d( 0, 0, ' + ( this.size.height / 2 ) + 'px )'
					}
				};	
			}
			else if( this.orientation === 'h' ) {
				this.animationStyles	= {
					side1	: { '-webkit-transform'	: 'translate3d( 0, 0, -' + ( this.size.width / 2 ) + 'px )' },
					side2	: { '-webkit-transform'	: 'translate3d( 0, 0, -' + ( this.size.width / 2 ) + 'px ) rotate3d( 0, 1, 0, -90deg )' },
					side3	: { '-webkit-transform'	: 'translate3d( 0, 0, -' + ( this.size.width / 2 ) + 'px ) rotate3d( 0, 1, 0, -180deg )' },
					side4	: { '-webkit-transform'	: 'translate3d( 0, 0, -' + ( this.size.width / 2 ) + 'px ) rotate3d( 0, 1, 0, -270deg )' }
				};
				this.sidesStyles		= {
					frontSideStyle		: {
						'width'				: this.size.width + 'px', 
						'height'			: this.size.height + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 0, 1, 0, 0deg ) translate3d( 0, 0, ' + ( this.size.width / 2 ) + 'px )'
					},
					backSideStyle		: {
						'width'				: this.size.width + 'px', 
						'height'			: this.size.height + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 0, 1, 0, 180deg ) translate3d( 0, 0, ' + ( this.size.width / 2 ) + 'px ) '
					},
					rightSideStyle		: {
						'width'				: this.size.width + 'px',
						'height'			: this.size.height + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 0, 1, 0, 90deg ) translate3d( 0, 0, ' + ( this.size.width / 2 ) + 'px )'
					},
					leftSideStyle		: {
						'width'				: this.size.width + 'px',
						'height'			: this.size.height + 'px',
						'background-color'	: options.colorHiddenSides,
						'-webkit-transform'	: 'rotate3d( 0, 1, 0, -90deg ) translate3d( 0, 0, ' + ( this.size.width / 2 ) + 'px )'
					},
					topSideStyle		: {
						'width'				: this.size.width + 'px',
						'height'			: this.size.width + 'px',
						'background-color'	: options.colorHiddenSides,
						'top'				: this.size.height / 2 - this.size.width / 2,
						'-webkit-transform'	: 'rotate3d( 1, 0, 0, 90deg ) translate3d( 0, 0, ' + ( this.size.height / 2 ) + 'px )'
					},
					bottomSideStyle		: {
						'width'				: this.size.width + 'px',
						'height'			: this.size.width + 'px',
						'background-color'	: options.colorHiddenSides,
						'top'				: this.size.height / 2 - this.size.width / 2,
						'-webkit-transform'	: 'rotate3d( 1, 0, 0, -90deg ) translate3d( 0, 0, ' + ( this.size.height / 2 ) + 'px )'
					}	
				};
			}
		},
		_setSize			: function( options, boxsize ) {
			if( this.orientation === 'v' )
				this.size				= {
					width	: Math.floor( boxsize.width / options.slicesCount ),
					height	: boxsize.height
				};
			else if( this.orientation === 'h' )
				this.size				= {
					width	: boxsize.width,
					height	: Math.floor( boxsize.height / options.slicesCount )
				};
		},
		createSlice			: function( options, i, $imgs ) {
			
			$slice	= $('<div/>')
				.css( this.style )
				.css( this.animationStyles.side1 )
				.append( $('<div/>').addClass('sb-side').css( this.sidesStyles.frontSideStyle ) )
				.append( $('<div/>').addClass('sb-side').css( this.sidesStyles.backSideStyle ) )
				.append( $('<div/>').addClass('sb-side').css( this.sidesStyles.rightSideStyle ) )
				.append( $('<div/>').addClass('sb-side').css( this.sidesStyles.leftSideStyle ) )
				.append( $('<div/>').addClass('sb-side').css( this.sidesStyles.topSideStyle ) )
				.append( $('<div/>').addClass('sb-side').css( this.sidesStyles.bottomSideStyle ) );
			
			this.element	= $slice;
			
			this._showImage( i , 0, $imgs );
			
			return $slice;
		},
		_showImage			: function( i, imgPos, $imgs ) {
			var faceIdx;
			switch( this.side ) {
				case 1 : 
					faceIdx = 0; 
					break;
				case 2 : 
					if( this.orientation === 'v' )
						faceIdx = 4;
					else if( this.orientation === 'h' )	
						faceIdx = 2;
					break;
				case 3 : 
					faceIdx = 1; 
					break;
				case 4 : 
					if( this.orientation === 'v' )
						faceIdx = 5;
					else if( this.orientation === 'h' )	
						faceIdx = 3;
					break;
			};
			
			var imgParam	= {};
			
			if( this.orientation === 'v' ) {
				imgParam.backgroundImage	= 'url(' + $imgs.eq( imgPos ).attr('src') + ')';
				imgParam.backgroundPosition	= - ( i * this.size.width ) + 'px 0px';
			}
			else if( this.orientation === 'h' )	{
				imgParam.backgroundImage	= 'url(' + $imgs.eq( imgPos ).attr('src') + ')';
				imgParam.backgroundPosition	= '0px -' + ( i * this.size.height ) + 'px';
			}
			
			this.element.children().eq( faceIdx ).css( imgParam );	
		},
		getEl				: function() {
			return this.element;
		},
		rotate				: function( dir, i, options, $imgs, imgCurrent, callback ) {
			var instance		= this,
				classRotation,
				seq				= ( options.sequentialRotation ) ? options.sequentialFactor * i : 0;
			
			setTimeout(function() {
				if( dir === 'next' ) {
					switch( instance.side ) {
						case 1 	: animationStyle = instance.animationStyles.side2; 	instance.side = 2; 	break;
						case 2 	: animationStyle = instance.animationStyles.side3; 	instance.side = 3; 	break;
						case 3 	: animationStyle = instance.animationStyles.side4; 	instance.side = 4; 	break;
						case 4 	: animationStyle = instance.animationStyles.side1;  instance.side = 1; 	break;
					};
				}
				else if( dir === 'prev' ) {
					switch( instance.side ) {
						case 1 	: animationStyle = instance.animationStyles.side4;  instance.side = 4; 	break;
						case 2 	: animationStyle = instance.animationStyles.side1; 	instance.side = 1; 	break;
						case 3 	: animationStyle = instance.animationStyles.side2; 	instance.side = 2; 	break;
						case 4 	: animationStyle = instance.animationStyles.side3; 	instance.side = 3; 	break;
					};
				}
				
				instance._showImage( i, imgCurrent, $imgs );
				
				var animateOut 	= {}, 
					animateIn	= {};
				
				if( instance.orientation === 'v' ) {
					animateOut.left	= '+=' + instance.disperseFactor + 'px';
					animateIn.left	= '-=' + instance.disperseFactor + 'px';
				}
				else if( instance.orientation === 'h' ) {
					animateOut.top	= '+=' + instance.disperseFactor + 'px';
					animateIn.top	= '-=' + instance.disperseFactor + 'px';
				}
				
				instance.element.css( animationStyle )
								.animate( animateOut, options.speed3d/2 - 50 )
					            .animate( animateIn, options.speed3d/2 - 50, function() {
									if( callback ) callback.call( this, i );
								});
								
			}, seq);
		}
	};
	
	
	
	
	/*********************************** Box Fallback ********************************************************/
	
	$.Box 							= function( options, $images, $wrapper ) {
		this.size			= {					// assuming all images with same size
			width	: $images.width(),
			height	: $images.height()
		};
		this.animating		= false;
		this.$images		= $images;
		this.imagesCount	= this.$images.length;
		this.imageCurrent	= 0;
		this.orientation	= options.orientation;
		this.wrapper		= $wrapper;
		this.info			= false;
		
		this._createBox( options );
		this._configureImages( options );
		
		if( options.slideshow ) {
			this.isSlideshowActive	= true;
			this._slideshow( options );
			
			this.OptionPlay.addClass('rb-nav-pause').removeClass('sb-nav-play');
		}
	};
	
	$.Box.prototype 				= {
		_createBox 			: function( options ) {
			var boxStyle			= {
					'width'			: this.size.width + 'px',
					'height'		: this.size.height + 'px',
					'z-index'		: 10,
					'position'		: 'relative',
					'overflow'		: 'hidden'
				};
			
			this.$box				= $('<div>').css( boxStyle ).appendTo( this.wrapper.css({
				width 	: boxStyle.width, 
				height 	: boxStyle.height
			}).addClass('sb-slider-fb')).append( this.$images.show() );
			
			// add navigation and options buttons
			this._addNavigation();
			this._addOptions();	
			$('<div class="sb-shadow"/>').appendTo( this.wrapper );
			this._initEvents( options );
		},
		_configureImages	: function( options ) {
			var instance			= this;
			
			instance.$images.each(function(i) {
				var $img	= $(this);
				
				if( i === 0) {
					$img.css({ left : '0px', top : '0px' });
				}	
				else {
					if( options.orientation === 'v')
						$img.css({ left : '0px', top : - instance.size.height + 'px' });
					else if( options.orientation === 'h')
						$img.css({ left : instance.size.width + 'px', top : '0px' });
				}	
					
			});
		},
		_addNavigation		: function() {
			this.NavPrev 	= $('<span class="sb-nav-prev">Previous Slide</span>');
			this.NavNext 	= $('<span class="sb-nav-next">Next Slide</span>');
			
			var $sbNav		= $('<div class="sb-nav">').append( this.NavPrev ).append( this.NavNext );
			
			this.wrapper.append( $sbNav );
		},
		_addOptions			: function() {
			this.OptionPlay	= $('<span class="sb-nav-play">Autoplay</span>');
			this.OptionInfo	= $('<span class="sb-nav-info">Info</span>');
			
			var $sbNav		= $('<div class="sb-options">').append( this.OptionPlay ).append( this.OptionInfo );
			
			this.wrapper.append( $sbNav );
		},
		_initEvents			: function( options ) {
			var instance 			= this;
			instance.NavNext.bind('click.slicebox', function( event ) {
				instance.navigate( 'next', options );
			});
			instance.NavPrev.bind('click.slicebox', function( event ) {
				instance.navigate( 'prev', options );
			});
			instance.OptionPlay.bind('click.slicebox', function( event ) {
				if( !instance.isSlideshowActive ) {
					if( instance.animating ) return false;
					
					instance.isSlideshowActive	= true;
					
					instance._slideshow( options, true );
					
					instance.OptionPlay.addClass('rb-nav-pause').removeClass('sb-nav-play');
				}
				else {
					instance._stopSlideshow();
				}
			});
			instance.OptionInfo.bind('click.slicebox', function( event ) {
				if( !instance.info ) {
					instance._showInfo();
				}
				else {
					instance._hideInfo();
				}
			});
		},
		_showInfo			: function() {
			if( this.animating ) return false;
			
			this._stopSlideshow();
			
			var title	= this.$images.eq(this.imageCurrent).attr('title');
			$('<div class="sb-title"><span>' + title + '</span></div>').appendTo( this.wrapper ).stop().animate({
				height : '38px',
				bottom:'0px'
			}, 300);
			this.OptionInfo.addClass('sb-nav-noinfo').removeClass('sb-nav-info');
			this.info	= true;
		},
		_hideInfo			: function() {
			if( this.animating ) return false;
			this.wrapper.find('div.sb-title').remove();
			this.OptionInfo.addClass('sb-nav-info').removeClass('sb-nav-noinfo');
			this.info	= false;
		},
		navigate			: function( dir, options ) {
			var instance	= this;
			if( instance.animating ) return false;
			
			instance._stopSlideshow();
	
			if( instance.info )
				instance._hideInfo();
	
			instance.animating			= true;
			
			this._slide( dir, options );
		},
		_slide				: function( dir, options, callback ) {
			var instance	= this,
				$current	= instance.$images.eq( instance.imageCurrent );
			
			if( dir === 'next') {
				if( instance.imageCurrent < instance.imagesCount - 1 )
					++instance.imageCurrent;
				else
					instance.imageCurrent = 0;
			} 
			else if( dir === 'prev') {
				if( instance.imageCurrent < 1 )
					instance.imageCurrent	= instance.imagesCount - 1;
				else
					--instance.imageCurrent;
			}
			
			var animParamOut	= {},
				animParamIn		= {};
			
			if( options.orientation === 'v') {
				animParamOut.top 	= ( dir === 'next' ) ? instance.size.height + 'px' : - instance.size.height + 'px';
				animParamIn.top 	= '0px';
			}
			else if( options.orientation === 'h') {
				animParamOut.left 	= ( dir === 'next' ) ? - instance.size.width + 'px' : instance.size.width + 'px';
				animParamIn.left 	= '0px';
			}
			
			$current.stop().animate(animParamOut, options.speed, options.fallbackEasing );
			
			var $next		= instance.$images.eq( instance.imageCurrent );
			
			if( dir === 'next' ) {
				if( options.orientation === 'v')
					$next.css( 'top', - instance.size.height + 'px' );
				else if( options.orientation === 'h')
					$next.css( 'left', instance.size.width + 'px' );
			}
			else {
				if( options.orientation === 'v')
					$next.css( 'top', instance.size.height + 'px' );
				else if( options.orientation === 'h')
					$next.css( 'left', - instance.size.width + 'px' );
			}
			
			instance.$images.eq( instance.imageCurrent ).stop().animate(animParamIn, options.speed, options.fallbackEasing, function() {
				instance.animating			= false;
				if( callback ) callback.call();
			});
		},
		_slideshow			: function( options, startNow ) {
			if( !this.isSlideshowActive ) return false;
			
			clearTimeout( this.slideshowT );
			var instance = this;
			if( startNow ) instance._slideshowFunc( options );
			instance.slideshowT	= setTimeout( function() {
				instance._slideshowFunc( options );
			}, options.slideshowTime );
		},
		_slideshowFunc		: function( options ) {
			var instance = this;
			if( instance.info )
				instance._hideInfo();
			instance.animating			= true;	
			instance._slide( 'next', options, function() {
				instance._slideshow( options );
			});
		},
		_stopSlideshow		: function() {
			this.isSlideshowActive	= false;
			clearTimeout( this.slideshowT );
			this.OptionPlay.addClass('sb-nav-play').removeClass('rb-nav-pause');
		},
		addImages			: function( $images, callback ) {
			this.$images 		= this.$images.add( $images );
			this.imagesCount	= this.$images.length;
			if ( callback ) callback.call( $images );
		}
	};
	
	var logError 				= function( message ) {
		if ( this.console ) {
			console.error( message );
		}
	};
	
	$.fn.slicebox 				= function( options ) {
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {
				var instance = $.data( this, 'slicebox' );
				if ( !instance ) {
					logError( "cannot call methods on slicebox prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for slicebox instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
		} 
		else {
			this.each(function() {
				var instance = $.data( this, 'slicebox' );
				if ( !instance ) {
					$.data( this, 'slicebox', new $.slicebox( options, this ) );
				}
			});
		}
		return this;
	};
	
})( window, jQuery );