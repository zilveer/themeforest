<?php

/**
 * Custom WP_NAV_MENU function for top navigation
 */
if(!class_exists('HueMikadoStickyNavigationWalker')) {
	class HueMikadoStickyNavigationWalker extends Walker_Nav_Menu {
		protected $background_image;

		// add classes to ul sub-menus
		function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
			$id_field = $this->db_fields['id'];
			if(is_object($args[0])) {
				$args[0]->has_children = !empty($children_elements[$element->$id_field]);
			}

			return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}

		function start_lvl(&$output, $depth = 0, $args = array()) {
			$menu_image_background  = '';
			$background_image_class = '';

			if($this->background_image !== '') {
				$menu_image_background  = "background-image:url(".$this->background_image."); background-size: cover; background-repeat: no-repeat; background-position: center;";
				$background_image_class = ' mkd-dropdown-with-background-image';
			}

			$indent = str_repeat("\t", $depth);
			if($depth == 0) {
				$out_div = '<div class="second '.$background_image_class.'" '.hue_mikado_get_inline_style($menu_image_background).'><div class="inner">';
			} else {
				$out_div = '';
			}

			// build html
			$output .= "\n".$indent.$out_div.'<ul>'."\n";
		}

		function end_lvl(&$output, $depth = 0, $args = array()) {
			$indent = str_repeat("\t", $depth);

			if($depth == 0) {
				$out_div_close = '</div></div>';
			} else {
				$out_div_close = '';
			}

			$output .= "$indent</ul>".$out_div_close."\n";
		}

		// add main/sub classes to li's and links
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

			$sub    = '';
			$indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent
			if($depth == 0 && $args->has_children) :
				$sub = ' has_sub';
			endif;
			if($depth == 1 && $args->has_children) :
				$sub = 'sub';
			endif;

			// passed classes
			$classes = empty($item->classes) ? array() : (array) $item->classes;

			$this->background_image = !empty($item->background_image) ? $item->background_image : '';

			$class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

			//menu type class
			$menu_type = '';
			if($depth == 0) {
				if($item->type_menu == 'wide') {
					$menu_type = ' wide';

				} elseif($item->type_menu == 'wide_icons') {
					$menu_type = ' wide icons';
				} else {
					$menu_type = ' narrow';
				}
			}

			//wide menu position class
			$wide_menu_position = '';
			if($depth == 0) {
				if($item->wide_position == 'right') {
					$wide_menu_position = ' right_position';
				} elseif($item->wide_position == 'left') {
					$wide_menu_position = ' left_position';
				} else {
					$wide_menu_position = '';
				}
			}

			$anchor = '';
			if($item->anchor != '') {
				$anchor = '#'.esc_attr($item->anchor);
				$class_names .= ' anchor-item';
			}

			if(!empty($item->icon)) {
				$class_names .= ' mkd-menu-item-with-icon';
			}

			if(!empty($item->description)) {
				$class_names .= ' mkd-menu-item-with-description';
			}

			$active = "";
			// depth dependent classes
			if($item->anchor == "" && (($item->current && $depth == 0) || ($item->current_item_ancestor && $depth == 0))):
				$active = 'mkd-active-item';
			endif;

			// build html
			$output .= $indent.'<li id="sticky-nav-menu-item-'.$item->ID.'" class="'.$class_names.' '.$active.$sub.$menu_type.$wide_menu_position.'">';

			$current_a = "";
			// link attributes
			$attributes = !empty($item->attr_title) ? ' title="'.esc_attr($item->attr_title).'"' : '';
			$attributes .= !empty($item->target) ? ' target="'.esc_attr($item->target).'"' : '';
			$attributes .= !empty($item->xfn) ? ' rel="'.esc_attr($item->xfn).'"' : '';
			$attributes .= ' href="'.esc_attr($item->url).$anchor.'"';
			if(($item->current && $depth == 0) || ($item->current_item_ancestor && $depth == 0)):
				$current_a .= ' current ';
			endif;

			$no_link_class = '';
			if($item->nolink != '') {
				$no_link_class = ' no_link';
			}

			$attributes .= ' class="'.$current_a.$no_link_class.'"';
			$item_output = $args->before;
			if($item->hide == '') {
				if($item->nolink == '') {
					$item_output .= '<a'.$attributes.'><span class="item_outer">';
				} else {
					$item_output .= '<a'.$attributes.' onclick="JavaScript: return false;"><span class="item_outer">';
				}
				if(!empty($item->icon)) {
					$icon = $item->icon;
				}

				$angle_icon = '';
				if($depth == 1) {
					$angle_icon = 'fa-angle-right';
				}

				$item_output .= '<span class="item_inner">';

				$icon_pack = 'font_awesome';

				if(empty($this->icon_pack)) {
					$item->icon_pack = $icon_pack;
				}

				if($item->icon_pack == 'font_awesome' && !empty($icon)) {
					$icon .= ' fa';
				}

				if(!empty($icon)) {
					$item_output .= '<span class="menu_icon_wrapper"><i class="menu_icon '.$icon.'"></i></span>';
				}

				$item_output .= '<span class="item_text">';
				$item_output .= apply_filters('the_title', $item->title, $item->ID);

				$featured_icon = '';
				if($item->featured_icon !== '') {
					$featured_icon .= '<span class="mkd-menu-featured-icon '.$item->featured_icon.'" aria-hidden="true"></span>';
				}

				$item_output .= $featured_icon;

				if(!empty($item->description)) {
					$item_output .= '<span class="mkd-menu-item-description">'.$item->description.'</span>';
				}

				$item_output .= '</span>'; //close span.item_text

				$item_output .= '</span>'; //close span.item_inner
				$item_output .= '<span class="plus"></span>';

				//append arrow for dropdown

				if($args->has_children && $angle_icon != "") {
					$item_output .= '<i class="q_menu_arrow fa '.$angle_icon.'"></i>';
				}

				$item_output .= '</span></a>';
			}

			if($item->sidebar != "" && $depth > 0) {
				ob_start();
				dynamic_sidebar($item->sidebar);
				$sidebar_content = ob_get_contents();
				ob_end_clean();
				$item_output .= $sidebar_content;
			}

			$item_output .= $args->after;

			// build html
			$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		}
	}
}