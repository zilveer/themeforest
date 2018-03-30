/**
 * Created by hoantv on 2015-03-26.
 */
(function($) {
	"use strict";
	var XMENU = {
		initialize: function() {
			XMENU.add_xmenu_to_wpmenu();
			XMENU.event();
			XMENU.scroll_panel_right(true);
			XMENU.process_media();
		},

		add_xmenu_to_wpmenu: function() {
			$('ul.menu > li.menu-item').each(function(){
				var menu_id = parseInt($(this).attr('id').replace('menu-item-',''), 10);
				$('> .menu-item-bar > .menu-item-handle > span.item-title > span.menu-item-title', this).append('<span class="xmenu-item-config" data-id="' + menu_id + '"><i class="fa fa-cogs"></i> XMENU <i class="fa fa-warning"></i></span>');
			});
			$('ul.menu > li.menu-item .xmenu-item-config').click(function(){
				var menu_id = parseInt($(this).attr('data-id'), 10);
				XMENU.open_xmenu_panel(menu_id);
			});
		},
		open_xmenu_panel: function(menu_id) {
			if ($('.xmenu-header .xmenu-config-panel-save > i').hasClass('fa-spinner')) {
				return;
			}
			$('.xmenu-config-panel-wrapper').attr('data-id', menu_id);
			var menu_item = xmenu_menu_item_data[menu_id];
			if (menu_item['nosave-change'] == 1) {
				$('.xmenu-header .xmenu-config-panel-save i').attr('class','fa fa-warning');
			}
			else {
				$('.xmenu-header .xmenu-config-panel-save i').attr('class','fa fa-save');
			}
			$('.xmenu-header > h2 > span').html(menu_item['general-title']);
			for (var key in menu_item) {
				var $menu_data = $('#xmenu_config_' + key);
				if ($menu_data.length > 0) {
					if ($menu_data.hasClass('x-checkbox')) {
						$menu_data.prop( "checked", menu_item[key] == $menu_data.val());
					}
					else {
						$menu_data.val(menu_item[key]);
					}
					if ($menu_data.hasClass('x-icon')) {
						$('> i', $($menu_data).parent()).attr('class','fa ' + menu_item[key]);
					}
				}

				if ($menu_data.hasClass('x-color-picker')) {
					$('.wp-color-result',$menu_data.parent().parent()).css('background-color',menu_item[key]);
				}
			}
			if (menu_item['nosave-type'] != 'custom') {
				$('#xmenu_config_general-url').attr('readonly','');
			}
			else {
				$('#xmenu_config_general-url').removeAttr('readonly');
			}
			if (!$('.xmenu-config-panel-wrapper').hasClass('in')) {
				XMENU.show_xmenu_panel();
			}
		},
		show_xmenu_panel: function() {
			$('.xmenu-config-panel-wrapper').addClass('in');
		},
		hide_xmenu_panel: function() {
			$('.xmenu-icon-popup').fadeOut();
			$('.xmenu-config-panel-wrapper').removeClass('in');
		},
		event: function() {
			XMENU.rel_section_click();
			XMENU.xmenu_config_panel_close_click();
			XMENU.xmenu_icon_popup_event();
			XMENU.wp_color_picker();
			XMENU.wp_input_change();
			XMENU.window_keyup();
			XMENU.save_config_panel();
			XMENU.reset();
		},
		reset: function() {
			$('.xmenu-config-panel-wrapper li.x-reset').click(function(){

				var menu_id = $('.xmenu-config-panel-wrapper').attr('data-id');

				$('> i', this).attr('class','fa fa-spinner fa-spin');
				var menu_item = xmenu_menu_item_data[menu_id];

				for (var key in xmenu_menu_item_default) {
					if ((key.indexOf('nosave-') === 0) || (key.indexOf('general-') === 0)) continue;
					menu_item[key] = xmenu_menu_item_default[key];
				}

				for (var key in menu_item) {
					var $menu_data = $('#xmenu_config_' + key);
					if ($menu_data.length > 0) {
						if ($menu_data.hasClass('x-checkbox')) {
							$menu_data.prop( "checked", menu_item[key] == $menu_data.val());
						}
						else {
							$menu_data.val(menu_item[key]);
						}
						if ($menu_data.hasClass('x-icon')) {
							$('> i', $($menu_data).parent()).attr('class','fa ' + menu_item[key]);
						}
					}

					if ($menu_data.hasClass('x-color-picker')) {
						$('.wp-color-result',$menu_data.parent().parent()).css('background-color',menu_item[key]);
					}
				}
				$('> i', this).attr('class','fa fa-refresh');
				$('.xmenu-header .xmenu-config-panel-save i').attr('class','fa fa-warning');
				$('span.menu-item-title .xmenu-item-config[data-id="' + menu_id + '"]').addClass('is-change');
			});
		},
		save_config_panel: function() {
			$('.xmenu-header .xmenu-config-panel-save').click(function() {
				if ($('.xmenu-header .xmenu-config-panel-save > i').hasClass('fa-spinner')) {
					return;
				}
				$('> i', this).attr('class','fa fa-spinner fa-spin');
				$('.xmenu-config-panel-right').addClass('xmenu-saving');

				var menu_id = $('.xmenu-config-panel-wrapper').attr('data-id');
				var data_post = {
					id: menu_id,
					config: xmenu_menu_item_data[menu_id],
					action:'xmenu_save_config'
				};
				var $this = $(this);
				$.ajax({
					url:xmenu_meta.ajax_url,
					type   : 'POST',
					data   : data_post,
					dataType : 'json',
					success: function(data) {
						$('.xmenu-config-panel-right').removeClass('xmenu-saving');
						if (data.code < 0) {
							$('> i', $this).attr('class','fa fa-save');
							alert(data.message);
							return;
						}
						xmenu_menu_item_data[menu_id]['nosave-change'] = 0;
						$('span.menu-item-title .xmenu-item-config[data-id="' + menu_id + '"]').removeClass('is-change');
						$('> i', $this).attr('class','fa fa-check');
						//set menu value
						if (xmenu_menu_item_data[menu_id]['nosave-type'] == 'custom') {
							$('#edit-menu-item-url-' + menu_id).val(xmenu_menu_item_data[menu_id]['general-url']);
						}
						$('#edit-menu-item-title-' + menu_id).val(xmenu_menu_item_data[menu_id]['general-title']);
						$('#edit-menu-item-attr-title-' + menu_id).val(xmenu_menu_item_data[menu_id]['general-attr-title']);
						$('#edit-menu-item-classes-' + menu_id).val(xmenu_menu_item_data[menu_id]['general-classes']);
						$('#edit-menu-item-xfn-' + menu_id).val(xmenu_menu_item_data[menu_id]['general-xfn']);
						$('#edit-menu-item-description-' + menu_id).val(xmenu_menu_item_data[menu_id]['general-description']);
						$('#edit-menu-item-target-' + menu_id).prop( "checked", xmenu_menu_item_data[menu_id]['general-target'] == $('#edit-menu-item-target-' + menu_id).val());
					},
					error: function(data) {
						$('.xmenu-config-panel-right').removeClass('xmenu-saving');
						$('> i', $this).attr('class','fa fa-warning');
					}
				})
			});
		},
		xmenu_config_panel_close_click: function() {
			$('.xmenu-header > h2 .xmenu-config-panel-close').click(function(){
				XMENU.hide_xmenu_panel();
			});
		},
		window_keyup: function() {
			$(window).keyup(function(e){
				var code = (e.keyCode ? e.keyCode : e.which);
				if (code == 27) {
					if ($('.xmenu-config-panel-wrapper').hasClass('in')) {
						XMENU.hide_xmenu_panel();
					}
					else {
						var menu_id = $('.xmenu-config-panel-wrapper').attr('data-id');
						if (typeof (menu_id) != "undefined") {
							XMENU.show_xmenu_panel();
						}
					}

				}
			});
		},
		wp_input_change: function() {
			$('.x-input').change(function(){
				XMENU.process_input_change(this);
			});
		},
		wp_color_picker: function() {
			$('.xmenu-config-panel-wrapper').find( '.x-color-picker' ).wpColorPicker({
				'change': function(event, data, ui){
					setTimeout(function(){
						XMENU.process_input_change(event.target);
					}, 200)

				},
				'clear': function(event, data, ui){
					setTimeout(function(){
						XMENU.process_input_change($('.x-input', $(event.target).parent())[0]);
					}, 200)
				}
			});
		},

		process_input_change: function(target){
			var menu_id = $('.xmenu-config-panel-wrapper').attr('data-id');
			xmenu_menu_item_data[menu_id]['nosave-change'] = 1;
			$('.xmenu-header .xmenu-config-panel-save i').attr('class','fa fa-warning');
			$('span.menu-item-title .xmenu-item-config[data-id="' + menu_id + '"]').addClass('is-change');
			var item_name = $(target).attr('name');
			if ($(target).hasClass('x-checkbox')) {
				xmenu_menu_item_data[menu_id][item_name] = $(target).prop( "checked" ) ? $(target).val() : '';
			}
			else {
				xmenu_menu_item_data[menu_id][item_name] = $(target).val();
			}
		},

		scroll_panel_right: function(isInit) {
			var panel_content_height = $('.xmenu-config-panel-right-inner').outerHeight();
			var panel_wrapper_height = $('.xmenu-config-panel-right').height();
			var panel_scroll_height = $('.xmenu-panel-scroll-wrapper').height() - 2;
			$('.xmenu-config-panel-right-inner').css('top', '0');
			if (panel_content_height > panel_wrapper_height) {
				$('.xmenu-config-panel-right').addClass('show-scroll');
				$('.xmenu-panel-drag').height( ((panel_wrapper_height * 1.0 /panel_content_height) * panel_scroll_height) + 'px');
				$('.xmenu-panel-drag').css('top','0');
			}
			else {
				$('.xmenu-config-panel-right').removeClass('show-scroll');
			}

			if (isInit) {
				$('.xmenu-panel-drag').draggable({
					axis: "y", containment: "parent",
					drag: function () {
						var panel_content_height = $('.xmenu-config-panel-right-inner').outerHeight();
						var panel_wrapper_height = $('.xmenu-config-panel-right').height();
						var panel_scroll_height = $('.xmenu-panel-scroll-wrapper').height() - 2;

						var top_drag = $('.xmenu-panel-drag').position().top;
						var drag_height = $('.xmenu-panel-drag').height();
						var top_panel_content = (panel_wrapper_height - panel_content_height) * top_drag * 1.0 / (panel_scroll_height - drag_height);
						$('.xmenu-config-panel-right-inner').css('top', top_panel_content  + 'px');
					}
				});

				$('.xmenu-config-panel-right').mousewheel(function (event, delta) {
					if (!$('.xmenu-config-panel-right').hasClass('show-scroll')) {
						return;
					}
					event.preventDefault();
					var panel_content_height = $('.xmenu-config-panel-right-inner').outerHeight();
					var panel_wrapper_height = $('.xmenu-config-panel-right').height();
					var panel_scroll_height = $('.xmenu-panel-scroll-wrapper').height() - 2;

					var top_drag = $('.xmenu-panel-drag').position().top;
					var drag_height = $('.xmenu-panel-drag').height();
					top_drag -= delta * 10;
					if (top_drag < 0) {
						top_drag = 0;
					}
					if (top_drag > (panel_scroll_height - drag_height)) {
						top_drag = (panel_scroll_height - drag_height);
					}
					$('.xmenu-panel-drag').css('top', top_drag  + 'px');

					var top_panel_content = (panel_wrapper_height - panel_content_height) * top_drag * 1.0 / (panel_scroll_height - drag_height);
					$('.xmenu-config-panel-right-inner').css('top', top_panel_content  + 'px');

				});
			}
		},
		rel_section_click:function() {
			$('.xmenu-config-panel-left > ul > li[rel-section]').click(function(){
				$('.xmenu-config-panel-right-inner > section').removeClass('active');
				var section_id = $(this).attr('rel-section');
				$('section#' + section_id).addClass('active');

				$('.xmenu-config-panel-left > ul > li[rel-section]').removeClass('active');
				$(this).addClass('active');
				XMENU.scroll_panel_right(false);
			});

		},
		process_media: function() {
			xmenu_media_init('.x-media-image','.x-media-button', null, function(target, old_url){
				if ($(target).val() != old_url) {
					XMENU.process_input_change(target);
				}
			});
		},
		xmenu_icon_popup_event: function(){
			$('.x-icon-wrapper').click(function(event){
				if ($(event.target).closest('.x-icon-remove').length == 1) {
					return;
				}
				var popup_top = $('.xmenu-config-panel-right').position().top + $('.xmenu-config-panel-right-inner').position().top + jQuery(this).position().top;
				var popup_left = $('.xmenu-config-panel-right').position().left + $('.xmenu-config-panel-right-inner').position().left + jQuery(this).position().left + jQuery(this).outerWidth();
				var data_rel = $(this).attr('data-rel');
				$('.xmenu-icon-popup').attr('data-rel',data_rel);
				$('.xmenu-icon-popup').css('top', popup_top + 'px');
				$('.xmenu-icon-popup').css('left',(popup_left)+ 'px');
				$('li', '.xmenu-icon-popup-content').show();
				$('.xmenu-icon-popup-header > input').val('');
				$('.xmenu-icon-popup').fadeIn();

			});
			$('.xmenu-icon-popup-header > i.fa-remove').click(function(){
				$('.xmenu-icon-popup').fadeOut();
			});
			$('.xmenu-icon-popup-content > ul > li').click(function(){
				var icon_value = $('i', this).attr('class').replace('fa ','');
				var data_rel = $('.xmenu-icon-popup').attr('data-rel');
				$('.x-icon-wrapper[data-rel="' + data_rel + '"] > i').attr('class', 'fa ' + icon_value);

				var old_icon_value = $('.x-icon-wrapper[data-rel="' + data_rel + '"] > input').val();
				$('.x-icon-wrapper[data-rel="' + data_rel + '"] > input').val(icon_value);
				if (old_icon_value != icon_value){
					XMENU.process_input_change($('.x-icon-wrapper[data-rel="' + data_rel + '"] > input'));
				}
				$('.xmenu-icon-popup').fadeOut();
			});
			$('.x-icon-remove').click(function(){
				if ($('> input', $(this).parent()).val()!=''){
					$('> input', $(this).parent()).val('');
					$('> i', $(this).parent()).attr('class','');
					XMENU.process_input_change($('> input', $(this).parent()));
				}
			});
			$('.xmenu-icon-popup .xmenu-icon-remove').click(function(){
				var data_rel = $('.xmenu-icon-popup').attr('data-rel');
				$('.x-icon-wrapper[data-rel="' + data_rel + '"] > i').attr('class', '');

				if ($('.x-icon-wrapper[data-rel="' + data_rel + '"] > input').val()!=''){
					XMENU.process_input_change($('.x-icon-wrapper[data-rel="' + data_rel + '"] > input'));
				}
				$('.x-icon-wrapper[data-rel="' + data_rel + '"] > input').val('');
				$('.xmenu-icon-popup').fadeOut();
			});
			$('.xmenu-icon-popup-header > input').keyup(function(){
				var filter = $(this).val();
				$('li', '.xmenu-icon-popup-content').each(function(){
					if ($(this).attr('title').search(new RegExp(filter, "i")) < 0) {
						$(this).hide();
					}
					else {
						$(this).show();
					}
				});
			});
		}
	}
	$(document).ready(function(){
		XMENU.initialize();
	});
})(jQuery);