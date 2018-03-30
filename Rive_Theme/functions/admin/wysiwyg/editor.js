(function() {
	tinymce.PluginManager.requireLangPack('ch_shortcodes');
	tinymce.create('tinymce.plugins.ch_shortcodes', {
		init : function(ed, url) {

			ed.addCommand('mcech_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/interface.php',
					width : 410 + ed.getLang('ch_shortcodes.delta_width', 0),
					height : 250 + ed.getLang('ch_shortcodes.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			
			ed.addButton('ch_shortcodes', {
				title : 'ch_shortcodes.desc',
				cmd : 'mcech_shortcodes',
				image : url + '/btn.png'
			});

			
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('ch_shortcodes', n.nodeName == 'IMG');
			});
		},
		
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'ch_shortcodes',
					author 	  : 'Cohhe',
					authorurl : '',
					infourl   : '',
					version   : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('ch_shortcodes', tinymce.plugins.ch_shortcodes);
})();


