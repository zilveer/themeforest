
(function ($) {

	$(function () {

		$('body').on('submit', '.widget_price_filter form', function () {
			var min_price = $(this).find('.price_slider_amount #min_price').val();
			var max_price = $(this).find('.price_slider_amount #max_price').val();
			mad_woof_current_values.min_price = min_price;
			mad_woof_current_values.max_price = max_price;
			mad_woof_ajax_page_num = 1;
			mad_woof_submit_link(mad_woof_get_submit_link());
			return false;
		});

		$('body').on('price_slider_change', function (event, min, max) {
			var min_price = $(this).find('.price_slider_amount #min_price').val();
			var max_price = $(this).find('.price_slider_amount #max_price').val();
			mad_woof_current_values.min_price = min_price;
			mad_woof_current_values.max_price = max_price;
		});

		mad_woof_remove_empty_elements();
		mad_woof_init_search_form();
		mad_woof_init_pagination();
		mad_woof_init_orderby();
		mad_woof_init_reset_button();
		mad_woof_shortcode_observer();

	});

})(jQuery);

function mad_woof_init_reset_button() {

	jQuery('body').on('click', '.woof_reset_search_form', function () {

		mad_woof_ajax_page_num = 1;

		if (mad_woof_is_permalink) {
			mad_woof_current_values = {};
			mad_woof_submit_link(mad_woof_get_submit_link().split("page/")[0]);
		} else {

			var link = mad_woof_shop_page;

			if (mad_woof_current_values.hasOwnProperty('page_id')) {
				link = location.protocol + '//' + location.host + "/?page_id=" + mad_woof_current_values.page_id;
				mad_woof_current_values = { 'page_id': mad_woof_current_values.page_id };
				mad_woof_get_submit_link();
			}

			mad_woof_submit_link(link);

			history.pushState({}, "", link);
			if (mad_woof_current_values.hasOwnProperty('page_id')) {
				mad_woof_current_values = {'page_id': mad_woof_current_values.page_id};
			} else {
				mad_woof_current_values = {};
			}
		}
		
		return false;
	});

}

function mad_woof_init_pagination() {

	jQuery('body').on('click', '.woocommerce-pagination ul.page-numbers a.page-numbers', function () {
		var l = jQuery(this).attr('href');

		if (mad_woof_ajax_first_done) {
			var res = l.split("paged=");

			if (res[1] !== undefined) {
				mad_woof_ajax_page_num = parseInt(res[1]);
			} else {
				mad_woof_ajax_page_num = 1;
			}
		} else {
			var res = l.split("page/");

			if (res[1] !== undefined) {
				mad_woof_ajax_page_num = parseInt(res[1]);
			} else {
				mad_woof_ajax_page_num = 1;
			}
		}

		mad_woof_submit_link(mad_woof_get_submit_link());

		setTimeout(function() {
			jQuery('html, body').stop().animate({
				scrollTop: 0
			}, 600);
		}, 50);

		return false;
	});

}

function mad_woof_init_orderby() {

	jQuery('.sort-param-order').on('click', 'a', function () {

		var $this = jQuery(this);
			$this.parent('li').siblings().children('a').removeClass("selected").end().end().end().addClass('selected');

		var orderby = $this.attr('href');

		mad_woof_current_values.orderby = orderby;

		switch(orderby) {
			case 'rating':
			case 'popularity':
				jQuery('.order-param-button a').attr('data-sort', 'desc');
				break;
		}

		mad_woof_ajax_page_num = 1;
		mad_woof_submit_link(mad_woof_get_submit_link());
		return false;
	});

	jQuery('.order-param-button').on('click', 'a', function () {

		var $this = jQuery(this),
			sort = $this.data('sort');

		if (sort == 'asc') {
			$this.removeClass('order-param-asc order-param-desc').addClass('order-param-desc');
			$this.data('sort', 'desc');
			mad_woof_ajax_order = 'desc';
			mad_woof_current_values.product_sort = 'desc';
		} else {
			$this.removeClass('order-param-asc order-param-desc').addClass('order-param-asc');
			$this.data('sort', 'asc');
			mad_woof_ajax_order = 'asc';
			mad_woof_current_values.product_sort = 'asc';
		}

		mad_woof_ajax_page_num = 1;
		mad_woof_submit_link(mad_woof_get_submit_link());
		return false;
	});

	jQuery('.sort-param-count').on('click', 'a', function () {

		var $this = jQuery(this),
			count = $this.attr('href');
		$this.parent('li').siblings().children('a').removeClass("selected").end().end().end().addClass('selected');

		mad_woof_current_values.product_count = count;
		mad_woof_ajax_per_page = count;

		mad_woof_ajax_page_num = 1;
		mad_woof_submit_link(mad_woof_get_submit_link());
		return false;
	});

}

