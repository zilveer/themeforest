/*
 * jSwipe - jQuery Plugin
 * http://plugins.jquery.com/project/swipe
 * http://www.ryanscherf.com/demos/swipe/
 *
 * Copyright (c) 2009 Ryan Scherf (www.ryanscherf.com)
 * Licensed under the MIT license
 *
 * $Date: 2009-07-14 (Tue, 14 Jul 2009) $
 * $version: 0.1.2
 *
 * This jQuery plugin will only run on devices running Mobile Safari
 * on iPhone or iPod Touch devices running iPhone OS 2.0 or later.
 * http://developer.apple.com/iphone/library/documentation/AppleApplications/Reference/SafariWebContent/HandlingEvents/HandlingEvents.html#//apple_ref/doc/uid/TP40006511-SW5
 */
(function($) {
	$.fn.swipe = function(options) {

		// Default thresholds & swipe functions
		var defaults = {
			threshold: {
				x: 10,
				y: 30
			},
			swipeLeft: function() {alert('swiped left')},
			swipeRight: function() {alert('swiped right')},
                        swipeMoving: function( value ){alert( value )}
		};

		var options = $.extend(defaults, options);

		if (!this) return false;

		return this.each(function() {

			var me = $(this);

			// Private variables for each element
			var originalCoord = {x: 0, y: 0};
			var finalCoord = {x: 0, y: 0};

			// Screen touched, store the original coordinate
			function touchStart(event) {
				//console.log('Starting swipe gesture...')
				originalCoord.x = event.targetTouches[0].pageX;
				originalCoord.y = event.targetTouches[0].pageY;
			}

			// Store coordinates as finger is swiping
			function touchMove(event) {

                                if(event.touches.length > 1 || event.scale && event.scale !== 1){
                                    return;
                                }

				finalCoord.x = event.targetTouches[0].pageX; // Updated X,Y coordinates
				finalCoord.y = event.targetTouches[0].pageY;
                                changeX = originalCoord.x - finalCoord.x;
                                changeY = originalCoord.y - finalCoord.y;

                                if ( typeof this.isScrolling == 'undefined') {

                                 this.isScrolling = !!( this.isScrolling || Math.abs(changeX) < Math.abs(changeY) );
                                }


                               if( !this.isScrolling )
                               {
				   // console.log(changeX);
                                   event.preventDefault();
                                   defaults.swipeMoving( changeX );
			       }


			}

			// Done Swiping
			// Swipe should only be on X axis, ignore if swipe on Y axis
			// Calculate if the swipe was left or right
			function touchEnd(event) {
				//console.log('Ending swipe gesture...')
				var changeY = originalCoord.y - finalCoord.y;

                           if (!this.isScrolling) {
					changeX = originalCoord.x - finalCoord.x;
					if(changeX > defaults.threshold.x) {

                                           defaults.swipeLeft()
					}
					if(changeX < (defaults.threshold.x*-1)) {
                                            defaults.swipeRight()
					}
				}
			}

			// Swipe was started
			function touchStart(event) {
				//console.log('Starting swipe gesture...')

                                this.isScrolling = undefined;
				originalCoord.x = event.targetTouches[0].pageX;
				originalCoord.y = event.targetTouches[0].pageY;

				finalCoord.x = originalCoord.x;
				finalCoord.y = originalCoord.y;
			}

			// Swipe was canceled
			function touchCancel(event) {
				//console.log('Canceling swipe gesture...')

			}
			
			
			if ( $.browser.msie ) {
					this.attachEvent('touchstart', touchStart);
					this.attachEvent('touchMove', touchMove);
					this.attachEvent('touchEnd', touchEnd);
					this.attachEvent('touchCancel', touchCancel);
			} else {
				// Add gestures to all swipable areas
				this.addEventListener("touchstart", touchStart, false);
				this.addEventListener("touchmove", touchMove, false);
				this.addEventListener("touchend", touchEnd, false);
				this.addEventListener("touchcancel", touchCancel, false);
			}

		});
	};
})(jQuery);