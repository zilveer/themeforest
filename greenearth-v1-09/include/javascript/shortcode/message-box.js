(function() {  
    tinymce.create('tinymce.plugins.message_box', {  
        init : function(ed, url) {  
            ed.addButton('message_box', {  
                title : 'Add Message Box',  
                image : url + '/images/message-box.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[message_box title="MESSAGE TITLE" color="red"]ADD_CONTENT_HERE[/message_box]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('message_box', tinymce.plugins.message_box);  
})(); 