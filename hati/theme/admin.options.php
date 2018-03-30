<?php

# Defines an array of options

function optionsframework_options() {

  $imgpath = A_THEME_URL . '/img';

  # General Settings

  $options[] = array( 'name' => 'General', 'type' => 'heading' );

  $options[] = array( 
    'name' => 'Custom Logo',
    'desc' => 'Upload a logo for your website, or provide an URL of image starting with http://',
    'std' => "{$imgpath}/logo.png",
    'id' => 'logo',
    'type' => 'upload');

  $options[] = array( 'name' => 'Custom Favicon',
    'desc' => 'Upload small Png/Gif image that will represent your website&rsquo;s favicon.',
    'id' => 'favicon',
    'type' => 'upload');

  $options[] = array( 'name' => 'Login Logo',
    'desc' => 'Upload a logo (274x63px) for WordPress login page, or provide an URL of image starting with http://',
    'class' => 'hidden',
    'id' => 'login-logo',
    'type' => 'upload');

  $options[] = array( 'name' => 'Custom Feed URL',
    'desc' => 'Enter custom feed URL, if you wish to use it over the standard WordPress Feed e.g. http://feeds.feedburner.com/your-site',
    'class' => 'autoselect',
    'id' => 'customfeed',
    'std' => '',
    'type' => 'text'); 

  $options[] = array( 'name' => 'Tracking Code',
    'desc' => 'Paste your Google Analytics (or other) tracking code here. It will be inserted into the bottom of your content, immediately before the &lt;/body&gt; tag of each page.',
    'id' => 'tracking',
    'std' => '',
    'type' => 'textarea');

  # Style Settings

  $options[] = array( 'name' => 'Style', 'type' => 'heading' );

  $options[] = array( 'name' => 'Custom Colours',
    'desc' => 'Text colour, default - #373432',
    'id' => 'text-color',
    'std' => '#373432',
    'type' => 'color');
  
  $options[] = array( 'name' => 'Custom Colours',
    'desc' => 'Link background on :hover, default - #dceddc',
    'class' => 'sub',
    'id' => 'link-bg',
    'std' => '#dceddc',
    'type' => 'color');

  $options[] = array( 'name' => 'Custom CSS',
    'desc' => 'Quickly add some CSS to your theme here.',
    'id' => 'custom-css',
    'std' => '',
    'type' => 'textarea');
  
  $options[] = array( 'name' => 'Custom Shortcode',
    'desc' => 'Add your favorite shortcodes to extend Shortcode Manager.',
    'id' => 'custom-shortcode',
    'std' => '[shortcode] Find me in Theme Options and Shortcode Manager. [/shortcode]',
    'type' => 'textarea');
    
  $options[] = array( 'name' => 'Portfolio Styling',
    'desc' => 'Work Type, Year or Client link displayed as filtered Portfolio. Or Journal-like if disabled.',
    'class' => 'hidden',
    'id' => 'portfolio-styling',
    'std' => true,
    'type' => 'checkbox');
    
  $options[] = array( 'name' => 'Portfolio FX',
    'desc' => 'Disable portfolio 3d effect.',
    'class' => '',
    'id' => 'portfolio-fx-off',
    'type' => 'checkbox');

  # Footer Settings

  $options[] = array( 'name' => 'Footer', 'type' => 'heading' );

  $options[] = array( 'name' => 'Widgetize Footer',
    'desc' => 'Check this to <a href="widgets.php">widgetize</a> theme footer. Please note, that empty widget areas do not replace default footer content, configured below.',
    'class' => '',
    'id' => 'widgetized-footer',
    'type' => 'checkbox');

  $options[] = array( 
    'name' => 'Footer Logo I',
    'desc' => 'Upload a footer logo, or provide an URL of image starting with http://',
    'std' => "{$imgpath}/logo-alt.png",
    'id' => 'logo-alt',
    'type' => 'upload');

  $options[] = array( 'name' => 'Footer Text I',
    'desc' => 'Enter the text you would like to display in the footer of your site.',
    'id' => 'copy-1',
    'std' => '<em>This demo is purely for demonstration purposes. All images are copyrighted to their respective owners.</em>',
    'type' => 'textarea');

  $options[] = array( 'name' => 'Heading II',
    'desc' => 'Enter the heading text for second footer column.',
    'id' => 'heading-2',
    'std' => 'The Social',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Usernames II',
    'desc' => 'Enter Dribbble username.',
    'class' => 'autoselect',
    'id' => 'social-dribbble-name',
    'std' => '',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Usernames',
    'desc' => 'Enter GitHub username.',
    'class' => 'autoselect sub',
    'id' => 'social-github-name',
    'std' => '',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Usernames',
    'desc' => 'Enter Instagram username.',
    'class' => 'autoselect sub',
    'id' => 'social-instagram-name',
    'std' => '',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Usernames',
    'desc' => 'Enter Pinterest username.',
    'class' => 'autoselect sub',
    'id' => 'social-pinterest-name',
    'std' => '',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Usernames',
    'desc' => 'Enter Twitter username.',
    'class' => 'autoselect sub',
    'id' => 'social-twitter-name',
    'std' => 'helloalaja',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Usernames',
    'desc' => 'Enter Vimeo username.',
    'class' => 'autoselect sub',
    'id' => 'social-vimeo-name',
    'std' => '',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Media URLs II',
    'desc' => 'Enter Facebook custom URL.',
    'class' => 'autoselect',
    'id' => 'social-facebook-url',
    'std' => '#facebook',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Media URLs',
    'desc' => 'Enter Google+ custom URL.',
    'class' => 'autoselect sub',
    'id' => 'social-googleplus-url',
    'std' => '#google',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Media URLs',
    'desc' => 'Enter LinkedIn custom URL.',
    'class' => 'autoselect sub',
    'id' => 'social-linkedin-url',
    'std' => '',
    'type' => 'text');

  $options[] = array( 'name' => 'Social Media URLs',
    'desc' => 'Enter Tumblr custom URL.',
    'class' => 'autoselect sub',
    'id' => 'social-tumblr-url',
    'std' => '',
    'type' => 'text');
  
  $options[] = array( 'name' => 'Heading III',
    'desc' => 'Enter the heading text for third footer column.',
    'id' => 'heading-3',
    'std' => 'Chirp Chirp',
    'type' => 'text');
  
  $options[] = array( 'name' => 'Twitter Username III',
    'desc' => 'Enter Twitter username to fetch and show latest tweet.',
    'class' => 'autoselect',
    'id' => 'twitter-name',
    'std' => 'helloalaja',
    'type' => 'text');
  
  $options[] = array( 'name' => 'Heading IV',
    'desc' => 'Enter the heading text for fourth footer column.',
    'id' => 'heading-4',
    'std' => 'Purchase Hati',
    'type' => 'text');
  
  $options[] = array( 'name' => 'Footer Text IV',
    'desc' => 'Enter the text you would like to display in the footer of your site.',
    'id' => 'copy',
    'class' => '',
    'std' => '&copy; '. date( 'Y' ) ."\n".'<a href="http://themeforest.net/user/alaja/portfolio">'. A_THEME_NAME .'</a> theme by <a href="http://alaja.info/about">Alaja</a>',
    'type' => 'textarea');


  $options[] = array( 'name' => 'Footer Area I',
    'desc' => 'Activate sidebar for 1st footer column.',
    'class' => 'hidden',
    'id' => 'foot-sidebar-1',
    'type' => 'checkbox');

  $options[] = array( 'name' => 'Footer Area II',
    'desc' => 'Activate sidebar for 2nd footer column.',
    'class' => 'hidden',
    'id' => 'foot-sidebar-2',
    'type' => 'checkbox');
    
  $options[] = array( 'name' => 'Footer Area III',
    'desc' => 'Activate sidebar for 3rd footer column.',
    'class' => 'hidden',
    'id' => 'foot-sidebar-3',
    'type' => 'checkbox');

  $options[] = array( 'name' => 'Footer Area IV',
    'desc' => 'Activate sidebar for 4th footer column.',
    'class' => 'hidden',
    'id' => 'foot-sidebar-4',
    'type' => 'checkbox');

  # end

  return $options;
}
