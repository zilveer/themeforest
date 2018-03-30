<?php


add_filter( 'locale', 'mk_theme_localized' );
function mk_theme_localized( $locale ) {
      if ( isset( $_GET['l'] ) )
      {
          return esc_attr( $_GET['l'] );
      }
      return $locale;
}


add_action('after_setup_theme', 'mk_theme_langauge');

function mk_theme_langauge(){
    load_theme_textdomain('mk_framework', get_stylesheet_directory() . '/languages');
}



/* 
Adds shortcodes dynamic css into footer.php
*/
if (!function_exists('mk_dynamic_css_injection')) {
     function mk_dynamic_css_injection()
     {

      global $ken_json, $ken_styles;  
    
    $output = '<script type="text/javascript">';
    

    $backslash_styles = str_replace('\\', '\\\\', $ken_styles);
    $clean_styles = preg_replace('!\s+!', ' ', $backslash_styles);
    $clean_styles_w = str_replace("'", "\"", $clean_styles);
    $is_admin_bar = is_admin_bar_showing() ? 'true' : 'false';
    $ken_json_encode = json_encode($ken_json);
    $output .= '  
    php = {
        hasAdminbar: '.$is_admin_bar.',
        json: ('.$ken_json_encode.' != null) ? '.$ken_json_encode.' : "",
        styles:  \''.$clean_styles_w.'\'
      };
      
    var styleTag = document.createElement("style"),
      head = document.getElementsByTagName("head")[0];

    styleTag.type = "text/css";
    styleTag.innerHTML = php.styles;
    head.appendChild(styleTag);
    </script>';

    echo $output;

     }
}

add_action('wp_footer', 'mk_dynamic_css_injection');
/*-----------------*/


function mk_clean_dynamic_styles($value) {

  $clean_styles = preg_replace('!\s+!', ' ', $value);
  $clean_styles_w = str_replace("'", "\"", $clean_styles);

  return $clean_styles_w;

}

function mk_clean_init_styles($value) {

  $backslash_styles = str_replace('\\', '\\\\', $value);
  $clean_styles = preg_replace('!\s+!', ' ', $backslash_styles);
  $clean_styles_w = str_replace("'", "\"", $clean_styles);

  return $clean_styles_w;

}



/*
 * Convert theme settings to a globaly accessible vaiable throught the theme.
 */
if (!function_exists('mk_set_accent_color_global')) {
      function mk_set_accent_color_global()
      {
            
            global $mk_settings;
            
            if (isset($_GET['skin'])) {
                  
                  $GLOBALS['mk_accent_color'] = "#" . $_GET['skin'];
                  
            } else {
                  
                  $GLOBALS['mk_accent_color'] = isset($mk_settings['accent-color']) ? $mk_settings['accent-color'] : '#16a085';
                  
            }
            
      }
}

add_action('wp_loaded', 'mk_set_accent_color_global');
/*-----------------*/




function mk_thumbnail_image_gen($image, $width, $height) {
  require_once THEME_INCLUDES . "/image-cropping.php";    

   $default = includes_url() . 'images/media/default.png';

   if(($image == $default) || empty($image)) {

      $image_url = THEME_IMAGES . '/dummy-images/dummy-'.mt_rand(1,7).'.png';
   } else {

      $image_url = $image;
   }


   if(!empty($width) && !empty($height)) {
         $image = bfi_thumb($image_url, array(
            'width' => $width,
            'height' => $height,
            'crop' => true
          ));
          
          return $image; 
    } else {
        return $image_url;
    }
    return false;

}







