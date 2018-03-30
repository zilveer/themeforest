(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false */ 
	/*global jQuery,setTimeout */

	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	if ($.pixelentity.Timer) {
		return;
	}

	var queue = [];
	
	var start = $.now();
	
	function checkTimers(last,now) {
		var elapsed = now-last;
		var i = queue.length;
		var t;
		while (i--) {
			t = queue[i];
			if (t.callback === false) {
				t = queue[i] = false;
				queue.splice(i,1);
				continue;
			}
			if (t.paused) {
				continue;
			}
			t.elapsed += elapsed;
			if (t.elapsed > t.after) {
				t.elapsed = 0;
				t.paused = true;
				t.callback();
			}
		}
		
		if (queue.length === 0) {
			$.pixelentity.ticker.unregister(checkTimers);
		}
		
	}
	
	$.pixelentity.Timer = function(cb,timeout) {
		
		var self = this;
		queue.push(self);
		
		if (queue.length == 1) {
			$.pixelentity.ticker.register(checkTimers);
		}
		
		$.extend(self, {
			after: timeout,
			elapsed: 0,
			callback: cb,
			paused: true,
			start: function(after) {
				if (typeof after != "undefined") {
					self.after = after;
				}
				self.paused = false; 
			},
			reset: function() {
				self.elapsed = 0;
				self.paused = true;
			},
			pause: function() {
				self.paused = true;
			},
			resume: function() {
				self.paused = false;
			},
			destroy: function() {
				self.callback = false;
			}
		});
		
	};

		
}(jQuery));