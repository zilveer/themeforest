            <?php get_template_part('inc/templates/elements/template_element_sidr_open'); ?>
            
            <div id="sidr-navigation-container" class="clearfix">

                <?php get_template_part('inc/templates/elements/template_element_sidr_close'); ?>

				<!-- WORDPRESS MENU: PRIMARY -->
				<?php wp_nav_menu(array( 
					'theme_location'    => 'primary_menu',
					'menu_id'           => 'the-primary-menu',
					'menu_class'        => 'primary-menu nav',
					'container'         => 'nav',
					'container_id'      => 'the-primary-menu-container',
					'container_class'   => 'primary-menu-container',
					'show_home'         => '1'
					));
				?>

            </div>
