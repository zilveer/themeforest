jQuery(document).ready(function($) {
    $('#sidebar').sticker({
        topSpace: 0,
        type: 'sidebar',
        enable: function() {
            if ($('body').is('.admin-bar')) {
                this.set('topSpace', 28);
            } else {
                this.set('topSpace', 0);
            }
            var api = $('#header').data('sticker');
            if (api) {
                this.set('topSpace', api.$element.outerHeight());
            }
        }
    });

    if ($('body').is('.responsive')) {
        enquire.register("screen and (max-width:979px)", {
            match: function() {
                $('#sidebar').sticker('disable');
            },
            unmatch: function() {
                $('#sidebar').sticker('enable');
            }
        });
    }
});
