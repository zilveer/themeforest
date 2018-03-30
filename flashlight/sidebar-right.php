<?php 
global $avia_config, $custom_widget_area;



			##############################################################################
			# Display the sidebar menu
			##############################################################################

				$default_sidebar = true;
				
				echo "<div class='sidebar sidebar2 box sidebar_absolute'>";
				echo "<div class='inner_sidebar'>";

				// general blog sidebars
				if ($avia_config['currently_viewing'] == 'blog' && dynamic_sidebar('Sidebar Blog (right)') ) : $default_sidebar = false; endif;
				
				// general page sidebars
				if ($avia_config['currently_viewing'] == 'page' && dynamic_sidebar('Sidebar Page (right)') ) : $default_sidebar = false; endif;
				
				// Shop Overview Page
				if ($avia_config['currently_viewing'] == 'shop' && dynamic_sidebar('Shop Overview Page (right)') ) : $default_sidebar = false; endif;
				
				// Single Product Pages
				if ($avia_config['currently_viewing'] == 'shop_single' && dynamic_sidebar('Single Product Pages (right)') ) : $default_sidebar = false; endif;
								
				
				$custom_widget_area = avia_check_custom_widget('page');
								
				//unique Page sidebars:
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page: '.$custom_widget_area." (right)") ) : $default_sidebar = false; endif;
				
				$custom_widget_area = avia_check_custom_widget('cat');
				
				//unique Category sidebars:
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Category: '.$custom_widget_area." (right)") ) : $default_sidebar = false; endif;
								
				//sidebar area displayed everywhere
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Displayed Everywhere (right)')) : $default_sidebar = false; endif;
				
				
				//default dummy sidebar
					if ($default_sidebar)
					{
		
						 avia_dummy_widget(2);
						 avia_dummy_widget(3);
						 avia_dummy_widget(4);
	
					}

				
			echo "<span class='border-transparent border-transparent-left'></span>";	
			echo "<span class='border-transparent border-transparent-right'></span>";	
			echo "</div>";
			echo "</div>";
	       	?>	          