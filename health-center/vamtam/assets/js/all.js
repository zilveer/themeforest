/**
 * jQuery gMap - Google Maps API V3
 *
 * @url     http://github.com/marioestrada/jQuery-gMap
 * @author  Mario Estrada <me@mario.ec> based on original plugin by Cedric Kastner <cedric@nur-text.de>
 * @version 2.1.1
 */
(function($, undefined) {
	"use strict";

	// Main plugin function
	$.fn.gMap = function(options, methods_options) {
		var $this, args;
		//Asynchronously load Maps API
		if ( (!window.google || !google.maps) && !window.google_maps_api_loading) {
			$this = this;
			args = arguments;
			var cb = 'callback_' + Math.random().toString().replace('.', '');

			window.google_maps_api_loading = cb;

			window[cb] = function() {
				$.fn.gMap.apply($this, args);
				$(window).trigger('google-maps-async-loading');
				window[cb] = null;
				try {
					delete window[cb];
				} catch(e) {}
			};

			var key = window.WPV_FRONT && window.WPV_FRONT.gmap_api_key ? '&key=' + WPV_FRONT.gmap_api_key : '';

			$.getScript('https://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=' + cb + key);
			return this;
		} else if ( (!window.google || !google.maps) && window.google_maps_api_loading) {
			$this = this;
			args = arguments;

			$(window).bind('google-maps-async-loading', function() {
				$.fn.gMap.apply($this, args);
			});

			return this;
		}

		// Optional methods
		switch (options) {
			case 'addMarker':
				return $(this).trigger('gMap.addMarker', [methods_options.latitude, methods_options.longitude, methods_options.content, methods_options.icon, methods_options.popup]);
			case 'centerAt':
				return $(this).trigger('gMap.centerAt', [methods_options.latitude, methods_options.longitude, methods_options.zoom]);
		}

		// Build main options before element iteration
		var opts = $.extend({}, $.fn.gMap.defaults, options);

		// Iterate through each element
		return this.each(function() {
			// Create map and set initial options
			var $gmap = new google.maps.Map(this);

			// Create new object to geocode addresses
			var $geocoder = new google.maps.Geocoder();

			// Check for address to center on
			if (opts.address) {
				// Get coordinates for given address and center the map
				$geocoder.geocode({
					address: opts.address
				}, function(gresult) {
					if (gresult && gresult.length) $gmap.setCenter(gresult[0].geometry.location);
				});
			} else {
				// Check for coordinates to center on
				if (opts.latitude && opts.longitude) {
					// Center map to coordinates given by option
					$gmap.setCenter(new google.maps.LatLng(opts.latitude, opts.longitude));
				} else {
					// Check for a marker to center on (if no coordinates given)
					if ($.isArray(opts.markers) && opts.markers.length > 0) {
						// Check if the marker has an address
						if (opts.markers[0].address) {
							// Get the coordinates for given marker address and center
							$geocoder.geocode({
								address: opts.markers[0].address
							}, function(gresult) {
								if (gresult && gresult.length > 0) $gmap.setCenter(gresult[0].geometry.location);
							});
						} else {
							// Center the map to coordinates given by marker
							$gmap.setCenter(new google.maps.LatLng(opts.markers[0].latitude, opts.markers[0].longitude));
						}
					} else {
						// Revert back to world view
						$gmap.setCenter(new google.maps.LatLng(34.885931, 9.84375));
					}
				}
			}
			$gmap.setZoom(opts.zoom);

			// Set the preferred map type
			$gmap.setMapTypeId(google.maps.MapTypeId[opts.maptype]);

			// Set scrollwheel option
			var map_options = {
				scrollwheel: opts.scrollwheel,
				draggable: opts.draggable,
				disableDoubleClickZoom: !opts.doubleclickzoom
			};
			// Check for map controls
			if (opts.controls === false) {
				$.extend(map_options, {
					disableDefaultUI: true
				});
			} else if (opts.controls.length !== 0) {
				$.extend(map_options, opts.controls, {
					disableDefaultUI: true
				});
			}

			$gmap.setOptions($.extend(map_options, opts.custom));

			// Create new icon
			var gicon = new google.maps.Marker();

			// Set icon properties from global options
			var marker_icon = new google.maps.MarkerImage(opts.icon.image);
			marker_icon.size = new google.maps.Size(opts.icon.iconsize[0], opts.icon.iconsize[1]);
			marker_icon.anchor = new google.maps.Point(opts.icon.iconanchor[0], opts.icon.iconanchor[1]);
			gicon.setIcon(marker_icon);

			if (opts.icon.shadow) {
				var marker_shadow = new google.maps.MarkerImage(opts.icon.shadow);
				marker_shadow.size = new google.maps.Size(opts.icon.shadowsize[0], opts.icon.shadowsize[1]);
				marker_shadow.anchor = new google.maps.Point(opts.icon.shadowanchor[0], opts.icon.shadowanchor[1]);
				gicon.setShadow(marker_shadow);
			}

			// Bind actions
			$(this).bind('gMap.centerAt', function(e, latitude, longitude, zoom) {
				if (zoom) $gmap.setZoom(zoom);

				$gmap.panTo(new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude)));
			});

			var last_infowindow;
			$(this).bind('gMap.addMarker', function(e, latitude, longitude, content, icon, popup) {
				var glatlng = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));

				var gmarker = new google.maps.Marker({
					position: glatlng
				});

				if (icon) {
					marker_icon = new google.maps.MarkerImage(icon.image);
					marker_icon.size = new google.maps.Size(icon.iconsize[0], icon.iconsize[1]);
					marker_icon.anchor = new google.maps.Point(icon.iconanchor[0], icon.iconanchor[1]);
					gmarker.setIcon(marker_icon);

					if (icon.shadow) {
						marker_shadow = new google.maps.MarkerImage(icon.shadow);
						marker_shadow.size = new google.maps.Size(icon.shadowsize[0], icon.shadowsize[1]);
						marker_shadow.anchor = new google.maps.Point(icon.shadowanchor[0], icon.shadowanchor[1]);
						gicon.setShadow(marker_shadow);
					}
				} else {
					gmarker.setIcon(gicon.getIcon());
					gmarker.setShadow(gicon.getShadow());
				}

				if (content) {
					if (content === '_latlng') content = latitude + ', ' + longitude;

					var infowindow = new google.maps.InfoWindow({
						content: opts.html_prepend + content + opts.html_append
					});

					google.maps.event.addListener(gmarker, 'click', function() {
						if(last_infowindow)
							last_infowindow.close();
						infowindow.open($gmap, gmarker);
						last_infowindow = infowindow;
					});

					if(popup)
						infowindow.open($gmap, gmarker);
				}
				gmarker.setMap($gmap);
			});

			var addMarker = function(marker, $this) {
				return function(gresult) {
					// Create marker
					if (gresult && gresult.length > 0) {
						$($this).trigger('gMap.addMarker', [gresult[0].geometry.location.lat(), gresult[0].geometry.location.lng(), marker.html, marker.icon, marker.popup]);
					}
				};
			};

			// Loop through marker array
			for (var j = 0; j < opts.markers.length; j++) {
				// Get the options from current marker
				var marker = opts.markers[j];

				// Check if address is available
				if (marker.address) {
					// Check for reference to the marker's address
					if (marker.html === '_address') marker.html = marker.address;

					// Get the point for given address
					var $this = this;
					$geocoder.geocode({
						address: marker.address
					}, (addMarker)(marker, $this));
				} else {
					$(this).trigger('gMap.addMarker', [marker.latitude, marker.longitude, marker.html, marker.icon, marker.popup]);
				}
			}
		});

	};

	// Default settings
	$.fn.gMap.defaults = {
		address: '',
		latitude: 0,
		longitude: 0,
		zoom: 1,
		markers: [],
		controls: [],
		scrollwheel: false,
		draggable: true,
		doubleclickzoom: true,
		maptype: 'ROADMAP',
		html_prepend: '<div class="gmap_marker">',
		html_append: '</div>',
		icon: {
			image: "https://www.google.com/mapfiles/marker.png",
			shadow: "https://www.google.com/mapfiles/shadow50.png",
			iconsize: [20, 34],
			shadowsize: [37, 34],
			iconanchor: [9, 34],
			shadowanchor: [6, 34]
		}
	};

})(jQuery);
/*! Magnific Popup - v0.9.5 - 2013-08-21
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2013 Dmitry Semenov; */
;(function($) {
  "use strict";
/*>>core*/
/**
 *
 * Magnific Popup Core JS file
 *
 */


/**
 * Private static constants
 */
var CLOSE_EVENT = 'Close',
	BEFORE_CLOSE_EVENT = 'BeforeClose',
	AFTER_CLOSE_EVENT = 'AfterClose',
	BEFORE_APPEND_EVENT = 'BeforeAppend',
	MARKUP_PARSE_EVENT = 'MarkupParse',
	OPEN_EVENT = 'Open',
	CHANGE_EVENT = 'Change',
	NS = 'mfp',
	EVENT_NS = '.' + NS,
	READY_CLASS = 'mfp-ready',
	REMOVING_CLASS = 'mfp-removing',
	PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


/**
 * Private vars
 */
var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
	MagnificPopup = function(){},
	_isJQ = !!(window.jQuery),
	_prevStatus,
	_window = $(window),
	_body,
	_document,
	_prevContentType,
	_wrapClasses,
	_currPopupType;


/**
 * Private functions
 */
var _mfpOn = function(name, f) {
		mfp.ev.on(NS + name + EVENT_NS, f);
	},
	_getEl = function(className, appendTo, html, raw) {
		var el = document.createElement('div');
		el.className = 'mfp-'+className;
		if(html) {
			el.innerHTML = html;
		}
		if(!raw) {
			el = $(el);
			if(appendTo) {
				el.appendTo(appendTo);
			}
		} else if(appendTo) {
			appendTo.appendChild(el);
		}
		return el;
	},
	_mfpTrigger = function(e, data) {
		mfp.ev.triggerHandler(NS + e, data);

		if(mfp.st.callbacks) {
			// converts "mfpEventName" to "eventName" callback and triggers it if it's present
			e = e.charAt(0).toLowerCase() + e.slice(1);
			if(mfp.st.callbacks[e]) {
				mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
			}
		}
	},
	_setFocus = function() {
		(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
	},
	_getCloseBtn = function(type) {
		if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
			mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
			_currPopupType = type;
		}
		return mfp.currTemplate.closeBtn;
	},
	// Initialize Magnific Popup only when called at least once
	_checkInstance = function() {
		if(!$.magnificPopup.instance) {
			mfp = new MagnificPopup();
			mfp.init();
			$.magnificPopup.instance = mfp;
		}
	},
	// Check to close popup or not
	// "target" is an element that was clicked
	_checkIfClose = function(target) {

		if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
			return;
		}

		var closeOnContent = mfp.st.closeOnContentClick;
		var closeOnBg = mfp.st.closeOnBgClick;

		if(closeOnContent && closeOnBg) {
			return true;
		} else {

			// We close the popup if click is on close button or on preloader. Or if there is no content.
			if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
				return true;
			}

			// if click is outside the content
			if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
				if(closeOnBg) {
					// last check, if the clicked element is in DOM, (in case it's removed onclick)
					if( $.contains(document, target) ) {
						return true;
					}
				}
			} else if(closeOnContent) {
				return true;
			}

		}
		return false;
	},
	// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
	supportsTransitions = function() {
		var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
			v = ['ms','O','Moz','Webkit']; // 'v' for vendor

		if( s.transition !== undefined ) {
			return true;
		}

		while( v.length ) {
			if( v.pop() + 'Transition' in s ) {
				return true;
			}
		}

		return false;
	};



/**
 * Public functions
 */
MagnificPopup.prototype = {

	constructor: MagnificPopup,

	/**
	 * Initializes Magnific Popup plugin.
	 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
	 */
	init: function() {
		var appVersion = navigator.appVersion;
		mfp.isIE7 = appVersion.indexOf("MSIE 7.") !== -1;
		mfp.isIE8 = appVersion.indexOf("MSIE 8.") !== -1;
		mfp.isLowIE = mfp.isIE7 || mfp.isIE8;
		mfp.isAndroid = (/android/gi).test(appVersion);
		mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
		mfp.supportsTransition = supportsTransitions();

		// We disable fixed positioned lightbox on devices that don't handle it nicely.
		// If you know a better way of detecting this - let me know.
		mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
		_body = $(document.body);
		_document = $(document);

		mfp.popupsCache = {};
	},

	/**
	 * Opens popup
	 * @param  data [description]
	 */
	open: function(data) {

		var i;

		if(data.isObj === false) {
			// convert jQuery collection to array to avoid conflicts later
			mfp.items = data.items.toArray();

			mfp.index = 0;
			var items = data.items,
				item;
			for(i = 0; i < items.length; i++) {
				item = items[i];
				if(item.parsed) {
					item = item.el[0];
				}
				if(item === data.el[0]) {
					mfp.index = i;
					break;
				}
			}
		} else {
			mfp.items = $.isArray(data.items) ? data.items : [data.items];
			mfp.index = data.index || 0;
		}

		// if popup is already opened - we just update the content
		if(mfp.isOpen) {
			mfp.updateItemHTML();
			return;
		}

		mfp.types = [];
		_wrapClasses = '';
		if(data.mainEl && data.mainEl.length) {
			mfp.ev = data.mainEl.eq(0);
		} else {
			mfp.ev = _document;
		}

		if(data.key) {
			if(!mfp.popupsCache[data.key]) {
				mfp.popupsCache[data.key] = {};
			}
			mfp.currTemplate = mfp.popupsCache[data.key];
		} else {
			mfp.currTemplate = {};
		}



		mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data );
		mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

		if(mfp.st.modal) {
			mfp.st.closeOnContentClick = false;
			mfp.st.closeOnBgClick = false;
			mfp.st.showCloseBtn = false;
			mfp.st.enableEscapeKey = false;
		}


		// Building markup
		// main containers are created only once
		if(!mfp.bgOverlay) {

			// Dark overlay
			mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
				mfp.close();
			});

			mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
				if(_checkIfClose(e.target)) {
					mfp.close();
				}
			});

			mfp.container = _getEl('container', mfp.wrap);
		}

		mfp.contentContainer = _getEl('content');
		if(mfp.st.preloader) {
			mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
		}


		// Initializing modules
		var modules = $.magnificPopup.modules;
		for(i = 0; i < modules.length; i++) {
			var n = modules[i];
			n = n.charAt(0).toUpperCase() + n.slice(1);
			mfp['init'+n].call(mfp);
		}
		_mfpTrigger('BeforeOpen');


		if(mfp.st.showCloseBtn) {
			// Close button
			if(!mfp.st.closeBtnInside) {
				mfp.wrap.append( _getCloseBtn() );
			} else {
				_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
					values.close_replaceWith = _getCloseBtn(item.type);
				});
				_wrapClasses += ' mfp-close-btn-in';
			}
		}

		if(mfp.st.alignTop) {
			_wrapClasses += ' mfp-align-top';
		}



		if(mfp.fixedContentPos) {
			mfp.wrap.css({
				overflow: mfp.st.overflowY,
				overflowX: 'hidden',
				overflowY: mfp.st.overflowY
			});
		} else {
			mfp.wrap.css({
				top: _window.scrollTop(),
				position: 'absolute'
			});
		}
		if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
			mfp.bgOverlay.css({
				height: _document.height(),
				position: 'absolute'
			});
		}



		if(mfp.st.enableEscapeKey) {
			// Close on ESC key
			_document.on('keyup' + EVENT_NS, function(e) {
				if(e.keyCode === 27) {
					mfp.close();
				}
			});
		}

		_window.on('resize' + EVENT_NS, function() {
			mfp.updateSize();
		});


		if(!mfp.st.closeOnContentClick) {
			_wrapClasses += ' mfp-auto-cursor';
		}

		if(_wrapClasses)
			mfp.wrap.addClass(_wrapClasses);


		// this triggers recalculation of layout, so we get it once to not to trigger twice
		var windowHeight = mfp.wH = _window.height();


		var windowStyles = {};

		if( mfp.fixedContentPos ) {
            if(mfp._hasScrollBar(windowHeight)){
                var s = mfp._getScrollbarSize();
                if(s) {
                    windowStyles.paddingRight = s;
                }
            }
        }

		if(mfp.fixedContentPos) {
			if(!mfp.isIE7) {
				windowStyles.overflow = 'hidden';
			} else {
				// ie7 double-scroll bug
				$('body, html').css('overflow', 'hidden');
			}
		}



		var classesToadd = mfp.st.mainClass;
		if(mfp.isIE7) {
			classesToadd += ' mfp-ie7';
		}
		if(classesToadd) {
			mfp._addClassToMFP( classesToadd );
		}

		// add content
		mfp.updateItemHTML();

		_mfpTrigger('BuildControls');


		// remove scrollbar, add padding e.t.c
		$('html').css(windowStyles);

		// add everything to DOM
		mfp.bgOverlay.add(mfp.wrap).prependTo( document.body );



		// Save last focused element
		mfp._lastFocusedEl = document.activeElement;

		// Wait for next cycle to allow CSS transition
		setTimeout(function() {

			if(mfp.content) {
				mfp._addClassToMFP(READY_CLASS);
				_setFocus();
			} else {
				// if content is not defined (not loaded e.t.c) we add class only for BG
				mfp.bgOverlay.addClass(READY_CLASS);
			}

			// Trap the focus in popup
			_document.on('focusin' + EVENT_NS, function (e) {
				if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
					_setFocus();
					return false;
				}
			});

		}, 16);

		mfp.isOpen = true;
		mfp.updateSize(windowHeight);
		_mfpTrigger(OPEN_EVENT);
	},

	/**
	 * Closes the popup
	 */
	close: function() {
		if(!mfp.isOpen) return;
		_mfpTrigger(BEFORE_CLOSE_EVENT);

		mfp.isOpen = false;
		// for CSS3 animation
		if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
			mfp._addClassToMFP(REMOVING_CLASS);
			setTimeout(function() {
				mfp._close();
			}, mfp.st.removalDelay);
		} else {
			mfp._close();
		}
	},

	/**
	 * Helper for close() function
	 */
	_close: function() {
		_mfpTrigger(CLOSE_EVENT);

		var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

		mfp.bgOverlay.detach();
		mfp.wrap.detach();
		mfp.container.empty();

		if(mfp.st.mainClass) {
			classesToRemove += mfp.st.mainClass + ' ';
		}

		mfp._removeClassFromMFP(classesToRemove);

		if(mfp.fixedContentPos) {
			var windowStyles = {paddingRight: ''};
			if(mfp.isIE7) {
				$('body, html').css('overflow', '');
			} else {
				windowStyles.overflow = '';
			}
			$('html').css(windowStyles);
		}

		_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
		mfp.ev.off(EVENT_NS);

		// clean up DOM elements that aren't removed
		mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
		mfp.bgOverlay.attr('class', 'mfp-bg');
		mfp.container.attr('class', 'mfp-container');

		// remove close button from target element
		if(mfp.st.showCloseBtn &&
		(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
			if(mfp.currTemplate.closeBtn)
				mfp.currTemplate.closeBtn.detach();
		}


		if(mfp._lastFocusedEl) {
			$(mfp._lastFocusedEl).focus(); // put tab focus back
		}
		mfp.currItem = null;
		mfp.content = null;
		mfp.currTemplate = null;
		mfp.prevHeight = 0;

		_mfpTrigger(AFTER_CLOSE_EVENT);
	},

	updateSize: function(winHeight) {

		if(mfp.isIOS) {
			// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
			var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
			var height = window.innerHeight * zoomLevel;
			mfp.wrap.css('height', height);
			mfp.wH = height;
		} else {
			mfp.wH = winHeight || _window.height();
		}
		// Fixes #84: popup incorrectly positioned with position:relative on body
		if(!mfp.fixedContentPos) {
			mfp.wrap.css('height', mfp.wH);
		}

		_mfpTrigger('Resize');

	},

	/**
	 * Set content of popup based on current index
	 */
	updateItemHTML: function() {
		var item = mfp.items[mfp.index];

		// Detach and perform modifications
		mfp.contentContainer.detach();

		if(mfp.content)
			mfp.content.detach();

		if(!item.parsed) {
			item = mfp.parseEl( mfp.index );
		}

		var type = item.type;

		_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
		// BeforeChange event works like so:
		// _mfpOn('BeforeChange', function(e, prevType, newType) { });

		mfp.currItem = item;





		if(!mfp.currTemplate[type]) {
			var markup = mfp.st[type] ? mfp.st[type].markup : false;

			// allows to modify markup
			_mfpTrigger('FirstMarkupParse', markup);

			if(markup) {
				mfp.currTemplate[type] = $(markup);
			} else {
				// if there is no markup found we just define that template is parsed
				mfp.currTemplate[type] = true;
			}
		}

		if(_prevContentType && _prevContentType !== item.type) {
			mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
		}

		var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
		mfp.appendContent(newContent, type);

		item.preloaded = true;

		_mfpTrigger(CHANGE_EVENT, item);
		_prevContentType = item.type;

		// Append container back after its content changed
		mfp.container.prepend(mfp.contentContainer);

		_mfpTrigger('AfterChange');
	},


	/**
	 * Set HTML content of popup
	 */
	appendContent: function(newContent, type) {
		mfp.content = newContent;

		if(newContent) {
			if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
				mfp.currTemplate[type] === true) {
				// if there is no markup, we just append close button element inside
				if(!mfp.content.find('.mfp-close').length) {
					mfp.content.append(_getCloseBtn());
				}
			} else {
				mfp.content = newContent;
			}
		} else {
			mfp.content = '';
		}

		_mfpTrigger(BEFORE_APPEND_EVENT);
		mfp.container.addClass('mfp-'+type+'-holder');

		mfp.contentContainer.append(mfp.content);
	},




	/**
	 * Creates Magnific Popup data object based on given data
	 * @param  {int} index Index of item to parse
	 */
	parseEl: function(index) {
		var item = mfp.items[index],
			type = item.type;

		if(item.tagName) {
			item = { el: $(item) };
		} else {
			item = { data: item, src: item.src };
		}

		if(item.el) {
			var types = mfp.types;

			// check for 'mfp-TYPE' class
			for(var i = 0; i < types.length; i++) {
				if( item.el.hasClass('mfp-'+types[i]) ) {
					type = types[i];
					break;
				}
			}

			item.src = item.el.attr('data-mfp-src');
			if(!item.src) {
				item.src = item.el.attr('href');
			}
		}

		item.type = type || mfp.st.type || 'inline';
		item.index = index;
		item.parsed = true;
		mfp.items[index] = item;
		_mfpTrigger('ElementParse', item);

		return mfp.items[index];
	},


	/**
	 * Initializes single popup or a group of popups
	 */
	addGroup: function(el, options) {
		var eHandler = function(e) {
			e.mfpEl = this;
			mfp._openClick(e, el, options);
		};

		if(!options) {
			options = {};
		}

		var eName = 'click.magnificPopup';
		options.mainEl = el;

		if(options.items) {
			options.isObj = true;
			el.off(eName).on(eName, eHandler);
		} else {
			options.isObj = false;
			if(options.delegate) {
				el.off(eName).on(eName, options.delegate , eHandler);
			} else {
				options.items = el;
				el.off(eName).on(eName, eHandler);
			}
		}
	},
	_openClick: function(e, el, options) {
		var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


		if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey ) ) {
			return;
		}

		var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

		if(disableOn) {
			if($.isFunction(disableOn)) {
				if( !disableOn.call(mfp) ) {
					return true;
				}
			} else { // else it's number
				if( _window.width() < disableOn ) {
					return true;
				}
			}
		}

		if(e.type) {
			e.preventDefault();

			// This will prevent popup from closing if element is inside and popup is already opened
			if(mfp.isOpen) {
				e.stopPropagation();
			}
		}


		options.el = $(e.mfpEl);
		if(options.delegate) {
			options.items = el.find(options.delegate);
		}
		mfp.open(options);
	},


	/**
	 * Updates text on preloader
	 */
	updateStatus: function(status, text) {

		if(mfp.preloader) {
			if(_prevStatus !== status) {
				mfp.container.removeClass('mfp-s-'+_prevStatus);
			}

			if(!text && status === 'loading') {
				text = mfp.st.tLoading;
			}

			var data = {
				status: status,
				text: text
			};
			// allows to modify status
			_mfpTrigger('UpdateStatus', data);

			status = data.status;
			text = data.text;

			mfp.preloader.html(text);

			mfp.preloader.find('a').on('click', function(e) {
				e.stopImmediatePropagation();
			});

			mfp.container.addClass('mfp-s-'+status);
			_prevStatus = status;
		}
	},


	/*
		"Private" helpers that aren't private at all
	 */
	_addClassToMFP: function(cName) {
		mfp.bgOverlay.addClass(cName);
		mfp.wrap.addClass(cName);
	},
	_removeClassFromMFP: function(cName) {
		this.bgOverlay.removeClass(cName);
		mfp.wrap.removeClass(cName);
	},
	_hasScrollBar: function(winHeight) {
		return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
	},
	_parseMarkup: function(template, values, item) {
		var arr;
		if(item.data) {
			values = $.extend(item.data, values);
		}
		_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

		$.each(values, function(key, value) {
			if(value === undefined || value === false) {
				return true;
			}
			arr = key.split('_');
			if(arr.length > 1) {
				var el = template.find(EVENT_NS + '-'+arr[0]);

				if(el.length > 0) {
					var attr = arr[1];
					if(attr === 'replaceWith') {
						if(el[0] !== value[0]) {
							el.replaceWith(value);
						}
					} else if(attr === 'img') {
						if(el.is('img')) {
							el.attr('src', value);
						} else {
							el.replaceWith( '<img src="'+value+'" class="' + el.attr('class') + '" />' );
						}
					} else {
						el.attr(arr[1], value);
					}
				}

			} else {
				template.find(EVENT_NS + '-'+key).html(value);
			}
		});
	},

	_getScrollbarSize: function() {
		// thx David
		if(mfp.scrollbarSize === undefined) {
			var scrollDiv = document.createElement("div");
			scrollDiv.id = "mfp-sbm";
			scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
			document.body.appendChild(scrollDiv);
			mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
			document.body.removeChild(scrollDiv);
		}
		return mfp.scrollbarSize;
	}

}; /* MagnificPopup core prototype end */




/**
 * Public static functions
 */
$.magnificPopup = {
	instance: null,
	proto: MagnificPopup.prototype,
	modules: [],

	open: function(options, index) {
		_checkInstance();

		if(!options)
			options = {};

		options.isObj = true;
		options.index = index || 0;
		return this.instance.open(options);
	},

	close: function() {
		return $.magnificPopup.instance.close();
	},

	registerModule: function(name, module) {
		if(module.options) {
			$.magnificPopup.defaults[name] = module.options;
		}
		$.extend(this.proto, module.proto);
		this.modules.push(name);
	},

	defaults: {

		// Info about options is in docs:
		// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options

		disableOn: 0,

		key: null,

		midClick: false,

		mainClass: '',

		preloader: true,

		focus: '', // CSS selector of input to focus after popup is opened

		closeOnContentClick: false,

		closeOnBgClick: true,

		closeBtnInside: true,

		showCloseBtn: true,

		enableEscapeKey: true,

		modal: false,

		alignTop: false,

		removalDelay: 0,

		fixedContentPos: 'auto',

		fixedBgPos: 'auto',

		overflowY: 'auto',

		closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>',

		tClose: 'Close (Esc)',

		tLoading: 'Loading...'

	}
};



$.fn.magnificPopup = function(options) {
	_checkInstance();

	var jqEl = $(this);

	// We call some API method of first param is a string
	if (typeof options === "string" ) {

		if(options === 'open') {
			var items,
				itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
				index = parseInt(arguments[1], 10) || 0;

			if(itemOpts.items) {
				items = itemOpts.items[index];
			} else {
				items = jqEl;
				if(itemOpts.delegate) {
					items = items.find(itemOpts.delegate);
				}
				items = items.eq( index );
			}
			mfp._openClick({mfpEl:items}, jqEl, itemOpts);
		} else {
			if(mfp.isOpen)
				mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
		}

	} else {

		/*
		 * As Zepto doesn't support .data() method for objects
		 * and it works only in normal browsers
		 * we assign "options" object directly to the DOM element. FTW!
		 */
		if(_isJQ) {
			jqEl.data('magnificPopup', options);
		} else {
			jqEl[0].magnificPopup = options;
		}

		mfp.addGroup(jqEl, options);

	}
	return jqEl;
};


//Quick benchmark
/*
var start = performance.now(),
	i,
	rounds = 1000;

for(i = 0; i < rounds; i++) {

}
console.log('Test #1:', performance.now() - start);

start = performance.now();
for(i = 0; i < rounds; i++) {

}
console.log('Test #2:', performance.now() - start);
*/


/*>>core*/

/*>>inline*/

var INLINE_NS = 'inline',
	_hiddenClass,
	_inlinePlaceholder,
	_lastInlineElement,
	_putInlineElementsBack = function() {
		if(_lastInlineElement) {
			_inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
			_lastInlineElement = null;
		}
	};

$.magnificPopup.registerModule(INLINE_NS, {
	options: {
		hiddenClass: 'hide', // will be appended with `mfp-` prefix
		markup: '',
		tNotFound: 'Content not found'
	},
	proto: {

		initInline: function() {
			mfp.types.push(INLINE_NS);

			_mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
				_putInlineElementsBack();
			});
		},

		getInline: function(item, template) {

			_putInlineElementsBack();

			if(item.src) {
				var inlineSt = mfp.st.inline,
					el = $(item.src);

				if(el.length) {

					// If target element has parent - we replace it with placeholder and put it back after popup is closed
					var parent = el[0].parentNode;
					if(parent && parent.tagName) {
						if(!_inlinePlaceholder) {
							_hiddenClass = inlineSt.hiddenClass;
							_inlinePlaceholder = _getEl(_hiddenClass);
							_hiddenClass = 'mfp-'+_hiddenClass;
						}
						// replace target inline element with placeholder
						_lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
					}

					mfp.updateStatus('ready');
				} else {
					mfp.updateStatus('error', inlineSt.tNotFound);
					el = $('<div>');
				}

				item.inlineElement = el;
				return el;
			}

			mfp.updateStatus('ready');
			mfp._parseMarkup(template, {}, item);
			return template;
		}
	}
});

/*>>inline*/

/*>>ajax*/
var AJAX_NS = 'ajax',
	_ajaxCur,
	_removeAjaxCursor = function() {
		if(_ajaxCur) {
			_body.removeClass(_ajaxCur);
		}
	};

