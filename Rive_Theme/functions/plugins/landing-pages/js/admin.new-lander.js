jQuery(document).ready(function ($) {

	// filter items when filter link is clicked
	jQuery('#template-filter a').click(function(){
	  var selector = jQuery(this).attr('data-filter');
	  //alert(selector);
	  jQuery('#templates-container').isotope({ filter: selector });
	  return false;
	});

	jQuery('.lp_select_template').click(function(){
		var template = jQuery(this).attr('id');
		var label = jQuery(this).attr('label');
		jQuery(".lp-template-selector-container").fadeOut(500,function(){
			jQuery(".wrap").fadeIn(500, function(){
			});
		});

		jQuery('#lp_metabox_select_template h3').html('Current Active Template: '+label);
		jQuery('#lp_select_template').val(template);
		//alert(template);
		//alert(label);
	});
});