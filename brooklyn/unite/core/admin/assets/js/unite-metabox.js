/* <![CDATA[ */

jQuery.noConflict();

;(function($){
	
	"use strict";
	
    $(document).ready(function(){
        
        function disable_copy_fields() {
            
            $('.ut-to-copy').each(function() {
                
               var $this = $(this);
               
               $this.find('.ut-option-element').prop('disabled', true);
                
            });
        
        }
        
        $('#post').submit( function(){
            
            /* disable copy fields */
            disable_copy_fields();
            
        });        
    
    });
	
})(jQuery);
 /* ]]> */