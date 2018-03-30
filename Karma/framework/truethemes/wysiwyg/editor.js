(function() {
	//tinymce.PluginManager.requireLangPack('karma_shortcodes');
	tinymce.create('tinymce.plugins.karma_shortcodes', {
		init : function(ed, url) {

			ed.addCommand('mcekarma_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/interface.php',
					width : 410 + ed.getLang('karma_shortcodes.delta_width', 0),
					height : 250 + ed.getLang('karma_shortcodes.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			
			ed.addButton('karma_shortcodes', {
				title : 'Insert shortcode',
				cmd : 'mcekarma_shortcodes',
				image : url + '/btn.png',
				stateSelector : 'IMG'
			});

			
			//ed.onNodeChange.add(function(ed, cm, n) {
				//cm.setActive('karma_shortcodes', n.nodeName == 'IMG');
			//});
		},
		
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'karma_shortcodes',
					author 	  : 'truethemes',
					authorurl : 'http://www.truethemes.net',
					infourl   : 'http://www.truethemes.net',
					version   : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('karma_shortcodes', tinymce.plugins.karma_shortcodes);
})();


