<?php

//Multi-level pages menu
function multipurpose_page_menu() {
    if (is_page()) { $highlight = "page_item"; } else {$highlight = "menu-item current-menu-item"; }
    echo '<ul>';
    wp_list_pages('container=&sort_column=menu_order&title_li=&link_before=&link_after=&depth=3');
    echo '</ul>';
}
function multipurpose_mobile_menu_fallback () {
	if (is_page()) { $highlight = "page_item"; } else {$highlight = "menu-item current-menu-item"; }
    $links = get_pages('sort_column=menu_order&depth=3');
    echo '<select>';
    echo '<option value="'.home_url().'">'.esc_attr__('Menu', 'multipurpose').'</option>';
    foreach($links as $lnk) {
    	$permalink = get_permalink($lnk->ID);
    	if($permalink == current_page_url()) $selected = 'selected="selected"';
		else $selected = '';
    	echo '<option value="'.$permalink.'" '.$selected.'>'.$lnk->post_title.'</option>';
    }
    echo '</select>';

}
/*
* 	Menu walker to create menu as select for mobile
*/

class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
	public $current_level = 0;

	function start_lvl(&$output, $depth = 0, $args = array()){
		$indent = str_repeat("-", $depth); // don't output children opening tag (`<ul>`)
		$this->current_level++;
	}
	 
	function end_lvl(&$output, $depth = 0, $args = array()){
		$indent = str_repeat("\t", $depth); // don't output children closing tag
		$this->current_level--;
	}
	 
	/**
	* Start the element output.
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param object $item Menu item data object.
	* @param int $depth Depth of menu item. May be used for padding.
	* @param array $args Additional strings.
	* @return void
	*/

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$indent = str_repeat("-", $this->current_level) . ' ';
		$url = '#' !== $item->url ? $item->url : '';
		if($url == current_page_url()) $selected = 'selected="selected"';
		else $selected = '';
		$output .= '<option value="' . $url . '" '.$selected.'>' . $indent . $item->title . '</option>';
	}	
	 
	function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
		$output .= "\n"; // replace closing </li> with the option tag
	}
}

function multipurpose_mobile_menu($select_id, $select_name, $theme_location) {
  	$items = '';
  	if (function_exists('icl_get_languages')) {
    	$languages = icl_get_languages('skip_missing=0');
    	if(1 < count($languages)){
      	  foreach($languages as $l){
        	  $items = $items.'<option value="'.$l['url'].'">'.$l['native_name'].'('.$l['translated_name'].')</option>';
      		}
    	}
  	}
		
	$menu = wp_nav_menu( array(
		'theme_location' => $theme_location,
		'walker' => new Walker_Nav_Menu_Dropdown(),
		'items_wrap' => '<select id="'.$select_id.'" name="'.$select_name.'"><option value="#">'.esc_attr__('Menu', 'multipurpose').'</option>%3$s'.$items.'</select>',
		'container' => false,
		'fallback_cb' => 'multipurpose_mobile_menu_fallback',
		'echo' => false
	) );
		
	if (function_exists('icl_get_languages')) {
		preg_replace('#<li .*?</ul></li>#s', "", $menu);
	}
		
	echo $menu; 
}
add_action( 'genesis_before_header', 'multipurpose_mobile_menu' );