$.magnificPopup.registerModule(AJAX_NS, {

	options: {
		settings: null,
		cursor: 'mfp-ajax-cur',
		tError: '<a href="%url%">The content</a> could not be loaded.'
	},

	proto: {
		initAjax: function() {
			mfp.types.push(AJAX_NS);
			_ajaxCur = mfp.st.ajax.cursor;

			_mfpOn(CLOSE_EVENT+'.'+AJAX_NS, function() {
				_removeAjaxCursor();
				if(mfp.req) {
					mfp.req.abort();
				}
			});
		},

		getAjax: function(item) {

			if(_ajaxCur)
				_body.addClass(_ajaxCur);

			mfp.updateStatus('loading');

			var opts = $.extend({
				url: item.src,
				success: function(data, textStatus, jqXHR) {
					var temp = {
						data:data,
						xhr:jqXHR
					};

					_mfpTrigger('ParseAjax', temp);

					mfp.appendContent( $(temp.data), AJAX_NS );

					item.finished = true;

					_removeAjaxCursor();

					_setFocus();

					setTimeout(function() {
						mfp.wrap.addClass(READY_CLASS);
					}, 16);

					mfp.updateStatus('ready');

					_mfpTrigger('AjaxContentAdded');
				},
				error: function() {
					_removeAjaxCursor();
					item.finished = item.loadError = true;
					mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
				}
			}, mfp.st.ajax.settings);

			mfp.req = $.ajax(opts);

			return '';
		}
	}
});







/*>>ajax*/

/*>>image*/
var _imgInterval,
	_getTitle = function(item) {
		if(item.data && item.data.title !== undefined)
			return item.data.title;

		var src = mfp.st.image.titleSrc;

		if(src) {
			if($.isFunction(src)) {
				return src.call(mfp, item);
			} else if(item.el) {
				return item.el.attr(src) || '';
			}
		}
		return '';
	};

$.magnificPopup.registerModule('image', {

	options: {
		markup: '<div class="mfp-figure">'+
					'<div class="mfp-close"></div>'+
					'<div class="mfp-img"></div>'+
					'<div class="mfp-bottom-bar">'+
						'<div class="mfp-title"></div>'+
						'<div class="mfp-counter"></div>'+
					'</div>'+
				'</div>',
		cursor: 'mfp-zoom-out-cur',
		titleSrc: 'title',
		verticalFit: true,
		tError: '<a href="%url%">The image</a> could not be loaded.'
	},

	proto: {
		initImage: function() {
			var imgSt = mfp.st.image,
				ns = '.image';

			mfp.types.push('image');

			_mfpOn(OPEN_EVENT+ns, function() {
				if(mfp.currItem.type === 'image' && imgSt.cursor) {
					_body.addClass(imgSt.cursor);
				}
			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(imgSt.cursor) {
					_body.removeClass(imgSt.cursor);
				}
				_window.off('resize' + EVENT_NS);
			});

			_mfpOn('Resize'+ns, mfp.resizeImage);
			if(mfp.isLowIE) {
				_mfpOn('AfterChange', mfp.resizeImage);
			}
		},
		resizeImage: function() {
			var item = mfp.currItem;
			if(!item || !item.img) return;

			if(mfp.st.image.verticalFit) {
				var decr = 0;
				// fix box-sizing in ie7/8
				if(mfp.isLowIE) {
					decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
				}
				item.img.css('max-height', mfp.wH-decr);
			}
		},
		_onImageHasSize: function(item) {
			if(item.img) {

				item.hasSize = true;

				if(_imgInterval) {
					clearInterval(_imgInterval);
				}

				item.isCheckingImgSize = false;

				_mfpTrigger('ImageHasSize', item);

				if(item.imgHidden) {
					if(mfp.content)
						mfp.content.removeClass('mfp-loading');

					item.imgHidden = false;
				}

			}
		},

		/**
		 * Function that loops until the image has size to display elements that rely on it asap
		 */
		findImageSize: function(item) {

			var counter = 0,
				img = item.img[0],
				mfpSetInterval = function(delay) {

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					// decelerating interval that checks for size of an image
					_imgInterval = setInterval(function() {
						if(img.naturalWidth > 0) {
							mfp._onImageHasSize(item);
							return;
						}

						if(counter > 200) {
							clearInterval(_imgInterval);
						}

						counter++;
						if(counter === 3) {
							mfpSetInterval(10);
						} else if(counter === 40) {
							mfpSetInterval(50);
						} else if(counter === 100) {
							mfpSetInterval(500);
						}
					}, delay);
				};

			mfpSetInterval(1);
		},

		getImage: function(item, template) {

			var guard = 0,

				// image load complete handler
				onLoadComplete = function() {
					if(item) {
						if (item.img[0].complete) {
							item.img.off('.mfploader');

							if(item === mfp.currItem){
								mfp._onImageHasSize(item);

								mfp.updateStatus('ready');
							}

							item.hasSize = true;
							item.loaded = true;

							_mfpTrigger('ImageLoadComplete');

						}
						else {
							// if image complete check fails 200 times (20 sec), we assume that there was an error.
							guard++;
							if(guard < 200) {
								setTimeout(onLoadComplete,100);
							} else {
								onLoadError();
							}
						}
					}
				},

				// image error handler
				onLoadError = function() {
					if(item) {
						item.img.off('.mfploader');
						if(item === mfp.currItem){
							mfp._onImageHasSize(item);
							mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
						}

						item.hasSize = true;
						item.loaded = true;
						item.loadError = true;
					}
				},
				imgSt = mfp.st.image;


			var el = template.find('.mfp-img');
			if(el.length) {
				var img = document.createElement('img');
				img.className = 'mfp-img';
				item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
				img.src = item.src;

				// without clone() "error" event is not firing when IMG is replaced by new IMG
				// TODO: find a way to avoid such cloning
				if(el.is('img')) {
					item.img = item.img.clone();
				}
				if(item.img[0].naturalWidth > 0) {
					item.hasSize = true;
				}
			}

			mfp._parseMarkup(template, {
				title: _getTitle(item),
				img_replaceWith: item.img
			}, item);

			mfp.resizeImage();

			if(item.hasSize) {
				if(_imgInterval) clearInterval(_imgInterval);

				if(item.loadError) {
					template.addClass('mfp-loading');
					mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
				} else {
					template.removeClass('mfp-loading');
					mfp.updateStatus('ready');
				}
				return template;
			}

			mfp.updateStatus('loading');
			item.loading = true;

			if(!item.hasSize) {
				item.imgHidden = true;
				template.addClass('mfp-loading');
				mfp.findImageSize(item);
			}

			return template;
		}
	}
});



/*>>image*/

/*>>zoom*/
var hasMozTransform,
	getHasMozTransform = function() {
		if(hasMozTransform === undefined) {
			hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
		}
		return hasMozTransform;
	};

$.magnificPopup.registerModule('zoom', {

	options: {
		enabled: false,
		easing: 'ease-in-out',
		duration: 300,
		opener: function(element) {
			return element.is('img') ? element : element.find('img');
		}
	},

	proto: {

		initZoom: function() {
			var zoomSt = mfp.st.zoom,
				ns = '.zoom';

			if(!zoomSt.enabled || !mfp.supportsTransition) {
				return;
			}

			var duration = zoomSt.duration,
				getElToAnimate = function(image) {
					var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
						transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
						cssObj = {
							position: 'fixed',
							zIndex: 9999,
							left: 0,
							top: 0,
							'-webkit-backface-visibility': 'hidden'
						},
						t = 'transition';

					cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

					newImg.css(cssObj);
					return newImg;
				},
				showMainContent = function() {
					mfp.content.css('visibility', 'visible');
				},
				openTimeout,
				animatedImg;

			_mfpOn('BuildControls'+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);
					mfp.content.css('visibility', 'hidden');

					// Basically, all code below does is clones existing image, puts in on top of the current one and animated it

					image = mfp._getItemToZoom();

					if(!image) {
						showMainContent();
						return;
					}

					animatedImg = getElToAnimate(image);

					animatedImg.css( mfp._getOffset() );

					mfp.wrap.append(animatedImg);

					openTimeout = setTimeout(function() {
						animatedImg.css( mfp._getOffset( true ) );
						openTimeout = setTimeout(function() {

							showMainContent();

							setTimeout(function() {
								animatedImg.remove();
								image = animatedImg = null;
								_mfpTrigger('ZoomAnimationEnded');
							}, 16); // avoid blink when switching images

						}, duration); // this timeout equals animation duration

					}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


					// Lots of timeouts...
				}
			});
			_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);

					mfp.st.removalDelay = duration;

					if(!image) {
						image = mfp._getItemToZoom();
						if(!image) {
							return;
						}
						animatedImg = getElToAnimate(image);
					}


					animatedImg.css( mfp._getOffset(true) );
					mfp.wrap.append(animatedImg);
					mfp.content.css('visibility', 'hidden');

					setTimeout(function() {
						animatedImg.css( mfp._getOffset() );
					}, 16);
				}

			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {
					showMainContent();
					if(animatedImg) {
						animatedImg.remove();
					}
				}
			});
		},

		_allowZoom: function() {
			return mfp.currItem.type === 'image';
		},

		_getItemToZoom: function() {
			if(mfp.currItem.hasSize) {
				return mfp.currItem.img;
			} else {
				return false;
			}
		},

		// Get element postion relative to viewport
		_getOffset: function(isLarge) {
			var el;
			if(isLarge) {
				el = mfp.currItem.img;
			} else {
				el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
			}

			var offset = el.offset();
			var paddingTop = parseInt(el.css('padding-top'),10);
			var paddingBottom = parseInt(el.css('padding-bottom'),10);
			offset.top -= ( $(window).scrollTop() - paddingTop );


			/*

			Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

			 */
			var obj = {
				width: el.width(),
				// fix Zepto height+padding issue
				height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
			};

			// I hate to do this, but there is no another option
			if( getHasMozTransform() ) {
				obj['-moz-transform'] = obj.transform = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
			} else {
				obj.left = offset.left;
				obj.top = offset.top;
			}
			return obj;
		}

	}
});



/*>>zoom*/

/*>>iframe*/

var IFRAME_NS = 'iframe',
	_emptyPage = '//about:blank',

	_fixIframeBugs = function(isShowing) {
		if(mfp.currTemplate[IFRAME_NS]) {
			var el = mfp.currTemplate[IFRAME_NS].find('iframe');
			if(el.length) {
				// reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
				if(!isShowing) {
					el[0].src = _emptyPage;
				}

				// IE8 black screen bug fix
				if(mfp.isIE8) {
					el.css('display', isShowing ? 'block' : 'none');
				}
			}
		}
	};

$.magnificPopup.registerModule(IFRAME_NS, {

	options: {
		markup: '<div class="mfp-iframe-scaler">'+
					'<div class="mfp-close"></div>'+
					'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
				'</div>',

		srcAction: 'iframe_src',

		// we don't care and support only one default type of URL by default
		patterns: {
			youtube: {
				index: 'youtube.com',
				id: 'v=',
				src: '//www.youtube.com/embed/%id%?autoplay=1'
			},
			vimeo: {
				index: 'vimeo.com/',
				id: '/',
				src: '//player.vimeo.com/video/%id%?autoplay=1'
			},
			gmaps: {
				index: '//maps.google.',
				src: '%id%&output=embed'
			}
		}
	},

	proto: {
		initIframe: function() {
			mfp.types.push(IFRAME_NS);

			_mfpOn('BeforeChange', function(e, prevType, newType) {
				if(prevType !== newType) {
					if(prevType === IFRAME_NS) {
						_fixIframeBugs(); // iframe if removed
					} else if(newType === IFRAME_NS) {
						_fixIframeBugs(true); // iframe is showing
					}
				}// else {
					// iframe source is switched, don't do anything
				//}
			});

			_mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
				_fixIframeBugs();
			});
		},

		getIframe: function(item, template) {
			var embedSrc = item.src;
			var iframeSt = mfp.st.iframe;

			$.each(iframeSt.patterns, function() {
				if(embedSrc.indexOf( this.index ) > -1) {
					if(this.id) {
						if(typeof this.id === 'string') {
							embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
						} else {
							embedSrc = this.id.call( this, embedSrc );
						}
					}
					embedSrc = this.src.replace('%id%', embedSrc );
					return false; // break;
				}
			});

			var dataObj = {};
			if(iframeSt.srcAction) {
				dataObj[iframeSt.srcAction] = embedSrc;
			}
			mfp._parseMarkup(template, dataObj, item);

			mfp.updateStatus('ready');

			return template;
		}
	}
});



/*>>iframe*/

/*>>gallery*/
/**
 * Get looped index depending on number of slides
 */
var _getLoopedId = function(index) {
		var numSlides = mfp.items.length;
		if(index > numSlides - 1) {
			return index - numSlides;
		} else  if(index < 0) {
			return numSlides + index;
		}
		return index;
	},
	_replaceCurrTotal = function(text, curr, total) {
		return text.replace('%curr%', curr + 1).replace('%total%', total);
	};

$.magnificPopup.registerModule('gallery', {

	options: {
		enabled: false,
		arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
		preload: [0,2],
		navigateByImgClick: true,
		arrows: true,

		tPrev: 'Previous (Left arrow key)',
		tNext: 'Next (Right arrow key)',
		tCounter: '%curr% of %total%'
	},

	proto: {
		initGallery: function() {

			var gSt = mfp.st.gallery,
				ns = '.mfp-gallery',
				supportsFastClick = Boolean($.fn.mfpFastClick);

			mfp.direction = true; // true - next, false - prev

			if(!gSt || !gSt.enabled ) return false;

			_wrapClasses += ' mfp-gallery';

			_mfpOn(OPEN_EVENT+ns, function() {

				if(gSt.navigateByImgClick) {
					mfp.wrap.on('click'+ns, '.mfp-img', function() {
						if(mfp.items.length > 1) {
							mfp.next();
							return false;
						}
					});
				}

				_document.on('keydown'+ns, function(e) {
					if (e.keyCode === 37) {
						mfp.prev();
					} else if (e.keyCode === 39) {
						mfp.next();
					}
				});
			});

			_mfpOn('UpdateStatus'+ns, function(e, data) {
				if(data.text) {
					data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
				}
			});

			_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
				var l = mfp.items.length;
				values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
			});

			_mfpOn('BuildControls' + ns, function() {
				if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
					var markup = gSt.arrowMarkup,
						arrowLeft = mfp.arrowLeft = $( markup.replace('%title%', gSt.tPrev).replace('%dir%', 'left') ).addClass(PREVENT_CLOSE_CLASS),
						arrowRight = mfp.arrowRight = $( markup.replace('%title%', gSt.tNext).replace('%dir%', 'right') ).addClass(PREVENT_CLOSE_CLASS);

					var eName = supportsFastClick ? 'mfpFastClick' : 'click';
					arrowLeft[eName](function() {
						mfp.prev();
					});
					arrowRight[eName](function() {
						mfp.next();
					});

					// Polyfill for :before and :after (adds elements with classes mfp-a and mfp-b)
					if(mfp.isIE7) {
						_getEl('b', arrowLeft[0], false, true);
						_getEl('a', arrowLeft[0], false, true);
						_getEl('b', arrowRight[0], false, true);
						_getEl('a', arrowRight[0], false, true);
					}

					mfp.container.append(arrowLeft.add(arrowRight));
				}
			});

			_mfpOn(CHANGE_EVENT+ns, function() {
				if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

				mfp._preloadTimeout = setTimeout(function() {
					mfp.preloadNearbyImages();
					mfp._preloadTimeout = null;
				}, 16);
			});


			_mfpOn(CLOSE_EVENT+ns, function() {
				_document.off(ns);
				mfp.wrap.off('click'+ns);

				if(mfp.arrowLeft && supportsFastClick) {
					mfp.arrowLeft.add(mfp.arrowRight).destroyMfpFastClick();
				}
				mfp.arrowRight = mfp.arrowLeft = null;
			});

		},
		next: function() {
			mfp.direction = true;
			mfp.index = _getLoopedId(mfp.index + 1);
			mfp.updateItemHTML();
		},
		prev: function() {
			mfp.direction = false;
			mfp.index = _getLoopedId(mfp.index - 1);
			mfp.updateItemHTML();
		},
		goTo: function(newIndex) {
			mfp.direction = (newIndex >= mfp.index);
			mfp.index = newIndex;
			mfp.updateItemHTML();
		},
		preloadNearbyImages: function() {
			var p = mfp.st.gallery.preload,
				preloadBefore = Math.min(p[0], mfp.items.length),
				preloadAfter = Math.min(p[1], mfp.items.length),
				i;

			for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
				mfp._preloadItem(mfp.index+i);
			}
			for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
				mfp._preloadItem(mfp.index-i);
			}
		},
		_preloadItem: function(index) {
			index = _getLoopedId(index);

			if(mfp.items[index].preloaded) {
				return;
			}

			var item = mfp.items[index];
			if(!item.parsed) {
				item = mfp.parseEl( index );
			}

			_mfpTrigger('LazyLoad', item);

			if(item.type === 'image') {
				item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
					item.hasSize = true;
				}).on('error.mfploader', function() {
					item.hasSize = true;
					item.loadError = true;
					_mfpTrigger('LazyLoadError', item);
				}).attr('src', item.src);
			}


			item.preloaded = true;
		}
	}
});

/*
Touch Support that might be implemented some day

addSwipeGesture: function() {
	var startX,
		moved,
		multipleTouches;

		return;

	var namespace = '.mfp',
		addEventNames = function(pref, down, move, up, cancel) {
			mfp._tStart = pref + down + namespace;
			mfp._tMove = pref + move + namespace;
			mfp._tEnd = pref + up + namespace;
			mfp._tCancel = pref + cancel + namespace;
		};

	if(window.navigator.msPointerEnabled) {
		addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
	} else if('ontouchstart' in window) {
		addEventNames('touch', 'start', 'move', 'end', 'cancel');
	} else {
		return;
	}
	_window.on(mfp._tStart, function(e) {
		var oE = e.originalEvent;
		multipleTouches = moved = false;
		startX = oE.pageX || oE.changedTouches[0].pageX;
	}).on(mfp._tMove, function(e) {
		if(e.originalEvent.touches.length > 1) {
			multipleTouches = e.originalEvent.touches.length;
		} else {
			//e.preventDefault();
			moved = true;
		}
	}).on(mfp._tEnd + ' ' + mfp._tCancel, function(e) {
		if(moved && !multipleTouches) {
			var oE = e.originalEvent,
				diff = startX - (oE.pageX || oE.changedTouches[0].pageX);

			if(diff > 20) {
				mfp.next();
			} else if(diff < -20) {
				mfp.prev();
			}
		}
	});
},
*/


/*>>gallery*/

/*>>retina*/

var RETINA_NS = 'retina';

$.magnificPopup.registerModule(RETINA_NS, {
	options: {
		replaceSrc: function(item) {
			return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
		},
		ratio: 1 // Function or number.  Set to 1 to disable.
	},
	proto: {
		initRetina: function() {
			if(window.devicePixelRatio > 1) {

				var st = mfp.st.retina,
					ratio = st.ratio;

				ratio = !isNaN(ratio) ? ratio : ratio();

				if(ratio > 1) {
					_mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) {
						item.img.css({
							'max-width': item.img[0].naturalWidth / ratio,
							'width': '100%'
						});
					});
					_mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) {
						item.src = st.replaceSrc(item, ratio);
					});
				}
			}

		}
	}
});

/*>>retina*/

/*>>fastclick*/
/**
 * FastClick event implementation. (removes 300ms delay on touch devices)
 * Based on https://developers.google.com/mobile/articles/fast_buttons
 *
 * You may use it outside the Magnific Popup by calling just:
 *
 * $('.your-el').mfpFastClick(function() {
 *     console.log('Clicked!');
 * });
 *
 * To unbind:
 * $('.your-el').destroyMfpFastClick();
 *
 *
 * Note that it's a very basic and simple implementation, it blocks ghost click on the same element where it was bound.
 * If you need something more advanced, use plugin by FT Labs https://github.com/ftlabs/fastclick
 *
 */

(function() {
	var ghostClickDelay = 1000,
		supportsTouch = 'ontouchstart' in window,
		unbindTouchMove = function() {
			_window.off('touchmove'+ns+' touchend'+ns);
		},
		eName = 'mfpFastClick',
		ns = '.'+eName;


	// As Zepto.js doesn't have an easy way to add custom events (like jQuery), so we implement it in this way
	$.fn.mfpFastClick = function(callback) {

		return $(this).each(function() {

			var elem = $(this),
				lock;

			if( supportsTouch ) {

				var timeout,
					startX,
					startY,
					pointerMoved,
					point,
					numPointers;

				elem.on('touchstart' + ns, function(e) {
					pointerMoved = false;
					numPointers = 1;

					point = e.originalEvent ? e.originalEvent.touches[0] : e.touches[0];
					startX = point.clientX;
					startY = point.clientY;

					_window.on('touchmove'+ns, function(e) {
						point = e.originalEvent ? e.originalEvent.touches : e.touches;
						numPointers = point.length;
						point = point[0];
						if (Math.abs(point.clientX - startX) > 10 ||
							Math.abs(point.clientY - startY) > 10) {
							pointerMoved = true;
							unbindTouchMove();
						}
					}).on('touchend'+ns, function(e) {
						unbindTouchMove();
						if(pointerMoved || numPointers > 1) {
							return;
						}
						lock = true;
						e.preventDefault();
						clearTimeout(timeout);
						timeout = setTimeout(function() {
							lock = false;
						}, ghostClickDelay);
						callback();
					});
				});

			}

			elem.on('click' + ns, function() {
				if(!lock) {
					callback();
				}
			});
		});
	};

	$.fn.destroyMfpFastClick = function() {
		$(this).off('touchstart' + ns + ' click' + ns);
		if(supportsTouch) _window.off('touchmove'+ns+' touchend'+ns);
	};
})();

