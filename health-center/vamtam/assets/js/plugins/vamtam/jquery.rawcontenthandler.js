;(function($) {
	"use strict";
	
	var readyStarted = false;
	var readyEnded = false;

	// This should be the FIRST ready handler to execute
	$(function() {
		readyStarted = true;
	});

	// This should be the LAST ready handler to execute
	$(document).bind("ready", function() {
		readyEnded = true;
	});

	$.rawContentHandler = function(cb) {
		if ($.isFunction(cb)) {
			if (!readyStarted) {
				$(function() {
					$.rawContentHandler(cb);
				});
			} else {
				if (!readyEnded) {
					var tgt = $("body")[0];
					cb.call(tgt, tgt.childNodes);
				}

				$(window).bind("rawContent", function(e, items) {
					cb.call(e.target, items || e.target.childNodes);
				});
			}
		}
	};
})(jQuery);