var dialog;
(function ($) {
    var api, s, previewed = false, focusItem = null;

    // Initialize the shortcode/api object
    dialog = api = {};
    api.settings = {
        type:'enclosing',
        select:true,
        contentOption:'content',
        content:''
    };
    api.init = function (options) {
        s = api.settings = $.extend({}, api.settings, options);
        var win = window.dialogArguments || opener || parent || top;
        win.tb_showIframe();

        if (s.type != 'self-closing' && s.select == true && win.shortcodeMenu) {
            api.settings.content = win.shortcodeMenu.editor.getSelection();
        }

        api.button.init();
        if (typeof s.init != 'undefined') {
            s.init.call(this);
        }
    };

    // theme options init functions
    api.button = {};
    api.button.init = function () {
        api.button.cancel();
        api.button.insert();
        api.button.preview();
    };
    api.button.cancel = function () {
        $("#theme-button-cancel").click(function () {
            var win = window.dialogArguments || opener || parent || top;
            win.tb_remove();
        });
    };
    api.button.insert = function () {
        $("#theme-button-insert").click(function () {
            var win = window.dialogArguments || opener || parent || top;
            win.tb_remove();
            win.shortcodeMenu.editor.insertContent(api.generateShortcode());
        });

    };

    api.button.preview = function () {
        $("#theme-button-preview").click(function () {
            var $e = $(this);
            var d = $('#theme-dialog-preview').addClass('loading').show();
            var c = $('#theme-dialog').hide();

            if ($e.val() == 'Preview') {
                $('#theme-button-preview').val("Exit preview");
                var url = ajaxurl + '?action=theme-shortcode-preview';
                $.post(url, {'shortcode':api.generateShortcode().trim()}, function () {
                    d.html('<iframe id="shortcodeFrame" data-shortcode="test" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" height="10" style="width: 100%" src="' + url + '"></iframe>');
                });
            } else {
                d.fadeOut('fast').html('');
                c.fadeIn('fast');
                $e.val("Preview");
            }
        });

    };

    api.cleanupName = function (name) {
        return name.replace('[]', '');
    }

    api.generateShortcode = function () {
        if (e = jQuery('#shortcode').val()) {
            return e;
        }

        var r = '';
        //break only when nested
        var br = '';
        var complexParent = $('.form-table.parent').length > 0;

        //foreach shortcode
        $('.form-table').each(function () {
            var options = [];
            var content = api.getContent();
            $(".form-field", $(this)).each(function () {
                var type = $(this).find('[data-type]').attr("data-type");

                if (type in api.option) {
                    var object = api.option[type](this);

                    if (type != 'textarea') {
                        if (object.value != object.def) {
                            options[api.cleanupName(object.name)] = object;
                        }
                    } else {
                        content = object.value;
                        s.type = 'enclosing'; //to wrap other parameters
                    }
                }
            });

            code = s.shortcode;
            type = s.type;

            if (complexParent && jQuery(this).hasClass('parent')) {
                type = 'self-closing';
                code = s.parent;
            }

            switch (type) {
                case 'self-closing':
                    r += br + '[' + code + api.builtAttributesChain(options) + ']';
                    break;
                case 'enclosing':
                    r += br + '[' + code + api.builtAttributesChain(options) + ']' + content + '[/' + code + '] ';
                    break;
                case 'both':
                    if (api.getContent() == '') {
                        r += br + '[' + code + api.builtAttributesChain(options) + '] ';
                        break;
                    } else {
                        r += br + '[' + code + api.builtAttributesChain(options) + ']' + content + '[/' + code + '] ';
                        break
                    }
                case 'custom':
                    r += s.custom.call(this, options);
                    break;
            }
        });

        if (s.parent != '') {
            r = (complexParent ? '' : '[' + s.parent + "]") + r + br + "[/" + s.parent + "]";
        }
        return r;
    };

    api.getAttributesArray = function (options) {
        var attributes = [];
        if (s.attributes != undefined) {
            attributes.push(s.attributes);
        }
        for (x in options) {
            if (options[x].name != s.contentOption) {
                if (options[x].type == 'upload') {
                    var upload_objects = jQuery.parseJSON(options[x].value);
                    for (y in upload_objects) {
                        attributes.push(options[x].name + '_' + y + '="' + upload_objects[y] + '"');
                    }
                } else if (options[x].attributeText != undefined) {
                    attributes.push(api.cleanupName(options[x].attributeText));
                }
            }
        }
        return attributes;
    };
    api.builtAttributesChain = function (options) {
        attributes = api.getAttributesArray(options);

        if (attributes.length > 0) {
            return ' ' + attributes.join(' ');
        } else {
            return '';
        }
    };

    api.getContent = function () {
        return api.settings.content;
    };

    api.option = {};
    api.option.text = function (item) {
        return api.option.getObject(item, 'input', 'text');
    };

    api.option.textarea = function (item) {
        return api.option.getObject(item, 'textarea', 'textarea');
    };

    api.option.select = function (item) {
        return api.option.getObject(item, 'select', 'select');
    };

    api.option.checkbox = function (item) {
        return api.option.getObject(item, 'input', 'checkbox');
    }

    api.option.upload = function (item) {
        return api.option.getObject(item, 'input', 'upload');
    };

    api.option.custom = function (item) {
        return api.option.getObject(item, 'input:hidden');
    };

    api.option.getObject = function (item, selector, type) {
        var object = {};
        var target = $(item).find(selector);
        if (type != null) {
            object.type = type;
        }
        object.name = target.attr('name');
        object.def = api.option.getDefault(target);
        object.value = target.val();

        if (type == 'checkbox') {
            object.value = target.is(':checked') + "";
        }

        //_arg name indicates that we do not use name, these are direct params only
        if (object.name.indexOf('_arg') == 0) {
            object.attributeText = object.value;
        } else if (object.def != object.value) {
            object.attributeText = object.name + '="' + object.value + '"';
        }

        return object;
    };

    api.option.getDefault = function (item) {
        return $(item).attr('data-default');
    };
})(jQuery);
