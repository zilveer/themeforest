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
					{ text: "Agenda", onclick: function (){ addPopup( "Agenda", "agenda" ) } },
					{ text: "Speakers", onclick: function (){ addPopup( "Speakers", "speaker" ) } },
					{ text: "Logos", onclick: function (){ addInsert( "Logos", "[logos]INSERT IMAGES HERE", "[/logos]" ) } },
					{ text: "Registration form", onclick: function (){ addPopup( "Registration form", "registration" ) } },
					{ text: "Aligned Content", onclick: function (){ addPopup( "Aligned Content", "aligned" ) } },
					{ text: "Toggle Content", onclick: function (){ addPopup( "Toggle Content", "toggle" ) } },
					{ text: "Accordion", onclick: function (){ addPopup( "Accordion", "accordion" ) } },
					{ text: "Tabbed Content", onclick: function (){ addPopup( "Tabbed Content", "tabs" ) } },
					{ text: "Testimonial", onclick: function (){ addPopup( "Testimonial", "testimonial" ) } },
					{ text: "Dropcaps", onclick: function (){ addPopup( "Dropcaps", "dropcaps" ) } },
					{ text: "Big Header", onclick: function (){ addInsert( "Big Header", "[big_header]", "[/big_header]" ) } },
					{ text: "Icons", onclick: function (){ addPopup( "Icons", "icons" ) } },
					{ text: "Marker", onclick: function (){ addPopup( "Marker", "marker" ) } },
					{ text: "Infopane", onclick: function (){ addPopup( "Infopane", "infopane" ) } },
					{ text: "Big pane with Button", onclick: function (){ addPopup( "Big pane with Button", "biginfopane" ) } },
					{ text: "Custom table", onclick: function (){ addInsert( "Custom table", "[custom_table]YOUR TABLE CODE GOES HERE", "[/custom_table]" ) } },
					{ text: "Custom bullets list", onclick: function (){ addPopup( "Custom bullets list", "bullets" ) } },
					{ text: "Custom individual bullets list", onclick: function (){ addPopup( "Custom individual bullets list", "bullets_individual" ) } },
					{ text: "Video", onclick: function (){ addPopup( "Video", "video" ) } },
					{ text: "Map", onclick: function (){ addPopup( "Map", "map" ) } },
					{ text: "Float clearing", onclick: function (){ addInsert( "Float clearing", "[clear]", "" ) } },
					{ text: "Space", onclick: function (){ addPopup( "Space", "space" ) } }
        ]

    } );	
	
	} );
	
})();