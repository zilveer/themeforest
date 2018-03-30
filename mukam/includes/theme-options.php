<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', '_custom_theme_options', 1 );
$google_fonts = get_google_webfonts(); 
foreach( $google_fonts as $font ) {
    $google_webfonts_array[$font['family']]['label'] = $font['family'];
    $google_webfonts_array[$font['family']]['value'] = $font['family'];
}
/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p><a href="http://wahabali.ticksy.com/">http://wahabali.ticksy.com</a></p>'
        )
      ),
      'sidebar'       => '<p><a href="http://wahabali.ticksy.com/">http://wahabali.ticksy.com</a></p>'
    ),
    'sections'        => array(
      array(
        'title'       => 'General Settings',
        'id'          => 'general_default'
      ),
      array(
        'title'       => 'Header Settings',
        'id'          => 'header_default'
      ),
      array(
        'title'       => 'Blog Settings',
        'id'          => 'blog_default'
      ),
      array(
        'title'       => 'Social Options',
        'id'          => 'social'
      ),
      array(
        'title'       => 'Footer Settings',
        'id'          => 'footer_default'
      ),
      array(
        'title'       => 'Portfolio Settings',
        'id'          => 'portfolio_default'
      ),
      array(
        'title'       => 'Mail Chimp',
        'id'          => 'contact_default'
      ),
      array(
        'title'       => 'Font Options',
        'id'          => 'font_options'
      )  
    ),
    /* General Settings */
    'settings'        => array(
      array(
        'label'       => 'Favicon Upload',
        'id'          => 'favicon_upload',
        'type'        => 'upload',
        'desc'        => 'Upload a 16px x 16px .png or .gif image that will be your favicon.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Logo Upload',
        'id'          => 'logo_upload',
        'type'        => 'upload',
        'desc'        => 'Upload your logo image. (Best 233px x 73px)',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Asset Color',
        'id'          => 'asset_color',
        'type'        => 'select',
        'desc'        => 'Select your asset color',
        'choices'     => array(
          array(
            'label'       => 'Turquoise',
            'value'       => 'main'
          ),
          array(
            'label'       => 'Red',
            'value'       => 'red'
          ),
          array(
            'label'       => 'Green',
            'value'       => 'green'
          ),
          array(
            'label'       => 'Orange',
            'value'       => 'orange'
          ),
          array(
            'label'       => 'Light Brown',
            'value'       => 'light-brown'
          ),
          array(
            'label'       => 'Purple',
            'value'       => 'purple'
          ),
          array(
            'label'       => 'Light Yellow',
            'value'       => 'light-yellow'
          ),
          array(
            'label'       => 'Yellow',
            'value'       => 'yellow'
          ),
        ),
        'std'         => 'header_style_1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
	  array(
        'label'       => 'Custom Asset Color',
        'id'          => 'custom_asset_color',
        'type'        => 'colorpicker',
        'desc'        => 'If you dont like our asset color, you can create your own color.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Enable Load Animation',
        'id'          => 'enable_load_animation',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to enable load animation',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Disable Smooth Scrool',
        'id'          => 'disable_smooth_scrool',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to disable smooth scrool',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Parallax Home Page Background',
        'id'          => 'parallaxback',
        'type'        => 'upload',
        'desc'        => 'If you want to use parallax homepage, you need to upload your background image. You should use minumum 1920x1200 for all device resolution',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Sidebar Widget Effect',
        'id'          => 'sidebar_effect',
        'type'        => 'select',
        'desc'        => 'Select your widget effect',
        'choices'     => array(
          array(
            'label'       => 'No Animation',
            'value'       => 'no_animation'
          ),
          array(
            'label'       => 'Special Effect 1',
            'value'       => 'blogeffect4-1 blindy'
          ),
          array(
            'label'       => 'Special Effect 2',
            'value'       => 'blogeffect5-1 blindy'
          ),
          array(
            'label'       => 'Special Effect 3',
            'value'       => 'blogeffect6-1 blindy'
          ),
          array(
            'label'       => 'Tada',
            'value'       => 'tadab-1 blindy'
          ),
          array(
            'label'       => 'Flip In X',
            'value'       => 'flipInX-1 blindy'
          ),
          array(
            'label'       => 'Flip In Y',
            'value'       => 'flipInY-1 blindy'
          ),
          array(
            'label'       => 'Fade In',
            'value'       => 'fadeIn-1 blindy'
          ),
          array(
            'label'       => 'Fade In Up',
            'value'       => 'fadeInUp-1 blindy'
          ),
          array(
            'label'       => 'Fade In Down',
            'value'       => 'fadeInDown-1 blindy'
          ),
          array(
            'label'       => 'Fade In Left',
            'value'       => 'fadeInLeft-1 blindy'
          ),
          array(
            'label'       => 'Fade In Right',
            'value'       => 'fadeInRight-1 blindy'
          ),
          array(
            'label'       => 'Fade In Up Big',
            'value'       => 'fadeInUpBig-1 blindy'
          ),
          array(
            'label'       => 'Fade In Down Big',
            'value'       => 'fadeInDownBig-1 blindy'
          ),
          array(
            'label'       => 'Fade In Left Big',
            'value'       => 'fadeInLeftBig-1 blindy'
          ),
          array(
            'label'       => 'Fade In Right Big',
            'value'       => 'fadeInRightBig-1 blindy'
          ),
          array(
            'label'       => 'Bounce In',
            'value'       => 'bounceIn-1 blindy'
          ),
          array(
            'label'       => 'Bounce In Down',
            'value'       => 'bounceInDown-1 blindy'
          ),
          array(
            'label'       => 'Bounce In Left',
            'value'       => 'bounceInLeft-1 blindy'
          ),
          array(
            'label'       => 'Bounce In Right',
            'value'       => 'bounceInRight-1 blindy'
          ),
          array(
            'label'       => 'Rotate In',
            'value'       => 'rotateIn-1 blindy'
          ),
          array(
            'label'       => 'Rotate In Down Left',
            'value'       => 'bounceInDownLeft-1 blindy'
          ),
          array(
            'label'       => 'Rotate In Down Left',
            'value'       => 'rotateInDownLeft-1 blindy'
          ),
          array(
            'label'       => 'Rotate In Down Right',
            'value'       => 'rotateInDownRight-1 blindy'
          ),
          array(
            'label'       => 'Rotate In Up Left',
            'value'       => 'bounceInUpLeft-1 blindy'
          ),
          array(
            'label'       => 'Bounce In Up Right',
            'value'       => 'bounceInUpRight-1 blindy'
          ),
          array(
            'label'       => 'Light Speen In',
            'value'       => 'lightSpeedIn-1 blindy'
          ),
          array(
            'label'       => 'Roll In',
            'value'       => 'bounceInUpRight-1 blindy'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
        ),
    array(
        'label'       => 'Custom CSS',
        'id'          => 'custom_css',
        'type'        => 'textarea-simple',
        'desc'        => 'If you want to customize main.css, paste your css code here. When you update the mukam, your custom css code does not disappear.',
        'std'         => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
	  array(
        'label'       => 'Google Analytics',
        'id'          => 'analytics',
        'type'        => 'textarea-simple',
        'desc'        => 'Paste your Google Analytics Code',
        'std'         => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      /* Header Settings */
      array(
        'label'       => 'Header Style',
        'id'          => 'header_style',
        'type'        => 'select',
        'desc'        => 'Select your header style from different options',
        'choices'     => array(
          array(
            'label'       => 'Header Style Classic',
            'value'       => 'header_style_1'
          ),
          array(
            'label'       => 'Header Style Icon',
            'value'       => 'header_style_2'
          ),
          array(
            'label'       => 'Header Style Animated',
            'value'       => 'header_style_3'
          ),
          array(
            'label'       => 'Header Style Subtitle',
            'value'       => 'header_style_4'
          ),
          array(
            'label'       => 'Header Style Big',
            'value'       => 'header_style_5'
          ),
          array(
            'label'       => 'Header Style Shop',
            'value'       => 'header_style_6'
          ),
          array(
            'label'       => 'Header Style Dot',
            'value'       => 'header_style_7'
          ),
          array(
            'label'       => 'Header Style Easy',
            'value'       => 'header_style_8'
          ),
        ),
        'std'         => 'header_style_1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header_default'
      ),
      array(
        'label'       => 'Show Top Section',
        'id'          => 'show_top_section',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to show top section',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header_default'
      ),
      array(
        'label'       => 'Top Section Phone',
        'id'          => 'top_section_phone',
        'type'        => 'text',
        'desc'        => 'Write phone number to top section: +0123 456 70 90 ',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header_default'
      ),
      array(
        'label'       => 'Top Section Email',
        'id'          => 'top_section_email',
        'type'        => 'text',
        'desc'        => 'Write your email that you want to show ',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header_default'
      ),
      array(
        'label'       => 'Show Mini Social Widget in Top Section',
        'id'          => 'top_section_social',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to show Mini Social Widget',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header_default'
      ),
      array(
        'label'       => 'Enable Shopping Cart Icon',
        'id'          => 'disable_cart',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want shopping cart icon on navigation',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header_default'
      ),
      /* Blog Settings */
      array(
        'label'       => 'Blog Style',
        'id'          => 'blog_style',
        'type'        => 'select',
        'desc'        => 'Select your blog style from different options',
        'choices'     => array(
          array(
            'label'       => 'Big thumbnail with Right Sidebar',
            'value'       => 'big_thumbnail_right_sidebar'
          ),
          array(
            'label'       => 'Big thumbnail with Left Sidebar',
            'value'       => 'big_thumbnail_left_sidebar'
          ),
          array(
            'label'       => 'Full Width',
            'value'       => 'full_width'
          ),
          array(
            'label'       => 'Home Page Style',
            'value'       => 'homepage'
          )
        ),
        'std'         => 'big_thumbnail_right_sidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_default'
      ),
        array(
        'label'       => 'Default Blog Header',
        'id'          => 'blog_header',
        'type'        => 'text',
        'desc'        => 'Write a title for your blog header',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_default'
      ),array(
        'label'       => 'Default Blog Caption',
        'id'          => 'blog_caption',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_default'
      ),
      /* Social Settings*/
      array(
        'label'       => 'Your Social Network',
        'id'          => 'your_social_network',
        'type'        => 'textblock-titled',
        'desc'        => '<p>Paste the full url you\'d like the image to link</p>',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Facebook',
        'id'          => 'social_facebook',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Flickr',
        'id'          => 'social_flickr',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Dribbble',
        'id'          => 'social_dribbble',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Google+',
        'id'          => 'social_google',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'LinkedIn',
        'id'          => 'social_linkedin',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Pinterest',
        'id'          => 'social_pinterest',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Digg',
        'id'          => 'social_digg',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Skype',
        'id'          => 'social_skype',
        'type'        => 'text',
        'desc'        => 'You should write as skype:username',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Twitter',
        'id'          => 'social_twitter',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Vimeo',
        'id'          => 'social_vimeo',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'YouTube',
        'id'          => 'social_youtube',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'RSS',
        'id'          => 'social_rss',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Stumbleupon',
        'id'          => 'social_stumbleupon',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Yahoo',
        'id'          => 'social_yahoo',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
	  array(
        'label'       => 'Foursquare',
        'id'          => 'social_foursquare',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
	  array(
        'label'       => 'Yelp',
        'id'          => 'social_yelp',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
    array(
        'label'       => 'Instagram',
        'id'          => 'social_instagram',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),      	  
      /* Footer Section */
        array(
        'label'       => 'Footer Style',
        'id'          => 'footer_style',
        'type'        => 'select',
        'desc'        => 'Select your footer style from different options',
        'choices'     => array(
          array(
            'label'       => 'Footer Style 1',
            'value'       => 'footer_style_1'
          ),
          array(
            'label'       => 'Footer Style 2',
            'value'       => 'footer_style_2'
          ),
          array(
            'label'       => 'Footer Style 3',
            'value'       => 'footer_style_3'
          ),
          array(
            'label'       => 'Footer Style 4',
            'value'       => 'footer_style_4'
          )
        ),
        'std'         => 'footer_style_1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Footer Style 1 & Style 2  Content',
        'id'          => 'footer12_content',
        'type'        => 'textarea-simple',
        'desc'        => 'It is look complicated but it is easy to edit. If you need any help, please use our documentation and support forum.',
        'std'         => '<div class="col-md-3 timer-wrap">
                            <h4>Frappe Consumption</h4>
                            <span class="timer">4451</span><span class="timer-icon pull-right"><i class="brankic1979-coffee icon-2x"></i></span>
                            <p>Yes! We love to drink frappe, especially with no sugar.</p>
                            </div>
                            <div class="col-md-3 timer-wrap">
                            <h4>Facebook Popularity</h4>
                            <span class="timer">10510</span><span class="timer-icon pull-right"><i class="mukam-face icon-2x"></i></span>
                            <p>Yes! We love to drink frappe, especially with no sugar.</p>
                            </div>
                            <div class="col-md-3 timer-wrap">
                            <h4>People Follow Me</h4>
                            <span class="timer">9980</span><span class="timer-icon pull-right"><i class="mukam-tweet icon-2x"></i></span>
                            <p>Yes! We love to drink frappe, especially with no sugar.</p>
                            </div>
                            <div class="col-md-3 timer-wrap"> 
                            <h4>Join our group on</h4>
                            <span class="timer">1026</span><span class="timer-icon pull-right"><i class="icon-linkedin icon-2x"></i></span>
                            <p>Yes! We love to drink frappe, especially with no sugar.</p>
                            </div>',
        'rows'        => '24',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Footer Style 3 Content',
        'id'          => 'footer3_content',
        'type'        => 'textarea-simple',
        'desc'        => 'It is look complicated but it is easy to edit. If you need any help, please use our documentation and support forum.',
        'std'         => '<div class="col-md-6"><p><i class="mukam-mobile icon-5x pull-left fixed-margin"></i>Customer Service<br><span>(+03) 123 456 78 90</span></p></div>
                          <div class="col-md-6"><p><i class="brankic1979-rocket icon-5x pull-left fixed-margin"></i>Believe in the power of design<br><span>Launch a Project</span></p></div>',
        'rows'        => '7',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ), 

      array(
        'label'       => 'Twitter User Name',
        'id'          => 'twitter_user_name',
        'type'        => 'text',
        'desc'        => 'Twitter User Name that you want show latest tweet',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Twitter Consumer Key',
        'id'          => 'consumer_key',
        'type'        => 'text',
        'desc'        => 'Your Twitter Consumer Key',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Twitter Consumer Secret',
        'id'          => 'consumer_secret',
        'type'        => 'text',
        'desc'        => 'Your Twitter Consumer Secret',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Twitter Access Token',
        'id'          => 'access_token',
        'type'        => 'text',
        'desc'        => 'Your Twitter Access Token',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Twitter Access Token Secret',
        'id'          => 'access_token_secret',
        'type'        => 'text',
        'desc'        => 'Your Twitter Access Token Secret',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
       array(
        'label'       => 'Show Widget Section',
        'id'          => 'show_widget',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to show widget section',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Show Copyright Section',
        'id'          => 'show_copyright',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to show copyright section',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
       array(
        'label'       => 'Copyright Text',
        'id'          => 'copyright_text',
        'type'        => 'textarea-simple',
        'desc'        => '',
        'std'         => 'Copyright © 2013 mukam. All rights reserved.',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      /*********************/
      /* Portfolio Section */
      /*********************/
      array(
        'label'       => 'Portfolio Header',
        'id'          => 'portfolio_header',
        'type'        => 'text',
        'desc'        => '',
        'std'         => 'Portfolio',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio_default'
      ),
      array(
        'label'       => 'Portfolio Caption',
        'id'          => 'portfolio_caption',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio_default'
      ),
      array(
        'label'       => 'Portfolio Style',
        'id'          => 'portfolio_style',
        'type'        => 'select',
        'desc'        => 'Select your blog style from different options',
        'choices'     => array(
          array(
            'label'       => 'Portfolio Classic',
            'value'       => 'portfolio_classic'
          ),
          array(
            'label'       => 'Portfolio Grid',
            'value'       => 'portfolio_grid'
          ),
          array(
            'label'       => 'Portfolio with Left Sidebar',
            'value'       => 'portfolio_leftsidebar'
          ),
          array(
            'label'       => 'Portfolio with Right Sidebar',
            'value'       => 'portfolio_rightsidebar'
          ),
          array(
            'label'       => 'Portfolio with Detail',
            'value'       => 'portfolio_detail'
          )
        ),
        'std'         => 'portfolio_classic',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio_default'
      ), 
      array(
        'label'       => 'Mail Chimp',
        'id'          => 'mailchimp',
        'type'        => 'text',
        'desc'        => 'To learn how to find your mailchimp url, please look documentation',
        'std'         => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'contact_default'
      ),
      array(
        'label'       => 'Main Font',
        'id'          => 'main_font',
        'type'        => 'typography2',
        'desc'        => 'Body font of Mukam, most of p tags get this font',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_options'
      ),
      array(
        'label'       => 'H Tags',
        'id'          => 'h_tags',
        'type'        => 'typography2',
        'desc'        => 'Titles get this font',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_options'
      ),
      array(
        'label'       => 'Header Menu',
        'id'          => 'header_menu',
        'type'        => 'typography3',
        'desc'        => 'Changes will effect your header menu.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_options'
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