var show_delay = 777;
var hide_delay = 333;

show_static_info_popup(lang_loading);

jQuery(function () {
    
    jQuery.fn.life = function (types, data, fn) {
		jQuery(this.context).on(types, this.selector, data, fn);
		return this;
	};

	jQuery('body').prepend('<div id="html_buffer"></div>');

	colorizator();

	draw_ui_slider_items();
	jQuery("#theme_options").show(show_delay, function () {
		hide_static_info_popup();
	});

	//loader
	try {
		jQuery("#fancy_loader_link").fancybox({
			'autoScale': false,
			'closeClick': false,
			'showCloseButton': false,
			'enableEscapeButton': false,
			'hideOnOverlayClick': false,
			'hideOnContentClick': false
		});
	} catch (e) {

	}
	//***


	jQuery('.button_upload').life('click', function () {
		get_tb_editor_image_link(jQuery(this).prev('input, textarea'));
		return false;
	});

	jQuery('.button_upload_audio').life('click', function()
	{
		get_tb_editor_audio_link(jQuery(this).prev('input, textarea'));
		return false;
	});

	jQuery('.button_upload_video').life('click', function()
	{
		get_tb_editor_video_link(jQuery(this).prev('input, textarea'));
		return false;
	});

	/* ---------------------------------------------------------------------- */
	/*	Preload Images
	 /* ---------------------------------------------------------------------- */

	jQuery.fn.autoload = function () {
		var attachment = jQuery('.add-border');
		var t = attachment.length,
			i = 0;
		var init = setInterval(function () {
			attachment.eq(i).find('img').fadeIn(500).css({
				opacity: 1
			});
			i++;
			if (i == t) {
				clearInterval(init);
				delete init
			}
		}, 200)
	}

	jQuery(window).on("load", function () {
		jQuery.fn.autoload();
	})


	jQuery.each(jQuery('.colorpicker_input'), function (i, val) {
		var item = jQuery(this);
		//item.children('div').css('background-color', item.prev('input').val());
		jQuery(item).ColorPicker({
			color: item.val(),
			onShow: function (cpicker) {
				jQuery(cpicker).fadeIn(500);
				return false;
			},
			onHide: function (cpicker) {
				jQuery(cpicker).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				//item.children('div').css('background-color', '#' + hex);
				//item.prev('input').val('#' + hex);

				item.val('#' + hex);
			}
		});
	});

	//*****

	//option_checkbox
	jQuery(".option_checkbox").life('click', function () {
		if (jQuery(this).is(":checked")) {
			jQuery(this).prev("input[type=hidden]").val(1);
			jQuery(this).val(1);
		} else {
			jQuery(this).prev("input[type=hidden]").val(0);
			jQuery(this).val(0);
		}
	});

	jQuery(".admin-choice-sidebar").on("click", "a", function (e) {
		var self = jQuery(this), hidden, data_val;

		if(self.parents('.admin-choice-sidebar').hasClass('admin-product-sidebar')){
			hidden = jQuery(".product_sidebar_position");
		}else{
			hidden = jQuery("[name=sidebar_position]");
		}
		data_val = self.parent().attr('data-val');
		hidden.val(data_val);

		self.parent().siblings().removeClass("current-item");
		self.parent().addClass("current-item");

		e.preventDefault();
	});

	jQuery(".admin-car-choice-sidebar").on("click", "a", function (e) {
		var self = jQuery(this), hidden, data_val;
		hidden = jQuery("[name=single_car_sidebar_position]");
		data_val = self.parent().attr('data-val');
		hidden.val(data_val);

		self.parent().siblings().removeClass("current-item");
		self.parent().addClass("current-item");

		e.preventDefault();
	});
	jQuery(".admin-page-choice-sidebar").on("click", "a", function (e) {
		var self = jQuery(this), hidden, data_val;
		hidden = jQuery("[name=page_sidebar_position]");
		data_val = self.attr('data-val');
		hidden.val(data_val);

		self.parent().siblings().removeClass("current-item");
		self.parent().addClass("current-item");

		e.preventDefault();
	});

	jQuery("#watermark_image").on("change", function () {
		var src = jQuery(this).val(),
			img = jQuery(".watermark_image");

		if(src === ''){
			src = img.data('default');
		}
		img.attr('src', src);
	});

	//for events
	var event_link = jQuery('.wp-submenu-wrap a[href$="?post_type=event"]').eq(0);
	jQuery(event_link).attr('href', jQuery(event_link).attr('href') + "&orderby=ev_mktime&order=desc");

	/* dissmiss admin notices */
	jQuery(".is-dismissible").on("click", '.notice-dismiss', function (e) {

		var type = jQuery(this).parents('.notice').attr('class');

		var data = {
			action: 'tmm_dismiss_notice',
			type: type
		}

		jQuery.post(ajaxurl, data, function () {});

	});

});


