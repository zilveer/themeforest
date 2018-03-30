<?php
namespace Handyman;




/**
 * Little clean up after shortcoded mess
 */
if (!function_exists('\Handyman\content_cleaner')) {
    function content_cleaner($content)
    {
        $content = preg_replace(array('~<p>[\s]*<div/>~', '~</div>[\s]*</p>~'), array('<div', '</div>'), $content);
        return $content;
    }
}
add_filter('the_content', 'Handyman\content_cleaner', 99);
add_filter('the_excerpt', 'Handyman\content_cleaner', 99);


/**
 * Customize Protected content form
 */
if (!function_exists('\Handyman\custom_password_form')) {

    function custom_password_form()
    {
        global $post;
        $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
        $o = '<form class="post-password-form" action="' .  esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '/wp-pass.php" method="post">
                 <em>' . __('This content is password protected. To view it please enter your password below', TL_DOMAIN) . '</em>
                 <input placeholder="Enter your password here" name="post_password" id="' . esc_attr($label) . '" type="password" style="background: #ffffff; border:1px solid #999; color:#333333; padding:10px;" size="20" /><input type="submit" name="Submit" class="button" value="' . esc_attr__("Submit") . '" />
              </form>';
        return $o;
    }
}
add_filter('the_password_form', '\Handyman\custom_password_form');


if (!function_exists('wrap_nth_word')) {
    function wrap_nth_word($str, $n = 1, $wrapper = 'span', $color = '')
    {
        $parts = explode(' ', $str);
        $n_total = count($parts);
        $n = absint($n);

        if ($n_total < 2 || $n_total < $n) {
            return $str;
        } else {
            $color = isset($color) && $color != '' ? 'style="color:' . esc_attr($color) . '"' : '';
            $parts[$n - 1] = '<span ' . $color . '>' . esc_html($parts[$n - 1]) . '</span>';
            return implode(' ', $parts);
        }
    }
}
add_filter('tl/wrap_nth_word', 'Handyman\wrap_nth_word', 99, 4);


/**
 * Sanitize provided input data
 *
 * @param $data
 * @return null|string
 */
if (!function_exists('tl_sanitize_input')) {
    function tl_sanitize_input($data)
    {
        $sanitarized = null;

        if (is_array($data) || is_object($data)) {
            $data = (array)$data;
            foreach ($data as $k => $v) {
                $sanitarized[$k] = sanitize_text_field($v);
            }
        } else {
            $sanitarized = sanitize_text_field($data);
        }
        return $sanitarized;
    }
}
add_filter('tl/sanitize_input', 'Handyman\tl_sanitize_input', 99);



/**
 * Filter data
 *
 * @param array $filter
 * @param $data
 * @return array
 */
if (!function_exists('tl_filter_input')) {
    function tl_filter_input($filter, $data)
    {
        if (is_array($data) || is_object($data)) {
            $data = (array)$data;
            $r = array();
            foreach ($filter as $f) {
                if (isset($data[$f])) {
                    $r[$f] = $data[$f];
                }
            }
            return $r;
        } else {
            return $data;
        }
    }
}
add_filter('tl/filter_input', '\Handyman\tl_filter_input', 10, 2);


if(!function_exists('\Handyman\tl_wp_list_categories_widget')) {
    /**
     * Wrap count to a span tag
     *
     * @param $output
     * @param $args
     * @return mixed
     */
    function tl_wp_list_categories_widget($output, $args)
    {
        if (isset($args['show_count']) && $args['show_count'] == 1) {
            $output = preg_replace('/\((\d+)\)/i', '<span>$1</span>', $output);
        }
        return $output;
    }
}
add_filter('wp_list_categories', '\Handyman\tl_wp_list_categories_widget', 100, 2);

/**
 * Parameters:
 *
 * @param string $color
 * @param mixed $opacity
 * @param bool $return_str
 * @param string $separator
 *
 * @return array|bool|null|string
 */
add_filter('tl/hex2rgba', '\Handyman\Extras\hex2rgba', 10, 4);


//add_filter('layers_center_column_class', '\Handyman\tl_layers_center_column_class', 10, 2);
function tl_layers_center_column_class($classes, $class){

    $classes = array_diff($classes, array('column'));
    $classes[] = 'column-flush';
    return $classes;
}