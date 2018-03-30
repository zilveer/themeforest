<?php
   /**
    * The sidebar containing the main widget area
    *
    * @package WordPress
    * @subpackage Monarch
    * @since Monarch 1.0
    */
   
if ( is_active_sidebar( 'sidebar-one' ) || is_active_sidebar( 'sidebar-two' )  ) : ?>

<aside class="sidebars widget-area col-xs-12 col-sm-12 col-md-12 col-lg-5 col-bg-6" id="widget-area" role="complementary">

  <!-- Sidebar One -->
  <div class="sidebar-one col-xs-12 col-sm-12 col-md-6 col-lg-12 col-bg-6">
    <?php if ( is_active_sidebar( 'sidebar-one' ) ) : ?>
      <?php dynamic_sidebar( 'sidebar-one' ); ?>
    <?php endif; ?>
  </div>
  
  <!-- Sidebar Two -->
  <div class="sidebar-two col-xs-12 col-sm-12 col-md-6 col-lg-12 col-bg-6">
    <?php if ( is_active_sidebar( 'sidebar-two' ) ) : ?>
      <?php dynamic_sidebar( 'sidebar-two' ); ?>
    <?php endif; ?>
  </div>

</aside>

<?php endif; ?>