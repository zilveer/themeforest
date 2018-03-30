<?php

// fix for empty search query
// http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
function roots_request_filter($query_vars) {
  if (isset($_GET['s']) && empty($_GET['s'])) {
    $query_vars['s'] = " ";
  }
  return $query_vars;
}

add_filter('request', 'roots_request_filter');

// root relative URLs for everything
// inspired by http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/
// thanks to Scott Walkinshaw (scottwalkinshaw.com)
function roots_root_relative_url($input) {
  $output = preg_replace_callback(
    '!(https?://[^/|"]+)([^"]+)?!',
    create_function(
      '$matches',
      // if full URL is home_url("/"), return a slash for relative root
      'if (isset($matches[0]) && $matches[0] === home_url("/")) { return "/";' .
      // if domain is equal to home_url("/"), then make URL relative
      '} elseif (isset($matches[0]) && strpos($matches[0], home_url("/")) !== false) { return $matches[2];' .
      // if domain is not equal to home_url("/"), do not make external link relative
      '} else { return $matches[0]; };'
    ),
    $input
  );
  return $output;
}

// Terrible workaround to remove the duplicate subfolder in the src of JS/CSS tags
// Example: /subfolder/subfolder/css/style.css
function roots_fix_duplicate_subfolder_urls($input) {
  $output = roots_root_relative_url($input);
  preg_match_all('!([^/]+)/([^/]+)!', $output, $matches);
  if (isset($matches[1]) && isset($matches[2])) {
    if ($matches[1][0] === $matches[2][0]) {
      $output = substr($output, strlen($matches[1][0]) + 1);
    }
  }
  return $output;
}

// remove root relative URLs on any attachments in the feed
function roots_root_relative_attachment_urls() {
  if (!is_feed()) {
    add_filter('wp_get_attachment_url', 'roots_root_relative_url');
    add_filter('wp_get_attachment_link', 'roots_root_relative_url');
  }
}

function enable_root_relative_urls() {
  return !(is_admin() && in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) && current_theme_supports('root-relative-urls');
}

if (enable_root_relative_urls()) {
  $tags = array(
    'bloginfo_url',
    'theme_root_uri',
    'stylesheet_directory_uri',
    'template_directory_uri',
    'plugins_url',
    'the_permalink',
    'wp_list_pages',
    'wp_list_categories',
    'wp_nav_menu',
    'the_content_more_link',
    'the_tags',
    'get_pagenum_link',
    'get_comment_link',
    'month_link',
    'day_link',
    'year_link',
    'tag_link',
    'the_author_posts_link'
  );

  add_filters($tags, 'roots_root_relative_url');

  add_filter('script_loader_src', 'roots_fix_duplicate_subfolder_urls');
  add_filter('style_loader_src', 'roots_fix_duplicate_subfolder_urls');

  add_action('pre_get_posts', 'roots_root_relative_attachment_urls');
}

// remove WordPress version from RSS feed
function roots_no_generator() { return ''; }
add_filter('the_generator', 'roots_no_generator');

// cleanup wp_head
function roots_noindex() {
  if (get_option('blog_public') === '0') {
    echo '<meta name="robots" content="noindex,nofollow">', "\n";
  }
}

function roots_rel_canonical() {
  if (!is_singular()) {
    return;
  }

  global $wp_the_query;
  if (!$id = $wp_the_query->get_queried_object_id()) {
    return;
  }

  $link = get_permalink($id);
  echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}

// remove CSS from gallery
function roots_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

function roots_attachment_link_class($html) {
  $postid = get_the_ID();
  $html = str_replace('<a', '<a class="thumbnail"', $html);
  return $html;
}
add_filter('wp_get_attachment_link', 'roots_attachment_link_class', 10, 1);

// Replaces 'current-menu-item' with 'active'
function roots_wp_nav_menu($text) {
  $replace = array(
    // List of menu item classes that should be changed to 'active'
    'current-menu-item'     => 'active',
    'current-menu-parent'   => 'active',
    'current-menu-ancestor' => 'active',
    'current_page_item'     => 'active',
    'current_page_parent'   => 'active',
    'current_page_ancestor' => 'active',
  );
  $text = str_replace(array_keys($replace), $replace, $text);
  return $text;
}
add_filter('wp_nav_menu', 'roots_wp_nav_menu');

