<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'welcomebuddy',
          'title'     => 'Welcome!',
          'content'   => 'Welcome to the Theme Options page! From this panel, you&#039;ll be able to select the custom options that will make this theme your own. If you run into any questions, don&#039;t forget to check out the <a href="http://youtube.com/makedesignnotwar" target="_blank">Videos Library</a>, the <a href="http://makedesign.staging.wpengine.com/update-logs/superskeleton/index.html" target="_blank">Updates Log</a>, or the <a href="http://makedesign.staging.wpengine.com/reactor/general_support/Support_Guide.html" target="_blank">General Support Guide</a>. Have Fun!'
        )
      ),
      'sidebar'       => 'Welcome to the Theme Options page! From this panel, you&#039;ll be able to select the custom options that will make this theme your own. If you run into any questions, don&#039;t forget to check out the <a href="http://youtube.com/makedesignnotwar" target="_blank">Videos Library</a>, the <a href="http://makedesign.staging.wpengine.com/update-logs/superskeleton/index.html" target="_blank">Updates Log</a>, or the <a href="http://makedesign.staging.wpengine.com/reactor/general_support/Support_Guide.html" target="_blank">General Support Guide</a>. Have Fun!'
    ),
    'sections'        => array( 
      array(
        'id'          => 'general_default',
        'title'       => 'Basic Setup'
      ),
      array(
        'id'          => 'skinning_options',
        'title'       => 'Theme Skin'
      ),
      array(
        'id'          => 'styling',
        'title'       => 'Typography '
      ),
      array(
        'id'          => 'image_settings',
        'title'       => 'Image Behavior'
      ),
      array(
        'id'          => 'header',
        'title'       => 'Top Hat'
      ),
      array(
        'id'          => 'frontpage',
        'title'       => 'Front Page'
      ),
      array(
        'id'          => 'skeleton_slider',
        'title'       => 'Front Page Slider'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social'
      ),
      array(
        'id'          => 'breakout',
        'title'       => 'Blog Row'
      ),
      array(
        'id'          => 'footer',
        'title'       => 'Footer'
      ),
      array(
        'id'          => 'documentation',
        'title'       => 'Theme Extras'
      ),
    ),
    'settings'        => array( 
      array(
        'id'          => 'welcome',
        'label'       => 'Welcome!',
        'desc'        => 'Welcome to the Theme Options panel! From this panel, you\'ll be able to select the custom options that will make this theme your own. If you run into any questions, don\'t forget to check out the <a href="http://youtube.com/makedesignnotwar" target="_blank">Videos Library</a>, the <a href="http://makedesign.staging.wpengine.com/update-logs/superskeleton/index.html" target="_blank">Updates Log</a>, or the <a href="http://makedesign.staging.wpengine.com/reactor/general_support/Support_Guide.html" target="_blank">General Support Guide</a>. Have Fun!',
        'type'        => 'textblock-titled',
        'section'     => 'general_default',
        'class'       => 'welcometext'
      ),
      array(
        'id'          => 'logo',
        'label'       => 'Upload Your Logo',
        'desc'        => 'Upload your logo image (JPG, GIF, PNG). Keep in mind that this won\'t scale, so you may need to resize it to fit the template. Default size is 260 x 60px.',
        'type'        => 'upload',
        'section'     => 'general_default',
      ),
      array(
        'id'          => 'favicon',
        'label'       => 'Upload Your Browser Icon',
        'desc'        => 'Upload the 16x16px image (GIF) that you\'d like to show up in the browser address bar.',
        'type'        => 'upload',
        'section'     => 'general_default',
      ),
      array(
      'id'          => 'options_skin',
      'label'       => 'Options Panel Skin',
      'desc'        => 'Turn this ON and press the Save Changes button to activate the custom theme styling for the admin panel. If you encounter styling or layout issues with the options-panel, you can turn this off to use default styling.',
      'std'         => 'off',
      'type'        => 'on_off',
      'section'     => 'general_default',
      ),
      array(
      'id'          => 'notes_1',
      'label'       => 'Theme Skin Options',
      'desc'        => 'Pick the default starter skin that you want to use. Note: You can change the CSS for any of these from inside the /assets/stylesheets/skin-xxxx.css files. You can also manually enter your own custom CSS rules below.',
      'type'        => 'textblock-titled',
      'section'     => 'skinning_options',
      ),
      array(
        'id'          => 'default_skin',
        'label'       => 'Default Skin',
        'desc'        => 'Pick the default starter skin that you want to use. Note: You can change the CSS for any of these from inside the /assets/stylesheets/skin-xxxx.css files. You can also manually enter your own custom CSS rules below.',
        'type'        => 'select',
        'section'     => 'skinning_options',
        'choices'     => array( 
          array(
            'value'       => 'Classic',
            'label'       => 'Classic',
            'src'         => ''
          ),
          array(
            'value'       => 'Clean',
            'label'       => 'Clean',
            'src'         => ''
          ),
          array(
            'value'       => 'Dark',
            'label'       => 'Dark',
            'src'         => ''
          )
        ),
      ),     
      array(
        'id'          => 'pagination',
        'label'       => 'Select The Pagination Style',
        'desc'        => 'Select whether you want to use the simple "Next/Previous" pagination style when there are too many posts on a page, or the new "Numbered" style.',
        'type'        => 'radio',
        'section'     => 'skinning_options',
        'choices'     => array( 
          array(
            'value'       => 'Numbered',
            'label'       => 'Numbered',
            'src'         => ''
          ),
          array(
            'value'       => 'NextPrev',
            'label'       => 'Next/Previous',
            'src'         => ''
          )
        ),
      ), 
      array(
        'id'          => 'tophat_background_image',
        'label'       => 'Top Hat Background Image',
        'desc'        => 'Upload a tile-able image that you\'d like to use for the "tophat" background texture. <br /><br />
Note: This (and the other BG options for the tophat, footer and sub-footer) are irrelevant in the "Boxed" skin version as it uses transparent backgrounds.',
        'type'        => 'upload',
        'section'     => 'skinning_options',
      ),
      array(
        'id'          => 'tophat_background_color',
        'label'       => 'Top Hat Background Color',
        'desc'        => 'Select a color that you\'d like to use for the tophat\'s background (in case you\'re using a transparent image or no image for the previous field).',
        'type'        => 'colorpicker',
        'section'     => 'skinning_options',
      ),
      array(
        'id'          => 'default_bg',
        'label'       => 'Body Background Image',
        'desc'        => 'Optional: Upload an image that you\'d like to use as the default background. This will be centered at the top and repeated along the X and Y axis, so it can either be a pattern or a large graphic. Note: You can override this image using the "custom field" for background images inside posts and pages.',
        'type'        => 'upload',
        'section'     => 'skinning_options',
      ),
      array(
        'id'          => 'footer_background_image',
        'label'       => 'Footer Background Image',
        'desc'        => 'Upload a tile-able image that you\'d like to use for the "footer" background texture.',
        'type'        => 'upload',
        'section'     => 'skinning_options',
      ),
      array(
        'id'          => 'footer_background_color',
        'label'       => 'Footer Background Color',
        'desc'        => 'Select a color that you\'d like to use for the footer\'s background (in case you\'re using a transparent image or no image for the previous field).',
        'type'        => 'colorpicker',
        'section'     => 'skinning_options',
      ),
      array(
        'id'          => 'subfooter_background_image',
        'label'       => 'Sub-Footer Background Image',
        'desc'        => 'Upload a tile-able image that you\'d like to use for the "sub-footer" background texture.',
        'type'        => 'upload',
        'section'     => 'skinning_options',
      ),
      array(
        'id'          => 'subfooter_background_color',
        'label'       => 'Sub-Footer Background Color',
        'desc'        => 'Select a color that you\'d like to use for the sub-footer\'s background (in case you\'re using a transparent image or no image for the previous field).',
        'type'        => 'colorpicker',
        'section'     => 'skinning_options',
      ),
      array(
        'id'          => 'customcss',
        'label'       => 'Custom CSS',
        'desc'        => 'You can enter custom style rules into this box if you\'d like. IE: <i>a{color: red !important;}</i><br />
					This is an advanced option! This is not recommended for users not fluent in CSS... but if you do know CSS, anything you add here will override the default styles.',
        'type'        => 'textarea-simple',
        'section'     => 'skinning_options',
        'rows'        => '10',
      ),
      array(
      'id'          => 'notes_2',
      'label'       => 'Theme Typography',
      'desc'        => 'Select the default font stack that you\'d like used on the site.',
      'type'        => 'textblock-titled',
      'section'     => 'styling',
      ),
      array(
        'id'          => 'default_fontstack',
        'label'       => 'Default Fontstack',
        'desc'        => 'Select the default font stack that you\'d like used on the site.',
        'type'        => 'radio',
        'section'     => 'styling',
        'choices'     => array( 
          array(
            'value'       => 'Sans-Serif',
            'label'       => 'Sans-Serif',
            'src'         => ''
          ),
          array(
            'value'       => 'Serif',
            'label'       => 'Serif',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'alt_fontreplace',
        'label'       => 'Font Replacement Embed Script',
        'desc'        => 'Have your own font-replacement "embed code" already from a service like TypeKit? Go ahead and enter it right here. NOTE: This will disable all other font replacement if there\'s anything at all entered into this field. This is an experimental tool at the moment, so if it doesn\'t work perfectly with your own font service, you\'ll have to use the default options above or insert yours via the header.php file.',
        'type'        => 'textarea-simple',
        'section'     => 'styling',
        'rows'        => '12',
      ),
      array(
        'id'          => 'tags_color',
        'label'       => 'Tags Color',
        'desc'        => 'Select which color you\'d like to be used for the tags "button" effect. You can always override this with basic css - check the "buttons.css" file for the styling code.',
        'type'        => 'select',
        'section'     => 'styling',
        'choices'     => array( 
          array(
            'value'       => 'yellow',
            'label'       => 'yellow',
            'src'         => ''
          ),
          array(
            'value'       => 'red',
            'label'       => 'red',
            'src'         => ''
          ),
          array(
            'value'       => 'purple',
            'label'       => 'purple',
            'src'         => ''
          ),
          array(
            'value'       => 'blue',
            'label'       => 'blue',
            'src'         => ''
          ),
          array(
            'value'       => 'green',
            'label'       => 'green',
            'src'         => ''
          ),
          array(
            'value'       => 'black',
            'label'       => 'black',
            'src'         => ''
          ),
          array(
            'value'       => 'gray',
            'label'       => 'gray',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'link_color',
        'label'       => 'Link Color',
        'desc'        => 'Pick the color that you\'d like all links to appear as by default.',
        'type'        => 'colorpicker',
        'section'     => 'styling',
      ),
      array(
        'id'          => 'link_hover_color',
        'label'       => 'Link Hover Color',
        'desc'        => 'Select the color that you\'d like your links to appear as when hovered over by a mouse.',
        'type'        => 'colorpicker',
        'section'     => 'styling',
      ),
      array(
        'id'          => 'link_visited_color',
        'label'       => 'Link Visited Color',
        'desc'        => 'Select the color that you\'d like links to appear as AFTER a user has visited them. Likely a slight variation of the default link color.',
        'type'        => 'colorpicker',
        'section'     => 'styling',
      ),

      array(
      'id'          => 'notes_2',
      'label'       => 'Image Behavior',
      'desc'        => 'Image behavior settings for the theme.',
      'type'        => 'textblock-titled',
      'section'     => 'image_settings',
      ),
      array(
        'id'          => 'open_as_lightbox',
        'label'       => 'Open Thumbnails Inside a Lightbox?',
        'desc'        => 'Selecting "Yes" will make thumbnails across the theme open the fullsize featured-image inside a lightbox. For homepage blurb images, this means the image URL. For blog posts, this can also be your "lightbox link" custom field (which can be a video URL!). /// Selecting "No" will make the thumbnails all link to their full post (inside a normal post template), or in the case of the homepage blurb images, link to their destination URL.',
        'section'     => 'image_settings',
        'type' => 'on_off',         
        'std' => 'off',
      ),
      array(
        'id'          => 'show_featured_image',
        'label'       => 'Auto-Insert Full Post Images?',
        'desc'        => 'Sometimes it\'s a hassle to manually insert an image at the top of each blog post or page... this option allows you to simply set the "Featured Image" and the theme will add that image to the top of your blog posts, everytime. It\'s also fully responsive, so you won\'t need to worry about sizing so long as your featured image is above roughly 640px wide.',
        'section'     => 'image_settings',
        'type' => 'on_off',         
        'std' => 'off',
      ),
       array(
        'id'          => 'default_image_height',
        'label'       => 'Thumbnail Height Cropping',
        'desc'        => '<strong>For Portfolio/Hybrid Blog templates</strong> - enter a value (ie: "400" or "500") if you\'d like to crop the height of the thumbnails to create a uniform grid. <br /><br /><strong>Note:</strong> The maximum image width will always be defined by the layout, which in most cases is 740px. So, your actual image size will be 700x[YOUR_HEIGHT]. If you leave this option blank, the original aspect ratio of your image will be used (tall images will be tall, short images will be short).',
        'std'         => '500',
        'type'        => 'text',
        'section'     => 'image_settings',
        'rows'        => '1',
      ),

       array(
      'id'          => 'notes_3',
      'label'       => 'Top Hat',
      'desc'        => 'Top-hat settings for the theme.',
      'type'        => 'textblock-titled',
      'section'     => 'header',
      ),
      array(
        'id'          => 'top_hat',
        'label'       => 'Show Top Hat?',
        'desc'        => 'Turn the top hat row on and off.',
        'section'     => 'header',
        'type' => 'on_off',         
        'std' => 'off',
      ),
      array(
        'id'          => 'email_subscribe',
        'label'       => 'Email Subscription Link',
        'desc'        => 'If you have a Feedburner Email Subscription URL (or any other email subscription link), enter it here.',
        'type'        => 'text',
        'section'     => 'header',
      ),
      array(
        'id'          => 'top_hat_blurb',
        'label'       => 'Top Hat Right-side Blurb',
        'desc'        => 'Enter some text that you\'d like used for the top-hat\'s right-side blurb.',
        'type'        => 'textarea-simple',
        'section'     => 'header',
        'rows'        => '5',
      ),
      array(
        'id'          => 'header_promo',
        'label'       => 'Header Promotional Space',
        'desc'        => 'Upload an image (468x60px) that you\'d like to use for the header "promotional space". Perfect for advertisements, or for promoting your own personal projects or pages. If you leave this blank, the space will be blank as well.',
        'type'        => 'upload',
        'section'     => 'header',
      ),
      array(
        'id'          => 'header_promo_url',
        'label'       => 'Header Promotional Space URL',
        'desc'        => 'If you\'ve uploaded an image for the promo space, you can also enter a destination URL here for where you\'d like the image to link to. ie: http://yourwebsite.com',
        'type'        => 'text',
        'section'     => 'header',
      ),
      array(
        'id'          => 'logo_center',
        'label'       => 'Center the Logo? (removes promo-space at the same time)',
        'desc'        => 'This will override the header-promo space by removing that ad-space altogether and auto-centering your logo across the header.',
        'type'        => 'radio',
        'section'     => 'header',
        'type' => 'on_off',         
        'std' => 'off',
      ),

      array(
      'id'          => 'notes_4',
      'label'       => 'Front Page',
      'desc'        => 'Image behavior settings for the theme.',
      'type'        => 'textblock-titled',
      'section'     => 'frontpage',
      ),
      array(
        'id'          => 'frontpage_slider',
        'label'       => 'Show Front-Page Slider?',
        'desc'        => 'Show the homepage slider? Selecting "No" will hide it, even if you have slides set below.',
        'section'     => 'frontpage',
        'type' => 'on_off',         
        'std' => 'off',
      ),

      array(
        'id'          => 'frontpage_featurerow',
        'label'       => 'Display the FrontPage Feature Row?',
        'desc'        => 'Selecting "Yes" will show the feature-row, which consists of a line of big text and an optional "action" button. Perfect if you\'ve got something to say! Options below...',
        'section'     => 'frontpage',
        'type' => 'on_off',         
        'std' => 'off',
      ),
      array(
        'id'          => 'frontpage_featurerow_text',
        'label'       => 'Feature Row Text',
        'desc'        => 'The text that\'ll go inside your feature row if you have it turned on.',
        'type'        => 'textarea-simple',
        'section'     => 'frontpage',
        'rows'        => '5',
      ),
      array(
        'id'          => 'frontpage_featurerow_url',
        'label'       => 'Feature Row Button URL',
        'desc'        => 'Insert a URL that you\'d like the button to link to. No URL = no button (and the text will center itself as a result).',
        'type'        => 'text',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'frontpage_featurerow_buttontext',
        'label'       => 'Feature Row Button Text',
        'desc'        => 'The text that\'ll actually show up inside the button.',
        'type'        => 'text',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'frontpage_blurbrow',
        'label'       => 'Show Front-Page Blurb Row?',
        'desc'        => 'Selecting "Yes" will enable the front-page "Blurb" row, which consists of three columns (image, title, text and a URL). Options for this section are below.',
        'type'        => 'radio',
        'section'     => 'frontpage',
        'type' => 'on_off',         
        'std' => 'off',
      ),
      array(
        'id'          => 'blurb_lightbox',
        'label'       => 'Open Blurb URLs in a Lightbox?',
        'desc'        => 'Select Yes to open the "Blurb URL" inside a lightbox (best for videos and images). Select No to open the "Blurb URL" as a normal link (best for WP pages and external links).',
        'type'        => 'radio',
        'section'     => 'frontpage',
        'type' => 'on_off',         
        'std' => 'off',
      ),
      array(
        'id'          => 'homepage_blurb_1_title',
        'label'       => 'Blurb 1: Title',
        'desc'        => 'Enter the title for the first homepage blurb.',
        'type'        => 'text',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_1_image',
        'label'       => 'Blurb 1: Image',
        'desc'        => 'Enter the image that you\'d like to use for the first Homepage Blurb.',
        'type'        => 'upload',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_1_url',
        'label'       => 'Blurb 1: URL',
        'desc'        => 'Enter the URL that you\'d like the first homepage blurb to link to.',
        'type'        => 'text',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_1_text',
        'label'       => 'Blurb 1: Descriptive Text',
        'desc'        => 'Enter the descriptive text for the first homepage blurb.',
        'type'        => 'textarea-simple',
        'section'     => 'frontpage',
        'rows'        => '5',
      ),
      array(
        'id'          => 'homepage_blurb_2_title',
        'label'       => 'Blurb 2: Title',
        'desc'        => 'Enter the title for the second homepage blurb.',
        'type'        => 'text',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_2_image',
        'label'       => 'Blurb 2: Image',
        'desc'        => 'Enter the image that you\'d like to use for the second Homepage Blurb.',
         'type'        => 'upload',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_2_url',
        'label'       => 'Blurb 2: URL',
        'desc'        => 'Enter the URL that you\'d like the second homepage blurb to link to.',
        'type'        => 'text',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_2_text',
        'label'       => 'Blurb 2: Descriptive Text',
        'desc'        => 'Enter the descriptive text for the second homepage blurb.',
        'type'        => 'textarea-simple',
        'section'     => 'frontpage',
        'rows'        => '5',
      ),
      array(
        'id'          => 'homepage_blurb_3_title',
        'label'       => 'Blurb 3: Title',
        'desc'        => 'Enter the title for the third homepage blurb.',
        'type'        => 'text',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_3_image',
        'label'       => 'Blurb 3: Image',
        'desc'        => 'Enter the image that you\'d like to use for the third Homepage Blurb.',
        'type'        => 'upload',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_3_url',
        'label'       => 'Blurb 3: URL',
        'desc'        => 'Enter the URL that you\'d like the third homepage blurb to link to.',
        'type'        => 'text',
        'section'     => 'frontpage',
      ),
      array(
        'id'          => 'homepage_blurb_3_text',
        'label'       => 'Blurb 3: Descriptive Text',
        'desc'        => 'Enter the descriptive text for the third homepage blurb.',
        'type'        => 'textarea-simple',
        'section'     => 'frontpage',
        'rows'        => '5',
      ),
      array(
        'id'          => 'header_social',
        'label'       => 'Display Social Icons in the Header?',
        'desc'        => 'Do you want the social icons to show up in the header? Options for each icon are below.',
        'section'     => 'social',
        'type' => 'on_off',         
        'std' => 'off',
      ),

      array(
      'id'          => 'notes_5',
      'label'       => 'Image Behavior',
      'desc'        => 'The settings below will control the front page slider options. Each individual post and page have their own set of these settings as well.',
      'type'        => 'textblock-titled',
      'section'     => 'skeleton_slider',
      ),
      array(
        'id'          => 'homepage_slider',
        'label'       => 'Slider: Slide Manager',
        'desc'        => 'Upload images that you\'d like to be used as slides on the default homepage layout, as well as a simple destination URL for when visitors click each slide. 

Note: The theme will automatically resize any oversized images to fit the space. Images should all be roughly the same height, and images that are too small will not be scaled "up" to fit the space.',
        'type'        => 'list-item',
        'section'     => 'skeleton_slider',
      ),
      array(
        'id'          => 'fpslider_fx',
        'label'       => 'Slider: Transition Effect',
        'desc'        => 'Select the effect that will transition you from one set of slides to another.',
        'type'        => 'select',
        'section'     => 'skeleton_slider',
        'choices'     => array( 
          array(
            'value'       => 'slide',
            'label'       => 'slide',
            'src'         => ''
          ),
          array(
            'value'       => 'fade',
            'label'       => 'fade',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'fpslider_auto',
        'label'       => 'Slider: AutoPlay',
        'desc'        => 'Selecting "true" will result in a slider that plays automatically. <br /><br />Selecting "false" will require users to manually advance the slider with the  buttons, keyboard  keys, or a finger swipe.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'skeleton_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'true',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'false',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'fpslider_autoduration',
        'label'       => 'Slider: AutoPlay Pause Time',
        'desc'        => 'Select a time, in milliseconds, for the pause duration of each slide if you selected "true" for the auto play feature. Hint: "2000" is fast, "8000" is slower.',
        'type'        => 'select',
        'section'     => 'skeleton_slider',
        'choices'     => array( 
          array(
            'value'       => '2000',
            'label'       => '2000',
            'src'         => ''
          ),
          array(
            'value'       => '2500',
            'label'       => '2500',
            'src'         => ''
          ),
          array(
            'value'       => '3000',
            'label'       => '3000',
            'src'         => ''
          ),
          array(
            'value'       => '3500',
            'label'       => '3500',
            'src'         => ''
          ),
          array(
            'value'       => '4000',
            'label'       => '4000',
            'src'         => ''
          ),
          array(
            'value'       => '4500',
            'label'       => '4500',
            'src'         => ''
          ),
          array(
            'value'       => '5000',
            'label'       => '5000',
            'src'         => ''
          ),
          array(
            'value'       => '5500',
            'label'       => '5500',
            'src'         => ''
          ),
          array(
            'value'       => '6000',
            'label'       => '6000',
            'src'         => ''
          ),
          array(
            'value'       => '6500',
            'label'       => '6500',
            'src'         => ''
          ),
          array(
            'value'       => '7000',
            'label'       => '7000',
            'src'         => ''
          ),
          array(
            'value'       => '7500',
            'label'       => '7500',
            'src'         => ''
          ),
          array(
            'value'       => '8000',
            'label'       => '8000',
            'src'         => ''
          )
        ),
      ),

      array(
      'id'          => 'notes_99',
      'label'       => 'Social Behavior',
      'desc'        => 'Social media links for the theme.',
      'type'        => 'textblock-titled',
      'section'     => 'social',
      ),
      array(
        'id'          => 'footer_social',
        'label'       => 'Display Social Icons in the Footer?',
        'desc'        => 'Selecting "Yes" will repeat the social icons (Facebook, Twitter, etc.) from the header navigation on the right side of the footer.',
        'type'        => 'radio',
        'section'     => 'social',
        'type' => 'on_off',         
        'std' => 'off',
      ),
      array(
        'id'          => 'social_twitter',
        'label'       => 'Twitter Link',
        'desc'        => 'Enter your Twitter URL that you\'d like to use for all theme-specific social links.',
        'type'        => 'text',
        'section'     => 'social',
      ),
      array(
        'id'          => 'social_facebook',
        'label'       => 'Facebook Link',
        'desc'        => 'Enter your Facebook URL that you\'d like to use for all theme-specific social links.',
        'type'        => 'text',
        'section'     => 'social',
      ),
      array(
        'id'          => 'social_google',
        'label'       => 'Google+ Link',
        'desc'        => 'Enter your Google+ URL that you\'d like to use for all theme-specific social links.',
        'type'        => 'text',
        'section'     => 'social',
      ),
      array(
        'id'          => 'social_youtube',
        'label'       => 'YouTube Link',
        'desc'        => 'Insert the full URL you\'d like used for your YouTube link. Leave empty and the icon won\'t show up at all.',
        'type'        => 'text',
        'section'     => 'social',
      ),
      array(
        'id'          => 'social_vimeo',
        'label'       => 'Vimeo Link',
        'desc'        => 'Enter your Vimeo URL that you\'d like to use for all theme-specific social links.',
        'type'        => 'text',
        'section'     => 'social',
      ),
      array(
        'id'          => 'social_linkedin',
        'label'       => 'Linked-In Link',
        'desc'        => 'Enter your LinkedIn URL that you\'d like to use for all theme-specific social links.',
        'type'        => 'text',
        'section'     => 'social',
      ),
      array(
        'id'          => 'social_pinterest',
        'label'       => 'Pinterest Link',
        'desc'        => 'Your Pinterest URL.',
        'type'        => 'text',
        'section'     => 'social',
      ),
      array(
        'id'          => 'social_skype',
        'label'       => 'Skype Link',
        'desc'        => 'Your Skype URL.',
        'type'        => 'text',
        'section'     => 'social',
      ),
      array(
        'id'          => 'social_custom',
        'label'       => 'Add Your Own Social Icons:',
        'desc'        => 'Add a new item for each custom icon that you want to add. An uploaded image and a link are required. The image should be a PNG, sized to about 32x32, but the theme will likely scale these down if you upload anything bigger. Here\'s a good place to start looking for <a href="http://www.komodomedia.com/blog/2009/06/social-network-icon-pack/">additional icons</a>. Don\'t forget to add "http://" before your URL!',
        'type'        => 'list-item',
        'section'     => 'social',
      ),   
      array(
        'id'          => 'social_rss',
        'label'       => 'Add your blog\'s RSS link?',
        'desc'        => 'Add a link to your blog\'s default RSS feed?',
        'type'        => 'radio',
        'section'     => 'social',
        'type' => 'on_off',         
        'std' => 'off',
      ),

      array(
      'id'          => 'notes_7',
      'label'       => '"From the Blog" Row',
      'desc'        => 'Select "Yes" to show a row of posts just above the footer widgets section. You can setup custom options for it below (only necessary if you pick Yes, naturally!). Note: If you select "Yes", you can always disable this on individual Posts/Pages from the Post/Page Options box.',
      'type'        => 'textblock-titled',
      'section'     => 'breakout',
      ),
      array(
        'id'          => 'homepage_breakout_section',
        'label'       => 'Show "From the Blog" Row?',
        'desc'        => 'Select "Yes" to show a row of posts just above the footer widgets section. You can setup custom options for it below (only necessary if you pick Yes, naturally!). Note: If you select "Yes", you can always disable this on individual Posts/Pages from the Post/Page Options box.',
        'type'        => 'radio',
        'section'     => 'breakout',
        'type' => 'on_off',         
        'std' => 'off',
      ),
      array(
        'id'          => 'homepage_breakout_title',
        'label'       => 'From The Blog : Header',
        'desc'        => 'The title for the From the Blog row (shown on the left side of the row).',
        'type'        => 'text',
        'section'     => 'breakout',
      ),
      array(
        'id'          => 'homepage_breakout_text',
        'label'       => 'Descriptive Text',
        'desc'        => 'The text for the From the Blog row (shown on the left side of the row).',
        'type'        => 'textarea-simple',
        'section'     => 'breakout',
        'rows'        => '5',
      ),
      array(
        'id'          => 'homepage_breakout_category',
        'label'       => 'From the Blog : Category Filter',
        'desc'        => 'Pick a c ategory (not mandatory) for the posts that you\'d like to show up in this row. If you don\'t pick one, it\'ll draw from all possible categories in your blog.',
        'type'        => 'category-select',
        'section'     => 'breakout',
      ),
      array(
        'id'          => 'homepage_breakout_number',
        'label'       => 'From the Blog : Post Count',
        'desc'        => 'Pick how many posts you\'d like to show up in this row. Ideally this should be 3 (making one full row), but you can add more or less if you\'d like!',
        'type'        => 'select',
        'section'     => 'breakout',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => '1',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => '2',
            'src'         => ''
          ),
          array(
            'value'       => '3',
            'label'       => '3',
            'src'         => ''
          ),
          array(
            'value'       => '4',
            'label'       => '4',
            'src'         => ''
          ),
          array(
            'value'       => '5',
            'label'       => '5',
            'src'         => ''
          ),
          array(
            'value'       => '6',
            'label'       => '6',
            'src'         => ''
          ),
          array(
            'value'       => '7',
            'label'       => '7',
            'src'         => ''
          ),
          array(
            'value'       => '8',
            'label'       => '8',
            'src'         => ''
          ),
          array(
            'value'       => '9',
            'label'       => '9',
            'src'         => ''
          ),
          array(
            'value'       => '10',
            'label'       => '10',
            'src'         => ''
          ),
          array(
            'value'       => '11',
            'label'       => '11',
            'src'         => ''
          ),
          array(
            'value'       => '12',
            'label'       => '12',
            'src'         => ''
          ),
          array(
            'value'       => '13',
            'label'       => '13',
            'src'         => ''
          ),
          array(
            'value'       => '14',
            'label'       => '14',
            'src'         => ''
          ),
          array(
            'value'       => '15',
            'label'       => '15',
            'src'         => ''
          )
        ),
      ),

      array(
      'id'          => 'notes_8',
      'label'       => 'Footer Options',
      'desc'        => 'Footer options for the theme',
      'type'        => 'textblock-titled',
      'section'     => 'footer',
      ),
      array(
        'id'          => 'footer_widgets',
        'label'       => 'Display Footer Widget Space?',
        'desc'        => 'Choose whether or not you\'d like the footer widget space to be visible. These 4 widget spaces (sidebars) are controlled from the Appearance &gt; Widgets panel.',
        'section'     => 'footer',
        'type' => 'on_off',         
        'std' => 'off',
      ),
      array(
        'id'          => 'footer_blurb_left',
        'label'       => 'Left-side Footer Blurb',
        'desc'        => 'The text that you\'d like to display at the left side of the bottom footer row. IE: Copyright 2012, Your Company.',
        'type'        => 'textarea-simple',
        'section'     => 'footer',
        'rows'        => '5',
      ),
      array(
        'id'          => 'footer_blurb_right',
        'label'       => 'Right-side Footer Blurb',
        'desc'        => 'The text that you\'d like to display at the right side of the bottom footer row. IE: Powered by WordPress, Theme by Brandon R Jones.',
        'type'        => 'textarea-simple',
        'section'     => 'footer',
        'rows'        => '5',
      ),

      array(
      'id'          => 'notes_9',
      'label'       => 'Extras',
      'desc'        => 'Footer options for the theme',
      'type'        => 'textblock-titled',
      'section'     => 'documenation',
      ),
      array(
        'id'          => 'documentation_notes',
        'label'       => 'Documentation &amp; Support',
        'desc'        => 'Each product comes with it\'s own set of comprehensive PDF instructions in the download folder... but there\'s a lot of other places that you can get assistance as well!
<br /><br />
<a target="_blank" href="http://youtube.com">The MDNW YouTube Library</a>: for step by step video guides to the most frequently asked questions - from installing our themes to using custom features.
<br /><br />
<a target="_blank" href="http://makedesign.staging.wpengine.com/reactor/general_support/Support_Guide.html">The General Support Guide</a>: for the most common tips and tricks to getting your questions answered. This is a "general" guide, so it covers a lot of basic stuff that\'s not necessarily specific to this theme, but it\'s super helpful.
<br /><br />
<a href="http://makedesign.ticksy.com">The Support Center</a>: if you still have a question about a particular product or want to report a bug, file a support ticket here and I\'ll get back to you ASAP! There\'s also a <strong>comprehensive FAQ section</strong> for this theme being built over there... so your question might be there already!',
        'type'        => 'textblock-titled',
        'section'     => 'documentation',
      ),
      array(
        'id'          => 'plugins',
        'label'       => 'Supported Third Party Plugins',
        'desc'        => 'The following plugins are confirmed to work with this theme... and in some cases I even recommend that you pick them up to extend the core features:

<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/shortcodes-ultimate">Shortcodes Ultimate</a>: Want to use tabs, videos, create your own buttons, and more? This will add a small "shortcodes" icon next to the image-uploader icon on your Posts and Pages. Make sure you visit the Settings &gt; Shortcodes page after installation to turn on their "Compatibility Mode" to ensure there\'s no conflict with other plugins. Note: The sliders are not verified to work with the theme... yet.
<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/advanced-excerpt/">Advanced Excerpt</a>: A better post excerpt system... this will allow you to include images, paragraphs, videos (iframes) and more into your post previews.
<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/wp-google-fonts">WP Google Fonts</a>: If you\'re not using Typekit.com and want more fonts, you can\'t really go wrong with this plugin.

<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/twitter-wings">Twitter Wings</a>: Just about the perfect Twitter Feed plugin - it\'ll allow you to add a widget for your twitter stuff.

<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/quick-flickr-widget">Quick Flickr Widget</a>: Adds a Flickr Widget (as seen in the demo).

<br /><br />
Why not just include them in the theme? Because that\'s a bad, bad, terrible no good, downright dirty practice that theme developers should avoid. The theme\'s purpose is to skin and lay out your content... not BE the content ;) Using plugins in this way is good for you and good for the community because it allows you to switch themes easily and keep your plugin-based-features isolated from all of that stuff.',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'documentation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'ratings',
        'label'       => 'Rate the Theme (Keep the Updates Coming!)',
        'desc'        => 'Finally, if you like this theme and appreciate the work put into it, leave a 5-Star rating over at <a href="http:/themeforest.net">ThemeForest.net</a> (on your Downloads page). It helps motivate me to keep on releasing new features and it won\'t cost ya a dime!',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'documentation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mdnw_themes',
        'label'       => 'Check out our other Super Skeleton themes!',
        'desc'        => 'Responsive, Easy to Use, Installs in seconds! SuperSkeleton themes are built with users in mind, not geeks. Extend the themes with our growing list of killer supported plugins, or use them as a foundation for quickly launching your next WordPress site.

<div class="theme-store-wrapper">
<div class="theme-store"><a href="http://themeforest.net/item/radiant-wp-colorful-beautiful-responsive/2822917?ref=epicera"><img src="http://0.s3.envato.com/files/32509285/screenshots/00_preview.__large_preview.jpg" /></a></div>

<div class="theme-store"><a href="http://themeforest.net/item/reason-wp-smart-responsive-customizable/2274642?ref=epicera"><img src="http://2.s3.envato.com/files/26290456/screenshots/00_preview_reason.__large_preview.png" /></a></div>

<div class="theme-store"><a href="http://themeforest.net/item/shapeshifter-2-responsive-flexible-one-page/903214?ref=epicera"><img src="http://0.s3.envato.com/files/10445881/screenshots/00_preview.__large_preview.jpg" /></a></div>

<div class="theme-store"><a href="http://themeforest.net/item/reaction-wp-responsive-rugged-bold/702169?ref=epicera"><img src="http://0.s3.envato.com/files/7971526/screenshots/00_preview.__large_preview.jpg" /></a></div>

<div class="theme-store"><a href="http://themeforest.net/item/super-skeleton-wp-responsive-minimal-beautiful/647570?ref=epicera"><img src="http://0.s3.envato.com/files/21622985/screenshots/00_preview.__large_preview.jpg" /></a></div>
</div>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'theme_store',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
   
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}