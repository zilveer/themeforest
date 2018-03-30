(function() {  
    tinymce.create('tinymce.plugins.button', {  
        init : function(ed, url) {  
            ed.addButton('button', {  
                title : 'Add Button',  
                image : url + '/images/button.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[button color="#COLOR_CODE" background="#COLOR_CODE" size="medium" src="PLACE_LINK_HERE"]ADD_BUTTON_CONTENT[/button]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('button', tinymce.plugins.button);  
})(); 