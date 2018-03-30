jQuery(document).ready(function($) {
    $('#page').sticker({
        type: 'fill',
        useFlex: false
    });

    if ($('body').is('.responsive') && sticky_footer_target > 320) {
        var query = "screen and (max-width:" + sticky_footer_target + "px)";
        enquire.register(query, {
            match: function() {
                $('#page').sticker('disable');
            },

            unmatch: function() {
                $('#page').sticker('enable');
            }
        });
    }
});
