var TMM_APP_CARDEALER_ADMIN_USERMANAGER = function () {
	var self = {
		init: function () {

			jQuery(".custom_user_roles_list").sortable();

			jQuery(".add_user_role").click(function () {
				var user_role_name = jQuery("#user_role_name").val();
				if (user_role_name.length > 0) {
					var data = {
						user_role_name: user_role_name,
						action: "app_cardealer_add_user_role"
					};
					jQuery.post(ajaxurl, data, function (response) {
						response = jQuery.parseJSON(response);
						jQuery(".custom_user_roles_list .js_no_one_item_else").remove();
						jQuery("#user_roles_list").append('<li style="display: none;" id="user_role_' + response.user_role_id + '">' + response.html + '</li>');
						jQuery("#user_role_name").val("");
						//***
						jQuery(".custom_user_roles_list").append('<li><a data-id="user_role_' + response.user_role_id + '" data-id-num="' + response.user_role_id + '" class="js_edit_user_role js_user_role_text" href="#">' + user_role_name + '</a><input type="hidden" name="user_roles[' + response.user_role_id + '][name]" value="' + user_role_name + '" /><a href="#" title="' + lang_delete + '" class="remove js_remove_user_role" data-id="user_role' + response.user_role_id + '"></a><a data-id="user_role_' + response.user_role_id + '" href="#" title="' + lang_edit + '" class="edit js_edit_user_role"></a></li>');
						jQuery(".custom_user_roles_list").sortable();
						self.update_user_role_select();
					});
				}

			});

			jQuery('.js_edit_user_role').life('click', function () {
				var id = jQuery(this).data('id');

				jQuery('#js_user_roles_panel').animate({
					opacity: 0,
					height: "toggle"
				}, 777, function () {
					jQuery('#' + id).fadeIn(555);
				});
			});


			jQuery('.js_back_to_user_roles_list').life('click', function () {
				jQuery(this).parent('li').animate({
					opacity: 0,
					height: "toggle"
				}, 777, function () {
					jQuery(this).css('opacity', 100);
					jQuery('#js_user_roles_panel').css('opacity', 100).show(333);
				});

				self.update_user_role_select();
			});

			jQuery(".js_remove_user_role").life('click', function () {

				if (confirm(lang_sure)) {
					var id = jQuery(this).data('id');
					jQuery(this).parent().hide(hide_delay, function () {
						jQuery(this).remove();
						jQuery("#" + id).remove();
						self.update_user_role_select();
					});
				}
				return false;
			});

			jQuery('.user_role_name_input').life('keyup', function () {
				var id = jQuery(this).data('id');
				jQuery('.js_user_role_text[data-id=' + id + ']').text(jQuery(this).val());
			});

		},
		update_user_role_select: function () {
			var select = jQuery('.default_user_role_select');
			var current_value = jQuery(select).val();
			var roles = jQuery('.js_user_role_text');
			if (roles.length > 0) {
				jQuery(select).empty();
				jQuery(select).append(jQuery("<option></option>").attr("value", 0).text('Choose Default Dealer Type'));
				jQuery.each(roles, function (index, input) {
					var key = jQuery(input).data('id-num');
					jQuery(select).append(jQuery("<option></option>").attr("value", key).text(jQuery(input).text()));
				});
				jQuery(select).val(current_value);
			}

		}
	};

	return self;
};


var app_data_admin_user_manager = null;
jQuery(document).ready(function () {
	app_data_admin_user_manager = new TMM_APP_CARDEALER_ADMIN_USERMANAGER();
	app_data_admin_user_manager.init();
});

/**************************************************************/

var TMM_APP_CARDEALER_ADMIN_FEATURESPACKMANAGER = function () {
	var self = {
		init: function () {

			jQuery(".features_packets_list").sortable();

			jQuery(".add_features_packet").click(function () {
				var name = jQuery("#features_packet_name").val();
				if (name.length > 0) {
					var data = {
						name: name,
						action: "app_cardealer_add_features_packet"
					};
					jQuery.post(ajaxurl, data, function (response) {
						response = jQuery.parseJSON(response);
						jQuery(".features_packets_list .js_no_one_item_else").remove();
						jQuery("#features_packets_list").append('<li style="display: none;" id="features_packet_' + response.packet_id + '">' + response.html + '</li>');
						jQuery("#user_role_name").val("");
						//***
						jQuery(".features_packets_list").append('<li><a data-id="features_packet_' + response.packet_id + '" class="js_edit_features_packet js_features_packet_text" href="#">' + name + '</a><input type="hidden" name="features_packets[' + response.packet_id + '][name]" value="' + name + '" /><a href="#" title="' + lang_delete + '" class="remove js_remove_features_packet" data-id="features_packet_' + response.packet_id + '"></a><a data-id="features_packet_' + response.packet_id + '" href="#" title="' + lang_edit + '" class="edit js_edit_features_packet"></a></li>');
						jQuery(".features_packets_list").sortable();
						jQuery("#features_packet_name").val("");
					});
				}

			});

			jQuery('.js_edit_features_packet').life('click', function () {
				var id = jQuery(this).data('id');

				jQuery('#js_user_roles_panel').animate({
					opacity: 0,
					height: "toggle"
				}, 777, function () {
					jQuery('#' + id).fadeIn(555);
				});
			});

			jQuery(".js_remove_features_packet").life('click', function () {

				if (confirm(lang_sure)) {
					var id = jQuery(this).data('id');
					jQuery(this).parent().hide(hide_delay, function () {
						jQuery(this).remove();
						jQuery("#" + id).remove();
					});
				}
				return false;
			});

			jQuery('.features_packet_name_input').life('keyup', function () {
				var id = jQuery(this).data('id');
				jQuery('.js_features_packet_text[data-id=' + id + ']').text(jQuery(this).val());
			});

		}
	};

	return self;
};

var app_data_admin_featurespack_manager = null;
jQuery(document).ready(function () {
	app_data_admin_featurespack_manager = new TMM_APP_CARDEALER_ADMIN_FEATURESPACKMANAGER();
	app_data_admin_featurespack_manager.init();
});