jQuery(document).ready(function($){
    tinyMCE.create(
        "tinymce.plugins.TFUSE_Shortcodes",
        {
            init: function(d,e) {
                d.addCommand( "TF_Open_Modal_Dialog",function(a,c){							
                    // Grab the selected text from the content editor.
                    selectedText = '';						
                    if ( d.selection.getContent().length > 0 ) {						
                        selectedText = d.selection.getContent();								
                    }
                    tf_shortcode_dialog(selectedText);						 
                });
						
            },
					
            createControl:function(d,e){
                if(d=="tf_shortcodes_button"){
                    d=e.createMenuButton("tf_shortcodes_button",{
                        title:"Insert TFuse Shortcode",
                        image:tf_script.shortcode_button_icon,
                        icons:false,
                        onclick:function(){
                            current_shortcode_editor='tinymce';
                            tinyMCE.activeEditor.execCommand("TF_Open_Modal_Dialog",false);
                        }
                    });								
                    return d
						
                } // End IF Statement
						
                return null
            },
		
            addImmediate:function(d,e,a){
                d.add({
                    title:e,
                    onclick:function(){
                        tinyMCE.activeEditor.execCommand("mceInsertContent",false,a)
                    }
                });
            },
				
            getInfo:function(){
                return{
                    longname:"TFuse Shortcode Generator",
                    author:"ThemeFuse.com",
                    authorurl:"http://themefuse.com",
                    infourl:"http://themefuse.com",
                    version:"1.0"
                }
            }
        }
        );		
    tinymce.PluginManager.add("TFUSE_Shortcodes",tinymce.plugins.TFUSE_Shortcodes);
   
/* End tinyMCE settings */

});