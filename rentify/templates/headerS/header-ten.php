    <div class="box-shadow-for-ui">
      <div class="uou-block-2e">
        <div class="container">
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

          <?php get_search_form(); ?>

        </div>
      </div> <!-- end .uou-block-2e -->
    </div>


 