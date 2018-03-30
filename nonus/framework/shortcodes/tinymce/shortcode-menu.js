var shortcodeMenu;

(function ($) {
    var api, s;

    // Initialize the shortcode/api object
    shortcodeMenu = api = {};

    api.init = function (options) {
        s = api.settings = $.extend({}, api.settings, options);

        if ($("#ed_toolbar,.quicktags-toolbar").length == 0) {
            return;
        }

        if (typeof(QTags) != 'undefined' && QTags.addButton) {
            var $menu = null;
            QTags.addButton('theme_shortcode', s.langs.shortcodes, function (e) {
                if (!$menu) {
                    $menu = $(e).buttonMenu({
                        item: {
                            click: api.menu.onclick
                        },
                        data: ctShortcodesList
                    });
                    $(e).trigger('click');
                }
            });
        }
        api.loadMenuData();

    };
    api.loadMenuData = function () {

        $("#wp2_fs_shortcode,#wp_fs_shortcode").buttonMenu({
            item: {
                click: api.menu.onclick
            },
            data: ctShortcodesList,
            beforeShow: function () {
                $("#fullscreen-topbar").unbind('mouseleave');
                clearTimeout(fullscreen.settings.timer);
                fullscreen.settings.timer = 0;
            },
            afterHide: function () {
                $("#fullscreen-topbar").bind('mouseleave', function (e) {
                    fullscreen.settings.toolbars.removeClass('fullscreen-make-sticky');
                    if (fullscreen.settings.visible) {
                        $(document).bind('mousemove.fullscreen', function (e) {
                            fullscreen.bounder('showToolbar', 'hideToolbar', 2000, e);
                        });
                    }
                }).trigger('mouseleave');
                $(document).trigger('mousemove.fullscreen');
            }
        });
    }

    api.menu = {};
    api.menu.onclick = function (item, event) {
        if (typeof item.action != undefined && item.action in api.menu.operate) {
            api.menu.operate[item.action](item);
        }
    };
    // item operate
    api.menu.operate = {};
    api.menu.operate.insert = function (item) {
        var $selection = api.editor.getSelection();
        if ($selection == '') {
            $selection = ' ';
        }
        api.editor.insertContent(item.code.replace('(*)', $selection));
    };
    api.menu.operate.popup = function (item) {
        var title = 'Insert ' + item.name + ' Shortcode';
        var url = ajaxurl + '?action=theme-shortcode-popup&id=' + item.id;
        if (api.editor.getSelection().length > 0) {
            url += '&select=1';
        }
        tb_show(title, url + '&TB_iframe=1');
        ct_tb_position();
    };
    api.menu.operate.custom = function (item) {
        item.func.call(this, item);
    };

    // editor
    api.editor = {};
    api.editor.insertContent = function (code) {
        var ed;

        if (typeof tinyMCE != 'undefined' && (ed = tinyMCE.activeEditor) && !ed.isHidden()) {
            // restore caret position on IE
            if (tinymce.isIE && ed.windowManager.insertimagebookmark) {
                ed.selection.moveToBookmark(ed.windowManager.insertimagebookmark);
            }

            ed.execCommand('mceInsertContent', false, code);

        } else if (typeof edInsertContent == 'function') {
            edInsertContent(edCanvas, code);
        } else {
            jQuery(edCanvas).val(jQuery(edCanvas).val() + code);
        }
    };
    api.editor.getSelection = function () {
        var ed, selectedText = '';
        if (typeof tinyMCE != 'undefined' && (ed = tinyMCE.activeEditor) && !ed.isHidden()) {
            if (ed.selection.getContent().length > 0) {
                selectedText = ed.selection.getContent();
            }
        } else {
            if (typeof edCanvas != 'undefined') {
                if (document.selection) {
                    edCanvas.focus();
                    sel = document.selection.createRange();
                    if (sel.text.length > 0) {
                        selectedText = sel.text;
                    }
                } else if (edCanvas.selectionStart || edCanvas.selectionStart == '0') {
                    startPos = edCanvas.selectionStart;
                    endPos = edCanvas.selectionEnd;
                    if (startPos != endPos) {
                        selectedText = edCanvas.value.substring(startPos, endPos);
                    }
                }
            }
        }
        return selectedText;
    };
})(jQuery);

jQuery(document).ready(function () {
    jQuery(window).resize(function () {
        ct_tb_position();
    });
});
// thickbox settings
var ct_tb_position;
(function ($) {
    ct_tb_position = function () {
        var tbWindow = $('#TB_window'), width = $(window).width(), H = $(window).height(), W = ( 890 < width ) ? 890 : width, adminbar_height = 0;

        if ($('body.admin-bar').length)
            adminbar_height = 28;

        if (tbWindow.size()) {
            tbWindow.width(W - 50).height(H - 45 - adminbar_height);
            $('#TB_iframeContent').width(W - 50).height(H - 75 - adminbar_height);
            tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2), 10) + 'px'});
            if (typeof document.body.style.maxWidth != 'undefined')
                tbWindow.css({'top': 20 + adminbar_height + 'px', 'margin-top': '0'});
        }
        ;

        return $('a.thickbox').each(function () {
            var href = $(this).attr('href');
            if (!href) return;
            href = href.replace(/&width=[0-9]+/g, '');
            href = href.replace(/&height=[0-9]+/g, '');
            $(this).attr('href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 - adminbar_height ));
        });
    };
})(jQuery);
