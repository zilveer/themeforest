<?php
define('GLOBAL_ASSETS','global_assets');

/*
 * Convert theme settings to a globaly accessible vaiable throught the theme.
*/
if (!function_exists('mk_theme_options')) {
    function mk_theme_options($check = false) {
        $GLOBALS['mk_options'] = get_option(THEME_OPTIONS);
        
        if ((empty($GLOBALS['mk_options']) || $check) && !is_admin()) {
            $theme_options = array();
            $page = include (THEME_ADMIN . "/theme-options/masterkey.php");
            $theme_options[$page['name']] = array();
            
            foreach ($page['options'] as $group) {
                
                foreach ($group['fields'] as $subgroup) {
                    foreach ($subgroup['fields'] as $option) {
                        if ($option['type'] == 'groupset') {
                            foreach ($option['fields'] as $option) {
                                if (isset($option['default'])) {
                                    $theme_options[$page['name']][$option['id']] = $option['default'];
                                }
                            }
                        } 
                        else { 
                            if (isset($option['default'])) {
                                $theme_options[$page['name']][$option['id']] = $option['default'];
                            }
                        }
                    }
                }
            }
            
            $theme_options[$page['name']] = array_merge((array)$theme_options[$page['name']], (array)get_option($page['name']));
            
            $GLOBALS['mk_options'] = $theme_options[$page['name']];
            update_option(THEME_OPTIONS, $theme_options[$page['name']]);
            update_option(THEME_OPTIONS_BUILD, uniqid());
            mk_purge_cache_actions();
        }
    }
}

add_action('init', 'mk_theme_options');

/*-----------------*/

/*
Theme updates helper for theme options
*/
if (!function_exists('mk_new_version_migration')) {
    function mk_new_version_migration() {
        $current_version = get_option('jupiter_theme_version');
        $imported_options = get_option(THEME_OPTIONS . '_imported');
        
        if(function_exists('wp_get_theme')){
            $theme_data = wp_get_theme(get_option('template'));
            $latest_version = $theme_data->Version;  
        } else {
            $theme_data = get_theme_data( TEMPLATEPATH . '/style.css');
            $latest_version = $theme_data['Version'];
        }
        
        if ($latest_version != $current_version || $imported_options == 'true') {
            
            mk_theme_options(true);
            
            update_option('jupiter_theme_version', $latest_version);
            
            update_option(THEME_OPTIONS . '_imported', 'false');
            
            update_option(THEME_OPTIONS_BUILD, uniqid());
            
            mk_purge_cache_actions();
            
            flush_rewrite_rules();
        }
    }
}

add_action('init', 'mk_new_version_migration');

/*-----------------*/

if (!function_exists('mk_flush_rules')) {
    function mk_flush_rules() {
        if (get_option('mk_jupiter_flush_rules')) {
            global $wp_rewrite;
            $wp_rewrite->flush_rules();
            delete_option('mk_jupiter_flush_rules');
        }
    }
    
    add_action('wp_loaded', 'mk_flush_rules');
}



/*
Uses get_the_excerpt() to print an excerpt by specifying a maximium number of characters.
*/
if (!function_exists('mk_excerpt_max_charlength')) {
    function mk_excerpt_max_charlength($charlength) {
        $excerpt = get_the_excerpt();
        $charlength++;
        
        if (mb_strlen($excerpt) > $charlength) {
            $subex = mb_substr($excerpt, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = - (mb_strlen($exwords[count($exwords) - 1]));
            if ($excut < 0) {
                echo mb_substr($subex, 0, $excut);
            } 
            else {
                echo $subex;
            }
            echo '[...]';
        } 
        else {
            echo $excerpt;
        }
    }
}

function mk_current_page_url() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"])) {
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL.= "s";
        }
    }
    $pageURL.= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL.= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } 
    else {
        $pageURL.= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

/*
 * Login ajax functions
*/
function ajax_login_init() {
    
    global $mk_options;
    
    $theme_js_hook = ($mk_options['minify-js'] == 'true') ? 'theme-scripts-min' : 'theme-scripts';
    
    wp_localize_script($theme_js_hook, 'ajax_login_object', array(
        'ajaxurl' => admin_url('admin-ajax.php') ,
        'redirecturl' => mk_current_page_url() ,
        'loadingmessage' => __('Sending user info, please wait...', 'mk_framework')
    ));
}
if (!is_user_logged_in()) {
    add_action('wp_footer', 'ajax_login_init');
}

add_action('wp_ajax_nopriv_ajaxlogin', 'ajax_login');

function ajax_login() {
    check_ajax_referer('ajax-login-nonce', 'security');
    
    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;
    
    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
        echo json_encode(array(
            'loggedin' => false,
            'message' => __('Wrong username or password.', 'mk_framework')
        ));
    } 
    else {
        echo json_encode(array(
            'loggedin' => true,
            'message' => __('Login successful, redirecting...', 'mk_framework')
        ));
    }
    
    die();
}

