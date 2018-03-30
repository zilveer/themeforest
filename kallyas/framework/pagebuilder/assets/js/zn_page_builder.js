(function ($) {


	/* Add a new element for theme options */
	jQuery('body').on('click','#zn_enable_pb',function() {

		// GET THE ELEMENT TO BE ADDED

		var el = $(this),
			edit_btn = $('#zn_edit_page'),
			input_field = $('.zn_pb_input_status').find('input'),
			spinner = $('.zn_pb_buttons .spinner'),
			data = {
				action: 'zn_editor_enabler',
				post_id: jQuery(this).data('postid'),
				security: ZnAjax.security
			};

			spinner.addClass('is-active');

			// SAVE THE VALUE TO A CUSTOM FIELD SO IT CAN BE SAVED UPON POST/PAGE SAVE BUTTON PRESS
			jQuery.post( ajaxurl, data, function(response) {

				if (response) {
					if ( response.status == 'disabled'){
						el.data('status','disabled');
						$('.zn_bt_text',el).text(el.data('inactive-text'));
						//$('.zn_editor_wrap').show();
						input_field.val('disabled');
						//console.log(input_field.val());
						edit_btn.hide();
					}
					else {
						el.data('status','enabled');
						$('.zn_bt_text',el).text(el.data('active-text'));
						//$('.zn_editor_wrap').hide();
						input_field.val('enabled');
						edit_btn.show();
					}

				}
				else{
					alert('Something went wrong');
				}

				spinner.removeClass('is-active');

			},'json');

	return false;

	});

	$(document).ready(function(){

		if( typeof YoastSEO != 'undefined' ){

			// YOAST CONTENT FILTER
			ZnPBYoast = function() {
				YoastSEO.app.registerPlugin( 'ZnPBYoast', {status: 'ready'} );
				YoastSEO.app.registerModification( 'content', this.ModifyContent, 'ZnPBYoast', 5 );
			};

			ZnPBYoast.prototype.ModifyContent = function(data) {
				if( _znpb_page_content.length > 0 ){
					data = data + _znpb_page_content;
				}
				return data;
			};

			new ZnPBYoast();
		}

	});



})(jQuery);
