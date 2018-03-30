<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Contains various outputs to wp_head action
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 4.2
 * @package     artbees
 */

/**
 * App Modules data collector
 */
if (!function_exists('mk_app_modules_header')) {
    function mk_app_modules_header() {
        global $app_modules, $mk_options, $mk_shortcode_order, $is_header_shortcode_added;
        $sticky_header_offset = isset($mk_options['sticky_header_offset']) ? $mk_options['sticky_header_offset'] : 'header';
        $toolbar_toggle = !empty($mk_options['theme_toolbar_toggle']) ? $mk_options['theme_toolbar_toggle'] : 'true';
        $post_id = global_get_post_id();
        if ($post_id) {
            $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
            
            if ($enable == 'true') {
                $toolbar_toggle_meta = get_post_meta($post_id, 'theme_toolbar_toggle', true);
                $sticky_header_offset_meta = get_post_meta($post_id, '_sticky_header_offset', true);
                $toolbar_toggle = (isset($toolbar_toggle_meta) && !empty($toolbar_toggle_meta)) ? $toolbar_toggle_meta : $toolbar_toggle;
                $sticky_header_offset = (isset($sticky_header_offset_meta) && !empty($sticky_header_offset_meta)) ? $sticky_header_offset_meta : $sticky_header_offset;
            }
        }
        $app_modules[] = array(
            'name' => 'theme_header',
            'params' => array(
                'id' => 'mk-header',
                'height' => $mk_options['header_height'],
                'stickyHeight' => $mk_options['header_scroll_height'],
                'stickyOffset' => $sticky_header_offset,
                'hasToolbar' => $toolbar_toggle
            )
        );
        
        $mk_shortcode_order = 0;
    }
    add_action('wp_head', 'mk_app_modules_header', 1);
}

/**
 * output header meta tags 
 */
if (!function_exists('mk_head_meta_tags')) {
    function mk_head_meta_tags() { 
        echo "\n";
        echo '<meta charset="' . get_bloginfo('charset') . '" />' . "\n";
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />' . "\n";
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />' . "\n";

        //<meta charset=''/> Defined above and it's best practice for HTML5
        //echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>' . "\n";
        echo '<meta name="format-detection" content="telephone=no">' . "\n";
    }
    add_action('wp_head', 'mk_head_meta_tags', 0);
}

/**
 * output Facebook Open Graph meta
 */
if (!function_exists('mk_open_graph_meta')) {
    function mk_open_graph_meta() {
        
        if (!is_single()) return false;

        global $post;

        $post_type = get_post_meta($post->ID, '_single_post_type', true);
        $post_thumb_id = get_post_thumbnail_id();

        if($post_type == 'portfolio' && empty($post_thumb_id)) {
            $slideshow_posts = get_post_meta($post->ID, '_gallery_images', true);    
            $slideshow_posts = explode(',', $slideshow_posts);
            $image_src_array = wp_get_attachment_image_src($slideshow_posts[0], 'full');
        } else {
            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full');    
        }
        

        $output = '<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>' . "\n";
        
        if(!Mk_Image_Resize::is_default_thumb($image_src_array[0]) && !empty($image_src_array[0])) {
            $output.= '<meta property="og:image" content="' . $image_src_array[0] . '"/>' . "\n";
        }

        $output.= '<meta property="og:url" content="' . esc_url( get_permalink() ) . '"/>' . "\n";
        $output.= '<meta property="og:title" content="' . the_title_attribute(array('echo' => false)) . '"/>' . "\n";
        $output.= '<meta property="og:description" content="' . esc_attr(get_the_excerpt()) . '"/>' . "\n";
        $output.= '<meta property="og:type" content="article"/>' . "\n";
        echo $output;
    }
    add_action('wp_head', 'mk_open_graph_meta');
}

/**
 * outputs custom fav icons and apple touch icons into head tag
 */
