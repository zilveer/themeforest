(function() {  
    tinymce.create('tinymce.plugins.testimonial', {  
        init : function(ed, url) {  
            ed.addButton('testimonial', {  
                title : 'Add Testimonial',  
                image : url + '/images/testimonial.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[testimonial category="TESTIMONIAL_CATEGORY" size="1/1" type="static"]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('testimonial', tinymce.plugins.testimonial);  
})(); 