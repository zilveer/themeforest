(function() {
    tinymce.PluginManager.add('gavickpro_tc_button', function( editor, url ) {
        editor.addButton( 'gavickpro_tc_button', {
            title: 'Brankic Shortcodes',
            type: 'menubutton',
            icon: 'icon gavickpro-own-icon',
            menu: [
				{
                    text: 'Portfolio',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Portfolio shortcode',
							file: url + '/bra_shortcodes_portfolio.php',
							width: 800,
                			height: 600,
							buttons: [{
								text: 'Close',
								onclick: 'close'
							}]
						});
                    }
                },
                {
                    text: 'Sliding graph container',
                    value: '[bra_graph_container]<p>delete this text and insert graph bars</p>[/bra_graph_container]',
                    onclick: function() {
                        editor.insertContent(this.value());
                    }
                },
				{
                    text: 'Sliding graph bar',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Sliding Graph Bar shortcode',
							body: [{
								type: 'textbox',
								name: 'title',
								label: 'Title'
							},
							{
								type: 'textbox',
								name: 'percent',
								label: 'Percent'
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_graph Title='" + e.data.title +"' Percent='" + e.data.percent +"']");
							}
						});
                    }
                },
				{
                    text: 'Centered title',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Centered title shortcode',
							body: [{
								type: 'textbox',
								name: 'title',
								label: 'Title'
							},
							{
								type: 'textbox',
								name: 'subtitle',
								label: 'Subtitle - Description below title (optional)'
							},
							{
								type: 'textbox',
								name: 'top_margin',
								label: 'Top margin'
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_center_title title='" + e.data.title +"' subtitle='" + e.data.subtitle +"' top_margin='" + e.data.top_margin + "']");
							}
						});
                    }
                },
				{
                    text: 'Social icons list',
                    value: '[bra_social_icons]twitter, http://twitter.com/brankic1979, facebook, https://www.facebook.com/brankic1979themes[/bra_social_icons]',
                    onclick: function() {
                        editor.insertContent(this.value());
                    }
                },
				{
                    text: 'Photostream',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Photostream shortcode',
							body: [{
								type: 'textbox',
								name: 'user',
								label: 'User'
							},
							{
								type: 'textbox',
								name: 'limit',
								label: 'Limit'
							},
							{
								type: 'listbox',
								name: 'social_network',
								label: 'Social Network',
								'values': [
									{text: 'Instagram', value: 'instagram'},
									{text: 'Dribbble', value: 'dribbble'},
									{text: 'Flickr', value: 'flickr'},
									{text: 'Pinterest', value: 'pinterest'}
								]
							},
							{
								type: 'listbox',
								name: 'layout',
								label: 'Layout',
								'values': [
									{text: 'Small (widget style)', value: 'small'},
									{text: '2 Columns', value: '2'},
									{text: '3 Columns', value: '3'},
									{text: '4 Columns', value: '4'}
								]
							},
							{
								type: 'listbox',
								name: 'shape',
								label: 'Shape',
								'values': [
									{text: 'none', value: 'none'},
									{text: 'Triangle', value: 'triangle'},
									{text: 'Hexagon', value: 'hexagon'},
									{text: 'Circle', value: 'circle'}
								]
							},
							{
								type: 'textbox',
								name: 'api_token',
								label: 'Flickr API key, or Instagram token'
							},],
							
							onsubmit: function( e ) {
								editor.insertContent( "[bra_photostream user='" + e.data.user +"' limit='" + e.data.limit +"'  social_network='" + e.data.social_network + "'  layout='" + e.data.layout + "'  shape='" + e.data.shape + "'api_token='" + e.data.api_token + "']");
							}
						});
                    }
                },
				{
                    text: 'Map',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Google Map shortcode',
							body: [{
								type: 'textbox',
								name: 'location',
								label: 'Location'
							},
							{
								type: 'textbox',
								name: 'zoom',
								label: 'Zoom'
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_google_map location='" + e.data.location +"' zoom='" + e.data.zoom +"']");
							}
						});
                    }
                },
				{
                    text: 'Divider',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Divider shortcode',
							body: [{
								type: 'textbox',
								name: 'height',
								label: 'Height'
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_divider height='" + e.data.height + "']");
							}
						});
                    }
                },
				{
                    text: 'Border Divider',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Border Divider shortcode',
							body: [{
								type: 'textbox',
								name: 'top',
								label: 'Top margin'
							},
							{
								type: 'textbox',
								name: 'bottom',
								label: 'Bottom margin'
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_border_divider top='" + e.data.top +"' bottom='" + e.data.bottom +"']");
							}
						});
                    }
                },
				{
                    text: 'Toggle element',
                    value: 'Text from menu item I',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Toggle / Accordion shortcode',
							body: [{
								type: 'textbox',
								name: 'caption',
								label: 'caption'
							},
							{
								type: 'textbox',
								name: 'content',
								label: 'content',
								multiline: true
							},
							{
								type: 'listbox',
								name: 'collapsable',
								label: 'Type',
								'values': [
									{text: 'Toggle', value: 'no'},
									{text: 'Accordion', value: 'yes'}
								]
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_toggle collapsable='" + e.data.collapsable + "' caption='" + e.data.caption + "']" + e.data.content + "[/bra_toggle]");
							}
						});
                    }
                },
				{
                    text: 'Buttons',
                    value: 'Text from menu item I',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Centered title shortcode',
							body: [{
								type: 'textbox',
								name: 'text',
								label: 'Text on button'
							},
							{
								type: 'textbox',
								name: 'url',
								label: 'URL'
							},
							{
								type: 'listbox',
								name: 'target',
								label: 'Target',
								'values': [
									{text: 'Same window/tab', value: '_self'},
									{text: 'New window/tab', value: '_blank'}
								]
							},
							{
								type: 'listbox',
								name: 'size',
								label: 'Size',
								'values': [
									{text: 'Small', value: 'small'},
									{text: 'Medium', value: 'medium'},
									{text: 'Large', value: 'large'}
								]
							},
							{
								type: 'listbox',
								name: 'style',
								label: 'Style',
								'values': [
									{text: 'Rounded', value: 'rounded'},
									{text: 'Rectangle', value: ''}
								]
							},
							{
								type: 'listbox',
								name: 'color',
								label: 'Color',
								'values': [
									{text: 'Grey', value: 'grey'},
									{text: 'Yellow', value: 'yellow'},
									{text: 'Orange', value: 'orange'},
									{text: 'Green', value: 'green'},
									{text: 'Teal Green', value: 'tealgreen'},
									{text: 'Blue', value: 'blue'},
									{text: 'Navy Blue', value: 'navyblue'},
									{text: 'Purple', value: 'purple'},
									{text: 'Magenta', value: 'magenta'},
									{text: 'Pink', value: 'pink'},
									{text: 'Red', value: 'red'},
									{text: 'Cream', value: 'cream'}
								]
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_button text='" + e.data.text +"' url='" + e.data.url +"'  target='" + e.data.target + "' size='" + e.data.size + "' style='" + e.data.style + "' color='" + e.data.color + "']");
							}
						});
                    }
                },
				{
                    text: 'Icon boxes',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Icon boxes shortcode',
							file: url + '/bra_shortcodes_icon_boxes.php',
							width: 800,
                			height: 600,
							buttons: [{
								text: 'Close',
								onclick: 'close'
							}]
						});
                    }
                },
