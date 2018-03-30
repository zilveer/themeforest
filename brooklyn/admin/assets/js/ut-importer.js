/* <![CDATA[ */
(function($){
	
	"use strict";
		
    $(document).ready(function(){
		
		$("#ut-importer-form").submit(function(e){
			
			if ( !confirm("Are you sure? The import will start immediately") ) {
				e.preventDefault();
				return;
			} 
			
		});
		
	});

})(jQuery);
 /* ]]> */	