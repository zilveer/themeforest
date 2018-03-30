(function() {  
    tinymce.create('tinymce.plugins.space', {  
        init : function(ed, url) {  
            ed.addButton('space', {  
                title : 'Add Space',  
                image : url + '/images/space.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[space height="HEIGHT"]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    }); 
    tinymce.PluginManager.add('space', tinymce.plugins.space);  
})(); 