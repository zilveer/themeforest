var shortcode_ed;
(function() {
    tinymce.create('tinymce.plugins.myShorcode', {
        init : function(ed, url) {
		
            if(ed.editorId=='about_block3_text'){
                ed.addButton('myShorcode', {
                    title : 'shorcodes',
                    image : url+'/images/select.png',
                    onclick : function() {
                        shortcode_ed = ed;
                        jQuery( "#dialog-form1" ).dialog( "open" );    
                    }
                });
            }
			
			
			
			
			if(ed.editorId=='my_experience_shortcodes'){
                ed.addButton('myShorcode', {
                    title : 'shorcodes',
                    image : url+'/images/select.png',
                    onclick : function() {
                        shortcode_ed = ed;
                        jQuery( "#dialog-form4" ).dialog( "open" );    
                    }
                });
            }
			if(ed.editorId=='about_shortcodes'){
                ed.addButton('myShorcode', {
                    title : 'shorcodes',
                    image : url+'/images/select.png',
                    onclick : function() {
                        shortcode_ed = ed;
                        jQuery( "#dialog-form5" ).dialog( "open" );    
                    }
                });
            }
			
			//services block1
            if(ed.editorId=='services_block1_shortcodes'){
                ed.addButton('myShorcode', {
                    title : 'shorcodes',
                    image : url+'/images/select.png',
                    onclick : function() {
                        shortcode_ed = ed;
                        jQuery( "#dialog-form7" ).dialog( "open" );    
                    }
                });
            }
			
			//services block2
            if(ed.editorId=='services_block2_shortcodes'){
                ed.addButton('myShorcode', {
                    title : 'shorcodes',
                    image : url+'/images/select.png',
                    onclick : function() {
                        shortcode_ed = ed;
                        jQuery( "#dialog-form6" ).dialog( "open" );    
                    }
                });
            }
			
			//services block3
            if(ed.editorId=='services_block3_shortcodes'){
                ed.addButton('myShorcode', {
                    title : 'shorcodes',
                    image : url+'/images/select.png',
                    onclick : function() {
                        shortcode_ed = ed;
                        jQuery( "#dialog-form3" ).dialog( "open" );    
                    }
                });
            }
			
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('myShorcode', tinymce.plugins.myShorcode);
})();