/* <![CDATA[ */
(function($){
	
	"use strict";
		
    $(document).ready(function(){
		
		$("#ut-importer-export-form").submit(function(e){
			
			if ( !confirm( unite_importer.message ) ) {
				e.preventDefault();
				return;
			} 
			
		});
		
	});

})(jQuery);
 /* ]]> */