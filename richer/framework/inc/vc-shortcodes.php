<?php
$no_yes = array(
      __('No', 'richer-framework')=>'no',
      __('Yes', 'richer-framework')=>'yes'
   );

add_action( 'init', 'asw_vc_shortcodes' );
function asw_vc_shortcodes() {
   $TrueFalse = array(
      __('True', 'richer-framework')=>'true',  
      __('False', 'richer-framework')=>'false'
   );
   $yes_no = array(
      __('Yes', 'richer-framework')=>'yes',
      __('No', 'richer-framework')=>'no'
   );
   $target_arr = array(
      __( 'Same window', 'richer-framework' ) => '_self',
      __( 'New window', 'richer-framework' ) => '_blank'
   );
   global $no_yes;
   $position = array(
      __('Left','richer-framework') => 'left',
      __('Right','richer-framework') => 'right',
      __('Center','richer-framework') => 'center',
   );
   vc_map( array(
      "name" => __("Alert", 'richer-framework'),
      "base" => "alert",
      "icon" => get_template_directory_uri().'/vc_templates/images/alert.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'admin_enqueue_js' => '',
      'admin_enqueue_css' => '',
      'description' => __('Notification box.', 'richer-framework'),
      "params" => array(
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Style", 'richer-framework'),
            "param_name" => "type",
            'admin_label' => true,
            "value" => array('notice', 'info', 'success', 'warning', 'error', 'custom'),
            "description" => __("Alert type. Select 'custom' and use for style options below.", "richer-framework"),
            "std" => array('notice')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Close button", 'richer-framework'),
            "param_name" => "close",
            "value" => $TrueFalse,
            "description" => __("Show close button or not - true, false. Check true to show.", "richer-framework"),
            "std" => array('true')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Icon", 'richer-framework'),
            "param_name" => "icon",
            "value" => '',
            "description" => __('Icon name (optional) - ', 'richer-framework').'<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">'.__('refer here', 'richer-framework').'</a>'
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Color", 'richer-framework'),
            "param_name" => "color",
            "value" => '',
            "description" => __("Select your text color.", "richer-framework"),
            'dependency' => array(
               'element'=>'type',
               'value' => 'custom'
            )
         ),
          array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Border size", 'richer-framework'),
            "param_name" => "border_size",
            "value" => '',
            "description" => __("Enter border size. (e.g. 2px)", "richer-framework"),
            'dependency' => array(
               'element'=>'type',
               'value' => 'custom'
            )
         ),
          array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Border color", 'richer-framework'),
            "param_name" => "border_color",
            "value" => '',
            "description" => __("Select your border color.", "richer-framework"),
            'dependency' => array(
               'element'=>'type',
               'value' => 'custom'
            )
         ),
          array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Background color", 'richer-framework'),
            "param_name" => "background_color",
            "value" => '',
            "description" => __("Select alert background color.", "richer-framework"),
            'dependency' => array(
               'element'=>'type',
               'value' => 'custom'
            )
         ),
          array(
            "type" => "textarea",            
            "class" => "",
            "heading" => __("Alert message!", 'richer-framework'),
            "param_name" => "content",
            "value" => 'Your alert message!',
            "description" => ''
         ),
      )
   )
);
vc_map( array(
      "name" => __("Portfolio", 'richer-framework'),
      "base" => "portfolio",
      "icon" => get_template_directory_uri().'/vc_templates/images/portfolio.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'admin_enqueue_js' => '',
      'admin_enqueue_css' => '',
      'description' => __('Show items from your portfolio', 'richer-framework'),
      "params" => array(
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Layout", 'richer-framework'),
            "param_name" => "layout",
            'admin_label' => true,
            "value" => array(
               __('Grid type', 'richer-framework')=>'grid', 
               __('Grid with margins', 'richer-framework', 'richer-framework')=>'grid-with-margins', 
               __('Grid with shadows', 'richer-framework')=>'grid-with-shadow', 
               __('Carousel', 'richer-framework')=>'carousel', 
               __('Fullwidth carousel', 'richer-framework')=>'fullwidth-carousel', 
               __('Grid with excerpts', 'richer-framework')=>'grid-with-excerpts', 
               __('Grid masonry', 'richer-framework')=>'grid-masonry', 
               __('Grid only thumbnails', 'richer-framework')=>'grid-only-images',
               __('Single column', 'richer-framework')=>'single-column'
            ),
            "description" => __("Select layout type.", "richer-framework"),
            "std" => array('grid')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Slideshow", 'richer-framework'),
            "param_name" => "slideshow",
            "value" => $TrueFalse,
            "description" => __("Enable or Disable auto scroll. Set 'true' to enable.", "richer-framework"),
            'dependency' => array(
               'element'=>'layout',
               'value' => array('carousel', 'fullwidth-carousel')
            ),
            "std" => array('false')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Columns", 'richer-framework'),
            "param_name" => "columns",
            "value" => array('2', '3', '4', '5', '6'),
            "description" => __('Select columns count.', 'richer-framework'),
            "std" => array('2')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("How many posts to show?", 'richer-framework'),
            "param_name" => "number_posts",
            "value" => '',
            "description" => __("This is how many posts will be displayed.", "richer-framework")            
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Category slug", 'richer-framework'),
            "param_name" => "cat_slug",
            "value" => '',
            "description" => __("This help you to retrieve items from specific category. More than one separate by commas.", "richer-framework")
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show filter?", 'richer-framework'),
            "param_name" => "filter",
            "value" => $no_yes,
            "description" => __("Enable or Disable category filter for projects.", "richer-framework"),
            "std" => array('no')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Filter position", 'richer-framework'),
            "param_name" => "filter_pos",
            "value" => $position,
            "description" => __("Select filter position.", "richer-framework"),
            'dependency' => array(
               'element'=>'filter',
               'value' => 'yes'
            ),
            "std" => array('center')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Excerpt words count", 'richer-framework'),
            "param_name" => "excerpt_count",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show title?", 'richer-framework'),
            "param_name" => "show_title",
            "value" => $yes_no,
            "description" => '',
            "std" => array('yes')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show hover?", 'richer-framework'),
            "param_name" => "show_hover",
            "value" => $yes_no,
            "description" => '',
            "std" => array('yes')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show 'load more' button?", 'richer-framework'),
            "param_name" => "loadmore_btn",
            "value" => $no_yes,
            "description" => '',
            "std" => array('no')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Button ('load more') text", 'richer-framework'),
            "param_name" => "loadmore_btn_text",
            "value" => '',
            "description" => '',
            'dependency' => array(
               'element'=>'loadmore_btn',
               'value' => 'yes'
            )
         ),
      )
   )
);
vc_map( array(
      "name" => __("Recent posts", 'richer-framework'),
      "base" => "recentposts",
      "icon" => get_template_directory_uri().'/vc_templates/images/recentposts.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'admin_enqueue_js' => '',
      'admin_enqueue_css' => '',
      'description' => __('Show recent/popular posts', 'richer-framework'),
      "params" => array(
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Layout", 'richer-framework'),
            "param_name" => "layout",
            'admin_label' => true,
            "value" => array(
               __('Grid type', 'richer-framework')=>'grid',
               __('Carousel', 'richer-framework')=>'carousel', 
               __('List', 'richer-framework')=>'list', 
               __('List with date', 'richer-framework')=>'list-with-date', 
               __('Grid list with date', 'richer-framework')=>'grid-list-with-date'
            ),
            "description" => __("Select layout type.", "richer-framework"),
            "std" => array('grid')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Slideshow", 'richer-framework'),
            "param_name" => "slideshow",
            "value" => $TrueFalse,
            "description" => __("Enable or Disable auto scroll. Set 'true' to enable.", "richer-framework"),
            'dependency' => array(
               'element'=>'layout',
               'value' => array('carousel')
            ),
            "std" => array('true')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Columns", 'richer-framework'),
            "param_name" => "columns",
            "value" => array('2', '3', '4'),
            "description" => __('Select columns count.', 'richer-framework'),
            "std" => array('2')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("How many posts to show?", 'richer-framework'),
            "param_name" => "number_posts",
            "value" => '',
            "description" => __("This is how many posts will be displayed.", "richer-framework")            
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Category slug", 'richer-framework'),
            "param_name" => "cat_slug",
            "value" => '',
            "description" => __("This help you to retrieve items from specific category. More than one separate by commas.", "richer-framework")
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Order post by:", 'richer-framework'),
            "param_name" => "orderby",
            "value" => array(
               __('Date', 'richer-framework')=>'date', 
               __('Popularity', 'richer-framework')=>'popular',
               __('Title', 'richer-framework')=>'title',
            ),
            "description" => "",
            "std" => array('date')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Order:", 'richer-framework'),
            "param_name" => "order",
            "value" => array(
               __('Descending', 'richer-framework')=>'DESC', 
               __('Ascending', 'richer-framework')=>'ASC'
            ),
            "description" => "",
            "std" => array('DESC')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Excerpt words count", 'richer-framework'),
            "param_name" => "excerpt_count",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show 'read more' link?", 'richer-framework'),
            "param_name" => "show_readmore",
            "value" => $yes_no,
            "description" => '',
            "std" => array('yes')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("link ('read more') text", 'richer-framework'),
            "param_name" => "readmore_text",
            "value" => '',
            "description" => __('Input link "read more" text.','richer-framework'),
            'dependency' => array(
               'element'=>'show_readmore',
               'value' => 'yes'
            )
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show author info?", 'richer-framework'),
            "param_name" => "show_author",
            "value" => $yes_no,
            "description" => '',
            "std" => array('yes')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show thumbnail?", 'richer-framework'),
            "param_name" => "show_thumb",
            "value" => $yes_no,
            "description" => '',
            "std" => array('yes')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show pagination?", 'richer-framework'),
            "param_name" => "pagination",
            "value" => $no_yes,
            "description" => __('Enable or Disable pagination for posts. Only for grid view.', 'richer-framework'),
            "std" => array('no')
         ),
      )
   )
);
vc_map( array(
      "name" => __("Recent comments", 'richer-framework'),
      "base" => "recentcomments",
      "icon" => get_template_directory_uri().'/vc_templates/images/recentcomments.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Show recently added comments', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("How many comments to show?", 'richer-framework'),
            "param_name" => "count",
            'admin_label' => true,
            "value" => '',
            "description" => __("This is how many recent comments will be displayed.", "richer-framework")            
         ),
      )
   )
);
vc_map( array(
      "name" => __("SoundCloud", 'richer-framework'),
      "base" => "soundcloud",
      "icon" => get_template_directory_uri().'/vc_templates/images/soundcloud.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Embed SoundCloud item', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Url", 'richer-framework'),
            "param_name" => "url",
            'admin_label' => true,
            "value" => '',
            "description" => __("Url to your track from soundcloud. (e.g. https://soundcloud.com/eranda-janku/alex-vargas-more-usher-cover)", "richer-framework")
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Autoplay", 'richer-framework'),
            "param_name" => "autoplay",
            "value" => $no_yes,
            "description" => '',
            "std" => array('no')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Comments", 'richer-framework'),
            "param_name" => "comments",
            "value" => $no_yes,
            "description" => '',
            "std" => array('no')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Play button color", 'richer-framework'),
            "param_name" => "color",
            "value" => '',
            "description" => ''            
         )
      )
   )
);
vc_map( array(
      "name" => __("Testimonials", 'richer-framework'),
      "base" => "testimonial",
      "icon" => get_template_directory_uri().'/vc_templates/images/testimonial.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays testimonial', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Testimonial slug", 'richer-framework'),
            "param_name" => "testi_slug",
            "value" => '',
            "description" => __("Enter your testimonial post slug.", "richer-framework")
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Select testimonial item layout.", 'richer-framework'),
            "param_name" => "type",
            'admin_label' => true,
            "value" => array('thumb-side', 'thumb-bottom', 'without-thumb', 'bordered-with-thumb'),
            "description" => '',
            "std" => array('thumb-side')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("The number of last(by date) testimonials items.", 'richer-framework'),
            "param_name" => "num",
            "value" => '',
            "description" => __('Enter your testimonials number. Option with testimonial slug leave blank.','richer-framework')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("The number of words in the excerpt", 'richer-framework'),
            "param_name" => "excerpt_count",
            "value" => '',
            "description" => __('How many words are displayed in the excerpt?','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Display testimonial items as list", 'richer-framework'),
            "param_name" => "disp_as_list",
            "value" => $no_yes,
            "description" => '',
            "std" => array('no')
         ),
      )
   )
);
vc_map( array(
      "name" => __("Testimonials Carousel", 'richer-framework'),
      "base" => "testimonial_carousel",
      "icon" => get_template_directory_uri().'/vc_templates/images/testimonial_carousel.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays testimonials', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("The number of last(by date) testimonials items.", 'richer-framework'),
            "param_name" => "num",
            'admin_label' => true,
            "value" => '',
            "description" => __('Enter your testimonials number. Option with testimonial slug leave blank.','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Do you want to show the author's image?", "richer-framework"),
            "param_name" => "thumb",
            "value" => $TrueFalse,
            "description" => __("Enable or disable thumb image. True to enable.", "richer-framework"),
            "std" => array('true')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Select testimonial item layout.", 'richer-framework'),
            "param_name" => "type",
            "value" => array('thumb-side', 'thumb-bottom', 'without-thumb', 'bordered-with-thumb'),
            "description" => '',
            "std" => array('thumb-side')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("The number of words in the excerpt", 'richer-framework'),
            "param_name" => "excerpt_count",
            "value" => '',
            "description" => __('How many words are displayed in the excerpt?','richer-framework')
         ),
      )
   )
);
$text_aligns = array(
   __('Left','richer-framework')=>'left',
   __('Center','richer-framework')=>'center',
   __('Right','richer-framework')=>'right',
);
vc_map( array(
      "name" => __("Images carousel", 'richer-framework'),
      "base" => "images_carousel",
      "icon" => get_template_directory_uri().'/vc_templates/images/images_carousel.png',
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Animated carousel with images', 'richer-framework'),
      "params" => array(
         array(
            'type' => 'attach_images',
            'heading' => __( 'Images', 'richer-framework' ),
            'param_name' => 'images',
            'admin_label' => true,
            'value' => '',
            'description' => __( 'Select images from media library.', 'richer-framework' )
         ),
         array(
            "type" => "dropdown",            
      "heading" => __("Select carousel style", 'richer-framework'),
            "param_name" => "lc_style",
            "value" => array(
               __('With border','richer-framework')=>'bordered', 
               __('With separators','richer-framework')=>'separated', 
               __('With border when hover','richer-framework')=>'without-border'
            ),
            "description" => "",
            "std" => array('bordered')
         ),
         array(
            "type" => "textfield",            
      "heading" => __("Items per view", 'richer-framework'),
            "param_name" => "items",
            "value" => '5',
            "description" => ""
         ),
         array(
            "type" => "dropdown",            
      "heading" => __("Show prev/next buttons", 'richer-framework'),
            "param_name" => "navigation",
            "value" => $TrueFalse,
            "description" => __("Select true to show prev/next buttons", "richer-framework"),
            "std" => array('true')
         ),
         array(
            "type" => "textfield",            
      "heading" => __("Autoplay", 'richer-framework'),
            "param_name" => "autoplay",
            "value" => '5000',
            "description" => __("Set slideshow speed for example 5000 to play every 5 seconds. Set 'false' to disable.", "richer-framework")
         ),
         array(
            'type' => 'dropdown',
            'heading' => __( 'On click', 'richer-framework' ),
            'param_name' => 'onclick',
            'value' => array(
               __( 'Open prettyPhoto', 'richer-framework' ) => 'link_image',
               __( 'Do nothing', 'richer-framework' ) => 'link_no',
               __( 'Open custom link', 'richer-framework' ) => 'custom_link'
            ),
            'description' => __( 'What to do when slide is clicked?', 'richer-framework' ),
            'std' => array('link_image')
         ),
         array(
            'type' => 'exploded_textarea',
            'heading' => __( 'Custom links', 'richer-framework' ),
            'param_name' => 'custom_links',
            'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter).', 'richer-framework' ),
            'dependency' => array(
               'element' => 'onclick',
               'value' => array( 'custom_link' )
            )
         ),
         array(
            'type' => 'dropdown',
            'heading' => __( 'Custom link target', 'richer-framework' ),
            'param_name' => 'target',
            'description' => __( 'Select where to open custom links.', 'richer-framework' ),
            'dependency' => array(
               'element' => 'onclick',
               'value' => array( 'custom_link' )
            ),
            'value' => $target_arr,
            'std' => array('_self')
         ),
      )
   ));
