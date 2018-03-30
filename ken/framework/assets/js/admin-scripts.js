function mk_upload_option() {
    if (typeof wp.media != 'undefined') {
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;
        jQuery('.option-upload-button').click(function(e) {

            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = jQuery(this);
            var id = button.attr('id').replace('_button', '');
            _custom_media = true;
            wp.media.editor.send.attachment = function(props, attachment) {
                if (_custom_media) {
                    jQuery("#" + id).val(attachment.url);
                    jQuery("#" + id + "-preview img").attr("src", attachment.url);
                } else {
                    return _orig_send_attachment.apply(this, [props, attachment]);
                };
            }
            wp.media.editor.open(button);
            return false;
        });
        jQuery('.add_media').on('click', function() {
            _custom_media = false;
        });
    }
}



function mk_toggle() {
    jQuery('.meta-toggle-button').each(function() {

        default_value = jQuery(this).find('input').val();

        if (default_value == 'true') {
            jQuery(this).addClass('on');
        } else {
            jQuery(this).addClass('off');
        }

        jQuery(this).click(function() {

            if (jQuery(this).hasClass('on')) {

                jQuery(this).removeClass('on').addClass('off');
                jQuery(this).find('input').val('false');

            } else {

                jQuery(this).removeClass('off').addClass('on');
                jQuery(this).find('input').val('true');

            }
        });
    });
}



function mk_composer_toggle() {
    jQuery('.composer-toggle-button').each(function() {

        default_value = jQuery(this).find('input').val();

        if (default_value == 'true') {
            jQuery(this).addClass('on');
        } else {
            jQuery(this).addClass('off');
        }

        jQuery(this).click(function() {

            if (jQuery(this).hasClass('on')) {

                jQuery(this).removeClass('on').addClass('off');
                jQuery(this).find('input').val('false');

            } else {

                jQuery(this).removeClass('off').addClass('on');
                jQuery(this).find('input').val('true');

            }
        });
    });
}



function mk_shortcode_fonts() {

    jQuery("#font_family").change(function() {
        jQuery("#font_family option:selected").each(function() {
            var type = jQuery(this).attr('data-type');
            jQuery("#font_type").val(type);
        });

    }).change();

}



function mk_color_picker() {
   var $ = jQuery;

    Color.prototype.toString = function() {
        if (this._alpha < 1) {
            return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
        }
        var hex = parseInt(this._color, 10).toString(16);
        if (this.error)
            return '';
        if (hex.length < 6) {
            for (var i = 6 - hex.length - 1; i >= 0; i--) {
                hex = '0' + hex;
            }
        }
        return '#' + hex;
    };
    $('.color-picker').each(function() {
        var $control = $(this),
            value = $control.val().replace(/\s+/g, ''),
            alpha_val = 100,
            $alpha, $alpha_output;
        if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
            alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
        }
        $control.wpColorPicker({
            clear: function(event, ui) {
                $alpha.val(100);
                $alpha_output.val(100 + '%');
            }
        });
        $('<div class="vc_alpha-container">' + '<label>Alpha: <output class="rangevalue">' + alpha_val + '%</output></label>' + '<input type="range" min="1" max="100" value="' + alpha_val + '" name="alpha" class="vc_alpha-field">' + '</div>').appendTo($control.parents('.wp-picker-container:first').addClass('vc_color-picker').find('.iris-picker'));
        $alpha = $control.parents('.wp-picker-container:first').find('.vc_alpha-field');
        $alpha_output = $control.parents('.wp-picker-container:first').find('.vc_alpha-container output')
        $alpha.bind('change keyup', function() {
            var alpha_val = parseFloat($alpha.val()),
                iris = $control.data('a8cIris'),
                color_picker = $control.data('wpWpColorPicker');
            $alpha_output.val($alpha.val() + '%');
            iris._color._alpha = alpha_val / 100.0;
            $control.val(iris._color.toString());
            color_picker.toggler.css({
                backgroundColor: $control.val()
            });
        }).val(alpha_val).trigger('change');
    });
}



