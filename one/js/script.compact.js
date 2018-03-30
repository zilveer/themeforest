
;
(function($) {
	"use strict";

	window.THB_Filter = function( target, options ) {

		var self = this;

		/**
		 * Target element.
		 *
		 * @type {jQuery}
		 */
		target = $(target);

		/**
		 * Filter options.
		 *
		 * @type {Object}
		 */
		options = $.extend({
			/**
			 * True if elements can be filtered by one criteria at a time.
			 *
			 * @type {Boolean}
			 */
			individual: true,

			/**
			 * Filter controls.
			 *
			 * @type {jQuery|String|Boolean}
			 */
			controls: false,

			/**
			 * Filter controls "on" class.
			 *
			 * @type {String}
			 */
			controlsOnClass: "on",

			/**
			 * Items selector.
			 *
			 * @type {String}
			 */
			itemSelector: ".item",

			/**
			 * Visible items class.
			 *
			 * @type {String}
			 */
			visibleClass: "visible",

			/**
			 * Hidden items class.
			 *
			 * @type {String}
			 */
			hiddenClass: "hidden",

			/**
			 * Filter reset.
			 */
			reset: function() {
				self.getItems().removeClass( options.visibleClass + " " + options.hiddenClass );
			},

			/**
			 * Check if the filter can run.
			 *
			 * @return {Boolean}
			 */
			filterCheck: function() {
				return true;
			},

			/**
			 * Filtering action.
			 *
			 * @return {String}
			 */
			filter: function() {
				options.reset();

				var selector = self.getSelector();

				if ( selector !== "" ) {
					self.getItems().filter( selector ).addClass( options.visibleClass );
					self.getItems().not( selector ).addClass( options.hiddenClass );
				}

				return selector;
			}
		}, options);

		/**
		 * Retrieve the list of items to be filtered.
		 *
		 * @return {jQuery}
		 */
		this.getItems = function() {
			return target.find( options.itemSelector );
		};

		/**
		 * Retrieve the current selector value.
		 *
		 * @return {String}
		 */
		this.getSelector = function() {
			return this.selector.join( "" );
		};

		/**
		 * The filter selector.
		 *
		 * @type {Array}
		 */
		this.selector = [];

		/**
		 * Reset the filter.
		 */
		this.reset = function() {
			this.run("");

			if( options.controls !== false ) {
				$(options.controls).find("[data-filter]").removeClass(options.controlsOnClass);
				$(options.controls).find("[data-filter='']").addClass(options.controlsOnClass);
			}
		};

		/**
		 * Perform the filtering action.
		 *
		 * @param {String} filter
		 */
		this.run = function( filter ) {
			if( filter !== undefined ) {
				this.prepareSelector( filter );
			}

			options.filter( this.getSelector() );
		};

		/**
		 * Prepare the selector for the filtering.
		 *
		 * @param {String} filter
		 */
		this.prepareSelector = function( filter ) {
			if( filter === "" ) {
				self.selector = [];
			}
			else {
				var dataFilter = "[data-filter-" + filter + "]",
					index = $.inArray(dataFilter, self.selector);

				if( options.individual ) {
					self.selector = [];
				}

				if( index === -1 ) {
					self.selector.push( dataFilter );
				}
				else {
					self.selector.splice( index, 1 );
				}
			}

			return this.getSelector();
		};

		/**
		 * Initialize the filter.
		 */
		if( options.controls !== false ) {
			var filterItems = $(options.controls).find("[data-filter]"),
				filterResetItem = filterItems.filter("[data-filter='']");

			filterItems.on("click", function() {
				if ( ! options.filterCheck() ) {
					return false;
				}

				var data = $(this).data("filter");

				if( data === "" ) {
					self.reset();
				}
				else {
					if( self.prepareSelector(data) === "" ) {
						self.reset();
					}
					else {
						self.run();

						filterResetItem.removeClass(options.controlsOnClass);

						if( options.individual ) {
							filterItems.not( $(this) ).removeClass(options.controlsOnClass);
						}

						$(this).toggleClass(options.controlsOnClass);
					}
				}

				return false;
			});
		}

	};

})(jQuery);
;
(function($) {
	"use strict";

	window.THB_Isotope = function( target, options ) {

		if( ! target.isotope ) {
			return;
		}

		var self = this;

		/**
		 * Target element.
		 *
		 * @type {jQuery}
		 */
		target = $(target);

		/**
		 * Isotope options.
		 *
		 * @type {Object}
		 */
		options = $.extend({
			/**
			 * Isotope options.
			 *
			 * @type {Object}
			 */
			isotope: {},

			/**
			 * Items removal callback.
			 *
			 * @type {Function}
			 */
			callbackRemove: null,

			/**
			 * Items insertion callback.
			 *
			 * @type {Function}
			 */
			callbackInsert: null,

			/**
			 * Style adjustments function.
			 *
			 * @return {Function}
			 */
			styleAdjust: function() {
				if ( window.thb_isotope_styleAdjust !== undefined ) {
					window.thb_isotope_styleAdjust();
				}
				else {
					if ( $("body").hasClass("thb-desktop") ) {
						$( "html" ).css( 'overflow-y', 'scroll' );
					}
				}
			},

			/**
			 * Items selector.
			 *
			 * @type {String}
			 */
			itemSelector: ".item",

			/**
			 * Filter.
			 *
			 * @type {THB_Filter|Boolean}
			 */
			filter: false,

			/**
			 * Transition time.
			 *
			 * @type {Integer}
			 */
			transition_time: 400
		}, options);

		/**
		 * Retrieve the list of items.
		 *
		 * @return {jQuery}
		 */
		this.getItems = function() {
			return target.find( options.itemSelector );
		};

		/**
		 * Filter the Isotope view.
		 *
		 * @param {String} filter
		 */
		this.filter = function( selector ) {
			var opts = options.isotope;
			opts.filter = selector;

			target.isotope( opts );
		};

		/**
		 * Inject new items into the Isotope view.
		 *
		 * @param {String} raw Raw HTML.
		 * @param {Function} callback
		 */
		this.insert = function( raw, callback ) {
			options.callbackInsert = callback;

			$( raw ).imagesLoaded( function() {
				setTimeout( function() {
					target.isotope( 'insert', $( raw ) );
				}, options.transition_time );
			} );
		};

		/**
		 * Remove all the items from the Isotope view.
		 *
		 * @param {Function} callback
		 */
		this.remove = function( callback ) {
			options.callbackRemove = callback;
			target.isotope( 'remove', this.getItems() );
		};

		/**
		 * Refresh the Isotope container.
		 */
		this.refresh = function() {
			target.isotope( 'layout' );
		}

		/**
		 * Initialize the Isotope container.
		 */
		options.styleAdjust();
		$( "body.thb-desktop" ).css( 'overflow-x', 'hidden' );

		$( target ).imagesLoaded( function() {
			var opts = options.isotope;
			opts.itemSelector = options.itemSelector;

			target.isotope( opts );

			$( target ).addClass( "thb-isotope" );

			target.isotope( 'on', 'layoutComplete', function() {
				if ( options.callbackInsert ) {
					setTimeout( function() {
						options.callbackInsert();
						options.callbackInsert = null;
					}, options.transition_time );
				}
			} );

			target.isotope( 'on', 'removeComplete', function() {
				if ( options.callbackRemove ) {
					setTimeout( function() {
						options.callbackRemove();
						options.callbackRemove = null;
					}, options.transition_time );
				}
			} );
		} );

	};

})(jQuery);
;