if (!function_exists('mk_apple_touch_icons')) {
    function mk_apple_touch_icons() {
        global $mk_options;
        
        echo "\n";
        
        if ($mk_options['custom_favicon']):
            echo '<link rel="shortcut icon" href="' . $mk_options['custom_favicon'] . '"  />' . "\n";
        else:
            echo '<link rel="shortcut icon" href="' . THEME_IMAGES . '/favicon.png"  />' . "\n";
        endif;
        
        if ($mk_options['iphone_icon']):
            echo '<link rel="apple-touch-icon-precomposed" href="' . $mk_options['iphone_icon'] . '">' . "\n";
        endif;
        
        if ($mk_options['iphone_icon_retina']):
            echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . $mk_options['iphone_icon_retina'] . '">' . "\n";
        endif;
        
        if ($mk_options['ipad_icon']):
            echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . $mk_options['ipad_icon'] . '">' . "\n";
        endif;
        
        if ($mk_options['ipad_icon_retina']):
            echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . $mk_options['ipad_icon_retina'] . '">' . "\n";
        endif;
    }
    add_action('wp_head', 'mk_apple_touch_icons', 2);
}


/**
 * outputs custom fav icons and apple touch icons into head tag
 */
if (!function_exists('mk_dynamic_js_vars')) {
    function mk_dynamic_js_vars() {
        global $mk_options;
        
        $post_id = global_get_post_id();
        $wp_p_id = $post_id ? $post_id : '';
        
        echo '<script type="text/javascript">' . "\n";
        echo 'window.abb = {};' . "\n";
        echo 'php = {};' . "\n"; // it gets overwritten somewhere. do not attach anything more. remove ASAP and reattach to PHP
        echo 'window.PHP = {};' . "\n";
        echo 'PHP.ajax = "'.admin_url('admin-ajax.php').'";';
        echo 'PHP.wp_p_id = "'.$wp_p_id.'";';
        // What is really needed assign to php namespace (as it ships from php). Do not expose globals.
        // Remove rest.
        echo 'var mk_header_parallax, mk_banner_parallax, mk_page_parallax, mk_footer_parallax, mk_body_parallax;' . "\n";
        
        echo 'var mk_images_dir = "' . THEME_IMAGES . '",' . "\n";
        echo 'mk_theme_js_path = "' . THEME_JS . '",' . "\n";
        echo 'mk_theme_dir = "' . THEME_DIR_URI . '",' . "\n";
        echo 'mk_captcha_placeholder = "' . __('Enter Captcha', 'mk_framework') . '",' . "\n";
        echo 'mk_captcha_invalid_txt = "' . __('Invalid. Try again.', 'mk_framework') . '",' . "\n";
        echo 'mk_captcha_correct_txt = "' . __('Captcha correct.', 'mk_framework') . '",' . "\n";
        echo 'mk_responsive_nav_width = ' . $mk_options['responsive_nav_width'] . ',' . "\n";
        echo 'mk_vertical_header_back = "' . __('Back', 'mk_framework') . '",' . "\n";
        echo 'mk_vertical_header_anim = "' . $mk_options['vertical_menu_anim'] . '",' . "\n";
        
        echo 'mk_check_rtl = ' . ((is_rtl()) ? "false" : "true") . ',' . "\n";
        
        echo 'mk_grid_width = ' . $mk_options['grid_width'] . ',' . "\n";
        echo 'mk_ajax_search_option = "' . $mk_options['header_search_location'] . '",' . "\n";
        echo 'mk_preloader_bg_color = "' . (($mk_options['preloader_bg_color']) ? $mk_options['preloader_bg_color'] : '#fff') . '",' . "\n";
        echo 'mk_accent_color = "' . $mk_options['skin_color'] . '",' . "\n";
        echo 'mk_go_to_top =  "' . (($mk_options['go_to_top']) ? $mk_options['go_to_top'] : 'false') . '",' . "\n";
        echo 'mk_smooth_scroll =  "' . (($mk_options['smoothscroll']) ? $mk_options['smoothscroll'] : 'false') . '",' . "\n";
        
        $mk_preloader_bar_color = (isset($mk_options['preloader_bar_color']) && !empty($mk_options['preloader_bar_color'])) ? $mk_options['preloader_bar_color'] : $mk_options['skin_color'];
        
        echo 'mk_preloader_bar_color = "' . $mk_preloader_bar_color . '",' . "\n";
        
        echo 'mk_preloader_logo = "' . $mk_options['preloader_logo'] . '";' . "\n";
        if ($post_id):
            echo 'var mk_header_parallax = ' . (get_post_meta($post_id, 'header_parallax', true) ? get_post_meta($post_id, 'header_parallax', true) : "false") . ',' . "\n";
            echo 'mk_banner_parallax = ' . (get_post_meta($post_id, 'banner_parallax', true) ? get_post_meta($post_id, 'banner_parallax', true) : "false") . ',' . "\n";
            echo 'mk_page_parallax = ' . (get_post_meta($post_id, 'page_parallax', true) ? get_post_meta($post_id, 'page_parallax', true) : "false") . ',' . "\n";
            echo 'mk_footer_parallax = ' . (get_post_meta($post_id, 'footer_parallax', true) ? get_post_meta($post_id, 'footer_parallax', true) : "false") . ',' . "\n";
            echo 'mk_body_parallax = ' . (get_post_meta($post_id, 'body_parallax', true) ? get_post_meta($post_id, 'body_parallax', true) : "false") . ',' . "\n";
            echo 'mk_no_more_posts = "' . __('No More Posts', 'mk_framework') . '";' . "\n";
        endif;

        
        echo '</script>' . "\n";
    }
    add_action('wp_head', 'mk_dynamic_js_vars', 3);
}


