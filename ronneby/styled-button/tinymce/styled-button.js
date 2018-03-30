tinymce.create('tinymce.plugins.StyledButton', {
	init: function(ed, url) {
		ed.addButton('styled_button', {
			title: 'Insert styled button',
			image: url + '/img/styled_button.png',
			cmd: 'styled_button_cmd'
		});
		
		if (tinymce.majorVersion == 4) {
			ed.addMenuItem('styled_button', {
				text: 'Insert styled button',
				context: 'insert',
				image: url + '/img/styled_button.png',
				cmd: 'styled_button_cmd'
			});
		}

		ed.addCommand('styled_button_cmd', function() {
			ed.windowManager.open({
				title: 'Insert styled button',
				file: url + '/popup.php',
				width: 500,
				height: 520,
				inline: 1
			});
		});
	},
});

tinymce.PluginManager.add('styled_button', tinymce.plugins.StyledButton);

