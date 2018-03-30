/*
 * responsive-carousel
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function($) {

	var pluginName = "rotator",
		initSelector = "." + pluginName,
		transitionAttr = "data-transition",
		transitioningClass = pluginName + "-transitioning",
		wrapperClass = pluginName + "-wrapper",
		itemClass = pluginName + "-item",
		activeClass = pluginName + "-active",
		prevClass = pluginName + "-item-prev",
		nextClass = pluginName + "-item-next",
		inClass = pluginName + "-in",
		outClass = pluginName + "-out",
		navClass =  pluginName + "-nav",
		cssTransitionsSupport = (function(){
			var prefixes = "t webkitT MozT OT MsT".split( " " ),
				supported = false,
				property;

			while( prefixes.length ){
				property = prefixes.shift() + "ransition";

				if ( property in document.documentElement.style !== undefined && property in document.documentElement.style !== false ) {
					supported = true;
					break;
				}
			}
			return supported;
		}()),
		methods = {
			_create: function(){
				$( this )
					.trigger( "beforecreate." + pluginName )
					[ pluginName ]( "_init" )
					[ pluginName ]( "_addNextPrev" )
					.trigger( "create." + pluginName );
			},

			_init: function(){
				var trans = $( this ).attr( transitionAttr );

				if( !trans ){
					cssTransitionsSupport = false;
				}

				$( this )
					.wrap('<div class="' + wrapperClass + '" />')
					.addClass(
						pluginName +
						" " + ( trans ? pluginName + "-" + trans : "" ) + " "
					)
					.children()
					.addClass( itemClass )
					.first()
					.addClass( activeClass );

				$(this)[ pluginName ]( "_fixHeights" );
				// $(this)[ pluginName ]( "_on_resize" );
				// $(this)[ pluginName ]( "_addNextPrevClasses" );
			},

			_addNextPrevClasses: function(){
				var $items = $( this ).find( "." + itemClass ),
					$active = $items.filter( "." + activeClass ),
					$next = $active.next( "." + itemClass ),
					$prev = $active.prev( "." + itemClass );

				if( !$next.length ){
					$next = $items.first().not( "." + activeClass );
				}
				if( !$prev.length ){
					$prev = $items.last().not( "." + activeClass );
				}

				$items.removeClass( prevClass + " " + nextClass );
				$prev.addClass( prevClass );
				$next.addClass( nextClass );

			},

			next: function(){
				$( this )[ pluginName ]( "goTo", "+1" );
			},

			prev: function(){
				$( this )[ pluginName ]( "goTo", "-1" );
			},

			goTo: function( num ){

				var $self = $(this).find("." + pluginName),
					trans = $self.attr( transitionAttr ),
					// afterClass = " " + pluginName + "-" + trans + "-after",
					afterClass = ' after',
					reverseClass = " " + pluginName + "-" + trans + "-reverse";

				$self.removeClass( afterClass );
				// clean up children
				$( this ).find( "." + itemClass ).removeClass( [ outClass, inClass, reverseClass, afterClass ].join( " " ) );

				var $from = $( this ).find( "." + activeClass ),
					prevs = $from.index(),
					activeNum = ( prevs < 0 ? 0 : prevs ) + 1,
					nextNum = typeof( num ) === "number" ? num : activeNum + parseFloat(num),
					$to = $( this ).find( ".rotator-item" ).eq( nextNum - 1 ),
					reverse = ( typeof( num ) === "string" && !(parseFloat(num)) ) || nextNum > activeNum ? "" : reverseClass;

				if( !$to.length ){
					$to = $( this ).find( "." + itemClass )[ reverse.length ? "last" : "first" ]();
				}

				if( cssTransitionsSupport ){
					$self[ pluginName ]( "_transitionStart", $from, $to, reverse );
				} else {
					$to.addClass( activeClass );
					$self[ pluginName ]( "_transitionEnd", $from, $to, reverse );
				}

				// added to allow pagination to track
				$self.trigger( "goto." + pluginName, $to );
			},

			update: function(){
				$(this).children().not( "." + navClass ).addClass( itemClass );

				return $(this).trigger( "update." + pluginName );
			},

			_fixHeights: function(){

				// Execute only for multi-column rotators.
				// This is because of errors in the resize/fixHeight function on 1 column displays. 
				// It shouldn't be necessary and needs to be looked at for an alternative by fixing 
				// the height/resize function instead.

				if (! $( this ).hasClass('rotator-columns-1') ) { 
					var $self    = $(this).find("." + pluginName),
						$items   = $( this ).find( ".single-item" ),
						$imgs    = $( this ).find('img'),
						count    = $imgs.length;
					
					// Check for images loaded
					$imgs.load(function() {
						count--;
						if (!count) {
							// Find the heights of the items
							$items.css('min-height','auto');
							var heights = $items.map(function() {
								return $(this).outerHeight() || $(this).attr('height'); // if height() returns 0 use tag attribute
							}).get();
							
							// Apply min-height attributs with largest image height (take extra 1px to be safe)
							$items.css('min-height',Math.max.apply( Math, heights )+1+'px');
						}
					}).filter(function() { return this.complete; }).load();
				}
			},

			_on_resize: function(){
				
				var $self = $( this ),
					$win = $( window ),
					win_w = $win.width(),
					win_h = $win.height(),
					timeout;

				$win.on( "resize", function( e ){
					
					// IE wants to constantly run resize for some reason
					// Let’s make sure it is actually a resize event
					var win_w_new = $win.width(),
						win_h_new = $win.height();
					
					if( win_w !== win_w_new ||
						win_h !== win_h_new )
					{
						// timer shennanigans
						clearTimeout(timeout);
						timeout = setTimeout( function(){
							$self[ pluginName ]( "_fixHeights" );
						}, 200 );
						
						// Update the width and height
						win_w = win_w_new;
						win_h = win_h_new;
					}
				});
			},

			_transitionStart: function( $from, $to, reverseClass ){
				var $self = $(this);

				$to.one( navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ? "webkitTransitionEnd" : "transitionend otransitionend", function(){
					$self[ pluginName ]( "_transitionEnd", $from, $to, reverseClass );
				});

				$(this).removeClass( 'after' );
				$(this).addClass( reverseClass );
				$from.addClass( outClass );
				$to.addClass( inClass );
			},

			_transitionEnd: function( $from, $to, reverseClass ){
				afterClass = (reverseClass) ? '' : 'after';
				// console.log(reverseClass, afterClass);
				$( this ).removeClass( reverseClass ).addClass( afterClass );
				$from.removeClass( outClass + " " + activeClass );
				$to.removeClass( inClass ).addClass( activeClass );
				// $( this )[ pluginName ]( "_addNextPrevClasses" );
			},

			_bindEventListeners: function(){
				var $elem = $( this ).parent()
					.bind( "click", function( e ){
						var targ = $( e.target ).closest( "a[href='#next'],a[href='#prev']" );
						if( targ.length ){
							$elem[ pluginName ]( targ.is( "[href='#next']" ) ? "next" : "prev" );
							e.preventDefault();
						}
					});

				return this;
			},

			_addNextPrev: function(){
				return $( this )
					.after( "<nav class='"+ navClass +"'><a href='#prev' class='prev' aria-hidden='true' title='Previous'>Prev</a><a href='#next' class='next' aria-hidden='true' title='Next'>Next</a></nav>" )
					[ pluginName ]( "_bindEventListeners" );
			},

			destroy: function(){
				// TODO
			}
		};

	// Collection method.
	$.fn[ pluginName ] = function( arrg, a, b, c ) {
		return this.each(function() {

			// if it's a method
			if( arrg && typeof( arrg ) === "string" ){
				return $.fn[ pluginName ].prototype[ arrg ].call( this, a, b, c );
			}

			// don't re-init
			if( $( this ).data( pluginName + "data" ) ){
				return $( this );
			}

			// otherwise, init
			$( this ).data( pluginName + "active", true );
			$.fn[ pluginName ].prototype._create.call( this );
		});
	};
	
	// add methods
	$.extend( $.fn[ pluginName ].prototype, methods ); 

}(jQuery));



/*
 * responsive-carousel pagination extension
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function( $, undefined ) {
	var pluginName = "rotator",
		initSelector = "." + pluginName + "[data-paginate]",
		paginationClass = pluginName + "-pagination",
		activeClass = pluginName + "-active-page",
		paginationMethods = {
			_createPagination: function(){
				var nav = $( this ).siblings( "." + pluginName + "-nav" ),
					items = $( this ).find( "." + pluginName + "-item" ),
					pNav = $( "<ol class='" + paginationClass + "'></ol>" ),
					num, thumb, content;

				// remove any existing nav
				nav.find( "." + paginationClass ).remove();

				items.each(function(i){
						num = i + 1;
						thumb = $( this ).attr( "data-thumb" );
						content = num;
						if( thumb ){
							content = "<img src='" + thumb + "' alt=''>";
						}
						pNav.append( "<li><a href='#" + num + "' title='Go to slide " + num + "'>" + content + "</a>" );
				});

				if( thumb ){
					pNav.addClass( pluginName + "-nav-thumbs" );
				}

				nav
					.addClass( pluginName + "-nav-paginated" )
					.find( "a" ).first().before( pNav );
			},
			_bindPaginationEvents: function(){
				$( this ).parent()
					.bind( "click", function( e ){
						var pagLink = $( e.target );

						if( e.target.nodeName === "IMG" ){
							pagLink = pagLink.parent();
						}

						pagLink = pagLink.closest( "a" );
						var href = pagLink.attr( "href" );
						
						if( pagLink.closest( "." + paginationClass ).length && href ){
							$( this )[ pluginName ]( "goTo", parseFloat( href.split( "#" )[ 1 ] ) );
							e.preventDefault();
						}
					} )
					// update pagination on page change
					.bind( "goto." + pluginName, function( e, to  ){
						var index = to ? $( to ).index() : 0;
						$( this ).find( "ol." + paginationClass + " li" )
							.removeClass( activeClass )
							.eq( index )
								.addClass( activeClass );
					} )
					// initialize pagination
					.trigger( "goto." + pluginName );
			}
		};
			
	// add methods
	$.extend( $.fn[ pluginName ].prototype, paginationMethods ); 
	
	// create pagination on create and update
	$( document )
		.on( "create." + pluginName, initSelector, function(){
			$( this )
				[ pluginName ]( "_createPagination" )
				[ pluginName ]( "_bindPaginationEvents" );
		} )
		.on( "update." + pluginName, initSelector, function(){
			$( this )[ pluginName ]( "_createPagination" );
		} );

}(jQuery));



/*
 * responsive-carousel touch drag extension
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function($) {
	
	var pluginName = "rotator",
		initSelector = "." + pluginName,
		noTrans = pluginName + "-no-transition",
		// UA is needed to determine whether to return true or false during touchmove (only iOS handles true gracefully)
		iOS = /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1,
		touchMethods = {
			_dragBehavior: function(){
				var $self = $( this ),
					origin,
					data = {},
					xPerc,
					yPerc,
					setData = function( e ){
						
						var touches = e.touches || e.originalEvent.touches,
							$elem = $( e.target ).closest( initSelector );
						
						if( e.type === "touchstart" ){
							origin = { 
								x : touches[ 0 ].pageX,
								y: touches[ 0 ].pageY
							};
						}

						if( touches[ 0 ] && touches[ 0 ].pageX ){
							data.touches = touches;
							data.deltaX = touches[ 0 ].pageX - origin.x;
							data.deltaY = touches[ 0 ].pageY - origin.y;
							data.w = $elem.width();
							data.h = $elem.height();
							data.xPercent = data.deltaX / data.w;
							data.yPercent = data.deltaY / data.h;
							data.srcEvent = e;
						}

					},
					emitEvents = function( e ){
						setData( e );
						if( data.touches.length === 1 ){
							$( e.target ).closest( initSelector ).trigger( "drag" + e.type.split( "touch" )[1], data );
						}
					};

				$( this )
					.bind( "touchstart", function( e ){
						$( this ).addClass( noTrans );
						emitEvents( e );
					} )
					.bind( "touchmove", function( e ){
						setData( e );
						emitEvents( e );
						// Disabled to improve vertical movement issue.
						/*if( !iOS ){
							e.preventDefault();
							window.scrollBy( 0, -data.deltaY );
						}*/					
					} )
					.bind( "touchend", function( e ){
						$( this ).removeClass( noTrans );
						emitEvents( e );
					} );
					
					
			}
		};
			
	// add methods
	$.extend( $.fn[ pluginName ].prototype, touchMethods ); 
	
	// DOM-ready auto-init
	$( document ).on( "create." + pluginName, initSelector, function(){
		$( this )[ pluginName ]( "_dragBehavior" );
	} );

}(jQuery));