class Roots_Nav_Walker extends Walker_Nav_Menu {
  function check_current($val) {
    return preg_match('/(current-)/', $val);
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $wp_query;
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $slug = sanitize_title($item->title);
    $id = apply_filters('nav_menu_item_id', 'menu-' . $slug, $item, $args);
    $id = strlen($id) ? '' . esc_attr( $id ) . '' : '';

    $class_names = $value = '';
    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes = array_filter($classes, array(&$this, 'check_current'));

    $custom_classes = get_post_meta($item->ID, '_menu_item_classes', true);
    foreach ($custom_classes as $custom_class) {
      $classes[] = $custom_class;
    }

    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = $class_names ? ' class="' . $id . ' ' . esc_attr($class_names) . '"' : ' class="' . $id . '"';

    $output .= $indent . '<li' . $class_names . '>';

    $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
    $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
    $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
    $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

class Roots_Navbar_Nav_Walker extends Walker_Nav_Menu {
  function check_current($val) {
    return preg_match('/(current-)|active|dropdown/', $val);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\"dropdown-menu\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $wp_query;
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $slug = sanitize_title($item->title);
    $id = apply_filters('nav_menu_item_id', 'menu-' . $slug, $item, $args);
    $id = strlen($id) ? '' . esc_attr( $id ) . '' : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    if ($args->has_children) {
      $classes[]      = 'dropdown';
      $li_attributes .= ' data-dropdown="dropdown"';
    }

    $classes = array_filter($classes, array(&$this, 'check_current'));

    $custom_classes = get_post_meta($item->ID, '_menu_item_classes', true);
    foreach ($custom_classes as $custom_class) {
      $classes[] = $custom_class;
    }

    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = $class_names ? ' class="' . $id . ' ' . esc_attr($class_names) . '"' : ' class="' . $id . '"';

    $output .= $indent . '<li' . $class_names . $li_attributes . '>';

    $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"'    : '';
    $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"'    : '';
    $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"'    : '';
    $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"'    : '';
    $attributes .= ($args->has_children)      ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= ($args->has_children) ? ' <b class="caret"></b>' : '';
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    if (!$element) { return; }

    $id_field = $this->db_fields['id'];

    // display this element
    if (is_array($args[0])) {
      $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
    } elseif (is_object($args[0])) {
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    }
    $cb_args = array_merge(array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'start_el'), $cb_args);

    $id = $element->$id_field;

    // descend only when the depth is right and there are childrens for this element
    if (($max_depth == 0 || $max_depth > $depth+1) && isset($children_elements[$id])) {
      foreach ($children_elements[$id] as $child) {
        if (!isset($newlevel)) {
          $newlevel = true;
          // start the child delimiter
          $cb_args = array_merge(array(&$output, $depth), $args);
          call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
        }
        $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
      }
      unset($children_elements[$id]);
    }

    if (isset($newlevel) && $newlevel) {
      // end the child delimiter
      $cb_args = array_merge(array(&$output, $depth), $args);
      call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
    }

    // end this element
    $cb_args = array_merge(array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'end_el'), $cb_args);
  }
}

function roots_nav_menu_args($args = '') {
  $roots_nav_menu_args['container']  = false;
  $roots_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  if ($args['walker'] == new Roots_Navbar_Nav_Walker()) {
    $roots_nav_menu_args['depth'] = 2;
  }
  if (!$args['walker']) {
    $roots_nav_menu_args['walker'] = new Roots_Nav_Walker();
  }
  return array_merge($args, $roots_nav_menu_args);
}

add_filter('wp_nav_menu_args', 'roots_nav_menu_args');

// set the post revisions to 5 unless the constant
// was set in wp-config.php to avoid DB bloat
if (!defined('WP_POST_REVISIONS')) { define('WP_POST_REVISIONS', 5); }

// allow more tags in TinyMCE including <iframe> and <script>
function roots_change_mce_options($options) {
  $ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src],script[charset|defer|language|src|type]';
  if (isset($initArray['extended_valid_elements'])) {
    $options['extended_valid_elements'] .= ',' . $ext;
  } else {
    $options['extended_valid_elements'] = $ext;
  }
  return $options;
}

add_filter('tiny_mce_before_init', 'roots_change_mce_options');

// first and last classes for widgets
// http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
function roots_widget_first_last_classes($params) {
  global $my_widget_num;
  $this_id = $params[0]['id'];
  $arr_registered_widgets = wp_get_sidebars_widgets();

  if (!$my_widget_num) {
    $my_widget_num = array();
  }

  if (!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) {
    return $params;
  }

  if (isset($my_widget_num[$this_id])) {
    $my_widget_num[$this_id] ++;
  } else {
    $my_widget_num[$this_id] = 1;
  }

  $class = 'class="widget-' . $my_widget_num[$this_id] . ' ';

  if ($my_widget_num[$this_id] == 1) {
    $class .= 'widget-first ';
  } elseif ($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) {
    $class .= 'widget-last ';
  }

  $params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);

  return $params;

}
add_filter('dynamic_sidebar_params', 'roots_widget_first_last_classes');