/**
 * Adds preloaders overlay div when its option is enabled
 * @return HTML
 *
 */
if (!function_exists('mk_preloader_body_overlay')) {
    function mk_preloader_body_overlay() {
        global $mk_options;
        $preloader_check = '';
        $post_id = global_get_post_id();
        
        $singular_preloader = ($post_id) ? get_post_meta($post_id, 'page_preloader', true) : '';

        if ($singular_preloader == 'true') {
            $preloader_check = 'enabled';
        } 
        else {
            if ($mk_options['preloader'] == 'true') {
                $preloader_check = 'enabled';
            }
        }
        if ($preloader_check == 'enabled') {
            echo '<div class="mk-body-loader-overlay page-preloader" style="background-color:'.$mk_options['preloader_bg_color'].';">';
            $loaderStyle = isset($mk_options['preloader_animation']) ? $mk_options['preloader_animation'] : 'ball_pulse';

            if (!empty($mk_options['preloader_logo'])) {
                $preloader_logo_id = mk_get_attachment_id_from_url($mk_options['preloader_logo']);
                if ( !empty($preloader_logo_id) ) {
                    $preloader_logo_array = wp_get_attachment_image_src($preloader_logo_id, 'full', true);
                    $prelaoder_logo_width = $preloader_logo_array[1];
                    $prelaoder_logo_height = $preloader_logo_array[2];
                } else {
                    $preloader_logo_array = mk_getimagesize($mk_options['preloader_logo']);
                    $prelaoder_logo_width = $preloader_logo_array[0];
                    $prelaoder_logo_height = $preloader_logo_array[1];
                }
                
                if ( $mk_options['retina_preloader'] == 'true' ) {
                    $prelaoder_logo_width = absint($prelaoder_logo_width/2);
                    $prelaoder_logo_height = absint($prelaoder_logo_height/2);
                }
                echo '<img alt="'.get_bloginfo('name').'" class="preloader-logo" src="'.$mk_options['preloader_logo'].'" width="' . $prelaoder_logo_width . '" height="' . $prelaoder_logo_height . '" >';

            }

            echo ' <div class="preloader-preview-area">';
            if($loaderStyle == "ball_pulse"){
                echo '  <div class="ball-pulse">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                        </div>';
            }else if($loaderStyle == "ball_clip_rotate_pulse") {
                echo '  <div class="ball-clip-rotate-pulse">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="border-color: '.$mk_options['preloader_icon_color'].' transparent '.$mk_options['preloader_icon_color'].' transparent;"></div>
                        </div>';
            }else if($loaderStyle == "square_spin") {
                echo '  <div class="square-spin">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                        </div>';
            }else if($loaderStyle == "cube_transition") {
                echo '  <div class="cube-transition">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                        </div>';
            }else if($loaderStyle == "ball_scale") {
                echo '  <div class="ball-scale">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                        </div>';
            }else if($loaderStyle == "line_scale") {
                echo '  <div class="line-scale">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                        </div>';
            }else if($loaderStyle == "ball_scale_multiple") {
                echo '  <div class="ball-scale-multiple">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                        </div>';
            }else if($loaderStyle == "ball_pulse_sync") {
                echo '  <div class="ball-pulse-sync">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                        </div>';
            }else if($loaderStyle == "transparent_circle") {
                echo '  <div class="transparent-circle" style="
                                border-top-color: '.mk_hex2rgba($mk_options['preloader_icon_color'], 0.2).';
                                border-right-color: '.mk_hex2rgba($mk_options['preloader_icon_color'], 0.2).';
                                border-bottom-color: '.mk_hex2rgba($mk_options['preloader_icon_color'], 0.2).';
                                border-left-color: '.$mk_options['preloader_icon_color'].';">
                        </div>';
            }else if($loaderStyle == "ball_spin_fade_loader") {
                echo '  <div class="ball-spin-fade-loader">
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                            <div style="background-color: '.$mk_options['preloader_icon_color'].'"></div>
                        </div>';
            }
            echo "  </div>";
            echo "</div>";
        }
    }
    
    add_action('theme_after_body_tag_start', 'mk_preloader_body_overlay');
}

