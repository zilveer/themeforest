<?php
if (function_exists('register_sidebar')) {
    /**	Page Sidebars
     **/
    register_sidebar(array(
        'id' => 'sidebar-page',
        'name' => __('Sidebar Page', 'clubber'),
        'description' => __('Page sidebar', 'clubber'),
        'before_title' => '
    <div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
  <div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
  </div><br/>'
    ));
}
/** Footer sidebar
 **/
register_sidebar(array(
    'id' => 'footer-left',
    'name' => __('Footer Widget 1', 'clubber'),
    'description' => __('In the footer the left column', 'clubber'),
    'before_title' => '
        <h3>',
    'after_title' => '</h3>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
register_sidebar(array(
    'id' => 'footer-center-left',
    'name' => __('Footer Widget 2', 'clubber'),
    'description' => __('In the footer the center left column', 'clubber'),
    'before_title' => '
        <h3>',
    'after_title' => '</h3>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
register_sidebar(array(
    'id' => 'footer-center-right',
    'name' => __('Footer Widget 3', 'clubber'),
    'description' => __('In the footer the center right column', 'clubber'),
    'before_title' => '
        <h3>',
    'after_title' => '</h3>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
register_sidebar(array(
    'id' => 'footer-right',
    'name' => __('Footer Widget 4', 'clubber'),
    'description' => __('In the footer the left column', 'clubber'),
    'before_title' => '<h3>',
    'after_title' => '</h3>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
?>