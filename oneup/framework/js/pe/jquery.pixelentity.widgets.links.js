(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,$ */
	
	var iDev = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
	var videoRegexp = /[^w](mp4|webm|ogv)$|^https?:\/\/(vid\.ly|youtube\.|www\.youtube\.|youtu\.be|vimeo\.|www\.vimeo\.)/i;
	var firstImage;
	var jwin = false;
	
	function noop() {
		return false;
	}
	
	function top() {
		jwin.scrollTop(0);
		return false;
	}

	
	function addLink() {
		var link = $(this);
		var content;
		
		if (link.hasClass("twitter")) {
			content = link.attr("data-tweet") || "";
			content += content ? " " : "";
			content += location.href;
			link
				.attr("href","http://twitter.com/home?status="+encodeURIComponent(content))
				.attr("target","_blank");
			return;
		} 
		
		if (link.hasClass("facebook")) {
			link
				.attr("href","http://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(location.href))
				.attr("target","_blank");
			return;
		}
		
		if (this.href.charAt(this.href.length-1) === "#" && !link.attr("data-filter")) {
			link.click(noop);
			return;
		}
		
		
		if (this.href.match(/#top$/)) {
			if (!jwin) {
				jwin = $(window);
			}
			link.click(top);
			return;
		}

		
		var target = link.attr("data-target");
		
		var handler = (target && pixelentity.targets[target]) ? pixelentity.targets[target] : false;
		if (handler) {
			link.click(handler);
		}
		
		if (link.hasClass("influx-scroll") && !iDev) {
			firstImage = link.find("> img:eq(0)");
			if (firstImage.length > 0) {
				link.css("background-image","url("+firstImage[0].src+")");
				firstImage.fadeTo(0,0);
				link.mouseenter($.pixelentity.effects.scroll);
			}
		}
		if (link.hasClass("influx-over")) {
			if (this.href.match(videoRegexp)) {
				link.attr("data-isVideo","1");
			}
			var icon = $('<span class="'+(link.attr("data-target") == "prettyphoto" ? "lightbox" : "link")+'Icon"></span>').fadeTo(0,0);
			link.prepend(icon).data("icon",icon);	
			if (!iDev) {
				link.bind("mouseenter mouseleave",$.pixelentity.effects.icon);
			}
		}
		if (link.hasClass("influx-preview")) {
			link.bind("mouseenter mouseleave",$.pixelentity.effects.imagevideo);
		}
		
		if (link.hasClass("influx-video")) {
			link.peVideoPlayer();
		}
		
	}
	
	function check(target) {
		var t = target.find("a");
		if (t.length > 0) {
			t.each(addLink);
		}
		return false;
	}
	
	$.pixelentity.widgets.add(check);
}(jQuery));