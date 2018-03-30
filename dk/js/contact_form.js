$j(document).ready(function(){ 

    $j.validator.setDefaults({
    	submitHandler: function() { 
    		var actionUrl = $j('#contact_form').attr('action');
    		var contactData = jQuery('#contact_form').serialize();
    	    
    	    $j.ajax({
  		        type: 'POST',
  		        url: tgAjax.ajaxurl,
  		        data: contactData+'&tg_security='+tgAjax.ajax_nonce,
  		        success: function(msg){
  		        	$j('#contact_form').hide();
  		        	$j('#reponse_msg').html('<br/>'+msg);
  		        }
    	    });
    	    
    	    return false;
    	}
    });    
    	
    $j('#contact_form').validate({
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