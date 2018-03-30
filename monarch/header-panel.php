<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
?>

<!-- Header Left Panel -->
<div class="header-panel">

   <!-- Logo -->
   <header id="masthead" class="site-header" role="banner">
      <div class="site-branding">
         <h1 class="site-title clearfix"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo get_bloginfo( 'description', 'display' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
      </div>
      <button type="button" class="header-panel-toggle"><span class="ion-android-more-horizontal"></span></button>
   </header>

   <div class="header-panel-scroll">
      <div class="scrollbar-inner">

         <!-- Primary Menu -->
         <?php if ( has_nav_menu( 'primary' ) ) : ?>
         <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php
               wp_nav_menu( array(
                  'menu_class'     => 'nav nav-primary',
                  'theme_location' => 'primary',
               ) );
               ?>
         </nav>
         <?php endif; ?>

         <!-- Sidebar Footer -->
         <footer class="hp-footer" role="contentinfo" id="footer">

            <!-- Social Links Menu -->
            <?php if ( has_nav_menu( 'social' ) ) : ?>
            <nav role="navigation">
               <?php
                  wp_nav_menu( array(
                     'menu_class'     => 'nav nav-social',
                     'theme_location' => 'social',
                     'depth'          => 1,
                     'link_before'    => '<span class="hidden">',
                     'link_after'     => '</span>',
                  ) );
                  ?>
            </nav>
            <?php endif; ?>

            <!-- Info Menu -->
            <?php if ( has_nav_menu( 'info' ) ) : ?>
            <nav role="navigation">
               <?php
                  wp_nav_menu( array(
                     'menu_class'     => 'nav nav-info',
                     'theme_location' => 'info',
                     'depth'          => 1,
                  ) );
                  ?>
            </nav>
            <?php endif; ?>

            <!-- WordPress Copyright -->
            <div class="copyright">
               <?php
                  /**
                   * Fires before the monarch footer text for footer customization.
                   *
                   * @since Monarch 1.0
                   */
                  do_action( 'monarch_credits' );
                  ?>
               <?php
                  /**
                   * Footer copyright text
                   *
                   * @since Monarch 1.0
                   */
                   echo get_theme_mod( 'monarch_footer_copyright', 'Proudly powered by <strong>WordPress</strong>' );
                ?>
            </div>

         </footer>

      </div>
   </div>

</div>

<!-- Scrollup -->
<div class="toolbar-scrollup">
   <?php if(!get_theme_mod('monarch_admin_button')) : ?>      
      <?php if ( is_user_logged_in() ) : ?>
      <div class="wp-admin">
         <a href="<?php echo admin_url() ;?>">
            <i class="ion-gear-b"></i>
         </a>
      </div>
      <?php endif; ?>
   <?php endif; ?>
   <div class="scrollup">
      <a href="#">
         <i class="ion-chevron-up"></i>
      </a>
   </div>
</div>

<!-- User Menu Right Panel -->
<div class="user-panel">

   <div class="user-panel-wrapper">

      <!-- BuddyPress Navigation -->
      <?php if ( has_nav_menu( 'buddy' ) ) : ?>
      <nav role="navigation">
         <?php
            wp_nav_menu( array(
               'menu_class'     => 'nav nav-buddy',
               'theme_location' => 'buddy',
               'depth' => 1,
            ) );
            ?>
      </nav>
      <?php endif; ?>

      <!-- Search button -->
      <ul class="nav nav-buddy">
         <li class="search"><a href="#" data-toggle="modal" data-target="#modal-search"><?php esc_html_e('Search', 'monarch'); ?></a></li>
      </ul>

      <?php if ( is_user_logged_in() ) : ?>

      <!-- If BuddyPress activated -->
      <?php if ( function_exists( 'is_buddypress' ) ) : ?>

         <!-- Avatar -->
         <div class="buddy-avatar logged-in">
            <div class="avatar-outline">
               <a href="<?php echo bp_loggedin_user_domain(); ?>">
               <?php bp_loggedin_user_avatar( 'type=full' ); ?>
               </a>
            </div>
            <?php monarch_notification(); ?>
         </div>

         <!-- Logged-in Menu -->
         <div class="menu-logged-in-user-menu-container">
            <ul id="menu-logged-in-user-menu" class="nav nav-buddy">
               <!-- <li><a href="<?php echo bp_loggedin_user_domain(); ?>activity"><?php esc_html_e('Activity', 'monarch'); ?></a></li> -->
               <li><a href="<?php echo bp_loggedin_user_domain(); ?>friends"><?php esc_html_e('Friends', 'monarch'); ?></a></li>
               <li><a href="<?php echo bp_loggedin_user_domain(); ?>groups"><?php esc_html_e('Groups', 'monarch'); ?></a></li>
               <li><a href="<?php echo bp_loggedin_user_domain(); ?>messages"><?php esc_html_e('Messages', 'monarch'); ?></a></li>
               <!-- <li><a href="<?php echo bp_loggedin_user_domain(); ?>profile"><?php esc_html_e('Notifications', 'monarch'); ?></a></li> -->
               <!-- <li><a href="<?php echo bp_loggedin_user_domain(); ?>forums"><?php esc_html_e('Forums', 'monarch'); ?></a></li> -->
               <li><a href="<?php echo bp_loggedin_user_domain(); ?>profile"><?php esc_html_e('Profile', 'monarch'); ?></a></li>
               <li><a href="<?php echo bp_loggedin_user_domain(); ?>settings"><?php esc_html_e('Settings', 'monarch'); ?></a></li>
               <li class="last"><a href="<?php echo wp_logout_url( bp_get_requested_url() ); ?>"><?php esc_html_e('Log Out', 'monarch'); ?></a></li>
            </ul>
         </div>

      <?php endif; ?>
      
      <?php else : ?>

      <!-- If BuddyPress activated -->
      <?php if ( function_exists( 'is_buddypress' ) ) : ?>
         
         <!-- Avatar -->
         <div class="buddy-avatar logged-out">
            <div class="avatar-outline">
               <div class="avatar"></div>
            </div>
         </div>

         <!-- Logged-out Menu -->
         <ul class="nav nav-buddy">
            <li class="login"><a href="#" data-toggle="modal" data-target="#modal-login"><?php esc_html_e('Login', 'monarch'); ?></a></li>
            <?php if ( get_option( 'users_can_register' ) ) : ?>
               <li class="register"><?php printf( wp_kses( __( '<a href="%s">Register</a>', 'monarch' ), array(  'a' => array( 'href' => array() ) ) ), bp_get_signup_page() ) ?></li>
            <?php endif; ?>
         </ul>

      <?php endif; ?>
      <!-- End is_buddypress -->

      <?php endif; ?>
      <!-- End is_user_logged_in -->

   </div>

</div>