function mk_range_input() {
    jQuery('.mk-range-input').each(function() {
        var range_input = jQuery(this).siblings('.range-input-selector'),
            mk_min = parseFloat(jQuery(this).attr('data-min')),
            mk_max = parseFloat(jQuery(this).attr('data-max')),
            mk_step = parseFloat(jQuery(this).attr('data-step')),
            mk_value = parseFloat(jQuery(this).attr('data-value'));
        jQuery(this).slider({
            value: mk_value,
            min: mk_min,
            max: mk_max,
            step: mk_step,
            slide: function(event, ui) {
                range_input.val(ui.value);
            }
        });

    });

}



function mk_visual_selector() {
    jQuery('.mk-visual-selector').find('a').each(function() {

        default_value = jQuery(this).siblings('input').val();

        if (jQuery(this).attr('rel') == default_value) {
            jQuery(this).addClass('current');
            jQuery(this).append('<div class="selector-tick"></div>');
        }

        jQuery(this).click(function() {

            jQuery(this).siblings('input').val(jQuery(this).attr('rel'));
            jQuery(this).parent('.mk-visual-selector').find('.current').removeClass('current');
            jQuery(this).parent('.mk-visual-selector').find('.selector-tick').remove();
            jQuery(this).addClass('current');
            jQuery(this).append('<div class="selector-tick"></div>');
            return false;
        });
    });
}



jQuery.expr[':'].Contains = function(a, i, m) {
    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
};

function icon_filter_name() {
    jQuery('.page-composer-icon-filter').each(function() {
        jQuery(this).change(function() {
            var filter = jQuery(this).val();
            var list = jQuery(this).siblings('.mk-font-icons-wrapper');
            if (filter) {
                jQuery(list).find("span:not(:Contains(" + filter + "))").parent('a').hide();
                jQuery(list).find("span:Contains(" + filter + ")").parent('a').show();
            } else {
                jQuery(list).find("a").show();
            }
            return false;
        })
            .keyup(function() {
                jQuery(this).change();
            });
    });
}



function mk_composer_preview_button() {
    var $preview = jQuery('#preview-action #post-preview');
    $preview.clone()
        .removeAttr('id').removeClass('preview').addClass('right')
        .css('margin-left', '5px')
        .click(function(e) {
            $preview.click();
            e.preventDefault();
        })
        .insertAfter('.wpb-update-button');
}



function super_link() {
    var wrap = jQuery(".superlink-wrap");
    wrap.each(function() {
        var field = jQuery(this).siblings('input:hidden');
        var selector = jQuery(this).siblings('select');
        var name = field.attr('name');
        var items = jQuery(this).children();
        selector.change(function() {
            items.hide();
            jQuery("#" + name + "_" + jQuery(this).val()).show();
            field.val('');
        });
        items.change(function() {
            field.val(selector.val() + '||' + jQuery(this).val());
        });
    });
}



/* 
**
Post types
-------------------------------------------------------------*/
function mk_post_types() {
    var ajax_type_options = jQuery('#_video_url_wrapper, #_gallery_type_wrapper, #_gallery_images_wrapper, #_mp3_file_wrapper, #_ogg_file_wrapper, #_audio_iframe_wrapper');
    ajax_type_options.hide();
    var preview_type = jQuery('#post-formats-select input[name=post_format]:checked').val();


    if (preview_type == 'video') {

        jQuery('#_video_url_wrapper').show();

    } else if (preview_type == 'gallery') {

        jQuery('#_gallery_type_wrapper, #_gallery_images_wrapper').show();

    } else if (preview_type == 'audio') {

        jQuery('#_mp3_file_wrapper, #_ogg_file_wrapper, #_audio_iframe_wrapper').show();
    }



    jQuery('#post-formats-select input[name=post_format]').change(function() {
        var this_val = jQuery(this).val();
        ajax_type_options.hide();
        if (this_val == 'video') {

            jQuery('#_video_url_wrapper').show();

        } else if (this_val == 'gallery') {

            jQuery('#_gallery_type_wrapper, #_gallery_images_wrapper').show();

        } else if (this_val == 'audio') {

            jQuery('#_mp3_file_wrapper, #_ogg_file_wrapper, #_audio_iframe_wrapper').show();
        }

    });


}



