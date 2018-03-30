(function() {
	tinymce.PluginManager.add('tie_mce_button', function( editor, url ) {
		editor.addButton( 'tie_mce_button', {
            icon: ' tie-shortcodes-icon ',
			tooltip: tieLang.shortcode_tielabs,
			type: 'menubutton',
			minWidth: 210,
			menu: [
				{
					text: tieLang.shortcode_box,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_box,
							body: [
								{
									type: 'listbox',
									name: 'typeOftheBox',
									label: tieLang.shortcode_style,
									'values': [
										{text: tieLang.shortcode_shadow, value: 'shadow'},
										{text: tieLang.shortcode_info, value: 'info'},
										{text: tieLang.shortcode_success, value: 'success'},
										{text: tieLang.shortcode_warning, value: 'warning'},
										{text: tieLang.shortcode_error, value: 'error'},
										{text: tieLang.shortcode_download, value: 'download'},
										{text: tieLang.shortcode_note, value: 'note'}
									]
								},
								{
									type: 'listbox',
									name: 'boxAlignment',
									label: tieLang.shortcode_alignment,
									'values': [
										{text: '', value: ''},
										{text: tieLang.shortcode_right, value: 'alignright'},
										{text: tieLang.shortcode_left, value: 'alignleft'},
										{text: tieLang.shortcode_center, value: 'aligncenter'}
									]
								},
								{
									type: 'textbox',
									name: 'CustomClass',
									label: tieLang.shortcode_class,
									value: ''
								},
								{
									type: 'textbox',
									name: 'BoxWidth',
									label: tieLang.shortcode_width,
									value: ''
								},
								{
									type: 'textbox',
									name: 'BoxContent',
									label: tieLang.shortcode_content,
									value: '',
									multiline: true,
									minWidth: 300,
									minHeight: 100
								}

							],
							onsubmit: function( e ) {
								editor.insertContent( '[box type="' + e.data.typeOftheBox + '" align="' + e.data.boxAlignment + '" class="' + e.data.CustomClass + '" width="' + e.data.BoxWidth + '"]'+ e.data.BoxContent +'[/box]');
							}
						});
					}
				
					
				},
				{
					text: tieLang.shortcode_button,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_button,
							body: [
								{
									type: 'listbox',
									name: 'ButtonColor',
									label: tieLang.shortcode_color,
									'values': [
										{text: tieLang.shortcode_red, value: 'red'},
										{text: tieLang.shortcode_orange, value: 'orange'},
										{text: tieLang.shortcode_blue, value: 'blue'},
										{text: tieLang.shortcode_green, value: 'green'},
										{text: tieLang.shortcode_black, value: 'black'},
										{text: tieLang.shortcode_gray, value: 'gray'},
										{text: tieLang.shortcode_white, value: 'white'},
										{text: tieLang.shortcode_pink, value: 'pink'},
										{text: tieLang.shortcode_purple, value: 'purple '}
									]
								},
								{
									type: 'listbox',
									name: 'ButtonSize',
									label: tieLang.shortcode_size,
									'values': [
										{text: tieLang.shortcode_small, value: 'small'},
										{text: tieLang.shortcode_medium, value: 'medium'},
										{text: tieLang.shortcode_big, value: 'big'}
									]
								},
								{
									type: 'textbox',
									name: 'ButtonLink',
									label: tieLang.shortcode_link,
									minWidth: 300,
									value: 'http://'
								},
								{
									type: 'textbox',
									name: 'ButtonText',
									label: tieLang.shortcode_text,
									value: ''
								},
								{
									type: 'textbox',
									name: 'ButtonIcon',
									label: tieLang.shortcode_icon,
									value: ''
								},
								{
									type: 'checkbox',
									name: 'ButtonTarget',
									label: tieLang.shortcode_new_window,
									value: 'blank',
								}

							],
							onsubmit: function( e ) {
								editor.insertContent( '[button color="' + e.data.ButtonColor + '" size="' + e.data.ButtonSize + '" link="' + e.data.ButtonLink + '" icon="' + e.data.ButtonIcon + '" target="' + e.data.ButtonTarget + '"]'+ e.data.ButtonText +'[/button]');
							}
						});
					}
				},
				{
					text: tieLang.shortcode_tabs,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_tabs,
							width: 300,
							height: 60,
							body: [
								{
									type: 'listbox',
									name: 'TabType',
									label: tieLang.shortcode_style,
									'values': [
										{text: tieLang.shortcode_horizontal, value: 'horizontal'},
										{text: tieLang.shortcode_vertical, value: 'vertical'}
									]
								},						
							],							

							onsubmit: function( e ) {
								editor.insertContent( '\
								[tabs type="'+ e.data.TabType +'"]<br />\
									[tabs_head]<br />\
										[tab_title] '+ tieLang.shortcode_tab_title1 +' [/tab_title]<br />\
										[tab_title] '+ tieLang.shortcode_tab_title2 +' [/tab_title]<br />\
										[tab_title] '+ tieLang.shortcode_tab_title3 +' [/tab_title]<br />\
									[/tabs_head]<br />\
									[tab] '+ tieLang.shortcode_tab_content1 +' [/tab]<br />\
									[tab] '+ tieLang.shortcode_tab_content2 +' [/tab]<br />\
									[tab] '+ tieLang.shortcode_tab_content3 +' [/tab]<br />\
								[/tabs]');
							}
						},
						{
        					plugin_url : url
						});
					}
				},	
				{
					text: tieLang.shortcode_toggle,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_toggle,
							body: [
								{
									type: 'textbox',
									name: 'ToggleTitle',
									label: tieLang.shortcode_title,
									value: ''
								},
								{
									type: 'listbox',
									name: 'ToggleState',
									label: tieLang.shortcode_state,
									'values': [
										{text: tieLang.shortcode_opened, value: 'open'},
										{text: tieLang.shortcode_closed, value: 'close'},
									]
								},
								{
									type: 'textbox',
									name: 'ToggleContent',
									label: tieLang.shortcode_content,
									value: '',
									multiline: true,
									minWidth: 300,
									minHeight: 100
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[toggle title="' + e.data.ToggleTitle + '" state="' + e.data.ToggleState + '"]'+ e.data.ToggleContent +'[/toggle]');
							}
						});
					}
				},
				{
					text: tieLang.shortcode_slideshow,
						onclick: function() {
							editor.insertContent( '\
								[tie_slideshow]<br /><br />\
									[tie_slide] '+ tieLang.shortcode_slide1 +' [/tie_slide]<br /><br />\
									[tie_slide] '+ tieLang.shortcode_slide2 +' [/tie_slide]<br /><br />\
									[tie_slide] '+ tieLang.shortcode_slide3 +' [/tie_slide]<br /><br />\
								[/tie_slideshow]');
						}
				},
				{
					text: tieLang.shortcode_bio,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_bio,
							body: [
								{
									type: 'textbox',
									name: 'AuthorTitle',
									label: tieLang.shortcode_title,
									value: ''
								},
								{
									type: 'textbox',
									name: 'AuthorImageURL',
									label: tieLang.shortcode_avatar,
									value: 'http://'
								},
								{
									type: 'textbox',
									name: 'AuthorContent',
									label: tieLang.shortcode_content,
									value: '',
									multiline: true,
									minWidth: 300,
									minHeight: 100
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[author title="' + e.data.AuthorTitle + '" image="' + e.data.AuthorImageURL + '"]'+ e.data.AuthorContent +'[/author]');
							}
						});
					}
				},
				{
					text: tieLang.shortcode_flickr,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_add_flickr,
							body: [
								{
									type: 'textbox',
									name: 'AccountID',
									label: tieLang.shortcode_flickr_id,
									value: ''
								},
								{
									type: 'textbox',
									name: 'NumberPhotos',
									label: tieLang.shortcode_flickr_num,
									value: '5'
								},
								{
									type: 'listbox',
									name: 'FlickrSorting',
									label: tieLang.shortcode_sorting,
									'values': [
										{text: tieLang.shortcode_recent, value: 'latest'},
										{text: tieLang.shortcode_random, value: 'random'},
									]
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[flickr id="' + e.data.AccountID + '" number="' + e.data.NumberPhotos + '" orderby="' + e.data.FlickrSorting + '"]');
							}
						});
					}
				},
				{
					text: tieLang.shortcode_feed,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_feed,
							body: [
								{
									type: 'textbox',
									name: 'RSSurl',
									label: tieLang.shortcode_feed_url,
									minWidth: 300,
									value: 'http://'
								},
								{
									type: 'textbox',
									name: 'NumberFeeds',
									label: tieLang.shortcode_feeds_num,
									value: '5'
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[feed url="' + e.data.RSSurl + '" number="' + e.data.NumberFeeds + '"]');
							}
						});
					}
				},
				{
					text: tieLang.shortcode_map,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_map,
							body: [
								{
									type: 'textbox',
									name: 'MapURL',
									label: tieLang.shortcode_map_url,
									minWidth: 300,
									value: 'http://'
								},
								{
									type: 'listbox',
									name: 'MapAlignment',
									label: tieLang.shortcode_alignment,
									'values': [
										{text: '', value: ''},
										{text: tieLang.shortcode_right, value: 'alignright'},
										{text: tieLang.shortcode_left, value: 'alignleft'},
										{text: tieLang.shortcode_center, value: 'aligncenter'},
									]
								},
								{
									type: 'textbox',
									name: 'MapWidth',
									label: tieLang.shortcode_width,
									value: ''
								},
								{
									type: 'textbox',
									name: 'Mapheight',
									label: tieLang.shortcode_height,
									value: ''
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[googlemap src="' + e.data.MapURL + '" width="' + e.data.MapWidth + '" height="' + e.data.Mapheight + '" align="' + e.data.MapAlignment + '"]');
							}
						});
					}
				},
				{
					text: tieLang.shortcode_video,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_video,
							body: [
								{
									type: 'textbox',
									name: 'VideoURL',
									label: tieLang.shortcode_video_url,
									value: 'http://',
									minWidth: 300,
								},
								{
									type: 'textbox',
									name: 'VideoWidth',
									label: tieLang.shortcode_width,
									value: ''
								},
								{
									type: 'textbox',
									name: 'Videoheight',
									label: tieLang.shortcode_height,
									value: ''
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[embed width="' + e.data.VideoWidth + '" height="' + e.data.Videoheight + '"]' + e.data.VideoURL + '[/embed]');
							}
						});
					}
				},
				{
					text: tieLang.shortcode_audio,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_audio,
							body: [
								{
									type: 'textbox',
									name: 'mp3URL',
									label: tieLang.shortcode_mp3,
									value: 'http://',
									minWidth: 300,
								},
								{
									type: 'textbox',
									name: 'm4aURL',
									label: tieLang.shortcode_m4a,
									value: 'http://',
									minWidth: 300,
								},
								{
									type: 'textbox',
									name: 'oggURL',
									label: tieLang.shortcode_ogg,
									value: 'http://',
									minWidth: 300,
								},
								
							],
							onsubmit: function( e ) {
								editor.insertContent( '[audio mp3="' + e.data.mp3URL + '" m4a="' + e.data.m4aURL + '" ogg="' + e.data.oggURL + '"]');
							}
						});
					}
				},
				{
					text:  tieLang.shortcode_lightbox,
					onclick: function() {
						editor.windowManager.open( {
							title:  tieLang.shortcode_lightbox,
							body: [
								{
									type: 'textbox',
									name: 'lightBoxURL',
									label: tieLang.shortcode_lightbox_url,
									value: 'http://',
									minWidth: 300,
								},
								{
									type: 'textbox',
									name: 'lightBoxTitle',
									label: tieLang.shortcode_title,
									value: '',
									minWidth: 300,
								},
								{
									type: 'textbox',
									name: 'lightBoxContent',
									label: tieLang.shortcode_content,
									value: '',
									multiline: true,
									minWidth: 300,
									minHeight: 100
								}
								
							],
							onsubmit: function( e ) {
								editor.insertContent( '[lightbox full="' + e.data.lightBoxURL + '" title="' + e.data.lightBoxTitle + '"]'+ e.data.lightBoxContent +'[/lightbox]');
							}
						});
					}
				},
				{
					text: tieLang.shortcode_tooltip,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_tooltip,
							body: [
								{
									type: 'textbox',
									name: 'ToolTipText',
									label: tieLang.shortcode_text,
									value: '',
									minWidth: 300,
								},
								{
									type: 'listbox',
									name: 'ToolTipGravities',
									label: tieLang.shortcode_direction,
									'values': [
										{value: 'nw', text: tieLang.shortcode_northwest},
										{value: 'n', text: tieLang.shortcode_north},
										{value: 'ne', text: tieLang.shortcode_northeast},
										{value: 'w', text: tieLang.shortcode_west},
										{value: 'e', text: tieLang.shortcode_east},
										{value: 'sw', text: tieLang.shortcode_southwest},
										{value: 's', text: tieLang.shortcode_south},
										{value: 'sw', text: tieLang.shortcode_southeast},
									]
								},
								{
									type: 'textbox',
									name: 'ToolTipContent',
									label: tieLang.shortcode_content,
									value: '',
									multiline: true,
									minWidth: 300,
									minHeight: 100
								}
								
							],
							onsubmit: function( e ) {
								editor.insertContent( '[tooltip text="' + e.data.ToolTipText + '" gravity="' + e.data.ToolTipGravities + '"]'+ e.data.ToolTipContent +'[/tooltip]');
							}
						});
					}
				},
				{
					text:  tieLang.shortcode_share,
					onclick: function() {
						editor.windowManager.open( {
							title:  tieLang.shortcode_share,
							body: [
								{
									type: 'checkbox',
									name: 'Facebook',
									label: tieLang.shortcode_facebook,
								},
								{
									type: 'checkbox',
									name: 'Tweet',
									label: tieLang.shortcode_tweet,
								},
								{
									type: 'checkbox',
									name: 'Digg',
									label: tieLang.shortcode_digg,
								},
								{
									type: 'checkbox',
									name: 'Stumble',
									label: tieLang.shortcode_stumble,
								},
								{
									type: 'checkbox',
									name: 'Google',
									label: tieLang.shortcode_google,
								},
								{
									type: 'checkbox',
									name: 'Pinterest',
									label: tieLang.shortcode_pinterest,
								},
								{
									type: 'label',
									name: 'TwitterFollowButton',
									onPostRender : function() {this.getEl().innerHTML = "<br /><strong>"+tieLang.shortcode_follow+"</strong>"}
								},
								{
									type: 'checkbox',
									name: 'Twitter',
									label: tieLang.shortcode_follow,
								},
								{
									type: 'textbox',
									name: 'TwitterUsername',
									label: tieLang.shortcode_username,
									value: '',
									minWidth: 200,
								},
								
							],
							onsubmit: function( e ) {

								if( e.data.Facebook ) {
									editor.insertContent( '[facebook]');
								}
								if( e.data.Tweet ) {
									editor.insertContent( '[tweet]');
								}
								if( e.data.Digg ) {
									editor.insertContent( '[digg]');
								}
								if( e.data.Stumble ) {
									editor.insertContent( '[stumble]');
								}
								if( e.data.Google ) {
									editor.insertContent( '[Google]');
								}
								if( e.data.Pinterest ) {
									editor.insertContent( '[pinterest]');
								}
								if( e.data.Twitter ) {
									editor.insertContent( '[follow id="'+e.data.TwitterUsername+'" count="true" ]');
								}
											
							}
						});
					}
				},
				{
					text: tieLang.shortcode_dropcap,
						onclick: function() {
							editor.insertContent( '[dropcap]' + editor.selection.getContent() + '[/dropcap]' );
						}
				},
				{
					text: tieLang.shortcode_full_img,
						onclick: function() {
							editor.insertContent( '[tie_full_img]' + editor.selection.getContent() + '[/tie_full_img]' );
						}
				},
				{
					text: tieLang.shortcode_highlight,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_highlight,
							body: [
								{
									type: 'listbox',
									name: 'color',
									label: tieLang.shortcode_color,
									'values': [
										{text: tieLang.shortcode_yellow, value: 'yellow'},
										{text: tieLang.shortcode_red, value: 'red'},
										{text: tieLang.shortcode_blue, value: 'blue'},
										{text: tieLang.shortcode_orange, value: 'orange'},
										{text: tieLang.shortcode_green, value: 'green'},
										{text: tieLang.shortcode_gray, value: 'gray'},
										{text: tieLang.shortcode_black, value: 'black'},
										{text: tieLang.shortcode_pink, value: 'pink'},
									]
								},
								{
									type: 'textbox',
									name: 'highlightedText',
									label: tieLang.shortcode_text,
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[highlight color="'+ e.data.color+ '"]' + e.data.highlightedText + '[/highlight]' );
							}
						});
					}
				},
				{
					text: tieLang.shortcode_padding,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_padding,
							body: [
								{
									type: 'textbox',
									name: 'left',
									label: tieLang.shortcode_padding_left,
									value: '10%',
								},
								{
									type: 'textbox',
									name: 'right',
									label: tieLang.shortcode_padding_right,
									value: '10%',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[padding right="'+ e.data.right+ '" left="'+ e.data.left+ '"]' + editor.selection.getContent() + '[/padding]' );
							}
						});
					}
				},

				{
					text: tieLang.shortcode_divider,
					onclick: function() {
						editor.windowManager.open( {
							title: tieLang.shortcode_divider,
							body: [
								{
									type: 'listbox',
									name: 'style',
									label: tieLang.shortcode_style,
									'values': [
										{text: tieLang.shortcode_solid, value: 'solid'},
										{text: tieLang.shortcode_dashed, value: 'dashed'},
										{text: tieLang.shortcode_normal, value: 'normal'},
										{text: tieLang.shortcode_double, value: 'double'},
										{text: tieLang.shortcode_dotted, value: 'dotted'}
									]
								},
								{
									type: 'textbox',
									name: 'MarginTop',
									label: tieLang.shortcode_margin_top,
									value: '20',
								},
								{
									type: 'textbox',
									name: 'MarginBottom',
									label: tieLang.shortcode_margin_bottom,
									value: '20',
								},
							],
							onsubmit: function( e ) {
								editor.insertContent( '[divider style="'+ e.data.style+ '" top="'+ e.data.MarginTop+ '" bottom="'+ e.data.MarginBottom+ '"]' );
							}
						});
					}
				},
				{
					text: tieLang.shortcode_lists,
					menu: [
						{
							text: tieLang.shortcode_star,
							onclick: function() {
								editor.insertContent( '[tie_list type="starlist"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
						{
							text: tieLang.shortcode_check,
							onclick: function() {
								editor.insertContent( '[tie_list type="checklist"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
						{
							text: tieLang.shortcode_thumb_up,
							onclick: function() {
								editor.insertContent( '[tie_list type="thumbup"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
						{
							text: tieLang.shortcode_thumb_down,
							onclick: function() {
								editor.insertContent( '[tie_list type="thumbdown"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
						{
							text: tieLang.shortcode_plus,
							onclick: function() {
								editor.insertContent( '[tie_list type="plus"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
						{
							text: tieLang.shortcode_minus,
							onclick: function() {
								editor.insertContent( '[tie_list type="minus"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
												{
							text: tieLang.shortcode_heart,
							onclick: function() {
								editor.insertContent( '[tie_list type="heart"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
						{
							text: tieLang.shortcode_light_bulb,
							onclick: function() {
								editor.insertContent( '[tie_list type="lightbulb"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
						{
							text: tieLang.shortcode_cons,
							onclick: function() {
								editor.insertContent( '[tie_list type="cons"]' + editor.selection.getContent() + '[/tie_list]' );
							}
						},
						
					]
				},
				{
					text: tieLang.shortcode_ads,
					menu: [
						{
							text: tieLang.shortcode_ads1,
							onclick: function() {
								editor.insertContent( '[ads1]' );
							}
						},
						{
							text: tieLang.shortcode_ads2,
							onclick: function() {
								editor.insertContent( '[ads2]' );
							}
						},
					]
				},
				{
					text: tieLang.shortcode_Restrict,
					menu: [
						{
							text: tieLang.shortcode_registered,
							onclick: function() {
								editor.insertContent( '[is_logged_in]' + editor.selection.getContent() + '[/is_logged_in]' );
							}
						},
						{
							text: tieLang.shortcode_guests,
							onclick: function() {
								editor.insertContent( '[is_guest]' + editor.selection.getContent() + '[/is_guest]' );
							}
						},
					]
				},
				{
					text: tieLang.shortcode_columns,
					menu: [
						{
							text: '[1/1]',
							onclick: function() {
								editor.insertContent( '[one_half]'+tieLang.shortcode_add_content+'[/one_half][one_half_last]'+tieLang.shortcode_add_content+'[/one_half_last]' );
							}
						},
						{
							text: '[1/1/1]',
							onclick: function() {
								editor.insertContent( '[one_third]'+tieLang.shortcode_add_content+'[/one_third][one_third]'+tieLang.shortcode_add_content+'[/one_third][one_third_last]'+tieLang.shortcode_add_content+'[/one_third_last]' );
							}
						},
						{
							text: '[1/1/1/1]',
							onclick: function() {
								editor.insertContent( '[one_fourth]'+tieLang.shortcode_add_content+'[/one_fourth][one_fourth]'+tieLang.shortcode_add_content+'[/one_fourth][one_fourth]'+tieLang.shortcode_add_content+'[/one_fourth][one_fourth_last]'+tieLang.shortcode_add_content+'[/one_fourth_last]' );
							}
						},
						{
							text: '[1/1/1/1/1]',
							onclick: function() {
								editor.insertContent( '[one_fifth]'+tieLang.shortcode_add_content+'[/one_fifth][one_fifth]'+tieLang.shortcode_add_content+'[/one_fifth][one_fifth]'+tieLang.shortcode_add_content+'[/one_fifth][one_fifth]'+tieLang.shortcode_add_content+'[/one_fifth][one_fifth_last]'+tieLang.shortcode_add_content+'[/one_fifth_last]' );
							}
						},
						{
							text: '[1/1/1/1/1/1]',
							onclick: function() {
								editor.insertContent( '[one_sixth]'+tieLang.shortcode_add_content+'[/one_sixth][one_sixth]'+tieLang.shortcode_add_content+'[/one_sixth][one_sixth]'+tieLang.shortcode_add_content+'[/one_sixth][one_sixth]'+tieLang.shortcode_add_content+'[/one_sixth][one_sixth]'+tieLang.shortcode_add_content+'[/one_sixth][one_sixth_last]'+tieLang.shortcode_add_content+'[/one_sixth_last]' );
							}
						},
						{
							text: '[1/3]',
							onclick: function() {
								editor.insertContent( '[one_fourth]'+tieLang.shortcode_add_content+'[/one_fourth][three_fourth_last]'+tieLang.shortcode_add_content+'[/three_fourth_last]' );
							}
						},
						{
							text: '[1/5]',
							onclick: function() {
								editor.insertContent( '[one_sixth]'+tieLang.shortcode_add_content+'[/one_sixth][five_sixth_last]'+tieLang.shortcode_add_content+'[/five_sixth_last]' );
							}
						},
						{
							text: '[2/1]',
							onclick: function() {
								editor.insertContent( '[two_third]'+tieLang.shortcode_add_content+'[/two_third][one_third_last]'+tieLang.shortcode_add_content+'[/one_third_last]' );
							}
						},

						{
							text: '[2/3]',
							onclick: function() {
								editor.insertContent( '[two_fifth]'+tieLang.shortcode_add_content+'[/two_fifth][three_fifth_last]'+tieLang.shortcode_add_content+'[/three_fifth_last]' );
							}
						},

					]
				},
			]
		});
	});
})();