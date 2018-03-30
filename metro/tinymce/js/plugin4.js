(function() {
	tinymce.PluginManager.add( 'om_shortcode_plugin', function( editor, url ) {

		function addPopup ( title, id ) {
			om_sc_plugin_popup(id, title);
		}
		
		function addInsert ( title, code_start, code_end) {
			om_sc_plugin_insert(title, code_start, code_end);
		}		
	
    editor.addButton( 'om_shortcode_button', {

        title: 'Insert Shortcode',
        /*text: 'Shortcodes',*/
        icon: 'icon-om-shortcodes',
        type: 'menubutton',
        menu: [
					{ text: "Columns", onclick: function (){ addPopup( "Columns", "columns" ) } },
					{ text: "Buttons", onclick: function (){ addPopup( "Buttons", "buttons" ) } },
					{ text: "Custom Gallery", onclick: function (){ addPopup( "Custom Gallery", "gallery" ) } },
					{ text: "Recent Posts", onclick: function (){ addPopup( "Recent Posts", "recent_posts" ) } },
					{ text: "Recent Portfolios", onclick: function (){ addPopup( "Recent Portfolios", "portfolio" ) } },
					{ text: "Aligned Content", onclick: function (){ addPopup( "Aligned Content", "aligned" ) } },
					{ text: "Toggle Content", onclick: function (){ addPopup( "Toggle Content", "toggle" ) } },
					{ text: "Accordion", onclick: function (){ addPopup( "Accordion", "accordion" ) } },
					{ text: "Tabbed Content", onclick: function (){ addPopup( "Tabbed Content", "tabs" ) } },
					{ text: "Dropcaps", onclick: function (){ addPopup( "Dropcaps", "dropcaps" ) } },
					{ text: "Icons", onclick: function (){ addPopup( "Icons", "icons" ) } },
					{ text: "Marker", onclick: function (){ addPopup( "Marker", "marker" ) } },
					{ text: "Infopane", onclick: function (){ addPopup( "Infopane", "infopane" ) } },
					{ text: "Big pane with Button", onclick: function (){ addPopup( "Big pane with Button", "biginfopane" ) } },
					{ text: "Pullquote", onclick: function (){ addPopup( "Pullquote", "pullquote" ) } },
					{ text: "Simple table", onclick: function (){ addPopup( "Simple table", "table" ) } },
					{ text: "Custom table", onclick: function (){ addInsert( "Custom table", "[custom_table style=\"1\"]YOUR TABLE CODE GOES HERE", "[/custom_table]" ) } },
					{ text: "Pricing Table", onclick: function (){ addPopup( "Pricing Table", "pricing" ) } },
					{ text: "Custom bullets list", onclick: function (){ addPopup( "Custom bullets list", "bullets" ) } },
					{ text: "Custom individual bullets list", onclick: function (){ addPopup( "Custom individual bullets list", "bullets_individual" ) } },
					{ text: "Video Embed", onclick: function (){ addPopup( "Video Embed", "video" ) } },
					{ text: "Logos", onclick: function (){ addInsert( "Logos", "[logos]INSERT IMAGES HERE", "[/logos]" ) } },
					{ text: "Testimonials", onclick: function (){ addPopup( "Testimonials", "testimonials" ) } },
					{ text: "Contact Form", onclick: function (){ addPopup( "Contact Form", "contactform" ) } },
					{ text: "Float clearing", onclick: function (){ addInsert( "Float clearing", "[clear]", "" ) } },
					{ text: "Space", onclick: function (){ addPopup( "Space", "space" ) } },
					{ text: "Divider", onclick: function (){ addInsert( "Divider", "<hr/>", "" ) } }      
        
        ]

    } );	
	
	} );
	
})();