/*				{
                    text: 'Icon boxes',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Icon boxes  shortcode',
							body: [{
								type: 'textbox',
								name: 'caption_1',
								label: 'Caption 1'
							},
							{
								type: 'textbox',
								name: 'url_1',
								label: 'URL 1'
							},
							{
								type: 'textbox',
								name: 'icon_1',
								label: 'Icon 1'
							},
							{
								type: 'listbox',
								name: 'target_1',
								label: 'Target 1',
								'values': [
									{text: 'Same window/tab', value: '_self'},
									{text: 'New window/tab', value: '_blank'}
								]
							},
							{
								type: 'textbox',
								name: 'about_1',
								label: 'About 1',
								multiline: true
							},
							{
								type: 'textbox',
								name: 'caption_2',
								label: 'Caption 2'
							},
							{
								type: 'textbox',
								name: 'url_2',
								label: 'URL 2'
							},
							{
								type: 'textbox',
								name: 'icon_2',
								label: 'Icon 2'
							},
							{
								type: 'listbox',
								name: 'target_2',
								label: 'Target 2',
								'values': [
									{text: 'Same window/tab', value: '_self'},
									{text: 'New window/tab', value: '_blank'}
								]
							},
							{
								type: 'textbox',
								name: 'about_2',
								label: 'About 2',
								multiline: true
							},
							{
								type: 'textbox',
								name: 'caption_3',
								label: 'Caption 3'
							},
							{
								type: 'textbox',
								name: 'url_3',
								label: 'URL 3'
							},
							{
								type: 'textbox',
								name: 'icon_3',
								label: 'Icon 3'
							},
							{
								type: 'listbox',
								name: 'target_3',
								label: 'Target 3',
								'values': [
									{text: 'Same window/tab', value: '_self'},
									{text: 'New window/tab', value: '_blank'}
								]
							},
							{
								type: 'textbox',
								name: 'about_3',
								label: 'About 3',
								multiline: true
							},
							{
								type: 'textbox',
								name: 'caption_4',
								label: 'Caption 4'
							},
							{
								type: 'textbox',
								name: 'url_4',
								label: 'URL 4'
							},
							{
								type: 'textbox',
								name: 'icon_4',
								label: 'Icon 4'
							},
							{
								type: 'listbox',
								name: 'target_4',
								label: 'Target 4',
								'values': [
									{text: 'Same window/tab', value: '_self'},
									{text: 'New window/tab', value: '_blank'}
								]
							},
							{
								type: 'textbox',
								name: 'about_4',
								label: 'About 4',
								multiline: true
							}],
							onsubmit: function( e ) {
								var shortcode = "[bra_icon_boxes_container] [bra_icon_box caption='" + e.data.caption_1 +"' url='" + e.data.url_1 +"'  icon='" + e.data.icon_1 + "' target='" + e.data.target_1 + "']" + e.data.about_1 + "[/bra_icon_box]";
								shortcode += "[bra_icon_box caption='" + e.data.caption_2 +"' url='" + e.data.url_2 +"'  icon='" + e.data.icon_2 + "' target='" + e.data.target_2 + "']" + e.data.about_2 + "[/bra_icon_box]";
								shortcode += "[bra_icon_box caption='" + e.data.caption_3 +"' url='" + e.data.url_3 +"'  icon='" + e.data.icon_3 + "' target='" + e.data.target_3 + "']" + e.data.about_3 + "[/bra_icon_box]";
								shortcode += "[bra_icon_box caption='" + e.data.caption_4 +"' url='" + e.data.url_4 +"'  icon='" + e.data.icon_4 + "' target='" + e.data.target_4 + "']" + e.data.about_4 + "[/bra_icon_box][/bra_icon_boxes_container]";
								editor.insertContent(shortcode);
							}
						});
                    }
                },*/
				{
                    text: 'Team member',
                    onclick: function() {
						
                            editor.windowManager.open( {
							title: 'Team member shortcode',
							body: [{
								type: 'textbox',
								name: 'member_name',
								label: 'Member name'
							},
							{
								type: 'textbox',
								name: 'member_position',
								label: 'Position'
							},
							{
								type: 'textbox',
								name: 'member_img_src',
								label: 'Image SRC'
							},
							{
								type: 'textbox',
								name: 'member_columns',
								label: 'How many members per row'
							},
							{
								type: 'textbox',
								name: 'member_social_list',
								label: 'Text, URL, Text, URL...',
								value: "Facebook, http://www.facebook.com, Twitter, http://twitter.com, Email, mailto:email@email.com",
								multiline: true
							},
							{
								type: 'textbox',
								name: 'about',
								label: 'About',
								multiline: true
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_team_member member_name='" + e.data.member_name +"' member_position='" + e.data.member_position +"'  member_img_src='" + e.data.member_img_src + "' member_social_list='" + e.data.member_social_list + "' member_columns='" + e.data.member_columns + "']" + e.data.about + "[/bra_team_member]");
							}
						});
                    
					
					}
					
					
                },
				{
                    text: 'Grid',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Grid shortcode',
							body: [{
								type: 'listbox',
								name: 'grid_columns',
								label: 'How many columns',
								'values': [
									{text: '3 Columns', value: '3'},
									{text: '4 Columns', value: '4'},
									{text: '5 Columns', value: '5'},
									{text: '6 Columns', value: '6'}
								]
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_grid grid_columns='" + e.data.grid_columns + "']insert linked images here[/bra_grid]");
							}
						});
                    }
                },
				{
                    text: 'List wrapper',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'List wrapper shortcode',
							body: [{
								type: 'listbox',
								name: 'style',
								label: 'Style',
								'values': [
									{text: 'Check list', value: 'check-list'},
									{text: 'Star list', value: 'star-list'},
									{text: 'Arrow list', value: 'arrow-list'},
									{text: 'Colored counter list', value: 'colored-counter-list'}
								]
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_list style='" + e.data.style + "']<p>INSERT LIST HERE</p>[/bra_list]");
							}
						});
                    }
                },
				{
                    text: 'Highlights',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Centered title shortcode',
							body: [{
								type: 'textbox',
								name: 'text',
								label: 'Text',
								multiline: true
							},
							{
								type: 'listbox',
								name: 'style',
								label: 'Highlight style',
								'values': [
									{text: 'Theme color', value: 'highlight1'},
									{text: 'Grey', value: 'highlight2'},
									{text: 'Dotted', value: 'highlight3'}
								]
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_highlight style='" + e.data.style + "']" + e.data.text + "[/bra_highlight]");
							}
						});
                    }
                },
				{
                    text: 'Dropcaps',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Dopcaps shortcode',
							body: [{
								type: 'textbox',
								name: 'letter',
								label: 'Letter'
							},
							{
								type: 'listbox',
								name: 'style',
								label: 'Dropcap style',
								'values': [
									{text: 'Big letter', value: 'dropcap1'},
									{text: 'Inverse in square', value: 'dropcap2'},
									{text: 'Inverse in circle', value: 'dropcap3'}
								]
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_dropcaps style='" + e.data.style + "']" + e.data.letter + "[/bra_dropcaps]");
							}
						});
                    }
                },
				{
                    text: 'Blockquotes',
                    onclick: function() {
                            editor.windowManager.open( {
							title: 'Centered title shortcode',
							body: [{
								type: 'textbox',
								name: 'text',
								label: 'Text',
								multiline: true
							},
							{
								type: 'listbox',
								name: 'align',
								label: 'Align',
								'values': [
									{text: 'Left', value: ''},
									{text: 'Right', value: 'right'}
								]
							}],
							onsubmit: function( e ) {
								editor.insertContent( "[bra_blockquote align='" + e.data.align + "']" + e.data.text + "[/bra_blockquote]");
							}
						});
                    }
                },
                {
                    text: 'Columns',
                    menu: [
                        {
                            text: '1/1',
                            value: '[one]<h3>Dummy</h3><p>Content</p>[/one]',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }       
                        },
                        {
                            text: '1/3 + 1/3 + 1/3',
                            value: '[one_third]<h3>Dummy</h3> <p>Content</p>[/one_third] <br><br>[one_third]<h3>Dummy</h3> <p>Content</p>[/one_third]<br><br>[one_third_last]<h3>Dummy</h3><p>Content</p>[/one_third_last]',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }       
                        },
						{
                            text: '2/3 + 1/3',
                            value: '[two_thirds]<h3>Dummy</h3> <p>Content</p>[/two_thirds]<br><br>[one_third_last]<h3>Dummy</h3> <p>Content</p>[/one_third_last]',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }       
                        },
                        {
                            text: '1/3 + 2/3',
                            value: '[one_third]<h3>Dummy</h3> <p>Content</p>[/one_third]<br><br>[two_thirds_last]<h3>Dummy</h3> <p>Content</p>[/two_thirds_last]',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }       
                        },
						{
                            text: '1/2 + 1/2',
                            value: '[one_half]<h3>Dummy</h3> <p>Content</p>[/one_half]<br><br>[one_half_last]<h3>Dummy</h3> <p>Content</p>[/one_half_last]',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }       
                        },
                        {
                            text: '1/4 + 1/4 + 1/4 + 1/4',
                            value: '[one_fourth]<h3>Dummy</h3> <p>Content</p>[/one_fourth]<br><br>[one_fourth]<h3>Dummy</h3> <p>Content</p>[/one_fourth]<br><br>[one_fourth]<h3>Dummy</h3> <p>Content</p>[/one_fourth]<br><br>[one_fourth_last]<h3>Dummy</h3> <p>Content</p>[/one_fourth_last]',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }       
                        }
                    ]
                }
           ]
        });
    });
})();

