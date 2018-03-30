<?php
/**
 * Responsive Main Navigation walker
 *
 * @access      public
 * @since       1.0
 * @return      void
 */
class mk_main_menu_responsive_walker extends Walker_Nav_Menu
{
    
    /**
     * @var int $columns
     */
    
    /**
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if($depth == 0) {
            $output.= '<span class="mk-nav-arrow mk-nav-sub-closed">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-moon-arrow-down', 16).'</span>';
        }
        $output.= "\n$indent<ul class=\"sub-menu {locate_class}\">\n";
    }
    
    /**
     * @see Walker::end_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output.= "$indent</ul>\n";
        
   
        $output = str_replace("{locate_class}", "", $output);
    }
    
    function start_el(&$output, $item, $depth = 0, $args = array() , $current_object_id = 0) {
        global $wp_query;
        
        $item_output = '';
        $this->megamenu_widgetarea = get_post_meta($item->ID, '_menu_item_megamenu_widgetarea', true);
        $this->menu_icon = get_post_meta($item->ID, '_menu_item_menu_icon', true);
                
        $title = apply_filters('the_title', $item->title, $item->ID);
        
           
        $menu_icon_tag = !empty($this->menu_icon) ? Mk_SVG_Icons::get_svg_icon_by_class_name(false, $this->menu_icon, 16) : '';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes.= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes.= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes.= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : ' href="#"';
        
        $item_output.= $args->before;
        $item_output.= '<a class="menu-item-link js-smooth-scroll" ' . $attributes . '>';
        $item_output.= $menu_icon_tag;
        $item_output.= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output.= '</a>';
        $item_output.= $args->after;
        
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes) , $item));
        $class_names = ' class="' . esc_attr($class_names) . '"';
        
        $output.= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        
        $output.= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}