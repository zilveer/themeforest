(function ()
{
	// create icyShortcodes plugin
	tinymce.create("tinymce.plugins.icyShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("icyPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "icy_button" )
			{	
				var a = this;
					
				// adds the tinymce button
				btn = e.createMenuButton("icy_button",
				{
					title: "Insert Shortcode",
					image: "../wp-content/themes/politic/tinymce/images/icon.png",
					icons: false
				});
				
				// adds the dropdown to the button
				btn.onRenderMenu.add(function (c, b)
				{					
					a.addWithPopup( b, "Columns", "columns" );
					a.addWithPopup( b, "Buttons", "button" );
					a.addWithPopup( b, "Alerts", "alert" );
					a.addWithPopup( b, "Toggle Content", "toggle" );
					a.addWithPopup( b, "Tabbed Content", "tabs" );
				});
				
				return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("icyPopup", false, {
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
				longname: 'ICY Shortcodes',
				author: 'Paul | Icy Pixels',
				authorurl: 'http://themeforest.net/user/icypixels/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});
	
	// add icyShortcodes plugin
	tinymce.PluginManager.add("icyShortcodes", tinymce.plugins.icyShortcodes);
})();