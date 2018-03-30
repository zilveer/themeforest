(function() {  
    tinymce.create('tinymce.plugins.tab', {  
        init : function(ed, url) {  
            ed.addButton('tab', {  
                title : 'Add Tab',  
                image : url + '/images/tab.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[tab]<br/>\
						[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br/>\
						[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br/>\
						[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br/>\
						[/tab]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('tab', tinymce.plugins.tab);  
})(); 