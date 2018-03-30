						<!-- WORDPRESS MENU: SECONDARY MENU -->
						<?php wp_nav_menu(array( 
							'theme_location'    => 'secondary_menu',
							'menu_id'           => 'the-secondary-menu',
							'menu_class'        => 'secondary-menu nav',
							'container'         => 'nav',
							'container_id'      => 'the-secondary-menu-container',
							'container_class'   => 'secondary-menu-container',
							'show_home'         => '1'
							));
						?>
