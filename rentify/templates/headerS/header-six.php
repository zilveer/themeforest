    <div class="box-shadow-for-ui">
      <div class="uou-block-2c icons">
        <div class="container">
        <?php $rentify_option_data = rentify_option_data(); ?>

        <?php if(isset($rentify_option_data['sb-header-icon'])&& !empty($rentify_option_data['sb-header-icon'])): ?>
        <a href="<?php echo esc_url(site_url('/')); ?>" class="logo"> <img src="<?php echo esc_url($rentify_option_data['sb-header-icon']['url']); ?>" alt=""> </a>
        <?php endif; ?>         
        <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>
          <nav class="nav">

            <?php 

              $defaults = array(
                'theme_location'  => 'primary_navigation_right',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'sf-menu',
                'menu_id'         => '',
                'echo'            => true,            
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul class="sf-menu %2$s"> %3$s </ul>',
                'depth'           => 0,
                'fallback_cb'     => 'rentify_nav_walker::fallback',
                'walker'          => new rentify_nav_walker()
              );

              wp_nav_menu( $defaults );

            ?>
          </nav>
        </div>
      </div> <!-- end .uou-block-2c -->
    </div>
