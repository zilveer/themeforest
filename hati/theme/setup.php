<?php

class ASetup extends Acorn {

  static function setupTheme () {

    # Register Sidebars
    $names = array('Page Sidebar'); // 'Custom Sidebar A', 'Custom Sidebar B'

    if (self::get('widgetized-footer') || self::get('foot-sidebar-1'))
      $names[] = 'Footer Area I';
    
    if (self::get('widgetized-footer') || self::get('foot-sidebar-2'))
      $names[] = 'Footer Area II';
    
    if (self::get('widgetized-footer') || self::get('foot-sidebar-3'))
      $names[] = 'Footer Area III';
    
    if (self::get('widgetized-footer') || self::get('foot-sidebar-4'))
      $names[] = 'Footer Area IV';

    foreach ($names as $name) {
      
      $tag = 'h4';
      if ($name == 'Page Sidebar') $tag = 'h3';
      
      register_sidebar( array(
        'name' => $name,
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => "<$tag>",
        'after_title' => "</$tag>"));
    }

    # Post Formats Support
    $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'audio' );
    // add_theme_support ( 'post-formats', $formats );
    // add_post_type_support ( 'post', 'post-formats' );

    # Post Thumbnails Support
    add_theme_support ( 'post-thumbnails', array( 'page', 'item', 'post' ) );
    
    # Thumbnail Sizes
    set_post_thumbnail_size ( 294, 220, true );
    add_image_size ( 'large', 923, '', true );
    // add_image_size ( '300x200', 300, 200, true ); // 300x200 thumbnail

    # Load Translation Text Domain
    load_theme_textdomain( A_DOMAIN );
  }

  static function registerMenu () {
    register_nav_menu( 'menu-1', __( 'Menu 1st Column', A_DOMAIN ));
    register_nav_menu( 'menu-2', __( 'Menu 2nd Column', A_DOMAIN ));
    register_nav_menu( 'menu-3', __( 'Menu 3rd Column', A_DOMAIN ));
  }
  
  static function setupRSS () {
    if ( self::get('customfeed') )
      add_action ( 'wp_head', 'ASetup::generateCustomRSS' );
    else
      add_theme_support( 'automatic-feed-links' );
  }

  static function generateCustomRSS() {
    echo '<link rel="alternate" type="application/rss+xml" title="'. get_bloginfo( 'name' ) .'" href="'. self::get('customfeed', get_bloginfo( 'rss2_url' )) .'" />';
  }

  static function enqueueResources () {

    # Enqueue Basic Style
    wp_enqueue_style( 'style', A_URL .'/style.css' );

    # Enqueue Basic Script
    wp_enqueue_script( 'script', A_URL .'/script.js', array('jquery'), A_THEME_VER, true );
    if ( is_single() ) wp_enqueue_script( 'comment-reply' );
  }

  static function excerptLength ($length) { return 19; }
  
  static function excerptMore ($excerpt) { return str_replace('[...]', '&hellip;', $excerpt); }

  static function loginLogoImage () {
    $url = A_THEME_URL .'/img/login-logo.png';
    $url = self::get('login-logo', $url);
    echo "<style>#login h1 a { background-image:url('{$url}') }</style>\n";
  }
  
  static function loginLogoTitle () { return get_bloginfo( 'name' ); }

  static function loginLogoUrl () { return site_url(); }

  static function customGravatar ( $avatar_defaults ) {
    $avatar = A_THEME_URL .'/img/gravatar.png';
    $avatar_defaults[$avatar] = 'Simple (/theme/img/gravatar.png)';
    return $avatar_defaults;
  }
  
  static function customQuery ($q) {

    if ( $q->get('post_type') ) return; // $q->get('post_type') == 'nav_menu_item' 

    if (is_search())
      $q->set( 'post_type', 'post' ); // search posts only

    if (is_year() || is_tax())
      $q->set( 'post_type', 'item' ); // search in items

    return $q;
  }
}

/*--------------------------------------------------------------------------
  Theme Setup
/*------------------------------------------------------------------------*/

add_action ( 'after_setup_theme', 'ASetup::setupTheme' );

/*--------------------------------------------------------------------------
  Public (Front-end) Basic Styles & Scripts
/*------------------------------------------------------------------------*/

add_action ( 'wp_enqueue_scripts', 'ASetup::enqueueResources' );

/*--------------------------------------------------------------------------
  Register WP3.0+ Menus
/*------------------------------------------------------------------------*/

add_action ( 'init', 'ASetup::registerMenu' );

/*--------------------------------------------------------------------------
  Generate RSS Links
/*------------------------------------------------------------------------*/

add_action ( 'init', 'ASetup::setupRSS' );

/*--------------------------------------------------------------------------
  Custom Logos
/*------------------------------------------------------------------------*/

add_action ( 'login_head', 'ASetup::loginLogoImage' );
add_filter ( 'login_headertitle', 'ASetup::loginLogoTitle' );
add_filter ( 'login_headerurl', 'ASetup::loginLogoUrl' );

/*--------------------------------------------------------------------------
  Change Default Excerpt Length
/*------------------------------------------------------------------------*/

add_filter ( 'excerpt_length', 'ASetup::excerptLength' );

/*--------------------------------------------------------------------------
  Configure Excerpt String
/*------------------------------------------------------------------------*/

add_filter ( 'wp_trim_excerpt', 'ASetup::excerptMore' );

/*--------------------------------------------------------------------------
  Custom Gravatar Support ( Settings > Discussion )
/*------------------------------------------------------------------------*/

add_filter( 'avatar_defaults', 'ASetup::customGravatar' );

/*--------------------------------------------------------------------------
  Comment the next lines if you plan to use Windows Live Writer
/*------------------------------------------------------------------------*/

remove_action ('wp_head', 'rsd_link');
remove_action ('wp_head', 'wlwmanifest_link');
remove_action ('wp_head', 'wp_generator');

/*--------------------------------------------------------------------------
  Custom Theme Query
/*------------------------------------------------------------------------*/

add_filter ( 'pre_get_posts', 'ASetup::customQuery' );