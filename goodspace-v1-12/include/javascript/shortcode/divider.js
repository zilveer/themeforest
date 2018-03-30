(function() {  
    tinymce.create('tinymce.plugins.divider', {  
        init : function(ed, url) {  
            ed.addButton('divider', {  
                title : 'Add Divider',  
                image : url + '/images/divider.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[divider scroll_text="SCROLL_TEXT"]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('divider', tinymce.plugins.divider);  
})(); 