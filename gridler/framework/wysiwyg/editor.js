(function() {
	tinymce.PluginManager.requireLangPack('theme_shortcodes');
	tinymce.create('tinymce.plugins.theme_shortcodes', {
		init : function(ed, url) {

			ed.addCommand('mcetheme_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/interface.php',
					width : 410 + ed.getLang('theme_shortcodes.delta_width', 0),
					height : 250 + ed.getLang('theme_shortcodes.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			
			ed.addButton('theme_shortcodes', {
				title : 'theme_shortcodes.desc',
				cmd : 'mcetheme_shortcodes',
				image : url + '/btn.png'
			});

			
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('theme_shortcodes', n.nodeName == 'IMG');
			});
		},
		
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'theme_shortcodes',
					author 	  : '#',
					authorurl : '#',
					infourl   : '#',
					version   : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('theme_shortcodes', tinymce.plugins.theme_shortcodes);
})();


