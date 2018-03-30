<?php
/**
 * Append a link to menu when no location is selected
 *
 * @author		Bob Ulusoy
 * @copyright	Artbees LTD (c)
 * @link		http://artbees.net
 * @since		Version 5.3
 * @package 	artbees
 */
if (!function_exists('mk_link_to_menu_editor')) {
    function mk_link_to_menu_editor($args) {
        if (!current_user_can('manage_options')) {
            return;
        }
        extract($args);
        
        if (FALSE !== stripos($items_wrap, '<ul') or FALSE !== stripos($items_wrap, '<ol')) {
            $link = '<li class="menu-item"><a class="menu-item-link js-smooth-scroll" href="' . admin_url('nav-menus.php') . '">' . $before . 'Add a menu' . $after . '</a></li>';
        }
        
        $output = sprintf($items_wrap, $menu_id, $menu_class, $link);
        if (!empty($container)) {
            $output = "<$container class='$container_class' id='$container_id'>$output</$container>";
        }
        
        if ($echo) {
            echo $output;
        }
        
        return $output;
    }
}