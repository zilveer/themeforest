jQuery(document).ready(function ($) {
    "use strict";
    jQuery('ul.extention-bottom li button').live('click', function () {
        var $this = $(this);
        var plugin = jQuery(this).data('slug');
        var check = jQuery(this).data('repo');
        var type = $(this).attr('class');
        if (type == 'not-install') {
            var data = 'plugin=' + plugin + '&repo=' + check.toString() + '&action=crazyblog_download_plugin';
        } else if (type == 'not-active') {
            var data = 'plugin=' + plugin + '&repo=' + check.toString() + '&action=crazyblog_activate_plugin';
        } else if (type == 'update') {
            var version = $(this).data('version');
            var data = 'version=' + version + '&plugin=' + plugin + '&repo=' + check.toString() + '&action=crazyblog_update_plugin';
        } else if (type == 'active') {
            return false;
        }
        var $v = $($this).parents('div.extention').find('span.update-v').text();
        jQuery.ajax({
            type: "post",
            url: ajax_url,
            data: data,
            beforeSend: function () {
                $($this).prop('disabled', true);
                $($this).find('i').fadeIn('slow');
                $('div.page-wraper').fadeIn('slow');
            },
            success: function (response) {
                $('div.page-wraper').fadeOut('slow');
                $($this).prop('disabled', false);
                $($this).find('i').fadeOut('slow');
                $($this).children('span').html(activeText);
                $($this).removeClass(type).addClass('active');
                if (wordInString(response, 'update')) {
                    $($this).parents('div.extention').find('i.fixed-v').html($v)
                    $('span.update-v').hide();
                }
                if (response.length > 0 && response != '0') {
                    $('div.popup-wrapper p#response-data').empty();
                    $('div.popup-wrapper').fadeIn('slow');
                    $('div.popup-wrapper p#response-data').html(response);
                }
            }
        });
        return false;
    });
    function wordInString(s, word) {
        return new RegExp('\\b' + word + '\\b', 'i').test(s);
    }

    $('div.popup-wrapper span.close-btn').live('click', function () {
        $('div.popup-wrapper').fadeOut('slow');
    });



//    $('ul.extention-bottom li button').on('mouseenter', function () {
//        var getClass = $(this).attr('class');
//        if (getClass === 'active') {
//            $(this).attr('class', 'deactivate');
//        }
//    }).mouseleave(function () {
//        var getClass = $(this).attr('class');
//        if (getClass === 'deactivate') {
//            $(this).attr('class', 'active');
//        }
//    });
//
//
//    $('ul.extention-bottom li button').on('mouseenter', function () {
//        var getClass = $(this).attr('class');
//        if (getClass === 'deactivate') {
//            $(this).attr('class', 'active');
//        }
//    }).mouseleave(function () {
//        var getClass = $(this).attr('class');
//        if (getClass === 'active') {
//            $(this).attr('class', 'deactivate');
//        }
//    });
});