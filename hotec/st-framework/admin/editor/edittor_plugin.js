
tinymce.PluginManager.add('stshorcode', function(editor, url) {

    // Adds a menu item to the tools menu
    editor.addButton('stshorcode', {
        //text: 'Example plugin',
        context: 'tools',
        icon: true,
        image: url + '/icon.png',
        onclick: function() {
            // Open window with a specific url
            editor.windowManager.open({
                title: 'Shortcodes',
                url:  ajaxurl + '?action=editor_dialog',
                width: 600,
                height: 500,
                buttons: [{
                    text: 'Close',
                    onclick: 'close'
                }]
            });
        }
    });
});

