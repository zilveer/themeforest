<?php
if (function_exists('register_sidebar')) {
/**	Page Sidebars
 **/
    register_sidebar(array(
        'id' => 'sidebar-page',
        'name' => __('Page Sidebar', 'wizedesign'),
        'description' => __('Page sidebar', 'wizedesign'),
        'before_title' => '
    <div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
  <div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
  </div><br/>'
    ));
	register_sidebar(array(
        'id' => 'sidebar-blog-single',
        'name' => __('Blog Single - Sidebar', 'wizedesign'),
        'description' => __('Blog Single - Sidebar', 'wizedesign'),
        'before_title' => '
    <div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
  <div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
  </div><br/>'
    ));
	register_sidebar(array(
        'id' => 'sidebar-blog-archive',
        'name' => __('Blog Archive - Sidebar', 'wizedesign'),
        'description' => __('Blog Archive - Sidebar', 'wizedesign'),
        'before_title' => '
    <div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
  <div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
  </div><br/>'
    ));
	register_sidebar(array(
        'id' => 'sidebar-event-single',
        'name' => __('Event Single - Sidebar', 'wizedesign'),
        'description' => __('Event Single - Sidebar', 'wizedesign'),
        'before_title' => '
    <div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
  <div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
  </div><br/>'
    ));
	register_sidebar(array(
        'id' => 'sidebar-event-archive',
        'name' => __('Event Archive - Sidebar', 'wizedesign'),
        'description' => __('Event Archive - Sidebar', 'wizedesign'),
        'before_title' => '
    <div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
  <div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
  </div><br/>'
    ));
	register_sidebar(array(
        'id' => 'sidebar-mix',
        'name' => __('Dj Mixes - Sidebar', 'wizedesign'),
        'description' => __('Dj Mixes - Sidebar', 'wizedesign'),
        'before_title' => '
    <div class="sidebarnav"><h3>',
        'after_title' => '</h3></div>',
        'before_widget' => '
  <div id="%1$s" class="widget list-nav %2$s">',
        'after_widget' => '
  </div><br/>'
    ));
	register_sidebar(array(
        'id' => 'sidebar-contact',
        'name' => __('Contact - Sidebar', 'wizedesign'),
        'description' => __('Contact - Sidebar', 'wizedesign'),
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
    'name' => __('Footer Widget 1', 'wizedesign'),
    'description' => __('In the footer the left column', 'wizedesign'),
    'before_title' => '<h4>',
    'after_title' => '</h4>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
register_sidebar(array(
    'id' => 'footer-center-left',
    'name' => __('Footer Widget 2', 'wizedesign'),
    'description' => __('In the footer the center left column', 'wizedesign'),
    'before_title' => '<h4>',
    'after_title' => '</h4>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
register_sidebar(array(
    'id' => 'footer-center-right',
    'name' => __('Footer Widget 3', 'wizedesign'),
    'description' => __('In the footer the center right column', 'wizedesign'),
    'before_title' => '<h4>',
    'after_title' => '</h4>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
register_sidebar(array(
    'id' => 'footer-right',
    'name' => __('Footer Widget 4', 'wizedesign'),
    'description' => __('In the footer the left column', 'wizedesign'),
    'before_title' => '<h4>',
    'after_title' => '</h4>',
    'before_widget' => '
      <div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '
      </div>'
));
?>