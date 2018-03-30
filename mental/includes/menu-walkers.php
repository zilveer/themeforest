<?php
/**
 * Custom Menu Walkers
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Class Topmenu_Walker_Nav_Menu
 */
class Topmenu_Walker_Nav_Menu extends Walker_Nav_Menu
{
	function start_lvl( &$output, $depth = 0, $args = array() )
	{
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown\">\n";
	}
}