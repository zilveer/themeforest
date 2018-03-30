(function() {  
    tinymce.create('tinymce.plugins.toggle_box', {  
        init : function(ed, url) {  
            ed.addButton('toggle_box', {  
                title : 'Add Toggle Box',  
                image : url + '/images/toggle-box.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[toggle_box]<br/>\
						[toggle_item title="ITEM_TITLE" active="true"]ADD_CONTENT_HERE[/toggle_item]<br/>\
						[toggle_item title="ITEM_TITLE" active="true"]ADD_CONTENT_HERE[/toggle_item]<br/>\
						[/toggle_box]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('toggle_box', tinymce.plugins.toggle_box);  
})(); 