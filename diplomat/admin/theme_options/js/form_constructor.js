jQuery(document).ready(function() {
	
	jQuery(".drag_contact_form_list").sortable();
	
	//add form
	jQuery('.js_add_form').click(function() {
		jQuery(".contact_forms_groups_list .js_no_one_item_else").remove();

		var html = jQuery("#contact_form_template").html();
		var index = get_time_miliseconds();

		var new_contact_form_name = jQuery("#new_contact_form_name").val();
		if (!new_contact_form_name) {
			return;
		}
		jQuery("#new_contact_form_name").val("");

		new_contact_form_name = escapeHTML(new_contact_form_name);

		html = html.replace(/__INIQUE_ID__/gi, index);
		html = html.replace(/__FORM_NAME__/gi, new_contact_form_name);
		jQuery("#contact_forms_list").append("<li style='display:none;' id='contact_form_" + index + "'>" + html + "</li>");

		//*****
		jQuery(".contact_forms_groups_list").append('<li><a data-id="contact_form_' + index + '" class="js_edit_contact_form" href="#">' + new_contact_form_name + '</a><a href="#" title="' + tmm_l10n.delete + '" class="remove delete_contact_form" data-id="contact_form_' + index + '"></a><a data-id="contact_form_' + index + '" href="#" title="' + tmm_l10n.edit + '" class="edit js_edit_contact_form"></a></li>');
		
		jQuery(".drag_contact_form_list").sortable();

		return false;
	});


	jQuery('.js_edit_contact_form').life('click', function() {
		var id = jQuery(this).data('id');
		jQuery('.js_contact_forms_panel').animate({
			opacity: 0,
			height: "toggle"
		}, 777, function() {
			jQuery('#' + id).fadeIn(555);
		});
	});


	jQuery('.js_back_to_forms_list').life('click', function() {
		jQuery(this).parent('li').animate({
			opacity: 0,
			height: "toggle"			
		}, 777, function() {
			jQuery(this).css('opacity', 100);
			jQuery('.js_contact_forms_panel').css('opacity', 100).show(333);
		});
	});


	//delete form
	jQuery('.delete_contact_form').life('click', function() {
		var id = jQuery(this).data('id');
		jQuery(this).parent().hide(hide_delay, function() {
			jQuery(this).remove();
			jQuery("#"+id).remove();
		});
		return false;
	});

	//add field
	jQuery('.add_contact_field_button').life('click', function() {
		var index = jQuery(this).attr("form-id");
		var input_index = get_time_miliseconds();

		var html = jQuery("#contact_form_field_template").html();
		html = html.replace(/__INDEX__/gi, index);
		html = html.replace(/__INPUTINDEX__/gi, input_index);
		jQuery(this).parent().find(".drag_contact_form_list").append(html);

		return false;
	});



	//delete field
	jQuery('.delete_contact_field_button').life('click', function() {
		jQuery(this).parent().hide(hide_delay, function() {
			jQuery(this).closest("li").remove();
		});
		return false;
	});


	//change select attributes
	jQuery('.options_type_select').life('change', function() {
		var value=jQuery(this).val();

		jQuery(this).parents(".admin-drag-holder").find(".with-check").eq(0).show();

		if (value == "select" || value == "radio" || value == "checkbox") {
			jQuery(this).parents(".admin-drag-holder").find(".select_options").eq(0).show(show_delay);
			jQuery(this).parents(".admin-drag-holder").find(".title_options").eq(0).hide(hide_delay);
		}else if (value == "title") {
			jQuery(this).parents(".admin-drag-holder").find(".title_options").eq(0).show(show_delay);
			jQuery(this).parents(".admin-drag-holder").find(".with-check").eq(0).eq(0).hide();
			jQuery(this).parents(".admin-drag-holder").find(".select_options").eq(0).hide(hide_delay);
		} else {
			jQuery(this).parents(".admin-drag-holder").find(".title_options").eq(0).hide(hide_delay);
			jQuery(this).parents(".admin-drag-holder").find(".select_options").eq(0).hide(hide_delay);
		}

		if (value == "checkbox") {
			jQuery(this).parents(".admin-drag-holder").find(".optional_field").eq(0).show(show_delay);
		} else {
			jQuery(this).parents(".admin-drag-holder").find(".optional_field").eq(0).hide(show_delay);
		}
	});

	//change select form name
	jQuery('.form_name').life('change', function(event) {
		var defaultValue = event.target.defaultValue;
		var newValue = event.target.value;
		jQuery("a:contains(" + defaultValue + ")").text(newValue);
		event.target.defaultValue = newValue;
	});
});


