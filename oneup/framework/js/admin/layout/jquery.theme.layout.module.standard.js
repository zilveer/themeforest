(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */	
	
	
	function module() {}
	
	module.prototype = {
		setup: function(master,conf) {
			this.conf = conf;
			this.master = master;
			//this.id = master.getNextID();
			this.container = false;
			this.config();
		},
		template: function(target) {
			this.target = target;
			this.titleField = target.find(".config input[type=text],.config select").eq(0);
			return target;
		},
		config: function() {
		},
		init: function(data,isNew) {
			this.titleField.on("change",$.proxy(this.title,this)).trigger("change");
		},
		title: function() {
			var title;
			if (this.titleField.is("select")) {
				title = this.titleField.find(":selected").text();
			} else {
				title = this.titleField.val();
			}
			this.target.find("span.title:first").html(title);
		},
		focus: function() {
			this.target.find(".config input,.config textarea,.config select").eq(0).focus();
		},
		remove: function() {
		},
		filter: function() {
			return false;
		}
	};
	
	$.pixelentity.peFieldLayout.addModule("Standard",module);
	
	
}(window.jqpe35 || jQuery));