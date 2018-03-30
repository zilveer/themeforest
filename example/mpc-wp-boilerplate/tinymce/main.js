(function () {
	tinymce.create('tinymce.plugins.mpc_sh', {
		base_url: '',
		init: function (editor, url) {
			var self = this;
			self.base_url = url;

			editor.addCommand('mpc_sh_popup', function(attr, params) {
				tb_show('Insert Shortcode: ' + params.title, url + '/../tinymce/window-content.php?type=' + params.identifier + '&width=850');
			});

			if (tinymce.majorVersion >= 4) {
				editor.addButton( 'mpc_sh_button', {
					type: 'menubutton',
					title: 'MPC Shortcodes',
					icon: 'mpc_add',
					menu: [
						{ text: 'Dropcaps', onclick: function() {
							tinyMCE.activeEditor.execCommand('mpc_sh_popup', false, {
								title: 'Dropcaps',
								identifier: 'dropcaps'
							});
						} },
						{ text: 'Highlight', onclick: function() {
							tinyMCE.activeEditor.execCommand('mpc_sh_popup', false, {
								title: 'Highlight',
								identifier: 'highlight'
							});
						} },
						
						{ text: 'Tooltip', onclick: function() {
							tinyMCE.activeEditor.execCommand('mpc_sh_popup', false, {
								title: 'Tooltip',
								identifier: 'tooltip'
							});
						} },
						
						{ text: 'Button', onclick: function() {
							tinyMCE.activeEditor.execCommand('mpc_sh_popup', false, {
								title: 'Button',
								identifier: 'button'
							});
						} },
						
						{ text: 'Fancybox', onclick: function() {
							tinyMCE.activeEditor.execCommand('mpc_sh_popup', false, {
								title: 'Fancybox',
								identifier: 'fancybox'
							});
						} },
						
						{ text: 'List', onclick: function() {
							tinyMCE.activeEditor.execCommand('mpc_sh_popup', false, {
								title: 'List',
								identifier: 'list'
							});
						} }
					]
				});
			}
		},
		createControl: function(button, e) {
			if(button == 'mpc_sh_button') {
				var self = this;

				button = e.createMenuButton('mpc_sh_button', {
					title: 'Insert Shortcode',
					//image: '/images/add.png',
					icons: false
				});

				button.onRenderMenu.add(function (first, second) {
					self.showPopup(second, 'Dropcaps', 'dropcaps');
					self.showPopup(second, 'Highlight', 'highlight');
					self.showPopup(second, 'Tooltip', 'tooltip');                                        
					self.showPopup(second, "Button", "button" );
					self.showPopup(second, "Fancybox", "fancybox" );
					self.showPopup(second, "List", "list" );
                                        
				});
				return button;
			}
			return null;
		},
		showPopup: function(obj, title, id) {
			obj.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand('mpc_sh_popup', false, {
						title: title,
						identifier: id
					})
				}
			})
		},
                addImmediate: function(obj, title, src) {
			obj.add({
				title: title,
				onclick: function() {
					tinyMCE.activeEditor.execCommand("mceInsertContent", false, src)
				}
			})
		},
		getInfo: function() {
			return {
				longname: 'MPC Shortcodes',
				author: 'MassivePixelCreation',
				authorurl: 'http://themeforest.net/user/mpc/',
				infourl: 'http://themeforest.net/user/mpc/',
				version: '1.1'
			}
		}
	});

	tinymce.PluginManager.add('mpc_sh', tinymce.plugins.mpc_sh);
})();