/*>>fastclick*/
})(window.jQuery || window.Zepto);
(function( window, $, undefined ){

  /*!
   * imagesLoaded PACKAGED v4.1.0
   * JavaScript is all like "You images are done yet or what?"
   * MIT License
   */

  /**
   * EvEmitter v1.0.1
   * Lil' event emitter
   * MIT License
   */

  /* jshint unused: true, undef: true, strict: true */

  ( function( global, factory ) {
    // universal module definition
    /* jshint strict: false */ /* globals define, module */
    if ( typeof define == 'function' && define.amd ) {
      // AMD - RequireJS
      define( 'ev-emitter/ev-emitter',factory );
    } else if ( typeof module == 'object' && module.exports ) {
      // CommonJS - Browserify, Webpack
      module.exports = factory();
    } else {
      // Browser globals
      global.EvEmitter = factory();
    }

  }( this, function() {



  function EvEmitter() {}

  var proto = EvEmitter.prototype;

  proto.on = function( eventName, listener ) {
    if ( !eventName || !listener ) {
      return;
    }
    // set events hash
    var events = this._events = this._events || {};
    // set listeners array
    var listeners = events[ eventName ] = events[ eventName ] || [];
    // only add once
    if ( listeners.indexOf( listener ) == -1 ) {
      listeners.push( listener );
    }

    return this;
  };

  proto.once = function( eventName, listener ) {
    if ( !eventName || !listener ) {
      return;
    }
    // add event
    this.on( eventName, listener );
    // set once flag
    // set onceEvents hash
    var onceEvents = this._onceEvents = this._onceEvents || {};
    // set onceListeners array
    var onceListeners = onceEvents[ eventName ] = onceEvents[ eventName ] || [];
    // set flag
    onceListeners[ listener ] = true;

    return this;
  };

  proto.off = function( eventName, listener ) {
    var listeners = this._events && this._events[ eventName ];
    if ( !listeners || !listeners.length ) {
      return;
    }
    var index = listeners.indexOf( listener );
    if ( index != -1 ) {
      listeners.splice( index, 1 );
    }

    return this;
  };

  proto.emitEvent = function( eventName, args ) {
    var listeners = this._events && this._events[ eventName ];
    if ( !listeners || !listeners.length ) {
      return;
    }
    var i = 0;
    var listener = listeners[i];
    args = args || [];
    // once stuff
    var onceListeners = this._onceEvents && this._onceEvents[ eventName ];

    while ( listener ) {
      var isOnce = onceListeners && onceListeners[ listener ];
      if ( isOnce ) {
        // remove listener
        // remove before trigger to prevent recursion
        this.off( eventName, listener );
        // unset once flag
        delete onceListeners[ listener ];
      }
      // trigger listener
      listener.apply( this, args );
      // get next listener
      i += isOnce ? 0 : 1;
      listener = listeners[i];
    }

    return this;
  };

  return EvEmitter;

  }));

  /*!
   * imagesLoaded v4.1.0
   * JavaScript is all like "You images are done yet or what?"
   * MIT License
   */

  ( function( window, factory ) { 'use strict';
    // universal module definition

    /*global define: false, module: false, require: false */

    if ( typeof define == 'function' && define.amd ) {
      // AMD
      define( [
        'ev-emitter/ev-emitter'
      ], function( EvEmitter ) {
        return factory( window, EvEmitter );
      });
    } else if ( typeof module == 'object' && module.exports ) {
      // CommonJS
      module.exports = factory(
        window,
        require('ev-emitter')
      );
    } else {
      // browser global
      window.imagesLoaded = factory(
        window,
        window.EvEmitter
      );
    }

  })( window,

  // --------------------------  factory -------------------------- //

  function factory( window, EvEmitter ) {



  var $ = window.jQuery;
  var console = window.console;

  // -------------------------- helpers -------------------------- //

  // extend objects
  function extend( a, b ) {
    for ( var prop in b ) {
      a[ prop ] = b[ prop ];
    }
    return a;
  }

  // turn element or nodeList into an array
  function makeArray( obj ) {
    var ary = [];
    if ( Array.isArray( obj ) ) {
      // use object if already an array
      ary = obj;
    } else if ( typeof obj.length == 'number' ) {
      // convert nodeList to array
      for ( var i=0; i < obj.length; i++ ) {
        ary.push( obj[i] );
      }
    } else {
      // array of single index
      ary.push( obj );
    }
    return ary;
  }

  // -------------------------- imagesLoaded -------------------------- //

  /**
   * @param {Array, Element, NodeList, String} elem
   * @param {Object or Function} options - if function, use as callback
   * @param {Function} onAlways - callback function
   */
  function ImagesLoaded( elem, options, onAlways ) {
    // coerce ImagesLoaded() without new, to be new ImagesLoaded()
    if ( !( this instanceof ImagesLoaded ) ) {
      return new ImagesLoaded( elem, options, onAlways );
    }
    // use elem as selector string
    if ( typeof elem == 'string' ) {
      elem = document.querySelectorAll( elem );
    }

    this.elements = makeArray( elem );
    this.options = extend( {}, this.options );

    if ( typeof options == 'function' ) {
      onAlways = options;
    } else {
      extend( this.options, options );
    }

    if ( onAlways ) {
      this.on( 'always', onAlways );
    }

    this.getImages();

    if ( $ ) {
      // add jQuery Deferred object
      this.jqDeferred = new $.Deferred();
    }

    // HACK check async to allow time to bind listeners
    setTimeout( function() {
      this.check();
    }.bind( this ));
  }

  ImagesLoaded.prototype = Object.create( EvEmitter.prototype );

  ImagesLoaded.prototype.options = {};

  ImagesLoaded.prototype.getImages = function() {
    this.images = [];

    // filter & find items if we have an item selector
    this.elements.forEach( this.addElementImages, this );
  };

  /**
   * @param {Node} element
   */
  ImagesLoaded.prototype.addElementImages = function( elem ) {
    // filter siblings
    if ( elem.nodeName == 'IMG' ) {
      this.addImage( elem );
    }
    // get background image on element
    if ( this.options.background === true ) {
      this.addElementBackgroundImages( elem );
    }

    // find children
    // no non-element nodes, #143
    var nodeType = elem.nodeType;
    if ( !nodeType || !elementNodeTypes[ nodeType ] ) {
      return;
    }
    var childImgs = elem.querySelectorAll('img');
    // concat childElems to filterFound array
    for ( var i=0; i < childImgs.length; i++ ) {
      var img = childImgs[i];
      this.addImage( img );
    }

    // get child background images
    if ( typeof this.options.background == 'string' ) {
      var children = elem.querySelectorAll( this.options.background );
      for ( i=0; i < children.length; i++ ) {
        var child = children[i];
        this.addElementBackgroundImages( child );
      }
    }
  };

  var elementNodeTypes = {
    1: true,
    9: true,
    11: true
  };

  ImagesLoaded.prototype.addElementBackgroundImages = function( elem ) {
    var style = getComputedStyle( elem );
    if ( !style ) {
      // Firefox returns null if in a hidden iframe https://bugzil.la/548397
      return;
    }
    // get url inside url("...")
    var reURL = /url\((['"])?(.*?)\1\)/gi;
    var matches = reURL.exec( style.backgroundImage );
    while ( matches !== null ) {
      var url = matches && matches[2];
      if ( url ) {
        this.addBackground( url, elem );
      }
      matches = reURL.exec( style.backgroundImage );
    }
  };

  /**
   * @param {Image} img
   */
  ImagesLoaded.prototype.addImage = function( img ) {
    var loadingImage = new LoadingImage( img );
    this.images.push( loadingImage );
  };

  ImagesLoaded.prototype.addBackground = function( url, elem ) {
    var background = new Background( url, elem );
    this.images.push( background );
  };

  ImagesLoaded.prototype.check = function() {
    var _this = this;
    this.progressedCount = 0;
    this.hasAnyBroken = false;
    // complete if no images
    if ( !this.images.length ) {
      this.complete();
      return;
    }

    function onProgress( image, elem, message ) {
      // HACK - Chrome triggers event before object properties have changed. #83
      setTimeout( function() {
        _this.progress( image, elem, message );
      });
    }

    this.images.forEach( function( loadingImage ) {
      loadingImage.once( 'progress', onProgress );
      loadingImage.check();
    });
  };

  ImagesLoaded.prototype.progress = function( image, elem, message ) {
    this.progressedCount++;
    this.hasAnyBroken = this.hasAnyBroken || !image.isLoaded;
    // progress event
    this.emitEvent( 'progress', [ this, image, elem ] );
    if ( this.jqDeferred && this.jqDeferred.notify ) {
      this.jqDeferred.notify( this, image );
    }
    // check if completed
    if ( this.progressedCount == this.images.length ) {
      this.complete();
    }

    if ( this.options.debug && console ) {
      console.log( 'progress: ' + message, image, elem );
    }
  };

  ImagesLoaded.prototype.complete = function() {
    var eventName = this.hasAnyBroken ? 'fail' : 'done';
    this.isComplete = true;
    this.emitEvent( eventName, [ this ] );
    this.emitEvent( 'always', [ this ] );
    if ( this.jqDeferred ) {
      var jqMethod = this.hasAnyBroken ? 'reject' : 'resolve';
      this.jqDeferred[ jqMethod ]( this );
    }
  };

  // --------------------------  -------------------------- //

  function LoadingImage( img ) {
    this.img = img;
  }

  LoadingImage.prototype = Object.create( EvEmitter.prototype );

  LoadingImage.prototype.check = function() {
    // If complete is true and browser supports natural sizes,
    // try to check for image status manually.
    var isComplete = this.getIsImageComplete();
    if ( isComplete ) {
      // report based on naturalWidth
      this.confirm( this.img.naturalWidth !== 0, 'naturalWidth' );
      return;
    }

    // If none of the checks above matched, simulate loading on detached element.
    this.proxyImage = new Image();
    this.proxyImage.addEventListener( 'load', this );
    this.proxyImage.addEventListener( 'error', this );
    // bind to image as well for Firefox. #191
    this.img.addEventListener( 'load', this );
    this.img.addEventListener( 'error', this );
    this.proxyImage.src = this.img.src;
  };

  LoadingImage.prototype.getIsImageComplete = function() {
    return this.img.complete && this.img.naturalWidth !== undefined;
  };

  LoadingImage.prototype.confirm = function( isLoaded, message ) {
    this.isLoaded = isLoaded;
    this.emitEvent( 'progress', [ this, this.img, message ] );
  };

  // ----- events ----- //

  // trigger specified handler for event type
  LoadingImage.prototype.handleEvent = function( event ) {
    var method = 'on' + event.type;
    if ( this[ method ] ) {
      this[ method ]( event );
    }
  };

  LoadingImage.prototype.onload = function() {
    this.confirm( true, 'onload' );
    this.unbindEvents();
  };

  LoadingImage.prototype.onerror = function() {
    this.confirm( false, 'onerror' );
    this.unbindEvents();
  };

  LoadingImage.prototype.unbindEvents = function() {
    this.proxyImage.removeEventListener( 'load', this );
    this.proxyImage.removeEventListener( 'error', this );
    this.img.removeEventListener( 'load', this );
    this.img.removeEventListener( 'error', this );
  };

  // -------------------------- Background -------------------------- //

  function Background( url, element ) {
    this.url = url;
    this.element = element;
    this.img = new Image();
  }

  // inherit LoadingImage prototype
  Background.prototype = Object.create( LoadingImage.prototype );

  Background.prototype.check = function() {
    this.img.addEventListener( 'load', this );
    this.img.addEventListener( 'error', this );
    this.img.src = this.url;
    // check if image is already complete
    var isComplete = this.getIsImageComplete();
    if ( isComplete ) {
      this.confirm( this.img.naturalWidth !== 0, 'naturalWidth' );
      this.unbindEvents();
    }
  };

  Background.prototype.unbindEvents = function() {
    this.img.removeEventListener( 'load', this );
    this.img.removeEventListener( 'error', this );
  };

  Background.prototype.confirm = function( isLoaded, message ) {
    this.isLoaded = isLoaded;
    this.emitEvent( 'progress', [ this, this.element, message ] );
  };

  // -------------------------- jQuery -------------------------- //

  ImagesLoaded.makeJQueryPlugin = function( jQuery ) {
    jQuery = jQuery || window.jQuery;
    if ( !jQuery ) {
      return;
    }
    // set local variable
    $ = jQuery;
    // $().imagesLoaded()
    $.fn.imagesLoaded = function( options, callback ) {
      var instance = new ImagesLoaded( this, options, callback );
      return instance.jqDeferred.promise( $(this) );
    };
  };
  // try making plugin
  ImagesLoaded.makeJQueryPlugin();

  // --------------------------  -------------------------- //

  return ImagesLoaded;

  });

})( window, jQuery );
(function( window, $, undefined ){

  // ========================= smartresize ===============================

  /*
   * smartresize: debounced resize event for jQuery
   *
   * latest version and complete README available on Github:
   * https://github.com/louisremi/jquery.smartresize.js
   *
   * Copyright 2011 @louis_remi
   * Licensed under the MIT license.
   */

  var $event = $.event,
      dispatchMethod = $.event.handle ? 'handle' : 'dispatch',
      resizeTimeout;

  $event.special.smartresize = {
    setup: function() {
      $(this).bind( "resize", $event.special.smartresize.handler );
    },
    teardown: function() {
      $(this).unbind( "resize", $event.special.smartresize.handler );
    },
    handler: function( event, execAsap ) {
      // Save the context
      var context = this,
          args = arguments;

      // set correct event type
      event.type = "smartresize";

      if ( resizeTimeout ) { clearTimeout( resizeTimeout ); }
      resizeTimeout = setTimeout(function() {
        $event[ dispatchMethod ].apply( context, args );
      }, execAsap === "execAsap"? 0 : 100 );
    }
  };

  $.fn.smartresize = function( fn ) {
    return fn ? this.bind( "smartresize", fn ) : this.trigger( "smartresize", ["execAsap"] );
  };

})( window, jQuery );
/*!
 * Isotope PACKAGED v2.1.0
 * Filter & sort magical layouts
 * http://isotope.metafizzy.co
 */

/**
 * Bridget makes jQuery widgets
 * v1.1.0
 * MIT license
 */

( function( window ) {



// -------------------------- utils -------------------------- //

var slice = Array.prototype.slice;

function noop() {}

// -------------------------- definition -------------------------- //

function defineBridget( $ ) {

// bail if no jQuery
if ( !$ ) {
  return;
}

// -------------------------- addOptionMethod -------------------------- //

/**
 * adds option method -> $().plugin('option', {...})
 * @param {Function} PluginClass - constructor class
 */
function addOptionMethod( PluginClass ) {
  // don't overwrite original option method
  if ( PluginClass.prototype.option ) {
    return;
  }

  // option setter
  PluginClass.prototype.option = function( opts ) {
    // bail out if not an object
    if ( !$.isPlainObject( opts ) ){
      return;
    }
    this.options = $.extend( true, this.options, opts );
  };
}

// -------------------------- plugin bridge -------------------------- //

// helper function for logging errors
// $.error breaks jQuery chaining
var logError = typeof console === 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

/**
 * jQuery plugin bridge, access methods like $elem.plugin('method')
 * @param {String} namespace - plugin name
 * @param {Function} PluginClass - constructor class
 */
function bridge( namespace, PluginClass ) {
  // add to jQuery fn namespace
  $.fn[ namespace ] = function( options ) {
    if ( typeof options === 'string' ) {
      // call plugin method when first argument is a string
      // get arguments for method
      var args = slice.call( arguments, 1 );

      for ( var i=0, len = this.length; i < len; i++ ) {
        var elem = this[i];
        var instance = $.data( elem, namespace );
        if ( !instance ) {
          logError( "cannot call methods on " + namespace + " prior to initialization; " +
            "attempted to call '" + options + "'" );
          continue;
        }
        if ( !$.isFunction( instance[options] ) || options.charAt(0) === '_' ) {
          logError( "no such method '" + options + "' for " + namespace + " instance" );
          continue;
        }

        // trigger method with arguments
        var returnValue = instance[ options ].apply( instance, args );

        // break look and return first value if provided
        if ( returnValue !== undefined ) {
          return returnValue;
        }
      }
      // return this if no return value
      return this;
    } else {
      return this.each( function() {
        var instance = $.data( this, namespace );
        if ( instance ) {
          // apply options & init
          instance.option( options );
          instance._init();
        } else {
          // initialize new instance
          instance = new PluginClass( this, options );
          $.data( this, namespace, instance );
        }
      });
    }
  };

}

// -------------------------- bridget -------------------------- //

/**
 * converts a Prototypical class into a proper jQuery plugin
 *   the class must have a ._init method
 * @param {String} namespace - plugin name, used in $().pluginName
 * @param {Function} PluginClass - constructor class
 */
$.bridget = function( namespace, PluginClass ) {
  addOptionMethod( PluginClass );
  bridge( namespace, PluginClass );
};

return $.bridget;

}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'jquery-bridget/jquery.bridget',[ 'jquery' ], defineBridget );
} else if ( typeof exports === 'object' ) {
  defineBridget( require('jquery') );
} else {
  // get jquery from browser global
  defineBridget( window.jQuery );
}

})( window );

/*!
 * eventie v1.0.5
 * event binding helper
 *   eventie.bind( elem, 'click', myFn )
 *   eventie.unbind( elem, 'click', myFn )
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true */
/*global define: false, module: false */

( function( window ) {



var docElem = document.documentElement;

var bind = function() {};

function getIEEvent( obj ) {
  var event = window.event;
  // add event.target
  event.target = event.target || event.srcElement || obj;
  return event;
}

if ( docElem.addEventListener ) {
  bind = function( obj, type, fn ) {
    obj.addEventListener( type, fn, false );
  };
} else if ( docElem.attachEvent ) {
  bind = function( obj, type, fn ) {
    obj[ type + fn ] = fn.handleEvent ?
      function() {
        var event = getIEEvent( obj );
        fn.handleEvent.call( fn, event );
      } :
      function() {
        var event = getIEEvent( obj );
        fn.call( obj, event );
      };
    obj.attachEvent( "on" + type, obj[ type + fn ] );
  };
}

var unbind = function() {};

if ( docElem.removeEventListener ) {
  unbind = function( obj, type, fn ) {
    obj.removeEventListener( type, fn, false );
  };
} else if ( docElem.detachEvent ) {
  unbind = function( obj, type, fn ) {
    obj.detachEvent( "on" + type, obj[ type + fn ] );
    try {
      delete obj[ type + fn ];
    } catch ( err ) {
      // can't delete window object properties
      obj[ type + fn ] = undefined;
    }
  };
}

var eventie = {
  bind: bind,
  unbind: unbind
};

// ----- module definition ----- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'eventie/eventie',eventie );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = eventie;
} else {
  // browser global
  window.eventie = eventie;
}

})( this );

/*!
 * docReady v1.0.4
 * Cross browser DOMContentLoaded event emitter
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true*/
/*global define: false, require: false, module: false */

( function( window ) {



var document = window.document;
// collection of functions to be triggered on ready
var queue = [];

function docReady( fn ) {
  // throw out non-functions
  if ( typeof fn !== 'function' ) {
    return;
  }

  if ( docReady.isReady ) {
    // ready now, hit it
    fn();
  } else {
    // queue function when ready
    queue.push( fn );
  }
}

docReady.isReady = false;

// triggered on various doc ready events
function onReady( event ) {
  // bail if already triggered or IE8 document is not ready just yet
  var isIE8NotReady = event.type === 'readystatechange' && document.readyState !== 'complete';
  if ( docReady.isReady || isIE8NotReady ) {
    return;
  }

  trigger();
}

function trigger() {
  docReady.isReady = true;
  // process queue
  for ( var i=0, len = queue.length; i < len; i++ ) {
    var fn = queue[i];
    fn();
  }
}

function defineDocReady( eventie ) {
  // trigger ready if page is ready
  if ( document.readyState === 'complete' ) {
    trigger();
  } else {
    // listen for events
    eventie.bind( document, 'DOMContentLoaded', onReady );
    eventie.bind( document, 'readystatechange', onReady );
    eventie.bind( window, 'load', onReady );
  }

  return docReady;
}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'doc-ready/doc-ready',[ 'eventie/eventie' ], defineDocReady );
} else if ( typeof exports === 'object' ) {
  module.exports = defineDocReady( require('eventie') );
} else {
  // browser global
  window.docReady = defineDocReady( window.eventie );
}

})( window );

/*!
 * EventEmitter v4.2.9 - git.io/ee
 * Oliver Caldwell
 * MIT license
 * @preserve
 */

(function () {


    /**
     * Class for managing events.
     * Can be extended to provide event functionality in other classes.
     *
     * @class EventEmitter Manages event registering and emitting.
     */
    function EventEmitter() {}

    // Shortcuts to improve speed and size
    var proto = EventEmitter.prototype;
    var exports = this;
    var originalGlobalValue = exports.EventEmitter;

    /**
     * Finds the index of the listener for the event in its storage array.
     *
     * @param {Function[]} listeners Array of listeners to search through.
     * @param {Function} listener Method to look for.
     * @return {Number} Index of the specified listener, -1 if not found
     * @api private
     */
    function indexOfListener(listeners, listener) {
        var i = listeners.length;
        while (i--) {
            if (listeners[i].listener === listener) {
                return i;
            }
        }

        return -1;
    }

    /**
     * Alias a method while keeping the context correct, to allow for overwriting of target method.
     *
     * @param {String} name The name of the target method.
     * @return {Function} The aliased method
     * @api private
     */
    function alias(name) {
        return function aliasClosure() {
            return this[name].apply(this, arguments);
        };
    }

    /**
     * Returns the listener array for the specified event.
     * Will initialise the event object and listener arrays if required.
     * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
     * Each property in the object response is an array of listener functions.
     *
     * @param {String|RegExp} evt Name of the event to return the listeners from.
     * @return {Function[]|Object} All listener functions for the event.
     */
    proto.getListeners = function getListeners(evt) {
        var events = this._getEvents();
        var response;
        var key;

        // Return a concatenated array of all matching events if
        // the selector is a regular expression.
        if (evt instanceof RegExp) {
            response = {};
            for (key in events) {
                if (events.hasOwnProperty(key) && evt.test(key)) {
                    response[key] = events[key];
                }
            }
        }
        else {
            response = events[evt] || (events[evt] = []);
        }

        return response;
    };

    /**
     * Takes a list of listener objects and flattens it into a list of listener functions.
     *
     * @param {Object[]} listeners Raw listener objects.
     * @return {Function[]} Just the listener functions.
     */
    proto.flattenListeners = function flattenListeners(listeners) {
        var flatListeners = [];
        var i;

        for (i = 0; i < listeners.length; i += 1) {
            flatListeners.push(listeners[i].listener);
        }

        return flatListeners;
    };

    /**
     * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
     *
     * @param {String|RegExp} evt Name of the event to return the listeners from.
     * @return {Object} All listener functions for an event in an object.
     */
    proto.getListenersAsObject = function getListenersAsObject(evt) {
        var listeners = this.getListeners(evt);
        var response;

        if (listeners instanceof Array) {
            response = {};
            response[evt] = listeners;
        }

        return response || listeners;
    };

    /**
     * Adds a listener function to the specified event.
     * The listener will not be added if it is a duplicate.
     * If the listener returns true then it will be removed after it is called.
     * If you pass a regular expression as the event name then the listener will be added to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to attach the listener to.
     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addListener = function addListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var listenerIsWrapped = typeof listener === 'object';
        var key;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
                listeners[key].push(listenerIsWrapped ? listener : {
                    listener: listener,
                    once: false
                });
            }
        }

        return this;
    };

    /**
     * Alias of addListener
     */
    proto.on = alias('addListener');

    /**
     * Semi-alias of addListener. It will add a listener that will be
     * automatically removed after its first execution.
     *
     * @param {String|RegExp} evt Name of the event to attach the listener to.
     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addOnceListener = function addOnceListener(evt, listener) {
        return this.addListener(evt, {
            listener: listener,
            once: true
        });
    };

    /**
     * Alias of addOnceListener.
     */
    proto.once = alias('addOnceListener');

    /**
     * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
     * You need to tell it what event names should be matched by a regex.
     *
     * @param {String} evt Name of the event to create.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.defineEvent = function defineEvent(evt) {
        this.getListeners(evt);
        return this;
    };

    /**
     * Uses defineEvent to define multiple events.
     *
     * @param {String[]} evts An array of event names to define.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.defineEvents = function defineEvents(evts) {
        for (var i = 0; i < evts.length; i += 1) {
            this.defineEvent(evts[i]);
        }
        return this;
    };

    /**
     * Removes a listener function from the specified event.
     * When passed a regular expression as the event name, it will remove the listener from all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to remove the listener from.
     * @param {Function} listener Method to remove from the event.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeListener = function removeListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var index;
        var key;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                index = indexOfListener(listeners[key], listener);

                if (index !== -1) {
                    listeners[key].splice(index, 1);
                }
            }
        }

        return this;
    };

    /**
     * Alias of removeListener
     */
    proto.off = alias('removeListener');

    /**
     * Adds listeners in bulk using the manipulateListeners method.
     * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
     * You can also pass it a regular expression to add the array of listeners to all events that match it.
     * Yeah, this function does quite a bit. That's probably a bad thing.
     *
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to add.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addListeners = function addListeners(evt, listeners) {
        // Pass through to manipulateListeners
        return this.manipulateListeners(false, evt, listeners);
    };

    /**
     * Removes listeners in bulk using the manipulateListeners method.
     * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
     * You can also pass it an event name and an array of listeners to be removed.
     * You can also pass it a regular expression to remove the listeners from all events that match it.
     *
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to remove.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeListeners = function removeListeners(evt, listeners) {
        // Pass through to manipulateListeners
        return this.manipulateListeners(true, evt, listeners);
    };

    /**
     * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
     * The first argument will determine if the listeners are removed (true) or added (false).
     * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
     * You can also pass it an event name and an array of listeners to be added/removed.
     * You can also pass it a regular expression to manipulate the listeners of all events that match it.
     *
     * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
        var i;
        var value;
        var single = remove ? this.removeListener : this.addListener;
        var multiple = remove ? this.removeListeners : this.addListeners;

        // If evt is an object then pass each of its properties to this method
        if (typeof evt === 'object' && !(evt instanceof RegExp)) {
            for (i in evt) {
                if (evt.hasOwnProperty(i) && (value = evt[i])) {
                    // Pass the single listener straight through to the singular method
                    if (typeof value === 'function') {
                        single.call(this, i, value);
                    }
                    else {
                        // Otherwise pass back to the multiple function
                        multiple.call(this, i, value);
                    }
                }
            }
        }
        else {
            // So evt must be a string
            // And listeners must be an array of listeners
            // Loop over it and pass each one to the multiple method
            i = listeners.length;
            while (i--) {
                single.call(this, evt, listeners[i]);
            }
        }

        return this;
    };

    /**
     * Removes all listeners from a specified event.
     * If you do not specify an event then all listeners will be removed.
     * That means every event will be emptied.
     * You can also pass a regex to remove all events that match it.
     *
     * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeEvent = function removeEvent(evt) {
        var type = typeof evt;
        var events = this._getEvents();
        var key;

        // Remove different things depending on the state of evt
        if (type === 'string') {
            // Remove all listeners for the specified event
            delete events[evt];
        }
        else if (evt instanceof RegExp) {
            // Remove all events matching the regex.
            for (key in events) {
                if (events.hasOwnProperty(key) && evt.test(key)) {
                    delete events[key];
                }
            }
        }
        else {
            // Remove all listeners in all events
            delete this._events;
        }

        return this;
    };

    /**
     * Alias of removeEvent.
     *
     * Added to mirror the node API.
     */
    proto.removeAllListeners = alias('removeEvent');

    /**
     * Emits an event of your choice.
     * When emitted, every listener attached to that event will be executed.
     * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
     * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
     * So they will not arrive within the array on the other side, they will be separate.
     * You can also pass a regular expression to emit to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
     * @param {Array} [args] Optional array of arguments to be passed to each listener.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.emitEvent = function emitEvent(evt, args) {
        var listeners = this.getListenersAsObject(evt);
        var listener;
        var i;
        var key;
        var response;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                i = listeners[key].length;

                while (i--) {
                    // If the listener returns true then it shall be removed from the event
                    // The function is executed either with a basic call or an apply if there is an args array
                    listener = listeners[key][i];

                    if (listener.once === true) {
                        this.removeListener(evt, listener.listener);
                    }

                    response = listener.listener.apply(this, args || []);

                    if (response === this._getOnceReturnValue()) {
                        this.removeListener(evt, listener.listener);
                    }
                }
            }
        }

        return this;
    };

    /**
     * Alias of emitEvent
     */
    proto.trigger = alias('emitEvent');

    /**
     * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
     * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
     * @param {...*} Optional additional arguments to be passed to each listener.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.emit = function emit(evt) {
        var args = Array.prototype.slice.call(arguments, 1);
        return this.emitEvent(evt, args);
    };

    /**
     * Sets the current value to check against when executing listeners. If a
     * listeners return value matches the one set here then it will be removed
     * after execution. This value defaults to true.
     *
     * @param {*} value The new value to check for when executing listeners.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.setOnceReturnValue = function setOnceReturnValue(value) {
        this._onceReturnValue = value;
        return this;
    };

    /**
     * Fetches the current value to check against when executing listeners. If
     * the listeners return value matches this one then it should be removed
     * automatically. It will return true by default.
     *
     * @return {*|Boolean} The current value to check for or the default, true.
     * @api private
     */
    proto._getOnceReturnValue = function _getOnceReturnValue() {
        if (this.hasOwnProperty('_onceReturnValue')) {
            return this._onceReturnValue;
        }
        else {
            return true;
        }
    };

    /**
     * Fetches the events object and creates one if required.
     *
     * @return {Object} The events storage object.
     * @api private
     */
    proto._getEvents = function _getEvents() {
        return this._events || (this._events = {});
    };

    /**
     * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
     *
     * @return {Function} Non conflicting EventEmitter class.
     */
    EventEmitter.noConflict = function noConflict() {
        exports.EventEmitter = originalGlobalValue;
        return EventEmitter;
    };

    // Expose the class either via AMD, CommonJS or the global object
    if (typeof define === 'function' && define.amd) {
        define('eventEmitter/EventEmitter',[],function () {
            return EventEmitter;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = EventEmitter;
    }
    else {
        exports.EventEmitter = EventEmitter;
    }
}.call(this));

/*!
 * getStyleProperty v1.0.4
 * original by kangax
 * http://perfectionkills.com/feature-testing-css-properties/
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false, exports: false, module: false */

( function( window ) {



var prefixes = 'Webkit Moz ms Ms O'.split(' ');
var docElemStyle = document.documentElement.style;

function getStyleProperty( propName ) {
  if ( !propName ) {
    return;
  }

  // test standard property first
  if ( typeof docElemStyle[ propName ] === 'string' ) {
    return propName;
  }

  // capitalize
  propName = propName.charAt(0).toUpperCase() + propName.slice(1);

  // test vendor specific properties
  var prefixed;
  for ( var i=0, len = prefixes.length; i < len; i++ ) {
    prefixed = prefixes[i] + propName;
    if ( typeof docElemStyle[ prefixed ] === 'string' ) {
      return prefixed;
    }
  }
}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'get-style-property/get-style-property',[],function() {
    return getStyleProperty;
  });
} else if ( typeof exports === 'object' ) {
  // CommonJS for Component
  module.exports = getStyleProperty;
} else {
  // browser global
  window.getStyleProperty = getStyleProperty;
}

})( window );

/*!
 * getSize v1.2.2
 * measure size of elements
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, exports: false, require: false, module: false, console: false */

( function( window, undefined ) {



// -------------------------- helpers -------------------------- //

// get a number from a string, not a percentage
function getStyleSize( value ) {
  var num = parseFloat( value );
  // not a percent like '100%', and a number
  var isValid = value.indexOf('%') === -1 && !isNaN( num );
  return isValid && num;
}

function noop() {}

var logError = typeof console === 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

// -------------------------- measurements -------------------------- //

var measurements = [
  'paddingLeft',
  'paddingRight',
  'paddingTop',
  'paddingBottom',
  'marginLeft',
  'marginRight',
  'marginTop',
  'marginBottom',
  'borderLeftWidth',
  'borderRightWidth',
  'borderTopWidth',
  'borderBottomWidth'
];

function getZeroSize() {
  var size = {
    width: 0,
    height: 0,
    innerWidth: 0,
    innerHeight: 0,
    outerWidth: 0,
    outerHeight: 0
  };
  for ( var i=0, len = measurements.length; i < len; i++ ) {
    var measurement = measurements[i];
    size[ measurement ] = 0;
  }
  return size;
}



function defineGetSize( getStyleProperty ) {

// -------------------------- setup -------------------------- //

var isSetup = false;

var getStyle, boxSizingProp, isBoxSizeOuter;

/**
 * setup vars and functions
 * do it on initial getSize(), rather than on script load
 * For Firefox bug https://bugzilla.mozilla.org/show_bug.cgi?id=548397
 */
function setup() {
  // setup once
  if ( isSetup ) {
    return;
  }
  isSetup = true;

  var getComputedStyle = window.getComputedStyle;
  getStyle = ( function() {
    var getStyleFn = getComputedStyle ?
      function( elem ) {
        return getComputedStyle( elem, null );
      } :
      function( elem ) {
        return elem.currentStyle;
      };

      return function getStyle( elem ) {
        var style = getStyleFn( elem );
        if ( !style ) {
          logError( 'Style returned ' + style +
            '. Are you running this code in a hidden iframe on Firefox? ' +
            'See http://bit.ly/getsizebug1' );
        }
        return style;
      };
  })();

  // -------------------------- box sizing -------------------------- //

  boxSizingProp = getStyleProperty('boxSizing');

  /**
   * WebKit measures the outer-width on style.width on border-box elems
   * IE & Firefox measures the inner-width
   */
  if ( boxSizingProp ) {
    var div = document.createElement('div');
    div.style.width = '200px';
    div.style.padding = '1px 2px 3px 4px';
    div.style.borderStyle = 'solid';
    div.style.borderWidth = '1px 2px 3px 4px';
    div.style[ boxSizingProp ] = 'border-box';

    var body = document.body || document.documentElement;
    body.appendChild( div );
    var style = getStyle( div );

    isBoxSizeOuter = getStyleSize( style.width ) === 200;
    body.removeChild( div );
  }

}

// -------------------------- getSize -------------------------- //

function getSize( elem ) {
  setup();

  // use querySeletor if elem is string
  if ( typeof elem === 'string' ) {
    elem = document.querySelector( elem );
  }

  // do not proceed on non-objects
  if ( !elem || typeof elem !== 'object' || !elem.nodeType ) {
    return;
  }

  var style = getStyle( elem );

  // if hidden, everything is 0
  if ( style.display === 'none' ) {
    return getZeroSize();
  }

  var size = {};
  size.width = elem.offsetWidth;
  size.height = elem.offsetHeight;

  var isBorderBox = size.isBorderBox = !!( boxSizingProp &&
    style[ boxSizingProp ] && style[ boxSizingProp ] === 'border-box' );

  // get all measurements
  for ( var i=0, len = measurements.length; i < len; i++ ) {
    var measurement = measurements[i];
    var value = style[ measurement ];
    value = mungeNonPixel( elem, value );
    var num = parseFloat( value );
    // any 'auto', 'medium' value will be 0
    size[ measurement ] = !isNaN( num ) ? num : 0;
  }

  var paddingWidth = size.paddingLeft + size.paddingRight;
  var paddingHeight = size.paddingTop + size.paddingBottom;
  var marginWidth = size.marginLeft + size.marginRight;
  var marginHeight = size.marginTop + size.marginBottom;
  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

  // overwrite width and height if we can get it from style
  var styleWidth = getStyleSize( style.width );
  if ( styleWidth !== false ) {
    size.width = styleWidth +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
  }

  var styleHeight = getStyleSize( style.height );
  if ( styleHeight !== false ) {
    size.height = styleHeight +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
  }

  size.innerWidth = size.width - ( paddingWidth + borderWidth );
  size.innerHeight = size.height - ( paddingHeight + borderHeight );

  size.outerWidth = size.width + marginWidth;
  size.outerHeight = size.height + marginHeight;

  return size;
}

// IE8 returns percent values, not pixels
// taken from jQuery's curCSS
function mungeNonPixel( elem, value ) {
  // IE8 and has percent value
  if ( window.getComputedStyle || value.indexOf('%') === -1 ) {
    return value;
  }
  var style = elem.style;
  // Remember the original values
  var left = style.left;
  var rs = elem.runtimeStyle;
  var rsLeft = rs && rs.left;

  // Put in the new values to get a computed value out
  if ( rsLeft ) {
    rs.left = elem.currentStyle.left;
  }
  style.left = value;
  value = style.pixelLeft;

  // Revert the changed values
  style.left = left;
  if ( rsLeft ) {
    rs.left = rsLeft;
  }

  return value;
}

return getSize;

}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD for RequireJS
  define( 'get-size/get-size',[ 'get-style-property/get-style-property' ], defineGetSize );
} else if ( typeof exports === 'object' ) {
  // CommonJS for Component
  module.exports = defineGetSize( require('desandro-get-style-property') );
} else {
  // browser global
  window.getSize = defineGetSize( window.getStyleProperty );
}

})( window );

/**
 * matchesSelector v1.0.2
 * matchesSelector( element, '.selector' )
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, module: false */

( function( ElemProto ) {



  var matchesMethod = ( function() {
    // check un-prefixed
    if ( ElemProto.matchesSelector ) {
      return 'matchesSelector';
    }
    // check vendor prefixes
    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

    for ( var i=0, len = prefixes.length; i < len; i++ ) {
      var prefix = prefixes[i];
      var method = prefix + 'MatchesSelector';
      if ( ElemProto[ method ] ) {
        return method;
      }
    }
  })();

  // ----- match ----- //

  function match( elem, selector ) {
    return elem[ matchesMethod ]( selector );
  }

  // ----- appendToFragment ----- //

  function checkParent( elem ) {
    // not needed if already has parent
    if ( elem.parentNode ) {
      return;
    }
    var fragment = document.createDocumentFragment();
    fragment.appendChild( elem );
  }

  // ----- query ----- //

  // fall back to using QSA
  // thx @jonathantneal https://gist.github.com/3062955
  function query( elem, selector ) {
    // append to fragment if no parent
    checkParent( elem );

    // match elem with all selected elems of parent
    var elems = elem.parentNode.querySelectorAll( selector );
    for ( var i=0, len = elems.length; i < len; i++ ) {
      // return true if match
      if ( elems[i] === elem ) {
        return true;
      }
    }
    // otherwise return false
    return false;
  }

  // ----- matchChild ----- //

  function matchChild( elem, selector ) {
    checkParent( elem );
    return match( elem, selector );
  }

  // ----- matchesSelector ----- //

  var matchesSelector;

  if ( matchesMethod ) {
    // IE9 supports matchesSelector, but doesn't work on orphaned elems
    // check for that
    var div = document.createElement('div');
    var supportsOrphans = match( div, 'div' );
    matchesSelector = supportsOrphans ? match : matchChild;
  } else {
    matchesSelector = query;
  }

  // transport
  if ( typeof define === 'function' && define.amd ) {
    // AMD
    define( 'matches-selector/matches-selector',[],function() {
      return matchesSelector;
    });
  } else if ( typeof exports === 'object' ) {
    module.exports = matchesSelector;
  }
  else {
    // browser global
    window.matchesSelector = matchesSelector;
  }

})( Element.prototype );

/**
 * Outlayer Item
 */

