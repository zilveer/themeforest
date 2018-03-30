function mk_upload_option(option_id) {
    if (typeof wp.media != 'undefined') {
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;
        var option_selector = option_id ? ("#" + option_id + "_button") : '.option-upload-button';

        jQuery(option_selector).click(function(e) {
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

function mk_range_option(option_id) {
    var range_wrapper = jQuery("#rangeInput-" + option_id);
    var mk_min = parseFloat(range_wrapper.attr("data-min"));
    var mk_max = parseFloat(range_wrapper.attr("data-max"));
    var mk_step = parseFloat(range_wrapper.attr("data-step"));
    var mk_value = parseFloat(range_wrapper.attr("data-value"));
    range_wrapper.slider({
        value: mk_value,
        min: mk_min,
        max: mk_max,
        step: mk_step,
        slide: function(event, ui) {
            range_wrapper.siblings(".range-input-selector").val(ui.value);
        }
    });
}

function mk_toggle_option(option_id) {
    var $this = jQuery("#toggle-switch-" + option_id),
        $input = $this.find("input");
    if ($input.val() == "true") {
        $this.addClass("mk-toggle-on");
    } else {
        $this.addClass("mk-toggle-off");
    }
    $this.click(function() {
        if ($this.hasClass("mk-toggle-on")) {
            $this.removeClass("mk-toggle-on").addClass("mk-toggle-off");
            $input.val("false").trigger("change");
        } else {
            $this.removeClass("mk-toggle-off").addClass("mk-toggle-on");
            $input.val("true").trigger("change");
        }
    });
}


function mk_shortcode_fonts() {
    jQuery("#font_family").change(function() {
        jQuery("#font_family option:selected").each(function() {
            var type = jQuery(this).attr('data-type');
            jQuery("#font_type").val(type).trigger("change");
        });
    }).change();
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
                range_input.val(ui.value).trigger("change");
            }
        });
    });
}

function mk_visual_selector() {
    jQuery('.mk-visual-selector').find('a').each(function() {
        var $this = jQuery(this),
            default_value = jQuery(this).siblings('input').val();
        if ($this.attr('rel') == default_value) {
            $this.addClass('current');
            $this.append('<div class="selector-tick"></div>');
        }
        jQuery(this).click(function() {
            $this.siblings('input').val(jQuery(this).attr('rel')).trigger("change");
            $this.parent('.mk-visual-selector').find('.current').removeClass('current');
            $this.parent('.mk-visual-selector').find('.selector-tick').remove();
            $this.addClass('current');
            $this.append('<div class="selector-tick"></div>');
            return false;
        });
    });
}

