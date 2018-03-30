(function($)
{
	"use strict";

	$.ZnPagebuilderAjax = {
		init : function(){

			var that = this;

			that.bindActions();

		},

		bindActions : function(){
			var that = this;

			that.save_template();
			that.delete_template();
			that.load_template();
		},



		do_ajax : function( args ){


				var defaults = {
					hide_editor : true,
					show_page_loading : true,
				};

				// Should we hide the editor
				if( args.hide_editor ) {
					fw.hide_editor( true );
				}

				// Should we show the page loading ?
				if( args.show_page_loading ) {
					fw.show_page_loading();
				}

				// Make the ajax call
				jQuery.post( ZnAjax.ajaxurl, args.data, function( response ) {

					if ( response.message ) {
						new $.ZnModalMessage( response.message );
						$('.zn_pb_templates_container').isotope( 'insert', $(response.content) );
						fw.hide_page_loading( true );
						input.val('');
					}
					else{
						fw.hide_page_loading( true );
						input.val('');
						new $.ZnModalMessage('There was a problem saving the template !');
					}
					fw.show_editor();
				});

		}
	};

})(jQuery);