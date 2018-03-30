jQuery(document).ready(function() {

	jQuery(".custom_sidebars_list").sortable();

	jQuery(".add_sidebar").click(function() {
		var sidebar_name = jQuery("#sidebar_name").val();
		var sidebar_id=get_time_miliseconds();

		sidebar_name = escapeHTML(sidebar_name);

		if (sidebar_name.length > 0) {
			var data = {
				sidebar_name: sidebar_name,
				sidebar_id: sidebar_id,
				action: "add_sidebar"
			};
			jQuery.post(ajaxurl, data, function(response) {
				response = jQuery.parseJSON(response);
				jQuery(".custom_sidebars_list .js_no_one_item_else").remove();
				jQuery("#sidebars_list").append('<li style="display: none;" id="sidebar_' + sidebar_id + '">' + response['html'] + '</li>');
				jQuery("#sidebar_name").val("");
				//***
				jQuery(".custom_sidebars_list").append('<li><a data-id="sidebar_' + sidebar_id + '" class="js_edit_sidebar" href="#">' + sidebar_name + '</a><input type="hidden" name="sidebars[' + sidebar_id + '][name]" value="' + sidebar_name + '" /><a href="#" title="' + tmm_l10n.delete + '" class="remove js_remove_sidebar" data-id="sidebar_' + sidebar_id + '"></a><a data-id="sidebar_' + sidebar_id + '" href="#" title="' + tmm_l10n.edit + '" class="edit js_edit_sidebar"></a></li>');
				jQuery(".custom_sidebars_list").sortable();
			});
		}

	});

	jQuery('.js_edit_sidebar').life('click', function() {
		var id = jQuery(this).data('id');

		jQuery('#js_sidebar_panel').animate({
			opacity: 0,
			height: "toggle"
		}, 777, function() {
			jQuery('#' + id).fadeIn(555);
		});
	});


	jQuery('.js_back_to_sidebars_list').life('click', function() {
		jQuery(this).parent('li').animate({
			opacity: 0,
			height: "toggle"
		}, 777, function() {
			jQuery(this).css('opacity', 100);
			jQuery('#js_sidebar_panel').css('opacity', 100).show(333);
		});
	});

	jQuery(".js_remove_sidebar").life('click', function() {
		var id = jQuery(this).data('id');
		jQuery(this).parent().hide(hide_delay, function() {
			jQuery(this).remove();
			jQuery("#" + id).remove();
		});
		return false;
	});

	//*********************************************************************

	var stop_add_new_page = false;
	jQuery(".add_page").life('click', function() {
		if (stop_add_new_page) {
			return;
		}
		stop_add_new_page = true;

		var self = this;
		var data = {
			sidebar_id: jQuery(self).data("id"),
			page_id: jQuery(self).parent().find(".tmk_row").length,
			action: "add_sidebar_page"
		};
		jQuery.post(ajaxurl, data, function(html) {
			jQuery(self).parent().append(html);
			stop_add_new_page = false;
		});

	});

	var stop_add_new_cat = false;
	jQuery(".add_category").life('click', function() {
		if (stop_add_new_cat) {
			return;
		}
		stop_add_new_cat = true;

		var self = this;
		var data = {
			sidebar_id: jQuery(self).data("id"),
			cat_id: jQuery(this).parent().find(".tmk_row").length,
			action: "add_sidebar_category"
		};
		jQuery.post(ajaxurl, data, function(html) {
			jQuery(self).parent().append(html);
			stop_add_new_cat = false;
		});

	});

	//for pages and categories
	jQuery(".remove_page").life('click', function() {
		jQuery(this).parent().slideUp(hide_delay, function() {
			jQuery(this).remove();
		});
	});

});