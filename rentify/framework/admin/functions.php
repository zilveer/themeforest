<?php


if ( ! isset( $content_width ) )
  $content_width = 1140;




/*-------------------------------------------------------------------------
  START REGISTER sb SIDEBARS
------------------------------------------------------------------------- */

if ( ! function_exists( 'rentify_sidebar' ) ) {


function rentify_sidebar() {

  $args = array(
    'id'            => 'mainsidebar',
    'name'          => __( 'Blog Page Sidebar', 'sb' ),   
    'description'   => __('Put your main sidebar widgets here','sb'),  
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5 class="sidebar-title">',
    'after_title'   => '</h5>',
  );

  register_sidebar( $args );

   $footer_left_sidebar = array(

    'id'            => 'sb_footer_left_sidebar',
    'name'          => __( 'Footer Left Sidebar', 'sb' ),
    'description'   => __('Put your widgets here that show on footer left side area','sb'),    
    'before_widget' => '<div class="col-md-3 col-sm-6">',
    'after_widget'  => '</div>', 
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  register_sidebar( $footer_left_sidebar );

  $footer_middle_sidebar = array(

    'id'            => 'sb_footer_middle_sidebar',
    'name'          => __( 'Footer Middle Sidebar', 'sb' ),
    'description'   => __('Put your widgets here that show on footer middle area','sb'), 
    'before_widget' => '<div class="col-md-3 col-sm-6">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  register_sidebar( $footer_middle_sidebar );


 $footer_right_sidebar = array(
    'id'            => 'sb_footer_right_sidebar',
    'name'          => __( 'Footer Right Sidebar', 'sb' ),
    'description'   => __('Put your widgets here that show on footer right side area example(newsletter)','sb'), 
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  );

  register_sidebar( $footer_right_sidebar );

  $footer_down_sidebar = array(
    'id'            => 'sb_footer_down_sidebar',
    'name'          => __( 'Footer Down Sidebar', 'sb' ),
    'description'   => __('Put your widgets here that show on footer down side area example(contact info)','sb'), 
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  );

  register_sidebar( $footer_down_sidebar );

 $footer_extra_middle_sidebar = array(
    'id'            => 'sb_footer_extra_middle_sidebar',
    'name'          => __( 'Footer Extra Middle Sidebar', 'sb' ),
    'description'   => __('Put your widgets here that show on footer extra middle side area','sb'), 
    'before_widget' => '<div class="col-sm-4">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',
  );

  register_sidebar( $footer_extra_middle_sidebar );

}

add_action( 'widgets_init', 'rentify_sidebar' );

}

/*-------------------------------------------------------------------------
  END RESGISTER sb SIDEBARS
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START RESGISTER NAVIGATION MENUS FOR sb
 ------------------------------------------------------------------------- */   

function rentify_custom_navigation_menus() {

  $locations = array(
    'primary_navigation_left'   => __('Primary Menu Left','rentify'),
    'primary_navigation_right'  => __('Primary Menu Right','rentify'), 
    'primary_navigation_footer' => __('Primary Menu footer','rentify'), 
    'primary_navigation_mobile' => __('Primary Menu mobile','rentify'), 
  );

  register_nav_menus( $locations );

}

add_action( 'init', 'rentify_custom_navigation_menus' );



/*-------------------------------------------------------------------------
  END REGISTER NAVIGATION MENUS FOR  sb
 ------------------------------------------------------------------------- */ 


 /*-------------------------------------------------------------------------
  START SIMPLE BUILDER CUSTOM CSS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'rentify_custom_css' );

function rentify_custom_css() {
  $rentify_option_data = rentify_option_data();
  if(isset($rentify_option_data['sb-custom-css'])){
    echo "<style>" . $rentify_option_data['sb-custom-css'] . "</style>";  
  } 
  
}


/*-------------------------------------------------------------------------
  END SIMPLE BUILDER AUTORENT CUSTOM CSS END
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START SIMPLE BUILDER CUSTOM JS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'rentify_custom_js' );

function rentify_custom_js() {
  $rentify_option_data = rentify_option_data();
  if(isset($rentify_option_data['sb-custom-js'])){
    echo "<script>" . $rentify_option_data['sb-custom-js'] . "</script>";  
  }
  
}

/*-------------------------------------------------------------------------
  END SIMPLE BUILDER CUSTOM JS END
------------------------------------------------------------------------- */




