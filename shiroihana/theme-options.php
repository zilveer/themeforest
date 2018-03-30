<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
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
        'id'          => 'widget_areas',
        'title'       => __( 'Widget Areas', 'shiroi' )
      ),
      array(
        'id'          => 'addthis',
        'title'       => __( 'AddThis', 'shiroi' )
      ),
      array(
        'id'          => 'social',
        'title'       => __( 'Social', 'shiroi' )
      ),
      array(
        'id'          => 'styling',
        'title'       => __( 'Styling', 'shiroi' )
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'custom_widget_areas',
        'label'       => __( 'Widget Areas', 'shiroi' ),
        'desc'        => __( 'Specify here the custom widget areas to register.', 'shiroi' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'widget_areas',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'description',
            'label'       => __( 'Description', 'shiroi' ),
            'desc'        => __( 'Enter here the widget area description.', 'shiroi' ),
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'addthis_sharing_buttons',
        'label'       => __( 'Sharing Buttons', 'shiroi' ),
        'desc'        => __( 'Enter a comma separated list of AddThis social media sharing buttons to show at the end of each item page.
See this for available buttons: <a href="http://www.addthis.com/services/list">www.addthis.com/services/list</a>', 'shiroi' ),
        'std'         => 'facebook_like, tweet, google_plusone, facebook, twitter, email, compact',
        'type'        => 'text',
        'section'     => 'addthis',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'addthis_profile_id',
        'label'       => __( 'Profile ID', 'shiroi' ),
        'desc'        => __( 'Specify here your AddThis profile ID if you want to track your AddThis sharing data.', 'shiroi' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'addthis',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'social_profiles',
        'label'       => __( 'Social Profiles', 'shiroi' ),
        'desc'        => __( 'Enter here a list of sitewide social profiles.', 'shiroi' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'url',
            'label'       => __( 'URL', 'shiroi' ),
            'desc'        => __( 'Enter here the social profile URL.', 'shiroi' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'icon',
            'label'       => __( 'Icon', 'shiroi' ),
            'desc'        => __( 'Choose here the social profile icon.', 'shiroi' ),
            'std'         => '',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'custom_css',
        'label'       => __( 'Custom CSS', 'shiroi' ),
        'desc'        => __( 'Enter here your custom CSS code to be applied to the whole site.', 'shiroi' ),
        'std'         => '',
        'type'        => 'css',
        'section'     => 'styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}