var shortcodeMenu;

(function ($) {
	var api, s;

	// Initialize the shortcode/api object
	shortcodeMenu = api = {};

	api.init = function (options) {
		s = api.settings = $.extend({}, api.settings, options);

		if($("#ed_toolbar,.quicktags-toolbar").length == 0 ){
			return;
		}

		if ( typeof(QTags) != 'undefined' && QTags.addButton ) { 
			QTags.addButton( 'theme_shortcode', s.langs.shortcodes, function(){});
		}else{
			$("#ed_toolbar,.quicktags-toolbar").append('<input type="button" value="' + s.langs.shortcodes + '" id="qt_content_theme_shortcode" class="ed_button" title="' + s.langs.insert_shortcodes + '" />');
		}
		api.loadMenuData();
		
	};
	api.loadMenuData = function(){
		var url = ajaxurl + '?action=theme-shortcode-menu';
		$.getJSON(url, function (menu_data) {
			$(".ed_button[value='Shortcodes']").buttonMenu({
				data: menu_data,
				item: {
					click: api.menu.onclick
				},
				beforeShow: function(){
					if (typeof tinyMCE != 'undefined' && (ed = tinyMCE.activeEditor) && !ed.isHidden()) {
						ed.hide();
					}
				}
			});
			if(tinymce.majorVersion >= 4){
				$("#wp_fs_shortcode").buttonMenu({
					data: menu_data,
					item: {
						click: api.menu.onclick
					}
				});
			} else {
				$("#wp2_fs_shortcode,#wp_fs_shortcode").buttonMenu({
					item: {
						click: api.menu.onclick
					},
					data: menu_data,
					beforeShow: function () {
						$("#fullscreen-topbar").unbind('mouseleave');
						clearTimeout(fullscreen.settings.timer);
						fullscreen.settings.timer = 0;
					},
					afterHide: function () {
						$("#fullscreen-topbar").bind('mouseleave', function (e) {
							fullscreen.settings.toolbars.removeClass('fullscreen-make-sticky');
							if (fullscreen.settings.visible) {
								$(document).bind('mousemove.fullscreen', function (e) {
									fullscreen.bounder('showToolbar', 'hideToolbar', 2000, e);
								});
							}
						}).trigger('mouseleave');
						$(document).trigger('mousemove.fullscreen');
					}
				});
			}
		});
	}

	api.menu = {};
	api.menu.onclick = function (item, event) {
		if (typeof item.type != undefined && item.type in api.menu.operate) {
			api.menu.operate[item.type](item);
		}
	};
	// item operate
	api.menu.operate = {};
	api.menu.operate.insert = function (item) {
		var $selection = api.editor.getSelection();
		if($selection == ''){
			$selection = ' ';
		}
		api.editor.insertContent(item.code.replace('(*)', $selection));
	};
	api.menu.operate.dialog = function (item) {
		var title = 'Insert ' + item.text + ' Shortcode';
		var url = ajaxurl + '?action=theme-shortcode-dialog';
		if (typeof item.dialog != 'undefined') {
			url += '&dialog=' + item.dialog;
		}
		if (typeof item.args != 'undefined') {
			for (x in item.args) {
				url += '&args[' + x + ']='+item.args[x];
			}
		}
		if (api.editor.getSelection().length > 0) {
			url += '&select=1';
		}
		tb_show(title, url + '&TB_iframe=1');
	};
	api.menu.operate.custom = function (item) {
		item.func.call(this, item);
	};

	// editor
	api.editor = {};
	api.editor.insertContent = function (code) {
		var ed;
		if (typeof tinyMCE != 'undefined' && (ed = tinyMCE.activeEditor) && !ed.isHidden()) {
			if(tinymce.majorVersion >= 4){
				ed.insertContent(code);
			} else {
				// restore caret position on IE
				if (tinymce.isIE && ed.windowManager.insertimagebookmark){
					ed.selection.moveToBookmark(ed.windowManager.insertimagebookmark);
				}

				ed.execCommand('mceInsertContent', false, code);
			}
		} else if (typeof edInsertContent == 'function') {
			edInsertContent(edCanvas, code);
		} else {
			jQuery(edCanvas).val(jQuery(edCanvas).val() + code);
		}
	};
	api.editor.getSelection = function () {
		var ed, selectedText = '';
		if (typeof tinyMCE != 'undefined' && (ed = tinyMCE.activeEditor) && !ed.isHidden()) {
			if (ed.selection.getContent().length > 0) {
				selectedText = ed.selection.getContent();
			}
		} else {
			if(typeof edCanvas!= 'undefined'){
				if (document.selection) {
					edCanvas.focus();
					sel = document.selection.createRange();
					if (sel.text.length > 0) {
						selectedText = sel.text;
					}
				} else if (edCanvas.selectionStart || edCanvas.selectionStart == '0') {
					startPos = edCanvas.selectionStart;
					endPos = edCanvas.selectionEnd;
					if (startPos != endPos) {
						selectedText = edCanvas.value.substring(startPos, endPos);
					}
				}
			}
		}
		return selectedText;
	};
})(jQuery);