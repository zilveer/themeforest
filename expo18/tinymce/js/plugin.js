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
					this_.addPopup( b, "Agenda", "agenda" );
					this_.addPopup( b, "Speakers", "speaker" );
					this_.addInsert( b, "Logos", "[logos]INSERT IMAGES HERE", "[/logos]" );
					this_.addPopup( b, "Registration form", "registration" );
					this_.addPopup( b, "Aligned Content", "aligned" );
					this_.addPopup( b, "Toggle Content", "toggle" );
					this_.addPopup( b, "Accordion", "accordion" );
					this_.addPopup( b, "Tabbed Content", "tabs" );
					this_.addPopup( b, "Testimonial", "testimonial" );
					this_.addPopup( b, "Dropcaps", "dropcaps" );
					this_.addInsert( b, "Big Header", "[big_header]", "[/big_header]" );
					this_.addPopup( b, "Icons", "icons" );
					this_.addPopup( b, "Marker", "marker" );
					this_.addPopup( b, "Infopane", "infopane" );
					this_.addPopup( b, "Big pane with Button", "biginfopane" );
					this_.addInsert( b, "Custom table", "[custom_table]YOUR TABLE CODE GOES HERE", "[/custom_table]" );
					this_.addPopup( b, "Custom bullets list", "bullets" );
					this_.addPopup( b, "Custom individual bullets list", "bullets_individual" );
					this_.addPopup( b, "Video", "video" );
					this_.addPopup( b, "Map", "map" );
					this_.addInsert( b, "Float clearing", "[clear]", "" );
					this_.addPopup( b, "Space", "space" );
//					this_.addInsert( b, "Dots divider", "<hr/>", "" );
//					this_.addInsert( b, "Fat Dots divider", "[dots_divider]", "" );
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