if (!function_exists('mk_get_shop_id')) {
     function mk_get_shop_id()
     {
          if(function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {

              return wc_get_page_id( 'shop' );

          } else {

            return false;
          }
     }
}

if (!function_exists('mk_is_woo_archive')) {
     function mk_is_woo_archive()
     {
          if(function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {

              return wc_get_page_id( 'shop' );

          } else {

            return false;
          }
     }
}


if (!function_exists('global_get_post_id')) {
     function global_get_post_id()
     {
          if(function_exists('is_woocommerce') && is_woocommerce() && is_shop()) {

              return wc_get_page_id( 'shop' );

          } else if(is_singular() || is_home()) {

            global $post;

            return $post->ID;

          }else {

            return false;
          }
     }
}


/*
 * Fixes empty p tags without changing autop functionality.
 */

if (!function_exists('mk_shortcode_empty_paragraph_fix')) {
      function mk_shortcode_empty_paragraph_fix($content)
      {
            $array = array(
                  '<p>[' => '[',
                  ']</p>' => ']',
                  ']<br />' => ']'
            );
            
            $content = strtr($content, $array);
            
            return $content;
      }
}
add_filter('the_content', 'mk_shortcode_empty_paragraph_fix');
/*-----------------*/


// Register your custom function to override some LayerSlider data
add_action('layerslider_ready', 'my_layerslider_overrides');
function my_layerslider_overrides() {

    // Disable auto-updates
    $GLOBALS['lsAutoUpdateBox'] = false;
}


/*
 * Adds WP ajax library path.
 */
if (!function_exists('mk_add_ajax_library')) {
      function mk_add_ajax_library()
      {
            $html = '<script type="text/javascript">';
            $html .= 'var ajaxurl = "' . admin_url('admin-ajax.php') . '"';
            $html .= '</script>';
            echo $html;
      }
}

add_action('wp_enqueue_scripts', 'mk_add_ajax_library');
/*-----------------*/



/*
 * Adds Debugging tool for support, outputs theme name and version.
 */
if (!function_exists('mk_theme_debugging_info')) {
      function mk_theme_debugging_info()
      {
            
            $theme_data = wp_get_theme();
            echo '<meta name="generator" content="' . wp_get_theme() . ' ' . $theme_data['Version'] . '" />' . "\n";
            
      }
}
add_action('wp_head', 'mk_theme_debugging_info');
/*-----------------*/




/*
Removes version paramerters from scripts and styles.
*/
if (!function_exists('mk_remove_wp_ver_css_js')) {
      function mk_remove_wp_ver_css_js($src)
      {
            global $mk_settings;
            if ($mk_settings['remove-js-css-ver']) {
                  if (strpos($src, 'ver='))
                        $src = remove_query_arg('ver', $src);
            }
            return $src;
      }
}
add_filter('style_loader_src', 'mk_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'mk_remove_wp_ver_css_js', 9999);



/*
 * Converts Hex value to RGBA if needed.
 */
if (!function_exists('mk_convert_rgba')) {
      function mk_convert_rgba($colour, $alpha)
      {
            if (!empty($colour)) {
                  if ($alpha >= 0.95) {
                        return $colour; // If alpha is equal 1 no need to convert to RGBA, so we are ok with it. :)
                  } else {
                        if ($colour[0] == '#') {
                              $colour = substr($colour, 1);
                        }
                        if (strlen($colour) == 6) {
                              list($r, $g, $b) = array(
                                    $colour[0] . $colour[1],
                                    $colour[2] . $colour[3],
                                    $colour[4] . $colour[5]
                              );
                        } elseif (strlen($colour) == 3) {
                              list($r, $g, $b) = array(
                                    $colour[0] . $colour[0],
                                    $colour[1] . $colour[1],
                                    $colour[2] . $colour[2]
                              );
                        } else {
                              return false;
                        }
                        $r      = hexdec($r);
                        $g      = hexdec($g);
                        $b      = hexdec($b);
                        $output = array(
                              'red' => $r,
                              'green' => $g,
                              'blue' => $b
                        );
                        
                        return 'rgba(' . implode($output, ',') . ',' . $alpha . ')';
                  }
            }
      }
}
/*-----------------*/




/*
 * Login Widget ajax functions
 */
function ajax_login_init() {

      global $mk_settings;

      $minified = $mk_settings['minify-js'] ? 'theme-scripts-min' : 'theme-scripts';

      wp_localize_script( $minified, 'ajax_login_object', array(
                  'ajaxurl' => admin_url( 'admin-ajax.php' ),
                  'redirecturl' => home_url(),
                  'loadingmessage' => __( 'Sending user info, please wait...' , 'mk_framework')
            ) );

}
if ( !is_user_logged_in() ) {
      add_action( 'wp_footer', 'ajax_login_init' );
}

add_action( 'wp_ajax_nopriv_ajaxlogin', 'mk_ajax_login' );

function mk_ajax_login() {
      check_ajax_referer( 'ajax-login-nonce', 'security' );

      // Nonce is checked, get the POST data and sign user on
      $info = array();
      $info['user_login'] = $_POST['username'];
      $info['user_password'] = $_POST['password'];
      $info['remember'] = true;

      $user_signon = wp_signon( $info, false );
      if ( is_wp_error( $user_signon ) ) {
            echo json_encode( array( 'loggedin'=>false, 'message'=>__( 'Wrong username or password.', 'mk_framework' ) ) );
      } else {
            echo json_encode( array( 'loggedin'=>true, 'message'=>__( 'Login successful, redirecting...', 'mk_framework' ) ) );
      }

      die();
}
/*-----------------*/

if (!function_exists('mk_add_admin_bar_link')) {
    function mk_add_admin_bar_link() {
        global $wp_admin_bar;
        $theme_data = wp_get_theme();
        $action = 'mk_purge_cache';
        
        if (!current_user_can('manage_options') || !is_admin_bar_showing()) return;
        
        $wp_admin_bar->add_menu(array(
            'id' => 'theme_settings',
            'title' => __('Theme Options', 'mk_framework') ,
            'href' => admin_url('admin.php?page=theme_settings')
        ));
        
        $wp_admin_bar->add_menu(array(
            'title' => __('Clear Theme Cache', 'mk_framework') ,
            'id' => 'clean_dynamic_styles',
            'href' => wp_nonce_url(admin_url('admin-post.php?action=mk_purge_cache') , 'theme_purge_cache')
        ));
    }
}
add_action('admin_bar_menu', 'mk_add_admin_bar_link', 30);

/*-----------------*/




/**
 * Purge Cache for dynamic styles and scripts.
 *
 */
add_action('admin_post_mk_purge_cache', 'mk_purge_cache');
function mk_purge_cache() {
    if (isset($_GET['action'], $_GET['_wpnonce'])) {
        
        if (!wp_verify_nonce($_GET['_wpnonce'], 'theme_purge_cache')) {
            wp_nonce_ays('');
        }
        mk_purge_cache_actions();
        
        /* purge wp super cache */
        if(function_exists('wp_cache_clear_cache')) {
          wp_cache_clear_cache();  
        }
        
        wp_redirect(wp_get_referer());
        die();
    }
}

function mk_purge_cache_actions() {
    global $wpdb;
    
    $wpdb->query($wpdb->prepare("
                 DELETE FROM $wpdb->postmeta
                 WHERE meta_key = %s
                ", '_dynamic_styles'));
    $static = new Mk_Static_Files(false);
    $static->DeleteThemeOptionStyles();
}


// clear cache on theme save options
add_action ('redux/options/mk_settings/saved', 'mk_purge_cache_actions');




/*
 * Converts given php native time() to human time. needful to twitter widget.
 */
if (!function_exists('mk_ago')) {
      function mk_ago($time)
      {
             $periods = array(
               __("second", 'mk_framework'),
               __("minute", 'mk_framework'),
               __("hour", 'mk_framework'),
               __("day", 'mk_framework'),
               __("week", 'mk_framework'),
               __("month", 'mk_framework'),
               __("year", 'mk_framework'),
               __("decade", 'mk_framework')
          );
          $lengths = array(
               "60",
               "60",
               "24",
               "7",
               "4.35",
               "12",
               "10"
          );
          
          $now = time();
          
          $difference = $now - $time;
          $tense      = __("ago", 'mk_framework');
          
          for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
               $difference /= $lengths[$j];
          }
          
          $difference = round($difference);
          
          if ($difference != 1) {
               $periods[$j] .= "s";
          }
          
          return "$difference $periods[$j] {$tense} ";
      }
}
/*-----------------*/





/*
 * Darken given hex value by defined factor.
 */
if (!function_exists('mk_hex_darker')) {
      function mk_hex_darker($hex, $factor = 30)
      {
            $new_hex = '';
            if ($hex == '' || $factor == '') {
                  return false;
            }
            
            $hex = str_replace('#', '', $hex);
            
            $base['R'] = hexdec($hex{0} . $hex{1});
            $base['G'] = hexdec($hex{2} . $hex{3});
            $base['B'] = hexdec($hex{4} . $hex{5});
            
            
            foreach ($base as $k => $v) {
                  $amount      = $v / 100;
                  $amount      = round($amount * $factor);
                  $new_decimal = $v - $amount;
                  
                  $new_hex_component = dechex($new_decimal);
                  if (strlen($new_hex_component) < 2) {
                        $new_hex_component = "0" . $new_hex_component;
                  }
                  $new_hex .= $new_hex_component;
            }
            
            return '#' . $new_hex;
      }
}
/*-----------------*/






/**
 * Shortode friendly Text Widgets
 *
 * Generates shortcodes used in Text Widget.
 *
 * @param string  holds the content to be passed to do_shortcode
 */
if (!function_exists('mk_theme_widget_text_shortcode')) {
      function mk_theme_widget_text_shortcode($content)
      {
            $content          = do_shortcode($content);
            $new_content      = '';
            $pattern_full     = '{(\[raw\].*?\[/raw\])}is';
            $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
            $pieces           = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
            
            foreach ($pieces as $piece) {
                  if (preg_match($pattern_contents, $piece, $matches)) {
                        $new_content .= $matches[1];
                  } else {
                        $new_content .= do_shortcode($piece);
                  }
            }
            
            return $new_content;
      }
}
add_filter('widget_text', 'mk_theme_widget_text_shortcode');
add_filter('widget_text', 'do_shortcode');
/*-----------------*/








/**
 * Content Width Calculator
 *
 * Retrieves the content width based on $grid-width
 *
 * @param string  $layout param
 */
if (!function_exists('mk_content_width')) {
      function mk_content_width($layout = 'full')
      {
            
            global $mk_settings;
            
            if ($layout == 'full') {
                  
                  return $mk_settings['grid-width'] - 40;
            } else {
                  
                  return round(($mk_settings['content-width'] / 100) * $mk_settings['grid-width']) - 40;
            }
      }
}
/*-----------------*/









/**
 * Retrieves Portfolio Categories
 *
 * @param string  $id   current post ID
 * @param string  $link to return link or text.
 */

if (!function_exists('mk_get_portfolio_tax')) {
      function mk_get_portfolio_tax($id, $link = true, $slug = false)
      {
            
            if (empty($id))
                  return;
            
            $terms      = get_the_terms($id, 'portfolio_category');
            $terms_slug = array();
            $terms_name = array();
            if (is_array($terms) && !empty($terms)) {
                  if ($link == true) {
                        foreach ($terms as $term) {
                              $terms_name[] = '<a href="' . get_term_link($term->slug, 'portfolio_category') . '">' . $term->name . '</a>';
                        }
                  } else {
                        if ($slug == true) {
                              foreach ($terms as $term) {
                                    $terms_name[] = $term->slug;
                              }
                        } else {
                              foreach ($terms as $term) {
                                    $terms_name[] = $term->name;
                              }
                        }
                        
                        
                  }
                  return $terms_name;
            }
            return array();
      }
}
/*-----------------*/











/**
 * returns filter WP_query in related portfolio posts.
 *
 * @param (int)   post ID of the current post
 * @param (int)   Posts count
 * @param (bool)  Checks if filter based on category or tags.
 * @return WP_query query object
 */
if (!function_exists('mk_get_related_posts')) {
      function mk_get_related_posts($post_id, $count = 4, $cat = true)
      {
            $query = new WP_Query();
            
            if ($cat == true) {
                  $args  = '';
                  $args  = wp_parse_args($args, array(
                        'post__not_in' => array(
                              $post_id
                        ),
                        'category__in' => wp_get_post_categories($post_id),
                        'showposts' => $count,
                        'ignore_sticky_posts' => 0
                  ));
                  $query = new WP_Query($args);
                  
            } else {
                  
                  $tags   = wp_get_post_tags($post_id);
                  $tagIDs = array();
                  
                  $tagcount = count($tags);
                  
                  for ($i = 0; $i < $tagcount; $i++) {
                        $tagIDs[$i] = $tags[$i]->term_id;
                  }
                  
                  $query = new WP_Query(array(
                        'tag__in' => $tagIDs,
                        'post__not_in' => array(
                              $post_id
                        ),
                        'showposts' => $count,
                        'ignore_sticky_posts' => 0
                  ));
                  
            }
            
            return $query;
      }
}
/*-----------------*/





/**
 * Get custom sidebars from theme options.
 *
 * @return list of sidebars in array.
 */
if (!function_exists('mk_get_custom_sidebar')) {
      function mk_get_custom_sidebar()
      {
            $options               = array();
            $custom_sidebars       = get_option('mk_settings');
            $custom_sidebars_array = isset($custom_sidebars['custom-sidebar']) ? $custom_sidebars['custom-sidebar'] : null;
            if ($custom_sidebars_array != null) {
                  foreach ($custom_sidebars_array as $key => $value) {
                        $options[$value] = $value;
                  }
            }
            return $options;
            
      }
}


if (!function_exists('mk_base_url')) {
    function mk_base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}



/**
 * Get attachment ID from given URL
 *
 * @return attachment ID.
 */
if (!function_exists('mk_get_attachment_id_from_url')) {
      function mk_get_attachment_id_from_url($attachment_url = '')
      {
            
            global $wpdb;
            $attachment_id = false;
            
            // If there is no url, return.
            if ('' == $attachment_url)
                  return;
            
            // Get the upload directory paths
            $upload_dir_paths = wp_upload_dir();
            
            // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
            if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
                  
                  // If this is the URL of an auto-generated thumbnail, get the URL of the original image
                  $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
                  
                  // Remove the upload path base directory from the attachment URL
                  $attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);
                  
                  // Finally, run a custom database query to get the attachment ID from the modified attachment URL
                  $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
                  
            }
            
            return $attachment_id;
      }
}
/*-----------------*/








/**
 * returns filter WP_query in related portfolio posts.
 *
 * @param (int)   post ID of the current post
 * @param (int)   Posts count
 * @return WP_query query object
 */
if (!function_exists('mk_get_related_portfolio')) {
      function mk_get_related_portfolio($post_id, $count = 4)
      {
            $query = new WP_Query();
            
            $args = '';
            
            $item_cats  = get_the_terms($post_id, 'portfolio_category');
            $item_array = array();
            if ($item_cats):
                  foreach ($item_cats as $item_cat) {
                        $item_array[] = $item_cat->term_id;
                  }
            else :
               $item_array[] = array('');
            endif;
            
            $args = wp_parse_args($args, array(
                  'showposts' => $count,
                  'post__not_in' => array(
                        $post_id
                  ),
                  'ignore_sticky_posts' => 0,
                  'post_type' => 'portfolio',
                  'tax_query' => array(
                        array(
                              'taxonomy' => 'portfolio_category',
                              'field' => 'id',
                              'terms' => $item_array
                        )
                  )
            ));
            
            $query = new WP_Query($args);
            
            return $query;
      }
}
/*-----------------*/





/**
 * Get template parts from Control Panel
 * @param string    $slug
 * @param string    $name
 * @param boolean   $return
 * @return object
 *
 */
if (!function_exists('mk_get_control_panel_view')) {
    function mk_get_control_panel_view($name = '', $return = false, $view_params = array()) {
        if ($return) {
            ob_start();
            mk_get_template_part('framework/control-panel/views/' . $name, $view_params);
            return ob_get_clean();
        } 
        else {
            mk_get_template_part('framework/control-panel/views/' . $name, $view_params);
        }
    }
}

/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $view_params array
 * @param string filepart
 * @param mixed wp_args style argument list
 */
function mk_get_template_part($file, $view_params = array() , $cache_args = array()) {
    global $post;
    $view_params = wp_parse_args($view_params);
    $cache_args = wp_parse_args($cache_args);
    if ($cache_args) {
        foreach ($view_params as $key => $value) {
            if (is_scalar($value) || is_array($value)) {
                $cache_args[$key] = $value;
            } 
            else if (is_object($value) && method_exists($value, 'get_id')) {
                $cache_args[$key] = call_user_method('get_id', $value);
            }
        }
        if (($cache = wp_cache_get($file, serialize($cache_args))) !== false) {
            if (!empty($view_params['return'])) return $cache;
            echo $cache;
            return;
        }
    }
    $file_handle = $file;
    do_action('start_operation', 'mk_template_part::' . $file_handle);
    if (file_exists(get_stylesheet_directory() . '/' . $file . '.php')) $file = get_stylesheet_directory() . '/' . $file . '.php';
    elseif (file_exists(get_template_directory() . '/' . $file . '.php')) $file = get_template_directory() . '/' . $file . '.php';
    ob_start();
    $return = require ($file);
    $data = ob_get_clean();
    do_action('end_operation', 'mk_template_part::' . $file_handle);
    if ($cache_args) {
        wp_cache_set($file, $data, serialize($cache_args) , 3600);
    }
    if (!empty($view_params['return'])) if ($return === false) return false;
    else return $data;
    echo $data;
}



function create_global_styles() {
    $ken_styles = '';
    global $ken_styles;
}
create_global_styles();


function mk_get_fontfamily( $element_name, $id, $font_family, $font_type ) {
    $output = '';
    global $ken_styles;
    if ( $font_type == 'google' ) {
        if ( !function_exists( "my_strstr" ) ) {
            function my_strstr( $haystack, $needle, $before_needle = false ) {
                if ( !$before_needle ) return strstr( $haystack, $needle );
                else return substr( $haystack, 0, strpos( $haystack, $needle ) );
            }
        }
        wp_enqueue_style( $font_family, '//fonts.googleapis.com/css?family=' .$font_family.':100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic,100,200,300,400,500,600,700,800,900' , false, false, 'all' );
        $format_name = strpos( $font_family, ':' );
        if ( $format_name !== false ) {
            $google_font =  my_strstr( str_replace( '+', ' ', $font_family ), ':', true );
        } else {
            $google_font = str_replace( '+', ' ', $font_family );
        }
        $ken_styles .= $element_name.$id.' {font-family: "'.$google_font.'"}';

    } else if ( $font_type == 'fontface' ) {

            $stylesheet = FONTFACE_DIR.'/fontface_stylesheet.css';
            $font_dir = FONTFACE_URI;
            if ( file_exists( $stylesheet ) ) {
                $file_content = file_get_contents( $stylesheet );
                if ( preg_match( "/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$font_family\\1.*?}/is", $file_content, $match ) ) {
                    $fontface_style = preg_replace( "/url\s*\(\s*['|\"]\s*/is", "\\0$font_dir/", $match[0] )."\n";
                }
                $ken_styles .= "\n" . $fontface_style ."\n";
                $ken_styles .= $element_name.$id.' {font-family: "'.$font_family.'"}';
            }

        } else if ( $font_type == 'safefont' ) {
            $ken_styles .= $element_name.$id.' {font-family: '.$font_family.' !important}';
        }

    return $output;
}







/* 
Uses get_the_excerpt() to print an excerpt by specifying a maximium number of characters. 
*/
if (!function_exists('mk_excerpt_max_charlength')) {
function mk_excerpt_max_charlength($charlength) {
      $excerpt = get_the_excerpt();
      $charlength++;

      if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                  echo mb_substr( $subex, 0, $excut );
            } else {
                  echo $subex;
            }
            echo '[...]';
      } else {
            echo $excerpt;
      }
}
}





