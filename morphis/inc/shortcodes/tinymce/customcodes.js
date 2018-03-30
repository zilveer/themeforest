(function ($) {
	"use strict";
	if (tinymce.majorVersion < 4) {		
		// create pulpFrameWorkShortCodes plugin
		tinymce.create("tinymce.plugins.pulpFrameWorkShortCodes",
		{
			init: function ( ed, url ) {
				ed.addCommand("pulpPopup", function ( a, params ) {
					var popup = params.identifier;
					tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 900);
				});				
			},
			createControl: function ( btn, e ) {
				if ( btn == "pulp_framework_button" ) {	
					var a = this;					
					var btn = e.createSplitButton('pulp_framework_button', {
						title: "Insert Shortcode",
						image: PulpShortcodes.tinymce_folder +"/images/plus.png",
						icons: false
					});

					btn.onRenderMenu.add(function (c, b) {						
						c=b.addMenu({title:"Typography"});
							a.addWithPopup(c,"Dropcap","dropcap" );
							a.addWithPopup(c,"Blockquote","blockquote" );
							a.addWithPopup(c,"Highlight","highlight" );
							a.addWithPopup(c,"Custom Typography","typography" );						
							a.addWithPopup(c,"Centered Header","centered_heading" );								
							a.addWithPopup(c,"Lists","lists" );		
						a.addWithPopup( b, "LayerSlider", "layerslider" );
						a.addWithPopup( b, "Buttons", "button" );
						a.addWithPopup( b, "Columns", "columns" );					
						a.addWithPopup( b, "Tabs", "tabs" );
						a.addWithPopup( b, "Accordions", "accordions" );
						a.addWithPopup( b, "Image Floats", "image_floats" );
						a.addWithPopup( b, "Dividers/Hr Line","hr_line");					
						a.addWithPopup( b, "Notification Boxes", "info_boxes" );					
						a.addWithPopup( b, "Price Boxes", "price_boxes" );					
						a.addWithPopup( b, "Call Out Box", "call_out" );
						c=b.addMenu({title:"Social Media Links"});
							a.addWithPopup( c, "Twitter Share", "twitter_share" );	
							a.addWithPopup( c, "Facebook Like", "facebook_like" );	
							a.addWithPopup( c, "Pinterest Pin It Button", "pin_it_button" );	
							a.addWithPopup( c, "Google Plus One Button", "plus_one" );	
						c=b.addMenu({title:"Media"});
							a.addWithPopup( c, "YouTube", "youtube" );					
							a.addWithPopup( c, "Vimeo", "vimeo" );					
							a.addWithPopup( c, "Google Map", "gmap" );																		
						c=b.addMenu({title:"Misc"});
							a.addWithPopup( c, "Clearing", "clear" );
							a.addWithPopup( c, "Team Member", "team_members" );	
					});					
					return btn;
				} 				
				return null;
			},
			addWithPopup: function ( ed, title, id ) {
				ed.add({
					title: title,
					onclick: function () {
						tinyMCE.activeEditor.execCommand("pulpPopup", false, {
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
					longname: 'Pulp Themes Framework Shortcodes',
					author: 'Jan Intia',
					authorurl: 'http://themeforest.net/user/janintia/',
					infourl: 'http://wiki.moxiecode.com/',
					version: "1.0"
				}
			}
		});		
		// add pulpFrameWorkShortCodes plugin
		tinymce.PluginManager.add("pulpFrameWorkShortCodes", tinymce.plugins.pulpFrameWorkShortCodes);		
	} else {	
		tinymce.create('tinymce.plugins.pulpFrameWorkShortCodes', {
			init : function(ed, url) {
				var a = this;	
			
				ed.addCommand("pulpPopup", function ( a, params ) {
					var popup = params.identifier;
					tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 900);
				});
			
				ed.addButton( 'pulp_framework_button', {
					type: 'listbox',
					text: 'Morphis Shortcodes',
					icon: false,
					onselect: function(e) {
					}, 
					values: [
						{text: 'Dropcap', onclick : function() { a.addWithPopup("Dropcap","dropcap" ); }},
						{text: 'Blockquote', onclick : function() { a.addWithPopup("Blockquote","blockquote" ); }},
						{text: 'Highlight', onclick : function() { a.addWithPopup("Highlight","highlight" ); }},
						{text: 'Custom Typography', onclick : function() { a.addWithPopup("Custom Typography","typography" ); }},
						{text: 'Centered Header', onclick : function() { a.addWithPopup("Centered Header","centered_heading" ); }},
						{text: 'Lists', onclick : function() { a.addWithPopup("Lists","lists" ); }},
						{text: 'LayerSlider', onclick : function() { a.addWithPopup("LayerSlider","layerslider" ); }},
						{text: 'Buttons', onclick : function() { a.addWithPopup("Buttons","button" ); }},
						{text: 'Columns', onclick : function() { a.addWithPopup("Columns","columns" ); }},
						{text: 'Tabs', onclick : function() { a.addWithPopup("Tabs","tabs" ); }},
						{text: 'Accordions', onclick : function() { a.addWithPopup("Accordions","accordions" ); }},
						{text: 'Image Floats', onclick : function() { a.addWithPopup("Image Floats","image_floats" ); }},
						{text: 'Dividers/Hr Line', onclick : function() { a.addWithPopup("Dividers/HR Line","hr_line" ); }},
						{text: 'Notification Boxes', onclick : function() { a.addWithPopup("Notification Boxes","info_boxes" ); }},
						{text: 'Price Boxes', onclick : function() { a.addWithPopup("Price Boxes","price_boxes" ); }},
						{text: 'Call Out Box', onclick : function() { a.addWithPopup("Call Out Box","call_out" ); }},
						{text: 'Twitter Share', onclick : function() { a.addWithPopup("Twitter Share","twitter_share" ); }},
						{text: 'Facebook Like', onclick : function() { a.addWithPopup("Facebook Like","facebook_like" ); }},
						{text: 'Pinterest Pin-it Button', onclick : function() { a.addWithPopup("Pinterest Pin-it Button","pin_it_button" ); }},
						{text: 'Google Plus One Button', onclick : function() { a.addWithPopup("Google Plus One Button","plus_one" ); }},
						{text: 'YouTube', onclick : function() { a.addWithPopup("YouTube","youtube" ); }},
						{text: 'Vimeo', onclick : function() { a.addWithPopup("Vimeo","vimeo" ); }},
						{text: 'Google Map', onclick : function() { a.addWithPopup("Google Map","gmap" ); }},
						{text: 'Clearing', onclick : function() { a.addWithPopup("Clearing","clear" ); }},
						{text: 'Team Member', onclick : function() { a.addWithPopup("Team Member","team_members" ); }},
					]
				});     
			},
			addWithPopup: function ( title, id ) {			
				tinyMCE.activeEditor.execCommand("pulpPopup", false, {
					title: title,
					identifier: id,
				});
			},
		});

		tinymce.PluginManager.add('pulpFrameWorkShortCodes', tinymce.plugins.pulpFrameWorkShortCodes);	
	}

})(jQuery);
