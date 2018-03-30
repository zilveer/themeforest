<?php
	/** 
     * @author crunchpress
     * @copyright crunchpress[www.themeforest.net/user/crunchpress]
     * @version 2012
     */
class themeple_dummy_data extends WP_Import{
    public function get_default($elements, $page, $subpages)
	{
		$values = array();
		foreach($elements as $element)
		{
				if($element['type'] == 'layout_section')
				{	
					$iterations =  count($element['std']);
					for($i = 0; $i<$iterations; $i++)
					{
						$values[$element['id']][$i] = $this->get_default($element['std'][$i], $page, $subpages);
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
    
    function set_default_menu()
	{
		global $themeple_config;
        $menus  = wp_get_nav_menus();
		$locations   = get_theme_mod('nav_menu_locations');
		if(!empty($menus) && !empty($themeple_config['navigations']))
		{
			foreach($menus as $menu)
			{
				if(is_object($menu) && in_array($menu->name, $themeple_config['navigations']))
				{
					$key = array_search($menu->name, $themeple_config['navigations']);
					if($key)
					{
						$locations[$key] = $menu->term_id;
					}
				}
			}
		}
		set_theme_mod( 'nav_menu_locations', $locations);
	}
	
    
    
}


?>