(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global console,jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON,ajaxurl, */
	
	if (window!=window.top) {
		return;
	}
	
	var last = 0;
	var errors = false;
	var timer;
	var preview;
	var url = window.peThemeDebug.url;
	
	function clear() {
		clearTimeout(timer);
		last = 0;
		$.ajax({
            type: 'POST',
            url: url,
			data: {
				action: 'pe_theme_debug',
				delete: 'true'
			},
            success: ajaxSuccess
        });
		return false;
	}
	
	function show() {
		if (!preview) {
			preview = $('<a href="#">CLEAR ERRORS</a>');
			preview.css({
				"display": "block",
				"position": "fixed",
				"left": "40%",
				"right": "40%",
				"bottom": 5,
				"text-align": "center",
				"padding": "5px",
				"background-color": "red",
				"color": "white",
				"text-decoration": "none",
				"font": "11px Verdana",
				"font-weight": "bold",
				"z-index": "99999"
			});
			preview.on("click",clear);
			$("body").append(preview);
		}
		preview.show();
	}
	
	function hide() {
		if (preview) {
			preview.hide();
			console.clear();
		}
	}

	
	function update() {
		if (errors) {
			show();
		} else {
			hide();
		}
	}

	function ajaxSuccess(data) {
		if (data && data.last > last) {
			errors = true;
			var file,fun,msg,error,g,i = 0;
			var open = false;
			var groups = {};
			for (i=0;i<data.errors.length;i++) {
				error = data.errors[i];
				if (error.time > last) {
					groups[error.group] = groups[error.group] || [];
					groups[error.group].push(error.error);
				}
			}
			for (g in groups) {
				console.group(g);
				i = 0;
				for (i=0;i<groups[g].length;i++) {
					error = groups[g][i];
					msg = JSON.parse(error[1]);
					msg = msg || "";
					file = error[2].split(/\/|\\/);
					file = file.length > 1 ? file.slice(Math.max(file.length - 3, 1)).join("/") : file[0];
					fun = error[4];
					fun = fun ? '[%0]'.format(fun) : '';
					if (typeof msg != 'object' && (typeof msg != 'string' || msg.indexOf('\n') < 0)) {
						console.log("%s %c%s%c%s:%c%i",msg,'font-size: 10px; color: #999999',file,'font-size: 10px; color: #279B00',fun,'font-size: 10px; color: #9B2A00',error[3]);
					} else {
						console.log("%c%s%c%s:%c%i",'font-size: 10px; color: #999999',file,'font-size: 10px; color: #279B00',fun,'font-size: 10px; color: #9B2A00',error[3]);
						if (msg instanceof Array) {
							console.log.apply(console,msg);
						} else {
							console.log(msg);
						}
					}
				}
				console.groupEnd();
			}
			last = data.last;
		} else {
			if (!data.last) {
				errors = false;
			}
		}
		update();
		clearTimeout(timer);
		timer = setTimeout(check,5000);
	}

	function check() {
		clearTimeout(timer);
		$.ajax({
            type: 'POST',
            url: url,
			data: {
				action: 'pe_theme_debug'
			},
            success: ajaxSuccess
        });
	}
	
	function reload(e, xhr, settings) {
		var req = settings && settings.data;
		
		if (!req || !req.match('action=(pe_theme_debug|heartbeat)')) {
			check();
		} 
	}

	check();
	
	jQuery(document).ajaxSuccess(reload);
	
	window.pe_theme_debug = check;
	
}(jQuery));