( function( window ) {



// ----- get style ----- //

var getComputedStyle = window.getComputedStyle;
var getStyle = getComputedStyle ?
  function( elem ) {
    return getComputedStyle( elem, null );
  } :
  function( elem ) {
    return elem.currentStyle;
  };


// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

function isEmptyObj( obj ) {
  for ( var prop in obj ) {
    return false;
  }
  prop = null;
  return true;
}

// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
function toDash( str ) {
  return str.replace( /([A-Z])/g, function( $1 ){
    return '-' + $1.toLowerCase();
  });
}

// -------------------------- Outlayer definition -------------------------- //

function outlayerItemDefinition( EventEmitter, getSize, getStyleProperty ) {

// -------------------------- CSS3 support -------------------------- //

var transitionProperty = getStyleProperty('transition');
var transformProperty = getStyleProperty('transform');
var supportsCSS3 = transitionProperty && transformProperty;
var is3d = !!getStyleProperty('perspective');

var transitionEndEvent = {
  WebkitTransition: 'webkitTransitionEnd',
  MozTransition: 'transitionend',
  OTransition: 'otransitionend',
  transition: 'transitionend'
}[ transitionProperty ];

// properties that could have vendor prefix
var prefixableProperties = [
  'transform',
  'transition',
  'transitionDuration',
  'transitionProperty'
];

// cache all vendor properties
var vendorProperties = ( function() {
  var cache = {};
  for ( var i=0, len = prefixableProperties.length; i < len; i++ ) {
    var prop = prefixableProperties[i];
    var supportedProp = getStyleProperty( prop );
    if ( supportedProp && supportedProp !== prop ) {
      cache[ prop ] = supportedProp;
    }
  }
  return cache;
})();

// -------------------------- Item -------------------------- //

function Item( element, layout ) {
  if ( !element ) {
    return;
  }

  this.element = element;
  // parent layout class, i.e. Masonry, Isotope, or Packery
  this.layout = layout;
  this.position = {
    x: 0,
    y: 0
  };

  this._create();
}

// inherit EventEmitter
extend( Item.prototype, EventEmitter.prototype );

Item.prototype._create = function() {
  // transition objects
  this._transn = {
    ingProperties: {},
    clean: {},
    onEnd: {}
  };

  this.css({
    position: 'absolute'
  });
};

// trigger specified handler for event type
Item.prototype.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

Item.prototype.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * apply CSS styles to element
 * @param {Object} style
 */
Item.prototype.css = function( style ) {
  var elemStyle = this.element.style;

  for ( var prop in style ) {
    // use vendor property if available
    var supportedProp = vendorProperties[ prop ] || prop;
    elemStyle[ supportedProp ] = style[ prop ];
  }
};

 // measure position, and sets it
Item.prototype.getPosition = function() {
  var style = getStyle( this.element );
  var layoutOptions = this.layout.options;
  var isOriginLeft = layoutOptions.isOriginLeft;
  var isOriginTop = layoutOptions.isOriginTop;
  var x = parseInt( style[ isOriginLeft ? 'left' : 'right' ], 10 );
  var y = parseInt( style[ isOriginTop ? 'top' : 'bottom' ], 10 );

  // clean up 'auto' or other non-integer values
  x = isNaN( x ) ? 0 : x;
  y = isNaN( y ) ? 0 : y;
  // remove padding from measurement
  var layoutSize = this.layout.size;
  x -= isOriginLeft ? layoutSize.paddingLeft : layoutSize.paddingRight;
  y -= isOriginTop ? layoutSize.paddingTop : layoutSize.paddingBottom;

  this.position.x = x;
  this.position.y = y;
};

// set settled position, apply padding
Item.prototype.layoutPosition = function() {
  var layoutSize = this.layout.size;
  var layoutOptions = this.layout.options;
  var style = {};

  if ( layoutOptions.isOriginLeft ) {
    style.left = ( this.position.x + layoutSize.paddingLeft ) + 'px';
    // reset other property
    style.right = '';
  } else {
    style.right = ( this.position.x + layoutSize.paddingRight ) + 'px';
    style.left = '';
  }

  if ( layoutOptions.isOriginTop ) {
    style.top = ( this.position.y + layoutSize.paddingTop ) + 'px';
    style.bottom = '';
  } else {
    style.bottom = ( this.position.y + layoutSize.paddingBottom ) + 'px';
    style.top = '';
  }

  this.css( style );
  this.emitEvent( 'layout', [ this ] );
};


// transform translate function
var translate = is3d ?
  function( x, y ) {
    return 'translate3d(' + x + 'px, ' + y + 'px, 0)';
  } :
  function( x, y ) {
    return 'translate(' + x + 'px, ' + y + 'px)';
  };


Item.prototype._transitionTo = function( x, y ) {
  this.getPosition();
  // get current x & y from top/left
  var curX = this.position.x;
  var curY = this.position.y;

  var compareX = parseInt( x, 10 );
  var compareY = parseInt( y, 10 );
  var didNotMove = compareX === this.position.x && compareY === this.position.y;

  // save end position
  this.setPosition( x, y );

  // if did not move and not transitioning, just go to layout
  if ( didNotMove && !this.isTransitioning ) {
    this.layoutPosition();
    return;
  }

  var transX = x - curX;
  var transY = y - curY;
  var transitionStyle = {};
  // flip cooridinates if origin on right or bottom
  var layoutOptions = this.layout.options;
  transX = layoutOptions.isOriginLeft ? transX : -transX;
  transY = layoutOptions.isOriginTop ? transY : -transY;
  transitionStyle.transform = translate( transX, transY );

  this.transition({
    to: transitionStyle,
    onTransitionEnd: {
      transform: this.layoutPosition
    },
    isCleaning: true
  });
};

// non transition + transform support
Item.prototype.goTo = function( x, y ) {
  this.setPosition( x, y );
  this.layoutPosition();
};

// use transition and transforms if supported
Item.prototype.moveTo = supportsCSS3 ?
  Item.prototype._transitionTo : Item.prototype.goTo;

Item.prototype.setPosition = function( x, y ) {
  this.position.x = parseInt( x, 10 );
  this.position.y = parseInt( y, 10 );
};

// ----- transition ----- //

/**
 * @param {Object} style - CSS
 * @param {Function} onTransitionEnd
 */

// non transition, just trigger callback
Item.prototype._nonTransition = function( args ) {
  this.css( args.to );
  if ( args.isCleaning ) {
    this._removeStyles( args.to );
  }
  for ( var prop in args.onTransitionEnd ) {
    args.onTransitionEnd[ prop ].call( this );
  }
};

/**
 * proper transition
 * @param {Object} args - arguments
 *   @param {Object} to - style to transition to
 *   @param {Object} from - style to start transition from
 *   @param {Boolean} isCleaning - removes transition styles after transition
 *   @param {Function} onTransitionEnd - callback
 */
Item.prototype._transition = function( args ) {
  // redirect to nonTransition if no transition duration
  if ( !parseFloat( this.layout.options.transitionDuration ) ) {
    this._nonTransition( args );
    return;
  }

  var _transition = this._transn;
  // keep track of onTransitionEnd callback by css property
  for ( var prop in args.onTransitionEnd ) {
    _transition.onEnd[ prop ] = args.onTransitionEnd[ prop ];
  }
  // keep track of properties that are transitioning
  for ( prop in args.to ) {
    _transition.ingProperties[ prop ] = true;
    // keep track of properties to clean up when transition is done
    if ( args.isCleaning ) {
      _transition.clean[ prop ] = true;
    }
  }

  // set from styles
  if ( args.from ) {
    this.css( args.from );
    // force redraw. http://blog.alexmaccaw.com/css-transitions
    var h = this.element.offsetHeight;
    // hack for JSHint to hush about unused var
    h = null;
  }
  // enable transition
  this.enableTransition( args.to );
  // set styles that are transitioning
  this.css( args.to );

  this.isTransitioning = true;

};

var itemTransitionProperties = transformProperty && ( toDash( transformProperty ) +
  ',opacity' );

Item.prototype.enableTransition = function(/* style */) {
  // only enable if not already transitioning
  // bug in IE10 were re-setting transition style will prevent
  // transitionend event from triggering
  if ( this.isTransitioning ) {
    return;
  }

  // make transition: foo, bar, baz from style object
  // TODO uncomment this bit when IE10 bug is resolved
  // var transitionValue = [];
  // for ( var prop in style ) {
  //   // dash-ify camelCased properties like WebkitTransition
  //   transitionValue.push( toDash( prop ) );
  // }
  // enable transition styles
  // HACK always enable transform,opacity for IE10
  this.css({
    transitionProperty: itemTransitionProperties,
    transitionDuration: this.layout.options.transitionDuration
  });
  // listen for transition end event
  this.element.addEventListener( transitionEndEvent, this, false );
};

Item.prototype.transition = Item.prototype[ transitionProperty ? '_transition' : '_nonTransition' ];

// ----- events ----- //

Item.prototype.onwebkitTransitionEnd = function( event ) {
  this.ontransitionend( event );
};

Item.prototype.onotransitionend = function( event ) {
  this.ontransitionend( event );
};

// properties that I munge to make my life easier
var dashedVendorProperties = {
  '-webkit-transform': 'transform',
  '-moz-transform': 'transform',
  '-o-transform': 'transform'
};

Item.prototype.ontransitionend = function( event ) {
  // disregard bubbled events from children
  if ( event.target !== this.element ) {
    return;
  }
  var _transition = this._transn;
  // get property name of transitioned property, convert to prefix-free
  var propertyName = dashedVendorProperties[ event.propertyName ] || event.propertyName;

  // remove property that has completed transitioning
  delete _transition.ingProperties[ propertyName ];
  // check if any properties are still transitioning
  if ( isEmptyObj( _transition.ingProperties ) ) {
    // all properties have completed transitioning
    this.disableTransition();
  }
  // clean style
  if ( propertyName in _transition.clean ) {
    // clean up style
    this.element.style[ event.propertyName ] = '';
    delete _transition.clean[ propertyName ];
  }
  // trigger onTransitionEnd callback
  if ( propertyName in _transition.onEnd ) {
    var onTransitionEnd = _transition.onEnd[ propertyName ];
    onTransitionEnd.call( this );
    delete _transition.onEnd[ propertyName ];
  }

  this.emitEvent( 'transitionEnd', [ this ] );
};

Item.prototype.disableTransition = function() {
  this.removeTransitionStyles();
  this.element.removeEventListener( transitionEndEvent, this, false );
  this.isTransitioning = false;
};

/**
 * removes style property from element
 * @param {Object} style
**/
Item.prototype._removeStyles = function( style ) {
  // clean up transition styles
  var cleanStyle = {};
  for ( var prop in style ) {
    cleanStyle[ prop ] = '';
  }
  this.css( cleanStyle );
};

var cleanTransitionStyle = {
  transitionProperty: '',
  transitionDuration: ''
};

Item.prototype.removeTransitionStyles = function() {
  // remove transition
  this.css( cleanTransitionStyle );
};

// ----- show/hide/remove ----- //

// remove element from DOM
Item.prototype.removeElem = function() {
  this.element.parentNode.removeChild( this.element );
  this.emitEvent( 'remove', [ this ] );
};

Item.prototype.remove = function() {
  // just remove element if no transition support or no transition
  if ( !transitionProperty || !parseFloat( this.layout.options.transitionDuration ) ) {
    this.removeElem();
    return;
  }

  // start transition
  var _this = this;
  this.on( 'transitionEnd', function() {
    _this.removeElem();
    return true; // bind once
  });
  this.hide();
};

Item.prototype.reveal = function() {
  delete this.isHidden;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;
  this.transition({
    from: options.hiddenStyle,
    to: options.visibleStyle,
    isCleaning: true
  });
};

Item.prototype.hide = function() {
  // set flag
  this.isHidden = true;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;
  this.transition({
    from: options.visibleStyle,
    to: options.hiddenStyle,
    // keep hidden stuff hidden
    isCleaning: true,
    onTransitionEnd: {
      opacity: function() {
        // check if still hidden
        // during transition, item may have been un-hidden
        if ( this.isHidden ) {
          this.css({ display: 'none' });
        }
      }
    }
  });
};

Item.prototype.destroy = function() {
  this.css({
    position: '',
    left: '',
    right: '',
    top: '',
    bottom: '',
    transition: '',
    transform: ''
  });
};

return Item;

}

// -------------------------- transport -------------------------- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'outlayer/item',[
      'eventEmitter/EventEmitter',
      'get-size/get-size',
      'get-style-property/get-style-property'
    ],
    outlayerItemDefinition );
} else if (typeof exports === 'object') {
  // CommonJS
  module.exports = outlayerItemDefinition(
    require('wolfy87-eventemitter'),
    require('get-size'),
    require('desandro-get-style-property')
  );
} else {
  // browser global
  window.Outlayer = {};
  window.Outlayer.Item = outlayerItemDefinition(
    window.EventEmitter,
    window.getSize,
    window.getStyleProperty
  );
}

})( window );

/*!
 * Outlayer v1.3.0
 * the brains and guts of a layout library
 * MIT license
 */

( function( window ) {



// ----- vars ----- //

var document = window.document;
var console = window.console;
var jQuery = window.jQuery;
var noop = function() {};

// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}


var objToString = Object.prototype.toString;
function isArray( obj ) {
  return objToString.call( obj ) === '[object Array]';
}

// turn element or nodeList into an array
function makeArray( obj ) {
  var ary = [];
  if ( isArray( obj ) ) {
    // use object if already an array
    ary = obj;
  } else if ( obj && typeof obj.length === 'number' ) {
    // convert nodeList to array
    for ( var i=0, len = obj.length; i < len; i++ ) {
      ary.push( obj[i] );
    }
  } else {
    // array of single index
    ary.push( obj );
  }
  return ary;
}

// http://stackoverflow.com/a/384380/182183
var isElement = ( typeof HTMLElement === 'function' || typeof HTMLElement === 'object' ) ?
  function isElementDOM2( obj ) {
    return obj instanceof HTMLElement;
  } :
  function isElementQuirky( obj ) {
    return obj && typeof obj === 'object' &&
      obj.nodeType === 1 && typeof obj.nodeName === 'string';
  };

// index of helper cause IE8
var indexOf = Array.prototype.indexOf ? function( ary, obj ) {
    return ary.indexOf( obj );
  } : function( ary, obj ) {
    for ( var i=0, len = ary.length; i < len; i++ ) {
      if ( ary[i] === obj ) {
        return i;
      }
    }
    return -1;
  };

function removeFrom( obj, ary ) {
  var index = indexOf( ary, obj );
  if ( index !== -1 ) {
    ary.splice( index, 1 );
  }
}

// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
function toDashed( str ) {
  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
    return $1 + '-' + $2;
  }).toLowerCase();
}


function outlayerDefinition( eventie, docReady, EventEmitter, getSize, matchesSelector, Item ) {

// -------------------------- Outlayer -------------------------- //

// globally unique identifiers
var GUID = 0;
// internal store of all Outlayer intances
var instances = {};


/**
 * @param {Element, String} element
 * @param {Object} options
 * @constructor
 */
function Outlayer( element, options ) {
  // use element as selector string
  if ( typeof element === 'string' ) {
    element = document.querySelector( element );
  }

  // bail out if not proper element
  if ( !element || !isElement( element ) ) {
    if ( console ) {
      console.error( 'Bad ' + this.constructor.namespace + ' element: ' + element );
    }
    return;
  }

  this.element = element;

  // options
  this.options = extend( {}, this.constructor.defaults );
  this.option( options );

  // add id for Outlayer.getFromElement
  var id = ++GUID;
  this.element.outlayerGUID = id; // expando
  instances[ id ] = this; // associate via id

  // kick it off
  this._create();

  if ( this.options.isInitLayout ) {
    this.layout();
  }
}

// settings are for internal use only
Outlayer.namespace = 'outlayer';
Outlayer.Item = Item;

// default options
Outlayer.defaults = {
  containerStyle: {
    position: 'relative'
  },
  isInitLayout: true,
  isOriginLeft: true,
  isOriginTop: true,
  isResizeBound: true,
  isResizingContainer: true,
  // item options
  transitionDuration: '0.4s',
  hiddenStyle: {
    opacity: 0,
    transform: 'scale(0.001)'
  },
  visibleStyle: {
    opacity: 1,
    transform: 'scale(1)'
  }
};

// inherit EventEmitter
extend( Outlayer.prototype, EventEmitter.prototype );

/**
 * set options
 * @param {Object} opts
 */
Outlayer.prototype.option = function( opts ) {
  extend( this.options, opts );
};

Outlayer.prototype._create = function() {
  // get items from children
  this.reloadItems();
  // elements that affect layout, but are not laid out
  this.stamps = [];
  this.stamp( this.options.stamp );
  // set container style
  extend( this.element.style, this.options.containerStyle );

  // bind resize method
  if ( this.options.isResizeBound ) {
    this.bindResize();
  }
};

// goes through all children again and gets bricks in proper order
Outlayer.prototype.reloadItems = function() {
  // collection of item elements
  this.items = this._itemize( this.element.children );
};


/**
 * turn elements into Outlayer.Items to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - collection of new Outlayer Items
 */
Outlayer.prototype._itemize = function( elems ) {

  var itemElems = this._filterFindItemElements( elems );
  var Item = this.constructor.Item;

  // create new Outlayer Items for collection
  var items = [];
  for ( var i=0, len = itemElems.length; i < len; i++ ) {
    var elem = itemElems[i];
    var item = new Item( elem, this );
    items.push( item );
  }

  return items;
};

/**
 * get item elements to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - item elements
 */
Outlayer.prototype._filterFindItemElements = function( elems ) {
  // make array of elems
  elems = makeArray( elems );
  var itemSelector = this.options.itemSelector;
  var itemElems = [];

  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    // check that elem is an actual element
    if ( !isElement( elem ) ) {
      continue;
    }
    // filter & find items if we have an item selector
    if ( itemSelector ) {
      // filter siblings
      if ( matchesSelector( elem, itemSelector ) ) {
        itemElems.push( elem );
      }
      // find children
      var childElems = elem.querySelectorAll( itemSelector );
      // concat childElems to filterFound array
      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
        itemElems.push( childElems[j] );
      }
    } else {
      itemElems.push( elem );
    }
  }

  return itemElems;
};

/**
 * getter method for getting item elements
 * @returns {Array} elems - collection of item elements
 */
Outlayer.prototype.getItemElements = function() {
  var elems = [];
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    elems.push( this.items[i].element );
  }
  return elems;
};

// ----- init & layout ----- //

/**
 * lays out all items
 */
Outlayer.prototype.layout = function() {
  this._resetLayout();
  this._manageStamps();

  // don't animate first layout
  var isInstant = this.options.isLayoutInstant !== undefined ?
    this.options.isLayoutInstant : !this._isLayoutInited;
  this.layoutItems( this.items, isInstant );

  // flag for initalized
  this._isLayoutInited = true;
};

// _init is alias for layout
Outlayer.prototype._init = Outlayer.prototype.layout;

/**
 * logic before any new layout
 */
Outlayer.prototype._resetLayout = function() {
  this.getSize();
};


Outlayer.prototype.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * get measurement from option, for columnWidth, rowHeight, gutter
 * if option is String -> get element from selector string, & get size of element
 * if option is Element -> get size of element
 * else use option as a number
 *
 * @param {String} measurement
 * @param {String} size - width or height
 * @private
 */
Outlayer.prototype._getMeasurement = function( measurement, size ) {
  var option = this.options[ measurement ];
  var elem;
  if ( !option ) {
    // default to 0
    this[ measurement ] = 0;
  } else {
    // use option as an element
    if ( typeof option === 'string' ) {
      elem = this.element.querySelector( option );
    } else if ( isElement( option ) ) {
      elem = option;
    }
    // use size of element, if element
    this[ measurement ] = elem ? getSize( elem )[ size ] : option;
  }
};

/**
 * layout a collection of item elements
 * @api public
 */
Outlayer.prototype.layoutItems = function( items, isInstant ) {
  items = this._getItemsForLayout( items );

  this._layoutItems( items, isInstant );

  this._postLayout();
};

/**
 * get the items to be laid out
 * you may want to skip over some items
 * @param {Array} items
 * @returns {Array} items
 */
Outlayer.prototype._getItemsForLayout = function( items ) {
  var layoutItems = [];
  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    if ( !item.isIgnored ) {
      layoutItems.push( item );
    }
  }
  return layoutItems;
};

/**
 * layout items
 * @param {Array} items
 * @param {Boolean} isInstant
 */
Outlayer.prototype._layoutItems = function( items, isInstant ) {
  var _this = this;
  function onItemsLayout() {
    _this.emitEvent( 'layoutComplete', [ _this, items ] );
  }

  if ( !items || !items.length ) {
    // no items, emit event with empty array
    onItemsLayout();
    return;
  }

  // emit layoutComplete when done
  this._itemsOn( items, 'layout', onItemsLayout );

  var queue = [];

  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    // get x/y object from method
    var position = this._getItemLayoutPosition( item );
    // enqueue
    position.item = item;
    position.isInstant = isInstant || item.isLayoutInstant;
    queue.push( position );
  }

  this._processLayoutQueue( queue );
};

/**
 * get item layout position
 * @param {Outlayer.Item} item
 * @returns {Object} x and y position
 */
Outlayer.prototype._getItemLayoutPosition = function( /* item */ ) {
  return {
    x: 0,
    y: 0
  };
};

/**
 * iterate over array and position each item
 * Reason being - separating this logic prevents 'layout invalidation'
 * thx @paul_irish
 * @param {Array} queue
 */
Outlayer.prototype._processLayoutQueue = function( queue ) {
  for ( var i=0, len = queue.length; i < len; i++ ) {
    var obj = queue[i];
    this._positionItem( obj.item, obj.x, obj.y, obj.isInstant );
  }
};

/**
 * Sets position of item in DOM
 * @param {Outlayer.Item} item
 * @param {Number} x - horizontal position
 * @param {Number} y - vertical position
 * @param {Boolean} isInstant - disables transitions
 */
Outlayer.prototype._positionItem = function( item, x, y, isInstant ) {
  if ( isInstant ) {
    // if not transition, just set CSS
    item.goTo( x, y );
  } else {
    item.moveTo( x, y );
  }
};

/**
 * Any logic you want to do after each layout,
 * i.e. size the container
 */
Outlayer.prototype._postLayout = function() {
  this.resizeContainer();
};

Outlayer.prototype.resizeContainer = function() {
  if ( !this.options.isResizingContainer ) {
    return;
  }
  var size = this._getContainerSize();
  if ( size ) {
    this._setContainerMeasure( size.width, true );
    this._setContainerMeasure( size.height, false );
  }
};

/**
 * Sets width or height of container if returned
 * @returns {Object} size
 *   @param {Number} width
 *   @param {Number} height
 */
Outlayer.prototype._getContainerSize = noop;

/**
 * @param {Number} measure - size of width or height
 * @param {Boolean} isWidth
 */
Outlayer.prototype._setContainerMeasure = function( measure, isWidth ) {
  if ( measure === undefined ) {
    return;
  }

  var elemSize = this.size;
  // add padding and border width if border box
  if ( elemSize.isBorderBox ) {
    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
      elemSize.borderLeftWidth + elemSize.borderRightWidth :
      elemSize.paddingBottom + elemSize.paddingTop +
      elemSize.borderTopWidth + elemSize.borderBottomWidth;
  }

  measure = Math.max( measure, 0 );
  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
};

/**
 * trigger a callback for a collection of items events
 * @param {Array} items - Outlayer.Items
 * @param {String} eventName
 * @param {Function} callback
 */
Outlayer.prototype._itemsOn = function( items, eventName, callback ) {
  var doneCount = 0;
  var count = items.length;
  // event callback
  var _this = this;
  function tick() {
    doneCount++;
    if ( doneCount === count ) {
      callback.call( _this );
    }
    return true; // bind once
  }
  // bind callback
  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    item.on( eventName, tick );
  }
};

// -------------------------- ignore & stamps -------------------------- //


/**
 * keep item in collection, but do not lay it out
 * ignored items do not get skipped in layout
 * @param {Element} elem
 */
Outlayer.prototype.ignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    item.isIgnored = true;
  }
};

/**
 * return item to layout collection
 * @param {Element} elem
 */
Outlayer.prototype.unignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    delete item.isIgnored;
  }
};

/**
 * adds elements to stamps
 * @param {NodeList, Array, Element, or String} elems
 */
Outlayer.prototype.stamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ) {
    return;
  }

  this.stamps = this.stamps.concat( elems );
  // ignore
  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    this.ignore( elem );
  }
};

/**
 * removes elements to stamps
 * @param {NodeList, Array, or Element} elems
 */
Outlayer.prototype.unstamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ){
    return;
  }

  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    // filter out removed stamp elements
    removeFrom( elem, this.stamps );
    this.unignore( elem );
  }

};

/**
 * finds child elements
 * @param {NodeList, Array, Element, or String} elems
 * @returns {Array} elems
 */
Outlayer.prototype._find = function( elems ) {
  if ( !elems ) {
    return;
  }
  // if string, use argument as selector string
  if ( typeof elems === 'string' ) {
    elems = this.element.querySelectorAll( elems );
  }
  elems = makeArray( elems );
  return elems;
};

Outlayer.prototype._manageStamps = function() {
  if ( !this.stamps || !this.stamps.length ) {
    return;
  }

  this._getBoundingRect();

  for ( var i=0, len = this.stamps.length; i < len; i++ ) {
    var stamp = this.stamps[i];
    this._manageStamp( stamp );
  }
};

// update boundingLeft / Top
Outlayer.prototype._getBoundingRect = function() {
  // get bounding rect for container element
  var boundingRect = this.element.getBoundingClientRect();
  var size = this.size;
  this._boundingRect = {
    left: boundingRect.left + size.paddingLeft + size.borderLeftWidth,
    top: boundingRect.top + size.paddingTop + size.borderTopWidth,
    right: boundingRect.right - ( size.paddingRight + size.borderRightWidth ),
    bottom: boundingRect.bottom - ( size.paddingBottom + size.borderBottomWidth )
  };
};

/**
 * @param {Element} stamp
**/
Outlayer.prototype._manageStamp = noop;

/**
 * get x/y position of element relative to container element
 * @param {Element} elem
 * @returns {Object} offset - has left, top, right, bottom
 */
Outlayer.prototype._getElementOffset = function( elem ) {
  var boundingRect = elem.getBoundingClientRect();
  var thisRect = this._boundingRect;
  var size = getSize( elem );
  var offset = {
    left: boundingRect.left - thisRect.left - size.marginLeft,
    top: boundingRect.top - thisRect.top - size.marginTop,
    right: thisRect.right - boundingRect.right - size.marginRight,
    bottom: thisRect.bottom - boundingRect.bottom - size.marginBottom
  };
  return offset;
};

// -------------------------- resize -------------------------- //

// enable event handlers for listeners
// i.e. resize -> onresize
Outlayer.prototype.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

/**
 * Bind layout to window resizing
 */
Outlayer.prototype.bindResize = function() {
  // bind just one listener
  if ( this.isResizeBound ) {
    return;
  }
  eventie.bind( window, 'resize', this );
  this.isResizeBound = true;
};

/**
 * Unbind layout to window resizing
 */
Outlayer.prototype.unbindResize = function() {
  if ( this.isResizeBound ) {
    eventie.unbind( window, 'resize', this );
  }
  this.isResizeBound = false;
};

// original debounce by John Hann
// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/

// this fires every resize
Outlayer.prototype.onresize = function() {
  if ( this.resizeTimeout ) {
    clearTimeout( this.resizeTimeout );
  }

  var _this = this;
  function delayed() {
    _this.resize();
    delete _this.resizeTimeout;
  }

  this.resizeTimeout = setTimeout( delayed, 100 );
};

// debounced, layout on resize
Outlayer.prototype.resize = function() {
  // don't trigger if size did not change
  // or if resize was unbound. See #9
  if ( !this.isResizeBound || !this.needsResizeLayout() ) {
    return;
  }

  this.layout();
};

/**
 * check if layout is needed post layout
 * @returns Boolean
 */
Outlayer.prototype.needsResizeLayout = function() {
  var size = getSize( this.element );
  // check that this.size and size are there
  // IE8 triggers resize on body size change, so they might not be
  var hasSizes = this.size && size;
  return hasSizes && size.innerWidth !== this.size.innerWidth;
};

// -------------------------- methods -------------------------- //

/**
 * add items to Outlayer instance
 * @param {Array or NodeList or Element} elems
 * @returns {Array} items - Outlayer.Items
**/
Outlayer.prototype.addItems = function( elems ) {
  var items = this._itemize( elems );
  // add items to collection
  if ( items.length ) {
    this.items = this.items.concat( items );
  }
  return items;
};

/**
 * Layout newly-appended item elements
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.appended = function( elems ) {
  var items = this.addItems( elems );
  if ( !items.length ) {
    return;
  }
  // layout and reveal just the new items
  this.layoutItems( items, true );
  this.reveal( items );
};

/**
 * Layout prepended elements
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.prepended = function( elems ) {
  var items = this._itemize( elems );
  if ( !items.length ) {
    return;
  }
  // add items to beginning of collection
  var previousItems = this.items.slice(0);
  this.items = items.concat( previousItems );
  // start new layout
  this._resetLayout();
  this._manageStamps();
  // layout new stuff without transition
  this.layoutItems( items, true );
  this.reveal( items );
  // layout previous items
  this.layoutItems( previousItems );
};

/**
 * reveal a collection of items
 * @param {Array of Outlayer.Items} items
 */
Outlayer.prototype.reveal = function( items ) {
  var len = items && items.length;
  if ( !len ) {
    return;
  }
  for ( var i=0; i < len; i++ ) {
    var item = items[i];
    item.reveal();
  }
};

/**
 * hide a collection of items
 * @param {Array of Outlayer.Items} items
 */
Outlayer.prototype.hide = function( items ) {
  var len = items && items.length;
  if ( !len ) {
    return;
  }
  for ( var i=0; i < len; i++ ) {
    var item = items[i];
    item.hide();
  }
};

/**
 * get Outlayer.Item, given an Element
 * @param {Element} elem
 * @param {Function} callback
 * @returns {Outlayer.Item} item
 */
Outlayer.prototype.getItem = function( elem ) {
  // loop through items to get the one that matches
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    var item = this.items[i];
    if ( item.element === elem ) {
      // return item
      return item;
    }
  }
};

/**
 * get collection of Outlayer.Items, given Elements
 * @param {Array} elems
 * @returns {Array} items - Outlayer.Items
 */
Outlayer.prototype.getItems = function( elems ) {
  if ( !elems || !elems.length ) {
    return;
  }
  var items = [];
  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    var item = this.getItem( elem );
    if ( item ) {
      items.push( item );
    }
  }

  return items;
};

