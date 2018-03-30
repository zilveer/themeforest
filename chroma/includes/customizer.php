<?php

/*-----------------------------------------------------------------------------------*/
/*	Theme customizer
/*-----------------------------------------------------------------------------------*/

function t2t_customizer_admin() {
  global $wp_version;

  if (version_compare($wp_version, '3.5', '<=')) {
	 add_theme_page('Customize', 'Customize', 'edit_theme_options', 'customize.php'); 
  }
}
add_action ('admin_menu', 't2t_customizer_admin');

function t2t_customize_register($wp_customize) {

  class T2T_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}

  class T2T_Customize_Separator extends WP_Customize_Control {
   
      public function render_content() {
          ?>
          <hr />
          <?php
      }
  }

  class T2T_Customize_Description extends WP_Customize_Control {
   
      public function render_content() {
          ?>
          <span style="padding: 8px; font-size: 11px; background: #f2f2f2; display: block; color: #777;"><?php echo $this->label; ?></span>
          <?php
      }
  }

  // Options
  $wp_customize->add_section('t2t_watercolor_styling', array(
      'title' => __('Theme Options', 'framework'),
      'description' => '',
      'priority' => 100
  ));
  
  $wp_customize->add_setting('t2t_customizer_logo_height', array('default' => '55'));
  $wp_customize->add_control('t2t_customizer_logo_height', array(
    'label' => __('Logo Height (in pixels).', 'framework'),
    'settings' => 't2t_customizer_logo_height',
    'section' => 't2t_watercolor_styling',
    'type' => 'text',
    'priority' => 3
  ));  

  $wp_customize->add_setting('t2t_customizer_full_width_column_width', array('default' => '280'));
  $wp_customize->add_control('t2t_customizer_full_width_column_width', array(
    'label' => __('Full Width Column Width (in pixels).', 'framework'),
    'settings' => 't2t_customizer_full_width_column_width',
    'section' => 't2t_watercolor_styling',
    'type' => 'text',
    'priority' => 5
  ));  

  // Logo upload
  $wp_customize->add_setting('t2t_customizer_logo', array());
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 't2t_customizer_logo', array(
		'label' => __('Logo Upload', 'framework'),
		'section' => 't2t_watercolor_styling',
		'settings' => 't2t_customizer_logo',
		'priority' => 6
	)));

  $wp_customize->add_setting('t2t_customizer_retina_logo', array());
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 't2t_customizer_retina_logo', array(
    'label' => __('Retina Logo Upload', 'framework'),
    'section' => 't2t_watercolor_styling',
    'settings' => 't2t_customizer_retina_logo',
    'priority' => 7
  )));
	
	// Favicon upload
  $wp_customize->add_setting('t2t_customizer_favicon', array());
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 't2t_customizer_favicon', array(
		'label' => __('Favicon Upload', 'framework'),
		'section' => 't2t_watercolor_styling',
		'settings' => 't2t_customizer_favicon',
		'priority' => 8
	)));

  // Header layout
  $wp_customize->add_setting('t2t_customizer_header_layout', array('default' => 'vertical'));
  $wp_customize->add_control('t2t_customizer_header_layout', array(
    'label' => __('Header Layout', 'framework'),
    'settings' => 't2t_customizer_header_layout',
    'section' => 't2t_watercolor_styling',
    'type' => 'select',
    'choices' => array(
      'vertical'     => 'Vertical (Side Navigation)',
      'horizontal'   => 'Horizontal (Top Navigation)'
    ),
    'priority' => 9
  ));

  // Accent color
  $wp_customize->add_setting('t2t_customizer_accent_color', array('default' => '#278ea9'));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 't2t_customizer_accent_color', array(
    'label'        => __('Accent Color', 'framework'),
    'section'    => 't2t_watercolor_styling',
    'settings'   => 't2t_customizer_accent_color',
		'priority' => 9
  )));

  // Hide photo sidebar
  $wp_customize->add_setting('t2t_hide_photo_sidebar', array('default' => false));
  $wp_customize->add_control('t2t_hide_photo_sidebar', array(
    'label'        => __('Hide sidebar on photo page?', 'framework'),
    'type'         => 'checkbox',
    'section'      => 't2t_watercolor_styling',
    'priority' => 10
  ));

  // Disable social sharing
  $wp_customize->add_setting('t2t_disable_social_sharing', array('default' => false));
  $wp_customize->add_control('t2t_disable_social_sharing', array(
    'label'        => __('Disable social sharing?', 'framework'),
    'type'         => 'checkbox',
    'section'      => 't2t_watercolor_styling',
    'priority' => 10
  ));
  
  // Footer always visible
  $wp_customize->add_setting('t2t_footer_visible', array('default' => false));
  $wp_customize->add_control('t2t_footer_visible', array(
    'label'        => __('Always show footer?', 'framework'),
    'type'         => 'checkbox',
    'section'      => 't2t_watercolor_styling',
    'priority' => 10
  ));

  // Disable right click
  $wp_customize->add_setting('t2t_disable_right_click', array('default' => false));
  $wp_customize->add_control('t2t_disable_right_click', array(
    'label'        => __('Disable Right Clicking?', 'framework'),
    'type'         => 'checkbox',
    'section'      => 't2t_watercolor_styling',
    'priority' => 11
  ));
  
  // Custom CSS
  $wp_customize->add_setting('t2t_customizer_css', array());
  $wp_customize->add_control( new T2T_Customize_Textarea_Control( $wp_customize, 't2t_customizer_css', array(
    'label'   => 'Custom CSS',
    'section' => 't2t_watercolor_styling',
    'settings'   => 't2t_customizer_css',
		'priority' => 12
  )));  
  
  // Custom JS
  $wp_customize->add_setting('t2t_customizer_js', array());
  $wp_customize->add_control( new T2T_Customize_Textarea_Control( $wp_customize, 't2t_customizer_js', array(
    'label'   => 'Custom JS',
    'section' => 't2t_watercolor_styling',
    'settings'   => 't2t_customizer_js',
		'priority' => 13
  )));  
  
  // Analytics code
  $wp_customize->add_setting('t2t_customizer_analytics', array());
  $wp_customize->add_control( new T2T_Customize_Textarea_Control( $wp_customize, 't2t_customizer_analytics', array(
    'label'   => 'Analytics Code',
    'section' => 't2t_watercolor_styling',
    'settings'   => 't2t_customizer_analytics',
		'priority' => 14
  )));

  // Copyright
  $wp_customize->add_setting('t2t_customizer_copyright', array());
  $wp_customize->add_control('t2t_customizer_copyright', array(
    'label' => __('Copyright', 'framework'),
    'settings' => 't2t_customizer_copyright',
    'section' => 't2t_watercolor_styling',
    'type' => 'text',
    'priority' => 15
  ));  


  // Theme backgrounds
  $wp_customize->add_section('t2t_watercolor_backgrounds', array(
      'title' => __('Theme Backgrounds', 'framework'),
      'description' => '',
      'priority' => 101
  ));

  // Page title background
  $wp_customize->add_setting('t2t_customizer_page_header_background', array());
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 't2t_customizer_page_header_background', array(
    'label' => __('Page Header Background', 'framework'),
    'section' => 't2t_watercolor_backgrounds',
    'settings' => 't2t_customizer_page_header_background',
    'priority' => 9
  )));

  $wp_customize->add_setting('t2t_customizer_page_header_background_repeat', array('default' => 'repeat'));
  $wp_customize->add_control('t2t_customizer_page_header_background_repeat', array(
    'label' => __('Page Header Background Repeat', 'framework'),
    'settings' => 't2t_customizer_page_header_background_repeat',
    'section' => 't2t_watercolor_backgrounds',
    'type' => 'select',
    'choices' => array(
      'no-repeat top left' => 'No Repeat (Left Aligned)',
      'no-repeat top center' => 'No Repeat (Center Aligned)',
      'no-repeat top right' => 'No Repeat (Right Aligned)',
      'repeat'    => 'Tile',
      'repeat-x'  => 'Tile Horizontally',
      'repeat-y'  => 'Tile Vertically',
      'stretch'   => 'Stretch'
    ),
    'priority' => 10
  ));

  $wp_customize->add_setting('t2t_customizer_page_header_background_color', array('default' => '#777777'));
  
  $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 't2t_customizer_page_header_background_color', array(
    'label'      => __("Page Header Background Color", 'framework'),
    'section'    => 't2t_watercolor_backgrounds',
    'settings'   => 't2t_customizer_page_header_background_color',
    'priority' => 11
  )));

  $wp_customize->add_setting('t2t_header_page_header_background_separator', array());
  $wp_customize->add_control( new T2T_Customize_Separator( $wp_customize, 't2t_header_page_header_background_separator', array(
    'section' => 't2t_watercolor_backgrounds',
    'priority' => 12
  )));  


  // Page background
  $wp_customize->add_setting('t2t_customizer_page_background', array('default' => '#f2f2f2'));
  $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 't2t_customizer_page_background', array(
    'label' => __('Page Background', 'framework'),
    'settings' => 't2t_customizer_page_background',
    'section' => 't2t_watercolor_backgrounds',
    'context' => 't2t_customizer_page_background',
    'priority' => 13
  )));

  $wp_customize->add_setting('t2t_customizer_page_background_repeat', array('default' => 'repeat'));
  $wp_customize->add_control('t2t_customizer_page_background_repeat', array(
    'label' => __('Page Background Repeat', 'framework'),
    'settings' => 't2t_customizer_page_background_repeat',
    'section' => 't2t_watercolor_backgrounds',
    'type' => 'select',
    'choices' => array(
      'no-repeat top left' => 'No Repeat (Left Aligned)',
      'no-repeat top center' => 'No Repeat (Center Aligned)',
      'no-repeat top right' => 'No Repeat (Right Aligned)',
      'repeat'    => 'Tile',
      'repeat-x'  => 'Tile Horizontally',
      'repeat-y'  => 'Tile Vertically',
      'stretch'   => 'Stretch'
    ),
    'priority' => 14
  ));

  $wp_customize->add_setting('t2t_customizer_page_background_color', array('default' => '#ffffff'));
  
  $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 't2t_customizer_page_background_color', array(
    'label'      => __("Page Background Color", 'framework'),
    'section'    => 't2t_watercolor_backgrounds',
    'settings'   => 't2t_customizer_page_background_color',
    'priority' => 15
  )));

  $wp_customize->add_setting('t2t_header_page_background_separator', array());
  $wp_customize->add_control( new T2T_Customize_Separator( $wp_customize, 't2t_header_page_background_separator', array(
    'section' => 't2t_watercolor_backgrounds',
    'priority' => 16
  )));  

  // Footer background
  $wp_customize->add_setting('t2t_customizer_footer_background', array());
  $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 't2t_customizer_footer_background', array(
    'label' => __('Footer Background', 'framework'),
    'settings' => 't2t_customizer_footer_background',
    'section' => 't2t_watercolor_backgrounds',
    'priority' => 17
  )));

  $wp_customize->add_setting('t2t_customizer_footer_background_repeat', array('default' => 'repeat'));
  $wp_customize->add_control('t2t_customizer_footer_background_repeat', array(
    'label' => __('Footer Background Repeat', 'framework'),
    'settings' => 't2t_customizer_footer_background_repeat',
    'section' => 't2t_watercolor_backgrounds',
    'type' => 'select',
    'choices' => array(
      'no-repeat top left' => 'No Repeat (Left Aligned)',
      'no-repeat top center' => 'No Repeat (Center Aligned)',
      'no-repeat top right' => 'No Repeat (Right Aligned)',
      'repeat'    => 'Tile',
      'repeat-x'  => 'Tile Horizontally',
      'repeat-y'  => 'Tile Vertically',
      'stretch'   => 'Stretch'
    ),
    'priority' => 18
  ));

  $wp_customize->add_setting('t2t_customizer_footer_background_color', array('default' => '#ffffff'));
  
  $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 't2t_customizer_footer_background_color', array(
    'label'      => __("Footer Background Color", 'framework'),
    'section'    => 't2t_watercolor_backgrounds',
    'settings'   => 't2t_customizer_footer_background_color',
    'priority' => 19
  )));

  // Theme colors
  $color_options = array(
    "Accent Color" => array(
      "id" => "accent_color",
      "default" => "#1e7c8b"
    ),
    "Logo Color" => array(
      "id" => "logo_color",
      "default" => "#ffffff"
    ),
    "Header Menu Link" => array(
      "id" => "header_menu_link_color",
      "default" => "#ffffff"
    ),
    "Header Menu Link Hover" => array(
      "id" => "header_menu_link_hover_color",
      "default" => "#ffffff"
    ),
    "Menu Background Color" => array(
      "id" => "menu_background_color",
      "default" => "#282828"
    ),
    "Menu Link Color" => array(
      "id" => "menu_link_color",
      "default" => "#979797"
    ),
    "Menu Link Hover Color" => array(
      "id" => "menu_link_hover_color",
      "default" => "#ffffff"
    ),
    "Page Title Text" => array(
      "id" => "page_title_text_color",
      "default" => "#ffffff"
    ),
    "Body Text" => array(
      "id" => "body_text_color",
      "default" => "#777777"
    ),
    "Paragraph" => array(
      "id" => "paragraph_color",
      "default" => "#777777"
    ),
    "Content Link" => array(
      "id" => "content_link_color",
      "default" => "#595959"
    ),
    "Content Link Hover" => array(
      "id" => "content_link_hover_color",
      "default" => "#333333"
    ),
    "Content Box Background" => array(
      "id" => "content_box_background_color",
      "default" => "#ffffff"
    ),
    "Content Box Border" => array(
      "id" => "content_box_border_color",
      "default" => "#e7e7e7"
    ),
    "Sidebar Title" => array(
      "id" => "sidebar_title_color",
      "default" => "#999999"
    ),
    "Sidebar Text" => array(
      "id" => "sidebar_text_color",
      "default" => "#666666"
    ),
    "Sidebar Link" => array(
      "id" => "sidebar_link_color",
      "default" => "#999999"
    ),
    "Sidebar Link Hover" => array(
      "id" => "sidebar_link_hover_color",
      "default" => "#444444"
    ),
    "Footer Title" => array(
      "id" => "footer_title_color",
      "default" => "#666666"
    ),
    "Footer Text" => array(
      "id" => "footer_text_color",
      "default" => "#999999"
    ),
    "Footer Link" => array(
      "id" => "footer_link_color",
      "default" => "#999999"
    ),
    "Footer Link Hover" => array(
      "id" => "footer_link_hover_color",
      "default" => "#444444"
    )
  );
  $color_priority = 0;   

  $wp_customize->add_section('t2t_watercolor_colors', array(
      'title' => __('Theme Colors', 'framework'),
      'description' => '',
      'priority' => 102
  ));

  foreach($color_options as $name => $settings) {

    $wp_customize->add_setting('t2t_customizer_'.$settings["id"], array('default' => $settings["default"]));
    
    $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 't2t_customizer_'.$settings["id"], array(
      'label'      => __($name, 'framework'),
      'section'    => 't2t_watercolor_colors',
      'settings'   => 't2t_customizer_'.$settings["id"],
      'priority' => $color_priority
    )));

    ++$color_priority;
  }
  
  // Social options
  $wp_customize->add_section('t2t_watercolor_social', array(
      'title' => __('Theme Social Options', 'framework'),
      'description' => __('Adds social icons to the footer of your site.', 'framework'),
      'priority' => 103
  ));

  $wp_customize->add_setting('t2t_customizer_social_style', array('default' => 'rounded'));
  $wp_customize->add_control('t2t_customizer_social_style', array(
    'label' => __('Icon Style', 'framework'),
    'settings' => 't2t_customizer_social_style',
    'section' => 't2t_watercolor_social',
    'type' => 'select',
    'choices' => array(
      'rounded' => 'Rounded',
      'circular' => 'Outline',
      'simple' => 'Simple'
    ),
    'priority' => 0
  ));
  
  $wp_customize->add_setting('t2t_customizer_social_twitter', array());
  $wp_customize->add_control('t2t_customizer_social_twitter', array(
    'label' => __('Twitter URL', 'framework'),
    'settings' => 't2t_customizer_social_twitter',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
		'priority' => 1
  ));
  $wp_customize->add_setting('t2t_customizer_social_facebook', array());
  $wp_customize->add_control('t2t_customizer_social_facebook', array(
    'label' => __('Facebook URL', 'framework'),
    'settings' => 't2t_customizer_social_facebook',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 2
  ));  
  $wp_customize->add_setting('t2t_customizer_social_flickr', array());
  $wp_customize->add_control('t2t_customizer_social_flickr', array(
    'label' => __('Flickr URL', 'framework'),
    'settings' => 't2t_customizer_social_flickr',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 3
  ));  
  $wp_customize->add_setting('t2t_customizer_social_github', array());
  $wp_customize->add_control('t2t_customizer_social_github', array(
    'label' => __('GitHub URL', 'framework'),
    'settings' => 't2t_customizer_social_github',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 4
  ));  
  $wp_customize->add_setting('t2t_customizer_social_vimeo', array());
  $wp_customize->add_control('t2t_customizer_social_vimeo', array(
    'label' => __('Vimeo URL', 'framework'),
    'settings' => 't2t_customizer_social_vimeo',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 6
  ));  
  $wp_customize->add_setting('t2t_customizer_social_pinterest', array());
  $wp_customize->add_control('t2t_customizer_social_pinterest', array(
    'label' => __('Pinterest URL', 'framework'),
    'settings' => 't2t_customizer_social_pinterest',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 8
  ));  
  $wp_customize->add_setting('t2t_customizer_social_linkedin', array());
  $wp_customize->add_control('t2t_customizer_social_linkedin', array(
    'label' => __('LinkedIn URL', 'framework'),
    'settings' => 't2t_customizer_social_linkedin',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 9
  ));  
  $wp_customize->add_setting('t2t_customizer_social_dribbble', array());
  $wp_customize->add_control('t2t_customizer_social_dribbble', array(
    'label' => __('Dribbble URL', 'framework'),
    'settings' => 't2t_customizer_social_dribbble',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 10
  ));  
  $wp_customize->add_setting('t2t_customizer_social_lastfm', array());
  $wp_customize->add_control('t2t_customizer_social_lastfm', array(
    'label' => __('Last.fm URL', 'framework'),
    'settings' => 't2t_customizer_social_lastfm',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 12
  ));  
  $wp_customize->add_setting('t2t_customizer_social_skype', array());
  $wp_customize->add_control('t2t_customizer_social_skype', array(
    'label' => __('Skype URL', 'framework'),
    'settings' => 't2t_customizer_social_skype',
    'section' => 't2t_watercolor_social',
    'type' => 'text',
    'priority' => 15
  )); 
 $wp_customize->add_setting('t2t_customizer_social_email', array());
 $wp_customize->add_control('t2t_customizer_social_email', array(
   'label' => __('Email Address', 'framework'),
   'settings' => 't2t_customizer_social_email',
   'section' => 't2t_watercolor_social',
   'type' => 'text',
   'priority' => 16
 ));
  
}
add_action('customize_register', 't2t_customize_register');

?>