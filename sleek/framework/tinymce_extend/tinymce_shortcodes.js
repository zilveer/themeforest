/* Shortcodes List
/*------------------------------------------------------------*/

(function() {
"use strict";

tinymce.PluginManager.add('sleek_tinymce_extend', function(editor, url) {



	// Add a button for getting background control
	editor.addButton('sleek_background', {
		text: 'Get Background',
		icon: false,
		onclick: function() {
			// trigger custom event for BG Control Script
			jQuery(document).trigger('sleek:tinymceGetBgClick', editor);
		}
	});



	// Add a button for icon picker
	editor.addButton('sleek_icons', {
		text: 'Get Icon',
		icon: false,
		onclick: function() {
			// trigger custom event for Icon Picker Script
			jQuery(document).trigger('sleek:tinymceGetIconClick', {
				editor:editor,
				shortcode:false
			});
		}
	});



	// Adds a dropdown menu with typography elements
	editor.addButton('sleek_typography', {
		type: 'menubutton',
		text: 'Typography',
		icon: false,
		menu: [
			{
				text: 'Separator',
				onclick: function() {
					editor.insertContent('[separator size="medium" center="false" empty="false" opaque="false" margin_top="" margin_bottom=""]');
				}
			},
			{
				text: 'Custom Title',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = 'Custom Title';
					}
					editor.insertContent('[title above="" h1="false" center="true"]'+selection+'[/title]');
				}
			},
			{
				text: 'Custom Heading',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = 'Heading';
					}
					editor.insertContent('[custom_heading center="true"]'+selection+'[/custom_heading]');
				}
			},
			{
				text: 'Icon',
				onclick: function() {
					jQuery(document).trigger('sleek:tinymceGetIconClick', {
						editor:editor,
						shortcode:true
					});
				}
			},
			{
				text: 'Dropcap',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = 'X';
					}

					editor.insertContent('[dropcap style=""]'+selection+'[/dropcap]');
				}
			},
			{
				text: 'Blockquote',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = 'Blockquote text';
					}

					editor.insertContent('<blockquote class="blockquote--custom"><span class="blockquote__icon"><i class="icon-quote"></i>&nbsp;</span><p>'+selection+'</p><cite>Cite text</cite></blockquote>');
				}
			},
			{
				text: 'Highlighted Text',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = 'Highlighted Text';
					}

					editor.insertContent('[highlighted_text]'+selection+'[/highlighted_text]');
				}
			},
			{
				text: 'Highlighted Paragraph',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = 'Paragraph Content';
					}

					editor.insertContent('[highlighted_p boxed="false" center="false"]'+selection+'[/highlighted_p]');
				}
			},
			{
				text: 'Horizontal Clear',
				onclick: function() {
					editor.insertContent('<hr class="clear">');
				}
			}
		]
	});

	// Adds a dropdown menu with shortcodes
	editor.addButton('sleek_elements', {
		type: 'menubutton',
		text: 'Elements',
		icon: false,
		menu: [
			/*{
				text: 'Page Marker',
				onclick: function() {
					editor.insertContent('[page_marker title=""]');
				}
			},*/
			{
				text: 'Button',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = 'My Button';
					}
					editor.insertContent('[button url="#" new_tab="false" size="medium" style="solid" color="false" light="false"]'+selection+'[/button]');
				}
			},
			{
				text: 'CTA',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = 'Text';
					}
					editor.insertContent('[cta btn_text="" btn_url="" bg="" bg_light="true" appear="false"]'+selection+'[/cta]');
				}
			},
			{
				text: 'Progress Bar',
				onclick: function() {
					var selection = editor.selection.getContent({ 'format' : 'text' });
					if( !selection || selection.length === 0 ){
						selection = '';
					}
					editor.insertContent('[progress_bar title="'+selection+'" percent="" color="grey"]');
				}
			},
			{
				text: 'Icon Badge',
				onclick: function() {
					editor.insertContent('[icon_badge icon="" size="medium" style="grey" url="" tooltip="" tooltip_location=""]');
				}
			},
			{
				text: 'Slider',
				onclick: function() {
					editor.insertContent('[slider slides="n,n,n" height="" padding="70" effect="pulse" interval="4000" control="arrows"]');
				}
			},
			{
				text: 'Image Slider',
				onclick: function() {
					editor.insertContent('[image_slider slides="n,n,n" height="" effect="pulse" interval="4000" control="arrows"]');
				}
			},
			{
				text: 'Blog',
				onclick: function() {
					editor.insertContent('[blog title="" title_above="" posts="8" style="list" category="" sort_by="date" sort_order="DESC" carousel_arrows="false" carousel_grid="3" interval="4000" slider_effect="slide_x" slider_control="arrows"]');
				}
			},
			/*{
				text: 'Portfolio',
				onclick: function() {
					editor.insertContent('[portfolio posts_per_page="" pagination="" style="" category="" sort_by="" sort_order=""]');
				}
			},*/
			{
				text: 'Gmap',
				onclick: function() {
					editor.insertContent('[gmap lat="48.851978" lng="2.348151" zoom="14" pin="" scrollable="false" height=""]This is my bubble content.[/gmap]');
				}
			},
			{
				text: 'Social Links',
				onclick: function() {
					editor.insertContent('[social style_big="false" icon_name="url"]');
				}
			}
		]
	});

	// Adds a split button|menu with grid stuff
	editor.addButton('sleek_layout', {
		type: 'menubutton',
		text: 'Grid Layout',
		icon: false,
		menu: [
			{
				text: 'Grid 1/1',
				onclick: function() {
					editor.insertContent('[row padding_top="" padding_bottom="" bg="" bg_light="true" appear="false"] [column size="1-1" appear="false"][/column] [/row]');
				}
			},
			{
				text: 'Grid 1/2 + 1/2',
				onclick: function() {
					editor.insertContent('[row padding_top="" padding_bottom="" bg="" bg_light="true" appear="false"] [column size="1-2" appear="false"][/column] [column size="1-2" appear="false"][/column] [/row]');
				}
			},
			{
				text: 'Grid 1/3 + 1/3 + 1/3',
				onclick: function() {
					editor.insertContent('[row padding_top="" padding_bottom="" bg="" bg_light="true" appear="false"] [column size="1-3" appear="false"][/column] [column size="1-3" appear="false"][/column] [column size="1-3" appear="false"][/column] [/row]');
				}
			},
			{
				text: 'Grid 2/3 + 1/3',
				onclick: function() {
					editor.insertContent('[row padding_top="" padding_bottom="" bg="" bg_light="true" appear="false"] [column size="2-3" appear="false"][/column] [column size="1-3" appear="false"][/column] [/row]');
				}
			},
			{
				text: 'Grid 1/3 + 2/3',
				onclick: function() {
					editor.insertContent('[row padding_top="" padding_bottom="" bg="" bg_light="true" appear="false"] [column size="1-3" appear="false"][/column] [column size="2-3" appear="false"][/column] [/row]');
				}
			},
			{
				text: 'Grid 1/4 + 1/4 + 1/4 + 1/4',
				onclick: function() {
					editor.insertContent('[row padding_top="" padding_bottom="" bg="" bg_light="true" appear="false"] [column size="1-4" appear="false"][/column] [column size="1-4" appear="false"][/column] [column size="1-4" appear="false"][/column] [column size="1-4" appear="false"][/column] [/row]');
				}
			}
		]
	});



});

})();


