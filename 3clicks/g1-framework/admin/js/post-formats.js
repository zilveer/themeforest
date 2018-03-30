/* global jQuery */
/* global g1_post_formats_i18n */

(function ($) {
    "use strict";

    var POST_FORMAT_DEFAULT = '0';
    var views = {};
    var metaboxesSelectors = {
        video: '#g1_meta_box_g1_post_formats_video_config',
        audio: '#g1_meta_box_g1_post_formats_audio_config',
        image: '#g1_meta_box_g1_post_formats_image_config',
        gallery: '#g1_meta_box_g1_post_formats_gallery_config'
    };

    $(document).ready(function() {
        // loads only if post format metabox available
        if ($('#formatdiv').length > 0) {
            relocateMetaboxes();
            loadCurrentView();

            $('#post-formats-select .post-format').bind('click', function() {
                loadCurrentView();
            });
        }
    });

    function relocateMetaboxes () {
        getMetaboxes().insertBefore($('.postarea'));
    }

    /**
     * @return jQuery collection
     */
    function getMetaboxes () {
        var selectors = [];

        for (var i in metaboxesSelectors) {
            if (metaboxesSelectors.hasOwnProperty(i)) {
                selectors.push(metaboxesSelectors[i]);
            }
        }

        return $(selectors.join(', '));
    }

    /**
     * @return jQuery collection
     */
    function getTips () {
        return $('.g1-post-format-tip');
    }

    function loadCurrentView () {
        var current = $('#post-formats-select .post-format:checked').attr('id').replace('post-format-', '');

        // reset to default view
        loadView('standard');

        // load view specific view
        if (current !== POST_FORMAT_DEFAULT) {
            loadView(current);
        }
    }

    function loadView ( type ) {
        if (typeof views[type] === 'function') {
            views[type]();
        }
    }

    views.standard = function () {
        getMetaboxes().hide();
        getTips().hide();
    };

    views.video = function () {
        $(metaboxesSelectors.video).show();
    };

    views.audio = function () {
        $(metaboxesSelectors.audio).show();
        showTip('audio');
    };

    views.image = function () {
        showTip('image');
    };

    views.gallery = function () {
        showTip('gallery');
    };

    function showTip (format) {
        var id = 'g1_post_format_' + format + '_tip';
        var $box = $('#' + id);
        var tip = typeof g1_post_formats_i18n !== 'undefined' ? g1_post_formats_i18n[format + '_tip']: null;

        if ($box.length === 0) {
            $box = $('<div>').
                attr('id', id).
                addClass('g1-post-format-tip').
                html(tip);

            $box.insertBefore($('#post-body-content'));
        }

        $box.show();
    }
})(jQuery);