/* Modernizr 2.7.1 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-csstransforms-csstransforms3d-csstransitions-shiv-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function z(a){j.cssText=a}function A(a,b){return z(m.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a){var e=a[d];if(!C(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+o.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+p.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.7.1",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n="Webkit Moz O ms",o=n.split(" "),p=n.toLowerCase().split(" "),q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e}),q.csstransforms=function(){return!!F("transform")},q.csstransforms3d=function(){var a=!!F("perspective");return a&&"webkitPerspective"in g.style&&w("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},q.csstransitions=function(){return F("transition")};for(var G in q)y(q,G)&&(v=G.toLowerCase(),e[v]=q[G](),t.push((e[v]?"":"no-")+v));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)y(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},z(""),i=k=null,function(a,b){function l(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function m(){var a=s.elements;return typeof a=="string"?a.split(" "):a}function n(a){var b=j[a[h]];return b||(b={},i++,a[h]=i,j[i]=b),b}function o(a,c,d){c||(c=b);if(k)return c.createElement(a);d||(d=n(c));var g;return d.cache[a]?g=d.cache[a].cloneNode():f.test(a)?g=(d.cache[a]=d.createElem(a)).cloneNode():g=d.createElem(a),g.canHaveChildren&&!e.test(a)&&!g.tagUrn?d.frag.appendChild(g):g}function p(a,c){a||(a=b);if(k)return a.createDocumentFragment();c=c||n(a);var d=c.frag.cloneNode(),e=0,f=m(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function q(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return s.shivMethods?o(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(s,b.frag)}function r(a){a||(a=b);var c=n(a);return s.shivCSS&&!g&&!c.hasCSS&&(c.hasCSS=!!l(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),k||q(a,c),a}var c="3.7.0",d=a.html5||{},e=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,f=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g,h="_html5shiv",i=0,j={},k;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",g="hidden"in a,k=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){g=!0,k=!0}})();var s={elements:d.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:c,shivCSS:d.shivCSS!==!1,supportsUnknownElements:k,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:r,createElement:o,createDocumentFragment:p};a.html5=s,r(b)}(this,b),e._version=d,e._prefixes=m,e._domPrefixes=p,e._cssomPrefixes=o,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+t.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
;
// jQuery RoyalSlider plugin. Custom build. Copyright 2011-2013 Dmitry Semenov http://dimsemenov.com
// http://dimsemenov.com/private/home.php?build=bullets_thumbnails_autoplay_video_auto-height_active-class
// jquery.royalslider v9.5.5
(function(n){function u(b,f){var c,a=this,e=window.navigator,g=e.userAgent.toLowerCase();a.uid=n.rsModules.uid++;a.ns=".rs"+a.uid;var d=document.createElement("div").style,h=["webkit","Moz","ms","O"],k="",l=0,r;for(c=0;c<h.length;c++)r=h[c],!k&&r+"Transform"in d&&(k=r),r=r.toLowerCase(),window.requestAnimationFrame||(window.requestAnimationFrame=window[r+"RequestAnimationFrame"],window.cancelAnimationFrame=window[r+"CancelAnimationFrame"]||window[r+"CancelRequestAnimationFrame"]);window.requestAnimationFrame||
(window.requestAnimationFrame=function(a,b){var c=(new Date).getTime(),d=Math.max(0,16-(c-l)),e=window.setTimeout(function(){a(c+d)},d);l=c+d;return e});window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)});a.isIPAD=g.match(/(ipad)/);a.isIOS=a.isIPAD||g.match(/(iphone|ipod)/);c=function(a){a=/(chrome)[ \/]([\w.]+)/.exec(a)||/(webkit)[ \/]([\w.]+)/.exec(a)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(a)||/(msie) ([\w.]+)/.exec(a)||0>a.indexOf("compatible")&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(a)||
[];return{browser:a[1]||"",version:a[2]||"0"}}(g);h={};c.browser&&(h[c.browser]=!0,h.version=c.version);h.chrome&&(h.webkit=!0);a._a=h;a.isAndroid=-1<g.indexOf("android");a.slider=n(b);a.ev=n(a);a._b=n(document);a.st=n.extend({},n.fn.royalSlider.defaults,f);a._c=a.st.transitionSpeed;a._d=0;!a.st.allowCSS3||h.webkit&&!a.st.allowCSS3OnWebkit||(c=k+(k?"T":"t"),a._e=c+"ransform"in d&&c+"ransition"in d,a._e&&(a._f=k+(k?"P":"p")+"erspective"in d));k=k.toLowerCase();a._g="-"+k+"-";a._h="vertical"===a.st.slidesOrientation?
!1:!0;a._i=a._h?"left":"top";a._j=a._h?"width":"height";a._k=-1;a._l="fade"===a.st.transitionType?!1:!0;a._l||(a.st.sliderDrag=!1,a._m=10);a._n="z-index:0; display:none; opacity:0;";a._o=0;a._p=0;a._q=0;n.each(n.rsModules,function(b,c){"uid"!==b&&c.call(a)});a.slides=[];a._r=0;(a.st.slides?n(a.st.slides):a.slider.children().detach()).each(function(){a._s(this,!0)});a.st.randomizeSlides&&a.slides.sort(function(){return.5-Math.random()});a.numSlides=a.slides.length;a._t();a.st.startSlideId?a.st.startSlideId>
a.numSlides-1&&(a.st.startSlideId=a.numSlides-1):a.st.startSlideId=0;a._o=a.staticSlideId=a.currSlideId=a._u=a.st.startSlideId;a.currSlide=a.slides[a.currSlideId];a._v=0;a.pointerMultitouch=!1;a.slider.addClass((a._h?"rsHor":"rsVer")+(a._l?"":" rsFade"));d='<div class="rsOverflow"><div class="rsContainer">';a.slidesSpacing=a.st.slidesSpacing;a._w=(a._h?a.slider.width():a.slider.height())+a.st.slidesSpacing;a._x=Boolean(0<a._y);1>=a.numSlides&&(a._z=!1);a._a1=a._z&&a._l?2===a.numSlides?1:2:0;a._b1=
6>a.numSlides?a.numSlides:6;a._c1=0;a._d1=0;a.slidesJQ=[];for(c=0;c<a.numSlides;c++)a.slidesJQ.push(n('<div style="'+(a._l?"":c!==a.currSlideId?a._n:"z-index:0;")+'" class="rsSlide "></div>'));a._e1=d=n(d+"</div></div>");var m=a.ns,k=function(b,c,d,e,f){a._j1=b+c+m;a._k1=b+d+m;a._l1=b+e+m;f&&(a._m1=b+f+m)};c=e.pointerEnabled;a.pointerEnabled=c||e.msPointerEnabled;a.pointerEnabled?(a.hasTouch=!1,a._n1=.2,a.pointerMultitouch=Boolean(1<e[(c?"m":"msM")+"axTouchPoints"]),c?k("pointer","down","move","up",
"cancel"):k("MSPointer","Down","Move","Up","Cancel")):(a.isIOS?a._j1=a._k1=a._l1=a._m1="":k("mouse","down","move","up"),"ontouchstart"in window||"createTouch"in document?(a.hasTouch=!0,a._j1+=" touchstart"+m,a._k1+=" touchmove"+m,a._l1+=" touchend"+m,a._m1+=" touchcancel"+m,a._n1=.5,a.st.sliderTouch&&(a._f1=!0)):(a.hasTouch=!1,a._n1=.2));a.st.sliderDrag&&(a._f1=!0,h.msie||h.opera?a._g1=a._h1="move":h.mozilla?(a._g1="-moz-grab",a._h1="-moz-grabbing"):h.webkit&&-1!=e.platform.indexOf("Mac")&&(a._g1=
"-webkit-grab",a._h1="-webkit-grabbing"),a._i1());a.slider.html(d);a._o1=a.st.controlsInside?a._e1:a.slider;a._p1=a._e1.children(".rsContainer");a.pointerEnabled&&a._p1.css((c?"":"-ms-")+"touch-action",a._h?"pan-y":"pan-x");a._q1=n('<div class="rsPreloader"></div>');e=a._p1.children(".rsSlide");a._r1=a.slidesJQ[a.currSlideId];a._s1=0;a._e?(a._t1="transition-property",a._u1="transition-duration",a._v1="transition-timing-function",a._w1=a._x1=a._g+"transform",a._f?(h.webkit&&!h.chrome&&a.slider.addClass("rsWebkit3d"),
a._y1="translate3d(",a._z1="px, ",a._a2="px, 0px)"):(a._y1="translate(",a._z1="px, ",a._a2="px)"),a._l?a._p1[a._g+a._t1]=a._g+"transform":(h={},h[a._g+a._t1]="opacity",h[a._g+a._u1]=a.st.transitionSpeed+"ms",h[a._g+a._v1]=a.st.css3easeInOut,e.css(h))):(a._x1="left",a._w1="top");var p;n(window).on("resize"+a.ns,function(){p&&clearTimeout(p);p=setTimeout(function(){a.updateSliderSize()},50)});a.ev.trigger("rsAfterPropsSetup");a.updateSliderSize();a.st.keyboardNavEnabled&&a._b2();a.st.arrowsNavHideOnTouch&&
(a.hasTouch||a.pointerMultitouch)&&(a.st.arrowsNav=!1);a.st.arrowsNav&&(e=a._o1,n('<div class="rsArrow rsArrowLeft"><div class="rsArrowIcn"></div></div><div class="rsArrow rsArrowRight"><div class="rsArrowIcn"></div></div>').appendTo(e),a._c2=e.children(".rsArrowLeft").click(function(b){b.preventDefault();a.prev()}),a._d2=e.children(".rsArrowRight").click(function(b){b.preventDefault();a.next()}),a.st.arrowsNavAutoHide&&!a.hasTouch&&(a._c2.addClass("rsHidden"),a._d2.addClass("rsHidden"),e.one("mousemove.arrowshover",
function(){a._c2.removeClass("rsHidden");a._d2.removeClass("rsHidden")}),e.hover(function(){a._e2||(a._c2.removeClass("rsHidden"),a._d2.removeClass("rsHidden"))},function(){a._e2||(a._c2.addClass("rsHidden"),a._d2.addClass("rsHidden"))})),a.ev.on("rsOnUpdateNav",function(){a._f2()}),a._f2());if(a.hasTouch&&a.st.sliderTouch||!a.hasTouch&&a.st.sliderDrag)a._p1.on(a._j1,function(b){a._g2(b)});else a.dragSuccess=!1;var q=["rsPlayBtnIcon","rsPlayBtn","rsCloseVideoBtn","rsCloseVideoIcn"];a._p1.click(function(b){if(!a.dragSuccess){var c=
n(b.target).attr("class");if(-1!==n.inArray(c,q)&&a.toggleVideo())return!1;if(a.st.navigateByClick&&!a._h2){if(n(b.target).closest(".rsNoDrag",a._r1).length)return!0;a._i2(b)}a.ev.trigger("rsSlideClick",b)}}).on("click.rs","a",function(b){if(a.dragSuccess)return!1;a._h2=!0;setTimeout(function(){a._h2=!1},3)});a.ev.trigger("rsAfterInit")}n.rsModules||(n.rsModules={uid:0});u.prototype={constructor:u,_i2:function(b){b=b[this._h?"pageX":"pageY"]-this._j2;b>=this._q?this.next():0>b&&this.prev()},_t:function(){var b;
b=this.st.numImagesToPreload;if(this._z=this.st.loop)2===this.numSlides?(this._z=!1,this.st.loopRewind=!0):2>this.numSlides&&(this.st.loopRewind=this._z=!1);this._z&&0<b&&(4>=this.numSlides?b=1:this.st.numImagesToPreload>(this.numSlides-1)/2&&(b=Math.floor((this.numSlides-1)/2)));this._y=b},_s:function(b,f){function c(b,c){c?g.images.push(b.attr(c)):g.images.push(b.text());if(h){h=!1;g.caption="src"===c?b.attr("alt"):b.contents();g.image=g.images[0];g.videoURL=b.attr("data-rsVideo");var d=b.attr("data-rsw"),
e=b.attr("data-rsh");"undefined"!==typeof d&&!1!==d&&"undefined"!==typeof e&&!1!==e?(g.iW=parseInt(d,10),g.iH=parseInt(e,10)):a.st.imgWidth&&a.st.imgHeight&&(g.iW=a.st.imgWidth,g.iH=a.st.imgHeight)}}var a=this,e,g={},d,h=!0;b=n(b);a._k2=b;a.ev.trigger("rsBeforeParseNode",[b,g]);if(!g.stopParsing)return b=a._k2,g.id=a._r,g.contentAdded=!1,a._r++,g.images=[],g.isBig=!1,g.hasCover||(b.hasClass("rsImg")?(d=b,e=!0):(d=b.find(".rsImg"),d.length&&(e=!0)),e?(g.bigImage=d.eq(0).attr("data-rsBigImg"),d.each(function(){var a=
n(this);a.is("a")?c(a,"href"):a.is("img")?c(a,"src"):c(a)})):b.is("img")&&(b.addClass("rsImg rsMainSlideImage"),c(b,"src"))),d=b.find(".rsCaption"),d.length&&(g.caption=d.remove()),g.content=b,a.ev.trigger("rsAfterParseNode",[b,g]),f&&a.slides.push(g),0===g.images.length&&(g.isLoaded=!0,g.isRendered=!1,g.isLoading=!1,g.images=null),g},_b2:function(){var b=this,f,c,a=function(a){37===a?b.prev():39===a&&b.next()};b._b.on("keydown"+b.ns,function(e){b._l2||(c=e.keyCode,37!==c&&39!==c||f||(a(c),f=setInterval(function(){a(c)},
700)))}).on("keyup"+b.ns,function(a){f&&(clearInterval(f),f=null)})},goTo:function(b,f){b!==this.currSlideId&&this._m2(b,this.st.transitionSpeed,!0,!f)},destroy:function(b){this.ev.trigger("rsBeforeDestroy");this._b.off("keydown"+this.ns+" keyup"+this.ns+" "+this._k1+" "+this._l1);this._p1.off(this._j1+" click");this.slider.data("royalSlider",null);n.removeData(this.slider,"royalSlider");n(window).off("resize"+this.ns);this.loadingTimeout&&clearTimeout(this.loadingTimeout);b&&this.slider.remove();
this.ev=this.slider=this.slides=null},_n2:function(b,f){function c(c,f,g){c.isAdded?(a(f,c),e(f,c)):(g||(g=d.slidesJQ[f]),c.holder?g=c.holder:(g=d.slidesJQ[f]=n(g),c.holder=g),c.appendOnLoaded=!1,e(f,c,g),a(f,c),d._p2(c,g,b),c.isAdded=!0)}function a(a,c){c.contentAdded||(d.setItemHtml(c,b),b||(c.contentAdded=!0))}function e(a,b,c){d._l&&(c||(c=d.slidesJQ[a]),c.css(d._i,(a+d._d1+p)*d._w))}function g(a){if(l){if(a>r-1)return g(a-r);if(0>a)return g(r+a)}return a}var d=this,h,k,l=d._z,r=d.numSlides;if(!isNaN(f))return g(f);
var m=d.currSlideId,p,q=b?Math.abs(d._o2-d.currSlideId)>=d.numSlides-1?0:1:d._y,s=Math.min(2,q),v=!1,u=!1,t;for(k=m;k<m+1+s;k++)if(t=g(k),(h=d.slides[t])&&(!h.isAdded||!h.positionSet)){v=!0;break}for(k=m-1;k>m-1-s;k--)if(t=g(k),(h=d.slides[t])&&(!h.isAdded||!h.positionSet)){u=!0;break}if(v)for(k=m;k<m+q+1;k++)t=g(k),p=Math.floor((d._u-(m-k))/d.numSlides)*d.numSlides,(h=d.slides[t])&&c(h,t);if(u)for(k=m-1;k>m-1-q;k--)t=g(k),p=Math.floor((d._u-(m-k))/r)*r,(h=d.slides[t])&&c(h,t);if(!b)for(s=g(m-q),
m=g(m+q),q=s>m?0:s,k=0;k<r;k++)s>m&&k>s-1||!(k<q||k>m)||(h=d.slides[k])&&h.holder&&(h.holder.detach(),h.isAdded=!1)},setItemHtml:function(b,f){var c=this,a=function(){if(!b.images)b.isRendered=!0,b.isLoaded=!0,b.isLoading=!1,d(!0);else if(!b.isLoading){var a,f;b.content.hasClass("rsImg")?(a=b.content,f=!0):a=b.content.find(".rsImg:not(img)");a&&!a.is("img")&&a.each(function(){var a=n(this),c='<img class="rsImg" src="'+(a.is("a")?a.attr("href"):a.text())+'" />';f?b.content=n(c):a.replaceWith(c)});
a=f?b.content:b.content.find("img.rsImg");k();a.eq(0).addClass("rsMainSlideImage");b.iW&&b.iH&&(b.isLoaded||c._q2(b),d());b.isLoading=!0;if(b.isBig)n("<img />").on("load.rs error.rs",function(a){n(this).off("load.rs error.rs");e([this],!0)}).attr("src",b.image);else{b.loaded=[];b.numStartedLoad=0;a=function(a){n(this).off("load.rs error.rs");b.loaded.push(this);b.loaded.length===b.numStartedLoad&&e(b.loaded,!1)};for(var g=0;g<b.images.length;g++){var h=n("<img />");b.numStartedLoad++;h.on("load.rs error.rs",
a).attr("src",b.images[g])}}}},e=function(a,c){if(a.length){var d=a[0];if(c!==b.isBig)(d=b.holder.children())&&1<d.length&&l();else if(b.iW&&b.iH)g();else if(b.iW=d.width,b.iH=d.height,b.iW&&b.iH)g();else{var e=new Image;e.onload=function(){e.width?(b.iW=e.width,b.iH=e.height,g()):setTimeout(function(){e.width&&(b.iW=e.width,b.iH=e.height);g()},1E3)};e.src=d.src}}else g()},g=function(){b.isLoaded=!0;b.isLoading=!1;d();l();h()},d=function(){if(!b.isAppended&&c.ev){var a=c.st.visibleNearby,d=b.id-c._o;
f||b.appendOnLoaded||!c.st.fadeinLoadedSlide||0!==d&&(!(a||c._r2||c._l2)||-1!==d&&1!==d)||(a={visibility:"visible",opacity:0},a[c._g+"transition"]="opacity 400ms ease-in-out",b.content.css(a),setTimeout(function(){b.content.css("opacity",1)},16));b.holder.find(".rsPreloader").length?b.holder.append(b.content):b.holder.html(b.content);b.isAppended=!0;b.isLoaded&&(c._q2(b),h());b.sizeReady||(b.sizeReady=!0,setTimeout(function(){c.ev.trigger("rsMaybeSizeReady",b)},100))}},h=function(){!b.loadedTriggered&&
c.ev&&(b.isLoaded=b.loadedTriggered=!0,b.holder.trigger("rsAfterContentSet"),c.ev.trigger("rsAfterContentSet",b))},k=function(){c.st.usePreloader&&b.holder.html(c._q1.clone())},l=function(a){c.st.usePreloader&&(a=b.holder.find(".rsPreloader"),a.length&&a.remove())};b.isLoaded?d():f?!c._l&&b.images&&b.iW&&b.iH?a():(b.holder.isWaiting=!0,k(),b.holder.slideId=-99):a()},_p2:function(b,f,c){this._p1.append(b.holder);b.appendOnLoaded=!1},_g2:function(b,f){var c=this,a,e="touchstart"===b.type;c._s2=e;c.ev.trigger("rsDragStart");
if(n(b.target).closest(".rsNoDrag",c._r1).length)return c.dragSuccess=!1,!0;!f&&c._r2&&(c._t2=!0,c._u2());c.dragSuccess=!1;if(c._l2)e&&(c._v2=!0);else{e&&(c._v2=!1);c._w2();if(e){var g=b.originalEvent.touches;if(g&&0<g.length)a=g[0],1<g.length&&(c._v2=!0);else return}else b.preventDefault(),a=b,c.pointerEnabled&&(a=a.originalEvent);c._l2=!0;c._b.on(c._k1,function(a){c._x2(a,f)}).on(c._l1,function(a){c._y2(a,f)});c._z2="";c._a3=!1;c._b3=a.pageX;c._c3=a.pageY;c._d3=c._v=(f?c._e3:c._h)?a.pageX:a.pageY;
c._f3=0;c._g3=0;c._h3=f?c._i3:c._p;c._j3=(new Date).getTime();if(e)c._e1.on(c._m1,function(a){c._y2(a,f)})}},_k3:function(b,f){if(this._l3){var c=this._m3,a=b.pageX-this._b3,e=b.pageY-this._c3,g=this._h3+a,d=this._h3+e,h=f?this._e3:this._h,g=h?g:d,d=this._z2;this._a3=!0;this._b3=b.pageX;this._c3=b.pageY;"x"===d&&0!==a?this._f3=0<a?1:-1:"y"===d&&0!==e&&(this._g3=0<e?1:-1);d=h?this._b3:this._c3;a=h?a:e;f?g>this._n3?g=this._h3+a*this._n1:g<this._o3&&(g=this._h3+a*this._n1):this._z||(0>=this.currSlideId&&
0<d-this._d3&&(g=this._h3+a*this._n1),this.currSlideId>=this.numSlides-1&&0>d-this._d3&&(g=this._h3+a*this._n1));this._h3=g;200<c-this._j3&&(this._j3=c,this._v=d);f?this._q3(this._h3):this._l&&this._p3(this._h3)}},_x2:function(b,f){var c=this,a,e="touchmove"===b.type;if(!c._s2||e){if(e){if(c._r3)return;var g=b.originalEvent.touches;if(g){if(1<g.length)return;a=g[0]}else return}else a=b,c.pointerEnabled&&(a=a.originalEvent);c._a3||(c._e&&(f?c._s3:c._p1).css(c._g+c._u1,"0s"),function h(){c._l2&&(c._t3=
requestAnimationFrame(h),c._u3&&c._k3(c._u3,f))}());if(c._l3)b.preventDefault(),c._m3=(new Date).getTime(),c._u3=a;else if(g=f?c._e3:c._h,a=Math.abs(a.pageX-c._b3)-Math.abs(a.pageY-c._c3)-(g?-7:7),7<a){if(g)b.preventDefault(),c._z2="x";else if(e){c._v3(b);return}c._l3=!0}else if(-7>a){if(!g)b.preventDefault(),c._z2="y";else if(e){c._v3(b);return}c._l3=!0}}},_v3:function(b,f){this._r3=!0;this._a3=this._l2=!1;this._y2(b)},_y2:function(b,f){function c(a){return 100>a?100:500<a?500:a}function a(a,b){if(e._l||
f)h=(-e._u-e._d1)*e._w,k=Math.abs(e._p-h),e._c=k/b,a&&(e._c+=250),e._c=c(e._c),e._x3(h,!1)}var e=this,g,d,h,k;g=-1<b.type.indexOf("touch");if(!e._s2||g)if(e._s2=!1,e.ev.trigger("rsDragRelease"),e._u3=null,e._l2=!1,e._r3=!1,e._l3=!1,e._m3=0,cancelAnimationFrame(e._t3),e._a3&&(f?e._q3(e._h3):e._l&&e._p3(e._h3)),e._b.off(e._k1).off(e._l1),g&&e._e1.off(e._m1),e._i1(),!e._a3&&!e._v2&&f&&e._w3){var l=n(b.target).closest(".rsNavItem");l.length&&e.goTo(l.index())}else{d=f?e._e3:e._h;if(!e._a3||"y"===e._z2&&
d||"x"===e._z2&&!d)if(!f&&e._t2){e._t2=!1;if(e.st.navigateByClick){e._i2(e.pointerEnabled?b.originalEvent:b);e.dragSuccess=!0;return}e.dragSuccess=!0}else{e._t2=!1;e.dragSuccess=!1;return}else e.dragSuccess=!0;e._t2=!1;e._z2="";var r=e.st.minSlideOffset;g=g?b.originalEvent.changedTouches[0]:e.pointerEnabled?b.originalEvent:b;var m=d?g.pageX:g.pageY,p=e._d3;g=e._v;var q=e.currSlideId,s=e.numSlides,v=d?e._f3:e._g3,u=e._z;Math.abs(m-p);g=m-g;d=(new Date).getTime()-e._j3;d=Math.abs(g)/d;if(0===v||1>=
s)a(!0,d);else{if(!u&&!f)if(0>=q){if(0<v){a(!0,d);return}}else if(q>=s-1&&0>v){a(!0,d);return}if(f){h=e._i3;if(h>e._n3)h=e._n3;else if(h<e._o3)h=e._o3;else{m=d*d/.006;l=-e._i3;p=e._y3-e._z3+e._i3;0<g&&m>l?(l+=e._z3/(15/(m/d*.003)),d=d*l/m,m=l):0>g&&m>p&&(p+=e._z3/(15/(m/d*.003)),d=d*p/m,m=p);l=Math.max(Math.round(d/.003),50);h+=m*(0>g?-1:1);if(h>e._n3){e._a4(h,l,!0,e._n3,200);return}if(h<e._o3){e._a4(h,l,!0,e._o3,200);return}}e._a4(h,l,!0)}else l=function(a){var b=Math.floor(a/e._w);a-b*e._w>r&&b++;
return b},p+r<m?0>v?a(!1,d):(l=l(m-p),e._m2(e.currSlideId-l,c(Math.abs(e._p-(-e._u-e._d1+l)*e._w)/d),!1,!0,!0)):p-r>m?0<v?a(!1,d):(l=l(p-m),e._m2(e.currSlideId+l,c(Math.abs(e._p-(-e._u-e._d1-l)*e._w)/d),!1,!0,!0)):a(!1,d)}}},_p3:function(b){b=this._p=b;this._e?this._p1.css(this._x1,this._y1+(this._h?b+this._z1+0:0+this._z1+b)+this._a2):this._p1.css(this._h?this._x1:this._w1,b)},updateSliderSize:function(b){var f,c;if(this.slider){if(this.st.autoScaleSlider){var a=this.st.autoScaleSliderWidth,e=this.st.autoScaleSliderHeight;
this.st.autoScaleHeight?(f=this.slider.width(),f!=this.width&&(this.slider.css("height",e/a*f),f=this.slider.width()),c=this.slider.height()):(c=this.slider.height(),c!=this.height&&(this.slider.css("width",a/e*c),c=this.slider.height()),f=this.slider.width())}else f=this.slider.width(),c=this.slider.height();if(b||f!=this.width||c!=this.height){this.width=f;this.height=c;this._b4=f;this._c4=c;this.ev.trigger("rsBeforeSizeSet");this.ev.trigger("rsAfterSizePropSet");this._e1.css({width:this._b4,height:this._c4});
this._w=(this._h?this._b4:this._c4)+this.st.slidesSpacing;this._d4=this.st.imageScalePadding;for(f=0;f<this.slides.length;f++)b=this.slides[f],b.positionSet=!1,b&&b.images&&b.isLoaded&&(b.isRendered=!1,this._q2(b));if(this._e4)for(f=0;f<this._e4.length;f++)b=this._e4[f],b.holder.css(this._i,(b.id+this._d1)*this._w);this._n2();this._l&&(this._e&&this._p1.css(this._g+"transition-duration","0s"),this._p3((-this._u-this._d1)*this._w));this.ev.trigger("rsOnUpdateNav")}this._j2=this._e1.offset();this._j2=
this._j2[this._i]}},appendSlide:function(b,f){var c=this._s(b);if(isNaN(f)||f>this.numSlides)f=this.numSlides;this.slides.splice(f,0,c);this.slidesJQ.splice(f,0,n('<div style="'+(this._l?"position:absolute;":this._n)+'" class="rsSlide"></div>'));f<=this.currSlideId&&this.currSlideId++;this.ev.trigger("rsOnAppendSlide",[c,f]);this._f4(f);f===this.currSlideId&&this.ev.trigger("rsAfterSlideChange")},removeSlide:function(b){var f=this.slides[b];f&&(f.holder&&f.holder.remove(),b<this.currSlideId&&this.currSlideId--,
this.slides.splice(b,1),this.slidesJQ.splice(b,1),this.ev.trigger("rsOnRemoveSlide",[b]),this._f4(b),b===this.currSlideId&&this.ev.trigger("rsAfterSlideChange"))},_f4:function(b){var f=this;b=f.numSlides;b=0>=f._u?0:Math.floor(f._u/b);f.numSlides=f.slides.length;0===f.numSlides?(f.currSlideId=f._d1=f._u=0,f.currSlide=f._g4=null):f._u=b*f.numSlides+f.currSlideId;for(b=0;b<f.numSlides;b++)f.slides[b].id=b;f.currSlide=f.slides[f.currSlideId];f._r1=f.slidesJQ[f.currSlideId];f.currSlideId>=f.numSlides?
f.goTo(f.numSlides-1):0>f.currSlideId&&f.goTo(0);f._t();f._l&&f._p1.css(f._g+f._u1,"0ms");f._h4&&clearTimeout(f._h4);f._h4=setTimeout(function(){f._l&&f._p3((-f._u-f._d1)*f._w);f._n2();f._l||f._r1.css({display:"block",opacity:1})},14);f.ev.trigger("rsOnUpdateNav")},_i1:function(){this._f1&&this._l&&(this._g1?this._e1.css("cursor",this._g1):(this._e1.removeClass("grabbing-cursor"),this._e1.addClass("grab-cursor")))},_w2:function(){this._f1&&this._l&&(this._h1?this._e1.css("cursor",this._h1):(this._e1.removeClass("grab-cursor"),
this._e1.addClass("grabbing-cursor")))},next:function(b){this._m2("next",this.st.transitionSpeed,!0,!b)},prev:function(b){this._m2("prev",this.st.transitionSpeed,!0,!b)},_m2:function(b,f,c,a,e){var g=this,d,h,k;g.ev.trigger("rsBeforeMove",[b,a]);k="next"===b?g.currSlideId+1:"prev"===b?g.currSlideId-1:b=parseInt(b,10);if(!g._z){if(0>k){g._i4("left",!a);return}if(k>=g.numSlides){g._i4("right",!a);return}}g._r2&&(g._u2(!0),c=!1);h=k-g.currSlideId;k=g._o2=g.currSlideId;var l=g.currSlideId+h;a=g._u;var n;
g._z?(l=g._n2(!1,l),a+=h):a=l;g._o=l;g._g4=g.slidesJQ[g.currSlideId];g._u=a;g.currSlideId=g._o;g.currSlide=g.slides[g.currSlideId];g._r1=g.slidesJQ[g.currSlideId];var l=g.st.slidesDiff,m=Boolean(0<h);h=Math.abs(h);var p=Math.floor(k/g._y),q=Math.floor((k+(m?l:-l))/g._y),p=(m?Math.max(p,q):Math.min(p,q))*g._y+(m?g._y-1:0);p>g.numSlides-1?p=g.numSlides-1:0>p&&(p=0);k=m?p-k:k-p;k>g._y&&(k=g._y);if(h>k+l)for(g._d1+=(h-(k+l))*(m?-1:1),f*=1.4,k=0;k<g.numSlides;k++)g.slides[k].positionSet=!1;g._c=f;g._n2(!0);
e||(n=!0);d=(-a-g._d1)*g._w;n?setTimeout(function(){g._j4=!1;g._x3(d,b,!1,c);g.ev.trigger("rsOnUpdateNav")},0):(g._x3(d,b,!1,c),g.ev.trigger("rsOnUpdateNav"))},_f2:function(){this.st.arrowsNav&&(1>=this.numSlides?(this._c2.css("display","none"),this._d2.css("display","none")):(this._c2.css("display","block"),this._d2.css("display","block"),this._z||this.st.loopRewind||(0===this.currSlideId?this._c2.addClass("rsArrowDisabled"):this._c2.removeClass("rsArrowDisabled"),this.currSlideId===this.numSlides-
1?this._d2.addClass("rsArrowDisabled"):this._d2.removeClass("rsArrowDisabled"))))},_x3:function(b,f,c,a,e){function g(){var a;h&&(a=h.data("rsTimeout"))&&(h!==k&&h.css({opacity:0,display:"none",zIndex:0}),clearTimeout(a),h.data("rsTimeout",""));if(a=k.data("rsTimeout"))clearTimeout(a),k.data("rsTimeout","")}var d=this,h,k,l={};isNaN(d._c)&&(d._c=400);d._p=d._h3=b;d.ev.trigger("rsBeforeAnimStart");d._e?d._l?(d._c=parseInt(d._c,10),c=d._g+d._v1,l[d._g+d._u1]=d._c+"ms",l[c]=a?n.rsCSS3Easing[d.st.easeInOut]:
n.rsCSS3Easing[d.st.easeOut],d._p1.css(l),a||!d.hasTouch?setTimeout(function(){d._p3(b)},5):d._p3(b)):(d._c=d.st.transitionSpeed,h=d._g4,k=d._r1,k.data("rsTimeout")&&k.css("opacity",0),g(),h&&h.data("rsTimeout",setTimeout(function(){l[d._g+d._u1]="0ms";l.zIndex=0;l.display="none";h.data("rsTimeout","");h.css(l);setTimeout(function(){h.css("opacity",0)},16)},d._c+60)),l.display="block",l.zIndex=d._m,l.opacity=0,l[d._g+d._u1]="0ms",l[d._g+d._v1]=n.rsCSS3Easing[d.st.easeInOut],k.css(l),k.data("rsTimeout",
setTimeout(function(){k.css(d._g+d._u1,d._c+"ms");k.data("rsTimeout",setTimeout(function(){k.css("opacity",1);k.data("rsTimeout","")},20))},20))):d._l?(l[d._h?d._x1:d._w1]=b+"px",d._p1.animate(l,d._c,a?d.st.easeInOut:d.st.easeOut)):(h=d._g4,k=d._r1,k.stop(!0,!0).css({opacity:0,display:"block",zIndex:d._m}),d._c=d.st.transitionSpeed,k.animate({opacity:1},d._c,d.st.easeInOut),g(),h&&h.data("rsTimeout",setTimeout(function(){h.stop(!0,!0).css({opacity:0,display:"none",zIndex:0})},d._c+60)));d._r2=!0;
d.loadingTimeout&&clearTimeout(d.loadingTimeout);d.loadingTimeout=e?setTimeout(function(){d.loadingTimeout=null;e.call()},d._c+60):setTimeout(function(){d.loadingTimeout=null;d._k4(f)},d._c+60)},_u2:function(b){this._r2=!1;clearTimeout(this.loadingTimeout);if(this._l)if(!this._e)this._p1.stop(!0),this._p=parseInt(this._p1.css(this._x1),10);else{if(!b){b=this._p;var f=this._h3=this._l4();this._p1.css(this._g+this._u1,"0ms");b!==f&&this._p3(f)}}else 20<this._m?this._m=10:this._m++},_l4:function(){var b=
window.getComputedStyle(this._p1.get(0),null).getPropertyValue(this._g+"transform").replace(/^matrix\(/i,"").split(/, |\)$/g),f=0===b[0].indexOf("matrix3d");return parseInt(b[this._h?f?12:4:f?13:5],10)},_m4:function(b,f){return this._e?this._y1+(f?b+this._z1+0:0+this._z1+b)+this._a2:b},_k4:function(b){this._l||(this._r1.css("z-index",0),this._m=10);this._r2=!1;this.staticSlideId=this.currSlideId;this._n2();this._n4=!1;this.ev.trigger("rsAfterSlideChange")},_i4:function(b,f){var c=this,a=(-c._u-c._d1)*
c._w;if(0!==c.numSlides&&!c._r2)if(c.st.loopRewind)c.goTo("left"===b?c.numSlides-1:0,f);else if(c._l){c._c=200;var e=function(){c._r2=!1};c._x3(a+("left"===b?30:-30),"",!1,!0,function(){c._r2=!1;c._x3(a,"",!1,!0,e)})}},_q2:function(b,f){if(!b.isRendered){var c=b.content,a="rsMainSlideImage",e,g=this.st.imageAlignCenter,d=this.st.imageScaleMode,h;b.videoURL&&(a="rsVideoContainer","fill"!==d?e=!0:(h=c,h.hasClass(a)||(h=h.find("."+a)),h.css({width:"100%",height:"100%"}),a="rsMainSlideImage"));c.hasClass(a)||
(c=c.find("."+a));if(c){var k=b.iW,l=b.iH;b.isRendered=!0;if("none"!==d||g){a="fill"!==d?this._d4:0;h=this._b4-2*a;var n=this._c4-2*a,m,p,q={};"fit-if-smaller"===d&&(k>h||l>n)&&(d="fit");if("fill"===d||"fit"===d)m=h/k,p=n/l,m="fill"==d?m>p?m:p:"fit"==d?m<p?m:p:1,k=Math.ceil(k*m,10),l=Math.ceil(l*m,10);"none"!==d&&(q.width=k,q.height=l,e&&c.find(".rsImg").css({width:"100%",height:"100%"}));g&&(q.marginLeft=Math.floor((h-k)/2)+a,q.marginTop=Math.floor((n-l)/2)+a);c.css(q)}}}}};n.rsProto=u.prototype;
n.fn.royalSlider=function(b){var f=arguments;return this.each(function(){var c=n(this);if("object"!==typeof b&&b){if((c=c.data("royalSlider"))&&c[b])return c[b].apply(c,Array.prototype.slice.call(f,1))}else c.data("royalSlider")||c.data("royalSlider",new u(c,b))})};n.fn.royalSlider.defaults={slidesSpacing:8,startSlideId:0,loop:!1,loopRewind:!1,numImagesToPreload:4,fadeinLoadedSlide:!0,slidesOrientation:"horizontal",transitionType:"move",transitionSpeed:600,controlNavigation:"bullets",controlsInside:!0,
arrowsNav:!0,arrowsNavAutoHide:!0,navigateByClick:!0,randomizeSlides:!1,sliderDrag:!0,sliderTouch:!0,keyboardNavEnabled:!1,fadeInAfterLoaded:!0,allowCSS3:!0,allowCSS3OnWebkit:!0,addActiveClass:!1,autoHeight:!1,easeOut:"easeOutSine",easeInOut:"easeInOutSine",minSlideOffset:10,imageScaleMode:"fit-if-smaller",imageAlignCenter:!0,imageScalePadding:4,usePreloader:!0,autoScaleSlider:!1,autoScaleSliderWidth:800,autoScaleSliderHeight:400,autoScaleHeight:!0,arrowsNavHideOnTouch:!1,globalCaption:!1,slidesDiff:2};
n.rsCSS3Easing={easeOutSine:"cubic-bezier(0.390, 0.575, 0.565, 1.000)",easeInOutSine:"cubic-bezier(0.445, 0.050, 0.550, 0.950)"};n.extend(jQuery.easing,{easeInOutSine:function(b,f,c,a,e){return-a/2*(Math.cos(Math.PI*f/e)-1)+c},easeOutSine:function(b,f,c,a,e){return a*Math.sin(f/e*(Math.PI/2))+c},easeOutCubic:function(b,f,c,a,e){return a*((f=f/e-1)*f*f+1)+c}})})(jQuery,window);
// jquery.rs.bullets v1.0.1
(function(c){c.extend(c.rsProto,{_i5:function(){var a=this;"bullets"===a.st.controlNavigation&&(a.ev.one("rsAfterPropsSetup",function(){a._j5=!0;a.slider.addClass("rsWithBullets");for(var b='<div class="rsNav rsBullets">',e=0;e<a.numSlides;e++)b+='<div class="rsNavItem rsBullet"><span></span></div>';a._k5=b=c(b+"</div>");a._l5=b.appendTo(a.slider).children();a._k5.on("click.rs",".rsNavItem",function(b){a._m5||a.goTo(c(this).index())})}),a.ev.on("rsOnAppendSlide",function(b,c,d){d>=a.numSlides?a._k5.append('<div class="rsNavItem rsBullet"><span></span></div>'):
a._l5.eq(d).before('<div class="rsNavItem rsBullet"><span></span></div>');a._l5=a._k5.children()}),a.ev.on("rsOnRemoveSlide",function(b,c){var d=a._l5.eq(c);d&&d.length&&(d.remove(),a._l5=a._k5.children())}),a.ev.on("rsOnUpdateNav",function(){var b=a.currSlideId;a._n5&&a._n5.removeClass("rsNavSelected");b=a._l5.eq(b);b.addClass("rsNavSelected");a._n5=b}))}});c.rsModules.bullets=c.rsProto._i5})(jQuery);
// jquery.rs.thumbnails v1.0.8
(function(f){f.extend(f.rsProto,{_h6:function(){var a=this;"thumbnails"===a.st.controlNavigation&&(a._i6={drag:!0,touch:!0,orientation:"horizontal",navigation:!0,arrows:!0,arrowLeft:null,arrowRight:null,spacing:4,arrowsAutoHide:!1,appendSpan:!1,transitionSpeed:600,autoCenter:!0,fitInViewport:!0,firstMargin:!0,paddingTop:0,paddingBottom:0},a.st.thumbs=f.extend({},a._i6,a.st.thumbs),a._j6=!0,!1===a.st.thumbs.firstMargin?a.st.thumbs.firstMargin=0:!0===a.st.thumbs.firstMargin&&(a.st.thumbs.firstMargin=
a.st.thumbs.spacing),a.ev.on("rsBeforeParseNode",function(a,b,c){b=f(b);c.thumbnail=b.find(".rsTmb").remove();c.thumbnail.length?c.thumbnail=f(document.createElement("div")).append(c.thumbnail).html():(c.thumbnail=b.attr("data-rsTmb"),c.thumbnail||(c.thumbnail=b.find(".rsImg").attr("data-rsTmb")),c.thumbnail=c.thumbnail?'<img src="'+c.thumbnail+'"/>':"")}),a.ev.one("rsAfterPropsSetup",function(){a._k6()}),a._n5=null,a.ev.on("rsOnUpdateNav",function(){var e=f(a._l5[a.currSlideId]);e!==a._n5&&(a._n5&&
(a._n5.removeClass("rsNavSelected"),a._n5=null),a._l6&&a._m6(a.currSlideId),a._n5=e.addClass("rsNavSelected"))}),a.ev.on("rsOnAppendSlide",function(e,b,c){e="<div"+a._n6+' class="rsNavItem rsThumb">'+a._o6+b.thumbnail+"</div>";a._e&&a._s3.css(a._g+"transition-duration","0ms");c>=a.numSlides?a._s3.append(e):a._l5.eq(c).before(e);a._l5=a._s3.children();a.updateThumbsSize(!0)}),a.ev.on("rsOnRemoveSlide",function(e,b){var c=a._l5.eq(b);c&&(a._e&&a._s3.css(a._g+"transition-duration","0ms"),c.remove(),
a._l5=a._s3.children(),a.updateThumbsSize(!0))}))},_k6:function(){var a=this,e="rsThumbs",b=a.st.thumbs,c="",g,d,h=b.spacing;a._j5=!0;a._e3="vertical"===b.orientation?!1:!0;a._n6=g=h?' style="margin-'+(a._e3?"right":"bottom")+":"+h+'px;"':"";a._i3=0;a._p6=!1;a._m5=!1;a._l6=!1;a._q6=b.arrows&&b.navigation;d=a._e3?"Hor":"Ver";a.slider.addClass("rsWithThumbs rsWithThumbs"+d);c+='<div class="rsNav rsThumbs rsThumbs'+d+'"><div class="'+e+'Container">';a._o6=b.appendSpan?'<span class="thumbIco"></span>':
"";for(var k=0;k<a.numSlides;k++)d=a.slides[k],c+="<div"+g+' class="rsNavItem rsThumb">'+d.thumbnail+a._o6+"</div>";c=f(c+"</div></div>");g={};b.paddingTop&&(g[a._e3?"paddingTop":"paddingLeft"]=b.paddingTop);b.paddingBottom&&(g[a._e3?"paddingBottom":"paddingRight"]=b.paddingBottom);c.css(g);a._s3=f(c).find("."+e+"Container");a._q6&&(e+="Arrow",b.arrowLeft?a._r6=b.arrowLeft:(a._r6=f('<div class="'+e+" "+e+'Left"><div class="'+e+'Icn"></div></div>'),c.append(a._r6)),b.arrowRight?a._s6=b.arrowRight:
(a._s6=f('<div class="'+e+" "+e+'Right"><div class="'+e+'Icn"></div></div>'),c.append(a._s6)),a._r6.click(function(){var b=(Math.floor(a._i3/a._t6)+a._u6)*a._t6+a.st.thumbs.firstMargin;a._a4(b>a._n3?a._n3:b)}),a._s6.click(function(){var b=(Math.floor(a._i3/a._t6)-a._u6)*a._t6+a.st.thumbs.firstMargin;a._a4(b<a._o3?a._o3:b)}),b.arrowsAutoHide&&!a.hasTouch&&(a._r6.css("opacity",0),a._s6.css("opacity",0),c.one("mousemove.rsarrowshover",function(){a._l6&&(a._r6.css("opacity",1),a._s6.css("opacity",1))}),
c.hover(function(){a._l6&&(a._r6.css("opacity",1),a._s6.css("opacity",1))},function(){a._l6&&(a._r6.css("opacity",0),a._s6.css("opacity",0))})));a._k5=c;a._l5=a._s3.children();a.msEnabled&&a.st.thumbs.navigation&&a._s3.css("-ms-touch-action",a._e3?"pan-y":"pan-x");a.slider.append(c);a._w3=!0;a._v6=h;b.navigation&&a._e&&a._s3.css(a._g+"transition-property",a._g+"transform");a._k5.on("click.rs",".rsNavItem",function(b){a._m5||a.goTo(f(this).index())});a.ev.off("rsBeforeSizeSet.thumbs").on("rsBeforeSizeSet.thumbs",
function(){a._w6=a._e3?a._c4:a._b4;a.updateThumbsSize(!0)});a.ev.off("rsAutoHeightChange.thumbs").on("rsAutoHeightChange.thumbs",function(b,c){a.updateThumbsSize(!0,c)})},updateThumbsSize:function(a,e){var b=this,c=b._l5.first(),f={},d=b._l5.length;b._t6=(b._e3?c.outerWidth():c.outerHeight())+b._v6;b._y3=d*b._t6-b._v6;f[b._e3?"width":"height"]=b._y3+b._v6;b._z3=b._e3?b._k5.width():void 0!==e?e:b._k5.height();b._w3&&(b.isFullscreen||b.st.thumbs.fitInViewport)&&(b._e3?b._c4=b._w6-b._k5.outerHeight():
b._b4=b._w6-b._k5.outerWidth());b._z3&&(b._o3=-(b._y3-b._z3)-b.st.thumbs.firstMargin,b._n3=b.st.thumbs.firstMargin,b._u6=Math.floor(b._z3/b._t6),b._y3<b._z3?(b.st.thumbs.autoCenter?b._q3((b._z3-b._y3)/2):b._q3(b._n3),b.st.thumbs.arrows&&b._r6&&(b._r6.addClass("rsThumbsArrowDisabled"),b._s6.addClass("rsThumbsArrowDisabled")),b._l6=!1,b._m5=!1,b._k5.off(b._j1)):b.st.thumbs.navigation&&!b._l6&&(b._l6=!0,!b.hasTouch&&b.st.thumbs.drag||b.hasTouch&&b.st.thumbs.touch)&&(b._m5=!0,b._k5.on(b._j1,function(a){b._g2(a,
!0)})),b._s3.css(f),a&&e&&b._m6(b.currSlideId,!0))},setThumbsOrientation:function(a,e){this._w3&&(this.st.thumbs.orientation=a,this._k5.remove(),this.slider.removeClass("rsWithThumbsHor rsWithThumbsVer"),this._k6(),this._k5.off(this._j1),e||this.updateSliderSize(!0))},_q3:function(a){this._i3=a;this._e?this._s3.css(this._x1,this._y1+(this._e3?a+this._z1+0:0+this._z1+a)+this._a2):this._s3.css(this._e3?this._x1:this._w1,a)},_a4:function(a,e,b,c,g){var d=this;if(d._l6){e||(e=d.st.thumbs.transitionSpeed);
d._i3=a;d._x6&&clearTimeout(d._x6);d._p6&&(d._e||d._s3.stop(),b=!0);var h={};d._p6=!0;d._e?(h[d._g+"transition-duration"]=e+"ms",h[d._g+"transition-timing-function"]=b?f.rsCSS3Easing[d.st.easeOut]:f.rsCSS3Easing[d.st.easeInOut],d._s3.css(h),d._q3(a)):(h[d._e3?d._x1:d._w1]=a+"px",d._s3.animate(h,e,b?"easeOutCubic":d.st.easeInOut));c&&(d._i3=c);d._y6();d._x6=setTimeout(function(){d._p6=!1;g&&(d._a4(c,g,!0),g=null)},e)}},_y6:function(){this._q6&&(this._i3===this._n3?this._r6.addClass("rsThumbsArrowDisabled"):
this._r6.removeClass("rsThumbsArrowDisabled"),this._i3===this._o3?this._s6.addClass("rsThumbsArrowDisabled"):this._s6.removeClass("rsThumbsArrowDisabled"))},_m6:function(a,e){var b=0,c,f=a*this._t6+2*this._t6-this._v6+this._n3,d=Math.floor(this._i3/this._t6);this._l6&&(this._j6&&(e=!0,this._j6=!1),f+this._i3>this._z3?(a===this.numSlides-1&&(b=1),d=-a+this._u6-2+b,c=d*this._t6+this._z3%this._t6+this._v6-this._n3):0!==a?(a-1)*this._t6<=-this._i3+this._n3&&a-1<=this.numSlides-this._u6&&(c=(-a+1)*this._t6+
this._n3):c=this._n3,c!==this._i3&&(b=void 0===c?this._i3:c,b>this._n3?this._q3(this._n3):b<this._o3?this._q3(this._o3):void 0!==c&&(e?this._q3(c):this._a4(c))),this._y6())}});f.rsModules.thumbnails=f.rsProto._h6})(jQuery);
// jquery.rs.autoplay v1.0.5
(function(b){b.extend(b.rsProto,{_x4:function(){var a=this,d;a._y4={enabled:!1,stopAtAction:!0,pauseOnHover:!0,delay:2E3};!a.st.autoPlay&&a.st.autoplay&&(a.st.autoPlay=a.st.autoplay);a.st.autoPlay=b.extend({},a._y4,a.st.autoPlay);a.st.autoPlay.enabled&&(a.ev.on("rsBeforeParseNode",function(a,c,f){c=b(c);if(d=c.attr("data-rsDelay"))f.customDelay=parseInt(d,10)}),a.ev.one("rsAfterInit",function(){a._z4()}),a.ev.on("rsBeforeDestroy",function(){a.stopAutoPlay();a.slider.off("mouseenter mouseleave");b(window).off("blur"+
a.ns+" focus"+a.ns)}))},_z4:function(){var a=this;a.startAutoPlay();a.ev.on("rsAfterContentSet",function(b,e){a._l2||a._r2||!a._a5||e!==a.currSlide||a._b5()});a.ev.on("rsDragRelease",function(){a._a5&&a._c5&&(a._c5=!1,a._b5())});a.ev.on("rsAfterSlideChange",function(){a._a5&&a._c5&&(a._c5=!1,a.currSlide.isLoaded&&a._b5())});a.ev.on("rsDragStart",function(){a._a5&&(a.st.autoPlay.stopAtAction?a.stopAutoPlay():(a._c5=!0,a._d5()))});a.ev.on("rsBeforeMove",function(b,e,c){a._a5&&(c&&a.st.autoPlay.stopAtAction?
a.stopAutoPlay():(a._c5=!0,a._d5()))});a._e5=!1;a.ev.on("rsVideoStop",function(){a._a5&&(a._e5=!1,a._b5())});a.ev.on("rsVideoPlay",function(){a._a5&&(a._c5=!1,a._d5(),a._e5=!0)});b(window).on("blur"+a.ns,function(){a._a5&&(a._c5=!0,a._d5())}).on("focus"+a.ns,function(){a._a5&&a._c5&&(a._c5=!1,a._b5())});a.st.autoPlay.pauseOnHover&&(a._f5=!1,a.slider.hover(function(){a._a5&&(a._c5=!1,a._d5(),a._f5=!0)},function(){a._a5&&(a._f5=!1,a._b5())}))},toggleAutoPlay:function(){this._a5?this.stopAutoPlay():
this.startAutoPlay()},startAutoPlay:function(){this._a5=!0;this.currSlide.isLoaded&&this._b5()},stopAutoPlay:function(){this._e5=this._f5=this._c5=this._a5=!1;this._d5()},_b5:function(){var a=this;a._f5||a._e5||(a._g5=!0,a._h5&&clearTimeout(a._h5),a._h5=setTimeout(function(){var b;a._z||a.st.loopRewind||(b=!0,a.st.loopRewind=!0);a.next(!0);b&&(a.st.loopRewind=!1)},a.currSlide.customDelay?a.currSlide.customDelay:a.st.autoPlay.delay))},_d5:function(){this._f5||this._e5||(this._g5=!1,this._h5&&(clearTimeout(this._h5),
this._h5=null))}});b.rsModules.autoplay=b.rsProto._x4})(jQuery);
// jquery.rs.video v1.1.3
(function(f){f.extend(f.rsProto,{_z6:function(){var a=this;a._a7={autoHideArrows:!0,autoHideControlNav:!1,autoHideBlocks:!1,autoHideCaption:!1,disableCSS3inFF:!0,youTubeCode:'<iframe src="http://www.youtube.com/embed/%id%?rel=1&showinfo=0&autoplay=1&wmode=transparent" frameborder="no"></iframe>',vimeoCode:'<iframe src="http://player.vimeo.com/video/%id%?byline=0&portrait=0&autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'};a.st.video=f.extend({},a._a7,
a.st.video);a.ev.on("rsBeforeSizeSet",function(){a._b7&&setTimeout(function(){var b=a._r1,b=b.hasClass("rsVideoContainer")?b:b.find(".rsVideoContainer");a._c7&&a._c7.css({width:b.width(),height:b.height()})},32)});var d=a._a.mozilla;a.ev.on("rsAfterParseNode",function(b,c,e){b=f(c);if(e.videoURL){a.st.video.disableCSS3inFF&&d&&(a._e=a._f=!1);c=f('<div class="rsVideoContainer"></div>');var g=f('<div class="rsBtnCenterer"><div class="rsPlayBtn"><div class="rsPlayBtnIcon"></div></div></div>');b.hasClass("rsImg")?
e.content=c.append(b).append(g):e.content.find(".rsImg").wrap(c).after(g)}});a.ev.on("rsAfterSlideChange",function(){a.stopVideo()})},toggleVideo:function(){return this._b7?this.stopVideo():this.playVideo()},playVideo:function(){var a=this;if(!a._b7){var d=a.currSlide;if(!d.videoURL)return!1;a._d7=d;var b=a._e7=d.content,d=d.videoURL,c,e;d.match(/youtu\.be/i)||d.match(/youtube\.com/i)?(e=/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/,(e=d.match(e))&&11==e[7].length&&
(c=e[7]),void 0!==c&&(a._c7=a.st.video.youTubeCode.replace("%id%",c))):d.match(/vimeo\.com/i)&&(e=/(www\.)?vimeo.com\/(\d+)($|\/)/,(e=d.match(e))&&(c=e[2]),void 0!==c&&(a._c7=a.st.video.vimeoCode.replace("%id%",c)));a.videoObj=f(a._c7);a.ev.trigger("rsOnCreateVideoElement",[d]);a.videoObj.length&&(a._c7=f('<div class="rsVideoFrameHolder"><div class="rsPreloader"></div><div class="rsCloseVideoBtn"><div class="rsCloseVideoIcn"></div></div></div>'),a._c7.find(".rsPreloader").after(a.videoObj),b=b.hasClass("rsVideoContainer")?
b:b.find(".rsVideoContainer"),a._c7.css({width:b.width(),height:b.height()}).find(".rsCloseVideoBtn").off("click.rsv").on("click.rsv",function(b){a.stopVideo();b.preventDefault();b.stopPropagation();return!1}),b.append(a._c7),a.isIPAD&&b.addClass("rsIOSVideo"),a._f7(!1),setTimeout(function(){a._c7.addClass("rsVideoActive")},10),a.ev.trigger("rsVideoPlay"),a._b7=!0);return!0}return!1},stopVideo:function(){var a=this;return a._b7?(a.isIPAD&&a.slider.find(".rsCloseVideoBtn").remove(),a._f7(!0),setTimeout(function(){a.ev.trigger("rsOnDestroyVideoElement",
[a.videoObj]);var d=a._c7.find("iframe");if(d.length)try{d.attr("src","")}catch(b){}a._c7.remove();a._c7=null},16),a.ev.trigger("rsVideoStop"),a._b7=!1,!0):!1},_f7:function(a,d){var b=[],c=this.st.video;c.autoHideArrows&&(this._c2&&(b.push(this._c2,this._d2),this._e2=!a),this._v5&&b.push(this._v5));c.autoHideControlNav&&this._k5&&b.push(this._k5);c.autoHideBlocks&&this._d7.animBlocks&&b.push(this._d7.animBlocks);c.autoHideCaption&&this.globalCaption&&b.push(this.globalCaption);this.slider[a?"removeClass":
"addClass"]("rsVideoPlaying");if(b.length)for(c=0;c<b.length;c++)a?b[c].removeClass("rsHidden"):b[c].addClass("rsHidden")}});f.rsModules.video=f.rsProto._z6})(jQuery);
// jquery.rs.auto-height v1.0.3
(function(b){b.extend(b.rsProto,{_w4:function(){var a=this;if(a.st.autoHeight){var b,c,e,f=!0,d=function(d){e=a.slides[a.currSlideId];(b=e.holder)&&(c=b.height())&&void 0!==c&&c>(a.st.minAutoHeight||30)&&(a._c4=c,a._e||!d?a._e1.css("height",c):a._e1.stop(!0,!0).animate({height:c},a.st.transitionSpeed),a.ev.trigger("rsAutoHeightChange",c),f&&(a._e&&setTimeout(function(){a._e1.css(a._g+"transition","height "+a.st.transitionSpeed+"ms ease-in-out")},16),f=!1))};a.ev.on("rsMaybeSizeReady.rsAutoHeight",
function(a,b){e===b&&d()});a.ev.on("rsAfterContentSet.rsAutoHeight",function(a,b){e===b&&d()});a.slider.addClass("rsAutoHeight");a.ev.one("rsAfterInit",function(){setTimeout(function(){d(!1);setTimeout(function(){a.slider.append('<div style="clear:both; float: none;"></div>')},16)},16)});a.ev.on("rsBeforeAnimStart",function(){d(!0)});a.ev.on("rsBeforeSizeSet",function(){setTimeout(function(){d(!1)},16)})}}});b.rsModules.autoHeight=b.rsProto._w4})(jQuery);
// jquery.rs.active-class v1.0.1
(function(c){c.rsProto._o4=function(){var b,a=this;if(a.st.addActiveClass)a.ev.on("rsOnUpdateNav",function(){b&&clearTimeout(b);b=setTimeout(function(){a._g4&&a._g4.removeClass("rsActiveSlide");a._r1&&a._r1.addClass("rsActiveSlide");b=null},50)})};c.rsModules.activeClass=c.rsProto._o4})(jQuery);

;
/**
 * Copyright (c) 2007-2013 Ariel Flesler - aflesler<a>gmail<d>com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * @author Ariel Flesler
 * @version 1.4.6
 */
;(function($){var h=$.scrollTo=function(a,b,c){$(window).scrollTo(a,b,c)};h.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};h.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(e,f,g){if(typeof f=='object'){g=f;f=0}if(typeof g=='function')g={onAfter:g};if(e=='max')e=9e9;g=$.extend({},h.defaults,g);f=f||g.duration;g.queue=g.queue&&g.axis.length>1;if(g.queue)f/=2;g.offset=both(g.offset);g.over=both(g.over);return this._scrollable().each(function(){if(e==null)return;var d=this,$elem=$(d),targ=e,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}$.each(g.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=h.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(g.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=g.offset[pos]||0;if(g.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*g.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(g.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&g.queue){if(old!=attr[key])animate(g.onAfterFirst);delete attr[key]}});animate(g.onAfter);function animate(a){$elem.animate(attr,f,g.easing,a&&function(){a.call(this,targ,g)})}}).end()};h.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);
;
/*!
 * Isotope PACKAGED v2.0.0
 * Filter & sort magical layouts
 * http://isotope.metafizzy.co
 */

