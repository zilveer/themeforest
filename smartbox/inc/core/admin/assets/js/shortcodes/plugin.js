'use strict';
/**
 * plugin.js tinymce 4 shortcode generator menu
 *
 * Copyright, Oxygenna.com
 *
 */

/*global tinymce:true,ajaxurl:true,jQuery:true */

(function($) {
    tinymce.PluginManager.add('shortcodes', function(editor, url) {
        editor.addButton('shortcodes', {
            icon: 'oxy_shortcodes',
            tooltip: 'Theme Shortcodes',
            type: 'menubutton',
            onPostRender: function() {
                var ctrl = this;
                $.getJSON( ajaxurl + '?action=oxy_shortcodes_menu', function( menuData ) {
                    var menu = buildMenu( menuData );
                    ctrl.state.data.menu = ctrl.settings.menu = menu;
                    // Add a button that opens a window
                });
            }
        });

        // Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
        editor.addCommand('oxyOpenShortcodeDialog', function( ui, dialog ) {
            editor.windowManager.open({
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
        editor.addCommand('oxyInsertShortcode', function( ui, code ) {
            editor.execCommand('mceInsertContent', false, code );
            // TODO - would be nice to move cursor here into shortcode ( next version )
        });

        function buildMenu( data ) {
            var menu = [];
            $.each( data, function( index, item ) {
                // are we a leaf item?
                if( item.members === undefined ) {
                    switch( item.insert_with ) {
                        case 'dialog':
                            menu.push({
                                text : item.title,
                                onclick : function() {
                                    var dialog = {};
                                    dialog.shortcode = item.shortcode;
                                    dialog.title = (item.title === undefined) ? 'Shortcode' : item.title;
                                    tinymce.activeEditor.execCommand( 'oxyOpenShortcodeDialog', false, dialog );
                                }
                            });
                        break;
                        case 'insert':
                            // just insert code
                            menu.push({
                                text : item.title,
                                onclick : function() {
                                    tinymce.activeEditor.execCommand( 'oxyInsertShortcode', false, item.insert );
                                }
                            });
                        break;
                    }
                }
                else {
                    menu.push({
                        text: item.title,
                        menu: buildMenu( item.members )
                    });
                }
            });
            return menu;
        }
    });
})(jQuery);