vc_map( array(
      "name" => __("Team member", 'richer-framework'),
      "base" => "member",
      "icon" => get_template_directory_uri().'/vc_templates/images/member.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays your team members', 'richer-framework'),
      "params" => array(
         array(
            "type" => "attach_image",            
            "class" => "",
            "heading" => __("Member image", 'richer-framework'),
            "param_name" => "img",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Member name", "richer-framework"),
            "param_name" => "name",
            'admin_label' => true,
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Member url", "richer-framework"),
            "param_name" => "member_url",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Member position", "richer-framework"),
            "param_name" => "role",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Text align", 'richer-framework'),
            "param_name" => "text_align",
            "value" => $text_aligns,
            "description" => '',
            "std" => array('left')
         ),
         array(
            "type" => "textarea_html",            
            "class" => "",
            "heading" => __("Content", "richer-framework"),
            "param_name" => "content",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Twitter (username)", "richer-framework"),
            "param_name" => "twitter",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Facebook (url)", "richer-framework"),
            "param_name" => "facebook",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Pinterest (url)", "richer-framework"),
            "param_name" => "pinterest",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Email (email address)", "richer-framework"),
            "param_name" => "email",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Linkedin (url)", "richer-framework"),
            "param_name" => "linkedin",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Youtube (url)", "richer-framework"),
            "param_name" => "youtube",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Google + (url)", "richer-framework"),
            "param_name" => "googleplus",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Dribbble (url)", "richer-framework"),
            "param_name" => "dribbble",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Xing (url)", "richer-framework"),
            "param_name" => "xing",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Vimeo (url)", "richer-framework"),
            "param_name" => "vimeo",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Github (url)", "richer-framework"),
            "param_name" => "github",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Tumblr (url)", "richer-framework"),
            "param_name" => "tumblr",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Renren (url)", "richer-framework"),
            "param_name" => "renren",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Weibo (url)", "richer-framework"),
            "param_name" => "weibo",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Flickr (url)", "richer-framework"),
            "param_name" => "flickr",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            'group' => 'Social links',
            "heading" => __("Skype (account)", "richer-framework"),
            "param_name" => "skype",
            "value" => '',
            "description" => ''
         ),
      )
   )
);
vc_map( array(
      "name" => __("Call to action", 'richer-framework'),
      "base" => "calltoaction",
      "icon" => get_template_directory_uri().'/vc_templates/images/calltoaction.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Help to catch visitors attention', 'richer-framework'),
      "params" => array(
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Background color", 'richer-framework'),
            "param_name" => "bg_color",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Border width", "richer-framework"),
            "param_name" => "border_width",
            "value" => '',
            "description" => __("Enter border width in pixel, without dimensions. (e.g. 2)", "richer-framework")
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Border color", 'richer-framework'),
            "param_name" => "border_color",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Show button?", 'richer-framework'),
            "param_name" => "button",
            "value" => $yes_no,
            "description" => '',
            "std" => array('yes')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Button label", 'richer-framework'),
            "param_name" => "buttonlabel",
            "value" => '',
            "description" => __('Enter the label for button. (e.g. Learn more)','richer-framework'),
            'dependency' => array(
               'element'=>'button',
               'value' => 'yes'
            )
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Button Link", 'richer-framework'),
            "param_name" => "link",
            "value" => '',
            "description" => __('Enter the link for button. (e.g. http://www.google.com)','richer-framework'),
            'dependency' => array(
               'element'=>'button',
               'value' => 'yes'
            )
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button Color", 'richer-framework'),
            "param_name" => "buttoncolor",
            "value" => array('default', 'white', 'lightgray', 'blue', 'lightgreen', 'green', 'pink', 'red', 'orange', 'yellow', 'ginger', 'brown', 'turquoise', 'gray', 'black'),
            "description" => __('Choose button color. Default buttons color it is your main theme color.','richer-framework'),
            'dependency' => array(
               'element'=>'button',
               'value' => 'yes'
            ),
            "std" => array('default')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button Size", 'richer-framework'),
            "param_name" => "buttonsize",
            "value" => array('mini', 'small', 'medium', 'large'),
            "description" => __('Choose button size.','richer-framework'),
            'dependency' => array(
               'element'=>'button',
               'value' => 'yes'
            ),
            "std" => array('mini')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button Style", 'richer-framework'),
            "param_name" => "buttonstyle",
            "value" => array('simple', 'gradient', 'three_d', 'simple rounded', 'gradient rounded'),
            "description" => __('Choose button style.','richer-framework'),
            'dependency' => array(
               'element'=>'button',
               'value' => 'yes'
            ),
            "std" => array('simple')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button position", 'richer-framework'),
            "param_name" => "button_position",
            "value" => array('left', 'right', 'center', 'like_text'),
            "description" => __('Choose button position.','richer-framework'),
            'dependency' => array(
               'element'=>'button',
               'value' => 'yes'
            ),
            "std" => array('left')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Target blank?", 'richer-framework'),
            "param_name" => "target_blank",
            "value" => $yes_no,
            "description" => __('Select "yes", if you want to open link in new window.','richer-framework'),
            'dependency' => array(
               'element'=>'button',
               'value' => 'yes'
            ),
            "std" => array('yes')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Text position", 'richer-framework'),
            "param_name" => "text_position",
            "value" => $text_aligns,
            "description" => __('Choose text position.','richer-framework'),
            "std" => array('left')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Text color", 'richer-framework'),
            "param_name" => "text_color",
            "value" => '',
            "description" => __('Choose text color.','richer-framework')
         ),
         array(
            "type" => "textarea_html",            
            "class" => "",
            "heading" => __("Call to action block text", "richer-framework"),
            "param_name" => "content",
            'admin_label' => true,
            "value" => '',
            "description" => ''
         ),
      )
   )
);
vc_map( array(
      "name" => __("Toggle", 'richer-framework'),
      "base" => "toggle",
      "icon" => get_template_directory_uri().'/vc_templates/images/toggle.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Toggle element', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Title", 'richer-framework'),
            "param_name" => "title",
            'admin_label' => true,
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Icon name (optional)", "richer-framework"),
            "param_name" => "icon",
            "value" => '',
            "description" => __('Icon list - ', 'richer-framework').'<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">'.__('refer here', 'richer-framework').'</a>'
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Style", 'richer-framework'),
            "param_name" => "style",
            "value" => array('style1', 'style2', 'style3', 'style4'),
            "description" => __('Select predefined style for your toggle','richer-framework'),
            "std" => array('style1')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Open", 'richer-framework'),
            "param_name" => "open",
            "value" => $TrueFalse,
            "description" => '',
            "std" => array('true')
         ),
         array(
            "type" => "textarea_html",            
            "class" => "",
            "heading" => __("Toggle content", "richer-framework"),
            "param_name" => "content",
            "value" => '',
            "description" => ''
         ),
      )
   )
);

