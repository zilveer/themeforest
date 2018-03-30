<?php
namespace Handyman\Core;
/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * NavWalker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */
class TL_Custom_Menu_Walker extends \Walker_Nav_Menu
{

    /**
     * @var bool
     */
    private $cpt; // Boolean, is current post a custom post type


    /**
     * @var string
     */
    private $archive; // Stores the archive page for current URL


    public function __construct()
    {
        add_filter('nav_menu_css_class', array($this, 'cssClasses'), 10, 2);
        add_filter('nav_menu_item_id'  , '__return_null');
        $cpt = get_post_type();
        $this->cpt     = in_array($cpt, get_post_types(array('_builtin' => false)));
        $this->archive = get_post_type_archive_link($cpt);
    }


    /**
     * @param $classes
     * @return int
     */
    public function checkCurrent($classes)
    {
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }


    /**
     * @param string $output
     * @param int $depth
     * @param array $args
     */
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "\n<ul class=\"dropdown-menu\">\n";
    }


    /**
     * @param $output
     * @param $item
     * @param int $depth
     * @param array $args
     * @param int $id
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        if ($item->is_dropdown && ($depth === 0)) {
            $item_html = str_replace('<a', '<a class="dropdown-toggle"', $item_html);
        } elseif (stristr($item_html, 'li class="divider')) {
            $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
        } elseif (stristr($item_html, 'li class="dropdown-header')) {
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
        }

        $item_html = apply_filters('tl_wp_nav_menu_item', $item_html);
        $output .= $item_html;
    }


    /**
     * @param $element
     * @param $children_elements
     * @param $max_depth
     * @param int $depth
     * @param $args
     * @param $output
     * @return null|void
     */
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

        if ($element->is_dropdown) {
            $element->classes[] = 'dropdown';
        }

        if ($element->is_active) {
            $element->classes[] = 'active';
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }


    // @codingStandardsIgnoreEnd
    /**
     * @param $classes
     * @param $item
     * @return array
     */
    public function cssClasses($classes, $item)
    {
        $slug = sanitize_title($item->title);

        if ($this->cpt) {
            $classes = str_replace('current-page_parent', '', $classes);
        }

        $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
        $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);
        $classes[] = 'menu-' . $slug;
        $classes[] = 'menu-item';
        $classes = array_unique($classes);

        return array_filter($classes, array('\Handyman\Core\Util', 'isElementEmpty'));
    }
}


/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Remove the id="" on nav menu items
 */
function nav_menu_args($args = '')
{
    add_filter('wp_nav_menu_items', '\Handyman\Extras\addX', 10, 2);

    $nav_menu_args = array();
    $nav_menu_args['walker']          = new TL_Custom_Menu_Walker();
    $nav_menu_args['container']       = isset($args['container'])       ? $args['container'] : 'div';
    $nav_menu_args['container_class'] = isset($args['container_class']) ? $args['container_class'] . ' tl-nav-container' : ' tl-nav-container';
    $nav_menu_args['menu_class']      = (isset($args['menu_class'])     ? $args['menu_class'] : '') . ' tl-main-navigation';

   // $nav_menu_args['container_class'] = isset($args['container_class']) ? $args['container_class'] : '';
   // $nav_menu_args['menu_class'] = isset($args['menu_class']) ? $args['menu_class'] : '';


    // Its not mobile navigation
    if(strpos($nav_menu_args['container_class'], 'nav-vertical' ) === false){
        $nav_menu_args['menu_class'] .= ' flexnav lg-screen';
    }

    //if (!$args['items_wrap']) {
        $nav_menu_args['items_wrap'] = '<ul data-breakpoint="769" class="%2$s">%3$s</ul>';
    //}

    if (!$args['depth']) {
        $nav_menu_args['depth'] = 3;
    }

    return array_merge($args, $nav_menu_args);
}

add_filter('wp_nav_menu_args', __NAMESPACE__ . '\\nav_menu_args');
add_filter('nav_menu_item_id', '__return_null');