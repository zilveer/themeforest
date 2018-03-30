(function($) {
    $(document).ready(function() {

        var _b = $('body'),
            el_sortable = $('.barcelona-sortable'),
            el_color_picker = $('.barcelona-colorpicker'),
            wp_media;

        if ( el_sortable.length > 0 ) {
            el_sortable.sortable();
        }

        if ( el_color_picker.length > 0 ) {
            el_color_picker.wpColorPicker({
                defaultColor: $(this).val()
            });
        }

        _b.on('click', '.barcelona-media-remove.button', function(e){
            e.preventDefault();
            var t = $(this),
                c = 'barcelona-hide';
            t.siblings('.barcelona-media-val').val('');
            t.siblings('.barcelona-media-placeholder').html('');
            t.addClass(c).siblings('.barcelona-media.button').removeClass(c);
        });

        _b.on('click', '.barcelona-media.button', function(e) {

            e.preventDefault();
            var t = $(this),
                c = 'barcelona-hide',
                el_media_val = t.siblings('.barcelona-media-val'),
                el_media_placeholder = t.siblings('.barcelona-media-placeholder');

            if ( wp_media ) {
                wp_media.open();
                return;
            }

            wp_media = wp.media({
                multiple: false  // Set to true to allow multiple files to be selected
            });

            // When an image is selected in the media frame...
            wp_media.on( 'select', function() {

                // Get media attachment details from the frame state
                var attachment = wp_media.state().get('selection').first().toJSON(),
                    media_result = attachment.url;

                if(t.data('return') == 'id') {
                    media_result = attachment.id;
                }

                el_media_val.val(media_result);
                el_media_placeholder.html($('<img>').attr({'src': attachment.url}));
                t.addClass(c).siblings('.barcelona-media-remove.button').removeClass(c);

            });

            // Finally, open the modal on click
            wp_media.open();

        });

        _b.on('change', '.barcelona-g-layout-selector', function(){
            var v = $(this).val(),
                el = $('.barcelona-g-cover-photo').add( $('.barcelona-g-tagline') );
            v == 'landscape' ? el.hide() : el.show();
        });

        _b.on('change', '.barcelona-select-post-orderby', function(){
            var v = $(this).val(),
                el = $('.barcelona-post-order-type');
            v == 'random' ? el.hide() : el.show();
        });

        _b.on('click', '.barcelona-add-social-icon-btn', function(e) {
            e.preventDefault();
            var i = $(this).parents('.widget').attr('id').split('-').pop(),
                el = $('#barcelona-social-icon-row-instance').clone(),
                sel_name = el.find('select').attr('name'),
                inp_name = el.find('input').attr('name'),
                p = $(this).parents('p');
            p.before(el.show());
            el.find('select').attr('name',sel_name.replace('__i__',i));
            el.find('input').attr('name',inp_name.replace('__i__',i));
        });

        _b.on('click', '.barcelona-social-icon-row-rm', function(e) {
            e.preventDefault();
            var p = $(this).parents('.barcelona-social-icon-row');
            p.remove();
        });

        var ev_sec_change = function(e){
            var t = $(this);
            $('.'+ t.parents('.form-field').data('el')).each(function() {
                var et = $(this),
                    cls = 'barcelona-hide',
                    val = t.hasClass('barcelona-radio') ? t.data('val') : t.val(),
                    cnd = et.data('cond'),
                    check = cnd.split(':')[0] == 'not' ? cnd.split(':')[1] != val : cnd.split(':')[1] == val;
                check ? et.removeClass(cls) : et.addClass(cls);
            });
        };

        _b.on('click', '.barcelona-tax-radio-img .barcelona-radio', function(e) {
            e.preventDefault();
            var k = 'barcelona-selected',
                t = $(this);
            if(!t.hasClass(k)) {
                t.addClass(k).siblings('.barcelona-radio').removeClass(k).siblings('.barcelona-hidden-val').val(t.data('val'));
            }
            ev_sec_change.call(t, e);
        });

        _b.on('change', '.barcelona-sec', ev_sec_change);

        _b.on('change', '#page_template', function(e) {
            var v = $(this).val(),
                el_metabox = $('#barcelona_pb');
            if(v == 'page-modules.php') {
                el_metabox.show();
            } else {
                el_metabox.hide();
            }
        });


    });
})(jQuery);