vc_map( array(
      "name" => __("Button", 'richer-framework'),
      "base" => "button",
      "icon" => get_template_directory_uri().'/vc_templates/images/button.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Add button to your page/content', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Button Link", 'richer-framework'),
            "param_name" => "link",
            "value" => '',
            "description" => __('Enter the link for button. (e.g. http://www.google.com)','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button Color", 'richer-framework'),
            "param_name" => "color",
            "value" => array('default', 'white', 'lightgray', 'blue', 'lightgreen', 'green', 'pink', 'red', 'orange', 'yellow', 'ginger', 'brown', 'turquoise', 'gray', 'black'),
            "description" => __('Choose button color. Default buttons color it is your main theme color.','richer-framework'),
            "std" => array('default')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button Size", 'richer-framework'),
            "param_name" => "size",
            "value" => array('mini', 'small', 'medium', 'large'),
            "description" => __('Choose button size.','richer-framework'),
            "std" => array('mini')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button Style", 'richer-framework'),
            "param_name" => "style",
            "value" => array('simple', 'gradient', 'three_d', 'simple rounded', 'gradient rounded'),
            "description" => __('Choose button style.','richer-framework'),
            "std" => array('simple')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button position", 'richer-framework'),
            "param_name" => "align",
            "value" => array('left', 'right', 'center', 'none'),
            "description" => __('Choose button position.','richer-framework'),
            'dependency' => array(
               'element'=>'button',
               'value' => 'yes'
            ),
            "std" => array('left')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Button label", 'richer-framework'),
            "param_name" => "content",
            'admin_label' => true,
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Icon name (optional)", 'richer-framework'),
            "param_name" => "icon",
            "value" => '',
            "description" => __('Icon list - ', 'richer-framework').'<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">'.__('refer here', 'richer-framework').'</a>'
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Icon position", 'richer-framework'),
            "param_name" => "icon_pos",
            "value" => array('left', 'right'),
            "description" => __('Choose icon position.','richer-framework'),
            "std" => array('left')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Target", 'richer-framework'),
            "param_name" => "target",
            "value" => array('_blank', '_self', '_parent', '_top'),
            "description" => __('The target attribute specifies a window or a frame where the linked document is loaded. Learn about this','richer-framework')."<a href='http://www.w3schools.com/tags/att_a_target.asp' target='_blank'>".__(' more','richer-framework')."</a>",
            "std" => array('_blank')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Button lightbox", 'richer-framework'),
            "param_name" => "lightbox",
            "value" => $TrueFalse,
            "description" => __('If you need button to show image or video in lightbox select "true". Also, your button must link to image or video (vimeo, youtube, etc.)','richer-framework'),
            "std" => array('true')
         ),
      )
   )
);
vc_map( array(
      "name" => __("Circle counter", 'richer-framework'),
      "base" => "circle_counter",
      "icon" => get_template_directory_uri().'/vc_templates/images/circle_counter.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Animated chart circle bar', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Value", 'richer-framework'),
            "param_name" => "value",
            "value" => '',
            "description" => __('Enter the value for bar (%).','richer-framework')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Circle diameter", 'richer-framework'),
            "param_name" => "size",
            "value" => '220',
            "description" => __('Enter diameter for your circle (px).','richer-framework')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Filled color", 'richer-framework'),
            "param_name" => "filledcolor",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Unfilled color", 'richer-framework'),
            "param_name" => "unfilledcolor",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Circle label", "richer-framework"),
            "param_name" => "content",
            'admin_label' => true,
            "value" => '',
            "description" => ''
         ),
      )
   )
);
vc_map( array(
      "name" => __("Counter box", 'richer-framework'),
      "base" => "counter_box",
      "icon" => get_template_directory_uri().'/vc_templates/images/counter_box.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Animated counter box', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Counter title", 'richer-framework'),
            "param_name" => "title",
            'admin_label' => true,
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Value", 'richer-framework'),
            "param_name" => "value",
            "value" => '',
            "description" => __('Enter the value.','richer-framework')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Choose the color for counter.", 'richer-framework'),
            "param_name" => "color",
            "value" => '',
            "description" => ''
         ),
      )
   )
);
vc_map( array(
      "name" => __("Flickr", 'richer-framework'),
      "base" => "flickr",
      "icon" => get_template_directory_uri().'/vc_templates/images/flickr.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays your flickr photos', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Flickr ID", 'richer-framework'),
            "param_name" => "username",
            "value" => '',
            'admin_label' => true,
            "description" => __('Enter Flickr ID. Use','richer-framework').' <a href="http://idgettr.com/"" target="_blank">'.__('Get flickr id','richer-framework').'</a>'
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Enter flickr items amount.", 'richer-framework'),
            "param_name" => "pics",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Thumbnail size", 'richer-framework'),
            "param_name" => "pic_size",
            "value" => array('Square (75x75)', 'Thumbnail (100x75)', 'Large Square (150x150)', 'Small (240x180)', 'Medium (500x375)'),
            "description" => '',
            "std" => array('Square (75x75)')
         ),
      )
   )
);
vc_map( array(
      "name" => __("Divider & Clear", 'richer-framework'),
      "base" => "hr",
      "icon" => get_template_directory_uri().'/vc_templates/images/hr.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Divider/Clear between blocks', 'richer-framework'),
      "params" => array(
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Style", 'richer-framework'),
            "param_name" => "style",
            "value" => array('none', 'solid_light','solid_dark', 'square_with_dot', 'dotted', 'dotted_with_lines', 'dashed_light', 'dashed_dark', 'rhombus'),
            "description" => '',
            "std" => array('none')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Divider size", 'richer-framework'),
            "param_name" => "size",
            "value" => '',
            'admin_label' => true,
            "description" => __('Please, input divider size(height between blocks) in px. (e.g. 20)','richer-framework')
         ),
      )
   )
);
vc_map( array(
      "name" => __("Icon", 'richer-framework'),
      "base" => "icon",
      "icon" => get_template_directory_uri().'/vc_templates/images/icon.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays customizable icon', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Icon name", 'richer-framework'),
            "param_name" => "name",
            "value" => '',
            "description" => __('Enter icons name to display. Icon list - ', 'richer-framework').'<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">'.__('refer here', 'richer-framework').'</a>'
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Icon size", 'richer-framework'),
            "param_name" => "size",
            "value" => array('standard', 'mini', 'medium', 'large'),
            "description" => __('Choose icon size.','richer-framework'),
            "std" => array('standard')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Icon style", 'richer-framework'),
            "param_name" => "style",
            "value" => array('simple', 'circle', 'square', 'rounded'),
            "description" => __('Choose icon style.','richer-framework'),
            "std" => array('simple')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon color", 'richer-framework'),
            "param_name" => "icon_color",
            "value" => '',
            "description" => __('Select icons color.','richer-framework')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon background color", 'richer-framework'),
            "param_name" => "icon_bg_color",
            "value" => '',
            "description" => __('Select icons background color.','richer-framework'),
            "dependency" => array(
               'element' => 'style',
               'value' => array('circle', 'square', 'rounded')
            )
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon border color", 'richer-framework'),
            "param_name" => "icon_bor_color",
            "value" => '',
            "description" => __('Select icons border color.','richer-framework'),
            "dependency" => array(
               'element' => 'style',
               'value' => array('circle', 'square', 'rounded')
            )
         )
      )
   )
);
vc_map( array(
      "name" => __("Iconbox", 'richer-framework'),
      "base" => "iconbox_new",
      "icon" => get_template_directory_uri().'/vc_templates/images/iconbox.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays feature/service block with icon', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Title", 'richer-framework'),
            "param_name" => "title",
            "value" => '',
            'admin_label' => true,
            "description" => __('Enter text for box title.','richer-framework')
         ),
         array(
            'type' => 'iconpicker',
            'group' => __('Icon design','richer-framework'),
            'heading' => __( 'Icon', 'richer-framework' ),
            'param_name' => 'icon',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
               'emptyIcon' => false,
               // default true, display an "EMPTY" icon?
               'iconsPerPage' => 4000,
               // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'description' => __( 'Select icon from library.', 'richer-framework' ),
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Iconbox style", 'richer-framework'),
            "param_name" => "iconbox_style",
            "value" => array(
               __('Icon with title','richer-framework')=>'icon_with_title', 
               __('Aside icon','richer-framework')=>'aside_icon', 
               __('Top icon','richer-framework')=>'top_icon'
            ),
            "description" => __('Choose iconbox style. Iconbox style preview you can find','richer-framework'),
            "std" => array('icon_with_title')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon style", 'richer-framework'),
            "param_name" => "icon_style",
            "value" => array(
               __('Simple','richer-framework')=>'simple', 
               __('Rounded','richer-framework')=>'rounded', 
               __('Square','richer-framework')=>'square', 
               __('Circle','richer-framework')=>'circle'
            ),
            "description" => __('Choose icon style.','richer-framework'),
            "std" => array('standard')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon size", 'richer-framework'),
            "param_name" => "icon_size",
            "value" => array(
                  __('Mini','richer-framework')=>'mini', 
                  __('Standard','richer-framework')=>'standard', 
                  __('Medium','richer-framework')=>'medium', 
                  __('Large','richer-framework')=>'large'
               ),
            "description" => __('Choose icon size.','richer-framework'),
            "std" => array('standard')
         ),   
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon color", 'richer-framework'),
            "param_name" => "icon_color",
            "value" => '',
            "description" => __('Select icons color.','richer-framework')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon background color", 'richer-framework'),
            "param_name" => "icon_bg_color",
            "value" => '',
            "description" => __('Select icons background color.','richer-framework'),
            "dependency" => array(
               'element' => 'icon_style',
               'value' => array('rounded', 'square', 'circle')
            )
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon border color", 'richer-framework'),
            "param_name" => "icon_bor_color",
            "value" => '',
            "description" => __('Select icons border color.','richer-framework'),
            "dependency" => array(
               'element' => 'icon_style',
               'value' => array('rounded', 'square', 'circle')
            )
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Iconbox background color", 'richer-framework'),
            "param_name" => "iconbox_bg_color",
            "value" => '',
            "description" => __('Background color for block.','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Content text align", 'richer-framework'),
            "param_name" => "text_align",
            "value" => $text_aligns,
            "description" => '',
            "std" => array('left')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Url", 'richer-framework'),
            "param_name" => "url",
            "value" => '',
            "description" => __('Leave blank if you need not to link your block with the page.','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("How to open link?", 'richer-framework'),
            "param_name" => "target",
            "value" => array(
               __('Open in a new frame','richer-framework')=>'_blank', 
               __('Open in the same frame','richer-framework')=>'_self'
            ),
            "description" => __('Choose iconbox style. Iconbox style preview you can find','richer-framework'),
            "std" => array('_blank')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Frame for block", 'richer-framework'),
            "param_name" => "frame",
            "value" => array('non_framed', 'framed', 'framed_when_hover'),
            "description" => __('Added border around your block.','richer-framework'),
            "std" => array('non_framed')
         ),
         array(
            "type" => "textarea_html",            
            "class" => "",
            "heading" => __("Iconbox content", 'richer-framework'),
            "param_name" => "content",
            "value" => '',
            "description" => ''
         ),
      )
   )
);
vc_map( array(
      "name" => __("Iconbox 2", 'richer-framework'),
      "base" => "iconbox",
      "icon" => get_template_directory_uri().'/vc_templates/images/iconbox.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('This element deprecated in new theme versions. Please use "Iconbox" element', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Title", 'richer-framework'),
            "param_name" => "title",
            "value" => '',
            'admin_label' => true,
            "description" => __('Enter text for box title.','richer-framework')
         ),
         array(
            'type' => 'iconpicker',
            'group' => __('Icon design','richer-framework'),
            'heading' => __( 'Icon', 'richer-framework' ),
            'param_name' => 'icon',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
               'emptyIcon' => false,
               // default true, display an "EMPTY" icon?
               'iconsPerPage' => 4000,
               // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'description' => __( 'Select icon from library.', 'richer-framework' ),
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Iconbox style", 'richer-framework'),
            "param_name" => "style",
            "value" => array(
               __('Icon with title','richer-framework')=>'icon_with_title', 
               __('Mini circle icon with title','richer-framework')=>'mini_circle_icon_with_title', 
               __('Aside rounded icon','richer-framework')=>'aside_rounded_icon', 
               __('Aside circle icon','richer-framework')=>'aside_circle_icon',
               __('Top cicle with icon','richer-framework')=>'top_icon_circle', 
               __('Top large circle with icon','richer-framework')=>'top_icon_circle_large', 
               __('Top icon standard','richer-framework')=>'top_icon_standard', 
               __('Top large icon','richer-framework')=>'top_icon_large'),
            "description" => __('Choose iconbox style. Iconbox style preview you can find','richer-framework'),
            "std" => array('icon_with_title')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon color", 'richer-framework'),
            "param_name" => "icon_color",
            "value" => '',
            "description" => __('Select icons color.','richer-framework')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon background color", 'richer-framework'),
            "param_name" => "icon_bg_color",
            "value" => '',
            "description" => __('Select icons background color.','richer-framework'),
            "dependency" => array(
               'element' => 'style',
               'value' => array('mini_circle_icon_with_title', 'aside_circle_icon', 'aside_rounded_icon', 'top_icon_circle', 'top_icon_circle_large',)
            )
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            'group' => __('Icon design','richer-framework'),
            "heading" => __("Icon border color", 'richer-framework'),
            "param_name" => "icon_bor_color",
            "value" => '',
            "description" => __('Select icons border color.','richer-framework'),
            "dependency" => array(
               'element' => 'style',
               'value' => array('mini_circle_icon_with_title', 'aside_circle_icon', 'aside_rounded_icon', 'top_icon_circle', 'top_icon_circle_large',)
            )
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Iconbox background color", 'richer-framework'),
            "param_name" => "iconbox_bg_color",
            "value" => '',
            "description" => __('Background color for block.','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Content text align", 'richer-framework'),
            "param_name" => "text_align",
            "value" => $text_aligns,
            "description" => '',
            "std" => array('left')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Url", 'richer-framework'),
            "param_name" => "url",
            "value" => '',
            "description" => __('Leave blank if you need not to link your block with the page.','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("How to open link?", 'richer-framework'),
            "param_name" => "target",
            "value" => array(
               __('Open in a new frame','richer-framework')=>'_blank', 
               __('Open in the same frame','richer-framework')=>'_self'
            ),
            "description" => __('Choose iconbox style. Iconbox style preview you can find','richer-framework'),
            "std" => array('_blank')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Frame for block", 'richer-framework'),
            "param_name" => "frame",
            "value" => array('non_framed', 'framed', 'framed_when_hover'),
            "description" => __('Added border around your block.','richer-framework'),
            "std" => array('non_framed')
         ),
         array(
            "type" => "textarea_html",            
            "class" => "",
            "heading" => __("Iconbox content", 'richer-framework'),
            "param_name" => "content",
            "value" => '',
            "description" => ''
         ),
      )
   )
);
vc_map( array(
      "name" => __("Pricing table", 'richer-framework'),
      "base" => "plan",
      "icon" => get_template_directory_uri().'/vc_templates/images/plan.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays pricing table plan', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Pracing plan name", 'richer-framework'),
            "param_name" => "name",
            'admin_label' => true
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Link", 'richer-framework'),
            "param_name" => "link",
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Button label", 'richer-framework'),
            "param_name" => "linkname",
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Price", 'richer-framework'),
            "param_name" => "price",
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Pricing timeline (e.g. /mo)", 'richer-framework'),
            "param_name" => "per",
         ),
         array(
            "type" => "textarea",            
            "class" => "",
            "heading" => __("Features", 'richer-framework'),
            "param_name" => "features",
            "description" => __('Start each feature on new line','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Extra height for block", 'richer-framework'),
            "param_name" => "extra_height",
            "value" => $no_yes,
            "description" => '',
            "std" => array('no')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Block accent color", 'richer-framework'),
            "param_name" => "color",
         ),
      )
   )
);
vc_map( array(
      "name" => __("Progress Bar", 'richer-framework'),
      "base" => "progressbar_sets",
      "icon" => get_template_directory_uri().'/vc_templates/images/progressbar_sets.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays animated progress bars', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textarea",            
            "class" => "",
            "heading" => __("Progress bars set", 'richer-framework'),
            "param_name" => "features",
            "value" => '90%|Web design\n84%|Development\n95%|Customization',
            'description' => __('Add bar from new line', 'richer-framework'),
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Choose the type for bar", 'richer-framework'),
            "value" => array('title-inside', 'title-outside', 'slim-title-outside'),
            'admin_label' => true,
            "param_name" => "type",
            "std" => array('title-inside')
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Filled color", 'richer-framework'),
            "value" => '',
            "param_name" => "filledcolor",
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Unfilled color", 'richer-framework'),
            "value" => '',
            "param_name" => "unfilledcolor",
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Striped progressbar?", 'richer-framework'),
            "value" => array(
               __('Yes','richer-framework') => 'striped',
               __('No','richer-framework') => 'non_striped'
            ),
            "param_name" => "striped",
            "std" => array('striped')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Animated progressbar?", 'richer-framework'),
            "value" => $no_yes,
            "param_name" => "animated",
            "std" => array('no')
         ),
      )
   )
);