/* 
**
Edge Slideshow functions
-------------------------------------------------------------*/
function mk_edge_slideshow() {
    mk_edge_choices = jQuery('#_video_mp4_wrapper, #_video_ogv_wrapper, #_video_webm_wrapper, #_video_preview_wrapper, #_slide_image_wrapper');
    mk_edge_choices.hide();
    edge_source_val = jQuery('#_edge_type').val();
    if (edge_source_val == 'image') {
        jQuery('#_slide_image_wrapper').show();
    } else if (edge_source_val == 'video') {
        jQuery('#_video_mp4_wrapper, #_video_webm_wrapper, #_video_preview_wrapper, #_video_ogv_wrapper').show();

    }

    jQuery('#_edge_type').change(function() {
        this_val = jQuery(this).val();
        mk_edge_choices.hide();
        if (this_val == 'image') {
            jQuery('#_slide_image_wrapper').show();
        } else if (this_val == 'video') {
            jQuery('#_video_mp4_wrapper, #_video_webm_wrapper, #_video_preview_wrapper, #_video_ogv_wrapper').show();
        }



    }).change();

}



/* 
**
Transparent Header functions
-------------------------------------------------------------*/
function mk_transparent_header() {
    mk_choices = jQuery('#_trans_header_offset_wrapper, #_trans_header_skin_wrapper');
    mk_choices.hide();
    header_source_val = jQuery('#_header_style').val();
    if (header_source_val == 'transparent') {
        mk_choices.show();
    }

    jQuery('#_header_style').change(function() {
        this_val = jQuery(this).val();
        mk_choices.hide();
        if (this_val == 'transparent') {
            mk_choices.show();
        }
    }).change();

}

/* 
**
Quick Contact functions
-------------------------------------------------------------*/
function mk_transparent_header() {
    mk_choices = jQuery('#_quick_contact_skin_wrapper');
    mk_choices.hide();
    header_source_val = jQuery('#_header_style').val();
    if (header_source_val == 'transparent') {
        mk_choices.show();
    }

    jQuery('#_quick_contact').change(function() {
        this_val = jQuery(this).val();
        mk_choices.hide();
        if (this_val == 'enabled') {
            mk_choices.show();
        }
    }).change();

}



