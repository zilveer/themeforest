<?php
// global $wp_registered_sidebars;
#########################################

if ( function_exists('register_sidebar') )
{	$counter = 0;
	$sidebars_to_show = array('left','right');	
			
		foreach ($sidebars_to_show as $sidebar)
		{	$counter++;
			register_sidebar(array(
				'name' => 'Displayed Everywhere ('.$sidebar.')',
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
			'after_widget' => '</div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>', 
			'id'=> "sidebar-".$counter 
			));
		}
		
		foreach ($sidebars_to_show as $sidebar)
		{$counter++;
			register_sidebar(array(
				'name' => 'Sidebar Blog ('.$sidebar.')',
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
			'after_widget' => '</div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>', 
			'id'=> "sidebar-".$counter 
			));
		}
		
		foreach ($sidebars_to_show as $sidebar)
		{$counter++;
			register_sidebar(array(
				'name' => 'Sidebar Pages ('.$sidebar.')',
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
			'after_widget' => '</div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>',
			'id'=> "sidebar-".$counter  
			));
		}
	

		if(function_exists('avia_woocommerce_enabled') && avia_woocommerce_enabled())
		{
			foreach ($sidebars_to_show as $sidebar)
			{$counter++;
			register_sidebar(array(
				'name' => 'Shop Overview Page ('.$sidebar.')',
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
			'after_widget' => '</div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>', 
			'id'=> "sidebar-".$counter 
			));
			}
		
		
			foreach ($sidebars_to_show as $sidebar)
			{$counter++;
			register_sidebar(array(
					'name' => 'Single Product Pages ('.$sidebar.')',
					'before_widget' => '<div id="%1$s" class="widget %2$s">', 
				'after_widget' => '</div>', 
				'before_title' => '<h3 class="widgettitle">', 
				'after_title' => '</h3>',
				'id'=> "sidebar-".$counter  
				));
			}
		}
		
		
	
		#extra widgets for pages
		$id_array = avia_check_custom_widget('page', 'ids');
	
		if(isset($id_array[0]))
		{
			foreach ($id_array as $page_id)
			{	
				foreach ($sidebars_to_show as $sidebar)
				{$counter++;
				if($page_id != "")
				register_sidebar(array(
				'name' => 'Page: '.get_the_title($page_id).' ('.$sidebar.')',
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
				'after_widget' => '</div>', 
				'before_title' => '<h3 class="widgettitle">', 
				'after_title' => '</h3>', 
				'id'=> "sidebar-".$counter 
				));
			
			}
		}
	}
			
		
		
		#extra widgets for categories	
		$id_array = avia_check_custom_widget('cat', 'ids');
	
		if(isset($id_array[0]))
		{
			foreach ($id_array as $cat_id)
			{	
				foreach ($sidebars_to_show as $sidebar)
				{$counter++;
				if($cat_id != "")
				register_sidebar(array(
				'name' => 'Category: '.get_the_category_by_ID($cat_id).' ('.$sidebar.')',
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
				'after_widget' => '</div>', 
				'before_title' => '<h3 class="widgettitle">', 
				'after_title' => '</h3>', 
				'id'=> "sidebar-".$counter 
				));
			
			}
		}
	}
		
	
		#extra widgets for categories	
		$name_array = avia_check_custom_widget('dynamic_template');
	
		if(isset($name_array))
		{
			foreach ($name_array as $name)
			{	$counter++;
				if($name != "")
				register_sidebar(array(
				'name' => 'Dynamic Template: Widget '.$name,
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
				'after_widget' => '</div>', 
				'before_title' => '<h3 class="widgettitle">', 
				'after_title' => '</h3>', 
				'id'=> "sidebar-".$counter 
				));
			
		}
	}	
	
	

}

	
	
	
	function avia_dummy_widget($number)
	{
		switch($number)
		{
			case 1:
			?>
				<div class='widget'>
				<h3 class='widgettitle'><?php _e('Interesting links','avia_framework');?></h3>
				<span class='minitext'><?php _e('Besides are some interesting links for you! Enjoy your stay :)','avia_framework');?></span>
				</div>
			<?php
			break;
			
		
			case 4: 
				echo "<div class='widget widget_archive'>";
				echo "<h3 class='widgettitle'>" . __('Archive','avia_framework') . "</h3>";
				echo "<ul>";
				wp_get_archives('type=monthly');
				echo "</ul>";
				echo "</div>";
			break;
			
			case 3: 
				echo "<div class='widget widget_archive'>";
				echo "<h3 class='widgettitle'>" . __('Categories','avia_framework') . "</h3>";
				echo "<ul>";
				wp_list_categories('sort_column=name&optioncount=0&hierarchical=0&title_li=');
				echo "</ul>";
				echo "</div>";
			break;
			
			case 2: 
				echo "<div class='widget widget_archive'>";
				echo "<h3 class='widgettitle'>" . __('Pages','avia_framework') . "</h3>";
				echo "<ul>";
				wp_list_pages('title_li=&depth=-1' );
				echo "</ul>";
				echo "</div>";
			break;
			
			case 5: 
				echo "<div class='widget widget_archive'>";
				echo "<h3 class='widgettitle'>" . __('Bookmarks','avia_framework') . "</h3>";
				echo "<ul>";
				wp_list_bookmarks('title_li=&categorize=0');
				echo "</ul>";
				echo "</div>";
			break;
		}
	}