vc_map( array(
      "name" => __("Separator title", 'richer-framework'),
      "base" => "separator",
      "icon" => get_template_directory_uri().'/vc_templates/images/separator.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays special title', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Title", 'richer-framework'),
            "param_name" => "title",
            'admin_label' => true,
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Choose the heding size", 'richer-framework'),
            "value" => array('h3', 'h1', 'h2', 'h4', 'h5', 'h6'),
            "param_name" => "headline",
            "std" => array('h3')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Subtitle", 'richer-framework'),
            "param_name" => "subtitle",
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Style", 'richer-framework'),
            "value" => $text_aligns,
            "param_name" => "style",
            "std" => array('left')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Separator width", 'richer-framework'),
            "value" => array('short', 'fullwidth', 'simple_short'),
            "param_name" => "width_style",
            "std" => array('short')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Separator margin", 'richer-framework'),
            "value" => '',
            "param_name" => "margin",
            'description' => __('Please, input separator margin in px. (e.g. 20)', 'richer-framework'),
         ),
      )
   )
);
vc_map( array(
      "name" => __("Blockquote", 'richer-framework'),
      "base" => "blockquote",
      "icon" => get_template_directory_uri().'/vc_templates/images/blockquote.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays blockquote block', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textarea_html",            
            "class" => "",
            "heading" => __("Blockquote content", 'richer-framework'),
            "param_name" => "content",
            'admin_label' => true,
         ),
      )
   )
);
vc_map( array(
      "name" => __("Pullquote", 'richer-framework'),
      "base" => "pullquote",
      "icon" => get_template_directory_uri().'/vc_templates/images/pullquote.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays blockquote block', 'richer-framework'),
      "params" => array(
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Pullquote align", 'richer-framework'),
            "param_name" => "align",
            'admin_label' => true,
            "value" => array('left', 'right'),
            "std" => array('left')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Pullquote width", 'richer-framework'),
            "param_name" => "width",
            "value" => '270',
            'description' => __('Default width is 270px. Enter your size (e.g. 300)', 'richer-framework'),
         ),
         array(
            "type" => "textarea_html",            
            "class" => "",
            "heading" => __("Blockquote content", 'richer-framework'),
            "param_name" => "content",
         ),
      )
   )
);
vc_map( array(
      "name" => __("Comming soon", 'richer-framework'),
      "base" => "coming_soon",
      "icon" => get_template_directory_uri().'/vc_templates/images/coming_soon.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays countdown time to release', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Date release", 'richer-framework'),
            "param_name" => "date_release",
            'admin_label' => true,
            "value" =>'',
            'description' => __('Enter date release in format month/day/year e.g. 09/16/2014', 'richer-framework'),
         ),
      )
   )
);
vc_map( array(
      "name" => __("Instagram", 'richer-framework'),
      "base" => "instagram",
      "icon" => get_template_directory_uri().'/vc_templates/images/instagram.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Inserts your instagram items', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("User ID", 'richer-framework'),
            "param_name" => "userid",
            'admin_label' => true,
            "value" => '',
            "description" => __("Enter User ID. Use", "richer-framework").' <a target="_blank" href="http://jelled.com/instagram/lookup-user-id">http://jelled.com/instagram/lookup-user-id</a>'
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Access Token", 'richer-framework'),
            "param_name" => "access_token",
            "value" => '',
            "description" => __("Enter access token key. Use", "richer-framework").' <a target="_blank" href="http://jelled.com/instagram/access-token">http://jelled.com/instagram/access-token</a>'
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Items count", 'richer-framework'),
            "param_name" => "pics",
            "value" => "",
            "description" => __('Enter instagram items amount.','richer-framework')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Items per row", 'richer-framework'),
            "param_name" => "pics_per_row",
            "value" => array('3','2','4','6'),
            "description" => '',
            "std" => array('3')
         )
      )
   )
);
vc_map( array(
      "name" => __("Twitter", 'richer-framework'),
      "base" => "twitter",
      "icon" => get_template_directory_uri().'/vc_templates/images/twitter.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'description' => __('Displays twitter tweets', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Consumer key", 'richer-framework'),
            "param_name" => "consumerkey",
            'description' => __('Enter twitter application consumer key. If you have questions - ', 'richer-framework').'<a href="https://dev.twitter.com/apps">https://dev.twitter.com/apps</a>',
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Consumer secret", 'richer-framework'),
            "param_name" => "consumersecret",
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Access token", 'richer-framework'),
            "param_name" => "accesstoken",
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Access token secret", 'richer-framework'),
            "param_name" => "accesstokensecret",
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Your twitter account name", 'richer-framework'),
            "param_name" => "username",
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("How much tweets to show?", 'richer-framework'),
            "param_name" => "tweetstoshow",
         ),
      )
   ));
