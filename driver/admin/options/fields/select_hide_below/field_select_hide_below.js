/*global jQuery, document*/
jQuery(document).ready(function () {

    jQuery('.redux-opts-select-hide-below').change(function () {
	    
	    var wrap = jQuery(this).closest('.form-table');
	    var options = jQuery('option', this);
        var coption = jQuery('option:selected', this);
		var cvalue = jQuery(this).val();
	
		options.each(function() {
			var value = jQuery(this).val();
		    jQuery(wrap).find('.'+value).closest('tr').hide();
		});	

	        
    	jQuery(wrap).find('.'+cvalue).closest('tr').fadeIn();

    }).change();
});