/**
 * Populates classes to be added to body tag
 * @return HTML
 *
 */
if (!function_exists('mk_get_body_class')) {
    function mk_get_body_class($post_id) {
        global $mk_options;
        $body_class = array();
        
        $header_style = !empty($mk_options['theme_header_style']) ? $mk_options['theme_header_style'] : 1;
        
        if ($post_id) {
            $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
            
            if ($enable == 'true') {
                $header_style_meta = get_post_meta($post_id, 'theme_header_style', true);
                $header_style = (isset($header_style_meta) && !empty($header_style_meta)) ? $header_style_meta : $header_style;
            }
        }
        
        if (($mk_options['background_selector_orientation'] == 'boxed_layout') && !($post_id && get_post_meta($post_id, '_enable_local_backgrounds', true) == 'true' && get_post_meta($post_id, 'background_selector_orientation', true) == 'full_width_layout')) {
            
            $body_class[] = 'mk-boxed-enabled';
        } 
        else if ($post_id && get_post_meta($post_id, '_enable_local_backgrounds', true) == 'true' && get_post_meta($post_id, 'background_selector_orientation', true) == 'boxed_layout') {
            
            $body_class[] = 'mk-boxed-enabled';
        }
        
        if ($header_style == 4) {
            $vertical_header_logo_align = (isset($mk_options['vertical_header_logo_align']) && !empty($mk_options['vertical_header_logo_align'])) ? $mk_options['vertical_header_logo_align'] : 'center';
            $header_align = !empty($mk_options['theme_header_align']) ? $mk_options['theme_header_align'] : 'left';
            
            if ($post_id) {
                $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
                
                if ($enable == 'true') {
                    $header_align_meta = get_post_meta($post_id, 'theme_header_align', true);
                    $header_align = (isset($header_align_meta) && !empty($header_align_meta)) ? $header_align_meta : $header_align;
                }
            }
            
            $body_class[] = 'vertical-header-enabled vertical-header-' . $header_align . ' logo-align-' . $vertical_header_logo_align;
        }
        
        $body_class[] = 'loading';

        return $body_class;
    }
}