jQuery(document).ready(function() {

    mk_range_input();
    mk_upload_option();
    mk_toggle();
    mk_color_picker();
    mk_visual_selector();
    mk_composer_preview_button();
    mk_edge_slideshow();
    mk_transparent_header();

    jQuery(".mk-chosen").each(function() {
        jQuery(this).chosen({
            disable_search_threshold: 10
        });
    });
    super_link();

    mk_post_types();

    /*** Breadcrumb skin selector
    -------------------------------------------------------------*/
    function custom_breadcrumb(){
        var $breadcrumbID = jQuery('#_breadcrumb_skin');
        if ($breadcrumbID.val() != 'custom') {
            jQuery('#_breadcrumb_custom_color_wrapper').hide();
            jQuery('#_breadcrumb_custom_hover_color_wrapper').hide(); 
        } else {
            jQuery('#_breadcrumb_custom_color_wrapper').show();
            jQuery('#_breadcrumb_custom_hover_color_wrapper').show();
        }
        $breadcrumbID.change(function() {
            if ($breadcrumbID.val() != 'custom') {
                jQuery('#_breadcrumb_custom_color_wrapper').hide();
                jQuery('#_breadcrumb_custom_hover_color_wrapper').hide(); 
            } else {
                jQuery('#_breadcrumb_custom_color_wrapper').show();
                jQuery('#_breadcrumb_custom_hover_color_wrapper').show();
            }
        });
    }

    custom_breadcrumb();

    /***General Background Selector
    -------------------------------------------------------------*/

    mk_background_orientation = jQuery('#background_selector_orientation').val();



    /* update background viewer accordingly */
    jQuery('.mk-general-bg-selector').addClass(jQuery('#background_selector_orientation').val());
    jQuery('.background_selector_orientation a, #background_selector_orientation_container a').click(function() {
        if (jQuery(this).attr('rel') == 'full') {
            jQuery('.mk-general-bg-selector').removeClass('boxed').addClass('full');
        } else {
            jQuery('.mk-general-bg-selector').removeClass('full').addClass('boxed');
            body_section_width = jQuery('.mk-general-bg-selector .outer-wrapper').width();
            jQuery('.mk-general-bg-selector.boxed_layout .body-section').css('width', body_section_width);
        }

    });



    /* Background selector Edit panel */
    function select_current_element() {
        var options_parent_div = jQuery('.bg-repeat-option, .bg-attachment-option, .bg-position-option');

        options_parent_div.each(function() {
            jQuery(this).find('a').on('click', function(event) {
                event.preventDefault();
                jQuery(this).siblings().removeClass('selected').end().addClass('selected');
            });
        });

    }
    select_current_element();



    /* Call background Edit panel */
    function call_background_edit() {
        var sections = jQuery('.header-section, .page-section, .footer-section, .body-section, .banner-section');

        sections.each(function() {
            jQuery(this).on('click', function(event) {
                event.preventDefault();
                this_panel = jQuery(this);
                this_panel_rel = jQuery(this).attr('rel');

                jQuery('#mk-bg-edit-panel').fadeIn(200);

                // gets current section input IDs
                color_id = '#' + this_panel_rel + '_color';
                image_id = '#' + this_panel_rel + '_image';
                cover_id = '#' + this_panel_rel + '_cover';
                position_id = '#' + this_panel_rel + '_position';
                repeat_id = '#' + this_panel_rel + '_repeat';
                attachment_id = '#' + this_panel_rel + '_attachment';
                source_id = '#' + this_panel_rel + '_source';

                color_value = jQuery(color_id).val();
                image_value = jQuery(image_id).val();
                cover_value = jQuery(cover_id).val();
                position_value = jQuery(position_id).val();
                repeat_value = jQuery(repeat_id).val();
                attachment_value = jQuery(attachment_id).val();
                source_value = jQuery(source_id).val();



                jQuery('#bg_panel_color').attr('value', color_value);
                jQuery('#bg_panel_color').siblings('.minicolors-swatch').find('span').css('background-color', color_value);
                jQuery('#bg_panel_stretch').attr('value', cover_value);
                if (cover_value == 'true') {
                    jQuery('#bg_panel_stretch').parent().removeClass('off').addClass('on');
                } else {
                    jQuery('#bg_panel_stretch').parent().removeClass('on').addClass('off');
                }

                jQuery('#mk-bg-edit-panel a[rel="' + position_value + '"]').siblings().removeClass('selected').end().addClass('selected');
                jQuery('#mk-bg-edit-panel a[rel="' + repeat_value + '"]').siblings().removeClass('selected').end().addClass('selected');
                jQuery('#mk-bg-edit-panel a[rel="' + attachment_value + '"]').siblings().removeClass('selected').end().addClass('selected');
                //jQuery('.bg-background-type-tabs a[rel="' + source_value + '"]').parent('li').siblings().removeClass('current').end().addClass('current');

                if (source_value == 'custom' && image_value != '') {

                    jQuery('#bg_panel_upload').attr('value', image_value);
                    jQuery('.custom-image-preview-block img').attr('src', jQuery('#bg_panel_upload').val());
                }

                jQuery('#mk-bg-edit-panel').attr('rel', jQuery(this).attr('rel'));
                jQuery('#mk-bg-edit-panel').find('.mk-edit-panel-heading').text(jQuery(this).attr('rel'));

                jQuery('.bg-background-type-tabs').find('a[rel="' + source_value + '"]').parent().siblings().removeClass('current').end().addClass('current');


                jQuery('#mk-bg-edit-panel').find('.bg-background-type-panes').children('.bg-background-type-pane').hide();
                if (source_value == 'no-image') {

                    jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-no-image').show();

                } else if (source_value == 'custom') {

                    jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-edit-panel-upload').show();
                }



                jQuery('#mk-bg-edit-panel').find('.bg-background-type-tabs a').on('click', function(event) {

                    event.preventDefault();

                    jQuery('#mk-bg-edit-panel').find('.bg-background-type-panes').children('.bg-background-type-pane').hide();

                    jQuery(this).parent().siblings().removeClass('current').end().addClass('current');

                    if (jQuery(this).attr('rel') == 'no-image') {

                        jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-no-image').show();

                    } else if (jQuery(this).attr('rel') == 'custom') {

                        jQuery('#mk-bg-edit-panel').find('.bg-background-type-pane.bg-edit-panel-upload').show();
                    }
                });

            });
        });

    }
    call_background_edit();


    /* Background edit panel cancel and back buttons */
    jQuery('#mk_cancel_bg_selector, .mk-bg-edit-panel-heading-cancel').on('click', function(event) {
        event.preventDefault();
        jQuery('#mk-bg-edit-panel').fadeOut(200);
    });

    /* Triggers cancel button for background panel when escape key is pressed */
    jQuery(document).keyup(function(e) {
        if (e.keyCode == 27) {
            jQuery('#mk_cancel_bg_selector, .mk-bg-edit-panel-heading-cancel').click();
        }
    });

    /* Triggers Apply button for background panel when enter key is pressed */
    jQuery(document).keyup(function(e) {
        if (e.keyCode == 13) {
            jQuery('#mk_apply_bg_selector').click();
        }
    });

    /* Sends Panel Modifications into inputs and updates preview panel background */
    function update_panel_to_preview() {
        jQuery('#mk_apply_bg_selector').on('click', function(event) {
            event.preventDefault();
            panel = jQuery('#mk-bg-edit-panel');
            panel_source = panel.attr('rel');
            section_preview_class = '.' + panel_source + '-section';
            color = panel.find('#bg_panel_color').val();
            bg_cover = panel.find('#bg_panel_stretch').val();
            position = jQuery('.bg-position-option').find('.selected').attr('rel');
            repeat = jQuery('.bg-repeat-option').find('.selected').attr('rel');
            attachment = jQuery('.bg-attachment-option').find('.selected').attr('rel');


            image_source = jQuery('.bg-background-type-tabs').find('.current').children('a').attr('rel');

            if (image_source == 'custom') {
                image = jQuery('#bg_panel_upload').val();
            } else if (image_source == 'no-image') {
                image = '';
            }


            // gets current section input IDs
            color_id = '#' + panel_source + '_color';
            image_id = '#' + panel_source + '_image';
            cover_id = '#' + panel_source + '_cover';
            position_id = '#' + panel_source + '_position';
            repeat_id = '#' + panel_source + '_repeat';
            attachment_id = '#' + panel_source + '_attachment';
            source_id = '#' + panel_source + '_source';

            // Updates Input values
            jQuery(color_id).attr('value', color);
            jQuery(image_id).attr('value', image);
            jQuery(cover_id).attr('value', bg_cover);
            jQuery(position_id).attr('value', position);
            jQuery(repeat_id).attr('value', repeat);
            jQuery(attachment_id).attr('value', attachment);
            jQuery(source_id).attr('value', image_source);


            //update preview panel background
            if (image != '') {
                jQuery(section_preview_class).find('.mk-bg-preview-layer').css({
                    'background-image': 'url(' + image + ')',
                });
            }

            if (image_source == 'no-image') {
                jQuery(section_preview_class).find('.mk-bg-preview-layer').css({
                    'background-image': 'none',
                });
            }

            jQuery(section_preview_class).find('.mk-bg-preview-layer').css({
                'background-color': color,
                'background-position': position,
                'background-repeat': repeat,
                'background-attachment': attachment,
            });


            panel.fadeOut(200);

            panel.find('#bg_panel_color').val('');
            jQuery('.bg-position-option').find('.selected').removeClass('selected');
            jQuery('.bg-repeat-option').find('.selected').removeClass('selected');
            jQuery('.bg-attachment-option').find('.selected').removeClass('selected');
            jQuery('#bg_panel_upload').val('');
            jQuery('.custom-image-preview-block img').attr('src', '');
        });

    }
    update_panel_to_preview();



    /* Update the preview panel backgrounds on load */
    function update_preview_on_load() {

        jQuery('.page-section, .body-section, .header-section, .footer-section, .banner-section').each(function() {

            this_panel = jQuery(this);
            this_panel_rel = this_panel.attr('rel');

            // gets current section input IDs
            color_id = '#' + this_panel_rel + '_color';
            image_id = '#' + this_panel_rel + '_image';
            position_id = '#' + this_panel_rel + '_position';
            repeat_id = '#' + this_panel_rel + '_repeat';
            attachment_id = '#' + this_panel_rel + '_attachment';

            color = jQuery(color_id).val();
            image = jQuery(image_id).val();
            position = jQuery(position_id).val();
            repeat = jQuery(repeat_id).val();
            attachment = jQuery(attachment_id).val();

            //update preview panel background
            if (image != '') {
                jQuery(this_panel).find('.mk-bg-preview-layer').css({
                    'background-image': 'url(' + image + ')',
                });
            }

            jQuery(this_panel).find('.mk-bg-preview-layer').css({
                'background-color': color,
                'background-position': position,
                'background-repeat': repeat,
                'background-attachment': attachment,
            });
        });
    }

    update_preview_on_load();

});