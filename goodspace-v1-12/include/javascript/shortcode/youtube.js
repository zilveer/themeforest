(function() {  
    tinymce.create('tinymce.plugins.youtube', {  
        init : function(ed, url) {  
            ed.addButton('youtube', {  
                title : 'Add Youtube',  
                image : url + '/images/youtube.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[youtube height="HEIGHT" width="WIDTH"]PLACE_LINK_HERE[/youtube]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('youtube', tinymce.plugins.youtube);  
})(); 