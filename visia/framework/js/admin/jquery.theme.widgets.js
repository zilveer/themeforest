jQuery(document).ready(function($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl */

	
	function tooltip(target) {
		$.pixelentity.tooltip(target,{
			tooltipClass: 'pe-theme-admin-tooltip pe-side',
			position: {
				my: "left-150 bottom-20"
			}
		});
	}
	
	function tooltips() {
		var widget,widgets = $("#widgets-right div[id*='pethemewidget']");
		widgets.each(function (idx) {
			widget = widgets.eq(idx);
			if (!widget.data("has-tooltip"))  {
				tooltip(widget);
				widget.data("has-tooltip",true);
			}
		});
	}

	
	
	function toObj(s) {
		var r = {};
		var match;
		var pl = /\+/g;  // Regex for replacing addition symbol with a space
		var search = /([^&=]+)=?([^&]*)/g;
		
		function decode(s) { 
			return decodeURIComponent(s.replace(pl, " ")); 
		}

		while ((match = search.exec(s))) {
			r[decode(match[1])] = decode(match[2]);			
		}
		
		return r;
	}

	
	function reloadWidget(e, xhr, settings) {
		
		var req = settings.data;
		
		if (req.search('action=save-widget') != -1 && req.search('delete_widget=1') === -1 && req.search('id_base=pethemewidget') != -1 && req.search('add_new=multi') != -1 ) {
			var wdata = toObj(settings.data);
			var widget = $("#widget-"+wdata["widget-id"]+"-savewidget").click();
		}
	}
	
	jQuery(document).ajaxSuccess(reloadWidget);
	
	jQuery(function () {
		tooltips();
		setInterval(tooltips,500);
	});

});

