jQuery(document).ready(function () {
	jQuery("body").prepend('<div id="thememakers_cardealer_image_buffer"></div>');
	jQuery("body").prepend('<div class="info_popup" style="display: none;"></div>');

	jQuery('.button_save_cardealer_options').life('click', function () {

		jQuery("[name=cardealer_form]").find('input[data-typecheck=number]').each(function () {
			var self = jQuery(this),
				value = self.val();

			if (isNaN(value)) {
				value = parseFloat(value);
				if (isNaN(value)) {
					value = '';
				}
			}
			self.val(value);
		});

		var data = {
			action: "app_cardealer_save_settings",
			values: jQuery("[name=cardealer_form]").serialize()
			//test sending options using base64
			//values: window.btoa(jQuery("[name=cardealer_form]").serialize())
		};
		jQuery.post(ajaxurl, data, function (response) {
			show_info_popup(response);
		});
		return false;
	});

	jQuery("[name=cardealer_form]").find('input[data-typecheck=number]').life('blur',function () {
		var self = jQuery(this);
		if (isNaN(self.val())) {
			show_info_popup('Please! Fill in correct numeric value.');
			window.setTimeout(function () {
				self.trigger('focus');
			}, 100);
		}
	}).life('input', function () {
		var value = jQuery(this).val();
		value = value.replace(/[^0-9\.]/g, '');
		jQuery(this).val(value);
	});

	jQuery("#add_car_video").click(function () {
		var template = jQuery("ul#cars_videos li:first-child").html();
		jQuery("ul#cars_videos").append('<li>' + template + '</li>');
		jQuery("ul#cars_videos li:last-child input[type=text]").val("");
		return false;
	});

	jQuery(".remove_car_video").life('click', function () {
		if (jQuery('#cars_videos').find('li').length > 1) {
			jQuery(this).parents('li').hide(200, function () {
				jQuery(this).remove();
			});
		}

		return false;
	});

	jQuery(".js_car_is_featured").on('change', function () {
		var is_checked = jQuery(this).is(':checked');
		var post_id = jQuery(this).attr('value');
		var data = {
			action: "app_cardealer_admin_set_car_as_featured",
			post_id: post_id,
			value: (is_checked ? 1 : 0)
		};
		jQuery.post(ajaxurl, data, function (response) {
			if (is_checked) {
				show_info_popup(lang_thememakers_cardealer_featured_car_set);
			} else {
				show_info_popup(lang_thememakers_cardealer_featured_car_unset);
			}
		});
	});


	jQuery(".js_car_is_draft").on('change', function () {
		var is_checked = jQuery(this).is(':checked');
		var post_id = jQuery(this).attr('value');
		var data = {
			action: "app_cardealer_draft_car",
			post_id: post_id,
			car_is_draft: is_checked ? 1 : 0
		};
		jQuery.post(ajaxurl, data, function (response) {
			if (is_checked) {
				show_info_popup(lang_tmm_cardealer_draft_car_set);
			} else {
				show_info_popup(lang_tmm_cardealer_draft_car_unset);
				jQuery('#post-' + post_id + ' .post-state').remove();
			}
		});
	});


	jQuery(".js_car_is_sold").on('change', function () {
		var is_checked = jQuery(this).is(':checked');
		var post_id = jQuery(this).attr('value');
		var data = {
			action: "app_cardealer_sold_car",
			post_id: post_id,
			car_is_sold: is_checked ? 1 : 0
		};
		jQuery.post(ajaxurl, data, function (response) {
			if (is_checked) {
				show_info_popup(lang_tmm_cardealer_sold_car_set);
			} else {
				show_info_popup(lang_tmm_cardealer_sold_car_unset);
			}
		});
	});

	jQuery("[name=show_slider_as]").change(function () {
		var mode = jQuery(this).val();
		if (mode == 0) {
			jQuery(".js_slider_with_sidebar").parent().parent().hide(200);
			jQuery(".js_slider_without_sidebar").parent().parent().show(200);
		} else {
			jQuery(".js_slider_with_sidebar").parent().parent().show(200);
			jQuery(".js_slider_without_sidebar").parent().parent().hide(200);
		}
	});


	jQuery(".cardealer_update_sample").click(function () {
		show_static_info_popup('Moment ...');

		var data = {
			action: "app_cardealer_update_sample_watermark",
			watermark_size_percent: jQuery("[name=watermark_size_percent]").val(),
			alpha_level: jQuery("[name=alpha_level]").val(),
			watermark_position: jQuery('[name="watermark_position"]').val(),
			watermark_src: jQuery('#watermark_image').val()
		};
		jQuery.post(ajaxurl, data, function (response) {
			jQuery("#watermark_sample_preview img").attr('src', response);
			hide_static_info_popup();
		});

		return false;
	});

	jQuery('#add_customer_currencies_new').life('click', function () {
		var name = jQuery('#customer_currencies_new_name').val();
		var symbol = jQuery('#customer_currencies_new_symbol').val();

		if (name.length <= 1 || symbol.lenght <= 1) {
			show_info_popup(lang_tmm_enter_data_right);
			return false;
		}

		//***

		jQuery('#cars_currencies_list').append('<li><input type="text" name="customer_currencies_names[]" value="' + name + '" />&nbsp;<input type="text" name="customer_currencies_symbols[]" value="' + symbol + '" /></li>');
		jQuery('#customer_currencies_new_name').val("");
		jQuery('#customer_currencies_new_symbol').val("");
		return false;
	});


	jQuery('.cardealer_max_images_size').change(function () {
		var user_id = parseInt(jQuery(this).data('user-id'), 10);
		var data = {
			action: "app_cardealer_user_max_images_size",
			user_id: user_id,
			value: jQuery(this).val()
		};
		jQuery.post(ajaxurl, data, function (response) {
			show_info_popup(lang_updated);
		});


		return false;
	});


	jQuery('.button_import_cardealer_settings').life('click', function () {
		if (confirm(lang_sure)) {
			show_static_info_popup(lang_loading);
			var data = {
				action: "app_cardealer_import_cardealer_settings"
			};
			jQuery.post(ajaxurl, data, function (response) {
				window.location.reload();
			});
		}

		return false;
	});

	jQuery('#allow_custom_title').on('click', function () {
		if (jQuery(this).is(':checked')) {
			jQuery('#car_title_symbols_limit').parents('.option').slideDown();
			jQuery('[name=car_link_type]').parents('.option').slideDown();
		} else {
			jQuery('#car_title_symbols_limit').parents('.option').slideUp();
			jQuery('[name=car_link_type]').parents('.option').slideUp();
		}
	});

	// blog archive (theme options)
	jQuery('.blog_archive_header_type').on('change', function () {
		if (jQuery(this).val() === 'alternate') {
			jQuery('#blog_archive_show_title_bar').parents('.option').slideDown();
		} else {
			jQuery('#blog_archive_show_title_bar').parents('.option').slideUp();
		}
	});

	jQuery('.blog_archive_title_bar_bg_type').on('change', function () {
		if (jQuery(this).val() === 'image') {
			jQuery('#blog_archive_title_bar_bg_image').parents('.option').slideDown();
			jQuery('.blog_archive_title_bar_bg_image_option').parents('.option').slideDown();
			jQuery('[name=blog_archive_title_bar_bg_color]').parents('.option').slideUp();
		} else {
			jQuery('[name=blog_archive_title_bar_bg_color]').parents('.option').slideDown();
			jQuery('#blog_archive_title_bar_bg_image').parents('.option').slideUp();
			jQuery('.blog_archive_title_bar_bg_image_option').parents('.option').slideUp();
		}
	});

	jQuery('#blog_archive_show_title_bar').on('click', function () {
		if (jQuery(this).is(':checked')) {
			jQuery('#blog_archive_title_bar_content').slideDown();
		} else {
			jQuery('#blog_archive_title_bar_content').slideUp();
		}
	});

	// search results page (theme options)
	jQuery('.search_page_header_type').on('change', function () {
		if (jQuery(this).val() === 'alternate') {
			jQuery('#search_page_show_title_bar').parents('.option').slideDown();
		} else {
			jQuery('#search_page_show_title_bar').parents('.option').slideUp();
		}
	});

	jQuery('.search_page_title_bar_bg_type').on('change', function () {
		if (jQuery(this).val() === 'image') {
			jQuery('#search_page_title_bar_bg_image').parents('.option').slideDown();
			jQuery('.search_page_title_bar_bg_image_option').parents('.option').slideDown();
			jQuery('[name=search_page_title_bar_bg_color]').parents('.option').slideUp();
		} else {
			jQuery('[name=search_page_title_bar_bg_color]').parents('.option').slideDown();
			jQuery('#search_page_title_bar_bg_image').parents('.option').slideUp();
			jQuery('.search_page_title_bar_bg_image_option').parents('.option').slideUp();
		}
	});

	jQuery('#search_page_show_title_bar').on('click', function () {
		if (jQuery(this).is(':checked')) {
			jQuery('#search_page_title_bar_content').slideDown();
		} else {
			jQuery('#search_page_title_bar_content').slideUp();
		}
	});

	// car archive page (car settings)
	jQuery('.car_archive_header_type').on('change', function () {
		if (jQuery(this).val() === 'alternate') {
			jQuery('#car_archive_show_title_bar').parents('.option').slideDown();
		} else {
			jQuery('#car_archive_show_title_bar').parents('.option').slideUp();
		}
	});

	jQuery('.car_archive_title_bar_bg_type').on('change', function () {
		if (jQuery(this).val() === 'image') {
			jQuery('#car_archive_title_bar_bg_image').parents('.option').slideDown();
			jQuery('.car_archive_title_bar_bg_image_option').parents('.option').slideDown();
			jQuery('[name=car_archive_title_bar_bg_color]').parents('.option').slideUp();
		} else {
			jQuery('[name=car_archive_title_bar_bg_color]').parents('.option').slideDown();
			jQuery('#car_archive_title_bar_bg_image').parents('.option').slideUp();
			jQuery('.car_archive_title_bar_bg_image_option').parents('.option').slideUp();
		}
	});

	jQuery('#car_archive_show_title_bar').on('click', function () {
		if (jQuery(this).is(':checked')) {
			jQuery('#car_archive_title_bar_content').slideDown();
		} else {
			jQuery('#car_archive_title_bar_content').slideUp();
		}
	});

	// car producer archive page (car settings)
	jQuery('.car_producer_tax_header_type').on('change', function () {
		if (jQuery(this).val() === 'alternate') {
			jQuery('#car_producer_tax_show_title_bar').parents('.option').slideDown();
		} else {
			jQuery('#car_producer_tax_show_title_bar').parents('.option').slideUp();
		}
	});

	jQuery('.car_producer_tax_title_bar_bg_type').on('change', function () {
		if (jQuery(this).val() === 'image') {
			jQuery('#car_producer_tax_title_bar_bg_image').parents('.option').slideDown();
			jQuery('.car_producer_tax_title_bar_bg_image_option').parents('.option').slideDown();
			jQuery('[name=car_producer_tax_title_bar_bg_color]').parents('.option').slideUp();
		} else {
			jQuery('[name=car_producer_tax_title_bar_bg_color]').parents('.option').slideDown();
			jQuery('#car_producer_tax_title_bar_bg_image').parents('.option').slideUp();
			jQuery('.car_producer_tax_title_bar_bg_image_option').parents('.option').slideUp();
		}
	});

	jQuery('#car_producer_tax_show_title_bar').on('click', function () {
		if (jQuery(this).is(':checked')) {
			jQuery('#car_producer_tax_title_bar_content').slideDown();
		} else {
			jQuery('#car_producer_tax_title_bar_content').slideUp();
		}
	});

	jQuery(".similar_cars_params").sortable();

});

