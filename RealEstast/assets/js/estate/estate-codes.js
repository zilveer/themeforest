(function() {
    tinymce.create('tinymce.plugins.realestast', {
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
        url : '',
        init : function(ed, url) {
            this.url = url;
            ed.addCommand('dropcap', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '<span class="dropcap">' + selected_text + '</span>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
        },
        createControl : function(n, cm) {
            switch( n ) {
                case 'realcodes':
                    var c = cm.createSplitButton('realestast', {
                        title : 'Theme Shortcode',
                        image: this.url+'/img/realcodes.png',
                        onclick: function(){
                        }
                    });
                    c.onRenderMenu.add(function(c, m) {
                        m.add({
                            title: 'Dropcap',
                            icon: 'table',
                            cmd: 'dropcap'
                        });
                    });
                    return c;
            }
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'RealEstast Buttons',
                author : 'Ahn',
                authorurl : 'http://pixelgeeklab.com/author/ahn',
                infourl : 'http://pixelgeeklab.com/author/ahn',
                version : "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add( 'realestast', tinymce.plugins.realestast );
})();