var app_data_admin_data_constructor = null;
jQuery(document).ready(function() {
	app_data_admin_data_constructor = new THEMEMAKERS_APP_CARDEALER_ADMIN_DATACONSTRUCTOR();
	app_data_admin_data_constructor.init();
});
//**********************************************
var THEMEMAKERS_APP_CARDEALER_ADMIN_DATACONSTRUCTOR = function() {
	var self = {
		data_groups_list: jQuery(".data_groups_list"),
		data_group_data: jQuery(".data_group_data"),
		data_groups_errors: jQuery("#data_groups_errors"),
		data_groups_succsess: jQuery("#data_groups_succsess"),
		current_data_group_index: null,
		init: function() {

			jQuery("#data_groups_list").sortable();
			jQuery(".data_group_items").sortable();
			jQuery(".data_item_select_options").sortable();

			//***

			jQuery("#new_data_group_name_button").on('click', function() {
				var name = jQuery("#new_data_group_name").val();
				jQuery("#new_data_group_name").val("");
				if (name.length === 0) {
					return;
				}

				show_static_info_popup(lang_one_moment);
				var data = {
					action: "app_cardealer_add_data_group",
					name: name
				};
				jQuery.post(ajaxurl, data, function(response) {
					response = jQuery.parseJSON(response);
					hide_static_info_popup();
					if (response.errors.length === 0) {
						self.current_data_group_index = response.data_group_index;
						jQuery("#data_groups_list").append('<li>' + response.template + '</li>');
						jQuery("#data_group_data").append('<li class="data_group_' + response.data_group_index + '">' + response.template_data + '</li>');

						jQuery('.js_data_constructor_panel').animate({
							opacity: 0,
							height: "toggle"
						}, 777, function () {
							jQuery('.data_group_data > li.data_group_' + self.current_data_group_index).fadeIn(555);
							jQuery('.js_back_to_group_data_list').show();
						});
					} else {
						self.print_errors(response.errors);
					}
				});

				return false;
			});

			jQuery(".show_group_data_link").life('click', function() {
				var index = jQuery(this).attr('data-group-index');

				jQuery('.js_data_constructor_panel').animate({
					opacity: 0,
					height: "toggle"
				}, 777, function () {
					jQuery('.data_group_data > li.data_group_' + index).fadeIn(555);
					jQuery('.js_back_to_group_data_list').show();
				});

				self.current_data_group_index = index;

				return false;
			});

			jQuery('.js_back_to_group_data_list').life('click', function () {
				var index = self.current_data_group_index;

				jQuery('.data_group_data > li.data_group_' + index).animate({
					opacity: 0,
					height: "toggle"
				}, 777, function () {
					jQuery(this).css('opacity', 100);
					jQuery('.js_data_constructor_panel').css('opacity', 100).show(333);
					jQuery('.js_back_to_group_data_list').hide();
				});

			});

			jQuery(".delete_group").life('click', function() {
				if (confirm(lang_sure)) {
					var index = jQuery(this).attr('data-group-index');
					jQuery(this).parent().remove();
					jQuery(".data_group_" + index).remove();
				}

				return false;
			});


			jQuery(".close_group").life('click', function() {
				jQuery('.data_group_data > li').hide(444);
				return false;
			});

			/**************************************************/


			jQuery(".add_item_to_data_group").life('click', function() {
				if (self.current_data_group_index === null) {
					return;
				}

				var _this = this;

				show_static_info_popup(lang_one_moment);
				var data = {
					action: "app_cardealer_add_item_to_data_group",
					index: self.current_data_group_index
				};
				jQuery.post(ajaxurl, data, function(template) {
					hide_static_info_popup();
					jQuery(_this).parent().find(".data_group_items").prepend('<li class="admin-drag-holder">' + template + '</li>');
					jQuery(".data_item_select_options").sortable();
				});

				return false;
			});

			jQuery(".add_item_to_opt_group").life('click', function() {
				var _this = this;

				show_static_info_popup(lang_one_moment);
				var data = {
					action: "app_cardealer_add_car_opt",
					index: self.current_data_group_index
				};
				jQuery.post(ajaxurl, data, function(template) {
					hide_static_info_popup();
					jQuery(_this).parent().find(".data_group_items").prepend('<li class="admin-drag-holder">' + template + '</li>');
					jQuery(".data_item_select_options").sortable();
				});

				return false;
			});

			jQuery(".delete_item_from_data_group").life('click', function() {
				if (confirm(lang_sure)) {
					jQuery(this).parent().hide(200, function() {
						jQuery(this).remove();
					});
				}

				return false;
			});




			jQuery(".data_group_item_select").life('change', function() {
				var value = jQuery(this).val();
				jQuery(this).parents('li.admin-drag-holder').find(".data_group_input_type").hide(333);
				jQuery(this).parents('li.admin-drag-holder').find(".data_group_item_template_" + value).show(333);
			});


			jQuery(".add_option_to_data_item_select").life('click', function() {
				var item_index = jQuery(this).attr('data-group-item-index');
				var template = '<input type="text" value="" name="data_groups[' + self.current_data_group_index + '][data][' + item_index + '][select][]" />&nbsp;<a href="#" class="delete_option_from_data_item_select remove-button"></a><br />';
				jQuery(this).parent().find('.data_item_select_options').prepend('<li>' + template + '</li>');
				jQuery(this).parent().find('.data_item_select_options').find('li:first-child').find('input[type=text]').focus();
				return false;
			});


			jQuery(".delete_option_from_data_item_select").life('click', function(e) {
				if (confirm(lang_sure)) {
					jQuery(this).parent().hide(200, function() {
						jQuery(this).remove();
					});
				}
				return false;
			});


		},
		print_errors: function(data) {
			jQuery(self.data_groups_succsess).hide();
			jQuery(self.data_groups_errors).html(data);
			jQuery(self.data_groups_errors).show();
		},
		print_data: function(data) {
			jQuery(self.data_groups_errors).hide();
			jQuery(self.data_groups_succsess).html(data);
			jQuery(self.data_groups_succsess).show();
		},
		get_mk_time: function() {
			var d = new Date();
			return Math.floor(d.getTime() / 1000);//sec
		}
	};

	return self;
};




