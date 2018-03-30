(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,SVGFEColorMatrixElement */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peBlackAndWhite = {	
		conf: {
			api: false
		} 
	};
	
	var useNative = false,useSVGFilter = false, useSVG = false;
	
	var style = document.createElement("img").style;
	var prefixes = ["-webkit-","-ms-","-moz-","-ms-",""];
	style.cssText = prefixes.join('filter' + ':grayscale(1);');
	
	useNative = document.documentMode < 10 || !!style.length;
	
	
	if (!useNative) {
		useSVGFilter = typeof SVGFEColorMatrixElement !== "undefined" && SVGFEColorMatrixElement.SVG_FECOLORMATRIX_TYPE_SATURATE==2;
		if (useSVGFilter) {
			if (document.documentMode > 9 || $.browser.opera) {
				useSVG = true;
				useSVGFilter = false;
			}
		}
	}
	
	
	function PeBlackAndWhite(target, conf) {
		
		var bw;
		
		function addOvleray() {
			
			target.parent().css({
				"display": "block",
				"-moz-transition": "all 0.3s ease-out"
			});
			
			if (useSVGFilter) {
				bw = target.clone().addClass("pe-black-and-white svg-filter").css({
					"position": "absolute",
					"opacity": 1
				});
				target.before(bw);
			} else if (useSVG) {
				target.parent().addClass("pe-black-and-white-container");
				var img = target[0];
				bw = $('<svg viewBox="0 0 %0 %1" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><filter id="grayscale"><feColorMatrix type="saturate" values="0"/></filter><image filter="url(#grayscale)" xlink:href="%2" width="%0" height="%1" /></svg>'.format(img.naturalWidth,img.naturalHeight,img.src));
				bw.addClass("pe-black-and-white").css({
					"position": "absolute",
					"width": "100%",
					"height": "100%"
				});
				target.before(bw);
			}
		}

		
		// init function
		function start() {
			if (useNative) {
				target.addClass("pe-black-and-white native");
			} else {
				if (target.attr("data-original") || target.attr("data-delayed-original") ) {
					if (target[0].peLoaded) {
						addOvleray();
					} else {
						target.one("pe-lazyload-loaded",addOvleray);
					}
				} else {
					addOvleray();
				}
			}
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peBlackAndWhite", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peBlackAndWhite = function(conf) {
		
		// return existing instance	
		var api = this.data("peBlackAndWhite");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peBlackAndWhite.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeBlackAndWhite(el, conf);
			el.data("peBlackAndWhite", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));