/*
Checks if header is transparent
*/
if (!function_exists('is_header_transparent')) {
    function is_header_transparent($output = false) {
        
        $post_id = global_get_post_id();
        if ($post_id) {
            $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
            
            if ($enable == 'true') {
                $meta = get_post_meta($post_id, '_transparent_header', true);
                $check = (isset($meta) && !empty($meta)) ? $meta : 'false';
                if($check == 'true') {
                    if(empty($output)) {
                        return true;
                    } else {
                        return $output;    
                    }
                }

            }
        }
        return false;
    }
}


/*
Checks header style
*/
if (!function_exists('get_header_style')) {
    function get_header_style() {
        
        global $mk_options;

        $style = !empty($mk_options['theme_header_style']) ? $mk_options['theme_header_style'] : 1;

        $post_id = global_get_post_id();

        if ($post_id) {
            $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
            
            if ($enable == 'true') {
                $meta = get_post_meta($post_id, 'theme_header_style', true);
                $style = (isset($meta) && !empty($meta)) ? $meta : $style;
            }
        }
        return $style;
    }
}


/*
Check if header is enabled in meta options.
*/
if (!function_exists('is_header_show')) {
    function is_header_show($is_shortcode = false) {

        if($is_shortcode) return true;
        
        $post_id = global_get_post_id();
        $show_header = '';
        if ($post_id) {
            $show_header = get_post_meta($post_id, '_template', true);
        } else {
            // If is not singlular return false;
            return true;
        }

        if (!in_array($show_header, array('no-header', 'no-header-title', 'no-header-title-footer', 'no-header-footer'))) {

            return true;
        }    
    }
}


/*
Check if header and page title is enabled in meta options.
*/
if (!function_exists('is_header_and_title_show')) {
    function is_header_and_title_show($is_shortcode = false) {

        if($is_shortcode) return true;
        
        $post_id = global_get_post_id();
        $show_header = '';
        if ($post_id) {
            $show_header = get_post_meta($post_id, '_template', true);
        } else {
            // If is not singlular return false;
            return true;
        }

        if (!in_array($show_header, array('no-header-title', 'no-header-title-footer'))) {

            return true;
        }    
    }
}


/*
Check if header and page title is enabled in meta options.
*/
if (!function_exists('is_page_title_show')) {
    function is_page_title_show($is_shortcode = false) {

        if($is_shortcode) return true;
        
        $post_id = global_get_post_id();
        $show_header = '';
        if ($post_id) {
            $show_header = get_post_meta($post_id, '_template', true);
        } else {
            // If is not singlular return false;
            return true;
        }

        if (!in_array($show_header, array('no-title', 'no-footer-title', 'no-header-title', 'no-header-title-footer'))) {

            return true;
        }    
    }
}


/*
Check if header toolbar is enabled in theme options or meta options.
*/
if (!function_exists('is_header_toolbar_show')) {
    function is_header_toolbar_show($is_shortcode = false) {

        if($is_shortcode) return false;

        global $mk_options;
    
        $post_id = global_get_post_id();
        $toolbar = !empty($mk_options['theme_toolbar_toggle']) ? $mk_options['theme_toolbar_toggle'] : 'false';


        if ($post_id) {
            $in_post = get_post_meta($post_id, '_enable_local_backgrounds', true);
            
            if ($in_post == 'true') {
                $meta = get_post_meta($post_id, 'theme_toolbar_toggle', true);
                $toolbar = (isset($meta) && !empty($meta)) ? $meta : $toolbar;  
            }
        }  

        return $toolbar;
    }
}




