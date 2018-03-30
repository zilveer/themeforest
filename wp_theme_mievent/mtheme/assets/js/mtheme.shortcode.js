(function() {
	if(tinymce.majorVersion>3) {
		var shortcodes=[];
		
		for(var id in mthemeShortcodes) {
			shortcodes.push({
				value: id,
				text: mthemeShortcodes[id],
				onclick: function() {
					tb_show(mthemeTitle, mthemeURI+'templates/popup.php?width=500&shortcode='+this.value());
				}				
			});
		}
		
		tinymce.PluginManager.add('mtheme_shortcode', function( editor, url ) {
			editor.addButton( 'mtheme_shortcode', {
				title: mthemeTitle,
				type: 'menubutton',
				icon: 'icon mtheme-shortcode-icon',
				menu: shortcodes,
			});
		});
	} else {
		tinymce.create('tinymce.plugins.mtheme_shortcode', {
			init: function (ed, url) {
				ed.addCommand('mtheme_popup', function (a, params) {
					tb_show(mthemeTitle, mthemeURI+'templates/popup.php?width=500&shortcode='+params.identifier);
				});
			},
			
			createControl: function (button, e) {
				if (button=='mtheme_shortcode') {
					var a = this;
						
					button = e.createMenuButton('mtheme_shortcode', {
						title: mthemeTitle,
						image: mthemeURI+'assets/images/icons/icon-shortcode.png',
						icons: false
					});
					
					button.onRenderMenu.add(function (c, b) {
						for(var id in mthemeShortcodes) {
							var name=mthemeShortcodes[id];
							a.addWithPopup(b, name, id);
						}
					});
					
					return button;
				}
				
				return null;
			},
			
			addWithPopup: function (ed, title, id) {
				ed.add({
					title: title,
					onclick: function () {
						tinyMCE.activeEditor.execCommand('mtheme_popup', false, {
							title: title,
							identifier: id
						})
					}
				});
			},
			
			addImmediate: function ( ed, title, shortcode) {
				ed.add({
					title: title,
					onclick: function () {
						tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
					}
				})
			},
		});
		
		tinymce.PluginManager.add('mtheme_shortcode', tinymce.plugins.mtheme_shortcode);	
	}
})();