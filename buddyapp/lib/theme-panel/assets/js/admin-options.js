( function($) {

    'use strict';

    jQuery(document).ready(function(){

        // Dependent fields
        $('.condition-me').conditionize();

        if ($.fn.wpColorPicker) {
            $('.sq-color').wpColorPicker();
        }

        // Upload image
        if ($(".sq-upload-button").length) {
            var _custom_media = true,
                _orig_send_attachment = wp.media.editor.send.attachment;

            $('.sq-upload-button').click(function (e) {
                var send_attachment_bkp = wp.media.editor.send.attachment,
                    button = $(this),
                    id = button.attr('id').replace('-button', '');

                _custom_media = true;

                wp.media.editor.send.attachment = function (props, attachment) {

                    if (_custom_media) {
                        $("#" + id).val(attachment.url);
                    } else {
                        return _orig_send_attachment.apply(this, [props, attachment]);
                    }
                    ;

                }

                wp.media.editor.open(button);
                return false;
            });

            $('.add_media').on('click', function () {
                _custom_media = false;
            });

            // Remove image
            $('.sq-remove-button').on('click', function () {

                var button = $(this),
                    id = button.attr('id').replace('-remove', '');

                $('#' + id).val('');
                $('#' + id + '-preview').fadeOut('');
                button.remove();

            });
        }


        $('#sq-form .Switch').click(function() {
            if ($(this).hasClass('On')){
                $(this).prev().find('input:checkbox').prop('checked', false).change();
                $(this).removeClass('On').addClass('Off');

            } else {
                $(this).prev().find('input:checkbox').prop('checked', true).change();
                $(this).removeClass('Off').addClass('On');

            }
        });


    });

    $.fn.conditionize = function(options){

        var settings = $.extend({
            hideJS: false
        }, options );

        $.fn.showOrHide = function(listenTo, listenFor, $section) {
            if ($(listenTo).is('select, input[type=text]') && $(listenTo).val() == listenFor ) {
                $section.show();
            }
            else if ($(listenTo + ":checked").length == listenFor) {
                $section.show();
            }
            else {
                $section.hide();
            }
        }

        return this.each( function() {
            var listenTo = "[name=" + $(this).data('cond-option') + "]";
            var listenFor = $(this).data('cond-value');
            var $section = $(this).closest("tr");

            //Set up event listener
            $(listenTo).on('change', function() {
                $.fn.showOrHide(listenTo, listenFor, $section);
            });
            //If setting was chosen, hide everything first...
            if (settings.hideJS) {
                $(this).hide();
            }
            //Show based on current value on page load
            $.fn.showOrHide(listenTo, listenFor, $section);
        });
    };

}(jQuery));