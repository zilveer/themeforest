/**
* THB JavaScript Toolkit library v1.0
*
* ---
*
* The Happy Framework: WordPress Development Framework
* Copyright 2012, Andrea Gandino & Simone Maranzana
*
* Licensed under The MIT License
* Redistribuitions of files must retain the above copyright notice.
*
* @package Assets\Frontend\JS
* @author The Happy Bit <thehappybit@gmail.com>
* @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
* @link http://
* @since The Happy Framework v 1.0
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

(function($) {

	/**
	 * Boot
	 */
	if( !$.thb ) {
		$.thb = {};
	}

	/**
	 * Config
	 */
	$.thb.config = {
		defaultKeyName: "default",
		themeKeyName: "theme-config",

		/**
		 * Read a configuration item.
		 *
		 * @param {String} key The configuration item key.
		 * @param {String} subkey The configuration item subkey.
		 * @return {Object}
		 */
		get: function( key, subkey, markup_id ) {
			if( $.thb.config[key] ) {
				if( subkey !== undefined ) {
					if( $.thb.config[key][subkey] ) {
						var obj = {};

						if( markup_id !== undefined && $.thb.config[key][subkey][markup_id] ) {
							obj = $.thb.config[key][subkey][markup_id];
						}
						else {
							obj = $.thb.config[key][subkey];
						}

						return $.extend({}, $.thb.config[key][$.thb.config.defaultKeyName], obj);
					}
					else if( $.thb.config[key][$.thb.config.defaultKeyName] ) {
						return $.thb.config[key][$.thb.config.defaultKeyName];
					}
				}
				else if( $.thb.config[key][$.thb.config.defaultKeyName] ) {
					return $.thb.config[key][$.thb.config.defaultKeyName];
				}
			}

			return {};
		},

		/**
		 * Set a configuration item.
		 *
		 * @param {String} key The configuration item key.
		 * @param {String} subkey The configuration item subkey.
		 * @param {Object} object The configuration item value.
		 * @return {Object}
		 */
		set: function( key, subkey, object, markup_id ) {
			if( !$.thb.config[key] ) {
				$.thb.config[key] = {};
			}

			if( !$.thb.config[key][subkey] ) {
				$.thb.config[key][subkey] = {};
			}

			if( markup_id !== undefined ) {
				if( !$.thb.config[key][subkey][markup_id] ) {
					$.thb.config[key][subkey][markup_id] = {};
				}

				$.thb.config[key][subkey][markup_id] = $.extend($.thb.config[key][subkey][markup_id], object);
			}
			else {
				$.thb.config[key][subkey] = $.extend($.thb.config[key][subkey], object);
			}
		}
	};

	/**
	 * Check for transition support.
	 *
	 * @return boolean
	 */
	$.thb.transitionSupport = function() {
		var s = $("body").get(0).style,
			transitionSupport = 'transition' in s || 'WebkitTransition' in s || 'MozTransition' in s || 'msTransition' in s || 'OTransition' in s;

		return transitionSupport;
	};

	/**
	 * Binds a class toggle on a CSS transitioning element.
	 *
	 * @param {Mixed} el The node object.
	 * @param {Function} callback Function to be executed at the end of the transition.
	 * @param {Boolean} persistent True if the event should not be unbound at the end of the transition.
	 * @return void
	 */
	$.thb.transition = function( el, callback, persistent ) {
		el = $(el);

		var inClass = "thb-transition-in",
			outClass = "thb-transition-out",
			transitionSupport = $.thb.transitionSupport();

		el.each(function() {
			if( transitionSupport ) {
				$(this).bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function( e ) {
					if( this !== e.target ) {
						return false;
					}

					if( $(this).hasClass(outClass) ) {
						$(this).removeClass(outClass);
					}

					if( callback ) {
						callback( $(this) );
					}

					if( !persistent ) {
						$(this).unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
					}

					return false;
				});
			}
			else {
				if( callback ) {
					callback( $(this) );
				}
			}

			if( $(this).hasClass(inClass) ) {
				$(this).removeClass(inClass);
				$(this).addClass(outClass);
			}
			else {
				$(this).addClass(inClass).removeClass(outClass);
			}
		});
	};

	/**
	 * Binds a keydown event based on a subset of allowed keys.
	 *
	 * @param {String} key The key literal name.
	 * @param {Function} callback The event callback function.
	 * @param {Boolean} ret The return value of the function.
	 * @return void
	 */
	$.thb.key = function( key, callback, ret ) {
		var keyMap = {
			"enter": 13,
			"left": 37,
			"up": 38,
			"right": 39,
			"down": 40,
			"esc": 27,
			"space": 32
		};

		$(window).on("keydown", function(e) {
			if( keyMap[key] && e.which === keyMap[key] ) {
				callback(e);
				return ret || false;
			}
			return true;
		});
	};

	/**
	 * Change the page content with an AJAX refresh and updates the browser
	 * history.
	 *
	 * @param {String} url The URL to load.
	 * @param {Object} params The parameters object
	 * @return void
	 */
	$.thb.pageChange = function( url, params ) {
		params = $.extend({}, {
			preload: true,
			filter: false,
			waitfor: false,
			before: function() {},
			after: function() {},
			error: function() {}
		}, params);

		params.afterComplete = function() {
			if( window.history && window.history.pushState ) {
				window.history.pushState({}, '', url);
			}
		};

		$.thb.loadUrl(url, params);
	};

	/**
	 * Load a remote URL grabbing its HTML or a portion of it.
	 *
	 * @param {String} url The URL to load.
	 * @param {Object} params The parameters object
	 * @return void
	 */
	$.thb.loadUrl = function( url, params ) {
		params = $.extend({}, {
			loadingClass: "thb-ajax-loading",
			preload: true,
			filter: false,
			waitfor: false,
			before: function() {},
			after: function() {},
			complete: function() {},
			afterComplete: function() {},
			error: function() {}
		}, params);

		if( $("body").hasClass(params.loadingClass) ) {
			return;
		}
		else {
			$("body").addClass(params.loadingClass);
		}

		var transitionSupport = $.thb.transitionSupport();

		params.load = function() {
			$.ajax(url, {
				error: function( xhr, ajaxOptions, thrownError ) {
					params.error(xhr, ajaxOptions, thrownError);
				},
				success: function( data ) {
					data = "<div>" + data + "</div>";

					if( params.filter ) {
						data = $(data).find(params.filter).outerHTML();
					}
					else {
						data = $(data).outerHTML();
					}

					if( params.preload && data !== '' ) {
						$.thb.loadImage(data, {
							allLoaded: function( images ) {
								params.after(data);

								setTimeout(function() {
									$("body").removeClass(params.loadingClass);
									params.complete(data);
									params.afterComplete();
								}, 0);
							}
						});
					}
					else {
						params.after(data);

						setTimeout(function() {
							$("body").removeClass(params.loadingClass);
						}, 0);

						params.complete(data);
						params.afterComplete();
					}
				}
			});
		};

		params.before();

		if( transitionSupport && params.waitfor ) {
			$.thb.transition(params.waitfor, function() {
				params.load();
			});
		}
		else {
			params.load();
		}

	};

	/**
	 * Fire a call to a callback function whenever an image has finished
	 * loading.
	 *
	 * @param {Object} obj The images container, or the image itself.
	 * @param {Object} params The params object.
	 * @return void
	 */
	$.thb.loadImage = function( obj, params ) {
		params = $.extend({}, {
			allLoaded: function() {},
			imageLoaded: function() {}
		}, params);

		var images = [],
			loadedImages = 0;

		/**
		 * Return the URL of the image to be loaded
		 * @param Image img
		 * @return string
		 */
		function imgSrc( img ) {
			var src = img.attr('src'),
				lazy = src === '' && img.data('src') && img.data('src') !== '';

			if( lazy ) {
				src = img.data('src');
			}

			return {
				"src" : src,
				"lazy" : lazy
			};
		}

		// Filter images with empty src/data-src attribute
		$(obj).each(function() {
			if( $(this).is('img') ) {
				var imgdata = imgSrc( $(this) );

				if( imgdata.src && imgdata.src !== "" ) {
					images.push( $(this) );
				}
			}
			else {
				$(this).find('img').each(function() {
					var imgdata = imgSrc( $(this) );

					if( imgdata.src && imgdata.src !== "" ) {
						images.push( $(this) );
					}
				});
			}
		});

		images = $(images);

		if( ! images.length ) {
			if( params.allLoaded ) {
				params.allLoaded( images );
			}

			return;
		}

		$.each(images, function() {
			var img = $(this),
				imgdata = imgSrc( $(this) ),
				src = imgdata.src,
				lazy = imgdata.lazy;

			$('<img />')
				.one('load error', function() {
					loadedImages++;

					if( params.imageLoaded ) {
						if( lazy ) {
							img.attr('src', src);
						}

						params.imageLoaded( img, this );
					}

					if( loadedImages == images.length ) {
						if( params.allLoaded ) {
							params.allLoaded( images );
						}
					}
				})
				.attr('src', src);
		});
	};

	/**
	 * jQuery outerHTML
	 */
	if( !$.fn.outerHTML ) {
		$.fn.outerHTML = function() {
			if( $(this).length ) {
				return $('<div />').append(this.eq(0).clone()).html();
			}

			return "";
		};
	}

})(jQuery);

