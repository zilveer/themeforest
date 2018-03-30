(function() {  
    tinymce.create('tinymce.plugins.social', {  
        init : function(ed, url) {  
            ed.addButton('social', {  
                title : 'Add Social Icon',  
                image : url + '/images/social.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[social type="facebook" opacity="dark"]PLACE_LINK_HERE[/social]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('social', tinymce.plugins.social);  
})(); 