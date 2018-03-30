jQuery(function($) {
    if (typeof plupload !== 'undefined' && typeof WPSGwpUploaderInit !== 'undefined') {
        var uploader = new plupload.Uploader(WPSGwpUploaderInit);
        uploader.init();
        uploader.bind('FilesAdded', function(up) {
            up.start();
            $('#wpsimplegallyer_spinner').show();
        });
        uploader.bind('FileUploaded', function(up, file, res) {
            var hidespinner = (uploader.total.queued < 1) ? function() {
                $('#wpsimplegallyer_spinner').hide();
            } : function() {

            };
            if (typeof res.response !== 'undefined') {
                wpsimplegallery.get_thumbnail(res.response, hidespinner);
            }
        });
    } else {
        $('#wpsg-plupload-browse-button').hide();
    }

    var file_frame,
            wpsimplegallery = {
        admin_thumb_ul: '',
        init: function() {
            this.admin_thumb_ul = $('#wpsimplegallery_thumbs');
            this.admin_thumb_ul.sortable({
                placeholder: 'wpsimplegallery_placeholder'
            });
            this.admin_thumb_ul.on('click', '.wpsimplegallery_remove', function() {
                $(this).parent().fadeOut(100, function() {
                        $(this).remove();
                    });
                return false;
            });
            
            $('#wpsimplegallery_upload_button').on('click', function(event) {
                event.preventDefault();
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media.frames.file_frame = wp.media({
                    title: jQuery(this).data('uploader_title'),
                    button: {
                        text: jQuery(this).data('uploader_button_text'),
                    },
                    multiple: true
                });

                file_frame.on('select', function() {
                    var images = file_frame.state().get('selection').toJSON(),
                            length = images.length;
                    for (var i = 0; i < length; i++) {
                        wpsimplegallery.get_thumbnail(images[i]['id']);
                    }
                });
                file_frame.open();
            });

            $('#wpsimplegallery_add_attachments_button').on('click', function() {
                var included = [];
                $('#wpsimplegallery_thumbs input[type=hidden]').each(function(i, e) {
                    included.push($(this).val());
                });
                wpsimplegallery.get_all_thumbnails(POST_ID, included);
            });

            $('#wpsimplegallery_delete_all_button').on('click', function() {
                if (confirm('Are you sure you want to delete all the images in the gallery?')) {
                    wpsimplegallery.admin_thumb_ul.empty();
                }
                return false;
            });
        },
        get_thumbnail: function(id, cb) {
            cb = cb || function() {
            };
            var data = {
                action: 'wpsimplegallery_get_thumbnail',
                imageid: id
            };
            jQuery.post(ajaxurl, data, function(response) {
                wpsimplegallery.admin_thumb_ul.append(response);
                cb();
            });
        },
        get_all_thumbnails: function(post_id, included) {
            var data = {
                action: 'wpsimplegallery_get_all_thumbnail',
                post_id: post_id,
                included: included
            };
            $('#wpsimplegallyer_spinner').show();
            $.post(ajaxurl, data, function(response) {
                wpsimplegallery.admin_thumb_ul.append(response);
                $('#wpsimplegallyer_spinner').hide();
            });
        }
    };
    wpsimplegallery.init();
});