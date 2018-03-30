<?php
class avia_wp_import extends WP_Import
{
	var $preStringOption; 
	var $results;
	var $getOptions;
	var $saveOptions;
	var $termNames;
	
	function saveOptions($option_file, $import_only = false)
	{	

		if($option_file) @include_once($option_file);
		
		switch($import_only)
		{
			case 'options': $dynamic_pages = $dynamic_elements = false; break;
			case 'dynamic_pages': $options = $dynamic_elements = false; break;
			case 'dynamic_elements': $options = $dynamic_pages = false; break;
		}
		
		
		if(!isset($options) && !isset($dynamic_pages) && !isset($dynamic_elements)  ) { return false; }
		
		$options = unserialize(base64_decode($options));
		$dynamic_pages = unserialize(base64_decode($dynamic_pages));
		$dynamic_elements = unserialize(base64_decode($dynamic_elements));
		
		global $avia;
		
		if(is_array($options))
		{
			foreach($avia->option_pages as $page)
			{
				$database_option[$page['parent']] = $this->extract_default_values($options[$page['parent']], $page, $avia->subpages);
			}
		}
		
		if(!empty($database_option))
		{
			update_option($avia->option_prefix, $database_option);
		}
		
		if(!empty($dynamic_pages))
		{
			update_option($avia->option_prefix.'_dynamic_pages', $dynamic_pages);
		}
		
		if(!empty($dynamic_elements))
		{
			update_option($avia->option_prefix.'_dynamic_elements', $dynamic_elements);
		}
		
		
	}
	
	/**
	 *  Extracts the default values from the option_page_data array in case no database savings were done yet
	 *  The functions calls itself recursive with a subset of elements if groups are encountered within that array
	 */
	public function extract_default_values($elements, $page, $subpages)
	{
	
		$values = array();
		foreach($elements as $element)
		{
				if($element['type'] == 'group')
				{	
					$iterations =  count($element['std']);
					
					for($i = 0; $i<$iterations; $i++)
					{
						$values[$element['id']][$i] = $this->extract_default_values($element['std'][$i], $page, $subpages);
					}
				}
				else if(isset($element['id']))
				{
					if(!isset($element['std'])) $element['std'] = "";
					
					if($element['type'] == 'select' && !is_array($element['subtype']))
					{	
						if(!isset($element['taxonomy'])) $element['taxonomy'] = 'category';
						$values[$element['id']] = $this->getSelectValues($element['subtype'], $element['std'], $element['taxonomy']);
					}
					else
					{
						$values[$element['id']] = $element['std'];
					}
				}
			
		}
		
		return $values;
	}
	
	function getSelectValues($type, $name, $taxonomy)
	{
		switch ($type)
		{
			case 'page':
			case 'post':	
				$the_post = get_page_by_title( $name, 'OBJECT', $type );
				if(isset($the_post->ID)) return $the_post->ID;
			break;
			
			case 'cat':	
			
				if(!empty($name))
				{
					$return = array();
					
					foreach($name as $cat_name)
					{	
						if($cat_name)
						{	
							if(!$taxonomy) $taxonomy = 'category';
							$the_category = get_term_by('name', $cat_name, $taxonomy);
						
							if($the_category) $return[] = $the_category->term_id;
						}
					}
				
				if(!empty($return))
				{
					if(!isset($return[1]))
					{
						 $return = $return[0];
					}
					else
					{
						$return = implode(',',$return);
					}
				}
				return $return;
			}
			
		break;
		}
	}
	
	function set_menus()
	{
		global $avia_config;
		//get all registered menu locations
		$locations   = get_theme_mod('nav_menu_locations');
		
		//get all created menus
		$avia_menus  = wp_get_nav_menus();
		
		if(!empty($avia_menus) && !empty($avia_config['nav_menus']))
		{
			foreach($avia_menus as $avia_menu)
			{
				//check if we got a menu that corresponds to the Menu name array ($avia_config['nav_menus']) we have set in functions.php
				if(is_object($avia_menu) && in_array($avia_menu->name, $avia_config['nav_menus']))
				{
					$key = array_search($avia_menu->name, $avia_config['nav_menus']);
					if($key)
					{
						//if we have found a menu with the correct menu name apply the id to the menu location
						$locations[$key] = $avia_menu->term_id;
					}
				}
			}
		}
		//update the theme
		set_theme_mod( 'nav_menu_locations', $locations);
	}
}




