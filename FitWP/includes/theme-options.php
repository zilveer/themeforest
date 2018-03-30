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
        'id'          => 'topbar',
        'title'       => 'Top Bar'
      ),
      array(
        'id'          => 'header',
        'title'       => 'Header'
      ),
      array(
        'id'          => 'bodystyling',
        'title'       => 'Styling Options'
      ),
      array(
        'id'          => 'slidersettings',
        'title'       => 'Slider'
      ),
      array(
        'id'          => 'footer',
        'title'       => 'Footer'
      ),
      array(
        'id'          => 'cps',
        'title'       => 'Custom Post Slug'
      ),
      array(
        'id'          => 'custompagetitle',
        'title'       => 'Custom Page Title'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'topbar',
        'label'       => 'Display Top Bar?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'sdfgasfg',
            'label'       => 'Make Your Choice :',
            'src'         => ''
          ),
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'openinghours',
        'label'       => 'Display Opening Hours?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'asdasdf',
            'label'       => 'Make Your Choice :',
            'src'         => ''
          ),
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'openinghourshtml',
        'label'       => 'Opening Hours HTML Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'phonenumber',
        'label'       => 'Display Phone Number?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'asdfasdasd',
            'label'       => 'Make Your Choice :',
            'src'         => ''
          ),
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'phonenumbercontent',
        'label'       => 'Phone Number Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'contactform',
        'label'       => 'Display Contact Form?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'asdfasdf',
            'label'       => 'Make Your Choice :',
            'src'         => ''
          ),
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'contactformadress',
        'label'       => 'Display Adress In Contact Form?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'make_your_choice__',
            'label'       => 'Make Your Choice :',
            'src'         => ''
          ),
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'contactformadresscontent',
        'label'       => 'Adress Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'topbarsearch',
        'label'       => 'Display Searchbar?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'topbar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'sdfasdf',
            'label'       => 'Make Your Choice :',
            'src'         => ''
          ),
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'top_bar_social_twitter',
        'label'       => 'Social - Twitter',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_facebook',
        'label'       => 'Social - Facebook',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_vimeo',
        'label'       => 'Social - Vimeo',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_googleplus',
        'label'       => 'Social - Google Plus',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_pinterest',
        'label'       => 'Social - Pinterest',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_flickr',
        'label'       => 'Social - Flickr',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_linkedin',
        'label'       => 'Social - Linkedin',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_dribbble',
        'label'       => 'Social - Dribbble',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_instagram',
        'label'       => 'Social - Instagram',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'top_bar_social_behance',
        'label'       => 'Social - Behance',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
       array(
        'id'          => 'top_bar_social_youtube',
        'label'       => 'Social - Youtube',
        'type'        => 'text',
        'section'     => 'topbar',
      ),
      array(
        'id'          => 'logo',
        'label'       => 'Logo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'tagline',
        'label'       => 'Logo Tagline',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'skin',
        'label'       => 'Choose You Skin :',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'asdasd',
            'label'       => 'Make your Choice :',
            'src'         => ''
          ),
          array(
            'value'       => 'light',
            'label'       => 'Light',
            'src'         => ''
          ),
          array(
            'value'       => 'dark',
            'label'       => 'Dark',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'accent',
        'label'       => 'Accent Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'buttons',
        'label'       => 'Buttons Colors',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header',
        'label'       => 'Header Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'page',
        'label'       => 'Page Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footercolor',
        'label'       => 'Footer Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'smallfooter',
        'label'       => 'Small Footer Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'linkscolor',
        'label'       => 'Links Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'linkshovercolor',
        'label'       => 'Links Hover Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'bodystyling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'autoslide',
        'label'       => 'Enable Auto Slide?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'slidersettings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'make_your_choice',
            'label'       => 'Make Your Choice',
            'src'         => ''
          ),
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'my_slider',
        'label'       => 'Slides',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'slidersettings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'title2',
            'label'       => 'SubTitle',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'image',
            'label'       => 'Image',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'thumbimage',
            'label'       => 'Thumb Image',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'btntext',
            'label'       => 'Button Text',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'btnurl',
            'label'       => 'Button URL',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'smallfooterleftcontent',
        'label'       => 'Small Footer Left Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'smallfooterrightcontent',
        'label'       => 'Small Footer Right Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'theme_classes_item_url',
        'label'       => 'Slug Name For "Classes"',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cps',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'theme_classes_item_type_url',
        'label'       => 'Taxonomy Name For "Classes"',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cps',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'theme_trainers_item_url',
        'label'       => 'Slug Name For "Trainers"',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cps',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'theme_trainers_item_type_url',
        'label'       => 'Taxonomy Name For "Trainers"',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cps',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'trainertitle',
        'label'       => 'Trainer Single Post Title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'custompagetitle',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'classestitle',
        'label'       => 'Classes Single Post Title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'custompagetitle',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'blogtitle',
        'label'       => 'Blog Single Post Title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'custompagetitle',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'searchtitle',
        'label'       => 'Search Page Title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'custompagetitle',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}