/* jshint ignore:start */
/*jshint -W020 */
jQuery(document).ready(function() {
	jQuery('.wpb-content-layouts #vc_icon').closest('li').css({'display':'none'});
	jQuery('.wpb-content-layouts #vc_btn').closest('li').css({'display':'none'});
	/*
	Live Modal
	*/
	jQuery(document).ajaxComplete(function(event, xhr, settings) {
		if (jQuery(".vc_ui-panel.vc_active").length) {
			var classes = jQuery(".vc_ui-panel.vc_active").attr("class").split(' ');
			jQuery.each(classes, function(i, c) {
			    if (c.indexOf("astro_") === 0) {
			        jQuery(".vc_ui-panel.vc_active").removeClass(c);
			    }
			});
			jQuery('.vc_ui-panel.vc_active .vc_shortcode-param').each(function() {
				if (jQuery(this).attr('data-vc-shortcode-param-name')!==undefined) {
					jQuery(this).addClass('astro_'+jQuery(this).attr('data-vc-shortcode-param-name'));
				}
			});
			if (jQuery('.vc_ui-panel.vc_active').attr('data-vc-shortcode')!==undefined) {
				jQuery('.vc_ui-panel.vc_active').addClass('astro_'+jQuery('.vc_ui-panel.vc_active').attr('data-vc-shortcode'));
			}
		}
	});	
	//REDUX STUFF
	jQuery('#vrv_one_click #redux-header .notice').slideDown();
	//REMOVE VC REQUEST
	jQuery('.wp-list-table.plugins #the-list tr').each(function() {
		if (jQuery(this).attr('data-slug')==="wpbakery-visual-composer" && jQuery(this).find('.row-actions>.update').length===0) {
			jQuery(this).removeClass('update');
			jQuery('#js_composer-update').css({'display':'none'});
		}
		if (jQuery(this).attr('data-slug')==="astro-framework" && jQuery(this).find('.row-actions>.update').length===1) {
			jQuery(this).addClass('update');
		}
	});
});
/* jshint ignore:end */