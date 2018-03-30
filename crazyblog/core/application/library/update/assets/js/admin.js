jQuery(document).ready(function ($) {
    "use strict";
    $('a#tgm_dismiss').live('click', function () {
        var currentUser = $('span#dismiss-current-user').html();
        var data = 'user=' + currentUser + '&action=crazyblog_dimissNotice';
        jQuery.ajax({
            type: "post",
            url: ajaxurl,
            data: data,
            beforeSend: function () {
                $('div.page-wraper').fadeIn('slow');
            },
            success: function (response) {
                $('div.page-wraper').fadeOut('slow');
                $('div.wp-noticebox').remove();
            }
        });
        return false;
    });
    $('div.popup-wrapper span.close-btn').live('click', function () {
        $('div.popup-wrapper').fadeOut('slow');
    });
});