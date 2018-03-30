(function($) {
    $(document).ready(function (){
        "use strict";

    		/* Image opts selection */
            $('body').on('click', 'img.fave-img-select', function(e){
                e.preventDefault();
                $(this).closest('ul').find('img.fave-img-select').removeClass('selected');
                $(this).addClass('selected');
                $(this).closest('ul').find('input').removeAttr('checked');
                $(this).closest('li').find('input').attr('checked','checked');


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

    });


    
})(jQuery);