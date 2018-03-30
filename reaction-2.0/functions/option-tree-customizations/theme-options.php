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
      
      'sidebar'       => ''
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
        'title'       => 'Typography'
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
        'title'       => 'Front Page '
      ),
      array(
        'id'          => 'skeleton_slider',
        'title'       => 'Front Page Slider'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social '
      ),
      array(
        'id'          => 'footer',
        'title'       => 'Footer'
      ),
      array(
        'id'          => 'documentation',
        'title'       => 'Theme Extras'
      ),
      array(
        'id'          => 'theme_store',
        'title'       => 'Theme Store'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'general_notes',
        'label'       => 'Welcome to the Radiant Theme!',
        'desc'        => 'Welcome to the Theme Options page! From this panel, you\'ll be able to select the custom options that will make this theme your own. If you run into any questions, don\'t forget to check out the <a href="http://youtube.com/makedesignnotwar" target="_blank">Videos Library</a>, the <a href="http://makedesign.staging.wpengine.com/update-logs/superskeleton/index.html" target="_blank">Updates Log</a>, or the <a href="http://makedesign.staging.wpengine.com/reactor/general_support/Support_Guide.html" target="_blank">General Support Guide</a>. Have Fun!',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo',
        'label'       => 'Upload Your Logo',
        'desc'        => 'Upload your logo image (JPG, GIF, PNG). Keep in mind that this won\'t scale, so you may need to resize it to fit the template. Default size is 260 x 60px.<br /><br />
Hint: Select the "File URL" option after the image has uploaded, then hit the Add to OptionTree button.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'favicon',
        'label'       => 'Upload Your Browser Icon',
        'desc'        => 'Upload the 16x16px image (GIF) that you\'d like to show up in the browser address bar.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'theme_skin_notes',
        'label'       => 'Theme Skin Notes',
        'desc'        => 'In this section you\'ll be selecting the background for the main "stripes" of the theme. You\'re welcome to go nuts with this, but the theme download package includes the background images and textures that we used in the demo. You can also find a wide variety of other great textures at <a href="http://subtlepatterns.com">SubtlePatterns.com</a>. Ok, have fun!',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'default_skin',
        'label'       => 'Pick Your Base Skin',
        'desc'        => 'Pick the default starter skin that you want to use. <br /><br />Note: You can change the CSS for any of these from inside the /assets/stylesheets/xxxx.css files. You can also manually enter your own custom CSS override rules below.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Light',
            'label'       => 'Light',
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
        'id'          => 'tophat_background_color',
        'label'       => 'Top Hat Background Color',
        'desc'        => 'Select a color that you\'d like to use for the tophat\'s background (in case you\'re using a transparent image or no image for the previous field).',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'tophat_background_image',
        'label'       => 'Top Hat Background Image',
        'desc'        => 'Upload a tile-able image that you\'d like to use for the "tophat" background texture. <br /><br />
Note: This (and the other BG options for the tophat, footer and sub-footer) are irrelevant in the "Boxed" skin version as it uses transparent backgrounds.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_background_color',
        'label'       => 'Header Background Color',
        'desc'        => 'Select a color that will be used as the background for the header space... which is where the slider and custom page quotes will appear.',
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_background_image',
        'label'       => 'Header Background Image',
        'desc'        => 'Upload an image that will be used as the background for the header space... which is where the slider and custom page quotes will appear. <br /><br />Note: You\'ll also be able to select a custom header background on individual pages and posts from the Skeleton Page/Post Editor on those pages.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'default_color',
        'label'       => 'Body Background Color',
        'desc'        => 'Select a color that will be used as the default background color behind the main body area.',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'default_bg',
        'label'       => 'Body Background Image',
        'desc'        => 'Optional: Upload an image that you\'d like to use as the default background. This will be centered at the top and repeated along the X and Y axis, so it can either be a pattern or a large graphic.  <br /><br />

Note: You\'ll also be able to select a custom body background on individual pages and posts from the Skeleton Page/Post Editor on those pages.

<br /><br />

Also Note: If you leave any of these next options blank, the theme\'s base skin may use a default backup image or color instead.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_background_color',
        'label'       => 'Footer Background Color',
        'desc'        => 'Select a color that you\'d like to use for the footer\'s background (in case you\'re using a transparent image or no image for the previous field).',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_background_image',
        'label'       => 'Footer Background Image',
        'desc'        => 'Upload a tile-able image that you\'d like to use for the "footer" background texture.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'subfooter_background_color',
        'label'       => 'Sub-Footer Background Color',
        'desc'        => 'Select a color that you\'d like to use for the sub-footer\'s background (in case you\'re using a transparent image or no image for the previous field).',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'subfooter_background_image',
        'label'       => 'Sub-Footer Background Image',
        'desc'        => 'Upload a tile-able image that you\'d like to use for the "sub-footer" background texture.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'skinning_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'customcss',
        'label'       => 'Custom CSS',
        'desc'        => 'You can enter custom style rules into this box if you\'d like. IE: <i>a{color: red !important;}</i><br />
					This is an advanced option! This is not recommended for users not fluent in CSS... but if you do know CSS, anything you add here will override the default styles.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'skinning_options',
        'rows'        => '15',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'default_fontstack',
        'label'       => 'Select Your Base Fontface',
        'desc'        => 'Select the default font stack that you\'d like used on the site.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
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
        'desc'        => 'Have your own font-replacement "embed code" already from a service like TypeKit? Go ahead and enter it right here. This is an experimental tool at the moment, so if it doesn\'t work perfectly with your own font service, you\'ll have to use the default options above or insert yours via the header.php file.<br /><br />

You can also check out the popular and stable WP Google Fonts plugin (free in the Plugins &gt; Add New directory).',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'styling',
        'rows'        => '12',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'link_color',
        'label'       => 'Link Color',
        'desc'        => 'Pick the color that you\'d like all links to appear as by default.',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'link_hover_color',
        'label'       => 'Link Hover Color',
        'desc'        => 'Select the color that you\'d like your links to appear as when hovered over by a mouse.',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'link_visited_color',
        'label'       => 'Link Visited Color',
        'desc'        => 'Select the color that you\'d like links to appear as AFTER a user has visited them. Likely a slight variation of the default link color.',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'open_as_lightbox',
        'label'       => 'Open Portfolio Thumbnails in a Lightbox?',
        'desc'        => 'Selecting "Yes" will make thumbnails across the theme (including the homepage thumbnails) open the fullsize featured-image inside a lightbox. 

<br /><br />For all blog posts: this can also be your "custom lightbox link" custom field (which can be a video URL!). 

<br /><br />Selecting "No" will make the thumbnails all link to their full post (inside a normal post template).',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'image_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'show_featured_image',
        'label'       => 'Auto-Insert Featured Images at the Top of Posts & Pages?',
        'desc'        => 'Sometimes it\'s a hassle to manually insert an image at the top of each blog post or page... this option allows you to simply set the "Featured Image" and the theme will add that image to the top of your blog posts, every time. 
<br /><br />It\'s also fully responsive, so you won\'t need to worry about sizing so long as your featured image is above roughly 700px wide.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'image_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'top_hat',
        'label'       => 'Display the Top Hat?',
        'desc'        => 'The "Top Hat" is the bar that rests above the log and menu space.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'top_hat_blurb',
        'label'       => 'Top Hat: Tagline Text',
        'desc'        => 'Enter some text that you\'d like used for the top-hat\'s right-side blurb.

<br /><br />Note: The social media icons will be setup in the "Social Options" section below!',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '2',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'frontpage_notes',
        'label'       => 'Front Page Notes',
        'desc'        => 'The theme frontpage assumes that your <strong>"Settings &gt; Reading"</strong> panel is set to display <strong>"Your Latest Posts"</strong>. The following options give you control over how the content is displayed... but at any time, you can opt-out of the default theme frontpage by selecting a static page for your "Settings &gt; Reading" panel. And yes, this means that you can pick a page template (portfolios, alternate blog layouts, etc.) for your homepage!',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'frontpage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'frontpage_category_filter',
        'label'       => 'Front Page: Category Filter',
        'desc'        => 'The frontpage, by default, will display ALL of your blog posts. If you\'d like just a few categories to be displayed, select them here and they won\'t show up.',
        'std'         => '',
        'type'        => 'category-checkbox',
        'section'     => 'frontpage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'frontpage_post_count',
        'label'       => 'Front Page: Posts Per Page',
        'desc'        => 'Select how many posts you\'d like displayed on the front page before pagination kicks in. 
<br /><br />Select -1 to show all posts... This is not recommended in most circumstances as it\'ll slow down the site.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'frontpage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
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
          ),
          array(
            'value'       => '-1',
            'label'       => '-1',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'frontpage_slider',
        'label'       => 'FrontPage: Slider',
        'desc'        => 'Show the homepage slider? Selecting "No" will hide it, even if you have slides set below.

<br /><br />
You can adjust the settings (timing, transitions, etc.) in the next section.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'frontpage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'frontpage_caption',
        'label'       => 'FrontPage: Caption',
        'desc'        => 'This is the custom page caption for the homepage... it shows up between the slider and the main content area if you select "yes".',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'frontpage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'frontpage_caption_text',
        'label'       => 'FrontPage: Caption Text',
        'desc'        => 'The text that\'ll go inside your front page caption if you have it turned on.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'frontpage',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'slider_notes',
        'label'       => 'Slider Notes',
        'desc'        => 'The settings below will control the front page slider options. Each individual post and page have their own set of these settings as well.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'skeleton_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'homepage_slider',
        'label'       => 'Slider: Slide Manager',
        'desc'        => 'Upload images that you\'d like to be used as slides on the default homepage layout, as well as a simple destination URL for when visitors click each slide. 

Note: The theme will automatically resize any oversized images to fit the space. Images should all be roughly the same height, and images that are too small will not be scaled "up" to fit the space.',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'skeleton_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'fpslider_fx',
        'label'       => 'Slider: Transition Effect',
        'desc'        => 'Select the effect that will transition you from one set of slides to another.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'skeleton_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'scroll',
            'label'       => 'scroll',
            'src'         => ''
          ),
          array(
            'value'       => 'directscroll',
            'label'       => 'directscroll',
            'src'         => ''
          ),
          array(
            'value'       => 'crossfade',
            'label'       => 'crossfade',
            'src'         => ''
          ),
          array(
            'value'       => 'fade',
            'label'       => 'fade',
            'src'         => ''
          ),
          array(
            'value'       => 'cover',
            'label'       => 'cover',
            'src'         => ''
          ),
          array(
            'value'       => 'uncover',
            'label'       => 'uncover',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'fpslider_count',
        'label'       => 'Slider: How many slides should be visible at once?',
        'desc'        => 'Default: 1. Select how many slides you would like to be visible at any given time. IE: Picking "5" would show 5 images in each carousel. Picking "1" would just show one large image on each carousel (making it look like a traditional slider).',
        'std'         => '1',
        'type'        => 'select',
        'section'     => 'skeleton_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
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
          )
        ),
      ),
      array(
        'id'          => 'fpslider_minheight',
        'label'       => 'Slider: Initial Height',
        'desc'        => 'Some browsers require an initial height to be entered for your slider. Enter a numeric value here that represents your slider\'s approximate opening height in pixels (this is the height of your first slider image in most cases). Hint: WordPress will tell you the image size when you upload your image.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'skeleton_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
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
        'std'         => '',
        'type'        => 'select',
        'section'     => 'skeleton_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
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
        'id'          => 'header_social',
        'label'       => 'Display Social Icons in the Header?',
        'desc'        => 'Do you want the social icons to show up in the header? Options for each icon are below.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footer_social',
        'label'       => 'Display Social Icons in the Footer?',
        'desc'        => 'Selecting "Yes" will repeat the social icons (Facebook, Twitter, etc.) from the header navigation on the right side of the footer.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'social_twitter',
        'label'       => 'Twitter Link',
        'desc'        => 'Enter your Twitter URL that you\'d like to use for all theme-specific social links.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_facebook',
        'label'       => 'Facebook Link',
        'desc'        => 'Enter your Facebook URL that you\'d like to use for all theme-specific social links.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_google',
        'label'       => 'Google+ Link',
        'desc'        => 'Enter your Google+ URL that you\'d like to use for all theme-specific social links.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_youtube',
        'label'       => 'YouTube Link',
        'desc'        => 'Insert the full URL you\'d like used for your YouTube link. Leave empty and the icon won\'t show up at all.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_vimeo',
        'label'       => 'Vimeo Link',
        'desc'        => 'Enter your Vimeo URL that you\'d like to use for all theme-specific social links.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_linkedin',
        'label'       => 'Linked-In Link',
        'desc'        => 'Enter your LinkedIn URL that you\'d like to use for all theme-specific social links.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_pinterest',
        'label'       => 'Pinterest Link',
        'desc'        => 'Your Pinterest URL.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_skype',
        'label'       => 'Skype Link',
        'desc'        => 'Your Skype URL',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_rss',
        'label'       => 'Display Your Blog\'s RSS Link?',
        'desc'        => 'Want to display your blog\'s RSS feed link?',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'social_custom',
        'label'       => 'Add Your Own Social Icons:',
        'desc'        => 'Add a new item for each custom icon that you want to add. An uploaded image and a link are required. The image should be a PNG, sized to about 32x32, but the theme will likely scale these down if you upload anything bigger. Here\'s a good place to start looking for <a href="http://www.komodomedia.com/blog/2009/06/social-network-icon-pack/">additional icons</a>. Don\'t forget to add "http://" before your URL!',
        'std'         => '',
        'type'        => 'slider',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'footer_widgets',
        'label'       => 'Display the Footer Widget Columns?',
        'desc'        => 'Choose whether or not you\'d like the footer widget space to be visible. These widget spaces (sidebars) are controlled from the Appearance &gt; Widgets panel.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'No',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footer_blurb_left',
        'label'       => 'Footer: Leftside Text',
        'desc'        => 'The text that you\'d like to display at the left side of the bottom footer row. IE: Copyright 2012, Your Company.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_blurb_right',
        'label'       => 'Footer: Rightside Text',
        'desc'        => 'The text that shows up on the right side of your footer.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
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
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'documentation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'plugins',
        'label'       => 'Supported Third Party Plugins',
        'desc'        => 'The following plugins are confirmed to work with this theme... and in some cases I even recommend that you pick them up to extend the core features:

<a target="_blank" href="http://wordpress.org/extend/plugins/dynamic-to-top">Dynamic To Top</a>: Adds a the "scroll to the top" button when you scroll down the page... very helpful on mobile devices.

<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/shortcodes-ultimate">Shortcodes Ultimate</a>: Want to use tabs, videos, create your own buttons, and more? This will add a small "shortcodes" icon next to the image-uploader icon on your Posts and Pages. Make sure you visit the Settings &gt; Shortcodes page after installation to turn on their "Compatibility Mode" to ensure there\'s no conflict with other plugins. Note: The sliders are not verified to work with the theme... yet.
<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/advanced-excerpt/">Advanced Excerpt</a>: A better post excerpt system... this will allow you to include images, paragraphs, videos (iframes) and more into your post previews.
<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/wp-google-fonts">WP Google Fonts</a>: If you\'re not using Typekit.com and want more fonts, you can\'t really go wrong with this plugin.

<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/twitter-wings">Twitter Wings</a>: Just about the perfect Twitter Feed plugin - it\'ll allow you to add a widget for your twitter stuff.

<br /><br />
<a target="_blank" href="http://wordpress.org/extend/plugins/contact-form-7">Contact Form 7</a>: Our favorite way to get contact forms in your theme pages or posts. 

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
        'id'          => 'theme_typography_notes',
        'label'       => 'Theme Typography Notes',
        'desc'        => 'While we sup',
        'std'         => '',
        'type'        => 'textblock',
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