            <?php get_template_part('inc/templates/header/template_header_element_sidr_open'); ?>
            
            <div id="sidr-navigation-container" class="clearfix">

                <?php get_template_part('inc/templates/header/template_header_element_sidr_close'); ?>

                <!-- WORDPRESS MENU: PRIMARY -->
                <?php wp_nav_menu(array( 
                    'theme_location'    => 'primary_menu',
                    'menu_id'           => 'primary_menu',
                    'menu_class'        => 'primary_menu nav',
                    'container'         => 'nav',
                    'container_class'   => 'primary_menu_container',
                    'container_id'      => 'nav-wrap',
                    'show_home'         => '1'
                    ));
                ?>


            </div>
