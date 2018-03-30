(function($) {
	$(document).ready(function() {
		edgtfInitIconDropdown();
		edgtfInitAdditionalItemOptions();
	});

	/**
	 * Function that serializes additional menu item options in a single field.
	 */
	function edgtfInitAdditionalItemOptions() {
		var navForm = $('#update-nav-menu');

		navForm.on('change', '[data-item-option]', function() {
			edgtfGenerateSerializedString();
		});
	}

	/**
	 * Function that shows and hides proper icon dropdowns based on icon pack dropdown
	 */
	function edgtfInitIconDropdown() {
		var navForm = $('#update-nav-menu');

		navForm.on('change', '[data-icon-pack]', function() {
			var currentIconPackDropdown = $(this);
			var chosenIconPack = $(this).find('option:selected').val();
			var navMenuId = currentIconPackDropdown.data('item-id');
			var iconDropdowns = navForm.find('[data-icon][data-item-id='+navMenuId+']');

			//if chosen icon pack value isn't empty
			if(chosenIconPack !== '') {
				//get proper icon dropdown holder based on menu item id and icon pack key
				var chosenIconDropdownHolder = navForm.find('[data-icon][data-item-id='+navMenuId+'][data-icon-pack-key='+chosenIconPack+']');
				//get icon dropdown field
				var chosenIconDropdown = chosenIconDropdownHolder.find('select');

				//if icon pack option is valid one
				if(typeof chosenIconDropdownHolder !== 'undefined') {
					//hide all icon dropdowns
					iconDropdowns.hide();

					//show the one that we need
					chosenIconDropdownHolder.show();

					//reset data-name attribute for all icon dropdowns
					iconDropdowns.each(function() {
						$(this).find('select').attr('data-name', '');
					});

					//set correct data-name attribute on chosen icon dropdown because it will be included in serialized string
					chosenIconDropdown.attr('data-name', 'menu_item_icon_'+navMenuId);

				}

			} else {
				//default option is selected. Hide all and reset data-name for all icon dropdowns
				iconDropdowns.hide();
				iconDropdowns.each(function() {
					$(this).find('select').attr('data-name', '');
				});
			}

			edgtfGenerateSerializedString();
		});
	}

	function edgtfGenerateSerializedString() {
		var dataArrayString = '';
		var navForm = $('#update-nav-menu');
		var menuItemsData = navForm.find("[data-name]");
		menuItemsData.each(function() {
			//get it's value and name
			var attributeName = $(this).data('name');
			var attributeVal  = $(this).val();

			if(attributeVal !== '') {
				//check if current field is checkbox
				if($(this).is('input[type="checkbox"]')) {
					//append it to serialized string only if it's checked
					if($(this).is(':checked')) {
						dataArrayString += attributeName+"="+attributeVal+'&';
					}
				} else {
					dataArrayString += attributeName+"="+attributeVal+'&';
				}
			}
		});

		//remove last & character
		dataArrayString = dataArrayString.substr(0, dataArrayString.length - 1);

		if($('input[name="edgt_menu_options"]').length) {
			$('input[name="edgt_menu_options"]').val(encodeURIComponent(dataArrayString));
		} else {
			//generate hidden input field html with serialized string value
			var hiddenMenuItem = '<input type="hidden" name="edgt_menu_options" value="'+encodeURIComponent(dataArrayString)+'">';

			//append hidden options field to navigation form
			navForm.append(hiddenMenuItem);
		}
	}
})(jQuery);