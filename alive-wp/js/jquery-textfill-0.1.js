; (function($) {
	/**
	* Resizes an inner element's font so that the inner element completely fills the outer element.
	* @author Russ Painter WebDesign@GeekyMonkey.com
	* @version 0.1
	* @param {Object} Options which are maxFontPixels (default=40), innerTag (default='span')
	* @return All outer elements processed
	* @example <div class='mybigdiv filltext'><span>My Text To Resize</span></div>
	*/
	$.fn.textfill = function(options) {
		var defaults = {
			maxFontPixels: 30,
			innerTag: 'span'
		};
		var Opts = jQuery.extend(defaults, options);
		var fontSize;
		this.each(function() {
			fontSize = Opts.maxFontPixels + 1;
			var ourText = $(Opts.innerTag + ':visible:first', this);
			var maxHeight = $(this).height();
			var maxWidth = $(this).width();
			var textHeight = maxHeight + 1;
			var textWidth = maxWidth + 1;
			while ((textHeight > maxHeight || textWidth > maxWidth) && fontSize > 3) {
				ourText.css('font-size', fontSize);
				textHeight = ourText.height();
				textWidth = ourText.width();
				fontSize = fontSize - 1;
			}
			ourText.removeAttr('style');
		});
		
		return fontSize;
	};
})(jQuery);
