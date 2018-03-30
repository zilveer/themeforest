(function() {
	tinymce.PluginManager.requireLangPack('sg_shortcodes_button');
	tinymce.create('tinymce.plugins.sg_shortcodes_button', {
		init : function(ed, url) {
			ed.addCommand('mcesg_shortcodes_button', function() {
				ed.windowManager.open({
					file : url + '/interface.php',
					width : 290 + ed.getLang('sg_shortcodes_button.delta_width', 0),
					height : 150 + ed.getLang('sg_shortcodes_button.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			ed.addButton('sg_shortcodes_button', {
				title : 'Click to add a shortcode',
				cmd : 'mcesg_shortcodes_button',
				image : url + '/shortcode_button.png'
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'sg_shortcodes_button',
					author 	  : 'sheng',
					authorurl : 'http://themeforest.net/user/fireform',
					infourl   : 'http://themeforest.net/user/fireform',
					version   : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('sg_shortcodes_button', tinymce.plugins.sg_shortcodes_button);
})();

(function() {
	tinymce.PluginManager.requireLangPack('sg_shortcodes2_button');
	tinymce.create('tinymce.plugins.sg_shortcodes2_button', {
		init : function(ed, url) {
			ed.addCommand('mcesg_shortcodes2_button', function() {
				if(window.tinyMCE) {
					var tmce_ver = window.tinyMCE.majorVersion;
					if (tmce_ver >= '4') {
						window.tinyMCE.execCommand('mceInsertContent', false, "[button text='More' url='#']");
					} else {
						window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, "[button text='More' url='#']");
					}
				}
			});

			ed.addButton('sg_shortcodes2_button', {
				title : 'Click to add Read more',
				cmd : 'mcesg_shortcodes2_button',
				image : url + '/more_button.png'
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'sg_shortcodes2_button',
					author 	  : 'sheng',
					authorurl : 'http://themeforest.net/user/fireform',
					infourl   : 'http://themeforest.net/user/fireform',
					version   : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('sg_shortcodes2_button', tinymce.plugins.sg_shortcodes2_button);
})();