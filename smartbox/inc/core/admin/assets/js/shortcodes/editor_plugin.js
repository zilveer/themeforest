(function($) {
        // Load plugin specific language pack
        //tinymce.PluginManager.requireLangPack('shortcodes');
        var pluginURL;
        tinymce.create('tinymce.plugins.ShortcodesPlugin', {

                /**
                 * Initializes the plugin, this will be executed after the plugin has been created.
                 * This call is done before the editor instance has finished it's initialization so use the onInit event
                 * of the editor instance to intercept that event.
                 *
                 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
                 * @param {string} url Absolute URL to where the plugin is located.
                 */
                init : function(ed, url) {
                        // store plugin url so we can use it to get the icon in create control
                        pluginURL = url;

                        // Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
                        ed.addCommand('oxyOpenShortcodeDialog', function( ui, dialog ) {
                            ed.windowManager.open({
                                    //file : url + '/dialogs/' + dialog.popup + '?option=' + dialog.code,
                                    file : ajaxurl + '?action=oxy_shortcodes&MCE=true&shortcode=' + dialog.shortcode,
                                    title: dialog.title,
                                    width : $(window).width() - 90,
                                    height : $(window).height() - 90,
                                    inline : 1,
                                    scrollbars : true,
                                    popup_css : false
                            }, {
                                    plugin_url : url, // Plugin absolute URL
                                    title_param : dialog.title
                            });
                        });

                        // Register the insert shortcode command
                        ed.addCommand('oxyInsertShortcode', function( ui, code ) {
                            ed.execCommand('mceInsertContent', false, code );
                            // TODO - would be nice to move cursor here into shortcode ( next version )
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
                    switch( n ) {
                        case 'shortcodes':
                            // create menu button
                            var menuButton = cm.createMenuButton('shortcodes', {
                                title : 'shortcode.desc',
                                image : pluginURL + '/images/theme.png'
                            });
                            // fetch json menu data and build menu
                            var plugin = this;
                            $.getJSON( ajaxurl + '?action=oxy_shortcodes_menu', function( data ) {
                                menuButton.onRenderMenu.add(function(c, m) {
                                    plugin._buildMenu( data, m );
                                });
                            });
                            return menuButton;
                        break;
                    }
                    return null;
                },

                _buildMenu : function( data, menu ) {
                    var plugin = this;
                    $.each( data, function() {
                        var item = this;
                        // if this item has shortcodes then it must be a category
                        if( item.members !== undefined ) {
                            if( item.title !== undefined ) {
                                var submenu = menu.addMenu( { title : item.title } );
                                plugin._buildMenu( item.members, submenu );
                            }
                            else {
                                console.log( item, 'Missing a title' );
                            }
                        }
                        else {
                            // must be a shortcode
                            if( item.shortcode !== undefined ) {
                                switch( item.insert_with ) {
                                    case 'dialog':
                                        menu.add( { title : item.title, onclick : function() {
                                            var dialog = new Object();
                                            dialog.shortcode = item.shortcode;
                                            dialog.title = (item.title == undefined) ? 'Shortcode' : item.title;
                                            tinyMCE.activeEditor.execCommand('oxyOpenShortcodeDialog', false, dialog );
                                        }});
                                    break;
                                    case 'insert':
                                        // just insert code
                                        menu.add( { title : item.title, onclick : function() {
                                            tinyMCE.activeEditor.execCommand('oxyInsertShortcode', false, item.insert );
                                        }});
                                    break;
                                }
                            }
                        }
                    });
                },

                /**
                 * Returns information about the plugin as a name/value array.
                 * The current keys are longname, author, authorurl, infourl and version.
                 *
                 * @return {Object} Name/value array containing information about the plugin.
                 */
                getInfo : function() {
                        return {
                                longname : 'Shortcodes Plugin',
                                author : 'Oxygenna.com',
                                authorurl : 'http://www.oxygenna.com',
                                infourl : '',
                                version : "1.0"
                        };
                }
        });

        // Register plugin
        tinymce.PluginManager.add('shortcodes', tinymce.plugins.ShortcodesPlugin);
})(jQuery);