(function () {
    if (typeof ctShortcodesList !== 'undefined') {
        tinymce.PluginManager.add('ctShortcode', function (editor, url) {

            editor.addButton('ctShortcode', {
                title: 'Shortcode Generator',
                type: 'menubutton',
                onselect: function (event) {
                    shortcodeMenu.menu.onclick(event.control.settings, event);
                },
                icon: 'ctShortcode',
                menu: ctShortcodesList
            });
        });
    }
})();