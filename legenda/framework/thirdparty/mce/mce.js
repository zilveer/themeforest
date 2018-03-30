(function() {
	tinymce.PluginManager.add('et_mce_button', function( editor, url ) {
		editor.addButton( 'et_mce_button', {
            icon: ' et-shortcodes-icon ',
			tooltip: 'Etheme Shortcodes',
			type: 'menubutton',
			minWidth: 210,
			menu: [

			// Start Alerts block
				{
					text: 'Alerts',
					menu: [

						// Success block
						{
							text: 'Success',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Success settings',
									body: [
										{	
											type: 'textbox',
											name: 'Title',
											label: 'Alert title',
											value: 'Well done - Success alert box!',
										},
										{	
											type: 'textbox',
											name: 'Message',
											label: 'Your message',
											value: 'Your message!',
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[alert type="success" title="' + e.data.Title + '"]' + e.data.Message + '[/alert]');
									}
								});
							}
						},

						// Error block
						{
							text: 'Error',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Error settings',
									body: [
										{	
											type: 'textbox',
											name: 'Title',
											label: 'Alert title',
											value: 'Whoops - Error alert box!',
										},
										{	
											type: 'textbox',
											name: 'Message',
											label: 'Your message',
											value: 'Your message!',
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[alert type="error" title="' + e.data.Title + '"]' + e.data.Message + '[/alert]');
									}
								});
							}
						},

						// Info block
						{
							text: 'Info',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Info settings',
									body: [
										{	
											type: 'textbox',
											name: 'Title',
											label: 'Alert title',
											value: 'Heads Up - Info alert box!',
										},
										{	
											type: 'textbox',
											name: 'Message',
											label: 'Your message',
											value: 'Your message!',
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[alert type="info" title="' + e.data.Title + '"]' + e.data.Message + '[/alert]');
									}
								});
							}
						},

						// Info Warning
						{
							text: 'Warning',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Warning settings',
									body: [
										{	
											type: 'textbox',
											name: 'Title',
											label: 'Alert title',
											value: 'Heads Up - Warning alert box!',
										},
										{	
											type: 'textbox',
											name: 'Message',
											label: 'Your message',
											value: 'Your message!',
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[alert type="warning" title="' + e.data.Title + '"]' + e.data.Message + '[/alert]');
									}
								});
							}
						},

					]
				}, // End Alerts block

				// Start Statick Block
				{
					text: 'Statick Block',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Statick Block settings',
							body: [
								{	
									type: 'textbox',
									name: 'ID',
									label: 'Block ID',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[block id= "' + e.data.ID + '"]');
							}
						});
					}
				}, // End Statick Block

				// Start Dropcaps Block
				{
					text: 'Dropcaps',
					menu: [
						{
							text: 'Light',
							onclick: function() {
								editor.insertContent( '[dropcap style="light"][/dropcap]');
							}
						},
						{
							text: 'Dark',
							onclick: function() {
								editor.insertContent( '[dropcap style="dark"][/dropcap]');
							}
						},
					]
				}, // End Dropcaps Block

				// Start Blockquotes Block
				{
					text: 'Blockquote',
					menu: [
						{
							text: 'Style 1',
							onclick: function() {
								editor.insertContent( '[blockquote][/blockquote]');
							}
						},
						{
							text: 'Style 2',
							onclick: function() {
								editor.insertContent( '[blockquote class="style2"][/blockquote]');
							}
						},
					]
				}, // End Blockquotes Block

				// Start Counter
				{
					text: 'Counter',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Counter Block settings',
							body: [
								{	
									type: 'textbox',
									name: 'Init',
									label: 'Init value',
									value: '0',
								},
								{	
									type: 'textbox',
									name: 'Final',
									label: 'Final value',
									value: '1000',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[counter init_value="' + e.data.Init + '" final_value="' + e.data.Final + '"]');
							}
						});
					}
				}, // End Counter

				// Start Icon
				{
					text: 'Icon',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Icon settings',
							body: [
								{	
									type: 'textbox',
									name: 'Name',
									label: 'Name',
									value: 'star',
								},
								{	
									type: 'textbox',
									name: 'Size',
									label: 'Size',
									value: '20',
								},
								{	
									type: 'textbox',
									name: 'Color',
									label: 'Color',
									value: '#fc5a5a',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[icon name="' + e.data.Name + '" Size="' + e.data.Size + '" Color="' + e.data.Color + '"]');
							}
						});
					}
				}, // End Icon

				// Start Title
				{
					text: 'Title',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Title settings',
							body: [
								{	
									type: 'textbox',
									name: 'Title',
									label: 'Title',
									value: 'Your title',
								},
								{	
									type: 'textbox',
									name: 'Subtitle',
									label: 'Subtitle',
									value: 'Your subtitle',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[title subtitle="' + e.data.Subtitle + '"]' + e.data.Title + '[/title]');
							}
						});
					}
				}, // End Title

				// Start Button
				{
					text: 'Button',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Button settings',
							body: [
								{
									type: 'listbox',
									name: 'StyleBt',
									label: 'Style',
									'values': [
										{text: 'Default', value: ''},
										{text: 'Filled', value: 'filled'},

									]
								},
								{
									type: 'listbox',
									name: 'Size',
									label: 'Size',
									'values': [
										{text: 'Small', value: 'small'},
										{text: 'Medium', value: 'medium'},
										{text: 'Big', value: 'big'},
									]
								},
								{
									type: 'listbox',
									name: 'Arrow',
									label: 'Arrow',
									'values': [
										{text: 'Without', value: ''},
										{text: 'Left', value: 'arrow-left'},
										{text: 'Right', value: 'arrow-right'},
									]
								},
								{
									type: 'textbox',
									name: 'Icon',
									label: 'Icon',
									value: ''
								},
								{
									type: 'textbox',
									name: 'TextBt',
									label: 'Text',
									value: 'Button text'
								},
								{
									type: 'textbox',
									name: 'URL',
									label: 'URL',
								}

							],
							onsubmit: function( e ) {
								editor.insertContent( '[button style="'+ e.data.Size + ' ' + e.data.StyleBt + ' ' + e.data.Arrow + '" icon="' + e.data.Icon + '" title="' + e.data.TextBt + '" url="' + e.data.URL + '"]');
							}
						});
					}
				}, // End Button

				// Start Unordered List
				{
					text: 'Unordered List',
					onclick: function() {
						editor.windowManager.open( {
							title: 'List params',
							body: [
								{
									type: 'listbox',
									name: 'StyleList',
									label: 'Style',
									'values': [
										{text: 'Square', value: 'square'},
										{text: 'Circle', value: 'circle'},
										{text: 'Arrow', value: 'arrow'},
										{text: 'Star', value: 'star'},
										{text: 'Dash', value: 'dash'},
									]
								}
							],
							onsubmit: function( e ) {

								var html = [
									'<ul>',
										'<li>List item 1</li>',
										'<li>List item 2</li>',
										'<li>List item 3</li>',
									'</ul>',
								].join('\n');

								editor.insertContent( '[checklist style="' + e.data.StyleList + '"]' + html + '[/checklist]');
							}
						});
					}
				}, // End Unordered List

				// Start Toggle
				{
					text: 'Toggle',
					menu: [

						// Toggle body
						{
							text: 'Toggle body',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Toggle body settings',
									body: [
										{	
											type: 'listbox',
											name: 'StyleBorder',
											label: 'Bordered',
											'values': [
												{text: 'On', value: 'bordered'},
												{text: 'Off', value: 'noBordered '},
											]
										},
										{	
											type: 'listbox',
											name: 'StyleMulty',
											label: 'Multiple',
											'values': [
												{text: 'On', value: 'multiple'},
												{text: 'Off', value: 'noMultiple'},
											]
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[toggle_block class="' + e.data.StyleBorder + ' ' + e.data.StyleMulty + '"][/toggle_block]');
									}
								});
							}
						},

						// Single toggle
						{
							text: 'Toggle',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Toggle settings',
									body: [
										{	
											type: 'textbox',
											name: 'Title',
											label: 'Title',
											value: 'Toggle title',
										},
										{	
											type: 'textbox',
											name: 'Content',
											label: 'Content',
											value: 'Toggle content',
											multiline: true,
											minWidth: 300,
											minHeight: 100,
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[toggle title="' + e.data.Title + '"]' + e.data.Content + '[/toggle]');
									}
								});
							}
						},
					]
				}, // End Toggle

				// Start Googlechart
				{
					text: 'Googlechart',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Title settings',
							body: [
								{	
									type: 'textbox',
									name: 'Title',
									label: 'Title',
									value: 'Your title',
								},
								{
									type: 'listbox',
									name: 'StyleList',
									label: 'Style',
									'values': [
										{text: 'Pie', value: 'pie'},
										{text: 'Pie2d', value: 'pie2d'},
										{text: 'Line', value: 'line'},
										{text: 'Xyline', value: 'xyline'},
										{text: 'Scatter', value: 'scatter'},
									]
								},
								{	
									type: 'textbox',
									name: 'Labels',
									label: 'Labels',
									value: '1|2|3|4|5|6|7|8|9|10',
								},
								{	
									type: 'textbox',
									name: 'Data',
									label: 'Data',
									value: '0,10,20,30,40,50,60,70,80,90,100|20,30,34,55,70,85,111,80,70,40,20',
								},
								{	
									type: 'textbox',
									name: 'DataColor',
									label: 'Data color',
									value: 'fc715b',
								},

							],
							onsubmit: function( e ) {
								editor.insertContent( '[googlechart title="' + e.data.Title + '" type="' + e.data.StyleList + '" labels="' + e.data.Labels + '" data="' + e.data.Data + '" data_colours="' + e.data.DataColor + '"]');
							}
						});
					}
				}, // End Googlechart

				// Start Video
				{
					text: 'Video',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Video settings',
							body: [
								{
									type: 'listbox',
									name: 'Type',
									label: 'Type',
									'values': [
										{text: 'Youtube', value: 'youtube'},
										{text: 'Vimeo', value: 'vimeo'},
									]
								},
								{	
									type: 'textbox',
									name: 'SRC',
									label: 'SRC',
									value: 'http://www.youtube.com/embed/mcixldqDIEQ',
								},
								{	
									type: 'textbox',
									name: 'Width',
									label: 'Width',
									value: '200px',
								},
								{	
									type: 'textbox',
									name: 'Height',
									label: 'Height',
									value: '200px',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[' + e.data.Type + ' src="' + e.data.SRC + '" width="' + e.data.Width + '" height="' + e.data.Height + '"]');
							}
						});
					}
				}, // End Video

				// Start Google map
				{
					text: 'Google map',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Google map settings',
							body: [
								{	
									type: 'textbox',
									name: 'Title',
									label: 'Title',
									value: 'Your title',
								},
								{	
									type: 'textbox',
									name: 'Address',
									label: 'Address',
									value: '51.507622,-0.1305',
								},
								{
									type: 'listbox',
									name: 'Type',
									label: 'Type',
									'values': [
										{text: 'Roadmap', value: 'roadmap'},
										{text: 'Satellite', value: 'satellite'},
										{text: 'hybrid', value: 'hybrid'},
									]
								},
								{	
									type: 'textbox',
									name: 'Zoom',
									label: 'Zoom',
									value: '14',
								},
								{	
									type: 'textbox',
									name: 'Width',
									label: 'Width',
									value: '200',
								},
								{	
									type: 'textbox',
									name: 'Height',
									label: 'Height',
									value: '200',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[gmaps title="' + e.data.Title + '" address="' + e.data.Address + '" type="' + e.data.Type + '" zoom="' + e.data.Zoom + '" width="' + e.data.Width + '" height="' + e.data.Height + '"]');
							}
						});
					}
				}, // End Google map

				// Start Share
				{
					text: 'Share',
					onclick: function() {
						editor.insertContent( '[share]');
					}
				}, // End Share

				// Start Portfolio
				{
					text: 'Portfolio',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Portfolio settings',
							body: [
								{	
									type: 'textbox',
									name: 'Title',
									label: 'Title',
									value: 'Your title',
								},
								{	
									type: 'textbox',
									name: 'Limit',
									label: 'Limit',
									value: '13',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[portfolio title="' + e.data.Title + '" limit="' + e.data.Limit + '"]');
							}
						});
					}
				}, // End Portfolio

				// Start Qrcode
				{
					text: 'Qrcode',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Qrcode settings',
							body: [
								{	
									type: 'textbox',
									name: 'Title',
									label: 'Title',
									value: 'Title for lightbox link',
								},
								{	
									type: 'textbox',
									name: 'Lightbox',
									label: 'Lightbox',
									value: '0',
								},
								{	
									type: 'textbox',
									name: 'Self',
									label: 'Self',
									value: '0',
								},
								{	
									type: 'textbox',
									name: 'Size',
									label: 'Size',
									value: '128',
								},
								{	
									type: 'textbox',
									name: 'ScanText',
									label: 'Text',
									value: 'Text for scan',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[qrcode size="' + e.data.Size + '" self_link="' + e.data.Self + '" lightbox="' + e.data.Lightbox + '" title="' + e.data.Title + '"]' + e.data.ScanText + '[/qrcode]');
							}
						});
					}
				}, // End Qrcode

			]
		});
	});
})();