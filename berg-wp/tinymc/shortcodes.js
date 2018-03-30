(function() {
	tinymce.create('tinymce.plugins.yopress', {
		menu: null,
		editor: null,
		url: '',
		init: function(ed, url) {
			this.url = url;
			ed.addCommand('yopressCommand', function() {
			});

			ed.addCommand('mapDialogBox', function() {
				ed.windowManager.open({
					file: url + '/mapDialog.php?url=' + url,
					width: 800 + ed.getLang('example.delta_width', 0),
					height: 600 + ed.getLang('example.delta_height', 0),
					inline: 1
				}, {
					plugin_url: url,
					some_custom_arg: ''
				});
			});
			
			this.editor = ed;
		},
		createControl: function(n, cm) {
			var yolitedropmenu = null;

			if (n == 'yopress') {
				c = cm.createSplitButton(n, {title: n, cmd: 'yopressCommand', scope: this, image: this.url + '/tinymc-yo.png'});
				t = this;

				c.onRenderMenu.add(function(c, m) {
					m.add({title: 'Shortcodes', 'class': 'mceMenuItemTitle'}).setDisabled(1);
					
					var columnsSubMenu = m.addMenu({title: 'Columns'});
					
					columnsSubMenu.add({title: "2 Columns ( 50% / 50% )", onclick:function() {
						t.editor.execCommand('mceInsertContent', false, '[row][column6][/column6][column6][/column6][/row]');
					}});

					columnsSubMenu.add({title: "2 Columns ( 66% / 33% )", onclick:function() {
						t.editor.execCommand('mceInsertContent', false, '[row][column8][/column8][column4][/column4][/row]');
					}});

					columnsSubMenu.add({title: "2 Columns ( 33% / 66% )", onclick:function() {
						t.editor.execCommand('mceInsertContent', false, '[row][column4][/column4][column8][/column8][/row]');
					}});

					columnsSubMenu.add({title: "3 Columns ( 33% / 33% / 33% )", onclick: function() {
						t.editor.execCommand('mceInsertContent', false, '[row][column4][/column4][column4][/column4][column4][/column4][/row]');
					}});

					var dropcapsSubMenu = m.addMenu({title: 'Dropcaps'});
					dropcapsSubMenu.add({title: "Light", onclick:function() {
						t.editor.execCommand('mceInsertContent', false, '[dropcap style="light"][/dropcap]');
					}});

					dropcapsSubMenu.add({title: "Dark", onclick:function() {
						t.editor.execCommand('mceInsertContent', false, '[dropcap style="dark"][/dropcap]');
					}});

					//var eventsSubMenu = m.addMenu({title: 'Event Calendar'});
					m.add({title: "Event Calendar", onclick:function() {
						t.editor.execCommand('mceInsertContent', false, '[yocalendar/]');
					}});

					//var googlemapSubMenu = m.addMenu({title: 'Map'});
					// m.add({title: "Map", onclick:function() {
					// 	//t.editor.execCommand('mceInsertContent', false, '[googlemap/]');
					// 	t.editor.execCommand('mapDialogBox');
					// }});

				});

				return c;
			}

			return yolitedropmenu;
		}
	});

	tinymce.PluginManager.add('yopress', tinymce.plugins.yopress);
})();