function draw_ui_slider_items() {

	var items = jQuery(".ui_slider_item");
	var template = jQuery("#ui_slider_item").html();

	jQuery.each(items, function (key, item) {
		var max_value = parseInt(jQuery(item).attr('max-value'), 10);
		var min_value = parseInt(jQuery(item).attr('min-value'), 10);
		var name = jQuery(item).attr('name');
		var value = parseFloat(jQuery(item).attr('value'), 10);
		if (!value) {
			value = 0;
		}

		var html = template;
		//*****
		html = html.replace(/__UI_SLIDER_NAME__/gi, name);
		html = html.replace(/__UI_SLIDER_VALUE__/gi, value);
		jQuery(item).replaceWith(html);

		jQuery("#" + name + " .range-amount-value").val(value);
		jQuery("#" + name + " .range-amount-value-hidden").val(value);

		var slider = jQuery("." + name).slider({
			range: "max",
			animate: true,
			value: parseFloat(value, 10),
			step: 1,
			min: parseInt(min_value, 10),
			max: parseInt(max_value, 10),
			slide: function (event, ui) {
				jQuery("#" + name + " .range-amount-value").val(ui.value);
				jQuery("#" + name + " .range-amount-value-hidden").val(ui.value);
			}
		});


		jQuery("#" + name + " .range-amount-value").life('change', function () {
			var value = parseFloat(jQuery(this).val(), 10);
			slider.slider("value", value);
			jQuery("#" + name + " .range-amount-value-hidden").val(value);
		});


	});


}


function show_info_popup(text) {
	jQuery(".info_popup").text(text);
	jQuery(".info_popup").fadeTo(400, 0.9);
	window.setTimeout(function () {
		jQuery(".info_popup").fadeOut(400);
	}, 1000);
}


function show_static_info_popup(text) {
	jQuery(".info_popup").html(text);
	jQuery(".info_popup").fadeTo(400, 0.9);
}

function hide_static_info_popup() {
	window.setTimeout(function () {
		jQuery(".info_popup").fadeOut(400);
	}, hide_delay);
}

function get_tb_editor_image_link(input_object, input_object2) {
	var frame = wp.media({
            title: wp.media.view.l10n.chooseImage,
            multiple: false,
            library: { type: 'image' }
            //button : { text : 'Insert' }
        });

    frame.on( 'select', function() {
        var selection = frame.state().get('selection');
        selection.each(function(attachment) {
            var url = attachment.attributes.url;
            input_object.val(url).trigger('change');
            if (input_object2 != undefined) {
                input_object2.val(url);
            }
        });
    });

    frame.open();
}

function get_tb_editor_audio_link(input_object, input_object2) {
	var frame = wp.media({
		title: wp.media.view.l10n.audioAddSourceTitle,
		multiple: false,
		library: { type: 'audio' }
	});

	frame.on( 'select', function() {
		var selection = frame.state().get('selection');
		selection.each(function(attachment) {
			var url = attachment.attributes.url;
			input_object.val(url).trigger('change');
			if (input_object2 != undefined) {
				input_object2.val(url);
			}
		});
	});

	frame.open();
}

function get_tb_editor_video_link(input_object, input_object2) {
	var frame = wp.media({
		title: wp.media.view.l10n.videoAddSourceTitle,
		multiple: false,
		library: { type: 'video' }
	});

	frame.on( 'select', function() {
		var selection = frame.state().get('selection');
		selection.each(function(attachment) {
			var url = attachment.attributes.url;
			input_object.val(url).trigger('change');
			if (input_object2 != undefined) {
				input_object2.val(url);
			}
		});
	});

	frame.open();
}

//for unique values
function get_time_miliseconds() {
	var d = new Date();
	return d.getTime();
}

