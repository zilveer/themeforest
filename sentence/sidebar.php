<?php 
global $avia_config, $custom_widget_area;

wp_reset_query();
ob_start();

if(!empty($avia_config['currently_viewing_dynamic_overwrite'])) {$avia_config['currently_viewing'] = $avia_config['currently_viewing_dynamic_overwrite'];}

			##############################################################################
			# Display the sidebar menu
			##############################################################################

			$default_sidebar = false;
			echo "<div id='secondary'>";
			
				echo "<div class='sidebar'>";
				
					echo "<div class='inner_sidebar extralight-border'>";
					/*
					*	display the main navigation menu
					*   check if a description for submenu items was added and change the menu class accordingly
					*   modify the output in your wordpress admin backend at appearance->menus
					*/
					echo "<div class='main_menu main_menu' data-selectname='".__('Select a page','avia_framework')."'>";
					$args = array('theme_location'=>'avia', 'fallback_cb' => 'avia_fallback_menu', 'walker' => new avia_description_walker());
					wp_nav_menu($args); 
					echo "</div>";
				
				
				if(is_front_page()) $avia_config['currently_viewing'] = 'frontpage';
				
				// general blog sidebars
				if ($avia_config['currently_viewing'] == 'frontpage' && dynamic_sidebar('Frontpage') ) : $default_sidebar = false; endif;
				
				// single shop sidebars
				if ($avia_config['currently_viewing'] == 'portfolio' && dynamic_sidebar('Portfolio') ) : $default_sidebar = false; endif;
				
				// general blog sidebars
				if ($avia_config['currently_viewing'] == 'blog' && dynamic_sidebar('Sidebar Blog') ) : $default_sidebar = false; endif;
								
				// general pages sidebars
				if ($avia_config['currently_viewing'] == 'page' && dynamic_sidebar('Sidebar Pages') ) : $default_sidebar = false; endif;
				
				
				$custom_widget_area = avia_check_custom_widget('page');

				//unique Page sidebars:
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page: '.$custom_widget_area) ) : $default_sidebar = false; endif;
				
				$custom_widget_area = avia_check_custom_widget('cat');
				
				//unique Category sidebars:
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Category: '.$custom_widget_area) ) : $default_sidebar = false; endif;
								
				//sidebar area displayed everywhere
				if (function_exists('dynamic_sidebar') && $avia_config['currently_viewing'] != 'shop_single' && dynamic_sidebar('Displayed Everywhere')) : $default_sidebar = false; endif;
				
				//default dummy sidebar
				if ($default_sidebar)
				{
	
					 avia_dummy_widget(2);
					 avia_dummy_widget(3);
					 avia_dummy_widget(4);

				}
				echo "</div>";
				
			echo "</div>";
			
		echo "</div>";
				

       
$output = ob_get_clean();


echo $output;

wp_reset_query();


?>	          