var TMM_APP_DEMO_ADMIN = function() {
	var self = {
		init: function() {

			jQuery("#save_current_color_scheme").click(function() {
				var name = jQuery("#new_color_scheme_name").val();
				var color = jQuery(".new_color_scheme_color").val();
				if (name.length == 0) {
					alert(tmm_l10n.tmm_enter_new_color_scheme_name);
					return false;
				}

				if (color.length == 0) {
					alert(tmm_l10n.tmm_enter_new_color);
					return false;
				}

				show_static_info_popup(tmm_l10n.tmm_creating_new_color_scheme);

				//*****

				var theme_data = {
					type: "save",
					action: "change_options",
					values: jQuery("#theme_options").serialize()
				};
				jQuery.post(ajaxurl, theme_data, function(response) {

					hide_static_info_popup();
					//***
					show_info_popup(response);
					//***
					var js_data = [];
					for (var i = 0; i < tmm_options_reset_array.length; i++) {
						js_data[i] = {
							'name': tmm_options_reset_array[i],
							'value': jQuery("[name=" + tmm_options_reset_array[i] + "]").val()
						};
					}
					//***
					var data = {
						action: "app_demo_create_theme_scheme",
						js_data: js_data,
						color: color,
						name: name
					};
					jQuery.post(ajaxurl, data, function(key) {
						jQuery("#new_color_scheme_name").val("");
						jQuery(".new_color_scheme_color").val("");
						//***
						jQuery("#color_schemes_select").append('<option value="' + key + '">' + name + '</option>');
						show_info_popup(tmm_l10n.tmm_new_color_scheme_added);
					});
					//***
				});

				//*****

				return false;
			});

			//*****
			jQuery("#upload_color_scheme").click(function() {
				var scheme_key = jQuery("#color_schemes_select").val();
				if (scheme_key.length == 0) {
					return;
				}

				//***
				if (confirm("Do You really want to upload selected color scheme?")) {
					var data = {
						action: "app_demo_upload_theme_scheme",
						key: scheme_key
					};
					jQuery.post(ajaxurl, data, function(responce) {
						var data = jQuery.parseJSON(responce);

						if (data.length > 0) {
							jQuery.each(data, function(index, value) {
								var obj = jQuery("[name=" + value.name + "]");
								jQuery(obj).val(value.value);
								//***
								if (jQuery(obj).hasClass("bg_hex_color")) {
									jQuery(obj).next(".bgpicker").css('background-color', value.value);
								}
							});
						}
						//***
						save_options('save');
					});
				}
			});

			//***

			jQuery("#edit_color_scheme").click(function() {
				var scheme_key = jQuery("#color_schemes_select").val();
				var scheme_name = jQuery("#color_schemes_select").find(":selected").text();
				var new_name = jQuery("#new_color_scheme_name").val();
				if (scheme_key.length == 0) {
					return;
				}
				//***
				if (confirm("Do You really want to upload current color settings to selected color scheme?")) {

					var theme_data = {
						type: "save",
						action: "change_options",
						values: jQuery("#theme_options").serialize()
					};
					jQuery.post(ajaxurl, theme_data, function(response) {
						var js_data = new Array();
						for (var i = 0; i < tmm_options_reset_array.length; i++) {
							js_data[i] = {
								'name': tmm_options_reset_array[i],
								'value': jQuery("[name=" + tmm_options_reset_array[i] + "]").val()
							}
						}
						//***
						var color = jQuery(".new_color_scheme_color").val();
						//***
						var data = {
							action: "app_demo_edit_theme_scheme",
							key: scheme_key,
							name: scheme_name,
							new_name: new_name,
							js_data: js_data,
							color: color,
							edit_mode: 1
						};
						jQuery.post(ajaxurl, data, function() {
							if (new_name.length > 0) {
								jQuery("#color_schemes_select option:selected").text(new_name);
							}
							show_info_popup("Selected color scheme edited!");
						});
					});
				}
			});

			//***

			jQuery("#delete_color_scheme").click(function() {
				var scheme_key = jQuery("#color_schemes_select").val();
				if (scheme_key.length == 0) {
					return;
				}
				//***
				if (confirm("Do You really want to delete selected color scheme?")) {
					var data = {
						action: "app_demo_delete_theme_scheme",
						key: scheme_key
					};
					jQuery.post(ajaxurl, data, function() {
						jQuery("#color_schemes_select option:selected").remove();
						show_info_popup("Selected color scheme deleted!");
					});
				}
			});

			//***
			jQuery('#color_schemes_select').change(function() {
				var color = jQuery(this).find(":selected").data('color');
				jQuery('.new_color_scheme_color').val(color);
				jQuery('.new_color_scheme_color').next('div').css('background-color', color);
			});
		}
	};

	return self;
};
//*****

var tmm_ext_admin_demo = null;
jQuery(document).ready(function() {
	tmm_ext_admin_demo = new TMM_APP_DEMO_ADMIN();
	tmm_ext_admin_demo.init();
});

