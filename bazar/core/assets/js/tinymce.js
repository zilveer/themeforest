//TinyMCE Button
(function($) {
    tinymce.create('tinymce.plugins.YIT_Shortcode', {
        init : function(ed, url) {
            ed.addButton('yitshortcodes', {
                title : 'Add Shortcodes',
                image : url+'/../images/tinymce/icon_shortcodes.png',
                onclick : function() {
                        $('#add_shortcode').click();
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "YIT Add Shortocdes",
                author : 'YIT',
                authorurl : 'http://yithemes.com/',
                infourl : 'http://yithemes.com/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('yitshortcodes', tinymce.plugins.YIT_Shortcode);
})(jQuery);