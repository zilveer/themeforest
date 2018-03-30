(function() {
	"use strict";

	var iOS = navigator.userAgent.match(/(iPad|iPhone|iPod)/g);
	if(!iOS) return;

	window.document.addEventListener('orientationchange', function() {
		var viewportmeta = document.querySelector('meta[name="viewport"]');
		if (viewportmeta) {
			if (viewportmeta.content.match(/width=device-width/)) {
				viewportmeta.content = viewportmeta.content.replace(/width=[^,]+/, 'width=1');
			}
			viewportmeta.content = viewportmeta.content.replace(/width=[^,]+/, 'width=' + window.innerWidth);
		}
	}, false);
})();