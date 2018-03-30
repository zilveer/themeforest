(function() {
	tinymce.PluginManager.add( 'total_shortcodes_mce_button', function( editor, url ) {
		editor.addButton( 'total_shortcodes_mce_button', {
			text : 'Shortcodes',
			type : 'menubutton',
			icon : false,
			menu : [
				{
				text: 'Icon',
					onclick: function() {
						editor.insertContent('[font_awesome link="" icon="bolt" color="000" size="16px" margin_right="" margin_left="" margin_top="" margin_bottom=""]');
					}
				},
				{
				text: 'WPML Switcher',
					onclick: function() {
						editor.insertContent('[wpml_lang_selector]');
					}
				},
				{
				text: 'PolyLang Switcher',
					onclick: function() {
						editor.insertContent('[polylang_switcher dropdown="false" show_flags="true" show_names="false"]');
					}
				},
				{
				text: 'Button',
					onclick: function() {
						editor.insertContent('[vcex_button url="http://www.google.com/" title="Visit Site" style="graphical" align="left" color="black" size="small" target="self" rel="none"]Button Text[/vcex_button]');
					}
				},
				{
				text: 'Divider',
					onclick: function() {
						editor.insertContent('[vcex_divider style="solid" icon_color="#000000" icon_size="14px" margin_top="20px" margin_bottom="20px"]');
					}
				},
				{
				text: 'Spacing',
					onclick: function() {
						editor.insertContent('[vcex_spacing size="30px"]');
					}
				},
				{
				text: 'Staff Social',
					onclick: function() {
						editor.insertContent('[staff_social]');
					}
				},
				{
				text: 'Current Year',
					onclick: function() {
						editor.insertContent('[current_year]');
					}
				}
			]
		});
	});
})();