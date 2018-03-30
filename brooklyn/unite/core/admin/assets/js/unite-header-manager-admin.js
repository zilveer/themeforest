/* <![CDATA[ */
(function($){
	
	"use strict";
		
    $(document).ready(function(){
    
        
        $('.unite-header-section-setting').on('click', function( event ) {
            
            Custombox.open({
                target: $(this).attr('href'),
                effect: 'fadein'
            });
            
            event.preventDefault();
            
        });
        
        
        
        
        
                
    
    });

})(jQuery);
 /* ]]> */