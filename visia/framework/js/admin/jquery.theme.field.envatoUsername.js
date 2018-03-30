(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldEnvatoUsername = {	
		conf: {
			api: false
		} 
	};
	
	function PeFieldEnvatoUsername(target, conf) {
		var username = $(target).closest("div.option");
		var sel,apiKEY,apiKEYUrl;
		
		// init function
		function start() {
			sel = $("#pe_theme_options_updateCheck__0,#pe_theme_options_updateCheck__1");
			apiKEY = $("#pe_theme_options_updateAPIKey_").closest("div.option");
			apiKEYUrl = $("#envatoAPI");
			sel.change(change).triggerHandler("change");
			target.keydown(setLink).change(setLink);
			apiKEYUrl.click(setLink);
		}
		
		function setLink() {
			var val = target.val();
			apiKEYUrl
				.attr("target","_blank")
				.attr("href","http://themeforest.net/user/%0/edit#tab=api_keys".format(val));
			if (val) {
				apiKEY.show();
			}
			return true;
		}

		
		function change() {
			
			if (sel.filter(":checked").val() == "yes") {
				username.show();
				if (target.val()) {
					apiKEY.show();
				}
			} else {
				username.hide();
				apiKEY.hide();
			}
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldEnvatoUsername", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldEnvatoUsername = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldEnvatoUsername");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldEnvatoUsername.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldEnvatoUsername(el, conf);
			el.data("peFieldEnvatoUsername", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));