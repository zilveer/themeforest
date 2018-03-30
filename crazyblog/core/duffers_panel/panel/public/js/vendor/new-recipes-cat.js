jQuery(document).ready(function ($) {
    var custom_uploader;
    var custom_uploader2;
    $('button#category_image').on('click', function (e) {
        e.preventDefault();
        var $this = $(this).parent('div.term-cat-image-wrap');
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            library: {
                type: 'image'

            },
            multiple: false
        });
        custom_uploader.on('select', function () {
            var selection = custom_uploader.state().get('selection');
            selection.map(function (model) {
                var thumbnail = model.attributes.url;
                if (model.attributes.sizes !== undefined && model.attributes.sizes.thumbnail !== undefined)
                    thumbnail = model.attributes.sizes.thumbnail.url;

                $($this).children('input').val(model.id);
                $($this).children('div.preview').show().html('<div class="image"><div class="cross">x</div><img alt="" src="' + thumbnail + '"></div>');
            });
        });
        custom_uploader.open();
        return false;
    });

    $('button#category_icon').on('click', function (e) {
        e.preventDefault();
        var $this = $(this).parent('div.term-cat-icon-wrap');
        if (custom_uploader2) {
            custom_uploader2.open();
            return;
        }
        custom_uploader2 = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            library: {
                type: 'image'

            },
            multiple: false
        });
        custom_uploader2.on('select', function () {
            var selection = custom_uploader2.state().get('selection');
            selection.map(function (model) {
                var thumbnail = model.attributes.url;
                if (model.attributes.sizes !== undefined && model.attributes.sizes.thumbnail !== undefined)
                    thumbnail = model.attributes.sizes.thumbnail.url;

                $($this).children('input').val(model.id);
                $($this).children('div.preview').show().html('<div class="image"><div class="cross">x</div><img alt="" src="' + thumbnail + '"></div>');
            });
        });
        custom_uploader2.open();
        return false;
    });

    $('div.cross').live('click', function () {
        $(this).parents('div.preview').html('').hide();
    });
});