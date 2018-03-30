<?php 
header("content-type: application/x-javascript");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );

$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
?>
jQuery(document).ready(function(){ 
    <?php
    if(!empty($pp_contact_enable_captcha))
    {
    ?>
    
    // refresh captcha
    $j('img#captcha-refresh').click(function() {  
    		
    		change_captcha();
    });
    
    function change_captcha()
    {
    	document.getElementById('captcha').src="<?php echo get_template_directory_uri(); ?>/get_captcha.php?rnd=" + Math.random();
    }
    
    <?php
    }
    ?>

    $j.validator.setDefaults({
    	submitHandler: function() { 
    		<?php
    		if(!empty($pp_contact_enable_captcha))
    		{
    		?>
    		$j.ajax({
  		    	type: 'GET',
  		    	url: '<?php echo get_template_directory_uri(); ?>/get_captcha.php?check=true',
  		    	data: $j('#contact_form').serialize(),
  		    	success: function(msg){
  		    		if(msg == 'true')
  		    		{
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
  		    		}
  		    		else
  		    		{
  		    			alert(msg);
  		    		}
  		    	}
    	    });
    	    <?php
    		} else {
    		?>
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
    		
    		<?php
    		}
    		?>
    	    
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