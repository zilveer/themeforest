;( function( $ ) {
	'use strict';

	var fontMenu = [];

	//console.log( fontMenu );

	//Shortcodes
	tinymce.PluginManager.add( 'WolfShortcodesTinyMce', function( editor, url ) {

		editor.addCommand( 'wolfPopup', function ( a, params )
		{
			var popup = params.identifier;
			// console.log( popup );
			tb_show( 'Insert Shortcode', url + "/popup.php?popup=" + popup + "&width=800" );

		});

		editor.addButton( 'wolf_shortcodes_tiny_mce_button', {
			type: 'splitbutton',
			icon: false,
			title:  'Shortcodes',
			menu: [
				{ text: WolfTinyMceParams.dropcap, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.dropcap, identifier: 'dropcap' } )
				} },
				{ text: WolfTinyMceParams.button, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.button, identifier: 'button' } )
				} },
				{ text: WolfTinyMceParams.alert, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.alert, identifier: 'alert' } )
				} },
				{ text: WolfTinyMceParams.highlight, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.highlight, identifier: 'highlight' } )
				} },
				{ text: WolfTinyMceParams.spacer, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.spacer, identifier: 'spacer' } )
				} },
				{ text: WolfTinyMceParams.fittext, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.fittext, identifier: 'fittext' } )
				} },
				{ text: WolfTinyMceParams.mailchimp, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.mailchimp, identifier: 'mailchimp' } )
				} },
				{ text: WolfTinyMceParams.socials, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.socials, identifier: 'socials' } )
				} },
				{ text: WolfTinyMceParams.columns, onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: WolfTinyMceParams.columns, identifier: 'columns' } )
				} }
			]
		} );
	} );

} )( jQuery );