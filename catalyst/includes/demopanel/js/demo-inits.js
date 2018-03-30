jQuery(document).ready(function(){
	jQuery('#demopanel .closedemo').click(function() {

		 jQuery('#demopanel .closedemo').css('display', 'none');
		 jQuery('#demopanel .opendemo').css('display', 'block');
		 jQuery('#demopanel').stop().animate({opacity: 1, left: '-130'}, 250 );
	});
	jQuery('#demopanel .opendemo').click(function() {

		 jQuery('#demopanel .closedemo').css('display', 'block');
		 jQuery('#demopanel .opendemo').css('display', 'none');
		 jQuery('#demopanel').stop().animate({opacity: 1, left: '0'}, 250 );
	});
	
	
	if ( (jQuery.cookie('themeBG') != null))	{
		jQuery('body').attr("style",jQuery.cookie('themeBG'));
	}
	
    jQuery('a.demo_pattern').click( function() {
        var divId = jQuery(this).attr('id');
		divId=divId.replace('-', '.');
		jQuery("body").removeAttr("style").attr("style","background-image:url(<?php bloginfo('stylesheet_directory'); ?>/images/backgrounds/" + divId + ");");
		jQuery.cookie('themeBG',"background-image:url(<?php bloginfo('stylesheet_directory'); ?>/images/backgrounds/" + divId + ")",{ expires: 7, path: '/'});
	  	return false;
    });
	
	jQuery("#patterndelete").click(function(){
		jQuery.cookie('themeBG',null,{expires: 7, path: '/'});
        return false;
	});

	
});