(function ()
{
	// create zillaShortcodes plugin
	tinymce.create("tinymce.plugins.zillaShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("zillaPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "zilla_button" )
			{	
				var a = this;
				
				var btn = e.createSplitButton('zilla_button', {
                    title: "Insert Shortcode",
					image: ZillaShortcodes.plugin_folder +"/images/icon.png",
					icons: false
                });

                btn.onRenderMenu.add(function (c, b)
				{					
					a.addWithPopup( b, "Accordions", "accordions" );
					a.addWithPopup( b, "Box", "box" );
					a.addWithPopup( b, "Button", "button" );
					a.addWithPopup( b, "Blog Slide", "blog_slide" );
					a.addWithPopup( b, "Br", "br" );
					a.addWithPopup( b, "Column", "column" );
					a.addWithPopup( b, "Gallery", "gallery" );
					a.addWithPopup( b, "Hr", "hr" );
					a.addWithPopup( b, "Icon Box", "icon_box" );
					a.addWithPopup( b, "Map", "map" );
					c = b.addMenu({
                        title: 'Portfolios'
                    });
					a.addWithPopup( c, "Portfolio", "portfolio" );
					a.addWithPopup( c, "Portfolio Slide", "portfolio_slide" );
					a.addWithPopup( b, "Product Slide", "product_slide" );
					a.addWithPopup( b, "Price Tables", "price_tables" );
					a.addWithPopup( b, "Slogan", "slogan" );
					a.addWithPopup( b, "Tabs", "tabs" );
					a.addWithPopup( b, "Toggles", "toggles" );
					a.addWithPopup( b, "Video", "video" );
					a.addWithPopup( b, "Youtube", "youtube" );
					a.addWithPopup( b, "Vimeo", "vimeo" );
				});
                
                return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("zillaPopup", false, {
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
				longname: 'Zilla Shortcodes',
				author: 'Orman Clark',
				authorurl: 'http://themeforest.net/user/ormanclark/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});
	
	// add zillaShortcodes plugin
	tinymce.PluginManager.add("zillaShortcodes", tinymce.plugins.zillaShortcodes);
})();