/*
 * responsive-carousel touch drag transition (FOR SLIDE EFFECT)
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function($) {
	
	var pluginName = "rotator",
		initSelector = "." + pluginName,
		activeClass = pluginName + "-active",
		itemClass = pluginName + "-item",
		dragThreshold = function( deltaX ){
			return Math.abs( deltaX ) > 4;
		},
		getActiveSlides = function( $rotator, deltaX ){
			var $from = $rotator.find( "." + pluginName + "-active" ),
				activeNum = $from.prevAll().length + 1,
				forward = deltaX < 0,
				nextNum = activeNum + (forward ? 1 : -1),
				$items = $rotator.find( "." + itemClass ).removeClass('rotator-item-prev rotator-item-next'), // removes next/prev classes (prevent blank slide issues)
				$to = $items.eq( nextNum - 1 );
			
			// activeNum;
			if( !$to.length ){
				$to = $rotator.find( "." + itemClass )[ forward ? "first" : "last" ]();
			}
			
			return [ $from, $to ];
		};
		
	// Touch handling
	$( document )
		.on( "dragmove", initSelector, function( e, data ){

			if( !dragThreshold( data.deltaX ) ){
				return;
			}

			var activeSlides = getActiveSlides( $( this ), data.deltaX );
								
			activeSlides[ 0 ].css( "left", data.deltaX + "px" );
			activeSlides[ 1 ].css( "left", data.deltaX < 0 ? data.w + data.deltaX + "px" : -data.w + data.deltaX + "px" );
		} )
		.on( "dragend", initSelector, function( e, data ){
			if( !dragThreshold( data.deltaX ) ){
				return;
			}
			var activeSlides = getActiveSlides( $( this ), data.deltaX ),
				newSlide = Math.abs( data.deltaX ) > 45;
			
			$( this ).one( navigator.userAgent.indexOf( "AppleWebKit" ) ? "webkitTransitionEnd" : "transitionEnd", function(){
				activeSlides[ 0 ].add( activeSlides[ 1 ] ).css( "left", "" );
				$( this ).trigger( "goto." + pluginName, activeSlides[ 1 ] );
			});			
				
			if( newSlide ){
				activeSlides[ 0 ].removeClass( activeClass ).css( "left", data.deltaX > 0 ? data.w  + "px" : -data.w  + "px" );
				activeSlides[ 1 ].addClass( activeClass ).css( "left", 0 );
			}
			else {
				activeSlides[ 0 ].css( "left", 0);
				activeSlides[ 1 ].css( "left", data.deltaX > 0 ? -data.w  + "px" : data.w  + "px" );	
			}
		} );
		
}(jQuery));



/*
 * responsive-carousel touch drag transition (FOR FLIP EFFECT)
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function($) {
	
	var pluginName = "rotator",
		initSelector = "." + pluginName,
		activeClass = pluginName + "-active",
		topClass = pluginName + "-top",
		itemClass = pluginName + "-item",
		dragThreshold = function( xPercent ){
			return (xPercent > -1 && xPercent < 0) || (xPercent < 1 && xPercent > 0);
		},
		getActiveSlides = function( $rotator, deltaX ){
			var $from = $rotator.find( "." + pluginName + "-active" ),
				activeNum = $from.prevAll().length + 1,
				forward = deltaX < 0,
				nextNum = activeNum + (forward ? 1 : -1),
				$to = $rotator.find( "." + itemClass ).eq( nextNum - 1 );
				
			if( !$to.length ){
				$to = $rotator.find( "." + itemClass )[ forward ? "first" : "last" ]();
			}
			
			return [ $from, $to ];
		};
	
	var transition = $( this ).attr( "data-transition");
	if( transition === 'flip' ){

		// Attach touch handling
		$( document )
			.on( "dragstart", initSelector, function( e, data ){
				$( this ).find( "." + topClass ).removeClass( topClass );
			})
			.on( "dragmove", function( e, data ){
				if( !dragThreshold( data.xPercent ) ){
					return;
				}
				var activeSlides = getActiveSlides( $( this ), data.deltaX ),
					degs = data.xPercent * 180,
					halfWay = Math.abs(data.xPercent) > 0.5;
					
				activeSlides[ 0 ].css( "-webkit-transform", "rotateY("+ degs +"deg)" );
				activeSlides[ 1 ].css( "-webkit-transform", "rotateY("+ ( ( degs > 0 ? -180 : 180 ) + degs ) +"deg)");
				
				activeSlides[ halfWay ? 1 : 0 ].addClass( topClass );
				activeSlides[ halfWay ? 0 : 1 ].removeClass( topClass );
				
			} )
			.on( "dragend", initSelector, function( e, data ){
				if( !dragThreshold( data.xPercent ) ){
					return;
				}
				var activeSlides = getActiveSlides( $( this ), data.deltaX ),
					newSlide = Math.abs( data.xPercent ) > 0.5;
				
				if( newSlide ){
					activeSlides[ 0 ].removeClass( activeClass );
					activeSlides[ 1 ].addClass( activeClass );
				}
				else {
					activeSlides[ 0 ].addClass( activeClass );
					activeSlides[ 1 ].removeClass( activeClass );
				}
				
				activeSlides[ 0 ].add( activeSlides[ 1 ] ).removeClass( topClass ).css( "-webkit-transform", "" );
				
			} );
	}
		
}(jQuery));



/*
 * responsive-carousel keyboard extension
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function($) {
	var pluginName = "rotator",
		initSelector = "." + pluginName,
		navSelector = "." + pluginName + "-nav a",
		buffer,
		keyNav = function( e ) {
			clearTimeout( buffer );
			buffer = setTimeout(function() {
				// var $rotator = $( e.target ).closest( initSelector );
				var $rotator = $( e.target ).parent().parent( initSelector + '-wrapper');
				if( e.keyCode === 39 || e.keyCode === 40 ){ 
					$rotator[ pluginName ]( "next" );
				}
				else if( e.keyCode === 37 || e.keyCode === 38 ){
					$rotator[ pluginName ]( "prev" );
				}
			}, 200 );

			if( 37 <= e.keyCode <= 40 ) {
				e.preventDefault();
			}
		};

	// Touch handling
	$( document )
		.on( "click", navSelector, function( e ) {
			$( e.target )[ 0 ].focus();
		})
		.on( "keydown", navSelector, keyNav );
}(jQuery));

		

/*
 * responsive-carousel dynamic containers extension
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function($) {
	
	var pluginName = "rotator",
		initSelector = "." + pluginName,
		itemClass = pluginName + "-item",
		activeClass = pluginName + "-active",
		rowAttr = "data-" + pluginName + "-slide",
		$win = $( window ),
		dynamicContainers = {
			_assessContainers: function(){
				var $self = $( this ),
					$rows = $self.find( "[" + rowAttr + "]" ),
					$activeItem = $rows.filter( "." + activeClass ).children( 0 ),
					$kids = $rows.children(),
					// $nav = $self.find( "." + pluginName + "-nav" ),
					sets = [];

				if( !$rows.length ){
					$kids = $( this ).find( "." + itemClass );
				}
				else{
					$kids.appendTo( $self );
					$rows.remove();
				}

				$kids
					.css('height','1px')
					.removeClass( itemClass + " " + activeClass )
					.each(function(){
						var prev = $( this ).prev();

						if( !prev.length || $( this ).offset().top !== prev.offset().top ){
							sets.push([]);
						}
						
						sets[ sets.length -1 ].push( $( this ) );
					})
					.css('height','');
				
				for( var i = 0; i < sets.length; i++ ){
					var $row = $( "<div " + rowAttr + "></div>" );
					for( var j = 0; j < sets[ i ].length; j++ ){
						$row.append( sets[ i ][ j ] );
					}
					
					// $row.insertBefore( $nav );
					$row.appendTo( $self );
				}
				
				$self[ pluginName ]( "update" )
					// initialize pagination
					.trigger( "goto." + pluginName );
				
				$self.find( "." + itemClass ).eq( 0 ).addClass( activeClass );
			},
			
			_dynamicContainerEvents: function(){
				var $self = $( this ),
					win_w = $win.width(),
					win_h = $win.height(),
					timeout;
				
				// on init
				$self[ pluginName ]( "_assessContainers" );
				
				// and on resize
				$win.on( "resize", function( e ){
					
					// IE wants to constantly run resize for some reason
					// Let’s make sure it is actually a resize event
					var win_w_new = $win.width(),
						win_h_new = $win.height();
					
					if( win_w !== win_w_new ||
						win_h !== win_h_new )
					{
						// timer shennanigans
						clearTimeout(timeout);
						timeout = setTimeout( function(){
							$self[ pluginName ]( "_fixHeights" );
							$self[ pluginName ]( "_assessContainers" );
						}, 200 );
						
						// Update the width and height
						win_w = win_w_new;
						win_h = win_h_new;
					}
				});
			}
		};
			
	// add methods
	$.extend( $.fn[ pluginName ].prototype, dynamicContainers ); 
	
	// DOM-ready auto-init
	$( document ).on( "create." + pluginName, initSelector, function(){
		$( this )[ pluginName ]( "_dynamicContainerEvents" );
	} );

}(jQuery));



/*
 * responsive-carousel autoplay extension
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function( $, undefined ) {
	var pluginName = "rotator",
		initSelector = "." + pluginName,
		interval = 4000,
		autoPlayMethods = {
			play: function(){
				var $self = $( this ).parent(),
					intAttr = $( this ).attr( "data-interval" ),
					thisInt = parseFloat( intAttr ) || interval;
				return $self.data(
					"timer", 
					setInterval( function(){
						$self[ pluginName ]( "next" );
					},
					thisInt )
				);
			},
			
			stop: function(){
				clearTimeout( $( this ).data( "timer" ) );
			},
			
			_bindStopListener: function(){
				return $( this ).parent().bind( "mousedown touchmove", function(){
					$( this )[ pluginName ]( "stop" );
				} );
			},
			
			_initAutoPlay: function(){
				var autoplay = $( this ).attr( "data-autoplay");
				if( autoplay === 'true' || autoplay === true ){
					$( this )
						[ pluginName ]( "_bindStopListener" )
						[ pluginName ]( "play" );
				}
			}
		};
			
	// add methods
	$.extend( $.fn[ pluginName ].prototype, autoPlayMethods ); 
	
	// DOM-ready auto-init
	$( document ).on( "create." + pluginName, initSelector, function(){
		$( this )[ pluginName ]( "_initAutoPlay" );
	} );

}(jQuery));



/*
 * responsive-carousel auto-init extension
 * https://github.com/filamentgroup/responsive-carousel
 *
 * Copyright (c) 2012 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */

(function( $ ) {
	// DOM-ready auto-init
	$( function(){
		$( ".rotator" ).rotator();
	} );
}( jQuery ));
