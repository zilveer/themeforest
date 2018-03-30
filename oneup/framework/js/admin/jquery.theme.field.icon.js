(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,window */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldIcon = {	
		conf: {
			api: false
		} 
	};
	
	function PeFieldIcon(target, conf) {
		
		var icons,popup;
		
		function icon() {
			target.prev("i").remove();
			target.parent().prepend('<i class="%0"></i>'.format(target.val()));
		}

		
		function change(e) {
			target.val(e.currentTarget.id.replace(/^pe-icon-/,""));
			icon();
			popup.dialog("close");
		}

		
		function open() {
			var i,html = "";
			var current = target.val();
			for (i=0;i<icons.length;i++) {
				html += '<div id="pe-icon-%0"%1><i class="%0"></i></div>'.format(icons[i],icons[i] == current ? ' class="pe-selected"' : "");
			}
			popup.find(".pe-theme-field-icon-preview").html(html);
			popup.dialog("open");
			popup.on("click",".pe-theme-field-icon-preview > div",change);
		}
		
		function close(e) {
			popup.off("click",".pe-theme-field-icon-preview > div",change);
		}
		
		// init function
		function start() {
			icons = target.attr("data-icons") ? target.attr("data-icons").split(",") : window.pe_theme_field_icon.icons;
			if (icons) {
				icons = [""].concat(icons);
			}
			popup = $("#pe-theme-field-icon-popup");
			if (popup.length === 0) {
				popup = $('<div id="pe-theme-field-icon-popup"><div class="pe_theme"><div class="pe_theme_wrap"><div class="pe-theme-field-icon-preview"></div></div></div></div>'.format(target.attr("id")));
				$("body").append(popup);
				popup.dialog({
					autoOpen: false,
					modal: true,
					width: 900,
					resizable: false,
					draggable: false,
					dialogClass: "wp-dialog pe_dialog",
					title: "Select Icon",
					position: ["center","center"],
					zIndex: 90,
					//close: close,
					closeOnEscape: true
				});	
			}
			//open();
			popup.on("dialogclose",close);
			icon();
			target.parent().on("click",open);
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldIcon", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peFieldIcon = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldIcon");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldIcon.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldIcon(el, conf);
			el.data("peFieldIcon", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));