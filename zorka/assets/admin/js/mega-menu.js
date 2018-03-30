G5Plus_Mega_Menu = {
	ready : function() {
		jQuery(document).on('change','.mega-menu-sub-type-menu select', function(){
			G5Plus_Mega_Menu.showHideOption(this, jQuery(this).closest('.menu-item-settings'));
		});
	},
	showHideOption: function(menu, wrapper) {
		var value = jQuery(menu).val();
		switch (value) {
			case 'standard':
				jQuery('.mega-menu-background,.mega-menu-widget-area', wrapper).hide();
				break;
			case 'multi-column':
				jQuery('.mega-menu-widget-area', wrapper).hide();
				jQuery('.mega-menu-background', wrapper).show();
				break;
			case 'widget-area':
				jQuery('.mega-menu-widget-area', wrapper).show();
				jQuery('.mega-menu-background', wrapper).show();
				break;
		}
	}
};
jQuery(function() {
	G5Plus_Mega_Menu.ready();
});
