(function ()
{
	tinymce.create("tinymce.plugins.ttShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("ttPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "tt_button" )
			{	
				var a = this;
					
				// adds the tinymce button
				btn = e.createSplitButton("tt_button",
				{
					title: "Insert Shortcode",
					image: "http://s3.truethemes.net/truethemes-framework/btn.png",
					icons: false
				});
				
				// adds the dropdown to the button
				btn.onRenderMenu.add(function (c, b)
				{	
					a.addWithPopup( b, "Accordions", "accordions" );
					a.addWithPopup( b, "Buttons", "button" );
					a.addWithPopup( b, "Blog Posts", "blog-posts" );
					a.addWithPopup( b, "Columns", "columns" );
					a.addWithPopup( b, "Content Boxes", "content-boxes");
					a.addWithPopup( b, "Dividers", "dividers" );
					a.addWithPopup( b, "Drop Caps", "dropcaps" );
					a.addWithPopup( b, "Email Encoder", "mailto");
					a.addWithPopup( b, "Highlight Text", "highlight");
					a.addWithPopup( b, "Icons", "icons" );
					a.addWithPopup( b, "Icons - Minimal", "icons-mono");
					a.addWithPopup( b, "Image Frames", "image-frames" );
					a.addWithPopup( b, "Lightbox Image Frames", "lightbox-image-frames" );
					a.addWithPopup( b, "Notification Boxes", "notifications" );
					a.addWithPopup( b, "Pricing Boxes", "pricing_box" );	
					a.addWithPopup( b, "Tabs", "tabs" );
					a.addWithPopup( b, "Team Members", "team" );
					a.addWithPopup( b, "Testimonials", "testimonials" );
					a.addWithPopup( b, "Text Styles", "text-styles" );
					a.addWithPopup( b, "Vector Icons", "vector-icons" );
                    a.addWithPopup( b, "Vector Icon Boxes", "vector-icon-boxes" );
				});
				
				return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("ttPopup", false, {
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
				longname: 'TT Shortcodes',
				author: 'TrueThemes',
				authorurl: 'http://themeforest.net/user/truethemes/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});
	
	// add ttShortcodes plugin
	tinymce.PluginManager.add("ttShortcodes", tinymce.plugins.ttShortcodes);
})();