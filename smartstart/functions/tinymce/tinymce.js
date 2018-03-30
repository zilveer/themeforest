(function() {
	tinymce.create('tinymce.plugins.ssFrameworkShortcodes', {
		init : function(ed, url) {
			ed.addButton('ss_framework_shortcodes', {
				title : 'Insert Shortcode',
				image : url + '/img/add.png',
				onclick : function() {
					tb_show('Shortcodes Manager', url + '/tinymce.php?&width=670&height=600');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "SmartStart Shortcodes",
				author : 'Samuli Saarinen',
				authorurl : 'http://samuli.me/',
				infourl : 'http://wiki.moxiecode.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('ss_framework_shortcodes', tinymce.plugins.ssFrameworkShortcodes);
})();