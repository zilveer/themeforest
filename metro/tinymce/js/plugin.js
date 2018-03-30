(function() {
	tinymce.create('tinymce.plugins.om_shortcode_plugin', {
		init : function(ed, url) {
		
		},
		createControl : function(id, cm) {
			if ( id == 'om_shortcode_button' )	{	
				var this_ = this;
				
				btn = cm.createMenuButton("om_shortcode_button", {
					title: 'Insert Shortcode',
					image: OM_TEMPLATE_DIR_URI+'/tinymce/img/button-shortcode.png'
				});
				
				btn.onRenderMenu.add(function (c, b) {
					this_.addPopup( b, "Columns", "columns" );
					this_.addPopup( b, "Buttons", "buttons" );
					this_.addPopup( b, "Custom Gallery", "gallery" );
					this_.addPopup( b, "Recent Posts", "recent_posts" );
					this_.addPopup( b, "Recent Portfolios", "portfolio" );
					this_.addPopup( b, "Aligned Content", "aligned" );
					this_.addPopup( b, "Toggle Content", "toggle" );
					this_.addPopup( b, "Accordion", "accordion" );
					this_.addPopup( b, "Tabbed Content", "tabs" );
					this_.addPopup( b, "Dropcaps", "dropcaps" );
					this_.addPopup( b, "Icons", "icons" );
					this_.addPopup( b, "Marker", "marker" );
					this_.addPopup( b, "Infopane", "infopane" );
					this_.addPopup( b, "Big pane with Button", "biginfopane" );
					this_.addPopup( b, "Pullquote", "pullquote" );
					this_.addPopup( b, "Simple table", "table" );
					this_.addInsert( b, "Custom table", "[custom_table style=\"1\"]YOUR TABLE CODE GOES HERE", "[/custom_table]" );
					this_.addPopup( b, "Pricing Table", "pricing" );
					this_.addPopup( b, "Custom bullets list", "bullets" );
					this_.addPopup( b, "Custom individual bullets list", "bullets_individual" );
					this_.addPopup( b, "Video Embed", "video" );
					this_.addInsert( b, "Logos", "[logos]INSERT IMAGES HERE", "[/logos]" );
					this_.addPopup( b, "Testimonials", "testimonials" );
					this_.addPopup( b, "Contact Form", "contactform" );
					this_.addInsert( b, "Float clearing", "[clear]", "" );
					this_.addPopup( b, "Space", "space" );
					this_.addInsert( b, "Divider", "<hr/>", "" );
				});
				
				return btn;
			}
			
			return null;
		},
		addPopup: function ( b, title, id ) {
			b.add({
				title: title,
				onclick: function () {
					om_sc_plugin_popup(id, title);
				}
			});
		},
		addInsert: function ( b, title, code_start, code_end) {
			b.add({
				title: title,
				onclick: function () {
					om_sc_plugin_insert(title, code_start, code_end);
				}
			})
		}
	});
	
	tinymce.PluginManager.add('om_shortcode_plugin', tinymce.plugins.om_shortcode_plugin);
})();