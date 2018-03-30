(function() {  
    tinymce.create('tinymce.plugins.dropcap', {  
        init : function(ed, url) {  
            ed.addButton('dropcap', {  
                title : 'Add Dropcap',  
                image : url + '/images/dropcap.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[dropcap type="circle" color="#COLOR_CODE" background="#COLOR_CODE"]ADD_CONTENT_HERE[/dropcap]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);  
})(); 