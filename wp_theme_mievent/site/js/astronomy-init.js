jQuery(window).load(function() {
	 jQuery('#particles').particleground({
		dotColor: window.dotColor,
		lineColor: window.lineColor,
		lineWidth: window.lineWidth,
		particleRadius: window.particleRadius
	  });
});