(function() {  
    tinymce.create('tinymce.plugins.column', {  
        init : function(ed, url) {  
            ed.addButton('column', {  
                title : 'Add Column',  
                image : url + '/images/column.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[column col="1/4"]ADD_CONTENT_HERE[/column]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('column', tinymce.plugins.column);  
})(); 