/**
 * Created by hoantv on 2015-03-26.
 */
(function($) {
	"use strict";
	var XMENU_SETTING = {
		initialize: function() {
			XMENU_SETTING.event();
		},

		event: function() {
			XMENU_SETTING.group_setting_event();
		},
		group_setting_event: function() {
			$('.xmenu-settings .setting-left li[data-ref]').click(function(){
				if ($(this).hasClass('active')) {
					return;
				}
				var data_ref =  $(this).attr('data-ref');
				console.log(data_ref);
				$('.xmenu-settings .setting-left li[data-ref]').removeClass('active');
				$(this).addClass('active');
				$('.xmenu-settings .setting-right table[data-ref]').removeClass('active');
				$('.xmenu-settings .setting-right table[data-ref="' + data_ref + '"]').addClass('active');
			});
			$('#xmenu-save-setting').click(function(){
				$('#xmenu-save-setting i').attr('class', 'fa fa-spin fa-spinner');
				var data_post = $("#xmenu_settings").serialize();
				$.ajax({
					url:xmenu_meta.ajax_url,
					type   : 'POST',
					data   : data_post,
					dataType : 'json',
					success: function(data) {
						$('#xmenu-save-setting i').attr('class', 'fa fa-save');
						if (data.code < 0) {
							alert(data.message);
							return;
						}
					},
					error: function(data) {
						$('#xmenu-save-setting i').attr('class', 'fa fa-save');
					}
				});
			});
		}
	}
	$(document).ready(function(){
		XMENU_SETTING.initialize();
	});
})(jQuery);