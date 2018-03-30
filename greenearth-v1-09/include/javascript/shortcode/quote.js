(function() {  
    tinymce.create('tinymce.plugins.quote', {  
        init : function(ed, url) {  
            ed.addButton('quote', {  
                title : 'Add Quote',  
                image : url + '/images/quote.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[quote align="center" color="#999999"]ADD_CONTENT_HERE[/quote]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);  
})(); 