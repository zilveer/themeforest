/*-----------------------------------------------------------------------------------*/
/* Contact Widget
/*-----------------------------------------------------------------------------------*/
				
 jQuery(document).ready(function() {
 
 jQuery('#subForm input#Subject').each(function(i){

        jQuery(this).focus(function(){

            if (jQuery(this).val() == 'Subject'){

                jQuery(this).val('');

            }

        });

        jQuery(this).blur(function(){

            if (jQuery(this).val() == '' || jQuery(this).val() == ' '){

                jQuery(this).val('Subject');

            }

        });

    }); //Contact Widget Name

    

    jQuery('#subForm input#Email').each(function(i){

        jQuery(this).focus(function(){

            if (jQuery(this).val() == 'Email'){

                jQuery(this).val('');

            }

        });

        jQuery(this).blur(function(){

            if (jQuery(this).val() == '' || jQuery(this).val() == ' '){

                jQuery(this).val('Email');

            }

        });

    }); //Contact Widget Email

    

    jQuery('#subForm textarea#Message').each(function(i){

        jQuery(this).focus(function(){

            if (jQuery(this).val() == 'Quick Message'){

                jQuery(this).val('');

            }

        });

        jQuery(this).blur(function(){

            if (jQuery(this).val() == '' || jQuery(this).val() == ' '){

                jQuery(this).val('Quick Message');

            }

        });

    }); //Contact Widget Message
});