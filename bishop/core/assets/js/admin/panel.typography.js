/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
(function (window, $, undefined) {
    "use strict";

    $.yit_panel_typography = function (options, element) {
        this.element = $(element);
        this._init(options);
    };

    $.yit_panel_typography.defaults = {
        elements: {
            size     : '.typography_size',
            unit     : '.typography_unit',
            family   : '.typography_family',
            style    : '.typography_style',
            color    : '.typography_color',
            align    : '.typography_align',
            transform: '.typography_transform',
            preview  : '.font-preview p',
            refresh  : '.refresh'
        }
    };

    $.yit_panel_typography.prototype = {
        _init: function (options) {
            this.options = $.extend(true, {}, $.yit_panel_typography.defaults, options);

            //init the options string
            if (yit_family_string == '') {
                //web fonts
                var web_fonts = $.parseJSON(yit_web_fonts);
                yit_family_string += '<optgroup label="Web Fonts">';
                $.each(web_fonts.items, function (i, v) {
                    yit_family_string += '<option value="' + v + '">' + v + '</option>';
                });
                yit_family_string += '</optgroup>';

                //google fonts
                var google_fonts = $.parseJSON(yit_google_fonts);

                yit_family_string += '<optgroup label="Google Fonts">';
                $.each(google_fonts.items, function (i, v) {
                    var val = v.toString().replace('700', 'bold').replace('700italic', 'bold-italic');
                    yit_family_string += '<option data-variations="' + val + '" value="' + i + '">' + i + '</option>';
                });
                yit_family_string += '</optgroup>';
            }

            this._loadElements();
            this._initEvents();
        },

        _loadElements: function () {
            var elements = this.options.elements;
            var container = this.element;

            for (var el in elements) {
                elements[el] = container.find(elements[el]);
            }
        },

        _initEvents: function () {
            var elements = this.options.elements;
            var self = this;

            //size
            var size = elements.size;
            size.spinner({
                min: size.data('min') ? size.data('min') : null,
                max: size.data('max') ? size.data('max') : null
            });

            //color
            var color = elements.color;
            //use the default of wp

            //refresh
            var refresh = elements.refresh;
            refresh.on('click', function (e) {
                e.preventDefault();

                $(this).parent().fadeOut('slow');

                //Set current value, before trigger change event

                //Color
                elements.preview.css('color', elements.color.find('input.wp-color-picker').val());

                //Transform
                elements.preview.css('text-transform', elements.transform.val());

                //Align
                elements.preview.css('text-align', elements.align.val());

                //Font size
                var size = elements.size.val();
                var unit = elements.unit.val();

                elements.preview.css('font-size', size + unit);
                elements.preview.css('line-height', ( unit == 'em' || unit == 'rem' ? Number(size) + 0.4 : Number(size) + 4 ) + unit);

                //Font style
                var style = elements.style.val();

                if (style == 'italic') {
                    elements.preview.css({ 'font-weight': 'normal', 'font-style': 'italic' });
                } else if (style == 'bold') {
                    elements.preview.css({ 'font-weight': 'bold', 'font-style': 'normal' });
                } else if (style == 'extra-bold') {
                    elements.preview.css({ 'font-weight': '800', 'font-style': 'normal' });
                } else if (style == 'bold-italic') {
                    elements.preview.css({ 'font-weight': 'bold', 'font-style': 'italic' });
                } else if (style == 'regular') {
                    elements.preview.css({ 'font-weight': 'normal', 'font-style': 'normal' });
                } else if ($.isNumeric(style)) {
                    elements.preview.css({ 'font-weight': style, 'font-style': 'normal' });
                } else {
                    elements.preview.css({ 'font-weight': style.replace('italic', ''), 'font-style': 'italic' });
                }

                //Font Family

                var font = elements.family.val();
                var group = elements.family.find('option:selected').parent().attr('label');

                //get the correct default font-family and font-type (Web Fonts or Google Fonts)
                if (font == 'default') {
                    var default_font_id = '#' + elements.family.find('option:selected').parent().data('default-font-id') + '-family';
                    var font = $(default_font_id).find('option:selected').val();

                    if ($.inArray(font, $.parseJSON(yit_web_fonts).items) != -1) {
                        group = 'Web Fonts';
                    } else {
                        group = 'Google Fonts';
                    }
                }

                if (group == 'Web Fonts') {
                    //Web font
                    elements.preview.css('font-family', font);
                } else {
                    //Google font
                    var WebFontConfig = {

                        google: {
                            families: [ font ]
                        },

                        fontactive: function (fontFamily, fontDescription) {
                            elements.preview.css('font-family', fontFamily);
                        }
                    };

                    (function () {
                        var wf = document.createElement('script');
                        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                        wf.type = 'text/javascript';
                        wf.async = 'true';

                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(wf, s);
                    })();
                }
            });

            //font size, font unit
            $([elements.size, elements.unit]).each(function () {
                $(this).on('change', function () {
                    if (elements.refresh.is(':visible')) {
                        return;
                    }

                    var size = elements.size.val();
                    var unit = elements.unit.val();

                    elements.preview.css({
                        'font-size'  : size + unit,
                        'line-height': ( unit == 'em' || unit == 'rem' ? Number(size) + 0.4 : Number(size) + 4 ) + unit
                    }).trigger('resize');
                });
            });

            //font family
            var family = elements.family;

            family.on('mousedown', function (e) {
                var t = $(this);
                if (t.data('instance') == false) {
                    var currentElement = {
                        'value': t.val(),
                        'text' : t.find('option:selected').text()
                    };

                    t.html(yit_family_string)
                        .find('option')
                        .filter(function () {
                            return $(this).text() == currentElement.text;
                        }).prop('selected', true);

                    t.find('option')
                        .filter(function () {
                            return $(this).text() == "default";
                        }).text(yit_default_name);

                    if (t.parents('.typography_container').data('is-default') == true) {
                        t.find('option')
                            .filter(function () {
                                return $(this).val() == "default";
                            }).remove();
                    }

                    t.data('instance', 'true');
                }
            });

            family.on('change', function (e, is_trigger) {

                var t = $(this);
                var group = t.find('option:selected').parent().attr('label');
                var style_select = t.find('option:selected').parents('.select_wrapper').next().find('select.typography_style');
                var webfonts_variations = 'regular, bold, extra-bold, italic, bold-italic';
                var variations = t.find('option:selected').data('variations');
                var default_font = $(this).val();
                var options = '';

                if (typeof variations === 'undefined') {

                    if (t.attr('value') == 'default') {

                        var default_font_id = '#' + t.data('default-font-id') + '-family';
                        default_font = $(default_font_id).find('option:selected').val();

                        variations = t.find('option[value="' + default_font + '"]').data('variations');

                        if (typeof variations === 'undefined') {
                            variations = webfonts_variations.split(', ');
                        } else {
                            variations = variations.split(',');
                        }

                    } else {
                        variations = webfonts_variations.split(', ');
                    }

                } else {
                    variations = variations.split(',');
                }

                //check if there is a trigger event
                if (!is_trigger) {
                    style_select.prev().empty().append(variations[0]);
                }

                for (var i in variations) {
                    options = options + '<option value="' + variations[i] + '">' + variations[i] + '</option>';
                }

                style_select.empty().append(options);
                style_select.data('first-init', 'true');

                if (elements.refresh.is(':visible')) {
                    return;
                }

                //Preview CSS Style
                if (group == 'Web Fonts') {
                    //Web font
                    elements.preview.css('font-family', default_font );
                } else {
                    //Google font
                    var WebFontConfig = {
                        google    : {
                            families: [ default_font ]
                        },
                        fontactive: function (fontFamily, fontDescription) {
                            elements.preview.css('font-family', fontFamily);
                        }
                    };

                    WebFont.load(WebFontConfig);
                }

                elements.preview.trigger('resize');
            });


            //style
            var style = elements.style;

            style.on('change', function () {
                if (elements.refresh.is(':visible')) {
                    return;
                }

                var style = $(this).val();

                if (style == 'italic') {
                    elements.preview.css({ 'font-weight': 'normal', 'font-style': 'italic' });
                } else if (style == 'bold') {
                    elements.preview.css({ 'font-weight': 'bold', 'font-style': 'normal' });
                } else if (style == 'extra-bold') {
                    elements.preview.css({ 'font-weight': '800', 'font-style': 'normal' });
                } else if (style == 'bold-italic') {
                    elements.preview.css({ 'font-weight': 'bold', 'font-style': 'italic' });
                } else if (style == 'regular') {
                    elements.preview.css({ 'font-weight': 'normal', 'font-style': 'normal' });
                } else if ($.isNumeric(style)) {
                    elements.preview.css({ 'font-weight': style, 'font-style': 'normal' });
                } else {
                    elements.preview.css({ 'font-weight': style.replace('italic', ''), 'font-style': 'italic' });
                }

                elements.preview.trigger('resize');
            });

            style.on('mousedown', function (e) {

                var optgroup = elements.family.has('optgroup').length;

                if (optgroup == 0) {

                    $(elements.family).trigger('mousedown').trigger('change', true);

                } else if (style.data('first-init') == 'false') {

                    $(elements.family).trigger('change', true);
                    style.data('first-init', 'true');
                }
            });

            //preview
            var preview = elements.preview;

            preview.resize(function () {
                var box = $(this).parents('.yit-box');
                $(this).parents('form').height(box.height());
            });

            //transform
            var transform = elements.transform;

            transform.on('change', function (e) {
                if (elements.refresh.is(':visible')) {
                    return;
                }

                elements.preview.css('text-transform', transform.val());
            });

            //align
            var align = elements.align;

            align.on('change', function (e) {
                if (elements.refresh.is(':visible')) {
                    return;
                }

                elements.preview.css('text-align', align.val());
            });
        }
    };

    $.fn.yit_panel_typography = function (options) {
        if (typeof options === 'string') {
            var args = Array.prototype.slice.call(arguments, 1);

            this.each(function () {
                var instance = $.data(this, 'yit_panel_typography');
                if (!instance) {
                    console.error("cannot call methods on yit_checkout prior to initialization; " +
                        "attempted to call method '" + options + "'");
                    return;
                }
                if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
                    console.error("no such method '" + options + "' for yit_panel_typography instance");
                    return;
                }
                instance[ options ].apply(instance, args);
            });
        }
        else {
            this.each(function () {
                var instance = $.data(this, 'yit_panel_typography');
                if (!instance) {
                    $.data(this, 'yit_panel_typography', new $.yit_panel_typography(options, this));
                }
            });
        }
        return this;
    };

})(window, jQuery);
