var app_cardealer_app_add_new_car = null;
jQuery(document).ready(function () {
	app_cardealer_app_add_new_car = new THEMEMAKERS_APP_CARDEALER_ADD_NEW_CAR();
	app_cardealer_app_add_new_car.init();
});
//**********************************************
var THEMEMAKERS_APP_CARDEALER_ADD_NEW_CAR = function () {
	var self = {
		car_adv_desc_signs: 0,
		init: function () {
			self.car_adv_desc_signs = car_adv_desc_signs;

            jQuery('#thememakers_car_app_add_new_car input[type="submit"]').life('click', function (e) {
                e.preventDefault();
                self.add();
            });

			jQuery(".js_option_checkbox").life('click', function () {
				if (jQuery(this).is(":checked")) {
					jQuery(this).val(1);
				} else {
					jQuery(this).val(0);
				}
			});

			jQuery("#car_adv_desc").bind('keydown input paste', function () {
				var desc = jQuery(this).val();
				var desc_length = desc.length;

				if (desc_length > self.car_adv_desc_signs) {
					desc = desc.slice(0, self.car_adv_desc_signs);
					jQuery(this).val(desc);
					jQuery("#car_adv_desc_signs_left").html(0);
				} else {
					jQuery("#car_adv_desc_signs_left").html(self.car_adv_desc_signs - desc_length);
				}
			});

			/*
			 * Do not open image while adding new car from front
			 */
			jQuery('.thememakers_car_app_new_car_block #images_list a').life('click', function () {
				return false;
			});

		},
		add: function () {

			var is_agreement_checked = jQuery('#thememakers_car_app_new_car_agreement').is(':checked');
			if (!is_agreement_checked) {
				alert(tmm_l10n.terms_notice);
				return false;
			}

			var loading = jQuery('<div id="ballsWaveG" style="margin:60px auto;"><div id="ballsWaveG_1" class="ballsWaveG"></div><div id="ballsWaveG_2" class="ballsWaveG"></div><div id="ballsWaveG_3" class="ballsWaveG"></div><div id="ballsWaveG_4" class="ballsWaveG"></div><div id="ballsWaveG_5" class="ballsWaveG"></div><div id="ballsWaveG_6" class="ballsWaveG"></div><div id="ballsWaveG_7" class="ballsWaveG"></div><div id="ballsWaveG_8" class="ballsWaveG"></div></div>');
			jQuery('.form-entry').append(loading).children().hide();
			loading.fadeIn(300);

			var data = {
				action: "app_cardealer_add_car",
				data: jQuery("#thememakers_car_app_add_new_car").serialize()
			};
			jQuery.post(ajaxurl, data, function (new_post_id) {
				if (user_cars_page.length === 0 || user_cars_page === '#') {
					window.location.replace(tmm_l10n.site_url);
				} else {
					window.location.replace(user_cars_page);
				}
			});

			return false;

		},
		next_block: function (block_num) {

			if (block_num == 2) {
				var items = jQuery('[data-required="1"]'),
					is_required = false,
					car_price = jQuery('#car_price'),
					car_price_val = car_price.val(),
					car_mileage = jQuery('#car_mileage'),
					car_mileage_val = car_mileage.val(),
                    car_state = jQuery('#car_state').val();

				if (car_price_val !== '') {
					car_price_val = parseInt(car_price_val);
					car_price_val = ( isNaN(car_price_val) !== true ) ? car_price_val : '';
					car_price.val(car_price_val);
				}
				if (car_mileage_val !== '') {
					car_mileage_val = parseInt(car_mileage_val);
					car_mileage_val = ( isNaN(car_mileage_val) !== true ) ? car_mileage_val : '';
					car_mileage.val(car_mileage_val);
				}

				items.removeClass('required')
					.each(function (i) {
						var $this = jQuery(this),
							val = $this.val(),
							id = $this.attr('id'),
                            skip_mileage = false;
                            
                        if(car_state === 'car_is_new' && id === car_mileage.attr('id')){
                            skip_mileage = true;
                        }
						if (!skip_mileage && (val == 'none' || val == undefined || val === '' || val === '0')) {
							is_required = true;
							$this.addClass('required');
						}
					});

				if (is_required) {
					show_info_popup(tmm_l10n.required_fields);
                    return false;
				} else {
					jQuery('.thememakers_car_app_new_car_block').slideUp(300);
					jQuery('#thememakers_car_app_new_car_' + block_num).slideDown(300);
				}
			} else if (block_num == 4) {
				var preview = jQuery('#frame').contents().find('.fileupload_presentation canvas');
				if (preview.length > 0) {
					show_info_popup('Please upload selected images!');
                    return false;
				} else {
					jQuery('.thememakers_car_app_new_car_block').slideUp(300);
					jQuery('#thememakers_car_app_new_car_' + block_num).slideDown(300);
				}
			} else {
				jQuery('.thememakers_car_app_new_car_block').slideUp(300);
				jQuery('#thememakers_car_app_new_car_' + block_num).slideDown(300);
			}

            jQuery('li.cart-title').removeClass('step-now');
            jQuery('li.cart-title').removeClass('step-success');
            jQuery('#head_step' + block_num).addClass('step-now');

            if (block_num > 1) {
                for (var i = 1; i < block_num; i++) {
                    jQuery('#head_step' + i).addClass('step-success');
                }
            }
		}
	};

	return self;
};




