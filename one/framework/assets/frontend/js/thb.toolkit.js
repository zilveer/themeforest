/**
* THB JavaScript Toolkit library v1.0
*
* ---
*
* The Happy Framework: WordPress Development Framework
* Copyright 2014, Andrea Gandino & Simone Maranzana
*
* Licensed under The MIT License
* Redistribuitions of files must retain the above copyright notice.
*
* @package Assets\Frontend\JS
* @author The Happy Bit <thehappybit@gmail.com>
* @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
* @link http://
* @since The Happy Framework v 2.0
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

(function($) {
	"use strict";

	/**
	 * Boot
	 */
	if( ! $.thb ) {
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
	 * Generic toggle component.
	 *
	 * @param {Object} options
	 */
	window.THB_Toggle = function( options ) {
		var status = "off",
			transitioning = false,
			self = this;

		options = $.extend( {
			on               : function() {},
			off              : function() {},
			onTransitionEnd  : function() {},
			offTransitionEnd : function() {},
			target           : null
		}, options );

		self.on = function() {
			if ( transitioning || status == "on" ) {
				return false;
			}

			if ( options.target ) {
				transitioning = true;

				$.thb.transition( options.target, function() {
					transitioning = false;
					options.onTransitionEnd( options.target );
				}, false );
			}

			options.on( options.target );
			status = "on";

			return false;
		};

		self.off = function() {
			if ( transitioning || status == "off" ) {
				return false;
			}

			if ( options.target ) {
				transitioning = true;

				$.thb.transition( options.target, function() {
					transitioning = false;
					options.offTransitionEnd( options.target );
				}, false );
			}

			options.off( options.target );
			status = "off";

			return false;
		};

		self.toggle = function() {
			if ( transitioning ) {
				return false;
			}

			if ( status === "off" ) {
				self.on();
			}
			else {
				self.off();
			}

			return false;
		};
	};

	/**
	 * Toggle component.
	 *
	 * @param  {jQuery} element
	 * @param  {Object} options
	 */
	$.thb.toggle = function( element, options ) {
		options = $.extend( {
			on               : function() {},
			off              : function() {},
			onTransitionEnd  : function() {},
			offTransitionEnd : function() {},
			event            : "click",
			target           : null
		}, options );

		var toggle = new THB_Toggle( options );

		$(element).on( options.event, toggle.toggle );
	};

	/**
	 * Binds a keydown event based on a subset of allowed keys.
	 *
	 * @param {String} key The key literal name.
	 * @param {Function} callback The event callback function.
	 * @param {Boolean} ret The return value of the function.
	 * @param {String} namespace The event namespace.
	 * @return void
	 */
	$.thb.key = function( key, callback, ret, namespace ) {
		var keyMap = {
			"enter": 13,
			"left": 37,
			"up": 38,
			"right": 39,
			"down": 40,
			"esc": 27,
			"space": 32
		};

		if ( ! namespace ) {
			namespace = "";
		}
		else {
			namespace = "." + namespace;
		}

		$(window).on( "keydown" + namespace, function(e) {
			if( keyMap[key] && e.which === keyMap[key] ) {
				callback(e);
				return ret || false;
			}
			return true;
		} );
	};

	/**
	 * Load a remote URL grabbing its data.
	 *
	 * @param {String} url The URL to load.
	 * @param {Object} params The parameters object
	 * @return void
	 */
	$.thb.load = function( url, params ) {
		params = $.extend({}, {
			loadingClass: "thb-ajax-loading",
			data: {},
			method: "GET",
			before: function() {},
			after: function() {},
			complete: function() {},
			afterComplete: function() {},
			error: function() {},
			success: function( data ) {
				params.after(data);

				setTimeout(function() {
					$("body").removeClass(params.loadingClass);
				}, 0);

				params.complete(data);
				params.afterComplete();
			}
		}, params);

		if ( params.loadingClass != "" ) {
			if( $("body").hasClass(params.loadingClass) ) {
				return;
			}
			else {
				$("body").addClass(params.loadingClass);
			}
		}

		params.before();

		$.ajax(url, {
			data: params.data,
			method: params.method,
			error: function( xhr, ajaxOptions, thrownError ) {
				params.error(xhr, ajaxOptions, thrownError);
			},
			success: function( data ) {
				params.success( data );
			}
		});
	}

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
			method: "GET",
			before: function() {},
			after: function() {},
			complete: function() {},
			afterComplete: function() {},
			error: function() {}
		}, params);

		params.success = function( data ) {
			data = "<div>" + data + "</div>";

			if( params.filter ) {
				data = $(data).find(params.filter).outerHTML();
			}
			// else {
			// 	data = $(data).html();
			// }

			if( params.preload && data !== '' ) {
				$( data ).imagesLoaded( function() {
					params.after( data );

					setTimeout(function() {
						$("body").removeClass(params.loadingClass);
						params.complete(data);
						params.afterComplete();
					}, 1);
				} );

				// $.thb.loadImage(data, {
				// 	allLoaded: function( images ) {
				// 		params.after(data);

				// 		setTimeout(function() {
				// 			$("body").removeClass(params.loadingClass);
				// 			params.complete(data);
				// 			params.afterComplete();
				// 		}, 0);
				// 	}
				// });
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

		var transitionSupport = $.thb.transitionSupport();

		if( transitionSupport && params.waitfor ) {
			$.thb.transition(params.waitfor, function() {
				$.thb.load( url, params );
			});
		}
		else {
			$.thb.load( url, params );
		}

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

		params.afterComplete = function() {
			if( window.history && window.history.pushState ) {
				window.history.pushState({}, '', url);
			}
		};

		$.thb.loadUrl(url, params);
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
				lazy = ( src === '' || src === 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==' ) && img.data('src') && img.data('src') !== '';

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

				if ( ( imgdata.src && imgdata.src !== "" ) /*|| ( img && img.data('src') && img.data('src') !== '' )*/ ) {
					images.push( $(this) );
				}
			}
			else {
				$(this).find('img').each(function() {
					var imgdata = imgSrc( $(this) );

					if ( ( imgdata.src && imgdata.src !== "" ) /*|| ( img && img.data('src') && img.data('src') !== '' )*/ ) {
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
 * Check if we're running IE.
 *
 * @return {boolean}
 */
window.thb_is_ie = function() {
	return "ActiveXObject" in window;
};

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

/*!
 * imagesLoaded PACKAGED v3.1.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

(function(){function e(){}function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}function n(e){return function(){return this[e].apply(this,arguments)}}var i=e.prototype,r=this,o=r.EventEmitter;i.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},i.flattenListeners=function(e){var t,n=[];for(t=0;e.length>t;t+=1)n.push(e[t].listener);return n},i.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},i.addListener=function(e,n){var i,r=this.getListenersAsObject(e),o="object"==typeof n;for(i in r)r.hasOwnProperty(i)&&-1===t(r[i],n)&&r[i].push(o?n:{listener:n,once:!1});return this},i.on=n("addListener"),i.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},i.once=n("addOnceListener"),i.defineEvent=function(e){return this.getListeners(e),this},i.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},i.removeListener=function(e,n){var i,r,o=this.getListenersAsObject(e);for(r in o)o.hasOwnProperty(r)&&(i=t(o[r],n),-1!==i&&o[r].splice(i,1));return this},i.off=n("removeListener"),i.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},i.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},i.manipulateListeners=function(e,t,n){var i,r,o=e?this.removeListener:this.addListener,s=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(i=n.length;i--;)o.call(this,t,n[i]);else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?o.call(this,i,r):s.call(this,i,r));return this},i.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n)delete i[e];else if("object"===n)for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t];else delete this._events;return this},i.removeAllListeners=n("removeEvent"),i.emitEvent=function(e,t){var n,i,r,o,s=this.getListenersAsObject(e);for(r in s)if(s.hasOwnProperty(r))for(i=s[r].length;i--;)n=s[r][i],n.once===!0&&this.removeListener(e,n.listener),o=n.listener.apply(this,t||[]),o===this._getOnceReturnValue()&&this.removeListener(e,n.listener);return this},i.trigger=n("emitEvent"),i.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},i.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},i._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},i._getEvents=function(){return this._events||(this._events={})},e.noConflict=function(){return r.EventEmitter=o,e},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return e}):"object"==typeof module&&module.exports?module.exports=e:this.EventEmitter=e}).call(this),function(e){function t(t){var n=e.event;return n.target=n.target||n.srcElement||t,n}var n=document.documentElement,i=function(){};n.addEventListener?i=function(e,t,n){e.addEventListener(t,n,!1)}:n.attachEvent&&(i=function(e,n,i){e[n+i]=i.handleEvent?function(){var n=t(e);i.handleEvent.call(i,n)}:function(){var n=t(e);i.call(e,n)},e.attachEvent("on"+n,e[n+i])});var r=function(){};n.removeEventListener?r=function(e,t,n){e.removeEventListener(t,n,!1)}:n.detachEvent&&(r=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void 0}});var o={bind:i,unbind:r};"function"==typeof define&&define.amd?define("eventie/eventie",o):e.eventie=o}(this),function(e,t){"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],function(n,i){return t(e,n,i)}):"object"==typeof exports?module.exports=t(e,require("eventEmitter"),require("eventie")):e.imagesLoaded=t(e,e.EventEmitter,e.eventie)}(this,function(e,t,n){function i(e,t){for(var n in t)e[n]=t[n];return e}function r(e){return"[object Array]"===d.call(e)}function o(e){var t=[];if(r(e))t=e;else if("number"==typeof e.length)for(var n=0,i=e.length;i>n;n++)t.push(e[n]);else t.push(e);return t}function s(e,t,n){if(!(this instanceof s))return new s(e,t);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=o(e),this.options=i({},this.options),"function"==typeof t?n=t:i(this.options,t),n&&this.on("always",n),this.getImages(),a&&(this.jqDeferred=new a.Deferred);var r=this;setTimeout(function(){r.check()})}function c(e){this.img=e}function f(e){this.src=e,v[e]=this}var a=e.jQuery,u=e.console,h=u!==void 0,d=Object.prototype.toString;s.prototype=new t,s.prototype.options={},s.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);for(var i=n.querySelectorAll("img"),r=0,o=i.length;o>r;r++){var s=i[r];this.addImage(s)}}},s.prototype.addImage=function(e){var t=new c(e);this.images.push(t)},s.prototype.check=function(){function e(e,r){return t.options.debug&&h&&u.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0}var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void 0;for(var r=0;i>r;r++){var o=this.images[r];o.on("confirm",e),o.check()}},s.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify&&t.jqDeferred.notify(t,e)})},s.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},a&&(a.fn.imagesLoaded=function(e,t){var n=new s(this,e,t);return n.jqDeferred.promise(a(this))}),c.prototype=new t,c.prototype.check=function(){var e=v[this.img.src]||new f(this.img.src);if(e.isConfirmed)return this.confirm(e.isLoaded,"cached was confirmed"),void 0;if(this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this;e.on("confirm",function(e,n){return t.confirm(e.isLoaded,n),!0}),e.check()},c.prototype.confirm=function(e,t){this.isLoaded=e,this.emit("confirm",this,t)};var v={};return f.prototype=new t,f.prototype.check=function(){if(!this.isChecked){var e=new Image;n.bind(e,"load",this),n.bind(e,"error",this),e.src=this.src,this.isChecked=!0}},f.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},f.prototype.onload=function(e){this.confirm(!0,"onload"),this.unbindProxyEvents(e)},f.prototype.onerror=function(e){this.confirm(!1,"onerror"),this.unbindProxyEvents(e)},f.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},f.prototype.unbindProxyEvents=function(e){n.unbind(e.target,"load",this),n.unbind(e.target,"error",this)},s});

/**
 * Inview.
 */

(function(d){var p={},e,a,h=document,i=window,f=h.documentElement,j=d.expando;d.event.special.inview={add:function(a){p[a.guid+"-"+this[j]]={data:a,$element:d(this)}},remove:function(a){try{delete p[a.guid+"-"+this[j]]}catch(d){}}};d(i).bind("scroll resize",function(){e=a=null});!f.addEventListener&&f.attachEvent&&f.attachEvent("onfocusin",function(){a=null});setInterval(function(){var k=d(),j,n=0;d.each(p,function(a,b){var c=b.data.selector,d=b.$element;k=k.add(c?d.find(c):d)});if(j=k.length){var b;
if(!(b=e)){var g={height:i.innerHeight,width:i.innerWidth};if(!g.height&&((b=h.compatMode)||!d.support.boxModel))b="CSS1Compat"===b?f:h.body,g={height:b.clientHeight,width:b.clientWidth};b=g}e=b;for(a=a||{top:i.pageYOffset||f.scrollTop||h.body.scrollTop,left:i.pageXOffset||f.scrollLeft||h.body.scrollLeft};n<j;n++)if(d.contains(f,k[n])){b=d(k[n]);var l=b.height(),m=b.width(),c=b.offset(),g=b.data("inview");if(!a||!e)break;c.top+l>a.top&&c.top<a.top+e.height&&c.left+m>a.left&&c.left<a.left+e.width?
(m=a.left>c.left?"right":a.left+e.width<c.left+m?"left":"both",l=a.top>c.top?"bottom":a.top+e.height<c.top+l?"top":"both",c=m+"-"+l,(!g||g!==c)&&b.data("inview",c).trigger("inview",[!0,m,l])):g&&b.data("inview",!1).trigger("inview",[!1])}}},250)})(jQuery);