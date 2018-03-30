(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,$ */
	
	//var iDev = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
	var iDev = $.pixelentity.browser.mobile;
	var videoRegexp = /[^w](mp4|webm|ogv)$|^http:\/\/(vid\.ly|youtube\.|www\.youtube\.|youtu\.be|vimeo\.|www\.vimeo\.)/i;
	var hasFlare = typeof $.fn.peFlareLightbox === "function";
	
	function noop() {
		return false;
	}
	
	var imgreg = /\.(jpg|jpeg|png|gif)$/i;
	
	function addLink() {
		var link = $(this);
		
		/*
		if (this.href.charAt(this.href.length-1) === "#" && !link.attr("data-filter")) {
			link.click(noop);
		}
		*/
		
		var target = link.attr("data-target");
		
		var handler = (target && pixelentity.targets[target]) ? pixelentity.targets[target] : false;
		if (handler) {
			link.click(handler);
		}
		
		if (hasFlare) {
			if (target === "flare") {
				link.peFlareLightbox({
					titleAttr: "data-title"
				});
			} else if (!link.attr("data-toggle") && link.attr("href") && link.attr("href").match(imgreg)) {
				var rel = link.attr("rel");
				if (!rel || !rel.match(/prettyPhoto/)) {
					link.peFlareLightbox();
				}
			}
		}
	
		
		switch (link.attr("data-rel")) {
		case "popover":
			link.popover();
			break;
		case "tooltip":
			link.tooltip({placement: link.attr("data-position") || "top"});
			break;
		}

		
		if (link.hasClass("peOver")) {
            var icon = $('<span class="overIcon '+(link.attr("data-target") == "flare" ? "lightbox" : "link")+'Icon"></span>').hide();
			
            link.append(icon).data("icon",icon);
			
            if (!iDev && $.pixelentity.effects && $.pixelentity.effects.iconmove) {
                link.bind("mouseenter mouseleave",$.pixelentity.effects.iconmove);
            }
			
        }
		
		if (link.hasClass("peOverBW")) {
            if (!iDev) {
                link.bind("mouseenter mouseleave",$.pixelentity.effects.bw);
            }
			
        }
		
		if (link.hasClass("peOverInfo")) {
            if (!iDev) {
				if (link.find("div.title").length === 0) {
					var title = $('<div class="title"></div>');
					title.append('<div class="infoWrap"><span class="peOverElementIconBG">%0</span></div>'.format('<span class="projectIcon peOverElementIcon"><i class="icon-%0 icon-white"></i></span>'.format(link.attr("data-target") == "flare" ? "lightbox" : "link")));
					title.append('<div class="peOverElementInnerBG"></div>');
					link.append(title);
				}
				link.bind("mouseenter mouseleave",$.pixelentity.effects.info);
            }
			
        }
		
		if (link.hasClass("peVideo")) {
			link.peVideoPlayer({responsive:true});
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