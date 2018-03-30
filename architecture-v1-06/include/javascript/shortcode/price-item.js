(function() {  
    tinymce.create('tinymce.plugins.price_item', {  
        init : function(ed, url) {  
            ed.addButton('price_item', {  
                title : 'Add Price Item',  
                image : url + '/images/price-item.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[price-item item_number="6" category="PRICE_TABLE_CATEGORY"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('price_item', tinymce.plugins.price_item);  
})(); 