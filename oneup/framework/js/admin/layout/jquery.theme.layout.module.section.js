(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */
	
	function addID(v) {
		return ".group_"+v;
	}
	
	function module() {}
	
	var parent = $.pixelentity.peFieldLayout.modules.Container.prototype;
	var standard = $.pixelentity.peFieldLayout.modules.Standard.prototype;
	
	function hide() {
		for (var i = 0; i < arguments.length; i++) {
			arguments[i].css("display","none");
		}
	}
	
	function show() {
		for (var i = 0; i < arguments.length; i++) {
			arguments[i].css("display","");
		}
	}

	
	var custom = {
			template: function(target) {
				this.titleField = target.find(".config input[type=text],.config select").eq(0);
				this.bg = target.find("[name=instance_%0_bg]".format(this.id));
				this.color = target.find("[name=instance_%0_color]".format(this.id)).closest(".option");
				this.alpha = target.find("[name=instance_%0_alpha]".format(this.id)).closest(".option");
				this.image = target.find("[name=instance_%0_image]".format(this.id)).closest(".option");
				this.imageh = target.find("[name=instance_%0_imageh]".format(this.id)).closest(".option");
				this.imagev = target.find("[name=instance_%0_imagev]".format(this.id)).closest(".option");
				this.imager = target.find("[name=instance_%0_imager]".format(this.id)).closest(".option");
				return parent.template.apply(this,arguments);
			},
			init: function(target) {
				this.titleField.on("change",$.proxy(this.title,this)).trigger("change");
				this.bg.on("change",$.proxy(this.layout,this)).trigger("change");
				return parent.init.apply(this,arguments);
			},
			layout: function(e) {
				hide(this.color,this.alpha,this.image,this.imageh,this.imagev,this.imager);
				switch (this.bg.filter(":checked").val()) {
				case 'color':
					show(this.color,this.alpha);
					break;
				case 'image':
					show(this.image,this.imageh,this.imagev,this.imager);
					break;
				case 'imagecolor':
					show(this.color,this.alpha,this.image,this.imageh,this.imagev,this.imager);
					break;
				}
			},
			title: standard.title
		};
	
	$.pixelentity.peFieldLayout.addModule("Section",module,$.extend({},parent,custom));
	
}(window.jqpe35 || jQuery));