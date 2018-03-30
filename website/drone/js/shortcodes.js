/**
 * @package    WordPress
 * @subpackage Drone
 * @since      2.0
 */

// -----------------------------------------------------------------------------

tinymce.PluginManager.add('droneshortcodes', function(editor) {

	// -------------------------------------------------------------------------
	
	function getMenu(shortcodes) {
		var menu = [];
		for (var i in shortcodes) {
			var menu_item = {
				text: i
			};
			if (typeof shortcodes[i] == 'object') {
				menu_item.menu = getMenu(shortcodes[i]);
			} else {
				menu_item.syntax = shortcodes[i];
				menu_item.onclick = function() {
					var sel  = editor.selection.getContent();
					var mark = '<!--b7530948d34bc784bb4c0406fb4684a1'+(new Date().getTime())+'-->';
					var s    = this.settings.syntax.replace(/%s/g, sel ? sel : ' ... ');
					editor.selection.setContent(mark);
					editor.setContent(
						editor.getContent({format: 'raw'}).replace(new RegExp('(<p></p>)?'+mark+'(<p></p>)*', 'i'), s),
						{format: 'raw'}
					);
				};
			}
			menu.push(menu_item);
		}
		return menu;
	}
	
	// -------------------------------------------------------------------------
	
	editor.addButton('drone-shortcodes', {
		type:  'splitbutton',
		title: 'droneshortcodes.title',
		icon:  'drone-shortcode',
		menu:  getMenu(drone_shortcodes),
		onclick: function() {
			this.showMenu();
		}
	});

});