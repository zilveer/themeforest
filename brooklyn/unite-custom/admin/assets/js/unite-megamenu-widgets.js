/* <![CDATA[ */
;(function($){
	
	"use strict";
	
    $(document).ready(function(){
                
        String.prototype.contains = function(substr) {
            return this.indexOf(substr) > -1;
        }
        
        function check_if_valid_widget( $widget ) {
            
            var i = 0;
            
            for (i = 0; i < unite_menu_widgets.widgets.length; i++) {
                
                if( $widget.attr('id').contains( unite_menu_widgets.widgets[i] ) ) {
                    
                    return true;
                    
                }
                
            }
            
            return false;
        
        }        
                
        $('#navigation-widget-area').sortable({

            update: function( evt, ui ) {
                               
                $(this).children().each(function() {
                                            
                    var $widget = $(this);
                    
                    setTimeout( function(){  
                    
                        if( $widget.attr('id') === undefined ) {
                            return;
                        }                    
                        
                        if( !check_if_valid_widget( $widget ) ) {
                            
                            $widget.remove();
                            
                            modal({
                                type: 'info',
                                title: unite_js_translation.info,
                                text: unite_js_translation.widget_message,
                                autoclose: false,
                            });                         
                            
                        }
                    
                    }, 100 );                    
                    
                });
                
            }
        
        });
        
    });
	
})(jQuery);
 /* ]]> */