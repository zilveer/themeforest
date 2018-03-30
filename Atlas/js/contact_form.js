jQuery(document).ready(function(){ 
    jQuery.validator.setDefaults({
    	submitHandler: function() { 
    		var actionUrl = jQuery('#contact_form').attr('action');
    	    var contactData = jQuery('#contact_form').serialize();
    	    
    	    jQuery.ajax({
  		        type: 'POST',
  		        url: tgAjax.ajaxurl,
  		        data: contactData+'&tg_security='+tgAjax.ajax_nonce,
  		        success: function(msg){
  		        	jQuery('#contact_form').hide();
  		        	jQuery('#reponse_msg').html('<br/>'+msg);
  		        }
    	    });
    	    
    	    return false;
    	}
    });    
    	
    jQuery('#contact_form').validate({
    	rules: {
    	    your_name: "required",
    	    email: {
    	    	required: true,
    	    	email: true
    	    },
    	    message: "required"
    	},
    	messages: {
    	    your_name: "Please enter your name",
    	    email: "Please enter a valid email address",
    	    message: "Please enter some message"
    	}
    });
});