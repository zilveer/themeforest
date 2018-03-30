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

          <div class="contact">
            <span>Call Us:</span>
            <a href="tel:(02)1234567890">(02) 123-456-7890</a>
          </div>
        </div>
      </div> <!-- end .uou-block-2e -->
    </div>
