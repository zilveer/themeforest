jQuery(document).ready(function ($) {

            var called = 0;
            $('#wpcontent').ajaxStop(function() {
                if (0 == called) {
                    $('[value="uploaded"]').attr('selected', true).parent().trigger('change');
                    called = 1;
                }
            });

            $('#upload_button').click(function(e) {
                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = $(this);
                var id = button.attr('id').replace('_button', '');
                _custom_media = true;
                wp.media.editor.send.attachment = function(props, attachment) {
                    if (_custom_media) {
                        $("#" + id).val(attachment.url);
                    } else {
                        return _orig_send_attachment.apply(this, [props, attachment]);
                    };
                }

                wp.media.editor.open(button);
                return false;
            });

            $('.add_media').on('click', function() {
                _custom_media = false;
            });

});