(function() {  
    tinymce.create('tinymce.plugins.gdl_gallery', {  
        init : function(ed, url) {  
            ed.addButton('gdl_gallery', {  
                title : 'Add Gallery',  
                image : url + '/images/gdl-gallery.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[gdl_gallery title="GALLERY_TITLE" width="IMAGE_SRC" height="IMAGE_HEIGHT" ]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('gdl_gallery', tinymce.plugins.gdl_gallery);  
})(); 