(function() {
	tinymce.PluginManager.add('qode_shortcodes', function( ed, url ) {
		ed.addButton( 'qode_shortcodes', {
			title : window.qodeSCLabel,
			image : window.qodeSCIcon,
			icon: false,
			type: 'menubutton',
			menu: [
				{
					text: 'Blockquote',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Blockquote Shortcode',
							body: [
								{
									type: 'textbox',
									name: 'text',
									label: 'Text',
									multiline: true,
									minWidth: 300,
									minHeight: 100
								},
								{
									type: 'textbox',
									name: 'text_color',
									label: 'Text Color'
								},
								{
									type: 'listbox',
									name: 'title_tag',
									label: 'Title Tag',
									'values': [
										{text: 'h2', value: 'h2'},
										{text: 'h3', value: 'h3'},
										{text: 'h4', value: 'h4'},
										{text: 'h5', value: 'h5'},
										{text: 'h6', value: 'h6'}
									]
								},
								{
									type: 'textbox',
									name: 'width',
									label: 'Width'
								},
								{
									type: 'textbox',
									name: 'line_height',
									label: 'Line Height'
								},
								{
									type: 'textbox',
									name: 'background_color',
									label: 'Background Color'
								},
								{
									type: 'textbox',
									name: 'border_color',
									label: 'Border Color'
								},
								{
									type: 'listbox',
									name: 'show_quote_icon',
									label: 'Show Quote Icon',
									'values': [
										{text: 'No', value: 'no'},
										{text: 'Yes', value: 'yes'}

									]
								},
								{
									type: 'textbox',
									name: 'quote_icon_color',
									label: 'Quote Icon Color'
								},
								{
									type: 'textbox',
									name: 'quote_icon_size',
									label: 'Quote Icon Size'
								}
							],
							onsubmit: function( e ) {
								ed.insertContent( '[no_blockquote text="' + e.data.text + '" text_color="' + e.data.text_color + '" title_tag="' + e.data.title_tag + '" width="' + e.data.width + '" line_height="' + e.data.line_height + '" background_color="' + e.data.background_color + '" border_color="' + e.data.border_color + '" show_quote_icon="' + e.data.show_quote_icon + '" quote_icon_color="' + e.data.quote_icon_color + '" quote_icon_size="' + e.data.quote_icon_size + '"]');
							}
						});
					}
				},
				{
					text: 'Dropcaps',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Dropcaps Shortcode',
							body: [
								{
									type: 'listbox',
									name: 'type',
									label: 'Type',
									'values': [
										{text: 'Normal', value: 'normal'},
										{text: 'Square', value: 'square'},
										{text: 'Circle', value: 'circle'}
									]
								},
								{
									type: 'textbox',
									name: 'letter',
									label: 'Letter'
								},
								{
									type: 'textbox',
									name: 'color',
									label: 'Letter Color'
								},
								{
									type: 'textbox',
									name: 'font_size',
									label: 'Font Size'
								},
								{
									type: 'textbox',
									name: 'line_height',
									label: 'Line Height'
								},
								{
									type: 'textbox',
									name: 'width',
									label: 'Width'
								},
								{
									type: 'listbox',
									name: 'font_weight',
									label: 'Font Weight',
									'values': [
										{text: 'Default', value: ''},
										{text: 'Thin 100', value: '100'},
										{text: 'Extra-Light 200', value: '200'},
										{text: 'Light 300', value: '300'},
										{text: 'Regular 400', value: '400'},
										{text: 'Medium 500', value: '500'},
										{text: 'Semi-Bold 600', value: '600'},
										{text: 'Bold 700', value: '700'},
										{text: 'Extra-Bold 800', value: '800'},
										{text: 'Ultra-Bold 900', value: '900'}
									]
								},
								{
									type: 'listbox',
									name: 'font_style',
									label: 'Font Style',
									'values': [
										{text: 'Default', value: ''},
										{text: 'Normal', value: 'normal'},
										{text: 'Italic', value: 'italic'},

									]
								},
								{
									type: 'listbox',
									name: 'text_align',
									label: 'Text Align',
									'values': [
										{text: 'Default', value: ''},
										{text: 'Left', value: 'left'},
										{text: 'Center', value: 'center'},
										{text: 'Right', value: 'right'}

									]
								},
								{
									type: 'textbox',
									name: 'border_color',
									label: 'Border Color (Only for Square and Circle type)'
								},
								{
									type: 'textbox',
									name: 'background_color',
									label: 'Background Color (Only for Square and Circle type)'
								},
								{
									type: 'textbox',
									name: 'margin',
									label: 'Margin(px)'
								}
							],
							onsubmit: function( e ) {
								ed.insertContent( '[no_dropcaps type="' + e.data.type + '" color="' + e.data.color + '" font_size="' + e.data.font_size + '" line_height="' + e.data.line_height + '" width="' + e.data.width + '" font_weight="' + e.data.font_weight + '" font_style="' + e.data.font_style + '" text_align="' + e.data.text_align + '" border_color="' + e.data.border_color + '" background_color="' + e.data.background_color + '" margin="' + e.data.margin + '"]'+ e.data.letter +'[/no_dropcaps]');
							}
						});
					}
				},
				{
					text: 'Highlights',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Highlights Shortcode',
							body: [
								{
									type: 'textbox',
									name: 'text',
									label: 'Text'
								},
								{
									type: 'textbox',
									name: 'color',
									label: 'Text Color'
								},
								{
									type: 'textbox',
									name: 'background_color',
									label: 'Background Color'
								}
							],
							onsubmit: function( e ) {
								ed.insertContent( '[no_highlight background_color="' + e.data.background_color + '" color="' + e.data.color + '"]'+ e.data.text +'[/no_highlight]');
							}
						});
					}
				},
				{
					text: 'Icon',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Icon Shortcode',
							body: [
								{
									type: 'listbox',
									name: 'icon_pack',
									label: 'Icon Pack',
									'values': [
										{text: 'Font Awesome', value: 'font_awesome'},
										{text: 'Font Elegant', value: 'font_elegant'}
									]
								},
								{
									type: 'textbox',
									name: 'fa_icon',
									label: 'Font Awesome'
								},
								{
									type: 'textbox',
									name: 'fe_icon',
									label: 'Font Elegant'
								},
								{
									type: 'listbox',
									name: 'fa_size',
									label: 'Font Awesome Size',
									'values': [
										{text: 'Tiny', value: 'fa-lg'},
										{text: 'Small', value: 'fa-2x'},
										{text: 'Medium', value: 'fa-3x'},
										{text: 'Large', value: 'fa-4x'},
										{text: 'Very Large', value: 'fa-5x'}
									]
								},
								{
									type: 'textbox',
									name: 'custom_size',
									label: 'Custom Size (px)'
								},
								{
									type: 'listbox',
									name: 'type',
									label: 'Type',
									'values': [
										{text: 'Normal', value: 'normal'},
										{text: 'Circle', value: 'circle'},
										{text: 'Square', value: 'square'}
									]
								},
								{
									type: 'listbox',
									name: 'rotated_shape',
									label: 'Rotated Shape',
									'values': [
										{text: 'No', value: 'no'},
										{text: 'Yes', value: 'yes'}
									]
								},
								{
									type: 'textbox',
									name: 'border_radius',
									label: 'Border Radius (px)'
								},
								{
									type: 'textbox',
									name: 'shape_size',
									label: 'Shape Size (px)'
								},
								{
									type: 'textbox',
									name: 'icon_color',
									label: 'Icon Color'
								},
								{
									type: 'textbox',
									name: 'position',
									label: 'Position'
								},
								{
									type: 'textbox',
									name: 'border_color',
									label: 'Border Color'
								},
								{
									type: 'textbox',
									name: 'border_width',
									label: 'Border Width'
								},
								{
									type: 'textbox',
									name: 'background_color',
									label: 'Background Color'
								},
								{
									type: 'textbox',
									name: 'hover_icon_color',
									label: 'Hover Icon Color'
								},
								{
									type: 'textbox',
									name: 'hover_border_color',
									label: 'Hover Border Color'
								},
								{
									type: 'textbox',
									name: 'hover_background_color',
									label: 'Hover Background Color'
								},
								{
									type: 'textbox',
									name: 'margin',
									label: 'Margin'
								},
								{
									type: 'listbox',
									name: 'icon_animation',
									label: 'Icon Animation',
									'values': [
										{text: 'No', value: ''},
										{text: 'Yes', value: 'icon_animation'},

									]
								},
								{
									type: 'textbox',
									name: 'icon_animation_delay',
									label: 'Icon Animation Delay (ms)'
								},
								{
									type: 'listbox',
									name: 'back_to_top_icon',
									label: 'Use For Back To Top',
									'values': [
										{text: 'No', value: ''},
										{text: 'Yes', value: 'yes'}

									]
								},
								{
									type: 'textbox',
									name: 'link',
									label: 'Link'
								},
								{
									type: 'listbox',
									name: 'anchor_icon',
									label: 'Use Link as Anchor',
									'values': [
										{text: 'No', value: ''},
										{text: 'Yes', value: 'yes'}

									]
								},
								{
									type: 'listbox',
									name: 'target',
									label: 'Target',
									'values': [
										{text: 'Self', value: '_self'},
										{text: 'Blank', value: '_blank'},

									]
								}
							],
							onsubmit: function( e ) {
								ed.insertContent( '[no_icons icon_pack="' + e.data.icon_pack + '" fa_icon="' + e.data.fa_icon + '" fe_icon="' + e.data.fe_icon + '" fa_size="' + e.data.fa_size + '" custom_size="' + e.data.custom_size + '" type="' + e.data.type + '" rotated_shape="' + e.data.rotated_shape + '" border_radius="' + e.data.border_radius + '" shape_size="' + e.data.shape_size + '" icon_color="' + e.data.icon_color + '" position="' + e.data.position + '" border_color="' + e.data.border_color + '" border_width="' + e.data.border_width + '" background_color="' + e.data.background_color + '" hover_icon_color="' + e.data.hover_icon_color + '" hover_border_color="' + e.data.hover_border_color + '" hover_background_color="' + e.data.hover_background_color + '" margin="' + e.data.margin + '" icon_animation="' + e.data.icon_animation + '" icon_animation_delay="' + e.data.icon_animation_delay + '" back_to_top_icon="' + e.data.back_to_top_icon + '" link="' + e.data.link + '" anchor_icon="' + e.data.anchor_icon + '" target="' + e.data.target + '"]');
							}
						});
					}
				},
				{
					text: 'Ordered List',
					onclick: function() {
						ed.insertContent('[no_ordered_list]<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>[/no_ordered_list]');
					}
				},
				{
					text: 'Unordered List',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Unordered List Shortcode',
							body: [
								{
									type: 'listbox',
									name: 'style',
									label: 'Style',
									'values': [
										{text: 'Circle', value: 'circle'},
										{text: 'Number', value: 'number'}
									]
								},
								{
									type: 'listbox',
									name: 'number_type',
									label: 'Number Type (Only for Number style)',
									'values': [
										{text: 'Circle', value: 'circle_number'},
										{text: 'Transparent', value: 'transparent_number'}
									]
								},
								{
									type: 'listbox',
									name: 'animate',
									label: 'Animate List',
									'values': [
										{text: 'Yes', value: 'yes'},
										{text: 'No', value: 'no'}
									]
								},
								{
									type: 'listbox',
									name: 'font_weight',
									label: 'Font Weight',
									'values': [
										{text: 'Default', value: ''},
										{text: 'Light', value: 'light'},
										{text: 'Normal', value: 'normal'},
										{text: 'Bold', value: 'bold'}
									]
								}
							],
							onsubmit: function( e ) {
								ed.insertContent('[no_unordered_list style="' + e.data.style + '" number_type="' + e.data.number_type + '" animate="' + e.data.animate + '" font_weight="' + e.data.font_weight + '"]<ul><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li></ul>[/no_unordered_list]');
							}
						});
					}
				},
				{
					text: 'Separator',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Separator Shortcode',
							body: [
								{
									type: 'listbox',
									name: 'type',
									label: 'Type',
									'values': [
										{text: 'Normal', value: 'normal'},
										{text: 'Transparent', value: 'transparent'},
										{text: 'Small', value: 'small'}
									]
								},
								{
									type: 'listbox',
									name: 'position',
									label: 'Position (Only for small type)',
									'values': [
										{text: 'Left', value: 'left'},
										{text: 'Center', value: 'center'},
										{text: 'Right', value: 'right'}
									]
								},
								{
									type: 'textbox',
									name: 'color',
									label: 'Color'
								},
								{
									type: 'listbox',
									name: 'border_style',
									label: 'Border style',
									'values': [
										{text: 'Dashed', value: 'dashed'},
										{text: 'Solid', value: 'solid'},
										{text: 'Dotted', value: 'dotted'}
									]
								},
								{
									type: 'textbox',
									name: 'width',
									label: 'Width (Only for small type)'
								},
								{
									type: 'textbox',
									name: 'thickness',
									label: 'Thickness'
								},
								{
									type: 'textbox',
									name: 'up',
									label: 'Margin Top'
								},
								{
									type: 'textbox',
									name: 'down',
									label: 'Margin Bottom'
								}
							],
							onsubmit: function( e ) {
								ed.insertContent('[vc_separator type="' + e.data.type + '" position="' + e.data.position + '" color="' + e.data.color + '" border_style="' + e.data.border_style + '" width="' + e.data.width + '" thickness="' + e.data.thickness + '" up="' + e.data.up + '" down="' + e.data.down + '"]');
							}
						});
					}
				},
				{
					text: 'Custom Font',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Custom Font Shortcode',
							body: [
								{
									type: 'textbox',
									name: 'content',
									label: 'Text',
									multiline: true,
									minWidth: 300,
									minHeight: 100
								},
								{
									type: 'textbox',
									name: 'font_family',
									label: 'Font Family'
								},
								{
									type: 'textbox',
									name: 'font_size',
									label: 'Font Size'
								},
								{
									type: 'textbox',
									name: 'line_height',
									label: 'Line Height'
								},
								{
									type: 'listbox',
									name: 'font_style',
									label: 'Font Style',
									'values': [
										{text: 'Normal', value: 'normal'},
										{text: 'Italic', value: 'italic'}
									]
								},
								{
									type: 'listbox',
									name: 'text_align',
									label: 'Text Align',
									'values': [
										{text: 'Left', value: 'left'},
										{text: 'Center', value: 'center'},
										{text: 'Right', value: 'right'}
									]
								},
								{
									type: 'textbox',
									name: 'font_weight',
									label: 'Font Weight'
								},
								{
									type: 'textbox',
									name: 'color',
									label: 'Color'
								},
								{
									type: 'listbox',
									name: 'text_decoration',
									label: 'Text Decoration',
									'values': [
										{text: 'Dashed', value: 'none'},
										{text: 'Underline', value: 'underline'},
										{text: 'Overline', value: 'overline'},
										{text: 'Line Through', value: 'line-through'}
									]
								},
								{
									type: 'listbox',
									name: 'text_shadow',
									label: 'Text Shadow',
									'values': [
										{text: 'No', value: 'no'},
										{text: 'Yes', value: 'yes'}
									]
								},
								{
									type: 'textbox',
									name: 'letter_spacing',
									label: 'Letter Spacing(px)'
								},
								{
									type: 'textbox',
									name: 'background_color',
									label: 'Background Color'
								},
								{
									type: 'textbox',
									name: 'padding',
									label: 'Padding (5px 5px 5px 5px)'
								},
								{
									type: 'textbox',
									name: 'margin',
									label: 'Margin'
								},
								{
									type: 'listbox',
									name: 'show_in_border_box',
									label: 'Show in Border Box',
									'values': [
										{text: 'No', value: 'no'},
										{text: 'Yes', value: 'yes'}
									]
								},
								{
									type: 'textbox',
									name: 'border_color',
									label: 'Border Color'
								},
								{
									type: 'textbox',
									name: 'border_width',
									label: 'Border Width'
								},
								{
									type: 'textbox',
									name: 'text_background_color',
									label: 'Text Background Color'
								},
								{
									type: 'textbox',
									name: 'text_padding',
									label: 'Text Padding'
								}

							],
							onsubmit: function( e ) {
								ed.insertContent('[no_custom_font font_family="' + e.data.font_family + '" font_size="' + e.data.font_size + '" line_height="' + e.data.line_height + '" font_style="' + e.data.font_style + '" text_align="' + e.data.text_align + '" font_weight="' + e.data.font_weight + '" color="' + e.data.color + '" text_decoration="' + e.data.text_decoration + '" text_shadow="' + e.data.text_shadow + '" letter_spacing="' + e.data.letter_spacing + '" background_color="' + e.data.background_color + '" padding="' + e.data.padding + '" margin="' + e.data.margin + '" show_in_border_box="' + e.data.show_in_border_box + '" border_color="' + e.data.border_color + '" border_width="' + e.data.border_width + '" text_background_color="' + e.data.text_background_color + '" text_padding="' + e.data.text_padding + '"]'+ e.data.content +'[/no_custom_font]');
							}
						});
					}
				},
				{
					text: 'Icon List Item',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Icon List Item Shortcode',
							body: [
								{
									type: 'listbox',
									name: 'icon_pack',
									label: 'Icon Pack',
									'values': [
										{text: 'Font Awesome', value: 'font_awesome'},
										{text: 'Font Elegant', value: 'font_elegant'}
									]
								},
								{
									type: 'textbox',
									name: 'fa_icon',
									label: 'Icon (For Font Awesome)'
								},
								{
									type: 'textbox',
									name: 'fe_icon',
									label: 'Icon (For Font Elegant)'
								},
								{
									type: 'listbox',
									name: 'icon_type',
									label: 'Icon Type',
									'values': [
										{text: 'Normal', value: 'normal_icon_list'},
										{text: 'Small', value: 'small_icon_list'}
									]
								},
								{
									type: 'textbox',
									name: 'icon_color',
									label: 'Icon Color'
								},
								{
									type: 'listbox',
									name: 'border_type',
									label: 'Border Type',
									'values': [
										{text: '', value: ''},
										{text: 'Circle', value: 'circle'},
										{text: 'Square', value: 'square'}
									]
								},
								{
									type: 'textbox',
									name: 'border_color',
									label: 'Border Color'
								},
								{
									type: 'textbox',
									name: 'title',
									label: 'Title'
								},
								{
									type: 'textbox',
									name: 'title_color',
									label: 'Title Color'
								},
								{
									type: 'textbox',
									name: 'title_size',
									label: 'Title Size (px)'
								}
							],
							onsubmit: function( e ) {
								ed.insertContent('[no_icon_list_item icon_pack="' + e.data.icon_pack + '" fa_icon="' + e.data.fa_icon + '" fe_icon="' + e.data.fe_icon + '" icon_type="' + e.data.icon_type + '" icon_color="' + e.data.icon_color + '" border_type="' + e.data.border_type + '" border_color="' + e.data.border_color + '" title_color="' + e.data.title_color + '" title_size="' + e.data.title_size + '"]');
							}
						});
					}
				}
			]
		});
	});
})();