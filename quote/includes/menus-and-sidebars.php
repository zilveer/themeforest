<?php 

//==========================================================
// ===  MENUS
//==========================================================
register_nav_menus( array(
    'primary'   => __('Primary', DISTINCTIVETHEMESTEXTDOMAIN),
    'single-page'    => __('Single Page', DISTINCTIVETHEMESTEXTDOMAIN)
));

require_once( get_template_directory()  . '/includes/navwalker.php');
require_once( get_template_directory()  . '/includes/mobile-navwalker.php');

//==========================================================
// ===  SIDEBARS
//==========================================================
register_sidebar(array(
  'name' => __( 'Sidebar', DISTINCTIVETHEMESTEXTDOMAIN ),
  'id' => 'sidebar',
  'description' => __( 'Widgets in this area will be shown on right side.', DISTINCTIVETHEMESTEXTDOMAIN ),
  'before_title' => '<h3 class="widget-title">',
  'after_title' => '</h3>',
  'before_widget' => '<div class="widget">',
  'after_widget' => '</div>'
  )
);

register_sidebar(array(
  'name' => __( 'Footer', DISTINCTIVETHEMESTEXTDOMAIN ),
  'id' => 'footer',
  'description' => __( 'Widgets in this area will be shown in the Footer.' , DISTINCTIVETHEMESTEXTDOMAIN),
  'before_title' => '<h3 class="widget-title">',
  'after_title' => '</h3>',
  'before_widget' => '<div class="widget col-lg-4 col-md4 col-sm-6 col-xs-12">',
  'after_widget' => '</div>'
  )
);

?>