(function($) {
    $(document).ready(function (){
        "use strict";
            $('body').on('click', 'img.fave-img-select', function(e){
                e.preventDefault();
                $(this).closest('ul').find('img.fave-img-select').removeClass('selected');
                $(this).addClass('selected');
                $(this).closest('ul').find('input').removeAttr('checked');
                $(this).closest('li').find('input').attr('checked','checked');
            }); 
    });
    
})(jQuery);