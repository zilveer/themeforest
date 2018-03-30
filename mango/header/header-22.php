<?php
   /**
    * The template for header 22
   *
   *
   * @package WordPress
    * @subpackage mango
    * @since mango 1.0
    */
   	global $mango_settings, $mobile_menu,$search_button_class,$filter;
   ?>
<header id="header" class="header1 mango_header1" role="banner">
   <div class="container">
      <div class="nav-logo nav-left head22">
         <h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo("description"); ?>"><img src="<?php echo esc_url(mango_get_logo_url());?>" alt="<?php bloginfo("title") ?>"></a><span><?php echo get_bloginfo("description"); ?></span></h1>
		 
         <span class="nav-text-big nav-22"><?php echo get_bloginfo("description"); ?></span>
      </div>
      <!-- End .nav-left -->
      <div class="nav-right">
         <div class="header-row text-right">
		 <?php if($mango_settings['show-loginform']){?>
					<?php if(is_user_logged_in()){ ?>
					  <div class="dropdown search-dropdown">
								<a class="dropdown-toggle " href="<?php echo wp_logout_url( home_url() ); ?>">
									<i class="fa fa-sign-out"></i>
									<span class="header-text">
										<?php _e("Logout",'mango') ;?>
									</span>
								</a>
						</div>
					<?php  }else { ?>
                 <div class="dropdown search-dropdown">
							<a class="dropdown-toggle " href="<?php echo site_url('login');  ?>">
								<i class="fa fa-lock"></i>
								<span class="header-text">
									<?php _e("Login",'mango') ;?>
								</span>
							</a>
				</div>
                  <?php }  ?>
						
					<?php } ?>
		 <?php mango_compare_wishlist_links() ?>
            <?php mango_minicart(); ?>
            <?php if($mango_settings['show-searchform']){ ?>
            <div class="dropdown search-dropdown">
               <a class="dropdown-toggle" href="#" data-toggle="dropdown">
               <i class="fa fa-search"></i><span class="header-text"><?php _e("Search",'mango') ?></span>
               </a>
               <div class="dropdown-menu pull-right" role="menu">
                  <?php if($mango_settings['show-searchform']) {
                     get_template_part("inc/mango_searchform");
                     } ?>
               </div>
               <!-- end .dropdown-menu -->
            </div>
            <!-- End .search-dropdown -->
            <?php 	} ?>
            <?php //if(is_user_logged_in()){ ?>
            <li class="dropdown pull-right">
               <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-user"></i> <strong class="caret"></strong></a>
               <ul class="dropdown-menu menudrop">
                  <?php if ( class_exists( 'woocommerce' ) ) { ?>
                  <li>
                     <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>" class="" title="<?php _e("My Account",'mango')?>">
                     <span><?php _e("My Account",'mango')?></span>
					  <i class="icon-user"></i>
                     </a>
                  </li>
                  <?php } ?>
                  <?php if(is_user_logged_in()){ ?>
				  <?php if ( class_exists( 'WC_Vendors' ) ) { ?>
                  <?php if ( WCV_Vendors::is_vendor( get_current_user_id() ) ){ ?>
                  <?php if ( $dashboard_id = WC_Vendors::$pv_options->get_option( 'vendor_dashboard_page' ) ) { ?>
                  <li>
                     <a rel="nofollow" href="<?php echo get_permalink( $dashboard_id ); ?>">
                     <?php _e( 'My Dashboard', 'mango' ); ?>
                     <i class="icon-speedometer"></i>
                     </a>
                  </li>
                  <?php } ?>	
                  <li>
                     <a rel="nofollow" href="<?php echo WCV_Vendors::get_vendor_shop_page( wp_get_current_user()->user_login ); ?>">
                     <?php _e( 'My Shop', 'mango' ); ?>
                     <i class="icon-bag"></i>
                     </a>
                  </li>
                  <?php if ( $settings_id = WC_Vendors::$pv_options->get_option( 'shop_settings_page' ) ) { ?>
                  <li>
                     <a rel="nofollow" href="<?php echo get_permalink( $settings_id ); ?>">
                     <?php _e( 'My Settings', 'mango' ); ?>
                     <i class="fa fa-cogs"></i>
                     </a>
                  </li>
                  <?php } ?>			
                  <li>
                     <a rel="nofollow" href="<?php echo admin_url( 'post-new.php?post_type=product' ); ?>">
                     <?php _e( 'Submit a Product', 'mango' ); ?>
                     <i class="fa fa-cart-plus"></i>
                     </a>
                  </li>
                  <?php }} ?>
                  <li>
                     <a href="<?php echo wp_logout_url( home_url() ); ?>">
                     <span><?php _e("Log Out",'mango')?></span>
                     <i class="icon-logout"></i></a>
                  </li>
				  <?php } ?>
				  
                  <?php if(!is_user_logged_in()){ ?>
                  <?php if ( class_exists( 'woocommerce' ) ) { ?>
                  <li>
                     <a rel="nofollow" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">
                     <?php _e( 'Log In', 'mango' ); ?>
                     <i class="icon-login"></i>
                     </a>
                  </li>
                  <?php } else { ?>
                  <li>
                     <a href="<?php echo wp_login_url( home_url() ); ?>">
                     <?php _e( 'Log In', 'mango' ); ?>
                     <i class="icon-login"></i>
                     </a>
                  </li>
                  <?php } } ?>
               </ul>
            </li>
            <?php // } ?>
            <?php get_template_part("inc/language"); ?>
         </div>
         <!-- End .header-row -->
		    <?php if(has_nav_menu('primary_menu')) { ?>

      <div class="prim-menus-struc">
         <?php
            wp_nav_menu(
            array (
            'theme_location' => 'primary_menu',
            'menu_id' => '',
            'menu_class' => 'menu btt-dropdown extra-class',
            "depth" => 5,
            'container'       => '',
            'walker' => new mango_top_navwalker
            )
            );
            ?>
			
      </div>
      <!-- End .container -->

		<?php } else{
      echo '<div class="">' . __('Define "Primary Navigation" in <strong>Apperance > Menus</strong>','mango') . '</div>';
      } ?>
   
         <!-- End .header-row -->
      </div>
      <!-- End .nav-right -->
      <div class="nav-center nav-right">

         <?php if($mobile_menu){ ?>
         <button type="button" id="mobile-menu-btn">
         <span class="sr-only"><?php __("Toggle navigation",'mango') ?></span>
         <i class="fa fa-navicon"></i>
         </button>
         <?php } ?>
      </div>
      <!-- End .nav-center -->
   </div>
   <!-- End .container -->
   <?php if(has_nav_menu('main_menu')) { ?>
   <div id="menu-container" class="sticky-menu dark">
      <div class="container">
         <?php
            wp_nav_menu(
            array (
            'theme_location' => 'main_menu',
            'menu_id' => 'menu-main-navigation',
            'menu_class' => 'menu btt-dropdown',
            "depth" => 5,
            'container'       => 'nav',
            'walker' => new mango_top_navwalker
            )
            );
            ?>
			
      </div>
      <!-- End .container -->
   </div>
   <!-- End .menu-cotainer -->
   <?php } else{
      echo '<div class="container">' . __('Define "Main Navigation" in <strong>Apperance > Menus</strong>','mango') . '</div>';
      } ?>
</header>
<!-- End #header -->