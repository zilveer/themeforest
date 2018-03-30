(function ($) {
	tinymce.PluginManager.add('crumshortcodes', function (editor, url) {
		editor.addButton('crumshortcodes', {
			text: 'Insert shortcode',
			icon: false,
			type: 'menubutton',
			menu: [
				{
					text   : 'Dropcap',
					onclick: function () {
						editor.windowManager.open({
							title   : 'Insert Dropcap Shortcode',
							body    : [
								{
									type    : 'listbox',
									name    : 'dropcapStyle',
									'values': [
										{text: 'Style1', value: 's1'},
										{text: 'Style2', value: 's2'},
										{text: 'Style3', value: 's3'}
									]
								}
							],
							onsubmit: function (e) {
								var selected_text = tinyMCE.activeEditor.selection.getContent();
								editor.insertContent('[crumina_dropcap dropcap_style="dropcaps-' + e.data.dropcapStyle + '"]' + selected_text + '[/crumina_dropcap]');
							}
						});
					}
				},
				{
					text   : 'List with Icon',
					onclick: function () {
						editor.windowManager.open({
							title   : 'Insert List with Icons Shortcode',
							body    : [
								{
									type : 'textbox',
									name : 'iconClass',
									label: 'Icon class'
								},
							],
							onsubmit: function (e) {
								var selected_text = tinyMCE.activeEditor.selection.getContent();
								editor.insertContent('[crumina_icon_list icon_list_icon="' + e.data.iconClass + '" ]' + selected_text + '[/crumina_icon_list]');
							}
						});
					}
				},
				{
					text   : 'Tooltip',
					onclick: function () {
						editor.windowManager.open({
							title   : 'Insert Tooltip Shortcode',
							body    : [
								{
									type : 'textbox',
									name : 'tooltipName',
									label: 'Tooltip text'
								},
								{
									type    : 'listbox',
									name    : 'tooltipAlign',
									'values': [
										{text: 'Left', value: 'left'},
										{text: 'Right', value: 'right'},
										{text: 'Bottom', value: 'bottom'},
										{text: 'Top', value: 'top'}
									]
								}
							],
							onsubmit: function (e) {
								var selected_text = tinyMCE.activeEditor.selection.getContent();
								editor.insertContent('[crumina_tooltip tooltip_text="' + e.data.tooltipName + '" tooltip_align="' + e.data.tooltipAlign + '" ]' + selected_text + '[/crumina_tooltip]');
							}
						});
					}
				}
			]
		});
	});
})();