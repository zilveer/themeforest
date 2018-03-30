            <li class="dropdown pull-right">
               <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-user"></i> <strong class="caret"></strong></a>
               <ul class="dropdown-menu menudrop">
                  <?php if ( class_exists( 'woocommerce' ) ) { ?>
                  <li>
                     <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>" class="" title="<?php _e("My Account",',mango')?>">
                     <span class="header-text accounts"><?php _e("My Account",',mango')?></span>
					  <i class="icon-user"></i>
                     </a>
                  </li>
                  <?php } ?>
                  <?php if(is_user_logged_in()){ ?>

                  <?php if ( WCV_Vendors::is_vendor( get_current_user_id() ) ){?>
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
                  <?php } ?>
                  <li>
                     <a href="<?php echo wp_logout_url( home_url() ); ?>">
                     <span class="header-text accounts"><?php _e("Log Out",',mango')?></span>
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