(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,$ */
	
	var iDev = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
	var video = false;
	var videoLayer;
	var target;
	var galleries = {};
	
	function showVideo() {
		video = videoLayer.children("a.influx-video").peVideoPlayer({autoPlay: true,api: true});
	}
	
	function cleanVideo() {
		if (video && video.destroy) {
			video.destroy();
		}
		video = false;
		if (target) {
			target.triggerHandler("close.lightbox");
		}
	}
	
	function lightBoxCustom(a) {
		if (video) {
			var size = "";
			if (video.getAttribute("data-width")) {
				size = 'style="width: '+video.getAttribute("data-width")+'px; height: '+video.getAttribute("data-height")+'px;" ';
			}
			var dataSize = video.getAttribute("data-size");
			if (dataSize) {
				dataSize = 'data-size="'+dataSize+'" ';
			}
			var dataPoster = video.getAttribute("data-poster");
			if (dataPoster) {
				dataPoster = 'data-poster="'+dataPoster+'" ';
			}
			var dataFormats = video.getAttribute("data-formats");			
			if (dataFormats) {
				dataFormats = 'data-formats="'+dataFormats+'" ';
			}
			videoLayer = $("#pe_lightbox_custom_content").html('<a class="influx-video" '+size+' href="'+video.href+'" '+dataFormats+dataPoster+dataSize+' />');			
			setTimeout(showVideo,200);
		}
		return false;
	}
	
	// initialize .....
	var initA = $('<a class=\"influx-video\"/>').prettyPhoto({
			theme:"influx",
			deeplinking: false,
			social_tools: "",
			gallery_markup: "",
			custom_markup: '<div id="pe_lightbox_custom_content"></div>',
			changepicturecallback: lightBoxCustom,
			callback: cleanVideo
		});
	
	function addGallery(gallery,elements) {
		var g = {
				url: [],
				title: [],
				description: []
			};
		
		var max = elements.length;
		var el;
		for (var i = 0; i < max; i++) {
			el = $(elements[i]);
			g.url[i] = el.attr("href");
			g.description[i] = el.attr("title");
			g.title[i] = el.find("img:first").attr("title");
		}
		
		galleries[gallery] = g;
	}

	
	pixelentity.targets.prettyphoto = function() {
		target=$(this);
		var url = this.href;
		var gallery = target.attr("data-gallery");
		if (gallery && !galleries[gallery]) {
			addGallery(gallery,($('a[data-gallery="'+gallery+'"]')));
		}
				
		if (iDev) {
			target.triggerHandler("mouseleave");
		}
		if (target.attr("data-isVideo")) {
			video = this;
			var w = parseInt(this.getAttribute("data-width"),10) || 0;
			var h = parseInt(this.getAttribute("data-height"),10) || 0;
			if (w === 0 && this.getAttribute("data-size")) {
				var token = this.getAttribute("data-size").split(/x| |,/);
				w = parseInt(token[0],10) || w;
				h = parseInt(token[1],10) || h;
				this.setAttribute("data-width",w);
				this.setAttribute("data-height",h);
			}
			w = w || 674;
			h = h || 379;
			url = "#?custom=true&width="+w+"&height="+h;
		}
		if (gallery) {
			gallery = galleries[gallery];
			$.prettyPhoto.open(gallery.url,gallery.title,gallery.description);
			$.prettyPhoto.changePage($.inArray(url,gallery.url));
		} else {
			$.prettyPhoto.open(url,this.getAttribute("title"),this.getAttribute("data-description"),3);
		}
		return false;
	};
	
}(jQuery));