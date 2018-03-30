/*
 * Method that creates the buttons.
 * 
 * Each button should have the following files:
 * button_name_js.php - javascript
 * button_name.php - popup form
 * button_name.png - 20 x 20 icon
 */
function bfi_tinymce_create_button(buttonName, buttonTitle, hasForm, shortCode, enabledOnSelectionOnly, defaultSelection) {
    
    // creates the plugin
    tinymce.create('tinymce.plugins.'+buttonName, {
        // creates control instances based on the control's id.
        // our button's id is "mygallery_button"
        createControl : function(id, controlManager) {
            if (id == buttonName) {
                // creates the button
                var button = controlManager.createButton(buttonName, {
                    title : buttonTitle,
                    image : bfi_tinymce_url+buttonName+'.png',
                    onclick : function() {
                        // show the form
                        if (hasForm) {
                            // triggers the thickbox
                            var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                            W = W - 80;
                            H = H - 84;
                            
                            tb_show(buttonTitle, '#TB_inline?inlineId='+buttonName+'&width='+W+'&height='+H );
                            
                            // add the selected value
                            if (tinyMCE.activeEditor.selection.getContent() == "") {
                                jQuery('.selection:visible').val(defaultSelection);
                            } else {
                                jQuery('.selection:visible').val(tinyMCE.activeEditor.selection.getContent());
                            }
                        // replace the selected content
                        } else if (/\{\$selection\}/.test(shortCode)) {
                            tinyMCE.activeEditor.execCommand('mceReplaceContent', 0, shortCode);
                        // insert the shortcode
                        } else {
                            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortCode);
                        }
                    }
                });
                return button;
            }
            return null;
        },
        
        // enable the button only when ther's something selected
        init : function(ed, url) {
            ed.onNodeChange.add(function(ed, cm, n) {
                if (enabledOnSelectionOnly) {
                    cm.get(buttonName).setDisabled( ed.selection.isCollapsed() );
                }
            });
        }
    });
    
    // registers the plugin.
    tinymce.PluginManager.add(buttonName, tinymce.plugins[buttonName]);
    
    // executes this when the DOM is ready
    // and only when the button has a modal form
    jQuery(function(){
        if (hasForm) {
            jQuery.get(bfi_tinymce_url+buttonName+'.php', function(data) {
                // need to keep reference to data or else it will get lost
                data = jQuery(data);
                
                // add the form in the page
                jQuery('body').append(data);
                data.hide();
                
                // this table contains all the arguments to be added into the shortcode
                var table = jQuery(data).find('table');
                
                // click handler when the form is submitted
                jQuery(data).find('input.submit').click(function(){
                    
                    resultingShortCode = shortCode;

                    // gether the values from the form to build the resulting shortcode
                    var matches = resultingShortCode.match(/{[^}]+}/g);
                    for (var key in matches) {
                        if (matches[key] == '{$selection}') {
                            continue;
                        }
                        // get the arg name
                        var arg = matches[key].substring(1, matches[key].length-1);
                        // check if there is a $ in the front
                        var putVarName = arg.substr(0, 1) == '$' ? true : false;
                        if (putVarName) {
                            arg = arg.substring(1);
                        }
                        // get and replace the value
                        if (table.find('*[name="'+arg+'"]')) {
                            if (table.find('*[name="'+arg+'"]').val() != '') {
                                if (putVarName) {
                                    resultingShortCode = resultingShortCode.replace(matches[key], ' ' + arg + '="' + table.find('*[name="'+arg+'"]').val().replace(/\"/g, '') + '" ');
                                } else {
                                    resultingShortCode = resultingShortCode.replace(matches[key], table.find('*[name="'+arg+'"]').val());
                                }
                                // empty the field for the next use
                                //table.find('*[name="'+arg+'"]').val('');
                                //table.find('*[name="'+arg+'"]').each(function() { this.value = this.defaultValue; });
                            } else {
                            	if (putVarName) {
                                	resultingShortCode = resultingShortCode.replace(matches[key], '');
                                } else {
                                	resultingShortCode = resultingShortCode.replace(matches[key], ' ');
                                }
                            }
                        } else {
                        	if (putVarName) {
                            	resultingShortCode = resultingShortCode.replace(matches[key], '');
                            } else {
                            	resultingShortCode = resultingShortCode.replace(matches[key], ' ');
                            }
                        }
                    }
                    
                    // reset the input fields to the default values
                    table.find('input, textarea, select').each(function() { this.value = this.defaultValue; });
                    
                    
                    // inserts the shortcode into the active editor
                    if (/\{\$selection\}/.test(resultingShortCode)) {
                        tinyMCE.activeEditor.execCommand('mceReplaceContent', 0, resultingShortCode);
                    } else {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, resultingShortCode);
                    }
                    
                    // closes Thickbox
                    tb_remove();
                });
            });
        }
    });
}