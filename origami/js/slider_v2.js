jQuery.noConflict();
jQuery(document).ready(function() {

	jQuery("#normal-width-slider").easySlider({
		auto: true,
		pause:  4000,
		continuous: true,
		numeric: true
	});
});