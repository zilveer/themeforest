jQuery(document).ready(function($) {
    $('#header').sticker({
        type: 'top',
        topSpacing: 0,
        enable: function() {
            this.height = this.$element.outerHeight(true);
        },
        resize: function() {
            this.height = this.$element.outerHeight(true);
        },
        init: function() {
            if ($('body').is('.admin-bar')) {
                this.set('topSpace', 28);
            }
        },
        sticky: function() {
            if ($('body').is('.admin-bar')) {
                $('#sidebar').sticker('set', 'topSpace', this.height + 28);
            } else {
                $('#sidebar').sticker('set', 'topSpace', this.height);
            }
            $('#sidebar').sticker('update');
        },
        unsticky: function() {
            if ($('body').is('.admin-bar')) {
                $('#sidebar').sticker('set', 'topSpace', 28);
            } else {
                $('#sidebar').sticker('set', 'topSpace', 0);
            }
        },
        disable: function() {
            if ($('body').is('.admin-bar')) {
                $('#sidebar').sticker('set', 'topSpace', 28);
            } else {
                $('#sidebar').sticker('set', 'topSpace', 0);
            }
        }
    });

    if ($('body').is('.responsive') && sticky_header_target > 320) {
        var query = "screen and (max-width:" + sticky_header_target + "px)";
        enquire.register(query, {
            match: function() {
                $('#header').sticker('disable');
            },

            unmatch: function() {
                $('#header').sticker('enable');
            }
        });
    }
});
