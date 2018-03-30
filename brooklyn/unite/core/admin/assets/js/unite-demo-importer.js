/* <![CDATA[ */
;(function($){
	
	"use strict";
    
    $(document).ready(function(){
                
        $('#ut-demo-importer').submit( function( event ){
                        
            $('#ut-start-importer').prop( 'disabled', true );
            $('#ut-start-importer').find('span').text( $('#ut-start-importer').data('loading') );        
            $('#ut-start-importer').find('i').show();
            
        });   
            
    });
	
})(jQuery);
 /* ]]> */