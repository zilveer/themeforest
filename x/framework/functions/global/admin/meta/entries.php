<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/META/ENTRIES.PHP
// -----------------------------------------------------------------------------
// Registers the meta boxes for pages, posts, and portfolio items.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Pages
//   02. Posts
//   03. Portfolio Items
// =============================================================================

// Pages
// =============================================================================
 
function x_add_page_meta_boxes() {

  $meta_box = array(
    'id'          => 'x-meta-box-page',
    'title'       => __( 'Page Settings', '__x__' ),
    'description' => __( 'Here you will find various options you can use to create different page layouts and styles.', '__x__' ),
    'page'        => 'page',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'Body CSS Class(es)', '__x__' ),
        'desc' => __( 'Add a custom CSS class to the &lt;body&gt; element. Separate multiple class names with a space.', '__x__' ),
        'id'   => '_x_entry_body_css_class',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Alternate Index Title', '__x__' ),
        'desc' => __( 'Filling out this text input will replace the standard title on all index pages (i.e. blog, category archives, search, et cetera) with this one.', '__x__' ),
        'id'   => '_x_entry_alternate_index_title',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Disable Page Title', '__x__' ),
        'desc' => __( 'Select to disable the page title. Disabling the page title provides greater stylistic flexibility on individual pages.', '__x__' ),
        'id'   => '_x_entry_disable_page_title',
        'type' => 'checkbox',
        'std'  => ''
      ),
      array(
        'name' => __( 'One Page Navigation', '__x__' ),
        'desc' => __( 'To activate your one page navigation, select a menu from the dropdown. To deactivate one page navigation, set the dropdown back to "Deactivated."', '__x__' ),
        'id'   => '_x_page_one_page_navigation',
        'type' => 'menus',
        'std'  => 'Deactivated'
      ),
      array(
        'name' => __( 'Background Image(s)', '__x__' ),
        'desc' => __( 'Click the button to upload your background image(s), or enter them in manually using the text field above. Loading multiple background images will create a slideshow effect. To clear, delete the image URLs from the text field and save your page.', '__x__' ),
        'id'   => '_x_entry_bg_image_full',
        'type' => 'uploader',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s) Fade', '__x__' ),
        'desc' => __( 'Set a time in milliseconds for your image(s) to fade in. To disable this feature, set the value to "0."', '__x__' ),
        'id'   => '_x_entry_bg_image_full_fade',
        'type' => 'text',
        'std'  => '750'
      ),
      array(
        'name' => __( 'Background Images Duration', '__x__' ),
        'desc' => __( 'Only applicable if multiple images are selected, creating a background image slider. Set a time in milliseconds for your images to remain on screen.', '__x__' ),
        'id'   => '_x_entry_bg_image_full_duration',
        'type' => 'text',
        'std'  => '7500'
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Icon.
  //

  if ( x_get_stack() == 'icon' ) :

    $meta_box = array(
      'id'          => 'x-meta-box-page-icon',
      'title'       => __( 'Icon Page Settings', '__x__' ),
      'description' => __( 'Here you will find some options specific to Icon that you can use to create different page layouts.', '__x__' ),
      'page'        => 'page',
      'context'     => 'normal',
      'priority'    => 'high',
      'fields'      => array(
        array(
          'name'    => __( 'Blank Template Sidebar', '__x__' ),
          'desc'    => __( 'Because of Icon\'s unique layout, there may be times where you wish to show a sidebar on your blank templates. If that is the case, select "Yes" to activate your sidebar.', '__x__' ),
          'id'      => '_x_icon_blank_template_sidebar',
          'type'    => 'radio',
          'std'     => 'No',
          'options' => array( 'No', 'Yes' )
        )
      )
    );

    x_add_meta_box( $meta_box );

  endif;


  //
  // Sliders.
  //

  if ( X_REVOLUTION_SLIDER_IS_ACTIVE || X_LAYERSLIDER_IS_ACTIVE ) :

    $meta_box = array(
      'id'          => 'x-meta-box-slider-above',
      'title'       => __( 'Slider Settings: Above Masthead', '__x__' ),
      'description' => __( 'Select your options to display a slider above the masthead.', '__x__' ),
      'page'        => 'page',
      'context'     => 'normal',
      'priority'    => 'high',
      'fields'      => array(
        array(
          'name' => __( 'Slider', '__x__' ),
          'desc' => __( 'To activate your slider, select an option from the dropdown. To deactivate your slider, set the dropdown back to "Deactivated."', '__x__' ),
          'id'   => '_x_slider_above',
          'type' => 'sliders',
          'std'  => 'Deactivated'
        ),
        array(
          'name' => __( 'Optional Background Video', '__x__' ),
          'desc' => __( 'Include your video URL(s) here. If using multiple sources, separate them using the pipe character (|) and place fallbacks towards the end (i.e. .webm then .mp4 then .ogv).', '__x__' ),
          'id'   => '_x_slider_above_bg_video',
          'type' => 'text',
          'std'  => ''
        ),
        array(
          'name' => __( 'Video Poster Image (For Mobile)', '__x__' ),
          'desc' => __( 'Click the button to upload your video poster image to show on mobile devices, or enter it in manually using the text field above. Only select one image for this field. To clear, delete the image URL from the text field and save your page.', '__x__' ),
          'id'   => '_x_slider_above_bg_video_poster',
          'type' => 'uploader',
          'std'  => ''
        ),
        array(
          'name' => __( 'Enable Scroll Bottom Anchor', '__x__' ),
          'desc' => __( 'Select to enable the scroll bottom anchor for your slider.', '__x__' ),
          'id'   => '_x_slider_above_scroll_bottom_anchor_enable',
          'type' => 'checkbox',
          'std'  => ''
        ),
        array(
          'name'    => __( 'Scroll Bottom Anchor Alignment', '__x__' ),
          'desc'    => __( 'Select the alignment of the scroll bottom anchor for your slider.', '__x__' ),
          'id'      => '_x_slider_above_scroll_bottom_anchor_alignment',
          'type'    => 'select',
          'std'     => 'top left',
          'options' => array( 'top left', 'top center', 'top right', 'bottom left', 'bottom center', 'bottom right' )
        ),
        array(
          'name' => __( 'Scroll Bottom Anchor Color', '__x__' ),
          'desc' => __( 'Select the color of the scroll bottom anchor for your slider.', '__x__' ),
          'id'   => '_x_slider_above_scroll_bottom_anchor_color',
          'type' => 'color',
          'std'  => '#ffffff'
        ),
        array(
          'name' => __( 'Scroll Bottom Anchor Color Hover', '__x__' ),
          'desc' => __( 'Select the hover color of the scroll bottom anchor for your slider.', '__x__' ),
          'id'   => '_x_slider_above_scroll_bottom_anchor_color_hover',
          'type' => 'color',
          'std'  => '#ffffff'
        )
      )
    );

    x_add_meta_box( $meta_box );


    $meta_box = array(
      'id'          => 'x-meta-box-slider-below',
      'title'       => __( 'Slider Settings: Below Masthead', '__x__' ),
      'description' => __( 'Select your options to display a slider below the masthead.', '__x__' ),
      'page'        => 'page',
      'context'     => 'normal',
      'priority'    => 'high',
      'fields'      => array(
        array(
          'name' => __( 'Slider', '__x__' ),
          'desc' => __( 'To activate your slider, select an option from the dropdown. To deactivate your slider, set the dropdown back to "Deactivated."', '__x__' ),
          'id'   => '_x_slider_below',
          'type' => 'sliders',
          'std'  => 'Deactivated'
        ),
        array(
          'name' => __( 'Optional Background Video', '__x__' ),
          'desc' => __( 'Include your video URL(s) here. If using multiple sources, separate them using the pipe character (|) and place fallbacks towards the end (i.e. .webm then .mp4 then .ogv).', '__x__' ),
          'id'   => '_x_slider_below_bg_video',
          'type' => 'text',
          'std'  => ''
        ),
        array(
          'name' => __( 'Video Poster Image (For Mobile)', '__x__' ),
          'desc' => __( 'Click the button to upload your video poster image to show on mobile devices, or enter it in manually using the text field above. Only select one image for this field. To clear, delete the image URL from the text field and save your page.', '__x__' ),
          'id'   => '_x_slider_below_bg_video_poster',
          'type' => 'uploader',
          'std'  => ''
        ),
        array(
          'name' => __( 'Enable Scroll Bottom Anchor', '__x__' ),
          'desc' => __( 'Select to enable the scroll bottom anchor for your slider.', '__x__' ),
          'id'   => '_x_slider_below_scroll_bottom_anchor_enable',
          'type' => 'checkbox',
          'std'  => ''
        ),
        array(
          'name'    => __( 'Scroll Bottom Anchor Alignment', '__x__' ),
          'desc'    => __( 'Select the alignment of the scroll bottom anchor for your slider.', '__x__' ),
          'id'      => '_x_slider_below_scroll_bottom_anchor_alignment',
          'type'    => 'select',
          'std'     => 'top left',
          'options' => array( 'top left', 'top center', 'top right', 'bottom left', 'bottom center', 'bottom right' )
        ),
        array(
          'name' => __( 'Scroll Bottom Anchor Color', '__x__' ),
          'desc' => __( 'Select the color of the scroll bottom anchor for your slider.', '__x__' ),
          'id'   => '_x_slider_below_scroll_bottom_anchor_color',
          'type' => 'color',
          'std'  => '#ffffff'
        ),
        array(
          'name' => __( 'Scroll Bottom Anchor Color Hover', '__x__' ),
          'desc' => __( 'Select the hover color of the scroll bottom anchor for your slider.', '__x__' ),
          'id'   => '_x_slider_below_scroll_bottom_anchor_color_hover',
          'type' => 'color',
          'std'  => '#ffffff'
        )
      )
    );

    x_add_meta_box( $meta_box );

  endif;


  //
  // Portfolio page template.
  //

  $meta_box = array(
    'id'          => 'x-meta-box-portfolio',
    'title'       => __( 'Portfolio Settings', '__x__' ),
    'description' => __( 'Here you will find various options you can use to setup your portfolio.', '__x__' ),
    'page'        => 'page',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'Category Select', '__x__' ),
        'desc' => __( 'To select multiple nonconsecutive pages or posts, hold down "CTRL" (Windows) or "COMMAND" (Mac), and then click each item you want to select. To cancel the selection of individual items, hold down "CTRL" or "COMMAND", and then click the items that you don\'t want to include.', '__x__' ),
        'id'   => '_x_portfolio_category_filters',
        'type' => 'select-portfolio-category',
        'std'  => 'All Categories'
      ),
      array(
        'name'    => __( 'Columns', '__x__' ),
        'desc'    => __( 'Select how many columns you would like to display for your portfolio.', '__x__' ),
        'id'      => '_x_portfolio_columns',
        'type'    => 'radio',
        'std'     => 'Two',
        'options' => array( 'One', 'Two', 'Three', 'Four' )
      ),
      array(
        'name'    => __( 'Layout', '__x__' ),
        'desc'    => __( 'Select the layout you would like to display for your portfolio. The "Use Global Content Layout" option allows you to keep your sidebar if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for your "Content Layout" in the Customizer.', '__x__' ),
        'id'      => '_x_portfolio_layout',
        'type'    => 'radio-portfolio-layout',
        'std'     => 'full-width',
        'options' => array( 'sidebar' => 'Use Global Content Layout', 'full-width' => 'Fullwidth' )
      ),
      array(
        'name' => __( 'Posts Per Page', '__x__' ),
        'desc' => __( 'Select how many posts you would like to display per page for your portfolio.', '__x__' ),
        'id'   => '_x_portfolio_posts_per_page',
        'type' => 'text',
        'std'  => '24'
      ),
      array(
        'name' => __( 'Disable Filtering', '__x__' ),
        'desc' => __( 'Turning off the portfolio filters will remove the ability to sort portfolio items by category.', '__x__' ),
        'id'   => '_x_portfolio_disable_filtering',
        'type' => 'checkbox',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );

}