/*
Check if header is enabled in meta options.
*/
if (!function_exists('get_header_json_data')) {
    function get_header_json_data($is_shortcode = false, $header_style) {
        $skin = '';
        global $mk_options;

        $sticky_style = !empty($mk_options['header_sticky_style']) ? $mk_options['header_sticky_style'] : 'false';
        $sticky_style = $is_shortcode ? 'none' : $sticky_style;
        $sticky_offset = isset($mk_options['sticky_header_offset']) ? $mk_options['sticky_header_offset'] : $mk_options['header_height'];
        $header_style = (isset($header_style) && !empty($header_style) ) ? $header_style : get_header_style();

        $post_id = global_get_post_id();

        if ($post_id) {
            $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
    
            if ($enable == 'true') {
                $skin = get_post_meta($post_id, '_transparent_header_skin', true);
                $skin = (isset($skin) && !empty($skin)) ? $skin : 'light';
                $meta_sticky_offset = get_post_meta($post_id, '_sticky_header_offset', true);
                $sticky_offset = (!empty($meta_sticky_offset)) ? $meta_sticky_offset : $sticky_offset;
            }
        }

        $data = array(
            'height' => $mk_options['header_height'],
            'sticky-height' => $mk_options['header_scroll_height'],
            'responsive-height' => $mk_options['res_header_height'],
            'transparent-skin' => $skin,
            'header-style' => $header_style,
            'sticky-style' => $sticky_style,
            'sticky-offset' => $sticky_offset
            );

        // TODO : Bart should remove below code and use data-settings data attribute. 
        // Bart note: this is good practice to keep things clean but rewriting it now doesn't bring any other improvement so leave it for later          
        return "data-height='".$mk_options['header_height']."'
                data-sticky-height='".$mk_options['header_scroll_height']."'
                data-responsive-height='".$mk_options['res_header_height']."'
                data-transparent-skin='".$skin."'
                data-header-style='".$header_style."'
                data-sticky-style='".$sticky_style."'
                data-sticky-offset='".$sticky_offset."'";
          
    }
}



/*
Get Header class
*/
if (!function_exists('mk_get_header_class')) {
    function mk_get_header_class($atts = array()) {

        extract($atts);

        global $mk_options;

        $header_layout = ($mk_options['header_grid'] == 'true') ? 'boxed-header' : 'full-header';
        $header_align = !empty($mk_options['theme_header_align']) ? $mk_options['theme_header_align'] : 'left';
        $toolbar_toggle = !empty($mk_options['theme_toolbar_toggle']) ? $mk_options['theme_toolbar_toggle'] : 'true';
        $sticky_style = !empty($mk_options['header_sticky_style']) ? $mk_options['header_sticky_style'] : 'false';
        $sticky_style_class = ($sticky_style == 'lazy') ? 'sticky-style-fixed' :  'sticky-style-' . $sticky_style;
        
        $sticky_style_class = $is_shortcode ? false : $sticky_style_class;
        

        $post_id = global_get_post_id();

        if ($post_id) {
            $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
    
            if ($enable == 'true') {
              
              $header_align_meta = get_post_meta($post_id, 'theme_header_align', true);
              $header_align = (isset($header_align_meta) && !empty($header_align_meta)) ? $header_align_meta : $header_align;

              $toolbar_toggle_meta = get_post_meta($post_id, 'theme_toolbar_toggle', true);
              $toolbar_toggle = (isset($toolbar_toggle_meta) && !empty($toolbar_toggle_meta)) ? $toolbar_toggle_meta : $toolbar_toggle;

              $skin_meta = get_post_meta($post_id, '_transparent_header_skin', true);
              $skin = (isset($skin_meta) && !empty($skin_meta)) ? $skin_meta : 'light';

              $remove_bg_meta = get_post_meta($post_id, '_trans_header_remove_bg', true);
              $remove_bg = (isset($remove_bg_meta) && !empty($remove_bg_meta)) ? $remove_bg_meta : 'true';
            }
        }

        $header_align = (isset($sh_header_align) && !empty($sh_header_align)) ? $sh_header_align : $header_align;
        $header_style = (isset($sh_header_style) && !empty($sh_header_style)) ? $sh_header_style : get_header_style();
        $toolbar_toggle = ($header_style == 'false') ? 'false' : $toolbar_toggle;
        $hover_styles = isset($sh_hover_styles) ? $sh_hover_styles : $mk_options['main_nav_hover'];
        $is_transparent = (isset($sh_is_transparent)) ? ($sh_is_transparent == 'false' ? false : is_header_transparent()) : is_header_transparent();
        $id = !empty($sh_id) ? 'id="mk-header-'.$sh_id.'" ' : '';

        $logo_in_middle = ($header_style == 1) ? ($mk_options['logo_in_middle'] == 'true' ? 'js-logo-middle logo-in-middle' : '') : '';

        $class[] = 'mk-header';
        $class[] = 'header-style-'.$header_style;
        $class[] = 'header-align-'.$header_align;
        $class[] = $logo_in_middle;
        $class[] = 'toolbar-'.$toolbar_toggle;
        $class[] = 'menu-hover-'.$hover_styles;
        $class[] = $sticky_style_class;
        $class[] = mk_get_bg_cover_class($mk_options['banner_size']);
        $class[] = $header_layout;
        $class[] = isset($el_class) ? $el_class : '';
        
        if ($is_transparent) {
            $class[] = 'transparent-header';
            $class[] = $skin.'-skin';
            $class[] = 'bg-'.$remove_bg;
        }

        return $id . 'class="'.implode(' ', $class).'"';
    }
}


