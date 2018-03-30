jQuery(function ($) {

    var WST = WST || {};



    // Gallery Management

    var postId = $('#post_ID').val(),
            $gallery = $('.upload_gallery ul#image-gallery');



    VPPFUIMediaControl = {
        frame: function () {

            if (this._frame)
                return this._frame;



            this._frame = wp.media({
                //title: vp_pfui_post_format.media_title,

                library: {
                    type: 'image'

                },
                button: {
                    //text: vp_pfui_post_format.media_button

                },
                multiple: true

            });



            this._frame.on('open', this.updateFrame).state('library').on('select', this.select);



            return this._frame;

        },
        select: function () {

            var selection = this.get('selection');



            selection.each(function (model) {

                var thumbnail = model.attributes.url;

                if (model.attributes.sizes !== undefined && model.attributes.sizes.thumbnail !== undefined)
                    thumbnail = model.attributes.sizes.thumbnail.url;

                $gallery.append('<li><span data-id="' + model.id + '" style="display:none;"></span><img src="' + thumbnail + '" alt="' + model.attributes.title + '" /><span class="new_tag"></span><div class="upload_gal_control"><i class="featured_upload_img"></i><i class="delete_upload_img"></i></div><i class="move_upload_img"></i></li>');

                $gallery.trigger('update');

            });

        },
        updateFrame: function () {

        },
        init: function () {

            $('#wpbody').on('click', 'a#crazyblog_gal', function (e) {

                e.preventDefault();

                VPPFUIMediaControl.frame().open();

            });

        }

    }

    VPPFUIMediaControl.init();



    $gallery.on('update', function () {

        var ids = [];

        $(this).find('li > span').each(function () {

            if ($(this).attr('data-id')) {

                ids.push($(this).data('id'));

            }

        });

        $(this).children('input').val(ids.join(','));

    });



    $gallery.sortable({
        placeholder: "ui-sortable-placeholder",
        revert: 200,
        tolerance: 'pointer',
        stop: function () {

            $gallery.trigger('update');

        }

    });



    $gallery.on('click', 'i.delete_upload_img', function (e) {

        if (confirm("Are you sure you want to delete this item?")) {

            $(this).parent().parent().fadeOut(200, function () {

                $(this).remove();

                $gallery.trigger('update');

            });

        }

    });



});