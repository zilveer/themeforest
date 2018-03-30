(function (exports, $) {
    var config = $.parseJSON(g1_simple_slider_manager_config);

    $(document).ready(function() {
        handle_move_slide_up_down_action();
        handle_slide_drag_and_drop_action();
        handle_delete_slide_action();
        handle_slider_options_variants();
    });

    function handle_slider_options_variants () {
        var blacklist = {
            'simple':   {
                'width':        [],
                'animation':    []
            },
            'relay':    {
                'width':        [],
                'animation':    []
            },
            'viewport': {
                'width':        ['g1_simple_slider_wide'],
                'animation':    ['fade', 'slide-up', 'slide-down']
            },
            'standout':{
                'width':        ['g1_simple_slider_wide'],
                'animation':    ['fade', 'slide-up', 'slide-down']
            },
            'kenburns':{
                'width':        [],
                'animation':    []
            },
            'smooth':   {
                'width':        ['g1_simple_slider_wide'],
                'animation':    ['fade', 'slide-up', 'slide-down']
            }
        };

        var show_available_variants = function ($context, $layout) {
            var layoutType = $layout.val();
            var selects = {
                'width': $('select[name="_g1[simple_slider_width]"]', $context),
                'animation': $('select[name="_g1[simple_slider_animation]"]', $context)
            };

            for (var type in selects) {
                var $select = selects[type];

                // show all options
                $select.find('option').show();

                // hide options from blacklist
                if (blacklist[layoutType][type].length > 0) {
                    for (var i in blacklist[layoutType][type]) {
                        var optionValue = blacklist[layoutType][type][i];
                        var $option = $select.find('option[value="'+ optionValue +'"]').hide();

                        if ($option.is(':selected')) {
                            $select.find('option:visible:first').attr('selected', 'selected');
                        }
                    }
                }
            }
        };

        $('#g1_meta_box_simple_sliderconfig').each(function() {
            var $wrapper = $(this);
            var $layoutChoices = $('input:radio[name="_g1[simple_slider_layout]"]', $wrapper);

            show_available_variants($wrapper, $layoutChoices.filter(':checked'));

            $layoutChoices.change(function() {
                show_available_variants($wrapper, $(this));
            });
        });
    }

    function handle_move_slide_up_down_action() {
        $('.g1-simple-slide .g1-move-up').live('click', function(event) {
            event.preventDefault();

            var $slide = $(this).parents('.g1-simple-slide');
            var $prev_slide = $slide.prev('.g1-simple-slide');

            if ($prev_slide.length > 0) {
                $prev_slide = $prev_slide.prev('.g1-simple-slide');

                if ($prev_slide.length > 0) {
                    move_slide_after($slide, $prev_slide);
                } else {
                    move_slide_after($slide, null);
                }

            }
        });

        $('.g1-simple-slide .g1-move-down').live('click', function(event) {
            event.preventDefault();

            var $slide = $(this).parents('.g1-simple-slide');
            var $next_slide = $slide.next('.g1-simple-slide');

            if ($next_slide.length > 0) {
                move_slide_after($slide, $next_slide);
            }
        });
    }

    function handle_slide_drag_and_drop_action() {
        if (!$.fn.sortable) {
            return;
        }

        $( '.g1-simple-slide-container' ).sortable({
            axis: 					'y',
            cursor: 				'move',
            handle:					'.g1-handle',
            items:					'> .g1-simple-slide',
            forcePlaceholderSize: 	true,
            placeholder: 			'g1-placeholder',
            update: 				function(event, ui) {
                var $moved_elem = $(ui.item);

                var $slides = $(this).find('.g1-simple-slide');
                var current_order = $slides.index($moved_elem);
                if (current_order > 0) {
                    var $prev_elem = $moved_elem.prev('.g1-simple-slide');

                    move_slide_after($moved_elem, $prev_elem, true);
                } else {
                    move_slide_after($moved_elem, null, true);
                }
            }
        });
    }

    function handle_delete_slide_action() {
        $('.g1-simple-slide .g1-delete-slide').live('click', function(event) {
            event.preventDefault();
            var id = $(this).attr('rel');

            if (confirm(config.i18n.confirm_delete_slide)) {
                var nonce = $(this).parents('.g1-simple-slide').find('input[name="remove_wpnonce"]').val();

                $.post(
                    config.ajax_url,
                    {
                        action: 'g1_simple_slider_remove_slide',
                        ajax_data: {
                            'slide_id': id
                        },
                        _ajax_nonce: nonce
                    },
                    function (response) {
                        if (response == -1) {
                            // ajax nonce invalid, someone try to hack it
                            return;
                        }

                        var res = wpAjax.parseAjaxResponse(response, 'ajax-response');

                        if (res.errors) {
                            alert(config.i18n.error_delete_slide);
                        } else {
                            $('#g1-simple-slide-' + res.responses[0].data).remove();
                        }


                    }
                );
            }
        });
    }

    function move_slide_after($slide, $after_slide, dom_changed) {
        var post_id = $slide.parents('form').find('input#post_ID[type=hidden]').val();
        var nonce = $slide.find('input[name="move_wpnonce"]').val();
        dom_changed = dom_changed || false;

        $.post(
            config.ajax_url,
            {
                action: 'g1_simple_slider_move_slide',
                ajax_data: {
                    'post_id': post_id,
                    'slide_id': get_slide_id($slide),
                    'after_slide_id': $after_slide ? get_slide_id($after_slide) : null
                },
                _ajax_nonce: nonce
            },
            function (response) {
                if (response == -1) {
                    // ajax nonce invalid, someone try to hack it
                    return;
                }

                var res = wpAjax.parseAjaxResponse(response, 'ajax-response');

                if (res.errors) {
                    alert(config.i18n.error_move_slide);
                } else if (!dom_changed) {
                    // change elements order only if not changed (by drag and drop)
                    if ($after_slide) {
                        $slide.insertAfter($after_slide);
                    } else {
                        $slide.parents('.g1-simple-slide-container').find('.g1-simple-slide:first').before($slide);
                    }
                }
            }
        );
    }

    function get_slide_id($slide) {
        var id = $slide.attr('id');
        var matches = id.match(/\d+$/g);

        if (!matches) {
            return;
        }

        return matches[0];
    }

    // add slide
    var g1_simple_slider_slide_added = function(response) {
        var widget_id = response.widget_id;
        var post_id = $('#' + widget_id).parents('form').find('input#post_ID[type=hidden]').val();

        var data = {
            'parent_id': post_id,
            'attachment_id': response.attachment.id
        };

        var xhr = $.post(
            config.ajax_url,
            {
                action: 'g1_simple_slider_add_new_slide',
                ajax_data: data
            },
            function (response) {
                var res = wpAjax.parseAjaxResponse(response, 'ajax-response');

                if (res.errors) {
                    alert(config.i18n.error_add_slide);
                } else {
                    $('.g1-simple-slide-container').append(res.responses[0].data);
                }
            }
        );
    }

    exports.g1_simple_slider_slide_added = g1_simple_slider_slide_added;
})(window, jQuery);