/*
Adds debugging information to front-end
*/
if (!function_exists('mk_theme_debugging_info')) {
    function mk_theme_debugging_info() {
        $theme_data = wp_get_theme();
        echo '<meta name="generator" content="' . wp_get_theme() . ' ' . $theme_data['Version'] . '" />' . "\n";
    }
    add_action('wp_head', 'mk_theme_debugging_info', 999);
}


/*
Enables Testing environment variable for regression testings
*/
if (!function_exists('mk_enable_regression_testing')) {
    function mk_enable_regression_testing() {
        $is_test = isset($_GET['testing']) ? "true" : "false";
        echo '<script> var isTest = '.$is_test.'; </script>' . "\n";
        if($is_test == "true") {
            echo '<style>.mk-edge-slider .mk-slider-slide .edge-scale-down .edge-buttons, 
                    .mk-edge-slider .mk-slider-slide .edge-scale-down .edge-desc, 
                    .mk-edge-slider .mk-slider-slide .edge-scale-down .edge-title
                    { opacity: 1 !important; transform: scale(1) !important; }
                    .mk-moving-image img
                    { animation: none !important; } </style>';
        }
    }
    add_action('wp_head', 'mk_enable_regression_testing');
}


/*
Adds inline styles from media.css to be served as entry point for js element queries.
We need to keep it inline to preserve compatibility with 3rd party minification plugins
*/
if (!function_exists('mk_media_css')) {
    function mk_media_css() {

        $file_dir = THEME_DIR . '/assets/stylesheet/min/media.css';
        $file_uri = THEME_DIR_URI . '/assets/stylesheet/min/media.css';

        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        $wp_get_file_body = $wp_filesystem->get_contents($file_dir);

        if ($wp_get_file_body == false) {
            $wp_remote_get_file = wp_remote_get($file_uri);

            if (is_array($wp_remote_get_file) and array_key_exists('body', $wp_remote_get_file)) {
                $wp_remote_get_file_body = $wp_remote_get_file['body'];

            } else if (is_numeric(strpos($file_uri, "https://"))) {

                $file_uri           = str_replace("https://", "http://", $file_uri);
                $wp_remote_get_file = wp_remote_get($file_uri);

                if (!is_array($wp_remote_get_file) or !array_key_exists('body', $wp_remote_get_file)) {
                    echo "SSL connection error. Code: mk_media_css";
                    die;
                }

                $wp_remote_get_file_body = $wp_remote_get_file['body'];
            }

            $wp_file_body = $wp_remote_get_file_body;

        } else {
            $wp_file_body = $wp_get_file_body;
        }

        echo '<style id="js-media-query-css">'. $wp_file_body .'</style>';
    }
    add_action('wp_head', 'mk_media_css');
}