(function(t){function e(){}function i(t){function i(e){e.prototype.option||(e.prototype.option=function(e){t.isPlainObject(e)&&(this.options=t.extend(!0,this.options,e))})}function n(e,i){t.fn[e]=function(n){if("string"==typeof n){for(var s=o.call(arguments,1),a=0,u=this.length;u>a;a++){var p=this[a],h=t.data(p,e);if(h)if(t.isFunction(h[n])&&"_"!==n.charAt(0)){var f=h[n].apply(h,s);if(void 0!==f)return f}else r("no such method '"+n+"' for "+e+" instance");else r("cannot call methods on "+e+" prior to initialization; "+"attempted to call '"+n+"'")}return this}return this.each(function(){var o=t.data(this,e);o?(o.option(n),o._init()):(o=new i(this,n),t.data(this,e,o))})}}if(t){var r="undefined"==typeof console?e:function(t){console.error(t)};return t.bridget=function(t,e){i(e),n(t,e)},t.bridget}}var o=Array.prototype.slice;"function"==typeof define&&define.amd?define("jquery-bridget/jquery.bridget",["jquery"],i):i(t.jQuery)})(window),function(t){function e(e){var i=t.event;return i.target=i.target||i.srcElement||e,i}var i=document.documentElement,o=function(){};i.addEventListener?o=function(t,e,i){t.addEventListener(e,i,!1)}:i.attachEvent&&(o=function(t,i,o){t[i+o]=o.handleEvent?function(){var i=e(t);o.handleEvent.call(o,i)}:function(){var i=e(t);o.call(t,i)},t.attachEvent("on"+i,t[i+o])});var n=function(){};i.removeEventListener?n=function(t,e,i){t.removeEventListener(e,i,!1)}:i.detachEvent&&(n=function(t,e,i){t.detachEvent("on"+e,t[e+i]);try{delete t[e+i]}catch(o){t[e+i]=void 0}});var r={bind:o,unbind:n};"function"==typeof define&&define.amd?define("eventie/eventie",r):"object"==typeof exports?module.exports=r:t.eventie=r}(this),function(t){function e(t){"function"==typeof t&&(e.isReady?t():r.push(t))}function i(t){var i="readystatechange"===t.type&&"complete"!==n.readyState;if(!e.isReady&&!i){e.isReady=!0;for(var o=0,s=r.length;s>o;o++){var a=r[o];a()}}}function o(o){return o.bind(n,"DOMContentLoaded",i),o.bind(n,"readystatechange",i),o.bind(t,"load",i),e}var n=t.document,r=[];e.isReady=!1,"function"==typeof define&&define.amd?(e.isReady="function"==typeof requirejs,define("doc-ready/doc-ready",["eventie/eventie"],o)):t.docReady=o(t.eventie)}(this),function(){function t(){}function e(t,e){for(var i=t.length;i--;)if(t[i].listener===e)return i;return-1}function i(t){return function(){return this[t].apply(this,arguments)}}var o=t.prototype,n=this,r=n.EventEmitter;o.getListeners=function(t){var e,i,o=this._getEvents();if(t instanceof RegExp){e={};for(i in o)o.hasOwnProperty(i)&&t.test(i)&&(e[i]=o[i])}else e=o[t]||(o[t]=[]);return e},o.flattenListeners=function(t){var e,i=[];for(e=0;t.length>e;e+=1)i.push(t[e].listener);return i},o.getListenersAsObject=function(t){var e,i=this.getListeners(t);return i instanceof Array&&(e={},e[t]=i),e||i},o.addListener=function(t,i){var o,n=this.getListenersAsObject(t),r="object"==typeof i;for(o in n)n.hasOwnProperty(o)&&-1===e(n[o],i)&&n[o].push(r?i:{listener:i,once:!1});return this},o.on=i("addListener"),o.addOnceListener=function(t,e){return this.addListener(t,{listener:e,once:!0})},o.once=i("addOnceListener"),o.defineEvent=function(t){return this.getListeners(t),this},o.defineEvents=function(t){for(var e=0;t.length>e;e+=1)this.defineEvent(t[e]);return this},o.removeListener=function(t,i){var o,n,r=this.getListenersAsObject(t);for(n in r)r.hasOwnProperty(n)&&(o=e(r[n],i),-1!==o&&r[n].splice(o,1));return this},o.off=i("removeListener"),o.addListeners=function(t,e){return this.manipulateListeners(!1,t,e)},o.removeListeners=function(t,e){return this.manipulateListeners(!0,t,e)},o.manipulateListeners=function(t,e,i){var o,n,r=t?this.removeListener:this.addListener,s=t?this.removeListeners:this.addListeners;if("object"!=typeof e||e instanceof RegExp)for(o=i.length;o--;)r.call(this,e,i[o]);else for(o in e)e.hasOwnProperty(o)&&(n=e[o])&&("function"==typeof n?r.call(this,o,n):s.call(this,o,n));return this},o.removeEvent=function(t){var e,i=typeof t,o=this._getEvents();if("string"===i)delete o[t];else if(t instanceof RegExp)for(e in o)o.hasOwnProperty(e)&&t.test(e)&&delete o[e];else delete this._events;return this},o.removeAllListeners=i("removeEvent"),o.emitEvent=function(t,e){var i,o,n,r,s=this.getListenersAsObject(t);for(n in s)if(s.hasOwnProperty(n))for(o=s[n].length;o--;)i=s[n][o],i.once===!0&&this.removeListener(t,i.listener),r=i.listener.apply(this,e||[]),r===this._getOnceReturnValue()&&this.removeListener(t,i.listener);return this},o.trigger=i("emitEvent"),o.emit=function(t){var e=Array.prototype.slice.call(arguments,1);return this.emitEvent(t,e)},o.setOnceReturnValue=function(t){return this._onceReturnValue=t,this},o._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},o._getEvents=function(){return this._events||(this._events={})},t.noConflict=function(){return n.EventEmitter=r,t},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return t}):"object"==typeof module&&module.exports?module.exports=t:this.EventEmitter=t}.call(this),function(t){function e(t){if(t){if("string"==typeof o[t])return t;t=t.charAt(0).toUpperCase()+t.slice(1);for(var e,n=0,r=i.length;r>n;n++)if(e=i[n]+t,"string"==typeof o[e])return e}}var i="Webkit Moz ms Ms O".split(" "),o=document.documentElement.style;"function"==typeof define&&define.amd?define("get-style-property/get-style-property",[],function(){return e}):"object"==typeof exports?module.exports=e:t.getStyleProperty=e}(window),function(t){function e(t){var e=parseFloat(t),i=-1===t.indexOf("%")&&!isNaN(e);return i&&e}function i(){for(var t={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0},e=0,i=s.length;i>e;e++){var o=s[e];t[o]=0}return t}function o(t){function o(t){if("string"==typeof t&&(t=document.querySelector(t)),t&&"object"==typeof t&&t.nodeType){var o=r(t);if("none"===o.display)return i();var n={};n.width=t.offsetWidth,n.height=t.offsetHeight;for(var h=n.isBorderBox=!(!p||!o[p]||"border-box"!==o[p]),f=0,c=s.length;c>f;f++){var d=s[f],l=o[d];l=a(t,l);var y=parseFloat(l);n[d]=isNaN(y)?0:y}var m=n.paddingLeft+n.paddingRight,g=n.paddingTop+n.paddingBottom,v=n.marginLeft+n.marginRight,_=n.marginTop+n.marginBottom,I=n.borderLeftWidth+n.borderRightWidth,L=n.borderTopWidth+n.borderBottomWidth,z=h&&u,S=e(o.width);S!==!1&&(n.width=S+(z?0:m+I));var b=e(o.height);return b!==!1&&(n.height=b+(z?0:g+L)),n.innerWidth=n.width-(m+I),n.innerHeight=n.height-(g+L),n.outerWidth=n.width+v,n.outerHeight=n.height+_,n}}function a(t,e){if(n||-1===e.indexOf("%"))return e;var i=t.style,o=i.left,r=t.runtimeStyle,s=r&&r.left;return s&&(r.left=t.currentStyle.left),i.left=e,e=i.pixelLeft,i.left=o,s&&(r.left=s),e}var u,p=t("boxSizing");return function(){if(p){var t=document.createElement("div");t.style.width="200px",t.style.padding="1px 2px 3px 4px",t.style.borderStyle="solid",t.style.borderWidth="1px 2px 3px 4px",t.style[p]="border-box";var i=document.body||document.documentElement;i.appendChild(t);var o=r(t);u=200===e(o.width),i.removeChild(t)}}(),o}var n=t.getComputedStyle,r=n?function(t){return n(t,null)}:function(t){return t.currentStyle},s=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"];"function"==typeof define&&define.amd?define("get-size/get-size",["get-style-property/get-style-property"],o):"object"==typeof exports?module.exports=o(require("get-style-property")):t.getSize=o(t.getStyleProperty)}(window),function(t,e){function i(t,e){return t[a](e)}function o(t){if(!t.parentNode){var e=document.createDocumentFragment();e.appendChild(t)}}function n(t,e){o(t);for(var i=t.parentNode.querySelectorAll(e),n=0,r=i.length;r>n;n++)if(i[n]===t)return!0;return!1}function r(t,e){return o(t),i(t,e)}var s,a=function(){if(e.matchesSelector)return"matchesSelector";for(var t=["webkit","moz","ms","o"],i=0,o=t.length;o>i;i++){var n=t[i],r=n+"MatchesSelector";if(e[r])return r}}();if(a){var u=document.createElement("div"),p=i(u,"div");s=p?i:r}else s=n;"function"==typeof define&&define.amd?define("matches-selector/matches-selector",[],function(){return s}):window.matchesSelector=s}(this,Element.prototype),function(t){function e(t,e){for(var i in e)t[i]=e[i];return t}function i(t){for(var e in t)return!1;return e=null,!0}function o(t){return t.replace(/([A-Z])/g,function(t){return"-"+t.toLowerCase()})}function n(t,n,r){function a(t,e){t&&(this.element=t,this.layout=e,this.position={x:0,y:0},this._create())}var u=r("transition"),p=r("transform"),h=u&&p,f=!!r("perspective"),c={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"otransitionend",transition:"transitionend"}[u],d=["transform","transition","transitionDuration","transitionProperty"],l=function(){for(var t={},e=0,i=d.length;i>e;e++){var o=d[e],n=r(o);n&&n!==o&&(t[o]=n)}return t}();e(a.prototype,t.prototype),a.prototype._create=function(){this._transn={ingProperties:{},clean:{},onEnd:{}},this.css({position:"absolute"})},a.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},a.prototype.getSize=function(){this.size=n(this.element)},a.prototype.css=function(t){var e=this.element.style;for(var i in t){var o=l[i]||i;e[o]=t[i]}},a.prototype.getPosition=function(){var t=s(this.element),e=this.layout.options,i=e.isOriginLeft,o=e.isOriginTop,n=parseInt(t[i?"left":"right"],10),r=parseInt(t[o?"top":"bottom"],10);n=isNaN(n)?0:n,r=isNaN(r)?0:r;var a=this.layout.size;n-=i?a.paddingLeft:a.paddingRight,r-=o?a.paddingTop:a.paddingBottom,this.position.x=n,this.position.y=r},a.prototype.layoutPosition=function(){var t=this.layout.size,e=this.layout.options,i={};e.isOriginLeft?(i.left=this.position.x+t.paddingLeft+"px",i.right=""):(i.right=this.position.x+t.paddingRight+"px",i.left=""),e.isOriginTop?(i.top=this.position.y+t.paddingTop+"px",i.bottom=""):(i.bottom=this.position.y+t.paddingBottom+"px",i.top=""),this.css(i),this.emitEvent("layout",[this])};var y=f?function(t,e){return"translate3d("+t+"px, "+e+"px, 0)"}:function(t,e){return"translate("+t+"px, "+e+"px)"};a.prototype._transitionTo=function(t,e){this.getPosition();var i=this.position.x,o=this.position.y,n=parseInt(t,10),r=parseInt(e,10),s=n===this.position.x&&r===this.position.y;if(this.setPosition(t,e),s&&!this.isTransitioning)return this.layoutPosition(),void 0;var a=t-i,u=e-o,p={},h=this.layout.options;a=h.isOriginLeft?a:-a,u=h.isOriginTop?u:-u,p.transform=y(a,u),this.transition({to:p,onTransitionEnd:{transform:this.layoutPosition},isCleaning:!0})},a.prototype.goTo=function(t,e){this.setPosition(t,e),this.layoutPosition()},a.prototype.moveTo=h?a.prototype._transitionTo:a.prototype.goTo,a.prototype.setPosition=function(t,e){this.position.x=parseInt(t,10),this.position.y=parseInt(e,10)},a.prototype._nonTransition=function(t){this.css(t.to),t.isCleaning&&this._removeStyles(t.to);for(var e in t.onTransitionEnd)t.onTransitionEnd[e].call(this)},a.prototype._transition=function(t){if(!parseFloat(this.layout.options.transitionDuration))return this._nonTransition(t),void 0;var e=this._transn;for(var i in t.onTransitionEnd)e.onEnd[i]=t.onTransitionEnd[i];for(i in t.to)e.ingProperties[i]=!0,t.isCleaning&&(e.clean[i]=!0);if(t.from){this.css(t.from);var o=this.element.offsetHeight;o=null}this.enableTransition(t.to),this.css(t.to),this.isTransitioning=!0};var m=p&&o(p)+",opacity";a.prototype.enableTransition=function(){this.isTransitioning||(this.css({transitionProperty:m,transitionDuration:this.layout.options.transitionDuration}),this.element.addEventListener(c,this,!1))},a.prototype.transition=a.prototype[u?"_transition":"_nonTransition"],a.prototype.onwebkitTransitionEnd=function(t){this.ontransitionend(t)},a.prototype.onotransitionend=function(t){this.ontransitionend(t)};var g={"-webkit-transform":"transform","-moz-transform":"transform","-o-transform":"transform"};a.prototype.ontransitionend=function(t){if(t.target===this.element){var e=this._transn,o=g[t.propertyName]||t.propertyName;if(delete e.ingProperties[o],i(e.ingProperties)&&this.disableTransition(),o in e.clean&&(this.element.style[t.propertyName]="",delete e.clean[o]),o in e.onEnd){var n=e.onEnd[o];n.call(this),delete e.onEnd[o]}this.emitEvent("transitionEnd",[this])}},a.prototype.disableTransition=function(){this.removeTransitionStyles(),this.element.removeEventListener(c,this,!1),this.isTransitioning=!1},a.prototype._removeStyles=function(t){var e={};for(var i in t)e[i]="";this.css(e)};var v={transitionProperty:"",transitionDuration:""};return a.prototype.removeTransitionStyles=function(){this.css(v)},a.prototype.removeElem=function(){this.element.parentNode.removeChild(this.element),this.emitEvent("remove",[this])},a.prototype.remove=function(){if(!u||!parseFloat(this.layout.options.transitionDuration))return this.removeElem(),void 0;var t=this;this.on("transitionEnd",function(){return t.removeElem(),!0}),this.hide()},a.prototype.reveal=function(){delete this.isHidden,this.css({display:""});var t=this.layout.options;this.transition({from:t.hiddenStyle,to:t.visibleStyle,isCleaning:!0})},a.prototype.hide=function(){this.isHidden=!0,this.css({display:""});var t=this.layout.options;this.transition({from:t.visibleStyle,to:t.hiddenStyle,isCleaning:!0,onTransitionEnd:{opacity:function(){this.isHidden&&this.css({display:"none"})}}})},a.prototype.destroy=function(){this.css({position:"",left:"",right:"",top:"",bottom:"",transition:"",transform:""})},a}var r=t.getComputedStyle,s=r?function(t){return r(t,null)}:function(t){return t.currentStyle};"function"==typeof define&&define.amd?define("outlayer/item",["eventEmitter/EventEmitter","get-size/get-size","get-style-property/get-style-property"],n):(t.Outlayer={},t.Outlayer.Item=n(t.EventEmitter,t.getSize,t.getStyleProperty))}(window),function(t){function e(t,e){for(var i in e)t[i]=e[i];return t}function i(t){return"[object Array]"===f.call(t)}function o(t){var e=[];if(i(t))e=t;else if(t&&"number"==typeof t.length)for(var o=0,n=t.length;n>o;o++)e.push(t[o]);else e.push(t);return e}function n(t,e){var i=d(e,t);-1!==i&&e.splice(i,1)}function r(t){return t.replace(/(.)([A-Z])/g,function(t,e,i){return e+"-"+i}).toLowerCase()}function s(i,s,f,d,l,y){function m(t,i){if("string"==typeof t&&(t=a.querySelector(t)),!t||!c(t))return u&&u.error("Bad "+this.constructor.namespace+" element: "+t),void 0;this.element=t,this.options=e({},this.constructor.defaults),this.option(i);var o=++g;this.element.outlayerGUID=o,v[o]=this,this._create(),this.options.isInitLayout&&this.layout()}var g=0,v={};return m.namespace="outlayer",m.Item=y,m.defaults={containerStyle:{position:"relative"},isInitLayout:!0,isOriginLeft:!0,isOriginTop:!0,isResizeBound:!0,isResizingContainer:!0,transitionDuration:"0.4s",hiddenStyle:{opacity:0,transform:"scale(0.001)"},visibleStyle:{opacity:1,transform:"scale(1)"}},e(m.prototype,f.prototype),m.prototype.option=function(t){e(this.options,t)},m.prototype._create=function(){this.reloadItems(),this.stamps=[],this.stamp(this.options.stamp),e(this.element.style,this.options.containerStyle),this.options.isResizeBound&&this.bindResize()},m.prototype.reloadItems=function(){this.items=this._itemize(this.element.children)},m.prototype._itemize=function(t){for(var e=this._filterFindItemElements(t),i=this.constructor.Item,o=[],n=0,r=e.length;r>n;n++){var s=e[n],a=new i(s,this);o.push(a)}return o},m.prototype._filterFindItemElements=function(t){t=o(t);for(var e=this.options.itemSelector,i=[],n=0,r=t.length;r>n;n++){var s=t[n];if(c(s))if(e){l(s,e)&&i.push(s);for(var a=s.querySelectorAll(e),u=0,p=a.length;p>u;u++)i.push(a[u])}else i.push(s)}return i},m.prototype.getItemElements=function(){for(var t=[],e=0,i=this.items.length;i>e;e++)t.push(this.items[e].element);return t},m.prototype.layout=function(){this._resetLayout(),this._manageStamps();var t=void 0!==this.options.isLayoutInstant?this.options.isLayoutInstant:!this._isLayoutInited;this.layoutItems(this.items,t),this._isLayoutInited=!0},m.prototype._init=m.prototype.layout,m.prototype._resetLayout=function(){this.getSize()},m.prototype.getSize=function(){this.size=d(this.element)},m.prototype._getMeasurement=function(t,e){var i,o=this.options[t];o?("string"==typeof o?i=this.element.querySelector(o):c(o)&&(i=o),this[t]=i?d(i)[e]:o):this[t]=0},m.prototype.layoutItems=function(t,e){t=this._getItemsForLayout(t),this._layoutItems(t,e),this._postLayout()},m.prototype._getItemsForLayout=function(t){for(var e=[],i=0,o=t.length;o>i;i++){var n=t[i];n.isIgnored||e.push(n)}return e},m.prototype._layoutItems=function(t,e){function i(){o.emitEvent("layoutComplete",[o,t])}var o=this;if(!t||!t.length)return i(),void 0;this._itemsOn(t,"layout",i);for(var n=[],r=0,s=t.length;s>r;r++){var a=t[r],u=this._getItemLayoutPosition(a);u.item=a,u.isInstant=e||a.isLayoutInstant,n.push(u)}this._processLayoutQueue(n)},m.prototype._getItemLayoutPosition=function(){return{x:0,y:0}},m.prototype._processLayoutQueue=function(t){for(var e=0,i=t.length;i>e;e++){var o=t[e];this._positionItem(o.item,o.x,o.y,o.isInstant)}},m.prototype._positionItem=function(t,e,i,o){o?t.goTo(e,i):t.moveTo(e,i)},m.prototype._postLayout=function(){this.resizeContainer()},m.prototype.resizeContainer=function(){if(this.options.isResizingContainer){var t=this._getContainerSize();t&&(this._setContainerMeasure(t.width,!0),this._setContainerMeasure(t.height,!1))}},m.prototype._getContainerSize=h,m.prototype._setContainerMeasure=function(t,e){if(void 0!==t){var i=this.size;i.isBorderBox&&(t+=e?i.paddingLeft+i.paddingRight+i.borderLeftWidth+i.borderRightWidth:i.paddingBottom+i.paddingTop+i.borderTopWidth+i.borderBottomWidth),t=Math.max(t,0),this.element.style[e?"width":"height"]=t+"px"}},m.prototype._itemsOn=function(t,e,i){function o(){return n++,n===r&&i.call(s),!0}for(var n=0,r=t.length,s=this,a=0,u=t.length;u>a;a++){var p=t[a];p.on(e,o)}},m.prototype.ignore=function(t){var e=this.getItem(t);e&&(e.isIgnored=!0)},m.prototype.unignore=function(t){var e=this.getItem(t);e&&delete e.isIgnored},m.prototype.stamp=function(t){if(t=this._find(t)){this.stamps=this.stamps.concat(t);for(var e=0,i=t.length;i>e;e++){var o=t[e];this.ignore(o)}}},m.prototype.unstamp=function(t){if(t=this._find(t))for(var e=0,i=t.length;i>e;e++){var o=t[e];n(o,this.stamps),this.unignore(o)}},m.prototype._find=function(t){return t?("string"==typeof t&&(t=this.element.querySelectorAll(t)),t=o(t)):void 0},m.prototype._manageStamps=function(){if(this.stamps&&this.stamps.length){this._getBoundingRect();for(var t=0,e=this.stamps.length;e>t;t++){var i=this.stamps[t];this._manageStamp(i)}}},m.prototype._getBoundingRect=function(){var t=this.element.getBoundingClientRect(),e=this.size;this._boundingRect={left:t.left+e.paddingLeft+e.borderLeftWidth,top:t.top+e.paddingTop+e.borderTopWidth,right:t.right-(e.paddingRight+e.borderRightWidth),bottom:t.bottom-(e.paddingBottom+e.borderBottomWidth)}},m.prototype._manageStamp=h,m.prototype._getElementOffset=function(t){var e=t.getBoundingClientRect(),i=this._boundingRect,o=d(t),n={left:e.left-i.left-o.marginLeft,top:e.top-i.top-o.marginTop,right:i.right-e.right-o.marginRight,bottom:i.bottom-e.bottom-o.marginBottom};return n},m.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},m.prototype.bindResize=function(){this.isResizeBound||(i.bind(t,"resize",this),this.isResizeBound=!0)},m.prototype.unbindResize=function(){this.isResizeBound&&i.unbind(t,"resize",this),this.isResizeBound=!1},m.prototype.onresize=function(){function t(){e.resize(),delete e.resizeTimeout}this.resizeTimeout&&clearTimeout(this.resizeTimeout);var e=this;this.resizeTimeout=setTimeout(t,100)},m.prototype.resize=function(){this.isResizeBound&&this.needsResizeLayout()&&this.layout()},m.prototype.needsResizeLayout=function(){var t=d(this.element),e=this.size&&t;return e&&t.innerWidth!==this.size.innerWidth},m.prototype.addItems=function(t){var e=this._itemize(t);return e.length&&(this.items=this.items.concat(e)),e},m.prototype.appended=function(t){var e=this.addItems(t);e.length&&(this.layoutItems(e,!0),this.reveal(e))},m.prototype.prepended=function(t){var e=this._itemize(t);if(e.length){var i=this.items.slice(0);this.items=e.concat(i),this._resetLayout(),this._manageStamps(),this.layoutItems(e,!0),this.reveal(e),this.layoutItems(i)}},m.prototype.reveal=function(t){var e=t&&t.length;if(e)for(var i=0;e>i;i++){var o=t[i];o.reveal()}},m.prototype.hide=function(t){var e=t&&t.length;if(e)for(var i=0;e>i;i++){var o=t[i];o.hide()}},m.prototype.getItem=function(t){for(var e=0,i=this.items.length;i>e;e++){var o=this.items[e];if(o.element===t)return o}},m.prototype.getItems=function(t){if(t&&t.length){for(var e=[],i=0,o=t.length;o>i;i++){var n=t[i],r=this.getItem(n);r&&e.push(r)}return e}},m.prototype.remove=function(t){t=o(t);var e=this.getItems(t);if(e&&e.length){this._itemsOn(e,"remove",function(){this.emitEvent("removeComplete",[this,e])});for(var i=0,r=e.length;r>i;i++){var s=e[i];s.remove(),n(s,this.items)}}},m.prototype.destroy=function(){var t=this.element.style;t.height="",t.position="",t.width="";for(var e=0,i=this.items.length;i>e;e++){var o=this.items[e];o.destroy()}this.unbindResize(),delete this.element.outlayerGUID,p&&p.removeData(this.element,this.constructor.namespace)},m.data=function(t){var e=t&&t.outlayerGUID;return e&&v[e]},m.create=function(t,i){function o(){m.apply(this,arguments)}return Object.create?o.prototype=Object.create(m.prototype):e(o.prototype,m.prototype),o.prototype.constructor=o,o.defaults=e({},m.defaults),e(o.defaults,i),o.prototype.settings={},o.namespace=t,o.data=m.data,o.Item=function(){y.apply(this,arguments)},o.Item.prototype=new y,s(function(){for(var e=r(t),i=a.querySelectorAll(".js-"+e),n="data-"+e+"-options",s=0,h=i.length;h>s;s++){var f,c=i[s],d=c.getAttribute(n);try{f=d&&JSON.parse(d)}catch(l){u&&u.error("Error parsing "+n+" on "+c.nodeName.toLowerCase()+(c.id?"#"+c.id:"")+": "+l);continue}var y=new o(c,f);p&&p.data(c,t,y)}}),p&&p.bridget&&p.bridget(t,o),o},m.Item=y,m}var a=t.document,u=t.console,p=t.jQuery,h=function(){},f=Object.prototype.toString,c="object"==typeof HTMLElement?function(t){return t instanceof HTMLElement}:function(t){return t&&"object"==typeof t&&1===t.nodeType&&"string"==typeof t.nodeName},d=Array.prototype.indexOf?function(t,e){return t.indexOf(e)}:function(t,e){for(var i=0,o=t.length;o>i;i++)if(t[i]===e)return i;return-1};"function"==typeof define&&define.amd?define("outlayer/outlayer",["eventie/eventie","doc-ready/doc-ready","eventEmitter/EventEmitter","get-size/get-size","matches-selector/matches-selector","./item"],s):t.Outlayer=s(t.eventie,t.docReady,t.EventEmitter,t.getSize,t.matchesSelector,t.Outlayer.Item)}(window),function(t){function e(t){function e(){t.Item.apply(this,arguments)}return e.prototype=new t.Item,e.prototype._create=function(){this.id=this.layout.itemGUID++,t.Item.prototype._create.call(this),this.sortData={}},e.prototype.updateSortData=function(){if(!this.isIgnored){this.sortData.id=this.id,this.sortData["original-order"]=this.id,this.sortData.random=Math.random();var t=this.layout.options.getSortData,e=this.layout._sorters;for(var i in t){var o=e[i];this.sortData[i]=o(this.element,this)}}},e}"function"==typeof define&&define.amd?define("isotope/js/item",["outlayer/outlayer"],e):(t.Isotope=t.Isotope||{},t.Isotope.Item=e(t.Outlayer))}(window),function(t){function e(t,e){function i(t){this.isotope=t,t&&(this.options=t.options[this.namespace],this.element=t.element,this.items=t.filteredItems,this.size=t.size)}return function(){function t(t){return function(){return e.prototype[t].apply(this.isotope,arguments)}}for(var o=["_resetLayout","_getItemLayoutPosition","_manageStamp","_getContainerSize","_getElementOffset","needsResizeLayout"],n=0,r=o.length;r>n;n++){var s=o[n];i.prototype[s]=t(s)}}(),i.prototype.needsVerticalResizeLayout=function(){var e=t(this.isotope.element),i=this.isotope.size&&e;return i&&e.innerHeight!==this.isotope.size.innerHeight},i.prototype._getMeasurement=function(){this.isotope._getMeasurement.apply(this,arguments)},i.prototype.getColumnWidth=function(){this.getSegmentSize("column","Width")},i.prototype.getRowHeight=function(){this.getSegmentSize("row","Height")},i.prototype.getSegmentSize=function(t,e){var i=t+e,o="outer"+e;if(this._getMeasurement(i,o),!this[i]){var n=this.getFirstItemSize();this[i]=n&&n[o]||this.isotope.size["inner"+e]}},i.prototype.getFirstItemSize=function(){var e=this.isotope.filteredItems[0];return e&&e.element&&t(e.element)},i.prototype.layout=function(){this.isotope.layout.apply(this.isotope,arguments)},i.prototype.getSize=function(){this.isotope.getSize(),this.size=this.isotope.size},i.modes={},i.create=function(t,e){function o(){i.apply(this,arguments)}return o.prototype=new i,e&&(o.options=e),o.prototype.namespace=t,i.modes[t]=o,o},i}"function"==typeof define&&define.amd?define("isotope/js/layout-mode",["get-size/get-size","outlayer/outlayer"],e):(t.Isotope=t.Isotope||{},t.Isotope.LayoutMode=e(t.getSize,t.Outlayer))}(window),function(t){function e(t,e){var o=t.create("masonry");return o.prototype._resetLayout=function(){this.getSize(),this._getMeasurement("columnWidth","outerWidth"),this._getMeasurement("gutter","outerWidth"),this.measureColumns();var t=this.cols;for(this.colYs=[];t--;)this.colYs.push(0);this.maxY=0},o.prototype.measureColumns=function(){if(this.getContainerWidth(),!this.columnWidth){var t=this.items[0],i=t&&t.element;this.columnWidth=i&&e(i).outerWidth||this.containerWidth}this.columnWidth+=this.gutter,this.cols=Math.floor((this.containerWidth+this.gutter)/this.columnWidth),this.cols=Math.max(this.cols,1)},o.prototype.getContainerWidth=function(){var t=this.options.isFitWidth?this.element.parentNode:this.element,i=e(t);this.containerWidth=i&&i.innerWidth},o.prototype._getItemLayoutPosition=function(t){t.getSize();var e=t.size.outerWidth%this.columnWidth,o=e&&1>e?"round":"ceil",n=Math[o](t.size.outerWidth/this.columnWidth);n=Math.min(n,this.cols);for(var r=this._getColGroup(n),s=Math.min.apply(Math,r),a=i(r,s),u={x:this.columnWidth*a,y:s},p=s+t.size.outerHeight,h=this.cols+1-r.length,f=0;h>f;f++)this.colYs[a+f]=p;return u},o.prototype._getColGroup=function(t){if(2>t)return this.colYs;for(var e=[],i=this.cols+1-t,o=0;i>o;o++){var n=this.colYs.slice(o,o+t);e[o]=Math.max.apply(Math,n)}return e},o.prototype._manageStamp=function(t){var i=e(t),o=this._getElementOffset(t),n=this.options.isOriginLeft?o.left:o.right,r=n+i.outerWidth,s=Math.floor(n/this.columnWidth);s=Math.max(0,s);var a=Math.floor(r/this.columnWidth);a-=r%this.columnWidth?0:1,a=Math.min(this.cols-1,a);for(var u=(this.options.isOriginTop?o.top:o.bottom)+i.outerHeight,p=s;a>=p;p++)this.colYs[p]=Math.max(u,this.colYs[p])},o.prototype._getContainerSize=function(){this.maxY=Math.max.apply(Math,this.colYs);var t={height:this.maxY};return this.options.isFitWidth&&(t.width=this._getContainerFitWidth()),t},o.prototype._getContainerFitWidth=function(){for(var t=0,e=this.cols;--e&&0===this.colYs[e];)t++;return(this.cols-t)*this.columnWidth-this.gutter},o.prototype.needsResizeLayout=function(){var t=this.containerWidth;return this.getContainerWidth(),t!==this.containerWidth},o}var i=Array.prototype.indexOf?function(t,e){return t.indexOf(e)}:function(t,e){for(var i=0,o=t.length;o>i;i++){var n=t[i];if(n===e)return i}return-1};"function"==typeof define&&define.amd?define("masonry/masonry",["outlayer/outlayer","get-size/get-size"],e):t.Masonry=e(t.Outlayer,t.getSize)}(window),function(t){function e(t,e){for(var i in e)t[i]=e[i];return t}function i(t,i){var o=t.create("masonry"),n=o.prototype._getElementOffset,r=o.prototype.layout,s=o.prototype._getMeasurement;e(o.prototype,i.prototype),o.prototype._getElementOffset=n,o.prototype.layout=r,o.prototype._getMeasurement=s;var a=o.prototype.measureColumns;o.prototype.measureColumns=function(){this.items=this.isotope.filteredItems,a.call(this)};var u=o.prototype._manageStamp;return o.prototype._manageStamp=function(){this.options.isOriginLeft=this.isotope.options.isOriginLeft,this.options.isOriginTop=this.isotope.options.isOriginTop,u.apply(this,arguments)},o}"function"==typeof define&&define.amd?define("isotope/js/layout-modes/masonry",["../layout-mode","masonry/masonry"],i):i(t.Isotope.LayoutMode,t.Masonry)}(window),function(t){function e(t){var e=t.create("fitRows");return e.prototype._resetLayout=function(){this.x=0,this.y=0,this.maxY=0},e.prototype._getItemLayoutPosition=function(t){t.getSize(),0!==this.x&&t.size.outerWidth+this.x>this.isotope.size.innerWidth&&(this.x=0,this.y=this.maxY);var e={x:this.x,y:this.y};return this.maxY=Math.max(this.maxY,this.y+t.size.outerHeight),this.x+=t.size.outerWidth,e},e.prototype._getContainerSize=function(){return{height:this.maxY}},e}"function"==typeof define&&define.amd?define("isotope/js/layout-modes/fit-rows",["../layout-mode"],e):e(t.Isotope.LayoutMode)}(window),function(t){function e(t){var e=t.create("vertical",{horizontalAlignment:0});return e.prototype._resetLayout=function(){this.y=0},e.prototype._getItemLayoutPosition=function(t){t.getSize();var e=(this.isotope.size.innerWidth-t.size.outerWidth)*this.options.horizontalAlignment,i=this.y;return this.y+=t.size.outerHeight,{x:e,y:i}},e.prototype._getContainerSize=function(){return{height:this.y}},e}"function"==typeof define&&define.amd?define("isotope/js/layout-modes/vertical",["../layout-mode"],e):e(t.Isotope.LayoutMode)}(window),function(t){function e(t,e){for(var i in e)t[i]=e[i];return t}function i(t){return"[object Array]"===h.call(t)}function o(t){var e=[];if(i(t))e=t;else if(t&&"number"==typeof t.length)for(var o=0,n=t.length;n>o;o++)e.push(t[o]);else e.push(t);return e}function n(t,e){var i=f(e,t);-1!==i&&e.splice(i,1)}function r(t,i,r,u,h){function f(t,e){return function(i,o){for(var n=0,r=t.length;r>n;n++){var s=t[n],a=i.sortData[s],u=o.sortData[s];if(a>u||u>a){var p=void 0!==e[s]?e[s]:e,h=p?1:-1;return(a>u?1:-1)*h}}return 0}}var c=t.create("isotope",{layoutMode:"masonry",isJQueryFiltering:!0,sortAscending:!0});c.Item=u,c.LayoutMode=h,c.prototype._create=function(){this.itemGUID=0,this._sorters={},this._getSorters(),t.prototype._create.call(this),this.modes={},this.filteredItems=this.items,this.sortHistory=["original-order"];for(var e in h.modes)this._initLayoutMode(e)},c.prototype.reloadItems=function(){this.itemGUID=0,t.prototype.reloadItems.call(this)},c.prototype._itemize=function(){for(var e=t.prototype._itemize.apply(this,arguments),i=0,o=e.length;o>i;i++){var n=e[i];n.id=this.itemGUID++}return this._updateItemsSortData(e),e},c.prototype._initLayoutMode=function(t){var i=h.modes[t],o=this.options[t]||{};this.options[t]=i.options?e(i.options,o):o,this.modes[t]=new i(this)},c.prototype.layout=function(){return!this._isLayoutInited&&this.options.isInitLayout?(this.arrange(),void 0):(this._layout(),void 0)},c.prototype._layout=function(){var t=this._getIsInstant();this._resetLayout(),this._manageStamps(),this.layoutItems(this.filteredItems,t),this._isLayoutInited=!0},c.prototype.arrange=function(t){this.option(t),this._getIsInstant(),this.filteredItems=this._filter(this.items),this._sort(),this._layout()},c.prototype._init=c.prototype.arrange,c.prototype._getIsInstant=function(){var t=void 0!==this.options.isLayoutInstant?this.options.isLayoutInstant:!this._isLayoutInited;return this._isInstant=t,t},c.prototype._filter=function(t){function e(){f.reveal(n),f.hide(r)}var i=this.options.filter;i=i||"*";for(var o=[],n=[],r=[],s=this._getFilterTest(i),a=0,u=t.length;u>a;a++){var p=t[a];if(!p.isIgnored){var h=s(p);h&&o.push(p),h&&p.isHidden?n.push(p):h||p.isHidden||r.push(p)}}var f=this;return this._isInstant?this._noTransition(e):e(),o},c.prototype._getFilterTest=function(t){return s&&this.options.isJQueryFiltering?function(e){return s(e.element).is(t)}:"function"==typeof t?function(e){return t(e.element)}:function(e){return r(e.element,t)}},c.prototype.updateSortData=function(t){this._getSorters(),t=o(t);var e=this.getItems(t);e=e.length?e:this.items,this._updateItemsSortData(e)
},c.prototype._getSorters=function(){var t=this.options.getSortData;for(var e in t){var i=t[e];this._sorters[e]=d(i)}},c.prototype._updateItemsSortData=function(t){for(var e=0,i=t.length;i>e;e++){var o=t[e];o.updateSortData()}};var d=function(){function t(t){if("string"!=typeof t)return t;var i=a(t).split(" "),o=i[0],n=o.match(/^\[(.+)\]$/),r=n&&n[1],s=e(r,o),u=c.sortDataParsers[i[1]];return t=u?function(t){return t&&u(s(t))}:function(t){return t&&s(t)}}function e(t,e){var i;return i=t?function(e){return e.getAttribute(t)}:function(t){var i=t.querySelector(e);return i&&p(i)}}return t}();c.sortDataParsers={parseInt:function(t){return parseInt(t,10)},parseFloat:function(t){return parseFloat(t)}},c.prototype._sort=function(){var t=this.options.sortBy;if(t){var e=[].concat.apply(t,this.sortHistory),i=f(e,this.options.sortAscending);this.filteredItems.sort(i),t!==this.sortHistory[0]&&this.sortHistory.unshift(t)}},c.prototype._mode=function(){var t=this.options.layoutMode,e=this.modes[t];if(!e)throw Error("No layout mode: "+t);return e.options=this.options[t],e},c.prototype._resetLayout=function(){t.prototype._resetLayout.call(this),this._mode()._resetLayout()},c.prototype._getItemLayoutPosition=function(t){return this._mode()._getItemLayoutPosition(t)},c.prototype._manageStamp=function(t){this._mode()._manageStamp(t)},c.prototype._getContainerSize=function(){return this._mode()._getContainerSize()},c.prototype.needsResizeLayout=function(){return this._mode().needsResizeLayout()},c.prototype.appended=function(t){var e=this.addItems(t);if(e.length){var i=this._filterRevealAdded(e);this.filteredItems=this.filteredItems.concat(i)}},c.prototype.prepended=function(t){var e=this._itemize(t);if(e.length){var i=this.items.slice(0);this.items=e.concat(i),this._resetLayout(),this._manageStamps();var o=this._filterRevealAdded(e);this.layoutItems(i),this.filteredItems=o.concat(this.filteredItems)}},c.prototype._filterRevealAdded=function(t){var e=this._noTransition(function(){return this._filter(t)});return this.layoutItems(e,!0),this.reveal(e),t},c.prototype.insert=function(t){var e=this.addItems(t);if(e.length){var i,o,n=e.length;for(i=0;n>i;i++)o=e[i],this.element.appendChild(o.element);var r=this._filter(e);for(this._noTransition(function(){this.hide(r)}),i=0;n>i;i++)e[i].isLayoutInstant=!0;for(this.arrange(),i=0;n>i;i++)delete e[i].isLayoutInstant;this.reveal(r)}};var l=c.prototype.remove;return c.prototype.remove=function(t){t=o(t);var e=this.getItems(t);if(l.call(this,t),e&&e.length)for(var i=0,r=e.length;r>i;i++){var s=e[i];n(s,this.filteredItems)}},c.prototype._noTransition=function(t){var e=this.options.transitionDuration;this.options.transitionDuration=0;var i=t.call(this);return this.options.transitionDuration=e,i},c}var s=t.jQuery,a=String.prototype.trim?function(t){return t.trim()}:function(t){return t.replace(/^\s+|\s+$/g,"")},u=document.documentElement,p=u.textContent?function(t){return t.textContent}:function(t){return t.innerText},h=Object.prototype.toString,f=Array.prototype.indexOf?function(t,e){return t.indexOf(e)}:function(t,e){for(var i=0,o=t.length;o>i;i++)if(t[i]===e)return i;return-1};"function"==typeof define&&define.amd?define(["outlayer/outlayer","get-size/get-size","matches-selector/matches-selector","isotope/js/item","isotope/js/layout-mode","isotope/js/layout-modes/masonry","isotope/js/layout-modes/fit-rows","isotope/js/layout-modes/vertical"],r):t.Isotope=r(t.Outlayer,t.getSize,t.matchesSelector,t.Isotope.Item,t.Isotope.LayoutMode)}(window);
;
( function( $ ) {

  "use strict";

  $.fn.fitVids = function( options ) {

    var settings = {
      customSelector: null,
      callback: function() {}
    };

    if( ! document.getElementById( 'fit-vids-style' ) ) {
      var div = document.createElement('div'),
      ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0],
      cssStyles = '&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';

      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = cssStyles;

      ref.parentNode.insertBefore( div, ref );
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each( function() {
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if ( settings.customSelector ) {
        selectors.push( settings.customSelector );
      }

      var $allVideos = $( this ).find( selectors.join( "," ) );
      $allVideos = $allVideos.not( "object object" ); // SwfObj conflict patch

      $allVideos.each( function() {
        var $this = $( this ),
          $holder = $this.parent(),
          isShortcodeUltimateVideo = $holder.hasClass('su-vimeo') || $holder.hasClass('su-youtube') || $holder.hasClass('su-screenr');

        if ( isShortcodeUltimateVideo ) {
          return;
        }

        if ( this.tagName.toLowerCase() === "embed" && $this.parent( "object" ).length || $this.parent( ".fluid-width-video-wrapper" ).length ) {
          return;
        }

        var height = 9,
          width = 16;

        if ( $this.attr( "height" ) !== undefined ) {
          height = parseInt( $this.attr( "height" ), 10 );
        }
        else if ( $holder.attr( "data-ratio-y" ) !== undefined ) {
          height = parseInt( $holder.attr( "data-ratio-y" ), 10 );
        }

        if ( $this.attr( "width" ) !== undefined ) {
          width = parseInt( $this.attr( "width" ), 10 );
        }
        else if ( $holder.attr( "data-ratio-x" ) !== undefined ) {
          width = parseInt( $holder.attr( "data-ratio-x" ), 10 );
        }

        var aspectRatio = height / width;

        $this.wrap( '<div class="fluid-width-video-wrapper"></div>' );
        var $wrapper = $this.parent('.fluid-width-video-wrapper');
        $wrapper.css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');

        setTimeout(function() {
          settings.callback( $wrapper );
        }, 5);
      } );
    } );
  };

} )( jQuery );
;
/*global jQuery */
/*!
* FitText.js 1.2
*
* Copyright 2011, Dave Rupert http://daverupert.com
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
*
* Date: Thu May 05 14:23:00 2011 -0600
*/

