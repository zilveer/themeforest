(function() {  
    tinymce.create('tinymce.plugins.vimeo', {  
        init : function(ed, url) {  
            ed.addButton('vimeo', {  
                title : 'Add Vimeo',  
                image : url + '/images/vimeo.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[vimeo height="HEIGHT" width="WIDTH"]PLACE_LINK_HERE[/vimeo]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('vimeo', tinymce.plugins.vimeo);  
})(); 