/**
 * remove element(s) from instance and DOM
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.remove = function( elems ) {
  elems = makeArray( elems );

  var removeItems = this.getItems( elems );
  // bail if no items to remove
  if ( !removeItems || !removeItems.length ) {
    return;
  }

  this._itemsOn( removeItems, 'remove', function() {
    this.emitEvent( 'removeComplete', [ this, removeItems ] );
  });

  for ( var i=0, len = removeItems.length; i < len; i++ ) {
    var item = removeItems[i];
    item.remove();
    // remove item from collection
    removeFrom( item, this.items );
  }
};

// ----- destroy ----- //

// remove and disable Outlayer instance
Outlayer.prototype.destroy = function() {
  // clean up dynamic styles
  var style = this.element.style;
  style.height = '';
  style.position = '';
  style.width = '';
  // destroy items
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    var item = this.items[i];
    item.destroy();
  }

  this.unbindResize();

  var id = this.element.outlayerGUID;
  delete instances[ id ]; // remove reference to instance by id
  delete this.element.outlayerGUID;
  // remove data for jQuery
  if ( jQuery ) {
    jQuery.removeData( this.element, this.constructor.namespace );
  }

};

// -------------------------- data -------------------------- //

/**
 * get Outlayer instance from element
 * @param {Element} elem
 * @returns {Outlayer}
 */
Outlayer.data = function( elem ) {
  var id = elem && elem.outlayerGUID;
  return id && instances[ id ];
};


// -------------------------- create Outlayer class -------------------------- //

/**
 * create a layout class
 * @param {String} namespace
 */
Outlayer.create = function( namespace, options ) {
  // sub-class Outlayer
  function Layout() {
    Outlayer.apply( this, arguments );
  }
  // inherit Outlayer prototype, use Object.create if there
  if ( Object.create ) {
    Layout.prototype = Object.create( Outlayer.prototype );
  } else {
    extend( Layout.prototype, Outlayer.prototype );
  }
  // set contructor, used for namespace and Item
  Layout.prototype.constructor = Layout;

  Layout.defaults = extend( {}, Outlayer.defaults );
  // apply new options
  extend( Layout.defaults, options );
  // keep prototype.settings for backwards compatibility (Packery v1.2.0)
  Layout.prototype.settings = {};

  Layout.namespace = namespace;

  Layout.data = Outlayer.data;

  // sub-class Item
  Layout.Item = function LayoutItem() {
    Item.apply( this, arguments );
  };

  Layout.Item.prototype = new Item();

  // -------------------------- declarative -------------------------- //

  /**
   * allow user to initialize Outlayer via .js-namespace class
   * options are parsed from data-namespace-option attribute
   */
  docReady( function() {
    var dashedNamespace = toDashed( namespace );
    var elems = document.querySelectorAll( '.js-' + dashedNamespace );
    var dataAttr = 'data-' + dashedNamespace + '-options';

    for ( var i=0, len = elems.length; i < len; i++ ) {
      var elem = elems[i];
      var attr = elem.getAttribute( dataAttr );
      var options;
      try {
        options = attr && JSON.parse( attr );
      } catch ( error ) {
        // log error, do not initialize
        if ( console ) {
          console.error( 'Error parsing ' + dataAttr + ' on ' +
            elem.nodeName.toLowerCase() + ( elem.id ? '#' + elem.id : '' ) + ': ' +
            error );
        }
        continue;
      }
      // initialize
      var instance = new Layout( elem, options );
      // make available via $().data('layoutname')
      if ( jQuery ) {
        jQuery.data( elem, namespace, instance );
      }
    }
  });

  // -------------------------- jQuery bridge -------------------------- //

  // make into jQuery plugin
  if ( jQuery && jQuery.bridget ) {
    jQuery.bridget( namespace, Layout );
  }

  return Layout;
};

// ----- fin ----- //

// back in global
Outlayer.Item = Item;

return Outlayer;

}

// -------------------------- transport -------------------------- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'outlayer/outlayer',[
      'eventie/eventie',
      'doc-ready/doc-ready',
      'eventEmitter/EventEmitter',
      'get-size/get-size',
      'matches-selector/matches-selector',
      './item'
    ],
    outlayerDefinition );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = outlayerDefinition(
    require('eventie'),
    require('doc-ready'),
    require('wolfy87-eventemitter'),
    require('get-size'),
    require('desandro-matches-selector'),
    require('./item')
  );
} else {
  // browser global
  window.Outlayer = outlayerDefinition(
    window.eventie,
    window.docReady,
    window.EventEmitter,
    window.getSize,
    window.matchesSelector,
    window.Outlayer.Item
  );
}

})( window );

/**
 * Isotope Item
**/

( function( window ) {



// -------------------------- Item -------------------------- //

function itemDefinition( Outlayer ) {

// sub-class Outlayer Item
function Item() {
  Outlayer.Item.apply( this, arguments );
}

Item.prototype = new Outlayer.Item();

Item.prototype._create = function() {
  // assign id, used for original-order sorting
  this.id = this.layout.itemGUID++;
  Outlayer.Item.prototype._create.call( this );
  this.sortData = {};
};

Item.prototype.updateSortData = function() {
  if ( this.isIgnored ) {
    return;
  }
  // default sorters
  this.sortData.id = this.id;
  // for backward compatibility
  this.sortData['original-order'] = this.id;
  this.sortData.random = Math.random();
  // go thru getSortData obj and apply the sorters
  var getSortData = this.layout.options.getSortData;
  var sorters = this.layout._sorters;
  for ( var key in getSortData ) {
    var sorter = sorters[ key ];
    this.sortData[ key ] = sorter( this.element, this );
  }
};

var _destroy = Item.prototype.destroy;
Item.prototype.destroy = function() {
  // call super
  _destroy.apply( this, arguments );
  // reset display, #741
  this.css({
    display: ''
  });
};

return Item;

}

// -------------------------- transport -------------------------- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'isotope/js/item',[
      'outlayer/outlayer'
    ],
    itemDefinition );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = itemDefinition(
    require('outlayer')
  );
} else {
  // browser global
  window.Isotope = window.Isotope || {};
  window.Isotope.Item = itemDefinition(
    window.Outlayer
  );
}

})( window );

( function( window ) {



// --------------------------  -------------------------- //

function layoutModeDefinition( getSize, Outlayer ) {

  // layout mode class
  function LayoutMode( isotope ) {
    this.isotope = isotope;
    // link properties
    if ( isotope ) {
      this.options = isotope.options[ this.namespace ];
      this.element = isotope.element;
      this.items = isotope.filteredItems;
      this.size = isotope.size;
    }
  }

  /**
   * some methods should just defer to default Outlayer method
   * and reference the Isotope instance as `this`
  **/
  ( function() {
    var facadeMethods = [
      '_resetLayout',
      '_getItemLayoutPosition',
      '_manageStamp',
      '_getContainerSize',
      '_getElementOffset',
      'needsResizeLayout'
    ];

    for ( var i=0, len = facadeMethods.length; i < len; i++ ) {
      var methodName = facadeMethods[i];
      LayoutMode.prototype[ methodName ] = getOutlayerMethod( methodName );
    }

    function getOutlayerMethod( methodName ) {
      return function() {
        return Outlayer.prototype[ methodName ].apply( this.isotope, arguments );
      };
    }
  })();

  // -----  ----- //

  // for horizontal layout modes, check vertical size
  LayoutMode.prototype.needsVerticalResizeLayout = function() {
    // don't trigger if size did not change
    var size = getSize( this.isotope.element );
    // check that this.size and size are there
    // IE8 triggers resize on body size change, so they might not be
    var hasSizes = this.isotope.size && size;
    return hasSizes && size.innerHeight !== this.isotope.size.innerHeight;
  };

  // ----- measurements ----- //

  LayoutMode.prototype._getMeasurement = function() {
    this.isotope._getMeasurement.apply( this, arguments );
  };

  LayoutMode.prototype.getColumnWidth = function() {
    this.getSegmentSize( 'column', 'Width' );
  };

  LayoutMode.prototype.getRowHeight = function() {
    this.getSegmentSize( 'row', 'Height' );
  };

  /**
   * get columnWidth or rowHeight
   * segment: 'column' or 'row'
   * size 'Width' or 'Height'
  **/
  LayoutMode.prototype.getSegmentSize = function( segment, size ) {
    var segmentName = segment + size;
    var outerSize = 'outer' + size;
    // columnWidth / outerWidth // rowHeight / outerHeight
    this._getMeasurement( segmentName, outerSize );
    // got rowHeight or columnWidth, we can chill
    if ( this[ segmentName ] ) {
      return;
    }
    // fall back to item of first element
    var firstItemSize = this.getFirstItemSize();
    this[ segmentName ] = firstItemSize && firstItemSize[ outerSize ] ||
      // or size of container
      this.isotope.size[ 'inner' + size ];
  };

  LayoutMode.prototype.getFirstItemSize = function() {
    var firstItem = this.isotope.filteredItems[0];
    return firstItem && firstItem.element && getSize( firstItem.element );
  };

  // ----- methods that should reference isotope ----- //

  LayoutMode.prototype.layout = function() {
    this.isotope.layout.apply( this.isotope, arguments );
  };

  LayoutMode.prototype.getSize = function() {
    this.isotope.getSize();
    this.size = this.isotope.size;
  };

  // -------------------------- create -------------------------- //

  LayoutMode.modes = {};

  LayoutMode.create = function( namespace, options ) {

    function Mode() {
      LayoutMode.apply( this, arguments );
    }

    Mode.prototype = new LayoutMode();

    // default options
    if ( options ) {
      Mode.options = options;
    }

    Mode.prototype.namespace = namespace;
    // register in Isotope
    LayoutMode.modes[ namespace ] = Mode;

    return Mode;
  };


  return LayoutMode;

}

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'isotope/js/layout-mode',[
      'get-size/get-size',
      'outlayer/outlayer'
    ],
    layoutModeDefinition );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = layoutModeDefinition(
    require('get-size'),
    require('outlayer')
  );
} else {
  // browser global
  window.Isotope = window.Isotope || {};
  window.Isotope.LayoutMode = layoutModeDefinition(
    window.getSize,
    window.Outlayer
  );
}


})( window );

/*!
 * Masonry v3.2.1
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */

( function( window ) {



// -------------------------- helpers -------------------------- //

var indexOf = Array.prototype.indexOf ?
  function( items, value ) {
    return items.indexOf( value );
  } :
  function ( items, value ) {
    for ( var i=0, len = items.length; i < len; i++ ) {
      var item = items[i];
      if ( item === value ) {
        return i;
      }
    }
    return -1;
  };

// -------------------------- masonryDefinition -------------------------- //

// used for AMD definition and requires
function masonryDefinition( Outlayer, getSize ) {
  // create an Outlayer layout class
  var Masonry = Outlayer.create('masonry');

  Masonry.prototype._resetLayout = function() {
    this.getSize();
    this._getMeasurement( 'columnWidth', 'outerWidth' );
    this._getMeasurement( 'gutter', 'outerWidth' );
    this.measureColumns();

    // reset column Y
    var i = this.cols;
    this.colYs = [];
    while (i--) {
      this.colYs.push( 0 );
    }

    this.maxY = 0;
  };

  Masonry.prototype.measureColumns = function() {
    this.getContainerWidth();
    // if columnWidth is 0, default to outerWidth of first item
    if ( !this.columnWidth ) {
      var firstItem = this.items[0];
      var firstItemElem = firstItem && firstItem.element;
      // columnWidth fall back to item of first element
      this.columnWidth = firstItemElem && getSize( firstItemElem ).outerWidth ||
        // if first elem has no width, default to size of container
        this.containerWidth;
    }

    this.columnWidth += this.gutter;

    this.cols = Math.floor( ( this.containerWidth + this.gutter ) / this.columnWidth );
    this.cols = Math.max( this.cols, 1 );
  };

  Masonry.prototype.getContainerWidth = function() {
    // container is parent if fit width
    var container = this.options.isFitWidth ? this.element.parentNode : this.element;
    // check that this.size and size are there
    // IE8 triggers resize on body size change, so they might not be
    var size = getSize( container );
    this.containerWidth = size && size.innerWidth;
  };

  Masonry.prototype._getItemLayoutPosition = function( item ) {
    item.getSize();
    // how many columns does this brick span
    var remainder = item.size.outerWidth % this.columnWidth;
    var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
    // round if off by 1 pixel, otherwise use ceil
    var colSpan = Math[ mathMethod ]( item.size.outerWidth / this.columnWidth );
    colSpan = Math.min( colSpan, this.cols );

    var colGroup = this._getColGroup( colSpan );
    // get the minimum Y value from the columns
    var minimumY = Math.min.apply( Math, colGroup );
    var shortColIndex = indexOf( colGroup, minimumY );

    // position the brick
    var position = {
      x: this.columnWidth * shortColIndex,
      y: minimumY
    };

    // apply setHeight to necessary columns
    var setHeight = minimumY + item.size.outerHeight;
    var setSpan = this.cols + 1 - colGroup.length;
    for ( var i = 0; i < setSpan; i++ ) {
      this.colYs[ shortColIndex + i ] = setHeight;
    }

    return position;
  };

  /**
   * @param {Number} colSpan - number of columns the element spans
   * @returns {Array} colGroup
   */
  Masonry.prototype._getColGroup = function( colSpan ) {
    if ( colSpan < 2 ) {
      // if brick spans only one column, use all the column Ys
      return this.colYs;
    }

    var colGroup = [];
    // how many different places could this brick fit horizontally
    var groupCount = this.cols + 1 - colSpan;
    // for each group potential horizontal position
    for ( var i = 0; i < groupCount; i++ ) {
      // make an array of colY values for that one group
      var groupColYs = this.colYs.slice( i, i + colSpan );
      // and get the max value of the array
      colGroup[i] = Math.max.apply( Math, groupColYs );
    }
    return colGroup;
  };

  Masonry.prototype._manageStamp = function( stamp ) {
    var stampSize = getSize( stamp );
    var offset = this._getElementOffset( stamp );
    // get the columns that this stamp affects
    var firstX = this.options.isOriginLeft ? offset.left : offset.right;
    var lastX = firstX + stampSize.outerWidth;
    var firstCol = Math.floor( firstX / this.columnWidth );
    firstCol = Math.max( 0, firstCol );
    var lastCol = Math.floor( lastX / this.columnWidth );
    // lastCol should not go over if multiple of columnWidth #425
    lastCol -= lastX % this.columnWidth ? 0 : 1;
    lastCol = Math.min( this.cols - 1, lastCol );
    // set colYs to bottom of the stamp
    var stampMaxY = ( this.options.isOriginTop ? offset.top : offset.bottom ) +
      stampSize.outerHeight;
    for ( var i = firstCol; i <= lastCol; i++ ) {
      this.colYs[i] = Math.max( stampMaxY, this.colYs[i] );
    }
  };

  Masonry.prototype._getContainerSize = function() {
    this.maxY = Math.max.apply( Math, this.colYs );
    var size = {
      height: this.maxY
    };

    if ( this.options.isFitWidth ) {
      size.width = this._getContainerFitWidth();
    }

    return size;
  };

  Masonry.prototype._getContainerFitWidth = function() {
    var unusedCols = 0;
    // count unused columns
    var i = this.cols;
    while ( --i ) {
      if ( this.colYs[i] !== 0 ) {
        break;
      }
      unusedCols++;
    }
    // fit container to columns that have been used
    return ( this.cols - unusedCols ) * this.columnWidth - this.gutter;
  };

  Masonry.prototype.needsResizeLayout = function() {
    var previousWidth = this.containerWidth;
    this.getContainerWidth();
    return previousWidth !== this.containerWidth;
  };

  return Masonry;
}

// -------------------------- transport -------------------------- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'masonry/masonry',[
      'outlayer/outlayer',
      'get-size/get-size'
    ],
    masonryDefinition );
} else if (typeof exports === 'object') {
  module.exports = masonryDefinition(
    require('outlayer'),
    require('get-size')
  );
} else {
  // browser global
  window.Masonry = masonryDefinition(
    window.Outlayer,
    window.getSize
  );
}

})( window );

/*!
 * Masonry layout mode
 * sub-classes Masonry
 * http://masonry.desandro.com
 */

( function( window ) {



// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

// -------------------------- masonryDefinition -------------------------- //

// used for AMD definition and requires
function masonryDefinition( LayoutMode, Masonry ) {
  // create an Outlayer layout class
  var MasonryMode = LayoutMode.create('masonry');

  // save on to these methods
  var _getElementOffset = MasonryMode.prototype._getElementOffset;
  var layout = MasonryMode.prototype.layout;
  var _getMeasurement = MasonryMode.prototype._getMeasurement;

  // sub-class Masonry
  extend( MasonryMode.prototype, Masonry.prototype );

  // set back, as it was overwritten by Masonry
  MasonryMode.prototype._getElementOffset = _getElementOffset;
  MasonryMode.prototype.layout = layout;
  MasonryMode.prototype._getMeasurement = _getMeasurement;

  var measureColumns = MasonryMode.prototype.measureColumns;
  MasonryMode.prototype.measureColumns = function() {
    // set items, used if measuring first item
    this.items = this.isotope.filteredItems;
    measureColumns.call( this );
  };

  // HACK copy over isOriginLeft/Top options
  var _manageStamp = MasonryMode.prototype._manageStamp;
  MasonryMode.prototype._manageStamp = function() {
    this.options.isOriginLeft = this.isotope.options.isOriginLeft;
    this.options.isOriginTop = this.isotope.options.isOriginTop;
    _manageStamp.apply( this, arguments );
  };

  return MasonryMode;
}

// -------------------------- transport -------------------------- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'isotope/js/layout-modes/masonry',[
      '../layout-mode',
      'masonry/masonry'
    ],
    masonryDefinition );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = masonryDefinition(
    require('../layout-mode'),
    require('masonry-layout')
  );
} else {
  // browser global
  masonryDefinition(
    window.Isotope.LayoutMode,
    window.Masonry
  );
}

})( window );

( function( window ) {



function fitRowsDefinition( LayoutMode ) {

var FitRows = LayoutMode.create('fitRows');

FitRows.prototype._resetLayout = function() {
  this.x = 0;
  this.y = 0;
  this.maxY = 0;
  this._getMeasurement( 'gutter', 'outerWidth' );
};

FitRows.prototype._getItemLayoutPosition = function( item ) {
  item.getSize();

  var itemWidth = item.size.outerWidth + this.gutter;
  // if this element cannot fit in the current row
  var containerWidth = this.isotope.size.innerWidth + this.gutter;
  if ( this.x !== 0 && itemWidth + this.x > containerWidth ) {
    this.x = 0;
    this.y = this.maxY;
  }

  var position = {
    x: this.x,
    y: this.y
  };

  this.maxY = Math.max( this.maxY, this.y + item.size.outerHeight );
  this.x += itemWidth;

  return position;
};

FitRows.prototype._getContainerSize = function() {
  return { height: this.maxY };
};

return FitRows;

}

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'isotope/js/layout-modes/fit-rows',[
      '../layout-mode'
    ],
    fitRowsDefinition );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = fitRowsDefinition(
    require('../layout-mode')
  );
} else {
  // browser global
  fitRowsDefinition(
    window.Isotope.LayoutMode
  );
}

})( window );

( function( window ) {



function verticalDefinition( LayoutMode ) {

var Vertical = LayoutMode.create( 'vertical', {
  horizontalAlignment: 0
});

Vertical.prototype._resetLayout = function() {
  this.y = 0;
};

Vertical.prototype._getItemLayoutPosition = function( item ) {
  item.getSize();
  var x = ( this.isotope.size.innerWidth - item.size.outerWidth ) *
    this.options.horizontalAlignment;
  var y = this.y;
  this.y += item.size.outerHeight;
  return { x: x, y: y };
};

Vertical.prototype._getContainerSize = function() {
  return { height: this.y };
};

return Vertical;

}

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'isotope/js/layout-modes/vertical',[
      '../layout-mode'
    ],
    verticalDefinition );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = verticalDefinition(
    require('../layout-mode')
  );
} else {
  // browser global
  verticalDefinition(
    window.Isotope.LayoutMode
  );
}

})( window );

/*!
 * Isotope v2.1.0
 * Filter & sort magical layouts
 * http://isotope.metafizzy.co
 */

( function( window ) {



// -------------------------- vars -------------------------- //

var jQuery = window.jQuery;

// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

var trim = String.prototype.trim ?
  function( str ) {
    return str.trim();
  } :
  function( str ) {
    return str.replace( /^\s+|\s+$/g, '' );
  };

var docElem = document.documentElement;

var getText = docElem.textContent ?
  function( elem ) {
    return elem.textContent;
  } :
  function( elem ) {
    return elem.innerText;
  };

var objToString = Object.prototype.toString;
function isArray( obj ) {
  return objToString.call( obj ) === '[object Array]';
}

// index of helper cause IE8
var indexOf = Array.prototype.indexOf ? function( ary, obj ) {
    return ary.indexOf( obj );
  } : function( ary, obj ) {
    for ( var i=0, len = ary.length; i < len; i++ ) {
      if ( ary[i] === obj ) {
        return i;
      }
    }
    return -1;
  };

// turn element or nodeList into an array
function makeArray( obj ) {
  var ary = [];
  if ( isArray( obj ) ) {
    // use object if already an array
    ary = obj;
  } else if ( obj && typeof obj.length === 'number' ) {
    // convert nodeList to array
    for ( var i=0, len = obj.length; i < len; i++ ) {
      ary.push( obj[i] );
    }
  } else {
    // array of single index
    ary.push( obj );
  }
  return ary;
}

function removeFrom( obj, ary ) {
  var index = indexOf( ary, obj );
  if ( index !== -1 ) {
    ary.splice( index, 1 );
  }
}

// -------------------------- isotopeDefinition -------------------------- //

// used for AMD definition and requires
function isotopeDefinition( Outlayer, getSize, matchesSelector, Item, LayoutMode ) {
  // create an Outlayer layout class
  var Isotope = Outlayer.create( 'isotope', {
    layoutMode: "masonry",
    isJQueryFiltering: true,
    sortAscending: true
  });

  Isotope.Item = Item;
  Isotope.LayoutMode = LayoutMode;

  Isotope.prototype._create = function() {
    this.itemGUID = 0;
    // functions that sort items
    this._sorters = {};
    this._getSorters();
    // call super
    Outlayer.prototype._create.call( this );

    // create layout modes
    this.modes = {};
    // start filteredItems with all items
    this.filteredItems = this.items;
    // keep of track of sortBys
    this.sortHistory = [ 'original-order' ];
    // create from registered layout modes
    for ( var name in LayoutMode.modes ) {
      this._initLayoutMode( name );
    }
  };

  Isotope.prototype.reloadItems = function() {
    // reset item ID counter
    this.itemGUID = 0;
    // call super
    Outlayer.prototype.reloadItems.call( this );
  };

  Isotope.prototype._itemize = function() {
    var items = Outlayer.prototype._itemize.apply( this, arguments );
    // assign ID for original-order
    for ( var i=0, len = items.length; i < len; i++ ) {
      var item = items[i];
      item.id = this.itemGUID++;
    }
    this._updateItemsSortData( items );
    return items;
  };


  // -------------------------- layout -------------------------- //

  Isotope.prototype._initLayoutMode = function( name ) {
    var Mode = LayoutMode.modes[ name ];
    // set mode options
    // HACK extend initial options, back-fill in default options
    var initialOpts = this.options[ name ] || {};
    this.options[ name ] = Mode.options ?
      extend( Mode.options, initialOpts ) : initialOpts;
    // init layout mode instance
    this.modes[ name ] = new Mode( this );
  };


  Isotope.prototype.layout = function() {
    // if first time doing layout, do all magic
    if ( !this._isLayoutInited && this.options.isInitLayout ) {
      this.arrange();
      return;
    }
    this._layout();
  };

  // private method to be used in layout() & magic()
  Isotope.prototype._layout = function() {
    // don't animate first layout
    var isInstant = this._getIsInstant();
    // layout flow
    this._resetLayout();
    this._manageStamps();
    this.layoutItems( this.filteredItems, isInstant );

    // flag for initalized
    this._isLayoutInited = true;
  };

  // filter + sort + layout
  Isotope.prototype.arrange = function( opts ) {
    // set any options pass
    this.option( opts );
    this._getIsInstant();
    // filter, sort, and layout
    this.filteredItems = this._filter( this.items );
    this._sort();
    this._layout();
  };
  // alias to _init for main plugin method
  Isotope.prototype._init = Isotope.prototype.arrange;

  // HACK
  // Don't animate/transition first layout
  // Or don't animate/transition other layouts
  Isotope.prototype._getIsInstant = function() {
    var isInstant = this.options.isLayoutInstant !== undefined ?
      this.options.isLayoutInstant : !this._isLayoutInited;
    this._isInstant = isInstant;
    return isInstant;
  };

  // -------------------------- filter -------------------------- //

  Isotope.prototype._filter = function( items ) {
    var filter = this.options.filter;
    filter = filter || '*';
    var matches = [];
    var hiddenMatched = [];
    var visibleUnmatched = [];

    var test = this._getFilterTest( filter );

    // test each item
    for ( var i=0, len = items.length; i < len; i++ ) {
      var item = items[i];
      if ( item.isIgnored ) {
        continue;
      }
      // add item to either matched or unmatched group
      var isMatched = test( item );
      // item.isFilterMatched = isMatched;
      // add to matches if its a match
      if ( isMatched ) {
        matches.push( item );
      }
      // add to additional group if item needs to be hidden or revealed
      if ( isMatched && item.isHidden ) {
        hiddenMatched.push( item );
      } else if ( !isMatched && !item.isHidden ) {
        visibleUnmatched.push( item );
      }
    }

    var _this = this;
    function hideReveal() {
      _this.reveal( hiddenMatched );
      _this.hide( visibleUnmatched );
    }

    if ( this._isInstant ) {
      this._noTransition( hideReveal );
    } else {
      hideReveal();
    }

    return matches;
  };

  // get a jQuery, function, or a matchesSelector test given the filter
  Isotope.prototype._getFilterTest = function( filter ) {
    if ( jQuery && this.options.isJQueryFiltering ) {
      // use jQuery
      return function( item ) {
        return jQuery( item.element ).is( filter );
      };
    }
    if ( typeof filter === 'function' ) {
      // use filter as function
      return function( item ) {
        return filter( item.element );
      };
    }
    // default, use filter as selector string
    return function( item ) {
      return matchesSelector( item.element, filter );
    };
  };

  // -------------------------- sorting -------------------------- //

  /**
   * @params {Array} elems
   * @public
   */
  Isotope.prototype.updateSortData = function( elems ) {
    // get items
    var items;
    if ( elems ) {
      elems = makeArray( elems );
      items = this.getItems( elems );
    } else {
      // update all items if no elems provided
      items = this.items;
    }

    this._getSorters();
    this._updateItemsSortData( items );
  };

  Isotope.prototype._getSorters = function() {
    var getSortData = this.options.getSortData;
    for ( var key in getSortData ) {
      var sorter = getSortData[ key ];
      this._sorters[ key ] = mungeSorter( sorter );
    }
  };

  /**
   * @params {Array} items - of Isotope.Items
   * @private
   */
  Isotope.prototype._updateItemsSortData = function( items ) {
    // do not update if no items
    var len = items && items.length;

    for ( var i=0; len && i < len; i++ ) {
      var item = items[i];
      item.updateSortData();
    }
  };

  // ----- munge sorter ----- //

  // encapsulate this, as we just need mungeSorter
  // other functions in here are just for munging
  var mungeSorter = ( function() {
    // add a magic layer to sorters for convienent shorthands
    // `.foo-bar` will use the text of .foo-bar querySelector
    // `[foo-bar]` will use attribute
    // you can also add parser
    // `.foo-bar parseInt` will parse that as a number
    function mungeSorter( sorter ) {
      // if not a string, return function or whatever it is
      if ( typeof sorter !== 'string' ) {
        return sorter;
      }
      // parse the sorter string
      var args = trim( sorter ).split(' ');
      var query = args[0];
      // check if query looks like [an-attribute]
      var attrMatch = query.match( /^\[(.+)\]$/ );
      var attr = attrMatch && attrMatch[1];
      var getValue = getValueGetter( attr, query );
      // use second argument as a parser
      var parser = Isotope.sortDataParsers[ args[1] ];
      // parse the value, if there was a parser
      sorter = parser ? function( elem ) {
        return elem && parser( getValue( elem ) );
      } :
      // otherwise just return value
      function( elem ) {
        return elem && getValue( elem );
      };

      return sorter;
    }

    // get an attribute getter, or get text of the querySelector
    function getValueGetter( attr, query ) {
      var getValue;
      // if query looks like [foo-bar], get attribute
      if ( attr ) {
        getValue = function( elem ) {
          return elem.getAttribute( attr );
        };
      } else {
        // otherwise, assume its a querySelector, and get its text
        getValue = function( elem ) {
          var child = elem.querySelector( query );
          return child && getText( child );
        };
      }
      return getValue;
    }

    return mungeSorter;
  })();

  // parsers used in getSortData shortcut strings
  Isotope.sortDataParsers = {
    'parseInt': function( val ) {
      return parseInt( val, 10 );
    },
    'parseFloat': function( val ) {
      return parseFloat( val );
    }
  };

  // ----- sort method ----- //

  // sort filteredItem order
  Isotope.prototype._sort = function() {
    var sortByOpt = this.options.sortBy;
    if ( !sortByOpt ) {
      return;
    }
    // concat all sortBy and sortHistory
    var sortBys = [].concat.apply( sortByOpt, this.sortHistory );
    // sort magic
    var itemSorter = getItemSorter( sortBys, this.options.sortAscending );
    this.filteredItems.sort( itemSorter );
    // keep track of sortBy History
    if ( sortByOpt !== this.sortHistory[0] ) {
      // add to front, oldest goes in last
      this.sortHistory.unshift( sortByOpt );
    }
  };

  // returns a function used for sorting
  function getItemSorter( sortBys, sortAsc ) {
    return function sorter( itemA, itemB ) {
      // cycle through all sortKeys
      for ( var i = 0, len = sortBys.length; i < len; i++ ) {
        var sortBy = sortBys[i];
        var a = itemA.sortData[ sortBy ];
        var b = itemB.sortData[ sortBy ];
        if ( a > b || a < b ) {
          // if sortAsc is an object, use the value given the sortBy key
          var isAscending = sortAsc[ sortBy ] !== undefined ? sortAsc[ sortBy ] : sortAsc;
          var direction = isAscending ? 1 : -1;
          return ( a > b ? 1 : -1 ) * direction;
        }
      }
      return 0;
    };
  }

  // -------------------------- methods -------------------------- //

  // get layout mode
  Isotope.prototype._mode = function() {
    var layoutMode = this.options.layoutMode;
    var mode = this.modes[ layoutMode ];
    if ( !mode ) {
      // TODO console.error
      throw new Error( 'No layout mode: ' + layoutMode );
    }
    // HACK sync mode's options
    // any options set after init for layout mode need to be synced
    mode.options = this.options[ layoutMode ];
    return mode;
  };

  Isotope.prototype._resetLayout = function() {
    // trigger original reset layout
    Outlayer.prototype._resetLayout.call( this );
    this._mode()._resetLayout();
  };

  Isotope.prototype._getItemLayoutPosition = function( item  ) {
    return this._mode()._getItemLayoutPosition( item );
  };

  Isotope.prototype._manageStamp = function( stamp ) {
    this._mode()._manageStamp( stamp );
  };

  Isotope.prototype._getContainerSize = function() {
    return this._mode()._getContainerSize();
  };

  Isotope.prototype.needsResizeLayout = function() {
    return this._mode().needsResizeLayout();
  };

  // -------------------------- adding & removing -------------------------- //

  // HEADS UP overwrites default Outlayer appended
  Isotope.prototype.appended = function( elems ) {
    var items = this.addItems( elems );
    if ( !items.length ) {
      return;
    }
    var filteredItems = this._filterRevealAdded( items );
    // add to filteredItems
    this.filteredItems = this.filteredItems.concat( filteredItems );
  };

  // HEADS UP overwrites default Outlayer prepended
  Isotope.prototype.prepended = function( elems ) {
    var items = this._itemize( elems );
    if ( !items.length ) {
      return;
    }
    // add items to beginning of collection
    var previousItems = this.items.slice(0);
    this.items = items.concat( previousItems );
    // start new layout
    this._resetLayout();
    this._manageStamps();
    // layout new stuff without transition
    var filteredItems = this._filterRevealAdded( items );
    // layout previous items
    this.layoutItems( previousItems );
    // add to filteredItems
    this.filteredItems = filteredItems.concat( this.filteredItems );
  };

  Isotope.prototype._filterRevealAdded = function( items ) {
    var filteredItems = this._noTransition( function() {
      return this._filter( items );
    });
    // layout and reveal just the new items
    this.layoutItems( filteredItems, true );
    this.reveal( filteredItems );
    return items;
  };

  /**
   * Filter, sort, and layout newly-appended item elements
   * @param {Array or NodeList or Element} elems
   */
  Isotope.prototype.insert = function( elems ) {
    var items = this.addItems( elems );
    if ( !items.length ) {
      return;
    }
    // append item elements
    var i, item;
    var len = items.length;
    for ( i=0; i < len; i++ ) {
      item = items[i];
      this.element.appendChild( item.element );
    }
    // filter new stuff
    /*
    // this way adds hides new filtered items with NO transition
    // so user can't see if new hidden items have been inserted
    var filteredInsertItems;
    this._noTransition( function() {
      filteredInsertItems = this._filter( items );
      // hide all new items
      this.hide( filteredInsertItems );
    });
    // */
    // this way hides new filtered items with transition
    // so user at least sees that something has been added
    var filteredInsertItems = this._filter( items );
    // hide all newitems
    this._noTransition( function() {
      this.hide( filteredInsertItems );
    });
    // */
    // set flag
    for ( i=0; i < len; i++ ) {
      items[i].isLayoutInstant = true;
    }
    this.arrange();
    // reset flag
    for ( i=0; i < len; i++ ) {
      delete items[i].isLayoutInstant;
    }
    this.reveal( filteredInsertItems );
  };

  var _remove = Isotope.prototype.remove;
  Isotope.prototype.remove = function( elems ) {
    elems = makeArray( elems );
    var removeItems = this.getItems( elems );
    // do regular thing
    _remove.call( this, elems );
    // bail if no items to remove
    if ( !removeItems || !removeItems.length ) {
      return;
    }
    // remove elems from filteredItems
    for ( var i=0, len = removeItems.length; i < len; i++ ) {
      var item = removeItems[i];
      // remove item from collection
      removeFrom( item, this.filteredItems );
    }
  };

  Isotope.prototype.shuffle = function() {
    // update random sortData
    for ( var i=0, len = this.items.length; i < len; i++ ) {
      var item = this.items[i];
      item.sortData.random = Math.random();
    }
    this.options.sortBy = 'random';
    this._sort();
    this._layout();
  };

  /**
   * trigger fn without transition
   * kind of hacky to have this in the first place
   * @param {Function} fn
   * @returns ret
   * @private
   */
  Isotope.prototype._noTransition = function( fn ) {
    // save transitionDuration before disabling
    var transitionDuration = this.options.transitionDuration;
    // disable transition
    this.options.transitionDuration = 0;
    // do it
    var returnValue = fn.call( this );
    // re-enable transition for reveal
    this.options.transitionDuration = transitionDuration;
    return returnValue;
  };

  // ----- helper methods ----- //

  /**
   * getter method for getting filtered item elements
   * @returns {Array} elems - collection of item elements
   */
  Isotope.prototype.getFilteredItemElements = function() {
    var elems = [];
    for ( var i=0, len = this.filteredItems.length; i < len; i++ ) {
      elems.push( this.filteredItems[i].element );
    }
    return elems;
  };

  // -----  ----- //

  return Isotope;
}

// -------------------------- transport -------------------------- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( [
      'outlayer/outlayer',
      'get-size/get-size',
      'matches-selector/matches-selector',
      'isotope/js/item',
      'isotope/js/layout-mode',
      // include default layout modes
      'isotope/js/layout-modes/masonry',
      'isotope/js/layout-modes/fit-rows',
      'isotope/js/layout-modes/vertical'
    ],
    isotopeDefinition );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = isotopeDefinition(
    require('outlayer'),
    require('get-size'),
    require('desandro-matches-selector'),
    require('./item'),
    require('./layout-mode'),
    // include default layout modes
    require('./layout-modes/masonry'),
    require('./layout-modes/fit-rows'),
    require('./layout-modes/vertical')
  );
} else {
  // browser global
  window.Isotope = isotopeDefinition(
    window.Outlayer,
    window.getSize,
    window.matchesSelector,
    window.Isotope.Item,
    window.Isotope.LayoutMode
  );
}

})( window );

