/*global jQuery */
/*jshint browser:true */

(function ($) {
	"use strict";

	$.ZnExport = function () {
		this.scope = $(document);
		this.zinit();
	};

	$.ZnExport.prototype = {

		zinit : function(){
			this.start_accordion();
			this.enable_toggle_all();
		},

		start_accordion : function(){
			$('.znexp-accordion').accordion({
				header: "> div.znexp-accordion-header",
				collapsible: true,
				active : false,
				heightStyle: "content",
				icons : false
			});
		},

		enable_toggle_all : function(){
			$('.znxp-toggle-all').click(function(e) {
				e.stopPropagation();

				var el = $(this),
					checkedStatus = this.checked;

				el.closest('.znexp-accordion-header').next().find(':checkbox').each(function() {
					$(this).prop('checked', checkedStatus);
				});
			});
		}
	}

	$(document).ready(function($) {
		new $.ZnExport();
	});

})(jQuery);