vc_map( array(
      "name" => __("Icons list", 'richer-framework'),
      "base" => "iconlist",
      "icon" => get_template_directory_uri().'/vc_templates/images/iconlist.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'admin_enqueue_js' => '',
      'admin_enqueue_css' => '',
      'description' => __('List items with icon + text', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textarea",            
            "class" => "",
            "heading" => __("List items (start each item on new line)", 'richer-framework'),
            "param_name" => "iconsets",
            'admin_label' => true,
            "value" => "fa-star-o|the most complete collection of shortcodes\nfa-stack-overflow|Many layout options for home pages\nfa-thumbs-o-up|Just the best shortcodes builder",
            "description" => __("Input your lists in the same way - e.g. icon_name|list_item_text ", "richer-framework")
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Choose icons color", 'richer-framework'),
            "param_name" => "iconcolor",
            "value" => '',
            "description" => __("Leave blank to use by theme defaults", "richer-framework")
         ),
         array(
            "type" => "colorpicker",            
            "class" => "",
            "heading" => __("Choose icons border color", 'richer-framework'),
            "param_name" => "iconbordercolor",
            "value" => '',
            "description" => __("Leave blank to use by theme defaults", "richer-framework")
         )
      )
   ));
vc_map( array(
      "name" => __("Contact map", 'richer-framework'),
      "base" => "map",
      "icon" => get_template_directory_uri().'/vc_templates/images/map.png',
      "class" => "",
      "category" => __('by ASW Shortcodes', 'richer-framework'),
      'admin_enqueue_js' => '',
      'admin_enqueue_css' => '',
      'description' => __('Displays you locations on the google map', 'richer-framework'),
      "params" => array(
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Address", 'richer-framework'),
            "param_name" => "address",
            'admin_label' => true,
            "value" => "",
            "description" => __("Enter your location address. You can use more than one addresses, separate them by '|'. Map will be centered by first address.", "richer-framework")
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Select map type", 'richer-framework'),
            "param_name" => "type",
            "value" => array('roadmap', 'satellite', 'hybrid', 'terrain'),
            "description" => "",
            "std" => array('roadmap')
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Width", 'richer-framework'),
            "param_name" => "width",
            "value" => '',
            "description" => __("Set width for your map in 'px' or '%'.", "richer-framework")
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Height", 'richer-framework'),
            "param_name" => "height",
            "value" => '',
            "description" => __("Set height for your map in 'px' or '%'.", "richer-framework")
         ),
         array(
            "type" => "textfield",            
            "class" => "",
            "heading" => __("Zoom", 'richer-framework'),
            "param_name" => "zoom",
            "value" => '',
            "description" => __("Zoom value from 1 to 19 where 19 is the largest and 1 the smallest.", "richer-framework")
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Scrollwheel", 'richer-framework'),
            "param_name" => "scrollwheel",
            "value" => $TrueFalse,
            "description" => __("Set to false to disable zooming with your mouses scrollwheel", "richer-framework"),
            "std" => array('true')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Scale control", 'richer-framework'),
            "param_name" => "scale",
            "value" => $TrueFalse,
            "description" => __("Set to false to disable scale control on the map.", "richer-framework"),
            "std" => array('true')
         ),
         array(
            "type" => "dropdown",            
            "class" => "",
            "heading" => __("Navigation control", 'richer-framework'),
            "param_name" => "zoom_pancontrol",
            "value" => $TrueFalse,
            "description" => __("Set to false to disable panning navigation control.", "richer-framework"),
            "std" => array('true')
         ),
      )
   ));
}
// parallax speed
vc_remove_param("vc_row","full_width");
vc_add_param("vc_row", array(
   "type" => "dropdown",
   "class" => "",
   "heading" => __("Row stretch",'asw-framework'),
   "param_name" => "full_width",
   "value" => array(
      __("Default",'asw-framework') => '',
      __("Stretch to full width.","asw-framework") => "stretch"
   ),
   "description" => __('Select stretching options for row and content','asw-framework'),
));
/*video-background*/
vc_add_param("vc_row", array(
   "type" => "attach_image",
   "class" => "",
   "group" => 'Video Background',
   "heading" => __("Poster",'asw-framework'),
   "param_name" => "poster",
   "value" => '',
   "description" => __('Defines image to show as placeholder before the media plays.','asw-framework'),
));
vc_add_param("vc_row", array(
   "type" => "textfield",
   "class" => "",
   "group" => 'Video Background',
   "heading" => __("mp4 source (url)",'asw-framework'),
   "param_name" => "mp4",
   "value" => '',
   "description" => __('The source of your video file. You can use this option to define specific filetypes.','asw-framework'),
));
vc_add_param("vc_row", array(
   "type" => "textfield",
   "class" => "",
   "group" => 'Video Background',
   "heading" => __("m4v source (url)",'asw-framework'),
   "param_name" => "m4v",
   "value" => '',
   "description" => __('The source of your video file. You can use this option to define specific filetypes.','asw-framework'),
));
vc_add_param("vc_row", array(
   "type" => "textfield",
   "class" => "",
   "group" => 'Video Background',
   "heading" => __("webm source (url)",'asw-framework'),
   "param_name" => "webm",
   "value" => '',
   "description" => __('The source of your video file. You can use this option to define specific filetypes.','asw-framework'),
));
vc_add_param("vc_row", array(
   "type" => "textfield",
   "class" => "",
   "group" => 'Video Background',
   "heading" => __("ogv source (url)",'asw-framework'),
   "param_name" => "ogv",
   "value" => '',
   "description" => __('The source of your video file. You can use this option to define specific filetypes.','asw-framework'),
));
vc_add_param("vc_row", array(
   "type" => "attach_image",
   "class" => "",
   "group" => 'Video Background',
   "heading" => __("Overlay",'asw-framework'),
   "param_name" => "overlay",
   "value" => '',
   "description" => __('You can specify overlay pattern on your video.','asw-framework'),
));

