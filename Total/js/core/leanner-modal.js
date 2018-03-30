/**
 * @plugin leanerModal
 * @author Finely Sliced <finelysliced.com.au>
 * @author Edward Hotchkiss <edwardhotchkiss@me.com>
 * @description originally from http://leanmodal.finelysliced.com.au/
 *
 * @modified by AJ Clarke for the Total WordPress theme
 **/

 (function($) {
	 $.fn.extend({
		 leanerModal: function(options) {
			 function close_modal(modal_id) {
			 	$(modal_id).removeClass( 'active' );
				$("#lean_overlay").fadeOut();
				$(modal_id).css({
					display: "none"
				});
			 }
			 var defaults = {
				 overlay: .5,
				 closeButton: ".modal_close"
			 };
			 var overlay = $('<div id="lean_overlay"></div>');
			 if (!$("#lean_overlay").length) {
				 $("body").append(overlay);
			 }
			 options = $.extend(defaults, options);
			 return this.each(function() {
				 var _options = options;
				 $(this).live("click", function(e) {
					 var modal_id = _options.id;
					 $("#lean_overlay").live("click", function() {
						 close_modal(modal_id)
					 });
					 $(_options.closeButton).live("click", function() {
						 close_modal(modal_id)
					 });
					 var modal_height = $(modal_id).outerHeight();
					 var modal_width = $(modal_id).outerWidth();
					 $("#lean_overlay").css({
						 display: "block",
						 opacity: 0
					 });
					 $("#lean_overlay").stop( true, true ).fadeTo(200, _options.overlay);
					 $(modal_id).css({
						 display: "block",
						 position: "fixed",
						 opacity: 0,
						 "z-index": 11e3,
						 left: 50 + "%",
						 "margin-left": -(modal_width / 2) + "px"
					 });
					 $(modal_id).stop( true, true ).fadeTo(200, 1).addClass( 'active' );
					 return false;
				 });
			 });
		 }
	 });
 })(jQuery);