function mk_header_selector() {
    var header_style = jQuery('#theme_header_style').val(),
        header_align = jQuery('#theme_header_align').val(),
        header_toolbar = jQuery('#theme_toolbar_toggle').val();
    if (header_style == '4') {
        jQuery('.header-align-center').hide();
    } else {
        jQuery('.header-align-center').show();
    }
    jQuery('#mk-header-switcher').addClass('style-' + header_style + '-align-' + header_align + ' toolbar-' + header_toolbar);
    jQuery('.mk-header-styles-number').find('span').each(function() {
        var $this = jQuery(this);
        if ($this.attr('rel') == header_style) {
            $this.addClass('active');
            //console.log('style-'+header_style+'-align-'+header_align+'-toolbar-'+header_toolbar);
        }
        $this.on('click', function() {
            var header_style = jQuery('#theme_header_style').val(),
                header_align = jQuery('#theme_header_align').val(),
                header_toolbar = jQuery('#theme_toolbar_toggle').val();
            $this.siblings().removeClass('active').end().addClass('active');
            jQuery('#mk-header-switcher').attr('class', '').addClass('style-' + $this.attr('rel') + '-align-' + header_align + ' toolbar-' + header_toolbar);
            //console.log('style-'+$this.attr('rel')+'-align-'+header_align+' toolbar-'+header_toolbar);
            jQuery('#theme_header_style').val($this.attr('rel'));
            if ($this.attr('rel') == '4') {
                jQuery('.header-align-center').hide();
            } else {
                jQuery('.header-align-center').show();
            }
        });
    });
    jQuery('.mk-header-align').find('span').each(function() {
        var $this = jQuery(this);
        if ($this.attr('rel') == header_align) {
            $this.addClass('active');
        }
        $this.on('click', function() {
            var header_style = jQuery('#theme_header_style').val(),
                header_align = jQuery('#theme_header_align').val(),
                header_toolbar = jQuery('#theme_toolbar_toggle').val();
            $this.siblings().removeClass('active').end().addClass('active');
            jQuery('#mk-header-switcher').attr('class', '').addClass('style-' + header_style + '-align-' + $this.attr('rel') + ' toolbar-' + header_toolbar);
            jQuery('#theme_header_align').val($this.attr('rel'));
        });
    });
    if (header_toolbar == 'true') {
        jQuery('.header-toolbar-toggle-button').addClass('enabled');
    } else {
        jQuery('.header-toolbar-toggle-button').removeClass('enabled').addClass('disabled');
    }
    jQuery('.header-toolbar-toggle-button').on('click', function() {
        var $this = jQuery(this),
            header_style = jQuery('#theme_header_style').val(),
            header_align = jQuery('#theme_header_align').val(),
            header_toolbar = jQuery('#theme_toolbar_toggle').val();
        $this.removeClass('active').addClass('active');
        if ($this.hasClass('enabled')) {
            $this.removeClass('enabled').addClass('disabled');
            toggle_value = 'false';
            jQuery('#theme_toolbar_toggle').val('false');
        } else {
            $this.removeClass('disabled').addClass('enabled');
            toggle_value = 'true';
            jQuery('#theme_toolbar_toggle').val('true');
        }
        jQuery('#mk-header-switcher').attr('class', '').addClass('style-' + header_style + '-align-' + header_align + ' toolbar-' + toggle_value);
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
        }).keyup(function() {
            jQuery(this).change();
        });
    });
}

