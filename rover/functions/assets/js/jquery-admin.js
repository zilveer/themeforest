jQuery(document).ready(function() {

	//Img Radio
	jQuery('.TR-radio-img-img').click(function(){
			jQuery(this).parent().parent().find('.TR-radio-img-img').removeClass('TR-radio-img-selected');
			jQuery(this).addClass('TR-radio-img-selected');			
	});
	jQuery('.TR-radio-img-label').hide();
	jQuery('.TR-radio-img-img').show();
	jQuery('.TR-radio-img-radio').hide();


	// Chosen selects
	jQuery("select.chosen_select").chosen();


	//Tabs
	var tabs = jQuery('ul.theme-tabs-title');

	tabs.each(function(i) {

		//Get all tabs
		var tab = jQuery(this).find('> li > a');
		tab.click(function(e) {

			//Get Location of tab's content
			var contentLocation = jQuery(this).attr('href');

			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {

				e.preventDefault();

				//Make Tab Active
				tab.removeClass('active');
				jQuery(this).addClass('active');

				//Show Tab Content & add active class
				jQuery(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

			}
		});
	});

});