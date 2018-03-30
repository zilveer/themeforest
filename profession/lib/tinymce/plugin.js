(function ()
{
    var mceUrl = '';
	// create pxShortcodes plugin
	tinymce.create("tinymce.plugins.pxShortcodes",
	{
		init: function ( ed, url )
		{
		    mceUrl = url;

			ed.addCommand("pxPopup", function ( a, params ){
                var title = 'Insert Shortcode';
                    
                //if(typeof params.title != 'undefined')
                    //title = params.title + ' Shortcode';

				// load thickbox
				tb_show(title, url + "/popup.php?type=" + params.type + "&width=" + 855);
			});
		},
		createControl: function ( button, e )
		{
			if ( button != "px_button" )
                return null;
					
			// adds the tinymce button
			button = e.createMenuButton("px_button",
			{
				title: "Insert Shortcode",
				image: mceUrl + "/images/icon.png",
				icons: false
			});
			
            var plugin = this;	

			// adds the dropdown to the button
			button.onRenderMenu.add(function (c, b)
			{	
				plugin.addPopupMenuButton(b, "Row", "rows");
			    plugin.addPopupMenuButton(b, "Columns &amp; Offsets", "columns");

			    b.addSeparator();

			    plugin.addPopupMenuButton(b, "Toggle", "toggle");
			    
			    c = b.addMenu({ title: "Tabs" });

			    plugin.addPopupMenuButton(c, "Tab Group", "tabgroup");
			    plugin.addPopupMenuButton(c, "Tab", "tab");

			    b.addSeparator();

				plugin.addPopupMenuButton(b, "Pie Chart", "piechart");
			    plugin.addPopupMenuButton(b, "Buttons", "button");
				plugin.addPopupMenuButton(b, "Separator", "separator");
				plugin.addPopupMenuButton(b, "Highlights", "highlight");

				c = b.addMenu({ title: "Social Links" });

				plugin.addPopupMenuButton(c, "Social Links Group", "socialgroup");
				plugin.addPopupMenuButton(c, "Social Links", "sociallinks");

				c = b.addMenu({ title: "Video" });

				plugin.addPopupMenuButton(c, "Vimeo", "vimeo");
				plugin.addPopupMenuButton(c, "YouTube", "youtube");
				
				b.addSeparator();

				plugin.addPopupMenuButton(b, "Alert", "alert");

				b.addSeparator();

				plugin.addPopupMenuButton(b, "Quotes", "pullquote");
				plugin.addPopupMenuButton(b, "Testimonial", "testimonial");



			});
				
			return button;
		},
		addPopupMenuButton: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("pxPopup", false, { title: title, type: id } )
				}
			})
		},
		addImmediateMenuButton: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'PixFlow Shortcodes',
				author: 'Mohsen Heydari',
				authorurl: 'http://themeforest.net/user/pixflow/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});
	
	// add pxShortcodes plugin
	tinymce.PluginManager.add("pxShortcodes", tinymce.plugins.pxShortcodes);
})();