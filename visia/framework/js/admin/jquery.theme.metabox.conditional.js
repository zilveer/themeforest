(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxConditional = {	
		conf: {
			api: true
		} 
	};
	
	function PeMetaboxConditional(target, conf) {
		
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var control,controls = {};
		var actions = ["hide","show"];
		var fields = {};
		var values,options,parsed = JSON.parse(target.attr("data-options"));
		var state,name,value,fname,field;
		
		for (name in parsed) {
			options = parsed[name];
			controls[name] = {
				target : target.find("input[id^=%0_%1_]".format(id,name)),
				values : {}
			};
			
			for (value in options) {
				controls[name].values[value] = {};
				values = options[value];
				
				for (state in values) {
					controls[name].values[value][state] = {};
					field = values[state].split(",");
					while ((fname = field.pop())) {
						if (!fields[fname]) {
							fields[fname] = target.find("#%0_%1_".format(id,fname)).closest("div.option");
						}
						controls[name].values[value][state][fname] = fields[fname];
					}
				}
			}
			
		}
		
		function change(e) {
			var i,value,action,defined;
			
			for (name in controls) {
				control = controls[name];
				value = control.target.filter(":checked").val();
				i = actions.length;
				defined = control.values[value];
				while (i--) {
					action = actions[i];
					if (defined[action]) {
						for (field in defined[action]) {
							fields[field][action]();
						}
					}
				}
			}
		}
		// init function
		function start() {
			for (name in controls) {
				controls[name].target.change(change);
			}
			change();
		}
		
		$.extend(this, {
			// public API
			destroy: function() {
				target.data("peMetaboxConditional", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxConditional = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxConditional");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxConditional.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxConditional(el, conf);
			el.data("peMetaboxConditional", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_conditional").peMetaboxConditional();
});

