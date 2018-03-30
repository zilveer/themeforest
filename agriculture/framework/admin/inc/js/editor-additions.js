/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Script for Content Editor Buttons Toggle
 * Created by CMSMasters
 * 
 */


jQuery(window).load(function () { 
    if (jQuery('#content_toolbar2').css('display') !== 'none') {
        jQuery('#content_toolbar3').show();
		
		
        jQuery('#content_wp_adv').addClass('mceButtonActive');
	}
    
	
    jQuery('body').delegate('.mceEditor.wp_themeSkin a.mce_wp_adv', 'click', function () {
        if (jQuery(this).closest('table.mceToolbarRow1').next().css('display') !== 'none') {
            jQuery(this).closest('table.mceToolbarRow1').next().next().show();
			
			
            jQuery(this).addClass('mceButtonActive');
        } else {
            jQuery(this).closest('table.mceToolbarRow1').next().next().hide();
			
			
            jQuery(this).removeClass('mceButtonActive');
        }
    } );
} );

