(function($){
	$(function() {
		// Overwriting Isotope core method
		$.Isotope.prototype._positionAbs = function(a, b) {
			return{right: a, top: b};
		}
	});
})(jQuery);