(function($){

	$(function(){

		$('.qs_widget_carlocation0').life('change', function(){
			var select = $('.qs_widget_carlocation1'),
				parent_id = $(this).val();

			if(parent_id !== ''){
				var data = {
					action: "app_cardealer_draw_locations_select",
					hide_empty: 0,
					parent_id: parent_id,
					selected: 0,
					container: false
				};
				jQuery.post(ajaxurl, data, function(responce) {
					temp = $('<span style="display: none"></span>');
					temp.appendTo('body').html(responce);
					select.html(temp.find('select').children());
					temp.empty();
				});
			}else{
				var default_option = select.find('option:first').eq(0);
				select.empty().append(default_option);
			}
			return false;
		});

		$('.qs_widget_checkbox').life('click', function(){
			if($(this).is(':checked')){
				$(this).siblings('select').addClass('hide');
			}else{
				$(this).siblings('select').removeClass('hide');
			}
		});

		$('.widget_dealer_type').life('change', function(){
			var select = $('.widget_specific_dealer'),
				data = {
					action: "app_cardealer_get_users_by_role",
					role: $(this).val()
				};

			jQuery.post(ajaxurl, data, function(responce) {
				var default_option = select.find('option:first-child').eq(0),
					options = '',
					responce = $.parseJSON(responce),
					i;

				for(i in responce){
					options += '<option value="' + responce[i]['ID'] + '">' + responce[i]['user_nicename'] + '</option>';
				}

				select.empty().html(options).prepend(default_option).trigger('change');
			});

			return false;
		});

		$('select[name=car_listing_thumbnail_size]').life('change', function(){
			var thumb_size = $(this).val(),
				items_per_page_select = $('select[name=car_listing_items_per_page]'),
				pagination_values = {
					'small':[6, 12, 18, 24, 30],
					'middle': [4, 8, 12, 16, 20, 24, 36],
					'large': [3, 6, 9, 12, 15, 30, 45, 60]
				},
				i,
				options = '';

			if (pagination_values[thumb_size]) {
				pagination_values = pagination_values[thumb_size];

				for (i in pagination_values) {
					options += '<option value="'+pagination_values[i]+'">'+pagination_values[i]+'</option>';
				}
			}

			items_per_page_select.empty().append(options);
		});

		jQuery('#show_layout_switcher').on('click', function() {
			if (jQuery(this).is(':checked')) {
				jQuery(this).parents('.section').next().hide();
			} else {
				jQuery(this).parents('.section').next().show();
			}
		});

	});

})(jQuery);


