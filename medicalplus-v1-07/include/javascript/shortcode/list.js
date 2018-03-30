(function() {  
    tinymce.create('tinymce.plugins.list', {  
        init : function(ed, url) {  
            ed.addButton('list', {  
                title : 'Add List',  
                image : url + '/images/list.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[list type="check"]<br/>\
						<ul>\
						<li>ADD_LIST_CONTENT</li>\
						<li>ADD_LIST_CONTENT</li>\
						</ul>\
						[/list]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('list', tinymce.plugins.list);  
})(); 