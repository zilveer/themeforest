(function() {  
    tinymce.create('tinymce.plugins.frame', {  
        init : function(ed, url) {  
            ed.addButton('frame', {  
                title : 'Add Frame',  
                image : url + '/images/frame.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[frame src="IMAGE_SRC" width="IMAGE_WIDTH" height="IMAGE_HEIGHT" lightbox="on" title="IMAGE_TITLE" align="left" ]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('frame', tinymce.plugins.frame);  
})(); 