jQuery.noConflict();
jQuery(document).ready(function($) { 

/*-----------------------------------------------------------------------------------*/
/*  Minified for performance. Commented and unminified content included in the download.
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Navigation
/*-----------------------------------------------------------------------------------*/

jQuery("nav ul").superfish({
    delay: 1500,
    animation: {
        opacity: "show",
        height: "show"
    },
    speed: "fast",
    autoArrows: false,
    dropShadows: false
});

/*-----------------------------------------------------------------------------------*/
/*  Contact Validation
/*-----------------------------------------------------------------------------------*/
if (jQuery().validate) {
    jQuery("#contact-form").validate()
}

/*-----------------------------------------------------------------------------------*/
/*  Placeholder fix
/*-----------------------------------------------------------------------------------*/

jQuery(function() {
    jQuery(".wp-email-capture-name").attr("value", function() { 
        return "Your Name"; 
    });
    jQuery('.wp-email-capture-name').focus(function() {
        if (jQuery(this).val() == 'Your Name')
            jQuery(this).val('');
    });
 
    jQuery('.wp-email-capture-name').blur(function() {
        if(jQuery(this).val() == '')
            jQuery(this).val('Your Name');
    });
    jQuery(".wp-email-capture-email").attr("value", function() { 
        return "Email Address"; 
    });
    jQuery('.wp-email-capture-email').focus(function() {
        if (jQuery(this).val() == 'Email Address')
            jQuery(this).val('');
    });
 
    jQuery('.wp-email-capture-email').blur(function() {
        if(jQuery(this).val() == '')
            jQuery(this).val('Email Address');
    });
});

//jQuery('#BP img.avatar').wrap('<span class="image-wrap " style="width: auto; height: auto;" />');
//jQuery('.image-wrap').wrap('<div class="cutout" />');



/*-----------------------------------------------------------------------------------*/
/*  Toggle
/*-----------------------------------------------------------------------------------*/

jQuery(".toggle").each(function () {
    if (jQuery(this).attr("data-icy-toggle") == "open") {
        jQuery(this).accordion({
            collapsible: true
        })
    } else {
        jQuery(this).accordion({
            active: false,
            collapsible: true
        })
    }
});

/*-----------------------------------------------------------------------------------*/
/*  Tabs
/*-----------------------------------------------------------------------------------*/

jQuery(".tabs").tabs({
    fx: {
        opacity: "show",
        duration: 50
    }
});


jQuery("#tabs").tabs({
    fx: {
        opacity: "show",
        duration: 50
    }
});

/*-----------------------------------------------------------------------------------*/
/*  Opacity changes
/*-----------------------------------------------------------------------------------*/

  jQuery(".wp-post-image, .avatar").hover(function() { jQuery(this).animate({ opacity: 0.7 }, 200); }
  ,function () { jQuery(this).animate({ opacity: 1 }, 200); });


});

