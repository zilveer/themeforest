// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

// requestAnimationFrame polyfill by Erik MÃ¶ller. fixes from Paul Irish and Tino Zijdel

// MIT license
( function() {
	var lastTime = 0,
		vendors = ['ms', 'moz', 'webkit', 'o'],
		currTime, timeToCall, id, x;
	for( x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
		window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
		window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
	}
	/* jshint unused:false */
	if (!window.requestAnimationFrame) {
		window.requestAnimationFrame = function(callback, element) {
			currTime = new Date().getTime();
			timeToCall = Math.max(0, 16 - (currTime - lastTime));
			id = window.setTimeout(function() { callback(currTime + timeToCall); },
			timeToCall);
			lastTime = currTime + timeToCall;
			return id;
		};
	}

	if (!window.cancelAnimationFrame) {
		window.cancelAnimationFrame = function(id) {
			clearTimeout(id);
		};
	}
}() );

/*!
Plugin: jQuery Hardware Acceleration Parallax
Version 1.0.1
Author: Constantin Saguin
Twitter: @brutaldesign
Author URL: http://csag.co

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/
;(function ( $, window, document, undefined ) {

	var pluginName = 'haParallax',
		defaults = {
			speedFactor : 8
		};

	/**
	 * The actual plugin constructor
	 */
	function Plugin ( element, options ) {
		this.element = element;
		this.settings = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this._name = pluginName;
		this.init();
	}

	/**
	 * Avoid Plugin.prototype conflicts
	 */
	$.extend( Plugin.prototype, {

		/**
		 * Initialize plugin
		 */
		init : function () {

			var _this = this;

			this.build( this.element, this.settings );
			_this.update( $( window ).scrollTop() );
			_this.imgStretch();

			/**
			 * Resize event
			 */
			$( window ).resize( function() {
				_this.update( $( window ).scrollTop() );
				_this.imgStretch();
			} ).resize();

			/**
			 * Scroll event
			 */
			$( window ).scroll( function() {
				_this.update( $( window ).scrollTop() );
				_this.translate( $( window ).scrollTop() );
			} );

			$( window ).load( function() {
				_this.setNaturalImgDimensionsData();
				_this.imgStretch();
			} );
		},

		/**
		 * Create blocks with image from the element background image URL
		 */
		build : function () {

			if ( ! $( this.element ).css( 'background-image' ) ) {
				return;
			}

			var scrollTop = $( window ).scrollTop(),
				$section = $( this.element ),
				index = $section.index(),
				sectionHeight = $section.outerHeight() + 1,
				offsetTop = $section.offset().top - scrollTop,
				bg = $section.css( 'background-image' ).replace( 'url(','' ).replace( ')','' ).replace( '"','' ),
				$holder = $( '<div style="z-index:0;width:100%;top: 0;position:fixed;overflow:hidden;" class="parallax-bg" data-holder-index="' + index + '"><img style="max-width: none;width:100%;height:auto;position: fixed;top:0;left:0;backface-visibility:hidden;-webkit-backface-visibility:hidden;" id="parallax-bg-img-' + index + '" src="' + bg + '"></div>' );

			$( 'body' ).prepend( $holder );
			$section.attr( 'data-section-index', index );
			$section.attr( 'data-top', Math.floor( $section.offset().top ) );
			$section.css( { 'background' : 'none' } );

			$holder.css( {
				'height' : sectionHeight,
				'transform': 'translate3d(0,' + Math.floor( offsetTop ) + 'px,0)',
				'-webkit-transform': 'translate3d(0,' + Math.floor( offsetTop ) + 'px,0)'
			} );
		},

		/**
		 * Update image holder position while scrolling or resizing
		 */
		update : function ( scrollTop ) {
			var $section = $( this.element ),
				index = $section.data( 'section-index' ),
				$holder = $( '.parallax-bg[data-holder-index="' + index + '"]' ),
				windowHeight = $( window ).height(),
				sectionHeight = $section.height() + 1,
				offsetTop = $section.offset().top - scrollTop;

			//if ( ( scrollTop > $section.offset().top + sectionHeight ) || ( scrollTop + windowHeight < offsetTop ) ) {
			//	return;
			//}

			$holder.css( {
				'height' : sectionHeight,
				'transform': 'translate3d(0,' + Math.floor( offsetTop ) + 'px,0)',
				'-webkit-transform': 'translate3d(0,' + Math.floor( offsetTop ) + 'px,0)'
			} );
		},

		/**
		 * Simulate background cover behavior for images
		 */
		imgStretch : function () {
			var windowWidth = $( window ).width(),
				$section = $( this.element ),
				index = $section.data( 'section-index' ),
				$img = $( '.parallax-bg[data-holder-index="' + index + '"]' ).find( 'img' ),
				originImgWidth = $img.data( 'width' ),
				newCss;

			if ( originImgWidth < windowWidth ) {
				newCss = {
					'margin-left' : 0,
					'width' : '100%'
				};
			} else {
				newCss = {
					'margin-left' : - ( originImgWidth - windowWidth ) / 2,
					'width' : originImgWidth
				};
			}

			$img.css( newCss );
		},

		/**
		 * Parallax effect
		 */
		translate : function ( scrollTop ) {
			var windowHeight = $( window ).height(),
				$section = $( this.element ),
				index = $section.data( 'section-index' ),
				sectionHeight = $section.outerHeight(),
				offsetTop = $section.offset().top,
				speedFactor = ( $section.data( 'parallax-speed' ) || this.settings.speedFactor ) / 10,
				$holderImg = $( '.parallax-bg[data-holder-index="' + index + '"]' ).find( 'img' ),
				doPos;

			if ( ( scrollTop > offsetTop + sectionHeight ) || ( scrollTop + windowHeight < offsetTop ) ) {
				return;
			}

			doPos = ( scrollTop - offsetTop ) * speedFactor;

			$holderImg.css( {
				'transform': 'translate3d(0,' + doPos + 'px,0)',
				'-webkit-transform': 'translate3d(0,' + doPos + 'px,0)'
			} );
		},

		/**
		 * Set natural images dimensions on page load
		 */
		setNaturalImgDimensionsData : function () {
			var $section = $( this.element ),
				index = $section.data( 'section-index' ),
				$holder = $( '.parallax-bg[data-holder-index="' + index + '"]' ),
				imgId = $holder.find( 'img' ).attr( 'id' ),
				image = document.getElementById( imgId ),
				width = image.naturalWidth,
				height = image.naturalHeight;

			$holder.find( 'img' ).attr( 'data-width', width );
			$holder.find( 'img' ).attr( 'data-height', height );
		}
	} );

	$.fn[ pluginName ] = function ( options ) {
		this.each( function() {
			if ( ! $.data( this, 'parallax_' + pluginName ) ) {
				$.data( this, 'parallax_' + pluginName, new Plugin( this, options ) );
			}
		} );

		// chain jQuery functions
		return this;
	};

} )( jQuery, window, document );
