(function($){
	
	"use strict";
	
	$(document).ready(function(){

		// namespace
		var importer = $('.kleo-import');

		// reset select
		$('select.import', importer).val('');

		// disable submit button
		$('.button', importer).attr('disabled','disabled');

		// select.import change
		$('select.import', importer).change(function(){

			var val = $(this).val();

			// submit button
			if( val ){
				$('.button', importer).removeAttr('disabled');
			} else {
				$('.button', importer).attr('disabled','disabled');
			}

			// content
			if( val == 'content' ){
				$('.row-content', importer).show();
			} else {
				$('.row-content', importer).hide();
			}

			// homepage
			if( val == 'page' ){
				$('.row-homepage', importer).show();
			} else {
				$('.row-homepage', importer).hide();
			}

		});

        $('select[name=page], select[name=content], select.import', importer).change(function(){
            var attach = $(this).find('option:selected').attr('data-attach');
            if (typeof attach !== typeof undefined && attach !== false) {
                $('.row-attachments', importer).show();
            } else {
                $('.row-attachments', importer).hide();
            }

        });
		
	});

})(jQuery);