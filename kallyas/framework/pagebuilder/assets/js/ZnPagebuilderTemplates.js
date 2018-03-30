(function($)
{
	"use strict";

	$.ZnPagebuilderTemplates = {
		init : function(){

			var that = this;

			that.bindActions();

		},

		bindActions : function(){
			var that = this;
			that.bind_save_template();

		},

		bind_save_template : function() {

			var that = this;

			// Add behavior for the template saving
			$('.zn_pb_save_template').on('click', function(e){
				e.preventDefault();

				var el 	  = $(this),
					input = el.prev('input');

				// Check if the input is empty
				if ( !input.val() ) {
					input.addClass('zn_error');
					return false;
				}

				var args = {};
				args.hide_editor = true;
				args.show_page_loading = true;

				var JsonData = that.build_map( $('.zn_pb_wrapper > .zn_pb_section'), true );

				args.data = {
					action: 'zn_save_template',
					template_name : input.val(),
					template : JSON.stringify(JsonData),
					post_id : $('#zn_post_id').val(),
					security: ZnAjax.security
				};


				$.ZnPagebuilderAjax.do_ajax(args);

			});
		},

	};

})(jQuery);