(function() {  
    tinymce.create('tinymce.plugins.cp_gallery', {  
        init : function(ed, url) {  
            ed.addButton('cp_gallery', {  
                title : 'Add Gallery',  
                image : url + '/images/cp-gallery.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[cp_gallery title="GALLERY_TITLE" width="IMAGE_SRC" height="IMAGE_HEIGHT" ]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('cp_gallery', tinymce.plugins.cp_gallery);  
})(); 