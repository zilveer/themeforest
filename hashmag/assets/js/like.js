(function($) {
    'use strict';

    $(document).ready(function() {

        mkdfLikes();

    });

    function mkdfLikes() {

        $(document).on('click','.mkdf-like', function() {

            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if(typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'hashmag_mikado_like',
                likes_id: id,
                type: type
            };

            var like = $.post(mkdfLike.ajaxurl, dataToPass, function( data ) {

                likeLink.html(data).addClass('liked').attr('title','You already like this!');

                likeLink.children('span').css('opacity',1);
            });

            return false;
        });
    }

})(jQuery);