/* VC_ACORDION*/
vc_remove_param("vc_accordion",'title');
vc_remove_param("vc_accordion",'interval');
vc_remove_param("vc_accordion",'collapsible');

vc_add_param("vc_accordion", array(
   "type" => "dropdown",
   "class" => "",
   "heading" => __("Select predefined style",'richer-framework'),
   "param_name" => "style",
   "value" => array('style1', 'style2', 'style3', 'style4'),
   "description" => __('How it looks you can find on our live demo.','richer-framework'),
   "std" => array('style1')
));
vc_add_param("vc_accordion_tab", array(
   "type" => "textfield",
   "class" => "",
   "heading" => __("Icon name (optional)",'richer-framework'),
   "param_name" => "icon",
   "value" => '',
   "description" => __('To find icons - ', 'richer-framework').'<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">'.__('refer here', 'richer-framework').'</a>',
));

/* VC_TABS */
vc_remove_param("vc_tabs",'title');
vc_remove_param("vc_tabs",'interval');
vc_add_param("vc_tab", array(
   "type" => "textfield",
   "class" => "",
   "heading" => __("Icon name (optional)",'richer-framework'),
   "param_name" => "icon",
   "value" => '',
   "description" => __('To find icons - ', 'richer-framework').'<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">'.__('refer here', 'richer-framework').'</a>',
));
?>