/**
 * Function debounce
 * @see http://unscriptable.com/2009/03/20/debouncing-javascript-methods/
 * -----------------------------------------------------------------------------
 */
if( !Function.prototype.debounce ) {
	Function.prototype.debounce = function (threshold, execAsap) {
		var func = this, timeout;
		return function debounced () {
			var obj = this, args = arguments;
			function delayed() {
				if (!execAsap)
					func.apply(obj, args);
				timeout = null;
			}

			if (timeout)
				clearTimeout(timeout);
			else if (execAsap)
				func.apply(obj, args);

			timeout = setTimeout(delayed, threshold || 100);
		};
	};
}

/**
 * Parse querystring parameters
 * -----------------------------------------------------------------------------
 */
(function($) {
	var re = /([^&=]+)=?([^&]*)/g;
	var decodeRE = /\+/g;  // Regex for replacing addition symbol with a space
	var decode = function (str) {return decodeURIComponent( str.replace(decodeRE, " ") );};

	$.parseParams = function(query) {
		var params = {}, e;

		while ( e = re.exec(query) ) {
			var k = decode( e[1] ), v = decode( e[2] );
			if (k.substring(k.length - 2) === '[]') {
				k = k.substring(0, k.length - 2);
				(params[k] || (params[k] = [])).push(v);
			} else {
				params[k] = v;
			}
		}

		return params;
	};
})(jQuery);