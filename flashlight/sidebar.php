<?php 
global $avia_config, $custom_widget_area;

$nowidgets_left = false;
//check if second sidebar allowed
$content_style = avia_post_meta(avia_get_the_ID(), 'entry_layout'); 
$sidebar_settings = avia_post_meta(avia_get_the_ID(), 'sidebar_right');
if($sidebar_settings == ""){$sidebar_settings = avia_get_option('sidebar_right');}


//check if its a masonry template, if sidebar allowed and no masonry display second sidebar and tell first siebar not to display widgets
if($sidebar_settings == 'yes' && strpos($avia_config['layout'],'flexible masonry') === false && strpos($content_style, 'content_display') === false)
{
	get_sidebar('right');
}		

			##############################################################################
			# Display the sidebar menu
			##############################################################################

				$default_sidebar = true;
				
				echo "<div class='sidebar sidebar1 box sidebar_absolute'>";
				echo "<div class='inner_sidebar'>";
				echo "<div class='box'>";
						/*
						*	display the theme logo by checking if the default css defined logo was overwritten in the backend.
						*   the function is located at framework/php/function-set-avia-frontend-functions.php in case you need to edit the output
						*/
						echo avia_logo();
						
						
						/*
						*	display the main navigation menu
						*   modify the output in your wordpress admin backend at appearance->menus
						*/
						echo "<div class='main_menu main_menu_menu_manager'>";
						/*
						*	display the main navigation menu
						*   check if a description for submenu items was added and change the menu class accordingly
						*   modify the output in your wordpress admin backend at appearance->menus
						*/
						$args = array(	'echo'=> true, 
										'fallback_cb' => 'avia_fallback_menu', 
										'theme_location' => 'avia', 
										'menu_class' => 'menu', 
										'walker' => new avia_description_walker()
									);
	
	
						$menu = wp_nav_menu($args);
						echo "</div>";
						
					echo "</div>";
									
				
	
					// general blog sidebars
					if ($avia_config['currently_viewing'] == 'blog' && dynamic_sidebar('Sidebar Blog (left)') ) : $default_sidebar = false; endif;
					
					// general page sidebars
					if ($avia_config['currently_viewing'] == 'page' && dynamic_sidebar('Sidebar Page (left)') ) : $default_sidebar = false; endif;
					
					// Shop Overview Page
				if ($avia_config['currently_viewing'] == 'shop' && dynamic_sidebar('Shop Overview Page (left)') ) : $default_sidebar = false; endif;
				
				// Single Product Pages
				if ($avia_config['currently_viewing'] == 'shop_single' && dynamic_sidebar('Single Product Pages (left)') ) : $default_sidebar = false; endif;
									
					
					$custom_widget_area = avia_check_custom_widget('page');
									
					//unique Page sidebars:
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page: '.$custom_widget_area ." (left)" ) ) : $default_sidebar = false; endif;
					
					$custom_widget_area = avia_check_custom_widget('cat');
					
					//unique Category sidebars:
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('Category: '.$custom_widget_area." (left)") ) : $default_sidebar = false; endif;
									
					//sidebar area displayed everywhere
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('Displayed Everywhere (left)')) : $default_sidebar = false; endif;
				
	
				
				####### SOCKET CONTAINER #######
				echo "<div id='socket' class='box'>";
				
				echo "	<ul class='social_bookmarks'>";
				do_action('avia_add_social_icon','sidebar');
				echo "		<li class='rss'><a href='".avia_get_option('feedburner',get_bloginfo('rss2_url'))."'>RSS</a></li>";
						
						if($facebook = avia_get_option('facebook')) echo "<li class='facebook'><a href='".$facebook."'>Facebook</a></li>";
						if($twitter = avia_get_option('twitter')) 	echo "<li class='twitter'><a href='http://twitter.com/".$twitter."'>Twitter</a></li>";
						 				
				echo "	</ul><!-- end social_bookmarks-->";
				
				echo "<div class='hide_content_wrap hide_content_wrap_copyright '>";
				echo "<span class='copyright'>".__('&copy; Copyright','avia_framework')." <a href='".home_url('/')."'>".get_bloginfo('name')."</a></span>";
				echo "</div>";
				
				echo "</div>";
				####### END SOCKET CONTAINER #######
				
				
				
				
			echo "<span class='border-transparent border-transparent-left'></span>";	
			echo "<span class='border-transparent border-transparent-right'></span>";	
			echo "</div>";
			echo "</div>";
	       	?>	          