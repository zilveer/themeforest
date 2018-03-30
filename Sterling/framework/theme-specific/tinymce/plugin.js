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
			var a = this;
			ed.addButton('tt_button', {
				title: "Insert Shortcode",
				// Could not find a way to make the image show.
				// It seems the split button does not support
				// icons anymore. I'm using icon to make a little hack.
				// see https://github.com/tinymce/tinymce/blob/master/js/tinymce/classes/ui/SplitButton.js
				// to understand why it works,
				// basically, we close the class declaration, and add a style declaration
				// this is a hack, and it relies on how the split button is coded.
				// future updates to tinyMCE may break this hack.
				icon: '" style="background: url(http://s3.truethemes.net/truethemes-framework/btn.png);"',
				image: "http://s3.truethemes.net/truethemes-framework/btn.png",
				type: 'splitbutton',
				menu: [
					a.addWithPopup( ed, "Accordions", "accordions" ),
					a.addWithPopup( ed, "Buttons", "button" ),
					a.addWithPopup( ed, "Blog Posts", "blog-posts" ),
					a.addWithPopup( ed, "Columns", "columns" ),
					a.addWithPopup( ed, "Content Boxes", "content-boxes"),
					a.addWithPopup( ed, "Dividers", "dividers" ),
					a.addWithPopup( ed, "Drop Caps", "dropcaps" ),
					a.addWithPopup( ed, "Email Encoder", "mailto"),
					a.addWithPopup( ed, "Highlight Text", "highlight"),
					a.addWithPopup( ed, "Icons", "icons" ),
					a.addWithPopup( ed, "Icons - Minimal", "icons-mono"),
					a.addWithPopup( ed, "Image Frames", "image-frames" ),
					a.addWithPopup( ed, "Lightbox Image Frames", "lightbox-image-frames" ),
					a.addWithPopup( ed, "Notification Boxes", "notifications" ),
					a.addWithPopup( ed, "Pricing Boxes", "pricing_box" ),
					a.addWithPopup( ed, "Tabs", "tabs" ),
					a.addWithPopup( ed, "Team Members", "team" ),
					a.addWithPopup( ed, "Testimonials", "testimonials" ),
					a.addWithPopup( ed, "Text Styles", "text-styles" ),
					a.addWithPopup( ed, "Vector Icons", "vector-icons" ),
					a.addWithPopup( ed, "Vector Icon Boxes", "vector-icon-boxes" )
				]
			});
		},
		//createControl: function ( btn, e )
		//{
			//if ( btn == "tt_button" )
			//{	
				//var a = this;
					//
				//// adds the tinymce button
				//btn = e.createSplitButton("tt_button",
				//{
					//title: "Insert Shortcode",
					//image: "http://s3.truethemes.net/truethemes-framework/btn.png",
					//icons: false
				//});
				
				// adds the dropdown to the button
				//btn.onRenderMenu.add(function (c, b)
				//{	
					//a.addWithPopup( b, "Accordions", "accordions" );
					//a.addWithPopup( b, "Buttons", "button" );
					//a.addWithPopup( b, "Blog Posts", "blog-posts" );
					//a.addWithPopup( b, "Columns", "columns" );
					//a.addWithPopup( b, "Content Boxes", "content-boxes");
					//a.addWithPopup( b, "Dividers", "dividers" );
					//a.addWithPopup( b, "Drop Caps", "dropcaps" );
					//a.addWithPopup( b, "Email Encoder", "mailto");
					//a.addWithPopup( b, "Highlight Text", "highlight");
					//a.addWithPopup( b, "Icons", "icons" );
					//a.addWithPopup( b, "Icons - Minimal", "icons-mono");
					//a.addWithPopup( b, "Image Frames", "image-frames" );
					//a.addWithPopup( b, "Lightbox Image Frames", "lightbox-image-frames" );
					//a.addWithPopup( b, "Notification Boxes", "notifications" );
					//a.addWithPopup( b, "Pricing Boxes", "pricing_box" );	
					//a.addWithPopup( b, "Tabs", "tabs" );
					//a.addWithPopup( b, "Team Members", "team" );
					//a.addWithPopup( b, "Testimonials", "testimonials" );
					//a.addWithPopup( b, "Text Styles", "text-styles" );
				//});
				//
				//return btn;
			//}
			//
			//return null;
		//},
		addWithPopup: function ( ed, title, id ) {
			return{
				text: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("ttPopup", false, {
						title: title,
						identifier: id
					})
				}
			};
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