(function( $ ){

  $.fn.fitText = function( kompressor, options ) {

    // Setup options
    var compressor = kompressor || 1,
        settings = $.extend({
          'minFontSize' : Number.NEGATIVE_INFINITY,
          'maxFontSize' : Number.POSITIVE_INFINITY
        }, options);

    return this.each(function(){

      // Store the object
      var $this = $(this);

      // Resizer() resizes items based on the object width divided by the compressor * 10
      var resizer = function () {
        $this.css('font-size', Math.max(Math.min($this.width() / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
      };

      // Call once to set.
      resizer();

      // Call on resize. Opera debounces their resize by default.
      $(window).on('resize.fittext orientationchange.fittext', resizer);

    });

  };

})( jQuery );

;
(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";
var support = require("./utils").support;
var dispatchClick = require("./utils").dispatchClick;

document.addEventListener('DOMContentLoaded', function() {
    if(!support) {
        return;
    }

    var cover = document.createElement('div'),
        body = document.body,
        coverStyle = cover.style,
        scrollStarted = false,
        timer,
        clicked = false,
        pos = { x: 0, y: 0 };

    coverStyle.cssText = [
        '-webkit-transform: translate3d(0,0,0);',
        'transform: translate3d(0,0,0);',
        'position: fixed;',
        'top: 0;',
        'right: 0;',
        'left: 0;',
        'bottom: 0;',
        'opacity: 0;',
        'z-index: 9;',
        'pointer-events: none'
    ].join('');
    body.appendChild(cover);

    window.addEventListener('scroll', function scroll() {
        if(!scrollStarted) {
            coverStyle.pointerEvents = 'auto';
            scrollStarted = true;
        }
        clearTimeout(timer);

        timer = setTimeout(function(){
            coverStyle.pointerEvents = 'none';
            scrollStarted = false;
            if(clicked) {
                dispatchClick(pos);
                clicked = false;
            }
        },250);
    }, false);

    // capture all clicks and store x, y coords for later
    document.addEventListener('click', function clickCatcher(event) {
        if(event.target === cover && !event.synthetic) {
            pos.x = event.clientX;
            pos.y = event.clientY;
            clicked = true;
        }
    }, false);
}, false);
},{"./utils":2}],2:[function(require,module,exports){
"use strict";
var support = (function support() {
    var element = document.createElement('x');
    element.style.cssText = 'pointer-events:auto';
    return element.style.pointerEvents === 'auto';
}());

function dispatchClick(coords) {
    var event = document.createEvent('MouseEvent'),
        elem = document.elementFromPoint(coords.x, coords.y);

    event.initMouseEvent(
        'click',
        true /* bubble */, true /* cancelable */,
        window, null,
        coords.x, coords.y, 0, 0, /* coordinates */
        false, false, false, false, /* modifier keys */
        0 /*left*/, null
    );
    event.synthetic = true;

    elem.dispatchEvent(event);
}

exports.support = support;
exports.dispatchClick = dispatchClick;
},{}]},{},[1])
;
/*! NProgress (c) 2013, Rico Sta. Cruz
 *  http://ricostacruz.com/nprogress */
;(function(a){if(typeof module==="function"){module.exports=a(this.jQuery||require("jquery"))}else{this.NProgress=a(this.jQuery)}})(function(e){var a={};a.version="0.1.2";var b=a.settings={minimum:0.08,easing:"ease",positionUsing:"",speed:200,trickle:true,trickleRate:0.02,trickleSpeed:800,showSpinner:true,template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};a.configure=function(g){e.extend(b,g);return this};a.status=null;a.set=function(l){var h=a.isStarted();l=f(l,b.minimum,1);a.status=(l===1?null:l);var g=a.render(!h),j=g.find('[role="bar"]'),i=b.speed,k=b.easing;g[0].offsetWidth;g.queue(function(m){if(b.positionUsing===""){b.positionUsing=a.getPositioningCSS()}j.css(c(l,i,k));if(l===1){g.css({transition:"none",opacity:1});g[0].offsetWidth;setTimeout(function(){g.css({transition:"all "+i+"ms linear",opacity:0});setTimeout(function(){a.remove();m()},i)},i)}else{setTimeout(m,i)}});return this};a.isStarted=function(){return typeof a.status==="number"};a.start=function(){if(!a.status){a.set(0)}var g=function(){setTimeout(function(){if(!a.status){return}a.trickle();g()},b.trickleSpeed)};if(b.trickle){g()}return this};a.done=function(g){if(!g&&!a.status){return this}return a.inc(0.3+0.5*Math.random()).set(1)};a.inc=function(g){var h=a.status;if(!h){return a.start()}else{if(typeof g!=="number"){g=(1-h)*f(Math.random()*h,0.1,0.95)}h=f(h+g,0,0.994);return a.set(h)}};a.trickle=function(){return a.inc(Math.random()*b.trickleRate)};a.render=function(g){if(a.isRendered()){return e("#nprogress")}e("html").addClass("nprogress-busy");var i=e("<div id='nprogress'>").html(b.template);var h=g?"-100":d(a.status||0);i.find('[role="bar"]').css({transition:"all 0 linear",transform:"translate3d("+h+"%,0,0)"});if(!b.showSpinner){i.find('[role="spinner"]').remove()}i.appendTo(document.body);return i};a.remove=function(){e("html").removeClass("nprogress-busy");e("#nprogress").remove()};a.isRendered=function(){return(e("#nprogress").length>0)};a.getPositioningCSS=function(){var g=document.body.style;var h=("WebkitTransform" in g)?"Webkit":("MozTransform" in g)?"Moz":("msTransform" in g)?"ms":("OTransform" in g)?"O":"";if(h+"Perspective" in g){return"translate3d"}else{if(h+"Transform" in g){return"translate"}else{return"margin"}}};function f(i,h,g){if(i<h){return h}if(i>g){return g}return i}function d(g){return(-1+g)*100}function c(j,h,i){var g;if(b.positionUsing==="translate3d"){g={transform:"translate3d("+d(j)+"%,0,0)"}}else{if(b.positionUsing==="translate"){g={transform:"translate("+d(j)+"%,0)"}}else{g={"margin-left":d(j)+"%"}}}g.transition="all "+h+"ms "+i;return g}return a});
;
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

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		
		//get the starting position of each element to have parallax applied to it	
		function update (){
			
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
			// if (arguments.length < 2 || speedFactor === null) speedFactor = 0.5;
			if (arguments.length < 3 || outerHeight === null) outerHeight = true;
			
			// function to be called whenever the window is scrolled or resized
			
				var pos = $window.scrollTop();				
	
				$this.each(function(){
					var $element = $(this);
					var top = $element.offset().top;
					var height = getHeight($element);
	
					// Check if totally above or totally below viewport
					if (top + height < pos || top > pos + windowHeight) {
						return;
					}

					$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
					
				});
		}	
			
		update();
		$window.bind('scroll', update).resize(update);
		
	};
})(jQuery);
;
( function( $ ) {

	var THB_RoyalSliderSlideshow = function( $el, options ) {

		var slideshow = this,
			royalSliderInstance = null,
			is_mobile = $( "body" ).hasClass( "thb-mobile" );

		options = $.extend( {}, options );

		options.video = {
			youTubeCode: '<iframe src="//www.youtube.com/embed/%id%?rel=1&showinfo=0&autoplay=1&wmode=transparent" frameborder="no"></iframe>',
			vimeoCode: '<iframe src="//player.vimeo.com/video/%id%?byline=0&amp;portrait=0&amp;autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
		};

		this.init = function() {
			$el.royalSlider( options );
			royalSliderInstance = $el.data( "royalSlider" );

			slideshow.bind();
		};

		this.bind = function() {
			royalSliderInstance.ev.on( "rsAfterContentSet rsAfterSlideChange", function() {
				var slide = slideshow.getCurrentSlide();
				slide.removeClass( "thb-muted" );

				slideshow.setupSlide( slide );

				if ( slide.data( "autoplay" ) == "1" ) {
					slideshow.playVideo();
				}
			} );

			royalSliderInstance.ev.on( "rsVideoPlay", function() {
				slideshow.setupSlide( slideshow.getCurrentSlide() );
			} );

			royalSliderInstance.ev.on( "rsBeforeMove", function() {
				slideshow.stopVideo();
			} );

			var slide = slideshow.getCurrentSlide();

			slideshow.setupSlide( slide );

			if ( slide.data( "autoplay" ) == "1" ) {
				slideshow.playVideo();
			}
		};

		this.getCurrentSlide = function() {
			var slide = $( ".rsActiveSlide .slide", $el );

			if ( ! slide.length ) {
				slide = $( ".slide", $el ).first();
			}

			return slide;
		};

		this.videoCallback = function( state ) {
			if ( state == "playing" ) {
				$el.addClass( "rsVideoPlaying" );
				slideshow.bindVolumeEvents( slideshow.getCurrentSlide() );
			}
			else {
				var slide = slideshow.getCurrentSlide(),
					rsSlide = slide.parent();

				$el.removeClass( "rsVideoPlaying" );

				if ( slide.data( "loop" ) ) {
					royalSliderInstance.playVideo();
				}
				else {
					royalSliderInstance.stopVideo();
				}

				if ( options.autoPlay && options.autoPlay.enabled ) {
					royalSliderInstance.startAutoPlay();
				}
			}
		};

		this.bindVolumeEvents = function( slide ) {
			var video = slideshow.getVideo( slide, true );

			$( ".thb-video-mute", slide ).off( ".thb" );
			$( ".thb-video-unmute", slide ).off( ".thb" );

			$( ".thb-video-mute", slide ).on( "click.thb", function() {
				video.data( "player" ).mute();
				slide.addClass( "thb-muted" );

				return false;
			} );

			$( ".thb-video-unmute", slide ).on( "click.thb", function() {
				video.data( "player" ).unMute();
				slide.removeClass( "thb-muted" );

				return false;
			} );
		};

		this.setupSlide = function( slide ) {
			if ( slide.attr( "data-fill" ) == "1" ) {
				if ( slide.data( "embed-iframe" ) ) {
					thb_video_holders( slide, ".rsVideoFrameHolder" );
				}
				else {
					thb_video_holders( slide );
				}
			}
			else {
				thb_video_holders_off( slide );
			}

			if ( slide.hasClass( "slide-type-embed" ) ) {
				if ( ! $( ".thb-video-play", slide ).data( "thbClickBound" ) ) {
					$( ".thb-video-play", slide ).data( "thbClickBound", true );

					$( ".thb-video-play", slide ).on( "click", function() {
						slideshow.playVideo();
						return false;
					} );
				}

				if ( ! $( ".thb-video-stop", slide ).data( "thbClickBound" ) ) {
					$( ".thb-video-stop", slide ).data( "thbClickBound", true );

					$( ".thb-video-stop", slide ).on( "click", function() {
						slideshow.stopVideo();
						return false;
					} );
				}
			}

			var video = slideshow.getVideo( slide, true );

			if ( video ) {

				if ( slide.data( "embed-iframe" ) ) {
					video.get(0).src += '&enablejsapi=1&api=1';

					if ( slide.data( "loop" ) == "1" ) {
						video.get(0).src += '&loop=1&playlist=' + slide.data( "code" );
					}

					video.get(0).src = video.get(0).src.replace( 'rel=1', 'rel=0' );
				}
				else {
					if ( slide.data( "muted" ) == "1" ) {
						video.attr( "muted", "1" );
					}
				}

				thb_boot_iframe_video( video );

				if ( video.hasClass( "thb-video-loaded" ) ) {
					video.off( ".thb" );
					video.on( "change.thb", function( e, state ) {
						slideshow.videoCallback( state );

						if ( slide.data( "muted" ) == "1" ) {
							video.data( "player" ).mute();
						}
					} );

					slideshow.bindVolumeEvents( slide );
				}
				else {
					video.off( ".thb" );
					video.on( "thb-video-loaded.thb", function() {
						video.on( "change.thb", function( e, state ) {
							slideshow.videoCallback( state );
						} );

						if ( slide.data( "muted" ) == "1" ) {
							video.data( "player" ).mute();
						}

						slideshow.bindVolumeEvents( slide );
					} );
				}
			}

			$el.trigger( "thbSetupSlide", [ $el, slide ] );
		};

		this.getVideos = function() {
			return $( "video", $el );
		};

		this.getVideo = function( slide, all ) {
			var selector = "video";

			if ( all ) {
				selector += ",iframe";
			}

			var video = $( selector, slide ).first();

			if ( ! video.length ) {
				video = false;
			}

			return video;
		};

		this.playVideo = function() {
			if ( options.autoPlay && options.autoPlay.enabled ) {
				royalSliderInstance.stopAutoPlay();
			}

			var slide = slideshow.getCurrentSlide();

			if ( slide.data( "embed-iframe" ) ) {
				$el.addClass( "rsVideoPlaying" );
				royalSliderInstance.playVideo();
			}
			else {
				var video = slideshow.getVideo( slide, true );

				if ( video && video.get( 0 ).play !== undefined ) {
					$el.addClass( "rsVideoPlaying" );

					setTimeout( function() {
						video.get( 0 ).play();
					}, 10 );
				}
			}
		};

		this.stopVideo = function() {
			var slide = slideshow.getCurrentSlide(),
				video = slideshow.getVideo( slide, true );

			if ( video ) {
				if ( slide.data( "embed-iframe" ) ) {
					royalSliderInstance.stopVideo();
					slideshow.videoCallback( "finished" );
				}
				else {
					if ( video.get( 0 ).pause !== undefined ) {
						video.get( 0 ).pause();
					}
				}
			}
		};

		this.init();

	};

	$.fn.thbRoyalSliderSlideshow = function( options ) {
		return this.each( function() {
			if ( ! $( this ).data( "thbRoyalSliderSlideshow" ) ) {
				$( this ).data( "thbRoyalSliderSlideshow", new THB_RoyalSliderSlideshow( $( this ), options ) );
			}
		} );
	};

} )( jQuery );
;
(function($) {
	"use strict";

	$(document).ready(function() {

		/**
		 * Header fixed
		 */

		if( $( 'body' ).hasClass( 'thb-desktop' ) && $( 'body' ).hasClass( 'thb-sticky-header' ) ) {
			var header_container = $( '#header' ),
				header_inner_wrapper = header_container.find('.thb-header-inner-wrapper');

			window.skin_light_class = header_container.hasClass( 'thb-skin-light' );
			window.skin_dark_class = header_container.hasClass( 'thb-skin-dark' );

			$(window).on( 'scroll.thb-header', function() {

				if ( $(this).scrollTop() > ( header_container.outerHeight() ) ) {
					header_container.addClass( 'scrolled' );

					header_container.removeClass( 'thb-skin-light thb-skin-dark' );

				} else {
					header_container.removeClass( 'scrolled' );

					if ( window.skin_light_class ) {
						header_container.addClass( 'thb-skin-light' );
					} else {
						header_container.addClass( 'thb-skin-dark' );
					}
				}

			} );
		}

		/**
		 * Search functionality
		 */
		if( $( ".thb-search-icon-container" ).length ) {

			var thb_search_form_container = $( "#thb-search-box-container" );

			var thb_search_form = new THB_Toggle({
				target: thb_search_form_container,

				on: function() {
					$("body").addClass( 'thb-search-enable' );
					$("#thb-search-box-container").css("visibility", "visible");
					$("#thb-search-box-container #searchform #s").focus();
				},
				off: function() {
					$("body").removeClass( 'thb-search-enable' );
				},
				offTransitionEnd: function() {
					$("#thb-search-box-container").css("visibility", "hidden");
				}
			});

			$.thb.key("esc", thb_search_form.off);
			$('#thb-search-exit').on('click', thb_search_form.off);
			$('.thb-search-icon-container a').on('click', thb_search_form.on);

		}

		/**
		 * Fittext
		 */
		if( ! $('body').hasClass('thb-fittext-disabled') ) {
			var selectors = $('.thb-page-header-inner-wrapper .page-title, .layout-style-b.thb-section-column-block-thb_text_box .thb-section-block-header .thb-section-block-title, .layout-style-c.thb-section-column-block-thb_text_box .thb-section-block-header .thb-section-block-title, .layout-style-d.thb-section-column-block-thb_text_box .thb-section-block-header .thb-section-block-title');

			selectors.each( function() {
				$( this ).fitText( 0.8, { maxFontSize: $( this ).css('font-size') } );
			} );
		}

		/**
		 * Fit builder section height to the window height
		 */
		if ( $( ".thb-section" ).length ) {
			$( ".thb-section-extra[data-fit-height='1']" ).each( function() {
				var section = $( this ),
					offset = $( "body" ).offset().top,
					window_height = $( window ).height();

					// if ( $( "body" ).hasClass( 'thb-sticky-header') && $( "#header" ).hasClass( "scrolled" ) ) {
					// 	offset = offset + $( "#header.scrolled .thb-header-inner-wrapper" ).outerHeight();
					// }

					var w_height = window_height - offset;

				section.css('min-height', w_height );
			} );
		}

		/**
		 * Add a page preload
		 */

		if( ! $('body').hasClass('thb-mobile') ) {
			NProgress.configure().start();

			$( "#header" ).imagesLoaded( function() {
				if ( $( "body" ).hasClass( "thb-sticky-header" ) ) {
					$( "#header" ).css( "height", $( "#header .thb-header-inner-wrapper" ).outerHeight() );
				}

				if ( $( "body" ).hasClass( "pageheader-layout-e" ) || $( "body" ).hasClass( "pageheader-layout-f" ) ) {
					var offset = $( "body" ).offset().top,
						window_height = $( window ).height();

					var w_height = window_height - offset;

					$( "#page-header .thb-page-header-image-holder, #page-header .full_slideshow" ).css( "height", w_height );

					if ( $( "body" ).hasClass( "pageheader-layout-f" ) ) {
						$( "#page-header" ).css( "height", w_height );
					}
				}

				if ( $( "body" ).hasClass( "thb-pageheader-parallax" ) && $( "body" ).hasClass( "thb-desktop") ) {
					$("#page-header .full_slideshow .slide").parallax("50%", -0.6);
				}

				/**
				 * Scroll in page
				 */

				if( ! $('body').hasClass('thb-mobile') ) {
					var smoothScrollSelectors = ".thb-btn.action-primary, .thb-btn.action-secondary, li.menu-item a, .thb-slide-caption .thb-call-to .thb-btn";

					var header = $( "#header" ),
						offset = 0;

					if ( $( "body" ).hasClass( "thb-sticky-header" ) ) {
						if ( ! header.hasClass( "scrolled" ) ) {
							offset = header.outerHeight() - 32;
						}
						else {
							offset = header.outerHeight();
						}
					}

					window.thb_scroll_in_page( smoothScrollSelectors, {}, offset, function() {
						window.thb_slide_menu.off();
					} );
				}

				setTimeout( function() {
					$( window ).trigger( "resize" );
					$( window ).trigger( 'scroll.thb-header' );

					NProgress.done();
					setTimeout( function() {
						$("body").addClass("thb-page-loaded");
					}, 250 );
				}, 250 );
			} );
		} else {
			$("body").addClass("thb-page-loaded");
		}

		/**
		 * Fix the content height if there isn't enough content
		 */

		if( !$('body').hasClass('thb-mobile') ) {

			if ( $('#page-content').length > 0 ) {
				var body_height = $('body').height(),
					window_height = $(window).height() - $('body').offset().top,
					page_content_height = $('#page-content').outerHeight(),
					body_window_diff = window_height - body_height;

				if ( body_height < window_height ) {
					$('#page-content').css('min-height', page_content_height + body_window_diff);
				} else {
					$('#page-content').css('min-height', $(window).height() - $('#page-content').offset().top - $('#footer').outerHeight() - $('#footer-sidebar').outerHeight() );
				}

			}

		}

		/**
		 * Go top
		 */

		if( ! $('body').hasClass('thb-mobile') ) {
			$(window).scroll(function(){
				if ($(this).scrollTop() > 300) {
					$('.thb-scrollup').fadeIn('fast');
				} else {
					$('.thb-scrollup').fadeOut('fast');
				}
			});
		}

		if ( $('.thb-go-top').length ) {
			$('.thb-go-top').click(function(){
				$("html, body").stop().animate({ scrollTop: 0 }, 350, 'easeInOutCubic' );
				return false;
			});
		}

		/**
		 * Menu
		 */

		if ( ! $( "body" ).hasClass( "header-layout-b" ) ) {
			$(".main-navigation > div").menu({
				megaMenu: {
					fixed: false
				}
			});

			if ( $( "#top-nav" ).length ) {
				$(".secondary-navigation > div").menu();
			}
		}

		/**
		 * Mobile menu toggle
		 */

		window.thb_slide_menu = new THB_Toggle({
			target: $("#slide-menu-container"),
			on: function() {
				$("body").addClass( 'menu-open' );
				$("#slide-menu-container").css("visibility", "visible");
			},
			off: function() {
				$("body").removeClass( 'menu-open' );
			},
			offTransitionEnd: function() {
				$("#slide-menu-container").css("visibility", "hidden");
			}
		});

		$.thb.key("esc", window.thb_slide_menu.off);
		$('.thb-trigger-close').on('click', window.thb_slide_menu.off);
		$('.slide-menu-trigger').on('click', window.thb_slide_menu.on);

		/**
		 * FitVids
		 */

		$(".thb-text, .textwidget, .work-slides-container, .format-embed-wrapper, .thb-section-block-thb_video-video-holder").fitVids();

		/**
		 * Blog Masonry
		 */

		if( $( ".thb-masonry-container" ).length ) {
			var blog_masonry = new THB_Isotope( $(".thb-masonry-container") );
		}

		/**
		 * Photogallery.
		 */
		window.thb_isotope_styleAdjust = function() {};

		/**
		 * Portfolio.
		 */
		if ( $( ".thb-portfolio" ).length ) {
			$( ".thb-portfolio" ).each( function() {
				var portfolio = $( this ),
					useAjax = portfolio.attr( "data-ajax" ) == "1",
					isotopeContainer = $( ".thb-grid-layout", portfolio ),
					filter_controls = $( ".filterlist", portfolio ),
					portfolio_pagination = $( ".thb-navigation", portfolio ),
					thb_portfolio_filtering = false;

				if( ! useAjax ) {
					$( "li", filter_controls ).each(function() {
						var data = $(this).data("filter");

						if( data !== "" ) {
							if( ! isotopeContainer.find("[data-filter-" + data + "]").length ) {
								$(this).remove();
							}
						}
					});
				}

				var portfolio_isotope = new THB_Isotope( isotopeContainer, {
					filter: new THB_Filter(isotopeContainer, {
						controls: filter_controls,
						controlsOnClass: "active",
						filter: function( selector ) {

							if ( ! useAjax ) {
								portfolio_isotope.filter( selector );
							}
						}
					})
				});

				isotopeContainer.data( "thb_isotope", portfolio_isotope );

				window.thb_portfolio_reload = function( url, portfolio, callback ) {
					var portfolio_pagination = $( ".thb-navigation", portfolio ),
						isotopeContainer = $( ".thb-grid-layout", portfolio ),
						index = portfolio.index( $( ".thb-portfolio" ) );

					isotopeContainer.data( "thb_isotope" ).remove(function() {
						$.thb.loadUrl(url, {
							method: "POST",
							filter: false,
							complete: function( data ) {
								var target_portfolio = $(data).find( ".thb-portfolio" ).eq( index );

								NProgress.done();
								var items = target_portfolio.find(".thb-grid-layout .item");

								if( portfolio_pagination.length ) {
									if ( target_portfolio.find(".thb-navigation").length ) {
										portfolio_pagination.replaceWith( target_portfolio.find(".thb-navigation") );
									} else {
										portfolio_pagination.html('');
									}
								}
								else {
									isotopeContainer.after( target_portfolio.find(".thb-navigation") );
								}

								isotopeContainer.data( "thb_isotope" ).insert(items, function() {
									thb_portfolio_bind_pagination( portfolio );

									if( callback !== undefined ) {
										callback();
									}
								});
							}
						});
					});
				};

				window.thb_portfolio_bind_pagination = function( portfolio ) {
					$( ".thb-navigation a", portfolio ).on("click", function() {
						NProgress.configure().start();
						thb_portfolio_reload( $(this).attr("href"), portfolio, function() {
							$( window ).trigger( "resize" );
						} );
						return false;
					});
				};

				window.thb_portfolio_bind_filter = function( portfolio ) {
					var filter_controls = $( ".filterlist", portfolio );

					$( "li", filter_controls ).on("click", function() {
						if( thb_portfolio_filtering ) {
							return false;
						}

						thb_portfolio_filtering = true;

						thb_portfolio_reload( $(this).data("href"), portfolio, function() {
							thb_portfolio_filtering = false;
							$( window ).trigger( "resize" );
						} );

						NProgress.configure().start();

						$( "li", filter_controls ).removeClass("active");
						$(this).addClass("active");
						return false;
					});
				};

				if( useAjax ) {
					thb_portfolio_bind_filter( portfolio );
					thb_portfolio_bind_pagination( portfolio );
				}
			} );
		}

		/**
		 * Slideshow
		 */
		if ( $( '.thb-slideshow, .thb-section, .thb-work-slideshow' ).length ) {
			var rsOptions = {
				loop: true,
				slidesSpacing: 0,
				navigateByClick: false,
				addActiveClass: true,
				imageScaleMode: "fill",
				numImagesToPreload: 1,
				keyboardNavEnabled: true
			};

			window.thb_slide_skin_class = function( slide ) {
				if ( $( '#header' ).hasClass( "scrolled" ) || $( 'body' ).hasClass( 'pageheader-layout-a' ) || $( 'body' ).hasClass( 'pageheader-layout-b' ) ) {
					return;
				}

				$( "#header" ).removeClass( "thb-skin-light thb-skin-dark thb-skin-" );

				if ( slide.hasClass( "thb-skin-light" ) ) {
					$("#header").addClass( "thb-skin-light" );
					window.skin_light_class = true;
					window.skin_dark_class = false;
				}
				else {
					$("#header").addClass( "thb-skin-dark" );
					window.skin_light_class = false;
					window.skin_dark_class = true;
				}
			};

			$( '.thb-slideshow' ).each( function() {

				var thb_slideshow_container = $( this ),
					isMainSlideshow = thb_slideshow_container.hasClass( 'thb-main-slideshow' ),
					hasMultipleSlides = thb_slideshow_container.find( ".slide" ).length > 1,
					hasImages = thb_slideshow_container.find( "img" ).length > 0;

				// Defaults

				if ( isMainSlideshow && window.thb_slideshow ) {
					rsOptions.transitionType = window.thb_slideshow.effect;
				}

				if ( ! hasMultipleSlides ) {
					rsOptions.transitionType = "fade";
					rsOptions.controlNavigation = 'none';
				}

				// Autoplay

				if ( isMainSlideshow && window.thb_slideshow ) {
					window.thb_slide_skin_class( thb_slideshow_container.find( ".slide" ).first() );

					if ( window.thb_slideshow.autoplay && window.thb_slideshow.autoplay == "1" ) {
						rsOptions.autoPlay = {
							enabled: true,
							delay: window.thb_slideshow.speed
						};
					}
				}
				else {
					if ( thb_slideshow_container.hasClass( 'thb-section-slideshow' ) ) {
						rsOptions.keyboardNavEnabled = false;
						rsOptions.transitionType = "fade";
					}
				}

				if ( thb_slideshow_container.hasClass( 'page-content-slideshow' ) ) {
					rsOptions.autoScaleSlider = true;
					rsOptions.autoScaleSliderWidth = 930;
					rsOptions.autoScaleSliderHeight = 523;
				}

				thb_slideshow_container.on( "thbSetupSlide", function( event, thb_slideshow_container, slide ) {
					if ( ! thb_slideshow_container.hasClass( 'page-content-slideshow') ) {
						/**
						 * Skin
						 */
						thb_slide_skin_class( slide );

						if ( $( "body" ).hasClass( "thb-pageheader-parallax" ) && $( "body" ).hasClass( "thb-desktop") ) {
							slide.parallax("50%",-0.6);
						}
					}

					if ( thb_slideshow_container.hasClass('rsFade') ) {
						$(window).trigger('resize');
					}
				} );

				thb_slideshow_container.thbRoyalSliderSlideshow( rsOptions );
				// thb_slideshow_start(thb_slideshow_container, rsOptions);
			} );

			/**
			 * Sections
			 */

			if ( $( "body" ).hasClass( "thb-desktop") ) {
				if ( $( ".thb-section" ).length ) {
					$( ".thb-section-extra[data-parallax='1']" ).each( function() {
						var section = $( this ),
							background_image = section.css( "background-image" ).replace( "url(", "" ).replace( ")", "" );

						if ( background_image == 'none' ) {
							return;
						}

						section.parallax('50%', 0.6);
					} );
				}
			}
		}

		/**
		 * Galleries
		 */
		$(".thb-gallery").each( function() {
			$( this ).royalSlider({
				loopRewind: true,
				slidesSpacing: 0,
				navigateByClick: false,
				imageScaleMode: "fill",
				autoScaleSlider: true,
				autoScaleSliderWidth: 930,
				autoScaleSliderHeight: 523,
				numImagesToPreload: parseInt( $( this ).data( "count" ), 10 )
			});
		} );

		/**
		 * Work slideshow
		 */
		if ( $( '.thb-work-slideshow' ).length ) {
			$( ".thb-work-slideshow" ).each( function() {
				$( this ).thbRoyalSliderSlideshow( {
					autoHeight: true,
					autoScaleSlider: false,
					arrowsNav: true,
					fadeinLoadedSlide: false,
					controlNavigationSpacing: 0,
					imageScaleMode: 'none',
					imageAlignCenter: false,
					controlNavigation: 'none',
					// loop: false,
					loopRewind: true,
					numImagesToPreload: parseInt( $( this ).data( "count" ), 10 ),
					keyboardNavEnabled: true,
					// usePreloader: false,
					loop: false,
					slidesSpacing: 0,
					navigateByClick: false,
					addActiveClass: true,
				} );
			} );
		}

	});

})(jQuery);

