//TinyMCE Button
(function($) {

    var image_url = yit_shortcode.tinymce_yit_shortcodes_icon;

    tinymce.create('tinymce.plugins.YIT_Shortcode', {
        init : function(ed, url) {
            if( image_url == '' || image_url == null ) url=url+'/../images/icon_shortcodes.png';
            else  url = image_url;
            ed.addButton('yitshortcodes', {
                title : 'Add Shortcodes',
                image : url,
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