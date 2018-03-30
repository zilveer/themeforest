(function() {
    tinymce.create('tinymce.plugins.buttonPlugin', {
        init : function(ed, url) {
            ed.addCommand('mcebutton', function() {
                ed.windowManager.open({
                    file : AdminSettings.template_path + '/includes/shortcodes/generator.php',
                    width : 550,
                    height : 400,
                    inline : 1
                }, {
                    plugin_url : AdminSettings.template_path + '/includes/shortcodes'
                });
            });
 
            // Register buttons
            ed.addButton('uxbarn_home_shortcode_generator_button', {title : 'UXbarn Shortcode Generator', cmd : 'mcebutton', image: AdminSettings.image_path + '/admin/uxbarn-admin-s.jpg' });
        },
 
        getInfo : function() {
            return {
                longname : 'UXbarn Shortcode Generator',
                author : 'UXbarn',
                authorurl : 'http://themeforest.net/user/UXbarn?ref=UXbarn',
                infourl : 'http://themeforest.net/user/UXbarn?ref=UXbarn',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });
 
    // Register plugin
    // first parameter is the button ID and must match ID elsewhere
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('uxbarn_home_shortcode_generator_button', tinymce.plugins.buttonPlugin);
 
})();