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
        var divId = $(this).attr('id');
		divId=divId.replace('-', '.');
		jQuery("body").removeAttr("style").attr("style","background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/backgrounds/" + divId + ");");
		jQuery.cookie('themeBG',"background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/backgrounds/" + divId + ")",{ expires: 7, path: '/'});
	  	return false;
    });
	
	jQuery("#patterndelete").click(function(){
		jQuery.cookie('themeBG',null,{expires: 7, path: '/'});
        return false;
	});
	

	jQuery('#colorSelector').ColorPicker({
		color: '#0000ff',
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#colorSelector div').css('backgroundColor', '#' + hex);
		}
	});

	
});