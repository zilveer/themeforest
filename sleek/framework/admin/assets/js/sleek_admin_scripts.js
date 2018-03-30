/*------------------------------------------------------------
 * Admin Scripts
 *------------------------------------------------------------*/

var sleekAdmin = {};

(function($){
"use strict";



/* Sleek Widget Social Picker
 *------------------------------------------------------------*/

function sleekWidgetSocialPicker(){

	$('.sleek-widget-social-picker').not('.processed').each(function(){

		var $el = $(this);
		var $input = $el.find('input.value-joined');
		var $origin = $el.children('label');
		var $form = $el.find('.form');
		var $btn = $el.find('.js-add-new-social');

		// If not activated instance of widget, skip it
		// this happens when widget is still in #available-widgets
		// or when added in active-widgets, but still not processed with the unique ID
		if( $input.attr('id').indexOf('__i__') > -1 ){
			return;
		}



		// Add new item
		$btn.click( function(){
			$form.append( $origin.clone() );
		});

		// Remove Item
		$form.on( 'click', '.js-remove', function(){
			$(this).parent('label').remove();
			updateValue();
		});



		// Update value on form changes
		$form.on({
			change: updateValue,
			keyup: updateValue,
		}, 'input');
		$(document).on( 'sleek:iconPicked', updateValue );



		// Update value
		function updateValue(){

			var valueJoined = [];
			var i = 1;
			$form.find('label').each( function(){
				var icon = $(this).find('[name="icon"]').val();
				var url = $(this).find('[name="url"]').val();

				if( icon && url ){
					valueJoined.push(icon+'|'+url);
				}
			});

			valueJoined = valueJoined.join();
			$input.val( valueJoined );
		}



		// Mark as js processed
		$el.addClass('processed');

	});

}

$(document).ready( sleekWidgetSocialPicker );
$(document).ajaxStop( sleekWidgetSocialPicker );
$('.widgets-sortables').on( 'sortstop', sleekWidgetSocialPicker);



})(jQuery);
