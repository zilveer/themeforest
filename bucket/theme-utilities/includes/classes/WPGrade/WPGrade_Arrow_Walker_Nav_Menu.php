<?php

	/**
	 * Create a walker which will add a class to items with submenus
	 * More http://stackoverflow.com/questions/3558198/php-wordpress-add-arrows-to-parent-menus
	 */
	class WPGrade_Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
		function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
			$id_field = $this->db_fields['id'];
			if ( ! empty($children_elements[$element->$id_field])) {
				$element->classes[] = 'menu-parent-item'; //enter any classname you like here!
			}
			Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}
	}