;
/*! odometer 0.4.7 */
(function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G=[].slice;q='<span class="odometer-value"></span>',n='<span class="odometer-ribbon"><span class="odometer-ribbon-inner">'+q+"</span></span>",d='<span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner">'+n+"</span></span>",g='<span class="odometer-formatting-mark"></span>',c="(,ddd).dd",h=/^\(?([^)]*)\)?(?:(.)(d+))?$/,i=30,f=2e3,a=20,j=2,e=.5,k=1e3/i,b=1e3/a,o="transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd",y=document.createElement("div").style,p=null!=y.transition||null!=y.webkitTransition||null!=y.mozTransition||null!=y.oTransition,w=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame,l=window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver,s=function(a){var b;return b=document.createElement("div"),b.innerHTML=a,b.children[0]},v=function(a,b){return a.className=a.className.replace(new RegExp("(^| )"+b.split(" ").join("|")+"( |$)","gi")," ")},r=function(a,b){return v(a,b),a.className+=" "+b},z=function(a,b){var c;return null!=document.createEvent?(c=document.createEvent("HTMLEvents"),c.initEvent(b,!0,!0),a.dispatchEvent(c)):void 0},u=function(){var a,b;return null!=(a=null!=(b=window.performance)&&"function"==typeof b.now?b.now():void 0)?a:+new Date},x=function(a,b){return null==b&&(b=0),b?(a*=Math.pow(10,b),a+=.5,a=Math.floor(a),a/=Math.pow(10,b)):Math.round(a)},A=function(a){return 0>a?Math.ceil(a):Math.floor(a)},t=function(a){return a-x(a)},C=!1,(B=function(){var a,b,c,d,e;if(!C&&null!=window.jQuery){for(C=!0,d=["html","text"],e=[],b=0,c=d.length;c>b;b++)a=d[b],e.push(function(a){var b;return b=window.jQuery.fn[a],window.jQuery.fn[a]=function(a){var c;return null==a||null==(null!=(c=this[0])?c.odometer:void 0)?b.apply(this,arguments):this[0].odometer.update(a)}}(a));return e}})(),setTimeout(B,0),m=function(){function a(b){var c,d,e,g,h,i,l,m,n,o,p=this;if(this.options=b,this.el=this.options.el,null!=this.el.odometer)return this.el.odometer;this.el.odometer=this,m=a.options;for(d in m)g=m[d],null==this.options[d]&&(this.options[d]=g);null==(h=this.options).duration&&(h.duration=f),this.MAX_VALUES=this.options.duration/k/j|0,this.resetFormat(),this.value=this.cleanValue(null!=(n=this.options.value)?n:""),this.renderInside(),this.render();try{for(o=["innerHTML","innerText","textContent"],i=0,l=o.length;l>i;i++)e=o[i],null!=this.el[e]&&!function(a){return Object.defineProperty(p.el,a,{get:function(){var b;return"innerHTML"===a?p.inside.outerHTML:null!=(b=p.inside.innerText)?b:p.inside.textContent},set:function(a){return p.update(a)}})}(e)}catch(q){c=q,this.watchForMutations()}}return a.prototype.renderInside=function(){return this.inside=document.createElement("div"),this.inside.className="odometer-inside",this.el.innerHTML="",this.el.appendChild(this.inside)},a.prototype.watchForMutations=function(){var a,b=this;if(null!=l)try{return null==this.observer&&(this.observer=new l(function(){var a;return a=b.el.innerText,b.renderInside(),b.render(b.value),b.update(a)})),this.watchMutations=!0,this.startWatchingMutations()}catch(c){a=c}},a.prototype.startWatchingMutations=function(){return this.watchMutations?this.observer.observe(this.el,{childList:!0}):void 0},a.prototype.stopWatchingMutations=function(){var a;return null!=(a=this.observer)?a.disconnect():void 0},a.prototype.cleanValue=function(a){var b;return"string"==typeof a&&(a=a.replace(null!=(b=this.format.radix)?b:".","<radix>"),a=a.replace(/[.,]/g,""),a=a.replace("<radix>","."),a=parseFloat(a,10)||0),x(a,this.format.precision)},a.prototype.bindTransitionEnd=function(){var a,b,c,d,e,f,g=this;if(!this.transitionEndBound){for(this.transitionEndBound=!0,b=!1,e=o.split(" "),f=[],c=0,d=e.length;d>c;c++)a=e[c],f.push(this.el.addEventListener(a,function(){return b?!0:(b=!0,setTimeout(function(){return g.render(),b=!1,z(g.el,"odometerdone")},0),!0)},!1));return f}},a.prototype.resetFormat=function(){var a,b,d,e,f,g,i,j;if(a=null!=(i=this.options.format)?i:c,a||(a="d"),d=h.exec(a),!d)throw new Error("Odometer: Unparsable digit format");return j=d.slice(1,4),g=j[0],f=j[1],b=j[2],e=(null!=b?b.length:void 0)||0,this.format={repeating:g,radix:f,precision:e}},a.prototype.render=function(a){var b,c,d,e,f,g,h;for(null==a&&(a=this.value),this.stopWatchingMutations(),this.resetFormat(),this.inside.innerHTML="",f=this.options.theme,b=this.el.className.split(" "),e=[],g=0,h=b.length;h>g;g++)c=b[g],c.length&&((d=/^odometer-theme-(.+)$/.exec(c))?f=d[1]:/^odometer(-|$)/.test(c)||e.push(c));return e.push("odometer"),p||e.push("odometer-no-transitions"),e.push(f?"odometer-theme-"+f:"odometer-auto-theme"),this.el.className=e.join(" "),this.ribbons={},this.formatDigits(a),this.startWatchingMutations()},a.prototype.formatDigits=function(a){var b,c,d,e,f,g,h,i,j,k;if(this.digits=[],this.options.formatFunction)for(d=this.options.formatFunction(a),j=d.split("").reverse(),f=0,h=j.length;h>f;f++)c=j[f],c.match(/0-9/)?(b=this.renderDigit(),b.querySelector(".odometer-value").innerHTML=c,this.digits.push(b),this.insertDigit(b)):this.addSpacer(c);else for(e=!this.format.precision||!t(a)||!1,k=a.toString().split("").reverse(),g=0,i=k.length;i>g;g++)b=k[g],"."===b&&(e=!0),this.addDigit(b,e)},a.prototype.update=function(a){var b,c=this;return a=this.cleanValue(a),(b=a-this.value)?(v(this.el,"odometer-animating-up odometer-animating-down odometer-animating"),b>0?r(this.el,"odometer-animating-up"):r(this.el,"odometer-animating-down"),this.stopWatchingMutations(),this.animate(a),this.startWatchingMutations(),setTimeout(function(){return c.el.offsetHeight,r(c.el,"odometer-animating")},0),this.value=a):void 0},a.prototype.renderDigit=function(){return s(d)},a.prototype.insertDigit=function(a,b){return null!=b?this.inside.insertBefore(a,b):this.inside.children.length?this.inside.insertBefore(a,this.inside.children[0]):this.inside.appendChild(a)},a.prototype.addSpacer=function(a,b,c){var d;return d=s(g),d.innerHTML=a,c&&r(d,c),this.insertDigit(d,b)},a.prototype.addDigit=function(a,b){var c,d,e,f;if(null==b&&(b=!0),"-"===a)return this.addSpacer(a,null,"odometer-negation-mark");if("."===a)return this.addSpacer(null!=(f=this.format.radix)?f:".",null,"odometer-radix-mark");if(b)for(e=!1;;){if(!this.format.repeating.length){if(e)throw new Error("Bad odometer format without digits");this.resetFormat(),e=!0}if(c=this.format.repeating[this.format.repeating.length-1],this.format.repeating=this.format.repeating.substring(0,this.format.repeating.length-1),"d"===c)break;this.addSpacer(c)}return d=this.renderDigit(),d.querySelector(".odometer-value").innerHTML=a,this.digits.push(d),this.insertDigit(d)},a.prototype.animate=function(a){return p&&"count"!==this.options.animation?this.animateSlide(a):this.animateCount(a)},a.prototype.animateCount=function(a){var c,d,e,f,g,h=this;if(d=+a-this.value)return f=e=u(),c=this.value,(g=function(){var i,j,k;return u()-f>h.options.duration?(h.value=a,h.render(),void z(h.el,"odometerdone")):(i=u()-e,i>b&&(e=u(),k=i/h.options.duration,j=d*k,c+=j,h.render(Math.round(c))),null!=w?w(g):setTimeout(g,b))})()},a.prototype.getDigitCount=function(){var a,b,c,d,e,f;for(d=1<=arguments.length?G.call(arguments,0):[],a=e=0,f=d.length;f>e;a=++e)c=d[a],d[a]=Math.abs(c);return b=Math.max.apply(Math,d),Math.ceil(Math.log(b+1)/Math.log(10))},a.prototype.getFractionalDigitCount=function(){var a,b,c,d,e,f,g;for(e=1<=arguments.length?G.call(arguments,0):[],b=/^\-?\d*\.(\d*?)0*$/,a=f=0,g=e.length;g>f;a=++f)d=e[a],e[a]=d.toString(),c=b.exec(e[a]),e[a]=null==c?0:c[1].length;return Math.max.apply(Math,e)},a.prototype.resetDigits=function(){return this.digits=[],this.ribbons=[],this.inside.innerHTML="",this.resetFormat()},a.prototype.animateSlide=function(a){var b,c,d,f,g,h,i,j,k,l,m,n,o,p,q,s,t,u,v,w,x,y,z,B,C,D,E;if(s=this.value,j=this.getFractionalDigitCount(s,a),j&&(a*=Math.pow(10,j),s*=Math.pow(10,j)),d=a-s){for(this.bindTransitionEnd(),f=this.getDigitCount(s,a),g=[],b=0,m=v=0;f>=0?f>v:v>f;m=f>=0?++v:--v){if(t=A(s/Math.pow(10,f-m-1)),i=A(a/Math.pow(10,f-m-1)),h=i-t,Math.abs(h)>this.MAX_VALUES){for(l=[],n=h/(this.MAX_VALUES+this.MAX_VALUES*b*e),c=t;h>0&&i>c||0>h&&c>i;)l.push(Math.round(c)),c+=n;l[l.length-1]!==i&&l.push(i),b++}else l=function(){E=[];for(var a=t;i>=t?i>=a:a>=i;i>=t?a++:a--)E.push(a);return E}.apply(this);for(m=w=0,y=l.length;y>w;m=++w)k=l[m],l[m]=Math.abs(k%10);g.push(l)}for(this.resetDigits(),D=g.reverse(),m=x=0,z=D.length;z>x;m=++x)for(l=D[m],this.digits[m]||this.addDigit(" ",m>=j),null==(u=this.ribbons)[m]&&(u[m]=this.digits[m].querySelector(".odometer-ribbon-inner")),this.ribbons[m].innerHTML="",0>d&&(l=l.reverse()),o=C=0,B=l.length;B>C;o=++C)k=l[o],q=document.createElement("div"),q.className="odometer-value",q.innerHTML=k,this.ribbons[m].appendChild(q),o===l.length-1&&r(q,"odometer-last-value"),0===o&&r(q,"odometer-first-value");return 0>t&&this.addDigit("-"),p=this.inside.querySelector(".odometer-radix-mark"),null!=p&&p.parent.removeChild(p),j?this.addSpacer(this.format.radix,this.digits[j-1],"odometer-radix-mark"):void 0}},a}(),m.options=null!=(E=window.odometerOptions)?E:{},setTimeout(function(){var a,b,c,d,e;if(window.odometerOptions){d=window.odometerOptions,e=[];for(a in d)b=d[a],e.push(null!=(c=m.options)[a]?(c=m.options)[a]:c[a]=b);return e}},0),m.init=function(){var a,b,c,d,e,f;if(null!=document.querySelectorAll){for(b=document.querySelectorAll(m.options.selector||".odometer"),f=[],c=0,d=b.length;d>c;c++)a=b[c],f.push(a.odometer=new m({el:a,value:null!=(e=a.innerText)?e:a.textContent}));return f}},null!=(null!=(F=document.documentElement)?F.doScroll:void 0)&&null!=document.createEventObject?(D=document.onreadystatechange,document.onreadystatechange=function(){return"complete"===document.readyState&&m.options.auto!==!1&&m.init(),null!=D?D.apply(this,arguments):void 0}):document.addEventListener("DOMContentLoaded",function(){return m.options.auto!==!1?m.init():void 0},!1),"function"==typeof define&&define.amd?define(["jquery"],function(){return m}):typeof exports===!1?module.exports=m:window.Odometer=m}).call(this);
;
/**!
 * easyPieChart
 * Lightweight plugin to render simple, animated and retina optimized pie charts
 *
 * @license 
 * @author Robert Fleischmann <rendro87@gmail.com> (http://robert-fleischmann.de)
 * @version 2.1.5
 **/
!function(a,b){"object"==typeof exports?module.exports=b(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],b):b(a.jQuery)}(this,function(a){var b=function(a,b){var c,d=document.createElement("canvas");a.appendChild(d),"undefined"!=typeof G_vmlCanvasManager&&G_vmlCanvasManager.initElement(d);var e=d.getContext("2d");d.width=d.height=b.size;var f=1;window.devicePixelRatio>1&&(f=window.devicePixelRatio,d.style.width=d.style.height=[b.size,"px"].join(""),d.width=d.height=b.size*f,e.scale(f,f)),e.translate(b.size/2,b.size/2),e.rotate((-0.5+b.rotate/180)*Math.PI);var g=(b.size-b.lineWidth)/2;b.scaleColor&&b.scaleLength&&(g-=b.scaleLength+2),Date.now=Date.now||function(){return+new Date};var h=function(a,b,c){c=Math.min(Math.max(-1,c||0),1);var d=0>=c?!0:!1;e.beginPath(),e.arc(0,0,g,0,2*Math.PI*c,d),e.strokeStyle=a,e.lineWidth=b,e.stroke()},i=function(){var a,c;e.lineWidth=1,e.fillStyle=b.scaleColor,e.save();for(var d=24;d>0;--d)d%6===0?(c=b.scaleLength,a=0):(c=.6*b.scaleLength,a=b.scaleLength-c),e.fillRect(-b.size/2+a,0,c,1),e.rotate(Math.PI/12);e.restore()},j=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(a){window.setTimeout(a,1e3/60)}}(),k=function(){b.scaleColor&&i(),b.trackColor&&h(b.trackColor,b.lineWidth,1)};this.getCanvas=function(){return d},this.getCtx=function(){return e},this.clear=function(){e.clearRect(b.size/-2,b.size/-2,b.size,b.size)},this.draw=function(a){b.scaleColor||b.trackColor?e.getImageData&&e.putImageData?c?e.putImageData(c,0,0):(k(),c=e.getImageData(0,0,b.size*f,b.size*f)):(this.clear(),k()):this.clear(),e.lineCap=b.lineCap;var d;d="function"==typeof b.barColor?b.barColor(a):b.barColor,h(d,b.lineWidth,a/100)}.bind(this),this.animate=function(a,c){var d=Date.now();b.onStart(a,c);var e=function(){var f=Math.min(Date.now()-d,b.animate.duration),g=b.easing(this,f,a,c-a,b.animate.duration);this.draw(g),b.onStep(a,c,g),f>=b.animate.duration?b.onStop(a,c):j(e)}.bind(this);j(e)}.bind(this)},c=function(a,c){var d={barColor:"#ef1e25",trackColor:"#f9f9f9",scaleColor:"#dfe0e0",scaleLength:5,lineCap:"round",lineWidth:3,size:110,rotate:0,animate:{duration:1e3,enabled:!0},easing:function(a,b,c,d,e){return b/=e/2,1>b?d/2*b*b+c:-d/2*(--b*(b-2)-1)+c},onStart:function(){},onStep:function(){},onStop:function(){}};if("undefined"!=typeof b)d.renderer=b;else{if("undefined"==typeof SVGRenderer)throw new Error("Please load either the SVG- or the CanvasRenderer");d.renderer=SVGRenderer}var e={},f=0,g=function(){this.el=a,this.options=e;for(var b in d)d.hasOwnProperty(b)&&(e[b]=c&&"undefined"!=typeof c[b]?c[b]:d[b],"function"==typeof e[b]&&(e[b]=e[b].bind(this)));e.easing="string"==typeof e.easing&&"undefined"!=typeof jQuery&&jQuery.isFunction(jQuery.easing[e.easing])?jQuery.easing[e.easing]:d.easing,"number"==typeof e.animate&&(e.animate={duration:e.animate,enabled:!0}),"boolean"!=typeof e.animate||e.animate||(e.animate={duration:1e3,enabled:e.animate}),this.renderer=new e.renderer(a,e),this.renderer.draw(f),a.dataset&&a.dataset.percent?this.update(parseFloat(a.dataset.percent)):a.getAttribute&&a.getAttribute("data-percent")&&this.update(parseFloat(a.getAttribute("data-percent")))}.bind(this);this.update=function(a){return a=parseFloat(a),e.animate.enabled?this.renderer.animate(f,a):this.renderer.draw(a),f=a,this}.bind(this),this.disableAnimation=function(){return e.animate.enabled=!1,this},this.enableAnimation=function(){return e.animate.enabled=!0,this},g()};a.fn.easyPieChart=function(b){return this.each(function(){var d;a.data(this,"easyPieChart")||(d=a.extend({},b,a(this).data()),a.data(this,"easyPieChart",new c(this,d)))})}});
;
/**
 * Number counters
 * -----------------------------------------------------------------------------
 */
 (function($) {

 	$( document ).ready( function() {
 		var odomer_default_value = typeof thb_odometer_default_value !== 'undefined' ? thb_odometer_default_value : 0,
 			odomer_default_format = typeof thb_odometer_default_format !== 'undefined' ? thb_odometer_default_format : '';

 		$( ".thb-counter-wrapper" ).each( function() {
 			var el = $(this),
 				counter = $(this).find( ".thb-counter" );

 			el.data( "thb-counter", new Odometer({
 				el: counter.get(0),
 				value: odomer_default_value,
 				format: odomer_default_format
 			}) );
 		} );
 	} );

 })(jQuery);

/**
 * Radial pie charts
 * -----------------------------------------------------------------------------
 */
(function($) {

	$('.thb-radial-chart-data').each( function() {
		var el = $(this),
			opts = {
				scaleLength: false,
				lineWidth: el.data( 'width' ),
				lineCap: el.data( 'cap' ),
				size: el.data( 'size' ),
				barColor: el.data( 'color' ),
				trackColor: el.data( 'track' ),
				animate: {
					duration: 2500,
					enabled: false
				},
				onStep: function( from, to, percent ) {
					el.parent().find( ".thb-radial-chart-step-value" ).html( Math.round( percent ) );
				}
			};

		el.easyPieChart(opts);
	});

})(jQuery);

/**
 * Toggle
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_toggle = function( parameters ) {
		var parameters = jQuery.extend({
			speed: 350,
			easing: 'swing',
			trigger: '.thb-toggle-trigger',
			content: '.thb-toggle-content',
			openClass: 'open',
			before: function() {},
			after: function() {}
		}, parameters);

		return this.each(function() {
			var container = $(this),
				trigger = container.find(parameters.trigger),
				content = container.find(parameters.content);

			/**
			 * Toggle data
			 */
			this.toggle_speed = parameters.speed,
			this.toggle_easing = parameters.easing;
			container.toggle_open = container.hasClass(parameters.openClass);

			/**
			 * Open the toggle
			 */
			container.bind('thb_toggle.open', function() {
				container.addClass(parameters.openClass);
				content.slideDown(this.toggle_speed, this.toggle_easing);
				container.toggle_open = true;
			});

			/**
			 * Close the toggle
			 */
			container.bind('thb_toggle.close', function() {
				container.removeClass(parameters.openClass);
				content.slideUp(this.toggle_speed, this.toggle_easing);
				container.toggle_open = false;
			});

			/**
			 * Before
			 */
			container.bind('thb_toggle.before', parameters.before);

			/**
			 * After
			 */
			container.bind('thb_toggle.after', parameters.after);

			/**
			 * Events
			 */
			trigger.click(function() {
				if ( container.attr( "data-accordion" ) == "1" && container.toggle_open ) {
					return false;
				}

				container.trigger('thb_toggle.before');
				container.trigger( container.toggle_open ? 'thb_toggle.close' : 'thb_toggle.open' );
				container.trigger('thb_toggle.after');

				return false;
			});

			/**
			 * Init
			 */
			if( container.toggle_open ) {
				content.show();
			}
		});
	}

	$(document).ready(function() {
		$('.thb-toggle').thb_toggle();
	});

})(jQuery);

/**
 * Accordion
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_accordion = function( parameters ) {
		var parameters = jQuery.extend({
			toggle: '.thb-toggle',
			speed: 350,
			easing: 'swing'
		}, parameters);

		return this.each(function( i, el ) {
			var container = $(this),
				items = container.find(parameters.toggle);

			items.each(function() {
				// $( this ).attr( "data-accordion", "1" );

				$(this).bind('thb_toggle.before', function() {
					this.toggle_speed = parameters.speed;
					this.toggle_easing = parameters.easing;

					items.not( $(this) ).each(function() {
						$(this).trigger('thb_toggle.close');
					});
				});
			});
		});
	}

	$(document).ready(function() {
		$('.thb-section-column-block-thb_accordion').thb_accordion();
	});

})(jQuery);

/**
 * Tabs
 * -----------------------------------------------------------------------------
 */
(function($) {

	$.fn.thb_tabs = function( parameters ) {
		var parameters = jQuery.extend({
			nav: '.thb-tabs-nav',
			tabContents: '.thb-tabs-contents',
			contents: '.thb-tab-content',
			openClass: 'open',
			speed: 350,
			easing: 'swing',
			callback: function() {}
		}, parameters);

		return this.each(function() {
			var container = $(this),
				nav = container.find(parameters.nav),
				triggers = nav.find('a'),
				tabContents = container.find(parameters.tabContents),
				contents = container.find(parameters.contents);

			container.bind('thb_tabs.goto', function(e, i) {
				triggers.parent().removeClass(parameters.openClass);
				triggers
					.eq(i)
					.parent()
					.addClass(parameters.openClass);

				contents
					.hide()
					.eq(i)
						.show();

				setTimeout( function() {
					parameters.callback();
				}, 2 );
			});

			triggers.each(function(i, el) {
				$(this).click(function() {
					container.trigger('thb_tabs.goto', [i]);
					return false;
				});
			});

			/**
			 * Init
			 */
			var idx = 0;
			container.trigger('thb_tabs.goto', [idx]);

			tabContents.css('min-height', nav.height());
		});
	};

	$( document ).ready( function() {
		window.thb_builder_calls.push( function( root ) {
			$( '.thb-section-column-block-thb_tabs', root ).thb_tabs();
		} );
	} );

})(jQuery);

/**
 * Google maps.
 * -----------------------------------------------------------------------------
 */
( function( $ ) {
	window.thb_builderInitMap = function() {
		if ( typeof google === "undefined" ) {
			return;
		}

		// Map
		if ( $( ".thb-section-column-block-thb_google_map .thb-google-map" ).length ) {
			$( ".thb-section-column-block-thb_google_map .thb-google-map" ).each( function() {
				var latlong = $( this ).data( "latlong" ).split(","),
					zoom = $( this ).data( "zoom" ),
					marker_icon = $( this ).data( "marker_icon" ),
					scrollwheel = $( this ).data( "scrollwheel" ),
					styles = $( this ).data( "styles" ),
					center = false;

				if ( latlong[0] !== undefined && latlong[1] !== undefined ) {
					center = new google.maps.LatLng( latlong[0], latlong[1] );

					var is_mobile = $( "body" ).hasClass( "thb-mobile" ),
						map = $( this ).get( 0 ),
						google_map = new google.maps.Map( map, {
							"styles": styles,
							"zoom": parseInt( zoom, 10 ),
							"center": center,
							"scrollwheel": parseInt( scrollwheel, 10 ),
							"draggable": is_mobile ? false : true,
							"panControl": false,
							"disableDefaultUI": true
						} );

						var marker = new google.maps.Marker( {
							position: center,
							map: google_map,
							title: "",
							animation: google.maps.Animation.DROP,
							icon: marker_icon
						} );

					$( window ).on( "resize", function() {
						google_map.setCenter( center );
					} );
				}
			} );
		}
	};

	$( document ).ready( function() {
		window.thb_builderInitMap();
	} );
} )( jQuery );
;
/**
 * photoset-grid - v1.0.1
 * 2014-04-08
 * jQuery plugin to arrange images into a flexible grid
 * http://stylehatch.github.com/photoset-grid/
 *
 * Copyright 2014 Jonathan Moore - Style Hatch
 */

 /*jshint browser: true, curly: true, eqeqeq: true, forin: false, immed: false, newcap: true, noempty: true, strict: true, undef: true, devel: true */
