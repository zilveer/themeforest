<?php
/**
 * Used for header style 3 & 4 that appends only icon
 *
 * @author		Bob Ulusoy
 * @copyright	Artbees LTD (c)
 * @link		http://artbees.net
 * @since		Version 5.3
 * @package 	artbees
 */
class header_icon_walker extends Walker_Nav_Menu
{

     /**
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output.= '<span class="menu-sub-level-arrow">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-angle-right', 16).'</span>';
        $output.= "\n$indent<ul class=\"sub-menu \">\n";

        $output.='<li class="mk-vm-back"><a href="#">' . Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-angle-left', 16) . __('Back', 'mk_framework'). '</a></li>';
    }



    function start_el(&$output, $item, $depth = 0, $args = array() , $current_object_id = 0) {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $this->menu_icon = get_post_meta($item->ID, '_menu_item_menu_icon', true);
        
        $class_names = $value = '';
        
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes) , $item));
        $class_names = ' class="' . esc_attr($class_names) . '"';
        
        $output.= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes.= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes.= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes.= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        $menu_icon_tag = !empty($this->menu_icon) ? '<span class="menu-item-icon">' . Mk_SVG_Icons::get_svg_icon_by_class_name(false, $this->menu_icon, 16) . '</span>' : '';
        
        $item_output = $args->before;
        $item_output.= '<a' . $attributes . '>';
        $item_output.= $menu_icon_tag . $args->link_before . '<span class="meni-item-text">' . apply_filters('the_title', $item->title, $item->ID) . '</span>';
        $item_output.= $args->link_after;
        $item_output.= '</a>';
        $item_output.= $args->after;
        
        $output.= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}