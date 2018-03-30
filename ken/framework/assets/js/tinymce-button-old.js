(function() {
  tinymce.create('tinymce.plugins.mkShortcodeMce', {

    init: function(ed, url) {
      tinymce.plugins.mkShortcodeMce.theurl = url;
    },

    createControl: function(btn, e) {
      if (btn == 'mk_shortcodes_button') {
        var a = this;
        var btn = e.createSplitButton('mk_button', {
          title: 'Insert Shortcode',
          image: tinymce.plugins.mkShortcodeMce.theurl + '/masterkey-admin-icon.png',
          icons: false,
        });

        btn.onRenderMenu.add(function(c, b) {



          c = b.addMenu({
            title: 'Structure'
          });

          a.render(c, 'Row', 'row');
          a.render(c, 'Page Section', 'page-section');
          a.render(c, 'Custom Box', 'custom-box');
          a.render(c, 'Column 1/2', '1/2');
          a.render(c, 'Column 1/3', '1/3');
          a.render(c, 'Column 1/4', '1/4');
          a.render(c, 'Column 1/6', '1/6');
          a.render(c, 'Column 2/3', '2/3');
          a.render(c, 'Column 3/4', '3/4');
          a.render(c, 'Column 5/6', '5/6');


          a.render(c, '1/2 + 1/2', '1/2-1/2');
          a.render(c, '1/3 + 1/3 + 1/3', '1/3-1/3-1/3');
          a.render(c, '1/4 + 1/4 + 1/4 + 1/4', '1/4-1/4-1/4-1/4');

          a.render(c, '2/3 + 1/3', '2/3-1/3');
          a.render(c, '3/4 + 1/4', '3/4-1/4');

          a.render(c, '1/4 + 3/4', '1/4-3/4');

          a.render(c, '1/4 + 1/2 + 1/4', '1/4-1/2-1/4');
          a.render(c, '1/6 + 3/4 + 1/6', '1/6-3/4-1/6');

          a.render(c, '1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6', '1/6-1/6-1/6-1/6-1/6-1/6');
          a.render(c, 'Divider', 'divider');
          a.render(c, 'Padding Divider', 'padding-divider');
          a.render(c, 'Clearboth', 'clearboth');



          c = b.addMenu({
            title: 'Images'
          });

          a.render(c, 'Image', 'image');
          a.render(c, 'Moving Image', 'moving-image');
          a.render(c, 'Image Gallery', 'image-gallery');



          c = b.addMenu({
            title: 'Typography'
          });

          a.render(c, 'Fancy Title', 'fancy-title');
          a.render(c, 'Fancy text', 'fancy-text');
          a.render(c, 'Text Block', 'text-block');
          a.render(c, 'Dropcaps', 'dropcaps');
          a.render(c, 'Tabs', 'tabs');
          a.render(c, 'Accordion', 'accordion');
          a.render(c, 'Toggle', 'toggle');
          a.render(c, 'Blockquote', 'blockquote');
          a.render(c, 'Highlight Text', 'highlight');
          a.render(c, 'Custom List', 'custom-list');
          a.render(c, 'Font Icon', 'font-icon');
          a.render(c, 'Icon Box', 'icon-box');
          a.render(c, 'Button', 'button');
          a.render(c, 'Message Box', 'message-box');
          a.render(c, 'Call to Action', 'call-to-action');



          c = b.addMenu({
            title: 'Slideshows'
          });

          a.render(c, 'Image Slideshow', 'image-slideshow');
          a.render(c, 'Edge Slideshow', 'edge-slideshow');
          a.render(c, 'Testimonial Slideshow', 'testimonial-slideshow');



          c = b.addMenu({
            title: 'Presentation Tools'
          });


          a.render(c, 'Chart', 'chart');
          a.render(c, 'Skill Meter', 'skill-meter');
          a.render(c, 'Pricing Tables', 'pricing-table');
          a.render(c, 'Table', 'table');
          a.render(c, 'Milestones', 'milestone');
          a.render(c, 'Process Steps', 'process-steps');



          c = b.addMenu({
            title: 'Loops'
          });

          a.render(c, 'Blog', 'blog');
          a.render(c, 'Portfolio', 'portfolio');
          a.render(c, 'Employees', 'employees');
          a.render(c, 'Clients', 'clients');



          c = b.addMenu({
            title: 'Socials'
          });


          a.render(c, 'Twitter Feeds', 'twitter-feeds');
          a.render(c, 'Flickr Feeds', 'flickr');
          a.render(c, 'Social Networks', 'social-networks');
          a.render(c, 'Contact Form', 'contact-form');
          a.render(c, 'Contact info', 'contact-info');
          a.render(c, 'Video Player', 'video-player');
          a.render(c, 'Audio Player', 'audio-player');
          a.render(c, 'Google Maps', 'google-maps');



        });
        return btn;
      }
      return null;
    },

    render: function(ed, title, id) {
      ed.add({
        title: title,
        onclick: function() {



          if (id === '1/2') {
            tinyMCE.activeEditor.selection.setContent('[vc_column width="1/2"]Place Content Here[/vc_column]');
          }

          if (id === '1/3') {
            tinyMCE.activeEditor.selection.setContent('[vc_column width="1/3"]Place Content Here[/vc_column]');
          }

          if (id === '1/4') {
            tinyMCE.activeEditor.selection.setContent('[vc_column width="1/4"]Place Content Here[/vc_column]');
          }

          if (id === '1/6') {
            tinyMCE.activeEditor.selection.setContent('[vc_column width="1/6"]Place Content Here[/vc_column]');
          }

          if (id === '2/3') {
            tinyMCE.activeEditor.selection.setContent('[vc_column width="2/3"]Place Content Here[/vc_column]');
          }

          if (id === '3/4') {
            tinyMCE.activeEditor.selection.setContent('[vc_column width="3/4"]Place Content Here[/vc_column]');
          }

          if (id === '5/6') {
            tinyMCE.activeEditor.selection.setContent('[vc_column width="5/6"]Place Content Here[/vc_column]');
          }

          if (id === 'row') {
            tinyMCE.activeEditor.selection.setContent('[vc_row fullwidth="false"][vc_column width="1/1"]Place Content Here[/vc_column][/vc_row]');
          }

          if (id === 'page-section') {
            tinyMCE.activeEditor.selection.setContent('[mk_page_section bg_image="" border_color="#e2e2e2" attachment="scroll" bg_position="left top" bg_repeat="repeat" bg_stretch="true" parallax="false" parallax_direction="vertical" speed_factor="0.3" bg_video="yes" mp4="MP4 Format" webm="WebM Format" ogv="OGV Format" poster_image="Background Video Preview image (and fallback image)" mask="true" color_mask="#dd9933" mask_opacity="0.6" padding="20" full_height="false" full_width="false" section_id="Section-ID"][vc_column width="1/1"][/vc_column][/mk_page_section]');
          }

          if (id === 'custom-box') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="1/1"][mk_custom_box bg_color="#f6f6f6" bg_position="left top" bg_repeat="repeat" bg_stretch="false" padding_vertical="30" padding_horizental="20" margin_bottom="10" min_height="100"][/mk_custom_box][/vc_column][/vc_row]');
          }


          if (id === '1/2-1/2') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="1/2"][/vc_column][vc_column width="1/2"][/vc_column][/vc_row]');
          }

          if (id === '1/3-1/3-1/3') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]');
          }

          if (id === '1/4-1/4-1/4-1/4') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]');
          }

          if (id === '2/3-1/3') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="2/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]');
          }

          if (id === '3/4-1/4') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="3/4"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]');
          }

          if (id === '1/4-3/4') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="1/4"][/vc_column][vc_column width="3/4"][/vc_column][/vc_row]');
          }

          if (id === '1/4-1/2-1/4') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="1/4"][/vc_column][vc_column width="1/2"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]');
          }

          if (id === '1/6-2/3-1/6') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]');
          }

          if (id === '1/6-1/6-1/6-1/6-1/6-1/6') {
            tinyMCE.activeEditor.selection.setContent('[vc_row][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]');
          }



          if (id === 'divider') {
            tinyMCE.activeEditor.selection.setContent('[mk_divider style="single" divider_color="#dddddd" divider_width="full_width" margin_top="20" margin_bottom="20"]');
          }


          if (id === 'padding-divider') {
            tinyMCE.activeEditor.selection.setContent('[mk_padding_divider size="40"]');
          }


          if (id === 'clearboth') {
            tinyMCE.activeEditor.selection.setContent('[mk_clearboth]');
          }



          if (id === 'image') {
            tinyMCE.activeEditor.selection.setContent('[mk_image src="IMAGE_URL" image_width="500" image_height="400" crop="true" hover="true" align="left" margin_bottom="10"]');
          }


          if (id === 'moving-image') {
            tinyMCE.activeEditor.selection.setContent('[mk_moving_image src="IMAGE_URL" style="spin" align="left"]');
          }


          if (id === 'image-gallery') {
            tinyMCE.activeEditor.selection.setContent('[mk_gallery images="12677,12676" style="grid" structure="column" column="3" scroller_dimension="400" thumb_style_width="700" thumb_style_height="380" enable_title="true" height="500" margin_bottom="20"]');
          }


          if (id === 'fancy-title') {
            tinyMCE.activeEditor.selection.setContent('[mk_fancy_title style="avantgarde" tag_name="h3" size="14" line_height="24" color="#393836" font_weight="inherit" letter_spacing="0" font_family="none" margin_bottom="10" align="left"]Here is a text[/mk_fancy_title]');
          }


          if (id === 'fancy-text') {
            tinyMCE.activeEditor.selection.setContent('[mk_fancy_text color="#ffffff" highlight_color="#4f4f4f" highlight_opacity="0.3" size="18" line_height="34" font_weight="inhert" margin_top="0" margin_bottom="18" font_family="none" align="left"]Here is a text[/mk_fancy_text]');
          }


          if (id === 'text-block') {
            tinyMCE.activeEditor.selection.setContent('[vc_column_text]Here is the content of text block, it can accept any content including shortcodes[/vc_column_text]');
          }


          if (id === 'dropcaps') {
            tinyMCE.activeEditor.selection.setContent('[mk_dropcaps char="H" style="square-default"]ere is content in dropcaps shortcode. continue your paragraph here...[/mk_dropcaps]');
          }


          if (id === 'tabs') {
            tinyMCE.activeEditor.selection.setContent('[vc_tabs orientation="horizontal" container_bg_color="#fafafa"][vc_tab title="Tab 1" tab_id="1394462023-1-28"][/vc_tab][vc_tab title="Tab 2" tab_id="1394462023-2-9"][/vc_tab][/vc_tabs]');
          }


          if (id === 'accordion') {
            tinyMCE.activeEditor.selection.setContent('[vc_accordions container_bg_color="#fafafa"][vc_accordion_tab title="Section 1"][/vc_accordion_tab][vc_accordion_tab title="Section 2"][/vc_accordion_tab][/vc_accordions]');
          }


          if (id === 'toggle') {
            tinyMCE.activeEditor.selection.setContent('[mk_toggle title="Toggle Title" icon="theme-icon-woman-bag" icon_color="#3d3d3d" pane_bg="#fafafa"]Toggle Content.[/mk_toggle]');
          }


          if (id === 'blockquote') {
            tinyMCE.activeEditor.selection.setContent('[mk_blockquote align="left"]Blockquote Message[/mk_blockquote]');
          }


          if (id === 'highlight') {
            tinyMCE.activeEditor.selection.setContent('[mk_highlight text="Highlight Text" style="default"]');
          }

          if (id === 'custom-list') {
            tinyMCE.activeEditor.selection.setContent('[mk_custom_list style="e63b" margin_bottom="30"]<ul><li>List Item</li><li>list Item</li></ul>[/mk_custom_list]');
          }

          if (id === 'font-icon') {
            tinyMCE.activeEditor.selection.setContent('[mk_font_icons icon="theme-icon-trashcan" style="filled" bg_color="#fafafa" border_color="#d7d7d7" size="small" remove_frame="false" padding_horizental="4" padding_vertical="4" align="none"]');
          }


          if (id === 'icon-box') {
            tinyMCE.activeEditor.selection.setContent('[mk_icon_box style="style5" icon_align="left" title="Here is the title" read_more_txt="Read More text" read_more_url="Read More URL" icon="theme-icon-love" icon_color="#dd3333"]Here is the content[/mk_icon_box]');
          }


          if (id === 'button') {
            tinyMCE.activeEditor.selection.setContent('[mk_button style="three-dimension" size="large" bg_color="#444444" txt_color="#fff" outline_skin="#444444" outline_hover_skin="#fff" icon="theme-icon-video" url="Button URL" target="_self" align="left" id="Button ID" margin_bottom="15"]Button text[/mk_button]');
          }

          if (id === 'message-box') {
            tinyMCE.activeEditor.selection.setContent('[mk_message_box type="alert"]Message box text[/mk_message_box]');
          }

          if (id === 'call-to-action') {
            tinyMCE.activeEditor.selection.setContent('[mk_call_to_action style="default" text_size="18" font_weight="inhert" text="Here is the content" button_text="Button Text" button_url="Button URL" outline_skin="#444" outline_hover_skin="#fff"]');
          }

          if (id === 'image-slideshow') {
            tinyMCE.activeEditor.selection.setContent('[mk_image_slideshow images="12166,12166,12166" direction="horizontal" image_width="770" image_height="350" animation_speed="700" slideshow_speed="7000" direction_nav="true" pagination="true"]');
          }


          if (id === 'edge-slideshow') {
            tinyMCE.activeEditor.selection.setContent('[vc_row fullwidth="true"][vc_column width="1/1"][mk_edge_slider slides="13089,13086" order="ASC" orderby="date" full_height="true" height="700" animation_speed="700" slideshow_speed="7000" direction_nav="true"][/vc_column][/vc_row]');
          }



          if (id === 'testimonial-slideshow') {
            tinyMCE.activeEditor.selection.setContent('[mk_testimonials style="boxed" count="4" testimonials="8889,8890" font_family="none" order="DESC" orderby="date"]');
          }



          if (id === 'chart') {
            tinyMCE.activeEditor.selection.setContent('[mk_chart percent="50" track_color="#fafafa" line_width="15" bar_size="170" content_type="percent"]');
          }



          if (id === 'skill-meter') {
            tinyMCE.activeEditor.selection.setContent('[mk_skill_meter title="Title" percent="50" color="#dd9933"]');
          }


          if (id === 'pricing-table') {
            tinyMCE.activeEditor.selection.setContent('[mk_pricing_table skin="light" table_number="4" order="DESC" orderby="date"]');
          }


          if (id === 'table') {
            tinyMCE.activeEditor.selection.setContent('[mk_table]<table width="100%"><thead><tr><th>Column 1</th><th>Column 2</th><th>Column 3</th><th>Column 4</th></tr></thead><tbody><tr><td>Item #1</td><td>Description</td><td>Subtotal:</td><td>$3.00</td></tr><tr><td>Item #2</td><td>Description</td><td>Discount:</td><td>$4.00</td></tr><tr><td>Item #3</td><td>Description</td><td>Shipping:</td><td>$7.00</td></tr><tr><td>Item #4</td><td>Description</td><td>Tax:</td><td>$6.00</td></tr><tr><td><strong>All Items</strong></td><td><strong>Description</strong></td><td><strong>Your Total:</strong></td><td><strong>$20.00</strong></td></tr></tbody></table>[/mk_table]');
          }


          if (id === 'milestone') {
            tinyMCE.activeEditor.selection.setContent('[mk_milestone start="0" stop="100" speed="2000" number_size="46" type="icon" icon="theme-icon-sitemap" text_size="12" color="#919191"]');
          }


          if (id === 'process-steps') {
            tinyMCE.activeEditor.selection.setContent('[mk_process_steps orientation="vertical"][mk_step title="Step 1" tab_id="1394462023-1-7"][/mk_step][mk_step title="Step 2" tab_id="1394462023-2-20"][/mk_step][/mk_process_steps]');
          }



          if (id === 'blog') {
            tinyMCE.activeEditor.selection.setContent('[mk_blog style="classic" column="3" image_height="350" count="10" offset="0" pagination="true" disable_meta="true" classic_excerpt="excerpt" pagination_style="1" order="DESC" orderby="date"]');
          }


          if (id === 'portfolio') {
            tinyMCE.activeEditor.selection.setContent('[mk_portfolio style="grid" ajax="true" item_row="1" column="3" width="400" height="400" count="10" sortable="true" offset="0" pagination="true" pagination_style="1" order="DESC" orderby="date" target="_self"]');
          }

          if (id === 'employees') {
            tinyMCE.activeEditor.selection.setContent('[mk_employees style="column" column="3" dimension="250" scroll="true" count="10" offset="0" description="true" order="DESC" orderby="date"]');
          }


          if (id === 'clients') {
            tinyMCE.activeEditor.selection.setContent('[mk_clients count="10" scroll="true" order="DESC" orderby="date" dimension="180" cover="false" target="_self"]');
          }


          if (id === 'twitter-feeds') {
            tinyMCE.activeEditor.selection.setContent('[vc_twitter twitter_name="your twitter username" tweets_count="5"]');
          }


          if (id === 'flickr') {
            tinyMCE.activeEditor.selection.setContent('[vc_flickr flickr_id="Flickr ID" count="6" column="three"]');
          }



          if (id === 'social-networks') {
            tinyMCE.activeEditor.selection.setContent('[mk_social_networks skin="dark" margin="4" align="left" facebook="#" twitter="#" rss="#" instagram="#" dribbble="#" pinterest="#" google_plus="#" linkedin="#" youtube="#" tumblr="#"]');
          }

          if (id === 'contact-form') {
            tinyMCE.activeEditor.selection.setContent('[mk_contact_form email="your email address" skin="dark"]');
          }


          if (id === 'contact-info') {
            tinyMCE.activeEditor.selection.setContent('[mk_contact_info name="Name" cellphone="Cellphone" phone="Phone" address="Address" website="Website" email="Email"]');
          }


          if (id === 'video-player') {
            tinyMCE.activeEditor.selection.setContent('[vc_video title="Widget Title" link="Video link"]');
          }


          if (id === 'audio-player') {
            tinyMCE.activeEditor.selection.setContent('[mk_audio file_title="Audio Title" mp3_file="Uplaod MP3 file format" ogg_file="Uplaod OGG file format" small_version="false"]');
          }


          if (id === 'google-maps') {
            tinyMCE.activeEditor.selection.setContent('[mk_gmaps height="300" latitude="Latitude" longitude="Longitude" zoom="14" pan_control="true" draggable="true" scroll_wheel="true" zoom_control="true" map_type_control="true" scale_control="true" marker="true" pin_icon="Upload Marker Icon" modify_coloring="false" hue="#ccc" saturation="1" lightness="1"]');
          }

          return false;

        }
      });
    }

  });

  tinymce.PluginManager.add('mk_shortcodes', tinymce.plugins.mkShortcodeMce);

})();