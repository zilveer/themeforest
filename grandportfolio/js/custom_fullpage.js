jQuery(document).ready(function() {
    jQuery('#fullpage').fullpage({
	    'navigation': true,
	    'touchSensitivity': 30,
	    
	    afterLoad: function(){
		    jQuery('#fullpage').addClass('visible');
	    }
    });
});