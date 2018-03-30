(function($) {
	"use strict";
	$(document).ready(function(){
		
		$(document).on("mouseenter", ".ultimate-call-to-action", function() {
			$(this).addClass('ultimate-call-to-action-hover');
			var hover = $(this).data('background-hover');
			$(this).css({'background-color':hover});
		});
		
		$(document).on("mouseleave", ".ultimate-call-to-action", function() {
			$(this).removeClass('ultimate-call-to-action-hover');
			var background = $(this).data('background');
			$(this).css({'background-color':background});
		});
		
		resize_call_to_action();
	});
	
	function resize_call_to_action()
	{
		$('.ultimate-call-to-action').each(function(i,element){
			var override = $(element).data('override');
			if(override != 0)
			{
				var is_relative = 'true';
				if($(element).parents('.vc-row-wrapper').length > 0)
					var ancenstor = $(element).parents('.wpb_column');
				else if($(element).parents('.wpb_column').length > 0)
					var ancenstor = $(element).parents('.vc-row-wrapper');
				else
					var ancenstor = $(element).parent();
				var parent = ancenstor;
				if(override=='full'){
					ancenstor= $('body');
					is_relative = 'false';
				}
				if(override=='ex-full'){
					ancenstor= $('html');
					is_relative = 'false';
				}
				if( ! isNaN(override)){
					for(var i=1;i<override;i++){
						if(ancenstor.prop('tagName')!='HTML'){
							ancenstor = ancenstor.parent();
						}else{
							break;
						}
					}
				}
				if(is_relative == 'false')
					var w = ancenstor.outerWidth();
				else
					var w = ancenstor.width();
					
				var a_left = ancenstor.offset().left;
				var left = $(element).offset().left;
				var calculate_left = a_left - left;

				$(element).css({'width':w, 'margin-left' : calculate_left });
			}
		});
	}
}( jQuery ));