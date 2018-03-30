(function() {

  tinymce.PluginManager.add('mk_shortcodes', function(editor, url) {

    editor.addButton('mk_shortcodes_button', {

      type: 'menubutton',
      title: 'Insert Shortcode',
      text: '',
      image: url + '/masterkey-admin-icon.png',
      style: 'background-image: url("' + url + '/masterkey-admin-icon.png' + '"); background-repeat: no-repeat; background-position: 5px 4px;"',
      icon: true,
      menu: [

        { 
          text: 'Structure',
          menu: [{
              text: 'Row',
              onclick: function() {
                editor.insertContent('[vc_row fullwidth="false"][vc_column width="1/1"]Place Content Here[/vc_column][/vc_row]');
              }
            }, {
              text: 'Page Section',
              onclick: function() {
                editor.insertContent('[mk_page_section bg_image="" border_color="#e2e2e2" attachment="scroll" bg_position="left top" bg_repeat="repeat" bg_stretch="true" parallax="false" parallax_direction="vertical" speed_factor="0.3" bg_video="yes" mp4="MP4 Format" webm="WebM Format" ogv="OGV Format" poster_image="Background Video Preview image (and fallback image)" mask="true" color_mask="#dd9933" mask_opacity="0.6" padding="20" full_height="false" full_width="false" section_id="Section-ID"][vc_column width="1/1"][/vc_column][/mk_page_section]');
              }
            }, {
              text: 'Custom Box',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="1/1"][mk_custom_box bg_color="#f6f6f6" bg_position="left top" bg_repeat="repeat" bg_stretch="false" padding_vertical="30" padding_horizental="20" margin_bottom="10" min_height="100"][/mk_custom_box][/vc_column][/vc_row]');
              }
            }, {
              text: 'Column 1/2',
              onclick: function() {
                editor.insertContent('[vc_column width="1/2"]Place Content Here[/vc_column]');
              }
            }, {
              text: 'Column 1/3',
              onclick: function() {
                editor.insertContent('[vc_column width="1/3"]Place Content Here[/vc_column]');
              }
            }, {
              text: 'Column 1/4',
              onclick: function() {
                editor.insertContent('[vc_column width="1/4"]Place Content Here[/vc_column]');
              }
            }, {
              text: 'Column 1/6',
              onclick: function() {
                editor.insertContent('[vc_column width="1/6"]Place Content Here[/vc_column]');
              }
            }, {
              text: 'Column 2/3',
              onclick: function() {
                editor.insertContent('[vc_column width="2/3"]Place Content Here[/vc_column]');
              }
            }, {
              text: 'Column 3/4',
              onclick: function() {
                editor.insertContent('[vc_column width="3/4"]Place Content Here[/vc_column]');
              }
            }, {
              text: 'Column 5/6',
              onclick: function() {
                editor.insertContent('[vc_column width="5/6"]Place Content Here[/vc_column]');
              }
            }, {
              text: '1/2 + 1/2',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="1/2"][/vc_column][vc_column width="1/2"][/vc_column][/vc_row]');
              }
            }, {
              text: '1/3 + 1/3 + 1/3',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]');
              }
            }, {
              text: '1/4 + 1/4 + 1/4 + 1/4',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]');
              }
            }, {
              text: '2/3 + 1/3',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="2/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]');
              }
            }, {
              text: '3/4 + 1/4',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="3/4"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]');
              }
            }, {
              text: '1/4 + 3/4',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="1/4"][/vc_column][vc_column width="3/4"][/vc_column][/vc_row]');
              }
            }, {
              text: '1/4 + 1/2 + 1/4',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="1/4"][/vc_column][vc_column width="1/2"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]');
              }
            }, {
              text: '1/6 + 3/4 + 1/6',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]');
              }
            }, {
              text: '1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6',
              onclick: function() {
                editor.insertContent('[vc_row][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]');
              }
            }, {
              text: 'Divider',
              onclick: function() {
                editor.insertContent('[mk_divider style="single" divider_color="#dddddd" divider_width="full_width" margin_top="20" margin_bottom="20"]');
              }
            }, {
              text: 'Padding Divider',
              onclick: function() {
                editor.insertContent('[mk_padding_divider size="40"]');
              }
            }, {
              text: 'Clearboth',
              onclick: function() {
                editor.insertContent('[mk_clearboth]');
              }
            }

          ]
        },


        {
          text: 'Images',
          menu: [{
              text: 'Image',
              onclick: function() {
                editor.insertContent('[mk_image src="IMAGE_URL" image_width="500" image_height="400" crop="true" hover="true" align="left" margin_bottom="10"]');
              }
            }, {
              text: 'Moving Image',
              onclick: function() {
                editor.insertContent('[mk_moving_image src="IMAGE_URL" style="spin" align="left"]');
              }
            }, {
              text: 'Image Gallery',
              onclick: function() {
                editor.insertContent('[mk_gallery images="12677,12676" style="grid" structure="column" column="3" scroller_dimension="400" thumb_style_width="700" thumb_style_height="380" enable_title="true" height="500" margin_bottom="20"]');
              }
            }

          ]
        },



        {
          text: 'Typography',
          menu: [{
              text: 'Fancy Title',
              onclick: function() {
                editor.insertContent('[mk_fancy_title style="avantgarde" tag_name="h3" size="14" line_height="24" color="#393836" font_weight="inherit" letter_spacing="0" font_family="none" margin_bottom="10" align="left"]Here is a text[/mk_fancy_title]');
              }
            }, {
              text: 'Fancy text',
              onclick: function() {
                editor.insertContent('[mk_fancy_text color="#ffffff" highlight_color="#4f4f4f" highlight_opacity="0.3" size="18" line_height="34" font_weight="inherit" margin_top="0" margin_bottom="18" font_family="none" align="left"]Here is a text[/mk_fancy_text]');
              }
            }, {
              text: 'Text Block',
              onclick: function() {
                editor.insertContent('[vc_column_text]Here is the content of text block, it can accept any content including shortcodes[/vc_column_text]');
              }
            }, {
              text: 'Dropcaps',
              onclick: function() {
                editor.insertContent('[mk_dropcaps char="H" style="square-default"]ere is content in dropcaps shortcode. continue your paragraph here...[/mk_dropcaps]');
              }
            }, {
              text: 'Tabs',
              onclick: function() {
                editor.insertContent('[vc_tabs orientation="horizontal" container_bg_color="#fafafa"][vc_tab title="Tab 1" tab_id="1394462023-1-28"][/vc_tab][vc_tab title="Tab 2" tab_id="1394462023-2-9"][/vc_tab][/vc_tabs]');
              }
            }, {
              text: 'Accordion',
              onclick: function() {
                editor.insertContent('[vc_accordions container_bg_color="#fafafa"][vc_accordion_tab title="Section 1"][/vc_accordion_tab][vc_accordion_tab title="Section 2"][/vc_accordion_tab][/vc_accordions]');
              }
            }, {
              text: 'Toggle',
              onclick: function() {
                editor.insertContent('[mk_toggle title="Toggle Title" icon="theme-icon-woman-bag" icon_color="#3d3d3d" pane_bg="#fafafa"]Toggle Content.[/mk_toggle]');
              }
            }, {
              text: 'Blockquote',
              onclick: function() {
                editor.insertContent('[mk_blockquote align="left"]Blockquote Message[/mk_blockquote]');
              }
            }, {
              text: 'Highlight Text',
              onclick: function() {
                editor.insertContent('[mk_highlight text="Highlight Text" style="default"]');
              }
            }, {
              text: 'Custom List',
              onclick: function() {
                editor.insertContent('[mk_custom_list style="e63b" margin_bottom="30"]<ul><li>List Item</li><li>list Item</li></ul>[/mk_custom_list]');
              }
            }, {
              text: 'Font Icon',
              onclick: function() {
                editor.insertContent('[mk_font_icons icon="theme-icon-trashcan" style="filled" bg_color="#fafafa" border_color="#d7d7d7" size="small" remove_frame="false" padding_horizental="4" padding_vertical="4" align="none"]');
              }
            }, {
              text: 'Button',
              onclick: function() {
                editor.insertContent('[mk_button style="three-dimension" size="large" bg_color="#444444" txt_color="#fff" outline_skin="#444444" outline_hover_skin="#fff" icon="theme-icon-video" url="Button URL" target="_self" align="left" id="Button ID" margin_bottom="15"]Button text[/mk_button]');
              }
            }, {
              text: 'Message Box',
              onclick: function() {
                editor.insertContent('[mk_message_box type="alert"]Message box text[/mk_message_box]');
              }
            }, {
              text: 'Call to Action',
              onclick: function() {
                editor.insertContent('[mk_call_to_action style="default" text_size="18" font_weight="inherit" text="Here is the content" button_text="Button Text" button_url="Button URL" outline_skin="#444" outline_hover_skin="#fff"]');
              }
            }

          ]
        },

        {
          text: 'Slideshows',
          menu: [{
              text: 'Image Slideshow',
              onclick: function() {
                editor.insertContent('[mk_image_slideshow images="12166,12166,12166" direction="horizontal" image_width="770" image_height="350" animation_speed="700" slideshow_speed="7000" direction_nav="true" pagination="true"]');
              }
            }, {
              text: 'Edge Slideshow',
              onclick: function() {
                editor.insertContent('[vc_row fullwidth="true"][vc_column width="1/1"][mk_edge_slider slides="13089,13086" order="ASC" orderby="date" full_height="true" height="700" animation_speed="700" slideshow_speed="7000" direction_nav="true"][/vc_column][/vc_row]');
              }
            }, {
              text: 'Testimonial Slideshow',
              onclick: function() {
                editor.insertContent('[mk_testimonials style="boxed" count="4" testimonials="8889,8890" font_family="none" order="DESC" orderby="date"]');
              }
            }

          ]
        },



        {
          text: 'Presentation Tools',
          menu: [{
            text: 'Chart',
            onclick: function() {
              editor.insertContent('[mk_chart percent="50" track_color="#fafafa" line_width="15" bar_size="170" content_type="percent"]');
            }
          }, {
            text: 'Skill Meter',
            onclick: function() {
              editor.insertContent('[mk_skill_meter title="Title" percent="50" color="#dd9933"]');
            }
          }, {
            text: 'Pricing Tables',
            onclick: function() {
              editor.insertContent('[mk_pricing_table skin="light" table_number="4" order="DESC" orderby="date"]');
            }
          }, {
            text: 'Table',
            onclick: function() {
              editor.insertContent('[mk_table]<table width="100%"><thead><tr><th>Column 1</th><th>Column 2</th><th>Column 3</th><th>Column 4</th></tr></thead><tbody><tr><td>Item #1</td><td>Description</td><td>Subtotal:</td><td>$3.00</td></tr><tr><td>Item #2</td><td>Description</td><td>Discount:</td><td>$4.00</td></tr><tr><td>Item #3</td><td>Description</td><td>Shipping:</td><td>$7.00</td></tr><tr><td>Item #4</td><td>Description</td><td>Tax:</td><td>$6.00</td></tr><tr><td><strong>All Items</strong></td><td><strong>Description</strong></td><td><strong>Your Total:</strong></td><td><strong>$20.00</strong></td></tr></tbody></table>[/mk_table]');
            }
          }, {
            text: 'Milestones',
            onclick: function() {
              editor.insertContent('[mk_milestone start="0" stop="100" speed="2000" number_size="46" type="icon" icon="theme-icon-sitemap" text_size="12" color="#919191"]');
            }
          }, {
            text: 'Process Steps',
            onclick: function() {
              editor.insertContent('[mk_process_steps orientation="vertical"][mk_step title="Step 1" tab_id="1394462023-1-7"][/mk_step][mk_step title="Step 2" tab_id="1394462023-2-20"][/mk_step][/mk_process_steps]');
            }
          }]
        },



        {
          text: 'Loops',
          menu: [{
              text: 'Blog',
              onclick: function() {
                editor.insertContent('[mk_blog style="classic" column="3" image_height="350" count="10" offset="0" pagination="true" disable_meta="true" classic_excerpt="excerpt" pagination_style="1" order="DESC" orderby="date"]');
              }
            }, {
              text: 'Portfolio',
              onclick: function() {
                editor.insertContent('[mk_portfolio style="grid" ajax="true" item_row="1" column="3" width="400" height="400" count="10" sortable="true" offset="0" pagination="true" pagination_style="1" order="DESC" orderby="date" target="_self"]');
              }
            }, {
              text: 'Employees',
              onclick: function() {
                editor.insertContent('[mk_employees style="column" column="3" dimension="250" scroll="true" count="10" offset="0" description="true" order="DESC" orderby="date"]');
              }
            }, {
              text: 'Clients',
              onclick: function() {
                editor.insertContent('[mk_clients count="10" scroll="true" order="DESC" orderby="date" dimension="180" cover="false" target="_self"]');
              }
            }]
        },
         
         
         {
          text: 'WooCommerce',
          menu: [{
              text: 'Recent Products',
              onclick: function() {
                editor.insertContent('[recent_products per_page="12" columns="4"]');
              }
            }, {
              text: 'Featured Products',
              onclick: function() {
                editor.insertContent('[featured_products per_page="12" columns="4"]');
              }
            }, {
              text: 'Sale Products',
              onclick: function() {
                editor.insertContent('[sale_products per_page="12"]');
              }
            },{
              text: 'Related Products',
              onclick: function() {
                editor.insertContent('[related_products per_page="12"]');
              }
            }]
        },
        
        
       
        {
          text: 'Socials',
          menu: [{
              text: 'Twitter Feeds',
              onclick: function() {
                editor.insertContent('[vc_twitter twitter_name="your twitter username" tweets_count="5"]');
              }
            }, {
              text: 'Flickr Feeds',
              onclick: function() {
                editor.insertContent('[vc_flickr flickr_id="Flickr ID" count="6" column="three"]');
              }
            }, {
              text: 'Social Networks',
              onclick: function() {
                editor.insertContent('[mk_social_networks skin="dark" margin="4" align="left" facebook="#" twitter="#" rss="#" instagram="#" dribbble="#" pinterest="#" google_plus="#" linkedin="#" youtube="#" tumblr="#"]');
              }
            }, {
              text: 'Contact Form',
              onclick: function() {
                editor.insertContent('[mk_contact_form email="your email address" skin="dark"]');
              }
            }, {
              text: 'Contact info',
              onclick: function() {
                editor.insertContent('[mk_contact_info name="Name" cellphone="Cellphone" phone="Phone" address="Address" website="Website" email="Email"]');
              }
            }, {
              text: 'Video Player',
              onclick: function() {
                editor.insertContent('[vc_video title="Widget Title" link="Video link"]');
              }
            }, {
              text: 'Audio Player',
              onclick: function() {
                editor.insertContent('[mk_audio file_title="Audio Title" mp3_file="Uplaod MP3 file format" ogg_file="Uplaod OGG file format" small_version="false"]');
              }
            }, {
              text: 'Google Maps',
              onclick: function() {
                editor.insertContent('[mk_gmaps height="300" latitude="Latitude" longitude="Longitude" zoom="14" pan_control="true" draggable="true" scroll_wheel="true" zoom_control="true" map_type_control="true" scale_control="true" marker="true" pin_icon="Upload Marker Icon" modify_coloring="false" hue="#ccc" saturation="1" lightness="1"]');
              }
            }

          ]
        }


      ]

    });

  });

})();