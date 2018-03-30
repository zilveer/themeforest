<?php

class iron_nav_walker extends Walker_Nav_Menu
{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	  	$indent = str_repeat("\t", $depth);
	  	$output .= "\n$indent<ul class=\"sub-menu\"><li class='backlist'><a href='#' class='backbtn'>".__("Back")."</a></li>\n";
	}
}