(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,opener,parent,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,WPSetAsThumbnail,wpCookies */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peQuickImage = {
		conf: {
			api: true,
			tag: "gallery"
		} 
	};
	
	var emtpyData = {
			link: ""	
		};
		
	function PeQuickImage(target, conf) {
		var newThumb = '<div class="pe_thumb %6" id="%1"><div class="media"><div class="pe_icons"><a href="#" data-id="%1" class="delete"/></div><img data-id="%1" src="%0" data-width="%2" data-height="%3" data-url="%4" data-title="%5"/></div></div>';
		var output = $("#thumbs");
		var loading = false;
		var nonce = output.attr("data-nonce");
		var multi = output.attr("data-multi");
		var win = window.dialogArguments || opener || parent || top;
		var selection = [];
		var selected = {};
		var tags;
		var monitor = false;
		
		function changeHandler() {
			tags = target.val();
			wpCookies.set("peQuickImage",tags);
			reload();
		}
		
		function close() {
			if (win && typeof win.tb_remove === "function") {
				win.tb_remove();
			}	
		}
		
		function closeIfChanged() {
			if (monitor) {
				if (monitor.html() != monitor.data("__pe_orig_html",monitor.html())) {
					close();
				} else {
					setTimeout(closeIfChanged,300);					
				}
			}
		}

		
		function clickHandler(e) {
			var el = e.currentTarget,jel;
			monitor = false;
			if (win && win.peQuickImageCallback) {
				
				if (multi) {
					jel = $(el);
					selected[jel.attr("data-id")] = jel.closest("div.pe_thumb").toggleClass("selected").hasClass("selected");
				} else {
					win.peQuickImageCallback(getItemData(el));
				}
			} else if (nonce && window.WPSetAsThumbnail) {
				window.WPSetAsThumbnail(el.getAttribute("data-id"),nonce);
				//var field = $('.inside', '#postimagediv');
				if (win.jQuery) {
					monitor = win.jQuery("#postimagediv .inside");
					monitor.data("__pe_orig_html",monitor.html());
					setTimeout(closeIfChanged,300);
				} else {
					setTimeout(close,2000);
				}
			} else if (win.send_to_editor) {
				win.send_to_editor('<a href="%0"><img src="%0" alt="" title="%3" width="%1" height="%2" /></a>'.format(el.getAttribute("data-url"),el.getAttribute("data-width"),el.getAttribute("data-height"),el.getAttribute("data-title")));
			}
			return false;
		}
		
		function selectThumb(idx,el) {
			var jel = $(el);
			selected[jel.attr("data-id")] = true;
		}

		
		function getItemData(el) {
			return {
				id: el.getAttribute("data-id"),
				url: el.getAttribute("data-url")
			};
		}
		
		function addToSelection(idx,el) {
			el = getItemData(el);
			selection.push(el);
		}

		
		function buttonHandler(e) {
			switch (e.currentTarget.id) {
			case "pe_all":
				output.find(".pe_thumb").addClass("selected").find("img").each(selectThumb);
				break;
			case "pe_add":
				output.find(".pe_thumb.selected img").each(addToSelection);
				if (win && win.peQuickImageCallback) {
					win.peQuickImageCallback(selection);
					win.peQuickImageCallback = false;
				}
				selection = [];
				selected = {};
				setTimeout(close,100);
			}
			return false;
		}

		
		function reload() {
			if (loading) {
				return;
			}
			if (tags) {
				getData(tags);	
			} else {
				output.html("");
			}
		}
		
		function getData(tags) {
			if (loading) {
				return;
			}
			
			loading = true;
			jQuery.post(
				ajaxurl,
				{
					action : "pe_theme_gallery_fetch",
					tags : tags
				},
				refresh
			);
		}
		
		function addThumbs(data,prepend) {
			var baseurl = data.upload.baseurl+"/";
			data = data.images;
			var n = data.length;
			var image,thumb,src;
			var i;
			for (i=0;i<n;i++) {
				image = data[i];
				if (!image.data) {
					image.data = emtpyData;
				}
				src = image.meta.preview[0];
				output[prepend ? "prepend" : "append"](newThumb.format(src,image.ID,image.meta.width,image.meta.height,image.meta.absurl,image.post_title,selected[image.ID] ? "selected" : ""));
			}
		}
		
		function refresh(data) {
			output.html("");
			addThumbs(data);
			loading = false;
		}
		
		function filesUploaded(e,up,file,response) {
			if (response.response) {
				addThumbs(response.response,true);				
			}
		}
		
		function clean() {
			//console.log(win);
		}

		
		// init function
		function start() {
			var saved = wpCookies.get("peQuickImage");
			if (typeof saved !== "null") {
				target.val(saved);
			}
			
			target.change(changeHandler).triggerHandler("change");
			output.delegate("img","click",clickHandler);
			output.closest(".pe_wrap").delegate("input.ob_button","click",buttonHandler);
			$(window).one("unload",clean);
		}
		
		$.extend(this, {
			// plublic API
			//shortcode:shortcode,
			destroy: function() {
				target.data("peQuickImage", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peQuickImage = function(conf) {
		
		// return existing instance	
		var api = this.data("peQuickImage");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peQuickImage.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeQuickImage(el, conf);
			el.data("peQuickImage", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$("#media-tags").peQuickImage();
});