;(function ( $, window, document, undefined ) {

  'use strict';

  // Plugin name and default settings
  var pluginName = "photosetGrid",
    defaults = {
      // Required
      // set the width of the container
      width         : '100%',
      // the space between the rows / columns
      gutter        : '0px',

      // Optional
      // wrap the images in a vs. div and link to the data-highres images
      highresLinks  : false,
      // threshold for the lowres image, if container is > swap the data-highres
      lowresWidth   : 500,
      // relational attr to apply to the links for lightbox use
      rel           : '',

      // add a border to each image
      borderActive: false,
      // set border width
      borderWidth: '5px',
      // set border color
      borderColor: '#000000',
      // set border radius
      borderRadius: '0',
      // if true it will remove "double" borders
      borderRemoveDouble: false,

      // Call back events
      onInit        : function(){},
      onComplete    : function(){}
    };

    // Plugin constructor
    function Plugin( element, options ) {
      this.element = element;
      this.options = $.extend( {}, defaults, options );

      this._defaults = defaults;
      this._name = pluginName;

      this.init();
    }

    Plugin.prototype = {

      init: function() {
        // Call the optional onInit event set when the plugin is called
        this.options.onInit();

        this._setupRows(this.element, this.options);
        this._setupColumns(this.element, this.options);

      },

      _callback: function(elem){
        // Call the optional onComplete event after the plugin has been completed
        this.options.onComplete(elem);
      },

      _setupRows: function(  elem, options ){
        // Convert the layout string into an array to build the DOM structures
        if(options.layout) {
          // Check for layout defined in plugin call
          this.layout = options.layout;
        } else if($(elem).attr('data-layout')) {
          // If not defined in the options, check for the data-layout attr
          this.layout = $(elem).attr('data-layout');
        } else {
          // Otherwise give it a stacked layout (no grids for you)
          // Generate a layout string of all ones based on the number of images
          var stackedLayout = "";
          var defaultColumns = 1;
          for (var imgs=0; imgs<$(elem).find('img').length; imgs++ ) {
            stackedLayout = stackedLayout + defaultColumns.toString();
          }
          this.layout = stackedLayout;
        }

        // Dump the layout into a rows array
        // Convert the array into all numbers vs. strings
        this.rows = this.layout.split('');
        for (var i in this.rows ) {
          this.rows[i] = parseInt(this.rows[i], 10);
        }

        var $images = $(elem).find('img');
        var imageIndex = 0;

        $.each(this.rows, function(i, val){
          var rowStart = imageIndex;
          var rowEnd = imageIndex + val;

          // Wrap each set of images in a row into a container div
          $images.slice(rowStart, rowEnd).wrapAll('<div class="photoset-row cols-' + val + '"></div>');

          imageIndex = rowEnd;
        });

        $(elem).find('.photoset-row:not(:last-child)').css({
          'margin-bottom': options.gutter
        });
      },

      _setupColumns: function(  elem, options ){

        // Reference to this Plugin
        var $this = this;

        var setupStyles = function(waitForImagesLoaded){
          var $rows = $(elem).find('.photoset-row');
          var $images = $(elem).find('img');

          // Wrap the images in links to the highres or regular image
          // Otherwise wrap in div.photoset-cell
          if(options.highresLinks){
            $images.each(function(){
              var title;
              // If the image has a title pass it on
              if($(this).attr('title')){
                  title = ' title="' + $(this).attr('title') + '"';
              } else {
                  title = '';
              }
              var highres;
              // If a highres image exists link it up!
              if($(this).attr('data-highres')){
                  highres = $(this).attr('data-highres');
              } else {
                  highres = $(this).attr('src');
              }
              $(this).wrapAll('<a href="' + highres + '"' + title + ' class="photoset-cell highres-link" />');
              if(options.borderActive){
                $(this).wrapAll('<span class="photoset-content-border" />');
              }
            });

            // Apply the optional rel
            if(options.rel){
              $images.parent().attr('rel', options.rel);
            }

          } else {
            $images.each(function(){
              if(options.borderActive){
                $(this).wrapAll('<div class="photoset-cell photoset-cell--border" />');
                $(this).wrapAll('<div class="photoset-content-border" />');
              } else {
                $(this).wrapAll('<div class="photoset-cell" />');
              }
            });
          }

          var $cells = $(elem).find('.photoset-cell');
          var $cols1 = $(elem).find('.cols-1 .photoset-cell');
          var $cols2 = $(elem).find('.cols-2 .photoset-cell');
          var $cols3 = $(elem).find('.cols-3 .photoset-cell');
          var $cols4 = $(elem).find('.cols-4 .photoset-cell');
          var $cols5 = $(elem).find('.cols-5 .photoset-cell');
          var $cellBorder = $(elem).find('.photoset-content-border');

          // Apply styles initial structure styles to the grid
          $(elem).css({
            'width': options.width
          });
          $rows.css({
            'clear': 'left',
            'display': 'block',
            'overflow': 'hidden'
          });
          $cells.css({
            'float': 'left',
            'display': 'block',
            'line-height': '0',
            '-webkit-box-sizing': 'border-box',
            '-moz-box-sizing': 'border-box',
            'box-sizing': 'border-box'
          });
          $images.css({
            'width': '100%',
            'height': 'auto'
          });
          if(options.borderActive){
            $cellBorder.css({
              'display': 'block',
              'border': options.borderWidth + ' solid ' + options.borderColor,
              'border-radius': options.borderRadius,
              'overflow': 'hidden',
              '-webkit-box-sizing': 'border-box',
              '-moz-box-sizing': 'border-box',
              'box-sizing': 'border-box'
            });
          }

          // if the imaged did not have height/width attr set them
          if (waitForImagesLoaded) {
            $images.each(function(){
              $(this).attr('height', $(this).height());
              $(this).attr('width', $(this).width());
            });
          }

          // Set the width of the cells based on the number of columns in the row
          $cols1.css({ 'width': '100%' });
          $cols2.css({ 'width': '50%' });
          $cols3.css({ 'width': '33.3%' });
          $cols4.css({ 'width': '25%' });
          $cols5.css({ 'width': '20%' });

          var gutterVal = parseInt(options.gutter, 10);
          // Apply 50% gutter to left and right
          // this provides equal gutters a high values
          // $(elem).find('.photoset-cell:not(:last-child)').css({
          //   'padding-right': (gutterVal / 2) + 'px'
          // });
          // $(elem).find('.photoset-cell:not(:first-child)').css({
          //   'padding-left': (gutterVal / 2) + 'px'
          // });

		$(elem).find('.photoset-cell').css({
            'padding-left': (gutterVal / 2) + 'px',
            'padding-right': (gutterVal / 2) + 'px'
          });

		$rows.css( {
			'margin-left': - (gutterVal / 2) + 'px',
            'margin-right': - (gutterVal / 2) + 'px'
		} );

          // If 'borderRemoveDouble' is true, let us remove the extra gutter border
          if(options.borderRemoveDouble){
            $(elem).find('.photoset-row').not(':eq(0)').find('.photoset-content-border').css({'border-top': 'none'});
            $(elem).find('.photoset-row').not('.cols-1').find('.photoset-content-border').not(":eq(0)").css({'border-left': 'none'});
          }

          function resizePhotosetGrid(){

            // Give the values a floor to prevent misfires
            var w = $(elem).width().toString();

            if( w !== $(elem).attr('data-width') ) {
              $rows.each(function(k){
                var $shortestImg = $(this).find('img:eq(0)');

                $(this).find('img').each(function(){
                  var $img = $(this);
                  if( $img.attr('height') < $shortestImg.attr('height') ){
                      $shortestImg = $(this);
                  }

                  if(parseInt($img.css('width'), 10) > options.lowresWidth && $img.attr('data-highres')){
                      $img.attr('src', $img.attr('data-highres'));
                  }
                });

                // Get the row height from the calculated/real height/width of the shortest image
                var rowHeight = ( $shortestImg.attr('height') * parseInt($shortestImg.css('width'), 10) ) / $shortestImg.attr('width');
                // Adding a buffer to shave off a few pixels in height
                var bufferHeight = Math.floor(rowHeight * 0.025);
                $(this).height( rowHeight - bufferHeight );

                // If border is set to true, then add the parent row height to each .photoset-content-border
                if(options.borderActive){
                  $(this).find('.photoset-content-border').each(function(){
                    $(this).css({'height': rowHeight - bufferHeight});
                  });
                }

                $(this).find('img').each(function(){
                  // Get the image height from the calculated/real height/width
                  var imageHeight = ( $(this).attr('height') * parseInt($(this).css('width'), 10) ) / $(this).attr('width');
                  var marginOffset = ( (rowHeight - imageHeight) * 0.5 ) + 'px';
                  $(this).css({
                    'margin-top' : marginOffset
                  });
                });

              });
              $(elem).attr('data-width', w );
            }

          }
          resizePhotosetGrid();

          $(window).on("resize", function() {
            resizePhotosetGrid();
          });

        };

        // By default the plugin will wait until all of the images are loaded to setup the styles
        var waitForImagesLoaded = true;
        var hasDimensions = true;

        // Loops through all of the images in the photoset
        // if the height and width exists for all images set waitForImagesLoaded to false
        $(elem).find('img').each(function(){
          hasDimensions = hasDimensions & ( !!$(this).attr('height') & !!$(this).attr('width') );
        });

        waitForImagesLoaded = !hasDimensions;

        // Only use imagesLoaded() if waitForImagesLoaded
        if(waitForImagesLoaded) {
          $(elem).imagesLoaded(function(){
            setupStyles(waitForImagesLoaded);
            $this._callback(elem);
          });
        } else {
          setupStyles(waitForImagesLoaded);
          $this._callback(elem);
        }

      }

    };

    // plugin wrapper around the constructor
    $.fn[pluginName] = function ( options ) {
      return this.each(function () {
        if (!$.data(this, "plugin_" + pluginName)) {
          $.data(this, "plugin_" + pluginName, new Plugin( this, options ));
        }
      });
    };

    /*!
     * jQuery imagesLoaded plugin v2.1.1
     * http://github.com/desandro/imagesloaded
     *
     * MIT License. by Paul Irish et al.
     */

    /*jshint curly: true, eqeqeq: true, noempty: true, strict: true, undef: true, browser: true */
    /*global jQuery: false */

    // blank image data-uri bypasses webkit log warning (thx doug jones)
    var BLANK = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';

    $.fn.imagesLoaded = function( callback ) {
      var $this = this,
        deferred = $.isFunction($.Deferred) ? $.Deferred() : 0,
        hasNotify = $.isFunction(deferred.notify),
        $images = $this.find('img').add( $this.filter('img') ),
        loaded = [],
        proper = [],
        broken = [];

      // Register deferred callbacks
      if ($.isPlainObject(callback)) {
        $.each(callback, function (key, value) {
          if (key === 'callback') {
            callback = value;
          } else if (deferred) {
            deferred[key](value);
          }
        });
      }

      function doneLoading() {
        var $proper = $(proper),
          $broken = $(broken);

        if ( deferred ) {
          if ( broken.length ) {
            deferred.reject( $images, $proper, $broken );
          } else {
            deferred.resolve( $images );
          }
        }

        if ( $.isFunction( callback ) ) {
          callback.call( $this, $images, $proper, $broken );
        }
      }

      function imgLoadedHandler( event ) {
        imgLoaded( event.target, event.type === 'error' );
      }

      function imgLoaded( img, isBroken ) {
        // don't proceed if BLANK image, or image is already loaded
        if ( img.src === BLANK || $.inArray( img, loaded ) !== -1 ) {
          return;
        }

        // store element in loaded images array
        loaded.push( img );

        // keep track of broken and properly loaded images
        if ( isBroken ) {
          broken.push( img );
        } else {
          proper.push( img );
        }

        // cache image and its state for future calls
        $.data( img, 'imagesLoaded', { isBroken: isBroken, src: img.src } );

        // trigger deferred progress method if present
        if ( hasNotify ) {
          deferred.notifyWith( $(img), [ isBroken, $images, $(proper), $(broken) ] );
        }

        // call doneLoading and clean listeners if all images are loaded
        if ( $images.length === loaded.length ) {
          setTimeout( doneLoading );
          $images.unbind( '.imagesLoaded', imgLoadedHandler );
        }
      }

      // if no images, trigger immediately
      if ( !$images.length ) {
        doneLoading();
      } else {
        $images.bind( 'load.imagesLoaded error.imagesLoaded', imgLoadedHandler )
        .each( function( i, el ) {
          var src = el.src;

          // find out if this image has been already checked for status
          // if it was, and src has not changed, call imgLoaded on it
          var cached = $.data( el, 'imagesLoaded' );
          if ( cached && cached.src === src ) {
            imgLoaded( el, cached.isBroken );
            return;
          }

          // if complete is true and browser supports natural sizes, try
          // to check for image status manually
          if ( el.complete && el.naturalWidth !== undefined ) {
            imgLoaded( el, el.naturalWidth === 0 || el.naturalHeight === 0 );
            return;
          }

          // cached images don't fire load sometimes, so we reset src, but only when
          // dealing with IE, or image is complete (loaded) and failed manual check
          // webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
          if ( el.readyState || el.complete ) {
            el.src = BLANK;
            el.src = src;
          }
        });
      }

      return deferred ? deferred.promise( $this ) : $this;
    };

    /*
     * throttledresize: special jQuery event that happens at a reduced rate compared to "resize"
     *
     * latest version and complete README available on Github:
     * https://github.com/louisremi/jquery-smartresize
     *
     * Copyright 2012 @louis_remi
     * Licensed under the MIT license.
     *
     * This saved you an hour of work?
     * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
     */

    var $event = $.event,
      $special,
      dummy = {_:0},
      frame = 0,
      wasResized, animRunning;

    $special = $event.special.throttledresize = {
      setup: function() {
        $( this ).on( "resize", $special.handler );
      },
      teardown: function() {
        $( this ).off( "resize", $special.handler );
      },
      handler: function( event, execAsap ) {
        // Save the context
        var context = this,
          args = arguments;

        wasResized = true;

        if ( !animRunning ) {
          setInterval(function(){
            frame++;

            if ( frame > $special.threshold && wasResized || execAsap ) {
              // set correct event type
              event.type = "throttledresize";
              $event.dispatch.apply( context, args );
              wasResized = false;
              frame = 0;
            }
            if ( frame > 9 ) {
              $(dummy).stop();
              animRunning = false;
              frame = 0;
            }
          }, 30);
          animRunning = true;
        }
      },
      threshold: 0
    };

})( jQuery, window, document );
;
( function( $ ) {
	"use strict";

	window.thb_photogallery_adjust = function( photogallery_container, old_height, target_photogallery, new_data_url ) {
		var scroll = photogallery_container.outerHeight() - old_height;

		$.scrollTo( "+=" + scroll + "px", 400, {
			"easing": "easeInOutQuint",
			"onAfter": function() {
				if( ! target_photogallery.find("#thb-infinite-scroll-nav").length ) {
					$("#thb-infinite-scroll-nav").remove();
				}
				else {
					photogallery_container.attr("data-url", new_data_url);
				}

				if ( window.thb_photogallery_adjust_callback !== undefined ) {
					window.thb_photogallery_adjust_callback();
				}
			}
		} );
	};

	$( document ).on( "ready", function() {
		var isotopePhotogalleries = $( ".thb-photogallery" ),
			photosetPhotogalleries = $( /*".thb-photogallery-photoset-grid-container */".thb-photoset-grid" );

		photosetPhotogalleries.each( function( index ) {
			var photoset = $( this );

			$.thb.loadImage( photoset, {
				allLoaded: function() {
					photoset.photosetGrid({
						gutter: photoset.data( "gutter" ) !== undefined ? photoset.data( "gutter" ) : 0,
						onComplete: function() {
							var lightbox = photoset.data( "lightbox" ) !== undefined ? parseInt( photoset.data( "lightbox" ), 10 ) : 1;

							if ( lightbox ) {
								if ( window.thb_lightbox_handler ) {
									window.thb_lightbox_handler.init( photoset.find("img"), true );
								}
							}
						}
					});
				}
			} );
		} );

		isotopePhotogalleries.each( function( index ) {
			var	photogallery = $( this ),
				photoset = photogallery.find( ".thb-photoset-grid" ),
				photogallery_container = photogallery.find( ".thb-photogallery-container" ),
				hasIsotope = typeof THB_Isotope !== 'undefined',
				button = photogallery.find( ".thb-infinite-scroll-button" ),
				photogallery_grid_container = photogallery_container;

			if ( ! photogallery_container.length ) {
				return;
			}

			if ( photogallery_container.attr( 'class' ).indexOf( 'thb-grid-images-height-' ) > -1 ) {
				if ( photogallery_container.hasClass( 'thb-grid-images-height-fixed' ) ) {
					hasIsotope = false;
				}
			}

			if ( photogallery_container.data( 'force-isotope' ) == '1' ) {
				hasIsotope = true;
			}

			if ( hasIsotope ) {
				photogallery_grid_container = new THB_Isotope( photogallery_container );
			}

			if ( button.length ) {
				button.on( "click", function() {
					$.thb.loadUrl(photogallery_container.attr("data-url"), {
						method: "POST",
						complete: function( data ) {
							var target_photogallery = $(data).find( ".thb-photogallery" ).eq( index );

							var items = target_photogallery.find(".thb-photogallery-container .item"),
								new_data_url = target_photogallery.find(".thb-photogallery-container").data("url"),
								old_height = photogallery_container.outerHeight();

							if ( hasIsotope ) {
								photogallery_grid_container.insert( items, function() {
									window.thb_photogallery_adjust( photogallery_container, old_height, target_photogallery, new_data_url );
								} );
							}
							else {
								photogallery_grid_container.append( items );
								window.thb_photogallery_adjust( photogallery_container, old_height, target_photogallery, new_data_url );
							}

							if ( window.thb_lightbox_handler ) {
								window.thb_lightbox_handler.init();
							}
						}
					});

					return false;
				} );
			}
		} );
	} );
} )( jQuery );
;
/*! Magnific Popup - v0.9.9 - 2013-12-27
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2013 Dmitry Semenov; */
(function(e){var t,n,i,o,r,a,s,l="Close",c="BeforeClose",d="AfterClose",u="BeforeAppend",p="MarkupParse",f="Open",m="Change",g="mfp",h="."+g,v="mfp-ready",C="mfp-removing",y="mfp-prevent-close",w=function(){},b=!!window.jQuery,I=e(window),x=function(e,n){t.ev.on(g+e+h,n)},k=function(t,n,i,o){var r=document.createElement("div");return r.className="mfp-"+t,i&&(r.innerHTML=i),o?n&&n.appendChild(r):(r=e(r),n&&r.appendTo(n)),r},T=function(n,i){t.ev.triggerHandler(g+n,i),t.st.callbacks&&(n=n.charAt(0).toLowerCase()+n.slice(1),t.st.callbacks[n]&&t.st.callbacks[n].apply(t,e.isArray(i)?i:[i]))},E=function(n){return n===s&&t.currTemplate.closeBtn||(t.currTemplate.closeBtn=e(t.st.closeMarkup.replace("%title%",t.st.tClose)),s=n),t.currTemplate.closeBtn},_=function(){e.magnificPopup.instance||(t=new w,t.init(),e.magnificPopup.instance=t)},S=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1};w.prototype={constructor:w,init:function(){var n=navigator.appVersion;t.isIE7=-1!==n.indexOf("MSIE 7."),t.isIE8=-1!==n.indexOf("MSIE 8."),t.isLowIE=t.isIE7||t.isIE8,t.isAndroid=/android/gi.test(n),t.isIOS=/iphone|ipad|ipod/gi.test(n),t.supportsTransition=S(),t.probablyMobile=t.isAndroid||t.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),o=e(document),t.popupsCache={}},open:function(n){i||(i=e(document.body));var r;if(n.isObj===!1){t.items=n.items.toArray(),t.index=0;var s,l=n.items;for(r=0;l.length>r;r++)if(s=l[r],s.parsed&&(s=s.el[0]),s===n.el[0]){t.index=r;break}}else t.items=e.isArray(n.items)?n.items:[n.items],t.index=n.index||0;if(t.isOpen)return t.updateItemHTML(),void 0;t.types=[],a="",t.ev=n.mainEl&&n.mainEl.length?n.mainEl.eq(0):o,n.key?(t.popupsCache[n.key]||(t.popupsCache[n.key]={}),t.currTemplate=t.popupsCache[n.key]):t.currTemplate={},t.st=e.extend(!0,{},e.magnificPopup.defaults,n),t.fixedContentPos="auto"===t.st.fixedContentPos?!t.probablyMobile:t.st.fixedContentPos,t.st.modal&&(t.st.closeOnContentClick=!1,t.st.closeOnBgClick=!1,t.st.showCloseBtn=!1,t.st.enableEscapeKey=!1),t.bgOverlay||(t.bgOverlay=k("bg").on("click"+h,function(){t.close()}),t.wrap=k("wrap").attr("tabindex",-1).on("click"+h,function(e){t._checkIfClose(e.target)&&t.close()}),t.container=k("container",t.wrap)),t.contentContainer=k("content"),t.st.preloader&&(t.preloader=k("preloader",t.container,t.st.tLoading));var c=e.magnificPopup.modules;for(r=0;c.length>r;r++){var d=c[r];d=d.charAt(0).toUpperCase()+d.slice(1),t["init"+d].call(t)}T("BeforeOpen"),t.st.showCloseBtn&&(t.st.closeBtnInside?(x(p,function(e,t,n,i){n.close_replaceWith=E(i.type)}),a+=" mfp-close-btn-in"):t.wrap.append(E())),t.st.alignTop&&(a+=" mfp-align-top"),t.fixedContentPos?t.wrap.css({overflow:t.st.overflowY,overflowX:"hidden",overflowY:t.st.overflowY}):t.wrap.css({top:I.scrollTop(),position:"absolute"}),(t.st.fixedBgPos===!1||"auto"===t.st.fixedBgPos&&!t.fixedContentPos)&&t.bgOverlay.css({height:o.height(),position:"absolute"}),t.st.enableEscapeKey&&o.on("keyup"+h,function(e){27===e.keyCode&&t.close()}),I.on("resize"+h,function(){t.updateSize()}),t.st.closeOnContentClick||(a+=" mfp-auto-cursor"),a&&t.wrap.addClass(a);var u=t.wH=I.height(),m={};if(t.fixedContentPos&&t._hasScrollBar(u)){var g=t._getScrollbarSize();g&&(m.marginRight=g)}t.fixedContentPos&&(t.isIE7?e("body, html").css("overflow","hidden"):m.overflow="hidden");var C=t.st.mainClass;return t.isIE7&&(C+=" mfp-ie7"),C&&t._addClassToMFP(C),t.updateItemHTML(),T("BuildControls"),e("html").css(m),t.bgOverlay.add(t.wrap).prependTo(t.st.prependTo||i),t._lastFocusedEl=document.activeElement,setTimeout(function(){t.content?(t._addClassToMFP(v),t._setFocus()):t.bgOverlay.addClass(v),o.on("focusin"+h,t._onFocusIn)},16),t.isOpen=!0,t.updateSize(u),T(f),n},close:function(){t.isOpen&&(T(c),t.isOpen=!1,t.st.removalDelay&&!t.isLowIE&&t.supportsTransition?(t._addClassToMFP(C),setTimeout(function(){t._close()},t.st.removalDelay)):t._close())},_close:function(){T(l);var n=C+" "+v+" ";if(t.bgOverlay.detach(),t.wrap.detach(),t.container.empty(),t.st.mainClass&&(n+=t.st.mainClass+" "),t._removeClassFromMFP(n),t.fixedContentPos){var i={marginRight:""};t.isIE7?e("body, html").css("overflow",""):i.overflow="",e("html").css(i)}o.off("keyup"+h+" focusin"+h),t.ev.off(h),t.wrap.attr("class","mfp-wrap").removeAttr("style"),t.bgOverlay.attr("class","mfp-bg"),t.container.attr("class","mfp-container"),!t.st.showCloseBtn||t.st.closeBtnInside&&t.currTemplate[t.currItem.type]!==!0||t.currTemplate.closeBtn&&t.currTemplate.closeBtn.detach(),t._lastFocusedEl&&e(t._lastFocusedEl).focus(),t.currItem=null,t.content=null,t.currTemplate=null,t.prevHeight=0,T(d)},updateSize:function(e){if(t.isIOS){var n=document.documentElement.clientWidth/window.innerWidth,i=window.innerHeight*n;t.wrap.css("height",i),t.wH=i}else t.wH=e||I.height();t.fixedContentPos||t.wrap.css("height",t.wH),T("Resize")},updateItemHTML:function(){var n=t.items[t.index];t.contentContainer.detach(),t.content&&t.content.detach(),n.parsed||(n=t.parseEl(t.index));var i=n.type;if(T("BeforeChange",[t.currItem?t.currItem.type:"",i]),t.currItem=n,!t.currTemplate[i]){var o=t.st[i]?t.st[i].markup:!1;T("FirstMarkupParse",o),t.currTemplate[i]=o?e(o):!0}r&&r!==n.type&&t.container.removeClass("mfp-"+r+"-holder");var a=t["get"+i.charAt(0).toUpperCase()+i.slice(1)](n,t.currTemplate[i]);t.appendContent(a,i),n.preloaded=!0,T(m,n),r=n.type,t.container.prepend(t.contentContainer),T("AfterChange")},appendContent:function(e,n){t.content=e,e?t.st.showCloseBtn&&t.st.closeBtnInside&&t.currTemplate[n]===!0?t.content.find(".mfp-close").length||t.content.append(E()):t.content=e:t.content="",T(u),t.container.addClass("mfp-"+n+"-holder"),t.contentContainer.append(t.content)},parseEl:function(n){var i,o=t.items[n];if(o.tagName?o={el:e(o)}:(i=o.type,o={data:o,src:o.src}),o.el){for(var r=t.types,a=0;r.length>a;a++)if(o.el.hasClass("mfp-"+r[a])){i=r[a];break}o.src=o.el.attr("data-mfp-src"),o.src||(o.src=o.el.attr("href"))}return o.type=i||t.st.type||"inline",o.index=n,o.parsed=!0,t.items[n]=o,T("ElementParse",o),t.items[n]},addGroup:function(e,n){var i=function(i){i.mfpEl=this,t._openClick(i,e,n)};n||(n={});var o="click.magnificPopup";n.mainEl=e,n.items?(n.isObj=!0,e.off(o).on(o,i)):(n.isObj=!1,n.delegate?e.off(o).on(o,n.delegate,i):(n.items=e,e.off(o).on(o,i)))},_openClick:function(n,i,o){var r=void 0!==o.midClick?o.midClick:e.magnificPopup.defaults.midClick;if(r||2!==n.which&&!n.ctrlKey&&!n.metaKey){var a=void 0!==o.disableOn?o.disableOn:e.magnificPopup.defaults.disableOn;if(a)if(e.isFunction(a)){if(!a.call(t))return!0}else if(a>I.width())return!0;n.type&&(n.preventDefault(),t.isOpen&&n.stopPropagation()),o.el=e(n.mfpEl),o.delegate&&(o.items=i.find(o.delegate)),t.open(o)}},updateStatus:function(e,i){if(t.preloader){n!==e&&t.container.removeClass("mfp-s-"+n),i||"loading"!==e||(i=t.st.tLoading);var o={status:e,text:i};T("UpdateStatus",o),e=o.status,i=o.text,t.preloader.html(i),t.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),t.container.addClass("mfp-s-"+e),n=e}},_checkIfClose:function(n){if(!e(n).hasClass(y)){var i=t.st.closeOnContentClick,o=t.st.closeOnBgClick;if(i&&o)return!0;if(!t.content||e(n).hasClass("mfp-close")||t.preloader&&n===t.preloader[0])return!0;if(n===t.content[0]||e.contains(t.content[0],n)){if(i)return!0}else if(o&&e.contains(document,n))return!0;return!1}},_addClassToMFP:function(e){t.bgOverlay.addClass(e),t.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),t.wrap.removeClass(e)},_hasScrollBar:function(e){return(t.isIE7?o.height():document.body.scrollHeight)>(e||I.height())},_setFocus:function(){(t.st.focus?t.content.find(t.st.focus).eq(0):t.wrap).focus()},_onFocusIn:function(n){return n.target===t.wrap[0]||e.contains(t.wrap[0],n.target)?void 0:(t._setFocus(),!1)},_parseMarkup:function(t,n,i){var o;i.data&&(n=e.extend(i.data,n)),T(p,[t,n,i]),e.each(n,function(e,n){if(void 0===n||n===!1)return!0;if(o=e.split("_"),o.length>1){var i=t.find(h+"-"+o[0]);if(i.length>0){var r=o[1];"replaceWith"===r?i[0]!==n[0]&&i.replaceWith(n):"img"===r?i.is("img")?i.attr("src",n):i.replaceWith('<img src="'+n+'" class="'+i.attr("class")+'" />'):i.attr(o[1],n)}}else t.find(h+"-"+e).html(n)})},_getScrollbarSize:function(){if(void 0===t.scrollbarSize){var e=document.createElement("div");e.id="mfp-sbm",e.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),t.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)}return t.scrollbarSize}},e.magnificPopup={instance:null,proto:w.prototype,modules:[],open:function(t,n){return _(),t=t?e.extend(!0,{},t):{},t.isObj=!0,t.index=n||0,this.instance.open(t)},close:function(){return e.magnificPopup.instance&&e.magnificPopup.instance.close()},registerModule:function(t,n){n.options&&(e.magnificPopup.defaults[t]=n.options),e.extend(this.proto,n.proto),this.modules.push(t)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},e.fn.magnificPopup=function(n){_();var i=e(this);if("string"==typeof n)if("open"===n){var o,r=b?i.data("magnificPopup"):i[0].magnificPopup,a=parseInt(arguments[1],10)||0;r.items?o=r.items[a]:(o=i,r.delegate&&(o=o.find(r.delegate)),o=o.eq(a)),t._openClick({mfpEl:o},i,r)}else t.isOpen&&t[n].apply(t,Array.prototype.slice.call(arguments,1));else n=e.extend(!0,{},n),b?i.data("magnificPopup",n):i[0].magnificPopup=n,t.addGroup(i,n);return i};var P,O,z,M="inline",B=function(){z&&(O.after(z.addClass(P)).detach(),z=null)};e.magnificPopup.registerModule(M,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){t.types.push(M),x(l+"."+M,function(){B()})},getInline:function(n,i){if(B(),n.src){var o=t.st.inline,r=e(n.src);if(r.length){var a=r[0].parentNode;a&&a.tagName&&(O||(P=o.hiddenClass,O=k(P),P="mfp-"+P),z=r.after(O).detach().removeClass(P)),t.updateStatus("ready")}else t.updateStatus("error",o.tNotFound),r=e("<div>");return n.inlineElement=r,r}return t.updateStatus("ready"),t._parseMarkup(i,{},n),i}}});var F,H="ajax",L=function(){F&&i.removeClass(F)},A=function(){L(),t.req&&t.req.abort()};e.magnificPopup.registerModule(H,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){t.types.push(H),F=t.st.ajax.cursor,x(l+"."+H,A),x("BeforeChange."+H,A)},getAjax:function(n){F&&i.addClass(F),t.updateStatus("loading");var o=e.extend({url:n.src,success:function(i,o,r){var a={data:i,xhr:r};T("ParseAjax",a),t.appendContent(e(a.data),H),n.finished=!0,L(),t._setFocus(),setTimeout(function(){t.wrap.addClass(v)},16),t.updateStatus("ready"),T("AjaxContentAdded")},error:function(){L(),n.finished=n.loadError=!0,t.updateStatus("error",t.st.ajax.tError.replace("%url%",n.src))}},t.st.ajax.settings);return t.req=e.ajax(o),""}}});var j,N=function(n){if(n.data&&void 0!==n.data.title)return n.data.title;var i=t.st.image.titleSrc;if(i){if(e.isFunction(i))return i.call(t,n);if(n.el)return n.el.attr(i)||""}return""};e.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=t.st.image,n=".image";t.types.push("image"),x(f+n,function(){"image"===t.currItem.type&&e.cursor&&i.addClass(e.cursor)}),x(l+n,function(){e.cursor&&i.removeClass(e.cursor),I.off("resize"+h)}),x("Resize"+n,t.resizeImage),t.isLowIE&&x("AfterChange",t.resizeImage)},resizeImage:function(){var e=t.currItem;if(e&&e.img&&t.st.image.verticalFit){var n=0;t.isLowIE&&(n=parseInt(e.img.css("padding-top"),10)+parseInt(e.img.css("padding-bottom"),10)),e.img.css("max-height",t.wH-n)}},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,j&&clearInterval(j),e.isCheckingImgSize=!1,T("ImageHasSize",e),e.imgHidden&&(t.content&&t.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(e){var n=0,i=e.img[0],o=function(r){j&&clearInterval(j),j=setInterval(function(){return i.naturalWidth>0?(t._onImageHasSize(e),void 0):(n>200&&clearInterval(j),n++,3===n?o(10):40===n?o(50):100===n&&o(500),void 0)},r)};o(1)},getImage:function(n,i){var o=0,r=function(){n&&(n.img[0].complete?(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("ready")),n.hasSize=!0,n.loaded=!0,T("ImageLoadComplete")):(o++,200>o?setTimeout(r,100):a()))},a=function(){n&&(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("error",s.tError.replace("%url%",n.src))),n.hasSize=!0,n.loaded=!0,n.loadError=!0)},s=t.st.image,l=i.find(".mfp-img");if(l.length){var c=document.createElement("img");c.className="mfp-img",n.img=e(c).on("load.mfploader",r).on("error.mfploader",a),c.src=n.src,l.is("img")&&(n.img=n.img.clone()),c=n.img[0],c.naturalWidth>0?n.hasSize=!0:c.width||(n.hasSize=!1)}return t._parseMarkup(i,{title:N(n),img_replaceWith:n.img},n),t.resizeImage(),n.hasSize?(j&&clearInterval(j),n.loadError?(i.addClass("mfp-loading"),t.updateStatus("error",s.tError.replace("%url%",n.src))):(i.removeClass("mfp-loading"),t.updateStatus("ready")),i):(t.updateStatus("loading"),n.loading=!0,n.hasSize||(n.imgHidden=!0,i.addClass("mfp-loading"),t.findImageSize(n)),i)}}});var W,R=function(){return void 0===W&&(W=void 0!==document.createElement("p").style.MozTransform),W};e.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e,n=t.st.zoom,i=".zoom";if(n.enabled&&t.supportsTransition){var o,r,a=n.duration,s=function(e){var t=e.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),i="all "+n.duration/1e3+"s "+n.easing,o={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},r="transition";return o["-webkit-"+r]=o["-moz-"+r]=o["-o-"+r]=o[r]=i,t.css(o),t},d=function(){t.content.css("visibility","visible")};x("BuildControls"+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.content.css("visibility","hidden"),e=t._getItemToZoom(),!e)return d(),void 0;r=s(e),r.css(t._getOffset()),t.wrap.append(r),o=setTimeout(function(){r.css(t._getOffset(!0)),o=setTimeout(function(){d(),setTimeout(function(){r.remove(),e=r=null,T("ZoomAnimationEnded")},16)},a)},16)}}),x(c+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.st.removalDelay=a,!e){if(e=t._getItemToZoom(),!e)return;r=s(e)}r.css(t._getOffset(!0)),t.wrap.append(r),t.content.css("visibility","hidden"),setTimeout(function(){r.css(t._getOffset())},16)}}),x(l+i,function(){t._allowZoom()&&(d(),r&&r.remove(),e=null)})}},_allowZoom:function(){return"image"===t.currItem.type},_getItemToZoom:function(){return t.currItem.hasSize?t.currItem.img:!1},_getOffset:function(n){var i;i=n?t.currItem.img:t.st.zoom.opener(t.currItem.el||t.currItem);var o=i.offset(),r=parseInt(i.css("padding-top"),10),a=parseInt(i.css("padding-bottom"),10);o.top-=e(window).scrollTop()-r;var s={width:i.width(),height:(b?i.innerHeight():i[0].offsetHeight)-a-r};return R()?s["-moz-transform"]=s.transform="translate("+o.left+"px,"+o.top+"px)":(s.left=o.left,s.top=o.top),s}}});var Z="iframe",q="//about:blank",D=function(e){if(t.currTemplate[Z]){var n=t.currTemplate[Z].find("iframe");n.length&&(e||(n[0].src=q),t.isIE8&&n.css("display",e?"block":"none"))}};e.magnificPopup.registerModule(Z,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){t.types.push(Z),x("BeforeChange",function(e,t,n){t!==n&&(t===Z?D():n===Z&&D(!0))}),x(l+"."+Z,function(){D()})},getIframe:function(n,i){var o=n.src,r=t.st.iframe;e.each(r.patterns,function(){return o.indexOf(this.index)>-1?(this.id&&(o="string"==typeof this.id?o.substr(o.lastIndexOf(this.id)+this.id.length,o.length):this.id.call(this,o)),o=this.src.replace("%id%",o),!1):void 0});var a={};return r.srcAction&&(a[r.srcAction]=o),t._parseMarkup(i,a,n),t.updateStatus("ready"),i}}});var K=function(e){var n=t.items.length;return e>n-1?e-n:0>e?n+e:e},Y=function(e,t,n){return e.replace(/%curr%/gi,t+1).replace(/%total%/gi,n)};e.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var n=t.st.gallery,i=".mfp-gallery",r=Boolean(e.fn.mfpFastClick);return t.direction=!0,n&&n.enabled?(a+=" mfp-gallery",x(f+i,function(){n.navigateByImgClick&&t.wrap.on("click"+i,".mfp-img",function(){return t.items.length>1?(t.next(),!1):void 0}),o.on("keydown"+i,function(e){37===e.keyCode?t.prev():39===e.keyCode&&t.next()})}),x("UpdateStatus"+i,function(e,n){n.text&&(n.text=Y(n.text,t.currItem.index,t.items.length))}),x(p+i,function(e,i,o,r){var a=t.items.length;o.counter=a>1?Y(n.tCounter,r.index,a):""}),x("BuildControls"+i,function(){if(t.items.length>1&&n.arrows&&!t.arrowLeft){var i=n.arrowMarkup,o=t.arrowLeft=e(i.replace(/%title%/gi,n.tPrev).replace(/%dir%/gi,"left")).addClass(y),a=t.arrowRight=e(i.replace(/%title%/gi,n.tNext).replace(/%dir%/gi,"right")).addClass(y),s=r?"mfpFastClick":"click";o[s](function(){t.prev()}),a[s](function(){t.next()}),t.isIE7&&(k("b",o[0],!1,!0),k("a",o[0],!1,!0),k("b",a[0],!1,!0),k("a",a[0],!1,!0)),t.container.append(o.add(a))}}),x(m+i,function(){t._preloadTimeout&&clearTimeout(t._preloadTimeout),t._preloadTimeout=setTimeout(function(){t.preloadNearbyImages(),t._preloadTimeout=null},16)}),x(l+i,function(){o.off(i),t.wrap.off("click"+i),t.arrowLeft&&r&&t.arrowLeft.add(t.arrowRight).destroyMfpFastClick(),t.arrowRight=t.arrowLeft=null}),void 0):!1},next:function(){t.direction=!0,t.index=K(t.index+1),t.updateItemHTML()},prev:function(){t.direction=!1,t.index=K(t.index-1),t.updateItemHTML()},goTo:function(e){t.direction=e>=t.index,t.index=e,t.updateItemHTML()},preloadNearbyImages:function(){var e,n=t.st.gallery.preload,i=Math.min(n[0],t.items.length),o=Math.min(n[1],t.items.length);for(e=1;(t.direction?o:i)>=e;e++)t._preloadItem(t.index+e);for(e=1;(t.direction?i:o)>=e;e++)t._preloadItem(t.index-e)},_preloadItem:function(n){if(n=K(n),!t.items[n].preloaded){var i=t.items[n];i.parsed||(i=t.parseEl(n)),T("LazyLoad",i),"image"===i.type&&(i.img=e('<img class="mfp-img" />').on("load.mfploader",function(){i.hasSize=!0}).on("error.mfploader",function(){i.hasSize=!0,i.loadError=!0,T("LazyLoadError",i)}).attr("src",i.src)),i.preloaded=!0}}}});var U="retina";e.magnificPopup.registerModule(U,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var e=t.st.retina,n=e.ratio;n=isNaN(n)?n():n,n>1&&(x("ImageHasSize."+U,function(e,t){t.img.css({"max-width":t.img[0].naturalWidth/n,width:"100%"})}),x("ElementParse."+U,function(t,i){i.src=e.replaceSrc(i,n)}))}}}}),function(){var t=1e3,n="ontouchstart"in window,i=function(){I.off("touchmove"+r+" touchend"+r)},o="mfpFastClick",r="."+o;e.fn.mfpFastClick=function(o){return e(this).each(function(){var a,s=e(this);if(n){var l,c,d,u,p,f;s.on("touchstart"+r,function(e){u=!1,f=1,p=e.originalEvent?e.originalEvent.touches[0]:e.touches[0],c=p.clientX,d=p.clientY,I.on("touchmove"+r,function(e){p=e.originalEvent?e.originalEvent.touches:e.touches,f=p.length,p=p[0],(Math.abs(p.clientX-c)>10||Math.abs(p.clientY-d)>10)&&(u=!0,i())}).on("touchend"+r,function(e){i(),u||f>1||(a=!0,e.preventDefault(),clearTimeout(l),l=setTimeout(function(){a=!1},t),o())})})}s.on("click"+r,function(){a||o()})})},e.fn.destroyMfpFastClick=function(){e(this).off("touchstart"+r+" click"+r),n&&I.off("touchmove"+r+" touchend"+r)}}(),_()})(window.jQuery||window.Zepto);
;
(function($) {
	"use strict";

	window.THB_Lightbox = function() {

		/**
		 * Images in galleries.
		 *
		 * @type {string}
		 */
		this.galleriesSelector = ".thb-gallery, .gallery, .thb-images-container, .tiled-gallery";

		/**
		 * Images.
		 *
		 * @type {string}
		 */
		this.imagesSelector = '.thb-lightbox[href*=".jpg"],.thb-lightbox[href*=".png"],.thb-lightbox[href*=".gif"],.thb-lightbox[href*=".jpeg"],.hentry a[href*=".jpg"],.hentry a[href*=".png"],.hentry a[href*=".gif"],.hentry a[href*=".jpeg"]';
		this.imagesSelector = this.imagesSelector.replace( /,/g, ':not(.nothumb),' );
		this.imagesSelector += ':not(.nothumb)';

		/**
		 * Initialize the lightbox component.
		 */
		this.init = function( target ) {
			this["galleries"] = $( this.galleriesSelector, target );
			this["images"] = $( this.imagesSelector, target ).not( this.galleries.find("a") );
		};

		/**
		 * Add new elements to the target set.
		 *
		 * @param {jQuery|string} new_elements
		 */
		this.add = function( new_elements ) {
			new_elements = $(new_elements);

			this["images"] = this["images"].add( new_elements );
		};

	};
})(jQuery);
;
(function($) {
	"use strict";

	window.THB_MagnificPopup = function( options ) {

		var self = this;

		/**
		 * Lightbox handler.
		 */
		var lightbox = new THB_Lightbox();

		/**
		 * Library handler.
		 *
		 * @type {string}
		 */
		var handler = "magnificPopup";

		/**
		 * Filter options.
		 *
		 * @type {Object}
		 */
		var options = $.extend( {
			image: {
				titleSrc: function( item ) {
					var caption = '';

					if ( item.el && typeof item.el !== 'undefined' ) {
						if ( item.el.next('.wp-caption-text').length ) {
							caption = item.el.next('.wp-caption-text').text();
						}
						else if ( typeof item.el.attr("title") !== "undefined" && item.el.attr("title") != "" ) {
							caption = item.el.attr("title");
						}
					}

					return caption;
				}
			},
			removalDelay: 200,
			mainClass: 'thb-mfp-skin'
		}, options );

		/**
		 * Galleries filter options.
		 *
		 * @type {Object}
		 */
		var galleriesOptions = $.extend( {
			delegate: 'a[href*=".jpg"]:not(.nothumb), a[href*=".png"]:not(.nothumb), a[href*=".gif"]:not(.nothumb), a[href*=".jpeg"]:not(.nothumb), a.mfp-iframe:not(.nothumb)',
			type: 'image',
			gallery:{
				enabled:true
			},
			callbacks: {
				open: function() {
					var isMobile = $( "body" ).hasClass( "thb-mobile" );

					if ( isMobile ) {
						var supportsFastClick = Boolean( $.fn.mfpFastClick ),
							evt = supportsFastClick ? "mfpFastClick" : "click",
							mfp = this;

						$( ".mfp-arrow" ).off( "click" );
						$( ".mfp-arrow" ).off( "mfpFastClick" );

						$( ".mfp-arrow-left" ).on( evt, function() {
							mfp.prev();
							return false;
						} );
						$( ".mfp-arrow-right" ).on( evt, function() {
							mfp.next();
							return false;
						} );
					}
				}
			}
		}, options );

		/**
		 * Initialize the lightbox component.
		 */
		this.init = function( target, gallery ) {
			lightbox.init( target );

			if ( gallery === undefined ) {
				this.bindImages( lightbox["images"] );
				this.bindGalleries( lightbox["galleries"] );
			}
			else {
				if ( gallery == true ) {
					this.bindGallery( target, {
						delegate: null
					} );
				}
				else {
					this.bindImages( target );
				}
			}
		};

		/**
		 * Bind the lightbox event of the selected images.
		 *
		 * @param {jQuery} target
		 */
		this.bindImages = function( target, opts ) {
			if ( target[handler] ) {
				target[handler]( $.extend( {}, options, opts ) );
			}
		};

		/**
		 * Bind the lightbox event of the selected galleries.
		 *
		 * @param {jQuery} target
		 */
		this.bindGalleries = function( target, opts ) {
			target.each( function() {
				self.bindGallery( $(this), opts );
			} );
		};

		/**
		 * Bind the lightbox event of the selected gallery images.
		 *
		 * @param {jQuery} target
		 */
		this.bindGallery = function( target, opts ) {
			if ( target[handler] ) {
				target[handler]( $.extend( {}, galleriesOptions, opts ) );
			}
		};

	};

	$(document).ready(function() {
		if ( $( "body" ).hasClass( "thb-lightbox-enabled" ) ) {
			window.thb_lightbox_handler = new THB_MagnificPopup( { type: 'image' } );
			window.thb_lightbox_handler.init();
		}
	});
})(jQuery);
;
( function( $ ) {
	$( document ).ready( function() {

		$( 'body' ).on( 'click', '.thb-like', function() {
			if ( $( this ).hasClass( "thb-liked" ) ) {
				return false;
			}

			var button = $( this ),
				post_id = button.attr( 'data-post-id' ),
				nonce = button.attr( 'data-nonce' ),
				likes_count = button.find( '.thb-likes-count' ),
				data = {
					"post_id": post_id,
					"action": "thb_like",
					"THB_nonce": nonce
				};

			button.addClass( "thb-liking" );

			$.post( thb_system.ajax_url, data, function( updated_count ) {
				if ( updated_count !== "" ) {
					button.removeClass( "thb-liking" );
					button.addClass( "thb-liked" );
					likes_count.html( updated_count );
				}
			} );

			return false;
		} );

	} );
} )( jQuery );
;
( function( $ ) {
	"use strict";

	window.thb_builder_calls = [];
	window.thb_builder = function( root ) {
		if ( root === undefined ) {
			root = $( "body" );
		}

		$.each( window.thb_builder_calls, function() {
			this( root );
		} );
	};

	$( document ).ready( function() {
		thb_builder();

		/**
		 * Sections
		 */
		if ( $( "body" ).hasClass( "thb-desktop") ) {
			if ( $( ".thb-section" ).length ) {
				$( ".thb-section-extra[data-parallax='1']" ).each( function() {
					var section = $( this ),
						background_image = section.css( "background-image" ).replace( "url(", "" ).replace( ")", "" );

					if ( background_image == 'none' ) {
						return;
					}

					// section.parallax('50%', 0.6);
					section.thbParallax();
				} );
			}
		}

		/**
		 * Inview class management for builder section rows.
		 */
		$( ".thb-section-row" ).bind( "inview", function( e, isInView ) {
			if ( isInView && ! $( this ).hasClass( "inview" ) ) {
				$( this ).addClass( "inview" );

				/**
				 * Number counters.
				 */
				if ( $( this ).find( '.thb-counter-wrapper' ).length ) {
					$( this ).find( '.thb-counter-wrapper' ).each( function() {
						var counter = $( this ).find( ".thb-counter" ),
							odometer = $( this ).data( "thb-counter" ),
							end_value = counter.data( 'value' );

						odometer.update( end_value );
					} );
				}

				/**
				 * Pie charts.
				 */
				if ( $( this ).find( '.thb-radial-chart-data' ).length ) {
					$( this ).find( '.thb-radial-chart-data' ).each( function() {
						var el = $( this ),
							disable_animation = el.data("disable-animation"),
							pC = $( this ).data( 'easyPieChart' );

						if ( disable_animation != '1' ) {
							pC.enableAnimation();
						}

						pC.update( parseInt( el.data( 'percent-end' ), 10 ) );
					} );
				}

				if ( $( this ).find( ".thb-video-holder[data-autoplay='1']" ).length ) {
					$( this ).find( "iframe.thb-video-api, video.wp-video-shortcode" ).each( function() {
						var player = $( this ).data( "player" );

						if ( player !== undefined ) {
							setTimeout( function() {
								player.play();
							}, 250 );
						}
						else {
							$( this ).on( "thb-video-loaded", function() {
								var player = $( this ).data( "player" );
								player.play();
							} );
						}
					} );
				}
			}
		} );

		/**
		 * Carousel
		 */
		$( ".thb-carousel" ).each( function() {
			var wrapper = $( this ),
				carousel = wrapper,
				isColumn = wrapper.hasClass( "thb-section-column" ),
				items = 1;

			if ( isColumn ) {
				wrapper = $( this ).find( ".thb-section-column-inner-wrapper" );
			}

			var options = {
				items: items,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				navigation: false,
				navigationText: false,
				pagination: false,
				autoPlay: false,
				addClassActive: true,
				afterAction: function() {
					var max = 0;

					$( wrapper ).imagesLoaded( function() {
						carousel.trigger( "thb-carousel-images-loaded" );

						wrapper.find( ".owl-item.active" ).each( function() {
							var oh = $( this ).outerHeight();

							if ( oh > max ) {
								max = oh;
							}
						} );

						wrapper.find( ".owl-wrapper-outer" ).css( "height", max + "px" );
					} );
				}
			}

			var module 		   = $( this ).attr( "data-carousel-module" ),
				nav            = $( this ).attr( "data-carousel-nav-arrows" ) == '1',
				nav_pos        = $( this ).attr( "data-carousel-nav-arrows-position" ),
				pag            = $( this ).attr( "data-carousel-pagination" ) == '1',
				autoplay       = $( this ).attr( "data-carousel-autoplay" ) !== undefined ? $( this ).attr( "data-carousel-autoplay" ) : false,
				autoplay_speed = $( this ).attr( "data-carousel-autoplay" ) !== undefined ? parseInt( $( this ).attr( "data-carousel-autoplay" ), 10 ) : false,
				drag           = $( this ).attr( "data-carousel-drag" ) !== undefined ? $( this ).attr( "data-carousel-drag" ) == "1" : true;

			autoplay = autoplay && ( module > $( ".owl-item", wrapper ).length );

			options.items = parseInt( module, 10 );

			if ( isColumn ) {
				options.navigation = nav;
				options.afterInit = function(elem){
					var that = this;

					if ( that.owlControls ) {
						that.owlControls.find( ".owl-buttons" ).prependTo( elem.find( ".owl-wrapper-outer" ) );
					}
				};
			}
			else {
				if ( nav && nav_pos == "top" ) {
					var block = wrapper.parents( ".thb-section-column-block" ),
						block_header = block.find( ".thb-section-block-header" );

					block_header.find( ".owl-next" ).click( function() {
						wrapper.trigger('owl.next');
					} );

					block_header.find( ".owl-prev" ).click( function() {
						wrapper.trigger('owl.prev');
					} );
				}
				else {
					options.navigation = nav;
				}
			}

			if ( options.items == 1 ) {
				options.singleItem = true;
			}

			options.pagination = pag;

			if ( autoplay ) {
				if ( autoplay_speed !== false ) {
					autoplay = autoplay_speed;
				}
			}

			options.autoPlay = autoplay;

			if ( ! drag ) {
				options.mouseDrag = false;
				options.touchDrag = false;
			}

			wrapper.owlCarousel( options );
		} );
	} );
} )( jQuery );

