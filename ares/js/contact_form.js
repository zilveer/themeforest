$j(document).ready(function(){ 
	var contactData = jQuery('#contact_form').serialize();

    $j.validator.setDefaults({
    	submitHandler: function() { 
    		var actionUrl = $j('#contact_form').attr('action');
    	    
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
    	    your_name: "<?php echo _e( 'Please enter your name', THEMEDOMAIN ); ?>",
    	    email: "<?php echo _e( 'Please enter a valid email address', THEMEDOMAIN ); ?>",
    	    message: "<?php echo _e( 'Please enter some message', THEMEDOMAIN ); ?>"
    	}
    });
});