if (!function_exists('mk_get_shop_id')) {
     function mk_get_shop_id()
     {
          if(function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {

              return wc_get_page_id( 'shop' );

          } else {

            return false;
          }
     }
}

if (!function_exists('mk_is_shop')) {
     function mk_is_shop()
     {
          if(function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {

              return true;

          } else {

            return false;
          }
     }
}


if (!function_exists('global_get_post_id')) {
     function global_get_post_id()
     {
          if(function_exists('is_woocommerce') && is_woocommerce() && is_shop()) {

              return wc_get_page_id( 'shop' );

          } else if(is_singular() || is_home()) {

            global $post;

            return $post->ID;

          }else {

            return false;
          }
     }
}


//////////////////////////////////////////////////////////////////////////
// 
//  Global JSON object to collect all DOM related data
//  todo - move here all VC shortcode settings
//
//////////////////////////////////////////////////////////////////////////

function create_global_json() {
    $ken_json = array();
    global $ken_json;
}
create_global_json();


function create_global_dynamic_styles() {
    $ken_dynamic_styles = array();
    global $ken_dynamic_styles;
}
create_global_dynamic_styles();



/**
 * function to check if the current page is admin-ajax.php and the action is sent is vc_edit_form
 *
 * @return boolean
 */
function mk_page_is_vc_edit_form(){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;

    $result =  in_array( $pagenow, array('admin-ajax.php') );
    $ajax_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

    if($result && $ajax_action == 'vc_edit_form') {
      return true;
    }
}







/**
 * Adding font icons in HTML document to prevent issues when using CDN
 */
if (!function_exists('mk_enqueue_font_icons')) {
  function mk_enqueue_font_icons() {
      
      $styles_dir = THEME_DIR_URI . '/stylesheet';
      $output = "

      @font-face {
        font-family: 'ArtbeesWPTokens';
        src: url('{$styles_dir}/artbees-icons/ArtbeesWPTokens.eot');
        src: url('{$styles_dir}/artbees-icons/ArtbeesWPTokens.eot?#iefix') format('embedded-opentype'), 
        url('{$styles_dir}/artbees-icons/ArtbeesWPTokens.woff') format('woff'), 
        url('{$styles_dir}/artbees-icons/ArtbeesWPTokens.ttf') format('truetype'), 
        url('{$styles_dir}/artbees-icons/ArtbeesWPTokens.svg#ArtbeesWPTokens') format('svg');
        font-weight: 400;
        font-style: normal;
      }

      @font-face {
        font-family: 'FontAwesome';
        src:url('{$styles_dir}/awesome-icons/fontawesome-webfont.eot?v=4.2');
        src:url('{$styles_dir}/awesome-icons/fontawesome-webfont.eot?#iefix&v=4.2') format('embedded-opentype'),
        url('{$styles_dir}/awesome-icons/fontawesome-webfont.woff?v=4.2') format('woff'),
        url('{$styles_dir}/awesome-icons/fontawesome-webfont.ttf?v=4.2') format('truetype'), 
        url('{$styles_dir}/awesome-icons/fontawesome-webfont.svg#FontAwesome') format('svg');;
        font-weight: normal;
        font-style: normal;
      }

      @font-face {
        font-family: 'star';
        src: url('{$styles_dir}/woocommerce-fonts/star.eot');
        src: url('../woocommerce-fonts/star.eot?#iefix') format('embedded-opentype'), 
        url('../woocommerce-fonts/star.woff') format('woff'), 
        url('../woocommerce-fonts/star.ttf') format('truetype'), 
        url('../woocommerce-fonts/star.svg#star') format('svg');
        font-weight: normal;
        font-style: normal;
      }

      @font-face {
        font-family: 'WooCommerce';
        src: url('{$styles_dir}/woocommerce-fonts/WooCommerce.eot');
        src: url('{$styles_dir}/woocommerce-fonts/WooCommerce.eot?#iefix') format('embedded-opentype'), 
        url('{$styles_dir}/woocommerce-fonts/WooCommerce.woff') format('woff'), 
        url('{$styles_dir}/woocommerce-fonts/WooCommerce.ttf') format('truetype'), 
        url('{$styles_dir}/woocommerce-fonts/WooCommerce.svg#WooCommerce') format('svg');
        font-weight: normal;
        font-style: normal;
      }

      @font-face {
        font-family: 'Flaticon';
        src: url('{$styles_dir}/line-icon-set/flaticon.eot');
        src: url('{$styles_dir}/line-icon-set/flaticon.eot#iefix') format('embedded-opentype'),
        url('{$styles_dir}/line-icon-set/flaticon.woff') format('woff'),
        url('{$styles_dir}/line-icon-set/flaticon.ttf') format('truetype'),
        url('{$styles_dir}/line-icon-set/flaticon.svg') format('svg');
        font-weight: normal;
        font-style: normal;
      }

      @font-face {
        font-family: 'Pe-icon-line';
        src:url('{$styles_dir}/pe-line-icons/Pe-icon-line.eot?lqevop');
        src:url('{$styles_dir}/pe-line-icons/Pe-icon-line.eot?#iefixlqevop') format('embedded-opentype'),
          url('{$styles_dir}/pe-line-icons/Pe-icon-line.woff?lqevop') format('woff'),
          url('{$styles_dir}/pe-line-icons/Pe-icon-line.ttf?lqevop') format('truetype'),
          url('{$styles_dir}/pe-line-icons/Pe-icon-line.svg?lqevop#Pe-icon-line') format('svg');
        font-weight: normal;
        font-style: normal;
      }

";
      return $output;
  }
}


/**
 * @param $path
 * @return mixed
 */
function path_convert($path) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $path = str_replace('/', '\\', $path);
    }
    else {
        $path = str_replace('\\', '/', $path);
    }
    return $path;
}