/*-----------------*/

/* removes Contactform 7 styles */
remove_action('wp_enqueue_scripts', 'wpcf7_enqueue_styles');

/*
Register your custom function to override some LayerSlider data
*/
add_action('layerslider_ready', 'my_layerslider_overrides');
function my_layerslider_overrides() {
    $GLOBALS['lsAutoUpdateBox'] = false;
}

/*-----------------*/

/* Convert hexdec color string to rgb(a) string */
function mk_hex2rgba($color, $opacity = false) {
    
    $default = 'rgb(0,0,0)';
    
    //Return default if no color provided
    if (empty($color)) return $default;
    
    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    
    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array(
            $color[0] . $color[1],
            $color[2] . $color[3],
            $color[4] . $color[5]
        );
    } 
    elseif (strlen($color) == 3) {
        $hex = array(
            $color[0] . $color[0],
            $color[1] . $color[1],
            $color[2] . $color[2]
        );
    } 
    else {
        return $default;
    }
    
    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);
    
    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1) $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } 
    else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }
    
    //Return rgb(a) color string
    return $output;
}

/*
Removes version paramerters from scripts and styles.
*/
function mk_remove_wp_ver_css_js($src) {
    global $mk_options;
    $remove_query_string = isset($mk_options['remove-js-css-ver']) ? $mk_options['remove-js-css-ver'] : 'false';
    if ($remove_query_string == 'false') {
        if (strpos($src, 'ver=')) $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'mk_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'mk_remove_wp_ver_css_js', 9999);

/**
 * Content Width Calculator
 *
 * Retrieves the content width based on $grid-width
 *
 * @param string  $layout param
 */
if (!function_exists('mk_count_content_width')) {
    function mk_count_content_width($post_id = false) {
        
        global $mk_options, $post;
        
        if ($post_id) {
            $id = $post_id;
        } 
        else {
            $id = $post->id;
        }
        
        $layout = get_post_meta($id, '_layout', true);
        $layout = (empty($layout)) ? 'full' : $layout;
        if (is_singular('portfolio')) {
            
            $layout = ($layout == 'default') ? $mk_options['portfolio_single_layout'] : $layout;
        } 
        else if (is_singular('post')) {
            
            $layout = ($layout == 'default') ? $mk_options['single_layout'] : $layout;
        }
        
        if ($layout == 'full') {
            
            return $mk_options['grid_width'] - 40;
        } 
        else {
            
            return round(($mk_options['content_width'] / 100) * $mk_options['grid_width'] - 40);
        }
    }
}

/*-----------------*/
 
/**
 * Adds Next/Previous post navigations to single posts
 *
 */

if(!function_exists('mk_get_single_post_prev_next')) {
    function mk_get_single_post_prev_next() {
        
        global $mk_options;
        
        if (is_singular('portfolio') && $mk_options['portfolio_next_prev'] != 'true') return false;
        
        if (is_singular('post') && $mk_options['blog_prev_next'] != 'true') return false;

        if (is_singular('product') && $mk_options['woo_single_prev_next'] == 'false') return false;
        
        $options = array();
        
        $options['excluded_terms'] = '';

        $options['type'] = get_post_type();

        switch ($options['type']) {
            case 'post':
                $options['taxonomy'] = 'category';
                $options['in_same_term'] = isset($mk_options['blog_prev_next_same_category']) ? ($mk_options['blog_prev_next_same_category'] === 'true') : false;
                break;
            case 'portfolio':
                $options['taxonomy'] = 'portfolio_category';
                $options['in_same_term'] = isset($mk_options['portfolio_prev_next_same_category']) ? ($mk_options['portfolio_prev_next_same_category'] === 'true') : false;
                break;    
            case 'news':
                $options['taxonomy'] = 'news_category';
                $options['in_same_term'] = false;
                break;        
            case 'product':
                $options['taxonomy'] = 'product_cat';
                $options['in_same_term'] = isset($mk_options['woo_prev_next_same_category']) ? ($mk_options['woo_prev_next_same_category'] === 'true') : false;
                break;        
            
            default:
                $options['taxonomy'] = 'category';
                $options['in_same_term'] = false;
                break;
        }

        
        if (!is_singular() || is_post_type_hierarchical($options['type'])) $options['is_hierarchical'] = true;
        if ($options['type'] === 'topic' || $options['type'] === 'reply') $options['is_bbpress'] = true;
        
        $options = apply_filters('mk_post_nav_settings', $options);
        if (!empty($options['is_bbpress']) || !empty($options['is_hierarchical'])) return;
        
        $entries['prev'] = get_adjacent_post($options['in_same_term'], $options['excluded_terms'], true, $options['taxonomy']);
        $entries['next'] = get_adjacent_post($options['in_same_term'], $options['excluded_terms'], false, $options['taxonomy']);

        
        
        $entries = apply_filters('mk_post_nav_entries', $entries, $options);
        $output = "";
        
        foreach ($entries as $key => $entry) {
            if (empty($entry)) continue;
            
            $post_type = get_post_type($entry->ID);
            
            $icon = $post_image = "";
            $link = esc_url( get_permalink( $entry->ID ) );
            /* Added image-size-150x150 image size in functions.php to have exact 150px * 150px thumbnail size */
            $image = get_the_post_thumbnail($entry->ID, 'image-size-150x150');
            $class = $image ? "with-image" : "without-image";
            $icon = ($key == 'prev') ? Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-long-arrow-left') : Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-long-arrow-right');
            $output.= '<a class="mk-post-nav mk-post-' . $key . ' ' . $class . '" href="' . $link . '">';
            
            $output.= '<span class="pagnav-wrapper">';
            $output.= '<span class="pagenav-top">';
            
            $icon = '<span class="mk-pavnav-icon">' . $icon . '</span>';
            
            if ($image) {
                $post_image = '<span class="pagenav-image">' . $image . '</span>';
            }
            
            $output.= $key == 'next' ? $icon . $post_image : $post_image . $icon;
            $output.= "</span>";
            
            $output.= '<div class="nav-info-container">';
            $output.= '<span class="pagenav-bottom">';
            
            $output.= '<span class="pagenav-title">' . get_the_title($entry->ID) . '</span>';
            
            if ($post_type == 'post') {
                $cats = get_the_category($entry->ID);
                foreach ($cats as $cat) {
                    $category[] = $cat->name;
                }
                $output.= '<span class="pagenav-category">' . implode(', ', $category) . '</span>';
                $category = array();
            } 
            elseif ($post_type == 'portfolio') {
                $terms = get_the_terms($entry->ID, 'portfolio_category');
                $terms_slug = array();
                $terms_name = array();
                if (is_array($terms)) {
                    foreach ($terms as $term) {
                        $terms_name[] = $term->name;
                    }
                }
                $output.= '<span class="pagenav-category">' . implode(', ', $terms_name) . '</span>';
                $terms_name = array();
            } 
            elseif ($post_type == 'product') {
                $terms = get_the_terms($entry->ID, 'product_cat');
                $terms_slug = array();
                $terms_name = array();
                if (is_array($terms)) {
                    foreach ($terms as $term) {
                        $terms_name[] = $term->name;
                    }
                }
                $output.= '<span class="pagenav-category">' . implode(', ', $terms_name) . '</span>';
                $terms_name = array();
            } 
            elseif ($post_type == 'news') {
                $terms = get_the_terms($entry->ID, 'news_category');
                $terms_slug = array();
                $terms_name = array();
                if (is_array($terms)) {
                    foreach ($terms as $term) {
                        $terms_name[] = $term->name;
                    }
                }
                $output.= '<span class="pagenav-category">' . implode(', ', $terms_name) . '</span>';
                $terms_name = array();
            }
            $output.= "</span>";
            $output.= "</div>";
            $output.= "</span>";
            $output.= "</a>";
        }
        echo $output;
    }

    add_action('wp_footer', 'mk_get_single_post_prev_next');
}










function mk_get_fontfamily($element_name, $id, $font_family, $font_type) {
    $output = '';
    if ($font_type == 'google') {
        if (!function_exists("my_strstr")) {
            function my_strstr($haystack, $needle, $before_needle = false) {
                if (!$before_needle) return strstr($haystack, $needle);
                else return substr($haystack, 0, strpos($haystack, $needle));
            }
        }
        wp_enqueue_style($font_family, '//fonts.googleapis.com/css?family=' . $font_family . ':100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic,100,200,300,400,500,600,700,800,900', false, false, 'all');
        $format_name = strpos($font_family, ':');
        if ($format_name !== false) {
            $google_font = my_strstr(str_replace('+', ' ', $font_family) , ':', true);
        } 
        else {
            $google_font = str_replace('+', ' ', $font_family);
        }
        $output.= '<style>' . $element_name . $id . ' {font-family: "' . $google_font . '"}</style>';
    } 
    else if ($font_type == 'safefont') {
        $output.= '<style>' . $element_name . $id . ' {font-family: ' . $font_family . ' !important}</style>';
    }
    
    return $output;
}

/**
 * Retrieves Portfolio Categories
 *
 * @param string  $id   current post ID
 * @param string  $link to return link or text.
 */

if (!function_exists('mk_get_custom_tax')) {
    function mk_get_custom_tax($id, $tax, $link = true, $slug = false) {
        
        if (empty($id)) return;
        
        $terms = get_the_terms($id, $tax . '_category');
        $terms_slug = array();
        $terms_name = array();
        if (is_array($terms) && !empty($terms)) {
            if ($link == true) {
                foreach ($terms as $term) {
                    $terms_name[] = '<a href="' . get_term_link($term->slug, $tax . '_category') . '">' . $term->name . '</a>';
                }
            } 
            else {
                foreach ($terms as $term) {
                    if ($slug) {
                        $terms_name[] = $term->slug;
                    } 
                    else {
                        $terms_name[] = $term->name;
                    }
                }
            }
            return $terms_name;
        }
        return array();
    }
}

/**
 * Converts a super link output to an actual link and returns.
 *
 * @param string  $link  link type | type id
 * @return string
 */

if (!function_exists('mk_get_super_link')) {
    function mk_get_super_link($link = false, $get_permalink = true) {
        $permalink = '';
        if (!empty($link)) {
            $link_array = explode('||', $link);
            switch ($link_array[0]) {
                case 'page':
                    $permalink = get_page_link($link_array[1]);
                    break;

                case 'cat':
                    $permalink = get_category_link($link_array[1]);
                    break;

                case 'portfolio':
                    $permalink = esc_url( get_permalink( $link_array[1] ) );
                    break;

                case 'post':
                    $permalink = esc_url( get_permalink( $link_array[1] ) );
                    break;

                case 'manually':
                    $permalink = $link_array[1];
                    break;
            }
        }
        if (empty($permalink) && $get_permalink == true) {
            return esc_url( get_permalink() );
        }
        return $permalink;
    }
}

/*-----------------*/

if (!function_exists('mk_shortcode_empty_paragraph_fix')) {
    function mk_shortcode_empty_paragraph_fix($content) {
        $array = array(
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        
        $content = strtr($content, $array);
        
        return $content;
    }
}

/* Safe way to remove autop tags inside shortcodes without touching wordpress filters and default behaviors. */
add_filter('the_content', 'mk_shortcode_empty_paragraph_fix');

/*-----------------*/

if (!function_exists('mk_add_ajax_library')) {
    function mk_add_ajax_library() {
        $html = '<script type="text/javascript">';
        $html.= 'var ajaxurl = "' . admin_url('admin-ajax.php') . '"';
        $html.= '</script>';
        echo $html;
    }
}

add_action('wp_enqueue_scripts', 'mk_add_ajax_library');

/*-----------------*/

if (!function_exists('mk_get_shop_id')) {
    function mk_get_shop_id() {
        if (function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {
            
            return wc_get_page_id('shop');
        } 
        else {
            
            return false;
        }
    }
}

if (!function_exists('mk_is_woo_archive')) {
    function mk_is_woo_archive() {
        if (function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {
            
            return wc_get_page_id('shop');
        } 
        else {
            
            return false;
        }
    }
}

if (!function_exists('global_get_post_id')) {
    function global_get_post_id() {
        if (function_exists('is_woocommerce') && is_woocommerce() && is_shop()) {
            
            return wc_get_page_id('shop');
        } 
        else if (is_singular()) {
            global $post;
            
            return $post->ID;
        } 
        else if (is_home()) {
            
            $page_on_front = get_option('page_on_front');
            $show_on_front = get_option('show_on_front');
            
            if ($page_on_front == 'page' && !empty($page_on_front)) {
                global $post;
                return $post->ID;
            } 
            else {
                return false;
            }
        } 
        else {
            
            return false;
        }
    }
}

function mk_get_attachment_id_from_url($attachment_url = '') {
    
    global $wpdb;
    $attachment_id = false;
    
    // If there is no url, return.
    if ('' == $attachment_url) return;
    
    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();
    
    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    //if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
        
        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);

        // Remove the upload path base directory from the attachment URL
        //$attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);

        $attachment_url =  strstr($attachment_url, 'uploads');
        $attachment_url = str_replace('uploads/', '', $attachment_url);

        //return $attachment_url;
        
        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
    //}
    
    return $attachment_id;
}


/*-----------------*/

/*
 * Converts Hex value to RGBA if needed.
*/
if (!function_exists('mk_color')) {
    function mk_color($colour, $alpha) {
        if (!empty($colour)) {
            if ($alpha >= 0.95) {
                return $colour;
                
                // If alpha is equal 1 no need to convert to RGBA, so we are ok with it. :)
                
                
            } 
            else {
                if ($colour[0] == '#') {
                    $colour = substr($colour, 1);
                }
                if (strlen($colour) == 6) {
                    list($r, $g, $b) = array(
                        $colour[0] . $colour[1],
                        $colour[2] . $colour[3],
                        $colour[4] . $colour[5]
                    );
                } 
                elseif (strlen($colour) == 3) {
                    list($r, $g, $b) = array(
                        $colour[0] . $colour[0],
                        $colour[1] . $colour[1],
                        $colour[2] . $colour[2]
                    );
                } 
                else {
                    return false;
                }
                $r = hexdec($r);
                $g = hexdec($g);
                $b = hexdec($b);
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
 * Converts Hex value to RGBA if needed.
*/
function mk_typekit_script() {
    global $mk_options;
    
    if (isset($mk_options['typekit_id']) && $mk_options['typekit_id'] != '') {
        echo '<script type="text/javascript" src="//use.typekit.net/' . $mk_options['typekit_id'] . '.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
    }
}

/*-----------------*/

add_action('wp_head', 'mk_typekit_script');

if (!function_exists('mk_ago')) {
    function mk_ago($time) {
        $periods = array(
            __("second", 'mk_framework') ,
            __("minute", 'mk_framework') ,
            __("hour", 'mk_framework') ,
            __("day", 'mk_framework') ,
            __("week", 'mk_framework') ,
            __("month", 'mk_framework') ,
            __("year", 'mk_framework') ,
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
        $tense = __("ago", 'mk_framework');
        
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference/= $lengths[$j];
        }
        
        $difference = round($difference);
        
        if ($difference != 1) {
            $periods[$j].= "s";
        }
        
        return "$difference $periods[$j] {$tense} ";
    }
}

/*-----------------*/

if (!function_exists('hexDarker')) {
    function hexDarker($hex, $factor = 30) {
        $new_hex = '';
        if ($hex == '' || $factor == '') {
            return false;
        }
        
        $hex = str_replace('#', '', $hex);

        if(strlen($hex) == 3) {
            $hex = $hex . $hex;
        }
        
        $base['R'] = hexdec($hex{0} . $hex{1});
        $base['G'] = hexdec($hex{2} . $hex{3});
        $base['B'] = hexdec($hex{4} . $hex{5});
        
        foreach ($base as $k => $v) {
            $amount = $v / 100;
            $amount = round($amount * $factor);
            $new_decimal = $v - $amount;
            
            $new_hex_component = dechex($new_decimal);
            if (strlen($new_hex_component) < 2) {
                $new_hex_component = "0" . $new_hex_component;
            }
            $new_hex.= $new_hex_component;
        }
        
        return '#' . $new_hex;
    }
}

/*-----------------*/

if (!function_exists('mk_get_skin_color')) {
    function mk_get_skin_color() {
        global $mk_options;
        if (isset($_GET['skin'])) {
            return $_GET['skin'];;
        } 
        else {
            return $mk_options['skin_color'];
        }
    }
}

/*-----------------*/

if (!function_exists('mk_add_admin_bar_link')) {
    function mk_add_admin_bar_link() {
        global $wp_admin_bar;
        $theme_data = wp_get_theme();
        $action = 'mk_purge_cache';
        
        if (!current_user_can('manage_options') || !is_admin_bar_showing()) return;
        
        $wp_admin_bar->add_menu(array(
            'id' => 'theme_options',
            'title' => __('Theme Options', 'mk_framework') ,
            'href' => admin_url('admin.php?page=theme_options')
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
        
        wp_redirect(wp_get_referer());
        die();
    }
}

/**
 * Deletes cache files and transients
 *
 * @param bool $remove
 *
 * @author      Bob Ulusoy & Uğur Mirza ZEYREK
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0
 * @last_update Version 5.1.4
 */
function mk_purge_cache_actions($remove = false) {
    global $wpdb;
    
    $wpdb->query($wpdb->prepare("
                 DELETE FROM $wpdb->postmeta
                 WHERE meta_key = %s
                ", '_dynamic_styles'));
    
    global $wp_filesystem;
    
    if (empty($wp_filesystem)) {
        require_once (ABSPATH . '/wp-admin/includes/file.php');
        WP_Filesystem();
    }
    
    $static = new Mk_Static_Files(false);
    $static->DeleteThemeOptionStyles($remove);
    $static->delete_global_assets(true);
    $static->delete_transient_mk_getimagesize();
    $static->delete_transient_mk_critical_path_css();
    $static->delete_inline_script_options();
    $static->check_transient_mk_assets_versions();
    Mk_SVG_Icons::check_transient_svg_icons_versions();
    if($remove or isset($_GET["all"])) {
        $static->delete_transient_mk_assets();
    }

    $static->prevent_cache_plugins();
    mk_clear_cache_plugins();
}

if (!function_exists('mk_clear_super_cache')) {
    function mk_clear_cache_plugins() {
        if (function_exists('w3tc_pgcache_flush')) {
            w3tc_pgcache_flush();
    //       echo 'W3 Total Cache: Page cache flushed';
        } elseif (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache(); 
    //        echo 'WP Super Cache: Page cache cleared.';
        } elseif (function_exists('rocket_clean_domain')) {
            rocket_clean_domain();
    //       echo 'WP Rocket: Domain cache purged.';
        } else {
    //       echo 'No known caching plugin detected!';
        }
    // die;
    }
}
/*
 * Adds Extra
*/
add_action('show_user_profile', 'mk_show_extra_profile_fields');
add_action('edit_user_profile', 'mk_show_extra_profile_fields');

if (!function_exists('mk_show_extra_profile_fields')) {
    function mk_show_extra_profile_fields($user) {
?>

        <h3>User Social Networks</h3>

        <table class="form-table">

            <tr>
                <th><label for="twitter">Twitter</label></th>

                <td>
                    <input type="text" name="twitter" id="twitter" value="<?php
        echo esc_attr(get_the_author_meta('twitter', $user->ID));
?>" class="regular-text" /><br />
                    <span class="description">Please enter your Twitter Profile URL.</span>
                </td>
            </tr>

        </table>
        <?php
    }
}

add_action('personal_options_update', 'my_save_extra_profile_fields');
add_action('edit_user_profile_update', 'my_save_extra_profile_fields');

if (!function_exists('my_save_extra_profile_fields')) {
    function my_save_extra_profile_fields($user_id) {
        
        if (!current_user_can('edit_user', $user_id)) return false;
        update_user_meta($user_id, 'twitter', $_POST['twitter']);
    }
}

/*-----------------*/

/*
 * Removes wordpress default excerpt brakets from its endings
*/
if (!function_exists('mk_theme_excerpt_more')) {
    function mk_theme_excerpt_more($excerpt) {
        return str_replace('[...]', '', $excerpt);
    }
}
add_filter('wp_trim_excerpt', 'mk_theme_excerpt_more');

/*-----------------*/

/*
 * Gives the text widget capability of inserting shortcode.
*/
if (!function_exists('mk_theme_widget_text_shortcode')) {
    function mk_theme_widget_text_shortcode($content) {
        $content = do_shortcode($content);
        $new_content = '';
        $pattern_full = '{(\[raw\].*?\[/raw\])}is';
        $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
        $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
        
        foreach ($pieces as $piece) {
            if (preg_match($pattern_contents, $piece, $matches)) {
                $new_content.= $matches[1];
            } 
            else {
                $new_content.= do_shortcode($piece);
            }
        }
        
        return $new_content;
    }
}
add_filter('widget_text', 'mk_theme_widget_text_shortcode');
add_filter('widget_text', 'do_shortcode');

/*-----------------*/

/*
Adds shortcodes dynamic css into footer.php

WARNING !!!!!!!!
The function name is misleading as it is not responsible for css only.
php.hasAdminbar is trival for core functions and removing it already caused problems.
Please move it to head section along with other JS generated from php.
Leave hasAdminbar and jsPath, json holds CSS injected with old methodology and is not relevant anymore.
*/
if (!function_exists('mk_dynamic_css_injection')) {
    function mk_dynamic_css_injection() {
        
        global $app_styles, $app_json;
        
        $output = '<script type="text/javascript">';
        
        $is_admin_bar = is_admin_bar_showing() ? 'true' : 'false';
        $mk_json_encode = json_encode($app_json);
        $output.= '
    php = {
        hasAdminbar: ' . $is_admin_bar . ',
        json: (' . $mk_json_encode . ' != null) ? ' . $mk_json_encode . ' : "",
        jsPath: \'' . THEME_JS . '\'
      };
    </script>';
        
        echo $output;
    }
}

add_action('wp_footer', 'mk_dynamic_css_injection');

/*-----------------*/

//////////////////////////////////////////////////////////////////////////
//
//  Global JSON object to collect all DOM related data
//  todo - move here all VC shortcode settings
//
//////////////////////////////////////////////////////////////////////////

function create_global_json() {
    $app_json = array();
    global $app_json;
}
create_global_json();

function create_global_modules() {
    $app_modules = array();
    global $app_modules;
}
create_global_modules();

function create_global_styles() {
    $app_styles = '';
    global $app_styles;
}
create_global_styles();

/**
 * function to check if the current page is admin-ajax.php and the action is sent is vc_edit_form
 *
 * @return boolean
 */
function mk_page_is_vc_edit_form() {
    global $pagenow;
    
    //make sure we are on the backend
    if (!is_admin()) return false;
    
    $result = in_array($pagenow, array(
        'admin-ajax.php'
    ));
    $ajax_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    
    if ($result && $ajax_action == 'vc_edit_form') {
        return true;
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

/**
 * Scans a directory for files of a certain extension.
 *
 * @since 3.4.0
 * @access private
 *
 * @param string $path Absolute path to search.
 * @param mixed  Array of extensions to find, string of a single extension, or null for all extensions.
 * @param int $depth How deep to search for files. Optional, defaults to a flat scan (0 depth). -1 depth is infinite.
 * @param string $relative_path The basename of the absolute path. Used to control the returned path
 *  for the found files, particularly when this function recurses to lower depths.
 */
function mk_scandir($path, $mode, $relative_path = '') {
    $path = path_convert($path);
    
    if (!is_dir($path)) return false;
    
    $relative_path = trailingslashit($relative_path);
    if ('/' == $relative_path) $relative_path = '';
    
    $results = scandir($path, $mode);
    $results = array_diff($results, array('.', '..'));
    
    return $results;
}

/**
 * Return default and custom image sizes
 *
 * @since 5.0
 *
 * @return array $image_sizes
 */

if (!function_exists('mk_get_image_sizes')) {
    function mk_get_image_sizes($reverse_array = false, $crop = true, $external_size = false) {

        $image_sizes = array();

        if($external_size) {
            $image_sizes[$external_size] = sanitize_title($external_size);
        }

        if($crop) {
            $image_sizes[__('Resize & Crop (Not Recommended)', 'mk_framework')] = 'crop';
        }
        
        $image_sizes[__('Default - Original Size', 'mk_framework')] = "full";
        $image_sizes[__("Default - Large Size", 'mk_framework')] = "large";
        $image_sizes[__("Default - Medium Size", 'mk_framework')] = "medium";


        $custom_image_sizes = get_option(IMAGE_SIZE_OPTION);
        if (!empty($custom_image_sizes)) {
            foreach ($custom_image_sizes as $size) {
                $custom_sizes['Custom - ' . $size['size_n']] = $size['size_n'];
            }
            $sizes = $image_sizes + $custom_sizes;
        } 
        else {
            $sizes = $image_sizes;
        }
        foreach ($sizes as $key => $value) {
            if ($reverse_array) {
                $final_array[$value] = $key;
            } 
            else {
                $final_array[$key] = $value;
            }
        }
        return $final_array;
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



// Skype shortcode removed from theme and this function will prevent the shortcode text appear in frontend
if (!function_exists('mk_skype_shortcode')) {
    function mk_skype_shortcode() {

        return '';

    }
    add_shortcode('mk_skype', 'mk_skype_shortcode');
}



/*
 * To remove accents from the name of uploaded files
 * Thanks to: https://goo.gl/h2tYrZ
 */
function sanitize_file_uploads( $file ){
    $file['name'] = sanitize_file_name($file['name']);
    $file['name'] = preg_replace("/[^a-zA-Z0-9\_\-\.]/", "", $file['name']);
    $file['name'] = strtolower($file['name']);
    add_filter('sanitize_file_name', 'remove_accents');

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'sanitize_file_uploads');


/**
 * Add Unify Theme Options in Settings > General for WPML plugin
 *
 * @since 5.3
 */

if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
    add_filter( 'admin_init', 'mk_unify_theme_options_fields' );

    function mk_unify_theme_options_fields() { 
        register_setting( 'general', 'mk_unify_theme_options', 'esc_attr' ); 

        add_settings_field(
            'mk_unify_theme_options', 
            '<label for="mk_unify_theme_options">' . __( 'Unify Theme Options' , 'mk_framework' ) . '</label>' , 
            'mk_unify_theme_options_field', 
            'general' ); 
    }

    function mk_unify_theme_options_field() { 
        $unify_theme_options = get_option( 'mk_unify_theme_options' ); 

        $html = '<legend class="screen-reader-text"><span>' . __( 'Unify Theme Options','mk_framework' ) . '</span></legend>
        <label for="mk_unify_theme_options">
        <input name="mk_unify_theme_options" type="checkbox" id="mk_unify_theme_options" value="1" ' . checked( 1, $unify_theme_options, false ) . '>' . __( 'Unify theme options for all languages for WPML plugin.', 'mk_framework' ) . '</label>';

        echo $html;
    }
}