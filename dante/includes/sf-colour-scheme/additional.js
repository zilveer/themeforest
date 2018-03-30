/*global $, jQuery, document, tabid:true, redux_opts, confirm, relid:true*/

jQuery(document).ready(function () {

	jQuery("#sf-export-scheme-dl").click(function(e) {

		e.preventDefault(); // prevent link
		
		var the_link = jQuery(this).attr("href");
		
		var file_name = jQuery("#sf-export-scheme-name").val();
		
		if ( file_name ) {
					
			file_name = file_name.replace(/\W/g, ''); // let's attempt to filter this a bit
			
			jQuery("#sf-export-scheme-name").val(file_name); 
			
			the_link = the_link + "&file_name=" + file_name;
			
			window.open(the_link);
			
						
		} else {
			
			alert ("You must enter a scheme name.");
			
		}
		
		//console.log ( file_name );

	});

});