;(function( win, doc, $ ) {
	"use strict";

	var $loadingIndicator,
		$count;

	function featureTest( prop, unprefixedProp ) {
		var style = doc.createElement('social').style,
			prefixes = 'webkit Moz o ms'.split(' ');

		if( unprefixedProp in style ) {
			return true;
		}
		for( var j = 0, k = prefixes.length; j < k; j++ ) {
			if( ( prefixes[ j ] + prop ) in style ) {
				return true;
			}
		}
		return false;
	}

	function removeFileName( src ) {
		var split = src.split( '/' );
		split.pop();
		return split.join( '/' ) + '/';
	}

	function resolveServiceDir() {
		var baseUrl;

		$( 'script' ).each(function() {
			var src = this.src || '';

			if( src.match( SocialCount.scriptSrcRegex ) ) {
				baseUrl = removeFileName( src );
				return false;
			}
		});

		return baseUrl;
	}

	var SocialCount = {
		// For A-grade experience, require querySelector (IE8+) and not BlackBerry or touchscreen
		isGradeA: 'querySelectorAll' in doc && !win.blackberry && !('ontouchstart' in window) && !('onmsgesturechange' in window),
		minCount: 1,
		serviceUrl: 'service/index.php',
		initSelector: '.socialcount',
		classes: {
			gradeA: 'grade-a',
			active: 'active',
			touch: 'touch',
			noTransforms: 'no-transforms',
			showCounts: 'counts',
			countContent: 'count',
			minCount: 'minimum'
		},
		thousandCharacter: 'K',
		millionCharacter: 'M',
		missingResultText: '-',
		selectors: {
			facebook: '.facebook',
			twitter: '.twitter',
			googleplus: '.googleplus'
		},
		scriptSrcRegex: /socialcount[\w.]*.js/i,
		plugins: {
			init: [],
			bind: []
		},

		// private, but for testing
		cache: {},

		removeFileName: removeFileName,
		resolveServiceDir: resolveServiceDir,

		isCssAnimations: function() {
			return featureTest( 'AnimationName', 'animationName' );
		},
		isCssTransforms: function() {
			return featureTest( 'Transform', 'transform' );
		},
		getUrl: function( $el ) {
			return $el.attr('data-url') || location.href;
		},
		getFacebookAction: function( $el ) {
			return ( $el.attr('data-facebook-action' ) || 'like' ).toLowerCase();
		},
		isCountsEnabled: function( $el ) {
			return $el.attr('data-counts') === 'true';
		},
		isSmallSize: function( $el ) {
			return $el.is( '.socialcount-small' );
		},
		getCounts: function( $el, url ) {
			var map = SocialCount.selectors,
				cache = SocialCount.cache,
				counts = {},
				$networkNode,
				$countNode,
				j;

			for( j in map ) {
				$networkNode = $el.find( map[ j ] );
				$countNode = $networkNode.find( '.' + SocialCount.classes.countContent );

				if( $countNode.length ) {
					counts[ j ] = $countNode;
				} else {
					counts[ j ] = $count.clone();
					$networkNode.append( counts[ j ] );
				}
			}

			if( !cache[ url ] ) {
				cache[ url ] = $.ajax({
					url: resolveServiceDir() + SocialCount.serviceUrl,
					data: {
						url: url
					},
					dataType: 'json'
				});
			}

			cache[ url ].done( function complete( data ) {
				for( var j in data ) {
					if( data.hasOwnProperty( j ) ) {
						if( counts[ j ] && data[ j ] > SocialCount.minCount ) {
							counts[ j ].addClass( SocialCount.classes.minCount )
								.html( SocialCount.normalizeCount( data[ j ] ) );
						}
					}
				}
			});

			return cache[ url ];
		},
		init: function( $el ) {
			var facebookAction = SocialCount.getFacebookAction( $el ),
				classes = [ facebookAction ],
				isSmall = SocialCount.isSmallSize( $el ),
				url = SocialCount.getUrl( $el ),
				initPlugins = SocialCount.plugins.init,
				countsEnabled = SocialCount.isCountsEnabled( $el );

			if( SocialCount.isGradeA ) {
				classes.push( SocialCount.classes.gradeA );
			}
			if( !SocialCount.isCssTransforms() ) {
				classes.push( SocialCount.classes.noTransforms );
			}
			if( countsEnabled ) {
				classes.push( SocialCount.classes.showCounts );
			}
			$el.addClass( classes.join(' ') );

			for( var j = 0, k = initPlugins.length; j < k; j++ ) {
				initPlugins[ j ].call( $el );
			}

			if( SocialCount.isGradeA ) {
				SocialCount.bindEvents( $el, url, facebookAction, isSmall );
			}

			if( countsEnabled && !isSmall ) {
				SocialCount.getCounts( $el, url );
			}
		},
		normalizeCount: function( count ) {
			if( !count && count !== 0 ) {
				return SocialCount.missingResultText;
			}
			// > 1M
			if( count >= 1000000 ) {
				return Math.floor( count / 1000000 ) + SocialCount.millionCharacter;
			}
			// > 100K
			if( count >= 100000 ) {
				return Math.floor( count / 1000 ) + SocialCount.thousandCharacter;
			}
			if( count > 1000 ) {
				return ( count / 1000 ).toFixed( 1 ).replace( /\.0/, '' ) + SocialCount.thousandCharacter;
			}
			return count;
		},
		bindEvents: function( $el, url, facebookAction, isSmall ) {
			function bind( $a, html, jsUrl ) {
				// IE bug (tested up to version 9) with :hover rules and iframes.
				$a.closest('li').bind('mouseenter', function() {
					$( this ).closest( 'li' ).addClass( 'hover' );
				}).bind('mouseleave', function() {
					$( this ).closest( 'li' ).removeClass( 'hover' );
				});

				$a.one( 'mouseover', function() {
						var $self = $( this ),
							$parent = $self.closest( 'li' ),
							$loading = $loadingIndicator.clone(),
							$content = $( html ),
							$button = $( '<div class="sc-button"/>' ).append( $content ),
							js,
							deferred = $.Deferred();

						deferred.promise().always(function() {
							// Remove Loader
							var $iframe = $parent.find('iframe');

							if( $iframe.length ) {
								$iframe.bind( 'load', function() {
									$loading.remove();
								});
							} else {
								$loading.remove();
							}
						});

						$parent
							.addClass( SocialCount.classes.active )
							.append( $loading )
							.append( $button );

						if( jsUrl ) {
							js = doc.createElement( 'script' );
							js.src = jsUrl;

							// IE8 doesn't do script onload.
							if( js.attachEvent ) {
								js.attachEvent( 'onreadystatechange', function() {
									if( js.readyState === 'complete' ) {
										deferred.resolve();
									}
								});
							} else {
								$( js ).bind( 'load', deferred.resolve );
							}

							doc.body.appendChild( js );
						} else if( $content.is( 'iframe' ) ) {
							deferred.resolve();
						}
					});
			}

			if( !isSmall ) {
				bind( $el.find( SocialCount.selectors.facebook + ' a' ),
					'<iframe src="//www.facebook.com/plugins/like.php?href=' + encodeURIComponent( url ) + '&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=true&amp;action=' + facebookAction + '&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowTransparency="true"></iframe>' );

				bind( $el.find( SocialCount.selectors.twitter + ' a' ),
					'<a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>',
					'//platform.twitter.com/widgets.js' );

				bind( $el.find( SocialCount.selectors.googleplus + ' a' ),
					'<div class="g-plusone" data-size="medium" data-annotation="none"></div>',
					'//apis.google.com/js/plusone.js' );
			}

			var bindPlugins = SocialCount.plugins.bind;
			for( var j = 0, k = bindPlugins.length; j < k; j++ ) {
				bindPlugins[ j ].call( $el, bind, url, isSmall );
			}
		}
	};

	$(function() {
		// Thanks to http://codepen.io/ericmatthys/pen/FfcEL
		$loadingIndicator = $('<div>')
			.addClass('sc-loading')
			.html( SocialCount.isCssAnimations() ? new Array(4).join('<div class="dot"></div>') : 'Loading' );

		$count = $('<span>')
			.addClass( SocialCount.classes.countContent )
			.html('&#160;');

		$( SocialCount.initSelector ).each(function() {
			var $el = $(this);
			SocialCount.init($el);
		});
	});

	window.SocialCount = SocialCount;

}( window, window.document, jQuery ));

/* Pinterest plugin */

(function( $, SocialCount ) {
	'use strict';
	
	SocialCount.classes.pinterest = '.pinterest';

	SocialCount.plugins.bind.push(function(bind, url) {
		var $el = this;

    var desc = $el.data('share-text');
    var media = $el.data('media');

		bind( $el.find( SocialCount.classes.pinterest ),
      '<a href="http://pinterest.com/pin/create/button/?url=' + url + '&media=' + media + '&description=' + desc + '" class="pin-it-button" count-layout="none"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>',
      '//assets.pinterest.com/js/pinit.js');
	});

})( jQuery, window.SocialCount );

/**!
 * easyPieChart
 * Lightweight plugin to render simple, animated and retina optimized pie charts
 *
 * @license Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * @author Robert Fleischmann <rendro87@gmail.com> (http://robert-fleischmann.de)
 * @version 2.1.3
 **/

(function(root, factory) {
    if(typeof exports === 'object') {
        module.exports = factory(require('jquery'));
    }
    else if(typeof define === 'function' && define.amd) {
        define('EasyPieChart', ['jquery'], factory);
    }
    else {
        factory(root.jQuery);
    }
}(this, function($) {
/**
 * Renderer to render the chart on a canvas object
 * @param {DOMElement} el      DOM element to host the canvas (root of the plugin)
 * @param {object}     options options object of the plugin
 */
var CanvasRenderer = function(el, options) {
	var cachedBackground;
	var canvas = document.createElement('canvas');

	if (typeof(G_vmlCanvasManager) !== 'undefined') {
		G_vmlCanvasManager.initElement(canvas);
	}

	var ctx = canvas.getContext('2d');

	canvas.width = canvas.height = options.size;

	el.appendChild(canvas);

	// canvas on retina devices
	var scaleBy = 1;
	if (window.devicePixelRatio > 1) {
		scaleBy = window.devicePixelRatio;
		canvas.style.width = canvas.style.height = [options.size, 'px'].join('');
		canvas.width = canvas.height = options.size * scaleBy;
		ctx.scale(scaleBy, scaleBy);
	}

	// move 0,0 coordinates to the center
	ctx.translate(options.size / 2, options.size / 2);

	// rotate canvas -90deg
	ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI);

	var radius = (options.size - options.lineWidth) / 2;
	if (options.scaleColor && options.scaleLength) {
		radius -= options.scaleLength + 2; // 2 is the distance between scale and bar
	}

	// IE polyfill for Date
	Date.now = Date.now || function() {
		return +(new Date());
	};

	/**
	 * Draw a circle around the center of the canvas
	 * @param {strong} color     Valid CSS color string
	 * @param {number} lineWidth Width of the line in px
	 * @param {number} percent   Percentage to draw (float between -1 and 1)
	 */
	var drawCircle = function(color, lineWidth, percent) {
		percent = Math.min(Math.max(-1, percent || 0), 1);
		var isNegative = percent <= 0 ? true : false;

		ctx.beginPath();
		ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, isNegative);

		ctx.strokeStyle = color;
		ctx.lineWidth = lineWidth;

		ctx.stroke();
	};

	/**
	 * Draw the scale of the chart
	 */
	var drawScale = function() {
		var offset;
		var length;
		var i = 24;

		ctx.lineWidth = 1
		ctx.fillStyle = options.scaleColor;

		ctx.save();
		for (var i = 24; i > 0; --i) {
			if (i%6 === 0) {
				length = options.scaleLength;
				offset = 0;
			} else {
				length = options.scaleLength * .6;
				offset = options.scaleLength - length;
			}
			ctx.fillRect(-options.size/2 + offset, 0, length, 1);
			ctx.rotate(Math.PI / 12);
		}
		ctx.restore();
	};

	/**
	 * Request animation frame wrapper with polyfill
	 * @return {function} Request animation frame method or timeout fallback
	 */
	var reqAnimationFrame = (function() {
		return  window.requestAnimationFrame ||
				window.webkitRequestAnimationFrame ||
				window.mozRequestAnimationFrame ||
				function(callback) {
					window.setTimeout(callback, 1000 / 60);
				};
	}());

	/**
	 * Draw the background of the plugin including the scale and the track
	 */
	var drawBackground = function() {
		options.scaleColor && drawScale();
		options.trackColor && drawCircle(options.trackColor, options.lineWidth, 1);
	};

	/**
	 * Clear the complete canvas
	 */
	this.clear = function() {
		ctx.clearRect(options.size / -2, options.size / -2, options.size, options.size);
	};

	/**
	 * Draw the complete chart
	 * @param {number} percent Percent shown by the chart between -100 and 100
	 */
	this.draw = function(percent) {
		// do we need to render a background
		if (!!options.scaleColor || !!options.trackColor) {
			// getImageData and putImageData are supported
			if (ctx.getImageData && ctx.putImageData) {
				if (!cachedBackground) {
					drawBackground();
					cachedBackground = ctx.getImageData(0, 0, options.size * scaleBy, options.size * scaleBy);
				} else {
					ctx.putImageData(cachedBackground, 0, 0);
				}
			} else {
				this.clear();
				drawBackground();
			}
		} else {
			this.clear();
		}

		ctx.lineCap = options.lineCap;

		// if barcolor is a function execute it and pass the percent as a value
		var color;
		if (typeof(options.barColor) === 'function') {
			color = options.barColor(percent);
		} else {
			color = options.barColor;
		}

		// draw bar
		drawCircle(color, options.lineWidth, percent / 100);
	}.bind(this);

	/**
	 * Animate from some percent to some other percentage
	 * @param {number} from Starting percentage
	 * @param {number} to   Final percentage
	 */
	this.animate = function(from, to) {
		var startTime = Date.now();
		options.onStart(from, to);
		var animation = function() {
			var process = Math.min(Date.now() - startTime, options.animate);
			var currentValue = options.easing(this, process, from, to - from, options.animate);
			this.draw(currentValue);
			options.onStep(from, to, currentValue);
			if (process >= options.animate) {
				options.onStop(from, to);
			} else {
				reqAnimationFrame(animation);
			}
		}.bind(this);

		reqAnimationFrame(animation);
	}.bind(this);
};

var EasyPieChart = function(el, opts) {
	var defaultOptions = {
		barColor: '#ef1e25',
		trackColor: '#f9f9f9',
		scaleColor: '#dfe0e0',
		scaleLength: 5,
		lineCap: 'round',
		lineWidth: 3,
		size: 110,
		rotate: 0,
		animate: 1000,
		easing: function (x, t, b, c, d) { // more can be found here: http://gsgd.co.uk/sandbox/jquery/easing/
			t = t / (d/2);
			if (t < 1) {
				return c / 2 * t * t + b;
			}
			return -c/2 * ((--t)*(t-2) - 1) + b;
		},
		onStart: function(from, to) {
			return;
		},
		onStep: function(from, to, currentValue) {
			return;
		},
		onStop: function(from, to) {
			return;
		}
	};

	// detect present renderer
	if (typeof(CanvasRenderer) !== 'undefined') {
		defaultOptions.renderer = CanvasRenderer;
	} else if (typeof(SVGRenderer) !== 'undefined') {
		defaultOptions.renderer = SVGRenderer;
	} else {
		throw new Error('Please load either the SVG- or the CanvasRenderer');
	}

	var options = {};
	var currentValue = 0;

	/**
	 * Initialize the plugin by creating the options object and initialize rendering
	 */
	var init = function() {
		this.el = el;
		this.options = options;

		// merge user options into default options
		for (var i in defaultOptions) {
			if (defaultOptions.hasOwnProperty(i)) {
				options[i] = opts && typeof(opts[i]) !== 'undefined' ? opts[i] : defaultOptions[i];
				if (typeof(options[i]) === 'function') {
					options[i] = options[i].bind(this);
				}
			}
		}

		// check for jQuery easing
		if (typeof(options.easing) === 'string' && typeof(jQuery) !== 'undefined' && jQuery.isFunction(jQuery.easing[options.easing])) {
			options.easing = jQuery.easing[options.easing];
		} else {
			options.easing = defaultOptions.easing;
		}

		// create renderer
		this.renderer = new options.renderer(el, options);

		// initial draw
		this.renderer.draw(currentValue);

		// initial update
		if (el.dataset && el.dataset.percent) {
			this.update(parseFloat(el.dataset.percent));
		} else if (el.getAttribute && el.getAttribute('data-percent')) {
			this.update(parseFloat(el.getAttribute('data-percent')));
		}
	}.bind(this);

	/**
	 * Update the value of the chart
	 * @param  {number} newValue Number between 0 and 100
	 * @return {object}          Instance of the plugin for method chaining
	 */
	this.update = function(newValue) {
		newValue = parseFloat(newValue);
		if (options.animate) {
			this.renderer.animate(currentValue, newValue);
		} else {
			this.renderer.draw(newValue);
		}
		currentValue = newValue;
		return this;
	}.bind(this);

	init();
};

$.fn.easyPieChart = function(options) {
	return this.each(function() {
		var instanceOptions;

		if (!$.data(this, 'easyPieChart')) {
			instanceOptions = $.extend({}, options, $(this).data());
			$.data(this, 'easyPieChart', new EasyPieChart(this, instanceOptions));
		}
	});
};

}));

(function($, undefined) {
	'use strict';

	$.fn.wpvDoubleTapClick = function() {
		var self = this;

		if(Modernizr.touch) {
			var currently_active;

			$(self).bind('click', function(e) {
				if(currently_active !== this) {
					e.preventDefault();
					currently_active = this;
				}

				e.stopPropagation();
			});

			$(window).bind('click.sub-menu-double-tap', function() {
				currently_active = undefined;
			});
		}

		return self;
	};
})(jQuery);
(function() {
	"use strict";

	// Namespace
	jQuery.WPV = jQuery.WPV || {};

	// jquery plugins
	(function($) {

		$.WPV.reduce_column_count = function(columns) {
			if (!$('body').hasClass('responsive-layout'))
				return columns;

			var win_width = $(window).width();

			if (win_width < 770)
				return 1;

			if (win_width >= 768 && win_width <= 1024)
				return Math.min(columns, 2);

			if (win_width > 1024 && win_width < 1280)
				return Math.min(columns, 3);

			return columns;
		};

		/**
		 * Modified version if the touchwipe plugin by  Andreas Waltl,
		 * netCU Internetagentur (http://www.netcu.de)
		 * We have added support for the desktop browsers, so it works the same with
		 * mouse events too.
		 */
		$.fn.touchwipe = function(settings) {
			var config = {
				min_move_x: 20,
				min_move_y: 20,
				wipeLeft: function() {},
				wipeRight: function() {},
				wipeUp: function() {},
				wipeDown: function() {},
				preventDefaultEvents: true,
				canUseEvent: function() {
					return true;
				}
			};

			if (settings) {
				$.extend(config, settings);
			}

			this.each(function(i, o) {
				var startX;
				var startY;
				var isMoving = false;

				function cancelTouch() {
					$(o).unbind("touchmove", onTouchMove);
					startX = null;
					isMoving = false;
				}

				function onTouchMove(e) {
					if (config.preventDefaultEvents) {
						e.preventDefault();
					}
					if (isMoving) {
						var x = e.originalEvent.touches ? e.originalEvent.touches[0].pageX : e.pageX;
						var y = e.originalEvent.touches ? e.originalEvent.touches[0].pageY : e.pageY;
						var dx = startX - x;
						var dy = startY - y;
						if (Math.abs(dx) >= config.min_move_x) {
							cancelTouch();
							if (dx > 0) {
								config.wipeLeft.call(o, e);
							} else {
								config.wipeRight.call(o, e);
							}
						} else if (Math.abs(dy) >= config.min_move_y) {
							cancelTouch();
							if (dy > 0) {
								config.wipeDown.call(o, e);
							} else {
								config.wipeUp.call(o, e);
							}
						}
					}
				}

				function onTouchStart(e) {
					if (!config.canUseEvent(e)) {
						return true;
					}
					if (e.originalEvent.touches) {
						if (e.originalEvent.touches.length > 1) {
							return true;
						}
						startX = e.originalEvent.touches[0].pageX;
						startY = e.originalEvent.touches[0].pageY;
					} else {
						startX = e.pageX;
						startY = e.pageY;
					}
					isMoving = true;
					$(o).bind("touchmove", onTouchMove);
					if (config.preventDefaultEvents) {
						e.preventDefault();
					}
					e.stopPropagation();
				}

				$(o).bind("touchstart", onTouchStart);
			});
			return this;
		};

	})(jQuery);
})();
;(function($) {
	"use strict";
	
	var readyStarted = false;
	var readyEnded = false;

	// This should be the FIRST ready handler to execute
	$(function() {
		readyStarted = true;
	});

	// This should be the LAST ready handler to execute
	$(document).bind("ready", function() {
		readyEnded = true;
	});

	$.rawContentHandler = function(cb) {
		if ($.isFunction(cb)) {
			if (!readyStarted) {
				$(function() {
					$.rawContentHandler(cb);
				});
			} else {
				if (!readyEnded) {
					var tgt = $("body")[0];
					cb.call(tgt, tgt.childNodes);
				}

				$(window).bind("rawContent", function(e, items) {
					cb.call(e.target, items || e.target.childNodes);
				});
			}
		}
	};
})(jQuery);
(function($){
	"use strict";

	var $window = $(window);

	// Function that returns true if the image is visible inside the "window"
	// (or specified container element)
	function _isInTheScreen($img, $ct, optionOffset) {
		$ct = $ct || $window;
		optionOffset = optionOffset || 0;
		var is_ct_window  = $ct[0] === window,
			ct_offset  = (is_ct_window ? { top:0, left:0 } : $ct.offset()),
			ct_top     = ct_offset.top + ( is_ct_window ? $ct.scrollTop() : 0),
			ct_left    = ct_offset.left + ( is_ct_window ? $ct.scrollLeft() : 0),
			ct_right   = ct_left + $ct.width(),
			ct_bottom  = ct_top + $ct.height(),
			img_offset = $img.offset(),
			img_width = $img.width(),
			img_height = $img.height();

		return (ct_top - optionOffset) <= (img_offset.top + img_height) &&
			(ct_bottom + optionOffset) >= img_offset.top &&
				(ct_left - optionOffset)<= (img_offset.left + img_width) &&
					(ct_right + optionOffset) >= img_offset.left;
	}

	function doLoadSingleImage($img, src, options) {
		$img.css("opacity", 0).attr("src", src).removeClass("loading").addClass("loaded").trigger("jailStartAnimation");

		$img.animate({
			opacity : 1
		},
		{
			duration : options.speed,
			easing   : "linear",
			queue    : false,
			complete : function() {
				if (options.resizeImages && this.originalCssHeight) {
					this.style.height = this.originalCssHeight;
					delete this.originalCssHeight;
				}
				$img.trigger("jailComplete");
				if (options.callbackAfterEachImage) {
					options.callbackAfterEachImage.call(this, $img, options);
				}
				if (options.images && options.callback && !options.callback.called && areAllImagesLoaded(options.images)) {
					options.callback.called = true;
					options.callback();
				}
			}
		});
	}

	function doLoadImages(event) {
		$("img.lazy[data-href]").each(function(i, o) {
			var $img = $(o);
			var options = $.extend({
				timeout                : 10,
				effect                 : false,
				speed                  : 400,
				selector               : null,
				offset                 : 0,
				event                  : 'scroll',
				callback               : jQuery.noop,
				callbackAfterEachImage : jQuery.noop,
				placeholder            : false,
				resizeImages           : true,
				container              : $window
			}, $img.data("jailOptions") || {});

			if (!event || event === "scroll" || event === "resize" || event === "orientationchange" || options.event === event) {
				if (!options.event || !(/scroll|resize|orientationchange/i).test(options.event) || _isInTheScreen($img, options.container)) {
					if (!$img.is(".loading")) {
						$img.addClass("loading");
						var img = new Image(), href = o.getAttribute("data-href");
						o.removeAttribute("data-href");
						img.onload = function() {
							doLoadSingleImage($img, href, options);
						};
						img.src = href;
					}
				}
			}
		});
	}

	function resizeImage(img) {
		var w = parseInt(img.getAttribute("width" ), 10);
		var h = parseInt(img.getAttribute("height"), 10);
		if (!isNaN(w) && !!isNaN(h)) {
			img.originalCssHeight = img.style.height || "";
			var q = img.offsetWidth / w;
			img.style.height = Math.floor(h * q) + "px";
		}
	}

	function areAllImagesLoaded($images) {
		var loaded = true;
		$images.each(function() {
			if (!$(this).hasClass("loaded")) {
				loaded = false;
				return false; // break each()
			}
		});
		return loaded;
	}

	$.fn.asynchImageLoader = $.fn.jail = function(options) {
		var cfg = $.extend({}, options || {}, { images: this });
		this.data("jailOptions", cfg);
		if (cfg.resizeImages !== false) {
			this.each(function() { resizeImage(this); });
		}
		if (!cfg.event) {
			doLoadImages();
		}
		return this;
	};

	$window.bind("scroll resize load orientationchange", function(e) { doLoadImages(e.type); });

	$(function() {
		setTimeout(function() { doLoadImages(); }, 1000);
	});

}(jQuery));
(function($, undefined) {
	'use strict';

	$.fn.wpvAnimateNumber = function(options) {
		var defaultOptions = {
			from: 0,
			to: 0,
			animate: 1000,
			easing: function (x, t, b, c, d) {
				t = t / (d/2);
				if (t < 1) {
					return c / 2 * t * t + b;
				}
				return -c/2 * ((--t)*(t-2) - 1) + b;
			},
			onStep: $.noop,
			el: null
		};

		options = $.extend(defaultOptions, options);

		if (typeof(options.easing) === 'string' && typeof(jQuery) !== 'undefined' && jQuery.isFunction(jQuery.easing[options.easing])) {
			options.easing = jQuery.easing[options.easing];
		} else {
			options.easing = defaultOptions.easing;
		}

		var reqAnimationFrame = (function() {
			return  window.requestAnimationFrame ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame ||
					function(callback) {
						window.setTimeout(callback, 1000 / 60);
					};
		}());

		$(this).each(function() {
			options.to = $(this).data('number') || options.to;
			var init = function() {
				var startTime = Date.now();
				var animation = function() {
					var process = Math.min(Date.now() - startTime, options.animate);
					var currentValue = options.easing(this, process, options.from, options.to - options.from, options.animate);
					options.onStep.call(this, options.from, options.to, currentValue);
					if (process < options.animate) {
						reqAnimationFrame(animation);
					}
				}.bind(this);

				reqAnimationFrame(animation);
			}.bind(this);

			init();
		});
	};
})(jQuery);

