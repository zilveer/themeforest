<?php

//grab custom menu settings
global $post;
$custom_menu_slug  = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
$sub_menu_toggle   = get_post_meta($post->ID, 'truethemes_page_checkbox',true);

/*
* Checks for Horizontal Navigation.
* 		
* First Check - We display only if it's NOT disabled in page meta box
* Second Check pt 1 - We display default sub menu, when there is a parent page.
* Second Check pt 2 - We also need to check that custom sub menu is empty before displaying default sub menu.
* Third Check - In second check, default sub menu will not display if custom sub menu is set, 
                now we will display custom sub menu, if it's not empty.
*/

if ('on' != $sub_menu_toggle): // First Check - horizontal sub-menu (when checked, value = "on") ?>

		    <?php if(!empty($post->post_parent)): // Second check pt 1 ?>

						<?php
							//default sub-menu
							if(empty($custom_menu_slug)): // Second check pt 2
							   
							    if(!is_page_template('template_leftnav.php') && !is_page_template('template_leftnav_sidebar.php') && !is_page_template('template_rightnav.php') && !is_page_template('template_rightnav_sidebar.php')){
							    //Do not print this for sidebars..
							     echo '<div id="horizontal_nav">';
							    }
							 	 
							 	 add_filter("karma_mega_menu_walker","sub_nav_walker");
								 
								 wp_nav_menu(array(
									'container'      => false,
									'depth'          => 0,
									'theme_location' => 'Primary Navigation',	
									'walker'         => new sub_nav_walker() 
								));
								
							    if(!is_page_template('template_leftnav.php') && !is_page_template('template_leftnav_sidebar.php') && !is_page_template('template_rightnav.php') && !is_page_template('template_rightnav_sidebar.php')){
									echo '</div><!-- END horizontal_nav -->';
								}
								
							endif; //end -> // Second check pt 2
						?>
						 
			<?php endif; //end -> Second check pt 1 ?>
			
			<?php if(!empty($custom_menu_slug)): // Third Check ?>
			
						<?php
							 //custom sub-menu set by user
					       	 if(!is_page_template('template_leftnav.php') && !is_page_template('template_leftnav_sidebar.php') && !is_page_template('template_rightnav.php') && !is_page_template('template_rightnav_sidebar.php')){
					       	 	//do not print this for sidebars..
							 	echo '<div id="horizontal_nav">';
							 }
							 
							 echo '<ul class="sub-menu">';
							 
							 wp_nav_menu(array(
							    "container" => false,
							    'depth'     => 0,
							    "menu"      => "$custom_menu_slug",
							    'walker'    => "" 
							));
							
							 echo '</ul>';
							 
							 if(!is_page_template('template_leftnav.php') && !is_page_template('template_leftnav_sidebar.php') && !is_page_template('template_rightnav.php') && !is_page_template('template_rightnav_sidebar.php')){
							 echo '</div><!-- END horizontal_nav -->'; 
							 }
						?>
			
			<?php endif; // end -> Third check ?>
		
<?php endif; //end -> First check ?>