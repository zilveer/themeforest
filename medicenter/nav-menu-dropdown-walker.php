<?php
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu
{
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
	}

	function end_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id=0)
	{
		$item->title = str_repeat("-", $depth)." ".$item->title;

		parent::start_el($output, $item, $depth, $args);
		
		$output = str_replace('<li', '<option value="' . $item->url . '"' . (in_array("current-menu-item", (array)$item->classes) ? ' selected="selected"' : ''), $output);
		$output = strip_tags($output, '<select>,<option>');
	}

	function end_el(&$output, $item, $depth = 0, $args = array())
	{
		$output .= "</option>\n";
	}
}
class Walker_Nav_Menu_Layout2 extends Walker_Nav_Menu
{
	function end_el(&$output, $item, $depth = 0, $args = array())
	{
		if($depth==0 /*&& !(in_array("current-menu-item", (array)$item->classes)) && !(in_array("current-menu-parent", (array)$item->classes))*/)
			$output .= "</li><li class='menu_separator'></li>\n";
	}
}
?>