(function($, undefined) {
	'use strict';

	$(function() {
		$('.wpv-countdown').each(function() {
			var days = $('.wpvc-days .value', this);
			var hours = $('.wpvc-hours .value', this);
			var minutes = $('.wpvc-minutes .value', this);
			var seconds = $('.wpvc-seconds .value', this);

			var until = parseInt($(this).data('until'), 10);
			var done = $(this).data('done');

			var self = $(this);

			var updateTime = function() {
				var now = Math.round( (+new Date()) / 1000 );

				if(until <= now) {
					clearInterval(interval);
					self.html($('<span />').addClass('wpvc-done wpvc-block').html($('<span />').addClass('value').text(done)));
					return;
				}

				var left = until-now;

				seconds.text(left%60);

				left = Math.floor(left/60);
				minutes.text(left%60);

				left = Math.floor(left/60);
				hours.text(left%24);

				left = Math.floor(left/24);
				days.text(left);
			};

			var interval = setInterval(updateTime, 1000);
		});
	});
})(jQuery);
(function($, undefined) {
	"use strict";

	$(function() {
		$('.wpv-progress.pie').one('wpv-progress-visible', function() {
			$(this).addClass('started').easyPieChart({
				animate: 1000,
				scaleLength: 0,
				lineWidth: 11,
				size: 130,
				lineCap: 'square',
				onStep: function(from, to, value) {
					$(this.el).find('span:first').text(~~value);
				}
			});
		});

		$('.wpv-progress.number').each(function() {
			$(this).one('wpv-progress-visible', function() {
				$(this).addClass('started').wpvAnimateNumber({
					onStep: function(from, to, value) {
						$(this).find('span:first').text(~~value);
					}
				});
			});
		});

		var win = $(window),
			win_factor = 0.6,
			win_height = 0;

		var mobileSafari = navigator.userAgent.match(/(iPod|iPhone|iPad)/) && navigator.userAgent.match(/AppleWebKit/);

		setTimeout(function() {
			$(window).scroll(function() {
				win_height = win.height();

				var all_visible = $(window).scrollTop() + win_height * win_factor;

				$('.wpv-progress:not(.started)').each(function() {
					if( all_visible > $(this).offset().top || mobileSafari ) {
						$(this).trigger('wpv-progress-visible');
					}
				});
			}).scroll();
		}, 300);
	});

})(jQuery);
(function($, undefined) {
	"use strict";

	var J_WIN     = $(window);
	var J_HTML    = $("html");
	var IS_RESPONSIVE = $("body").hasClass("responsive-layout");

	// Namespace
	jQuery.WPV = jQuery.WPV || {};

	jQuery.WPV.MEDIA = jQuery.WPV.MEDIA || {
		layout: {}
	};

	var LAYOUT_SIZES = [
		{ min: 0   , max: 479     , className : "layout-smallest"},
		{ min: 480 , max: 958     , className : "layout-small"   },
		{ min: 959, max: Infinity, className : "layout-max"     },
		{ min: 959, max: 1280    , className : "layout-max-low"   },

		{ min: 0   , max: 958     , className : "layout-below-max"   }
	];

	if (IS_RESPONSIVE && 'matchMedia' in window) {
		var lastClass, sizesLength = LAYOUT_SIZES.length, i;

		J_WIN.bind('resize.sizeClass load.sizeClass', function () {

			var toAdd = [],
				toDel = [],
				map   = {};

			for (i = 0; i < sizesLength; i++) {
				var mq = '(min-width: '+LAYOUT_SIZES[i].min+'px)';
				if(LAYOUT_SIZES[i].max !== Infinity)
					mq += ' and (max-width: '+LAYOUT_SIZES[i].max+'px)';

				if (window.matchMedia(mq).matches) {
					toAdd.push(LAYOUT_SIZES[i].className);
					map[LAYOUT_SIZES[i].className] = true;
				}
				else {
					toDel.push(LAYOUT_SIZES[i].className);
					map[LAYOUT_SIZES[i].className] = false;
				}
			}

			jQuery.WPV.MEDIA.layout = map;

			toAdd = toAdd.join(" ");
			toDel = toDel.join(" ");
			if (lastClass !== toAdd) {
				lastClass = toAdd;

				// J_HTML.removeClass(toDel).addClass(toAdd);
				J_WIN.trigger("switchlayout");
			}
		});
	} else {
		J_HTML.removeClass("layout-smallest layout-small layout-medium layout-below-max") .addClass("layout-max");
		$.WPV.MEDIA.layout = { "layout-max" : true };
	}

	var delayedResizeTimeout;
	function delayedResizeHandler() {
		if (delayedResizeTimeout) {
			window.clearTimeout(delayedResizeTimeout);
		}
		delayedResizeTimeout = setTimeout(function() {
			J_WIN.trigger("delayedResize");
		}, 150);

	}
	J_WIN.bind('resize',  delayedResizeHandler);

	$.WPV.MEDIA.is_mobile = function() {
		var check = false;
		(function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true;})(navigator.userAgent||navigator.vendor||window.opera);
		return check;
	};
})(jQuery);
;(function($,undefined) {
	"use strict";

	$(function() {
		// lazy load images
		// The JAIL plugin is written in such a way that makes an error if it's 
		// applied in empty collection!
		var commonImages = $('img.lazy').not(".portfolios.sortable img, .portfolios.isotope img, .portfolios.scroll-x img, :animated, .wpv-wrapper img");
		if (commonImages.length) {
			commonImages.addClass("jail-started").jail({
				speed: 800
			});
		}

		var sliderImages = $('.wpv-wrapper img.lazy');
		if (sliderImages.length) {
			sliderImages.addClass("jail-started").jail({
				speed: 1400,
				event: 'load'
			});
		}
	});
})(jQuery);
(function($, undefined) {
	"use strict";

	$(function() {
		$('.wpv-overlay-search-trigger').click(function(e) {
			e.preventDefault();

			$.magnificPopup.open({
				type: 'inline',
				items: {
					src: '#wpv-overlay-search',
				},
				closeOnBgClick: false,
				tClose: window.WPV_FRONT.magnific_close,
				tLoading: window.WPV_FRONT.magnific_loading,
				callbacks: {
					open: function() {
						var self = this;

						setTimeout( function() {
							self.content.find( 'form' ).removeAttr( 'novalidate' );
							self.content.find( '[name="s"]' ).focus();
						}, 100 );
					}
				}
			});
		});

		var lightboxTitle = function(item) {
			var share = '';

			if ($('body').hasClass('cbox-share-googleplus')) {
				share += '<div><div class="g-plusone" data-size="medium"></div> <script type="text/javascript">' +
					'(function() {' +
					'	var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;' +
					'	po.src = "https://apis.google.com/js/plusone.js";' +
					'	var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);' +
					'})();' +
					'</script></div>';
			}

			if ($('body').hasClass('cbox-share-facebook')) {
				share += '<div><iframe src="//www.facebook.com/plugins/like.php?href=' + window.location.href + '&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:auto; height:21px;" allowTransparency="true"></iframe></div>';
			}

			if ($('body').hasClass('cbox-share-twitter')) {
				share += '<div><iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/tweet_button.html" style="width:auto; height:20px;"></iframe></div>';
			}

			if ($('body').hasClass('cbox-share-pinterest')) {
				share += '<div><a href="http://pinterest.com/pin/create/button/" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>';
			}

			var title = (item.el && item.el.attr('title')) || '';

			return '<div id="lightbox-share">' + share + '</div><div id="lightbox-text-title">' + title + '</div>';
		};

		var lightboxGetType = function(el) {
			if (el.attr('data-iframe') === 'true')
				return 'iframe';
			if (el.attr('href').match(/^#/))
				return 'inline';

			return 'image';
		};

		// lightbox
		$.rawContentHandler(function() {
			var wc_lightbox = $('body').hasClass('woocommerce-page') ? ', div.product div.images a.zoom' : '';

			$(".vamtam-lightbox"+wc_lightbox, this)
				.not('.no-lightbox, .size-thumbnail, .cboxElement')
				.each(function() {

				var link = this;
				var $link = $(this);

				var galleryItems = $('[rel="'+$link.attr('rel')+'"]').filter('.vamtam-lightbox, a.zoom'),
					hasGallery = galleryItems.length;

				var items = [];

				var this_item = $.inArray( $link, galleryItems );

				if ( hasGallery ) {
					$( galleryItems ).each( function( i ) {
						if ( this === link ) {
							this_item = i;
						}

						items.push({
							src: $(this).attr('href'),
							type: lightboxGetType($(this))
						});
					} );
				} else {
					items.push({
						src: $link.attr('href'),
						type: lightboxGetType( $link )
					});

					this_item = 0;
				}

				console.log(items);

				$link.magnificPopup({
					items: items,
					midClick: true,
					preload: [1, 2],
					index: this_item,
					tClose: window.WPV_FRONT.magnific_close,
					tLoading: window.WPV_FRONT.magnific_loading,
					iframe: {
						patterns: {
							youtube: {
								id: function(url) {
									var matches = url.match(/youtu(?:\.be|be\.com)\/(?:.*v(?:\/|=)|(?:.*\/)?)([a-zA-Z0-9-_]+)/);
									if (matches[1]) return matches[1];

									return url;
								}
							},

							vimeo: {
								id: function(url) {
									var matches = url.match(/vimeo\.com\/(?:.*#|.*videos?\/)?([0-9]+)/);
									if (matches[1]) return matches[1];

									return url;
								}
							},

							dailymotion: {
								index: 'dailymotion.com',
								id: function(url) {
									var m = url.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/);

									if (m !== null) {
										if (m[4] !== undefined)
											return m[4];
										return m[2];
									}
									return null;
								}
							}
						}
					},
					image: {
						titleSrc: lightboxTitle
					},
					gallery: {
						enabled: hasGallery
					},
					callbacks: {
						open: function() {
							$(window).resize();
						}
					}
				});
			});
		});
	});
})(jQuery);
(function($, undefined) {
	"use strict";

	$(function() {
		var sortable = function(containerSel, innerSel) {
			if (!$.fn.isotope) return;

			var callback = function() {
				var container = $(this),
					container_width = container.width(),
					columns = $.WPV.reduce_column_count(parseInt(container.attr('data-columns'), 10));

				container.bind('reload-isotope', callback);

				var	column_width = Math.floor(container_width/columns),
					lis = container.find(innerSel),
					layout_type = container.hasClass('masonry') ? 'masonry' : 'fit_rows';

				if(container.hasClass('isotope') || (container.hasClass('loop-wrapper') && !container.hasClass('wpv-isotope-loaded')))
					lis.not('.isotope-item');

				lis.removeClass('clearboth');

				var options = {
					fit_rows: {
						resizable: false,
						layoutMode: 'fitRows'
					},
					masonry: {
						resizable: false,
						columnWidth: column_width
					}
				};

				container.addClass('wpv-notransition');

				lis.css({
					width: column_width
				});

				container.removeClass('wpv-notransition');

				container.imagesLoaded(function() {
					if ( container.hasClass( 'wpv-isotope-loaded' ) ) {
						container.isotope('appended', lis.not('.isotope-item'));
					} else {
						container.addClass('wpv-isotope-loaded');
					}

					lis.addClass('isotope-item');

					container.isotope(options[layout_type]);

					if( ! container.hasClass('loop-wrapper')) {
						var p = container.parent();
						if(!p.data('wpv-isotope-loaded') && !container.hasClass('no-isotope-fadein')) {
							p.data('wpv-isotope-loaded', true);
							p.css({
								height: 'auto',
								overflow: 'visible'
							});
						}
					}
				});
			};

			$(containerSel).each(callback);
		};

		var initPortfolio = function() {
			sortable('.portfolios.isotope > ul', '>li');

			$( '.page-content, .page-content > .row:first-child > .wpv-grid:first-child' ).find( ' > .portfolios.isotope:first-child > .sort_by_cat' ).appendTo( $( '.page-header-content' ) ).removeClass( 'grid-1-1' );

			$('.sort_by_cat').show();
		};

		$.rawContentHandler(function() {
			initPortfolio();

			$('.sort_by_cat[data-for] a').click(function(e) {
				var filter = $(this).attr('data-value'),
					list = $($(this).closest('.sort_by_cat').data('for')).find('> ul');

				$(this).parent().siblings().find('.active').removeClass('active');
				$(this).addClass('active');

				list.trigger("portfolioSortStart", [filter]);

				list.isotope({
					filter: (filter === 'all' ? '*' : '[data-type~="' + filter + '"]')
				}, function() {
					list.trigger("portfolioSortComplete", [filter]);
				});

				e.preventDefault();
			}).each(function() {
				var filter = $(this).attr('data-value'),
					isotope = $($(this).closest('.sort_by_cat').data('for')).find('> ul');

				if (filter !== 'all' && isotope.children().filter('[data-type~="' + filter + '"]').length === 0) $(this).parent().hide();
			});
		});

		if ($.fn.isotope) $(window).smartresize(initPortfolio);

		var initNews = function() {
			$('.loop-wrapper.news:not(.scroll-x):not(.masonry)').each(function() {
				var columns = $.WPV.reduce_column_count(parseInt($(this).attr('data-columns'), 10));

				$('> .page-content', this).removeClass('clearboth').filter(':nth-child('+columns+'n+1)').addClass('clearboth');
			});

			sortable('.loop-wrapper.news.masonry', '>.page-content');
		};

		$(window).smartresize(initNews);
		initNews();
	});

})(jQuery);
(function($, undefined) {
	"use strict";

	$(function() {

		$.rawContentHandler(function() {
			if ( 'tabs' in $.fn ) {
				$('.wpv-tabs', this).each(function() {
					$(this).tabs({
						activate: function(event, ui) {
							var hash = ui.newTab.context.hash;
							var element = $(hash);
							element.attr('id', '');
							window.location.hash = hash;
							element.attr('id', hash.replace('#', ''));
						},
						heightStyle: 'content'
					});
				});
			}

			if ( 'accordion' in $.fn ) {
				$('.wpv-accordion', this).accordion({
					heightStyle: 'content'
				}).each(function() {
					if ($(this).attr('data-collapsible') === 'true') $(this).accordion('option', 'collapsible', true).accordion('option', 'active', false);
				});
			}
		});

	});

})(jQuery);

(function() {
	"use strict";

	var iOS = navigator.userAgent.match(/(iPad|iPhone|iPod)/g);
	if(!iOS) return;

	window.document.addEventListener('orientationchange', function() {
		var viewportmeta = document.querySelector('meta[name="viewport"]');
		if (viewportmeta) {
			if (viewportmeta.content.match(/width=device-width/)) {
				viewportmeta.content = viewportmeta.content.replace(/width=[^,]+/, 'width=1');
			}
			viewportmeta.content = viewportmeta.content.replace(/width=[^,]+/, 'width=' + window.innerWidth);
		}
	}, false);
})();
(function($, undefined) {
	"use strict";

	$(function() {
		if ( Modernizr.touch || true ) {
			var currently_active;

			$( '.fixed-header-box .menu-item-has-children > a' ).bind( 'touchend', function( e ) {
				this.had_touchend = e.timeStamp;
			} ).bind( 'click', function( e ) {
				if ( e.timeStamp - ( this.had_touchend || 0 ) > 1000 ) {
					return true;
				}

				if ( currently_active !== this ) {
					e.preventDefault();
					currently_active = this;
				}

				e.stopPropagation();
			} );

			$( window ).bind( 'click.sub-menu-double-tap', function() {
				currently_active = undefined;
			} );
		}

		$('#main-menu .menu-item > .sub-menu').each(function() {
			$(this).wrap('<div class="sub-menu-wrapper"></div>');
		});

		var mainHeader = $('header.main-header'),
			win = $(window),
			doc = $(document);

		var explorer = /MSIE (\d+)/.exec(navigator.userAgent);
		var hasStickyHeader = function() {
			return $('body').hasClass('sticky-header') &&
				!(explorer && parseInt(explorer[1], 10) === 8) &&
				!$.WPV.MEDIA.is_mobile() &&
				!$.WPV.MEDIA.layout["layout-below-max"];
		};

		var currentAnimation;

		var scrollToEl = function(el) {
			if(el.length > 0 && !currentAnimation) {
				currentAnimation = el;

				var firstAnimation = true,
					animationStart = +new Date();

				var getScrollPosition = function() {
					var header = mainHeader.offset().top + mainHeader.height() - $(window).scrollTop();
					var adminbar = ($('#wpadminbar') ? $('#wpadminbar').height() : 0);

					return ~~(el.offset().top - (hasStickyHeader() ? header : adminbar));
				};

				var advance = function(q) {
					return ~~((getScrollPosition() - win.scrollTop())*q);
				};

				var goToEl = function(done) {
					var move = advance(0.9),
						now = +new Date();

					if( done || Math.abs(move) <= 100 ) {
						if(now - animationStart > 300) {
							currentAnimation = void 0;
							$('html,body').stop().animate({
								scrollTop: getScrollPosition()
							}, 50, 'linear', function() {
								$.WPV.blockStickyHeaderAnimation = false;
							});
						} else {
							waitForFinish();
						}

						return;
					} else {
						$('html,body').stop().animate({
							scrollTop: "+="+move
						}, Math.abs(move)/4, 'linear', function() {
							if(!firstAnimation) {
								$.WPV.blockStickyHeaderAnimation = true;
							}

							firstAnimation = false;
							if(getScrollPosition() - win.scrollTop() > 50 && win.scrollTop() + win.height() < doc.height()) {
								goToEl();
							} else if(!done) {
								goToEl(true);
							}
						});
					}
				};

				var waitForFinish = function() {
					var now = +new Date();
					var timeLeft = now - animationStart;

					$('html,body').stop().animate({
						scrollTop: getScrollPosition()
					}, timeLeft/2, 'linear', function() {
						$('html,body').stop().animate({
							scrollTop: getScrollPosition()
						}, timeLeft/2, 'linear', function() {
							$('html,body').stop().animate({
								scrollTop: getScrollPosition()
							}, 50, 'linear', function() {
								currentAnimation = void 0;
								$.WPV.blockStickyHeaderAnimation = false;
							});
						});
					});
				};

				goToEl();
			}
		};

		$(document.body).on('click', '.wpv-animated-page-scroll[href], .wpv-animated-page-scroll [href], .wpv-animated-page-scroll [data-href]', function(e) {
			var href = $( this ).prop( 'href' ) || $( this ).data( 'href' );
			var el   = $( '#' + ( href ).split( "#" )[1] );

			var l  = document.createElement('a');
			l.href = href;

			if(el.length && l.pathname === window.location.pathname) {
				scrollToEl(el);
				e.preventDefault();
			}
		});

		if ( window.location.hash !== "" &&
			(
				$( '.wpv-animated-page-scroll[href*="' + window.location.hash + '"]' ).length ||
				$( '.wpv-animated-page-scroll [href*="' + window.location.hash + '"]' ).length ||
				$( '.wpv-animated-page-scroll [data-href*="'+window.location.hash+'"]' ).length ||
				$( '.wpv-tabs [href*="' + window.location.hash + '"]').length
			)
		) {
			var el = $( window.location.hash );

			if ( $( '.wpv-tabs [href*="' + window.location.hash + '"]').length ) {
				el = el.closest( '.wpv-tabs' );
			}

			if ( el.length > 0 ) {
				$( 'html,body' ).animate( {
					scrollTop: $( 'html' ).scrollTop() + 1
				}, 0 );
			}

			setTimeout( function() {
				scrollToEl( el );
			}, 400 );
		}

		// adds .current-menu-item classes

		var hashes = [
			// ['top', $('<div></div>'), $('#top')]
		];

		$('#main-menu').find('.menu').find('.maybe-current-menu-item, .current-menu-item').each(function() {
			var link = $('> a', this);

			if(link.prop('href').indexOf('#') > -1) {
				var link_hash = link.prop('href').split('#')[1];

				if('#'+link_hash !== window.location.hash) {
					$(this).removeClass('current-menu-item');
				}

				hashes.push([link_hash, $(this), $('#'+link_hash)]);
			}
		});

		if(hashes.length > 1) {
			var winHeight = 0;
			var documentHeight = 0;

			var prev_upmost_data = null;

			win.scroll(function() {
				winHeight = win.height();
				documentHeight = $(document).height();

				var cpos = win.scrollTop();
				var upmost = Infinity;
				var upmost_data = null;

				for(var i=0; i<hashes.length; i++) {
					var el = hashes[i][2];

					if(el.length) {
						var top = el.offset().top + 10;

						if( top > cpos && top < upmost && ( top < cpos + winHeight/2 || ( top < cpos + winHeight && cpos + winHeight === documentHeight) ) ) {
							upmost_data = hashes[i];
							upmost = top;
						}

						hashes[i][1].removeClass('current-menu-item');
					}
				}

				if(upmost_data && (upmost_data[0] !== 'top' || prev_upmost_data)) {
					upmost_data[1].addClass('current-menu-item');

					if('history' in window && (prev_upmost_data !== null ? prev_upmost_data[0] : '') !== upmost_data[0]) {
						window.history.pushState(upmost_data[0], $('> a', upmost_data[1]).text(), (cpos !== 0 ? '#'+upmost_data[0] : location.href.replace(location.hash, '')));
						prev_upmost_data = $.extend({}, upmost_data);
					}
				} else if( upmost_data === null && prev_upmost_data !== null) {
					prev_upmost_data[1].addClass('current-menu-item');
				}
			});
		}
	});
})(jQuery);
(function($, undefined) {
	"use strict";

	$(function() {
		var win = $(window),
			win_width,
			body = $('body'),
			hbox = $('.fixed-header-box'),
			hbox_filler,
			header = $('header.main-header'),
			single_row_header = header.hasClass('layout-logo-menu'),
			type_over = body.hasClass('sticky-header-type-over'),
			middle = $('.header-middle'),
			middle_filler,
			main_content = $('#main-content'),
			second_row = hbox.find('.second-row'),
			admin_bar_fix = body.hasClass('admin-bar') ? 32 : 0,
			logo_wrapper = hbox.find('.logo-wrapper'),
			logo_wrapper_height = 0,
			top_nav = $('.top-nav'),
			top_nav_height = 0,
			explorer = /MSIE (\d+)/.exec(navigator.userAgent),
			loaded = false,
			interval,
			small_logo_height = 46,
			tween = $('.wpv-grid.has-video-bg').length ? 'animate' : 'transition',
			tween_easing = tween === 'transition' ? 'ease' : 'linear';

		var ok_to_load = function() {
			return ( body.hasClass( 'sticky-header' ) || body.hasClass( 'had-sticky-header' ) ) &&
				! ( explorer && parseInt( explorer[1], 10 ) === 8 ) &&
				! $.WPV.MEDIA.is_mobile() &&
				! $.WPV.MEDIA.layout["layout-below-max"] &&
				hbox.length && second_row.length;
		};

		var ok_to_load_middle = function() {
			return $('#header-slider-container').length && $('.wpv-grid.parallax-bg').length === 0;
		};

		var init = function() {
			if ( ! ok_to_load() ) {
				if ( body.hasClass( 'sticky-header' ) ) {
					body.removeClass( 'sticky-header' ).addClass( 'had-sticky-header' );
				}
				return;
			}

			win_width = win.width();

			hbox_filler = hbox.clone().html('').css({
				'z-index': 0,
				visibility: 'hidden',
				height: single_row_header && type_over ? top_nav.outerHeight() : hbox.outerHeight()
			}).insertAfter(hbox);

			hbox.css({
				position: 'fixed',
				top: hbox.offset().top,
				left: hbox.offset().left,
				width: hbox.outerWidth(),
				'-webkit-transform': 'translateZ(0)'
			});

			if(ok_to_load_middle()) {
				middle_filler = middle.clone().html('').css({
					'z-index': 0,
					visibility: 'hidden',
					height: middle.outerHeight()
				}).insertAfter(middle);

				middle.css({
					position: 'fixed',
					top: middle.offset().top,
					left: middle.offset().left,
					width: middle.outerWidth(),
					'z-index': 0
				});
			} else {
				middle_filler = null;
			}

			logo_wrapper_height = logo_wrapper.removeClass('scrolled').outerHeight();
			top_nav_height = top_nav.show().outerHeight();
			logo_wrapper.addClass('loaded');

			interval = setInterval(reposition, 41);

			loaded = true;

			win.scroll();
		};

		var destroy = function() {
			if(hbox_filler)
				hbox_filler.remove();

			hbox.removeClass('static-absolute fixed').css({
				position: '',
				top: '',
				left: '',
				width: '',
				'-webkit-transform': ''
			});

			if(middle_filler) {
				middle_filler.remove();

				middle.css({
					position: '',
					top: '',
					left: '',
					width: '',
					'z-index': 0
				});
			}

			logo_wrapper.removeClass('scrolled loaded');

			clearInterval(interval);

			loaded = false;
		};

		var chrome_video_bg_bug = $('.wpv-grid.has-video-bg').length > 0 &&  $('.wpv-grid.parallax-bg').length > 0,
			prev_cpos = -1,
			scrolling_down = true,
			scrolling_up = false,
			start_scrolling_up;

		var reposition = function() {
			if(!loaded)
				return;

			var cpos = win.scrollTop();

			body.toggleClass('wpv-scrolled', cpos > 0).toggleClass('wpv-not-scrolled', cpos === 0);

			if(single_row_header) {
				var delta = type_over ? top_nav_height : logo_wrapper_height - small_logo_height + top_nav_height;
				var trigger = chrome_video_bg_bug ? delta*1.5 : 0;

				if(!('blockStickyHeaderAnimation' in $.WPV) || !$.WPV.blockStickyHeaderAnimation) {
					scrolling_down = prev_cpos < cpos;
					scrolling_up = prev_cpos > cpos;

					if(scrolling_up && start_scrolling_up === undefined) {
						start_scrolling_up = cpos;
					} else if(scrolling_down) {
						start_scrolling_up = undefined;
					}

					prev_cpos = cpos;
				}

				if(!body.hasClass('no-sticky-header-animation') && !body.hasClass('no-sticky-header-animation-tmp')) {
					if( cpos > trigger && scrolling_down ) {
						if(!(logo_wrapper.hasClass('scrolled'))) {
							logo_wrapper.addClass('scrolled');
							top_nav.slideUp(300);

							body.addClass('no-sticky-header-animation-tmp');
							setTimeout(function() {
								body.removeClass('no-sticky-header-animation-tmp');
							}, 350);

							if(!chrome_video_bg_bug) {
								hbox_filler[tween]({
									height: '-='+delta+'px'
								}, 300, tween_easing);

								if(middle_filler && middle_filler.length) {
									middle[tween]({
										top: '-='+delta+'px'
									}, 300, tween_easing);
								}
							}
						}
					} else if(logo_wrapper.hasClass('scrolled') && scrolling_up && (start_scrolling_up - cpos > 60 || start_scrolling_up < 120) ) {
						logo_wrapper.removeClass('scrolled');
						top_nav.slideDown(300);

						body.addClass('no-sticky-header-animation-tmp');
						setTimeout(function() {
							body.removeClass('no-sticky-header-animation-tmp');
						}, 350);

						if(!chrome_video_bg_bug) {
							hbox_filler[tween]({
								height: '+='+delta+'px'
							}, 300, tween_easing);

							if(middle_filler && middle_filler.length) {
								middle[tween]({
									top: '+='+delta+'px'
								}, 300, tween_easing);
							}
						}
					}
				}
			} else {
				var hbox_height = hbox.outerHeight(),
					second_row_height = second_row.height(),
					mcpos = main_content.offset().top - admin_bar_fix;

				if(mcpos <= cpos + hbox_height) {
					if( cpos + second_row_height <= mcpos) {
						hbox.css({
							position: 'absolute',
							top: mcpos - hbox_height,
							left: 0
						}).addClass('static-absolute').removeClass('fixed second-stage-active');
					} else {
						hbox.css({
							position: 'fixed',
							top: admin_bar_fix + second_row_height - hbox_height,
							left: hbox_filler.offset().left,
							width: hbox.outerWidth()
						}).addClass('second-stage-active');
					}
				} else {
					hbox.removeClass('static-absolute second-stage-active').css({
						position: 'fixed',
						top: hbox_filler.offset().top,
						left: hbox_filler.offset().left,
						width: hbox_filler.outerWidth()
					});
				}
			}

			if(!hbox.hasClass('fixed') && !hbox.hasClass('static-absolute') && !hbox.hasClass('second-stage-active')) {
				hbox.css({
					position: 'fixed',
					top: hbox_filler.offset().top,
					left: hbox_filler.offset().left,
					width: hbox.outerWidth()
				}).addClass('fixed');
			}
		};

		win.bind('scroll touchmove', reposition).smartresize(function() {
			if(win.width() !== win_width) {
				destroy();
				init();
			}
		});

		init();
	});
})(jQuery);
( function( $, undefined ) {
	'use strict';

	var win = $( window ),
		win_height = 0;

	var explorer = /MSIE (\d+)/.exec( navigator.userAgent ),
		mobileSafari = navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) && navigator.userAgent.match( /AppleWebKit/ );

	win.resize(function() {
		win_height = win.height();

		if (
			( explorer && parseInt( explorer[1], 10 ) === 8 ) ||
			mobileSafari ||
			$.WPV.MEDIA.layout['layout-below-max']
		) {
			$( '.wpv-grid.animated-active' ).removeClass( 'animated-active' ).addClass( 'animated-suspended' );
		} else {
			$( '.wpv-grid.animated-suspended' ).removeClass( 'animated-suspended' ).addClass( 'animated-active' );
		}
	}).resize();

	win.bind( 'scroll touchmove load', function() {
		var win_height = win.height();
		var all_in = $(window).scrollTop() + win_height;

		$( '.wpv-grid.animated-active:not(.animation-ended)' ).each( function() {
			var el = $( this );
			var el_height = el.outerHeight();
			var visible   = all_in > el.offset().top + el_height * ( el_height > 100 ? 0.3 : 0.6 );

			if ( visible || mobileSafari ) {
				el.addClass( 'animation-ended' );
			} else {
				return false;
			}
		} );
	} ).scroll();
} )( jQuery );
(function($, undefined) {
	"use strict";

	var win = $(window),
		win_height = win.height();

	var explorer = /MSIE (\d+)/.exec(navigator.userAgent);

	win.bind('resize', function() {
		win_height = win.height();

		if(
			!Modernizr.csscalc ||
			(explorer && parseInt(explorer[1], 10) === 8) ||
			$.WPV.MEDIA.is_mobile() ||
			$.WPV.MEDIA.layout["layout-below-max"]
		) {
			$('.wpv-grid.parallax-bg').removeClass('parallax-bg').addClass('parallax-bg-suspended');
			$('.wpv-parallax-bg-img').css({
				'background-position': '50% 50%'
			});
		} else {
			$('.wpv-grid.parallax-bg-suspended').removeClass('parallax-bg-suspended').addClass('parallax-bg');
			win.scroll();
		}
	});

	var new_pos = function(method, x, top, cpos, inertia, height) {
		var vert = '';

		switch(method) {
			case 'fixed':
				vert = Math.round( (cpos - top) * inertia)  + "px";
			break;

			case 'to-centre':
				vert = 'calc(50% - '+ Math.round( (top + height/2 - cpos - win_height/2)*inertia ) + 'px)';
			break;
		}

		return x + ' ' +  vert;
	};

	win.bind('scroll touchmove load', _.throttle(function() {
		var cpos = win.scrollTop(),
			all_visible = cpos + win_height;

		$('.wpv-grid.parallax-bg').each(function() {
			var top = $(this).offset().top,
				height = $(this).outerHeight();

			if(top + height < cpos || top > all_visible)
				return;

			var fakebg = $('.wpv-parallax-bg-img', this);

			if(!fakebg.length) return;

			var method = $(this).data('parallax-method'),
				inertia = $(this).data('parallax-inertia'),
				bgpos = new_pos(method, '50%', top, cpos, inertia, height),
				css = {'background-position': bgpos};

			fakebg.css(css);
		});
	}, 41));

	var bgprops = 'position image color size attachment repeat'.split(' ');

	$(function() {
		$('.wpv-grid.parallax-bg:not(.parallax-loaded)').each(function() {
			var self = $(this);

			var local_bgprops = {};
			$.each(bgprops, function(i, p) {
				local_bgprops['background-'+p] = self.css('background-'+p);
			});

			self.addClass('parallax-loaded').wrapInner(function() {
				return $('<div></div>').addClass('wpv-parallax-bg-content');
			}).prepend(function() {
				var div = $('<div></div>')
					.addClass('wpv-parallax-bg-img')
					.css(local_bgprops);

				return div;
			}).css('background', '');
		});

		win.scroll();
	});
})(jQuery);
/* jshint multistr:true */
(function() {
	"use strict";

	jQuery.WPV = jQuery.WPV || {}; // Namespace

	(function ($, undefined) {
		var J_WIN = $(window);
		var body  = $('body');

		$(function () {
			if(top !== window && /vamtam\.com/.test(document.location.href)) {
				var width = 0;

				setInterval(function() {
					if($(window).width() !== width) {
						$(window).resize();
						setTimeout(function() { $(window).resize(); }, 100);
						setTimeout(function() { $(window).resize(); }, 200);
						setTimeout(function() { $(window).resize(); }, 300);
						setTimeout(function() { $(window).resize(); }, 500);
						width = $(window).width();
					}
				}, 200);
			}

			if ($("body").is(".responsive-layout")) {
				J_WIN.triggerHandler('resize.sizeClass');
			}

			body.bind('wpv-content-resized', function() {
				setTimeout(function() {
					body.trigger('wpv-hide-splash-screen');
				}, 1000);

				body.imagesLoaded(function() {
					body.trigger('wpv-hide-splash-screen');
				});
			}).one('wpv-hide-splash-screen', function() {
				$('.wpv-splash-screen').fadeOut(500, function() {
					$(this).remove();
				});
			});

			if ( $.fn.chosen ) {
				$(".wpv-chosen-select").chosen({ width: '100%' });
			}

			if ( $.webshims ) {
				$.webshims.polyfill('forms forms-ext');
			}

			(function() {
				var box = $('.boxed-layout'),
					timer;

				$(window).scroll(function(e) {
					clearTimeout(timer);
					if (!box.hasClass('disable-hover') && e.target === document) {
						box.addClass('disable-hover');
					}

					timer = setTimeout(function() {
						box.removeClass('disable-hover');
					}, 500);
				});
			})();

			if($('html').is('.placeholder')) {
				$.rawContentHandler(function() {
					$('.label-to-placeholder label[for]').each(function() {
						$('#' + $(this).prop('for')).attr('placeholder', $(this).text());
						$(this).hide();
					});
				});
			}

			/** tribe **/
			if ( 'tribe_ev' in window ) {
				$( window.tribe_ev.events ).bind( 'tribe_ev_monthView_ajaxSuccess', function() {
					$( '.meta-header-inside .title' ).html( $( '.tribe-events-page-title' ).html() );
				} );
			}
			////////////

			setTimeout(function() {
				$('.tt_tabs').unbind('tabsbeforeactivate');
			}, 100);

			if ( navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) && navigator.userAgent.match( /AppleWebKit/ ) ) {
				var version = /Version\/(\d+)/.exec( navigator.userAgent );

				if ( version && parseInt( version[1], 10 ) <= 7 ) {
					$( 'html' ).addClass( 'bad-ios' );
				}
			}

			// Video resizing
			// =====================================================================
			J_WIN.bind('resize.video load.video', function() {
				$('.portfolio-image-wrapper,\
					.boxed-layout .media-inner,\
					.boxed-layout .loop-wrapper.news .thumbnail,\
					.boxed-layout .portfolio-image .thumbnail,\
					.boxed-layout .wpv-video-frame').find('iframe, object, embed, video').each(function() {
					var v = $(this);

					if(v.prop('width') === '0' && v.prop('height') === '0') {
						v.css({width: '100%'}).css({height: v.width()*9/16});
					} else {
						v.css({height: v.prop('height')*v.width()/v.prop('width')});
					}

					v.trigger('vamtam-video-resized');
				});

				setTimeout(function() {
					$('.mejs-time-rail').css('width', '-=1px');
				}, 100);
			}).triggerHandler("resize.video");

			if('mediaelementplayer' in $.fn) {
				$('.wpv-background-video').mediaelementplayer({
					videoWidth: '100%',
					videoHeight: '100%',
					loop: true,
					enableAutosize: true,
					features: []
				});
			}

			$('.wpv-grid.has-video-bg').addClass('video-bg-loaded');

			(function() {
				var body = $('body');
				var admin_bar_fix = body.hasClass('admin-bar') ? 32 : 0;

				J_WIN.smartresize(function() {
					$('body').trigger('wpv-content-resized');

					if( !(body.hasClass('boxed')) ) {
						var pos = ($('.wpv-grid.extended:first').outerWidth() - $(window).width())/2;
						$('.extended-column-inner > .wpv-video-bg,\
							.wpv-grid.extended.grid-1-1.parallax-bg > .wpv-parallax-bg-img,\
							.wpv-grid.extended.grid-1-1.parallax-bg-suspended > .wpv-parallax-bg-img').css({
							left: pos,
							right: pos
						});

						$('.extended-column-inner > .wpv-video-bg').each(function() {
							var mep = $('.mejs-mediaelement > *', this),
								meph = mep.height(),
								thish = $(this).height(),
								thisw = $(this).width();

							var newvw = (thish/meph)*thisw,
								adj = (newvw - thisw)/2;

							if(adj > 0) {
								$(this).css({
									left: "-="+adj,
									right: "-="+adj
								});
							}
						});
					}

					var wheight = J_WIN.height() - admin_bar_fix;

					$('.wpv-grid[data-padding-top]').each(function() {
						var col = $(this);

						col.css('padding-top', 0);
						col.css('padding-top', wheight - col.outerHeight() + parseInt(col.data('padding-top'), 10));
					});

					$('.wpv-grid[data-padding-bottom]:not([data-padding-top])').each(function() {
						var col = $(this);

						col.css('padding-bottom', 0);
						col.css('padding-bottom', wheight - col.outerHeight() + parseInt(col.data('padding-bottom'), 10));
					});

					$('.wpv-grid[data-padding-top][data-padding-bottom]').each(function() {
						var col = $(this);

						col.css('padding-top', 0);
						col.css('padding-bottom', 0);

						var new_padding = (wheight - col.outerHeight() + parseInt(col.data('padding-top'), 10))/2;

						col.css({
							'padding-top': new_padding,
							'padding-bottom': new_padding
						});
					});
				});
			})();

			// Animated buttons
			// =====================================================================
			$(document).on('mouseover focus click', '.animated.flash, .animated.wiggle', function() {
				$(this).removeClass('animated');
			});

			// Tooltip
			// =====================================================================
			var tooltip_animation = 250;
			$('.shortcode-tooltip').hover(function () {
				var tt = $(this).find('.tooltip').fadeIn(tooltip_animation).animate({
					bottom: 25
				}, tooltip_animation);
				tt.css({ marginLeft: -tt.width() / 2 });
			}, function () {
				$(this).find('.tooltip').animate({
					bottom: 35
				}, tooltip_animation).fadeOut(tooltip_animation);
			});

			$('.sitemap li:not(:has(.children))').addClass('single');

			// Scroll to top button
			// =====================================================================
			$(window).bind('resize scroll', function () {
				$('#scroll-to-top').toggleClass("visible", window.pageYOffset > 0);
			});
			$('#scroll-to-top, .wpv-scroll-to-top').click(function (e) {
				$('html,body').animate({
					scrollTop: 0
				}, 300);

				e.preventDefault();
			});

		});

		$('#feedback.slideout').click(function(e) {
			$(this).parent().toggleClass("expanded");
			e.preventDefault();
		});

		(function() {
			var elements = [];

			$( ".row:has(> div.has-background)" ).each( function( i, row_el ) {
				var row = $( row_el ),
					columns = row.find( '> div' );

				if ( columns.length > 1 ) {
					row.addClass( 'has-nomargin-column' );
					elements.push( columns );
				}
			});

			$( ".row:has(> div > .linkarea)" ).each( function( i, row_el ) {
				var row = $( row_el ),
					columns = row.find( '> div > .linkarea' );

				if ( columns.length > 1 ) {
					elements.push( columns );
				}
			});

			$( ".row:has(> div > .services.has-more)" ).each( function( i, row_el ) {
				var row = $( row_el ),
					columns = row.find( '> div > .services.has-more > .closed' );

				if ( columns.length > 1 ) {
					elements.push( columns );
				}
			});

			$( '#footer-sidebars .row' ).each( function() {
				elements.push( $(this).find('aside') );
			});

			J_WIN.resize( _.throttle( function() {
				var i;
				if ( $.WPV.MEDIA.layout['layout-below-max'] ) {
					for ( i = 0; i < elements.length; ++i ) {
						elements[i].matchHeight( 'remove' );
					}
				} else {
					for ( i = 0; i < elements.length; ++i ) {
						elements[i].matchHeight( false );
					}
				}
			}, 600 ) );
		})();

		// LINKAREA
		// =========================================================================
		$( document )
		.on("mouseenter", ".linkarea[data-hoverclass]", function() {
			$(this).addClass(this.getAttribute("data-hoverclass"));
		})
		.on("mouseleave", ".linkarea[data-hoverclass]", function() {
			$(this).removeClass(this.getAttribute("data-hoverclass"));
		})
		.on("mousedown", ".linkarea[data-activeclass]", function() {
			$(this).addClass(this.getAttribute("data-activeclass"));
		})
		.on("mouseup", ".linkarea[data-activeclass]", function() {
			$(this).removeClass(this.getAttribute("data-activeclass"));
		})
		.on("click", ".linkarea[data-href]", function(e) {
			if (e.isDefaultPrevented()) {
				return false;
			}

			var href = this.getAttribute("data-href");
			if (href) {
				e.preventDefault();
				e.stopImmediatePropagation();
				try {
					var target = String(this.getAttribute("data-target") || "self").replace(/^_/, "");
					if (target === "blank" || target === "new") {
						window.open(href);
					} else {
						window[target].location = href;
					}
				} catch (ex) {}
			}
		});

		J_WIN.triggerHandler('resize.sizeClass');

		$(window).bind("load", function() {
			setTimeout(function() {
				$(window).trigger("resize");
			}, 1);
		});

	})(jQuery);

})();
(function($, undefined) {
	'use strict';

	$(function() {
		var dropdown = $('.fixed-header-box .cart-dropdown'),
			link = $('.vamtam-cart-dropdown-link'),
			count = $('.products', link),
			widget = $('.widget', dropdown),
			isVisible = false;

		$('body').bind('added_to_cart wc_fragments_refreshed wc_fragments_loaded', function() {
			var count_val = parseInt( $.cookie( 'woocommerce_items_in_cart' ) || 0, 10 );

			if ( count_val > 0 ) {
				var count_real = 0;
				$( '.widget_shopping_cart:first li .quantity' ).each( function() {
					count_real += parseInt( $( this ).clone().children().remove().end().contents().text(), 10 );
				} );
				count.text( count_real );
				count.removeClass( 'cart-empty' );
				dropdown.removeClass( 'hidden' );
				$(this).addClass( 'header-cart-visible' );

			} else {
				count.addClass( 'cart-empty' );
				count.text( '0' );
				// dropdown.addClass('hidden');
				// $(this).removeClass('header-cart-visible');
			}

		});

		var open = 0;

		var showCart = function() {
			open = +new Date();
			dropdown.addClass('state-hover');
			widget.stop(true, true).fadeIn(300, function() {
				isVisible = true;
			});
		};

		var hideCart = function() {
			var elapsed = new Date() - open;

			if(elapsed > 1000) {
				dropdown.removeClass('state-hover');
				widget.stop(true, true).fadeOut(300, function() {
					isVisible = false;
				});
			} else {
				setTimeout(function() {
					if(!dropdown.is(':hover')) {
						hideCart();
					}
				}, 1000 - elapsed);
			}
		};

		dropdown.bind('mouseenter', function() {
			showCart();
		}).bind('mouseleave', function() {
			hideCart();
		});

		link.not('.no-dropdown').bind('click', function(e) {
			if(isVisible) {
				hideCart();
			} else {
				showCart();
			}

			e.preventDefault();
		});
	});
})(jQuery);
(function($, undefined) {
	"use strict";

	var show = function() {
		var self = $(this);

		if(self.closest('.animated-active:not(.animation-ended)').length > 0)
			return;

		if(self.data('closed-at') && (+new Date()) - self.data('closed-at') < 300)
			return;

		var	c = self.clone();

		setTimeout(function() {
			var parent_width = $.WPV.MEDIA.layout["layout-below-max"] ? self.width() : self.parent().width();

			c.css({
				width: parent_width,
				position: 'absolute',
				left: self.parent().position().left + parseFloat(self.parent().css('padding-left'), 10),
				top: self.parent().position().top,
				zIndex: 10000000000
			})
			.addClass('transitionable');

			if(!self.attr('id'))
				self.attr('id', 'hover-id-'+Math.round(Math.random()*100000000));

			if(!c.attr('id'))
				c.attr('id', 'hover-clone-id-'+Math.round(Math.random()*100000000));

			if($('#'+self.attr('id')+':hover').length === 0) return;

			self.css({visibility: 'hidden'});

			c.appendTo(self.closest('.row')).addClass('state-hover');

			c.find('.shrinking .icon').transit({
				'font-size': Math.min(100, parent_width - 15)
			}, 200, 'easeOutQuad');

			var content = c.find('.services-content').slideDown({
				duration: 200,
				easing: 'easeOutQuad'
			});

			var interval = setInterval(function() {
				if(!Modernizr.touch && $('#'+c.attr('id')+':hover').length === 0) {
					clearInterval(interval);
					c.trigger('mouseleave');
				}
			}, 500);

			var close = function() {
				if(!$(this).hasClass('state-hover')) return;

				c.removeClass('state-hover');

				c.find('.shrinking .icon').transit({
					'font-size': 60
				}, 500, 'easeOutQuad');

				content.slideUp({
					duration: 500,
					easing: 'easeOutQuad',
					complete: function() {
						c.remove();
						self.css({visibility: 'visible'}).data('closed-at', (+new Date()));
					}
				});
			};

			if ( ! Modernizr.touch ) {
				c.unbind('mouseleave.shrinking').bind('mouseleave.shrinking', close);
			}
		}, 20);
	};

	$.rawContentHandler(function() {
		var s = $('.services:has(.shrinking)');

		if ( ! Modernizr.touch ) {
			s.unbind('mouseenter.shrinking').bind('mouseenter.shrinking', show);
		}
	});

	var resize = function() {
		$('.services:not(.transitionable) .shrinking').each(function() {
			var _w = $(this).width();
				$(this).height(_w);
				$(this).find('.icon').css({'line-height': _w+'px'});

				$(this).closest('.services').prev().css({width: _w});
			});
	};

	$(window).bind('resize', resize);
	resize();

})(jQuery);
(function($, undefined) {
	"use strict";

	var use3d = Modernizr.csstransforms3d;
	var tween = use3d ? 'transition' : 'animate';

	var logError = function( message ) {
		if ( 'console' in window ) {
			console.error( message );
		}
	};

	jQuery.easing.wpvsin = function(p, n, firstNum, diff) {
		return Math.sin(p * Math.PI / 2) * diff + firstNum;
	};

	jQuery.easing.wpvcos = function(p, n, firstNum, diff) {
		return firstNum + diff - Math.cos(p * Math.PI / 2) * diff;
	};

	$.WPV.expandable = function(el, options) {
		el = $(el);

		var self = this,
			open = el.find('>.open'),
			closed = el.find('>.closed');

		self.doOpen = function() {
			var duration = $.WPV.MEDIA.layout['layout-below-max'] ? Math.max(options.duration, 400) : options.duration,
				oheight = open.outerHeight();

			if(!oheight) {
				open.css({height: 'auto'});
				oheight = open.outerHeight();
				open.css({height: 0});
			}

			duration = Math.max(duration, oheight/200*duration);

			closed.queue(closed.queue().slice(0,1));
			open.queue(open.queue().slice(0,1));

			el.addClass('state-hover');

			closed[tween]({
				y: -oheight
			}, duration, options.easing, function() {
				el.removeClass('state-closed').addClass('state-open');
			});

			if(use3d) {
				open.transition({
					y: -oheight,
					perspective: options.perspective,
					rotateX: 0
				}, duration, options.easing);
			} else {
				open.animate({
					y: -oheight,
					height: oheight
				}, duration, options.easing);
			}
		};

		self.doClose = function() {
			var duration = $.WPV.MEDIA.layout['layout-below-max'] ? Math.max(options.duration, 400) : options.duration,
				oheight = open.outerHeight();

			if(!oheight) {
				open.css({height: 'auto'});
				oheight = open.outerHeight();
				open.css({height: 0});
			}

			duration = Math.max(duration, oheight/200*duration);

			closed.queue(closed.queue().slice(0,1));
			open.queue(open.queue().slice(0,1));

			el.removeClass('state-hover');

			closed[tween]({
				y: 0
			}, duration, options.easing, function() {
				el.removeClass('state-open').addClass('state-closed');
			});

			if(use3d) {
				open.transition({
					y: 0,
					perspective: options.perspective,
					rotateX: -90
				}, duration, options.easing);
			} else {
				open.animate({
					y: 0,
					height: 0
				}, duration, options.easing);
			}
		};

		self.init = function() {
			el.addClass('state-closed');

			el.addClass(use3d ? 'expandable-animation-3d' : 'expandable-animation-2d');

			if ( ! Modernizr.touch ) {
				el
					.bind('mouseenter.expandable', self.doOpen)
					.bind('mouseleave.expandable', self.doClose);

				el.find('a').bind('click', function(e) {
					if(el.hasClass('state-closed'))
						e.preventDefault();
				});
			}
		};

		var defaults = {
			duration: 250,
			perspective: '10000px',
			easing: 'linear'
		};
		options = $.extend({}, defaults, options);

		this.init();
	};

	$.fn.wpv_expandable = function(options, callback){
		if ( typeof options === 'string' ) {
			// call method
			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {
				var instance = $.data( this, 'wpv_expandable' );
				if ( !instance ) {
					logError( "cannot call methods on expandable prior to initialization; attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for expandable instance" );
					return;
				}

				// apply method
				$.WPV.expandable[ options ].apply( instance, args );
			});
		} else {
			this.each(function() {
				var instance = $.data( this, 'wpv_expandable' );
				if ( instance ) {
					// apply options & init
					instance.option( options );
					instance._init( callback );
				} else {
					// initialize new instance
					$.data( this, 'wpv_expandable', new $.WPV.expandable( this, options, callback ) );
				}
			});
		}

		return this;
	};

	$('.services.has-more').wpv_expandable();
})(jQuery);
(function($, undefined) {
	'use strict';

	var transDuration = 700,
		body = $('body');

	var doClose = function() {
		if($(this).hasClass('state-closed'))
			return;

		body.unbind('touchstart.portfolio-overlay-close'+$(this).data('id'));

		$(this).addClass('state-closed').removeClass('state-open');
		$('.portfolio_details.has-overlay', this).stop(true, true).animate({
			opacity: 1
		}, transDuration/2);

		$('.thumbnail-overlay, .love-count-outer', this).fadeOut({
			opacity: 0
		}, {
			duration: transDuration
		});
	};

	var doOpen = function() {
		var self = $(this);
		if(self.hasClass('state-open'))
			return;

		self.addClass('state-open').removeClass('state-closed');

		$('.portfolio_details.has-overlay', this).stop(true, true).animate({
			opacity: 0
		}, transDuration);

		$('.thumbnail-overlay, .love-count-outer', this).stop(true, true).fadeIn({
			duration: transDuration,
			easing: 'easeOutQuint'
		});

		if(Modernizr.touch) {
			var bodyEvent = 'touchstart.portfolio-overlay-close'+self.data('id');
			body.bind(bodyEvent, function() {
				// console.log('event 2');
				body.unbind(bodyEvent);
				doClose.call(self);
			});
		} else {
			$(this).bind('mouseleave.portfolio-overlay-close', function() {
				// console.log('event 3');
				$(this).unbind('mouseleave.portfolio-overlay-close');
				doClose.call(this);
			});
		}
	};

	$(function() {
		var portfolios = $('.portfolios');

		if(Modernizr.touch) {
			portfolios.on('click.portfolio-overlay', '.portfolio-items > li', function() {
				// console.log('event 4');
				doOpen.call(this);
			});

			portfolios.on('click', '.portfolio-items > li a', function(e) {
				var self = $(this).closest('.portfolios .portfolio-items > li');

				// console.log('event 5');
				if($(self).hasClass('state-closed')) {
					e.preventDefault();
				} else {
					e.stopPropagation();
				}
			});

			portfolios.on('touchstart', '.portfolio-items > li a', function(e) {
				var self = $(this).closest('.portfolios .portfolio-items > li');

				// console.log('event 5.1');
				if(!$(self).hasClass('state-closed')) {
					e.stopPropagation();
				}
			});
		} else {
			portfolios.on('mouseenter', '.portfolio-items > li', function() {
				// console.log('event 6');
				doOpen.call(this);
			});
		}
	});
})(jQuery);
(function($, undefined) {
	"use strict";

	$(function() {
		var wrap = $('#header-slider-container.layerslider').find('.layerslider-fixed-wrapper'),
			first = wrap.find('>div:first');

		if(!first.length) return;

		var timeout = false,
			wait = 0,
			remove_height = function() {
				if(first.height() > 0 || wait++ > 5) {
					wrap.height('auto');
					return;
				}

				timeout = setTimeout(remove_height, 500);
			};

		timeout = setTimeout(remove_height, 0);
	});
})(jQuery);
(function($, undefined) {
	"use strict";

	var mobileSafari = (/iPad|iPod|iPhone/i).test(navigator.userAgent);

	$(function() {
		// Load More Buttons
		// ---------------------------------------------------------------------
		$("body").on("click.pagination", ".load-more", function() {

			if(mobileSafari)
				return true;

			var url = $("a.lm-btn", this).attr("href");
			if (!url) {
				return true;
			}

			// Skip if alredy started
			if ($(this).is(":animated")) {
				return false;
			}

			var $currentLink = $(this);
			var $currentList = $currentLink.prev();

			var containerSelector = $currentList.is("section.portfolios > ul") ?
				"section.portfolios > ul" :
					$currentList.is(".loop-wrapper") ?
						".loop-wrapper.paginated" :
						null;

			if (containerSelector) {
				// Start loading indicator
				$(this).addClass("loading").find("> *").animate({opacity: 0});

				$.ajax({
					url      : url,
					dataType : "text",
					data     : { reduced : 1 },
					cache    : false,
					// headers  : { "X-Vamtam" : "reduced-response" },
					success  : function(html) {

						html = $($.parseHTML(html, document, true));
						var article = html.find('article');

						var newContainer = $(containerSelector, article);
						if (newContainer.length) {

							// Append the new items as transparent ones
							var newItems = newContainer.children().css("opacity", 0);

							window.newitems = newItems;
							try {
								$currentList.append(newItems);
							} catch(e) {
								if('log' in window.console)
									console.log("can't append these properly: ", newItems, e);
							}

							if($currentList.hasClass('masonry')) {
								newItems.removeClass('clearboth');
								$currentList.trigger('reload-isotope');
							}

							/*
								$("script", $currentList).each(function(i, o) {
									$.globalEval($(o).text());
								}).remove();
							*/

							$currentList.trigger("rawContent", newItems.get());

							if(! ('mediaelementplayer' in jQuery.fn) ) {
								html.filter('#mediaelement-css, #wp-mediaelement-css').appendTo($('head'));
								html.filter('script').each(function(i, o) {
									if($(o).prop('src').match('mediaelement-and-player')) {
										jQuery.getScript($(o).prop('src'), function() {
											$('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer();
										});
									}
								});
							} else {
								$('.wp-audio-shortcode, .wp-video-shortcode').not('.mejs-container').mediaelementplayer();
							}

							// Get the final height
							var endHeight = $currentList.height();

							// Expand the container
							if($currentList.is(':not(.masonry)')) {
								$currentList.height(endHeight);
								$currentList.css("height", "auto");
								$currentList.children().animate({opacity: 1}, 1000);
							}

							var newPager = $(".load-more", article);

							if (newPager.length) {
								$currentLink
									.html(newPager.html())
									.removeClass("loading")
									.find("> *").animate({opacity: 1}, 600, "linear");
							}
							else {
								$currentLink.slideUp().remove();
							}
							$(window).trigger("resize").trigger("scroll");
							article = newContainer = endHeight = newPager = null;
						}
					}
				});
			}
			return false;
		});

		//infinite scrolling
		if($('body').is('.pagination-infinite-scrolling')) {
			var last_auto_load = 0;
			$(window).bind('resize scroll', function(e) {
				var button = $('.lm-btn'),
					now_time = e.timeStamp || (new Date()).getTime();

				if(now_time - last_auto_load > 500 && parseFloat(button.css('opacity'), 10) === 1 && $(window).scrollTop() + $(window).height() >= button.offset().top) {
					last_auto_load = now_time;
					button.click();
				}
			});
		}
	});
})(jQuery);
(function($, undefined) {
	"use strict";

	$.rawContentHandler(function(context) {

		var whitespace = 30;
		var defaults = {
			pager: false,
			controls: true,
			minSlides: 1,
			maxSlides: 10,
			slideMargin: whitespace,
			infiniteLoop: false,
			hideControlOnEnd: true
		};

		var container = $('.portfolios.scroll-x, .loop-wrapper.scroll-x, .woocommerce-scrollable.scroll-x', context || document);

		container.find("img.lazy").not(".jail-started, .loaded").addClass("jail-started").jail({
			speed : 1000,
			event : false
		});

		var calcSlideWidth = function(maxSlides) {
			var columns = $.WPV.reduce_column_count(maxSlides);

			return ( this.closest('.scrollable-wrapper').width() - whitespace * ( columns - 1 ) ) / columns;
		};

		var reloadSlider = function(el, maxSlides, slideWidth) {
			if( ! el || ! el.data('bxslider') || ! el.data('scrollable-loaded') )
				return;

			el.data('scrollable-loaded', false);

			var newSlideWidth = calcSlideWidth.call(el, maxSlides);

			if(newSlideWidth !== slideWidth) {
				slideWidth = newSlideWidth;

				el.data('bxslider').reloadSlider($.extend(defaults, {
					slideWidth: newSlideWidth
				}));
			}

			return slideWidth;
		};

		container.each(function() {
			var el = $('> ul', this),
				maxSlides = parseInt(el.data('columns'), 10),
				slideWidth = calcSlideWidth.call(el, maxSlides);

			el.data('bxslider', el.bxSlider($.extend(defaults, {
				slideWidth: slideWidth,
				onSliderLoad: function() {
					el.data('scrollable-loaded', true);

					if(el.data('wpv-loaded-once')) return;

					el.data('wpv-loaded-once', true);

					el.imagesLoaded(function() {
						if ( el.data('bxslider') && 'redrawSlider' in el.data('bxslider') ) {
							el.data('bxslider').redrawSlider();
						}
					});

					setTimeout(function() {
						$(window).smartresize(function() {
							slideWidth = reloadSlider(el, maxSlides, slideWidth);
						});
					}, 1500);

					el.bind('vamtam-video-resized', function() {
						if ( el.data('bxslider') && 'redrawSlider' in el.data('bxslider') ) {
							el.data('bxslider').redrawSlider();
						}
					});
				}
			})));
		});
	});
})(jQuery);