<?php 
global $avia_config, $custom_widget_area;

ob_start();
$default_sidebar = true;

if( empty($avia_config['currently_viewing']) ) $avia_config['currently_viewing'] = 'page';
if(!empty($avia_config['currently_viewing_dynamic_overwrite'])) 
{
	$avia_config['currently_viewing'] = $avia_config['currently_viewing_dynamic_overwrite'];
}





if ($avia_config['currently_viewing'] != "fullwidth") // check if its a full width page, if full width dont show the sidebar content
{
			##############################################################################
			# Display the sidebar menu
			##############################################################################

			//check if we should display the left, right or both sidebars
			$sidebar_pos = avia_layout_class('main', false);
			
			if(strpos($sidebar_pos, 'sidebar_left')  !== false) $sidebars_to_show = array('left');	
			if(strpos($sidebar_pos, 'sidebar_right') !== false) $sidebars_to_show = array('right');	
			if(strpos($sidebar_pos, 'dual-sidebar')  !== false) $sidebars_to_show = array('left','right');		

			$subNav = avia_get_option('page_nesting_nav');
			
			
			//display the sidebars
			if(!empty($sidebars_to_show) && is_array($sidebars_to_show))
			{	
				foreach ($sidebars_to_show as $sidebar) 
				{	
					$default_sidebar = true;
					
					echo "<div class='sidebar sidebar_".$sidebar." ".avia_layout_class( 'sidebar', false )." units'>";
					
						echo "<div class='inner_sidebar extralight-border'>";
					
					/*
					* Display a subnavigation for pages that is automatically generated, so the users doesnt need to work with widgets
					*/
					$sidebar_menu = "";
					
					if($subNav && isset($post) && is_object($post) && !empty($post->ID) && is_page())
					{
						global $post;
						$subNav = false;
						$parent = $post->ID;
						$sidebar_menu = "";
						
						if (!empty($post->post_parent))	
						{
							if(isset($post->ancestors)) $ancestors  = $post->ancestors;
							if(!isset($ancestors)) $ancestors  = get_post_ancestors($post->ID);
							$root		= count($ancestors)-1;
							$parent 	= $ancestors[$root];
						} 

						$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0");

						if ($children) 
						{ 
							$default_sidebar = false;
							$sidebar_menu .= "<div class='widget widget_nav_menu'><ul class='nested_nav'>";
							$sidebar_menu .= $children;
							$sidebar_menu .= "</ul></div>";
						} 
					}

					echo apply_filters('avia_sidebar_menu_filter', $sidebar_menu);
					
					// single shop sidebars
					if ($avia_config['currently_viewing'] == 'frontpage' && dynamic_sidebar('Frontpage') ) : $default_sidebar = false; endif;
					
					// single shop sidebars
					
					if ($avia_config['currently_viewing'] == 'shop_single') $default_sidebar = false;
					if ($avia_config['currently_viewing'] == 'shop_single' && dynamic_sidebar('Single Product Pages') ) : $default_sidebar = false; endif;
					
					// general shop sidebars
					if ($avia_config['currently_viewing'] == 'shop' && dynamic_sidebar('Shop Overview Page') ) : $default_sidebar = false; endif;

					// general blog sidebars
					if ($avia_config['currently_viewing'] == 'blog' && dynamic_sidebar('Sidebar Blog') ) : $default_sidebar = false; endif;
									
					// general pages sidebars
					if ($avia_config['currently_viewing'] == 'page' && dynamic_sidebar('Sidebar Pages') ) : $default_sidebar = false; endif;
					
					// forum pages sidebars
					if ($avia_config['currently_viewing'] == 'forum' && dynamic_sidebar('Forum') ) : $default_sidebar = false; endif;
					
					
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
				}
				
			}

}	       
$html_output_sidebar = ob_get_clean(); 


if(($avia_config['currently_viewing'] != "shop_single" && $default_sidebar) || $default_sidebar == false) echo $html_output_sidebar;

if((function_exists('is_product') && !is_product()) || !function_exists('is_product')) wp_reset_query();


?>	          