function add_google_font() {
	show_loader();
	var data = {
		action: "get_new_google_fonts"
	};
	jQuery.post(ajaxurl, data, function (response) {
		var response = jQuery.parseJSON(response);
		//***
		var fonts = jQuery.parseJSON(response.new_fonts);
		var saved_fonts = jQuery.parseJSON(response.saved_fonts);
		//***
		var list = jQuery("#google_font_set ul");
		jQuery(list).empty();
		var html = "";
		jQuery.each(fonts.items, function (index, value) {
			html = "<li><table><tr>";
			html = html + '<td width=300><strong>' + value.family + '</strong>:</td><td>';

			jQuery.each(value.variants, function (index2, variant) {
				var checked = "";
				if (is_font_checked(value.family, variant)) {
					checked = 'checked=""';
				}

				html = html + '<input ' + checked + ' type="checkbox" class="option_checkbox" name="saved_google_fonts[' + value.family + '][' + variant + ']" value="1" />&nbsp;' + variant + '&nbsp;&nbsp;'
			});

			html = html + "</td></tr></table></li>";
			jQuery(list).append(html);
		});

		//***
		var dialog = jQuery("#google_font_set");

		jQuery(dialog).dialog({
			autoOpen: false,
			width: 800,
			height: 600,
			//position: [200, 200],
			zIndex: 1001,
			stack: true,
			title: "Google fonts manager",
			buttons: {
				"Save": function () {
					var data = {
						action: "save_google_fonts",
						values: jQuery("#google_font_set input:checked").serialize()
					};
					jQuery.post(ajaxurl, data, function (response) {
						var data = {
							action: "get_google_fonts"
						};
						//refresh selects with google fonts
						jQuery.post(ajaxurl, data, function (response) {
							var google_fonts = jQuery.parseJSON(response);
							var selects = jQuery(".google_font_select");
							//***
							jQuery.each(selects, function (index, select) {
								var current_select_font = jQuery(this).find("option:selected").eq(0).val();
								jQuery(this).empty();
								//***
								var _this = this;
								jQuery.each(google_fonts, function (i, font) {
									var val = font.split(':');
									val = val[0];
									jQuery(_this).append(new Option(font, val));
								});
								jQuery(this).val(current_select_font);
							});
							//***
							show_info_popup(response);
						});
					});
					//***
					jQuery(this).dialog("close");
				},
				"Cancel": function () {
					jQuery(this).dialog("close");
				}
			},
			close: function (event, ui) {
				jQuery(this).dialog("destroy");
			},
			open: function (event, ui) {

			}
		});
		jQuery(dialog).dialog('open');

		//just needs only here
		function is_font_checked(font_name, variant) {
			var is_checked = false;
			if (saved_fonts != null) {
				if (typeof saved_fonts === 'object') {
					jQuery.each(saved_fonts, function (font, types) {
						if (font == font_name) {
							jQuery.each(types, function (type, val) {
								if (type == variant) {
									is_checked = true;
								}
							});
						}

					});
				}
			}
			return is_checked;
		}

		//***
		hide_loader();
	});
}

function uniqid() {
	var uniqid = Math.random() * get_time_miliseconds();
	return Math.round(uniqid);
}

function show_loader() {
	jQuery("#fancy_loader_link").trigger('click');
}

function hide_loader() {
	jQuery.fancybox.close();
}

function gmt_init_map(Lat, Lng, map_canvas_id, zoom, maptype, info, show_marker, show_popup, scrollwheel) {
	var latLng = new google.maps.LatLng(Lat, Lng);
	var homeLatLng = new google.maps.LatLng(Lat, Lng);

	switch (maptype) {
		case "SATELLITE":
			maptype = google.maps.MapTypeId.SATELLITE;
			break;

		case "HYBRID":
			maptype = google.maps.MapTypeId.HYBRID;
			break;

		case "TERRAIN":
			maptype = google.maps.MapTypeId.TERRAIN;
			break;

		default:
			maptype = google.maps.MapTypeId.ROADMAP;
			break;

	}

	var map;
	map = new google.maps.Map(document.getElementById(map_canvas_id), {
		zoom: zoom,
		center: latLng,
		mapTypeId: maptype,
		scrollwheel: scrollwheel
	});


	if (show_marker) {
		var marker = new google.maps.Marker({
			position: homeLatLng,
			draggable: true,
			map: map
		});
	}

	google.maps.event.addListener(marker, "dragend", function () {
		jQuery("#event_map_latitude").val(marker.position.lat());
		jQuery("#event_map_longitude").val(marker.position.lng());
	});

	google.maps.event.addListener(map, "zoom_changed", function () {
		jQuery("#event_map_zoom").val(map.zoom);
	});

}


function colorizator() {
	var pickers = jQuery('.bgpicker');

	jQuery.each(pickers, function (key, picker) {

		var bg_hex_color = jQuery(picker).next('.bg_hex_color');

		if (!jQuery(bg_hex_color).val()) {
			jQuery(bg_hex_color).val();
		}

		jQuery(picker).css('background-color', jQuery(bg_hex_color).val()).ColorPicker({
			color: jQuery(bg_hex_color).val(),
			onChange: function (hsb, hex, rgb) {
				jQuery(picker).css('backgroundColor', '#' + hex);
				jQuery(bg_hex_color).val('#' + hex);
				jQuery(bg_hex_color).trigger('change');
			}
		});

	});
}


//for dynamic html
function items_colorizator(in_container) {
	var pickers = jQuery(in_container).find('.bgpicker');
	jQuery.each(pickers, function (key, picker) {

		var bg_hex_color = jQuery(picker).prev('.bg_hex_color');

		if (!jQuery(bg_hex_color).val()) {
			jQuery(bg_hex_color).val();
		}

		jQuery(picker).css('background-color', jQuery(bg_hex_color).val()).ColorPicker({
			color: jQuery(bg_hex_color).val(),
			onChange: function (hsb, hex, rgb) {
				jQuery(picker).css('backgroundColor', '#' + hex);
				jQuery(bg_hex_color).val('#' + hex);
				jQuery(bg_hex_color).trigger('change');
			}
		});

	});
}

function insert_html_in_buffer(html) {
	jQuery("#html_buffer").html(html);
}
