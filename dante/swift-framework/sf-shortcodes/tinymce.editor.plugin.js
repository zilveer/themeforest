(function() {

	tinymce.create('tinymce.plugins.swiftframework_shortcodes', {
		init : function(ed, url) {

			ed.addCommand('swiftframework_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/interface.php',
					width : 500 + ed.getLang('swiftframework_shortcodes.delta_width', 0),
					height : 600 + ed.getLang('swiftframework_shortcodes.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			
			ed.addButton('swiftframework_shortcodes', {
				title : 'Swift Framework Shortcodes',
				cmd : 'swiftframework_shortcodes',
				image : url + '/sf-shortcodes-button.png'
			});
			
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('swiftframework_shortcodes', n.nodeName == 'IMG');
			});
			
		},
		
		createControl : function(n, cm) {
			return null;
		},
		
		getInfo : function() {
			return {
					longname  : 'swiftframework_shortcodes',
					author 	  : 'Swift Ideas',
					version   : "1.0"
			};
		}
	});

	tinymce.PluginManager.add('swiftframework_shortcodes', tinymce.plugins.swiftframework_shortcodes);

})();