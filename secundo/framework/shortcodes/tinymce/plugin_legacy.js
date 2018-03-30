(function () {

    function getSelection() {
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
    }

    tinymce.create('tinymce.plugins.ctShortcode', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */

        init:function (ed, url) {
            var g = this;
            g.url = url;

            ed.addCommand('Shortcode_Generator', function () {
                ed.windowManager.open({
                    id:'wp-link',
                    width:480,
                    height:"auto",
                    wpDialog:true,
                    title:"Shortcode generator"
                }, {
                    plugin_url:url // Plugin absolute URL
                });
            });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl:function (n, cm) {
            var ed = cm.editor;

            if (n == "ctShortcode") {
                var b = cm.createMenuButton('ctShortcodeButton', {
                    title:"Shortcode generator",
                    image:this.url + "/images/icon.png",
                    cmd:'ctShortcodePopup'
                });
                var a = this;

                    a._renderMenu(b, ctShortcodesList);

                // Return the new menubutton instance
                return b;
            }

            return null;
        },
        _renderMenu:function (b, lists) {
            var a = this;

            b.onRenderMenu.add(function (c, m) {
                jQuery.each(lists, function () {
                    a._addMenuItem(m, this);
                });
            });
        },

        _addMenuItem:function (m, item) {
            var a = this;
            if (typeof(item.menu) !== 'undefined') {
                var sub;
                sub = m.addMenu({title:item.text});

                jQuery.each(item.menu, function () {
                    a._addMenuItem(sub, this);
                });
            } else {
                m.add({title:item.text, "class":"mceCtShortcodeMenuItem", onclick:function (event) {
                    if (typeof shortcodeMenu != 'undefined') {
                        shortcodeMenu.menu.onclick(item, event);
                    }
                }});
            }
        }
    });
    tinymce.PluginManager.add('ctShortcode', tinymce.plugins.ctShortcode);
})();