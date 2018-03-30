<!-- Begin Header -->

    <header <?php wbc907_menu_class( 'header-bar mobile-menu' ); ?><?php echo wbc907_height_data(); ?>>


      <?php

      /* Currently topbar area hooked */
      do_action( 'wbc907_before_nav_bar' );

      ?>

      <div class="menu-bar-wrapper">
        <div class="container">
          <div class="header-inner">

            <?php

            /* Currently logo/title area hooked */
            do_action( 'wbc907_logo_title' );


            /* Displays top main menu */
            wp_nav_menu( array(
                'container'       => 'nav',
                'container_class' => 'primary-menu',
                'container_id'    => 'wbc9-main',
                'menu'            => apply_filters( 'wbc907_page_menu', '' ),
                'menu_id'         => 'main-menu',
                'menu_class'      => 'wbc_menu',
                'theme_location'  => 'wbc907-primary',
                'fallback_cb'     => ''
              ) );

            ?>
            <div class="clearfix"></div>
          </div><!-- ./header-inner -->


          <a href="#" class="menu-icon"><i class="fa fa-bars"></i></a>
         <div class="clearfix"></div>
        </div><!-- ./container -->
      </div> <!-- ./menu-bar-wrapper -->
    </header>
<!-- End Header -->
