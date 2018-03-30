/* <![CDATA[ */
(function($){
	
	"use strict";
		
    $(document).ready(function(){
		
		$('.ut-page-type.section').each(function() {
            
            $(this).parent().parent('.type-page').addClass('ut-is-section');
            
        });
		
	});

})(jQuery);
 /* ]]> */	