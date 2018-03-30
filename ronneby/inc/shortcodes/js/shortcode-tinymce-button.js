(function ($) {
	tinymce.PluginManager.add('crumshortcodes', function (editor, url) {
		editor.addButton('crumshortcodes', {
			text: 'Insert shortcode',
			icon: false,
			type: 'menubutton',
			menu: [
                {
                    text   : 'New Dropcaps',
                    onclick: function () {
                        editor.windowManager.open({
                            title   : 'Insert Dropcap Shortcode',
                            body    : [
                                {
                                    type    : 'listbox',
                                    name    : 'dropcapClass',
                                    'values': [
                                        {text: 'Square + shadow', value: 'square shadow'},
                                        {text: 'Square + border', value: 'square border'},
                                        {text: 'Square + colored border', value: 'square border main'},
                                        {text: 'Square + border + shadow', value: 'square border shadow'},
                                        {text: 'Square + colored border + shadow', value: 'square border shadow main'},
                                        {text: 'Square filled + shadow', value: 'square filled shadow'},
                                        {text: 'Square filled', value: 'square filled'},
                                        {text: 'Double bottom border', value: 'square border double'},
                                        {text: 'Double bottom border + shadow', value: 'square border double shadow'},
                                        {text: 'Double bottom colored border', value: 'square border double  main'},
                                        {text: 'Double colored border + shadow', value: 'square border double shadow main'},
                                        {text: 'Rounded + shadow', value: 'rounded shadow'},
                                        {text: 'Rounded filled', value: 'rounded filled'},
                                        {text: 'Rounded filled + shadow', value: 'rounded filled shadow'},
                                        {text: 'Rounded filled + raised', value: 'rounded filled raised'},
                                        {text: 'Rounded gray + raised', value: ' rounded gray-bg raised'},
                                        {text: 'Rounded + text colored', value: ' rounded text-colored'},
                                        {text: 'Circle + shadow', value: 'circle shadow'},
                                        {text: 'Circle filled', value: 'circle filled'},
                                        {text: 'Circle filled + shadow', value: 'circle filled shadow'}

                                    ]
                                }
                            ],
                            onsubmit: function (e) {
                                var selected_text = tinyMCE.activeEditor.selection.getContent();
                                if(jQuery(tinyMCE.activeEditor.selection.getNode()).find('.dfd-dropcap').length) {
                                    selected_text = selected_text.replace(/<\/?span[^>]*>/g,"");
                                }
                                editor.insertContent('<span class="dfd-dropcap ' + e.data.dropcapClass + '">' + selected_text.charAt(0) + '</span>' + selected_text.slice(1));
                            }
                        });
                    }
                },
				{
					text   : 'Old Dropcaps',
					onclick: function () {
						editor.windowManager.open({
							title   : 'Insert Dropcap Shortcode',
							body    : [
								{
									type    : 'listbox',
									name    : 'dropcapStyle',
									'values': [
										{text: 'Default', value: 'dfd-textmodule-dropcaps'},
										{text: 'Bordered', value: 'dfd-textmodule-dropcaps bordered'},
										{text: 'Rounded', value: 'dfd-textmodule-dropcaps rounded'},
                                        {text: 'Rounded Bordered', value: 'dfd-textmodule-dropcaps rounded bordered'}
									]
								}
							],
							onsubmit: function (e) {
								var selected_text = tinyMCE.activeEditor.selection.getContent();
                                editor.insertContent('<span class="' + e.data.dropcapStyle + '">' + selected_text + '</span>');
							}
						});
					}
				},
				{
					text   : 'Testimonial',
					onclick: function () {
                        var selected_text = tinyMCE.activeEditor.selection.getContent();
                        editor.insertContent('<blockquote class="dfd-textmodule-blockquote">' + selected_text + '</blockquote>');
					}
				},
                {
                    text   : 'Tooltip',
                    onclick: function () {
                        editor.windowManager.open({
                            title   : 'Insert Tooltip Shortcode',
                            body    : [
                                {
                                    type : 'label',
                                    name : 'popoverTitle',
                                    label: 'Tooltip text'
                                },
                                {
                                    type : 'textbox',
                                    name : 'tooltipContent',
                                },
                                {
                                    type    : 'listbox',
                                    name    : 'tooltipAlign',
                                    'values': [
                                        {text: 'Left', value: 'left'},
                                        {text: 'Right', value: 'right'},
                                        {text: 'Bottom', value: 'bottom'},
                                        {text: 'Top', value: 'top'}
                                    ]
                                }
                            ],
                            onsubmit: function (e) {
                                var selected_text = tinyMCE.activeEditor.selection.getContent();
                                var shortcode_text = e.data.tooltipContent.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                                editor.insertContent('[tooltip text="' + shortcode_text + '" align="' + e.data.tooltipAlign + '" ]' + selected_text + '[/tooltip]');
                            }
                        });
                    }
                },
                {
                    text   : 'Popover',
                    onclick: function () {
                        editor.windowManager.open({
                            title   : 'Insert Popover Shortcode',
                            body    : [
                                {
                                    type : 'textbox',
                                    name : 'popoverImage',
                                    label: 'Custom image url',
                                    id: 'my-image-box'
                                },
                                {
                                    type: 'button',
                                    name: 'selectImage',
                                    text: 'Select Image',
                                    onclick: function () {
                                        window.mb = window.mb || {};

                                        window.mb.frame = wp.media({
                                            frame: 'post',
                                            state: 'insert',
                                            library: {
                                                type: 'image'
                                            },
                                            multiple: false
                                        });

                                        window.mb.frame.on('insert', function () {
                                            var json = window.mb.frame.state().get('selection').first().toJSON();

                                            if (0 > jQuery.trim(json.url.length)) {
                                                return;
                                            }

                                            jQuery('#my-image-box').val(json.url);
                                        });

                                        window.mb.frame.open();
                                    }
                                },
								 {
                                    type : 'textbox',
                                    name : 'maxwidthcontent',
                                    label: 'Content width(px)',
									id: 'id-maxwidthcontent'
                                },
                                {
                                    type : 'label',
                                    name : 'popoverTitle',
                                    label: 'Popover Content'
                                },
                                {
                                    type : 'textbox',
                                    name : 'popoverContent',
                                    multiline: 'true',
                                    minHeight: 150
                                },
                                {
                                    type    : 'listbox',
                                    name    : 'popoverAlign',
                                    'values': [
                                        {text: 'Left', value: 'left'},
                                        {text: 'Right', value: 'right'},
                                        {text: 'Bottom', value: 'bottom'},
                                        {text: 'Top', value: 'top'}
                                    ]
                                }
                            ],
                            onsubmit: function (e) {
                                var selected_text = tinyMCE.activeEditor.selection.getContent();
                                var shortcode_text = e.data.popoverContent.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&#34;').replace(/'/g, '&apos');

                                editor.insertContent('[popover image="' + e.data.popoverImage + '" content="' + shortcode_text + '" position="' + e.data.popoverAlign + '" contentwidth="' + e.data.maxwidthcontent + '"]' + selected_text + '[/popover]');
                            }
                        });
                    }
                }
			]
		});
	});
})();
