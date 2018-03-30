(function ()
{
	// create us_zillaShortcodes plugin
	tinymce.create("tinymce.plugins.us_zillaShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("us_zillaPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "us_zilla_button" )
			{	
				var a = this;
				
				var btn = e.createMenuButton('us_zilla_button', {
                    title: "Insert Shortcode",
					image: Us_ZillaShortcodes.plugin_folder +"/tinymce/images/icon.png",
					icons: false
                });

                btn.onRenderMenu.add(function (c, b)
				{					
					a.addWithPopup( b, "Alert", "alert" );
					a.addWithPopup( b, "Button", "button" );
					a.addWithPopup( b, "Tabs", "tabs" );
					a.addWithPopup( b, "Accordion", "accordion" );
					a.addWithPopup( b, "Toggle", "toggle" );
				});
                
                return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'Us_Zilla Shortcodes',
				author: 'Orman Clark',
				authorurl: 'http://themeforest.net/user/ormanclark/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});
	
	// add us_zillaShortcodes plugin
	tinymce.PluginManager.add("us_zillaShortcodes", tinymce.plugins.us_zillaShortcodes);
})();