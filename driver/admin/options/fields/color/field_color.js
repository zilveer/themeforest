jQuery(document).ready(function ($) {

	$("input.spectrum").spectrum({
    	showInput: true,
    	showAlpha: true,
    	allowEmpty: true,
    	showButtons: false,
    	preferredFormat: "rgb",
    	move: function(color) {
    	
    		if(color) {
    		
	    		if(color.alpha == 1)
					$(this).val(color.toHexString());
				else
					$(this).val(color.toRgbString());
			}else{
				var defaultColor = $(this).data('default');
				$(this).spectrum("set", defaultColor);
			}
					
		},
    	change: function(color) {
    	
    		if(color) {
    		
	    		if(color.alpha == 1)
					$(this).val(color.toHexString()); 
			}else{
				var defaultColor = $(this).data('default');
				$(this).spectrum("set", defaultColor);
			}		
		}
	});
	
});
