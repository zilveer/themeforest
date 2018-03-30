/**
 * Preloader scripts
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */


/**
 * pathLoader.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function (window) {

	'use strict';

	function PathLoader(el) {
		this.el = el;
		// clear stroke
		this.el.style.strokeDasharray = this.el.style.strokeDashoffset = this.el.getTotalLength();
	}

	PathLoader.prototype._draw = function (val) {
		this.el.style.strokeDashoffset = this.el.getTotalLength() * ( 1 - val );
	};

	PathLoader.prototype.setProgress = function (val, callback) {
		this._draw(val);
		if (callback && typeof callback === 'function') {
			// give it a time (ideally the same like the transition time) so that the last progress increment animation is still visible.
			setTimeout(callback, 200);
		}
	};

	PathLoader.prototype.setProgressFn = function (fn) {
		if (typeof fn === 'function') {
			fn(this);
		}
	};

	// add to global namespace
	window.PathLoader = PathLoader;

})(window);


/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 *
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false */

( function( window ) {

	'use strict';

	// class helper functions from bonzo https://github.com/ded/bonzo

	function classReg( className ) {
		return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
	}

	// classList support for class management
	// altho to be fair, the api sucks because it won't accept multiple classes at once
	var hasClass, addClass, removeClass;

	if ( 'classList' in document.documentElement ) {
		hasClass = function( elem, c ) {
			return elem.classList.contains( c );
		};
		addClass = function( elem, c ) {
			elem.classList.add( c );
		};
		removeClass = function( elem, c ) {
			elem.classList.remove( c );
		};
	}
	else {
		hasClass = function( elem, c ) {
			return classReg( c ).test( elem.className );
		};
		addClass = function( elem, c ) {
			if ( !hasClass( elem, c ) ) {
				elem.className = elem.className + ' ' + c;
			}
		};
		removeClass = function( elem, c ) {
			elem.className = elem.className.replace( classReg( c ), ' ' );
		};
	}

	function toggleClass( elem, c ) {
		var fn = hasClass( elem, c ) ? removeClass : addClass;
		fn( elem, c );
	}

	var classie = {
		// full names
		hasClass: hasClass,
		addClass: addClass,
		removeClass: removeClass,
		toggleClass: toggleClass,
		// short names
		has: hasClass,
		add: addClass,
		remove: removeClass,
		toggle: toggleClass
	};

	// transport
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( classie );
	} else {
		// browser global
		window.classie = classie;
	}

})( window );


/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function (window) {

	'use strict';

	var body, preloader, loader, progress = 0;

	/**
	 * Start circle loader animation
	 */
	function loaderCircleSimulation()
	{
		// simulate loading something..
		var simulationFn = function(instance) {
			var interval = setInterval( function() {
				progress = Math.min( progress + Math.random() * 0.1, 1 );

				instance.setProgress( progress );

				// reached the end
				if( progress >= 1 ) {
					clearInterval( interval );
				}
			}, 80 );
		};

		loader.setProgressFn( simulationFn );
	}

	/**
	 * Disable scrolling
	 */
	function noscroll() {
		window.scrollTo( 0, 0 );
	}

	/**
	 * Page has loaded
	 */
	function loaded() {
		progress = 1;
		classie.remove( preloader, 'loading' );
		classie.add( preloader, 'loaded' );
		classie.remove( body, 'loading' );
		classie.add( body, 'loaded' );
		window.removeEventListener( 'scroll', noscroll );
                if (window.location.hash){
                    var el = document.getElementById( window.location.hash.substr(1));
                    var top = cumulativeOffset(el).top - 256;
                    window.scrollTo( 0, top );
                    fixScroll(window.location.hash.substr(1));
                }
	}
        
        function cumulativeOffset (element) {
            var top = 0, left = 0;
            do {
                top += element.offsetTop  || 0;
                left += element.offsetLeft || 0;
                element = element.offsetParent;
            } while(element);

            return {
                top: top,
                left: left
            };
        };

	/**
	 * Init preloader
	 */
	function init() {

		body = document.body;
		preloader = document.getElementById( 'preloader' );
		loader = new PathLoader( document.getElementById( 'ip-loader-circle' ) );

		// Remove for mobile screen size
		if(window.innerWidth < 768) {
			classie.remove(body, 'preloader');
			preloader.parentNode.removeChild(preloader);
			return;
		}

		// disable scrolling
		window.addEventListener( 'scroll', noscroll );

		// initial animation
		setTimeout(function(){
			classie.add( preloader, 'loading' );
		}, 100);
		classie.add( body, 'loading' );

		loaderCircleSimulation();

		// Finished loading
		if (window.addEventListener) {
			window.addEventListener('load', loaded, false);
		} else if (window.attachEvent) {
			window.attachEvent('onload', loaded);
		}
	}

	/**
	 * Preloader
	 */
	function Preloader() {
		init();
	}

	// add to global namespace
	window.Preloader = Preloader;

})(window);
