(function($) {
    	
        $(document).ready(function ($) {
			"use strict";

        /* Image select */

        $('body').on('click', 'img.fave-img-select', function(e){
            e.preventDefault();
            $(this).closest('ul').find('img.fave-img-select').removeClass('selected');
            $(this).addClass('selected');
             $(this).closest('ul').find('input').removeAttr('checked');
                $(this).closest('li').find('input').attr('checked','checked');

            if($(this).closest('ul').hasClass('next-hide')){
                var v = $(this).closest('li').find('input:checked').val();
                if(v == 'inherit' || v == 0){
                     $(this).closest('.form-field').next().fadeOut(400);
                } else {
                    $(this).closest('.form-field').next().fadeIn(400);
                }
            }
        });

    	/* Color picker metabox handle */
    	
    	if($('.fave_colorpicker').length){
    		$('.fave_colorpicker').wpColorPicker();

    		$('a.fave_colorpick').click(function(e){
    			e.preventDefault();
    			$('.fave_colorpicker').val($(this).attr('data-color'));
    			$('.fave_colorpicker').change();
    		});	
    	}

    	fave_toggle_color_picker();
    	
    	$("body").on("click", "input.color-type", function(e){
					fave_toggle_color_picker();
		});
			   
    	function fave_toggle_color_picker(){
    		var picker_value = $('input.color-type:checked').val();
    		if(picker_value == 'custom'){
    			$('#fave_color_wrap').show();
    		} else {
    			$('#fave_color_wrap').hide();
    		}
    	}

    });
    	
})(jQuery);