function mad_woof_init_search_form() {

	mad_woof_init_checkboxes();
	mad_woof_init_colors();
	mad_woof_init_labels();
	mad_woof_init_selects();
	mad_woof_init_sku();
	mad_woof_init_text();

	var containers = jQuery('.woof_container');

	if (containers.length) {

		jQuery.each(containers, function (index, value) {

			var remove = false;

			if (jQuery(value).find('ul.woof_list_checkbox').size() === 1) {
				remove = true;
			}

			if (remove) {
				if (jQuery(value).find('ul.woof_list li').size() === 0) {
					jQuery(value).remove();
				}
			}

		});

	}

	jQuery('.woof_submit_search_form').click(function () {
		mad_woof_submit_link(mad_woof_get_submit_link());
		return false;
	});


	jQuery('ul.woof_childs_list').parent('li').addClass('woof_childs_list_li');

	mad_woof_checkboxes_slide();

}

function mad_woof_submit_link(link) {

	mad_woof_ajax_first_done = true;

	var data = {
		action: "woof_draw_products",
		link: link,
		page: mad_woof_ajax_page_num,
		per_page: mad_woof_ajax_per_page,
		order: mad_woof_ajax_order,
		shortcode: jQuery('#woof_results_by_ajax').data('shortcode'),
		woof_shortcode: jQuery('div.mad-woof').data('shortcode')
	};

	jQuery.ajax({
		type: 'POST',
		dataType: 'json',
		url: mad_woof_ajaxurl,
		data: data,
		beforeSend: function () {
			jQuery('.woof_shortcode_output').html('').addClass('mad-woof-loading');
		},
		success: function (data) {

			if ( data.fragments ) {
				jQuery('.woof_shortcode_output').html(jQuery(data.fragments));
			}

			if ( data.form ) {
				jQuery('div.woof_redraw_zone').replaceWith(jQuery(data.form).find('.woof_redraw_zone'));
			}

			mad_woof_remove_empty_elements();
			mad_woof_init_search_form();

			jQuery.mad_woocommerce_mod.raty();

			jQuery.each(jQuery('#woof_results_by_ajax'), function (index, item) {
				if (index == 0) { return; }

				jQuery(item).removeAttr('id');
			});

		},
		complete: function () {
			jQuery('.woof_shortcode_output').removeClass('mad-woof-loading');
		}
	});

}

function mad_woof_remove_empty_elements() {

	jQuery.each(jQuery('.woof_container select'), function (index, select) {
		var size = jQuery(select).find('option').size();
		if (size === 0) {
			jQuery(select).parents('.woof_container').remove();
		}
	});

	jQuery.each(jQuery('ul.woof_list_checkbox, ul.woof_list_color, ul.woof_list_label'), function (index, ch) {
		var size = jQuery(ch).find('li').size();
		if (size === 0) {
			jQuery(ch).parents('.woof_container').remove();
		}
	});

}