/**
 * Owl carousel
 */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('7(A 3c.3q!=="9"){3c.3q=9(e){9 t(){}t.5S=e;p 5R t}}(9(e,t,n){h r={1N:9(t,n){h r=c;r.$k=e(n);r.6=e.4M({},e.37.2B.6,r.$k.v(),t);r.2A=t;r.4L()},4L:9(){9 r(e){h n,r="";7(A t.6.33==="9"){t.6.33.R(c,[e])}l{1A(n 38 e.d){7(e.d.5M(n)){r+=e.d[n].1K}}t.$k.2y(r)}t.3t()}h t=c,n;7(A t.6.2H==="9"){t.6.2H.R(c,[t.$k])}7(A t.6.2O==="2Y"){n=t.6.2O;e.5K(n,r)}l{t.3t()}},3t:9(){h e=c;e.$k.v("d-4I",e.$k.2x("2w")).v("d-4F",e.$k.2x("H"));e.$k.z({2u:0});e.2t=e.6.q;e.4E();e.5v=0;e.1X=14;e.23()},23:9(){h e=c;7(e.$k.25().N===0){p b}e.1M();e.4C();e.$S=e.$k.25();e.E=e.$S.N;e.4B();e.$G=e.$k.17(".d-1K");e.$K=e.$k.17(".d-1p");e.3u="U";e.13=0;e.26=[0];e.m=0;e.4A();e.4z()},4z:9(){h e=c;e.2V();e.2W();e.4t();e.30();e.4r();e.4q();e.2p();e.4o();7(e.6.2o!==b){e.4n(e.6.2o)}7(e.6.O===j){e.6.O=4Q}e.19();e.$k.17(".d-1p").z("4i","4h");7(!e.$k.2m(":3n")){e.3o()}l{e.$k.z("2u",1)}e.5O=b;e.2l();7(A e.6.3s==="9"){e.6.3s.R(c,[e.$k])}},2l:9(){h e=c;7(e.6.1Z===j){e.1Z()}7(e.6.1B===j){e.1B()}e.4g();7(A e.6.3w==="9"){e.6.3w.R(c,[e.$k])}},3x:9(){h e=c;7(A e.6.3B==="9"){e.6.3B.R(c,[e.$k])}e.3o();e.2V();e.2W();e.4f();e.30();e.2l();7(A e.6.3D==="9"){e.6.3D.R(c,[e.$k])}},3F:9(){h e=c;t.1c(9(){e.3x()},0)},3o:9(){h e=c;7(e.$k.2m(":3n")===b){e.$k.z({2u:0});t.18(e.1C);t.18(e.1X)}l{p b}e.1X=t.4d(9(){7(e.$k.2m(":3n")){e.3F();e.$k.4b({2u:1},2M);t.18(e.1X)}},5x)},4B:9(){h e=c;e.$S.5n(\'<L H="d-1p">\').4a(\'<L H="d-1K"></L>\');e.$k.17(".d-1p").4a(\'<L H="d-1p-49">\');e.1H=e.$k.17(".d-1p-49");e.$k.z("4i","4h")},1M:9(){h e=c,t=e.$k.1I(e.6.1M),n=e.$k.1I(e.6.2i);7(!t){e.$k.I(e.6.1M)}7(!n){e.$k.I(e.6.2i)}},2V:9(){h t=c,n,r;7(t.6.2Z===b){p b}7(t.6.48===j){t.6.q=t.2t=1;t.6.1h=b;t.6.1s=b;t.6.1O=b;t.6.22=b;t.6.1Q=b;t.6.1R=b;p b}n=e(t.6.47).1f();7(n>(t.6.1s[0]||t.2t)){t.6.q=t.2t}7(t.6.1h!==b){t.6.1h.5g(9(e,t){p e[0]-t[0]});1A(r=0;r<t.6.1h.N;r+=1){7(t.6.1h[r][0]<=n){t.6.q=t.6.1h[r][1]}}}l{7(n<=t.6.1s[0]&&t.6.1s!==b){t.6.q=t.6.1s[1]}7(n<=t.6.1O[0]&&t.6.1O!==b){t.6.q=t.6.1O[1]}7(n<=t.6.22[0]&&t.6.22!==b){t.6.q=t.6.22[1]}7(n<=t.6.1Q[0]&&t.6.1Q!==b){t.6.q=t.6.1Q[1]}7(n<=t.6.1R[0]&&t.6.1R!==b){t.6.q=t.6.1R[1]}}7(t.6.q>t.E&&t.6.46===j){t.6.q=t.E}},4r:9(){h n=c,r,i;7(n.6.2Z!==j){p b}i=e(t).1f();n.3d=9(){7(e(t).1f()!==i){7(n.6.O!==b){t.18(n.1C)}t.5d(r);r=t.1c(9(){i=e(t).1f();n.3x()},n.6.45)}};e(t).44(n.3d)},4f:9(){h e=c;e.2g(e.m);7(e.6.O!==b){e.3j()}},43:9(){h t=c,n=0,r=t.E-t.6.q;t.$G.2f(9(i){h s=e(c);s.z({1f:t.M}).v("d-1K",3p(i));7(i%t.6.q===0||i===r){7(!(i>r)){n+=1}}s.v("d-24",n)})},42:9(){h e=c,t=e.$G.N*e.M;e.$K.z({1f:t*2,T:0});e.43()},2W:9(){h e=c;e.40();e.42();e.3Z();e.3v()},40:9(){h e=c;e.M=1F.4O(e.$k.1f()/e.6.q)},3v:9(){h e=c,t=(e.E*e.M-e.6.q*e.M)*-1;7(e.6.q>e.E){e.D=0;t=0;e.3z=0}l{e.D=e.E-e.6.q;e.3z=t}p t},3Y:9(){p 0},3Z:9(){h t=c,n=0,r=0,i,s,o;t.J=[0];t.3E=[];1A(i=0;i<t.E;i+=1){r+=t.M;t.J.2D(-r);7(t.6.12===j){s=e(t.$G[i]);o=s.v("d-24");7(o!==n){t.3E[n]=t.J[i];n=o}}}},4t:9(){h t=c;7(t.6.2a===j||t.6.1v===j){t.B=e(\'<L H="d-5A"/>\').5m("5l",!t.F.15).5c(t.$k)}7(t.6.1v===j){t.3T()}7(t.6.2a===j){t.3S()}},3S:9(){h t=c,n=e(\'<L H="d-4U"/>\');t.B.1o(n);t.1u=e("<L/>",{"H":"d-1n",2y:t.6.2U[0]||""});t.1q=e("<L/>",{"H":"d-U",2y:t.6.2U[1]||""});n.1o(t.1u).1o(t.1q);n.w("2X.B 21.B",\'L[H^="d"]\',9(e){e.1l()});n.w("2n.B 28.B",\'L[H^="d"]\',9(n){n.1l();7(e(c).1I("d-U")){t.U()}l{t.1n()}})},3T:9(){h t=c;t.1k=e(\'<L H="d-1v"/>\');t.B.1o(t.1k);t.1k.w("2n.B 28.B",".d-1j",9(n){n.1l();7(3p(e(c).v("d-1j"))!==t.m){t.1g(3p(e(c).v("d-1j")),j)}})},3P:9(){h t=c,n,r,i,s,o,u;7(t.6.1v===b){p b}t.1k.2y("");n=0;r=t.E-t.E%t.6.q;1A(s=0;s<t.E;s+=1){7(s%t.6.q===0){n+=1;7(r===s){i=t.E-t.6.q}o=e("<L/>",{"H":"d-1j"});u=e("<3N></3N>",{4R:t.6.39===j?n:"","H":t.6.39===j?"d-59":""});o.1o(u);o.v("d-1j",r===s?i:s);o.v("d-24",n);t.1k.1o(o)}}t.35()},35:9(){h t=c;7(t.6.1v===b){p b}t.1k.17(".d-1j").2f(9(){7(e(c).v("d-24")===e(t.$G[t.m]).v("d-24")){t.1k.17(".d-1j").Z("2d");e(c).I("2d")}})},3e:9(){h e=c;7(e.6.2a===b){p b}7(e.6.2e===b){7(e.m===0&&e.D===0){e.1u.I("1b");e.1q.I("1b")}l 7(e.m===0&&e.D!==0){e.1u.I("1b");e.1q.Z("1b")}l 7(e.m===e.D){e.1u.Z("1b");e.1q.I("1b")}l 7(e.m!==0&&e.m!==e.D){e.1u.Z("1b");e.1q.Z("1b")}}},30:9(){h e=c;e.3P();e.3e();7(e.B){7(e.6.q>=e.E){e.B.3K()}l{e.B.3J()}}},55:9(){h e=c;7(e.B){e.B.3k()}},U:9(e){h t=c;7(t.1E){p b}t.m+=t.6.12===j?t.6.q:1;7(t.m>t.D+(t.6.12===j?t.6.q-1:0)){7(t.6.2e===j){t.m=0;e="2k"}l{t.m=t.D;p b}}t.1g(t.m,e)},1n:9(e){h t=c;7(t.1E){p b}7(t.6.12===j&&t.m>0&&t.m<t.6.q){t.m=0}l{t.m-=t.6.12===j?t.6.q:1}7(t.m<0){7(t.6.2e===j){t.m=t.D;e="2k"}l{t.m=0;p b}}t.1g(t.m,e)},1g:9(e,n,r){h i=c,s;7(i.1E){p b}7(A i.6.1Y==="9"){i.6.1Y.R(c,[i.$k])}7(e>=i.D){e=i.D}l 7(e<=0){e=0}i.m=i.d.m=e;7(i.6.2o!==b&&r!=="4e"&&i.6.q===1&&i.F.1x===j){i.1t(0);7(i.F.1x===j){i.1L(i.J[e])}l{i.1r(i.J[e],1)}i.2r();i.4l();p b}s=i.J[e];7(i.F.1x===j){i.1T=b;7(n===j){i.1t("1w");t.1c(9(){i.1T=j},i.6.1w)}l 7(n==="2k"){i.1t(i.6.2v);t.1c(9(){i.1T=j},i.6.2v)}l{i.1t("1m");t.1c(9(){i.1T=j},i.6.1m)}i.1L(s)}l{7(n===j){i.1r(s,i.6.1w)}l 7(n==="2k"){i.1r(s,i.6.2v)}l{i.1r(s,i.6.1m)}}i.2r()},2g:9(e){h t=c;7(A t.6.1Y==="9"){t.6.1Y.R(c,[t.$k])}7(e>=t.D||e===-1){e=t.D}l 7(e<=0){e=0}t.1t(0);7(t.F.1x===j){t.1L(t.J[e])}l{t.1r(t.J[e],1)}t.m=t.d.m=e;t.2r()},2r:9(){h e=c;e.26.2D(e.m);e.13=e.d.13=e.26[e.26.N-2];e.26.5f(0);7(e.13!==e.m){e.35();e.3e();e.2l();7(e.6.O!==b){e.3j()}}7(A e.6.3y==="9"&&e.13!==e.m){e.6.3y.R(c,[e.$k])}},X:9(){h e=c;e.3A="X";t.18(e.1C)},3j:9(){h e=c;7(e.3A!=="X"){e.19()}},19:9(){h e=c;e.3A="19";7(e.6.O===b){p b}t.18(e.1C);e.1C=t.4d(9(){e.U(j)},e.6.O)},1t:9(e){h t=c;7(e==="1m"){t.$K.z(t.2z(t.6.1m))}l 7(e==="1w"){t.$K.z(t.2z(t.6.1w))}l 7(A e!=="2Y"){t.$K.z(t.2z(e))}},2z:9(e){p{"-1G-1a":"2C "+e+"1z 2s","-1W-1a":"2C "+e+"1z 2s","-o-1a":"2C "+e+"1z 2s",1a:"2C "+e+"1z 2s"}},3H:9(){p{"-1G-1a":"","-1W-1a":"","-o-1a":"",1a:""}},3I:9(e){p{"-1G-P":"1i("+e+"V, C, C)","-1W-P":"1i("+e+"V, C, C)","-o-P":"1i("+e+"V, C, C)","-1z-P":"1i("+e+"V, C, C)",P:"1i("+e+"V, C,C)"}},1L:9(e){h t=c;t.$K.z(t.3I(e))},3L:9(e){h t=c;t.$K.z({T:e})},1r:9(e,t){h n=c;n.29=b;n.$K.X(j,j).4b({T:e},{54:t||n.6.1m,3M:9(){n.29=j}})},4E:9(){h e=c,r="1i(C, C, C)",i=n.56("L"),s,o,u,a;i.2w.3O="  -1W-P:"+r+"; -1z-P:"+r+"; -o-P:"+r+"; -1G-P:"+r+"; P:"+r;s=/1i\\(C, C, C\\)/g;o=i.2w.3O.5i(s);u=o!==14&&o.N===1;a="5z"38 t||t.5Q.4P;e.F={1x:u,15:a}},4q:9(){h e=c;7(e.6.27!==b||e.6.1U!==b){e.3Q();e.3R()}},4C:9(){h e=c,t=["s","e","x"];e.16={};7(e.6.27===j&&e.6.1U===j){t=["2X.d 21.d","2N.d 3U.d","2n.d 3V.d 28.d"]}l 7(e.6.27===b&&e.6.1U===j){t=["2X.d","2N.d","2n.d 3V.d"]}l 7(e.6.27===j&&e.6.1U===b){t=["21.d","3U.d","28.d"]}e.16.3W=t[0];e.16.2K=t[1];e.16.2J=t[2]},3R:9(){h t=c;t.$k.w("5y.d",9(e){e.1l()});t.$k.w("21.3X",9(t){p e(t.1d).2m("5C, 5E, 5F, 5N")})},3Q:9(){9 s(e){7(e.2b!==W){p{x:e.2b[0].2c,y:e.2b[0].41}}7(e.2b===W){7(e.2c!==W){p{x:e.2c,y:e.41}}7(e.2c===W){p{x:e.52,y:e.53}}}}9 o(t){7(t==="w"){e(n).w(r.16.2K,a);e(n).w(r.16.2J,f)}l 7(t==="Q"){e(n).Q(r.16.2K);e(n).Q(r.16.2J)}}9 u(n){h u=n.3h||n||t.3g,a;7(u.5a===3){p b}7(r.E<=r.6.q){p}7(r.29===b&&!r.6.3f){p b}7(r.1T===b&&!r.6.3f){p b}7(r.6.O!==b){t.18(r.1C)}7(r.F.15!==j&&!r.$K.1I("3b")){r.$K.I("3b")}r.11=0;r.Y=0;e(c).z(r.3H());a=e(c).2h();i.2S=a.T;i.2R=s(u).x-a.T;i.2P=s(u).y-a.5o;o("w");i.2j=b;i.2L=u.1d||u.4c}9 a(o){h u=o.3h||o||t.3g,a,f;r.11=s(u).x-i.2R;r.2I=s(u).y-i.2P;r.Y=r.11-i.2S;7(A r.6.2E==="9"&&i.3C!==j&&r.Y!==0){i.3C=j;r.6.2E.R(r,[r.$k])}7((r.Y>8||r.Y<-8)&&r.F.15===j){7(u.1l!==W){u.1l()}l{u.5L=b}i.2j=j}7((r.2I>10||r.2I<-10)&&i.2j===b){e(n).Q("2N.d")}a=9(){p r.Y/5};f=9(){p r.3z+r.Y/5};r.11=1F.3v(1F.3Y(r.11,a()),f());7(r.F.1x===j){r.1L(r.11)}l{r.3L(r.11)}}9 f(n){h s=n.3h||n||t.3g,u,a,f;s.1d=s.1d||s.4c;i.3C=b;7(r.F.15!==j){r.$K.Z("3b")}7(r.Y<0){r.1y=r.d.1y="T"}l{r.1y=r.d.1y="3i"}7(r.Y!==0){u=r.4j();r.1g(u,b,"4e");7(i.2L===s.1d&&r.F.15!==j){e(s.1d).w("3a.4k",9(t){t.4S();t.4T();t.1l();e(t.1d).Q("3a.4k")});a=e.4N(s.1d,"4V").3a;f=a.4W();a.4X(0,0,f)}}o("Q")}h r=c,i={2R:0,2P:0,4Y:0,2S:0,2h:14,4Z:14,50:14,2j:14,51:14,2L:14};r.29=j;r.$k.w(r.16.3W,".d-1p",u)},4j:9(){h e=c,t=e.4m();7(t>e.D){e.m=e.D;t=e.D}l 7(e.11>=0){t=0;e.m=0}p t},4m:9(){h t=c,n=t.6.12===j?t.3E:t.J,r=t.11,i=14;e.2f(n,9(s,o){7(r-t.M/20>n[s+1]&&r-t.M/20<o&&t.34()==="T"){i=o;7(t.6.12===j){t.m=e.4p(i,t.J)}l{t.m=s}}l 7(r+t.M/20<o&&r+t.M/20>(n[s+1]||n[s]-t.M)&&t.34()==="3i"){7(t.6.12===j){i=n[s+1]||n[n.N-1];t.m=e.4p(i,t.J)}l{i=n[s+1];t.m=s+1}}});p t.m},34:9(){h e=c,t;7(e.Y<0){t="3i";e.3u="U"}l{t="T";e.3u="1n"}p t},4A:9(){h e=c;e.$k.w("d.U",9(){e.U()});e.$k.w("d.1n",9(){e.1n()});e.$k.w("d.19",9(t,n){e.6.O=n;e.19();e.32="19"});e.$k.w("d.X",9(){e.X();e.32="X"});e.$k.w("d.1g",9(t,n){e.1g(n)});e.$k.w("d.2g",9(t,n){e.2g(n)})},2p:9(){h e=c;7(e.6.2p===j&&e.F.15!==j&&e.6.O!==b){e.$k.w("57",9(){e.X()});e.$k.w("58",9(){7(e.32!=="X"){e.19()}})}},1Z:9(){h t=c,n,r,i,s,o;7(t.6.1Z===b){p b}1A(n=0;n<t.E;n+=1){r=e(t.$G[n]);7(r.v("d-1e")==="1e"){4s}i=r.v("d-1K");s=r.17(".5b");7(A s.v("1J")!=="2Y"){r.v("d-1e","1e");4s}7(r.v("d-1e")===W){s.3K();r.I("4u").v("d-1e","5e")}7(t.6.4v===j){o=i>=t.m}l{o=j}7(o&&i<t.m+t.6.q&&s.N){t.4w(r,s)}}},4w:9(e,n){9 o(){e.v("d-1e","1e").Z("4u");n.5h("v-1J");7(r.6.4x==="4y"){n.5j(5k)}l{n.3J()}7(A r.6.2T==="9"){r.6.2T.R(c,[r.$k])}}9 u(){i+=1;7(r.2Q(n.3l(0))||s===j){o()}l 7(i<=2q){t.1c(u,2q)}l{o()}}h r=c,i=0,s;7(n.5p("5q")==="5r"){n.z("5s-5t","5u("+n.v("1J")+")");s=j}l{n[0].1J=n.v("1J")}u()},1B:9(){9 s(){h r=e(n.$G[n.m]).2G();n.1H.z("2G",r+"V");7(!n.1H.1I("1B")){t.1c(9(){n.1H.I("1B")},0)}}9 o(){i+=1;7(n.2Q(r.3l(0))){s()}l 7(i<=2q){t.1c(o,2q)}l{n.1H.z("2G","")}}h n=c,r=e(n.$G[n.m]).17("5w"),i;7(r.3l(0)!==W){i=0;o()}l{s()}},2Q:9(e){h t;7(!e.3M){p b}t=A e.4D;7(t!=="W"&&e.4D===0){p b}p j},4g:9(){h t=c,n;7(t.6.2F===j){t.$G.Z("2d")}t.1D=[];1A(n=t.m;n<t.m+t.6.q;n+=1){t.1D.2D(n);7(t.6.2F===j){e(t.$G[n]).I("2d")}}t.d.1D=t.1D},4n:9(e){h t=c;t.4G="d-"+e+"-5B";t.4H="d-"+e+"-38"},4l:9(){9 a(e){p{2h:"5D",T:e+"V"}}h e=c,t=e.4G,n=e.4H,r=e.$G.1S(e.m),i=e.$G.1S(e.13),s=1F.4J(e.J[e.m])+e.J[e.13],o=1F.4J(e.J[e.m])+e.M/2,u="5G 5H 5I 5J";e.1E=j;e.$K.I("d-1P").z({"-1G-P-1P":o+"V","-1W-4K-1P":o+"V","4K-1P":o+"V"});i.z(a(s,10)).I(t).w(u,9(){e.3m=j;i.Q(u);e.31(i,t)});r.I(n).w(u,9(){e.36=j;r.Q(u);e.31(r,n)})},31:9(e,t){h n=c;e.z({2h:"",T:""}).Z(t);7(n.3m&&n.36){n.$K.Z("d-1P");n.3m=b;n.36=b;n.1E=b}},4o:9(){h e=c;e.d={2A:e.2A,5P:e.$k,S:e.$S,G:e.$G,m:e.m,13:e.13,1D:e.1D,15:e.F.15,F:e.F,1y:e.1y}},3G:9(){h r=c;r.$k.Q(".d d 21.3X");e(n).Q(".d d");e(t).Q("44",r.3d)},1V:9(){h e=c;7(e.$k.25().N!==0){e.$K.3r();e.$S.3r().3r();7(e.B){e.B.3k()}}e.3G();e.$k.2x("2w",e.$k.v("d-4I")||"").2x("H",e.$k.v("d-4F"))},5T:9(){h e=c;e.X();t.18(e.1X);e.1V();e.$k.5U()},5V:9(t){h n=c,r=e.4M({},n.2A,t);n.1V();n.1N(r,n.$k)},5W:9(e,t){h n=c,r;7(!e){p b}7(n.$k.25().N===0){n.$k.1o(e);n.23();p b}n.1V();7(t===W||t===-1){r=-1}l{r=t}7(r>=n.$S.N||r===-1){n.$S.1S(-1).5X(e)}l{n.$S.1S(r).5Y(e)}n.23()},5Z:9(e){h t=c,n;7(t.$k.25().N===0){p b}7(e===W||e===-1){n=-1}l{n=e}t.1V();t.$S.1S(n).3k();t.23()}};e.37.2B=9(t){p c.2f(9(){7(e(c).v("d-1N")===j){p b}e(c).v("d-1N",j);h n=3c.3q(r);n.1N(t,c);e.v(c,"2B",n)})};e.37.2B.6={q:5,1h:b,1s:[60,4],1O:[61,3],22:[62,2],1Q:b,1R:[63,1],48:b,46:b,1m:2M,1w:64,2v:65,O:b,2p:b,2a:b,2U:["1n","U"],2e:j,12:b,1v:j,39:b,2Z:j,45:2M,47:t,1M:"d-66",2i:"d-2i",1Z:b,4v:j,4x:"4y",1B:b,2O:b,33:b,3f:j,27:j,1U:j,2F:b,2o:b,3B:b,3D:b,2H:b,3s:b,1Y:b,3y:b,3w:b,2E:b,2T:b}})(67,68,69)',62,382,'||||||options|if||function||false|this|owl||||var||true|elem|else|currentItem|||return|items|||||data|on|||css|typeof|owlControls|0px|maximumItem|itemsAmount|browser|owlItems|class|addClass|positionsInArray|owlWrapper|div|itemWidth|length|autoPlay|transform|off|apply|userItems|left|next|px|undefined|stop|newRelativeX|removeClass||newPosX|scrollPerPage|prevItem|null|isTouch|ev_types|find|clearInterval|play|transition|disabled|setTimeout|target|loaded|width|goTo|itemsCustom|translate3d|page|paginationWrapper|preventDefault|slideSpeed|prev|append|wrapper|buttonNext|css2slide|itemsDesktop|swapSpeed|buttonPrev|pagination|paginationSpeed|support3d|dragDirection|ms|for|autoHeight|autoPlayInterval|visibleItems|isTransition|Math|webkit|wrapperOuter|hasClass|src|item|transition3d|baseClass|init|itemsDesktopSmall|origin|itemsTabletSmall|itemsMobile|eq|isCss3Finish|touchDrag|unWrap|moz|checkVisible|beforeMove|lazyLoad||mousedown|itemsTablet|setVars|roundPages|children|prevArr|mouseDrag|mouseup|isCssFinish|navigation|touches|pageX|active|rewindNav|each|jumpTo|position|theme|sliding|rewind|eachMoveUpdate|is|touchend|transitionStyle|stopOnHover|100|afterGo|ease|orignalItems|opacity|rewindSpeed|style|attr|html|addCssSpeed|userOptions|owlCarousel|all|push|startDragging|addClassActive|height|beforeInit|newPosY|end|move|targetElement|200|touchmove|jsonPath|offsetY|completeImg|offsetX|relativePos|afterLazyLoad|navigationText|updateItems|calculateAll|touchstart|string|responsive|updateControls|clearTransStyle|hoverStatus|jsonSuccess|moveDirection|checkPagination|endCurrent|fn|in|paginationNumbers|click|grabbing|Object|resizer|checkNavigation|dragBeforeAnimFinish|event|originalEvent|right|checkAp|remove|get|endPrev|visible|watchVisibility|Number|create|unwrap|afterInit|logIn|playDirection|max|afterAction|updateVars|afterMove|maximumPixels|apStatus|beforeUpdate|dragging|afterUpdate|pagesInArray|reload|clearEvents|removeTransition|doTranslate|show|hide|css2move|complete|span|cssText|updatePagination|gestures|disabledEvents|buildButtons|buildPagination|mousemove|touchcancel|start|disableTextSelect|min|loops|calculateWidth|pageY|appendWrapperSizes|appendItemsSizes|resize|responsiveRefreshRate|itemsScaleUp|responsiveBaseWidth|singleItem|outer|wrap|animate|srcElement|setInterval|drag|updatePosition|onVisibleItems|block|display|getNewPosition|disable|singleItemTransition|closestItem|transitionTypes|owlStatus|inArray|moveEvents|response|continue|buildControls|loading|lazyFollow|lazyPreload|lazyEffect|fade|onStartup|customEvents|wrapItems|eventTypes|naturalWidth|checkBrowser|originalClasses|outClass|inClass|originalStyles|abs|perspective|loadContent|extend|_data|round|msMaxTouchPoints|5e3|text|stopImmediatePropagation|stopPropagation|buttons|events|pop|splice|baseElWidth|minSwipe|maxSwipe|dargging|clientX|clientY|duration|destroyControls|createElement|mouseover|mouseout|numbers|which|lazyOwl|appendTo|clearTimeout|checked|shift|sort|removeAttr|match|fadeIn|400|clickable|toggleClass|wrapAll|top|prop|tagName|DIV|background|image|url|wrapperWidth|img|500|dragstart|ontouchstart|controls|out|input|relative|textarea|select|webkitAnimationEnd|oAnimationEnd|MSAnimationEnd|animationend|getJSON|returnValue|hasOwnProperty|option|onstartup|baseElement|navigator|new|prototype|destroy|removeData|reinit|addItem|after|before|removeItem|1199|979|768|479|800|1e3|carousel|jQuery|window|document'.split('|'),0,{}));