add_action( 'add_meta_boxes', 'x_add_page_meta_boxes' );



// Posts
// =============================================================================
 
function x_add_post_meta_boxes() {

  $meta_box = array(
    'id'          => 'x-meta-box-post',
    'title'       => __( 'Post Settings', '__x__' ),
    'description' => __( 'Here you will find various options you can use to create different page styles.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'Body CSS Class(es)', '__x__' ),
        'desc' => __( 'Add a custom CSS class to the &lt;body&gt; element. Separate multiple class names with a space.', '__x__' ),
        'id'   => '_x_entry_body_css_class',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Fullwidth Post Layout', '__x__' ),
        'desc' => __( 'If your global content layout includes a sidebar, selecting this option will remove the sidebar for this post.', '__x__' ),
        'id'   => '_x_post_layout',
        'type' => 'checkbox',
        'std'  => ''
      ),
      array(
        'name' => __( 'Alternate Index Title', '__x__' ),
        'desc' => __( 'Filling out this text input will replace the standard title on all index pages (i.e. blog, category archives, search, et cetera) with this one.', '__x__' ),
        'id'   => '_x_entry_alternate_index_title',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s)', '__x__' ),
        'desc' => __( 'Click the button to upload your background image(s), or enter them in manually using the text field above. Loading multiple background images will create a slideshow effect. To clear, delete the image URLs from the text field and save your page.', '__x__' ),
        'id'   => '_x_entry_bg_image_full',
        'type' => 'uploader',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s) Fade', '__x__' ),
        'desc' => __( 'Set a time in milliseconds for your image(s) to fade in. To disable this feature, set the value to "0."', '__x__' ),
        'id'   => '_x_entry_bg_image_full_fade',
        'type' => 'text',
        'std'  => '750'
      ),
      array(
        'name' => __( 'Background Images Duration', '__x__' ),
        'desc' => __( 'Only applicable if multiple images are selected, creating a background image slider. Set a time in milliseconds for your images to remain on screen.', '__x__' ),
        'id'   => '_x_entry_bg_image_full_duration',
        'type' => 'text',
        'std'  => '7500'
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Quote.
  //

  $meta_box = array(
    'id'          => 'x-meta-box-quote',
    'title'       => __( 'Quote Post Settings', '__x__' ),
    'description' => __( 'Input your quote.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'The Quote', '__x__' ),
        'desc' => __( 'Input your quote.', '__x__' ),
        'id'   => '_x_quote_quote',
        'type' => 'textarea',
        'std'  => ''
      ),
      array(
        'name' => __( 'Citation', '__x__' ),
        'desc' => __( 'Specify who originally said the quote.', '__x__' ),
        'id'   => '_x_quote_cite',
        'type' => 'text',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Link.
  //

  $meta_box = array(
    'id'          => 'x-meta-box-link',
    'title'       => __( 'Link Post Settings', '__x__' ),
    'description' => __( 'Input your link.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'The Link', '__x__' ),
        'desc' => __( 'Insert your link URL, e.g. http://www.themeforest.net.', '__x__' ),
        'id'   => '_x_link_url',
        'type' => 'text',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Video.
  //

  $meta_box = array(
    'id'          => 'x-meta-box-video',
    'title'       => __( 'Video Post Settings', '__x__' ),
    'description' => __( 'These settings enable you to embed videos into your posts.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name'    => __( 'Aspect Ratio', '__x__' ),
        'desc'    => __( 'Select the aspect ratio for your video.', '__x__' ),
        'id'      => '_x_video_aspect_ratio',
        'type'    => 'select',
        'std'     => '',
        'options' => array( '16:9', '5:3', '5:4', '4:3', '3:2' )
      ),
      array(
        'name' => __( 'M4V File URL', '__x__' ),
        'desc' => __( 'The URL to the .m4v video file.', '__x__' ),
        'id'   => '_x_video_m4v',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'OGV File URL', '__x__' ),
        'desc' => __( 'The URL to the .ogv video file.', '__x__' ),
        'id'   => '_x_video_ogv',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Embedded Video Code', '__x__' ),
        'desc' => __( 'If you are using something other than self hosted video such as YouTube, Vimeo, or Wistia, paste the embed code here. This field will override the above.', '__x__' ),
        'id'   => '_x_video_embed',
        'type' => 'textarea',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Audio.
  //

  $meta_box = array(
    'id'          => 'x-meta-box-audio',
    'title'       => __( 'Audio Post Settings', '__x__' ),
    'description' => __( 'These settings enable you to embed audio into your posts.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'MP3 File URL', '__x__' ),
        'desc' => __( 'The URL to the .mp3 audio file.', '__x__' ),
        'id'   => '_x_audio_mp3',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'OGA File URL', '__x__' ),
        'desc' => __( 'The URL to the .oga or .ogg audio file.', '__x__' ),
        'id'   => '_x_audio_ogg',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Embedded Audio Code', '__x__' ),
        'desc' => __( 'If you are using something other than self hosted audio such as Soundcloud paste the embed code here. This field will override the above.', '__x__' ),
        'id'   => '_x_audio_embed',
        'type' => 'textarea',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Ethos.
  //

  if ( x_get_stack() == 'ethos' ) :

    $meta_box = array(
      'id'          => 'x-meta-box-post-ethos',
      'title'       => __( 'Ethos Post Settings', '__x__' ),
      'description' => __( 'Here you will find some options specific to Ethos that you can use to create different post layouts.', '__x__' ),
      'page'        => 'post',
      'context'     => 'normal',
      'priority'    => 'high',
      'fields'      => array(
        array(
          'name' => __( 'Index Featured Post Layout', '__x__' ),
          'desc' => __( 'Make the featured image of this post fullwidth on the blog index page.', '__x__' ),
          'id'   => '_x_ethos_index_featured_post_layout',
          'type' => 'checkbox',
          'std'  => ''
        ),
        array(
          'name'    => __( 'Index Featured Post Size', '__x__' ),
          'desc'    => __( 'If the "Index Featured Post Layout" option above is selected, select a size for the output.', '__x__' ),
          'id'      => '_x_ethos_index_featured_post_size',
          'type'    => 'radio',
          'std'     => 'Skinny',
          'options' => array( 'Big', 'Skinny' )
        ),
        array(
          'name' => __( 'Post Carousel Display', '__x__' ),
          'desc' => __( 'Display this post in the Post Carousel if you have "Featured" selected in the Customizer.', '__x__' ),
          'id'   => '_x_ethos_post_carousel_display',
          'type' => 'checkbox',
          'std'  => '',
        ),
        array(
          'name' => __( 'Post Slider Display &ndash; Blog', '__x__' ),
          'desc' => __( 'Display this post in the Blog Post Slider if you have "Featured" selected in the Customizer.', '__x__' ),
          'id'   => '_x_ethos_post_slider_blog_display',
          'type' => 'checkbox',
          'std'  => '',
        ),
        array(
          'name' => __( 'Post Slider Display &ndash; Archives', '__x__' ),
          'desc' => __( 'Display this post in the Archives Post Slider if you have "Featured" selected in the Customizer.', '__x__' ),
          'id'   => '_x_ethos_post_slider_archives_display',
          'type' => 'checkbox',
          'std'  => '',
        )
      )
    );

    x_add_meta_box( $meta_box );

  endif;

}

add_action( 'add_meta_boxes', 'x_add_post_meta_boxes' );



// Portfolio Items
// =============================================================================
 
function x_add_portfolio_item_meta_boxes() {

  $meta_box = array(
    'id'          => 'x-meta-box-portfolio-item',
    'title'       => __( 'Portfolio Item Settings', '__x__' ),
    'description' => __( 'Select the appropriate options for your portfolio item.', '__x__' ),
    'page'        => 'x-portfolio',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'Body CSS Class(es)', '__x__' ),
        'desc' => __( 'Add a custom CSS class to the &lt;body&gt; element. Separate multiple class names with a space.', '__x__' ),
        'id'   => '_x_entry_body_css_class',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Alternate Index Title', '__x__' ),
        'desc' => __( 'Filling out this text input will replace the standard title on all index pages (i.e. blog, category archives, search, et cetera) with this one.', '__x__' ),
        'id'   => '_x_entry_alternate_index_title',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Portfolio Parent', '__x__' ),
        'desc' => __( 'Assign the parent portfolio page for this portfolio item. This will be used in various places throughout the theme such as your breadcrumbs. If "Default" is selected then the first page with the "Layout - Portfolio" template assigned to it will be used.', '__x__' ),
        'id'   => '_x_portfolio_parent',
        'type' => 'select-portfolio-parent',
        'std'  => 'Default'
      ),
      array(
        'name'    => __( 'Media Type', '__x__' ),
        'desc'    => __( 'Select which kind of media you want to display for your portfolio. If selecting a "Gallery," simply upload your images to this post and organize them in the order you want them to display.', '__x__' ),
        'id'      => '_x_portfolio_media',
        'type'    => 'radio',
        'std'     => 'Image',
        'options' => array( 'Image', 'Gallery', 'Video' )
      ),
      array(
        'name'    => __( 'Featured Content', '__x__' ),
        'desc'    => __( 'Select "Media" if you would like to show your video or gallery on the index page in place of the featured image.', '__x__' ),
        'id'      => '_x_portfolio_index_media',
        'type'    => 'radio',
        'std'     => 'Thumbnail',
        'options' => array( 'Thumbnail', 'Media' )
      ),
      array(
        'name' => __( 'Project Link', '__x__' ),
        'desc' => __( 'Provide an external link to the project you worked on if one is available.', '__x__' ),
        'id'   => '_x_portfolio_project_link',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s)', '__x__' ),
        'desc' => __( 'Click the button to upload your background image(s), or enter them in manually using the text field above. Loading multiple background images will create a slideshow effect. To clear, delete the image URLs from the text field and save your page.', '__x__' ),
        'id'   => '_x_entry_bg_image_full',
        'type' => 'uploader',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s) Fade', '__x__' ),
        'desc' => __( 'Set a time in milliseconds for your image(s) to fade in. To disable this feature, set the value to "0."', '__x__' ),
        'id'   => '_x_entry_bg_image_full_fade',
        'type' => 'text',
        'std'  => '750'
      ),
      array(
        'name' => __( 'Background Images Duration', '__x__' ),
        'desc' => __( 'Only applicable if multiple images are selected, creating a background image slider. Set a time in milliseconds for your images to remain on screen.', '__x__' ),
        'id'   => '_x_entry_bg_image_full_duration',
        'type' => 'text',
        'std'  => '7500'
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Video.
  //

  $meta_box = array(
    'id'          => 'x-meta-box-portfolio-item-video',
    'title'       => __( 'Video Portfolio Item Settings', '__x__' ),
    'description' => __( 'These settings enable you to embed videos into your portfolio items.', '__x__' ),
    'page'        => 'x-portfolio',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name'    => __( 'Video Aspect Ratio', '__x__' ),
        'desc'    => __( 'If selecting "Video," choose the aspect ratio you would like for your video.', '__x__' ),
        'id'      => '_x_portfolio_aspect_ratio',
        'type'    => 'select',
        'std'     => '16:9',
        'options' => array( '16:9', '5:3', '5:4', '4:3', '3:2' )
      ),
      array(
        'name' => __( 'M4V File URL', '__x__' ),
        'desc' => __( 'If selecting "Video," place the URL to your .m4v video file here.', '__x__' ),
        'id'   => '_x_portfolio_m4v',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'OGV File URL', '__x__' ),
        'desc' => __( 'If selecting "Video," place the URL to your .ogv video file here.', '__x__' ),
        'id'   => '_x_portfolio_ogv',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Embedded Video Code', '__x__' ),
        'desc' => __( 'If you are using something other than self hosted video such as YouTube, Vimeo, or Wistia, paste the embed code here. This field will override the above.', '__x__' ),
        'id'   => '_x_portfolio_embed',
        'type' => 'textarea',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );

}

add_action( 'add_meta_boxes', 'x_add_portfolio_item_meta_boxes' );