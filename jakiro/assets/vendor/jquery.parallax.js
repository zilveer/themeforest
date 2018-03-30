/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/
(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight, theMode, target) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		target = target || $this;
		target = $(target);
		var theMode = theMode || 'background'
		
		//get the starting position of each element to have parallax applied to it		
		$this.each(function(){
		    firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		var theCSSPrefix = '';
		var theDashedCSSPrefix = '';
		var getStyle = window.getComputedStyle;
		var documentElement = document.documentElement;
		var body = document.body;
		var detectCSSPrefix = function() {
			//Only relevant prefixes. May be extended.
			//Could be dangerous if there will ever be a CSS property which actually starts with "ms". Don't hope so.
			var rxPrefixes = /^(?:O|Moz|webkit|ms)|(?:-(?:o|moz|webkit|ms)-)/;

			//Detect prefix for current browser by finding the first property using a prefix.
			if(!getStyle) {
				return;
			}

			var style = getStyle(body, null);

			for(var k in style) {
				//We check the key and if the key is a number, we check the value as well, because safari's getComputedStyle returns some weird array-like thingy.
				theCSSPrefix = (k.match(rxPrefixes) || (+k == k && style[k].match(rxPrefixes)));

				if(theCSSPrefix) {
					break;
				}
			}

			//Did we even detect a prefix?
			if(!theCSSPrefix) {
				theCSSPrefix = theDashedCSSPrefix = '';

				return;
			}

			theCSSPrefix = theCSSPrefix[0];

			//We could have detected either a dashed prefix or this camelCaseish-inconsistent stuff.
			if(theCSSPrefix.slice(0,1) === '-') {
				theDashedCSSPrefix = theCSSPrefix;

				//There's no logic behind these. Need a look up.
				theCSSPrefix = ({
					'-webkit-': 'webkit',
					'-moz-': 'Moz',
					'-ms-': 'ms',
					'-o-': 'O'
				})[theCSSPrefix];
			} else {
				theDashedCSSPrefix = '-' + theCSSPrefix.toLowerCase() + '-';
			}
		};
		detectCSSPrefix();
		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();	
			var wHeight = $window.height()	
			var wWidth = $window.width()				

			$this.each(function(){
				var $element = $(this);
				var top = ( typeof ( $element.parent().offset()) != "undefined" && $element.parent().offset() !== null ) ? $element.parent().offset().top : 0
				
				var height = getHeight($element);
				var fixedHeight = 0;

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				var trns = pos + fixedHeight - top;
				var hasTransform = function () {
					var style = document.createElement('div').style,
					vendors = ['t', 'webkitT', 'MozT', 'msT', 'OT'],
					transform, i = 0, l = vendors.length;

					for ( ; i < l; i++ ) {
						transform = vendors[i] + 'ransform';
						if ( transform in style ) {
							return transform;
						}
					}

					return false;
				};
				// for mobile set to 0
				if( wWidth <= dhL10n.breakpoint ){
					if( theMode == 'translate' ){
						if(hasTransform){
							$this.css('transform', 'translate3d(0, 0, 0)' );
							target.find('.parallax-content').css('opacity', 1)
						}
					} else {
						$this.css('backgroundPosition', '0px 0px');
						
					}
				} else {
					if(theMode == 'translate'){
						var runTransform = function(){
							if(trns > 0){
								var diff =  (trns + height) / (trns * 7);
		 						if (diff > 1) 
									diff = 1;
					            else if (diff < 0) 
									diff = 0;
		 						 $this.css('transform', 'translate3d(0px, ' + Math.round( .3 * trns ) + 'px, 0px)' );
	 							 target.find('.parallax-content').css('opacity', diff)
							}else{
								 $this.css('transform', 'translate3d(0px, 0px, 0px)' );
	 							 target.find('.parallax-content').css('opacity', 1)
							}
						};
						if(hasTransform){
							var requestAnimFrame = window.requestAnimationFrame || window[theCSSPrefix.toLowerCase() + 'RequestAnimationFrame'];
							runTransform();
//							if (requestAnimFrame) {
//								requestAnimFrame(function() {
//									runTransform();
//		 				        });
//							}else{
//								runTransform();
//							}
						}
					}
//					if( theMode == 'translate' && trns > 0){
//
//							var diff =  (trns + height) / (trns * 7);
//	 						if (diff > 1) 
//								diff = 1;
//				            else if (diff < 0) 
//								diff = 0;
//
//							$this.css('transform', 'translate(0, ' + Math.round( .7 * trns ) + 'px)' );
//							target.find('.parallax-content')
//									.css('opacity', diff)
//
//					} else if( theMode == 'translate' ){
//						$this.css( 'transform', 'translate(0, 0)' );
//						target.find('.parallax-content')
//								.css('opacity', 1)
//					}
					if(  theMode == 'background' ){
						$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
					}
				}
			});
		}		

		$window.bind('scroll', update).resize(update);
		update();
	};
})(jQuery);