function mad_woof_get_submit_link() {

	mad_woof_current_values.page = mad_woof_ajax_page_num;

	if (Object.keys(mad_woof_current_values).length > 0) {
		jQuery.each(mad_woof_current_values, function (index, value) {
			if (index == mad_swoof_search_slug) {
				delete mad_woof_current_values[index];
			}
			if (index == 's') {
				delete mad_woof_current_values[index];
			}
			if (index == 'product') {
				//for single product page (when no permalinks)
				delete mad_woof_current_values[index];
			}
			if (index == 'really_curr_tax') {
				delete mad_woof_current_values[index];
			}
		});
	}

	if (Object.keys(mad_woof_current_values).length === 2) {
		if (('min_price' in mad_woof_current_values) && ('max_price' in mad_woof_current_values)) {
			var l = mad_woof_current_page_link + '?min_price=' + mad_woof_current_values.min_price + '&max_price=' + mad_woof_current_values.max_price;
			history.pushState({}, "", l);
			return l;
		}
	}

	if (Object.keys(mad_woof_current_values).length === 0) {
		history.pushState({}, "", mad_woof_current_page_link);
		return mad_woof_current_page_link;
	}

	if (Object.keys(mad_woof_really_curr_tax).length > 0) {
		mad_woof_current_page_link['really_curr_tax'] = mad_woof_really_curr_tax.term_id + '-' + mad_woof_really_curr_tax.taxonomy;
	}

	var link = mad_woof_current_page_link + "?" + mad_swoof_search_slug + "=1";

	if (!mad_woof_is_permalink) {

		link = location.protocol + '//' + location.host + "?" + mad_swoof_search_slug + "=1";

		if (mad_woof_current_values.hasOwnProperty('page_id')) {
			link = location.protocol + '//' + location.host + "?" + mad_swoof_search_slug + "=1";
		}
	}

	var mad_woof_exclude_accept_array = ['path'];

	if (Object.keys(mad_woof_current_values).length > 0) {
		jQuery.each(mad_woof_current_values, function (index, value) {
			if (index == 'page') {
				index = 'paged';
			}
			if (typeof value !== 'undefined') {
				if ((typeof value && value.length > 0) || typeof value == 'number') {
					if (jQuery.inArray(index, mad_woof_exclude_accept_array) == -1) {
						link = link + "&" + index + "=" + value;
					}
				}
			}

		});
	}

	link = link.replace(new RegExp(/page\/(\d+)\//), "");
	history.pushState({}, "", link);

	return link;
}

function mad_woof_shortcode_observer() {

	if (jQuery('.woof_shortcode_output').length) {
		mad_woof_current_page_link = location.protocol + '//' + location.host + location.pathname;
	}
}

function mad_woof_checkboxes_slide() {

	var childs = jQuery('ul.woof_childs_list');

		if (childs.length) {

			jQuery.each(childs, function (index, ul) {
				var span_class = 'woof_is_closed';
				if (jQuery(ul).find('input[type=checkbox]').is(':checked')) {
					jQuery(ul).slideDown(400);
					span_class = 'woof_is_opened';
				}

				jQuery(ul).before('<a href="javascript:void(0);" class="woof_childs_list_opener"><span class="' + span_class + '"></span></a>');
			});

			jQuery.each(jQuery('a.woof_childs_list_opener'), function (index, a) {
				jQuery(a).click(function () {
					var span = jQuery(this).find('span');
					if (span.hasClass('woof_is_closed')) {
						jQuery(this).parent().find('ul.woof_childs_list').first().stop(true, true).slideDown(400);
						span.removeClass('woof_is_closed');
						span.addClass('woof_is_opened');
					} else {
						jQuery(this).parent().find('ul.woof_childs_list').first().stop(true, true).slideUp(400);
						span.removeClass('woof_is_opened');
						span.addClass('woof_is_closed');
					}
					return false;
				});
			});

		}

}

/* Checkboxes Modification
/* --------------------------------------------- */

function mad_woof_init_checkboxes() {

	jQuery('.woof_checkbox_term').on('change', function (event) {
		if (jQuery(this).is(':checked')) {
			jQuery(this).attr("checked", true);
			mad_woof_checkbox_process_data(this, true);
		} else {
			jQuery(this).attr("checked", false);
			mad_woof_checkbox_process_data(this, false);
		}
	});

}

function mad_woof_checkbox_process_data(_this, is_checked) {
	var tax = jQuery(_this).data('tax'),
		name = jQuery(_this).attr('name');
	mad_woof_checkbox_direct_search(name, tax, is_checked);
}

function mad_woof_checkbox_direct_search(name, tax, is_checked) {

	var values = '';

	if (is_checked) {
		if (tax in mad_woof_current_values) {
			mad_woof_current_values[tax] = woof_current_values[tax] + ',' + name;
		} else {
			mad_woof_current_values[tax] = name;
		}
		jQuery('.woof_checkbox_term[name=' + name + ']').attr('checked', true);
	} else {
		values = mad_woof_current_values[tax];
		values = values.split(',');
		var tmp = [];
		jQuery.each(values, function (index, value) {
			if (value != name) {
				tmp.push(value);
			}
		});
		values = tmp;

		if (values.length) {
			mad_woof_current_values[tax] = values.join(',');
		} else {
			delete mad_woof_current_values[tax];
		}
		jQuery('.woof_checkbox_term[name=' + name + ']').attr('checked', false);
	}

	mad_woof_ajax_page_num = 1;
	mad_woof_submit_link(mad_woof_get_submit_link());
}

/* Label Modification
/* --------------------------------------------- */


function mad_woof_init_labels() {

	jQuery('.woof_label_term').each(function () {

		var span = jQuery('<span class="' + jQuery(this).attr('type') + ' ' + jQuery(this).attr('class') + '">' + jQuery(this).data('name') +'</span>').click(mad_woof_label_do_check);

		if (jQuery(this).is(':checked')) {
			span.addClass('checked');
		}
		jQuery(this).wrap(span).hide();

	});

	function mad_woof_label_do_check() {

		var is_checked = false;
		if (jQuery(this).hasClass('checked')) {
			jQuery(this).removeClass('checked');
			jQuery(this).children().prop("checked", false);
		} else {
			jQuery(this).addClass('checked');
			jQuery(this).children().prop("checked", true);
			is_checked = true;
		}

		mad_woof_label_process_data(this, is_checked);

	}

}

function mad_woof_label_process_data(_this, is_checked) {
	var tax = jQuery(_this).find('input[type=checkbox]').data('tax'),
		name = jQuery(_this).find('input[type=checkbox]').attr('name');
	mad_woof_label_direct_search(name, tax, is_checked);
}

function mad_woof_label_direct_search(name, tax, is_checked) {

	var values = '';

	if (is_checked) {
		if (tax in mad_woof_current_values) {
			mad_woof_current_values[tax] = mad_woof_current_values[tax] + ',' + name;
		} else {
			mad_woof_current_values[tax] = name;
		}
		jQuery('.woof_label_term[name=' + name + ']').attr('checked', true);
	} else {
		values = mad_woof_current_values[tax];
		values = values.split(',');
		var tmp = [];
		jQuery.each(values, function (index, value) {
			if (value != name) {
				tmp.push(value);
			}
		});
		values = tmp;
		if (values.length) {
			mad_woof_current_values[tax] = values.join(',');
		} else {
			delete mad_woof_current_values[tax];
		}
		jQuery('.woof_label_term[name=' + name + ']').attr('checked', false);
	}

	mad_woof_ajax_page_num = 1;
	mad_woof_submit_link(mad_woof_get_submit_link());
}

/* Colors Modification
/* --------------------------------------------- */

function mad_woof_init_colors() {

	jQuery('.woof_color_term').each(function () {
		var span = jQuery('<span style="background-color:' + jQuery(this).data('color') + '" class="woof-color ' + jQuery(this).attr('type') + ' ' + jQuery(this).attr('class') + '"></span>').click(mad_woof_color_do_check);

		if (jQuery(this).is(':checked')) {
			span.addClass('checked');
		}
		jQuery(this).wrap(span).hide();
	});

	function mad_woof_color_do_check() {
		var is_checked = false;
		if (jQuery(this).hasClass('checked')) {
			jQuery(this).removeClass('checked');
			jQuery(this).children().prop("checked", false);
		} else {
			jQuery(this).addClass('checked');
			jQuery(this).children().prop("checked", true);
			is_checked = true;
		}

		mad_woof_color_process_data(this, is_checked);
	}

}

function mad_woof_color_process_data(_this, is_checked) {
	var tax = jQuery(_this).find('input[type=checkbox]').data('tax');
	var name = jQuery(_this).find('input[type=checkbox]').attr('name');
	mad_woof_color_direct_search(name, tax, is_checked);
}

function mad_woof_color_direct_search(name, tax, is_checked) {

	var values = '';

	if (is_checked) {
		if (tax in mad_woof_current_values) {
			mad_woof_current_values[tax] = mad_woof_current_values[tax] + ',' + name;
		} else {
			mad_woof_current_values[tax] = name;
		}
		jQuery('.woof_color_term[name=' + name + ']').attr('checked', true);
	} else {
		values = mad_woof_current_values[tax];
		values = values.split(',');
		var tmp = [];
		jQuery.each(values, function (index, value) {
			if (value != name) {
				tmp.push(value);
			}
		});
		values = tmp;
		if (values.length) {
			mad_woof_current_values[tax] = values.join(',');
		} else {
			delete mad_woof_current_values[tax];
		}
		jQuery('.woof_color_term[name=' + name + ']').attr('checked', false);
	}

	mad_woof_ajax_page_num = 1;
	mad_woof_submit_link(mad_woof_get_submit_link());
}

/* Selects Modification
/* --------------------------------------------- */

function mad_woof_init_selects() {

	if (jQuery('select.mad_woof_select, select.woof_price_filter_dropdown').length) {
		jQuery("select.mad_woof_select, select.woof_price_filter_dropdown")
			.chosen({disable_search_threshold: 10})
			.change(function () {
				var slug = jQuery(this).val();
				var name = jQuery(this).attr('name');
				mad_woof_select_direct_search(name, slug);
			});
	}

}

function mad_woof_select_direct_search(name, slug) {

	jQuery.each(mad_woof_current_values, function (index, value) {
		if (index == name) {
			delete mad_woof_current_values[name];
			return;
		}
	});

	if (slug != 0) {
		mad_woof_current_values[name] = slug;
	}

	mad_woof_ajax_page_num = 1;
	mad_woof_submit_link(mad_woof_get_submit_link());
}

function mad_woof_init_sku() {

	jQuery('.mad_woof_show_sku_search').on('keyup', function (e) {
		var val = jQuery(this).val();

		if (val.length > 3) {
			if (e.keyCode == 13) {
				mad_woof_direct_search('mad_woof_sku', val);
				return true;
			}
		}
	});

}

function mad_woof_init_text() {

	jQuery('.mad_woof_show_text_search').on('keyup', function (e) {
		var val = jQuery(this).val();

		if (val.length > 3) {
			if (e.keyCode == 13) {
				mad_woof_direct_search('mad_woof_text', val);
				return true;
			}
		}
	});

}

function mad_woof_direct_search(name, slug) {

	jQuery.each(mad_woof_current_values, function (index, value) {
		if (index == name) {
			delete mad_woof_current_values[name];
			return;
		}
	});

	if (slug != 0) {
		mad_woof_current_values[name] = slug;
	}

	mad_woof_ajax_page_num = 1;
	mad_woof_submit_link(mad_woof_get_submit_link());
}