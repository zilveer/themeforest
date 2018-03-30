<?php


class PexetoMenuWalker extends Walker_Nav_Menu {

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    	
    	if($item->menu_item_parent==0){
	    	if(in_array($item->ID, $this->get_mega_menu_items())){
	    		$item->classes[]='mega-menu-item';
	    	}
	    }
        parent::start_el($output, $item, $depth, $args, $id);
    }

    private function get_mega_menu_items(){
    	if(!isset($this->mega_menu_items)){
    		$mega_menu_items = pexeto_option('items_mega_menu');
    		if(!is_array($mega_menu_items)){
    			$mega_menu_items = array();
    		}

    		$this->mega_menu_items = $mega_menu_items;
    	}

    	return $this->mega_menu_items;

    }

}



if(!function_exists('pexeto_get_main_menu_parent_items')){
	function pexeto_get_main_menu_parent_items(){
		$menu_name = 'pexeto_main_menu';
		$locations = get_nav_menu_locations();
		$items = array();

	    if ( isset( $locations[ $menu_name ] ) && $locations[ $menu_name ] != 0) {
	    	$menu_id = $locations[ $menu_name ];

			$items = pexeto_get_menu_parent_items($menu_id);
		

			//get the WPML translated items
			$trans_items = pexeto_get_translation_items($menu_id);
			if(!empty($trans_items)){
				$items = array_merge($items, $trans_items);
			}

		}

		return $items;
	}
}

if(!function_exists('pexeto_get_menu_parent_items')){
	function pexeto_get_menu_parent_items($menu_id){
		$menu = wp_get_nav_menu_object( $menu_id );

		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$items = array();

		if(sizeof($menu_items)){
			foreach ($menu_items as $item) {
				if($item->menu_item_parent==0){
					$items[]= array('id'=>$item->ID, 'name'=>$item->title);
				}
			}
		}

		return $items;
	}
}

if(!function_exists('pexeto_get_translation_items')){
	function pexeto_get_translation_items($main_id){
		$items = array();
		if(function_exists('icl_object_id') && function_exists('icl_get_languages')){
			//get the WPML languages
			$languages = icl_get_languages('skip_missing=0');
			foreach ($languages as $lang) {
				$code = $lang['language_code'];
				if(!empty($code)){
					$menu_id_str = icl_object_id($main_id, 'nav_menu', false, $code);
					if(!empty($menu_id_str)){
						$menu_id = intval($menu_id_str);

						if($menu_id!=$main_id){
							$menu_items = pexeto_get_menu_parent_items($menu_id);
							
							if(!empty($menu_items)){
								$items = array_merge($items, $menu_items);
							}
						}
						
					}
				}
			}
		}

		return $items;
	}
}


if(!function_exists('pexeto_get_mega_menu_option_element')){
	function pexeto_get_mega_menu_option_element(){
		if(is_admin()){
			$items = pexeto_get_main_menu_parent_items();

			if(!empty($items)){
				return array(
					'name'=>'Enable mega menu to the following top menu items',
					'id'=>'items_mega_menu',
					'type' => 'multicheck',
					'options' => $items,
					'class'=>'include'
				);
			}else{
				return array(
					'type' => 'documentation',
					'text' => '<h4 class="doc-heading">Enable mega menu to the following items</h4><div class="option-input-wrap"><p>No menu items added</p></div>',
					'desc'=>'In order to enable Mega Menu items, create a custom menu 
					in the Appearance -> Menus section and assign the menu as the Theme Main Menu.
					For more information please refer to the Menus section of the documentation.');
			}
		}

	}
}