function mk_color_picker() {
    var $ = jQuery;
    Color.prototype.toString = function() {
        if (this._alpha < 1) {
            return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
        }
        var hex = parseInt(this._color, 10).toString(16);
        if (this.error) return '';
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
jQuery(document).ready(function() {
    mk_upload_option();
    mk_color_picker();
    mk_header_selector();
    /*
**
** Toggle Button Option
-------------------------------------------------------------*/
    jQuery('.mk-toggle-button').each(function() {
        var $this = jQuery(this),
            default_value = $this.find('input').val();
        if (default_value == 'true') {
            $this.addClass('mk-toggle-on').trigger('change');
        } else {
            $this.addClass('mk-toggle-off').trigger('change');
        }
        $this.click(function() {
            var $this = jQuery(this);
            if ($this.hasClass('mk-toggle-on')) {
                $this.removeClass('mk-toggle-on').addClass('mk-toggle-off');
                $this.find('input').val('false').trigger('change');
            } else {
                $this.removeClass('mk-toggle-off').addClass('mk-toggle-on');
                $this.find('input').val('true').trigger('change');
            }
        });
    });
    /*
**
** Range Input Plugin
-------------------------------------------------------------*/
    mk_range_input();
    /*
**
Chosen Plugin
-------------------------------------------------------------*/
    jQuery(".mk-chosen").select2({
        placeholder: "Select Options"
    });
    /*
**
** Non-safe fonts type change
-------------------------------------------------------------*/
    if (jQuery('#special_fonts_type_1').val() == 'google') {
        jQuery('#google_font_subset_1_wrapper').show();
    } else {
        jQuery('#google_font_subset_1_wrapper').hide();
    }
    jQuery("#special_fonts_list_1").change(function() {
        jQuery("#special_fonts_list_1 option:selected").each(function() {
            var type = jQuery(this).attr('data-type');
            jQuery('#special_fonts_type_1').val(type);
            if (type == 'google') {
                jQuery('#google_font_subset_1_wrapper').show();
            } else {
                jQuery('#google_font_subset_1_wrapper').hide();
            }
        });
    }).change();
    if (jQuery('#special_fonts_type_2').val() == 'google') {
        jQuery('#google_font_subset_2_wrapper').show();
    } else {
        jQuery('#google_font_subset_2_wrapper').hide();
    }
    jQuery("#special_fonts_list_2").change(function() {
        jQuery("#special_fonts_list_2 option:selected").each(function() {
            var type = jQuery(this).attr('data-type');
            jQuery('#special_fonts_type_2').val(type);
            if (type == 'google') {
                jQuery('#google_font_subset_2_wrapper').show();
            } else {
                jQuery('#google_font_subset_2_wrapper').hide();
            }
        });
    }).change();
    /*
**
Custom Sidebar
-------------------------------------------------------------*/
    jQuery("#add_sidebar_item").click(function(e) {
        e.preventDefault();
        var clone_item = jQuery(this).parents('.custom-sidebar-wrapper').siblings('#selected-sidebar').find('.default-sidebar-item').clone(true);
        var clone_val = jQuery(this).siblings('#add_sidebar').val();
        if (clone_val == '') return;
        if (jQuery('#sidebars').val()) {
            jQuery('#sidebars').val(jQuery('#sidebars').val() + ',' + jQuery("#add_sidebar").val());
        } else {
            jQuery('#sidebars').val(jQuery("#add_sidebar").val());
        }
        clone_item.removeClass('default-sidebar-item').addClass('sidebar-item');
        clone_item.find('.sidebar-item-value').attr('value', clone_val);
        clone_item.find('.slider-item-text').html(clone_val);
        jQuery("#selected-sidebar").append(clone_item);
        jQuery(".sidebar-item").fadeIn(300);
        jQuery("#add_sidebar").val("");
    });
    jQuery(".sidebar-item").css('display', 'block');
    jQuery(".delete-sidebar").click(function(e) {
        e.preventDefault();
        jQuery(this).parent("#sidebar-item").slideUp(300, function() {
            jQuery(this).remove();
            jQuery('#sidebars').val('');
            jQuery(".sidebar-item-value").each(function() {
                if (jQuery('#sidebars').val()) {
                    jQuery('#sidebars').val(jQuery('#sidebars').val() + ',' + jQuery(this).val());
                } else {
                    jQuery('#sidebars').val(jQuery(this).val());
                }
            });
        });
    });
    /*
**
Header Social Netowrks
-------------------------------------------------------------*/
    jQuery("#add_header_social_item").click(function(e) {
        e.preventDefault();
        var clone_item = jQuery('#mk-current-social').find('.default-social-item').clone(true);
        var clone_url_val = jQuery('#header_social_url').val();
        var clone_select_value = jQuery('#header_social_sites_select').val();
        if (clone_url_val === '') {
            return;
        }
        if (jQuery('#header_social_networks_site').val()) {
            jQuery('#header_social_networks_site').val(jQuery('#header_social_networks_site').val() + ',' + jQuery("#header_social_sites_select").val());
        } else {
            jQuery('#header_social_networks_site').val(jQuery("#header_social_sites_select").val());
        }
        if (jQuery('#header_social_networks_url').val()) {
            jQuery('#header_social_networks_url').val(jQuery('#header_social_networks_url').val() + ',' + jQuery("#header_social_url").val());
        } else {
            jQuery('#header_social_networks_url').val(jQuery("#header_social_url").val());
        }
        clone_item.removeClass('default-social-item').addClass('mk-social-item');
        clone_item.find('.mk-social-item-site').attr('value', clone_select_value);
        clone_item.find('.mk-social-item-url').attr('value', clone_url_val);
        clone_item.find('.social-item-url').html(clone_url_val);
        clone_item.find('.social-item-icon').html(clone_select_value);
        jQuery("#mk-current-social").append(clone_item);
        jQuery(".mk-social-item").fadeIn(300);
        jQuery("#header_social_url").val("");
    });
    jQuery(".mk-social-item").css('display', 'block');
    jQuery(".delete-social-item").click(function(e) {
        e.preventDefault();
        jQuery(this).parent(".mk-social-item").slideUp(200, function() {
            jQuery(this).remove();
            jQuery('#header_social_networks_url').val('');
            jQuery('#header_social_networks_site').val('');
            jQuery(".mk-social-item-site").each(function() {
                if (jQuery('#header_social_networks_site').val()) {
                    jQuery('#header_social_networks_site').val(jQuery('#header_social_networks_site').val() + ',' + jQuery(this).val());
                } else {
                    jQuery('#header_social_networks_site').val(jQuery(this).val());
                }
            });
            jQuery(".mk-social-item-url").each(function() {
                if (jQuery('#header_social_networks_url').val()) {
                    jQuery('#header_social_networks_url').val(jQuery('#header_social_networks_url').val() + ',' + jQuery(this).val());
                } else {
                    jQuery('#header_social_networks_url').val(jQuery(this).val());
                }
            });
        });
    });
    /*
**
Option : Super links
-------------------------------------------------------------*/
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
    super_link();
    /*
**
Visual Selector Option
-------------------------------------------------------------*/
    mk_visual_selector();
    /*
    **
    Masterkey tabs
    -------------------------------------------------------------*/
    jQuery(".masterkey-options-page, .mk-main-pane, .mk-options-container").tabs();
    /* Removes jQuery UI unwanted Classes to prevent conflicts */
    jQuery('.masterkey-options-page, .mk-main-pane, .mk-options-container, .mk-sub-pane').removeClass('ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-widget-content ui-corner-all')
    jQuery('.mk-main-navigator, .mk-sub-navigator').removeClass('ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all');
    jQuery('.mk-main-navigator li, .mk-sub-navigator li').removeClass('ui-state-default ui-corner-top ui-corner-bottom');
    /*
**
General Background Selector
-------------------------------------------------------------*/
    function mk_background_selector_orientation() {
        var orientation = jQuery('#background_selector_orientation').val(),
            options = jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper');
        //console.log(orientation);
        if (orientation === 'full_width_layout') {
            options.hide();
        } else {
            options.show();
        }
        /* update background viewer accordingly */
        jQuery('.mk-general-bg-selector').addClass(jQuery('#background_selector_orientation').val());
        jQuery('#background_selector_orientation_wrapper a, #background_selector_orientation_container a').click(function() {
            if (jQuery(this).attr('rel') === 'full_width_layout') {
                jQuery('.mk-general-bg-selector').removeClass('boxed_layout').addClass('full_width_layout');
                options.hide();
            } else {
                jQuery('.mk-general-bg-selector').removeClass('full_width_layout').addClass('boxed_layout');
                body_section_width = jQuery('.mk-general-bg-selector .outer-wrapper').width();
                jQuery('.mk-general-bg-selector.boxed_layout .body-section').css('width', body_section_width);
                options.show();
            }
        });
    }
    mk_background_selector_orientation();
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
                color_id_2 = '#' + this_panel_rel + '_color_2';
                gradient_id = '#' + this_panel_rel + '_color_gradient';
                gradient_angle_id = '#' + this_panel_rel + '_color_gradient_angle';
                gradient_style_id = '#' + this_panel_rel + '_color_gradient_style';
                image_id = '#' + this_panel_rel + '_image';
                size_id = '#' + this_panel_rel + '_size';
                parallax_id = '#' + this_panel_rel + '_parallax';
                position_id = '#' + this_panel_rel + '_position';
                repeat_id = '#' + this_panel_rel + '_repeat';
                attachment_id = '#' + this_panel_rel + '_attachment';
                source_id = '#' + this_panel_rel + '_source';
                color_value = jQuery(color_id).val();
                color_2_value = jQuery(color_id_2).val();
                gradient_value = jQuery(gradient_id).val();
                gradient_angle_value = jQuery(gradient_angle_id).val();
                gradient_style_value = jQuery(gradient_style_id).val();
                image_value = jQuery(image_id).val();
                size_value = jQuery(size_id).val();
                parallax_value = jQuery(parallax_id).val();
                position_value = jQuery(position_id).val();
                repeat_value = jQuery(repeat_id).val();
                attachment_value = jQuery(attachment_id).val();
                source_value = jQuery(source_id).val();
                jQuery('#bg_panel_color_style').attr('value', gradient_value);
                jQuery('#grandient_color_style').attr('value', gradient_style_value);
                jQuery('#grandient_color_angle').attr('value', gradient_angle_value);
                jQuery('#bg_panel_color_2').attr('value', color_value);
                jQuery('#bg_panel_color').attr('value', color_value);
                jQuery('#bg_panel_color').parent().siblings('.wp-color-result').css('background-color', color_value);
                jQuery('#bg_panel_color_2').parent().siblings('.wp-color-result').css('background-color', color_2_value);
                jQuery('#bg_panel_stretch').attr('value', size_value);
                if (size_value == 'true') {
                    jQuery('#bg_panel_stretch').parent().removeClass('mk-toggle-off').addClass('mk-toggle-on');
                } else {
                    jQuery('#bg_panel_stretch').parent().removeClass('mk-toggle-on').addClass('mk-toggle-off');
                }
                jQuery('#bg_panel_parallax').attr('value', parallax_value);
                if (parallax_value == 'true') {
                    jQuery('#bg_panel_parallax').parent().removeClass('mk-toggle-off').addClass('mk-toggle-on');
                } else {
                    jQuery('#bg_panel_parallax').parent().removeClass('mk-toggle-on').addClass('mk-toggle-off');
                }

                jQuery('#mk-bg-edit-panel a[rel="' + position_value + '"]').siblings().removeClass('selected').end().addClass('selected');
                jQuery('#mk-bg-edit-panel a[rel="' + repeat_value + '"]').siblings().removeClass('selected').end().addClass('selected');
                jQuery('#mk-bg-edit-panel a[rel="' + attachment_value + '"]').siblings().removeClass('selected').end().addClass('selected');
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
                if (gradient_value == 'gradient') {
                    jQuery('.panel-gradient-element').removeClass('is-hidden');
                } else {
                    jQuery('.panel-gradient-element').addClass('is-hidden');
                }
                if (gradient_style_value == 'linear' && gradient_value == 'gradient') {
                    jQuery('.panel-linear-gradient-el').removeClass('is-hidden');
                } else {
                    jQuery('.panel-linear-gradient-el').addClass('is-hidden');
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
        jQuery('#bg_panel_color_style').change(function() {
            var this_value = jQuery(this).val();
            if (this_value == 'gradient') {
                jQuery('.panel-gradient-element').removeClass('is-hidden');
            } else {
                jQuery('.panel-gradient-element').addClass('is-hidden');
            }
        });
        jQuery('#grandient_color_style').change(function() {
            var this_value = jQuery(this).val();
            if (this_value == 'linear') {
                jQuery('.panel-linear-gradient-el').removeClass('is-hidden');
            } else {
                jQuery('.panel-linear-gradient-el').addClass('is-hidden');
            }
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
            color_2 = panel.find('#bg_panel_color_2').val();
            color_gradient = panel.find('#bg_panel_color_style').val();
            color_gradient_style = panel.find('#grandient_color_style').val();
            color_gradient_angle = panel.find('#grandient_color_angle').val();
            bg_size = panel.find('#bg_panel_stretch').val();
            bg_parallax = panel.find('#bg_panel_parallax').val();
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
            color_2_id = '#' + panel_source + '_color_2';
            color_gradient_id = '#' + panel_source + '_color_gradient';
            color_grandient_style_id = '#' + panel_source + '_color_gradient_style';
            color_grandient_angle_id = '#' + panel_source + '_color_gradient_angle';
            image_id = '#' + panel_source + '_image';
            size_id = '#' + panel_source + '_size';
            parallax_id = '#' + panel_source + '_parallax';
            position_id = '#' + panel_source + '_position';
            repeat_id = '#' + panel_source + '_repeat';
            attachment_id = '#' + panel_source + '_attachment';
            source_id = '#' + panel_source + '_source';
            // Updates Input values
            jQuery(color_id).attr('value', color);
            jQuery(color_2_id).attr('value', color_2);
            jQuery(color_gradient_id).attr('value', color_gradient);
            jQuery(color_grandient_style_id).attr('value', color_gradient_style);
            jQuery(color_grandient_angle_id).attr('value', color_gradient_angle);
            jQuery(image_id).attr('value', image);
            jQuery(size_id).attr('value', bg_size);
            jQuery(parallax_id).attr('value', bg_parallax);
            jQuery(position_id).attr('value', position);
            jQuery(repeat_id).attr('value', repeat);
            jQuery(attachment_id).attr('value', attachment);
            jQuery(source_id).attr('value', image_source);

            if (bg_size == 'true') {
                stretch_option = 'cover';
            } else {
                stretch_option = 'contain';
            }
            //update preview panel background
            if (image != '') {
                jQuery(section_preview_class).find('.mk-bg-preview-layer').css({
                    'background-image': 'url(' + image + ')',
                    'background-size': stretch_option,
                });
            }
            
            if (image_source == 'no-image') {
                jQuery(section_preview_class).find('.mk-bg-preview-layer').css({
                    'background-image': 'none',
                });
            }
            if (color_gradient == 'single') {
                jQuery(section_preview_class).find('.mk-bg-preview-layer').css({
                    'background-color': color,
                    'background-position': position,
                    'background-repeat': repeat,
                    'background-attachment': attachment,
                });
            } else {
                if (color_gradient_style == 'linear') {
                    var gradient_style = 'linear';
                    if (color_gradient_angle == 'vertical') {
                        var gradient_angle_1 = 'top,',
                            gradient_angle_2 = 'to bottom,';
                    } else if (color_gradient_angle == 'horizontal') {
                        var gradient_angle_1 = 'left,',
                            gradient_angle_2 = 'to right,';
                    } else if (color_gradient_angle == 'diagonal_left_bottom') {
                        var gradient_angle_1 = 'top left,',
                            gradient_angle_2 = 'to bottom right,';
                    } else if (color_gradient_angle == 'diagonal_left_top') {
                        var gradient_angle_1 = 'bottom left,',
                            gradient_angle_2 = 'to top right,';
                    }
                } else if (color_gradient_style == 'radial') {
                    var gradient_style = 'radial',
                        gradient_angle_1 = '';
                    gradient_angle_2 = '';
                }
                var webkit_gradient = '-webkit-' + color_gradient_style + '-gradient(' + gradient_angle_1 + color + ' 0%, ' + color_2 + ' 100%)',
                    native_gradient = color_gradient_style + '-gradient(' + gradient_angle_2 + color + ' 0%, ' + color_2 + ' 100%)'
                jQuery(section_preview_class).find('.mk-bg-preview-layer').css({
                    'background': webkit_gradient,
                    'background': native_gradient,
                });
            }
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
            color_2_id = '#' + this_panel_rel + '_color_2';
            color_gradient_id = '#' + this_panel_rel + '_color_gradient';
            color_grandient_style_id = '#' + this_panel_rel + '_color_gradient_style';
            color_grandient_angle_id = '#' + this_panel_rel + '_color_gradient_angle';
            image_id = '#' + this_panel_rel + '_image';
            position_id = '#' + this_panel_rel + '_position';
            repeat_id = '#' + this_panel_rel + '_repeat';
            attachment_id = '#' + this_panel_rel + '_attachment';
            color = jQuery(color_id).val();
            color_2 = jQuery(color_2_id).val();
            color_gradient = jQuery(color_gradient_id).val();
            color_gradient_style = jQuery(color_grandient_style_id).val();
            color_gradient_angle = jQuery(color_grandient_angle_id).val();
            image = jQuery(image_id).val();
            position = jQuery(position_id).val();
            repeat = jQuery(repeat_id).val();
            attachment = jQuery(attachment_id).val();
            
            size_id = '#' + this_panel_rel + '_size';
            size_value = jQuery(size_id).val();
            if (size_value == 'true') {
                stretch_option = 'cover';
            } else {
                stretch_option = 'contain';
            }
            //update preview panel background
            if (image != '') {
                jQuery(this_panel).find('.mk-bg-preview-layer').css({
                    'background-image': 'url(' + image + ')',
                    'background-size': stretch_option,
                });
            }

            if (color_gradient == 'single') {
                jQuery(this_panel).find('.mk-bg-preview-layer').css({
                    'background-color': color,
                    'background-position': position,
                    'background-repeat': repeat,
                    'background-attachment': attachment,
                });
            } else {
                if (color_gradient_style == 'linear') {
                    var gradient_style = 'linear';
                    if (color_gradient_angle == 'vertical') {
                        var gradient_angle_1 = 'top,',
                            gradient_angle_2 = 'to bottom,';
                    } else if (color_gradient_angle == 'horizontal') {
                        var gradient_angle_1 = 'left,',
                            gradient_angle_2 = 'to right,';
                    } else if (color_gradient_angle == 'diagonal_left_bottom') {
                        var gradient_angle_1 = 'top left,',
                            gradient_angle_2 = 'to bottom right,';
                    } else if (color_gradient_angle == 'diagonal_left_top') {
                        var gradient_angle_1 = 'bottom left,',
                            gradient_angle_2 = 'to top right,';
                    }
                } else if (color_gradient_style == 'radial') {
                    var gradient_style = 'radial',
                        gradient_angle_1 = '';
                    gradient_angle_2 = '';
                }
                var webkit_gradient = '-webkit-' + color_gradient_style + '-gradient(' + gradient_angle_1 + color + ' 0%, ' + color_2 + ' 100%)',
                    native_gradient = color_gradient_style + '-gradient(' + gradient_angle_2 + color + ' 0%, ' + color_2 + ' 100%)'
                jQuery(this_panel).find('.mk-bg-preview-layer').css({
                    'background': webkit_gradient,
                    'background': native_gradient,
                });
            }
        });
    }
    update_preview_on_load();
});
/*
**
Save Masterkey Options
-------------------------------------------------------------*/
jQuery(document).ready(function() {
    var form = jQuery('.mk-options-container form');
    form.find('.mk-main-panes').removeClass('hidden-view');
    jQuery("button", form).bind("click keypress", function() {
        form.data("callerid", this.name);
    });
    jQuery('form#masterkey_settings').submit(function() {
        var callerId = jQuery(this).data("callerid");
        window.progressCircle().play();

        function newValues() {
            var serializedValues = jQuery('#masterkey_settings input, #masterkey_settings select, #masterkey_settings textarea[name!=theme_export_options]').serialize();
            return serializedValues;
        }
        jQuery(":hidden").change(newValues);
        jQuery("select").change(newValues);
        var serializedReturn = newValues();
        jQuery('#mk-saving-settings').show();
        data = serializedReturn + '&button_clicked=' + callerId;
        //console.log(callerId);
        //alert(serializedReturn);
        jQuery.post(ajaxurl, data, function(response) {
            //console.log(response);
            show_message(response);
        });
        return false;
    });
    /* Confirm Reset to default box */
    jQuery("#mk_reset_confirm").click(function() {
        jQuery('#mk-are-u-sure').show();
        jQuery('.mk-main-panes').addClass('hidden-view');
        return false;
    });
    jQuery(".popup-toggle-close").click(function() {
        jQuery(this).parent('.mk-message-box').hide();
        jQuery('.mk-main-panes').removeClass('hidden-view');
        return false;
    });
    jQuery("#mk_reset_ok").click(function() {
        jQuery('#mk-are-u-sure').hide();
        jQuery('.mk-main-panes').addClass('hidden-view');
        jQuery('#reset_theme_options').trigger('click');
        return false;
    });
    /**************/
    /* Disables enter key on masterkey options to prevent any unwilling submittions */
    jQuery("#masterkey_settings input").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
        }
    });
});
/* Show Box Messages */
function show_message(n) {
    if (n == 1) {
        jQuery('#mk-success-save').show();
        setTimeout(function() {
            jQuery('#mk-success-save').hide();
        }, 1500);
        window.progressCircle().status(1);
    }
    if (n == 0) {
        jQuery('#mk-not-saved').show();
        setTimeout(function() {
            jQuery('#mk-not-saved').hide();
        }, 1500);
        window.progressCircle().status(0);
    }
    if (n == 2) {
        jQuery('#mk-already-saved').show();
        setTimeout(function() {
            jQuery('#mk-already-saved').hide();
        }, 1500);
        window.progressCircle().status(0);
    }
    if (n == 3) {
        setTimeout(function() {
            jQuery('#mk-success-reset').show();
        }, 1000);
        setTimeout(function() {
            location.reload();
        }, 2000);
    }
    if (n == 4) {
        jQuery('#mk-success-import').show();
        jQuery('.mk-main-panes').addClass('hidden-view');
        setTimeout(function() {
            location.reload();
        }, 2000);
    }
    if (n == 5) {
        jQuery('#mk-fail-import').show();
        setTimeout(function() {
            jQuery('#mk-fail-import').hide();
        }, 1500);
    }
}
/*******************/
/*
**
updates Body section width on window resize
-------------------------------------------------------------*/
function mk_resize_background_selector() {
    var timer;
    resize_body_section();
    jQuery(window).resize(function() {
        clearTimeout(timer);
        setTimeout(resize_body_section, 100);
    });

    function resize_body_section() {
        body_section_width = jQuery('.mk-general-bg-selector .outer-wrapper').width();
        jQuery('.mk-general-bg-selector.boxed_layout .body-section').css('width', body_section_width);
    }
}
mk_resize_background_selector();