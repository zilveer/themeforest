(function() {
    tinymce.create('tinymce.plugins.WPTuts', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {

            ed.addCommand('list', function() {
                var icon_class = prompt("Type here the list type: primary-list or default-list: ");
                var color = prompt("Type here the list color (ex: #f1c40f): ");
                var count = prompt("Type here the number of list elements: ");
                var shortcode = '';
                shortcode = '[clx_list type="' + icon_class + '" color="' + color + '"]';
                ed.execCommand('mceInsertContent', 0, shortcode);
                for (i = 0; i < count; i++) {
                    j = i+1;
                    alert("Element number: " + j);
                    var element = prompt("Type here the element name: ");
                    var link = prompt("Type here the link: ");
                    var icon = prompt("Type here the icon (ex: fa-check): ");
                    var listitem = '';
                    listitem = '[clx_list_item element="' + element + '" link="' + link + '" icon="' + icon + '" /]';
                    ed.execCommand('mceInsertContent', 0, listitem);
                }
                var shortcode2 = '';
                    shortcode2 = '[/clx_list]';
                    ed.execCommand('mceInsertContent', 0, shortcode2);

            });

            ed.addButton('list', {
                title : 'Add List shortcode',
                cmd : 'list',
                image : url + '/list.png'
            });



            ed.addCommand('dropcap', function() {
                var selected_text = ed.selection.getContent();
                return_text = '[clx_drc]' + selected_text + '[/clx_drc]';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

            ed.addButton('dropcap', {
                title : 'Add dropcap shortcode.',
                cmd : 'dropcap',
                image : url + '/dropcap.png'
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
        createControl : function(n, cm) {
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
                longname : 'WPTuts Buttons',
                author : 'Lee',
                authorurl : 'http://wp.tutsplus.com/author/leepham',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('wptuts', tinymce.plugins.WPTuts);
})();