;
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
;
/**
 * Frontend controller.
 *
 * This file is entitled to manage all the interactions in the frontend.
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

/**
 * Video shortcodes
 * -----------------------------------------------------------------------------
 */
 window.thb_loaded_videos = 0;

(function($) {
	"use strict";

	window.thb_video_holder = function( holder ) {
		var context = holder.parent(),
			context_height = context.outerHeight(),
			context_width = context.outerWidth(),
			ratio_x = holder.data( "ratio-x" ) !== undefined ? holder.data( "ratio-x" ) : 16,
			ratio_y = holder.data( "ratio-y" ) !== undefined ? holder.data( "ratio-y" ) : 9,
			y_alignment = holder.data( "y-alignment" ) !== undefined ? holder.data( "y-alignment" ) : "middle",
			projected_width = 0,
			projected_height = 0;

		if ( context_height < ( context_width * ratio_y / ratio_x ) ) {
			projected_height = context_width * ratio_y / ratio_x;

			holder.css( "width", context_width );
			holder.css( "height", projected_height );
			holder.css( "margin-left", 0 );
			holder.css( "margin-top", 0 );

			if ( y_alignment == "middle" ) {
				holder.css( "margin-top", ( context_height - projected_height ) / 2 );
			}
		}
		else {
			projected_width = context_height * ratio_x / ratio_y;

			holder.css( "width", projected_width );
			holder.css( "height", context_height );
			holder.css( "margin-top", 0 );
			holder.css( "margin-left", ( context_width - projected_width ) / 2 );
		}
	};

	window.thb_video_holders = function( context, holder_selector ) {
		if ( holder_selector === undefined ) {
			holder_selector = '.thb-video-holder[data-fill="1"]';
		}

		$( holder_selector, context ).each(function(){
			thb_video_holder( $( this ) );
		});

		$(window).on( "resize.thb_video_holders", function() {
			$( holder_selector, context ).each(function(){
				thb_video_holder( $( this ) );
			});
		}.debounce(200) );
	};

	window.thb_video_holders_off = function( context, holder_selector ) {
		if ( holder_selector === undefined ) {
			holder_selector = '.thb-video-holder[data-fill="1"]';
		}

		$( window ).off( ".thb_video_holders" );

		$( holder_selector, context ).each(function(){
			$( this ).removeAttr( "style" );
		});
	};

	window.THB_Video = function( id, obj, type ) {
		var self = this;

		this.id = id;
		this.obj = obj;
		this.type = type;

		/**
		 * State
		 */
		this.state = function( code ) {
			var state = "";

			switch( code ) {
				case 0:
					state = "finished";
					break;
				case 1:
					state = "playing";
					break;
				default:
					state = "paused";
					break;
			}

			return state;
		};

		/**
		 * Videos loaded callback
		 */
		this.callbackCheck = function() {
			window.thb_loaded_videos++;

			this.obj.addClass("thb-video-loaded");
			self.obj.trigger( "thb-video-loaded" );

			if ( window.thb_loaded_videos === window.thb_total_videos ) {
				$(window).trigger("thb-loaded-videos");
			}
		};

		/**
		 * Init
		 */
		this.init = function() {
			var self = this;

			switch( this.type ) {
				case "youtube":
					this.api = new YT.Player("youtube-" + this.id, {
						events: {
							onStateChange: function(state) {
								self.obj.trigger( "change", [ self.state(state.data) ] );
							},
							onReady: function() {
								self.callbackCheck();
							}
						}
					});

					this.play = function() { this.api.playVideo(); };
					this.pause = function() { this.api.pauseVideo(); };
					this.stop = function() { this.api.stopVideo(); };
					this.isMuted = function() { return this.api.isMuted(); };
					this.mute = function() { this.api.mute(); };
					this.unMute = function() { this.api.unMute(); };
					this.toggleVolume = function() {
						if ( this.isMuted() ) {
							this.unMute();
						}
						else {
							this.mute();
						}
					};

					break;
				case "vimeo":
					this.api = new Froogaloop(this.obj.get(0));

					this.api.addEvent("ready", function(player_id) {
						self.api.addEvent("play", function() {
							self.obj.trigger("change", [self.state(1)]);
						});
						self.api.addEvent("pause", function() {
							self.obj.trigger("change", [self.state(2)]);
						});
						self.api.addEvent("finish", function() {
							self.obj.trigger("change", [self.state(0)]);
						});

						self.callbackCheck();
					});

					this.play = function() { this.api.api("play"); };
					this.pause = function() { this.api.api("pause"); };
					this.stop = function() { this.api.api("pause"); };
					this.isMuted = function() {
						var muted = false;

						this.api.api( "getVolume", function( vol ) {
							if ( vol == 0 ) {
								muted = true;
							}
						} );

						return muted;
					};
					this.mute = function() { self.api.api( "setVolume", 0 ); };
					this.unMute = function() { self.api.api( "setVolume", 1 ); };
					this.toggleVolume = function() {
						var self = this;

						this.api.api( "getVolume", function( vol ) {
							if ( vol == 0 ) {
								self.unMute();
							}
							else {
								self.mute();
							}
						} );
					};

					break;
				default:
					this.api = this.obj.get(0);

					this.api.addEventListener("loadedmetadata", function() {
						self.obj.data('width', self.obj.get(0).videoWidth);
						self.obj.data('height', self.obj.get(0).videoHeight);

						if( self.obj.attr("autoplay") ) {
							self.play();
						}

						self.callbackCheck();
					}, false);
					this.api.addEventListener("play", function() {
						self.obj.trigger("change", [self.state(1)]);
					}, false);
					this.api.addEventListener("pause", function() {
						self.obj.trigger("change", [self.state(2)]);
					}, false);
					this.api.addEventListener("ended", function() {
						self.obj.trigger("change", [self.state(0)]);
					}, false);

					this.play = function() { this.api.play(); };
					this.pause = function() { this.api.pause(); };
					this.stop = function() { this.api.pause(); };
					this.isMuted = function() { return self.obj.get( 0 ).muted; };
					this.mute = function() { self.obj.get( 0 ).muted = true; };
					this.unMute = function() { self.obj.get( 0 ).muted = false; };
					this.toggleVolume = function() {
						self.obj.get( 0 ).muted = ! self.obj.get( 0 ).muted;
					};

					break;
			}
		};

		/**
		 * Change
		 */
		this.change = function(state) {};

		this.init();
	};

	window.thb_total_videos = 0;
	window.thb_video_ids = 0;
	window.thb_youtube_ready = false;

	$(document).ready(function() {
		window.thb_total_videos = $("iframe.thb-video-api, video.wp-video-shortcode").length;

		if ( window.thb_total_videos == 0 ) {
			$( window ).trigger( "thb-loaded-videos" );
		}

		$("iframe[src^='//player.vimeo'].thb-video-api").each(function() {
			// window.thb_boot_iframe_video( $( this ) );
			$(this).data( "player", new THB_Video( window.thb_video_ids++, $(this), 'vimeo' ) );
		});

		if( $("iframe[src*='youtu'].thb-video-api").length ) {
			window.thb_load_youtube();
		}

		// $("iframe[src*='youtu'].thb-video-api").each(function() {
		// 	window.thb_boot_iframe_video( $( this ) );
		// 	// $(this).data( "player", new THB_Video( window.thb_video_ids++, $(this), 'youtube' ) );
		// });

		$("video.wp-video-shortcode").each(function() {
			$(this).data( "player", new THB_Video( window.thb_video_ids++, $(this), 'selfhosted' ) );
		});
	});

	window.thb_load_youtube = function() {
		var tag = document.createElement("script");
		tag.src = "//www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	};

	window.thb_boot_iframe_video = function( iframe ) {
		var src = iframe.attr( "src" );

		if ( ! src ) {
			return;
		}

		if ( src.indexOf( "youtu" ) > -1 ) {
			if ( window.thb_youtube_ready ) {
				var id = window.thb_video_ids++;
				iframe.attr( "id", "youtube-" + id );
				iframe.data( "player", new THB_Video( id, iframe, 'youtube' ) );
			}
			else {
				$( window ).on( "thb-youtube-ready", function() {
					var id = window.thb_video_ids++;
					iframe.attr( "id", "youtube-" + id );
					iframe.data( "player", new THB_Video( id, iframe, 'youtube' ) );
				} );

				window.thb_load_youtube();
			}
		}
		else if ( src.indexOf( "//player.vimeo" ) > -1 ) {
			iframe.data( "player", new THB_Video( window.thb_video_ids++, iframe, 'vimeo' ) );
		}
	};

	window.onYouTubeIframeAPIReady = function() {
		window.thb_youtube_ready = true;
		$( window ).trigger( "thb-youtube-ready" );

		$("iframe[src*='youtu'].thb-video-api").each(function() {
			// window.thb_boot_iframe_video( $( this ) );
			var id = window.thb_video_ids++;

			$(this).attr( "id", "youtube-" + id );
			$(this).data( "player", new THB_Video( id, $(this), 'youtube' ) );
		});
	};
})(jQuery);

/**
 * Translations
 * -----------------------------------------------------------------------------
 */
(function($) {
	"use strict";

	$.thb.translate = function( key ) {
		if( $.thb.translations[key] ) {
			return $.thb.translations[key];
		}

		return key;
	};
})(jQuery);

/**
 * Remove empty paragraphs
 * -----------------------------------------------------------------------------
 */
(function($) {
	"use strict";

	$( document ).ready( function() {
		$('p')
			.filter(function() {
				return $.trim($(this).html()) === '';
			})
			.remove();
	} );
})(jQuery);

/**
 * ****************************************************************************
 * THB menu
 *
 * $("#menu-container").menu();
 * ****************************************************************************
 */
(function($) {
	"use strict";

	$.fn.menu = function(params) {

		// Parameters
		// --------------------------------------------------------------------
		var settings = {
			animate: true,
			speed: 350,
			display: 'block',
			easing: 'linear',
			openClass: 'current-menu-item',
			megaMenu: {
				fixed: true,
				sentinel: null
			},
			availableRightSpaceClass: 'available-space-right',
			availableLeftSpaceClass: 'available-space-left',
			'showCallback': function() {},
			'hideCallback': function() {}
		};

		// Parameters
		$.extend(settings, params);

		// Menu instance
		// --------------------------------------------------------------------
		var instance = {
			el: null,

			destroy: function() {
				$( instance.el ).find( "*" ).off( ".thb_menu" );
				$( instance.el ).find( "ul.sub-menu" ).removeAttr( "style" );
				$( window ).off( ".thb_menu" );
			},

			init: function( subMenu, item, root ) {
				instance.el = root;

				item.removeClass( settings.availableRightSpaceClass );
				item.removeClass( settings.availableLeftSpaceClass );

				// if ( item.is( ".thb-is-mega" ) ) {
				// 	return;
				// }

				var itemOffset = item.offset().left;

				if ( item.parent().hasClass( "sub-menu" ) ) {
					itemOffset += item.outerWidth();
				}

				var subMenuWidth = subMenu.outerWidth(),
					availableRightSpace = $( window ).width() - itemOffset,
					availableLeftSpace = itemOffset;

				if ( availableRightSpace > subMenuWidth ) {
					item.addClass( settings.availableRightSpaceClass );
				}

				if ( availableLeftSpace > subMenuWidth ) {
					item.addClass( settings.availableLeftSpaceClass );
				}
			},

			showMegaSubMenu: function( subMenu, item ) {
				if ( settings.megaMenu && settings.megaMenu.fixed ) {
					subMenu
						.css({
							'top': item.offset().top + item.outerHeight()
						});
				}

				this.showSubMenu( subMenu, item );
			},

			showSubMenu: function( subMenu, item ) {
				item.addClass( settings.openClass );

				instance.init( subMenu, item, instance.el );

				var css_start = {
						opacity: 0,
						display: settings.display
					},
					css_end = {
						opacity: 1
					};

				if ( settings.animate ) {
					subMenu
						.stop(true, true)
						.css( css_start )
						.animate( css_end, settings.speed, settings.easing, function() {
							settings.showCallback();
						});
				}
				else {
					subMenu.css( "display", settings.display );
					settings.showCallback();
				}
			},

			hideSubMenu: function( subMenu, item ) {
				item.removeClass( settings.openClass );

				var css_end = {
						opacity: 0
					};

				if ( settings.animate ) {
					subMenu
						.stop(true, true)
						.animate( css_end, settings.speed / 2, settings.easing, function() {
							$(this).hide();
							settings.hideCallback();
						} );
				}
				else {
					subMenu.hide();
					settings.hideCallback();
				}
			}
		};

		return this.each(function() {
			var self = this,
				menuContainer = $(this),
				menu = menuContainer.find("> ul"),
				menuItems = menu.find("> li"),
				subMenuItems = menuItems.find('li').andSelf();

			$( this ).data( "thb-menu", instance );

			menuItems.each(function() {
				if ( $( this ).parents( '.thb-is-mega' ).length ) {
				// if ( $( this ).is( '.thb-is-mega' ) || $( this ).parents( '.thb-is-mega' ).length ) {
					return;
				}

				if ( settings.megaMenu && settings.megaMenu.fixed && $( this ).hasClass( "thb-is-mega" ) ) {
					$( this ).addClass( 'thb-megamenu-fixed' );
				}

				$(this).find('> a').addClass('needsclick');

				var subMenu = $(this).find('> ul');

				if( subMenu.length ) {
					subMenu.css({
						display: 'none'
					});
				}
			});

			// Binding events
			subMenuItems.each(function() {
				var item = $(this),
					subMenu = item.find("> ul");

				if ( item.parents( '.thb-is-mega' ).length ) {
					return;
				}

				if( subMenu.length ) {
					item
						.find('> a')
						.addClass('w-sub needsclick');

					instance.init( subMenu, item, self );

					item
						.on( "mouseenter.thb_menu", function() {
							if ( item.hasClass( "thb-is-mega" ) ) {
								instance.showMegaSubMenu( subMenu, $(this) );
							}
							else {
								instance.showSubMenu( subMenu, $(this) );
							}
						})
						.on( "mouseleave.thb_menu", function() {
							instance.hideSubMenu( subMenu, $(this) );
						});

					$( window ).on( "resize.thb_menu", function() {
						instance.init( subMenu, item, self );
					} );
				}
			});
		});

	};

})(jQuery);

/**
 * Scroll in page.
 */
;( function( $ ) {
	window.thb_scroll_in_page = function( smoothScrollSelectors, scrollOptions, offset, preScrollCallback ) {
		if ( offset === undefined ) {
			offset = 0;
		}

		scrollOptions = $.extend( {
			speed: 350,
			easing: "easeInOutCubic"
		}, scrollOptions );

		$( document ).on( "click", smoothScrollSelectors, function() {
			var href = $( this ).attr( "href" ),
				target = $( this ).attr( "target" );

			if ( href.indexOf( "#" ) > -1 ) {
				var url = href.split("#"),
					current_url = window.location.href.split("#"),
					is_same_page = url[0] == "" || ( url[0] != "" && url[0] == current_url[0] ),
					href = "#" + url[1];

				if ( is_same_page ) {
					if ( ! $( href ).length ) {
						return false;
					}

					if ( preScrollCallback !== undefined ) {
						preScrollCallback();
					}

					$.scrollTo( $( href ), scrollOptions.speed, {
						easing: scrollOptions.easing,
						offset: ( offset ) * -1
					} );

					return false;
				}
				else {
					return true;
				}
			}
		} );
	}
} )( jQuery );

/**
 * Fullscreen.
 */
;( function( $ ) {
	window.thb_fullscreen_check = function() {
		return document.documentElement.requestFullscreen || document.documentElement.mozRequestFullScreen || document.documentElement.webkitRequestFullScreen || document.documentElement.msRequestFullscreen;
	};

	window.thb_is_fullscreen = function() {
		return document.fullscreen || document.mozFullScreen || document.webkitIsFullScreen || document.msFullscreenElement;
	};

	window.thb_exit_fullscreen = function() {
		if ( document.exitFullscreen ) {
			document.exitFullscreen();
		}
		else if ( document.msExitFullscreen ) {
			document.msExitFullscreen();
		}
		else if ( document.mozCancelFullScreen ) {
			document.mozCancelFullScreen();
		}
		else if ( document.webkitExitFullscreen ) {
			document.webkitExitFullscreen();
		}
	};

	window.thb_go_fullscreen = function( elem ) {
		elem = $( elem ).get( 0 );

		if ( elem.requestFullscreen ) {
			elem.requestFullscreen();
		}
		else if ( elem.msRequestFullscreen ) {
			elem.msRequestFullscreen();
		}
		else if ( elem.mozRequestFullScreen ) {
			elem.mozRequestFullScreen();
		}
		else if ( elem.webkitRequestFullscreen ) {
			elem.webkitRequestFullscreen();
		}
	};

	window.thb_fullscreen_transition = function( on ) {
		if ( on ) {
			$( "html" ).addClass( "thb-full-screen" );
		}
		else {
			$( "html" ).removeClass( "thb-full-screen" );
		}
	};

	if ( document.addEventListener ) {
		document.addEventListener( "fullscreenchange", function () {
			thb_fullscreen_transition( document.fullscreen );
		}, false );

		document.addEventListener( "mozfullscreenchange", function () {
			thb_fullscreen_transition( document.mozFullScreen );
		}, false );

		document.addEventListener( "webkitfullscreenchange", function () {
			thb_fullscreen_transition( document.webkitIsFullScreen );
		}, false );

		document.addEventListener( "msfullscreenchange", function () {
			thb_fullscreen_transition( document.msFullscreenElement );
		}, false );
	}
	else {
		document.attachEvent( "fullscreenchange", function () {
			thb_fullscreen_transition( document.fullscreen );
		} );

		document.attachEvent( "mozfullscreenchange", function () {
			thb_fullscreen_transition( document.mozFullScreen );
		} );

		document.attachEvent( "webkitfullscreenchange", function () {
			thb_fullscreen_transition( document.webkitIsFullScreen );
		} );

		document.attachEvent( "msfullscreenchange", function () {
			thb_fullscreen_transition( document.msFullscreenElement );
		} );
	}
} )( jQuery );

/**
 * Parallax.
 */
;( function( $ ) {
	var $window = $( window ),
		windowHeight = $window.height();

	var THB_Parallax = function( $el, options ) {
		var parallax = this;

		options = $.extend( {}, {
			speed: 0.6,
			xpos: "50%"
		}, options );

		this.update = function() {
			var offset = $el.offset().top,
				pos = $window.scrollTop(),
				height = $el.outerHeight();

			if ( offset + height < pos || offset > pos + windowHeight ) {
				return;
			}

			$el.css( "backgroundPosition", options.xpos + " " + Math.round( ( offset - pos ) * options.speed ) + "px" );
		};

		$window.on( "scroll", this.update );
		$window.on( "resize", function() {
			windowHeight = $window.height();
			parallax.update();
		} );

		this.update();
	};

	$.fn.thbParallax = function( options ) {
		return this.each( function() {
			if ( ! $( this ).data( "thbParallax" ) ) {
				$( this ).data( "thbParallax", new THB_Parallax( $( this ), options ) );
			}
		} );
	};
} )( jQuery );

/**
 * Scroll to include.
 */
;( function( $ ) {
	$.scrollToInclude = function( element, options ) {
		element = $( element );

		options = $.extend( {
			speed: 350,
			easing: "easeInOutCubic",
			offset: 0
		}, options );

		var element_height = element.outerHeight(),
			element_offset = element.position().top,
			endOfScroll = parseInt( element_offset + element_height + options.offset, 10 );

		endOfScroll -= $( window ).height();

		$.scrollTo( endOfScroll, options.speed, {
			easing: options.easing,
			offset: ( options.offset ) * -1
		} );
	};
} )( jQuery );

/**
 * Frontend conditional controller.
 */
;( function( $ ) {
	if( ! $.thb ) {
		$.thb = {};
	}

	$.thb.wp = {
		is_body_class: function( classname ) {
			return $( "body" ).hasClass( classname );
		},
		is_post_type: function( post_type ) {
			return $( "body" ).hasClass( "single-" + post_type );
		},
		is_single_post: function() {
			return $.thb.wp.is_post_type( "post" );
		},
		is_page: function( arg ) {
			if ( $( "body" ).hasClass( "page" ) ) {
				if ( typeof arg === 'string' ) {
					// Template
					arg = arg.replace( /./g, '-' );
					return $( "body" ).hasClass( "page-template-" + arg );
				}
				else if ( typeof arg === 'number' ) {
					// Page ID
					return $( "body" ).hasClass( "page-id-" + arg );
				}
			}

			return false;
		},
		is_mobile: function() {
			return $( "body" ).hasClass( "thb-mobile" );
		},
		is_desktop: function() {
			return $( "body" ).hasClass( "thb-desktop" );
		},
		is_larger_than: function( width ) {
			return Math.max(document.documentElement.clientWidth, window.innerWidth || 0) >= width;
		},
		is_smaller_than: function( width ) {
			return Math.max(document.documentElement.clientWidth, window.innerWidth || 0) <= width;
		},
		is_between: function( min, max ) {
			var viewport = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)

			return viewport >= min && viewport <= max;
		}
	}
} )( jQuery );
;
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
;
var Froogaloop=function(){function e(a){return new e.fn.init(a)}function g(a,c,b){if(!b.contentWindow.postMessage)return!1;a=JSON.stringify({method:a,value:c});b.contentWindow.postMessage(a,h)}function l(a){var c,b;try{c=JSON.parse(a.data),b=c.event||c.method}catch(e){}"ready"!=b||k||(k=!0);if(!/^https?:\/\/player.vimeo.com/.test(a.origin))return!1;"*"===h&&(h=a.origin);a=c.value;var m=c.data,f=""===f?null:c.player_id;c=f?d[f][b]:d[b];b=[];if(!c)return!1;void 0!==a&&b.push(a);m&&b.push(m);f&&b.push(f);
return 0<b.length?c.apply(null,b):c.call()}function n(a,c,b){b?(d[b]||(d[b]={}),d[b][a]=c):d[a]=c}var d={},k=!1,h="*";e.fn=e.prototype={element:null,init:function(a){"string"===typeof a&&(a=document.getElementById(a));this.element=a;return this},api:function(a,c){if(!this.element||!a)return!1;var b=this.element,d=""!==b.id?b.id:null,e=c&&c.constructor&&c.call&&c.apply?null:c,f=c&&c.constructor&&c.call&&c.apply?c:null;f&&n(a,f,d);g(a,e,b);return this},addEvent:function(a,c){if(!this.element)return!1;
var b=this.element,d=""!==b.id?b.id:null;n(a,c,d);"ready"!=a?g("addEventListener",a,b):"ready"==a&&k&&c.call(null,d);return this},removeEvent:function(a){if(!this.element)return!1;var c=this.element,b=""!==c.id?c.id:null;a:{if(b&&d[b]){if(!d[b][a]){b=!1;break a}d[b][a]=null}else{if(!d[a]){b=!1;break a}d[a]=null}b=!0}"ready"!=a&&b&&g("removeEventListener",a,c)}};e.fn.init.prototype=e.fn;window.addEventListener?window.addEventListener("message",l,!1):window.attachEvent("onmessage",l);return window.Froogaloop=
window.$f=e}();