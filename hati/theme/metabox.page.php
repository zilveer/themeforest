<?php

/*--------------------------------------------------------------------------
  Setup Page Metaboxes
/*------------------------------------------------------------------------*/

class APageMetabox extends AMetabox {

  static function getMenuList () {

    $menus = array('');
    foreach (wp_get_nav_menus() as $menu)
      $menus[$menu->name] = $menu->name;

    return $menus;
  }
  
  static function getTypeList () {

    $types = array('' => 'Disabled');
    foreach (get_terms('item-type') as $type)
      $types[$type->term_id] = $type->name;

    return $types;
  }
  
  static function getPagesList () {
    
    $pages = array();
    foreach (get_pages() as $page)
      $pages[$page->ID] = $page->post_title;
    
    return $pages;
  }

  static function init () {
    
    # Subheading
    
    parent::$boxes[] = array(

      'page'    => 'page',
      'context' => 'normal',
      'priority'=> 'core',
      'class'   => 'hidden show-for-template-archives-php show-for-template-contact-php show-for-default show-for-template-page-sidebar-php',

      'title'   => __('Custom Page Subheading', A_DOMAIN),
      'desc'    => '',

      'fields'  => array(
        
        array(
          'name'=> __('Subheading', A_DOMAIN),
          'desc'=> '',
          'id'  => 'subheading',
          'std' => '',
          'type'=> 'text' )
      )
    );
    
    # Contact Page Settings

    parent::$boxes[] = array(

      'page'    => 'page',
      'context' => 'normal',
      'priority'=> 'core',
      'class'   => 'hidden show-for-template-contact-php',

      'title'   => __('Contact Page Settings', A_DOMAIN),
      'desc'    => __('Setup the map settings here. For the page content use Shortcode Manager &gt; Contact Page.', A_DOMAIN),

      'fields'  => array(
        
        # starting field id with '_' hiding it from custom fields box

        array(
          'name'=> __('Map Title', A_DOMAIN),
          'desc'=> '',
          'id'  => '_map-title',
          'std' => 'Find Us',
          'type'=> 'text' ),
        
        array(
          'name'=> __('Map Description', A_DOMAIN),
          'desc'=> '',
          'id'  => '_map-descr',
          'std' => 'First Line | Second Line',
          'type'=> 'text' ),

        array(
          'name'=> __('Map Latitude', A_DOMAIN),
          'desc'=> '',
          'id'  => '_map-lat',
          'std' => '51.508',
          'type'=> 'text' ),

        array(
          'name'=> __('Map Longitude', A_DOMAIN),
          'desc'=> __("Don't drop leading '+' or '-' if available", A_DOMAIN),
          'id'  => '_map-long',
          'std' => '-0.128',
          'type'=> 'text' ),

        array(
          'name'=> __('Map Zoom', A_DOMAIN),
          'desc'=> '',
          'id'  => '_map-zoom',
          'std' => 17,
          'type'=> 'select',
          'opts'=> array(
            19 => __('City Bird', A_DOMAIN),
            17 => __('Hot Air Balloon', A_DOMAIN),
            15 => __('Corporate Helicopter', A_DOMAIN),
            13 => __('Aeroplane', A_DOMAIN),
            9 => __('Sputnik', A_DOMAIN))),

        array(
          'name'=> __('Map Style', A_DOMAIN),
          'desc'=> '',
          'id'  => '_map-style',
          'std' => '',
          'type'=> 'select',
          'opts'=> array(
            __('Google Default', A_DOMAIN),
            A_THEME_NAME.__(' Special', A_DOMAIN)))
        
      )
    );
    
    # Homepage Slide Setup
    
    $pre = '&nbsp;&#8627;&nbsp;';

    parent::$boxes[] = array(

      'page'    => 'page',
      'context' => 'normal',
      'priority'=> 'default',
      'class'   => 'hidden show-for-template-homepage-php show-for-template-homepage-6-php',

      'title'   => __('Homepage Slide Setup', A_DOMAIN),
      'desc'    => __('Setup the homepage slides here. For the page content use Shortcode Manager &gt; Homepage.', A_DOMAIN),

      'fields'  => array(
        
        array(
          'name'=> __('Slide Image I', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_1_img',
          'std' => A_THEME_URL . '/img/slide.jpg',
          'type'=> 'text')

        ,array(
          'std' => __('Upload', A_DOMAIN), 'type' => 'button' )
  
        ,array(
          'name'=> $pre.__('Title', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_1_h3',
          'std' => __('Slide Title', A_DOMAIN),
          'type'=> 'text')
  
        ,array(
          'name'=> $pre.__('Description', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_1_h2',
          'std' => __('Slide Description', A_DOMAIN),
          'type'=> 'text')
    
        ,array(
          'name'=> $pre.__('URL', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_1_link',
          'std' => '',
          'type'=> 'text')


        ,array(
          'name'=> __('Slide Image II', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_2_img',
          'std' => '',
          'type'=> 'text')

        ,array(
          'std' => __('Upload', A_DOMAIN), 'type' => 'button' )
  
        ,array(
          'name'=> $pre.__('Title', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_2_h3',
          'std' => '',
          'type'=> 'text')
  
        ,array(
          'name'=> $pre.__('Description', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_2_h2',
          'std' => '',
          'type'=> 'text')
    
        ,array(
          'name'=> $pre.__('URL', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_2_link',
          'std' => '',
          'type'=> 'text')
          
          
        ,array(
          'name'=> __('Slide Image III', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_3_img',
          'std' => '',
          'type'=> 'text')

        ,array(
          'std' => __('Upload', A_DOMAIN), 'type' => 'button' )
  
        ,array(
          'name'=> $pre.__('Title', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_3_h3',
          'std' => '',
          'type'=> 'text')
  
        ,array(
          'name'=> $pre.__('Description', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_3_h2',
          'std' => '',
          'type'=> 'text')
    
        ,array(
          'name'=> $pre.__('URL', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_3_link',
          'std' => '',
          'type'=> 'text')

        
        ,array( 'id' => 'Slider Timeout', 'std' => 10, 'type'=> 'custom')
        ,array( 'id' => 'Slider Speed', 'std' => 0.85, 'type'=> 'custom')

      )
    );

    parent::$boxes[] = array(

      'page'    => 'page',
      'context' => 'normal',
      'priority'=> 'default',
      'class'   => 'hidden show-for-template-homepage-6-php',

      'title'   => __('Homepage Slide Setup #2', A_DOMAIN),
      'desc'    => '',

      'fields'  => array(
        
        array(
          'name'=> __('Slide Image IV', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_4_img',
          'std' => '',
          'type'=> 'text')

        ,array(
          'std' => __('Upload', A_DOMAIN), 'type' => 'button' )
  
        ,array(
          'name'=> $pre.__('Title', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_4_h3',
          'std' => '',
          'type'=> 'text')
  
        ,array(
          'name'=> $pre.__('Description', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_4_h2',
          'std' => '',
          'type'=> 'text')
    
        ,array(
          'name'=> $pre.__('URL', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_4_link',
          'std' => '',
          'type'=> 'text')


        ,array(
          'name'=> __('Slide Image V', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_5_img',
          'std' => '',
          'type'=> 'text')

        ,array(
          'std' => __('Upload', A_DOMAIN), 'type' => 'button' )
  
        ,array(
          'name'=> $pre.__('Title', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_5_h3',
          'std' => '',
          'type'=> 'text')
  
        ,array(
          'name'=> $pre.__('Description', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_5_h2',
          'std' => '',
          'type'=> 'text')
    
        ,array(
          'name'=> $pre.__('URL', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_5_link',
          'std' => '',
          'type'=> 'text')
          
          
        ,array(
          'name'=> __('Slide Image VI', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_6_img',
          'std' => '',
          'type'=> 'text')

        ,array(
          'std' => __('Upload', A_DOMAIN), 'type' => 'button' )
  
        ,array(
          'name'=> $pre.__('Title', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_6_h3',
          'std' => '',
          'type'=> 'text')
  
        ,array(
          'name'=> $pre.__('Description', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_6_h2',
          'std' => '',
          'type'=> 'text')
    
        ,array(
          'name'=> $pre.__('URL', A_DOMAIN),
          'desc'=> '',
          'id'  => '_slide_6_link',
          'std' => '',
          'type'=> 'text')

      )
    );

  }
}

/*--------------------------------------------------------------------------
  Register This Metabox
/*------------------------------------------------------------------------*/

add_action ( 'admin_init', 'APageMetabox::init' );
