<?php
namespace Handyman\Extras;
use Handyman\Core as C;

global $tl_is_popup;
$tl_is_popup = \Handyman\Core\Assets::$is_popup;


function addX($items, $args)
{
    $items = preg_replace('~</li>[\n\s]*<li~', '</li><li class="devider"><i class="l-close"></i></li><li', $items);
    return $items;
}


/**
 * Return true if 404 or search result page
 *
 * @return bool
 */
function is_404_or_search()
{
    return (is_404() || is_search());
}


/**
 * eturn true if page related to blog posts. Lists or singular
 *
 * @return bool
 */
function is_blog()
{
    $cond = new C\Conditional_Tag_Checker(array(
        'is_single',
        'is_archive',
        'is_attachment',
        '\Handyman\Extras\_is_blog',
        array('is_page_template', 'template-blog.php'),
    ));

    return !$cond->getResult();
}

function _is_blog(){
    return !is_front_page() && is_home();
}


function is_blog_or_404_search(){
    return is_blog() || is_404_or_search();
}


/**
 * Returns TRUE if page.php
 *
 * @return bool
 */
function is_default_page_template(){
    return (is_page() && !is_page_template());
}


/**
 * @return bool
 */
function is_not_layers_page(){
    global $post;

    if(!$post){ return false;}

    return !is_layers_builder_template($post->ID);
}

/**
 * Returns true if 404, search result page or listed custom templates
 * @return bool
 */
function is_custom_template()
{
    $cond = new C\Conditional_Tag_Checker(array(
        '\Handyman\Extras\is_default_page_template',
        array('is_page_template', 'template-both-sidebar.php'),
        array('is_page_template', 'template-left-sidebar.php'),
        array('is_page_template', 'template-right-sidebar.php'),
    ));

    return !$cond->getResult();
}


/**
 * @param string $key
 * @param int|null $post_id
 * @param bool $single
 *
 * @return array|string
 */
function get_metadata($post_id = null, $key = '', $default = null, $single = true)
{

    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }
    $meta = \get_metadata('post', $post_id, '', $single);

    if ($single && $key == '') {
        $tmp = array();
        foreach ($meta as $i => $v) {
            $tmp[$i] = isset($v[0]) ? $v[0] : $v;
        }
        $meta = $tmp;
    }

    if ($key) {
        if (!array_key_exists($key, $meta)) {
            $meta = $default;
        } else {
            $meta = $meta[$key][0];
        }
    }
    return $meta;
}

/**
 *
 *
 * @param array $args
 * @return \WP_Query
 */
function tl_get_posts_query($args = array())
{

    $defaults = array(
        'force_no_custom_order' => true,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'lang' => '', // polylang, ingore language filter
        'suppress_filters' => 1, // wpml, ignore language filter
        'posts_per_page' => -1,
    );

    $args = wp_parse_args($args, $defaults);
    $query = new \WP_Query($args);
    return $query;
}


/**
 * Return list of posts
 *
 * @param array $args
 * @param bool $extended
 * @return array|\WP_Query
 */
function tl_get_posts($args = array(), $extended = false)
{
    $data = array();
    $defaults = array('post_type' => 'post',
        'order' => 'ASC',
        'orderby' => 'title',
        'post_status' => 'publish',
        'posts_per_page' => -1);

    $args = wp_parse_args($args, $defaults);
    $posts = new \WP_Query($args);
    if (!empty($posts->posts)) {
        if (!$extended) {
            foreach ($posts->posts as $p) {
                $data[$p->ID] = $p->post_title;
            }
        } else {
            $data = $posts;
        }
    }
    wp_reset_postdata();
    return $data;
}


/**
 * Return pages
 *
 * @param array $args
 * @param bool $extended
 * @return array|\WP_Query
 */
function tl_get_pages($args = array(), $extended = false)
{
    $args['post_type'] = 'page';
    $data = tl_get_posts($args, $extended);
    return $data;
}


if (!function_exists('\Handyman\Extras\tl_get_sidebars')) {
    /**
     * Return a list of registered sidebars excluding Layers sidebar/Mobile sidebar
     */
    function tl_get_sidebars()
    {
        global $wp_registered_sidebars;
        $sidebars_data = array();

        if (!empty($wp_registered_sidebars)) {
            foreach ($wp_registered_sidebars as $id => $sidebar) {
                if ((strpos($id, 'obox-layers-builder') === false) && strpos($id, 'layers-off-canvas-sidebar') === false) {
                    $sidebars_data[$id] = $sidebar['name'];
                }
            }
        }
        return $sidebars_data;
    }
}

if (!function_exists('\Handyman\Extras\tl_get_forms')) {
    /**
     * @return array|\WP_Query
     */
    function tl_get_forms($minimal = false)
    {
        $data = array();
        $forms = tl_get_posts(array(
            'post_type' => 'wpcf7_contact_form'
        ));

        if ($minimal) {
            foreach ($forms as $k => $v) {
                $data[$v->ID] = $v->post_title;
            }
        } else {
            $data = $forms;
        }
        return $data;
    }
}

if (!function_exists('\Handyman\Extras\unregister_nav_menu')):
    function unregister_nav_menu($location)
    {
        global $_wp_registered_nav_menus;

        if (is_array($_wp_registered_nav_menus) && array_key_exists($location, $_wp_registered_nav_menus)) {
            unset($_wp_registered_nav_menus[$location]);
            return true;
        }

        return false;
    }
endif;


if (!function_exists('Handyman\Extras\hex2rgba')) {

    /**
     * Convert HEX color to RGB/RGBA
     *
     * @param $color
     * @param int $opacity
     * @param bool $return_str
     * @param string $separator
     * @return array|bool|null|string
     */
    function hex2rgba($color, $opacity = 1, $return_str = false, $separator = ',')
    {
        if (FALSE === strpos($color, '#')) {
            // Not a color
            return NULL;
        }

        $rgb_arr = array();
        $hex = str_replace('#', '', $color);

        if (strlen($hex) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster

            $rgb_arr['red'] = hexdec(substr($hex, 0, 2));
            $rgb_arr['green'] = hexdec(substr($hex, 2, 2));
            $rgb_arr['blue'] = hexdec(substr($hex, 4, 2));

        } elseif (strlen($hex) == 3) { //if shorthand notation, need some string manipulations

            $rgb_arr['red'] = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $rgb_arr['green'] = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $rgb_arr['blue'] = hexdec(str_repeat(substr($hex, 2, 1), 2));

        } else {
            return false; //Invalid hex color code
        }

        $rgb_arr['opacity'] = $opacity;

        return $return_str ? implode($separator, $rgb_arr) : $rgb_arr; // returns the rgb string or the associative array
    }
}

if(!function_exists('is_layers_builder_template')){

    /**
     * @param $page_id
     * @return bool
     */
    function is_layers_builder_template($page_id)
    {
        return (get_page_template_slug($page_id) == 'builder.php');
    }
}


function tl_primary_navigation_off($control){
    if ( $control->manager->get_setting(LAYERS_THEME_SLUG . '-header-show-primary-navigation')->value() != true) {
        return true;
    } else {
        return false;
    }
}